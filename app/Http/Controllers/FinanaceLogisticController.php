<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use Response;
use App\Exports\FreightSaleOrderExport;


class FinanaceLogisticController extends Controller
{

    
    public function __cunstruct(Request $request,$data){

		//$this->data = "smit@121";

	 }


	public function CommonFunction($macc_year,$Comp_Code,$Tran_Code,$Tran_Code2){

         $queryData['item_um_aum_list'] = DB::table('MASTER_FY')->where('COMP_CODE',$Comp_Code)->where('FY_CODE',$macc_year)->get();

         $queryData['bank_list']        = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=',$Tran_Code)->orWhere('TRAN_CODE', '=',$Tran_Code2)->get();

         $queryData['transpoter_list']  = DB::table('MASTER_ACC')->get();
         $queryData['item_list']        = DB::table('MASTER_ITEM')->get();

      
        $queryData['qc_list']   = DB::table('PQCS_HEAD')->get()->toArray();
        $queryData['qc_body_list'] = DB::table('PQCS_BODY')->groupBy('ITEM_CODE')->get();


        return $queryData;

    }

   public function AddDeliveryOrder(Request $request)
    {
    	//print_r($this->data);exit;
		$title                      ='Delivery Order';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		/*$userdata['getacc']         = DB::table('MASTER_ACC')->get();*/

		$userdata['getacc'] = DB::table('MASTER_ACC')->select('ACC_CODE',DB::raw('replace(ACC_NAME, \'"\',"\ ") as ACC_NAME'))->WHERE('ATYPE_CODE','D')->get();

		$userdata['getconsinee'] = DB::table('MASTER_ACC')->select('ACC_CODE',DB::raw('replace(ACC_NAME, \'"\',"\ ") as ACC_NAME'))->WHERE('ATYPE_CODE','N')->get();
		
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T0'])->where(['COMP_CODE'=>$getcompcode])->get();
		/*$userdata['plant_list']     = DB::table('MASTER_PLANT')->get();*/

		$userdata['plant_list'] = DB::table('MASTER_PLANT')->select('PLANT_CODE',DB::raw('replace(PLANT_NAME, \'"\',"\ ") as PLANT_NAME'))->where('COMP_CODE',$getcompcode)->get();

		//$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();

		$userdata['pfct_list'] = DB::table('MASTER_PFCT')->select('PFCT_CODE',DB::raw('replace(PFCT_NAME, \'"\',"\ ") as PFCT_NAME'))->get();
		
		/*$userdata['help_item_list'] = DB::table('MASTER_ITEM')->addSelect('ITEM_CODE')->selectRaw("REPLACE(ITEM_NAME,\'"\',"\ ")")->get();*/

	    $userdata['help_item_list'] = DB::table('MASTER_ITEM')->select('ITEM_CODE',DB::raw('replace(ITEM_NAME, \'"\',"\ ") as ITEMNAME'))->get();

	   /* echo '<pre>';
	    print_r($userdata['help_item_list']);

	    echo '</pre>';

	    exit;*/

	
		$userdata['area_list']      = DB::table('MASTER_CITY')->get();


		$userdata['do_excel_list']      = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','DO')->groupBy(['TRAN_CODE','EXLCONFIG_CODE'])->get();

		$userdata['columnlist']    = DB::table('MASTER_EXCELCONFIG')->where('EXLCONFIG_CODE','DOYARD')->where('TRAN_CODE','DO')->get()->toArray();

    $userdata['exceedingcolumnlist']    = DB::table('MASTER_EXCELCONFIG')->where('EXLCONFIG_CODE','DOEXCD')->where('TRAN_CODE','DO')->get()->toArray();
		

		$userdata['fso_list']      = DB::table('FSO_HEAD')->get();

		$userdata['route_list']        = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('ROUTE_CODE')->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();


		/*item master*/


		$userdata['item_type']      = DB::table('MASTER_ITEMTYPE')->where('ITEMTYPE_BLOCK','NO')->get();
		$userdata['item_group']     = DB::table('MASTER_ITEMGROUP')->where('ITEMGROUP_BLOCK','NO')->get();

		$userdata['item_class']     = DB::table('MASTER_ITEM_CLASS')->where('ITEMCLASS_BLOCK','NO')->get();
		
		$userdata['item_category']  = DB::table('MASTER_ITEM_CATEGORY')->where('ICATG_BLOCK','NO')->get();

		$userdata['tax_code_list']  = DB::table('MASTER_TAX')->where('TAX_BLOCK','NO')->get();
		
		$userdata['valuation_code'] = DB::table('MASTER_VALUATION')->where('VALUATION_BLOCK','NO')->get();

		$userdata['um_list'] = DB::table('MASTER_UM')->get();
		$userdata['hsn_code_list'] = DB::table('MASTER_HSN')->get();
		/*item master*/

		/*acc master*/

		$userdata['company_lists']     = DB::table('MASTER_COMP')->get();
		$userdata['acctype_lists']     = DB::table('MASTER_ACCTYPE')->get();

		$userdata['acccategory_lists'] = DB::table('MASTER_ACATG')->get();

		$userdata['accclass_lists']    = DB::table('MASTER_ACLASS')->get();

		$userdata['state_lists']       = DB::table('MASTER_STATE')->get();

		$userdata['tax_lists']         = DB::table('MASTER_TAX')->get();

		$userdata['tds_lists']         = DB::table('MASTER_TDS')->get();

		$userdata['acc_mst_list'] = DB::table('MASTER_ACC')->Orderby('ACC_CODE', 'desc')->limit(5)->get();
		/*acc master*/

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		$requistion = DB::table('DORDER_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();

		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T0')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='T0'");
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

		    return view('admin.finance.transaction.logistic.delivery_order',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }

    public function GetItemDataForDO(Request $request){

    	$title = 'Add Master Item';
    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');
		$data['help_item_list'] = DB::table('MASTER_ITEM')->Orderby('ITEM_CODE', 'desc')->get();
		$data['item_type']      = DB::table('MASTER_ITEMTYPE')->where('ITEMTYPE_BLOCK','NO')->get();
		$data['item_group']     = DB::table('MASTER_ITEMGROUP')->where('ITEMGROUP_BLOCK','NO')->get();

		$data['item_class']     = DB::table('MASTER_ITEM_CLASS')->where('ITEMCLASS_BLOCK','NO')->get();
		
		$data['item_category']  = DB::table('MASTER_ITEM_CATEGORY')->where('ICATG_BLOCK','NO')->get();

		$data['tax_code_list']  = DB::table('MASTER_TAX')->where('TAX_BLOCK','NO')->get();
		
		$data['valuation_code'] = DB::table('MASTER_VALUATION')->where('VALUATION_BLOCK','NO')->get();

		$data['um_list'] = DB::table('MASTER_UM')->get();
		$data['hsn_code_list'] = DB::table('MASTER_HSN')->get();
    
    	

    if(isset($compName)){

    	return view('admin.finance.master.item.append_item_data',$data+compact('title'));

    }else{

		return redirect('/useractivity');
	}

  }

  public function GetAccDataForDO(Request $request){

		$title = 'Add Account Master';

		$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

		$userData['company_lists']     = DB::table('MASTER_COMP')->get();
		$userData['acctype_lists']     = DB::table('MASTER_ACCTYPE')->get();

		$userData['acccategory_lists'] = DB::table('MASTER_ACATG')->get();

		$userData['accclass_lists']    = DB::table('MASTER_ACLASS')->get();

		$userData['gl_lists']          = DB::table('MASTER_GL')->where('ACCOUNT_TAG','YES')->get();

		$userData['state_lists']       = DB::table('MASTER_STATE')->get();

		$userData['tax_lists']         = DB::table('MASTER_TAX')->get();

		$userData['tds_lists']         = DB::table('MASTER_TDS')->get();
		$userData['city_lists']         = DB::table('MASTER_CITY')->get();

		$userData['acc_mst_list'] = DB::table('MASTER_ACC')->Orderby('ACC_CODE', 'desc')->limit(5)->get();

		if(isset($compName)){

	    	return view('admin.finance.master.customer.append_acc_data',$userData+compact('title'));
	    }else{

			return redirect('/useractivity');
		}

	}

    public function importDoExcel(Request $request) 
    {
     
		$table           = 'TEMP_DO_ORDER';

		$config_table    = 'MASTER_EXCELCONFIG';

		$CompanyName     = $request->session()->get('company_name');
	
		$fisYear =  $request->session()->get('macc_year');

		$getcompcode = explode('-', $CompanyName);

		$comp_code   =$getcompcode[0];

	
		$column_name = DB::table('MASTER_EXCELCONFIG')->select('EXCEL_COL','VALIDATION_STATUS','TEMPEXCEL_COL','TBL_COL')->where('TRAN_CODE','DO')->get()->toArray();

		$configTableCount = count($column_name);

		//print_r($configTableCount);exit;


		$itemcolumn = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','DO')->where('VALIDATION_STATUS',2)->get()->toArray();

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

       	//print_r($getAllExcelCount);exit;

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
       		
       		if(isset($getAllExcelData[$n])){
/*
       			$val = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($getAllExcelData[$n]['ALLOCATION DATE']));*/

       			$excel_date = $getAllExcelData[$n]['ALLOCATION DATE']; 
					$unix_date = ($excel_date - 25569) * 86400;
					$excel_date = 25569 + ($unix_date / 86400);
					$unix_date = ($excel_date - 25569) * 86400;
					$insertexcelArrayDt[] = gmdate("Y-m-d", $unix_date);

       			$arrKey = array_search('ALLOCATION DATE', array_keys($getAllExcelData[$n]));
       			
       			$insertexcelArray[]  = $getAllExcelData[$n];

       		}

       	}


      $dataexcelCount =count($insertexcelArray); 

      $temptblcol =[];
		$tempExcelcol =[];
		for ($b = 0; $b < $tblcount; $b++) {

			$temptblcol[] = $tblmerger[$b]['TBL_COL'];
			$tempExcelcol[] = $tblmerger[$b]['TEMPEXCEL_COL'];

		  // print_r($tblmerger[$b]['TBL_COL']);

	    }

	    $arryCombConfigTbl = array_combine($temptblcol, $tempExcelcol);

	 //  print_r($arryCombConfigTbl);exit;

		$ConfigItem     = $arryCombConfigTbl['ITEM_CODE'];
		$ConfigItemName = $arryCombConfigTbl['REMARK'];
		$ConfigAcc      = $arryCombConfigTbl['ACC_NAME'];
		$ConfigDo       = $arryCombConfigTbl['DORDER_NO'];

       	
       for ($t = 0; $t < $dataexcelCount; $t++) {

       	$arrayIndex = array_values($insertexcelArray[$t]);
       	$arrayIndex1 = $insertexcelArrayDt[$t];

       	$arrayIndexCount = count($arrayIndex);

       	$new_array = [];
       	
       	$SRNO = 1;
			foreach ($arrayIndex as $value){

				$SRNO++;
			} 

       	//print_r($arrayIndex);

       		for ($p = 0; $p < $arrayIndexCount; $p++) {

       			$q = $p +1;

       			if($p==$arrKey){
       				$new_array['COL'.$q] = $arrayIndex1;

       			}else{

       				$new_array['COL'.$q] = $arrayIndex[$p];
       			}
       			
       			
       		}
       

       		$saveData =	DB::insert("INSERT INTO `TEMP_DELIVERY_ORDER` (COMP_CODE,FY_CODE,CREATED_BY,".implode(' , ', array_keys($new_array)).") VALUES ('$comp_code','$fisYear','$createdBy','".implode("' , '", array_values($new_array))."')");

       		//dd(DB::getQueryLog());

       		$lastId =	DB::getPdo()->lastInsertId();

       		$tempDoOrder = DB::table('TEMP_DELIVERY_ORDER')->where('ID',$lastId)->get()->first();

       		$tempItemCode = $tempDoOrder->$ConfigItem;

       		$tempItemName = $tempDoOrder->$ConfigItemName; 

       		$tempAccName =  $tempDoOrder->$ConfigAcc;

       		$tempDoNumber =  $tempDoOrder->$ConfigDo;

       		//DB::enableQueryLog();

       		//echo '<pre>';




       		$explodName  =explode(' ',$tempItemName);


       		$firstName = strlen($explodName[0]);

       			if($firstName > 2){
       				$itemAliasName = $explodName[0];
       			}else{

       				$itemAliasName = $explodName[0].' '.$explodName[1];
       			}


       		$item_code = DB::table('MASTER_ITEM')->where('ITEM_NAME', 'LIKE', '%'.$itemAliasName.'%')->get()->toArray();

       		//print_r($item_code);

       		//echo '</pre>';

       /*		$item_code= DB::select("SELECT * FROM MASTER_ITEM WHERE ITEM_CODE='$tempItemCode' AND ALIAS_NAME LIKE '%'".'$tempItemName'."");*/

       		//dd(DB::getQueryLog());

       		if($item_code){

       		}else{

       			$dataitem = array(

       				'ITEM_STATUS' => 'YES',

       			);

       		  $update1 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigItem,$tempItemCode)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataitem);
       		  
       		}



       		//DB::enableQueryLog();

       		$acc_name = DB::table('MASTER_ACC')->where('ACC_NAME',$tempAccName)->orWhere('ALIAS_NAME', 'LIKE', '%'.$tempAccName.'%')->get()->toArray();


       		//dd(DB::getQueryLog());
/*
       		echo '<pre>';
       		print_r($acc_name);

       		print_r($tempAccName);
       		
       		echo '</pre>';
       			
*/
       		if($acc_name){

       			foreach($acc_name as $key){

       					$dataAcc = array(

       						$ConfigAcc => $key->ACC_NAME.' - '.$key->ACC_CODE
       					);

       			$update2 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigAcc,$tempAccName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataAcc);

       			}

       		}else{

       			$dataAcc = array(

       				'ACC_STATUS' => 'YES',

       			);

       		  $update3 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigAcc,$tempAccName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataAcc);

       		}


       		$do_number = DB::table('DORDER_BODY')->where('DORDER_NO',$tempDoNumber)->get()->toArray();

       		if($do_number){

       			$datado = array(

       				'DO_EXIST_STATUS' => 'YES',

       			);

       		  $update3 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigDo,$tempDoNumber)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($datado);

       		}else{

       		}
       	
       }

       //exit;
  
       $TempData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE  ( COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy')  AND (ITEM_STATUS ='YES' OR  ACC_STATUS='YES') ");

       $TempDoData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='NO' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");


       //print_r($TempData);exit;

       $temp_data_count = count($TempData);

       $temp_do_count = count($TempDoData);

       	if($saveData) {

    			$response_array['response'] = 'success';
    			$response_array['data_count'] = $temp_data_count;
    			$response_array['data_do_count'] = $temp_do_count;
	            echo $data = json_encode($response_array);
	         
			}else{

				$response_array['response'] = 'error';

            $data = json_encode($response_array);
            print_r($data);
				
			}

		}else{

			$response_array['response'] = 'error_data';
			$response_array['data_error'] = 'data not avilable';
         echo  $data = json_encode($response_array);
        
		}



       	
    }


     public function ViewLorryRecieptDetails(Request $request)
    {
    		//$compName = $request->session()->get('company_name');
 
    	    //print_r('hi');exit;

    	   if($request->ajax()) {

			$title       ='View Delivery Order Details';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');

			$tempvrno        = $request->input('tempvrno');
		
		    $temptransporter = $request->input('temptransporter');

		   // print_r($tempvrno);exit;


	        $data = DB::table('TEMP_DELIVERY_ORDER')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('CREATED_BY',$userid)->get()->toArray();
            

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();
	    }
	    
	    if(isset($compName)){

	       return view('admin.finance.transaction.logistic.upload_lorry_receipt');
	    }else{
			return redirect('/useractivity');
		}
    }

     public function ViewDeliveryOrderDetails(Request $request)
    {
    		//$compName = $request->session()->get('company_name');
 
    	    //print_r('hi');exit;

    	   if($request->ajax()) {

			$title       ='View Delivery Order Details';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');

			$tempvrno        = $request->input('tempvrno');
		
		    $temptransporter = $request->input('temptransporter');

		   // print_r($tempvrno);exit;


	        $data = DB::table('TEMP_DELIVERY_ORDER')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('CREATED_BY',$userid)->get()->toArray();
            

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();
	    }
	    
	    if(isset($compName)){

	       return view('admin.finance.transaction.logistic.delivery_order');
	    }else{
			return redirect('/useractivity');
		}
    }

   
   public function SaveDeliveryOrder(Request $request)
    {

    	/*echo '<pre>';
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
			$itemCode        = $request->input('itemCode');
			$itemName        = $request->input('itemName');
			$length           = $request->input('length');
			$width            = $request->input('width');
			$height           = $request->input('height');
			$odc              = $request->input('odc');
			$remark           = $request->input('remark');
			$batch_no         = $request->input('batch_no');
			$qty              = $request->input('qty');
			$unit_M           = $request->input('unit_M');

			$importExcel      = $request->input('importExcel');
			$fromplace      = $request->input('fromplace');


			$count            = count($itemCode);


			
	   
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


			$column_name = DB::table('MASTER_EXCELCONFIG')->select('TBL_COL','TEMPEXCEL_COL')->where('TRAN_CODE','DO')->get()->toArray();

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
				'CREATED_BY'     =>$createdBy,

			);

	    $saveData = DB::table('DORDER_HEAD')->insert($datahead);


	     	$discriptn_page = "Store requistion trans insert done by user";

			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);

		for($j = 0; $j < $tempDoOrderCount; $j++) {

			$explode_consinee = explode("~",$consinee_excel[$j]);

			$explode_remark = explode(" ",$remark_excel[$j]);

       		 $remarkItem = strlen($explode_remark[0]);

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
						'ITEM_CODE'     =>$item_code_excel[$j],
						'ITEM_NAME'     =>$itemRemarkName,
						'REMARK'        =>$remark_excel[$j],
						'QTY'           =>$qty_excel[$j],
						'DORDER_DATE'   =>$do_date_excel[$j],
						'CP_CODE'       =>$consinee_code,
						'CP_NAME'       =>$consinee_name,
						'LOT_NO'        =>$vrno_excel[$j],
						'FROM_PLACE'    =>$fromplace,
						'TO_PLACE'      =>$to_place_excel[$j],
						
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
					'FREIGHT_ORD_NO' =>$freight_order_no,
					'CREATED_BY'     =>$createdBy,

				);

		     $saveData = DB::table('DORDER_HEAD')->insert($datahead);

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
				'DORDER_DATE' =>$do_date,
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
				'CREATED_BY'  =>$createdBy,

		    );
	
	    	$saveData1 = DB::table('DORDER_BODY')->insert($data_body);
			
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

    public function ViewDeliveryOrder(Request $request)
    {
    		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

			$title       ='View Delivery Order';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');


	       
           
	        $data = DB::table('DORDER_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->get();
            	

	       

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	       return view('admin.finance.transaction.logistic.view_delivery_order');
	    }else{
			return redirect('/useractivity');
		}
    }


    public function ViewChildDeliveryOrder(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

		   	$compName    = $request->session()->get('company_name');
		   	$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');

	    	$delivery_order = DB::table('DORDER_BODY')->where('DORDERHID', $headid)->where('COMP_CODE', $getcompcode)->get()->toArray();
	    	

    		if($delivery_order) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $delivery_order;
	         

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



    public function getConsineeAddressByAcc(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$cp_code   = $request->input('cp_code');
	    	$sp_code   = $request->input('sp_code');
	    	$acc_code   = $request->input('acc_code');
	    	$rake_no   = $request->input('rake_no');
	    	//$do_no   = $request->input('do_no');
		 

	    	$consinee_addr = DB::table('MASTER_ACCADD')->where('ACC_CODE',$sp_code)->get()->toArray();

	    	

	    	//print_r($consinee_addr);exit;
	       // DB::enableQueryLog();
//
	  		$delivery_order = DB::table('DORDER_BODY')->where('ACC_CODE',$acc_code)->where('CP_CODE',$cp_code)->where('SP_CODE',$sp_code)->where('RAKE_NO',$rake_no)->get()->first();

	  		//dd(DB::getQueryLog());


	    	
	 // print_r($delivery_order);exit;

    		if($consinee_addr || $delivery_order) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $consinee_addr;
	            $response_array['data_do'] = $delivery_order;
	           
	          
	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data_do'] = '' ;
                
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



    public function GetDoExcelCodeBySeries(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$seriesCode   = $request->input('seriesCode');
	    	//$do_no   = $request->input('do_no');
		 

	    	$excel_code = DB::table('MASTER_EXCELCONFIG')->where('SERIES_CODE', $seriesCode)->groupBy('EXLCONFIG_CODE')->get();
	    	
	  //  print_r($excel_code);exit;

    		if($excel_code) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $excel_code;
	         

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


    public function EditDeliveryOrder(Request $request,$headid,$bodyid,$vrno){

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


     public function delivery_order_msg(Request $request,$saveData){

		if ($saveData==true) {

			$request->session()->flash('alert-success', 'Delivery Order Was Successfully Added...!');
			return redirect('/Transaction/Logistic/View-Delivery-Order');

		}else{

			$request->session()->flash('alert-error', 'Delivery Order Can Not Added...!');
			return redirect('/Transaction/Logistic/View-Delivery-Order');

		}
	}

/*freight sale order*/

 public function AddFreightSaleOrder(Request $request)
    {
    	//print_r($this->data);exit;
    	

		$title                        ='Freight Sale Order';
		
		$CompanyCode                  = $request->session()->get('company_name');
		$compcode                     = explode('-', $CompanyCode);
		$getcompcode                  =$compcode[0];
		$macc_year                    = $request->session()->get('macc_year');
		
		$userdata['comp_list']        = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']           = DB::table('MASTER_ACC')->where('ATYPE_CODE','D')->get();
		//DB::enableQueryLog();
		$userdata['series_list']      = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T1'])->where(['COMP_CODE'=>$getcompcode])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']    = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();

		$userdata['do_excel_list']      = DB::table('MASTER_EXCELCONFIG')->where('EXLCONFIG_CODE','SO-IMP')->where('TRAN_CODE','SO')->groupBy('TRAN_CODE')->get();

		$userdata['columnlist']    = DB::table('MASTER_EXCELCONFIG')->where('EXLCONFIG_CODE','SO-IMP')->where('TRAN_CODE','SO')->get()->toArray();
		
		//DB::enableQueryLog();
		$userdata['dept_list']        = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']       = DB::table('MASTER_PLANT')->where(['COMP_CODE'=>$getcompcode])->get();
		$userdata['pfct_list']        = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']        = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']        = DB::table('MASTER_COST')->get();
		$userdata['emp_list']         = DB::table('MASTER_EMP')->get();
		
		$userdata['help_item_list']   = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']        = DB::table('MASTER_RATE_VALUE')->get();
		
		$userdata['cost_list']        = DB::table('MASTER_COST')->get();
		
		$userdata['area_list']        = DB::table('MASTER_AREA')->get();

		$userdata['route_list']        = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('ROUTE_CODE')->get();

		$userdata['um_list']        = DB::table('MASTER_UM')->get();
	
		$userdata['fsqNo_list']  = DB::table('FSQ_HEAD')->get();
		
		$userdata['vehicletype_list'] = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

		$userdata['freightType_list'] = DB::table('MASTER_FREIGHTTYPE')->get();

		// $userdata['do_excel_list']      = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','DO')->groupBy(['TRAN_CODE','EXLCONFIG_CODE'])->get();
		//print_r($userdata['vehicletype_list']);exit;

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		$requistion = DB::table('FSO_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();

		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T1')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='T1'");
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

		    return view('admin.finance.transaction.logistic.freight_sale_order',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }


    public function SaveFreightSaleOrder(Request $request)
    {

    	/*echo '<pre>';
    	  print_r($request->post());exit;
    	echo '<pre>';*/



    	    $createdBy        = $request->session()->get('userid');
			$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
			$fisYear          = $request->session()->get('macc_year');
			$db_name          =  $request->session()->get('dbName');
			$comp_nameval     = $request->input('comp_name');
			$fy_year          = $request->input('fy_year');
			$pfct_code        = $request->input('pfct_code');
			$trans_code       = $request->input('trans_code');
			$series_code      = $request->input('series_code');
			$series_name      = $request->input('series_name');
			$pfct_name        = $request->input('pfct_name');
			$vr_no            = $request->input('vr_no');
			$trans_date       = $request->input('trans_date');
			$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
			$getduedate       = $request->input('getdue_date');
			$dueDate          = date("Y-m-d", strtotime($getduedate));
			$plant_code       = $request->input('plant_code');
			$plant_name       = $request->input('plant_name');
			$acc_code         = $request->input('AccCode');
			$acc_name         = $request->input('AccName');
			$freight_order_no = $request->input('FreightNo');
			$route_code       = $request->input('route_code');
			$route_name       = $request->input('route_name');
			$frieghttypeCd    = $request->input('getfreightTypeCode');
			$frieghtypeNm     = $request->input('getfreightTypeName');
			$refno            = $request->input('getrefNo');
			$ref_date         = $request->input('getrefDate');
			$refdate          = date("Y-m-d", strtotime($ref_date));
			$valid_frmdate    = $request->input('getvalidfrmDate');
			$validfrmdate     = date("Y-m-d", strtotime($valid_frmdate));
			$valid_todate     = $request->input('getvalidtoDate');
			$validtodate      = date("Y-m-d", strtotime($valid_todate));
			$from_place       = $request->input('from_place');
			$to_place         = $request->input('to_place');
			$vehicle_type     = $request->input('vehicle_type');
			$rate_basis       = $request->input('rate_basis');
			$rate             = $request->input('rate');
			$qty              = $request->input('qty');
			$unit_M           = $request->input('unit_M');
			$Quo_no           = $request->input('Quo_no');
			$saleqtno         = $request->input('quotation_no');
			$fsqhid           = $request->input('fsqhid');
			$wheelCode        = $request->input('wheelCode');
			$vehicleType      = $request->input('vehicleType');

			$count            = count($vehicle_type);


			$importExcel      = $request->input('importExcel');

DB::beginTransaction();
 try {
				DB::commit();

		$StoreH = DB::select("SELECT MAX(FSOHID) as FSOHID  FROM FSO_HEAD");
		$headID = json_decode(json_encode($StoreH), true); 
	  //  print_r($headID);exit;
	
		if(empty($headID[0]['FSOHID'])){
			$headId = 1;
		}else{
			$headId = $headID[0]['FSOHID']+1;
		}

		   if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('FSO_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

			if($Quo_no){

			 $explodeQuo =	explode(' ', $Quo_no);

			 $quofycode =  $explodeQuo[0];
			 $quoSeries = $explodeQuo[1];
			 $quoVrNo = $explodeQuo[2];

			}else{

			 $quofycode =  '';
			 $quoSeries = '';
			 $quoVrNo = '';

			}


	    	$datahead = array(
				
				'COMP_CODE'        =>$getcompcode,
				'FY_CODE'          =>$fisYear,
				'FSOHID'           =>$headId,
				'TRAN_CODE'        =>$trans_code,
				'SERIES_CODE'      =>$series_code,
				'SERIES_NAME'      =>$series_name,
				'VRNO'             =>$NewVrno,
				'VRDATE'           =>$tr_vr_date,
				'ACC_CODE'         =>$acc_code,
				'ACC_NAME'         =>$acc_name,
				'SALEQ_NO'         =>$saleqtno,
				'FREIGHTTYPE_CODE' =>$frieghttypeCd,
				'FREIGHTTYPE_NAME' =>$frieghtypeNm,
				'REF_NO'           =>$refno,
				'REF_DATE'         =>$refdate,
				'CREATED_BY'       =>$createdBy,

			);


	    
	     $saveData = DB::table('FSO_HEAD')->insert($datahead);


	      $lastid= DB::getPdo()->lastInsertId();

	      $updatefso = array(
				
				'FSOHID'           =>$lastid,
				'LAST_UPDATE_BY'   =>$createdBy,

			);

	       $saveData = DB::table('FSQ_HEAD')->where('FSQHID',$fsqhid)->update($updatefso);



	      $discriptn_page = "Freight Sale Order insert done by user";
			//$acc_code = '';
		  $this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);


		  if($importExcel != ''){


	     	$getDoBodyCoulmName= DB::select("SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA='$db_name' AND table_name='FSO_BODY'");

			
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


			$column_name = DB::table('MASTER_EXCELCONFIG')->select('TBL_COL','TEMPEXCEL_COL')->where('TRAN_CODE','SO')->where('EXLCONFIG_CODE','SO-IMP')->get()->toArray();

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

	   		
	   		//print_r($arryCombConfigTbl);exit;

		    $insertexcelArray = [];
		    $comp_code_excel = [];
		    $comp_name_excel = [];
		    $plant_code_excel = [];
		    $plant_name_excel = [];
		    $city_code_excel = [];
		    $city_name_excel = [];
		    $cat_vehicle_excel = [];
		    $rate_excel = [];
		    $valid_from_excel = [];
		    $valid_to_excel = [];
		    $contr_excel = [];
		   
		 if($arryCombConfigTbl){

		    for($w=0;$w< $tempDoOrderCount; $w++){
	       		$n= $w+1;
	       		/* -- excel col count -- */
	       		for ($e = 0; $e < $tempColmnCount; $e++){


	       			if(isset($arryCombConfigTbl['COMP_CODE'])){

       			if($arryCombConfigTbl['COMP_CODE'] == $tempExcelcol[$e]){

       				$CP_NAME = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($comp_code_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$CP_NAME ='';
				}
			}

			if(isset($arryCombConfigTbl['COMP_NAME'])){

       			if($arryCombConfigTbl['COMP_NAME'] == $tempExcelcol[$e]){

       				$CP_ADD = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($comp_name_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$CP_ADD ='';
				}
			}


			if(isset($arryCombConfigTbl['PLANT_CODE'])){

       			if($arryCombConfigTbl['PLANT_CODE'] == $tempExcelcol[$e]){

       				$SP_NAME = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($plant_code_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$SP_NAME ='';
				}
			}

       			
       			if(isset($arryCombConfigTbl['PLANT_NAME'])){

       			if($arryCombConfigTbl['PLANT_NAME'] == $tempExcelcol[$e]){

       				$OBD_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($plant_name_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$OBD_NO ='';
				}
			}


			if(isset($arryCombConfigTbl['CITY_CODE'])){

				if($arryCombConfigTbl['CITY_CODE'] == $tempExcelcol[$e]){


					$TO_PLACE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($city_code_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$TO_PLACE='';
				}

			}


			if(isset($arryCombConfigTbl['CITY_NAME'])){

       			if($arryCombConfigTbl['CITY_NAME'] == $tempExcelcol[$e]){

       				$INVOICE_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($city_name_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$INVOICE_NO ='';
				}
			}



			if(isset($arryCombConfigTbl['VEHICLE_TYPE'])){

       			if($arryCombConfigTbl['VEHICLE_TYPE'] == $tempExcelcol[$e]){

       				$INVOICE_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($cat_vehicle_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$INVOICE_NO ='';
				}
			}



			if(isset($arryCombConfigTbl['RATE'])){

       			if($arryCombConfigTbl['RATE'] == $tempExcelcol[$e]){

       				$INVOICE_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($rate_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$INVOICE_NO ='';
				}
			}


			if(isset($arryCombConfigTbl['VALID_FROM_DATE'])){

       			if($arryCombConfigTbl['VALID_FROM_DATE'] == $tempExcelcol[$e]){

       				$INVOICE_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($valid_from_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$INVOICE_NO ='';
				}
			}


			if(isset($arryCombConfigTbl['VALID_TO_DATE'])){

       			if($arryCombConfigTbl['VALID_TO_DATE'] == $tempExcelcol[$e]){

       				$INVOICE_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($valid_to_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$INVOICE_NO ='';
				}
			}

			if(isset($arryCombConfigTbl['CONTR_NO'])){

       			if($arryCombConfigTbl['CONTR_NO'] == $tempExcelcol[$e]){

       				$INVOICE_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($contr_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$INVOICE_NO ='';
				}
			}

			if(isset($ColumntempDoOrder[$w])){

       			$insertexcelArray[] = $ColumntempDoOrder[$w];


       			}
	       }
	     }


	     for($k = 0; $k < $tempDoOrderCount; $k++){

	     	$getVendorCode1 = DB::table('MASTER_COMP')->select('COMP_CODE','COMP_NAME')->where('VENDOR_CODE','LIKE','%'.$comp_code_excel[$k].'%')->get()->first();


				$getVendorCode = json_decode(json_encode($getVendorCode1));

				if($getVendorCode){

				 $compVendorCode =	$getVendorCode->COMP_CODE;
				 $compVendorName = 	$getVendorCode->COMP_NAME;
				}else{
				 $compVendorCode =	'';
				 $compVendorName = 	'';
				}

			
				$getFromPlace1 = DB::table('MASTER_PLANT')->select('CITY_NAME')->where('PLANT_CODE',$plant_code_excel[$k])->get()->first();

				$getFromPlace = json_decode(json_encode($getFromPlace1));

				if($getFromPlace){

				 $FromPlaceCityName =	$getFromPlace->CITY_NAME;
				}else{
				 $FromPlaceCityName =	'';
				}
				
				$getFsoData =  DB::table('FSO_BODY')->where('VALID_TO_DATE', \DB::raw("(select max(`VALID_TO_DATE`) from FSO_BODY)"))->where('COMP_CODE',$compVendorCode)->where('ACC_CODE',$acc_code)->where('PLANT_CODE',$plant_code_excel[$k])->where('FROM_PLACE',$FromPlaceCityName)->where('TO_PLACE',$city_name_excel[$k])->where('VEHICLE_TYPE',$cat_vehicle_excel[$k])->get()->first();

				//print_r($getFsoData);

				if($getFsoData){

				   $validtoDate = $valid_from_excel[$k];

				   $newDate1 = date('Y-m-d', strtotime($validtoDate. ' - 1 days'));

				   $existData = array(


				   		'VALID_TO_DATE'=> $newDate1,

				   );

				   $update1 = DB::table('FSO_BODY')->where('COMP_CODE',$compVendorCode)->where('ACC_CODE',$acc_code)->where('PLANT_CODE',$plant_code_excel[$k])->where('FROM_PLACE',$FromPlaceCityName)->where('TO_PLACE',$city_name_excel[$k])->where('VEHICLE_TYPE',$cat_vehicle_excel[$k])->update($existData);

				}
	     }


	      for($j = 0; $j < $tempDoOrderCount; $j++) {


						 		$StoreB = DB::select("SELECT MAX(FSOBID) as FSOBID FROM FSO_BODY");

								$bodyID = json_decode(json_encode($StoreB), true); 
						
								if(empty($bodyID[0]['FSOBID'])){
								$bodyId = 1;
								}else{
								$bodyId = $bodyID[0]['FSOBID']+1;
								}

				/*$getVendorCode = DB::select("SELECT MASTER_COMP.COMP_CODE,MASTER_COMP.COMP_NAME FROM MASTER_COMP WHERE VENDOR_CODE LIKE '%$comp_code_excel[$j]%'");	*/

				$getVendorCode1 = DB::table('MASTER_COMP')->select('COMP_CODE','COMP_NAME')->where('VENDOR_CODE','LIKE','%'.$comp_code_excel[$j].'%')->get()->first();


				$getVendorCode = json_decode(json_encode($getVendorCode1));

				if($getVendorCode){

				 $compVendorCode =	$getVendorCode->COMP_CODE;
				 $compVendorName = 	$getVendorCode->COMP_NAME;
				}else{
				 $compVendorCode =	'';
				 $compVendorName = 	'';
				}

			
				$getFromPlace1 = DB::table('MASTER_PLANT')->select('CITY_NAME')->where('PLANT_CODE',$plant_code_excel[$j])->get()->first();

				$getFromPlace = json_decode(json_encode($getFromPlace1));

				if($getFromPlace){

				 $FromPlaceCityName =	$getFromPlace->CITY_NAME;
				}else{
				 $FromPlaceCityName =	'';
				}
				
				
				


				  	$data_body = array(

						'FSOHID'       =>$headId,
						'FSOBID'       =>$bodyId,
						'PFCT_CODE'    =>$pfct_code,
						'TRAN_CODE'    =>$trans_code,
						'SERIES_CODE'  =>$series_code,
						'VRNO'         =>$NewVrno,
						'SLNO'         =>$j+1,
						'ACC_CODE'     =>$acc_code,
						'ACC_NAME'     =>$acc_name,
						'COMP_CODE'    =>$compVendorCode,
						'COMP_NAME'    =>$compVendorName,
					    'FROM_PLACE'   =>$FromPlaceCityName,
						'TO_PLACE'     =>$city_name_excel[$j],
						'PLANT_CODE'   =>$plant_code_excel[$j],
						'PLANT_NAME'   =>$plant_name_excel[$j],
						'CITY_CODE'    =>$city_code_excel[$j],
						'CITY_NAME'    =>$city_name_excel[$j],
						'VEHICLE_TYPE' =>$cat_vehicle_excel[$j],
						'RATE'         =>$rate_excel[$j],
						'VALID_FROM_DATE'  =>$valid_from_excel[$j],
						'VALID_TO_DATE'    =>$valid_to_excel[$j],
						'CONTR_NO'         =>$contr_excel[$j],
						'CREATED_BY'   =>$createdBy,

				    );

				  ///  print_r($data_body);exit;

				  	$saveData1 = DB::table('FSO_BODY')->insert($data_body);

		  
		 }

		//exit;
	  }

	}else{


			for ($i = 0; $i < $count; $i++) {

			

		    $data_body = array(

				'FSOHID'       =>$headId,
				'COMP_CODE'    =>$getcompcode,
				'FY_CODE'      =>$fisYear,
				'PFCT_CODE'    =>$pfct_code,
				'TRAN_CODE'    =>$trans_code,
				'SERIES_CODE'  =>$series_code,
				'PLANT_CODE'   =>$plant_code,
				'PLANT_NAME'   =>$plant_name,
				'VRNO'         =>$NewVrno,
				'SLNO'         =>$i+1,
				'ACC_CODE'     =>$acc_code,
				'ACC_NAME'     =>$acc_name,
				'ROUTE_CODE'   =>$route_code[$i],
				'ROUTE_NAME'   =>$route_name[$i],
				'FROM_PLACE'   =>$from_place[$i],
				'TO_PLACE'     =>$to_place[$i],
				'WHEEL_CODE'   =>$wheelCode[$i],
				'VEHICLE_TYPE' =>$vehicleType[$i],
				'RATE_BASIS'   =>$rate_basis[$i],
				'RATE'         =>$rate[$i],
				'VALID_FROM_DATE'  =>$validfrmdate,
				'VALID_TO_DATE'    =>$validtodate,
				'CREATED_BY'   =>$createdBy,

		    );
	
	    	$saveData1 = DB::table('FSO_BODY')->insert($data_body);
			

		}
			
	}




				$data1['response'] = 'success';
	  			$getalldata = json_encode($data1);  
	  			print_r($getalldata);

          }catch (\Exception $e) {

			    DB::rollBack();
			    throw $e;
			    $data1['response'] = 'error';
	  			$getalldata = json_encode($data1);  
	  			print_r($getalldata);
		}


   }


    public function SaveFreightSaleOrder1(Request $request)
    {

    	/*echo '<pre>';
    	print_r($request->post());exit;

    	echo '</pre>';*/
			//
			$createdBy        = $request->session()->get('userid');
			$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
			$fisYear          = $request->session()->get('macc_year');
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
			$acc_code         = $request->input('AccCode');
			$acc_name         = $request->input('AccName');
			$frieghttypeCd    = $request->input('frieghttype_code');
			$frieghtypeNm     = $request->input('frieghtype_name');
			$freight_order_no = $request->input('FreightNo');
			$route_code       = $request->input('route_code');
			$route_name       = $request->input('route_name');
			
			$refno            = $request->input('getrefNo');
			$ref_date         = $request->input('getrefDate');
			$refdate          = date("Y-m-d", strtotime($ref_date));
			$valid_frmdate    = $request->input('getvalidfrmDate');
			$validfrmdate     = date("Y-m-d", strtotime($valid_frmdate));
			$valid_todate     = $request->input('getvalidtoDate');
			$validtodate      = date("Y-m-d", strtotime($valid_todate));
			$from_place       = $request->input('from_place');
			$to_place         = $request->input('to_place');
			$vehicle_type     = $request->input('vehicle_type');
			$rate_basis       = $request->input('rate_basis');
			$rate             = $request->input('rate');
			$qty              = $request->input('qty');
			$unit_M           = $request->input('unit_M');
			$count            = count($vehicle_type);






	   
	    $StoreH = DB::select("SELECT MAX(FSOHID) as FSOHID  FROM FSO_HEAD");
		$headID = json_decode(json_encode($StoreH), true); 
	  //  print_r($headID);exit;
	
		if(empty($headID[0]['FSOHID'])){
			$headId = 1;
		}else{
			$headId = $headID[0]['FSOHID']+1;
		}

		   if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('FSO_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}


  		

	    	$datahead = array(
				
				'COMP_CODE'        =>$getcompcode,
				'FY_CODE'          =>$fisYear,
				'FSOHID'           =>$headId,
				'TRAN_CODE'        =>$trans_code,
				'SERIES_CODE'      =>$series_code,
				'SERIES_NAME'      =>$series_name,
				'PFCT_CODE'        =>$pfct_code,
				'PFCT_NAME'        =>$pfct_name,
				'VRNO'             =>$NewVrno,
				'VRDATE'           =>$tr_vr_date,
				'PLANT_CODE'       =>$plant_code,
				'PLANT_NAME'       =>$plant_name,
				'ACC_CODE'         =>$acc_code,
				'ACC_NAME'         =>$acc_name,
				'FREIGHTTYPE_CODE' =>$frieghttypeCd,
				'FREIGHTTYPE_NAME' =>$frieghtypeNm,
				'REF_NO'           =>$refno,
				'REF_DATE'         =>$refdate,
				'VALID_FROM_DT'    =>$validfrmdate,
				'VALID_TO_DT'      =>$validtodate,
				'CREATED_BY'       =>$createdBy,

			);


	    
	      $saveData = DB::table('FSO_HEAD')->insert($datahead);

	      $lastid= DB::getPdo()->lastInsertId();

	      	$discriptn_page = "Freight Sale Order insert done by user";
			//$acc_code = '';
			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);
  			
	     if($importExcel != ''){


	     	$getDoBodyCoulmName= DB::select("SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA='$db_name' AND table_name='RAKE_TRAN'");

			
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


			$column_name = DB::table('MASTER_EXCELCONFIG')->select('TBL_COL','TEMPEXCEL_COL')->where('TRAN_CODE','RAKE')->where('EXLCONFIG_CODE',$excelCode)->get()->toArray();

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
		    $cp_add_excel = [];
		    $sp_name_excel = [];
		    $obd_no_excel = [];
		    $sl_no_excel = [];
		   


		   for($j = 0; $j <$tempDoOrderCount; $j++) {

       		$srno = $j + 1;

		 
					 $data_import = array(

						'TRIP_NO'      =>$trip_no,
						'INVC_NO'      =>$invc_no_excel[$j],
						'INVC_DATE'    =>$invc_date_excel[$j],
						'DO_NO'        =>$do_no_excel[$j],
						'LR_NO'        =>$lr_no_excel[$j],
						'LR_DATE'      =>$lr_date_excel[$j],
						'MATERIAL_VAL' =>$material_val_excel[$j],
						'ITEM_CODE'    =>$item_excel[$j],
						'ITEM_NAME'    =>$remark_excel[$j],
						'QTY'          =>$qty_excel[$j],
						'CREATED_BY'   =>$createdBy,

				);




		    //$saveData1 = DB::table('DORDER_BODY')->insert($data_import);

			$saveData1 = DB::table('TRIP_BODY')->where('VRNO',$tripno)->where('SLNO',$srno)->where('SERIES_CODE',$series_code)->where('FY_CODE',$fisYear)->where('ITEM_CODE',$item_excel[$j])->update($data_import);

			$srno++;
		 }

		 	


		}else{


			for ($i = 0; $i < $count; $i++) {

			$StoreB = DB::select("SELECT MAX(FSOBID) as FSOBID FROM FSO_BODY");

			$bodyID = json_decode(json_encode($StoreB), true); 
	
			if(empty($bodyID[0]['FSOBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['FSOBID']+1;
			}

		    $data_body = array(

				'FSOHID'       =>$headId,
				'FSOBID'       =>$bodyId,
				'COMP_CODE'    =>$getcompcode,
				'FY_CODE'      =>$fisYear,
				'PFCT_CODE'    =>$pfct_code,
				'TRAN_CODE'    =>$trans_code,
				'SERIES_CODE'  =>$series_code,
				'VRNO'         =>$NewVrno,
				'SLNO'         =>$i+1,
				'ACC_CODE'     =>$acc_code,
				'ACC_NAME'     =>$acc_name,
				'ROUTE_CODE'   =>$route_code[$i],
				'ROUTE_NAME'   =>$route_name[$i],
				'FROM_PLACE'   =>$from_place[$i],
				'TO_PLACE'     =>$to_place[$i],
				'VEHICLE_TYPE' =>$vehicle_type[$i],
				'RATE_BASIS'   =>$rate_basis[$i],
				'RATE'         =>$rate[$i],
				'CREATED_BY'   =>$createdBy,

		    );
	
	    	$saveData1 = DB::table('FSO_BODY')->insert($data_body);
			

		}
			
	}

		$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->toArray();
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

		
			
		

		if($saveData1){
			$response_array['response'] = 'success';
			$response_array['lastid'] = $headID;
		    $data = json_encode($response_array);
		    print_r($data);

		}else{

			$response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);

		}
	

    }


     public function ViewFreightSaleOrder(Request $request)
    {
    		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

			$title       ='View Freight Sale Order';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	        
           
	        $data = DB::table('FSO_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->get();
            	

	        }else if($userType=='superAdmin' || $userType=='user'){

	           $data = DB::table('FSO_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->get();

	        }
	        else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	       return view('admin.finance.transaction.logistic.view_freight_sale_order');
	    }else{
			return redirect('/useractivity');
		}
    }



     public function ViewChildFreightSaleOrder(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$delivery_order = DB::table('FSO_BODY')->where('FSOHID', $headid)->where('VRNO', $vrno)->get()->toArray();
	    	

    		if($delivery_order) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $delivery_order;
	         

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


    public function freight_sale_order_msg(Request $request,$saveData){

		if ($saveData==true) {

			$request->session()->flash('alert-success', 'Freight Sale Order Was Successfully Added...!');
			return redirect('/Transaction/Logistic/View-Freight-Sale-Order');

		}else{

			$request->session()->flash('alert-error', 'Freight Sale Order Can Not Added...!');
			return redirect('/Transaction/Logistic/View-Freight-Sale-Order');

		}
	}

     public function getPlaceFreightOrder(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$OrderNo   = $request->input('FreightOrderNo');
		 

	    	$delivery_order = DB::table('FSO_BODY')->where('VRNO', $OrderNo)->groupBy('VRNO')->get()->toArray();
	    	

    		if($delivery_order) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $delivery_order;
	         

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

     public function getFreightOrderByCust(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$acc_code   = $request->input('acc_code');
		 

	    	$freight_order = DB::table('FSO_HEAD')->where('ACC_CODE', $acc_code)->get()->toArray();
	    	
	    	
    		if($freight_order) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $freight_order;
	         

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
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


     public function getLocationRoute(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$route_code   = $request->input('route_code');
		 

	    	$location = DB::table('MASTER_FREIGHT_ROUTE')->where('ROUTE_CODE', $route_code)->get()->toArray();
	    	
	    	
	    	//print_r($location);exit();

    		if($location) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $location;
	         

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
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function getCityName(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$consinee_add_code   = $request->input('cp_address_code');
	    	$consinee   = $request->input('consinee');
		 
	    // DB::enableQueryLog();
	    	$get_city = DB::table('MASTER_ACCADD')->where('CPCODE',$consinee_add_code)->where('ACC_CODE',$consinee)->get()->first();
	    	//dd(DB::getQueryLog());
	    	

    		if($get_city) {

    			$response_array['response'] = 'success';
	         $response_array['data'] = $get_city;
	         

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

public function validateCityName(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$consinee_add_code   = $request->input('cp_address_code');
	    	$consinee   = $request->input('sp_code');
	    	$toPlace   = $request->input('toPlace');

	    	//print_r($consinee);exit;
		 
	     //DB::enableQueryLog();
	    	$get_city = DB::table('MASTER_ACCADD')->where('CPCODE',$consinee_add_code)->where('ACC_CODE',$consinee)->where('CITY_NAME',$toPlace)->get()->first();
	    //dd(DB::getQueryLog());
	    	
	    	//print_r($get_city);exit;

    		if($get_city) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $get_city;
	         

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
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    
    public function getLocationPlanRoute(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$route_code   = $request->input('route_code');
		 

	    	/*$location = DB::table('MASTER_FREIGHT_ROUTE')->where('ROUTE_CODE', $route_code)->where('VEHICLE_TYPE','fullload')->get()->first();*/
	    	
	    	$location = DB::table('MASTER_FREIGHT_ROUTE')->where('ROUTE_CODE', $route_code)->get()->first();

    		if($location) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $location;
	         

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



     public function getRouteDetailsByFromPlace(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$route_code   = $request->input('route_code');
	    	$from_place   = $request->input('from_place');
		 

	    	$location = DB::table('MASTER_FREIGHT_ROUTE')->where('ROUTE_CODE', $route_code)->where('FROM_PLACE', $from_place)->get()->first();
	    	
	    	//print_r($location);exit;

    		if($location) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $location;
	         

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
    


    /*freight purchase order*/

 public function AddFreightPurchaseOrder(Request $request)
    {
    	//print_r($this->data);exit;
		$title                        ='Freight Purchase Order';
		
		$CompanyCode                  = $request->session()->get('company_name');
		$compcode                     = explode('-', $CompanyCode);
		$getcompcode                  =$compcode[0];
		$macc_year                    = $request->session()->get('macc_year');
		
		$userdata['comp_list']        = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']           = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		//DB::enableQueryLog();
		$userdata['series_list']      = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T2'])->where(['COMP_CODE'=>$getcompcode])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']    = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
		//DB::enableQueryLog();
		$userdata['dept_list']        = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']       = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']        = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']        = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']        = DB::table('MASTER_COST')->get();
		$userdata['emp_list']         = DB::table('MASTER_EMP')->get();
		
		$userdata['help_item_list']   = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']        = DB::table('MASTER_RATE_VALUE')->get();
		
		$userdata['cost_list']        = DB::table('MASTER_COST')->get();
		
		$userdata['area_list']        = DB::table('MASTER_AREA')->get();

		$userdata['um_list']        = DB::table('MASTER_UM')->get();
		
		$userdata['vehicletype_list'] = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

	     $userdata['route_list']        = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('ROUTE_CODE')->get();



		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		$requistion = DB::table('FPO_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();

		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T2')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='T2'");
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

		    return view('admin.finance.transaction.logistic.freight_purchase_order',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }


    public function SaveFreightPurchaseOrder(Request $request)
    {

    	/*echo '<pre>';
    	print_r($request->post());exit;

    	echo '</pre>';*/
			//
			$createdBy        = $request->session()->get('userid');
			$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
			$fisYear          =  $request->session()->get('macc_year');
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
			$route_code       = $request->input('route_code');
			$route_name       = $request->input('route_name');
			$ref_no           = $request->input('getrefNo');
			$refdate         = $request->input('getrefDate');
			$ref_date       = date("Y-m-d", strtotime($refdate));

			$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
			$from_date       = $request->input('getvalidfrmDate');
			$fromDate          = date("Y-m-d", strtotime($from_date));
			$to_date       = $request->input('getvalidtoDate');
			$toDate          = date("Y-m-d", strtotime($to_date));
			$plant_code       = $request->input('plant_code');
			$acc_code         = $request->input('AccCode');
			$acc_name         = $request->input('AccName');
			$freight_order_no = $request->input('FreightNo');
			$from_place       = $request->input('from_place');
			$to_place         = $request->input('to_place');
			$vehicle_type     = $request->input('getVehicleType');
			$rate_basis       = $request->input('rate_basis');
			$rate             = $request->input('rate');
			$qty              = $request->input('qty');
			$unit_M           = $request->input('unit_M');
			$count            = count($from_place);


	   
	    $StoreH = DB::select("SELECT MAX(FPOHID) as FPOHID  FROM FPO_HEAD");
		$headID = json_decode(json_encode($StoreH), true); 
	  //  print_r($headID);exit;
	
		if(empty($headID[0]['FPOHID'])){
			$headId = 1;
		}else{
			$headId = $headID[0]['FPOHID']+1;
		}

		   if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('FPO_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}


  		

	    	$datahead = array(
				
				'COMP_CODE'     =>$getcompcode,
				'FY_CODE'       =>$fisYear,
				'FPOHID'        =>$headId,
				'TRAN_CODE'     =>$trans_code,
				'SERIES_CODE'   =>$series_code,
				'SERIES_NAME'   =>$series_name,
				'PFCT_CODE'     =>$pfct_code,
				'PFCT_NAME'     =>$pfct_name,
				'VRNO'          =>$NewVrno,
				'VRDATE'        =>$tr_vr_date,
				'PLANT_CODE'    =>$plant_code,
				'PLANT_NAME'    =>$plant_name,
				'ACC_CODE'      =>$acc_code,
				'ACC_NAME'      =>$acc_name,
				'VEHICLE_TYPE'  =>$vehicle_type,
				'REF_NO'        =>$ref_no,
				'REF_DATE'      =>$ref_date,
				'VALID_FROM_DT' =>$fromDate,
				'VALID_TO_DT'   =>$toDate,
				'CREATED_BY'    =>$createdBy,

			);


	    
	      $saveData = DB::table('FPO_HEAD')->insert($datahead);

	      $lastid= DB::getPdo()->lastInsertId();

	      	$discriptn_page = "Freight Purchase Order insert done by user";
			$acc_code = '';
			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);
  			
	     //$data = array();
		for ($i = 0; $i < $count; $i++) {

			$StoreB = DB::select("SELECT MAX(FPOBID) as FPOBID FROM FPO_BODY");

			$bodyID = json_decode(json_encode($StoreB), true); 
	
			if(empty($bodyID[0]['FPOBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['FPOBID']+1;
			}

		    $data_body = array(

				'FPOHID'       =>$headId,
				'FPOBID'       =>$bodyId,
				'COMP_CODE'    =>$getcompcode,
				'FY_CODE'      =>$fisYear,
				'PFCT_CODE'    =>$pfct_code,
				'TRAN_CODE'    =>$trans_code,
				'SERIES_CODE'  =>$series_code,
				'ROUTE_CODE'   =>$route_code[$i],
				'ROUTE_NAME'   =>$route_name[$i],
				'VRNO'         =>$NewVrno,
				'SLNO'         =>$i+1,
				'FROM_PLACE'   =>$from_place[$i],
				'TO_PLACE'     =>$to_place[$i],
				'RATE_BASIS'   =>$rate_basis[$i],
				'RATE'         =>$rate[$i],
				'CREATED_BY'   =>$createdBy,

		    );
	
	    	$saveData1 = DB::table('FPO_BODY')->insert($data_body);
			

		}


		$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->toArray();
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

		
			
		

		if($saveData1){
			$response_array['response'] = 'success';
			$response_array['lastid'] = $headID;
		    $data = json_encode($response_array);
		    print_r($data);

		}else{

			$response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);

		}
	

    }


     public function ViewFreightPurchaseOrder(Request $request)
    {
    		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

			$title       ='View Freight Purchase Order';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	        
           
	        $data = DB::table('FPO_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->get();
            	

	        }else if($userType=='superAdmin' || $userType=='user'){

	           $data = DB::table('FPO_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->get();

	        }
	        else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	       return view('admin.finance.transaction.logistic.view_freight_purchase_order');
	    }else{
			return redirect('/useractivity');
		}
    }



     public function ViewChildFreightPurchaseOrder(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$delivery_order = DB::table('FSO_BODY')->where('FSOHID', $headid)->where('VRNO', $vrno)->get()->toArray();
	    	

    		if($delivery_order) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $delivery_order;
	         

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


public function freight_purchase_order_msg(Request $request,$saveData){

		if ($saveData==true) {

			$request->session()->flash('alert-success', 'Freight Purchase Order Was Successfully Added...!');
			return redirect('/Transaction/Logistic/View-Freight-Purchase-Order');

		}else{

			$request->session()->flash('alert-error', 'Freight Purchase Order Can Not Added...!');
			return redirect('/Transaction/Logistic/View-Freight-Purchase-Order');

		}
	}


/*vehicle planing withput item*/

public function VehiclePlaningWoItem(Request $request){

		$title                       = 'Add Vehicle Planning W/o Item';
		$compName                    = $request->session()->get('company_name');
		$fisYear                     =  $request->session()->get('macc_year');
		$CompanyCode                 = $request->session()->get('company_name');
		$compcode                    = explode('-', $CompanyCode);
		$getcompcode                 =$compcode[0];
		$vehicle_no                  = $request->old('vehicle_no');
		$from_place                  = $request->old('from_place');
		$to_place                    = $request->old('to_place');
		$transporter                 = $request->old('transporter');
		$date                        = $request->old('date');
		$fright_order                = $request->old('fright_order');
		$vehicleId                   = $request->old('id');
		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();
		
		$userdata['vehicle_list']    = DB::table('MASTER_FLEET')->get();
		
		$userdata['inward_list']     = DB::table('MASTER_INWARD_SLIP')->get();
		
		$userdata['transport_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();
		
	//	$userdata['getacc']          = DB::table('MASTER_ACC')->get();

		$userdata['getacc']          = DB::table('MASTER_ACC')->groupBy('ACC_CODE')->get();

		$userdata['employee_list']        = DB::table('MASTER_ACC')->where('ATYPE_CODE','E')->get();

       //DB::enableQueryLog();
		$userdata['getacc_do']       = DB::table('DORDER_BODY')->where('COMP_CODE',$getcompcode)->WhereNotNull('SISCONCERN_COMP_CODE')->groupBy('ACC_CODE')->get();
		//$userdata['getacc_do']       = DB::table('DORDER_BODY')->where('SISCONCERN_COMP_CODE','!=','NULL')->groupBy('ACC_CODE')->get();
	  //dd(DB::getQueryLog());
		//DB::enableQueryLog();
		$userdata['series_list']     = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T3'])->where(['COMP_CODE'=>$getcompcode])->get();
		//dd(DB::getQueryLog());
		$userdata['tax_code_list']   = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		//DB::enableQueryLog();
		$userdata['dept_list']       = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']      = DB::table('MASTER_PLANT')->where('COMP_CODE',$getcompcode)->get();
		$userdata['pfct_list']       = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']       = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']       = DB::table('MASTER_COST')->get();
		$userdata['emp_list']        = DB::table('MASTER_EMP')->get();
		
		$userdata['item_list']       = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']       = DB::table('MASTER_RATE_VALUE')->get();
		
		$userdata['area_list']       = DB::table('MASTER_CITY')->get();

		$userdata['do_list']         = DB::table('DORDER_BODY')->groupBy('DORDER_NO')->get();

		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['truck_list']      = DB::table('MASTER_FLEET')->get();
		
		$userdata['comp_list']       = DB::table('MASTER_COMP')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

		$userdata['fpo_list']      = DB::table('FPO_HEAD')->get();

        $userdata['um_list']      = DB::table('MASTER_UM')->get();

        $userdata['freightType_list']      = DB::table('MASTER_FREIGHTTYPE')->get();


		$userdata['route_list']   = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('ROUTE_NAME')->get();

		
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$fisYear])->get();

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}


		//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T3')->get();

   		$userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
	
		$button='Save';
    	$action='Vehicle-Planing-Save';

    
    	return view('admin.finance.transaction.logistic.vehicle_plan_wo_item',$userdata+compact('title','button','action','vehicle_no','from_place','to_place','transporter','date','fright_order','vehicleId'));



    }


    public function SaveVehiclePlaningWoItem(Request $request)
    {

    	/*echo '<pre>';
    	print_r($request->post());exit;

    	echo '</pre>';*/
    	//
			$createdBy        = $request->session()->get('userid');
			$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
			$fisYear          =  $request->session()->get('macc_year');
			$comp_nameval     = $request->input('comp_name');
			$fy_year          = $request->input('fiscal_year');
			$pfct_code        = $request->input('pfct_code');
			$trans_code       = $request->input('trans_code');
			$series_code      = $request->input('series_code');
			$series_name      = $request->input('series_name');
			$plant_name       = $request->input('plant_name');
			$pfct_name        = $request->input('pfct_name');
			$vr_no            = $request->input('vro');
			$trans_date       = $request->input('vr_date');
			$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
			$plant_code       = $request->input('plant_code');
            $consignee_code   = $request->input('consignee'); 
		    $consignee_name   = $request->input('consineeName');
		    $consigneeadd     = $request->input('consigneeadd'); 
		    $to_place         = $request->input('to_place');
		    $acc_code         = $request->input('AccCode');
			$acc_name         = $request->input('acctname');
			$fsorder_no       = $request->input('fsorder_no');
			$sale_rate        = $request->input('sale_rate');
			$sale_qty         = $request->input('sale_qty');
			$fsohid           = $request->input('fsohid');
			$fsobid           = $request->input('fsobid');
			$route_code       = $request->input('route_code'); 
			$route_name       = $request->input('route_name'); 
			$trip_day         = $request->input('trip_day'); 
			$off_days         = $request->input('off_days'); 
			$from_place       = $request->input('from_place');
			$head_toplace     = $request->input('head_toplace');
			$vehicle_no       = $request->input('vehicle_no');
			$vehicle_owner    = $request->input('vehicle_owner');
			$transporter_code = $request->input('transporter_code');
			$transporter_name = $request->input('transporter_name');
			$fright_order     = $request->input('fright_order');
			$rate             = $request->input('rate');
			$mfprate          = $request->input('mfprate');
			$amount           = $request->input('amount');
			$freight_qty      = $request->input('freight_qty');
			$rate_basis       = $request->input('rate_basis');
			$payment_mode     = $request->input('payment_mode');
			$adv_type         = $request->input('adv_type');
			$adv_rate         = $request->input('adv_rate');
			$adv_amount       = $request->input('adv_amount');
			$qty              = $request->input('qty');
			$unit_M           = $request->input('unit_M');
			$Aqty             = $request->input('Aqty');
			$unit_AUM         = $request->input('unit_AUM');
			$sp_code          = $request->input('sp_code');
            $sp_name          = $request->input('spName');
            $sr_flag          = $request->input('sr_flag');
            $trip_expense     = $request->input('trip_expense');
            $vehicle_model    = $request->input('vehicle_model');
            $vehicle_type     = $request->input('vehicle_type');
			$vehicleType_name = $request->input('vehicleType_name');
			$whee_type_code   = $request->input('whee_type_code');
            $whee_type_name   = $request->input('whee_type_name');
            $min_gurrentee    = $request->input('min_gurrentee');
            $emp_code         = $request->input('emp_code');
            $emp_name         = $request->input('emp_name');
            $count            = count($consignee_code);


        DB::beginTransaction();

		try {

          
			  $StoreH = DB::select("SELECT MAX(TRIPHID) as TRIPHID  FROM TRIP_HEAD");
				$headID = json_decode(json_encode($StoreH), true); 
			  //  print_r($headID);exit;
			
				if(empty($headID[0]['TRIPHID'])){
					$headId = 1;
				}else{
					$headId = $headID[0]['TRIPHID']+1;
				}

				   if($vr_no == ''){
						$vrNum = 1;
					}else{
						$vrNum = $vr_no;
					}


					$vrno_Exist = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$trans_code)->get()->toArray();

					if($vrno_Exist){
						$NewVrno = $vrno_Exist[0]->LAST_NO +1;
					}else{
						$NewVrno = $vrNum;
					}



					$fycode_explode = explode('-', $fisYear);

					$fy_code = $fycode_explode[0];
					$trip_no = $fy_code.' '.$series_code.' '.$NewVrno;
  			
				  $datahead = array(
							'COMP_CODE'      => $getcompcode,
							'FY_CODE'        => $fisYear,
							'TRIPHID'        => $headId,
							'TRAN_CODE'      => $trans_code,
							'SERIES_CODE'    => $series_code,
							'SERIES_NAME'    => $series_name,
							'PFCT_CODE'      => $pfct_code,
							'PFCT_NAME'      => $pfct_name,
							'VRNO'           => $NewVrno,
							'TRIP_NO'        => $trip_no,
							'VRDATE'         => $tr_vr_date,
							'PLANT_CODE'     => $plant_code,
							'PLANT_NAME'     => $plant_name,
							'ACC_CODE'       => $acc_code,
							'ACC_NAME'       => $acc_name,
							'EMP_CODE'       => $emp_code,
							'EMP_NAME'       => $emp_name,
							'FSO_NO'         => $fsorder_no,
							'FSO_RATE'       => $sale_rate,
							'FSO_QTY'        => $sale_qty,
							'FSOHID'         => $fsohid,
							'FSOBID'         => $fsobid,
							'ROUTE_CODE'     => $route_code,
							'ROUTE_NAME'     => $route_name,
							'TRIP_DAY'       => $trip_day,
							'OFF_DAY'        => $off_days,
							"FROM_PLACE"     => $from_place, 
							"TO_PLACE"       => $head_toplace, 
							"VEHICLE_NO"     => $vehicle_no,
							"OWNER"          => $vehicle_owner,
							"TRANSPORT_CODE" => $transporter_code, 
							"TRANSPORT_NAME" => $transporter_name, 
							"VEHICLE_TYPE"   => $vehicle_type,
							"VEHICLE_TYPE_NAME"   =>$vehicleType_name,
							"WHEELTYPE_CODE" =>$whee_type_code,
                            "WHEELTYPE_NAME" =>$whee_type_name,
                            "MIN_GUARANTEE"  =>$min_gurrentee,
							"FPO_NO"         => $fright_order,
							"FPO_RATE"       => $rate,
							"MFPO_RATE"      => $mfprate,
							"RATE_BASIS"     => $rate_basis,
							"AMOUNT"         => $amount,
							"FREIGHT_QTY"    => $freight_qty,
							"PAYMENT_MODE"   => $payment_mode,
							"ADV_TYPE"       => $adv_type,
							"ADV_RATE"       => $adv_rate,
							"ADV_AMT"        => $adv_amount,
							"PLAN_STATUS"    =>  1,
							"TRIP_WO_ITEM"   => '1',
							"SLR_FLAG"       => $sr_flag,
							"TRIP_EXPENSE"   => $trip_expense,
							"MODEL"          => $vehicle_model,
							"CREATED_BY"     => $createdBy,
							
						);

	    
	             $saveData = DB::table('TRIP_HEAD')->insert($datahead);

	    		 $lastid= DB::getPdo()->lastInsertId();

	      		 $discriptn_page = "Store requistion trans insert done by user";

				 $this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);
  			
	     //$data = array();
		//$slno = 1; 

		for ($i = 0; $i < $count; $i++) {

			$StoreB = DB::select("SELECT MAX(TRIPBID) as TRIPBID FROM TRIP_BODY");

			$bodyID = json_decode(json_encode($StoreB), true); 
	
			if(empty($bodyID[0]['TRIPBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['TRIPBID']+1;
			}

			$slno = $i + 1;


			if($Aqty[$i]==''){
						$aqty ='0.000';
					}else{
						$aqty= $Aqty[$i];
					}

		    $data_body = array(

				'TRIPHID'       =>$headId,
				'TRIPBID'       =>$bodyId,
				'COMP_CODE'     =>$getcompcode,
				'FY_CODE'       =>$fisYear,
				'VRDATE'        =>$tr_vr_date,
				'PFCT_CODE'     =>$pfct_code,
				'TRAN_CODE'     =>$trans_code,
				'SERIES_CODE'   =>$series_code,
				'VRNO'          =>$NewVrno,
				'SLNO'          =>$slno,
				'ACC_CODE'      =>$acc_code,
				'ACC_NAME'      =>$acc_name,
				'CP_CODE'       =>$consignee_code[$i],
				'CP_NAME'       =>$consignee_name[$i],
				'SP_CODE'       =>$sp_code[$i],
				'SP_NAME'       =>$sp_name[$i],
				'FROM_PLACE'    =>$from_place,
				'TO_PLACE'      =>$to_place[$i],
				'QTY'           =>$qty[$i],
				'UM'            =>$unit_M[$i],
				'AQTY'          =>$aqty,
				'AUM'           =>$unit_AUM[$i],
				'CREATED_BY'    =>$createdBy,

		    );
	
	    	$saveData1 = DB::table('TRIP_BODY')->insert($data_body);

		}

		
		$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->toArray();
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

		

			DB::commit();
	       	$response_array['response'] = 'success';
		    $data = json_encode($response_array);
		    print_r($data);

          }catch (\Exception $e) {

			    DB::rollBack();
			    throw $e;
			    $response_array['response'] = 'error';
	            $data = json_encode($response_array);
	            print_r($data);
			}
		 
		    //throw $e;
		
    }
/*vehicle planing withput item*/

/*vehicle planing*/

public function VehiclePlaningForm(Request $request){

		$title                       = 'Add Master Vehicle Planning';
		$compName                    = $request->session()->get('company_name');
		$fisYear                     =  $request->session()->get('macc_year');
		$CompanyCode                 = $request->session()->get('company_name');
		$compcode                    = explode('-', $CompanyCode);
		$getcompcode                 = $compcode[0];
		$vehicle_no                  = $request->old('vehicle_no');
		$from_place                  = $request->old('from_place');
		$to_place                    = $request->old('to_place');
		$transporter                 = $request->old('transporter');
		$date                        = $request->old('date');
		$fright_order                = $request->old('fright_order');
		$vehicleId                   = $request->old('id');
		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();
		
		$userdata['vehicle_list']    = DB::table('MASTER_FLEET')->get();
		
		$userdata['inward_list']     = DB::table('MASTER_INWARD_SLIP')->get();
		
		$userdata['transport_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();

		$userdata['employee_list']        = DB::table('MASTER_ACC')->where('ATYPE_CODE','E')->get();

		//print_r($userdata['emp_list']);exit();
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();
		
	//	$userdata['getacc']          = DB::table('MASTER_ACC')->get();

		$userdata['getacc']          = DB::table('MASTER_ACC')->where('ATYPE_CODE','D')->groupBy('ACC_CODE')->get();

		$userdata['getconsinee']          = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->groupBy('ACC_CODE')->get();

		$userdata['getacc_do']       = DB::table('DORDER_HEAD')->where('COMP_CODE',$getcompcode)->groupBy('ACC_CODE')->get();
		//DB::enableQueryLog();
		$userdata['series_list']     = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T3'])->where(['COMP_CODE'=>$getcompcode])->get();
		//dd(DB::getQueryLog());
		$userdata['tax_code_list']   = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		//DB::enableQueryLog();
		$userdata['dept_list']       = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']      = DB::table('MASTER_PLANT')->where('COMP_CODE',$getcompcode)->get();
		$userdata['pfct_list']       = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']       = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']       = DB::table('MASTER_COST')->get();
		$userdata['emp_list']        = DB::table('MASTER_EMP')->get();
		
		$userdata['item_list']       = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']       = DB::table('MASTER_RATE_VALUE')->get();
		
		$userdata['area_list']       = DB::table('MASTER_CITY')->get();

		$userdata['do_list']         = DB::table('DORDER_BODY')->where('COMP_CODE',$getcompcode)->groupBy('DORDER_NO')->get();

		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['truck_list']      = DB::table('MASTER_FLEET')->get();
		
		$userdata['comp_list']       = DB::table('MASTER_COMP')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

		$userdata['freightType_list']      = DB::table('MASTER_FREIGHTTYPE')->get();

		$userdata['fpo_list']        = DB::table('FPO_HEAD')->get();

        $userdata['um_list']         = DB::table('MASTER_UM')->get();


		$userdata['route_list']      = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('ROUTE_NAME')->get();

		
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$fisYear])->get();

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}


		//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T3')->get();

   		$userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
	
		$button='Save';
    	$action='Vehicle-Planing-Save';

    
    	return view('admin.finance.transaction.logistic.vehicle_plan_form',$userdata+compact('title','button','action','vehicle_no','from_place','to_place','transporter','date','fright_order','vehicleId'));



    }



    public function SaveVehiclePlaning(Request $request)
    {

    	
    	//
    	    $donwloadStatus = $request->input('pdfYesNoStatus');
			$createdBy        = $request->session()->get('userid');
			$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
			$fisYear          =  $request->session()->get('macc_year');
			$comp_nameval     = $request->input('comp_name');
			$fy_year          = $request->input('fiscal_year');
			$pfct_code        = $request->input('pfct_code');
			$trans_code       = $request->input('trans_code');
			$series_code      = $request->input('series_code');
			$series_name      = $request->input('series_name');
			$plant_name       = $request->input('plant_name');
			$pfct_name        = $request->input('pfct_name');
			$vr_no            = $request->input('vro');
			$trans_date       = $request->input('vr_date');
			$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
			$plant_code       = $request->input('plant_code');
			$do_no            = $request->input('do_no');
            $do_type          = $request->input('do_type');
            $acatgory_code    = $request->input('acatgory_code');
            $rcomp_code       = $request->input('rcomp_code');
            $rcomp_name       = $request->input('rcomp_name');
            $trip_expense     = $request->input('trip_expense');
            $vehicle_model    = $request->input('vehicle_model');
            $emp_code         = $request->input('emp_code');
            $emp_name         = $request->input('emp_name');

		      if($do_type=='With DO'){

		        $consignee_code   = $request->input('consignee'); 
		        $consignee_name   = $request->input('consineeName');
		        $consigneeadd     = $request->input('consigneeadd');
		        
		        $to_place         = $request->input('to_place');
		        $acc_code         = $request->input('AccCode');
				$acc_name         = $request->input('acctname');
				$custCode         = $request->input('custCode');
                $custName         = $request->input('custName');
		       // 

		      }else{

		        $consignee_code   = $request->input('consignee_wdo'); 
		        $consignee_name   = $request->input('consineeName_wdo');
		        $consigneeadd     = $request->input('consigneeadd');
		        $to_place         = $request->input('to_place_wdo');
		        $acc_code         = $request->input('AccCodeWdo');
				$acc_name         = $request->input('acctname');
				$custCode         = $request->input('custwdoCode');
                $custName         = $request->input('custwdoName');
				
		      //  $delorderDate     = $request->input('delorder_date');

		      }
			//$to_place         = $request->input('to_place');
			$delorderDate     = $request->input('delorder_date');
			$slnodo           = $request->input('slnodo');
			$fsorder_no       = $request->input('fsorder_no');
			$sale_rate        = $request->input('sale_rate');
			$sale_qty         = $request->input('sale_qty');
			$fsohid           = $request->input('fsohid');
			$fsobid           = $request->input('fsobid');
			$vehicle_type     = $request->input('vehicle_type');
			$vehicleType_name = $request->input('vehicleType_name');
			$whee_type_code   = $request->input('whee_type_code');
			$whee_type_name   = $request->input('whee_type_name');
			$min_gurrentee    = $request->input('min_gurrentee');
			$route_code       = $request->input('route_code'); 
			$route_name       = $request->input('route_name'); 
			$trip_day         = $request->input('trip_day'); 
			$off_days         = $request->input('off_days'); 
			$from_place       = $request->input('from_place');
			$head_toplace     = $request->input('head_toplace');
			$vehicle_no       = $request->input('vehicle_no');
			$vehicle_owner    = $request->input('vehicle_owner');
			$transporter_code = $request->input('transporter_code');
			$transporter_name = $request->input('transporter_name');
			$fright_order     = $request->input('fright_order');
			$rate             = $request->input('rate');
			$mfprate          = $request->input('mfprate');
			$amount           = $request->input('amount');
			$freight_qty      = $request->input('freight_qty');
			$rate_basis       = $request->input('rate_basis');
			$payment_mode     = $request->input('payment_mode');
			$adv_type         = $request->input('adv_type');
			$adv_rate         = $request->input('adv_rate');
			$adv_amount       = $request->input('adv_amount');
			$item_code        = $request->input('item_code');
			$item_name        = $request->input('item_name');
			$remark           = $request->input('remark');
			$alise_item_code  = $request->input('alise_item_code');
			$alise_item_name  = $request->input('alise_item_name');
			$qty              = $request->input('qty');
			$unit_M           = $request->input('unit_M');
			$aqty             = $request->input('Aqty');
			$unit_AUM         = $request->input('unit_AUM');
			$sp_code          = $request->input('sp_code');
            $sp_name          = $request->input('spName');
            $ewaybill_no      = $request->input('ewaybill_no');
            $ewaybill_dt      = $request->input('ewaybill_dt');
            $refNo            = $request->input('refNo');
            $item_slno        = $request->input('item_slno');
            $Invc_no          = $request->input('Invc_no');
            $Invc_dt          = $request->input('Invc_dt');
            $wagon_no         = $request->input('wagon_no');
            $do_headId        = $request->input('do_headId');
            $do_bodyId        = $request->input('do_bodyId');
            $delivery_no      = $request->input('delivery_no');
            $gross_wt         = $request->input('gross_wt');
            $do_batch_no      = $request->input('do_batch_no');
            $consineeAdd      = $request->input('consineeAdd');
            $region           = $request->input('region');
            $count            = count($item_code);
          

            	//print_r($sale_rate);exit;

        DB::beginTransaction();

		try {
			   
			       $StoreH = DB::select("SELECT MAX(TRIPHID) as TRIPHID  FROM TRIP_HEAD");
				   $headID = json_decode(json_encode($StoreH), true); 
			  //  print_r($headID);exit;
			
					if(empty($headID[0]['TRIPHID'])){
						$headId = 1;
					}else{
						$headId = $headID[0]['TRIPHID']+1;
					}

				   if($vr_no == ''){
						$vrNum = 1;
					}else{
						$vrNum = $vr_no;
					}


					/*$vrno_Exist = DB::table('TRIP_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

					if($vrno_Exist){
						$NewVrno = $vrNum +1;
					}else{
						$NewVrno = $vrNum;
					}*/

					$vrno_Exist = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$trans_code)->get()->toArray();

					if($vrno_Exist){
						$NewVrno = $vrno_Exist[0]->LAST_NO +1;
					}else{
						$NewVrno = $vrNum;
					}


					$fycode_explode = explode('-', $fisYear);

					$fy_code = $fycode_explode[0];
					$trip_no = $fy_code.' '.$series_code.' '.$NewVrno;
  			
				  $datahead = array(
							'COMP_CODE'      => $getcompcode,
							'FY_CODE'        => $fisYear,
							'TRIPHID'        => $headId,
							'TRAN_CODE'      => $trans_code,
							'SERIES_CODE'    => $series_code,
							'SERIES_NAME'    => $series_name,
							'PFCT_CODE'      => $pfct_code,
							'PFCT_NAME'      => $pfct_name,
							'VRNO'           => $NewVrno,
							'TRIP_NO'        => $trip_no,
							'VRDATE'         => $tr_vr_date,
							'PLANT_CODE'     => $plant_code,
							'PLANT_NAME'     => $plant_name,
							'ACC_CODE'       => $acc_code,
							'ACC_NAME'       => $acc_name,
							'EMP_CODE'       => $emp_code,
							'EMP_NAME'       => $emp_name,
							'FSO_NO'         => $fsorder_no,
							'FSO_RATE'       => $sale_rate,
							'FSO_QTY'        => $sale_qty,
							'FSOHID'         => $fsohid,
							'FSOBID'         => $fsobid,
							'ROUTE_CODE'     => $route_code,
							'ROUTE_NAME'     => $route_name,
							'TRIP_DAY'       => $trip_day,
							'OFF_DAY'        => $off_days,
							"FROM_PLACE"     => $from_place, 
							"TO_PLACE"       => $head_toplace, 
							"VEHICLE_NO"     => $vehicle_no,
							'FSO_REF_NO'     => $refNo,
							"VEHICLE_TYPE"   => $vehicle_type,
							"VEHICLE_TYPE_NAME"   =>$vehicleType_name,
							"WHEELTYPE_CODE" =>$whee_type_code,
							"WHEELTYPE_NAME" =>$whee_type_name,
							"MIN_GUARANTEE"  =>$min_gurrentee,
							"OWNER"          => $vehicle_owner,
							"TRANSPORT_CODE" => $transporter_code, 
							"TRANSPORT_NAME" => $transporter_name, 
							"FPO_NO"         => $fright_order,
							"FPO_RATE"       => $rate,
							"MFPO_RATE"      => $mfprate,
							"RATE_BASIS"     => $rate_basis,
							"AMOUNT"         => $amount,
							"FREIGHT_QTY"    => $freight_qty,
							"PAYMENT_MODE"   => $payment_mode,
							"ADV_TYPE"       => $adv_type,
							"ADV_RATE"       => $adv_rate,
							"ADV_AMT"        => $adv_amount,
							"TRIP_EXPENSE"   => $trip_expense,
							"MODEL"          => $vehicle_model,
							"PLAN_STATUS"    => 1,
							"CREATED_BY"     => $createdBy,
							
						);

	    
	             $saveData = DB::table('TRIP_HEAD')->insert($datahead);

	    		 $lastid= DB::getPdo()->lastInsertId();

	      		 $discriptn_page = "Store requistion trans insert done by user";

				 $this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);
  			
	     //$data = array();
		//$slno = 1; 

		for ($i = 0; $i < $count; $i++) {

			$StoreB = DB::select("SELECT MAX(TRIPBID) as TRIPBID FROM TRIP_BODY");

			$bodyID = json_decode(json_encode($StoreB), true); 
	
			if(empty($bodyID[0]['TRIPBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['TRIPBID']+1;
			}

			if($delorderDate[$i]){

				$delorder_date    = date("Y-m-d", strtotime($delorderDate[$i]));
			}else{
				$delorder_date    ='';
			}

			if($Invc_dt[$i]){

				$invoice_date    = date("Y-m-d", strtotime($Invc_dt[$i]));
			}else{
				$invoice_date    ='0000-00-00';
			}

			if($ewaybill_dt[$i]){

				$ewaybill_date    = date("Y-m-d", strtotime($ewaybill_dt[$i]));
			}else{
				$ewaybill_date    ='0000-00-00';
			}

			if($aqty[$i]){

				$Aqty = $aqty[$i];
			}else{

				$Aqty = 0.000;
			}

			if($delivery_no[$i]){

				$DeliveryNo = $delivery_no[$i];
			}else{

				$DeliveryNo ='';
			}

			if($gross_wt[$i]){

				$GrossWt = $gross_wt[$i];
			}else{

				$GrossWt ='';
			}

			if($slnodo[$i]){

				$slno = $slnodo[$i];
			}else{

				$slno = $i + 1;
			}

		    $data_body = array(

				'TRIPHID'       =>$headId,
				'TRIPBID'       =>$bodyId,
				'COMP_CODE'     =>$getcompcode,
				'FY_CODE'       =>$fisYear,
				'VRDATE'        => $tr_vr_date,
				'PFCT_CODE'     =>$pfct_code,
				'TRAN_CODE'     =>$trans_code,
				'SERIES_CODE'   =>$series_code,
				'VRNO'          =>$NewVrno,
				'SLNO'          =>$slno,
				'ACC_CODE'      =>$custCode[$i],
				'ACC_NAME'      =>$custName[$i],
				'DO_NO'         =>$do_no[$i],
				'DO_DATE'       =>$delorder_date,
				'FSO_REF_NO'    =>$refNo,
				'ITEM_CODE'     =>$item_code[$i],
				'ITEM_NAME'     =>$item_name[$i],
				'ALIAS_ITEM_CODE'     =>$alise_item_code[$i],
				'ALIAS_ITEM_NAME'     =>$alise_item_name[$i],
				'REMARK'        =>$remark[$i],
				'CP_CODE'       =>$consignee_code[$i],
				'CP_NAME'       =>$consignee_name[$i],
				'CP_ADDRESS'    =>$consineeAdd[$i],
				'REGION'        =>$region[$i],
				'ACATG_CODE'    =>$acatgory_code[$i],
				'RCOMP_CODE'    =>$rcomp_code[$i],
				'RCOMP_NAME'    =>$rcomp_name[$i],
				'SP_CODE'       =>$sp_code[$i],
				'SP_NAME'       =>$sp_name[$i],
				'FROM_PLACE'    =>$from_place,
				'TO_PLACE'      =>$to_place[$i],
				'EBILL_NO'      =>$ewaybill_no[$i],
				'EWAYB_VALIDDT' =>$ewaybill_date,
				'QTY'           =>$qty[$i],
				'UM'            =>$unit_M[$i],
				'AQTY'          =>$Aqty,
				'AUM'           =>$unit_AUM[$i],
				'INVC_NO'       =>$Invc_no[$i],
				'INVC_DATE'     =>$invoice_date,
				'WAGON_NO'      =>$wagon_no[$i],
				'DELIVERY_NO'   =>$DeliveryNo,
				'GROSS_WEIGHT'  =>$GrossWt,
				'DOHEADID'      =>$do_headId[$i],
				'DOBODYID'      =>$do_bodyId[$i],
				'BATCH_NO'      =>$do_batch_no[$i],
				'CREATED_BY'    =>$createdBy,

		    );
	
	    	$saveData1 = DB::table('TRIP_BODY')->insert($data_body);



	    
	    /*$getDoDetials =	DB::table('DORDER_BODY')->where('DORDERHID',$do_headId[$i])->where('DORDERBID',$do_bodyId[$i])->where('ITEM_CODE',$item_code[$i])->where('SLNO',$item_slno[$i])->where('DORDER_NO',$do_no[$i])->get()->first();*/
	    $getDoDetials =	DB::table('DORDER_BODY')->where('DORDERHID',$do_headId[$i])->where('DORDERBID',$do_bodyId[$i])->get()->first();
			
			//print_r($getDoDetials->DISPATCH_PLAN_QTY);
		    if($getDoDetials){

		    	 $dispacth_plan_qty = $getDoDetials->DISPATCH_PLAN_QTY;

				$dataupdate = array(

					'DISPATCH_PLAN_QTY'  => floatval($dispacth_plan_qty) + floatval($qty[$i]),
				
				);


			/*$saveData11 = DB::table('DORDER_BODY')->where('DORDERHID',$do_headId[$i])->where('DORDERBID',$do_bodyId[$i])->where('ITEM_CODE',$item_code[$i])->where('SLNO',$item_slno[$i])->where('DORDER_NO',$do_no[$i])->update($dataupdate);*/
			DB::table('DORDER_BODY')->where('DORDERHID',$do_headId[$i])->where('DORDERBID',$do_bodyId[$i])->update($dataupdate);

		    }
	   

		}

		

		$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->toArray();
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

		
			
		

		/*if($saveData1){
			$response_array['response'] = 'success';
		    $data = json_encode($response_array);
		    print_r($data);

		}else{

			$response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);

		}*/


			DB::commit();

	       $response_array['response'] = 'success';

	       if($donwloadStatus == 1){

					return $this->GeneratePdfForLoadingSlip($getcompcode,$fisYear,$plant_code,$NewVrno,$createdBy,$headId);

				}else{

				}
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
		   
			
	
		    //throw $e;
	

    }
    

    public function GeneratePdfForLoadingSlip($comp_code,$fisYear,$plant_code,$NewVrno,$userId,$hid){

		$titleName = 'LOADING SLIP';


		$response_array = array();

		$dataheadB = DB::SELECT("SELECT H.VEHICLE_NO AS VEHICLE_NO,H.FY_CODE AS FY_CODE,H.TO_PLACE AS TO_PLACE,H.SERIES_CODE AS SERIES_CODE,H.VRNO AS VRNO,B.DO_NO AS DO_NO,B.WAGON_NO AS WAGON_NO,B.BATCH_NO AS BATCH_NO,B.ITEM_CODE AS ITEM_CODE,B.ITEM_NAME AS ITEM_NAME,B.REMARK AS ITEM_REMARK,B.QTY AS QTY,B.UM AS UM,B.AQTY AS AQTY,B.AUM AS AUM,B.CP_NAME,B.CP_CODE AS CP_CODE,B.RCOMP_NAME AS RCOMP_NAME,B.VRDATE AS VRDATE,B.RAKE_NO AS RAKE_NO,B.ALIAS_ITEM_CODE FROM TRIP_HEAD H,TRIP_BODY B WHERE H.TRIPHID= B.TRIPHID AND H.COMP_CODE='$comp_code' AND H.TRIPHID='$hid'");

		$compDetail = DB::SELECT("SELECT A.*,B.COMP_NAME,B.COMP_CODE,B.LOGO FROM `MASTER_PLANT` A,MASTER_COMP B WHERE A.COMP_CODE=B.COMP_CODE AND B.COMP_CODE='$comp_code' AND A.PLANT_CODE='$plant_code'");

		header('Content-Type: application/pdf');

		$pdf = PDF::loadView('admin.finance.transaction.candf.tripPlanloadingSlipPDF',compact('compDetail','dataheadB','titleName'));
		
		$path        = public_path('dist/TripPdf'); 
		$fileName    =  time().'.'. 'pdf' ;
		$pdf->save($path . '/' . $fileName);
		$PublicPath  = url('public/dist/TripPdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url']      = $downloadPdf;
		$response_array['data']     = $dataheadB;
		echo $data = json_encode($response_array);

		// $pdf = PDF::loadView('admin.finance.transaction.candf.tripPlanloadingSlipPDF'));

	}
   

    public function VehiclePlaningView(Request $request){

    	if($request->ajax()) {
			$title    = 'View Vehical Planning';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');

			$getcompcode = explode('-', $compName);
			
	   	$comp_code   =$getcompcode[0];
			
			$fisYear  =  $request->session()->get('macc_year');

  			$data = DB::table('TRIP_HEAD')->where('COMP_CODE',$comp_code)->where('PLAN_STATUS','1')->orderBy('TRIPHID','DESC');

			//return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

			// $data = DB::select("SELECT t1.*,t2.* FROM TRIP_HEAD t1,TRIP_BODY t2 WHERE t2.TRIPHID=t1.TRIPHID AND t1.COMP_CODE='SA' GROUP BY t2.TRIPHID ORDER BY t1.TRIPHID DESC");

        	return DataTables()->of($data)->addIndexColumn()->make(true);

		}
    	return view('admin.finance.transaction.logistic.view_vehicle_paln');

    }



    public function ViewChildVehiclePlan(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	  $vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$trip_plan = DB::select("SELECT t2.ACC_CODE,t2.ACC_NAME,t2.CP_CODE,t2.CP_NAME,t1.VRDATE,t1.FY_CODE,t1.SERIES_CODE,t1.VRNO,t1.OWNER,t1.FROM_PLACE,t1.TO_PLACE,t1.VEHICLE_NO,t1.SLR_FLAG,t1.SLR_STATUS FROM TRIP_HEAD t1,TRIP_BODY t2 WHERE t2.TRIPHID=t1.TRIPHID AND (t1.SLR_FLAG='0' AND t1.SLR_STATUS='1') AND t2.TRIPHID='$headid' GROUP BY t2.TRIPHID ORDER BY t1.TRIPHID DESC");
	       //echo "<PRE>";
	       //print_r($trip_plan);exit;

    		if($trip_plan) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $trip_plan;
	         

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


    public function vehilce_Plan_msg(Request $request,$saveData){

		if ($saveData==true) {

			$request->session()->flash('alert-success', 'Vehicle Plan Was Successfully Added...!');
			return redirect('/view-vehicle-planing-mast');

		}else{

			$request->session()->flash('alert-error', 'Vehicle Plan Can Not Added...!');
			return redirect('/view-vehicle-planing-mast');

		}
	}



	public function VehicalInfo(Request $request){

    	$vehicle_no = $request->input('truck_no');

        $token = $request->session()->get('api_token');

    	$authorization = "Authorization: Bearer ".$token;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
    
		curl_setopt($curl, CURLOPT_URL, "https://ulip.logilocker.in/logilocker/api/vahan?vehicleNo=".$vehicle_no."&gstin=''&forceUpdate=true");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		curl_close($curl);
		$data1 = json_decode($result, true);
		// echo '<PRE>';print_r($data1['response']['vehicleNo']);echo '</PRE>';

    	$response_array = array();

    	if($vehicle_no){

    		$response_array['response'] = 'success';
    		$response_array['data'] = $data1['response'];
    		$data = json_encode($response_array);

            print_r($data);


    	}else{

    		$response_array['response'] = 'error';
    		$response_array['data'] = '';
    		$data = json_encode($response_array);

            print_r($data);

    	}

    }


    public function EditVehiclePlaning(Request $request,$headid){

		$title       = 'Edit Master Vehicle Plan';

		$head_id     = base64_decode($headid);

		$compDetails = $request->session()->get('company_name');
		$splitcomp   = explode('-', $compDetails);
		$comp_code   = $splitcomp[0];
		$fisYear     =  $request->session()->get('macc_year');

    	if($head_id!=''){
    	    $query = DB::table('TRIP_HEAD');
			$query->where('TRIPHID', $head_id);
			$userData['tripPlanningData']= $query->get()->first();

			$userData['tripPlanbodyData'] = DB::select("SELECT * FROM TRIP_BODY WHERE TRIPHID='$head_id'");
			
			$userData['vehicle_list']    = DB::table('MASTER_FLEET')->get();

			$userData['transport_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();

			$userData['freightType_list'] = DB::table('MASTER_FREIGHTTYPE')->get();
            $userData['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

			//$button='Update';
	    	//$action='Vehicle-Planing-Update';
			return view('admin.finance.transaction.logistic.edit_trip_planning',$userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Fleet Not Found...!');
			return redirect('/view-mast-fleet');
		}
    }

    public function tripPlanningUpdate(Request $request){


		$createdBy    = $request->session()->get('userid');
		$compName     = $request->session()->get('company_name');
		$compcode     = explode('-', $compName);
		$getcompcode  =	$compcode[0];
		$fisYear      =  $request->session()->get('macc_year');
		$headid       = $request->input('updateId');
		$vrdate       = $request->input('vr_date');
		$vr_date      = date('Y-m-d',strtotime($vrdate));

		$data = array(
			
			"VRDATE"         => $vr_date,
			"VEHICLE_NO"     => $request->input('vehicle_no'),
			"OWNER"          => $request->input('vehicle_owner'),
			"VEHICLE_TYPE"   => $request->input('vehicle_type'),
			"VEHICLE_TYPE_NAME"   => $request->input('vehicleType_name'),
            "WHEELTYPE_CODE" => $request->input('whee_type_code'),
            "WHEELTYPE_NAME" => $request->input('whee_type_name'),
             "MIN_GUARANTEE" => $request->input('min_gurrentee'),
			"TRANSPORT_CODE" => $request->input('transporter_code'),
			"TRANSPORT_NAME" => $request->input('transporter_name'),
			"FPO_NO"         => $request->input('fright_order'),
			"FREIGHT_QTY"    => $request->input('freight_qty'),
			"FPO_RATE"       => $request->input('rate'),
			"AMOUNT"         => $request->input('amount'),
			"PAYMENT_MODE"   => $request->input('payment_mode'),
			"ADV_TYPE"       => $request->input('adv_type'),
			"ADV_RATE"       => $request->input('adv_rate'),
			"ADV_AMT"        => $request->input('adv_amount'),
			"MODEL"          => $request->input('vehicle_model'),
			"LAST_UPDATE_BY" => $createdBy,

		);
     
        $saveData = DB::table('TRIP_HEAD')->where('TRIPHID',$headid)->update($data);

		$discriptn_page = "Master vehicle planing done by user";
		// $this->userLogInsert($createdBy,$discriptn_page);

		if($saveData){

			$response_array['response'] = 'success';
			$data = json_encode($response_array);
			print_r($data);

		}else{

			$response_array['response'] = 'error';
	        $data = json_encode($response_array);
	        print_r($data);

		}
    }

    public function tripPlanUpdateMsg(Request $request,$saveData){

		if ($saveData==true) {

			$request->session()->flash('alert-success', 'Trip Plan Was Successfully Updated...!');
			return redirect('/view-vehicle-planing-mast');

		}else{

			$request->session()->flash('alert-error', 'Trip Plan Can Not Updated...!');
			return redirect('/view-vehicle-planing-mast');

		}
	}


     public function DeleteVehiclePlaning(Request $request){

    	$id = $request->post('FleetID');
    	//print_r($destinationId);exit;

    	if ($id!='') {
    		
    		

    		$depot = DB::table('master_fleet')->where('id',$id)->get()->first();


        	$depot_code = DB::table('master_fleet')->where('location',$depot->location)->get()->toArray();

        
        	
        	$count =count($depot_code);

        	if($count >1){
        		$Delete = DB::table('master_fleet')->where('id', $id)->delete();

        	}else{
        		$Delete = DB::table('master_fleet')->where('id', $id)->delete();

        		$data=array(

        			'fleet_mast'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$depot->location)->update($data);
        	
        	}

			if ($Delete) {

				$request->session()->flash('alert-success', ' Fleet Was Deleted Successfully...!');
				return redirect('/view-mast-fleet');

			} else {

				$request->session()->flash('alert-error', 'Fleet Can Not Deleted...!');
				return redirect('/view-mast-fleet');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Fleet Not Found...!');
			return redirect('/view-mast-fleet');

    	}
    }



     public function updateSaleBillProc(Request $request){

    $response_array = array();

    if ($request->ajax()) {


      $createdBy    = $request->session()->get('userid');
			
	  $compName     = $request->session()->get('company_name');
			
	  $compcode     = explode('-', $compName);
			
	  $comp_code  =	$compcode[0];
			
	  $fisYear      =  $request->session()->get('macc_year');

     
      $delivery_no = $request->input('delivery_no');
      $temp_id     = $request->input('temp_id');
      

      $getData =  DB::table('TEMP_DELIVERY_ORDER')->where('ID',$temp_id)->where('COL2',$delivery_no)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->get()->first();

     //print_r($getData);exit;

      if($getData){

      	$transaction_no = $getData->COL1;
      	$delivery_no = $getData->COL2;
      	$calculate_freight_amt = $getData->COL4;
      	$calculate_bonus_amt = $getData->COL6;
      	$calculate_penalty_amt = $getData->COL8;
      	$calculate_bill_amt = $getData->COL10;
      	$current_status = $getData->COL25;
      	$upload_date = $getData->COL26;
      	$posting_date = $getData->COL27;

      	$uploadDate = date('Y-m-d',strtotime($upload_date));
      	$postingDate = date('Y-m-d',strtotime($posting_date));

      	$salebill_data = DB::table('SBILL_BODY_PROV')
				->select('SBILL_BODY_PROV.*', 'SBILL_HEAD_PROV.PSBILLHID as headId')
           		->leftjoin('SBILL_HEAD_PROV', 'SBILL_HEAD_PROV.PSBILLHID', '=', 'SBILL_BODY_PROV.PSBILLHID')
           		->where('SBILL_BODY_PROV.DELIVERY_NO',$delivery_no)
           		->get()->first();

          $saleheadId =  $salebill_data->headId;
     


        $data = array(

	     'TRANSACTION_NO'   =>$transaction_no,
		 'DELIVERY_NO'	    =>$delivery_no,
		 'CAL_FRGHT_VALUE'	=>$calculate_freight_amt,
		 'CAL_BONUS_AMT'	=>$calculate_bonus_amt,
		 'CAL_PENALTY_AMT'	=>$calculate_penalty_amt,
		 'CAL_BILL_AMT'	    =>$calculate_bill_amt,
		 'CURRENT_STATUS'	=>$current_status,
		 'UPLOAD_DATE'	    =>$uploadDate,
		 'POSTING_DATE'  	=>$postingDate,
        );
    
       $updateData =  DB::table('SBILL_HEAD_PROV')->where('PSBILLHID',$saleheadId)->update($data);

   }else{

     	 $response_array['response'] = 'error';
         $data = json_encode($response_array);

          print_r($data);

   }


     if($updateData) {

          $response_array['response'] = 'success';
       
          echo $data = json_encode($response_array);

      }else{

        $response_array['response'] = 'error';
        $data = json_encode($response_array);

          print_r($data);
        
      }

      }else{

          $response_array['response'] = 'error';
     
          $data = json_encode($response_array);

         print_r($data);
      }

    }

     public function updateItemCodeDeliveryOrder(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			 $createdBy    = $request->session()->get('userid');
			
			  $compName     = $request->session()->get('company_name');
					
			  $compcode     = explode('-', $compName);
					
			  $comp_code  =	$compcode[0];
					
			  $fisYear      =  $request->session()->get('macc_year');

			$itemCode = $request->input('itemCode');
			$tableId  = $request->input('temptableid');
			$itemName = $request->input('itemName');
			$tblcol   = $request->input('tblcol');
			$tblcol2   = $request->input('tblcol2');
			$itemAliseCode = $request->input('itemAliseCode');
			$itemAliseName = $request->input('itemAliseName');



			$getItemName = DB::select("SELECT TEMP_DELIVERY_ORDER.$tblcol2 FROM TEMP_DELIVERY_ORDER WHERE $tblcol2 LIKE CONCAT('%',SUBSTRING_INDEX('$itemAliseName',' ',IF(LENGTH(SUBSTRING_INDEX('$itemAliseName',' ',1))<=2,2,1)),'%') AND ITEM_STATUS='YES'");

		 
	
			$getItemName1 = json_decode(json_encode($getItemName), true);

			$count = count($getItemName1);

            


		//print_r($getItemName1);exit;

			$updateDate=array();
		
		   for($i=0;$i < $count; $i++){

		   		$data = array(

				'ITEM_STATUS' => 'NO',
				 $tblcol     => $itemAliseCode.'~'.$itemName.'~'.$itemCode,
				 
	    		);

		   	//print_r($data);exit;

		   //	DB::enableQueryLog();
		     $updateDate[] =  DB::table('TEMP_DELIVERY_ORDER')->where($tblcol2,$getItemName1[$i])->update($data);


		   // dd(DB::getQueryLog());
		   }

		  //  print_r($updateDate);exit;


		   //exit;
	    	
		//DB::enableQueryLog();

	    
	  		

	  		
	  		//print_r($getItemName);exit;

	    	
		//dd(DB::getQueryLog());


	    /*DB::enableQueryLog();
		$update
	   $getItemName = DB::select("SELECT TEMP_DELIVERY_ORDER.$tblcol2 FROM TEMP_DELIVERY_ORDER WHERE $tblcol2 LIKE CONCAT('%',SUBSTRING_INDEX('$itemAliseName',' ',IF(LENGTH(SUBSTRING_INDEX('$itemAliseName',' ',1))<=2,2,1)),'%')");
	   dd(DB::getQueryLog());*/
	   	/* $icond = "LIKE CONCAT('%',SUBSTRING_INDEX('$itemAliseName',' ',IF(LENGTH(SUBSTRING_INDEX('$itemAliseName',' ',1))<=2,2,1)),'%')";
	     $updateDate =  DB::table('TEMP_DELIVERY_ORDER')->where($tblcol2,$icond)->update($data);*/


	      /*$TempData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE  ( COMP_CODE='$getcompcode' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy')  AND (ITEM_STATUS ='YES' OR  ACC_STATUS='YES') ");*/

	      /*  $TempData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE  ( COMP_CODE='$getcompcode' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy')  AND ((ITEM_STATUS ='YES' AND DO_EXIST_STATUS='NO') OR  (ACC_STATUS='YES' AND DO_EXIST_STATUS='NO'))");
*/

	       $NewData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='NO' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

	       $AllocQtyData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

	       $itemaccData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE  ( COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy')  AND ((ITEM_STATUS ='YES' AND DO_EXIST_STATUS ='NO') OR  (ACC_STATUS='YES' AND DO_EXIST_STATUS ='NO'))");


		    $new_data_count = count($NewData);

		    $itemacc_count = count($itemaccData);

		    $allocqty_count = count($AllocQtyData);
	       
	       

    		if($updateDate) {

    			$response_array['response'] = 'success';
    			$response_array['new_data_count'] = $new_data_count;
    			$response_array['itemacc_count'] = $itemacc_count;
    			$response_array['allocqty_count'] = $allocqty_count;
	           // $response_array['data'] = $delivery_order;
	          
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
				$response_array['new_data_count'] = '';
    			$response_array['itemacc_count'] = '';
    			$response_array['allocqty_count'] = '';
                //$response_array['data'] = '' ;
               // $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['new_data_count'] = '';
    			$response_array['itemacc_count'] = '';
    			$response_array['allocqty_count'] = '';
                $data = json_encode($response_array);

                print_r($data);
	    }

    }



    public function updateItemCodeRake(Request $request){

    $response_array = array();

    if ($request->ajax()) {


      $createdBy    = $request->session()->get('userid');
			
	  $compName     = $request->session()->get('company_name');
			
	  $compcode     = explode('-', $compName);
			
	  $comp_code  =	$compcode[0];
			
	  $fisYear      =  $request->session()->get('macc_year');

      $itemCode = $request->input('itemCode');
      $tableId  = $request->input('temptableid');
      $itemName = $request->input('itemName');
      $itemAliseName = $request->input('itemAliseName');
      $tblcol   = $request->input('tblcol');
      //$tblcol2   = $request->input('tblcol2');



        $data = array(

        'ITEM_STATUS' => 'NO',
         $tblcol     => $itemAliseName.'~'.$itemName.'~'.$itemCode,
        // $tblcol2     => $itemName,
        );
    

       $updateDate =  DB::table('TEMP_DELIVERY_ORDER')->where($tblcol,$itemAliseName)->update($data);


       


        $NewData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='NO' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

	     $AllocQtyData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

	    $itemaccData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE  ( COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy')  AND ((ITEM_STATUS ='YES' AND DO_EXIST_STATUS ='NO') OR  (ACC_STATUS='YES' AND DO_EXIST_STATUS ='NO') OR (SP_STATUS='YES' AND DO_EXIST_STATUS ='NO'))");


			   $new_data_count = count($NewData);

		       $itemacc_count = count($itemaccData);

		       $allocqty_count = count($AllocQtyData);

        if($updateDate) {

          $response_array['response'] = 'success';
          $response_array['new_data_count'] = $new_data_count;
    	  $response_array['itemacc_count'] = $itemacc_count;
    	  $response_array['allocqty_count'] = $allocqty_count;
             // $response_array['data'] = $delivery_order;
            
           

             echo $data = json_encode($response_array);

      }else{

        $response_array['response'] = 'error';
        $response_array['new_data_count'] = '';
    	$response_array['itemacc_count'] = '';
    	$response_array['allocqty_count'] = '';
                //$response_array['data'] = '' ;
               // $response_array['count'] = '';

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


    public function updateAccCodeDeliveryOrder(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			$createdBy    = $request->session()->get('userid');
			
			$compName     = $request->session()->get('company_name');
			
			$compcode     = explode('-', $compName);
			
			$comp_code  =	$compcode[0];
			
			$fisYear      =  $request->session()->get('macc_year');

			$accCode      = $request->input('accCode');
			$tableId      = $request->input('temptableid');
			$accAliseName = $request->input('accAliseName');
			$accAliseCode = $request->input('accAliseCode');
			$accName      = $request->input('accName');
			$accCatCode      = $request->input('accCatCode');
			$tblcol       = $request->input('tblcol');

			


			if($tblcol=='COL3'){

				$status = 'SP_STATUS';

			}else{

				$status = 'ACC_STATUS';

			}

	    	$data = array(

				$status => 'NO',
				$tblcol      => $accName.'~'.$accCode.'~'.$accCatCode,
	    	);
			

	       $updateDate =  DB::table('TEMP_DELIVERY_ORDER')->where($tblcol, $accAliseName)->update($data);
			//print_r($tblcol);exit();

			//enableQueryLog();
			//


	         //DB::enableQueryLog();


			//dd(DB::getQueryLog());
	     

	       	$data1 = array(

				'ALIAS_NAME' => $accAliseName,
				'SAP_CODE'   => $accAliseCode,
	    	);
		
	       $updateDate1 =  DB::table('MASTER_ACC')->where('ACC_CODE', $accCode)->update($data1);

	      
	       $NewData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='NO' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

	       $AllocQtyData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

	       $itemaccData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE  (COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy')  AND ((ITEM_STATUS ='YES' AND DO_EXIST_STATUS ='NO') OR  (ACC_STATUS='YES' AND DO_EXIST_STATUS ='NO'))");

	       $new_data_count = count($NewData);

	       $itemacc_count = count($itemaccData);

	       $allocqty_count = count($AllocQtyData);
            

    		if($updateDate) {

    			$response_array['response'] = 'success';
    			$response_array['new_data_count'] = $new_data_count;
    			$response_array['itemacc_count'] = $itemacc_count;
    			$response_array['allocqty_count'] = $allocqty_count;
	           // $response_array['data'] = $delivery_order;
	          
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
				$response_array['new_data_count'] = '';
    			$response_array['itemacc_count'] = '';
    			$response_array['allocqty_count'] = '';
                //$response_array['data'] = '' ;
               // $response_array['count'] = '';

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



    public function updateAccCodeDeliveryOrderForRake(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			$createdBy    = $request->session()->get('userid');
			
			$compName     = $request->session()->get('company_name');
			
			$compcode     = explode('-', $compName);
			
			$comp_code  =	$compcode[0];
			
			$fisYear      =  $request->session()->get('macc_year');

			$accCode      = $request->input('accCode');
			$tableId      = $request->input('temptableid');
			$accAliseName = $request->input('accAliseName');
			$accName      = $request->input('accName');
			$tblcol       = $request->input('tblcol');

			


			if($tblcol=='COL3'){

				$status = 'SP_STATUS';

			}else{

				$status = 'ACC_STATUS';

			}

	    	$data = array(

				$status => 'NO',
				$tblcol      => $accName.'~'.$accCode,
	    	);
			

	       $updateDate =  DB::table('TEMP_DELIVERY_ORDER')->where($tblcol, $accAliseName)->update($data);
			//print_r($tblcol);exit();

			//enableQueryLog();
			//


	         //DB::enableQueryLog();


			//dd(DB::getQueryLog());
	     

	       	$data1 = array(

				'ALIAS_NAME' => $accAliseName,
	    	);
		
	       $updateDate1 =  DB::table('MASTER_ACC')->where('ACC_CODE', $accCode)->update($data1);

	      
	       $NewData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='NO' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

	       $AllocQtyData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

	       $itemaccData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE  ( COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy')  AND ((ITEM_STATUS ='YES' AND DO_EXIST_STATUS ='NO') OR  (ACC_STATUS='YES' AND DO_EXIST_STATUS ='NO') OR (SP_STATUS='YES' AND DO_EXIST_STATUS ='NO'))");

	       $new_data_count = count($NewData);

	       $itemacc_count = count($itemaccData);

	       $allocqty_count = count($AllocQtyData);
            

    		if($updateDate) {

    			$response_array['response'] = 'success';
    			$response_array['new_data_count'] = $new_data_count;
    			$response_array['itemacc_count'] = $itemacc_count;
    			$response_array['allocqty_count'] = $allocqty_count;
	           // $response_array['data'] = $delivery_order;
	          
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
				$response_array['new_data_count'] = '';
    			$response_array['itemacc_count'] = '';
    			$response_array['allocqty_count'] = '';
                //$response_array['data'] = '' ;
               // $response_array['count'] = '';

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


     public function updateAccCodebulkLorry(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			$createdBy    = $request->session()->get('userid');
			
			$compName     = $request->session()->get('company_name');
			
			$compcode     = explode('-', $compName);
			
			$comp_code  =	$compcode[0];
			
			$fisYear      =  $request->session()->get('macc_year');

			$accCode      = $request->input('accCode');
			$tableId      = $request->input('temptableid');
			$accAliseName = $request->input('accAliseName');
			$accAliseCode = $request->input('accAliseCode');
			$accName      = $request->input('accName');
			$accCatCode      = $request->input('accCatCode');
			$tblcol       = $request->input('tblcol');

			//print_r($tblcol);exit;

			/*echo '<pre>';
			print_r($accCode);
			echo '<pre>';
			print_r($tableId);
			echo '<pre>';
			print_r($accAliseName);
			echo '<pre>';
			print_r($accAliseCode);
			echo '<pre>';
			print_r($accName);
			echo '<pre>';
			print_r($tblcol);
			echo '</pre>';

			exit;*/

		    $status = 'ACC_STATUS';


	    	$data = array(

				$status => 'NO',
				$tblcol      => $accName.'~'.$accCode,
	    	);
			

	       $updateDate =  DB::table('TEMP_DELIVERY_ORDER')->where($tblcol, $accAliseName)->update($data);
			//print_r($tblcol);exit();

			//enableQueryLog();
			//


	         //DB::enableQueryLog();


			//dd(DB::getQueryLog());
	     

	       	$data1 = array(

				'ALIAS_NAME' => $accAliseName,
				'SAP_CODE'   => $accAliseCode,
	    	);
		
	       $updateDate1 =  DB::table('MASTER_ACC')->where('ACC_CODE', $accCode)->update($data1);

	      
	       

	       $NewData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_NUMBER ='NO' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

		   $CityDoData = DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE CITY_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

		     $AccData = DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE ACC_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

	                $new_data_count = count($NewData);

                    $city_do_count = count($CityDoData);

                    $acc_count = count($AccData);


			       	if($updateDate) {

			    			$response_array['response'] = 'success';
			    			$response_array['new_data_count'] = $new_data_count;
			    			$response_array['city_do_count'] = $city_do_count;
			    			$response_array['acc_count'] = $acc_count;
			    		
				            echo $data = json_encode($response_array);
				         
						}else{

							$response_array['response'] = 'error';
							$response_array['new_data_count'] = '';
							$response_array['city_do_count'] ='';
							$response_array['acc_count'] = '';
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

    public function updateAccCodeDeliveryOrder1(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			$createdBy    = $request->session()->get('userid');
			
			$compName     = $request->session()->get('company_name');
			
			$compcode     = explode('-', $compName);
			
			$getcompcode  =	$compcode[0];
			
			$fisYear      =  $request->session()->get('macc_year');

			$accCode      = $request->input('accCode');
			$tableId      = $request->input('temptableid');
			$accAliseName = $request->input('accAliseName');
			$accName      = $request->input('accName');
			$tblcol       = $request->input('tblcol');

		//	print_r($tblcol);exit;
			if($tblcol=='COL3'){

				$status = 'SP_STATUS';

			}else{

				$status = 'ACC_STATUS';

			}

	    	$data = array(

				$status => 'NO',
				$tblcol      => $accName.'~'.$accCode,
	    	);
		

	       $updateDate =  DB::table('TEMP_DELIVERY_ORDER')->where($tblcol, $accAliseName)->update($data);

	     

	       	$data1 = array(

				'ALIAS_NAME' => $accAliseName,
	    	);
		
	       $updateDate1 =  DB::table('MASTER_ACC')->where('ACC_CODE', $accCode)->update($data1);

	      
	       $TempData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE  ( COMP_CODE='$getcompcode' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy')  AND (ITEM_STATUS ='YES' OR  ACC_STATUS='YES') ");
	       
	        $temp_data_count = count($TempData);
            

    		if($updateDate) {

    			$response_array['response'] = 'success';
    			$response_array['data_count'] = $temp_data_count;
	           // $response_array['data'] = $delivery_order;
	          
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                //$response_array['data'] = '' ;
               // $response_array['count'] = '';

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



    public function getDeliveryOrderDetaisl(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$OrderNo   = $request->input('do_no');
		 
	    	

	    	$delivery_order = DB::table('DORDER_BODY')->where('DORDER_NO', $OrderNo)->get()->toArray();
	    	
	    	$from_place = $delivery_order[0]->FROM_PLACE;

	    	//$trip_days = DB::table('MASTER_FREIGHT_ROUTE')->where('FROM_PLACE',$from_place)->get()->first();
	    	//print_r($trip_days);exit;

    		if($delivery_order) {

    		 $response_array['response'] = 'success';
	         $response_array['data'] = $delivery_order;
	         //$response_array['data_trip'] = $trip_days;
	          
	         

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


    


    public function getFsoRate(Request $request){


        $response_array = array();

		if ($request->ajax()) {
				$compName     = $request->session()->get('company_name');
			    $compcode     = explode('-', $compName);
			    $getcompcode  =	$compcode[0];
				$vehicle_no = $request->input('vehicle_no');
				$vr_date    = $request->input('vr_date');
				$vrdate  = date('Y-m-d',strtotime($vr_date));
				$vehicle_type     = $request->input('vehicle_type');
				$account_code     = $request->input('account_code');
				$plant_code       = $request->input('plant_code');
				$toplace          = $request->input('toplace');
				$vehicle_owner    = $request->input('vehicle_owner');
			//$from_place    = $request->input('from_place');
			

	    	//DB::enableQueryLog();

			if($vehicle_owner=='SELF'){

				$vehicle_details = DB::select("SELECT * FROM MASTER_FLEET  WHERE  TRUCK_NO='$vehicle_no' AND FREIGHTTYPE_NAME='$vehicle_type'");
			}else{

				$vehicle_details = DB::select("SELECT * FROM MASTER_FLEETTRUCK_WHEEL  WHERE  FREIGHTTYPE_NAME='$vehicle_type'");
			}
              

		

		//print_r($vehicle_details);exit;

	    	$fso_data = DB::select("SELECT FSO_BODY.*,FSO_HEAD.REF_NO FROM FSO_BODY LEFT JOIN FSO_HEAD ON FSO_HEAD.FSOHID = FSO_BODY.FSOHID WHERE FSO_BODY.COMP_CODE='$getcompcode' AND FSO_BODY.ACC_CODE='$account_code' AND FSO_BODY.VEHICLE_TYPE='$vehicle_type' AND '$vrdate' BETWEEN FSO_BODY.VALID_FROM_DATE AND FSO_BODY.VALID_TO_DATE AND FSO_BODY.PLANT_CODE='$plant_code' AND FSO_BODY.TO_PLACE LIKE '%$toplace%'");

	    	/*SELECT B.COMP_CODE,B.ACC_CODE,B.FROM_PLACE,B.TO_PLACE, B.VEHICLE_TYPE,B.VALID_FROM_DATE,B.VALID_TO_DATE,B.RATE FROM FSO_BODY B WHERE B.COMP_CODE='SA' AND B.VEHICLE_TYPE='CATB' AND B.FROM_PLACE='NAGPUR' AND B.TO_PLACE LIKE '%PUNE%' AND '2023-03-24' BETWEEN B.VALID_FROM_DATE AND B.VALID_TO_DATE;*/

	      

	       //print_r($fso_data);exit;

	       if($fso_data){

	    		$fso_rate = $fso_data;
	    	}else{

	    		$fso_rate = 0.00;
	    	}


    		if($fso_data || $vehicle_details){

    		 $response_array['response'] = 'success';
	         $response_array['data'] = $fso_data;
	         $response_array['vehicle_data'] = $vehicle_details;
	        
	         echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['vehicle_data'] ='';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['vehicle_data'] ='';
            
                $data = json_encode($response_array);

                print_r($data);
	    }



    }


     public function getVehicleOwner(Request $request){



		$response_array = array();

		if ($request->ajax()) {

				$vehicle_no = $request->input('vehicle_no');
				$vr_date    = $request->input('vr_date');

				$vrdate  = date('Y-m-d',strtotime($vr_date));


				$account_code    = $request->input('account_code');
				$plant_code    = $request->input('plant_code');
				$comp_code    = $request->input('comp_code');
				$account_code    = $request->input('account_code');
				$from_place = $request->input('from_place');
				$to_place   = $request->input('to_place');


				$token = $request->session()->get('api_token');

				//print_r($request->session()->get('api_token'));exit;

		    	$authorization = "Authorization: Bearer ".$token;

		        $curl = curl_init();
		        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
		    
				curl_setopt($curl, CURLOPT_URL, "https://ulip.logilocker.in/logilocker/api/vahan?vehicleNo=".$vehicle_no."&gstin=''&forceUpdate=true");
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($curl);
				curl_close($curl);
				$data1 = json_decode($result, true);

			   //print_r($data1);exit;
		 		
		 		if($data1){

		 			$vehicle_data = $data1;

		 		}else{

		 			$vehicle_data = '';

		 		}
	    		//print_r($vehicle_data);exit;

	    $LasttripDetails = DB::select("SELECT H.* FROM TRIP_HEAD H WHERE H.OWNER='MARKET' AND H.VEHICLE_NO='$vehicle_no' AND H.VRDATE = (SELECT MAX(T.VRDATE) FROM TRIP_HEAD T WHERE T.VEHICLE_NO=H.VEHICLE_NO)");

	    	//print_r($LasttripDetails);exit;

	    	$vehicle_trip = DB::table('TRIP_HEAD')->where('VEHICLE_NO', $vehicle_no)->get()->first();

	    	$vehicle_detials = DB::table('MASTER_FLEET')->where('TRUCK_NO', $vehicle_no)->get()->first();

	    	if($vehicle_detials){
	    		$vehicle_type =  $vehicle_detials->WHEEL_TYPE;
	    		$compCode =  $vehicle_detials->COMP_CODE;
	    	}else{

	    		$vehicle_type =  '';
	    		$compCode =  '';
	    	}


	   
	    	$transportr_data = DB::select("SELECT * FROM MASTER_COMP WHERE COMP_CODE='$compCode'");

	    	if($transportr_data){

	    		$transporter = $transportr_data;

	    	}else{

	    		$transporter = '';
	    	}
	    	
// dd(DB::getQueryLog());

	    	//DB::enableQueryLog();

	    	//$fso_data = DB::select("SELECT * FROM FSO_BODY WHERE ACC_CODE='$account_code' AND VEHICLE_TYPE='$vehicle_type' AND '$vrdate' BETWEEN VALID_FROM_DATE AND VALID_TO_DATE AND PLANT_CODE='$plant_code'");

	    	/*$fso_data = DB::select("SELECT FSO_BODY.*,FSO_HEAD.REF_NO FROM FSO_BODY LEFT JOIN FSO_HEAD ON FSO_HEAD.FSOHID = FSO_BODY.FSOHID WHERE FSO_BODY.COMP_CODE='$getcompcode' AND FSO_BODY.ACC_CODE='$account_code' AND FSO_BODY.VEHICLE_TYPE='$vehicle_type' AND '$vrdate' BETWEEN FSO_BODY.VALID_FROM_DATE AND FSO_BODY.VALID_TO_DATE AND FSO_BODY.PLANT_CODE='$plant_code'  AND FSO_BODY.TO_PLACE='%$toplace%'");*/

	    	//dd(DB::getQueryLog());

	       //print_r($fso_data);exit;

	      /* if($fso_data){

	    		$fso_rate = $fso_data;
	    	}else{

	    		$fso_rate = 0.00;
	    	}*/

	    	//print_r($fso_rate);exit;
	       //DB::enableQueryLog();

	    	$route_detials = DB::table('MASTER_FREIGHT_ROUTE')->where('FROM_PLACE',$from_place)->where('TO_PLACE',$to_place)->get()->first();




    		if($vehicle_detials || $route_detials) {

    		 $response_array['response'] = 'success';
	         $response_array['data'] = $vehicle_detials;
	         $response_array['route_data'] = $route_detials;
	         $response_array['vehicle_info'] = $vehicle_data;
	         $response_array['last_trip_data'] = $LasttripDetails;
	         $response_array['vehicle_trip'] = $vehicle_trip;
	         $response_array['transporter_data'] = $transporter;
	          
	         

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


     public function getVehicleOwnerForWoItem(Request $request){



		$response_array = array();

		if ($request->ajax()) {

				$vehicle_no = $request->input('vehicle_no');
				$vr_date    = $request->input('vr_date');
				$vrdate  = date('Y-m-d',strtotime($vr_date));
				$account_code    = $request->input('account_code');
				$plant_code    = $request->input('plant_code');
				$comp_code    = $request->input('comp_code');
				$account_code    = $request->input('account_code');
				$from_place = $request->input('from_place');
				$to_place   = $request->input('to_place');


				$token = $request->session()->get('api_token');

				//print_r($request->session()->get('api_token'));exit;

		    	$authorization = "Authorization: Bearer ".$token;

		        $curl = curl_init();
		        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
		    
				curl_setopt($curl, CURLOPT_URL, "https://ulip.logilocker.in/logilocker/api/vahan?vehicleNo=".$vehicle_no."&gstin=''&forceUpdate=true");
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($curl);
				curl_close($curl);
				$data1 = json_decode($result, true);

				//print_r($data1);exit;
		 		
		 		if($data1){

		 			$vehicle_data = $data1;

		 		}else{

		 			$vehicle_data = '';

		 		}
	    		//print_r($vehicle_data);exit;

	    	$LasttripDetails = DB::select("SELECT H.* FROM TRIP_HEAD H WHERE H.OWNER='MARKET' AND H.VEHICLE_NO='$vehicle_no' AND H.VRDATE = (SELECT MAX(T.VRDATE) FROM TRIP_HEAD T WHERE T.VEHICLE_NO=H.VEHICLE_NO)");

	    	$vehicle_detials = DB::table('MASTER_FLEET')->where('TRUCK_NO', $vehicle_no)->get()->first();

	    	if($vehicle_detials){
	    		$vehicle_type =  $vehicle_detials->WHEEL_TYPE;
	    		$compCode =  $vehicle_detials->COMP_CODE;
	    	}else{

	    		$vehicle_type =  '';
	    		$compCode =  '';
	    	}

	    	$scompName    = $request->session()->get('company_name');
                $explodeDatas = explode('-',$scompName);
                $scomp_Code   = $explodeDatas[0];
                $scomp_Name   = $explodeDatas[1];

	    	$transportr_data = DB::select("SELECT * FROM MASTER_COMP WHERE COMP_CODE='$scomp_Code'");

	    	if($transportr_data){

	    		$transporter = $transportr_data;

	    	}else{

	    		$transporter = '';
	    	}


	    	$vehicle_trip = DB::table('TRIP_HEAD')->where('VEHICLE_NO', $vehicle_no)->get()->first();



	    	$fso_data = DB::select("SELECT * FROM FSO_BODY WHERE ACC_CODE='$account_code' AND VEHICLE_TYPE='$vehicle_type' AND '$vrdate' BETWEEN VALID_FROM_DATE AND VALID_TO_DATE AND PLANT_CODE='$plant_code'");

	    	//dd(DB::getQueryLog());

	       //print_r($fso_data);exit;

	       if($fso_data){

	    		$fso_rate = $fso_data;
	    	}else{

	    		$fso_rate = 0.00;
	    	}


	       //DB::enableQueryLog();

	    	$route_detials = DB::table('MASTER_FREIGHT_ROUTE')->where('FROM_PLACE',$from_place)->where('TO_PLACE',$to_place)->get()->first();




    		if($vehicle_detials || $route_detials) {

    		 $response_array['response'] = 'success';
	         $response_array['data'] = $vehicle_detials;
	         $response_array['route_data'] = $route_detials;
	         $response_array['last_trip_data'] = $LasttripDetails;
	         $response_array['vehicle_info'] = $vehicle_data;
	         $response_array['vehicle_trip'] = $vehicle_trip;
	         $response_array['fso_rate'] = $fso_rate;
	         $response_array['transporter_data'] = $transporter;
	          
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
				$response_array['last_trip_data'] = '';
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



    public function getTripDetaisl(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$trip_no   = $request->input('trip_no');
	    	$vehicleno   = $request->input('vehicle_no');
	    	$tripHid     = $request->input('tripHid');
	    	//$series_code   = $request->input('series_code');

	    	if($trip_no){

	    		$explode  = explode(' ', $trip_no);	

		    	$series_code   = $explode[1];
		    	$tripno   = $explode[2];

		    	//DB::enableQueryLog();

		    	$trip_plan = DB::select("SELECT t1.*,t2.TRIPBID,t2.DO_NO,t2.DO_DATE,t2.DELORDER_DATE,t2.DELIVERY_NO,t2.ITEM_CODE,t2.ITEM_NAME,t2.REMARK,t2.QTY,t2.UM,t2.LR_NO,t2.LR_DATE,t2.INVC_NO,t2.INVC_DATE,t2.WAGON_NO,t2.MATERIAL_VAL,t2.RECD_QTY,t2.SHORTAGE_QTY,t2.EBILL_NO,t2.EWAYB_VALIDDT,t2.CP_CODE,t2.CP_NAME FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID  WHERE t2.TRIPHID='$tripHid' AND t2.VRNO='$tripno' AND t2.SERIES_CODE='$series_code' AND t1.LR_STATUS='0' AND PLAN_STATUS='1' AND GATE_IN_STATUS='1'");

		     // dd(DB::getQueryLog());
/*
		    	$trip_head = DB::table('TRIP_HEAD')->where('VRNO',$tripno)->where('SERIES_CODE',$series_code)->where('PLAN_STATUS','1')->where('GATE_IN_STATUS','1')->get()->first();*/
		 

		    	/*$vehicle_no  =  $trip_plan[0]->VEHICLE_NO;


		    	$trip_inward = DB::table('VEHICLE_GATE_INWARD')->where('VEHICLE_NO', $vehicle_no)->get()->first();*/

		    	
		    	$trip_data = 'TRIPNO';

	    	}else if($vehicleno){

	    		$trip_plan = DB::select("SELECT t1.*,t2.TRIPBID,t2.DO_NO,t2.DO_DATE,t2.DELORDER_DATE,t2.DELIVERY_NO,t2.ITEM_CODE,t2.ITEM_NAME,t2.REMARK,t2.QTY,t2.UM,t2.LR_NO,t2.LR_DATE,t2.INVC_NO,t2.INVC_DATE,t2.MATERIAL_VAL,t2.RECD_QTY,t2.SHORTAGE_QTY,t2.SERIES_CODE,t2.EBILL_NO,t2.EWAYB_VALIDDT,t2.CP_CODE,t2.CP_NAME FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID  WHERE t2.TRIPHID='$tripHid' AND t1.VEHICLE_NO='$vehicleno' AND t1.LR_STATUS='0' AND PLAN_STATUS='1' AND GATE_IN_STATUS='1'");

			    	/*$trip_head = DB::table('TRIP_HEAD')->where('VRNO', $tripno)->get()->first();
			 

			    	$vehicle_no  =  $trip_plan[0]->VEHICLE_NO;*/


			    	//$trip_inward = DB::table('VEHICLE_GATE_INWARD')->where('VEHICLE_NO', $vehicleno)->get()->first();

			    	$trip_data = 'VEHICLENO';

	    	}
		 
	    	


    		if($trip_plan || $trip_inward) {

    		 $response_array['response'] = 'success';
	         $response_array['data'] = $trip_plan;
	        // $response_array['data_inward'] = $trip_inward;
	         $response_array['trip_type'] = $trip_data;

	          
	         

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
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


     public function getTripDetaislLrAck(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$trip_no     = $request->input('trip_no');
	    	$vehicleno   = $request->input('vehicle_no');
	    	$tripHid     = $request->input('tripHid');
	    	$lrNo        = $request->input('lrNo');
	    	//$series_code   = $request->input('series_code');

	    	if($trip_no){

	    		$explode  = explode(' ', $trip_no);	

		    	$series_code   = $explode[1];
		    	$tripno   = $explode[2];

		    	//DB::enableQueryLog();

		    	$trip_plan = DB::select("SELECT t1.*,t2.TRIPBID,t2.DO_NO,t2.DO_DATE,t2.DELORDER_DATE,t2.ITEM_CODE,t2.ITEM_NAME,t2.REMARK,t2.QTY,t2.UM,t2.LR_NO,t2.LR_DATE,t2.INVC_NO,t2.DELIVERY_NO,t2.MATERIAL_VAL,t2.RECD_QTY,t2.SHORTAGE_QTY,t2.EBILL_NO,t2.EWAYB_VALIDDT,t2.NET_WEIGHT FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID  WHERE t2.TRIPHID='$tripHid' AND t2.VRNO='$tripno' AND t2.SERIES_CODE='$series_code' AND t1.LR_STATUS='1' AND t1.PLAN_STATUS='1' AND  t1.GATE_IN_STATUS='1' AND t1.EPOD_STATUS='1' AND t1.LR_ACK_STATUS='0'");

		    	$vrdate = $trip_plan[0]->VRDATE;
	    	    $lr_date = $trip_plan[0]->LR_DATE;

	    	    $GretestDate = DB::select("SELECT GREATEST('$vrdate', '$lr_date') AS DATE");
		    	
		    	$trip_data = 'TRIPNO';

	    	}else if($vehicleno){

	    		    $trip_plan = DB::select("SELECT t1.*,t2.TRIPBID,t2.DO_NO,t2.DO_DATE,t2.DELORDER_DATE,t2.ITEM_CODE,t2.ITEM_NAME,t2.REMARK,t2.QTY,t2.UM,t2.LR_NO,t2.LR_DATE,t2.INVC_NO,t2.DELIVERY_NO,t2.MATERIAL_VAL,t2.RECD_QTY,t2.SHORTAGE_QTY,t2.SERIES_CODE,t2.EBILL_NO,t2.EWAYB_VALIDDT,t2.NET_WEIGHT FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID  WHERE t2.TRIPHID='$tripHid' AND t1.VEHICLE_NO='$vehicleno' AND t1.LR_STATUS='1' AND t1.PLAN_STATUS='1' AND t1.GATE_IN_STATUS='1' AND t1.EPOD_STATUS='1' AND t1.LR_ACK_STATUS='0'");
	    		    $vrdate = $trip_plan[0]->VRDATE;
	    	        $lr_date = $trip_plan[0]->LR_DATE;

	    	         $GretestDate = DB::select("SELECT GREATEST('$vrdate', '$lr_date') AS DATE");

			    	$trip_data = 'VEHICLENO';

	    	}else if($lrNo){

	    		 $trip_plan = DB::select("SELECT t1.*,t2.TRIPBID,t2.DO_NO,t2.DO_DATE,t2.DELORDER_DATE,t2.ITEM_CODE,t2.ITEM_NAME,t2.REMARK,t2.QTY,t2.UM,t2.LR_NO,t2.LR_DATE,t2.INVC_NO,t2.DELIVERY_NO,t2.MATERIAL_VAL,t2.RECD_QTY,t2.SHORTAGE_QTY,t2.SERIES_CODE,t2.EBILL_NO,t2.EWAYB_VALIDDT,t2.NET_WEIGHT FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID  WHERE t2.TRIPHID='$tripHid' AND t2.LR_NO='$lrNo' AND t1.LR_STATUS='1' AND t1.PLAN_STATUS='1' AND t1.GATE_IN_STATUS='1' AND t1.EPOD_STATUS='1' AND t1.LR_ACK_STATUS='0'");

	    		 $vrdate = $trip_plan[0]->VRDATE;
	    	     $lr_date = $trip_plan[0]->LR_DATE;

	    	    $GretestDate = DB::select("SELECT GREATEST('$vrdate', '$lr_date') AS DATE");

			    	$trip_data = 'LR_NO';
	    	}
		 
	    	


    		if($trip_plan) {

    		 $response_array['response'] = 'success';
	         $response_array['data'] = $trip_plan;
	         $response_array['max_data'] = $GretestDate;
	      //   $response_array['data_inward'] = $trip_inward;
	         $response_array['trip_type'] = $trip_data;

	          
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['max_data'] = '';
	            $response_array['trip_type'] = '';
         

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['max_data'] = '';
	            $response_array['trip_type'] = '';
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function getTripDetaislforSupll(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$trip_no   = $request->input('trip_no');
	    	$vehicleno   = $request->input('vehicle_no');
	    	//$series_code   = $request->input('series_code');

	    	if($trip_no){

	    		$explode  = explode(' ', $trip_no);	

		    	$series_code   = $explode[1];
		    	$tripno   = $explode[2];

		    	//DB::enableQueryLog();

		    	$trip_plan = DB::select("SELECT t1.*,t2.TRIPBID,t2.DO_NO,t2.DO_DATE,t2.DELORDER_DATE,t2.ITEM_CODE,t2.ITEM_NAME,t2.REMARK,t2.QTY,t2.UM,t2.LR_NO,t2.LR_DATE,t2.INVC_NO,t2.MATERIAL_VAL,t2.RECD_QTY,t2.SHORTAGE_QTY,t2.SERIES_CODE,t2.EBILL_NO,t2.EWAYB_VALIDDT FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID  WHERE t2.VRNO='$tripno' AND t2.SERIES_CODE='$series_code'");


		     // dd(DB::getQueryLog());

		    	$trip_head = DB::table('TRIP_HEAD')->where('VRNO', $tripno)->get()->first();
		 

		    	$vehicle_no  =  $trip_plan[0]->VEHICLE_NO;


		    	$trip_inward = DB::table('VEHICLE_GATE_INWARD')->where('VEHICLE_NO', $vehicle_no)->get()->first();

		    	$trip_data = 'TRIPNO';

	    	}else if($vehicleno){

	    		$trip_plan = DB::select("SELECT t1.*,t2.TRIPBID,t2.DO_NO,t2.DO_DATE,t2.DELORDER_DATE,t2.ITEM_CODE,t2.ITEM_NAME,t2.REMARK,t2.QTY,t2.UM,t2.LR_NO,t2.LR_DATE,t2.INVC_NO,t2.MATERIAL_VAL,t2.RECD_QTY,t2.SHORTAGE_QTY,t2.SERIES_CODE FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID  WHERE t1.VEHICLE_NO='$vehicleno'");

			    	/*$trip_head = DB::table('TRIP_HEAD')->where('VRNO', $tripno)->get()->first();
			 

			    	$vehicle_no  =  $trip_plan[0]->VEHICLE_NO;*/


			    	$trip_inward = DB::table('VEHICLE_GATE_INWARD')->where('VEHICLE_NO', $vehicleno)->get()->first();

			    	$trip_data = 'VEHICLENO';

	    	}
		 
	    	


    		if($trip_plan || $trip_inward) {

    			$response_array['response'] = 'success';
	         $response_array['data'] = $trip_plan;
	         $response_array['data_inward'] = $trip_inward;
	         $response_array['trip_type'] = $trip_data;

	          
	         

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
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function getDoTripDetaisl(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$do_no   = $request->input('do_no');
		 
	    	

	    	$trip_plan = DB::table('TRIP_BODY')->where('DO_NO', $do_no)->get()->toArray();


    		if($trip_plan) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $trip_plan;
	          
	         

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
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function getEWayBillDetails(Request $request){

		$response_array = array();

		if ($request->ajax()) {
        // $ewaybillNo   = $request->input('ewaybillNo');


			$compName     = $request->session()->get('company_name');
			$compcode     = explode('-', $compName);
			$getcompcode  =	$compcode[0];

		    $Plant_code   = $request->input('Plant_code');

		    $getPlant = DB::table('MASTER_PLANT')->where('PLANT_CODE',$Plant_code)->where('COMP_CODE',$getcompcode)->get()->first();

		    $gstNo =  $getPlant->GST_NO;

		    //print_r($gstNo);exit;

	    	$title = 'E-Way bill No';

			$token  = $request->session()->get('ewaybill_token');

			$ewbvalid_data = array();

			$ewbNo = $request->ewaybillNo;
			//$ewbNo = $request->ewaybillNo;
			$gstin = $gstNo;
			//echo '<PRE>'; print_r($gstin);exit();

			//print_r($token);exit;

		    $authorization = "Authorization: Bearer ".$token;

	    	
			   if($ewbNo != ''){

			   //	print_r('ok');exit;

		    		$curl = curl_init();

			        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
			    
    					curl_setopt($curl, CURLOPT_URL, "https://api.easywaybill.in/ezewb/v1/ewb/refreshEwb?ewbNo=".$ewbNo."&gstin=".$gstin."");



    					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    					$result = curl_exec($curl);

    					curl_close($curl);

    					$data1 = json_decode($result, true);

						//print_r($data1);exit;

					if($data1){
						$response_array['response'] = 'success';
			            $response_array['data'] = $data1;

			            echo $data = json_encode($response_array);
					}else{
						$response_array['response'] = 'error';
			           $response_array['data'] = '';

			            echo $data = json_encode($response_array);
					}
				}


	    }else{

	    		  $response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function addEWBDetails(Request $request){

    	$title                       = 'Add EWB DETAILS';
		$compName                    = $request->session()->get('company_name');
		$fisYear                     = $request->session()->get('macc_year');
		$CompanyCode                 = $request->session()->get('company_name');
		$compcode                    = explode('-', $CompanyCode);
		$getcompcode                 = $compcode[0];

		return view('admin.finance.transaction.logistic.add_ewb_data',compact('title'));

    }


    public function veiwEWBDetails(Request $request){

    	if($request->ajax()){

    		$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];

			$data = DB::table('EWB_DATA')->get();

			// print_r($data);exit();

			return DataTables()->of($data)->addIndexColumn()->make(true);

    	}
    }

    public function saveEWBDetails(Request $request){

		$company_name   = $request->session()->get('company_name');
		$createdBy      = $request->session()->get('userid');
		$explodeCnm     = explode('-', $company_name);
		$compCode       = $explodeCnm[0];
		$macc_year      = $request->session()->get('macc_year');
		$ewaybill_token = $request->session()->get('ewaybill_token');

		$plantdata = DB::select("SELECT GST_NO FROM MASTER_PLANT WHERE COMP_CODE='$compCode' AND GST_NO IS NOT NULL GROUP BY COMP_CODE");

		// print_r($plantdata[0]->GST_NO);exit();

		// $gstNo  = '05AAAAT2562R1Z3';
		$gstNo  = $plantdata[0]->GST_NO;
		// $gstNo  = '27AAEFS9008E1Z8';
		// print_r($gstNo);exit;

		$authorization = "Authorization: Bearer ".$ewaybill_token;

		$ch1 = curl_init('https://api.easywaybill.in/ezewb/v1/ewb/search?gstin='.$gstNo.'');
				
		$payload1 = json_encode( array( "type" => "MY_EWB",
		 	    "page"=> '0', "size"=> 100, "defaultquery"=> null ) );

		curl_setopt( $ch1, CURLOPT_POSTFIELDS, $payload1 );

		// curl_setopt( $ch1, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch1, CURLOPT_HTTPHEADER, array(
		   'Content-Type: application/json',
		   'Authorization: Bearer ' . $ewaybill_token
		   ));
		curl_setopt( $ch1, CURLOPT_RETURNTRANSFER, true );
		
		$result1 = curl_exec($ch1);
		// print_r($result1);exit;

		curl_close($ch1);

		$ewb_data = json_decode($result1, true);

		// print_r($ewb_data['response']);exit;

		$countdata = count($ewb_data['response']);

		$currdate = date('Y/m/d');

		$save_data = 0;
		$update_data = 0;
		
		if($ewb_data != ''){

			for($i=0;$i<$countdata;$i++){

				if (array_key_exists("validUpto",$ewb_data['response'][$i])){

	                $validUpto = $ewb_data['response'][$i]['validUpto'];

				}else{
					$validUpto = '';
				}

				// check valid date and status is active

				if($validUpto !='' && $ewb_data['response'][$i]['status'] == 'ACTIVE'){

					$g_uptodate = explode(' ',$validUpto);

					$genreate_uptodate = $g_uptodate[0];
					
					$dt = explode('/',$genreate_uptodate);
					$d = $dt[0];
					$mon = $dt[1];
					$yr = $dt[2];

					$vdt = $yr.'/'.$mon.'/'.$d;
					
					if($vdt >= $currdate){
						// DB::enableQueryLog();

						$check_data = DB::table('EWB_DATA')->where('EWBID',$ewb_data['response'][$i]['ewbId'])->where('EWBNO',$ewb_data['response'][$i]['ewbNo'])->get()->first();

						// echo '<PRE>';print_r($check_data);

						// dd(DB::getQueryLog());

						// echo '<PRE>';print_r($ewb_data['response'][$i]['ewbId']);
						// echo '<PRE>';print_r($ewb_data['response'][$i]['ewbNo']);
                   
						if (array_key_exists("ewbId",$ewb_data['response'][$i])){

		                    $ewdId = $ewb_data['response'][$i]['ewbId'];

						}else{
							$ewdId = '';
						}

						if (array_key_exists("ewbNo",$ewb_data['response'][$i])){

		                    $ewbNo = $ewb_data['response'][$i]['ewbNo'];

						}else{
							$ewbNo = '';
						}

						if (array_key_exists("fromTrdName",$ewb_data['response'][$i])){

		                    $fromTrdName = $ewb_data['response'][$i]['fromTrdName'];

						}else{
							$fromTrdName = '';
						}


						if (array_key_exists("fromPlace",$ewb_data['response'][$i])){

		                    $from_place = $ewb_data['response'][$i]['fromPlace'];

						}else{
							$from_place = '';
						}

						if (array_key_exists("fromPincode",$ewb_data['response'][$i])){

		                    $frompincode = $ewb_data['response'][$i]['fromPincode'];

						}else{
							$frompincode = '';
						}
						
						if (array_key_exists("toTrdName",$ewb_data['response'][$i])){

		                    $toTrdName = $ewb_data['response'][$i]['toTrdName'];

						}else{
							$toTrdName = '';
						}

						if (array_key_exists("toPlace",$ewb_data['response'][$i])){

		                    $to_place = $ewb_data['response'][$i]['toPlace'];

						}else{
							$to_place = '';
						}

						if (array_key_exists("toPincode",$ewb_data['response'][$i])){

		                    $topincode = $ewb_data['response'][$i]['toPincode'];

						}else{
							$topincode = '';
						}
						
		                if (array_key_exists("transId",$ewb_data['response'][$i])){

		                    $tranId = $ewb_data['response'][$i]['transId'];

						}else{
							$tranId = '';
						}

						if (array_key_exists("transDocNo",$ewb_data['response'][$i])){

		                    $transDocNo = $ewb_data['response'][$i]['transDocNo'];

						}else{
							$transDocNo = '';
						}

						if (array_key_exists("transDocDate",$ewb_data['response'][$i])){

		                    $transDocDate = $ewb_data['response'][$i]['transDocDate'];

						}else{
							$transDocDate = '';
						}

						if (array_key_exists("transMode",$ewb_data['response'][$i])){

		                    $transMode = $ewb_data['response'][$i]['transMode'];

						}else{
							$transMode = '';
						}

						if (array_key_exists("vehicleNo",$ewb_data['response'][$i])){

		                    $vehicleNo = $ewb_data['response'][$i]['vehicleNo'];

						}else{
							$vehicleNo = '';
						}

						if (array_key_exists("ewbDate",$ewb_data['response'][$i])){

		                    $ewbDate = $ewb_data['response'][$i]['ewbDate'];

						}else{
							$ewbDate = '';
						}

		                if (array_key_exists("ewbDate",$ewb_data['response'][$i])){

		                    $ewb_date = $ewb_data['response'][$i]['ewbDate'];

						}else{
							$ewb_date = '';
						}
						
						if (array_key_exists("validUpto",$ewb_data['response'][$i])){

		                    $valid_upto = $ewb_data['response'][$i]['validUpto'];

						}else{
							$valid_upto = '';
						}
						
						if (array_key_exists("actualDist",$ewb_data['response'][$i])){

		                    $actual_dist = $ewb_data['response'][$i]['actualDist'];

						}else{
							$actual_dist = '';
						}
						
						if (array_key_exists("docNo",$ewb_data['response'][$i])){

		                    $doc_no = $ewb_data['response'][$i]['docNo'];

						}else{
							$doc_no = '';
						}

						if (array_key_exists("docDate",$ewb_data['response'][$i])){

		                    $doc_date = $ewb_data['response'][$i]['docDate'];

						}else{
							$doc_date = '';
						}

						if (array_key_exists("rejectStatus",$ewb_data['response'][$i])){

		                    $rejectStatus = $ewb_data['response'][$i]['rejectStatus'];

						}else{
							$rejectStatus = '';
						}

						if (array_key_exists("status",$ewb_data['response'][$i])){

		                    $status = $ewb_data['response'][$i]['status'];

						}else{
							$status = '';
						}

						if (array_key_exists("genGstin",$ewb_data['response'][$i])){

		                    $genGstin = $ewb_data['response'][$i]['genGstin'];

						}else{
							$genGstin = '';
						}

						if (array_key_exists("actFromStateCode",$ewb_data['response'][$i])){

		                    $actFromStateCode = $ewb_data['response'][$i]['actFromStateCode'];

						}else{
							$actFromStateCode = '';
						}

						if (array_key_exists("actToStateCode",$ewb_data['response'][$i])){

		                    $actToStateCode = $ewb_data['response'][$i]['actToStateCode'];

						}else{
							$actToStateCode = '';
						}
						if (array_key_exists("optForMultivehicle",$ewb_data['response'][$i])){

		                    $optForMultivehicle = $ewb_data['response'][$i]['optForMultivehicle'];

						}else{
							$optForMultivehicle = '';
						}
						if (array_key_exists("archived",$ewb_data['response'][$i])){

		                    $archived = $ewb_data['response'][$i]['archived'];

						}else{
							$archived = '';
						}
		                
		                if (array_key_exists("updateDate",$ewb_data['response'][$i])){

		                    $updateDate = $ewb_data['response'][$i]['updateDate'];

						}else{
							$updateDate = '';
						}

						if (array_key_exists("totInvValue",$ewb_data['response'][$i])){

		                    $totInvValue = $ewb_data['response'][$i]['totInvValue'];

						}else{
							$totInvValue = '';
						}

						if (array_key_exists("extendedTimes",$ewb_data['response'][$i])){

		                    $extendedTimes = $ewb_data['response'][$i]['extendedTimes'];

						}else{
							$extendedTimes = '';
						}

						if (array_key_exists("fromGstin",$ewb_data['response'][$i])){

		                    $fromGstin = $ewb_data['response'][$i]['fromGstin'];

						}else{
							$fromGstin = '';
						}
						if (array_key_exists("toGstin",$ewb_data['response'][$i])){

		                    $toGstin = $ewb_data['response'][$i]['toGstin'];

						}else{
							$toGstin = '';
						}
						if (array_key_exists("createDate",$ewb_data['response'][$i])){

		                    $createDate = $ewb_data['response'][$i]['createDate'];

						}else{
							$createDate = '';
						}

						if (array_key_exists("docNo",$ewb_data['response'][$i])){

		                    $docNo = $ewb_data['response'][$i]['docNo'];

						}else{
							$createDate = '';
						}
						if (array_key_exists("docDate",$ewb_data['response'][$i])){

		                    $docDate = $ewb_data['response'][$i]['docDate'];

						}else{
							$createDate = '';
						}
						if (array_key_exists("docType",$ewb_data['response'][$i])){

		                    $docType = $ewb_data['response'][$i]['docType'];

						}else{
							$docType = '';
						}

						if (array_key_exists("status",$ewb_data['response'][$i])){

		                    $status = $ewb_data['response'][$i]['status'];

						}else{
							$status = '';
						}
                        
                        if (array_key_exists("updateDate",$ewb_data['response'][$i])){

		                    $updateDate = $ewb_data['response'][$i]['updateDate'];

						}else{
							$updateDate = '';
						}

						if (array_key_exists("totInvValue",$ewb_data['response'][$i])){

		                    $totInvValue = $ewb_data['response'][$i]['totInvValue'];

						}else{
							$totInvValue = '';
						}

						if (array_key_exists("extendedTimes",$ewb_data['response'][$i])){

		                    $extendedTimes = $ewb_data['response'][$i]['extendedTimes'];

						}else{
							$extendedTimes = '';
						}

						if (array_key_exists("fromGstin",$ewb_data['response'][$i])){

		                    $fromGstin = $ewb_data['response'][$i]['fromGstin'];

						}else{
							$fromGstin = '';
						}

						if (array_key_exists("toGstin",$ewb_data['response'][$i])){

		                    $toGstin = $ewb_data['response'][$i]['toGstin'];

						}else{
							$toGstin = '';
						}

						if (array_key_exists("createDate",$ewb_data['response'][$i])){

		                    $createDate = $ewb_data['response'][$i]['createDate'];

						}else{
							$createDate = '';
						}

						if (array_key_exists("docNo",$ewb_data['response'][$i])){

		                    $docNo = $ewb_data['response'][$i]['docNo'];

						}else{
							$docNo = '';
						}

						if (array_key_exists("docDate",$ewb_data['response'][$i])){

		                    $docDate = $ewb_data['response'][$i]['docDate'];

						}else{
							$docDate = '';
						}

						if (array_key_exists("docType",$ewb_data['response'][$i])){

		                    $docType = $ewb_data['response'][$i]['docType'];

						}else{
							$docType = '';
						}


						if($check_data){

							$ewb_id = $check_data->EWBID; 
						    $ewb_no = $check_data->EWBNO; 
			               

							$data = array(
								"EWBID"              => $ewdId,
								"EWBNO"              => $ewb_no,
								"FROMTRDNAME"        => $fromTrdName,
								"FROM_PLACE"         => $from_place,
								"FROMPINCODE"        => $frompincode,
								"TOTRDNAME"          => $toTrdName,
								"TO_PLACE"           => $to_place,
								"TOPINCODE"          => $topincode,
								"TRANSID"            => $tranId,
								"TRANSDOCNO"         => $transDocNo,
								"TRANSDOCDATE"       => $transDocDate,
								"TRANSMODE"          => $transMode,
								"VEHICLE_NO"         => $vehicleNo,
								"EWB_DATE"           => $ewbDate,
								"VALID_UPTO"         => $valid_upto,
								"ACTUAL_DIST"        => $actual_dist,
								"REJECT_STATUS"      => $rejectStatus,
								"STATUS"             => $status,
								"ACTFROMSTATECODE"   => $actFromStateCode,
								"ACTTOSTATECODE"     => $actToStateCode,
								"OPTFORMULTIVEHICLE" => $optForMultivehicle,
								"ARCHIVED"           => $archived,
								"UPDATE_DATE"        => $updateDate,
								"TOTINVVALUE"        => $totInvValue,
								"EXTENDEDTIMES"      => $extendedTimes,
								"FROMGSTIN"          => $fromGstin,
								"TOGSTIN"            => $toGstin,
								"CREATEDDATE"        => $createDate,
								"DOCNO"              => $docNo,
								"DOC_DATE"           => $docDate,
								"DOC_TYPE"           => $docType,
								"LAST_UPDATED_BY"    => $createdBy,

			                );

			                // print_r($data);

			                $updatedata = DB::table('EWB_DATA')->where('EWBID',$ewb_id)->where('EWBNO',$ewb_no)->update($data);

			                $save_data = 1;


						}else{

							$data1 = array(

								"EWBID"              => $ewdId,
								"EWBNO"              => $ewbNo,
								"FROMTRDNAME"        => $fromTrdName,
								"FROM_PLACE"         => $from_place,
								"FROMPINCODE"        => $frompincode,
								"TOTRDNAME"          => $toTrdName,
								"TO_PLACE"           => $to_place,
								"TOPINCODE"          => $topincode,
								"TRANSID"            => $tranId,
								"TRANSDOCNO"         => $transDocNo,
								"TRANSDOCDATE"       => $transDocDate,
								"TRANSMODE"          => $transMode,
								"VEHICLE_NO"         => $vehicleNo,
								"EWB_DATE"           => $ewbDate,
								"VALID_UPTO"         => $valid_upto,
								"ACTUAL_DIST"        => $actual_dist,
								"REJECT_STATUS"      => $rejectStatus,
								"STATUS"             => $status,
								"ACTFROMSTATECODE"   => $actFromStateCode,
								"ACTTOSTATECODE"     => $actToStateCode,
								"OPTFORMULTIVEHICLE" => $optForMultivehicle,
								"ARCHIVED"           => $archived,
								"UPDATE_DATE"        => $updateDate,
								"TOTINVVALUE"        => $totInvValue,
								"EXTENDEDTIMES"      => $extendedTimes,
								"FROMGSTIN"          => $fromGstin,
								"TOGSTIN"            => $toGstin,
								"CREATEDDATE"        => $createDate,
								"DOCNO"              => $docNo,
								"DOC_DATE"           => $docDate,
								"DOC_TYPE"           => $docType,
								"CREATED_BY"         => $createdBy,

			                );



			                $savedata = DB::table('EWB_DATA')->insert($data1);

			                $save_data = 1;

			                // echo '<PRE>';print_r($data1);

			               

						}

						

						

					}else{

					}


				}else{
					$g_uptodate = '';
					$genreate_uptodate = '';
				}

				// End 
				
			}

			if($save_data > 0){

                	$request->session()->flash('alert-success', 'EWB Data Successfully Added...!');
					return redirect('Transaction/Logistic/upload-ewb-data');

            }else{

                	$request->session()->flash('alert-error', 'EWB Data Can not Saved...!');
					return redirect('Transaction/Logistic/upload-ewb-data');

            }

     //        if($update_data > 0){

     //            	$request->session()->flash('alert-success', 'EWB Data Successfully Updated...!');
					// return redirect('Transaction/Logistic/upload-ewb-data');

     //        }else{

     //            	$request->session()->flash('alert-error', 'EWB Data Can not Saved...!');
					// return redirect('Transaction/Logistic/upload-ewb-data');

     //        }

			
		}

    }


    public function getDoNoDetaislByAccCode(Request $request){


    		$response_array = array();

		if ($request->ajax()) {

	    	$account_code   = $request->input('account_code');

	    	$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
		 
       //DB::enableQueryLog();
	    	//$data = DB::select("SELECT t1.*,t3.UM as um FROM DORDER_BODY t1 LEFT JOIN MASTER_ITEM t3 ON t1.ITEM_CODE = t3.ITEM_CODE  WHERE t1.ACC_CODE='$account_code' AND t1.COMP_CODE='$getcompcode' AND t1.QTY !=t1.DISPATCH_PLAN_QTY");
	    	$data = DB::select("SELECT t1.*,t3.UM as um FROM DORDER_BODY t1 LEFT JOIN MASTER_ITEM t3 ON t1.ITEM_CODE = t3.ITEM_CODE  WHERE t1.ACC_CODE='$account_code' AND t1.COMP_CODE='$getcompcode' AND t1.QTY-t1.DISPATCH_PLAN_QTY-t1.CANCEL_QTY > 0");


	    	///print_r($data);exit;	

	    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	        })->toJson();

	  	}
	    	

    }

    public function getDoNoDetaisl(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$account_code   = $request->input('account_code');
		 
	    	$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
	 //   	DB::enableQueryLog();
	    	//$delivery_order = DB::table('DORDER_BODY')->where('ACC_CODE', $account_code)->get()->toArray();

	    	$delivery_order = DB::select("SELECT t1.*,t2.ITEM_CODE as item_code,t2.UM as um FROM DORDER_BODY t1 LEFT JOIN MASTER_ITEM t2 ON t1.ITEM_CODE = t2.ITEM_CODE  WHERE t1.ACC_CODE='$account_code' AND t1.COMP_CODE='$getcompcode'");

      //  dd(DB::getQueryLog());
	   

	    	$acc_data = DB::table('MASTER_ACC')
				->select('MASTER_ACC.*', 'MASTER_ACCADD.*')
           		->leftjoin('MASTER_ACCADD', 'MASTER_ACCADD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->where('MASTER_ACC.ACC_CODE',$account_code)
           		->get()->first();
	    
	    	/*$delivery_order = DB::select("SELECT t1.PLANT_CODE as plant_code,t1.PLANT_NAME as plant_name,t1.PFCT_CODE as pfct_code,t1.PFCT_NAME as pfct_name,t1.VRDATE as vrDate,t2.* FROM DORDER_HEAD t1 LEFT JOIN DORDER_BODY t2 ON t1.DORDERHID = t2.DORDERHID  WHERE t1.ACC_CODE='$account_code'");*/

	    	$fso_head_body = DB::select("SELECT t1.*,t2.RATE,t2.QTY FROM FSO_HEAD t1 LEFT JOIN FSO_BODY t2 ON t1.FSOHID = t2.FSOHID  WHERE t1.ACC_CODE='$account_code'");

	    	
	    	//print_r($fso_head);exit;

    		if($delivery_order || $acc_data) {

    			   $response_array['response'] = 'success';
	            $response_array['data'] = $delivery_order;
	            $response_array['fso_data'] = $fso_head_body;
	            $response_array['acc_data'] = $acc_data;
	         

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


     public function getDoNoDetaislWoitem(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$account_code   = $request->input('account_code');
		 
	    	$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
	 //   	DB::enableQueryLog();
	    	//$delivery_order = DB::table('DORDER_BODY')->where('ACC_CODE', $account_code)->get()->toArray();

	    	/*$delivery_order = DB::select("SELECT t1.*,t2.ITEM_CODE as item_code,t2.UM as um FROM DORDER_BODY t1 LEFT JOIN MASTER_ITEM t2 ON t1.ITEM_CODE = t2.ITEM_CODE  WHERE t1.ACC_CODE='$account_code' GROUP BY t1.CP_CODE");*/
	    	$delivery_order = DB::select("SELECT B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME,B.RAKE_NO FROM DORDER_BODY B WHERE B.ACC_CODE='$account_code' AND B.QTY-B.DISPATCH_PLAN_QTY-B.CANCEL_QTY > 0 GROUP BY B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME");

	    	$deliveryRake = DB::select("SELECT A.RAKE_NO FROM DORDER_BODY A WHERE A.ACC_CODE='$account_code' GROUP BY A.RAKE_NO");

	    	//print_r($deliveryRake);exit;

      //  dd(DB::getQueryLog());
	   

	    	$acc_data = DB::table('MASTER_ACC')
				->select('MASTER_ACC.*', 'MASTER_ACCADD.*')
           		->leftjoin('MASTER_ACCADD', 'MASTER_ACCADD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->where('MASTER_ACC.ACC_CODE',$account_code)
           		->get()->first();
	    
	    	/*$delivery_order = DB::select("SELECT t1.PLANT_CODE as plant_code,t1.PLANT_NAME as plant_name,t1.PFCT_CODE as pfct_code,t1.PFCT_NAME as pfct_name,t1.VRDATE as vrDate,t2.* FROM DORDER_HEAD t1 LEFT JOIN DORDER_BODY t2 ON t1.DORDERHID = t2.DORDERHID  WHERE t1.ACC_CODE='$account_code'");*/

	    	$fso_head_body = DB::select("SELECT t1.*,t2.RATE,t2.QTY FROM FSO_HEAD t1 LEFT JOIN FSO_BODY t2 ON t1.FSOHID = t2.FSOHID  WHERE t1.ACC_CODE='$account_code'");

	    	
	    	//print_r($fso_head);exit;

    		if($delivery_order || $acc_data) {

    			   $response_array['response'] = 'success';
	            $response_array['data'] = $delivery_order;
	            $response_array['data_rake'] = $deliveryRake;
	            $response_array['fso_data'] = $fso_head_body;
	            $response_array['acc_data'] = $acc_data;
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data_rake'] = '';
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


    public function getLrNoDetails(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$account_code   = $request->input('account_code');
	    	$lr_no          = $request->input('lr_no');
	    	$invc_no        = $request->input('invc_no');
	    	$dorderNo       = $request->input('dorderNo');
		 
	    	$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
			
			if($account_code && $lr_no && $invc_no && $dorderNo){

				$lr_no_details = DB::select("SELECT A.TO_PLACE FROM TRIP_HEAD A,TRIP_BODY B WHERE A.TRIPHID=B.TRIPHID AND B.ACC_CODE='$account_code' AND B.LR_NO='$lr_no' AND B.INVC_NO='$invc_no' AND B.DO_NO='$dorderNo'");

				$filedType = 'DO_NO';

			}else if($account_code && $lr_no && $invc_no){

				$lr_no_details = DB::select("SELECT B.DO_NO FROM TRIP_BODY B WHERE B.ACC_CODE='$account_code' AND B.LR_NO='$lr_no' AND B.INVC_NO='$invc_no'  GROUP BY B.DO_NO");

				$filedType = 'INVC_NO';

			}else if($account_code && $lr_no){

				$lr_no_details = DB::select("SELECT B.INVC_NO FROM TRIP_BODY B WHERE B.ACC_CODE='$account_code' AND B.LR_NO='$lr_no' GROUP BY B.INVC_NO");

				$filedType = 'LR_NO';

			}else if($account_code){

				$lr_no_details = DB::select("SELECT B.LR_NO FROM TRIP_BODY B WHERE B.ACC_CODE='$account_code' GROUP BY B.LR_NO");

				$filedType = 'ACC_CODE';
			}else{
				$lr_no_details = '';
			}
	    	
    		if($lr_no_details) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $lr_no_details;
	            $response_array['data_type'] = $filedType;
	           
	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data_type'] = '';

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


 public function getCpCodeByRakeAcc(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$account_code   = $request->input('account_code');
	    	$rake_no        = $request->input('rake_no');
		 
	    	$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
	 //   	DB::enableQueryLog();
	    	//$delivery_order = DB::table('DORDER_BODY')->where('ACC_CODE', $account_code)->get()->toArray();

	    	/*$delivery_order = DB::select("SELECT t1.*,t2.ITEM_CODE as item_code,t2.UM as um FROM DORDER_BODY t1 LEFT JOIN MASTER_ITEM t2 ON t1.ITEM_CODE = t2.ITEM_CODE  WHERE t1.ACC_CODE='$account_code' GROUP BY t1.CP_CODE");*/
	    	$delivery_order = DB::select("SELECT B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME,B.RAKE_NO FROM DORDER_BODY B WHERE B.ACC_CODE='$account_code' AND B.RAKE_NO='$rake_no'  AND B.QTY-B.DISPATCH_PLAN_QTY-B.CANCEL_QTY > 0 GROUP BY B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME");

	    	$deliveryRake = DB::select("SELECT A.RAKE_NO FROM DORDER_BODY A WHERE A.ACC_CODE='$account_code' AND A.RAKE_NO='$rake_no'  GROUP BY A.RAKE_NO");

	    	
	    
	    	/*$delivery_order = DB::select("SELECT t1.PLANT_CODE as plant_code,t1.PLANT_NAME as plant_name,t1.PFCT_CODE as pfct_code,t1.PFCT_NAME as pfct_name,t1.VRDATE as vrDate,t2.* FROM DORDER_HEAD t1 LEFT JOIN DORDER_BODY t2 ON t1.DORDERHID = t2.DORDERHID  WHERE t1.ACC_CODE='$account_code'");*/

	    	$fso_head_body = DB::select("SELECT t1.*,t2.RATE,t2.QTY FROM FSO_HEAD t1 LEFT JOIN FSO_BODY t2 ON t1.FSOHID = t2.FSOHID  WHERE t1.ACC_CODE='$account_code'");

	    	
	    	//print_r($fso_head);exit;

    		if($delivery_order || $acc_data) {

    			   $response_array['response'] = 'success';
	            $response_array['data'] = $delivery_order;
	            $response_array['data_rake'] = $deliveryRake;
	            $response_array['fso_data'] = $fso_head_body;
	          

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data_rake'] = '';
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

   public function getFreightPurDetails(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$transporter_code   = $request->input('trans_code');
	    	$to_place   = $request->input('to_place');
	    	//$vrno   = $request->input('vrno');
		 
	    	

	    /*	$freightpur_order = DB::table('FPO_BODY')->where('SERIES_CODE', $transporter_code)->where('VRNO', $vrno)->get()->toArray();
*/
	    	$freightpur_order = DB::select("SELECT t1.*,t2.RATE,t2.QTY,t2.TO_PLACE,t2.RATE_BASIS FROM FPO_HEAD t1 LEFT JOIN FPO_BODY t2 ON t1.FPOHID = t2.FPOHID  WHERE t1.ACC_CODE='$transporter_code' AND t2.TO_PLACE='$to_place'");
	    	

	   // print_r($freightpur_order);exit;

    		if($freightpur_order) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $freightpur_order;
	         

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

    public function getDeliveryOrderQty(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$ItemCode   = $request->input('ItemCode');
	    	$do_no     = $request->input('do_no');
	    	$cpCode    = $request->input('cpCode');
		 	
		 	if($cpCode){
	    	$cpCount = count($cpCode);

		 	}else{
		 	$cpCount='';
		 	}

	    	//$delivery_order = DB::table('DORDER_BODY')->where('DORDER_NO', $do_no)->where('ITEM_CODE', $ItemCode)->get()->toArray();

        $delivery_order = DB::select("SELECT t1.*,t3.UM as um FROM DORDER_BODY t1 LEFT JOIN MASTER_ITEM t3 ON t1.ITEM_CODE = t3.ITEM_CODE  WHERE t1.DORDER_NO='$do_no' AND  t1.ITEM_CODE ='$ItemCode'");


	    	$delivery_qty = DB::table('DORDER_BODY')->where('DORDER_NO', $do_no)->get()->first();

	    	$from_place = $delivery_order[0]->FROM_PLACE;
	    	$to_place = $delivery_order[0]->TO_PLACE;
	    	$cp_code = trim($delivery_order[0]->CP_CODE);
	    	$Acc_code = trim($delivery_order[0]->ACC_CODE);

	    	//print_r($cp_code);exit;

	    	$trip_body_qty = DB::table('TRIP_BODY')->where('DO_NO', $do_no)->get()->first();

	    	$trip_days = DB::table('MASTER_FREIGHT_ROUTE')->where('FROM_PLACE',$from_place)->where('TO_PLACE',$to_place)->get()->first();


	    	$fso_data = DB::table('FSO_BODY')->where('ACC_CODE',$Acc_code)->get()->first();

	    	//print_r($fso_data);exit;

	   // DB::enableQueryLog();
//

	    	/*$getoffDays = DB::select("SELECT t1.* FROM MASTER_ACC t1 LEFT JOIN MASTER_ACCADD t2 ON t1.ACC_CODE = t2.ACC_CODE  WHERE t1.ACC_CODE='$cp_code'");*/

	    	//$getoffDays = DB::select("SELECT * FROM MASTER_ACCADD WHERE ACC_CODE='$cp_code'");

	    	//DB::enableQueryLog();
	    	$getoffDays = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACCADD.ACC_CODE='$cp_code'");

	    	//dd(DB::getQueryLog());
	   // print_r($getoffDays);exit;
	    	 $getcpAddress=array();

	    	for ($j=0; $j < $cpCount ; $j++) { 
	    		
	    		/*$getcpAddress[] = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACCADD.ACC_CODE='$cpCode[$j]'");*/
	    		$getcpAddress[] = DB::table('MASTER_ACCADD')->where('ACC_CODE', $cpCode[$j])->get()->first();
	    	}

	    	//print_r($getcpAddress);exit;
	    	$cpAddress = json_decode(json_encode($getcpAddress), true); 

	    	//print_r($cpAddress);exit;

    		if($delivery_order || $delivery_qty) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $delivery_order;
	            $response_array['data_do_qty'] = $delivery_qty;
	            $response_array['data_trip_qty'] = $trip_body_qty;
	            $response_array['trip_data'] = $trip_days;
	            $response_array['offday_data'] = $getoffDays;
	            $response_array['fso_data'] = $fso_data;
	            $response_array['cp_address'] = $cpAddress;
	         

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


    public function getDeliveryOrderQtyDo(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$ItemCode   = $request->input('ItemCode');
	    	$do_no   = $request->input('do_no');
		 

	    	$delivery_qty = DB::table('DORDER_BODY')->where('DORDER_NO', $do_no)->get()->first();

	    	$trip_body_qty = DB::table('TRIP_BODY')->where('DO_NO', $do_no)->get()->first();
	    	
	    	//print_r($trip_body_qty);exit;

    		if($delivery_qty || $trip_body_qty) {

    			$response_array['response'] = 'success';
	            $response_array['data_do_qty'] = $delivery_qty;
	            $response_array['data_trip_qty'] = $trip_body_qty;
	         	

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
    

    public function UpdateDeliveryOrderQty(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			$createdBy    = $request->session()->get('userid');
			
			$compName     = $request->session()->get('company_name');
			
			$compcode     = explode('-', $compName);
			
			$comp_code  =	$compcode[0];
			
			$fisYear      =  $request->session()->get('macc_year');

	    	$allc_qty   = $request->input('allc_qty');
	    	$do_no   = $request->input('do_no');
	    	$itemslno   = $request->input('itemslno');
	    	$flag   = $request->input('flag');


	    	$tableId  = $request->input('temptableidDo');
            $tblcol   = $request->input('tblcoldo');

            //print_r($tblcol);exit();
                
            if($tableId && $tblcol){

                $data = array(

                     'DO_EXIST_STATUS' => 'EXIST',
                     'DO_UPDATE_STATUS' => 1,
                    
                );

               $update  = DB::table('TEMP_DELIVERY_ORDER')->where('ID', $tableId)->where($tblcol, $do_no)->update($data);

            }

            if($do_no && $flag=='1'){

                $data1 = array(

                    'QTY' => $allc_qty,
                    
                );

               $update1  = DB::table('DORDER_BODY')->where('DORDER_NO', $do_no)->where('SLNO', $itemslno)->update($data1);

            }
		 

	  	   $NewData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='NO' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

	       $AllocQtyData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

	       $itemaccData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE  ( COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy')  AND ((ITEM_STATUS ='YES' AND DO_EXIST_STATUS ='NO') OR  (ACC_STATUS='YES' AND DO_EXIST_STATUS ='NO'))");


		    $new_data_count = count($NewData);

		    $itemacc_count = count($itemaccData);

		    $allocqty_count = count($AllocQtyData);
	       

    		if($update || $update1) {

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

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function getDeliveryOldQty(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	
	    	$do_no   = $request->input('dono');
	    	$itemslno   = $request->input('itemslno');
  
          
           

               $getdoOldQty  = DB::table('DORDER_BODY')->where('DORDER_NO',$do_no)->where('SLNO',$itemslno)->get()->first();

            
		 
              // print_r($getdoOldQty);exit;
	  

    		if($getdoOldQty) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $getdoOldQty;

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
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }




public function getTripNoUpdate(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			$createdBy     = $request->session()->get('userid');
			
			$compName      = $request->session()->get('company_name');
			
			$compcode      = explode('-', $compName);
			
			$comp_code     =	$compcode[0];
			
			$fisYear       =  $request->session()->get('macc_year');

	    	$do_no         = $request->input('id');
	    	$bill_doc      = $request->input('bill_doc');
	    	$delivery_no   = $request->input('delivery_no');
	    	$lr_no         = $request->input('lr_no');
	    	$destination   = $request->input('Dest');
	    	$trip_no       = $request->input('trip_no');
  				
  		

  			$data = array(

	    		'TRIP_NO' =>$trip_no,
	    		'DO_NUMBER' =>'NO',
	    	   );

             $getdoOldQty  = DB::table('TEMP_DELIVERY_ORDER')->where('COL1',$bill_doc)->where('COL12',$delivery_no)->where('COL20',$lr_no)->where('COMP_CODE',$comp_code)->update($data);
  			
          	
         /*   $getData = DB::table('TRIP_HEAD')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRIP_NO',$trip_no)->where('TO_PLACE',$destination)->get()->first();*/
	    	

    		if($getdoOldQty){

    			$response_array['response'] = 'success';
	         	$response_array['message'] = '';

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
				$response_array['message'] = '';
               
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

   

 /*vehicle planing*/

 /*supplimentry lorry */
 public function AddSupplLorryReceipt(Request $request){


		$title                       = 'Add Supplimentry Lorry Receipt';
		$compName                    = $request->session()->get('company_name');
		$fisYear                     =  $request->session()->get('macc_year');
		$CompanyCode                 = $request->session()->get('company_name');
		$compcode                    = explode('-', $CompanyCode);
		$getcompcode                 = $compcode[0];
		$vehicle_no                  = $request->old('vehicle_no');
		$from_place                  = $request->old('from_place');
		$to_place                    = $request->old('to_place');
		$transporter                 = $request->old('transporter');
		$date                        = $request->old('date');
		$fright_order                = $request->old('fright_order');
		$vehicleId                   = $request->old('id');
		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();
		
		$userdata['vehicle_list']    = DB::table('MASTER_FLEET')->get();
		
		$userdata['inward_list']     = DB::table('MASTER_INWARD_SLIP')->get();
		
		$userdata['transport_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();
		
		$userdata['getacc']          = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']     = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T3'])->where(['COMP_CODE'=>$getcompcode])->get();
		//dd(DB::getQueryLog());
		$userdata['tax_code_list']   = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		//DB::enableQueryLog();
		$userdata['dept_list']       = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']      = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']       = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']       = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']       = DB::table('MASTER_COST')->get();
		$userdata['emp_list']        = DB::table('MASTER_EMP')->get();
		
		$userdata['item_list']       = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']       = DB::table('MASTER_RATE_VALUE')->get();
		
		$userdata['area_list']       = DB::table('MASTER_AREA')->get();

		$userdata['trip_list']       = DB::table('TRIP_HEAD')->where('GATE_IN_STATUS','1')->where('LR_STATUS','0')->get();

		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['truck_list']      = DB::table('MASTER_FLEET')->get();
		
		$userdata['comp_list']       = DB::table('MASTER_COMP')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

		$userdata['fpo_list']        = DB::table('FPO_HEAD')->get();

		$userdata['route_list']        = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('ROUTE_CODE')->get();

	    $userdata['columnlist']    = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','LR')->get()->toArray();
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$fisYear])->get();

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		$requistion = DB::table('TRIP_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$fisYear)->get();

		$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

		//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T3')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
		//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='T3'");
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

		$button='Save';
    	$action='Vehicle-Planing-Save';

    
    	return view('admin.finance.transaction.logistic.suppl_lorry_receipt_tran',$userdata+compact('title','button','action','vehicle_no','from_place','to_place','transporter','date','fright_order','vehicleId'));



    }
 /*supplimentry lorry */

 /*lorry receipt*/

public function AddLorryReceipt(Request $request){



		$title                       = 'Add Lorry Receipt';
		$compName                    = $request->session()->get('company_name');
		$fisYear                     =  $request->session()->get('macc_year');
		$CompanyCode                 = $request->session()->get('company_name');
		$compcode                    = explode('-', $CompanyCode);
		$getcompcode                 = $compcode[0];
		$vehicle_no                  = $request->old('vehicle_no');
		$from_place                  = $request->old('from_place');
		$to_place                    = $request->old('to_place');
		$transporter                 = $request->old('transporter');
		$date                        = $request->old('date');
		$fright_order                = $request->old('fright_order');
		$vehicleId                   = $request->old('id');
		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();
		
		$userdata['vehicle_list']    = DB::table('MASTER_FLEET')->get();
		
		$userdata['inward_list']     = DB::table('MASTER_INWARD_SLIP')->get();
		
		$userdata['transport_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();
		
		$userdata['getacc']          = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']     = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T3'])->where(['COMP_CODE'=>$getcompcode])->get();
		//dd(DB::getQueryLog());
		$userdata['tax_code_list']   = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		//DB::enableQueryLog();
		$userdata['dept_list']       = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']      = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']       = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']       = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']       = DB::table('MASTER_COST')->get();
		$userdata['emp_list']        = DB::table('MASTER_EMP')->get();
		
		$userdata['item_list']       = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']       = DB::table('MASTER_RATE_VALUE')->get();
		
		$userdata['area_list']       = DB::table('MASTER_AREA')->get();

		$userdata['trip_list']         = DB::table('TRIP_HEAD')->where('GATE_IN_STATUS','1')->where('LR_STATUS','0')->where('TRIP_WO_ITEM','0')->get();

		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['truck_list']      = DB::table('MASTER_FLEET')->get();
		
		$userdata['comp_list']       = DB::table('MASTER_COMP')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

		$userdata['fpo_list']        = DB::table('FPO_HEAD')->get();

		$userdata['route_list']        = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('ROUTE_CODE')->get();

	    $userdata['columnlist']    = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','LR')->get()->toArray();
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$fisYear])->get();

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		

    
    	return view('admin.finance.transaction.logistic.lorry_receipt_tran',$userdata+compact('title','vehicle_no','from_place','to_place','transporter','date','fright_order','vehicleId'));



    }


    public function UploadLorryReceipt(Request $request){

        $title                       = 'Add Lorry Receipt';
		$compName                    = $request->session()->get('company_name');
		$fisYear                     =  $request->session()->get('macc_year');
		$CompanyCode                 = $request->session()->get('company_name');
		$compcode                    = explode('-', $CompanyCode);
		$getcompcode                 = $compcode[0];
		

		$userdata['do_excel_list']      = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','LR')->groupBy(['TRAN_CODE','EXLCONFIG_CODE'])->get();
		//dd(DB::getQueryLog());
		$userdata['tax_code_list']   = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		//DB::enableQueryLog();
		

	    $userdata['columnlist']    = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','LR')->get()->toArray();
		
		$userdata['getacc'] = DB::table('MASTER_ACC')->select('ACC_CODE',DB::raw('replace(ACC_NAME, \'"\',"\ ") as ACC_NAME'))->WHERE('ATYPE_CODE','D')->get();

		$userdata['tripNo_list']   = DB::table('TRIP_BODY')->groupBy('TRIP_NO')->get();

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/


    
    	return view('admin.finance.transaction.logistic.upload_lorry_receipt',$userdata+compact('title'));


    }


     public function importLrExcel(Request $request) 
    {
     

		$table           = 'TEMP_DO_ORDER';

		$config_table    = 'MASTER_EXCELCONFIG';

		$CompanyName     = $request->session()->get('company_name');
	
		$fisYear =  $request->session()->get('macc_year');

		$getcompcode = explode('-', $CompanyName);

		$comp_code   =$getcompcode[0];


		$file_type = $request->input('file_type');

		//print_r($file_type);exit;

		$trip_plan = DB::select("SELECT t1.*,t2.* FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID");

	    

		$tripPlanCount = count($trip_plan);


		$tripPlanArray = [];
		$tripPlanArrayQty = [];
		$tripPlanArrayItem = [];

		for ($s = 0; $s < $tripPlanCount; $s++){

			$tripPlanArray[] = $trip_plan[$s]->DO_NO;
			$tripPlanArrayQty[] = $trip_plan[$s]->QTY;
			$tripPlanArrayItem[] = $trip_plan[$s]->ITEM_CODE;
			
		}

	

	      $DELORDER_NO = 	$trip_plan[0]->DO_NO;

		
		//print_r($tripPlanArray);exit;

		

		$column_name = DB::table('MASTER_EXCELCONFIG')->select('EXCEL_COL','VALIDATION_STATUS','TEMPEXCEL_COL','TBL_COL')->where('TRAN_CODE','LR')->get()->toArray();

		//print_r($column_name);exit;

		$configTableCount = count($column_name);

		$itemcolumn = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','LR')->where('VALIDATION_STATUS',2)->get()->toArray();


		$acc_code = DB::table('MASTER_ACC')->select('ACC_CODE')->get()->toArray();

		
		
		$tempvrno        = $request->input('tempvrno');
		
		$temptransporter = $request->input('temptransporter');

		$createdBy        = $request->session()->get('userid');
		
		$file            = $request->file('file');

		 DB::table('TEMP_DELIVERY_ORDER')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->delete();

       $excelData = Excel::toArray(new TempTableImport(),$file);
  

     /*  $excelData =  Excel::import(new TableImport($table,$config_table,$CompanyName,$macc_year,$tempvrno,$temptransporter,$column_name),$file);*/

        $excelColcount = count($excelData[0][0]);

        
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

      // 	print_r($getAllExcelData);exit;


       	$getAllExcelCount = count($getAllExcelData);

       	//print_r($getAllExcelCount);exit;

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
       		
       		if(isset($getAllExcelData[$n])){

       			
       			$insertexcelArray[]  = $getAllExcelData[$n];


       			    $excel_date = $getAllExcelData[$n]['BILLING DATE'];
       			   
					$unix_date = ($excel_date - 25569) * 86400;
					$excel_date1 = 25569 + ($unix_date / 86400);
					$unix_date1 = ($excel_date1 - 25569) * 86400;
					//print_r($excel_date1);exit;
					$insertexcelArrayDt[] = gmdate("Y-m-d", $unix_date1);
					
       			    $arrKey = array_search('BILLING DATE', array_keys($getAllExcelData[$n]));

       			    $createeway_date = $getAllExcelData[$n]['EWB Creation Da'];
					$unixeway_date = ($createeway_date - 25569) * 86400;
					$createeway_date1 = 25569 + ($unixeway_date / 86400);
					$unixeway_date1 = ($createeway_date1 - 25569) * 86400;
					$insertexcelArrayDt1[] = gmdate("Y-m-d", $unixeway_date1);
					
       			    $arrKey1 = array_search('EWB Creation Da', array_keys($getAllExcelData[$n]));


       			    $valideway_date = $getAllExcelData[$n]['EWB Valid Date'];
					$unixvalideway_date = ($valideway_date - 25569) * 86400;
					$valideway_date1 = 25569 + ($unixvalideway_date / 86400);
					$unixvalideway_date1 = ($valideway_date1 - 25569) * 86400;
					$insertexcelArrayDt2[] = gmdate("Y-m-d", $unixvalideway_date1);
					
       			    $arrKey2 = array_search('EWB Valid Date', array_keys($getAllExcelData[$n]));


       			    $lorry_date = $getAllExcelData[$n]['LR RECIEPT DT'];
					$unixlorry_date = ($lorry_date - 25569) * 86400;
					$lorry_date1 = 25569 + ($unixlorry_date / 86400);
					$unixlorry_date1 = ($lorry_date1 - 25569) * 86400;
					$insertexcelArrayDt3[] = gmdate("Y-m-d", $unixlorry_date1);
					
       			    $arrKey3 = array_search('LR RECIEPT DT', array_keys($getAllExcelData[$n]));
       				

       				/*if(isset($tripPlanArray[$w])){

       					  if($getAllExcelData[$n]['DO/STO NO'] == $tripPlanArray[$w]){

		       					$insertexcelArray[]  = $getAllExcelData[$n];

		       					
		       				}

       				}
*/
       			/*if($getAllExcelData[$n]['VEHICLE NO'] == $vehicle_no){

       					$insertexcelArray[]  = $getAllExcelData[$n];

       			}
*/
       			

       				
       		}

       	


       	}

      
    


       $dataexcelCount =count($insertexcelArray); 
       $tripPlanArrayCount =count($tripPlanArray); 

      // print_r($tripPlanArrayCount);exit;

        $temptblcol =[];
		$tempExcelcol =[];
		for ($b = 0; $b < $tblcount; $b++) {

			$temptblcol[] = $tblmerger[$b]['TBL_COL'];
			$tempExcelcol[] = $tblmerger[$b]['TEMPEXCEL_COL'];

		  // print_r($tblmerger[$b]['TBL_COL']);

		
	    }


	    //print_r($temptblcol);

	    $arryCombConfigTbl = array_combine($temptblcol, $tempExcelcol);

	 // print_r($arryCombConfigTbl);exit;

	   // $ConfigItem = $arryCombConfigTbl['ITEM_CODE'];
	    $ConfigAcc     = $arryCombConfigTbl['ACC_NAME'];
	    $ConfigDo      = $arryCombConfigTbl['DO_NO'];
	    $ConfigSlNo    = $arryCombConfigTbl['SLNO'];
	    $ConfigQty     = $arryCombConfigTbl['QTY'];
	    $ConfigVehicle = $arryCombConfigTbl['VEHICLE_NO'];
	    $ConfigToPlace = $arryCombConfigTbl['TO_PLACE'];
	    $ConfigInvcNo = $arryCombConfigTbl['INVC_NO'];
	    $ConfigDelNo  = $arryCombConfigTbl['DELIVERY_NO'];
	    $ConfigDelNo  = $arryCombConfigTbl['DELIVERY_NO'];
	    $ConfigLrDate  = $arryCombConfigTbl['LR_DATE'];

	 // print_r($ConfigAcc);exit;

       for ($t = 0; $t < $dataexcelCount; $t++) {



       	$arrayIndex = array_values($insertexcelArray[$t]);

       	$arrayIndex1 = $insertexcelArrayDt[$t];

       	$arrayIndex2 = $insertexcelArrayDt1[$t];

       	$arrayIndex3 = $insertexcelArrayDt2[$t];

       	$arrayIndex4 = $insertexcelArrayDt3[$t];

       	$arrayIndexCount = count($arrayIndex);

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

       			}else if($p==$arrKey2){

       				$new_array['COL'.$q] = $arrayIndex3;

       			}else if($p==$arrKey3){

       				$new_array['COL'.$q] = $arrayIndex4;

       			}else{

       			   $new_array['COL'.$q] = $arrayIndex[$p];
       			}
       			
       			
       			
       		}

       	

       		$saveData =	DB::insert("INSERT INTO `TEMP_DELIVERY_ORDER` (COMP_CODE,FY_CODE,CREATED_BY,".implode(' , ', array_keys($new_array)).") VALUES ('$comp_code','$fisYear','$createdBy','".implode("' , '", array_values($new_array))."')");

       		//dd(DB::getQueryLog());

       		$lastId =	DB::getPdo()->lastInsertId();

       		$tempDoOrder = DB::table('TEMP_DELIVERY_ORDER')->where('ID',$lastId)->get()->first();

       	

       		//$tempItemCode = $tempDoOrder->$ConfigItem; 

       		$tempAccName =  $tempDoOrder->$ConfigAcc;

       		$tempDoNumber  =  $tempDoOrder->$ConfigDo;
       		$tempSlNo      =  $tempDoOrder->$ConfigSlNo;

       		$tempDoQty     =  $tempDoOrder->$ConfigQty;
       		$tempVehicleNo =  $tempDoOrder->$ConfigVehicle;
       		$tempToPlace   =  $tempDoOrder->$ConfigToPlace;
       		$tempInvcNo    =  $tempDoOrder->$ConfigInvcNo;
       		$tempDelNo    =  $tempDoOrder->$ConfigDelNo;
       		$tempLrDate    =  $tempDoOrder->$ConfigLrDate;

       		//print_r($tempLrDate);

          //DB::enableQueryLog();

       		$sp_name = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->where('ACC_NAME',$tempAccName)->orWhere('ALIAS_NAME', 'LIKE', '%'.$tempAccName.'%')->get()->toArray();

       		//dd(DB::getQueryLog());


            ///dd(DB::getQueryLog());	

		   // print_r($sp_name);


       		if($sp_name){

       			foreach($sp_name as $key){
       				//DB::enableQueryLog();


       				$city_name = DB::table('MASTER_ACCADD')->where('ACC_CODE',$key->ACC_CODE)->where('CITY_NAME','LIKE', '%'.$tempToPlace.'%')->get()->toArray();
					//dd(DB::getQueryLog());


       			     if($city_name){
       			     	
       			     }else{

       			     	$dataCityName = array(

       			     		'CITY_STATUS'=>'YES',
       			     	);

       			     
       			       DB::table('TEMP_DELIVERY_ORDER')->where($ConfigAcc,$tempAccName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataCityName);

       			     }


       			     $dataAcc = array(

		       						$ConfigAcc => $key->ACC_NAME.'~'.$key->ACC_CODE
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


       		/*$acc_name = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->where('ACC_NAME',$tempAccName)->orWhere('ALIAS_NAME', 'LIKE', '%'.$tempAccName.'%')->get()->toArray();

 
		       		if($acc_name){

		       			foreach($acc_name as $key){

		       					$dataAcc = array(

		       						$ConfigAcc => $key->ACC_NAME.'~'.$key->ACC_CODE
		       					);

		       			$update2 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigAcc,$tempAccName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataAcc);

		       			}

		       		}else{

		       			$dataAcc = array(

		       				'ACC_STATUS' => 'YES',
		       				'NOT_FOUND_STATUS' => 'NOT FOUND',

		       			);

		       		  $update3 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigAcc,$tempAccName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataAcc);

		       		}*/



		      
       		

       		/*if($dataexcelCount > $TRIP_BODYcount ){

       			$databody = array(

       				'DO_NUMBER' => 'NOT FOUND',

       			);

       		  $update =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigDo,$tempDoNumber)->update($databody);
       			

       		}else{

       			

       		}*/
       		//print_r($TRIP_BODY);

		   	//$trip_body = DB::table('TRIP_BODY')->where('DELORDER_NO',$tempDoNumber)->where('DELORDER_NO',$tempVehicleNo)->get()->toArray();
       		//DB::enableQueryLog();
       		$trip_body=array();
		  /* 	$trip_body = DB::select("SELECT t1.VEHICLE_NO,t1.LR_STATUS,t2.DO_NO,t2.SLNO,t1.TRIP_NO,t1.TO_PLACE FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID WHERE t1.VEHICLE_NO = '$tempVehicleNo' AND t2.SLNO='$tempSlNo' AND t2.DO_NO = '$tempDoNumber' AND t1.TO_PLACE='$tempToPlace' AND t1.LR_STATUS='0'");*/

		  if($file_type=='TATA'){

		  			$trip_body = DB::select("SELECT t1.VEHICLE_NO,t1.LR_STATUS,t2.DO_NO,t2.SLNO,t1.TRIP_NO,t1.TO_PLACE FROM TRIP_HEAD t1,TRIP_BODY t2  WHERE  t1.TRIPHID = t2.TRIPHID AND t1.VEHICLE_NO = '$tempVehicleNo' AND t1.TO_PLACE='$tempToPlace' AND t1.LR_STATUS='0' AND t2.DO_NO = '$tempDoNumber'");
		  }else{
		  	    	$trip_body = DB::select("SELECT t1.VEHICLE_NO,t1.LR_STATUS,t2.DO_NO,t2.SLNO,t1.TRIP_NO,t1.TO_PLACE FROM TRIP_HEAD t1,TRIP_BODY t2  WHERE  t1.TRIPHID = t2.TRIPHID AND t1.VEHICLE_NO = '$tempVehicleNo' AND t1.TO_PLACE='$tempToPlace' AND t1.LR_STATUS='0' AND t1.VRDATE='$tempLrDate'");
		  }

		 //  print_r($tempLrDate);exit;

		  //print_r($trip_body);

		   /*$trip_body = DB::select("SELECT t1.VEHICLE_NO,t1.LR_STATUS,t2.DO_NO,t2.SLNO,t1.TRIP_NO,t1.TO_PLACE FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID WHERE t1.VEHICLE_NO = '$tempVehicleNo' AND t2.DO_NO = '$tempDoNumber' AND t1.TO_PLACE='$tempToPlace'");*/
		  // 	dd(DB::getQueryLog());
        //
//
		   //	print_r($trip_body);
		
       		if($trip_body){

       			foreach($trip_body as $key){

       					$dataDo = array(

       						'DO_NUMBER' => 'NO',
       						'TRIP_NO' =>$key->TRIP_NO,
       					);

       				 if($tempDoNumber){

       				 	$update =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigDo,$tempDoNumber)->where($ConfigVehicle,$tempVehicleNo)->where($ConfigSlNo,$tempSlNo)->update($dataDo);
       				 }else{
       				 	$update =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigVehicle,$tempVehicleNo)->where($ConfigSlNo,$tempSlNo)->update($dataDo);
       				 }
       			  

       			}

       		}else{

       			
       			$dataDo1 = array(

       						'DO_NUMBER' => 'YES',
       						
       					);

       			if($tempDoNumber){
       				$update =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigDo,$tempDoNumber)->where($ConfigVehicle,$tempVehicleNo)->where($ConfigSlNo,$tempSlNo)->update($dataDo1);
       			}else{
       				$update =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigVehicle,$tempVehicleNo)->where($ConfigSlNo,$tempSlNo)->update($dataDo1);
       			}
       		 

       		}    	

       		/*$item_code = DB::table('MASTER_ITEM')->where('ITEM_CODE',$tempItemCode)->get()->toArray();

       		if($item_code){

       			

       		}else{

       			$dataitem = array(

       				'ITEM_STATUS' => 'YES',

       			);

       		  $update1 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigItem,$tempItemCode)->update($dataitem);

       		}

       		$acc_name = DB::table('MASTER_ACC')->where('ACC_NAME',$tempAccName)->get()->toArray();
       		

       		if($acc_name){

       			

       		}else{

       			$dataAcc = array(

       				'ACC_STATUS' => 'YES',

       			);

       		  $update2 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigAcc,$tempAccName)->update($dataAcc);

       		}*/
       	



       }

 
      //exit;

            /*for ($x = 0; $x < $tripPlanArrayCount; $x++) {

	           

				       	$dataDO = array(

		       				'DO_NUMBER' => 'YES',

		       			);


       		         	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigDo,$tripPlanArray[$x])->where($ConfigItem,$tripPlanArrayItem[$x])->update($dataDO);

		       			
		       		}*/
              
      
//exit;

		       		$NewData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_NUMBER ='NO' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

		       		$CityDoData = DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE CITY_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

		       		$AccData = DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE ACC_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

		       		

                    $new_data_count = count($NewData);

                    $city_do_count = count($CityDoData);

                    $acc_count = count($AccData);


			       	if($saveData) {

			    			$response_array['response'] = 'success';
			    			$response_array['new_data_count'] = $new_data_count;
			    			$response_array['city_do_count'] = $city_do_count;
			    			$response_array['acc_count'] = $acc_count;
			    		
				            echo $data = json_encode($response_array);
				         
						}else{

							$response_array['response'] = 'error';
							$response_array['new_data_count'] = '';
							$response_array['city_do_count'] ='';
							$response_array['acc_count'] = '';
							$response_array['trip_no'] = $trip_body;
				            $data = json_encode($response_array);
				            print_r($data);
							
						}
			       	
            
    }

    public function OutwardTrans(Request $request){

        $title = 'Add Outward Transaction';

        $CompanyCode   = $request->session()->get('company_name');
        $MaccYear      = $request->session()->get('macc_year');
        $getcomcode    = explode('-', $CompanyCode);
        $CCFromSession = $getcomcode[0];

        $userData['acc_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->get();
        
        $userData['user_list'] = DB::table('MASTER_DEPOT')->get();
        
        $userData['area_list'] = DB::table('MASTER_AREA')->get();
        $userData['item_list'] = DB::table('MASTER_ITEM')->get();
        $TrCode='';
        
        //DB::enableQueryLog();

        $userData['vehicleNo_list']  = DB::table('CFOUTWARD_TRAN')->where('LR_STATUS','0')->groupBy('TRIP_NO')->get();

       // print_r($userData['vehicleNo_list']);exit();
        $item_um_aum_list = DB::table('MASTER_FY')->where(['COMP_CODE'=>$CCFromSession,'FY_CODE'=>$MaccYear])->get();

        //dd(DB::getQueryLog());

                foreach ($item_um_aum_list as $key) {
                $userData['fromDate'] =  $key->FY_FROM_DATE;
                $userData['toDate']   =  $key->FY_TO_DATE;
                }

        $user_type = $request->session()->get('user_type');

        $userid = $request->session()->get('userid');

        


        return view('admin.finance.transaction.candf.add_outward',$userData+compact('title'));
    }

    public function EditOutwardTrans(Request $request,$tran_code,$vrno,$series_code,$comp_code,$fy_code,$trpt_type){

	     
		$trans_Code =  base64_decode($tran_code);
		$vrNo =  base64_decode($vrno);
		$series_Code =  base64_decode($series_code);
		$comp_Code =  base64_decode($comp_code);
		$fy_Code =  base64_decode($fy_code);
		$trpt_Type =  base64_decode($trpt_type);

		$title       = 'Edit Outward Lr';
		//$head_id     = base64_decode($headid);
		$compDetails = $request->session()->get('company_name');
		$splitcomp   = explode('-', $compDetails);
		$compCode   = $splitcomp[0];
		$fisYear     =  $request->session()->get('macc_year');

		if($trans_Code!='' && $vrNo!='' && $series_Code!='' && $comp_Code!='' && $fy_Code!=''){

		$userData['acc_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->get();
        
        $userData['user_list'] = DB::table('MASTER_DEPOT')->get();
        
        $userData['area_list'] = DB::table('MASTER_AREA')->get();
        $userData['item_list'] = DB::table('MASTER_ITEM')->get();
        $TrCode='';
        
        //DB::enableQueryLog();

        $userData['vehicleNo_list']  = DB::table('CFOUTWARD_TRAN')->where('LR_STATUS','0')->groupBy('VEHICLE_NO')->get();

        $item_um_aum_list = DB::table('MASTER_FY')->where(['COMP_CODE'=>$compCode,'FY_CODE'=>$fisYear])->get();

        //dd(DB::getQueryLog());

                foreach ($item_um_aum_list as $key) {
                $userData['fromDate'] =  $key->FY_FROM_DATE;
                $userData['toDate']   =  $key->FY_TO_DATE;
                }

        $user_type = $request->session()->get('user_type');

        $userid = $request->session()->get('userid');



		 /*$userData['outward_data'] = DB::table('CFOUTWARD_TRAN')->where('COMP_CODE',$comp_Code)->where('FY_CODE',$fy_Code)->where('TRAN_CODE',$trans_Code)->where('SERIES_CODE',$series_Code)->where('VRNO',$vrNo)->get()->toArray();*/

		 if($trpt_Type='SELF' || $trpt_Type='SISTER_CONCERN'){

		 	$outward_data = DB::select("SELECT t1.*,t2.SLR_FLAG,t2.COMP_CODE AS compCode,t2.FY_CODE as FyCode,t2.TRIPHID FROM CFOUTWARD_TRAN t1 LEFT JOIN TRIP_HEAD t2 ON t1.VEHICLE_NO = t2.VEHICLE_NO AND t1.TRIP_NO = t2.TRIP_NO AND t1.TRIPHID = t2.TRIPHID WHERE t1.COMP_CODE='$comp_Code' AND t1.FY_CODE='$fy_Code' AND  t1.SERIES_CODE='$series_Code' AND t1.VRNO='$vrNo' AND t1.TRAN_CODE='$trans_Code' GROUP BY t1.CFOUTWARDID");
		 }else{

		 	$outward_data = DB::select("SELECT t1.* FROM CFOUTWARD_TRAN t1  WHERE t1.COMP_CODE='$comp_Code' AND t1.FY_CODE='$fy_Code' AND  t1.SERIES_CODE='$series_Code' AND t1.VRNO='$vrNo' AND t1.TRAN_CODE='$trans_Code' GROUP BY t1.CFOUTWARDID");
		 }
		 

		/* echo'<PRE>';

		 print_r($userData['outward_data']);exit;

		echo'</PRE>';*/
		 	return view('admin.finance.transaction.candf.edit_outward',$userData+compact('title','outward_data'));
		}
/*
    	if($head_id!=''){
    	    $query = DB::table('TRIP_HEAD');
			$query->where('TRIPHID', $head_id);
			$userData['tripPlanningData']= $query->get()->first();

			$userData['tripPlanbodyData'] = DB::select("SELECT * FROM TRIP_BODY WHERE TRIPHID='$head_id'");
			
			$userData['vehicle_list']    = DB::table('MASTER_FLEET')->get();

			$userData['transport_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();

			return view('admin.finance.transaction.logistic.edit_trip_planning',$userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Fleet Not Found...!');
			return redirect('/view-mast-fleet');
		}*/
    }


    public function DeleteOutwardTransLr(Request $request){

     	$deleteData = $request->input('deletdata');

     	$slitData = explode('~',$deleteData);

		$lsComp_code   = $slitData[0];
		$lsfy_code     = $slitData[1];
		$lstran_code   = $slitData[2];
		$lsseries_code = $slitData[3];
		$lsVrno        = $slitData[4];
		$lsgateInId    = $slitData[5];
		$lsVehicle     = $slitData[6];
		$tripHid       = $slitData[7];
		$trptType      = $slitData[8];

		print_r($tripHid);exit;

		DB::beginTransaction();

		try {

			if(($lsComp_code !='') && ($lsfy_code !='') && ($lstran_code !='') && ($lsseries_code !='') && ($lsVrno !='') && ($lsgateInId !='') && ($lsVehicle !='')){

				$cfOutData = DB::select("SELECT * FROM CFOUTWARD_TRAN WHERE COMP_CODE='$lsComp_code' AND FY_CODE='$lsfy_code' AND TRAN_CODE='$lstran_code' AND SERIES_CODE='$lsseries_code' AND VRNO='$lsVrno' AND CFGATEID='$lsgateInId' AND VEHICLE_NO='$lsVehicle'");

				for ($i = 0; $i <count($cfOutData);$i++) {

					/*$getInwardId = DB::select("SELECT * FROM CFOUTWARD_TRAN WHERE COMP_CODE='$lsComp_code' AND FY_CODE='$lsfy_code' AND TRAN_CODE='$lstran_code' AND SERIES_CODE='$lsseries_code' AND VRNO='$lsVrno' AND CFGATEID='$lsgateInId' AND VEHICLE_NO='$lsVehicle'");*/
					
					$inwardTBLId = $cfOutData[$i]->CFINWARDID;
					$outwardIssue = $cfOutData[$i]->QTYISSUED;
					$outwardIssueAqty = $cfOutData[$i]->AQTISSUED;
					$cfoutwardId  = $cfOutData[$i]->CFOUTWARDID;

					$getInwardIssue = DB::table('CFINWARD_TRAN')->where('CFINWARDID',$inwardTBLId)->get()->first();

					$inwardIssue_Qty = $getInwardIssue->QTYISSUED;
					$inwardIssue_AQty = $getInwardIssue->AQTISSUED;
					$inwardlSQty     = $getInwardIssue->LOADSLIP_QTY;

					$issueQty = floatval($inwardIssue_Qty) - floatval($outwardIssue);
					$issueAQty = floatval($inwardIssue_AQty) - floatval($outwardIssueAqty);

					$lsQty = floatval($inwardlSQty) + floatval($outwardIssue);

					//print_r($outwardIssue);

					$loadQty = array(
						'LOADSLIP_QTY' =>$lsQty,
						'QTYISSUED' =>$issueQty,
						'AQTISSUED' =>$issueAQty,
						'LOADING_SLIP_STATUS'=>'0',
						'NET_WEIGHT'=>'0.000',
					);


					DB::table('CFINWARD_TRAN')->where('CFINWARDID',$inwardTBLId)->update($loadQty);


					$outwardStatus =array(

						'LR_STATUS'=>'0',
						'QTYISSUED'=>'0.000',
						'TARE_WEIGHT'=>'0.000',
						'GROSS_WEIGHT'=>'0.000',
						'NET_WEIGHT'=>'0.000',

					);

					DB::table('CFOUTWARD_TRAN')->where('cfoutwardId',$cfoutwardId)->where('COMP_CODE',$lsComp_code)->where('FY_CODE',$lsfy_code)->where('TRAN_CODE',$lstran_code)->where('SERIES_CODE', $lsseries_code)->where('VRNO',$lsVrno)->where('VEHICLE_NO',$lsVehicle)->update($outwardStatus);

					DB::table('CFSTOCK_LEDGER')->where('COMP_CODE',$lsComp_code)->where('FY_CODE',$lsfy_code)->where('TRAN_CODE',$lstran_code)->where('SERIES_CODE',$lsseries_code)->where('VRNO',$lsVrno)->delete();

				}

			//	exit;

				/* ------- DELETE DATA FROM CFOUTWARD ------ */

					/*DB::table('CFOUTWARD_TRAN')->where('COMP_CODE',$lsComp_code)->where('FY_CODE',$lsfy_code)->where('TRAN_CODE',$lstran_code)->where('SERIES_CODE', $lsseries_code)->where('VRNO',$lsVrno)->where('CFGATEID', $lsgateInId)->where('VEHICLE_NO',$lsVehicle)->delete();
*/
					
				/* ------- DELETE DATA FROM CFOUTWARD ------ */

				/* --------- REMOVE STATUS FROM GATE ENTRY TABLE ------ */

					/*$loadingStatus = array(
						'LOADING_SLIP_STATUS' => '0',
						'CFOUTWARDID' => '0'
					);
					
					DB::table('CF_GATE_ENTRY')->where('CFGATEID',$lsgateInId)->where('VEHICLE_NUMBER',$lsVehicle)->update($loadingStatus);*/



					if($trptType=='SELF' || $trptType='SISTER_CONCERN'){	

						$tripHead =array(

							'LR_STATUS' =>'0'
						);

				      DB::table('TRIP_HEAD')->where('TRIPHID',$tripHid)->where('VEHICLE_NO',$lsVehicle)->update($tripHead);
					}
				/* --------- REMOVE STATUS FROM GATE ENTRY TABLE ------ */

			} /* /.IF CODN*/

			DB::commit();

			$request->session()->flash('alert-success', 'Outward Lr Was Deleted Successfully...!');
			return redirect('/transaction/CandF/view-outward-trans');

		}catch (\Exception $e) {

	        DB::rollBack();
	       // throw $e;
	        $request->session()->flash('alert-error', 'Outward Lr Not Found...!');
		   return redirect('/transaction/CandF/view-outward-trans');
	    	}

     }/* /.MAIN FUNCTION */


    public function SaveoOutwardDispatch(Request $request)
    {
    		/*echo '<pre>';

          	print_r($request->post());exit;

          	echo '</pre>';*/

    	    $userId             = $request->session()->get('userid');
			$CompanyCode        = $request->session()->get('company_name');
			$compcode           = explode('-', $CompanyCode);
			$comp_code          =	$compcode[0];
			$fisYear            =  $request->session()->get('macc_year');
			$db_name            = $request->session()->get('dbName');
	
			$vrDate             = $request->input('transaction_date');
			$sl_no              = $request->input('slno');
			$tran_code          = $request->input('tran_code');
			$series_code        = $request->input('series_code');
			$series_name        = $request->input('series_name');
			$pfct_code          = $request->input('pfct_code');
			$pfct_name          = $request->input('pfct_name');
			$plant_code         = $request->input('plant_code');
			$plant_name         = $request->input('plant_name');
			$headid             = $request->input('headid');
			$acc_code           = $request->input('customer_code');
			$acc_name           = $request->input('custmoer_name');
			$custmoer_add       = $request->input('custmoer_add');
			
		
			$outwardId          = $request->input('body_id');
			$vrno               = $request->input('VrNo');
			$vehicle_no1         = $request->input('vehicle_no');
			$vehicleExplode = explode('~', $vehicle_no1);
			$vehicle_no = $vehicleExplode[0];

			$rake_no            = $request->input('rake_no');
			$rake_date          = $request->input('rake_date');
			$place_date         = $request->input('place_date');
			$vr_date            = $request->input('vr_date');
			
			$invoice_no         = $request->input('invoice_no');
			$invoiceDate        = $request->input('invoice_date');
			$cp_code            = $request->input('cp_code');
			$cp_name            = $request->input('cp_name');
			$cp_add             = $request->input('cp_add');
			$sp_code            = $request->input('sp_code');
			$sp_name            = $request->input('sp_name');
			$sp_add             = $request->input('sp_add');
			$do_no              = $request->input('do_no');
			$doDate             = $request->input('do_date');
			$item_code          = $request->input('item_code');
			$item_name          = $request->input('item_name');
			$itemRemark        = $request->input('item_remark');
			$lr_no              = $request->input('lr_no');
			$uniqslNo           = $request->input('uniqLrNo');
			$lrDate             = $request->input('lr_date');
			$wagon_no           = $request->input('wagon_no');
			$wagonDate          = $request->input('wagon_date');
			$qty_recd           = $request->input('qty');
			$issue_qty          = $request->input('issue_qty');
			$qty_Arecd          = $request->input('qty_Arecd');
			$unit_M             = $request->input('unit_M');
			$Aqty               = $request->input('issue_Aqty');
			$Aum                = $request->input('Aum');
			$delivery_no        = $request->input('delivery_no');
			$ebill_no           = $request->input('ewaybill_no');
			$ewaybill_date      = $request->input('ewaybill_date');
			$batch_no           = $request->input('batch_no');
			$length             = $request->input('length');
			$width              = $request->input('width');
			$height             = $request->input('height');
			$odc                = $request->input('odc');
			$tare_qty           = $request->input('tare_qty');
			$gross_qty          = $request->input('gross_qty');
			$net_qty            = $request->input('net_qty');
			
			$obd_no             = $request->input('obd_no');
			$cam_no             = $request->input('cam_no');
			$trpt_code          = $request->input('transporter_code');
			$trpt_name          = $request->input('transporter_name');
			$route_code         = $request->input('route_code');
			$route_name         = $request->input('route_name');
			$from_place         = $request->input('from_place');
			$to_place           = $request->input('to_place');
			$temp_to_place      = $request->input('temp_to_place');

			$driver_name        = $request->input('driver_name');
			$mobile_no          = $request->input('mobile_no');
			$trip_type          = $request->input('trip_type');
			$vr_date            = $request->input('vr_date');
			$lr_remark          = $request->input('lr_remark');
			$material_value     = $request->input('material_value');
			$tri_days           = $request->input('tri_days');
			$vehicle_type       = $request->input('vehicle_type');
			$inwardId           = $request->input('inwardId');
			$cfgateId           = $request->input('cfgateId');
			

			$trip_headid        = $request->input('trip_headid');
			$trip_accCode       = $request->input('trip_accCode');
			$trip_accName       = $request->input('trip_accName');
			$trip_comp          = $request->input('trip_comp');
			$trip_fycode        = $request->input('trip_fycode');
			$trip_pfctCode      = $request->input('trip_pfctCode');
			$trip_seriesCode    = $request->input('trip_seriesCode');
			$trip_seriesName    = $request->input('trip_seriesName');
			$trip_pfctName      = $request->input('trip_pfctName');
			$trip_tranCode      = $request->input('trip_tranCode');
			$trip_vrDate        = $request->input('trip_vrDate');
			$trip_vehicleType   = $request->input('trip_vehicleType');
			$vehicle_model      = $request->input('trip_vehicleModel');
			$tripNo             = $request->input('tripNo');
			$sr_flag            = $request->input('sr_flag');
			$getEntryVrNo       = $request->input('getEntryVrNo');
			$loading_status     = $request->input('loading_status');
			$wayment_weight     = $request->input('wayment_weight');

			$cpCode = $cp_code;
			$spCode = $sp_code;
			$LrNo   =array_unique($lr_no);
            $LrNoCount = count($LrNo);

	     	$cpCodeCount = count($cpCode);

	     	//print_r($cpCode);exit;
		
			//$sr_flag =1;
			
			$pdfPageName        = 'OUTWARD DISPATCH';
			$count              = count($item_code);

			$donwloadStatus   = $request->input('pdfYesNoStatus');

			$trip_Date =  date('Y-m-d', strtotime($vrDate. ' + '.$tri_days.' days'));

			//$tripDate = date('Y-m-d',strtotime($trip_Date));

			//print_r($trip_Date);exit;

			//$day = date('D', strtotime($vrDate));
            //var_dump($day);
			///print_r($day);exit;

	    /* print_r($vrno);
	     print_r($series_code);
	     print_r($comp_code);exit;*/

	    // print_r($odc);exit();
			
		DB::beginTransaction();

		try {

			DB::table('CFOUTWARD_TRAN')->where('VRNO',$vrno)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->delete();
			
			if($trip_type=='SELF' || $trip_type=='SISTER_CONCERN'){

				if($tripNo){

					DB::table('TRIP_BODY')->where('TRIPHID',$trip_headid)->delete();
				}


				      if($sr_flag=='1'){

						        $StoreH = DB::select("SELECT MAX(TRIPHID) as TRIPHID   FROM TRIP_HEAD");
								$headID = json_decode(json_encode($StoreH), true); 
							  
							    if(empty($headID[0]['TRIPHID'])){
									$headId = 1;
								}else{
									$headId = $headID[0]['TRIPHID']+1;
								}

								 $stripVrno = DB::select("SELECT MAX(VRNO) as VRNO FROM TRIP_HEAD");
				                    $stripHVrno = json_decode(json_encode($stripVrno), true); 
				                    if(empty($stripHVrno[0]['VRNO'])){
				                        $vrnoTemp = 1;
				                    }else{
				                        $vrnoTemp = $stripHVrno[0]['VRNO']+1;

				                    }
								  	    $splitTripNo = explode(' ',$tripNo);
								  	    $tripFyCode  = $splitTripNo[0];
					                    $tripSeries  = $splitTripNo[1];
					                    $stripVrno   = $splitTripNo[2];

					                    //$vrnoTemp    =  $stripVrno + 1; 
					                    $tripNoTemp    =  $tripFyCode.' '.$tripSeries.' '.$vrnoTemp;

					                  $getRoute = DB::table('MASTER_FREIGHT_ROUTE')->where('FROM_PLACE',$from_place)->where('TO_PLACE',$temp_to_place)->get()->first();

						                  if($getRoute){
						                    	$route_code = $getRoute->ROUTE_CODE;
						                    	$route_name = $getRoute->ROUTE_NAME;
						                    }else{

						                    	$route_code ='';
						                    	$route_name ='';
						                    }

						          // DB::enableQueryLog();

						         $fso_data = DB::select("SELECT FSO_BODY.*,FSO_HEAD.REF_NO FROM FSO_BODY LEFT JOIN FSO_HEAD ON FSO_HEAD.FSOHID = FSO_BODY.FSOHID WHERE FSO_BODY.COMP_CODE='$trip_comp' AND FSO_BODY.ACC_CODE='$trip_accCode' AND FSO_BODY.VEHICLE_TYPE='$trip_vehicleType' AND '$trip_vrDate' BETWEEN FSO_BODY.VALID_FROM_DATE AND FSO_BODY.VALID_TO_DATE AND FSO_BODY.PLANT_CODE='$plant_code'  AND FSO_BODY.TO_PLACE LIKE '%$temp_to_place%'");


						         if($fso_data){

						         	$fshid = $fso_data[0]->FSOHID;
						         	$fsbid = $fso_data[0]->FSOBID;
						         	$fso_rate = $fso_data[0]->RATE;

						         }else{

						         	$fshid = '';
						         	$fsbid = '';
						         	$fso_rate = '';

						         }

						        // dd(DB::getQueryLog());

						         //print_r($fso_data);exit;

								$InsertTripHead = array(

									'TRIPHID'        => $headId,
									'COMP_CODE'      =>$trip_comp,
			                        'FY_CODE'        =>$trip_fycode,
			                        'PFCT_CODE'      =>$trip_pfctCode,
			                        'PFCT_NAME'      =>$trip_pfctName,
			                        'TRAN_CODE'      =>$trip_tranCode,
			                        'SERIES_CODE'    =>$trip_seriesCode,
			                        'SERIES_NAME'    =>$trip_seriesName,
			                        'VRNO'           =>$vrnoTemp,
			                        'ACC_CODE'       =>$trip_accCode,
			                        'ACC_NAME'       =>$trip_accName,
			                        'VRDATE'         =>$trip_vrDate,
			                        'TRIP_NO'        =>$tripNoTemp,
									'PLANT_CODE'     =>$plant_code,
									'PLANT_NAME'     =>$plant_name,
									"VEHICLE_NO"     =>$vehicle_no,
									"FROM_PLACE"     =>$from_place, 
									"TO_PLACE"       =>$temp_to_place,
									"ROUTE_CODE"     =>$route_code,
									"ROUTE_NAME"     =>$route_name,
									"TRANSPORT_CODE" =>$trpt_code, 
									"TRANSPORT_NAME" =>$trpt_name, 
									"FSOHID"         =>$fshid, 
									"FSOBID"         =>$fsbid, 
									"FSO_RATE"       =>$fso_rate,
									"SLR_STATUS"     =>'1', 
									"SLR_FLAG"       =>'1', 
									"SLRTRIPHID"     =>$trip_headid, 
									"CREATED_BY"     =>$userId,
									
									
								);
						
                   		 $saveData  =  DB::table('TRIP_HEAD')->insert($InsertTripHead);

                   		 $checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trip_tranCode)->where('SERIES_CODE',$trip_seriesCode)->where('COMP_CODE',$trip_comp)->where('FY_CODE',$fisYear)->get()->toArray();
			
									if(empty($checkvrnoExist)){

										$datavrnIn =array(
											'COMP_CODE'   =>$trip_comp,
											'FY_CODE'     =>$fisYear,
											'TRAN_CODE'   =>$trip_tranCode,
											'SERIES_CODE' =>$trip_seriesCode,
											'FROM_NO'     =>1,
											'TO_NO'       =>99999,
											'LAST_NO'     =>$vrnoTemp,
											'CREATED_BY'  =>$createdBy,
										);

										DB::table('MASTER_VRSEQ')->insert($datavrnIn);

									}else{
										$datavrn =array(
											'LAST_NO'=>$vrnoTemp
										);
										DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trip_tranCode)->where('SERIES_CODE',$trip_seriesCode)->where('COMP_CODE',$trip_comp)->where('FY_CODE',$fisYear)->update($datavrn);
									}


                   }

              }


              //print_r($count);exit;


		for($i = 0; $i < $count; $i++){



			$invoice_date     = date("Y-m-d", strtotime($invoiceDate[$i]));
			$do_date          = date("Y-m-d", strtotime($doDate[$i]));
			$lr_date          = date("Y-m-d", strtotime($lrDate[$i]));
			$wagon_date       = date("Y-m-d", strtotime($wagonDate[$i]));
			$ewaybillDate       = date("Y-m-d", strtotime($ewaybill_date[$i]));
			
			if($Aqty[$i]==''){
				$aqty ='0.000';
			}else{
				$aqty= $Aqty[$i];
			}

			$slno = $i+1;


			if(isset($itemRemark[$i])){
				$mremakr = $itemRemark[$i];
			}else{
				$mremakr =$item_name[$i];
			}

			//print_r($itemRemark[$i]);
			
			$data = array(
                   
                    'COMP_CODE'     =>$comp_code,
                    'FY_CODE'       =>$fisYear,
                    'RAKE_NO'       =>$rake_no,
                    'CFINWARDID'    =>$inwardId[$i],
                    'RAKE_DATE'     =>date("Y-m-d", strtotime($request->input('rake_date'))),
                    'PLACE_DATE'    =>date("Y-m-d", strtotime($request->input('place_date'))),
                    'PFCT_CODE'     =>$pfct_code,
                    'PFCT_NAME'     =>$pfct_name,
                    'PLANT_CODE'    =>$plant_code,
                    'PLANT_NAME'    =>$plant_name,
                    'TRAN_CODE'     =>$tran_code,
                    'SERIES_CODE'   =>$series_code,
                    'SERIES_NAME'   =>$series_name,
                    'VRNO'          =>$vrno,
                    'SLNO'          =>$slno,
                    'TRIP_NO'       =>$tripNo,
                    'ACC_CODE'      =>$acc_code,
                    'ACC_NAME'      =>$acc_name,
                    'ACC_ADD'       =>$custmoer_add,
                    'VRDATE'        =>date("Y-m-d", strtotime($request->input('vr_date'))),
                    'ORDER_NO'      =>$do_no[$i],
                    'ORDER_DATE'    =>$do_date,
                    'CP_CODE'       =>$cp_code[$i],
                    'CP_NAME'       =>$cp_name[$i],
                    'LR_SLNO'       =>$uniqslNo[$i],
                    'LR_NO'         =>$lr_no[$i],
                    'LR_DATE'       =>$lr_date,
                    'CP_ADD'        =>$cp_add[$i],
                    'SP_CODE'       =>$sp_code[$i],
                    'SP_NAME'       =>$sp_name[$i],
                    'SP_ADD'        =>$sp_add[$i],
                    'ROUTE_CODE'    =>$route_code,
                    'ROUTE_NAME'    =>$route_name,
                    'FROM_PLACE'    =>$from_place,
                    'TO_PLACE'      =>$to_place,
                    'WEYMENT_WEIGHT'=>$wayment_weight,
                    'BATCH_NO'      =>$batch_no[$i],
                    'ALIAS_CODE'    =>'',
                    'ALIAS_NAME'    =>'',
                    'ITEM_CODE'     =>$item_code[$i],
                    'ITEM_NAME'     =>$item_name[$i],
                    'LENGTH'        =>$length[$i],
                    'WIDTH'         =>$width[$i],
                    'HEIGHT'        =>$height[$i],
                    'ODC'           =>$odc[$i],
                    'REMARK'        =>$mremakr,
                    'QTY'           =>$qty_recd[$i],
                    'QTYISSUED'     =>$issue_qty[$i],
                    'UM'            =>$unit_M[$i],
                    'AQTY'          =>$aqty,
                    'AQTISSUED'     =>$aqty,
                    'TARE_WEIGHT'   =>$tare_qty[$i],
                    'GROSS_WEIGHT'  =>$gross_qty[$i],
                    'NET_WEIGHT'    =>$net_qty[$i],
                    'AUM'           =>$Aum[$i],
                    'CFACTOR'       =>'',
                    'INVOICE_NO'    =>$invoice_no[$i],
                    'INVOICE_DATE'  =>$invoice_date,
                    'WAGON_NO'      =>$wagon_no[$i],
                    'WAGON_DATE'    =>$wagon_date,
                    'OBD_NO'        =>$obd_no[$i],
                    'DELIVERY_NO'   =>$delivery_no[$i],
                    'EWAY_BILL_NO'  =>$ebill_no[$i],
                    'EWAY_BILL_DT'  =>$ewaybillDate,
                    'CAM_NO'        =>$cam_no[$i],
                    'GATEIN_ID'     =>'',
                    'INWARD_DATE'   =>'',
                    'TRPT_TYPE'     =>$trip_type,
                    'TRPT_CODE'     =>$trpt_code,
                    'TRPT_NAME'     =>$trpt_name,
                    'VEHICLE_NO'    =>$vehicle_no,
                    'VEHICLE_TYPE'  =>$vehicle_type,
                    'VEHICLE_MODEL' =>$vehicle_model,
                    'TRIP_DATE'     =>$trip_Date,
                    'LCONT_CODE'    =>'',
                    'LCONT_NAME'    =>'',
                    'LOCATION_CODE' =>'',
                    'LOCATION_NAME' =>'',
                    'DRIVER_NAME'   =>$driver_name,
                    'DRIVER_ID'     =>'',
                    'MOBILE_NUMBER' =>$mobile_no,
                    'LR_REMARK'     =>$lr_remark,
                    'MATERIAL_VALUE'=>$material_value[$i],
                    'TRIP_DAYS'     =>$tri_days,
                    'REFTRIP_COMPCODE' =>$trip_comp,
                    'REFTRIP_FYCODE'   =>$trip_fycode,
                    'FLAG'          =>1,
                    'LR_STATUS'     =>1,
                    'LOADING_PLAN_STATUS'     =>'1',
                    'LOADING_STATUS' =>$loading_status[$i],
                    'CFGATEID'       =>$cfgateId,
                    'CREATED_BY'     =>$userId,
                );

    	
           $saveData = DB::table('CFOUTWARD_TRAN')->insert($data);

            $outwardId = DB::getPdo()->lastInsertId();


           /* $getInwardData = DB::table('CFINWARD_TRAN')->where('CFINWARDID',$inwardId[$i])->where('BATCH_NO',$batch_no[$i])->where('ORDER_NO',$do_no[$i])->get()->first();*/
            $getInwardData = DB::table('CFINWARD_TRAN')->where('CFINWARDID',$inwardId[$i])->get()->first();

            $inwardIssue_Qty = $getInwardData->QTYISSUED;
            $inwardIssue_AQty = $getInwardData->AQTISSUED;
            $inwardRecd_Qty  = $getInwardData->QTYRECD;
            $inwardLs_Qty    = $getInwardData->LOADSLIP_QTY;
            $phy_verify      = $getInwardData->PHY_VERIFY;

            $newissuedqty =   floatval($issue_qty[$i]) + floatval($inwardIssue_Qty);

            $newissuedAqty =   floatval($aqty) + floatval($inwardIssue_AQty);

            $totalLsQty =     floatval($inwardRecd_Qty)  - floatval($newissuedqty);

            $loadslipQty = floatval($inwardLs_Qty) -  floatval($issue_qty[$i]);
 
            if($totalLsQty=='0'){
           		$loadingStatus ='1';
           	}else{
           		$loadingStatus ='0';
           	}

            if($phy_verify=='0'){
            	$phy_verification ='1';
            }else{
            	$phy_verification ='0';
            }

             	$data_update = array(

             		'QTYISSUED' => $newissuedqty,
             		'AQTISSUED' => $newissuedAqty,
             		'LOADING_SLIP_STATUS'=>$loadingStatus,
             		'PHY_VERIFY'  =>$phy_verification,
             		'NET_WEIGHT'=>$net_qty[$i],
             		'LOADSLIP_QTY'=>$loadslipQty,
             	);

            $updateInward = DB::table('CFINWARD_TRAN')->where('CFINWARDID',$inwardId[$i])->update($data_update);

             /* ------- UPDATE IN CS GATE ENTRY ---------- */

                $dataVehicle = array('CFOUTWARDID' => '1');

               /* DB::table('CF_GATE_ENTRY')->where('CFGATEID',$cfgateId)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('VEHICLE_TYPE','TRIP')->where('VRNO',$getEntryVrNo)->where('CFOUTWARDID','0')->where('VEHICLE_NUMBER',$vehicle_no)->update($dataVehicle);*/

               DB::table('CF_GATE_ENTRY')->where('CFGATEID',$cfgateId)->where('VEHICLE_NUMBER',$vehicle_no)->update($dataVehicle);

            /* ------- UPDATE IN CS GATE ENTRY ---------- */


            if($trip_type=='SELF' || $trip_type=='SISTER_CONCERN'){



	             /* ------ INSERT IN TRIP BODY ------ */

                    $tripB = DB::select("SELECT MAX(TRIPBID) as TRIPBID FROM TRIP_BODY");
                    $tripBID = json_decode(json_encode($tripB), true); 
                    if(empty($tripBID[0]['TRIPBID'])){
                        $tripBody_Id = 1;
                    }else{
                        $tripBody_Id = $tripBID[0]['TRIPBID']+1;
                    }

                    $splitTripNo = explode(' ',$tripNo);
                    $tripSeries  = $splitTripNo[1];
                    $stripVrno   = $splitTripNo[2];

                    if($sr_flag==1){

                    	$cpAccCode = $cp_code[$i];
                    	$cpAccName = $cp_name[$i];
                    	

                    }else{

                    	$cpAccCode = $trip_accCode;
                    	$cpAccName = $trip_accName;
                    	
                    }

                  //  DB::enableQueryLog();

                    $InsertTrip = array(

                        'TRIPHID'       =>$trip_headid,
                        'TRIPBID'       =>$tripBody_Id,
                        'COMP_CODE'     =>$trip_comp,
                        'FY_CODE'       =>$trip_fycode,
                        'PFCT_CODE'     =>$trip_pfctCode,
                        'TRAN_CODE'     =>$trip_tranCode,
                        'SERIES_CODE'   =>$trip_seriesCode,
                        'VRNO'          =>$stripVrno,
                        'SLNO'          =>$slno,
                        'ACC_CODE'      =>$cpAccCode,
                        'ACC_NAME'      =>$cpAccName,
                        'VRDATE'        =>$trip_vrDate,
                        'TRIP_NO'       =>$tripNo,
                        'INVC_NO'       =>$invoice_no[$i],
                        'INVC_DATE'     =>$invoice_date,
                        'DO_NO'         =>$do_no[$i],
                        'DO_DATE'       =>$do_date,
                        'WAGON_NO'      =>$wagon_no[$i],
                        'LR_NO'         =>$lr_no[$i],
                        'LR_DATE'       =>$lr_date,
                        'VEHICLE_NO'    =>$vehicle_no,
                        'EBILL_NO'      =>$ebill_no[$i],
                        'EWAYB_VALIDDT' =>$ewaybillDate,
                        'BATCH_NO'      =>$batch_no[$i],
                        'ITEM_CODE'     =>$item_code[$i],
                        'ITEM_NAME'     =>$item_name[$i],
                        'REMARK'        =>$mremakr,
                        'CP_CODE'       =>$cp_code[$i],
                        'CP_NAME'       =>$cp_name[$i],
                        'SP_CODE'       =>$sp_code[$i],
                        'SP_NAME'       =>$sp_name[$i],
                        'FROM_PLACE'    =>$from_place,
                        'TO_PLACE'      =>$to_place,
                        'QTY'           =>$qty_recd[$i],
                        'ISSUED_QTY'    =>$issue_qty[$i],
                        'UM'            =>$unit_M[$i],
                        'AQTY'          =>$aqty,
                        'AUM'           =>$Aum[$i],
                        'NET_WEIGHT'    =>$net_qty[$i],
                        'CREATED_BY'    =>$userId,

                        
                    );

                    DB::table('TRIP_BODY')->insert($InsertTrip);



                      $fso_data_update = DB::select("SELECT FSO_BODY.*,FSO_HEAD.REF_NO FROM FSO_BODY LEFT JOIN FSO_HEAD ON FSO_HEAD.FSOHID = FSO_BODY.FSOHID WHERE FSO_BODY.COMP_CODE='$trip_comp' AND FSO_BODY.ACC_CODE='$cpAccCode' AND FSO_BODY.VEHICLE_TYPE='$trip_vehicleType' AND '$trip_vrDate' BETWEEN FSO_BODY.VALID_FROM_DATE AND FSO_BODY.VALID_TO_DATE AND FSO_BODY.PLANT_CODE='$plant_code'  AND FSO_BODY.TO_PLACE LIKE '%$to_place%'");

                   //dd(DB::getQueryLog());

			         if($fso_data_update){

			         	$fshid_head = $fso_data_update[0]->FSOHID;
			         	$fsbid_head = $fso_data_update[0]->FSOBID;
			         	$fso_rate_head = $fso_data_update[0]->RATE;

			         }else{

			         	$fshid_head = '';
			         	$fsbid_head = '';
			         	$fso_rate_head = '';

			         }

			         


                   if($sr_flag==1){

                   	 $stripB = DB::select("SELECT MAX(TRIPBID) as TRIPBID FROM TRIP_BODY");
                    $stripBID = json_decode(json_encode($stripB), true); 
                    if(empty($stripBID[0]['TRIPBID'])){
                        $sBody_Id = 1;
                    }else{
                        $sBody_Id = $stripBID[0]['TRIPBID']+1;
                    }

                   /* $stripVrno = DB::select("SELECT MAX(VRNO) as VRNO FROM TRIP_HEAD");
                    $stripHVrno = json_decode(json_encode($stripVrno), true); 
                    if(empty($stripHVrno[0]['VRNO'])){
                        $vrnoTemp = 1;
                    }else{
                        $vrnoTemp = $stripHVrno[0]['VRNO']+1;
                    }
*/


                   

                       $tripLrNo =  'SLR '.$lr_no[$i];

                   		$InsertTripBody = array(

                        'TRIPHID'       =>$headId,
                        'TRIPBID'       =>$sBody_Id,
                        'COMP_CODE'     =>$trip_comp,
                        'FY_CODE'       =>$trip_fycode,
                        'PFCT_CODE'     =>$trip_pfctCode,
                        'TRAN_CODE'     =>$trip_tranCode,
                        'SERIES_CODE'   =>$trip_seriesCode,
                        'VRNO'          =>$vrnoTemp,
                        'SLNO'          =>$slno,
                        'ACC_CODE'      =>$trip_accCode,
                        'ACC_NAME'      =>$trip_accName,
                        'VRDATE'        =>$trip_vrDate,
                        'TRIP_NO'       =>$tripNoTemp,
                        'INVC_NO'       =>$invoice_no[$i],
                        'INVC_DATE'     =>$invoice_date,
                        'DO_NO'         =>$do_no[$i],
                        'DO_DATE'       =>$do_date,
                        'WAGON_NO'      =>$wagon_no[$i],
                        'LR_NO'         =>$tripLrNo,
                        'LR_DATE'       =>$lr_date,
                        'VEHICLE_NO'    =>$vehicle_no,
                        'EBILL_NO'      =>$ebill_no[$i],
                        'EWAYB_VALIDDT' =>$ewaybillDate,
                        'BATCH_NO'      =>$batch_no[$i],
                        'ITEM_CODE'     =>$item_code[$i],
                        'ITEM_NAME'     =>$item_name[$i],
                        'REMARK'        =>$mremakr,
                        'CP_CODE'       =>$cp_code[$i],
                        'CP_NAME'       =>$cp_name[$i],
                        'SP_CODE'       =>$sp_code[$i],
                        'SP_NAME'       =>$sp_name[$i],
                        'FROM_PLACE'    =>$from_place,
                        'TO_PLACE'      =>$temp_to_place,
                        'QTY'           =>$qty_recd[$i],
                        'ISSUED_QTY'    =>$issue_qty[$i],
                        'UM'            =>$unit_M[$i],
                        'AQTY'          =>$aqty,
                        'AUM'           =>$Aum[$i],
                        'NET_WEIGHT'    =>$net_qty[$i],
                        'OUTWARDID'     =>$outwardId,
                        'CREATED_BY'    =>$userId,

                        
                    );


                DB::table('TRIP_BODY')->insert($InsertTripBody);



                    $UpdateTripHead =array(

                    	'SLR_STATUS' => '1',


                    );

                   DB::table('TRIP_HEAD')->where('TRIPHID',$headId)->update($UpdateTripHead);
                   } 


                 /* ------ INSERT IN TRIP BODY ------ */

         	}


	    	 $a_qtyIssued = '';
	    	 $particular = '';
	    	 $lot_no = '';
	    	 $alias_code='';
	    	 $alias_name='';
	    	 $cfactor='';
	    	 $qtyrecd='';
	    	 $aqtyrecd='';
	    	 $qtyissued='';
	    	 $aqtyissued='';
	    	 //$item_remark=$mremakr;


	    	$stockItem = (new AccountingController)->InsertStockInStockLedger($comp_code,$rake_no,$rake_date,$place_date,$fisYear,$pfct_code,$pfct_name,$plant_code,$plant_name,$tran_code,$series_code,$vrno,$slno,$acc_code,$acc_name,$vr_date,$do_no[$i],$do_date,$cp_code[$i],$cp_name[$i],$cp_add[$i],$sp_code[$i],$sp_name[$i],$sp_add[$i],$route_code,$route_name,$from_place,$to_place,$batch_no[$i],$issue_qty[$i],$lot_no,$alias_code,$alias_name,$item_code[$i],$item_name[$i],$length[$i],$width[$i],$height[$i],$odc[$i],$mremakr,$issue_qty[$i],$unit_M[$i],$aqty,$Aum[$i],$cfactor,$invoice_no[$i],$invoice_date,$wagon_no[$i],$obd_no[$i],$ebill_no[$i],$ewaybillDate,$cam_no[$i],$vehicle_no,$trpt_code,$trpt_name,$lr_no[$i],$lr_date,$qtyrecd,$aqtyrecd,$issue_qty[$i],$aqty,$net_qty[$i],$userId);


			
		}


		           $trip_head =array(

			         		"ACC_CODE"   =>$cpAccCode, 
			         		"ACC_NAME"   =>$cpAccName, 
			         		"FSOHID"     =>$fshid_head, 
							"FSOBID"     =>$fsbid_head, 
							"FSO_RATE"   =>$fso_rate_head,
							"LR_STATUS"  =>1,
			         );


			        DB::table('TRIP_HEAD')->where('TRIPHID',$trip_headid)->update($trip_head);

			         //print_r($trip_headid);
			      DB::commit();


	       		$transCD = 'DISPATCH_RECEIPT';
	       		$getArr = array($sr_flag);
	       		$pdfarr = array();
				if($donwloadStatus == 1){

					$supp_lr ='LR';

					return $this->GeneratePdfForOutward($userId,$comp_code,$plant_code,$pdfPageName,$transCD,$vrno,$trip_type,$trpt_code,$trpt_name,$vehicle_no,$tri_days,$trip_Date,$vehicle_type,$vehicle_model,$cpCodeCount,$cpCode,$outwardId,$supp_lr,$trip_headid,$spCode,$LrNo,$LrNoCount);

				

				}else{}

				$data1['response'] = 'success';
			//	$data1['party'] = $data1;
	  			$getalldata = json_encode($data1);  
	  			print_r($getalldata);

          }catch (\Exception $e) {

			    DB::rollBack();
			    throw $e;
			    $data1['response'] = 'error';
	  			$getalldata = json_encode($data1);  
	  			print_r($getalldata);
			}




    }


    public function UpdateOutwardDispatch(Request $request){

    	/*echo "<pre>";

    	print_r($request->post());exit;

    	echo "</pre>";*/

    	    $userId             = $request->session()->get('userid');
			$CompanyCode        = $request->session()->get('company_name');
			$compcode           = explode('-', $CompanyCode);
			$comp_code          =	$compcode[0];
			$fisYear            =  $request->session()->get('macc_year');
			$db_name            = $request->session()->get('dbName');

			$vrDate             = $request->input('transaction_date');
			$sl_no              = $request->input('slno');
			$tran_code          = $request->input('tran_code');
			$series_code        = $request->input('series_code');
			$series_name        = $request->input('series_name');
			$pfct_code          = $request->input('pfct_code');
			$pfct_name          = $request->input('pfct_name');
			$plant_code         = $request->input('plant_code');
			$plant_name         = $request->input('plant_name');
			$headid             = $request->input('headid');
			$acc_code           = $request->input('customer_code');
			$acc_name           = $request->input('custmoer_name');
			$custmoer_add       = $request->input('custmoer_add');

    	    $outwardId          = $request->input('body_id');
    	    $trip_BodyId        = $request->input('trip_BodyId');
			$vrno               = $request->input('VrNo');
			$vehicle_no         = $request->input('vehicle_no');

			$rake_no            = $request->input('rake_no');
			$rake_date          = $request->input('rake_date');
			$place_date         = $request->input('place_date');
			$vr_date            = $request->input('vr_date');
			$trip_type            = $request->input('trip_type');
			
			$invoice_no         = $request->input('invoice_no');
			$invoiceDate        = $request->input('invoice_date');
			$cp_code            = $request->input('cp_code');
			$cp_name            = $request->input('cp_name');
			$cp_add             = $request->input('cp_add');
			$sp_code            = $request->input('sp_code');
			$sp_name            = $request->input('sp_name');
			$sp_add             = $request->input('sp_add');
			$do_no              = $request->input('do_no');
			$doDate             = $request->input('do_date');
			$item_code          = $request->input('item_code');
			$item_name          = $request->input('item_name');
			$itemRemark        = $request->input('item_remark');
			$lr_no              = $request->input('lr_no');
			$uniqslNo           = $request->input('uniqLrNo');
			$lrDate             = $request->input('lr_date');
			$wagon_no           = $request->input('wagon_no');
			$wagonDate          = $request->input('wagon_date');
			$qty_recd           = $request->input('qty');
			$cfactor            = $request->input('cfactor');
			$issue_qty          = $request->input('issue_qty');
			$qty_Arecd          = $request->input('qty_Arecd');
			$unit_M             = $request->input('unit_M');
			$Aqty               = $request->input('issue_Aqty');
			$old_issue_qty      = $request->input('old_issue_qty');
			$Aum                = $request->input('Aum');
			$net_qty            = $request->input('net_qty');
			$delivery_no        = $request->input('delivery_no');
			$ebill_no           = $request->input('ewaybill_no');
			$ewaybill_date      = $request->input('ewaybill_date');
			$batch_no           = $request->input('batch_no');
			$length             = $request->input('length');
			$width              = $request->input('width');
			$height             = $request->input('height');
			$odc                = $request->input('odc');
			$obd_no             = $request->input('obd_no');
			$cam_no             = $request->input('cam_no');

			$trpt_code          = $request->input('transporter_code');
			$trpt_name          = $request->input('transporter_name');
			$route_code         = $request->input('route_code');
			$route_name         = $request->input('route_name');
			$from_place         = $request->input('from_place');
			$to_place           = $request->input('to_place');
			$temp_to_place      = $request->input('temp_to_place');

			$driver_name        = $request->input('driver_name');
			$mobile_no          = $request->input('mobile_no');
			$trip_type          = $request->input('trip_type');
			$lr_remark          = $request->input('lr_remark');
			$material_value     = $request->input('material_value');
			$tri_days           = $request->input('tri_days');
			$vehicle_type       = $request->input('vehicle_type');
			$vehicle_model      = $request->input('trip_vehicleModel');
			$inwardId           = $request->input('inwardId');
			$cfgateId           = $request->input('cfgateId');
			$trip_headid        = $request->input('triphead_id');
			$cf_gateid          = $request->input('cf_gateid');
			$trip_compCode      = $request->input('trip_comp');
			$trip_fyCode        = $request->input('trip_fycode');

			//print_r($cf_gateid);exit;

			//print_r($trip_headid);exit;

			$trip_No            = $request->input('trip_No');
			/*$trip_compCode      = $request->input('compCode');
			$trip_fyCode        = $request->input('fyCode');*/
			$sr_flag            = $request->input('sr_flag');
			$wayment_weight     = $request->input('wayment_weight');
			
			$count = count($outwardId);


			$cpCode = $cp_code;
			$spCode = $sp_code;
			$LrNo   =array_unique($lr_no);
            $LrNoCount = count($LrNo);

	     	$cpCodeCount = count($cpCode);

	     	//print_r($cpCode);exit;
		
			//$sr_flag =1;
			
			$pdfPageName        = 'OUTWARD DISPATCH';
			//$count              = count($item_code);

			$donwloadStatus   = $request->input('pdfYesNoStatus');

			$tripDate =  date('d-m-Y', strtotime($vrDate. ' + '.$tri_days.' days'));


			DB::beginTransaction();

		    try {

		    	/*DB::table('CFSTOCK_LEDGER')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$tran_code)->where('SERIES_CODE',$series_code)->where('VRNO',$vrno)->delete();*/

		    	$gateentryData = DB::table('CF_GATE_ENTRY')->where('CFGATEID',$cf_gateid)->get()->first();

		    	$treipHeadId =  $gateentryData->TRIPHID;


		    	$getData =  DB::table('TRIP_BODY')->where('TRIPHID',$treipHeadId)->get();

				$tripBodyId = array();

				foreach($getData as  $key){

					$tripBodyId[] = $key->TRIPBID;

					
				}

				   /* echo '<pre>';

					print_r($tripBodyId);

					echo '</pre>';*/

		    	//print_r($treipHeadId);exit;

			for ($i=0; $i < $count; $i++) {

				


				$invoice_date     = date("Y-m-d", strtotime($invoiceDate[$i]));
				$do_date          = date("Y-m-d", strtotime($doDate[$i]));
				$lr_date          = date("Y-m-d", strtotime($lrDate[$i]));
				$wagon_date       = date("Y-m-d", strtotime($wagonDate[$i]));
				$ewaybillDate     = date("Y-m-d", strtotime($ewaybill_date[$i]));
				
				if($Aqty[$i]==''){
					$aqty ='0.000';
				}else{
					$aqty= $Aqty[$i];
				}

				if(isset($itemRemark[$i])){
				    $mremakr = $itemRemark[$i];
				}else{
					$mremakr =$item_name[$i];
				}
				
				    $data=array(

					    	'CP_CODE'       =>$cp_code[$i],
		                    'CP_NAME'       =>$cp_name[$i],
		                    'LR_SLNO'       =>$uniqslNo[$i],
		                    'LR_NO'         =>$lr_no[$i],
		                    'LR_DATE'       =>$lr_date,
		                    'CP_ADD'        =>$cp_add[$i],
		                    'SP_CODE'       =>$sp_code[$i],
		                    'SP_NAME'       =>$sp_name[$i],
		                    'SP_ADD'        =>$sp_add[$i],
		                    'ROUTE_CODE'    =>$route_code,
		                    'ROUTE_NAME'    =>$route_name,
		                    'FROM_PLACE'    =>$from_place,
		                    'TO_PLACE'      =>$to_place,
		                    'WEYMENT_WEIGHT' =>$wayment_weight,
		                    'BATCH_NO'      =>$batch_no[$i],
		                    'ALIAS_CODE'    =>'',
		                    'ALIAS_NAME'    =>'',
		                    'ITEM_CODE'     =>$item_code[$i],
		                    'ITEM_NAME'     =>$item_name[$i],
		                    'LENGTH'        =>$length[$i],
		                    'WIDTH'         =>$width[$i],
		                    'HEIGHT'        =>$height[$i],
		                    'ODC'           =>$odc[$i],
		                    'REMARK'        =>$mremakr,
		                    'QTY'           =>$qty_recd[$i],
		                    'QTYISSUED'     =>$issue_qty[$i],
		                    'UM'            =>$unit_M[$i],
		                    'AQTY'          =>$aqty,
		                    'AQTISSUED'     =>$aqty,
		                    'AUM'           =>$Aum[$i],
		                    'NET_WEIGHT'    =>$net_qty[$i],
		                    'CFACTOR'       =>$cfactor[$i],
		                    'INVOICE_NO'    =>$invoice_no[$i],
		                    'INVOICE_DATE'  =>$invoice_date,
		                    'WAGON_NO'      =>$wagon_no[$i],
		                    'WAGON_DATE'    =>$wagon_date,
		                    'OBD_NO'        =>$obd_no[$i],
		                    'DELIVERY_NO'   =>$delivery_no[$i],
		                    'EWAY_BILL_NO'  =>$ebill_no[$i],
		                    'EWAY_BILL_DT'  =>$ewaybillDate,
		                    'CAM_NO'         =>$cam_no[$i],
		                    'MATERIAL_VALUE' =>$material_value[$i],
		                    'WEYMENT_WEIGHT' =>$wayment_weight,
		                    'VEHICLE_MODEL'  =>$vehicle_model,
		                    'LAST_UPDATE_BY'    =>$userId,
				    );

                   $saveData = DB::table('CFOUTWARD_TRAN')->where('CFOUTWARDID',$outwardId[$i])->update($data);

                   $getInwardData = DB::table('CFINWARD_TRAN')->where('CFINWARDID',$inwardId[$i])->get()->first();

		            $inwardIssue_Qty = $getInwardData->QTYISSUED;
		            $inwardIssue_AQty = $getInwardData->AQTISSUED;
		            $inwardRecd_Qty  = $getInwardData->QTYRECD;
		            $inwardLs_Qty    = $getInwardData->LOADSLIP_QTY;
		            $phy_verify      = $getInwardData->PHY_VERIFY;

		            $newissuedqty =   floatval($issue_qty[$i]) + floatval($inwardIssue_Qty);

		            $newissuedAqty =   floatval($aqty) + floatval($inwardIssue_AQty);

		            $totalLsQty =     floatval($inwardRecd_Qty)  - floatval($newissuedqty);

		            //$loadslipQty = floatval($inwardLs_Qty) -  floatval($issue_qty[$i]);
		 
		            if($totalLsQty=='0'){
		           		$loadingStatus ='1';
		           	}else{
		           		$loadingStatus ='0';
		           	}

		            if($phy_verify=='0'){
		            	$phy_verification ='1';
		            }else{
		            	$phy_verification ='0';
		            }

		             	$data_update = array(

		             		'QTYISSUED' => $newissuedqty,
		             		'AQTISSUED' => $newissuedAqty,
		             		'LOADING_SLIP_STATUS'=>$loadingStatus,
		             		'PHY_VERIFY'  =>$phy_verification,
		             		'NET_WEIGHT'=>$net_qty[$i],
		             		'LOADSLIP_QTY'=>'0.000',
		             	);

		            $updateInward = DB::table('CFINWARD_TRAN')->where('CFINWARDID',$inwardId[$i])->update($data_update);

		          /*echo '<pre>';

		          print_r($trip_compCode);

		          echo '</pre>';

		          echo '<pre>';

		          print_r($treipHeadId);*/

		      if($trip_type=='SELF' || $trip_type=='SISTER_CONCERN'){

		             	$UpdateTrip = array(

                        'INVC_NO'       =>$invoice_no[$i],
                        'INVC_DATE'     =>$invoice_date,
                        'DO_NO'         =>$do_no[$i],
                        'DO_DATE'       =>$do_date,
                        'WAGON_NO'      =>$wagon_no[$i],
                        'LR_NO'         =>$lr_no[$i],
                        'LR_DATE'       =>$lr_date,
                        'VEHICLE_NO'    =>$vehicle_no,
                        'EBILL_NO'      =>$ebill_no[$i],
                        'EWAYB_VALIDDT' =>$ewaybillDate,
                        'BATCH_NO'      =>$batch_no[$i],
                        'ITEM_CODE'     =>$item_code[$i],
                        'ITEM_NAME'     =>$item_name[$i],
                        'REMARK'        =>$mremakr,
                        'CP_CODE'       =>$cp_code[$i],
                        'CP_NAME'       =>$cp_name[$i],
                        'SP_CODE'       =>$sp_code[$i],
                        'SP_NAME'       =>$sp_name[$i],
                        'FROM_PLACE'    =>$from_place,
                        'TO_PLACE'      =>$to_place,
                        'QTY'           =>$qty_recd[$i],
                        'ISSUED_QTY'    =>$issue_qty[$i],
                        'UM'            =>$unit_M[$i],
                        'AQTY'          =>$aqty,
                        'AUM'           =>$Aum[$i],
                        'NET_WEIGHT'    =>$net_qty[$i],
                        'LAST_UPDATE_BY'=>$userId,

                        
                    );


                    DB::table('TRIP_BODY')->where('TRIPHID',$treipHeadId)->where('TRIPBID',$tripBodyId[$i])->update($UpdateTrip);


                    if($sr_flag==1){

		                    	$updateTripBody = array(
		                  
		                        'INVC_NO'       =>$invoice_no[$i],
		                        'INVC_DATE'     =>$invoice_date,
		                        'DO_NO'         =>$do_no[$i],
		                        'DO_DATE'       =>$do_date,
		                        'WAGON_NO'      =>$wagon_no[$i],
		                        'LR_NO'         =>$lr_no[$i],
		                        'LR_DATE'       =>$lr_date,
		                        'VEHICLE_NO'    =>$vehicle_no,
		                        'EBILL_NO'      =>$ebill_no[$i],
		                        'EWAYB_VALIDDT' =>$ewaybillDate,
		                        'BATCH_NO'      =>$batch_no[$i],
		                        'ITEM_CODE'     =>$item_code[$i],
		                        'ITEM_NAME'     =>$item_name[$i],
		                        'REMARK'        =>$mremakr,
		                        'CP_CODE'       =>$cp_code[$i],
		                        'CP_NAME'       =>$cp_name[$i],
		                        'SP_CODE'       =>$sp_code[$i],
		                        'SP_NAME'       =>$sp_name[$i],
		                        'FROM_PLACE'    =>$from_place,
		                        'TO_PLACE'      =>$to_place,
		                        'QTY'           =>$qty_recd[$i],
		                        'ISSUED_QTY'    =>$issue_qty[$i],
		                        'UM'            =>$unit_M[$i],
		                        'AQTY'          =>$aqty,
		                        'AUM'           =>$Aum[$i],
		                        'NET_WEIGHT'    =>$net_qty[$i],
		                        'LAST_UPDATE_BY'    =>$userId,

		                        
		                    );

		                    DB::table('TRIP_BODY')->where('OUTWARDID',$outwardId[$i])->update($updateTripBody);

                    }

		        }


		     $a_qtyIssued = '';
	    	 $particular = '';
	    	 $lot_no = '';
	    	 $alias_code='';
	    	 $alias_name='';
	    	 $qtyrecd='';
	    	 $aqtyrecd='';
	    	 $qtyissued='';
	    	 $aqtyissued='';
	    	 //$item_remark=$mremakr;

	    	


	    	 $stockItem = (new AccountingController)->UpdateStockInStockLedger($comp_code,$rake_no,$rake_date,$place_date,$fisYear,$pfct_code,$pfct_name,$plant_code,$plant_name,$tran_code,$series_code,$vrno,$sl_no[$i],$acc_code,$acc_name,$vr_date,$do_no[$i],$do_date,$cp_code[$i],$cp_name[$i],$cp_add[$i],$sp_code[$i],$sp_name[$i],$sp_add[$i],$route_code,$route_name,$from_place,$to_place,$batch_no[$i],$issue_qty[$i],$lot_no,$alias_code,$alias_name,$item_code[$i],$item_name[$i],$length[$i],$width[$i],$height[$i],$odc[$i],$mremakr,$issue_qty[$i],$unit_M[$i],$aqty,$Aum[$i],$cfactor[$i],$invoice_no[$i],$invoice_date,$wagon_no[$i],$obd_no[$i],$ebill_no[$i],$ewaybillDate,$cam_no[$i],$vehicle_no,$trpt_code,$trpt_name,$lr_no[$i],$lr_date,$qtyrecd,$aqtyrecd,$issue_qty[$i],$aqty,$net_qty[$i],$userId);



		}

//exit;
		        DB::commit();
	       		$transCD = 'DISPATCH_RECEIPT';
	       		//$getArr = array($sr_flag);
	       		$pdfarr = array();
				if($donwloadStatus == 1){

					$supp_lr ='LR';
					//$trip_headid ='';

					return $this->GeneratePdfForOutward($userId,$comp_code,$plant_code,$pdfPageName,$transCD,$vrno,$trip_type,$trpt_code,$trpt_name,$vehicle_no,$tri_days,$tripDate,$vehicle_type,$vehicle_model,$cpCodeCount,$cpCode,$outwardId,$supp_lr,$trip_headid,$spCode,$LrNo,$LrNoCount);

				

				}else{}

				$data1['response'] = 'success';
			//	$data1['party'] = $data1;
	  			$getalldata = json_encode($data1);  
	  			print_r($getalldata);

          }catch (\Exception $e) {

			    DB::rollBack();
			    throw $e;
			    $data1['response'] = 'error';
	  			$getalldata = json_encode($data1);  
	  			print_r($getalldata);
			}




    }


    public function viewOutwardTrans(Request $request){

        if ($request->ajax()) {

        $user_type = $request->session()->get('user_type');

        $userid = $request->session()->get('userid');

        $Companyn  = $request->session()->get('company_name');
        $compslit = explode('-', $Companyn);
        $compCode = $compslit[0];
        $macc_year   = $request->session()->get('macc_year');

       

        
       /* $data = DB::table('CFOUTWARD_TRAN')->select('CFOUTWARD_TRAN.*')->where('COMP_CODE',$compCode)->where('LR_STATUS','1')->groupBy('VRNO','LR_NO','VEHICLE_NO')->get();*/
       $data = DB::select("SELECT t1.*,t2.VEHICLE_OUT_DATETIME FROM CFOUTWARD_TRAN t1,CF_GATE_ENTRY t2 WHERE t1.CFGATEID=t2.CFGATEID AND t1.COMP_CODE='$compCode' AND t1.LR_STATUS='1' GROUP BY t1.VRNO,t1.LR_NO,t1.VEHICLE_NO");

      // print_r($data);exit;
        /*$data = DB::select("SELECT t1.GATE_OUT_STATUS,t3.* FROM TRIP_HEAD t1,CFOUTWARD_TRAN t2 WHERE t3.COMP_CODE='$compCode' AND t3.TRIP_NO  = t1.TRIP_NO AND AND t3.LR_STATUS='1'  GROUP BY t3.VRNO,t3.LR_NO,t3.VEHICLE_NO");*/

         /*$data = DB::select("SELECT t1.*,t2. FROM CFOUTWARD_TRAN t1,CF_GATE_ENTRY t2 WHERE t2.TRIPHID=t1.TRIPHID AND t3.CFOUTWARDID  = t2.OUTWARDID");*/
        
      

        //return DataTables()->of($data)->make(true);

        return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
                $btn = '<button type="button"  class="btn btn-primary btn-xs" data-toggle="modal" data-target="#outwardtransView" onclick="return outwardView('.$data->CFOUTWARDID.')"><i class="fa fa-eye" title="view"></i></button> | <a href="'.url('/edit-form-outward-trans/'.base64_encode($data->CFOUTWARDID)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#OutwardTranssDelete" class="btn btn-danger btn-xs" onclick="return deleteoutwrd('.$data->CFOUTWARDID.')"><i class="fa fa-trash" title="delete"></i></button>';
                 
                 return $btn;
            })->make(true);


    }

         $title = 'View Outward Transaction';

         return view('admin.finance.transaction.candf.view_outward_trans',compact('title'));

    }



    public function viewSupplLrTrans(Request $request){

    	if($request->ajax()) {
			$title    = 'View Vehical Planning';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');

			$getcompcode = explode('-', $compName);
			
	   	   $comp_code   =$getcompcode[0];
			
			$fisYear  =  $request->session()->get('macc_year');

  			//$data = DB::table('TRIP_HEAD')->select('TRIP_HEAD.*')->where('COMP_CODE',$comp_code)->where('SLR_FLAG','1')->get();

			//return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

			 $data = DB::select("SELECT t2.ACC_CODE,t2.ACC_NAME,t2.CP_CODE,t2.CP_NAME,t3.TRPT_TYPE,t3.TRPT_TYPE,t3.TRPT_CODE,t3.TRPT_NAME,t3.TRIP_DAYS,t3.TRIP_DATE,t3.VEHICLE_TYPE,t3.CFOUTWARDID,t1.* FROM TRIP_HEAD t1,TRIP_BODY t2,CFOUTWARD_TRAN t3 WHERE t2.TRIPHID=t1.TRIPHID AND t3.CFOUTWARDID  = t2.OUTWARDID  AND t1.SLR_FLAG='1' AND t1.SLR_STATUS='1' GROUP BY t2.TRIPHID ORDER BY t1.TRIPHID DESC");

			//print_r($data);exit;


        	return DataTables()->of($data)->addIndexColumn()->make(true);

		}
    	return view('admin.finance.transaction.candf.view_suppl_lr_trans');

    }

    


    public function SaveLorryReceipt(Request $request)
    {

    	/*echo '<pre>';
    	print_r($request->post());exit;

    	echo '</pre>';*/
    	//
			$createdBy          = $request->session()->get('userid');
			$CompanyCode        = $request->session()->get('company_name');
			$compcode           = explode('-', $CompanyCode);
			$getcompcode        = $compcode[0];
			$fisYear            = $request->session()->get('macc_year');
			$db_name            = $request->session()->get('dbName');
			$comp_nameval       = $request->input('comp_name');
			$fy_year            = $request->input('fiscal_year');
			$trans_code         = $request->input('trans_code');
			$series_code        = $request->input('seriesCode');
			$series_name        = $request->input('seriesName');
			$plant_code         = $request->input('plantCode');
			$plant_name         = $request->input('plantName');
			$pfct_code          = $request->input('pfctCode');
			$pfct_name          = $request->input('pfctName');
			$trip_no            = $request->input('TripNum');

			$explode            = explode(' ', $trip_no);

			$tripno             = $explode[2];

			//print_r($trip_no);exit;

			$vr_no              = $request->input('vro');
			$trans_date         = $request->input('VrDate');
			$tr_vr_date         = date("Y-m-d", strtotime($trans_date));

			$headid           = $request->input('headid');

    //  print_r($headid);exit;
			$acc_code           = $request->input('accCode');
			$acc_name           = $request->input('accName');
			//$freight_order_no = $request->input('FreightNo');
			
			$invoice_no         = $request->input('invoice_no');
			$invoiceDate        = $request->input('invoice_date');
			
			$do_no              = $request->input('do_no');

			$doDate             = $request->input('do_date');
			
			$wagon_no           = $request->input('wagon_no');
			$wagonDate          = $request->input('wagon_date');
			$lrDate             = $request->input('lr_date');

			
			$item_code          = $request->input('item_code');
			$item_name          = $request->input('item_name');
			$remark             = $request->input('remark');
			$qty                = $request->input('qty');
			$unit_M             = $request->input('unit_M');
			$lr_no              = $request->input('lr_no');
			$body_id            = $request->input('body_id');

			$sale_rate          = $request->input('sale_rate');
			$fsohid             = $request->input('fsohid');
			$fsobid             = $request->input('fsobid');
			
			
			$material_value     = $request->input('material_value');
			$route_code         = $request->input('route_code');
			$route_name         = $request->input('route_name');
			$trip_day           = $request->input('trip_day');
			$off_days           = $request->input('off_days');
			$from_place         = $request->input('from_place');
			$to_place           = $request->input('to_place');
			$vehicle_no         = $request->input('VehilceNum');
			$transporter_code   = $request->input('transporter_code');
			$transporter_name   = $request->input('transporter_name');
			$delivery_no        = $request->input('delivery_no');
			$gross_weight       = $request->input('gross_weight');
			$tare_weight        = $request->input('tare_weight');
			$net_weight         = $request->input('net_weight');
			$gate_inward        = $request->input('gate_inward');
			$driver_name        = $request->input('driver_name');
			$mobile_no          = $request->input('mobile_no');
			$licence_no         = $request->input('licence_no');
			$driver_add         = $request->input('driver_add');
			$remark             = $request->input('remark');
			$ebill_no           = $request->input('ewaybill_no');
			$cp_code            = $request->input('cp_code');
			$ewaybill_date      = $request->input('ewaybill_date');
			$vehicle_type       = $request->input('vehicle_type');
			$vehicle_type_name  = $request->input('vehicle_type_name');
			$vehicle_model      = $request->input('vehicle_model');
			$donwloadStatus     = $request->input('pdfYesNoStatus');

			$LrNo   =array_unique($lr_no);
		    $LrNoCount = count($LrNo);

			$importExcel      = $request->input('importExcel');
			$pdfPageName='LORRY RECEIPT';
			$count            = count($item_code);


			$tripDate =  date('d-m-Y', strtotime($trans_date. ' + '.$trip_day.' days'));

			
  			//print_r($cpCode);exit;

  			DB::beginTransaction();

			try {


				  $datahead = array(

							
							'TRIP_NO'        => $trip_no,
							"GATE_INWARD"    => $gate_inward,
							"DRIVER_NAME"    => $driver_name,
							"DRIVER_MOBILE"  => $mobile_no,
							"LICENCE_NO"     => $licence_no,
							"DRIVER_ADD"     => $driver_add,
							"ROUTE_CODE"     => $route_code,
					        "ROUTE_NAME"     => $route_name,
							"REMARK"         => $remark,
							"LR_VR_DATE"     => $tr_vr_date,
							'LR_STATUS'      => 1,
							"CREATED_BY"     => $createdBy,
							
						);

	    
	        $saveData = DB::table('TRIP_HEAD')->where('VRNO',$tripno)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('VEHICLE_NO',$vehicle_no)->update($datahead);


	        

	        $lastid= DB::getPdo()->lastInsertId();

	      	$discriptn_page = "Lorry Receipt trans insert done by user";

	     if($importExcel){

	      	/*import excel data*/


	      	$column_name = DB::table('MASTER_EXCELCONFIG')->select('TBL_COL','TEMPEXCEL_COL')->where('TRAN_CODE','LR')->get()->toArray();

			     $ColumnArray = json_decode( json_encode($column_name), true);
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
			  // $arryCombConfigTbl = array_combine($bodycolName, $tempExcelcol);


			   //print_r($arryCombConfigTbl);exit;

			    $arryCombConfigTblCount = count($arryCombConfigTbl);


			 //   print_r($arryCombConfigTbl);exit;


	      	   $tempDoOrder = DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE COMP_CODE='$getcompcode' AND FY_CODE ='$fisYear' AND CREATED_BY='$createdBy'");



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
	    $invc_no_excel = [];
	    $item_excel = [];
	    $invc_date_excel = [];
	    $acc_code_excel = [];
	    $acc_name_excel = [];
	    $qty_excel = [];
	    $material_val_excel = [];
	    $do_no_excel = [];
	    $vehicleno_excel = [];
	    $remark_excel = [];
	    $lr_no_excel = [];
	    $lr_date_excel = [];
	   

	    for($w=0;$w< $tempDoOrderCount; $w++){
       		$n= $w+1;
       		/* -- excel col count -- */
       		for ($e = 0; $e < $tempColmnCount; $e++){

       			
       			if(isset($arryCombConfigTbl['INVC_NO'])){

       			if($arryCombConfigTbl['INVC_NO'] == $tempExcelcol[$e]){

       				$INVC_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($invc_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$INVC_NO ='';
				}
			}

					
			  if(isset($arryCombConfigTbl['ITEM_CODE'])){

					if($arryCombConfigTbl['ITEM_CODE'] == $tempExcelcol[$e]){

						$ITEM_CODE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

	 					array_push($item_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);
						
					}else{
						$ITEM_CODE = '';

					}

				}
				

			if(isset($arryCombConfigTbl['INVC_DATE'])){

				if($arryCombConfigTbl['INVC_DATE'] == $tempExcelcol[$e]){


				$INVC_DATE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

				array_push($invc_date_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				
				}else{
					$INVC_DATE ='';
				}

			}

			if(isset($arryCombConfigTbl['ACC_CODE'])){

				if($arryCombConfigTbl['ACC_CODE'] == $tempExcelcol[$e]){


					$ACC_CODE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($acc_code_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$ACC_CODE='';
				}
			}
			

			if(isset($arryCombConfigTbl['ACC_NAME'])){

				if($arryCombConfigTbl['ACC_NAME'] == $tempExcelcol[$e]){


					$ACC_NAME = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($acc_name_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{

					$ACC_NAME ='';
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
			
				if(isset($arryCombConfigTbl['MATERIAL_VAL'])){

					if($arryCombConfigTbl['MATERIAL_VAL'] == $tempExcelcol[$e]){


								$MATERIAL_VAL = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

								array_push($material_val_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

						}else{
					              $MATERIAL_VAL='';
							}
					
					}

			if(isset($arryCombConfigTbl['DO_NO'])){

				if($arryCombConfigTbl['DO_NO'] == $tempExcelcol[$e]){


					$DO_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($do_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$DO_NO='';

				}

			}
				
			if(isset($arryCombConfigTbl['VEHICLE_NO'])){

				if($arryCombConfigTbl['VEHICLE_NO'] == $tempExcelcol[$e]){


					$VEHICLE_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($vehicleno_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$VEHICLE_NO ='';
				}

			}
				
			if(isset($arryCombConfigTbl['REMARK'])){

				if($arryCombConfigTbl['REMARK'] == $tempExcelcol[$e]){


					$TO_PLACE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($remark_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$TO_PLACE='';
				}

			}

				if(isset($arryCombConfigTbl['LR_NO'])){

				 if($arryCombConfigTbl['LR_NO'] == $tempExcelcol[$e]){

				 	    $LR_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($lr_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 

			     	   $LR_NO='';
						
				}

				}

				if(isset($arryCombConfigTbl['LR_DATE'])){

				 if($arryCombConfigTbl['LR_DATE'] == $tempExcelcol[$e]){

				 	    $LR_DATE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($lr_date_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 

			     	   $LR_DATE='';
						
				}

				}
			

	       		if(isset($ColumntempDoOrder[$w])){

       			$insertexcelArray[] = $ColumntempDoOrder[$w];

       				

       			}
	       		
	       	}
       		
       	}


      	

       	for($j = 0; $j <$tempDoOrderCount; $j++) {

       		$srno = $j + 1;

		 
					 $data_import = array(

						'TRIP_NO'      =>$trip_no,
						'INVC_NO'      =>$invc_no_excel[$j],
						'INVC_DATE'    =>$invc_date_excel[$j],
						'DO_NO'        =>$do_no_excel[$j],
						'LR_NO'        =>$lr_no_excel[$j],
						'LR_DATE'      =>$lr_date_excel[$j],
						'MATERIAL_VAL' =>$material_val_excel[$j],
						'ITEM_CODE'    =>$item_excel[$j],
						'ITEM_NAME'    =>$remark_excel[$j],
						'QTY'          =>$qty_excel[$j],
						'CREATED_BY'   =>$createdBy,

				);




		    //$saveData1 = DB::table('DORDER_BODY')->insert($data_import);

			$saveData1 = DB::table('TRIP_BODY')->where('VRNO',$tripno)->where('SLNO',$srno)->where('SERIES_CODE',$series_code)->where('FY_CODE',$fisYear)->where('ITEM_CODE',$item_excel[$j])->update($data_import);

			$srno++;
		 }

	 }else{
		
		
	 	    $cpCode = $cp_code;

	     	$cpCodeCount = count($cpCode);

        // print_r($cpCodeCount);exit;

		for ($i = 0; $i < $count; $i++) {

			$invoice_date     = date("Y-m-d", strtotime($invoiceDate[$i]));


			$do_date          = date("Y-m-d", strtotime($doDate[$i]));
			$lr_date          = date("Y-m-d", strtotime($lrDate[$i]));
			$wagon_date       = date("Y-m-d", strtotime($wagonDate[$i]));


		    $data_body = array(

				
				'TRIP_NO'       =>$trip_no,
				'INVC_NO'       =>$invoice_no[$i],
				'INVC_DATE'     =>$invoice_date,
				'DO_NO'         =>$do_no[$i],
				'DO_DATE'       =>$do_date,
				'LR_NO'         =>$lr_no[$i],
				'LR_DATE'       =>$lr_date,
				'WAGON_NO'      =>$wagon_no[$i],
				'WAGON_DATE'    =>$wagon_date,
				"DELIVERY_NO"   => $delivery_no[$i],
				"GROSS_WEIGHT"  => $gross_weight[$i],
				"TARE_WEIGHT"   => $tare_weight[$i],
				"NET_WEIGHT"    => $net_weight[$i],
				"EBILL_NO"      => $ebill_no[$i],
				"EWAYB_VALIDDT" => $ewaybill_date[$i],
				'MATERIAL_VAL'  =>$material_value[$i],
				'ITEM_CODE'     =>$item_code[$i],
				'ITEM_NAME'     =>$item_name[$i],
				'QTY'           =>$qty[$i],
				'UM'            =>$unit_M[$i],
				'CREATED_BY'    =>$createdBy,

		    );
			

	    	 $saveData1 = DB::table('TRIP_BODY')->where('VRNO',$tripno)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('TRIPBID',$body_id[$i])->update($data_body);
			

		}


		
}

		    DB::commit();
	        $response_array['response'] = 'success';
			if($donwloadStatus == 1){
			$transCD='LORRY_RECEIPT';
			$supp_lr ='LR';
			return $this->GeneratePdfForLogistic($createdBy,$getcompcode,$plant_code,$headid,$pdfPageName,$transCD,$trip_day,$trans_date,$vehicle_type,$vehicle_type_name,$vehicle_model,$cpCodeCount,$cpCode,$supp_lr,$LrNo,$LrNoCount);

			/*transporter_code,transporter_name*/

			}else{}
		    $data = json_encode($response_array);
		    print_r($data);

          }catch (\Exception $e) {

			DB::rollBack();
			throw $e;
			$response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}
			
	
		    //throw $e;
		   
		


    }


    public function offlineTripLsPDF(Request $request){
	
		$createdBy   = $request->session()->get('userid');
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$fisYear       =  $request->session()->get('macc_year');
		$plant_code  = $request->input('PlantCode');
		$headId     = $request->input('tripId');
		$NewVrno      = $request->input('vrno');
		

		return $this->GeneratePdfForLoadingSlip($getcompcode,$fisYear,$plant_code,$NewVrno,$createdBy,$headId);

	}

    public function offlineTripExpReceiptPDF(Request $request){
	
		$createdBy   = $request->session()->get('userid');
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$fisYear       =  $request->session()->get('macc_year');
		$customer_code = $request->input('AccCode');
		//$trans_code      = $request->input('trans_code');
		$tripid       = $request->input('tripId');
		$payment_type = $request->input('payment_type');
		$adv_rate     = $request->input('adv_rate');
		$adv_amount   = $request->input('adv_amt');
		$owner_type   = $request->input('owner');
		$reftrip_no    = $request->input('reftripNo');
		$ref_qty      = $request->input('ref_qty');
		$reftrip_hid   = $request->input('ref_hid');
		


		$headtable    = 'TRIP_HEAD';
		$bodytable    = 'TRIP_BODY';
	    $exptable     = 'FLEET_TRAN_EXP';
	    $pmttable     = 'FLEET_TRAN_PMT';
		$columnheadid = 'TRIPHID';
		$pdfPageName  = 'TRIP EXPENSE DETAILS';
		$vrNoPname    = 'Slip No';

		   if($owner_type=='SELF'){

			return $this->GeneratePdfForTrip($createdBy,$getcompcode,$tripid,$headtable,$bodytable,$exptable,$pmttable,$columnheadid,$pdfPageName,$vrNoPname,$customer_code,$reftrip_no,$ref_qty,$reftrip_hid);

		    }else if($owner_type=='MARKET'){

	        return $this->GeneratePdfForTripMarket($createdBy,$getcompcode,$tripid,$headtable,$bodytable,$exptable,$pmttable,$columnheadid,$pdfPageName,$vrNoPname,$customer_code,$payment_type,$adv_rate,$adv_amount);

	        }
		//$pdfPageName='LORRY RECEIPT';
		//$transCD = 'LORRY_RECEIPT';

		//return $this->GeneratePdfForLogistic($createdBy,$getcompcode,$plant_code,$headid,$pdfPageName,$transCD);

		//return $this->GeneratePdfForLoadingSlip($getcompcode,$fisYear,$plant_code,$NewVrno,$createdBy,$headId);

	}

    public function offlineLrReceiptPDF_OLD(Request $request){
	
		$createdBy   = $request->session()->get('userid');
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$plant_code  = $request->input('PlantCode');
		$trip_days  = $request->input('trip_days');
		$vrdate  = $request->input('vrdate');
		$vehicle_type  = $request->input('vehicle_type');
		//$trans_code      = $request->input('trans_code');
		$headid     = $request->input('tripId');
		$pdfPageName='LORRY RECEIPT';
		$transCD = 'LORRY_RECEIPT';

		$trip_plan = DB::select("SELECT t1.*,t2.TRIPBID,t2.CP_CODE,t2.CP_NAME FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID WHERE t1.TRIPHID='$headid' AND t1.LR_STATUS='1' AND PLAN_STATUS='1' AND GATE_IN_STATUS='1'");

			$cpArray =array();

			foreach ($trip_plan as $key){

				$cpArray[] = 	$key->CP_CODE;	
			}

			//print_r($cpArray);exit;
		 $cpCode = array_unique($cpArray);

	     $cpCodeCount = count($cpCode);

	   //  print_r($cpCodeCount);exit;

		return $this->GeneratePdfForLogistic($createdBy,$getcompcode,$plant_code,$headid,$pdfPageName,$transCD,$trip_days,$vrdate,$vehicle_type,$cpCodeCount,$cpCode);

	}

	public function offlineOutwardLrReceiptPDF(Request $request){
	
		$userId   = $request->session()->get('userid');
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcom_code = $compcode[0];
		$plant_code  = $request->input('PlantCode');
		$tCode  = $request->input('trans_code');
		$trip_type  = $request->input('tripType');
		$vehicle_no  = $request->input('vehicleNo');
		$vrno  = $request->input('vrno');
		$trpt_code  = $request->input('trptCode');
		$trpt_name  = $request->input('trptName');
		$tri_days  = $request->input('tripDays');
		$tripDate  = $request->input('tripDate');
		$vehicle_type  = $request->input('vehicleType');
		$vehicle_model  = $request->input('vehicleModel');
		$supp_lr  = $request->input('supp_lr');
		$triphid  = $request->input('triphid');
		$outwardId  = $request->input('outwardid');
		
		//$trans_code      = $request->input('trans_code');
		//$headid     = $request->input('tripId');

		if($supp_lr=='SLR'){
			//DB::enableQueryLog();

			$trip_outward = DB::select("SELECT t1.*,t2.TRIPBID,t2.CP_CODE,t2.CP_NAME FROM TRIP_HEAD t1,TRIP_BODY t2 WHERE t1.TRIPHID='$triphid' AND t1.VRNO='$vrno' AND t2.TRIPHID=t1.TRIPHID AND t1.SLR_FLAG='1' AND t1.SLR_STATUS='1'");
			//dd(DB::getQueryLog());
		//	print_r('1');exit;
		}else{

			$trip_outward = DB::SELECT("SELECT A.* FROM CFOUTWARD_TRAN A WHERE   A.VRNO='$vrno' AND A.VEHICLE_NO='$vehicle_no' AND A.COMP_CODE='$getcom_code'");
			//print_r('0');exit;
		}

	//  print_r($trip_outward);exit;
		


			$cpArray =array();
			$spArray =array();
			$lrNo =array();

			foreach ($trip_outward as $key){

				$cpArray[] = 	$key->CP_CODE;	
				$spArray[] = 	$key->SP_CODE;	
				$lrNo[]    = 	$key->LR_NO;	
			}

			//print_r($cpArray);exit;
		 $cpCode = $cpArray;
		 $spCode = $spArray;
		 $LrNo   =array_unique($lrNo);

		//print_r($cpCode);

	     $cpCodeCount = count($cpCode);
	     $LrNoCount = count($LrNo);


	         $LrNoAry=array();

                for ($j=0; $j < $LrNoCount; $j++) { 

                    if($j ==0){ // insert first time 
                        $LrNoAry[] = $lrNo[$j];
                        }else{
                            $chkPresent =in_array($lrNo[$j],$LrNoAry); // check lr no is present in temp aray
                            if($chkPresent == 1){
                                // if yes nothing to do
                            }else{
                                $LrNoAry[]=$lrNo[$j]; // else insert in tem aray
                            }
                           }
                }

	     //print_r($LrNoCount);exit;


		$pdfName='LORRY RECEIPT';
		//$transCD = 'LORRY_RECEIPT';
		$tCode = 'DISPATCH_RECEIPT';



		return $this->GeneratePdfForOutward($userId,$getcom_code,$plant_code,$pdfName,$tCode,$vrno,$trip_type,$trpt_code,$trpt_name,$vehicle_no,$tri_days,$tripDate,$vehicle_type,$vehicle_model,$cpCodeCount,$cpCode,$outwardId,$supp_lr,$triphid,$spCode,$LrNoAry,$LrNoCount);

	}


	 public function offlineOutwardLrReceiptPDF_old1(Request $request){
	
		$userId   = $request->session()->get('userid');
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcom_code = $compcode[0];
		$plant_code  = $request->input('PlantCode');
		$tCode  = $request->input('trans_code');
		$trip_type  = $request->input('tripType');
		$vehicle_no  = $request->input('vehicleNo');
		$vrno  = $request->input('vrno');
		$trpt_code  = $request->input('trptCode');
		$trpt_name  = $request->input('trptName');
		$tri_days  = $request->input('tripDays');
		$tripDate  = $request->input('tripDate');
		$vehicle_type  = $request->input('vehicleType');
		$supp_lr  = $request->input('supp_lr');
		$triphid  = $request->input('triphid');
		$outwardId  = $request->input('outwardid');
		
		//$trans_code      = $request->input('trans_code');
		//$headid     = $request->input('tripId');

		if($supp_lr=='SLR'){
			//DB::enableQueryLog();

			$trip_outward = DB::select("SELECT t1.*,t2.TRIPBID,t2.CP_CODE,t2.CP_NAME FROM TRIP_HEAD t1,TRIP_BODY t2 WHERE t1.TRIPHID='$triphid' AND t1.VRNO='$vrno' AND t2.TRIPHID=t1.TRIPHID AND t1.SLR_FLAG='1' AND t1.SLR_STATUS='1'");
			//dd(DB::getQueryLog());
		//	print_r('1');exit;
		}else{

			//DB::enableQueryLog();
			$trip_outward = DB::SELECT("SELECT A.* FROM CFOUTWARD_TRAN A WHERE A.CFOUTWARDID='$outwardId' AND  A.VRNO='$vrno' AND A.VEHICLE_NO='$vehicle_no' AND A.COMP_CODE='$getcom_code'");
			//dd(DB::getQueryLog());
		}

		//print_r($trip_outward);exit;
		


			$cpArray =array();

			foreach ($trip_outward as $key){

				$cpArray[] = 	$key->CP_CODE;	
			}

			//print_r($cpArray);exit;
		 $cpCode = array_unique($cpArray);

		//print_r($cpCode);

	     $cpCodeCount = count($cpCode);

	     //print_r($cpCodeCount);exit;


		$pdfName='LORRY RECEIPT';
		//$transCD = 'LORRY_RECEIPT';
		$tCode = 'DISPATCH_RECEIPT';



		return $this->GeneratePdfForOutward($userId,$getcom_code,$plant_code,$pdfName,$tCode,$vrno,$trip_type,$trpt_code,$trpt_name,$vehicle_no,$tri_days,$tripDate,$vehicle_type,$cpCodeCount,$cpCode,$outwardId,$supp_lr,$triphid);

	}



public function SaveBulkLorryReceipt_OLD(Request $request)
    {

    	/*echo '<pre>';

    	print_r($request->post());exit;

    	echo '</pre>';*/
    	//
			$createdBy   = $request->session()->get('userid');
			$CompanyCode = $request->session()->get('company_name');
			$compcode    = explode('-', $CompanyCode);
			$getcompcode =	$compcode[0];
			$fisYear     =  $request->session()->get('macc_year');
			$db_name          =  $request->session()->get('dbName');
			$importExcel =  $request->input('importExcel');
			$customer_code =  $request->input('customer_code');
			$customer_name =  $request->input('customer_name');

		

	     if($importExcel){

	      	/*import excel data*/


	      	$column_name = DB::table('MASTER_EXCELCONFIG')->select('TBL_COL','TEMPEXCEL_COL')->where('TRAN_CODE','LR')->get()->toArray();

			     $ColumnArray = json_decode( json_encode($column_name), true);
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
			  // $arryCombConfigTbl = array_combine($bodycolName, $tempExcelcol);


			  //print_r($arryCombConfigTbl);exit;

			    $arryCombConfigTblCount = count($arryCombConfigTbl);


			 //   print_r($arryCombConfigTbl);exit;


	      	   $tempDoOrder = DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE COMP_CODE='$getcompcode' AND FY_CODE ='$fisYear' AND CREATED_BY='$createdBy' AND DO_NUMBER='NO'");

	      	  // print_r($tempDoOrder);exit;


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
	    $invc_no_excel = [];
	    $slno_excel = [];
	    $invc_date_excel = [];
	    $acc_code_excel = [];
	    $acc_name_excel = [];
	    $qty_excel = [];
	    $material_val_excel = [];
	    $do_no_excel = [];
	    $vehicleno_excel = [];
	    $remark_excel = [];
	    $lr_no_excel = [];
	    $lr_date_excel = [];
	   

	   print_r($arryCombConfigTbl);exit;

	    for($w=0;$w< $tempDoOrderCount; $w++){
       		$n= $w+1;
       		/* -- excel col count -- */
       		for ($e = 0; $e < $tempColmnCount; $e++){

       			
       			if(isset($arryCombConfigTbl['INVC_NO'])){

       			if($arryCombConfigTbl['INVC_NO'] == $tempExcelcol[$e]){

       				$INVC_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($invc_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$INVC_NO ='';
				}
			}

					
			  if(isset($arryCombConfigTbl['SLNO'])){

					if($arryCombConfigTbl['SLNO'] == $tempExcelcol[$e]){

						$SLNO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

	 					array_push($slno_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);
						
					}else{
						$SLNO = '';

					}

				}
				

			if(isset($arryCombConfigTbl['INVC_DATE'])){

				if($arryCombConfigTbl['INVC_DATE'] == $tempExcelcol[$e]){


				$INVC_DATE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

				array_push($invc_date_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				
				}else{
					$INVC_DATE ='';
				}

			}

			if(isset($arryCombConfigTbl['ACC_CODE'])){

				if($arryCombConfigTbl['ACC_CODE'] == $tempExcelcol[$e]){


					$ACC_CODE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($acc_code_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$ACC_CODE='';
				}
			}
			

			if(isset($arryCombConfigTbl['ACC_NAME'])){

				if($arryCombConfigTbl['ACC_NAME'] == $tempExcelcol[$e]){


					$ACC_NAME = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($acc_name_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{

					$ACC_NAME ='';
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
			
				if(isset($arryCombConfigTbl['MATERIAL_VAL'])){

					if($arryCombConfigTbl['MATERIAL_VAL'] == $tempExcelcol[$e]){


								$MATERIAL_VAL = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

								array_push($material_val_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

						}else{
					              $MATERIAL_VAL='';
							}
					
					}

			if(isset($arryCombConfigTbl['DO_NO'])){

				if($arryCombConfigTbl['DO_NO'] == $tempExcelcol[$e]){


					$DO_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($do_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$DO_NO='';

				}

			}
				
			if(isset($arryCombConfigTbl['VEHICLE_NO'])){

				if($arryCombConfigTbl['VEHICLE_NO'] == $tempExcelcol[$e]){


					$VEHICLE_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($vehicleno_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$VEHICLE_NO ='';
				}

			}
				
			if(isset($arryCombConfigTbl['REMARK'])){

				if($arryCombConfigTbl['REMARK'] == $tempExcelcol[$e]){


					$TO_PLACE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($remark_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$TO_PLACE='';
				}

			}

				if(isset($arryCombConfigTbl['LR_NO'])){

				 if($arryCombConfigTbl['LR_NO'] == $tempExcelcol[$e]){

				 	    $LR_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($lr_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 

			     	   $LR_NO='';
						
				}

				}

				if(isset($arryCombConfigTbl['LR_DATE'])){

				 if($arryCombConfigTbl['LR_DATE'] == $tempExcelcol[$e]){

				 	    $LR_DATE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($lr_date_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 

			     	   $LR_DATE='';
						
				}

				}
			

	       		if(isset($ColumntempDoOrder[$w])){

       			$insertexcelArray[] = $ColumntempDoOrder[$w];

       				

       			}
	       		
	       	}
       		
       	}

       //	print_r($arryCombConfigTbl);exit;

        //$triplrno = DB::table('TRIP_BODY')->where('LR_NO',$lr_no_excel)->get()->toArray();
       	$triplrnoCount =[];

      	//print_r($lr_no_excel);exit;
       	for ($n = 0; $n < $tempDoOrderCount; $n++) {

       		$triplrno = DB::table('TRIP_BODY')->where('LR_NO',$lr_no_excel[$n])->get()->toArray();

       		
         		foreach ($triplrno as $key) {
         			
         			$triplrnoCount[] = $key;
         		}
       		
       	}
       
       	$countTrip = count($triplrnoCount);
     	

     	if($countTrip > 0){

     		$response_array['response'] = 'exit_error';
            $data = json_encode($response_array);
            print_r($data);



     	}else{

     		 	for($j = 0; $j <$tempDoOrderCount; $j++) {


     		 	 $lr_date = date("Y-m-d", strtotime($lr_date_excel[$j]));

     		 	/* DB::enableQueryLog();

     		 	 $getTripData = DB::table('TRIP_BODY')->where('DO_NO',$do_no_excel[$j])->where('ACC_CODE',$customer_code)->get();

	
     		 	 dd(DB::getQueryLog());*/
     		 	 $getTripData = DB::select("SELECT t1.*,t2.FROM_PLACE,t2.TO_PLACE,t2.VRDATE,t2.VEHICLE_TYPE FROM TRIP_BODY t1 LEFT JOIN TRIP_HEAD t2 ON t1.TRIPHID = t2.TRIPHID WHERE t1.DO_NO='$do_no_excel[$j]' AND t1.SLNO='$slno_excel[$j]' AND t2.VEHICLE_NO ='$vehicleno_excel[$j]'");

     		 	/* $getTripData = DB::select("SELECT H.*,B.DO_DATE,B.FROM_PLACE,B.TO_PLACE,B.VRDATE,B.VEHICLE_TYPE FROM TRIP_HEAD H,TRIP_BODY B WHERE H.TRIPHID=B.TRIPHID AND H.COMP_CODE='$compcode' AND H.FY_CODE ='$fisYear' AND t1.DO_NO='$do_no_excel[$j]' AND H.TRIP_NO='$TRIPNO' AND  AND H.VEHICLE_NO='$vehicleno_excel[$j]'");*/




     		 	// print_r($getTripData);
     		 	 if($getTripData){

     		 	    $from_place =  $getTripData[0]->FROM_PLACE;
     		 	    $to_place =	$getTripData[0]->TO_PLACE;
     		 	    $vrdate =	$getTripData[0]->VRDATE;
     		 	    $vehicleType =	$getTripData[0]->VEHICLE_TYPE;
     		 	    $plant_code =	$getTripData[0]->PLANT_CODE;
     		 	    $tripHId =	$getTripData[0]->TRIPHID;

     		 	    /*$getSaleRate = DB::select("SELECT * FROM FSO_BODY  WHERE ACC_CODE='$customer_code'  AND  '$vrdate' BETWEEN VALID_FROM_DATE AND VALID_TO_DATE AND FROM_PLACE='$from_place' AND TO_PLACE ='$to_place' AND  VEHICLE_TYPE='$vehicleType'");*/

     		 	    $getSaleRate = DB::select("SELECT FSO_BODY.*,FSO_HEAD.REF_NO FROM FSO_BODY LEFT JOIN FSO_HEAD ON FSO_HEAD.FSOHID = FSO_BODY.FSOHID WHERE FSO_BODY.COMP_CODE='$getcompcode' AND FSO_BODY.ACC_CODE='$customer_code' AND FSO_BODY.VEHICLE_TYPE='$vehicleType' AND '$vrdate' BETWEEN FSO_BODY.VALID_FROM_DATE AND FSO_BODY.VALID_TO_DATE AND FSO_BODY.PLANT_CODE='$plant_code'  AND FSO_BODY.TO_PLACE LIKE '%$to_place%'");
     		 	    


     		 	    if($getSaleRate){

     		 	    		$sale_rate = $getSaleRate[0]->RATE;
     		 	    		$sale_rate = $getSaleRate[0]->QTY;
     		 	    		$fsohid    =  $getSaleRate[0]->FSOHID;
     		 	    		$fsobid    = $getSaleRate[0]->FSOBID;
     		 	    }else{

     		 	    	    $sale_rate = '';
     		 	    		$sale_qty  = '';
     		 	    		$fsohid    = '';
     		 	    		$fsobid    = '';
     		 	    }

     		 	 }

     		 	// print_r($getSaleRate);

       		      $srno = $j + 1;


       		   	$data_import = array(

						'INVC_NO'      =>$invc_no_excel[$j],
						'INVC_DATE'    =>$invc_date_excel[$j],
						'DO_NO'        =>$do_no_excel[$j],
						'LR_NO'        =>$lr_no_excel[$j],
						'LR_DATE'      =>$lr_date,
						'MATERIAL_VAL' =>$material_val_excel[$j],
						'SLNO'         =>$slno_excel[$j],
						'ITEM_NAME'    =>$remark_excel[$j],
						'QTY'          =>$qty_excel[$j],
						'CREATED_BY'   =>$createdBy,

				);

			$saveData1 = DB::table('TRIP_BODY')->where('SLNO',$slno_excel[$j])->where('DO_NO',$do_no_excel[$j])->update($data_import);

       		   
       		   $data_head = array(


       		   	            'FSO_RATE'       => $sale_rate,
							'FSO_QTY'        => $sale_qty,
							'FSOHID'         => $fsohid,
							'FSOBID'         => $fsobid,
							'LR_STATUS'      => 1,

       		   );
		 		
			$update2 = DB::table('TRIP_HEAD')->where('TRIPHID',$tripHId)->where('VEHICLE_NO',$vehicleno_excel[$j])->where('LR_STATUS','0')->update($data_head);

			$srno++;
		 }

		//exit;


		 	if($saveData1){
			$response_array['response'] = 'success';
			
		    $data = json_encode($response_array);
		    print_r($data);

			}else{

				$response_array['response'] = 'error';
	            $data = json_encode($response_array);
	            print_r($data);

			}

     	}

      

	   	}


	
		   
			
	
		    //throw $e;
		   
		


    }


 public function SaveBulkLorryReceipt(Request $request){


		$createdBy     = $request->session()->get('userid');
		$CompanyCode   = $request->session()->get('company_name');
		$compcode      = explode('-', $CompanyCode);
		$getcompcode   =  $compcode[0];
		$fisYear       =  $request->session()->get('macc_year');
		$db_name       =  $request->session()->get('dbName');
		$importExcel   =  $request->input('importExcel');
		$customer_code =  $request->input('customer_code');
		$customer_name =  $request->input('customer_name');
		$importfilename =  $request->input('importfilename');
		$fileType      =  $request->input('fileType');

		/*echo '<pre>';
		print_r($fileType);exit;
		echo '</pre>';*/


DB::beginTransaction();

 try {

	DB::commit();

		$doOrderData = DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE COMP_CODE='$getcompcode' AND FY_CODE ='$fisYear' AND CREATED_BY='$createdBy' AND DO_NUMBER='NO'");

		/*echo '<PRE>';

		print_r($doOrderData);exit;

		echo '</PRE>';*/

		$tempDoOrderData = json_decode(json_encode($doOrderData),true);

		$SRNO = 1;

		foreach ($tempDoOrderData as $row) {

			$DONO      = $row['COL11'];

			if($DONO){

				$CP_CODE = $row['COL6'];
				$cpexplode = explode('~',$CP_CODE);
				$cp_name = $cpexplode[0];
				$cp_code = $cpexplode[1];

			}else{
				
				$cp_code = $row['COL5'];
				$cp_name = $row['COL6'];
			}

			

			$invc_date = $row['COL3'];
			$lorry_date = $row['COL22'];
			$ewaybcreate_date = $row['COL18'];
			$ewaybvalid_date = $row['COL19'];

			$invoice_date       = date('Y-m-d',strtotime($invc_date));
			$lr_date            = date('Y-m-d',strtotime($lorry_date));
			$ewayCreateDate     = date('Y-m-d',strtotime($ewaybcreate_date));
			$ewayValidDate      = date('Y-m-d',strtotime($ewaybvalid_date));

			$TRIPNO        = $row['TRIP_NO'];
			$COMPCODE      = $row['COMP_CODE'];
			$FYCODE        = $row['FY_CODE'];
			
			$ITEMSLNO      = $row['COL12'];
			$DELIVERYNO    = $row['COL13'];
			$VEHICLENO     = $row['COL14'];
			$INVNO         = $row['COL1'];
			$INVDT         = $invoice_date;
			$LRNO          = $row['COL21'];
			$TO_PLACE      = $row['COL23'];
			$LRDT          = $lr_date;
			$GROSSW        = $row['COL17'];
			$MATERIALVAL   = $row['COL9'];
			$EWAYBILLNO    = $row['COL20'];
			$EWAYBILLDT    = $ewayCreateDate;
			$EWAYBILLVALDT = $ewayValidDate;
			$ITEM          = $row['COL2'];
			$REMARK        = $row['COL15'];
			$CPCODE        = $cp_code;
			$CPNAME        = $cp_name;
			$AQTY           = $row['COL7'];
			$QTY           = $row['COL8'];
			$BATCHNO       = $row['COL16'];
			$CAMNO         = $row['COL10'];
			$VEHICLETYPE   = $row['COL4'];

			if($fileType=='JSW'){

			  $WAGON_NO   = $row['COL24'];

			}else{

			  $WAGON_NO   = '';
			}	
			
		/* ~~~~~~~ TRIP HEAD DATA ~~~~~~~~~~~ */

			$tHeadData = DB::select("SELECT H.*,B.DO_DATE FROM TRIP_HEAD H,TRIP_BODY B WHERE H.TRIPHID=B.TRIPHID AND H.COMP_CODE='$COMPCODE' AND H.FY_CODE ='$FYCODE' AND H.TRIP_NO='$TRIPNO' AND H.VEHICLE_NO='$VEHICLENO'");

			$tripHeadData = json_decode(json_encode($tHeadData),true);
			
			$TRIPHID    = $tripHeadData[0]['TRIPHID'];
			$PFCTCODE   = $tripHeadData[0]['PFCT_CODE'];
			$TRANCODE   = $tripHeadData[0]['TRAN_CODE'];
			$SERIESCODE = $tripHeadData[0]['SERIES_CODE'];
			$VR_NO      = $tripHeadData[0]['VRNO'];
			$FROM_PLACE = $tripHeadData[0]['FROM_PLACE'];
			$DO_DATE    = $tripHeadData[0]['DO_DATE'];
			

		/* ~~~~~~~ ./ TRIP HEAD DATA ~~~~~~~~~~~ */


		/* ---------- MASTER ITEM DATA ----------*/

			$itemData = DB::select("SELECT * FROM MASTER_ITEM WHERE ITEM_NAME = '$ITEM' OR ALIAS_CODE ='$ITEM'");

			$mItemData = json_decode(json_encode($itemData),true);


			if (isset($mItemData[0]['ITEM_CODE'])) {

				$ITEMCODE  = $mItemData[0]['ITEM_CODE'];
				$ITEMNAME  = $mItemData[0]['ITEM_NAME'];
				$ALIASCODE = $mItemData[0]['ALIAS_CODE'];
				$ALIASNAME = $mItemData[0]['ALIAS_NAME'];
				
			}else{

				$ITEMCODE  = '';
				$ITEMNAME  = '';
				$ALIASCODE = '';
				$ALIASNAME = '';

			}
			

			$MITEMCODE = '';
			$MITEMNAME = '';
			if ($ALIASCODE=='NULL' || $ALIASCODE==NULL || $ALIASCODE==null) {

				$MITEMCODE = $ITEMCODE;
				$MITEMNAME = $ITEMNAME;

			}else{

				$MITEMCODE = $ALIASCODE;
				$MITEMNAME = $ALIASNAME;
			}


		/* ---------- ./ MASTER ITEM DATA ----------*/


		/* ~~~~~~~~~~~ DELETE EXISTING TRIP ~~~~~~~~~ */

		//print_r($CPCODE);

		 // DB::enableQueryLog();


			/*$tBodyData = DB::table("DELETE FROM TRIP_BODY  WHERE COMP_CODE='$COMPCODE' AND FY_CODE ='$FYCODE' AND CP_CODE='$CPCODE' AND DO_NO='$DONO' AND TRIPHID=(SELECT H.TRIPHID FROM TRIP_HEAD H WHERE H.COMP_CODE='$COMPCODE' AND H.FY_CODE ='$FYCODE' AND H.TRIP_NO = '$TRIPNO')");*/

			//$tBodyData = DB::table("DELETE FROM TRIP_BODY  WHERE TRIPHID='$TRIPHID'");

			if($fileType=='TATA'){

				$tBodyData = DB::table('TRIP_BODY')->where('COMP_CODE',$COMPCODE)->where('FY_CODE',$FYCODE)->where('DO_NO',$DONO)->where('TRIPHID',$TRIPHID)->where('FLAG','0')->delete();
			}else{

				$tBodyData = DB::table('TRIP_BODY')->where('COMP_CODE',$COMPCODE)->where('FY_CODE',$FYCODE)->where('TRIPHID',$TRIPHID)->where('FLAG','0')->delete();
			}

			



	    //dd(DB::getQueryLog());

		/* ~~~~~~~~~~~ ./ DELETE EXISTING TRIP ~~~~~~~~~ */


		/* ........ CREATE AUTO INCREAMENT TRIPBID ......... */

			$StoreB = DB::select("SELECT MAX(TRIPBID) as TRIPBID FROM TRIP_BODY");

			$bodyID = json_decode(json_encode($StoreB), true); 
	
			if(empty($bodyID[0]['TRIPBID'])){
				$TRIPBID = 1;
			}else{
				$TRIPBID = $bodyID[0]['TRIPBID']+1;
			}

		/* ........ ./ CREATE AUTO INCREAMENT TRIPBID ......... */



		/* ~~~~~~~~~~~~~ INSERTED UPLOADED LR ~~~~~~~~~~~~~~ */

			date_default_timezone_set('Asia/Kolkata');

			$VRDATE = date('Y-m-d');

			$Flag = 2;

			$data = array(

					'TRIPHID'       => $TRIPHID,
					'TRIPBID'       => $TRIPBID,
					'COMP_CODE'     => $getcompcode,
					'FY_CODE'       => $fisYear,
					'PFCT_CODE'     => $PFCTCODE,
					'TRAN_CODE'     => $TRANCODE,
					'SERIES_CODE'   => $SERIESCODE,
					'VRNO'          => $VR_NO,
					'SLNO'          => $ITEMSLNO,
					'ACC_CODE'      => $customer_code,
					'ACC_NAME'      => $customer_name,
					'VRDATE'        => $VRDATE,
					'TRIP_NO'       => $TRIPNO,
					'INVC_NO'       => $INVNO,
					'INVC_DATE'     => $INVDT,
					'DO_NO'         => $DONO,
					'DO_DATE'       => $DO_DATE,
					'LR_NO'         => $LRNO,
					'LR_DATE'       => $LRDT,
					'VEHICLE_NO'    => $VEHICLENO,
					'GROSS_WEIGHT'  => $GROSSW,
					'MATERIAL_VAL'  => $MATERIALVAL,
					'EBILL_NO'      => $EWAYBILLNO,
					'E_BILL_CREATE_DATE' => $EWAYBILLDT,
					'EWAYB_VALIDDT' => $EWAYBILLVALDT,
					'ITEM_CODE'     => $MITEMCODE,
					'ITEM_NAME'     => $MITEMNAME,
					'REMARK'        => $REMARK,
					'CP_CODE'       => $CPCODE,
					'CP_NAME'       => $CPNAME,
					'SP_CODE'       => $CPCODE,
					'SP_NAME'       => $CPNAME,
					'QTY'           => $QTY,
					'AQTY'          => $AQTY,
					'ISSUED_QTY'    => $QTY,
					'NET_WEIGHT'    => $QTY,
					'UM'            => 'MT',
					'BATCH_NO'      => $BATCHNO,
					'DELIVERY_NO'   => $DELIVERYNO,
					'CAM_NO'   		=> $CAMNO,
					'VEHICLE_TYPE'  => $VEHICLETYPE,
					'FROM_PLACE'    => $FROM_PLACE,
					'TO_PLACE'      => $TO_PLACE,
					'WAGON_NO'      => $WAGON_NO,
					'FLAG'          => $Flag,
					'CREATED_BY'    => $createdBy
						
				);

			//print_r($data);

		  	 	$INSERTTRIPDATA = DB::table('TRIP_BODY')->insert($data);


		  	 	$head_data =array(

		  	 		'LR_STATUS'=>'1',
		  	 		'GATE_IN_STATUS'=>'1',
		  	 		'GATE_OUT_STATUS'=>'1',
		  	 		'UPLOAD_FILE_NAME'=>$importfilename,

		  	 	);

		  	$UPDATEDATA = DB::table('TRIP_HEAD')->where('COMP_CODE',$COMPCODE)->where('FY_CODE',$FYCODE)->where('TRIPHID',$TRIPHID)->where('TRIP_NO',$TRIPNO)->where('VEHICLE_NO',$VEHICLENO)->update($head_data);

		/* ~~~~~~~~~~~~~ ./ INSERTED UPLOADED LR ~~~~~~~~~~~~~~ */

		  	 $SRNO++;
			
		} /* ~~~~~~ FOREACH LOOP CLOSE ~~~~~ */


		//exit();

	            $data1['response'] = 'success';
	  			$getalldata = json_encode($data1);  
	  			print_r($getalldata);

          }catch (\Exception $e) {

			    DB::rollBack();
			    throw $e;
			    $data1['response'] = 'error';
	  			$getalldata = json_encode($data1);  
	  			print_r($getalldata);
		}

		/*if($INSERTTRIPDATA){

			$response_array['response'] = 'success';
            $response_array['data'] = '';

            $data = json_encode($response_array);

            print_r($data);

		}else{

			$response_array['response'] = 'error';
            $response_array['data'] = '' ;
           
            $data = json_encode($response_array);

            print_r($data);

		}*/
	
	


    }
    
   
   public function getTripOrderQty(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$ItemCode   = $request->input('ItemCode');
		 

	    	$delivery_order = DB::table('TRIP_BODY')->where('ITEM_CODE', $ItemCode)->get()->toArray();
	    	

    		if($delivery_order) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $delivery_order;
	         

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

    public function ViewLorryReceipt(Request $request){

    	if($request->ajax()) {
			$title    = 'View Lorry Receipt';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
		      $CompanyCode                 = $request->session()->get('company_name');

		      $compcode                    = explode('-', $CompanyCode);

		      $getcompcode                 = $compcode[0];
			
			$fisYear  =  $request->session()->get('macc_year');


      /*$data = DB::table('TRIP_HEAD')->where('COMP_CODE',$getcompcode)->where('LR_STATUS','1')->where('SLR_STATUS','0')->where('SLR_FLAG','0')->orderBy('TRIPHID','DESC');*/
        /*$data = DB::select("SELECT H.*,B.LR_NO FROM TRIP_BODY B,TRIP_HEAD H WHERE B.TRIPHID=H.TRIPHID AND H.COMP_CODE='$getcompcode' AND H.LR_STATUS='1' AND H.SLR_STATUS='0' AND H.SLR_FLAG='0' GROUP BY B.LR_NO");*/

        $data = DB::table('TRIP_HEAD')
				->select('TRIP_HEAD.*', 'TRIP_BODY.LR_NO')
           		->leftjoin('TRIP_BODY', 'TRIP_BODY.TRIPHID', '=', 'TRIP_HEAD.TRIPHID')
           		->where('TRIP_HEAD.COMP_CODE',$getcompcode)
           		->where('TRIP_HEAD.LR_STATUS','1')
           		->where('TRIP_HEAD.SLR_STATUS','0')
           		->where('TRIP_HEAD.SLR_FLAG','0')
           		->orderBy('TRIPHID','DESC')
           		->groupBy('TRIP_BODY.LR_NO');

       //print_r($data);exit;


	    	

			 return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}
    	return view('admin.finance.transaction.logistic.view_lorry_receipt');

    }



    public function ViewChildLorryReceipt(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$lorry_receipt = DB::table('TRIP_BODY')->where('TRIPHID', $headid)->where('VRNO', $vrno)->get()->toArray();
	    	

    		if($lorry_receipt) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $lorry_receipt;
	         

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


    public function lorry_receipt_msg(Request $request,$saveData){

		if ($saveData==true) {

			$request->session()->flash('alert-success', 'Lorry Receipt Was Successfully Added...!');
			return redirect('/Transaction/Logistic/View-lorry-receipt-trans');

		} else {

			$request->session()->flash('alert-error', 'Lorry Receipt Can Not Added...!');
			return redirect('/Transaction/Logistic/View-lorry-receipt-trans');

		}
	}


public function editLorryReceipt(Request $request,$triphid){


	     $tripId = base64_decode($triphid);

	     $title                       = 'Add Lorry Receipt';
		$compName                    = $request->session()->get('company_name');
		$fisYear                     =  $request->session()->get('macc_year');
		$CompanyCode                 = $request->session()->get('company_name');
		$compcode                    = explode('-', $CompanyCode);
		$getcompcode                 = $compcode[0];
		$vehicle_no                  = $request->old('vehicle_no');
		$from_place                  = $request->old('from_place');
		$to_place                    = $request->old('to_place');
		$transporter                 = $request->old('transporter');
		$date                        = $request->old('date');
		$fright_order                = $request->old('fright_order');
		$vehicleId                   = $request->old('id');
		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();
		
		$userdata['vehicle_list']    = DB::table('MASTER_FLEET')->get();
		
		$userdata['inward_list']     = DB::table('MASTER_INWARD_SLIP')->get();
		
		$userdata['transport_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();
		
		$userdata['getacc']          = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']     = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T3'])->where(['COMP_CODE'=>$getcompcode])->get();
		//dd(DB::getQueryLog());
		$userdata['tax_code_list']   = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		//DB::enableQueryLog();
		$userdata['dept_list']       = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']      = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']       = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']       = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']       = DB::table('MASTER_COST')->get();
		$userdata['emp_list']        = DB::table('MASTER_EMP')->get();
		
		$userdata['item_list']       = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']       = DB::table('MASTER_RATE_VALUE')->get();
		
		$userdata['area_list']       = DB::table('MASTER_AREA')->get();

		$userdata['trip_list']         = DB::table('TRIP_HEAD')->where('GATE_IN_STATUS','1')->where('LR_STATUS','0')->where('TRIP_WO_ITEM','0')->get();

		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['truck_list']      = DB::table('MASTER_FLEET')->get();
		
		$userdata['comp_list']       = DB::table('MASTER_COMP')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

		$userdata['fpo_list']        = DB::table('FPO_HEAD')->get();

		$userdata['route_list']        = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('ROUTE_CODE')->get();

	    $userdata['columnlist']    = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','LR')->get()->toArray();
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$fisYear])->get();

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		/*$userdata['tripLorryData'] = DB::select("SELECT t2.*,t1.VEHICLE_NO,t1.TRIP_NO AS tripNo,t1.TRIPHID AS tripHid FROM TRIP_HEAD t1,TRIP_BODY t2 LEFT JOIN TRIP_BODY  ON t2.TRIPHID = t1.TRIPHID WHERE t1.tripHid='$tripId'");*/

		$userdata['tripLorryData'] = DB::select("SELECT t1.*,t2.FROM_PLACE,t2.TO_PLACE,t2.VRDATE,t2.VEHICLE_TYPE,t2.VEHICLE_NO AS VEHICLENO,t2.SERIES_NAME,t2.PLANT_CODE,t2.PLANT_NAME,t2.ROUTE_CODE,t2.ROUTE_NAME,t2.FROM_PLACE,t2.TO_PLACE,t2.TRIP_DAY,t2.OFF_DAY,t2.TRANSPORT_CODE,t2.TRANSPORT_NAME,t2.DRIVER_NAME,t2.DRIVER_MOBILE,t2.LICENCE_NO,t2.DRIVER_ADD,t2.REMARK AS head_remark  FROM TRIP_BODY t1 LEFT JOIN TRIP_HEAD t2 ON t1.TRIPHID = t2.TRIPHID WHERE t1.TRIPHID='$tripId'");

		//print_r($userdata['tripLorryData']);exit;

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		

    
    	return view('admin.finance.transaction.logistic.edit_lorry_receipt_tran',$userdata+compact('title','vehicle_no','from_place','to_place','transporter','date','fright_order','vehicleId'));

	 // print_r($tripId);exit;


}

public function DeleteLorryReceipt(Request $request){

	$headID = $request->input('headID');

DB::beginTransaction();

try {

	$lorryHead =array(

		'LR_STATUS'=>'0',

	);

	DB::table('TRIP_HEAD')->where('TRIPHID',$headID)->update($lorryHead);

	$lorryBody=array(

				'LR_NO'         =>'',
				'LR_DATE'       =>'',
				"NET_WEIGHT"    =>'',
				'MATERIAL_VAL'  =>'',

	);

	DB::table('TRIP_BODY')->where('TRIPHID',$headID)->update($lorryBody);

	     DB::commit();

			$request->session()->flash('alert-success', 'Lorry Was Deleted Successfully...!');
			return redirect('/Transaction/Logistic/View-lorry-receipt-trans');

		}catch (\Exception $e) {

	        DB::rollBack();
	       // throw $e;
	        $request->session()->flash('alert-error', 'Lorry Not Found...!');
		   return redirect('/Transaction/Logistic/View-lorry-receipt-trans');
	   }

     }

	//print_r($headID);exit;


 /*lorry receipt*/



 /*lorry acknowlwdgement*/

 public function getAchiveDateDetails(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$trip_achive_date   = $request->input('trip_achive_dt');

	    	$trip_achive_dt = date("Y-m-d", strtotime($trip_achive_date));

	    	//print_r($trip_achive_dt);exit;


	    	$lrno   = $request->input('lrno');
		 
	    	

	    	$target_date = DB::table('LR_HEAD')->where('VRNO', $lrno)->get()->first();

	    //	print_r($trip_plan);exit;


    		if($target_date) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $target_date;
	            $response_array['achive_date'] = $trip_achive_dt;
	          
	         

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
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


public function AddLrAcnowledgment(Request $request){


		$title                       = 'Add Lorry Acknowledgment';
		$compName                    = $request->session()->get('company_name');
		$fisYear                     =  $request->session()->get('macc_year');
		$CompanyCode                 = $request->session()->get('company_name');
		$compcode                    = explode('-', $CompanyCode);
		$getcompcode                 = $compcode[0];
	
		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();
		
		$userdata['vehicle_list']    = DB::table('MASTER_FLEET')->get();
		
		$userdata['inward_list']     = DB::table('MASTER_INWARD_SLIP')->get();
		
		$userdata['transport_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();
		
		$userdata['getacc']          = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']     = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T3'])->get();
		//dd(DB::getQueryLog());
		$userdata['tax_code_list']   = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		//DB::enableQueryLog();
		$userdata['dept_list']       = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']      = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']       = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']       = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']       = DB::table('MASTER_COST')->get();
		$userdata['emp_list']        = DB::table('MASTER_EMP')->get();
		
		$userdata['item_list']       = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']       = DB::table('MASTER_RATE_VALUE')->get();
		
		$userdata['area_list']       = DB::table('MASTER_AREA')->get();

		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['truck_list']      = DB::table('MASTER_FLEET')->get();
		
		$userdata['comp_list']       = DB::table('MASTER_COMP')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

		$userdata['fpo_list']        = DB::table('FPO_HEAD')->get();

		$userdata['penalty_list']        = DB::table('MASTER_LRACK_PENALTY')->get();

		/*$userdata['trip_list']         = DB::table('TRIP_HEAD')->where('EPOD_STATUS','1')->where('GATE_OUT_STATUS','1')->where('LR_ACK_STATUS','0')->get();*/

		$userdata['trip_list'] = DB::select("SELECT t1.VEHICLE_NO AS VEHICLENO,t2.* FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID  = t2.TRIPHID  WHERE t1.COMP_CODE='$getcompcode' AND t1.EPOD_STATUS ='1' AND t1.GATE_OUT_STATUS='1' AND t1.LR_ACK_STATUS='0' GROUP BY t1.TRIPHID");

		$userdata['triplr_list'] = DB::select("SELECT t1.VEHICLE_NO AS VEHICLENO,t2.* FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID  = t2.TRIPHID  WHERE t1.COMP_CODE='$getcompcode' AND t1.EPOD_STATUS ='1' AND t1.GATE_OUT_STATUS='1' AND t1.LR_ACK_STATUS='0' GROUP BY t2.TRIPHID,t2.LR_NO");
		
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$fisYear])->get();

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		

		//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T3')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
		


    
    	return view('admin.finance.transaction.logistic.lr_ackonledgmnt',$userdata);



    }




    public function SaveLrAcnowledgment(Request $request)
    {

       /* echo '<pre>';
    	print_r($request->post());exit;

    	echo '</pre>';*/
    	//
			$createdBy        = $request->session()->get('userid');
			$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
			$fisYear          =  $request->session()->get('macc_year');
			$comp_nameval     = $request->input('comp_name');
			$fy_year          = $request->input('fiscal_year');
			$trans_code       = $request->input('trans_code');
			$series_code      = $request->input('series_code');
			$series_name      = $request->input('series_name');
			$plant_code       = $request->input('plant_code');
			$plant_name       = $request->input('plant_name');
			$pfct_code        = $request->input('pfct_code');
			$pfct_name        = $request->input('pfct_name');
			$tripid           = $request->input('tripid');
			$vehicle_no          = $request->input('vehicle_no');
			$trip_no          = $request->input('trip_no');
			$explode = explode(' ', $trip_no);
			$tripno  = $explode[2];
			$vr_no            = $request->input('vro');
			$trans_date       = $request->input('vr_date');
			$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
		
			
			$customer_code    = $request->input('AccCode');
			$item_code        = $request->input('acctname');

			$item_code        = $request->input('item_code');
			$item_name        = $request->input('item_name');
			$remark           = $request->input('remark');
			$qty              = $request->input('qty');
			$unit_M           = $request->input('unit_M');
			$lr_no            = $request->input('lr_no');
			$recd_qty         = $request->input('recd_qty');
			$shortage_qty     = $request->input('shortage_qty');


			$lrdate              = $request->input('lr_date');
			$lr_date             = date("Y-m-d", strtotime($lrdate));
			/*$reportingdt         = $request->input('reporting_dt');
			$reporting_dt        = date("Y-m-d", strtotime($reportingdt));*/
			$ackdate             = $request->input('ack_date');
			$ack_date            = date("Y-m-d", strtotime($ackdate));
			$deliverydt          = $request->input('delivery_dt');
			$delivery_dt         = date("Y-m-d", strtotime($deliverydt));
			$achive_day          = $request->input('achive_day');
			$delivery_by         = $request->input('delivery_by');
			$del_recd_by         = $request->input('del_recd_by');
			$party_sign          = $request->input('party_sign');
			$party_stamp         = $request->input('party_stamp');
			$expense_party       = $request->input('expense_party');
			$deduction_claim     = $request->input('deduction_claim');
			$vehicle_return      = $request->input('vehicle_return');
			$vehicle_returndate  = $request->input('vehicle_return_date');
			$vehicle_return_date = date("Y-m-d", strtotime($vehicle_returndate));
			$warai_recipt_no     = $request->input('warai_recipt_no');
			$warai_reciptdate    = $request->input('warai_recipt_date');
			$warai_recipt_date   = date("Y-m-d", strtotime($warai_reciptdate));

			$penalty            = $request->input('penalty');
			$description        = $request->input('description');
			$penalty_type       = $request->input('penalty_type');
			$gl_code            = $request->input('gl_code');
			$gl_name            = $request->input('gl_name');
			$remark             = $request->input('remark');
			$slip_no             = $request->input('slip_no');
			$slip_date             = $request->input('slip_date');
			$Amt                = $request->input('amount_exp');
			$bodyId             = $request->input('bodyId');

			//end($Amt);

		//print_r($Amt);exit;
			$donwloadStatus    = $request->input('donwloadStatus');
			$trip_freight_amt   = $request->input('trip_freight_amt');
			$less_advance       = $request->input('less_advance');
			$add_less_chrg      = $request->input('add_less_chrg');
            $basic_amt          = $request->input('basic_amt');
			$net_amount         = $request->input('net_amount');

			//$FilterArray = array_filter($Amt);

		   $amt_count = count($Amt);

		  
	 DB::beginTransaction();

		try {
		   
		   for($u=0;$u<$amt_count;$u++){
		   	//print_r($Amt[$u]);
		   	if(($Amt[$u] !='') && ($Amt[$u] !=0.00)){

		   	//	print_r($Amt[$u]);
		   		
		   		$fLeetH1 = DB::select("SELECT MAX(TRIPEXPID) as TRIPEXPID  FROM TRIP_CHARGE_EXP");
					    $expID = json_decode(json_encode($fLeetH1), true); 
					  
					    if(empty($expID[0]['TRIPEXPID'])){
					      $exp_Id = 1;
					    }else{
					      $exp_Id = $expID[0]['TRIPEXPID'] + 1;
					    }

			  			$explode = explode('-',$penalty_type[$u]);

			  			$index_code = $explode[0]; 	


			   	$amtData = array(
						"TRIPEXPID"   => $exp_Id,
						"TRIPHID"     => $tripid,
						"COMP_CODE"   => $getcompcode,
						"FY_CODE"     => $fisYear,
						"INDICATOR"   => $penalty[$u],
						"DESCRIPTION" => $description[$u],
						"INDEX_NAME"  => $index_code,
						"GL_CODE"     => $gl_code[$u],
						"GL_NAME"     => $gl_name[$u],
						"SLIP_NO"     => $slip_no[$u],
						"SLIP_DATE"   => $slip_date[$u],
						"REMARK"      => $remark[$u],
						'AMOUNT'      =>$Amt[$u],
						"CREATED_BY"  => $createdBy,
						
					);

					//print_r($amtData);
					$saveData2 = DB::table('TRIP_CHARGE_EXP')->insert($amtData);
		   	}else{

		   		$saveData2 ='';
		   	}
		   	
		   }

		   //exit;
			$count     = count($item_code);

  		
				  $datahead = array(

							"LR_DATE"             => $lr_date,
							"ACK_VR_DATE"         => $tr_vr_date,
							"ACK_DATE"            => $ack_date,
							"DELIVERY_DATE"       => $delivery_dt,
							"DELIVERY_DAY"        => $achive_day,
							"DELIVERY_BY"         => $delivery_by,
							"DELIVERY_RECD_BY"    => $del_recd_by,
							"PARTY_SIGN"          => $party_sign,
							"PARTY_STAMP"         => $party_stamp,
							"EXP_PAID_PARTY"      => $expense_party,
							"DEDUCT_CLAIM_PARTY"  => $deduction_claim,
							"VEHICLE_RETURN"      => $vehicle_return,
							"VEHICLE_RETURN_DATE" => $vehicle_return_date,
							"WARAI_RECIEPT"       => $warai_recipt_no,
							"WARAI_RECIEPT_DATE"  => $warai_recipt_date,
							"TRIP_FREIGHT_AMT"    => $trip_freight_amt,
							"LESS_ADVANCE"        => $less_advance,
							"ADD_LESS_CHRG"       => $add_less_chrg,
                            "BASIC_AMT"           => $basic_amt,
							"NET_AMOUNT"          => $net_amount,
							"LR_ACK_STATUS"       => 1,
							"CREATED_BY"          => $createdBy,
							
						);

				  //print_r($datahead);exit;
	    
	        // $saveData = DB::table('TRIP_HEAD')->insert($datahead);

	          $saveData = DB::table('TRIP_HEAD')->where('TRIPHID',$tripid)->where('SERIES_CODE',$series_code)->where('FY_CODE',$fisYear)->where('VEHICLE_NO',$vehicle_no)->update($datahead);


	        $lastid= DB::getPdo()->lastInsertId();

	      	$discriptn_page = "Lorry Receipt trans insert done by user";

			
		for ($i = 0; $i < $count; $i++) {

		    $data_body = array(

				
				'RECD_QTY'        =>$recd_qty[$i],
				'SHORTAGE_QTY'    =>$shortage_qty[$i],
				'TRIP_ACK'        =>'YES',
				'CREATED_BY'      =>$createdBy,

		    );
	
		   // print_r($item_code);
	    	//$saveData1 = DB::table('LR_BODY')->insert($data_body);

	    	$saveData1 = DB::table('TRIP_BODY')->where('TRIPBID',$bodyId[$i])->where('TRIPHID',$tripid)->where('VRNO',$tripno)->where('SERIES_CODE',$series_code)->where('FY_CODE',$fisYear)->where('ITEM_CODE',$item_code[$i])->update($data_body);
			

		}

		//exit;

		 	DB::commit();

		 		if($donwloadStatus==1){

		 			$headtable    = 'TRIP_HEAD';
					$bodytable    = 'TRIP_BODY';
				    $penaltytable = 'TRIP_CHARGE_EXP';
					$columnheadid = 'TRIPHID';
					$pdfPageName  = 'LR ACKNOLEDGMENT';
					$vrNoPname    = 'Slip No';

		           return $this->GeneratePdfForLrAck($createdBy,$getcompcode,$tripid,$headtable,$bodytable,$penaltytable,$columnheadid,$pdfPageName,$vrNoPname,$customer_code);

				/*return $this->GeneratePdfForTrip($createdBy,$getcompcode,$tripid,$headtable,$bodytable,$exptable,$pmttable,$columnheadid,$pdfPageName,$vrNoPname,$customer_code,$reftrip_no,$reftrip_hid,$ref_qty);*/

			    }

	        $response_array['response'] = 'success';
		    $data = json_encode($response_array);
		    print_r($data);

          }catch (\Exception $e) {

			    DB::rollBack();
			    throw $e;
			    $response_array['response'] = 'error';
	            $data = json_encode($response_array);
	            print_r($data);
			}
	
		    //throw $e;
		   
		


    }
    
   
  

    public function ViewLrAcnowledgment(Request $request){

    	if($request->ajax()) {
			$title    = 'View Lorry Receipt';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
		
		      $CompanyCode                = $request->session()->get('company_name');

		      $compcode                   = explode('-', $CompanyCode);
		    //print_r($compcode);exit;
		      $getcompcode                = $compcode[0];
			
			$fisYear  =  $request->session()->get('macc_year');

      //$data = DB::table('TRIP_HEAD')->where('COMP_CODE',$getcompcode)->where('LR_ACK_STATUS','1')->orderBy('TRIPHID','DESC');

      $data = DB::table('TRIP_HEAD')
				->select('TRIP_HEAD.*', 'TRIP_BODY.LR_NO')
           		->leftjoin('TRIP_BODY', 'TRIP_BODY.TRIPHID', '=', 'TRIP_HEAD.TRIPHID')
           		->where('TRIP_HEAD.COMP_CODE',$getcompcode)
           		->where('TRIP_HEAD.LR_STATUS','1')
           		->where('TRIP_HEAD.LR_ACK_STATUS','1')
           		->orderBy('TRIPHID','DESC')
           		->groupBy('TRIP_BODY.LR_NO');
	    
			 return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}
    	return view('admin.finance.transaction.logistic.view_lr_ackonledgmnt');

    }



    public function EditLrAcnowledgment(Request $request,$tripId){


		$title                       = 'Add Lorry Acknowledgment';
		$compName                    = $request->session()->get('company_name');
		$fisYear                     =  $request->session()->get('macc_year');
		$CompanyCode                 = $request->session()->get('company_name');
		$compcode                    = explode('-', $CompanyCode);
		$getcompcode                 = $compcode[0];
	
		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();
		
		$userdata['vehicle_list']    = DB::table('MASTER_FLEET')->get();
		
		$userdata['inward_list']     = DB::table('MASTER_INWARD_SLIP')->get();
		
		$userdata['transport_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();
		
		$userdata['getacc']          = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']     = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T3'])->get();
		//dd(DB::getQueryLog());
		$userdata['tax_code_list']   = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		//DB::enableQueryLog();
		$userdata['dept_list']       = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']      = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']       = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']       = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']       = DB::table('MASTER_COST')->get();
		$userdata['emp_list']        = DB::table('MASTER_EMP')->get();
		
		$userdata['item_list']       = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']       = DB::table('MASTER_RATE_VALUE')->get();
		
		$userdata['area_list']       = DB::table('MASTER_AREA')->get();

		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['truck_list']      = DB::table('MASTER_FLEET')->get();
		
		$userdata['comp_list']       = DB::table('MASTER_COMP')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

		$userdata['fpo_list']        = DB::table('FPO_HEAD')->get();

		$userdata['penalty_list']        = DB::table('MASTER_LRACK_PENALTY')->get();

		/*$userdata['trip_list']         = DB::table('TRIP_HEAD')->where('EPOD_STATUS','1')->where('GATE_OUT_STATUS','1')->where('LR_ACK_STATUS','0')->get();*/

		$userdata['trip_list'] = DB::select("SELECT t1.VEHICLE_NO AS VEHICLENO,t2.* FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID  = t2.TRIPHID  WHERE t1.EPOD_STATUS ='1' AND t1.GATE_OUT_STATUS='1' AND t1.LR_ACK_STATUS='0'");
		//print_r($tripId);exit();

		$tripHid =  base64_decode($tripId); 

		$userdata['trip_data'] = DB::select("SELECT t1.*,t2.TRIPBID,t2.DO_NO,t2.DO_DATE,t2.DELORDER_DATE,t2.ITEM_CODE,t2.ITEM_NAME,t2.REMARK,t2.QTY,t2.UM,t2.LR_NO,t2.LR_DATE,t2.INVC_NO,t2.MATERIAL_VAL,t2.RECD_QTY,t2.NET_WEIGHT,t2.SHORTAGE_QTY,t2.SERIES_CODE,t2.EBILL_NO,t2.EWAYB_VALIDDT FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID  WHERE t1.TRIPHID='$tripHid'");


		/*$userdata['trip_exp_charge'] = DB::select("SELECT t1.*,t2.VEHICLE_NO AS VEHICLENO FROM TRIP_CHARGE_EXP t1 LEFT JOIN TRIP_HEAD t2 ON t1.TRIPHID  = t2.TRIPHID  WHERE t1.TRIPHID='$tripHid'");*/


		$userdata['trip_exp_charge'] = DB::select("SELECT t1.* FROM TRIP_CHARGE_EXP t1 where t1.TRIPHID='$tripHid'");

		//print_r($userdata['trip_data']);exit();
		
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$fisYear])->get();

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		

		//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T3')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
		


    
    	return view('admin.finance.transaction.logistic.edit_lr_ackonledgmnt',$userdata);



    }


    public function ViewChildLrAcnowledgment(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$lorry_receipt = DB::table('TRIP_BODY')->where('TRIPHID', $headid)->where('VRNO', $vrno)->get()->toArray();
	    

	    	//print_r($lorry_receipt);exit;

    		if($lorry_receipt) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $lorry_receipt;
	         

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
    

     public function getTripDaysByFromPlace(Request $request){

     		$response_array = array();

		if ($request->ajax()) {

	    	$from_place   = $request->input('form_place');
	    	$to_place   = $request->input('to_place');


		 	
	    	$route_details = DB::table('MASTER_FREIGHT_ROUTE')->where('FROM_PLACE',$from_place)->where('TO_PLACE',$to_place)->get()->first();

	   //print_r($route_details);exit;
	    		

    		if($route_details) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $route_details;
	        
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
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

     }	


     public function getLrDetails(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$lr_no   = $request->input('lr_no');
		 
	    	$explode  = explode(' ', $lr_no);	

	    	$lrno   = $explode[2];


	    	$lr_details = DB::select("SELECT t1.ACC_CODE,t1.ACC_NAME,t1.VRDATE as vrDate,t1.VEHICLE_NO,t1.TRANSPORT_CODE,t1.TRANSPORT_NAME,t1.FROM_PLACE,t1.TO_PLACE,t1.DELIVERY_NO,t1.TRIP_DAY,t1.OFF_DAY,t2.* FROM LR_HEAD t1 LEFT JOIN LR_BODY t2 ON t1.LRHID = t2.LRHID  WHERE t2.VRNO='$lrno'");


	    	//print_r($lr_details);exit;

	    	/*$vehicle_no  =  $trip_plan[0]->VEHICLE_NO;

	    	$trip_inward = DB::table('VEHICLE_GATE_INWARD')->where('VEHICLE_NO', $vehicle_no)->get()->first();*/

    		if($lr_details) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $lr_details;
	           /* $response_array['data_inward'] = $trip_inward;*/
	          
	         

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
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function lr_acknowledgment_msg(Request $request,$saveData){

		if ($saveData==true) {

			$request->session()->flash('alert-success', 'Lorry Receipt Was Successfully Added...!');
			return redirect('/Transaction/Logistic/View-lr-acknowledgment-trans');

		} else {

			$request->session()->flash('alert-error', 'Lorry Receipt Can Not Added...!');
			return redirect('/Transaction/Logistic/View-lr-acknowledgment-trans');

		}
	}
	public function lrAcknowledgmentTransDelete(Request $request){
        //print_r('hello');exit();
   		$id = $request->post('hidnField');

   		   if ($id!='') {

						$gettripheadid = $id;

   		        $tran = DB::select("SELECT * FROM TRIP_CHARGE_EXP WHERE TRIPHID='$gettripheadid'");
   		   
                  // print_r($tran);exit();
   		        		$BodyDataUpdate = '';
   		            for($i=0;$i<count($tran);$i++){

		               	 DB::table('TRIP_CHARGE_EXP')->where('TRIPHID',$gettripheadid)->delete();

		            	}

			            $dataQty1 = array(
			            	"ACK_DATE"            => '',
							"DELIVERY_BY"         => '',
							"DELIVERY_RECD_BY"    => '',
							"PARTY_SIGN"          => '',
							"PARTY_STAMP"         => '',
							"EXP_PAID_PARTY"      => '',
							"DEDUCT_CLAIM_PARTY"  => '',
							"VEHICLE_RETURN"      => '',
							"VEHICLE_RETURN_DATE" => '',
							"WARAI_RECIEPT"       => '',
							"WARAI_RECIEPT_DATE"  => '',
							"TRIP_FREIGHT_AMT"    => '',
							"LESS_ADVANCE"        => '',
							"ADD_LESS_CHRG"       => '',
                            "BASIC_AMT"           => '',
							"NET_AMOUNT"          => '',
		                    'LR_ACK_STATUS'       => '0'
		                );

	               	$HeadDataUpdate = DB::table('TRIP_HEAD')->where('TRIPHID',$gettripheadid)->update($dataQty1);

			            if ($HeadDataUpdate) {

								$request->session()->flash('alert-success', 'Ackonwledgment Was Successfully Delete...!');
								return redirect('/Transaction/Logistic/View-lr-acknowledgment-trans');

			            } else {

					         $request->session()->flash('alert-error', 'Ackonwledgment Can Not Be Delete...!');
					         return redirect('/Transaction/Logistic/View-lr-acknowledgment-trans');

	                  }        

   		    }
   		
   	}

 /*lorry acknowlwdgement*/

 

/*vehicle gate Inward*/

public function AddVehicleGateInward(Request $request)
    {
    	//print_r($this->data);exit;
		$title                      ='Vehicle Gate Inward';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		//print_r($compcode);exit;
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T4'])->where(['COMP_CODE'=>$getcompcode])->get();
		
		$userdata['tax_code_list']  = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
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

		//$userdata['truck_list']      = DB::table('TRIP_HEAD')->where('GATE_STATUS','0')->get();

		$userdata['planing_list']      = DB::table('TRIP_HEAD')->where('COMP_CODE',$getcompcode)->where('GATE_IN_STATUS','0')->where('OWNER','!=','DUMP')->get();

		$userdata['item_list']      = DB::table('MASTER_ITEM')->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		

   		$requistion = DB::table('VEHICLE_GATE_INWARD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();
		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		   $tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T4')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='T4'");
			//print_r($vr_No_list);exit;
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

		    return view('admin.finance.transaction.logistic.vehicle_gate_inward',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }



    public function AddVehicleAdhocAdvance(Request $request)
    {
    	//print_r($this->data);exit;
		$title                      ='Vehicle Adhoc Advance';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		//print_r($compcode);exit;
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T4'])->where(['COMP_CODE'=>$getcompcode])->get();
		
		$userdata['tax_code_list']  = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
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

		//$userdata['truck_list']      = DB::table('TRIP_HEAD')->where('GATE_STATUS','0')->get();

		$userdata['vehicle_list']   = DB::table('MASTER_DRIVER')->get();

		$userdata['item_list']      = DB::table('MASTER_ITEM')->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		

   		$requistion = DB::table('VEHICLE_GATE_INWARD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();
		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		   $tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T4')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='T4'");
			//print_r($vr_No_list);exit;
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

		    return view('admin.finance.transaction.logistic.adhoc_advance_vehicle',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }


     public function SaveVehicleAdhocAdvance(Request $request)
    {

    	//print_r($request->post());exit;
    		$donwloadStatus       = $request->input('pdfYesNoStatus');
			$createdBy            = $request->session()->get('userid');
			$CompanyCode          = $request->session()->get('company_name');
			$compcode             = explode('-', $CompanyCode);
			$getcompcode          =	$compcode[0];
			$fisYear              = $request->session()->get('macc_year');
			$comp_nameval         = $request->input('comp_name');
			$fy_year              = $request->input('fy_year');
			$vr_date              = $request->input('vr_date');
			$vehicle_no          = $request->input('vehicle_no');
			$driver_name          = $request->input('driver_name');
			$driver_code          = $request->input('driver_code');
			$driver_contact_no    = $request->input('driver_contact_no');
			$driver_license_no    = $request->input('driver_license_no');
			$driver_license_ex_dt = $request->input('driver_license_ex_dt');

			$tr_vr_date           = date("Y-m-d", strtotime($vr_date));

			$license_ex_dt        = date("Y-m-d", strtotime($driver_license_ex_dt));

			$bank_code         = $request->input('bank_code');
			$bank_name         = $request->input('bank_name');
			$diesel_amt        = $request->input('diesel_amt');
			$cash_amt          = $request->input('cash_amt');
			$bankAmt           = $request->input('bankAmt');

			$FilterArrayCode   = array_filter($bank_code);
			$bankcount         = count($FilterArrayCode);



	  DB::beginTransaction();

		try {
				   for ($j=0; $j < $bankcount; $j++) {

						
							$data = array(
							
					
							"VRDATE"            => $tr_vr_date,
							"VEHICLE_NO"        => $vehicle_no,
							"EMP_CODE"          => $driver_code,
							"EMP_NAME"          => $driver_name,
							"MOBILE_NO"         => $driver_contact_no,
							"LICENSE_NO"        => $driver_license_no,
							"LICENSE_EXP_DT"    => $license_ex_dt,
							"BANK_CODE"         => $bank_code[$j],
							"BANK_NAME"      	=> $bank_name[$j],
							"PAYMENT"        	=> $bankAmt[$j],
							"CASH_AMT"       	=> $cash_amt[$j],
							"DIESEL_AMT"     	=> $diesel_amt[$j],
							"FLAG"     	       => 0,
							"CREATED_BY"     	=> $createdBy,
							
						);

						$saveData = DB::table('ADHOC_ADV_PMT')->insert($data);

						$lastId =	DB::getPdo()->lastInsertId();

					}

			

				DB::commit();

	       		$response_array['response'] = 'success';

	       		if($donwloadStatus == 1){

					//return $this->GeneratePdfForLoadingSlip($getcompcode,$fisYear,$plant_code,$NewVrno,$createdBy,$headId);

					return $this->GeneratePdfForAdhoC($getcompcode,$lastId,$createdBy);

				}else{

				}

			    $data = json_encode($response_array);
			    print_r($data);

          }catch (\Exception $e) {

			    DB::rollBack();
			    throw $e;
			    $response_array['response'] = 'error';
	            $data = json_encode($response_array);
	            print_r($data);
			}

	}

	

	public function GeneratePdfForAdhoC($getcompcode,$lastId,$createdBy){

		$response_array = array();


		/*$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$customer_code'");*/

		$compDetail =  DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$getcompcode'");


		$dataheadB = DB::SELECT("SELECT t1.* FROM ADHOC_ADV_PMT t1  WHERE t1.TRANID='$lastId'");

		
		header('Content-Type: application/pdf');
     
    	$pdf = PDF::loadView('admin.finance.transaction.logistic.trip_adhoc_pdf',compact('dataheadB','compDetail'));

    	$path = public_path('dist/downloadpdf'); 
    	$fileName =  time().'.'. 'pdf' ; 
    	$pdf->save($path . '/' . $fileName);
    	$PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['data'] = $dataheadB;
        echo $data = json_encode($response_array);

		

		//$this->ConvertAmountIntoWord($dataheadB,,$dataAccDetail,$compDetail,$vrNoPname);

	}



     public function EditVehicleGateInward(Request $request,$id)
    {	

			$title                      ='Vehicle Gate Inward';
			
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
			
			//	$userdata['acc_list']   = DB::table('PORDER_HEAD')->groupBY('ACC_CODE')->get();
			$userdata['acc_list']       = DB::table('MASTER_ACC')->groupBY('ACC_CODE')->get();
			//print_r($userdata['acc_list']);exit;
			$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();
			
			$userdata['truck_list']     = DB::table('MASTER_FLEET')->get();
			
			$userdata['planing_list']   = DB::table('TRIP_HEAD')->get();
			
			$userdata['item_list']      = DB::table('MASTER_ITEM')->get();

    	$vehicleid = base64_decode($id);

       	$vehicledata= DB::table('VEHICLE_GATE_INWARD')->WHERE('VGINWARDID', $vehicleid)->get()->first();

			$vehicleId       = $vehicledata->VGINWARDID; 
			$fromDate        = $vehicledata->INWARD_DATE; 
			$tCode           = $vehicledata->TRAN_CODE; 
			$vrno            = $vehicledata->VRNO; 
			$series_code     = $vehicledata->SERIES_CODE; 
			$series_name     = $vehicledata->SERIES_NAME; 
			$acc_code        = $vehicledata->TRANSPORTER_CODE; 
			$acc_name        = $vehicledata->TRANSPORTER_NAME; 
			$vehicle_no      = $vehicledata->VEHICLE_NO; 
			$vehicle_plan_no = $vehicledata->VEHICLE_PLAN_NO; 
			$from_place      = $vehicledata->FROM_PLACE; 
			$to_place        = $vehicledata->TO_PLACE; 
			$driver_name     = $vehicledata->DRIVER_NAME; 
			$driver_cont_no  = $vehicledata->DRIVER_CONTACT_NO; 
			$driver_ls_no    = $vehicledata->DRIVER_LS_NO; 
			$driver_ex_dt    = $vehicledata->DRIVER_LS_EX_DT; 
			$driver_add      = $vehicledata->DRIVER_ADD; 
			$remark          = $vehicledata->REMARK; 

       	 return view('admin.finance.transaction.logistic.edit_vehicle_gate_inward',$userdata+compact('title','vehicleId','fromDate','tCode','vrno','series_code','series_name','acc_code','acc_name','vehicle_no','driver_name','driver_cont_no','vehicle_plan_no','from_place','to_place','driver_ls_no','driver_ex_dt','driver_add','remark'));

    }


     public function SaveVehicleGateInward(Request $request)
    {
    	/*echo '<pre>';
    	print_r($request->post());exit;
    	echo '</pre>';
*/
			$createdBy            = $request->session()->get('userid');
			$CompanyCode          = $request->session()->get('company_name');
			$compcode             = explode('-', $CompanyCode);
			$getcompcode          =	$compcode[0];
			$fisYear              = $request->session()->get('macc_year');
			$comp_nameval         = $request->input('comp_name');
			$fy_year              = $request->input('fy_year');
			$trans_code           = $request->input('trans_code');
			$series_code          = $request->input('series_code');
			$series_name          = $request->input('series_name');
			$plant_code           = $request->input('plant_code');
			$plant_name           = $request->input('plant_name');
			$pfct_code            = $request->input('pfct_code');
			$pfct_name            = $request->input('pfct_name');
			$acc_code             = $request->input('acc_code');
			$acc_name             = $request->input('acc_name');
			$vehicle_plan_no      = $request->input('vehicle_plan_no');
			$vehicle_no           = $request->input('vehicle_no');
			$from_place           = $request->input('from_place');
			$to_place             = $request->input('to_place');
			$driver_name          = $request->input('driver_name');
			$driver_contact_no    = $request->input('driver_contact_no');
			$driver_license_no    = $request->input('driver_license_no');
			$driver_license_ex_dt = $request->input('driver_license_ex_dt');
			$triphid              = $request->input('triphid');

			$driver_license_date  = date("Y-m-d", strtotime($driver_license_ex_dt));

			$driver_address       = $request->input('driver_address');
			$dob                  = $request->input('date_birth');
			$remark               = $request->input('remark');
			$vr_no                = $request->input('vr_no');
			$vr_date              = $request->input('vr_date');
			$tr_vr_date           = date("Y-m-d H:i:s", strtotime($vr_date));

			$explode = explode(' ', $vehicle_plan_no);

			$plan_series_code  =$explode[1];
			$plan_no  =$explode[2];

		/*	$fycode_explode = explode('-', $fisYear);

			$gyyear_code = $fycode_explode[0];*/



		    //print_r($plan_no);exit;

		DB::beginTransaction();
		try{

			$StoreH = DB::select("SELECT MAX(VGINWARDID) as VGINWARDID FROM VEHICLE_GATE_INWARD");
			$headID = json_decode(json_encode($StoreH), true); 
	    //print_r($tr_vr_date);exit;
	
			if(empty($headID[0]['VGINWARDID'])){
				$headId = 1;
			}else{
				$headId = $headID[0]['VGINWARDID']+1;
			}

			if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('VEHICLE_GATE_INWARD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

			//$gate_inward = $gyyear_code.' '.$series_code.' '.$NewVrno;


	    	$datahead = array(

				'VGINWARDID'        =>$headId,
				'COMP_CODE'         =>$getcompcode,
				'FY_CODE'           =>$fisYear,
				'TRAN_CODE'         =>$trans_code,
				'SERIES_CODE'       =>$series_code,
				'SERIES_NAME'       =>$series_name,
				'PLANT_CODE'        =>$plant_code,
				'PLANT_NAME'        =>$plant_name,
				'PFCT_CODE'         =>$pfct_code,
				'PFCT_NAME'         =>$pfct_name,
				'TRANSPORTER_CODE'  =>$acc_code,
				'TRANSPORTER_NAME'  =>$acc_name,
				'VRNO'              =>$NewVrno,
				'INWARD_DATE'       =>$tr_vr_date,
				'VEHICLE_PLAN_NO'   =>$vehicle_plan_no,
				'VEHICLE_NO'        =>$vehicle_no,
				'FROM_PLACE'        =>$from_place,
				'TO_PLACE'          =>$to_place,
				'DRIVER_NAME'       =>$driver_name,
				'DRIVER_CONTACT_NO' =>$driver_contact_no,
				'DRIVER_LS_NO'      =>$driver_license_no,
				'DRIVER_LS_EX_DT'   =>$driver_license_date,
				'DOB'               =>$dob,
				'DRIVER_ADD'        =>$driver_address,
				'REMARK'            =>$remark,
				'created_by'        =>$createdBy,

			);

			//print_r($datahead);exit;
	    
	        $saveData = DB::table('VEHICLE_GATE_INWARD')->insert($datahead);


	        $plan_date = array(

	        	'GATE_IN_STATUS'      => 1,
	        	'DRIVER_NAME'         => $driver_name,
	        	'DRIVER_MOBILE'       => $driver_contact_no,
	        	'LICENCE_NO'          => $driver_license_no,
	        	'DRIVER_ADD'          => $driver_address,
	        	'DRIVER_LS_EX_DT'     => $driver_license_date,
	        	'DRIVER_DOB'          => $dob,

	        );

	        $saveData1 = DB::table('TRIP_HEAD')->where('TRIPHID',$triphid)->where('SERIES_CODE',$plan_series_code)->where('VRNO',$plan_no)->where('VEHICLE_NO',$vehicle_no)->where('PLAN_STATUS','1')->update($plan_date);


	        $checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->toArray();
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

			  $update = DB::table('MASTER_VRSEQ')->insert($datavrnIn);

			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);

			$update = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			

			/*if($saveData){

	    			$response_array['response'] = 'success';
		            $data = json_encode($response_array);
		            print_r($data);
			}else{
					$response_array['response'] = 'error';
	                $data = json_encode($response_array);
	                print_r($data);
					
			}*/
			

				DB::commit();

	       		$response_array['response'] = 'success';
		        $data = json_encode($response_array);
		        print_r($data);

          }catch (\Exception $e) {

			    DB::rollBack();
			    throw $e;
			   $response_array['response'] = 'error';
	           $data = json_encode($response_array);
	           print_r($data);
			}
		

    }


  public function UpdateVehicleGateInward(Request $request)
    {
    	
			$createdBy            = $request->session()->get('userid');
			$CompanyCode          = $request->session()->get('company_name');
			$compcode             = explode('-', $CompanyCode);
			$getcompcode          =	$compcode[0];
			$fisYear              =  $request->session()->get('macc_year');
			$comp_nameval         = $request->input('comp_name');
			$fy_year              = $request->input('fy_year');
			$trans_code           = $request->input('trans_code');
			$series_code          = $request->input('series_code');
			$series_name          = $request->input('series_name');
			$plant_code           = $request->input('plant_code');
			$plant_name           = $request->input('plant_name');
			$pfct_code            = $request->input('pfct_code');
			$pfct_name            = $request->input('pfct_name');
			$acc_code             = $request->input('acc_code');
			$acc_name             = $request->input('acc_name');
			$vehicle_plan_no      = $request->input('vehicle_plan_no');
			$vehicle_no           = $request->input('vehicle_no');
			$from_place           = $request->input('from_place');
			$to_place             = $request->input('to_place');
			$driver_name          = $request->input('driver_name');
			$driver_contact_no    = $request->input('driver_contact_no');
			$driver_license_no    = $request->input('driver_license_no');
			$driver_license_ex_dt = $request->input('driver_license_ex_dt');
			$driver_address       = $request->input('driver_address');
			$remark               = $request->input('remark');
			$vr_no                = $request->input('vr_no');
			$vr_date              = $request->input('vr_date');
			$tr_vr_date           = date("Y-m-d H:i:s", strtotime($vr_date));

			
			$vehicleId = $request->input('vehicleId');

	    	$datahead = array(

				'VGINWARDID'        =>$vehicleId,
				'COMP_CODE'         =>$getcompcode,
				'FY_CODE'           =>$fisYear,
				'TRAN_CODE'         =>$trans_code,
				'SERIES_CODE'       =>$series_code,
				'SERIES_NAME'       =>$series_name,
				'PLANT_CODE'        =>$plant_code,
				'PLANT_NAME'        =>$plant_name,
				'PFCT_CODE'         =>$pfct_code,
				'PFCT_NAME'         =>$pfct_name,
				'TRANSPORTER_CODE'  =>$acc_code,
				'TRANSPORTER_NAME'  =>$acc_name,
				'VRNO'              =>$vr_no,
				'INWARD_DATE'       =>$tr_vr_date,
				'VEHICLE_PLAN_NO'   =>$vehicle_plan_no,
				'VEHICLE_NO'        =>$vehicle_no,
				'FROM_PLACE'        =>$from_place,
				'TO_PLACE'          =>$to_place,
				'DRIVER_NAME'       =>$driver_name,
				'DRIVER_CONTACT_NO' =>$driver_contact_no,
				'DRIVER_LS_NO'      =>$driver_license_no,
				'DRIVER_LS_EX_DT'   =>$driver_license_ex_dt,
				'DRIVER_ADD'        =>$driver_address,
				'REMARK'            =>$remark,
				'created_by'        =>$createdBy,

			);
	    
	       
	        $updateData = DB::table('VEHICLE_GATE_INWARD')->where('VGINWARDID',$vehicleId)->update($datahead);

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


    public function ViewVehicleGateInward(Request $request)
    {
    	    $compName = $request->session()->get('company_name');

	      if($request->ajax()) {

			$title       ='View Vehicle Gate Inward';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			
			$getcompcode = $compcode[0];

	        $fisYear =  $request->session()->get('macc_year');

	        $userdata['planing_list']   = DB::table('TRIP_HEAD')->get();


            $data = DB::table('TRIP_HEAD')->where('COMP_CODE',$getcompcode)->where('GATE_IN_STATUS','1')->get();


	        
	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	     
	       return view('admin.finance.transaction.logistic.view_vehicle_gate_inward');
	    }else{
			return redirect('/useractivity');
		}
    }


    public function DeleteVehicleGateInward(Request $request){

    	    $Id  = $request->input('fieldOne');

    	   //print_r($Id);exit;

    	    $userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			
			$getcompcode = $compcode[0];

			$data = array(

				'GATE_IN_STATUS'=>'0'
			);

    	  $Updatedata = DB::table('TRIP_HEAD')->where('TRIPHID',$Id)->update($data);

    	  if ($Updatedata) {

			$request->session()->flash('alert-success', 'Gate Vehicle Inward Was Successfully Update...!');
			return redirect('/Transaction/Logistic/View-Vehicle-Gate-Inward');

		} else {

			$request->session()->flash('alert-error', 'Gate Vehicle Inward Can Not Update...!');
			return redirect('/Transaction/Logistic/View-Vehicle-Gate-Inward');

		}

    	 
    }


   function VehiclePlanDetails(Request $request){


    	$response_array = array();

		if ($request->ajax()) {

				$trip_no     = $request->input('trip_no');
		    	$vehicleno   = $request->input('vehicle_no');
		    	$tripHid     = $request->input('tripHid');

		    if($trip_no){

				$explode     = explode(' ', $trip_no);

				$fy_code     = $explode[0];

				$series_code = $explode[1];

				$palnno      = $explode[2];


	    	 $lr_details = DB::select("SELECT t1.*,t2.*,t2.NET_WEIGHT as NEWT_WEIGHTB FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID  = t2.TRIPHID  WHERE t1.TRIP_NO ='$trip_no' AND t1.TRIPHID='$tripHid' AND t1.TRIP_EXP_STATUS='0'");




	          $getadata = DB::table('TRIP_HEAD')->where('TRIPHID',$tripHid)->where('VRNO',$palnno)->where('SERIES_CODE',$series_code)->get()->first();

	          $vehicle_no = $getadata->VEHICLE_NO;

	         // DB::enableQueryLog();

	         $ref_trip_list  = DB::table('TRIP_HEAD')->where('VEHICLE_NO',$vehicle_no)->where('OWNER','SELF')->where('GATE_IN_STATUS','1')->where('TRIP_EXP_STATUS','0')->where('TRIP_EXPENSE','NO')->get();

	        // print_r($ref_trip_list);exit;

	         //dd(DB::getQueryLog());

	          $trip_data = 'TRIPNO';

	      }else{

	      	 $lr_details = DB::select("SELECT t1.*,t2.*,t2.NET_WEIGHT as NEWT_WEIGHTB FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID  = t2.TRIPHID  WHERE t1.VEHICLE_NO ='$vehicleno' AND t1.TRIPHID='$tripHid' AND t1.TRIP_EXP_STATUS='0'");

	          $getadata = DB::table('TRIP_HEAD')->where('TRIPHID',$tripHid)->where('VEHICLE_NO',$vehicleno)->get()->first();

	          $vehicle_no = $vehicleno;
	          

	          $ref_trip_list  = DB::table('TRIP_HEAD')->where('VEHICLE_NO',$vehicle_no)->where('OWNER','SELF')->where('GATE_IN_STATUS','1')->where('TRIP_EXP_STATUS','0')->where('TRIP_EXPENSE','NO')->get();

	          $trip_data = 'VEHICLENO';


	      }

	         $route_details =  DB::table('MASTER_FREIGHT_ROUTE')->where('ROUTE_CODE',$getadata->ROUTE_CODE)->get();

	         $vehicle_details = DB::table('MASTER_FLEET')->where('TRUCK_NO',$vehicle_no)->get()->first();


	      	$kmCal  = DB::select("SELECT sum(km) as kilometer FROM MASTER_FREIGHT_ROUTE H  WHERE H.ROUTE_CODE ='$getadata->ROUTE_CODE'");

            $totalkm = $kmCal[0]->kilometer;



            $adhocAdv  = DB::select("SELECT * FROM ADHOC_ADV_PMT P  WHERE P.VEHICLE_NO ='$vehicle_no' AND P.FLAG='0'");

            if($adhocAdv){

            	$adhoc_data = $adhocAdv;

            }else{
            	$adhoc_data = '';

            }

           
				$data1 = '';

    		if ($getadata || $lr_details) {

				$response_array['response']     = 'success';
				$response_array['data']         = $getadata;
				$response_array['vehicle_data'] = $vehicle_details;
				//$response_array['inward_data']  = $inward_details;
				$response_array['lr_data']      = $lr_details;
				$response_array['route_data']   = $route_details;
				//$response_array['driver_data']   = $driver_data;
				$response_array['vehicle_info']   = $data1;
				$response_array['adhoc_data']   = $adhoc_data;
				$response_array['km'] = $totalkm;
				$response_array['trip_type'] = $trip_data;
				$response_array['ref_trip_list'] = $ref_trip_list;
	            

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


function GeRefQtyRefTripNo(Request $request){


    	$response_array = array();

		if ($request->ajax()) {

		$RefTripNo      = $request->RefTripNo;
		$RefTripHid     = $request->RefTripHid;
		$tripHid        = $request->tripHid;
	
	       
          $getadata =  DB::SELECT("SELECT a.*,SUM(b.QTY) AS FQTY FROM TRIP_HEAD a LEFT JOIN TRIP_BODY b ON a.TRIPHID = b.TRIPHID WHERE a.TRIP_NO='$RefTripNo' AND a.TRIPHID='$RefTripHid'");

          $comp_code = $getadata[0]->COMP_CODE;

          $getCompData = DB::table('MASTER_COMP')->where('COMP_CODE',$comp_code)->get()->first();


           //DB::enableQueryLog();
 //

          $getalldata =  DB::SELECT("SELECT a.*,b.* FROM TRIP_HEAD a LEFT JOIN TRIP_BODY b ON a.TRIPHID = b.TRIPHID WHERE a.TRIPHID IN($tripHid,$RefTripHid)");

       

        // print_r($getalldata);exit;
	    	
    		if ($getadata) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $getadata;
	            $response_array['alldata'] = $getalldata;
	            $response_array['data_comp'] = $getCompData;
	       
	         

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['alldata'] = '';
	            $response_array['data_comp'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['alldata'] = '';
	            $response_array['data_comp'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }


    }

     function VehiclePlanByVehicleDetails(Request $request){


    	$response_array = array();

		if ($request->ajax()) {

			  $vehicle_no     = $request->vehicle_no;

	        $getadata = DB::table('TRIP_HEAD')->where('VEHICLE_NO',$vehicle_no)->where('TRIP_EXP_STATUS','0')->get()->first();

	        //print_r($getadata);exit;

	        $fy_year = $getadata->FY_CODE;

	        $explode = explode('-',$fy_year);

	        $fy_code = $explode[0];

	        $vr_no = $getadata->VRNO;

	        $series_code = $getadata->SERIES_CODE;

	        $trip_no = $fy_code.' '.$series_code.' '.$vr_no;
	        

	        $route_details =  DB::table('MASTER_FREIGHT_ROUTE')->where('ROUTE_CODE',$getadata->ROUTE_CODE)->get();

	    	$vehicle_details = DB::table('MASTER_FLEET')->where('TRUCK_NO',$vehicle_no)->get()->first();


	    	$lr_details = DB::select("SELECT t1.*,t2.* FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID  = t2.TRIPHID  WHERE t1.VRNO='$vr_no'  AND t1.SERIES_CODE='$series_code' AND TRIP_EXP_STATUS='0'");

	    	

            $adhocAdv  = DB::select("SELECT * FROM ADHOC_ADV_PMT P  WHERE P.VEHICLE_NO ='$vehicle_no' AND P.FLAG='0'");

            if($adhocAdv){

            	$adhoc_data = $adhocAdv;

            }else{
            	$adhoc_data = '';

            }

       
			$data1 = '';
			

    		if ($getadata || $lr_details) {

				$response_array['response']     = 'success';
				$response_array['data']         = $getadata;
				$response_array['vehicle_data'] = $vehicle_details;
				//$response_array['inward_data']  = $inward_details;
				$response_array['lr_data']      = $lr_details;
				$response_array['route_data']   = $route_details;
				//$response_array['driver_data']   = $driver_data;
				$response_array['vehicle_info']   = $data1;
				$response_array['adhoc_data']   = $adhoc_data;

				//$response_array['expense_data'] = $fleetExp;
				//$response_array['km'] = $totalkm;
	            

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


 function VehicleInfoForOutward(Request $request){


    	$response_array = array();

		if ($request->ajax()) {

		$truckNo     = $request->truckNo;
		$explodeTrip = explode('~', $truckNo);

		$vehicleNo =  $explodeTrip[0];
		$tripHid = $explodeTrip[1];
	       
          $getadata =  DB::SELECT("SELECT * FROM TRIP_HEAD a WHERE a.VEHICLE_NO='$vehicleNo' AND a.TRIPHID='$tripHid' AND  a.PLAN_STATUS='1' AND a.GATE_IN_STATUS='1'AND a.LR_STATUS='1' AND a.GATE_OUT_STATUS='0'");

         // print_r($getadata);exit;
	    	
    		if ($getadata) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $getadata;
	       
	         

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



  function VehicleTypeDetails(Request $request){


     $response_array = array();

    if ($request->ajax()) {


     $truckNo     = $request->truckNo;
     $tripHid     = $request->tripHid;
     //print_r($tripHid);exit;

     		if($truckNo){

		        $getadata = DB::table('TRIP_HEAD')->where('TRIPHID',$tripHid)->where('VEHICLE_NO',$truckNo)->where('PLAN_STATUS','1')->where('GATE_IN_STATUS','0')->get()->first();

		        //print_r($getadata);exit;

		        $masterDriver = DB::select("SELECT EMP_NAME AS DRIVER_NAME,LICENSE_NO AS DRIVER_ID,MOBILE_NO AS MOBILE_NUMBER FROM MASTER_DRIVER WHERE VEHICLE_NO='$truckNo' AND BLOCK_DRIVER='NO' AND (TO_DATE IS NULL OR TO_DATE='')");   

                if($masterDriver){

                    $driverDetails = $masterDriver;
                    
                }else{

                    $driverDetails = DB::select("SELECT DRIVER_NAME,DRIVER_ID,MOBILE_NUMBER FROM CS_GATE_ENTRY WHERE VEHICLE_NUMBER='$truckNo' ORDER BY VEHICLE_NUMBER DESC");

                }


                  $token = $request->session()->get('api_token');

			       $authorization = "Authorization: Bearer ".$token;

			        $curl = curl_init();
			        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
			    
				    curl_setopt($curl, CURLOPT_URL, "https://ulip.logilocker.in/logilocker/api/vahan?vehicleNo=".$truckNo."&gstin=''&forceUpdate=true");
				    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				    $result = curl_exec($curl);
				    curl_close($curl);
				    $data1 = json_decode($result, true);

     		}else{


     			$vehicle_plan_no     = $request->vehicle_plan_no;

			    $explode =  explode(' ', $vehicle_plan_no);

			    $fy_year = $explode[0];
			    $series_code = $explode[1];
			    $vrno = $explode[2];

		        $getadata_truck = DB::table('TRIP_HEAD')->where('TRIPHID',$tripHid)->where('VRNO',$vrno)->where('SERIES_CODE',$series_code)->where('PLAN_STATUS','1')->where('GATE_IN_STATUS','0')->get()->first();

		        $getadata = DB::table('TRIP_HEAD')->where('TRIPHID',$tripHid)->where('VEHICLE_NO',$getadata_truck->VEHICLE_NO)->where('PLAN_STATUS','1')->where('GATE_IN_STATUS','0')->get()->first();

		        $truckNo = $getadata_truck->VEHICLE_NO;

		        $masterDriver = DB::select("SELECT EMP_NAME AS DRIVER_NAME,LICENSE_NO AS DRIVER_ID,MOBILE_NO AS MOBILE_NUMBER FROM MASTER_DRIVER WHERE VEHICLE_NO='$truckNo' AND BLOCK_DRIVER='NO' AND (TO_DATE IS NULL OR TO_DATE='')");   


                if($masterDriver){

                    $driverDetails = $masterDriver;
                    
                }else{

                    $driverDetails = DB::select("SELECT DRIVER_NAME,DRIVER_ID,MOBILE_NUMBER FROM CS_GATE_ENTRY WHERE VEHICLE_NUMBER='$truckNo' ORDER BY VEHICLE_NUMBER DESC");

                }


                $token = $request->session()->get('api_token');

			       $authorization = "Authorization: Bearer ".$token;

			        $curl = curl_init();
			        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
			    
				    curl_setopt($curl, CURLOPT_URL, "https://ulip.logilocker.in/logilocker/api/vahan?vehicleNo=".$truckNo."&gstin=''&forceUpdate=true");
				    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				    $result = curl_exec($curl);
				    curl_close($curl);
				    $data1 = json_decode($result, true);


     		}

		      

     		//print_r($data1);exit;
       


       
        
        if ($getadata) {

              $response_array['response'] = 'success';
              $response_array['data'] = $getadata;
             // $response_array['vehicle_type'] = $vehicle_type;
              $response_array['driver_details'] = $driverDetails;
              $response_array['vehicle_info'] = $data1;
              

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


    function VehicleForAdhocAavnace(Request $request){

      $response_array = array();

    if ($request->ajax()) {

       $truckNo     = $request->truckNo;
    
       $getadata = DB::table('MASTER_DRIVER')->where('VEHICLE_NO',$truckNo)->get()->first();
        
        if($getadata){

              $response_array['response'] = 'success';
              $response_array['data'] = $getadata;
     
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


     function GetLocalTripExpQty(Request $request){

      $response_array = array();

    if ($request->ajax()) {

       $model_no     = $request->model_no;
    
       $getadata = DB::table('MASTER_LOCAL_EXP')->where('MODEL',$model_no)->get();
        
        if($getadata){

              $response_array['response'] = 'success';
              $response_array['data'] = $getadata;
     
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


    function GetLocalTripExpDieselQty(Request $request){

      $response_array = array();

    if ($request->ajax()) {

       $model_no     = $request->model_no;
       $qty     = $request->qty;
    
       $getadata = DB::table('MASTER_LOCAL_EXP')->where('MODEL',$model_no)->where('QTY',$qty)->get()->first();
        
        if($getadata){

              $response_array['response'] = 'success';
              $response_array['data'] = $getadata;
     
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

    function DrivingLsDetails(Request $request){


    	$response_array = array();

		if ($request->ajax()) {


		$date_birth     = $request->date_birth;
		$driving_ls_no     = $request->driving_ls_no;
		
		$token = $request->session()->get('api_token');

    	$authorization = "Authorization: Bearer ".$token;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
    
		curl_setopt($curl, CURLOPT_URL, "https://ulip.logilocker.in/logilocker/api/dl?dlnumber=".$driving_ls_no."&dob=".$date_birth."&forceUpdate=true");

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		curl_close($curl);
		$data1 = json_decode($result, true);

		//print_r($data1);exit;

	
    		if ($data1) {

    			$response_array['response'] = 'success';
	          
	            $response_array['data'] = $data1;
	            

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



    function VehicleDetails(Request $request){


    	$response_array = array();

		if ($request->ajax()) {

			$vehicle_no = $request->vehicle_no;
			$tripid = $request->tripid;
		
	    	$vehicle_details = DB::table('MASTER_FLEET')->where('TRUCK_NO',$vehicle_no)->get()->first();

	    	//$getadata = DB::table('TRIP_HEAD')->where('TRIPHID',$tripid)->get()->first();

	        /*$route_details =  DB::table('MASTER_FREIGHT_ROUTE')->where('ROUTE_CODE',$getadata->ROUTE_CODE)->get();*/
	        $route_details =  DB::table('TRIP_EXPENSE_ROUTE')->where('TRIPHID',$tripid)->get();

	        $kmCal  = DB::select("SELECT sum(km) as kilometer FROM TRIP_EXPENSE_ROUTE H  WHERE H.TRIPHID ='$tripid'");

             $km = $kmCal[0]->kilometer;
	    	//print_r($vehicle_details);exit;
	  
    		if ($vehicle_details) {

				$response_array['response']     = 'success';
				$response_array['data']         = $vehicle_details;
				$response_array['route_data']   = $route_details;
				$response_array['km']   = $km;

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




    public function vehilce_inward_gate_msg(Request $request,$saveData){

		if ($saveData) {

			$request->session()->flash('alert-success', 'Vehicle Gate Inward Was Successfully Added...!');
			return redirect('/Transaction/Logistic/View-Vehicle-Gate-Inward');

		} else {

			$request->session()->flash('alert-error', 'Vehicle Gate Inward Can Not Added...!');
			return redirect('/Transaction/Logistic/View-Vehicle-Gate-Inward');

		}
	}


/*vehicle gate Inward*/



/*vehicle gate Inward*/

public function AddVehicleGateOutward(Request $request)
    {
      //print_r($this->data);exit;
    $title                      ='Vehicle Gate Outward';
    
    $CompanyCode                = $request->session()->get('company_name');
    $compcode                   = explode('-', $CompanyCode);
    //print_r($compcode);exit;
    $getcompcode                = $compcode[0];
    $macc_year                  = $request->session()->get('macc_year');
    
    $userdata['acc_list'] = DB::table('MASTER_ACC')->groupBY('ACC_CODE')->get();
      
  
    $userdata['planing_list']      = DB::table('TRIP_HEAD')->where('COMP_CODE',$getcompcode)->where('GATE_IN_STATUS','1')->where('GATE_OUT_STATUS','0')->where('LR_STATUS','1')->get();


    if(isset($CompanyCode)){

        return view('admin.finance.transaction.logistic.vehicle_gate_outward',$userdata+compact('title'));

    }else{

        return redirect('/useractivity');
    }
       

    }


     public function EditVehicleGateOutward(Request $request,$id)
    { 

      $title                      ='Vehicle Gate Inward';
      
      $CompanyCode                = $request->session()->get('company_name');
      $compcode                   = explode('-', $CompanyCode);
      $getcompcode                = $compcode[0];
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
      
      //  $userdata['acc_list']   = DB::table('PORDER_HEAD')->groupBY('ACC_CODE')->get();
      $userdata['acc_list']       = DB::table('MASTER_ACC')->groupBY('ACC_CODE')->get();
      //print_r($userdata['acc_list']);exit;
      $userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();
      
      $userdata['truck_list']     = DB::table('MASTER_FLEET')->get();
      
      $userdata['planing_list']   = DB::table('TRIP_HEAD')->get();
      
      $userdata['item_list']      = DB::table('MASTER_ITEM')->get();

      $vehicleid = base64_decode($id);

        $vehicledata= DB::table('VEHICLE_GATE_INWARD')->WHERE('VGINWARDID', $vehicleid)->get()->first();

      $vehicleId       = $vehicledata->VGINWARDID; 
      $fromDate        = $vehicledata->INWARD_DATE; 
      $tCode           = $vehicledata->TRAN_CODE; 
      $vrno            = $vehicledata->VRNO; 
      $series_code     = $vehicledata->SERIES_CODE; 
      $series_name     = $vehicledata->SERIES_NAME; 
      $acc_code        = $vehicledata->TRANSPORTER_CODE; 
      $acc_name        = $vehicledata->TRANSPORTER_NAME; 
      $vehicle_no      = $vehicledata->VEHICLE_NO; 
      $vehicle_plan_no = $vehicledata->VEHICLE_PLAN_NO; 
      $from_place      = $vehicledata->FROM_PLACE; 
      $to_place        = $vehicledata->TO_PLACE; 
      $driver_name     = $vehicledata->DRIVER_NAME; 
      $driver_cont_no  = $vehicledata->DRIVER_CONTACT_NO; 
      $driver_ls_no    = $vehicledata->DRIVER_LS_NO; 
      $driver_ex_dt    = $vehicledata->DRIVER_LS_EX_DT; 
      $driver_add      = $vehicledata->DRIVER_ADD; 
      $remark          = $vehicledata->REMARK; 

         return view('admin.finance.transaction.logistic.edit_vehicle_gate_inward',$userdata+compact('title','vehicleId','fromDate','tCode','vrno','series_code','series_name','acc_code','acc_name','vehicle_no','driver_name','driver_cont_no','vehicle_plan_no','from_place','to_place','driver_ls_no','driver_ex_dt','driver_add','remark'));

    }


     public function SaveVehicleGateOutward(Request $request)
    {
    	/*echo '<pre>';
       print_r($request->post());exit;*/

      $createdBy            = $request->session()->get('userid');
      $CompanyCode          = $request->session()->get('company_name');
      $compcode             = explode('-', $CompanyCode);
      $getcompcode          = $compcode[0];
      $fisYear              = $request->session()->get('macc_year');
      $comp_nameval         = $request->input('comp_name');
      $fy_year              = $request->input('fy_year');
     
      $consinee_code        = $request->input('consinee_code');
      $consinee_name        = $request->input('consinee_name');
     
      $vehicle_no           = $request->input('vehicle_no');
       
      
      $from_place           = $request->input('from_place');
      $to_place             = $request->input('to_place');
      $driver_name          = $request->input('driver_name');
      $driver_contact_no    = $request->input('driver_contact_no');
      $driver_license_no    = $request->input('driver_license_no');
      $driver_license_ex_dt = $request->input('driver_license_ex_dt');
      $trip_no = $request->input('tripNo');
      $seriesCode = $request->input('seriesCode');
      $vrNo = $request->input('vrNo');
      $triphid = $request->input('tripHid');

      $driver_license_date  = date("Y-m-d", strtotime($driver_license_ex_dt));

      $driver_address       = $request->input('driver_address');
      $dob                  = $request->input('date_birth');
      $vr_date              = $request->input('vr_date');
      $tr_vr_date           = date("Y-m-d H:i:s", strtotime($vr_date));


      DB::beginTransaction();

		try {

        $datahead = array(

      
          'VEHICLE_OUT_DT_TIME' =>$tr_vr_date,
          'DRIVER_NAME'         =>$driver_name,
          'DRIVER_MOBILE'       =>$driver_contact_no,
          'LICENCE_NO'          =>$driver_license_no,
          'DRIVER_LS_EX_DT'     =>$driver_license_date,
          'DRIVER_DOB'          =>$dob,
          'DRIVER_ADD'          =>$driver_address,
          'GATE_OUT_STATUS'     =>1,
          'created_by'          =>$createdBy,

      );

      
    $saveData = DB::table('TRIP_HEAD')->where('TRIPHID',$triphid)->where('SERIES_CODE',$seriesCode)->where('VRNO',$vrNo)->where('VEHICLE_NO',$vehicle_no)->update($datahead);


      	DB::commit();

	         $response_array['response'] = 'success';
            $data = json_encode($response_array);
            print_r($data);

          }catch (\Exception $e) {

			    DB::rollBack();
			    throw $e;
			     $response_array['response'] = 'error';
		          $data = json_encode($response_array);
		          print_r($data);
		}
      
    }


  public function UpdateVehicleGateOutward(Request $request)
    {
      
      $createdBy            = $request->session()->get('userid');
      $CompanyCode          = $request->session()->get('company_name');
      $compcode             = explode('-', $CompanyCode);
      $getcompcode          = $compcode[0];
      $fisYear              =  $request->session()->get('macc_year');
      $comp_nameval         = $request->input('comp_name');
      $fy_year              = $request->input('fy_year');
      $trans_code           = $request->input('trans_code');
      $series_code          = $request->input('series_code');
      $series_name          = $request->input('series_name');
      $plant_code           = $request->input('plant_code');
      $plant_name           = $request->input('plant_name');
      $pfct_code            = $request->input('pfct_code');
      $pfct_name            = $request->input('pfct_name');
      $acc_code             = $request->input('acc_code');
      $acc_name             = $request->input('acc_name');
      $vehicle_plan_no      = $request->input('vehicle_plan_no');
      $vehicle_no           = $request->input('vehicle_no');
      $from_place           = $request->input('from_place');
      $to_place             = $request->input('to_place');
      $driver_name          = $request->input('driver_name');
      $driver_contact_no    = $request->input('driver_contact_no');
      $driver_license_no    = $request->input('driver_license_no');
      $driver_license_ex_dt = $request->input('driver_license_ex_dt');
      $driver_address       = $request->input('driver_address');
      $remark               = $request->input('remark');
      $vr_no                = $request->input('vr_no');
      $vr_date              = $request->input('vr_date');
      $tr_vr_date           = date("Y-m-d H:i:s", strtotime($vr_date));

      
      $vehicleId = $request->input('vehicleId');

        $datahead = array(

        'VGINWARDID'        =>$vehicleId,
        'COMP_CODE'         =>$getcompcode,
        'FY_CODE'           =>$fisYear,
        'TRAN_CODE'         =>$trans_code,
        'SERIES_CODE'       =>$series_code,
        'SERIES_NAME'       =>$series_name,
        'PLANT_CODE'        =>$plant_code,
        'PLANT_NAME'        =>$plant_name,
        'PFCT_CODE'         =>$pfct_code,
        'PFCT_NAME'         =>$pfct_name,
        'TRANSPORTER_CODE'  =>$acc_code,
        'TRANSPORTER_NAME'  =>$acc_name,
        'VRNO'              =>$vr_no,
        'INWARD_DATE'       =>$tr_vr_date,
        'VEHICLE_PLAN_NO'   =>$vehicle_plan_no,
        'VEHICLE_NO'        =>$vehicle_no,
        'FROM_PLACE'        =>$from_place,
        'TO_PLACE'          =>$to_place,
        'DRIVER_NAME'       =>$driver_name,
        'DRIVER_CONTACT_NO' =>$driver_contact_no,
        'DRIVER_LS_NO'      =>$driver_license_no,
        'DRIVER_LS_EX_DT'   =>$driver_license_ex_dt,
        'DRIVER_ADD'        =>$driver_address,
        'REMARK'            =>$remark,
        'created_by'        =>$createdBy,

      );
      
         
          $updateData = DB::table('VEHICLE_GATE_INWARD')->where('VGINWARDID',$vehicleId)->update($datahead);

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


    public function ViewVehicleGateOutward(Request $request)
    {
        $compName = $request->session()->get('company_name');

       if($request->ajax()) {

      $title       ='View Vehicle Gate Outward';
      
      $userid      = $request->session()->get('userid');
      
      $userType    = $request->session()->get('usertype');
      
      $compName    = $request->session()->get('company_name');
      
      $compcode    = explode('-', $compName);
      
      $getcompcode = $compcode[0];

      $fisYear =  $request->session()->get('macc_year');


      $data = DB::table('TRIP_HEAD')->where('COMP_CODE',$getcompcode)->where('GATE_OUT_STATUS','1')->get();


          
        return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
                  
              })->toJson();

      }
      if(isset($compName)){

       
         return view('admin.finance.transaction.logistic.view_vehicle_gate_outward');
      }else{
      return redirect('/useractivity');
    }
    }

     public function DeleteVehicleGateOutward(Request $request){

    	    $Id  = $request->input('fieldOne');

    	    $userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			
			$getcompcode = $compcode[0];

			$data = array(

				'GATE_OUT_STATUS'=>'0'
			);

    	  $Updatedata = DB::table('TRIP_HEAD')->where('TRIPHID',$Id)->update($data);

    	  if ($Updatedata) {

			$request->session()->flash('alert-success', 'Gate Vehicle Outward Was Successfully Update...!');
			return redirect('/Transaction/Logistic/View-Vehicle-Gate-Outward');

		} else {

			$request->session()->flash('alert-error', 'Gate Vehicle Outward Can Not Update...!');
			return redirect('/Transaction/Logistic/View-Vehicle-Gate-Outward');

		}

    	 
    }



 public function vehilce_outward_gate_msg(Request $request,$saveData){

    if ($saveData) {

      $request->session()->flash('alert-success', 'Vehicle Gate Outward Was Successfully Added...!');
      return redirect('/Transaction/Logistic/View-Vehicle-Gate-Outward');

    } else {

      $request->session()->flash('alert-error', 'Vehicle Gate Outward Can Not Added...!');
      return redirect('/Transaction/Logistic/View-Vehicle-Gate-Outward');

    }
  }
/* ---------- start fleet tranaction -------------- */
	
	public function FleetTrnas(Request $request){

		$CompanyCode              = $request->session()->get('company_name');
		$compcode                 = explode('-', $CompanyCode);
		$getcompcode              =$compcode[0];
		$macc_year                = $request->session()->get('macc_year');
		
		$title                    ='Add Fleet Transaction';
		
		$userData['acc_list']     = DB::table('MASTER_ACC')->get();
		$userData['depot_list']   = DB::table('MASTER_DEPOT')->get();
		$userData['area_list']    = DB::table('MASTER_AREA')->get();
		$userData['acctype_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userData['emp_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','E')->get();
		$userData['series_list']  = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T5'])->where(['COMP_CODE'=>$getcompcode])->get();
		$userData['item_list']    = DB::table('MASTER_ITEM')->get();
		$userData['truck_list']   = DB::table('MASTER_FLEET')->where('OWNER','SELF')->get();
		$userData['trip_list']    = DB::table('TRIP_HEAD')->where('COMP_CODE',$getcompcode)->where('OWNER','SELF')->where('GATE_IN_STATUS','1')->where('TRIP_EXP_STATUS','0')->where('TRIP_EXPENSE','YES')->get();


		$userData['bank_list']    = DB::table('MASTER_HOUSEBANK')->get();
		$userData['vehicle_list'] = DB::table('VEHICLE_GATE_INWARD')->get();
		$userData['gl_list']      = DB::table('MASTER_GL')->get();
		$userData['route_list']   = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('ROUTE_CODE')->get();
		$userData['from_place_list']   = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('FROM_PLACE')->get();
		$userData['to_place_list']   = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('TO_PLACE')->get();

		$userData['diesel_rate']  = DB::table('MASTER_DIESEL_RATE')->Orderby('ID','desc')->get()->first();
		$userData['transport_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();

		//print_r($userData['diesel_rate']);exit;

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userData['fromDate'] =  $key->FY_FROM_DATE;
					$userData['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		$requistion = DB::table('FLEET_TRAN')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();

	//	print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userData['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T5')->get();

   		      $userData['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r($tranHeadL);exit;
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='T5'");
		//	print_r($vr_No_list);exit;
		//dd(DB::getQueryLog());
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userData['last_num']   = $key->LAST_NO;
					$userData['to_num']     = $key->TO_NO;
					//$userdata['trans_head'] = $key->TRAN_CODE;
				}

			}else{

					$userData['last_num']  ='';
					$userData['to_num']  ='';
					//$userdata['trans_head']  ='';

			}

		
			//print_r($userData['acctype_list']);exit;
		
		return view('admin.finance.transaction.logistic.fleet_trans_form',$userData+compact('title'));
		
	}

	public function FleetTransSave(Request $request){

		/*echo '<pre>';
		print_r($request->post());exit;
		echo '</pre>';*/

		$createdBy         = $request->session()->get('userid');
		
		$CompanyCode       = $request->session()->get('company_name');

		$compcode          = explode('-', $CompanyCode);
		
		$getcompcode       =$compcode[0];

		$fisYear           =  $request->session()->get('macc_year');

		$donwloadStatus    = $request->input('donwloadStatus');
		
		$trdate            = $request->input('date');
		$Transaction_date  = date("Y-m-d", strtotime($trdate));
		$diesel_date       = $request->input('diesel_rate_date');
		$diesel_rate_date  = date("Y-m-d", strtotime($diesel_date));
		
		$transcode         = $request->input('transcode');
		$series_code       = $request->input('series');
		$series_name       = $request->input('series_name');
		$trip_no           = $request->input('trip_no');
		$trip_type         = $request->input('trip_type');
		$tripid            = $request->input('tripid');
		$vehicle_no        = $request->input('vehicle_no');
		$wheel_type        = $request->input('wheel_type');
		$from_place        = $request->input('from_place');
		$to_place          = $request->input('to_place');
		$vehicle_inward_no = $request->input('vehicle_inward_no');
        $owner_type        = $request->input('owner_type');
		$model             = $request->input('model');
		$loadcpct          = $request->input('loadcpct');
		$loadAvg           = $request->input('loadAvg');
		$ulcpct            = $request->input('ulcpct');
		$ulAvg             = $request->input('ulAvg');
		$emptyAvg          = $request->input('emptyAvg');
		$driver_name       = $request->input('driver_name');
		$diesel_rate       = $request->input('diesel_rate');
		$route_name        = $request->input('route_name');
		$point_delivery    = $request->input('point_delivery');
		$vr_no             = $request->input('vr_no');
		$series_code       = $request->input('series');
		$indicator         = $request->input('indicator');
		$FilterArray       = array_filter($indicator);
		$count             = count($FilterArray);
		$Amt               = $request->input('Amt');
		$RefAmt            = $request->input('othercompAmt');
		$gl_code           = $request->input('gl_code');
		$gl_name           = $request->input('gl_name');
		$bank_code         = $request->input('bank_code');
		$FilterArrayCode   = array_filter($bank_code);
		$bankcount         = count($FilterArrayCode);
		$bank_name         = $request->input('bank_name');
		$bankAmt           = $request->input('bankAmt');
		$cash_amt          = $request->input('cash_amt');
		$diesel_amt        = $request->input('diesel_amt');
        $vehicle_type      = $request->input('vehicle_type');
		$source_code       = $request->input('source_code');
		$destination_code  = $request->input('destination_code');
		$km                = $request->input('km');
		$toll              = $request->input('toll');
		$extra_km          = $request->input('extra_km');
		$less_km           = $request->input('less_km');
		$extra_toll        = $request->input('extra_toll');
		$route_code        = $request->input('route_code');
		$route_name        = $request->input('route_name');
		$customer_code     = $request->input('customer_code');
		$customer_name     = $request->input('customer_name');
		$ref_comp_name     = $request->input('ref_comp_name');
		$ref_comp_code     = $request->input('ref_comp_code');
		$ref_comp_code     = $request->input('ref_comp_code');



	    $payment_type     = $request->input('payment_type');
	    $adv_rate         = $request->input('adv_rate');
	    $adv_amount       = $request->input('adv_amount');
	    $refCompTotal     = $request->input('refCompTotal');


	    $indemp_code     = $request->input('indemp_code');
	    $emp_code        = $request->input('emp_code');
	    $empgl_code      = $request->input('empgl_code');
	    $empgl_name      = $request->input('empgl_name');
	    $emp_amt         = $request->input('emp_amt');


	    $pmtind_code     = $request->input('pmtind_code');
	    $pmtemp_code     = $request->input('pmtemp_code');
	    $pmtemp_name     = $request->input('pmtbank_name');
	    $pmtempgl_code   = $request->input('pmtempgl_code');
	    $pmtempgl_name   = $request->input('pmtempgl_name');
	    $pmtemp_amt      = $request->input('pmtemp_amt');
	    $ref_trip_no     = $request->input('ref_trip_no');
	    $freight_qty     = $request->input('freight_qty');
	   

	    if($ref_trip_no){

	    	$reftrip = explode('~',$ref_trip_no);

	    	$reftrip_no = $reftrip[0];
	    	$reftrip_hid = $reftrip[1];
	    	$ref_qty         = $request->input('ref_qty');

	    }else{

	    	 $reftrip_no = '';
	    	 $reftrip_hid = '';
	    	 $ref_qty='';
	    }
	 
	    $VehicleArray      = array_filter($vehicle_type);
		$vehicle_count    = count($VehicleArray);


	//print_r($FilterArray);exit;

		//print_r($RefAmt);exit;
  
	DB::beginTransaction();

		try {

		$data = array(

			"TRIP_TYPE"       => $trip_type,
			"DIESEL_RATE"     => $diesel_rate,
			"MODEL"           => $model,
			"LOAD_CPCT"       => $loadcpct,
			"LOAD_AVG"        => $loadAvg,
			"UL_CPCT"         => $ulcpct,
			"UL_AVG"          => $ulAvg,
			"EMPTY_AVG"       => $emptyAvg,
			"DELIVERY_POINT"  => $point_delivery,
			"REXP_COMP_NAME"  => $ref_comp_name,
			"REXP_COMP_CODE"  => $ref_comp_code,
			"REF_TRIP_NO"     => $ref_trip_no,
			"REF_QTY"         => $ref_qty,
			"REF_HID"         => $reftrip_hid,
			"FREIGHT_QTY"     => $freight_qty,
			"EXP_VR_DATE"     => $Transaction_date,
			"TRIP_EXP_STATUS" => 1,
			"CREATED_BY"      => $createdBy,


		);
		
		$saveData = DB::table('TRIP_HEAD')->where('TRIPHID',$tripid)->update($data);

		 if($ref_trip_no){


		 	$ref_trip_head = array(

		 		"TRIP_EXP_STATUS" => 1,

		 	);

		 	DB::table('TRIP_HEAD')->where('TRIPHID',$reftrip_hid)->update($ref_trip_head);
		 }



		for($i=0; $i < $vehicle_count; $i++) { 

					   $fLeetH1 = DB::select("SELECT MAX(TRIPROUTEID) as TRIPROUTEID  FROM TRIP_EXPENSE_ROUTE");
					    $expID = json_decode(json_encode($fLeetH1), true); 
					  
					    if(empty($expID[0]['TRIPROUTEID'])){
					      $route_Id = 1;
					    }else{
					      $route_Id = $expID[0]['TRIPROUTEID']+1;
					    }

					
				$data_route = array(

					"TRIPROUTEID"  => $route_Id,
			        "TRIPHID"      => $tripid,
					"COMP_CODE"    => $getcompcode,
					"FY_CODE"      => $fisYear,
					"ROUTE_CODE"   => $route_code,
					"ROUTE_NAME"   => $route_name,
					"VEHICLE_TYPE" => $vehicle_type[$i],
					"FROM_PLACE"   => $source_code[$i],
					"TO_PLACE"     => $destination_code[$i],
					"KM"           => $km[$i],
					"TOLL"         => $toll[$i],
					"EXTRA_KM"     => $extra_km[$i],
					"LESS_KM"      => $less_km[$i],
					"EXTRA_TOLL"   => $extra_toll[$i],
					"CREATED_BY"   => $createdBy,
					
				);

				$saveData11 = DB::table('TRIP_EXPENSE_ROUTE')->insert($data_route);

				}

		
			
		for ($i=0; $i < $count; $i++) {

			$fLeetH1 = DB::select("SELECT MAX(FLEETTRANEXPID) as FLEETTRANEXPID FROM FLEET_TRAN_EXP");
		    $expID = json_decode(json_encode($fLeetH1), true); 
		  
		    if(empty($expID[0]['FLEETTRANEXPID'])){
		      $exp_Id = 1;
		    }else{
		      $exp_Id = $expID[0]['FLEETTRANEXPID']+1;
		    }


		    if($RefAmt=='NaN' || $RefAmt==''){
		       
		       $REF_AMT = '0.00';

		    }else{

		       $REF_AMT = $RefAmt[$i];
		    }

			$data = array(

			"FLEETTRANEXPID" => $exp_Id,
			"TRIPHID"        => $tripid,
			"COMP_CODE"      => $getcompcode,
			"FY_CODE"        => $fisYear,
			"IND_CODE"       => $indicator[$i],
			"IND_NAME"       => $indicator[$i],
			"INDEX_CODE"     => 'L',
			"GL_CODE"        => $gl_code[$i],
			"GL_NAME"        => $gl_name[$i],
			"AMOUNT"         => $Amt[$i],
			"REF_AMOUNT"     => $REF_AMT,
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData1 = DB::table('FLEET_TRAN_EXP')->insert($data);

		}

		if($emp_code){

			$fLeetH1 = DB::select("SELECT MAX(FLEETTRANEXPID) as FLEETTRANEXPID FROM FLEET_TRAN_EXP");
		    $expID = json_decode(json_encode($fLeetH1), true); 
		  
		    if(empty($expID[0]['FLEETTRANEXPID'])){
		      $exp_Id = 1;
		    }else{
		      $exp_Id = $expID[0]['FLEETTRANEXPID']+1;
		    }


			$emp_data = array(

				"FLEETTRANEXPID" => $exp_Id,
				"TRIPHID"        => $tripid,
				"COMP_CODE"      => $getcompcode,
				"FY_CODE"        => $fisYear,
				"IND_CODE"       => $indemp_code,
				"IND_NAME"       => $indemp_code,
				"INDEX_CODE"     => 'L',
				"ACC_CODE"       => $emp_code,
				"GL_CODE"        => $empgl_code,
				"GL_NAME"        => $empgl_name,
				"AMOUNT"         => $emp_amt,
				"REF_AMOUNT"     => '0.00',
				"CREATED_BY"     => $createdBy,

			);

		 DB::table('FLEET_TRAN_EXP')->insert($emp_data);

		}
		

		for ($j=0; $j < $bankcount; $j++) {

				$fLeetP = DB::select("SELECT MAX(FLEETTRANPMTID) as FLEETTRANPMTID FROM FLEET_TRAN_PMT");
			    $pmtID = json_decode(json_encode($fLeetP), true); 
			  
			    if(empty($pmtID[0]['FLEETTRANPMTID'])){
			      $pmt_Id = 1;
			    }else{
			      $pmt_Id = $pmtID[0]['FLEETTRANPMTID']+1;
			    } 

						$data = array(
						"FLEETTRANPMTID" => $pmt_Id,
						"TRIPHID"        => $tripid,
						"COMP_CODE"      => $getcompcode,
						"FY_CODE"        => $fisYear,
						"BANK_CODE"      => $bank_code[$j],
						"BANK_NAME"      => $bank_name[$j],
						"PAYMENT"        => $bankAmt[$j],
						"CASH_AMT"       => $cash_amt[$j],
						"DIESEL_AMT"     => $diesel_amt[$j],
						"CREATED_BY"     => $createdBy,
						
					);

		        DB::table('FLEET_TRAN_PMT')->insert($data);

		}

		
			if($pmtemp_code){

				$fLeetP = DB::select("SELECT MAX(FLEETTRANPMTID) as FLEETTRANPMTID FROM FLEET_TRAN_PMT");
			    $pmtID = json_decode(json_encode($fLeetP), true); 
			  
			    if(empty($pmtID[0]['FLEETTRANPMTID'])){
			      $pmt_Id = 1;
			    }else{
			      $pmt_Id = $pmtID[0]['FLEETTRANPMTID']+1;
			    } 

				$emppmt_data = array(
					    "FLEETTRANPMTID" => $pmt_Id,
						"TRIPHID"        => $tripid,
						"COMP_CODE"      => $getcompcode,
						"FY_CODE"        => $fisYear,
						"BANK_CODE"      => $pmtemp_code,
						"BANK_NAME"      => $pmtemp_name,
						"PAYMENT"        => $pmtemp_amt,
						"CASH_AMT"       => '0.00',
						"DIESEL_AMT"     => '0.00',
						"CREATED_BY"     => $createdBy,
						
					);

				DB::table('FLEET_TRAN_PMT')->insert($emppmt_data);
			}


		$getAdhocAdvance = DB::table('ADHOC_ADV_PMT')->where('VEHICLE_NO',$vehicle_no)->where('FLAG','0')->get();


		if($getAdhocAdvance){

			$updateAdhoc =array(

				'FLAG' => 1,
			);

			$updateadhoc = DB::table('ADHOC_ADV_PMT')->where('VEHICLE_NO',$vehicle_no)->update($updateAdhoc);

		}



		$headtable    = 'TRIP_HEAD';
		$bodytable    = 'TRIP_BODY';
	    $exptable     = 'FLEET_TRAN_EXP';
	    $pmttable     = 'FLEET_TRAN_PMT';
		$columnheadid = 'TRIPHID';
		$pdfPageName  = 'TRIP EXPENSE DETAILS';
		$vrNoPname    = 'Slip No';
		//$tcode        = $trans_code;

		 	DB::commit();

	       	if($donwloadStatus == 1 && $owner_type=='SELF'){

			return $this->GeneratePdfForTrip($createdBy,$getcompcode,$tripid,$headtable,$bodytable,$exptable,$pmttable,$columnheadid,$pdfPageName,$vrNoPname,$customer_code,$reftrip_no,$reftrip_hid,$ref_qty);

		    }else if($donwloadStatus == 1 && $owner_type=='MARKET'){

	        return $this->GeneratePdfForTripMarket($createdBy,$getcompcode,$tripid,$headtable,$bodytable,$exptable,$pmttable,$columnheadid,$pdfPageName,$vrNoPname,$customer_code,$payment_type,$adv_rate,$adv_amount);

	        }else{

			    $response_array['response'] = 'success';
			    $data = json_encode($response_array);
			    print_r($data);

			    }

          }catch (\Exception $e) {

			    DB::rollBack();
			    throw $e;
			    $response_array['response'] = 'error';
	            $data = json_encode($response_array);
	            print_r($data);
			}
		
    	
    	
    }

    public function GeneratePdfForTrip($userId,$getcom_code,$tripid,$headtable,$bodytable,$exptable,$pmttable,$columnheadid,$pdfPageName,$vrNoPname,$customer_code,$reftrip_no,$ref_qty,$reftrip_hid){

		$response_array = array();

		//print_r($reftrip_no);exit;


		$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$customer_code'");

		$compDetail =  DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$getcom_code'");

		$pumpDetail =  DB::SELECT("SELECT P.* FROM $pmttable P  WHERE P.$columnheadid='$tripid'");

		$expDetail =  DB::SELECT("SELECT E.* FROM $exptable E  WHERE E.$columnheadid='$tripid'");

		$expRoute =  DB::SELECT("SELECT R.* FROM TRIP_EXPENSE_ROUTE R  WHERE R.$columnheadid='$tripid'");


		if($reftrip_no==null || $reftrip_no=='' || $reftrip_no=='NULL'){

			$dataheadB = DB::SELECT("SELECT t1.*,t2.DO_NO,t2.DO_DATE,t2.ITEM_CODE,t2.ITEM_NAME,t2.QTY,SUM(t2.QTY) AS GROSS_QTY,t2.LR_NO,t2.NET_WEIGHT,t2.VEHICLE_NO AS VEHICLENO,'$headtable' as tableName FROM $headtable t1 LEFT JOIN $bodytable t2 ON t2.$columnheadid = t1.$columnheadid WHERE t1.$columnheadid='$tripid'");

			$vehicleNo = $dataheadB[0]->VEHICLE_NO;

			$driverName  =  DB::SELECT("SELECT D.EMP_NAME FROM MASTER_DRIVER D  WHERE D.VEHICLE_NO='$vehicleNo'");

			//print_r('hi');exit;

		}else{

			//DB::enableQueryLog();

			/*$dataheadB = DB::SELECT("SELECT t1.*,t2.DO_NO,t2.DO_DATE,t2.ITEM_CODE,t2.ITEM_NAME,t2.QTY,SUM(t2.QTY) AS GROSS_QTY,t2.LR_NO,t2.NET_WEIGHT,'$headtable' as tableName FROM $headtable t1 LEFT JOIN $bodytable t2 ON t2.$columnheadid = t1.$columnheadid WHERE t1.$columnheadid IN ('$tripid','$reftrip_hid')");*/

			$dataheadB = DB::SELECT("SELECT t1.*,t2.DO_NO,t2.DO_DATE,t2.ITEM_CODE,t2.ITEM_NAME,t2.QTY,t2.LR_NO,t2.NET_WEIGHT,t2.VEHICLE_NO AS VEHICLENO,'$headtable' as tableName FROM  $headtable t1,$bodytable t2 WHERE t1.$columnheadid=t2.$columnheadid AND t1.$columnheadid IN ($tripid,$reftrip_hid)");

			$vehicleNo = $dataheadB[0]->VEHICLE_NO;

			$driverName  =  DB::SELECT("SELECT D.EMP_NAME FROM MASTER_DRIVER D  WHERE D.VEHICLE_NO='$vehicleNo'");
			//dd(DB::getQueryLog());

			//print_r($driverName[0]->EMP_NAME);exit;
			
		}
		

		//print_r($dataheadB);exit;
		/*$amt = [];
		foreach($expDetail as  $key){

			$amt[] += $key->AMOUNT;
		}*/

		//print_r($amt);exit;

		header('Content-Type: application/pdf');
     
    	$pdf = PDF::loadView('admin.finance.transaction.logistic.trip_expense_pdf',compact('dataheadB','dataAccDetail','pumpDetail','expDetail','compDetail','vrNoPname','expRoute','driverName'));

    	$path = public_path('dist/downloadpdf'); 
    	$fileName =  time().'.'. 'pdf' ; 
    	$pdf->save($path . '/' . $fileName);
    	$PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['data'] = $dataheadB;
        echo $data = json_encode($response_array);

		

		//$this->ConvertAmountIntoWord($dataheadB,,$dataAccDetail,$compDetail,$vrNoPname);

	}
	
    public function GeneratePdfForTrip_old($userId,$getcom_code,$tripid,$headtable,$bodytable,$exptable,$pmttable,$columnheadid,$pdfPageName,$vrNoPname,$customer_code){

		$response_array = array();


		$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$customer_code'");

		$compDetail =  DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$getcom_code'");

		$pumpDetail =  DB::SELECT("SELECT P.* FROM $pmttable P  WHERE P.$columnheadid='$tripid'");

		$expDetail =  DB::SELECT("SELECT E.* FROM $exptable E  WHERE E.$columnheadid='$tripid'");

		$dataheadB = DB::SELECT("SELECT t1.*,t2.DO_NO,t2.DO_DATE,t2.ITEM_CODE,t2.ITEM_NAME,t2.QTY,t2.QTY,t2.LR_NO,'$headtable' as tableName FROM $headtable t1 LEFT JOIN $bodytable t2 ON t2.$columnheadid = t1.$columnheadid WHERE t1.$columnheadid='$tripid'");

		//print_r($dataheadB);exit;
		/*$amt = [];
		foreach($expDetail as  $key){

			$amt[] += $key->AMOUNT;
		}*/

		//print_r($amt);exit;

		header('Content-Type: application/pdf');
     
    	$pdf = PDF::loadView('admin.finance.transaction.logistic.trip_expense_pdf',compact('dataheadB','dataAccDetail','pumpDetail','expDetail','compDetail','vrNoPname'));

    	$path = public_path('dist/downloadpdf'); 
    	$fileName =  time().'.'. 'pdf' ; 
    	$pdf->save($path . '/' . $fileName);
    	$PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['data'] = $dataheadB;
        echo $data = json_encode($response_array);

		

		//$this->ConvertAmountIntoWord($dataheadB,,$dataAccDetail,$compDetail,$vrNoPname);

	}



   public function GeneratePdfForTripMarket($userId,$getcom_code,$tripid,$headtable,$bodytable,$exptable,$pmttable,$columnheadid,$pdfPageName,$vrNoPname,$customer_code,$payment_type,$adv_rate,$adv_amount){

    $response_array = array();


    $dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$customer_code'");

    $compDetail =  DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$getcom_code'");

    $pumpDetail =  DB::SELECT("SELECT P.* FROM $pmttable P  WHERE P.$columnheadid='$tripid'");

    $dataheadB = DB::SELECT("SELECT t1.*,t2.DO_NO,t2.DO_DATE,t2.ITEM_CODE,t2.ITEM_NAME,t2.QTY,t2.QTY,t2.LR_NO,'$headtable' as tableName FROM $headtable t1 LEFT JOIN $bodytable t2 ON t2.$columnheadid = t1.$columnheadid WHERE t1.$columnheadid='$tripid'");

    //print_r($dataheadB);exit;
    /*$amt = [];
    foreach($expDetail as  $key){

      $amt[] += $key->AMOUNT;
    }*/

    //print_r($amt);exit;

    header('Content-Type: application/pdf');
     
      $pdf = PDF::loadView('admin.finance.transaction.logistic.trip_expense_market_pdf',compact('dataheadB','dataAccDetail','pumpDetail','compDetail','vrNoPname','payment_type','adv_rate','adv_amount'));

      $path = public_path('dist/downloadpdf'); 
      $fileName =  time().'.'. 'pdf' ; 
      $pdf->save($path . '/' . $fileName);
      $PublicPath = url('public/dist/downloadpdf/');  
    $downloadPdf = $PublicPath.'/'.$fileName;
    $response_array['response'] = 'success';
    $response_array['url'] = $downloadPdf;
    $response_array['data'] = $dataheadB;
        echo $data = json_encode($response_array);

    

    //$this->ConvertAmountIntoWord($dataheadB,,$dataAccDetail,$compDetail,$vrNoPname);

  }



	public function ConvertAmountIntoWordForView($dataheadB,$dataAccDetail,$compDetail,$vrNoPname){

		$response_array = array();

		$num = str_replace(array(',', ' '), '' , trim($grandAmt));

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

	    header('Content-Type: application/pdf');
     
    	$pdf = PDF::loadView('admin.finance.transaction.sales.sales_voucher_data_report',compact('dataheadB','dataTax','taxDetail','pdfName','dataConfig','dataAccDetail','consinerDetail','compDetail','vrPName','seirsHeadLine','numwords'));

    	$path = public_path('dist/downloadpdf'); 
    	$fileName =  time().'.'. 'pdf' ; 
    	$pdf->save($path . '/' . $fileName);
    	$PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['data'] = $dataheadB;
        echo $data = json_encode($response_array);

	}


    public function GeneratePdfForTripold($userId,$getcom_code,$tripid,$headtable,$exptable,$pmttable,$columnheadid,$pdfPageName,$vrNoPname){

	//print_r($tax_ind_code);exit;

		$response_array = array();

		$accCode ='DA001';

		$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

		
		$compDetail = DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$getcom_code'");



		$data030 = DB::SELECT("SELECT t1.*,t2.*,t3.*,'$headtable' as tableName FROM $headtable t1 LEFT JOIN $exptable t2 ON t2.$columnheadid = t1.$columnheadid LEFT JOIN $exptable t3 ON t2.$columnheadid = t1.$columnheadid WHERE t2.$columnheadid='$tripid'");

		
		$title='TRIP EXPENSE';

        header('Content-Type: application/pdf');
     
        $pdf = PDF::loadView('admin.finance.transaction.logistic.trip_expense_pdf',compact('data030','title'));
                      
        $path = public_path('dist/downloadpdf'); 
        $fileName =  time().'.'. 'pdf' ; 
        $pdf->save($path . '/' . $fileName);
        $PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['data'] = $data030;



		$filename = 'download.pdf';

    	$mpdf  = new \Mpdf\Mpdf();
    	$html  = view('admin.finance.transaction.logistic.trip_expense_pdf',compact('data030','title'));
    	$html  = $html->render();
    	//$mpdf->SetHeader('chapter 1');
    	
    	$stylesheet = file_get_contents(url('public/dist/css/mpdf.css'));
    	$mpdf->WriteHTML($stylesheet, 1);

    	//$mpdf->SetFooter('Footer');
    	
    	$mpdf->WriteHTML($html);

    	$pdf = $mpdf->Output('', 'S');
    	$developmentMode = true;
        $mailer = new PHPMailer($developmentMode);
    	$accEmailId='sangitkachahe13@gmail.com';
        $mailer->SMTPDebug = 0;

        $mailer->Mailer = 'smtp';

        if ($developmentMode) {
            $mailer->SMTPOptions = [
                'ssl'=> [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                ]
            ];
        }

       
        $mailer->Host = 'smtp.rediffmailpro.com';
        $mailer->SMTPAuth = true;
        $mailer->Username = 'sangit.kachahe@aceworth.in';
        $mailer->Password = 'sangit@13';
        $mailer->CharSet = 'iso-8859-1'; 
        $mailer->Port = 587;
        $mailer->SMTPSecure = 'tls'; 
        $mailer->WordWrap = TRUE;

        $mailer->setFrom('sangit.kachahe@aceworth.in', 'Aceworth Pvt ltd');
        $mailer->addAddress($accEmailId, 'Aceworth Pvt ltd');
        $mailer->addReplyTo('sangit.kachahe@aceworth.in', 'Aceworth Pvt ltd');

        $mailer->isHTML(true);
        $mailer->Subject = 'Invoice';
        $mailer->addStringAttachment($pdf,'customer.pdf');

        $message = 'SALE VOUCHER';
 
      

        $mailer->Body = $message;

        $mailSend = $mailer->send();
        $mailer->ClearAllRecipients();

		
		/*$data = json_encode($response_array);
		print_r($data);*/
    	echo $data = json_encode($response_array);
	}

    public function ViewFleetTrans(Request $request){

	//print_r('hi');exit;
		if ($request->ajax()) {

			$title = 'View Fleet Transaction';

			$user_type = $request->session()->get('user_type');

			$userid = $request->session()->get('userid');

			$company   = $request->session()->get('company_name');
			$splicode = explode('-', $company);
			$getcompcode = $splicode[0];
			$fisYear   = $request->session()->get('macc_year');

          $data = DB::table('TRIP_HEAD')->where('COMP_CODE',$getcompcode)->where('TRIP_EXP_STATUS','1')->orderBy('TRIPHID','DESC');

			
			//print_r($data);exit;
			/*return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="'.url('/logistic/edit-fleet-transaction/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#fleetDelete" class="btn btn-danger btn-xs" onclick="return deletefleet('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';

	     			return $btn;
			})->make(true);*/
			return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

		}

		return view('admin.finance.transaction.logistic.view_fleet_trans_logistic');
		/*return DataTables::queryBuilder($data)->toJson();*/
		//print_r($data);exit;
	}


	 public function ViewChildFleetTrans(Request $request){

		$response_array = array();

		if ($request->ajax()) {

		   	$headid = $request->input('tblid');

	    	$fleettran = DB::table('FLEET_TRAN_EXP')->where('TRIPHID', $headid)->get()->toArray();
	    	

    		if($fleettran) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fleettran;
	         

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

     public function trip_expense_msg(Request $request,$saveData){

		if ($saveData==true) {

			$request->session()->flash('alert-success', 'Trip Expense Was Successfully Added...!');
			return redirect('/logistic/view-fleet-transaction');

		}else{

			$request->session()->flash('alert-error', 'Trip Expense Can Not Added...!');
			return redirect('/logistic/view-fleet-transaction');

		}
	}


    function VehicleRoutebyVehicleType(Request $request){

    	 $response_array = array();

        if ($request->ajax()) {

        	 $from_place = $request->from_place;
        	 $to_place = $request->to_place;
        	 $destination_name = $request->destination_name;
        	 $trip_type = $request->trip_type;
            //$dept_code = $request->dept_code;

            /*$getadata = DB::select("SELECT * FROM MASTER_FREIGHT_ROUTE H  WHERE H.ROUTE_CODE ='$route_code' AND H.VEHICLE_TYPE ='$vehicle_type'");*/

            $getadata = DB::select("SELECT * FROM MASTER_FREIGHT_ROUTE H  WHERE H.FROM_PLACE ='$from_place' AND H.TO_PLACE ='$to_place'");

            //print_r($getadata);exit;

            $totalkm = $getadata[0]->KM;

            if($totalkm < 600){

              $km = 600;

            }else if($totalkm >= 600 && $totalkm <= 825){

            	$km = 600;

            }else if($totalkm >= 825 && $totalkm <= 1000){

            	$km = 825;

            }else if($totalkm >= 1000 && $totalkm <= 1500){

            	$km = 1000;

            }else if($totalkm >= 1500){

            	$km = 1500;
            }else{

            	$km = 00;
            }

          //  print_r($km);exit;

           // $getafleetdata  = DB::select("SELECT * FROM MASTER_FLEETEXP E  WHERE E.KM = '$km'");

            $getafleetdata  = DB::select("SELECT * FROM MASTER_FLEETEXP   WHERE  TRIP_TYPE='$trip_type' AND KM = (SELECT MAX(KM) FROM MASTER_FLEETEXP WHERE KM <='$totalkm')");


            $getdestination = DB::select("SELECT * FROM MASTER_FREIGHT_ROUTE H  WHERE H.FROM_PLACE ='$destination_name'");

           // print_r($getafleetdata);exit;


            $count=count($getadata);
            if ($count > 0) {

                $response_array['response'] = 'success';
                $response_array['data'] = $getadata;
                $response_array['expense_data'] = $getafleetdata;
                $response_array['destination_data'] = $getdestination;
               
               echo $data = json_encode($response_array);

                //print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
                
            }

        }

    }


function getGlForEmployee(Request $request){

    	$response_array = array();

        if ($request->ajax()) {

        	 $accCode = $request->accountcode;
        	 
        	//print_r($accCode);exit;

            $glList = DB::select("SELECT * FROM MASTER_ACC  WHERE ACC_CODE='$accCode'");

          	//print_r($glList);exit;

            if($glList) {

                $response_array['response'] = 'success';
                $response_array['data'] = $glList;
               
               echo $data = json_encode($response_array);

                //print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
                
            }

        }
    }

   function GetrouteToPlace(Request $request){
    	$response_array = array();

        if ($request->ajax()) {

        	 $from_place = $request->from_place;
        	 $to_place   = $request->to_place;
        	 $destination_name   = $request->destination_name;
        	

            $getFromdata  =   DB::select("SELECT * FROM MASTER_FREIGHT_ROUTE  WHERE FROM_PLACE='$from_place' AND TO_PLACE LIKE '%$to_place%'");

            $getTodata  =   DB::select("SELECT * FROM MASTER_FREIGHT_ROUTE  WHERE FROM_PLACE='$destination_name'");

           // $getTodata  = DB::select("SELECT * FROM MASTER_FREIGHT_ROUTE  WHERE TO_PLACE LIKE '%$to_place%'");


          
            if($getFromdata || $getTodata) {

                $response_array['response'] = 'success';
                $response_array['from_data'] = $getFromdata;
                $response_array['to_data'] = $getTodata;
               
               echo $data = json_encode($response_array);

                //print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
                
            }

        }
    }

    function ExpenseDataBySuppl(Request $request){

    	 $response_array = array();

        if ($request->ajax()) {

        	 $totalkm = $request->totalkm;
        	 $tripid = $request->tripid;
        	

            $getafleetdata  = DB::select("SELECT * FROM FLEET_TRAN_EXP E  WHERE E.TRIPHID = '$tripid'");


           // print_r($getafleetdata);exit;


            $count=count($getafleetdata);
            if ($count > 0) {

                $response_array['response'] = 'success';
                $response_array['expense_data'] = $getafleetdata;
               
               echo $data = json_encode($response_array);

                //print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
                
            }

        }

    }



     function ExpenseDataByKm(Request $request){

    	 $response_array = array();

        if ($request->ajax()) {

        	 $fullLoadKm  = $request->fullLoadKm;
        	 $emptyLoadKm = $request->emptyLoadKm;
        	 $totalkm     = $request->totalkm;
        	 $trip_type   = $request->trip_type;

        	 //print_r($fullLoadKm);exit;


         /* if($totalkm < 600){

              $km = 600;

            }else if($totalkm >= 600 && $totalkm <= 825){

            	$km = 600;

            }else if($totalkm >= 825 && $totalkm <= 1000){

            	$km = 825;

            }else if($totalkm >= 1000 && $totalkm <= 1500){

            	$km = 1000;

            }else if($totalkm >= 1500){

            	$km = 1500;
            }else{

            	$km = 00;
            }*/
        	

        	//DB::enableQueryLog();
 

            /*$getafleetdata  = DB::select("SELECT * FROM MASTER_FLEETEXP   WHERE  TRIP_TYPE='$trip_type' AND KM = (SELECT MAX(KM) FROM MASTER_FLEETEXP WHERE KM <='$totalkm') AND TRIP_TYPE='$trip_type'");
            */
             $getafleetdata  = DB::select("SELECT * FROM MASTER_FLEETEXP   WHERE  TRIP_TYPE='$trip_type' AND KM = (SELECT MIN(KM) FROM MASTER_FLEETEXP WHERE KM >='$fullLoadKm' AND TRIP_TYPE='$trip_type') AND TRIP_TYPE='$trip_type'");

           // dd(DB::getQueryLog());


            $getaLrExpdata  = DB::select("SELECT * FROM MASTER_LREXP");

           //print_r($getafleetdata);exit;


            $count=count($getafleetdata);

            if ($count > 0 || $getaLrExpdata) {

				$response_array['response']     = 'success';
				$response_array['expense_data'] = $getafleetdata;
				$response_array['lrexp_data']   = $getaLrExpdata;
               
               echo $data = json_encode($response_array);

                //print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
                
            }

        }

    }



    function VehicleRoutesDetails(Request $request){


        $response_array = array();

        if ($request->ajax()) {


            $route_name = $request->route_name;
            //$dept_code = $request->dept_code;

            $getadata = DB::select("SELECT * FROM MASTER_FREIGHT_ROUTE H  WHERE H.ROUTE_NAME ='$route_name'");

            $kmCal  = DB::select("SELECT sum(km) as kilometer FROM MASTER_FREIGHT_ROUTE H  WHERE H.ROUTE_NAME ='$route_name'");

            $totalkm = $kmCal[0]->kilometer;



            if($totalkm < 600){

              $km = 600;

            }else if($totalkm >= 600 && $totalkm <= 825){

            	$km = 600;

            }else if($totalkm >= 825 && $totalkm <= 1000){

            	$km = 825;

            }else if($totalkm >= 1000 && $totalkm <= 1500){

            	$km = 1000;

            }else if($totalkm >= 1500){

            	$km = 1500;
            }else{

            	$km = 00;
            }

            //DB::enableQueryLog();

             $fleetExp  = DB::select("SELECT * FROM MASTER_FLEETEXP E  WHERE E.KM ='$km'");

             //dd(DB::getQueryLog());

            //print_r($fleetExp);exit;


            $count=count($getadata);
            if ($count > 0) {

                $response_array['response'] = 'success';
                $response_array['data'] = $getadata;
                $response_array['expense_data'] = $fleetExp;
                $response_array['km'] = $totalkm;

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


    function VehicleRoutesDeliveryChg(Request $request){


        $response_array = array();

        if ($request->ajax()) {


            $route_code = $request->route_code;
            //$dept_code = $request->dept_code;

            $getadata = DB::select("SELECT * FROM MASTER_FREIGHT_ROUTE H  WHERE H.ROUTE_CODE ='$route_code'");

             $kmCal  = DB::select("SELECT sum(km) as kilometer FROM MASTER_FREIGHT_ROUTE H  WHERE H.ROUTE_CODE ='$route_code'");

             $totalkm = $kmCal[0]->kilometer;


            if($totalkm < 600){

              $km = 600;

            }else if($totalkm >= 600 && $totalkm <= 825){

            	$km = 600;

            }else if($totalkm >= 825 && $totalkm <= 1000){

            	$km = 825;

            }else if($totalkm >= 1000 && $totalkm <= 1500){

            	$km = 1000;

            }else if($totalkm >= 1500){

            	$km = 1500;
            }else{

            	$km = 00;
            }

             $fleetExp  = DB::select("SELECT * FROM MASTER_FLEETEXP E  WHERE E.KM = '$km' AND  E.FLEETIND='DELIVERY CHARGE'");

            // print_r($fleetExp);exit;


            $count=count($getadata);
            if ($count > 0) {

                $response_array['response'] = 'success';
               // $response_array['data'] = $getadata;
                $response_array['expens_data'] = $fleetExp;
                $response_array['km'] = $totalkm;

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


    function IndicatorDetails(Request $request){


        $response_array = array();

        if ($request->ajax()) {


        $indicator = $request->indicator;
        $totalkm = $request->totalkm;
            
      //  $getadata = DB::select("SELECT * FROM MASTER_FLEETEXP H WHERE H.FLEET_TYPE ='$vehicle_type' || H.KM ='$vehicle_type' AND H.FLEETIND='$indicator'");

           if($totalkm < 600){

              $km = 600;

            }else if($totalkm >= 600 && $totalkm <= 825){

            	$km = 600;

            }else if($totalkm >= 825 && $totalkm <= 1000){

            	$km = 825;

            }else if($totalkm >= 1000 && $totalkm <= 1500){

            	$km = 1000;

            }else if($totalkm >= 1500){

            	$km = 1500;
            }else{

            	$km = 00;
            }

        $getadata  = DB::select("SELECT * FROM MASTER_LREXP WHERE LRIND_NAME = '$indicator'");

           //print_r($getadata);exit;

            $count=count($getadata);
            if ($count > 0) {

                $response_array['response'] = 'success';
                $response_array['data'] = $getadata;

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


    /* ---------- supplimentry trip -------------- */
	
	public function SupplimentryTrnas(Request $request){

		$CompanyCode              = $request->session()->get('company_name');
		$compcode                 = explode('-', $CompanyCode);
		$getcompcode              =$compcode[0];
		$macc_year                = $request->session()->get('macc_year');
		
		$title                    ='Add Fleet Transaction';
		
		$userData['acc_list']     = DB::table('MASTER_ACC')->get();
		$userData['depot_list']   = DB::table('MASTER_DEPOT')->get();
		$userData['area_list']    = DB::table('MASTER_AREA')->get();
		$userData['acctype_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userData['series_list']  = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T5'])->get();
		$userData['item_list']    = DB::table('MASTER_ITEM')->get();
		$userData['truck_list']   = DB::table('MASTER_FLEET')->get();
		$userData['trip_list']    = DB::table('TRIP_HEAD')->get();
		$userData['bank_list']    = DB::table('MASTER_HOUSEBANK')->get();
		$userData['vehicle_list'] = DB::table('VEHICLE_GATE_INWARD')->get();
		$userData['route_list']   = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('ROUTE_CODE')->get();
		$userData['diesel_rate']  = DB::table('MASTER_DIESEL_RATE')->Orderby('ID','desc')->get()->first();
		$userData['gl_list']      = DB::table('MASTER_GL')->get();
		$userData['trip_entry']   = DB::table('FLEET_TRAN')->get();

		$userData['transport_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();


		
		return view('admin.finance.transaction.logistic.supplimentry_trans',$userData+compact('title'));
		
	}

	public function SupplimentryTransSave(Request $request){

		/*echo '<pre>';
		print_r($request->post());exit;
		echo '</pre>';*/


		$trdate           = $request->input('date');
		$tr_vr_date       = date("Y-m-d", strtotime($trdate));
		$createdBy        = $request->session()->get('userid');
		$comapny          = $request->session()->get('company_name');
		$slipcode         = explode('-', $comapny);
		$getcompcode      = $slipcode[0];
		$fisYear          =  $request->session()->get('macc_year');
		$diesel_rate_date = $request->input('diesel_rate_date');
		$tripid           = $request->input('tripid');
		$trip_no          = $request->input('trip_no');
		$new_vehicle_no   = $request->input('new_vehicle_no');
		$vehicle_no       = $request->input('vehicle_no');
		$transporter_code = $request->input('transporter_code');
		$transporter_name = $request->input('transporter_name');
		$series_code      = $request->input('series');
		$series_name      = $request->input('series_name');
		$plant_code       = $request->input('plant_code');
		$plant_name       = $request->input('plant_name');
		$pfct_code        = $request->input('pfct_code');
		$pfct_name        = $request->input('pfct_name');
		$customer_code    = $request->input('customer_code');
		$customer_name    = $request->input('customer_name');
		$from_place       = $request->input('from_place');
		$to_place         = $request->input('to_place');
		$trip_type        = $request->input('trip_type');
		$model            = $request->input('model');
		$loadcpct         = $request->input('loadcpct');
		$loadAvg          = $request->input('loadAvg');
		$ulcpct           = $request->input('ulcpct');
		$ulAvg            = $request->input('ulAvg');
		$emptyAvg         = $request->input('emptyAvg');
		$driver_name      = $request->input('driver_name');
		$diesel_rate      = $request->input('diesel_rate');
		$route_code       = $request->input('route_code');
		$route_name       = $request->input('route_name');
		$owner_type       = $request->input('owner_type');
		$point_delivery       = $request->input('point_delivery');

		$payment_type     = $request->input('payment_type');
		$adv_rate         = $request->input('adv_rate');
		$adv_amount       = $request->input('adv_amount');


		$itemcode         = $request->input('material');
		$itemCode         = explode('-', $itemcode);
		$item_code        = $itemCode[0];
		$indicator        = $request->input('indicator');

		$FilterArray      = array_filter($indicator);
		
		$count            = count($FilterArray);
		$gl_code          = $request->input('gl_code');
		$Amt              = $request->input('Amt');
		$bank_code        = $request->input('bank_code');
		$FilterArrayCode  = array_filter($bank_code);
		$bankcount        = count($FilterArrayCode);
		$bank_name        = $request->input('bank_name');
		$bankAmt          = $request->input('bankAmt');
		$depot_code       = $request->input('dept_code');
		$account_code     = $request->input('acct_code');
		$area_code        = $request->input('area_code');
		$item_code        = $item_code;
		//$trpt_code        = $request->input('trans_code');
		


		/*supplimentry trip head*/

		$StoreH = DB::select("SELECT MAX(TRIPSUPLHID) as TRIPSUPLHID  FROM TRIP_HEAD_SUPPL");
				$headID = json_decode(json_encode($StoreH), true); 
			  //  print_r($headID);exit;
			
				if(empty($headID[0]['TRIPSUPLHID'])){
					$headId = 1;
				}else{
					$headId = $headID[0]['TRIPSUPLHID']+1;
				}

				 /*  if($vr_no == ''){
						$vrNum = 1;
					}else{
						$vrNum = $vr_no;
					}


					$vrno_Exist = DB::table('TRIP_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('VRNO',$vrNum)->get()->toArray();

					if($vrno_Exist){
						$NewVrno = $vrNum +1;
					}else{
						$NewVrno = $vrNum;
					}*/


  		
				  $datahead = array(
							'COMP_CODE'      => $getcompcode,
							'FY_CODE'        => $fisYear,
							'TRIPSUPLHID'    => $headId,
							'SERIES_CODE'    => $series_code,
							'SERIES_NAME'    => $series_name,
							'PFCT_CODE'      => $pfct_code,
							'PFCT_NAME'      => $pfct_name,
							//'VRNO'           => $NewVrno,
							'VRDATE'         => $tr_vr_date,
							'PLANT_CODE'     => $plant_code,
							'PLANT_NAME'     => $plant_name,
							'ACC_CODE'       => $customer_code,
							'ACC_NAME'       => $customer_name,
							'ROUTE_CODE'     => $route_code,
							'ROUTE_NAME'     => $route_name,
							"FROM_PLACE"     => $from_place, 
							"TO_PLACE"       => $to_place,
							"VEHICLE_NO"     => $new_vehicle_no,
							"TRANSPORT_CODE" => $transporter_code, 
							"TRANSPORT_NAME" => $transporter_name, 
							"OWNER"          => $owner_type, 
							"PAYMENT_MODE"   => $payment_type,
							"ADV_TYPE"       => $payment_type,
							"ADV_RATE"       => $adv_rate,
							"ADV_AMT"        => $adv_amount,
							"CREATED_BY"     => $createdBy,
							
						);

	    
	             $saveDataTrip = DB::table('TRIP_HEAD_SUPPL')->insert($datahead);
		/*supplimentry trip head*/


		$data = array(

			"TRIP_TYPE"      => $trip_type,
			"VEHICLE_NO"     => $new_vehicle_no,
			"OLD_VEHICLE_NO" => $vehicle_no,
			"DRIVER_NAME"    => $driver_name,
			"MODEL"          => $model,
			"LOAD_CPCT"      => $loadcpct,
			"LOAD_AVG"       => $loadAvg,
			"UL_CPCT"        => $ulcpct,
			"UL_AVG"         => $ulAvg,
			"EMPTY_AVG"      => $emptyAvg,
			"DELIVERY_POINT" => $point_delivery,
			"CREATED_BY"     => $createdBy,


		);
		
		$saveData = DB::table('TRIP_HEAD')->where('TRIP_NO',$trip_no)->where('TRIPHID',$tripid)->update($data);

		

		for ($i=0; $i < $count; $i++) { 

			$fLeetH1 = DB::select("SELECT MAX(SUPLTRANEXPID) as SUPLTRANEXPID FROM SUPPL_TRAN_EXP");
		    $expID = json_decode(json_encode($fLeetH1), true); 
		  
		    if(empty($expID[0]['SUPLTRANEXPID'])){
		      $exp_Id = 1;
		    }else{
		      $exp_Id = $expID[0]['SUPLTRANEXPID']+1;
		    }

			$data = array(
			"SUPLTRANEXPID"  => $exp_Id,
			"TRIPSUPLHID"    => $headId,
			"COMP_CODE"      => $getcompcode,
			"FY_CODE"        => $fisYear,
			"IND_CODE"       => $indicator[$i],
			"IND_NAME"       => $indicator[$i],
			"GL_CODE"        => $gl_code[$i],
			"AMOUNT"         => $Amt[$i],
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData1 = DB::table('SUPPL_TRAN_EXP')->insert($data);

		}


		

		for ($j=0; $j < $bankcount; $j++) {

				$fLeetP = DB::select("SELECT MAX(SUPLTRANPMTID) as SUPLTRANPMTID FROM SUPPL_TRAN_PMT");
			    $pmtID = json_decode(json_encode($fLeetP), true); 
			  
			    if(empty($pmtID[0]['SUPLTRANPMTID'])){
			      $pmt_Id = 1;
			    }else{
			      $pmt_Id = $pmtID[0]['SUPLTRANPMTID']+1;
			    } 

			$data = array(
			"SUPLTRANPMTID"  => $pmt_Id,
			"TRIPSUPLHID"    => $headId,
			"COMP_CODE"      => $getcompcode,
			"FY_CODE"        => $fisYear,
			"BANK_CODE"      => $bank_code[$j],
			"BANK_NAME"      => $bank_name[$j],
			"PAYMENT"        => $bankAmt[$j],
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData2 = DB::table('SUPPL_TRAN_PMT')->insert($data);

		}

		if($saveData || $saveDataTrip){

			$response_array['response'] = 'success';
	       // $response_array['data'] = $fleettran;
	        
	        echo $data = json_encode($response_array);

		} else {

			$response_array['response'] = 'error';
            //$response_array['data'] = '' ;
            $data = json_encode($response_array);

             print_r($data);
		}
    	
    	
    }

    public function ViewSupplimentryTrans(Request $request){

	//print_r('hi');exit;
		if ($request->ajax()) {

			$title = 'View Fleet Transaction';

			$user_type = $request->session()->get('user_type');

			$userid = $request->session()->get('userid');

			$company   = $request->session()->get('company_name');
			$splicode = explode('-', $company);
			$compName = $splicode[0];
			$fisYear   = $request->session()->get('macc_year');

			if($user_type == 'admin'){

			$data = DB::table('FLEET_TRAN')->where(['COMP_CODE' => $compName, 'FY_CODE' => $fisYear])->orderBy('FLEETTRANID','DESC');

			}else if($user_type == 'superAdmin' || $user_type == 'user'){

			$data = DB::table('FLEET_TRAN')->where(['CREATED_BY' => $userid, 'COMP_CODE' => $compName, 'FY_CODE' => $fisYear])->orderBy('FLEETTRANID','DESC')->get();
			}	
			//print_r($data);exit;
			/*return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="'.url('/logistic/edit-fleet-transaction/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#fleetDelete" class="btn btn-danger btn-xs" onclick="return deletefleet('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';

	     			return $btn;
			})->make(true);*/
			return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

		}

		return view('admin.finance.transaction.logistic.view_supplimentry_trans');
		/*return DataTables::queryBuilder($data)->toJson();*/
		//print_r($data);exit;
	}


	 public function ViewChildSupplimentry(Request $request){

		$response_array = array();

		if ($request->ajax()) {

		   	$headid = $request->input('tblid');

	    	$fleettran = DB::table('FLEET_TRAN_EXP')->where('FLEETTRANID', $headid)->get()->toArray();
	    	

    		if($fleettran) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fleettran;
	         

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


    

     public function OldTripEntryDetails(Request $request){

		$response_array = array();

		if ($request->ajax()) {

		   	$series_code = $request->input('series_no');
		   	$vrno = $request->input('vrno');

	    	$trip_enrty = DB::table('FLEET_TRAN')->where('SERIES_CODE', $series_code)->where('VRNO', $vrno)->get()->first();

	    	//print_r($trip_enrty);exit;
	    	

    		if($trip_enrty) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $trip_enrty;
	         

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
// supplimentry trip


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


	 public function TransporterBillPosting_old(Request $request){

        $title = "Transporter Bill Posting";

        $company_name = $request->session()->get('company_name');
        $getcomcode   = explode('-', $company_name);
        $comp_code    = $getcomcode[0];
        $macc_year    = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid       = $request->session()->get('userid');
        //DB::enableQueryLog();
       	$accList = DB::table('TRIP_HEAD')->WHERE('LR_ACK_STATUS','1')->WHERE('BILL_STATUS','0')->WHERE('OWNER','MARKET')->groupBy('TRANSPORT_CODE')->get();
       ///	dd(DB::getQueryLog());
       	$userdata['acc_list_data'] = json_decode(json_encode($accList), true); 
       	//echo "<RE>";print_r($userdata['accList']);exit;
		//$userdata['acc_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userdata['vehicle_list'] = DB::table('TRIP_HEAD')->WHERE('LR_ACK_STATUS','1')->WHERE('BILL_STATUS','0')->WHERE('OWNER','MARKET')->get();
		$userdata['tran_list'] = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','A2')->get()->first();

		$series_data = DB::table('MASTER_CONFIG')->WHERE('TRAN_CODE','A2')->WHERE('SERIES_CODE','JT')->WHERE('COMP_CODE',$comp_code)->get()->first();

    if($series_data){

      $userdata['series_list'] = $series_data;

    }else{

      $userdata['series_list']='';
    }

		$userdata['taxList'] = DB::table('MASTER_TAX')->get();

		$userdata['ratval_list'] = DB::table('MASTER_RATE_VALUE')->get();
 

        if(isset($company_name)){

            return view('admin.finance.transaction.logistic.transporter_bill_posting',$userdata);
        }else{

            return redirect('/useractivity');

        }

    }

    public function TransporterBillPosting(Request $request){

        $title = "Transporter Bill Posting";

        $company_name = $request->session()->get('company_name');
        $getcomcode   = explode('-', $company_name);
        $comp_code    = $getcomcode[0];
        $macc_year    = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid       = $request->session()->get('userid');
        //DB::enableQueryLog();
       	$accList = DB::table('TRIP_HEAD')->WHERE('LR_ACK_STATUS','1')->WHERE('PBILL_STATUS','0')->WHERE('OWNER','MARKET')->groupBy('TRANSPORT_CODE')->get();
       ///	dd(DB::getQueryLog());
       	$userdata['acc_list_data'] = json_decode(json_encode($accList), true); 
       	//echo "<RE>";print_r($userdata['accList']);exit;
		//$userdata['acc_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userdata['vehicle_list'] = DB::table('TRIP_HEAD')->WHERE('LR_ACK_STATUS','1')->WHERE('PBILL_STATUS','0')->WHERE('OWNER','MARKET')->get();
		$userdata['tran_list'] = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','P5')->get()->first();

		$series_data = DB::table('MASTER_CONFIG')->WHERE('TRAN_CODE','P5')->WHERE('SERIES_CODE','ST')->WHERE('COMP_CODE',$comp_code)->get()->first();

	    if($series_data){

	      $userdata['series_list'] = $series_data;

	    }else{

	      $userdata['series_list']='';
	    }

	    $getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$comp_code,'FY_CODE'=>$macc_year])->get();

        foreach ($getdate as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

		$userdata['taxList'] = DB::table('MASTER_TAX')->get();

		$userdata['ratval_list'] = DB::table('MASTER_RATE_VALUE')->get();
 	
 		$itemList  = DB::table('MASTER_ITEM')->where('ITEMTYPE_CODE','SR')->get()->toArray();

        if(isset($company_name)){

            return view('admin.finance.transaction.logistic.transporter_bill_posting',$userdata+compact('itemList'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function TransporterPartyBill(Request $request){

        if($request->ajax()) {

             if (!empty($request->acct_code || $request->vehicle_no || $request->from_date || $request->to_date || $request->vehicle_Type)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
                $vehicle_no   = $request->vehicle_no;
                $vehicle_type  = $request->vehicle_Type;
             
                if(isset($request->vehicle_no)  && trim($request->vehicle_no)!=""){
                    
                    $strWhere .= "AND  TRIP_HEAD.VEHICLE_NO = '$request->vehicle_no'";
                }

                if($vehicle_type == 'MARKET'){
                	if(isset($request->acct_code)  && trim($request->acct_code)!=""){
	                    $strWhere .= "AND  TRIP_HEAD.TRANSPORT_CODE = '$request->acct_code'";
	                }
                }else{
                	$strWhere .='';
                }

                

             
                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  TRIP_HEAD.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

              
              // DB::enableQueryLog();

                $data = DB::select("SELECT TRIP_HEAD.TRIPHID AS tripHeadId,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.ADV_AMT,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,SUM(TRIP_BODY.RECD_QTY) AS RECDQTY,TRIP_BODY.UM,TRIP_BODY.LR_NO,TRIP_BODY.TRIPBID,TRIP_BODY.INVC_NO,TRIP_BODY.EWAY_BILLNO,TRIP_BODY.EWAY_BILLDT,TRIP_BODY.ITEM_SLNO,TRIP_BODY.TRANSACTION_NO,TRIP_BODY.ACK_QTY,TRIP_BODY.DELIVERY_NO,TRIP_BODY.DELIVERY_NO FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1 $strWhere AND TRIP_HEAD.OWNER='MARKET' AND TRIP_HEAD.LR_ACK_STATUS ='1' AND TRIP_HEAD.PBILL_STATUS ='0' GROUP BY TRIP_BODY.TRIPHID");
/*
                if($vehicle_type == 'SELF'){

                    $data = DB::select("SELECT TRIP_HEAD.TRIPHID AS tripHeadId,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1 $strWhere AND TRIP_HEAD.OWNER='SELF' AND TRIP_HEAD.LR_ACK_STATUS ='1' AND TRIP_HEAD.BILL_STATUS ='0' GROUP BY TRIP_BODY.TRIPHID");
                }else{
                	$data = DB::select("SELECT TRIP_HEAD.TRIPHID AS tripHeadId,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1 $strWhere AND TRIP_HEAD.OWNER='MARKET' AND TRIP_HEAD.LR_ACK_STATUS ='1' AND TRIP_HEAD.BILL_STATUS ='0' GROUP BY TRIP_BODY.TRIPHID");
                }*/


              // dd(DB::getQueryLog());
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


    public function SaveInPartyBill(Request $request){

	    $company_name = $request->session()->get('company_name');
	    $getcomcode   = explode('-', $company_name);
	    $compCode     = $getcomcode[0];
	    $fisYear      = $request->session()->get('macc_year');
	    $createdBy    = $request->session()->get('userid');

	    if ($request->ajax()) {

	    	$checkchebox 	= $request->flit_id;
			$trans_code     = $request->trans_code;
			$series_code    = $request->series_code;
			$series_name    = $request->series_name;
			$seriesGlCd     = $request->seriesGlCd;
			$seriesGlName   = $request->seriesGlName;
			$partyPostCd    = $request->partyPostCd;
			//$partyPostName  = $request->partyPostName;
			$NetAmnt        = $request->NetAmnt;
			$taxCode        = $request->taxCode;
			$transport_code = $request->acct_code;
			$transport_name = $request->acct_name;
			$pdfYesNoStatus = $request->pdfYesNoStatus;
			$pfctcode       = $request->pfct_code;
			$pfctname       = $request->pfct_name;
			$pay_vr_date    = $request->vrdate;
			$tds_deductAmt  = $request->tds_deductAmt;
			$tds_gl_code    = $request->tdsglCode;
			$tdsApply       = $request->isTdsAply;
			$vehicleType    = $request->vehicle_type;
			$tdsRate        = $request->tdsRate;
			$donwloadStatus = $request->pdfYesNoStatus;
			$itemCode   	= $request->itemCode;
			$itemName   	= $request->itemName;
			$recQty   		= $request->recQty;
			$recQtyUm       = $request->recQtyUm;
			$aQtyRecd       = $request->aQtyRecd;
			$recQtyAum      = $request->$recQtyAum;
			$fRate      	= $request->$fRate;
			$freightAmt 	= $request->$freightAmt;
			$invNo          = $request->$invNo;
			$ewayBillNo     = $request->$ewayBillNo;
			$ewayBillDt     = $request->$ewayBillDt;
			$itemSlno       = $request->$itemSlno;
			$transactionNo  = $request->$transactionNo;
			$ackQTY         = $request->$ackQTY;
			$deliveryNo     = $request->$deliveryNo;
			$getGrandTot    = $request->$getGrandTot;
		
			DB::beginTransaction();
    		try {


    			$getcountid = count($checkchebox);

				$getvrno =  DB::table('MASTER_VRSEQ')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->get()->first();

		        if($getvrno==''){
		          $last_no = 1;
		        }else{
		          $last_no = $getvrno->LAST_NO;
		        }

		        $getJvVrno =  DB::table('JV_TRAN')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('VRNO',$last_no)->get()->first();

		        if($getJvVrno){
		          $JvVrNo = $getJvVrno->VRNO + 1;
		        }else{
		          $JvVrNo = $last_no;
		        }


    			$MASTERITEM = DB::select("SELECT * FROM MASTER_ITEM");

			    $MMASTERITEM = json_decode(json_encode($MASTERITEM),true);

			    $HSNCODE = $MMASTERITEM[0]['HSN_CODE'];

    			DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->delete();


    			/* -------- CHECK VEHICLE TYPE -------- */
    			if($vehicleType == 'SELF'){

    				$check_Exist_SELF = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->get()->toArray();

    				if(empty($check_Exist_SELF)){

    					$tripHead_Idself = array();

    					for ($g = 0; $g <count($checkchebox); $g++) {

    						$split_Id =  explode('~', $checkchebox[$g]);
            				$tbodyId = $split_Id[0];

            				$body_data = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.BASIC_AMT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_HEAD.DRIVER_NAME,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIPBID='$tbodyId'");

            				foreach($body_data as $trows){

								$tripHead_Idself[] = $trows->TRIPHID;
								$freightAmt        = $trows->TRIP_FREIGHT_AMT;
								$addLessCharge     = $trows->ADD_LESS_CHRG;
								$basicAmnt         = $trows->BASIC_AMT;

	            			}/*/. FOREACH LOOP*/

    					}/* -- CHECKBOX CHECK LOOP*/


    					/* --------- trip charges ----------- */

    					for($r=0;$r<count($tripHead_Idself);$r++){

    						$triChargeDataSelf = DB::table('TRIP_CHARGE_EXP')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRIPHID',$tripHead_Idself[$r])->where('CREATED_BY',$createdBy)->get();

    						//echo "<PRE>";print_r($triChargeDataSelf);exit;

    						foreach($triChargeDataSelf as $charge){

    							/* ----- CHECK GL IS BLANK IN CHARGE ------ */

				        		if(($charge->GL_CODE == '') || ($charge->GL_CODE == null)){

				        		}else{

				        			if($charge->INDEX_NAME ==  'M'){
					        			$drAmtch = $charge->AMOUNT;
					        			$crAmtch = 0.00;
					        		}else if($charge->INDEX_NAME ==  'L'){
					        			$drAmtch = $charge->AMOUNT;
					        			$crAmtch = 0.00;
					        		}else{
					        			$drAmtch = 0.00;
					        			$crAmtch = 0.00;
					        		}

					        		$checkGlExist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->where('IND_GL_CODE',$charge->GL_CODE)->get()->first();
					        		/*echo "<PRE>";
					        		print_r($checkGlExist);*/
					        		if($checkGlExist){

					        			$drAmt_gl   = $checkGlExist->DR_AMT;

										$addWith_Dr = $drAmt_gl+$drAmtch;

										$updateData   = array(
						                    'DR_AMT'      => $addWith_Dr,
						                );

										DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->where('IND_GL_CODE',$charge->GL_CODE)->update($updateData);

					        		}else{

					        			$chargeData   = array(

						                    'DR_AMT'      => $drAmtch,
						                    'CR_AMT'	  => 0.00,
						                    'IND_GL_CODE' => $charge->GL_CODE,
						                    'TCFLAG'      => 'LSTB',
						                    'GLACC_Chk'	  => 'GL',
						                    'CREATED_BY'  => $createdBy,
					                	);


					                	DB::table('INDICATOR_TEMP')->insert($chargeData);

					        		}

				        		}
				        		/* ----- CHECK GL IS BLANK IN CHARGE ------ */

    						}/* /.foreach loop*/

    					}/*/.get multiple data of headid*/

    					/* --------- trip charges ----------- */

    					/* -------- account credit --------*/

	            			$accData = array(

								'IND_CODE'    => '',
								'DR_AMT'      => '',
								'CR_AMT'      => $NetAmnt,
								'IND_GL_CODE' => $partyPostCd,
								'TCFLAG'      => 'LSTB',
								'GLACC_Chk'   => 'ACC',
								'CREATED_BY'  => $createdBy,
				            );

				            DB::table('INDICATOR_TEMP')->insert($accData);

	            		/* -------- account credit --------*/

    				}
    				/* ---- CHECK DATA IS IN INDICATOR ---- */

    			}else{

    	/* ~~~~~~~~~~~ Save In PBILL ~~~~~~~~~~~~~~~~ */

    				$HSRNO = 1;
    				for ($t=0; $t < $getcountid; $t++) { 
    						
    					if ($t==0) {

							$GETMAXID      = DB::select("SELECT MAX(PBILLHID) AS PBHID FROM PBILL_HEAD");
							
							$DATAGETMAXID  = json_decode(json_encode($GETMAXID),true);
							
							
							$MDATAGETMAXID = count($DATAGETMAXID);

			     			if ($MDATAGETMAXID > 0) {
			     				
			     				$GETID = $DATAGETMAXID[0]['PBHID'] + 1;

			     			}else{

			     				$GETID = 1;

			     			}

							$HSRNO    = 1;
							$PLTCODE  = '';
							$PLTNAME  = '';
							$TRANTYPE = 'LSTB';
							$MFLAG    = 1;

			     			$MHEADDATA = array(

								'PBILLHID'		=> $GETID,
								'COMP_CODE'		=> $compCode,
								'FY_CODE'     	=> $fisYear,
								'PFCT_CODE'   	=> $pfctcode,
								'PFCT_NAME'    	=> $pfctname,
								'TRAN_CODE'    	=> $trans_code,
								'SERIES_CODE'   => $series_code,
								'SERIES_NAME'   => $series_name,
								'VRNO'    		=> $last_no,
								'SLNO'    		=> $HSRNO,
								'VRDATE'    	=> $pay_vr_date,
								'PLANT_CODE'    => $PLTCODE,
								'PLANT_NAME'    => $PLTNAME,
								'ACC_CODE'    	=> $transport_code,
								'ACC_NAME'    	=> $transport_name,
								'TRAN_TYPE'    	=> $TRANTYPE,
								'TAX_CODE'    	=> $taxCode,
								'FLAG'    		=> $MFLAG,
								'CREATED_BY' 	=> $createdBy

							);

							DB::table('PBILL_HEAD')->insert($MHEADDATA);


							$LASTID          = $GETID;
							$GETHEDID        = $GETID;
							
							$GETMAXIDBD      = DB::select("SELECT MAX(PBILLBID) AS PBBID FROM PBILL_BODY");
							
							$DATAGETMAXIDBD  = json_decode(json_encode($GETMAXIDBD),true);
							
							$MDATAGETMAXIDBD = count($DATAGETMAXIDBD);

			     			if ($MDATAGETMAXIDBD > 0) {
			     				
			     				$GETBID = $DATAGETMAXIDBD[0]['PBBID'] + 1;

			     			}else{

			     				$GETBID = 1;

			     			}

							$LASTID        = $GETBID;
							$ARRSBILLBID[] = $GETID;
							$BODYIDGET[]   = $GETBID;
							$MFLAG         = 1;

							$MBODYDATA = array(

								'PBILLHID'       => $GETID,
								'PBILLBID'       => $GETBID,
								'COMP_CODE'      => $compCode,
								'FY_CODE'        => $fisYear,
								'PFCT_CODE'      => $pfctcode,
								'TRAN_CODE'      => $trans_code,
								'SERIES_CODE'    => $series_code,
								'VRNO'           => $last_no,
								'SLNO'           => $HSRNO,
								'VRDATE'         => $pay_vr_date,
								'PLANT_CODE'     => $PLTCODE,
								'ITEM_CODE'      => $itemCode,
								'ITEM_NAME'      => $itemName,
								'HSN_CODE'       => $HSNCODE,
								'QTYRECD'      	 => $recQty[$t],
								'UM'			 => $recQtyUm[$t],
								'AQTYRECD'     	 => $aQtyRecd[$t],
								'AUM'            => $recQtyAum[$t],
								'RATE'       	 => $fRate[$t],
								'BASICAMT'       => $basicAmount[$t],
								'TAX_CODE'       => $taxCode,
								'INVC_NO'        => $invNo[$t],
								'EWAY_BILLNO'    => $ewayBillNo[$t],
								'EWAY_BILLDT'    => $ewayBillDt[$t],
								'ITEM_SLNO'      => $itemSlno[$t],
								'TRANSACTION_NO' => $transactionNo[$t],
								'ACK_QTY'        => $ackQTY[$t],
								'DELIVERY_NO'    => $deliveryNo[$t],
								'BILL_TYPE'      => 'SBFT',
								'CRAMT'          => $getGrandTot,
								'FLAG'           => $MFLAG,
								'CREATED_BY'     => $createdBy

							);


							DB::table('PBILL_BODY')->insert($MBODYDATA);

							$SBBID = DB::getPdo()->lastInsertId();

							$MBASICAMT[] = $basicAmount[$t];

    						
    					}else{

							$GETMAXIDBD      = DB::select("SELECT MAX(PBILLBID) AS PBBID FROM PBILL_BODY");
							
							$DATAGETMAXIDBD  = json_decode(json_encode($GETMAXIDBD),true);
							
							$MDATAGETMAXIDBD = count($DATAGETMAXIDBD);

			     			if ($MDATAGETMAXIDBD > 0) {
			     				
			     				$GETBID = $DATAGETMAXIDBD[0]['PBBID'] + 1;

			     			}else{

			     				$GETBID = 1;

			     			}

							$LASTID        = $GETBID;
							$ARRSBILLBID[] = $GETID;
							
							$BODYIDGET[]   = $GETBID;
							
							$MFLAG         = 1;

							$MBODYDATA = array(

								'PBILLHID'       => $GETID,
								'PBILLBID'       => $GETBID,
								'COMP_CODE'      => $compCode,
								'FY_CODE'        => $fisYear,
								'PFCT_CODE'      => $pfctcode,
								'TRAN_CODE'      => $trans_code,
								'SERIES_CODE'    => $series_code,
								'VRNO'           => $last_no,
								'SLNO'           => $HSRNO,
								'VRDATE'         => $pay_vr_date,
								'PLANT_CODE'     => $PLTCODE,
								'ITEM_CODE'      => $itemCode,
								'ITEM_NAME'      => $itemName,
								'HSN_CODE'       => $HSNCODE,
								'QTYRECD'      	 => $recQty[$t],
								'UM'			 => $recQtyUm[$t],
								'AQTYRECD'     	 => $aQtyRecd[$t],
								'AUM'            => $recQtyAum[$t],
								'RATE'       	 => $fRate[$t],
								'BASICAMT'       => $basicAmount[$t],
								'TAX_CODE'       => $taxCode,
								'INVC_NO'        => $invNo[$t],
								'EWAY_BILLNO'    => $ewayBillNo[$t],
								'EWAY_BILLDT'    => $ewayBillDt[$t],
								'ITEM_SLNO'      => $itemSlno[$t],
								'TRANSACTION_NO' => $transactionNo[$t],
								'ACK_QTY'        => $ackQTY[$t],
								'DELIVERY_NO'    => $deliveryNo[$t],
								'BILL_TYPE'      => 'SBFT',
								'CRAMT'          => $getGrandTot,
								'FLAG'           => $MFLAG,
								'CREATED_BY'     => $createdBy

							);


							DB::table('PBILL_BODY')->insert($MBODYDATA);

							$SBBID = DB::getPdo()->lastInsertId();

							$MBASICAMT[] = $basicAmount[$t];

    					} /* if close of t==0 condition */


    			/* ~~~~~~~~~~~~~~ TAX DATA SAVE ~~~~~~~~~~~~~~~~~~~~ */


						$TAXRATEDATA = DB::select("SELECT * FROM `MASTER_TAXRATE` WHERE TAX_CODE = '$taxCode'");

						$MTAXRATE = json_decode(json_encode($TAXRATEDATA),true);

						
						$MTAXRATECOUNT = count($MTAXRATE);

						$srNo = 1;
						for ($j = 0; $j < $MTAXRATECOUNT; $j++) {
							
							$FLAG = 1;

							$GETMAXIDTD = DB::select("SELECT MAX(SBILLTID) AS SBTID FROM SBILL_TAX");

			     			$DATAGETMAXIDTD = json_decode(json_encode($GETMAXIDTD),true);

			     			$MDATAGETMAXIDTD = count($DATAGETMAXIDTD);

			     			if ($MDATAGETMAXIDTD > 0) {
			     				
			     				$GETTID = $DATAGETMAXIDTD[0]['SBTID'] + 1;

			     			}else{

			     				$GETTID = 1;

			     			}

							$MDATA = array(

								'SBILLHID'   	=> $GETID,
								'SBILLBID'   	=> $LASTID,
								'SBILLTID'   	=> $GETTID,
								'TAXIND_CODE'   => $MTAXRATE[$j]['TAXIND_CODE'],
								'TAXIND_NAME'   => $MTAXRATE[$j]['TAXIND_NAME'],
								'RATE_INDEX'   	=> $MTAXRATE[$j]['RATE_INDEX'],
								'TAX_RATE'    	=> $MTAXRATE[$j]['TAX_RATE'],
								'TAX_AMT'    	=> $TAXAMTDT[$j],
								'TAX_LOGIC'    	=> $MTAXRATE[$j]['TAX_LOGIC'],
								'TAXGL_CODE'    => $MTAXRATE[$j]['TAX_GL_CODE'],
								'TAXGL_NAME'    => $MTAXRATE[$j]['TAX_GL_NAME'],
								'STATIC_IND'    => $MTAXRATE[$j]['STATIC_IND'],
								'FLAG'    		=> $FLAG,
								'CREATED_BY' 	=> $userId

							);


							DB::table('SBILL_TAX')->insert($MDATA);


							$srNo++;
							
						} /* ./ $j for loop close */


				/* ~~~~~~~~~~~~~~~~~~ ./ TAX DATA SAVE CLOSE ~~~~~~~~~~~~~~~~~~ */


    					$HSRNO++;

    				} /* for loop close */

    	/* ~~~~~~~~~~~ ./ Save In PBILL ~~~~~~~~~~~~~~~~ */

    				$check_Exist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->get()->toArray();


	    			if(empty($check_Exist)){

	    				$tripHead_Id =array();

	    				// if tax apply 
	    				if($taxCode!=''){
	    					//tax row count

		                  	/* ----- get head id from tri head ---- */
		                  	for($t=0;$t<count($checkchebox);$t++){

			                    $splitId =  explode('~', $checkchebox[$t]);
			                  	$checkid = $splitId[0];

			                  	$bodydata = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_BODY.TRIPHID FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIP_BODY.TRIPBID='$checkid'");

			                  	foreach($bodydata as $row){
				                    $tripHead_Id[] = $row->TRIPHID;
			                  	}

	                  		}
	                  		/* ----- get head id from tri head ---- */

	    				}else{

	    					// checkbox check count
	    					for ($i = 0; $i <count($checkchebox); $i++) {

			                    $split_Id =  explode('~', $checkchebox[$i]);
			                    $tbodyId = $split_Id[0];

			                    $body_data = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.BASIC_AMT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_HEAD.DRIVER_NAME,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIPBID='$tbodyId'");
			                    
			                    foreach($body_data as $trow){

					                $tripHead_Id[] = $trow->TRIPHID;
					                $freightAmt    = $trow->TRIP_FREIGHT_AMT;
					                $addLessCharge = $trow->ADD_LESS_CHRG;
					                $basicAmnt     = $trow->BASIC_AMT;

			                      	for ($s = 1; $s < 3; ++$s) {

			                        	if($s==1){

			                          		$idary = array(
			                                  	'DR_AMT'      => $freightAmt,
			                                  	'CR_AMT'      => 0.00,
			                                  	'IND_GL_CODE' => $seriesGlCd,
			                                  	'TCFLAG'      => 'LSTB',
			                                  	'GLACC_Chk'   => 'GL',
			                                  	'CREATED_BY'  => $createdBy,
				                              
			                              	);
			                              	DB::table('INDICATOR_TEMP')->insert($idary);

			                        	}else if($s==2){

			                          		$add_chargePos = abs($addLessCharge);
			                    			$crAmt =$freightAmt - $add_chargePos;

			                          		$idary1 = array(
			                            		'IND_CODE'    => $trow->TRIPHID,
			                                  	'DR_AMT'      => 0.00,
			                                  	'CR_AMT'      => $basicAmnt,
			                                  	'IND_GL_CODE' => $partyPostCd,
			                                  	'TCFLAG'      => 'LSTB',
			                                  	'GLACC_Chk'   => 'ACC',
			                                  	'CREATED_BY'  => $createdBy,
			                              
			                              	);
			                              	DB::table('INDICATOR_TEMP')->insert($idary1);

			                        	}
			                      	}

			                    }/* get body data */
			                    
		                  	} /* checkbox check count*/

	    				}/* tax apply*/

	    				/* --------- trip charges ----------- */

		                  	for($r=0;$r<count($tripHead_Id);$r++){

		                    	$triChargeData = DB::table('TRIP_CHARGE_EXP')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRIPHID',$tripHead_Id[$r])->where('CREATED_BY',$createdBy)->get();

		                    	foreach($triChargeData as $charge){

		                    	/* ----- CHECK GL IS BLANK IN CHARGE ------ */

		                    		if(($charge->GL_CODE == '') || ($charge->GL_CODE == null)){

			                      		$checkExist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->where('IND_CODE',$tripHead_Id[$r])->get()->first();
			                    
			                      		$seriescrAmt = $checkExist->CR_AMT + abs($charge->AMOUNT);

			                      		$updateData   = array(
			                              	'CR_AMT'      => $seriescrAmt,
			                          	);

			                          	DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->where('IND_CODE',$tripHead_Id[$r])->update($updateData);

		                    		}else{

				                      	if($charge->INDEX_NAME ==  'M'){
					                        $crAmtch = abs($charge->AMOUNT);
					                        $drAmtch = 0.00;
				                      	}else if($charge->INDEX_NAME ==  'L'){
					                        $drAmtch = $charge->AMOUNT;
					                        $crAmtch = 0.00;
				                      	}else{
					                        $crAmtch = 0.00;
					                        $drAmtch = 0.00;
				                      	}

		                      			$chargeData   = array(
											'DR_AMT'      => $drAmtch,
											'CR_AMT'      => $crAmtch,
											'IND_GL_CODE' => $charge->GL_CODE,
											'TCFLAG'      => 'LSTB',
											'GLACC_Chk'   => 'GL',
											'CREATED_BY'  => $createdBy,
		                              
		                          		);

		                          		DB::table('INDICATOR_TEMP')->insert($chargeData);

		                    		} 

		                    		/* ----- CHECK GL IS BLANK IN CHARGE ------ */
		                    
		                  		}

		                  	}

		                /* --------- trip charges ----------- */

		                /* ------------- TDS apply ------------ */

		                  	if($tdsApply == 1){

		                    	for ($f = 1; $f < 3; ++$f) {

		                      		if($f == 1){
		                        		$chargeData   = array(
			                              	'DR_AMT'      => $tds_deductAmt,
			                              	'CR_AMT'      => 0.00,
			                              	'IND_GL_CODE' => $partyPostCd,
			                              	'TCFLAG'      => 'LSTB',
			                              	'GLACC_Chk'   => 'ACC',
			                              	'CREATED_BY'  => $createdBy,
		                          		);

		                          		DB::table('INDICATOR_TEMP')->insert($chargeData);
		                      		}else if($f==2){
		                       	 		$chargeData   = array(
			                              	'DR_AMT'      => 0.00,
			                              	'CR_AMT'      => $tds_deductAmt,
			                              	'IND_GL_CODE' => $tds_gl_code,
			                              	'TCFLAG'      => 'LSTB',
			                              	'GLACC_Chk'   => 'GL',
		                              		'CREATED_BY'  => $createdBy,
		                          		);

		                          		DB::table('INDICATOR_TEMP')->insert($chargeData);
		                      		}
		                      
		                    	}
		                  	}
		                /* ------------- TDS apply ------------ */

	    			}/* /. chck exist*/

    			} /* /. CHECK VEHICLE TYPE*/

    			/* ------- CHECK VEHICLE TYPE ---------- */

    			$response_array = array();

           	 	$allBillData = DB::select("SELECT t1.*,t2.GL_NAME as glName,t3.ACC_NAME AS accName FROM INDICATOR_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE LEFT JOIN MASTER_ACC t3 ON t3.ACC_CODE =t1.IND_ACC_CODE WHERE t1.CREATED_BY='$createdBy' AND t1.TCFLAG='LSTB'");

           	 	/* ------------start : insert data in jv/acc/gl ------------- */

           	 	for($g=0;$g<count($allBillData);$g++){

           	 		$blankVal='';
           	 		$slno = $g+1;
           	 		$perticulerText='';
					$drAmt     = $allBillData[$g]->DR_AMT;
					$crAmt     = $allBillData[$g]->CR_AMT;
					$gl_code   = $allBillData[$g]->IND_GL_CODE;
					$gl_name   = $allBillData[$g]->glName;
					$chk_glAcc = $allBillData[$g]->GLACC_Chk;

           	 		$jvOne = (new AccountingController)->InsertInJournalTran($compCode,$fisYear,$pfctcode,$pfctname,$trans_code,$series_code,$series_name,$JvVrNo,$slno,$pay_vr_date,$transport_code,$transport_name,$gl_code,$gl_name,$perticulerText,$drAmt,$crAmt,$blankVal,$blankVal,$blankVal,$blankVal,$createdBy);

           	 		$resultgl = (new AccountingController)->GlTEntry($compCode,$fisYear,$trans_code,$series_code,$JvVrNo,$slno,$pay_vr_date,$pfctcode,$gl_code,$gl_name,$transport_code,$transport_name,$blankVal,$blankVal,$blankVal,$blankVal,$drAmt,$crAmt,$perticulerText,$createdBy);
           	 		if($chk_glAcc == 'ACC'){

           	 			$result = (new AccountingController)->AccountTEntry($compCode,$fisYear,$trans_code,$series_code,$JvVrNo,$slno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$gl_code,$gl_name,$blankVal,$blankVal,$blankVal,$blankVal,$drAmt,$crAmt,$perticulerText,$createdBy);
           	 		}

           	 	}



           	 //	print_r($tripHead_Id);exit;


           	 	for ($z = 0; $z <count($checkchebox); $z++) {

			        $data_tbody =array(

			        		'PBILL_STATUS' =>'1',

			        );

			        DB::table('TRIP_HEAD')->where('TRIPHID',$tripHead_Id[$z])->update($data_tbody);


           	 	}
           	 	/* ------------end : insert data in jv/acc/gl ------------- */

           	 	$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->get()->toArray();
		
				if(empty($checkvrnoExist)){

					$datavrnIn =array(
						'COMP_CODE'   =>$compCode,
						'FY_CODE'     =>$fisYear,
						'TRAN_CODE'   =>$trans_code,
						'SERIES_CODE' =>$series_code,
						'FROM_NO'     =>1,
						'TO_NO'       =>99999,
						'LAST_NO'     =>$JvVrNo,
						'CREATED_BY'  =>$createdBy,
					);

					DB::table('MASTER_VRSEQ')->insert($datavrnIn);

				}else{
					$datavrn =array(
						'LAST_NO'=>$JvVrNo
					);
					DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->update($datavrn);
				}


					
			
					
				

				if(isset($taxIndCode)){


						$totalgstamt =0;

					for ($k = 0; $k < $head_tax_count; $k++) {

						if($taxIndCode[$k]=='SG1' || $taxIndCode[$k]=='CG1' || $taxIndCode[$k]=='IGST'){

							$totalgstamt = floatval($totalgstamt) +  floatval($taxamount[$k]);
							
						}
						

					}

					//print_r($totalgstamt);exit;
				}else{

					$totalgstamt =0;
				}


					

    			DB::commit();

	    		$data1['response'] = 'success';

	    		if($donwloadStatus == 1){

	    			///print_r($checkchebox);exit;

	    			for ($h = 0; $h <count($checkchebox); $h++) {
    						$splitb_Id =  explode('~', $checkchebox[$h]);
            				$btbodyId = $splitb_Id[0];

            				$pdfPageName='BILL POSTING';
					
							return $this->GeneratePdfForTransportBillPosting($createdBy,$compCode,$btbodyId,$pdfPageName,$trans_code,$JvVrNo,$pay_vr_date,$tds_deductAmt,$tripHead_Id,$checkchebox,$tdsRate,$totalgstamt,$NetAmnt,$basic_amnt);

						}
					}else{}

		        $getalldata = json_encode($data1);  
		        print_r($getalldata);

        	}catch (\Exception $e) {

		        DB::rollBack();
		        throw $e;
		        $data1['response'] = 'error';
		        $getalldata = json_encode($data1);  
		        print_r($getalldata);
    		}

	    }/* /. AJAX*/

	} /* /. MAIN FUNCTION */



	public function GeneratePdfForTransportBillPosting($userId,$getcom_code,$bodyId,$pdfName,$tCode,$JvVrNo,$pay_vr_date,$tds_deductAmt,$tripHead_Id,$checkchebox,$tdsRate,$totalgstamt,$NetAmnt,$basic_amnt){


	$response_array = array();

	/*$dataheadB = DB::SELECT("SELECT A.*,B.*,A.VEHICLE_NO AS vehicleNoHead,C.ADD1,C.CITY_NAME,C.DIST_NAME,C.CONTACT_NO,C.CONTACT_PERSON,C.GST_NUM FROM TRIP_HEAD A,TRIP_BODY B,MASTER_ACCADD C WHERE A.TRIPHID=B.TRIPHID AND A.ACC_CODE = C.ACC_CODE AND A.TRIPHID='$headId'");

	
*/

	//print_r($bodyId);exit;

	/*$dataheadB = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_HEAD.PLANT_CODE,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_HEAD.DRIVER_NAME,TRIP_HEAD.VEHICLE_NO AS vehicleNo,TRIP_HEAD.VEHICLE_TYPE,TRIP_HEAD.ARRIVAL_DATE,TRIP_HEAD.FPO_NO,TRIP_HEAD.TRIP_DAY,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIP_BODY.TRIPBID='$bodyId'");

	print_r($dataheadB);exit;*/
		
		
			$dataheadB=array();
			$dataTripCharges=array();

	     for ($h = 0; $h <count($checkchebox); $h++) {
    						$splitb_Id =  explode('~', $checkchebox[$h]);
            				$btbodyId = $splitb_Id[0];

            				//print_r($btbodyId);

            	$datahead = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_HEAD.PLANT_CODE,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_HEAD.DRIVER_NAME,TRIP_HEAD.VEHICLE_NO AS vehicleNo,TRIP_HEAD.VEHICLE_TYPE,TRIP_HEAD.ARRIVAL_DATE,TRIP_HEAD.FPO_NO,TRIP_HEAD.TRIP_DAY,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIP_BODY.TRIPBID='$btbodyId'");

            	foreach($datahead as $key) {

            		//print_r($key);
            		array_push($dataheadB,$key);


            		
            	}

            $trippHid = $dataheadB[$h]->TRIPHID;

            $datachargeB = DB::SELECT("SELECT TRIP_CHARGE_EXP.*,TRIP_HEAD.TRIPHID as tripHid FROM TRIP_CHARGE_EXP LEFT JOIN TRIP_HEAD ON TRIP_HEAD.TRIPHID = TRIP_CHARGE_EXP.TRIPHID WHERE TRIP_CHARGE_EXP.TRIPHID = '$trippHid'");
            	
            	//print_r($dataTripCharges);

            	foreach($datachargeB as $row) {

            		//print_r($key);
            		array_push($dataTripCharges,$row);


            		
            	}

            }
            
//exit;

      $accCode = $dataheadB[0]->ACC_CODE;
      $consiner = $dataheadB[0]->CP_CODE;
      $plant_code = $dataheadB[0]->PLANT_CODE;
      $tripheadId = $dataheadB[0]->TRIPHID;

	
      //print_r($consiner);exit;

      $dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE AS ACCCODE,MASTER_ACC.ACC_NAME AS ACCNAME,MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

        $consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.ACC_CODE = '$consiner'");

        //print_r($consinerDetail);exit;
     // dd(DB::getQueryLog());
	
		
		$compDetail = DB::SELECT("SELECT A.*,B.COMP_NAME,B.COMP_CODE FROM `MASTER_PLANT` A,MASTER_COMP B WHERE A.COMP_CODE=B.COMP_CODE AND B.COMP_CODE='$getcom_code' AND A.PLANT_CODE='$plant_code'");

		header('Content-Type: application/pdf');
		

			$pdf = PDF::loadView('admin.finance.transaction.logistic.transporter_bill_posting_PDF',compact('pdfName','compDetail','dataheadB','dataAccDetail','consinerDetail','pay_vr_date','JvVrNo','tds_deductAmt','dataTripCharges','tdsRate','totalgstamt','NetAmnt','basic_amnt'));

		
		
		$path        = public_path('dist/coldStoragePDF'); 
		$fileName    =  time().'.'. 'pdf' ;
		$pdf->save($path . '/' . $fileName);
		$PublicPath  = url('public/dist/coldStoragePDF/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url']      = $downloadPdf;
		$response_array['data']     = $dataheadB;
		echo $data = json_encode($response_array);

	}

 public function TransporterPartyBill_old(Request $request){

        if($request->ajax()) {

             if (!empty($request->acct_code || $request->vehicle_no || $request->from_date || $request->to_date || $request->vehicle_Type)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
                $vehicle_no   = $request->vehicle_no;
                $vehicle_type  = $request->vehicle_Type;
             
                if(isset($request->vehicle_no)  && trim($request->vehicle_no)!=""){
                    
                    $strWhere .= "AND  TRIP_HEAD.VEHICLE_NO = '$request->vehicle_no'";
                }

                if($vehicle_type == 'MARKET'){
                	if(isset($request->acct_code)  && trim($request->acct_code)!=""){
	                    $strWhere .= "AND  TRIP_HEAD.TRANSPORT_CODE = '$request->acct_code'";
	                }
                }else{
                	$strWhere .='';
                }

                

             
                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  TRIP_HEAD.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

              
              // DB::enableQueryLog();

                $data = DB::select("SELECT TRIP_HEAD.TRIPHID AS tripHeadId,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.ADV_AMT,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,SUM(TRIP_BODY.RECD_QTY) AS RECDQTY,TRIP_BODY.UM,TRIP_BODY.LR_NO,TRIP_BODY.TRIPBID FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1 $strWhere AND TRIP_HEAD.OWNER='MARKET' AND TRIP_HEAD.LR_ACK_STATUS ='1' AND TRIP_HEAD.BILL_STATUS ='0' GROUP BY TRIP_BODY.TRIPHID");
/*
                if($vehicle_type == 'SELF'){

                    $data = DB::select("SELECT TRIP_HEAD.TRIPHID AS tripHeadId,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1 $strWhere AND TRIP_HEAD.OWNER='SELF' AND TRIP_HEAD.LR_ACK_STATUS ='1' AND TRIP_HEAD.BILL_STATUS ='0' GROUP BY TRIP_BODY.TRIPHID");
                }else{
                	$data = DB::select("SELECT TRIP_HEAD.TRIPHID AS tripHeadId,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1 $strWhere AND TRIP_HEAD.OWNER='MARKET' AND TRIP_HEAD.LR_ACK_STATUS ='1' AND TRIP_HEAD.BILL_STATUS ='0' GROUP BY TRIP_BODY.TRIPHID");
                }*/


              // dd(DB::getQueryLog());
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
   

	public function SaveInPartyBill_old(Request $request){
				
			
			$company_name = $request->session()->get('company_name');
            $getcomcode   = explode('-', $company_name);
            $compCode    = $getcomcode[0];

				$fisYear    = $request->session()->get('macc_year');
				$createdBy      = $request->session()->get('userid');
		  		
			if ($request->ajax()) {


          $getid = $request->flitClass;

          /*$explode = explode(',', $flitId);

          $getid = $explodep[0];

          $VehicleNumber = $explodep[1];
          $LrNo = $explodep[2];
          $DestiNation = $explodep[3];*/

         // print_r($flitId);exit;

		  		$trans_code = $request->trans_code;
		  		$series_code = $request->series_code;
		  		$series_name = $request->series_name;
		  		$seriesGlCd = $request->seriesGlCd;
		  		$seriesGlName = $request->seriesGlName;
		  		$partyPostCd = $request->partyPostCd;
		  		$partyPostName = $request->partyPostName;
		  		$NetAmnt = $request->NetAmnt;
		  		$taxCode = $request->taxCode;
		  		$transport_code = $request->acct_code;
		  		$transport_name = $request->acct_name;

		  		$taxIndCode = $request->taxIndCode;
  				$rate_indName = $request->rate_indName;
  				$af_rate = $request->af_rate;
  				$amount = $request->amount;
  				$taxGlCode = $request->taxGlCode;
  				$taxRowCount = $request->taxRowCount;
  				$pdfYesNoStatus = $request->pdfYesNoStatus;

          $pfctcode = $request->pfct_code;
          $pfctname = $request->pfct_name;
          $pay_vr_date = $request->vrdate;

         $textperticuler =   str_replace('~', '-', $request->pertText);

         $perticulerText = substr($textperticuler,1);


		  		$getcountid = count($getid);

		  		$saveData ='';

		  		$getvrno =  DB::table('MASTER_VRSEQ')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->get()->first();

		  		if($getvrno==''){

		  			$last_no = 1;
		  		}else{

		  			$last_no = $getvrno->LAST_NO;

		  		}

		   	$getJvVrno =  DB::table('JV_TRAN')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('VRNO',$last_no)->get()->first();

			  	if($getJvVrno){

			  		$JvVrNo = $getJvVrno->VRNO + 1;
			  	}else{

			  		$JvVrNo = $last_no;
			  	}

		 	//print_r($JvVrNo);exit;

			  	DB::beginTransaction();

				try {

					if($taxCode !=''){

					//	$framt = $NetAmnt;

           // print_r($framt);exit;

           // $particular = $pay_vr_date;


            for ($i=0; $i < $getcountid ; $i++) { 

              $splitId =  explode('~', $getid[$i]);

              $checkid = $splitId[0];

              $srno= $i + 1;


              $data = DB::select("SELECT TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIPBID='$checkid'");

              foreach($data as $key){


              $ACC_CODE = $key->TRANSPORT_CODE;

              $fetch_acctype =  DB::table('MASTER_ACC')->where('ACC_CODE',$ACC_CODE)->get()->first();

              $party ='';

              $vehicleNo      = $key->VehicleNo;
              $lr_no          = $key->LR_NO;
              $transport_code = $key->TRANSPORT_CODE;
              $transport_name = $key->TRANSPORT_NAME;
              $to_place       = $key->TO_PLACE;
              $lr_qty         = $key->QTY;
              $pfctcode       = $key->PFCT_CODE;
              $pfctname       = $key->pfctName;
              $transcode      = $trans_code;
              $seriescode     = $series_code;
              $seriesName     = $series_name;
              $glCode         = $partyPostCd;
              $glName         = $partyPostName;
              $glPostCode     = $seriesGlCd;
              $glPostName     = $seriesGlName;
              $pay_vr_date    = $key->VrDate;
              $freight_amt    = $key->TRIP_FREIGHT_AMT;
              $net_amt        = $key->NET_AMOUNT;

              $TRIPHEADID = $key->TRIPHID;

                 $fetch_Charge_Exp = DB::table('TRIP_CHARGE_EXP')->where('TRIPHID',$TRIPHEADID)->get()->toArray();


                if($fetch_Charge_Exp){

                  $chrg_exp_count = count($fetch_Charge_Exp);

                   $FrAddglAmt = 0;
                   $FrgLesslAmt = 0;

                  for ($m = 0; $m < $chrg_exp_count; $m++) {

                  
                  $srno = $m + 1;

                     $index_code =  $fetch_Charge_Exp[$m]->INDEX_NAME;
                     $gl_code =  $fetch_Charge_Exp[$m]->GL_CODE;
                     $gl_name =  $fetch_Charge_Exp[$m]->GL_NAME;
                     $particular =  $fetch_Charge_Exp[$m]->DESCRIPTION;
                     $glamt =  $fetch_Charge_Exp[$m]->AMOUNT;



                     $JVtranH = DB::select("SELECT MAX(JVID) as JVID FROM JV_TRAN");
                    $headID = json_decode(json_encode($JVtranH), true); 
                    if(empty($headID[0]['JVID'])){
                      $head_Id = 1;
                    }else{
                      $head_Id = $headID[0]['JVID']+1;
                    }
                    

                     if($index_code=='L'){

                        $FrAddglAmt += $glamt;

                          $data = array(

                          'JVID'        =>$head_Id,
                          'COMP_CODE'   =>$compCode,
                          'FY_CODE'     =>$fisYear,
                          'PFCT_CODE'   =>$pfctcode,
                          'PFCT_NAME'   =>$pfctname,
                          'TRAN_CODE'   =>$transcode,
                          'SERIES_CODE' =>$seriescode,
                          'SERIES_NAME' =>$seriesName,
                          'VRNO'        =>$JvVrNo,
                          'SLNO'        =>$srno,
                          'VRDATE'      =>$pay_vr_date,
                          'ACC_CODE'    =>$transport_code,
                          'ACC_NAME'    =>$transport_name,
                          'GL_CODE'     =>$gl_code,
                          'GL_NAME'     =>$gl_name,
                          'PARTICULAR'  =>$particular,
                          'DRAMT'       =>$glamt,
                          'CREATED_BY'  =>$createdBy,

                        );

                    $saveData1 = DB::table('JV_TRAN')->insert($data);

                    $this->JournalGlDebitLegEntry($compCode,$fisYear,$transcode,$seriescode,$gl_code,$gl_name,$JvVrNo,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$glamt,$particular,$createdBy);


                     }else{


                      $FrgLesslAmt += $glamt;

                      //print_r($FrglAmt);

                      $data1 = array(

                          'JVID'        =>$head_Id,
                          'COMP_CODE'   =>$compCode,
                          'FY_CODE'     =>$fisYear,
                          'PFCT_CODE'   =>$pfctcode,
                          'PFCT_NAME'   =>$pfctname,
                          'TRAN_CODE'   =>$transcode,
                          'SERIES_CODE' =>$seriescode,
                          'SERIES_NAME' =>$seriesName,
                          'VRNO'        =>$JvVrNo,
                          'SLNO'        =>$srno,
                          'VRDATE'      =>$pay_vr_date,
                          'ACC_CODE'    =>$transport_code,
                          'ACC_NAME'    =>$transport_name,
                          'GL_CODE'     =>$gl_code,
                          'GL_NAME'     =>$gl_name,
                          'PARTICULAR'  =>$particular,
                          'CRAMT'       =>$glamt,
                          'CREATED_BY'  =>$createdBy,

                        );

                    $saveData2 = DB::table('JV_TRAN')->insert($data1);

                    $this->JournalGlCreditLegEntry($compCode,$fisYear,$transcode,$seriescode,$gl_code,$gl_name,$JvVrNo,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$glamt,$particular,$createdBy);

                     }

                 }

                 $framt = $freight_amt;

                 //print_r($freight_amt);exit;

                 $fianlfrAmt = $framt - $FrgLesslAmt;

                // print_r($framt);exit;

                 $ChargeType = 'withCharge';

                 //$this->taxWithPosting($compCode,$fisYear,$trans_code,$series_code,$seriesGlCd,$seriesGlName,$partyPostCd,$partyPostName,$JvVrNo,$transport_code,$transport_name,$framt,$createdBy,$taxIndCode,$rate_indName,$af_rate,$amount,$taxGlCode,$taxRowCount,$pfctcode,$pfctname,$pay_vr_date,$perticulerText,$ChargeType);

                 }else{

                   $framt = $NetAmnt;
                   $fianlfrAmt = $freight_amt;
                   $chrg_exp_count = 0;

                   $ChargeType = 'withoutCharge';

                //$this->taxWithPosting($compCode,$fisYear,$trans_code,$series_code,$seriesGlCd,$seriesGlName,$partyPostCd,$partyPostName,$JvVrNo,$transport_code,$transport_name,$framt,$createdBy,$taxIndCode,$rate_indName,$af_rate,$amount,$taxGlCode,$taxRowCount,$pfctcode,$pfctname,$pay_vr_date,$perticulerText,$ChargeType);

                 }

               //print_r($framt);exit;


                 

              }

            }

			}else{


	  			for ($i=0; $i < $getcountid ; $i++) { 

              		$splitId =  explode('~', $getid[$i]);

		  			$checkid = $splitId[0];

		  			$srno= $i + 1;

		  			//$data = DB::select("SELECT * FROM TRIP_BODY WHERE TRIPBID='$checkid'");

		  			$data = DB::select("SELECT TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIPBID='$checkid'");

	  				foreach ($data as $key) {


				  		$ACC_CODE = $key->TRANSPORT_CODE;

				  		$fetch_acctype =  DB::table('MASTER_ACC')->where('ACC_CODE',$ACC_CODE)->get()->first();

				  		$party ='';

							$vehicleNo      = $key->VehicleNo;
							$lr_no          = $key->LR_NO;
							$transport_code = $key->TRANSPORT_CODE;
							$transport_name = $key->TRANSPORT_NAME;
							$to_place       = $key->TO_PLACE;
							$lr_qty         = $key->QTY;
							$pfctcode       = $key->PFCT_CODE;
							$pfctname       = $key->pfctName;
						  	$transcode      = $trans_code;
							$seriescode     = $series_code;
							$seriesName     = $series_name;
							$glCode         = $partyPostCd;
							$glName         = $partyPostName;
							$glPostCode     = $seriesGlCd;
							$glPostName     = $seriesGlName;
							$pay_vr_date    = $key->VrDate;
							$freight_amt    = $key->TRIP_FREIGHT_AMT;
							$net_amt        = $key->NET_AMOUNT;

							$TRIPHEADID = $key->TRIPHID;

		  					 $fetch_Charge_Exp = DB::table('TRIP_CHARGE_EXP')->where('TRIPHID',$TRIPHEADID)->get()->toArray();


	  					 	if($fetch_Charge_Exp){

		  					 	$chrg_exp_count = count($fetch_Charge_Exp);

			  					 $FrAddglAmt = 0;
			  					 $FrgLesslAmt = 0;

	  						 	for ($m = 0; $m < $chrg_exp_count; $m++) {

		  					 	
								  $srno = $m + 1;

		  					 	   $index_code =  $fetch_Charge_Exp[$m]->INDEX_NAME;
		  					 	   $gl_code =  $fetch_Charge_Exp[$m]->GL_CODE;
		  					 	   $gl_name =  $fetch_Charge_Exp[$m]->GL_NAME;
		  					 	   $particular =  $fetch_Charge_Exp[$m]->DESCRIPTION;
		  					 	   $glamt =  $fetch_Charge_Exp[$m]->AMOUNT;



		  					 	   $JVtranH = DB::select("SELECT MAX(JVID) as JVID FROM JV_TRAN");
										$headID = json_decode(json_encode($JVtranH), true); 
										if(empty($headID[0]['JVID'])){
											$head_Id = 1;
										}else{
											$head_Id = $headID[0]['JVID']+1;
										}
		  					 	  

		  					 	   if($index_code=='L'){

		  					 	   		$FrAddglAmt += $glamt;

		  					 	   			$data = array(

													'JVID'        =>$head_Id,
													'COMP_CODE'   =>$compCode,
													'FY_CODE'     =>$fisYear,
													'PFCT_CODE'   =>$pfctcode,
													'PFCT_NAME'   =>$pfctname,
													'TRAN_CODE'   =>$transcode,
													'SERIES_CODE' =>$seriescode,
													'SERIES_NAME' =>$seriesName,
													'VRNO'        =>$JvVrNo,
													'SLNO'        =>$srno,
													'VRDATE'      =>$pay_vr_date,
													'ACC_CODE'    =>$transport_code,
													'ACC_NAME'    =>$transport_name,
													'GL_CODE'     =>$gl_code,
													'GL_NAME'     =>$gl_name,
													'PARTICULAR'  =>$particular,
													'DRAMT'       =>$glamt,
													'CREATED_BY'  =>$createdBy,

												);

										$saveData1 = DB::table('JV_TRAN')->insert($data);

										$this->JournalGlDebitLegEntry($compCode,$fisYear,$transcode,$seriescode,$gl_code,$gl_name,$JvVrNo,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$glamt,$particular,$createdBy);


		  					 	   }else{


		  					 	   	$FrgLesslAmt += $glamt;

		  					 	   	//print_r($FrglAmt);

		  					 	   	$data1 = array(

													'JVID'        =>$head_Id,
													'COMP_CODE'   =>$compCode,
													'FY_CODE'     =>$fisYear,
													'PFCT_CODE'   =>$pfctcode,
													'PFCT_NAME'   =>$pfctname,
													'TRAN_CODE'   =>$transcode,
													'SERIES_CODE' =>$seriescode,
													'SERIES_NAME' =>$seriesName,
													'VRNO'        =>$JvVrNo,
													'SLNO'        =>$srno,
													'VRDATE'      =>$pay_vr_date,
													'ACC_CODE'    =>$transport_code,
													'ACC_NAME'    =>$transport_name,
													'GL_CODE'     =>$gl_code,
													'GL_NAME'     =>$gl_name,
													'PARTICULAR'  =>$particular,
													'CRAMT'       =>$glamt,
													'CREATED_BY'  =>$createdBy,

												);

										$saveData2 = DB::table('JV_TRAN')->insert($data1);

										$this->JournalGlCreditLegEntry($compCode,$fisYear,$transcode,$seriescode,$gl_code,$gl_name,$JvVrNo,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$glamt,$particular,$createdBy);

		  					 	   }

		  					 }

		  		
		  					 $framt = $FrAddglAmt + $freight_amt;

		  					 $fianlfrAmt = $framt - $FrgLesslAmt;


		  					 }else{

                   $framt = $freight_amt;
		  					   $fianlfrAmt = $freight_amt;
		  					   $chrg_exp_count = 0;

		  					 } /* --- IF */

		  					 //print_r($fianlfrAmt);exit;
		  				

							for ($k = 0; $k < 2; $k++){

								$sr_no= $k + 1;

								$srno = $chrg_exp_count + $sr_no;
								
				
								$JVtranH = DB::select("SELECT MAX(JVID) as JVID FROM JV_TRAN");
								$headID = json_decode(json_encode($JVtranH), true); 
								if(empty($headID[0]['JVID'])){
									$head_Id = 1;
								}else{
									$head_Id = $headID[0]['JVID']+1;
								}

								
								$particular = $lr_no.'-'.$pay_vr_date.'-'.$vehicleNo.'-'.$to_place;

								if($k==1){


									$data = array(

										'JVID'        =>$head_Id,
										'COMP_CODE'   =>$compCode,
										'FY_CODE'     =>$fisYear,
										'PFCT_CODE'   =>$pfctcode,
										'PFCT_NAME'   =>$pfctname,
										'TRAN_CODE'   =>$transcode,
										'SERIES_CODE' =>$seriescode,
										'SERIES_NAME' =>$seriesName,
										'VRNO'        =>$JvVrNo,
										'SLNO'        =>$srno,
										'VRDATE'      =>$pay_vr_date,
										'ACC_CODE'    =>$transport_code,
										'ACC_NAME'    =>$transport_name,
										'GL_CODE'     =>$glCode,
										'GL_NAME'     =>$glName,
										'PARTICULAR'  =>$particular,
										'CRAMT'       =>$fianlfrAmt,
										'CREATED_BY'  =>$createdBy,

									);

								//	print_r($data);

									$saveData3 = DB::table('JV_TRAN')->insert($data);

								 $gl_enrty = 'GL_WITH_ACC';
								$this->JournalAccEntry($compCode,$fisYear,$transcode,$seriescode,$glCode,$glName,$JvVrNo,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$fianlfrAmt,$particular,$createdBy);

								$this->JournalGlLegEntry($compCode,$fisYear,$transcode,$seriescode,$glCode,$glName,$JvVrNo,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$fianlfrAmt,$particular,$createdBy,$gl_enrty);

							/*	$this->JournalGlLegEntry($comp_code,$fisYear,$tranCd,$series_Code,$NewVrno,$srno,$vrDateFr,$pfctcode,$acc->IND_GL_CODE,$acc->glName,$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$acc->DR_AMT,$acc->CR_AMT,$blankVal,$loginUser)*/	

								}else{

									$data = array(

										'JVID'        =>$head_Id,
										'COMP_CODE'   =>$compCode,
										'FY_CODE'     =>$fisYear,
										'PFCT_CODE'   =>$pfctcode,
										'PFCT_NAME'   =>$pfctname,
										'TRAN_CODE'   =>$transcode,
										'SERIES_CODE' =>$seriescode,
										'SERIES_NAME' =>$seriesName,
										'VRNO'        =>$JvVrNo,
										'SLNO'        =>$srno,
										'VRDATE'      =>$pay_vr_date,
										'ACC_CODE'    =>$transport_code,
										'ACC_NAME'    =>$transport_name,
										'GL_CODE'     =>$glPostCode,
										'GL_NAME'     =>$glPostName,
										'PARTICULAR'  =>$particular,
										'DRAMT'       =>$freight_amt,
										'CREATED_BY'  =>$createdBy,

									);


									$saveData4 = DB::table('JV_TRAN')->insert($data);

									$gl_enrty = 'GL_WITH_GL';

									$this->JournalGlLegEntry($compCode,$fisYear,$transcode,$seriescode,$glPostCode,$glPostName,$JvVrNo,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$freight_amt,$particular,$createdBy,$gl_enrty);
								}



								$BillArray = array(

									'BILL_STATUS' => 1


								);

						       $updateData = DB::table('TRIP_HEAD')->where('TRIPHID',$TRIPHEADID)->update($BillArray);

								
							} /* -- FOR LOOP */


		
		  				}/* FOR EACH*/

		  				}
		  			
		 			}



		 			 $checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->get()->toArray();
			

						if(empty($checkvrnoExist)){

							$datavrnIn =array(
								'COMP_CODE'   =>$compCode,
								'FY_CODE'     =>$fisYear,
								'TRAN_CODE'   =>$trans_code,
								'SERIES_CODE' =>$series_code,
								'FROM_NO'     =>1,
								'TO_NO'       =>99999,
								'LAST_NO'     =>$JvVrNo,
								'CREATED_BY'  =>$createdBy,
							);

							DB::table('MASTER_VRSEQ')->insert($datavrnIn);

						}else{
							$datavrn =array(
								'LAST_NO'=>$JvVrNo
							);
							DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->update($datavrn);
						}



				DB::commit();


				if($pdfYesNoStatus == 1){
						return $this->GeneratePdfForJournal($JvVrNo,$trans_code,$framt);
				}
			  	
				$data1['response'] = 'success';
				$data1['party'] = $data1;
	  			$getalldata = json_encode($data1);  
	  			print_r($getalldata);

       	}catch (\Exception $e) {

			    DB::rollBack();
			    throw $e;
			    $data1['response'] = 'error';
	  			$getalldata = json_encode($data1);  
	  			print_r($getalldata);
			}
		  		

		 	} /* AJAX */


    }

public function JournalGlDebitLegEntry($compCode,$fisYear,$transcode,$seriescode,$gl_code,$gl_name,$NewVrno,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$glamt,$particular,$createdBy){

	/*print_r($compCode);
	print_r($fisYear);
	print_r($gl_code);*/

		$getdata = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('GL_CODE', $gl_code)->get()->first();

			if($getdata){

			   $RDRAMT = $getdata->RDRAMT;
			    $RCRAMT = $getdata->RCRAMT;
			    $YROPDR = $getdata->YROPDR;
			    $YROPCR = $getdata->YROPCR;

			    $debitAmt  =  $glamt + $RDRAMT;
			    $creditAmt =  '';

			    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt);
			  
	            $dataarqty = array(
	            	
					'RDRAMT'  => $debitAmt,
					'RCRAMT'  => $creditAmt,
					'RBAL'    => $RBAL,
			
	            );

         		$updateData12 = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('GL_CODE', $gl_code)->update($dataarqty);

			}else{

				$dataItmBal = array(
					'COMP_CODE' => $compCode,
					'FY_CODE'   => $fisYear,
					'PFCT_CODE' => $pfctcode,
					'GL_CODE'   => $gl_code,
					'RDRAMT'    => $glamt,
					'RCRAMT'    => '',
				);

				DB::table('MASTER_GLBAL')->insert($dataItmBal);
			}

			$gledgH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
			$gledgID = json_decode(json_encode($gledgH), true); 
			if(empty($gledgID[0]['GLTRANID'])){
				$gledg_Id = 1;
			}else{
				$gledg_Id = $gledgID[0]['GLTRANID']+1;
			}

			$data_gl = array(	
				'GLTRANID'    =>$gledg_Id,
				'COMP_CODE'   =>$compCode,
				'FY_CODE'     =>$fisYear,
				'TRAN_CODE'   =>$transcode,
				'SERIES_CODE' =>$seriescode,
				'VRNO'        =>$NewVrno,
				'SLNO'        =>$srno,
				'VRDATE'      =>$pay_vr_date,
				'PFCT_CODE'   =>$pfctcode,
				'GL_CODE'     =>$gl_code,
				'GL_NAME'     =>$gl_name,
				'REF_CODE'    =>$transport_code,
				'REF_NAME'    =>$transport_name,
				'DRAMT'       =>$glamt,
				'CRAMT'       =>'',
				'PARTICULAR'  =>$particular,
				'CREATED_BY'  =>$createdBy
	    	);
	    	DB::table('GL_TRAN')->insert($data_gl);

	}
	public function JournalGlCreditLegEntry($compCode,$fisYear,$transcode,$seriescode,$gl_code,$gl_name,$NewVrno,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$glamt,$particular,$createdBy){

		$getdata = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('GL_CODE', $gl_code)->get()->first();

			if($getdata){

				 $RDRAMT = $getdata->RDRAMT;
			    $RCRAMT = $getdata->RCRAMT;
			    $YROPDR = $getdata->YROPDR;
			    $YROPCR = $getdata->YROPCR;

			    $debitAmt  =  '';
			    $creditAmt = $glamt + $RCRAMT;

			    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($creditAmt);
			  
	            $dataarqty = array(
	            	
					'RDRAMT'  => $debitAmt,
					'RCRAMT'  => $creditAmt,
					'RBAL'    => $RBAL,
			
	            );

         		$updateData12 = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('GL_CODE', $gl_code)->update($dataarqty);

			}else{

				$dataItmBal = array(
					'COMP_CODE' => $compCode,
					'FY_CODE'   => $fisYear,
					'PFCT_CODE' => $pfctcode,
					'GL_CODE'   => $gl_code,
					'RDRAMT'    => '',
					'RCRAMT'    => $glamt,
				);

				DB::table('MASTER_GLBAL')->insert($dataItmBal);
			}

			$gledgH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
			$gledgID = json_decode(json_encode($gledgH), true); 
			if(empty($gledgID[0]['GLTRANID'])){
				$gledg_Id = 1;
			}else{
				$gledg_Id = $gledgID[0]['GLTRANID']+1;
			}

			$data_gl = array(	
				'GLTRANID'    =>$gledg_Id,
				'COMP_CODE'   =>$compCode,
				'FY_CODE'     =>$fisYear,
				'TRAN_CODE'   =>$transcode,
				'SERIES_CODE' =>$seriescode,
				'VRNO'        =>$NewVrno,
				'SLNO'        =>$srno,
				'VRDATE'      =>$pay_vr_date,
				'PFCT_CODE'   =>$pfctcode,
				'GL_CODE'     =>$gl_code,
				'GL_NAME'     =>$gl_name,
				'REF_CODE'    =>$transport_code,
				'REF_NAME'    =>$transport_name,
				'DRAMT'       =>'',
				'CRAMT'       =>$glamt,
				'PARTICULAR'  =>$particular,
				'CREATED_BY'  =>$createdBy
	    	);
	    	DB::table('GL_TRAN')->insert($data_gl);

	}


public function JournalGlLegEntry($compCode,$fisYear,$transcode,$seriescode,$glCode,$glName,$JvVrNo,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$freight_amt,$particular,$createdBy,$gl_enrty){

		$getdata = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('GL_CODE', $glCode)->get()->first();

				if($gl_enrty=='GL_WITH_ACC'){

					$cr_amt = $freight_amt;
					$dr_amt = '';
				}else{

					$cr_amt = '';
				    $dr_amt = $freight_amt;
				}

			if($getdata){

				$RDRAMT = $getdata->RDRAMT;
			    $RCRAMT = $getdata->RCRAMT;
			    $YROPDR = $getdata->YROPDR;
			    $YROPCR = $getdata->YROPCR;

			    $debitAmt  =  $freight_amt + $RDRAMT;
			    $creditAmt =  '';

			    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt);
			  
	            $dataarqty = array(
	            	
					'RDRAMT'  => $debitAmt,
					'RCRAMT'  => $creditAmt,
					'RBAL'    => $RBAL,
			
	            );

         		$updateData12 = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('GL_CODE', $glCode)->update($dataarqty);

			}else{

				$dataItmBal = array(
					'COMP_CODE' => $compCode,
					'FY_CODE'   => $fisYear,
					'PFCT_CODE' => $pfctcode,
					'GL_CODE'   => $glCode,
					'RDRAMT'    => $freight_amt,
					'RCRAMT'    => '',
				);

				DB::table('MASTER_GLBAL')->insert($dataItmBal);
			}

			$gledgH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
			$gledgID = json_decode(json_encode($gledgH), true); 
			if(empty($gledgID[0]['GLTRANID'])){
				$gledg_Id = 1;
			}else{
				$gledg_Id = $gledgID[0]['GLTRANID']+1;
			}

			$data_gl = array(	
				'GLTRANID'    =>$gledg_Id,
				'COMP_CODE'   =>$compCode,
				'FY_CODE'     =>$fisYear,
				'TRAN_CODE'   =>$transcode,
				'SERIES_CODE' =>$seriescode,
				'VRNO'        =>$JvVrNo,
				'SLNO'        =>$srno,
				'VRDATE'      =>$pay_vr_date,
				'PFCT_CODE'   =>$pfctcode,
				'GL_CODE'     =>$glCode,
				'GL_NAME'     =>$glName,
				'REF_CODE'    =>$transport_code,
				'REF_NAME'    =>$transport_name,
				'DRAMT'       =>$dr_amt,
				'CRAMT'       =>$cr_amt,
				'PARTICULAR'  =>$particular,
				'CREATED_BY'  =>$createdBy
	    	);
	    	DB::table('GL_TRAN')->insert($data_gl);

	}

	public function JournalAccEntry($compCode,$fisYear,$transcode,$seriescode,$glCode,$glName,$JvVrNo,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$fianlfrAmt,$particular,$createdBy){

		$AcledgerH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
		$AledgID = json_decode(json_encode($AcledgerH), true); 
		if(empty($AledgID[0]['ACCTRANID'])){
			$Aledg_Id = 1;
		}else{
			$Aledg_Id = $AledgID[0]['ACCTRANID']+1;
		}

		$data_led = array(	
			'ACCTRANID'   =>$Aledg_Id,
			'COMP_CODE'   =>$compCode,
			'FY_CODE'     =>$fisYear,
			'TRAN_CODE'   =>$transcode,
			'SERIES_CODE' =>$seriescode,
			'VRNO'        =>$JvVrNo,
			'SLNO'        =>$srno,
			'VRDATE'      =>$pay_vr_date,
			'PFCT_CODE'   =>$pfctcode,
			'ACC_CODE'    =>$transport_code,
			'ACC_NAME'    =>$transport_name,
			'REF_CODE'    =>$glCode,
			'REF_NAME'    =>$glName,
			'DRAMT'       =>'',
			'CRAMT'       =>$fianlfrAmt,
			'PARTICULAR'  =>$particular,
			'CREATED_BY'  =>$createdBy,
			
    	);
		$saveDataLEGD = DB::table('ACC_TRAN')->insert($data_led);

		$getdata = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('ACC_CODE', $transport_code)->get()->first();

			if($getdata){

				$RDRAMT    = $getdata->RDRAMT;
				$RCRAMT    = $getdata->RCRAMT;
				$YROPDR    = $getdata->YROPDR;
				$YROPCR    = $getdata->YROPCR;
				$debitAmt  =  '';
				$creditAmt =  $fianlfrAmt + $RCRAMT;

			    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($creditAmt);

	            $dataarqty = array(
					'RDRAMT'  => $debitAmt,
					'RCRAMT'  => $creditAmt,
					'RBAL'    => $RBAL,
	            );

         		$updateData12 = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('ACC_CODE', $transport_code)->update($dataarqty);

			}else{

				$dataItmBal = array(
					'COMP_CODE' => $compCode,
					'FY_CODE'   => $fisYear,
					'PFCT_CODE' => $pfctcode,
					'ACC_CODE'  => $transport_code,
					'RDRAMT'    => '',
					'RCRAMT'    => $fianlfrAmt,
				);

				DB::table('MASTER_ACCBAL')->insert($dataItmBal);
			}

	}


public function ViewTransporterBillPosting(Request $request){

		$company_name = $request->session()->get('company_name');
		$spliName     = explode('-',$company_name);
		$compCode     = $spliName[0];

		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$transCode    = 'A2';

  		if ($request->ajax()) {

  			if (!empty($request->accCode || $request->seriesCode || $request->to_date)) {

				$party      = $request->accCode;
				$seriesCode = $request->seriesCode;
				$to_date    = $request->to_date;
				$todate     = date("Y-m-d", strtotime($to_date));
				
				$fromdate   = $request->fromdate;
				$from_date  = date("Y-m-d", strtotime($fromdate));
				
				$strWhere='';

				if(isset($party)  && trim($party)!="")
	      	 	{
	      			$strWhere .="AND JV_TRAN.ACC_CODE= '$party'";
	      		}

	      		if(isset($seriesCode)  && trim($seriesCode)!="")
	      	 	{
	      			$strWhere .="AND JV_TRAN.SERIES_CODE= '$seriesCode'";
	      		}

	      		if(isset($to_date)  && trim($to_date)!="")
	      	 	{
	      			$strWhere .="AND JV_TRAN.VRDATE BETWEEN '$from_date' AND  '$todate'";
	      		}

	      		$data = DB::select("SELECT * FROM JV_TRAN  WHERE 1=1 $strWhere AND COMP_CODE='$compCode' AND FY_CODE='$macc_year' AND SERIES_CODE='JB02'");

	      		return DataTables()->of($data)->addIndexColumn()->make(true);

	      		/*return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="'.url('/Transaction/Account/Edit-Journal-Trans/'.base64_encode($data->JVID).'/'.base64_encode($data->VRNO)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#journalDelete" class="btn btn-danger btn-xs" onclick="return deleteJournalT('.$data->VRNO.')"><i class="fa fa-trash" title="delete"></i></button>';
	     			
	     			return $btn;
				})->make(true);*/

  			}else{

				/*$data = DB::table('TRIP_BODY')
				->where('COMP_CODE',$compCode)
				->where('FY_CODE',$macc_year)
				->where('BILL_STATUS','JB02')
				->orderBy('VRDATE','ASC')
				->get();*/

				$data = DB::select("SELECT TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIP_HEAD.PBILL_STATUS='1'");

			   //print_r($data);exit;

				/*return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="'.url('/Transaction/Account/Edit-Journal-Trans/'.base64_encode($data->JVID).'/'.base64_encode($data->VRNO)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#journalDelete" class="btn btn-danger btn-xs" onclick="return deleteJournalT('.$data->VRNO.')"><i class="fa fa-trash" title="delete"></i></button>';
	     			
	     			return $btn;
				})->make(true);*/

				return DataTables()->of($data)->addIndexColumn()->make(true);
		    }
		}

		$title        = 'View Journal Transaction';

		$acc_list     = DB::table('MASTER_ACC')->get();

		$getCommonData = MyCommonFun($transCode,$compCode,$macc_year);

		$userdata['series_list']  = $getCommonData['getseries'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

  		if(isset($company_name)){
        	return view('admin.finance.transaction.logistic.view_transporter_bill_posting',$userdata+compact('title','acc_list'));
  		}else{
			return redirect('/useractivity');
		}
		
    }



public function ViewTransporterBillPostingMsg(Request $request,$saveData){

	

		if ($saveData=='false') {

			//print_r($saveData);
			$request->session()->flash('alert-error', 'Transporter Bill Not Generated...!');
			return redirect('/Transaction/Logistic/View-lr-acknowledgment-trans');

		} else{
		//print_r($saveData);
			$request->session()->flash('alert-success', 'Transporter Bill Successfully Generated...!');
			return redirect('/Transaction/Logistic/View-lr-acknowledgment-trans');

		}
	}


     public function ViewChildTransporterPost(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$delivery_order = DB::table('TRIP_BODY')->where('TRIPHID', $headid)->where('VRNO', $vrno)->where('BILL_STATUS', '1')->get()->toArray();
	    	

	 //   print_r($delivery_order);exit;

    		if($delivery_order) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $delivery_order;
	         

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


     public function GeneratePdfForTransportBill($uniqNo,$headId,$vrno,$tCode,$compCode,$accCode){

		$response_array = array();


		$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

		$compDetail =  DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$compCode'");

		$headtable = 'JV_TRAN';

		$dataheadB = DB::SELECT("SELECT t1.*,t2.*,'$headtable' as tableName FROM $headtable t1  WHERE t1.$columnheadid='$tripid'");

		$data = DB::table('JV_TRAN')
				->where('COMP_CODE',$compCode)
				->where('FY_CODE',$macc_year)
				->where('SERIES_CODE','JB02')
				->orderBy('VRDATE','ASC')
				->get();

		//print_r($dataheadB);exit;
		/*$amt = [];
		foreach($expDetail as  $key){

			$amt[] += $key->AMOUNT;
		}*/

		//print_r($amt);exit;

		header('Content-Type: application/pdf');
     
    	$pdf = PDF::loadView('admin.finance.transaction.logistic.trip_expense_pdf',compact('dataheadB','dataAccDetail','pumpDetail','expDetail','compDetail','vrNoPname'));

    	$path = public_path('dist/downloadpdf'); 
    	$fileName =  time().'.'. 'pdf' ; 
    	$pdf->save($path . '/' . $fileName);
    	$PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['data'] = $dataheadB;
        echo $data = json_encode($response_array);

		

		//$this->ConvertAmountIntoWord($dataheadB,,$dataAccDetail,$compDetail,$vrNoPname);

	}

	public function simulationForBillTransporter(Request $request){

		$response_array = array();

        if ($request->ajax()) {

			$taxRowCount   = $request->input('taxRowCount');
			$taxIndCode    = $request->input('taxIndCode');
			$rate_indName  = $request->input('rate_indName');
			$af_rate       = $request->input('af_rate');
			$taxamount     = $request->input('amount');
			$taxGlCode     = $request->input('taxGlCode');
			$series_gl     = $request->input('series_glCd');
			$post_code     = $request->input('post_code');
			$NetAmnt       = $request->input('NetAmnt');
			$chkboxChecked = $request->input('chkboxChecked');
			$basic_amnt    = $request->input('basic_amnt');
			$tds_deductAmt = $request->input('tds_deductAmt');
			$tds_gl_code   = $request->input('tds_gl_code');
			$taxAply       = $request->input('taxApplyChk');
			$tdsApply      = $request->input('tdsApplChk');
			$vehicleType   = $request->input('vehicleType');
			
			$userId        = $request->session()->get('userid');  
			$company_name  = $request->session()->get('company_name');
			$spliName      = explode('-',$company_name);
			$compCode      = $spliName[0];
			$macc_year     = $request->session()->get('macc_year');  

            DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->delete();

        	if($vehicleType == 'SELF'){

        		$check_Exist_SELF = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->get()->toArray();

        		if(empty($check_Exist_SELF)){

        			$tripHead_Idself = array();

        			for ($g = 0; $g <count($chkboxChecked); $g++) {

            			$split_Id =  explode('~', $chkboxChecked[$g]);
            			$tbodyId = $split_Id[0];

            			$body_data = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.BASIC_AMT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_HEAD.DRIVER_NAME,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIPBID='$tbodyId'");
            			
            			foreach($body_data as $trows){

							$tripHead_Idself[] = $trows->TRIPHID;
							$freightAmt        = $trows->TRIP_FREIGHT_AMT;
							$addLessCharge     = $trows->ADD_LESS_CHRG;
							$basicAmnt         = $trows->BASIC_AMT;

            			}/*/. FOREACH LOOP*/
            			
            		} /* /. FOR LOOP*/

            		/* --------- trip charges ----------- */

            			for($r=0;$r<count($tripHead_Idself);$r++){

            				$triChargeDataSelf = DB::table('TRIP_CHARGE_EXP')->where('COMP_CODE',$compCode)->where('FY_CODE',$macc_year)->where('TRIPHID',$tripHead_Idself[$r])->where('CREATED_BY',$userId)->get();
							
            				foreach($triChargeDataSelf as $charge){

				        		/* ----- CHECK GL IS BLANK IN CHARGE ------ */

				        		if(($charge->GL_CODE == '') || ($charge->GL_CODE == null)){

				      				
				        		}else{

				        			if($charge->INDEX_NAME ==  'M'){
					        			$drAmtch = $charge->AMOUNT;
					        			$crAmtch = 0.00;
					        		}else if($charge->INDEX_NAME ==  'L'){
					        			$drAmtch = $charge->AMOUNT;
					        			$crAmtch = 0.00;
					        		}else{
					        			$drAmtch = 0.00;
					        			$crAmtch = 0.00;
					        		}

					        		$checkGlExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->where('IND_GL_CODE',$charge->GL_CODE)->get()->first();

					        		if($checkGlExist){

										$drAmt_gl   = $checkGlExist->DR_AMT;

										$addWith_Dr = $drAmt_gl+$drAmtch;

										$updateData   = array(
						                    'DR_AMT'      => $addWith_Dr,
						                );

										DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->where('IND_GL_CODE',$charge->GL_CODE)->update($updateData);

					        		}else{

					        			$chargeData   = array(

						                    'DR_AMT'      => $drAmtch,
						                    'CR_AMT'	  => 0.00,
						                    'IND_GL_CODE' => $charge->GL_CODE,
						                    'TCFLAG'      => 'LSTB',
						                    'CREATED_BY'  => $userId,
					                	);

					                	DB::table('SIMULATION_TEMP')->insert($chargeData);
					        		}

				        		}
				        		/* ----- CHECK GL IS BLANK IN CHARGE ------ */

				        	} /* /.foreach loop*/

				        }/*/.get multiple data of headid*/

            		/* --------- trip charges ----------- */

            		/* -------- account credit --------*/

            			$accData = array(

							'IND_CODE'    => '',
							'DR_AMT'      => '',
							'CR_AMT'      => $NetAmnt,
							'IND_GL_CODE' => $post_code,
							'TCFLAG'      => 'LSTB',
							'CODE_NAME'   => 'Acc Code',
							'CREATED_BY'  => $userId,
			            );

			            DB::table('SIMULATION_TEMP')->insert($accData);

            		/* -------- account credit --------*/

        		}/* /. CHECK IS DATA IS IN SIMULATION*/

        	}else if($vehicleType == 'MARKET'){

            	$check_Exist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->get()->toArray();

            	if(empty($check_Exist)){

            		$tripHead_Id =array();

            		if($taxAply ==1){

            			for($l=0;$l<$taxRowCount;$l++){

            				$rateindex   = $rate_indName[$l];
			                $taxamt      = $taxamount[$l];
			                $tax_gl_code = $taxGlCode[$l];
			                $uniqCheck   = $taxIndCode[$l];

			                $checkExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->get()->toArray();

			                $indData = DB::table('SIMULATION_TEMP')->where('IND_CODE',$uniqCheck)->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->get()->toArray();

			                if($taxamt !=0.00){

			                	if($rateindex == 'Z'){

                    			}else{

                    				if(empty($checkExist)){

			                            $idary = array(
			                                'IND_CODE'    => $uniqCheck,
			                                'DR_AMT'      => $basic_amnt,
			                                'CR_AMT'      => '',
			                                'IND_GL_CODE' => $series_gl,
			                                'TCFLAG'      => 'LSTB',
			                                'CODE_NAME'   => 'Series Gl',
			                                'CREATED_BY'  => $userId,
			                            
			                            );
			                            DB::table('SIMULATION_TEMP')->insert($idary);

			                        }else  if($tax_gl_code == ''){

			                            $bscVal = DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->get()->toArray();

			                            $updateId = $bscVal[0]->CREATED_BY;
			                            $basicAmt = $bscVal[0]->DR_AMT + $taxamt;
			                        
			                            $idary_bsic = array(
			                                'DR_AMT'       =>$basicAmt,
			                                'CR_AMT'      =>0.00,
			                            );

			                             DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('TCFLAG','LSTB')->where('CREATED_BY',$updateId)->update($idary_bsic);

			                        }else if(empty($indData)){

			                            $idary   = array(
			                                'IND_CODE'    => $uniqCheck,
			                                'DR_AMT'      => $taxamt,
			                                'CR_AMT'      => '',
			                                'IND_GL_CODE' => $tax_gl_code,
			                                'CODE_NAME'   => 'Tax Gl',
			                                'TCFLAG'      => 'LSTB',
			                                'CREATED_BY'  => $userId,
			                                
			                            );

			                            DB::table('SIMULATION_TEMP')->insert($idary);
			                        }else{

			                            $indData1 = DB::table('SIMULATION_TEMP')->where('IND_CODE',$uniqCheck)->where('TCFLAG','LSTB')->where('CREATED_BY',$userId)->get()->first();

			                            $newTaxAmt = $indData1->DR_AMT + $taxamt;

			                            $idary1 = array(
			                                'DR_AMT' => $newTaxAmt,
			                                'CR_AMT' =>0.00,
			                            );

			                            $updatevr = DB::table('SIMULATION_TEMP')->where('IND_CODE',$uniqCheck)->where('TCFLAG','LSTB')->where('CREATED_BY',$userId)->update($idary1);
			                        }

                    			}/* /. chk z*/

			                }/* /. tax amt not zero*/

            			}

            			$accData = array(

			                'IND_CODE'     => '',
			                'DR_AMT'       => '',
			                'CR_AMT'       => $NetAmnt,
			                'IND_GL_CODE' => $post_code,
			                'TCFLAG'       => 'LSTB',
			                'CODE_NAME'    => 'Acc Code',
			                'CREATED_BY'   => $userId,
			            );

			            DB::table('SIMULATION_TEMP')->insert($accData);

			            for($t=0;$t<count($chkboxChecked);$t++){

				            $splitId =  explode('~', $chkboxChecked[$t]);
				        	$checkid = $splitId[0];

				        	$bodydata = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_BODY.TRIPHID FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIP_BODY.TRIPBID='$checkid'");

					        foreach($bodydata as $row){
					          $tripHead_Id[] = $row->TRIPHID;
					        }

           		 		}

            		}else{

            			
	            		for ($i = 0; $i <count($chkboxChecked); $i++) {

	            			$split_Id =  explode('~', $chkboxChecked[$i]);
	            			$tbodyId = $split_Id[0];

	            			$body_data = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.BASIC_AMT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_HEAD.DRIVER_NAME,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIPBID='$tbodyId'");
	            			
	            			foreach($body_data as $trow){

								$tripHead_Id[] = $trow->TRIPHID;
								$freightAmt    = $trow->TRIP_FREIGHT_AMT;
								$addLessCharge = $trow->ADD_LESS_CHRG;
								$basicAmnt     = $trow->BASIC_AMT;

	            				for ($s = 1; $s < 3; ++$s) {

	            					if($s==1){

	            						$idary = array(
					                        'DR_AMT'      => $freightAmt,
					                        'CR_AMT'      => 0.00,
					                        'IND_GL_CODE' => $series_gl,
					                        'TCFLAG'      => 'LSTB',
					                        'CODE_NAME'   => 'Series Gl',
					                        'CREATED_BY'  => $userId,
					                    
					                    );
					                    DB::table('SIMULATION_TEMP')->insert($idary);

	            					}else if($s==2){

	            						$add_chargePos = abs($addLessCharge);
										$crAmt =$freightAmt - $add_chargePos;

	            						$idary1 = array(
	            							'IND_CODE'	  => $trow->TRIPHID,
					                        'DR_AMT'      => 0.00,
					                        'CR_AMT'      => $basicAmnt,
					                        'IND_GL_CODE' => $post_code,
					                        'TCFLAG'      => 'LSTB',
					                        'CODE_NAME'   => 'Series Gl',
					                        'CREATED_BY'  => $userId,
					                    
					                    );
					                    DB::table('SIMULATION_TEMP')->insert($idary1);

	            					}
	            				}

	            			}
	            			
	            		}

            		} /* /. tax apply or not*/

            		/* --------- trip charges ----------- */

            			for($r=0;$r<count($tripHead_Id);$r++){

            				$triChargeData = DB::table('TRIP_CHARGE_EXP')->where('COMP_CODE',$compCode)->where('FY_CODE',$macc_year)->where('TRIPHID',$tripHead_Id[$r])->where('CREATED_BY',$userId)->get();

            				foreach($triChargeData as $charge){

				        		/* ----- CHECK GL IS BLANK IN CHARGE ------ */

				        		if(($charge->GL_CODE == '') || ($charge->GL_CODE == null)){

				        			$checkExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->where('IND_CODE',$tripHead_Id[$r])->get()->first();
				        		
				        			$seriescrAmt = $checkExist->CR_AMT + abs($charge->AMOUNT);

				        			$updateData   = array(
					                    'CR_AMT'      => $seriescrAmt,
					                );

					                DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->where('IND_CODE',$tripHead_Id[$r])->update($updateData);

				        		}else{

				        			if($charge->INDEX_NAME ==  'M'){
					        			$crAmtch = abs($charge->AMOUNT);
					        			$drAmtch = 0.00;
					        		}else if($charge->INDEX_NAME ==  'L'){
					        			$drAmtch = $charge->AMOUNT;
					        			$crAmtch = 0.00;
					        		}else{
					        			$crAmtch = 0.00;
					        			$drAmtch = 0.00;
					        		}

					        		$chargeData   = array(
					                    'DR_AMT'      => $drAmtch,
					                    'CR_AMT'      => $crAmtch,
					                    'IND_GL_CODE' => $charge->GL_CODE,
					                    'TCFLAG'      => 'LSTB',
					                    'CREATED_BY'  => $userId,
					                    
					                );

					                DB::table('SIMULATION_TEMP')->insert($chargeData);

				        		} 

				        		/* ----- CHECK GL IS BLANK IN CHARGE ------ */
				        		

				        	}

            			}

            		/* --------- trip charges ----------- */

            		/* ------------- TDS apply ------------ */

            			if($tdsApply == 1){
            				for ($f = 1; $f < 3; ++$f) {

            					if($f == 1){
            						$chargeData   = array(
					                    'DR_AMT'      => $tds_deductAmt,
					                    'CR_AMT'      => 0.00,
					                    'IND_GL_CODE' => $post_code,
					                    'TCFLAG'      => 'LSTB',
					                    'CREATED_BY'  => $userId,
					                    
					                );

					                DB::table('SIMULATION_TEMP')->insert($chargeData);
            					}else if($f==2){
            						$chargeData   = array(
					                    'DR_AMT'      => 0.00,
					                    'CR_AMT'      => $tds_deductAmt,
					                    'IND_GL_CODE' => $tds_gl_code,
					                    'TCFLAG'      => 'LSTB',
					                    'CREATED_BY'  => $userId,
					                    
					                );

					                DB::table('SIMULATION_TEMP')->insert($chargeData);
            					}
            					
            				}
            			}
            		/* ------------- TDS apply ------------ */

            	} /* check exist*/

            } /* /. CHCK VEHICLE TYPE*/

            $response_array = array();

            $taxData = DB::select("SELECT t1.*,t2.GL_NAME as glName,t3.ACC_NAME AS accName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE LEFT JOIN MASTER_ACC t3 ON t3.ACC_CODE =t1.IND_ACC_CODE WHERE t1.CREATED_BY='$userId' AND t1.TCFLAG='LSTB'");

            if ($taxData) {

                $response_array['response'] = 'success';
                $response_array['data_tax'] = $taxData;

                $data = json_encode($response_array);

                print_r($data);

            }else{

                $response_array['response']  = 'error';
                $response_array['data']      = '';

                $data = json_encode($response_array);

                print_r($data);
                
            }

        }else{

                $response_array['response']  = 'error';
                $response_array['data']      = '' ;

                $data = json_encode($response_array);

                print_r($data);
        }


	}


	public function simulationForBillTransporter_old(Request $request){

        $response_array = array();

        if ($request->ajax()) {

			$taxRowCount  = $request->input('taxRowCount');
			$taxIndCode   = $request->input('taxIndCode');
			$rate_indName = $request->input('rate_indName');
			$af_rate      = $request->input('af_rate');
			$taxamount    = $request->input('amount');
			$taxGlCode    = $request->input('taxGlCode');
			$series_gl    = $request->input('series_glCd');
			$post_code    = $request->input('post_code');
			$NetAmnt      = $request->input('NetAmnt');
			$chkboxChecked= $request->input('chkboxChecked');
			$basic_amnt   = $request->input('basic_amnt');
			$userId       = $request->session()->get('userid');  
			$company_name = $request->session()->get('company_name');
			$spliName     = explode('-',$company_name);
			$compCode     = $spliName[0];
			$macc_year    = $request->session()->get('macc_year');  

            DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->delete();

            for($i=0;$i<$taxRowCount;$i++){

                $rateindex   = $rate_indName[$i];
                $taxamt      = $taxamount[$i];
                $tax_gl_code = $taxGlCode[$i];
                $uniqCheck   = $taxIndCode[$i];


                $checkExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->get()->toArray();

                $indData = DB::table('SIMULATION_TEMP')->where('IND_CODE',$uniqCheck)->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->get()->toArray();

                if($taxamt !=0.00){

                    if($rateindex == 'Z'){

                    }else{

                        if(empty($checkExist)){

                            $idary = array(
                                'IND_CODE'    => $uniqCheck,
                                'DR_AMT'      => $basic_amnt,
                                'CR_AMT'      => '',
                                'IND_GL_CODE' => $series_gl,
                                'TCFLAG'      => 'LSTB',
                                'CODE_NAME'   => 'Series Gl',
                                'CREATED_BY'  => $userId,
                            
                            );
                            DB::table('SIMULATION_TEMP')->insert($idary);

                        }else  if($tax_gl_code == ''){

                            $bscVal = DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$userId)->where('TCFLAG','LSTB')->get()->toArray();

                            $updateId = $bscVal[0]->CREATED_BY;
                            $basicAmt = $bscVal[0]->DR_AMT + $taxamt;
                        
                            $idary_bsic = array(
                                'DR_AMT'       =>$basicAmt,
                                'CR_AMT'      =>0.00,
                            );

                             DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('TCFLAG','LSTB')->where('CREATED_BY',$updateId)->update($idary_bsic);

                        }else if(empty($indData)){

                            $idary   = array(
                                'IND_CODE'    => $uniqCheck,
                                'DR_AMT'      => $taxamt,
                                'CR_AMT'      => '',
                                'IND_GL_CODE' => $tax_gl_code,
                                'CODE_NAME'   => 'Tax Gl',
                                'TCFLAG'      => 'LSTB',
                                'CREATED_BY'  => $userId,
                                
                            );

                            DB::table('SIMULATION_TEMP')->insert($idary);
                        }else{
                            $indData1 = DB::table('SIMULATION_TEMP')->where('IND_CODE',$uniqCheck)->where('TCFLAG','LSTB')->where('CREATED_BY',$userId)->get()->first();

                            $newTaxAmt = $indData1->DR_AMT + $taxamt;

                            $idary1 = array(
                                'DR_AMT' => $newTaxAmt,
                                'CR_AMT' =>0.00,
                            );

                            $updatevr = DB::table('SIMULATION_TEMP')->where('IND_CODE',$uniqCheck)->where('TCFLAG','LSTB')->where('CREATED_BY',$userId)->update($idary1);
                        }
                    }

                }
                
            }

            $accData = array(

                'IND_CODE'     => '',
                'DR_AMT'       => '',
                'CR_AMT'       => $NetAmnt,
                'IND_GL_CODE' => $post_code,
                'TCFLAG'       => 'LSTB',
                'CODE_NAME'    => 'Acc Code',
                'CREATED_BY'   => $userId,
            );

            DB::table('SIMULATION_TEMP')->insert($accData);


            $chargeheadId = array();
            for($r=0;$r<count($chkboxChecked);$r++){

            	$splitId =  explode('~', $chkboxChecked[$r]);
				$checkid = $splitId[0];

				$bodydata = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_BODY.TRIPHID FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIP_BODY.TRIPBID='$checkid'");

				foreach($bodydata as $row){
					$chargeheadId[] = $row->TRIPHID;
				}

            }

            for ($q = 0; $q <count($chargeheadId) ; ++$q) {

            	$triChargeData = DB::table('TRIP_CHARGE_EXP')->where('COMP_CODE',$compCode)->where('FY_CODE',$macc_year)->where('TRIPHID',$chargeheadId[$q])->where('CREATED_BY',$userId)->get();

            	//print_r($triChargeData);
            	
            	foreach($triChargeData as $charge){
            		
            		if($charge->INDEX_NAME ==  'M'){
            			$crAmtch = abs($charge->AMOUNT);
            			$drAmtch = 0.00;
            		}else if($charge->INDEX_NAME ==  'L'){
            			$drAmtch = $charge->AMOUNT;
            			$crAmtch = 0.00;
            		}else{
            			$crAmtch = 0.00;
            			$drAmtch = 0.00;
            		}

            		$chargeData   = array(
                        'DR_AMT'      => $drAmtch,
                        'CR_AMT'      => $crAmtch,
                        'IND_GL_CODE' => $charge->GL_CODE,
                        'CODE_NAME'   => 'Expense Charge',
                        'TCFLAG'      => 'LSTB',
                        'CREATED_BY'  => $userId,
                        
                    );

                    DB::table('SIMULATION_TEMP')->insert($chargeData);

            	}
            	
            }

            $response_array = array();

            $taxData = DB::select("SELECT t1.*,t2.GL_NAME as glName,t3.ACC_NAME AS accName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE LEFT JOIN MASTER_ACC t3 ON t3.ACC_CODE =t1.IND_ACC_CODE WHERE t1.CREATED_BY='$userId' AND t1.TCFLAG='LSTB'");

            if ($taxData) {

                $response_array['response'] = 'success';
                $response_array['data_tax'] = $taxData;

                $data = json_encode($response_array);

                print_r($data);

            }else{

                $response_array['response']  = 'error';
                $response_array['data']      = '';

                $data = json_encode($response_array);

                print_r($data);
                
            }

        }else{

                $response_array['response']  = 'error';
                $response_array['data']      = '' ;

                $data = json_encode($response_array);

                print_r($data);
        }

    }


    public function GeneratePdfForJournal($vrno,$transCd,$totlAmount){

		$response_array = array();
		
	     // DB::enableQueryLog();
//

		$data030 = DB::select("SELECT t1.* FROM JV_TRAN t1  WHERE t1.VRNO='$vrno' AND t1.TRAN_CODE='$transCd'");

		//dd(DB::getQueryLog());
		
		$compCode   = $data030[0]->COMP_CODE;
		$compDetail = DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$compCode'");

		$title='JOURNAL REPORT';

     $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );

    $numwords = $f->format($totlAmount);

    header('Content-Type: application/pdf');

    $pdf = PDF::loadView('admin.finance.transaction.logistic.logisticjournalPDF',compact('data030','title','compDetail','numwords'));

      $path = public_path('dist/downloadpdf'); 
      $fileName =  time().'Contra.'. 'pdf' ; 
      $pdf->save($path . '/' . $fileName);
      $PublicPath = url('public/dist/downloadpdf/');  
    $downloadPdf = $PublicPath.'/'.$fileName;
    $response_array['response'] = 'success';
    $response_array['url'] = $downloadPdf;
    $response_array['fileName'] = $fileName;
    $response_array['data'] = $data030;
    //return $response_array;
    echo $data = json_encode($response_array);

	//	$this->ConvertAmountIntoWordForJv($totlAmount,$compDetail,$data030,$title);

	}




	public function ConvertAmountIntoWordForJv($totlAmount,$compDetail,$data030,$title){


    $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );

    $word = $f->format($totlAmount);


   // print_r($word);exit;

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

		header('Content-Type: application/pdf');

		$pdf = PDF::loadView('admin.finance.transaction.logistic.logisticjournalPDF',compact('data030','title','compDetail','numwords'));

	    $path = public_path('dist/downloadpdf'); 
	    $fileName =  time().'Contra.'. 'pdf' ; 
	    $pdf->save($path . '/' . $fileName);
	    $PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['fileName'] = $fileName;
		$response_array['data'] = $data030;
		//return $response_array;
		echo $data = json_encode($response_array);

	}
    
/* ------------- PDF GENERATE ------------ */

	public function GeneratePdfForLogistic_OLD($userId,$getcom_code,$plant_code,$headId,$pdfName,$tCode,$trip_day,$tripDate,$vehicle_type,$cpCodeCount,$cpCode){


		$response_array = array();

		if($tCode == 'LORRY_RECEIPT'){

      //DB::enableQueryLog();

//
			header('Content-Type: application/pdf');
			$urlArray =array();
			for($j=0;$j<$cpCodeCount;$j++){

				
				$dataheadB = DB::SELECT("SELECT A.*,B.*,A.VEHICLE_NO AS vehicleNoHead,C.ADD1,C.CITY_NAME,C.DIST_NAME,C.CONTACT_NO,C.CONTACT_PERSON,C.GST_NUM FROM TRIP_HEAD A,TRIP_BODY B,MASTER_ACCADD C WHERE A.TRIPHID=B.TRIPHID AND A.ACC_CODE = C.ACC_CODE AND B.TRIPHID='$headId' AND B.CP_CODE='$cpCode[$j]'");


				$accCode = $dataheadB[0]->ACC_CODE;


     		   $dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME,MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

        		$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.ACC_CODE = '$cpCode[$j]'");



        		$compDetail = DB::SELECT("SELECT A.*,B.COMP_NAME,B.COMP_CODE FROM `MASTER_PLANT` A,MASTER_COMP B WHERE A.COMP_CODE=B.COMP_CODE AND B.COMP_CODE='$getcom_code' AND A.PLANT_CODE='$plant_code'");

				
				$pdf = PDF::loadView('admin.finance.transaction.logistic.lorry_reciept_pdf',compact('pdfName','compDetail','dataheadB','dataAccDetail','consinerDetail','trip_day','tripDate','vehicle_type'));

				
				$path        = public_path('dist/coldStoragePDF'); 
				$fileName    =  $j.time().'.'. 'pdf' ;
				$pdf->save($path . '/' . $fileName);
				$PublicPath  = url('public/dist/coldStoragePDF/');  
				$downloadPdf = $PublicPath.'/'.$fileName;

				array_push($urlArray,$downloadPdf);
				


				//print_r($dataheadB);

			}
		

			     $response_array['response'] = 'success';
				 $response_array['url']      = $urlArray;
				$response_array['data']     = $dataheadB;
				echo $data = json_encode($response_array);

			
		}else{}
		
		

	}


	 public function offlineLrReceiptPDF(Request $request){
	
		$createdBy   = $request->session()->get('userid');
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$plant_code  = $request->input('PlantCode');
		$trip_days  = $request->input('trip_days');
		$vrdate  = $request->input('vrdate');
		$vehicle_type  = $request->input('vehicle_type');
		$vehicle_type_name  = $request->input('vehicle_type_name');
		$vehicle_model  = $request->input('vehicle_model');
		//$trans_code      = $request->input('trans_code');
		$headid     = $request->input('tripId');
		$supp_lr     = $request->input('supp_lr');
		$pdfPageName='LORRY RECEIPT';
		$transCD = 'LORRY_RECEIPT';

		if($supp_lr=='SLR'){
			$trip_plan = DB::select("SELECT t1.*,t2.TRIPBID,t2.CP_CODE,t2.CP_NAME,t2.LR_NO FROM TRIP_HEAD t1,TRIP_BODY t2 WHERE t1.TRIPHID='$headid' AND t2.TRIPHID=t1.TRIPHID AND (t1.SLR_FLAG='1' AND t1.SLR_STATUS='1') AND PLAN_STATUS='1' AND GATE_IN_STATUS='1'");
		
		
		}else{
			$trip_plan = DB::select("SELECT t1.*,t2.TRIPBID,t2.CP_CODE,t2.CP_NAME,t2.SP_CODE,t2.SP_NAME,t2.LR_NO FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID WHERE t1.TRIPHID='$headid' AND t1.LR_STATUS='1' AND PLAN_STATUS='1' AND GATE_IN_STATUS='1'");
			
		}

			
			
		    $cpArray =array();
			$spArray =array();
			$lrNo =array();

			/*$cpArray =array();
			$lrNo =array();*/

			foreach ($trip_plan as $key){

				$cpArray[] = 	$key->CP_CODE;
				$spArray[] = 	$key->SP_CODE;
				$lrNo[]    = 	$key->LR_NO;
			}

			//print_r($cpArray);exit;
		  $cpCode = $cpArray;
		  $spCode = $spArray;
		  $LrNo   =array_unique($lrNo);
		  //$LrNo   =$lrNo;
		 // $LrNoCount = count($LrNo);

	     $cpCodeCount = count($cpCode);
	     $LrNoCount = count($LrNo);


	      $LrNoAry=array();

                for ($j=0; $j < $LrNoCount; $j++) { 

                    if($j ==0){ // insert first time 
                        $LrNoAry[] = $lrNo[$j];
                        }else{
                            $chkPresent =in_array($lrNo[$j],$LrNoAry); // check lr no is present in temp aray
                            if($chkPresent == 1){
                               
                            }else{
                                $LrNoAry[]=$lrNo[$j]; // else insert in tem aray
                            }
                           }
                }

                 //print_r($LrNoCount);exit;

	     
		return $this->GeneratePdfForLogistic($createdBy,$getcompcode,$plant_code,$headid,$pdfPageName,$transCD,$trip_days,$vrdate,$vehicle_type,$vehicle_type_name,$vehicle_model,$cpCodeCount,$cpCode,$supp_lr,$LrNoAry,$LrNoCount);

	}

	public function GeneratePdfForLogistic($userId,$getcom_code,$plant_code,$headId,$pdfName,$tCode,$trip_day,$tripDate,$vehicle_type,$vehicle_type_name,$vehicle_model,$cpCodeCount,$cpCode,$supp_lr,$LrNo,$LrNoCount){


		$response_array = array();

		if($tCode == 'LORRY_RECEIPT'){

      //DB::enableQueryLog();

//
			//print_r($LrNoCount);exit;
			header('Content-Type: application/pdf');
			$urlArray =array();
			$toPlaceConsinee =array();
			for($j=0;$j<$LrNoCount;$j++){


				if($supp_lr=='SLR'){

					// DB::enableQueryLog();

					$dataheadB = DB::SELECT("SELECT A.*,B.*,A.VEHICLE_NO AS vehicleNoHead,C.ADD1,C.CITY_NAME,C.DIST_NAME,C.CONTACT_NO,C.CONTACT_PERSON,C.GST_NUM FROM TRIP_HEAD A,TRIP_BODY B,MASTER_ACCADD C WHERE A.TRIPHID=B.TRIPHID AND A.ACC_CODE = C.ACC_CODE AND B.TRIPHID='$headId' AND B.CP_CODE='$LrNo[$j]' AND A.SLR_STATUS='1' AND A.SLR_FLAG='1'");

					//print_r($dataheadB);

					//dd(DB::getQueryLog());

				}else{
					$dataheadB = DB::SELECT("SELECT A.*,B.*,A.VEHICLE_NO AS vehicleNoHead FROM TRIP_HEAD A,TRIP_BODY B where A.TRIPHID=B.TRIPHID AND B.TRIPHID='$headId' AND B.LR_NO='$LrNo[$j]'");
				}

			   ///print_r($LrNo[$j]);exit();
				
				$accCode = $dataheadB[0]->ACC_CODE;
				$to_place = $dataheadB[0]->TO_PLACE;


     		   $dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME,MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

     		  //print_r($cpCode[$j]);

        		$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.ACC_CODE = '$cpCode[$j]' AND MASTER_ACCADD.CITY_NAME='$to_place'");

        		//print_r($consinerDetail);


        		
        		/*$compDetail = DB::SELECT("SELECT A.*,B.COMP_NAME,B.COMP_CODE FROM `MASTER_PLANT` A,MASTER_COMP B WHERE A.COMP_CODE=B.COMP_CODE AND B.COMP_CODE='$getcom_code' AND A.PLANT_CODE='$plant_code'");*/

        		$compDetail = DB::SELECT("SELECT * FROM MASTER_COMP  WHERE COMP_CODE='$getcom_code'");

        	
				
				$pdf = PDF::loadView('admin.finance.transaction.logistic.lorry_reciept_pdf',compact('pdfName','compDetail','dataheadB','dataAccDetail','consinerDetail','trip_day','tripDate','vehicle_type','vehicle_type_name','supp_lr','vehicle_model'));

				
				$path        = public_path('dist/coldStoragePDF'); 
				$fileName    =  $j.time().'.'. 'pdf' ;
				$pdf->save($path . '/' . $fileName);
				$PublicPath  = url('public/dist/coldStoragePDF/');  
				$downloadPdf = $PublicPath.'/'.$fileName;

				array_push($urlArray,$downloadPdf);
				

			}
			//exit();
			
			    $response_array['response'] = 'success';
				$response_array['url']      = $urlArray;
				$response_array['data']     = $dataheadB;
				echo $data = json_encode($response_array);

			
		}else{}
		
		

	}


	public function GeneratePdfForOutward($userId,$getcom_code,$plant_code,$pdfName,$tCode,$vrno,$trip_type,$trpt_code,$trpt_name,$vehicle_no,$tri_days,$tripDate,$vehicle_type,$vehicle_model,$cpCodeCount,$cpCode,$outwardId,$supp_lr,$headId,$spCode,$LrNo,$LrNoCount){

		//print_r($supp_lr);exit;

		$response_array = array();


		if($tCode == 'DISPATCH_RECEIPT'){
 
		//	DB::enableQueryLog();
		///	print_r($trpt_code);exit();

			header('Content-Type: application/pdf');
			$urlArray =array();

		//print_r($cpCodeCount);exit;

			for($j=0;$j<$LrNoCount;$j++){



				if($supp_lr=='SLR'){
			  // DB::enableQueryLog();

						$dataheadB = DB::select("SELECT t1.*,t1.VEHICLE_NO AS vehicleNoHead,t2.TRIPBID,t2.CP_CODE,t2.CP_NAME,t2.LR_NO,t2.EBILL_NO AS EWAY_BILL_NO,t2.EWAYB_VALIDDT AS EWAY_BILL_DT,t2.INVC_NO AS INVOICE_NO,t2.INVC_DATE AS INVOICE_DATE,t2.DO_NO AS ORDER_NO,t2.DO_DATE AS ORDER_DATE,t2.WAGON_NO AS WAGON_NO,t2.WAGON_DATE AS WAGON_DATE,t2.ISSUED_QTY AS QTYISSUED,t2.AQTY AS AQTY,t2.MATERIAL_VAL AS MATERIAL_VALUE,t2.REMARK AS LR_REMARK,t2.NET_WEIGHT FROM TRIP_HEAD t1,TRIP_BODY t2 WHERE t1.TRIPHID='$headId' AND t1.VRNO='$vrno' AND t2.TRIPHID=t1.TRIPHID AND t2.LR_NO='$LrNo[$j]' AND t1.SLR_FLAG='1' AND t1.SLR_STATUS='1'");

						$accCode = $dataheadB[$j]->ACC_CODE;
			           	$to_place = $dataheadB[$j]->TO_PLACE;

			            

						/*$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.ACC_CODE = '$cpCode[$j]' AND MASTER_ACCADD.CITY_NAME='$to_place'");*/

						$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.ACC_CODE = '$spCode[$j]' AND '$to_place' LIKE CONCAT('%',MASTER_ACCADD.CITY_NAME,'%')");
					//	print_r('1');exit;
			//DB::enableQueryLog();
					
					}else{

						//DB::enableQueryLog();
						$dataheadB = DB::SELECT("SELECT A.*,A.VEHICLE_NO AS vehicleNoHead FROM CFOUTWARD_TRAN A WHERE A.VRNO='$vrno' AND A.VEHICLE_NO='$vehicle_no' AND A.COMP_CODE='$getcom_code'  AND A.LR_NO='$LrNo[$j]'");

						// dd(DB::getQueryLog());

						//print_r($dataheadB);

						$accCode = $dataheadB[0]->ACC_CODE;
						$to_place = $dataheadB[0]->TO_PLACE;


			            
						/*$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.ACC_CODE = '$cpCode[$j]' AND MASTER_ACCADD.CITY_NAME='$to_place'");*/

						//DB::enableQueryLog();
						$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.ACC_CODE = '$spCode[$j]' AND '$to_place' LIKE CONCAT('%',MASTER_ACCADD.CITY_NAME,'%')");
						//dd(DB::getQueryLog());

						// echo "<pre>";
						// print_r($consinerDetail);
						
						// exit();

					}



			   
			   // print_r($dataheadB);

		        $dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME,MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

		      //DB::enableQueryLog();

		        

		     // dd(DB::getQueryLog());

			
		
				if($trip_type=='SELF'){

					//$compDetail = DB::SELECT("SELECT A.*,B.COMP_NAME,B.COMP_CODE FROM `MASTER_PLANT` A,MASTER_COMP B WHERE A.COMP_CODE=B.COMP_CODE AND B.COMP_CODE='$getcom_code' AND A.PLANT_CODE='$plant_code'");

					$compDetail = DB::SELECT("SELECT * FROM MASTER_COMP  WHERE COMP_CODE='$getcom_code'");
					$marketcompDetail='';

				}else if($trip_type=='SISTER_CONCERN'){

					$compData = DB::SELECT("SELECT * FROM MASTER_COMP WHERE ACC_CODE='$trpt_code'");

					$sisterCompCode = $compData[$j]->COMP_CODE;



			     	$compDetail = DB::SELECT("SELECT * FROM MASTER_COMP WHERE ACC_CODE='$trpt_code'");


						$marketcompDetail='';

				}else if($trip_type=='MARKET' || $trip_type=='EX_YARD'){

					$compDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.ACC_CODE = '$trpt_code'");
				
				}
		
				/*$vehicle_type_name = DB::SELECT("SELECT * FROM MASTER_FLEETTRUCK_WHEEL WHERE  WHEEL_CODE = '$vehicle_type'");

				print_r($vehicle_type);

				$vehicleTypeName = $vehicle_type_name[0]->WHEEL_NAME;*/
				//header('Content-Type: application/pdf');
				if($tCode == 'DISPATCH_RECEIPT'){

					$pdf = PDF::loadView('admin.finance.transaction.logistic.outward_dispatch_pdf',compact('pdfName','compDetail','dataheadB','dataAccDetail','consinerDetail','trip_type','tri_days','tripDate','vehicle_type','vehicle_model'));

				}else{}

				$path        = public_path('dist/coldStoragePDF'); 
				$fileName    =  $j.time().'.'. 'pdf' ;
				$pdf->save($path . '/' . $fileName);
				$PublicPath  = url('public/dist/coldStoragePDF/');  
				$downloadPdf = $PublicPath.'/'.$fileName;
				array_push($urlArray,$downloadPdf);
			}
	//exit;

	
				$response_array['response'] = 'success';
				$response_array['url']      = $urlArray;
				$response_array['data']     = $dataheadB;
				echo $data = json_encode($response_array);

	}

}

	public function GeneratePdfForTranSaleBill($userId,$getcom_code,$plant_code,$headId,$fsoHid,$pdfName,$tCode,$lr_no,$rowCount,$isChkChecked,$NetAmnt,$sgstAmt,$cgstAmt,$Igstamt,$gstTaxData,$SgstRate,$CgstRate,$IgstRate){
		

		$response_array = array();

		if($tCode == 'TRAN_SALE_BILL'){

			
			$urlArray =array();


			//print_r($rowCount);exit;

			  /* $dataheadB = DB::SELECT("SELECT A.*,B.*,A.VEHICLE_NO AS vehicleNoHead,C.ADD1,C.CITY_NAME,C.DIST_NAME,C.CONTACT_NO,C.CONTACT_PERSON,C.GST_NUM FROM TRIP_HEAD A,TRIP_BODY B,MASTER_ACCADD C WHERE A.TRIPHID=B.TRIPHID AND A.ACC_CODE = C.ACC_CODE AND B.TRIPHID='$headId' AND B.CP_CODE='$cpCode[$j]'");*/

			  $dataheadB=array();
		
			  for($i=0;$i < $rowCount;$i++){

				  	if ($isChkChecked[$i] =='YES') {

				 	  /*$getheadData = DB::select("SELECT T.VRDATE,T.ACC_CODE,T.ACC_NAME,T.TRIPHID,B.LR_NO,B.CP_CODE,B.SP_CODE,B.SP_NAME,B.CP_NAME,B.ITEM_CODE,B.ITEM_NAME, B.LR_DATE,SUM(B.QTY) AS DISPATCH_QTY,T.FSO_RATE,SUM(B.QTY)*T.FSO_RATE AS AMOUNT,T.FSOHID,T.PFCT_CODE,T.PFCT_NAME,T.PLANT_CODE,T.PLANT_NAME,T.FROM_PLACE,T.TO_PLACE,T.SERIES_CODE,T.SERIES_NAME,T.TO_PLACE,T.VEHICLE_NO AS vehicleNoHead,T.REMARK,B.GROSS_WEIGHT FROM TRIP_HEAD T,TRIP_BODY B WHERE 1=1 AND T.TRIPHID='$headId[$i]' AND B.TRIPHID=T.TRIPHID AND  T.LR_ACK_STATUS='1' AND  T.FSO_RATE IS NOT NULL GROUP BY T.ACC_CODE,T.ACC_NAME,T.TRIPHID,B.LR_NO");*/

				 	   // DB::enableQueryLog();

		        

		     
				 	    $getheadData = DB::select("SELECT T.VRDATE,T.ACC_CODE,T.ACC_NAME,T.TRIPHID,T.VEHICLE_NO AS vehicleNoHead,T.REMARK,T.FSOHID,T.MODEL,T.TRANSPORT_CODE,T.TRANSPORT_NAME,T.VEHICLE_TYPE,B.LR_NO,B.INVC_NO,B.DELIVERY_NO,B.CP_CODE,B.SP_CODE,B.SP_NAME,B.CP_NAME,B.WAGON_NO,B.INVC_NO,B.TRIP_ACK,B.ITEM_CODE,B.ITEM_NAME, B.LR_DATE,SUM(B.QTY) AS DISPATCH_QTY,C.RATE AS FSO_RATE,SUM(B.QTY)*C.RATE AS AMOUNT,T.PFCT_CODE,T.PFCT_NAME,T.PLANT_CODE,T.PLANT_NAME,T.TO_PLACE,T.SERIES_CODE,T.SERIES_NAME,B.GROSS_WEIGHT FROM TRIP_HEAD T,TRIP_BODY B,FSO_BODY C WHERE 1=1 AND B.TRIPHID=T.TRIPHID  AND T.FROM_PLACE=C.FROM_PLACE AND T.TO_PLACE=C.TO_PLACE AND T.ACC_CODE=C.ACC_CODE AND C.FSOHID='$fsoHid' AND T.TRIPHID='$headId[$i]' AND T.LR_ACK_STATUS='1' GROUP BY T.ACC_CODE,T.ACC_NAME,T.TRIPHID,B.LR_NO");

				 	  // dd(DB::getQueryLog());


				 	  	foreach ($getheadData as $key) {

				 	  			$dataheadB[] = $key;
				 	  		
				 	  	}

				 	}

				}

				
				$accCode = $dataheadB[0]->ACC_CODE;
				$to_place = $dataheadB[0]->TO_PLACE;
				$cpCode = $dataheadB[0]->CP_CODE;
				$spCode = $dataheadB[0]->SP_CODE;
				$plantCode = $dataheadB[0]->PLANT_CODE;


     		   $dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME,MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

        		$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.ACC_CODE ='$cpCode' AND MASTER_ACCADD.CITY_NAME='$to_place'");

        		$consineeDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.ACC_CODE ='$spCode' AND MASTER_ACCADD.CITY_NAME='$to_place'");
        		//print_r($consineeDetail);exit;



        		$compDetail = DB::SELECT("SELECT A.*,B.COMP_NAME,B.COMP_CODE,B.BANK_NAME,B.ACC_NUMBER,B.BRANCH_NAME,B.IFSC_CODE FROM `MASTER_PLANT` A,MASTER_COMP B WHERE A.COMP_CODE=B.COMP_CODE AND B.COMP_CODE='$getcom_code' AND A.PLANT_CODE='$plantCode'");

        		//print_r($compDetail);exit;

				
				$pdf = PDF::loadView('admin.finance.transaction.logistic.transporter_sale_bill_pdf',compact('pdfName','compDetail','dataheadB','dataAccDetail','consinerDetail','consineeDetail','NetAmnt','sgstAmt','cgstAmt','Igstamt','gstTaxData','SgstRate','CgstRate','IgstRate'),[],['format' => 'A4-L','orientation' => 'L']);



				header('Content-Type: application/pdf');
				$path        = public_path('dist/coldStoragePDF'); 
				$fileName    =  time().'.'. 'pdf' ;
				$pdf->save($path . '/' . $fileName);
				$PublicPath  = url('public/dist/coldStoragePDF/');  
				$downloadPdf = $PublicPath.'/'.$fileName;
			    $response_array['response'] = 'success';
				$response_array['url']      = $downloadPdf;
				$response_array['data']     = $dataheadB;
				echo $data = json_encode($response_array);

			
		}else{}
		
		

	}


	

/* ------------- PDF GENERATE ------------ */


/*rack trans*/

 public function AddRackTrans(Request $request)
    {
    	//print_r($this->data);exit;
		$title                      ='Rake Transaction';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		/*$userdata['getacc']         = DB::table('MASTER_ACC')->get();*/

		$userdata['getacc'] = DB::table('MASTER_ACC')->select('ACC_CODE',DB::raw('replace(ACC_NAME, \'"\',"\ ") as ACC_NAME'))->WHERE('ATYPE_CODE','D')->get();

		$userdata['getconsinee'] = DB::table('MASTER_ACC')->select('ACC_CODE',DB::raw('replace(ACC_NAME, \'"\',"\ ") as ACC_NAME'))->WHERE('ATYPE_CODE','N')->get();
		
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T0'])->where(['COMP_CODE'=>$getcompcode])->get();
		
		/*$userdata['plant_list']     = DB::table('MASTER_PLANT')->get();*/

		$userdata['plant_list'] = DB::table('MASTER_PLANT')->select('PLANT_CODE',DB::raw('replace(PLANT_NAME, \'"\',"\ ") as PLANT_NAME'))->where('COMP_CODE',$getcompcode)->get();

		//$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();

		$userdata['pfct_list'] = DB::table('MASTER_PFCT')->select('PFCT_CODE',DB::raw('replace(PFCT_NAME, \'"\',"\ ") as PFCT_NAME'))->get();
	
	    $userdata['help_item_list'] = DB::table('MASTER_ITEM')->select('ITEM_CODE',DB::raw('replace(ITEM_NAME, \'"\',"\ ") as ITEMNAME'))->get();

	
		$userdata['area_list']      = DB::table('MASTER_CITY')->get();


		$userdata['do_excel_list']      = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','RAKE')->groupBy(['TRAN_CODE','EXLCONFIG_CODE'])->get();

		$userdata['columnlist']    = DB::table('MASTER_EXCELCONFIG')->where('EXLCONFIG_CODE','JR-IMP')->where('TRAN_CODE','RAKE')->get()->toArray();

    
		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();


		$userdata['company_lists']     = DB::table('MASTER_COMP')->get();
		$userdata['acctype_lists']     = DB::table('MASTER_ACCTYPE')->get();

		

		$userdata['acc_mst_list'] = DB::table('MASTER_ACC')->Orderby('ACC_CODE', 'desc')->limit(5)->get();
		/*acc master*/

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}


		$requistion = DB::table('DORDER_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();

			
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T0')->get();

   		$userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			

		if(isset($CompanyCode)){

		    return view('admin.finance.transaction.candf.rack_trans',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }




   public function importFreightSaleExcel(Request $request) 
    {
     
		$table           = 'TEMP_DO_ORDER';

		$config_table    = 'MASTER_EXCELCONFIG';

		$CompanyName     = $request->session()->get('company_name');
	
		$fisYear =  $request->session()->get('macc_year');

		$getcompcode = explode('-', $CompanyName);

		$comp_code   =$getcompcode[0];

		$do_excel_code = $request->input('do_excel_code');
		$acCcode = $request->input('account_code');

	    //print_r($acc_code);exit;
	
		$column_name = DB::table('MASTER_EXCELCONFIG')->select('EXCEL_COL','VALIDATION_STATUS','TEMPEXCEL_COL','TBL_COL')->where('TRAN_CODE','SO')->where('EXLCONFIG_CODE',$do_excel_code)->get()->toArray();

		$configTableCount = count($column_name);



		$itemcolumn = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','SO')->where('EXLCONFIG_CODE',$do_excel_code)->where('VALIDATION_STATUS',2)->get()->toArray();

		$acc_code = DB::table('MASTER_ACC')->select('ACC_CODE')->get()->toArray();
		
	//	$tempvrno        = $request->input('tempvrno');
		
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



      	//print_r($getAllExcelData);exit;

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
       		$remainingCount = 'ERROR';
       	}

       	//print_r($remainingCount);

       	$insertexcelArray=[];
       	$insertexcelArrayDt=[];
       	$insertexcelArrayDt1=[];

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

      // print_r($getAllExcelData);exit;

       	for($w=0;$w< $getAllExcelCount;$w++){
       		$n= $w+1;
       		/* -- excel col count -- */
       		for ($e = 0; $e < $excelColcount; $e++){

       			if($bankAry[$e] == 'wagon'){

       			}else{

       			unset($getAllExcelData[$n][$bankAry[$e]]);
       			}

       			
       		}
       		
       		if(isset($getAllExcelData[$n])){


       			
       		   $from_date = $getAllExcelData[$n]['Valid from'];

       		   $to_date = $getAllExcelData[$n]['To'];
       		 
			   $unix_date = ($from_date - 25569) * 86400;

			   $unix_date1 = ($to_date - 25569) * 86400;
		
       		
			   $insertexcelArrayDt[] =  gmdate("Y-m-d", $unix_date);

			
			   $insertexcelArrayDt1[] =   gmdate("Y-m-d", $unix_date1);

			
       		   $arrKey = array_search('Valid from', array_keys($getAllExcelData[$n]));
       		   $arrKey1 = array_search('To', array_keys($getAllExcelData[$n]));
       		  
       		   $insertexcelArray[]  = $getAllExcelData[$n];

       		}

     
       		

       	}

      //	exit;

       	//print_r($insertexcelArray);exit;

      $dataexcelCount =count($insertexcelArray); 

      $temptblcol =[];
		$tempExcelcol =[];
		for ($b = 0; $b < $tblcount; $b++) {

			$temptblcol[] = $tblmerger[$b]['TBL_COL'];
			$tempExcelcol[] = $tblmerger[$b]['TEMPEXCEL_COL'];

		  // print_r($tblmerger[$b]['TBL_COL']);

	    }

	    $arryCombConfigTbl = array_combine($temptblcol, $tempExcelcol);

	   // print_r($arryCombConfigTbl);exit;

	
		$ConfigCompCode      = $arryCombConfigTbl['COMP_CODE'];
		$ConfigCompName      = $arryCombConfigTbl['COMP_NAME'];
		$ConfigPlantCode     = $arryCombConfigTbl['PLANT_CODE'];
		$ConfigPlantName     = $arryCombConfigTbl['PLANT_NAME'];
		$ConfigCityCode      = $arryCombConfigTbl['CITY_CODE'];
		$ConfigCityName      = $arryCombConfigTbl['CITY_NAME'];
		$ConfigValidFromDt   = $arryCombConfigTbl['VALID_FROM_DATE'];
		$ConfigValidToDt     = $arryCombConfigTbl['VALID_TO_DATE'];
		$ConfigVehicleType     = $arryCombConfigTbl['VEHICLE_TYPE'];

       	
       for ($t = 0; $t < $dataexcelCount; $t++) {

       	$arrayIndex = array_values($insertexcelArray[$t]);
       	$arrayIndex1 = $insertexcelArrayDt[$t];
       	$arrayIndex2 = $insertexcelArrayDt1[$t];
       	
       	$arrayIndexCount = count($arrayIndex);

       	$new_array = [];
       	
       	$SRNO = 1;
			foreach ($arrayIndex as $value){

				$SRNO++;
			} 

      // 	print_r($arrayIndex);

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
       

       		$saveData =	DB::insert("INSERT INTO `TEMP_DELIVERY_ORDER` (COMP_CODE,FY_CODE,CREATED_BY,".implode(' , ', array_keys($new_array)).") VALUES ('$comp_code','$fisYear','$createdBy','".implode("' , '", array_values($new_array))."')");

       		//dd(DB::getQueryLog());

       		$lastId =	DB::getPdo()->lastInsertId();

       		$tempDoOrder = DB::table('TEMP_DELIVERY_ORDER')->where('ID',$lastId)->get()->first();


		    $tempCompCode      =   $tempDoOrder->$ConfigCompCode;
			$tempCompName      =   $tempDoOrder->$ConfigCompName;
			$tempPlantCode     =   $tempDoOrder->$ConfigPlantCode;
			$tempPlantName     =   $tempDoOrder->$ConfigPlantName;
			$tempCityCode      =   $tempDoOrder->$ConfigCityCode;
			$tempCityName      =   $tempDoOrder->$ConfigCityName;
			$tempValidFromDt   =   $tempDoOrder->$ConfigValidFromDt;
			$tempValidToDt     =   $tempDoOrder->$ConfigValidToDt;
			$tempVehicleType    =   $tempDoOrder->$ConfigVehicleType;

			//print_r($tempPlantCode);exit;


       		$getVendorCode1 = DB::table('MASTER_COMP')->select('COMP_CODE','COMP_NAME')->where('VENDOR_CODE','LIKE','%'.$tempCompCode.'%')->get()->first();

			$getVendorCode = json_decode(json_encode($getVendorCode1));

			if($getVendorCode){

				$compVendorCode = $getVendorCode->COMP_CODE;
			}else{
				$compVendorCode = '';
			}

			
			$getFromPlace1 = DB::table('MASTER_PLANT')->select('CITY_NAME')->where('PLANT_CODE',''.$tempPlantCode.'')->get()->first();

			$getFromPlace = json_decode(json_encode($getFromPlace1));

			if($getFromPlace){
				$FromPlace = $getFromPlace->CITY_NAME;
			}else{
				$FromPlace ='';
			}


       	$getData = DB::table('FSO_BODY')->where('COMP_CODE',$compVendorCode)->where('ACC_CODE',$acCcode)->where('PLANT_CODE',$tempPlantCode)->where('FROM_PLACE',$FromPlace)->where('TO_PLACE',$tempCityName)->where('VEHICLE_TYPE',$tempVehicleType)->where('VALID_FROM_DATE',$tempValidFromDt)->get()->toArray();

       //	print_r($getData);exit;

       		
       	if(empty($getData)){

       			$firstdo = array(

       				'DO_EXIST_STATUS' => 'NO',
       				'DO_UPDATE_STATUS' => 0,
       			);

   				DB::table('TEMP_DELIVERY_ORDER')->where($ConfigCompCode,$tempCompCode)->where($ConfigPlantCode,$tempPlantCode)->where($ConfigCityName,$tempCityName)->where($ConfigValidFromDt,$tempValidFromDt)->where($ConfigVehicleType,$tempVehicleType)->where('COMP_CODE',$comp_code)->where('CREATED_BY',$createdBy)->update($firstdo);


       		}else{

       			$existdata = array(

	       				'DO_EXIST_STATUS' => 'EXIST',
	       				'DO_UPDATE_STATUS' => 0,

	       			);

	   			DB::table('TEMP_DELIVERY_ORDER')->where($ConfigCompCode,$tempCompCode)->where($ConfigPlantCode,$tempPlantCode)->where($ConfigCityName,$tempCityName)->where($ConfigValidFromDt,$tempValidFromDt)->where($ConfigVehicleType,$tempVehicleType)->where('COMP_CODE',$comp_code)->where('CREATED_BY',$createdBy)->update($existdata);

       		}

       	
       	
       }

      //exit;

        $NewData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='NO' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");
  
  		$new_data_count = count($NewData);
     
       	if($saveData) {

    			$response_array['response'] = 'success';
    			$response_array['new_data_count'] = $new_data_count;
    		
	            echo $data = json_encode($response_array);
	         
			}else{

				$response_array['response'] = 'error';
				$response_array['new_data_count'] = '';

            $data = json_encode($response_array);
            print_r($data);
				
			}

		}else{

			$response_array['response'] = 'error_data';
			$response_array['data_error'] = 'data not avilable';
         echo  $data = json_encode($response_array);
        
		}



       	
    }

    public function importRackExcel(Request $request) 
    {
     
		$table           = 'TEMP_DO_ORDER';

		$config_table    = 'MASTER_EXCELCONFIG';

		$CompanyName     = $request->session()->get('company_name');
	
		$fisYear =  $request->session()->get('macc_year');

		$getcompcode = explode('-', $CompanyName);

		$comp_code   =$getcompcode[0];

		$do_excel_code = $request->input('do_excel_code');

	
		$column_name = DB::table('MASTER_EXCELCONFIG')->select('EXCEL_COL','VALIDATION_STATUS','TEMPEXCEL_COL','TBL_COL')->where('TRAN_CODE','RAKE')->where('EXLCONFIG_CODE',$do_excel_code)->get()->toArray();

		$configTableCount = count($column_name);

		//print_r($configTableCount);exit;


		$itemcolumn = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','RAKE')->where('EXLCONFIG_CODE',$do_excel_code)->where('VALIDATION_STATUS',2)->get()->toArray();

		$acc_code = DB::table('MASTER_ACC')->select('ACC_CODE')->get()->toArray();
		
	//	$tempvrno        = $request->input('tempvrno');
		
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



      	//print_r($getAllExcelData);exit;

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
       		$remainingCount = 'ERROR';
       	}

       	//print_r($remainingCount);

       	$insertexcelArray=[];
       	$insertexcelArrayDt=[];
       	$insertexcelArrayDt1=[];

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

      // print_r($getAllExcelData);exit;

       	for($w=0;$w< $getAllExcelCount;$w++){
       		$n= $w+1;
       		/* -- excel col count -- */
       		for ($e = 0; $e < $excelColcount; $e++){

       			if($bankAry[$e] == 'wagon'){

       			}else{

       			unset($getAllExcelData[$n][$bankAry[$e]]);
       			}

       			
       		}
       		
       		if(isset($getAllExcelData[$n])){


       			
       		   $bill_date = $getAllExcelData[$n]['Bill Date']; 
       		   $eway_bill_date = $getAllExcelData[$n]['Ewaybill exp. Dt.'];
       		   $alloc_qty = $getAllExcelData[$n]['Net Qty.']; 

			  /* $unix_date = ($bill_date - 25569) * 86400;
			   $bill_date = 25569 + ($unix_date / 86400);
			   $unix_date = ($bill_date - 25569) * 86400;*/

			   //print_r($bill_date);

			   $unix_date = ($bill_date - 25569) * 86400;

			   $unix_date1 = ($eway_bill_date - 25569) * 86400;
		
       		
			   $insertexcelArrayDt[] =  gmdate("Y-m-d", $unix_date);

			
			   $insertexcelArrayDt1[] =   gmdate("Y-m-d", $unix_date1);

			   

       		   $allocation_qty =  number_format((float)$alloc_qty, 3, '.', '');

       		   $insertexcelArrayDt2[] = $allocation_qty;


       		   $arrKey = array_search('Bill Date', array_keys($getAllExcelData[$n]));
       		   $arrKey1 = array_search('Ewaybill exp. Dt.', array_keys($getAllExcelData[$n]));
       		   $arrKey2 = array_search('Net Qty.', array_keys($getAllExcelData[$n]));
       		 
       		   $insertexcelArray[]  = $getAllExcelData[$n];

       		}

     
       		

       	}

      //	exit;

       	//print_r($insertexcelArray);exit;

      $dataexcelCount =count($insertexcelArray); 

      $temptblcol =[];
		$tempExcelcol =[];
		for ($b = 0; $b < $tblcount; $b++) {

			$temptblcol[] = $tblmerger[$b]['TBL_COL'];
			$tempExcelcol[] = $tblmerger[$b]['TEMPEXCEL_COL'];

		  // print_r($tblmerger[$b]['TBL_COL']);

	    }

	    $arryCombConfigTbl = array_combine($temptblcol, $tempExcelcol);

	   
	  // print_r($arryCombConfigTbl);exit;

		$ConfigItem        = $arryCombConfigTbl['ITEM_NAME'];
		//$ConfigItemName    = $arryCombConfigTbl['REMARK'];
		$ConfigCpName      = $arryCombConfigTbl['CP_NAME'];
		$ConfigSpName      = $arryCombConfigTbl['SP_NAME'];
		$ConfigToPlace     = $arryCombConfigTbl['TO_PLACE'];
		$ConfigOrderNo     = $arryCombConfigTbl['ORDER_NO'];
		$ConfigObdNo       = $arryCombConfigTbl['OBD_NO'];
		$ConfigQty         = $arryCombConfigTbl['QTY'];
		$ConfigBatchNo     = $arryCombConfigTbl['BATCH_NO'];

       	
       for ($t = 0; $t < $dataexcelCount; $t++) {

       	$arrayIndex = array_values($insertexcelArray[$t]);
       	$arrayIndex1 = $insertexcelArrayDt[$t];
       	$arrayIndex2 = $insertexcelArrayDt1[$t];
       	$arrayIndex3 = $insertexcelArrayDt2[$t];

       	$arrayIndexCount = count($arrayIndex);

       	$new_array = [];
       	
       	$SRNO = 1;
			foreach ($arrayIndex as $value){

				$SRNO++;
			} 

      // 	print_r($arrayIndex);

       		for ($p = 0; $p < $arrayIndexCount; $p++) {

       			$q = $p +1;

       			if($p==$arrKey){
       				$new_array['COL'.$q] = $arrayIndex1;

       			}else if($p==$arrKey1){
       				$new_array['COL'.$q] = $arrayIndex2;

       			}else if($p==$arrKey2){
       				$new_array['COL'.$q] = $arrayIndex3;

       			}else{

       				$new_array['COL'.$q] = $arrayIndex[$p];
       			}
       			
       			
       		}
       

       		$saveData =	DB::insert("INSERT INTO `TEMP_DELIVERY_ORDER` (COMP_CODE,FY_CODE,CREATED_BY,".implode(' , ', array_keys($new_array)).") VALUES ('$comp_code','$fisYear','$createdBy','".implode("' , '", array_values($new_array))."')");

       		//dd(DB::getQueryLog());

       		$lastId =	DB::getPdo()->lastInsertId();

       		$tempDoOrder = DB::table('TEMP_DELIVERY_ORDER')->where('ID',$lastId)->get()->first();

       		$tempItemName = $tempDoOrder->$ConfigItem;

       		//$tempItemName = $tempDoOrder->$ConfigItemName; 

       		$tempCpName =  $tempDoOrder->$ConfigCpName;

       		$tempSpName =  $tempDoOrder->$ConfigSpName;

       		$tempToPlace =  $tempDoOrder->$ConfigToPlace;

       		$tempOrderNo =  $tempDoOrder->$ConfigOrderNo;

       		$tempQty   =  $tempDoOrder->$ConfigQty;

       		$tempBatchNo   =  $tempDoOrder->$ConfigBatchNo;

       		$tempObdNo   =  $tempDoOrder->$ConfigObdNo;

       		//DB::enableQueryLog();

       		//echo '<pre>';




       		/*$explodName  =explode(' ',$tempItemName);


       		$firstName = strlen($explodName[0]);

       			if($firstName > 2){

       				$itemAliasName = $explodName[0].' '.$explodName[1];

       			}else{

       				$itemAliasName = $explodName[0];

       			}*/

       			$itemAliasName =  $tempItemName;

       		/*$item_code = DB::table('MASTER_ITEM')->where('ITEMTYPE_CODE','TP')->where('ITEM_NAME', 'LIKE', '%'.$itemAliasName.'%')->get()->toArray();*/

       		$item_code = DB::select("SELECT ITEM_CODE,ITEM_NAME FROM MASTER_ITEM WHERE ITEM_NAME LIKE CONCAT('%',SUBSTRING_INDEX('$itemAliasName',' ',IF(LENGTH(SUBSTRING_INDEX('$itemAliasName',' ',1))<=2,2,1)),'%') AND ITEMTYPE_CODE = 'TP'");


       		if($item_code){

       			foreach($item_code as $key){

       					$dataItem = array(

       						$ConfigItem => $itemAliasName.'~'.$key->ITEM_NAME.'~'.$key->ITEM_CODE,
       					);

       			$update2 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigItem,$tempItemName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataItem);

       			}

       		}else{

       			$dataitem = array(

       				'ITEM_STATUS' => 'YES',
       				'NOT_FOUND_STATUS' => 'NOT FOUND',

       			);

       		  $update1 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigItem,$tempItemName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataitem);
       		  
       		}


       		$acc_name = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->where('ACC_NAME',$tempCpName)->orWhere('ALIAS_NAME', 'LIKE', '%'.$tempCpName.'%')->get()->toArray();

       		/* $TempData= DB::select("SELECT * FROM MASTER_ACC WHERE (ACC_NAME='$tempCpName' AND ATYPE_CODE='N')  OR (ALIAS_NAME LIKE '%$tempCpName%')");*/


       		if($acc_name){

       			foreach($acc_name as $key){

       					$dataAcc = array(

       						$ConfigCpName => $key->ACC_NAME.'~'.$key->ACC_CODE
       					);

       			$update2 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigCpName,$tempCpName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataAcc);

       			}

       		}else{

       			$dataAcc = array(

       				'ACC_STATUS' => 'YES',
       				'NOT_FOUND_STATUS' => 'NOT FOUND',

       			);

       		  $update3 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigCpName,$tempCpName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataAcc);

       		}

       		//DB::enableQueryLog();

       		$sp_name = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->where('ACC_NAME',$tempSpName)->orWhere('ALIAS_NAME', 'LIKE', '%'.$tempSpName.'%')->get()->toArray();


           // dd(DB::getQueryLog());


       		if($sp_name){

       			foreach($sp_name as $key){

       				$city_name = DB::table('MASTER_ACCADD')->where('ACC_CODE',$key->ACC_CODE)->where('CITY_NAME','LIKE', '%'.$tempToPlace.'%')->get()->toArray();
       			     if($city_name){
       			     	
       			     }else{

       			     	$dataCityName = array(

       			     		'CITY_STATUS'=>'YES',
       			     	);

       			     
       			       DB::table('TEMP_DELIVERY_ORDER')->where($ConfigSpName,$tempSpName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataCityName);

       			     }

       					$dataSp = array(

       						$ConfigSpName => $key->ACC_NAME.'~'.$key->ACC_CODE
       					);

       			$update2 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigSpName,$tempSpName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataSp);

       			}

       		}else{

       			$dataAcc = array(

       				'SP_STATUS' => 'YES',
       				'NOT_FOUND_STATUS' => 'NOT FOUND',

       			);

       		  $update3 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigSpName,$tempSpName)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($dataAcc);

       		}

       		
       		/*
       		$do_number = DB::table('RAKE_TRAN')->where('ORDER_NO',$tempOrderNo)->where('BATCH_NO',$tempBatchNo)->where('DELIVERY_NO',$tempObdNo)->where('QTY',$tempQty)->get()->toArray();


       		if($do_number){


       			$datado = array(

       				'DO_EXIST_STATUS' => 'YES',

       			);

       		  $update3 =	DB::table('TEMP_DELIVERY_ORDER')->where($ConfigOrderNo,$tempOrderNo)->where($ConfigBatchNo,$tempBatchNo)->where($ConfigObdNo,$tempObdNo)->where($ConfigQty,$tempQty)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->update($datado);

       		}else{

       		}*/



       		$do_number = DB::table('RAKE_TRAN')->where('ORDER_NO',$tempOrderNo)->where('BATCH_NO',$tempBatchNo)->where('DELIVERY_NO',$tempObdNo)->where('COMP_CODE',$comp_code)->get()->toArray();


       		
       		if(empty($do_number)){

       			$firstdo = array(

       				'DO_EXIST_STATUS' => 'NO',
       				'DO_UPDATE_STATUS' => 0,
       			);

   				DB::table('TEMP_DELIVERY_ORDER')->where($ConfigOrderNo,$tempOrderNo)->where($ConfigQty,$tempQty)->where($ConfigBatchNo,$tempBatchNo)->where($ConfigObdNo,$tempObdNo)->where('COMP_CODE',$comp_code)->where('CREATED_BY',$createdBy)->update($firstdo);


       		}else{

       			//print_r('NOT EXIST');


       			$chkExist = DB::table('RAKE_TRAN')->where('ORDER_NO',$tempOrderNo)->where('QTY',$tempQty)->where('BATCH_NO',$tempBatchNo)->where('DELIVERY_NO',$tempObdNo)->where('COMP_CODE',$comp_code)->get()->toArray();

       			if($chkExist){

       				$existdo = array(

	       				'DO_EXIST_STATUS' => 'EXIST',
	       				'DO_UPDATE_STATUS' => 0,

	       			);

	   				DB::table('TEMP_DELIVERY_ORDER')->where($ConfigOrderNo,$tempOrderNo)->where($ConfigBatchNo,$tempBatchNo)->where($ConfigObdNo,$tempObdNo)->where('COMP_CODE',$comp_code)->update($existdo);
       			}else{

       				$existNOTdo = array(

	       				'DO_EXIST_STATUS' => 'YES',
	       				'DO_UPDATE_STATUS' => 1,

	       			);

       			
	   				DB::table('TEMP_DELIVERY_ORDER')->where($ConfigOrderNo,$tempOrderNo)->where($ConfigQty,$tempQty)->where($ConfigBatchNo,$tempBatchNo)->where($ConfigObdNo,$tempObdNo)->where('COMP_CODE',$comp_code)->where('CREATED_BY',$createdBy)->update($existNOTdo);

       			}


       		}
       	
       }

      //exit;
  
     /*  $TempData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE  ( COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy')  AND (ITEM_STATUS ='YES' OR  ACC_STATUS='YES' OR SP_STATUS ='YES') ");

       $TempDoData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='NO' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

      



       $temp_data_count = count($TempData);

       $temp_do_count = count($TempDoData);
*/

       


       $NewData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='NO' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

       $AllocQtyData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

       $itemaccData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE  ( COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy')  AND ((ITEM_STATUS ='YES' AND DO_EXIST_STATUS ='NO') OR  (ACC_STATUS='YES' AND DO_EXIST_STATUS ='NO') OR (SP_STATUS='YES' AND DO_EXIST_STATUS ='NO'))");


        $CPDoData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE ACC_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

       $SPDoData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE SP_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

       $CityDoData = DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE CITY_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

       $cp_do_count = count($CPDoData);

       $sp_do_count = count($SPDoData);

       $city_do_count = count($CityDoData);

       $new_data_count = count($NewData);

       $itemacc_count = count($itemaccData);

       $allocqty_count = count($AllocQtyData);

       	if($saveData) {

    			$response_array['response'] = 'success';
    			$response_array['new_data_count'] = $new_data_count;
    			$response_array['itemacc_count'] = $itemacc_count;
    			$response_array['allocqty_count'] = $allocqty_count;
    			$response_array['cp_do_count'] = $cp_do_count;
    			$response_array['sp_do_count'] = $sp_do_count;
    			$response_array['city_do_count'] = $city_do_count;
	            echo $data = json_encode($response_array);
	         
			}else{

				$response_array['response'] = 'error';
				$response_array['new_data_count'] = '';
	    	    $response_array['itemacc_count'] = '';
	    		$response_array['allocqty_count'] = '';
	    		$response_array['cp_do_count'] ='';
	    		$response_array['sp_do_count'] = '';
	    		$response_array['city_do_count'] = '';

	            $data = json_encode($response_array);
            print_r($data);
				
			}

		}else{

			$response_array['response'] = 'error_data';
			$response_array['new_data_count'] = '';
    	    $response_array['itemacc_count'] = '';
    		$response_array['allocqty_count'] = '';
    		$response_array['cp_do_count'] ='';
    		$response_array['sp_do_count'] = '';
    		$response_array['city_do_count'] = '';
			$response_array['data_error'] = 'data not avilable';
         echo  $data = json_encode($response_array);
        
		}



       	
    }


    public function ViewFreightOrderDetails1(Request $request)
    {
    		//$compName = $request->session()->get('company_name');
 
    	    //print_r('hi');exit;

    	   if($request->ajax()) {

			$title       ='View Freight Sale Order Details';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');

			$tempvrno        = $request->input('tempvrno');
		
		    $temptransporter = $request->input('temptransporter');

		   // print_r($tempvrno);exit;


	        $data = DB::table('TEMP_DELIVERY_ORDER')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('CREATED_BY',$userid)->get()->toArray();

	      //  print_r($data);exit;
            

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();
	    }
	    
	    if(isset($compName)){

	       return view('admin.finance.transaction.logistic.freight_sale_order');
	    }else{
			return redirect('/useractivity');
		}
    }


    public function ViewFreightOrderDetails(Request $request)
    {
    		//$compName = $request->session()->get('company_name');
 
    	    //print_r('hi');exit;

    	   if($request->ajax()) {

			$title       ='View Freight Sale Order Details';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');

			$tempvrno        = $request->input('tempvrno');
		
		    $temptransporter = $request->input('temptransporter');

		   // print_r($tempvrno);exit;


	        $data = DB::table('TEMP_DELIVERY_ORDER')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('CREATED_BY',$userid)->get()->toArray();

	      //  print_r($data);exit;
            

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();
	    }
	    
	    if(isset($compName)){

	       return view('admin.finance.transaction.logistic.freight_sale_order');
	    }else{
			return redirect('/useractivity');
		}
    }


     public function ViewEprocDetails(Request $request)
    {
    		//$compName = $request->session()->get('company_name');
 
    	    //print_r('hi');exit;

    	   if($request->ajax()) {

			$title       ='View Freight Sale Order Details';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');

			$tempvrno        = $request->input('tempvrno');
		
		    $temptransporter = $request->input('temptransporter');

		   // print_r($tempvrno);exit;


	        $data = DB::table('EPROC_UPLOAD_EXCEL')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('CREATED_BY',$userid)->get()->toArray();

	      //  print_r($data);exit;
            

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();
	    }
	    
	    if(isset($compName)){

	       return view('admin.finance.transaction.logistic.freight_sale_order');
	    }else{
			return redirect('/useractivity');
		}
    }



    public function ViewRakeOrderDetails(Request $request)
    {
    		//$compName = $request->session()->get('company_name');
 
    	    //print_r('hi');exit;

    	   if($request->ajax()) {

			$title       ='View Rake Order Details';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');

			$tempvrno        = $request->input('tempvrno');
		
		    $temptransporter = $request->input('temptransporter');

		   // print_r($tempvrno);exit;


	        $data = DB::table('TEMP_DELIVERY_ORDER')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('CREATED_BY',$userid)->get()->toArray();
            

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();
	    }
	    
	    if(isset($compName)){

	       return view('admin.finance.transaction.candf.rack_trans');
	    }else{
			return redirect('/useractivity');
		}
    }



     public function SaveRackTrans(Request $request)
    {

    	/*echo '<pre>';
    	print_r($request->post());exit;*/
    
    	//
			$createdBy        = $request->session()->get('userid');
			$CompanyCode      = $request->session()->get('company_name');
			$compcode         = explode('-', $CompanyCode);
			$getcompcode      =	$compcode[0];
			$getcompname      =	$compcode[1];
			$fisYear          =  $request->session()->get('macc_year');
			$db_name          =  $request->session()->get('dbName');
			$pfct_code        = $request->input('pfct_code');
			$trans_code       = $request->input('trans_code');
			$series_code      = $request->input('series_code');
			$series_name      = $request->input('series_name');
			$plant_name       = $request->input('plant_name');
			$pfct_name        = $request->input('pfct_name');
			$trans_date       = $request->input('trans_date');
			$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
			$getduedate       = $request->input('getdue_date');
			$dueDate          = date("Y-m-d", strtotime($getduedate));
			$plant_code       = $request->input('plant_code');
			$acc_code         = $request->input('accCode');
			$acc_name         = $request->input('accName');
			$rakeNo           = $request->input('rakeNo');
			$rakeDate         = $request->input('rakeDate');
			$tr_rakeDate      = date("Y-m-d", strtotime($rakeDate));
			$placeDate        = $request->input('placeDate');
			$tr_placeDate     = date("Y-m-d", strtotime($placeDate));
			$excelCode        = $request->input('excelCode');
			$excelName        = $request->input('excelName');
			$fromplace        = $request->input('fromplace');
			$importExcel      = $request->input('importExcel');
			//$count            = count($itemCode);

				
		if($importExcel != ''){


			$getDoBodyCoulmName= DB::select("SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA='$db_name' AND table_name='RAKE_TRAN'");

			
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


			$column_name = DB::table('MASTER_EXCELCONFIG')->select('TBL_COL','TEMPEXCEL_COL')->where('TRAN_CODE','RAKE')->where('EXLCONFIG_CODE',$excelCode)->get()->toArray();

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
	    $cp_add_excel = [];
	    $sp_name_excel = [];
	    $obd_no_excel = [];
	    $sl_no_excel = [];
	    $do_invc_excel = [];
	    $do_invc_dt_excel = [];
	    $do_order_no = [];
	    $do_wagon_no = [];
	    $item_code_excel = [];
	    $item_name_excel = [];
	    $icateg_excel = [];
	    $batch_no = [];
	    $remark_excel = [];
	    $qty_excel = [];
	    $um_excel = [];
	    $aqty_excel = [];
	    $aum_excel = [];
	    $do_date_excel = [];
	    $eway_bill_no_excel = [];
	    $eway_bill_dt_excel = [];
	    $from_place_excel = [];
	    $to_place_excel = [];
	    $height_excel =[];
        $width_excel=[];
        $length_excel=[];
        $cfactor_excel=[];
        $aqty_excel=[];
        $grossqty_excel=[];
	   
	  
	 // print_r($arryCombConfigTbl);exit;

	   if($arryCombConfigTbl){

	    for($w=0;$w< $tempDoOrderCount; $w++){
       		$n= $w+1;
       		/* -- excel col count -- */
       		for ($e = 0; $e < $tempColmnCount; $e++){


       			

			if(isset($arryCombConfigTbl['CP_NAME'])){

       			if($arryCombConfigTbl['CP_NAME'] == $tempExcelcol[$e]){

       				$CP_NAME = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($cp_name_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$CP_NAME ='';
				}
			}

			if(isset($arryCombConfigTbl['CP_ADD'])){

       			if($arryCombConfigTbl['CP_ADD'] == $tempExcelcol[$e]){

       				$CP_ADD = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($cp_add_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$CP_ADD ='';
				}
			}


			if(isset($arryCombConfigTbl['SP_NAME'])){

       			if($arryCombConfigTbl['SP_NAME'] == $tempExcelcol[$e]){

       				$SP_NAME = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($sp_name_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$SP_NAME ='';
				}
			}

       			
       			if(isset($arryCombConfigTbl['OBD_NO'])){

       			if($arryCombConfigTbl['OBD_NO'] == $tempExcelcol[$e]){

       				$OBD_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($obd_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$OBD_NO ='';
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


			if(isset($arryCombConfigTbl['INVOICE_NO'])){

       			if($arryCombConfigTbl['INVOICE_NO'] == $tempExcelcol[$e]){

       				$INVOICE_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($do_invc_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$INVOICE_NO ='';
				}
			}

			if(isset($arryCombConfigTbl['INVOICE_DATE'])){

       			if($arryCombConfigTbl['INVOICE_DATE'] == $tempExcelcol[$e]){

       				$INVOICE_DATE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($do_invc_dt_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$INVOICE_DATE ='';
				}
			}


			if(isset($arryCombConfigTbl['ORDER_NO'])){

       			if($arryCombConfigTbl['ORDER_NO'] == $tempExcelcol[$e]){

       				$ORDER_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($do_order_no,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$ORDER_NO ='';
				}
			}

			if(isset($arryCombConfigTbl['WAGON_NO'])){

       			if($arryCombConfigTbl['WAGON_NO'] == $tempExcelcol[$e]){

       				$WAGON_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($do_wagon_no,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 
			     	$WAGON_NO ='';
				}
			}

			if(isset($arryCombConfigTbl['EWAY_BILL_NO'])){

				if($arryCombConfigTbl['EWAY_BILL_NO'] == $tempExcelcol[$e]){


				$EWAY_BILL_NO = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

				array_push($eway_bill_no_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				
				}else{
					$EWAY_BILL_NO ='';
				}

			}

			if(isset($arryCombConfigTbl['EWAY_BILL_DT'])){

				if($arryCombConfigTbl['EWAY_BILL_DT'] == $tempExcelcol[$e]){


				$EWAY_BILL_DT = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

				array_push($eway_bill_dt_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				
				}else{
					$EWAY_BILL_DT ='';
				}

			}

			

			if(isset($arryCombConfigTbl['HEIGHT'])){

				if($arryCombConfigTbl['HEIGHT'] == $tempExcelcol[$e]){


				$HEIGHT = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

				array_push($height_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				
				}else{
					$HEIGHT ='';
				}

			}

			if(isset($arryCombConfigTbl['WIDTH'])){

				if($arryCombConfigTbl['WIDTH'] == $tempExcelcol[$e]){


				$WIDTH = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

				array_push($width_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				
				}else{
					$WIDTH ='';
				}

			}


			if(isset($arryCombConfigTbl['LENGTH'])){

				if($arryCombConfigTbl['LENGTH'] == $tempExcelcol[$e]){


				$WIDTH = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

				array_push($length_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				
				}else{
					$WIDTH ='';
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


			if(isset($arryCombConfigTbl['ICATG_CODE'])){

				if($arryCombConfigTbl['ICATG_CODE'] == $tempExcelcol[$e]){


				$ICATG_CODE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

				array_push($icateg_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				
				}else{
					$ICATG_CODE ='';
				}

			}

			if(isset($arryCombConfigTbl['REMARK'])){

				if($arryCombConfigTbl['REMARK'] == $tempExcelcol[$e]){


				$REMARK = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

				array_push($remark_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				
				}else{
					$REMARK ='';
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

			if(isset($arryCombConfigTbl['AQTY'])){

				if($arryCombConfigTbl['AQTY'] == $tempExcelcol[$e]){


					$AQTY = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($aqty_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$AQTY='';
				}
			}

			if(isset($arryCombConfigTbl['GROSS_QTY'])){

				if($arryCombConfigTbl['GROSS_QTY'] == $tempExcelcol[$e]){


					$GROSSQTY = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					array_push($grossqty_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

				}else{
					$GROSSQTY='';
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

			 
			

				if(isset($arryCombConfigTbl['FROM_PLACE'])){

				 if($arryCombConfigTbl['FROM_PLACE'] == $tempExcelcol[$e]){

				 	    $FROM_PLACE = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($from_place_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 

			     	   $FROM_PLACE='';
						
				}

				}

				if(isset($arryCombConfigTbl['CFACTOR'])){

				 if($arryCombConfigTbl['CFACTOR'] == $tempExcelcol[$e]){

				 	    $CFACTOR = $ColumntempDoOrder[$w][$tempExcelcol[$e]];

					    array_push($cfactor_excel,$ColumntempDoOrder[$w][$tempExcelcol[$e]]);

			     }else{ 

			     	   $CFACTOR='';
						
				}

				}

	       		if(isset($ColumntempDoOrder[$w])){

       			$insertexcelArray[] = $ColumntempDoOrder[$w];


       			}
	       		
	       	}
       		
       	}

      //	print_r($insertexcelArray);exit;

		
		 for($j = 0; $j < $tempDoOrderCount; $j++) {


		 	$StoreB = DB::select("SELECT MAX(RAKEID) as RAKEID FROM RAKE_TRAN");

			$bodyID = json_decode(json_encode($StoreB), true); 

			if(empty($bodyID[0]['RAKEID'])){
			$rackId = 1;
			}else{
			$rackId = $bodyID[0]['RAKEID']+1;
			}


				//$aqty = floatval($qty_excel[$j]) * floatval($cfactor_excel[$j]);

				//$cafactor = floatval($qty_excel[$j]) / floatval($cfactor_excel[$j]);


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

							$explode_spname = explode("~",$sp_name_excel[$j]);

				           if(isset($explode_spname[0])){
								$spName = $explode_spname[0];
							}else{
								$spName = '';
							}

							if(isset($explode_spname[1])){
								$spCode = $explode_spname[1];
							}else{
								$spCode ='';
							}


							$explode_item_name = explode("~",$item_name_excel[$j]);


							if(isset($explode_item_name[0])){
								$aliseName = $explode_item_name[0];
							}else{
								$aliseName = '';
							}

				           if(isset($explode_item_name[1])){
								$itemName = $explode_item_name[1];
							}else{
								$itemName = '';
							}

							if(isset($explode_item_name[2])){
								$itemCode = $explode_item_name[2];
							}else{
								$itemCode ='';
							}


				//dd(DB::getQueryLog());

						//print_r($explode_item_name);exit;

                  // DB::enableQueryLog();

				

			$itemUM = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->orwhere('ITEM_NAME',$itemName)->get()->first();
				
				//dd(DB::getQueryLog());

			if($itemUM){

				$umCode = $itemUM->UM;
				$aumCode =$itemUM->AUM;
			}else{

				$umCode = '';
				$aumCode ='';
			}
			//print_r($itemUM->UM);

		  	$data_import = array(


				  		'RAKEID'         =>$rackId,
				  		'RAKE_NO'        =>$rakeNo,
						'RAKE_DATE'      =>$tr_rakeDate,
						'PLACE_DATE'     =>$tr_placeDate,
						'FROM_PLACE'     =>$fromplace,
						'COMP_CODE'      =>$getcompcode,
						'COMP_NAME'      =>$getcompname,
						'PFCT_CODE'      =>$pfct_code,
						'PFCT_NAME'      =>$pfct_name,
						'PLANT_CODE'     =>$plant_code,
						'PLANT_NAME'     =>$plant_name,
						'ACC_CODE'       =>$acc_code,
						'ACC_NAME'       =>$acc_name,
						'SP_CODE'        =>$spCode,
						'SP_NAME'        =>$spName,
						'INVOICE_NO'     =>$do_invc_excel[$j],
						'INVOICE_DATE'   =>$do_invc_dt_excel[$j],
						'WAGON_NO'       =>$do_wagon_no[$j],
						'DELIVERY_NO'    =>$obd_no_excel[$j],
						'ORDER_NO'       =>$do_order_no[$j],
						'EWAY_BILL_NO'   =>$eway_bill_no_excel[$j],
						'EWAY_BILL_DT'   =>$eway_bill_dt_excel[$j],
						'BATCH_NO'       =>$batch_no[$j],
						'ALIAS_CODE'     =>$item_code_excel[$j],
						'ALIAS_NAME'     =>$aliseName,
						'ITEM_CODE'      =>$itemCode,
						'ITEM_NAME'      =>$itemName,
						'REMARK'         =>$remark_excel[$j],
						'SLNO'           =>$j+1,
						'ICATG_CODE'     =>$icateg_excel[$j],
						'CP_CODE'        =>$consinee_code,
						'CP_NAME'        =>$consinee_name,
						'CP_ADD'         =>$cp_add_excel[$j],
						'TO_PLACE'       =>$to_place_excel[$j],
						'HEIGHT'         =>$height_excel[$j],
						'WIDTH'          =>$width_excel[$j],
						'LENGTH'         =>$length_excel[$j],
						'QTY'            =>$qty_excel[$j],
						'CFACTOR'        =>$cfactor_excel[$j],
						'AQTY'           =>$aqty_excel[$j],
						'UM'             =>$umCode,
						'AUM'            =>$aumCode,
						'QTYRECD'        =>0.00,
						'GROSS_QTY'      =>$grossqty_excel[$j],
						"CREATED_BY"     =>$createdBy,

						
				);

		  	$saveData1 = DB::table('RAKE_TRAN')->insert($data_import);

		  
		 }
		// exit;

		// $saveData1 ='';
		 if($saveData1){

			$response_array['response'] = 'success';
			
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



  public function ViewRackTrans(Request $request){

	//print_r('hi');exit;
		if ($request->ajax()) {

			$title = 'View Rake Transaction';

			$user_type = $request->session()->get('user_type');

			$userid = $request->session()->get('userid');

			$company   = $request->session()->get('company_name');
			$splicode = explode('-', $company);
			$compName = $splicode[0];
			$fisYear   = $request->session()->get('macc_year');

			

			$data = DB::table('RAKE_TRAN')->where('COMP_CODE',$compName)->orderBy('RAKEID','DESC');

			
			
			return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

		}

		return view('admin.finance.transaction.candf.view_rake_trans');
		/*return DataTables::queryBuilder($data)->toJson();*/
		//print_r($data);exit;
	}



 /*rake order qty */

    public function getDeliveryOrderQtyRake(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$batch_No   = $request->input('batch_No');
	    	$order_no   = $request->input('order_no');
		 

	    	$delivery_qty = DB::table('RAKE_TRAN')->where('ORDER_NO', $order_no)->where('BATCH_NO', $batch_No)->get()->first();

	    	//$trip_body_qty = DB::table('TRIP_BODY')->where('DO_NO', $do_no)->get()->first();
	    	
	    	//print_r($trip_body_qty);exit;

    		if($delivery_qty) {

    			$response_array['response'] = 'success';
	            $response_array['data_do_qty'] = $delivery_qty;
	          
	         	

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
    

    public function UpdateDeliveryRakeOrderQty(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$allc_qty   = $request->input('allc_qty');
	    	$order_no   = $request->input('order_no');
	    	$batch_No   = $request->input('batch_No');


	    	$tableId  = $request->input('temptableidDo');
            $tblcol   = $request->input('tblcoldo');
            $umfactor   = $request->input('umfactor');

            $createdBy    = $request->session()->get('userid');
            $company   = $request->session()->get('company_name');
			$splicode = explode('-', $company);
			$comp_code = $splicode[0];
			$fisYear   = $request->session()->get('macc_year');
                
            if($tableId && $tblcol){

                $data = array(

                     'DO_EXIST_STATUS' => 'EXIST',
                     'DO_UPDATE_STATUS' => 1,
                    
                );

               $update  = DB::table('TEMP_DELIVERY_ORDER')->where('ID', $tableId)->where($tblcol, $order_no)->update($data);

            }

            if($order_no){

            	$aqty = floatval($umfactor) * floatval($allc_qty);

                $data = array(

                    'QTY' => $allc_qty,
                    'AQTY' =>$aqty,
                    
                );

               $update1  = DB::table('RAKE_TRAN')->where('ORDER_NO', $order_no)->where('BATCH_NO', $batch_No)->update($data);

            }
		 


           $NewData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='NO' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

	       $AllocQtyData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='YES' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");

	       $itemaccData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE  ( COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy')  AND ((ITEM_STATUS ='YES' AND DO_EXIST_STATUS ='NO') OR  (ACC_STATUS='YES' AND DO_EXIST_STATUS ='NO') OR (SP_STATUS='YES' AND DO_EXIST_STATUS ='NO'))");


			   $new_data_count = count($NewData);

		       $itemacc_count = count($itemaccData);

		       $allocqty_count = count($AllocQtyData);


			
	  

    		if($update || $update1) {

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



    public function outward_dispatch_msg(Request $request,$saveData){

		if ($saveData==true) {

			$request->session()->flash('alert-success', 'Outward Dispatch Was Successfully Added...!');
			return redirect('/transaction/CandF/view-outward-trans');

		} else {

			$request->session()->flash('alert-error', 'Outward Dispatch Can Not Added...!');
			return redirect('/transaction/CandF/view-outward-trans');

		}
	}

	public function rack_trans_msg(Request $request,$saveData){

		if ($saveData==true) {

			$request->session()->flash('alert-success', 'Rake Transaction Was Successfully Added...!');
			return redirect('/Transaction/Logistic/View-Rack-Trans');

		}else{

			$request->session()->flash('alert-error', 'Rake Transaction Can Not Added...!');
			return redirect('/Transaction/Logistic/View-Rack-Trans');

		}
	}


	public function PlantForVehicleNo(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$Plant_code = $request->input('Plant_code');
	    	$to_place = $request->input('to_place');

	    	$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];


	   		$pfct_list = DB::table('MASTER_PLANT')
				->select('MASTER_PLANT.*', 'MASTER_PFCT.*','MASTER_PLANT.CITY_NAME AS CITYNAME')
           		->leftjoin('MASTER_PFCT', 'MASTER_PLANT.PFCT_CODE', '=', 'MASTER_PFCT.PFCT_CODE')
            	->where([['MASTER_PLANT.PLANT_CODE','=',$Plant_code]])
            	->get();

            	//DB::enableQueryLog();

            	$plantName =  DB::table('MASTER_PLANT')->where('COMP_CODE',$getcompcode)->where('PLANT_CODE',$Plant_code)->get()->first();
            	//dd(DB::getQueryLog());

               $plantCityName = json_decode(json_encode($plantName),true);
               	
               $fromplace =  $plantCityName['CITY_NAME'];



               $from_place =  DB::table('MASTER_FREIGHT_ROUTE')->where('FROM_PLACE',$fromplace)->where('TO_PLACE',$to_place)->get()->first();

    		if($pfct_list || $fromplace) {

    	            $response_array['response'] = 'success';
	            $response_array['data'] = $pfct_list;
	            $response_array['data_trip'] = $from_place;
	            $response_array['data_plant'] = $fromplace;

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


    

    public function getTranNameByCpCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$consignee = $request->input('consignee');
	    	$acc_code  = $request->input('acc_code');
	    	$rake_no  = $request->input('rake_no');
	    	//$to_place = $request->input('to_place');
//
	    	$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];



           $cpName =  DB::table('DORDER_BODY')->where('CP_CODE',$consignee)->get()->first();
            	//dd(DB::getQueryLog());

           $sp_data = DB::SELECT("SELECT B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME,B.SP_CODE,B.SP_NAME FROM DORDER_BODY B WHERE B.ACC_CODE='$acc_code' AND B.CP_CODE='$consignee' AND B.RAKE_NO='$rake_no' AND B.QTY-B.DISPATCH_PLAN_QTY-B.CANCEL_QTY > 0 GROUP BY B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME,B.SP_CODE,B.SP_NAME");
              	

    		if($cpName || $sp_data) {

    	         $response_array['response'] = 'success';
	            $response_array['data'] = $cpName;
	            $response_array['sp_data'] = $sp_data;
	            

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['sp_data'] = '';

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



	public function getDoNumberByCpCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$consignee = $request->input('consignee');
	    	$acc_code  = $request->input('acc_code');
	    	//$to_place = $request->input('to_place');
//
	    	$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];



           //$cpName =  DB::table('DORDER_BODY')->where('CP_CODE',$consignee)->get()->first();
            	//dd(DB::getQueryLog());

           $do_data = DB::SELECT("SELECT B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME,B.DORDER_NO FROM DORDER_BODY B WHERE B.ACC_CODE='$acc_code' AND B.CP_CODE='$consignee' AND B.QTY-B.DISPATCH_PLAN_QTY-B.CANCEL_QTY > 0 GROUP BY B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME,B.DORDER_NO");
              	

    		if($do_data) {

    	         $response_array['response'] = 'success';
	            $response_array['data'] = $do_data;
	     
	            

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


	public function getRakeNumberByCpCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$consignee = $request->input('consignee');
	    	$acc_code  = $request->input('acc_code');
	    	//$to_place = $request->input('to_place');
//
	    	$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];



           //$cpName =  DB::table('DORDER_BODY')->where('CP_CODE',$consignee)->get()->first();
            	//dd(DB::getQueryLog());

           $do_data = DB::SELECT("SELECT B.COMP_CODE,B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME,B.RAKE_NO FROM DORDER_BODY B WHERE B.ACC_CODE='$acc_code' AND B.CP_CODE='$consignee' AND B.COMP_CODE='$getcompcode' AND B.QTY-B.DISPATCH_PLAN_QTY-B.CANCEL_QTY > 0 GROUP BY B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME,B.RAKE_NO");
              	

    		if($do_data) {

    	         $response_array['response'] = 'success';
	            $response_array['data'] = $do_data;
	     
	            

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

	public function getDoNumberByRakeNo(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$rake_no = $request->input('rake_no');
	    
	    	$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];



           //$cpName =  DB::table('DORDER_BODY')->where('CP_CODE',$consignee)->get()->first();
            	//dd(DB::getQueryLog());

           $do_data = DB::SELECT("SELECT B.COMP_CODE,B.DORDER_NO,B.RAKE_NO FROM DORDER_BODY B WHERE B.RAKE_NO='$rake_no' AND B.COMP_CODE='$getcompcode' AND B.QTY-B.DISPATCH_PLAN_QTY-B.CANCEL_QTY > 0 GROUP BY B.DORDER_NO,B.RAKE_NO");
              	

    		if($do_data) {

    	         $response_array['response'] = 'success';
	            $response_array['data'] = $do_data;
	     
	            

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

	public function getWagonByDoNumber(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$consignee = $request->input('consignee');
	    	$acc_code  = $request->input('acc_code');
	    	$do_no  = $request->input('do_no');
	    	//$to_place = $request->input('to_place');
//
	    	$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];



           //$cpName =  DB::table('DORDER_BODY')->where('CP_CODE',$consignee)->get()->first();
            	//dd(DB::getQueryLog());

           $do_data = DB::SELECT("SELECT B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME,B.DORDER_NO,B.DO_WAGON_NO FROM DORDER_BODY B WHERE B.ACC_CODE='$acc_code' AND B.CP_CODE='$consignee' AND B.DORDER_NO='$do_no' AND B.QTY-B.DISPATCH_PLAN_QTY-B.CANCEL_QTY > 0 GROUP BY B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME,B.DORDER_NO,B.DO_WAGON_NO");

           //print_r($do_data);exit;
              	

    		if($do_data) {

    	         $response_array['response'] = 'success';
	            $response_array['data'] = $do_data;
	     
	            

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

	public function getItemNameByWagon(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$consignee = $request->input('consignee');
	    	$acc_code  = $request->input('acc_code');
	    	$do_no  = $request->input('do_no');
	    	$wagon_no  = $request->input('wagon_no');
	    	//$to_place = $request->input('to_place');
//
	    	$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];



           //$cpName =  DB::table('DORDER_BODY')->where('CP_CODE',$consignee)->get()->first();
            	//dd(DB::getQueryLog());

           $do_data = DB::SELECT("SELECT B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME,B.DORDER_NO,B.DO_WAGON_NO,B.REMARK FROM DORDER_BODY B WHERE B.ACC_CODE='$acc_code' AND B.CP_CODE='$consignee' AND B.DORDER_NO='$do_no' AND  B.DO_WAGON_NO='$wagon_no' AND B.QTY-B.DISPATCH_PLAN_QTY-B.CANCEL_QTY > 0 GROUP BY B.ACC_CODE,B.ACC_NAME,B.CP_CODE,B.CP_NAME,B.DORDER_NO,B.DO_WAGON_NO,B.REMARK");

           //print_r($do_data);exit;
              	

    		if($do_data) {

    	         $response_array['response'] = 'success';
	            $response_array['data'] = $do_data;
	     
	            

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
    /*rake order qty */



/*rack trans*/


/*EPROE STATUS*/

    public function AddEprocStatus(Request $request)
    {
    	//print_r($this->data);exit;
    	
		$title                        ='e-Proc Status';
		
		$CompanyCode                  = $request->session()->get('company_name');
		$compcode                     = explode('-', $CompanyCode);
		$getcompcode                  =$compcode[0];
		$macc_year                    = $request->session()->get('macc_year');
		
		$userdata['comp_list']        = DB::table('MASTER_COMP')->get();
		
		$userdata['accCatglist']           = DB::table('MASTER_ACATG')->get();
		//DB::enableQueryLog();
		$userdata['series_list']      = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T1'])->where(['COMP_CODE'=>$getcompcode])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']    = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();

		$userdata['do_excel_list']      = DB::table('MASTER_EXCELCONFIG')->where('EXLCONFIG_CODE','EPROC')->where('TRAN_CODE','EPROC')->groupBy('TRAN_CODE')->get();

		$userdata['columnlist']    = DB::table('MASTER_EXCELCONFIG')->where('EXLCONFIG_CODE','EPROC')->where('TRAN_CODE','EPROC')->get()->toArray();
		
		//DB::enableQueryLog();
		$userdata['dept_list']        = DB::table('MASTER_DEPT')->get();
		$userdata['plantlist']       = DB::table('MASTER_PLANT')->where(['COMP_CODE'=>$getcompcode])->get();
		$userdata['pfct_list']        = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']        = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']        = DB::table('MASTER_COST')->get();
		$userdata['emp_list']         = DB::table('MASTER_EMP')->get();
		
		$userdata['help_item_list']   = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']        = DB::table('MASTER_RATE_VALUE')->get();
		
		$userdata['cost_list']        = DB::table('MASTER_COST')->get();
		
		$userdata['area_list']        = DB::table('MASTER_AREA')->get();

		$userdata['route_list']        = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('ROUTE_CODE')->get();

		$userdata['um_list']        = DB::table('MASTER_UM')->get();
		
		$userdata['vehicletype_list'] = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();
		$userdata['freightType_list'] = DB::table('MASTER_FREIGHTTYPE')->get();

		//print_r($userdata['vehicletype_list']);exit;

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		$requistion = DB::table('FSO_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();

		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T1')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='T1'");
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

		    return view('admin.finance.transaction.logistic.eproc_status',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }


    public function importEprocStatusExcel(Request $request) 
    {
     
		$table           = 'TEMP_DO_ORDER';

		$config_table    = 'MASTER_EXCELCONFIG';

		$CompanyName     = $request->session()->get('company_name');
	
		$fisYear =  $request->session()->get('macc_year');

		$createdBy    = $request->session()->get('userid');

		$getcompcode = explode('-', $CompanyName);

		$comp_code   =$getcompcode[0];
		$comp_name   =$getcompcode[1];

		$do_excel_code = $request->input('do_excel_code');
		$acCcode       = $request->input('account_code');
		$tranType      = $request->input('tranType');

	   //print_r($tranType);exit;
	
		$column_name = DB::table('MASTER_EXCELCONFIG')->select('EXCEL_COL','VALIDATION_STATUS','TEMPEXCEL_COL','TBL_COL')->where('TRAN_CODE','EPROC')->where('EXLCONFIG_CODE',$do_excel_code)->get()->toArray();

		$configTableCount = count($column_name);

		//print_r($column_name);exit;

		$itemcolumn = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','EPROC')->where('EXLCONFIG_CODE',$do_excel_code)->where('VALIDATION_STATUS',2)->get()->toArray();

		//print_r($do_excel_code);exit;


		$acc_code = DB::table('MASTER_ACC')->select('ACC_CODE')->get()->toArray();
		
	//	$tempvrno        = $request->input('tempvrno');
		
		$temptransporter = $request->input('temptransporter');
		
		$createdBy        = $request->session()->get('userid');

		
		$file            = $request->file('file');

		//print_r($file);exit;

		 DB::table('EPROC_UPLOAD_EXCEL')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->delete();
		$import = new TempTableImport();
        $excelData = Excel::toCollection(new TempTableImport(),$file);

        //print_r($excelData);exit;

       
     //  $objPHPExcel->getActiveSheet()->mergeCells('A1:B2');


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

			//print_r($key);
       		

       	}
       //	exit;

       	$tblcount = count($tblmerger);

     
       	/* ----excel column name------- */
         $getExcel =[];
         $getExcel1 =[];
         foreach($excelData[0][0] as $row){

       		$getExcel[] = $row;

       		//print_r($getExcel->row());
       		 

       	}
      // 	exit;

      ///print_r($getExcel);exit;
       	/* ----excel column name------- */

       	/* ----excel all data ------- */
       	$getAllExcelData =[];
         foreach($excelData[0] as $prdrow){

       		array_push($getAllExcelData, $prdrow);

       	}
       	/* ----excel all data ------- */

       	$getAllExcelCount = count($getAllExcelData);



      
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
       		$remainingCount = 'ERROR';
       	}

       //	print_r($remainingCount);

       	$insertexcelArray=[];
       	$insertexcelArrayDt=[];
       	$insertexcelArrayDt1=[];

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

       		///print_r($getAllExcelData[$n]);

       		for ($e = 0; $e < $excelColcount; $e++){

       			if($bankAry[$e] == 'wagon'){

       			}else{

       			unset($getAllExcelData[$n][$bankAry[$e]]);
       			}

       			
       		}
       		
       		if(isset($getAllExcelData[$n])){

       			
       				
       		  /* $from_date = $getAllExcelData[$n]['Bill Dt'];

			   $unix_date = ($from_date - 25569) * 86400;

			  
			   $insertexcelArrayDt[] =  gmdate("Y-m-d", $unix_date);

       		   $arrKey = array_search('Bill Dt', array_keys($getAllExcelData[$n]));*/

       		   //print_r($getAllExcelData[$n]);exit;
       		
       		   $insertexcelArray[]  = $getAllExcelData[$n];

       		}

       	}

       

   
      $dataexcelCount =count($insertexcelArray); 

   // print_r($insertexcelArray);exit;

         //exit();

       for ($t = 1; $t < $dataexcelCount; $t++) {



       		$ColumnArrayValue = json_decode( json_encode($insertexcelArray[$t]), true);
       		$arrayIndex = array_values($ColumnArrayValue);

       		

       		$arrayIndexCount = count($arrayIndex);

       		//print_r($t);

       		$number  = $t % 2;

       	

       		$valid_date =  date("Y-m-d", strtotime($insertexcelArray[$t]['Upload Date']));

       		$currentdate = date('d-m-Y');

       		//$oneYearback = date($currentdate, '-1 year'));

            $oneYearback =  date('d-m-Y', strtotime('-1 year'));

            $validateBackdate =   date("Y-m-d", strtotime($oneYearback));

            //print_r($valid_date);exit;
            //print_r($validateBackdate);exit;

       /* echo '<pre>';

     	print_r($valid_date);
     	echo '</pre>';

     	echo '<pre>';
     	print_r($validateBackdate);exit;*/



       	if($valid_date > $validateBackdate){

       		if($number==1){

       			   
       			   	
       			

       			  if($tranType=='EX-SID'){

       			  	 $transaction_no = $insertexcelArray[$t]['Transaction No'];
       			  	 $invoiceNo   = $insertexcelArray[$t]['Invoice No.'];
       			  	 $bill_no     = $insertexcelArray[$t]['Bill No.'];
       			  	 $item_slno     = $insertexcelArray[$t]['Item No'];
       			  	 $cal_freight_value = $insertexcelArray[$t]['System Calculated Freight Value'];
       			  	 $cal_bonus_amt = $insertexcelArray[$t]['System Calculated Bonus Amt'];
       			  	 $cal_penulty_amt = $insertexcelArray[$t]['System Calculated Penulty Amt'];
       			  	 $net_payble  = $insertexcelArray[$t]['Net Payable'];
       			  	 $short_value = $insertexcelArray[$t]['Short value'];
       			  	 $penulty = $insertexcelArray[$t]['11'];
       			  	 $payble_bill_amt = $insertexcelArray[$t]['Bill Value for Freight(excl. GST)'];
       			  	 $cgst = $insertexcelArray[$t]['GST Amounts'];
       			  	 $sgst = $insertexcelArray[$t]['14'];
       			  	 $igst = $insertexcelArray[$t]['15'];
       			  	 $billDate = date("Y-m-d", strtotime($insertexcelArray[$t]['Bill Dt']));
       			  	 $delivery_qty = $insertexcelArray[$t]['Delivery Qty'];
       			  	 $qty_deliverd = $insertexcelArray[$t]['Quantity Delivered'];
       			  	 $delivery_Date = date("Y-m-d", strtotime($insertexcelArray[$t]['Delivery Date']));
       			  	 $triplun_coverd = $insertexcelArray[$t]['Tarpaulin Covrd'];
       			  	 $current_status = $insertexcelArray[$t]['Current Status'];
       			  	 $uploadDate = date("Y-m-d", strtotime($insertexcelArray[$t]['Upload Date']));
       			 
 					 $delivery_no ='';
 					 $section_code ='';
 					 $condtion ='';
 					 $po_number ='';
 					 $min_gurrentee ='';
 					 $uplodedBillAmt='';

       			  }else{


       			  	
       			  	 $transaction_no = $insertexcelArray[$t]['Transaction No'];
       			  	 $delivery_no = $insertexcelArray[$t]['Delivery No.'];
       			  	 $bill_no = $insertexcelArray[$t]['Bill No.'];
       			  	 $cal_freight_value = $insertexcelArray[$t]['Calculated Freight Value'];
       			  	 $cal_bonus_amt = $insertexcelArray[$t]['Uploaded Bonus Amt'];
       			  	 $cal_penulty_amt = $insertexcelArray[$t]['Uploaded Penulty Amt'];
       			  	 $short_value = $insertexcelArray[$t]['Short value'];
       			  	 $penulty = $insertexcelArray[$t]['10'];
       			  	 $payble_bill_amt = $insertexcelArray[$t]['Payable Bill Amt'];
       			  	 $uplodedBillAmt = $insertexcelArray[$t]['Uploaded Bill Amt'];
       			  	 $cgst = $insertexcelArray[$t]['GST Amounts'];
       			  	 $sgst = $insertexcelArray[$t]['13'];
       			  	 $igst = $insertexcelArray[$t]['14'];
       			  	 $billDate = date("Y-m-d", strtotime($insertexcelArray[$t]['Bill Dt']));
       			  	 $section_code = $insertexcelArray[$t]['Section Code'];
       			  	 $delivery_qty = $insertexcelArray[$t]['Delivery Qty'];
       			  	 $qty_deliverd = $insertexcelArray[$t]['Quantity Delivered'];
       			  	 $delivery_Date = $insertexcelArray[$t]['Delivery Date'];
       			  	 $triplun_coverd = $insertexcelArray[$t]['Tarpaulin Covrd'];
       			  	 $condtion = $insertexcelArray[$t]['Condition'];
       			  	 $current_status = $insertexcelArray[$t]['Current Status'];
       			  	 $uploadDate = date("Y-m-d", strtotime($insertexcelArray[$t]['Upload Date']));
       			  	 $po_number = $insertexcelArray[$t]['Po Number'];
       			  	 $min_gurrentee = $insertexcelArray[$t]['Min. Guarantee'];

       			  	 $invoiceNo = '';
       			  	 $item_slno = '';
       			  	 $net_payble='';
       			  	 $net_payble='';


       			  }



       			$dataInsert =array(

			       			'COMP_CODE'=>$comp_code,
			       			'COMP_NAME'=>$comp_name,
			       			'FY_CODE'=>$fisYear,
			       			'TRANSACTION_CODE'=>$transaction_no,
			       			'DELIVERY_NO'=>$delivery_no,
			       			'INVOICE_NO' =>$invoiceNo,
			       			'BILL_NO' =>$bill_no,
			       			'ITEM_SLNO' =>$item_slno,
			       			'CAL_FREIGHT_VAL'=>$cal_freight_value,
			       			'UPLOAD_BONUS_AMT'=>$cal_bonus_amt,
			       			'UPLAOD_PENALTY_AMT'=>$cal_penulty_amt,
			       			'UPLAOD_BILL_AMT'=>$uplodedBillAmt,
			       			'SHORT_VAL'=>$short_value,
			       			'PENULTY'=>$penulty,
			       			'PAYBEL_BILL_AMT'=>$payble_bill_amt,
			       			'CGST'=>$cgst,
			       			'SGST'=>$sgst,
			       			'BILL_DATE'=>$billDate,
			       			'SECTION_CODE'=>$section_code,
			       			'DELIVERY_QTY'=>$delivery_qty,
			       			'QTY_DELIVERD'=>$qty_deliverd,
			       			'DELIVERY_DATE'=>$delivery_Date,
			       			'TRAPLN_COVERD'=>$triplun_coverd,
			       			'E_CONDITION'=>$condtion,
			       			'CURRENT_STATUS'=>$current_status,
			       			'UPLOAD_DATE'=>$uploadDate,
			       			'PO_NUMBER'=>$po_number,
			       			'MIN_GUARENTEE'=>$min_gurrentee,
			       			'CREATED_BY'=> $createdBy,

			       		);

       		  // print_r($dataInsert);

	             $saveData = DB::table('EPROC_UPLOAD_EXCEL')->insert($dataInsert);

	           	 $lastId = DB::getPdo()->lastInsertId();

	          //$getData =  DB::table('EPROC_UPLOAD_EXCEL')->where('ID',$lastId)->get()->first();
       		}else{

       			$uploadDate = date("Y-m-d", strtotime($insertexcelArray[$t]['Upload Date']));

       			$dataUpdate =array(
			       			
			       			'CAL_BONUS_AMT' =>$cal_bonus_amt,
			       			'CAL_PENALTY_AMT' =>$cal_penulty_amt,
			       			'CAL_BILL_AMT' =>$uplodedBillAmt,
			       			'POSTING_DATE' =>$uploadDate,
			       	
			       		);

	             $updateData = DB::table('EPROC_UPLOAD_EXCEL')->where('ID',$lastId)->update($dataUpdate);
       			
       		}	
       	

       		}
       }
     // exit;
      
     
       	if($saveData) {

    			$response_array['response'] = 'success';
    			//$response_array['new_data_count'] = $new_data_count;
    		
	            echo $data = json_encode($response_array);
	         
			}else{

				$response_array['response'] = 'error';
				//$response_array['new_data_count'] = '';

            $data = json_encode($response_array);
            print_r($data);
				
			}

		}else{

			$response_array['response'] = 'error_data';
			$response_array['data_error'] = 'data not avilable';
         echo  $data = json_encode($response_array);
        
		}


       	
    }

/*EPROE STATUS*/

    public function importEprocStatusExcel_1(Request $request) 
    {
     
		$table           = 'TEMP_DO_ORDER';

		$config_table    = 'MASTER_EXCELCONFIG';

		$CompanyName     = $request->session()->get('company_name');
	
		$fisYear =  $request->session()->get('macc_year');

		$createdBy    = $request->session()->get('userid');

		$getcompcode = explode('-', $CompanyName);

		$comp_code   =$getcompcode[0];
		$comp_name   =$getcompcode[1];

		$do_excel_code = $request->input('do_excel_code');
		$acCcode       = $request->input('account_code');
		$tranType      = $request->input('tranType');

	   // print_r($tranType);exit;
	
		$column_name = DB::table('MASTER_EXCELCONFIG')->select('EXCEL_COL','VALIDATION_STATUS','TEMPEXCEL_COL','TBL_COL')->where('TRAN_CODE','EPROC')->where('EXLCONFIG_CODE',$do_excel_code)->get()->toArray();

		$configTableCount = count($column_name);



		$itemcolumn = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','EPROC')->where('EXLCONFIG_CODE',$do_excel_code)->where('VALIDATION_STATUS',2)->get()->toArray();

		$acc_code = DB::table('MASTER_ACC')->select('ACC_CODE')->get()->toArray();
		
	//	$tempvrno        = $request->input('tempvrno');
		
		$temptransporter = $request->input('temptransporter');
		
		$createdBy        = $request->session()->get('userid');

		//print_r($createdBy);exit;
		
		$file            = $request->file('file');

		 DB::table('EPROC_UPLOAD_EXCEL')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CREATED_BY',$createdBy)->delete();
		$import = new TempTableImport();
        $excelData = Excel::toCollection(new TempTableImport(),$file);

         
        //print_r($excelData);exit;
    

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

			//print_r($key);
       		

       	}
       //	exit;

       	$tblcount = count($tblmerger);

     
       	/* ----excel column name------- */
         $getExcel =[];
         $getExcel1 =[];
         foreach($excelData[0][0] as $row){

       		$getExcel[] = $row;

       		//print_r($getExcel->row());
       		 

       	}
      // 	exit;

       	//print_r($getExcel1);exit;
       	/* ----excel column name------- */

       	/* ----excel all data ------- */
       	$getAllExcelData =[];
         foreach($excelData[0] as $prdrow){

       		array_push($getAllExcelData, $prdrow);

       	}
       	/* ----excel all data ------- */

       	$getAllExcelCount = count($getAllExcelData);



      
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
       		$remainingCount = 'ERROR';
       	}

       	//print_r($remainingCount);

       	$insertexcelArray=[];
       	$insertexcelArrayDt=[];
       	$insertexcelArrayDt1=[];

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

       		///print_r($getAllExcelData[$n]);

       		for ($e = 0; $e < $excelColcount; $e++){

       			if($bankAry[$e] == 'wagon'){

       			}else{

       			unset($getAllExcelData[$n][$bankAry[$e]]);
       			}

       			
       		}
       		
       		if(isset($getAllExcelData[$n])){

       			
       				
       		  /* $from_date = $getAllExcelData[$n]['Bill Dt'];

			   $unix_date = ($from_date - 25569) * 86400;

			  
			   $insertexcelArrayDt[] =  gmdate("Y-m-d", $unix_date);

       		   $arrKey = array_search('Bill Dt', array_keys($getAllExcelData[$n]));*/
       		
       		   $insertexcelArray[]  = $getAllExcelData[$n];

       		}

       	}

       

   
      $dataexcelCount =count($insertexcelArray); 

     //print_r($dataexcelCount);exit;

       for ($t = 1; $t < $dataexcelCount; $t++) {

       		$ColumnArrayValue = json_decode( json_encode($insertexcelArray[$t]), true);
       		$arrayIndex = array_values($ColumnArrayValue);

       		

       		$arrayIndexCount = count($arrayIndex);

       		//print_r($t);

       		$number  = $t % 2;

       		//print_r($insertexcelArray[$t]['Transaction No']);

       		if($number==1){

       			   $uploadDate = date("Y-m-d", strtotime($insertexcelArray[$t]['Upload Date']));
       			   $billDate = date("Y-m-d", strtotime($insertexcelArray[$t]['Bill Dt']));

       			  /* echo '<pre>';
       			   print_r($insertexcelArray[$t]['Delivery No.']);
       			   echo '</pre>';*/

       			  /*if($tranType=='EX-SID'){

       			  	$invoiceNo = $insertexcelArray[$t]['Invoice No.'];
 
       			  }else{

       			  	 $invoiceNo = $insertexcelArray[$t]['Delivery No.'];

       			  }*/


       			$dataInsert =array(

			       			'COMP_CODE'=>$comp_code,
			       			'COMP_NAME'=>$comp_name,
			       			'FY_CODE'=>$fisYear,
			       			'TRANSACTION_CODE'=>$insertexcelArray[$t]['Transaction No'],
			       			'DELIVERY_NO'=>$insertexcelArray[$t]['Delivery No.'],
			       			'BILL_NO' =>$insertexcelArray[$t]['Bill No.'],
			       			'CAL_FREIGHT_VAL'=>$insertexcelArray[$t]['Calculated Freight Value'],
			       			'UPLOAD_BONUS_AMT'=>$insertexcelArray[$t]['Uploaded Bonus Amt'],
			       			'UPLAOD_PENALTY_AMT'=>$insertexcelArray[$t]['Uploaded Penulty Amt'],
			       			'UPLAOD_BILL_AMT'=>$insertexcelArray[$t]['Uploaded Bill Amt'],
			       			'SHORT_VAL'=>$insertexcelArray[$t]['Short value'],
			       			'PENULTY'=>$insertexcelArray[$t]['10'],
			       			'PAYBEL_BILL_AMT'=>$insertexcelArray[$t]['Payable Bill Amt'],
			       			'CGST'=>$insertexcelArray[$t]['13'],
			       			'SGST'=>$insertexcelArray[$t]['14'],
			       			'BILL_DATE'=>$billDate,
			       			'SECTION_CODE'=>$insertexcelArray[$t]['Section Code'],
			       			'DELIVERY_QTY'=>$insertexcelArray[$t]['Delivery Qty'],
			       			'QTY_DELIVERD'=>$insertexcelArray[$t]['Quantity Delivered'],
			       			'DELIVERY_DATE'=>$insertexcelArray[$t]['Delivery Date'],
			       			'TRAPLN_COVERD'=>$insertexcelArray[$t]['Tarpaulin Covrd'],
			       			'E_CONDITION'=>$insertexcelArray[$t]['Condition'],
			       			'CURRENT_STATUS'=>$insertexcelArray[$t]['Current Status'],
			       			'UPLOAD_DATE'=>$uploadDate,
			       			'PO_NUMBER'=>$insertexcelArray[$t]['Po Number'],
			       			'MIN_GUARENTEE'=>$insertexcelArray[$t]['Min. Guarantee'],
			       			'CREATED_BY'=> $createdBy,

			       		);

       		  // print_r($dataInsert);

	             $saveData = DB::table('EPROC_UPLOAD_EXCEL')->insert($dataInsert);

	           	 $lastId = DB::getPdo()->lastInsertId();

	          //$getData =  DB::table('EPROC_UPLOAD_EXCEL')->where('ID',$lastId)->get()->first();
       		}else{

       			$uploadDate = date("Y-m-d", strtotime($insertexcelArray[$t]['Upload Date']));

       			$dataUpdate =array(
			       			
			       			'CAL_BONUS_AMT' =>$insertexcelArray[$t]['Uploaded Bonus Amt'],
			       			'CAL_PENALTY_AMT' =>$insertexcelArray[$t]['Uploaded Penulty Amt'],
			       			'CAL_BILL_AMT' =>$insertexcelArray[$t]['Uploaded Bill Amt'],
			       			'POSTING_DATE' =>$uploadDate,
			       	
			       		);

	             $updateData = DB::table('EPROC_UPLOAD_EXCEL')->where('ID',$lastId)->update($dataUpdate);
       			
       		}	
       	

       
       }
     // exit;
      
     
       	if($saveData) {

    			$response_array['response'] = 'success';
    			//$response_array['new_data_count'] = $new_data_count;
    		
	            echo $data = json_encode($response_array);
	         
			}else{

				$response_array['response'] = 'error';
				//$response_array['new_data_count'] = '';

            $data = json_encode($response_array);
            print_r($data);
				
			}

		}else{

			$response_array['response'] = 'error_data';
			$response_array['data_error'] = 'data not avilable';
         echo  $data = json_encode($response_array);
        
		}


       	
    }

/*EPROE STATUS*/

    public function importEprocStatusExcel_old(Request $request) 
    {
     
		$table           = 'TEMP_DO_ORDER';

		$config_table    = 'MASTER_EXCELCONFIG';

		$CompanyName     = $request->session()->get('company_name');
	
		$fisYear =  $request->session()->get('macc_year');

		$getcompcode = explode('-', $CompanyName);

		$comp_code   =$getcompcode[0];

		$do_excel_code = $request->input('do_excel_code');
		$acCcode = $request->input('account_code');

	    //print_r($acc_code);exit;
	
		$column_name = DB::table('MASTER_EXCELCONFIG')->select('EXCEL_COL','VALIDATION_STATUS','TEMPEXCEL_COL','TBL_COL')->where('TRAN_CODE','EPROC')->where('EXLCONFIG_CODE',$do_excel_code)->get()->toArray();

		$configTableCount = count($column_name);



		$itemcolumn = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','EPROC')->where('EXLCONFIG_CODE',$do_excel_code)->where('VALIDATION_STATUS',2)->get()->toArray();

		$acc_code = DB::table('MASTER_ACC')->select('ACC_CODE')->get()->toArray();
		
	//	$tempvrno        = $request->input('tempvrno');
		
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



      	//print_r($getAllExcelData);exit;

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
       		$remainingCount = 'ERROR';
       	}

       	//print_r($remainingCount);

       	$insertexcelArray=[];
       	$insertexcelArrayDt=[];
       	$insertexcelArrayDt1=[];

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

      // print_r($getAllExcelData);exit;

       	for($w=0;$w< $getAllExcelCount;$w++){
       		$n= $w+1;
       		/* -- excel col count -- */
       		for ($e = 0; $e < $excelColcount; $e++){

       			if($bankAry[$e] == 'wagon'){

       			}else{

       			unset($getAllExcelData[$n][$bankAry[$e]]);
       			}

       			
       		}
       		
       		if(isset($getAllExcelData[$n])){


       			
       		   $from_date = $getAllExcelData[$n]['Bill Dt'];

       		  // $to_date = $getAllExcelData[$n]['To'];
       		 
			   $unix_date = ($from_date - 25569) * 86400;

			   //$unix_date1 = ($to_date - 25569) * 86400;
		
       		
			   $insertexcelArrayDt[] =  gmdate("Y-m-d", $unix_date);

			
			  // $insertexcelArrayDt1[] =   gmdate("Y-m-d", $unix_date1);

			
       		   $arrKey = array_search('Bill Dt', array_keys($getAllExcelData[$n]));
       		   //$arrKey1 = array_search('To', array_keys($getAllExcelData[$n]));
       		  
       		   $insertexcelArray[]  = $getAllExcelData[$n];

       		}

     
       		

       	}

      //	exit;

      // print_r($insertexcelArray);exit;

      $dataexcelCount =count($insertexcelArray); 

      $temptblcol =[];
		$tempExcelcol =[];
		for ($b = 0; $b < $tblcount; $b++) {

			$temptblcol[] = $tblmerger[$b]['TBL_COL'];
			$tempExcelcol[] = $tblmerger[$b]['TEMPEXCEL_COL'];

		  // print_r($tblmerger[$b]['TBL_COL']);

	    }

	    $arryCombConfigTbl = array_combine($temptblcol, $tempExcelcol);

	    //print_r($arryCombConfigTbl);exit;
	    

	    $ConfigDelNo      = $arryCombConfigTbl['DELIVERY_NO'];
	
	/*	$ConfigCompCode      = $arryCombConfigTbl['COMP_CODE'];
		$ConfigCompName      = $arryCombConfigTbl['COMP_NAME'];
		$ConfigPlantCode     = $arryCombConfigTbl['PLANT_CODE'];
		$ConfigPlantName     = $arryCombConfigTbl['PLANT_NAME'];
		$ConfigCityCode      = $arryCombConfigTbl['CITY_CODE'];
		$ConfigCityName      = $arryCombConfigTbl['CITY_NAME'];
		$ConfigValidFromDt   = $arryCombConfigTbl['VALID_FROM_DATE'];
		$ConfigValidToDt     = $arryCombConfigTbl['VALID_TO_DATE'];
		$ConfigVehicleType     = $arryCombConfigTbl['VEHICLE_TYPE'];*/

       	
       for ($t = 0; $t < $dataexcelCount; $t++) {

       	$arrayIndex = array_values($insertexcelArray[$t]);
       	$arrayIndex1 = $insertexcelArrayDt[$t];
       
       	$arrayIndexCount = count($arrayIndex);

       	$new_array = [];
       	
       	$SRNO = 1;
			foreach ($arrayIndex as $value){

				$SRNO++;
			} 

      // 	print_r($arrayIndex);

       		for ($p = 0; $p < $arrayIndexCount; $p++) {

       			$q = $p +1;

       			if($p==$arrKey){
       				$new_array['COL'.$q] = $arrayIndex1;

       			}else{

       				$new_array['COL'.$q] = $arrayIndex[$p];
       			}
       			
       			
       		}
       

       		$saveData =	DB::insert("INSERT INTO `TEMP_DELIVERY_ORDER` (COMP_CODE,FY_CODE,CREATED_BY,".implode(' , ', array_keys($new_array)).") VALUES ('$comp_code','$fisYear','$createdBy','".implode("' , '", array_values($new_array))."')");

       		//dd(DB::getQueryLog());

       		$lastId =	DB::getPdo()->lastInsertId();

       		$tempDoOrder = DB::table('TEMP_DELIVERY_ORDER')->where('ID',$lastId)->get()->first();


       		$tempDelNo = $tempDoOrder->$ConfigDelNo;

       	$getData = DB::table('SBILL_BODY_PROV')->where('DELIVERY_NO',$tempDelNo)->get()->toArray();

       		
       	if(empty($getData)){

       			$firstdo = array(

       				'DO_EXIST_STATUS' => 'NO',
       				'DO_UPDATE_STATUS' => 0,
       			);

   				DB::table('TEMP_DELIVERY_ORDER')->where($ConfigDelNo,$tempDelNo)->where('COMP_CODE',$comp_code)->where('CREATED_BY',$createdBy)->update($firstdo);


       		}else{

       			$existdata = array(

	       				'DO_EXIST_STATUS' => 'EXIST',
	       				'DO_UPDATE_STATUS' => 0,

	       			);

	   			DB::table('TEMP_DELIVERY_ORDER')->where($ConfigDelNo,$tempDelNo)->where('COMP_CODE',$comp_code)->where('CREATED_BY',$createdBy)->update($existdata);

       		}
       	
       	
       }

      //exit;

        $NewData= DB::select("SELECT * FROM TEMP_DELIVERY_ORDER WHERE DO_EXIST_STATUS ='EXIST' AND COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND CREATED_BY='$createdBy'");
  
  		$new_data_count = count($NewData);
     
       	if($saveData) {

    			$response_array['response'] = 'success';
    			$response_array['new_data_count'] = $new_data_count;
    		
	            echo $data = json_encode($response_array);
	         
			}else{

				$response_array['response'] = 'error';
				$response_array['new_data_count'] = '';

            $data = json_encode($response_array);
            print_r($data);
				
			}

		}else{

			$response_array['response'] = 'error_data';
			$response_array['data_error'] = 'data not avilable';
         echo  $data = json_encode($response_array);
        
		}



       	
    }

/*EPROE STATUS*/


/*job work sale bill*/

 public function TransporterSaleBill(Request $request){

        $title = "Transporter Bill Posting";

        $company_name = $request->session()->get('company_name');
        $getcomcode   = explode('-', $company_name);
        $comp_code    = $getcomcode[0];
        $macc_year    = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid       = $request->session()->get('userid');
        //DB::enableQueryLog();
       	$accList = DB::table('TRIP_HEAD')->WHERE('LR_ACK_STATUS','1')->WHERE('TSALEBILL_STATUS','0')->groupBy('ACC_CODE')->get();
       ///	dd(DB::getQueryLog());
       	$userdata['acc_list_data'] = json_decode(json_encode($accList), true); 
       	//echo "<RE>";print_r($userdata['accList']);exit;
		//$userdata['acc_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userdata['vehicle_list'] = DB::table('TRIP_HEAD')->WHERE('LR_ACK_STATUS','1')->WHERE('TSALEBILL_STATUS','0')->get();

		$userdata['tran_list'] = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','S5')->get()->first();

		$series_data = DB::table('MASTER_CONFIG')->WHERE('TRAN_CODE','S5')->WHERE('COMP_CODE',$comp_code)->get();

	    if($series_data){

	      $userdata['series_list'] = $series_data;

	    }else{

	      $userdata['series_list']='';
	    }

		$userdata['taxList'] = DB::table('MASTER_TAX')->get();

		$userdata['ratval_list'] = DB::table('MASTER_RATE_VALUE')->get();

		$itemList  = DB::table('MASTER_ITEM')->where('ITEMTYPE_CODE','SR')->get()->toArray();

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$comp_code,'FY_CODE'=>$macc_year])->get();

        foreach ($getdate as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }
 

        if(isset($company_name)){

            return view('admin.finance.transaction.logistic.transporter_sale_bill',$userdata+compact('itemList'));
        }else{

            return redirect('/useractivity');

        }

    }


     public function get_postCodeByAccSaleBill(Request $request){

		$response_array = array();

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		if ($request->ajax()) {

		//$vehicle_Type   = $request->input('vehicle_Type');
		$account_code   = $request->input('acc_code');
		
		$acc_data       ='';
		$fetch_tds_rate ='';
		$trip_data      ='';
		$fetch_glCode   ='';

		$acc_data = DB::table('MASTER_ACC')->where('ACC_CODE',$account_code)->get()->first();
			

		$fetch_glCode = DB::table('MASTER_GLKEY')->select('MASTER_GLKEY.*')->leftjoin('MASTER_GL', 'MASTER_GLKEY.GL_CODE', '=', 'MASTER_GL.GL_CODE')->where('MASTER_GLKEY.ATYPE_CODE',$acc_data->ATYPE_CODE)->get();

		//$sale_order = DB::table('SORDER_HEAD')->where('ACC_CODE',$account_code)->get()->toArray();

		$sale_order = DB::select("SELECT H.FSOHID,T.ACC_CODE,H.VRNO,H.FY_CODE AS FYCODE,H.SERIES_CODE AS SERIESCODE FROM TRIP_HEAD T,FSO_HEAD H, FSO_BODY B WHERE  B.FSOHID=H.FSOHID AND H.ACC_CODE=T.ACC_CODE  AND T.ACC_CODE='$account_code' AND H.COMP_CODE ='$getcom_code' AND T.TSALEBILL_STATUS='0' GROUP BY H.VRNO");

		/*$sale_order = DB::select("SELECT T.ACC_CODE,H.VRNO,H.FY_CODE AS FYCODE,H.SERIES_CODE AS SERIESCODE FROM TRIP_HEAD T,SORDER_HEAD H, SORDER_BODY B,TRIP_BODY M WHERE M.TRIPHID=T.TRIPHID AND B.SORDERHID=H.SORDERHID AND B.ITEM_CODE=M.ITEM_CODE AND H.ACC_CODE=T.ACC_CODE  AND T.ACC_CODE='$account_code' AND H.COMP_CODE ='$getcom_code' AND T.TSALEBILL_STATUS='0' GROUP BY H.VRNO");*/
		

           
    	if($acc_data || $fetch_glCode || $sale_order) {

			$response_array['response']          = 'success';
			$response_array['data']              = $acc_data;
			$response_array['multiple_data']     = $fetch_glCode;
			$response_array['data_sale']          = $sale_order;
		

	           	echo $data = json_encode($response_array);

	            //print_r($data);

		}else{

			$response_array['response']          = 'error';
			$response_array['data']              = '' ;
			$response_array['multiple_data']     = '';
			$data                            = json_encode($response_array);

	                print_r($data);
				
		}


	    }else{

    		$response_array['response']          = 'error';
		$response_array['data']              = '' ;
		$response_array['trip_data']         = '';
		$response_array['multiple_data']     = '';
		$response_array['data_tds']          = '';
		$response_array['data_vehicle_list'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function TransporterSaleBillData(Request $request){

        if($request->ajax()) {

             if (!empty($request->acct_code || $request->fsoHeadId || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
               // $sale_order_no   = $request->fsoHeadId;
             	$fso_headID = $request->fsoHeadId;
               /* if(isset($request->fsoHeadId)  && trim($request->fsoHeadId)!=""){

                    $strWhere .= "AND  H.VRNO = '$request->sale_order_no'";
                }*/

               if(isset($request->acct_code)  && trim($request->acct_code)!=""){
	                   $strWhere .= "AND T.ACC_CODE = '$request->acct_code'";
	             }
                
                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND T.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

              
               //DB::enableQueryLog();


                 /*   $data = DB::select("SELECT TRIP_HEAD.TRIPHID AS tripHeadId,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1 $strWhere AND TRIP_HEAD.OWNER='SELF' AND TRIP_HEAD.LR_ACK_STATUS ='1' AND TRIP_HEAD.BILL_STATUS ='0' GROUP BY TRIP_BODY.TRIPHID");*/

                 /*   $data = DB::select("SELECT T.ACC_CODE,T.ACC_NAME,T.TRIPHID,M.ITEM_CODE,M.ITEM_NAME,SUM(M.QTY) AS DISPATCH_QTY,B.RATE,SUM(M.QTY)*B.RATE AS AMOUNT,H.FSOHID,H.PFCT_CODE,H.PFCT_NAME,H.PLANT_CODE,H.PLANT_NAME,H.SERIES_CODE,H.SERIES_NAME FROM TRIP_HEAD T,TRIP_BODY M,FSO_HEAD H,FSO_BODY B WHERE 1=1 $strWhere AND M.TRIPHID=T.TRIPHID AND B.FSOHID=H.FSOHID AND H.ACC_CODE=T.ACC_CODE AND T.TSALEBILL_STATUS='0'");*/
                 /*$data = DB::select("SELECT T.ACC_CODE,T.ACC_NAME,T.TRIPHID,B.ITEM_CODE,B.ITEM_NAME,SUM(B.QTY) AS DISPATCH_QTY,T.FSO_RATE,SUM(B.QTY)*T.FSO_RATE AS AMOUNT,T.FSOHID,T.PFCT_CODE,T.PFCT_NAME,T.PLANT_CODE,T.PLANT_NAME,T.SERIES_CODE,T.SERIES_NAME,T.FSO_RATE FROM TRIP_HEAD T,TRIP_BODY B WHERE 1=1 $strWhere  AND B.TRIPHID=T.TRIPHID AND T.TSALEBILL_STATUS='0' AND T.LR_ACK_STATUS='1'");*/
                 //DB::enableQueryLog();
                 $data = DB::select("SELECT T.ACC_CODE,T.ACC_NAME,T.TRIPHID,T.VEHICLE_NO AS VEHICLENO,B.LR_NO,B.WAGON_NO,B.INVC_NO,B.TRIP_ACK,B.ITEM_CODE,B.ITEM_NAME, B.LR_DATE,SUM(B.QTY) AS DISPATCH_QTY,C.RATE AS FSO_RATE,SUM(B.QTY)*C.RATE AS AMOUNT,T.PFCT_CODE,T.PFCT_NAME,T.PLANT_CODE,T.PLANT_NAME,T.TO_PLACE,T.SERIES_CODE,T.SERIES_NAME FROM TRIP_HEAD T,TRIP_BODY B,FSO_BODY C WHERE 1=1 $strWhere AND B.TRIPHID=T.TRIPHID AND T.TSALEBILL_STATUS='0' AND B.PROVBILL_STATUS='0' AND T.FROM_PLACE=C.FROM_PLACE AND T.TO_PLACE=C.TO_PLACE AND T.ACC_CODE=C.ACC_CODE AND C.FSOHID='$fso_headID' AND T.LR_ACK_STATUS='1' GROUP BY T.ACC_CODE,T.ACC_NAME,T.TRIPHID,B.LR_NO");
                //dd(DB::getQueryLog()); 
                

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


  function SaveTransporterSaleBillData(Request $request){

  	/*echo '<pre>';
  	print_r($request->post());exit;
  	echo '</pre>';*/

		$CompanyCode  = $request->session()->get('company_name');
		$compcode_get = explode('-', $CompanyCode);
		$compcode     = $compcode_get[0];
		$fyCode       = $request->session()->get('macc_year');
		$FYEXP 		  = explode('-', $fyCode);
		$createdBy    = $request->session()->get('userid');

		//single
		$vrDate       = $request->input('vrDate');
		$tr_vr_date   = date("Y-m-d", strtotime($vrDate));
		$acctCode     = $request->input('acctCode');
		$acctName     = $request->input('acctName');
		$acc_glCode   = $request->input('PostCode');
		$acc_glName   = $request->input('PostName');
		$seriesCode   = $request->input('seriesCode');
		$seriesName   = $request->input('seriesName');
		$transCode    = $request->input('transCode');
		$taxCode      = $request->input('taxCode');
		$basicValue   = $request->input('basicValue');
		$NetAmnt      = $request->input('NetAmnt');
		$triphid      = $request->input('triphid');
		$drAmt        = $request->input('drAmt');
		$fsoHid       = $request->input('fsoHid');

		//multi
		$pfct_code    = $request->input('pfct_code');
		$pfct_name    = $request->input('pfct_name');
		$plant_code   = $request->input('plant_code');
		$plant_name   = $request->input('plant_name');
		$jwitem_code  = $request->input('item_code');
		$jwitem_name  = $request->input('item_name');
		$dispatch_qty = $request->input('dispatch_qty');
		$rate         = $request->input('rate');
		$basicHAmt    = $request->input('freightAmt');
		$rate         = $request->input('rate');
		$flit_id      = $request->input('flit_id');
		$head_tax_ind = $request->input('head_tax_ind');
		$tax_ind_code = $request->input('taxIndCode');
		$rate_ind     = $request->input('rate_ind');
		$af_rate      = $request->input('af_rate');
		$amount       = $request->input('amount');
		$logicget     = $request->input('logicget');
		$staticget    = $request->input('staticget');
		$tax_gl_code  = $request->input('taxGlCode');
		$series_gl    = $request->input('series_gl');
		$rowCount     = $request->input('rowCount');
		$isChkChecked = $request->input('isChkChecked');
		$lr_no 		  = $request->input('lr_no');
		$donwloadStatus   = $request->input('pdfYesNoStatus');
		$gstTaxData   = $request->input('gstTaxData');


	//print_r($fsoHid);exit;
		
		$datacount = count($flit_id);

		if(isset($head_tax_ind)){

			$head_tax_count = count($head_tax_ind);
		}else{
			$head_tax_count='';
		}
		

		

		DB::beginTransaction();

		try {

		/* ----- /. START : VRNO CREATE OR GET FROM DB -------- */

					$lastVrno1 = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$compcode)->where('FY_CODE',$fyCode)->where('TRAN_CODE',$transCode)->get()->first();

					$lastVrno = json_decode(json_encode($lastVrno1),true);
				
					if ($lastVrno) {

					   $newVr = $lastVrno['LAST_NO'] + 1;

					   $datavrn =array(
						   'LAST_NO' => $newVr
						);

					   DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$compcode)->where('FY_CODE',$fyCode)->where('TRAN_CODE',$transCode)->update($datavrn);

					}else{

						$datavrnIn =array(
							'COMP_CODE'   => $compcode,
							'FY_CODE'     => $fyCode,
							'TRAN_CODE'   => $transCode,
							'SERIES_CODE' => $seriesCode,
							'FROM_NO'     => 1,
							'TO_NO'       => 99999,
							'LAST_NO'     => 1,
							'CREATED_BY'  => $createdBy,
						);

						DB::table('MASTER_VRSEQ')->insert($datavrnIn);

						$newVr = 1;

					}


					        $GETMAXID = DB::select("SELECT MAX(SBILLHID) AS SBHID FROM SBILL_HEAD");

			     			$DATAGETMAXID = json_decode(json_encode($GETMAXID),true);

			     			$MDATAGETMAXID = count($DATAGETMAXID);

			     			if ($MDATAGETMAXID > 0) {
			     				
			     				$GETID = $DATAGETMAXID[0]['SBHID'] + 1;

			     			}else{

			     				$GETID = 1;

			     			}

			     			$slNo = 1;


				            $HEADDATA = array(

								'SBILLHID'		=> $GETID,
								'COMP_CODE'		=> $compcode,
								'FY_CODE'     	=> $fyCode,
								'PFCT_CODE'   	=> $pfct_code[0],
								'PFCT_NAME'    	=> $pfct_name[0],
								'TRAN_CODE'    	=> $transCode,
								'SERIES_CODE'   => $seriesCode,
								'SERIES_NAME'   => $seriesName,
								'VRNO'    		=> $newVr,
								'SLNO'    		=> $slNo,
								'VRDATE'    	=> $tr_vr_date ,
								'PLANT_CODE'    => $plant_code[0],
								'PLANT_NAME'    => $plant_name[0],
								'ACC_CODE'    	=> $acctCode,
								'ACC_NAME'    	=> $acctName,
								'DRAMT'    	    => $NetAmnt,
								'TRAN_TYPE'    	=> 'TBSB',
								'TAX_CODE'    	=> $taxCode,
								'FLAG'    		=> '1',
								'CREATED_BY' 	=> $createdBy

							);

							DB::table('SBILL_HEAD')->insert($HEADDATA);

							DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->delete();


					$GETLR = array();
					for ($i = 0; $i < $rowCount; $i++) {

						if ($isChkChecked[$i] =='NO') {

							// DO NOTHING...
							
						}else{

						    $GETMAXIDBD = DB::select("SELECT MAX(SBILLBID) AS SBBID FROM SBILL_BODY");

			     			$DATAGETMAXIDBD = json_decode(json_encode($GETMAXIDBD),true);

			     			$MDATAGETMAXIDBD = count($DATAGETMAXIDBD);

			     			if ($MDATAGETMAXIDBD > 0) {
			     				
			     				$GETBID = $DATAGETMAXIDBD[0]['SBBID'] + 1;

			     			}else{

			     				$GETBID = 1;

			     			}
			     			$srno = $i + 1;

			     		$getDrAmt = $basicHAmt[$i] * 100 / $basicValue;

			     		$MDRAMT = $NetAmnt * $getDrAmt / 100;
			     		
			     		$BILL_NO = $FYEXP[0].'/'.$seriesCode.'/'.$newVr;


			     		$REMARK = 'Against Bill - '.$BILL_NO.' Date - '.$tr_vr_date.' Bill Amount - '.$MDRAMT.' For LR '.$lr_no[$i].' and Item - '.$jwitem_code.' - '.$jwitem_name;

			     		$GETLR[] = $lr_no[$i];

						$MBODYDATA = array(
								'SBILLHID'		=> $GETID,
								'SBILLBID'		=> $GETBID,
								'COMP_CODE'		=> $compcode,
								'FY_CODE'     	=> $fyCode,
								'PFCT_CODE'   	=> $pfct_code[$i],
								'TRAN_CODE'    	=> $transCode,
								'SERIES_CODE'   => $seriesCode,
								'VRNO'    		=> $newVr,
								'SLNO'    		=> $srno,
								'VRDATE'    	=> $tr_vr_date,
								'PLANT_CODE'    => $plant_code[$i],
								'ITEM_CODE'     => $jwitem_code,
								'ITEM_NAME'     => $jwitem_name,
								'PARTICULAR'    => $REMARK,
								'HSN_CODE'      => '',
								'QTYISSUED'    	=> $dispatch_qty[$i],
								'UM'    		=> '',
								'AQTYISSUED'    => '',
								'AUM'    		=> '',
								'RATE'    		=> $rate[$i],
								'BASICAMT'    	=> $basicHAmt[$i],
								'TAX_CODE'    	=> $taxCode,
								'DRAMT'    		=> $MDRAMT,
								'FLAG'    		=> '1',
								'CREATED_BY' 	=> $createdBy

							);

							DB::table('SBILL_BODY')->insert($MBODYDATA);


							$SALEBILLUPDATE =array(

								'TSALEBILL_STATUS' =>'1',
								'SBILLHID' =>$GETID,
							);

							DB::table('TRIP_HEAD')->where('TRIPHID',$triphid[$i])->update($SALEBILLUPDATE);

						}

					}

					$Sgstamt =array();
					$Cgstamt =array();
					$Igstamt =array();
					$SgstRate =array();
					$CgstRate =array();
					$IgstRate =array();
				


				if(isset($head_tax_ind)){

					for ($j = 0; $j < $head_tax_count; $j++) {



						if($head_tax_ind[$j]=='SGST'){

							$Sgstamt = $amount[$j];
							$SgstRate = $af_rate[$j];
							
						}
						if($head_tax_ind[$j]=='CGST'){


							$Cgstamt= $amount[$j];
							$CgstRate= $af_rate[$j];
							
						}
						if($head_tax_ind[$j]=='IGST'){


							$Igstamt= $amount[$j];
							$IgstRate= $af_rate[$j];
							
						}
						

						
						//print_r($Sgstamt);
						$FLAG = 1;

						$GETMAXIDTD = DB::select("SELECT MAX(SBILLTID) AS SBTID FROM SBILL_TAX");

		     			$DATAGETMAXIDTD = json_decode(json_encode($GETMAXIDTD),true);

		     			$MDATAGETMAXIDTD = count($DATAGETMAXIDTD);

		     			if($MDATAGETMAXIDTD > 0) {
		     				
		     				$GETTID = $DATAGETMAXIDTD[0]['SBTID'] + 1;

		     			}else{

		     				$GETTID = 1;
		     			}

		     			$srNo =$j+1;
		
						$MDATA = array(

							'SBILLHID'   	=> $GETID,
							'SBILLBID'   	=> '',
							'SBILLTID'   	=> $GETTID,
							'TAXIND_CODE'   => $tax_ind_code[$j],
							'TAXIND_NAME'   => $head_tax_ind[$j],
							'RATE_INDEX'   	=> $rate_ind[$j],
							'TAX_RATE'    	=> $af_rate[$j],
							'TAX_AMT'    	=> $amount[$j],
							'TAX_LOGIC'    	=> $logicget[$j],
							'TAXGL_CODE'    => $tax_gl_code[$j],
							'TAXGL_NAME'    => '',
							'STATIC_IND'    => $staticget[$j],
							'FLAG'    		=> $FLAG,
							'CREATED_BY' 	=> $createdBy

						);

						DB::table('SBILL_TAX')->insert($MDATA);


						$indData = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->toArray();

					    $checkExist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->toArray();


					    if($amount[$j] != 0.00){

						if($rate_ind[$j] == 'Z'){}else{

							if(empty($checkExist)){

								$idary = array(
									'IND_CODE'    => $tax_ind_code[$j],
									'CR_AMT'      => $amount[$j],
									'IND_GL_CODE' => $series_gl,
									'REF_ACCCODE' => $acctCode,
									'REF_ACCNAME' => $acctName,
									'CREATED_BY'  => $createdBy,
									'TCFLAG'      => 'TBSB',
								);
								DB::table('INDICATOR_TEMP')->insert($idary);
							}else  if($tax_gl_code[$j] == ''){

								$bscVal = DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->toArray();
								$updateId = $bscVal[0]->CREATED_BY;
								$basicAmt = $bscVal[0]->CR_AMT + $amount[$j];
							
								$idary_bsic = array(
									'CR_AMT' 	  => $basicAmt,
								);

								DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$updateId)->where('TCFLAG','TBSB')->update($idary_bsic);

							}else if(empty($indData)){

									$idary   = array(
										'IND_CODE'    => $tax_ind_code[$j],
										'CR_AMT'      => $amount[$j],
										'IND_GL_CODE' => $tax_gl_code[$j],
										//'IND_GL_NAME' => $gl_name,
										'REF_ACCCODE' => $acctCode,
										'REF_ACCNAME' => $acctName,
										'CREATED_BY'  => $createdBy,
										'TCFLAG'      => 'TBSB',
										
									);
									DB::table('INDICATOR_TEMP')->insert($idary);
								}else{

									$indData1 = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->first();

									$newTaxAmt = $indData1->CR_AMT + $amount[$j];

									$idary1 = array(
										'CR_AMT' 	  => $newTaxAmt,
									);

									$updatevr = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->update($idary1);

								}
						} /* check 
						*/

					} /* chek amount is blank*/
					
			} //FOR LOOP END
		}

			
			$accData =  array(
						'IND_CODE'     => '',
						'DR_AMT'       => $NetAmnt,
						'IND_GL_CODE'  => $acc_glCode,
						'IND_GL_NAME'  => $acc_glName,
						'IND_ACC_CODE' => $acctCode,
						'IND_ACC_NAME' => $acctName,
						'REF_ACCCODE'  => $acctCode,
						'REF_ACCNAME'  => $acctName,
						'GLACC_Chk'    => 'ACC',
						'TCFLAG'       => 'TBSB',
						'CREATED_BY'   => $createdBy,
			);
			DB::table('INDICATOR_TEMP')->insert($accData);



			$ledgCount = DB::table('INDICATOR_TEMP')
					->select('INDICATOR_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')
	           		->leftjoin('MASTER_GL', 'INDICATOR_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
	            	->where('INDICATOR_TEMP.TCFLAG','TBSB')
	            	->where('INDICATOR_TEMP.CREATED_BY',$createdBy)
	            	->get()->toArray();
					//sale bill head
	            
	        $slno=1;
	        $srNo = 0;
			foreach ($ledgCount as $rows) {

				$BILL_NO = $FYEXP[0].'/'.$seriesCode.'/'.$newVr;

				$LRNO = implode(" ", $GETLR);

				$perticulerText = 'Against Bill - '.$BILL_NO.' Date - '.$tr_vr_date.' Bill Amount - '.$NetAmnt.' For LR '.$LRNO.' and Item - '.$jwitem_code.' - '.$jwitem_name;
				
				$blankVal='';

				$resultgl = (new AccountingController)->GlTEntry($compcode,$fyCode,$transCode,$seriesCode,$newVr,$slno,$tr_vr_date,$pfct_code[0],$rows->IND_GL_CODE,$rows->GL_NAME,$rows->REF_ACCCODE,$rows->REF_ACCNAME,$blankVal,$blankVal,$blankVal,$blankVal,$rows->DR_AMT,$rows->CR_AMT,$perticulerText,$createdBy);


           	    if($rows->GLACC_Chk == 'ACC'){

           	 	   $result = (new AccountingController)->AccountTEntry($compcode,$fyCode,$transCode,$seriesCode,$newVr,$slno,$tr_vr_date,$pfct_code[0],$rows->IND_ACC_CODE,$rows->IND_ACC_NAME,$acc_glCode,$acc_glName,$blankVal,$blankVal,$blankVal,$blankVal,$rows->DR_AMT,$rows->CR_AMT,$perticulerText,$createdBy);
           	 	}

           	 $slno++;
           	 $srNo++;
			}
			          

			          



				if($Sgstamt){
					$Sgst_amt = $Sgstamt;
					$SgstRate = $SgstRate;

				}else{
					$Sgst_amt ='0.00';
					$SgstRate = '';
				}

				if($Cgstamt){
					$Cgst_amt = $Cgstamt;
					$CgstRate = $CgstRate;
				}else{
					$Cgst_amt ='0.00';
					$CgstRate ='';
				}

				if($Igstamt){
					$Igst_amt = $Igstamt;
					$IgstRate = $IgstRate;
				}else{
					$Igst_amt ='0.00';
					$IgstRate ='';
				}



				DB::commit();

				$response_array['response'] = 'success';

				if($donwloadStatus == 1){

					$transCD='TRAN_SALE_BILL';
					$pdfPageName='TRANSPORTER SALE BILL';
					return $this->GeneratePdfForTranSaleBill($createdBy,$compcode,$plant_code,$flit_id,$fsoHid,$pdfPageName,$transCD,$lr_no,$rowCount,$isChkChecked,$NetAmnt,$Sgst_amt,$Cgst_amt,$Igst_amt,$gstTaxData,$SgstRate,$CgstRate,$IgstRate);

					/*transporter_code,transporter_name*/

					}else{}

			    $data = json_encode($response_array);
			    print_r($data);

		}catch(\Exception $e) {
		    DB::rollBack();
		    throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}

				//print_r($newVr);exit;

			

        	/* ------ /. END : VRNO CREATE OR GET FROM DB ------ */

  	}


  function simulationForTransSaleBill(Request $request){

    	if ($request->ajax()) {

			
			$createdBy       = $request->session()->get('userid');
			$acctCode        = $request->input('acctCode');
		    $acctName        = $request->input('acctName');
			$NetAmnt         = $request->input('NetAmnt');
			$head_tax_ind    = $request->input('head_tax_ind');
			$tax_ind_code    = $request->input('taxIndCode');
			$rate_ind        = $request->input('rate_ind');
			$amount          = $request->input('amount');
			$tax_gl_code     = $request->input('taxGlCode');
			$series_gl       = $request->input('series_gl');
			$acc_glCode      = $request->input('PostCode');
	    	$acc_glName      = $request->input('PostName');

	    	$head_tax_count = count($head_tax_ind);

	    	//print_r($head_tax_count);exit;

				$saveData ='';

				   DB::table('SIMULATION_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->delete();

				
					for ($j = 0; $j < $head_tax_count; $j++) {
						
						$indData = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->toArray();

					    $checkExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->toArray();


					    if($amount[$j] != 0.00){

						if($rate_ind[$j] == 'Z'){}else{

							if(empty($checkExist)){

								$idary = array(
									'IND_CODE'    => $tax_ind_code[$j],
									'CR_AMT'      => $amount[$j],
									'DR_AMT'      => 0.00,
									'IND_GL_CODE' => $series_gl,
									'CREATED_BY'  => $createdBy,
									'TCFLAG'      => 'TBSB',
								);
								DB::table('SIMULATION_TEMP')->insert($idary);
							}else  if($tax_gl_code[$j] == ''){

								$bscVal = DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->toArray();
								$updateId = $bscVal[0]->CREATED_BY;
								$basicAmt = $bscVal[0]->CR_AMT + $amount[$j];
							
								$idary_bsic = array(
									'CR_AMT' 	  => $basicAmt,
									'DR_AMT'      => 0.00,
								);

								DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$updateId)->where('TCFLAG','TBSB')->update($idary_bsic);

							}else if(empty($indData)){

									$idary   = array(
										'IND_CODE'    => $tax_ind_code[$j],
										'CR_AMT'      => $amount[$j],
										'DR_AMT'      => 0.00,
										'IND_GL_CODE' => $tax_gl_code[$j],
										//'IND_GL_NAME' => $gl_name,
										'CREATED_BY'  => $createdBy,
										'TCFLAG'      => 'TBSB',
										
									);
									DB::table('SIMULATION_TEMP')->insert($idary);
								}else{

									$indData1 = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->first();

									$newTaxAmt = $indData1->CR_AMT + $amount[$j];

									$idary1 = array(
										'CR_AMT' 	  => $newTaxAmt,
										'DR_AMT'      => 0.00,
									);

									$updatevr = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->update($idary1);

								}
						} /* check 
						*/

					} /* chek amount is blank*/
					
			} // for loop end 


			$accData =  array(
						'IND_CODE'     => '',
						'DR_AMT'       => $NetAmnt,
						'CR_AMT'       => 0.00,
						'IND_GL_CODE'  => $acc_glCode,
						'IND_ACC_CODE' => $acctCode,
						//'GLACC_Chk'    => 'ACC',
						'TCFLAG'       => 'TBSB',
						'CREATED_BY'   => $createdBy,
			);
			DB::table('SIMULATION_TEMP')->insert($accData);


			$taxData = DB::table('SIMULATION_TEMP')
					->select('SIMULATION_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME','MASTER_ACC.ACC_NAME')
	           		->leftjoin('MASTER_GL', 'SIMULATION_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
	           		->leftjoin('MASTER_ACC', 'SIMULATION_TEMP.IND_ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
	            	->where('SIMULATION_TEMP.TCFLAG','TBSB')
	            	->where('SIMULATION_TEMP.CREATED_BY',$createdBy)
	            	->get()->toArray();


	         /* echo '<pre>';

	          print_r($taxData);exit;

	          echo '</pre>';*/

    		if ($taxData) {

    			$response_array['response'] = 'success';
	            $response_array['data_tax'] = $taxData;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data_tax'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

		} /* /. ajax*/

    } /* ./ function close*/


    public function trpt_sale_bill_msg(Request $request,$saveData){

		if ($saveData == 'false') {
			
			$request->session()->flash('alert-error', 'Transporter Sale Bill Can Not Be Generated...!');
			return redirect('/transaction/Logistic/transporter-sale-bill');

		}else{

			$request->session()->flash('alert-success', 'Transporter Sale Bill Was Successfully Generated...!');
			return redirect('/transaction/Logistic/transporter-sale-bill');

		}
	}

   
/*job work sale bill*/

public function AddLocalTripEntry(Request $request)
    {
    	//print_r($this->data);exit;
		$title                      ='Local Trip Entry';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		//print_r($compcode);exit;
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T7'])->where(['COMP_CODE'=>$getcompcode])->get();
	
		$userdata['dept_list']      = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']     = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->get();
		
	//	$userdata['acc_list'] = DB::table('PORDER_HEAD')->groupBY('ACC_CODE')->get();
		$userdata['acc_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->groupBY('ACC_CODE')->get();
			//print_r($userdata['acc_list']);exit;

		$userdata['model_list']      = DB::table('MASTER_FLEET')->groupBY('MODEL')->get();

		$userdata['route_list']      = DB::table('MASTER_FREIGHT_ROUTE')->groupBY('TO_PLACE')->get();

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		

   		$requistion = DB::table('VEHICLE_GATE_INWARD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();
		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		   $tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T7')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='T7'");
			//print_r($vr_No_list);exit;
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

		    return view('admin.finance.transaction.logistic.local_trip_entry',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }

/* ----------- START : FREIGHT SALE QUOTATION -------------- */

	public function AddFreightSaleQuatation(Request $request){


		$title                        ='Freight Sale Quatation';
		
		$CompanyCode                  = $request->session()->get('company_name');
		$compcode                     = explode('-', $CompanyCode);
		$getcompcode                  =$compcode[0];
		$macc_year                    = $request->session()->get('macc_year');
		
		$userdata['comp_list']        = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']           = DB::table('MASTER_ACC')->where('ATYPE_CODE','D')->get();
		//DB::enableQueryLog();
		$userdata['series_list']      = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'S1'])->where(['COMP_CODE'=>$getcompcode])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']    = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();

		$userdata['do_excel_list']      = DB::table('MASTER_EXCELCONFIG')->where('EXLCONFIG_CODE','SO-IMP')->where('TRAN_CODE','SO')->groupBy('TRAN_CODE')->get();

		$userdata['columnlist']    = DB::table('MASTER_EXCELCONFIG')->where('EXLCONFIG_CODE','SO-IMP')->where('TRAN_CODE','SO')->get()->toArray();
		
		//DB::enableQueryLog();
		$userdata['dept_list']        = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']       = DB::table('MASTER_PLANT')->where(['COMP_CODE'=>$getcompcode])->get();
		$userdata['pfct_list']        = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']        = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']        = DB::table('MASTER_COST')->get();
		$userdata['emp_list']         = DB::table('MASTER_EMP')->get();
		
		$userdata['help_item_list']   = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']        = DB::table('MASTER_RATE_VALUE')->get();
		
		$userdata['cost_list']        = DB::table('MASTER_COST')->get();
		
		$userdata['area_list']        = DB::table('MASTER_AREA')->get();

		$userdata['route_list']        = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('ROUTE_CODE')->get();

		$userdata['um_list']        = DB::table('MASTER_UM')->get();
		
		$userdata['vehicletype_list'] = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();
		$userdata['freightType_list'] = DB::table('MASTER_FREIGHTTYPE')->get();

		// $userdata['do_excel_list']      = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE','DO')->groupBy(['TRAN_CODE','EXLCONFIG_CODE'])->get();
		//print_r($userdata['vehicletype_list']);exit;

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

			//print_r(expression)
			//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','S1')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
		

		if(isset($CompanyCode)){

		    return view('admin.finance.transaction.logistic.freight_sale_quatation',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       
    }

    public function SaveFreightSaleQuatation(Request $request){

    	$donwloadStatus   = $request->input('pdfYesNoStatus');
    	$createdBy        = $request->session()->get('userid');
    	$CompanyCode      = $request->session()->get('company_name');
    	$compcode         = explode('-', $CompanyCode);
    	$getcompcode      =	$compcode[0];
    	$fisYear          = $request->session()->get('macc_year');
    	$comp_nameval     = $request->input('comp_name');
    	$fy_year          = $request->input('fy_year');
    	$pfct_code        = $request->input('pfct_code');
    	$trans_code       = $request->input('trans_code');
    	$series_code      = $request->input('series_code');
    	$series_name      = $request->input('series_name');
    	$plant_name       = $request->input('plant_name');
    	$pfct_name        = $request->input('pfctNaame');
    	$NameRfone      = $request->input('InpNameOneRf');
    	$NameRftwo       = $request->input('rfInpnameTwo');
    	$NameRfthree       = $request->input('rfInpnameThree');
    	$NameRfFour       = $request->input('rfInpnameFour');
    	$NameRfFive       = $request->input('rfInpnameFive');
    	$vr_no            = $request->input('vr_no');
    	$trans_date       = $request->input('trans_date');
    	$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
    	$getduedate       = $request->input('getdue_date');
    	$dueDate          = date("Y-m-d", strtotime($getduedate));
    	$plant_code       = $request->input('plant_code');
    	$acc_code         = $request->input('AccCode');
    	$acc_name         = $request->input('AccName');
    	$freight_order_no = $request->input('FreightNo');
    	$route_code       = $request->input('route_code');
    	$route_name       = $request->input('route_name');
    	$frieghttypeCd    = $request->input('getfreightTypeCode');
    	$frieghtypeNm     = $request->input('getfreightTypeName');
    	$refno            = $request->input('getrefNo');
    	$ref_date         = $request->input('getrefDate');
    	$refdate          = date("Y-m-d", strtotime($ref_date));
    	$valid_frmdate    = $request->input('getvalidfrmDate');
    	$validfrmdate     = date("Y-m-d", strtotime($valid_frmdate));
    	$valid_todate     = $request->input('getvalidtoDate');
    	$validtodate      = date("Y-m-d", strtotime($valid_todate));
    	$from_place       = $request->input('from_place');
    	$to_place         = $request->input('to_place');
    	$vehicle_type     = $request->input('vehicle_type');
    	$vehicleTypeName     = $request->input('vehicleTypeName');
    	$rate_basis       = $request->input('rate_basis');
    	$rate             = $request->input('rate');
    	$qty              = $request->input('qty');

    	$unit_M           = $request->input('unit_M');
    	$count            = count($vehicle_type);

    	$importExcel      = $request->input('importExcel');


    	DB::beginTransaction();
    	try {
    		DB::commit();

    		$StoreH = DB::select("SELECT MAX(FSQHID) as FSQHID  FROM FSQ_HEAD");
    		$headID = json_decode(json_encode($StoreH), true); 
//  print_r($headID);exit;

    		if(empty($headID[0]['FSQHID'])){
    			$headId = 1;
    		}else{
    			$headId = $headID[0]['FSQHID']+1;
    		}

    		if($vr_no == ''){
    			$vrNum = 1;
    		}else{
    			$vrNum = $vr_no;
    		}


    		$vrno_Exist = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('LAST_NO',$vrNum)->get()->toArray();

    		if($vrno_Exist){
    			$NewVrno = $vrno_Exist[0]->LAST_NO +1;
    		}else{
    			$NewVrno = $vrNum;
    		}

    		$datahead = array(

    			'COMP_CODE'        =>$getcompcode,
    			'FY_CODE'          =>$fisYear,
    			'FSQHID'           =>$headId,
    			'TRAN_CODE'        =>$trans_code,
    			'SERIES_CODE'      =>$series_code,
    			'SERIES_NAME'      =>$series_name,
    			'PFCT_CODE'        =>$pfct_code,
    			'PFCT_NAME'        =>$pfct_name,
    			'VRNO'             =>$NewVrno,
    			'VRDATE'           =>$tr_vr_date,
    			'PLANT_CODE'       =>$plant_code,
    			'PLANT_NAME'       =>$plant_name,
    			'ACC_CODE'         =>$acc_code,
    			'ACC_NAME'         =>$acc_name,
    			'FREIGHTTYPE_CODE' =>$frieghttypeCd,
    			'FREIGHTTYPE_NAME' =>$frieghtypeNm,
    			'REF_NO'           =>$refno,
    			'REF_DATE'         =>$refdate,
    			'VALID_FROM_DT'    =>$validfrmdate,
    			'VALID_TO_DT'      =>$validtodate,
    			'RFHEAD1'          =>$NameRfone,
    			'RFHEAD2'          =>$NameRftwo,
    			'RFHEAD3'          =>$NameRfthree,
    			'RFHEAD4'          =>$NameRfFour,
    			'RFHEAD5'          =>$NameRfFive,
    			'CREATED_BY'       =>$createdBy,

    		);

    		$saveData = DB::table('FSQ_HEAD')->insert($datahead);

    		$lastid= DB::getPdo()->lastInsertId();

    		$discriptn_page = "Freight Sale Quatation insert done by user";



    		for ($i = 0; $i < $count; $i++) {

    			$StoreB = DB::select("SELECT MAX(FSQBID) as FSQBID FROM FSQ_BODY");

    			$bodyID = json_decode(json_encode($StoreB), true); 

    			if(empty($bodyID[0]['FSQBID'])){
    				$bodyId = 1;
    			}else{
    				$bodyId = $bodyID[0]['FSQBID']+1;
    			}

    			$data_body = array(

    				'FSQHID'       =>$headId,
    				'FSQBID'       =>$bodyId,
    				'COMP_CODE'    =>$getcompcode,
    				'FY_CODE'      =>$fisYear,
    				'PFCT_CODE'    =>$pfct_code,
    				'TRAN_CODE'    =>$trans_code,
    				'SERIES_CODE'  =>$series_code,
    				'VRNO'         =>$NewVrno,
    				'SLNO'         =>$i+1,
    				'ACC_CODE'     =>$acc_code,
    				'ACC_NAME'     =>$acc_name,
    				'ROUTE_CODE'   =>$route_code[$i],
    				'ROUTE_NAME'   =>$route_name[$i],
    				'FROM_PLACE'   =>$from_place[$i],
    				'TO_PLACE'     =>$to_place[$i],
    				'VEHICLE_TYPE' =>$vehicle_type[$i],
    				'VEHICLE_TYPE_NAME' =>$vehicleTypeName[$i],
    				'RATE_BASIS'   =>$rate_basis[$i],
    				'RATE'         =>$rate[$i],
    				'CREATED_BY'   =>$createdBy,

    			);


    			$saveData1 = DB::table('FSQ_BODY')->insert($data_body);


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
					'CREATED_BY'  =>$userId,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);

			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();
    		$data1['response'] = 'success';

    		if($donwloadStatus == 1){

    			return $this->GeneratePdfForFSQSlip($getcompcode,$fisYear,$createdBy,$headId,$acc_code);

    		}else{

    		}

    		$getalldata = json_encode($data1);  
    		print_r($getalldata);

    	}catch (\Exception $e) {

    		DB::rollBack();
    		//throw $e;
    		$data1['response'] = 'error';
    		$getalldata = json_encode($data1);  
    		print_r($getalldata);
    	}


    }

    public function freight_fsq_msg(Request $request,$saveData){

    	// print_r('hello');
    	// exit();

		if ($saveData==true) {

			$request->session()->flash('alert-success', 'Freight Quatation Was Successfully Added...!');
			return redirect('/Transaction/Logistic/view-freight-sale-Quatation');

		}else{

			$request->session()->flash('alert-error', 'Freight Quatation Can Not Added...!');
			return redirect('/Transaction/Logistic/view-freight-sale-Quatation');

		}
	}

	public function viewFreightSaleQuatation(Request $request){
    		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

			$title       ='View Freight Sale Quatation';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	        
           
	        $data = DB::table('FSQ_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->get();
            	

	        }else if($userType=='superAdmin' || $userType=='user'){

	           $data = DB::table('FSQ_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->get();

	        }
	        else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	       return view('admin.finance.transaction.logistic.view_freight_sale_quatation');
	    }else{
			return redirect('/useractivity');
		}
    }

    public function viewChildFreightSaleQuatation(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$delivery_order = DB::table('FSQ_BODY')->where('FSQHID', $headid)->where('VRNO', $vrno)->get()->toArray();
	    	

    		if($delivery_order) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $delivery_order;
	         

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

    public function offlineFSQLsPDF(Request $request){
	
		$createdBy   = $request->session()->get('userid');
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$fisYear       =  $request->session()->get('macc_year');
		$headId     = $request->input('fsqid');
		$acc_code     = $request->input('acc_code');

		return $this->GeneratePdfForFSQSlip($getcompcode,$fisYear,$createdBy,$headId,$acc_code);

	}

	public function GeneratePdfForFSQSlip($comp_code,$fisYear,$userId,$hid,$acc_code){

		$titleName = 'FREIGHT SALE QUOTATION';

		$response_array = array();

		//DB::enableQueryLog();
		$dataheadB = DB::SELECT("SELECT H.FSQHID As FSQHID, H.FY_CODE As FY_CODE,H.COMP_CODE AS COMP_CODE,H.VRNO AS VRNO,H.REF_NO AS REF_NO,H.RFHEAD1 AS RFHEAD1,H.RFHEAD2 AS RFHEAD2,H.RFHEAD3 AS RFHEAD3,H.RFHEAD4 AS RFHEAD4,H.RFHEAD5 AS RFHEAD5, H.REF_DATE AS REF_DATE,H.VALID_FROM_DT AS VALID_FROM_DT, H.VALID_TO_DT AS VALID_TO_DT,H.TRAN_CODE,  B.COMP_NAME AS COMP_NAME,B.FY_CODE As FY_CODE, B.FROM_PLACE  AS FROM_PLACE, B.TO_PLACE AS TO_PLACE, B.VEHICLE_TYPE AS VEHICLE_TYPE,B.VEHICLE_TYPE_NAME,B.RATE As RATE, B.RATE_BASIS AS RATE_BASIS,B.FY_CODE AS FY_CODE,B.SERIES_CODE AS SERIES_CODE,H.VRDATE AS VRDATE FROM FSQ_HEAD H 
			INNER JOIN FSQ_BODY B ON H.FSQHID = B.FSQHID 
			WHERE H.COMP_CODE = '$comp_code' AND H.FSQHID = '$hid'");

		$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$acc_code'");

		//dd(DB::getQueryLog());
		 $tranCode = $dataheadB[0]->TRAN_CODE;
		 $seriesCode = $dataheadB[0]->SERIES_CODE;
		
		$configData = DB::select("SELECT * FROM MASTER_CONFIG WHERE COMP_CODE='$comp_code' AND TRAN_CODE='$tranCode' AND SERIES_CODE='$seriesCode'");
		
		$compDetail = DB::SELECT("SELECT B.COMP_NAME,B.COMP_CODE,B.LOGO,B.ADD1,B.ADD2,B.ADD3,B.CITY,B.DIST,B.STATE,B.PIN_CODE,B.PHONE1,B.PHONE2 FROM MASTER_COMP B WHERE B.COMP_CODE='$comp_code'");

		// print_r($compDetail);
		//  exit();

		header('Content-Type: application/pdf');

		$pdf = PDF::loadView('admin.finance.transaction.logistic.sale_fright_qtn_pdf',compact('compDetail','dataheadB','configData','titleName','dataAccDetail'));
		
		$path        = public_path('dist/TripPdf'); 
		$fileName    =  time().'.'. 'pdf' ;
		$pdf->save($path . '/' . $fileName);
		$PublicPath  = url('public/dist/TripPdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url']      = $downloadPdf;
		$response_array['data']     = $dataheadB;
		echo $data = json_encode($response_array);

		// $pdf = PDF::loadView('admin.finance.transaction.candf.tripPlanloadingSlipPDF'));

	}

/* ----------- END : FREIGHT SALE QUOTATION -------------- */
/* -----------  FREIGHT SALE ORDER EXCEL BUTTON -------------- */
public function ViewFreightOrderDetailsExcel(Request $request,$fsoid){
           
    	date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];
        
	      $company_name = $request->session()->get('company_name');
		  $getcomcode   = explode('-', $company_name);
		  $comp_code    = $getcomcode[0];
		  $macc_year    = $request->session()->get('macc_year');
	  	  $db_name      = $request->session()->get('dbName');
	  	   
		  	$dt    = date("Y-m-d");
		    $expd  = explode('-',$dt);
		    $y     = $expd[0];
		    $m     = $expd[1];
		    $d     = $expd[2];
		    $num   =  rand(10,10000);
	  	    $fileName = 'FREIGHT_SALE_ORDER'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
             
            public_path('/dist/report_excel/' . $fileName);
         
	       $response = Excel::download(new FreightSaleOrderExport($fsoid),$fileName, null,[\Maatwebsite\Excel\Excel::XLS]);
            ob_end_clean();

    	return $response; 
    }
    /* -----------  FREIGHT SALE ORDER EXCEL BUTTON -------------- */

    public function getDatafreightsale(Request $request){
    	
       $companyFull    = $request->session()->get('company_name');

	   $fisYear        = $request->session()->get('macc_year');
	   $splitComp      = explode('-', $companyFull);
       $comp_code      = $splitComp[0];
	   $response_array = array();
	   $response_array = array(); 
	   $fsqHeadid      = $request->input('fsqHeadid');  
	   $customercode   = $request->input('customercode');  
	   $fieldType      = $request->input('fieldType');  
	   //$customercode       = $request->input('AccCode'); 

	  	$quotationdetails ='';
	  	$fsqNoList ='';
      if ($request->ajax()) {

      	if($fieldType == 'ACCOUNTNO'){
      		$fsqNoList = DB::select("SELECT * FROM FSQ_HEAD WHERE ACC_CODE='$customercode'");
      	}else if($fieldType == 'saleQuoNo'){
      		$quotationdetails = DB::select("SELECT B.*,H.REF_NO,H.REF_DATE,H.VALID_FROM_DT,H.VALID_TO_DT FROM FSQ_BODY B,FSQ_HEAD H WHERE B.FSQHID=H.FSQHID AND B.FSQHID='$fsqHeadid'");
      	}
				
				if ($quotationdetails || $fsqNoList) {
	              
					$response_array['response'] = 'success';
					$response_array['dataquotation']  = $quotationdetails;
					$response_array['data_fsqNoList']  = $fsqNoList;
		            $data = json_encode($response_array);
		            print_r($data);

				}else{

					$response_array['response'] = 'error';
					$response_array['dataquotation'] = '' ;
					$response_array['data_fsqNoList'] = '' ;
		            $data = json_encode($response_array);
		            print_r($data);
				}	
				
		        
	    }

    }


    public function tripChangeDest(Request $request){

        $title = "Trip Change Destination";
       
		$company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $comp_code = $getcomcode[0];
        $comp_name = $getcomcode[1];
        // print_r($comp_code);

        $TranCode = 'T0';
        $Tran_Code2 = '';

        $functionData = $this->CommonFunction($macc_year,$comp_code,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $fyYear_info = DB::table('MASTER_FY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->get()->first();

		$userdata['dorder_list']  = DB::table('TRIP_BODY')->where('COMP_CODE',$comp_code)->groupBy('DO_NO')->get();
		$userdata['invcno_list']  = DB::table('TRIP_BODY')->where('COMP_CODE',$comp_code)->groupBy('INVC_NO')->get();
		$userdata['delno_list']  = DB::table('TRIP_BODY')->where('COMP_CODE',$comp_code)->groupBy('DELIVERY_NO')->get();
		$userdata['lr_list']      = DB::table('TRIP_BODY')->where('COMP_CODE',$comp_code)->groupBy('LR_NO')->get();
		$userdata['acc_list']    = DB::table('DORDER_BODY')->where('COMP_CODE',$comp_code)->groupBy('ACC_CODE')->get();
		$userdata['toplace_list']    = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('TO_PLACE')->get();
		$userdata['dorder_vrno']  = DB::table('DORDER_HEAD')->get();

        if(isset($company_name)){

            return view('admin.finance.transaction.logistic.trip_change_dest',$userdata+compact('title','fyYear_info'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function tripDestChange(Request $request){

    	 if($request->ajax()) {



            if (!empty($request->acc_code || $request->lr_no  || $request->invc_no || $request->dorder_no || $request->oldToPlace)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                if(isset($request->acc_code)  && trim($request->acc_code)!=""){
                    
                    $strWhere .= " AND  B.ACC_CODE = '$request->acc_code'";
                }

                if(isset($request->lr_no)  && trim($request->lr_no)!=""){
                    
                    $strWhere .= " AND  B.LR_NO = '$request->lr_no'";
                }

                if(isset($request->invc_no)  && trim($request->invc_no)!=""){
                    
                    $strWhere .= " AND  B.INVC_NO = '$request->invc_no'";
                }

                if(isset($request->dorder_no)  && trim($request->dorder_no)!=""){
                    
                    $strWhere .= " AND B.DO_NO = '$request->dorder_no'";
                }

                if(isset($request->oldToPlace)  && trim($request->oldToPlace)!=""){
                    
                    $strWhere .= " AND B.TO_PLACE = '$request->oldToPlace'";
                }

                //DB::enableQueryLog();
                //print_r($strWhere);exit;

                $data = DB::select("SELECT H.ACC_CODE,H.VRDATE,H.PLANT_CODE,H.PLANT_NAME,H.TRAN_CODE,H.TRAN_CODE,H.TRAN_CODE,H.PFCT_CODE,H.PFCT_NAME,H.SERIES_CODE,H.SERIES_NAME,H.FROM_PLACE AS FROMPLACE,H.TO_PLACE AS TOPLACE,H.VEHICLE_NO AS VEHICLENO ,B.* FROM TRIP_HEAD H,TRIP_BODY B WHERE 1=1 $strWhere AND H.TRIPHID=B.TRIPHID AND H.TSALEBILL_STATUS='0'");

                	/*$data = DB::select("SELECT DORDER_HEAD.VRDATE,DORDER_HEAD.PLANT_CODE,DORDER_HEAD.PLANT_NAME,DORDER_HEAD.TRAN_CODE,DORDER_HEAD.PFCT_CODE,DORDER_HEAD.PFCT_NAME,DORDER_HEAD.SERIES_CODE,DORDER_HEAD.SERIES_NAME,DORDER_HEAD.ROUTE_CODE,DORDER_HEAD.ROUTE_NAME,DORDER_HEAD.DO_STATUS,DORDER_BODY.* FROM DORDER_HEAD LEFT JOIN DORDER_BODY ON DORDER_HEAD.DORDERHID = DORDER_BODY.DORDERHID  WHERE 1=1 $strWhere  AND  DORDER_HEAD.DO_STATUS = '0' AND (DORDER_BODY.QTY - DORDER_BODY.DISPATCH_PLAN_QTY - DORDER_BODY.CANCEL_QTY) > 0.000");*/

                //dd(DB::getQueryLog());

                
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


  public function tripChangeDestination(Request $request){

		$company_name = $request->session()->get('company_name');
		$getcomcode   = explode('-', $company_name);
		$compCode     = $getcomcode[0];
		$fisYear      = $request->session()->get('macc_year');
		$accCode      = $request->input('acc_code');
		$lr_no        = $request->input('lr_no');
		$invc_no      = $request->input('invc_no');
		$delivery_no  = $request->input('dorder_no');
		$to_place     = $request->input('to_place');
		$oldto_place  = $request->input('oldto_place');
	
		$response_array = array();

		/*echo "<pre>";
		print_r($accCode);
		echo "<pre>";

		print_r($doNo);
		echo "<pre>";
		print_r($custNo);
		echo "<pre>";
		print_r($to_place);exit;*/
		

		if($request->ajax()) {


			/*$data_body = array(

				'TO_PLACE'  => $to_place
			);*/

			//DB::enableQueryLog();

			/*$UpdateDo = DB::table('DORDER_BODY')->where('COMP_CODE',$compCode)->where('ACC_CODE',$accCode)->where('CP_CODE',$custNo)->where('DORDER_NO',$doNo)->update($data_body);*/
			
			$UpdateDo = DB::update("UPDATE TRIP_HEAD H,TRIP_BODY B SET H.TO_PLACE='$to_place' WHERE H.TRIPHID=B.TRIPHID AND B.ACC_CODE='$accCode' AND LR_NO='$lr_no' AND B.INVC_NO='$invc_no' AND B.DELIVERY_NO='$delivery_no'  AND H.TO_PLACE='$oldto_place'");

			if($UpdateDo){

	      			$response_array['response'] = 'success';
	      			$data = json_encode($response_array);  
			        print_r($data);

	            }else{

	            	$response_array['response'] = 'error';
	      			$data = json_encode($response_array);  
			        print_r($data);
	            }
		}

		     

}


public function offlineLRAckReceiptPDF(Request $request){
	
		$createdBy   = $request->session()->get('userid');
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$fisYear       =  $request->session()->get('macc_year');
		$customer_code = $request->input('AccCode');
		$tripid       = $request->input('tripId');
		


		$headtable    = 'TRIP_HEAD';
		$bodytable    = 'TRIP_BODY';
	    $penaltytable = 'TRIP_CHARGE_EXP';
		$columnheadid = 'TRIPHID';
		$pdfPageName  = 'LR ACKNOLEDGMENT';
		$vrNoPname    = 'Slip No';

		return $this->GeneratePdfForLrAck($createdBy,$getcompcode,$tripid,$headtable,$bodytable,$penaltytable,$columnheadid,$pdfPageName,$vrNoPname,$customer_code);

	

	}

	public function GeneratePdfForLrAck($userId,$getcom_code,$tripid,$headtable,$bodytable,$penaltytable,$columnheadid,$pdfPageName,$vrNoPname,$customer_code){

		$response_array = array();

		//print_r($reftrip_no);exit;


		$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$customer_code'");

		$compDetail =  DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$getcom_code'");
		//$pumpDetail =  DB::SELECT("SELECT P.* FROM $pmttable P  WHERE P.$columnheadid='$tripid'");
		$deductionDetails =  DB::SELECT("SELECT E.* FROM $penaltytable E  WHERE E.$columnheadid='$tripid' AND E.INDEX_NAME='M'");

		$addDetails =  DB::SELECT("SELECT E.* FROM $penaltytable E  WHERE E.$columnheadid='$tripid' AND E.INDEX_NAME='L'");

		//$expRoute =  DB::SELECT("SELECT R.* FROM TRIP_EXPENSE_ROUTE R  WHERE R.$columnheadid='$tripid'");

		$dataheadB = DB::SELECT("SELECT t1.*,t2.DO_NO,t2.DO_DATE,t2.ITEM_CODE,t2.ITEM_NAME,t2.QTY,SUM(t2.QTY) AS GROSS_QTY,t2.LR_NO,t2.NET_WEIGHT,t2.SHORTAGE_QTY,'$headtable' as tableName FROM $headtable t1 LEFT JOIN $bodytable t2 ON t2.$columnheadid = t1.$columnheadid WHERE t1.$columnheadid='$tripid'");

		$transporter = $dataheadB[0]->TRANSPORT_CODE;

		$transpoterDetails =  DB::SELECT("SELECT A.PAN_NO,B.CITY_NAME,A.ACC_NAME FROM MASTER_ACC A, MASTER_ACCADD B WHERE A.ACC_CODE=B.ACC_CODE AND A.ACC_CODE='$transporter'");


		//print_r($dataheadB);exit;


		header('Content-Type: application/pdf');
     
    	$pdf = PDF::loadView('admin.finance.transaction.logistic.lr_acknoledgment_pdf',compact('dataheadB','dataAccDetail','deductionDetails','compDetail','vrNoPname','addDetails','transpoterDetails'));

    	$path = public_path('dist/downloadpdf'); 
    	$fileName =  time().'.'. 'pdf' ; 
    	$pdf->save($path . '/' . $fileName);
    	$PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['data'] = $dataheadB;
        echo $data = json_encode($response_array);

		

		//$this->ConvertAmountIntoWord($dataheadB,,$dataAccDetail,$compDetail,$vrNoPname);

	}

}
