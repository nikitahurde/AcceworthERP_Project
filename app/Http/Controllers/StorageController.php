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


class StorageController extends Controller{

	public function __construct(Request $request){

	}

/* ---------- START : ITEM PACKING MASTER ------------ */

	public function ItemPackingMastt(Request $request){

		$title                 ='Add Equipment Type Master';
		$compName              = $request->session()->get('company_name');
		$userData['item_list'] = DB::table('MASTER_ITEM')->Orderby('ITEM_CODE', 'desc')->get();
		$userData['hsn_list']  = DB::table('MASTER_HSN')->Orderby('HSN_CODE', 'desc')->get();

		if(isset($compName)){

	    	return view('admin.finance.master.ColdStorage.item_packing',$userData+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function SaveItemPacking(Request $request){

		
		$rules = [	
					'item_code'    => 'required|max:15',
					'item_name'    => 'required',
					'packing_id'   => 'required',
					'um'           => 'required',
					'aum'          => 'required',
					'packing_name' => 'required|max:40',
					'c_factor'     => 'required',
					'rate'         => 'required',
					'hsn_code'     => 'required',
					'hsn_name'     => 'required',
					'gst_no'       => 'required',
					'length'       => 'required',
					'width'        => 'required',
					'height'       => 'required',
					'cubic_space'  => 'required',
					'no_days'      => 'required',
					'min_qty1'     => 'required',
					'min_qty2'     => 'required',
					'min_rate1'    => 'required',
					'min_rate2'    => 'required',
					'packing_id' => ['required', 'string',Rule::unique('MASTER_ITEM_PACKING')->where(function ($query) use ($request) {
					    return $query->where('ITEM_CODE', $request->item_code)->where('PACKING_ID', $request->packing_id);
							})],
			    ];

	    $customMessages = [
	        'packing_id.unique'=>'The Packing Code has already been taken for this <b><u> Item Code</u></b>',
	    ];

	    $this->validate($request, $rules, $customMessages);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$data = array(

			"ITEM_CODE"    => $request->input('item_code'),
			"ITEM_NAME"    => $request->input('item_name'),
			"UM"           => $request->input('um'),
			"AUM"          => $request->input('aum'),
			"C_FACTOR"     => $request->input('c_factor'),
			"PACKING_ID"   => $request->input('packing_id'),
			"PACKING_NAME" => $request->input('packing_name'),
			"RATE"         => $request->input('rate'),
			"LENGTH"       => $request->input('length'),
			"WIDTH"        => $request->input('width'),
			"HEIGHT"       => $request->input('height'),
			"CUBIC_SPACE"  => $request->input('cubic_space'),
			"HSN_CODE"     => $request->input('hsn_code'),
			"HSN_NAME"     => $request->input('hsn_name'),
			"NO_DAYS"      => $request->input('no_days'),
			"GST_NO"       => $request->input('gst_no'),
			"MIN_QTY1"     => $request->input('min_qty1'),
			"MIN_QTY2"     => $request->input('min_qty2'),
			"MIN_RATE1"    => $request->input('min_rate1'),
			"MIN_RATE2"    => $request->input('min_rate2'),
			"CREATED_BY"   => $createdBy,
			
		);

		$saveData = DB::table('MASTER_ITEM_PACKING')->insert($data);

		$discriptn_page = "Master Item Packing insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Packing Was Successfully Added...!');
			return redirect('/Master/ColdStorage/View-Item-Packing-Mast');

		} else {

			$request->session()->flash('alert-error', 'Item Packing Can Not Added...!');
			return redirect('/Master/ColdStorage/View-Item-Packing-Mast');

		}

	}

	public function ViewItemPackingMast(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Item Packing Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_ITEM_PACKING')->orderBy('PACKING_ID','DESC');
	    	
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_ITEM_PACKING')->orderBy('PACKING_ID','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.ColdStorage.view_item_packing');
    	}else{
		 	return redirect('/useractivity');
	   	}

    }

	public function EditItemPackingMast($id,$itemId){

    	$title = 'Edit Item Packing Master';

    	$id = base64_decode($id);
    	$itemId = base64_decode($itemId);
    	
    	if(($id!='') && ($itemId!='')){
    	    $query = DB::table('MASTER_ITEM_PACKING');
			$query->where('PACKING_ID', $id);
			$query->where('ITEM_CODE', $itemId);
			$classData= $query->get()->first();

			$item_packing_block   = $classData->ITEMPAKCING_BLOCK;

		    $userData['item_list'] = DB::table('MASTER_ITEM')->Orderby('ITEM_CODE', 'desc')->get();
		    $userData['hsn_list'] = DB::table('MASTER_HSN')->Orderby('HSN_CODE', 'desc')->get();

			$button='Update';
			$action='/Master/ColdStorage/item-packing-Update';

			return view('admin.finance.master.ColdStorage.edit_item_packing',$userData+compact('title','classData'));
		}else{
			$request->session()->flash('alert-error', 'Item Type Not Found...!');
			return redirect('/Master/ColdStorage/View-Item-Packing-Mast');
		}

    }

    public function UpdateItemPacking(Request $request){

		$validate = $this->validate($request, [

			'item_code'    => 'required',
			'item_name'    => 'required',
			'um'           => 'required',
			'aum'          => 'required',
			'packing_id'   => 'required',
			'packing_name' => 'required|max:40',
			'c_factor'     => 'required',
			'rate'         => 'required',
			'length'       => 'required',
			'width'        => 'required',
			'height'       => 'required',
			'cubic_space'  => 'required',
			'hsn_code'     => 'required',
			'hsn_name'     => 'required',
			'no_days'      => 'required',
			'gst_no'       => 'required',
			'min_qty1'     => 'required',
			'min_qty2'     => 'required',
			'min_rate1'    => 'required',
			'min_rate2'    => 'required',
		
		]);

		$itempacking_id = $request->input('itempacking_id');
		$itemcode_id = $request->input('itemcode_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d  H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(

			"PACKING_NAME"      => $request->input('packing_name'),
			"RATE"              => $request->input('rate'),
			"LENGTH"            => $request->input('length'),
			"WIDTH"             => $request->input('width'),
			"HEIGHT"            => $request->input('height'),
			"CUBIC_SPACE"       => $request->input('cubic_space'),
			"NO_DAYS"           => $request->input('no_days'),
			"GST_NO"            => $request->input('gst_no'),
			"MIN_QTY1"          => $request->input('min_qty1'),
			"MIN_QTY2"          => $request->input('min_qty2'),
			"MIN_RATE1"         => $request->input('min_rate1'),
			"MIN_RATE2"         => $request->input('min_rate2'),
			"ITEMPAKCING_BLOCK" => $request->input('item_packing_block'),
			"LAST_UPDATE_BY"    => $createdBy,
            "LAST_UPDATE_DATE"  => $updatedDate
			
		);

		try{

			$saveData = DB::table('MASTER_ITEM_PACKING')->where('PACKING_ID', $itempacking_id)->where('ITEM_CODE', $itemcode_id)->update($data);

			$discriptn_page = "Master Item Packing update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Packing Was Successfully Updated...!');
				return redirect('/Master/ColdStorage/View-Item-Packing-Mast');

			} else {

				$request->session()->flash('alert-error', 'Item Packing Can Not Added...!');
				return redirect('/Master/ColdStorage/View-Item-Packing-Mast');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Item Packing Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/ColdStorage/View-Item-Packing-Mast');
		}

	}

	public function DeleteItemPacking(Request $request){

		$itempackingId = $request->post('itempackingId');
		$explodeData   = explode('~',$itempackingId);
    	
    	if ($itempackingId!='') {
    		try{
    			$Delete = DB::table('MASTER_ITEM_PACKING')->where('PACKING_ID', $explodeData[0])->where('ITEM_CODE', $explodeData[1])->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Item Packing Was Deleted Successfully...!');
					return redirect('/Master/ColdStorage/View-Item-Packing-Mast');

				} else {

					$request->session()->flash('alert-error', 'Item Packing Can Not Deleted...!');
					return redirect('/Master/ColdStorage/View-Item-Packing-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Packing Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/ColdStorage/View-Item-Packing-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Item Packing Not Found...!');
			return redirect('/Master/ColdStorage/View-Item-Packing-Mast');

    	}

	}

/* ------------- END : IETM PACKING MASTER --------------- */

/* ------------------- START : COLD STORAGAE --------------------- */

	public function ColdStorageMast(Request $request){

		$title      ='Add Cold Storage Master';
		$compName   = $request->session()->get('company_name');
		$compName   = $request->session()->get('company_name');
		$fisYear    =  $request->session()->get('macc_year');
		if(isset($compName)){
			$getcomcode = explode('-', $compName);
			$comp_code  = $getcomcode[0];
			$comp_name  = $getcomcode[1];

			$userData['comp_list'] = DB::table('MASTER_COMP')->get();
			$userData['plant_list'] = DB::table('MASTER_PLANT')->get();

	       if($compName){

	    	 return view('admin.finance.master.ColdStorage.add_cold_storage',$userData+compact('title','comp_code','comp_name'));

	        }else{

			  return redirect('/useractivity');
		    }
        }
    } 

    public function SaveColdStorage(Request $request){

		$rules = [	
					'comp_code'         => 'required|max:8',
					'plant_code'        => 'required|max:6',
					'cs_code'           => 'required|max:6',
					'cold_storage_name' => 'required|max:40',
					'cs_code' => ['required', 'string',Rule::unique('MASTER_COLD_STORAGE')->where(function ($query) use ($request) {
					    return $query->where('COMP_CODE', $request->comp_code)->where('PLANT_CODE', $request->plant_code)->where('CS_CODE', $request->cs_code);
							})],
			    ];

	    $customMessages = [
	        'cs_code.unique'=>'The Cold Storage has already been taken for this <b><u> Company and Plant</u></b>',
	    ];

	    $this->validate($request, $rules, $customMessages);

		$createdBy         = $request->session()->get('userid');
		$compName          = $request->session()->get('company_name');
		$fisYear           =  $request->session()->get('macc_year');
				
		$data = array(
			"COMP_CODE"        => $request->input('comp_code'),
			"COMP_NAME"        => $request->input('comp_name'),
			"PLANT_CODE"       => $request->input('plant_code'),
			"PLANT_NAME"       => $request->input('plant_name'),
			"CS_CODE"          => $request->input('cs_code'),
			"CS_NAME"          => $request->input('cold_storage_name'),
			"CS_DISPLAYNAME"   => $request->input('cold_display_name'),
			"CS_ALIASNAME"     => $request->input('cold_alias_name'),
			"CS_GSTNO"         => $request->input('cold_gst_no'),
			"CS_LICENSE"       => $request->input('cold_license_no'),
			"CS_ADDRESS"       => $request->input('cold_address'),
			"CS_PHONENO"       => $request->input('cold_phone_no'),
			"CREATED_BY"       => $createdBy,
			
		);

		$saveData = DB::table('MASTER_COLD_STORAGE')->insert($data);

		$discriptn_page = "Master Cold Storage type insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cold Storage Was Successfully Added...!');
			return redirect('/Master/ColdStorage/View-Cold-storage-Mast');

		} else {

			$request->session()->flash('alert-error', 'Cold Storage Can Not Added...!');
			return redirect('/Master/ColdStorage/View-Cold-storage-Mast');

		}

	}

	public function ViewColdStorageMast(Request $request){

		$compName  = $request->session()->get('company_name');
		$splitComp = explode('-',$compName);
		$comp_code = $splitComp[0];
		$title     = 'View Cold Storage Master';
		$userid    = $request->session()->get('userid');
		$userType  = $request->session()->get('usertype');
		$fisYear   =  $request->session()->get('macc_year');

		if($request->ajax()) {

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_COLD_STORAGE')->where('COMP_CODE',$comp_code)->orderBy('CS_CODE','DESC');
	    	
	    	}elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_COLD_STORAGE')->where('COMP_CODE',$comp_code)->orderBy('CS_CODE','DESC');
	    	}else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.ColdStorage.view_cold_storage');
    	}else{
		 	return redirect('/useractivity');
	   }

    }

	public function EditColdStorageMast($compCde,$plantCd,$csCd){

    	$title = 'Edit Cold Storage Master';

    	$comp_cd = base64_decode($compCde);
    	$plant_cd = base64_decode($plantCd);
    	$cs_cde = base64_decode($csCd);
    	
    	if(($comp_cd!='') && ($plant_cd!='') && ($cs_cde!='')){

    	    $query = DB::table('MASTER_COLD_STORAGE');
			$query->where('COMP_CODE', $comp_cd);
			$query->where('PLANT_CODE', $plant_cd);
			$query->where('CS_CODE', $cs_cde);
			$classData= $query->get()->first();

			$userData['comp_list'] = DB::table('MASTER_COMP')->Orderby('COMP_CODE', 'desc')->get();
			$userData['plant_list'] = DB::table('MASTER_PLANT')->Orderby('PLANT_CODE', 'desc')->get();

			return view('admin.finance.master.ColdStorage.edit_cold_storage',$userData+compact('title','classData'));
		}else{
			$request->session()->flash('alert-error', 'Cold Storage Not Found...!');
			return redirect('/Master/ColdStorage/View-Cold-storage-Mast');
		}

    }

    public function UpdateColdStorage(Request $request){

		$validate = $this->validate($request, [

			'comp_code'  => 'required',
			'plant_code' => 'required',
			'cold_storage_code' => 'required',
			'cold_storage_name' => 'required',
		]);

		$compcode = $request->input('CompCode');
		$plantcode = $request->input('plantCode');
		$cscode = $request->input('csCode');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d  H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');
		
			$data = array(
				"CS_NAME"           => $request->input('cold_storage_name'),
				"CS_DISPLAYNAME"    => $request->input('cold_display_name'),
				"CS_ALIASNAME"      => $request->input('cold_alias_name'),
				"CS_GSTNO"          => $request->input('cold_gst_no'),
				"CS_LICENSE"        => $request->input('cold_license_no'),
				"CS_ADDRESS"        => $request->input('cold_address'),
				"CS_PHONENO"        => $request->input('cold_phone_no'),
				"COLDSTORAGE_BLOCK" => $request->input('coldstorage_block'),
				"LAST_UPDATE_BY"    => $createdBy,
                "LAST_UPDATE_DATE"  => $updatedDate,
				
			);

			try{

				$saveData = DB::table('MASTER_COLD_STORAGE')->where('COMP_CODE',$compcode)->where('PLANT_CODE', $plantcode)->where('CS_CODE', $cscode)->update($data);

				$discriptn_page = "Master cold storage update done by user";
				$this->userLogInsert($createdBy,$discriptn_page);

				if ($saveData) {

					$request->session()->flash('alert-success', 'Cold Storage Was Successfully Updated...!');
					return redirect('/Master/ColdStorage/View-Cold-storage-Mast');

				} else {

					$request->session()->flash('alert-error', 'Cold Storage Can Not Added...!');
					return redirect('/Master/ColdStorage/View-Cold-storage-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cold Storage Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/ColdStorage/View-Cold-storage-Mast');
			}

	}


    public function DeleteColdStorage(Request $request){

		$coldstorageid = $request->post('coldstorageid');
		$splitData     = explode('~',$coldstorageid);
		$compCd        = $splitData[0];
		$plantCd       = $splitData[1];
		$csCd          = $splitData[2];

    	if (($compCd!='') && ($plantCd!='') && ($csCd!=''))  {
    		try{
    			$Delete = DB::table('MASTER_COLD_STORAGE')->where('COMP_CODE', $compCd)->where('PLANT_CODE', $plantCd)->where('CS_CODE', $csCd)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Cold Storage Was Deleted Successfully...!');
					return redirect('/Master/ColdStorage/View-Cold-storage-Mast');

				} else {

					$request->session()->flash('alert-error', 'Cold Storage Can Not Deleted...!');
					return redirect('/Master/ColdStorage/View-Cold-storage-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cold Storage Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/ColdStorage/View-Cold-storage-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Cold Storage Not Found...!');
			return redirect('/Master/ColdStorage/View-Cold-storage-Mast');

    	}

	}

/* ----------------- END : COLD STORAGE MASTER --------------- */

/* ----------------- START : CHAMBER MASTER --------------- */

	public function ChamberMast(Request $request){


		$title      ='Add Chamber Master';
		$compName   = $request->session()->get('company_name');
		$compName   = $request->session()->get('company_name');
		$fisYear    =  $request->session()->get('macc_year');
		$getcomcode = explode('-', $compName);
		$comp_code  = $getcomcode[0];
		$comp_name  = $getcomcode[1];

		$userData['ColdStorageList'] = DB::table('MASTER_COLD_STORAGE')->where('COMP_CODE',$comp_code)->get();
		
		if(isset($compName)){

	    	return view('admin.finance.master.ColdStorage.add_chamber',$userData+compact('title','comp_code'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function SaveChamber(Request $request){

		$createdBy   = $request->session()->get('userid');
		$compName    = $request->session()->get('company_name');
		$fisYear     = $request->session()->get('macc_year');
		$getCompCode = explode('-', $compName);
		$compcode    = $getCompCode[0];
		$comp_name   = $getCompCode[1];

		$rules = [	
					'cs_code'          => 'required|max:6',
					'cs_name'          => 'required|max:40',
					'chamber_code'     => 'required|max:6',
					'chamber_name'     => 'required|max:40',
					'chamber_code' => ['required', 'string',Rule::unique('MASTER_CHAMBER')->where(function ($query) use ($request) {
					    return $query->where('COMP_CODE', $request->comp_code)->where('CS_CODE', $request->cs_code)->where('CHAMBER_CODE', $request->chamber_code);
							})],
			    ];

	    $customMessages = [
	        'chamber_code.unique'=>'The Chamber has already been taken for this <b><u> Company and Cold Storage</u></b>',
	    ];

	    $this->validate($request, $rules, $customMessages);

		$data = array(
			"COMP_CODE"        => $request->input('comp_code'),
			"COMP_NAME"        => $comp_name,
			"CHAMBER_CODE"     => $request->input('chamber_code'),
			"CHAMBER_NAME"     => $request->input('chamber_name'),
			"CS_CODE"          => $request->input('cs_code'),
			"CS_NAME"          => $request->input('cs_name'),
			"FLAG"             => 1,
			"CREATED_BY"       => $createdBy,
			
		);

		print_r($data);

		$saveData = DB::table('MASTER_CHAMBER')->insert($data);

		$discriptn_page = "Master Chamber insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Chamber Master Was Successfully Added...!');
			return redirect('/Master/ColdStorage/View-Chamber-Mast');

		} else {

			$request->session()->flash('alert-error', 'Chamber Master Can Not Added...!');
			return redirect('/Master/ColdStorage/View-Chamber-Mast');

		}

	}

	public function ViewChamberMast(Request $request){

		$title     = 'View Chamber Master';
		$userid    = $request->session()->get('userid');
		$userType  = $request->session()->get('usertype');
		$compName  = $request->session()->get('company_name');
		$spliComp  = explode('-',$compName);
		$comp_code = $spliComp[0];
		$fisYear   =  $request->session()->get('macc_year');

		if($request->ajax()) {
	    
	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_CHAMBER')->where('COMP_CODE',$comp_code)->orderBy('CHAMBER_CODE','DESC');
	    	
	    	}elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_CHAMBER')->where('COMP_CODE',$comp_code)->orderBy('CHAMBER_CODE','DESC');
	    	}else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.ColdStorage.view_chamber');
    	}else{
		 	return redirect('/useractivity');
	   }
    }

	public function EditChamberMast($compCd,$csCd,$chamberCd){

    	$title = 'Edit Chamber Master';

    	$comp_cd = base64_decode($compCd);
    	$cs_cd = base64_decode($csCd);
    	$chamber_cd = base64_decode($chamberCd);
    	
    	if(($comp_cd!='') && ($cs_cd!='') && ($chamber_cd!='')){

    	    $query = DB::table('MASTER_CHAMBER');
			$query->where('COMP_CODE', $comp_cd);
			$query->where('CS_CODE', $cs_cd);
			$query->where('CHAMBER_CODE', $chamber_cd);
			$classData= $query->get()->first();

			$userData['ColdStorageList'] = DB::table('MASTER_COLD_STORAGE')->get();

			return view('admin.finance.master.ColdStorage.edit_chamber',$userData+compact('title','classData'));
		}else{
			$request->session()->flash('alert-error', 'Cold Storage Not Found...!');
			return redirect('/Master/ColdStorage/View-Cold-storage-Mast');
		}

    }

    public function UpdateChamber(Request $request){

		$validate = $this->validate($request, [
			'chamber_name'      => 'required',
		]);

		$chamberId = $request->input('chamberId');
		$csCode    = $request->input('csCode');
		date_default_timezone_set('Asia/Kolkata');

		$createdBy   = $request->session()->get('userid');
		$compName    = $request->session()->get('company_name');
		$fisYear     = $request->session()->get('macc_year');
		$getCompCode = explode('-', $compName);
		$comp_code   = $getCompCode[0];
		$comp_name   = $getCompCode[1];

        $updatedDate = date("Y-m-d  H:i:s");

		$data = array(
			"CHAMBER_NAME" => $request->input('chamber_name'),
			"LAST_UPDATED_BY"   => $createdBy,
            "LAST_UPDATED_DATE"   => $updatedDate,
			
		);

		try{

			$saveData = DB::table('MASTER_CHAMBER')->where('COMP_CODE',$comp_code)->where('CS_CODE',$csCode)->where('CHAMBER_CODE',$chamberId)->update($data);

			$discriptn_page = "Master Chamber update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Chamber Was Successfully Updated...!');
				return redirect('/Master/ColdStorage/View-Chamber-Mast');

			} else {

				$request->session()->flash('alert-error', 'Chamber Can Not Added...!');
				return redirect('/Master/ColdStorage/View-Chamber-Mast');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Chamber Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/ColdStorage/View-Chamber-Mast');
		}

	}

    public function DeleteChamber(Request $request){

		$chamberId  = $request->post('chamberId');
		$splitData  = explode('~',$chamberId);
		$compCde    = $splitData[0];
		$csCde      = $splitData[1];
		$chamberCde = $splitData[2];
        if (($compCde!='') && ($csCde!='') && ($chamberCde!='')) {
    		try{
    			$Delete = DB::table('MASTER_CHAMBER')->where('COMP_CODE', $compCde)->where('CS_CODE', $csCde)->where('CHAMBER_CODE', $chamberCde)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Chamber Was Deleted Successfully...!');
					return redirect('/Master/ColdStorage/View-Chamber-Mast');

				} else {

					$request->session()->flash('alert-error', 'Chamber Can Not Deleted...!');
					return redirect('/Master/ColdStorage/View-Chamber-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Chamber Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/ColdStorage/View-Chamber-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Chamber Not Found...!');
			return redirect('/Master/ColdStorage/View-Chamber-Mast');

    	}

	}

/* ----------------- END : CHAMBER MASTER ----------------- */


/* ----------------- START : FLOOR MASTER ----------------- */

	public function FloorStorageMast(Request $request){

		$title    ='Add Floor Master';
		
		$compName = $request->session()->get('company_name');
		$explodeData = explode('-',$compName);
		$comp_code = $explodeData[0];

		$userData['ColdStorageList'] = DB::table('MASTER_COLD_STORAGE')->where('COMP_CODE',$comp_code)->get();
		$userData['chamber_list'] = DB::table('MASTER_CHAMBER')->where('COMP_CODE',$comp_code)->get();

		if(isset($compName)){

	    	return view('admin.finance.master.ColdStorage.add_floor',$userData+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function SaveFloorStorage(Request $request){

		$rules = [	
					'cs_code'          => 'required|max:6',
					'cs_name'          => 'required|max:40',
					'chamber_code'     => 'required|max:6',
					'chamber_name'     => 'required|max:40',
					'floor_code'       => 'required|max:6',
					'floor_name'       => 'required|max:40',
					'floor_code' => ['required', 'string',Rule::unique('MASTER_FLOOR_STORAGE')->where(function ($query) use ($request) {
					    return $query->where('COMP_CODE', $request->comp_code)->where('CS_CODE', $request->cs_code)->where('CHAMBER_CODE', $request->chamber_code)->where('FLOOR_CODE', $request->floor_code);
							})],
			    ];

	    $customMessages = [
	        'floor_code.unique'=>'The Floor has already been taken for this <b><u> Cold Storage and Chamber and company</u></b>',
	    ];

	    $this->validate($request, $rules, $customMessages);

		$createdBy  = $request->session()->get('userid');
		$compName   = $request->session()->get('company_name');
		$fisYear    =  $request->session()->get('macc_year');

		$storageVal = $request->input('storage_capacity');
		$csCode     = $request->input('cs_code');
		
		$data = array(
			"COMP_CODE"        => $request->input('comp_code'),
			"COMP_NAME"        => $request->input('comp_name'),
			"CS_CODE"          => $request->input('cs_code'),
			"CS_NAME"          => $request->input('cs_name'),
			"CHAMBER_CODE"     => $request->input('chamber_code'),
			"CHAMBER_NAME"     => $request->input('chamber_name'),
			"FLOOR_CODE"       => $request->input('floor_code'),
			"FLOOR_NAME"       => $request->input('floor_name'),
			"CREATED_BY"       => $createdBy,
			
		);

		$saveData = DB::table('MASTER_FLOOR_STORAGE')->insert($data);

		$discriptn_page = "Master Floor Storage type insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if($saveData){

			$request->session()->flash('alert-success', 'Floor Storage Was Successfully Added...!');
			return redirect('/Master/ColdStorage/View-Floor-storage-Mast');

		}else{

			$request->session()->flash('alert-error', 'Floor Storage Can Not Added...!');
			return redirect('/Master/ColdStorage/View-Floor-storage-Mast');

		}

	}

	public function EditFloorStorageMast($compCd,$csCd,$chmaberCd,$floorCd){

		$title      = 'Edit Floor Storage Master';

		$comp_Cd    = base64_decode($compCd);
		$cs_cd      = base64_decode($csCd);
		$chamber_cd = base64_decode($chmaberCd);
		$floor_cd   = base64_decode($floorCd);
    	
    	if(($comp_Cd!='') && ($cs_cd!='') && ($chamber_cd!='') && ($floor_cd!='')){
    	    $query = DB::table('MASTER_FLOOR_STORAGE');
			$query->where('COMP_CODE', $comp_Cd);
			$query->where('CS_CODE', $cs_cd);
			$query->where('CHAMBER_CODE', $chamber_cd);
			$query->where('FLOOR_CODE', $floor_cd);
			$classData= $query->get()->first();

			$userData['ColdStorageList'] = DB::table('MASTER_COLD_STORAGE')->get();
			$userData['chamber_list']    = DB::table('MASTER_CHAMBER')->get();

			return view('admin.finance.master.ColdStorage.edit_floor',$userData+compact('title','classData'));
		}else{
			$request->session()->flash('alert-error', 'Floor Storage Not Found...!');
			return redirect('/Master/ColdStorage/View-Floor-storage-Mast');
		}

    }

    public function UpdateFloorStorage(Request $request){

		$validate = $this->validate($request, [

			'cs_code'          => 'required',
			'cs_name'          => 'required',
			'chamber_code'     => 'required',
			'chamber_name'     => 'required',
			'floor_code'       => 'required',
			'floor_name'       => 'required',

		]);

		$compcode        = $request->input('compcode');
		$csCode          = $request->input('cscode');
		$chamberCode     = $request->input('chamberCode');
		$floorstorage_id = $request->input('floorstorage_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d  H:i:s");
    	$createdBy 	= $request->session()->get('userid');
    	$compName 	= $request->session()->get('company_name');
    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"FLOOR_NAME"       => $request->input('floor_name'),
			"LAST_UPDATE_BY"   => $createdBy,
            "LAST_UPDATE_DATE" => $updatedDate,
		);

		try{

			$saveData = DB::table('MASTER_FLOOR_STORAGE')->where('COMP_CODE', $compcode)->where('CS_CODE', $csCode)->where('CHAMBER_CODE', $chamberCode)->where('FLOOR_CODE', $floorstorage_id)->update($data);

			$discriptn_page = "Master Floor storage update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Floor Storage Was Successfully Updated...!');
				return redirect('/Master/ColdStorage/View-Floor-storage-Mast');

			} else {

				$request->session()->flash('alert-error', 'Floor Storage Can Not Added...!');
				return redirect('/Master/ColdStorage/View-Floor-storage-Mast');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Floor Storage Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/ColdStorage/View-Floor-storage-Mast');
		}

	}

	public function ViewFloorStorageMast(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Floor Storage Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');
	    	$splitData = explode('-',$compName);
	    	$compCD = $splitData[0];
	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_FLOOR_STORAGE')->where('COMP_CODE',$compCD)->orderBy('FLOOR_CODE','DESC');
	    	
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_FLOOR_STORAGE')->where('COMP_CODE',$compCD)->orderBy('FLOOR_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.ColdStorage.view_floor');
    	}else{
		 	return redirect('/useractivity');
	   }
    }


    public function DeleteFloorStorage(Request $request){

		$floorstorageId = $request->post('floorId');
		$splitData      = explode('~',$floorstorageId);
		$comp_cd        = $splitData[0];
		$cs_cd          = $splitData[1];
		$chamber_cd     = $splitData[2];
		$floor_cd       = $splitData[3];

    	if (($cs_cd!='') && ($chamber_cd!='') && ($floor_cd!='')) {
    		try{
    			$Delete = DB::table('MASTER_FLOOR_STORAGE')->where('COMP_CODE', $comp_cd)->where('CS_CODE', $cs_cd)->where('CHAMBER_CODE', $chamber_cd)->where('FLOOR_CODE', $floor_cd)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Floor Storage Was Deleted Successfully...!');
					return redirect('/Master/ColdStorage/View-Floor-storage-Mast');

				} else {

					$request->session()->flash('alert-error', 'Floor Storage Can Not Deleted...!');
					return redirect('/Master/ColdStorage/View-Floor-storage-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Floor Storage Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/ColdStorage/View-Floor-storage-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Floor Storage Not Found...!');
			return redirect('/Master/ColdStorage/View-Floor-storage-Mast');

    	}

	}

/* ----------------- END : FLOOR MASTER ----------------- */

/* ----------------- START : BLOCK MASTER ----------------- */
	
	public function BlockStorageMast(Request $request){

		$title       ='Add Block Master';
		$compName    = $request->session()->get('company_name');
		$explodeData = explode('-',$compName);
		$comp_code   = $explodeData[0];
		
		$userData['ColdStorageList'] = DB::table('MASTER_COLD_STORAGE')->where('COMP_CODE',$comp_code)->get();

		if(isset($compName)){

	    	return view('admin.finance.master.ColdStorage.add_block',$userData+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function SaveBlockStorage(Request $request){

		$rules = [	
					'cs_code'          => 'required|max:6',
					'cs_name'          => 'required|max:40',
					'chamber_code'     => 'required|max:6',
					'chamber_name'     => 'required|max:40',
					'floor_code'       => 'required|max:6',
					'floor_name'       => 'required|max:40',
					'storage_capacity' => 'required',
					'block_code'       => 'required|max:6',
					'block_name'       => 'required|max:40',
					'block_code' => ['required', 'string',Rule::unique('MASTER_BLOCK_STORAGE')->where(function ($query) use ($request) {
					    return $query->where('COMP_CODE', $request->comp_code)->where('CS_CODE', $request->cs_code)->where('CHAMBER_CODE', $request->chamber_code)->where('FLOOR_CODE', $request->floor_code)->where('BLOCK_CODE', $request->block_code);
							})],
			    ];

	    $customMessages = [
	        'block_code.unique'=>'The Block has already been taken for this <b><u> Cold Storage and Chamber and Floor and company</u></b>',
	    ];

	    $this->validate($request, $rules, $customMessages);

		$createdBy  = $request->session()->get('userid');
		$compName   = $request->session()->get('company_name');
		$fisYear    =  $request->session()->get('macc_year');

		$storageVal = $request->input('storage_capacity');
		$csCode     = $request->input('cs_code');

		DB::beginTransaction();

		try {

			$data = array(
				"COMP_CODE"        => $request->input('comp_code'),
				"COMP_NAME"        => $request->input('comp_name'),
				"CS_CODE"          => $request->input('cs_code'),
				"CS_NAME"          => $request->input('cs_name'),
				"CHAMBER_CODE"     => $request->input('chamber_code'),
				"CHAMBER_NAME"     => $request->input('chamber_name'),
				"FLOOR_CODE"       => $request->input('floor_code'),
				"FLOOR_NAME"       => $request->input('floor_name'),
				"BLOCK_CODE"       => $request->input('block_code'),
				"BLOCK_NAME"       => $request->input('block_name'),
				"STORAGE_CAPACITY" => $request->input('storage_capacity'),
				"BALANCE_SPACE"    => $request->input('storage_capacity'),
				"CREATED_BY"       => $createdBy,
				
			);
            //print_r($data);exit();
			DB::table('MASTER_BLOCK_STORAGE')->insert($data);
			DB::table('CS_BALENCE')->insert($data);

			if($storageVal){

				$capacityData = array(
					'STORAGE_CAPACITY' => $storageVal,
				);

				/* ---- UPDATE IN FLOOR MASTER ---- */

				DB::table('MASTER_FLOOR_STORAGE')->where('COMP_CODE',$request->input('comp_code'))->where('CS_CODE',$request->input('cs_code'))->where('CHAMBER_CODE',$request->input('chamber_code'))->where('FLOOR_CODE',$request->input('floor_code'))->update($capacityData);

				/* ---- UPDATE IN FLOOR MASTER ---- */

				/* ---- UPDATE IN CHAMBER MASTER ---- */

				DB::table('MASTER_CHAMBER')->where('COMP_CODE',$request->input('comp_code'))->where('CS_CODE',$request->input('cs_code'))->where('CHAMBER_CODE',$request->input('chamber_code'))->update($capacityData);

				/* ---- UPDATE IN CHAMBER MASTER ---- */

				/* ---- UPDATE IN COLD STORAGE MASTER ---- */

				DB::table('MASTER_CHAMBER')->where('COMP_CODE',$request->input('comp_code'))->where('CS_CODE',$request->input('cs_code'))->update($capacityData);

				/* ---- UPDATE IN COLD STORAGE MASTER ---- */

			}

			$discriptn_page = "Master Block Storage insert done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

		DB::commit();

			$request->session()->flash('alert-success', 'Block Storage Was Successfully Added...!');
			return redirect('/Master/ColdStorage/View-Block-storage-Mast');

       	}catch (\Exception $e) {

		    DB::rollBack();
		    //throw $e;
		    $request->session()->flash('alert-error', 'Block Storage Can Not Added...!');
			return redirect('/Master/ColdStorage/View-Block-storage-Mast');
		}

	}

	public function EditBlockStorageMast($compCd,$csCd,$chamberCd,$floorCd,$blockCd){

    	$title = 'Edit Cold Storage Master';

		$comp_cde    = base64_decode($compCd);
		$cs_cde      = base64_decode($csCd);
		$chamber_cde = base64_decode($chamberCd);
		$floor_cde   = base64_decode($floorCd);
		$block_cde   = base64_decode($blockCd);
    	
    	if(($comp_cde!='') && ($cs_cde!='') && ($chamber_cde!='') && ($floor_cde!='') && ($block_cde!='')){
    	    $query = DB::table('MASTER_BLOCK_STORAGE');
			$query->where('COMP_CODE', $comp_cde);
			$query->where('CS_CODE', $cs_cde);
			$query->where('CHAMBER_CODE', $chamber_cde);
			$query->where('FLOOR_CODE', $floor_cde);
			$query->where('BLOCK_CODE', $block_cde);
			$classData= $query->get()->first();	

			$userData['ColdStorageList'] = DB::table('MASTER_COLD_STORAGE')->get();
			$userData['chamber_list']    = DB::table('MASTER_CHAMBER')->get();
			$userData['floor_list']      = DB::table('MASTER_FLOOR_STORAGE')->get();

			$button='Update';
			$action='/Master/ColdStorage/Block-storage-Update';

			return view('admin.finance.master.ColdStorage.edit_block',$userData+compact('title','classData'));
		}else{
			$request->session()->flash('alert-error', 'Block Storage Not Found...!');
			return redirect('/Master/ColdStorage/View-Block-storage-Mast');
		}

    }

    public function UpdateBlockStorage(Request $request){

		$validate = $this->validate($request, [

			'cs_code'          => 'required|max:6',
			'cs_name'          => 'required|max:40',
			'chamber_code'     => 'required|max:6',
			'chamber_name'     => 'required|max:40',
			'floor_code'       => 'required|max:6',
			'floor_name'       => 'required|max:40',
			'block_code'       => 'required|max:6',
			'block_name'       => 'required|max:40',
			'storage_capacity' => 'required',

		]);

		$compcode  = $request->input('compcode');
		$cscode    = $request->input('cscode');
		$chamberCd = $request->input('chamberCd');
		$floorCd   = $request->input('floorCd');
		$blockCd   = $request->input('blockCd');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d  H:i:s");
		$createdBy   = $request->session()->get('userid');
		$compName    = $request->session()->get('company_name');
		$fisYear     =  $request->session()->get('macc_year');

		$storageVal = $request->input('storage_capacity');

		DB::beginTransaction();

		try {

			$data = array(
				
				"BLOCK_NAME"       => $request->input('block_name'),
				"STORAGE_CAPACITY" => $request->input('storage_capacity'),
				"LAST_UPDATE_BY"   => $createdBy,
                "LAST_UPDATE_DATE" => $updatedDate,
				
			);

			DB::table('MASTER_BLOCK_STORAGE')->where('COMP_CODE', $compcode)->where('CS_CODE', $cscode)->where('CHAMBER_CODE', $chamberCd)->where('FLOOR_CODE', $floorCd)->where('BLOCK_CODE', $blockCd)->update($data);
			DB::table('CS_BALENCE')->where('COMP_CODE', $compcode)->where('CS_CODE', $cscode)->where('CHAMBER_CODE', $chamberCd)->where('FLOOR_CODE', $floorCd)->where('BLOCK_CODE', $blockCd)->update($data);

			if($storageVal){

				$capacityData = array(
					'STORAGE_CAPACITY' => $storageVal,
				);

				/* ---- UPDATE IN FLOOR MASTER ---- */

				DB::table('MASTER_FLOOR_STORAGE')->where('COMP_CODE',$compcode)->where('CS_CODE',$cscode)->where('CHAMBER_CODE',$chamberCd)->where('FLOOR_CODE',$floorCd)->update($capacityData);

				/* ---- UPDATE IN FLOOR MASTER ---- */

				/* ---- UPDATE IN CHAMBER MASTER ---- */

				DB::table('MASTER_CHAMBER')->where('COMP_CODE',$compcode)->where('CS_CODE',$cscode)->where('CHAMBER_CODE',$chamberCd)->update($capacityData);

				/* ---- UPDATE IN CHAMBER MASTER ---- */

				/* ---- UPDATE IN COLD STORAGE MASTER ---- */

				DB::table('MASTER_CHAMBER')->where('COMP_CODE',$compcode)->where('CS_CODE',$cscode)->update($capacityData);

				/* ---- UPDATE IN COLD STORAGE MASTER ---- */

			}

			DB::commit();

			$data1['response'] = 'success';
  			$request->session()->flash('alert-success', 'Block Storage Was Successfully Updated...!');
			return redirect('/Master/ColdStorage/View-Block-storage-Mast');

       	}catch (\Exception $e) {

		    DB::rollBack();
		    //throw $e;
		    $request->session()->flash('alert-error', 'Block Storage Can Not Added...!');
			return redirect('/Master/ColdStorage/View-Block-storage-Mast');
		}

	}

	public function ViewBlockStorageMast(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

			$title    = 'View Block Storage Master';

			$userid   = $request->session()->get('userid');

			$userType = $request->session()->get('usertype');

			$compName = $request->session()->get('company_name');
			$compCD   = $splitData = explode('-',$compName);
			$fisYear  =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_BLOCK_STORAGE')->where('COMP_CODE',$compCD)->orderBy('FLOOR_CODE','DESC');
	    	
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_BLOCK_STORAGE')->where('COMP_CODE',$compCD)->orderBy('FLOOR_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.ColdStorage.view_block');
    	}else{
		 	return redirect('/useractivity');
	   }
    }


    public function DeleteBlockStorage(Request $request){

		$blockstorageId = $request->post('blockId');
		$splitData      = explode('~',$blockstorageId);
		$compCode         = $splitData[0];
		$csCode         = $splitData[1];
		$chamberCode    = $splitData[2];
		$floorCode      = $splitData[3];
		$blockCode      = $splitData[4];

    	if (($compCode!='') && ($csCode!='') && ($chamberCode!='') && ($floorCode!='') && ($blockCode!='')) {
    		try{
    			$Delete = DB::table('MASTER_BLOCK_STORAGE')->where('COMP_CODE', $compCode)->where('CS_CODE', $csCode)->where('CHAMBER_CODE', $chamberCode)->where('FLOOR_CODE', $floorCode)->where('BLOCK_CODE', $blockCode)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Block Storage Was Deleted Successfully...!');
					return redirect('/Master/ColdStorage/View-Block-storage-Mast');

				} else {

					$request->session()->flash('alert-error', 'Block Storage Can Not Deleted...!');
					return redirect('/Master/ColdStorage/View-Block-storage-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Block Storage Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/ColdStorage/View-Block-storage-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Equipment Type Not Found...!');
			return redirect('/Master/ColdStorage/View-Block-storage-Mast');

    	}

	}

/* ----------------- END : BLOCK MASTER ----------------- */

/* ------------------ START : BEAN MASTER --------------- */

	public function BingStorageMast(Request $request){

		$title    ='Add Floor Master';
		
		$compName = $request->session()->get('company_name');
		$explodeData = explode('-',$compName);
		$comp_code   = $explodeData[0];

		$userData['coldstorage_list'] = DB::table('MASTER_COLD_STORAGE')->where('COMP_CODE',$comp_code)->get();
		
		if(isset($compName)){

	    	return view('admin.finance.master.ColdStorage.add_bean',$userData+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function SaveBingStorage(Request $request){

		$rules = [	
					'cs_code'          => 'required|max:6',
					'cs_name'          => 'required|max:40',
					'chamber_code'     => 'required|max:6',
					'chamber_name'     => 'required|max:40',
					'floor_code'       => 'required|max:6',
					'floor_name'       => 'required|max:40',
					'block_code'       => 'required|max:6',
					'block_name'       => 'required|max:40',
					'bean_code'        => 'required|max:40',
					'bean_name'        => 'required|max:40',
					'storage_capacity' => 'required',
					'bean_code' => ['required', 'string',Rule::unique('MASTER_BING_STORAGE')->where(function ($query) use ($request) {
					    return $query->where('COMP_CODE', $request->comp_code)->where('CS_CODE', $request->cs_code)->where('CHAMBER_CODE', $request->chamber_code)->where('FLOOR_CODE', $request->floor_code)->where('BLOCK_CODE', $request->block_code)->where('BEAN_CODE', $request->bean_code);
							})],
			    ];

	    $customMessages = [
	        'bean_code.unique'=>'The Bean Code has already been taken for this <b><u> Cold Storage Code and Chamber Code and Floor Code and Block Code and comp code</u></b>',
	    ];

	    $this->validate($request, $rules, $customMessages);

		$createdBy  = $request->session()->get('userid');
		$compName   = $request->session()->get('company_name');
		$fisYear    = $request->session()->get('macc_year');
		$storageVal = $request->input('storage_capacity');
		$csCode     = $request->input('cs_code');

		$data = array(
			"COMP_CODE"        => $request->input('comp_code'),
			"COMP_NAME"        => $request->input('comp_name'),
			"CS_CODE"          => $request->input('cs_code'),
			"CS_NAME"          => $request->input('cs_name'),
			"CHAMBER_CODE"     => $request->input('chamber_code'),
			"CHAMBER_NAME"     => $request->input('chamber_name'),
			"FLOOR_CODE"       => $request->input('floor_code'),
			"FLOOR_NAME"       => $request->input('floor_name'),
			"BLOCK_CODE"       => $request->input('block_code'),
			"BLOCK_NAME"       => $request->input('block_name'),
			"BEAN_CODE"        => $request->input('bean_code'),
			"BEAN_NAME"        => $request->input('bean_name'),
			"STORAGE_CAPACITY" => $request->input('storage_capacity'),
			"CREATED_BY"       => $createdBy,
			
		);

		$saveData = DB::table('MASTER_BING_STORAGE')->insert($data);

		if($storageVal){

			$existData = DB::table('MASTER_COLD_STORAGE')->where('COMP_CODE',$request->comp_code)->where('CS_CODE',$csCode)->get()->first();

			$capacity = $existData->STORAGE_CAPACITY;
			
			$capacityData = array(
				'STORAGE_CAPACITY' => $capacity+$storageVal,
			);
			
			DB::table('MASTER_COLD_STORAGE')->where('COMP_CODE',$request->comp_code)->where('CS_CODE',$csCode)->update($capacityData);

		}
		
		$discriptn_page = "Master Bean Storage type insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Bean Storage Was Successfully Added...!');
			return redirect('/Master/ColdStorage/View-Bing-storage-Mast');

		} else {

			$request->session()->flash('alert-error', 'Bean Storage Can Not Added...!');
			return redirect('/Master/ColdStorage/View-Bing-storage-Mast');

		}

	}

	public function ViewBingStorageMast(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

			$title     = 'View Bean Master';
			$userid    = $request->session()->get('userid');
			$userType  = $request->session()->get('usertype');
			$compName  = $request->session()->get('company_name');
			$splitData = explode('-',$compName);
			$compCD    = $splitData[0];
			$fisYear   =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_BING_STORAGE')->where('COMP_CODE',$compCD)->orderBy('BEAN_CODE','DESC');
	    	
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_BING_STORAGE')->where('COMP_CODE',$compCD)->orderBy('BEAN_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.ColdStorage.view_bean');
    	}else{
		 	return redirect('/useractivity');
	   	}
    }

	public function EditBingStorageMast($compCd,$csCd,$chmaberCd,$floorCd,$blockCd,$beanCd){

		$title      = 'Edit Bean Storage Master';

		$comp_cd    = base64_decode($compCd);
		$cs_cd      = base64_decode($csCd);
		$chamber_cd = base64_decode($chmaberCd);
		$floor_cd   = base64_decode($floorCd);
		$block_cd   = base64_decode($blockCd);
		$bean_cd    = base64_decode($beanCd);
    	
    	if(($comp_cd!='') && ($cs_cd!='') && ($chamber_cd!='') && ($floor_cd!='') && ($block_cd!='') && ($bean_cd!='')){
    	    $query = DB::table('MASTER_BING_STORAGE');
			$query->where('COMP_CODE', $comp_cd);
			$query->where('CS_CODE', $cs_cd);
			$query->where('CHAMBER_CODE', $chamber_cd);
			$query->where('FLOOR_CODE', $floor_cd);
			$query->where('BLOCK_CODE', $block_cd);
			$query->where('BEAN_CODE', $bean_cd);
			$classData= $query->get()->first();

			$userData['coldstorage_list'] = DB::table('MASTER_COLD_STORAGE')->get();
			$userData['chamber_list']     = DB::table('MASTER_CHAMBER')->get();
			$userData['floor_list']       = DB::table('MASTER_FLOOR_STORAGE')->get();
			$userData['block_list']       = DB::table('MASTER_BLOCK_STORAGE')->get();

			return view('admin.finance.master.ColdStorage.edit_bean',$userData+compact('title','classData'));
		}else{
			$request->session()->flash('alert-error', 'Bing Storage Not Found...!');
			return redirect('/Master/ColdStorage/View-Bing-storage-Mast');
		}

    }

    public function UpdateBingStorage(Request $request){

		$validate = $this->validate($request, [
			'bean_name'        => 'required',
			'storage_capacity' => 'required',
		]);

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate      = date("Y-m-d");
		$createdBy        = $request->session()->get('userid');
		$compName         = $request->session()->get('company_name');
		$fisYear          =  $request->session()->get('macc_year');
		$comp_code        = $request->input('compCd');
		$coldStorage_code = $request->input('csCd');
		$chamber_code     = $request->input('chamberCd');
		$floor_code       = $request->input('floorCd');
		$block_code       = $request->input('blockCd');
		$bean_code        = $request->input('beanCd');

		$data = array(
			"BEAN_NAME"         => $request->input('bean_name'),
			"STORAGE_CAPACITY"  => $request->input('storage_capacity'),
			"BINGSTORAGE_BLOCK" => $request->input('bean_block'),
			"LAST_UPDATE_BY"    => $createdBy,
			
		);

		$saveData = DB::table('MASTER_BING_STORAGE')->where('COMP_CODE', $comp_code)->where('CS_CODE', $coldStorage_code)->where('CHAMBER_CODE', $chamber_code)->where('FLOOR_CODE', $floor_code)->where('BLOCK_CODE', $block_code)->where('BEAN_CODE', $bean_code)->update($data);
		
		try{
			
			$discriptn_page = "Master Bean storage update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Bean Storage Was Successfully Updated...!');
				return redirect('/Master/ColdStorage/View-Bing-storage-Mast');

			} else {

				$request->session()->flash('alert-error', 'Bean Storage Can Not Added...!');
				return redirect('/Master/ColdStorage/View-Bing-storage-Mast');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Bean Storage Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/ColdStorage/View-Bing-storage-Mast');
		}

	}

    public function DeleteBingStorage(Request $request){

		$beanCd     = $request->post('beanId');
		$splitData  = explode('~',$beanCd);
		$comp_cd    = $splitData[0];
		$cs_cd      = $splitData[1];
		$chamber_cd = $splitData[2];
		$floor_cd   = $splitData[3];
		$block_cd   = $splitData[4];
		$bean_cd    = $splitData[5];

    	if (($comp_cd!='') && ($cs_cd!='') && ($chamber_cd!='') && ($floor_cd!='') && ($block_cd!='') && ($bean_cd!='')) {
    		try{
    			$Delete = DB::table('MASTER_BING_STORAGE')->where('COMP_CODE', $comp_cd)->where('CS_CODE', $cs_cd)->where('CHAMBER_CODE', $chamber_cd)->where('FLOOR_CODE', $floor_cd)->where('BLOCK_CODE', $block_cd)->where('BEAN_CODE', $bean_cd)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Bean Storage Was Deleted Successfully...!');
					return redirect('/Master/ColdStorage/View-Bing-storage-Mast');

				} else {

					$request->session()->flash('alert-error', 'Bean Storage Can Not Deleted...!');
					return redirect('/Master/ColdStorage/View-Bing-storage-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Bean Storage Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/ColdStorage/View-Bing-storage-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Bean Storage Not Found...!');
			return redirect('/Master/ColdStorage/View-Bing-storage-Mast');

    	}

	}

/* ------------------ START : BEAN MASTER --------------- */

/* ------------------ START : SEASONAL MASTER --------------- */
	
	public function SeasonalMast(Request $request){

		$title        ='Add Seasonal Master';
		
		$compName     = $request->session()->get('company_name');
		$fisYear      =  $request->session()->get('macc_year');
		$getcomcode   = explode('-', $compName);
		$comp_code    = $getcomcode[0];
		$comp_name    = $getcomcode[1];

		$userData['itemList'] = DB::table('MASTER_ITEM')->get()->toArray();
		
		if(isset($compName)){
	    	return view('admin.finance.master.ColdStorage.add_seasonal',$userData+compact('title'));
	    }else{
			return redirect('/useractivity');
		}

    } 

    public function SaveSeasonalMast(Request $request){

		$validate = $this->validate($request, [

			'seasonal_code' => 'required|max:6|unique:MASTER_SEASONAL,SEASONAL_CODE',
			'seasonal_name' => 'required',
			'item_code'     => 'required',
			'item_name'     => 'required',
			'from_date'     => 'required',
			'middle_date'   => 'required',
			'dateto'        => 'required',
			'ratePerBag'    => 'required',
			'minQtyOne'     => 'required',
			'minRateOne'    => 'required',
			'minQtyTwo'     => 'required',
			'minRateTwo'    => 'required',
		]);

		$createdBy    = $request->session()->get('userid');
		$compName     = $request->session()->get('company_name');
		$fisYear      =  $request->session()->get('macc_year');
		$getcomcode   = explode('-', $compName);
		$comp_code    = $getcomcode[0];
		$comp_name    = $getcomcode[1];

		$from_dt   = date("Y-m-d", strtotime($request->input('from_date')));
		$middle_dt = date("Y-m-d", strtotime($request->input('middle_date')));
		$to_dt     = date("Y-m-d", strtotime($request->input('dateto')));
		
	
        $data = array(
			"COMP_CODE"     => $comp_code,
			"COMP_NAME"     => $comp_name,
			"SEASONAL_CODE" => $request->input('seasonal_code'),
			"SEASONAL_NAME" => $request->input('seasonal_name'),
			"ITEM_CODE"     => $request->input('item_code'),
			"ITEM_NAME"     => $request->input('item_name'),
			"FROM_DATE"     => $from_dt,
			"MIDDLE_DATE"   => $middle_dt,
			"END_DATE"      => $to_dt,
			"RATE_PER_BAG"  => $request->input('ratePerBag'),
			"MINQTY_ONE"    => $request->input('minQtyOne'),
			"MINRATE_ONE"   => $request->input('minRateOne'),
			"MINQTY_TWO"    => $request->input('minQtyTwo'),
			"MINRATE_TWO"   => $request->input('minRateTwo'),
			"FLAG"          => 1,
			"CREATED_BY"    => $createdBy,
			
		);

		$saveData = DB::table('MASTER_SEASONAL')->insert($data);

		$discriptn_page = "Master Cold Storage type insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Seasonal Was Successfully Added...!');
			return redirect('/Master/ColdStorage/View-Seasonal-Mast');

		} else {

			$request->session()->flash('alert-error', 'Seasonal Can Not Added...!');
			return redirect('/Master/ColdStorage/View-Seasonal-Mast');

		}

	}

	public function ViewSeasonalMast(Request $request){

		$title    = 'View Seasonal Master';
		$userid   = $request->session()->get('userid');
		$userType = $request->session()->get('usertype');
		$compName = $request->session()->get('company_name');
		$splicode = explode('-',$compName);
		$compCode = $splicode[0];
		$compName = $splicode[1];
		$fisYear  =  $request->session()->get('macc_year');

		if($request->ajax()) {

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_SEASONAL')->where('COMP_CODE',$compCode)->orderBy('SEASONAL_CODE','DESC');
	    	
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_SEASONAL')->where('COMP_CODE',$compCode)->orderBy('SEASONAL_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.ColdStorage.view_seasonal');
    	}else{
		 	return redirect('/useractivity');
	   }
    }

	public function EditSeasonalMast($id){

    	$title = 'Edit Seasonal Master';

    	$seasonalId = base64_decode($id);
    	
    	if($id!=''){
    	    $query = DB::table('MASTER_SEASONAL');
			$query->where('SEASONAL_CODE', $seasonalId);
			$classData= $query->get()->first();

			$userData['itemList'] = DB::table('MASTER_ITEM')->get()->toArray();
			return view('admin.finance.master.ColdStorage.edit_seasonal',$userData+compact('title','classData'));
		}else{
				$request->session()->flash('alert-error', 'Seasonal Not Found...!');
				return redirect('/Master/ColdStorage/View-Cold-storage-Mast');
		}

    }

    public function UpdateSeasonal(Request $request){

		$validate = $this->validate($request, [

			'seasonal_name' => 'required',
			'item_code'     => 'required',
			'item_name'     => 'required',
			'from_date'     => 'required',
			'middle_date'   => 'required',
			'dateto'        => 'required',
			'ratePerBag'    => 'required',
			'minQtyOne'     => 'required',
			'minRateOne'    => 'required',
			'minQtyTwo'     => 'required',
			'minRateTwo'    => 'required',
		]);

		$createdBy    = $request->session()->get('userid');
		$compName     = $request->session()->get('company_name');
		$fisYear      =  $request->session()->get('macc_year');
		$getcomcode   = explode('-', $compName);
		$comp_code    = $getcomcode[0];
		$comp_name    = $getcomcode[1];
		$seasonalId=$request->input('seasonalId');
        $from_dt   = date("Y-m-d", strtotime($request->input('from_date')));
		$middle_dt = date("Y-m-d", strtotime($request->input('middle_date')));
		$to_dt     = date("Y-m-d", strtotime($request->input('dateto')));
		$updatedDate = date("Y-m-d  H:i:s");
	
        $data = array(
			"SEASONAL_NAME"  => $request->input('seasonal_name'),
			"ITEM_CODE"      => $request->input('item_code'),
			"ITEM_NAME"      => $request->input('item_name'),
			"FROM_DATE"      => $from_dt,
			"MIDDLE_DATE"    => $middle_dt,
			"END_DATE"       => $to_dt,
			"RATE_PER_BAG"   => $request->input('ratePerBag'),
			"MINQTY_ONE"     => $request->input('minQtyOne'),
			"MINRATE_ONE"    => $request->input('minRateOne'),
			"MINQTY_TWO"     => $request->input('minQtyTwo'),
			"MINRATE_TWO"    => $request->input('minRateTwo'),
			"BLOCK_SEASONAL" => $request->input('seasonal_block'),
			"FLAG"           => 1,
			"LAST_UPDATED_BY"  => $createdBy,
            "LAST_UPDATED_DATE"=> $updatedDate,
			
		);

		try{

			$saveData = DB::table('MASTER_SEASONAL')->where('SEASONAL_CODE', $seasonalId)->update($data);

			$discriptn_page = "Master Seasonal update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Seasonal Was Successfully Updated...!');
				return redirect('/Master/ColdStorage/View-Seasonal-Mast');

			} else {

				$request->session()->flash('alert-error', 'Seasonal Can Not Added...!');
				return redirect('/Master/ColdStorage/View-Seasonal-Mast');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Seasonal Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/ColdStorage/View-Seasonal-Mast');
		}

	}


    public function DeleteSeasonal(Request $request){

		$seasonalId = $request->input('seasonalid');
    	
        // print_r($seasonalId);exit();
    	if ($seasonalId!='') {
    		try{
    			$Delete = DB::table('MASTER_SEASONAL')->where('SEASONAL_CODE', $seasonalId)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Seasonal Was Deleted Successfully...!');
					return redirect('/Master/ColdStorage/View-Seasonal-Mast');

				} else {

					$request->session()->flash('alert-error', 'Seasonal Can Not Deleted...!');
					return redirect('/Master/ColdStorage/View-Seasonal-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Seasonal Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/ColdStorage/View-Seasonal-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Seasonal Not Found...!');
			return redirect('/Master/ColdStorage/View-Seasonal-Mast');

    	}

	}

/* ------------------ END : SEASONAL MASTER --------------- */

/* ------------------ START : ACCOUNT ITEM RATE MASTER --------------- */
	
	public function AddAccItemRate(Request $request){

		$title        ='Add Account Item Rate Master';
		
		$compName     = $request->session()->get('company_name');
		$fisYear      =  $request->session()->get('macc_year');
		$getcomcode   = explode('-', $compName);
		$comp_code    = $getcomcode[0];
		$comp_name    = $getcomcode[1];

		$userData['compList']  = DB::table('MASTER_COMP')->get()->toArray();
		$userData['partyList'] = DB::table('MASTER_ACC')->get()->toArray();
		$userData['itemList']  = DB::table('MASTER_ITEM')->get()->toArray();
		$userData['blockList'] = DB::table('MASTER_BLOCK_STORAGE')->where('COMP_CODE',$comp_code)->get()->toArray();
		
		if(isset($compName)){
	    	return view('admin.finance.master.ColdStorage.add_accItemRate',$userData+compact('title','comp_code','comp_name'));
	    }else{
			return redirect('/useractivity');
		}

    } 

    public function SaveAccItemRate(Request $request){

    	$rules = [	
					'acc_code'  => 'required',
					'comp_code' => 'required',
					'acc_code' => ['required', 'string',Rule::unique('MASTER_ACC_ITEM_RATE')->where(function ($query) use ($request) {
					    return $query->where('ACC_CODE', $request->acc_code)->where('COMP_CODE', $request->comp_code);
							})],
			    ];

	    $customMessages = [
	        'acc_code.unique'=>'The Acc Code has already been taken for this <b><u> Comp Code</u></b>',
	    ];

	    $this->validate($request, $rules, $customMessages);

		$createdBy    = $request->session()->get('userid');
		$compName     = $request->session()->get('company_name');
		$fisYear      =  $request->session()->get('macc_year');
		$getcomcode   = explode('-', $compName);
		$comp_code    = $getcomcode[0];
		$comp_name    = $getcomcode[1];

		$ipItem_cd = $request->input('ipItemCode');

		DB::beginTransaction();

		try {

			if((count($ipItem_cd) > 0) && (!empty($ipItem_cd[0]))){
		
				for($i=0;$i<count($ipItem_cd);$i++){

					$ipItemCd    = $request->input('ipItemCode');
					$explodeItem = explode('[',$ipItemCd[$i]);

					$ippackingCd    = $request->input('ipPackingCode');
					$explodepacking = explode('[',$ippackingCd[$i]);

					$data = array(
						'COMP_CODE'    =>$request->input('comp_code'),
						'COMP_NAME'    =>$request->input('comp_name'),
						'ACC_CODE'     =>$request->input('acc_code'),
						'ACC_NAME'     =>$request->input('acc_name'),
						'ITEM_CODE'    =>$explodeItem[0],
						'ITEM_NAME'    =>substr($explodeItem[1], 0, -2), 
						'PACKING_CODE' =>$explodepacking[0],
						'PACKING_NAME' =>substr($explodepacking[1], 0, -2),
						'IP_RATE'      =>$request->input('ipRate')[$i],
						'TABSTATUS'    =>'PACKING',
						'CREATED_BY'   =>$createdBy,

					);

					DB::table('MASTER_ACC_ITEM_RATE')->insert($data);

				}
			}

			$sItem_cd = $request->input('sItemCode');
		
			if((count($sItem_cd) > 0) && (!empty($sItem_cd[0]))){

				for($j=0;$j<count($sItem_cd);$j++){

					$sItemCd    = $request->input('sItemCode');
					$explodeSItem = explode('[',$sItemCd[$j]);

					$spackingCd    = $request->input('sPackingCode');
					$explodeSpacking = explode('[',$spackingCd[$j]);

					$dataS = array(
						'COMP_CODE'    =>$request->input('comp_code'),
						'COMP_NAME'    =>$request->input('comp_name'),
						'ACC_CODE'     =>$request->input('acc_code'),
						'ACC_NAME'     =>$request->input('acc_name'),
						'ITEM_CODE'    =>$explodeSItem[0],
						'ITEM_NAME'    =>substr($explodeSItem[1], 0, -2), 
						'PACKING_CODE' =>$explodeSpacking[0],
						'PACKING_NAME' =>substr($explodeSpacking[1], 0, -2),
						'S_RATE'       =>$request->input('sRate')[$j],
						'TABSTATUS'    =>'SEASONAL',
						'CREATED_BY'   =>$createdBy,

					);

					DB::table('MASTER_ACC_ITEM_RATE')->insert($dataS);

				}

			}

			$fItem_cd = $request->input('fItemCode');
			
	    	if((count($fItem_cd) > 0) && (!empty($fItem_cd[0]))){

	    		for($k=0;$k<count($fItem_cd);$k++){

	    			$fItemCd    = $request->input('fItemCode');
					$explodeFItem = explode('[',$fItemCd[$k]);

					$fpackingCd    = $request->input('fPackingCode');
					$explodeFpacking = explode('[',$fpackingCd[$k]);

					$dataF = array(
						'COMP_CODE'    =>$request->input('comp_code'),
						'COMP_NAME'    =>$request->input('comp_name'),
						'ACC_CODE'     =>$request->input('acc_code'),
						'ACC_NAME'     =>$request->input('acc_name'),
						'ITEM_CODE'    =>$explodeFItem[0],
						'ITEM_NAME'    =>substr($explodeFItem[1], 0, -2),
						'PACKING_CODE' =>$explodeFpacking[0],
						'PACKING_NAME' =>substr($explodeFpacking[1], 0, -2),
						'F_RATE'       =>$request->input('fRate')[$k],
						'TABSTATUS'    =>'FIXED',
						'CREATED_BY'   =>$createdBy,

					);

					DB::table('MASTER_ACC_ITEM_RATE')->insert($dataF);

	    		}
	    	}

    		$chItem_Cd = $request->input('chItemCd');

    		if((count($chItem_Cd) > 0) && (!empty($chItem_Cd[0]))){

	    		for($n=0;$n<count($chItem_Cd);$n++){

					$chItemCd       = $request->input('chItemCd');
					$explodechItem  = explode('[',$chItemCd[$n]);

					$chItemPkg      = $request->input('chItemPkg');
					$expchItemPkg   = explode('[',$chItemPkg[$n]);

					$chcsCd         = $request->input('chcsCd');
					$expchchcsCd    = explode('[',$chcsCd[$n]);

					$chchamberCd    = $request->input('chchamberCd');
					$expchchamberCd = explode('[',$chchamberCd[$n]);

					$chfloorCd      = $request->input('chFloorCd');
					$expchchfloorCd = explode('[',$chfloorCd[$n]);

					$chBlockCd      = $request->input('chBlockCd');
					$expchchBlockCd = explode('[',$chBlockCd[$n]);

					$dataCh = array(
						'COMP_CODE'    =>$request->input('comp_code'),
						'COMP_NAME'    =>$request->input('comp_name'),
						'ACC_CODE'     =>$request->input('acc_code'),
						'ACC_NAME'     =>$request->input('acc_name'),
						'ITEM_CODE'    =>$explodechItem[0],
						'ITEM_NAME'    =>substr($explodechItem[1], 0, -2),
						'PACKING_CODE' =>$expchItemPkg[0],
						'PACKING_NAME' =>substr($expchItemPkg[1], 0, -2),
						'CS_CODE'      =>$expchchcsCd[0],
						'CS_NAME'      =>substr($expchchcsCd[1], 0, -2),
						'CHAMBER_CODE' =>$expchchamberCd[0],
						'CHAMBER_NAME' =>substr($expchchamberCd[1], 0, -2),
						'FLOOR_CODE'   =>$expchchfloorCd[0],
						'FLOOR_NAME'   =>substr($expchchfloorCd[1], 0, -2),
						'BLOCK_CODE'   =>$expchchBlockCd[0],
						'BLOCK_NAME'   =>substr($expchchBlockCd[1], 0, -2),
						'TABSTATUS'    =>'CHAMBER',
						'CREATED_BY'   =>$createdBy,
					);

					DB::table('MASTER_ACC_ITEM_RATE')->insert($dataCh);

	    		}

	    	}

	    	$discriptn_page = "Master Acc Item Rate insert done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

	    	DB::commit();

	   	 	$request->session()->flash('alert-success', 'Acc Item Rate Was Successfully Added...!');
			return redirect('/Master/ColdStorage/View-Acc-Item-Rate-Mast');

		}catch (\Exception $e) {
			DB::rollBack();
			//throw $e;
			$request->session()->flash('alert-error', 'Acc Item Rate Can Not Added...!');
			return redirect('/Master/ColdStorage/View-Acc-Item-Rate-Mast');
		
		}

    }

    public function ViewAccItemRate(Request $request){

		$title    = 'View Acc Item Rate';
		$userid   = $request->session()->get('userid');
		$userType = $request->session()->get('usertype');
		$compName = $request->session()->get('company_name');
		$splicode = explode('-',$compName);
		$compCode = $splicode[0];
		$compName = $splicode[1];
		$fisYear  =  $request->session()->get('macc_year');

		if($request->ajax()) {

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_ACC_ITEM_RATE')->where('COMP_CODE',$compCode)->orderBy('ACC_CODE','DESC');
	    	
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_ACC_ITEM_RATE')->where('COMP_CODE',$compCode)->orderBy('ACC_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();


    	}

    	if(isset($compName)){
    		return view('admin.finance.master.ColdStorage.view_accItemRate');
    	}else{
		 	return redirect('/useractivity');
	   }
    }

    public function DeleteAccItemRate(Request $request){

		$accItemId = $request->input('accItemRateId');
		$splitData = explode('~',$accItemId);
		$compCode  = $splitData[0];
		$accCode   = $splitData[1];
    	
    	if (($compCode!='') && ($accCode!='')) {
    		try{
    			$Delete = DB::table('MASTER_ACC_ITEM_RATE')->where('COMP_CODE', $compCode)->where('ACC_CODE', $accCode)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Account Item Rate Was Deleted Successfully...!');
					return redirect('/Master/ColdStorage/View-Acc-Item-Rate-Mast');

				} else {

					$request->session()->flash('alert-error', 'Account Item Rate Can Not Deleted...!');
					return redirect('/Master/ColdStorage/View-Acc-Item-Rate-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Account Item Rate Can not be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/ColdStorage/View-Acc-Item-Rate-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Account Item Rate Not Found...!');
			return redirect('/Master/ColdStorage/View-Seasonal-Mast');

    	}

	}

    public function EditAccItemRate(Request $request,$compCd,$accCd){

		$title   = 'Account Item Rate Master';

		$comp_Cd = base64_decode($compCd);
		$acc_Cd  = base64_decode($accCd);

		$compName   = $request->session()->get('company_name');
		$getcomcode = explode('-', $compName);
		$comp_code  = $getcomcode[0];
		$comp_name  = $getcomcode[1];
    	
    	if(($comp_Cd!='') && ($acc_Cd!='')){

    	    $query = DB::table('MASTER_ACC_ITEM_RATE');
			$query->where('COMP_CODE', $comp_Cd);
			$query->where('ACC_CODE', $acc_Cd);
			$classData= $query->get();

			$dataIpList = DB::select("SELECT * FROM `MASTER_ACC_ITEM_RATE` WHERE COMP_CODE='$comp_Cd' AND ACC_CODE='$acc_Cd' AND IP_RATE<>0.00 AND TABSTATUS='PACKING'");

			$dataSeasonList = DB::select("SELECT * FROM `MASTER_ACC_ITEM_RATE` WHERE COMP_CODE='$comp_Cd' AND ACC_CODE='$acc_Cd' AND S_RATE<>0.00 AND TABSTATUS='SEASONAL'");

			$dataFixesList = DB::select("SELECT * FROM `MASTER_ACC_ITEM_RATE` WHERE COMP_CODE='$comp_Cd' AND ACC_CODE='$acc_Cd' AND F_RATE<>0.00 AND TABSTATUS='FIXED'");

			$dataChamberList = DB::select("SELECT * FROM `MASTER_ACC_ITEM_RATE` WHERE COMP_CODE='$comp_Cd' AND ACC_CODE='$acc_Cd' AND TABSTATUS='CHAMBER'");

			$userData['compList'] = DB::table('MASTER_COMP')->get()->toArray();
			$userData['partyList'] = DB::table('MASTER_ACC')->get()->toArray();
			$userData['itemList'] = DB::table('MASTER_ITEM')->get()->toArray();
			$userData['blockList'] = DB::table('MASTER_BLOCK_STORAGE')->where('COMP_CODE',$comp_code)->get()->toArray();

			return view('admin.finance.master.ColdStorage.edit_accItemRate',$userData+compact('title','classData','dataIpList','dataSeasonList','dataFixesList','dataChamberList'));
		}else{
				$request->session()->flash('alert-error', 'Account Item Rate Not Found...!');
				return redirect('/Master/ColdStorage/View-Acc-Item-Rate-Mast');
		}

    }

    public function UpdateAccItemRate(Request $request){

		$createdBy  = $request->session()->get('userid');
		$compName   = $request->session()->get('company_name');
		$fisYear    =  $request->session()->get('macc_year');
		$getcomcode = explode('-', $compName);
		$comp_code  = $getcomcode[0];
		$comp_name  = $getcomcode[1];
		$comp_cd    =$request->input('hidnCmpCd');
		$acc_cd     =$request->input('hidnAccCd');

		$ipItem_cd = $request->input('ipItemCode');

		DB::beginTransaction();

		try {
			//DB::enableQueryLog();
			DB::table('MASTER_ACC_ITEM_RATE')->where('COMP_CODE',$comp_cd)->where('ACC_CODE',$acc_cd)->delete();
			//dd(DB::getQueryLog());

			if((count($ipItem_cd) > 0) && (!empty($ipItem_cd[0]))){
	      		for($i=0;$i<count($ipItem_cd);$i++){

					$ipItemCd    = $request->input('ipItemCode');
					$explodeItem = explode('[',$ipItemCd[$i]);

					$ippackingCd    = $request->input('ipPackingCode');
					$explodepacking = explode('[',$ippackingCd[$i]);

					$data = array(
						'COMP_CODE'    =>$request->input('comp_code'),
						'COMP_NAME'    =>$request->input('comp_name'),
						'ACC_CODE'     =>$request->input('acc_code'),
						'ACC_NAME'     =>$request->input('acc_name'),
						'ITEM_CODE'    =>$explodeItem[0],
						'ITEM_NAME'    =>substr($explodeItem[1], 0, -2), 
						'PACKING_CODE' =>$explodepacking[0],
						'PACKING_NAME' =>substr($explodepacking[1], 0, -2),
						'IP_RATE'      =>$request->input('ipRate')[$i],
						'TABSTATUS'    =>'PACKING',
						'CREATED_BY'   =>$createdBy,

					);

					DB::table('MASTER_ACC_ITEM_RATE')->insert($data);

				}
			}

			$sItem_cd = $request->input('sItemCode');
		
			if((count($sItem_cd) > 0) && (!empty($sItem_cd[0]))){

				for($j=0;$j<count($sItem_cd);$j++){

					$sItemCd    = $request->input('sItemCode');
					$explodeSItem = explode('[',$sItemCd[$j]);

					$spackingCd    = $request->input('sPackingCode');
					$explodeSpacking = explode('[',$spackingCd[$j]);

					$dataS = array(
						'COMP_CODE'      =>$request->input('comp_code'),
						'COMP_NAME'      =>$request->input('comp_name'),
						'ACC_CODE'       =>$request->input('acc_code'),
						'ACC_NAME'       =>$request->input('acc_name'),
						'ITEM_CODE'    =>$explodeSItem[0],
						'ITEM_NAME'    =>substr($explodeSItem[1], 0, -2), 
						'PACKING_CODE' =>$explodeSpacking[0],
						'PACKING_NAME' =>substr($explodeSpacking[1], 0, -2),
						'S_RATE'         =>$request->input('sRate')[$j],
						'TABSTATUS'      =>'SEASONAL',
						'CREATED_BY'     =>$createdBy,

					);

					DB::table('MASTER_ACC_ITEM_RATE')->insert($dataS);

				}


			}

			$fItem_cd = $request->input('fItemCode');

	    	if((count($fItem_cd) > 0) && (!empty($fItem_cd[0]))){

	    		for($k=0;$k<count($fItem_cd);$k++){

	    			$fItemCd    = $request->input('fItemCode');
					$explodeFItem = explode('[',$fItemCd[$k]);

					$fpackingCd    = $request->input('fPackingCode');
					$explodeFpacking = explode('[',$fpackingCd[$k]);

					$dataF = array(
						'COMP_CODE'      =>$request->input('comp_code'),
						'COMP_NAME'      =>$request->input('comp_name'),
						'ACC_CODE'       =>$request->input('acc_code'),
						'ACC_NAME'       =>$request->input('acc_name'),
						'ITEM_CODE'    =>$explodeFItem[0],
						'ITEM_NAME'    =>substr($explodeFItem[1], 0, -2),
						'PACKING_CODE' =>$explodeFpacking[0],
						'PACKING_NAME' =>substr($explodeFpacking[1], 0, -2),
						'F_RATE'         =>$request->input('fRate')[$k],
						'TABSTATUS'      =>'FIXED',
						'CREATED_BY'     =>$createdBy,

					);

					DB::table('MASTER_ACC_ITEM_RATE')->insert($dataF);

	    		}
	    	}

	    	$chItem_Cd = $request->input('chItemCd');
	    	
	    	if((count($chItem_Cd) > 0) && (!empty($chItem_Cd[0]))){

	    		for($n=0;$n<count($chItem_Cd);$n++){

					$chItemCd       = $request->input('chItemCd');
					$explodechItem  = explode('[',$chItemCd[$n]);

					$chItemPkg      = $request->input('chItemPkg');
					$expchItemPkg   = explode('[',$chItemPkg[$n]);

					$chcsCd         = $request->input('chcsCd');
					$expchchcsCd    = explode('[',$chcsCd[$n]);

					$chchamberCd    = $request->input('chchamberCd');
					$expchchamberCd = explode('[',$chchamberCd[$n]);

					$chfloorCd      = $request->input('chFloorCd');
					$expchchfloorCd = explode('[',$chfloorCd[$n]);

					$chBlockCd      = $request->input('chBlockCd');
					$expchchBlockCd = explode('[',$chBlockCd[$n]);

					$dataCh = array(
						'COMP_CODE'    =>$request->input('comp_code'),
						'COMP_NAME'    =>$request->input('comp_name'),
						'ACC_CODE'     =>$request->input('acc_code'),
						'ACC_NAME'     =>$request->input('acc_name'),
						'ITEM_CODE'    =>$explodechItem[0],
						'ITEM_NAME'    =>substr($explodechItem[1], 0, -2),
						'PACKING_CODE' =>$expchItemPkg[0],
						'PACKING_NAME' =>substr($expchItemPkg[1], 0, -2),
						'CS_CODE'      =>$expchchcsCd[0],
						'CS_NAME'      =>substr($expchchcsCd[1], 0, -2),
						'CHAMBER_CODE' =>$expchchamberCd[0],
						'CHAMBER_NAME' =>substr($expchchamberCd[1], 0, -2),
						'FLOOR_CODE'   =>$expchchfloorCd[0],
						'FLOOR_NAME'   =>substr($expchchfloorCd[1], 0, -2),
						'BLOCK_CODE'   =>$expchchBlockCd[0],
						'BLOCK_NAME'   =>substr($expchchBlockCd[1], 0, -2),
						'TABSTATUS'    =>'CHAMBER',
						'CREATED_BY'   =>$createdBy,
					);

					DB::table('MASTER_ACC_ITEM_RATE')->insert($dataCh);

	    		}

	    	}

	    	$discriptn_page = "Master Acc Item Rate update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			DB::commit();

			$request->session()->flash('alert-success', 'Acc Item Rate Was Successfully Updated...!');
			return redirect('/Master/ColdStorage/View-Acc-Item-Rate-Mast');

		}catch (\Exception $e) {
			DB::rollBack();
			//throw $e;
			$request->session()->flash('alert-error', 'Acc Item Rate Can Not Added...!');
			return redirect('/Master/ColdStorage/View-Acc-Item-Rate-Mast');

		}

	}

/* ------------------ END : ACCOUNT ITEM RATE MASTER --------------- */
	

/*outward gate pass*/

	public function OutwardGatePassMast(Request $request){

		$title                    ='Add Equipment Type Master';
		
		$compName                 = $request->session()->get('company_name');
		
		$outward_slip_no          = $request->old('outward_slip_no');
		$vehicle_number           = $request->old('vehicle_number');
		$date                     = $request->old('date');
		$outward_gate_pass_Id     = $request->old('outward_gate_pass_Id');
		$outward_gate_pass__block = $request->old('outward_gate_pass__block');


    	$button='Save';
    	$action='/Master/ColdStorage/Outward-Gate-Pass-Save';
		//print_r($compData['comp_list']);exit;

		if(isset($compName)){

	    	return view('admin.finance.master.storage.outward_gate_pass',compact('title','outward_slip_no','vehicle_number','outward_gate_pass_Id','date','outward_gate_pass__block','button','action'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function SaveOutwardGatePass(Request $request){


		$validate = $this->validate($request, [

			'outward_slip_no' => 'required|max:10',
			'vehicle_number'  => 'required|max:20',
			'date'            => 'required',

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"OUTWARD_SLIP_NO" => $request->input('outward_slip_no'),
			"VEHICLE_NUMBER"  => $request->input('vehicle_number'),
			"DATE"            => $request->input('date'),
			"CREATED_BY"      => $createdBy,
			
		);

		$saveData = DB::table('MASTER_OUTWARD_GATE_PASS')->insert($data);

		$discriptn_page = "Master Outward gate pass insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Equipment Type Was Successfully Added...!');
			return redirect('/Master/ColdStorage/View-Vehicle-entry-Mast');

		} else {

			$request->session()->flash('alert-error', 'Equipment Type Can Not Added...!');
			return redirect('/Master/ColdStorage/View-Vehicle-entry-Mast');

		}

	}

	public function EditOutwardGatePassMast($id){

    	$title = 'Edit Outward Gate Pass Master';

    	$id = base64_decode($id);
    	
    	if($id!=''){
			$query                    = DB::table('MASTER_OUTWARD_GATE_PASS');
			$query->where('ID', $id);
			$classData                = $query->get()->first();
			
			$outward_slip_no          = $classData->OUTWARD_SLIP_NO;
			$vehicle_number           = $classData->VEHICLE_NUMBER;
			$date                     = $classData->DATE;
			$outward_gate_pass_Id     = $classData->ID;
			$outward_gate_pass__block = $classData->GATE_PASS_BLOCK;


			$button='Update';
			$action='/Master/ColdStorage/Outward-Gate-Pass-Update';

			return view('admin.finance.master.storage.outward_gate_pass',compact('title','outward_slip_no','vehicle_number','date','button','outward_gate_pass_Id','outward_gate_pass__block','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Type Not Found...!');
			return redirect('/Master/ColdStorage/View-Vehicle-entry-Mast');
		}

    }

    public function UpdateOutwardGatePass(Request $request){

		$validate = $this->validate($request, [

			'outward_slip_no' => 'required|max:10',
			'vehicle_number'  => 'required|max:20',
			'date'            => 'required',


		]);

		$outward_gate_pass_Id = $request->input('outward_gate_pass_Id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"OUTWARD_SLIP_NO" => $request->input('outward_slip_no'),
			"VEHICLE_NUMBER"  => $request->input('vehicle_number'),
			"DATE"            => $request->input('date'),
			"CREATED_BY"      => $createdBy,
			
		);

		try{

			$saveData = DB::table('MASTER_OUTWARD_GATE_PASS')->where('ID', $outward_gate_pass_Id)->update($data);

			$discriptn_page = "Master outward gate pass update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Outward Gate Pass Was Successfully Updated...!');
				return redirect('/Master/ColdStorage/View-Outward-Gate-Pass-Mast');

			} else {

				$request->session()->flash('alert-error', 'Outward Gate Pass Can Not Added...!');
				return redirect('/Master/ColdStorage/View-Outward-Gate-Pass-Mast');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Outward Gate Pass Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/ColdStorage/View-Outward-Gate-Pass-Mast');
		}

	}

	public function ViewOutwardGatePassMast(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Outward Gate Pass Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_OUTWARD_GATE_PASS')->orderBy('ID','DESC');
	    	
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_OUTWARD_GATE_PASS')->orderBy('ID','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.storage.view_outward_gate_pass');
    	}else{
		 	return redirect('/useractivity');
	   }
    }


    public function DeleteOutwardGatePass(Request $request){

		$deletvehicleId = $request->post('deletvehicleId');
    		
    	//	print_r($deletvehicleId);exit;

    	if ($deletvehicleId!='') {
    		try{
    			$Delete = DB::table('MASTER_OUTWARD_GATE_PASS')->where('ID', $deletvehicleId)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Outward Gate Pass Was Deleted Successfully...!');
					return redirect('/Master/ColdStorage/View-Outward-Gate-Pass-Mast');

				} else {

					$request->session()->flash('alert-error', 'Outward Gate Pass Can Not Deleted...!');
					return redirect('/Master/ColdStorage/View-Outward-Gate-Pass-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Outward Gate Pass Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/ColdStorage/View-Outward-Gate-Pass-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Equipment Type Not Found...!');
			return redirect('/Master/ColdStorage/View-Outward-Gate-Pass-Mast');

    	}

	}
/*outward gate pass*/







	// start seasonal master



/* ------ end item class master ------- */





   

   public function UpdateJobCardClosingDt(Request $request){


   		$jobcard_no = $request->input('jobcard_no');
   		$closing_date = $request->input('closing_dt');
   		$closing_dt   = date("Y-m-d", strtotime($closing_date));

   		$validate = $this->validate($request, [

				'closing_dt' => 'required',
				
		]);


   		$explode = explode(' ', $jobcard_no);

   		$series_code = $explode[1];
   		$vr_no = $explode[2];

   		$data = array(

   			'CLOSING_DATE' => $closing_dt,
   			'STATUS' => 1,


   		);

   		 $saveData = DB::table('JOBCARD_HEAD')->where('SERIES_CODE',$series_code)->where('VRNO',$vr_no)->update($data);

   		 if ($saveData) {

				$request->session()->flash('alert-success', 'Closing Date Was Successfully Inserted...!');
				return redirect('/Transaction/Maintainance/View-Job-Crad-Trans');

			} else {

				$request->session()->flash('alert-error', 'Closing Date Can Not Inserted...!');
				return redirect('/Transaction/Maintainance/View-Job-Crad-Trans');

			}



   }


   public function SaveBiltyTrans_old(Request $request)
    {
    	//print_r($request->post());exit;
    	//
			$createdBy      = $request->session()->get('userid');
			$CompanyCode    = $request->session()->get('company_name');
			$compcode       = explode('-', $CompanyCode);
			$getcompcode    = $compcode[0];
			$fisYear        = $request->session()->get('macc_year');
			$comp_nameval   = $request->input('comp_name');
			$fy_year        = $request->input('fy_year');
			$slip_no        = $request->input('slip_no');
			$storage_code   = $request->input('storage_code');
			$acc_code       = $request->input('acc_code');
			$bilty_no       = $request->input('bilty_no');
			$item_code      = $request->input('item_code');
			$packing        = $request->input('packing');
			$inward_date    = $request->input('inward_date');
			$tr_inward_date = date("Y-m-d", strtotime($inward_date));
			$bilty_date     = $request->input('bilty_date');
			$tr_bilty_date  = date("Y-m-d", strtotime($bilty_date));
			$valid_date     = $request->input('valid_date');
			$tr_valid_date  = date("Y-m-d", strtotime($valid_date));
			$rate_month     = $request->input('rate_month');
			$market_rate    = $request->input('market_rate');
			$stack_number   = $request->input('stack_number');
			$class_quality  = $request->input('class_quality');
			$identity_mark  = $request->input('identity_mark');
			$prod_cond      = $request->input('prod_cond');
			$remark         = $request->input('remark');
			$charge_type    = $request->input('charge_type');
			$chamber        = $request->input('chamber');
			$floor_storage  = $request->input('floor_storage');
			$block_storage  = $request->input('block_storage');
			$qty            = $request->input('qty');
			$count          = count($chamber);

	   
	   
	    $StoreH = DB::select("SELECT MAX(BILTYHID) as BILTYHID FROM BILTY_HEAD");
		$headID = json_decode(json_encode($StoreH), true); 
	  //  print_r($headID);exit;
	
		if(empty($headID[0]['BILTYHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['BILTYHID']+1;
		}

		$vrno_Exist = DB::table('BILTY_HEAD')->get()->first();

		if($vrno_Exist){

				$explode = explode('/', $vrno_Exist->BILTY_NO);

				$BiltyNo = $explode[1] + 1;

				$NewBiltyNo = $explode[0].'/'.'0000'.$BiltyNo;

		}else{

			 $fisYear 	=  $request->session()->get('macc_year');

		     $explode =  explode('-', $fisYear);

		     $year1 = substr($fisYear, -2);
		     $year2 = $year1 - 1;
			 $NewBiltyNo = 'BT'.$year2.'-'.$year1.'/'.'00001';
		}


	    	$datahead = array(

				'COMP_CODE'       =>$getcompcode,
				'FY_CODE'         =>$fisYear,
				'BILTYHID'        =>$head_Id,
				'INWARD_SLIP_NO'  =>$slip_no, 
				'COLD_STORG_CODE' =>$storage_code,
				'COLD_STORG_NAME' =>$storage_code,
				'ACC_CODE'        =>$acc_code,
				'ACC_NAME'        =>$acc_code,
				'BILTY_NO'        =>$NewBiltyNo,
				'ITEM_CODE'       =>$item_code,
				'ITEM_NAME'       =>$item_code,
				'PACKING'         =>$packing,
				'INWARD_SLIP_DT'  =>$tr_inward_date,
				'BUILTY_DT'       =>$tr_bilty_date,
				'RECIEPT_TILL_DT' =>$tr_valid_date,
				'RATE_PER_MONTH'  =>$rate_month,
				'MARKET_RATE'     =>$market_rate,
				'STACK_NO'        =>$stack_number,
				'CLASS_QTY'       =>$class_quality,
				'IDENTY_MARK'     =>$identity_mark,
				'COND_GOODS'      =>$prod_cond,
				'STORAGE_TYPE'    =>$charge_type,
				'CREATED_BY'      =>$createdBy,

			);


	    
	      $saveData = DB::table('BILTY_HEAD')->insert($datahead);

	      $lastid= DB::getPdo()->lastInsertId();

	      	//$discriptn_page = "Job Crad trans insert done by user";
		//	$acc_code = '';
			//$this->userLogInsert($createdBy,$trans_code,$series_code,$vr_no,$discriptn_page,$acc_code);
  			
	     //$data = array();
		for ($i = 0; $i < $count; $i++) {

			$StoreB = DB::select("SELECT MAX(JCBID) as JCBID FROM JOBCARD_BODY");

			$bodyID = json_decode(json_encode($StoreB), true); 
	
			if(empty($bodyID[0]['JCBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['JCBID']+1;
			}


			
			
			
			//	print_r('hi');exit;
			$FLAG = 0;
			

		    $data_body = array(



				'BILTYHID'        =>$head_Id,
				'BILTYBID'        =>$bodyId,
				'COMP_CODE'       =>$getcompcode,
				'FY_CODE'         =>$fisYear,
				'INWARD_SLIP_NO'  =>$slip_no,
				'COLD_STORG_CODE' =>$storage_code,
				'COLD_STORG_NAME' =>$storage_code,
				'ACC_CODE'        =>$acc_code,
				'ITEM_CODE'       =>$item_code,
				'CHAMBER'         =>$chamber[$i],
				'FLOOR_STRG'      =>$floor_storage[$i],
				'BLOCK_STRG'      =>$block_storage[$i],
				'QTY'             =>$qty[$i],
				'FLAG'            =>$FLAG,
				'CREATED_BY'      =>$createdBy,

		    );
	
		    $saveData1 = DB::table('BILTY_BODY')->insert($data_body);
			

			
			
		}

		

		if ($saveData1) {


	    			$response_array['response'] = 'success';
		            $response_array['lastid'] = $headID;
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


    public function GeneratePdfForJobCard($tCode,$headTble,$bodyTble,$headID,$head_Id,$userId,$pdfName,$vrPName){

		$response_array = array();

		$datahead = DB::SELECT("SELECT t1.*,'$headTble' as tablNme,t2.*,t4.GST_NO,t4.CITY as plant_city FROM $headTble t1  LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID  LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$headID='$head_Id'");

		$dataheadB = DB::SELECT("SELECT t1.*,'$headTble' as tablNme,t2.*,t4.GST_NO,t4.CITY as plant_city FROM $headTble t1  LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID  LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$headID='$head_Id' AND t2.ITEM_TYPE !='SR'");

		$bodyCount  = count($datahead);
		$seriesCode = $datahead[0]->SERIES_CODE;
		$compCode   = $datahead[0]->COMP_CODE;

		$dataheadB2 = DB::SELECT("SELECT t1.*,'$headTble' as tablNme,t2.*,t4.GST_NO,t4.CITY as plant_city FROM $headTble t1  LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID  LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$headID='$head_Id' AND t2.ITEM_TYPE='SR'");

		/*$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

		$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACCADD.ACC_CODE = '$accCode' AND MASTER_ACCADD.ADD1 = '$consiner'");*/

		$compDetail = DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$compCode'");

		//$dataTax = DB::SELECT("SELECT t1.*,t2.$headID FROM $taxTble t1 LEFT JOIN $headTble t2 ON t2.$headID = t1.$headID WHERE t2.$headID='$head_Id'");
		
	

		$dataConfig = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$tCode)->where('SERIES_CODE',$seriesCode)->get()->toArray();



		header('Content-Type: application/pdf');

	  $pdf = PDF::loadView('admin.finance.transaction.maintainance.jobcard_data_report',compact('dataheadB','pdfName','dataConfig','compDetail','vrPName','dataheadB2','datahead'));
              
			$path = public_path('dist/downloadpdf'); 
			$fileName =  time().'.'. 'pdf' ; 
			$pdf->save($path . '/' . $fileName);
			$PublicPath = url('public/dist/downloadpdf/');  
			$downloadPdf = $PublicPath.'/'.$fileName;
			$response_array['response'] = 'success';
			$response_array['url'] = $downloadPdf;
			$response_array['data'] = $datahead;
			$response_array['data1'] = $dataheadB2;
		    echo $data = json_encode($response_array);
					
		//$this->ConvertNoIntoWord($tCode,$seriesCode,$dataheadB,$pdfName,$dataConfig,$compDetail,$vrPName);
		

	}


	public function pdfDownloadForViewJobCrad(Request $request){

		$response_array = array();

		$uniqNo  = $request->input('uniqNo');
		$head_Id = $request->input('headId');
		$vrNo    = $request->input('vrno');
		$tCode   = $request->input('tCode');
		$userId  = $request->session()->get('userid');
		$headTble = 'JOBCARD_HEAD';
		$bodyTble = 'JOBCARD_BODY';
		$headID   = 'JCHID';
		$pdfName  = 'JOB CARD';
		$vrPName  ='JOBCARD NO';



		$datahead = DB::SELECT("SELECT t1.*,'$headTble' as tablNme,t2.*,t4.GST_NO,t4.CITY as plant_city FROM $headTble t1  LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID  LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$headID='$head_Id'");

		$dataheadB = DB::SELECT("SELECT t1.*,'$headTble' as tablNme,t2.*,t4.GST_NO,t4.CITY as plant_city FROM $headTble t1  LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID  LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$headID='$head_Id' AND t2.ITEM_TYPE !='SR'");

		$bodyCount  = count($datahead);
		$seriesCode = $datahead[0]->SERIES_CODE;
		$compCode   = $datahead[0]->COMP_CODE;

		$dataheadB2 = DB::SELECT("SELECT t1.*,'$headTble' as tablNme,t2.*,t4.GST_NO,t4.CITY as plant_city FROM $headTble t1  LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID  LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$headID='$head_Id' AND t2.ITEM_TYPE='SR'");


		$compDetail = DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$compCode'");


		$dataConfig = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$tCode)->where('SERIES_CODE',$seriesCode)->get()->toArray();


		header('Content-Type: application/pdf');

	   $pdf = PDF::loadView('admin.finance.transaction.maintainance.jobcard_data_report',compact('dataheadB','pdfName','dataConfig','compDetail','vrPName','dataheadB2','datahead'));
              
			$path                       = public_path('dist/downloadpdf'); 
			$fileName                   =  time().'.'. 'pdf' ; 
			$pdf->save($path . '/' . $fileName);
			$PublicPath                 = url('public/dist/downloadpdf/');  
			$downloadPdf                = $PublicPath.'/'.$fileName;
			$response_array['response'] = 'success';
			$response_array['url']      = $downloadPdf;
			$response_array['data']     = $datahead;
			$response_array['data1']    = $dataheadB2;
			echo $data                  = json_encode($response_array);
					


	}


function ConvertNoIntoWord($tCode,$seriesCode,$dataheadB,$pdfName,$dataConfig,$compDetail,$vrPName)
{

	$response_array = array();

 	//$num   = $request->input('amt');
 	

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

	$pdf = PDF::loadView('admin.finance.transaction.maintainance.jobcard_data_report',compact('dataheadB','pdfName','dataConfig','compDetail','vrPName','numwords'));
              
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

    


    public function ViewChildBiltyTrans(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$bilty_no   = $request->input('bilty_no');
		   	$headid = $request->input('tblid');

	    	$bilty = DB::table('BILTY_BODY')->where('BILTYHID', $headid)->get()->toArray();
	    	

    		if($bilty) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $bilty;
	         

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


/* --------- create entry in USER_LOG when user submit any form ------*/

	function userLogInsert($loginuserId,$perticular){
		
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
				'PERTICULAR'  =>$discptn,
				'CREATED_BY'  =>$loginuserId
			);
			DB::table('USER_LOG')->insert($userLog);
		
	}

/* --------- create entry in USER_LOG when user submit any form ------*/




public function Get_Bilty_Data_Item(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	//$accCode = $request->input('accCode');

	    	$bilty_no = $request->input('bilty_no');


	    
	    	$bilty_data = DB::table('BILTY_HEAD')->where('BILTY_NO', $bilty_no)->get()->first();
	    	

	    	

	    	

		    if ($bilty_data) {

						$response_array['response']   = 'success';
						$response_array['data']       = $bilty_data;

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

/* ------------------- START : AJAX FUNCTION --------------------- */
	
	public function GetPrevStorageData(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$fieldOne    = $request->input('field1');
			$fieldTwo    = $request->input('field2');
			$fieldThree  = $request->input('field3');
			$fieldFour   = $request->input('field4');
			$masterName  = $request->input('master');
			$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];

			$coldStorage = DB::table('MASTER_COLD_STORAGE')->where('COMP_CODE', $getcompcode)->where('CS_CODE', $fieldOne)->get()->first();

	    	if($masterName == 'COLDSTORAGE'){

				$chamberData  = DB::table('MASTER_CHAMBER')->where('COMP_CODE', $getcompcode)->where('CS_CODE', $fieldOne)->get()->toArray();
				$floorData    = '';
				$blockData    = '';
				$balSpaceData = '';

	    	}else if($masterName == 'CHAMBERSTORAGE'){

				$chamberData  ='';
				$floorData    = DB::table('MASTER_FLOOR_STORAGE')->where('COMP_CODE', $getcompcode)->where('CS_CODE', $fieldOne)->where('CHAMBER_CODE', $fieldTwo)->get()->toArray();
				$blockData    = '';
				$balSpaceData = '';

	    	}else if($masterName == 'FLOORSTORAGE'){

				$chamberData   ='';
				$floorData     ='';
				$blockData     = DB::table('MASTER_BLOCK_STORAGE')->where('COMP_CODE', $getcompcode)->where('CS_CODE', $fieldOne)->where('CHAMBER_CODE', $fieldTwo)->where('FLOOR_CODE', $fieldThree)->get()->toArray();
				$balSpaceData = '';

	    	}else if($masterName == 'BLOCKSTORAGE'){

				$chamberData  ='';
				$floorData    ='';
				$blockData    ='';
				$balSpaceData = DB::table('CS_BALENCE')->where('COMP_CODE', $getcompcode)->where('CS_CODE', $fieldOne)->where('CHAMBER_CODE', $fieldTwo)->where('FLOOR_CODE', $fieldThree)->where('BLOCK_CODE', $fieldFour)->get()->toArray();
				
	    	}else{
				$chamberData  ='';
				$floorData    ='';
				$blockData    = '';
				$balSpaceData = '';
	    	}

    		if($chamberData || $floorData || $blockData || $coldStorage || $balSpaceData) {

				$response_array['response']         = 'success';
				$response_array['coldStorage_list'] = $coldStorage;
				$response_array['chamber_list']     = $chamberData;
				$response_array['floor_list']       = $floorData;
				$response_array['block_list']       = $blockData;
				$response_array['bal_space_data']   = $balSpaceData;
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response']         = 'error';
				$response_array['coldStorage_list'] = '';
				$response_array['chamber_list']     = '' ;
				$response_array['floor_list']       = '' ;
				$response_array['block_list']       = '' ;
				$response_array['bal_space_data']   = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

				$response_array['response']         = 'error';
				$response_array['coldStorage_list'] = '';
				$response_array['chamber_list']     = '' ;
				$response_array['floor_list']       = '' ;
				$response_array['block_list']       = '' ;
				$response_array['bal_space_data']   = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function GetItemPackingAgainstItem(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tblName   = $request->input('tblName');
			$fieldName   = $request->input('fieldName');
			$compName  = $request->session()->get('company_name');
			$splitData = explode('-', $compName);
			$comp_code = $splitData[0];

			if($tblName == 'ItemPack'){

				$ItemPacking = DB::table('MASTER_ITEM_PACKING')->where('ITEM_CODE',$fieldName)->get();
				$csdataList='';
			}else if($tblName == 'Block'){
				$csdataList = DB::table('MASTER_BLOCK_STORAGE')->where('COMP_CODE', $comp_code)->where('BLOCK_CODE', $fieldName)->get()->first();
				$ItemPacking ='';
			}
		
    		if($ItemPacking || $csdataList) {

				$response_array['response']        = 'success';
				$response_array['ItemPackingList'] = $ItemPacking;
				$response_array['data_List']       = $csdataList;
			
	           	echo $data = json_encode($response_array);

			}else{

				$response_array['response']        = 'error';
				$response_array['ItemPackingList'] = '';
				$response_array['data_List']       = '';
                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

				$response_array['response']         = 'error';
				$response_array['ItemPackingList'] = '';
				$response_array['data_List']       = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

/* ------------------- END : AJAX FUNCTION --------------------- */

}

?>