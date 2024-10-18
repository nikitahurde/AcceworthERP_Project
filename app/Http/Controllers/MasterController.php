<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Dispatch;
use Auth;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Str;

class MasterController extends Controller{
    
    public function __cunstruct(Request $request){  	

	}


/*master depot form*/

	public function DepotForm(Request $request){

	$title = 'Add Master Depot';

    $data['state_list'] = DB::table('master_state')->get();

    $data['help_depot_list'] = DB::table('master_depot')->Orderby('depot_code', 'desc')->limit(5)->get();
    	
    	return view('admin.cf.master.depot_form',$data+compact('title'));
    }

    public function DepotFormSave(Request $request){

    	$validate = $this->validate($request, [

			'depot_code'    => 'required|max:6|unique:master_depot,depot_code',
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

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$flag=0;

		$data = array(
			"comp_name"    	=> $compName,
			"fiscal_year"   => $fisYear,
			"depot_code"    => $request->input('depot_code'),
			"depot_name"    => $request->input('depot_name'),
			"contac_person" => $request->input('contact_no'),
			"contac_email"  => $request->input('contact_email'),
			"add1"          => $request->input('address_one'),
			"add2"          => $request->input('address_two'),
			"add3"          => $request->input('address_three'),
			"country"       => $request->input('country'),
			"state_code"    => $request->input('state_code'),
			"district"      => $request->input('district'),
			"city"          => $request->input('city_code'),
			"pincode"       => $request->input('pincode'),
			"flag"          => $flag,
			"created_by"    => $createdBy,
			
		);

		$saveData = DB::table('master_depot')->insert($data);

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

    	$data = DB::table('master_depot')
            ->leftJoin('code_access', 'master_depot.depot_code', '=', 'code_access.code')
            ->select('master_depot.*', 'code_access.inward_trans','code_access.outward_trans','code_access.sap_bill','code_access.fleet_trans','code_access.fleet_mast','code_access.rate_mast')
           	->where(['comp_name' => $compName, 'fiscal_year' => $fisYear])
            ->orderBy('id','DESC');

    	
    	}

    	elseif ($userType=='superAdmin' || $userType=='user') {

    	$data = DB::table('master_depot')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC');

    	$data = DB::table('master_depot')
            ->leftJoin('code_access', 'master_depot.depot_code', '=', 'code_access.code')
            ->select('master_depot.*', 'code_access.inward_trans','code_access.outward_trans','code_access.sap_bill','code_access.fleet_trans','code_access.fleet_mast','code_access.rate_mast')
           	->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])
            ->orderBy('id','DESC');
    	}
    	

