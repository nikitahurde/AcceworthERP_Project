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


class MaintenanceController extends Controller{

	//public $data;

	public function __construct(Request $request){

		//$this->data = "smit@121";

	}



	/* ---------- start Equipment master ---------- */

	public function EquipmentMast(Request $request){

		$title             = 'Add Equipment';
		
		$compName          = $request->session()->get('company_name');
		
		$equipment_code    = $request->old('equipment_code');
		$equipment_name    = $request->old('equipment_name');
		$eqptgroup_name    = $request->old('eqptgroup_name');
		$eqptcatg_name     = $request->old('eqptcatg_name');
		$eqptclass_name    = $request->old('eqptclass_name');
		$eqpttype_name     = $request->old('eqpttype_name');
		$eqptlocation_name = $request->old('eqptlocation_name');
		$eqptactivity_name = $request->old('eqptactivity_name');
		$equipment_id      = $request->old('id');
		$equipment_block   = $request->old('equipment_block');




		$userData['itemgrp_mst_list']   = DB::table('MASTER_EQP')->get();
		
		$userData['group_code_list']    = DB::table('MASTER_EQPGROUP')->where('EQPGROUP_BLOCK','NO')->get();
		
		$userData['catg_code_list']     = DB::table('MASTER_EQPCATG')->get();
		
		$userData['class_code_list']    = DB::table('MASTER_EQPCLASS')->get();

		$userData['type_code_list']     = DB::table('MASTER_EQPTYPE')->get();
		
		$userData['location_code_list'] = DB::table('MASTER_EQPLOCATION')->get();
		
		$userData['activity_code_list'] = DB::table('MASTER_EQPACTIVITY')->get();

		$button='Save';

    	$action='/Master/Maintenance/Equipment-Save';

		if(isset($compName)){

	    	return view('admin.finance.master.equipment.equipment_mast',$userData+compact('title','equipment_code','equipment_name','eqptgroup_name','eqptcatg_name','eqptclass_name','eqpttype_name','eqptlocation_name','eqptactivity_name','equipment_id','equipment_block','action','button'));

	    }else{

			return redirect('/useractivity');
		}

	}

