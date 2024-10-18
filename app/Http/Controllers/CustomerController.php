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
class CustomerController extends Controller{

	//public $data;

	public function __construct(Request $request){

		//$this->data = "smit@121";

	}

/* -------------------	START : ACCOUNT TYPE MASTER --------------------- */

	public function AccountType(Request $request){

     	$title = 'Add Account Type Master';

     	$compName  = $request->session()->get('company_name');

     	$data['help_acc_type_list'] = DB::table('MASTER_ACCTYPE')->Orderby('ATYPE_CODE', 'desc')->limit(5)->get();

    	return view('admin.finance.master.customer.acc_type_form',$data+compact('title'));

	    if(isset($compName)){

	    	return view('admin.finance.master.customer.acc_type_form',$data+compact('title'));
	    }else{

			return redirect('/useractivity');
		}

    }

    public function AccountTypeSave(Request $request){
	
		$validate = $this->validate($request, [
			'acc_type_code' => 'required|max:6|unique:MASTER_ACCTYPE,ATYPE_CODE',
			'acc_type_name' => 'required|max:40',	
			
		]);

		$createdBy = $request->session()->get('userid');
		
		$compName  = $request->session()->get('company_name');
		
		$fisYear   =  $request->session()->get('macc_year');
		
		$data = array(
			"ATYPE_CODE" => $request->input('acc_type_code'),
			"ATYPE_NAME" => $request->input('acc_type_name'),
			"BILL_TRACK" => $request->input('bill_track'),
			"BANK_REQ"   => $request->input('bankDetsReq'),
			"CREATED_BY" => $createdBy
			
		);

		$saveData = DB::table('MASTER_ACCTYPE')->insert($data);

		$discriptn_page = "Master acc type insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Account Type Was Successfully Added...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Type');

		} else {

			$request->session()->flash('alert-error', 'Account Type Can Not Added...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Type');

		}

    }

    public function AccountTypeView(Request $request){

    	$compName = $request->session()->get('company_name');

    	if($request->ajax()) {

	    	$title = 'View Master Account Type';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');


	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_ACCTYPE')->orderBy('ATYPE_CODE','DESC');
			}else if($userType=='superAdmin' || $userType=='user'){

				$data = DB::table('MASTER_ACCTYPE')->orderBy('ATYPE_CODE','DESC');
			}else{

				$data ='';
				
			}

			return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
					
				})->toJson();
		}
    	if(isset($compName)){
    		return view('admin.finance.master.customer.view_acc_type');
	    }else{
			return redirect('/useractivity');
	   }


    }

    public function EditAccountType($typeCode){

    	$title = 'Edit Master Account Type';

    	$typeCode= base64_decode($typeCode);

    	if($typeCode!=''){
				$query = DB::table('MASTER_ACCTYPE');
				$query->where('ATYPE_CODE', $typeCode);
				$acctypeData['acctype_list']  = $query->get()->first();
			return view('admin.finance.master.customer.edit_acc_type', $acctypeData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Account Type Not Found...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Type');
		}

    }

    public function AccountTypeUpdate(Request $request){

    	$validate = $this->validate($request, [

			'acc_type_code' => 'required|max:6',
			'acc_type_name' => 'required|max:40',	
			
		]);

		$acctypeCode = $request->input('acctypeCode');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');

		$data = array(
			"ATYPE_CODE"       => $request->input('acc_type_code'),
			"ATYPE_NAME"       => $request->input('acc_type_name'),
			"BILL_TRACK"       => $request->input('bill_track'),
			"ATYPE_BLOCK"      => $request->input('acctype_block'),
			"BANK_REQ"         => $request->input('bankDetsReq'),
			"LAST_UPDATE_BY"   => $lastUpdatedBy,
			"LAST_UPDATE_DATE" => $updatedDate
			
		);

		try{

			$saveData = DB::table('MASTER_ACCTYPE')->where('ATYPE_CODE',$acctypeCode)->update($data);

			$discriptn_page = "Master acc type update done by user";
			$this->userLogInsert($lastUpdatedBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Account Type Was Successfully Update...!');
				return redirect('/Master/Customer-Vendor/View-Acc-Type');

			} else {

				$request->session()->flash('alert-error', 'Account Type Can Not Update...!');
				return redirect('/Master/Customer-Vendor/View-Acc-Type');

			}
		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Account Type be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Customer-Vendor/View-Acc-Type');
		}
    }

    public function DeleteAccountType(Request $request){

    	$acctypeCode= $request->post('acctypeID');
   
    	if ($acctypeCode!='') {

    		try{
    		
    		$Delete = DB::table('MASTER_ACCTYPE')->where('ATYPE_CODE',$acctypeCode)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', ' Account Type Was Deleted Successfully...!');
					return redirect('/Master/Customer-Vendor/View-Acc-Type');

				} else {

					$request->session()->flash('alert-error', 'Account Type Can Not Deleted...!');
					return redirect('/Master/Customer-Vendor/View-Acc-Type');

				}
			}
			catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Account Type be be Deleted...! Used In Another Transaction...!');
					return redirect('/Master/Customer-Vendor/View-Acc-Type');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Account Type Found...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Type');

    	}
    }

    public function search_acc_type(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$acc_type_code = $request->input('acc_type_code');

	    	$acc_type_list = DB::select("SELECT * FROM `MASTER_ACCTYPE` WHERE ATYPE_CODE LIKE '$acc_type_code%'");

	    	$count = count($acc_type_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $acc_type_list ;

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

    public function HelpAccTypeCodeSearch(Request $request){

		$response_array = array();

	    $acc_type_code_help = $request->input('HelpaccTypeCode');

		if ($request->ajax()) {

	    	$Seach_Acc_Code_by_help = DB::select("SELECT * FROM `MASTER_ACCTYPE` WHERE ATYPE_CODE='$acc_type_code_help' OR ATYPE_NAME='$acc_type_code_help' OR ATYPE_CODE Like '$acc_type_code_help%' OR ATYPE_NAME LIKE '$acc_type_code_help%' ORDER BY ATYPE_CODE DESC limit 5  ");
	    	
    		if ($Seach_Acc_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_Acc_Code_by_help ;

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

/* -------------------	END : ACCOUNT TYPE MASTER --------------------- */
    
/*search Acc Category code on input*/

	public function search_AccCatCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$AccCateSearch = $request->input('AccCateSearch');

	    	$AccCatcode_list = DB::select("SELECT * FROM `MASTER_ACATG` WHERE ACATG_CODE LIKE '$AccCateSearch%'");

	    	$count = count($AccCatcode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $AccCatcode_list ;

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

/*search Acc Category code on input*/

/* -------- end account type master ------- */


/* -------------------- START : ACCOUNT CATEGORY MASTER ------------------------ */

	public function AccCategory(Request $request){

		$title = 'Add Acc Category';

		$compName 	= $request->session()->get('company_name');

		$acc_category_code = $request->old('acc_category_code');
		$acc_category_name = $request->old('acc_category_name');
		$category_block    = $request->old('category_block');
		$category_id       = $request->old('category_id');

		$userData['AccCat_mst_list'] = DB::table('MASTER_ACATG')->Orderby('ACATG_CODE', 'desc')->limit(5)->get();

		$button='Save';

    	$action='/Master/Customer-Vendor/Acc-Category-Save';

		if(isset($compName)){

	    	return view('admin.finance.master.customer.acc_category',$userData+compact('title','acc_category_code','acc_category_name','category_block','category_id','action','button'));

	    }else{

			return redirect('/useractivity');
		}

	}

	public function SaveAccCategory(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$loginuser = $request->session()->get('userid');

		$validate = $this->validate($request, [

				'acc_category_code'      => 'required|max:6|unique:MASTER_ACATG,ACATG_CODE',
				'acc_category_name'      => 'required|max:40',
		]);

		$data = array(

					"ACATG_CODE" =>  $request->input('acc_category_code'),
					"ACATG_NAME" =>  $request->input('acc_category_name'),
					"CREATED_BY" =>  $request->session()->get('userid')	
	    	);

		$saveData = DB::table('MASTER_ACATG')->insert($data);

		$discriptn_page = "Master acc category insert done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Acc Category Data Was Successfully Added...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Category-Mast');

		} else {

			$request->session()->flash('alert-error', 'Acc Category Data Can Not Added...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Category-Mast');

		}

	}


	public function ViewAccCategory(Request $request){

		$CompanyCode = $request->session()->get('company_name');

    	if ($request->ajax()) {

		$user_type   = $request->session()->get('user_type');
		
		$userid      = $request->session()->get('userid');
		
		$CompanyCode = $request->session()->get('company_name');
		
		$macc_year   = $request->session()->get('macc_year');

			if($user_type == 'admin'){
	    
	       	 $data = DB::table('MASTER_ACATG')->orderBy('ACATG_CODE','DESC');

	    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

	    	 $data = DB::table('MASTER_ACATG')->orderBy('ACATG_CODE','DESC');
	    	}else{
	    		
	    	 $data ='';
	    	}

			return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
        }

       	if(isset($CompanyCode)){
       		return view('admin.finance.master.customer.view_acc_category');
  		}else{
			return redirect('/useractivity');
	   }

    }


    public function DeleteAccCat(Request $request){

        $accCate = $request->input('acccatid');
        if ($accCate!='') {
       
       		try{

				$Delete = DB::table('MASTER_ACATG')->where('ACATG_CODE', $accCate)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Acc Category Data Was Deleted Successfully...!');
					return redirect('/Master/Customer-Vendor/View-Acc-Category-Mast');

				} else {

					$request->session()->flash('alert-error', 'Acc Category Data Can Not Deleted...!');
					return redirect('/Master/Customer-Vendor/View-Acc-Category-Mast');

				}

			}
			catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Acc Category be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Customer-Vendor/View-Acc-Category-Mast');
			}
		}else{
			$request->session()->flash('alert-error', 'Acc Category Data Not Found...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Category-Mast');

		}
	}


	public function EditAccCategory($accCate){

    	$title = 'Edit Acc Category';

    	//print_r($id);
    	$accCate = base64_decode($accCate);

    	if($accCate!=''){
    	    $query = DB::table('MASTER_ACATG');
			$query->where('ACATG_CODE', $accCate);
			$classData= $query->get()->first();
			
			$acc_category_code = $classData->ACATG_CODE;
			$acc_category_name = $classData->ACATG_NAME;
			$category_block    = $classData->ACATG_BLOCK;
			$category_id       = $classData->ACATG_CODE;

			$button='Update';
			$action='/Master/Customer-Vendor/Acc-Category-Update';

			return view('admin.finance.master.customer.acc_category',compact('title','acc_category_code','acc_category_name','category_block','category_id','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Acc Category Data Not Found...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Category-Mast');
		}

    }

    public function UpdateAccCategory(Request $request){

		$validate = $this->validate($request, [

				'acc_category_code' => 'required|max:6',
				'acc_category_name' => 'required|max:40',
				'category_block'    => 'required',
		]);

       $id = $request->input('idcategory');
       $updatedDate = date('Y-m-d');
       $loginuser = $request->session()->get('userid');

		$data = array(
				"ACATG_CODE"       =>  $request->input('acc_category_code'),
				"ACATG_NAME"       =>  $request->input('acc_category_name'),
				"ACATG_BLOCK"      =>  $request->input('category_block'),
				"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
				"LAST_UPDATE_DATE" =>  $updatedDate
	 
    	);

		try{
			$saveData = DB::table('MASTER_ACATG')->where('ACATG_CODE', $id)->update($data);
			$discriptn_page = "Master acc category update done by user";
			$this->userLogInsert($loginuser,$discriptn_page);
			if ($saveData) {

				$request->session()->flash('alert-success', 'Acc Category Data Was Successfully Updated...!');
				return redirect('/Master/Customer-Vendor/View-Acc-Category-Mast');

			} else {

				$request->session()->flash('alert-error', 'Acc Category Data Can Not Updated...!');
				return redirect('/Master/Customer-Vendor/View-Acc-Category-Mast');

			}
		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Acc Category be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Customer-Vendor/View-Acc-Category-Mast');
		}
	}

/* -------------------- END : ACCOUNT CATEGORY MASTER ------------------------ */


/* -------------------- START : ACCOUNT CLASS MASTER ------------------------ */

	public function AccClass(Request $request){

		$title        ='Add Acc Class Master';

		$compName 	= $request->session()->get('company_name');
		
		$acc_class_code  = $request->old('acc_class_code');
		$acc_class_name  = $request->old('acc_class_name');
		$acc_class_id    = $request->old('acc_class_id');
		$acc_class_block = $request->old('acc_class_block');

		$userData['AccClass_mst_list'] = DB::table('MASTER_ACLASS')->Orderby('ACLASS_CODE', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/Master/Customer-Vendor/Acc-Class-Save';

		if(isset($compName)){

	    	return view('admin.finance.master.customer.acc_class_form',$userData+compact('title','acc_class_code','acc_class_name','acc_class_id','acc_class_block','button','action'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function AccClassSave(Request $request){

		$validate = $this->validate($request, [

			'acc_class_code' => 'required|max:6|unique:MASTER_ACLASS,ACLASS_CODE',
			'acc_class_name' => 'required|max:40',

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"ACLASS_CODE" => $request->input('acc_class_code'),
			"ACLASS_NAME" => $request->input('acc_class_name'),
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData = DB::table('MASTER_ACLASS')->insert($data);

		$discriptn_page = "Master acc class insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Acc Class Was Successfully Added...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Class');

		} else {

			$request->session()->flash('alert-error', 'Acc Class Can Not Added...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Class');

		}

	}

	public function EditAccClass($accClass){

    	$title = 'Edit Acc Class Master';

    	$accClass = base64_decode($accClass);

    	if($accClass!=''){
    	    $query = DB::table('MASTER_ACLASS');
			$query->where('ACLASS_CODE', $accClass);
			$classData= $query->get()->first();

			$acc_class_code  = $classData->ACLASS_CODE;
			$acc_class_name  = $classData->ACLASS_NAME;
			$acc_class_id    = $classData->ACLASS_CODE;
			$acc_class_block = $classData->ACLASS_BLOCK;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/Master/Customer-Vendor/Acc-Class-Update';

			return view('admin.finance.master.customer.acc_class_form',compact('title','acc_class_code','acc_class_name','acc_class_id','acc_class_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Acc Class Not Found...!');
			return redirect('/finance/view-mast-acc-class');
		}

    }


    public function AccClassFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'acc_class_code' => 'required|max:6',
			'acc_class_name' => 'required|max:40',

		]);

		$acc_classCode = $request->input('acc_class_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"ACLASS_CODE"      => $request->input('acc_class_code'),
			"ACLASS_NAME"      => $request->input('acc_class_name'),
			"ACLASS_BLOCK"     => $request->input('acc_class_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		try{

			$saveData = DB::table('MASTER_ACLASS')->where('ACLASS_CODE', $acc_classCode)->update($data);

			$discriptn_page = "Master acc class update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Acc Class Was Successfully Updated...!');
				return redirect('/Master/Customer-Vendor/View-Acc-Class');

			} else {

				$request->session()->flash('alert-error', 'Acc Class Can Not Added...!');
				return redirect('/Master/Customer-Vendor/View-Acc-Class');

			}
		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Acc Class be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Customer-Vendor/View-Acc-Class');
		}

	}

	public function ViewAccClass(Request $request){

   	$compName = $request->session()->get('company_name');

		if($request->ajax()){

	    	$title = 'View Acc Class Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    	$data  = DB::table('MASTER_ACLASS')->orderBy('ACLASS_CODE','DESC');

	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data  = DB::table('MASTER_ACLASS')->orderBy('ACLASS_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

    		return DataTables()->of($data)->addIndexColumn()->toJson();

		}
		if(isset($compName)){
	    	return view('admin.finance.master.customer.view_acc_class');
	    }else{
			return redirect('/useractivity');
		   }
    }


    public function DeleteAccClass(Request $request){

		$classCode = $request->post('classId');
    	

    	if ($classCode!='') {

    		try{
    		
    		$Delete = DB::table('MASTER_ACLASS')->where('ACLASS_CODE', $classCode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Acc Class Was Deleted Successfully...!');
				return redirect('/Master/Customer-Vendor/View-Acc-Class');

			} else {

				$request->session()->flash('alert-error', 'Acc Class Can Not Deleted...!');
				return redirect('/Master/Customer-Vendor/View-Acc-Class');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Acc Class be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Customer-Vendor/View-Acc-Class');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Acc Class Not Found...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Class');

    	}

	}

	/*search Acc Class code code on input*/

	public function search_AccClsCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$AccClassSearch = $request->input('AccClassSearch');

	    	$AccClasCode_list = DB::select("SELECT * FROM `MASTER_ACLASS` WHERE ACLASS_CODE LIKE '$AccClassSearch%'");

	    	$count = count($AccClasCode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $AccClasCode_list ;

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

/*search Acc Class code code on input*/


/* -------------------- END : ACCOUNT CLASS MASTER ------------------------ */


/* -------------------- END : ACCOUNT MASTER ------------------------ */

	public function AddAccount(Request $request){

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

	    	return view('admin.finance.master.customer.account',$userData+compact('title'));
	    }else{

			return redirect('/useractivity');
		}

	}

	public function AccountSave(Request $request){

/*
		echo '<pre>';

		print_r($request->post());exit;

		echo '</pre>';


*/       
		

		if ($request->ajax()) {

			$createdBy        = $request->session()->get('userid');
			$comp_code        = $request->input('comp_code');
			$comp_name        = $request->input('comp_name');
			$acc_code         = $request->input('acc_code');
			$slno             = $request->input('slno');

			$accname         = $request->input('acc_name');
			$acc_name = strtoupper($accname);
			$acctype_code     = $request->input('acctype_code');
			$splitAccType     = explode('[',$acctype_code);
			$acccategory_code = $request->input('acccategory_code');
			$accclass_code    = $request->input('accclass_code');
			$gl_code          = $request->input('gl_code');
			$splitgl          = explode('[',$gl_code);
			$bill_track       = $request->input('bill_track');
			$contact_person   = $request->input('contact_person');
			//$address1         = $request->input('address');
			$city             = $request->input('city');
			$pincode          = $request->input('pincode');
			$district         = $request->input('district');
			$state            = $request->input('state');
			$phone            = $request->input('phone');
			$fax              = $request->input('fax');
			$email            = $request->input('email');
			$tax_code         = $request->input('tax_code');
			$tds_code         = $request->input('tds_code');
			$tan_no           = $request->input('tan_no');
			$tinno            = $request->input('tinno');
			$sales_taxno      = $request->input('sales_taxno');
			$csales_taxno     = $request->input('csales_taxno');
			$service_taxno    = $request->input('service_taxno');
			$panno            = $request->input('panno');
			$gst_type         = $request->input('gst_type');
			$gst_num          = $request->input('gst_num');
			$ecc_no           = $request->input('ecc_no');
			$range_no         = $request->input('range_no');
			$range_name       = $request->input('range_name');
			$range_address    = $request->input('range_address');
			$division         = $request->input('division');
			$collector        = $request->input('collector');
			$bank_name        = $request->input('bank_name');
			$acc_number       = $request->input('acc_number');
			$branch_name      = $request->input('branch_name');
			$ifsc_code        = $request->input('ifsc_code');
			$bank_address     = $request->input('bank_address');
			$credit_limit     = $request->input('credit_limit');
			$offDays          = $request->input('offDays');
			$gp_days          = $request->input('gp_days');
			$AliasCode        = $request->input('AliasCode');
			$AliasName        = $request->input('AliasName');
			$sapCode          = $request->input('sap_code');
			$file_path        = $request->input('file_path');
			$bill_format      = $request->input('bill_format');
			$tds_type         = $request->input('tds_type');

			if($acccategory_code){
				$splitAcccat      = explode('[',$acccategory_code);
				$accCatCode = $splitAcccat[0];
				$accCatName = substr($splitAcccat[1], 0, -1);
			}else{
				$accCatCode ='';
				$accCatName ='';
			}

			if($accclass_code){
				$splitAcccls      = explode('[',$accclass_code);
				$accClsCode = $splitAcccls[0];
				$accClsName = substr($splitAcccls[1], 0, -1);
			}else{
				$accClsCode ='';
				$accClsName ='';
			}


		DB::beginTransaction();

		try {

			


			$data = array(
				
				"COMP_CODE"     => $comp_code,
				"COMP_NAME"     => $comp_name,
				"ACC_CODE"      => $acc_code,
				"ACC_NAME"      => $acc_name,
				"ATYPE_CODE"    => $splitAccType[0],
				"ATYPE_NAME"    => substr($splitAccType[1], 0, -1),
				"ACATG_CODE"    => $accCatCode,
				"ACATG_NAME"    => $accCatName,
				"ACLASS_CODE"   => $accClsCode,
				"ACLASS_NAME"   => $accClsName,
				"GL_CODE"       => $splitgl[0],
				"GL_NAME"       => substr($splitgl[1], 0, -1),
				"CREADIT_LIMIT" => $credit_limit,
				"GP_DAYS"       => $gp_days,
				"ALIAS_CODE"    => $AliasCode,
				"ALIAS_NAME"    => $AliasName,
				"SAP_CODE"      => $sapCode,
				"FILE_PATH"     => $file_path,
				"BILL_FORMAT"   => $bill_format,
				"TDS_NO"        => $tds_type,
				"TDS_CODE"      => $tds_code,
				"TAN_NO"        => $tan_no,
				"TIN_NO"        => $tinno,
				"SALES_TAXNO"   => $sales_taxno,
				"CSALES_TEXNO"  => $csales_taxno,
				"SERVICE_TAXNO" => $service_taxno,
				"PAN_NO"        => $panno,
				"BANK_NAME"     => $bank_name,
				"ACC_NUMBER"    => $acc_number,
				"BRANCH_NAME"   => $branch_name,
				"IFSC_CODE"     => $ifsc_code,
				"BANK_ADDRESS"  => $bank_address,
				'CREATED_BY'    => $createdBy,
				
			);

            // echo '<pre>';
            // print_r($data);exit();
			DB::table('MASTER_ACC')->insert($data);

			$discriptn_page = "Master acc insert done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			$address = $request->input('address');


			//print_r($address);exit;


			$count = count($address);

			for($i=0; $i < $count; $i++){

				$cp_code = $acc_code.'-'.$slno[$i];
				$splicity = explode('[',$city[$i]);
				$splidist = explode('[',$district[$i]);
				$splistate = explode('[',$state[$i]);

				$data1 =array(

					'ACC_CODE'       => $acc_code,
					"ACC_NAME"       => $acc_name,
					'CPCODE'         => $cp_code,
					'contact_person' => $contact_person[$i],
					'ADD1'           => $address[$i],
					'PIN_CODE'       => $pincode[$i],
					'CITY_CODE'      => $splicity[0],
					'CITY_NAME'      => substr($splicity[1], 0, -1),
					'STATE_CODE'     => $splistate[0],
					'STATE_NAME'     => substr($splistate[1], 0, -1),
					'DIST_CODE'      => $splidist[0],
					'DIST_NAME'      => substr($splidist[1], 0, -1),
					'CONTACT_NO'     => $phone[$i],
					'EMAIL_ID'       => $email[$i],
					'OFF_DAYS'       => $offDays[$i],
					'RANGE_ADD'      => $range_address[$i],
					'GST_TYPE'       => $gst_type[$i],
					'GST_NUM'        => $gst_num[$i],
					'ECC_NO'         => $ecc_no[$i],
					'RANGE_NO'       => $range_no[$i],
					'RANGE_NAME'     => $range_name[$i],
					'DIVISION'       => $division[$i],
					'COLLECTOR'      => $collector[$i],
					'CREATED_BY'     => $createdBy,

		    	);


				//print_r($data1);exit;

				DB::table('MASTER_ACCADD')->insert($data1);

			}

			$tableId  = $request->input('temptableidacc');
			$tblcol   = $request->input('tblcolacc');
				
			if($tableId && $tblcol){

		    	$data = array(

					'ACC_STATUS' => 'NO',
					 $tblcol     => $acc_name.' - '.$acc_code,
		    	);

		     	DB::table('TEMP_DELIVERY_ORDER')->where('ID', $tableId)->update($data);

			}
	       
		    DB::commit();
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

		}/* ajax*/	

	}/* main function*/

	public function acc_save_msg(Request $request,$saveData){

		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/Master/Customer-Vendor/View-Account-Mast');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/Master/Customer-Vendor/View-Account-Mast');

		}
	}

	public function ViewAccount(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()){

			$title    = 'View Account Master';

			$userid   = $request->session()->get('userid');

			$userType = $request->session()->get('usertype');

			$compName = $request->session()->get('company_name');
			$splitCd  = explode('-',$compName);
			$compCode = $splitCd[0];
			$fisYear  =  $request->session()->get('macc_year');

	    	

		    /*$data = DB::select("SELECT * FROM `MASTER_ACC` WHERE COMP_CODE IS NULL OR COMP_CODE='$compCode' ORDER BY ACC_CODE");*/
		  /*  $data = DB::select("SELECT * FROM `MASTER_ACC`  WHERE COMP_CODE IS NULL OR COMP_CODE='$compCode' ORDER BY ACC_CODE");*/

		   $data = DB::select("SELECT t1.*,t2.CITY_CODE,t2.CITY_NAME FROM MASTER_ACC t1 LEFT JOIN MASTER_ACCADD t2 ON t1.ACC_CODE = t2.ACC_CODE GROUP BY t2.ACC_CODE");
	    	
	    	
    		return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	        })->toJson();

    	}
    	if(isset($compName)){
    		return view('admin.finance.master.customer.view_account');
    	}else{
			return redirect('/useractivity');
	   	}
    }


    public function ViewAccountForConsinee(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()){

			$title    = 'View Account Master';

			$userid   = $request->session()->get('userid');

			$userType = $request->session()->get('usertype');

			$compName = $request->session()->get('company_name');
			$splitCd  = explode('-',$compName);
			$compCode = $splitCd[0];
			$fisYear  =  $request->session()->get('macc_year');

	    	

		    /*$data = DB::select("SELECT * FROM `MASTER_ACC` WHERE COMP_CODE IS NULL OR COMP_CODE='$compCode' ORDER BY ACC_CODE");*/
		  /*  $data = DB::select("SELECT * FROM `MASTER_ACC`  WHERE COMP_CODE IS NULL OR COMP_CODE='$compCode' ORDER BY ACC_CODE");*/

		   $data = DB::select("SELECT t1.*,t2.CITY_CODE,t2.CITY_NAME,t2.ADD1 FROM MASTER_ACC t1 LEFT JOIN MASTER_ACCADD t2 ON t1.ACC_CODE = t2.ACC_CODE WHERE ATYPE_CODE='N'");

		   //print_r($data);exit;
	    	
	    	
    		return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	        })->toJson();

    	}
    	if(isset($compName)){
    		return view('admin.finance.master.customer.view_account');
    	}else{
			return redirect('/useractivity');
	   	}
    }


    public function ViewAccountChieldRTowData(Request $request){

		$response_array = array();

	    $acc_code = $request->input('acc_code');
	   
	    if ($request->ajax()) {

	    	// $partyFinance_details = DB::table("master_party")->where('acc_code',$acc_code)->get()->first();
	    	// DB::enableQueryLog();
		    $partyFinance_details = DB::table('MASTER_ACC')
				->select('MASTER_ACC.*','MASTER_ACCADD.ACC_CODE as accCode', 'MASTER_ACCADD.SRNO as slNo', 'MASTER_ACCADD.CONTACT_PERSON as contactPerson', 'MASTER_ACCADD.ADD1 as addAddress', 'MASTER_ACCADD.PIN_CODE as addPin', 'MASTER_ACCADD.CITY_CODE as addCity', 'MASTER_ACCADD.STATE_CODE as addState', 'MASTER_ACCADD.DIST_CODE as addDistrict', 'MASTER_ACCADD.CONTACT_NO as addPhone', 'MASTER_ACCADD.EMAIL_ID as addEmail')
           		->leftjoin('MASTER_ACCADD', 'MASTER_ACCADD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
            	->where('MASTER_ACCADD.ACC_CODE',$acc_code)
            	->get()->toArray();
				// dd(DB::getQueryLog());

				$partyFinance_details = DB::table('MASTER_HOUSECASH')
				->select('MASTER_HOUSECASH.*','MASTER_COMP.COMP_CODE as compCode')
           		->leftjoin('MASTER_COMP', 'MASTER_COMP.COMP_CODE', '=', 'MASTER_HOUSECASH.COMP_CODE')->get();
            	

            	if($partyFinance_details){

            		$array = json_decode( json_encode($partyFinance_details), true);

            	}else{

            		$array = DB::table("master_party")->where('acc_code',$acc_code)->get()->toArray();

            	}

	    	if ($array) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $array ;

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

    public function EditAccount(Request $request,$id){

    	$title = 'Edit Account Master';

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	$id = base64_decode($id);
       
    	if($id!=''){

			$query1 = DB::table('MASTER_ACC')->where('ACC_CODE', $id)->get()->first();
			$userData['PartyFinance_list'] = $query1;
			
			$acc_code                      = $userData['PartyFinance_list']->ACC_CODE;
			
			$userData['party_address']     = DB::table('MASTER_ACCADD')->where('ACC_CODE',$acc_code)->get()->toArray();
			$userData['company_lists']     = DB::table('MASTER_COMP')->get();
			$userData['acctype_lists']     = DB::table('MASTER_ACCTYPE')->get();
			
			$userData['acccategory_lists'] = DB::table('MASTER_ACATG')->get();
			
			$userData['accclass_lists']    = DB::table('MASTER_ACLASS')->get();
			$userData['gl_lists']          = DB::table('MASTER_GL')->where('ACCOUNT_TAG','YES')->get();
			
			$userData['state_lists']       = DB::table('MASTER_STATE')->get();
			
			$userData['tax_lists']         = DB::table('MASTER_TAX')->get();
			
			$userData['tds_lists']         = DB::table('MASTER_TDS')->get();
			$userData['city_lists']         = DB::table('MASTER_CITY')->get();
			$userData['acc_mst_list']      = DB::table('MASTER_ACC')->Orderby('ACC_CODE', 'desc')->limit(5)->get();
           
			return view('admin.finance.master.customer.edit_account', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Cost Id Not Found...!');
			return redirect('/Master/Customer-Vendor/View-Account-Mast');
		}

    }

     public function AccountUpdate(Request $request){
       
       $id = $request->input('F_party_id');
       $acc_code_id = $request->input('acc_code_id');
       $updatedDate = date('Y-m-d');

		$compName = $request->session()->get('company_name');
		
		$fisYear =  $request->session()->get('macc_year');
		$userlogin = $request->session()->get('userid');

            $acc_code         = $request->input('acc_code');
            $comp_code        = $request->input('comp_code');
            $comp_name        = $request->input('comp_name');
            $slno             = $request->input('slno');
			$acc_name         = $request->input('acc_name');
			$acctype_code     = $request->input('acctype_code');
			$splitAccType     = explode('[',$acctype_code);
			$acccategory_code = $request->input('acccategory_code');
			$accclass_code    = $request->input('accclass_code');
			$gl_code          = $request->input('gl_code');
			$splitgl          = explode('[',$gl_code);
			$bill_track       = $request->input('bill_track');
			$contact_person   = $request->input('contact_person');
			$address1         = $request->input('address');
			$city             = $request->input('city');
			$pincode          = $request->input('pincode');
			$district         = $request->input('district');
			$state            = $request->input('state');
			$offDays          = $request->input('offDays');
			//$country          = $request->input('country');
			$phone            = $request->input('phone');
			$fax              = $request->input('fax');
			$email            = $request->input('email');
			$tax_code         = $request->input('tax_code');
			$tds_code         = $request->input('tds_code');
			$tan_no           = $request->input('tan_no');
			$tinno            = $request->input('tinno');
			$sales_taxno      = $request->input('sales_taxno');
			$csales_taxno     = $request->input('csales_taxno');
			$service_taxno    = $request->input('service_taxno');
			$panno            = $request->input('panno');
			$gst_type         = $request->input('gst_type');
			$gst_num          = $request->input('gst_num');
			$ecc_no           = $request->input('ecc_no');
			$range_no         = $request->input('range_no');
			$range_name       = $request->input('range_name');
			$range_address    = $request->input('range_address');
			$division         = $request->input('division');
			$collector        = $request->input('collector');
			$bank_name        = $request->input('bank_name');
			$acc_number       = $request->input('acc_number');
			$branch_name      = $request->input('branch_name');
			$ifsc_code        = $request->input('ifsc_code');
			$bank_address     = $request->input('bank_address');
			$credit_limit     = $request->input('credit_limit');
			$gp_days          = $request->input('gp_days');
			$AliasCode        = $request->input('AliasCode');
			$AliasName        = $request->input('AliasName');
			$sapCode          = $request->input('sap_code');
			$file_path        = $request->input('file_path');
			$bill_format      = $request->input('bill_format');
			$tds_type         = $request->input('tds_type');

			
			if($acccategory_code){
				$splitAcccat = explode('[',$acccategory_code);
				$accCatCode  = $splitAcccat[0];
				$accCatName  = substr($splitAcccat[1], 0, -1);
			}else{
				$accCatCode ='';
				$accCatName ='';
			}



			if($accclass_code){
				$splitAcccls = explode('[',$accclass_code);
				$accClsCode  = $splitAcccls[0];
				$accClsName  = substr($splitAcccls[1], 0, -1);
			}else{
				$accClsCode ='';
				$accClsName ='';
			}

			DB::beginTransaction();

			try {

				$data = array(

					"COMP_CODE"      => $comp_code,
					"COMP_NAME"      => $comp_name,
					"ACC_NAME"       => $acc_name,
					"ATYPE_CODE"     => $splitAccType[0],
					"ATYPE_NAME"     => substr($splitAccType[1], 0, -1),
					"ACATG_CODE"     => $accCatCode,
					"ACATG_NAME"     => $accCatName,
					"ACLASS_CODE"    => $accClsCode,
					"ACLASS_NAME"    => $accClsName,
					"GL_CODE"        => $splitgl[0],
					"GL_NAME"        => substr($splitgl[1], 0, -1),
					"CREADIT_LIMIT"  => $credit_limit,
					"GP_DAYS"        => $gp_days,
					"ALIAS_CODE"     => $AliasCode,
					"ALIAS_NAME"     => $AliasName,
					"SAP_CODE"       => $sapCode,
					"FILE_PATH"      => $file_path,
					"BILL_FORMAT"    => $bill_format,
					"TAX_CODE"       => $tax_code,
					"TDS_NO"         => $tds_type,
					"TDS_CODE"       => $tds_code,
					"TAN_NO"         => $tan_no,
					"TIN_NO"         => $tinno,
					"SALES_TAXNO"    => $sales_taxno,
					"CSALES_TEXNO"   => $csales_taxno,
					"SERVICE_TAXNO"  => $service_taxno,
					"PAN_NO"         => $panno,
					"BANK_NAME"      => $bank_name,
					"ACC_NUMBER"     => $acc_number,
					"BRANCH_NAME"    => $branch_name,
					"IFSC_CODE"      => $ifsc_code,
					"BANK_ADDRESS"   => $bank_address,
					"ACC_BLOCK"  => $request->input('account_block'),
					"LAST_UPDATE_BY" => $request->session()->get('userid'),				
				);

				DB::table('MASTER_ACC')->where('ACC_CODE',$acc_code)->update($data);

				$discriptn_page = "Master acc update done by user";
				$this->userLogInsert($userlogin,$discriptn_page);

	    		$deleteData = DB::table('MASTER_ACCADD')->where('ACC_CODE',$acc_code)->delete();

				$address = $request->input('address');
		        
			    $count = count($address);
			    $srNo = 1;
			    for ($i=0; $i < $count; $i++){ 

			    	$cp_code = $acc_code.'-'.$srNo;

					$splicity = explode('[',$city[$i]);
					$splidist = explode('[',$district[$i]);
					$splistate = explode('[',$state[$i]);

					$data1 =array(

						'ACC_CODE'       => $acc_code,
						'ACC_NAME'       => $acc_name,
						'CPCODE'         => $cp_code,
						'contact_person' => $contact_person[$i],
						'ADD1'           => $address[$i],
						'PIN_CODE'       => $pincode[$i],
						'CITY_CODE'      => $splicity[0],
						'CITY_NAME'      => substr($splicity[1], 0, -1),
						'STATE_CODE'     => $splistate[0],
						'STATE_NAME'     => substr($splistate[1], 0, -1),
						'DIST_CODE'      => $splidist[0],
						'DIST_NAME'      => substr($splidist[1], 0, -1),
						'CONTACT_NO'     => $phone[$i],
						'EMAIL_ID'       => $email[$i],
						'OFF_DAYS'       => $offDays[$i],
						'RANGE_ADD'      => $range_address[$i],
						'GST_TYPE'       => $gst_type[$i],
						'GST_NUM'        => $gst_num[$i],
						'ECC_NO'         => $ecc_no[$i],
						'RANGE_NO'       => $range_no[$i],
						'RANGE_NAME'     => $range_name[$i],
						'DIVISION'       => $division[$i],
						'COLLECTOR'      => $collector[$i],
						'CREATED_BY'     => $request->session()->get('userid'),

			    	);

				    $saveData1 = DB::table('MASTER_ACCADD')->insert($data1);

				    $srNo++;
				}

			 DB::commit();
			$request->session()->flash('alert-success', 'Account Was Successfully Updated...!');
			return redirect('/Master/Customer-Vendor/View-Account-Mast');
		}catch (\Exception $e) {
			DB::rollBack();
		    //throw $e;
			$request->session()->flash('alert-error', 'Account Can Not Updated...!');
			return redirect('/Master/Customer-Vendor/View-Account-Mast');
		}

	}



	public function DeletePartyFinance(Request $request){

        $acc_code = $request->input('partyId');
        if($acc_code){
		try{
			$Delete = DB::table('MASTER_ACC')->where('ACC_CODE', $acc_code)->delete();


			$Deleteadd = DB::table('MASTER_ACCADD')->where('ACC_CODE', $acc_code)->delete();

			if($Delete || $Deleteadd) {

			$request->session()->flash('alert-success', 'Account Data Was Deleted Successfully...!');
			return redirect('/Master/Customer-Vendor/View-Account-Mast');

			} else {

			$request->session()->flash('alert-error', 'Account Data Can Not Deleted...!');
			return redirect('/Master/Customer-Vendor/View-Account-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Account Data be be Deleted...! Used In Another Transaction...!');
					return redirect('/Master/Customer-Vendor/View-Account-Mast');
			}

		}else{

		$request->session()->flash('alert-error', 'Account Data Not Found...!');
		return redirect('/Master/Customer-Vendor/View-Account-Mast');

		}
	}


 	public function ViewPartyFinanceChieldRTowData(Request $request){

		$response_array = array();
		$acc_code = $request->input('acc_code');
	   
	    if ($request->ajax()) {

	    	// $partyFinance_details = DB::table("master_party")->where('acc_code',$acc_code)->get()->first();
	    	// DB::enableQueryLog();
		    $partyFinance_details = DB::table('MASTER_ACC')
				->select('MASTER_ACC.*','MASTER_ACCADD.ACC_CODE as accCode', 'MASTER_ACCADD.CONTACT_PERSON as contactPerson', 'MASTER_ACCADD.ADD1 as addAddress', 'MASTER_ACCADD.PIN_CODE as addPin', 'MASTER_ACCADD.CITY_CODE as addCity', 'MASTER_ACCADD.STATE_CODE as addState', 'MASTER_ACCADD.DIST_CODE as addDistrict', 'MASTER_ACCADD.CONTACT_NO as addPhone', 'MASTER_ACCADD.EMAIL_ID as addEmail')
           		->leftjoin('MASTER_ACCADD', 'MASTER_ACCADD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
            	->where('MASTER_ACCADD.ACC_CODE',$acc_code)
            	->get()->toArray();
				// dd(DB::getQueryLog());
            	

            	if($partyFinance_details){

            		$array = json_decode( json_encode($partyFinance_details), true);

            	}else{

            		$array = DB::table("MASTER_ACC")->where('ACC_CODE',$acc_code)->get()->toArray();

            	}

            	

            	// echo '<pre>';
            	// print_r($array);
            	// echo '</pre>';

            	
	    	if ($array) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $array ;

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
/*search Account code when click on help button*/
	
	public function HelpAccCode_Get(Request $request){

		$response_array = array();

	    $AccCodeHelp = $request->input('AccCodeHelp');

		if ($request->ajax()) {

	    	$Acc_code_by_help = DB::select("SELECT * FROM `MASTER_ACC` WHERE ACC_CODE='$AccCodeHelp' OR ACC_NAME='$AccCodeHelp' OR ACC_CODE Like '$AccCodeHelp%' OR ACC_NAME LIKE '$AccCodeHelp%' ORDER BY ACC_CODE DESC limit 5  ");
	    	
    		if ($Acc_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Acc_code_by_help ;

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

/*search Account code when click on help button*/


/*search Account code on input*/

	public function search_AccCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$acc_code = $request->input('acc_code');

	    	$Acccode_list = DB::select("SELECT * FROM `MASTER_ACC` WHERE ACC_CODE LIKE '$acc_code%'");

	    	$count = count($Acccode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Acccode_list ;

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

/*search Account code on input*/


/* -------------------- END : ACCOUNT MASTER ------------------------ */

/* -------------------- START : ACCOUNT BALENCE MASTER ------------------------ */

	public function AccBalence(Request $request){

		$title       ='Add Acc Balence Master';
		$compName    = $request->session()->get('company_name');
		$getcompcode = explode('-',$compName);
		$comp_code    = $getcompcode[0];
		
		$button            ='Save';
		$action            ='/Master/Customer-Vendor/Acc-Bal-Save';
		
		$data['comp_list'] = DB::table('MASTER_COMP')->get();
		//$data['fy_list'] = DB::table('MASTER_FY')->get();
		$data['pfct_list'] = DB::table('MASTER_PFCT')->where('COMP_CODE',$comp_code)->get();
		$data['acc_list']  = DB::table('MASTER_ACC')->where('COMP_CODE',$comp_code)->orWhereNull('COMP_CODE')->get();
	
		if(isset($compName)){
	    	return view('admin.finance.master.customer.acc_bal',$data+compact('title','button','action'));
	    }else{

			return redirect('/useractivity');
		}

    } 

    public function GetYear(Request $request){

		$cmp_code = $request->post('comp_code');
		
		$fisYear  =  $request->session()->get('macc_year');
		//DB::enableQueryLog();
		$getyear  = DB::table('MASTER_FY')->where('COMP_CODE',$cmp_code)->get();
      	//dd(DB::getQueryLog());
      	if(!empty($getyear)){
	        $response = '<option value="">Select Year</option>';
	        foreach ($getyear as $row) 
        	{	

          	$response .= '<option value="'.$row->FY_CODE.'">'.$row->FY_CODE.'</option>';
        	}
      	}
      	else
      	{
        	$response = '<option value="">Select Year</option>';
      	}
      	echo $response;exit; 

    }

    public function AccBalenceSave(Request $request){

		$rules = [  
				'comp_code' => 'required|max:6',
				'fy_code'   => 'required|max:9',
				'acc_code'  => 'required|max:6',
                'comp_code'  => ['required', 'string',Rule::unique('MASTER_ACCBAL')->where(function ($query) use ($request) {
                    return $query->where('COMP_CODE', $request->comp_code)->where('FY_CODE', $request->fy_code)->where('ACC_CODE', $request->acc_code);
                        })],
            ];

        $customMessages = [
            'comp_code.unique'=>'The Comp code has already been taken for this <b><u> FY code and Acc code</u></b>',
        ];

        $this->validate($request, $rules, $customMessages);


		$createdBy = $request->session()->get('userid');
		
		$compName  = $request->session()->get('company_name');
		
		$fisYear   =  $request->session()->get('macc_year');
		
		$transDate = date("Y-m-d", strtotime($request->input('vrDate')));

		$data = array(
			"FY_CODE"     => $request->input('fy_code'),
			"COMP_CODE"   => $request->input('comp_code'),
			"COMP_NAME"   => $request->input('emp_comp_name'),
			"ACC_CODE"    => $request->input('acc_code'),
			"ACC_NAME"    => $request->input('emp_acc_name'),
			"PFCT_CODE"   => $request->input('pfct_code'),
			"PFCT_NAME"   => $request->input('emp_pfct_name'),
			"YROPDR"      => $request->input('pdr_code'),
			"YROPCR"      => $request->input('pcr_code'),
			"CREATED_BY"  => $createdBy,
			
		);
        //  echo "<pre>";
		// print_r($data);
		// exit();



		/*$data_acledg = array(
			"COMP_CODE"       => $request->input('comp_code'),
			"FY_CODE"         => $request->input('fy_code'),
			"TRAN_CODE"       => null,
			"SERIES_CODE"     => null,
			"vr_no"           => null,
			"SLNO"            => null,
			"vr_date"         => $transDate,
			"acc_code"        => $request->input('acc_code'),
			"acc_name"        => $request->input('acc_name'),
			"acc_class"       => $request->input('accclass_code'),
			"acc_type"        => $request->input('acctype_code'),
			"pfct_code"       => $request->input('pfct_code'),
			"cr_amt"          => $request->input('pcr_code'),
			"dr_amt"          => $request->input('pdr_code'),
			"instrument_type" => null,
			"instrument_no"   => null,
			"particular"      => $request->input('reference'),
			"created_by"      => $createdBy,
			
		);*/

		$saveData = DB::table('MASTER_ACCBAL')->insert($data);
		//$saveData = DB::table('ledger_tran')->insert($data_acledg);
		$discriptn_page = "Master acc balence insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Acc Bal Was Successfully Added...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Balence-Mast');

		} else {

			$request->session()->flash('alert-error', 'Acc Bal Can Not Added...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Balence-Mast');

		}

	}

	public function EditAccBalence(Request $request,$accCd,$cmpCd,$fyCd){

		$title    = 'Edit Master Department';
		
		$accCode  = base64_decode($accCd);
		$cmpCode  = base64_decode($cmpCd);
		$fyCode   = base64_decode($fyCd);
		
		$compName = $request->session()->get('company_name');
		$getcompcode = explode('-',$compName);
		$comp_code    = $getcompcode[0];
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($accCode!='' && $cmpCode!='' && $fyCode!=''){
			$query = DB::table('MASTER_ACCBAL');
			$query->where('ACC_CODE', $accCode);
			$query->where('COMP_CODE', $cmpCode);
			$query->where('FY_CODE', $fyCode);
			$accbalData['accbal_list'] = $query->get()->first();
			
			$button                    ='Save';
			$action                    ='/Master/Customer-Vendor/Acc-Bal-Update';
			
			$accbalData['comp_list']   = DB::table('MASTER_COMP')->get();
			$accbalData['fy_list']     = DB::table('MASTER_FY')->get();
			$accbalData['pfct_list']   = DB::table('MASTER_PFCT')->where('COMP_CODE',$comp_code)->get();
			$accbalData['acc_list']  = DB::table('MASTER_ACC')->where('COMP_CODE',$comp_code)->orWhereNull('COMP_CODE')->get();
			// $accbalData['acc_list']    = DB::table('MASTER_ACC')->get();

			return view('admin.finance.master.customer.edit_acc_bal', $accbalData+compact('title','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Balence-Mast');
		}

    }
	 
    public function AccBalenceUpdate(Request $request){

		$validate = $this->validate($request, [

			'pfct_code' => 'required|max:6',

		]);

		$accbal_id   = $request->input('accbal_id');
		$spliid = explode('~',$accbal_id);
		$yearup = $spliid[0];
		$compup = $spliid[1];
		$accup  = $spliid[2];
		
		date_default_timezone_set('Asia/Kolkata');
		
		$updatedDate = date("Y-m-d");
		
		$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

    	$transDate   = date("Y-m-d", strtotime($request->input('vrDate')));

    	$data = array(
			"PFCT_CODE"        => $request->input('pfct_code'),
			"YROPDR"           => $request->input('pdr_code'),
			"YROPCR"           => $request->input('pcr_code'),
			"ACCBAL_BLOCK"     => $request->input('acc_bal_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		$saveData = DB::table('MASTER_ACCBAL')->where('FY_CODE', $yearup)->where('ACC_CODE', $accup)->where('COMP_CODE', $compup)->update($data);

		$discriptn_page = "Master acc balence update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Acc Bal Was Successfully Updated...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Balence-Mast');

		} else {

			$request->session()->flash('alert-error', 'Acc Bal Can Not Added...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Balence-Mast');

		}

	}

	public function ViewAccBalence(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()){

			$title    = 'View Acc Balence Master';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

    		if($userType=='admin'){


    			// DB::enableQueryLog();

	    		$data = DB::table('MASTER_ACCBAL')->where('FY_CODE', $fisYear)
	            ->orderBy('ACC_CODE','DESC')
	            ;

	            // dd(DB::getQueryLog());

	    	}elseif ($userType=='superAdmin' || $userType=='user') {

	    		
	    		$data = DB::table('MASTER_ACCBAL')->where('FY_CODE', $fisYear)
	            ->orderBy('ACC_CODE','DESC');
	    

    		}
    		else{
    			$data ='';
    		}

    		return DataTables()->of($data)->addIndexColumn()->toJson();
    	}
    	if(isset($compName)){
	    	return view('admin.finance.master.customer.view_acc_bal');
	    }else{
			return redirect('/useractivity');
		}
    }


    public function DeleteAccBalence(Request $request){

		$accbalId = $request->post('accbalId');

		$spliAcc = explode('/',$accbalId);
		$accCd   = $spliAcc[0];
		$compCd  = $spliAcc[1];
		$fyCd    = $spliAcc[2];
    	
    	if ($accbalId!='') {
    		
    		$Delete = DB::table('MASTER_ACCBAL')->where('ACC_CODE', $accCd)->where('COMP_CODE', $compCd)->where('FY_CODE', $fyCd)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Acc Bal Was Deleted Successfully...!');
				return redirect('/Master/Customer-Vendor/View-Acc-Balence-Mast');

			} else {

				$request->session()->flash('alert-error', 'Acc Bal Can Not Deleted...!');
				return redirect('/Master/Customer-Vendor/View-Acc-Balence-Mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Acc Bal Not Found...!');
			return redirect('/Master/Customer-Vendor/View-Acc-Balence-Mast');

    	}

	}	

/* -------------------- END : ACCOUNT BALENCE MASTER ------------------------ */

/* ---------------------- AJAX FUNCTION -------------------- */
	
	public function GetDataAgainstAccType(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$acc_type_code = $request->input('accTypeCode');

	    	$acc_type_list = DB::select("SELECT * FROM `MASTER_ACCTYPE` WHERE ATYPE_CODE='$acc_type_code'");
	    	//print_r($acc_type_list);
	    	$count = count($acc_type_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $acc_type_list ;

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

/* ---------------------- AJAX FUNCTION -------------------- */

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