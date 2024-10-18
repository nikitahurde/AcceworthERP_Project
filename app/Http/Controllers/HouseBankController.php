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
class HouseBankController extends Controller{

	//public $data;

	public function __construct(Request $request){
		//$this->data = "smit@121";
	}

/* ------ start house cash master ------ */

	public function HouseCash(Request $request){

		$title        ='Add House Cash Master';

		$comp_Name     = $request->session()->get('company_name');
		$cash_code    = $request->old('cash_code');
		$cash_name    = $request->old('cash_name');
		$gl_code      = $request->old('gl_code');
		$gl_code_name = $request->old('gl_code_name');
		$company_code = $request->old('company_code');
		$compName     = $request->old('compName');
		$pfct_code    = $request->old('pfct_code');
		$pfctName     = $request->old('pfctName');
		$houscash_id  = $request->old('houscash_id');
		$house_block  = $request->old('house_block');

		$button ='Save';
		$action ='/Master/House-bank-cash/House-Cash-Save';
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		$userdata['glmst_list']     = DB::table('MASTER_GL')->get();
		$userdata['help_cash_list'] = DB::table('MASTER_HOUSECASH')->Orderby('CASH_CODE', 'desc')->limit(5)->get();

		if(isset($comp_Name)){

	    	return view('admin.finance.master.houseCaskBank.house_cash_form',$userdata+compact('title','cash_name','cash_code','company_code','compName','pfct_code','pfctName','gl_code','gl_code_name','house_block','houscash_id','button','action'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function HouseCashSave(Request $request){

		$validate = $this->validate($request, [
			
			'cash_code' => 'required|max:6|unique:MASTER_HOUSECASH,CASH_CODE',
			'cash_name' => 'required|max:40',

		]);

    	$createdBy 	= $request->session()->get('userid');

		$data = array(

			"CASH_CODE"  => $request->input('cash_code'),
			"CASH_NAME"  => $request->input('cash_name'),
			"GL_CODE"    => $request->input('gl_code'),
			"GL_NAME"    => $request->input('gl_code_name'),
			"COMP_CODE"  => $request->input('company_code'),
			"COMP_NAME"  => $request->input('compName'),
			"PFCT_CODE"  => $request->input('pfct_code'),
			"PFCT_NAME"  => $request->input('pfctName'),
			"CREATED_BY" => $createdBy,
			
		);

		$saveData = DB::table('MASTER_HOUSECASH')->insert($data);

		$discriptn_page = "Master house cash insert done by user";
		$vrno='';
		$this->userLogInsert($createdBy,$discriptn_page,$vrno);

		if ($saveData) {

			$request->session()->flash('alert-success', 'House Cash Was Successfully Added...!');
			return redirect('/Master/House-bank-cash/View-House-Cash-Mast');

		} else {

			$request->session()->flash('alert-error', 'House Cash Can Not Added...!');
			return redirect('/Master/House-bank-cash/View-House-Cash-Mast');

		}

	}

	public function ViewHouseCash(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()){

			$title    = 'View House Cash Master';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

    		if($userType=='admin'){
	    		$data= DB::table('MASTER_HOUSECASH')->orderBy('CASH_CODE','DESC');

    		}else if ($userType=='superAdmin' || $userType=='user') {    		
	    		$data= DB::table('MASTER_HOUSECASH')->orderBy('CASH_CODE','DESC');
	    	}
	    	else{
	    		$data='';
	    	}
    		return DataTables()->of($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.houseCaskBank.view_house_cash');
    	}else{
			return redirect('/useractivity');
	   }
    }

    public function EditHouseCash($id){

    	$title = 'Edit House Cash Master';

    	//print_r($id);
    	$cashCode = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);


    	if($cashCode!=''){
    	    $query = DB::table('MASTER_HOUSECASH');
			$query->where('CASH_CODE', $cashCode);
			$classData= $query->get()->first();

			$company_code = $classData->COMP_CODE;
			$compName     = $classData->COMP_NAME;
			$pfct_code    = $classData->PFCT_CODE;
			$pfctName     = $classData->PFCT_NAME;
			$cash_code    = $classData->CASH_CODE;
			$cash_name    = $classData->CASH_NAME;
			$gl_code      = $classData->GL_CODE;
			$gl_code_name = $classData->GL_NAME;
			$houscash_id  = $classData->CASH_CODE;
			$house_block  = $classData->CASH_CODE_BLOCK;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/Master/House-bank-cash/House-Cash-Update';

			$userdata['comp_list']  = DB::table('MASTER_COMP')->get();
			$userdata['pfct_list']  = DB::table('MASTER_PFCT')->get();
			$userdata['glmst_list'] = DB::table('MASTER_GL')->get();

			return view('admin.finance.master.houseCaskBank.house_cash_form',$userdata+compact('title','cash_name','cash_code','company_code','compName','pfct_code','pfctName','gl_code','gl_code_name','houscash_id','house_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'House Cash Not Found...!');
			return redirect('/Master/House-bank-cash/View-House-Cash-Mast');
		}

    }


    public function HouseCashUpdate(Request $request){

		$validate = $this->validate($request, [

			'cash_code'    => 'required|max:6',
			'cash_name'      => 'required|max:40',

		]);

		$cashcode = $request->input('idhousecash');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"CASH_CODE"        => $request->input('cash_code'),
			"CASH_NAME"        => $request->input('cash_name'),
			"GL_CODE"          => $request->input('gl_code'),
			"GL_NAME"          => $request->input('gl_code_name'),
			"COMP_CODE"        => $request->input('company_code'),
			"COMP_NAME"        => $request->input('compName'),
			"PFCT_CODE"        => $request->input('pfct_code'),
			"PFCT_NAME"        => $request->input('pfctName'),
			"CASH_CODE_BLOCK"  => $request->input('house_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		$saveData = DB::table('MASTER_HOUSECASH')->where('CASH_CODE', $cashcode)->update($data);

		$discriptn_page = "Master house cash update done by user";
		$vrno='';
		$this->userLogInsert($createdBy,$discriptn_page,$vrno);

		if ($saveData) {

			$request->session()->flash('alert-success', 'House Cash Was Successfully Updated...!');
			return redirect('/Master/House-bank-cash/View-House-Cash-Mast');

		} else {

			$request->session()->flash('alert-error', 'House Cash Can Not Added...!');
			return redirect('/Master/House-bank-cash/View-House-Cash-Mast');

		}

	}

	public function DeleteHouseCash(Request $request){

		$cashcode = $request->post('houseId');
    	

    	if ($cashcode!='') {
    		
    		$Delete = DB::table('MASTER_HOUSECASH')->where('CASH_CODE', $cashcode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'House Cash Was Deleted Successfully...!');
				return redirect('/Master/House-bank-cash/View-House-Cash-Mast');

			} else {

				$request->session()->flash('alert-error', 'House Cash Can Not Deleted...!');
				return redirect('/Master/House-bank-cash/View-House-Cash-Mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'House Cash  Not Found...!');
			return redirect('/Master/House-bank-cash/View-House-Cash-Mast');

    	}

	}

	public function search_cash_code(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$cash_code_search = $request->input('cash_code_search');

	    	$cash_code = DB::select("SELECT * FROM `MASTER_HOUSECASH` WHERE CASH_CODE LIKE '$cash_code_search%'");

	    	$count = count($cash_code);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $cash_code ;

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

    public function HelpCashCodeSearch(Request $request){

		$response_array = array();

	    $cash_code_help = $request->input('HelpcashCode');

		if ($request->ajax()) {

	    	$Seach_cash_Code_by_help = DB::select("SELECT * FROM `MASTER_HOUSECASH` WHERE CASH_CODE='$cash_code_help' OR CASH_CODE Like '$cash_code_help%' ORDER BY CASH_CODE DESC limit 5  ");
	    	
    		if ($Seach_cash_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_cash_Code_by_help ;

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

/* --------- end house cash master ---------- */

/* ---------- start house bank mater --------- */
	
	public function HouseBank(Request $request){

        $title        ='Add House Bank Master';

        $compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

		$tran_code    = $request->old('trans_code');
		$series_code  = $request->old('series_code');
		$series_name  = $request->old('series_name');
		$gl_code      = $request->old('gl_code');
		$config_block = $request->old('config_block');
		$rfhead1      = $request->old('rfhead1');
		$rfhead2      = $request->old('rfhead2');
		$rfhead3      = $request->old('rfhead3');
		$rfhead4      = $request->old('rfhead4');
		$rfhead5      = $request->old('rfhead5');
		$config_id    = $request->old('config_id');


    	$button='Save';
    	$action='Master/House-bank-cash/House-Bank-Save';
		//print_r($compData['comp_list']);exit;
		$transData['comp_list']  = DB::table('MASTER_COMP')->get();
		$transData['gl_list']    = DB::table('MASTER_GL')->get();
		$transData['bank_list']  = DB::table('MASTER_BANK')->get();
		$transData['state_list'] = DB::table('MASTER_STATE')->get();
		$transData['city_list'] = DB::table('MASTER_CITY')->get();
		$transData['pfct_list'] = DB::table('MASTER_PFCT')->get();
		

		if(isset($compName)){

    		return view('admin.finance.master.houseCaskBank.house_bank',$transData+compact('title','tran_code','series_code','series_name','gl_code','config_block','config_id','button','action'));

	    }else{

			return redirect('/useractivity');
		}

    }

    public function HouseBankSave(Request $request){

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$validate = $this->validate($request, [
			
			'bank_name' => 'required|max:6|unique:MASTER_HOUSEBANK,BANK_CODE',
			'bank_code_name' => 'required|max:40',
			'gl_name'   => 'required|max:6',

		]);

		$splitCity     = explode('[',$request->input('city'));
		$splitState    = explode('[',$request->input('state_code'));
		$splitCountry  = explode('[',$request->input('country'));
		$splitDistrict = explode('[',$request->input('district'));
    	
		$data = array(
			"BANK_CODE"    => $request->input('bank_name'),
			"BANK_NAME"    => $request->input('bank_code_name'),
			"GL_CODE"      => $request->input('gl_name'),
			"GL_NAME"      => $request->input('gl_code_name'),
			"COMP_CODE"    => $request->input('comp_code'),
			"COMP_NAME"    => $request->input('comp_code_name'),
			"PFCT_CODE"    => $request->input('profit_code'),
			"PFCT_NAME"    => $request->input('pfct_code_name'),
			"ACCT_TYPE"    => $request->input('acc_type'),
			"ACCT_NUMBER"  => $request->input('acc_num'),
			"IFS_CODE"     => $request->input('ifs_name'),
			"MICR_CODE"    => $request->input('micr_code'),
			"ADD1"         => $request->input('address1'),
			"ADD2"         => $request->input('address2'),
			"ADD3"         => $request->input('address3'),
			"CITY_CODE"    => $splitCity[0],
			"CITY_NAME"    => substr($splitCity[1], 0, -1),
			"DIST_CODE"    => $splitDistrict[0],
			"DIST_NAME"    => substr($splitDistrict[1], 0, -1),
			"STATE_CODE"   => $splitState[0],
			"STATE_NAME"   => substr($splitState[1], 0, -1),
			"COUNTRY_CODE" => $splitCountry[0],
			"COUNTRY_NAME" => substr($splitCountry[1], 0, -1),
			"PIN_CODE"     => $request->input('pincode'),
			"EMAIL"        => $request->input('email_id'),
			"CONTACTNO"    => $request->input('phone1'),
			"CREATED_BY"   => $createdBy,
			
		);

		$saveData = DB::table('MASTER_HOUSEBANK')->insert($data);

		$discriptn_page = "Master house bank insert done by user";
		$vrno='';
		$this->userLogInsert($createdBy,$discriptn_page,$vrno);

		if ($saveData) {

			$request->session()->flash('alert-success', 'House bank Was Successfully Added...!');
			return redirect('/Master/House-bank-cash/View-House-Bank-Mast');

		} else {

			$request->session()->flash('alert-error', 'House Bank Can Not Added...!');
			return redirect('/Master/House-bank-cash/View-House-Bank-Mast');

		}

	}

	public function ViewHouseBank(Request $request){

        $CompanyCode   = $request->session()->get('company_name');

    	if($request->ajax()) {

	    	$user_type = $request->session()->get('user_type');

			$userid = $request->session()->get('userid');

			$CompanyCode   = $request->session()->get('company_name');

			$macc_year   = $request->session()->get('macc_year');

			if($user_type == 'admin'){
    			
           		/*$data = DB::select("select a.COMP_CODE, b.COMP_NAME, a.GL_CODE, c.GL_NAME, a.CITY,a.PFCT_CODE,d.PFCT_NAME,a.BANK_CODE,a.BANK_NAME,a.ACCT_TYPE from MASTER_HOUSEBANK a, MASTER_COMP b, MASTER_GL c, MASTER_PFCT d WHERE a.COMP_CODE=b.COMP_CODE and a.GL_CODE=c.GL_CODE and a.PFCT_CODE=d.PFCT_CODE ORDER By a.BANK_CODE DESC");*/
			//DB::enableQueryLog();
           		$data = DB::table('MASTER_HOUSEBANK')->groupBy('BANK_CODE')->get()->toArray();
           	//dd(DB::getQueryLog());

    		}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	  		$data = DB::table('MASTER_HOUSEBANK')->groupBy('BANK_CODE')->get()->toArray();

	    	}else{
	    		
	    	 $data ='';
	    	}

			return DataTables()->of($data)->addIndexColumn()->toJson();
       	}

       	if(isset($CompanyCode)){
       		return view('admin.finance.master.houseCaskBank.view_house_bank'); 	
       	}else{
			return redirect('/useractivity');
	   	}
       
    }

    public function EditHouseBank(Request $request,$id){

    	$id = base64_decode($id);

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($id!=''){
    	    $query = DB::table('MASTER_HOUSEBANK');
			$query->where('BANK_CODE', $id);
			$bankData['bank_data'] = $query->get()->first();

			$bankData['comp_list'] = DB::table('MASTER_COMP')->get();
			$bankData['gl_list']   = DB::table('MASTER_GL')->get();
			$bankData['city_list'] = DB::table('MASTER_CITY')->get();
			$bankData['bank_list'] = DB::table('MASTER_BANK')->get();
			$bankData['pfct_list'] = DB::table('MASTER_PFCT')->get();
		    return view('admin.finance.master.houseCaskBank.edit_house_bank',$bankData);
			
		}else{
			$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('/Master/House-bank-cash/View-House-Bank-Mast');
		}
       
    }


    public function HouseBankUpdate(Request $request){

	//	print_r('hi');exit;

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$HouseBankID = $request->input('updateid1');

    	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$splitCity     = explode('[',$request->input('city'));
		$splitState    = explode('[',$request->input('state'));
		$splitCountry  = explode('[',$request->input('country'));
		$splitDistrict = explode('[',$request->input('district'));
		$splitPFCT     = explode('[',$request->input('profit_code'));
		$pfctName = $request->input('pfct_code_name');
		$data = array(
			"BANK_CODE"        => $request->input('bank_name'),
			"BANK_NAME"        => $request->input('bank_code_name'),
			"GL_CODE"          => $request->input('gl_name'),
			"GL_NAME"          => $request->input('gl_code_name'),
			"COMP_CODE"        => $request->input('comp_code'),
			"COMP_NAME"        => $request->input('comp_code_name'),
			"PFCT_CODE"        => $splitPFCT[0],
			"PFCT_NAME"        => substr($pfctName, 0, -1),
			"ACCT_TYPE"        => $request->input('acc_type'),
			"ACCT_NUMBER"      => $request->input('acc_num'),
			"IFS_CODE"         => $request->input('ifs_name'),
			"MICR_CODE"        => $request->input('micr_code'),
			"ADD1"             => $request->input('address1'),
			"ADD2"             => $request->input('address2'),
			"ADD3"             => $request->input('address3'),
			"CITY_CODE"        => $splitCity[0],
			"CITY_NAME"        => substr($splitCity[1], 0, -1),
			"DIST_CODE"        => $splitDistrict[0],
			"DIST_NAME"        => substr($splitDistrict[1], 0, -1),
			"STATE_CODE"       => $splitState[0],
			"STATE_NAME"       => substr($splitState[1], 0, -1),
			"COUNTRY_CODE"     => $splitCountry[0],
			"COUNTRY_NAME"     => substr($splitCountry[1], 0, -1),
			"PIN_CODE"         => $request->input('pincode'),
			"EMAIL"            => $request->input('email_id'),
			"CONTACTNO"        => $request->input('phone1'),
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);
		
		$saveData = DB::table('MASTER_HOUSEBANK')->where('BANK_CODE', $HouseBankID)->update($data);

		$discriptn_page = "Master house bank update done by user";
		$vrno='';
		$this->userLogInsert($createdBy,$discriptn_page,$vrno);
		

		if ($saveData) {

			$request->session()->flash('alert-success', 'House bank Was Successfully Updated...!');
			return redirect('/Master/House-bank-cash/View-House-Bank-Mast');

		} else {

			$request->session()->flash('alert-error', 'House bank Was Successfully Updated...!');
			return redirect('/Master/House-bank-cash/View-House-Bank-Mast');

		}

	}

	public function DeleteHouseBank(Request $request){

		$housebankID = $request->post('housebankID');
    	

    	if ($housebankID!='') {
    		
    		$Delete = DB::table('MASTER_HOUSEBANK')->where('BANK_CODE', $housebankID)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'House Bank Was Deleted Successfully...!');
				return redirect('/Master/House-bank-cash/View-House-Bank-Mast');

			} else {

				$request->session()->flash('alert-error', 'House Bank Can Not Deleted...!');
				return redirect('/Master/House-bank-cash/View-House-Bank-Mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'House Bank Not Found...!');
			return redirect('/Master/House-bank-cash/View-House-Bank-Mast');

    	}

	}

    public function HouseBankChieldRTowData(Request $request){

		$response_array = array();
        $id = $request->input('bankCd');


	    if ($request->ajax()) {

	    	$housebank_details = DB::table("MASTER_HOUSEBANK")->where('BANK_CODE',$id)->get()->first();
    		if ($housebank_details) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $housebank_details;

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


    public function GetPfctCode(Request $request){

    	$comp_code = $request->post('comp_code');
    	 
    	$getcompcode = DB::table('MASTER_PFCT')->where('COMP_CODE',$comp_code)->get();
    	
      	if(!empty($getcompcode)){

	        $response = '<option value="">--SELECT--</option>';
	        foreach ($getcompcode as $row) 
        	{
          	$response .= '<option value="'.$row->PFCT_CODE.'['.$row->PFCT_NAME.']'.'">'.$row->PFCT_CODE.'['.$row->PFCT_NAME.']'.'</option>';
        	}
      	}else{
        	$response = '<option value="">--SELECT--</option>';
      	}
      	echo $response;exit; 

    }



	/* ---------- end house bank mater --------- */
	




	/* ---------- Start Pending Purchase Reports  --------- */

	public function CommonFunction($macc_year,$Comp_Code,$Tran_Code,$Tran_Code2){

         $queryData['item_um_aum_list'] = DB::table('MASTER_FY')->where('COMP_CODE',$Comp_Code)->where('FY_CODE',$macc_year)->get();

         $queryData['bank_list']        = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=',$Tran_Code)->orWhere('TRAN_CODE', '=',$Tran_Code2)->get();

         $queryData['transpoter_list']  = DB::table('MASTER_ACC')->get();
         $queryData['item_list']        = DB::table('MASTER_ITEM')->get();

      
        $queryData['qc_list']   = DB::table('PQCS_HEAD')->get()->toArray();
        $queryData['item_list'] = DB::table('PQCS_BODY')->groupBy('ITEM_CODE')->get();


        return $queryData;

    }


	public function IndentPending(Request $request){

		$title        ='Indent Pending/Complete/All Report';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

		$TranCode   = 'A0';
		$Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];

		$PINDENT  = DB::table('PINDENT_HEAD')->get();
		$MASPLANT = DB::table('MASTER_PLANT')->get();
		$MASITEM  = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_pending_cancel_all_indent',$userdata+compact('title','bank_list','transpoter_list','item_list','PINDENT','MASPLANT','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



	}



	public function purchaseIndentPendingCompleteAll(Request $request){

        if($request->ajax()) {

            if (!empty($request->IndentNo || $request->plantCode || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $IndentNu = $request->IndentNo;

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[2];

                }

               

                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  PINDENT_HEAD.VRNO = '$IndVrno'";
                } 

                if(isset($request->plantCode)  && trim($request->plantCode)!=""){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= "AND  PINDENT_HEAD.PLANT_CODE = '$request->plantCode'";

                }

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  PINDENT_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  PINDENT_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }

                //DB::enableQueryLog();

                if($request->ReportTypes == 'pending'){

                	$data = DB::select("SELECT PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.VRDATE,PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.PLANT_CODE,PINDENT_HEAD.PARTYREFNO,PINDENT_HEAD.PARTYREFDATE,PINDENT_BODY.* FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_HEAD.PINDHID = PINDENT_BODY.PINDHID WHERE 1=1 $strWhere AND PINDENT_BODY.PENQBID = '0' AND PINDENT_BODY.PENQHID = '0'");



                }else if($request->ReportTypes == 'complete'){

                	$data = DB::select("SELECT PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.VRDATE,PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.PLANT_CODE,PINDENT_HEAD.PARTYREFNO,PINDENT_HEAD.PARTYREFDATE,PINDENT_BODY.* FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_HEAD.PINDHID = PINDENT_BODY.PINDHID WHERE 1=1 $strWhere AND PINDENT_BODY.PENQBID != '0' AND PINDENT_BODY.PENQHID != '0'");


                }else{

                	$data = DB::select("SELECT PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.VRDATE,PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.PLANT_CODE,PINDENT_HEAD.PARTYREFNO,PINDENT_HEAD.PARTYREFDATE,PINDENT_BODY.* FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_HEAD.PINDHID = PINDENT_BODY.PINDHID WHERE 1=1 $strWhere");


                }
                
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



    public function purchaseIndentCancel(Request $request){

		$title        ='Cancel Indent';

		$company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }


		$PINDENT  = DB::table('PINDENT_HEAD')->get();
		$MASPLANT = DB::table('MASTER_PLANT')->get();
		$MASITEM  = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.purchase.cancel_indent',$userdata+compact('title','PINDENT','MASPLANT','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



	}


	public function purchaseDataIndentCancel(Request $request){

        if($request->ajax()) {

            if (!empty($request->IndentNo || $request->item_code || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $IndentNu = $request->IndentNo;

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[2];

                }

               
                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  PINDENT_HEAD.VRNO = '$IndVrno'";
                } 

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  PINDENT_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  PINDENT_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }

                	//DB::enableQueryLog();

                	$data = DB::select("SELECT PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.VRDATE,PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.PLANT_CODE,PINDENT_HEAD.PARTYREFNO,PINDENT_HEAD.PARTYREFDATE,PINDENT_BODY.* FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_HEAD.PINDHID = PINDENT_BODY.PINDHID WHERE 1=1 $strWhere  AND PINDENT_BODY.PENQBID = '0' AND PINDENT_BODY.PENQHID = '0'");

                
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


    public function IndentCancel(Request $request,$hid,$bid){

    	$HID = base64_decode($hid);
    	$BID = base64_decode($bid);

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($HID!='' && $BID!=''){

    		//DB::enableQueryLog();


    		$cancelIndentFlag = 1050041070;

    		$data = array(

				"PENQHID"        => $cancelIndentFlag,
				"PENQBID"        => $cancelIndentFlag

			);

			$UpdateData = DB::table('PINDENT_BODY')->where('PINDHID', $HID)->where('PINDBID', $BID)->update($data);


			//dd(DB::getQueryLog());

			if ($UpdateData) {

				$request->session()->flash('alert-success', 'Purchase Indent Was Cancel Successfully...!');
				return redirect('report/purchase/purchase-indent/indent-cancel');

			} else {

				$request->session()->flash('alert-error', 'Purchase Indent Can Not be Cancel...!');
				return redirect('report/purchase/purchase-indent/indent-cancel');

			}
			
		}else{
			$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('report/purchase/purchase-indent/indent-cancel');
		}



    }

    

    public function QuotationPendingComplete(Request $request){

		$title        ='Quotation Pending/Complete Report';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

		$getcomcode    = explode('-', $company_name); 
		$CCFromSession = $getcomcode[0];

		$TranCode      = 'A0';
		$Tran_Code2    = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];

		$PQCSHEAD = DB::table('PQCS_HEAD')->get();
		$MASACC   = DB::table('MASTER_ACC')->get();
		$MASITEM  = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_pending_complete_quotation',$userdata+compact('title','bank_list','transpoter_list','item_list','PQCSHEAD','MASACC','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



	}


	public function purchaseQuotationPendingCompleteAll(Request $request){

        if($request->ajax()) {

            if (!empty($request->quotationNo || $request->accCode || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $IndVrno = $request->quotationNo;

                /*print_r($IndentNu);

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[1];

                }*/

               

                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  PQCS_HEAD.PQCSHID = '$IndVrno'";
                } 

                if(isset($request->accCode)  && trim($request->accCode)!=""){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= "AND  PQCS_BODY.ACC_CODE = '$request->accCode'";

                }

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  PQCS_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  PQCS_BODY.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }

                //DB::enableQueryLog();

                if($request->ReportTypes == 'pending'){

                	$data = DB::select("SELECT PQCS_HEAD.VRDATE,PQCS_HEAD.PFCT_CODE,PQCS_HEAD.PLANT_CODE,PQCS_HEAD.PQCSHID,PQCS_BODY.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID WHERE 1=1 $strWhere AND PQCS_BODY.PCNTRHID = 0 AND PQCS_BODY.PCNTRBID = 0");


                }else if($request->ReportTypes == 'complete'){

                	$data = DB::select("SELECT PQCS_HEAD.VRDATE,PQCS_HEAD.PFCT_CODE,PQCS_HEAD.PLANT_CODE,PQCS_HEAD.PQCSHID,PQCS_BODY.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID WHERE 1=1 $strWhere  AND PQCS_BODY.PCNTRHID != 0 AND PQCS_BODY.PCNTRBID != 0");


                }else{

                	$data = DB::select("SELECT PQCS_HEAD.VRDATE,PQCS_HEAD.PFCT_CODE,PQCS_HEAD.PLANT_CODE,PQCS_HEAD.PQCSHID,PQCS_BODY.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID WHERE 1=1 $strWhere");


                }
                
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


    public function purchaseQuotationCancel(Request $request){


    	$title        ='Cancel Quotation';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);



		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }


		$PQCSHEAD = DB::select("SELECT PQCS_HEAD.VRDATE,PQCS_HEAD.PFCT_CODE,PQCS_HEAD.PLANT_CODE,PQCS_BODY.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID WHERE 1=1 AND PQCS_BODY.PCNTRHID = 0 AND PQCS_BODY.PCNTRBID = 0 GROUP BY PQCS_BODY.VRNO");

		$MASPLANT = DB::table('MASTER_PLANT')->get();
		$MASITEM  = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    $userdata['blank_list'] = array();

	    //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.purchase.cancel_quotation',$userdata+compact('title','PQCSHEAD','MASPLANT','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



    }

    

    public function purchaseDataQuotationCancel(Request $request){

    	 if($request->ajax()) {

            if (!empty($request->QuotationNo || $request->item_code || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $IndentNu = $request->QuotationNo;

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[1];

                }

               
                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  PQCS_HEAD.PQCSHID = '$IndVrno'";
                } 

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  PQCS_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  PQCS_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }


                

                //DB::enableQueryLog();

                	$data = DB::select("SELECT PQCS_HEAD.VRDATE,PQCS_HEAD.PLANT_CODE,MASTER_ITEMUM.AUM_FACTOR,MASTER_ITEMUM.AUM_CODE,MASTER_ITEMUM.UM_CODE,PQCS_BODY.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID LEFT JOIN MASTER_ITEMUM ON PQCS_BODY.ITEM_CODE = MASTER_ITEMUM.ITEM_CODE WHERE 1=1 $strWhere  AND PQCS_BODY.PCNTRHID = 0 AND PQCS_BODY.PCNTRBID = 0");

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


     public function QuotationCancel(Request $request,$hid,$bid,$aumFac){

		$HID    = base64_decode($hid);
		$BID    = base64_decode($bid);
		$AUMFAC = base64_decode($aumFac);

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($HID!='' && $BID!='' && $AUMFAC!=''){

    		//DB::enableQueryLog();


    		$cancelIndentFlag = 1050041070;

    		$data = array(

				"PENQHID"        => $cancelIndentFlag,
				"PENQBID"        => $cancelIndentFlag

			);

			$UpdateData = DB::table('PINDENT_BODY')->where('PINDHID', $HID)->where('PINDBID', $BID)->update($data);


			//dd(DB::getQueryLog());

			if ($UpdateData) {

				$request->session()->flash('alert-success', 'Purchase Indent Was Cancel Successfully...!');
				return redirect('report/purchase/purchase-indent/indent-cancel');

			} else {

				$request->session()->flash('alert-error', 'Purchase Indent Can Not be Cancel...!');
				return redirect('report/purchase/purchase-indent/indent-cancel');

			}
			
		}else{
			$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('report/purchase/purchase-indent/indent-cancel');
		}



    }

    public function QuotationUpdateCancelQty(Request $request){

		$PQCSHID   = $request->input('PQCSHID');
		$PQCSBID   = $request->input('PQCSBID');
		$CANCELQTY = $request->input('CANCELQTY');
		$QTYCANCEL = $request->input('QTYCANCEL');
		$QTYRECD   = $request->input('QTYRECD');
		$QTYISSUED = $request->input('QTYISSUED');
		$RATE      = $request->input('RATE');

		$response_array = array();

		if($request->ajax()) {

			if($QTYRECD  == 0){

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
			
			}else{

				
				$REMANINGQTY 	= $QTYRECD - $QTYISSUED;

				$FINALQTY    	= $REMANINGQTY - $QTYCANCEL;

				$CHECKCANCELQTY = $CANCELQTY + $QTYCANCEL;

			
				if($CANCELQTY > $FINALQTY){

					$response_array['response'] = 'Qty Error';
		            $response_array['data'] = '' ;
		            $data = json_encode($response_array);

		            print_r($data);

				}else{

					$data_body = array(
						'QTYCANCEL'  => $CHECKCANCELQTY
					);

					$UPDATE_PQCS_BODY = DB::table('PQCS_BODY')->where('PQCSHID',$PQCSHID)->where('PQCSBID',$PQCSBID)->update($data_body);

					if ($UPDATE_PQCS_BODY) {

						$response_array['response'] = 'success';
						$response_array['data']     = $CANCELQTY;
						$response_array['datas'] 	= $QTYCANCEL;
			            $data = json_encode($response_array);

			            print_r($data);

					}else{

						$response_array['response'] = 'error';
		                $response_array['data'] 	= $CANCELQTY;
		                $response_array['datas'] 	= $QTYCANCEL;
		                $data = json_encode($response_array);

		                print_r($data);
						
					}

				}

			}

    	}else{

				$response_array['response'] = 'Ajax Error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
				
		}


    }


    public function QuotationUpdateTaxAmt(Request $request){

		$PQTNHID = $request->input('PqheadId');
		$PQTNBID = $request->input('PqBodyId');
		$TAXAMT  = $request->input('amtAr');
		$PQTID   = $request->input('pqTax');
		$TAX_AMT = array_filter($TAXAMT, 'strlen');
		$response_array = array();

		if($request->ajax()) {

			$getcount = count($TAX_AMT);
		
			for ($i=0; $i < $getcount; $i++) {
				$idAmt = $i+1;
				$data_amt =array(
					'TAX_AMT' => $TAX_AMT[$idAmt],
				);
				$UPDATE_PQTN_TAX = DB::table('PQTN_TAX')->where('PQTNHID',$PQTNHID)->where('PQTNBID',$PQTNBID)->where('PQTNTID',$PQTID[$i])->update($data_amt);
			}
			
			if ($UPDATE_PQTN_TAX) {

    			$response_array['response'] = 'success';
	            $data = json_encode($response_array);
	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
				
			}

    	}else{

				$response_array['response'] = 'Ajax Error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
				
		}


    }


    public function ContractPendingComplete(Request $request){

		$title        ='Contract Pending/Complete Report';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

		$getcomcode    = explode('-', $company_name); 
		$CCFromSession = $getcomcode[0];

		$TranCode      = 'A0';
		$Tran_Code2    = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];

		$PCNTRHEAD = DB::table('PCNTR_HEAD')->get();
		$MASACC    = DB::table('MASTER_ACC')->get();
		$MASITEM   = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_pending_complete_contract',$userdata+compact('title','bank_list','transpoter_list','item_list','PCNTRHEAD','MASACC','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



	}


	public function purchaseContractPendingCompleteAll(Request $request){

        if($request->ajax()) {

            if (!empty($request->contractNo || $request->accCode || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $OrderNo = $request->contractNo;

                if (isset($OrderNo)) {

                	$exp = explode(" ",$OrderNo);

                	$OrderNo = $exp[2];

                }

               

                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  PCNTR_HEAD.VRNO = '$OrderNo'";
                } 

                if(isset($request->accCode)  && trim($request->accCode)!=""){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= "AND  PCNTR_HEAD.ACC_CODE = '$request->accCode'";

                }

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  PCNTR_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  PCNTR_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }

                //DB::enableQueryLog();

                if($request->ReportTypes == 'pending'){

                	$data = DB::select("SELECT PCNTR_HEAD.VRDATE,PCNTR_HEAD.PFCT_CODE,PCNTR_HEAD.PLANT_CODE,PCNTR_HEAD.TRAN_CODE,PCNTR_BODY.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID WHERE 1=1 $strWhere AND PCNTR_BODY.PORDERHID = '0' AND PCNTR_BODY.PORDERBID = '0'");



                }else if($request->ReportTypes == 'complete'){

                	$data = DB::select("SELECT PCNTR_HEAD.VRDATE,PCNTR_HEAD.PFCT_CODE,PCNTR_HEAD.PLANT_CODE,PCNTR_HEAD.TRAN_CODE,PCNTR_BODY.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID WHERE 1=1 $strWhere AND PCNTR_BODY.PORDERHID != '0' AND PCNTR_BODY.PORDERBID != '0'");


                }else{

                	$data = DB::select("SELECT PCNTR_HEAD.VRDATE,PCNTR_HEAD.PFCT_CODE,PCNTR_HEAD.PLANT_CODE,PCNTR_HEAD.TRAN_CODE,PCNTR_BODY.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID WHERE 1=1 $strWhere");


                }
                
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


    public function purchaseContractCancel(Request $request){


    	$title        ='Cancel Contract';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);



		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }


		$PCNTRHEAD = DB::select("SELECT PCNTR_HEAD.VRDATE,PCNTR_HEAD.PFCT_CODE,PCNTR_HEAD.PLANT_CODE,PCNTR_HEAD.TRAN_CODE,PCNTR_BODY.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID WHERE 1=1 AND PCNTR_BODY.PORDERHID = '0' AND PCNTR_BODY.PORDERBID = '0' GROUP BY PCNTR_BODY.VRNO");

		$MASPLANT = DB::table('MASTER_PLANT')->get();
		$MASITEM  = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    $userdata['blank_list'] = array();

	    //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.purchase.cancel_contract',$userdata+compact('title','PCNTRHEAD','MASPLANT','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



    }

    public function purchaseDataContractCancel(Request $request){

    	 if($request->ajax()) {

            if (!empty($request->ContractNo || $request->item_code || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $IndentNu = $request->ContractNo;

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[2];

                }

               
                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  PCNTR_HEAD.VRNO = '$IndVrno'";
                } 

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  PCNTR_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  PCNTR_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }


                

                //DB::enableQueryLog();

                	$data = DB::select("SELECT PCNTR_HEAD.VRDATE,PCNTR_HEAD.PLANT_CODE,PCNTR_HEAD.TRAN_CODE,PCNTR_HEAD.ACC_CODE,MASTER_ITEMUM.AUM_FACTOR,MASTER_ITEMUM.AUM_CODE,MASTER_ITEMUM.UM_CODE,PCNTR_BODY.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN MASTER_ITEMUM ON PCNTR_BODY.ITEM_CODE = MASTER_ITEMUM.ITEM_CODE WHERE 1=1 $strWhere  AND  PCNTR_BODY.PORDERHID = '0' AND PCNTR_BODY.PORDERBID = '0'");

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


    public function ContractUpdateCancelQty(Request $request){

		$PCNTRHID  = $request->input('PCNTRHID');
		$PCNTRBID  = $request->input('PCNTRBID');
		$AUMFACT   = $request->input('AUMFACT');
		$CANCELQTY = $request->input('CANCELQTY');
		$QTYRECD   = $request->input('QTYRECD');
		$RATE      = $request->input('RATE');
		$QTYISSUED = $request->input('QTYISSUED');
		$QTYCANCEL = $request->input('QTYCANCEL');


		$response_array = array();

		if($request->ajax()) {

			if($QTYRECD  == 0){

				$response_array['response'] = 'Qty Error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
			
			}else{


				$REMANINGQTY 	= $QTYRECD - $QTYISSUED;

				$FINALQTY    	= $REMANINGQTY - $QTYCANCEL;

				$FINALBASIC  	= $FINALQTY * $RATE;

				$CHECKCANCELQTY = $CANCELQTY + $QTYCANCEL;


				if($CANCELQTY > $FINALQTY){

					$response_array['response'] = 'Qty Error';
		            $response_array['data'] = '' ;
		            $data = json_encode($response_array);

		            print_r($data);

				}else{

					$data_body = array(
						'QTYCANCEL'  => $CHECKCANCELQTY
					);

					$UPDATE_PCNTR_BODY = DB::table('PCNTR_BODY')->where('PCNTRHID',$PCNTRHID)->where('PCNTRBID',$PCNTRBID)->update($data_body);

					if ($UPDATE_PCNTR_BODY) {

						$response_array['response'] = 'success';
						$response_array['data']     = $CANCELQTY;
						$response_array['datas'] 	= $QTYCANCEL;
			            $data = json_encode($response_array);

			            print_r($data);

					}else{

						$response_array['response'] = 'error';
		                $response_array['data'] 	= $CANCELQTY;
		                $response_array['datas'] 	= $QTYCANCEL;
		                $data = json_encode($response_array);

		                print_r($data);
						
					}

				}


			}

    	}else{

			$response_array['response'] = 'Ajax Error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);
				
		}


    }


     public function ContractUpdateTaxAmt(Request $request){

		$PCNTRHID = $request->input('PcheadId');
		$PCNTRBID = $request->input('PcBodyId');
		$TAXAMT   = $request->input('amtAr');
		$PCTID    = $request->input('pcTax');
		$TAX_AMT  = array_filter($TAXAMT, 'strlen');
		$response_array = array();

		if($request->ajax()) {

			$getcount = count($TAX_AMT);
		
			for ($i=0; $i < $getcount; $i++) {

				$idAmt = $i+1;

				$data_amt =array(
					'TAX_AMT' => $TAX_AMT[$idAmt],
				);

				$UPDATE_PCNTR_TAX = DB::table('PCNTR_TAX')->where('PCNTRHID',$PCNTRHID)->where('PCNTRBID',$PCNTRBID)->where('PCNTRTID',$PCTID[$i])->update($data_amt);
			}
			
			if ($UPDATE_PCNTR_TAX) {

    			$response_array['response'] = 'success';
	            $data = json_encode($response_array);
	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
				
			}

    	}else{

				$response_array['response'] = 'Ajax Error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
				
		}


    }

     public function OrderPendingComplete(Request $request){

		$title        ='Order Pending/Complete Report';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

		$getcomcode    = explode('-', $company_name); 
		$CCFromSession = $getcomcode[0];

		$TranCode      = 'A0';
		$Tran_Code2    = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];

		$PORDERHEAD = DB::table('PORDER_HEAD')->get();
		$MASACC    = DB::table('MASTER_ACC')->get();
		$MASITEM   = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.purchase.pending_complete_order',$userdata+compact('title','bank_list','transpoter_list','item_list','PORDERHEAD','MASACC','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



	}


	public function purchaseOrderPendingCompleteAll(Request $request){

        if($request->ajax()) {

            if (!empty($request->orderNo || $request->accCode || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $IndentNu = $request->orderNo;

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[2];

                }

               

                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  PORDER_HEAD.VRNO = '$IndVrno'";
                } 

                if(isset($request->accCode)  && trim($request->accCode)!=""){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= "AND  PORDER_HEAD.ACC_CODE = '$request->accCode'";

                }

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  PORDER_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  PORDER_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }

                //DB::enableQueryLog();

                if($request->ReportTypes == 'pending'){

                	$data = DB::select("SELECT PORDER_HEAD.VRDATE,PORDER_HEAD.PFCT_CODE,PORDER_HEAD.PLANT_CODE,PORDER_HEAD.TRAN_CODE,PORDER_BODY.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID WHERE 1=1 $strWhere AND PORDER_BODY.GRNHID = '0' AND PORDER_BODY.GRNBID = '0'");



                }else if($request->ReportTypes == 'complete'){

                	$data = DB::select("SELECT PORDER_HEAD.VRDATE,PORDER_HEAD.PFCT_CODE,PORDER_HEAD.PLANT_CODE,PORDER_HEAD.TRAN_CODE,PORDER_BODY.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID WHERE 1=1 $strWhere AND PORDER_BODY.GRNHID != '0' AND PORDER_BODY.GRNBID != '0'");


                }else{

                	$data = DB::select("SELECT PORDER_HEAD.VRDATE,PORDER_HEAD.PFCT_CODE,PORDER_HEAD.PLANT_CODE,PORDER_HEAD.TRAN_CODE,PORDER_BODY.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID WHERE 1=1 $strWhere");


                }
                
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

     public function purchaseOrderCancel(Request $request){


    	$title        ='Cancel Order';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);



		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }


		$PORDERHEAD = DB::select("SELECT PORDER_HEAD.VRDATE,PORDER_HEAD.PFCT_CODE,PORDER_HEAD.PLANT_CODE,PORDER_HEAD.TRAN_CODE,PORDER_BODY.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID WHERE 1=1 AND PORDER_BODY.GRNHID = '0' AND PORDER_BODY.GRNBID = '0' GROUP BY PORDER_BODY.VRNO");

		$MASPLANT = DB::table('MASTER_PLANT')->get();
		$MASITEM  = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    $userdata['blank_list'] = array();

	    //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.purchase.cancel_order',$userdata+compact('title','PORDERHEAD','MASPLANT','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



    }

    public function purchaseDataOrderCancel(Request $request){

    	 if($request->ajax()) {

            if (!empty($request->OrderNo || $request->item_code || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $IndentNu = $request->OrderNo;

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[2];

                }

               
                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  PORDER_HEAD.VRNO = '$IndVrno'";
                } 

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  PORDER_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  PORDER_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }


                

                //DB::enableQueryLog();

                	$data = DB::select("SELECT PORDER_HEAD.VRDATE,PORDER_HEAD.PLANT_CODE,PORDER_HEAD.TRAN_CODE,PORDER_HEAD.ACC_CODE,MASTER_ITEMUM.AUM_FACTOR,MASTER_ITEMUM.AUM_CODE,MASTER_ITEMUM.UM_CODE,PORDER_BODY.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN MASTER_ITEMUM ON PORDER_BODY.ITEM_CODE = MASTER_ITEMUM.ITEM_CODE WHERE 1=1 $strWhere  AND  PORDER_BODY.GRNHID = '0' AND PORDER_BODY.GRNBID = '0'");

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


    public function OrderUpdateCancelQty(Request $request){

		$PORDERHID = $request->input('PORDERHID');
		$PORDERBID  = $request->input('PORDERBID');
		$AUMFACT   = $request->input('AUMFACT');
		$CANCELQTY = $request->input('CANCELQTY');
		$QTYRECD   = $request->input('QTYRECD');
		$TAXCODE   = $request->input('TAXCODE');
		$RATE      = $request->input('RATE');
		$QTYISSUED = $request->input('QTYISSUED');
		$QTYCANCEL = $request->input('QTYCANCEL');

		$response_array = array();

		if($request->ajax()) {

			if($QTYRECD  == 0){

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
			
			}else{

				$CAL_TAX_D = DB::select("SELECT t1.*,t2.*,t3.* FROM PORDER_TAX t3 LEFT JOIN PORDER_BODY t2 ON t2.PORDERBID = t3.PORDERBID LEFT JOIN PORDER_HEAD t1 ON t1.PORDERHID = t3.PORDERHID WHERE t2.TAX_CODE='$TAXCODE' AND t3.PORDERHID='$PORDERHID' AND t3.PORDERBID='$PORDERBID'");

				$REMANINGQTY = $QTYRECD - $QTYISSUED;

				$FINALQTY    = $REMANINGQTY - $QTYCANCEL;

				$FINALBASIC  = $FINALQTY * $RATE;

				$CHECKCANCELQTY = $CANCELQTY + $QTYCANCEL;


				if($CANCELQTY > $FINALQTY){

					$response_array['response'] = 'Qty Error';
		            $response_array['data'] = '' ;
		            $data = json_encode($response_array);

		            print_r($data);

				}else{

					$data_body = array(
						'QTYCANCEL'  => $CHECKCANCELQTY
					);

					//DB::enableQueryLog();

					$UPDATE_PCNTR_BODY = DB::table('PORDER_BODY')->where('PORDERHID',$PORDERHID)->where('PORDERBID',$PORDERBID)->update($data_body);

					//dd(DB::getQueryLog());

					if ($UPDATE_PCNTR_BODY) {

						$response_array['response'] = 'success';
						$response_array['data']     = '';
						$response_array['calTax']   = '';
			            $data = json_encode($response_array);

			            print_r($data);

					}else{

						$response_array['response'] = 'error';
		                $response_array['data'] = '' ;
		                $data = json_encode($response_array);

		                print_r($data);
						
					}

				}

			}

    	}else{

			$response_array['response'] = 'Ajax Error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);
				
		}


    }


    public function OrderUpdateTaxAmt(Request $request){

		$PORDERHID = $request->input('PoheadId');
		$PORDERBID = $request->input('PoBodyId');
		$TAXAMT    = $request->input('amtAr');
		$POTID     = $request->input('pcTax');
		$TAX_AMT   = array_filter($TAXAMT, 'strlen');
		$response_array = array();

		if($request->ajax()) {

			$getcount = count($TAX_AMT);
		
			for ($i=0; $i < $getcount; $i++) {

				$idAmt = $i+1;

				$data_amt =array(
					'TAX_AMT' => $TAX_AMT[$idAmt],
				);

				$UPDATE_PCNTR_TAX = DB::table('PORDER_TAX')->where('PORDERHID',$PORDERHID)->where('PORDERBID',$PORDERBID)->where('PORDERTID',$POTID[$i])->update($data_amt);
			}
			
			if ($UPDATE_PCNTR_TAX) {

    			$response_array['response'] = 'success';
	            $data = json_encode($response_array);
	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
				
			}

    	}else{

				$response_array['response'] = 'Ajax Error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
				
		}


    }

    public function GrnPendingComplete(Request $request){

		$title        ='GRN Pending/Complete Report';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

		$getcomcode    = explode('-', $company_name); 
		$CCFromSession = $getcomcode[0];

		$TranCode      = 'A0';
		$Tran_Code2    = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];

		$GRNHEAD = DB::table('GRN_HEAD')->get();
		$MASACC    = DB::table('MASTER_ACC')->get();
		$MASITEM   = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.purchase.pending_complete_grn',$userdata+compact('title','bank_list','transpoter_list','item_list','GRNHEAD','MASACC','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



	}

	public function purchaseGrnPendingCompleteAll(Request $request){

        if($request->ajax()) {

            if (!empty($request->GrnNo || $request->accCode || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $IndentNu = $request->GrnNo;

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[2];

                }

               

                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  GRN_HEAD.VRNO = '$IndVrno'";
                } 

                if(isset($request->accCode)  && trim($request->accCode)!=""){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= "AND  GRN_HEAD.ACC_CODE = '$request->accCode'";

                }

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  GRN_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  GRN_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }

                //DB::enableQueryLog();

                if($request->ReportTypes == 'pending'){

                	$data = DB::select("SELECT GRN_HEAD.VRDATE,GRN_HEAD.PFCT_CODE,GRN_HEAD.PLANT_CODE,GRN_HEAD.TRAN_CODE,GRN_BODY.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID WHERE 1=1 $strWhere AND GRN_BODY.PBILLHID = '0' AND GRN_BODY.PBILLBID = '0'");



                }else if($request->ReportTypes == 'complete'){

                	$data = DB::select("SELECT GRN_HEAD.VRDATE,GRN_HEAD.PFCT_CODE,GRN_HEAD.PLANT_CODE,GRN_HEAD.TRAN_CODE,GRN_BODY.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID WHERE 1=1 $strWhere AND GRN_BODY.PBILLHID != '0' AND GRN_BODY.PBILLBID != '0'");


                }else{

                	$data = DB::select("SELECT GRN_HEAD.VRDATE,GRN_HEAD.PFCT_CODE,GRN_HEAD.PLANT_CODE,GRN_HEAD.TRAN_CODE,GRN_BODY.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID WHERE 1=1 $strWhere");


                }
                
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

    public function purchaseGrnCancel(Request $request){


    	$title        ='Cancel GRN';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);



		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }


		$GRNHEAD = DB::select("SELECT GRN_HEAD.VRDATE,GRN_HEAD.PFCT_CODE,GRN_HEAD.PLANT_CODE,GRN_HEAD.TRAN_CODE,GRN_BODY.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID WHERE 1=1  AND GRN_BODY.PBILLHID = '0' AND GRN_BODY.PBILLBID = '0'");

		$MASPLANT = DB::table('MASTER_PLANT')->get();
		$MASITEM  = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    $userdata['blank_list'] = array();

	    //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.purchase.cancel_grn',$userdata+compact('title','GRNHEAD','MASPLANT','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



    }


    public function GrnUpdateCancelQty(Request $request){

		$GRNHID    = $request->input('GRNHID');
		$GRNBID    = $request->input('GRNBID');
		$AUMFACT   = $request->input('AUMFACT');
		$CANCELQTY = $request->input('CANCELQTY');
		$QTYRECD   = $request->input('QTYRECD');
		$TAXCODE   = $request->input('TAXCODE');
		$RATE      = $request->input('RATE');
		$QTYCANCEL = $request->input('QTYCANCEL');

		$response_array = array();

		if($request->ajax()) {

			if($QTYRECD  == 0){

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
			
			}else{

				$CAL_TAX_D = DB::select("SELECT t1.*,t2.*,t3.* FROM GRN_TAX t3 LEFT JOIN GRN_BODY t2 ON t2.GRNBID = t3.GRNBID LEFT JOIN GRN_HEAD t1 ON t1.GRNHID = t3.GRNHID WHERE t2.TAX_CODE='$TAXCODE' AND t3.GRNHID='$GRNHID' AND t3.GRNBID='$GRNBID'");

				$FINALQTY    	= $QTYRECD - $QTYCANCEL;

				$FINALBASIC  	= $FINALQTY * $RATE;

				$CHECKCANCELQTY = $CANCELQTY + $QTYCANCEL;


				if($CANCELQTY > $FINALQTY){

					$response_array['response'] = 'Qty Error';
		            $response_array['data'] = '' ;
		            $data = json_encode($response_array);

		            print_r($data);

				}else{

					$data_body = array(
						'QTYCANCEL'  => $CHECKCANCELQTY
					);

					$UPDATE_PCNTR_BODY = DB::table('GRN_BODY')->where('GRNHID',$GRNHID)->where('GRNBID',$GRNBID)->update($data_body);

					if ($UPDATE_PCNTR_BODY) {

						$response_array['response'] = 'success';
						$response_array['data']     = '';
			            $data = json_encode($response_array);

			            print_r($data);

					}else{

						$response_array['response'] = 'error';
		                $response_array['data'] = '';
		                $data = json_encode($response_array);

		                print_r($data);
						
					}

				}

			
			}

    	}else{

			$response_array['response'] = 'Ajax Error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);
				
		}


    }


    public function GrnUpdateTaxAmt(Request $request){

		$GRNHID	   = $request->input('GrnheadId');
		$GRNBID    = $request->input('GrnBodyId');
		$TAXAMT    = $request->input('amtAr');
		$PGRNTID     = $request->input('pcTax');
		$TAX_AMT   = array_filter($TAXAMT, 'strlen');
		$response_array = array();

		if($request->ajax()) {

			$getcount = count($TAX_AMT);
		
			for ($i=0; $i < $getcount; $i++) {

				$idAmt = $i+1;

				$data_amt =array(
					'TAX_AMT' => $TAX_AMT[$idAmt],
				);

				$UPDATE_GRN_TAX = DB::table('GRN_TAX')->where('GRNHID',$GRNHID)->where('GRNBID',$GRNBID)->where('GRNTID',$PGRNTID[$i])->update($data_amt);
			}
			
			if ($UPDATE_GRN_TAX) {

    			$response_array['response'] = 'success';
	            $data = json_encode($response_array);
	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
				
			}

    	}else{

				$response_array['response'] = 'Ajax Error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
				
		}


    }


    public function purchaseDataGrnCancel(Request $request){

    	 if($request->ajax()) {

            if (!empty($request->GrnNo || $request->item_code || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $IndentNu = $request->GrnNo;

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[2];

                }

               
                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  GRN_HEAD.VRNO = '$IndVrno'";
                } 

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  GRN_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  GRN_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }


                

                //DB::enableQueryLog();

                	$data = DB::select("SELECT GRN_HEAD.VRDATE,GRN_HEAD.PLANT_CODE,GRN_HEAD.TRAN_CODE,GRN_HEAD.ACC_CODE,MASTER_ITEMUM.AUM_FACTOR,MASTER_ITEMUM.AUM_CODE,MASTER_ITEMUM.UM_CODE,GRN_BODY.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN MASTER_ITEMUM ON GRN_BODY.ITEM_CODE = MASTER_ITEMUM.ITEM_CODE WHERE 1=1 $strWhere  AND  GRN_BODY.PBILLHID = '0' AND GRN_BODY.PBILLBID = '0'");

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

    
     public function SalesPendingCompleteReport(Request $request){

		$title        ='Sale Contract Pending/Complete Report';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

		$getcomcode    = explode('-', $company_name); 
		$CCFromSession = $getcomcode[0];

		$TranCode      = 'A0';
		$Tran_Code2    = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];

		$SCNTRHEAD = DB::table('SCNTR_HEAD')->get();
		$MASACC    = DB::table('MASTER_ACC')->get();
		$MASITEM   = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_contract_pending_complete_all',$userdata+compact('title','bank_list','transpoter_list','item_list','SCNTRHEAD','MASACC','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



	}

	public function SaleContractPendingCompleteAll(Request $request){

        if($request->ajax()) {

            if (!empty($request->contractNo || $request->accCode || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $IndentNu = $request->contractNo;

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[2];

                }

               

                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  SCNTR_HEAD.VRNO = '$IndVrno'";
                } 

                if(isset($request->accCode)  && trim($request->accCode)!=""){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= "AND  SCNTR_HEAD.ACC_CODE = '$request->accCode'";

                }

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  SCNTR_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  SCNTR_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }

                //DB::enableQueryLog();

                if($request->ReportTypes == 'pending'){

                	$data = DB::select("SELECT SCNTR_HEAD.VRDATE,SCNTR_HEAD.PFCT_CODE,SCNTR_HEAD.PLANT_CODE,SCNTR_HEAD.TRAN_CODE,SCNTR_BODY.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID WHERE 1=1 $strWhere AND SCNTR_BODY.SORDERHID = '0' AND SCNTR_BODY.SORDERBID = '0'");



                }else if($request->ReportTypes == 'complete'){

                	$data = DB::select("SELECT SCNTR_HEAD.VRDATE,SCNTR_HEAD.PFCT_CODE,SCNTR_HEAD.PLANT_CODE,SCNTR_HEAD.TRAN_CODE,SCNTR_BODY.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID WHERE 1=1 $strWhere AND SCNTR_BODY.SORDERHID != '0' AND SCNTR_BODY.SORDERBID != '0'");


                }else{

                	$data = DB::select("SELECT SCNTR_HEAD.VRDATE,SCNTR_HEAD.PFCT_CODE,SCNTR_HEAD.PLANT_CODE,SCNTR_HEAD.TRAN_CODE,SCNTR_BODY.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID WHERE 1=1 $strWhere");


                }
                
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


    public function SaleContractCancelReport(Request $request){


    	$title        ='Cancel Sales Contract';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);



		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }


		$SCNTRHEAD = DB::select("SELECT SCNTR_HEAD.VRDATE,SCNTR_HEAD.PFCT_CODE,SCNTR_HEAD.PLANT_CODE,SCNTR_HEAD.TRAN_CODE,SCNTR_BODY.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID WHERE 1=1  AND SCNTR_BODY.SORDERHID = '0' AND SCNTR_BODY.SORDERBID = '0' GROUP BY SCNTR_BODY.VRNO");

		$MASPLANT = DB::table('MASTER_PLANT')->get();
		$MASITEM  = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    $userdata['blank_list'] = array();

	    //print_r($getImp);
        

        if(isset($company_name)){ 

            return view('admin.finance.report.sales.cancel_sale_contract',$userdata+compact('title','SCNTRHEAD','MASPLANT','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



    }


    public function SaleContractCancelQtyReport(Request $request){

		$SCNTRHID  = $request->input('SCNTRHID');
		$SCNTRBID  = $request->input('SCNTRBID');
		$CANCELQTY = $request->input('CANCELQTY');
		$QTYISSUED = $request->input('QTYISSUED');
		$RATE      = $request->input('RATE');
		$ORDERQTY  = $request->input('ORDERQTY');
		$QTYCANCEL = $request->input('QTYCANCEL');


		$response_array = array();

		if($request->ajax()) {

			if($QTYISSUED  == 0){

				$response_array['response'] = 'Qty Error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
			
			}else{


				$REMANINGQTY 	= $QTYISSUED - $ORDERQTY;

				$FINALQTY    	= $REMANINGQTY - $QTYCANCEL;

				$FINALBASIC  	= $FINALQTY * $RATE;

				$CHECKCANCELQTY = $CANCELQTY + $QTYCANCEL;


				if($CANCELQTY > $FINALQTY){

					$response_array['response'] = 'Qty Error';
		            $response_array['data'] = '' ;
		            $data = json_encode($response_array);

		            print_r($data);

				}else{

					$data_body = array(
						'QTYCANCEL'  => $CHECKCANCELQTY
					);

					$UPDATE_PCNTR_BODY = DB::table('SCNTR_BODY')->where('SCNTRHID',$SCNTRHID)->where('SCNTRBID',$SCNTRBID)->update($data_body);

					if ($UPDATE_PCNTR_BODY) {

						$response_array['response'] = 'success';
						$response_array['data']     = $CANCELQTY;
						$response_array['datas'] 	= $QTYCANCEL;
			            $data = json_encode($response_array);

			            print_r($data);

					}else{

						$response_array['response'] = 'error';
		                $response_array['data'] 	= $CANCELQTY;
		                $response_array['datas'] 	= $QTYCANCEL;
		                $data = json_encode($response_array);

		                print_r($data);
						
					}

				}


			}

    	}else{

			$response_array['response'] = 'Ajax Error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);
				
		}


    }


    public function SaleContractCancel(Request $request){

    	 if($request->ajax()) {

            if (!empty($request->ContractNo || $request->item_code || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');

                $loginUser = $request->session()->get('userid');
                
                $strWhere = '';

                $IndentNu = $request->ContractNo;

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[2];

                }else{
                	$IndVrno ='';
                }

               
                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  SCNTR_HEAD.VRNO = '$IndVrno'";
                } 

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  SCNTR_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  SCNTR_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }


                

                //DB::enableQueryLog();

                	$data = DB::select("SELECT SCNTR_HEAD.VRDATE,SCNTR_HEAD.PLANT_CODE,SCNTR_HEAD.TRAN_CODE,SCNTR_HEAD.ACC_CODE,MASTER_ITEMUM.AUM_FACTOR,MASTER_ITEMUM.AUM_CODE,MASTER_ITEMUM.UM_CODE,SCNTR_BODY.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID LEFT JOIN MASTER_ITEMUM ON SCNTR_BODY.ITEM_CODE = MASTER_ITEMUM.ITEM_CODE WHERE 1=1 $strWhere  AND  SCNTR_BODY.SORDERHID = '0' AND SCNTR_BODY.SORDERBID = '0'");

                //dd(DB::getQueryLog());
                $discriptn_page = "Search sale contract cancle report by user";	
               	$this->userLogInsert($loginUser,$discriptn_page,$IndVrno);  
                
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


    public function SalesOrderPendingCompleteReport(Request $request){

		$title        ='Sale Order Pending/Complete Report';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

		$getcomcode    = explode('-', $company_name); 
		$CCFromSession = $getcomcode[0];

		$TranCode      = 'A0';
		$Tran_Code2    = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];

		$SORDERHEAD = DB::table('SORDER_HEAD')->get();
		$MASACC     = DB::table('MASTER_ACC')->get();
		$MASITEM    = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_order_pending_complete_all',$userdata+compact('title','bank_list','transpoter_list','item_list','SORDERHEAD','MASACC','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



	}


	public function SaleOrderPendingCompleteAll(Request $request){

        if($request->ajax()) {

            if (!empty($request->orderNo || $request->accCode || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $IndentNu = $request->orderNo;

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[2];

                }

               

                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  SORDER_HEAD.VRNO = '$IndVrno'";
                } 

                if(isset($request->accCode)  && trim($request->accCode)!=""){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= "AND  SORDER_HEAD.ACC_CODE = '$request->accCode'";

                }

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  SORDER_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  SORDER_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }

                //DB::enableQueryLog();

                if($request->ReportTypes == 'pending'){

                	$data = DB::select("SELECT SORDER_HEAD.VRDATE,SORDER_HEAD.PFCT_CODE,SORDER_HEAD.PLANT_CODE,SORDER_HEAD.TRAN_CODE,SORDER_BODY.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID WHERE 1=1 $strWhere AND SORDER_BODY.SCHALLANHID = '0' AND SORDER_BODY.SCHALLANBID = '0'");



                }else if($request->ReportTypes == 'complete'){

                	$data = DB::select("SELECT SORDER_HEAD.VRDATE,SORDER_HEAD.PFCT_CODE,SORDER_HEAD.PLANT_CODE,SORDER_HEAD.TRAN_CODE,SORDER_BODY.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID WHERE 1=1 $strWhere AND SORDER_BODY.SCHALLANHID != '0' AND SORDER_BODY.SCHALLANBID != '0'");


                }else{

                	$data = DB::select("SELECT SORDER_HEAD.VRDATE,SORDER_HEAD.PFCT_CODE,SORDER_HEAD.PLANT_CODE,SORDER_HEAD.TRAN_CODE,SORDER_BODY.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID WHERE 1=1 $strWhere");


                }
                
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


    public function SaleOrderCancelReport(Request $request){

    	$title        ='Cancel Sales Order';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);



		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }


		$SORDERHEAD = DB::select("SELECT SORDER_HEAD.VRDATE,SORDER_HEAD.PFCT_CODE,SORDER_HEAD.PLANT_CODE,SORDER_HEAD.TRAN_CODE,SORDER_BODY.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID WHERE 1=1  AND SORDER_BODY.SCHALLANHID = '0' AND SORDER_BODY.SCHALLANBID = '0' GROUP BY SORDER_BODY.VRNO");

		$MASPLANT = DB::table('MASTER_PLANT')->get();
		$MASITEM  = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    $userdata['blank_list'] = array();

	    //print_r($getImp);
        

        if(isset($company_name)){ 

            return view('admin.finance.report.sales.cancel_sale_order',$userdata+compact('title','SORDERHEAD','MASPLANT','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



    }

    public function SaleOrderCancel(Request $request){

    	 if($request->ajax()) {

            if (!empty($request->OrderNo || $request->item_code || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                $loginUser = $request->session()->get('userid');
                
                $strWhere = '';

                $IndentNu = $request->OrderNo;

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[2];

                }else{
                	$IndVrno ='';
                }

               
                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  SORDER_HEAD.VRNO = '$IndVrno'";
                } 

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  SORDER_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  SORDER_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }


                

               // DB::enableQueryLog();

                	$data = DB::select("SELECT SORDER_HEAD.VRDATE,SORDER_HEAD.PLANT_CODE,SORDER_HEAD.TRAN_CODE,SORDER_HEAD.ACC_CODE,MASTER_ITEMUM.AUM_FACTOR,MASTER_ITEMUM.AUM_CODE,MASTER_ITEMUM.UM_CODE,SORDER_BODY.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID LEFT JOIN MASTER_ITEMUM ON SORDER_BODY.ITEM_CODE = MASTER_ITEMUM.ITEM_CODE WHERE 1=1 $strWhere  AND  SORDER_BODY.SCHALLANHID = '0' AND SORDER_BODY.SCHALLANBID = '0'");

              //  dd(DB::getQueryLog());

                $discriptn_page = "Search sale order cancle report by user";	
               	$this->userLogInsert($loginUser,$discriptn_page,$IndVrno);
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


    public function SaleOrderCancelQtyReport(Request $request){

		$SORDERHID   = $request->input('SORDERHID');
		$SORDERBID   = $request->input('SORDERBID');
		$CANCELQTY   = $request->input('CANCELQTY');
		$QTYISSUED   = $request->input('QTYISSUED');
		$RATE        = $request->input('RATE');
		$SCHALLANQTY = $request->input('SCHALLANQTY');
		$QTYCANCEL   = $request->input('QTYCANCEL');


		$response_array = array();

		if($request->ajax()) {

			if($QTYISSUED  == 0){

				$response_array['response'] = 'Qty Error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
			
			}else{


				$REMANINGQTY 	= $QTYISSUED - $SCHALLANQTY;

				$FINALQTY    	= $REMANINGQTY - $QTYCANCEL;

				$FINALBASIC  	= $FINALQTY * $RATE;

				$CHECKCANCELQTY = $CANCELQTY + $QTYCANCEL;


				if($CANCELQTY > $FINALQTY){

					$response_array['response'] = 'Qty Error';
		            $response_array['data'] = '' ;
		            $data = json_encode($response_array);

		            print_r($data);

				}else{

					$data_body = array(
						'QTYCANCEL'  => $CHECKCANCELQTY
					);

					$UPDATE_SORDER_BODY = DB::table('SORDER_BODY')->where('SORDERHID',$SORDERHID)->where('SORDERBID',$SORDERBID)->update($data_body);

					if ($UPDATE_SORDER_BODY) {

						$response_array['response'] = 'success';
						$response_array['data']     = $CANCELQTY;
						$response_array['datas'] 	= $QTYCANCEL;
			            $data = json_encode($response_array);

			            print_r($data);

					}else{

						$response_array['response'] = 'error';
		                $response_array['data'] 	= $CANCELQTY;
		                $response_array['datas'] 	= $QTYCANCEL;
		                $data = json_encode($response_array);

		                print_r($data);
						
					}

				}


			}

    	}else{

			$response_array['response'] = 'Ajax Error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);
				
		}


    }


    public function SaleQuotationPendingCompleteReport(Request $request){

		$title        ='Sale Quotation Pending/Complete Report';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

		$getcomcode    = explode('-', $company_name); 
		$CCFromSession = $getcomcode[0];

		$TranCode      = 'A0';
		$Tran_Code2    = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];

		$SQTNHEAD = DB::table('SQTN_HEAD')->get();
		$MASACC     = DB::table('MASTER_ACC')->get();
		$MASITEM    = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_qutation_pending_complete_all',$userdata+compact('title','bank_list','transpoter_list','item_list','SQTNHEAD','MASACC','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



	}


	public function SaleQuotationPendingCompleteAll(Request $request){

        if($request->ajax()) {

            if (!empty($request->quotationNo || $request->accCode || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $QuotationNo = $request->quotationNo;

                if (isset($QuotationNo)) {

                	$exp = explode(" ",$QuotationNo);

                	$QuotationNo = $exp[2];

                }

               

                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  SQTN_HEAD.VRNO = '$QuotationNo'";
                } 

                if(isset($request->accCode)  && trim($request->accCode)!=""){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= "AND  SQTN_HEAD.ACC_CODE = '$request->accCode'";

                }

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  SQTN_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  SQTN_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }

                //DB::enableQueryLog();

                if($request->ReportTypes == 'pending'){

                	$data = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID WHERE 1=1 $strWhere AND SQTN_BODY.SCNTRHID = '0' AND SQTN_BODY.SCNTRBID = '0'");



                }else if($request->ReportTypes == 'complete'){

                	$data = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID WHERE 1=1 $strWhere AND SQTN_BODY.SCNTRHID != '0' AND SQTN_BODY.SCNTRBID != '0'");


                }else{

                	$data = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID WHERE 1=1 $strWhere");


                }
                
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


    public function SaleOrderQuotation(Request $request){

    	$title        ='Cancel Sales Quotation';

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);



		foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }


		$SQTNHEAD = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID WHERE 1=1  AND SQTN_BODY.SCNTRHID = '0' AND SQTN_BODY.SCNTRBID = '0'");

		$MASPLANT = DB::table('MASTER_PLANT')->get();
		$MASITEM  = DB::table('MASTER_ITEM')->get();

	    $getImp = explode("-",$macc_year);

	    $userdata['blank_list'] = array();

	    //print_r($getImp);
        

        if(isset($company_name)){ 

            return view('admin.finance.report.sales.cancel_sale_quotation',$userdata+compact('title','SQTNHEAD','MASPLANT','MASITEM'));
        }else{

            return redirect('/useractivity');

        }



    }

    public function SaleQuotationCancelReport(Request $request){

    	 if($request->ajax()) {

            if (!empty($request->QuotationNo || $request->item_code || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';	


                $loginUser   = $request->session()->get('userid');
                $QuotationNo = $request->QuotationNo;

                if (isset($QuotationNo)) {

                	$exp = explode(" ",$QuotationNo);

                	$QuotationNo = $exp[2];

                }else{
                	$QuotationNo = '';
                }

               
                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  SQTN_HEAD.VRNO = '$QuotationNo'";
                } 

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  SQTN_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  SQTN_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }


                

                //DB::enableQueryLog();

                	$data = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,SQTN_HEAD.ACC_CODE,MASTER_ITEMUM.AUM_FACTOR,MASTER_ITEMUM.AUM_CODE,MASTER_ITEMUM.UM_CODE,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ITEMUM ON SQTN_BODY.ITEM_CODE = MASTER_ITEMUM.ITEM_CODE WHERE 1=1 $strWhere  AND  SQTN_BODY.SCNTRHID = '0' AND SQTN_BODY.SCNTRBID = '0'");

                //dd(DB::getQueryLog());

            	$discriptn_page = "Search sale quotation cancle report by user";
            
                $this->userLogInsert($loginUser,$discriptn_page,$QuotationNo);  
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


    public function SaleQuotationCancelQtyReport(Request $request){

		$SQTNHID     = $request->input('SQTNHID');
		$SQTNBID     = $request->input('SQTNBID');
		$CANCELQTY   = $request->input('CANCELQTY');
		$QTYISSUED   = $request->input('QTYISSUED');
		$RATE        = $request->input('RATE');
		$QTYRECD     = $request->input('QTYRECD');
		$QTYCANCEL   = $request->input('QTYCANCEL');


		$response_array = array();

		if($request->ajax()) {

			if($QTYISSUED  == 0){

				$response_array['response'] = 'Qty Error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
			
			}else{


				$REMANINGQTY 	= $QTYISSUED - $QTYRECD;

				$FINALQTY    	= $REMANINGQTY - $QTYCANCEL;

				$FINALBASIC  	= $FINALQTY * $RATE;

				$CHECKCANCELQTY = $CANCELQTY + $QTYCANCEL;


				if($CANCELQTY > $FINALQTY){

					$response_array['response'] = 'Qty Error';
		            $response_array['data'] = '' ;
		            $data = json_encode($response_array);

		            print_r($data);

				}else{

					$data_body = array(
						'QTYCANCEL'  => $CHECKCANCELQTY
					);

					$UPDATE_SQTN_BODY = DB::table('SQTN_BODY')->where('SQTNHID',$SQTNHID)->where('SQTNBID',$SQTNBID)->update($data_body);

					if ($UPDATE_SQTN_BODY) {

						$response_array['response'] = 'success';
						$response_array['data']     = $CANCELQTY;
						$response_array['datas'] 	= $QTYCANCEL;
			            $data = json_encode($response_array);

			            print_r($data);

					}else{

						$response_array['response'] = 'error';
		                $response_array['data'] 	= $CANCELQTY;
		                $response_array['datas'] 	= $QTYCANCEL;
		                $data = json_encode($response_array);

		                print_r($data);
						
					}

				}


			}

    	}else{

			$response_array['response'] = 'Ajax Error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);
				
		}


    }


	/* ---------- End Pending Purchase Reports  --------- */


/* --------- create entry in USER_LOG when user submit any form ------*/

	function userLogInsert($loginuserId,$perticular,$vrseqNum){
		
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
				'USERLOGID'  =>$user_log_Id,
				'VRDATE'     =>$toDate,
				'VRNO'       =>$vrseqNum,
				'USER_CODE'  =>$loginuserId,
				'PERTICULAR' =>$discptn,
				'CREATED_BY' =>$loginuserId
			);
			DB::table('USER_LOG')->insert($userLog);
		
	}

/* --------- create entry in USER_LOG when user submit any form ------*/


}

?>