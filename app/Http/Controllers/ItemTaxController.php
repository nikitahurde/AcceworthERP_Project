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
class ItemTaxController extends Controller{

	//public $data;

	public function __construct(Request $request){

		//$this->data = "smit@121";

	}

/* --------- start hsn master ------------ */
	
	public function Addhsn(Request $request){

		$title = 'Add Master HSN';

		$compName 	= $request->session()->get('company_name');

		$data['help_hsn_list'] = DB::table('MASTER_HSN')->Orderby('HSN_CODE', 'desc')->get();

		$data['tax_code'] = DB::table('MASTER_TAX')->get();

		//print_r($data['tax_code']);exit;
		
		if(isset($compName)){

    		return view('admin.finance.master.itemTax.hsn_form',$data+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

	}

	public function SaveHsn(Request $request){

		$compName  = $request->session()->get('company_name');
		$fisYear   =  $request->session()->get('macc_year');
		$createdBy = $request->session()->get('userid');

		$validate = $this->validate($request, [

				'hsn_code'        => 'required|max:8|unique:MASTER_HSN,HSN_CODE',
				'hsn_name'        => 'required|max:40',
				'hsn_discription' => 'required|max:50',

		]);

		$tax_code = $request->input('tax_code');
		//print_r($tax_code);exit;

		$data = array(
				"HSN_CODE"        => $request->input('hsn_code'),
				"HSN_NAME"        => $request->input('hsn_name'),
				"HSN_DISCRIPTION" => $request->input('hsn_discription'),
				"CREATED_BY"      => $request->session()->get('userid'),
	    	);

		$saveData = DB::table('MASTER_HSN')->insert($data);

		$discriptn_page = "Master HSN insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if($tax_code){

				$tax_code = $request->input('tax_code');
				$hsn_code = $request->input('hsn_code');


				$taxcount = count($tax_code);

				for ($i=0; $i < $taxcount; $i++) { 


		    	$data1 = array(
		 			"HSN_CODE"    => $hsn_code,
					"TAX_CODE"    => $tax_code[$i],
					"CREATED_BY"  => $request->session()->get('userid'),
	 
	    		);

				$saveData1 = DB::table('MASTER_HSNRATE')->insert($data1);
					# code...
				}



		}



			if ($saveData) {

				$request->session()->flash('alert-success', 'HSN Was Successfully Added...!');
				return redirect('/Master/Item-Tax/View-Hsn-Mast');

			} else {

				$request->session()->flash('alert-error', 'HSN Can Not Added...!');
				return redirect('/Master/Item-Tax/View-Hsn-Mast');

			}

	}

	public function ViewHsn(Request $request){
    
    	$compName = $request->session()->get('company_name');

		if($request->ajax()) {
       
	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 	$data = DB::table('MASTER_HSN')->orderBy('HSN_CODE','DESC');
	    	}
	    	elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_HSN')->orderBy('HSN_CODE','DESC');
	    	}
	    	else{
	    		$data='';
	    	}

    		return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}
    	$title = 'View Master HSN';

    	if(isset($compName)){
    		return view('admin.finance.master.itemTax.view_hsn_form',compact('title'));
    	}else{
			return redirect('/useractivity');
	   }

    }

   	public function EditHsn($id){

    	$title = 'Edit HSN';

    	$hsncode = base64_decode($id);
    	//print_r($id);

    	if($hsncode!=''){
    	    $query = DB::table('MASTER_HSN');
			$query->where('HSN_CODE', $hsncode);
			$userData['hsn_list'] = $query->get()->first();

			return view('admin.finance.master.itemTax.edit_hsn_form', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'HSN Id Not Found...!');
			return redirect('/Master/Item-Tax/View-Hsn-Mast');
		}

    }

    public function UpdateHsn(Request $request){

		//print($request->post());exit;
		$validate = $this->validate($request, [
				
				'hsn_code' => 'required|max:8',
				'hsn_name' => 'required|max:40',
				'hsn_discription' => 'required|max:50',


		]);

		$id          = $request->input('hsn_id');
		$updatedDate = date("Y-m-d  H:i:s");
		$createdBy   = $request->session()->get('userid');

		$data = array(
				"HSN_CODE"         =>  $request->input('hsn_code'),
				"HSN_NAME"         =>  $request->input('hsn_name'),
				"HSN_DISCRIPTION"  =>  $request->input('hsn_discription'),
				"HSN_BLOCK"        =>  $request->input('hsn_block'),
				"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
				"LAST_UPDATE_DATE" =>  $updatedDate
	 
	    	);

		try{

			$saveData = DB::table('MASTER_HSN')->where('HSN_CODE', $id)->update($data);

			$discriptn_page = "Master HSN update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'HSN Was Successfully Updated...!');
				return redirect('/Master/Item-Tax/View-Hsn-Mast');

			} else {

				$request->session()->flash('alert-error', 'HSN Can Not Updated...!');
				return redirect('/Master/Item-Tax/View-Hsn-Mast');

			}
		}
		  catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'HSN Code Cannot be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Item-Tax/View-Hsn-Mast');
			}
	}

	public function Deletehsn(Request $request){

        $id = $request->input('hsn_code');
        if ($id!='') {

			try{
				$Delete = DB::table('MASTER_HSN')->where('HSN_CODE', $id)->delete();

				if ($Delete) {

				$request->session()->flash('alert-success', 'HSN Data Was Deleted Successfully...!');
				return redirect('/Master/Item-Tax/View-Hsn-Mast');

				} else {

				$request->session()->flash('alert-error', 'HSN Data Can Not Deleted...!');
				return redirect('/Master/Item-Tax/View-Hsn-Mast');

				}
			}
			catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'HSN Data Cannot be Deleted...! Used In Another Transaction...!');
					return redirect('/Master/Item-Tax/View-Hsn-Mast');
			}

		}else{

			$request->session()->flash('alert-error', 'HSN Data Not Found...!');
			return redirect('/Master/Item-Tax/View-Hsn-Mast');

		}
	}