	public function SaveEquipmentMast(Request $request){

		$compName  = $request->session()->get('company_name');
		$fisYear   =  $request->session()->get('macc_year');
		$loginuser = $request->session()->get('userid');

		$validate = $this->validate($request, [


				'equipment_code'     => 'required|max:6|unique:MASTER_EQP,EQP_CODE',
				'equipment_name'     => 'required|max:40',
				'equipment_group'    => 'required|max:6',
				'equipment_catg'     => 'required|max:6',
				'equipment_class'    => 'required|max:6',
				'equipment_type'     => 'required|max:6',
				'equipment_location' => 'required|max:6',
				'equipment_activity' => 'required|max:6',

		]);


		$data = array(
					"EQP_CODE"         =>  $request->input('equipment_code'),
					"EQP_NAME"         =>  $request->input('equipment_name'),
					"EQPGROUP_CODE"    =>  $request->input('equipment_group'),
					"EQPCATG_CODE"     =>  $request->input('equipment_catg'),
					"EQPCLASS_CODE"    =>  $request->input('equipment_class'),
					"EQPTYPE_CODE"     =>  $request->input('equipment_type'),
					"EQPLOCATION_CODE" =>  $request->input('equipment_location'),
					"EQPACTIVITY_CODE" =>  $request->input('equipment_activity'),
					"CREATED_BY"       =>  $request->session()->get('userid'),
	    	);

		$saveData = DB::table('MASTER_EQP')->insert($data);

		$discriptn_page = "Master equipment insert done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Equipment  Was Successfully Added...!');
			return redirect('/Master/Maintenance/View-Equipment-Mast');

		} else {

			$request->session()->flash('alert-error', 'Equipment  Can Not Added...!');
			return redirect('/Master/Maintenance/View-Equipment-Mast');

		}

	}

	public function ViewEquipmentMast(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	       	$title = 'View Equipment';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 	$data = DB::table('MASTER_EQP')->orderBy('EQP_CODE','DESC');

	    	}
	    	elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_EQP')->orderBy('EQP_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

    	 	return DataTables()->of($data)->addIndexColumn()->toJson();

		}	
		if(isset($compName)){
	    	return view('admin.finance.master.equipment.view_equipment_mast');
		}else{
			return redirect('/useractivity');
		}

    }


    public function DeleteEquipmentMast(Request $request){

        $id = $request->input('equipmentid');

       // print_r($id);exit;

        if ($id!='') {

        	try{

			$Delete = DB::table('MASTER_EQP')->where('EQP_CODE', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Equipment  Data Was Deleted Successfully...!');
			return redirect('/Master/Maintenance/View-Equipment-Mast');

			} else {

			$request->session()->flash('alert-error', 'Equipment Data Can Not Deleted...!');
			return redirect('/Master/Maintenance/View-Equipment-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Equipment be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Maintenance/View-Equipment-Mast');
			}

		}else{

		$request->session()->flash('alert-error', 'Equipment Data Not Found...!');
		return redirect('/Master/Maintenance/View-Equipment-Mast');

		}
	}


	public function EditEquipmentMast($id){

    	$title = 'Edit Item Group';

    	//print_r($id);
    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('MASTER_EQP');
			$query->where('EQP_CODE', $id);
			$classData= $query->get()->first();

			$equipment_code    = $classData->EQP_CODE;
			$equipment_name    = $classData->EQP_NAME;
			$eqptgroup_name    = $classData->EQPGROUP_CODE;
			$eqptcatg_name     = $classData->EQPCATG_CODE;
			$eqptclass_name    = $classData->EQPCLASS_CODE;
			$eqpttype_name     = $classData->EQPTYPE_CODE;
			$eqptlocation_name = $classData->EQPLOCATION_CODE;
			$eqptactivity_name = $classData->EQPACTIVITY_CODE;
			$equipment_id      = $classData->EQP_CODE;
			$equipment_block   = $classData->EQP_BLOCK;


			$userData['itemgrp_mst_list'] = DB::table('MASTER_EQP')->Orderby('EQP_CODE', 'desc')->limit(5)->get();
		$userData['group_code_list'] = DB::table('MASTER_EQPGROUP')->Orderby('EQPGROUP_CODE', 'desc')->get();
		$userData['catg_code_list'] = DB::table('MASTER_EQPCATG')->Orderby('EQPCATG_CODE', 'desc')->get();

		$userData['class_code_list'] = DB::table('MASTER_EQPCLASS')->Orderby('EQPCLASS_CODE', 'desc')->get();
		$userData['type_code_list'] = DB::table('MASTER_EQPTYPE')->Orderby('EQPTYPE_CODE', 'desc')->get();

		$userData['location_code_list'] = DB::table('MASTER_EQPLOCATION')->Orderby('EQPLOCATION_CODE', 'desc')->get();

		$userData['activity_code_list'] = DB::table('MASTER_EQPACTIVITY')->Orderby('EQPACTIVITY_CODE', 'desc')->get();



			$button='Update';
			$action='/Master/Maintenance/Equipment-Update';

			return view('admin.finance.master.equipment.equipment_mast',$userData+compact('title','equipment_code','equipment_name','eqptgroup_name','eqptcatg_name','eqptclass_name','eqpttype_name','eqptlocation_name','eqptactivity_name','equipment_id','equipment_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Equipment Not Found...!');
			return redirect('/Master/Maintenance/View-Equipment-Mast');
		}

    }

    public function UpdateEquipmentMast(Request $request){



		$validate = $this->validate($request, [


				'equipment_code'     => 'required|max:6',
				'equipment_name'     => 'required|max:40',
				'equipment_group'    => 'required|max:6',
				'equipment_catg'     => 'required|max:6',
				'equipment_class'    => 'required|max:6',
				'equipment_type'     => 'required|max:6',
				'equipment_location' => 'required|max:6',
				'equipment_activity' => 'required|max:6',

		]);


       $id = $request->input('idgroup');
       $updatedDate = date("Y-m-d  H:i:s");
       $loginUser  = $request->session()->get('userid');

       $data = array(
					"EQP_CODE"         =>  $request->input('equipment_code'),
					"EQP_NAME"         =>  $request->input('equipment_name'),
					"EQPGROUP_CODE"    =>  $request->input('equipment_group'),
					"EQPCATG_CODE"     =>  $request->input('equipment_catg'),
					"EQPCLASS_CODE"    =>  $request->input('equipment_class'),
					"EQPTYPE_CODE"     =>  $request->input('equipment_type'),
					"EQPLOCATION_CODE" =>  $request->input('equipment_location'),
					"EQPACTIVITY_CODE" =>  $request->input('equipment_activity'),
					"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
				    "LAST_UPDATE_DATE" =>  $updatedDate
	    	);

		
		try{
		$saveData = DB::table('MASTER_EQP')->where('EQP_CODE', $id)->update($data);

		$discriptn_page = "Master equipment update done by user";
		$this->userLogInsert($loginUser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Equipment  Was Successfully Updated...!');
				return redirect('/Master/Maintenance/View-Equipment-Mast');

			} else {

				$request->session()->flash('alert-error', 'Equipment Can Not Updated...!');
				return redirect('/Master/Maintenance/View-Equipment-Mast');

			}
		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Equipment be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Maintenance/View-Equipment-Mast');
		}


	}
/* ---------- start item type master ------------ */

	public function EquipmentType(Request $request){

		$title        ='Add Equipment Type Master';

		$compName 	= $request->session()->get('company_name');
		
		$eqptype_code  = $request->old('eqptype_code');
		$eqptype_name  = $request->old('eqptype_name');
		$eqptype_id    = $request->old('eqptype_id');
		$eqptype_block = $request->old('eqptype_block');



		$userData['eqp_mst_list'] = DB::table('MASTER_EQPTYPE')->Orderby('EQPTYPE_CODE', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/Master/Maintenance/Equipment-Type-Save';
		//print_r($compData['comp_list']);exit;

		if(isset($compName)){

	    	return view('admin.finance.master.equipment.equipment_type',$userData+compact('title','eqptype_code','eqptype_name','eqptype_id','eqptype_block','button','action'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function SaveEquipmentType(Request $request){


		$validate = $this->validate($request, [

			'eqptype_code' => 'required|max:6|unique:MASTER_EQPTYPE,EQPTYPE_CODE',
			'eqptype_name' => 'required|max:40',

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"EQPTYPE_CODE"  => $request->input('eqptype_code'),
			"EQPTYPE_NAME" => $request->input('eqptype_name'),
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData = DB::table('MASTER_EQPTYPE')->insert($data);

		$discriptn_page = "Master Equipment type insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Equipment Type Was Successfully Added...!');
			return redirect('/Master/Maintenance/View-Equipment-Type-Mast');

		} else {

			$request->session()->flash('alert-error', 'Equipment Type Can Not Added...!');
			return redirect('/Master/Maintenance/View-Equipment-Type-Mast');

		}

	}

	public function EditEquipmentType($id){

    	$title = 'Edit Type Master';

    	$id = base64_decode($id);
    	
    	if($id!=''){
    	    $query = DB::table('MASTER_EQPTYPE');
			$query->where('EQPTYPE_CODE', $id);
			$classData= $query->get()->first();

			$eqptype_code  = $classData->EQPTYPE_CODE;
			$eqptype_name  = $classData->EQPTYPE_NAME;
			$eqptype_id    = $classData->EQPTYPE_CODE;
			$eqptype_block = $classData->EQPTYPE_BLOCK;


			$userData['post_list'] = DB::table('MASTER_GL')->get();

			$button='Update';
			$action='/Master/Maintenance/Equipment-Type-Update';

			return view('admin.finance.master.equipment.equipment_type',$userData+compact('title','eqptype_code','eqptype_name','eqptype_id','eqptype_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Type Not Found...!');
			return redirect('/Master/Maintenance/View-Equipment-Type-Mast');
		}

    }

    public function UpdateEquipmentType(Request $request){

		$validate = $this->validate($request, [

			'eqptype_code' => 'required|max:6',
			'eqptype_name' => 'required|max:40',

		]);

		$eqptype_id = $request->input('eqptype_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d  H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"EQPTYPE_CODE"     => $request->input('eqptype_code'),
			"EQPTYPE_NAME"     => $request->input('eqptype_name'),
			"EQPTYPE_BLOCK"    => $request->input('eqptype_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		try{

			$saveData = DB::table('MASTER_EQPTYPE')->where('EQPTYPE_CODE', $eqptype_id)->update($data);

			$discriptn_page = "Master equipment type update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item type Was Successfully Updated...!');
				return redirect('/Master/Maintenance/View-Equipment-Type-Mast');

			} else {

				$request->session()->flash('alert-error', 'Item type Can Not Added...!');
				return redirect('/Master/Maintenance/View-Equipment-Type-Mast');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Item Type Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Maintenance/View-Equipment-Type-Mast');
		}

	}

	public function ViewEquipmentType(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Equipment Type Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_EQPTYPE')->orderBy('EQPTYPE_CODE','DESC');
	    	
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_EQPTYPE')->orderBy('EQPTYPE_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.equipment.view_equipment_type');
    	}else{
		 	return redirect('/useractivity');
	   }
    }


    public function DeleteEquipmentType(Request $request){

		$typeId = $request->post('typeId');
    	

    	if ($typeId!='') {
    		try{
    			$Delete = DB::table('MASTER_EQPTYPE')->where('EQPTYPE_CODE', $typeId)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Equipment Type Was Deleted Successfully...!');
					return redirect('/Master/Maintenance/View-Equipment-Type-Mast');

				} else {

					$request->session()->flash('alert-error', 'Equipment Type Can Not Deleted...!');
					return redirect('/Master/Maintenance/View-Equipment-Type-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Equipment Type Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Maintenance/View-Equipment-Type-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Equipment Type Not Found...!');
			return redirect('/Master/Maintenance/View-Equipment-Type-Mast');

    	}

	}



	public function EquipmentLocation(Request $request){

		$title        ='Add Equipment Type Master';

		$compName 	= $request->session()->get('company_name');
		
		$eqplocation_code  = $request->old('eqplocation_code');
		$eqplocation_name  = $request->old('eqplocation_name');
		$eqplocation_id    = $request->old('eqplocation_id');
		$eqplocation_block = $request->old('eqplocation_block');



		$userData['eqp_mst_list'] = DB::table('MASTER_EQPLOCATION')->Orderby('EQPLOCATION_CODE', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/Master/Maintenance/Equipment-Location-Save';
		//print_r($compData['comp_list']);exit;

		if(isset($compName)){

	    	return view('admin.finance.master.equipment.equipment_location',$userData+compact('title','eqplocation_code','eqplocation_name','eqplocation_id','eqplocation_block','button','action'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function SaveEquipmentLocation(Request $request){


		$validate = $this->validate($request, [

			'eqplocation_code' => 'required|max:6|unique:MASTER_EQPLOCATION,EQPLOCATION_CODE',
			'eqplocation_name' => 'required|max:40',

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"EQPLOCATION_CODE"  => $request->input('eqplocation_code'),
			"EQPLOCATION_NAME" => $request->input('eqplocation_name'),
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData = DB::table('MASTER_EQPLOCATION')->insert($data);

		$discriptn_page = "Master Equipment location insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Equipment location Was Successfully Added...!');
			return redirect('/Master/Maintenance/View-Equipment-Location-Mast');

		} else {

			$request->session()->flash('alert-error', 'Equipment location Can Not Added...!');
			return redirect('/Master/Maintenance/View-Equipment-Location-Mast');

		}

	}

	public function EditEquipmentLocation($id){

    	$title = 'Edit Equipment Location Master';

    	$id = base64_decode($id);
    	
    	if($id!=''){
    	    $query = DB::table('MASTER_EQPLOCATION');
			$query->where('EQPLOCATION_CODE', $id);
			$classData= $query->get()->first();

			//print_r($id);exit;

			$eqplocation_code  = $classData->EQPLOCATION_CODE;
			$eqplocation_name  = $classData->EQPLOCATION_NAME;
			$eqplocation_id    = $classData->EQPLOCATION_CODE;
			$eqplocation_block = $classData->EQPLOCATION_BLOCK;


			$userData['post_list'] = DB::table('MASTER_GL')->get();

			$button='Update';
			$action='/Master/Maintenance/Equipment-Location-Update';

			return view('admin.finance.master.equipment.equipment_location',$userData+compact('title','eqplocation_code','eqplocation_name','eqplocation_id','eqplocation_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Equipment Location Not Found...!');
			return redirect('/Master/Maintenance/View-Equipment-Location-Mast');
		}

    }

    public function UpdateEquipmentLocation(Request $request){

		$validate = $this->validate($request, [

			'eqplocation_code' => 'required|max:6',
			'eqplocation_name' => 'required|max:40',

		]);

		$eqplocation_id = $request->input('eqplocation_id');

		//print_r($eqplocation_id);exit;

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d  H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"EQPLOCATION_CODE"  => $request->input('eqplocation_code'),
			"EQPLOCATION_NAME"  => $request->input('eqplocation_name'),
			"EQPLOCATION_BLOCK" => $request->input('eqplocation_block'),
			"LAST_UPDATE_BY"    => $createdBy,
			"LAST_UPDATE_DATE"  => $updatedDate,
			
		);

		try{

			$saveData = DB::table('MASTER_EQPLOCATION')->where('EQPLOCATION_CODE', $eqplocation_id)->update($data);

			$discriptn_page = "Master equipment Location update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Equipment Location Was Successfully Updated...!');
				return redirect('/Master/Maintenance/View-Equipment-Location-Mast');

			} else {

				$request->session()->flash('alert-error', 'Equipment Location Can Not Added...!');
				return redirect('//Master/Maintenance/View-Equipment-Location-Mast');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Equipment Location Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Maintenance/View-Equipment-Location-Mast');
		}

	}

	public function ViewEquipmentLocation(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Equipment Location Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_EQPLOCATION')->orderBy('EQPLOCATION_CODE','DESC');
	    	
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_EQPLOCATION')->orderBy('EQPLOCATION_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.equipment.view_equipment_location');
    	}else{
		 	return redirect('/useractivity');
	   }
    }


    public function DeleteEquipmentLocation(Request $request){

		$locationId = $request->post('locationId');
    	

    	if ($locationId!='') {
    		try{
    			$Delete = DB::table('MASTER_EQPLOCATION')->where('EQPLOCATION_CODE', $locationId)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Equipment Location Was Deleted Successfully...!');
					return redirect('/Master/Maintenance/View-Equipment-Location-Mast');

				} else {

					$request->session()->flash('alert-error', 'Equipment Location Can Not Deleted...!');
					return redirect('/Master/Maintenance/View-Equipment-Location-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Equipment Location Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Maintenance/View-Equipment-Location-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Equipment Location Not Found...!');
			return redirect('/Master/Maintenance/View-Equipment-Location-Mast');

    	}

	}


	/*maintainance activity*/

	public function EquipmentActivity(Request $request){

		$title        ='Add Equipment Type Master';

		$compName 	= $request->session()->get('company_name');
		
		$eqpactivity_code  = $request->old('eqpactivity_code');
		$eqpactivity_name  = $request->old('eqpactivity_name');
		$eqpactivity_id    = $request->old('eqpactivity_id');
		$eqpactivity_block = $request->old('eqpactivity_block');



		$userData['eqp_mst_list'] = DB::table('MASTER_EQPACTIVITY')->Orderby('EQPACTIVITY_CODE', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/Master/Maintenance/Equipment-Activity-Save';
		//print_r($compData['comp_list']);exit;

		if(isset($compName)){

	    	return view('admin.finance.master.equipment.equipment_activity',$userData+compact('title','eqpactivity_code','eqpactivity_name','eqpactivity_id','eqpactivity_block','button','action'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function SaveEquipmentActivity(Request $request){


		$validate = $this->validate($request, [

			'eqpactivity_code' => 'required|max:6|unique:MASTER_EQPACTIVITY,EQPACTIVITY_CODE',
			'eqpactivity_name' => 'required|max:40',

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"EQPACTIVITY_CODE"  => $request->input('eqpactivity_code'),
			"EQPACTIVITY_NAME" => $request->input('eqpactivity_name'),
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData = DB::table('MASTER_EQPACTIVITY')->insert($data);

		$discriptn_page = "Master Equipment Activity insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Equipment Activity Was Successfully Added...!');
			return redirect('/Master/Maintenance/View-Equipment-Activity-Mast');

		} else {

			$request->session()->flash('alert-error', 'Equipment Activity Can Not Added...!');
			return redirect('/Master/Maintenance/View-Equipment-Activity-Mast');

		}

	}

	public function EditEquipmentActivity($id){

    	$title = 'Edit Equipment Activity Master';

    	$id = base64_decode($id);
    	
    	if($id!=''){
    	    $query = DB::table('MASTER_EQPACTIVITY');
			$query->where('EQPACTIVITY_CODE', $id);
			$classData= $query->get()->first();

			//print_r($id);exit;

			$eqpactivity_code  = $classData->EQPACTIVITY_CODE;
			$eqpactivity_name  = $classData->EQPACTIVITY_NAME;
			$eqpactivity_id    = $classData->EQPACTIVITY_CODE;
			$eqpactivity_block = $classData->EQPACTIVITY_BLOCK;


			$userData['post_list'] = DB::table('MASTER_GL')->get();

			$button='Update';
			$action='/Master/Maintenance/Equipment-Activity-Update';

			return view('admin.finance.master.equipment.equipment_activity',$userData+compact('title','eqpactivity_code','eqpactivity_name','eqpactivity_id','eqpactivity_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Equipment Activity Not Found...!');
			return redirect('/Master/Maintenance/View-Equipment-Activity-Mast');
		}

    }

    public function UpdateEquipmentActivity(Request $request){

		$validate = $this->validate($request, [

			'eqpactivity_code' => 'required|max:6',
			'eqpactivity_name' => 'required|max:40',

		]);

		$eqpactivity_id = $request->input('eqpactivity_id');

		//print_r($eqplocation_id);exit;

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d  H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"EQPACTIVITY_CODE"  => $request->input('eqpactivity_code'),
			"EQPACTIVITY_NAME"  => $request->input('eqpactivity_name'),
			"EQPACTIVITY_BLOCK" => $request->input('eqpactivity_block'),
			"LAST_UPDATE_BY"    => $createdBy,
			"LAST_UPDATE_DATE"  => $updatedDate,
			
		);

		try{

			$saveData = DB::table('MASTER_EQPACTIVITY')->where('EQPACTIVITY_CODE', $eqpactivity_id)->update($data);

			$discriptn_page = "Master equipment activity update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Equipment Activity Was Successfully Updated...!');
				return redirect('/Master/Maintenance/View-Equipment-Activity-Mast');

			} else {

				$request->session()->flash('alert-error', 'Equipment Activity Can Not Added...!');
				return redirect('//Master/Maintenance/View-Equipment-Activity-Mast');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Equipment Activity Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Maintenance/View-Equipment-Activity-Mast');
		}

	}

	public function ViewEquipmentActivity(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Equipment Activity Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_EQPACTIVITY')->orderBy('EQPACTIVITY_CODE','DESC');
	    	
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_EQPACTIVITY')->orderBy('EQPACTIVITY_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.equipment.view_equipment_activity');
    	}else{
		 	return redirect('/useractivity');
	   }
    }


    public function DeleteEquipmentActivity(Request $request){

		$locationId = $request->post('locationId');
    	

    	if ($locationId!='') {
    		try{
    			$Delete = DB::table('MASTER_EQPACTIVITY')->where('EQPACTIVITY_CODE', $locationId)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Equipment Activity Was Deleted Successfully...!');
					return redirect('/Master/Maintenance/View-Equipment-Activity-Mast');

				} else {

					$request->session()->flash('alert-error', 'Equipment Activity Can Not Deleted...!');
					return redirect('/Master/Maintenance/View-Equipment-Activity-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Equipment Activity Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Maintenance/View-Equipment-Activity-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Equipment Activity Not Found...!');
			return redirect('/Master/Maintenance/View-Equipment-Activity-Mast');

    	}

	}
	/*maintainance activity*/

/*search Item type code when click on help button*/
	
	public function HelpItemTypeSearch(Request $request){

		$response_array = array();

	    $ItemType_H = $request->input('ItemTypeH');

		if ($request->ajax()) {

	    	$item_type_by_help = DB::select("SELECT * FROM `MASTER_ITEMTYPE` WHERE ITEMTYPE_CODE='$ItemType_H' OR ITEM_TYPE_NAME='$ItemType_H' OR ITEMTYPE_CODE Like '$ItemType_H%' OR ITEM_TYPE_NAME LIKE '$ItemType_H%' ORDER BY ITEMTYPE_CODE DESC limit 5  ");
	    	
    		if ($item_type_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_type_by_help ;

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

/*search Item type code when click on help button*/


/*search Item type code on input*/

	public function search_ItemTypeCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$ItemType_code = $request->input('itemTypeSearch');

	    	$itemtype_list = DB::select("SELECT * FROM `MASTER_ITEMTYPE` WHERE ITEMTYPE_CODE LIKE '$ItemType_code%'");

	    	$count = count($itemtype_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemtype_list ;

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

/*search Item type code on input type*/



/* ---------- end item type master ------------ */


/* ---------- start item group master ---------- */

	public function EquipmentGroup(Request $request){

		$title = 'Add Equipment Group';

		$compName 	= $request->session()->get('company_name');

		$equipmentgroup_code = $request->old('equipmentgroup_code');
		$equipmentgroup_name = $request->old('equipmentgroup_name');
		$equipmentgroup_id   = $request->old('id');
		$group_block    = $request->old('group_block');

		$userData['itemgrp_mst_list'] = DB::table('MASTER_ITEMGROUP')->Orderby('ITEMGROUP_CODE', 'desc')->limit(5)->get();

		$button='Save';

    	$action='/Master/Maintenance/Equipment-Group-Save';

		if(isset($compName)){

	    	return view('admin.finance.master.equipment.equipment_group',$userData+compact('title','equipmentgroup_code','equipmentgroup_name','equipmentgroup_id','group_block','action','button'));

	    }else{

			return redirect('/useractivity');
		}

	}

	public function SaveEquipmentGroup(Request $request){

		$compName  = $request->session()->get('company_name');
		$fisYear   =  $request->session()->get('macc_year');
		$loginuser = $request->session()->get('userid');

		$validate = $this->validate($request, [


				'equipmentgroup_code' => 'required|max:6|unique:MASTER_EQPGROUP,EQPGROUP_CODE',
				'equipmentgroup_name' => 'required|max:40',

		]);


		$data = array(
					"EQPGROUP_CODE" =>  $request->input('equipmentgroup_code'),
					"EQPGROUP_NAME" =>  $request->input('equipmentgroup_name'),
					"CREATED_BY"     =>  $request->session()->get('userid'),
	    	);

		$saveData = DB::table('MASTER_EQPGROUP')->insert($data);

		$discriptn_page = "Master item group insert done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Group Was Successfully Added...!');
			return redirect('/Master/Maintenance/View-Equipment-Group-Mast');

		} else {

			$request->session()->flash('alert-error', 'Item Group Can Not Added...!');
			return redirect('/Master/Maintenance/View-Equipment-Group-Mast');

		}

	}

	public function ViewEquipmentGroup(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	       	$title = 'View Item Group';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 	$data = DB::table('MASTER_EQPGROUP')->orderBy('EQPGROUP_CODE','DESC');

	    	}
	    	elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_EQPGROUP')->orderBy('EQPGROUP_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

    	 	return DataTables()->of($data)->addIndexColumn()->toJson();

		}	
		if(isset($compName)){
	    	return view('admin.finance.master.equipment.view_equipment_group');
		}else{
			return redirect('/useractivity');
		}

    }


    public function DeleteEquipmentgroup(Request $request){

        $id = $request->input('equipmentgroupid');

       // print_r($id);exit;

        if ($id!='') {

        	try{

			$Delete = DB::table('MASTER_EQPGROUP')->where('EQPGROUP_CODE', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Equipment Group Data Was Deleted Successfully...!');
			return redirect('/Master/Maintenance/View-Equipment-Group-Mast');

			} else {

			$request->session()->flash('alert-error', 'Item Group Data Can Not Deleted...!');
			return redirect('/Master/Maintenance/View-Equipment-Group-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Group be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Maintenance/View-Equipment-Group-Mast');
			}

		}else{

		$request->session()->flash('alert-error', 'Item Group Data Not Found...!');
		return redirect('/Master/Maintenance/View-Equipment-Group-Mast');

		}
	}


	public function EditEquipmentGroup($id){

    	$title = 'Edit Item Group';

    	//print_r($id);
    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('MASTER_EQPGROUP');
			$query->where('EQPGROUP_CODE', $id);
			$classData= $query->get()->first();

			$equipmentgroup_code = $classData->EQPGROUP_CODE;
			$equipmentgroup_name = $classData->EQPGROUP_CODE;
			$equipmentgroup_id   = $classData->EQPGROUP_CODE;
			$group_block         = $classData->EQPGROUP_BLOCK;

			$button='Update';
			$action='/Master/Maintenance/Equipment-Group-Update';

			return view('admin.finance.master.equipment.equipment_group',compact('title','equipmentgroup_code','equipmentgroup_name','equipmentgroup_id','group_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Equioment Group Not Found...!');
			return redirect('/Master/Maintenance/View-Equipment-Group-Mast');
		}

    }

    public function UpdateEquipmentGroup(Request $request){



		$validate = $this->validate($request, [

				'equipmentgroup_code' => 'required|max:6',
				'equipmentgroup_name' => 'required|max:40',
				

		]);

       $id = $request->input('idgroup');
       $updatedDate = date("Y-m-d  H:i:s");
       $loginUser  = $request->session()->get('userid');

		$data = array(
				"EQPGROUP_CODE"    =>  $request->input('equipmentgroup_code'),
				"EQPGROUP_NAME"    =>  $request->input('equipmentgroup_name'),
				"EQPGROUP_BLOCK"   =>  $request->input('group_block'),
				"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
				"LAST_UPDATE_DATE" =>  $updatedDate
				
	    	);
		try{
		$saveData = DB::table('MASTER_EQPGROUP')->where('EQPGROUP_CODE', $id)->update($data);

		$discriptn_page = "Master equipment group update done by user";
		$this->userLogInsert($loginUser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Equipment Group Was Successfully Updated...!');
				return redirect('/Master/Maintenance/View-Equipment-Group-Mast');

			} else {

				$request->session()->flash('alert-error', 'Equipment Group Can Not Updated...!');
				return redirect('/Master/Maintenance/View-Equipment-Group-Mast');

			}
		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Equipment Group be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Maintenance/View-Equipment-Group-Mast');
		}


	}

/*search Item Group code when click on help button*/
	
	public function HelpItemGroupCodeGet(Request $request){

		$response_array = array();

	    $ItemGroupH = $request->input('ItemGroupH');

		if ($request->ajax()) {

	    	$itemgroup_code_by_help = DB::select("SELECT * FROM `MASTER_ITEMGROUP` WHERE ITEMGROUP_CODE='$ItemGroupH' OR ITEMGROUP_NAME='$ItemGroupH' OR ITEMGROUP_CODE Like '$ItemGroupH%' OR ITEMGROUP_NAME LIKE '$ItemGroupH%' ORDER BY ITEMGROUP_CODE DESC limit 5  ");
	    	
    		if ($itemgroup_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemgroup_code_by_help ;

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

/*search Item Group code when click on help button*/


/*search Item Group code on input*/

	public function search_ItemGroupCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$SearchItemGroup = $request->input('SearchItemGroup');

	    	$itemgroupCode_list = DB::select("SELECT * FROM `MASTER_ITEMGROUP` WHERE ITEMGROUP_CODE LIKE '$SearchItemGroup%'");

	    	$count = count($itemgroupCode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemgroupCode_list ;

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

/*search Item Group code on input*/

/* ---------- end item group master ---------- */

/* --------- start item category master ------ */

	public function EquipmentCategory(Request $request){

		$title = 'Add Equipment Category';

		$compName 	= $request->session()->get('company_name');

		$equipmentcategory_code = $request->old('equipmentcategory_code');
		$equipmentcategory_name = $request->old('equipmentcategory_name');
		$equipmentcategory_id   = $request->old('id');
		$category_block    = $request->old('category_block');

		$userData['ItemCat_lists'] = DB::table('MASTER_EQPCATG')->Orderby('EQPCATG_CODE', 'desc')->limit(5)->get();

		$button='Save';

    	$action='/Master/Maintenance/Equipment-Category-Save';

		if(isset($compName)){

    	return view('admin.finance.master.equipment.equipment_category',$userData+compact('title','equipmentcategory_code','equipmentcategory_name','equipmentcategory_id','category_block','action','button'));

    }else{

		return redirect('/useractivity');
	}

	}


	public function SaveEquipmentCategory(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');
    	$loginuser = $request->session()->get('userid');

		$validate = $this->validate($request, [

				'equipmentcategory_code' => 'required|max:6|unique:MASTER_EQPCATG,EQPCATG_CODE',
				'equipmentcategory_name' => 'required|max:40',

		]);

		$data = array(
					"EQPCATG_CODE" =>  $request->input('equipmentcategory_code'),
					"EQPCATG_NAME" =>  $request->input('equipmentcategory_name'),
					"CREATED_BY"   =>  $request->session()->get('userid')
					
	    	);

		$saveData = DB::table('MASTER_EQPCATG')->insert($data);

		$discriptn_page = "Master equipment category insert done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Equipment Category Was Successfully Added...!');
				return redirect('/Master/Maintenance/View-Equipment-Category-Mast');

			} else {

				$request->session()->flash('alert-error', 'Equipment Category Can Not Added...!');
				return redirect('/Master/Maintenance/View-Equipment-Category-Mast');

			}

	}

	public function ViewEquipmentCategory(Request $request){

	$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	       $title = 'View Rack Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    	$data  = DB::table('MASTER_EQPCATG')->orderBy('EQPCATG_CODE','DESC');

	    	//print_r($valData['val_list']);exit;
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data  = DB::table('MASTER_EQPCATG')->orderBy('EQPCATG_CODE','DESC');
	    	}
	    	else{
	  			 $data ='';
	    	}

	    	return DataTables()->of($data)->addIndexColumn()->toJson();

		}
		if(isset($compName)){
			return view('admin.finance.master.equipment.view_equipment_category');
		}else{
		 	return redirect('/useractivity');
	   	}

    }


    public function DeleteEquipmentCategory(Request $request){

        $id = $request->input('itemcat');
        if ($id!='') {
        	try{
			$Delete = DB::table('MASTER_EQPCATG')->where('EQPCATG_CODE', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Equipment Category Data Was Deleted Successfully...!');
			return redirect('/Master/Maintenance/View-Equipment-Category-Mast');

			} else {

			$request->session()->flash('alert-error', 'Equipment Category Data Can Not Deleted...!');
			return redirect('/Master/Maintenance/View-Equipment-Category-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Equipment Category be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Maintenance/View-Equipment-Category-Mast');
			}

		}else{

		$request->session()->flash('alert-error', 'Equipment Category Data Not Found...!');
		return redirect('/Master/Maintenance/View-Equipment-Category-Mast');

		}
	}


	public function EditEquipmentCategory($id){

    	$title = 'Edit Equipment Category';

    	//print_r($id);
    	$id = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);

    	if($id!=''){
    	    $query = DB::table('MASTER_EQPCATG');
			$query->where('EQPCATG_CODE', $id);
			$classData= $query->get()->first();

			$equipmentcategory_code = $classData->EQPCATG_CODE;
			$equipmentcategory_name = $classData->EQPCATG_NAME;
			$equipmentcategory_id   = $classData->EQPCATG_CODE;
			$category_block         = $classData->EQPCATG_BLOCK;

			$button='Update';
			$action='/Master/Maintenance/Equipment-Category-Update';

			return view('admin.finance.master.equipment.equipment_category',compact('title','equipmentcategory_code','equipmentcategory_name','equipmentcategory_id','category_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Equipment Category Not Found...!');
			return redirect('/Master/Maintenance/View-Equipment-Category-Mast');
		}

    }

    public function UpdateEquipmentCategory(Request $request){

		
		$validate = $this->validate($request, [

				'equipmentcategory_code' => 'required|max:6',
				'equipmentcategory_name' => 'required|max:40',
				
		]);

        $id = $request->input('idcat');
        $updatedDate = date("Y-m-d  H:i:s");
        $loginuser = $request->session()->get('userid');

		$data = array(
				"EQPCATG_CODE"     =>  $request->input('equipmentcategory_code'),
				"EQPCATG_NAME"     =>  $request->input('equipmentcategory_name'),
				"EQPCATG_BLOCK"    =>  $request->input('category_block'),
				"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
				"LAST_UPDATE_DATE" =>  $updatedDate
				
	    );

		try{
			$saveData = DB::table('MASTER_EQPCATG')->where('EQPCATG_CODE', $id)->update($data);

			$discriptn_page = "Master equipment category update done by user";
			$this->userLogInsert($loginuser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Equipment Category Was Successfully Updated...!');
				return redirect('/Master/Maintenance/View-Equipment-Category-Mast');

			} else {

				$request->session()->flash('alert-error', 'Equipment Category Can Not Updated...!');
				return redirect('/Master/Maintenance/View-Equipment-Category-Mast');

			}
		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Equipment Category be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Maintenance/View-Equipment-Category-Mast');
		}
	}

/*search Item Category code when click on help button*/
	
	public function HelpItemCatCodeGet(Request $request){

		$response_array = array();

	    $ItemCateCodeH = $request->input('ItemCateCodeH');

		if ($request->ajax()) {

	    	$itemcat_code_by_help = DB::select("SELECT * FROM `MASTER_ITEM_CATEGORY` WHERE ICATG_CODE='$ItemCateCodeH' OR ICATG_NAME='$ItemCateCodeH' OR ICATG_CODE Like '$ItemCateCodeH%' OR ICATG_NAME LIKE '$ItemCateCodeH%' ORDER BY ICATG_CODE DESC limit 5  ");
	    	
    		if ($itemcat_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemcat_code_by_help ;

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

/*search Item Category code when click on help button*/


/*search Item Category code on input*/

	public function search_ItemCatCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$SearchItemCatCode = $request->input('SearchItemCatCode');

	    	$itemcatCode_list = DB::select("SELECT * FROM `MASTER_ITEM_CATEGORY` WHERE ICATG_CODE LIKE '$SearchItemCatCode%'");

	    	$count = count($itemcatCode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemcatCode_list ;

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

/*search Item Category code on input*/

/* --------- end item category master ------ */


/* ------ start item class master ------- */

	public function EquipmentClass(Request $request){

		$title        ='Add Equipment Class Master';

		$compName 	= $request->session()->get('company_name');
		
		$eqpclass_code  = $request->old('eqpclass_code');
		$eqpclass_name  = $request->old('eqpclass_name');
		$eqpclass_id    = $request->old('eqpclass_id');
		$eqpclass_block = $request->old('eqpclass_block');

		$userData['eqp_mst_list'] = DB::table('MASTER_EQPCLASS')->Orderby('EQPCLASS_CODE', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/Master/Maintenance/Equipment-Class-Save';
		//print_r($compData['comp_list']);exit;

		if(isset($compName)){

    	return view('admin.finance.master.equipment.equipment_class',$userData+compact('title','eqpclass_code','eqpclass_name','eqpclass_id','eqpclass_block','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function SaveEquipmentClass(Request $request){


		$validate = $this->validate($request, [

			'eqpclass_code' => 'required|max:6|unique:MASTER_EQPCLASS,EQPCLASS_CODE',
			'eqpclass_name' => 'required|max:40',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$data = array(
			"EQPCLASS_CODE" => $request->input('eqpclass_code'),
			"EQPCLASS_NAME" => $request->input('eqpclass_name'),
			"created_by"    => $createdBy,
			
		);

		$saveData = DB::table('MASTER_EQPCLASS')->insert($data);

		$discriptn_page = "Master equioment class insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Equipment Class Was Successfully Added...!');
			return redirect('/Master/Maintenance/View-Equipment-Class-Mast');

		} else {

			$request->session()->flash('alert-error', 'Equipment Class Can Not Added...!');
			return redirect('/Master/Maintenance/View-Equipment-Class-Mast');

		}

	}

	public function EditEquipmentClass($id){

    	$title = 'Edit Item Class Master';

    	$id = base64_decode($id);
    	
    	if($id!=''){
    	    $query = DB::table('MASTER_EQPCLASS');
			$query->where('EQPCLASS_CODE', $id);
			$classData= $query->get()->first();

			$eqpclass_code  = $classData->EQPCLASS_CODE;
			$eqpclass_name  = $classData->EQPCLASS_NAME;
			$eqpclass_id    = $classData->EQPCLASS_CODE;
			$eqpclass_block = $classData->EQPCLASS_BLOCK;

			$button='Update';
			$action='/Master/Maintenance/Equipment-Class-Update';

			return view('admin.finance.master.equipment.equipment_class',compact('title','eqpclass_code','eqpclass_name','eqpclass_id','eqpclass_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Config Not Found...!');
			return redirect('/Master/Maintenance/View-Equipment-Class-Mast');
		}

    }


    public function UpdateEquipmentClass(Request $request){

		$validate = $this->validate($request, [

			'eqpclass_code' => 'required|max:6',
			'eqpclass_name' => 'required|max:40'
		]);

		$eqpclass_id = $request->input('eqpclass_id');

		//print_r($eqpclass_id);exit;

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d  H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"EQPCLASS_CODE"    => $request->input('eqpclass_code'),
			"EQPCLASS_NAME"    => $request->input('eqpclass_name'),
			"EQPCLASS_BLOCK"   => $request->input('eqpclass_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		$saveData = DB::table('MASTER_EQPCLASS')->where('EQPCLASS_CODE', $eqpclass_id)->update($data);

		$discriptn_page = "Master equipment class update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		try{

			if ($saveData) {

				$request->session()->flash('alert-success', 'Equipment Class Was Successfully Updated...!');
				return redirect('/Master/Maintenance/View-Equipment-Class-Mast');

			} else {

				$request->session()->flash('alert-error', 'Equipment Class Can Not Added...!');
				return redirect('/Master/Maintenance/View-Equipment-Class-Mast');

			}
		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Equipment Class Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Maintenance/View-Equipment-Class-Mast');
		}
	}

	public function ViewEquipmentClass(Request $request){
		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Equipment Class Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_EQPCLASS')->orderBy('EQPCLASS_CODE','DESC');
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_EQPCLASS')->orderBy('EQPCLASS_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

    	 	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

	    if(isset($compName)){
	    	return view('admin.finance.master.equipment.view_equipment_class');

	    }else{
			 return redirect('/useractivity');
		}

    }

    public function DeleteEquipmentClass(Request $request){

		$classId = $request->post('equipmentgroupid');
    	
    	if ($classId!='') {

    		try{

    			$Delete = DB::table('MASTER_EQPCLASS')->where('EQPCLASS_CODE', $classId)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Equipment Class Was Deleted Successfully...!');
					return redirect('/Master/Maintenance/View-Equipment-Class-Mast');

				} else {

					$request->session()->flash('alert-error', 'Equipment Class Can Not Deleted...!');
					return redirect('/Master/Maintenance/View-Equipment-Class-Mast');

				}
			}
			catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Equipment Class Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Maintenance/View-Equipment-Class-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Equipment Not Found...!');
			return redirect('/Master/Maintenance/View-Equipment-Class-Mast');

    	}

	}


/* ------ end item class master ------- */

public function AddJobCardTrans(Request $request)
    {
    	//print_r($this->data);exit;
		$title                      ='Job Card';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'E1'])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']  = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
		//DB::enableQueryLog();
		$userdata['dept_list']      = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']     = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']      = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		$userdata['emp_list']       = DB::table('MASTER_EMP')->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();
		
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		
		$userdata['asset_list']     = DB::table('MASTER_ASSET')->get();
		
		$userdata['eqp_list']       = DB::table('MASTER_EQP')->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		$job_card = DB::table('JOBCARD_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();

		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($job_card as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','E1')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='E1'");
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

		    return view('admin.finance.transaction.maintainance.job_card_trans',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }


public function job_card_msg(Request $request,$saveData){

		if ($saveData) {

			$request->session()->flash('alert-success', 'Job Card Was Successfully Added...!');
			return redirect('/Transaction/Maintainance/View-Job-Crad-Trans');

		} else {

			$request->session()->flash('alert-error', 'Job Card Can Not Added...!');
			return redirect('/Transaction/Maintainance/View-Job-Crad-Trans');

		}
	}
   

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


   public function SaveJobCardTrans(Request $request)
    {
    	//print_r($request->post());exit;
    	//
			$createdBy      = $request->session()->get('userid');
			$CompanyCode    = $request->session()->get('company_name');
			$compcode       = explode('-', $CompanyCode);
			$getcompcode    =	$compcode[0];
			$fisYear        =  $request->session()->get('macc_year');
			$comp_nameval   = $request->input('comp_name');
			$fy_year        = $request->input('fy_year');
			$pfct_code      = $request->input('pfct_code');
			$trans_code     = $request->input('trans_code');
			$series_code    = $request->input('series_code');
			$series_name    = $request->input('series_name');
			$pfct_name      = $request->input('pfct_name');
			$vr_no          = $request->input('vr_no');
			$trans_date     = $request->input('trans_date');
			$tr_vr_date     = date("Y-m-d", strtotime($trans_date));
			$getduedate     = $request->input('getdue_date');
			$dueDate        = date("Y-m-d", strtotime($getduedate));
			$departCode     = $request->input('departCode');
			$departName     = $request->input('departName');
			$plant_code     = $request->input('plant_code');
			$plant_name     = $request->input('plant_name');
			$item_code      = $request->input('item_code');
			$item_name      = $request->input('item_name');
			$remark         = $request->input('remark');
			$qty            = $request->input('qty');
			$unit_M         = $request->input('unit_M');
			$Aqty           = $request->input('Aqty');
			$add_unit_M     = $request->input('add_unit_M');
			$scrab_code     = $request->input('scrab_code');
			$batch_no       = $request->input('batch_no');
			$cost_code      = $request->input('cost_code');
			$cost_name      = $request->input('cost_name');
			$assetcode      = $request->input('assetcode');
			$assetname      = $request->input('assetname');
			$target_date    = $request->input('targetdate');
			$targetdate     = date("Y-m-d", strtotime($target_date));
			$complete_date  = $request->input('completedate');
			$completedate   = date("Y-m-d", strtotime($complete_date));
			$EquipCode      = $request->input('EquipCode');
			$EquipName      = $request->input('EquipName');
			$jobtype        = $request->input('jobtype');
			$SrCode         = $request->input('EmpCode');
			$SrName         = $request->input('EmpName');
			$item_type      = $request->input('item_type');
			$donwloadStatus = $request->input('donwloadStatus');

	    	$count = count($item_code);

	   
	   
	    $StoreH = DB::select("SELECT MAX(JCHID) as JCHID FROM JOBCARD_HEAD");
		$headID = json_decode(json_encode($StoreH), true); 
	  //  print_r($headID);exit;
	
		if(empty($headID[0]['JCHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['JCHID']+1;
		}



		   if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('JOBCARD_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}



	    	$datahead = array(

				'COMP_CODE'       =>$getcompcode,
				'FY_CODE'         =>$fisYear,
				'JCHID'           =>$head_Id,
				'PFCT_CODE'       =>$pfct_code,
				'PFCT_NAME'       =>$pfct_name,
				'TRAN_CODE'       =>$trans_code,
				'SERIES_CODE'     =>$series_code,
				'SERIES_NAME'     =>$series_name,
				'VRNO'            =>$NewVrno,
				'VRDATE'          =>$tr_vr_date,
				'DEPT_CODE'       =>$departCode,
				'DEPT_NAME'       =>$departName,
				'SR_CODE'         =>$SrCode,
				'SR_NAME'         =>$SrName,
				'JOB_TYPE'        =>$jobtype,
				'EQP_CODE'        =>$EquipCode,
				'EQP_NAME'        =>$EquipName,
				'PLANT_CODE'      =>$plant_code,
				'PLANT_NAME'      =>$plant_name,
				'DUEDATE'         =>$dueDate,
				'COST_CENTER'     =>$cost_code,
				'COST_NAME'       =>$cost_name,
				'ASSET_CODE'      =>$assetcode,
				'ASSET_NAME'      =>$assetname,
				'TARGET_DATE'     =>$targetdate,
				'COMPLITION_DATE' =>$completedate,
				'CREATED_BY'      =>$createdBy,

			);


	    
	      $saveData = DB::table('JOBCARD_HEAD')->insert($datahead);

	      $lastid= DB::getPdo()->lastInsertId();

	      	$discriptn_page = "Job Crad trans insert done by user";
			$acc_code = '';
			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);
  			
	     //$data = array();
		for ($i = 0; $i < $count; $i++) {

			$StoreB = DB::select("SELECT MAX(JCBID) as JCBID FROM JOBCARD_BODY");

			$bodyID = json_decode(json_encode($StoreB), true); 
	
			if(empty($bodyID[0]['JCBID'])){
			$bodyId = 1;
			}else{
			$bodyId = $bodyID[0]['JCBID']+1;
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

				'JCHID'          =>$head_Id,
				'JCBID'          =>$bodyId,
				'COMP_CODE'      =>$getcompcode,
				'FY_CODE'        =>$fisYear,
				'PFCT_CODE'      =>$pfct_code,
				'TRAN_CODE'      =>$trans_code,
				'SERIES_CODE'    =>$series_code,
				'VRNO'           =>$NewVrno,
				'SLNO'           =>$i+1,
				'ITEM_CODE'      =>$item_code[$i],
				'ITEM_NAME'      =>$item_name[$i],
				'ITEM_TYPE'      =>$item_type[$i],
				'REMARK'         =>$remark[$i],
				'QTYRECD'        =>$qty[$i],
				'UM'             =>$unit_M[$i],
				'AQTYRECD'       =>$Aqty[$i],
				'AUM'            =>$add_unit_M[$i],
				'BATCH_NO'       =>$batch_no[$i],
				'FLAG'           =>$FLAG,
				'CREATED_BY'     =>$createdBy,

		    );
	
		    $saveData1 = DB::table('JOBCARD_BODY')->insert($data_body);
			

			/*$getdata = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE', $item_code[$i])->get()->first();

			$yrqtyblock = $getdata->YRQTYBLOCK;
			

			$dataarqty = array(
				'YRQTYBLOCK'  => $yrqtyblock + $qty[$i],
			);

			$saveData12 = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE', $item_code[$i])->update($dataarqty);*/
			
		}

		//$requistion->save();


		$Storebody = DB::select("SELECT MAX(VRNO) as VRNO FROM JOBCARD_BODY");

		$getbody = json_decode(json_encode($Storebody), true);


		$VR_NO	= $getbody[0]['VRNO'];
		//print_r($VR_NO);exit;

		$getvrnoCount  = DB::table('JOBCARD_BODY')->where('VRNO',$VR_NO)->get()->toArray();

		$sl_no=array();

		foreach ($getvrnoCount as $key){
			
			$sl_no[]= $key->SLNO;
		}

		$vrnocount = count($getvrnoCount);
		//print_r($getvrnoCount);exit;

		$getapprove =	DB::SELECT("SELECT t1.*,t2.* FROM 	MASTER_CONFIG_APPROVE t1  LEFT JOIN USER_APPROVE_IND t2 ON t2.APPROVE_USER = t1.APPROVE_IND WHERE t1.TRAN_CODE='$trans_code' AND t1.SERIES_CODE='$series_code'");

		$headTble = 'JOBCARD_HEAD';
		$bodyTble = 'JOBCARD_BODY';
		$headId   = 'JCHID';
		$pdfName  = 'JOB CARD';
		$vrPName  ='JOBCARD NO';


		if ($saveData1) {


			if($donwloadStatus == 1){
				return $this->GeneratePdfForJobCard($trans_code,$headTble,$bodyTble,$headId,$head_Id,$createdBy,$pdfName,$vrPName);

			}

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

		/*if($getapprove){

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
						'VRNO'           =>$vr_no,
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
								'VRNO'           =>$vr_no,
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

			
			
		}*/


    }


    public function GeneratePdfForJobCard($tCode,$headTble,$bodyTble,$headID,$head_Id,$userId,$pdfName,$vrPName){

		$response_array = array();

		$datahead = DB::SELECT("SELECT t1.*,'$headTble' as tablNme,t2.*,t4.GST_NO,t4.CITY_NAME as plant_city FROM $headTble t1  LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID  LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$headID='$head_Id'");

		$dataheadB = DB::SELECT("SELECT t1.*,'$headTble' as tablNme,t2.*,t4.GST_NO,t4.CITY_NAME as plant_city FROM $headTble t1  LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID  LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$headID='$head_Id' AND t2.ITEM_TYPE !='SR'");

		$bodyCount  = count($datahead);
		$seriesCode = $datahead[0]->SERIES_CODE;
		$compCode   = $datahead[0]->COMP_CODE;

		$dataheadB2 = DB::SELECT("SELECT t1.*,'$headTble' as tablNme,t2.*,t4.GST_NO,t4.CITY_NAME as plant_city FROM $headTble t1  LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID  LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$headID='$head_Id' AND t2.ITEM_TYPE='SR'");

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

    public function ViewJobCardTrans(Request $request)
    {
    		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

			$title       ='View Job Card';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];

	        $fisYear =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	       
           
	        $data = DB::table('JOBCARD_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->get();
	        
	       

	        }else if($userType=='superAdmin' || $userType=='user'){


	          $data = DB::table('JOBCARD_HEAD')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->get();

	        }else{

	            $data='';
	            
	        }

	    	return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }
	    if(isset($compName)){

	       return view('admin.finance.transaction.maintainance.view_job_card_trans');
	    }else{
			return redirect('/useractivity');
		}
    }


    public function ViewChildJobCardTrans(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$jobcard = DB::table('JOBCARD_BODY')->where('JCHID', $headid)->where('VRNO', $vrno)->get()->toArray();
	    	

    		if($jobcard) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $jobcard;
	         

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


public function Get_Item_Data_Jobcard(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$itemCode = $request->input('ItemCode');
	  
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

}

?>