   return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
				
			})->toJson();

    }

    	return view('admin.cf.master.view_depot');
    }

    public function EditDepotForm($id,$btnControl){

    	$title = 'Edit Master Depot';

    	//print_r($id);
    	$id = base64_decode($id);
    	$btnControl = base64_decode($btnControl);


    	if($id!=''){
    	    $query = DB::table('master_depot');
			$query->where('id', $id);
			$userData['depot_list'] = $query->get()->first();

			
			$userData['state_list'] = DB::table('master_state')->get();

			return view('admin.cf.master.depot_list', $userData+compact('title','btnControl'));
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

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');
		 

		$data = array(
			"depot_code"      => $request->input('depot_code'),
			"depot_name"      => $request->input('depot_name'),
			"contac_person"   => $request->input('contact_no'),
			"contac_email"    => $request->input('contact_email'),
			"add1"            => $request->input('address_one'),
			"add2"            => $request->input('address_two'),
			"add3"            => $request->input('address_three'),
			"country"         => $request->input('country'),
			"state_code"      => $request->input('state_code'),
			"district"        => $request->input('district'),
			"city"            => $request->input('city_code'),
			"pincode"         => $request->input('pincode'),
			"flag"            => $request->input('depot_block'),
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" => $updatedDate,
			
		);
		

		$saveData = DB::table('master_depot')->where('id', $depotId)->update($data);
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
    	
    	$depotcode['depot'] = DB::table('master_depot')->where('id', $depotId)->get()->first();
    	$depotcode['depot_code'] = DB::table('inward_trans')->where('depot_code', $depotcode['depot']->depot_code)->get()->toArray();
    	if(!empty($depotcode['depot_code'])){
    		$request->session()->flash('alert-danger', ' Depot Was Not Deleted...!');
				return redirect('/view-mast-depot');
    	}else{
    	

    	if ($depotId!='') {


    		
    		$Delete = DB::table('master_depot')->where('id', $depotId)->delete();

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
    }
   }
/*master depot form*/

/*master dealer form*/
    public function DealerForm(Request $request){

    	 $title = 'Add Master Account';

    	 $compName = $request->session()->get('company_name');

    	 $fisYear =  $request->session()->get('macc_year');
    	
    	 $data['state_list'] = DB::table('master_state')->get();
    	 /*$data['acc_type_list'] = DB::table('master_acctype')->where('flag',0)->get();*/
    	 $data['acc_type_list'] = DB::table('master_acctype')->where(['comp_name' => $compName, 'fiscal_year' => $fisYear, 'flag' =>0])->get();

    	 $data['help_acc_list'] = DB::table('master_acc')->Orderby('acc_code', 'desc')->limit(5)->get();
    	
    	return view('admin.cf.master.dealer_form',$data+compact('title'));
    }


    public function DealerFormSave(Request $request){
    	//print_r($request->post());exit;

    		$validate = $this->validate($request, [

			'account_code'   => 'required|max:12|unique:master_acc,acc_code',
			'account_name'   => 'required|max:30',
			'acc_type_code'  => 'required|max:30',
			'contact_no'     => 'required|max:10',
			'contact_person' => 'required|max:30',
			'email_id'       => 'required|max:30',
			'address_one'    => 'required|max:30',
			'country'        => 'required|max:30',
			'state_code'     => 'required|max:30',
			'district'       => 'required|max:30',
			'city_code'      => 'required|max:20',
			'pincode'        => 'required|max:6',
			'service_charge' => 'required',

		]);

    	$createdBy = $request->session()->get('userid');

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$acc_type = $request->input('acc_type_code');

		$data = array(

			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"acc_code"       => $request->input('account_code'),
			"acc_name"       => $request->input('account_name'),
			"acctype_code"   => $request->input('acc_type_code'),
			"contact_no"     => $request->input('contact_no'),
			"contact_person" => $request->input('contact_person'),
			"email_id"       => $request->input('email_id'),
			"add1"           => $request->input('address_one'),
			"add2"           => $request->input('address_two'),
			"add3"           => $request->input('address_three'),
			"country"        => $request->input('country'),
			"state_code"     => $request->input('state_code'),
			"district"       => $request->input('district'),
			"city"           => $request->input('city_code'),
			"pincode"        => $request->input('pincode'),
			"service_charge" => $request->input('service_charge'),
			"flag"           => '0',
			"created_by"     => $createdBy,
			
		);

		$saveData = DB::table('master_acc')->insert($data);

		if ($saveData) {

			$getCode1= DB::table('code_access')->where('code',$acc_type)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode1)){

				 	 $getCode= DB::table('code_access')->where('code',$acc_type)->where('acc_mast',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'       =>$acc_type,
								'acc_mast'  =>1,
								"created_by" =>  $request->session()->get('userid')
					 	);

					 	//DB::enableQueryLog();

					 	$saveData1 = DB::table('code_access')->where('code',$acc_type)->update($data1);

					 	//dd(DB::getQueryLog());
					 }


				 }else{

				 	$data1=array(
								'code'       =>$acc_type,
								'acc_mast' =>1,
								"created_by" =>  $request->session()->get('userid')
					 	);

					//DB::enableQueryLog(); 	
					$saveData1 = DB::table('code_access')->insert($data1);

					//dd(DB::getQueryLog());
				 }

				 if($saveData1){

					$request->session()->flash('alert-success', 'Account Was Successfully Added...!');
			        return redirect('/view-mast-dealer');

				}else{

					$request->session()->flash('alert-error', 'Account Can Not Added...!');
			return redirect('/view-mast-dealer');
				}


			

		} else {

			$request->session()->flash('alert-error', 'Account Can Not Added...!');
			return redirect('/view-mast-dealer');

		}
    }

    public function DealerView(Request $request){


     if($request->ajax()) {

    	$title ='View Master Account';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');


    	if($userType=='admin' || $userType=='Admin'){

    	//$data = DB::table('master_acc')->orderBy('id','DESC');

    	$data = DB::table('master_acc')
            ->leftJoin('code_access', 'master_acc.acc_code', '=', 'code_access.code')
            ->select('master_acc.*', 'code_access.inward_trans','code_access.outward_trans','code_access.sap_bill','code_access.fleet_trans','code_access.fleet_mast','code_access.rate_mast')
            ->where(['comp_name' => $compName, 'fiscal_year' => $fisYear])
            ->orderBy('id','DESC');


    
		}else if($userType=='superAdmin' || $userType=='user'){

			/*$data = DB::table('master_acc')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC');*/

			$data = DB::table('master_acc')
            ->leftJoin('code_access', 'master_acc.acc_code', '=', 'code_access.code')
            ->select('master_acc.*', 'code_access.inward_trans','code_access.outward_trans','code_access.sap_bill','code_access.fleet_trans','code_access.fleet_mast','code_access.rate_mast')
            ->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])
            ->orderBy('id','DESC');

			
		}
		else{

			$data='';
			
		}

	return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
				
			})->toJson();


	}

       return view('admin.cf.master.view_dealer');
    	
    }

    public function EditDealerForm(Request $request,$id,$btnControl){

    	$title = 'Edit Master Account';
    	//print_r($id);
    	$id = base64_decode($id);
    	$btnControl = base64_decode($btnControl);

    	$compName = $request->session()->get('company_name');

    	 $fisYear =  $request->session()->get('macc_year');


    	if($id!=''){
    	    $query = DB::table('master_acc');
			$query->where('id', $id);
			$userData['dealer_list'] = $query->get()->first();

			
			$userData['state_list'] = DB::table('master_state')->get();

			/*$userData['acc_type_list'] = DB::table('master_acctype')->where('flag',0)->get();*/

			$userData['acc_type_list'] = DB::table('master_acctype')->where(['comp_name' => $compName, 'fiscal_year' => $fisYear, 'flag' =>0])->get();

			//print_r($data['acc_type_list']);exit;

			return view('admin.cf.master.dealer_list', $userData+compact('title','btnControl'));
		}else{
			$request->session()->flash('alert-error', 'Account Code Not Found...!');
			return redirect('/form-mast-depot');
		}

    }

    public function DealerFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'account_code'   => 'required|max:12',
			'account_name'   => 'required|max:30',
			'acc_type_code'  => 'required|max:30',
			'contact_no'     => 'required|max:10',
			'contact_person' => 'required|max:30',
			'email_id'       => 'required|max:30',
			'address_one'    => 'required|max:30',
			'country'        => 'required|max:30',
			'state_code'     => 'required|max:30',
			'district'       => 'required|max:30',
			'city_code'      => 'required|max:20',
			'pincode'        => 'required|max:6',
			'service_charge' => 'required',

		]);

		$dealerId = $request->input('dealerId');


		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');


		$data = array(
			"acc_code"        => $request->input('account_code'),
			"acc_name"        => $request->input('account_name'),
			"acctype_code"    => $request->input('acc_type_code'),
			"contact_no"      => $request->input('contact_no'),
			"contact_person"  => $request->input('contact_person'),
			"email_id"        => $request->input('email_id'),
			"add1"            => $request->input('address_one'),
			"add2"            => $request->input('address_two'),
			"add3"            => $request->input('address_three'),
			"country"         => $request->input('country'),
			"state_code"      => $request->input('state_code'),
			"district"        => $request->input('district'),
			"city"            => $request->input('city_code'),
			"pincode"         => $request->input('pincode'),
			"service_charge"  => $request->input('service_charge'),
			"flag"            => $request->input('dealer_block'),
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" => $updatedDate,
			
			
		);



		$saveData = DB::table('master_acc')->where('id',$dealerId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Account Code Was Successfully Updated...!');
			return redirect('/view-mast-dealer');

		} else {

			$request->session()->flash('alert-error', 'Account Code Not Updated...!');
			return redirect('/view-mast-dealer');

		}

    }

     public function DeleteDealer(Request $request){

    	$id = $request->post('DealerID');
    	//print_r($DealerID);exit;

    	if ($id!='') {
    	

    	$acc_type = DB::table('master_acc')->where('id',$id)->get()->first();


        	$acc_type_code = DB::table('master_acc')->where('acctype_code',$acc_type->acctype_code)->get()->toArray();

        	
        	
        	$count =count($acc_type_code);
        	//

        	if($count >1){
        		$Delete = DB::table('master_acc')->where('id',$id)->delete();

        	}else{
        		$Delete = DB::table('master_acc')->where('id',$id)->delete();

        		$data=array(

        			'acc_mast'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$acc_type->acctype_code)->update($data);
        	
        	}



			if ($Delete) {

				$request->session()->flash('alert-success', ' Account Code Was Deleted Successfully...!');
				return redirect('/view-mast-dealer');

			} else {

				$request->session()->flash('alert-error', 'Account Code Can Not Deleted...!');
				return redirect('/view-mast-dealer');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Account Not Found...!');
			return redirect('/view-mast-destination');

    	}
    }
    
/*master dealer form*/


    public function DestinationForm(Request $request){

    	$title ='Add Master Area';

    	$data['help_area_list'] = DB::table('master_area')->Orderby('code', 'desc')->limit(5)->get();
    
    	return view('admin.cf.master.destination_form',$data+compact('title'));
    }

    public function DestinationFormSave(Request $request){

    	$validate = $this->validate($request, [

			'area_code'    => 'required|max:6|unique:master_area,code',
			'area_name'    => 'required|max:30',
			
		]);

		$createdBy = $request->session()->get('userid');

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$flag=0;

		$data = array(

			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"name"        => $request->input('area_name'),
			"code"        => $request->input('area_code'),
			"flag"        => $flag,
			"created_by"  => $createdBy,
		);

		$saveData = DB::table('master_area')->insert($data);

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

    	$data = DB::table('master_area')
            ->leftJoin('code_access', 'master_area.code', '=', 'code_access.code')
            ->select('master_area.*','code_access.outward_trans','code_access.sap_bill','code_access.fleet_trans','code_access.fleet_mast','code_access.rate_mast')
            ->where(['comp_name' => $compName, 'fiscal_year' => $fisYear])
            ->orderBy('id','DESC');


		}else if($userType=='superAdmin' || $userType=='user'){
			/*$data = DB::table('master_area')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear]);*/

			$data = DB::table('master_area')
            ->leftJoin('code_access', 'master_area.code', '=', 'code_access.code')
            ->select('master_area.*','code_access.outward_trans','code_access.sap_bill','code_access.fleet_trans','code_access.fleet_mast','code_access.rate_mast')
            ->where(['created_by' => $userid,'comp_name' => $compName, 'fiscal_year' => $fisYear])
            ->orderBy('id','DESC');

			//return view('admin.view_dealer',$dealerData);
		}
		else{

			$data='';
			//return view('admin.view_dealer',$dealerData);
		}

	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
	}

    	return view('admin.cf.master.view_destination');

    }

    public function EditDestinationForm($id,$btnControl){

    	$title ='Edit Master Area';
    	//print_r($id);
    	$id = base64_decode($id);
    	$btnControl = base64_decode($btnControl);


    	if($id!=''){
    	    $query = DB::table('master_area');
			$query->where('id', $id);
			$userData['destination_list'] = $query->get()->first();

			return view('admin.cf.master.destination_list', $userData+compact('title','btnControl'));
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

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');

		$destinationId = $request->input('destinationId');

		$data = array(
			"name"         => $request->input('area_name'),
			"code"         => $request->input('area_code'),
			"flag"         => $request->input('area_block'),
			"updated_by"   => $lastUpdatedBy,
			"updated_date" => $updatedDate,
		);

		

		$saveData = DB::table('master_area')->where('id',$destinationId)->update($data);
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
    		
    		$Delete = DB::table('master_area')->where('id', $destinationId)->delete();

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

     


    public function UmForm(Request $request){

    	$title = 'Add Master Um';
    	
    	$data['help_um_list'] = DB::table('master_um')->Orderby('um_code', 'desc')->limit(5)->get();

    	return view('admin.cf.master.um_form',$data+compact('title'));
    }

    public function UmFormSave(Request $request){

    	$validate = $this->validate($request, [

			'um_code'    => 'required|max:2|unique:master_um,um_code',
			'um_name'    => 'required|max:30',
			
		]);

    	$createdBy = $request->session()->get('userid');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');
    	$flag =0;
		$data = array(
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"um_code"     => $request->input('um_code'),
			"um_name"     => $request->input('um_name'),
			"flag"        => $flag,
			"created_by"  => $createdBy
			
		);

		$saveData = DB::table('master_um')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Um Was Successfully Added...!');
			return redirect('/view-mast-um');

		} else {

			$request->session()->flash('alert-error', 'Um Can Not Added...!');
			return redirect('/view-mast-um');

		}

    }

    public function UmView(Request $request){

    if($request->ajax()) {

    	$title = 'View Master Um';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');


    	if($userType=='admin'){

    		//$data = DB::table('master_um')->orderBy('id','DESC');

    		$data = DB::table('master_um')
            ->leftJoin('code_access', 'master_um.um_code', '=', 'code_access.code')
            ->select('master_um.*','code_access.item_um_mast')
            ->where(['comp_name' => $compName, 'fiscal_year' => $fisYear])
            ->orderBy('id','DESC');

    	 
		}else if($userType=='superAdmin' || $userType=='user'){

			/*$data = DB::table('master_um')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear]);*/

			$data = DB::table('master_um')
            ->leftJoin('code_access', 'master_um.um_code', '=', 'code_access.code')
            ->select('master_um.*','code_access.item_um_mast')
            ->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])
            ->orderBy('id','DESC');

			
		}else{

			$data='';
			
		}

    	 return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
	}
    	return view('admin.cf.master.view_um');

    }

    public function EditUmForm($id,$btnControl){

    	$title = 'Edit Master Um';

    	$id = base64_decode($id);
    	$btnControl = base64_decode($btnControl);
    	//print_r($id);
    	if($id!=''){
    	    $query = DB::table('master_um');
			$query->where('id', $id);
			$umData['um_list'] = $query->get()->first();

			return view('admin.cf.master.um_list', $umData+compact('title','btnControl'));
		}else{
			$request->session()->flash('alert-error', 'Um Not Found...!');
			return redirect('/form-mast-um');
		}

    }

    public function UmFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'um_code'    => 'required|max:2',
			'um_name'    => 'required|max:30',
			
		]);

		$lastUpdatedBy = $request->session()->get('userid');
		$updatedDate = date('Y-m-d');

    	$umId = $request->input('umId');
		$data = array(
			"um_code"      => $request->input('um_code'),
			"um_name"      => $request->input('um_name'),
			"flag"         => $request->input('um_block'),
			"updated_by"   => $lastUpdatedBy,
			"updated_date" => $updatedDate
			
			
		);

		 $saveData = DB::table('master_um')->where('id',$umId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Um Was Successfully Added...!');
			return redirect('/view-mast-um');

		} else {

			$request->session()->flash('alert-error', 'Um Can Not Added...!');
			return redirect('/view-mast-um');

		}
    }

    public function DeleteUm(Request $request){

    	$UmID = $request->post('UmID');

    	if ($UmID!='') {
    		
    		$Delete = DB::table('master_um')->where('id', $UmID)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Um Was Deleted Successfully...!');
				return redirect('/view-mast-um');

			} else {

				$request->session()->flash('alert-error', 'Um Can Not Deleted...!');
				return redirect('/view-mast-um');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Um Not Found...!');
			return redirect('/view-mast-um');

    	}
    }


   


     public function accessControl(Request $request){

    	$name1 = $request->input('name1');
    	$userid = $request->input('userid');
    	
        $count =count($name1);
        //print_r($userid);
        $saveData ='';
        for ($i=0; $i < $count ; $i++) { 

        	$data=array(

        		'user_id'=>$userid,
        		'form_name_id'=>$name1[$i],

    			);
        	
        $saveData = DB::table('master_form')->insert($data);

			
        }


            if ($saveData) {

				$request->session()->flash('alert-success', 'User Was Successfully Added...!');
				return redirect('/view-mast-user');

			} else {

				$request->session()->flash('alert-error', 'User Can Not Added...!');
				return redirect('/view-mast-user');

			}

    }

    public function accessUpdateControl(Request $request){
    	$name1 = $request->input('name1');
    	$userid = $request->input('userid');

    	if ($userid!='') {
    		
    	$Delete = DB::table('master_form')->where('user_id',$userid)->delete();
    	}
    	
        $count =count($name1);
        //print_r($userid);
        $saveData ='';
        for ($i=0; $i < $count ; $i++) { 

        	$data=array(

        		'user_id'=>$userid,
        		'form_name_id'=>$name1[$i],

    			);
      

	   $saveData = DB::table('master_form')->insert($data);
        }

        

            if ($saveData) {

				$request->session()->flash('alert-success', 'User Was Successfully Update...!');
				return redirect('/view-mast-user');

			} else {

				$request->session()->flash('alert-error', 'User Can Not Update...!');
				return redirect('/view-mast-user');

			}

    }




