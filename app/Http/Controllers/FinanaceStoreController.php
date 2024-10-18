<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store\store_requisition_head;
use App\Models\Store\store_requisition_body;
use App\Models\Store\store_requisition_approve;
use App\Models\Store\store_return_head;
use App\Models\Store\store_return_body;
use Auth;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Schema;
use PDF;
use App\Imports\TableImport;
use App\Imports\TempTableImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\AccountingController;

class FinanaceStoreController extends Controller
{

    
    public function __cunstruct(Request $request,$data){

		//$this->data = "smit@121";

	}

	public function AllTableName(Request $request,$tranCode){

		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$GET_TBL['series_list'] = DB::table('MASTER_CONFIG')->where('COMP_CODE',$getcompcode)->where('TRAN_CODE',$tranCode)->get();
		$GET_TBL['plant_list']  = DB::table('MASTER_PLANT')->where('COMP_CODE',$getcompcode)->get();
		$GET_TBL['dept_list']   = DB::table('MASTER_DEPT')->get();
		$GET_TBL['emp_list']    = DB::table('MASTER_EMP')->get();
		$GET_TBL['cost_list']   = DB::table('MASTER_COST')->get();
		$GET_TBL['item_list']   = DB::table('MASTER_ITEM')->get();
		$GET_TBL['tran_list']   = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$tranCode)->get()->first();
		$GET_TBL['fy_list']     = DB::table('MASTER_FY')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->get();

