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
class OtherController extends Controller{

	//public $data;

	public function __construct(Request $request){

		//$this->data = "smit@121";

	}

/* ------ start zone master --------*/

	public function AddZone(Request $request){

		$title      ='Add Zone Master';

		$compName 	= $request->session()->get('company_name');
		
		$zone_code  = $request->old('zone_code');
		$zone_name  = $request->old('zone_name');
		$zone_block = $request->old('zone_block');
		$zone_id    = $request->old('zone_id');

		$userData['zonecode_list'] = DB::table('MASTER_ZONE')->Orderby('ZONE_CODE', 'desc')->limit(5)->get();

		$button ='Save';
		$action ='/Master/Other/Zone-Save';

 		if(isset($compName)){

    		return view('admin.finance.master.other.zone_mast_form',$userData+compact('title','zone_code','zone_name','zone_block','zone_id','button','action'));

	    }else{

			return redirect('/useractivity');
		}

    } 


    public function ZoneSave(Request $request){


		$validate = $this->validate($request, [

			'zone_code' => 'required|max:6|unique:MASTER_ZONE,ZONE_CODE',
			'zone_name' => 'required|max:40',

		]);

    	$createdBy 	= $request->session()->get('userid');
		$data = array(

			"ZONE_CODE"  => $request->input('zone_code'),
			"ZONE_NAME"  => $request->input('zone_name'),
			"CREATED_BY" => $createdBy,
		);

		$saveData = DB::table('MASTER_ZONE')->insert($data);

		$discriptn_page = "Master zone insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Zone Was Successfully Added...!');
			return redirect('/Master/Other/View-Zone-Mast');

		} else {

			$request->session()->flash('alert-error', 'Zone Can Not Added...!');
			return redirect('/Master/Other/View-Zone-Mast');

		}

	}


	public function ViewZone(Request $request){

	$compName = $request->session()->get('company_name');

		if($request->ajax()){


			$title    = 'View Zone Master';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_ZONE')->orderBy('ZONE_CODE','DESC');

	    	//print_r($valData['val_list']);exit;AccClassFormSave
	    	}else if ($userType=='superAdmin' || $userType=='user') {    		
	    		$data = DB::table('MASTER_ZONE')->orderBy('ZONE_CODE','DESC');

	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables()->of($data)->addIndexColumn()->toJson();

	    }
    	if(isset($compName)){
	    	return view('admin.finance.master.other.view_zone_mast');
	    }else{
			return redirect('/useractivity');
		}
    }


    public function DeleteZone(Request $request){

		$zoneId = $request->post('zoneId');
    	
    	if ($zoneId!='') {
    		
    		$Delete = DB::table('MASTER_ZONE')->where('ZONE_CODE', $zoneId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Zone Was Deleted Successfully...!');
				return redirect('/Master/Other/View-Zone-Mast');

			} else {

				$request->session()->flash('alert-error', 'Zone Can Not Deleted...!');
				return redirect('/Master/Other/View-Zone-Mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Zone  Not Found...!');
			return redirect('/Master/Other/View-Zone-Mast');

    	}

	}


	public function EditZone($id){

    	$title = 'Edit Zone Master';

    	$id = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);

    	if($id!=''){
    	    $query = DB::table('MASTER_ZONE');
			$query->where('ZONE_CODE', $id);
			$classData= $query->get()->first();

			$zone_code  = $classData->ZONE_CODE;
			$zone_name  = $classData->ZONE_NAME;
			$zone_id    = $classData->ZONE_CODE;
			$zone_block = $classData->ZONE_BLOCK;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/Master/Other/Zone-Update';

			return view('admin.finance.master.other.zone_mast_form',compact('title','zone_code','zone_name','zone_id','zone_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Zone Not Found...!');
			return redirect('/Master/Other/View-Zone-Mast');
		}

    }

    public function ZoneUpdate(Request $request){

		$validate = $this->validate($request, [

			'zone_code' => 'required|max:6',
			'zone_name' => 'required|max:40',

		]);

		$zone_id = $request->input('idzone');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");
		
		$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

		$data = array(
			"ZONE_CODE"        => $request->input('zone_code'),
			"ZONE_NAME"        => $request->input('zone_name'),
			"ZONE_BLOCK"       => $request->input('zone_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		$saveData = DB::table('MASTER_ZONE')->where('ZONE_CODE', $zone_id)->update($data);

		$discriptn_page = "Master zone update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Zone Was Successfully Updated...!');
			return redirect('/Master/Other/View-Zone-Mast');

		} else {

			$request->session()->flash('alert-error', 'Zone Can Not Added...!');
			return redirect('/Master/Other/View-Zone-Mast');

		}

	}

	/*search zone when click on help button*/
	
	public function HelpZoneCodeGet(Request $request){

		$response_array = array();

	    $ZoneCodeHelp = $request->input('ZoneCodeHelp');

		if ($request->ajax()) {

	    	$zone_code_by_help = DB::select("SELECT * FROM `MASTER_ZONE` WHERE ZONE_CODE='$ZoneCodeHelp' OR ZONE_NAME='$ZoneCodeHelp' OR ZONE_CODE Like '$ZoneCodeHelp%' OR ZONE_NAME LIKE '$ZoneCodeHelp%' ORDER BY ZONE_CODE DESC limit 5  ");
	    	
    		if ($zone_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $zone_code_by_help ;

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

/*search zone code when click on help button*/


/*search zone code on input*/

	public function search_ZoneCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$zoneCodeSearch = $request->input('zoneCodeSearch');

	    	$Zonecode_list = DB::select("SELECT * FROM `MASTER_ZONE` WHERE ZONE_CODE LIKE '$zoneCodeSearch%'");

	    	$count = count($Zonecode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Zonecode_list ;

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

/*search zone code on input*/


/* ------- end zone master -------- */

/* ----- start department master -----*/

	public function Department(Request $request){

    	$title ='Add Department';
    	$compName 	= $request->session()->get('company_name');

		$compData['comp_list'] = DB::table('MASTER_COMP')->get();
		$compData['dept_mst_list'] = DB::table('MASTER_DEPT')->Orderby('DEPT_CODE', 'desc')->limit(5)->get();

		if(isset($compName)){

	    	return view('admin.finance.master.other.department_form',$compData+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

    }

    public function DepartmentSave(Request $request){
    	//print_r($request->post());exit;

		$validate = $this->validate($request, [

			'department_code' => 'required|max:6|unique:MASTER_DEPT,DEPT_CODE',
			'department_name' => 'required|max:40'
			

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			
			"DEPT_CODE"  => $request->input('department_code'),
			"DEPT_NAME"  => $request->input('department_name'),
			"CREATED_BY" => $createdBy,
			
		);

		$saveData = DB::table('MASTER_DEPT')->insert($data);

		$discriptn_page = "Master department insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Department Was Successfully Added...!');
			return redirect('/Master/other/View-Department-Mast');

		} else {

			$request->session()->flash('alert-error', 'Department Can Not Added...!');
			return redirect('/Master/other/View-Department-Mast');

		}

	}


	public function ViewDepartment(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {


	    	$title = 'View Department';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	$data = DB::table('MASTER_DEPT')->orderBy('DEPT_CODE','DESC');
	    	}
	    	elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_DEPT')->orderBy('DEPT_CODE','DESC');
	    	}
	    	else{
	    		$data='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

	    }

    	if(isset($compName)){
    	 	return view('admin.finance.master.other.view_department');
    	}else{
			return redirect('/useractivity');
	   	}
    }


    public function EditDepartment($deptcode){

    	$title = 'Edit Department';
    	//print_r($id);
    	$deptcode = base64_decode($deptcode);
    	//$btnControl = base64_decode($btnControl);

    	if($deptcode!=''){
    	    $query = DB::table('MASTER_DEPT');
			$query->where('DEPT_CODE', $deptcode);
			$deptData['dept_list'] = $query->get()->first();

			//print_r($userData['transaction_list']);exit;
			return view('admin.finance.master.other.edit_department', $deptData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('/Master/other/View-Department-Mast');
		}

    }


    public function DepartmentUpdate(Request $request){

		$validate = $this->validate($request, [

			'department_code'  => 'required|max:6',
			'department_name'  => 'required|max:40',
			
		]);

		$deptCode = $request->input('deptId');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"DEPT_CODE"        => $request->input('department_code'),
			"DEPT_NAME"        => $request->input('department_name'),
			"DEPT_BLOCK"       => $request->input('department_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		$saveData = DB::table('MASTER_DEPT')->where('DEPT_CODE', $deptCode)->update($data);

		$discriptn_page = "Master department update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Department  Was Successfully Updated...!');
			return redirect('/Master/other/View-Department-Mast');

		} else {

			$request->session()->flash('alert-error', 'Department  Can Not Updated...!');
			return redirect('/Master/other/View-Department-Mast');

		}

	}

	public function DeleteDepartment(Request $request){

		$deptCode = $request->post('deptId');

    	if ($deptCode!='') {
    		
    		$Delete = DB::table('MASTER_DEPT')->where('DEPT_CODE', $deptCode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Department Was Deleted Successfully...!');
				return redirect('/Master/other/View-Department-Mast');

			} else {

				$request->session()->flash('alert-error', 'Department Can Not Deleted...!');
				return redirect('/Master/other/View-Department-Mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('/Master/other/View-Department-Mast');

    	}

	}

	/*search Deapartment code when click on help button*/
	
	public function HelpDeaprtmentSearch(Request $request){

		$response_array = array();

	    $dept_code_help = $request->input('HelpdeptCode');

		if ($request->ajax()) {

	    	$Seach_dept_by_help = DB::select("SELECT * FROM `MASTER_DEPT` WHERE DEPT_CODE='$dept_code_help' OR DEPT_NAME='$dept_code_help' OR dept_code Like '$dept_code_help%' OR DEPT_NAME LIKE '$dept_code_help%' ORDER BY DEPT_CODE DESC limit 5  ");
	    	
    		if ($Seach_dept_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_dept_by_help ;

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

	/*search Deapartment code when click on help button*/

	/*search Deapartment code on input*/

	public function search_DepartMentCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$depart_code = $request->input('dept_code_search');

	    	$department_list = DB::select("SELECT * FROM `MASTER_DEPT` WHERE DEPT_CODE LIKE '$depart_code%'");

	    	$count = count($department_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $department_list ;

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

	/*search Deapartment code on input*/

/* ----- start department master -----*/

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


}

?>