/*search depot code on input*/

	public function search_depot(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$depot_code = $request->input('depot_code_search');

	    	$item_um_aum_list = DB::select("SELECT * FROM `master_depot` WHERE depot_code LIKE '$depot_code%'");

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

    
/*search depot code on input*/

/*search depot code when click on help button*/
	
	public function HelpDepotCodeSearch(Request $request){

		$response_array = array();

	    $depot_code_help = $request->input('HelpdepotCode');

		if ($request->ajax()) {

	    	$Seach_depot_Code_by_help = DB::select("SELECT * FROM `master_depot` WHERE depot_code='$depot_code_help' OR depot_name='$depot_code_help' OR depot_code Like '$depot_code_help%' OR depot_name LIKE '$depot_code_help%' ORDER BY depot_code DESC limit 5  ");
	    	
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

/*search depot code when click on help button*/

/*search area code on input*/

	public function search_AreaCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$SerachAreaCode = $request->input('SerachAreaCode');

	    	$item_um_aum_list = DB::select("SELECT * FROM `master_area` WHERE code LIKE '$SerachAreaCode%'");

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

	    	$Seach_depot_Code_by_help = DB::select("SELECT * FROM `master_area` WHERE code='$area_code_help' OR name='$area_code_help' OR code Like '$area_code_help%' OR name LIKE '$area_code_help%' ORDER BY code DESC limit 5  ");
	    	
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

/*search company code on input*/

public function search_CompanyCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$companyCodeSearch = $request->input('companyCodeSearch');

	    	$company_list = DB::select("SELECT * FROM `MASTER_COMP` WHERE COMP_CODE LIKE '$companyCodeSearch%'");

	    	$count = count($company_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $company_list ;

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
/*search company code on input*/

/*search company code when click on help button*/
    public function HelpCompanyCodeSearch(Request $request){

		$response_array = array();

	    $company_code_help = $request->input('HelpCompCode');

		if ($request->ajax()) {

	    	$Seach_company_Code_by_help = DB::select("SELECT * FROM `MASTER_COMP` WHERE COMP_CODE='$company_code_help' OR COMP_NAME='$company_code_help' OR COMP_CODE Like '$company_code_help%' OR COMP_NAME LIKE '$company_code_help%' ORDER BY COMP_CODE DESC limit 5  ");
	    	
    		if ($Seach_company_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_company_Code_by_help ;

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
/*search company code when click on help button*/

/*search item code on input*/
	 public function search_ItemsCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$ItemCodeSearch = $request->input('ItemCodeSearch');

	    	$item_code_list = DB::select("SELECT * FROM `master_item` WHERE item_code LIKE '$ItemCodeSearch%'");

	    	$count = count($item_code_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_code_list ;

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
/*search item code on input*/

/*search item code when click on help button*/
	public function HelpItemCodeSearch(Request $request){

		$response_array = array();

	    $item_code_help = $request->input('HelpItemCode');

		if ($request->ajax()) {

	    	$Seach_item_Code_by_help = DB::select("SELECT * FROM `master_item` WHERE item_code='$item_code_help' OR item_name='$item_code_help' OR item_code Like '$item_code_help%' OR item_name LIKE '$item_code_help%' ORDER BY item_code DESC limit 5  ");
	    	
    		if ($Seach_item_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_item_Code_by_help ;

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

    

    public function HelpTruckNoSearch(Request $request){

		$response_array = array();

	    $truck_no_help = $request->input('HelpTruckNo');

		if ($request->ajax()) {

	    	$Seach_truck_no_by_help = DB::select("SELECT * FROM `master_fleet` WHERE truck_no='$truck_no_help'  OR truck_no Like '$truck_no_help%' ORDER BY truck_no DESC limit 5");
	    	
    		if ($Seach_truck_no_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_truck_no_by_help ;

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

     public function search_truck_no(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$truck_no = $request->input('truck_no');

	    	$truck_no_list = DB::select("SELECT * FROM `MASTER_FLEET` WHERE truck_no LIKE '$truck_no%'");

	    	$count = count($truck_no_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $truck_no_list ;

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
/*search item code when click on help button*/

/*search account code on input*/
	public function search_AccountCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$serachAcountCode = $request->input('serachAcountCode');

	    	$item_um_aum_list = DB::select("SELECT * FROM `master_acc` WHERE acc_code LIKE '$serachAcountCode%'");

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
/*search account code on input*/

/*search account code when click on help button*/
   	public function HelpAccountCodeSearch(Request $request){

		$response_array = array();

	    $account_code_help = $request->input('HelpAccountCode');

		if ($request->ajax()) {

	    	$Seach_account_Code_by_help = DB::select("SELECT * FROM `master_acc` WHERE acc_code='$account_code_help' OR acc_name='$account_code_help' OR acc_code Like '$account_code_help%' OR acc_name LIKE '$account_code_help%' ORDER BY acc_code DESC limit 5  ");
	    	
    		if ($Seach_account_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_account_Code_by_help ;

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

    public function HelpFyCodeSearch(Request $request){

		$response_array = array();

		$fy_code_help = $request->input('HelpFyCode');
		$compCode     = $request->input('compCode');

		if ($request->ajax()) {

	    	$Seach_fy_Code_by_help = DB::select("SELECT * FROM `MASTER_FY` WHERE (COMP_CODE='$compCode' AND FY_CODE='$fy_code_help')  OR (COMP_CODE='$compCode' AND  FY_CODE Like '$fy_code_help%') ORDER BY FY_CODE DESC limit 5");
	    	
    		if ($Seach_fy_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_fy_Code_by_help ;

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

     public function search_fy_code(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$fy_code = $request->input('fy_code');
	    	$compCode = $request->input('compCode');

	    	$fy_code_list = DB::select("SELECT * FROM `MASTER_FY` WHERE COMP_CODE='$compCode' AND FY_CODE LIKE '$fy_code%'");

	    	$count = count($fy_code_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fy_code_list ;

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
/*search account code when click on help button*/

/*search fleet truck on input*/
	
	public function search_fleettrcuk(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$whelcodSearch = $request->input('whelcodSearch');

	    	$item_code_list = DB::select("SELECT * FROM `fleet_truck_wheel` WHERE wheel_code LIKE '$whelcodSearch%'");

	    	$count = count($item_code_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_code_list ;

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

/*search fleet truck on input*/

/*search fleet truck when click on help button*/

	public function HelpFletTrcukSearch(Request $request){

		$response_array = array();

	    $wheel_code_help = $request->input('HelpWheelCode');

		if ($request->ajax()) {

	    	$Seach_whel_Code_by_help = DB::select("SELECT * FROM `fleet_truck_wheel` WHERE wheel_code='$wheel_code_help' OR wheel_name='$wheel_code_help' OR wheel_code Like '$wheel_code_help%' OR wheel_name LIKE '$wheel_code_help%' ORDER BY wheel_code DESC limit 5  ");
	    	
    		if ($Seach_whel_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_whel_Code_by_help ;

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

/*search fleet truck when click on help button*/

/*search manufacturing code on input*/

	public function search_VehicleMfg(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vehiclemfgSearch = $request->input('vehiclemfgSearch');

	    	$manufactur_list = DB::select("SELECT * FROM `Master_Vehicle_Mfg` WHERE vehicle_mfg_code LIKE '$vehiclemfgSearch%'");

	    	$count = count($manufactur_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $manufactur_list ;

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

/*search manufacturing code on input*/

/*search manufacturing when click on help button*/

	public function HelVehicleMfgSearch(Request $request){

		$response_array = array();

	    $Mfg_code_help = $request->input('HelpMfgCode');

		if ($request->ajax()) {

	    	$Seach_mfg_Code_by_help = DB::select("SELECT * FROM `Master_Vehicle_Mfg` WHERE vehicle_mfg_code='$Mfg_code_help' OR vehicle_mfg_name='$Mfg_code_help' OR vehicle_mfg_code Like '$Mfg_code_help%' OR vehicle_mfg_name LIKE '$Mfg_code_help%' ORDER BY vehicle_mfg_code DESC limit 5  ");
	    	
    		if ($Seach_mfg_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_mfg_Code_by_help ;

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

    public function AddProjectDetails(Request $request){

    	$title = 'Project Details Master';

	 	$compName = $request->session()->get('company_name');

	 	$project_code = DB::table('MASTER_PROJECT')->get();


	    if(isset($compName)){

	    	return view('admin.finance.master.Infrastructure.add_project_detail',compact('title','project_code'));

	    }else{

			return redirect('/useractivity');
		}
    }

    public function SaveProjectDetails(Request $request){

    	$createdBy   = $request->session()->get('userid');

		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

		$getcomcode  = explode('-', $compName);
		
		$comp_code   = $getcomcode[0];
		$comp_name   = $getcomcode[1];
		
		$projectCode = $request->input('project_code');
		$wingNo      = $request->input('wing_no');
		$towerNo     = $request->input('tower_no');
		$floorNo     = $request->input('floorNo');
		$unitNo      = $request->input('unit');

		$pro_det_Count = count($wingNo);
		// print_r($pro_det_Count);

        for ($i=0;$i < $pro_det_Count;$i++) {

            $PApvH = DB::select("SELECT MAX(PROJECTID) as Id FROM MASTER_PROJECT_DETAIL");
			$apvID = json_decode(json_encode($PApvH), true); 
        	
        	$id= $apvID[0]['Id'];
            $projId = '';
            if($id==''){
              $projId = 1;
            }else{
              $projId = $id + 1;
            }

          // print_r($projId);exit();

			$getprocode = $projectCode[$i];

			if($getprocode){
				$getprocode = explode('-',$getprocode);
			
				$getpcode   = $getprocode[0];
				$getpname   = $getprocode[1];	
			}else{
				$getpcode = '';
				$getpname = '';
			}
			


			$data = array(
				"PROJECTID"   => $projId,
				"PROJECT_CODE" => $getpcode,
				"PROJECT_NAME" => $getpname,
				"WING_NO"      => $wingNo[$i],
				"TOWER_NO"     => $towerNo[$i],
				"FLOOR_NO"     => $floorNo[$i],
				"UNIT_NO"      => $unitNo[$i],
				"FLAG"         => 0,
				"CREATED_BY"   => $createdBy
			);

			// print_r($wingNo[$i]);

			$savedata = DB::table('MASTER_PROJECT_DETAIL')->insert($data);
			// echo '<PRE>';print_r($data);


		}

		

		$response_array = array();

		if($savedata){

			$response_array['response'] = 'success';
		        
		    $data = json_encode($response_array);

		    print_r($data);

		}else{

			$response_array['response'] = 'error';
		        
		    $data = json_encode($response_array);

		    print_r($data);

		}

    }

    public function ViewProjectDetails(Request $request){


    	$compName = $request->session()->get('company_name');

		if($request->ajax()){
	      
	      	$title    = 'View Project Detail Master';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

		   if($userType=='admin'){

		    	$data = DB::table('MASTER_PROJECT_DETAIL');

	      }else if ($userType=='superAdmin' || $userType=='user'){    		

		    	$data = DB::table('MASTER_PROJECT_DETAIL');

		   }else{
		    		$data ='';
		   }

		   return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

	   }

		if(isset($compName)){
	    	
	    	return view('admin.finance.master.Infrastructure.view_project_detail');
		
		}else{

			return redirect('/useractivity');
		}


    }

    public function EditProjectDetails(Request $request,$id){

    	$id = base64_decode($id);

    	$project_code = DB::table('MASTER_PROJECT')->get();


    	if($id!= ''){

    		$data = DB::table('MASTER_PROJECT_DETAIL')->where('PROJECTID',$id)->get()->first();

    		// echo '<PRE>';print_r($data);exit;
            return view('admin.finance.master.Infrastructure.edit_project_detail',compact('data','project_code'));
         	
    	}else{

    		$request->session()->flash('alert-error', 'Um Not Found...!');
			return redirect('/form-mast-um');
    	}
    }

    public function UpdateProjectDetails(Request $request){

    	$createdBy   = $request->session()->get('userid');

		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

		$getcomcode  = explode('-', $compName);
		
		$comp_code   = $getcomcode[0];
		$comp_name   = $getcomcode[1];
		
		$projectId   = $request->input('projectId');
		$projectCode = $request->input('project_code');

		$wingNo      = $request->input('wing_no');
		$towerNo     = $request->input('tower_no');
		$floorNo     = $request->input('floorNo');
		$unitNo      = $request->input('unit');

		

			if($projectCode){
				$getprocode = explode('-',$projectCode);
			
				$getpcode   = $getprocode[0];
				$getpname   = $getprocode[1];	
			}else{
				$getpcode = '';
				$getpname = '';
			}

		if($projectId!= ''){

			$data = array(
				"PROJECT_CODE" => $getpcode,
				"PROJECT_NAME" => $getpname,
				"WING_NO"      => $wingNo,
				"TOWER_NO"     => $towerNo,
				"FLOOR_NO"     => $floorNo,
				"UNIT_NO"      => $unitNo,
				"FLAG"         => 0,
				"CREATED_BY"   => $createdBy
			);

			$savedata = DB::table('MASTER_PROJECT_DETAIL')->where('PROJECTID',$projectId)->update($data);

			$response_array = array();

			if($savedata){

				$response_array['response'] = 'success';
			        
			    $data = json_encode($response_array);

			    print_r($data);

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



/*search manufacturing when click on help button*/

}
