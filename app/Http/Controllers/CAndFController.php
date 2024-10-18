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

class CAndFController extends Controller{

	public function __construct(){

	}

/* ------- start area master ------------*/
	public function DestinationForm(Request $request){

    	$title ='Add Master Area';

    	$data['help_area_list'] = DB::table('MASTER_AREA')->Orderby('AREA_CODE', 'desc')->limit(5)->get();
    
    	return view('admin.finance.master.candF.destination_form',$data+compact('title'));
    }

    public function DestinationFormSave(Request $request){

    	$validate = $this->validate($request, [

			'area_code'    => 'required|max:6|unique:MASTER_AREA,AREA_CODE',
			'area_name'    => 'required|max:30',
			
		]);

		$createdBy = $request->session()->get('userid');

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$flag=0;

		$data = array(

			"AREA_NAME"  => $request->input('area_name'),
			"AREA_CODE"  => $request->input('area_code'),
			"FLAG"       => $flag,
			"CREATED_BY" => $createdBy,
		);

		$saveData = DB::table('MASTER_AREA')->insert($data);

		$discriptn_page = "Master area insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Area Was Successfully Added...!');
			return redirect('/view-mast-destination');

		} else {

			$request->session()->flash('alert-error', 'Area Can Not Added...!');
			return redirect('/view-mast-destination');

		}

    }

    public function DestinationView(Request $request){

	    if($request->ajax()) {

	    	$title = 'View Master Area';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName 	= $request->session()->get('company_name');

	    	$fisYear 	=  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    	//$data = DB::table('master_area')->orderBy('id','DESC');

	    		$data = DB::table('MASTER_AREA')->orderBy('AREA_CODE','DESC');


			}else if($userType=='superAdmin' || $userType=='user'){
				/*$data = DB::table('master_area')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear]);*/

				$data = DB::table('MASTER_AREA')->orderBy('AREA_CODE','DESC');

				//return view('admin.view_dealer',$dealerData);
			}else{

				$data='';
				//return view('admin.view_dealer',$dealerData);
			}

			return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
		}

    	return view('admin.finance.master.candF.view_destination');

    }

    public function EditDestinationForm($id,$btnControl){

    	$title ='Edit Master Area';
    	//print_r($id);
    	$id = base64_decode($id);
    	$btnControl = base64_decode($btnControl);


    	if($id!=''){
    	    $query = DB::table('MASTER_AREA');
			$query->where('AREA_CODE', $id);
			$userData['destination_list'] = $query->get()->first();

			return view('admin.finance.master.candF.destination_list', $userData+compact('title','btnControl'));
		}else{
			$request->session()->flash('alert-error', 'Area Not Found...!');
			return redirect('/form-mast-depot');
		}

    }

    public function DestinationFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'area_code'    => 'required|max:6',
			'area_name'    => 'required|max:30',
			
		]);

    	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d  H:i:s");

		$lastUpdatedBy = $request->session()->get('userid');

		$destinationId = $request->input('destinationId');

		$data = array(
			"AREA_NAME"        => $request->input('area_name'),
			"AREA_CODE"        => $request->input('area_code'),
			"FLAG"             => $request->input('area_block'),
			"LAST_UPDATE_BY"   => $lastUpdatedBy,
			"LAST_UPDATE_DATE" => $updatedDate,
		);

		

		$saveData = DB::table('MASTER_AREA')->where('AREA_CODE',$destinationId)->update($data);

		$discriptn_page = "Master area update done by user";
		$this->userLogInsert($lastUpdatedBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Area Was Successfully Updated...!');
			return redirect('/view-mast-destination');

		} else {

			$request->session()->flash('alert-error', 'Area Can Not Updated...!');
			return redirect('/view-mast-destination');

		}
    }

    public function DeleteDestination(Request $request){

    	$destinationId = $request->post('DestinationID');
    	//print_r($destinationId);exit;

    	if ($destinationId!='') {
    		
    		$Delete = DB::table('MASTER_AREA')->where('AREA_CODE', $destinationId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Area Was Deleted Successfully...!');
				return redirect('/view-mast-destination');

			} else {

				$request->session()->flash('alert-error', 'Area Can Not Deleted...!');
				return redirect('/view-mast-destination');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Area Not Found...!');
			return redirect('/view-mast-destination');

    	}
    }

    /*search area code on input*/

	public function search_AreaCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$SerachAreaCode = $request->input('SerachAreaCode');

	    	$item_um_aum_list = DB::select("SELECT * FROM `MASTER_AREA` WHERE AREA_CODE LIKE '$SerachAreaCode%'");

	    	$count = count($item_um_aum_list);

    		if ($count >=1) {

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

	/*search area code on input*/

	/*search area code when click on help button*/

	public function HelpAreaCodeSearch(Request $request){

		$response_array = array();

	    $area_code_help = $request->input('HelpAreaCode');

		if ($request->ajax()) {

	    	$Seach_depot_Code_by_help = DB::select("SELECT * FROM `MASTER_AREA` WHERE AREA_CODE='$area_code_help' OR AREA_NAME='$area_code_help' OR AREA_CODE Like '$area_code_help%' OR AREA_NAME LIKE '$area_code_help%' ORDER BY AREA_CODE DESC limit 5  ");
	    	
    		if ($Seach_depot_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_depot_Code_by_help ;

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

	/*search area code when click on help button*/

/* ------- start area master ------------*/

/* --------- start depot master ----------- */

	public function DepotForm(Request $request){

	$title = 'Add Master Depot';

    $data['state_list'] = DB::table('MASTER_STATE')->get();

    $data['help_depot_list'] = DB::table('MASTER_DEPOT')->Orderby('DEPOT_CODE', 'desc')->limit(5)->get();
    	
    	return view('admin.finance.master.candF.depot_form',$data+compact('title'));
    }

    public function DepotFormSave(Request $request){

    	$validate = $this->validate($request, [

			'depot_code'    => 'required|max:6|unique:MASTER_DEPOT,DEPOT_CODE',
			'depot_name'    => 'required|max:30',
			'contact_no'    => 'required|max:10',
			'contact_email' => 'required|max:30|email',
			'address_one'   => 'required|max:30',
			'country'       => 'required|max:30',
			'state_code'    => 'required|max:30',
			'district'      => 'required|max:30',
			'city_code'     => 'required|max:6',
			'pincode'       => 'required|max:6',

		]);

		$createdBy = $request->session()->get('userid');
		
		$compName  = $request->session()->get('company_name');
		$spliCode  = explode('-', $compName);
		$compCode  = $spliCode[0];
		$fisYear   =  $request->session()->get('macc_year');

    	$flag=0;

		$data = array(
			"COMP_CODE"      => $compName,
			"DEPOT_CODE"     => $request->input('depot_code'),
			"DEPOT_NAME"     => $request->input('depot_name'),
			"CONTACT_PERSON" => $request->input('contact_no'),
			"CONTACT_EMAIL"  => $request->input('contact_email'),
			"ADD1"           => $request->input('address_one'),
			"ADD2"           => $request->input('address_two'),
			"ADD3"           => $request->input('address_three'),
			"COUNTRY"        => $request->input('country'),
			"STATE_CODE"     => $request->input('state_code'),
			"DIST_CODE"      => $request->input('district'),
			"CITY_CODE"      => $request->input('city_code'),
			"PIN_CODE"       => $request->input('pincode'),
			"FLAG"           => $flag,
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData = DB::table('MASTER_DEPOT')->insert($data);

		$discriptn_page = "Master depot insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Depot Was Successfully Added...!');
			return redirect('/view-mast-depot');

		} else {

			$request->session()->flash('alert-error', 'Depot Can Not Added...!');
			return redirect('/view-mast-depot');

		}
    	
    	

    }

    public function DepotView(Request $request){

    	if($request->ajax()) {

	    	$title = 'View Master Depot';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	//$data = DB::table('master_depot')->orderBy('id','DESC');

	    		$data = DB::table('MASTER_DEPOT')->orderBy('DEPOT_CODE','DESC');

	    	
	    	}elseif ($userType=='superAdmin' || $userType=='user') {

    			$data = DB::table('MASTER_DEPOT')->orderBy('DEPOT_CODE','DESC');
    		}
    	

   			return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
				
			})->toJson();

    }

    	return view('admin.finance.master.candF.view_depot');
    }

    public function EditDepotForm($id){

    	$title = 'Edit Master Depot';

    	//print_r($id);
    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('MASTER_DEPOT');
			$query->where('DEPOT_CODE', $id);
			$userData['depot_list'] = $query->get()->first();

			
			$userData['state_list'] = DB::table('MASTER_STATE')->get();

			return view('admin.finance.master.candF.depot_list', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Depot-Id Not Found...!');
			return redirect('/form-mast-depot');
		}

    }

    public function DepotFormUpdate(Request $request){

    	//print_r($request->post());exit;

    	$validate = $this->validate($request, [

			'depot_code'    => 'required|max:6',
			'depot_name'    => 'required|max:30',
			'contact_no'    => 'required|max:10',
			'contact_email' => 'required|max:30|email',
			'address_one'   => 'required|max:30',
			'country'       => 'required|max:30',
			'state_code'    => 'required|max:30',
			'district'      => 'required|max:30',
			'city_code'     => 'required|max:6',
			'pincode'       => 'required|max:6',


		]);

		$depotId=$request->input('depotId');
		//print_r($request->post());exit;

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d  H:i:s");

		$lastUpdatedBy = $request->session()->get('userid');
		 

		$data = array(
			"DEPOT_CODE"       => $request->input('depot_code'),
			"DEPOT_NAME"       => $request->input('depot_name'),
			"CONTACT_PERSON"   => $request->input('contact_no'),
			"CONTACT_EMAIL"    => $request->input('contact_email'),
			"ADD1"             => $request->input('address_one'),
			"ADD2"             => $request->input('address_two'),
			"ADD3"             => $request->input('address_three'),
			"COUNTRY"          => $request->input('country'),
			"STATE_CODE"       => $request->input('state_code'),
			"DIST_CODE"        => $request->input('district'),
			"CITY_CODE"        => $request->input('city_code'),
			"PIN_CODE"         => $request->input('pincode'),
			"FLAG"             => $request->input('depot_block'),
			"LAST_UPDATE_BY"   => $lastUpdatedBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);
		

		$saveData = DB::table('MASTER_DEPOT')->where('DEPOT_CODE', $depotId)->update($data);

		$discriptn_page = "Master depot update done by user";
		$this->userLogInsert($lastUpdatedBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Depot Was Successfully Updated...!');
			return redirect('/view-mast-depot');

		} else {

			$request->session()->flash('alert-error', 'Depot Can Not Updated...!');
			return redirect('/view-mast-depot');

		}
    }


    public function DeleteDepot(Request $request){

    	$depotId = $request->post('DepotID');
    	
    	$depotcode['depot'] = DB::table('MASTER_DEPOT')->where('DEPOT_CODE', $depotId)->get()->first();
    	//$depotcode['depot_code'] = DB::table('INWARD_TRANS')->where('DEPOT_CODE', $depotcode['depot']->depot_code)->get()->toArray();
    	//if(!empty($depotcode['depot_code'])){
    	//	$request->session()->flash('alert-danger', ' Depot Was Not Deleted...!');
		//		return redirect('/view-mast-depot');
    	//}else{
    	

    	if ($depotId!='') {
    		
    		$Delete = DB::table('MASTER_DEPOT')->where('DEPOT_CODE', $depotId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Depot Was Deleted Successfully...!');
				return redirect('/view-mast-depot');

			} else {

				$request->session()->flash('alert-error', 'Depot Can Not Deleted...!');
				return redirect('/view-mast-depot');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Depot Not Found...!');
			return redirect('/view-mast-depot');

    	}
    //}
   }

/* --------- end depot master ------------- */

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