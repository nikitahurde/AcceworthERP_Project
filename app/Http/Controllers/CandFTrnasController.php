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

class CandFTrnasController extends Controller
{

     public function __cunstruct(){

	}

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
		$getTBLData['jwitem_list']       = DB::table('MASTER_ITEM')->where('ITEMTYPE_CODE','JW')->get();
		$getTBLData['truck_list']        = DB::table('MASTER_FLEET')->get();
		$getTBLData['coldStorage_list']  = DB::table('MASTER_COLD_STORAGE')->where('COMP_CODE',$getcompcode)->get();
		$getTBLData['chamber_list']      = DB::table('MASTER_CHAMBER')->get();
		$getTBLData['floor_list']        = DB::table('MASTER_FLOOR_STORAGE')->get();
		$getTBLData['block_list']        = DB::table('MASTER_BLOCK_STORAGE')->get();
		$getTBLData['tran_list']         = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$tranCode)->get()->first();
		$getTBLData['customer_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','D')->get();
		$getTBLData['itemPack_list']     = DB::table('MASTER_ITEM_PACKING')->get();
		$getTBLData['vehicleEntry_list'] = DB::table('CF_GATE_ENTRY')->get();
		$getTBLData['tax_list']          = DB::table('MASTER_TAX')->get();
		$getTBLData['ratval_list']       = DB::table('MASTER_RATE_VALUE')->get()->toArray();
		$getTBLData['transporter_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$getTBLData['contractor_list']   = DB::table('MASTER_ACC')->where('ATYPE_CODE','C')->get();
		$getTBLData['consignee_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->get();
		$getTBLData['debitors_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','D')->get();
		$getTBLData['aum_list']         = DB::table('MASTER_UM')->groupBy('UM_CODE')->get();


		return $getTBLData;
	}

/* ---------- START : GATE INWARD TRANSACTION --------- */
	
	public function AddGateInwardCF(Request $request){

		$title       ='Add Gate Inward Master';
		$compDetails = $request->session()->get('company_name');
		$splitData   = explode('-',$compDetails);
		$comp_code   = $splitData[0];
		$tranCode    = 'G2';
		$allTblName = $this->AllTableName($request,$tranCode);
		$userdata['plantList']  = $allTblName['plant_list'];
		$userdata['seriesList'] = $allTblName['series_list'];
		$userdata['tranlist']   = $allTblName['tran_list'];
		
		foreach ($allTblName['fy_list'] as $key) {	

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}
		
		if(isset($compDetails)){

	    	return view('admin.finance.transaction.candf.add_gate_inward',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

    }

    public function SaveGateInwardCF(Request $request){

		$validate = $this->validate($request, [

			'datetime'       => 'required',
			'vehicle_type'   => 'required',
			'vehicle_number' => 'required|max:20',
			'trans_code'     => 'required',
			'series_code'    => 'required',
			'series_name'    => 'required',
			'plant_code'     => 'required',
			'plant_name'     => 'required',
			'pfct_code'      => 'required',
			'pfct_name'      => 'required',
			'driver_name'    => 'required|max:40',
			'driver_id'      => 'required|max:10',
			'mobile_number'  => 'required|max:10',

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

		$vrno_Exist = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_Code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$request->input('trans_code'))->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrno_Exist[0]->LAST_NO +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {

			$data            = array(
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
				"TRIP_NO"        => $request->input('trip_no'),
				"TRIPHID"        => $request->input('trip_headID'),
				"CREATED_BY"     => $createdBy,
				
			);

			

			DB::table('CF_GATE_ENTRY')->insert($data);

			/* ------ STATUS UPDATE IN TRIP HEAD ------ */

			$dataGate = array(
				'GATE_IN_STATUS' => 1
			);

			DB::table('TRIP_HEAD')->where('TRIP_WO_ITEM','1')->where('VEHICLE_NO',$request->input('vehicle_number'))->where('TRIP_NO',$request->input('trip_no'))->where('TRIPHID',$request->input('trip_headID'))->update($dataGate);

			/* ------ STATUS UPDATE IN TRIP HEAD ------ */

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
			return redirect('/transaction/CandF/View-gate-inward-transaction-cf');

		}catch (\Exception $e) {

	        DB::rollBack();
	        //throw $e;
	        $request->session()->flash('alert-error', 'Gate Inward Can Not Added...!');
			return redirect('/transaction/CandF/View-gate-inward-transaction-cf');

	    }

	}

	public function ViewGateInwardCF(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

			$title       = 'View Gate Inward';

			$userid      = $request->session()->get('userid');

			$userType    = $request->session()->get('usertype');

			$companyData = $request->session()->get('company_name');
			$splitData   = explode('-',$companyData);
			$comp_code   = $splitData[0];

			$fisYear     =  $request->session()->get('macc_year');

	    		$data = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE','G2')->orderBy('DATETIME','ASC');

	    		return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    		}

	    	if(isset($compName)){
	    		return view('admin.finance.transaction.candf.view_gate_inward');
	    	}else{
		 	return redirect('/useractivity');
	     }
    }

    public function EditGateInwardCF(Request $request,$compCd,$fyCd,$tranCd,$seriesCd,$vrNo){

    		$title = 'Edit Gate Inward Master';
    		$tranCode  = 'G2';
    		$allTblName = $this->AllTableName($request,$tranCode);
		$userdata['plantList'] = $allTblName['plant_list'];
		$userdata['tripNoList'] = DB::table('TRIP_HEAD')->get();

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
    	    		$query = DB::table('CF_GATE_ENTRY');
			$query->where('COMP_CODE', $comp_cd)->where('FY_CODE', $fy_Cd)->where('TRAN_CODE', $tran_Cd)->where('SERIES_CODE', $series_Cd)->where('VRNO', $vr_No);
			$classData= $query->get()->first();
			
			return view('admin.finance.transaction.candf.edit_gate_inward',$userdata+compact('title','classData'));

		}else{
			$request->session()->flash('alert-error', 'Gate Inward Not Found...!');
			return redirect('/transaction/ColdStorage/View-gate-inward-transaction');
		}

    	}

    	public function UpdateGateInwardCF(Request $request){

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
			"DATETIME"       => date("Y-m-d", strtotime($request->input('datetime'))),
			"PLANT_CODE"     => $request->input('plant_code'),
			"PLANT_NAME"     => $request->input('plant_name'),
			"PFCT_CODE"      => $request->input('pfct_code'),
			"PFCT_NAME"      => $request->input('pfct_name'),
			"DRIVER_NAME"    => $request->input('driver_name'),
			"DRIVER_ID"      => $request->input('driver_id'),
			"MOBILE_NUMBER"  => $request->input('mobile_number'),
			"CREATED_BY"     => $createdBy,
			
		);

		try{

			$saveData = DB::table('CF_GATE_ENTRY')->where('COMP_CODE', $comp_cd)->where('FY_CODE', $fy_Cd)->where('TRAN_CODE', $tran_Cd)->where('SERIES_CODE', $series_Cd)->where('VRNO', $vr_No)->update($data);

			/*$discriptn_page = "Gate Inward update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);*/

			if ($saveData) {

				$request->session()->flash('alert-success', 'Gate Inward Was Successfully Updated...!');
				return redirect('/transaction/CandF/View-gate-inward-transaction-cf');

			} else {

				$request->session()->flash('alert-error', 'Gate Inward Can Not Updated...!');
				return redirect('/transaction/CandF/View-gate-inward-transaction-cf');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Gate Inward Can not be be Updated...! Used In Another Transaction...!');
				return redirect('/transaction/CandF/View-gate-inward-transaction-cf');
		}

	}

	public function DeleteGateInwardCF(Request $request){

		$deletGateInward = $request->post('deletGateInward');
    	
    		$deleteField = explode('~',$deletGateInward);

		$compCd    = $deleteField[0];
		$fyCd      = $deleteField[1];
		$transCd   = $deleteField[2];
		$seriesCd  = $deleteField[3];
		$vrno      = $deleteField[4];
		$tripNo    = $deleteField[5];
		$vehicleNo = $deleteField[6];
		$tripHeadId = $deleteField[7];

	    	if (($compCd!='') && ($fyCd!='') && ($transCd!='') && ($seriesCd!='') && ($vrno!='')) {
	    		try{
	    			if(($tripNo!=null) || ($tripNo!='')){

	    				/* ------ STATUS UPDATE IN TRIP HEAD ------ */

					$dataGate = array(
						'GATE_IN_STATUS' => 0
					);

					DB::table('TRIP_HEAD')->where('TRIP_WO_ITEM','1')->where('VEHICLE_NO',$vehicleNo)->where('TRIP_NO',$tripNo)->where('TRIPHID',$tripHeadId)->update($dataGate);

					/* ------ STATUS UPDATE IN TRIP HEAD ------ */

	    			}
	    			$Delete = DB::table('CF_GATE_ENTRY')->where('COMP_CODE', $compCd)->where('FY_CODE', $fyCd)->where('TRAN_CODE', $transCd)->where('SERIES_CODE', $seriesCd)->where('VRNO', $vrno)->delete();

					if ($Delete) {

						$request->session()->flash('alert-success', 'Gate Inward Was Deleted Successfully...!');
						return redirect('/transaction/CandF/View-gate-inward-transaction-cf');

					} else {

						$request->session()->flash('alert-error', 'Gate Inward Can Not Deleted...!');
						return redirect('/transaction/CandF/View-gate-inward-transaction-cf');

					}
				}catch(Exception $ex)
				{
				    $request->session()->flash('alert-error', 'Gate Inward Can not be be Updated...! Used In Another Transaction...!');
						return redirect('/transaction/CandF/View-gate-inward-transaction-cf');
				}

	    	}else{

	    		$request->session()->flash('alert-error', 'Gate Inward Not Found...!');
				return redirect('/transaction/CandF/View-gate-inward-transaction-cf');

	    	}

	}

/* ---------- END : GATE INWARD TRANSACTION --------- */

/* ---------- START : GATE OUTWARD TRANSACTION --------- */
	
	public function AddGateOutwardCF(Request $request){

		$title      ='Add Gate Outward Master';
		$compData   = $request->session()->get('company_name');
		$splitComp  = explode('-',$compData);
		$comp_code  = $splitComp[0];
		$tranCode   = 'G2';
		$fisYear    = $request->session()->get('macc_year');
		$userdata['tripNoList'] = DB::table('TRIP_HEAD')->get();
		$allTblName = $this->AllTableName($request,$tranCode);

		foreach ($allTblName['fy_list'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$userdata['tranlist']   = $allTblName['tran_list'];
		

		if(isset($compData)){

	    	return view('admin.finance.transaction.candf.add_gate_outward',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

    }

    public function SaveGateOutwardCF(Request $request){

		$loginUser   = $request->session()->get('userid');
		$CompanyName = $request->session()->get('company_name');
		$splitData   = explode('-', $CompanyName);
		$comp_code   = $splitData[0];
		$fisYear     = $request->session()->get('macc_year');

		$vehicleNo   = $request->input('vehicle_number');
		$tranCd      = $request->input('trans_code');
		$seriesCd    = $request->input('series_code');
		$vrno        = $request->input('vrseqnum');
		$vehicleType = $request->input('vehicle_type');
		$biltyHId    = $request->input('biltyHId');
		$outDateTime = $request->input('outTime');
		$tripHid = $request->input('tripHid');
		$cfgateId = $request->input('cfgateId');

		$dateTimeout = date('Y-m-d H:i:s',strtotime($outDateTime));

			//print_r($cfgateId);exit;

			//print_r($dateTimeout);exit;


	    	$data = array(
				'VEHICLE_OUT_DATETIME' => $dateTimeout,
				'LAST_UPDATE_BY'       => $loginUser
	    	);
	    	//DB::enableQueryLog();
	    	/*$saveData = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('VEHICLE_NUMBER',$vehicleNo)->where('VEHICLE_TYPE',$vehicleType)->where('TRAN_CODE',$tranCd)->where('SERIES_CODE',$seriesCd)->where('VRNO',$vrno)->update($data);*/
	    	$saveData = DB::table('CF_GATE_ENTRY')->where('CFGATEID',$cfgateId)->update($data);


	    	$tripdata = array(

				'VEHICLE_OUT_DT_TIME'=>$dateTimeout,
				'GATE_OUT_STATUS' =>1,
	    	);

	    	$updateData = DB::table('TRIP_HEAD')->where('TRIPHID',$tripHid)->update($tripdata);
	    	//dd(DB::getQueryLog());
	    	//print_r($saveData);exit;
	    	if($saveData == 1){
			$request->session()->flash('alert-success', 'Gate Outward Was Successfully Added...!');
			return redirect('/transaction/CandF/view-gate-outward-transaction-cf');
	    	}else{
	    		$request->session()->flash('alert-error', 'Gate Outward Can Not Added...!');
			return redirect('/transaction/CandF/view-gate-outward-transaction-cf');
	    	}
		    	
		    	/*$dataTwo = array(
		    		'GATE_OUTWARD'=> 'YES'
		    	);

		    	DB::table('BILTY_HEAD')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('VEHICLE_NO',$vehicleNo)->where('BILTYHID',$biltyHId)->update($dataTwo);*/	

    }

    public function ViewGateOutwardCF(Request $request){

    	$title = 'View Gate Outward';
    	$userid	= $request->session()->get('userid');
    	$userType = $request->session()->get('usertype');
    	$compNameFull = $request->session()->get('company_name');

		if($request->ajax()) {

			$splitComp = explode('-', $compNameFull);
			$comp_code = $splitComp[0];

	    	$data = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->whereNotNull('VEHICLE_OUT_DATETIME')->orderBy('DATETIME','ASC');
	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}

    	if(isset($compNameFull)){
    		return view('admin.finance.transaction.candf.view_gate_outward');
    	}else{
	 		return redirect('/useractivity');
   		}
    }

/* ---------- END : GATE OUTWARD TRANSACTION --------- */


/* -------- START : INWARD TRANSACTION ---------- */

	public function InwardTrans(Request $request){

		$user_type     = $request->session()->get('user_type');
		$userid        = $request->session()->get('userid');
		$comapnyDetail = $request->session()->get('company_name');
		$MaccYear      = $request->session()->get('macc_year');
		$splitData     = explode('-', $comapnyDetail);
		$com_code      = $splitData[0];
		
		$title    = 'Add Inward Transaction';
		$tranCode = 'G3';
		$allTblName                   = $this->AllTableName($request,$tranCode);
		$userData['seriesList']       = $allTblName['series_list'];
		$userData['tranlist']         = $allTblName['tran_list'];
		$userData['transporter_list'] = $allTblName['transporter_list'];
		$userData['contractor_list']  = $allTblName['contractor_list'];
		$userData['consignee_list']   = $allTblName['consignee_list'];
		$userData['aum_list']         = $allTblName['aum_list'];

		foreach ($allTblName['fy_list'] as $key) {
			$userData['fromDate'] =  $key->FY_FROM_DATE;
			$userData['toDate']   =  $key->FY_TO_DATE;
		}

		$userData['vehicle_list']     = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$com_code)->where('FY_CODE',$MaccYear)->where('TRAN_CODE','G2')->where('VEHICLE_TYPE','GRN')->where('CFINWARDID','0')->get();
		
		$userData['rakeNo_list']      = DB::table('RAKE_TRAN')->where('COMP_CODE',$com_code)->where('CFINWARD_STATUS','0')->groupBy('RAKE_NO')->get();
	
    		return view('admin.finance.transaction.candf.inward_trans',$userData+compact('title'));

    }

    public function SaveInwardTrans(Request $request){

		$compDetail = $request->session()->get('company_name');
		$spliData   = explode('-', $compDetail);
		$comp_Code  = $spliData[0];
		$comp_Name  = $spliData[1];
		$fisYear    = $request->session()->get('macc_year');
		$userId     = $request->session()->get('userid');

		$vrno          = $request->input('vrseqnum');
		$batch_No      = $request->input('batch_No');
		$itemCd        = $request->input('item_code');
		$itemNm        = $request->input('item_name');
		$storeLocCd    = $request->input('location_code');
		$storeLocNm    = $request->input('location_name');
		$qty_recd      = $request->input('qty_recd');
		$qty_Arecd     = $request->input('qty_Arecd');
		$rakeQty       = $request->input('rake_Qty');
		$rakeAQty      = $request->input('rake_AQty');
		$umCd          = $request->input('umCode');
		$aumCd         = $request->input('aumCode');
		$rakeNo        = $request->input('rake_no');
		$cFactor       = $request->input('cFactor');
		$gateEntryVrno = $request->input('gateEntryVrno');
		$slip_no       = $request->input('slip_no');
		$vrDateTrans   = date("Y-m-d", strtotime($request->input('transaction_date')));
		$rowCount      = $request->input('rowCount');
		$totalRow      = count($rowCount);

		if($vrno == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrno;
		}

		$vrno_Exist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('tran_code'))->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_Code)->where('FY_CODE',$fisYear)->get()->toArray();

		//$vrno_Exist = DB::table('CFINWARD_TRAN')->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_Code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$request->input('tran_code'))->where('VRNO',$vrNum)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrno_Exist[0]->LAST_NO +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {

			for($i=0;$i<$totalRow;$i++){
				$slno = $i + 1;

				if($request->input('tranPort_Type') == 'BY_RAKE'){

					$slitBatch   = explode('~',$batch_No[$i]);
					$batchNo     = $slitBatch[0];
					$batchslnoNo = $slitBatch[1];

					$getRakeDetails = DB::table('RAKE_TRAN')->where('COMP_CODE',$comp_Code)->where('RAKE_NO',$rakeNo)->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->get()->first();
					$rakeDate     = $getRakeDetails->RAKE_DATE;
					$placeDate    = $getRakeDetails->PLACE_DATE;
					$accCode      = $getRakeDetails->ACC_CODE;
					$accName      = $getRakeDetails->ACC_NAME;
					$vrDate       = $getRakeDetails->VRDATE;
					$orderSlno    = $getRakeDetails->SLNO;
					$orderNo      = $getRakeDetails->ORDER_NO;
					$orderDate    = $getRakeDetails->ORDER_DATE;
					$cpCode       = $getRakeDetails->CP_CODE;
					$cpName       = $getRakeDetails->CP_NAME;
					$cpAdd        = $getRakeDetails->CP_ADD;
					$spCode       = $getRakeDetails->SP_CODE;
					$spName       = $getRakeDetails->SP_NAME;
					$spAdd        = $getRakeDetails->SP_ADD;
					$routeCode    = $getRakeDetails->ROUTE_CODE;
					$routeName    = $getRakeDetails->ROUTE_NAME;
					$fromPlace    = $getRakeDetails->FROM_PLACE;
					$toPlace      = $getRakeDetails->TO_PLACE;
					$dorderQty    = $getRakeDetails->DORDER_QTY;
					$lotNo        = $getRakeDetails->LOT_NO;
					$aliasCode    = $getRakeDetails->ALIAS_CODE;
					$aliasName    = $getRakeDetails->ALIAS_NAME;
					$length       = $getRakeDetails->LENGTH;
					$width        = $getRakeDetails->WIDTH;
					$height       = $getRakeDetails->HEIGHT;
					$odc          = $getRakeDetails->ODC;
					$remark       = $getRakeDetails->REMARK;
					$invoiceNo    = $getRakeDetails->INVOICE_NO;
					$invoiceDate  = $getRakeDetails->INVOICE_DATE;
					$wagonNo      = $getRakeDetails->WAGON_NO;
					$obdNo        = $getRakeDetails->OBD_NO;
					$ewayBillNo   = $getRakeDetails->EWAY_BILL_NO;
					$ewayBillDate = $getRakeDetails->EWAY_BILL_DT;
					$cam_no       = $getRakeDetails->CAM_NO;
					$deviveryNo   = $getRakeDetails->DELIVERY_NO;
					$batch_Num    = $batchNo;
					$batch_slno   = $batchslnoNo;

				}else if($request->input('tranPort_Type') == 'BY_ROAD'){
					$rakeDate     = '';
					$placeDate    = '';
					$accCode      = $request->input('customer_code');
					$accName      = $request->input('customer_name');
					$vrDate       = '';
					$orderSlno    = '';
					$orderNo      = $request->input('order_no');
					$orderDate    = $request->input('order_date');
					$cpCode       = $request->input('cp_code');
					$cpName       = $request->input('cp_name');
					$cpAdd        = '';
					$spCode       = '';
					$spName       = '';
					$spAdd       = '';
					$routeCode    = '';
					$routeName    = '';
					$fromPlace    = '';
					$toPlace      = '';
					$dorderQty    = '';
					$lotNo        = '';
					$aliasCode    = '';
					$aliasName    = '';
					$length       = '';
					$width        = '';
					$height       = '';
					$odc          = '';
					$remark       = '';
					$invoiceNo    = $request->input('invoice_no');
					$invoiceDate  = $request->input('invoice_date');
					$wagonNo      = '';
					$obdNo        = '';
					$ewayBillNo   = '';
					$ewayBillDate = '';
					$cam_no       = '';
					$deviveryNo   = '';
					$batch_Num    = $batch_No[$i];
					$batch_slno   = $slno;
				}

				/* ---------- FIND ODC  --------------- */


				$getItem1 = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCd[$i])->get()->first();

				$getItem = json_decode(json_encode($getItem1),true);

				if(isset($getItem['LENGTH'])){

				    $L = $getItem['LENGTH'];

				}else{

				    $L = '0';
				}

				if(isset($getItem['WIDTH'])){

				    $W = $getItem['WIDTH'];

				}else{

				    $W = '0';
				}

				if(isset($getItem['HEIGHT'])){

				    $H = $getItem['HEIGHT'];

				}else{

				    $H = '0';
				}




				if ($length > $L && $width > $W  && $height > $H){

					$ODCFLAG = 'TWO SIDE ODC';
						
				}else if($width > $W  && $height > $H || $length > $L && $width > $W || $length > $L && $height > $H){

					$ODCFLAG = 'TWO SIDE ODC';

				}else if($length > $L || $width > $W  || $height > $H){

					$ODCFLAG = 'ONE SIDE ODC';

				}else{

					$ODCFLAG = 'NO';

				}

			/* ---------- /. FIND ODC  --------------- */

				$data = array(

					'COMP_CODE'        => $comp_Code,
					'COMP_NAME'        => $comp_Name,
					'FY_CODE'          => $fisYear,
					'TRAN_CODE'        => $request->input('tran_code'),
					'SERIES_CODE'      => $request->input('series_code'),
					'SERIES_NAME'      => $request->input('series_name'),
					'SLNO'             => $batch_slno,
					'VRNO'             => $NewVrno,
					'RAKE_DATE'        => $rakeDate,
					'PLACE_DATE'       => $placeDate,
					'ACC_CODE'         => $accCode,
					'ACC_NAME'         => $accName,
					'VRDATE'           => $vrDateTrans,
					'ORDER_SLNO'       => $orderSlno,
					'ORDER_NO'         => $orderNo,
					'ORDER_DATE'       => $orderDate,
					'CP_CODE'          => $cpCode,
					'CP_NAME'          => $cpName,
					'CP_ADD'           => $cpAdd,
					'SP_CODE'          => $spCode,
					'SP_NAME'          => $spName,
					'SP_ADD'           => $spAdd,
					'ROUTE_CODE'       => $routeCode,
					'ROUTE_NAME'       => $routeName,
					'FROM_PLACE'       => $fromPlace,
					'TO_PLACE'         => $toPlace,
					'DORDER_QTY'       => $dorderQty,
					'LOT_NO'           => $lotNo,
					'ALIAS_CODE'       => $aliasCode,
					'ALIAS_NAME'       => $aliasName,
					'LENGTH'           => $length,
					'WIDTH'            => $width,
					'HEIGHT'           => $height,
					'ODC'              => $ODCFLAG,
					'SLIP_NO'          => $slip_no,
					'REMARK'           => $remark,
					'INVOICE_NO'       => $invoiceNo,
					'INVOICE_DATE'     => $invoiceDate,
					'WAGON_NO'         => $wagonNo,
					'OBD_NO'           => $obdNo,
					'DELIVERY_NO'      => $deviveryNo,
					'EWAY_BILL_NO'     => $ewayBillNo,
					'EWAY_BILL_DT'     => $ewayBillDate,
					'CAM_NO'           => $cam_no,
					'INWARD_DATE'      => date("Y-m-d", strtotime($request->input('transaction_date'))),
					'TRANSPORT_TYPE'   => $request->input('tranPort_Type'),
					'TRANSPORTER_TYPE' => $request->input('transpoterType'),
					'VEHICLE_NO'       => $request->input('vehicle_no'),
					'TRPT_CODE'        => $request->input('trans_code'),
					'TRPT_NAME'        => $request->input('trans_name'),
					'PLANT_CODE'       => $request->input('plant_code'),
					'PLANT_NAME'       => $request->input('plant_name'),
					'PFCT_CODE'        => $request->input('pfct_code'),
					'PFCT_NAME'        => $request->input('pfct_name'),
					'UCONT_CODE'       => $request->input('ulContractorCode'),
					'UCONT_NAME'       => $request->input('ulContractor_name'),
					'RAKE_NO'          => $request->input('rake_no'),
					'GATEIN_ID'        => $request->input('gateEntryTblId'),
					'BATCH_NO'         => $batch_Num,
					'ITEM_CODE'        => $itemCd[$i],
					'ITEM_NAME'        => $itemNm[$i],
					'QTY'              => $rakeQty[$i],
					'UM'               => $umCd[$i],
					'AQTY'             => $rakeAQty[$i],
					'AUM'              => $aumCd[$i],
					'CFACTOR'          => $cFactor[$i],
					'QTYRECD'          => $qty_recd[$i],
					'AQTYRECD'         => $qty_Arecd[$i],
					'LOCATION_CODE'    => $storeLocCd[$i],
					'LOCATION_NAME'    => $storeLocNm[$i],
					'CREATED_BY'       => $userId
				);

				DB::table('CFINWARD_TRAN')->insert($data);

				if($request->input('tranPort_Type') == 'BY_RAKE'){

					$getQtyRecd = DB::table('RAKE_TRAN')->where('COMP_CODE',$comp_Code)->where('RAKE_NO',$rakeNo)->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->get()->first();

					$qtyRecd = $getQtyRecd->QTYRECD + $qty_recd[$i];

					$qtyUp = array(
						'QTYRECD' =>$qtyRecd,
					);

					DB::table('RAKE_TRAN')->where('COMP_CODE',$comp_Code)->where('RAKE_NO',$rakeNo)->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->update($qtyUp);

					$getQtyRecd = DB::table('RAKE_TRAN')->where('COMP_CODE',$comp_Code)->where('RAKE_NO',$rakeNo)->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->get()->first();

					if(($getQtyRecd->QTYRECD == $getQtyRecd->QTY) || $getQtyRecd->QTYRECD >= $getQtyRecd->QTY){

						$vrNoUpdate = array(
							'CFINWARD_STATUS' => '1'
						);

						DB::table('RAKE_TRAN')->where('COMP_CODE',$comp_Code)->where('RAKE_NO',$rakeNo)->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->update($vrNoUpdate);

					}

					/*$vrNoUpdate = array(
						'CFINWARD_STATUS' => '1'
					);

					DB::table('RAKE_TRAN')->where('COMP_CODE',$comp_Code)->where('RAKE_NO',$rakeNo)->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->update($vrNoUpdate);*/
				}

				$particular ='';
				$qtyIssued=0.000;
				$a_qtyIssued=0.000;
				$blankVal = '';
				$stockItem = (new AccountingController)->InsertStockInStockLedger($comp_Code,$request->input('rake_no'),$rakeDate,$placeDate,$fisYear,$request->input('pfct_code'),$request->input('pfct_name'),$request->input('plant_code'),$request->input('plant_name'),$request->input('tran_code'),$request->input('series_code'),$NewVrno,$batch_slno,$accCode,$accName,$vrDateTrans,$orderNo,$orderDate,$cpCode,$cpName,$cpAdd,$spCode,$spName,$spAdd,$routeCode,$routeName,$fromPlace,$toPlace,$batch_Num,$dorderQty,$lotNo,$aliasCode,$aliasName,$itemCd[$i],$itemNm[$i],$length,$width,$height,$ODCFLAG,$remark,$rakeQty[$i],$umCd[$i],$rakeAQty[$i],$aumCd[$i],$cFactor[$i],$invoiceNo,$invoiceDate,$wagonNo,$obdNo,$ewayBillNo,$ewayBillDate,$cam_no,$request->input('vehicle_no'),$request->input('trans_code'),$request->input('trans_name'),$blankVal,$blankVal,$qty_recd[$i],$qty_Arecd[$i],$qtyIssued,$a_qtyIssued,$userId);

			}/* ---- for loop ---*/

			/* ------- UPDATE IN CS GATE ENTRY ---------- */

				$dataVehicle = array('CFINWARDID' => '1');

				DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_Code)->where('FY_CODE',$fisYear)->where('TRAN_CODE','G2')->where('VEHICLE_TYPE','GRN')->where('VRNO',$gateEntryVrno)->where('CFINWARDID','0')->where('VEHICLE_NUMBER',$request->input('vehicle_no'))->where('CFGATEID',$request->input('gateEntryTblId'))->update($dataVehicle);

			/* ------- UPDATE IN CS GATE ENTRY ---------- */

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('tran_code'))->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_Code)->where('FY_CODE',$fisYear)->get()->toArray();

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$comp_Code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$request->input('tran_code'),
					'SERIES_CODE' =>$request->input('series_code'),
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('tran_code'))->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_Code)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();
			$data['response'] = 'success';
		    $getalldata = json_encode($data);  
		    print_r($getalldata);

		}catch (\Exception $e) {

	        DB::rollBack();
	       // throw $e;
	        $data['response'] = 'error';
	        $getalldata = json_encode($data);  
	        print_r($getalldata);

	    } /* /.*/

	}/* /. main function*/

	public function inward_trans_msgCf(Request $request,$saveData){

		if ($saveData == 'false') {
			
			$request->session()->flash('alert-error', 'Inward Transaction Can Not Added...!');
			return redirect('/transaction/c-and-f/view-inward-trans');

		}else{

			$request->session()->flash('alert-success', 'Inward Transaction Was Successfully Added...!');
			return redirect('/transaction/c-and-f/view-inward-trans');

		}
	}

	public function viewInwardTrnas(Request $request){

	    	
	    	if ($request->ajax()) {

			$user_type   = $request->session()->get('user_type');
			$userid      = $request->session()->get('userid');
			$CompanyCode = $request->session()->get('company_name');
			$splitComp   = explode('-',$CompanyCode);
			$compCode    = $splitComp[0];
			$macc_year   = $request->session()->get('macc_year');
			
			/*$data = DB::table('CFINWARD_TRAN')->where('COMP_CODE',$compCode)->where('FY_CODE',$macc_year)->orderBy('INWARD_DATE','ASC')->get();*/
			//DB::enableQueryLog();	
			$data = DB::select("SELECT * FROM CFINWARD_TRAN WHERE COMP_CODE='$compCode' AND FY_CODE='$macc_year' GROUP BY VRNO,WAGON_NO");
			//dd(DB::getQueryLog());
			//$data = DB::table('CFINWARD_TRAN')->where('COMP_CODE',$compCode)->where('FY_CODE',$macc_year)->groupBy('VRNO')->get();
			
			//return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
			return DataTables()->of($data)->addIndexColumn()->make(true);
			 
	    	}

         	$title = 'View Inward Transaction';

    		return view('admin.finance.transaction.candf.view_inward_trans',compact('title'));
    }

    public function DeleteInwardTrans(Request $request){

	}

	public function EditInwardTrans($id, Request $request){

	 	
    }

    public function UpdateInwardTrans(Request $request){

    }

/* -------- END : INWARD TRAN ---------- */

