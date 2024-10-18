<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GateEntry\gate_entry_purchase_head;
use App\Models\GateEntry\gate_entry_purchase_body;
use App\Models\GateEntry\gate_entry_return_head;
use App\Models\GateEntry\gate_entry_return_body;
use App\Models\GateEntry\gate_entry_nonreturn_head;
use App\Models\GateEntry\gate_entry_nonreturn_body;
use Auth;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Schema;

class FinanaceGateEntryController extends Controller
{

	public function __cunstruct(Request $request,$data){

		//$this->data = "smit@121";

	 }

    public function AddGateEntryPurchase(Request $request)
    {
    	//print_r($this->data);exit;
		$title                      ='Gate Entry Purchase';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'G2'])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']  = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
		//DB::enableQueryLog();
		$userdata['dept_list']      = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']     = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']      = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->get();
		
	//	$userdata['acc_list'] = DB::table('PORDER_HEAD')->groupBY('ACC_CODE')->get();
		$userdata['acc_list'] = DB::table('MASTER_ACC')->groupBY('ACC_CODE')->get();
			//print_r($userdata['acc_list']);exit;
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		

   		$requistion = DB::table('GRNGATE_HEAD')->where('COMP_CODE', $CompanyCode)->where('FY_CODE',$macc_year)->get();
		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','G2')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='G2'");
		//	print_r($vr_No_list);exit;
		//dd(DB::getQueryLog());
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userdata['last_num']   = $key->LAST_NO;
					$userdata['to_num']     = $key->TO_NO;
					//$userdata['trans_head'] = $key->TRAN_CODE;
				}

			}else{

					$userdata['last_num']  ='';
					$userdata['to_num']  ='';
					//$userdata['trans_head']  ='';

			}

	

		if(isset($CompanyCode)){

		    return view('admin.finance.transaction.gate_entry.gate_entry_purchase.gate_entry_purchase',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }

    public function GetAccCodeByOrder(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$acc_code    = $request->input('acc_code');
            
            $fetch_reocrd = DB::table('PORDER_HEAD')->where('ACC_CODE',$acc_code)->get();

            $acc_name = DB::table('MASTER_ACC')->where('ACC_CODE',$acc_code)->get()->first();

          /*  $id = $fetch_reocrd->id;

            $purchase_body = DB::table('purchase_order_body')->where('purchase_order_head_id',$id)->get();*/

            //print_r($purchase_body);exit;


            if ($fetch_reocrd!='') {

				$response_array['response']    = 'success';
				$response_array['data']        = $fetch_reocrd;
				$response_array['acc_name']    = $acc_name->ACC_NAME;
				//$response_array['levelAmt']    = $levelAmt;

                $data = json_encode($response_array);
                print_r($data);

            }else{

				$response_array['response'] = 'error';
				$response_array['data']     = '' ;
                $data = json_encode($response_array);
                print_r($data);
                
            }

        }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '';
                $data = json_encode($response_array);
                print_r($data);
        }


    }

    public function GetitemByOrdernum(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$orderno = $request->input('orderno');
	    	

	    	if($orderno){
	    		

	    		$itemListData = DB::table('PORDER_BODY')->where('VRNO', $orderno)->where('GATEPU_QTY','!=',0.000)->get()->toArray();

	    		/*$itemListData = DB::select("SELECT * FROM `PORDER_HEAD` WHERE VRNO='$orderno' AND GATEPU_QTY !='0.000' OR gate_entry_pu_qty != Null");*/

	    		//print_r($itemListData);exit;
	    	
	    	}

	    	
    		if ($itemListData) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemListData;

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    

    public function Get_Item_Data_Order(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$itemCode = $request->input('ItemCode');
	    	$cnum = $request->input('cnum');
	    	$type = $request->input('type');
	    	$qcount = $request->input('q');

	    	//print_r($orderno);exit;

	    	if($type=='ISSUE'){

	    	$item_data = DB::table('SREQ_BODY')->where('ITEM_CODE', $itemCode)->where('VRNO',$cnum)->where('STORE_ACTION','ISSUE')->get()->first();
	    	}

	    	if($type=='ORDER'){

	    	$item_data = DB::table('PORDER_BODY')->where('ITEM_CODE', $itemCode)->where('VRNO',$cnum)->get()->first();
	    	}
	    	
	    	

	    	/*$item_data = DB::select("SELECT * FROM `purchase_order_body` WHERE item_code='$itemCode' AND vrno='$orderno'");*/

	    	//print_r($item_data);exit;

	    	$item_um_aum_list = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemCode)->get();

	    	/*$fetch_hsn_code = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE',$itemCode)->get()->toArray();*/

	    	$fetch_hsn_code = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->toArray();

    		if ($item_um_aum_list && $fetch_hsn_code) {

				$response_array['response']  = 'success';
				$response_array['data']      = $item_um_aum_list;
				$response_array['data_hsn']  = $fetch_hsn_code;
				$response_array['data_item'] = $item_data;
	           
	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    
    public function Get_Item_Data_Gate_Entry_Pur(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			$itemCode = $request->input('ItemCode');
			$ordernum     = $request->input('ordernum');
		

	    	$item_data = DB::table('PORDER_BODY')->where('ITEM_CODE', $itemCode)->where('VRNO',$ordernum)->get()->first();
	    	
	    	

	    	$item_um_aum_list = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemCode)->get();

	   

	    	$fetch_hsn_code = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->toArray();

    		if ($item_um_aum_list && $fetch_hsn_code) {

				$response_array['response'] = 'success';
				$response_array['data']     = $item_um_aum_list;
				$response_array['data_hsn'] = $fetch_hsn_code;
				$response_array['data_item'] = $item_data;
	           
	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


public function SaveGateEntryPurchase(Request $request)
    {
    	//print_r($request->post());exit;
    	//
			$createdBy         = $request->session()->get('userid');
			$compName          = $request->session()->get('company_name');
			$compcode          = explode('-', $compName);
		    $getcompcode       = $compcode[0];
			$fisYear           =  $request->session()->get('macc_year');
			$comp_nameval      = $request->input('comp_name');
			$fy_year           = $request->input('fy_year');
			$pfct_code         = $request->input('pfct_code');
			$trans_code        = $request->input('trans_code');
			$series_code       = $request->input('series_code');
			$series_name       = $request->input('series_name');
			$plant_name        = $request->input('plant_name');
			$pfct_name         = $request->input('pfct_name');
			$vr_no             = $request->input('vr_no');
			$trans_date        = $request->input('trans_date');
			$tr_vr_date        = date("Y-m-d", strtotime($trans_date));
			$getduedate        = $request->input('getdue_date');
			$dueDate           = date("Y-m-d", strtotime($getduedate));
			$departCode        = $request->input('departCode');
			$departName        = $request->input('departName');
			$plant_code        = $request->input('plant_code');
			$item_code         = $request->input('item_code');
			$item_name         = $request->input('item_name');
			$remark            = $request->input('remark');
			$remark_item       = $request->input('rmark_item');
			$qty               = $request->input('qty');
			$gatepuqty         = $request->input('gatepuqty');
			$ordervr           = $request->input('ordervr');
			$unit_M            = $request->input('unit_M');
			$Aqty              = $request->input('Aqty');
			$gatepuAqty        = $request->input('gatepuAqty');
			$add_unit_M        = $request->input('add_unit_M');
			$scrab_code        = $request->input('scrab_code');
			$batch_no          = $request->input('batch_no');
			$vehicle_no        = $request->input('vehicle_no');
			$driver_name       = $request->input('driver_name');
			$driver_contact_no = $request->input('driver_contact_no');
			$prefno = $request->input('party_ref');
			$prefdate = $request->input('party_ref_d');

	    	$count = count($item_code);

	   	   $GateH = DB::select("SELECT MAX(GRNGATEHID) as GRNGATEHID FROM GRNGATE_HEAD");
			$headID = json_decode(json_encode($GateH), true); 
	  //  print_r($headID);exit;
	
			if(empty($headID[0]['GRNGATEHID'])){
			$headId = 1;
			}else{
			$headId = $headID[0]['GRNGATEHID']+1;
			}



			if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('GRNGATE_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

		   DB::beginTransaction();

		   try {

	    	$datahead = array(

				'GRNGATEHID'        =>$headId,
				'COMP_CODE'         =>$getcompcode,
				'FY_CODE'           =>$fisYear,
				'PFCT_CODE'         =>$pfct_code,
				'PFCT_NAME'         =>$pfct_name,
				'TRAN_CODE'         =>$trans_code,
				'SERIES_CODE'       =>$series_code,
				'SERIES_NAME'       =>$series_name,
				'VRNO'              =>$NewVrno,
				'VRDATE'            =>$tr_vr_date,
				'DEPT_CODE'         =>$departCode,
				'DEPT_NAME'         =>$departName,
				'PLANT_CODE'        =>$plant_code,
				'PLANT_NAME'        =>$plant_name,
				'VEHICLE_NO'        =>$vehicle_no,
				'DRIVER_NAME'       =>$driver_name,
				'DRIVER_CONTACT_NO' =>$driver_contact_no,
				'PREFNO'            =>$prefno,
				'PREFDATE'          =>$prefdate,
				'CREATED_BY'        =>$createdBy,

			);
	    
	    $saveData = DB::table('GRNGATE_HEAD')->insert($datahead);
	     
	     
	     //$data = array();
		for ($i = 0; $i < $count; $i++) {

			$GateB= DB::select("SELECT MAX(GRNGATEBID) as GRNGATEBID   FROM GRNGATE_BODY");
			$bodyID = json_decode(json_encode($GateB), true); 
	  //  print_r($headID);exit;
	
			if(empty($bodyID[0]['GRNGATEBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['GRNGATEBID']+1;
			}


		    $data_body = array(

				'GRNGATEHID'  =>$headId,
				'GRNGATEBID'  =>$bodyId,
				'COMP_CODE'   =>$getcompcode,
				'FY_CODE'     =>$fisYear,
				'PFCT_CODE'   =>$pfct_code,
				'PLANT_CODE'  =>$plant_code,
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'VRNO'        =>$NewVrno,
				'SLNO'        =>$i+1,
				'ITEM_CODE'   =>$item_code[$i],
				'ITEM_NAME'   =>$item_name[$i],
				//'remark'    =>$remark[$i],
				'REMARK'      =>$remark_item[$i],
				'QTYRECD'     =>$qty[$i],
				'UM'          =>$unit_M[$i],
				'AQTYRECD'    =>$Aqty[$i],
				'AUM'         =>$add_unit_M[$i],
				'CREATED_BY'  =>$createdBy,

		    );
		   // print_r($i);

			$saveData2 = DB::table('GRNGATE_BODY')->insert($data_body);

			

			$dataupdate = array(

				'GATEPU_QTY'  => floatval($gatepuqty[$i]) - floatval($qty[$i]),
				'GATEPU_AQTY' =>  floatval($gatepuAqty[$i]) - floatval($Aqty[$i]),
			);

			$saveData11 = DB::table('PORDER_BODY')->where('ITEM_CODE', $item_code[$i])->where('VRNO',$ordervr)->update($dataupdate);
			
		}

		//$requistion->save();

		/*$getbody = DB::table('purchase_indent_body')->find(DB::table('purchase_indent_body')->max('id'));*/


		    DB::commit();
			$response_array['response'] = 'success';
			//$response_array['lastid'] = $headID;
		    $data = json_encode($response_array);
		    print_r($data);

			}catch (\Exception $e) {
		    DB::rollBack();
		    //throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}

			/*if ($saveData2) {

	    			$response_array['response'] = 'success';
		            $response_array['lastid'] = $headId;
		         
		            $data = json_encode($response_array);

		            print_r($data);

			}else{

					$response_array['response'] = 'error';
	                $response_array['data'] = '' ;

	                $data = json_encode($response_array);

	                print_r($data);
					
			}
			*/
		


    }


    public function gatepurchase_msg(Request $request,$saveData){

		if ($saveData== 'true') {

			$request->session()->flash('alert-success', 'Gate Entry Was Successfully Added...!');
			return redirect('/Transaction/GateEntry/View-Gate-Entry-Purchase');

		} else {

			$request->session()->flash('alert-error', 'Gate Entry Can Not Added...!');
			return redirect('/Transaction/GateEntry/View-Gate-Entry-Purchase');

		}
	}

	 public function gatepassreturn_msg(Request $request,$saveData){

		if ($saveData== 'true') {

			$request->session()->flash('alert-success', 'Gate Pass  Was Successfully Added...!');
			return redirect('/Transaction/GateEntry/View-Gate-Pass');

		} else {

			$request->session()->flash('alert-error', 'Gate Pass Can Not Added...!');
			return redirect('/Transaction/GateEntry/View-Gate-Pass');

		}
	}

    public function ViewGateEntryPurchase(Request $request)
    {
    		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

			$title       ='View Gate Entry';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			
			$getcompcode = $compcode[0];

	        $fisYear =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	         $data = DB::table('GRNGATE_HEAD')->where('GRNGATE_HEAD.COMP_CODE', '=',$getcompcode)->where('GRNGATE_HEAD.FY_CODE', '=',$fisYear)->get();


	        }else if($userType=='superAdmin' || $userType=='user'){

	        	$data = DB::table('GRNGATE_HEAD')->where('GRNGATE_HEAD.COMP_CODE', '=',$getcompcode)->where('GRNGATE_HEAD.FY_CODE', '=',$fisYear)->get();

	         }else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	     
	       return view('admin.finance.transaction.gate_entry.gate_entry_purchase.view_gate_entry_purchase');
	    }else{
			return redirect('/useractivity');
		}
    }


    public function ViewGateEntryChildPurchase(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

		   //	DB::enableQueryLog();

	    	$requistion = DB::table('GRNGATE_BODY')->where('GRNGATEHID', $headid)->where('VRNO', $vrno)->get()->toArray();

	    	//dd(DB::getQueryLog());

	    	//print_r($requistion);exit;
	    	

    		if($requistion) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $requistion;
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }



    public function AddGateEntryReturn(Request $request)
    {
    	//print_r($this->data);exit;
		$title                      ='Gate Entry Pass';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'G0'])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']  = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
		//DB::enableQueryLog();
		$userdata['dept_list']      = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']     = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']      = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->get();
		
		$userdata['issue_list'] = DB::table('SREQ_HEAD')->where('STORE_ACTION','ISSUE')->groupBy('VRNO')->get();

		$userdata['order_list'] = DB::table('PORDER_HEAD')->get();
			//print_r($userdata['order_list']);exit;
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		

		/*$nonreturn_head = new gate_entry_nonreturn_head();

   		$requistion = $nonreturn_head->getnonreturnData($CompanyCode,$macc_year);*/

   		$requistion = DB::table('GP_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();
		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','G0')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='G0'");
		//	print_r($vr_No_list);exit;
		//dd(DB::getQueryLog());
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userdata['last_num']   = $key->LAST_NO;
					$userdata['to_num']     = $key->TO_NO;
					//$userdata['trans_head'] = $key->TRAN_CODE;
				}

			}else{

					$userdata['last_num']  ='';
					$userdata['to_num']  ='';
					//$userdata['trans_head']  ='';

			}

		if(isset($CompanyCode)){

		    return view('admin.finance.transaction.gate_entry.gate_entry_pass.gate_entry_pass',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }


    public function ViewGateEntryReturn(Request $request)
    {
    		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

			$title       ='View Gate Entry Return';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			
			$getcompcode = $compcode[0];

	        $fisYear =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	       
	        /*$data =	DB::SELECT("SELECT S.*,P.PLANT_NAME,C.SERIES_NAME,D.DEPT_NAME FROM 	GP_HEAD S  LEFT JOIN MASTER_CONFIG C ON C.SERIES_CODE = S.SERIES_CODE LEFT JOIN MASTER_PLANT P ON P.PLANT_CODE = S.PLANT_CODE LEFT JOIN MASTER_DEPT D ON D.DEPT_CODE = S.DEPT_CODE");*/


	        $data = DB::table('GP_HEAD')->where('GP_HEAD.COMP_CODE', '=',$getcompcode)
	        ->where('GP_HEAD.FY_CODE', '=',$fisYear)->get();
	       

	        /*$requisition_head = new store_requisition_head();

   		$requistion = $requisition_head->getrequsitionData($CompanyCode,$macc_year)->where('store_action','issue');*/

	        //print_r($data);
            	

	        }else if($userType=='superAdmin' || $userType=='user'){

	         // $data =	DB::SELECT("SELECT S.*,P.PLANT_NAME,C.SERIES_NAME,D.DEPT_NAME FROM 	GP_HEAD S  LEFT JOIN MASTER_CONFIG C ON C.SERIES_CODE = S.SERIES_CODE LEFT JOIN MASTER_PLANT P ON P.PLANT_CODE = S.PLANT_CODE LEFT JOIN MASTER_DEPT D ON D.DEPT_CODE = S.DEPT_CODE");

	       $data = DB::table('GP_HEAD')->where('GP_HEAD.COMP_CODE', '=',$getcompcode)
	        ->where('GP_HEAD.FY_CODE', '=',$fisYear)->get();
	       

	        }
	        else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	     
	       return view('admin.finance.transaction.gate_entry.gate_entry_pass.view_gate_entry_pass');
	    }else{
			return redirect('/useractivity');
		}
    }


    public function ViewGateEntryChildReturn(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	/*$requistion = gate_entry_return_body::where('gate_entry_return_head_id', $headid)->where('vrno', $vrno)->get()->toArray();*/

	    	$requistion = DB::table('GP_BODY')->where('GATEHID', $headid)->where('VRNO', $vrno)->get()->toArray();
	    	

    		if($requistion) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $requistion;
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function SaveGateEntryRetrun(Request $request)
    {

    	/*echo '<pre>';
    	print_r($request->post());exit;*/
    	//
			$createdBy    = $request->session()->get('userid');
			$compName     = $request->session()->get('company_name');
			$compcode     = explode('-', $compName);
			$getcompcode  = $compcode[0];
			$fisYear      =  $request->session()->get('macc_year');
			$comp_nameval = $request->input('comp_name');
			$fy_year      = $request->input('fy_year');
			$pfct_code    = $request->input('pfct_code');
			$trans_code   = $request->input('trans_code');
			$series_code  = $request->input('series_code');
			$series_name  = $request->input('series_name');
			$plant_name   = $request->input('plant_name');
			$pfct_name    = $request->input('pfct_name');
			$gp_type      = $request->input('gpType');
			$vr_no        = $request->input('vr_no');
			$trans_date   = $request->input('trans_date');
			$tr_vr_date   = date("Y-m-d", strtotime($trans_date));
			$getduedate   = $request->input('getdue_date');
			$dueDate      = date("Y-m-d", strtotime($getduedate));
			$departCode   = $request->input('departCode');
			$departName   = $request->input('departName');
			$plant_code   = $request->input('plant_code');
			$item_code    = $request->input('item_code');
			$item_name    = $request->input('item_name');
			$remark       = $request->input('remark');
			$remark_item  = $request->input('rmark_item');
			$qty          = $request->input('qty');
			$unit_M       = $request->input('unit_M');
			$Aqty         = $request->input('Aqty');
			$add_unit_M   = $request->input('add_unit_M');
			$scrab_code   = $request->input('scrab_code');
			$batch_no     = $request->input('batch_no');
			
			$ordernum     = $request->input('ordernum');
			$issuenum     = $request->input('issuenum');

			if($ordernum){

				$orderqty  = $qty;
				$orderAqty = $Aqty;

			}else{

				$orderqty  ='0.000';
				$orderAqty ='0.000';
			}

			if($issuenum){
				$issueqty  = $qty;
				$issueAqty = $Aqty;

			}else{ 
				$issueqty  ='0.000';
				$issueAqty ='0.000';
			}

	    	$count = count($item_code);

	   	   
	   	   $GateH = DB::select("SELECT MAX(GATEHID) as GATEHID FROM GP_HEAD");
			$headID = json_decode(json_encode($GateH), true); 
	  //  print_r($headID);exit;
	
			if(empty($headID[0]['GATEHID'])){
			$headId = 1;
			}else{
			$headId = $headID[0]['GATEHID']+1;
			}


		DB::beginTransaction();

		try {

	    	$datahead = array(

				'GATEHID'     =>$headId,
				'COMP_CODE'   =>$getcompcode,
				'FY_CODE'     =>$fisYear,
				'PFCT_CODE'   =>$pfct_code,
				'PFCT_NAME'   =>$pfct_name,
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'SERIES_NAME' =>$series_name,
				'VRNO'        =>$vr_no,
				'VRDATE'      =>$tr_vr_date,
				'GP_TYPE'     =>$gp_type,
				'DEPT_CODE'   =>$departCode,
				'DEPT_NAME'   =>$departName,
				'PLANT_CODE'  =>$plant_code,
				'PLANT_NAME'  =>$plant_name,
				'CREATED_BY'  =>$createdBy,

			);

			//print_r($datahead);exit;
	
	      $saveData = DB::table('GP_HEAD')->insert($datahead);
	    

	     
	  
		for ($i = 0; $i < $count; $i++) {

			$GateB = DB::select("SELECT MAX(GATEBID) as GATEBID FROM GP_BODY");
			$bodyID = json_decode(json_encode($GateB), true); 
	  //  print_r($headID);exit;
	
			if(empty($bodyID[0]['GATEBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['GATEBID']+1;
			}


			//print_r($item_code[$i]);
		    $data_body = array(

				'GATEHID'     =>$headId,
				'GATEBID'     =>$bodyId,
				'COMP_CODE'   =>$getcompcode,
				'FY_CODE'     =>$fisYear,
				'PFCT_CODE'   =>$pfct_code,
				'PLANT_CODE'  =>$plant_code,
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'DEPT_CODE'   =>$departCode,
				'VRNO'        =>$vr_no,
				'SLNO'        =>$i+1,
				'ITEM_CODE'   =>$item_code[$i],
				'ITEM_NAME'   =>$item_name[$i],
				//'REMARK'      =>$remark[$i],
				'REMARK'      =>$remark_item[$i],
				'QTYRECD'     =>$orderqty[$i],
				'UM'          =>$unit_M[$i],
				'AQTYRECD'    =>$orderAqty[$i],
				'AUM'         =>$add_unit_M[$i],
				'QTYISSUED'   =>$issueqty[$i],
				'AQTYISSUED'  =>$issueAqty[$i],
				'CREATED_BY'  =>$createdBy,

		    );
		   // print_r($i);

		$saveData2 = DB::table('GP_BODY')->insert($data_body);

			
			
		}

		//$requistion->save();

		/*$getbody = DB::table('purchase_indent_body')->find(DB::table('purchase_indent_body')->max('id'));*/
/*
			if ($saveData2) {

	    			$response_array['response'] = 'success';
		            $response_array['lastid'] = $headId;
		           // $response_array['lastheadid'] = $lastid;

		            $data = json_encode($response_array);

		            print_r($data);

			}else{

					$response_array['response'] = 'error';
	                $response_array['data'] = '' ;

	                $data = json_encode($response_array);

	                print_r($data);
					
			}*/
			


			 DB::commit();
			$response_array['response'] = 'success';
			//$response_array['lastid'] = $headID;
		    $data = json_encode($response_array);
		    print_r($data);

			}catch (\Exception $e) {

		    DB::rollBack();
		    //throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}
		


    }


    public function AddGateEntryNonReturn(Request $request)
    {
    	//print_r($this->data);exit;
		$title                      ='Gate Entry Non Return';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('master_comp')->get();
		
		$userdata['getacc']         = DB::table('master_party')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('master_config')->where(['tran_code'=>'G1'])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']  = DB::table('master_tax_rate')->groupBy('tax_code')->get();
		
		//DB::enableQueryLog();
		$userdata['dept_list']      = DB::table('dept_master')->get();
		$userdata['plant_list']     = DB::table('master_plant')->get();
		$userdata['pfct_list']      = DB::table('master_pfct')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']      = DB::table('master_bank')->get();
		$userdata['cost_list']      = DB::table('master_cost')->get();
		
		$userdata['help_item_list'] = DB::table('master_item_finance')->get();
		
		$userdata['issue_list']     = DB::table('store_requisition_heads')->where('store_action','issue')->get();

		$userdata['sale_list']      = DB::table('sales_head')->get();
			//print_r($userdata['order_list']);exit;
		$userdata['rate_list']      = DB::table('rate_value')->get();

		$getdate = DB::table('master_fy')->where(['comp_code'=>$getcompcode,'fy_code'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->fy_from_date;
					$userdata['toDate']   =  $key->fy_to_date;
					}

		

		$requisition_head = new gate_entry_purchase_head();

   		$requistion = $requisition_head->getrequsitionData($CompanyCode,$macc_year);

		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->vr_no;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `master_vrseq` WHERE comp_name='$CompanyCode' AND fiscal_year='$macc_year' AND tran_code='G1'");
		//	print_r($vr_No_list);exit;
		//dd(DB::getQueryLog());
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userdata['last_num']  = $key->last_no;
					$userdata['to_num']  = $key->to_no;
					$userdata['trans_head']  = $key->tran_code;
				}

			}else{

					$userdata['last_num']  ='';
					$userdata['to_num']  ='';
					$userdata['trans_head']  ='';

			}

		if(isset($CompanyCode)){

		    return view('admin.finance.transaction.gate_entry.gate_entry_nonreturn.gate_entry_nonreturn',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }


    public function ViewGateEntryNonReturn(Request $request)
    {
    		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

			$title       ='View Purchase Indent';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	        
	        $data = gate_entry_nonreturn_head::get();

	        /*$requisition_head = new store_requisition_head();

   		$requistion = $requisition_head->getrequsitionData($CompanyCode,$macc_year)->where('store_action','issue');*/

	        //print_r($data);
            	

	        }else if($userType=='superAdmin' || $userType=='user'){

	          $data = gate_entry_nonreturn_head::get();

	        }
	        else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	     
	       return view('admin.finance.transaction.gate_entry.gate_entry_nonreturn.view_gate_entry_nonreturn');
	    }else{
			return redirect('/useractivity');
		}
    }


    public function ViewGateEntryChildNonReturn(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$requistion = gate_entry_nonreturn_body::where('gate_entry_nonreturn_head_id', $headid)->where('vrno', $vrno)->get()->toArray();
	    	

    		if($requistion) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $requistion;
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function SaveGateEntryNonRetrun(Request $request)
    {
    	//print_r($request->post());exit;
    	//
    		$createdBy     = $request->session()->get('userid');
			$compName      = $request->session()->get('company_name');
			$fisYear       =  $request->session()->get('macc_year');
			$comp_nameval  = $request->input('comp_name');
			$fy_year       = $request->input('fy_year');
			$pfct_code     = $request->input('pfct_code');
			$trans_code    = $request->input('trans_code');
			$series_code   = $request->input('series_code');
			$series_name   = $request->input('series_name');
			$plant_name    = $request->input('plant_name');
			$pfct_name     = $request->input('pfct_name');
			$vr_no         = $request->input('vr_no');
			$trans_date    = $request->input('trans_date');
			$tr_vr_date    = date("Y-m-d", strtotime($trans_date));
			$getduedate    = $request->input('getdue_date');
			$dueDate       = date("Y-m-d", strtotime($getduedate));
			$departCode    = $request->input('departCode');
			$departName    = $request->input('departName');
			$plant_code    = $request->input('plant_code');
			$item_code     = $request->input('item_code');
			$item_name     = $request->input('item_name');
			$remark        = $request->input('remark');
			$remark_item   = $request->input('rmark_item');
			$qty           = $request->input('qty');
			$unit_M        = $request->input('unit_M');
			$Aqty          = $request->input('Aqty');
			$add_unit_M    = $request->input('add_unit_M');
			$scrab_code    = $request->input('scrab_code');
			$batch_no    = $request->input('batch_no');

	    	$count = count($item_code);

	   	  $gate_entry_nonreturn_head = new gate_entry_nonreturn_head;

	    	$datahead = array(

				'comp_name'   =>$compName,
				'fiscal_year' =>$fisYear,
				'pfct_code'   =>$pfct_code,
				'tran_code'   =>$trans_code,
				'series_code' =>$series_code,
				'series_name' =>$series_name,
				'plant_name'  =>$plant_name,
				'pfct_name'   =>$pfct_name,
				'vr_no'       =>$vr_no,
				'vr_date'     =>$tr_vr_date,
				'dept_code'   =>$departCode,
				'dept_name'   =>$departName,
				'plant_code'  =>$plant_code,
				'due_date'    =>$dueDate,
				'store_action'=>'req',
				'created_by'  =>$createdBy,

			);
	    
	        $gate_entry_nonreturn_head->insert($datahead);


	      $lastid= DB::getPdo()->lastInsertId();

	  //  print_r($lastid);exit;


	    $gate_entry_nonreturn_body = new gate_entry_nonreturn_body; 	
		
	     //$data = array();
		for ($i = 0; $i < $count; $i++) {

			//print_r($item_code[$i]);
		    $data = array(

				'gate_entry_nonreturn_head_id' =>$lastid,
				'comp_name'                    =>$compName,
				'fiscal_year'                  =>$fisYear,
				'pfct_code'                    =>$pfct_code,
				'plant_code'                   =>$plant_code,
				'tran_code'                    =>$trans_code,
				'series_code'                  =>$series_code,
				'dept_code'                    =>$departCode,
				'vrno'                         =>$vr_no,
				'slno'                         =>$i+1,
				'item_code'                    =>$item_code[$i],
				'item_name'                    =>$item_name[$i],
				//'remark'                     =>$remark[$i],
				'remark'                       =>$remark_item[$i],
				'qty_recvd'                    =>$qty[$i],
				'um'                           =>$unit_M[$i],
				'aq_recvd'                     =>$Aqty[$i],
				'aum'                          =>$add_unit_M[$i],
				'created_by'                   =>$createdBy,

		    );
		   // print_r($i);

			$saveData2 = $gate_entry_nonreturn_body->insert($data);

			
			
		}

		//$requistion->save();

		/*$getbody = DB::table('purchase_indent_body')->find(DB::table('purchase_indent_body')->max('id'));*/

			if ($saveData2) {

	    			$response_array['response'] = 'success';
		            $response_array['lastid'] = $lastid;
		           // $response_array['lastheadid'] = $lastid;

		            $data = json_encode($response_array);

		            print_r($data);

			}else{

					$response_array['response'] = 'error';
	                $response_array['data'] = '' ;

	                $data = json_encode($response_array);

	                print_r($data);
					
			}
			
		


    }

/* --------- create entry in USER_LOG when user submit any form ------*/

	function userLogInsert($loginuserId,$transCode,$seriesCode,$vrno,$perticular,$acc_code){
		
		$userlog = DB::select("SELECT MAX(USERLOGID) as USERLOGID FROM USER_LOG");
		$userlID = json_decode(json_encode($userlog), true); 
		
			if(empty($userlID[0]['USERLOGID'])){
				$user_log_Id = 1;
			}else{
				$user_log_Id = $userlID[0]['USERLOGID']+1;
			}

			$toDate = date("Y-m-d");

			$discptn = $perticular.' - '.$loginuserId;

			$userLog = array(
				'USERLOGID'   =>$user_log_Id,
				'VRDATE'      =>$toDate,
				'USER_CODE'   =>$loginuserId,
				'TRAN_CODE'   =>$transCode,
				'SERIES_CODE' =>$seriesCode,
				'ACC_CODE'    =>$acc_code,
				'VRNO'        =>$vrno,
				'PERTICULAR'  =>$discptn,
				'CREATED_BY'  =>$loginuserId
			);
			DB::table('USER_LOG')->insert($userLog);
		
	}

/* --------- create entry in USER_LOG when user submit any form ------*/



     public function EditVehicleInward(Request $request,$id)
    {	

    	$title                      ='Vehicle Inward';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');

		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'G3'])->get();
		//dd(DB::getQueryLog());

		//printf($userdata['series_list']);exit;
		
		$userdata['tax_code_list']  = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
		//DB::enableQueryLog();
		$userdata['dept_list']      = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']     = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']      = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->get();
		
	//	$userdata['acc_list'] = DB::table('PORDER_HEAD')->groupBY('ACC_CODE')->get();
		$userdata['acc_list'] = DB::table('MASTER_ACC')->groupBY('ACC_CODE')->get();
			//print_r($userdata['acc_list']);exit;
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

    	$vehicleid = base64_decode($id);

       	$vehicledata= DB::table('VEHICLE_INWARD')->WHERE('VEHICLEID', $vehicleid)->get()->first();

       	$vehicleId = $vehicledata->VEHICLEID; 
       	$fromDate = $vehicledata->VRDATE; 
       	$tCode = $vehicledata->TRAN_CODE; 
       	$vrno = $vehicledata->VRNO; 
       	$series_code = $vehicledata->SERIES_CODE; 
       	$series_name = $vehicledata->SERIES_NAME; 
       	$acc_code = $vehicledata->ACC_CODE; 
       	$acc_name = $vehicledata->ACC_NAME; 
       	$vehicle_no = $vehicledata->VEHICLE_NO; 
       	$vehicle_status = $vehicledata->VEHICLE_STATUS; 
       	$estimate_time = $vehicledata->ESTINATE_TIME; 
       	$driver_name = $vehicledata->DRIVER_NAME; 
       	$driver_cont_no = $vehicledata->DRIVER_CONTACT_NO; 

       	 return view('admin.finance.transaction.gate_entry.vehicle_inward.edit_vehicle_inward',$userdata+compact('title','vehicleId','fromDate','tCode','vrno','series_code','series_name','acc_code','acc_name','vehicle_no','vehicle_status','estimate_time','driver_name','driver_cont_no'));

    }


     public function SaveVehicleInward_old(Request $request)
    {
    	
    	

			$createdBy    = $request->session()->get('userid');
			$CompanyCode  = $request->session()->get('company_name');
			$compcode     = explode('-', $CompanyCode);
			$getcompcode  =	$compcode[0];
			$fisYear           =  $request->session()->get('macc_year');
			$comp_nameval      = $request->input('comp_name');
			$fy_year           = $request->input('fy_year');
			$trans_code        = $request->input('trans_code');
			$series_code       = $request->input('series_code');
			$series_name       = $request->input('series_name');
			$plant_code        = $request->input('plant_code');
			$plant_name        = $request->input('plant_name');
			$pfct_code         = $request->input('pfct_code');
			$pfct_name         = $request->input('pfct_name');
			$acc_code          = $request->input('acc_code');
			$acc_name          = $request->input('acc_name');
			$vehicle_no        = $request->input('vehicle_no');
			$vehicle_type        = $request->input('vehicle_type');
			$vehicle_status    = $request->input('vehicle_status');
			$estimate_time     = $request->input('estimate_time');
			$driver_name       = $request->input('driver_name');
			$driver_contact_no = $request->input('driver_contact_no');
			$vr_no             = $request->input('vr_no');
			$vr_date           = $request->input('vr_date');
			$tr_vr_date        = date("Y-m-d", strtotime($vr_date));


			$StoreH = DB::select("SELECT MAX(VEHICLEID) as VEHICLEID FROM VEHICLE_INWARD");
			$headID = json_decode(json_encode($StoreH), true); 
	  //  print_r($headID);exit;
	
			if(empty($headID[0]['VEHICLEID'])){
				$headId = 1;
			}else{
				$headId = $headID[0]['VEHICLEID']+1;
			}

			if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('VEHICLE_INWARD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}


	    	$datahead = array(

	    		'VEHICLEID'         =>$headId,
				'COMP_CODE'         =>$getcompcode,
				'FY_CODE'           =>$fisYear,
				'TRAN_CODE'         =>$trans_code,
				'SERIES_CODE'       =>$series_code,
				'SERIES_NAME'       =>$series_name,
				'PLANT_CODE'        =>$plant_code,
				'PLANT_NAME'        =>$plant_name,
				'PFCT_CODE'         =>$pfct_code,
				'PFCT_NAME'         =>$pfct_name,
				'ACC_CODE'          =>$acc_code,
				'ACC_NAME'          =>$acc_name,
				'VRNO'              =>$NewVrno,
				'VRDATE'            =>$tr_vr_date,
				'VEHICLE_NO'        =>$vehicle_no,
				'VEHICLE_TYPE'      =>$vehicle_type,
				'VEHICLE_STATUS'    =>$vehicle_status,
				'ESTINATE_TIME'     =>$estimate_time,
				'DRIVER_NAME'       =>$driver_name,
				'DRIVER_CONTACT_NO' =>$driver_contact_no,
				'created_by'        =>$createdBy,

			);
	    
	        $saveData = DB::table('VEHICLE_INWARD')->insert($datahead);



			if ($saveData) {

	    			$response_array['response'] = 'success';
		          
		           // $response_array['lastheadid'] = $lastid;

		            $data = json_encode($response_array);

		            print_r($data);

			}else{

					$response_array['response'] = 'error';
	                

	                $data = json_encode($response_array);

	                print_r($data);
					
			}
			
		


    }


  public function UpdateVehicleInward(Request $request)
    {
    	
			$createdBy    = $request->session()->get('userid');
			$CompanyCode  = $request->session()->get('company_name');
			$compcode     = explode('-', $CompanyCode);
			$getcompcode  =	$compcode[0];
			$fisYear           =  $request->session()->get('macc_year');
			$comp_nameval      = $request->input('comp_name');
			$fy_year           = $request->input('fy_year');
			$vehicleId         = $request->input('vehicleId');
			$trans_code        = $request->input('trans_code');
			$series_code       = $request->input('series_code');
			$series_name       = $request->input('series_name');
			$plant_code        = $request->input('plant_code');
			$plant_name        = $request->input('plant_name');
			$pfct_code         = $request->input('pfct_code');
			$pfct_name         = $request->input('pfct_name');
			$acc_code          = $request->input('acc_code');
			$acc_name          = $request->input('acc_name');
			$vehicle_no        = $request->input('vehicle_no');
			$vehicle_status    = $request->input('vehicle_status');
			$estimate_time     = $request->input('estimate_time');
			$driver_name       = $request->input('driver_name');
			$driver_contact_no = $request->input('driver_contact_no');
			$vr_no             = $request->input('vr_no');
			$vr_date           = $request->input('vr_date');
			$vehicle_type        = $request->input('vehicle_type');
			$tr_vr_date        = date("Y-m-d", strtotime($vr_date));


			


	    	$datahead = array(
			
				'TRAN_CODE'         =>$trans_code,
				'SERIES_CODE'       =>$series_code,
				'SERIES_NAME'       =>$series_name,
				'PLANT_CODE'        =>$plant_code,
				'PLANT_NAME'        =>$plant_name,
				'PFCT_CODE'         =>$pfct_code,
				'PFCT_NAME'         =>$pfct_name,
				'ACC_CODE'          =>$acc_code,
				'ACC_NAME'          =>$acc_name,
				'VRNO'              =>$vr_no,
				'VRDATE'            =>$tr_vr_date,
				'VEHICLE_NO'        =>$vehicle_no,
				'VEHICLE_TYPE'      =>$$vehicle_type,
				'VEHICLE_STATUS'    =>$vehicle_status,
				'ESTINATE_TIME'     =>$estimate_time,
				'DRIVER_NAME'       =>$driver_name,
				'DRIVER_CONTACT_NO' =>$driver_contact_no,
				'created_by'        =>$createdBy,

			);
	    
	        $updateData = DB::table('VEHICLE_INWARD')->where('VEHICLEID',$vehicleId)->update($datahead);



			if ($updateData) {

	    			$response_array['response'] = 'success';
		          
		           // $response_array['lastheadid'] = $lastid;

		            $data = json_encode($response_array);

		            print_r($data);

			}else{

					$response_array['response'] = 'error';
	                

	                $data = json_encode($response_array);

	                print_r($data);
					
			}
			
		


    }


    public function ViewVehicleInward_old(Request $request)
    {
    		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

			$title       ='View Vehicle Inward';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			
			$getcompcode = $compcode[0];

	        $fisYear =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	       

	        $data = DB::table('VEHICLE_INWARD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get();
	       

	        }else if($userType=='superAdmin' || $userType=='user'){

	       

          $data = DB::table('VEHICLE_INWARD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get();
	       

	        }
	        else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	     
	       return view('admin.finance.transaction.gate_entry.vehicle_inward.view_vehicle_inward');
	    }else{
			return redirect('/useractivity');
		}
    }


    

}
