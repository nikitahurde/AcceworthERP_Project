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
use PDF;
use App\Http\Controllers\AccountingController;

class ColdStorageTransController extends Controller{

	public function __construct(){
	
	}

	/* ----------- DEMO CODE ------------- */

	public function demoCode(Request $request){

		//$myfile = fopen("testfile.txt", "w");
		$content = "some text here";
		//print_r($_SERVER['DOCUMENT_ROOT'].'/biztechERP_DEV');exit;
		$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/biztechERP_DEV' . "/myText.txt","wb");
		$file = 'myText.txt';
		fwrite($fp,$content);
		fclose($fp);

		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		header("Content-Type: text/plain");
		readfile($file);

	}

	/* ----------- DEMO CODE ------------- */

	public function AllTableName(Request $request,$tranCode){

		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$getTBLData['comp_list']         = DB::table('MASTER_COMP')->get();

		$getTBLData['fy_list']           = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();
		$getTBLData['acc_list']          = DB::table('MASTER_ACC')->get();
		$getTBLData['series_list']       = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>$tranCode,'COMP_CODE'=>$getcompcode])->get();
		$getTBLData['plant_list']        = DB::table('MASTER_PLANT')->where('COMP_CODE',$getcompcode)->get();
		$getTBLData['item_list']         = DB::table('MASTER_ITEM')->get();
		$getTBLData['truck_list']        = DB::table('MASTER_FLEET')->get();
		$getTBLData['coldStorage_list']  = DB::table('MASTER_COLD_STORAGE')->where('COMP_CODE',$getcompcode)->get();
		$getTBLData['chamber_list']      = DB::table('MASTER_CHAMBER')->get();
		$getTBLData['floor_list']        = DB::table('MASTER_FLOOR_STORAGE')->get();
		$getTBLData['block_list']        = DB::table('MASTER_BLOCK_STORAGE')->get();
		$getTBLData['tran_list']         = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$tranCode)->get()->first();
		$getTBLData['customer_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','D')->get();
		$getTBLData['itemPack_list']     = DB::table('MASTER_ITEM_PACKING')->get();
		$getTBLData['vehicleEntry_list'] = DB::table('CS_GATE_ENTRY')->get();
		$getTBLData['tax_list'] = DB::table('MASTER_TAX')->get();
		$getTBLData['ratval_list']   =DB::table('MASTER_RATE_VALUE')->get()->toArray();

		return $getTBLData;
	}

	public function GenerateQRCode(Request $request){

		
  		return view('admin.finance.transaction.coldStorage.qrCode');

	}