/* --------- end hsn master ------------ */

/* ----------- start hsn rate master ---------- */

	public function hsnRate(Request $request){

		$title = 'Add Master HSN Rate';

		$compName = $request->session()->get('company_name');

		$userData['hsn_list']  = DB::table('MASTER_HSN')->get();
		$userData['tax_code']  = DB::table('MASTER_TAX')->get();
		

		if(isset($compName)){

	    	return view('admin.finance.master.itemTax.hsn_rate_form',$userData+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

	}


	public function SaveHsnRate(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$loginuser = $request->session()->get('userid');


    	$rules = [	
    				'hsn_code' => 'required|max:8',
					'tax_code' => 'required|max:6',
					'hsn_code' => ['required', 'string',Rule::unique('MASTER_HSNRATE')->where(function ($query) use ($request) {
					    return $query->where('HSN_CODE', $request->hsn_code)->where('TAX_CODE', $request->tax_code);
							})],
			    ];

			    $customMessages = [
			        'hsn_code.unique'=>'The HSN Code has already been taken for this <b><u> Tax Code</u></b>',
			    ];

			    $this->validate($request, $rules, $customMessages);


		    $data = array(
		 		"HSN_CODE"    => $request->input('hsn_code'),
				"TAX_CODE"    => $request->input('tax_code'),
				"TAX_RATE"    => $request->input('tax_rate'),
				"CREATED_BY"  => $request->session()->get('userid'),
	 
	    	);

		$saveData = DB::table('MASTER_HSNRATE')->insert($data);

		$discriptn_page = "Master HSN rate insert done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'HSN Rate Was Successfully Added...!');
			return redirect('/Master/Item-Tax/View-Hsn-Rate-Mast');

		} else {

			$request->session()->flash('alert-error', 'HSN Rate Can Not Added...!');
			return redirect('/Master/Item-Tax/View-Hsn-Rate-Mast');

		}

	}


	public function ViewHsnRate(Request $request){

		$compName = $request->session()->get('company_name');
    	
		if($request->ajax()) {
       
	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 	$data = DB::table('MASTER_HSNRATE')->orderBy('HSN_CODE','DESC');
	    	}
	    	elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_HSNRATE')->orderBy('HSN_CODE','DESC');
	    	}
	    	else{
	    		$data='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	$title = 'View Master HSN Rate';

    	if(isset($compName)){
    		return view('admin.finance.master.itemTax.view_hsn_rate_form',compact('title'));
    	}else{
    		return redirect('/useractivity');
   		}

    }


    public function EditHsnRate(Request $request,$id,$taxCd){

    	$title = 'Edit HSN Rate';

    	$id = base64_decode($id);
    	$tax_Cd = base64_decode($taxCd);
    	//print_r($id);
    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($id!=''){
    	    $query = DB::table('MASTER_HSNRATE');
			$query->where('HSN_CODE', $id);
			$query->where('TAX_CODE', $tax_Cd);
			$userData['hsnrate_list'] = $query->get()->first();

			$userData['hsn_list']  = DB::table('MASTER_HSN')->get();
			$userData['tax_code']  = DB::table('MASTER_TAX')->get();

			return view('admin.finance.master.itemTax.edit_hsn_rate_form', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'HSN Id Not Found...!');
			return redirect('/Master/Item-Tax/View-Hsn-Rate-Mast');
		}

    }

    public function UpdateHsnRate(Request $request){

		$validate = $this->validate($request, [
				
				'hsn_code' => 'required|max:8',
				'tax_code'  => 'required|max:6',
		]);

        $id = $request->input('hsnrate_id');
        $tax_codeid = $request->input('taxCd_id');
        $updatedDate = date("Y-m-d  H:i:s");
        $loginuser = $request->session()->get('userid');

		$data = array(
				"HSN_CODE"         =>  $request->input('hsn_code'),
				"TAX_CODE"         =>  $request->input('tax_code'),
				"TAX_RATE"         => $request->input('tax_rate'),
				"HSNRATE_BLOCK"    =>  $request->input('hsnrate_block'),
				"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
				"LAST_UPDATE_DATE" =>  $updatedDate
				
	    	);

		$saveData = DB::table('MASTER_HSNRATE')->where('HSN_CODE', $id)->where('TAX_CODE', $tax_codeid)->update($data);

		$discriptn_page = "Master HSN rate update done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'HSN Rate Was Successfully Updated...!');
			return redirect('/Master/Item-Tax/View-Hsn-Rate-Mast');

		} else {

			$request->session()->flash('alert-error', 'HSN Rate Can Not Updated...!');
			return redirect('/Master/Item-Tax/View-Hsn-Rate-Mast');

		}

	}

	public function DeletehsnRate(Request $request){

        $id = $request->input('hsnrate_id');
        $taxcode = $request->input('taxcode');
        if ($id!='') {

			$Delete = DB::table('MASTER_HSNRATE')->where('HSN_CODE', $id)->where('TAX_CODE', $taxcode)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'HSN Rate Data Was Deleted Successfully...!');
			return redirect('/Master/Item-Tax/View-Hsn-Rate-Mast');

			} else {

			$request->session()->flash('alert-error', 'HSN Rate Data Can Not Deleted...!');
			return redirect('/Master/Item-Tax/View-Hsn-Rate-Mast');

			}

		}else{

		$request->session()->flash('alert-error', 'HSN Rate Data Not Found...!');
		return redirect('/Master/Item-Tax/View-Hsn-Rate-Mast');

		}
	}

/* ----------- end hsn rate master ---------- */

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