<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Session;
use PHPMailer\PHPMailer\PHPMailer;
use Validator;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Schema;

class ProductionController extends Controller
{


    public function AddProduction(Request $request){

		$title       ='Add Production';
		
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['fg_list']        = DB::table('MASTER_ITEM')->where(['ITEMTYPE_CODE'=>'FG'])->get();

		$userdata['existfgcode']   = DB::table('PRODUCTION_HEAD')->get()->first();

		if($userdata['existfgcode']){

			$FGITEM_CODE = $userdata['existfgcode']->ITEM_CODE;

		}else{

			$FGITEM_CODE = '';
		}

		

		//print_r($FGITEM_CODE);

		$userdata['fg_list']     = DB::table('MASTER_ITEM')->where(['ITEMTYPE_CODE'=>'FG'])->where('ITEM_CODE','!=',$FGITEM_CODE)->get();

		
		
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'M1'])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']  = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
		//DB::enableQueryLog();
		$userdata['dept_list']      = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']     = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']      = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->where(['ITEMTYPE_CODE'=>'RM'])->get();
		
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}


		$purchase = DB::table('BOM_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->where('BOM_TYPE','BOM')->get();

		   	$vrseqnum = '';
			foreach ($purchase as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','M1')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='M1'");
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

		    return view('admin.finance.transaction.production.production',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
	}


	 public function SaveProduction(Request $request){

			$createdBy       = $request->session()->get('userid');
			$compName        = $request->session()->get('company_name');
			$compcode        = explode('-', $compName);
			$getcompcode     = $compcode[0];
			$fisYear         = $request->session()->get('macc_year');
			$comp_nameval    = $request->input('comp_name');
			$fy_year         = $request->input('fy_year');
			$trans_code      = $request->input('trans_code');
			$series_code     = $request->input('series_code');
			$series_name     = $request->input('series_name');
			$vr_no           = $request->input('vr_no');
			$trans_date      = $request->input('trans_date');
			$tr_vr_date      = date("Y-m-d", strtotime($trans_date));
			
			$plant_code      = $request->input('plant_code');
			$plant_name      = $request->input('plant_name');
			$fg_code         = $request->input('fgcode');
			$fg_name         = $request->input('fgname');
			$item_code       = $request->input('item_code');
			$countItemCode   = count($item_code);
			$item_name       = $request->input('item_name');
			$remark          = $request->input('remark');
			$qty             = $request->input('qty');
			$unit_M          = $request->input('unit_M');
			$Aqty            = $request->input('Aqty');
			$add_unit_M      = $request->input('add_unit_M');
			$issueqty        = $request->input('issueqty');
			$issueunit_M     = $request->input('issueunit_M');
			$issueAqty       = $request->input('issueAqty');
			$issueadd_unit_M = $request->input('issueadd_unit_M');			
			$rate            = $request->input('rate');
			$basic_amt       = $request->input('basic_amt');
			$hsn_code        = $request->input('hsn_code');
			$head_tax_ind    = $request->input('head_tax_ind');
			$item_category   = $request->input('item_category');
			$iqua_char       = $request->input('iqua_char');
			$iqua_desc       = $request->input('iqua_desc');
			$char_fromvalue  = $request->input('char_fromvalue');
			$char_tovalue    = $request->input('char_tovalue');
			$quaP_count      = $request->input('quaP_count');
			$allquaPcount    = $request->input('allquaPcount');
			$item_code_que   = $request->input('item_code_que');
			$bom_type        = $request->input('bom_type');
			$prodQty         = $request->input('prodQty');
			$cost_code       = $request->input('cost_code');
			$cost_name       = $request->input('cost_name');
		


		//print_r($quaP_count);exit();

			$GateH = DB::select("SELECT MAX(BOMHID) as BOMHID FROM BOM_HEAD");
			$headID = json_decode(json_encode($GateH), true); 
	  //  print_r($headID);exit;
	
			if(empty($headID[0]['BOMHID'])){
			$headId = 1;
			}else{
			$headId = $headID[0]['BOMHID']+1;
			}

			if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('BOM_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}
	
		DB::beginTransaction();

		try {	

		$datahead = array(

				'BOMHID'      =>$headId,
				'COMP_CODE'   =>$getcompcode,
				'FY_CODE'     =>$fisYear,
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'SERIES_NAME' =>$series_name,
				'VRNO'        =>$NewVrno,
				'VRDATE'      =>$tr_vr_date,
				'PLANT_CODE'  =>$plant_code,		
				'PLANT_NAME'  =>$plant_name,		
				'ITEM_CODE'   =>$fg_code,
				'ITEM_NAME'   =>$fg_name,
				'PROD_QTY'    =>$prodQty,
				'BOM_TYPE'    =>$bom_type,
				'COST_CENTER' =>$cost_code,
				'COST_NAME'   =>$cost_name,
				'CREATED_BY'  =>$createdBy,

			);
		//$saveData = DB::table('production_heads')->insert($data);
		$saveData = DB::table('BOM_HEAD')->insert($datahead);

		$discriptn_page = "Production BOM trans insert done by user";
		$acc_code = '';
		$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);

		$datalistrray = array();


		for ($i=0; $i < $countItemCode ; $i++) { 

			$BombB = DB::select("SELECT MAX(BOMBID) as BOMBID FROM BOM_BODY");
			$bodyID = json_decode(json_encode($BombB), true); 
	  //  print_r($headID);exit;
	
			if(empty($bodyID[0]['BOMBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['BOMBID']+1;
			}

			$data_body = array(
			
				'BOMHID'      =>$headId,
				'BOMBID'      =>$bodyId,
				'COMP_CODE'   =>$getcompcode,
				'FY_CODE'     =>$fisYear,
				'PLANT_CODE'  =>$plant_code,
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'VRNO'        =>$NewVrno,
				'SLNO'        =>$i+1,
				'VRDATE'      =>$tr_vr_date,
				'ITEM_CODE'   =>$item_code[$i],
				'ITEM_NAME'   =>$item_name[$i],
				'REMARK'      =>$remark[$i],
				'QTYRECD'     =>$qty[$i],
				'UM'          =>$unit_M[$i],
				'AQTYRECD'    =>$Aqty[$i],
				'AUM'         =>$add_unit_M[$i],
				'QTYISSUE'    =>$issueqty[$i],
				'AQTYISSUED'  =>$issueAqty[$i],
				'BOM_TYPE'    =>$bom_type,
				'CREATED_BY'  =>$createdBy,
			);

			$saveData1 = DB::table('BOM_BODY')->insert($data_body);

			
			}


			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->get()->toArray();
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->update($datavrn);
			}


	     	DB::commit();
			$response_array['response'] = 'success';
			//$response_array['lastid'] = $headID;
		    $data = json_encode($response_array);
		    print_r($data);

	}catch (\Exception $e) {
		    DB::rollBack();
		    throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
 }

			/*if ($saveData1) {

	    			$response_array['response'] = 'success';
		            $response_array['lastid'] = $headId;
		        
		            $data = json_encode($response_array);

		            print_r($data);

			}else{

					$response_array['response'] = 'error';
	                $response_array['data'] = '' ;

	                $data = json_encode($response_array);

	                print_r($data);
					
			}*/
			
		

    }

    public function ViewProduction(Request $request)
    {

    	//print_r('hi');exit;
    		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

	        $title ='View Bill Of Material';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $compName = $request->session()->get('company_name');
	        $compcode                   = explode('-', $compName);
		    $getcompcode                =	$compcode[0];

	        $fisYear =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	        
	       $data = DB::table('BOM_HEAD')->where('BOM_TYPE','WBOM')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get();

            	

	        }else if($userType=='superAdmin' || $userType=='user'){

			$data = DB::table('BOM_HEAD')->where('BOM_TYPE','WBOM')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get();

	        }
	        else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	       return view('admin.finance.transaction.production.view_production');
	    }else{
			return redirect('/useractivity');
		}
    }

    public function ViewChildProduction(Request $request){

		$response_array = array();

		$fisYear =  $request->session()->get('macc_year');

		$compName = $request->session()->get('company_name');
	    $compcode                   = explode('-', $compName);
	     $getcompcode                =	$compcode[0];

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$production = DB::table('BOM_BODY')->where('BOMHID',$headid)->where('VRNO', $vrno)->where('BOM_TYPE','WBOM')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->toArray();
	    	

    		if($production) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $production;
	         

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


    public function AddDailyProduction(Request $request){

		$title                      ='Add Daily Production';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['fg_list']        = DB::table('MASTER_ITEM')->where(['ITEMTYPE_CODE'=>'FG'])->get();
		
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'M2'])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']  = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
		//DB::enableQueryLog();
		$userdata['dept_list']      = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']     = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']      = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		
		$userdata['bom_list'] = DB::table('BOM_HEAD')->where('BOM_TYPE','WBOM')->where('FY_CODE',$macc_year)->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->where(['ITEMTYPE_CODE'=>'RM'])->get();
		
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}


		$purchase = DB::table('PRODUCTION_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->get();

		   	$vrseqnum = '';
			foreach ($purchase as $key) {
				$vrseqnum =  $key->VRNO;
			}

		    $userdata['vrNumber'] =$vrseqnum;

			$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','M2')->get();

   		    $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;

			
		   $vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='M2'");
		
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

		    return view('admin.finance.transaction.production.daily_pproduction',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
	}



public function GetItmFrmBom(Request $request){

		$response_array = array();



		if ($request->ajax()) {

	    	$fgGood   = $request->input('fgGood');
	    	$Plant_code   = $request->input('Plant_code');

	    	$CompanyCode                = $request->session()->get('company_name');
			$compcode                   = explode('-', $CompanyCode);
			$getcompcode                =	$compcode[0];
			$macc_year                  = $request->session()->get('macc_year');
		   	//$headid = $request->input('tblid');

	    	$FgCode = DB::table('BOM_HEAD')->where('ITEM_CODE',$fgGood)->get()->first();

	    	$ItemPostCode = DB::table('MASTER_ITEMTYPE')
				->select('MASTER_ITEMTYPE.*', 'MASTER_ITEM.ITEM_CODE')
           		->leftjoin('MASTER_ITEM', 'MASTER_ITEM.ITEMTYPE_CODE', '=', 'MASTER_ITEMTYPE.ITEMTYPE_CODE')
           		->where('MASTER_ITEM.ITEM_CODE',$fgGood)
           		->get();

           $stdrate = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE',$fgGood)->where('PLANT_CODE',$Plant_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->get()->first();

       //   print_r($fgGood);exit;

	    	if($FgCode){

	    		/*$production = production_body::where('production_head_id',$FgCode->id)->get()->toArray();*/

	    		$production = DB::table('BOM_BODY')
				->select('BOM_BODY.*', 'MASTER_ITEMUM.AUM_FACTOR')
           		->leftjoin('MASTER_ITEMUM', 'MASTER_ITEMUM.ITEM_CODE', '=', 'BOM_BODY.ITEM_CODE')
           		->where('BOM_BODY.BOMHID',$FgCode->BOMHID)
           		->get();
	    		//print_r($production);exit;
	    	}else{
	    		$production='';
	    	}



	    	

    		if($production) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $production;
	            $response_array['PostCode'] = $ItemPostCode;
	            $response_array['stdrate'] = $stdrate;
	         

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


    public function SaveDailyProduction(Request $request){

			$createdBy       = $request->session()->get('userid');
			$compName        = $request->session()->get('company_name');
			$compcode        = explode('-', $compName);
			$getcompcode     = $compcode[0];
			$fisYear         = $request->session()->get('macc_year');
			$comp_nameval    = $request->input('comp_name');
			$fy_year         = $request->input('fy_year');
			$trans_code      = $request->input('trans_code');
			$series_code     = $request->input('series_code');
			$series_name     = $request->input('series_name');
			$vr_no           = $request->input('vr_no');
			$trans_date      = $request->input('trans_date');
			$tr_vr_date      = date("Y-m-d", strtotime($trans_date));
			$item_code       = $request->input('item_code');
    	    $itembyPo        = $request->input('itemPo');
    	    $countItemCode   = count($item_code);
    	 
			$plant_code      = $request->input('plant_code');
			$plant_name      = $request->input('plant_name');
			$fg_code         = $request->input('fgcode');
			$fg_name         = $request->input('fgname');
			$acc_code        = $request->input('accCode');
			$acc_name        = $request->input('accName');
			
			$item_name       = $request->input('item_name');
			$remark          = $request->input('remark');
			$qty             = $request->input('qty');
			$unit_M          = $request->input('unit_M');
			$Aqty            = $request->input('Aqty');
			$add_unit_M      = $request->input('add_unit_M');
			
			$issueqty        = $request->input('issueqty');
			$issueunit_M     = $request->input('issueunit_M');
			$issueAqty       = $request->input('issueAqty');
			$issueadd_unit_M = $request->input('issueadd_unit_M');
			
			$rate            = $request->input('rate');
			$basic_amt       = $request->input('basic_amt');
			$hsn_code        = $request->input('hsn_code');
			$head_tax_ind    = $request->input('head_tax_ind');
			$item_category   = $request->input('item_category');
			$iqua_char       = $request->input('iqua_char');
			$iqua_desc       = $request->input('iqua_desc');
			$char_fromvalue  = $request->input('char_fromvalue');
			$char_tovalue    = $request->input('char_tovalue');
			$quaP_count      = $request->input('quaP_count');
			$allquaPcount    = $request->input('allquaPcount');
			$item_code_que   = $request->input('item_code_que');
			$fgpost_code     = $request->input('fgpost_code'); 
			$totalstd        = $request->input('totalstd');
			$PostCode        = $request->input('configPostCode');
			$GlCode          = $request->input('configGlCode');
			$totalstdRate    =  $request->input('revStdRTotal');
			$totalMvgRate    =  $request->input('issuMvgATotal');
			$seriesPost      =  $request->input('post_code');
			$itmestdAmt      = $request->input('itmbystdRate');
			$itmePostCode    = $request->input('item_post_code');
			$seriesGlCode    = $request->input('gl_code');
			$cost_code       = $request->input('cost_code');
			$cost_name       = $request->input('cost_name');


			DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','DP')->delete();

		//print_r($quaP_count);exit();
		 $ProdH = DB::select("SELECT MAX(PRODHID) as PRODHID FROM PRODUCTION_HEAD");
			$headID = json_decode(json_encode($ProdH), true); 
	  //  print_r($headID);exit;
	
			if(empty($headID[0]['PRODHID'])){
			$headId = 1;
			}else{
			$headId = $headID[0]['PRODHID']+1;
			}	

			if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('PRODUCTION_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

	   DB::beginTransaction();

		try {
			
		$data = array(

				'PRODHID'     =>$headId,
				'COMP_CODE'   =>$getcompcode,
				'FY_CODE'     =>$fisYear,
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'SERIES_NAME' =>$series_name,
				'VRNO'        =>$NewVrno,
				'VRDATE'      =>$tr_vr_date,
				'PLANT_CODE'  =>$plant_code,
				'PLANT_NAME'  =>$plant_name,
				'ACC_CODE'    =>$acc_code,
				'ACC_NAME'    =>$acc_name,
				'ITEM_CODE'   =>$fg_code,
				'ITEM_NAME'   =>$fg_name,
				'COST_CENTER' =>$cost_code,
				'CREATED_BY'  =>$createdBy,

			);

		$saveData = DB::table('PRODUCTION_HEAD')->insert($data);

		$discriptn_page = "Daily production trans insert done by user";
		$this->userLogInsert($createdBy,$trans_code,$series_code,$vr_no,$discriptn_page,$acc_code);


		for ($i=0; $i < $countItemCode ; $i++) { 

			$ProdB = DB::select("SELECT MAX(PRODBID) as PRODBID FROM PRODUCTION_BODY");
			$bodyID = json_decode(json_encode($ProdB), true); 
	  //  print_r($headID);exit;
	
			if(empty($bodyID[0]['PRODBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['PRODBID']+1;
			}


			/*if($itembyPo[$i]){
				$itmcd = $itembyPo[$i];
			}else if($item_code[$i]){
				$itmcd =$item_code[$i];
			}*/

			$data_body = array(
			
				'PRODHID'     =>$headId,
				'PRODBID'     =>$bodyId,
				'COMP_CODE'   =>$getcompcode,
				'FY_CODE'     =>$fisYear,
				'PLANT_CODE'  =>$plant_code,
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'VRNO'        =>$NewVrno,
				'SLNO'        =>$i+1,
				'VRDATE'      =>$tr_vr_date,
				'ITEM_CODE'   =>$item_code[$i],
				'ITEM_NAME'   =>$item_name[$i],
				'REMARK'      =>$remark[$i],
				'QTYRECD'     =>$qty[$i],
				'UM'          =>$unit_M[$i],
				'AQTYRECD'    =>$Aqty[$i],
				'AUM'         =>$add_unit_M[$i],
				'QTYISSUE'    =>$issueqty[$i],
				'AQTYISSUED'  =>$issueAqty[$i],
				'CREATED_BY'  =>$createdBy,
			);

		$saveData1 = DB::table('PRODUCTION_BODY')->insert($data_body);
//DB::enableQueryLog();// 

		

		for ($j=0; $j <2 ; $j++) { 
			if($j==0){

				$seriesGlD = array(
					'IND_GL_CODE' => $fgpost_code,
					'DR_AMT'      => $totalstd,
					'CR_AMT'      => '',
					'TCFLAG'      => 'DP',
					'CREATED_BY'  => $createdBy,
		                
		        );

       			DB::table('INDICATOR_TEMP')->insert($seriesGlD);
			}else if($j==1){

				$seriesmvg = array(
					'IND_GL_CODE' => $seriesGlCode,
					'DR_AMT'      => '',
					'CR_AMT'      => $totalstd,
					'TCFLAG'      => 'DP',
					'CREATED_BY'  => $createdBy,
		                
		        );

       			DB::table('INDICATOR_TEMP')->insert($seriesmvg);
			}
		}



		if($totalMvgRate && $totalstdRate){

			
			if($j==0){

				$seriesGlD = array(
					'IND_GL_CODE' => $seriesPost,
					'DR_AMT'      => '',
					'CR_AMT'      => $totalstdRate,
					'TCFLAG'      => 'DP',
					'CREATED_BY'  => $createdBy,
		                
		        );

       			DB::table('INDICATOR_TEMP')->insert($seriesGlD);

  
		   }else if($j==1){

       			$seriesGlD = array(
					'IND_GL_CODE' => $seriesPost,
					'DR_AMT'      => $totalMvgRate,
					'CR_AMT'      => '',
					'TCFLAG'      => 'DP',
					'CREATED_BY'  => $createdBy,
		                
		        );

       			DB::table('INDICATOR_TEMP')->insert($seriesGlD);
       		}

	
     }else{

		if($totalMvgRate){
			if($i==0){

				$seriesGlD = array(
					'IND_GL_CODE' => $seriesPost,
					'DR_AMT'      => $totalMvgRate,
					'CR_AMT'      => '',
					'TCFLAG'      => 'DP',
					'CREATED_BY'  => $createdBy,
		                
		        );

       			DB::table('INDICATOR_TEMP')->insert($seriesGlD);
				}
			}else if($totalstdRate){
			 if($i==0){

				$seriesGlD = array(
					'IND_GL_CODE' => $seriesPost,
					'DR_AMT'      => '',
					'CR_AMT'      => $totalstdRate,
					'TCFLAG'      => 'DP',
					'CREATED_BY'  => $createdBy,
		                
		        );

       			DB::table('INDICATOR_TEMP')->insert($seriesGlD);
				}

			}

		}
			
			if(!empty($itmestdAmt[$i])){

				$checkdrempty = DB::table('INDICATOR_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$i])->where('Chk_drcr','DR')->where('CREATED_BY',$createdBy)->get()->toArray();


				if(empty($checkdrempty)){

					$idary = array(
						'IND_GL_CODE' => $itmePostCode[$i],
						'DR_AMT'      => $itmestdAmt[$i],
						'CR_AMT'      => '',
						'TCFLAG'      => 'DP',
						'Chk_drcr'    => 'DR',
						'CREATED_BY'  => $createdBy,
	                        
	                );

	                DB::table('INDICATOR_TEMP')->insert($idary);
				}else{

					$checkExist = DB::table('INDICATOR_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$i])->where('Chk_drcr','DR')->where('CREATED_BY',$createdBy)->get()->toArray();
					$updateId = $checkExist[0]->CREATED_BY;
					$NewdrItmAmt = $checkExist[0]->DR_AMT + $itmestdAmt[$i];

					$newAmt = array(
						'DR_AMT'      => $NewdrItmAmt,
						'TCFLAG'      => 'DP',
						'CREATED_BY'  => $createdBy,
	                );

	                DB::table('INDICATOR_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$i])->where('Chk_drcr','DR')->where('CREATED_BY',$updateId)->update($newAmt);

				}

			}else if(!empty($itemMvgAmt[$i])){


				
				$checkCrempty = DB::table('INDICATOR_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$i])->where('Chk_drcr','CR')->where('CREATED_BY',$createdBy)->get()->toArray();


				if(empty($checkCrempty)){
					$idary = array(
						'IND_GL_CODE' => $itmePostCode[$i],
						'DR_AMT'      => '',
						'CR_AMT'      => $itemMvgAmt[$i],
						'TCFLAG'      => 'DP',
						'Chk_drcr'    => 'CR',
						'CREATED_BY'  => $createdBy,
	                        
	                );

	                DB::table('INDICATOR_TEMP')->insert($idary);
				}else{
					$checkCrExist = DB::table('INDICATOR_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$i])->where('Chk_drcr','CR')->where('CREATED_BY',$createdBy)->get()->toArray();
					$updateId = $checkCrExist[0]->CREATED_BY;
					$NewcrItmAmt = $checkCrExist[0]->CR_AMT + $itemMvgAmt[$j];

					$newcrAmt = array(
						'CR_AMT'      => $NewcrItmAmt,
						'TCFLAG'      => 'DP',
						'CREATED_BY'  => $createdBy,
	                );

	                DB::table('INDICATOR_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$i])->where('Chk_drcr','CR')->where('CREATED_BY',$updateId)->update($newcrAmt);
				}

			}



		

		//$itemsimTemp = 	DB::table('SIMULATION_TEMP')->WHERE('TCFLAG','DP')->get();


			if($quaP_count[$i] == 0){
			}else{
				for ($q=0; $q < $quaP_count[$i]; $q++) { 

				$a = array_fill(1, $quaP_count[$i], $bodyId);
				$str = implode(',',$a); 
				$last_id = explode(',',$str);

				$datalistrray[]= $last_id[0];

			    }
			}


//DB::enableQueryLog();// 

			$getdataItemBal = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE',$item_code[$i])->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->first();

		
//dd(DB::getQueryLog());

			
		if($getdataItemBal){

			$qtyrecd     = $getdataItemBal->YRQTRECD;
			
			$qtyarecd    = $getdataItemBal->YRAQTRECD;
			
			$qtyissued   = $getdataItemBal->YRQTYISSUED;
			
			$movavrate   = $getdataItemBal->MAVGRATE;
			
			$yrIssuedVal = $getdataItemBal->YRISSUEDVAL;
			
			$yrRecdVal   = $getdataItemBal->YRRECDVAL;

			$stdrate   = $getdataItemBal->STDRATE;

			if($issueqty[$i]){
				$newQtyIssued   =  $qtyissued + $issueqty[$i];
				$newAQtyIssued  =  $qtyissued + $issueAqty[$i];
				$movaRate       =  $yrIssuedVal / $newQtyIssued;
				$NewIsuueValAmt =  $stdrate * $newQtyIssued;
			}else{
				$newQtyIssued   = $qtyissued;
				$newAQtyIssued  = $qtyissued;
				$movaRate       = $movavrate;
				$NewIsuueValAmt = $yrIssuedVal;
			}

			if($qty[$i]){
				$newQtyRecd    =  $qtyrecd + $qty[$i];
				$newAQtyRecd   =  $qtyarecd + $Aqty[$i];
				$NewRecdValAmt = $stdrate * $newQtyRecd;
				
			}else{
				$newQtyRecd    =  $qtyrecd;
				$newAQtyRecd   =  $qtyarecd;
				$NewRecdValAmt = $yrRecdVal;
				
			}
			
			

			$qtyissublock = $getdataItemBal->YRQTYBLOCK;

			$dataarqty = array(
				'YRQTRECD'     =>  $newQtyRecd,
				'YRAQTRECD'    =>  $newAQtyRecd,
				'YRQTYISSUED'  =>  $newQtyIssued,
				'YRAQTYISSUED' =>  $newAQtyIssued,
				'YRISSUEDVAL'  =>  $NewIsuueValAmt,
				'YRRECDVAL'    =>  $NewRecdValAmt,

				
			);

			$saveData12 = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE', $item_code[$i])->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->update($dataarqty);

		}


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
				'VRNO'           =>$vr_no,
				'SLNO'           =>$i+1,
				'TRAN_CODE'      =>$trans_code,
				'SERIES_CODE'    =>$series_code,
				'ITEM_CODE'      =>$item_code[$i],
				'ITEM_NAME'      =>$item_name[$i],
				'NARRATION'      =>$remark[$i],
				'QTYRECD'        =>$qty[$i],
				'QTYISSUED'      =>$issueqty[$i],
				'CREATED_BY'     =>$createdBy,

		    );

			$saveData2 = DB::table('ITEM_LEDGER')->insert($itemledger);
			

		} /*-- for loop close --*/



		$getProdD = DB::table('INDICATOR_TEMP')
				->select('INDICATOR_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')
           		->leftjoin('MASTER_GL', 'INDICATOR_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
            	->where('INDICATOR_TEMP.TCFLAG','DP')
            	->where('INDICATOR_TEMP.CREATED_BY',$createdBy)
            	->get()->toArray();
        $prodICount = count($getProdD);

		for($q=0;$q<$prodICount;$q++){

			$gledgT = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
			$gledgID = json_decode(json_encode($gledgT), true); 
					
			if(empty($gledgID[0]['GLTRANID'])){
				$gledg_Id = 1;
			}else{
				$gledg_Id = $gledgID[0]['GLTRANID']+1;
			}

			$srnol = $q+1;
			$ledgData = array(
				'GLTRANID'    => $gledg_Id,
				'COMP_CODE'   => $getcompcode,
				'FY_CODE'     => $fisYear,
				'TRAN_CODE'   => $trans_code,
				'SERIES_CODE' => $series_code,
				'VRNO'        => $vr_no,
				'SLNO'        => $srnol,
				'VRDATE'      => $tr_vr_date,
				'COST_CODE'   => $cost_code,
				'COST_NAME'   => $cost_name,
				'GL_CODE'     => $getProdD[$q]->IND_GL_CODE,
				'GL_NAME'     => $getProdD[$q]->GL_NAME,
				'DRAMT'       => $getProdD[$q]->DR_AMT,
				'CRAMT'       => $getProdD[$q]->CR_AMT,
				'CREATED_BY'  => $getProdD[$q]->CREATED_BY,
			);

			DB::table('GL_TRAN')->insert($ledgData);

		}

		//$getqualitycount = count($head_tax_ind);
		
		$getbody = DB::table('PRODUCTION_BODY')->orderBy('PRODBID', 'DESC')->first();

		//print_r($getdata);

		$getvrnoCount  = DB::table('PRODUCTION_BODY')->where('VRNO',$getbody->VRNO)->get()->toArray();

		$sl_no=array();

		foreach ($getvrnoCount as $key){
			
			$sl_no[]= $key->SLNO;
		}

		$vrnocount = count($getvrnoCount);

		
		if($saveData){
			for ($j=0; $j < $allquaPcount; $j++) { 

		  $ProdQ = DB::select("SELECT MAX(PRODQID) as PRODQID FROM PRODUCTION_QUA");
			$quaID = json_decode(json_encode($ProdQ), true); 
	  //  print_r($headID);exit;
	
			if(empty($quaID[0]['PRODQID'])){
			$quaId = 1;
			}else{
			$quaId = $quaID[0]['PRODQID']+1;
			}


				$data_indent = array(

					'PRODHID'        =>$headId,
					'PRODBID'        =>$datalistrray[$j],
					'PRODQID'        =>$quaId,
					'COMP_CODE'      =>$getcompcode,
					'FY_CODE'        =>$fisYear,
					'TRAN_CODE'      =>$trans_code,
					'SERIES_CODE'    =>$series_code,
					'VRNO'           =>$vr_no,
					'VRDATE'         =>$tr_vr_date,
					'PLANT_CODE'     =>$plant_code,
					'ICATG_CODE'     =>$item_category[$j],
					'IQUA_CHAR'      =>$iqua_char[$j],
					'IQUA_DESC'      =>$iqua_desc[$j],
					'IQUA_UM'        =>'',
					'ITEM_CODE'      =>$item_code_que[$j],
					'CHAR_FROMVALUE' =>$char_fromvalue[$j],
					'CHAR_TOVALUE'   =>$char_tovalue[$j],
					'CREATED_BY'     =>$createdBy,

					);
				
				$saveData2 = DB::table('PRODUCTION_QUA')->insert($data_indent);

				/*$saveData1 = $daily_production_quality->insert($data_indent);*/
			
			} /*-- for loop close --*/
		} /*-- if close --*/

		$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->get()->toArray();
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->update($datavrn);
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
			

			/*if ($saveData1) {

	    			$response_array['response'] = 'success';
		            $response_array['lastid'] = $headId;

		            $data = json_encode($response_array);

		            print_r($data);

			}else{

					$response_array['response'] = 'error';
	                $response_array['data'] = '' ;

	                $data = json_encode($response_array);

	                print_r($data);
					
			}*/
			
		

    }


    public function ViewDailyProduction(Request $request)
    {

    	//print_r('hi');exit;
    		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

	        $title ='View Daily Production';

			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode = $compcode[0];

	        $fisYear     =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	        
	        $data = DB::table('PRODUCTION_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE', $fisYear)->get();


	        /*$requisition_head = new store_requisition_head();

   		$requistion = $requisition_head->getrequsitionData($CompanyCode,$macc_year)->where('store_action','issue');*/

	        //print_r($data);
            	

	        }else if($userType=='superAdmin' || $userType=='user'){

	         $data = DB::table('PRODUCTION_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE', $fisYear)->get();

	        }
	        else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	       return view('admin.finance.transaction.production.view_daily_production');
	    }else{
			return redirect('/useractivity');
		}
    }

    public function ViewChildDailyProduction(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$production = DB::table('PRODUCTION_BODY')->where('PRODHID',$headid)->where('VRNO', $vrno)->get()->toArray();
	    	

    		if($production) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $production;
	         

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



public function production_msg(Request $request,$saveData){

		if ($saveData=='true') {

			$request->session()->flash('alert-success', 'Production Was Successfully Added...!');
			return redirect('/Transaction/Production/view-BOM');

		} else {

			$request->session()->flash('alert-error', 'Production Can Not Added...!');
			return redirect('/Transaction/Production/view-BOM');

		}
	}


	public function daily_production_msg(Request $request,$saveData){

		if ($saveData=='true') {

			$request->session()->flash('alert-success', 'Daily Production Was Successfully Added...!');
			return redirect('/Transaction/Production/view-daily-production');

		} else {

			$request->session()->flash('alert-error', 'Daily Production Can Not Added...!');
			return redirect('/Transaction/Production/view-daily-production');

		}
	}

	public function woproduction_msg(Request $request,$saveData){

		if ($saveData=='true') {

			$request->session()->flash('alert-success', 'Wo Production Was Successfully Added...!');
			return redirect('/Transaction/Production/view-wo-production');

		} else {

			$request->session()->flash('alert-error', 'Wo Production Can Not Added...!');
			return redirect('/Transaction/Production/view-wo-production');

		}
	}

    public function GetitemByBomNum(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$bomno   = $request->input('bomno');
	    	$Plant_code   = $request->input('Plant_code');

	    	$CompanyCode                = $request->session()->get('company_name');
			$compcode                   = explode('-', $CompanyCode);
			$getcompcode                =	$compcode[0];
			$macc_year                  = $request->session()->get('macc_year');
		   	//$headid = $request->input('tblid');

	    	//print_r($bomno);exit;

	    

	    $bomdata = DB::table('BOM_HEAD')->where('VRNO',$bomno)->where('BOM_TYPE','WBOM')->get()->first();

	    $fgGood = $bomdata->ITEM_CODE;


	     //$bombodydata = DB::table('BOM_BODY')->where('VRNO',$bomno)->where('BOM_TYPE','WBOM')->get();


	    $bombodydata = DB::table('BOM_BODY')
				->select('BOM_BODY.*', 'MASTER_ITEMUM.AUM_FACTOR','MASTER_ITEM.HSN_CODE','MASTER_ITEM.TAX_CODE')
           		->leftjoin('MASTER_ITEMUM', 'MASTER_ITEMUM.ITEM_CODE', '=', 'BOM_BODY.ITEM_CODE')
           		->leftjoin('MASTER_ITEM', 'MASTER_ITEM.ITEM_CODE', '=', 'BOM_BODY.ITEM_CODE')
           		->where('BOM_BODY.VRNO',$bomno)
           		->get();


	    $ItemPostCode = DB::table('MASTER_ITEMTYPE')
				->select('MASTER_ITEMTYPE.*', 'MASTER_ITEM.ITEM_CODE','MASTER_ITEMUM.UM_CODE')
           		->leftjoin('MASTER_ITEM', 'MASTER_ITEM.ITEMTYPE_CODE', '=', 'MASTER_ITEMTYPE.ITEMTYPE_CODE')
           		->leftjoin('MASTER_ITEMUM', 'MASTER_ITEMUM.ITEM_CODE', '=', 'MASTER_ITEM.ITEM_CODE')
           		->where('MASTER_ITEM.ITEM_CODE',$fgGood)
           		->get();

           //DB::enableQueryLog();// 

        $stdrate = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE',$fgGood)->where('PLANT_CODE',$Plant_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->get()->first();

     //   dd(DB::getQueryLog());

	    	
//print_r($stdrate);exit;
    		if($bomdata){

				$response_array['response']  = 'success';
				$response_array['data_head']      = $bomdata;
				$response_array['data'] = $bombodydata;
				$response_array['PostCode']  = $ItemPostCode;
				$response_array['stdrate']   = $stdrate;
	         

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



     public function GetItemByBom(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$bomno       = $request->input('bomno');
			$series_code  = $request->input('series_code');

	    	//DB::enableQueryLog();// dd(DB::getQueryLog());
	    	/*$itmList =  DB::table('PORDER_HEAD')->select('PORDER_HEAD.*', 'MASTER_ACC.*','PORDER_BODY.*')
           		->leftjoin('MASTER_ACC', 'PORDER_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->leftjoin('PORDER_BODY', 'PORDER_HEAD.PORDERHID', '=', 'PORDER_BODY.PORDERHID')
            	->where([['PORDER_HEAD.VRNO','=',$povrno],['PORDER_HEAD.ACC_CODE','=',$account_code],['PORDER_HEAD.SERIES_CODE','=',$series_code]])
            	->get();*/


           /*$fetch_hsn_code = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();

	    	$itmetype_gl = DB::table('MASTER_ITEMTYPE')
					->select('MASTER_ITEMTYPE.*', 'MASTER_GL.*')
	           		->leftjoin('MASTER_GL', 'MASTER_ITEMTYPE.POST_CODE', '=', 'MASTER_GL.GL_CODE')
	            	->where('MASTER_ITEMTYPE.ITEMTYPE_CODE',$fetch_hsn_code->ITEMTYPE_CODE)
	            	->get();*/


           $itmList = DB::select("SELECT * FROM `BOM_BODY` WHERE VRNO='$bomno' AND SERIES_CODE='$series_code' AND BOM_TYPE='WBOM'");

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


public function Get_Item_UM_AUM_BOM(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$itemCode = $request->input('ItemCode');
	    	$qcount = $request->input('q');
	    	$reqnum = $request->input('reqno');
	    	$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			$fisYear     =  $request->session()->get('macc_year');

	    	/*if($item_Code){
	    		$itemCode = $itemCode;
	    	}else{

				$fgGood = DB::table('BOM_HEAD')->where('VRNO',$reqnum)->get()->first();
				$fgGood->ITEM_CODE;

	    	}*/



	    	$getpostCode =	DB::SELECT("SELECT t1.*,t2.POST_CODE FROM MASTER_ITEM t1  LEFT JOIN MASTER_ITEMTYPE t2 ON t2.ITEMTYPE_CODE = t1.ITEMTYPE_CODE WHERE t1.ITEM_CODE='$itemCode'");



	    	$fetch_hsn_code = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();

	    	$itmetype_gl = DB::table('MASTER_ITEMTYPE')
					->select('MASTER_ITEMTYPE.*', 'MASTER_GL.*')
	           		->leftjoin('MASTER_GL', 'MASTER_ITEMTYPE.POST_CODE', '=', 'MASTER_GL.GL_CODE')
	            	->where('MASTER_ITEMTYPE.ITEMTYPE_CODE',$fetch_hsn_code->ITEMTYPE_CODE)
	            	->get();


	        $getstdRateByItm = DB::table('MASTER_ITEMBAL')->where('FY_CODE',$fisYear)->where('COMP_CODE',$getcompcode)->where('ITEM_CODE',$itemCode)->get()->toArray();

	    	//print_r($getpostCode);exit;
	    	
	    	$item_um_aum_list = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemCode)->get();

	    	$item_bal_data = DB::table('MASTER_ITEMBAL')->where('FY_CODE',$fisYear)->where('COMP_CODE',$getcompcode)->where('ITEM_CODE',$itemCode)->get()->first();

	    	if($item_bal_data){

	    	$yropqty     = $item_bal_data->YROPQTY;
			$yrQtyRecd   = $item_bal_data->YRQTRECD;
			$yrQtyIssued = $item_bal_data->YRQTYISSUED;
			$yrQtyBlock  = $item_bal_data->YRQTYBLOCK;
			$bacth_no     = $item_bal_data->BATCH_NO;
			$MAVGRATE     = $item_bal_data->MAVGRATE;
	    	$totalstock = floatval($yropqty) + floatval($yrQtyRecd) - floatval($yrQtyIssued) - floatval($yrQtyBlock);

	    
	   		 }else{
						$totalstock  ='0';
						$bacth_no    ='';
						$yropqty     = '0';
						$yrQtyRecd   = '0';
						$yrQtyIssued = '0';
						$yrQtyBlock  = '0';
						$MAVGRATE    = '0';
	  		 }

	    	$fetch_hsn_code = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->toArray();

    		if ($item_um_aum_list && $fetch_hsn_code) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_um_aum_list;
	            $response_array['data_hsn'] = $fetch_hsn_code;
	            $response_array['qcount'] = $qcount;
	            $response_array['bacth_no'] = $bacth_no;
	            $response_array['totalstock'] = $totalstock;
	            $response_array['MAVGRATE'] = $MAVGRATE;
	            $response_array['getpostCode'] = $getpostCode;
	            $response_array['itypeGl']    = $itmetype_gl;
				$response_array['stdRate']    = $getstdRateByItm;

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


    public function AddWoProduction(Request $request){

		$title                      ='Add Wo Production';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['fg_list']        = DB::table('MASTER_ITEM')->where(['ITEMTYPE_CODE'=>'FG'])->get();
		
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'M3'])->get();
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
		
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();
		
		$getdate                    = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}



			$purchase = DB::table('BOM_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->where('BOM_TYPE','WBOM')->get();

		   	$vrseqnum = '';
			foreach ($purchase as $key) {
				$vrseqnum =  $key->VRNO;
			}

		    $userdata['vrNumber'] =$vrseqnum;

			$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','M3')->get();

   		    $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;

			
		  $vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE='$getcompcode' AND TRAN_CODE='M3'"); 

		
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

		    return view('admin.finance.transaction.production.wo_production',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
	}


	public function ViewWoProduction(Request $request)
    {

    	//print_r('hi');exit;
    		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

	        $title ='View Store Issue';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $compName = $request->session()->get('company_name');

	        $compcode                   = explode('-', $compName);
		    $getcompcode                =	$compcode[0];

	        $fisYear =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	        
	        $data = DB::table('BOM_HEAD')->where('BOM_TYPE','WOBOM')->where('COMP_CODE',$getcompcode)->where('FY_CODE', $fisYear)->get();


	        /*$requisition_head = new store_requisition_head();

   		$requistion = $requisition_head->getrequsitionData($CompanyCode,$macc_year)->where('store_action','issue');*/

	        //print_r($data);
            	

	        }else if($userType=='superAdmin' || $userType=='user'){

	        $data = DB::table('BOM_HEAD')->where('BOM_TYPE','WOBOM')->where('COMP_CODE',$getcompcode)->where('FY_CODE', $fisYear)->get();

	        }
	        else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	       return view('admin.finance.transaction.production.view_wo_production');
	    }else{
			return redirect('/useractivity');
		}
    }


    public function ViewChildWoProduction(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$production = DB::table('BOM_BODY')->where('BOMHID', $headid)->where('VRNO', $vrno)->where('BOM_TYPE','WOBOM')->get()->toArray();
	    	
    		if($production){

    			$response_array['response'] = 'success';
	            $response_array['data'] = $production;
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] ='';
              
               echo $data = json_encode($response_array);

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

    public function GetItmFrmDailyProd(Request $request){

		$response_array = array();

		

		if ($request->ajax()) {

	    	$account_code   = $request->input('account_code');
		   	//$headid = $request->input('tblid');

	    	$FgCode = DB::table('PRODUCTION_HEAD')->where('ACC_CODE',$account_code)->get()->first();

	    	/*$AccCode = daily_production_head::where('acc_code',$account_code)->get()->first();*/


	    	if($FgCode){

	    		/*$production = daily_production_body::where('daily_production_head_id',$FgCode->id)->get()->toArray();*/

	    		$production = DB::table('PRODUCTION_BODY')
				->select('PRODUCTION_BODY.*', 'MASTER_ITEMUM.AUM_FACTOR','MASTER_ITEM.HSN_CODE','MASTER_ITEM.TAX_CODE')
           		->leftjoin('MASTER_ITEMUM', 'MASTER_ITEMUM.ITEM_CODE', '=', 'PRODUCTION_BODY.ITEM_CODE')
           		->leftjoin('MASTER_ITEM', 'MASTER_ITEM.ITEM_CODE', '=', 'PRODUCTION_BODY.ITEM_CODE')
           		->where('PRODUCTION_BODY.PRODHID',$FgCode->PRODHID)
           		->get();

           		//print_r($production);exit;
	    		/*$production = DB::table('daily_production_bodies')
				->select('daily_production_bodies.*', 'daily_production_heads.id as pid','daily_production_heads.fg_code','daily_production_heads.fg_qty')
           		->Leftjoin('daily_production_heads', 'daily_production_heads.id', '=', 'daily_production_bodies.daily_production_head_id')
           		->where('daily_production_heads.acc_code',$account_code)
           		->get();*/

           		//echo '<pre>';
	    		//print_r($production);exit;
	    	}else{
	    		$production='';
	    	}
	    	

    		if($production) {

				$response_array['response'] = 'success';
				$response_array['data']     = $production;
				$response_array['fgdata']   = $FgCode;
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
				$response_array['data']     = '' ;
				$response_array['count']    = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

				$response_array['response'] = 'error';
				$response_array['data']     = '' ;
				$response_array['count']    = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


     public function SaveWoProduction(Request $request){

			$createdBy       = $request->session()->get('userid');
			$compName        = $request->session()->get('company_name');
			$compcode        = explode('-', $compName);
			$getcompcode     = $compcode[0];
			$fisYear         = $request->session()->get('macc_year');
			$comp_nameval    = $request->input('comp_name');
			$fy_year         = $request->input('fy_year');
			$trans_code      = $request->input('trans_code');
			$series_code     = $request->input('series_code');
			$series_name     = $request->input('series_name');
			$vr_no           = $request->input('vr_no');
			$trans_date      = $request->input('trans_date');
			$tr_vr_date      = date("Y-m-d", strtotime($trans_date));
			
			$plant_code      = $request->input('plant_code');
			$plant_name      = $request->input('plant_name');
			$fg_code         = $request->input('fgcode');
			$fg_name         = $request->input('fgname');
			$acc_code        = $request->input('accCode');
			$acc_name        = $request->input('accName');
			$item_code       = $request->input('item_code');
			$countItemCode   = count($item_code);
			$item_name       = $request->input('item_name');
			$remark          = $request->input('remark');
			$qty             = $request->input('qty');
			$unit_M          = $request->input('unit_M');
			$Aqty            = $request->input('Aqty');
			$add_unit_M      = $request->input('add_unit_M');
			
			$issueqty        = $request->input('issueqty');
			$issueunit_M     = $request->input('issueunit_M');
			$issueAqty       = $request->input('issueAqty');
			$issueadd_unit_M = $request->input('issueadd_unit_M');
			
			$rate            = $request->input('rate');
			$basic_amt       = $request->input('basic_amt');
			$hsn_code        = $request->input('hsn_code');
			$head_tax_ind    = $request->input('head_tax_ind');
			$item_category   = $request->input('item_category');
			$iqua_char       = $request->input('iqua_char');
			$iqua_desc       = $request->input('iqua_desc');
			$char_fromvalue  = $request->input('char_fromvalue');
			$char_tovalue    = $request->input('char_tovalue');
			$quaP_count      = $request->input('quaP_count');
			$allquaPcount    = $request->input('allquaPcount');
			$item_code_que   = $request->input('item_code_que');
			$bom_type        = $request->input('bom_type');
			$cost_code      = $request->input('cost_code');
 

		//print_r($quaP_count);exit();

		 $GateH = DB::select("SELECT MAX(BOMHID) as BOMHID FROM BOM_HEAD");
			$headID = json_decode(json_encode($GateH), true); 
	  //  print_r($headID);exit;
	
			if(empty($headID[0]['BOMHID'])){
			$headId = 1;
			}else{
			$headId = $headID[0]['BOMHID']+1;
			}


			 DB::beginTransaction();

		try {
	
		$data = array(

				'BOMHID'      =>$headId,
				'COMP_CODE'   =>$getcompcode,
				'FY_CODE'     =>$fisYear,
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'SERIES_NAME' =>$series_name,
				'VRNO'        =>$vr_no,
				'VRDATE'      =>$tr_vr_date,
				'PLANT_CODE'  =>$plant_code,
				'PLANT_NAME'  =>$plant_name,
				'ACC_CODE'    =>$acc_code,
				'ACC_NAME'    =>$acc_name,
				'BOM_TYPE'    =>$bom_type,
				'COST_CENTER' =>$cost_code,
				'CREATED_BY'  =>$createdBy,

			);
		$saveData = DB::table('BOM_HEAD')->insert($data);

		$discriptn_page = "Production WO BOM trans insert done by user";
		$this->userLogInsert($createdBy,$trans_code,$series_code,$vr_no,$discriptn_page,$acc_code);
		

		for ($i=0; $i < $countItemCode ; $i++) { 

			$GateB= DB::select("SELECT MAX(BOMBID) as BOMBID  FROM BOM_BODY");
			$bodyID = json_decode(json_encode($GateB), true); 
	  //  print_r($headID);exit;
	
			if(empty($bodyID[0]['BOMBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['BOMBID']+1;
			}

			$data_body = array(
			
				'BOMHID'      =>$headId,
				'BOMBID'      =>$bodyId,
				'COMP_CODE'   =>$getcompcode,
				'FY_CODE'     =>$fisYear,
				'PLANT_CODE'  =>$plant_code,
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'VRNO'        =>$vr_no,
				'SLNO'        =>$i+1,
				'VRDATE'      =>$tr_vr_date,
				'ITEM_CODE'   =>$item_code[$i],
				'ITEM_NAME'   =>$item_name[$i],
				'REMARK'      =>$remark[$i],
				'QTYRECD'     =>$qty[$i],
				'UM'          =>$unit_M[$i],
				'AQTYRECD'    =>$Aqty[$i],
				'AUM'         =>$add_unit_M[$i],
				'QTYISSUE'    =>$issueqty[$i],
				'AQTYISSUED'  =>$issueAqty[$i],
				'BOM_TYPE'    =>$bom_type,
				'CREATED_BY'  =>$createdBy,
			);

			$saveData1 = DB::table('BOM_BODY')->insert($data_body);
			///$saveData = DB::table('production_bodies')->insert($data_body);

			
		} /*-- if close --*/


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
			

			/*if ($saveData1) {

	    			$response_array['response'] = 'success';
		            $response_array['lastid'] = $headId;
		           
		            $data = json_encode($response_array);

		            print_r($data);

			}else{

					$response_array['response'] = 'error';
	                $response_array['data'] = '' ;

	                $data = json_encode($response_array);

	                print_r($data);
					
			}*/
			
		

    }


 public function PurchaseBillPdf(Request $request){


 	$company = DB::table('master_comp')->get()->first();
 	$comp_name = $request->session()->get('company_name');

 	$comp_code = explode('-', $comp_name);

 	//print_r($comp_code[0]);exit;
 	$accCode ='CAB03';

 	$comp_details = DB::table('master_comp')
				->select('master_comp.*', 'master_plant.*')
           		->leftjoin('master_plant', 'master_plant.company_code', '=', 'master_comp.comp_code')
           		->where('master_comp.comp_code',$comp_code[0])
           		->get();

 //  print_r($comp_details);exit;

 	$purchase_bill = DB::table('purchase_head')
				->select('purchase_head.*', 'master_party.*','purchase_head.id as headid')
           		->leftjoin('master_party', 'master_party.acc_code', '=', 'purchase_head.acc_code')
           		->where('purchase_head.acc_code',$accCode)
           		->get();

    $purchase_bill_body = DB::table('purchase_body')->where('purchase_body.purchase_head_id',$purchase_bill[0]->headid)->get()->toArray();

       //print_r($purchase_bill_body);exit;
 	 return view('admin.finance.transaction.purchasebillpdf',compact('company','purchase_bill','comp_details','purchase_bill_body'));
   }




/* --------------- SIMULATION FOR DAILY PRODUCTION ---------- */


	/* --------------- SIMULATION FOR DAILY PRODUCTION ---------- */

	public function SimulationForDailyProd(Request $request){

		$seriesPost   = $request->seriesGl;
		$seriesGlCode = $request->seriesGlCode;
		$fgpost_code  = $request->fgpost_code;
		$totalstd     = $request->totalstd;
		$totalstdRate = $request->totalstdRate;
		$totalMvgRate = $request->totalMvgRate;
		$itmePostCode = $request->itmePostCode;
		$itmestdAmt   = $request->itmestdAmt;
		$itemCode     = $request->itemCode;
		$itemMvgAmt   = $request->itemmvgAmt;
		$userId       = $request->session()->get('userid');
		$itemCount    = count($itemCode);

		//print_r($itemCount);exit;

		DB::table('SIMULATION_TEMP')->where('TCFLAG','DP')->where('CREATED_BY',$userId)->delete();

		for ($i=0; $i <2 ; $i++) { 
			if($i==0){

				$seriesGlD = array(
					'IND_GL_CODE' => $fgpost_code,
					'DR_AMT'      => $totalstd,
					'CR_AMT'      => '',
					'TCFLAG'      => 'DP',
					'CODE_NAME'   => 'Fg Post Code',
					'CREATED_BY'  => $userId,
		                
		        );

       			DB::table('SIMULATION_TEMP')->insert($seriesGlD);
			}else if($i==1){

				$seriesmvg = array(
					'IND_GL_CODE' => $seriesGlCode,
					'DR_AMT'      => '',
					'CR_AMT'      => $totalstd,
					'TCFLAG'      => 'DP',
					'CODE_NAME'   => 'Series Gl',
					'CREATED_BY'  => $userId,
		                
		        );

       			DB::table('SIMULATION_TEMP')->insert($seriesmvg);
			}
		}

		

		for($j=0;$j<$itemCount;$j++){
/*
			if($itmestdAmt[$j]){
				$DrAmt = $itmestdAmt[$j];
				$CrAmt =0;
			}else if($itemMvgAmt[$j]){
				$DrAmt = 0;
				$CrAmt = $itemMvgAmt[$j];

			}*/
		if($totalMvgRate && $totalstdRate){

			
			if($j==0){

				$seriesGlD = array(
					'IND_GL_CODE' => $seriesPost,
					'DR_AMT'      => '',
					'CR_AMT'      => $totalstdRate,
					'TCFLAG'      => 'DP',
					'CODE_NAME'   => 'Series Post',
					'CREATED_BY'  => $userId,
		                
		        );

       			DB::table('SIMULATION_TEMP')->insert($seriesGlD);

  
		   }else if($j==1){

       			$seriesGlD = array(
					'IND_GL_CODE' => $seriesPost,
					'DR_AMT'      => $totalMvgRate,
					'CR_AMT'      => '',
					'TCFLAG'      => 'DP',
					'CODE_NAME'   => 'Series Post',
					'CREATED_BY'  => $userId,
		                
		        );

       			DB::table('SIMULATION_TEMP')->insert($seriesGlD);
       		}

	
     }else{

		if($totalMvgRate){
			if($j==0){

				$seriesGlD = array(
					'IND_GL_CODE' => $seriesPost,
					'DR_AMT'      => $totalMvgRate,
					'CR_AMT'      => '',
					'TCFLAG'      => 'DP',
					'CODE_NAME'   => 'Series Post',
					'CREATED_BY'  => $userId,
		                
		        );

       			DB::table('SIMULATION_TEMP')->insert($seriesGlD);
				}
			}else if($totalstdRate){
			 if($j==0){

				$seriesGlD = array(
					'IND_GL_CODE' => $seriesPost,
					'DR_AMT'      => '',
					'CR_AMT'      => $totalstdRate,
					'TCFLAG'      => 'DP',
					'CODE_NAME'   => 'Series Post',
					'CREATED_BY'  => $userId,
		                
		        );

       			DB::table('SIMULATION_TEMP')->insert($seriesGlD);
				}

			}

		}
		
		//print_r($itmestdAmt);exit;

			/*if(empty($itmestdAmt[$j])){
				print_r('empty');exit;
			}else{
				print_r('notempty');exit;
			}*/
			
			if(!empty($itmestdAmt[$j])){

				$checkdrempty = DB::table('SIMULATION_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$j])->where('Chk_drcr','DR')->where('CREATED_BY',$userId)->get()->toArray();


				if(empty($checkdrempty)){

					$idary = array(
						'IND_GL_CODE' => $itmePostCode[$j],
						'DR_AMT'      => $itmestdAmt[$j],
						'CR_AMT'      => '',
						'TCFLAG'      => 'DP',
						'Chk_drcr'    => 'DR',
						'CODE_NAME'   => 'Item Type Post',
						'CREATED_BY'  => $userId,
	                        
	                );

	                DB::table('SIMULATION_TEMP')->insert($idary);
				}else{

					$checkExist = DB::table('SIMULATION_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$j])->where('Chk_drcr','DR')->where('CREATED_BY',$userId)->get()->toArray();
					$updateId = $checkExist[0]->CREATED_BY;
					$NewdrItmAmt = $checkExist[0]->DR_AMT + $itmestdAmt[$j];

					$newAmt = array(
						'DR_AMT'      => $NewdrItmAmt,
						'TCFLAG'      => 'DP',
						'CODE_NAME'   => 'Item Type Post',
						'CREATED_BY'  => $userId,
	                );

	                DB::table('SIMULATION_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$j])->where('Chk_drcr','DR')->where('CREATED_BY',$updateId)->update($newAmt);

				}

			}else if(!empty($itemMvgAmt[$j])){


				
				$checkCrempty = DB::table('SIMULATION_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$j])->where('Chk_drcr','CR')->where('CREATED_BY',$userId)->get()->toArray();


				if(empty($checkCrempty)){
					$idary = array(
						'IND_GL_CODE' => $itmePostCode[$j],
						'DR_AMT'      => '',
						'CR_AMT'      => $itemMvgAmt[$j],
						'TCFLAG'      => 'DP',
						'Chk_drcr'    => 'CR',
						'CODE_NAME'   => 'Item Type Post',
						'CREATED_BY'  => $userId,
	                        
	                );

	                DB::table('SIMULATION_TEMP')->insert($idary);
				}else{
					$checkCrExist = DB::table('SIMULATION_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$j])->where('Chk_drcr','CR')->where('CREATED_BY',$userId)->get()->toArray();
					$updateId = $checkCrExist[0]->CREATED_BY;
					$NewcrItmAmt = $checkCrExist[0]->CR_AMT + $itemMvgAmt[$j];

					$newcrAmt = array(
						'CR_AMT'      => $NewcrItmAmt,
						'TCFLAG'      => 'DP',
						'CODE_NAME'   => 'Item Type Post',
						'CREATED_BY'  => $userId,
	                );

	                DB::table('SIMULATION_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$j])->where('Chk_drcr','CR')->where('CREATED_BY',$updateId)->update($newcrAmt);
				}

			}

			

			
		/* /. for loop*/
	}
	

		$response_array = array();
  		$simData = DB::select("SELECT t1.*,t2.GL_NAME as glName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE WHERE t1.TCFLAG='DP' AND t1.CREATED_BY='$userId'");

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

/* --------------- SIMULATION FOR DAILY PRODUCTION ---------- */

	public function SimulationForDailyProd_old(Request $request){

		$seriesPost   = $request->seriesGl;
		$seriesGlCode = $request->seriesGlCode;
		$fgpost_code  = $request->fgpost_code;
		$totalstd     = $request->totalstd;
		$totalstdRate = $request->totalstdRate;
		$totalMvgRate = $request->totalMvgRate;
		$itmePostCode = $request->itmePostCode;
		$itmestdAmt   = $request->itmestdAmt;
		$itemCode     = $request->itemCode;
		$itemMvgAmt   = $request->itemmvgAmt;
		$userId       = $request->session()->get('userid');
		$itemCount    = count($itemCode);

		//print_r($itemCount);exit;

		DB::table('SIMULATION_TEMP')->where('TCFLAG','DP')->where('CREATED_BY',$userId)->delete();

		for ($i=0; $i <2 ; $i++) { 
			if($i==0){

				$seriesGlD = array(
					'IND_GL_CODE' => $fgpost_code,
					'DR_AMT'      => $totalstd,
					'CR_AMT'      => '',
					'TCFLAG'      => 'DP',
					'CODE_NAME'   => 'Post Code',
					'CREATED_BY'  => $userId,
		                
		        );

       			DB::table('SIMULATION_TEMP')->insert($seriesGlD);
			}else if($i==1){

				$seriesmvg = array(
					'IND_GL_CODE' => $seriesGlCode,
					'DR_AMT'      => '',
					'CR_AMT'      => $totalstd,
					'TCFLAG'      => 'DP',
					'CODE_NAME'   => 'Series Gl',
					'CREATED_BY'  => $userId,
		                
		        );

       			DB::table('SIMULATION_TEMP')->insert($seriesmvg);
			}
		}

		for($q=0;$q<$itemCount;$q++){

			$checkempty = DB::table('SIMULATION_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$q])->where('CREATED_BY',$userId)->get()->toArray();

			if(empty($checkempty)){

				$idary = array(
					'IND_GL_CODE' => $itmePostCode[$q],
					'DR_AMT'      => '',
					'CR_AMT'      => $itemMvgAmt[$q],
					'TCFLAG'      => 'DP',
					'Chk_drcr'    => 'CR',
					'CODE_NAME'   => 'Item Type Gl',
					'CREATED_BY'  => $userId,
                        
                );

                DB::table('SIMULATION_TEMP')->insert($idary);

			}else{

				$checkCrExist = DB::table('SIMULATION_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$q])->where('CREATED_BY',$userId)->get()->toArray();

				$updateId = $checkCrExist[0]->CREATED_BY;
				$NewcrItmAmt = $checkCrExist[0]->CR_AMT + $itemMvgAmt[$q];

				$newcrAmt = array(
					'CR_AMT'      => $NewcrItmAmt,
					'CODE_NAME'   => 'Item Type Gl',
					'CREATED_BY'  => $updateId,
                );


	            DB::table('SIMULATION_TEMP')->where('TCFLAG','DP')->where('IND_GL_CODE',$itmePostCode[$q])->where('CREATED_BY',$updateId)->update($newcrAmt);

			}


		}
		

		$response_array = array();
  		$simData = DB::select("SELECT t1.*,t2.GL_NAME as glName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE WHERE t1.TCFLAG='DP' AND t1.CREATED_BY='$userId'");

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

/* --------------- SIMULATION FOR DAILY PRODUCTION ---------- */
 
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




}