/* ----------- START : ORDER PLAN TRANSACTION ------------- */
	
	public function AddOrderPlanCS(Request $request){

		$CompanyData = $request->session()->get('company_name');
		$spliData    = explode('-', $CompanyData);
		$compcode    = $spliData[0];
		$compname    = $spliData[1];
		$fisYear     = $request->session()->get('macc_year');
		$request     = $request;
		$title       = 'Order Plan';
		$tranCode    = '';
		$allTblName  = $this->AllTableName($request,$tranCode);

		$userdata['customerlist']    = $allTblName['customer_list'];
		$userdata['plantList']       = $allTblName['plant_list'];
		$userdata['accList']         = $allTblName['acc_list'];
		$userdata['itemList']        = $allTblName['item_list'];
		$userdata['coldStorageList'] = $allTblName['coldStorage_list'];
		$fyList                      = $allTblName['fy_list'];
		
		foreach ($fyList as $key) {
          $userdata['fromDate'] =  $key->FY_FROM_DATE;
          $userdata['toDate']   =  $key->FY_TO_DATE;
      	}

      	if(isset($CompanyData)){

	    	return view('admin.finance.transaction.coldStorage.add_order_plan',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}
       
    }


    public function SaveOrderPlanCS(Request $request){

		$compName     = $request->session()->get('company_name');
		$explodeData  = explode('-',$compName);
		$comp_Code    = $explodeData[0];
		$comp_Name    = $explodeData[1];
		$fisYear      =  $request->session()->get('macc_year');
		$createdBy    = $request->session()->get('userid');
		$rowCount     = $request->input('rowCount');
		$itemcodeb    = $request->input('item_code');
		$cold_Storage = $request->input('cold_Storage');
		$chamber_code = $request->input('chamber_code');
		$floor_code   = $request->input('floor_code');
		$block_code   = $request->input('block_code');
		$qunatity     = $request->input('qunatity');
		$umCode       = $request->input('umCode');

    	$csPlanH = DB::select("SELECT MAX(CSPHID) as CSPHID FROM CS_PLAN_HEAD");
		$headID = json_decode(json_encode($csPlanH), true); 
	
		if(empty($headID[0]['CSPHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['CSPHID']+1;
		}

		DB::beginTransaction();

		try {

			$data = array(

				'CSPHID'       => $head_Id,
				'COMP_CODE'    => $comp_Code,
				'COMP_NAME'    => $comp_Name,
				'FY_CODE'      => $fisYear,
				'VRDATE'       => date("Y-m-d", strtotime($request->input('vr_date'))),
				'ACC_CODE'     => $request->input('acc_code'),
				'ACC_NAME'     => $request->input('acc_name'),
				'ITEM_CODE'    => $request->input('itemcode'),
				'ITEM_NAME'    => $request->input('item_name'),
				'PACKING_CODE' => $request->input('packing_code'),
				'PACKING_NAME' => $request->input('packing_name'),
				'QTY'          => $request->input('qty'),
				'PLANT_CODE'   => $request->input('plant_code'),
				'PLANT_NAME'   => $request->input('plant_name'),
				'PFCT_CODE'    => $request->input('pfct_code'),
				'PFCT_NAME'    => $request->input('pfct_name'),
				'CREATED_BY'   => $createdBy,

			);

			DB::table('CS_PLAN_HEAD')->insert($data);

			for($i = 0; $i <count($rowCount);$i++){

				$csPlanB = DB::select("SELECT MAX(CSPBID) as CSPBID FROM CS_PLAN_BODY");
				$bodyID = json_decode(json_encode($csPlanB), true); 
			
				if(empty($bodyID[0]['CSPBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['CSPBID']+1;
				}	

				$slno = $i + 1;

				$splititemCD    = explode('[', $itemcodeb[$i]);
				$splitcoldstore = explode('[', $cold_Storage[$i]);
				$splitchamber   = explode('[', $chamber_code[$i]);
				$splitfloor     = explode('[', $floor_code[$i]);
				$splitblock     = explode('[', $block_code[$i]);

				$bodyData = array(

					'CSPHID'       => $head_Id,
					'CSPBID'       => $body_Id,
					'COMP_CODE'    => $comp_Code,
					'FY_CODE'      => $fisYear,
					'SLNO'         => $slno,
					'ITEM_CODE'    => $splititemCD[0],
					'ITEM_NAME'    => trim(substr_replace($splititemCD[1], "", -1)),
					'CS_CODE'      => $splitcoldstore[0],
					'CS_NAME'      => trim(substr_replace($splitcoldstore[1], "", -1)),
					'CHAMBER_CODE' => $splitchamber[0],
					'CHAMBER_NAME' => trim(substr_replace($splitchamber[1], "", -1)),
					'FLOOR_CODE'   => $splitfloor[0],
					'FLOOR_NAME'   => trim(substr_replace($splitfloor[1], "", -1)),
					'BLOCK_CODE'   => $splitblock[0],
					'BLOCK_NAME'   => trim(substr_replace($splitblock[1], "", -1)),
					'QTY'          => $qunatity[$i], 
					'UM'           => $umCode[$i], 
					'CREATED_BY'   => $createdBy
				);
				
				DB::table('CS_PLAN_BODY')->insert($bodyData);

				/* ------ UPDATE PLAN QTY IN CS BALENCE ------ */

					$getPlaneSpace = DB::table('CS_BALENCE')->where('COMP_CODE',$comp_Code)->where('CS_CODE',$splitcoldstore[0])->where('CHAMBER_CODE',$splitchamber[0])->where('FLOOR_CODE',$splitfloor[0])->where('BLOCK_CODE',$splitblock[0])->get()->first();

	    			$balenceSpace = $getPlaneSpace->STORAGE_CAPACITY - $qunatity[$i] - $getPlaneSpace->USED_SPACE;

					$dataSpace = array(
						"PLAN_SPACE"    => $qunatity[$i],
						"BALANCE_SPACE" => $balenceSpace,
						
					);
					DB::table('CS_BALENCE')->where('COMP_CODE',$comp_Code)->where('CS_CODE',$splitcoldstore[0])->where('CHAMBER_CODE',$splitchamber[0])->where('FLOOR_CODE',$splitfloor[0])->where('BLOCK_CODE',$splitblock[0])->update($dataSpace);
				/* ------ UPDATE PLAN QTY IN CS BALENCE ------ */

			} /* /. FOR LOOP*/

			DB::commit();

			$data1['response'] = 'success';
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

    public function order_plan_savemsgCS(Request $request,$saveData){

		if ($saveData == 'false') {
			
			$request->session()->flash('alert-error', 'Order Plan Can Not Added...!');
			return redirect('/transaction/ColdStorage/view-order-plan-transaction');

		}else{

			$request->session()->flash('alert-success', 'Order Plan Was Successfully Added...!');
			return redirect('/transaction/ColdStorage/view-order-plan-transaction');

		}
	}

	public function ViewOrderPlanCS(Request $request){

    	$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

			$title       ='View Order Plan';
			$userid      = $request->session()->get('userid');
			$userType    = $request->session()->get('usertype');
			$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode = $compcode[0];
			$fisYear     =  $request->session()->get('macc_year');

	        if($userType=='admin' || $userType=='Admin'){

	        	$data = DB::table('CS_PLAN_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get();

	        }else if($userType=='superAdmin' || $userType=='user'){

          		$data = DB::table('CS_PLAN_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get();
	        }else{
	            $data='';
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	     
	       return view('admin.finance.transaction.coldStorage.view_order_plan');
	    }else{
			return redirect('/useractivity');
		}
    }

    public function ViewChildOrderPlanTrans(Request $request){

		$response_array = array();

		if ($request->ajax()) {

		   	$headid = $request->input('tblid');

	    	$OrderPlan = DB::table('CS_PLAN_BODY')->where('CSPHID', $headid)->get()->toArray();
	    	
    		if($OrderPlan) {

				$response_array['response'] = 'success';
				$response_array['data']     = $OrderPlan;
	         
	            echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
				$response_array['data']     = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

				$response_array['response'] = 'error';
				$response_array['data']     = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

/* ----------- END : ORDER PLAN TRANSACTION ------------- */

/* ------------- START : GATE INWARD TRANSACTION ------------- */

	public function AddGateInward(Request $request){

		$title      ='Add Gate Inward Master';
		$compName   = $request->session()->get('company_name');
		$tranCode   = 'C1';
		$allTblName = $this->AllTableName($request,$tranCode);
		$userdata['plantList']  = $allTblName['plant_list'];
		$userdata['seriesList'] = $allTblName['series_list'];
		$userdata['tranlist']   = $allTblName['tran_list'];

		foreach ($allTblName['fy_list'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}
		
		if(isset($compName)){

	    	return view('admin.finance.transaction.coldStorage.add_gate_inward',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function SaveGateInward(Request $request){


		$validate = $this->validate($request, [

			'datetime'       => 'required',
			'vehicle_number' => 'required|max:20',
			'trans_code'     => 'required',
			'series_code'    => 'required',
			'series_name'    => 'required',
			'vrseqnum'       => 'required',
			'plant_code'     => 'required',
			'plant_name'     => 'required',
			'pfct_code'      => 'required',
			'pfct_name'      => 'required',
			'driver_name'    => 'required|max:40',
			'driver_id'      => 'required|max:10',
			'mobile_number'  => 'required|max:10',
			'vehicle_type'   => 'required',

		]);

		$createdBy   = $request->session()->get('userid');
		$compName    = $request->session()->get('company_name');
		$explodeData = explode('-',$compName);
		$comp_Code   = $explodeData[0];
		$comp_Name   = $explodeData[1];
		$fisYear     =  $request->session()->get('macc_year');
		$vrno        = $request->input('vrseqnum');

		if($vrno == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrno;
		}

		$vrno_Exist = DB::table('CS_GATE_ENTRY')->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_Code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$request->input('trans_code'))->where('VRNO',$vrNum)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrNum +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {

			$data = array(
				"COMP_CODE"      => $comp_Code,
				"COMP_NAME"      => $comp_Name,
				"FY_CODE"        => $fisYear,
				"DATETIME"       => date("Y-m-d", strtotime($request->input('datetime'))),
				"VEHICLE_NUMBER" => $request->input('vehicle_number'),
				"TRAN_CODE"      => $request->input('trans_code'),
				"SERIES_CODE"    => $request->input('series_code'),
				"SERIES_NAME"    => $request->input('series_name'),
				"VRNO"           => $NewVrno,
				"PLANT_CODE"     => $request->input('plant_code'),
				"PLANT_NAME"     => $request->input('plant_name'),
				"PFCT_CODE"      => $request->input('pfct_code'),
				"PFCT_NAME"      => $request->input('pfct_name'),
				"DRIVER_NAME"    => $request->input('driver_name'),
				"DRIVER_ID"      => $request->input('driver_id'),
				"MOBILE_NUMBER"  => $request->input('mobile_number'),
				"VEHICLE_TYPE"   => $request->input('vehicle_type'),
				"CREATED_BY"     => $createdBy,
				
			);

			DB::table('CS_GATE_ENTRY')->insert($data);

			/*$discriptn_page = "Master vehicle entry type insert done by user";
			$this->userLogInsert($createdBy,$discriptn_page);*/

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('trans_code'))->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_Code)->where('FY_CODE',$fisYear)->get()->toArray();

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$comp_Code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$request->input('trans_code'),
					'SERIES_CODE' =>$request->input('series_code'),
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('trans_code'))->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_Code)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();

			$request->session()->flash('alert-success', 'Gate Inward Was Successfully Added...!');
			return redirect('/transaction/ColdStorage/View-gate-inward-transaction');

		}catch (\Exception $e) {

	        DB::rollBack();
	        //throw $e;
	        $request->session()->flash('alert-error', 'Gate Inward Can Not Added...!');
			return redirect('/transaction/ColdStorage/View-gate-inward-transaction');

	    }

	}

	public function ViewGateInward(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Gate Inward';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$companyData = $request->session()->get('company_name');
	    	$splitData = explode('-',$companyData);
	    	$comp_code = $splitData[0];

	    	$fisYear =  $request->session()->get('macc_year');

	    	$data = DB::table('CS_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('DATETIME','ASC');

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.transaction.coldStorage.view_gate_inward');
    	}else{
		 	return redirect('/useractivity');
	   }
    }

	public function EditGateInward(Request $request,$compCd,$fyCd,$tranCd,$seriesCd,$vrNo){

		$title                 = 'Edit Gate Inward Master';

		$allTblName            = $this->AllTableName($request,'');
		$userdata['plantList'] = $allTblName['plant_list'];

		foreach ($allTblName['fy_list'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$comp_cd   = base64_decode($compCd);
		$fy_Cd     = base64_decode($fyCd);
		$tran_Cd   = base64_decode($tranCd);
		$series_Cd = base64_decode($seriesCd);
		$vr_No     = base64_decode($vrNo);
    	
    	if(($comp_cd!='') && ($fy_Cd!='') && ($tran_Cd!='') && ($series_Cd!='') && ($vr_No!='')){
    	    $query = DB::table('CS_GATE_ENTRY');
			$query->where('COMP_CODE', $comp_cd)->where('FY_CODE', $fy_Cd)->where('TRAN_CODE', $tran_Cd)->where('SERIES_CODE', $series_Cd)->where('VRNO', $vr_No);
			$classData= $query->get()->first();
			
			return view('admin.finance.transaction.coldStorage.edit_gate_inward',$userdata+compact('title','classData'));
		}else{
			$request->session()->flash('alert-error', 'Gate Inward Not Found...!');
			return redirect('/transaction/ColdStorage/View-gate-inward-transaction');
		}

    }

    public function UpdateGateInward(Request $request){



		$vehicle_id = $request->input('vehicle_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$comp_cd   = $request->input('compCodehd');
		$fy_Cd     = $request->input('fyCodehd');
		$tran_Cd   = $request->input('transCodehd');
		$series_Cd = $request->input('seriesCodehd');
		$vr_No     = $request->input('Vrnohd');

		$data = array(
			"DATETIME"       => $request->input('datetime'),
			"VEHICLE_NUMBER" => $request->input('vehicle_number'),
			"PLANT_CODE"     => $request->input('plant_code'),
			"PLANT_NAME"     => $request->input('plant_name'),
			"PFCT_CODE"      => $request->input('pfct_code'),
			"PFCT_NAME"      => $request->input('pfct_name'),
			"DRIVER_NAME"    => $request->input('driver_name'),
			"DRIVER_ID"      => $request->input('driver_id'),
			"MOBILE_NUMBER"  => $request->input('mobile_number'),
			"VEHICLE_TYPE"   => $request->input('vehicle_type'),
			"VEHICLE_BLOCK"  => $request->input('vehicle_block'),
			"CREATED_BY"     => $createdBy,
			
		);

		try{

			$saveData = DB::table('CS_GATE_ENTRY')->where('COMP_CODE', $comp_cd)->where('FY_CODE', $fy_Cd)->where('TRAN_CODE', $tran_Cd)->where('SERIES_CODE', $series_Cd)->where('VRNO', $vr_No)->update($data);

			/*$discriptn_page = "Gate Inward update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);*/

			if ($saveData) {

				$request->session()->flash('alert-success', 'Gate Inward Was Successfully Updated...!');
				return redirect('/transaction/ColdStorage/View-gate-inward-transaction');

			} else {

				$request->session()->flash('alert-error', 'Gate Inward Can Not Added...!');
				return redirect('/transaction/ColdStorage/View-gate-inward-transaction');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Gate Inward Can not be be Updated...! Used In Another Transaction...!');
				return redirect('/transaction/ColdStorage/View-gate-inward-transaction');
		}

	}

    public function DeleteVehicleEntry(Request $request){

		$deletGateInward = $request->post('deletGateInward');
    	
    	$deleteField = explode('~',$deletGateInward);

		$compCd   = $deleteField[0];
		$fyCd     = $deleteField[1];
		$transCd  = $deleteField[2];
		$seriesCd = $deleteField[3];
		$vrno     = $deleteField[4];

    	if (($compCd!='') && ($fyCd!='') && ($transCd!='') && ($seriesCd!='') && ($vrno!='')) {
    		try{
    			$Delete = DB::table('CS_GATE_ENTRY')->where('COMP_CODE', $compCd)->where('FY_CODE', $fyCd)->where('TRAN_CODE', $transCd)->where('SERIES_CODE', $seriesCd)->where('VRNO', $vrno)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Gate Inward Was Deleted Successfully...!');
					return redirect('/transaction/ColdStorage/View-gate-inward-transaction');

				} else {

					$request->session()->flash('alert-error', 'Gate Inward Can Not Deleted...!');
					return redirect('/transaction/ColdStorage/View-gate-inward-transaction');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Gate Inward Can not be be Updated...! Used In Another Transaction...!');
					return redirect('/transaction/ColdStorage/View-gate-inward-transaction');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Equipment Type Not Found...!');
			return redirect('/Master/ColdStorage/View-Vehicle-entry-Mast');

    	}

	}

/* --------------- END : GATE INWARD TRANSACTION ---------------- */

/* --------------- START : GATE OUTWARD TRANSACTION ---------------- */
	
	public function AddGateOutward(Request $request){

		$title      ='Add Gate Outward Master';
		$compData   = $request->session()->get('company_name');
		$splitComp  = explode('-',$compData);
		$comp_code  = $splitComp[0];
		$tranCode   = 'C1';
		$fisYear    = $request->session()->get('macc_year');

		$allTblName = $this->AllTableName($request,$tranCode);

		foreach ($allTblName['fy_list'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$userdata['tranlist']   = $allTblName['tran_list'];
		
		$userdata['vehicleNoList'] = DB::table('BILTY_HEAD')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('GATE_OUTWARD','NO')->get();

		if(isset($compData)){

	    	return view('admin.finance.transaction.coldStorage.add_gate_outward',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

    }

    public function SaveGateOutward(Request $request){

    	$validate = $this->validate($request, [

			'outTime'        => 'required',
			'vehicle_number' => 'required',
			'plant_code'     => 'required',
			'plant_name'     => 'required',
			'pfct_code'      => 'required',
			'pfct_name'      => 'required',
			'driver_name'    => 'required',
			'driver_id'      => 'required',
			'mobile_number'  => 'required',
			'vehicleType'    => 'required',

		]);

		$loginUser   = $request->session()->get('userid');
		$CompanyName = $request->session()->get('company_name');
		$splitData   = explode('-', $CompanyName);
		$comp_code   = $splitData[0];
		$fisYear     = $request->session()->get('macc_year');

		$vehicleNo   = $request->input('vehicle_number');
		$tranCd      = $request->input('trans_code');
		$seriesCd    = $request->input('series_code');
		$vrno        = $request->input('vrseqnum');
		$vehicleType = $request->input('vehicleType');
		$biltyHId    = $request->input('biltyHId');

		DB::beginTransaction();

		try {

	    	$data = array(
				'VEHICLE_OUT_DATETIME' => $request->input('outTime'),
				'LAST_UPDATE_BY'       => $loginUser
	    	);

	    	DB::table('CS_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('VEHICLE_NUMBER',$vehicleNo)->where('VEHICLE_TYPE',$vehicleType)->where('TRAN_CODE',$tranCd)->where('SERIES_CODE',$seriesCd)->where('VRNO',$vrno)->update($data);

	    	$dataTwo = array(
	    		'GATE_OUTWARD'=> 'YES'
	    	);

	    	DB::table('BILTY_HEAD')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('VEHICLE_NO',$vehicleNo)->where('BILTYHID',$biltyHId)->update($dataTwo);	

	    	DB::commit();

	    	$request->session()->flash('alert-success', 'Gate Outward Was Successfully Added...!');
			return redirect('/transaction/ColdStorage/View-gate-outward-transaction');

    	}catch (\Exception $e) {

	        DB::rollBack();
	        //throw $e;
	        $request->session()->flash('alert-error', 'Gate Outward Can Not Added...!');
			return redirect('/transaction/ColdStorage/View-gate-outward-transaction');

	    }

    	/*$dataOutDone = array(
    		'GATE_OUTWARD' => 'YES'
    	);

    	DB::table('BILTY_HEAD')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('VEHICLE_NUMBER',$vehicleNo)->where('VEHICLE_TYPE',$vehicleType)->where('TRAN_CODE',$tranCd)->where('SERIES_CODE',$seriesCd)->where('VRNO',$vrno)->update($data);*/

    }

    public function ViewGateOutward(Request $request){

    	$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Gate Outward';
	    	$userid	= $request->session()->get('userid');
	    	$userType = $request->session()->get('usertype');
	    	$compName = $request->session()->get('company_name');
	    	$fisYear =  $request->session()->get('macc_year');

	    	$data = DB::table('CS_GATE_ENTRY')->whereNotNull('VEHICLE_OUT_DATETIME')->orderBy('DATETIME','ASC');
	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.transaction.coldStorage.view_gate_outward');
    	}else{
		 	return redirect('/useractivity');
	   }
    }

/* --------------- END : GATE OUTWARD TRANSACTION ---------------- */

/* -------------- START : INWARD ENTRY TRANSACTION ------------------- */
	
	public function InwardEntryCS(Request $request){

		$title       = 'Add Inward Entry Transaction';
		$fisYear     =  $request->session()->get('macc_year');
		$companyFull = $request->session()->get('company_name');
		$splitData   = explode('-', $companyFull);
		$comp_code   = $splitData[0];
		$comp_name   = $splitData[1];
		$request     = $request;
		$tranCode    = 'C2';
		$allTblName                   = $this->AllTableName($request,$tranCode);
		$userdata['itemList']         = $allTblName['item_list'];
		$userdata['customerlist']     = $allTblName['customer_list'];
		$userdata['packinglist']      = $allTblName['itemPack_list'];
		$userdata['vehicleEntrylist'] = $allTblName['vehicleEntry_list'];
		$userdata['tranlist']         = $allTblName['tran_list'];
		$userdata['seriesList']       = $allTblName['series_list'];

		foreach ($allTblName['fy_list'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$userdata['vehicleNolist']    = DB::table('CS_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CSVEHICLEHID','0')->WhereNull('VEHICLE_OUT_DATETIME')->where('VEHICLE_TYPE','LOAD')->get();
		
		if(isset($companyFull)){
	    	return view('admin.finance.transaction.coldStorage.add_inward_entry',$userdata+compact('title'));
	    }else{
			return redirect('/useractivity');
		}

    } 

    public function SaveInwardEntryCS(Request $request){

    	$validate = $this->validate($request, [

			'vehicleNo'     => 'required',
			'entrydate'     => 'required',
			'trans_code'    => 'required',
			'series_code'   => 'required',
			'series_name'   => 'required',
			'vrseqnum'      => 'required',
			'customerCd'    => 'required',
			'customerName'  => 'required',
			'item_code'     => 'required',
			'item_name'     => 'required',
			'um_OfItem'     => 'required',
			'aum_OfItem'    => 'required',
			'cfactor'       => 'required',
			'packing_code'  => 'required',
			'packing_name'  => 'required',
			'qty'           => 'required',
			'weight'        => 'required',
			'plant_code'    => 'required',
			'plant_name'    => 'required',
			'pfct_code'     => 'required',
			'pfct_name'     => 'required',
			'driver_name'   => 'required',
			'driver_idCard' => 'required',
			'driver_mobile' => 'required',

		]);

		$createdBy       = $request->session()->get('userid');
		$compName        = $request->session()->get('company_name');
		$spliData        = explode('-', $compName);
		$compCode        = $spliData[0];
		$comp_Name       = $spliData[1];
		$fisYear         = $request->session()->get('macc_year');
		$InWardEntrydate = $request->input('entrydate');
		$vrno            = $request->input('vrseqnum');

		$inwardEntryH = DB::select("SELECT MAX(CSVEHICLEHID) as CSVEHICLEHID FROM CSVEHICLE_INWARD_HEAD");
		$head_ID = json_decode(json_encode($inwardEntryH), true); 
	
		if(empty($head_ID[0]['CSVEHICLEHID'])){
			$headId = 1;
		}else{
			$headId = $head_ID[0]['CSVEHICLEHID']+1;
		}

		if($vrno == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrno;
		}

		$vrno_Exist = DB::table('CSVEHICLE_INWARD_HEAD')->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$request->input('trans_code'))->where('VRNO',$vrNum)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrNum +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {

			$data = array(

				"CSVEHICLEHID"      => $headId,
				"COMP_CODE"         => $compCode,
				"COMP_NAME"         => $comp_Name,
				"FY_CODE"           => $fisYear,
				"VEHICLE_NO"        => $request->input('vehicleNo'),
				"TRAN_CODE"         => $request->input('trans_code'),
				"SERIES_CODE"       => $request->input('series_code'),
				"SERIES_NAME"       => $request->input('series_name'),
				"VRNO"              => $NewVrno,
				"VRDATE"            => date("Y-m-d", strtotime($InWardEntrydate)),
				"ACC_CODE"          => $request->input('customerCd'),
				"ACC_NAME"          => $request->input('customerName'),
				"ITEM_CODE"         => $request->input('item_code'),
				"ITEM_NAME"         => $request->input('item_name'),
				"UM_CODE"           => $request->input('um_OfItem'),
				"AUM_CODE"          => $request->input('aum_OfItem'),
				"CFACTOR"           => $request->input('cfactor'),
				"PACKING_CODE"      => $request->input('packing_code'),
				"PACKING_NAME"      => $request->input('packing_name'),
				"QTY"               => $request->input('qty'),
				"WEIGHT"            => $request->input('weight'),
				"PROD_CONDITION"    => $request->input('prod_cond'),
				"PLANT_CODE"        => $request->input('plant_code'),
				"PLANT_NAME"        => $request->input('plant_name'),
				"PFCT_CODE"         => $request->input('pfct_code'),
				"PFCT_NAME"         => $request->input('pfct_name'),
				"DRIVER_NAME"       => $request->input('driver_name'),
				"DRIVER_IDCARD"     => $request->input('driver_idCard'),
				"DRIVER_CONTACT_NO" => $request->input('driver_mobile'),
				"VEHICLE_TYPE"      => $request->input('vehicleType'),
				"CREATED_BY"        => $createdBy,
				
			);

			$saveData = DB::table('CSVEHICLE_INWARD_HEAD')->insert($data);

			$dataInward = array(
							'CSVEHICLEHID' =>$headId
						);

			DB::table('CS_GATE_ENTRY')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('CSVEHICLEHID','0')->WhereNull('VEHICLE_OUT_DATETIME')->where('VEHICLE_TYPE','LOAD')->where('VEHICLE_NUMBER',$request->input('vehicleNo'))->update($dataInward);

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('trans_code'))->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->get()->toArray();

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$compCode,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$request->input('trans_code'),
					'SERIES_CODE' =>$request->input('series_code'),
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('trans_code'))->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();

			$request->session()->flash('alert-success', 'Inward Entry Was Successfully Added...!');
			return redirect('/transaction/ColdStorage/View-inward-entry-transaction');

		}catch (\Exception $e) {

	        DB::rollBack();
	        //throw $e;
	        $request->session()->flash('alert-error', 'Inward Entry Can Not Added...!');
			return redirect('/transaction/ColdStorage/View-inward-entry-transaction');

	    }


	}

	public function ViewInwardEntryCS(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Inward Entry Transaction';

	    	$userid	= $request->session()->get('userid');
	    	$userType = $request->session()->get('usertype');
	    	$compName = $request->session()->get('company_name');
	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('CSVEHICLE_INWARD_HEAD')->orderBy('CSVEHICLEHID','DESC');
	    	
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('CSVEHICLE_INWARD_HEAD')->orderBy('CSVEHICLEHID','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.transaction.coldStorage.view_inward_entry');
    	}else{
		 	return redirect('/useractivity');
	   }
    }

	public function EditInwardEntryCS($id){

    	$title = 'Edit Item Packing Master';

    	$id = base64_decode($id);
    	
    	if($id!=''){
    	    $query = DB::table('MASTER_INWARD_SLIP');
			$query->where('ID', $id);
			$classData= $query->get()->first();

			$customer         = $classData->ACC_CODE;
			$item_code        = $classData->ITEM_CODE;
			$packing_id       = $classData->PACKING;
			$qty              = $classData->QTY;
			$weight           = $classData->WEIGHT;
			$date             = $classData->DATE;
			$prod_cond        = $classData->PROD_CONDITION;
			$vehicel_id       = $classData->VEHICLE_ENTRY_ID;
			$driver_name      = $classData->DRIVER_NAME;
			$mobile_number    = $classData->MOBILE_NO;
			$vehicle_number   = $classData->VEHICLE_NO;
			$inwardbill_id    = $classData->ID;
			$inwardbill_block = $classData->INWARD_BILL_BLOCK;

		    $userData['item_list'] = DB::table('MASTER_ITEM')->Orderby('ITEM_CODE', 'desc')->get();
		    $userData['customer_list'] = DB::table('MASTER_ACC')->Orderby('ACC_CODE', 'desc')->where('ATYPE_CODE','C')->get();
		    $userData['packing_list'] = DB::table('MASTER_ITEM_PACKING')->Orderby('PACKING_ID', 'desc')->get();
		    $userData['vehicle_list'] = DB::table('CS_GATE_ENTRY')->Orderby('ID', 'desc')->get();

			$button='Update';
			$action='/Master/ColdStorage/Inward-slip-Update';

			return view('admin.finance.master.storage.inward_slip',$userData+compact('customer','item_code','packing_id','qty','weight','date','prod_cond','vehicel_id','driver_name','mobile_number','vehicle_number','inwardbill_id','inwardbill_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Type Not Found...!');
			return redirect('/Master/ColdStorage/View-Inward-slip-Mast');
		}

    }

    public function UpdateInwardEntryCS(Request $request){

		$validate = $this->validate($request, [

			'customer'   => 'required',
			'item_code'  => 'required',
			'packing_id' => 'required',
		

		]);

		$inwardbill_id = $request->input('inwardbill_id');

		date_default_timezone_set('Asia/Kolkata');

			$updatedDate = date("Y-m-d");
			
			$createdBy 	= $request->session()->get('userid');
			
			$compName 	= $request->session()->get('company_name');
			
			$fisYear 	=  $request->session()->get('macc_year');
			
			$billdate = $request->input('billdate');

		$data = array(

			"CUSTOMER"         => $request->input('customer'),
			"ITEM_CODE"        => $request->input('item_code'),
			"PACKING"          => $request->input('packing_id'),
			"QTY"              => $request->input('qty'),
			"WEIGHT"           => $request->input('weight'),
			"DATE"             => date("Y-m-d", strtotime($billdate)),
			"PROD_CONDITION"   => $request->input('prod_cond'),
			"VEHICLE_ENTRY_ID" => $request->input('vehicel_id'),
			"DRIVER_NAME"      => $request->input('driver_name'),
			"MOBILE_NO"        => $request->input('mobile_number'),
			"VEHICLE_NO"       => $request->input('vehicle_number'),
			"CREATED_BY"       => $createdBy,
			
		);

		try{

			$saveData = DB::table('MASTER_INWARD_SLIP')->where('ID', $inwardbill_id)->update($data);

			$discriptn_page = "Master Inward Bill update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Inward Bill Was Successfully Updated...!');
				return redirect('/Master/ColdStorage/View-Inward-slip-Mast');

			} else {

				$request->session()->flash('alert-error', 'Inward Bill Can Not Added...!');
				return redirect('/Master/ColdStorage/View-Inward-slip-Mast');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Inward Bill Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/ColdStorage/View-Inward-slip-Mast');
		}

	}

	

    public function DeleteInwardEntryCS(Request $request){

		$inwardslipId = $request->post('inwardslipId');
    	

    	if ($inwardslipId!='') {
    		try{
    			$Delete = DB::table('MASTER_INWARD_SLIP')->where('ID', $inwardslipId)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Inward Slip Was Deleted Successfully...!');
					return redirect('/Master/ColdStorage/View-Item-Packing-Mast');

				} else {

					$request->session()->flash('alert-error', 'Inward Slip Can Not Deleted...!');
					return redirect('/Master/ColdStorage/View-Item-Packing-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Inward Slip Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/ColdStorage/View-Item-Packing-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Inward Slip Not Found...!');
			return redirect('/Master/ColdStorage/View-Item-Packing-Mast');

    	}

	}

/* -------------- END : INWARD ENTRY TRANSACTION ------------------- */

/* -------------- START : INWARD STORAGE TRANSACTION ------------------- */

 	public function AddInwardStorageCS(Request $request){

		$CompanyData = $request->session()->get('company_name');
		$spliData    = explode('-', $CompanyData);
		$compcode    =	$spliData[0];
		$compname    =	$spliData[1];
		$fisYear     =  $request->session()->get('macc_year');
		$request     = $request;
		$title       = 'Inward Storage';
		$tranCode    = 'G3';
		$allTblName  = $this->AllTableName($request,$tranCode);

		$fyList                      = $allTblName['fy_list'];
		$userdata['seriesList']      = $allTblName['series_list'];
		$userdata['plantList']       = $allTblName['plant_list'];
		$userdata['accList']         = $allTblName['acc_list'];
		$userdata['truckList']       = $allTblName['truck_list'];
		$userdata['itemList']        = $allTblName['item_list'];
		$userdata['chamberList']     = $allTblName['chamber_list'];
		$userdata['transList']       = $allTblName['tran_list'];
		$userdata['coldStorageList'] = $allTblName['coldStorage_list'];
		$userdata['vehicleNolist']   = DB::table('CSVEHICLE_INWARD_HEAD')->where('COMP_CODE',$compcode)->where('FY_CODE',$fisYear)->where('IS_DONE','0')->where('VEHICLE_TYPE','LOAD')->get();
		
		foreach ($fyList as $key) {
          $userdata['fromDate'] =  $key->FY_FROM_DATE;
          $userdata['toDate']   =  $key->FY_TO_DATE;
      	}

      	if(isset($CompanyData)){

	    	return view('admin.finance.transaction.coldStorage.add_inward_storage',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}
       
    }

    public function SaveInwardStorageCS(Request $request){

		$createdBy   = $request->session()->get('userid');
		$CompanyData = $request->session()->get('company_name');
		$spliData    = explode('-', $CompanyData);
		$compcode    =	$spliData[0];
		$compname    =	$spliData[1];
		$fisYear     =  $request->session()->get('macc_year');

		//$splitDateT   = explode(' ',$request->input('estimate_time'));
		//$estimateDate = $splitDateT[0];
		//$estimateTime = $splitDateT[1];

		//$estimateDateForm    = date("Y-m-d", strtotime($estimateDate));  
		$VrDate    = date("Y-m-d", strtotime($request->input('vr_date')));  
		$estimateTime    = date("Y-m-d", strtotime($request->input('estimate_time')));  

		//$newEstimateDate = $estimateDateForm.' '.$estimateTime;

		$acc_code     = $request->input('acc_code');
		$head_Id      = $request->input('headID');
		$vehicleNo    = $request->input('vehicleNo');
		$tran_code    = $request->input('trans_code');
		$series_code  = $request->input('series_code');
		$cold_Storage = $request->input('cold_Storage');
		$chamber_code = $request->input('chamber_code');
		$floor_code   = $request->input('floor_code');
		$block_code   = $request->input('block_code');
		$qunatity     = $request->input('qunatity');
		$umCode       = $request->input('umCode');
		$itemcode     = $request->input('item_code');
		$rowCount     = count($itemcode);

		
		DB::beginTransaction();

		try {

	    	$headData = array(
			
				'ESTIMATE_DATE' => $estimateTime,
				'IS_DONE'       => '1'
	    	);

	    	DB::table('CSVEHICLE_INWARD_HEAD')->where('COMP_CODE',$compcode)->where('FY_CODE',$fisYear)->where('VEHICLE_NO',$vehicleNo)->where('IS_DONE','0')->where('VEHICLE_TYPE','LOAD')->update($headData);

	    	for($i=0;$i<$rowCount;$i++){

	    		$slno = $i+1;

	    		$veh_IntranB = DB::select("SELECT MAX(CSVEHICLEBID) as CSVEHICLEBID FROM CSVEHICLE_INWARD_BODY");
				$bodyID = json_decode(json_encode($veh_IntranB), true); 
				if(empty($bodyID[0]['CSVEHICLEBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['CSVEHICLEBID']+1;
				}

				$splititemCD    = explode('[', $itemcode[$i]);
				$splitcoldstore = explode('[', $cold_Storage[$i]);
				$splitchamber   = explode('[', $chamber_code[$i]);
				$splitfloor     = explode('[', $floor_code[$i]);
				$splitblock     = explode('[', $block_code[$i]);

	    		$bodyData = array(

					'CSVEHICLEHID' => $head_Id,
					'CSVEHICLEBID' => $body_Id,
					'COMP_CODE'    => $compcode,
					'COMP_NAME'    => $compname,
					'FY_CODE'      => $fisYear,
					'TRAN_CODE'    => $request->input('trans_code'),
					'SERIES_CODE'  => $request->input('series_code'),
					'SERIES_NAME'  => $request->input('series_name'),
					'VRNO'         => $request->input('vr_no'),
					'SLNO'         => $slno,
					'ITEM_CODE'    => $splititemCD[0],
					'ITEM_NAME'    => trim(substr_replace($splititemCD[1], "", -1)),
					'CS_CODE'      => $splitcoldstore[0],
					'CS_NAME'      => trim(substr_replace($splitcoldstore[1], "", -1)),
					'CHAMBER_CODE' => $splitchamber[0],
					'CHAMBER_NAME' => trim(substr_replace($splitchamber[1], "", -1)),
					'FLOOR_CODE'   => $splitfloor[0],
					'FLOOR_NAME'   => trim(substr_replace($splitfloor[1], "", -1)),
					'BLOCK_CODE'   => $splitblock[0],
					'BLOCK_NAME'   => trim(substr_replace($splitblock[1], "", -1)),
					'QUANTITY'     => $qunatity[$i],
					'UM'           => $umCode[$i],
					'CREATED_BY'   => $createdBy,
	    		);

	    		DB::table('CSVEHICLE_INWARD_BODY')->insert($bodyData);

	    		/* ------- CHECK PLAN SPACE --------- */

	    			$getPlaneSpace = DB::table('CS_BALENCE')->where('COMP_CODE',$compcode)->where('CS_CODE',$splitcoldstore[0])->where('CHAMBER_CODE',$splitchamber[0])->where('FLOOR_CODE',$splitfloor[0])->where('BLOCK_CODE',$splitblock[0])->get()->first();

	    			if($qunatity[$i] > $getPlaneSpace->PLAN_SPACE){
	    				$dataSpaceReduce = 0.00;
	    			}else{
	    				$dataSpaceReduce = $getPlaneSpace->PLAN_SPACE - $qunatity[$i];
	    			}	

	    			$SpaceReduce = array(
						'PLAN_SPACE'    => $dataSpaceReduce,
	    			);	
	    			
	    			DB::table('CS_BALENCE')->where('COMP_CODE',$compcode)->where('CS_CODE',$splitcoldstore[0])->where('CHAMBER_CODE',$splitchamber[0])->where('FLOOR_CODE',$splitfloor[0])->where('BLOCK_CODE',$splitblock[0])->update($SpaceReduce);

	    		/* ------- CHECK PLAN SPACE --------- */

	    		/* ---- SPACE OCCUIED IN CS BALENCE MASTER ----*/
	    		
	    			$getprevSace = DB::table('CS_BALENCE')->where('COMP_CODE',$compcode)->where('CS_CODE',$splitcoldstore[0])->where('CHAMBER_CODE',$splitchamber[0])->where('FLOOR_CODE',$splitfloor[0])->where('BLOCK_CODE',$splitblock[0])->get()->first();
	    			
					$occupiedSpace = $getprevSace->USED_SPACE + $qunatity[$i];
					$balenceSpace  = $getprevSace->STORAGE_CAPACITY - $occupiedSpace - $getprevSace->PLAN_SPACE;

	    			$dataSpace = array(
						"USED_SPACE"    => $occupiedSpace,
						"BALANCE_SPACE" =>$balenceSpace
					);

					DB::table('CS_BALENCE')->where('COMP_CODE',$compcode)->where('CS_CODE',$splitcoldstore[0])->where('CHAMBER_CODE',$splitchamber[0])->where('FLOOR_CODE',$splitfloor[0])->where('BLOCK_CODE',$splitblock[0])->update($dataSpace);

	    		/* ---- SPACE OCCUIED IN CS BALENCE MASTER ----*/

	    	}

			DB::commit();

			$data1['response'] = 'success';
  			$getalldata = json_encode($data1);  
  			print_r($getalldata);

       	}catch (\Exception $e) {

		    DB::rollBack();
		    //throw $e;
		    $data1['response'] = 'error';
  			$getalldata = json_encode($data1);  
  			print_r($getalldata);
		}

    } /* main function */

    public function inward_storage_msgCS(Request $request,$saveData){

		if ($saveData == 'false') {
			
			$request->session()->flash('alert-error', 'Vehicle Inward Can Not Added...!');
			return redirect('/transaction/ColdStorage/view-inward-storage-transaction');

		}else{

			$request->session()->flash('alert-success', 'Vehicle Inward Was Successfully Added...!');
			return redirect('/transaction/ColdStorage/view-inward-storage-transaction');

		}
	}

	public function ViewInwardStorageCS(Request $request){

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

	        	$data = DB::table('CSVEHICLE_INWARD_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get();

	        }else if($userType=='superAdmin' || $userType=='user'){

          		$data = DB::table('CSVEHICLE_INWARD_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get();
	        }else{
	            $data='';
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	     
	       return view('admin.finance.transaction.coldStorage.view_inward_storage');
	    }else{
			return redirect('/useractivity');
		}
    }

/* -------------- END : VEHICLE STORAGE TRANSACTION ------------------- */

/* -------------- START : BILTY TRANSACTION ------------------- */

	public function AddBiltyTrans(Request $request){

		$CompanyData   = $request->session()->get('company_name');
		$splitCompData = explode('-', $CompanyData);
		$comp_code     = $splitCompData[0];
		$comp_name     = $splitCompData[1];
		$fisYear       = $request->session()->get('macc_year');
		$request       = $request;	
		$title         = 'Bilty Transaction';
		$tranCode      = 'C3';
		$allTblName    = $this->AllTableName($request,$tranCode);

		$fyList                      = $allTblName['fy_list'];
		$userdata['seriesList']      = $allTblName['series_list'];

		foreach ($fyList as $key) {
		$userdata['fromDate'] =  $key->FY_FROM_DATE;
		$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$userdata['csList']        = $allTblName['coldStorage_list'];
		$userdata['floorList']     = $allTblName['floor_list'];
		$userdata['blockList']     = $allTblName['block_list'];
		$userdata['customerList']  = $allTblName['customer_list'];
		$userdata['tranlist']      = $allTblName['tran_list'];
		$userdata['plantlist']     = $allTblName['plant_list'];
		$userdata['vehicleNolist'] = DB::table('CSVEHICLE_INWARD_HEAD')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('IS_DONE','1')->where('VEHICLE_TYPE','LOAD')->where('BILTYHID','0')->get();

		if(isset($CompanyData)){

		    return view('admin.finance.transaction.coldStorage.bilty_trans',$userdata+compact('title'));

		}else{

			return redirect('/useractivity');
		}
      

    }

    public function SaveBiltyTrans(Request $request){

		$createdBy        = $request->session()->get('userid');
		$CompanyName      = $request->session()->get('company_name');
		$splitData        = explode('-', $CompanyName);
		$comp_code        = $splitData[0];
		$fisYear          = $request->session()->get('macc_year');

		$plant_code       = $request->input('plant_code');
		$bilty_date       = $request->input('bilty_date');
		$biltyDate        = date("Y-m-d", strtotime($bilty_date));
		$seriesCD         = $request->input('series_code');
		$seriesNM         = $request->input('series_name');
		$inward_date      = $request->input('inward_date');
		$inwardDate       = date("Y-m-d", strtotime($inward_date));
		$receiptValidDate = $request->input('valid_date');
		$receipt_ValidDT  = date("Y-m-d", strtotime($receiptValidDate));
		$transCD          = $request->input('transcode');
		$vrno             = $request->input('vrseqnum');
		$csCode           = $request->input('storage_code');
		$csName           = $request->input('storage_name');
		$totlRwBrow       = $request->input('totlRwCount');
		$coldStorageCD    = $request->input('cold_Storage');
		$chamberCD        = $request->input('chamber_code');
		$floorCD          = $request->input('floor_code');
		$blockCD          = $request->input('block_code');
		$qtyBody          = $request->input('qunatity');
		$umCd             = $request->input('umCode');
		$totlRw_Count     = count($totlRwBrow);

		$donwloadStatus   = $request->input('pdfYesNoStatus');
		$headtable    ='BILTY_HEAD';
		$bodytable    ='BILTY_BODY';
		$columnheadid ='BILTYHID';
		$pdfPageName  ='BILTY TRANSACTION';
		$vrNoPname	  ='BILTY NO';

		if($donwloadStatus == '1'){
			$pdfPrintFlag = 'YES';
		}else if($donwloadStatus == '0'){
			$pdfPrintFlag = 'NO';
		}

		$biltyH = DB::select("SELECT MAX(BILTYHID) as BILTYHID FROM BILTY_HEAD");
		$headID = json_decode(json_encode($biltyH), true); 
	
		if(empty($headID[0]['BILTYHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['BILTYHID']+1;
		}

		if($vrno == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrno;
		}

		$vrno_Exist = DB::table('BILTY_HEAD')->where('SERIES_CODE',$seriesCD)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$transCD)->where('VRNO',$vrNum)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrNum +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {

			$dataHead = array(

				'BILTYHID'          => $head_Id,
				'COMP_CODE'         => $comp_code,
				'FY_CODE'           => $fisYear,
				'TRAN_CODE'         => $transCD,
				'SERIES_CODE'       => $seriesCD,
				'SERIES_NAME'       => $seriesNM,
				'VRNO'              => $NewVrno,
				'BUILTY_DT'         => $biltyDate,
				'VEHICLE_NO'        => $request->input('vehicle_no'),
				'PLANT_CODE'        => $request->input('plant_code'),
				'PLANT_NAME'        => $request->input('plant_name'),
				'PFCT_CODE'         => $request->input('pfct_code'),
				'PFCT_NAME'         => $request->input('pfct_name'),
				'ACC_CODE'          => $request->input('acc_code'),
				'ACC_NAME'          => $request->input('acc_name'),
				'ITEM_CODE'         => $request->input('item_code'),
				'ITEM_NAME'         => $request->input('item_name'),
				'PACKING_CODE'      => $request->input('packing_code'),
				'PACKING_NAME'      => $request->input('packing_name'),
				'INWARD_STORAGE_DT' => $inwardDate,
				'STORAGE_TYPE'      => $request->input('charge_type'),
				'BILTY_QTY'         => $request->input('qty'),
				'BILTY_UM'          => $request->input('item_um'),
				'BILTY_AQTY'        => $request->input('a_qty'),
				'BILTY_AUM'         => $request->input('item_aum'),
				'RATE_PER_MONTH'    => $request->input('ratePerMonth'),
				'RATE_PER_MONTH_UM' => $request->input('rent_um'),
				'MARKET_RATE'       => $request->input('market_rate'),
				'MARKET_RATE_UM'    => $request->input('marketRateUm'),
				'MARKET_VALUE'    	=> $request->input('market_value'),
				'RECIEPT_TILL_DT'   => $receipt_ValidDT,
				'STACK_NO'          => $request->input('stack_number'),
				'CLASS_STD_QTY'     => $request->input('class_quality'),
				'IDENTY_MARK'       => $request->input('identity_mark'),
				'COND_GOODS'        => $request->input('prodCondtn'),
				'REMARK'            => $request->input('Remark'),
				'DRIVER_NAME'       => $request->input('driver_name'),
				'DRIVER_IDCARD'     => $request->input('driver_id'),
				'DRIVER_CONTACT_NO' => $request->input('mobile_number'),
				'VEHICLE_TYPE'      => $request->input('vehicleType'),
				'PRINT_FLAG'        => $pdfPrintFlag,
				'PRINT_COUNT'       => 1,
				'CREATED_BY'        => $createdBy,

			);

			DB::table('BILTY_HEAD')->insert($dataHead);

			for($j=0;$j<$totlRw_Count;$j++){

				$slno = $j+1;

				$biltyB = DB::select("SELECT MAX(BILTYBID) as BILTYBID FROM BILTY_BODY");
				$bodyID = json_decode(json_encode($biltyB), true); 
			
				if(empty($bodyID[0]['BILTYBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['BILTYBID']+1;
				}

				$spliColdStorage = explode('[', $coldStorageCD[$j]);
				$spliChamber     = explode('[', $chamberCD[$j]);
				$spliFloor       = explode('[', $floorCD[$j]);
				$spliBlock       = explode('[', $blockCD[$j]);

				$dataBody = array(
					'BILTYHID'     => $head_Id,
					'BILTYBID'     => $body_Id,
					'COMP_CODE'    => $comp_code,
					'FY_CODE'      => $fisYear,
					'TRAN_CODE'    => $transCD,
					'SERIES_CODE'  => $seriesCD,
					'SERIES_NAME'  => $seriesNM,
					'VRNO'         => $NewVrno,
					'SLNO'         => $slno,
					'CS_CODE'      => $spliColdStorage[0],
					'CS_NAME'      => trim(substr($spliColdStorage[1], 0, -1)),
					'CHAMBER_CODE' => $spliChamber[0],
					'CHAMBER_NAME' => trim(substr($spliChamber[1], 0, -1)),
					'FLOOR_CODE'   => $spliFloor[0],
					'FLOOR_NAME'   => trim(substr($spliFloor[1], 0, -1)),
					'BLOCK_CODE'   => $spliBlock[0],
					'BLOCK_NAME'   => trim(substr($spliBlock[1], 0, -1)),
					'QTY'          => $qtyBody[$j],
					'UM_CODE'      => $umCd[$j],
					'CREATED_BY'   => $createdBy,

				);

				DB::table('BILTY_BODY')->insert($dataBody);

			}

			$biltyHeadID = array(
				'BILTYHID' =>'1',
			);

			DB::table('CSVEHICLE_INWARD_HEAD')->where('VEHICLE_NO',$request->input('vehicle_no'))->where('VEHICLE_TYPE','LOAD')->where('IS_DONE','1')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($biltyHeadID);

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transCD)->where('SERIES_CODE',$seriesCD)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->toArray();

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$comp_code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$transCD,
					'SERIES_CODE' =>$seriesCD,
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transCD)->where('SERIES_CODE',$seriesCD)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();
			$data['response'] = 'success';
			if($donwloadStatus == 1){

			return $this->GeneratePdfForColdStorage($createdBy,$comp_code,$plant_code,$head_Id,$headtable,$bodytable,$columnheadid,$pdfPageName,$vrNoPname,$transCD);

			}else{}

		    $getalldata = json_encode($data);  
		    print_r($getalldata);

	    }catch (\Exception $e) {

	        DB::rollBack();
	        //throw $e;
	        $data['response'] = 'error';
	      	$getalldata = json_encode($data);  
	      	print_r($getalldata);

	    }
    }

    public function bilty_msg(Request $request,$saveData){

		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Bilty Can Not Added...!');
			return redirect('/Transaction/ColdStorage/View-Bilty-Mast');

		}else{

			$request->session()->flash('alert-success', 'Bilty Was Successfully Added...!');	
			return redirect('/Transaction/ColdStorage/View-Bilty-Mast');

		}
	}

	public function ViewBiltyTrans(Request $request){

    	$title       ='View Bilty Transaction';
		$userid      = $request->session()->get('userid');
		$userType    = $request->session()->get('usertype');
		$compName    = $request->session()->get('company_name');
		$compcode    = explode('-', $compName);
		$getcompcode =	$compcode[0];
		$fisYear     =  $request->session()->get('macc_year');

	     if($request->ajax()) {

	        if($userType=='admin' || $userType=='Admin'){

	       	    $data = DB::table('BILTY_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->get();
	     
	        }else if($userType=='superAdmin' || $userType=='user'){

	          	$data = DB::table('BILTY_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->get();

	        }else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }

	    if(isset($compName)){

	       return view('admin.finance.transaction.coldStorage.view_bilty_trans');
	    }else{
			return redirect('/useractivity');
		}
    }

/* -------------- END : BILTY TRANSACTION ------------------- */

/* -------------- START : OUTWARD TRANSACTION ------------------- */
	
	public function AddOutwardTrans(Request $request){
		$title      ='Outward Transaction';
		
		$Company    = $request->session()->get('company_name');
		$spliData   = explode('-', $Company);
		$comp_code  = $spliData[0];
		$tranCode   = 'C4';
		$macc_year  = $request->session()->get('macc_year');
		
		$allTblName = $this->AllTableName($request,$tranCode);

		$userdata['accList']         = $allTblName['acc_list'];
		$userdata['itemList']        = $allTblName['item_list'];
		$userdata['seriesList']      = $allTblName['series_list'];
		$userdata['coldStorageList'] = $allTblName['coldStorage_list'];
		$userdata['tranlist']        = $allTblName['tran_list'];
		$fyList                      = $allTblName['fy_list'];

		$userdata['vehicleNoList'] = DB::table('CS_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->where('CSOUTWARDHID','0')->WhereNull('VEHICLE_OUT_DATETIME')->where('VEHICLE_TYPE','EMPTY')->get();

		$userdata['biltyList'] = DB::select("SELECT A.SERIES_CODE,A.VRNO,A.FY_CODE,A.ACC_CODE,A.ACC_NAME FROM BILTY_HEAD A,BILTY_BODY B WHERE A.BILTYHID=B.BILTYHID AND B.OUTWARDHID='0' AND B.OUTWARDBID='0' AND A.COMP_CODE='$comp_code' AND A.FY_CODE='$macc_year' AND  B.QTY <> B.QTY_ISSUED AND A.GATE_OUTWARD='YES' GROUP BY A.VRNO");

		foreach ($fyList as $key) {
		$userdata['fromDate'] =  $key->FY_FROM_DATE;
		$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		if(isset($Company)){

		    return view('admin.finance.transaction.coldStorage.add_outward',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }

    public function SaveOutwardTransCS(Request $request){
    	
		$createdBy      = $request->session()->get('userid');
		$CompanyCode    = $request->session()->get('company_name');
		$splitData      = explode('-', $CompanyCode);
		$comp_code      = $splitData[0];
		$comp_name      = $splitData[1];
		$fisYear        = $request->session()->get('macc_year');
		$outDate        = date("Y-m-d", strtotime($request->input('outdate')));
		$vehicleNo      = $request->input('vehicle_no');
		$bilty_no       = $request->input('bilty_no');
		$transCode      = $request->input('transcode');
		$series_code    = $request->input('series_code');
		$series_name    = $request->input('series_name');
		$vrseq          = $request->input('vrseqnum');
		$acc_code       = $request->input('acc_code');
		$acc_name       = $request->input('acc_name');
		$itemCode       = $request->input('item_code');
		$itemName       = $request->input('item_name');
		$packingCode    = $request->input('packing_code');
		$packingName    = $request->input('packing_name');
		$storageType    = $request->input('st_ChargeType');
		$coldStorageCD  = $request->input('cold_Storage');
		$chamberCD      = $request->input('chamber_code');
		$floorCD        = $request->input('floor_code');
		$blockCD        = $request->input('block_code');
		$biltyHeadId    = $request->input('bilty_HeadId');
		$biltyBodyId    = $request->input('bilty_BodyId');
		$biltyQty       = $request->input('biltyQty');
		$dispatchQty    = $request->input('dispatchQty');
		$balenceQty     = $request->input('balenceQty');
		$qtyIssued      = $request->input('qtyIssued');
		$plantCode      = $request->input('plant_code');
		$donwloadStatus = $request->input('pdfYesNoStatus');
		$bcount         = count($coldStorageCD);
	   
	    $outwardH = DB::select("SELECT MAX(OUTWARDHID) as OUTWARDHID FROM CS_OUTWARD_HEAD");
		$headID = json_decode(json_encode($outwardH), true); 
	
		if(empty($headID[0]['OUTWARDHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['OUTWARDHID']+1;
		}

		if($vrseq == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrseq;
		}

		$vrno_Exist = DB::table('CS_OUTWARD_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$transCode)->where('VRNO',$vrNum)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrNum +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {

			$quantity     = $request->input('totlQtyIssue');
			$retPerMn     = $request->input('ratePerMonth');
			$extraCharges = $request->input('billRate');

			$getAmt       = $quantity * $retPerMn;
			$billAmnt     = $getAmt + $extraCharges;

	    	$datahead = array(

				'OUTWARDHID'         =>$head_Id,
				'COMP_CODE'          =>$comp_code,
				'COMP_NAME'          =>$comp_name,
				'FY_CODE'            =>$fisYear,
				'VRDATE'             =>$outDate,
				'TRAN_CODE'          =>$transCode,
				'SERIES_CODE'        =>$series_code,
				'SERIES_NAME'        =>$series_name,
				'VRNO'               =>$NewVrno,
				'VEHICLE_NO'         =>$vehicleNo,
				'BILTY_NO'           =>$bilty_no,
				'PLANT_CODE'         =>$request->input('plant_code'),
				'PLANT_NAME'         =>$request->input('plant_name'),
				'PFCT_CODE'          =>$request->input('pfct_code'),
				'PFCT_NAME'          =>$request->input('pfct_name'),
				'ACC_CODE'           =>$acc_code,
				'ACC_NAME'           =>$acc_name,
				'ITEM_CODE'          =>$itemCode,
				'ITEM_NAME'          =>$itemName,
				'PACKING_CODE'       =>$packingCode,
				'PACKING_NAME'       =>$packingName,
				'STORAGE_TYPE'       =>$storageType,
				'QTY'                =>$request->input('qty'),
				'RATE_PER_MONTH'     =>$request->input('ratePerMonth'),
				'MARKET_RATE'        =>$request->input('market_rate'),
				'EXTRA_DAYS_CHARGES' =>$request->input('billRate'),
				'BILL_AMT'           =>$billAmnt,
				'DRIVER_NAME'        =>$request->input('driver_name'),
				'DRIVER_ID_CRAD'     =>$request->input('driver_idCard'),
				'DRIVER_MOBILE_NO'   =>$request->input('driver_mobile'),
				'CREATED_BY'         =>$createdBy,

			);

			DB::table('CS_OUTWARD_HEAD')->insert($datahead);

			for ($i = 0; $i < $bcount; $i++) {

				$outwardB = DB::select("SELECT MAX(OUTWARDBID) as OUTWARDBID FROM CS_OUTWARD_BODY");

				$bodyID = json_decode(json_encode($outwardB), true); 
		
				if(empty($bodyID[0]['OUTWARDBID'])){
					$bodyId = 1;
				}else{
					$bodyId = $bodyID[0]['OUTWARDBID']+1;
				}

				$spliColdStorage = explode('[', $coldStorageCD[$i]);
				$spliChamber     = explode('[', $chamberCD[$i]);
				$spliFloor       = explode('[', $floorCD[$i]);
				$spliBlock       = explode('[', $blockCD[$i]);

		    	$data_body = array(

					'OUTWARDHID'     =>$head_Id,
					'OUTWARDBID'     =>$bodyId,
					'COMP_CODE'      =>$comp_code,
					'COMP_NAME'      =>$comp_name,
					'FY_CODE'        =>$fisYear,
					'TRAN_CODE'      =>$transCode,
					'SERIES_CODE'    =>$series_code,
					'SERIES_NAME'    =>$series_name,
					'VRNO'           =>$NewVrno,
					'CS_CODE'        =>$spliColdStorage[0],
					'CS_NAME'        =>substr($spliColdStorage[1], 0, -1),
					'CHAMBER_CODE'   =>$spliChamber[0],
					'CHAMBER_NAME'   =>substr($spliChamber[1], 0, -1),
					'FLOOR_CODE'     =>$spliFloor[0],
					'FLOOR_NAME'     =>substr($spliFloor[1], 0, -1),
					'BLOCK_CODE'     =>$spliBlock[0],
					'BLOCK_NAME'     =>substr($spliBlock[1], 0, -1),
					'BILTY_QTY'      =>$biltyQty[$i],
					'DISPATCHED_QTY' =>$dispatchQty[$i],
					'BALENCE_QTY'    =>$balenceQty[$i],
					'QTY_ISSUED'     =>$qtyIssued[$i],
					'CREATED_BY'     =>$createdBy,

			    );
	
		    	DB::table('CS_OUTWARD_BODY')->insert($data_body);

		    	/* -------- REDUCE SPACE --------- */

			    	$getPlaneSpace = DB::table('CS_BALENCE')->where('COMP_CODE',$comp_code)->where('CS_CODE',$spliColdStorage[0])->where('CHAMBER_CODE',$spliChamber[0])->where('FLOOR_CODE',$spliFloor[0])->where('BLOCK_CODE',$spliBlock[0])->get()->first();

					$getusedSpace = $getPlaneSpace->USED_SPACE - $qtyIssued[$i];
					$balenceSpace = $getPlaneSpace->STORAGE_CAPACITY - $getPlaneSpace->PLAN_SPACE - $getusedSpace;

			    	$dataSpace = array(
						'USED_SPACE'    => $getusedSpace,
						'BALANCE_SPACE' => $balenceSpace
			    	);

			    	DB::table('CS_BALENCE')->where('COMP_CODE',$comp_code)->where('CS_CODE',$spliColdStorage[0])->where('CHAMBER_CODE',$spliChamber[0])->where('FLOOR_CODE',$spliFloor[0])->where('BLOCK_CODE',$spliBlock[0])->update($dataSpace);

		    	/* -------- REDUCE SPACE --------- */

		    	/* ---------- UPDATE ISSUED QTY ------- */
		    	
				    $getBiltyQty = DB::table('BILTY_BODY')->where('BILTYHID',$biltyHeadId[$i])->where('BILTYBID',$biltyBodyId[$i])->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->first();
				    
					    $newQty = $getBiltyQty->QTY_ISSUED;

					    $updateQty = array(
					    	'QTY_ISSUED' => $newQty + $qtyIssued[$i],
					    );

			    	DB::table('BILTY_BODY')->where('BILTYHID',$biltyHeadId[$i])->where('BILTYBID',$biltyBodyId[$i])->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($updateQty);

			    	$getQtyisEq = DB::table('BILTY_BODY')->where('BILTYHID',$biltyHeadId[$i])->where('BILTYBID',$biltyBodyId[$i])->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->first();

			    	if($getQtyisEq->QTY == $getQtyisEq->QTY_ISSUED){

			    		$data_QUO= array(
					
							'OUTWARDHID' =>$head_Id,
							'OUTWARDBID' =>$bodyId,
						);

						DB::table('BILTY_BODY')->where('BILTYHID',$biltyHeadId[$i])->where('BILTYBID',$biltyBodyId[$i])->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($data_QUO);

			    	}

		    	/* ---------- UPDATE ISSUED QTY ------- */
		    }

		    /* -------- UPDATE IN GATE ENTRY ------------ */

		    	$dataOutward = array(
							'CSOUTWARDHID' =>$head_Id
						);

				DB::table('CS_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CSOUTWARDHID','0')->WhereNull('VEHICLE_OUT_DATETIME')->where('VEHICLE_TYPE','EMPTY')->where('VEHICLE_NUMBER',$vehicleNo)->update($dataOutward);

		    /* -------- UPDATE IN GATE ENTRY ------------ */

	    	$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transCode)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->toArray();

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$comp_code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$transCode,
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transCode)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();
			$data['response'] = 'success';

			$headtable    ='CS_OUTWARD_HEAD';
			$bodytable    ='CS_OUTWARD_BODY';
			$columnheadid ='OUTWARDHID';
			$pdfPageName  ='TAX INVOICE';
			$vrNoPname    ='INVOICE NO';

			if($donwloadStatus == 1){

			return $this->GeneratePdfForColdStorage($createdBy,$comp_code,$plantCode,$head_Id,$headtable,$bodytable,$columnheadid,$pdfPageName,$vrNoPname,$transCode);

			}else{}

		    $getalldata = json_encode($data);  
		    print_r($getalldata);

	    }catch (\Exception $e) {

	        DB::rollBack();
	        //throw $e;
	        $data['response'] = 'error';
	      	$getalldata = json_encode($data);  
	      	print_r($getalldata);

	    }

    }

    public function outwardCs_Savemsg(Request $request,$saveData){

		if($saveData == 'false'){

			$request->session()->flash('alert-error', 'Outward Can Not Added...!');
			return redirect('/Transaction/ColdStorage/View-Outward-trans');

		}else{

			$request->session()->flash('alert-success', 'Outward Was Successfully Added...!');	
			return redirect('/Transaction/ColdStorage/View-Outward-trans');

		}
	}

	public function ViewOutwardTrans(Request $request){

    	$compName = $request->session()->get('company_name');

	    if($request->ajax()) {

			$title       ='View Outward Transaction';
			$userid      = $request->session()->get('userid');
			$userType    = $request->session()->get('usertype');
			$companyData = $request->session()->get('company_name');
			$splitData   = explode('-', $companyData);
			$comp_code   =	$splitData[0];
			$fisYear     =  $request->session()->get('macc_year');

	        $data = DB::table('CS_OUTWARD_HEAD')->where('COMP_CODE', $comp_code)->where('FY_CODE', $fisYear)->get();

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){
	       return view('admin.finance.transaction.coldStorage.view_outward_trans');
	    }else{
			return redirect('/useractivity');
		}
    }

    public function ViewChildOutwardTrans(Request $request){

		$response_array = array();

		if ($request->ajax()) {

		   	$headid = $request->input('tblid');

	    	$outwardData = DB::table('CS_OUTWARD_BODY')->where('OUTWARDHID', $headid)->get()->toArray();
	    	
    		if($outwardData) {

    			$response_array['response'] = 'success';
	            $response_array['body_data'] = $outwardData;
	        
	            echo $data = json_encode($response_array);

			}else{

				$response_array['response']  = 'error';
				$response_array['data']      = '' ;
				$response_array['body_data'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

				$response_array['response']  = 'error';
				$response_array['data']      = '' ;
				$response_array['body_data'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

/* -------------- END : OUTWARD TRANSACTION --------------------- */

/* -------------- START : GENERATE BILL TRANSACTION --------------------- */
	
	public function AddGenerateBillTrans(Request $request){

		$title                  ='Generate Bill Transaction';
		
		$Company                = $request->session()->get('company_name');
		$spliData               = explode('-', $Company);
		$comp_code              = $spliData[0];
		$tranCode               = 'S5';
		$macc_year              = $request->session()->get('macc_year');
		
		$allTblName             = $this->AllTableName($request,$tranCode);
		$userdata['tranlist']   = $allTblName['tran_list'];
		$userdata['seriesList'] = $allTblName['series_list'];
		$userdata['taxList']    = $allTblName['tax_list'];
		$userdata['ratval_list']= $allTblName['ratval_list'];

		$fyList                 = $allTblName['fy_list'];
		//DB::enableQueryLog();
		$userdata['biltyNoList'] = DB::select("SELECT A.*,B.* FROM CS_OUTWARD_HEAD A,CS_OUTWARD_BODY B WHERE A.OUTWARDHID=B.OUTWARDHID AND A.SBILLHID='0' AND A.SBILLHID='0' AND A.COMP_CODE='$comp_code' AND A.FY_CODE='$macc_year'");
		//(DB::getQueryLog());
		foreach ($fyList as $key) {
		$userdata['fromDate'] =  $key->FY_FROM_DATE;
		$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		if(isset($Company)){

		    return view('admin.finance.transaction.coldStorage.add_generate_bill',$userdata+compact('title'));

		}else{

			return redirect('/useractivity');
		}
       

    }

    public function SaveBillGenerateCS(Request $request){

		$biltyNo      = $request->input('biltyNo');
		$tranCd       = $request->input('tranCd');
		$series_Code  = $request->input('seriesCode');
		$series_name  = $request->input('series_name');
		$vrseq        = $request->input('vrseqnum');
		$vr_Date      = $request->input('vrDate');
		$vrDateFr     = date("Y-m-d", strtotime($vr_Date));
		$acc_code     = $request->input('acc_code');
		$acc_name     = $request->input('acc_name');
		$posting_code = $request->input('posting_code');
		$posting_name = $request->input('posting_name');
		$tax_Code     = $request->input('taxCode');
		$tax_indCd    = $request->input('taxIndCode');
		$tax_rateInd  = $request->input('rate_ind');
		$tax_afrate   = $request->input('af_rate');
		$tax_Amount   = $request->input('amount');
		$tax_glCd     = $request->input('taxGlCode');
		$series_gl    = $request->input('seriesGlC');
		$acc_Code     = $request->input('acc_code');
		$net_amt      = $request->input('netAmt');
		$taxDataCount = $request->input('taxDataCount');
		$loginUser    = $request->session()->get('userid');
		$CompanyCode  = $request->session()->get('company_name');
		$splitData    = explode('-', $CompanyCode);
		$comp_code    = $splitData[0];
		$comp_name    = $splitData[1];
		$fisYear      = $request->session()->get('macc_year');

		if($vrseq == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrseq;
		}

		$vrno_Exist = DB::table('SBILL_HEAD')->where('SERIES_CODE',$series_Code)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$tranCd)->where('VRNO',$vrNum)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrNum +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {

		/*------- START TEMP INSERT ACCOUNTING ENTRY --------- */

			DB::table('INDICATOR_TEMP')->where('CREATED_BY',$loginUser)->where('TCFLAG','CSBI')->delete();

			for($i=0;$i<$taxDataCount;$i++){

				$rateindex   = $tax_rateInd[$i];
				$taxamt      = $tax_Amount[$i];
				$tax_gl_code = $tax_glCd[$i];
				$uniqCheck   = $tax_indCd[$i];

				$checkExist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$loginUser)->where('TCFLAG','CSBI')->get()->toArray();

				$indData = DB::table('INDICATOR_TEMP')->where('IND_CODE',$uniqCheck)->where('CREATED_BY',$loginUser)->where('TCFLAG','CSBI')->get()->toArray();

				if($taxamt !=0.00){

					if($rateindex == 'Z'){

					}else{

						if(empty($checkExist)){

							$idary = array(
								'IND_CODE'    => $uniqCheck,
								'DR_AMT'      => 0.00,
								'CR_AMT'      => $taxamt,
								'IND_GL_CODE' => $series_gl,
								'TCFLAG'      => 'CSBI',
								'GLACC_Chk'	  => 'GL',
								'CREATED_BY'  => $loginUser,
							
							);
							DB::table('INDICATOR_TEMP')->insert($idary);

						}else  if($tax_gl_code == ''){

							$bscVal = DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$loginUser)->where('TCFLAG','CSBI')->get()->toArray();

							$updateId = $bscVal[0]->CREATED_BY;
							$basicAmt = $bscVal[0]->CR_AMT + $taxamt;
						
							$idary_bsic = array(
								'DR_AMT' 	  =>0.00,
								'CR_AMT'	  =>$basicAmt,
							);

							 DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('TCFLAG','CSBI')->where('CREATED_BY',$updateId)->update($idary_bsic);

						}else if(empty($indData)){

							$idary   = array(
								'IND_CODE'    => $uniqCheck,
								'DR_AMT'      => 0.00,
								'CR_AMT'      => $taxamt,
								'IND_GL_CODE' => $tax_gl_code,
								'TCFLAG'      => 'CSBI',
								'GLACC_Chk'	  => 'GL',
								'CREATED_BY'  => $loginUser,
								
							);

							DB::table('INDICATOR_TEMP')->insert($idary);
						}else{

							$indData1 = DB::table('INDICATOR_TEMP')->where('IND_CODE',$uniqCheck)->where('TCFLAG','CSBI')->where('CREATED_BY',$loginUser)->get()->first();

							$newTaxAmt = $indData1->CR_AMT + $taxamt;

							$idary1 = array(
								'DR_AMT' => 0.00,
								'CR_AMT' =>$newTaxAmt,
							);

							$updatevr = DB::table('INDICATOR_TEMP')->where('IND_CODE',$uniqCheck)->where('TCFLAG','CSBI')->where('CREATED_BY',$loginUser)->update($idary1);
						}
					} /* ---- CHECK 'Z' */
				} /* ---- CHECK TAX AMT IS ZERO ----*/

			} /* ---- FOR LOOP ----*/

			$accData = array(

				'DR_AMT'       => $net_amt,
				'CR_AMT'       => 0.00,
				'IND_GL_CODE'  => $posting_code,
				'IND_ACC_CODE' => $acc_code,
				'TCFLAG'       => 'CSBI',
				'GLACC_Chk'    => 'ACC',
				'CREATED_BY'   => $loginUser,
			);

			DB::table('INDICATOR_TEMP')->insert($accData);

		/*------- END TEMP INSERT ACCOUNTING ENTRY --------- */

		/* ---------- START HEAD DATA ----------- */

			$saleBillH = DB::select("SELECT MAX(SBILLHID) as SBILLHID FROM SBILL_HEAD");
			$headID = json_decode(json_encode($saleBillH), true); 
		
			if(empty($headID[0]['SBILLHID'])){
				$head_Id = 1;
			}else{
				$head_Id = $headID[0]['SBILLHID']+1;
			}

			$headData = array(
				'SBILLHID'    => $head_Id,
				'COMP_CODE'   => $comp_code,
				'FY_CODE'     => $fisYear,
				'TRAN_CODE'   => $tranCd,
				'SERIES_CODE' => $series_Code,
				'SERIES_NAME' => $series_name,
				'VRNO'        => $NewVrno,
				'VRDATE'      => $vrDateFr,
				'ACC_CODE'    => $acc_code,	
				'ACC_NAME'    => $acc_name,
				'TAX_CODE'    => $tax_Code,
				'BILL_TYPE'	  =>'CS',
				'CREATED_BY'  => $loginUser
			);

			DB::table('SBILL_HEAD')->insert($headData);

		/* ----------END HEAD DATA ----------- */

		/* ----------START BODY DATA ----------- */
			
			$getBodyData = DB::select("SELECT A.*,B.* FROM CS_OUTWARD_HEAD A,CS_OUTWARD_BODY B WHERE A.OUTWARDHID=B.OUTWARDHID AND A.SBILLHID='0' AND A.SBILLHID='0' AND A.COMP_CODE='$comp_code' AND A.FY_CODE='$fisYear' AND A.BILTY_NO='$biltyNo'");

			$slno =1;
			foreach($getBodyData as $row){

				$saleBillB = DB::select("SELECT MAX(SBILLBID) as SBILLBID FROM SBILL_BODY");

				$bodyID = json_decode(json_encode($saleBillB), true); 
		
				if(empty($bodyID[0]['SBILLBID'])){
					$bodyId = 1;
				}else{
					$bodyId = $bodyID[0]['SBILLBID']+1;
				}

				$basicAmt = $row->QTY_ISSUED * $row->RATE_PER_MONTH; 

				$bodyData = array(
					'SBILLHID'    => $head_Id, 
					'SBILLBID'    => $bodyId,
					'COMP_CODE'   => $comp_code, 
					'FY_CODE'     => $fisYear, 
					'TRAN_CODE'   => $tranCd, 
					'SERIES_CODE' => $series_Code, 
					'VRNO'        => $NewVrno,
					'SLNO'		  => $slno,
					'VRDATE'	  => $vrDateFr,	
					'ITEM_CODE'	  => $row->ITEM_CODE,
					'ITEM_NAME'	  => $row->ITEM_NAME,
					'QTYISSUED'	  => $row->QTY_ISSUED,
					'BASICAMT'	  => $basicAmt,
					'TAX_CODE'	  => $tax_Code,
					'BILL_TYPE'	  =>'CS',
					'CREATED_BY'  => $loginUser
				);

				DB::table('SBILL_BODY')->insert($bodyData);
				$slno++;
			}

		/* ----------END BODY DATA ----------- */

		/* ----------START INSERT ACCUNTING ENTRY ----------- */

		$accountData = DB::select("SELECT t1.*,t2.GL_NAME as glName,t3.ACC_NAME AS accName FROM INDICATOR_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE LEFT JOIN MASTER_ACC t3 ON t3.ACC_CODE =t1.IND_ACC_CODE WHERE t1.CREATED_BY='$loginUser' AND t1.TCFLAG='CSBI'");

		$srno=1;
		foreach($accountData as $acc){
			$pfctcode='';
			$blankVal='';
			$result = (new AccountingController)->GlTEntry($comp_code,$fisYear,$tranCd,$series_Code,$NewVrno,$srno,$vrDateFr,$pfctcode,$acc->IND_GL_CODE,$acc->glName,$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$acc->DR_AMT,$acc->CR_AMT,$blankVal,$loginUser);

			if($acc->GLACC_Chk=='ACC'){

	           	$result = (new AccountingController)->AccountTEntry($comp_code,$fisYear,$tranCd,$series_Code,$NewVrno,$srno,$vrDateFr,$pfctcode,$acc->IND_ACC_CODE,$acc->accName,$acc->IND_GL_CODE,$acc->glName,$blankVal,$blankVal,$blankVal,$blankVal,$acc->DR_AMT,$acc->CR_AMT,$blankVal,$loginUser);
            }

		$srno++;
		}

		/* ----------END INSERT ACCUNTING ENTRY ----------- */

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tranCd)->where('SERIES_CODE',$series_Code)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->toArray();

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$comp_code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$tranCd,
					'SERIES_CODE' =>$series_Code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$loginUser,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);

			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tranCd)->where('SERIES_CODE',$series_Code)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();
			$data['response'] = 'success';
			/*if($donwloadStatus == 1){

			return $this->GeneratePdfForColdStorage($createdBy,$comp_code,'',$head_Id,$headtable,$bodytable,$columnheadid,$pdfPageName,$vrNoPname,$transCD);

			}else{}*/

		    $getalldata = json_encode($data);  
		    print_r($getalldata);

	    }catch (\Exception $e) {

	        DB::rollBack();
	        //throw $e;
	        $data['response'] = 'error';
	      	$getalldata = json_encode($data);  
	      	print_r($getalldata);

	    }

    } /* /. MAIN FUNCTION*/

    public function Generatebill_msg(Request $request,$saveData){

		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Bilty Can Not Added...!');
			return redirect('/Transaction/ColdStorage/view-bill-trans');

		} else {

			$request->session()->flash('alert-success', 'Bilty Was Successfully Added...!');	
			return redirect('/Transaction/ColdStorage/view-bill-trans');

		}
	}

	public function ViewGenerateBill(Request $request){

		$title     ='View Bill Transaction';
		$userid    = $request->session()->get('userid');
		$userType  = $request->session()->get('usertype');
		$compName  = $request->session()->get('company_name');
		$splitData = explode('-', $compName);
		$comp_code = $splitData[0];
		$fisYear   =  $request->session()->get('macc_year');

		if($request->ajax()) {

			$data = DB::table('SBILL_HEAD')->where('COMP_CODE', $comp_code)->where('FY_CODE', $fisYear)->where('BILL_TYPE', 'CS')->get();

			return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
		                
		            })->toJson();
		}

		if(isset($compName)){

	       return view('admin.finance.transaction.coldStorage.view_generate_bill');
	    }else{
			return redirect('/useractivity');
		}


	}

/* -------------- END : GANERATE BILL TRANSACTION --------------------- */

/* ------------- START : TRANSFER BILTY TRANSACTION ------------- */
	
	public function AddBiltyTransferTran(Request $request){

		$CompanyData   = $request->session()->get('company_name');
		$splitCompData = explode('-', $CompanyData);
		$comp_code     = $splitCompData[0];
		$comp_name     = $splitCompData[1];
		$fisYear       = $request->session()->get('macc_year');
		$request       = $request;	
		$title         = 'Bilty Transfer Transaction';
		$tranCode      = 'C3';
		$allTblName    = $this->AllTableName($request,$tranCode);

		$fyList                      = $allTblName['fy_list'];
		$userdata['seriesList']      = $allTblName['series_list'];

		foreach ($fyList as $key) {
		$userdata['fromDate'] =  $key->FY_FROM_DATE;
		$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$userdata['csList']       = $allTblName['coldStorage_list'];
		$userdata['floorList']    = $allTblName['floor_list'];
		$userdata['blockList']    = $allTblName['block_list'];
		$userdata['customerList'] = $allTblName['customer_list'];
		$userdata['tranlist']     = $allTblName['tran_list'];
		$userdata['plantlist']    = $allTblName['plant_list'];
		$userdata['vehicleNolist']    = DB::table('CSVEHICLE_INWARD_HEAD')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('IS_DONE','1')->where('VEHICLE_TYPE','LOAD')->where('BILTYHID','0')->get();
		$userdata['accList']         = $allTblName['acc_list'];

		$userdata['vehicleNoList'] = DB::table('CS_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('VEHICLE_TYPE','EMPTY')->get();

		$userdata['biltyList'] = DB::select("SELECT A.SERIES_CODE,A.VRNO,A.FY_CODE,A.ACC_CODE,A.ACC_NAME FROM BILTY_HEAD A,BILTY_BODY B WHERE A.BILTYHID=B.BILTYHID AND B.OUTWARDHID='0' AND B.OUTWARDBID='0' AND A.COMP_CODE='$comp_code' AND A.FY_CODE='$fisYear' AND  B.QTY <> B.QTY_ISSUED AND A.GATE_OUTWARD='YES'");


		foreach ($fyList as $key) {
		$userdata['fromDate'] =  $key->FY_FROM_DATE;
		$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		if(isset($CompanyData)){

		    return view('admin.finance.transaction.coldStorage.add_bilty_transfer',$userdata+compact('title'));

		}else{

			return redirect('/useractivity');
		}
      

    }

/* ------------- END : TRANSFER BILTY TRANSACTION ------------- */

/* ----------------- START : AJAX FUNCTION ---------------- */

	public function getVehicleEntryDetails(Request $request){

		$companyFull       = $request->session()->get('company_name');
		$splitComp         = explode('-', $companyFull);
		$comp_code         = $splitComp[0];
		$fisYear           =  $request->session()->get('macc_year');
		$response_array    = array();
		$getOrderPlan      = '';
		$getInwardDetails  = '';
		$getvehicleDetails = '';
		$vehicleDetails    = '';

		$vehicelNo   = $request->input('vehicle_No');
		$vehicleType = $request->input('vehicleType');

		if ($request->ajax()) {

	    	$getvehicleDetails = DB::select("SELECT * FROM CS_GATE_ENTRY WHERE COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND VEHICLE_NUMBER='$vehicelNo' AND CSVEHICLEHID='0' AND VEHICLE_TYPE='LOAD' AND VEHICLE_OUT_DATETIME IS NULL");

	    	if($vehicleType == 'EMPTY'){

	    		$vehicleDetails = DB::select("SELECT * FROM CS_GATE_ENTRY WHERE COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND VEHICLE_NUMBER='$vehicelNo' AND CSOUTWARDHID='0' AND VEHICLE_TYPE='EMPTY' AND VEHICLE_OUT_DATETIME IS NULL");
	    	}else{
	    		$vehicleDetails='';
	    	}

	    	$getInwardDetails = DB::select("SELECT * FROM CSVEHICLE_INWARD_HEAD WHERE COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND IS_DONE='0' AND VEHICLE_TYPE='LOAD' AND VEHICLE_NO='$vehicelNo'");

	    	if($getInwardDetails){

	    		$accCode = $getInwardDetails[0]->ACC_CODE;

	    		$OrderPlan = DB::select("SELECT * FROM CS_PLAN_HEAD WHERE COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND ACC_CODE='$accCode'");

	    		if($OrderPlan){
	    			$getOrderPlan = $OrderPlan;
	    		}else{
	    			$getOrderPlan = '';
	    		}

	    	}else{
	    		$getOrderPlan = '';
	    	}
	    	
    		if ($getvehicleDetails || $getInwardDetails || $getOrderPlan || $vehicleDetails) {

				$response_array['response']        = 'success';
				$response_array['data']            = $getvehicleDetails;
				$response_array['datainwardEntry'] = $getInwardDetails;
				$response_array['dataOrderPlan']   = $getOrderPlan;
				$response_array['date_vehicle']    = $vehicleDetails;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response']        = 'error';
				$response_array['data']            = '' ;
				$response_array['datainwardEntry'] = '' ;
				$response_array['dataOrderPlan']   = '' ;
				$response_array['date_vehicle']    = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

				$response_array['response']        = 'error';
				$response_array['data']            = '' ;
				$response_array['datainwardEntry'] = '' ;
				$response_array['dataOrderPlan']   = '' ;
				$response_array['date_vehicle']    = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function getPlanSpaceAgainstCustomer(Request $request){

		$response_array = array();
		$CompanyName    = $request->session()->get('company_name');
		$explComp       = explode('-',$CompanyName);
		$comp_Code      = $explComp[0];
		$comp_Name      = $explComp[1];
		$fisYear        =  $request->session()->get('macc_year');

		if ($request->ajax()) {

			$planNo  = $request->input('planNo');
			$accCode = $request->input('acc_code');

		    $planSpace_data = DB::select("SELECT t2.* FROM CS_PLAN_HEAD t1,CS_PLAN_BODY t2 WHERE t1.CSPHID=t2.CSPHID AND t1.COMP_CODE='$comp_Code' AND t1.FY_CODE='$fisYear' AND t1.ACC_CODE='$accCode' AND t1.CSPHID='$planNo' ");

		    	
		    if ($planSpace_data) {

					$response_array['response'] = 'success';
					$response_array['dataPlan'] = $planSpace_data;
		            echo $data = json_encode($response_array);

			}else{

					$response_array['response'] = 'error';
					$response_array['dataPlan'] = '';
	                $data = json_encode($response_array);
	                print_r($data);
						
			}

	    }else{

			$response_array['response'] = 'error';
			$response_array['dataPlan'] = '';
            $data = json_encode($response_array);
            print_r($data);			
	    }

    }

	public function Get_Inward_Data_Item(Request $request){

		$response_array = array();

		$CompanyName = $request->session()->get('company_name');
		$explComp    = explode('-',$CompanyName);
		$comp_Code   = $explComp[0];
		$comp_Name   = $explComp[1];
		$fisYear     =  $request->session()->get('macc_year');
		$masterateData = '';

		if ($request->ajax()) {

			$vehicleNo = $request->input('vehicle_No');
			$chargeVal = $request->input('chargeVal');

		   // $inward_data = DB::table('CSVEHICLE_INWARD_HEAD')->where('VEHICLE_NO', $vehicleNo)->get()->first();
		    $inward_data = DB::select("SELECT * FROM `CSVEHICLE_INWARD_HEAD` A,CSVEHICLE_INWARD_BODY B WHERE A.CSVEHICLEHID=B.CSVEHICLEHID AND A.COMP_CODE='$comp_Code' AND A.FY_CODE='$fisYear' AND A.VEHICLE_NO='$vehicleNo' AND A.VEHICLE_TYPE='LOAD' AND A.IS_DONE='1' AND A.BILTYHID='0'");

		    $biltyDoneData = DB::select("SELECT A.BILTYHID,B.SERIES_CODE,B.SERIES_NAME,B.VRNO,B.PLANT_CODE,B.PLANT_NAME,B.PFCT_CODE,B.PFCT_NAME,B.DRIVER_NAME,B.DRIVER_ID,B.MOBILE_NUMBER,B.VEHICLE_TYPE FROM `BILTY_HEAD` A ,CS_GATE_ENTRY B WHERE A.VEHICLE_NO=B.VEHICLE_NUMBER AND A.COMP_CODE=B.COMP_CODE AND A.FY_CODE=B.FY_CODE AND A.VEHICLE_NO='$vehicleNo' AND A.GATE_OUTWARD='NO'");

		    if($inward_data){
				$itemCode = $inward_data[0]->ITEM_CODE;
				$accCode  = $inward_data[0]->ACC_CODE;
				$plant_cd = $inward_data[0]->PLANT_CODE;
				$packCode = $inward_data[0]->PACKING_CODE;

				if($chargeVal == 'PER_UNIT_PER_MONTH'){

					$masterateData =DB::table('MASTER_ITEM_PACKING')->where('ITEM_CODE', $itemCode)->where('PACKING_ID', $packCode)->get()->first();

				}else if($chargeVal == 'SEASONAL'){

					$masterateData = DB::table('MASTER_SEASONAL')->where('COMP_CODE', $comp_Code)->where('ITEM_CODE', $itemCode)->get()->first();

				}else if($chargeVal == 'FIXED'){

					$masterateData =DB::table('MASTER_ITEMBAL')->where('COMP_CODE', $comp_Code)->where('FY_CODE', $fisYear)->where('PLANT_CODE', $plant_cd)->where('ITEM_CODE', $itemCode)->get()->first();;
				}

				$itemBalRate   = DB::table('MASTER_ITEMBAL')->where('COMP_CODE', $comp_Code)->where('FY_CODE', $fisYear)->where('PLANT_CODE', $plant_cd)->where('ITEM_CODE', $itemCode)->get()->first();

				$accItemRate  = DB::table('MASTER_ACC_ITEM_RATE')->where('COMP_CODE', $comp_Code)->where('ACC_CODE', $accCode)->where('ITEM_CODE', $itemCode)->where('PACKING_CODE', $packCode)->where('TABSTATUS', $chargeVal)->get()->first();


		    }else{
				$masterateData ='';
				$itemBalRate   ='';
				$accItemRate  ='';
		    }
		    	
		    if ($inward_data || $masterateData || $itemBalRate || $accItemRate || $biltyDoneData) {

					$response_array['response']        = 'success';
					$response_array['data']            = $inward_data;
					$response_array['dataMasterRate']  = $masterateData;
					$response_array['dataitemBalRate'] = $itemBalRate;
					$response_array['dataAccItemRate'] = $accItemRate;
					$response_array['dataBiltyDone']   = $biltyDoneData;
		            echo $data = json_encode($response_array);

			}else{

					$response_array['response']        = 'error';
					$response_array['data']            = '';
					$response_array['dataMasterRate']  = '';
					$response_array['dataitemBalRate'] = '';
					$response_array['dataAccItemRate'] = '';
					$response_array['dataBiltyDone']   = '';
	                $data = json_encode($response_array);
	                print_r($data);
						
			}

	    }

	}

	public function GetRatePerMonthByStorageCharge(Request $request){

		$response_array = array();

		$CompanyName = $request->session()->get('company_name');
		$explComp    = explode('-',$CompanyName);
		$comp_Code   = $explComp[0];
		$comp_Name   = $explComp[1];
		$fisYear     =  $request->session()->get('macc_year');

		if ($request->ajax()) {

			$charge_Val   = $request->input('chargeVal');
			$acc_Code     = $request->input('accCode');
			$item_Code    = $request->input('itemCode');
			$packing_Code = $request->input('packingCode');
			$plantCode    = $request->input('plantCode');

			if($charge_Val == 'PER_UNIT_PER_MONTH'){

				$masterRateData =DB::table('MASTER_ITEM_PACKING')->where('ITEM_CODE', $item_Code)->where('PACKING_ID', $packing_Code)->get()->first();

			}else if($charge_Val == 'SEASONAL'){

				$masterRateData = DB::table('MASTER_SEASONAL')->where('COMP_CODE', $comp_Code)->where('ITEM_CODE', $item_Code)->get()->first();

			}else if($charge_Val == 'FIXED'){

				$masterRateData =DB::table('MASTER_ITEMBAL')->where('COMP_CODE', $comp_Code)->where('FY_CODE', $fisYear)->where('PLANT_CODE', $plantCode)->where('ITEM_CODE', $item_Code)->get()->first();;
			}else{
				$masterRateData = '';
			}

			$itemBalRate   = DB::table('MASTER_ITEMBAL')->where('COMP_CODE', $comp_Code)->where('FY_CODE', $fisYear)->where('PLANT_CODE', $plantCode)->where('ITEM_CODE', $item_Code)->get()->first();

			$masterAccItemRate  = DB::table('MASTER_ACC_ITEM_RATE')->where('COMP_CODE', $comp_Code)->where('ACC_CODE', $acc_Code)->where('ITEM_CODE', $item_Code)->where('PACKING_CODE', $packing_Code)->where('TABSTATUS', $charge_Val)->get()->first();

		    	
		    if ($masterAccItemRate || $masterRateData || $itemBalRate) {

				$response_array['response']        = 'success';
				$response_array['datamasterRate']  = $masterRateData;
				$response_array['dataAccItemRate'] = $masterAccItemRate;
				$response_array['dataitemBalRate'] = $itemBalRate;
	            echo $data = json_encode($response_array);

			}else{

				$response_array['response']        = 'error';
				$response_array['dataAccItemRate'] = '' ;
				$response_array['datamasterRate']  = '' ;
				$response_array['dataitemBalRate'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
					
		   }

	    }

	}

	public function GetDataAgainstBilty(Request $request){

		$response_array = array();

		$CompanyName = $request->session()->get('company_name');
		$explComp    = explode('-',$CompanyName);
		$comp_Code   = $explComp[0];
		$comp_Name   = $explComp[1];
		$fisYear     =  $request->session()->get('macc_year');

		if ($request->ajax()) {

			$tranCd  = $request->input('tranCd');
			$biltyNo  = $request->input('biltyNo');
			$splitNo  = explode(' ', $biltyNo);
			$seriesCd = $splitNo[1];
			$vrNo     = $splitNo[2];

			if($tranCd == 'C4'){

				$biltyData  = DB::select("SELECT A.COMP_CODE,A.FY_CODE,A.TRAN_CODE,A.SERIES_CODE,A.SERIES_NAME,A.VRNO,A.BUILTY_DT,A.RECIEPT_TILL_DT,A.VEHICLE_NO,A.PLANT_CODE,A.PLANT_NAME,A.PFCT_CODE,A.PFCT_NAME,A.ACC_CODE,A.ACC_NAME,A.ITEM_CODE,A.ITEM_NAME,A.PACKING_CODE,A.PACKING_NAME,A.STORAGE_TYPE,A.RATE_PER_MONTH,A.MARKET_RATE,A.COND_GOODS,A.REMARK,A.DRIVER_NAME,A.DRIVER_IDCARD,A.DRIVER_CONTACT_NO,A.VEHICLE_TYPE,B.BILTYHID,B.BILTYBID,B.CS_CODE,B.CS_NAME,B.CHAMBER_CODE,B.CHAMBER_NAME,B.FLOOR_CODE,B.FLOOR_NAME,B.BLOCK_CODE,B.BLOCK_NAME,B.QTY AS BODYQTY,B.QTY_ISSUED,B.UM_CODE FROM BILTY_HEAD A,`BILTY_BODY` B WHERE A.BILTYHID=B.BILTYHID AND A.COMP_CODE='$comp_Code' AND A.FY_CODE='$fisYear' AND A.SERIES_CODE='$seriesCd' AND A.VRNO='$vrNo' AND B.QTY<>B.QTY_ISSUED");

				$billDone = DB::select("SELECT * FROM CS_OUTWARD_HEAD WHERE COMP_CODE='$comp_Code' AND FY_CODE='$fisYear' AND BILTY_NO='$biltyNo'");

				$postCdList ='';

			}else if($tranCd == 'S5'){

				$biltyData  = DB::select("SELECT A.*,B.CS_CODE,B.CS_NAME,B.CHAMBER_CODE,B.CHAMBER_NAME,B.FLOOR_CODE,B.FLOOR_NAME,B.BLOCK_CODE,B.BLOCK_NAME,B.QTY_ISSUED FROM CS_OUTWARD_HEAD A,CS_OUTWARD_BODY B WHERE A.OUTWARDHID=B.OUTWARDHID AND A.SBILLHID='0' AND A.SBILLHID='0' AND A.COMP_CODE='$comp_Code' AND A.FY_CODE='$fisYear' AND A.BILTY_NO='$biltyNo'");

					if($biltyData){
						
						$postCdOfAcc = DB::table('MASTER_ACC')->where('ACC_CODE',$biltyData[0]->ACC_CODE)->get();

						if($postCdOfAcc[0]->GL_CODE){
							$postCdList = $postCdOfAcc;
						}else{
							$postCdList = DB::table('MASTER_GLKEY')->select('MASTER_GLKEY.*')->leftjoin('MASTER_GL', 'MASTER_GLKEY.GL_CODE', '=', 'MASTER_GL.GL_CODE')->where('MASTER_GLKEY.ATYPE_CODE',$postCdOfAcc[0]->ATYPE_CODE)->get();
						}
						
					}else{
						$postCdOfAcc ='';
						$postCdList ='';
					}
				$billDone ='';

			}else{
				$biltyData    = '';
				$billDone     ='';
				$postCdOfAcc  ='';
				$fetch_glCode ='';
			}

		    	
		    if ($biltyData || $billDone || $postCdList) {

				$response_array['response']       = 'success';
				$response_array['dataBilty']      = $biltyData;
				$response_array['billDone']       = $billDone;
				$response_array['dataPostCdList'] = $postCdList;
	            echo $data = json_encode($response_array);

			}else{

				$response_array['response']       = 'error';
				$response_array['dataBilty']      = '';
				$response_array['billDone']       = '';
				$response_array['dataPostCdList'] = '';
                $data = json_encode($response_array);
                print_r($data);
					
		   }

	    }

	}

    public function simulationForBillCs(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$taxRowCount  = $request->input('taxRowCount');
			$taxIndCode   = $request->input('taxIndCode');
			$rate_indName = $request->input('rate_indName');
			$af_rate      = $request->input('af_rate');
			$taxamount    = $request->input('amount');
			$taxGlCode    = $request->input('taxGlCode');
			$series_gl    = $request->input('series_glCd');
			$acc_code     = $request->input('acc_code');
			$acc_glCd     = $request->input('acc_glCd');
			$NetAmnt      = $request->input('NetAmnt');
			$userId       = $request->session()->get('userid');	

			DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','CSBI')->delete();

			for($i=0;$i<$taxRowCount;$i++){

				$rateindex   = $rate_indName[$i];
				$taxamt      = $taxamount[$i];
				$tax_gl_code = $taxGlCode[$i];
				$uniqCheck   = $taxIndCode[$i];


				$checkExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','CSBI')->get()->toArray();

				$indData = DB::table('SIMULATION_TEMP')->where('IND_CODE',$uniqCheck)->where('CREATED_BY',$userId)->where('TCFLAG','CSBI')->get()->toArray();

				if($taxamt !=0.00){

					if($rateindex == 'Z'){

					}else{

						if(empty($checkExist)){

							$idary = array(
								'IND_CODE'    => $uniqCheck,
								'DR_AMT'      => 0.00,
								'CR_AMT'      => $taxamt,
								'IND_GL_CODE' => $series_gl,
								'TCFLAG'      => 'CSBI',
								'CODE_NAME'   => 'Series Gl',
								'CREATED_BY'  => $userId,
							
							);
							DB::table('SIMULATION_TEMP')->insert($idary);

						}else  if($tax_gl_code == ''){

							$bscVal = DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$userId)->where('TCFLAG','CSBI')->get()->toArray();

							$updateId = $bscVal[0]->CREATED_BY;
							$basicAmt = $bscVal[0]->CR_AMT + $taxamt;
						
							$idary_bsic = array(
								'DR_AMT' 	  =>0.00,
								'CR_AMT'	  =>$basicAmt,
							);

							 DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('TCFLAG','CSBI')->where('CREATED_BY',$updateId)->update($idary_bsic);

						}else if(empty($indData)){

							$idary   = array(
								'IND_CODE'    => $uniqCheck,
								'DR_AMT'      => '',
								'CR_AMT'      => $taxamt,
								'IND_GL_CODE' => $tax_gl_code,
								'CODE_NAME'   => 'Tax Gl',
								'TCFLAG'      => 'CSBI',
								'CREATED_BY'  => $userId,
								
							);

							DB::table('SIMULATION_TEMP')->insert($idary);
						}else{
							$indData1 = DB::table('SIMULATION_TEMP')->where('IND_CODE',$uniqCheck)->where('TCFLAG','CSBI')->where('CREATED_BY',$userId)->get()->first();

							$newTaxAmt = $indData1->CR_AMT + $taxamt;

							$idary1 = array(
								'DR_AMT' => 0.00,
								'CR_AMT' =>$newTaxAmt,
							);

							$updatevr = DB::table('SIMULATION_TEMP')->where('IND_CODE',$uniqCheck)->where('TCFLAG','CSBI')->where('CREATED_BY',$userId)->update($idary1);
						}
					}

				}
				
			}

			$accData = array(

				'IND_CODE'    => '',
				'DR_AMT'      => $NetAmnt,
				'CR_AMT'      => '',
				'IND_GL_CODE' => $acc_glCd,
				'TCFLAG'      => 'CSBI',
				'CODE_NAME'   => 'Acc Code',
				'CREATED_BY'  => $userId,
			);

			DB::table('SIMULATION_TEMP')->insert($accData);

			$response_array = array();

			$taxData = DB::select("SELECT t1.*,t2.GL_NAME as glName,t3.ACC_NAME AS accName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE LEFT JOIN MASTER_ACC t3 ON t3.ACC_CODE =t1.IND_ACC_CODE WHERE t1.CREATED_BY='$userId' AND t1.TCFLAG='CSBI'");

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

/* ----------------- END : AJAX FUNCTION ---------------- */

/* ------------- PDF GENERATE ------------ */
	
	public function GeneratePdfForColdStorage($userId,$getcom_code,$plant_code,$headId,$headtable,$bodytable,$columnheadid,$pdfName,$vrPName,$tCode){

		$response_array = array();

		if($tCode == 'C3'){

			$dataheadB = DB::SELECT("SELECT A.*,B.*,B.QTY AS bodyQty,C.ADD1,C.CITY_NAME,C.DIST_NAME,C.CONTACT_NO,C.CONTACT_PERSON,C.GST_NUM FROM $headtable A,$bodytable B,MASTER_ACCADD C WHERE A.$columnheadid=B.$columnheadid AND A.ACC_CODE = C.ACC_CODE AND A.$columnheadid='$headId'");

			$itemCD = $dataheadB[0]->ITEM_CODE;
			//DB::enableQueryLog();
			$itemCategory = DB::SELECT("SELECT B.ICATG_NAME FROM `MASTER_ITEM` A,MASTER_ITEM_CATEGORY B WHERE A.ICATG_CODE=B.ICATG_CODE AND A.ITEM_CODE='$itemCD'");
			//dd(DB::getQueryLog());
		}else if($tCode == 'C4'){

			$dataheadB = DB::SELECT("SELECT A.*,B.*,C.ADD1,C.CITY_NAME,C.DIST_NAME,C.CONTACT_NO,C.CONTACT_PERSON,C.GST_NUM FROM $headtable A,$bodytable B,MASTER_ACCADD C WHERE A.$columnheadid=B.$columnheadid AND A.ACC_CODE = C.ACC_CODE AND A.$columnheadid='$headId'");

			$itemCategory='';
		}
		
		$compDetail = DB::SELECT("SELECT A.*,B.COMP_NAME,B.COMP_CODE FROM `MASTER_PLANT` A,MASTER_COMP B WHERE A.COMP_CODE=B.COMP_CODE AND B.COMP_CODE='$getcom_code' AND A.PLANT_CODE='$plant_code'");

		header('Content-Type: application/pdf');
		if($tCode == 'C3'){

			$pdf = PDF::loadView('admin.finance.transaction.coldStorage.bilty_data_pdf',compact('pdfName','compDetail','dataheadB','itemCategory','vrPName'));

		}else if($tCode == 'C4'){

			$pdf = PDF::loadView('admin.finance.transaction.coldStorage.cs_gatePassPDF',compact('pdfName','compDetail','dataheadB','itemCategory','vrPName'));

		}
		
		$path        = public_path('dist/coldStoragePDF'); 
		$fileName    =  time().'.'. 'pdf' ;
		$pdf->save($path . '/' . $fileName);
		//$pdf->setPaper('A4', 'landscape');
		$PublicPath  = url('public/dist/coldStoragePDF/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url']      = $downloadPdf;
		$response_array['data']     = $dataheadB;
		echo $data = json_encode($response_array);

	}

/* ------------- PDF GENERATE ------------ */

}