		return $GET_TBL;

	}


    /* ------ START : STORE REQUISTION ------------- */

    public function AddStoreRequistion(Request $request)
    {
    	//print_r($this->data);exit;
		$title                      ='Store Requistion';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where('COMP_CODE',$getcompcode)->where(['TRAN_CODE'=>'S8'])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']  = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
		//DB::enableQueryLog();
		$userdata['dept_list']      = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']     = DB::table('MASTER_PLANT')->where('COMP_CODE',$getcompcode)->get();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->where('COMP_CODE',$getcompcode)->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']      = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		$userdata['emp_list']      = DB::table('MASTER_EMP')->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->where('COMP_CODE',$getcompcode)->orWhere('COMP_CODE','')->orWhere('COMP_CODE',NULL)->get();
		
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

		$userdata['cost_list']      = DB::table('MASTER_COST')->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		$requistion = DB::table('SREQ_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->where('STORE_ACTION','REQ')->get();

		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','S8')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='S8'");
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

		    return view('admin.finance.transaction.store.store_requistion.store_requisition',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }
   
   	public function SaveStoreRequistion(Request $request)
    {

    	/*echo '<pre>';
    	print_r($request->post());exit;

    	echo '</pre>';*/
    	//
			$createdBy    = $request->session()->get('userid');
			$CompanyCode  = $request->session()->get('company_name');
			$compcode     = explode('-', $CompanyCode);
			$getcompcode  =	$compcode[0];
			$fisYear      =  $request->session()->get('macc_year');
			$comp_nameval = $request->input('comp_name');
			$fy_year      = $request->input('fy_year');
			$pfct_code    = $request->input('pfct_code');
			$trans_code   = $request->input('trans_code');
			$series_code  = $request->input('series_code');
			$series_name  = $request->input('series_name');
			$plant_name   = $request->input('plant_name');
			$pfct_name    = $request->input('pfct_name');
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
			$emp_code     = $request->input('EmpCode');
			$emp_name     = $request->input('EmpName');
			$remark       = $request->input('remark');
			$qty          = $request->input('qty');
			$unit_M       = $request->input('unit_M');
			$Aqty         = $request->input('Aqty');
			$add_unit_M   = $request->input('add_unit_M');
			$scrab_code   = $request->input('scrab_code');
			$batch_no     = $request->input('batch_no');
			$cost_code    = $request->input('cost_code');
			$cost_name    = $request->input('cost_name');

	    	$count = count($item_code);


	   // print_r($departName);exit;
	   
	   
	    $StoreH = DB::select("SELECT MAX(SREQHID) as SREQHID FROM SREQ_HEAD");
		$headID = json_decode(json_encode($StoreH), true); 
	  //  print_r($headID);exit;
	
		if(empty($headID[0]['SREQHID'])){
			$headId = 1;
		}else{
			$headId = $headID[0]['SREQHID']+1;
		}

		   if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('SREQ_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->where('STORE_ACTION','REQ')->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}


  			DB::beginTransaction();

		try {

	    	$datahead = array(

				'COMP_CODE'    =>$getcompcode,
				'FY_CODE'      =>$fisYear,
				'SREQHID'      =>$headId,
				'TRAN_CODE'    =>$trans_code,
				'SERIES_CODE'  =>$series_code,
				'SERIES_NAME'  =>$series_name,
				'PFCT_CODE'    =>$pfct_code,
				'PFCT_NAME'    =>$pfct_name,
				'VRNO'         =>$NewVrno,
				'VRDATE'       =>$tr_vr_date,
				'DEPT_CODE'    =>$departCode,
				'DEPT_NAME'    =>$departName,
				'EMP_CODE'     =>$emp_code,
				'EMP_NAME'     =>$emp_name,
				'PLANT_CODE'   =>$plant_code,
				'PLANT_NAME'   =>$plant_name,
				'DUEDATE'      =>$dueDate,
				'COST_CENTER'  =>$cost_code,
				'COST_NAME'    =>$cost_name,
				'STORE_ACTION' =>'REQ',
				'CREATED_BY'   =>$createdBy,

			);


	    
	      $saveData = DB::table('SREQ_HEAD')->insert($datahead);

	      $lastid= DB::getPdo()->lastInsertId();

	      	$discriptn_page = "Store requistion trans insert done by user";
			$acc_code = '';
			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);
  			
	     //$data = array();
		for ($i = 0; $i < $count; $i++) {

			$StoreB = DB::select("SELECT MAX(SREQBID) as SREQBID FROM SREQ_BODY");

			$bodyID = json_decode(json_encode($StoreB), true); 
	
			if(empty($bodyID[0]['SREQBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['SREQBID']+1;
			}


			$configapp = DB::table('MASTER_CONFIG_APPROVE')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->get()->toArray();

			
			if($configapp){
			//	print_r('hi');exit;
				$FLAG = 0;
			}else{
				//print_r('hello');exit;
				$FLAG = 3;
			}


		    $data_body = array(

				'SREQHID'        =>$headId,
				'SREQBID'        =>$bodyId,
				'COMP_CODE'      =>$getcompcode,
				'FY_CODE'        =>$fisYear,
				'PFCT_CODE'      =>$pfct_code,
				'TRAN_CODE'      =>$trans_code,
				'SERIES_CODE'    =>$series_code,
				'VRNO'           =>$NewVrno,
				'SLNO'           =>$i+1,
				'ITEM_CODE'      =>$item_code[$i],
				'ITEM_NAME'      =>$item_name[$i],
				'REMARK'         =>$remark[$i],
				'SCRAP_CODE'     =>$scrab_code[$i],
				'QTYRECD'        =>$qty[$i],
				'UM'             =>$unit_M[$i],
				'AQTYRECD'       =>$Aqty[$i],
				'AUM'            =>$add_unit_M[$i],
				'REQ_QTYISSUED'  =>$qty[$i],
				'REQ_AQTYISSUED' =>$Aqty[$i],
				'BATCH_NO'       =>$batch_no[$i],
				'STORE_ACTION'   =>'REQ',
				'FLAG'           =>$FLAG,
				'CREATED_BY'     =>$createdBy,

		    );
	
		$saveData1 = DB::table('SREQ_BODY')->insert($data_body);
			

			$getdata = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE', $item_code[$i])->get()->first();

			$yrqtyblock = $getdata->YRQTYBLOCK;
			

			$dataarqty = array(
				'YRQTYBLOCK'  => $yrqtyblock + $qty[$i],
			);

			$saveData12 = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE', $item_code[$i])->update($dataarqty);
			
		}


		$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('FY_CODE',$fisYear)->where('COMP_CODE',$getcompcode)->get()->toArray();
			//dd(DB::getQueryLog());
			//print_r($checkvrnoExist);exit;

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$getcompcode,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);

			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

		//$requistion->save();


		$Storebody = DB::select("SELECT MAX(VRNO) as VRNO FROM SREQ_BODY");

		$getbody = json_decode(json_encode($Storebody), true);


		$VR_NO	= $getbody[0]['VRNO'];
		//print_r($VR_NO);exit;

		$getvrnoCount  = DB::table('SREQ_BODY')->where('VRNO',$VR_NO)->get()->toArray();

		$sl_no=array();

		foreach ($getvrnoCount as $key){
			
			$sl_no[]= $key->SLNO;
		}

		$vrnocount = count($getvrnoCount);
		//print_r($getvrnoCount);exit;

		$getapprove =	DB::SELECT("SELECT t1.*,t2.* FROM 	MASTER_CONFIG_APPROVE t1  LEFT JOIN USER_APPROVE_IND t2 ON t2.APPROVE_USER = t1.APPROVE_IND WHERE t1.TRAN_CODE='$trans_code' AND t1.SERIES_CODE='$series_code'");

		if($getapprove){

			$configapprove=array();
			$approveind=array();
			$userid=array();

			foreach ($getapprove as $key) {
				# code...
				$configapprove[] =$key->TRAN_CODE;
				$approveind[]    =$key->APPROVE_IND;
				$userid[]        =$key->USER_CODE;
				$level_no[]      =$key->LAVEL_NAME;

			}

			$count = count($configapprove);

			

			for ($i=0; $i < $count; $i++) { 

				for ($j=0; $j < $vrnocount; $j++) { 

					$StoreA = DB::select("SELECT MAX(SREQAID) as SREQAID FROM SREQ_APPROVE");

					$ApproveID = json_decode(json_encode($StoreA), true); 
	
					if(empty($ApproveID[0]['SREQAID'])){
					$AppId = 1;
					}else{
					$AppId = $ApproveID[0]['SREQAID']+1;
					}
			
					if($level_no[$i]==1){

						$approve_status=3;

						$data_approve = array(
						'SREQHID'        =>$headId,
						'SREQAID'        =>$AppId,
						'COMP_CODE'      =>$getcompcode,
						'FY_CODE'        =>$fisYear,
						'PFCT_CODE'      =>$pfct_code,
						'TRAN_CODE'      =>$trans_code,
						'SERIES_CODE'    =>$series_code,
						'VRNO'           =>$NewVrno,
						'SLNO'           =>$sl_no[$j],
						'VRDATE'         =>$tr_vr_date,
						'APPROVE_IND'    =>$approveind[$i],
						'APPROVE_USER'   =>$userid[$i],
						'LEVEL_NO'       =>$level_no[$i],
						'APPROVE_STATUS' =>$approve_status,
						'APPROVE_DATE'   =>date('Y-m-d'),
						'APPROVE_REMARK' =>'',
						'FLAG'           =>'0',
						'LASTUSER'       =>'0',
						'CREATED_BY'     => $createdBy,
					);

					}else{ 
						
						$countmain=$count-1;
							
						if($countmain==$i){

							$lastusr='3';
						}else{
							$lastusr='0';
						}

						$data_approve = array(
							    'SREQHID'        =>$headId,
								'SREQAID'        =>$AppId,
								'COMP_CODE'      =>$getcompcode,
								'FY_CODE'        =>$fisYear,
								'PFCT_CODE'      =>$pfct_code,
								'TRAN_CODE'      =>$trans_code,
								'SERIES_CODE'    =>$series_code,
								'SLNO'           =>$sl_no[$j],
								'VRNO'           =>$NewVrno,
								'VRDATE'         =>$tr_vr_date,
								'APPROVE_IND'    =>$approveind[$i],
								'APPROVE_USER'   =>$userid[$i],
								'LEVEL_NO'       =>$level_no[$i],
								'APPROVE_STATUS' =>0,
								'APPROVE_DATE'   =>date('Y-m-d'),
								'APPROVE_REMARK' =>'',
								'FLAG'           =>'',
								'LASTUSER'       =>$lastusr,
								'CREATED_BY'     =>$createdBy,
							);
					}

					$saveData2 = DB::table('SREQ_APPROVE')->insert($data_approve);

					
				}
			}

			/*if ($saveData2) {

	    			$response_array['response'] = 'success';
		            $response_array['lastid'] = $headID;
		            $data = json_encode($response_array);

		            print_r($data);

			}else{

					$response_array['response'] = 'error';
	                $response_array['data'] = '' ;

	                $data = json_encode($response_array);

	                print_r($data);
					
			}*/
			
		}


		    DB::commit();
			$response_array['response'] = 'success';
			$response_array['lastid'] = $headID;
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

    public function store_requistion_msg(Request $request,$saveData){

		if ($saveData== 'true') {

			$request->session()->flash('alert-success', 'Store Requistion Was Successfully Added...!');
			return redirect('/Transaction/Store/View-Store-Requistion');

		} else {

			$request->session()->flash('alert-error', 'Store Requistion Can Not Added...!');
			return redirect('/Transaction/Store/View-Store-Requistion');

		}
	}

  public function eproc_sueeccss_msg(Request $request,$saveData){

		if ($saveData== 'true') {

			$request->session()->flash('alert-success', 'Eproc Data Was Successfully Added...!');
			return redirect('/logistic/e-proc-status');

		} else {

			$request->session()->flash('alert-error', 'Eproc Data Can Not Added...!');
			return redirect('/logistic/e-proc-status');

		}
	}



    public function ViewStoreRequistion(Request $request){

		$compName = $request->session()->get('company_name');
		$compcode    = explode('-', $compName);
		$getcompcode =	$compcode[0];
		$fisYear     =  $request->session()->get('macc_year');
		$title       ='View Store Requistion';
		$userid      = $request->session()->get('userid');

     	if($request->ajax()) {

	        $data = DB::table('SREQ_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->where('STORE_ACTION', '=', 'REQ')->get();

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){
	        return view('admin.finance.transaction.store.store_requistion.view_store_requisition');
	    }else{
			return redirect('/useractivity');
		}
    }


    public function ViewStoreChildRequistion(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$requistion = DB::table('SREQ_BODY')->where('SREQHID', $headid)->where('VRNO', $vrno)->where('STORE_ACTION', 'REQ')->get()->toArray();
	    	

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

/* -------- END : STORE REQUISITION -------- */

/* -------- START : STORE ISSUE -------- */
	
	public function AddStoreIssue(Request $request){

		$title       ='Store Issue';
		
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$macc_year   = $request->session()->get('macc_year');
		$tranCode    ='S9';
		
		$allTblName  =$this->AllTableName($request,$tranCode);

		$userdata['series_list'] = $allTblName['series_list'];
		$userdata['dept_list']   = $allTblName['dept_list'];
		$userdata['plant_list']  = $allTblName['plant_list'];
		$userdata['cost_list']   = $allTblName['cost_list'];
		$userdata['trans_list']  = $allTblName['tran_list'];
		$userdata['item_list']   = $allTblName['item_list'];
		$userdata['emp_list']   = $allTblName['emp_list'];
		
		$userdata['requstion_list'] = DB::select("SELECT * FROM `SREQ_BODY` WHERE STORE_ACTION='REQ' AND  (FLAG=1 OR FLAG=3)  AND REQ_QTYISSUED !='0.000' GROUP BY VRNO");

		$userdata['jobcard_list']   = DB::select("SELECT * FROM JOBCARD_BODY B LEFT JOIN  JOBCARD_HEAD H ON H.JCHID = B.JCHID WHERE (B.FLAG=1 OR B.FLAG=3) AND H.STATUS=0  GROUP BY B.VRNO");

		$userdata['order_list']     = DB::select("SELECT * FROM `PORDER_BODY` WHERE  (FLAG=1 OR FLAG=3)  GROUP BY VRNO");

		foreach ($allTblName['fy_list'] as $key) {	

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}
			
		if(isset($CompanyCode)){

		    return view('admin.finance.transaction.store.store_issue.store_issue',$userdata+compact('title'));

		}else{

			return redirect('/useractivity');
		}

	}

	public function SaveStoreIssue(Request $request){

		$createdBy   = $request->session()->get('userid');
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$fisYear     = $request->session()->get('macc_year');
		$trans_date  = $request->input('vrDate');
		$vr_date     = date("Y-m-d", strtotime($trans_date));
		$trans_code  = $request->input('tranCode');
		$series_code = $request->input('seriesCode');
		$series_name = $request->input('seriesName');
		$vr_no       = $request->input('vrNo');
		$plant_code  = $request->input('plantcode');
		$plant_name  = $request->input('plantname');
		$pfct_code   = $request->input('pfctCode');
		$pfct_name   = $request->input('pfctname');
		$departCode  = $request->input('dept_code');
		$departName  = $request->input('deptname');
		$empCode     = $request->input('emp_code');
		$empName     = $request->input('emp_name');
		$cost_code   = $request->input('cost_center_code');
		$cost_name   = $request->input('cost_center_name');

		$item_Code   = $request->input('itemcodeC');
		$item_name   = $request->input('item_name');
		$remark      = $request->input('remark');
		$req_qty     = $request->input('req_qty');
		$req_unit_M  = $request->input('req_unit_M');
		$req_Aqty    = $request->input('req_Aqty');
		$req_Aunit   = $request->input('req_add_unit_M');
		$qty         = $request->input('qty');
		$unit_M      = $request->input('unit_M');
		$Aqty        = $request->input('Aqty');
		$add_unit_M  = $request->input('add_unit_M');
		$batch_no    = $request->input('batch_no');
		$req_HeadId  = $request->input('reqHeadId');
		$req_bodyId  = $request->input('req_bodyId');

		$tblRow      = $request->input('tblRow');

	   	$StoreH = DB::select("SELECT MAX(SREQHID) as SREQHID FROM SREQ_HEAD");
		$headID = json_decode(json_encode($StoreH), true); 
	
		if(empty($headID[0]['SREQHID'])){
			$headId = 1;
		}else{
			$headId = $headID[0]['SREQHID']+1;
		}

	   if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->first();

		if($vrno_Exist){
			$NewVrno = $vrno_Exist[0]->LAST_NO +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {

	    	$datahead = array(

				'SREQHID'      =>$headId,
				'COMP_CODE'    =>$getcompcode,
				'FY_CODE'      =>$fisYear,
				'PFCT_CODE'    =>$pfct_code,
				'PFCT_NAME'    =>$pfct_name,
				'TRAN_CODE'    =>$trans_code,
				'SERIES_CODE'  =>$series_code,
				'SERIES_NAME'  =>$series_name,
				'VRNO'         =>$NewVrno,
				'VRDATE'       =>$vr_date,
				'PLANT_CODE'   =>$plant_code,
				'PLANT_NAME'   =>$plant_name,
				'DEPT_CODE'    =>$departCode,
				'DEPT_NAME'    =>$departName,
				'EMP_CODE'     =>$empCode,
				'COST_CENTER'  =>$cost_code,
				'COST_NAME'    =>$cost_name,
				'STORE_ACTION' =>'ISSUE',
				'CREATED_BY'   =>$createdBy,

			);

	   		DB::table('SREQ_HEAD')->insert($datahead);

	  
			for ($i = 0; $i < count($tblRow); $i++) {

			 	$StoreB = DB::select("SELECT MAX(SREQBID) as SREQBID FROM SREQ_BODY");

				$bodyID = json_decode(json_encode($StoreB), true); 
	
				if(empty($bodyID[0]['SREQBID'])){
					$bodyId = 1;
				}else{
					$bodyId = $bodyID[0]['SREQBID']+1;
				}

		    	$data_body = array(

					'SREQHID'         =>$headId,
					'SREQBID'         =>$bodyId,
					'COMP_CODE'       =>$getcompcode,
					'FY_CODE'         =>$fisYear,
					'PFCT_CODE'       =>$pfct_code,
					'PFCT_NAME'       =>$pfct_name,
					'TRAN_CODE'       =>$trans_code,
					'SERIES_CODE'     =>$series_code,
					'SERIES_NAME'     =>$series_name,
					'VRNO'            =>$NewVrno,
					'SLNO'            =>$i+1,
					'ITEM_CODE'       =>$item_Code[$i],
					'ITEM_NAME'       =>$item_name[$i],
					'REMARK'          =>$remark[$i],
					//'SCRAP_CODE'    =>$scrab_code[$i],
					'QTYRECD'         =>$req_qty[$i],
					'AQTYRECD'        =>$req_Aqty[$i],
					'QTYISSUED'       =>$qty[$i],
					'AQTYISSUED'      =>$Aqty[$i],
					'BATCH_NO'        =>$batch_no[$i],
					'UM'              =>$unit_M[$i],
					'AUM'             =>$add_unit_M[$i],
					/*'RET_QTYISSUED' =>$qty[$i],
					'RET_AQTYISSUED'  =>$Aqty[$i],*/
					'STORE_ACTION'    =>'ISSUE',
					'CREATED_BY'      =>$createdBy,

		    	);

				DB::table('SREQ_BODY')->insert($data_body);

				if($req_HeadId && $req_bodyId[$i]){

					$data_qty = array(
					
						'QTYISSUED'  =>$qty[$i],
						'AQTYISSUED' =>$Aqty[$i],
					);

					DB::table('SREQ_BODY')->where('SREQHID',$req_HeadId)->where('SREQBID',$req_bodyId[$i])->update($data_qty);
				}
					
			}/* /. main for loop*/

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->toArray();

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$getcompcode,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);

			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

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

    public function store_issue_msg(Request $request,$saveData){

		if ($saveData =='true') {

			$request->session()->flash('alert-success', 'Store Issue Was Successfully Added...!');
			return redirect('/Transaction/Store/View-Store-Issue');

		} else {

			$request->session()->flash('alert-error', 'Store Issue Can Not Added...!');
			return redirect('/Transaction/Store/View-Store-Issue');

		}
	}

    public function ViewStoreIssue(Request $request){

    	$title       ='View Store Issue';
		$userid      = $request->session()->get('userid');
		$userType    = $request->session()->get('usertype');
		$compName    = $request->session()->get('company_name');
		$compcode    = explode('-', $compName);
		$getcompcode =	$compcode[0];
		$fisYear     =  $request->session()->get('macc_year');

	    if($request->ajax()) {

	        if($userType=='admin' || $userType=='Admin'){
	     
	        	$data = DB::table('SREQ_HEAD')->where('FY_CODE', $fisYear)->where('COMP_CODE', $getcompcode)->where('STORE_ACTION', '=', 'ISSUE')->get();

	        }else if($userType=='superAdmin' || $userType=='user'){

       	 		$data = DB::table('SREQ_HEAD')->where('FY_CODE', $fisYear)->where('COMP_CODE', $getcompcode)->where('STORE_ACTION', '=', 'ISSUE')->get();
	        }else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){
	       return view('admin.finance.transaction.store.store_issue.view_store_issue');
	    }else{
			return redirect('/useractivity');
		}
    }

/* -------- END : STORE ISSUE -------- */

    public function EditStoreRequistion(Request $request,$headid,$bodyid,$vrno){

		$id      =base64_decode($headid);
		$body_id =base64_decode($bodyid);
		$vrno    =base64_decode($vrno);
    	$title = 'Edit Store Requistion';
    	
    	if($id!=''){
    	   	//DB::enableQueryLog();
			$userdata['getStoreRequ'] = DB::select("SELECT SH.*,SB.*,SB.SREQBID as bodyid FROM SREQ_BODY SB LEFT JOIN SREQ_HEAD SH ON SH.SREQHID = SB.SREQHID AND SH.VRNO = SB.VRNO WHERE SH.SREQHID='$id' AND SH.VRNO='$vrno'");
			//dd(DB::getQueryLog());
			
	    $CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                = $compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'S8'])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']  = DB::table('MASTER_TDS_RATE')->groupBy('TDS_CODE')->get();
		
		//DB::enableQueryLog();
		$userdata['dept_list']      = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']     = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']      = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		/*$requistion = store_requisition_head::where('comp_name', $CompanyCode)->where('fiscal_year',$macc_year)->get();*/

   		$requistion = DB::table('SREQ_HEAD')->where('STORE_ACTION','REQ')->get();

		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$CompanyCode' AND TRAN_CODE='S8'");
		//	print_r($vr_No_list);exit;
		//dd(DB::getQueryLog());
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userdata['last_num']   = $key->LAST_NO;
					$userdata['to_num']     = $key->TO_NO;
					$userdata['trans_head'] = $key->TRAN_CODE;
				}

			}else{

					$userdata['last_num']  ='';
					$userdata['to_num']  ='';
					$userdata['trans_head']  ='';

			}

			return view('admin.finance.transaction.store.store_requistion.edit_store_requisition', $userdata+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'HSN Id Not Found...!');
			return redirect('/finance/view-hsn-rate-master');
		}

    }



    public function StatusStoreRequisition(Request $request){

		$userId         = $request->session()->get('userid');
		$tran_code      = $request->input('tran_code');
		$series_code    = $request->input('series_code');
		$vr_no          = $request->input('vr_no');
		$sl_no          = $request->input('sl_no');
		$approve_remark = $request->input('approve_remark_requistion');
		



        if ($userId!='') {

        		 //DB::enableQueryLog();
        	$getlevleno = DB::table('SREQ_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->get()->first();

        	//dd(DB::getQueryLog());


        	 $levno = $getlevleno->LEVEL_NO;
        	// print_r($getlevleno);exit;

        	 $levelNo =  $levno + 1;

        	 $data1=array(
    			'APPROVE_STATUS'=>'3'
    		);

        	// DB::enableQueryLog();

			$UpdateLevel = DB::table('SREQ_APPROVE')->where('LEVEL_NO', $levelNo)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);

			//dd(DB::getQueryLog());

    		$data=array(
    			'APPROVE_STATUS'=>'1',
    			'APPROVE_REMARK'=>$approve_remark,
    			'FLAG'=>'1',

    		);


			$Updatedata = DB::table('SREQ_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data);


			$selectdata = DB::table('SREQ_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->where('LASTUSER','3')->where('APPROVE_STATUS','1')->get()->first();


			if ($selectdata) {

				$data1=array(
	    			'APPROVE_REMARK'=>$approve_remark,
	    			'FLAG'=>'1',

	    		);

	    		$Updatedata1 = DB::table('SREQ_BODY')->where('TRAN_CODE',$selectdata->TRAN_CODE)->where('VRNO',$selectdata->VRNO)->where('SLNO',$selectdata->SLNO)->update($data1);

			}else{

				$Updatedata1 = TRUE;

			}

			

			

			if($Updatedata && $Updatedata1){

				$request->session()->flash('alert-success', 'Purchase Order Approved Successfully...!');
				return redirect('finance/user-approval-list/'.base64_encode($userId));

			} else {

				$request->session()->flash('alert-error', 'Purchase Order Can Not Approved...!');
				return redirect('finance/user-approval-list/'.base64_encode($userId));

			}

		}else{

		$request->session()->flash('alert-error', 'HSN Rate Data Not Found...!');
		return redirect('/finance/view-hsn-rate-master');

		}

	}



    function RejectStoreRequistion(Request $request){

    	    $userid    = $request->session()->get('userid');

    	//print_r($userid);exit;
			$approval_remark = $request->input('approve_remark_requistion');
			$vr_no           = $request->input('vr_no');
			$tran_code       = $request->input('tran_code');
			$sl_no           = $request->input('sl_no');
			$approve_ind     = $request->input('approve_ind');


//print_r($approve_ind);exit;

				$data1=array(
	    			'APPROVE_REMARK'=>$approval_remark,
	    			'FLAG'=>'2',

	    		);

	    	$Updatedata = DB::table('SREQ_BODY')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);


	    	$data12=array(
	    			'REJECTED_STATUS'=>1,
	    			'APPROVE_STATUS'=>2,

	    		);

	    	$Updatedata12 = DB::table('SREQ_APPROVE')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data12);

	    		

	    	$DeleteData = DB::table('SREQ_APPROVE')->where('APPROVE_IND',$approve_ind)->where('VRNO',$vr_no)->where('APPROVE_USER',$userid)->where('SLNO',$sl_no)->delete();



			
			if ($Updatedata && $DeleteData) {

	            $response_array['response'] = 'success';
                $response_array['data'] = '' ;

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

	}



public function GetStoreRequsitionForApp(Request $request){

    	$response_array = array();

        if ($request->ajax()) {

			$tran_code   = $request->input('tran_code');
			$series_code = $request->input('series_code');
			$slno        = $request->input('slno');
			$vr_no       = $request->input('vr_no');
			$approve_ind = $request->input('approve_ind');
          //  print_r($series_code);exit;
        
            $fetch_reocrd = DB::SELECT("SELECT p1.* FROM SREQ_BODY p1  WHERE p1.TRAN_CODE='$tran_code' AND p1.VRNO='$vr_no' AND p1.SLNO='$slno'");

       
        
            if ($fetch_reocrd!='') {

               

                $response_array['response'] = 'success';
                $response_array['data'] = $fetch_reocrd ;
                $response_array['approve_ind'] = $approve_ind ;

                $data = json_encode($response_array);

                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '' ;

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


public function Get_Item_Data_Requistion(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$itemCode = $request->input('ItemCode');
	    	//$do_no = $request->input('do_no');
	  
	    	$qcount = $request->input('q');
	    	

	    	$item_bal_data = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE', $itemCode)->get()->first();

	    	if($item_bal_data){

	    	$yropqty     = $item_bal_data->YROPQTY;
			$yrQtyRecd   = $item_bal_data->YRQTRECD;
			$yrQtyIssued = $item_bal_data->YRQTYISSUED;
			$yrQtyBlock  = $item_bal_data->YRQTYBLOCK;
			$batchNo     = $item_bal_data->BATCH_NO;
	    	

	    	$totalstock = floatval($yropqty) + floatval($yrQtyRecd) - floatval($yrQtyIssued) - floatval($yrQtyBlock);
	    	}else{

	    		$totalstock ='0';
	    		$batchNo ='';

	    	}
			
	    	
	    	$item_um_aum_list = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemCode)->get();

	    	
	    	$fetch_hsn_code = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->toArray();


	    	
	    	

    		if ($item_um_aum_list && $fetch_hsn_code) {

				$response_array['response']   = 'success';
				$response_array['data']       = $item_um_aum_list;
				$response_array['data_hsn']   = $fetch_hsn_code;
				$response_array['qcount']     = $qcount;
				$response_array['totalstock'] = $totalstock;
				$response_array['batchNo']    = $batchNo;
				
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


   /* STORE ISSUE*/

	public function GetitemByReqnum(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$reqno      = $request->input('reqno');
			$orderno    = $request->input('orderno');
			$jobcard_no = $request->input('jobcard_no');

	    	//print_r($reqno);exit;
	    	//$accnum = $request->input('accnum');

	    	/*$enquiryData = DB::select("SELECT * FROM `enquiry_body` WHERE vr_no='$enquiryno' AND quatation_tcode IS NULL AND quatation_series_code IS NULL");*/
//DB::enableQueryLog();



	    	if($reqno){

	    		$itemListData = DB::select("SELECT * FROM `SREQ_BODY` WHERE VRNO='$reqno' AND (FLAG=1 OR FLAG=3)  AND STORE_ACTION='REQ' AND REQ_QTYISSUED !=0.000");

	    	}else if($orderno){

	    		$itemListData =	DB::SELECT("SELECT t1.*,t2.PORDERHID,t2.VRNO FROM JOB_WORK_ORDER_ISSUE t1  LEFT JOIN PORDER_BODY t2 ON t2.PORDERHID = t1.PORDERHID WHERE t2.VRNO='$orderno'");

	    	}else if($jobcard_no){

	    		$itemListData =	DB::SELECT("SELECT * FROM JOBCARD_BODY  WHERE VRNO='$jobcard_no'");
	    	}else{

	    		 $itemListData = DB::table('MASTER_ITEM')->get();
	    	}

	    	/*
	    	if($reqno== ''){
	    		$itemListData = DB::table('MASTER_ITEM')->get();

	    	}else{

	    		$itemListData = DB::select("SELECT * FROM `SREQ_BODY` WHERE VRNO='$reqno' AND (FLAG=1 OR FLAG=3)  AND STORE_ACTION='REQ' AND REQ_QTYISSUED !=0.000");
	    	}*/

	    	//dd(DB::getQueryLog());


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



	public function Get_Item_UM_AUM_Req_No(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$itemCode = $request->input('ItemCode');
	    	$qcount = $request->input('q');
	    	$reqnum = $request->input('reqno');

	    
	    	$item_req_qty = DB::table('SREQ_BODY')->where('ITEM_CODE', $itemCode)->where('VRNO',$reqnum)->where('STORE_ACTION','REQ')->get();

	    	//print_r($item_req_qty);exit;

	    	$getpostCode =	DB::SELECT("SELECT t1.*,t2.POST_CODE FROM MASTER_ITEM t1  LEFT JOIN MASTER_ITEMTYPE t2 ON t2.ITEMTYPE_CODE = t1.ITEMTYPE_CODE WHERE t1.ITEM_CODE='$itemCode'");

	    	//print_r($getpostCode);exit;
	    	
	    	$item_um_aum_list = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemCode)->get();

	    	$item_bal_data = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE', $itemCode)->get()->first();

	    	$item_bal_data = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE', $itemCode)->get()->first();
	    	if($item_bal_data){

	    	$yropqty     = $item_bal_data->YROPQTY;
			$yrQtyRecd   = $item_bal_data->YRQTRECD;
			$yrQtyIssued = $item_bal_data->YRQTYISSUED;
			$yrQtyBlock  = $item_bal_data->YRQTYBLOCK;
			$bacth_no     = $item_bal_data->BATCH_NO;
			$MAVGRATE     = $item_bal_data->MAVGRATE;
	    	$totalstock = floatval($yropqty) + floatval($yrQtyRecd) - floatval($yrQtyIssued) - floatval($yrQtyBlock);

	    
	   		 }else{
	   		 	$totalstock='0';
	   		 	$bacth_no='';
	  		 }

	    	$fetch_hsn_code = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->toArray();

    		if ($item_um_aum_list && $fetch_hsn_code) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_um_aum_list;
	            $response_array['data_hsn'] = $fetch_hsn_code;
	            $response_array['qcount'] = $qcount;
	            if($item_req_qty){
	            $response_array['req_qty'] = $item_req_qty;
	        	}else{
	        	$response_array['req_qty'] ='';
	       		 }
	            $response_array['bacth_no'] = $bacth_no;
	            $response_array['totalstock'] = $totalstock;
	            $response_array['MAVGRATE'] = $MAVGRATE;
	            $response_array['getpostCode'] = $getpostCode;

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

    public function Get_Item_Grn_Data(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$ItemCode = $request->input('ItemCode');
	    	//$accnum = $request->input('accnum');

	    	/*$enquiryData = DB::select("SELECT * FROM `enquiry_body` WHERE vr_no='$enquiryno' AND quatation_tcode IS NULL AND quatation_series_code IS NULL");*/

	    	if($ItemCode){

	    		$getData = DB::table('GRN_BODY')->where('ITEM_CODE',$ItemCode)->get();

	    		//print_r($getData);exit;
	    	}
	    	

    		if($getData){

    			$response_array['response'] = 'success';
	            $response_array['data'] = $getData;

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




	public function store_return_msg(Request $request,$saveData){

		if ($saveData=='true') {

			$request->session()->flash('alert-success', 'Store Return Was Successfully Added...!');
			return redirect('/Transaction/Store/View-Store-Return');

		} else {

			$request->session()->flash('alert-error', 'Store Return Can Not Added...!');
			return redirect('/Transaction/Store/View-Store-Return');

		}
	}

    public function EditStoreIssue(Request $request,$headid,$bodyid,$vrno){

    	$id =base64_decode($headid);
    	$body_id =base64_decode($bodyid);
    	$vrno  =base64_decode($vrno);
    	$title = 'Edit Store Issue';
    	
    	if($id!=''){
    	   	//DB::enableQueryLog();
			$userdata['getStoreIssues'] = DB::select("SELECT t1.*,t2.*,t2.id as bodyid FROM store_requisition_bodies t2 LEFT JOIN store_requisition_heads t1 ON t1.id = t2.store_requistion_head_id AND t1.vr_no = t2.vrno WHERE t1.id='$id' AND t1.vr_no='$vrno'");
			//dd(DB::getQueryLog());
			
			$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('master_comp')->get();
		
		$userdata['getacc']         = DB::table('master_party')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('master_config')->where(['tran_code'=>'S9'])->get();
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
		
		$userdata['rate_list']      = DB::table('rate_value')->get();
//DB::enableQueryLog();
		$userdata['requstion_list']    = DB::table('SREQ_BODY')->where('FLAG','3')->where('REQ_QTYISSUED', '!=' , 0.000)->where('STORE_ACTION', 'REQ')->groupBy('VRNO')->get();
//dd(DB::getQueryLog());
		$getdate = DB::table('master_fy')->where(['comp_code'=>$getcompcode,'fy_code'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->fy_from_date;
					$userdata['toDate']   =  $key->fy_to_date;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		/*$requistion = store_requisition_head::where('comp_name', $CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		/*$requisition_head = new store_requisition_head();

   		$requistion = $requisition_head->getrequsitionData($CompanyCode,$macc_year)->where('store_action','issue');*/

   		$requistion = DB::table('SREQ_HEAD')->where('COMP_CODE',$CompanyCode)->where('FY_CODE',$macc_year)->where('STORE_ACTION','issue')->get();

		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->vr_no;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `master_vrseq` WHERE comp_name='$CompanyCode' AND fiscal_year='$macc_year' AND tran_code='S9'");
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

			return view('admin.finance.transaction.store.store_issue.edit_store_issue', $userdata+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'HSN Id Not Found...!');
			return redirect('/finance/view-hsn-rate-master');
		}

    }


    public function ViewStoreChildIssue(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$issue = DB::table('SREQ_BODY')->where('SREQHID', $headid)->where('VRNO', $vrno)->where('STORE_ACTION', 'ISSUE')->get()->toArray();
	    	

    		if($issue) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $issue;
	         

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

   /* STORE ISSUE*/

   /*STORE RETURN */
  public function AddStoreReturn(Request $request)
    {
    	//print_r($this->data);exit;
		$title                      ='Store Return';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                = $compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where('COMP_CODE',$getcompcode)->where(['TRAN_CODE'=>'R3'])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']  = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
		//DB::enableQueryLog();
		$userdata['dept_list']      = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']     = DB::table('MASTER_PLANT')->where('COMP_CODE',$getcompcode)->get();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->where('COMP_CODE',$getcompcode)->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']      = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->where('COMP_CODE',$getcompcode)->orWhere('COMP_CODE','')->orWhere('COMP_CODE',NULL)->get();
		
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		/*$userdata['issue_list']    = DB::table('store_requisition_bodies')->where(['store_action'=>'issue'])->groupBy('vrno')->get();*/

		$userdata['issue_list'] = DB::table('SREQ_BODY')->where('STORE_ACTION','ISSUE')->where('RET_QTYISSUED', '!=' , 0.000)->groupBy('VRNO')->get();
		//print_r($userdata['issue_list']);exit;

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		/*$requistion = store_requisition_head::where('comp_name', $CompanyCode)->where('fiscal_year',$macc_year)->get();*/

   		$return = DB::table('SRET_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();

	//print_r($return);exit;

		   	$vrseqnum = '';
			foreach ($return as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','R3')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='R3'");
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

		    return view('admin.finance.transaction.store.store_return.store_return',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}

	}
     

     public function GetitemByIssuenum(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$issue_no = $request->input('issue_no');
	    	
	    	if($issue_no){
	    		
	    		$itemListData = DB::table('SREQ_BODY')->where('VRNO', $issue_no)->where('STORE_ACTION', 'ISSUE')->where('REQ_QTYISSUED', '!=' , 0.000)->get()->toArray();

	    		//print_r($itemListData);exit;
	    	}else{
	    		
	    		$itemListData = '';
	    		/*$itemListData = DB::table('master_item_finance')->get();*/
	    		/*$itemListData = store_requisition_body::where('vrno', $issue_no)->where('store_action', 'issue')->where('return_issue_qty', '!=' , 0.00)->get()->toArray();*/
	    		//print_r($itemListData);exit;
	    	}

	    	
	    		//print_r($itemListData);exit;
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


    public function Get_Item_UM_AUM_Issue_No(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$itemCode = $request->input('ItemCode');
	    	$qcount = $request->input('q');
	    	$issuenum = $request->input('issue_no');

	    
	    	$item_req_qty = DB::table('SREQ_BODY')->where('ITEM_CODE', $itemCode)->where('VRNO',$issuenum)->where('STORE_ACTION','ISSUE')->get();

	    	$item_bal_data = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE', $itemCode)->get()->first();

	    	if($item_bal_data){

	    		$bacth_no = $item_bal_data->BATCH_NO;
	    		$mavg_rate = $item_bal_data->MAVGRATE;
	    	}else{
	    		$bacth_no='';
	    		$mavg_rate ='';
	    	}
	    	
	    	$item_um_aum_list = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemCode)->get();

	    	$fetch_hsn_code = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->toArray();


  			$getpostCode =  DB::SELECT("SELECT t1.*,t2.POST_CODE FROM MASTER_ITEM t1  LEFT JOIN MASTER_ITEMTYPE t2 ON t2.ITEMTYPE_CODE = t1.ITEMTYPE_CODE WHERE t1.ITEM_CODE='$itemCode'");



    		if ($item_um_aum_list && $fetch_hsn_code) {

				$response_array['response']    = 'success';
				$response_array['data']        = $item_um_aum_list;
				$response_array['data_hsn']    = $fetch_hsn_code;
				$response_array['qcount']      = $qcount;
				$response_array['req_qty']     = $item_req_qty;
				$response_array['bacth_no']    = $bacth_no;
				$response_array['mavg_rate']   = $mavg_rate;
				$response_array['getpostCode'] = $getpostCode;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['getpostCode'] ='';

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['getpostCode'] ='';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function SaveStoreReturn(Request $request)
    {

    	/*echo '<pre>';
    	print_r($request->post());exit;
    	echo '</pre>';*/

    		$createdBy     = $request->session()->get('userid');
			$CompanyCode   = $request->session()->get('company_name');
			$compcode      = explode('-', $CompanyCode);
			$getcompcode   = $compcode[0];
			$fisYear       = $request->session()->get('macc_year');
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
			$qty           = $request->input('qty');
			$unit_M        = $request->input('unit_M');
			$Aqty          = $request->input('Aqty');
			$add_unit_M    = $request->input('add_unit_M');

			$req_qty        = $request->input('req_qty');
			$req_unit_M     = $request->input('req_unit_M');
			$req_Aqty       = $request->input('req_Aqty');
			$req_add_unit_M = $request->input('req_add_unit_M');
			$reqnumber      = $request->input('rqnumbyissue');
			$batch_no       = $request->input('batch_no');

			$totalMvRate    = $request->input('totalMvRate');
			$post_code      = $request->input('post_code');
			$item_post_code = $request->input('item_post_code');
			$itemmvrate     = $request->input('itemmvrate');
			$cost_code      = $request->input('cost_code');
			$cost_name      = $request->input('cost_name');

			DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','SR')->delete();	


			//print_r($reqnumber);exit;

	    	$count = count($item_code);

	   	   	$StoreH = DB::select("SELECT MAX(SRETHID ) as SRETHID  FROM SRET_HEAD");
			$headID = json_decode(json_encode($StoreH), true); 
	
			if(empty($headID[0]['SRETHID'])){
			$headId = 1;
			}else{
			$headId = $headID[0]['SRETHID']+1;
			}


			if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('SRET_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}
 
			DB::beginTransaction();

			try {

	    	$datahead = array(

	    		'SRETHID'      =>$headId,
				'COMP_CODE'    =>$getcompcode,
				'FY_CODE'      =>$fisYear,
				'PFCT_CODE'    =>$pfct_code,
				'PFCT_NAME'    =>$pfct_name,
				'TRAN_CODE'    =>$trans_code,
				'SERIES_CODE'  =>$series_code,
				'SERIES_NAME'  =>$series_name,
				'PLANT_CODE'   =>$plant_code,
				'PLANT_NAME'   =>$plant_name,
				'VRNO'         =>$NewVrno,
				'VRDATE'       =>$tr_vr_date,
				'DEPT_CODE'    =>$departCode,
				'DEPT_NAME'    =>$departName,
				'DUEDATE'      =>$dueDate,
				'COST_CENTER'  =>$cost_code,
				'COST_NAME'    =>$cost_name,
				'CREATED_BY'   =>$createdBy,

			);
	    
	    $saveData = DB::table('SRET_HEAD')->insert($datahead);

	    $discriptn_page = "Store return trans insert done by user";
		$acc_code = '';
		$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);

	     $lastid= DB::getPdo()->lastInsertId();

	    $seriesPost   = array(
            'CR_AMT'      => $totalMvRate,
            'IND_GL_CODE' => $post_code,
            'TCFLAG'      => 'SR',
            'CREATED_BY'  => $createdBy,
                  
        );

        DB::table('INDICATOR_TEMP')->insert($seriesPost);
		
	     //$data = array();
		for ($i = 0; $i < $count; $i++) {

			$StoreB = DB::select("SELECT MAX(SRETBID) as SRETBID FROM SRET_BODY");

			$bodyID = json_decode(json_encode($StoreB), true); 
		
			if(empty($bodyID[0]['SRETBID'])){
				$bodyId = 1;
			}else{
				$bodyId = $bodyID[0]['SRETBID']+1;
			}


		    $data_body = array(

				'SRETHID'        =>$headId,
				'SRETBID'        =>$bodyId,
				'COMP_CODE'      =>$getcompcode,
				'FY_CODE'        =>$fisYear,
				'PFCT_CODE'      =>$pfct_code,
				'TRAN_CODE'      =>$trans_code,
				'SERIES_CODE'    =>$series_code,
				'VRNO'           =>$NewVrno,
				'SLNO'           =>$i+1,
				'ITEM_CODE'      =>$item_code[$i],
				'ITEM_NAME'      =>$item_name[$i],
				'REMARK'         =>$remark[$i],
				'RET_QTYISSUED'  =>$qty[$i],
				'UM'             =>$unit_M[$i],
				'RET_AQTYISSUED' =>$Aqty[$i],
				'AUM'            =>$add_unit_M[$i],
				'QTYISSUED'      =>$req_qty[$i],
				'AQTYISSUED'     =>$req_Aqty[$i],
				'STORE_ACTION'   =>'RETURN',
				'BATCH_NO'       =>$batch_no[$i],
				'CREATED_BY'     =>$createdBy,

		    );

		     $saveData2 = DB::table('SRET_BODY')->insert($data_body);
		   // print_r($i);
		     $dataupdate = array(

				'QTYISSUED'  => floatval($req_qty[$i]) - floatval($qty[$i]),
				'AQTYISSUED' =>  floatval($req_Aqty[$i]) - floatval($Aqty[$i]),
				'RET_QTYISSUED'  => floatval($qty[$i]),
				'RET_AQTYISSUED' => floatval($Aqty[$i]),
				
			);

			$saveData11 = DB::table('SREQ_BODY')->where('ITEM_CODE', $item_code[$i])->where('VRNO',$reqnumber)->where('STORE_ACTION','ISSUE')->update($dataupdate);
		


		   $legdH = DB::select("SELECT MAX(ITEM_LEDGER_ID) as ITEM_LEDGER_ID FROM ITEM_LEDGER");
			$legdID = json_decode(json_encode($legdH), true); 
		
			if(empty($legdID[0]['ITEM_LEDGER_ID'])){
				$legd_Id = 1;
			}else{
				$legd_Id = $legdID[0]['ITEM_LEDGER_ID']+1;
			}


			$itemledger = array(

				'ITEM_LEDGER_ID' =>$legd_Id,
				'COMP_CODE'      =>$getcompcode,
				'FY_CODE'        =>$fisYear,
				'VRDATE'         =>$tr_vr_date,
				'VRNO'           =>$NewVrno,
				'SLNO'           =>$i+1,
				'TRAN_CODE'      =>$trans_code,
				'PFCT_CODE'      =>$pfct_code,
				'SERIES_CODE'    =>$series_code,
				'ITEM_CODE'      =>$item_code[$i],
				'ITEM_NAME'      =>$item_name[$i],
				'NARRATION'      =>$remark[$i],
				'QTYRECD'        =>$qty[$i],
				'CREATED_BY'     =>$createdBy,

		    );

			$saveData13 = DB::table('ITEM_LEDGER')->insert($itemledger);

			$itembal = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE', $item_code[$i])->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->where('PLANT_CODE', $plant_code)->orderBy('SLNO','DESC')->get()->first();	

			$qtyrecd = $itembal->YRQTRECD;
			//print_r($itembal);exit;
			if($itembal){

				$itemslno = $itembal->SLNO;

				$slnoitem = $itemslno + 1;
			}else{
				$slnoitem = $i + 1;
			}
			

			$itemdata = array(

				'YRQTRECD'   =>$qtyrecd + $qty[$i],
				
		    );

		//	$saveData4 = DB::table('MASTER_ITEMBAL')->insert($itemdata);
			$updateData4 = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE', $item_code[$i])->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->update($itemdata);

		

			$checkEmptyInldg = DB::table('INDICATOR_TEMP')->where('TCFLAG','SR')->where('CREATED_BY',$createdBy)->where('IND_GL_CODE',$item_post_code[$i])->get()->toArray();

			if(empty($checkEmptyInldg)){

				$itmD   = array(
		            'DR_AMT'      => $itemmvrate[$i],
		            'IND_GL_CODE' => $item_post_code[$i],
		            'TCFLAG'      => 'SR',
		            'CREATED_BY'  => $createdBy,
		                  
	            );

	            DB::table('INDICATOR_TEMP')->insert($itmD);
			}else{
				$getglAl = DB::table('INDICATOR_TEMP')->where('TCFLAG','SR')->where('CREATED_BY',$createdBy)->where('IND_GL_CODE',$item_post_code[$i])->get()->toArray();

				$addAmt = $getglAl[0]->DR_AMT + $itemmvrate[$i];

          		$itmDUp   = array(
          			'DR_AMT'      => $addAmt,
              	);

              	DB::table('INDICATOR_TEMP')->where('TCFLAG','SR')->where('CREATED_BY',$createdBy)->where('IND_GL_CODE',$item_post_code[$i])->update($itmDUp);
			}

			
		} /* ./ main loop*/

		$getstoreIsuD = DB::table('INDICATOR_TEMP')
				->select('INDICATOR_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')
           		->leftjoin('MASTER_GL', 'INDICATOR_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
            	->where('INDICATOR_TEMP.TCFLAG','SR')
            	->where('INDICATOR_TEMP.CREATED_BY',$createdBy)
            	->get()->toArray();
            	
        $storeICount = count($getstoreIsuD);

		for($q=0;$q<$storeICount;$q++){

			$gledgT = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
			$gledgID = json_decode(json_encode($gledgT), true); 
					
			if(empty($gledgID[0]['GLTRANID'])){
				$g_ledg_Id = 1;
			}else{
				$g_ledg_Id = $gledgID[0]['GLTRANID']+1;
			}

			$srnol = $q+1;
			$ledgData = array(
				'GLTRANID'    => $g_ledg_Id,
				'COMP_CODE'   => $getcompcode,
				'FY_CODE'     => $fisYear,
				'TRAN_CODE'   => $trans_code,
				'SERIES_CODE' => $series_code,
				'VRNO'        => $NewVrno,
				'SLNO'        => $srnol,
				'VRDATE'      => $tr_vr_date,
				'COST_CODE'   => $cost_code,
				'COST_NAME'   => $cost_name,
				'GL_CODE'     => $getstoreIsuD[$q]->IND_GL_CODE,
				'GL_NAME'     => $getstoreIsuD[$q]->GL_NAME,
				'DRAMT'       => $getstoreIsuD[$q]->DR_AMT,
				'CRAMT'       => $getstoreIsuD[$q]->CR_AMT,
				'CREATED_BY'  => $getstoreIsuD[$q]->CREATED_BY,
			);

			DB::table('GL_TRAN')->insert($ledgData);

		}

	//	$requistion->save();

			/*if ($saveData2) {

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


    public function ViewStoreReturn(Request $request)
    {

    	//print_r('hi');exit;
    		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

	        $title ='View Store Return';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $compName = $request->session()->get('company_name');

	        $compcode                   = explode('-', $compName);
			$getcompcode                =	$compcode[0];

	        $fisYear =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	        $data = DB::table('SRET_HEAD')->where('FY_CODE', '=', $fisYear)->where('COMP_CODE', '=', $getcompcode)->get();
           
	

	        }else if($userType=='superAdmin' || $userType=='user'){

	         $data = DB::table('SRET_HEAD')->where('FY_CODE', '=', $fisYear)->where('COMP_CODE', '=', $getcompcode)->get();

	        }
	        else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	       return view('admin.finance.transaction.store.store_return.view_store_return');
	    }else{
			return redirect('/useractivity');
		}
    }


     public function ViewStoreChildReturn(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$issue =DB::table('SRET_BODY')->where('SRETHID', $headid)->where('VRNO', $vrno)->get()->toArray();
	    	

    		if($issue) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $issue;
	         

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

    public function EditStoreReturn(Request $request,$headid,$bodyid,$vrno){

    	$id =base64_decode($headid);
    	$body_id =base64_decode($bodyid);
    	$vrno  =base64_decode($vrno);
    	$title = 'Edit Store Return';
    	
    	if($id!=''){
    	   	//DB::enableQueryLog();
			$userdata['getStoreReturn'] = DB::select("SELECT t1.*,t2.*,t2.id as bodyid FROM store_return_bodies t2 LEFT JOIN store_return_heads t1 ON t1.id = t2.store_return_head_id AND t1.vr_no = t2.vrno WHERE t1.id='$id' AND t1.vr_no='$vrno'");
			//dd(DB::getQueryLog());

		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('master_comp')->get();
		
		$userdata['getacc']         = DB::table('master_party')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('master_config')->where(['tran_code'=>'R3'])->get();
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
		
		$userdata['rate_list']      = DB::table('rate_value')->get();

		/*$userdata['issue_list']    = DB::table('store_requisition_bodies')->where(['store_action'=>'issue'])->groupBy('vrno')->get();*/

		$userdata['issue_list'] = store_requisition_body::where('store_action','issue')->where('return_issue_qty', '!=' , 0.00)->groupBy('vrno')->get();
		//print_r($userdata['issue_list']);exit;

		$getdate = DB::table('master_fy')->where(['comp_code'=>$getcompcode,'fy_code'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->fy_from_date;
					$userdata['toDate']   =  $key->fy_to_date;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		/*$requistion = store_requisition_head::where('comp_name', $CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		$return_head = new store_return_head();

   		$return = $return_head->getreturnData($CompanyCode,$macc_year);

	//print_r($return);exit;

		   	$vrseqnum = '';
			foreach ($return as $key) {
				$vrseqnum =  $key->vr_no;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `master_vrseq` WHERE comp_name='$CompanyCode' AND fiscal_year='$macc_year' AND tran_code='R3'");
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
		

			return view('admin.finance.transaction.store.store_return.edit_store_return', $userdata+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'HSN Id Not Found...!');
			return redirect('/finance/view-hsn-rate-master');
		}

    }


    public function GetitemByScrabCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$getscrab_code = $request->input('getscrab_code');

	    	//print_r($getscrab_code);exit;
	    	//$accnum = $request->input('accnum');

	    	/*$enquiryData = DB::select("SELECT * FROM `enquiry_body` WHERE vr_no='$enquiryno' AND quatation_tcode IS NULL AND quatation_series_code IS NULL");*/

	    	if($getscrab_code=='Fresh Material'){
	    		

	    		$issueListData = DB::table('SREQ_BODY')->where('STORE_ACTION','ISSUE')->where('QTYISSUED', '!=',0.000)->whereNull('SCRAP_CODE')->groupBy('VRNO')->get();

	    		$itemListData = DB::table('MASTER_ITEM')->get()->whereNull('SCRAP_CODE')->toArray();

	    	//print_r($issueListData);exit;

	    	}else{
	    		
	    		/*$issueListData = store_requisition_body::where('store_action','issue')->where('return_issue_qty', '!=',0.00)->where('scrab_code','=',null)->groupBy('vrno')->get();*/

	    		$itemListData = DB::table('MASTER_ITEM')->get()->toArray();
	    		$issueListData='';


	    		/*$issueListData = DB::table('master_item_finance')->get();*/
	    		
	    	}

	    	

    		if($itemListData) {

    			$response_array['response'] = 'success';
	            $response_array['data'] =     $issueListData;
	            $response_array['itemdata'] = $itemListData;

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


    public function GetitemReturnByIssuenum(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$issue_no = $request->input('issue_no');
	    	$scrab_code = $request->input('scrab_code');
	    	//print_r($scrab_code);exit;
	    	//$accnum = $request->input('accnum');

	    	/*$enquiryData = DB::select("SELECT * FROM `enquiry_body` WHERE vr_no='$enquiryno' AND quatation_tcode IS NULL AND quatation_series_code IS NULL");*/

	    	if($issue_no){
	    		
	    		$itemListData = DB::table('SREQ_BODY')->where('VRNO', $issue_no)->where('STORE_ACTION', 'ISSUE')->where('QTYISSUED', '!=' , 0.000)->whereNull('SCRAP_CODE')->get()->toArray();
	    	}else{
	    		
	    		$itemListData = DB::table('MASTER_ITEM')->get()->toArray();
	    		/*$itemListData = DB::table('master_item_finance')->get();*/
	    		/*$itemListData = store_requisition_body::where('vrno', $issue_no)->where('store_action', 'issue')->where('return_issue_qty', '!=' , 0.00)->get()->toArray();*/
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
   /*STORE RETURN */

/* ------------- SIMULATION FOR STORE ISSUE ------------ */
	
	public function simulationForStoreIssue(Request $request){

		$seriesGl     = $request->seriesGl;
		$totalRate    = $request->totalRate;
		$itmePostCode = $request->itmePostCode;
		$itmemvAmt    = $request->itmemvAmt;
		$itemCode     = $request->itemCode;
		$userId       = $request->session()->get('userid');
		$itemCount = count($itemCode);

		DB::table('SIMULATION_TEMP')->where('TCFLAG','SI')->where('CREATED_BY',$userId)->delete();

		$seriesGlD = array(
			'IND_GL_CODE' => $seriesGl,
			'DR_AMT'      => $totalRate,
			'CR_AMT'      => '',
			'TCFLAG'      => 'SI',
			'CODE_NAME'   => 'Series Post Code',
			'CREATED_BY'  => $userId,
                
        );

        DB::table('SIMULATION_TEMP')->insert($seriesGlD);

		for($i=0;$i<$itemCount;$i++){

			$checkempty = DB::table('SIMULATION_TEMP')->where('TCFLAG','SI')->where('IND_GL_CODE',$itmePostCode[$i])->where('CREATED_BY',$userId)->get()->toArray();

			if(empty($checkempty)){
				$idary = array(
					'IND_GL_CODE' => $itmePostCode[$i],
					'DR_AMT'      => '',
					'CR_AMT'      => $itmemvAmt[$i],
					'CODE_NAME'   => 'Item Type Gl Code',
					'TCFLAG'      => 'SI',
					'CREATED_BY'  => $userId,
                        
                );

                DB::table('SIMULATION_TEMP')->insert($idary);
			}else{
				$checkExist = DB::table('SIMULATION_TEMP')->where('TCFLAG','SI')->where('IND_GL_CODE',$itmePostCode[$i])->where('CREATED_BY',$userId)->get()->toArray();
				 $updateId = $checkExist[0]->CREATED_BY;
				$NewItmAmt = $checkExist[0]->CR_AMT + $itmemvAmt[$i];

				$newAmt = array(
					'CR_AMT'      => $NewItmAmt,
					'TCFLAG'      => 'SI',
					'CREATED_BY'  => $userId,
                );

                DB::table('SIMULATION_TEMP')->where('TCFLAG','SI')->where('IND_GL_CODE',$itmePostCode[$i])->where('CREATED_BY',$updateId)->update($newAmt);
			}
		} /* /. for loop */

		$response_array = array();
  		$simData = DB::select("SELECT t1.*,t2.GL_NAME as glName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE WHERE t1.TCFLAG='SI' AND t1.CREATED_BY='$userId'");

  		if ($simData) {

          	$response_array['response'] = 'success';
            $response_array['data_sim'] = $simData;
            echo $data = json_encode($response_array);
              //print_r($data);
      	}else{

			$response_array['response'] = 'error';
			$response_array['data_sim'] = '' ;
			$data = json_encode($response_array);
			print_r($data);
        
     	}

	}

/* ------------- SIMULATION FOR STORE ISSUE ------------ */

/* ------------- SIMULATION FOR STORE ISSUE ------------ */
	
	public function simulationForStoreReturn(Request $request){

		$seriesGl     = $request->seriesGl;
		$totalRate    = $request->totalRate;
		$itmePostCode = $request->itmePostCode;
		$itmemvAmt    = $request->itmemvAmt;
		$itemCode     = $request->itemCode;
		$userId       = $request->session()->get('userid');
		$itemCount = count($itemCode);

		DB::table('SIMULATION_TEMP')->where('TCFLAG','SR')->where('CREATED_BY',$userId)->delete();

		$seriesGlD = array(
			'IND_GL_CODE' => $seriesGl,
			'DR_AMT'      => '',
			'CR_AMT'      => $totalRate,
			'CODE_NAME'   => 'Series Post Code',
			'TCFLAG'      => 'SR',
			'CREATED_BY'  => $userId,
                
        );

        DB::table('SIMULATION_TEMP')->insert($seriesGlD);

		for($i=0;$i<$itemCount;$i++){

			$checkempty = DB::table('SIMULATION_TEMP')->where('TCFLAG','SR')->where('IND_GL_CODE',$itmePostCode[$i])->where('CREATED_BY',$userId)->get()->toArray();

			if(empty($checkempty)){
				$idary = array(
					'IND_GL_CODE' => $itmePostCode[$i],
					'DR_AMT'      => $itmemvAmt[$i],
					'CR_AMT'      => '',
					'TCFLAG'      => 'SR',
					'CODE_NAME'   => 'Item Type Gl Code',
					'CREATED_BY'  => $userId,
                        
                );

                DB::table('SIMULATION_TEMP')->insert($idary);
			}else{
				$checkExist = DB::table('SIMULATION_TEMP')->where('TCFLAG','SR')->where('IND_GL_CODE',$itmePostCode[$i])->where('CREATED_BY',$userId)->get()->toArray();
				 $updateId = $checkExist[0]->CREATED_BY;
				$NewItmAmt = $checkExist[0]->DR_AMT + $itmemvAmt[$i];

				$newAmt = array(
					'DR_AMT'      => $NewItmAmt,
					'TCFLAG'      => 'SR',
					'CREATED_BY'  => $userId,
                );

                DB::table('SIMULATION_TEMP')->where('TCFLAG','SR')->where('IND_GL_CODE',$itmePostCode[$i])->where('CREATED_BY',$updateId)->update($newAmt);
			}
		} /* /. for loop */

		$response_array = array();
  		$simData = DB::select("SELECT t1.*,t2.GL_NAME as glName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE WHERE t1.TCFLAG='SR' AND t1.CREATED_BY='$userId'");

  		if ($simData) {

          	$response_array['response'] = 'success';
            $response_array['data_sim'] = $simData;
            echo $data = json_encode($response_array);
              //print_r($data);
      	}else{

			$response_array['response'] = 'error';
			$response_array['data_sim'] = '' ;
			$data = json_encode($response_array);
			print_r($data);
        
     	}

	}

/* ------------- SIMULATION FOR STORE ISSUE ------------ */
   public function GetItemByStoreIssue(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$povrno        = $request->input('povrno');
			$series_code   = $request->input('series_code');
			$orderno       = $request->input('orderno');
			$orderseries   = $request->input('orderseries');
			$jobcard_no    = $request->input('jobcard_no');
			$jobcardseries = $request->input('jobcardseries');

	    	//DB::enableQueryLog();
	    	/*$itmList =  DB::table('PORDER_HEAD')->select('PORDER_HEAD.*', 'MASTER_ACC.*','PORDER_BODY.*')
           		->leftjoin('MASTER_ACC', 'PORDER_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->leftjoin('PORDER_BODY', 'PORDER_HEAD.PORDERHID', '=', 'PORDER_BODY.PORDERHID')
            	->where([['PORDER_HEAD.VRNO','=',$povrno],['PORDER_HEAD.ACC_CODE','=',$account_code],['PORDER_HEAD.SERIES_CODE','=',$series_code]])
            	->get();*/

            if($povrno){
            	$itmList = DB::select("SELECT * FROM `SREQ_BODY` WHERE VRNO='$povrno'  AND (FLAG=1 OR FLAG=3)  AND STORE_ACTION='REQ'");

            }else if($orderno){
            	$itmList =	DB::SELECT("SELECT t1.*,t2.PORDERHID,t2.VRNO,t2.VRDATE,t2.SERIES_CODE FROM JOB_WORK_ORDER_ISSUE t1  LEFT JOIN PORDER_BODY t2 ON t2.PORDERHID = t1.PORDERHID WHERE t2.VRNO='$orderno'");

            }else if($jobcard_no){

            	$itmList =	DB::SELECT("SELECT t1.*,t2.JCHID,t2.VRNO,t2.VRDATE,t2.SERIES_CODE FROM JOBCARD_BODY t1  LEFT JOIN JOBCARD_HEAD t2 ON t2.JCHID = t1.JCHID WHERE t2.VRNO='$jobcard_no'");
            }else{
            	$itmList='';
            }

           

           //print_r($itmList);exit;
//
           // dd(DB::getQueryLog());

    		if ($itmList) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itmList;

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



 public function importDoExcel(Request $request) 
    {
     
		$table           = 'TEMP_DO_ORDER';

		$config_table    = 'MASTER_EXCELCONFIG';

		$CompanyName     = $request->session()->get('company_name');
	
		$fisYear =  $request->session()->get('macc_year');

		$getcompcode = explode('-', $CompanyName);

		$comp_code   =$getcompcode[0];

		$do_excel_code = $request->input('do_excel_code');

		//print_r($do_excel_code);exit;

	
		$column_name = DB::table('MASTER_EXCELCONFIG')->select('EXCEL_COL','VALIDATION_STATUS','TEMPEXCEL_COL','TBL_COL')->where('TRAN_CODE','DO')->where('EXLCONFIG_CODE',$do_excel_code)->get()->toArray();

		$configTableCount = count($column_name);

		//print_r($configTableCount);exit;


		$itemcolumn = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','DO')->where('EXLCONFIG_CODE',$do_excel_code)->where('VALIDATION_STATUS',2)->get()->toArray();

		$acc_code = DB::table('MASTER_ACC')->select('ACC_CODE')->get()->toArray();
		
		$tempvrno        = $request->input('tempvrno');
		
		

		$temptransporter = $request->input('temptransporter');
		

		$createdBy        = $request->session()->get('userid');

		//print_r($createdBy);exit;
		
		$file            = $request->file('file');

		 DB::table('TEMP_DELIVERY_ORDER')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->delete();

       $excelData = Excel::toArray(new TempTableImport(),$file);

     /*  $excelData =  Excel::import(new TableImport($table,$config_table,$CompanyName,$macc_year,$tempvrno,$temptransporter,$column_name),$file);*/

        $excelColcount = count($excelData[0][0]);

      if($configTableCount > 0){

        
        $ColumnArray = json_decode( json_encode($column_name), true);

        $tableColData =[];
        $getArray2 =[];
        $tempExcelCol =[];
        $tblExcelCol =[];
        $tblmerger=[];
        foreach($ColumnArray as $key){

       		$tempExcelCol[] = $key;
			array_push($tableColData, $key['EXCEL_COL']);
			array_push($getArray2, $key['VALIDATION_STATUS']);
			array_push($tempExcelCol, $key['TEMPEXCEL_COL']);
			array_push($tblExcelCol, $key['TBL_COL']);
			array_push($tblmerger, $key);
       		

       	}

       	$tblcount = count($tblmerger);

     
       	/* ----excel column name------- */
         $getExcel =[];
         foreach($excelData[0][0] as $row){

       		$getExcel[] = $row;

       	}
       	/* ----excel column name------- */

       	/* ----excel all data ------- */
       	$getAllExcelData =[];
         foreach($excelData[0] as $prdrow){

       		array_push($getAllExcelData, $prdrow);

       	}
       	/* ----excel all data ------- */

       	$getAllExcelCount = count($getAllExcelData);

       //	print_r($getAllExcelData);exit;

       	$diifCol = array_diff($getExcel,$tableColData);
       
       	$difColCount = count($diifCol);

       	$tempAry = array();
       	if($difColCount != $excelColcount){
       		if($difColCount > $excelColcount){
       			$remainingCount = $difColCount - $excelColcount;
       		}else if($difColCount < $excelColcount){
       			$remainingCount = $excelColcount - $difColCount;
       		}else if($difColCount == $excelColcount){
       			$remainingCount = $excelColcount - $difColCount;
       		}
       		
       		for($k=0;$k<$excelColcount;$k++){
       			$tempAry[$k]='wagon';
       		}
       	}else{
       		
       	}

       	$insertexcelArray=[];
       	$insertexcelArrayDt=[];

       	$getKeyFrAry = array_keys($diifCol);
       	for($n=0;$n<$remainingCount;$n++){
       		if(isset($getKeyFrAry[$n])){

    			unset($tempAry[$getKeyFrAry[$n]]);
       		}
    		}
    		$newAry = $tempAry + $diifCol;

    		
       	$newAryCnt = count($newAry);

       	$bankAry = array();
       	for($r=0;$r<$newAryCnt;$r++){
       		if($r== 0){
       			array_push($bankAry, $newAry[$r]);
       		}else{

       			$findKey = array_keys($newAry);
       			
       			if($findKey > $r){
       				array_push($bankAry, $newAry[$r]);
       			}else{
       				array_push($bankAry, $newAry[$r]);
       			}
       		}
       	}

       	/* -- excel row count -- */
       	for($w=0;$w< $getAllExcelCount;$w++){
       		$n= $w+1;
       		/* -- excel col count -- */
       		for ($e = 0; $e < $excelColcount; $e++){

       			if($bankAry[$e] == 'wagon'){

       			}else{

       			unset($getAllExcelData[$n][$bankAry[$e]]);
       			}

       			
       		}
       		
       	//	print_r($getAllExcelData[$n]);exit;
       		if(isset($getAllExcelData[$n])){
/*
       			$val = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($getAllExcelData[$n]['ALLOCATION DATE']));*/

       			if($do_excel_code=='DOYARD'){

       				$excel_date = $getAllExcelData[$n]['ALLOCATION DATE']; 
					$unix_date = ($excel_date - 25569) * 86400;
					$excel_date = 25569 + ($unix_date / 86400);
					$unix_date = ($excel_date - 25569) * 86400;
					$insertexcelArrayDt[] = gmdate("Y-m-d h:i:s", $unix_date);
					//$insertexcelArrayDt[] = $unix_date;
       			    $arrKey = array_search('ALLOCATION DATE', array_keys($getAllExcelData[$n]));

       			    $alloc_qty = $getAllExcelData[$n]['ALLOCATED QTY'];

       			    $allocation_qty =  number_format(floatval($alloc_qty), 3);

       			    $insertexcelArrayDt1[] = $allocation_qty;

       			    $arrKey1 = array_search('ALLOCATED QTY', array_keys($getAllExcelData[$n]));

       			   
       			}else{


       				$excel_date = $getAllExcelData[$n]['EWB Valid Date']; 
       			//print_r($excel_date);exit;
					/*$unix_date = ($excel_date - 25569) * 86400;
					$excel_date = 25569 + ($unix_date / 86400);
					$unix_date = ($excel_date - 25569) * 86400;*/
				    $insertexcelArrayDt[] =$excel_date;

				   // print_r($insertexcelArrayDt);
       			    $arrKey = array_search('EWB Valid Date', array_keys($getAllExcelData[$n]));

       			    $alloc_qty = $getAllExcelData[$n]['Qty'];

       			    $allocation_qty =  number_format((float)$alloc_qty, 3, '.', '');

					$insertexcelArrayDt1[] = $allocation_qty;

       			    $arrKey1 = array_search('Qty', array_keys($getAllExcelData[$n]));
       			}

       			
       			
       			$insertexcelArray[]  = $getAllExcelData[$n];

       		}

       	}


      	//print_r($insertexcelArray);exit;

      $dataexcelCount =count($insertexcelArray); 

        $temptblcol =[];
		$tempExcelcol =[];
		for ($b = 0; $b < $tblcount; $b++) {

			$temptblcol[] = $tblmerger[$b]['TBL_COL'];
			$tempExcelcol[] = $tblmerger[$b]['TEMPEXCEL_COL'];

		  // print_r($tblmerger[$b]['TBL_COL']);

	    }


	  //  print_r($tempExcelcol);exit;

	    $arryCombConfigTbl = array_combine($temptblcol, $tempExcelcol);

	   //print_r($arryCombConfigTbl);exit;

	   if($do_excel_code=='DOYARD'){

		 $ConfigAcc      = $arryCombConfigTbl['ACC_NAME'];
		 $ConfigItemName = $arryCombConfigTbl['REMARK'];
	   }else{
	   	 $ConfigAcc = $arryCombConfigTbl['CP_NAME'];
	   	 $ConfigAccCode = $arryCombConfigTbl['CP_CODE'];
	   	 $ConfigItemName = $arryCombConfigTbl['ITEM_NAME'];
	   	 $ConfigInvcNo = $arryCombConfigTbl['DO_INVC_NO'];


	   	 //$ConfigItem2 = $arryCombConfigTbl['ITEM_NAME'];
	   	 
	   }

		$ConfigItem     = $arryCombConfigTbl['ITEM_CODE'];
		
		$ConfigDo       = $arryCombConfigTbl['DORDER_NO'];

		$ConfigQty       = $arryCombConfigTbl['QTY'];

		$ConfigSlNo       = $arryCombConfigTbl['SLNO'];

       //print_r($insertexcelArray);exit;

       for ($t = 0; $t < $dataexcelCount; $t++) {

       	$arrayIndex = array_values($insertexcelArray[$t]);
       	$arrayIndex1 = $insertexcelArrayDt[$t];

       	$arrayIndex2 = $insertexcelArrayDt1[$t];

       	$arrayIndexCount = count($arrayIndex);
       //	print_r($arrayIndexCount);exit;
       	$new_array = [];
       	
       	$SRNO = 1;
			foreach ($arrayIndex as $value){

				$SRNO++;
			} 

       

       		for ($p = 0; $p < $arrayIndexCount; $p++) {

       			$q = $p +1;

       		
       			if($p==$arrKey){
       				$new_array['COL'.$q] = $arrayIndex1;

       			}else if($p==$arrKey1){
       				$new_array['COL'.$q] = $arrayIndex2;

       			}else{

       				$new_array['COL'.$q] = $arrayIndex[$p];
       				
       			}
       			
       		}
    //   exit;
       		//print_r($new_array);

       		$saveData =	DB::insert("INSERT INTO `TEMP_DELIVERY_ORDER` (COMP_CODE,FY_CODE,CREATED_BY,".implode(' , ', array_keys($new_array)).") VALUES ('$comp_code','$fisYear','$createdBy','".implode("' , '", array_values($new_array))."')");

       		//dd(DB::getQueryLog());

       		$lastId =	DB::getPdo()->lastInsertId();

       		$tempDoOrder = DB::table('TEMP_DELIVERY_ORDER')->where('ID',$lastId)->get()->first();

       		$tempItemCode = $tempDoOrder->$ConfigItem;

       		$tempItemName = $tempDoOrder->$ConfigItemName; 

       		$tempAccName =  $tempDoOrder->$ConfigAcc;

       		$tempDoNumber =  $tempDoOrder->$ConfigDo;

       		$tempQty =  $tempDoOrder->$ConfigQty;
       		$tempslno =  $tempDoOrder->$ConfigSlNo;

       		
       		//DB::enableQueryLog();

       		//echo '<pre>';




       		$explodName  =explode(' ',$tempItemName);


       		$firstName = strlen($explodName[0]);

       			if($firstName > 2){
       				$itemAliasName = $explodName[0];
       			}else{

       				$itemAliasName = $explodName[0].' '.$explodName[1];
       			}

       		//print_r($itemAliasName);
       		/*$item_code = DB::table('MASTER_ITEM')->where('ITEMTYPE_CODE','TP')->where('ITEM_NAME', 'LIKE', '%'.$itemAliasName.'%')->get()->toArray();*/

       		$item_code = DB::select("SELECT ITEM_CODE,ITEM_NAME FROM MASTER_ITEM WHERE ITEM_NAME LIKE CONCAT('%',SUBSTRING_INDEX('$itemAliasName',' ',IF(LENGTH(SUBSTRING_INDEX('$itemAliasName',' ',1))<=2,2,1)),'%') AND ITEMTYPE_CODE = 'TP'");

       		//print_r($item_code);

       		//echo '</pre>';

       /*		$item_code= DB::select("SELECT * FROM MASTER_ITEM WHERE ITEM_CODE='$tempItemCode' AND ALIAS_NAME LIKE '%'".'$tempItemName'."");*/

       		//dd(DB::getQueryLog());



       		if($item_code){

       			//print_r($tempItemName);

       			foreach($item_code as $key){

       					$dataItem = array(

       						$ConfigItem => $tempItemCode.'~'.$key->ITEM_NAME.'~'.$key->ITEM_CODE,
       					);

       			$update2 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigItem,$tempItemCode)->where('COMP_CODE',$comp_code)->where('CREATED_BY',$createdBy)->update($dataItem);

       			}

       		}else{

       			$dataitem = array(

       				'ITEM_STATUS' => 'YES',
       				'NOT_FOUND_STATUS' => 'NOT FOUND',

       			);

       		  $update1 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigItem,$tempItemCode)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataitem);
       		  
       		}


       		if($do_excel_code=='DOYARD'){



       			$acc_name = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->where('ACC_NAME',$tempAccName)->orWhere('ALIAS_NAME', 'LIKE', '%'.$tempAccName.'%')->get()->toArray();

 
		       		if($acc_name){

		       			foreach($acc_name as $key){

		       					$dataAcc = array(

		       						$ConfigAcc => $key->ACC_NAME.'~'.$key->ACC_CODE.'~'.$key->ACATG_CODE
		       					);

		       			$update2 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigAcc,$tempAccName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataAcc);

		       			}

		       		}else{

		       			$dataAcc = array(

		       				'ACC_STATUS' => 'YES',
		       				'NOT_FOUND_STATUS' => 'NOT FOUND',

		       			);

		       		  $update3 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigAcc,$tempAccName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataAcc);

		       		}

		       	$do_number = DB::table('DORDER_BODY')->where('DORDER_NO',$tempDoNumber)->where('SLNO',$tempslno)->where('COMP_CODE',$comp_code)->get()->toArray();

				       	if(empty($do_number)){

		       			$firstdo = array(

		       				'DO_EXIST_STATUS' => 'NO',
		       				'DO_UPDATE_STATUS' => 0,
		       			);

		   				DB::table('TEMP_DELIVERY_ORDER')->where($ConfigDo,$tempDoNumber)->where($ConfigQty,$tempQty)->where($ConfigSlNo,$tempslno)->where('COMP_CODE',$comp_code)->where('CREATED_BY',$createdBy)->update($firstdo);


		       		}else{

		       		
		       			$chkExist = DB::table('DORDER_BODY')->where('DORDER_NO',$tempDoNumber)->where('QTY',$tempQty)->where('SLNO',$tempslno)->where('COMP_CODE',$comp_code)->get()->toArray();

		       			if($chkExist){

		       				$existdo = array(

			       				'DO_EXIST_STATUS' => 'EXIST',
			       				'DO_UPDATE_STATUS' => 0,

			       			);

			   				DB::table('TEMP_DELIVERY_ORDER')->where($ConfigDo,$tempDoNumber)->where($ConfigSlNo,$tempslno)->where('COMP_CODE',$comp_code)->update($existdo);
		       			}else{

		       				$existNOTdo = array(

			       				'DO_EXIST_STATUS' => 'YES',
			       				'DO_UPDATE_STATUS' => 1,

			       			);

		       			
			   				DB::table('TEMP_DELIVERY_ORDER')->where($ConfigDo,$tempDoNumber)->where($ConfigQty,$tempQty)->where($ConfigSlNo,$tempslno)->where('COMP_CODE',$comp_code)->where('CREATED_BY',$createdBy)->update($existNOTdo);

		       			}


		       			
		       			

		       		}

       		}else{

       			 $tempTempInvcNo =  $tempDoOrder->$ConfigInvcNo;

       			$tempAccCode =  $tempDoOrder->$ConfigAccCode;



       			$acc_name = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->where('ACC_NAME',$tempAccName)->orWhere('ALIAS_NAME', 'LIKE', '%'.$tempAccName.'%')->orWhere('SAP_CODE',$tempAccCode)->get()->toArray();

 
		       		if($acc_name){

		       			foreach($acc_name as $key){

		       					$dataAcc = array(

		       						$ConfigAcc => $key->ACC_NAME.'~'.$key->ACC_CODE.'~'.$key->ACATG_CODE
		       					);

		       			$update2 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigAcc,$tempAccName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataAcc);

		       			}

		       		}else{

		       			$dataAcc = array(

		       				'ACC_STATUS' => 'YES',
		       				'NOT_FOUND_STATUS' => 'NOT FOUND',

		       			);

		       		  $update3 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigAcc,$tempAccName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataAcc);

		       		}


		       		$do_number = DB::table('DORDER_BODY')->where('DORDER_NO',$tempDoNumber)->where('DO_INVC_NO',$tempTempInvcNo)->where('SLNO',$tempslno)->where('COMP_CODE',$comp_code)->get()->toArray();


		       		if(empty($do_number)){

		       			$firstdo = array(

		       				'DO_EXIST_STATUS' => 'NO',
		       				'DO_UPDATE_STATUS' => 0,
		       			);

		   				DB::table('TEMP_DELIVERY_ORDER')->where($ConfigDo,$tempDoNumber)->where($ConfigInvcNo,$tempTempInvcNo)->where($ConfigQty,$tempQty)->where($ConfigSlNo,$tempslno)->where('COMP_CODE',$comp_code)->where('CREATED_BY',$createdBy)->update($firstdo);


		       			}else{

       		
			       			$chkExist = DB::table('DORDER_BODY')->where('DORDER_NO',$tempDoNumber)->where('DO_INVC_NO',$tempTempInvcNo)->where('QTY',$tempQty)->where('SLNO',$tempslno)->where('COMP_CODE',$comp_code)->get()->toArray();

			       			if($chkExist){

			       				$existdo = array(

				       				'DO_EXIST_STATUS' => 'EXIST',
				       				'DO_UPDATE_STATUS' => 0,

				       			);

				   				DB::table('TEMP_DELIVERY_ORDER')->where($ConfigDo,$tempDoNumber)->where($ConfigInvcNo,$tempTempInvcNo)->where($ConfigSlNo,$tempslno)->where('COMP_CODE',$comp_code)->update($existdo);
			       			}else{

			       				$existNOTdo = array(

				       				'DO_EXIST_STATUS' => 'YES',
				       				'DO_UPDATE_STATUS' => 1,

				       			);

			       			
				   				DB::table('TEMP_DELIVERY_ORDER')->where($ConfigDo,$tempDoNumber)->where($ConfigInvcNo,$tempTempInvcNo)->where($ConfigQty,$tempQty)->where($ConfigSlNo,$tempslno)->where('COMP_CODE',$comp_code)->where('CREATED_BY',$createdBy)->update($existNOTdo);

			       			}


       			
       			

       		}



       		}




       		
       		

       	
       }

       //exit;
  
       $NewData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='NO' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

       $AllocQtyData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

       $itemaccData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE  ( COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy')  AND ((ITEM_STATUS ='YES' AND DO_EXIST_STATUS ='NO') OR  (ACC_STATUS='YES' AND DO_EXIST_STATUS ='NO'))");




       //print_r($TempData);exit;

       $new_data_count = count($NewData);

       $itemacc_count = count($itemaccData);

       $allocqty_count = count($AllocQtyData);


       	if($saveData) {

    			$response_array['response'] = 'success';
    			$response_array['new_data_count'] = $new_data_count;
    			$response_array['itemacc_count'] = $itemacc_count;
    			$response_array['allocqty_count'] = $allocqty_count;
	            echo $data = json_encode($response_array);
	         
			}else{

				$response_array['response'] = 'error';
				$response_array['new_data_count'] = '';
    			$response_array['itemacc_count'] = '';
    			$response_array['allocqty_count'] = '';

            $data = json_encode($response_array);
            print_r($data);
				
			}

		}else{

			$response_array['response'] = 'error_data';
			$response_array['data_error'] = 'data not avilable';
         echo  $data = json_encode($response_array);
        
		}



       	
    }


    public function SaveDeliveryOrderExCeeding(Request $request)
    {

    	 /*  echo '<pre>';
    	    print_r($request->post());exit;*/
    	//
			$createdBy        = $request->session()->get('userid');
			$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
			$fisYear          =  $request->session()->get('macc_year');
			$db_name          =  $request->session()->get('dbName');
			$comp_nameval     = $request->input('comp_name');
			$fy_year          = $request->input('fy_year');
			$pfct_code        = $request->input('pfct_code');
			$trans_code       = $request->input('trans_code');
			$series_code      = $request->input('series_code');
			$series_name      = $request->input('series_name');
			$plant_name       = $request->input('plant_name');
			$pfct_name        = $request->input('pfct_name');
			$vr_no            = $request->input('vr_no');
			$trans_date       = $request->input('trans_date');
			$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
			$getduedate       = $request->input('getdue_date');
			$dueDate          = date("Y-m-d", strtotime($getduedate));
			$plant_code       = $request->input('plant_code');
			$acc_code         = $request->input('accCode');
			$acc_name         = $request->input('accName');
			$freight_order_no = $request->input('FreightNo');
			$route_code       = $request->input('RouteCode');
			$route_name       = $request->input('RouteName');
			
			$dono             = $request->input('dono');
			$dodate           = $request->input('do_date');
			$consigneeCode    = $request->input('consignee');
			$consineeName     = $request->input('consineeName');
			$consineeAdd      = $request->input('consigneeadd');
			$from_place       = $request->input('from_place');
			$to_place         = $request->input('to_place');
			$itemCode         = $request->input('itemCode');
			$itemName         = $request->input('itemName');
			$length           = $request->input('length');
			$width            = $request->input('width');
			$height           = $request->input('height');
			$odc              = $request->input('odc');
			$remark           = $request->input('remark');
			$batch_no         = $request->input('batch_no');
			$qty              = $request->input('qty');
			$unit_M           = $request->input('unit_M');
			$importExcel      = $request->input('importExcel1');
			$fromplace        = $request->input('fromplace');
			$rake_no          = $request->input('rakeNo');
			$importfilename   = $request->input('importfilename');
			$rake_date1        = $request->input('rakeDate');
			$rake_date       = date("Y-m-d", strtotime($rake_date1));
			$placement_date1   = $request->input('placeDate');
			$placement_date       = date("Y-m-d", strtotime($placement_date1));
			$refcompCode        = $request->input('refcompCode');
			$refcompName        = $request->input('refcompName');
			$count            = count($itemCode);

			if($importExcel != ''){

				  $uploadfileName =  $importfilename;
				  $uploadfileStatus='YES';

			}else{

				$uploadfileName =  '';
				$uploadfileStatus='NO';

			}
	   
	    $StoreH = DB::select("SELECT MAX(DORDERHID) as DORDERHID  FROM DORDER_HEAD");
		$headID = json_decode(json_encode($StoreH), true); 
	  //  print_r($headID);exit;
	
		if(empty($headID[0]['DORDERHID'])){
			$headId = 1;
		}else{
			$headId = $headID[0]['DORDERHID']+1;
		}

		   if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('DORDER_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}
	

	    	
				//print_r($importExcel);exit;
				
		if($importExcel != ''){





			$getDoBodyCoulmName= DB::select("SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA='$db_name' AND table_name='DORDER_BODY'");


		//print_r($getDoBodyCoulmName);exit;

			
			    $DoBodyCoulmName = json_decode(json_encode($getDoBodyCoulmName), true); 

					$DoBodyColmnCount = count($DoBodyCoulmName);

					$DoBodyColmn =[];

					foreach($DoBodyCoulmName as $key) {

							$DoBodyColmn[] = $key;
						
					}


					$bodycolName =[];

					for ($g = 0; $g < $DoBodyColmnCount; $g++) {

						$bodycolName[] = $DoBodyColmn[$g]['COLUMN_NAME'];
					
					  
				    }
			/*do ordr body table*/


			$column_name = DB::table('MASTER_EXCELCONFIG')->select('TBL_COL','TEMPEXCEL_COL')->where('TRAN_CODE','DO')->where('EXLCONFIG_CODE','DOEXCD')->get()->toArray();

			     $ColumnArray = json_decode( json_encode($column_name), true);

			   //  print_r($ColumnArray);exit;
			     $tblExcelCol =[];
			     $tblmerger=[];

			      foreach($ColumnArray as $key){

		       		$tempExcelCol[] = $key;
					array_push($tblExcelCol, $key['TBL_COL']);
					array_push($tblmerger, $key);

		       	}

		       	$tblcount = count($tblmerger);

		       	$temptblcol =[];
		       	$tempExcelcol =[];
				for ($b = 0; $b < $tblcount; $b++) {

					$temptblcol[] = $tblmerger[$b]['TBL_COL'];
					$tempExcelcol[] = $tblmerger[$b]['TEMPEXCEL_COL'];
					
				  
			    }


			    $arryCombConfigTbl = array_combine($temptblcol, $tempExcelcol);
			

			    $arryCombConfigTblCount = count($arryCombConfigTbl);


	
			  $tempDoOrder = DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE COMP_CODE='$getcompcode' AND FY_CODE ='$fisYear' AND CREATED_BY='$createdBy' AND DO_EXIST_STATUS='NO' AND DO_UPDATE_STATUS = '0' ");

		
			     $ColumntempDoOrder = json_decode( json_encode($tempDoOrder), true);

				  $tempDoOrderCount = count($tempDoOrder);

  			

					$getCoulmName= DB::select("SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA='$db_name' AND table_name='TEMP_DELIVERY_ORDER' AND COLUMN_NAME != 'COMP_CODE' AND COLUMN_NAME != 'FY_CODE' AND COLUMN_NAME != 'ID'");

					$CoulmName = json_decode(json_encode($getCoulmName), true); 

					//print_r($CoulmName);exit;

					$tempColmnCount = count($CoulmName);

					$tempColmn =[];

					foreach($CoulmName as $row) {

							$tempColmn[] = $row;
						
					}

			     $tempExcelcol =[];

				for ($d = 0; $d < $tempColmnCount; $d++) {

					$tempExcelcol[] = $tempColmn[$d]['COLUMN_NAME'];
				
				  
			    }

	   
	    $insertexcelArray = [];
	    $cp_code_excel = [];
	    $cp_name_excel = [];
	    $do_no_excel = [];
	    $sl_no_excel = [];
	    $do_invc_excel = [];
	    $do_invc_dt_excel = [];
	    $do_del_no = [];
	    $do_wagon_no = [];
	    $item_code_excel = [];
	    $item_name_excel = [];
	    $batch_no = [];
	    $gross_wt = [];
	    $remark_excel = [];
	    $qty_excel = [];
	    $cam_no_excel = [];
	    $do_date_excel = [];
	    $eway_bill_no_excel = [];
	    $eway_bill_dt_excel = [];
	    $vrno_excel = [];
	    $to_place_excel = [];
	    $from_place_excel = [];
	   
	  
	 //  print_r($arryCombConfigTbl);exit;

	   if($arryCombConfigTbl){

	    for($w=0;$w< $tempDoOrderCount; $w++){
       		$n= $w+1;
       		/* -- excel col count -- */
       		for ($e = 0; $e < $tempColmnCount; $e++){


       			if(isset($arryCombConfigTbl['CP_CODE'])){

       			if($arryCombConfigTbl['CP_CODE'] == $tempExcelcol[$e]){

       				$CP_CODE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($cp_code_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$CP_CODE ='';
				}
			}

			if(isset($arryCombConfigTbl['CP_NAME'])){

       			if($arryCombConfigTbl['CP_NAME'] == $tempExcelcol[$e]){

       				$CP_NAME = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($cp_name_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$CP_NAME ='';
				}
			}

       			
       			if(isset($arryCombConfigTbl['DORDER_NO'])){

       			if($arryCombConfigTbl['DORDER_NO'] == $tempExcelcol[$e]){

       				$DORDER_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($do_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$DORDER_NO ='';
				}
			}


			if(isset($arryCombConfigTbl['TO_PLACE'])){

				if($arryCombConfigTbl['TO_PLACE'] == $tempExcelcol[$e]){


					$TO_PLACE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($to_place_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$TO_PLACE='';
				}

			}


			if(isset($arryCombConfigTbl['DO_INVC_NO'])){

       			if($arryCombConfigTbl['DO_INVC_NO'] == $tempExcelcol[$e]){

       				$DO_INVC_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($do_invc_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$DO_INVC_NO ='';
				}
			}

			if(isset($arryCombConfigTbl['DO_INVC_DT'])){

       			if($arryCombConfigTbl['DO_INVC_DT'] == $tempExcelcol[$e]){

       				$DO_INVC_DT = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($do_invc_dt_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$DO_INVC_DT ='';
				}
			}


			if(isset($arryCombConfigTbl['DO_DELIVERY_NO'])){

       			if($arryCombConfigTbl['DO_DELIVERY_NO'] == $tempExcelcol[$e]){

       				$DO_DELIVERY_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($do_del_no,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$DO_DELIVERY_NO ='';
				}
			}

			if(isset($arryCombConfigTbl['DO_WAGON_NO'])){

       			if($arryCombConfigTbl['DO_WAGON_NO'] == $tempExcelcol[$e]){

       				$DO_WAGON_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($do_wagon_no,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$DO_WAGON_NO ='';
				}
			}

			if(isset($arryCombConfigTbl['ITEM_CODE'])){

				if($arryCombConfigTbl['ITEM_CODE'] == $tempExcelcol[$e]){


				$ITEM_CODE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

				array_push($item_code_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				
				}else{
					$ITEM_CODE ='';
				}

			}

			if(isset($arryCombConfigTbl['ITEM_NAME'])){

				if($arryCombConfigTbl['ITEM_NAME'] == $tempExcelcol[$e]){


				$ITEM_NAME = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

				array_push($item_name_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				
				}else{
					$ITEM_NAME ='';
				}

			}

			if(isset($arryCombConfigTbl['REMARK'])){

				if($arryCombConfigTbl['REMARK'] == $tempExcelcol[$e]){


					$REMARK = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($remark_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$REMARK='';
				}
			}

			

			if(isset($arryCombConfigTbl['BATCH_NO'])){

				if($arryCombConfigTbl['BATCH_NO'] == $tempExcelcol[$e]){


					$BATCH_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($batch_no,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$BATCH_NO='';
				}
			}

			  if(isset($arryCombConfigTbl['SLNO'])){

					if($arryCombConfigTbl['SLNO'] == $tempExcelcol[$e]){

						$SLNO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

	 					array_push($sl_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);
						
					}else{
						$SLNO = '';

					}

				}
				
			if(isset($arryCombConfigTbl['GROSS_WT'])){

				if($arryCombConfigTbl['GROSS_WT'] == $tempExcelcol[$e]){


					$GROSS_WT = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($gross_wt,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$GROSS_WT='';
				}
			}

			if(isset($arryCombConfigTbl['QTY'])){

				if($arryCombConfigTbl['QTY'] == $tempExcelcol[$e]){


					$QTY = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($qty_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{

					$QTY='';
				}

			}


			if(isset($arryCombConfigTbl['EWAY_BILL_NO'])){

				if($arryCombConfigTbl['EWAY_BILL_NO'] == $tempExcelcol[$e]){


					$eWayBill_no = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($eway_bill_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{

					$eWayBill_no='';
				}

			}



			if(isset($arryCombConfigTbl['EWAY_BILL_DT'])){

				if($arryCombConfigTbl['EWAY_BILL_DT'] == $tempExcelcol[$e]){


					$eWayBill_dt = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($eway_bill_dt_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{

					$eWayBill_dt='';
				}

			}
			
			
		
				
				
			if(isset($arryCombConfigTbl['CAM_NO'])){

				if($arryCombConfigTbl['CAM_NO'] == $tempExcelcol[$e]){


					$CAM_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($cam_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$CAM_NO ='';
				}

			}
				
			

				if(isset($arryCombConfigTbl['FROM_PLACE'])){

				 if($arryCombConfigTbl['FROM_PLACE'] == $tempExcelcol[$e]){

				 	    $FROM_PLACE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($from_place_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 

			     	   $FROM_PLACE='';
						
				}

				}

	       		if(isset($ColumntempDoOrder[$w])){

       			$insertexcelArray[] = $ColumntempDoOrder[$w];


       			}
	       		
	       	}
       		
       	}

     //  	print_r($insertexcelArray);exit;

			$datahead = array(

				'COMP_CODE'      =>$getcompcode,
				'FY_CODE'        =>$fisYear,
				'DORDERHID'      =>$headId,
				'TRAN_CODE'      =>$trans_code,
				'SERIES_CODE'    =>$series_code,
				'SERIES_NAME'    =>$series_name,
				'PFCT_CODE'      =>$pfct_code,
				'PFCT_NAME'      =>$pfct_name,
				'VRNO'           =>$NewVrno,
				'VRDATE'         =>$tr_vr_date,
				'PLANT_CODE'     =>$plant_code,
				'PLANT_NAME'     =>$plant_name,
				'ACC_CODE'       =>$acc_code,
				'ACC_NAME'       =>$acc_name,
				'FREIGHT_ORD_NO' =>$freight_order_no,
				'RAKE_NO'        =>$rake_no,
				'RAKE_DATE'      =>$rake_date,
				'PLACE_DATE'     =>$placement_date,
				'SISCONCERN_COMP_CODE' =>$refcompCode,
				'SISCONCERN_COMP_NAME' =>$refcompName,
				'UPLOAD_FILE_NAME'     =>$uploadfileName,
				'UPLOAD_FILE_STATUS'   =>$uploadfileStatus,
				'DO_UPLOAD_STATUS'=>'EX',
				'CREATED_BY'     =>$createdBy,

			);

	    $saveData = DB::table('DORDER_HEAD')->insert($datahead);


	     	$discriptn_page = "Store requistion trans insert done by user";

			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);

		 for($j = 0; $j < $tempDoOrderCount; $j++) {


		 	$StoreB = DB::select("SELECT MAX(DORDERBID) as DORDERBID FROM DORDER_BODY");

			$bodyID = json_decode(json_encode($StoreB), true); 

			if(empty($bodyID[0]['DORDERBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['DORDERBID']+1;
			}


			$explode_consinee = explode("~",$cp_name_excel[$j]);

			if(isset($explode_consinee[0])){
				$consinee_name = $explode_consinee[0];
			}else{
				$consinee_name = '';
			}

			if(isset($explode_consinee[1])){
				$consinee_code = $explode_consinee[1];
			}else{
				$consinee_code ='';
			}

			if(isset($explode_consinee[2])){
				$acat_code = $explode_consinee[2];
			}else{
				$acat_code ='';
			}


			                $explode_code_name = explode("~",$item_code_excel[$j]);


							if(isset($explode_code_name[0])){
								$aliseCode = $explode_code_name[0];
							}else{
								$aliseCode = '';
							}


				           if(isset($explode_code_name[1])){
								$itemName = $explode_code_name[1];
							}else{
								$itemName = '';
							}

							if(isset($explode_code_name[2])){
								$itemCode = $explode_code_name[2];
							}else{
								$itemCode ='';
							}

							$invc_dt_excel   = date("Y-m-d", strtotime($do_invc_dt_excel[$j]));
			                $eway_bill_dt       = date("Y-m-d", strtotime($eway_bill_dt_excel[$j]));
							
		  	$data_import = array(

						'DORDERHID'      =>$headId,
						'DORDERBID'      =>$bodyId,
						'COMP_CODE'      =>$getcompcode,
						'FY_CODE'        =>$fisYear,
						'PFCT_CODE'      =>$pfct_code,
						'PFCT_NAME'      =>$pfct_name,
						'PLANT_CODE'     =>$plant_code,
						'PLANT_NAME'     =>$plant_name,
						'TRAN_CODE'      =>$trans_code,
						'SERIES_CODE'    =>$series_code,
						'VRDATE'         =>$tr_vr_date,
						'VRNO'           =>$NewVrno,
						'ACC_CODE'       =>$acc_code,
						'ACC_NAME'       =>$acc_name,
						'DO_INVC_NO'     =>$do_invc_excel[$j],
						'DO_INVC_DT'     =>$invc_dt_excel,
						'DO_WAGON_NO'    =>$do_wagon_no[$j],
						'DO_DELIVERY_NO' =>$do_del_no[$j],
						'GROSS_WT'       =>$gross_wt[$j],
						'EWAY_BILL_NO'   =>$eway_bill_no_excel[$j],
						'EWAY_BILL_DT'   =>$eway_bill_dt,
						'DORDER_NO'      =>$do_no_excel[$j],
						'DORDER_DATE'    =>$placement_date,
						'SLNO'           =>$sl_no_excel[$j],
						'ITEM_CODE'      =>$itemCode,
						'ITEM_NAME'      =>$itemName,
						'ALIAS_ITEM_CODE'      =>$aliseCode,
						'ALIAS_ITEM_NAME'      =>$item_name_excel[$j],
						'REMARK'         =>$remark_excel[$j],
						'QTY'            =>$qty_excel[$j],
						'CP_CODE'        =>$consinee_code,
						'CP_NAME'        =>$consinee_name,
						'ACATG_CODE'     =>$acat_code,
						'ALIAS_CP_CODE'  =>$cp_code_excel[$j],
						'FROM_PLACE'     =>$fromplace,
						'TO_PLACE'       =>$to_place_excel[$j],
						'SISCONCERN_COMP_CODE'       =>$refcompCode,
				        'SISCONCERN_COMP_NAME'       =>$refcompName,
				        'CREATED_BY'     =>$createdBy,

						
				);


		  //	print_r($data_import);exit;

		  	 $saveData1 = DB::table('DORDER_BODY')->insert($data_import);

		  

		 }


		 $checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->toArray();
			

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$getcompcode,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);

			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

		
			
		//$saveData1=='';

		 if($saveData1){

			$response_array['response'] = 'success';
			//$response_array['lastid'] = $headID;
		    $data = json_encode($response_array);
		    print_r($data);

		   }else{

			$response_array['response'] = 'error';
		    $data = json_encode($response_array);
		    print_r($data);

		   }

		}else{

			$response_array['response'] = 'error_data';
		    $data = json_encode($response_array);
		    print_r($data);

		}
		

}



		
 }

    public function SaveDeliveryOrder(Request $request)
    {

    	/*echo '<pre>';
    	print_r($request->post());exit;*/
    
    	
			$createdBy        = $request->session()->get('userid');
			$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
			$getcompname      =	$compcode[1];
			$fisYear          =  $request->session()->get('macc_year');
			$db_name          =  $request->session()->get('dbName');
			$comp_nameval     = $request->input('comp_name');
			$fy_year          = $request->input('fy_year');
			$pfct_code        = $request->input('pfct_code');
			$trans_code       = $request->input('trans_code');
			$series_code      = $request->input('series_code');
			$series_name      = $request->input('series_name');
			$plant_name       = $request->input('plant_name');
			$pfct_name        = $request->input('pfct_name');
			$vr_no            = $request->input('vr_no');
			$trans_date       = $request->input('trans_date');
			$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
			$getduedate       = $request->input('getdue_date');
			$dueDate          = date("Y-m-d", strtotime($getduedate));
			$plant_code       = $request->input('plant_code');
			$acc_code         = $request->input('accCode');
			$acc_name         = $request->input('accName');
			$freight_order_no = $request->input('FreightNo');
			$route_code       = $request->input('RouteCode');
			$route_name       = $request->input('RouteName');
			
			$dono             = $request->input('dono');
			$dodate           = $request->input('do_date');
			$consigneeCode    = $request->input('consignee');
			$consineeName     = $request->input('consineeName');
			$consineeAdd      = $request->input('consigneeadd');
			$from_place       = $request->input('from_place');
			$to_place         = $request->input('to_place');
			$itemCode         = $request->input('itemCode');
			$itemName         = $request->input('itemName');
			$length           = $request->input('length');
			$width            = $request->input('width');
			$height           = $request->input('height');
			$odc              = $request->input('odc');
			$remark           = $request->input('remark');
			$batch_no         = $request->input('batch_no');
			$qty              = $request->input('qty');
			$unit_M           = $request->input('unit_M');
			$importExcel      = $request->input('importExcel');
			$importfilename   = $request->input('importfilename');
			$fromplace        = $request->input('fromplace');
			$refcompCode        = $request->input('refcompCode');
			$refcompName        = $request->input('refcompName');
			$count            = count($itemCode);


			if($importExcel != ''){

				  $uploadfileName =  $importfilename;
				  $uploadfileStatus='YES';

			}else{

				$uploadfileName =  '';
				$uploadfileStatus='NO';

			}
	   


	   
	    $StoreH = DB::select("SELECT MAX(DORDERHID) as DORDERHID  FROM DORDER_HEAD");
		$headID = json_decode(json_encode($StoreH), true); 
	  //  print_r($headID);exit;
	
		if(empty($headID[0]['DORDERHID'])){
			$headId = 1;
		}else{
			$headId = $headID[0]['DORDERHID']+1;
		}

		   if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('DORDER_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}
	

	    	

		if($importExcel != ''){



			/*do ordr body table*/

			$getDoBodyCoulmName= DB::select("SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA='$db_name' AND table_name='DORDER_BODY'");

			
			    $DoBodyCoulmName = json_decode(json_encode($getDoBodyCoulmName), true); 

					$DoBodyColmnCount = count($DoBodyCoulmName);

					$DoBodyColmn =[];

					foreach($DoBodyCoulmName as $key) {

							$DoBodyColmn[] = $key;
						
					}


					$bodycolName =[];

					for ($g = 0; $g < $DoBodyColmnCount; $g++) {

						$bodycolName[] = $DoBodyColmn[$g]['COLUMN_NAME'];
					
					  
				    }
			/*do ordr body table*/


			$column_name = DB::table('MASTER_EXCELCONFIG')->select('TBL_COL','TEMPEXCEL_COL')->where('TRAN_CODE','DO')->where('EXLCONFIG_CODE','DOYARD')->get()->toArray();

			     $ColumnArray = json_decode( json_encode($column_name), true);

			   //  print_r($ColumnArray);exit;
			     $tblExcelCol =[];
			     $tblmerger=[];

			      foreach($ColumnArray as $key){

		       		$tempExcelCol[] = $key;
					array_push($tblExcelCol, $key['TBL_COL']);
					array_push($tblmerger, $key);

		       	}

		       	$tblcount = count($tblmerger);

		       	$temptblcol =[];
		       	$tempExcelcol =[];
				for ($b = 0; $b < $tblcount; $b++) {

					$temptblcol[] = $tblmerger[$b]['TBL_COL'];
					$tempExcelcol[] = $tblmerger[$b]['TEMPEXCEL_COL'];
					
				  
			    }


			    $arryCombConfigTbl = array_combine($temptblcol, $tempExcelcol);
			

			    $arryCombConfigTblCount = count($arryCombConfigTbl);


	
			  $tempDoOrder = DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE COMP_CODE='$getcompcode' AND FY_CODE ='$fisYear' AND CREATED_BY='$createdBy' AND DO_EXIST_STATUS='NO' AND DO_UPDATE_STATUS = '0' ");

		
			     $ColumntempDoOrder = json_decode( json_encode($tempDoOrder), true);

				  $tempDoOrderCount = count($tempDoOrder);

  			

					$getCoulmName= DB::select("SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA='$db_name' AND table_name='TEMP_DELIVERY_ORDER' AND COLUMN_NAME != 'COMP_CODE' AND COLUMN_NAME != 'FY_CODE' AND COLUMN_NAME != 'ID'");

					$CoulmName = json_decode(json_encode($getCoulmName), true); 

					//print_r($CoulmName);exit;

					$tempColmnCount = count($CoulmName);

					$tempColmn =[];

					foreach($CoulmName as $row) {

							$tempColmn[] = $row;
						
					}

			     $tempExcelcol =[];

				for ($d = 0; $d < $tempColmnCount; $d++) {

					$tempExcelcol[] = $tempColmn[$d]['COLUMN_NAME'];
				
				  
			    }

	   
	    $insertexcelArray = [];
	    $do_no_excel = [];
	    $sl_no_excel = [];
	    $item_code_excel = [];
	    $remark_excel = [];
	    $qty_excel = [];
	    $do_date_excel = [];
	    $consinee_code_excel = [];
	    $consinee_excel = [];
	    $vrno_excel = [];
	    $to_place_excel = [];
	    $from_place_excel = [];
	   
	  
	    //print_r($arryCombConfigTbl);exit;

	   if($arryCombConfigTbl){

	    for($w=0;$w< $tempDoOrderCount; $w++){
       		$n= $w+1;
       		/* -- excel col count -- */
       		for ($e = 0; $e < $tempColmnCount; $e++){

       			
       			if(isset($arryCombConfigTbl['DORDER_NO'])){

       			if($arryCombConfigTbl['DORDER_NO'] == $tempExcelcol[$e]){

       				$DORDER_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($do_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$DORDER_NO ='';
				}
			}

					
			  if(isset($arryCombConfigTbl['SLNO'])){

					if($arryCombConfigTbl['SLNO'] == $tempExcelcol[$e]){

						$SLNO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

	 					array_push($sl_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);
						
					}else{
						$SLNO = '';

					}

				}
				

			if(isset($arryCombConfigTbl['ITEM_CODE'])){

				if($arryCombConfigTbl['ITEM_CODE'] == $tempExcelcol[$e]){


				$ITEM_CODE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

				array_push($item_code_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				
				}else{
					$ITEM_CODE ='';
				}

			}

			if(isset($arryCombConfigTbl['REMARK'])){

				if($arryCombConfigTbl['REMARK'] == $tempExcelcol[$e]){


					$REMARK = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($remark_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$REMARK='';
				}
			}
			

			if(isset($arryCombConfigTbl['QTY'])){

				if($arryCombConfigTbl['QTY'] == $tempExcelcol[$e]){


					$QTY = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($qty_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{

					$QTY='';
				}

			}
			
			if(isset($arryCombConfigTbl['DORDER_DATE'])){


				if($arryCombConfigTbl['DORDER_DATE'] == $tempExcelcol[$e]){


					$DORDER_DATE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($do_date_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$DORDER_DATE='';
				}

			}
			
				if(isset($arryCombConfigTbl['ACC_CODE'])){

					if($arryCombConfigTbl['ACC_CODE'] == $tempExcelcol[$e]){


								$ACC_CODE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

								array_push($consinee_code_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

						}else{
					       $ACC_CODE='';
							}
					
					}

			if(isset($arryCombConfigTbl['ACC_NAME'])){

				if($arryCombConfigTbl['ACC_NAME'] == $tempExcelcol[$e]){


					$ACC_NAME = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($consinee_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$ACC_NAME='';

				}

			}
				
			if(isset($arryCombConfigTbl['VRNO'])){

				if($arryCombConfigTbl['VRNO'] == $tempExcelcol[$e]){


					$VRNO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($vrno_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$VRNO ='';
				}

			}
				
			if(isset($arryCombConfigTbl['TO_PLACE'])){

				if($arryCombConfigTbl['TO_PLACE'] == $tempExcelcol[$e]){


					$TO_PLACE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($to_place_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$TO_PLACE='';
				}

			}

				if(isset($arryCombConfigTbl['FROM_PLACE'])){

				 if($arryCombConfigTbl['FROM_PLACE'] == $tempExcelcol[$e]){

				 	    $FROM_PLACE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($from_place_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 

			     	   $FROM_PLACE='';
						
				}

				}

	       		if(isset($ColumntempDoOrder[$w])){

       			$insertexcelArray[] = $ColumntempDoOrder[$w];


       			}
	       		
	       	}
       		
       	}



			$datahead = array(

				'COMP_CODE'      =>$getcompcode,
				'COMP_NAME'      =>$getcompname,
				'FY_CODE'        =>$fisYear,
				'DORDERHID'      =>$headId,
				'TRAN_CODE'      =>$trans_code,
				'SERIES_CODE'    =>$series_code,
				'SERIES_NAME'    =>$series_name,
				'PFCT_CODE'      =>$pfct_code,
				'PFCT_NAME'      =>$pfct_name,
				'VRNO'           =>$NewVrno,
				'VRDATE'         =>$tr_vr_date,
				'PLANT_CODE'     =>$plant_code,
				'PLANT_NAME'     =>$plant_name,
				'ACC_CODE'       =>$acc_code,
				'ACC_NAME'       =>$acc_name,
				'SISCONCERN_COMP_CODE'       =>$refcompCode,
				'SISCONCERN_COMP_NAME'       =>$refcompName,
				'FREIGHT_ORD_NO' =>$freight_order_no,
				'UPLOAD_FILE_NAME'     =>$uploadfileName,
				'UPLOAD_FILE_STATUS'   =>$uploadfileStatus,
				'DO_UPLOAD_STATUS' =>'YR',
				'CREATED_BY'     =>$createdBy,

			);

	    $saveData = DB::table('DORDER_HEAD')->insert($datahead);


	     	$discriptn_page = "Store requistion trans insert done by user";

			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);

		for($j = 0; $j < $tempDoOrderCount; $j++) {

			$explode_consinee = explode("~",$consinee_excel[$j]);

			$explode_remark = explode(" ",$remark_excel[$j]);

       		 $remarkItem = strlen($explode_remark[0]);

       		 //print_r($explode_remark);

   			if($remarkItem > 2){

   				$itemRemarkName = $explode_remark[0];
   			}else{

   				$itemRemarkName = $explode_remark[0].' '.$explode_remark[1];
   			}

			if(isset($explode_consinee[0])){
				$consinee_name = $explode_consinee[0];
			}else{
				$consinee_name = '';
			}

			if(isset($explode_consinee[1])){
				$consinee_code = $explode_consinee[1];
			}else{
				$consinee_code ='';
			}

			if(isset($explode_consinee[2])){
				$acat_code = $explode_consinee[2];
			}else{
				$acat_code ='';
			}

	        $explode_code_name = explode("~",$item_code_excel[$j]);

			if(isset($explode_code_name[0])){
				$aliseCode = $explode_code_name[0];
			}else{
				$aliseCode = '';
			}

	       if(isset($explode_code_name[1])){
				$itemName = $explode_code_name[1];
			}else{
				$itemName = '';
			}

			if(isset($explode_code_name[2])){
				$itemCode = $explode_code_name[2];
			}else{
				$itemCode ='';
			}

			if($do_date_excel[$j]==null || $do_date_excel[$j]=='00-00-0000'){

				$excel_do_date =   '0000-00-00';
			}else{
				$excel_do_date =   $do_date_excel[$j];
			}
			
		 	$StoreB = DB::select("SELECT MAX(DORDERBID) as DORDERBID FROM DORDER_BODY");

			$bodyID = json_decode(json_encode($StoreB), true); 

			if(empty($bodyID[0]['DORDERBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['DORDERBID']+1;
			}


		  	$data_import = array(

						'DORDERHID'     =>$headId,
						'DORDERBID'     =>$bodyId,
						'COMP_CODE'     =>$getcompcode,
						'COMP_NAME'     =>$getcompname,
						'FY_CODE'       =>$fisYear,
						'PFCT_CODE'     =>$pfct_code,
						'PFCT_NAME'     =>$pfct_name,
						'PLANT_CODE'    =>$plant_code,
						'PLANT_NAME'    =>$plant_name,
						'TRAN_CODE'     =>$trans_code,
						'SERIES_CODE'   =>$series_code,
						'VRDATE'        =>$tr_vr_date,
						'VRNO'          =>$NewVrno,
						'ACC_CODE'      =>$acc_code,
						'ACC_NAME'      =>$acc_name,
						'DORDER_NO'     =>$do_no_excel[$j],
						'SLNO'          =>$sl_no_excel[$j],
						'ITEM_CODE'     =>$itemCode,
						'ITEM_NAME'        =>$itemName,
						'ALIAS_ITEM_CODE'  =>$aliseCode,
						'ALIAS_ITEM_NAME'  =>$remark_excel[$j],
						'REMARK'        =>$remark_excel[$j],
						'QTY'           =>$qty_excel[$j],
						'DORDER_DATE'   =>$excel_do_date,
						'CP_CODE'       =>$consinee_code,
						'CP_NAME'       =>$consinee_name,
						'ACATG_CODE'    =>$acat_code,
						'LOT_NO'        =>$vrno_excel[$j],
						'FROM_PLACE'    =>$fromplace,
						'TO_PLACE'      =>$to_place_excel[$j],
						'SISCONCERN_COMP_CODE'       =>$refcompCode,
				        'SISCONCERN_COMP_NAME'       =>$refcompName,
						'CREATED_BY'    =>$createdBy,
						
				);



		  	 $saveData1 = DB::table('DORDER_BODY')->insert($data_import);

		  

		 }


		 $checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->toArray();
			

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$getcompcode,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);

			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

		
			
		//$saveData1=='';

		 if($saveData1){

			$response_array['response'] = 'success';
			//$response_array['lastid'] = $headID;
		    $data = json_encode($response_array);
		    print_r($data);

		   }else{

			$response_array['response'] = 'error';
		    $data = json_encode($response_array);
		    print_r($data);

		   }

		}else{

			$response_array['response'] = 'error_data';
		    $data = json_encode($response_array);
		    print_r($data);

		}
		  


}else{


			$datahead = array(

					'COMP_CODE'      =>$getcompcode,
					'FY_CODE'        =>$fisYear,
					'DORDERHID'      =>$headId,
					'TRAN_CODE'      =>$trans_code,
					'SERIES_CODE'    =>$series_code,
					'SERIES_NAME'    =>$series_name,
					'PFCT_CODE'      =>$pfct_code,
					'PFCT_NAME'      =>$pfct_name,
					'VRNO'           =>$NewVrno,
					'VRDATE'         =>$tr_vr_date,
					'PLANT_CODE'     =>$plant_code,
					'PLANT_NAME'     =>$plant_name,
					'ACC_CODE'       =>$acc_code,
					'ACC_NAME'       =>$acc_name,
					'SISCONCERN_COMP_CODE'       =>$refcompCode,
				    'SISCONCERN_COMP_NAME'       =>$refcompName,
					'FREIGHT_ORD_NO' =>$freight_order_no,
					'CREATED_BY'     =>$createdBy,

				);

		    // $saveData = DB::table('DORDER_HEAD')->insert($datahead);

	      	$discriptn_page = "Store requistion trans insert done by user";

			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);

			for ($i = 0; $i < $count; $i++) {

			$StoreB = DB::select("SELECT MAX(DORDERBID) as DORDERBID FROM DORDER_BODY");

			$bodyID = json_decode(json_encode($StoreB), true); 
	
			if(empty($bodyID[0]['DORDERBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['DORDERBID']+1;
			}


			$do_date          = date("Y-m-d", strtotime($dodate[$i]));

			if($do_date==null || $do_date=='0000-00-00'){

			  $do_date1 = '0000-00-00';
			}else{
			  $do_date1 =  $do_date;
			}

			//print_r($do_date1);exit;


		    $data_body = array(

				'DORDERHID'   =>$headId,
				'DORDERBID'   =>$bodyId,
				'COMP_CODE'   =>$getcompcode,
				'FY_CODE'     =>$fisYear,
				'PFCT_CODE'   =>$pfct_code,
				'PFCT_NAME'   =>$pfct_name,
				'PLANT_CODE'  =>$plant_code,
			   'PLANT_NAME'   =>$plant_name,
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'VRDATE'      =>$tr_vr_date,
				'VRNO'        =>$NewVrno,
				'SLNO'        =>$i+1,
				'ACC_CODE'    =>$acc_code,
				'ACC_NAME'    =>$acc_name,
				'DORDER_NO'   =>$dono[$i],
				'DORDER_DATE' =>$do_date1,
				'CP_CODE'     =>$consigneeCode[$i],
				'CP_NAME'     =>$consineeName[$i],
				'CP_ADD'      =>$consineeAdd[$i],
				'FROM_PLACE'  =>$from_place[$i],
				'TO_PLACE'    =>$to_place[$i],
				'ITEM_CODE'   =>$itemCode[$i],
				'ITEM_NAME'   =>$itemName[$i],
				'LENGTH'      =>$length[$i],
				'WIDTH'       =>$width[$i],
				'HEIGHT'      =>$height[$i],
				'ODC'         =>$odc[$i],
				'REMARK'      =>$remark[$i],
				'QTY'         =>$qty[$i],
				'UM'          =>$unit_M[$i],
				'BATCH_NO'    =>$batch_no[$i],
				'SISCONCERN_COMP_CODE'       =>$refcompCode,
				'SISCONCERN_COMP_NAME'       =>$refcompName,
				'CREATED_BY'  =>$createdBy,

		    );
	
	    	//$saveData1 = DB::table('DORDER_BODY')->insert($data_body);
			
	    	$doCount='';
		}


		$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->toArray();
			

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$getcompcode,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);

			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

		
			
		//$saveData1=='';

		 if($saveData1){

			$response_array['response'] = 'success';
			//$response_array['lastid'] = $headID;
		    $data = json_encode($response_array);
		    print_r($data);

		   }else{

			$response_array['response'] = 'error';
		    $data = json_encode($response_array);
		    print_r($data);

		   }

}


    }


    /*eproc status*/

    public function SaveEprocStatus(Request $request)
    {

    	    $createdBy        = $request->session()->get('userid');
			$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
			$fisYear          =  $request->session()->get('macc_year');
			$db_name          =  $request->session()->get('dbName');
			$comp_nameval     = $request->input('comp_name');
			$fy_year          = $request->input('fy_year');

			$trans_type = $request->trans_type;


		DB::beginTransaction();

		try {

		

			$tempDoOrder = DB::select("SELECT * FROM EPROC_UPLOAD_EXCEL WHERE COMP_CODE='$getcompcode' AND FY_CODE ='$fisYear' AND CREATED_BY='$createdBy'");

			$EprocData = json_decode( json_encode($tempDoOrder), true);

			$tempEprocCount = count($EprocData);

			/*echo '<pre>';
			print_r($EprocData);exit;
			
          echo '</pre>';*/

        $updataArr =array();

		for($j = 0; $j < $tempEprocCount; $j++) {

			$delivry_no_excel = $EprocData[$j]['DELIVERY_NO'];
			$invc_excel = $EprocData[$j]['INVOICE_NO'];
			$itemslno_excel = $EprocData[$j]['ITEM_SLNO'];


		   
			

		//DB::enableQueryLog();
//dd(DB::getQueryLog());
			//DB::enableQueryLog();

       		/*$salebill_data = DB::table('SBILL_BODY_PROV')
                ->select('SBILL_BODY_PROV.*', 'SBILL_HEAD_PROV.PSBILLHID as headId')
                   ->leftjoin('SBILL_HEAD_PROV', 'SBILL_HEAD_PROV.PSBILLHID', '=', 'SBILL_BODY_PROV.PSBILLHID')
                   ->where('SBILL_BODY_PROV.DELIVERY_NO',$delivry_no_excel)
                   ->get()->first();*/
                
            if($trans_type=='EX-SID'){

            	$salebill_data = DB::SELECT("SELECT B.*,H.PSBILLHID AS headId FROM SBILL_BODY_PROV B,SBILL_HEAD_PROV H WHERE B.PSBILLHID=H.PSBILLHID  AND B.INVC_NO=$invc_excel AND B.ITEM_SLNO='$itemslno_excel'");

            	/*$salebill_data = DB::SELECT("SELECT B.*,H.PSBILLHID AS headId FROM SBILL_BODY_PROV B,SBILL_HEAD_PROV H WHERE B.PSBILLHID=H.PSBILLHID  AND B.INVC_NO=$invc_excel");*/

             /*  $salebill_data = DB::SELECT("SELECT B.* FROM SBILL_BODY_PROV B WHERE B.INVC_NO='$invc_excel'");*/

            }else{

            	$salebill_data = DB::SELECT("SELECT B.*,H.PSBILLHID AS headId FROM SBILL_BODY_PROV B,SBILL_HEAD_PROV H WHERE B.PSBILLHID=H.PSBILLHID  AND B.DELIVERY_NO=$delivry_no_excel");
            }

          	/*echo '<pre>';

            print_r($salebill_data);

            echo '</pre>';*/
                	
              	if($salebill_data){

              		$saleheadId = $salebill_data[0]->headId;
              		$salebodyId = $salebill_data[0]->PSBILLBID;
              	}else{

              		$saleheadId = '';
              		$salebodyId = '';
              	}

              	
		  	$data_import = array(

						'TRANSACTION_NO'  => $EprocData[$j]['TRANSACTION_CODE'],
						'BILL_NO'         => $EprocData[$j]['BILL_NO'],
						'UPLOAD_DATE'     => $EprocData[$j]['UPLOAD_DATE'],
						'POSTING_DATE'    => $EprocData[$j]['BILL_DATE'],
						'CURRENT_STATUS'  => $EprocData[$j]['CURRENT_STATUS'],
						'TARP_VALUE'      => $EprocData[$j]['PENULTY'],
						'UPLOAD_PENALTY_AMT' => $EprocData[$j]['UPLAOD_PENALTY_AMT'],
						'UPLOAD_BILL_AMT' => $EprocData[$j]['UPLAOD_BILL_AMT'],
						'CAL_BILL_AMT'    => $EprocData[$j]['CAL_BILL_AMT'],
						'CAL_BONUS_AMT'   => $EprocData[$j]['CAL_BONUS_AMT'],
						'CAL_PENALTY_AMT' => $EprocData[$j]['CAL_PENALTY_AMT'],
						'CAL_FRGHT_VALUE' => $EprocData[$j]['CAL_FREIGHT_VAL'],
						'CGST'            => $EprocData[$j]['CGST'],
						'SGST_UGST'       => $EprocData[$j]['SGST'],
						'PAYBLE_BILL_AMT' => $EprocData[$j]['PAYBEL_BILL_AMT'],
						'CREATED_BY'      =>$createdBy,
						
				);

			  	if($trans_type=='EX-SID'){

			  	 $updateData = DB::table('SBILL_BODY_PROV')->where('PSBILLHID',$saleheadId)->where('INVC_NO',$invc_excel)->where('ITEM_SLNO',$itemslno_excel)->update($data_import);

			    }else{

			    	/*$updateData = DB::table('SBILL_BODY_PROV')->where('PSBILLHID',$saleheadId)->where('DELIVERY_NO',$delivry_no_excel)->where('ITEM_SLNO',$itemslno_excel)->update($data_import);*/

			    	$updateData = DB::table('SBILL_BODY_PROV')->where('PSBILLHID',$saleheadId)->where('DELIVERY_NO',$delivry_no_excel)->update($data_import);
			    }

		   	if($updateData){

		   		array_push($updataArr,'true');

		   	}

		 }
//exit;
		

		  DB::commit();

			$response_array['response'] = 'success';
			$data = json_encode($response_array);
		    print_r($data);

		}catch (\Exception $e) {

	        DB::rollBack();
	       // throw $e;
	         $response_array['response'] = 'error';
		    $data = json_encode($response_array);
		    print_r($data);


	    	}



		/* $arrayCount = count($updataArr);

		 if($arrayCount > 0){

			$response_array['response'] = 'success';
			//$response_array['lastid'] = $headID;
		    $data = json_encode($response_array);
		    print_r($data);

		   }else{

			$response_array['response'] = 'error';
		    $data = json_encode($response_array);
		    print_r($data);

		   }*/
		//exit;



			//print_r($tempDoOrderCount);exit;


   }

    public function SaveEprocStatus1(Request $request)
    {

    	    $createdBy        = $request->session()->get('userid');
			$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
			$fisYear          =  $request->session()->get('macc_year');
			$db_name          =  $request->session()->get('dbName');
			$comp_nameval     = $request->input('comp_name');
			$fy_year          = $request->input('fy_year');


    	$getDoBodyCoulmName= DB::select("SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA='$db_name' AND table_name='SBILL_HEAD_PROV'");

			
			    $DoBodyCoulmName = json_decode(json_encode($getDoBodyCoulmName), true); 

					$DoBodyColmnCount = count($DoBodyCoulmName);

					$DoBodyColmn =[];

					foreach($DoBodyCoulmName as $key) {

							$DoBodyColmn[] = $key;
						
					}


					$bodycolName =[];

					for ($g = 0; $g < $DoBodyColmnCount; $g++) {

						$bodycolName[] = $DoBodyColmn[$g]['COLUMN_NAME'];
					
					  
				    }
			/*do ordr body table*/


			$column_name = DB::table('MASTER_EXCELCONFIG')->select('TBL_COL','TEMPEXCEL_COL')->where('TRAN_CODE','EPROC')->where('EXLCONFIG_CODE','EPROC')->get()->toArray();

			     $ColumnArray = json_decode( json_encode($column_name), true);

			   //  print_r($ColumnArray);exit;
			     $tblExcelCol =[];
			     $tblmerger=[];

			      foreach($ColumnArray as $key){

		       		$tempExcelCol[] = $key;
					array_push($tblExcelCol, $key['TBL_COL']);
					array_push($tblmerger, $key);

		       	}

		       	$tblcount = count($tblmerger);

		       	$temptblcol =[];
		       	$tempExcelcol =[];
				for ($b = 0; $b < $tblcount; $b++) {

					$temptblcol[] = $tblmerger[$b]['TBL_COL'];
					$tempExcelcol[] = $tblmerger[$b]['TEMPEXCEL_COL'];
					
				  
			    }


			    $arryCombConfigTbl = array_combine($temptblcol, $tempExcelcol);
			

			    $arryCombConfigTblCount = count($arryCombConfigTbl);


	
			  $tempDoOrder = DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE COMP_CODE='$getcompcode' AND FY_CODE ='$fisYear' AND CREATED_BY='$createdBy' AND DO_EXIST_STATUS='EXIST' AND DO_UPDATE_STATUS = '0' ");

		
			     $ColumntempDoOrder = json_decode( json_encode($tempDoOrder), true);

				  $tempDoOrderCount = count($tempDoOrder);

  			

					$getCoulmName= DB::select("SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA='$db_name' AND table_name='TEMP_DELIVERY_ORDER' AND COLUMN_NAME != 'COMP_CODE' AND COLUMN_NAME != 'FY_CODE' AND COLUMN_NAME != 'ID'");

					$CoulmName = json_decode(json_encode($getCoulmName), true); 

					//print_r($CoulmName);exit;

					$tempColmnCount = count($CoulmName);

					$tempColmn =[];

					foreach($CoulmName as $row) {

							$tempColmn[] = $row;
						
					}

			     $tempExcelcol =[];

				for ($d = 0; $d < $tempColmnCount; $d++) {

					$tempExcelcol[] = $tempColmn[$d]['COLUMN_NAME'];
				
				  
			    }


			    //print_r($arryCombConfigTbl);exit;


		$insertexcelArray = [];
	    $trans_no_excel = [];
	    $delivry_no_excel = [];
	    $upload_date_excel = [];
	    $posting_date_excel = [];
	    $current_status_excel = [];
	    $cal_bill_amt_excel = [];
	    $cal_bill_bonus_amt_excel = [];
	    $cal_penalty_amt_excel = [];
	    $cal_freight_amt_excel = [];
	

	   for($w=0;$w< $tempDoOrderCount; $w++){


       		$n= $w+1;
       		/* -- excel col count -- */
       		for ($e = 0; $e < $tempColmnCount; $e++){

       			
       			if(isset($arryCombConfigTbl['TRANSACTION_NO'])){

       			if($arryCombConfigTbl['TRANSACTION_NO'] == $tempExcelcol[$e]){

       				$TRANSACTION_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($trans_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$TRANSACTION_NO ='';
				}
			}

					
			  if(isset($arryCombConfigTbl['DELIVERY_NO'])){

					if($arryCombConfigTbl['DELIVERY_NO'] == $tempExcelcol[$e]){

						$DELIVERY_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

	 					array_push($delivry_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);
						
					}else{
						$DELIVERY_NO = '';

					}

				}
				

			if(isset($arryCombConfigTbl['UPLOAD_DATE'])){

				if($arryCombConfigTbl['UPLOAD_DATE'] == $tempExcelcol[$e]){


				$UPLOAD_DATE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

				array_push($upload_date_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				
				}else{
					$UPLOAD_DATE ='';
				}

			}

			if(isset($arryCombConfigTbl['POSTING_DATE'])){

				if($arryCombConfigTbl['POSTING_DATE'] == $tempExcelcol[$e]){


					$POSTING_DATE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($posting_date_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$POSTING_DATE='';
				}
			}
			

			if(isset($arryCombConfigTbl['CURRENT_STATUS'])){

				if($arryCombConfigTbl['CURRENT_STATUS'] == $tempExcelcol[$e]){


					$CURRENT_STATUS = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($current_status_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{

					$CURRENT_STATUS='';
				}

			}
			
			if(isset($arryCombConfigTbl['CAL_BILL_AMT'])){


				if($arryCombConfigTbl['CAL_BILL_AMT'] == $tempExcelcol[$e]){


					$CAL_BILL_AMT = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($cal_bill_amt_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$CAL_BILL_AMT='';
				}

			}
			
				if(isset($arryCombConfigTbl['CAL_BONUS_AMT'])){

					if($arryCombConfigTbl['CAL_BONUS_AMT'] == $tempExcelcol[$e]){


								$CAL_BONUS_AMT = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

								array_push($cal_bill_bonus_amt_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

						}else{
					       $CAL_BONUS_AMT='';
							}
					
					}

			if(isset($arryCombConfigTbl['CAL_PENALTY_AMT'])){

				if($arryCombConfigTbl['CAL_PENALTY_AMT'] == $tempExcelcol[$e]){


					$CAL_PENALTY_AMT = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($cal_penalty_amt_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$CAL_PENALTY_AMT='';

				}

			}
				
			if(isset($arryCombConfigTbl['CAL_FRGHT_VALUE'])){

				if($arryCombConfigTbl['CAL_FRGHT_VALUE'] == $tempExcelcol[$e]){


					$CAL_FRGHT_VALUE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($cal_freight_amt_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$CAL_FRGHT_VALUE ='';
				}

			}
	       		if(isset($ColumntempDoOrder[$w])){

       			$insertexcelArray[] = $ColumntempDoOrder[$w];


       			}
	       		
	       	}
       		
       	} /*dooreder count*/


       	//print_r($insertexcelArray);exit;


       	for($j = 0; $j < $tempDoOrderCount; $j++) {

       		$salebill_data = DB::table('SBILL_BODY_PROV')
                ->select('SBILL_BODY_PROV.*', 'SBILL_HEAD_PROV.PSBILLHID as headId')
                   ->leftjoin('SBILL_HEAD_PROV', 'SBILL_HEAD_PROV.PSBILLHID', '=', 'SBILL_BODY_PROV.PSBILLHID')
                   ->where('SBILL_BODY_PROV.DELIVERY_NO',$delivry_no_excel[$j])
                   ->get()->first();

                
              	if($salebill_data){

              		$saleheadId = $salebill_data->headId;
              	}else{

              		$saleheadId = '';
              	}

            

          //$saleheadId =  $salebill_data->headId;

            //print_r($saleheadId);

		  	$data_import = array(

						'TRANSACTION_NO'  => $trans_no_excel[$j],
						'DELIVERY_NO'     => $delivry_no_excel[$j],
						'UPLOAD_DATE'     => $upload_date_excel[$j],
						'POSTING_DATE'    => $posting_date_excel[$j],
						'CURRENT_STATUS'  => $current_status_excel[$j],
						'CAL_BILL_AMT'    => $cal_bill_amt_excel[$j],
						'CAL_BONUS_AMT'   => $cal_bill_bonus_amt_excel[$j],
						'CAL_PENALTY_AMT' => $cal_penalty_amt_excel[$j],
						'CAL_FRGHT_VALUE' => $cal_freight_amt_excel[$j],
						'CREATED_BY'      =>$createdBy,
						
				);

		  	$updateData = DB::table('SBILL_HEAD_PROV')->where('PSBILLHID',$saleheadId)->update($data_import);

		  

		 }

//exit;


		 if($updateData){

			$response_array['response'] = 'success';
			//$response_array['lastid'] = $headID;
		    $data = json_encode($response_array);
		    print_r($data);

		   }else{

			$response_array['response'] = 'error';
		    $data = json_encode($response_array);
		    print_r($data);

		   }



    }
    /*eproc status*/



    /*vehicleplaning approve*/

     public function ApproveVehiclePlaningView(Request $request){

        $title = "TRIP EXPENSES PAYMENT ADVICE";

        $company_name = $request->session()->get('company_name');
        $getcomcode   = explode('-', $company_name);
        $comp_code    = $getcomcode[0];
        $macc_year    = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid       = $request->session()->get('userid');

       

		$userdata['acc_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userdata['vehicle_list'] = DB::table('TRIP_HEAD')->WHERE('TRIP_PMT_STATUS','0')->get();
		$userdata['tran_list'] = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','A2')->get()->first();

		$series_data = DB::table('MASTER_CONFIG')->WHERE('TRAN_CODE','A2')->WHERE('SERIES_CODE','JT')->WHERE('COMP_CODE',$comp_code)->get()->first();

	    if($series_data){

	      $userdata['series_list'] = $series_data;

	    }else{

	      $userdata['series_list']='';
	    }

		$userdata['taxList'] = DB::table('MASTER_TAX')->get();

		$userdata['ratval_list'] = DB::table('MASTER_RATE_VALUE')->get();

		$fy_list = DB::table('MASTER_FY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->get();

		foreach ($fy_list as $key) {	

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}
 

        if(isset($company_name)){

            return view('admin.finance.transaction.logistic.vehicle_planing_approve',$userdata);
        }else{

            return redirect('/useractivity');

        }

    }

 public function TripPlanPaymentAdvice(Request $request){

        if($request->ajax()) {

             if (!empty($request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
            
             
                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  TRIP_HEAD.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

              	$data = DB::select("SELECT TRIP_HEAD.FY_CODE,TRIP_HEAD.SERIES_CODE,TRIP_HEAD.TRIPHID AS tripHeadId,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_HEAD.FREIGHT_QTY,TRIP_HEAD.ADV_RATE,TRIP_HEAD.ADV_AMT,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1 $strWhere AND  TRIP_HEAD.OWNER='MARKET' AND TRIP_HEAD.TRIP_PMT_STATUS='0' AND TRIP_HEAD.COMP_CODE='$comp_code'  GROUP BY TRIP_BODY.TRIPHID");

              
                $discriptn_page = "Search purchase indent report by user";
                $accountCd = '';
             //   $this->userLogInsert($loginUser,$vrseqNum,$series_code,$discriptn_page,$accountCd);  
                
                return DataTables()->of($data)->addIndexColumn()->make(true);
                       
               

            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
                
               

            }

        }else{

            $data = array();

            return DataTables()->of($data)->make(true);

        }


    }


    public function saveVehiclePaymentAdvice(Request $request){

    	     $company_name = $request->session()->get('company_name');
    	     $getcomcode   = explode('-', $company_name);
             $compCode    = $getcomcode[0];
		     $fisYear    = $request->session()->get('macc_year');
		     $createdBy      = $request->session()->get('userid');
			
			

	DB::beginTransaction();

		try {

				$getid = $request->flitClass;

				$getcountid = count($getid);

				for ($i=0; $i < $getcountid ; $i++) { 

		  			$checkid = $getid[$i];

		  			//print_r($checkid);

		  			$data = DB::select("SELECT TRIP_HEAD.* FROM TRIP_HEAD WHERE TRIPHID='$checkid'");


		  			foreach ($data as $key) {

		  				
		  				$tran_code    = 'A9';
		  				$series_code  = 'FA';
		  				$series_name  = 'FREIGHT PAYMENT ADVICE';
		  				$comp_code    = $key->COMP_CODE;
		  				$pfct_code    = $key->PFCT_CODE;
		  				$vr_no        = $key->VRNO;
		  				$pfct_name    = $key->PFCT_NAME;
		  				$vr_date      = $key->VRDATE;
		  				$acc_code     = $key->TRANSPORT_CODE;
		  				$acc_name     = $key->TRANSPORT_NAME;
		  				$advanceAmt   = $key->ADV_AMT;
		  				$FrtAmt       = $key->AMOUNT;
		  				$vehicleNo    = $key->VEHICLE_NO;
		  				$from_place   = $key->FROM_PLACE;
		  				$to_place     = $key->TO_PLACE;
		  				$FrtQty       = $key->FREIGHT_QTY;
		  				$FrtRate      = $key->FPO_RATE;
		  				$TripHid      = $key->TRIPHID;
		  				$emp_code     = $key->EMP_CODE;
		  				$emp_name     = $key->EMP_NAME;
		  				$FrtuserId    = $key->CREATED_BY;

		  				$particular = 'Truck No : '.$vehicleNo.' '.'QTY : '.$FrtQty.' @'.$FrtRate.'/- AMT: '.$FrtAmt.'/-'.'ADV AMT'.$advanceAmt.' FROM '.$from_place.' TO '.$to_place.' BY '.$emp_name;

		  				$StoreB = DB::select("SELECT MAX(PAYID) as PAYID FROM PAYMENT_ADVICE_TRAN");

						$bodyID = json_decode(json_encode($StoreB), true); 
				
						if(empty($bodyID[0]['PAYID'])){
						$bodyId = 1;
						}else{
						$bodyId = $bodyID[0]['PAYID']+1;
						}

						


		/* ----- /. START : VRNO CREATE OR GET FROM DB -------- */

								if ($checkid){


									$lastVrno1 =  DB::table('MASTER_VRSEQ')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$tran_code)->where('SERIES_CODE',$series_code)->get()->first();

									$lastVrno = json_decode(json_encode($lastVrno1),true);
								
									if ($lastVrno) {

									   $newVr = $lastVrno['LAST_NO'] + 1;

									   $datavrn =array(
										   'LAST_NO' => $newVr
										);

									   DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$tran_code)->update($datavrn);

									}else{

										$datavrnIn =array(
											'COMP_CODE'   => $comp_code,
											'FY_CODE'     => $fisYear,
											'TRAN_CODE'   => $tran_code,
											'SERIES_CODE' => $series_code,
											'FROM_NO'     => 1,
											'TO_NO'       => 99999,
											'LAST_NO'     => 1,
											'CREATED_BY'  => $createdBy,
										);

										DB::table('MASTER_VRSEQ')->insert($datavrnIn);

										$newVr = 1;


									}

								}else{

									/* DO NOTHING SAME VRNO FOR SAME DELIVERY NO */

								}

/*
						$getvrno =  DB::table('MASTER_VRSEQ')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$tran_code)->where('SERIES_CODE',$series_code)->get()->first();

					        if($getvrno==''){
					          $last_no = 1;
					        }else{
					          $last_no = $getvrno->LAST_NO;
					        }

					        $getJvVrno =  DB::table('PAYMENT_ADVICE_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$tran_code)->where('SERIES_CODE',$series_code)->where('VRNO',$last_no)->get()->first();

					        if($getJvVrno){
					          $JvVrNo = $getJvVrno->VRNO + 1;
					        }else{
					          $JvVrNo = $last_no;
					        }*/

					        $slno = $i + 1;

		  					$payment_data = array(
		  							'PAYID'        =>$bodyId,
		  							'COMP_CODE'    =>$comp_code,
		  							'FY_CODE'      =>$fisYear,
		  							'VRNO'         =>$newVr,
		  							'SLNO'         =>$slno,
		  							'SERIES_CODE'  =>$series_code,
		  							'VRDATE'       =>$vr_date,
		  							'TRAN_CODE'    =>$tran_code,
		  							'SERIES_NAME'  =>$series_name,
		  							'PFCT_CODE'    =>$pfct_code,
		  							'PFCT_NAME'    =>$pfct_name,
		  							'ACC_CODE'     =>$acc_code,
		  							'ACC_NAME'     =>$acc_name,
		  							'ADVICE_AMT'   =>$advanceAmt,
		  							'NET_AMT'      =>$advanceAmt,
		  							'REMARK'       =>$particular,
		  							'REF_VRNO'     =>$vr_no,
		  							'REF_ID'       =>$TripHid,
		  							'CREATED_BY'   =>$createdBy,

		  					);


		  					/*echo "<pre>";

		  					print_r($payment_data);*/
		  		
		  				$saveData = DB::table('PAYMENT_ADVICE_TRAN')->insert($payment_data);


		  				$trip_data = array(


		  					'TRIP_PMT_STATUS' =>1,
		  				);


		  				$updatedata =  DB::table('TRIP_HEAD')->where('TRIPHID',$checkid)->update($trip_data);

		  			}

		  			
		  		}
//exit;

		    DB::commit();
	       	$response_array['response'] = 'success';
		    $data = json_encode($response_array);
		    print_r($data);

          }catch (\Exception $e){

			    DB::rollBack();
			    throw $e;
			    $response_array['response'] = 'error';
	            $data = json_encode($response_array);
	            print_r($data);
			}
		 


	}
		
		
    /*vehicleplaning approve*/


    public function CreateExpenseJvSelf(Request $request){

        $title = "Transporter Bill Posting";

        $company_name = $request->session()->get('company_name');
        $getcomcode   = explode('-', $company_name);
        $comp_code    = $getcomcode[0];
        $macc_year    = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid       = $request->session()->get('userid');

       

		$userdata['acc_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userdata['vehicle_list'] = DB::table('TRIP_HEAD')->WHERE('TRIP_PMT_STATUS','0')->get();
		$userdata['tran_list'] = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','A2')->get()->first();

		$series_data = DB::table('MASTER_CONFIG')->WHERE('TRAN_CODE','A2')->WHERE('SERIES_CODE','JT')->WHERE('COMP_CODE',$comp_code)->get()->first();

		$fy_list = DB::table('MASTER_FY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->get();

		foreach ($fy_list as $key) {	

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

    if($series_data){

      $userdata['series_list'] = $series_data;

    }else{

      $userdata['series_list']='';
    }

		$userdata['taxList'] = DB::table('MASTER_TAX')->get();

		$userdata['ratval_list'] = DB::table('MASTER_RATE_VALUE')->get();
 

        if(isset($company_name)){

            return view('admin.finance.transaction.logistic.create_expense_jv',$userdata);
        }else{

            return redirect('/useractivity');

        }

    }



    public function TripExpenseJv(Request $request){

        if($request->ajax()) {

             if (!empty($request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
            
             
                
                

             
                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  TRIP_HEAD.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

              	/*$data = DB::select("SELECT TRIP_HEAD.TRIPHID AS tripHeadId,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.OWNER,TRIP_HEAD.VEHICLE_TYPE,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_HEAD.FREIGHT_QTY,TRIP_HEAD.ADV_RATE,TRIP_HEAD.ADV_AMT,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1 $strWhere AND  TRIP_HEAD.OWNER='SELF' AND TRIP_HEAD.TRIP_EXP_STATUS='1' AND TRIP_HEAD.TRIP_PMT_STATUS='0'  GROUP BY TRIP_BODY.TRIPHID");*/

              	//DB::enableQueryLog();
              	$data = DB::select("SELECT TRIP_HEAD.TRIPHID AS tripHeadId,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.OWNER,TRIP_HEAD.VEHICLE_TYPE,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_HEAD.FREIGHT_QTY,TRIP_HEAD.ADV_RATE,TRIP_HEAD.ADV_AMT,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID LEFT JOIN FLEET_TRAN_EXP ON FLEET_TRAN_EXP.TRIPHID = TRIP_HEAD.TRIPHID WHERE 1=1 $strWhere AND  TRIP_HEAD.OWNER='SELF' AND TRIP_HEAD.TRIP_EXP_STATUS='1' AND TRIP_HEAD.TRIP_PMT_STATUS='0'  GROUP BY TRIP_BODY.TRIPHID");

              	//dd(DB::getQueryLog());
                $discriptn_page = "Search purchase indent report by user";
                $accountCd = '';
             //   $this->userLogInsert($loginUser,$vrseqNum,$series_code,$discriptn_page,$accountCd);  
                
                return DataTables()->of($data)->addIndexColumn()->make(true);
                       
               

            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
                
               

            }

        }else{

            $data = array();

            return DataTables()->of($data)->make(true);

        }


    }


public function SaveExpenseJvSelf(Request $request){

    	     $company_name = $request->session()->get('company_name');
    	     $getcomcode   = explode('-', $company_name);
             $compCode    = $getcomcode[0];
		     $fisYear    = $request->session()->get('macc_year');
		     $loginUser      = $request->session()->get('userid');
		   //  $loginUser      = $request->session()->get('userid');
			
			

	DB::beginTransaction();

		try {

			DB::table('INDICATOR_TEMP')->where('CREATED_BY',$loginUser)->where('TCFLAG','CEJV')->delete();
			DB::table('INDICATOR_TEMP')->where('CREATED_BY',$loginUser)->where('TCFLAG','RCEJV')->delete();

				$getid = $request->flitClass;

				$getcountid = count($getid);

				$downloadFlg = $request->downloadFlg;
				  

				$VrnoJv = array();

				for ($i=0; $i < $getcountid ; $i++) { 

		  			$checkid = $getid[$i];

		  			//$data = DB::select("SELECT TRIP_HEAD.* FROM TRIP_HEAD WHERE TRIPHID='$checkid'");
		  			$data = DB::select("SELECT H.*,B.ITEM_NAME,B.QTY,B.UM FROM TRIP_HEAD H,TRIP_BODY B WHERE H.TRIPHID = B.TRIPHID AND H.TRIPHID='$checkid' AND H.OWNER='SELF' AND H.TRIP_EXP_STATUS='1' AND H.TRIP_PMT_STATUS='0' GROUP BY H.TRIPHID");


		  			//print_r($data);

		  			foreach ($data as $key) {

		  				
		  				$comp_code    = $key->COMP_CODE;
		  				$tran_code    = 'A2';
		  				$seriescode   = 'JT';
		  				$seriesName   = 'JOURNAL TRANSPORTATION';
		  				$pfct_code    = $key->PFCT_CODE;
		  				$NewVrno      = $key->VRNO;
		  				$pfctcode     = $key->PFCT_CODE;
		  				$pfctname     = $key->PFCT_NAME;
		  				$transcode    = $key->TRAN_CODE;
		  				$vehicleNo    = $key->VEHICLE_NO;
		  				$fromplace    = $key->FROM_PLACE;
		  				$toplace      = $key->TO_PLACE;
		  				$lrDate       = $key->LR_DATE;
		  				$qty          = $key->FREIGHT_QTY;
		  				$itemName     = $key->ITEM_NAME;
		  				$driverName   = $key->DRIVER_NAME;
		  				$unitM        = $key->UM;
		  				$acc_code     = $key->ACC_CODE;
		  				$acc_name     = $key->ACC_NAME;
		  				$rcomp_code   = $key->REXP_COMP_CODE;
		  				$rcomp_name   = $key->REXP_COMP_NAME;
		  				$vr_date      = $key->VRDATE;
		  				$advanceAmt   = $key->ADV_AMT;
		  				$srno   = '';

		  				$getCostName =  DB::table('MASTER_FLEET')->where('TRUCK_NO',$vehicleNo)->get()->first();

		  				if($rcomp_code){
		  					$getCompGl =  DB::table('MASTER_ACC')->where('ACC_CODE',$rcomp_code)->get()->first();

		  					$compGlCode = $getCompGl->GL_CODE;
		  					$compGlName = $getCompGl->GL_NAME;
		  				}else{
		  					$compGlCode ='';
		  					$compGlName ='';
		  				}
		  				

		  				if($getCostName){

		  						$cost_code = $getCostName->COST_CODE;
		  						$cost_name = $getCostName->COST_NAME;
		  				}else{
			  					$cost_code ='';
			  					$cost_name ='';
		  				}

		  				$getvrno =  DB::table('MASTER_VRSEQ')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$tran_code)->where('SERIES_CODE',$seriescode)->get()->first();

					        if($getvrno==''){
					          $JvVrNo = 1;

					          array_push($VrnoJv,$JvVrNo);

					        }else{
					          $JvVrNo = $getvrno->LAST_NO +1;

					           array_push($VrnoJv,$JvVrNo);
					        }
					        //print_r($JvVrNo);
		  				
                        $exp_data = DB::select("SELECT FLEET_TRAN_EXP.* FROM FLEET_TRAN_EXP WHERE TRIPHID='$checkid'");

                        $expdata_count = count($exp_data);

                        $payment_data = DB::select("SELECT FLEET_TRAN_PMT.* FROM FLEET_TRAN_PMT WHERE TRIPHID='$checkid'");

		  				$pmtdata_count = count($payment_data);


                        $refexp_data = DB::select("SELECT FLEET_TRAN_EXP.* FROM FLEET_TRAN_EXP WHERE TRIPHID='$checkid' GROUP BY TRIPHID HAVING SUM(REF_AMOUNT) > 0");

                      //  print_r($refexp_data);exit;


                      if($refexp_data){

                          $refcomp_data = DB::select("SELECT * FROM FLEET_TRAN_EXP WHERE TRIPHID='$checkid'");

                          //print_r($refcomp_data);

                          $ref_data_count = DB::select("SELECT SUM(REF_AMOUNT) AS REFAMOUNT  FROM FLEET_TRAN_EXP WHERE TRIPHID='$checkid'");

                          $totrefAmt = $ref_data_count[0]->REFAMOUNT;

                          $refexpdata_count = count($refcomp_data);



                        for ($k=0; $k < $refexpdata_count ; $k++) {

		  				 $rfgettempexp =	DB::table('INDICATOR_TEMP')->where('TRANS_CODE',$tran_code)->where('SERIES_CODE',$seriescode)->where('VRNO',$JvVrNo)->where('CREATED_BY',$loginUser)->where('TCFLAG','RCEJV')->get();

		  				  if(empty($rfgettempexp)){

		  				  	$refchargeData   = array(

			                    'DR_AMT'      => 0.00,
			                    'CR_AMT'	  => $refcomp_data[$k]->REF_AMOUNT,
			                    'IND_GL_CODE' => $refcomp_data[$k]->GL_CODE,
			                    'IND_GL_NAME' => $refcomp_data[$k]->GL_NAME,
			                    'IND_ACC_CODE'=> $exp_data[$j]->ACC_CODE,
			                    'REF_ACCNAME' => $refcomp_data[$k]->IND_NAME,
			                    'TCFLAG'      => 'RCEJV',
			                    'GLACC_Chk'	  => 'GL',
			                    'CREATED_BY'  => $loginUser,
		                	);


		                	DB::table('INDICATOR_TEMP')->insert($refchargeData);

		  				  }else{

		  				  

		  				  	$refexistGl =	DB::table('INDICATOR_TEMP')->where('TRANS_CODE',$tran_code)->where('SERIES_CODE',$seriescode)->where('VRNO',$JvVrNo)->where('IND_GL_CODE',$refcomp_data[$k]->GL_CODE)->where('CREATED_BY',$loginUser)->where('TCFLAG','RCEJV')->get()->first();

		  				

		  				  	if($refexistGl){

		  				  		$CrAmt = $refexistGl->CR_AMT + $refcomp_data[$k]->REF_AMOUNT;

		  				  	
		  				  		$refupdateData   = array(

			                        'DR_AMT'      => 0.00,
				                    'CR_AMT'	  => $CrAmt, 
			                	);

			                	DB::table('INDICATOR_TEMP')->where('TRANS_CODE',$tran_code)->where('SERIES_CODE',$seriescode)->where('VRNO',$JvVrNo)->where('IND_GL_CODE',$refcomp_data[$k]->GL_CODE)->where('CREATED_BY',$loginUser)->where('TCFLAG','RCEJV')->update($refupdateData);

		  				  	}else{

		  				  		$refinsertData   = array(

				                    'DR_AMT'      => 0.00,
				                    'CR_AMT'	  => $refcomp_data[$k]->REF_AMOUNT,
				                    'IND_GL_CODE' => $refcomp_data[$k]->GL_CODE,
				                    'IND_GL_NAME' => $refcomp_data[$k]->GL_NAME,
				                    'IND_ACC_CODE'=> $exp_data[$j]->ACC_CODE,
				                    'REF_ACCNAME' => $refcomp_data[$k]->IND_NAME,
				                    'TCFLAG'      => 'RCEJV',
				                    'GLACC_Chk'	  => 'GL',
				                    'CREATED_BY'  => $loginUser,
			                	);


		                	  DB::table('INDICATOR_TEMP')->insert($refinsertData);
		  				  	}

		  				  }

		  				  if($k==1){

		  				     	$totrefchargeData   = array(

		  				     		    
										
				                    'DR_AMT'      => $totrefAmt,
				                    'CR_AMT'	  => 0.00,
				                    'IND_GL_CODE' => $compGlCode,
				                    'IND_GL_NAME' => $compGlName,
				                    'REF_ACCNAME' => $rcomp_name,
				                    'TCFLAG'      => 'RCEJV',
				                    'GLACC_Chk'	  => 'GL',
				                    'CREATED_BY'  => $loginUser,
		                		);


		                	     DB::table('INDICATOR_TEMP')->insert($totrefchargeData);	
		  				  }

		  				}


                     }
                       
		  				

		  				for ($j=0; $j < $expdata_count ; $j++) {


		  				  $gettempexp =	DB::table('INDICATOR_TEMP')->where('TRANS_CODE',$tran_code)->where('SERIES_CODE',$seriescode)->where('VRNO',$JvVrNo)->where('CREATED_BY',$loginUser)->where('TCFLAG','CEJV')->get();

		  				  if(empty($gettempexp)){

		  				  	$chargeData   = array(

			                    'DR_AMT'      => $exp_data[$j]->AMOUNT,
			                    'CR_AMT'	  => 0.00,
			                    'IND_GL_CODE' => $exp_data[$j]->GL_CODE,
			                    'IND_GL_NAME' => $exp_data[$j]->GL_NAME,
			                    'IND_ACC_CODE'=> $exp_data[$j]->ACC_CODE,
			                    'REF_ACCNAME' => $exp_data[$j]->IND_NAME,
			                    'TRANS_CODE'  => $tran_code,
			                    'SERIES_CODE' => $seriescode,
			                    'VRNO'        => $JvVrNo,
			                    'TCFLAG'      => 'CEJV',
			                    'GLACC_Chk'	  => 'GL',
			                    'CREATED_BY'  => $loginUser,
		                	);


		                	DB::table('INDICATOR_TEMP')->insert($chargeData);

		  				  }else{

		  				  	$existGl =	DB::table('INDICATOR_TEMP')->where('TRANS_CODE',$tran_code)->where('SERIES_CODE',$seriescode)->where('VRNO',$JvVrNo)->where('IND_GL_CODE',$exp_data[$j]->GL_CODE)->where('CREATED_BY',$loginUser)->where('TCFLAG','CEJV')->get()->first();

		  				  	if($existGl){

		  				  		$drAmt = $existGl->DR_AMT + $exp_data[$j]->AMOUNT;

		  				  		$updateData   = array(

			                        'DR_AMT'      => $drAmt,
				                    'CR_AMT'	  => 0.00,
			                	);

			                	DB::table('INDICATOR_TEMP')->where('TRANS_CODE',$tran_code)->where('SERIES_CODE',$seriescode)->where('VRNO',$JvVrNo)->where('IND_GL_CODE',$exp_data[$j]->GL_CODE)->where('CREATED_BY',$loginUser)->where('TCFLAG','CEJV')->update($updateData);

		  				  	}else{

		  				  		$insertData   = array(

				                    'DR_AMT'      => $exp_data[$j]->AMOUNT,
				                    'CR_AMT'	  => 0.00,
				                    'IND_GL_CODE' => $exp_data[$j]->GL_CODE,
				                    'IND_GL_NAME' => $exp_data[$j]->GL_NAME,
				                    'IND_ACC_CODE'=> $exp_data[$j]->ACC_CODE,
				                    'REF_ACCNAME' => $exp_data[$j]->IND_NAME,
				                    'TRANS_CODE'  => $tran_code,
				                    'SERIES_CODE' => $seriescode,
				                    'VRNO'        => $JvVrNo,
				                    'TCFLAG'      => 'CEJV',
				                    'GLACC_Chk'	  => 'GL',
				                    'CREATED_BY'  => $loginUser,
			                	);


		                	  DB::table('INDICATOR_TEMP')->insert($insertData);
		  				  	}

		  				  }
/*
		  					$gl_code = $exp_data[$j]->GL_CODE;
		  					$gl_Name = '';
		  					$particular = $exp_data[$j]->IND_NAME;
		  					$dr_amount =  $exp_data[$j]->AMOUNT;
		  					$cr_amount =  0.00;
		  					$srCode='';
		  					$srName='';
		  					$cost_code='';
		  					$cost_name='';

		  					$expData =  (new AccountingController)->InsertInJournalTran($compCode,$fisYear,$pfctcode,$pfctname,$transcode,$seriescode,$seriesName,$NewVrno,$srno,$vr_date,$acc_code,$acc_name,$gl_code,$gl_Name,$particular,$dr_amount,$cr_amount,$srCode,$srName,$cost_code,$cost_name,$loginUser);*/


		  				}

		  				$getTempExpData = DB::table('INDICATOR_TEMP')->where('TRANS_CODE',$tran_code)->where('SERIES_CODE',$seriescode)->where('VRNO',$JvVrNo)->where('CREATED_BY',$loginUser)->where('TCFLAG','CEJV')->orWhere('TCFLAG','RCEJV')->get();



		  				/*echo '<pre>';

		  				print_r($getTempExpData);

		  				echo '</pre>';*/


		  				$srno = 1;
		  				foreach ($getTempExpData as $key) {

		  					$gl_Name = '';
		  					$particular = 'Being Cash & Diesel Paid For Vehicle No. '.$vehicleNo.' LR DATED '.$lrDate.' FROM '.$fromplace.' TO '.$toplace.' FOR QTY '.$qty.' '.$unitM.' TO '.$driverName.' '.$itemName;
		  					$srCode='';
		  					$srName='';
		  					$acc_Code='';
		  					$acc_Name='';
		  					$pfct_code='';
		  					$blankVal='';
		  					
		  					
		  					$AccCode = $key->IND_ACC_CODE;



		  					$expData =  (new AccountingController)->InsertInJournalTran($compCode,$fisYear,$pfctcode,$pfctname,$tran_code,$seriescode,$seriesName,$JvVrNo,$srno,$vr_date,$acc_Code,$acc_Name,$key->IND_GL_CODE,$key->IND_GL_NAME,$particular,$key->DR_AMT,$key->CR_AMT,$srCode,$srName,$cost_code,$cost_name,$loginUser);

		  					$resultglexp = (new AccountingController)->GlTEntry($compCode,$fisYear,$tran_code,$seriescode,$JvVrNo,$srno,$vr_date,$pfct_code,$key->IND_GL_CODE,$key->IND_GL_NAME,$acc_Code,$acc_Name,$blankVal,$blankVal,$blankVal,$blankVal,$key->DR_AMT,$key->CR_AMT,$particular,$loginUser);


		  					if($AccCode){

		  					$result = (new AccountingController)->AccountTEntry($compCode,$fisYear,$tran_code,$seriescode,$JvVrNo,$srno,$vr_date,$pfct_code,$AccCode,$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$key->DR_AMT,$key->CR_AMT,$particular,$loginUser);
		  					}

		  				$srno++; }
		  				
		  				//print_r($payment_data);exit;

		  				for ($k=0; $k < $pmtdata_count ; $k++) {


		  					$accCode1 = $payment_data[$k]->BANK_CODE;
		  					$accName1 = $payment_data[$k]->BANK_NAME;

		  					$first_character = substr($accCode1, 0, 1);

		  					if($first_character=='A' || $first_character=='B' || $first_character=='R' || $first_character=='X'){

		  					   $gl_code = $payment_data[$k]->BANK_CODE;
		  					   $gl_Name = $payment_data[$k]->BANK_NAME;

		  					   $accCode='';

		  					   $accName='';

		  					}else{

		  						$accCode = $payment_data[$k]->BANK_CODE;
		  					    $accName = $payment_data[$k]->BANK_NAME;

		  					    $getPostingCode = DB::table('MASTER_ACC')->where('ACC_CODE',$accCode)->get()->first();

			  					$gl_code = $getPostingCode->GL_CODE;
			  					$gl_Name = $getPostingCode->GL_NAME;

		  					}
		  					
		  					

		  					$particular = 'Being Cash & Diesel Paid For Vehicle No. '.$vehicleNo.' LR DATE '.$lrDate.' FROM '.$fromplace.' TO '.$toplace.' FOR QTY '.$qty.' '.$unitM.' TO '.$driverName.' '.$itemName;
		  					$dr_amount = '';
		  					$cr_amount = $payment_data[$k]->PAYMENT;
		  					$srCode='';
		  					$srName='';
		  					$srno = $k + 1;

		  					$paymentData =  (new AccountingController)->InsertInJournalTran($compCode,$fisYear,$pfctcode,$pfctname,$tran_code,$seriescode,$seriesName,$JvVrNo,$srno,$vr_date,$accCode,$accName,$gl_code,$gl_Name,$particular,$dr_amount,$cr_amount,$srCode,$srName,$cost_code,$cost_name,$loginUser);


		  					$resultgl = (new AccountingController)->GlTEntry($compCode,$fisYear,$tran_code,$seriescode,$JvVrNo,$srno,$vr_date,$pfct_code,$gl_code,$gl_Name,$accCode,$accName,$blankVal,$blankVal,$blankVal,$blankVal,$dr_amount,$cr_amount,$particular,$loginUser);

		  					$result = (new AccountingController)->AccountTEntry($compCode,$fisYear,$tran_code,$seriescode,$JvVrNo,$srno,$vr_date,$pfct_code,$accCode,$accName,$gl_code,$gl_Name,$blankVal,$blankVal,$blankVal,$blankVal,$dr_amount,$cr_amount,$particular,$loginUser);



		  				}
		  				 // print_r($payment_data);exit;

		  				

		  				$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tran_code)->where('SERIES_CODE',$seriescode)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->get()->toArray();
			//dd(DB::getQueryLog());
			//print_r($checkvrnoExist);exit;

						if(empty($checkvrnoExist)){

							$datavrnIn =array(
								'COMP_CODE'   =>$compCode,
								'FY_CODE'     =>$fisYear,
								'TRAN_CODE'   =>$tran_code,
								'SERIES_CODE' =>$seriescode,
								'FROM_NO'     =>1,
								'TO_NO'       =>99999,
								'LAST_NO'     =>$JvVrNo,
								'CREATED_BY'  =>$loginUser,
							);

							DB::table('MASTER_VRSEQ')->insert($datavrnIn);

						}else{
							$datavrn =array(
								'LAST_NO'=>$JvVrNo
							);
							DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tran_code)->where('SERIES_CODE',$seriescode)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->update($datavrn);
						}



		  				$trip_data = array(


		  					'TRIP_PMT_STATUS' =>1,
		  				);


		  				$updatedata =  DB::table('TRIP_HEAD')->where('TRIPHID',$checkid)->update($trip_data);

		  			}

		  			
		  		}

//exit();
		    DB::commit();


		    if($downloadFlg == 1){

		    	$drAmtTotl ='50000';

				return $this->GeneratePdfForJournalMultiple($compCode,$fisYear,$seriescode,$VrnoJv,$tran_code,$drAmtTotl,$getcountid);
			}

	       	$response_array['response'] = 'success';
		    $data = json_encode($response_array);
		    print_r($data);

          }catch (\Exception $e){

			    DB::rollBack();
			    throw $e;
			    $response_array['response'] = 'error';
	            $data = json_encode($response_array);
	            print_r($data);
			}
		 


	}


	public function GeneratePdfForJournalMultiple($compCode,$fisYear,$seriescode,$vrno,$transCd,$totlAmount,$getcountid){

		$response_array = array();

		header('Content-Type: application/pdf');

	   $urlArray =array();

	   $vrcount = count($vrno);

	  
	   for ($i = 0; $i < $getcountid; $i++) {


				   $data030 = DB::select("SELECT t1.*,t2.SERIES_NAME,t3.ACC_NAME FROM JV_TRAN t1 LEFT JOIN MASTER_CONFIG t2 ON t2.SERIES_CODE=t1.SERIES_CODE AND t2.COMP_CODE=t1.COMP_CODE AND t2.TRAN_CODE=t1.TRAN_CODE LEFT JOIN MASTER_ACC t3 ON t3.ACC_CODE=t1.ACC_CODE WHERE t1.COMP_CODE='$compCode' AND t1.FY_CODE='$fisYear' AND t1.SERIES_CODE='$seriescode' AND t1.VRNO='$vrno[$i]' AND t1.TRAN_CODE='$transCd'");
					
					$compCode   = $data030[0]->COMP_CODE;
					$compDetail = DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$compCode'");

					$title='JOURNAL REPORT';

					$amtInWord = (new AccountingController)->amountInWords($totlAmount);



					$pdf = PDF::loadView('admin.finance.transaction.account.journalPDF',compact('data030','title','compDetail','amtInWord'));

					$path = public_path('dist/downloadpdf'); 
					$fileName =  $i.time().'Contra.'. 'pdf' ; 
					$pdf->save($path . '/' . $fileName);
					$PublicPath = url('public/dist/downloadpdf/');  
					$downloadPdf = $PublicPath.'/'.$fileName;
					$response_array['fileName'] = $fileName;
					
					array_push($urlArray,$downloadPdf);
	   	
	  		 }

			$response_array['response'] = 'success';
			$response_array['url'] = $urlArray;
			$response_array['data'] = $data030;
			echo $data = json_encode($response_array);


	}


	public function ConvertAmountIntoWordForJv($totlAmount,$compDetail,$data030,$title,$amtInWord){

		$response_array = array();

		$num = str_replace(array(',', ' '), '' , trim($totlAmount));

		//print_r($num);exit;
		if(! $num) {
			return false;
		}
		$num = (int) $num;
		$words = array();
		$list1 = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven',
			'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
		);
		$list2 = array('', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety', 'Hundred');
		$list3 = array('', 'Thousand', 'Million', 'Billion', 'Trillion', 'Quadrillion', 'Quintillion', 'Sextillion', 'Septillion',
			'Octillion', 'Nonillion', 'Decillion', 'Nndecillion', 'Duodecillion', 'Tredecillion', 'Quattuordecillion',
			'Quindecillion', 'Sexdecillion', 'Septendecillion', 'Octodecillion', 'Novemdecillion', 'Vigintillion'
		);
		$num_length = strlen($num);
		$levels = (int) (($num_length + 2) / 3);
		$max_length = $levels * 3;
		$num = substr('00' . $num, -$max_length);
		$num_levels = str_split($num, 3);
		for ($i = 0; $i < count($num_levels); $i++) {
			$levels--;
			$hundreds = (int) ($num_levels[$i] / 100);
			$hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
			$tens = (int) ($num_levels[$i] % 100);
			$singles = '';
			if ( $tens < 20 ) {
				$tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
			} else {
				$tens = (int)($tens / 10);
				$tens = ' ' . $list2[$tens] . ' ';
				$singles = (int) ($num_levels[$i] % 10);
				$singles = ' ' . $list1[$singles] . ' ';
			}
			$words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
		} //end for loop
		$commas = count($words);
		if ($commas > 1) {
			$commas = $commas - 1;
		}
		//return implode(' ', $words);

		$numwords= implode(' ', $words);

		

	}

public function SaveExpenseJvSelf1(Request $request){

    	     $company_name = $request->session()->get('company_name');
    	     $getcomcode   = explode('-', $company_name);
             $compCode    = $getcomcode[0];
		     $fisYear    = $request->session()->get('macc_year');
		     $loginUser      = $request->session()->get('userid');
			
			

	DB::beginTransaction();

		try {

			DB::table('INDICATOR_TEMP')->where('CREATED_BY',$loginUser)->where('TCFLAG','CEJV')->delete();

				$getid = $request->flitClass;

				$getcountid = count($getid);

				  



				for ($i=0; $i < $getcountid ; $i++) { 

		  			$checkid = $getid[$i];

		  			//$data = DB::select("SELECT TRIP_HEAD.* FROM TRIP_HEAD WHERE TRIPHID='$checkid'");
		  			$data = DB::select("SELECT H.*,B.ITEM_NAME,B.QTY,B.UM FROM TRIP_HEAD H,TRIP_BODY B WHERE H.TRIPHID = B.TRIPHID AND H.TRIPHID='$checkid'");



		  			foreach ($data as $key) {

		  				
		  				$comp_code    = $key->COMP_CODE;
		  				$tran_code    = 'A2';
		  				$seriescode   = 'JT';
		  				$seriesName   = 'JOURNAL TRANSPORTATION';
		  				$pfct_code    = $key->PFCT_CODE;
		  				$NewVrno      = $key->VRNO;
		  				$pfctcode     = $key->PFCT_CODE;
		  				$pfctname     = $key->PFCT_NAME;
		  				$transcode    = $key->TRAN_CODE;
		  				$vehicleNo    = $key->VEHICLE_NO;
		  				$fromplace    = $key->FROM_PLACE;
		  				$toplace      = $key->TO_PLACE;
		  				$lrDate       = $key->LR_DATE;
		  				$qty          = $key->FREIGHT_QTY;
		  				$itemName     = $key->ITEM_NAME;
		  				$driverName   = $key->DRIVER_NAME;
		  				$unitM        = $key->UM;
		  				$acc_code     = '';
		  				$acc_name     = '';
		  				$vr_date     = $key->VRDATE;
		  				$advanceAmt   = $key->ADV_AMT;
		  				$srno   = '';


		  				$getvrno =  DB::table('MASTER_VRSEQ')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$tran_code)->where('SERIES_CODE',$seriescode)->get()->first();

					        if($getvrno==''){
					          $last_no = 1;
					        }else{
					          $last_no = $getvrno->LAST_NO;
					        }

					        $getJvVrno =  DB::table('JV_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$tran_code)->where('SERIES_CODE',$seriescode)->where('VRNO',$last_no)->get()->first();

					        if($getJvVrno){
					          $JvVrNo = $getJvVrno->VRNO + 1;
					        }else{
					          $JvVrNo = $last_no;
					        }

		  				
                        $exp_data = DB::select("SELECT FLEET_TRAN_EXP.* FROM FLEET_TRAN_EXP WHERE TRIPHID='$checkid'");

                        $expdata_count = count($exp_data);

		  				$payment_data = DB::select("SELECT FLEET_TRAN_PMT.* FROM FLEET_TRAN_PMT WHERE TRIPHID='$checkid'");

		  				$pmtdata_count = count($payment_data);

		  				

		  				for ($j=0; $j < $expdata_count ; $j++) {


		  				  $gettempexp =	DB::table('INDICATOR_TEMP')->where('CREATED_BY',$loginUser)->where('TCFLAG','CEJV')->get();

		  				  if(empty($gettempexp)){

		  				  	$chargeData   = array(

			                    'DR_AMT'      => $exp_data[$j]->AMOUNT,
			                    'CR_AMT'	  => 0.00,
			                    'IND_GL_CODE' => $exp_data[$j]->GL_CODE,
			                    'REF_ACCNAME' => $exp_data[$j]->IND_NAME,
			                    'TCFLAG'      => 'CEJV',
			                    'GLACC_Chk'	  => 'GL',
			                    'CREATED_BY'  => $loginUser,
		                	);


		                	DB::table('INDICATOR_TEMP')->insert($chargeData);

		  				  }else{

		  				  	$existGl =	DB::table('INDICATOR_TEMP')->where('IND_GL_CODE',$exp_data[$j]->GL_CODE)->where('CREATED_BY',$loginUser)->where('TCFLAG','CEJV')->get()->first();

		  				  	if($existGl){

		  				  		$drAmt = $existGl->DR_AMT + $exp_data[$j]->AMOUNT;

		  				  		$updateData   = array(

			                        'DR_AMT'      => $drAmt,
				                    'CR_AMT'	  => 0.00,
			                	);

			                	DB::table('INDICATOR_TEMP')->where('IND_GL_CODE',$exp_data[$j]->GL_CODE)->where('CREATED_BY',$loginUser)->where('TCFLAG','CEJV')->update($updateData);

		  				  	}else{

		  				  		$insertData   = array(

				                    'DR_AMT'      => $exp_data[$j]->AMOUNT,
				                    'CR_AMT'	  => 0.00,
				                    'IND_GL_CODE' => $exp_data[$j]->GL_CODE,
				                    'REF_ACCNAME' => $exp_data[$j]->IND_NAME,
				                    'TCFLAG'      => 'CEJV',
				                    'GLACC_Chk'	  => 'GL',
				                    'CREATED_BY'  => $loginUser,
			                	);


		                	  DB::table('INDICATOR_TEMP')->insert($insertData);
		  				  	}

		  				  }
/*
		  					$gl_code = $exp_data[$j]->GL_CODE;
		  					$gl_Name = '';
		  					$particular = $exp_data[$j]->IND_NAME;
		  					$dr_amount =  $exp_data[$j]->AMOUNT;
		  					$cr_amount =  0.00;
		  					$srCode='';
		  					$srName='';
		  					$cost_code='';
		  					$cost_name='';

		  					$expData =  (new AccountingController)->InsertInJournalTran($compCode,$fisYear,$pfctcode,$pfctname,$transcode,$seriescode,$seriesName,$NewVrno,$srno,$vr_date,$acc_code,$acc_name,$gl_code,$gl_Name,$particular,$dr_amount,$cr_amount,$srCode,$srName,$cost_code,$cost_name,$loginUser);*/


		  				}

		  				$getTempExpData = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$loginUser)->where('TCFLAG','CEJV')->get();

		  				$srno = 1;
		  				foreach ($getTempExpData as $key) {

		  					$gl_Name = '';
		  					$particular = 'Being Cash & Diesel Paid For Vehicle No.'.$vehicleNo.' LR DATED'.$lrDate.' FROM'.$fromplace.' TO'.$toplace.' FOR QTY'.$qty.' '.$unitM.' TO'.$driverName.' '.$itemName;
		  					$srCode='';
		  					$srName='';
		  					$cost_code='';
		  					$cost_name='';
		  					
		  					$expData =  (new AccountingController)->InsertInJournalTran($compCode,$fisYear,$pfctcode,$pfctname,$tran_code,$seriescode,$seriesName,$JvVrNo,$srno,$vr_date,$acc_code,$acc_name,$key->IND_GL_CODE,$gl_Name,$particular,$key->DR_AMT,$key->CR_AMT,$srCode,$srName,$cost_code,$cost_name,$loginUser);
		  				$srno++; }
		  				
		  				//print_r($payment_data);exit;

		  				for ($k=0; $k < $pmtdata_count ; $k++) {

		  					$gl_code = $payment_data[$k]->BANK_CODE;
		  					$gl_Name = $payment_data[$k]->BANK_NAME;
		  					$particular = 'Being Cash & Diesel Paid For Vehicle No.'.$vehicleNo.' LR DATED'.$lrDate.' FROM'.$fromplace.' TO'.$toplace.' FOR QTY'.$qty.' '.$unitM.' TO'.$driverName.' '.$itemName;
		  					$dr_amount = '';
		  					$cr_amount = $payment_data[$k]->PAYMENT;
		  					$srCode='';
		  					$srName='';
		  					$cost_code='';
		  					$cost_name='';
		  					$srno = $k + 1;

		  					$paymentData =  (new AccountingController)->InsertInJournalTran($compCode,$fisYear,$pfctcode,$pfctname,$tran_code,$seriescode,$seriesName,$JvVrNo,$srno,$vr_date,$acc_code,$acc_name,$gl_code,$gl_Name,$particular,$dr_amount,$cr_amount,$srCode,$srName,$cost_code,$cost_name,$loginUser);

		  				}
		  				 // print_r($payment_data);exit;

		  					


		  				$trip_data = array(


		  					'TRIP_PMT_STATUS' =>1,
		  				);


		  				$updatedata =  DB::table('TRIP_HEAD')->where('TRIPHID',$checkid)->update($trip_data);

		  			}

		  			
		  		}


		    DB::commit();
	       	$response_array['response'] = 'success';
		    $data = json_encode($response_array);
		    print_r($data);

          }catch (\Exception $e){

			    DB::rollBack();
			    throw $e;
			    $response_array['response'] = 'error';
	            $data = json_encode($response_array);
	            print_r($data);
			}
		 


	}

/* ------------ START : STORE REQUISITION -------- */
	
	public function getDataForitemStore(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$itemCode       = $request->input('ItemCode');
			$batchNo        = $request->input('batchNo');
			$fieldType      = $request->input('fieldType');
			$itemBatchchk   = $request->input('itemBatch');
			$ItemBatch_data ='';
			$item_data      ='';
			$batchWiseQty   ='';
			$itemUm         ='';

			$itemUm = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get();

			if ($itemUm) {

				$response_array['response']         = 'success';
				$response_array['data_itemUm']      = $itemUm;
				
	           	echo $data = json_encode($response_array);

			}else{

				$response_array['response']         = 'error';
				$response_array['data_itemUm']      = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

				$response_array['response']         = 'error';
				$response_array['data_itemUm']      = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

	}

	public function GeStoreTranItemDetailsAginstNo(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$reqHeadID = $request->input('reqHeadID');
			$tran_Type      = $request->input('tranType');

			if($tran_Type == 'STORE_RETURN'){

				$itemDetails = DB::select("SELECT CONCAT(SUBSTRING(A.FY_CODE, 1, 4),'/',A.SERIES_CODE,'/',A.VRNO) AS VRNO,B.SREQBID,B.ITEM_CODE,B.ITEM_NAME,B.REQ_QTYISSUED,B.QTYISSUED,B.AQTYISSUED,B.RET_QTYISSUED,QTYRECD AS REQ_QTY,QTYISSUED AS ISSUE_QTY,A.PLANT_CODE,B.UM,B.AUM,(SELECT AUM_FACTOR FROM MASTER_ITEM WHERE ITEM_CODE=B.ITEM_CODE AND UM=B.UM AND AUM=B.AUM) AS CFACTOR FROM SREQ_HEAD A,SREQ_BODY B WHERE A.SREQHID=B.SREQHID AND A.STORE_ACTION=B.STORE_ACTION AND B.SREQHID='$reqHeadID'");

			}/*else if($tran_Type == 'ISSUE'){
				$itemDetails =DB::select("SELECT *  FROM SREQ_BODY WHERE STORE_ACTION='REQ' AND SREQHID='' ");
			}*/

			if ($itemDetails) {

				$response_array['response']  = 'success';
				$response_array['item_data'] = $itemDetails;
				
	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response']  = 'error';
				$response_array['item_data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

				$response_array['response']  = 'error';
				$response_array['item_data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

	}


	public function GetBatchNoAgainstItem(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$company_name = $request->session()->get('company_name');
			$explodeCnm   = explode('-', $company_name);
			$compCode     = $explodeCnm[0];
			$macc_year    = $request->session()->get('macc_year');
			$plantCd      = $request->input('plantCode');
			$itemCd       = $request->input('selitemcode');
			$batchNo      = $request->input('batchNo');
			$itembatchList= '';
			//print_r($batchNo);
			//DB::enableQueryLog();
			if($batchNo){
				//DB::enableQueryLog();
				$batchNoList = DB::select("SELECT * FROM MASTER_ITEMBAL WHERE COMP_CODE='$compCode' AND FY_CODE='$macc_year' AND PLANT_CODE='$plantCd' AND BATCH_NO='$batchNo' AND ITEM_CODE='$itemCd'");
				//dd(DB::getQueryLog());
			}else{

				$batchNoList = DB::select("SELECT * FROM MASTER_ITEMBAL WHERE COMP_CODE='$compCode' AND FY_CODE='$macc_year' AND PLANT_CODE='$plantCd' AND ITEM_CODE='$itemCd'");

			}

			if($itemCd){
				//DB::enableQueryLog();
				$itembatchList = DB::select("SELECT * FROM MASTER_ITEMBAL WHERE COMP_CODE='$compCode' AND FY_CODE='$macc_year' AND PLANT_CODE='$plantCd' AND ITEM_CODE='$itemCd' AND BATCH_NO !='' AND BATCH_NO IS NOT NULL");
				//dd(DB::getQueryLog());
			}else{
				$itembatchList ='';
			}


			//dd(DB::getQueryLog());
			if ($batchNoList || $itembatchList) {

				$response_array['response']  = 'success';
				$response_array['batch_list'] = $batchNoList;
				$response_array['item_batch_list'] = $itembatchList;
	            echo $data = json_encode($response_array);
	            //print_r($data);

			}else{

				$response_array['response']  = 'error';
				$response_array['batch_list'] = '' ;
				$response_array['item_batch_list'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
				
			}

	    }else{

				$response_array['response']  = 'error';
				$response_array['batch_list'] = '' ;
				$response_array['item_batch_list'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
	    }

	}



	function GetRequistionDetails(Request $request){

		$response_array = array();

		if($request->ajax()){

			$company_name = $request->session()->get('company_name');
			$explodeCnm   = explode('-', $company_name);
			$compCode     = $explodeCnm[0];
			$macc_year    = $request->session()->get('macc_year');
			$reqId        = $request->msg;

	        $reqDetails  = DB::table('SREQ_HEAD')->where('SREQHID',$reqId)->where('STORE_ACTION','REQ')->get()->first();


	        if($reqDetails) {

				$response_array['response']  = 'success';
				$response_array['data'] = $reqDetails;
	            echo $data = json_encode($response_array);
	            //print_r($data);

			}else{

				$response_array['response']  = 'error';
				$response_array['data'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
				
			}

		}else{

			    $response_array['response']  = 'error';
				$response_array['data'] = '' ;
                $data = json_encode($response_array);
                print_r($data);

		}

	}
/* ------------ END : STORE REQUISITION -------- */


}