/* -------- START : NEW CREATE LOADING AND PLAN ----------  */
	
	public function AddCreateLoadingAndPlan(Request $request){

		$MaccYear      = $request->session()->get('macc_year');
		$comapnyDetail = $request->session()->get('company_name');
		$splitData     = explode('-', $comapnyDetail);
		$com_code      = $splitData[0];
		$user_type     = $request->session()->get('user_type');
		$userid        = $request->session()->get('userid');
		$tranCode      = 'G4';
		$allTblName    = $this->AllTableName($request,$tranCode);
		$userData['seriesList'] = $allTblName['series_list'];
		$userData['tranlist']   = $allTblName['tran_list'];
		$title = 'Create Loading And Plan';

		//$userData['vehicleNo_list']  = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$com_code)->where('TRAN_CODE','G2')->where('VEHICLE_TYPE','TRIP')->whereNotNull('TRIP_NO')->where('LOADING_SLIP_STATUS','0')->get();

		$userData['vehicleNo_list'] = DB::select("SELECT t1.* FROM `CF_GATE_ENTRY` t1,TRIP_HEAD t2 WHERE t1.TRIPHID=t2.TRIPHID AND t1.COMP_CODE=t2.COMP_CODE AND t1.TRAN_CODE='G2' AND t1.VEHICLE_TYPE='TRIP' AND t1.LOADING_SLIP_STATUS='0' AND t1.TRIP_NO IS NOT NULL");

	    foreach ($allTblName['fy_list'] as $key) {	

			$userData['fromDate'] =  $key->FY_FROM_DATE;
			$userData['toDate']   =  $key->FY_TO_DATE;
		}

    		return view('admin.finance.transaction.candf.add_loading_and_plan',$userData+compact('title'));

	}

	public function SaveLoadingAndPlan(Request $request){

		$donwloadStatus = $request->input('pdfYesNoStatus');
		$CompanyName    = $request->session()->get('company_name');
		$splitData      = explode('-', $CompanyName);
		$comp_code      = $splitData[0];
		$fisYear        = $request->session()->get('macc_year');
		$userId         = $request->session()->get('userid');
		$rowCount       = $request->input('rowCount');
		$trpt_code      = $request->input('trpt_code');
		$trpt_name      = $request->input('trpt_name');
		$cp_code        = $request->input('cp_code');
		$cp_name        = $request->input('cp_name');
		$item_code      = $request->input('item_code');
		$item_name      = $request->input('item_name');
		$quantity       = $request->input('qunatity');
		$vrno           = $request->input('vrseqnum');
		$gateEntryVrno  = $request->input('gateEntryVrno');
		$titleName      = 'LOADING PLAN';
		if($vrno == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrno;
		}

		$vrno_Exist = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$request->input('trans_code'))->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrno_Exist[0]->LAST_NO +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {

			for($i=0;$i<count($rowCount);$i++){

				$slNo = $i+1;

				$data = array(

					'COMP_CODE'     =>$comp_code,
					'FY_CODE'       =>$fisYear,
					'TRAN_CODE'     =>$request->input('trans_code'),
					'SERIES_CODE'   =>$request->input('series_code'),
					'SERIES_NAME'   =>$request->input('series_name'),
					'VRNO'          =>$NewVrno,
					'SLNO'          =>$slNo,
					'PLANT_CODE'    =>$request->input('plant_code'),
					'PLANT_NAME'    =>$request->input('plant_name'),
					'PFCT_CODE'     =>$request->input('pfct_code'),
					'PFCT_NAME'     =>$request->input('pfct_name'),
					'VRDATE'        =>date("Y-m-d", strtotime($request->input('transaction_date'))),
					'CP_CODE'       =>$cp_code[$i],
					'CP_NAME'       =>$cp_name[$i],
					'TRPT_CODE'     =>$trpt_code[$i],
					'TRPT_NAME'     =>$trpt_name[$i],
					'ITEM_CODE'     =>$item_code[$i],
					'ITEM_NAME'     =>$item_name[$i],
					'QTY'           =>$quantity[$i],
					'TRPT_TYPE'     =>$request->input('seletedTransType'),
					'VEHICLE_NO'    =>$request->input('vehicle_no'),
					'CFGATEID'      =>$request->input('tblGateId'),
					'DRIVER_NAME'   =>$request->input('driver_name'),
					'DRIVER_ID'     =>$request->input('driver_id'),
					'MOBILE_NUMBER' =>$request->input('driver_mobNo'),
					'TRIP_NO'       =>$request->input('trip_no'),
					'CREATED_BY'    =>$userId,

				);

				DB::table('CFOUTWARD_TRAN')->insert($data);

			}/* /. for loop*/

			/* ------- UPDATE IN CS GATE ENTRY ---------- */

		        $dataVehicle = array('LOADING_SLIP_STATUS' => '1');

		        DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE','G2')->where('VEHICLE_TYPE','TRIP')->where('LOADING_SLIP_STATUS','0')->where('VRNO',$gateEntryVrno)->where('VEHICLE_NUMBER',$request->input('vehicle_no'))->where('CFGATEID',$request->input('tblGateId'))->update($dataVehicle);

		     /* ------- UPDATE IN CS GATE ENTRY ---------- */

		     /* ----- UPDATE OR INSERT IN MASTER VR SEQ ----- */

		      	$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('trans_code'))->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->toArray();

		      	if(empty($checkvrnoExist)){

			        $datavrnIn =array(
			          'COMP_CODE'   =>$comp_code,
			          'FY_CODE'     =>$fisYear,
			          'TRAN_CODE'   =>$request->input('trans_code'),
			          'SERIES_CODE' =>$request->input('series_code'),
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

			        DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('trans_code'))->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($datavrn);
			        
		      	}

		     /* ----- UPDATE OR INSERT IN MASTER VR SEQ ----- */

			DB::commit();
			$data['response'] = 'success';

			if($donwloadStatus == 1){

				return $this->GeneratePdfForCandF($titleName,$comp_code,$fisYear,$request->input('plant_code'),$NewVrno,$userId);

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

	public function loading_plan_msgCf(Request $request,$saveData){

		if ($saveData == 'false') {
			
			$request->session()->flash('alert-error', 'Loading Plan Can Not Added...!');
			return redirect('/transaction/candf/view-loading-slip');

		}else{

			$request->session()->flash('alert-success', 'Loading Plan Was Successfully Added...!');
			return redirect('/transaction/candf/view-loading-slip');

		}
	}

/* -------- END : NEW CREATE LOADING AND PLAN ----------  */

/* ----------- START : CREATE LOADING SLIP --------------- */

	public function AddCreateLoadingSlip(Request $request){

		$MaccYear      = $request->session()->get('macc_year');
		$comapnyDetail = $request->session()->get('company_name');
		$splitData     = explode('-', $comapnyDetail);
		$com_code      = $splitData[0];
		$user_type     = $request->session()->get('user_type');
		$userid        = $request->session()->get('userid');
		$tranCode      = 'G4';
		$allTblName    = $this->AllTableName($request,$tranCode);
		$userData['seriesList'] = $allTblName['series_list'];
		$userData['tranlist']   = $allTblName['tran_list'];
		
    		$title = 'Create Loading Slip';

	    	$userData['vehicleNo_list']  = DB::table('CFOUTWARD_TRAN')->where('LOADING_PLAN_STATUS','0')->groupBy('VEHICLE_NO')->get();

		return view('admin.finance.transaction.candf.add_loading_slip',$userData+compact('title'));

	}

	public function SaveLoadingSlip(Request $request){

		$donwloadStatus = $request->input('pdfYesNoStatus');
		$CompanyName    = $request->session()->get('company_name');
		$splitData      = explode('-', $CompanyName);
		$comp_code      = $splitData[0];
		$fisYear        = $request->session()->get('macc_year');
		$userId         = $request->session()->get('userid');

		$vrno           = $request->input('vrseqnum');
		$vehicle_no     = $request->input('vehicle_no');
		$tripNo         = $request->input('trpt_no');
		$tripHeadId     = $request->input('tripHeadId');
		$dOrderNo       = $request->input('sale_order_no');
		$batch_No       = $request->input('batch_no');
		$itemCd         = $request->input('item_code');
		$itemNm         = $request->input('item_name');
		$rowCount       = $request->input('rowCount');
		$quantity       = $request->input('quantity');
		$addQuantity    = $request->input('aquantity');
		$umCd           = $request->input('um');
		$consigneeCd    = $request->input('cp_code');
		$consigneeNm    = $request->input('cp_name');
		$trans_type     = $request->input('trpt_type');
		$uniqLrNo       = $request->input('uniqLrNo');
		$plantCd        = $request->input('plant_code');
		$plantNm        = $request->input('plant_name');
		$pfctCd         = $request->input('pfct_code');
		$pfctNm         = $request->input('pfct_name');
		$trpt_code      = $request->input('doTRPTCode');
		$trpt_name      = $request->input('doTRPTName');
		$inwardTBLHeadId  = $request->input('tblHeadId');
		$trtCode  = $request->input('cfTrptCode');
		$trptName  = $request->input('cfTrptName');
		$titleName      = 'LOADING SLIP';
		//$gateEntryVrno  = $request->input('gateEntryVrno');
	
		DB::beginTransaction();

		try {

			DB::table('CFOUTWARD_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$request->input('trans_code'))->where('SERIES_CODE',$request->input('series_code'))->where('VRNO',$request->input('vrseqnum'))->delete();

			for($i=0;$i<count($rowCount);$i++){

				$slitBatch   = explode('~',$batch_No[$i]);
				$batchNo     = $slitBatch[0];
				$batchslnoNo = $slitBatch[1];

				$slNo=$i+1;

				$getInwarddata = DB::table('CFINWARD_TRAN')->where('CP_CODE',$consigneeCd[$i])->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('CFINWARDID',$inwardTBLHeadId[$i])->get();

				$inward_Details = json_decode(json_encode($getInwarddata),true);
			
				$data = array(

					'COMP_CODE'        =>$comp_code,
					'FY_CODE'          =>$fisYear,
					'TRAN_CODE'        =>$request->input('trans_code'),
					'SERIES_CODE'      =>$request->input('series_code'),
					'SERIES_NAME'      =>$request->input('series_name'),
					'VRNO'             =>$request->input('vrseqnum'),
					'SLNO'             =>$batchslnoNo,
					'LR_NO'            =>'',
					'LR_SLNO'          =>$uniqLrNo[$i],
					'LR_DATE'          =>'',
					'RAKE_NO'          =>$inward_Details[0]['RAKE_NO'],
					'RAKE_DATE'        =>$inward_Details[0]['RAKE_DATE'],
					'PLACE_DATE'       =>$inward_Details[0]['PLACE_DATE'],
					'PLANT_CODE'       =>$request->input('plant_code'),
					'PLANT_NAME'       =>$request->input('plant_name'),
					'PFCT_CODE'        =>$request->input('pfct_code'),
					'PFCT_NAME'        =>$request->input('pfct_name'),
					'ACC_CODE'         =>$inward_Details[0]['ACC_CODE'],
					'ACC_NAME'         =>$inward_Details[0]['ACC_NAME'],
					'VRDATE'           =>date("Y-m-d", strtotime($request->input('transaction_date'))),
					'ORDER_NO'         =>$dOrderNo[$i],
					'ORDER_DATE'       =>$inward_Details[0]['ORDER_DATE'],
					'CP_CODE'          =>$inward_Details[0]['CP_CODE'],
					'CP_NAME'          =>$inward_Details[0]['CP_NAME'],
					'CP_ADD'           =>$inward_Details[0]['CP_ADD'],
					'SP_CODE'          =>$inward_Details[0]['SP_CODE'],
					'SP_NAME'          =>$inward_Details[0]['SP_NAME'],
					'SP_ADD'           =>$inward_Details[0]['SP_ADD'],
					'ROUTE_CODE'       =>$inward_Details[0]['ROUTE_CODE'],
					'ROUTE_NAME'       =>$inward_Details[0]['ROUTE_NAME'],
					'FROM_PLACE'       =>$inward_Details[0]['FROM_PLACE'],
					'TO_PLACE'         =>$inward_Details[0]['TO_PLACE'],
					'BATCH_NO'         =>$batchNo,
					'DORDER_QTY'       =>$inward_Details[0]['DORDER_QTY'],
					'LOT_NO'           =>$inward_Details[0]['LOT_NO'],
					'ALIAS_CODE'       =>$inward_Details[0]['ALIAS_CODE'],
					'ALIAS_NAME'       =>$inward_Details[0]['ALIAS_NAME'],
					'CFINWARDID'       =>$inward_Details[0]['CFINWARDID'],
					'ITEM_CODE'        =>$itemCd[$i],
					'ITEM_NAME'        =>$itemNm[$i],
					'LENGTH'           =>$inward_Details[0]['LENGTH'],
					'WIDTH'            =>$inward_Details[0]['WIDTH'],
					'HEIGHT'           =>$inward_Details[0]['HEIGHT'],
					'ODC'              =>$inward_Details[0]['ODC'],
					'REMARK'           =>$inward_Details[0]['REMARK'],
					'QTY'              =>$quantity[$i],
					'UM'               =>$inward_Details[0]['UM'],
					'AQTY'             =>$addQuantity[$i],
					'AUM'              =>$inward_Details[0]['AUM'],
					'CFACTOR'          =>$inward_Details[0]['CFACTOR'],
					'INVOICE_NO'       =>$inward_Details[0]['INVOICE_NO'],
					'INVOICE_DATE'     =>$inward_Details[0]['INVOICE_DATE'],
					'WAGON_NO'         =>$inward_Details[0]['WAGON_NO'],
					'WAGON_DATE'       =>'',
					'OBD_NO'           =>$inward_Details[0]['OBD_NO'],
					'DELIVERY_NO'      =>$inward_Details[0]['DELIVERY_NO'],
					'EWAY_BILL_NO'     =>$inward_Details[0]['EWAY_BILL_NO'],
					'EWAY_BILL_DT'     =>$inward_Details[0]['EWAY_BILL_DT'],
					'CAM_NO'           =>$inward_Details[0]['CAM_NO'],
					'GATEIN_ID'        =>'',
					'TRPT_TYPE'        =>$trans_type,
					'TRPT_CODE'        =>$trtCode,
					'TRPT_NAME'        =>$trptName,
					'VEHICLE_NO'       =>$vehicle_no,
					'QTYISSUED'        =>'0.000',	
					'AQTISSUED'        =>'0.000',
					'MATERIAL_VALUE'   =>'0.00',
					'LCONT_CODE'       =>$inward_Details[0]['UCONT_CODE'],
					'LCONT_NAME'       =>$inward_Details[0]['UCONT_NAME'],
					'LOCATION_CODE'    =>$inward_Details[0]['LOCATION_CODE'],
					'LOCATION_NAME'    =>$inward_Details[0]['LOCATION_NAME'],
					'DRIVER_NAME'      =>$request->input('driver_name'),
					'DRIVER_ID'        =>$request->input('driver_id'),
					'MOBILE_NUMBER'    =>$request->input('driver_mobielNo'),
					'LOADING_PLAN_STATUS'=>'1',
					'LOADING_STATUS'=>'1',
					'TRIP_NO'          =>$tripNo,
					'LR_REMARK'        =>'',
					'FLAG'             =>'',
					'LR_STATUS'        =>'',
					'CREATED_BY'       =>$userId,

				);

				DB::table('CFOUTWARD_TRAN')->insert($data);

				/* ------- UPDATE IN INWARD ENTRY ---------- */

					$getQtyRecd = DB::table('CFINWARD_TRAN')->where('CP_CODE',$consigneeCd[$i])->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('CFINWARDID',$inwardTBLHeadId[$i])->where('LOADING_SLIP_STATUS','0')->get()->first();

					$qtyRecd = $getQtyRecd->LOADSLIP_QTY + $quantity[$i];

					$qtyUp = array(
						'LOADSLIP_QTY' =>$qtyRecd,
					);

					DB::table('CFINWARD_TRAN')->where('CP_CODE',$consigneeCd[$i])->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('CFINWARDID',$inwardTBLHeadId[$i])->where('LOADING_SLIP_STATUS','0')->update($qtyUp);

					$chkQtyDone = DB::table('CFINWARD_TRAN')->where('CP_CODE',$consigneeCd[$i])->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('CFINWARDID',$inwardTBLHeadId[$i])->where('LOADING_SLIP_STATUS','0')->get()->first();

					if($chkQtyDone->QTYRECD == $chkQtyDone->LOADSLIP_QTY){

						$dataLoadingSlip = array('LOADING_SLIP_STATUS' => '1');

			        	DB::table('CFINWARD_TRAN')->where('CP_CODE',$consigneeCd[$i])->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('CFINWARDID',$inwardTBLHeadId[$i])->where('LOADING_SLIP_STATUS','0')->update($dataLoadingSlip);

					}

				/* ------- UPDATE IN INWARD ENTRY ---------- */

				/* ------- UPDATE IN INWARD ENTRY ---------- */

			        /*$dataLoadingSlip = array('LOADING_SLIP_STATUS' => '1');

			        DB::table('CFINWARD_TRAN')->where('CP_CODE',$consigneeCd[$i])->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('LOADING_SLIP_STATUS','0')->update($dataLoadingSlip);*/

			     /* ------- UPDATE IN INWARD ENTRY ---------- */

				
			} /* for loop*/

			DB::commit();
			$data['response'] = 'success';

			if($donwloadStatus == 1){

				return $this->GeneratePdfForCandF($titleName,$comp_code,$fisYear,$plantCd,$request->input('vrseqnum'),$userId);

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

	} /* /. MAIN FUNCTION  */
	
	public function AddCreateLoadingSlipWOPlan(Request $request){

		$MaccYear      = $request->session()->get('macc_year');
		$comapnyDetail = $request->session()->get('company_name');
		$splitData     = explode('-', $comapnyDetail);
		$com_code      = $splitData[0];
		$user_type     = $request->session()->get('user_type');
		$userid        = $request->session()->get('userid');
		$tranCode      = 'G4';
		$allTblName    = $this->AllTableName($request,$tranCode);
		$userData['seriesList'] = $allTblName['series_list'];
		$userData['tranlist']   = $allTblName['tran_list'];
		$userData['jwitem_list']   = $allTblName['jwitem_list'];
		$userData['trptlist']   = $allTblName['transporter_list'];
		$userData['contractor_list']  = $allTblName['contractor_list'];
		$userData['consignee_list']   = $allTblName['consignee_list'];
		$userData['umList']   = DB::table('MASTER_UM')->get();
		
    		$title = 'Create Loading Slip';

	    	$userData['vehicleNo_list']  = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$com_code)->where('TRAN_CODE','G2')->where('VEHICLE_TYPE','TRIP')->whereNotNull('TRIP_NO')->where('LOADING_SLIP_STATUS','0')->get();

	    	$userData['orderNo_list']  = DB::select("SELECT *,(QTYRECD-LOADSLIP_QTY-QTYISSUED) AS LOADBALQTY FROM CFINWARD_TRAN WHERE LOADING_SLIP_STATUS='0'");

	    	//$userData['orderNo_list']  = DB::table('CFINWARD_TRAN')->where('LOADING_SLIP_STATUS','0')->get();

	    	$userData['customer_list']  = DB::table('CFINWARD_TRAN')->where('LOADING_SLIP_STATUS','0')->where('TRANSPORT_TYPE','BY_ROAD')->groupBy('ACC_CODE')->get();

			foreach ($allTblName['fy_list'] as $key) {	

				$userData['fromDate'] =  $key->FY_FROM_DATE;
				$userData['toDate']   =  $key->FY_TO_DATE;
			}

		return view('admin.finance.transaction.candf.add_loading_slip_WP',$userData+compact('title'));

    		//return view('admin.finance.transaction.candf.add_loading_slip_WP',$userData+compact('title'));

	}

	public function SaveLoadingSlipWihoutPlan(Request $request){

		/*echo '<pre>';
		print_r($request->post());exit;
		echo '</pre>';*/

		$donwloadStatus = $request->input('pdfYesNoStatus');
		$CompanyName    = $request->session()->get('company_name');
		$splitData      = explode('-', $CompanyName);
		$comp_code      = $splitData[0];
		$fisYear        = $request->session()->get('macc_year');
		$userId         = $request->session()->get('userid');

		$vrno           = $request->input('vrseqnum');
		$vehicleNum     = $request->input('vehicle_no');
		$tripNo         = $request->input('trip_no');
		$tripHeadId     = $request->input('tripHeadId');
		$dOrderNo       = $request->input('sOrderNo');
		$batch_No       = $request->input('batch_no');
		$itemCd         = $request->input('item_code');
		$itemNm         = $request->input('item_name');
		$rowCount       = $request->input('rowCount');
		$quantity       = $request->input('quantity');
		$addQuantity    = $request->input('addQuantity');
		$umCd           = $request->input('um_code');
		$consigneeCd    = $request->input('cp_code');
		$consigneeNm    = $request->input('cp_name');
		$trans_type     = $request->input('seletedTransType');
		$uniqLrNo       = $request->input('uniqLrNo');
		$plantCd        = $request->input('plant_code');
		$plantNm        = $request->input('plant_name');
		$pfctCd         = $request->input('pfct_code');
		$pfctNm         = $request->input('pfct_name');
		$trpt_code      = $request->input('doTRPTCode');
		$trpt_name      = $request->input('doTRPTName');
		$gateEntryVrno  = $request->input('gateEntryVrno');
		$transport_type    = $request->input('charge_type');
		$customer_code    = $request->input('customer_code');
		$customer_name    = $request->input('customer_name');
		$trptCode       = $request->input('trpt_code');
		$trptName       = $request->input('trpt_name');
		$jobWork        = $request->input('jobWork');
		$jobwrokitemName  = $request->input('jobwrokitemName');
		$inwardTBLHeadId  = $request->input('tblHeadId');
		$tblGateId  = $request->input('tblGateId');
		$titleName       = 'LOADING SLIP';
		if($vrno == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrno;
		}

		$splitVehicle = explode('~', $vehicleNum);

		$vehicle_no = $splitVehicle[0];

		//DB::enableQueryLog();	
		$vrno_Exist = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$request->input('trans_code'))->get()->toArray();
		//dd(DB::getQueryLog());
		if($vrno_Exist){
			$NewVrno = $vrno_Exist[0]->LAST_NO +1;
		}else{
			$NewVrno = $vrNum;
		}
	
		DB::beginTransaction();

		try {

			for($i=0;$i<count($rowCount);$i++){

				$slitBatch   = explode('~',$batch_No[$i]);
				$batchNo     = $slitBatch[0];
				$batchslnoNo = $slitBatch[1];

				$slNo=$i+1;

				$getInwarddata = DB::table('CFINWARD_TRAN')->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('CFINWARDID',$inwardTBLHeadId[$i])->where('LOADING_SLIP_STATUS','0')->get();

				$inward_Details = json_decode(json_encode($getInwarddata),true);

				/* ---------- FIND ODC  --------------- */


				$getItem1 = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCd[$i])->get()->first();

				$getItem = json_decode(json_encode($getItem1),true);

				if(isset($getItem['LENGTH'])){

				    $L = $getItem['LENGTH'];

				}else{

				    $L = '0';
				}

				if(isset($getItem['WIDTH'])){

				    $W = $getItem['WIDTH'];

				}else{

				    $W = '0';
				}

				if(isset($getItem['HEIGHT'])){

				    $H = $getItem['HEIGHT'];

				}else{

				    $H = '0';
				}


				if ($inward_Details[0]['LENGTH'] > $L && $inward_Details[0]['WIDTH'] > $W  && $inward_Details[0]['HEIGHT'] > $H){

					$ODCFLAG = 'TWO SIDE ODC';
						
				}else if($inward_Details[0]['WIDTH'] > $W  && $inward_Details[0]['HEIGHT'] > $H || $inward_Details[0]['LENGTH'] > $L && $inward_Details[0]['WIDTH'] > $W || $inward_Details[0]['LENGTH'] > $L && $inward_Details[0]['HEIGHT'] > $H){

					$ODCFLAG = 'TWO SIDE ODC';

				}else if($inward_Details[0]['LENGTH'] > $L || $inward_Details[0]['WIDTH'] > $W  || $inward_Details[0]['HEIGHT'] > $H){

					$ODCFLAG = 'ONE SIDE ODC';

				}else{

					$ODCFLAG = 'NO';

				}

			/* ---------- /. FIND ODC  --------------- */

				if($transport_type=='BY_ROAD'){
					$accCode = $customer_code;
                    $accName = $customer_name;
                    $transporter_code = $trptCode;
                    $transporter_name = $trptName;
                    $jobWorkItem_code = $jobWork[$i];
                    $jobWorkItem_name = $jobwrokitemName[$i];
				}else{
					$accCode = $inward_Details[0]['ACC_CODE'];
                    $accName = $inward_Details[0]['ACC_NAME'];
			       	$transporter_code = $trpt_code[$i];
			        $transporter_name = $trpt_name[$i];
			        $jobWorkItem_code = '';
			        $jobWorkItem_name = '';
				}
			
				$data = array(

					'COMP_CODE'        =>$comp_code,
					'FY_CODE'          =>$fisYear,
					'TRAN_CODE'        =>$request->input('trans_code'),
					'SERIES_CODE'      =>$request->input('series_code'),
					'SERIES_NAME'      =>$request->input('series_name'),
					'VRNO'             =>$NewVrno,
					'SLNO'             =>$batchslnoNo,
					'LR_NO'            =>'',
					'LR_SLNO'          =>$uniqLrNo[$i],
					'LR_DATE'          =>'',
					'RAKE_NO'          =>$inward_Details[0]['RAKE_NO'],
					'RAKE_DATE'        =>$inward_Details[0]['RAKE_DATE'],
					'PLACE_DATE'       =>$inward_Details[0]['PLACE_DATE'],
					'PLANT_CODE'       =>$request->input('plant_code'),
					'PLANT_NAME'       =>$request->input('plant_name'),
					'PFCT_CODE'        =>$request->input('pfct_code'),
					'PFCT_NAME'        =>$request->input('pfct_name'),
					'ACC_CODE'         =>$accCode,
					'ACC_NAME'         =>$accName,
					'VRDATE'           =>date("Y-m-d", strtotime($request->input('transaction_date'))),
					'ORDER_NO'         =>$dOrderNo[$i],
					'ORDER_DATE'       =>$inward_Details[0]['ORDER_DATE'],
					'CP_CODE'          =>$inward_Details[0]['CP_CODE'],
					'CP_NAME'          =>$inward_Details[0]['CP_NAME'],
					'CP_ADD'           =>$inward_Details[0]['CP_ADD'],
					'SP_CODE'          =>$inward_Details[0]['SP_CODE'],
					'SP_NAME'          =>$inward_Details[0]['SP_NAME'],
					'SP_ADD'           =>$inward_Details[0]['SP_ADD'],
					'ROUTE_CODE'       =>$inward_Details[0]['ROUTE_CODE'],
					'ROUTE_NAME'       =>$inward_Details[0]['ROUTE_NAME'],
					'FROM_PLACE'       =>$inward_Details[0]['FROM_PLACE'],
					'TO_PLACE'         =>$inward_Details[0]['TO_PLACE'],
					'BATCH_NO'         =>$batchNo,
					'DORDER_QTY'       =>$inward_Details[0]['DORDER_QTY'],
					'LOT_NO'           =>$inward_Details[0]['LOT_NO'],
					'ALIAS_CODE'       =>$inward_Details[0]['ALIAS_CODE'],
					'ALIAS_NAME'       =>$inward_Details[0]['ALIAS_NAME'],
					'CFINWARDID'       =>$inward_Details[0]['CFINWARDID'],
					'ITEM_CODE'        =>$itemCd[$i],
					'ITEM_NAME'        =>$itemNm[$i],
					'LENGTH'           =>$inward_Details[0]['LENGTH'],
					'WIDTH'            =>$inward_Details[0]['WIDTH'],
					'HEIGHT'           =>$inward_Details[0]['HEIGHT'],
					'ODC'              =>$ODCFLAG,
					'REMARK'           =>$inward_Details[0]['REMARK'],
					'QTY'              =>$quantity[$i],
					'UM'               =>$inward_Details[0]['UM'],
					'AQTY'             =>$addQuantity[$i],
					'AUM'              =>$inward_Details[0]['AUM'],
					'CFACTOR'          =>$inward_Details[0]['CFACTOR'],
					'INVOICE_NO'       =>$inward_Details[0]['INVOICE_NO'],
					'INVOICE_DATE'     =>$inward_Details[0]['INVOICE_DATE'],
					'WAGON_NO'         =>$inward_Details[0]['WAGON_NO'],
					'WAGON_DATE'       =>'',
					'OBD_NO'           =>$inward_Details[0]['OBD_NO'],
					'DELIVERY_NO'      =>$inward_Details[0]['DELIVERY_NO'],
					'EWAY_BILL_NO'     =>$inward_Details[0]['EWAY_BILL_NO'],
					'EWAY_BILL_DT'     =>$inward_Details[0]['EWAY_BILL_DT'],
					'CAM_NO'           =>$inward_Details[0]['CAM_NO'],
					'GATEIN_ID'        =>'',
					'TRPT_TYPE'        =>$trans_type,
					'TRPT_CODE'        =>$transporter_code,
					'TRPT_NAME'        =>$transporter_name,
					'TRANSPORT_TYPE'   =>$transport_type,
					'JWITEM_CODE'      =>$jobWorkItem_code,
					'JWITEM_NAME'      =>$jobWorkItem_name,
					'VEHICLE_NO'       =>$vehicle_no,
					'QTYISSUED'        =>'0.000',	
					'AQTISSUED'        =>'0.000',
					'MATERIAL_VALUE'   =>'0.00',
					'LCONT_CODE'       =>$inward_Details[0]['UCONT_CODE'],
					'LCONT_NAME'       =>$inward_Details[0]['UCONT_NAME'],
					'LOCATION_CODE'    =>$inward_Details[0]['LOCATION_CODE'],
					'LOCATION_NAME'    =>$inward_Details[0]['LOCATION_NAME'],
					'DRIVER_NAME'      =>$request->input('driver_name'),
					'DRIVER_ID'        =>$request->input('driver_id'),
					'MOBILE_NUMBER'    =>$request->input('driver_mobNo'),
					'LOADING_PLAN_STATUS'=>'1',
					'LOADING_STATUS'=>'2',
					'TRIP_NO'          =>$tripNo,
					'TRIPHID'          =>$tripHeadId,
					'CFGATEID'         =>$tblGateId,
					'LR_REMARK'        =>'',
					'FLAG'             =>'',
					'LR_STATUS'        =>'',
					'CREATED_BY'       =>$userId,

				);

				DB::table('CFOUTWARD_TRAN')->insert($data);

				/* ------- UPDATE IN INWARD ENTRY ---------- */

					$getQtyRecd = DB::table('CFINWARD_TRAN')->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('CFINWARDID',$inwardTBLHeadId[$i])->where('LOADING_SLIP_STATUS','0')->get()->first();

					$qtyRecd = $getQtyRecd->LOADSLIP_QTY + $quantity[$i];

					$qtyUp = array(
						'LOADSLIP_QTY' =>$qtyRecd,
					);

					DB::table('CFINWARD_TRAN')->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('CFINWARDID',$inwardTBLHeadId[$i])->where('LOADING_SLIP_STATUS','0')->update($qtyUp);

					/*$chkQtyDone = DB::table('CFINWARD_TRAN')->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('CFINWARDID',$inwardTBLHeadId[$i])->where('LOADING_SLIP_STATUS','0')->get()->first();

					if($chkQtyDone->QTYRECD == $chkQtyDone->LOADSLIP_QTY){

						$dataLoadingSlip = array('LOADING_SLIP_STATUS' => '1');

			        	DB::table('CFINWARD_TRAN')->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('CFINWARDID',$inwardTBLHeadId[$i])->where('LOADING_SLIP_STATUS','0')->update($dataLoadingSlip);

					}*/

			     /* ------- UPDATE IN INWARD ENTRY ---------- */

			} /* for loop*/

			/* ------- UPDATE IN CS GATE ENTRY ---------- */

		        $dataVehicle = array('LOADING_SLIP_STATUS' => '1');

		        /*DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE','G2')->where('VEHICLE_TYPE','TRIP')->where('LOADING_SLIP_STATUS','0')->where('VRNO',$gateEntryVrno)->where('VEHICLE_NUMBER',$request->input('vehicle_no'))->update($dataVehicle);*/
		        DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE','G2')->where('VEHICLE_TYPE','TRIP')->where('LOADING_SLIP_STATUS','0')->where('VRNO',$gateEntryVrno)->where('CFGATEID',$tblGateId)->where('VEHICLE_NUMBER',$vehicle_no)->update($dataVehicle);

		     /* ------- UPDATE IN CS GATE ENTRY ---------- */

		     /* ----- UPDATE OR INSERT IN MASTER VR SEQ ----- */

		      	$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('trans_code'))->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->toArray();

		      	if(empty($checkvrnoExist)){

			        $datavrnIn =array(
			          'COMP_CODE'   =>$comp_code,
			          'FY_CODE'     =>$fisYear,
			          'TRAN_CODE'   =>$request->input('trans_code'),
			          'SERIES_CODE' =>$request->input('series_code'),
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

			        DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('trans_code'))->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($datavrn);
			        
		      	}

		     /* ----- UPDATE OR INSERT IN MASTER VR SEQ ----- */

			DB::commit();
			$data['response'] = 'success';

			if($donwloadStatus == 1){

				return $this->GeneratePdfForCandF($titleName,$comp_code,$fisYear,$plantCd,$NewVrno,$userId);

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

	} /* /. MAIN FUNCTION  */

	public function loadingSlip_msg(Request $request,$saveData){

		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Loading Slip Can Not Created...!');
			return redirect('/transaction/candf/view-loading-slip');

		}else{

			$request->session()->flash('alert-success', 'Loading Slip Was Successfully Created...!');	
			return redirect('/transaction/candf/view-loading-slip');

		}
	}

	public function ViewLoadingSlip(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

			$title       = 'View Loading Slip';

			$userid      = $request->session()->get('userid');
			$userType    = $request->session()->get('usertype');
			$companyData = $request->session()->get('company_name');
			$splitData   = explode('-',$companyData);
			$comp_code   = $splitData[0];

			$fisYear     =  $request->session()->get('macc_year');

			$data = DB::table('CFOUTWARD_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('LR_STATUS','0')->orderBy('VRDATE','ASC');

	    		return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    		}

	    	if(isset($compName)){
	    		return view('admin.finance.transaction.candf.view_loading_slip');
	    	}else{
		 	return redirect('/useractivity');
	     }
     }

    public function EditLoadingSlipWithoutPlan(Request $request,$compCd,$fyCd,$tranCd,$seriesCd,$vrno,$loadingpageStatus){

		$MaccYear           = $request->session()->get('macc_year');
		$comapnyDetail      = $request->session()->get('company_name');
		$splitData          = explode('-', $comapnyDetail);
		$com_code           = $splitData[0];
		$user_type          = $request->session()->get('user_type');
		$userid             = $request->session()->get('userid');
		$title              = 'Edit Loading Slip';
		$comp_cd            = base64_decode($compCd);
		$fy_Cd              = base64_decode($fyCd);
		$tran_Cd            = base64_decode($tranCd);
		$series_Cd          = base64_decode($seriesCd);
		$vr_No              = base64_decode($vrno);
		$loadingpage_Status = base64_decode($loadingpageStatus);
		$tranCode           = $tran_Cd;
    	
    		if(($comp_cd!='') && ($fy_Cd!='') && ($tran_Cd!='') && ($series_Cd!='') && ($vr_No!='')){
    	    		$query = DB::table('CFOUTWARD_TRAN');
			$query->where('COMP_CODE', $comp_cd)->where('FY_CODE', $fy_Cd)->where('TRAN_CODE', $tran_Cd)->where('SERIES_CODE', $series_Cd)->where('VRNO', $vr_No);
			$classData= $query->get();

			$userData['orderNo_list']  = DB::select("SELECT *,(QTYRECD-QTYISSUED) AS LOADBALQTY FROM CFINWARD_TRAN WHERE LOADING_SLIP_STATUS='0'");

			$userData['umList']   = DB::table('MASTER_UM')->get();

			$allTblName    = $this->AllTableName($request,$tranCode);
			$userData['jwitem_list']   = $allTblName['jwitem_list'];
			
			if($loadingpage_Status == 0){
				return view('admin.finance.transaction.candf.edit_loading_and_plan',$userData+compact('title','classData'));
			}else if($loadingpage_Status == 1){
				return view('admin.finance.transaction.candf.edit_loading_slip',$userData+compact('title','classData'));
			}else if($loadingpage_Status ==2){
				return view('admin.finance.transaction.candf.edit_loading_slip_WP',$userData+compact('title','classData'));
			}

		}else{
			$request->session()->flash('alert-error', 'Loading Slip Not Found...!');
			return redirect('/transaction/candf/view-loading-slip');
		}

    }

    public function UpdateLoadingSlipWihoutPlan(Request $request){

		$donwloadStatus  = $request->input('pdfYesNoStatus');
		$CompanyName     = $request->session()->get('company_name');
		$splitData       = explode('-', $CompanyName);
		$comp_code       = $splitData[0];
		$fisYear         = $request->session()->get('macc_year');	
		$userId          = $request->session()->get('userid');
		$vehicle_no      = $request->input('vehicle_no');
		$tripNo          = $request->input('trip_no');
		$tripHeadId     = $request->input('tripHeadId');
		$dOrderNo        = $request->input('sOrderNo');
		$batch_No        = $request->input('batch_no');
		$itemCd          = $request->input('item_code');
		$itemNm          = $request->input('item_name');
		$rowCount        = $request->input('rowCount');
		$quantity        = $request->input('quantity');
		$addQuantity     = $request->input('addQuantity');
		$trans_type      = $request->input('seletedTransType');
		$uniqLrNo        = $request->input('uniqLrNo');
		$trpt_code       = $request->input('doTRPTCode');
		$trpt_name       = $request->input('doTRPTName');
		$transport_type  = $request->input('tranPort_Type');
		$customer_code   = $request->input('customer_code');
		$customer_name   = $request->input('customer_name');
		$trptCode        = $request->input('trpt_code');
		$trptName        = $request->input('trpt_name');
		$jobWork         = $request->input('jobWork');
		$jobwrokitemName = $request->input('jobwrokitemName');
		$inwardTBLHeadId = $request->input('tblHeadId');
		$tblGateId       = $request->input('tblGateId');
		$editInwardTblId = $request->input('editInwardTblId');
		$titleName       = 'LOADING SLIP';

		DB::beginTransaction();

		try {

			DB::table('CFOUTWARD_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$request->input('trans_code'))->where('SERIES_CODE',$request->input('series_code'))->where('VRNO',$request->input('vrseqnum'))->delete();

			/* ------ UPDATE LOAD QTY ZERO IN INWARD ------- */

			$aryInwardID = explode(',',$editInwardTblId);



			/*for ($q = 0; $q < count($aryInwardID); $q++) {
				
				$dataQty = array(
					'LOADSLIP_QTY' => '0.000'
				);

				DB::table('CFINWARD_TRAN')->where('CFINWARDID',$aryInwardID[$q])->where('LOADING_SLIP_STATUS','0')->update($dataQty);

			}*/

			for ($q = 0; $q < count($aryInwardID); $q++) {

				$splitInWardDt = explode('~', $aryInwardID[$q]);
				$inwardIdTbl = $splitInWardDt[0];
				$loadQty = $splitInWardDt[1];

				$getLoadQty = DB::table('CFINWARD_TRAN')->where('CFINWARDID',$inwardIdTbl)->get()->first();

				$revLoadQty = $getLoadQty->LOADSLIP_QTY - $loadQty;

				$qtyUp = array(
					'LOADSLIP_QTY' =>$revLoadQty,
				);

				DB::table('CFINWARD_TRAN')->where('CFINWARDID',$inwardIdTbl)->update($qtyUp);

				/*$dataQty = array(
					'LOADSLIP_QTY' => '0.000'
				);*/

				//DB::table('CFINWARD_TRAN')->where('CFINWARDID',$aryInwardID[$q])->where('LOADING_SLIP_STATUS','0')->update($dataQty);

			}

			/* ------ UPDATE LOAD QTY ZERO IN INWARD ------- */


			for($i=0;$i<count($rowCount);$i++){

				$slitBatch     = explode('~',$batch_No[$i]);
				$batchNo       = $slitBatch[0];
				$batchslnoNo   = $slitBatch[1];
				
				$getInwarddata = DB::table('CFINWARD_TRAN')->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('CFINWARDID',$inwardTBLHeadId[$i])->where('LOADING_SLIP_STATUS','0')->get();

				$inward_Details = json_decode(json_encode($getInwarddata),true);

				if($transport_type=='BY_ROAD'){
					$accCode          = $customer_code;
					$accName          = $customer_name;
					$transporter_code = $trptCode;
					$transporter_name = $trptName;
					$jobWorkItem_code = $jobWork[$i];
					$jobWorkItem_name = $jobwrokitemName[$i];
				}else{
					$accCode          = $inward_Details[0]['ACC_CODE'];
					$accName          = $inward_Details[0]['ACC_NAME'];
					$transporter_code = $trpt_code[$i];
					$transporter_name = $trpt_name[$i];
					$jobWorkItem_code = '';
					$jobWorkItem_name = '';
				}

				$data = array(
					'COMP_CODE'           =>$comp_code,
					'FY_CODE'             =>$fisYear,
					'TRAN_CODE'           =>$request->input('trans_code'),
					'SERIES_CODE'         =>$request->input('series_code'),
					'SERIES_NAME'         =>$request->input('series_name'),
					'VRNO'                =>$request->input('vrseqnum'),
					'SLNO'                =>$batchslnoNo,
					'LR_NO'               =>'',
					'LR_SLNO'             =>$uniqLrNo[$i],
					'LR_DATE'             =>'',
					'RAKE_NO'             =>$inward_Details[0]['RAKE_NO'],
					'RAKE_DATE'           =>$inward_Details[0]['RAKE_DATE'],
					'PLACE_DATE'          =>$inward_Details[0]['PLACE_DATE'],
					'PLANT_CODE'          =>$request->input('plant_code'),
					'PLANT_NAME'          =>$request->input('plant_name'),
					'PFCT_CODE'           =>$request->input('pfct_code'),
					'PFCT_NAME'           =>$request->input('pfct_name'),
					'ACC_CODE'            =>$accCode,
					'ACC_NAME'            =>$accName,
					'VRDATE'              =>date("Y-m-d", strtotime($request->input('transaction_date'))),
					'ORDER_NO'            =>$dOrderNo[$i],
					'ORDER_DATE'          =>$inward_Details[0]['ORDER_DATE'],
					'CP_CODE'             =>$inward_Details[0]['CP_CODE'],
					'CP_NAME'             =>$inward_Details[0]['CP_NAME'],
					'CP_ADD'              =>$inward_Details[0]['CP_ADD'],
					'SP_CODE'             =>$inward_Details[0]['SP_CODE'],
					'SP_NAME'             =>$inward_Details[0]['SP_NAME'],
					'SP_ADD'              =>$inward_Details[0]['SP_ADD'],
					'ROUTE_CODE'          =>$inward_Details[0]['ROUTE_CODE'],
					'ROUTE_NAME'          =>$inward_Details[0]['ROUTE_NAME'],
					'FROM_PLACE'          =>$inward_Details[0]['FROM_PLACE'],
					'TO_PLACE'            =>$inward_Details[0]['TO_PLACE'],
					'BATCH_NO'            =>$batchNo,
					'DORDER_QTY'          =>$inward_Details[0]['DORDER_QTY'],
					'LOT_NO'              =>$inward_Details[0]['LOT_NO'],
					'ALIAS_CODE'          =>$inward_Details[0]['ALIAS_CODE'],
					'ALIAS_NAME'          =>$inward_Details[0]['ALIAS_NAME'],
					'CFINWARDID'          =>$inward_Details[0]['CFINWARDID'],
					'ITEM_CODE'           =>$itemCd[$i],
					'ITEM_NAME'           =>$itemNm[$i],
					'LENGTH'              =>$inward_Details[0]['LENGTH'],
					'WIDTH'               =>$inward_Details[0]['WIDTH'],
					'HEIGHT'              =>$inward_Details[0]['HEIGHT'],
					'ODC'                 =>$inward_Details[0]['ODC'],
					'REMARK'              =>$inward_Details[0]['REMARK'],
					'QTY'                 =>$quantity[$i],
					'UM'                  =>$inward_Details[0]['UM'],
					'AQTY'                =>$addQuantity[$i],
					'AUM'                 =>$inward_Details[0]['AUM'],
					'CFACTOR'             =>$inward_Details[0]['CFACTOR'],
					'INVOICE_NO'          =>$inward_Details[0]['INVOICE_NO'],
					'INVOICE_DATE'        =>$inward_Details[0]['INVOICE_DATE'],
					'WAGON_NO'            =>$inward_Details[0]['WAGON_NO'],
					'WAGON_DATE'          =>'',
					'OBD_NO'              =>$inward_Details[0]['OBD_NO'],
					'DELIVERY_NO'         =>$inward_Details[0]['DELIVERY_NO'],
					'EWAY_BILL_NO'        =>$inward_Details[0]['EWAY_BILL_NO'],
					'EWAY_BILL_DT'        =>$inward_Details[0]['EWAY_BILL_DT'],
					'CAM_NO'              =>$inward_Details[0]['CAM_NO'],
					'GATEIN_ID'           =>'',
					'TRPT_TYPE'           =>$trans_type,
					'TRPT_CODE'           =>$transporter_code,
					'TRPT_NAME'           =>$transporter_name,
					'TRANSPORT_TYPE'      =>$transport_type,
					'JWITEM_CODE'         =>$jobWorkItem_code,
					'JWITEM_NAME'         =>$jobWorkItem_name,
					'VEHICLE_NO'          =>$vehicle_no,
					'QTYISSUED'           =>'0.000',	
					'AQTISSUED'           =>'0.000',
					'MATERIAL_VALUE'      =>'0.00',
					'LCONT_CODE'          =>$inward_Details[0]['UCONT_CODE'],
					'LCONT_NAME'          =>$inward_Details[0]['UCONT_NAME'],
					'LOCATION_CODE'       =>$inward_Details[0]['LOCATION_CODE'],
					'LOCATION_NAME'       =>$inward_Details[0]['LOCATION_NAME'],
					'DRIVER_NAME'         =>$request->input('driver_name'),
					'DRIVER_ID'           =>$request->input('driver_id'),
					'MOBILE_NUMBER'       =>$request->input('driver_mobNo'),
					'LOADING_PLAN_STATUS' =>'1',
					'LOADING_STATUS' =>'2',
					'TRIP_NO'             =>$tripNo,
					'TRIPHID'             =>$tripHeadId,
					'CFGATEID'            =>$tblGateId,
					'LR_REMARK'           =>'',
					'FLAG'                =>'',
					'LR_STATUS'           =>'',
					'CREATED_BY'          =>$userId,
				);

				DB::table('CFOUTWARD_TRAN')->insert($data);

				/*------- UPDATE IN INWARD TRANSACTION ------- */

					$getQtyRecd = DB::table('CFINWARD_TRAN')->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('CFINWARDID',$inwardTBLHeadId[$i])->where('LOADING_SLIP_STATUS','0')->get()->first();

					$qtyRecd = $getQtyRecd->LOADSLIP_QTY + $quantity[$i];

					$qtyUp = array(
						'LOADSLIP_QTY' =>$qtyRecd,
					);

					DB::table('CFINWARD_TRAN')->where('ORDER_NO',$dOrderNo[$i])->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCd[$i])->where('CFINWARDID',$inwardTBLHeadId[$i])->where('LOADING_SLIP_STATUS','0')->update($qtyUp);

				/*------- UPDATE IN INWARD TRANSACTION ------- */

			}/* /. FOR LOOP*/

			DB::commit();
			$data['response'] = 'success';
		     $getalldata = json_encode($data);  
		     print_r($getalldata);

	    	}catch (\Exception $e) {

	        	DB::rollBack();
	       	 	//throw $e;
	        	$data['response'] = 'error';
	        	$getalldata = json_encode($data);  
	        	print_r($getalldata);

	    	}

    }/* /.MAIN FUNCTION */

    public function DeleteLoadingSlipWithoutPlan(Request $request){

     	$deleteData = $request->input('deletdata');

     	$slitData = explode('~',$deleteData);

		$lsComp_code   = $slitData[0];
		$lsfy_code     = $slitData[1];
		$lstran_code   = $slitData[2];
		$lsseries_code = $slitData[3];
		$lsVrno        = $slitData[4];
		$lsgateInId    = $slitData[5];
		$lsVehicle     = $slitData[6];
		$loadingStatus = $slitData[7];

		DB::beginTransaction();

		try {

			if(($lsComp_code !='') && ($lsfy_code !='') && ($lstran_code !='') && ($lsseries_code !='') && ($lsVrno !='') && ($lsgateInId !='') && ($lsVehicle !='') && ($loadingStatus !='')){

				if($loadingStatus == 0){

				/* ------ LOADING PLAN DELETE CODE ------ */

					DB::table('CFOUTWARD_TRAN')->where('COMP_CODE', $lsComp_code)->where('FY_CODE', $lsfy_code)->where('TRAN_CODE', $lstran_code)->where('SERIES_CODE', $lsseries_code)->where('VRNO', $lsVrno)->where('CFGATEID', $lsgateInId)->where('VEHICLE_NO', $lsVehicle)->delete();

					$loadingStatus = array(
						'LOADING_SLIP_STATUS' => '0'
					);
					
					DB::table('CF_GATE_ENTRY')->where('CFGATEID',$lsgateInId)->where('VEHICLE_NUMBER',$lsVehicle)->update($loadingStatus);

				/* ------ LOADING PLAN DELETE CODE ------ */

				}else if($loadingStatus == 1){

				/* -------- LOADING PLAN AND SLIP DELETE CODE ----- */

					$cfOut_Data = DB::select("SELECT * FROM CFOUTWARD_TRAN WHERE COMP_CODE='$lsComp_code' AND FY_CODE='$lsfy_code' AND TRAN_CODE='$lstran_code' AND SERIES_CODE='$lsseries_code' AND VRNO='$lsVrno' AND CFGATEID='$lsgateInId' AND VEHICLE_NO='$lsVehicle'");

					for ($i = 0; $i <count($cfOut_Data);$i++) {

						$inwardTBLId = $cfOut_Data[$i]->CFINWARDID;

						$loadQty = array(
							'LOADSLIP_QTY' => '0.000'
						);

						DB::table('CFINWARD_TRAN')->where('CFINWARDID',$inwardTBLId)->where('LOADING_SLIP_STATUS','0')->update($loadQty);

						DB::Statement("UPDATE `CFOUTWARD_TRAN` SET CFINWARDID='0',LR_NO=NULL,SLNO=NULL,LR_DATE=NULL,RAKE_NO=NULL,RAKE_DATE=NULL,PLACE_DATE=NULL,ACC_CODE=NULL,ACC_NAME=NULL,ACC_ADD=NULL,ORDER_NO=NULL,DELORDER_NO=NULL,ORDER_DATE=NULL,CP_ADD=NULL,SP_CODE=NULL,SP_NAME=NULL,SP_ADD=NULL,ROUTE_CODE=NULL,ROUTE_NAME=NULL,FROM_PLACE=NULL,TO_PLACE=NULL,BATCH_NO=NULL,DORDER_QTY=NULL,LOT_NO=NULL,ALIAS_CODE=NULL,ALIAS_NAME=NULL,LENGTH=NULL,WIDTH=NULL,HEIGHT=NULL,ODC=NULL,REMARK=NULL,UM=NULL,AUM=NULL,AQTY=0.00,CFACTOR=0.00,INVOICE_NO=NULL,INVOICE_DATE=NULL,WAGON_NO=NULL,WAGON_DATE=NULL,OBD_NO=NULL,EWAY_BILL_NO=NULL,EWAY_BILL_DT=NULL,CAM_NO=NULL,INWARD_DATE=NULL,TRIP_DATE=NULL,LOCATION_CODE=NULL,LOCATION_NAME=NULL,LR_SLNO=NULL,DELIVERY_NO=NULL,LOADING_PLAN_STATUS='0' WHERE  COMP_CODE='$lsComp_code' AND FY_CODE='$lsfy_code' AND TRAN_CODE='$lstran_code' AND SERIES_CODE='$lsseries_code' AND VRNO='$lsVrno' AND CFGATEID='$lsgateInId' AND VEHICLE_NO='$lsVehicle'");
					}

				/* -------- LOADING PLAN AND SLIP DELETE CODE ----- */

				}else if($loadingStatus == 2){

				/* -------- LOADING SLIP WITHOUT PLAN DELETE CODE ----- */

					$cfOutData = DB::select("SELECT * FROM CFOUTWARD_TRAN WHERE COMP_CODE='$lsComp_code' AND FY_CODE='$lsfy_code' AND TRAN_CODE='$lstran_code' AND SERIES_CODE='$lsseries_code' AND VRNO='$lsVrno' AND CFGATEID='$lsgateInId' AND VEHICLE_NO='$lsVehicle'");

					for ($i = 0; $i <count($cfOutData);$i++) {

						/*$getInwardId = DB::select("SELECT * FROM CFOUTWARD_TRAN WHERE COMP_CODE='$lsComp_code' AND FY_CODE='$lsfy_code' AND TRAN_CODE='$lstran_code' AND SERIES_CODE='$lsseries_code' AND VRNO='$lsVrno' AND CFGATEID='$lsgateInId' AND VEHICLE_NO='$lsVehicle'");*/
						
						$inwardTBLId = $cfOutData[$i]->CFINWARDID;
						$loadQty    = $cfOutData[$i]->QTY;

						$prevgetLoadQty = DB::table('CFINWARD_TRAN')->where('CFINWARDID',$inwardTBLId)->get()->first();

						$revLoadQty = $prevgetLoadQty->LOADSLIP_QTY - $loadQty;

						$loadQty = array(
							'LOADSLIP_QTY' =>$revLoadQty,
						);


						DB::table('CFINWARD_TRAN')->where('CFINWARDID',$inwardTBLId)->where('LOADING_SLIP_STATUS','0')->update($loadQty);
					}

					/* ------- DELETE DATA FROM CFOUTWARD ------ */

						DB::table('CFOUTWARD_TRAN')->where('COMP_CODE', $lsComp_code)->where('FY_CODE', $lsfy_code)->where('TRAN_CODE', $lstran_code)->where('SERIES_CODE', $lsseries_code)->where('VRNO', $lsVrno)->where('CFGATEID', $lsgateInId)->where('VEHICLE_NO', $lsVehicle)->delete();

					/* ------- DELETE DATA FROM CFOUTWARD ------ */

					/* --------- REMOVE STATUS FROM GATE ENTRY TABLE ------ */

						$loadingStatus = array(
							'LOADING_SLIP_STATUS' => '0'
						);
						
						DB::table('CF_GATE_ENTRY')->where('CFGATEID',$lsgateInId)->where('VEHICLE_NUMBER',$lsVehicle)->update($loadingStatus);

					/* --------- REMOVE STATUS FROM GATE ENTRY TABLE ------ */

					/* -------- LOADING SLIP WITHOUT PLAN DELETE CODE ----- */

				}/*/.IF CODN*/

			} /* /.IF CODN*/

			DB::commit();

			$request->session()->flash('alert-success', 'Loading Slip Was Deleted Successfully...!');
			return redirect('/transaction/candf/view-loading-slip');
			
		}catch (\Exception $e) {

	        DB::rollBack();
	       // throw $e;
	        $request->session()->flash('alert-error', 'Loading Slip Not Found...!');
		   return redirect('/transaction/candf/view-loading-slip');
	    	}

    }/* /.MAIN FUNCTION */

/* ----------- END : CREATE LOADING SLIP --------------- */

/* ----------- START : C AND F BILL TRANSACTION ---------- */
	
	public function AddJSWBillTran(Request $request){

		$title = "C AND F Bill";

		$company_name = $request->session()->get('company_name');
		$getcomcode   = explode('-', $company_name);
		$comp_code    = $getcomcode[0];
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');
		$tranCode     = 'S5';

		$allTblName = $this->AllTableName($request,$tranCode);

		$userdata['accList']     = $allTblName['debitors_list'];
		$userdata['itemList']    = $allTblName['item_list'];
		$userdata['ratval_list'] = $allTblName['ratval_list'];
		$userdata['seriesList']  = $allTblName['series_list'];
		$userdata['tranlist']    = $allTblName['tran_list'];
		$userdata['taxlist']     = $allTblName['tax_list'];
		
		foreach ($allTblName['fy_list'] as $key) {	

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		if(isset($company_name)){

            	return view('admin.finance.transaction.candf.add_c_and_f_bill_tran',$userdata+compact('title'));
        	}else{

            	return redirect('/useractivity');
        	}

	}

	public function FetchDataForCandFBill(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$acc_Code     = $request->input('accCode');
			$saleorderHid = $request->input('saleorderHid');
			$company_name = $request->session()->get('company_name');
			$getcomcode   = explode('-', $company_name);
			$comp_code    = $getcomcode[0];
			$macc_year    = $request->session()->get('macc_year');

			//$glCodeList  = DB::table('MASTER_ACC')->where('ACC_CODE',$acc_Code)->get()->first();
			//DB::enableQueryLog();
			$glCodeList  = DB::select("SELECT MASTER_ACC.*,(SELECT TAX_NAME FROM MASTER_TAX WHERE TAX_CODE=MASTER_ACC.TAX_CODE) AS TAXNAME FROM MASTER_ACC WHERE ACC_CODE='$acc_Code'");
			//dd(DB::getQueryLog());
			$saleOrderNo = DB::table('SORDER_HEAD')->where('COMP_CODE',$comp_code)->where('ACC_CODE',$acc_Code)->get();
			$addressOfAcc = DB::table('MASTER_ACCADD')->where('ACC_CODE',$acc_Code)->get();

			$rakeNo_list = DB::select("SELECT * FROM CFINWARD_TRAN WHERE ACC_CODE='$acc_Code' AND CNF_BILL_STATUS='0' GROUP BY RAKE_NO HAVING SUM(QTYISSUED)>=SUM(QTYRECD)");

			$itemList = DB::select("SELECT B.ITEM_CODE,B.ITEM_NAME FROM SORDER_HEAD A,SORDER_BODY B WHERE A.SORDERHID=B.SORDERHID AND B.SORDERHID='$saleorderHid' AND A.ACC_CODE='$acc_Code'");

			if ($glCodeList || $saleOrderNo || $rakeNo_list || $addressOfAcc || $itemList) {

				$response_array['response']     = 'success';
				$response_array['gl_data']      = $glCodeList;
				$response_array['fsoNo_list']   = $saleOrderNo;
				$response_array['rakeNo_list']  = $rakeNo_list;
				$response_array['address_list'] = $addressOfAcc;
				$response_array['item_list']    = $itemList;
	           	echo $data = json_encode($response_array);

			}else{

				$response_array['response']     = 'error';
				$response_array['gl_data']      = '' ;
				$response_array['fsoNo_list']   = '' ;
				$response_array['rakeNo_list']  = '' ;
				$response_array['address_list'] = '' ;
				$response_array['item_list']    = '' ;
	            	$data = json_encode($response_array);
	            	print_r($data);
				
			}

		}else{

			$response_array['response']   = 'error';
			$response_array['gl_data']    = '' ;
			$response_array['fsoNo_list'] = '' ;
			$response_array['rakeNo_list'] = '' ;
			$response_array['address_list'] = '' ;
			$response_array['item_list'] = '' ;
	        	$data = json_encode($response_array);
	        	print_r($data);
		}

	}

	public function CandFBillsearchData(Request $request){

		if($request->ajax()) {

         	if (!empty($request->acctCd || $request->fromDate || $request->toDate || $request->rakeNo || $request->itemCd || $request->saleOrderHid)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');

				$accCode      = $request->acctCd;
				$rake_No      = $request->rakeNo;
				$item_Cd      = $request->itemCd;
				$saleOrderHid = $request->saleOrderHid;

				$from_Date = date("Y-m-d", strtotime($request->fromDate));
				$toDate   = date("Y-m-d", strtotime($request->toDate));

				//print_r($from_Date);

           		if(isset($accCode)  && trim($accCode)!="")
           		{
                	$strWhere .= "AND ACC_CODE='$accCode'";
            	}

               	if(isset($rake_No)  && trim($rake_No)!="")
               	{
                 	$strWhere .= "AND RAKE_NO='$rake_No'";
               	}

               	if(isset($rake_No)=='' && isset($from_Date)  && trim($from_Date)!="")
				{

					$strWhere .="AND (VRDATE BETWEEN '$from_Date' AND '$toDate') AND (RAKE_NO='' OR RAKE_NO IS NULL)";
				}

               	//DB::enableQueryLog();	
                $datacnf = DB::select("SELECT SUM(QTYISSUED) as NET_WEIGHT,SUM(QTY) as QTY,RAKE_NO,ITEM_NAME,REMARK,PFCT_CODE,PFCT_NAME,PLANT_CODE,PLANT_NAME,RAKE_DATE,PLACE_DATE,RAKE_NO,(SELECT RATE FROM SORDER_BODY WHERE SORDERHID='$saleOrderHid' AND ITEM_CODE='$item_Cd') AS SO_RATE FROM CFOUTWARD_TRAN WHERE 1=1 $strWhere");
                //dd(DB::getQueryLog());
                //print_r($datacnf[0]->NET_WEIGHT);exit;
                if($datacnf[0]->NET_WEIGHT == ''){
                	$data = array();
                }else{
                	$data =$datacnf;
                }
                //exit;
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

	public function simulationForCandFBill(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$createdBy     = $request->session()->get('userid');
			$tax_ind_code  = $request->taxIndCode;	
			$rate_ind      = $request->rate_indName;	
			$af_rate       = $request->af_rate;	
			$amount        = $request->amount;	
			$taxGlCode     = $request->taxGlCode;	
			$seriesGl_code = $request->seriesGl_code;	
			$grandAmt      = $request->grandAmount;	
			$accGlcode     = $request->accGl_code;	

			DB::table('SIMULATION_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','SCNF')->delete();
		
			for($i=0;$i<count($tax_ind_code);$i++){

				$indData = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$i])->where('CREATED_BY',$createdBy)->where('TCFLAG','SCNF')->get()->toArray();

	   			$checkExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','SCNF')->get()->toArray();

	   			if($amount[$i] != 0.00){

	   				if($rate_ind[$i] == 'Z'){}else{

	   					if(empty($checkExist)){

							$idary = array(
								'IND_CODE'    => $tax_ind_code[$i],
								'CR_AMT'      => $amount[$i],
								'DR_AMT'      => 0.00,
								'IND_GL_CODE' => $seriesGl_code,
								'CREATED_BY'  => $createdBy,
								'TCFLAG'      => 'SCNF',
							);
							DB::table('SIMULATION_TEMP')->insert($idary);

						}else  if($taxGlCode[$i] == ''){

							$bscVal = DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$createdBy)->where('TCFLAG','SCNF')->get()->toArray();
							$updateId = $bscVal[0]->CREATED_BY;
							$basicAmt = $bscVal[0]->CR_AMT + $amount[$i];
						
							$idary_bsic = array(
								'CR_AMT' 	  => $basicAmt,
								'DR_AMT'      => 0.00,
							);

							DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$updateId)->where('TCFLAG','SCNF')->update($idary_bsic);

						}else if(empty($indData)){

							$idary   = array(
								'IND_CODE'    => $tax_ind_code[$i],
								'CR_AMT'      => $amount[$i],
								'DR_AMT'      => 0.00,
								'IND_GL_CODE' => $taxGlCode[$i],
								//'IND_GL_NAME' => $gl_name,
								'CREATED_BY'  => $createdBy,
								'TCFLAG'      => 'SCNF',
							);
							DB::table('SIMULATION_TEMP')->insert($idary);
						}else{

							$indData1 = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$i])->where('CREATED_BY',$createdBy)->where('TCFLAG','SCNF')->get()->first();

							$newTaxAmt = $indData1->CR_AMT + $amount[$i];

							$idary1 = array(
								'CR_AMT' 	  => $newTaxAmt,
								'DR_AMT'      => 0.00,
							);

							$updatevr = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$i])->where('CREATED_BY',$createdBy)->where('TCFLAG','SCNF')->update($idary1);
						}

	   				}
	   			} /* /.AMOUNT*/

			} /* FOR LOOP*/	

			$accData =  array(
						'IND_CODE'     => '',
						'DR_AMT'       => $grandAmt,
						'CR_AMT'       => 0.00,
						'IND_ACC_CODE'  => $accGlcode,
						//'GLACC_Chk'  => 'ACC',
						'TCFLAG'       => 'SCNF',
						'CREATED_BY'   => $createdBy,
			);
			DB::table('SIMULATION_TEMP')->insert($accData);
			//DB::enableQueryLog();
			$taxData = DB::table('SIMULATION_TEMP')
					->select('SIMULATION_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME','MASTER_ACC.ACC_NAME')
	           		->leftjoin('MASTER_GL', 'SIMULATION_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
	           		->leftjoin('MASTER_ACC', 'SIMULATION_TEMP.IND_ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
		            	->where('SIMULATION_TEMP.TCFLAG','SCNF')
		            	->where('SIMULATION_TEMP.CREATED_BY',$createdBy)
		            	->get()->toArray();
	        //dd(DB::getQueryLog());    	
			if ($taxData) {

				$response_array['response']   = 'success';
				$response_array['data_tax']   = $taxData;
	           	echo $data = json_encode($response_array);

			}else{

				$response_array['response']   = 'error';
				$response_array['data_tax']   = '';
            	$data = json_encode($response_array);
            	print_r($data);
				
			}

		}else{
			$response_array['response']   = 'error';
			$response_array['data_tax']   = '';
        	$data = json_encode($response_array);
        	print_r($data);
		}

	} /* /.SIMULATION FUNCTION*/

	public function SaveCandFBillTran(Request $request){

		$CompanyName  = $request->session()->get('company_name');
		$fisYear      = $request->session()->get('macc_year');
		$getcompcode  = explode('-', $CompanyName);
		$comp_code    = $getcompcode[0];
		$createdBy    = $request->session()->get('userid');
		$vrno         = $request->input('vrseqnum');
		$taxRowCount  = $request->input('taxDataCount');
		$tax_ind_code = $request->input('taxIndCode');
		$head_tax_ind = $request->input('head_tax_ind');
		$rate_ind     = $request->input('rate_ind');
		$af_rate      = $request->input('af_rate');
		$amount       = $request->input('amountTax');
		$logicget     = $request->input('logicget');
		$tax_gl_code  = $request->input('taxGlCode');
		$staticget    = $request->input('staticget');
		$seriesGlCd   = $request->input('seriesgl_code');
		$accCode      = $request->input('acct_code');
		$accName      = $request->input('acct_name');
		$post_Code    = $request->input('post_code');
		$exlodePostCd = explode('[',$post_Code);
		$acc_glCode   = $exlodePostCd[0];
		$acc_glName   = $exlodePostCd[1];
		$grandAmt     = $request->input('getNetAmnt');
		$netWeightrake= $request->input('netWeight');
		$soRate       = $request->input('soRate');
		$totAmount    = $request->input('amountBasic');
		$addrcpCode   = $request->input('addrcpCode');
		$seriesCode   = $request->input('series_code');
		$plantName    = $request->input('plantName');
		$rakeDate     = $request->input('rakeDate');
		$placeDate    = $request->input('placeDate');
		$rakeNo       = $request->input('rakeNo');
		$itemHSNCd    = $request->input('itemHSNCd');
		$item_Name    = $request->input('item_Name');
		$itemHSNNm    = $request->input('itemHSNNm');
		$rake_No      = $request->input('rake_No');
		$tranDate     = date('Y-m-d',strtotime($request->input('vr_date')));
		$pdfYesNoStatus= $request->input('pdfYesNoStatus');

		//print_r($seriesGlCd);exit;

		$splitFy = explode('-',$fisYear);
		$startyear = $splitFy[0];
		if($vrno == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrno;
		}

		$vrno_Exist = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$request->input('trans_code'))->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrNum +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {

			$billNo = $startyear.'/'.$seriesCode.'/'.$NewVrno;

			DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','CNFB')->delete();

			$sorderH = DB::select("SELECT MAX(SBILLHID) as SBILLHID FROM SBILL_HEAD");
			$headID = json_decode(json_encode($sorderH), true); 
		
			if(empty($headID[0]['SBILLHID'])){
				$head_Id = 1;
			}else{
				$head_Id = $headID[0]['SBILLHID']+1;
			}
		

			$headData = array(
				'SBILLHID'    => $head_Id,
				'COMP_CODE'   => $comp_code,
				'FY_CODE'     => $fisYear,
				'PFCT_CODE'   => $request->input('pfctCode'),
				'PFCT_NAME'   => $request->input('pfctName'),
				'TRAN_CODE'   => $request->input('trans_code'),
				'SERIES_CODE' => $request->input('series_code'),
				'SERIES_NAME' => $request->input('series_name'),
				'VRNO'        => $NewVrno,
				'SLNO'        => 1,
				'VRDATE'      => $tranDate,
				'PLANT_CODE'  => $request->input('plantCode'),
				'PLANT_NAME'  => $request->input('plantName'),
				'ACC_CODE'    => $request->input('acct_code'),
				'ACC_NAME'    => $request->input('acct_name'),
				'DRAMT'       => $request->input('acct_name'),
				'CPCODE_ADDR' => $request->input('addrcpCode'),
				'TRAN_TYPE'   => 'CNFB',
				'TAX_CODE'    => $request->input('taxCode'),
				'CREATED_BY'  => $createdBy,
			);

			DB::table('SBILL_HEAD')->insert($headData);

			$sorderB = DB::select("SELECT MAX(SBILLBID) as SBILLBID FROM SBILL_BODY");
			$bodyID = json_decode(json_encode($sorderB), true); 
		
			if(empty($bodyID[0]['SBILLBID'])){
				$body_Id = 1;
			}else{
				$body_Id = $bodyID[0]['SBILLBID']+1;
			}

			$bodyData = array(
		        'SBILLHID'   => $head_Id,
		        'SBILLBID'   => $body_Id,
		        'COMP_CODE'   => $comp_code,
		        'FY_CODE'     => $fisYear,
		        'PFCT_CODE'   => $request->input('pfctCode'),
		        'TRAN_CODE'   => $request->input('trans_code'),
		        'SERIES_CODE' => $request->input('series_code'),
		        'VRNO'        => $NewVrno,
		        'SLNO'        => 1,
		        'VRDATE'      => date('Y-m-d',strtotime($request->input('vr_date'))),
		        'PLANT_CODE'  => $request->input('plantCode'),
		        'ITEM_CODE'   => $request->input('itemCode'),
		        'ITEM_NAME'   => $request->input('itemName'),
		        'PARTICULAR'  => $request->input('remarkName'),
		        'QTYISSUED'   => $request->input('netWeight'),
		        'RATE'        => $request->input('soRate'),
		        'BASICAMT'    => $request->input('amountBasic'),
		        'TAX_CODE'    => $request->input('taxCode'),
		        'BILL_TYPE'   => 'CNFB',
		        'DRAMT'       => $request->input('dr_amt'),
		        'CREATED_BY'  => $createdBy,

	      	);

	      	DB::table('SBILL_BODY')->insert($bodyData);

	      	$sgst=array(); $cgst =array();$igst =array();
			$sgstrate=array(); $cgstrate =array();$igstrate =array();

	      	for ($j=0; $j < $taxRowCount; $j++) {

	      		$sorderT = DB::select("SELECT MAX(SBILLTID) as SBILLTID FROM SBILL_TAX");
				$taxID = json_decode(json_encode($sorderT), true); 
			
				if(empty($taxID[0]['SBILLTID'])){
					$tax_Id = 1;
				}else{
					$tax_Id = $taxID[0]['SBILLTID']+1;
				}

				if(($amount[$j] == '') || ($amount[$j] == null)){
					$taxAmount = 0.00;
				}else{
					$taxAmount = $amount[$j];
				}

				if(($taxAmount != '') || ($taxAmount!= null) || ($taxAmount!= '0.00')){

					if($tax_ind_code[$j]=='SG1'){

			              $sgst[] = $taxAmount;
			              $sgstrate[]= $af_rate[$j];
		            	}else{
			              $sgst[] =0.00;
			              $sgstrate[] =0.00;
		            	}

		            	if($tax_ind_code[$j]=='CG1'){
						$cgst[]  = $taxAmount;
						$cgstrate[] = $af_rate[$j];
		            	}else{
						$cgst[] =0.00;
						$cgstrate[] =0.00;
		            	}

		            	if($tax_ind_code[$j]=='IGST'){
	              			$igst[] = $taxAmount;
	              			$igstrate[] = $af_rate[$j];
	            		}else{
	              			$igst[] =0.00;
	              			$igstrate[] =0.00;
	            		}
	            	}

		      	$data_tax = array(
					'SBILLHID'    => $head_Id,
					'SBILLBID'    => $body_Id,
					'SBILLTID'    => $tax_Id,
					'TAXIND_CODE' => $tax_ind_code[$j],
					'TAXIND_NAME' => $head_tax_ind[$j],
					'RATE_INDEX'  => $rate_ind[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $taxAmount,
					'TAX_LOGIC'   => $logicget[$j],
					'TAXGL_CODE'  => $tax_gl_code[$j],
					'STATIC_IND'  => $staticget[$j],
					'CREATED_BY'  => $createdBy,
				);
				
				DB::table('SBILL_TAX')->insert($data_tax);

				/* ------- POSTING INFORMATION ------- */

				$indData = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','CNFB')->get()->toArray();

				$checkExist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','CNFB')->get()->toArray();

				if($amount[$j] != 0.00){

					if($rate_ind[$j] == 'Z'){}else{


						if(empty($checkExist)){

							$idary = array(
								'IND_CODE'    => $tax_ind_code[$j],
								'CR_AMT'      => $amount[$j],
								'IND_GL_CODE' => $seriesGlCd,
								'REF_ACCCODE' => $accCode,
								'REF_ACCNAME' => $accName,
								'CREATED_BY'  => $createdBy,
								'TCFLAG'      => 'CNFB',
							);
							DB::table('INDICATOR_TEMP')->insert($idary);
						}else  if($tax_gl_code[$j] == ''){

							$bscVal = DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$createdBy)->where('TCFLAG','CNFB')->get()->toArray();
							$updateId = $bscVal[0]->CREATED_BY;
							$basicAmt = $bscVal[0]->CR_AMT + $amount[$j];
						
							$idary_bsic = array(
								'CR_AMT' 	  => $basicAmt,
							);

							DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$updateId)->where('TCFLAG','CNFB')->update($idary_bsic);

						}else if(empty($indData)){

							$idary   = array(
								'IND_CODE'    => $tax_ind_code[$j],
								'CR_AMT'      => $amount[$j],
								'IND_GL_CODE' => $tax_gl_code[$j],
								//'IND_GL_NAME' => $gl_name,
								'REF_ACCCODE' => $accCode,
								'REF_ACCNAME' => $accName,
								'CREATED_BY'  => $createdBy,
								'TCFLAG'      => 'CNFB',
								
							);
							DB::table('INDICATOR_TEMP')->insert($idary);
						}else{

							$indData1 = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','CNFB')->get()->first();

							$newTaxAmt = $indData1->CR_AMT + $amount[$j];

							$idary1 = array(
								'CR_AMT' 	  => $newTaxAmt,
							);

							$updatevr = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','CNFB')->update($idary1);

						}

					}/*/ /. rate index*/

				}/* /. amount chk*/

				/* ------- POSTING INFORMATION ------- */
			}/* /. for loop*/

			$accData =  array(
				'IND_CODE'     => '',
				'DR_AMT'       => $grandAmt,
				'IND_GL_CODE'  => $acc_glCode,
				'IND_GL_NAME'  => $acc_glName,
				'IND_ACC_CODE' => $accCode,
				'IND_ACC_NAME' => $accName,
				'REF_ACCCODE'  => $accCode,
				'REF_ACCNAME'  => $accName,
				'GLACC_Chk'    => 'ACC',
				'TCFLAG'       => 'CNFB',
				'CREATED_BY'   => $createdBy,
			);
			DB::table('INDICATOR_TEMP')->insert($accData);

			/* ----- INSERT POSTING DATA ------ */

			$ledgCount = DB::table('INDICATOR_TEMP')
					->select('INDICATOR_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')
	           		->leftjoin('MASTER_GL', 'INDICATOR_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
	            	->where('INDICATOR_TEMP.TCFLAG','CNFB')
	            	->where('INDICATOR_TEMP.CREATED_BY',$createdBy)
	            	->get()->toArray();
					//sale bill head
	            $slno=1;

			foreach ($ledgCount as $rows) {

				$perticulerText='';
				$blankVal='';

				$resultgl = (new AccountingController)->GlTEntry($comp_code,$fisYear,$request->input('trans_code'),$request->input('series_code'),$NewVrno,$slno,$tranDate,$blankVal,$rows->IND_GL_CODE,$rows->GL_NAME,$rows->REF_ACCCODE,$rows->REF_ACCNAME,$blankVal,$blankVal,$blankVal,$blankVal,$rows->DR_AMT,$rows->CR_AMT,$perticulerText,$createdBy);

           	    if($rows->GLACC_Chk == 'ACC'){

           	 	   $result = (new AccountingController)->AccountTEntry($comp_code,$fisYear,$request->input('trans_code'),$request->input('series_code'),$NewVrno,$slno,$tranDate,$blankVal,$rows->IND_ACC_CODE,$rows->IND_ACC_NAME,$acc_glCode,$acc_glName,$blankVal,$blankVal,$blankVal,$blankVal,$rows->DR_AMT,$rows->CR_AMT,$perticulerText,$createdBy);
           	 	}

           	 $slno++;
			}

			/* ----- INSERT POSTING DATA ------ */

			$igst_Amt  = explode('][', trim(str_replace('[0]', '', '['.implode('][', $igst).']'), '[]'));  
			$cgst_Amt  = explode('][', trim(str_replace('[0]', '', '['.implode('][', $cgst).']'), '[]'));
			$sgst_Amt  = explode('][', trim(str_replace('[0]', '', '['.implode('][', $sgst).']'), '[]'));
			$sgst_rate = explode('][', trim(str_replace('[0]', '', '['.implode('][', $sgstrate).']'), '[]'));  
			$cgst_rate = explode('][', trim(str_replace('[0]', '', '['.implode('][', $cgstrate).']'), '[]'));  
			$igst_rate = explode('][', trim(str_replace('[0]', '', '['.implode('][', $igstrate).']'), '[]'));

			if($rake_No !=''){
				$billStstus = array(
				 	'CNF_BILL_STATUS' =>'1',
				 	'SBILLHID' =>$head_Id,
				
				);

				DB::table('CFOUTWARD_TRAN')->where('RAKE_NO',$rake_No)->where('ACC_CODE',$accCode)->update($billStstus);

				$billStatusInward = array(
				 	'CNF_BILL_STATUS' =>'1'
				);

				DB::table('CFINWARD_TRAN')->where('RAKE_NO',$rake_No)->where('ACC_CODE',$accCode)->update($billStatusInward);
			}

			/* ------ UPDATE IN MASTER VRSEQ -------- */

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('trans_code'))->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_code)->get()->toArray();

		    if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$comp_code,
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('trans_code'))->where('SERIES_CODE',$request->input('series_code'))->where('COMP_CODE',$comp_code)->update($datavrn);
			}

			/* ------ UPDATE IN MASTER VRSEQ -------- */

			DB::commit();

			if($pdfYesNoStatus == 1){

				$pdfPageName='C AND F BILL';
				return $this->GeneratePdfForCandFSaleBill($createdBy,$comp_code,$accCode,$sgst_Amt,$cgst_Amt,$igst_Amt,$sgst_rate,$cgst_rate,$igst_rate,$head_Id,$body_Id,$netWeightrake,$soRate,$totAmount,$addrcpCode,$tranDate,$billNo,$plantName,$rakeDate,$placeDate,$rakeNo,$itemHSNCd,$item_Name,$itemHSNNm);

			}else{}

			$response_array['response'] = 'success';

		    $data = json_encode($response_array);
		    print_r($data);

	    }catch(\Exception $e) {
		    DB::rollBack();
		    //throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}

	}


	public function ViewCandFBill(Request $request){

		$compName = $request->session()->get('company_name');
    
        if($request->ajax()) {
    
            $title ='View C AND F Bill';
    
            $userid    = $request->session()->get('userid');
    
            $userType = $request->session()->get('usertype');
    
            $compName = $request->session()->get('company_name');

            $compcode    = explode('-', $compName);

			$getcompcode =	$compcode[0];

    
            $fisYear =  $request->session()->get('macc_year');
    
            
            $data = DB::table('CFOUTWARD_TRAN')->where('COMP_CODE',$getcompcode)->where('CNF_BILL_STATUS','1')->groupBy('RAKE_NO');

     
        	return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();
    
    
        }

        if(isset($compName)){
       		return view('admin.finance.transaction.candf.view_c_and_f_bill');
        }else{
			return redirect('/useractivity');
		}
        
    }


    public function offlineCandFbillPDF(Request $request){

    	//print_r($request->post());exit;


	
		$createdBy      = $request->session()->get('userid');
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$comp_code = $compcode[0];
		$rakeNo      = $request->input('rakeNo');
		$plantCode   = $request->input('plantCode');
		$plantName   = $request->input('plantName');
		$pfctCode    = $request->input('pfctCode');
		$accCode     = $request->input('accCode');
		$tranCode    = $request->input('tranCode');
		$cpCode      = $request->input('cpCode');
		//$addrcpCode  = $request->input('cpAdd');
		$item_Name   = $request->input('itemName');
		$rakeDate    = $request->input('rakeDate');
		$placeDate   = $request->input('placeDate');
		//$tranDate    = $request->input('vrDate');
		$head_Id     = $request->input('sbillHId');
		$body_Id     = '';
		
		$pdfName='LORRY RECEIPT';
		$tCode = 'DISPATCH_RECEIPT';

		/* $datacnf = DB::select("SELECT SUM(QTYISSUED) as NET_WEIGHT,SUM(QTY) as QTY,RAKE_NO,ITEM_NAME,REMARK,PFCT_CODE,PFCT_NAME,PLANT_CODE,PLANT_NAME,RAKE_DATE,PLACE_DATE,RAKE_NO,(SELECT RATE FROM SBILL_BODY WHERE SBILLHID='$saleOrderHid' AND ITEM_CODE='$item_Cd') AS SO_RATE FROM CFOUTWARD_TRAN WHERE 1=1 $strWhere");

*/
		/*$data = DB::table('CFOUTWARD_TRAN')->where('COMP_CODE',$comp_code)->where('RAKE_NO',$rakeNo)->where('CNF_BILL_STATUS','1')->groupBy('RAKE_NO');*/

		$data = DB::select("SELECT C.*,SUM(C.NET_WEIGHT) AS NETWEIGHT,B.BASICAMT,B.RATE AS SORATE,H.CPCODE_ADDR,H.VRDATE,H.FY_CODE AS FYCODE,H.SERIES_CODE AS SERIESCODE,H.VRNO AS VR_NO,B.ITEM_CODE AS ITEMCODE FROM CFOUTWARD_TRAN C,SBILL_HEAD H,SBILL_BODY B WHERE C.SBILLHID=H.SBILLHID AND H.SBILLHID =B.SBILLHID AND C.COMP_CODE='$comp_code' AND C.RAKE_NO='$rakeNo' AND C.CNF_BILL_STATUS='1' GROUP BY C.RAKE_NO");

		$netWeightrake = $data[0]->NETWEIGHT;
		$soRate        = $data[0]->SORATE;
		$totAmount     = $data[0]->BASICAMT;
		$addrcpCode    = $data[0]->CPCODE_ADDR;
		$tranDate      = $data[0]->VRDATE;
		$fy_code       = $data[0]->FYCODE;
		$series_code   = $data[0]->SERIESCODE;
		$vr_no         = $data[0]->VR_NO;
		$ItemCode         = $data[0]->ITEMCODE;

		$explodeFy = explode('-',$fy_code);


		$billNo =$explodeFy[0].'/'.$series_code.'/'.$vr_no;


		$taxCode = DB::select("SELECT A.TAX_CODE,B.TAX_NAME,A.HSN_CODE,C.HSN_NAME FROM SBILL_BODY A,MASTER_TAX B,MASTER_HSN C WHERE A.TAX_CODE=B.TAX_CODE AND C.HSN_CODE=A.HSN_CODE AND A.ITEM_CODE='$ItemCode' AND A.SBILLHID='$head_Id'");

		if($taxCode){

		$itemHSNCd= $taxCode[0]->HSN_CODE;
		$itemHSNCd= $taxCode[0]->HSN_NAME;

		}else{

		 $itemHSNCd='';
         $itemHSNNm='';

		}


		$dataTax = DB::SELECT("SELECT t1.*,t2.SBILLHID FROM SBILL_TAX t1 LEFT JOIN SBILL_HEAD t2 ON t2.SBILLHID = t1.SBILLHID WHERE t2.SBILLHID='$head_Id' AND t1.TAX_AMT<>'0.00'");

		  $taxRowCount = count($dataTax);

		// print_r($dataTax);exit;

		   $sgst=array(); $cgst =array();$igst =array();
			$sgstrate=array(); $cgstrate =array();$igstrate =array();

	      	for ($j=0; $j < $taxRowCount; $j++) {


	      		$taxAmount = $dataTax[$j]->TAX_AMT;
	      		$tax_ind_code = $dataTax[$j]->TAXIND_CODE;
	      		$tax_rate = $dataTax[$j]->TAX_RATE;
	      	

				if(($taxAmount != '') || ($taxAmount!= null) || ($taxAmount!= '0.00')){

					if($tax_ind_code=='SG1'){

			              $sgst[] = $taxAmount;
			              $sgstrate[]= $tax_rate;
		            	}else{
			              $sgst[] =0.00;
			              $sgstrate[] =0.00;
		            	}

		            	if($tax_ind_code=='CG1'){
						$cgst[]  = $taxAmount;
						$cgstrate[] = $tax_rate;
		            	}else{
						$cgst[] =0.00;
						$cgstrate[] =0.00;
		            	}

		            	if($tax_ind_code=='IGST'){
	              			$igst[] = $taxAmount;
	              			$igstrate[] = $tax_rate;
	            		}else{
	              			$igst[] =0.00;
	              			$igstrate[] =0.00;
	            		}
	            	}

		    
			}/* /. for loop*/


			$igst_Amt  = explode('][', trim(str_replace('[0]', '', '['.implode('][', $igst).']'), '[]'));  
			$cgst_Amt  = explode('][', trim(str_replace('[0]', '', '['.implode('][', $cgst).']'), '[]'));
			$sgst_Amt  = explode('][', trim(str_replace('[0]', '', '['.implode('][', $sgst).']'), '[]'));
			$sgst_rate = explode('][', trim(str_replace('[0]', '', '['.implode('][', $sgstrate).']'), '[]'));  
			$cgst_rate = explode('][', trim(str_replace('[0]', '', '['.implode('][', $cgstrate).']'), '[]'));  
			$igst_rate = explode('][', trim(str_replace('[0]', '', '['.implode('][', $igstrate).']'), '[]'));


		//print_r($dataTax);exit;

		//print_r($data);exit;
		
         

		return $this->GeneratePdfForCandFSaleBill($createdBy,$comp_code,$accCode,$sgst_Amt,$cgst_Amt,$igst_Amt,$sgst_rate,$cgst_rate,$igst_rate,$head_Id,$body_Id,$netWeightrake,$soRate,$totAmount,$addrcpCode,$tranDate,$billNo,$plantName,$rakeDate,$placeDate,$rakeNo,$itemHSNCd,$item_Name,$itemHSNNm);

	}

	public function GeneratePdfForCandFSaleBill($createdBy,$comp_code,$accCode,$sgst_Amt,$cgst_Amt,$igst_Amt,$sgst_rate,$cgst_rate,$igst_rate,$head_Id,$body_Id,$netWeightrake,$soRate,$totAmount,$addrcpCode,$tranDate,$billNo,$plantName,$rakeDate,$placeDate,$rakeNo,$itemHSNCd,$item_Name,$itemHSNNm){

		DB::table('SIMULATION_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','CNBT')->delete();

		/* ------ START : FOR TAX CALCULATION ---- */

		$dataTax = DB::SELECT("SELECT t1.*,t2.SBILLHID FROM SBILL_TAX t1 LEFT JOIN SBILL_HEAD t2 ON t2.SBILLHID = t1.SBILLHID WHERE t2.SBILLHID='$head_Id' AND t1.TAX_AMT<>'0.00'");

		$taxCount = count($dataTax);

		for($r=0;$r<$taxCount;$r++){

			$taxIndCd   = $dataTax[$r]->TAXIND_CODE;
			$taxRate    = $dataTax[$r]->TAX_RATE;
			$taxIndName = $dataTax[$r]->TAXIND_NAME;
			$taxAmount  = $dataTax[$r]->TAX_AMT;
			$rateInde   = $dataTax[$r]->RATE_INDEX;

			$checkExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','CNBT')->get()->toArray();

			$indData = DB::table('SIMULATION_TEMP')->where('IND_CODE',$taxIndCd)->where('CREATED_BY',$createdBy)->where('TCFLAG','CNBT')->get()->toArray();

			if(($rateInde != 'Z' && $rateInde!='-') || ($rateInde == 'Z' && $taxIndCd=='GT01')) {

				if(empty($checkExist)){
					$firstAM = array(
							'IND_CODE'    => $taxIndCd,
							'IND_NAME'    => $taxIndName,
							'TAX_RATE'    => $taxRate,
							'CR_AMT'      => $taxAmount,
							'TCFLAG'      => 'CNBT',
							'CREATED_BY'  => $createdBy,
						
						);
					DB::table('SIMULATION_TEMP')->insert($firstAM);
				}else if(empty($indData)){

					$existAmt = array(
							'IND_CODE'    => $taxIndCd,
							'IND_NAME'    => $taxIndName,
							'TAX_RATE'    => $taxRate,
							'CR_AMT'      => $taxAmount,
							'TCFLAG'      => 'CNBT',
							'CREATED_BY'  => $createdBy,
						
						);
					DB::table('SIMULATION_TEMP')->insert($existAmt);

				}else{

					$indData1 = DB::table('SIMULATION_TEMP')->where('IND_CODE',$taxIndCd)->where('TCFLAG','CNBT')->where('CREATED_BY',$createdBy)->get()->first();

					$newTaxAmt = $indData1->CR_AMT + $taxAmount;

					$newAMt = array(
						'CR_AMT'      => $newTaxAmt,
					);

					$updatevr = DB::table('SIMULATION_TEMP')->where('IND_CODE',$taxIndCd)->where('TCFLAG','CNBT')->where('CREATED_BY',$createdBy)->update($newAMt);
				}

			}
		}/* /.for loop*/	

		/* ------ END : FOR TAX CALCULATION ---- */

		/* --------- GET ALL INFO FROM TABLE FOR PDF ------- */

		
		$taxDetail = DB::SELECT("SELECT * FROM SIMULATION_TEMP WHERE CREATED_BY='$createdBy' AND TCFLAG='CNBT'");
	
		$compDetail = DB::SELECT("SELECT * FROM MASTER_COMP WHERE COMP_CODE='$comp_code'");

		$consignorDetails = DB::select("SELECT B.*,A.PAN_NO FROM MASTER_ACC A,MASTER_ACCADD B WHERE A.ACC_CODE=B.ACC_CODE AND B.ACC_CODE='$accCode' AND B.CPCODE='$addrcpCode'");

		/* --------- GET ALL INFO FROM TABLE FOR PDF ------- */



		$pdf = PDF::loadView('admin.finance.transaction.candf.c_and_f_bill_pdf',compact('compDetail','sgst_Amt','cgst_Amt','igst_Amt','sgst_rate','cgst_rate','igst_rate','taxDetail','netWeightrake','soRate','totAmount','consignorDetails','tranDate','billNo','plantName','rakeDate','placeDate','rakeNo','itemHSNCd','item_Name','itemHSNNm'),[],['format' => 'A4-L','orientation' => 'L']);

		header('Content-Type: application/pdf');
		$path        = public_path('dist/coldStoragePDF'); 
		$fileName    =  time().'.'. 'pdf' ;
		$pdf->save($path . '/' . $fileName);
		$PublicPath  = url('public/dist/coldStoragePDF/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url']      = $downloadPdf;
		echo $data = json_encode($response_array);

	}

	public function CandFSaveMsg(Request $request,$saveData){

		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'C and F Bill Can Not Created...!');
			return redirect('/transaction/CandF/c-and-f-bill-tran');

		}else{

			$request->session()->flash('alert-success', 'C and F Bill Was Successfully Created...!');	
			return redirect('/transaction/CandF/c-and-f-bill-tran');

		}
	}

/* ----------- END : JSW BILL TRANSACTION ---------- */
    
/*---------- START : OUTWARD TRAN ---------- */
	
	
    public function SaveOutwardTrans_OLD(Request $request){

    	    	$trDate = $request->input('transaction_date');

    	        $Transaction_date = date("Y-m-d", strtotime($trDate));

    	        //print_r($Transaction_date);exit;

    	    	$despatch_type =  $request->input('despatch_type');

    	    	if($despatch_type == 'ST'){

    	    		$validate = $this->validate($request, [

						'depot_code'       => 'required',
						'account_code'     => 'required',
						'transaction_date' => 'required',
						'transaction_no'   => 'required',
						'despatch_type'    => 'required',
						'chalan_no'        => 'required',
						'area_code'        => 'required',
						'driver_name'      => 'required',
						'driver_number'    => 'required',
						'invoice_no'       => 'required',
					]);

    	    	}else{

    	    		$validate = $this->validate($request, [

						'depot_code'       => 'required',
						'account_code'     => 'required',
						'transaction_date' => 'required',
						'transaction_no'   => 'required',
						'despatch_type'    => 'required',
						'chalan_no'        => 'required',
						'area_code'        => 'required',
						'driver_name'      => 'required',
						'driver_number'    => 'required',
					]);

    	    	}

    	    	$developmentMode = true;
        		$mailer = new PHPMailer($developmentMode);

    	    	$AccCode =  $request->input('account_code');

				$getemail = DB::table('MASTER_ACC')->where(['ACC_CODE'=>$AccCode,'ATYPE_CODE'=>'T'])->get();
				//print_r($getemail);exit;

    	    	foreach ($getemail as $row) {
    	    		/*$accEmailId = $row->email_id;*/
    	    		$transName = $row->ACC_NAME;
    	    	}

    	    	$allaccount = DB::select("SELECT * FROM `MASTER_ACC` WHERE ACC_CODE='$AccCode' AND ATYPE_CODE!='T' ");

    	    	if(!empty($allaccount)){
    	    		foreach ($allaccount as $rowacc) {
	    	    		$accNAme = $rowacc->ACC_NAME;
	    	    	}
    	    	}else{
    	    		$accNAme = '-';
    	    	}
    	    	

        		$areaCode = $request->input('area_code');

        		$getareaname = DB::select("SELECT * FROM `MASTER_AREA` WHERE AREA_CODE='$areaCode'");
        		if(!empty($getareaname)){

	        		foreach ($getareaname as $rowar) {
	        			$areaName = $rowar->AREA_NAME;
        			}
        		}else{
        			$areaName = '';
        		}

        		$itemname = $request->input('item');
        		$itmname = DB::select("SELECT * FROM `MASTER_ITEMUM` WHERE ITEM_CODE='$itemname'");

        		if(!empty($itmname)){
        			foreach ($itmname as $itmrow) {
	        			$umcode = $itmrow->um_code;
	        			$aumcode = $itmrow->aum;
        			}
    	    		
    	    	}else{
	    	    	$umcode = '-';
    	    		$aumcode = '-';
    	   		}
        		
                
				$vehicle_num   = $request->input('vehicle_no');
				$despatch_qty  = $request->input('despatch_qty');
				$invoic_num    = $request->input('invoice_no');
				$trip_trans_no = $request->input('transaction_no');
				$driver_Name   = $request->input('driver_name');
				$driver_number = $request->input('driver_number');
				$despatchAqty = $request->input('despatch_aqty');

                $mailer->SMTPDebug = 0;
                $mailer->isSMTP();

                if ($developmentMode) {
                    $mailer->SMTPOptions = [
                        'ssl'=> [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        ]
                    ];
                }


                $mailer->Host = 'localhost';
                $mailer->SMTPAuth = false;
                $mailer->Username = 'kamini.khapre@aceworth.in';
                $mailer->Password = 'Kaminikhapre';
                $mailer->CharSet = 'iso-8859-1'; 
                $mailer->Port = 25;
                $mailer->WordWrap = TRUE;

                $mailer->setFrom('kamini.khapre@aceworth.in', 'Aceworth Private Limitate');
                $mailer->addAddress($accEmailId, 'Aceworth Private Limitate');
                $mailer->addReplyTo('kamini.khapre@aceworth.in', 'Aceworth Private Limitate');

                $mailer->isHTML(true);
                $mailer->Subject = 'Outward Transaction';

                $message = '<div style="padding-left: 14%;font-size: 16px;font-weight: 600;color: gray;">Outward Transaction</div><table id="OutwardTrans" style="border: 1px solid #a99999;border-radius: 5px;padding: 11px;border-top: 3px solid #3c8dbc;"><tbody><tr><td><b>Invoice Number</b></td><td><b>'.$invoic_num.'</b></td></tr><tr><td><b>Invoice Date</b></td><td><b>2020-12-05 06:11:08</b></td></tr><tr><td><b>Route</b></td><td><b>'.$areaName.'</b></td></tr><tr><td><b>Trip Id</b></td><td>'.$trip_trans_no.'</td></tr><tr><td><b>Truck Number</b></td><td><b>'.$vehicle_num.'</b></td></tr><tr><td><b>Transporter Name</b></td><td>'.$transName.'</td></tr><tr><td><b>Driver Name</b></td><td>'.$driver_Name.'</td></tr><tr><td><b>Driver Contact Number(s)</b></td><td>'.$driver_number.'</td></tr><tr><td><b>Ship To Party</b></td><td>'.$accNAme.'</td></tr><tr><td><b>Sold To Party</b></td><td>'.$accNAme.'</td></tr><tr><td><b>Invoice Quantity</b></td><td>'.$despatch_qty.'-'.$umcode.'-'.$despatchAqty.'-'.$aumcode.'</td></tr></tbody></table>';

                $mailer->Body = $message;

        $itemcd = $request->input('item');

			if($itemcd!=''){ 
	    		$itemcd;
	    	}else{ 
	    		$itemcd ='';
    		}


        $desQty = $request->input('despatch_qty');

			if($desQty!=''){ 
	    		$desQty;
	    	}else{ 
	    		$desQty ='';
    		}

    	$destAQty = $request->input('despatch_aqty');

			if($destAQty!=''){ 
	    		$destAQty;
	    	}else{ 
	    		$destAQty ='';
    		}

    	$vehiclNo = $request->input('vehicle_no');

			if($vehiclNo!=''){ 
	    		$vehiclNo;
	    	}else{ 
	    		$vehiclNo ='';
    		}

    	$transCode = $request->input('transport_code');

			if($transCode!=''){ 
	    		$transCode;
	    	}else{ 
	    		$transCode ='';
    		}

		$depot_code   = $request->input('depot_code');
		$account_code = $request->input('account_code');
		$area_code = $request->input('area_code');
		$transcode     = $request->input('Trancode');
		$vrno     = $request->input('transaction_no');
    	 $data = array(
					"COMP_CODE"     =>  $request->input('comp_code'),
					"FY_CODE"       =>  $request->input('fy_year'),
					"DEPOT_CODE"    =>  $request->input('depot_code'),
					"VRDATE"        =>  $Transaction_date,
					"VRNO"          =>  $request->input('transaction_no'),
					"CHALLAN_NO"    =>  $request->input('chalan_no'),
					"ACC_CODE"      =>  $request->input('account_code'),
					"AREA_CODE"     =>  $request->input('area_code'),
					"TRAN_CODE"     =>  $transCode,
					"TRUCK_NO"      =>  $vehiclNo,
					"ITEM_CODE"     =>  $itemcd,
					"DESPQTY"       =>  $desQty,
					"DESPAQTY"      =>  $destAQty,
					"INV_NO"        =>  $request->input('invoice_no'),
					"DESP_TYPE"     =>  $request->input('despatch_type'),
					"DRIVER_NAME"   =>  $request->input('driver_name'),
					"DRIVER_NUMBER" =>  $request->input('driver_number'),
					"CREATED_BY"    =>  $request->session()->get('userid')
				
	    	);

		$saveData = DB::table('OUTWORD_TRAN')->insert($data);

		$datavr =array(
					'LAST_NO'=>$vrno
				);
			$updatevr = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->update($datavr);

		      $mailSend = $mailer->send();
                $mailer->ClearAllRecipients();

			if ($saveData && $mailSend) {

				$request->session()->flash('alert-success', 'Outward Transaction Was Successfully Added...!');
				return redirect('/view-outward-trans');

			}else {

				$request->session()->flash('alert-error', 'Outward Transaction Can Not Added...!');
				return redirect('/view-outward-trans');

			}
    }

    

    public function DeleteOutwardTrans(Request $request){

        $id = $request->input('id');
        if ($id!='') {

		
			$outward = DB::table('OUTWORD_TRAN')->where('OUTWORDID',$id)->get()->first();

        	$outward_depot_code = DB::table('OUTWORD_TRAN')->where('DEPOT_CODE',$outward->DEPOT_CODE)->get()->toArray();

        	$outward_acc_code = DB::table('OUTWORD_TRAN')->where('ACC_CODE',$outward->ACC_CODE)->get()->toArray();

        	$outward_item_code = DB::table('OUTWORD_TRAN')->where('ITEM_CODE',$outward->ITEM_CODE)->get()->toArray();

        	$outward_area_code = DB::table('OUTWORD_TRAN')->where('AREA_CODE',$outward->AREA_CODE)->get()->toArray();



        	$count =count($outward_depot_code);

        	if($count >1){
        		$Delete = DB::table('OUTWORD_TRAN')->where('OUTWORDID', $id)->delete();

        	}else{
        		$Delete = DB::table('OUTWORD_TRAN')->where('OUTWORDID', $id)->delete();

        		$data=array(

        			'outward_trans'=>0

        		);

        	}



        	$outward_acc_count = count($outward_acc_code);

        	if($outward_acc_count >1){
        		$Delete1 = DB::table('OUTWORD_TRAN')->where('OUTWORDID', $id)->delete();

        	}else{
        		$Delete1 = DB::table('OUTWORD_TRAN')->where('OUTWORDID', $id)->delete();

        		$data=array(

        			'outward_trans'=>0

        		);
        	
        	}

        	
        	$outward_item_count = count($outward_item_code);

        	if($outward_item_count >1){
        		$Delete2 = DB::table('OUTWORD_TRAN')->where('OUTWORDID', $id)->delete();

        	}else{
        		$Delete2 = DB::table('OUTWORD_TRAN')->where('OUTWORDID', $id)->delete();

        		$data=array(

        			'outward_trans'=>0

        		);

        	}

        	
        	$outward_area_count = count($outward_area_code);

        	if($outward_area_count >1){

        		$Delete3 = DB::table('outward_trans')->where('id', $id)->delete();

        	}else{
        		$Delete3 = DB::table('outward_trans')->where('id', $id)->delete();

        		$data=array(

        			'outward_trans'=>0

        		);
        	
        	}

        	if($Delete  &&  empty($Delete1) && empty($Delete2) && empty($Delete3)|| $Delete1  &&  empty($Delete) && empty($Delete2) && empty($Delete3) || $Delete2 &&  empty($Delete) && empty($Delete1) && empty($Delete3)  || $Delete3 &&  empty($Delete) && empty($Delete1) && empty($Delete2)){

			$request->session()->flash('alert-success', 'Outward Tranaction Data Was Deleted Successfully...!');
			return redirect('/view-outward-trans');

			} else {

			$request->session()->flash('alert-error', 'Outward Tranaction Data Can Not Deleted...!');
			return redirect('/view-outward-trans');

			}

		}else{

		$request->session()->flash('alert-error', 'Outward Tranaction Data Not Found...!');
		return redirect('/view-outward-trans');

		}
	}

	public function EditOutwardTrans($id,Request $request){

		$title = 'Edit Outward Tranaction';

		$id = base64_decode($id);

		$CompanyCode   = $request->session()->get('company_name');
		$MaccYear      = $request->session()->get('macc_year');
		$getcomcode    = explode('-', $CompanyCode);
		$CCFromSession = $getcomcode[0];

		if($id!=''){
    	    $query = DB::table('OUTWORD_TRAN');
			$query->where('OUTWORDID', $id);
			$compData['outward_trans_list'] = $query->get()->first();
			
			$compData['user_list']          = DB::table('MASTER_DEPOT')->get();
			
			$compData['acc_list']           = DB::table('MASTER_ACC')->get();
			
			$compData['area_list']          = DB::table('MASTER_AREA')->get();
			
			/*$compData['transpoter_list']    = DB::table('transporter')->get();
			
			$compData['item_list']          = DB::table('master_item')->get();*/


			$item_um_aum_list = DB::table('MASTER_FY')->where(['COMP_CODE'=>$CCFromSession,'FY_CODE'=>$MaccYear])->get();


				foreach ($item_um_aum_list as $key) {
					$compData['fromDate'] =  $key->FY_FROM_DATE;
					$compData['toDate']   =  $key->FY_TO_DATE;
				}

			return view('admin.cf.transaction.edit_outward_list', $compData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Company Not Found...!');
			return redirect('/view-outward-trans');
		}

	}

	public function UpdateOutwardTrans(Request $request){
		
    	 $despatch_type =  $request->input('despatch_type');

    	 $trDate = $request->input('transaction_date');

        $Transaction_date = date("Y-m-d", strtotime($trDate));

    	    	if($despatch_type == 'ST'){

    	    		$validate = $this->validate($request, [

						'depot_code'       => 'required',
						'account_code'     => 'required',
						'transaction_date' => 'required',
						'transaction_no'   => 'required',
						'despatch_type'    => 'required',
						'chalan_no'        => 'required',
						'area_code'        => 'required',
						'driver_name'      => 'required',
						'driver_number'    => 'required',
						'invoice_no'       => 'required',
					]);

    	    	}else{
    	    		
    	    		$validate = $this->validate($request, [

						'depot_code'       => 'required',
						'account_code'     => 'required',
						'transaction_date' => 'required',
						'transaction_no'   => 'required',
						'despatch_type'    => 'required',
						'chalan_no'        => 'required',
						'area_code'        => 'required',
						'driver_name'      => 'required',
						'driver_number'    => 'required',
					]);

    	    	}

    	 $id= $request->input('outward_id');
    	 $updatedDate = date("Y-m-d");

    	 $itemcd = $request->input('item');

			if($itemcd!=''){ 
	    		$itemcd;
	    	}else{ 
	    		$itemcd ='';
    		}


        $desQty = $request->input('despatch_qty');

			if($desQty!=''){ 
	    		$desQty;
	    	}else{ 
	    		$desQty ='';
    		}

    	$destAQty = $request->input('despatch_aqty');

			if($destAQty!=''){ 
	    		$destAQty;
	    	}else{ 
	    		$destAQty ='';
    		}

    	$vehiclNo = $request->input('vehicle_no');

			if($vehiclNo!=''){ 
	    		$vehiclNo;
	    	}else{ 
	    		$vehiclNo ='';
    		}

    	$transCode = $request->input('transport_code');

			if($transCode!=''){ 
	    		$transCode;
	    	}else{ 
	    		$transCode ='';
    		}
    	 $data = array(
					"COMP_CODE"        =>  $request->input('comp_code'),
					"FY_CODE"          =>  $request->input('fy_year'),
					"DEPOT_CODE"       =>  $request->input('depot_code'),
					"VRDATE"           =>  $Transaction_date,
					"VRNO"             =>  $request->input('transaction_no'),
					"CHALLAN_NO"       =>  $request->input('chalan_no'),
					"ACC_CODE"         =>  $request->input('account_code'),
					"AREA_CODE"        =>  $request->input('area_code'),
					"TRAN_CODE"        =>  $transCode,
					"TRUCK_NO"         =>  $vehiclNo,
					"ITEM_CODE"        =>  $itemcd,
					"DESPQTY"          =>  $desQty,
					"DESPAQTY"         =>  $destAQty,
					"INV_NO"           =>  $request->input('invoice_no'),
					"DESP_TYPE"        =>  $request->input('despatch_type'),
					"DRIVER_NAME"      =>  $request->input('driver_name'),
					"DRIVER_NUMBER"    =>  $request->input('driver_number'),
					"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
					"LAST_UPDATE_DATE" =>  $updatedDate
				
	    	);

    	 $saveData = DB::table('OUTWORD_TRAN')->where('OUTWORDID', $id)->update($data);
    	

			if ($saveData) {

				$request->session()->flash('alert-success', 'Outward Transaction Was Successfully Updated...!');
				return redirect('/view-outward-trans');

			} else {

				$request->session()->flash('alert-error', 'Outward Transaction Can Not Updated...!');
				return redirect('/view-outward-trans');

			}


	}


/*---------- end outward transaction ---------- */

/* ---------- start sap bill -------------- */
	
	public function SapBill(Request $request){

    	$title = 'Add Sap Bill';

    	$CompanyCode   = $request->session()->get('company_name');
		$MaccYear      = $request->session()->get('macc_year');
		$getcomcode    = explode('-', $CompanyCode);
		$CCFromSession = $getcomcode[0];

		$userData['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userData['item_list']       = DB::table('MASTER_ITEM')->get();
		
		$userData['acc_list']        = DB::table('MASTER_ACC')->get();
		
		$userData['area_list']       = DB::table('MASTER_AREA')->get();
		
		$userData['transpoter_list'] = DB::table('MASTER_AREA')->get();

		
		//DB::enableQueryLog();
		$item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$MaccYear)->get();
		//dd(DB::getQueryLog());
					foreach ($item_um_aum_list as $key) {
					$userData['fromDate'] =  $key->FY_FROM_DATE;
					$userData['toDate']   =  $key->FY_TO_DATE;
					}

    	return view('admin.finance.transaction.candf.sap_bill',$userData+compact('title'));

    }

    public function SaveSapBill(Request $request){

    	//print_r($request->post());exit();

    	$trDate = $request->input('transaction_date');

    	$Transaction_date = date("Y-m-d", strtotime($trDate));


    	$InvoiceDate = $request->input('invoice_date');


    	$Invoice_date = date("Y-m-d", strtotime($InvoiceDate));


    	$validate = $this->validate($request, [

				'transaction_date' => 'required',
				'transaction_no'   => 'required',
				'invoice_date'     => 'required',
				'invoice_no'       => 'required',
				'depot_code'       => 'required',
				'account_code'     => 'required',
				'area_code'        => 'required',
				'transport_code'   => 'required',
				'vehicle_no'       => 'required',
				'item_code'        => 'required',
				'inv_qty_um'       => 'required',
				'inv_qty_aum'      => 'required',
				'so_code'          => 'required',

		]);

    	$depot_code = $request->input('depot_code');
    	$account_code = $request->input('account_code');
    	$area_code = $request->input('area_code');
    	$item_code = $request->input('item_code');
    	$trpt_code = $request->input('transport_code');

		$data = array(
					"COMP_CODE"    =>  $request->input('comp_code'),
					"FY_CODE"      =>  $request->input('fy_year'),
					"VRDATE"       =>  $Transaction_date,
					"VRNO"         =>  $request->input('transaction_no'),
					"INVOICE_DATE" =>  $Invoice_date,
					"INVOICE_NO"   =>  $request->input('invoice_no'),
					"DEPOT_CODE"   =>  $request->input('depot_code'),
					"ACC_CODE"     =>  $request->input('account_code'),
					"AREA_CODE"    =>  $request->input('area_code'),
					"trpt_code"    =>  $request->input('transport_code'),
					"TRUCK_NO"     =>  $request->input('vehicle_no'),
					"ITEM_CODE"    =>  $request->input('item_code'),
					"QTYISSUED"    =>  $request->input('inv_qty_um'),
					"AQTYISSUED"   =>  $request->input('inv_qty_aum'),
					"SO_CODE"      =>  $request->input('so_code'),
					"CREATED_BY"   =>  $request->session()->get('userid')
	 
	    	);



		$saveData = DB::table('SAP_BILL')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Sap Bill Was Successfully Added...!');
			return redirect('/view-sap-bill');
		} else {

			$request->session()->flash('alert-error', 'Sap Bill Can Not Added...!');
			return redirect('/view-sap-bill');

		}

    }

    public function viewSapBill(Request $request){
    	//print_r($request->session()->get('userid'));exit;

    	if ($request->ajax()) {

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');
		//print_r($userid);exit;

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){

    	$data = DB::table('SAP_BILL')
            ->join('MASTER_ACC', 'SAP_BILL.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
            ->select('SAP_BILL.*', 'MASTER_ACC.ACC_NAME')
            ->where([['SAP_BILL.COMP_CODE','=',$CompanyCode],['SAP_BILL.FY_CODE','=',$macc_year]])
            ->orderBy('SABBILLID','DESC')
            ->get();
    	

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	//DB::enableQueryLog();
		$data = DB::table('SAP_BILL')
            ->join('MASTER_ACC', 'SAP_BILL.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
            ->select('SAP_BILL.*', 'MASTER_ACC.ACC_NAME')
            ->where([['SAP_BILL.COMP_CODE','=',$CompanyCode],['SAP_BILL.FY_CODE','=',$macc_year]])
            ->orderBy('SABBILLID','DESC')
            ->get();
    	 //dd(DB::getQueryLog());

    	}else{
    		
    		$data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){ 
    		$depot_code = $data->depot_code;

				$btn = '<button type="button"  class="btn btn-primary btn-xs" data-toggle="modal" data-target="#sapbillview" onclick="return ViewSapBil('.$data->SABBILLID.')"><i class="fa fa-eye" title="view"></i></button> | <a href="'.url('/edit-form-sap-bil/'.base64_encode($data->SABBILLID)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#sapbillDelete" class="btn btn-danger btn-xs" onclick="return deletesapbil('.$data->SABBILLID.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View Sap Bill';
       return view('admin.cf.transaction.view_sap_bill',compact('title'));

    }

    public function DeleteSapBill(Request $request){

        $id = $request->input('id');
        if ($id!='') {

        	$sap = DB::table('SAP_BILL')->where('SABBILLID',$id)->get()->first();

        	$Delete = DB::table('SAP_BILL')->where('SABBILLID', $id)->delete();

			if($Delete){

			$request->session()->flash('alert-success', 'Sap Bill Data Was Deleted Successfully...!');
			return redirect('/view-sap-bill');

			} else {

			$request->session()->flash('alert-error', 'Sap Bill Data Can Not Deleted...!');
			return redirect('/view-sap-bill');

			}

		}else{

		$request->session()->flash('alert-error', 'Sap Bill Data Not Found...!');
		return redirect('/view-sap-bill');

		}
	}

/* ---------- end sap bill -------------- */

/* ---------- AJAX CODE ----------*/
	
	public function Item_UM_AUM(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$itemCode = $request->input('itemcode');

	    
	    	$item_um_aum_list = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemCode)->get();

    		if ($item_um_aum_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_um_aum_list ;

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

    /*fetch invoice no when select desptach type*/
  public function Dpt_Type_Ajax(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$inv_no = $request->input('inv_no');
	    	$desp_type = $request->input('desp_type');
	    	$comp_code = $request->input('comp_code');
	    	$fy_year = $request->input('fy_year');
	    
	    	/*$item_um_aum_list = DB::select("SELECT inward_trans.item_code,inward_trans.truck_no,inward_trans.invoice_no,inward_trans.trpt_code,inward_trans.sto_qty,inward_trans.sto_aqty FROM `inward_trans` WHERE inward_trans.invoice_no='$inv_no' AND inward_trans.comp_code ='$comp_code' AND  inward_trans.fy_year='$fy_year' ");*/

	    	$item_um_aum_list = DB::select("SELECT INWARD_TRANS.ITEM_CODE,INWARD_TRANS.TRUCK_NO,INWARD_TRANS.INOVICE_NO,INWARD_TRANS.TRPT_CODE,INWARD_TRANS.STO_QTY,INWARD_TRANS.STO_AQTY FROM `INWARD_TRANS` WHERE INWARD_TRANS.INOVICE_NO='$inv_no'AND INWARD_TRANS.FLAG='$desp_type' AND INWARD_TRANS.COMP_CODE ='$comp_code' AND  INWARD_TRANS.FY_CODE='$fy_year' ");


	    	/*$item_um_aum_list = DB::table('inward_trans')
				->select('inward_trans.item_code','inward_trans.truck_no','inward_trans.invoice_no','inward_trans.trpt_code','inward_trans.sto_qty','inward_trans.sto_aqty')
           		->where([['inward_trans.invoice_no','=',$inv_no],['inward_trans.comp_code','=',$comp_code],['inward_trans.fy_year','=',$fy_year]])
            	->get();*/

    		if ($item_um_aum_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_um_aum_list ;

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
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }
/*fetch invoice no when select desptach type*/

	
	public function getItemlist(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$MaccYear      = $request->session()->get('macc_year');
			$CompanyDetail = $request->session()->get('company_name');
			$splitData     = explode('-', $CompanyDetail);
			$comp_code     = $splitData[0];
			$transportType = $request->input('transport_Type');
			$batchNo       = $request->input('batchNo');
			$batchslno     = $request->input('batchslno');
			$rakeNo        = $request->input('rakeNo');
			$itemCode      = $request->input('ItemCode');

	    	if($transportType == 'BY_ROAD' && $batchNo == ''){

	    		$itemList = DB::table('MASTER_ITEM')->where('ITEMTYPE_CODE','TP')->get()->toArray();
	    	}else if($transportType =='BY_RAKE' && $batchNo){
	    		$itemList = DB::table('RAKE_TRAN')->where('COMP_CODE',$comp_code)->where('BATCH_NO',$batchNo)->where('SLNO',$batchslno)->where('RAKE_NO',$rakeNo)->where('CFINWARD_STATUS','0')->get();
	    	}else{
	    		$itemList = '';
	    	}

	    	if($rakeNo && $transportType == 'BY_RAKE'){

	    		$getBatchNoList = DB::table('RAKE_TRAN')->where('COMP_CODE',$comp_code)->where('RAKE_NO',$rakeNo)->where('CFINWARD_STATUS','0')->get();
	    	}else{
	    		$getBatchNoList = '';
	    	}

	    	if($rakeNo && $itemCode){
	    		$item_details = DB::table('RAKE_TRAN')->where('COMP_CODE',$comp_code)->where('BATCH_NO',$batchNo)->where('SLNO',$batchslno)->where('ITEM_CODE',$itemCode)->where('CFINWARD_STATUS','0')->get()->first();
	    	}else if($itemCode && $rakeNo==''){
	    		$item_details = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();
	    	}else{
	    		$item_details ='';
	    	}

    		if ($itemList || $item_details || $getBatchNoList) {

				$response_array['response']    = 'success';
				$response_array['itemdata']    = $itemList;
				$response_array['itemDetails'] = $item_details;
				$response_array['BatchNoList'] = $getBatchNoList;
	            $data = json_encode($response_array);
	            print_r($data);

			}else{

				$response_array['response']    = 'error';
				$response_array['itemdata']    = '';
				$response_array['itemDetails'] = '';
				$response_array['BatchNoList'] = '';
                $data = json_encode($response_array);
                print_r($data);
				
			}

	    }else{

				$response_array['response']    = 'error';
				$response_array['itemdata']    = '' ;
				$response_array['itemDetails'] = '' ;
				$response_array['BatchNoList'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
	    }

    }

    public function getVehicleDetailsCf(Request $request){

		$companyFull = $request->session()->get('company_name');
		$splitComp   = explode('-', $companyFull);
		$comp_code   = $splitComp[0];
		$fisYear     =  $request->session()->get('macc_year');

		$response_array = array();

		$vehicelNo = $request->input('vehicle_No');
		$gateEntryTblId = $request->input('gateEntryTblId');
		$rack_No   = $request->input('rackNo');

		if ($request->ajax()) {

			if($vehicelNo){

				$getvehicleDetails = DB::select("SELECT * FROM CF_GATE_ENTRY WHERE COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND VEHICLE_NUMBER='$vehicelNo' AND CFGATEID='$gateEntryTblId' AND CFINWARDID='0' AND VEHICLE_TYPE='GRN' AND TRAN_CODE='G2'");

	    		$storageLocation = DB::table('MASTER_STORAGE_LOCATION')->where('COMP_CODE',$comp_code)->where('PLANT_CODE',$getvehicleDetails[0]->PLANT_CODE)->get();

	    		$rackDetails = '';

			}else if($rack_No){
				$getvehicleDetails ='';
				$storageLocation ='';
				//DB::enableQueryLog();
				$rackDetails = DB::table('RAKE_TRAN')->where('COMP_CODE',$comp_code)->where('RAKE_NO',$rack_No)->where('CFINWARD_STATUS','0')->get();
				//dd(DB::getQueryLog());
			}else{
				$rackDetails = '';
				$getvehicleDetails ='';
				$storageLocation ='';
			}
	    		    	
    		if ($getvehicleDetails || $storageLocation || $rackDetails) {

				$response_array['response']              = 'success';
				$response_array['data']                  = $getvehicleDetails;
				$response_array['data_storage_location'] = $storageLocation;
				$response_array['data_rackNum'] = $rackDetails;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response']              = 'error';
				$response_array['data']                  = '' ;
				$response_array['data_storage_location'] = '' ;
				$response_array['data_rackNum'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

				$response_array['response']              = 'error';
				$response_array['data']                  = '' ;
				$response_array['data_storage_location'] = '' ;
				$response_array['data_rackNum'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function getTripDeatilsOfVehicle(Request $request){

		$companyFull    = $request->session()->get('company_name');
		$splitComp      = explode('-', $companyFull);
		$comp_code      = $splitComp[0];
		$fisYear        =  $request->session()->get('macc_year');
		$response_array = array();
		$vehicleNo      = $request->input('vehicleNo');
		$transport_Type = $request->input('transport_Type');
		$orderNo        = $request->input('orderNo');
		$batchNo        = $request->input('batchNo');
		$cfTblId        = $request->input('cfTblId');
		$batchslnoNo    = $request->input('batchslnoNo');
		$inTblHeadId    = $request->input('inTblHeadId');
		$itemCode       = $request->input('itemCode');
		$fieldType      = $request->input('fieldType');
		$transportType  = $request->input('transportType');
		$tripno      = $request->input('tripno');
		$tblGateId      = $request->input('tblGateId');
		//$tripHeadId      = $request->input('tripHeadId');
		//print_r($tripno);exit;
		$vehicleNoList  ='';
		$outwardDeatils ='';
		$gettripNo ='';
		$vehicleType ='';
		$accAddress ='';
		$vehicleDOutward='';
		$getTrptData ='';

		
		if ($request->ajax()) {
			if($transport_Type == 'MARKET' || $transport_Type == 'EX_YARD'){

				$vehicleNoList = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('TRAN_CODE','G2')->where('VEHICLE_TYPE','TRIP')->where('LOADING_SLIP_STATUS','0')->whereNull('TRIP_NO')->get();
			}else if($transport_Type == 'SISTER_CONCERN'){
				//$vehicleNoList = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('TRAN_CODE','G2')->where('VEHICLE_TYPE','TRIP')->where('LOADING_SLIP_STATUS','0')->whereNotNull('TRIP_NO')->get();

				//DB::enableQueryLog();

				$vehicleNoList = DB::select("SELECT t1.* FROM `CF_GATE_ENTRY` t1 WHERE t1.TRAN_CODE='G2' AND t1.VEHICLE_TYPE='TRIP' AND t1.LOADING_SLIP_STATUS='0' AND t1.COMP_CODE='$comp_code' AND t1.TRIP_NO IS NOT NULL");

				//dd(DB::getQueryLog());				
				//print_r($vehicleNoList);exit;
			}else{
				$vehicleNoList = DB::select("SELECT t1.* FROM `CF_GATE_ENTRY` t1,TRIP_HEAD t2 WHERE t1.TRIPHID=t2.TRIPHID AND t1.COMP_CODE=t2.COMP_CODE AND t1.TRAN_CODE='G2' AND t1.VEHICLE_TYPE='TRIP' AND t1.COMP_CODE='$comp_code' AND t1.LOADING_SLIP_STATUS='0' AND t1.TRIP_NO IS NOT NULL");
			}

			if($vehicleNo){

				if($transport_Type == 'MARKET' || $transport_Type == 'EX_YARD'){
					/*$gettripNo = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('VEHICLE_NUMBER',$vehicleNo)->where('TRAN_CODE','G2')->where('LOADING_SLIP_STATUS','0')->where('VEHICLE_TYPE','TRIP')->get();*/
					$gettripNo = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('VEHICLE_NUMBER',$vehicleNo)->where('CFGATEID',$tblGateId)->where('TRAN_CODE','G2')->where('LOADING_SLIP_STATUS','0')->where('VEHICLE_TYPE','TRIP')->get();
				}else{

					//DB::enableQueryLog();
					/*$gettripNo = DB::select("SELECT A.*,B.TRIPHID,B.COMP_CODE AS TRIP_COMP_CODE,B.FY_CODE AS TRIP_FY_CODE,B.PFCT_CODE AS TRIP_PFCT_CODE,B.TRAN_CODE AS TRIP_TRAN_CODE,B.SERIES_CODE AS TRIP_SERIES_CODE,B.ACC_CODE AS TRIP_ACC_CODE,B.ACC_NAME AS TRIP_ACC_NAME,B.FROM_PLACE AS TRIP_FROM_PLACE,B.TO_PLACE AS TRIP_TO_PLACE,B.VRDATE AS TRIP_VRDATE,B.TRANSPORT_CODE AS TRPT_CODE,B.TRANSPORT_NAME AS TRPT_NAME FROM `CF_GATE_ENTRY` A,TRIP_HEAD B WHERE A.TRIP_NO=B.TRIP_NO AND A.TRIPHID=B.TRIPHID AND A.TRAN_CODE='G2' AND A.VEHICLE_TYPE='TRIP' AND A.VEHICLE_NUMBER='$vehicleNo' AND A.LOADING_SLIP_STATUS='0' AND A.TRIP_NO IS NOT NULL");*/
					//dd(DB::getQueryLog());

					$gettripNo = DB::select("SELECT A.*,B.TRIPHID,B.COMP_CODE AS TRIP_COMP_CODE,B.FY_CODE AS TRIP_FY_CODE,B.PFCT_CODE AS TRIP_PFCT_CODE,B.TRAN_CODE AS TRIP_TRAN_CODE,B.SERIES_CODE AS TRIP_SERIES_CODE,B.ACC_CODE AS TRIP_ACC_CODE,B.ACC_NAME AS TRIP_ACC_NAME,B.FROM_PLACE AS TRIP_FROM_PLACE,B.TO_PLACE AS TRIP_TO_PLACE,B.VRDATE AS TRIP_VRDATE,B.TRANSPORT_CODE AS TRPT_CODE,B.TRANSPORT_NAME AS TRPT_NAME FROM `CF_GATE_ENTRY` A,TRIP_HEAD B WHERE A.TRIP_NO=B.TRIP_NO AND A.TRAN_CODE='G2' AND A.VEHICLE_TYPE='TRIP' AND A.VEHICLE_NUMBER='$vehicleNo' AND  A.CFGATEID='$tblGateId' AND A.LOADING_SLIP_STATUS='0' AND A.TRIP_NO IS NOT NULL");

				}
				///DB::enableQueryLog();
//dd(DB::getQueryLog());

				

				//print_r($seriesCode);exit();
				//DB::enableQueryLog();


			//$transport_Type 
			//DB::enableQueryLog();
			if($transport_Type == 'MARKET' || $transport_Type == 'EX_YARD' || $tripno==''){

				$outwardDeatils = DB::select("SELECT t1.*,t4.CITY_NAME AS FROMPLACE,t1.TRPT_CODE AS TRIP_TRPTCODE,t1.TRPT_NAME AS TRIP_TRPTNAME,t2.STDRATE FROM CFOUTWARD_TRAN t1 LEFT JOIN MASTER_ITEM t2 ON t1.ITEM_CODE = t2.ITEM_CODE LEFT JOIN MASTER_PLANT t4 ON t1.COMP_CODE = t4.COMP_CODE AND t1.PLANT_CODE = t4.PLANT_CODE  WHERE t1.VEHICLE_NO='$vehicleNo'  AND t1.LR_STATUS='0' AND t1.LOADING_PLAN_STATUS='1'");
			  	
			}else{

				$explodeTrip = explode(' ', $tripno);
				$fyCodeYear = $explodeTrip[0];
				$seriesCode = $explodeTrip[1];
				$vrNo  = $explodeTrip[2];

				$outwardDeatils = DB::select("SELECT t1.*,t4.CITY_NAME AS FROMPLACE,t3.TRIPHID,t3.COMP_CODE AS TRIP_COMP,t3.FY_CODE AS TRIP_FYCODE,t3.PFCT_CODE AS TRIP_PFCTCODE,t3.PFCT_NAME AS TRIP_PFCTNAME,t3.TRAN_CODE AS TRIP_TRANCODE,t3.SERIES_CODE AS TRIP_SERIESCODE,t3.SERIES_NAME AS TRIP_SERIESNAME,t3.ACC_CODE AS TRIP_ACCCODE,t3.ACC_NAME AS TRIP_ACCNAME,t3.VRDATE AS TRIP_VRDATE,t1.TRPT_CODE AS TRIP_TRPTCODE,t1.TRPT_NAME AS TRIP_TRPTNAME,t3.TO_PLACE AS TOPLACE,t3.SLR_FLAG AS SLR_FLAG,t3.VEHICLE_TYPE AS VEHICLETYPE,t3.MODEL AS MODEL,t3.TRIP_DAY AS TRIPDAY,t2.STDRATE FROM CFOUTWARD_TRAN t1 LEFT JOIN MASTER_ITEM t2 ON t1.ITEM_CODE = t2.ITEM_CODE LEFT JOIN MASTER_PLANT t4 ON t1.COMP_CODE = t4.COMP_CODE AND t1.PLANT_CODE = t4.PLANT_CODE LEFT JOIN TRIP_HEAD t3 ON t1.VEHICLE_NO = t3.VEHICLE_NO AND t1.TRIP_NO = t3.TRIP_NO WHERE t1.VEHICLE_NO='$vehicleNo' AND t3.SERIES_CODE='$seriesCode' AND t3.VRNO='$vrNo' AND t1.LR_STATUS='0' AND t1.LOADING_PLAN_STATUS='1'");

			}
			//dd(DB::getQueryLog());
			  	$vehicleDOutward = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('VEHICLE_TYPE','TRIP')->where('CFOUTWARDID','0')->where('VEHICLE_NUMBER',$vehicleNo)->whereNull('VEHICLE_OUT_DATETIME')->get();

			  	//dd(DB::getQueryLog());

			  	if($outwardDeatils){
			  		$accAddress = DB::table('MASTER_ACCADD')->where('ACC_CODE',$outwardDeatils[0]->ACC_CODE)->get();
			  	}else{
			  		$accAddress ='';
			  	}

			  	$vehicleType = DB::table('MASTER_FLEET')->where('TRUCK_NO',$vehicleNo)->get()->first();

			}else{
				$gettripNo ='';
				$getInwarddata ='';
				$outwardDeatils ='';
				$vehicleType ='';
				$getTrptData ='';
			}

			if($batchNo && $fieldType == 'BATCH'){

				$getInwarddata = DB::table('CFINWARD_TRAN')->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('CFINWARDID',$inTblHeadId)->where('LOADING_SLIP_STATUS','0')->get();

			}else if($batchNo && $itemCode && $fieldType == 'ITEM'){

				$getInwarddata = DB::table('CFINWARD_TRAN')->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('CFINWARDID',$inTblHeadId)->where('ITEM_CODE',$itemCode)->where('LOADING_SLIP_STATUS','0')->get();

			}else if($batchNo && $itemCode && $orderNo && $fieldType == 'ORDER' && $transportType=='BY_RAKE'){

				//$getInwarddata = DB::table('CFINWARD_TRAN')->where('BATCH_NO',$batchNo)->where('ITEM_CODE',$itemCode)->where('ORDER_NO',$orderNo)->where('LOADING_SLIP_STATUS','0')->get();
					//DB::enableQueryLog();
				$getInwarddata = DB::select("SELECT DISTINCT(t2.TRPT_CODE) AS DO_TRPT_CODE,t2.TRPT_NAME AS DO_TRPTNAME,t1.* FROM `CFINWARD_TRAN` t1,DORDER_BODY t2 WHERE t1.ORDER_NO=t2.DORDER_NO AND t1.BATCH_NO='$batchNo' AND t1.SLNO='$batchslnoNo' AND t1.ITEM_CODE='$itemCode' AND t1.ORDER_NO='$orderNo' AND t1.LOADING_SLIP_STATUS='0' AND t1.CFINWARDID='$inTblHeadId'");

				$rake_no = $getInwarddata[0]->RAKE_NO;
				$cp_code = $getInwarddata[0]->CP_CODE;


				$getTrptData = DB::table('RAKE_TRAN_SUMMARY')->where('RAKE_NO',$rake_no)->where('CP_CODE',$cp_code)->get()->first();
				//dd(DB::getQueryLog());
			}else if($batchNo && $itemCode && $orderNo && $fieldType == 'ORDER' && $transportType=='BY_ROAD'){

				$getInwarddata = DB::select("SELECT t1.* FROM `CFINWARD_TRAN` t1 WHERE  t1.BATCH_NO='$batchNo' AND t1.SLNO='$batchslnoNo' AND t1.ITEM_CODE='$itemCode' AND t1.ORDER_NO='$orderNo' AND t1.LOADING_SLIP_STATUS='0'");
				$rake_no = $getInwarddata[0]->RAKE_NO;
				$cp_code = $getInwarddata[0]->CP_CODE;


				$getTrptData = DB::table('RAKE_TRAN_SUMMARY')->where('RAKE_NO',$rake_no)->where('CP_CODE',$cp_code)->get()->first();
			}else{
				$getInwarddata='';
				$getTrptData ='';
			}

			//print_r($getInwarddata);exit;
	    		    	
    			if ($outwardDeatils || $gettripNo || $vehicleNoList || $getInwarddata || $vehicleType || $accAddress) {

				$response_array['response']           = 'success';
				$response_array['data_outward']       = $outwardDeatils;
				$response_array['data_vehicle']       = $gettripNo;
				$response_array['data_vehicle_list']  = $vehicleNoList;
				$response_array['data_inwardDt_list'] = $getInwarddata;
				$response_array['data_trpt_data']     = $getTrptData;
				$response_array['data_vehicle_type']  = $vehicleType;
				$response_array['data_accAddress']    = $accAddress;
				$response_array['data_vehicleOut']    = $vehicleDOutward;
	            	$data = json_encode($response_array);
	            	print_r($data);

			}else{

				$response_array['response']           = 'error';
				$response_array['data']               = '' ;
				$response_array['data_outward']       = '' ;
				$response_array['data_DO']            = '' ;
				$response_array['data_vehicle']       = '' ;
				$response_array['data_vehicle_list']  = '' ;
				$response_array['data_inwardDt_list'] = '' ;
				$response_array['data_trpt_data']     = '';
				$response_array['data_vehicle_type']  = '' ;
				$response_array['data_accAddress']    = '' ;
				$response_array['data_vehicleOut']    = '';
               	$data = json_encode($response_array);
                	print_r($data);
				
			}

	    }else{

				$response_array['response']           = 'error';
				$response_array['data']               = '' ;
				$response_array['data_outward']       = '' ;
				$response_array['data_DO']            = '' ;
				$response_array['data_vehicle']       = '' ;
				$response_array['data_vehicle_list']  = '' ;
				$response_array['data_inwardDt_list'] = '' ;
				$response_array['data_accAddress'] = '' ;

				$response_array['data_vehicle_type'] = '' ;
                	$data = json_encode($response_array);
                	print_r($data);
	    }

    }


    public function getBatchDeatilsByAcc(Request $request){

		$companyFull    = $request->session()->get('company_name');
		$splitComp      = explode('-', $companyFull);
		$comp_code      = $splitComp[0];
		$fisYear        =  $request->session()->get('macc_year');
		$response_array = array();
		$customer_code       = $request->input('customer_code');
		$transport_type       = $request->input('transport_Type');

		if ($request->ajax()) {

			if($customer_code && $transport_type){

				//DB::enableQueryLog();
				$getDetails = DB::select("SELECT BATCH_NO,SLNO,ITEM_NAME,QTYRECD,CFINWARDID,(QTYRECD - LOADSLIP_QTY) AS LOADBALQTY,WAGON_NO,INVOICE_NO FROM CFINWARD_TRAN WHERE ACC_CODE='$customer_code' AND TRANSPORT_TYPE='$transport_type' AND LOADING_SLIP_STATUS='0' ");
				//dd(DB::getQueryLog());
				//$getDetails = DB::table('CFINWARD_TRAN')->select('BATCH_NO','SLNO','ITEM_NAME','QTYRECD','CFINWARDID')->where('ACC_CODE',$customer_code)->where('TRANSPORT_TYPE',$transport_type)->where('LOADING_SLIP_STATUS','0')->get()->toArray();

				//print_r($getDetails);exit;

			}else{

				$getDetails='';
			}
			
    		if ($getDetails) {

				$response_array['response']      = 'success';
				$response_array['data'] = $getDetails;
	            	$data = json_encode($response_array);
	            	print_r($data);

			}else{

				$response_array['response']      = 'error';
				$response_array['data'] = '' ;
                	$data = json_encode($response_array);
                	print_r($data);
				
			}

	    }else{

				$response_array['response']      = 'error';
				$response_array['data'] = '' ;
                	$data = json_encode($response_array);
                	print_r($data);
	    }

    	}

    public function getTripNoOrVehicleNo(Request $request){

		$companyFull    = $request->session()->get('company_name');
		$splitComp      = explode('-', $companyFull);
		$comp_code      = $splitComp[0];
		$fisYear        =  $request->session()->get('macc_year');
		$response_array = array();
		$vehicelNo      = $request->input('vehicle_no');
		$tripNo         = $request->input('trip_no');
		$vehicle_type   = $request->input('vehicle_type');
		$driverDetails  ='';

		if ($request->ajax()) {

			if($vehicle_type=='TRIP'){
				//$vehicleNoList = DB::select("SELECT A.TRIP_NO,B.CP_NAME,B.TO_PLACE FROM TRIP_HEAD A,TRIP_BODY B WHERE A.TRIPHID=B.TRIPHID AND A.VEHICLE_NO='$vehicelNo'");

				$vehicleNoList = DB::select("SELECT A.TRIP_NO,B.CP_NAME,B.TO_PLACE,A.VEHICLE_NO FROM TRIP_HEAD A,TRIP_BODY B WHERE A.TRIPHID=B.TRIPHID AND A.TRIP_WO_ITEM='1' AND A.GATE_IN_STATUS='0' GROUP BY A.TRIPHID ");
				$gettripNo='';
			}else{
				$vehicleNoList = '';
				$gettripNo='';
			}

			if($vehicelNo && $vehicle_type=='TRIP'){
				//DB::enableQueryLog();
				$gettripNo =  DB::select("SELECT A.TRIPHID,A.PLANT_CODE,A.PLANT_NAME,A.PFCT_CODE,A.PFCT_NAME,A.TRIP_NO,B.CP_NAME,B.TO_PLACE,A.VEHICLE_NO FROM TRIP_HEAD A,TRIP_BODY B WHERE A.TRIPHID=B.TRIPHID AND A.VEHICLE_NO='$vehicelNo' AND A.TRIP_WO_ITEM='1' AND A.GATE_IN_STATUS='0' AND A.TRIP_NO IS NOT NULL GROUP BY A.TRIPHID");

				//$gettripNo = DB::select("SELECT * FROM TRIP_HEAD WHERE (COMP_CODE='RL' OR COMP_CODE='SA' OR COMP_CODE='SE') AND VEHICLE_NO='$vehicelNo'");
				//$gettripNo = DB::table('TRIP_HEAD')->where('COMP_CODE','RL')->orwhere('COMP_CODE','SA')->orwhere('COMP_CODE','SE')->where('VEHICLE_NO',$vehicelNo)->get();
				//dd(DB::getQueryLog());
				$triVehicleNo = $vehicelNo;
				$vehicleNoList='';
			}else if($tripNo && $vehicle_type=='TRIP'){
				$gettripNo = DB::select("SELECT A.TRIPHID,A.PLANT_CODE,A.PLANT_NAME,A.PFCT_CODE,A.PFCT_NAME,A.VEHICLE_NO,B.CP_NAME,B.TO_PLACE FROM TRIP_HEAD A,TRIP_BODY B WHERE A.TRIPHID=B.TRIPHID AND A.TRIP_WO_ITEM='1' AND A.GATE_IN_STATUS='0' AND A.TRIP_NO='$tripNo' GROUP BY A.VEHICLE_NO");
				$vehicleNoList='';

				$triVehicleNo = $gettripNo[0]->VEHICLE_NO;
			}else{
				$gettripNo='';
				$triVehicleNo='';
			}

			//print_r($triVehicleNo);

			if($vehicelNo){
				$getVehicleNo = $vehicelNo;
			}else{
				$getVehicleNo = $triVehicleNo;
			}

			
			if($getVehicleNo){

				$masterDriver = DB::select("SELECT EMP_NAME AS DRIVER_NAME,LICENSE_NO AS DRIVER_ID,MOBILE_NO AS MOBILE_NUMBER FROM MASTER_DRIVER WHERE VEHICLE_NO='$getVehicleNo' AND (TO_DATE IS NULL OR TO_DATE='')");	
				if($masterDriver){

					$driverDetails = $masterDriver;
					
				}else{

					$driverDetails = DB::select("SELECT DRIVER_NAME,DRIVER_ID,MOBILE_NUMBER FROM CF_GATE_ENTRY WHERE VEHICLE_NUMBER='$getVehicleNo' ORDER BY VEHICLE_NUMBER DESC");

				}


			}
			
    		if ($gettripNo || $vehicleNoList || $driverDetails) {

				$response_array['response']       = 'success';
				$response_array['data']           = $gettripNo;
				$response_array['data_vehicleNo'] = $vehicleNoList;
				$response_array['data_driver']    = $driverDetails;
	            	$data = json_encode($response_array);
	            	print_r($data);

			}else{

				$response_array['response']       = 'error';
				$response_array['data']           = '' ;
				$response_array['data_vehicleNo'] = '' ;
				$response_array['data_driver']    = '' ;
                	$data = json_encode($response_array);
                	print_r($data);
				
			}

	    }else{

				$response_array['response']       = 'error';
				$response_array['data']           = '' ;
				$response_array['data_vehicleNo'] = '' ;
				$response_array['data_driver'] = '' ;
                	$data = json_encode($response_array);
                	print_r($data);
	    }

    	}


    	public function getAllDoDetailsAgainstField(Request $request){

		$companyFull    = $request->session()->get('company_name');
		$splitComp      = explode('-', $companyFull);
		$comp_code      = $splitComp[0];
		$fisYear        =  $request->session()->get('macc_year');
		$response_array = array();
		$dOrderNo       = $request->input('dOrderNo');
		$batch_no       = $request->input('batch_no');

		if ($request->ajax()) {

			if($dOrderNo && $batch_no==''){
				$getDODetails = DB::table('DORDER_BODY')->where('DORDER_NO',$dOrderNo)->get();
			}else if($dOrderNo && $batch_no){
				$getDODetails = DB::table('DORDER_BODY')->where('DORDER_NO',$dOrderNo)->where('BATCH_NO',$batch_no)->get();
			}else{
				$getDODetails='';
			}
			
    		if ($getDODetails) {

				$response_array['response']      = 'success';
				$response_array['dataDOdetails'] = $getDODetails;
	            	$data = json_encode($response_array);
	            	print_r($data);

			}else{

				$response_array['response']      = 'error';
				$response_array['dataDOdetails'] = '' ;
                	$data = json_encode($response_array);
                	print_r($data);
				
			}

	    }else{

				$response_array['response']      = 'error';
				$response_array['dataDOdetails'] = '' ;
                	$data = json_encode($response_array);
                	print_r($data);
	    }

    	}

    	public function GetDataForVehicleGetOutward(Request $request){

		$companyFull    = $request->session()->get('company_name');
		$splitComp      = explode('-', $companyFull);
		$comp_code      = $splitComp[0];
		$fisYear        =  $request->session()->get('macc_year');
		$response_array = array();
		$vehicle_no     = $request->input('vehicle_No');
		$vehicle_type   = $request->input('vehicle_type');
		$tblgateid   = $request->input('tblgateid');

		if ($request->ajax()) {

			if($vehicle_type=='GRN'){

				$vehicleNoList = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('VEHICLE_TYPE','GRN')->whereNull('VEHICLE_OUT_DATETIME')->where('CFINWARDID','1')->get();
				$vehicleDetails='';
				$lr_details='';
			}else if($vehicle_type=='TRIP'){
				//DB::enableQueryLog();
				$vehicleNoList  = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('VEHICLE_TYPE','TRIP')->whereNull('VEHICLE_OUT_DATETIME')->where('CFOUTWARDID','1')->get();
				//dd(DB::getQueryLog());
				$vehicleDetails ='';
				$lr_details='';

				//print_r($vehicleNoList);exit;
			}

			if($vehicle_type=='GRN' && $vehicle_no){

				$vehicleDetails = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE','G2')->where('VEHICLE_TYPE','GRN')->where('CFGATEID',$tblgateid)->where('VEHICLE_NUMBER',$vehicle_no)->whereNull('VEHICLE_OUT_DATETIME')->where('CFINWARDID','1')->get()->first();
				$vehicleNoList ='';
				$lr_details='';
			}else if($vehicle_type=='TRIP' && $vehicle_no){
				$vehicleDetails =DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE','G2')->where('VEHICLE_TYPE','TRIP')->where('CFGATEID',$tblgateid)->where('VEHICLE_NUMBER',$vehicle_no)->whereNull('VEHICLE_OUT_DATETIME')->where('CFOUTWARDID','1')->get()->first();
				$vehicleNoList  ='';

				$lr_details = DB::table('CFOUTWARD_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('CFGATEID',$tblgateid)->where('VEHICLE_NO',$vehicle_no)->where('LR_STATUS','1')->get();

			}
			
    		if ($vehicleNoList || $vehicleDetails) {

				$response_array['response']           = 'success';
				$response_array['dataVehicleList']    = $vehicleNoList;
				$response_array['dataVehicleDetails'] = $vehicleDetails;
				$response_array['lr_details']         = $lr_details;
	            	$data = json_encode($response_array);
	            	print_r($data);

			}else{

				$response_array['response']           = 'error';
				$response_array['dataVehicleList']    = '' ;
				$response_array['dataVehicleDetails'] = '' ;
				$response_array['lr_details']         = '';
                	$data = json_encode($response_array);
                	print_r($data);
				
			}

	    }else{

				$response_array['response']           = 'error';
				$response_array['dataVehicleList']    = '' ;
				$response_array['dataVehicleDetails'] = '' ;
				$response_array['lr_details']         = '';
                	$data = json_encode($response_array);
                	print_r($data);
	    }

    	}

    	public function GetDataForLoadingPlanForInward(Request $request){

		$companyFull      = $request->session()->get('company_name');
		$splitComp        = explode('-', $companyFull);
		$comp_code        = $splitComp[0];
		$fisYear          = $request->session()->get('macc_year');
		$response_array   = array();
		$item_Code        = $request->input('itemcode');

		$vehicle_no       = $request->input('vehicleNo');
		$gateInTblId      = $request->input('gateInTblId');


		$transporter_type = $request->input('transporter_Type');
		$cp_Code          = $request->input('cpcode');
		$getItem          = '';
		$getcpQty         = '';
		$vehicleDetails   = '';
		$getTrpt          ='';

		if ($request->ajax()) {

			/* ----- VEHICLE DETAILS -------- */

				if($transporter_type == 'MARKET' || $transporter_type == 'EX_YARD'){

					$vehicleDetails = DB::table('CF_GATE_ENTRY')->where('COMP_CODE',$comp_code)->where('TRAN_CODE','G2')->where('VEHICLE_TYPE','TRIP')->where('LOADING_SLIP_STATUS','0')->where('VEHICLE_NUMBER',$vehicle_no)->where('CFGATEID',$gateInTblId)->whereNull('TRIP_NO')->get();
				}else{
					
					$vehicleDetails = DB::table('CF_GATE_ENTRY')->where('TRAN_CODE','G2')->where('VEHICLE_TYPE','TRIP')->where('LOADING_SLIP_STATUS','0')->where('VEHICLE_NUMBER',$vehicle_no)->where('CFGATEID',$gateInTblId)->whereNotNull('TRIP_NO')->get();

					/*where('COMP_CODE',$comp_code)-> */
				}

			/* ----- VEHICLE DETAILS -------- */

			/* ---- GET CP LIST ------- */

				if($transporter_type=='MARKET'){
					$cpData = DB::select("SELECT * FROM RAKE_TRAN_SUMMARY WHERE TRPT_TYPE='MARKET' GROUP BY CP_CODE");
				}else if($transporter_type=='EX_YARD'){
					$cpData = DB::select("SELECT * FROM RAKE_TRAN_SUMMARY WHERE TRPT_TYPE='EX-YARD' GROUP BY CP_CODE");
				}else if(($transporter_type=='SELF') || ($transporter_type=='SISTER_CONCERN')){
					$cpData = DB::select("SELECT A.*,B.* FROM `TRIP_HEAD` A,TRIP_BODY B WHERE A.TRIPHID=B.TRIPHID AND A.TRIP_WO_ITEM='1' AND A.LR_STATUS='0' GROUP BY B.CP_CODE");
				}else{
					$cpData ='';
				}

			/* ---- GET CP LIST ------- */

			/* ---- GET TRT CODE N NAME ---- */

				if(($transporter_type=='SISTER_CONCERN')){

					/*$getTrpt = DB::select("SELECT DISTINCT(A.TRANSPORT_CODE) AS TRPT_CODE,A.TRANSPORT_NAME AS TRPT_NAME FROM `TRIP_HEAD` A,TRIP_BODY B WHERE A.TRIPHID=B.TRIPHID AND A.TRIP_WO_ITEM='1' AND B.CP_CODE='$cp_Code'");*/

					$getTrpt = DB::select("SELECT DISTINCT(TRPT_CODE) AS TRPT_CODE,TRPT_NAME AS TRPT_NAME FROM RAKE_TRAN_SUMMARY WHERE CP_CODE='$cp_Code' AND TRPT_TYPE='SISTER-CONCERN'");

				}else if($transporter_type=='SELF'){

					$getTrpt = DB::select("SELECT DISTINCT(TRPT_CODE) AS TRPT_CODE,TRPT_NAME AS TRPT_NAME FROM RAKE_TRAN_SUMMARY WHERE CP_CODE='$cp_Code' AND TRPT_TYPE='SELF'");

				}else if($transporter_type=='MARKET'){

					$getTrpt = DB::select("SELECT DISTINCT(TRPT_CODE) AS TRPT_CODE,TRPT_NAME AS TRPT_NAME FROM RAKE_TRAN_SUMMARY WHERE CP_CODE='$cp_Code' AND TRPT_TYPE='MARKET'");

				}else if($transporter_type=='EX_YARD'){

					$getTrpt = DB::select("SELECT DISTINCT(TRPT_CODE) AS TRPT_CODE,TRPT_NAME AS TRPT_NAME FROM RAKE_TRAN_SUMMARY WHERE CP_CODE='$cp_Code' AND TRPT_TYPE='EX_YARD'");

				}else{
					$getTrpt = DB::select("SELECT DISTINCT(TRPT_CODE) AS TRPT_CODE,TRPT_NAME AS TRPT_NAME FROM RAKE_TRAN_SUMMARY WHERE CP_CODE='$cp_Code'");

				}

				$getTrpt = DB::select("SELECT DISTINCT(TRPT_CODE) AS TRPT_CODE,TRPT_NAME AS TRPT_NAME FROM RAKE_TRAN_SUMMARY WHERE CP_CODE='$cp_Code'");


			/* ---- GET TRT CODE N NAME ---- */

			/* ---- GET ITEM LIST ------- */

				$getItem = DB::select("SELECT * FROM CFINWARD_TRAN WHERE CP_CODE='$cp_Code' AND QTYRECD - QTYISSUED >0 GROUP BY ITEM_CODE");

				$getcpQty = DB::select("SELECT B.QTY FROM `TRIP_HEAD` A,TRIP_BODY B WHERE A.TRIPHID=B.TRIPHID AND A.TRIP_WO_ITEM='1' AND A.LR_STATUS='0' AND A.VEHICLE_NO='$vehicle_no' AND B.CP_CODE='$cp_Code'");

			/* ---- GET ITEM LIST ------- */

			
    			if($cpData || $getItem || $getcpQty || $vehicleDetails || $getTrpt){

				$response_array['response']        = 'success';
				$response_array['datacpCodeList']  = $cpData;
				$response_array['dataItemList']    = $getItem;
				$response_array['datacpQty']       = $getcpQty;
				$response_array['datavehicleDets'] = $vehicleDetails;
				$response_array['dataTRPT']        = $getTrpt;
				
	            	$data = json_encode($response_array);
	            	print_r($data);

			}else{

				$response_array['response']        = 'error';
				$response_array['datacpCodeList']  = '' ;
				$response_array['dataItemList']    = '';
				$response_array['datacpQty']       = '';
				$response_array['datavehicleDets'] = '';
				$response_array['dataTRPT']        = '';
                	$data = json_encode($response_array);
                	print_r($data);
				
			}

	    	}else{

				$response_array['response']        = 'error';
				$response_array['datacpCodeList']  = '' ;
				$response_array['dataItemList']    = '';
				$response_array['datacpQty']       = '';
				$response_array['datavehicleDets'] = '';
				$response_array['dataTRPT']        = '';
                	$data = json_encode($response_array);
                	print_r($data);
	    	}

    	}

    	public function getDataInloadingSlip(Request $request){

    		$companyFull      = $request->session()->get('company_name');
		$splitComp        = explode('-', $companyFull);
		$comp_code        = $splitComp[0];
		$fisYear          = $request->session()->get('macc_year');
		$response_array   = array();
		$vehicleNo        = $request->input('vehicleNo');

		if ($request->ajax()) {

			$getbodyDetails = DB::select("SELECT * FROM CFOUTWARD_TRAN WHERE VEHICLE_NO='$vehicleNo' AND LOADING_PLAN_STATUS='0'");	

			$batchNoList = array();
			for($w=0;$w<count($getbodyDetails);$w++){

				$itemCode = $getbodyDetails[$w]->ITEM_CODE;
				$cpCode   = $getbodyDetails[$w]->CP_CODE;

				$batchNoList[] = DB::select("SELECT CFINWARDID,BATCH_NO,SLNO,ITEM_NAME,QTYRECD,UM,WAGON_NO,(QTYRECD - QTYISSUED) AS LOADBALQTY,INVOICE_NO FROM CFINWARD_TRAN WHERE CP_CODE='$cpCode' AND ITEM_CODE='$itemCode' AND LOADING_SLIP_STATUS='0' ");
			}

			if($getbodyDetails || $batchNoList){

				$response_array['response']      = 'success';
				$response_array['dataDetails']   = $getbodyDetails;
				$response_array['dataBatchList'] = $batchNoList;
	            	$data = json_encode($response_array);
	            	print_r($data);

			}else{

				$response_array['response']      = 'error';
				$response_array['dataDetails']   = '';
				$response_array['dataBatchList'] = '';
				$data = json_encode($response_array);
	               print_r($data);
			}

		}else{
			$response_array['response']      = 'error';
			$response_array['dataDetails']   = '';
			$response_array['dataBatchList'] = '';
			$data = json_encode($response_array);
               print_r($data);
		}

    	}

    	public function getInwardDataOnLoading(Request $request){

		$companyFull    = $request->session()->get('company_name');
		$splitComp      = explode('-', $companyFull);
		$comp_code      = $splitComp[0];
		$fisYear        = $request->session()->get('macc_year');
		$response_array = array();
		$batchNo        = $request->input('batchNo');
		$batchslnoNo    = $request->input('batchslnoNo');
		$itemCode       = $request->input('itemCode');
		$orderNo        = $request->input('orderNo');
		$cpCode         = $request->input('cpCode');
		$fieldType      = $request->input('fieldType');
		$vehicleNo      = $request->input('vehicle_no');
		$inwardtblHeadId= $request->input('tblHeadId');
		$getItem        = '';

		if ($request->ajax()) {

			if($cpCode){
				$getItem = DB::select("SELECT * FROM CFOUTWARD_TRAN WHERE VEHICLE_NO='$vehicleNo' AND CP_CODE='$cpCode'");
			}else{
				$getItem ='';
			}

			//print_r($getItem);

			if($cpCode && $itemCode && $fieldType == 'ITEM'){

				$getInwarddata = DB::table('CFINWARD_TRAN')->where('CP_CODE',$cpCode)->where('ITEM_CODE',$itemCode)->where('LOADING_SLIP_STATUS','0')->get();

			}else if($batchNo && $itemCode && $fieldType == 'BATCH'){

				$getInwarddata = DB::table('CFINWARD_TRAN')->where('CP_CODE',$cpCode)->where('BATCH_NO',$batchNo)->where('SLNO',$batchslnoNo)->where('ITEM_CODE',$itemCode)->where('LOADING_SLIP_STATUS','0')->get();

			}else if($batchNo && $itemCode && $orderNo && $fieldType == 'ORDERNO'){

				/*$getInwarddata = DB::select("SELECT DISTINCT(t2.TRPT_CODE) AS DO_TRPT_CODE,t2.TRPT_NAME AS DO_TRPTNAME,t1.* FROM `CFINWARD_TRAN` t1,DORDER_BODY t2 WHERE t1.ORDER_NO=t2.DORDER_NO AND t1 .CP_CODE='$cpCode' AND t1 .BATCH_NO='$batchNo' AND t1.SLNO='$batchslnoNo' AND t1.LOADING_SLIP_STATUS='0' AND t1.ITEM_CODE='$itemCode' AND t1.ORDER_NO='$orderNo'");*/

				$getInwarddata = DB::select("SELECT t1.* FROM `CFINWARD_TRAN` t1 WHERE t1.CP_CODE='$cpCode' AND t1.BATCH_NO='$batchNo' AND t1.SLNO='$batchslnoNo' AND t1.LOADING_SLIP_STATUS='0' AND t1.ITEM_CODE='$itemCode' AND t1.ORDER_NO='$orderNo' AND t1.CFINWARDID='$inwardtblHeadId'");
			}else{
				$getInwarddata ='';
			}

			if($getInwarddata || $getItem){

				$response_array['response']     = 'success';
				$response_array['dataDetails']  = $getInwarddata;
				$response_array['dataItemList'] = $getItem;
	            	$data = json_encode($response_array);
	            	print_r($data);

			}else{

				$response_array['response']     = 'error';
				$response_array['dataDetails']  = '';
				$response_array['dataItemList'] = '';
				$data = json_encode($response_array);
	               print_r($data);
			}

		}else{
			$response_array['response']     = 'error';
			$response_array['dataDetails']  = '';
			$response_array['dataItemList'] = '';
			$data = json_encode($response_array);
               print_r($data);
		}

    	}

    	public function TripPlanLoadingSlip(Request $request){
            
            $donwloadStatus = $request->input('pdfYesNoStatus');
			$createdBy    = $request->session()->get('userid');
			$CompanyCode  = $request->session()->get('company_name');
			$compcode     = explode('-', $CompanyCode);
			$getcompcode  =	$compcode[0];
			$userId         = $request->session()->get('userid');
			$fisYear      = $request->session()->get('macc_year');
			$comp_nameval = $request->input('comp_name');
			$fy_year      = $request->input('fiscal_year');
			$pfct_code    = $request->input('pfct_code');
			$trans_code   = $request->input('trans_code');
			$series_code  = $request->input('series_code');
			$series_name  = $request->input('series_name');
			$plant_name   = $request->input('plant_name');
			$pfct_name    = $request->input('pfct_name');
			$vr_no        = $request->input('vro');
			$trans_date   = $request->input('vr_date');
			$tr_vr_date   = date("Y-m-d", strtotime($trans_date));
			$plant_code   = $request->input('plant_code');
			$do_no        = $request->input('do_no');
			$do_type      = $request->input('do_type');

		    if($do_type=='With DO'){

		        $consignee_code   = $request->input('consignee'); 
		        $consignee_name   = $request->input('consineeName');
		        $consigneeadd     = $request->input('consigneeadd');
		        
		        $to_place         = $request->input('to_place');
		        $acc_code         = $request->input('AccCode');
				$acc_name         = $request->input('acctname');
		    
		    }else{

		        $consignee_code   = $request->input('consignee_wdo'); 
		        $consignee_name   = $request->input('consineeName_wdo');
		        $consigneeadd     = $request->input('consigneeadd');
		        $to_place         = $request->input('to_place_wdo');
		        $acc_code         = $request->input('AccCodeWdo');
				$acc_name         = $request->input('acctname');
			 
		    }

			$delorderDate     = $request->input('delorder_date');
			$slnodo           = $request->input('slnodo');
			$fsorder_no       = $request->input('fsorder_no');
			$sale_rate        = $request->input('sale_rate');
			$sale_qty         = $request->input('sale_qty');
			$fsohid           = $request->input('fsohid');
			$fsobid           = $request->input('fsobid');
			$vehicle_type     = $request->input('vehicle_type');
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
            $count            = count($item_code);
          

	        DB::beginTransaction();

			try {
			   
		        $StoreH = DB::select("SELECT MAX(TRIPHID) as TRIPHID  FROM TRIP_HEAD");
			    $headID = json_decode(json_encode($StoreH), true); 
		 		
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

				$vrno_Exist = DB::table('TRIP_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

				if($vrno_Exist){
					$NewVrno = $vrNum +1;
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
					"VEHICLE_TYPE"   => $vehicle_type,
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
					"PLAN_STATUS"    => 1,
					"CREATED_BY"     => $createdBy,
							
				);

				// echo '<PRE>';print_r($datahead);exit();
				
				$saveData = DB::table('TRIP_HEAD')->insert($datahead);

	    		$lastid= $headId;

	    		$hid=$lastid;
	    		
	    		// print_r($hid);exit();

	      		$discriptn_page = "Store requistion trans insert done by user";

				$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);
  		

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

					if($aqty[$i]){

						$Aqty = $aqty[$i];
					}else{

						$Aqty = 0.000;
					}

					if($slnodo[$i]){

						$slno = $slnodo[$i];
					}else{

						$slno = $i + 1;
					}

				    $data_body = array(
						
						'TRIPHID'         =>$headId,
						'TRIPBID'         =>$bodyId,
						'COMP_CODE'       =>$getcompcode,
						'FY_CODE'         =>$fisYear,
						'VRDATE'          => $tr_vr_date,
						'PFCT_CODE'       =>$pfct_code,
						'TRAN_CODE'       =>$trans_code,
						'SERIES_CODE'     =>$series_code,
						'VRNO'            =>$NewVrno,
						'SLNO'            =>$slno,
						'ACC_CODE'        =>$acc_code,
						'ACC_NAME'        =>$acc_name,
						'DO_NO'           =>$do_no[$i],
						'DO_DATE'         =>$delorder_date,
						'FSO_REF_NO'      =>$refNo,
						'ITEM_CODE'       =>$item_code[$i],
						'ITEM_NAME'       =>$item_name[$i],
						'ALIAS_ITEM_CODE' =>$alise_item_code[$i],
						'ALIAS_ITEM_NAME' =>$alise_item_name[$i],
						'REMARK'          =>$remark[$i],
						'CP_CODE'         =>$consignee_code[$i],
						'CP_NAME'         =>$consignee_name[$i],
						'SP_CODE'         =>$sp_code[$i],
						'SP_NAME'         =>$sp_name[$i],
						'FROM_PLACE'      =>$from_place,
						'TO_PLACE'        =>$to_place[$i],
						'EBILL_NO'        =>$ewaybill_no[$i],
						'EWAYB_VALIDDT'   =>$ewaybill_dt[$i],
						'QTY'             =>$qty[$i],
						'UM'              =>$unit_M[$i],
						'AQTY'            =>$Aqty,
						'AUM'             =>$unit_AUM[$i],
						'RCOMP_CODE'      =>'SA',
						'RCOMP_NAME'      =>'SWETAL ENTERPRISES',
						'AUM'             =>$unit_AUM[$i],
						'CREATED_BY'      =>$createdBy,

				    );
			
			    	$saveData1 = DB::table('TRIP_BODY')->insert($data_body);

			    	$bid= DB::getPdo()->lastInsertId();



				    $getDoDetials =	DB::table('DORDER_BODY')->where('ITEM_CODE',$item_code[$i])->where('DORDER_NO',$do_no[$i])->get()->first();
						
					if($getDoDetials){

					    $dispacth_plan_qty = $getDoDetials->DISPATCH_PLAN_QTY;

						$dataupdate = array(

								'DISPATCH_PLAN_QTY'  => floatval($dispacth_plan_qty) + floatval($qty[$i]),
							
						);


						$saveData11 = DB::table('DORDER_BODY')->where('ITEM_CODE',$item_code[$i])->where('DORDER_NO',$do_no[$i])->update($dataupdate);

					}
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
				
				DB::commit();

			    $response_array['response'] = 'success';

                if($donwloadStatus == 1){

					return $this->GeneratePdfForLoadingSlip($getcompcode,$fisYear,$plant_code,$NewVrno,$userId,$hid);

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

/* --------- AJAX CODE -------------*/


/* ------------- PDF GENERATE ------------ */

	public function GeneratePdfForCandF($titleName,$getcom_code,$fyCode,$plant_code,$vrNo,$loginUser){

		$response_array = array();

		$dataheadB = DB::SELECT("SELECT A.*,B.USER_NAME FROM CFOUTWARD_TRAN A,MASTER_USER B WHERE A.CREATED_BY=B.USER_CODE AND A.COMP_CODE='$getcom_code' AND A.FY_CODE='$fyCode' AND A.VRNO='$vrNo' AND A.CREATED_BY='$loginUser'");
		
		$compDetail = DB::SELECT("SELECT A.*,B.COMP_NAME,B.COMP_CODE FROM `MASTER_PLANT` A,MASTER_COMP B WHERE A.COMP_CODE=B.COMP_CODE AND B.COMP_CODE='$getcom_code' AND A.PLANT_CODE='$plant_code'");

		header('Content-Type: application/pdf');

		$pdf = PDF::loadView('admin.finance.transaction.candf.loadingSlipPDF',compact('compDetail','dataheadB','titleName'));
		
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

	public function GeneratePdfForLoadingSlip($comp_code,$fisYear,$plant_code,$NewVrno,$userId,$hid){

		$titleName = 'LOADING SLIP';


		$response_array = array();

		$dataheadB = DB::SELECT("SELECT H.VEHICLE_NO AS VEHICLE_NO,H.FY_CODE AS FY_CODE,H.TO_PLACE AS TO_PLACE,H.SERIES_CODE AS SERIES_CODE,H.VRNO AS VRNO,B.DO_NO AS DO_NO,B.WAGON_NO AS WAGON_NO,B.BATCH_NO AS BATCH_NO,B.ITEM_NAME AS ITEM_NAME,B.REMARK AS ITEM_REMARK,B.QTY AS QTY,B.UM AS UM,B.AQTY AS AQTY,B.AUM AS AUM,B.CP_NAME,B.CP_CODE AS CP_CODE,B.RCOMP_NAME AS RCOMP_NAME,B.VRDATE AS VRDATE,B.RAKE_NO AS RAKE_NO FROM TRIP_HEAD H,TRIP_BODY B WHERE H.TRIPHID= B.TRIPHID AND H.COMP_CODE='$comp_code' AND H.CREATED_BY='$userId' AND H.TRIPHID='$hid' ");

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

/* ------------- PDF GENERATE ------------ */



/*job work sale bill*/

 public function jobWorkSaleBill(Request $request){

        $title = "Transporter Bill Posting";

        $company_name = $request->session()->get('company_name');
        $getcomcode   = explode('-', $company_name);
        $comp_code    = $getcomcode[0];
        $macc_year    = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid       = $request->session()->get('userid');
        //DB::enableQueryLog();
       	/*$accList = DB::table('CFOUTWARD_TRAN')->WHERE('TRANSPORT_TYPE','BY_ROAD')->WHERE('SBILL_STATUS','0')->groupBy('ACC_CODE')->get();*/
       	$accList = DB::table('CFOUTWARD_TRAN')->WHERE('SBILL_STATUS','0')->groupBy('ACC_CODE')->get();
       ///	dd(DB::getQueryLog());
       	$userdata['acc_list_data'] = json_decode(json_encode($accList), true); 
       	//echo "<RE>";print_r($userdata['accList']);exit;
		//$userdata['acc_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userdata['vehicle_list'] = DB::table('TRIP_HEAD')->WHERE('LR_ACK_STATUS','1')->WHERE('BILL_STATUS','0')->WHERE('OWNER','SELF')->get();
		$userdata['tran_list'] = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','S5')->get()->first();

		$series_data = DB::table('MASTER_CONFIG')->WHERE('TRAN_CODE','S5')->WHERE('COMP_CODE',$comp_code)->get();

    if($series_data){

      $userdata['series_list'] = $series_data;

    }else{

      $userdata['series_list']='';
    }

		$userdata['taxList'] = DB::table('MASTER_TAX')->get();

		$userdata['ratval_list'] = DB::table('MASTER_RATE_VALUE')->get();
 

        if(isset($company_name)){

            return view('admin.finance.transaction.candf.job_work_sale_bill',$userdata);
        }else{

            return redirect('/useractivity');

        }

    }


    public function jobWorkSaleBillData(Request $request){

        if($request->ajax()) {

             if (!empty($request->acct_code || $request->sale_order_no || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
               // $sale_order_no   = $request->sale_order_no;
             
                if(isset($request->sale_order_no)  && trim($request->sale_order_no)!=""){
                    
                    $strWhere .= "AND  H.VRNO = '$request->sale_order_no'";
                }

               if(isset($request->acct_code)  && trim($request->acct_code)!=""){
	                   $strWhere .= "AND  T.ACC_CODE = '$request->acct_code'";
	             }
                
                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  H.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

              
               //DB::enableQueryLog();


                 /*   $data = DB::select("SELECT TRIP_HEAD.TRIPHID AS tripHeadId,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1 $strWhere AND TRIP_HEAD.OWNER='SELF' AND TRIP_HEAD.LR_ACK_STATUS ='1' AND TRIP_HEAD.BILL_STATUS ='0' GROUP BY TRIP_BODY.TRIPHID");*/

                    $data = DB::select("SELECT T.ACC_CODE,T.ACC_NAME,T.JWITEM_CODE,T.JWITEM_NAME,T.CFOUTWARDID,SUM(T.QTY) AS DISPATCH_QTY,B.RATE,SUM(T.QTY)*B.RATE AS AMOUNT, H.SORDERHID,H.PFCT_CODE,H.PFCT_NAME,H.PLANT_CODE,H.PLANT_NAME,H.SERIES_CODE,H.SERIES_NAME,B.DRAMT FROM CFOUTWARD_TRAN T,SORDER_HEAD H, SORDER_BODY B WHERE 1=1 $strWhere AND B.SORDERHID=H.SORDERHID AND H.ACC_CODE=T.ACC_CODE AND B.ITEM_CODE=T.JWITEM_CODE AND T.SBILL_STATUS='0' GROUP BY T.JWITEM_CODE");
                

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


  function SavejobWorkSaleBillData(Request $request){

  	/*echo '<pre>';
  	print_r($request->post());exit;
  	echo '</pre>';*/

		$CompanyCode  = $request->session()->get('company_name');
		$compcode_get = explode('-', $CompanyCode);
		$compcode     = $compcode_get[0];
		$fyCode       = $request->session()->get('macc_year');
		$createdBy       = $request->session()->get('userid');

		//single
		$vrDate          = $request->input('vrDate');
		$tr_vr_date      = date("Y-m-d", strtotime($vrDate));
		$acctCode        = $request->input('acctCode');
		$acctName        = $request->input('acctName');
		$acc_glCode      = $request->input('PostCode');
		$acc_glName      = $request->input('PostName');
		$seriesCode      = $request->input('seriesCode');
		$seriesName      = $request->input('seriesName');
		$transCode       = $request->input('transCode');
		$taxCode         = $request->input('taxCode');
		$basicValue      = $request->input('basicValue');
		$NetAmnt         = $request->input('NetAmnt');
		$cfoutid         = $request->input('cfoutid');
		$drAmt           = $request->input('drAmt');

		//multi
		$pfct_code        = $request->input('pfct_code');
		$pfct_name        = $request->input('pfct_name');
		$plant_code       = $request->input('plant_code');
		$plant_name       = $request->input('plant_name');
		$jwitem_code      = $request->input('jwitem_code');
		$jwitem_name      = $request->input('jwitem_name');
		$dispatch_qty     = $request->input('dispatch_qty');
		$rate             = $request->input('rate');
		$basicHAmt         = $request->input('freightAmt');
		$rate             = $request->input('rate');
		$flit_id          = $request->input('flit_id');
		//tax data 
		$head_tax_ind    = $request->input('head_tax_ind');
		$tax_ind_code      = $request->input('taxIndCode');
		$rate_ind        = $request->input('rate_ind');
		$af_rate         = $request->input('af_rate');
		$amount          = $request->input('amount');
		$logicget        = $request->input('logicget');
		$staticget       = $request->input('staticget');
		$tax_gl_code     = $request->input('taxGlCode');
		$series_gl       = $request->input('series_gl');
		
		$datacount = count($flit_id);
		$head_tax_count = count($head_tax_ind);

		//print_r($head_tax_count);exit;

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
								'TRAN_TYPE'    	=> 'JWSB',
								'TAX_CODE'    	=> $taxCode,
								'FLAG'    		=> '1',
								'CREATED_BY' 	=> $createdBy

							);

							DB::table('SBILL_HEAD')->insert($HEADDATA);

							DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','JBSB')->delete();

					for ($i = 0; $i < $datacount; $i++) {

						    $GETMAXIDBD = DB::select("SELECT MAX(SBILLBID) AS SBBID FROM SBILL_BODY");

			     			$DATAGETMAXIDBD = json_decode(json_encode($GETMAXIDBD),true);

			     			$MDATAGETMAXIDBD = count($DATAGETMAXIDBD);

			     			if ($MDATAGETMAXIDBD > 0) {
			     				
			     				$GETBID = $DATAGETMAXIDBD[0]['SBBID'] + 1;

			     			}else{

			     				$GETBID = 1;

			     			}
			     			$srno = $i + 1;

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
								'ITEM_CODE'     => $jwitem_code[$i],
								'ITEM_NAME'     => $jwitem_name[$i],
								'HSN_CODE'      => '',
								'QTYISSUED'    	=> $dispatch_qty[$i],
								'UM'    		=> '',
								'AQTYISSUED'    => '',
								'AUM'    		=> '',
								'RATE'    		=> $rate[$i],
								'BASICAMT'    	=> $basicHAmt[$i],
								'TAX_CODE'    	=> $taxCode,
								'DRAMT'    		=> $drAmt[$i],
								'FLAG'    		=> '1',
								'CREATED_BY' 	=> $createdBy

							);

							DB::table('SBILL_BODY')->insert($MBODYDATA);


							$OUTWARDBILLUPDATE =array(

								'SBILLHID' =>$GETID,
								'SBILL_STATUS' =>'1',
							);

							DB::table('CFOUTWARD_TRAN')->where('CFOUTWARDID',$cfoutid[$i])->update($OUTWARDBILLUPDATE);

					}


					
					for ($j = 0; $j < $head_tax_count; $j++) {
						
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


						$indData = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','JBSB')->get()->toArray();

					    $checkExist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','JBSB')->get()->toArray();


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
									'TCFLAG'      => 'JBSB',
								);
								DB::table('INDICATOR_TEMP')->insert($idary);
							}else  if($tax_gl_code[$j] == ''){

								$bscVal = DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$createdBy)->where('TCFLAG','JBSB')->get()->toArray();
								$updateId = $bscVal[0]->CREATED_BY;
								$basicAmt = $bscVal[0]->CR_AMT + $amount[$j];
							
								$idary_bsic = array(
									'CR_AMT' 	  => $basicAmt,
								);

								DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$updateId)->where('TCFLAG','JBSB')->update($idary_bsic);

							}else if(empty($indData)){

									$idary   = array(
										'IND_CODE'    => $tax_ind_code[$j],
										'CR_AMT'      => $amount[$j],
										'IND_GL_CODE' => $tax_gl_code[$j],
										//'IND_GL_NAME' => $gl_name,
										'REF_ACCCODE' => $acctCode,
										'REF_ACCNAME' => $acctName,
										'CREATED_BY'  => $createdBy,
										'TCFLAG'      => 'JBSB',
										
									);
									DB::table('INDICATOR_TEMP')->insert($idary);
								}else{

									$indData1 = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','JBSB')->get()->first();

									$newTaxAmt = $indData1->CR_AMT + $amount[$j];

									$idary1 = array(
										'CR_AMT' 	  => $newTaxAmt,
									);

									$updatevr = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','JBSB')->update($idary1);

								}
						} /* check 
						*/

					} /* chek amount is blank*/
					
			} //FOR LOOP END

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
						'TCFLAG'       => 'JBSB',
						'CREATED_BY'   => $createdBy,
			);
			DB::table('INDICATOR_TEMP')->insert($accData);



			$ledgCount = DB::table('INDICATOR_TEMP')
					->select('INDICATOR_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')
	           		->leftjoin('MASTER_GL', 'INDICATOR_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
	            	->where('INDICATOR_TEMP.TCFLAG','JBSB')
	            	->where('INDICATOR_TEMP.CREATED_BY',$createdBy)
	            	->get()->toArray();
					//sale bill head
	            $slno=1;

			foreach ($ledgCount as $rows) {

				$perticulerText='';
				$blankVal='';

				$resultgl = (new AccountingController)->GlTEntry($compcode,$fyCode,$transCode,$seriesCode,$newVr,$slno,$tr_vr_date,$pfct_code[0],$rows->IND_GL_CODE,$rows->GL_NAME,$rows->REF_ACCCODE,$rows->REF_ACCNAME,$blankVal,$blankVal,$blankVal,$blankVal,$rows->DR_AMT,$rows->CR_AMT,$perticulerText,$createdBy);


           	    if($rows->GLACC_Chk == 'ACC'){

           	 	   $result = (new AccountingController)->AccountTEntry($compcode,$fyCode,$transCode,$seriesCode,$newVr,$slno,$tr_vr_date,$pfct_code[0],$rows->IND_ACC_CODE,$rows->IND_ACC_NAME,$acc_glCode,$acc_glName,$blankVal,$blankVal,$blankVal,$blankVal,$rows->DR_AMT,$rows->CR_AMT,$perticulerText,$createdBy);
           	 	}

           	 $slno++;
			}


				DB::commit();

				$response_array['response'] = 'success';
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
   
/*job work sale bill*/

/*job work purchase bill*/

 public function jobWorkPurchaseBill(Request $request){

        $title = "Transporter Bill Posting";

        $company_name = $request->session()->get('company_name');
        $getcomcode   = explode('-', $company_name);
        $comp_code    = $getcomcode[0];
        $macc_year    = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid       = $request->session()->get('userid');
        //DB::enableQueryLog();
       	$accList = DB::table('CFOUTWARD_TRAN')->WHERE('TRANSPORT_TYPE','BY_ROAD')->WHERE('PBILL_STATUS','0')->groupBy('LCONT_CODE')->get();
       ///	dd(DB::getQueryLog());
       	$userdata['acc_list_data'] = json_decode(json_encode($accList), true); 
       	//echo "<RE>";print_r($userdata['accList']);exit;
		//$userdata['acc_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userdata['vehicle_list'] = DB::table('TRIP_HEAD')->WHERE('LR_ACK_STATUS','1')->WHERE('BILL_STATUS','0')->WHERE('OWNER','SELF')->get();
		$userdata['tran_list'] = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','P5')->get()->first();

		$series_data = DB::table('MASTER_CONFIG')->WHERE('TRAN_CODE','P5')->WHERE('COMP_CODE',$comp_code)->get();

    if($series_data){

      $userdata['series_list'] = $series_data;

    }else{

      $userdata['series_list']='';
    }

		$userdata['taxList'] = DB::table('MASTER_TAX')->get();

		$userdata['ratval_list'] = DB::table('MASTER_RATE_VALUE')->get();
 

        if(isset($company_name)){

            return view('admin.finance.transaction.candf.job_work_purchase_bill',$userdata);
        }else{

            return redirect('/useractivity');

        }

    }


    public function jobWorkPurchaseBillData(Request $request){

        if($request->ajax()) {

             if (!empty($request->acct_code || $request->sale_order_no || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
               // $sale_order_no   = $request->sale_order_no;
             
                if(isset($request->sale_order_no)  && trim($request->sale_order_no)!=""){
                    
                    $strWhere .= "AND  H.VRNO = '$request->sale_order_no'";
                }

               if(isset($request->acct_code)  && trim($request->acct_code)!=""){
	                   $strWhere .= "AND  T.ACC_CODE = '$request->acct_code'";
	             }
                
                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  H.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

              
              // DB::enableQueryLog();


                 /*   $data = DB::select("SELECT TRIP_HEAD.TRIPHID AS tripHeadId,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1 $strWhere AND TRIP_HEAD.OWNER='SELF' AND TRIP_HEAD.LR_ACK_STATUS ='1' AND TRIP_HEAD.BILL_STATUS ='0' GROUP BY TRIP_BODY.TRIPHID");*/

                    $data = DB::select("SELECT T.ACC_CODE,T.ACC_NAME,T.JWITEM_CODE,T.JWITEM_NAME,SUM(T.QTY) AS DISPATCH_QTY,B.RATE,SUM(T.QTY)*B.RATE AS AMOUNT, H.PORDERHID,H.PFCT_CODE,H.PFCT_NAME,H.PLANT_CODE,H.PLANT_NAME,H.SERIES_CODE,H.SERIES_NAME,T.CFOUTWARDID,B.CRAMT FROM CFOUTWARD_TRAN T,PORDER_HEAD H, PORDER_BODY B WHERE 1=1 $strWhere AND B.PORDERHID=H.PORDERHID AND H.ACC_CODE=T.ACC_CODE AND B.ITEM_CODE=T.JWITEM_CODE AND T.PBILL_STATUS='0' GROUP BY T.JWITEM_CODE");
                

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



  function SavejobWorkPurcahseBillData(Request $request){

  /*	echo '<pre>';
  	print_r($request->post());exit;
  	echo '</pre>';*/

		$CompanyCode  = $request->session()->get('company_name');
		$compcode_get = explode('-', $CompanyCode);
		$compcode     = $compcode_get[0];
		$fyCode       = $request->session()->get('macc_year');
		$createdBy       = $request->session()->get('userid');

		//single
		$vrDate          = $request->input('vrDate');
		$tr_vr_date      = date("Y-m-d", strtotime($vrDate));
		$acctCode        = $request->input('acctCode');
		$acctName        = $request->input('acctName');
		$acc_glCode      = $request->input('PostCode');
		$acc_glName      = $request->input('PostName');
		$seriesCode      = $request->input('seriesCode');
		$seriesName      = $request->input('seriesName');
		$transCode       = $request->input('transCode');
		$taxCode         = $request->input('taxCode');
		$basicValue      = $request->input('basicValue');
		$NetAmnt         = $request->input('NetAmnt');
		$cfoutid         = $request->input('cfoutid');
		$crAmt           = $request->input('crAmt');
		//multi
		$pfct_code        = $request->input('pfct_code');
		$pfct_name        = $request->input('pfct_name');
		$plant_code       = $request->input('plant_code');
		$plant_name       = $request->input('plant_name');
		$jwitem_code      = $request->input('jwitem_code');
		$jwitem_name      = $request->input('jwitem_name');
		$dispatch_qty     = $request->input('dispatch_qty');
		$rate             = $request->input('rate');
		$basicHAmt         = $request->input('freightAmt');
		$flit_id          = $request->input('flit_id');
		//tax data 
		$head_tax_ind    = $request->input('head_tax_ind');
		$tax_ind_code      = $request->input('taxIndCode');
		$rate_ind        = $request->input('rate_ind');
		$af_rate         = $request->input('af_rate');
		$amount          = $request->input('amount');
		$logicget        = $request->input('logicget');
		$staticget       = $request->input('staticget');
		$tax_gl_code     = $request->input('taxGlCode');
		$series_gl       = $request->input('series_gl');
		
		$datacount = count($flit_id);
		$head_tax_count = count($head_tax_ind);

		//print_r($head_tax_count);exit;

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


					        $GETMAXID = DB::select("SELECT MAX(PBILLHID) AS PBHID FROM PBILL_HEAD");

			     			$DATAGETMAXID = json_decode(json_encode($GETMAXID),true);

			     			$MDATAGETMAXID = count($DATAGETMAXID);

			     			if ($MDATAGETMAXID > 0) {
			     				
			     				$GETID = $DATAGETMAXID[0]['PBHID'] + 1;

			     			}else{

			     				$GETID = 1;

			     			}

			     			$slNo = 1;

				            $HEADDATA = array(

								'PBILLHID'		=> $GETID,
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
								'TAX_CODE'    	=> $taxCode,
								'CRAMT'    	    => $NetAmnt,
								'FLAG'    		=> '1',
								'CREATED_BY' 	=> $createdBy

							);

							DB::table('PBILL_HEAD')->insert($HEADDATA);

							DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','JBPB')->delete();

					for ($i = 0; $i < $datacount; $i++) {

						    $GETMAXIDBD = DB::select("SELECT MAX(PBILLHID) AS PBBID FROM PBILL_BODY");

			     			$DATAGETMAXIDBD = json_decode(json_encode($GETMAXIDBD),true);

			     			$MDATAGETMAXIDBD = count($DATAGETMAXIDBD);

			     			if ($MDATAGETMAXIDBD > 0) {
			     				
			     				$GETBID = $DATAGETMAXIDBD[0]['PBBID'] + 1;

			     			}else{

			     				$GETBID = 1;

			     			}
			     			$srno = $i + 1;

						$MBODYDATA = array(
								'PBILLHID'		=> $GETID,
								'PBILLBID'		=> $GETBID,
								'COMP_CODE'		=> $compcode,
								'FY_CODE'     	=> $fyCode,
								'PFCT_CODE'   	=> $pfct_code[$i],
								'TRAN_CODE'    	=> $transCode,
								'SERIES_CODE'   => $seriesCode,
								'VRNO'    		=> $newVr,
								'SLNO'    		=> $srno,
								'VRDATE'    	=> $tr_vr_date,
								'PLANT_CODE'    => $plant_code[$i],
								'ITEM_CODE'     => $jwitem_code[$i],
								'ITEM_NAME'     => $jwitem_name[$i],
								'HSN_CODE'      => '',
								'QTYRECD'    	=> $dispatch_qty[$i],
								'UM'    		=> '',
								'AQTYRECD'      => '',
								'AUM'    		=> '',
								'RATE'    		=> $rate[$i],
								'BASICAMT'    	=> $basicHAmt[$i],
								'TAX_CODE'    	=> $taxCode,
								'CRAMT'    		=> $crAmt[$i],
								'FLAG'    		=> '1',
								'CREATED_BY' 	=> $createdBy

							);

							DB::table('PBILL_BODY')->insert($MBODYDATA);


							$OUTWARDBILLUPDATE =array(

								'PBILLHID' =>$GETID,
								'PBILL_STATUS' =>'1',
							);

							DB::table('CFOUTWARD_TRAN')->where('CFOUTWARDID',$cfoutid[$i])->update($OUTWARDBILLUPDATE);

					}


					
					for ($j = 0; $j < $head_tax_count; $j++) {
						
						$FLAG = 1;

						$GETMAXIDTD = DB::select("SELECT MAX(PBILLTID) AS PBTID FROM PBILL_TAX");

		     			$DATAGETMAXIDTD = json_decode(json_encode($GETMAXIDTD),true);

		     			$MDATAGETMAXIDTD = count($DATAGETMAXIDTD);

		     			if($MDATAGETMAXIDTD > 0) {
		     				
		     				$GETTID = $DATAGETMAXIDTD[0]['PBTID'] + 1;

		     			}else{

		     				$GETTID = 1;
		     			}

		     			$srNo =$j+1;
		
						$MDATA = array(

							'PBILLHID'   	=> $GETID,
							'PBILLBID'   	=> '',
							'PBILLTID'   	=> $GETTID,
							'TAXIND_CODE'   => $tax_ind_code[$j],
							'TAXIND_NAME'   => $head_tax_ind[$j],
							'RATE_INDEX'   	=> $rate_ind[$j],
							'TAX_RATE'    	=> $af_rate[$j],
							'TAX_AMT'    	=> $amount[$j],
							'TAX_LOGIC'    	=> $logicget[$j],
							'TAXGL_CODE'    => $tax_gl_code[$j],
							'STATIC_IND'    => $staticget[$j],
							'FLAG'    		=> $FLAG,
							'CREATED_BY' 	=> $createdBy

						);

						DB::table('PBILL_TAX')->insert($MDATA);


						$indData = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','JBPB')->get()->toArray();

					    $checkExist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','JBPB')->get()->toArray();


					    if($amount[$j] != 0.00){

						if($rate_ind[$j] == 'Z'){}else{

							if(empty($checkExist)){

								$idary = array(
									'IND_CODE'    => $tax_ind_code[$j],
									'DR_AMT'      => $amount[$j],
									'IND_GL_CODE' => $series_gl,
									'REF_ACCCODE' => $acctCode,
									'REF_ACCNAME' => $acctName,
									'CREATED_BY'  => $createdBy,
									'TCFLAG'      => 'JBPB',
								);
								DB::table('INDICATOR_TEMP')->insert($idary);
							}else  if($tax_gl_code[$j] == ''){

								$bscVal = DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$createdBy)->where('TCFLAG','JBPB')->get()->toArray();
								$updateId = $bscVal[0]->CREATED_BY;
								$basicAmt = $bscVal[0]->DR_AMT + $amount[$j];
							
								$idary_bsic = array(
									'DR_AMT' 	  => $basicAmt,
								);

								DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$updateId)->where('TCFLAG','JBPB')->update($idary_bsic);

							}else if(empty($indData)){

									$idary   = array(
										'IND_CODE'    => $tax_ind_code[$j],
										'DR_AMT'      => $amount[$j],
										'IND_GL_CODE' => $tax_gl_code[$j],
										//'IND_GL_NAME' => $gl_name,
										'REF_ACCCODE' => $acctCode,
										'REF_ACCNAME' => $acctName,
										'CREATED_BY'  => $createdBy,
										'TCFLAG'      => 'JBPB',
										
									);
									DB::table('INDICATOR_TEMP')->insert($idary);
								}else{

									$indData1 = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','JBPB')->get()->first();

									$newTaxAmt = $indData1->DR_AMT + $amount[$j];

									$idary1 = array(
										'DR_AMT' 	  => $newTaxAmt,
									);

									$updatevr = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','JBPB')->update($idary1);

								}
						} /* check 
						*/

					} /* chek amount is blank*/
					
			} //FOR LOOP END

			$accData =  array(
						'IND_CODE'     => '',
						'CR_AMT'       => $NetAmnt,
						'IND_GL_CODE'  => $acc_glCode,
						'IND_GL_NAME'  => $acc_glName,
						'IND_ACC_CODE' => $acctCode,
						'IND_ACC_NAME' => $acctName,
						'REF_ACCCODE'  => $acctCode,
						'REF_ACCNAME'  => $acctName,
						'GLACC_Chk'    => 'ACC',
						'TCFLAG'       => 'JBPB',
						'CREATED_BY'   => $createdBy,
			);
			DB::table('INDICATOR_TEMP')->insert($accData);



			$ledgCount = DB::table('INDICATOR_TEMP')
					->select('INDICATOR_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')
	           		->leftjoin('MASTER_GL', 'INDICATOR_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
	            	->where('INDICATOR_TEMP.TCFLAG','JBPB')
	            	->where('INDICATOR_TEMP.CREATED_BY',$createdBy)
	            	->get()->toArray();
					//sale bill head
	            $slno=1;

			foreach ($ledgCount as $rows) {

				$perticulerText='';
				$blankVal='';

				$resultgl = (new AccountingController)->GlTEntry($compcode,$fyCode,$transCode,$seriesCode,$newVr,$slno,$tr_vr_date,$pfct_code[0],$rows->IND_GL_CODE,$rows->GL_NAME,$rows->REF_ACCCODE,$rows->REF_ACCNAME,$blankVal,$blankVal,$blankVal,$blankVal,$rows->DR_AMT,$rows->CR_AMT,$perticulerText,$createdBy);


           	    if($rows->GLACC_Chk == 'ACC'){

           	 	   $result = (new AccountingController)->AccountTEntry($compcode,$fyCode,$transCode,$seriesCode,$newVr,$slno,$tr_vr_date,$pfct_code[0],$rows->IND_ACC_CODE,$rows->IND_ACC_NAME,$acc_glCode,$acc_glName,$blankVal,$blankVal,$blankVal,$blankVal,$rows->DR_AMT,$rows->CR_AMT,$perticulerText,$createdBy);
           	 	}

           	 $slno++;
			}


				DB::commit();

				$response_array['response'] = 'success';
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


   public function ViewJobWorkSaleBill(Request $request){

		$compName = $request->session()->get('company_name');
    
        if($request->ajax()) {
    
            $title ='View Sales';
    
            $userid    = $request->session()->get('userid');
    
            $userType = $request->session()->get('usertype');
    
            $compName = $request->session()->get('company_name');

            $compcode    = explode('-', $compName);

			$getcompcode =	$compcode[0];

    
            $fisYear =  $request->session()->get('macc_year');
    
            
            $data = DB::table('CFOUTWARD_TRAN')->where('COMP_CODE',$getcompcode)->where('SBILL_STATUS','1')->where('SBILLHID','!=','0')->orderBy('SBILLHID','DESC')->groupBy('VRNO');
     
        	return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();
    
    
        }

        if(isset($compName)){
       		return view('admin.finance.transaction.candf.view_job_work_sale_bill');
        }else{
			return redirect('/useractivity');
		}
        
    }


    public function JobWorkSaleBilChieldRTowData(Request $request){

		$response_array = array();

	    $tblid = $request->input('tblid');

	   /// print_r($gl_code_help);exit();

		if ($request->ajax()) {

	    	$sale_trans = DB::table("SBILL_BODY")->where('SBILLHID',$tblid)->get();

	    	//print_r($Seach_depot_Code_by_help);exit;
	    	
    		if ($sale_trans) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $sale_trans ;

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
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }




   public function ViewJobWorkPurchaseBill(Request $request){

		$compName = $request->session()->get('company_name');
    
        if($request->ajax()) {
    
            $title ='View Purchase';
    
            $userid    = $request->session()->get('userid');
    
            $userType = $request->session()->get('usertype');
    
            $compName = $request->session()->get('company_name');

            $compcode    = explode('-', $compName);

			$getcompcode =	$compcode[0];

    
            $fisYear =  $request->session()->get('macc_year');
    
            
            $data = DB::table('CFOUTWARD_TRAN')->where('COMP_CODE',$getcompcode)->where('PBILL_STATUS','1')->where('PBILLHID','!=','0')->orderBy('PBILLHID','DESC')->groupBy('VRNO');
     
        	return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();
    
    
        }

        if(isset($compName)){
       		return view('admin.finance.transaction.candf.view_job_work_purchase_bill');
        }else{
			return redirect('/useractivity');
		}
        
    }


     public function JobWorkPurBillChieldRTowData(Request $request){

		$response_array = array();

	    $tblid = $request->input('tblid');

	   /// print_r($gl_code_help);exit();

		if ($request->ajax()) {

	    	$sale_trans = DB::table("PBILL_BODY")->where('PBILLHID',$tblid)->get();

	    	//print_r($Seach_depot_Code_by_help);exit;
	    	
    		if ($sale_trans) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $sale_trans ;

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
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

  function simulationForJobWorkSaleBill(Request $request){

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

				   DB::table('SIMULATION_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','JBSB')->delete();

				
					for ($j = 0; $j < $head_tax_count; $j++) {
						
						$indData = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','JBSB')->get()->toArray();

					    $checkExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','JBSB')->get()->toArray();


					    if($amount[$j] != 0.00){

						if($rate_ind[$j] == 'Z'){}else{

							if(empty($checkExist)){

								$idary = array(
									'IND_CODE'    => $tax_ind_code[$j],
									'CR_AMT'      => $amount[$j],
									'DR_AMT'      => 0.00,
									'IND_GL_CODE' => $series_gl,
									'CREATED_BY'  => $createdBy,
									'TCFLAG'      => 'JBSB',
								);
								DB::table('SIMULATION_TEMP')->insert($idary);
							}else  if($tax_gl_code[$j] == ''){

								$bscVal = DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$createdBy)->where('TCFLAG','JBSB')->get()->toArray();
								$updateId = $bscVal[0]->CREATED_BY;
								$basicAmt = $bscVal[0]->CR_AMT + $amount[$j];
							
								$idary_bsic = array(
									'CR_AMT' 	  => $basicAmt,
									'DR_AMT'      => 0.00,
								);

								DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$updateId)->where('TCFLAG','JBSB')->update($idary_bsic);

							}else if(empty($indData)){

									$idary   = array(
										'IND_CODE'    => $tax_ind_code[$j],
										'CR_AMT'      => $amount[$j],
										'DR_AMT'      => 0.00,
										'IND_GL_CODE' => $tax_gl_code[$j],
										//'IND_GL_NAME' => $gl_name,
										'CREATED_BY'  => $createdBy,
										'TCFLAG'      => 'JBSB',
										
									);
									DB::table('SIMULATION_TEMP')->insert($idary);
								}else{

									$indData1 = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','JBSB')->get()->first();

									$newTaxAmt = $indData1->CR_AMT + $amount[$j];

									$idary1 = array(
										'CR_AMT' 	  => $newTaxAmt,
										'DR_AMT'      => 0.00,
									);

									$updatevr = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','JBSB')->update($idary1);

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
						'TCFLAG'       => 'JBSB',
						'CREATED_BY'   => $createdBy,
			);
			DB::table('SIMULATION_TEMP')->insert($accData);


			$taxData = DB::table('SIMULATION_TEMP')
					->select('SIMULATION_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME','MASTER_ACC.ACC_NAME')
	           		->leftjoin('MASTER_GL', 'SIMULATION_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
	           		->leftjoin('MASTER_ACC', 'SIMULATION_TEMP.IND_ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
	            	->where('SIMULATION_TEMP.TCFLAG','JBSB')
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
   

    function simulationForJobWorkPurchaseBill(Request $request){

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

				   DB::table('SIMULATION_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','JBPB')->delete();

				
					for ($j = 0; $j < $head_tax_count; $j++) {
						
						$indData = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','JBPB')->get()->toArray();

					    $checkExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','JBPB')->get()->toArray();


					    if($amount[$j] != 0.00){

						if($rate_ind[$j] == 'Z'){}else{

							if(empty($checkExist)){

								$idary = array(
									'IND_CODE'    => $tax_ind_code[$j],
									'DR_AMT'      => $amount[$j],
									'CR_AMT'      => 0.00,
									'IND_GL_CODE' => $series_gl,
									'CREATED_BY'  => $createdBy,
									'TCFLAG'      => 'JBPB',
								);
								DB::table('SIMULATION_TEMP')->insert($idary);
							}else  if($tax_gl_code[$j] == ''){

								$bscVal = DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$createdBy)->where('TCFLAG','JBPB')->get()->toArray();
								$updateId = $bscVal[0]->CREATED_BY;
								$basicAmt = $bscVal[0]->DR_AMT + $amount[$j];
							
								$idary_bsic = array(
									'DR_AMT' 	  => $basicAmt,
									'CR_AMT'      => 0.00,
								);

								DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$updateId)->where('TCFLAG','JBPB')->update($idary_bsic);

							}else if(empty($indData)){

									$idary   = array(
										'IND_CODE'    => $tax_ind_code[$j],
										'DR_AMT'      => $amount[$j],
										'CR_AMT'      => 0.00,
										'IND_GL_CODE' => $tax_gl_code[$j],
										//'IND_GL_NAME' => $gl_name,
										'CREATED_BY'  => $createdBy,
										'TCFLAG'      => 'JBPB',
										
									);
									DB::table('SIMULATION_TEMP')->insert($idary);
								}else{

									$indData1 = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','JBPB')->get()->first();

									$newTaxAmt = $indData1->CR_AMT + $amount[$j];

									$idary1 = array(
										'DR_AMT' 	  => $newTaxAmt,
										'CR_AMT'      => 0.00,
									);

									$updatevr = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','JBPB')->update($idary1);

								}
						} /* check 
						*/

					} /* chek amount is blank*/
					
			} // for loop end 


			$accData =  array(
						'IND_CODE'     => '',
						'CR_AMT'       => $NetAmnt,
						'DR_AMT'       => 0.00,
						'IND_GL_CODE'  => $acc_glCode,
						'IND_ACC_CODE' => $acctCode,
						//'GLACC_Chk'    => 'ACC',
						'TCFLAG'       => 'JBPB',
						'CREATED_BY'   => $createdBy,
			);
			DB::table('SIMULATION_TEMP')->insert($accData);


			$taxData = DB::table('SIMULATION_TEMP')
					->select('SIMULATION_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME','MASTER_ACC.ACC_NAME')
	           		->leftjoin('MASTER_GL', 'SIMULATION_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
	           		->leftjoin('MASTER_ACC', 'SIMULATION_TEMP.IND_ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
	            	->where('SIMULATION_TEMP.TCFLAG','JBPB')
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



    public function job_work_sale_bill_msg(Request $request,$saveData){

		if ($saveData == 'false') {
			
			$request->session()->flash('alert-error', 'Job Work Sale Bill Can Not Added...!');
			return redirect('/transaction/CandF/view-job-work-sale-bill');

		}else{

			$request->session()->flash('alert-success', 'Job Work Sale Bill Was Successfully Added...!');
			return redirect('/transaction/CandF/view-job-work-sale-bill');

		}
	}


	public function job_work_purchase_bill_msg(Request $request,$saveData){

		if ($saveData == 'false') {
			
			$request->session()->flash('alert-error', 'Job Work Purchase Bill Can Not Added...!');
			return redirect('/transaction/CandF/view-job-work-purchase-bill');

		}else{

			$request->session()->flash('alert-success', 'Job Work Purchase Bill Was Successfully Added...!');
			return redirect('/transaction/CandF/view-job-work-purchase-bill');

		}
	}
   
/*job work purchase bill*/

/* ------- START : IMPORT INWARD DIRECTLY -------  */
	
	public function ImportInward(Request $request){

		$title         = 'Import Inward';
		$user_type     = $request->session()->get('user_type');
		$userid        = $request->session()->get('userid');
		$comapnyDetail = $request->session()->get('company_name');
		$MaccYear      = $request->session()->get('macc_year');
		$splitData     = explode('-', $comapnyDetail);
		$comp_code     = $splitData[0];
		//DB::enableQueryLog();
		$rakeData     = DB::table('RAKE_TRAN')->where('COMP_CODE',$comp_code)->where('CFINWARD_STATUS','0')->groupBy('RAKE_NO')->get();
		//dd(DB::getQueryLog());
		
		$rakeNoAry = array();
		foreach($rakeData as $row){

			$rakeNo = $row->RAKE_NO;
			$checkRakeDone = DB::table('CFINWARD_TRAN')->where('RAKE_NO',$rakeNo)->groupBy('RAKE_NO')->get()->toArray();
			
			if(!empty($checkRakeDone)){
				
			}else{	
				
				array_push($rakeNoAry,$rakeNo);
			}

		}

		$userData['rakeNo_list'] = $rakeNoAry;	
		if(isset($comapnyDetail)){

	    		return view('admin.finance.transaction.candf.add_inward_import',$userData+compact('title'));

	    }else{

			return redirect('/useractivity');
		}
		
	}

	public function SaveInwardImport(Request $request){

		$fisYear  = $request->session()->get('macc_year');
		$userId   = $request->session()->get('userid');
		$rakeNo   = $request->input('rake_no');
		$tranCode ='G3';
		$compDetail = $request->session()->get('company_name');
		$spliData   = explode('-', $compDetail);
		$comp_Code  = $spliData[0];
		$comp_Name  = $spliData[1];

		$getRakeData = DB::select("SELECT * FROM RAKE_TRAN WHERE RAKE_NO='$rakeNo' AND CFINWARD_STATUS='0'");

		$getTBLData = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$tranCode)->where('COMP_CODE',$comp_Code)->get();

		if($getTBLData){

			$seriesCode = $getTBLData[0]->SERIES_CODE;

			$vrno_Exist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tranCode)->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$comp_Code)->where('FY_CODE',$fisYear)->get()->toArray();

			$VrSeqNo    = $vrno_Exist[0]->LAST_NO + 1;
		}else{
			$VrSeqNo    =1;
		}
		
		DB::beginTransaction();

		try {

			foreach($getRakeData as $row){

				/* ---------- FIND ODC  --------------- */


				$getItem1 = DB::table('MASTER_ITEM')->where('ITEM_CODE',$row->ITEM_CODE)->get()->first();

				$getItem = json_decode(json_encode($getItem1),true);

				if(isset($getItem['LENGTH']) || $getItem['LENGTH']=='NULL' || $getItem['LENGTH']==null){

				    $L = '0';

				}else{
				    $L = $getItem['LENGTH'];

				}

				if(isset($getItem['WIDTH']) || $getItem['WIDTH']=='NULL' || $getItem['WIDTH']==null){


				    $W = '0';
				}else{

				    $W = $getItem['WIDTH'];

				}

				if(isset($getItem['HEIGHT']) || $getItem['HEIGHT']=='NULL' || $getItem['HEIGHT']==null){

				    $H = '0';

				}else{
					
				    $H = $getItem['HEIGHT'];

				}






				if ($row->LENGTH > $L && $row->WIDTH > $W  && $row->HEIGHT > $H){

					$ODCFLAG = 'TWO SIDE ODC';
						
				}else if($row->WIDTH > $W  && $row->HEIGHT > $H || $row->LENGTH > $L && $row->WIDTH > $W || $row->LENGTH > $L && $row->HEIGHT > $H){

					$ODCFLAG = 'TWO SIDE ODC';

				}else if($row->LENGTH > $L || $row->WIDTH > $W  || $row->HEIGHT > $H){

					$ODCFLAG = 'ONE SIDE ODC';

				}else{

					$ODCFLAG = 'NO';

				}

			/* ---------- /. FIND ODC  --------------- */

				$data = array(

					'COMP_CODE'        => $row->COMP_CODE,
					'COMP_NAME'        => $row->COMP_NAME,
					'FY_CODE'          => $fisYear,
					'TRAN_CODE'        => $tranCode,
					'SERIES_CODE'      => $getTBLData[0]->SERIES_CODE,
					'SERIES_NAME'      => $getTBLData[0]->SERIES_NAME,
					'SLNO'             => $row->SLNO,
					'VRNO'             => $VrSeqNo,
					'RAKE_DATE'        => $row->RAKE_DATE,
					'PLACE_DATE'       => $row->PLACE_DATE,
					'ACC_CODE'         => $row->ACC_CODE,
					'ACC_NAME'         => $row->ACC_NAME,
					'VRDATE'           => $row->PLACE_DATE,
					'ORDER_SLNO'       => $row->SLNO,
					'ORDER_NO'         => $row->ORDER_NO,
					'ORDER_DATE'       => $row->ORDER_DATE,
					'CP_CODE'          => $row->CP_CODE,
					'CP_NAME'          => $row->CP_NAME,
					'CP_ADD'           => $row->CP_ADD,
					'SP_CODE'          => $row->SP_CODE,
					'SP_NAME'          => $row->SP_NAME,
					'SP_ADD'           => $row->SP_ADD,
					'ROUTE_CODE'       => $row->ROUTE_CODE,
					'ROUTE_NAME'       => $row->ROUTE_NAME,
					'FROM_PLACE'       => $row->FROM_PLACE,
					'TO_PLACE'         => $row->TO_PLACE,
					'DORDER_QTY'       => $row->DORDER_QTY,
					'LOT_NO'           => $row->LOT_NO,
					'ALIAS_CODE'       => $row->ALIAS_CODE,
					'ALIAS_NAME'       => $row->ALIAS_NAME,
					'LENGTH'           => $row->LENGTH,
					'WIDTH'            => $row->WIDTH,
					'HEIGHT'           => $row->HEIGHT,
					'ODC'              => $ODCFLAG,
					'SLIP_NO'          => $rakeNo,
					'REMARK'           => $row->REMARK,
					'INVOICE_NO'       => $row->INVOICE_NO,
					'INVOICE_DATE'     => $row->INVOICE_DATE,
					'WAGON_NO'         => $row->WAGON_NO,
					'OBD_NO'           => $row->OBD_NO,
					'DELIVERY_NO'      => $row->DELIVERY_NO,
					'EWAY_BILL_NO'     => $row->EWAY_BILL_NO,
					'EWAY_BILL_DT'     => $row->EWAY_BILL_DT,
					'CAM_NO'           => $row->CAM_NO,
					'INWARD_DATE'      => $row->PLACE_DATE,
					'TRANSPORT_TYPE'   => 'RAKE',
					'TRANSPORTER_TYPE' => '',
					'VEHICLE_NO'       => '',
					'TRPT_CODE'        => '',
					'TRPT_NAME'        => '',
					'PLANT_CODE'       => $row->PLANT_CODE,
					'PLANT_NAME'       => $row->PLANT_NAME,
					'PFCT_CODE'        => $row->PFCT_CODE,
					'PFCT_NAME'        => $row->PFCT_NAME,
					'UCONT_CODE'       => '',
					'UCONT_NAME'       => '',
					'RAKE_NO'          => $rakeNo,
					'BATCH_NO'         => $row->BATCH_NO,
					'ITEM_CODE'        => $row->ITEM_CODE,
					'ITEM_NAME'        => $row->ITEM_NAME,
					'QTY'              => $row->QTY,
					'UM'               => $row->UM,
					'AQTY'             => $row->AQTY,
					'AUM'              => $row->AUM,
					'CFACTOR'          => $row->CFACTOR,
					'QTYRECD'          => $row->QTY,
					'AQTYRECD'         => $row->AQTY,
					'LOCATION_CODE'    => 'JSPLYR',
					'LOCATION_NAME'    => 'JSPL YARD',
					'CREATED_BY'       => $userId
				);

				DB::table('CFINWARD_TRAN')->insert($data);

				$udateData = array(
					'CFINWARD_STATUS' => '1'
				);
				DB::table('RAKE_TRAN')->where('RAKE_NO',$rakeNo)->update($udateData);

				$particular ='';
				$qtyIssued=0.000;
				$a_qtyIssued=0.000;
				$blankVal = '';
				$trans_code='';
				$trans_name='';
				$stockItem = (new AccountingController)->InsertStockInStockLedger($row->COMP_CODE,$rakeNo,$row->RAKE_DATE,$row->PLACE_DATE,$fisYear,$row->PFCT_CODE,$row->PFCT_NAME,$row->PLANT_CODE,$row->PLANT_NAME,$tranCode,$getTBLData[0]->SERIES_CODE,$VrSeqNo,$row->SLNO,$row->ACC_CODE,$row->ACC_NAME,$row->PLACE_DATE,$row->ORDER_NO,$row->ORDER_DATE,$row->CP_CODE,$row->CP_NAME,$row->CP_ADD,$row->SP_CODE,$row->SP_NAME,$row->SP_ADD,$row->ROUTE_CODE,$row->ROUTE_NAME,$row->FROM_PLACE,$row->TO_PLACE,$row->BATCH_NO,$row->DORDER_QTY,$row->LOT_NO,$row->ALIAS_CODE,$row->ALIAS_NAME,$row->ITEM_CODE,$row->ITEM_NAME,$row->LENGTH,$row->WIDTH,$row->HEIGHT,$ODCFLAG,$row->REMARK,$row->QTY,$row->UM,$row->AQTY,$row->AUM,$row->CFACTOR,$row->INVOICE_NO,$row->INVOICE_DATE,$row->WAGON_NO,$row->OBD_NO,$row->EWAY_BILL_NO,$row->EWAY_BILL_DT,$row->CAM_NO,'',$trans_code,$trans_name,$blankVal,$blankVal,$row->QTY,$row->AQTY,$qtyIssued,$a_qtyIssued,$blankVal,$userId);
			}

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tranCode)->where('SERIES_CODE',$getTBLData[0]->SERIES_CODE)->where('COMP_CODE',$row->COMP_CODE)->where('FY_CODE',$fisYear)->get()->toArray();

			if(empty($checkvrnoExist)){
				$datavrnIn =array(
					'COMP_CODE'   =>$row->COMP_CODE,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$tranCode,
					'SERIES_CODE' =>$getTBLData[0]->SERIES_CODE,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$VrSeqNo,
					'CREATED_BY'  =>$userId,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);
			}else{
				$datavrn =array(
					'LAST_NO'=>$VrSeqNo
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tranCode)->where('SERIES_CODE',$getTBLData[0]->SERIES_CODE)->where('COMP_CODE',$row->COMP_CODE)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();
			$data['response'] = 'success';
		     $getalldata = json_encode($data);  
		     print_r($getalldata);

		}catch (\Exception $e) {

	        DB::rollBack();
	        //throw $e;
	        $data['response'] = 'error';
	        $getalldata = json_encode($data);  
	        print_r($getalldata);

	    } /* /.*/

	}

/* ------- END : IMPORT INWARD DIRECTLY -------  */

/*-------- START : PHYSICAL VERIFICATION ---------- */
	
	public function AddInwardPhysicalVerify(Request $request){

		$title      = 'Inward Physical Verification';
		$fisYear    = $request->session()->get('macc_year');
		$userId     = $request->session()->get('userid');
		$compDetail = $request->session()->get('company_name');
		$spliData   = explode('-', $compDetail);
		$comp_Code  = $spliData[0];
		$comp_Name  = $spliData[1];

		$userData['rakeNo_list'] = DB::select("SELECT * FROM CFINWARD_TRAN  GROUP BY RAKE_NO");

		if(isset($compDetail)){
	    		return view('admin.finance.transaction.candf.add_inward_physical_verify',$userData+compact('title'));
	    }else{
			return redirect('/useractivity');
		}

	}

	public function GetFieldListForInwardVerify(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$rake_No    = $request->input('rakeNo');
			$wagon_No   = $request->input('wagonNo');
			$batch_No    = $request->input('batchNo');
			$field_Type = $request->input('fieldType');

	    	 	if($field_Type == 'RAKENO'){

		    	 	$data_list = DB::table('CFINWARD_TRAN')->where('RAKE_NO', $rake_No)->where('PHY_VERIFY', '0')->groupBy('WAGON_NO')->get();
	    	 	}else if($field_Type == 'WAGONNO'){
	    	 		$data_list = DB::table('CFINWARD_TRAN')->where('RAKE_NO', $rake_No)->where('WAGON_NO', $wagon_No)->where('PHY_VERIFY', '0')->get();
	    	 	}else if($field_Type == 'BATCHNO'){
	    	 		$data_list = DB::table('CFINWARD_TRAN')->where('RAKE_NO', $rake_No)->where('WAGON_NO', $wagon_No)->where('BATCH_NO', $batch_No)->where('PHY_VERIFY', '0')->get();
	    	 	}else{
	    	 		$data_list ='';
	    	 	}

    			if ($data_list) {

    				$response_array['response'] = 'success';
	            	$response_array['dataList'] = $data_list;

	           	echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                	$response_array['dataList'] = '' ;

                	$data = json_encode($response_array);

                	print_r($data);
				
			}


	    	}else{

	    			$response_array['response'] = 'error';
                	$response_array['dataList'] = '' ;

                	$data = json_encode($response_array);

                	print_r($data);
	    	}

	}

	public function GetDataForInwardVerify(Request $request){

        if ($request->ajax()) {

            if (!empty($request->rakeNo || $request->wagonNo || $request->batchNo || $request->cpCode)) {
                
				$rake_no  = $request->rakeNo;
				$wagon_no = $request->wagonNo;
				$batch_no = $request->batchNo;
				$cp_code  = $request->cpCode;

                	$strWhere='';

                if(isset($rake_no)  && trim($rake_no)!="")
                {
                     $strWhere .= "AND RAKE_NO='$rake_no'";
                }

                if(isset($wagon_no)  && trim($wagon_no)!="")
                {
                    $strWhere .= "AND WAGON_NO='$wagon_no'";
                }

                if(isset($batch_no)  && trim($batch_no)!="")
                {
                    $strWhere .= "AND BATCH_NO='$batch_no'";
                }

                if(isset($cp_code)  && trim($cp_code)!="")
                {
                    $strWhere .= "AND CP_CODE='$cp_code'";
                }
               // DB::enableQueryLog();
                $data = DB::select("SELECT * FROM CFINWARD_TRAN WHERE PHY_VERIFY='0' $strWhere");
             	//dd(DB::getQueryLog());
                return DataTables()->of($data)->addIndexColumn()->make(true);
                
            }else{

                $data = array();
                return DataTables()->of($data)->addIndexColumn()->make(true);

            }

        }else{

                $data = array();
                return DataTables()->of($data)->addIndexColumn()->make(true);

        }

    }

     public function SaveInwardPhysicalVerify(Request $request){

    		$checkedVerify = $request->checkVerify;

    		DB::beginTransaction();

		try {

	    		for($i=0;$i<count($checkedVerify);$i++){

	    			$dataUpdate = array(
		    			'PHY_VERIFY' =>'1'
		    		);
	    			DB::table('CFINWARD_TRAN')->where('CFINWARDID',$checkedVerify[$i])->update($dataUpdate);
    			}

    			DB::commit();

			$response_array['response'] = 'success';
		     $dataget = json_encode($response_array);  
		     print_r($dataget);

	    }catch (\Exception $e) {
	          DB::rollBack();
		     //throw $e;
	          $response_array['response'] = 'error';
			$dataget = json_encode($response_array);  
			print_r($dataget);
		}
     }

     public function inwardVerifyMsg(Request $request,$saveData){

     	if ($saveData == 'false') {
			
			$request->session()->flash('alert-error', 'Inward Physical Verification Can Not Added...!');
			return redirect('/transaction/c-and-f/add-inward-physical-verification');

		}else{

			$request->session()->flash('alert-success', 'Inward Physical Verification Was Successfully Added...!');
			return redirect('/transaction/c-and-f/add-inward-physical-verification');

		}

     }

/*-------- END : PHYSICAL VERIFICATION ---------- */

/* --------- START : EXPORT LR EXCEL ---------- */
	
	public function ExportLrExcel(Request $request){

		$title       ='Export Lr Excel';
		$compDetails = $request->session()->get('company_name');
		$splitData   = explode('-',$compDetails);
		$comp_code   = $splitData[0];
		$tranCode    = '';
		$allTblName = $this->AllTableName($request,$tranCode);
		
		foreach ($allTblName['fy_list'] as $key) {	

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}
		
		if(isset($compDetails)){

	    	return view('admin.finance.transaction.candf.export_lr',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

	}

	public function ExportLrDataInExcel(Request $request){

		if ($request->ajax()) {

         if (!empty($request->fromDate || $request->toDate)) {

         	$compDetails = $request->session()->get('company_name');
			$splitData   = explode('-',$compDetails);
			$comp_code   = $splitData[0];
            
			$FROMDATE = $request->fromDate;
			$TODATE   = $request->toDate;

			/*print_r($FROMDATE);
			echo "<br>";
			print_r($TODATE);
			exit();*/
			
            $strWhere='';

            if(isset($TODATE) && trim($TODATE)!="" && isset($FROMDATE)){

              $ToDt = date("Y-m-d", strtotime($TODATE));

              $FromDt = date("Y-m-d", strtotime($FROMDATE));

              $strWhere .= "AND H.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
          	}
            //DB::enableQueryLog();
            $data = DB::select("SELECT B.INVC_NO,B.INVC_DATE,H.VEHICLE_TYPE,B.SP_CODE,B.SP_NAME,B.FROM_PLACE,B.UM,B.QTY,B.MATERIAL_VAL,B.DO_NO,B.DO_DATE,B.DELIVERY_NO,H.PLANT_CODE,B.TO_PLACE,B.TO_PLACE AS TOPLACE,'MAH' AS REGIO,H.TRANSPORT_NAME,H.VEHICLE_NO,'11' AS MATERIAL_GROUP,B.ITEM_CODE,B.REMARK,B.BATCH_NO,B.NET_WEIGHT,B.GROSS_WEIGHT,B.TARE_WEIGHT,B.AQTY,' ' AS SALES_DOC_TYPE,' ' AS E1FORM_INDICATO,B.LR_NO,B.LR_DATE,H.PLANT_NAME,B.EBILL_NO,B.EWAYB_VALIDDT,H.ACC_CODE FROM TRIP_HEAD H LEFT JOIN TRIP_BODY B ON H.TRIPHID = B.TRIPHID WHERE H.LR_STATUS = '1' $strWhere AND H.COMP_CODE = '$comp_code'");
          	//dd(DB::getQueryLog());
            return DataTables()->of($data)->addIndexColumn()->make(true);
                
         }else{

            $data1 = array();
            return DataTables()->of($data1)->addIndexColumn()->make(true);

         }

      }else{

         $data0 = array();
         return DataTables()->of($data0)->addIndexColumn()->make(true);

      }

	}
	

/* --------- END : EXPORT LR EXCEL ---------- */

/* ---------- START : GET TAX CODE AGAINST STATE ---------- */
	
	public function getTaxAgainstItemFrSaleOrder(Request $request){

    	$response_array = array();

		if ($request->ajax()) {

			$compDetails  = $request->session()->get('company_name');
			$splitData    = explode('-',$compDetails);
			$comp_code    = $splitData[0];
			$item_code    = $request->input('itemCd');
			$saleOrderHid = $request->input('saleOrderHid');

			$taxCode = DB::select("SELECT A.TAX_CODE,B.TAX_NAME,A.HSN_CODE,C.HSN_NAME FROM SORDER_BODY A,MASTER_TAX B,MASTER_HSN C WHERE A.TAX_CODE=B.TAX_CODE AND C.HSN_CODE=A.HSN_CODE AND A.ITEM_CODE='$item_code' AND A.SORDERHID='$saleOrderHid'");

	    		if ($taxCode) {

				$response_array['response']    = 'success';
				$response_array['tax_Code'] = $taxCode;

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
				$response_array['data']     = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

		}else{

				$response_array['response'] = 'error';
				$response_array['data']     = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

/* ---------- END : GET TAX CODE AGAINST STATE ---------- */

}


