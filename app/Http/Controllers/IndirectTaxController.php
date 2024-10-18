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
class IndirectTaxController extends Controller{

	//public $data;

	public function __construct(Request $request){
		//$this->data = "smit@121";
	}

/* ------ start tax indicator master ------ */

	public function TaxIndicator(Request $request){

    	$title = 'Add Master Item';

    	$compName 	= $request->session()->get('company_name');

    	$data['help_tax_ind_list'] = DB::table('MASTER_TAXIND')->Orderby('TAXIND_CODE', 'desc')->get();
    	
	    if(isset($compName)){

	    	return view('admin.finance.master.indirectTax.tax_indicator_form',$data+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

    }

    public function TaxIndicatorSave(Request $request){

    	$validate = $this->validate($request,[

			'tax_ind_code'      => 'required|max:4|unique:MASTER_TAXIND,TAXIND_CODE',
			'tax_ind_name'      => 'required|max:40',

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"TAXIND_CODE" => $request->input('tax_ind_code'),
			"TAXIND_NAME" => $request->input('tax_ind_name'),
			"CREATED_BY"   => $createdBy,
			
		);

		$saveData = DB::table('MASTER_TAXIND')->insert($data);

		$discriptn_page = "Master tax indicator insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Tax Indicator Was Successfully Added...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast');

		} else {

			$request->session()->flash('alert-error', 'Tax Indicator Can Not Added...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast');

		}
    	
    }


    public function TaxIndicatorView(Request $request){

   		$compName = $request->session()->get('company_name');

	    if($request->ajax()) {

	    	$title = 'View Master Tax Indicator';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    		$data = DB::table('MASTER_TAXIND')->orderBy('TAXIND_CODE','DESC');
	    	
	    	}elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_TAXIND')->orderBy('TAXIND_CODE','DESC');
	    	}
	    	

	   		return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
					
				})->toJson();

	    }

	    if(isset($compName)){
    		return view('admin.finance.master.indirectTax.view_tax_indicator_form');
	    }else{
			return redirect('/useractivity');
	   }
    }


    public function EditTaxIndicator($id){

    	$title = 'Edit Master Tax Indicator';

    	//print_r($id);
    	$id = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);


    	if($id!=''){
    	    $query = DB::table('MASTER_TAXIND');
			$query->where('TAXIND_CODE', $id);
			$userData['tax_ind_list'] = $query->get()->first();

			return view('admin.finance.master.indirectTax.edit_tax_indicator', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Item-Id Not Found...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast');
		}

    }

    public function TaxIndicatorUpdate(Request $request){

    	$validate = $this->validate($request, [

			'tax_ind_code'      => 'required|max:4',
			'tax_ind_name'      => 'required|max:40',

		]);

		$TaxIndId=$request->input('updateTaxIndId');
		//print_r($request->post());exit;
		$compName = $request->session()->get('company_name');

	    $fisYear =  $request->session()->get('macc_year');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

		$lastUpdatedBy = $request->session()->get('userid');
		 

		$data = array(
			"TAXIND_CODE"      => $request->input('tax_ind_code'),
			"TAXIND_NAME"      => $request->input('tax_ind_name'),
			"TAXIND_BLOCK"     => $request->input('tax_ind_block'),
			"LAST_UPDATE_BY"   => $lastUpdatedBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);
		
		try{
			$saveData = DB::table('MASTER_TAXIND')->where('TAXIND_CODE', $TaxIndId)->update($data);

			$discriptn_page = "Master tax indicator update done by user";
			$this->userLogInsert($lastUpdatedBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Tax Indicator Was Successfully Updated...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast');

			} else {

				$request->session()->flash('alert-error', 'Tax Indicator Can Not Updated...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Tax Indicator Not Be Updated...! Used In Another Transaction...!');
					return redirect('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast');
			}
    }


    public function DeleteTaxIndicator(Request $request){

        $id = $request->input('taxindelete');
        if ($id!='') {
        	try{

			$Delete = DB::table('MASTER_TAXIND')->where('TAXIND_CODE', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Tax Indicator Data Was Deleted Successfully...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast');

			} else {

			$request->session()->flash('alert-error', 'Tax Indicator Data Can Not Deleted...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast');

			}
		}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Tax Indicator Not Be Deleted...! Used In Another Transaction...!');
					return redirect('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast');
			}


		}else{

		$request->session()->flash('alert-error', 'Tax Indicator Data Not Found...!');
		return redirect('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast');

		}
	}

/* ------- end tax indicator master ------ */

/* ------- start tax master ---------- */

	public function Tax(Request $request){

		$title = 'Add Master Tax';

		$compName 	= $request->session()->get('company_name');

		$taxData['help_tax_list'] = DB::table('MASTER_TAX')->Orderby('TAX_CODE', 'desc')->limit(5)->get();

		if(isset($compName)){

	    	return view('admin.finance.master.indirectTax.tax',$taxData+compact('title'));
	    }else{

			return redirect('/useractivity');
		}
	
	}

	public function SaveTax(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$loginuser = $request->session()->get('userid');


		$validate = $this->validate($request, [

				'tax_code' => 'required|max:6|unique:MASTER_TAX,TAX_CODE',
				'tax_name' => 'required|max:40',
				'tax_type' => 'required|max:12',

		]);

		$data = array(
					"TAX_CODE"    =>  $request->input('tax_code'),
					"TAX_NAME"    =>  $request->input('tax_name'),
					"TAX_TYPE"    =>  $request->input('tax_type'),
					"CREATED_BY"  =>  $request->session()->get('userid')
	 
	    	);

		$saveData = DB::table('MASTER_TAX')->insert($data);

		$discriptn_page = "Master tax insert done by user";
			$this->userLogInsert($loginuser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Tax Was Successfully Added...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tax-Mast');

			} else {

				$request->session()->flash('alert-error', 'Tax Can Not Added...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tax-Mast');

			}

	}

	public function ViewTax(Request $request){

    	$compName = $request->session()->get('company_name');

		if($request->ajax()) {
       		$title = 'View Master Transaction';

    		$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 	$data = DB::table('MASTER_TAX')->orderBy('TAX_CODE','DESC');
	    	}
    		elseif ($userType=='superAdmin' || $userType=='user') {

    			$data = DB::table('MASTER_TAX')->orderBy('TAX_CODE','DESC');
	    	}
	    	else{
	    		$data='';
	    	}

    		return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}
	    if(isset($compName)){

	    	return view('admin.finance.master.indirectTax.view_tax');
	    }else{

			return redirect('/useractivity');
		}

    }

    public function DeleteTax(Request $request){

        $id = $request->input('id');
        //print_r($id);exit;
        if ($id!='') {

       try
		{

			$Delete = DB::table('MASTER_TAX')->where('TAX_CODE', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Tax Data Was Deleted Successfully...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Mast');

			} else {

			$request->session()->flash('alert-error', 'Tax Data Can Not Deleted...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Tax Cannot be be Deleted...! Used In Another Transaction...!');
					return redirect('/Master/InDirect-Direct-Tax/View-Tax-Mast');
			}

		}else{

		$request->session()->flash('alert-error', 'Tax Data Not Found...!');
		return redirect('/Master/InDirect-Direct-Tax/View-Tax-Mast');

		}
	}

	public function EditTax($id){

    	$title = 'Edit Tax';
    	
    	$id = base64_decode($id);
    	
    	if($id!=''){
    	    $query = DB::table('MASTER_TAX');
			$query->where('TAX_CODE', $id);
			$userData['tax_list'] = $query->get()->first();


			return view('admin.finance.master.indirectTax.edit_tax', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Tax Id Not Found...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Mast');
		}

    }


    public function UpdateTax(Request $request){

		$validate = $this->validate($request, [
				
				'tax_code' => 'required|max:6',
				'tax_name' => 'required|max:40',
				'tax_type' => 'required|max:12',
		]);

        $id = $request->input('tax_id');
        $updatedDate = date("Y-m-d H:i:s");
        $loginuser  = $request->session()->get('userid');

		$data = array(
					"TAX_CODE"         =>  $request->input('tax_code'),
					"TAX_NAME"         =>  $request->input('tax_name'),
					"TAX_TYPE"         =>  $request->input('tax_type'),
					"TAX_BLOCK"        =>  $request->input('tax_block'),
					"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
					"LAST_UPDATE_DATE" =>  $updatedDate
	 
	    	);

		try
		{

			$saveData = DB::table('MASTER_TAX')->where('TAX_CODE', $id)->update($data);

			$discriptn_page = "Master tax update done by user";
			$this->userLogInsert($loginuser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Tax Was Successfully Updated...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tax-Mast');

			} else {

				$request->session()->flash('alert-error', 'Tax Can Not Updated...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tax-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Tax Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/InDirect-Direct-Tax/View-Tax-Mast');
			}


	}

	public function search_TaxCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$tax_code = $request->input('tax_code');

	    	$tax_list = DB::select("SELECT * FROM `MASTER_TAX` WHERE TAX_CODE LIKE '$tax_code%'");

	    	$count = count($tax_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $tax_list ;

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

   	public function HelpTaxCodeSearch(Request $request){

		$response_array = array();

	    $tax_code_help = $request->input('HelptaxCode');

		if ($request->ajax()) {

	    	$Seach_tax_Code_by_help = DB::select("SELECT * FROM `MASTER_TAX` WHERE TAX_CODE='$tax_code_help' OR TAX_NAME='$tax_code_help' OR TAX_CODE Like '$tax_code_help%' OR TAX_NAME LIKE '$tax_code_help%' ORDER BY TAX_CODE DESC limit 5  ");
	    	
    		if ($Seach_tax_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_tax_Code_by_help;

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

/* ------- end tax master ---------- */

/* --------- start tax rate master --------*/

	public function TaxRate(Request $request){

		$tran_code    = $request->old('trans_code');
		$series_code  = $request->old('series_code');
		$series_name  = $request->old('series_name');
		$gl_code      = $request->old('gl_code');
		
		$compName   = $request->session()->get('company_name');

		$transData['tax_list'] = DB::table('MASTER_TAX')->get();

		$transData['gl_list'] = DB::table('MASTER_GL')->get();

		$transData['rate_list'] = DB::table('MASTER_RATE_VALUE')->get();

		$transData['tax_ind_list'] = DB::table('MASTER_TAXIND')->get();

		$transData['gl_code_list'] = DB::table('MASTER_GL')->get();

		if(isset($compName)){

    	return view('admin.finance.master.indirectTax.tax_rate_form',$transData+compact('tran_code','series_code','series_name','gl_code'));

	    }else{

			return redirect('/useractivity');
		}

    }

    public function TaxRateSave(Request $request){
        
			$validate    = $this->validate($request, [
			
			'tax_code'   => 'required|max:6|unique:MASTER_TAXRATE,TAX_CODE',
			]);
			
			$createdBy   = $request->session()->get('userid');
			$compName    = $request->session()->get('company_name');
			$fisYear     =  $request->session()->get('macc_year');
			
			$headC       = $request->input('amthead');
			
			$FilterArray = array_filter($headC);
			
			$HeadCount   = count($FilterArray);


			$saveData     = '';
			
			$tax_code     = $request->input('tax_code');
			$tax_name     = $request->input('tax_name');
			$amthead      = $request->input('amthead');
			$headName      = $request->input('HeadName');
			$afratei      = $request->input('afratei');
			$aflogic      = $request->input('aflogic');
			$afrate       = $request->input('afrate');
			$ToDate       = $request->input('ToDate');
			$FromDate     = $request->input('FromDate');
			$afgl_code    = $request->input('afgl_code');
			$afgl_name    = $request->input('afgl_name');
			$statici      = $request->input('statici');
			$static_ind   = $request->input('static_ind');
			
			$data1        = array(
			"TAX_CODE"    =>  $tax_code,
			"TAX_NAME"    =>  $tax_name,
			"TAXIND_CODE" =>  $request->input('amthead1'),
			"TAXIND_NAME" =>  $request->input('HeadName1'),
			"SRNO"        =>  1,
			"RATE_INDEX"  =>  NULL,
			"TAX_RATE"    =>  NULL,
			"TAX_LOGIC"   =>  NULL,
			"TAX_GL_CODE" =>  NULL,
			"TAX_GL_NAME" =>  NULL,
			"STATIC_IND"  =>  $request->input('static_ind_bs'),
			"FROM_DATE"   =>  NULL,
			"TO_DATE"     =>  NULL,
			"CREATED_BY"  =>  $createdBy
			);

			// echo '<PRE>';print_r($data1);exit();

	    $saveData1 = DB::table('MASTER_TAXRATE')->insert($data1);


      	for ($i = 0; $i < $HeadCount; $i++) {
					$srn          = $i+2;

					if($ToDate[$i] !=''){
						$GetToDt      = date('Y-m-d', strtotime($ToDate[$i]));
					}else{
						$GetToDt      = '';
					}

					if($FromDate[$i] != ''){
						$GetFromDt    = date('Y-m-d', strtotime($FromDate[$i]));
					}else{
						$GetFromDt    = '';
					}
					
					
					
					$data         = array(
					"TAX_CODE"    =>  $tax_code,
					"TAX_NAME"    =>  $tax_name,
					"SRNO"        =>  $srn,
					"TAXIND_CODE" =>  $amthead[$i],
					"TAXIND_NAME" =>  $headName[$i],
					"RATE_INDEX"  =>  $afratei[$i],
					"TAX_LOGIC"   =>  $aflogic[$i],
					"TAX_RATE"    =>  $afrate[$i],
					"TAX_GL_CODE" =>  $afgl_code[$i],
					"TAX_GL_NAME" =>  $afgl_name[$i],
					"STATIC_IND"  =>  $statici[$i],
					"FROM_DATE"   =>  $GetFromDt,
					"TO_DATE"     =>  $GetToDt,
					"CREATED_BY"  =>  $createdBy
					
					);	
			    //echo "<PRE>";
				// echo '<PRE>';print_r($data);
			$saveData = DB::table('MASTER_TAXRATE')->insert($data);

      		
      	}
       // print_r('exit');exit();
      	$discriptn_page = "Master tax rate insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Tax Was Successfully Added...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Rate-Mast');

		} else {

			$request->session()->flash('alert-error', 'Tax Can Not Added...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Rate-Mast');

		}
    }

    public function ViewTaxRate(Request $request){

    	$CompanyCode   = $request->session()->get('company_name');

    	if($request->ajax()) {

	    	$user_type = $request->session()->get('user_type');

			$userid = $request->session()->get('userid');

			$CompanyCode   = $request->session()->get('company_name');

			$macc_year   = $request->session()->get('macc_year');

			if($user_type == 'admin'){
	    	//	DB::enableQueryLog();
	       	 	$data = DB::table('MASTER_TAXRATE')
	            ->join('MASTER_TAXIND', 'MASTER_TAXRATE.TAXIND_CODE', '=', 'MASTER_TAXIND.TAXIND_CODE')
	            ->join('MASTER_TAX', 'MASTER_TAXRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
	            ->select('MASTER_TAXRATE.*', 'MASTER_TAX.TAX_NAME','MASTER_TAXIND.TAXIND_NAME')
	            ->groupBy('MASTER_TAXRATE.TAX_CODE')
	            ->get()->toArray();
	           // dd(DB::getQueryLog());
    		}else if($user_type == 'superAdmin' || $user_type == 'user'){

	    	 $data = DB::table('MASTER_TAXRATE')
	            ->join('MASTER_TAXIND', 'MASTER_TAXRATE.TAXIND_CODE', '=', 'MASTER_TAXIND.TAXIND_CODE')
	            ->join('MASTER_TAX', 'MASTER_TAXRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
	            ->select('MASTER_TAXRATE.*', 'MASTER_TAX.TAX_NAME','MASTER_TAXIND.TAXIND_NAME')
	            ->groupBy('MASTER_TAXRATE.TAX_CODE')
	            ->get()->toArray();
    		}else{
    		
    	 		$data ='';
    		}

    		return DataTables()->of($data)->addIndexColumn()->toJson();

       }

       $title = 'View Tax Rate';
       if(isset($CompanyCode)){
       		return view('admin.finance.master.indirectTax.view_tax_rate');
       }else{
			return redirect('/useractivity');
	   }

    }

    public function DeleteTaxRate(Request $request){

	        $id = $request->input('trantaxid');
	        if ($id!='') {

				$Delete = DB::table('MASTER_TAXRATE')->where('tax_code', $id)->delete();

				if ($Delete) {

				$request->session()->flash('alert-success', 'Tax Rate Data Was Deleted Successfully...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tax-Rate-Mast');

				} else {

				$request->session()->flash('alert-error', 'Tax Rate Data Can Not Deleted...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tax-Rate-Mast');

				}

			}else{

			$request->session()->flash('alert-error', 'Tran Tax Data Not Found...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Rate-Mast');

			}
	}

    public function EditTaxRate($vr_tax_rate){

    	$vr_tax_rate = base64_decode($vr_tax_rate);
    	//print_r($vr_tax_rate);exit();
    	
    	if($vr_tax_rate!=''){

    	    $dData['tran_tax_data'] = DB::table('MASTER_TAXRATE')->where('TAX_CODE', $vr_tax_rate)->get();
    	  
    	   $dData['tax_code_lists'] = DB::table('MASTER_TAXRATE')->where('TAX_CODE', $vr_tax_rate)->get()->first();

    	    $dData['tax_code_indicator'] = DB::table('MASTER_TAXRATE')->where('TAX_CODE', $vr_tax_rate)->where('TAXIND_CODE', '!=', 'B01')->get();
			
			$transData['trans_list'] = DB::table('MASTER_TRANSACTION')->get();
			$transData['tax_list'] = DB::table('MASTER_TAX')->get();

			$transData['config_list'] = DB::table('MASTER_CONFIG')->get();

			$transData['gl_list'] = DB::table('MASTER_GL')->get();

			$transData['rate_list'] = DB::table('MASTER_RATE_VALUE')->get();

			$transData['tax_ind_list'] = DB::table('MASTER_TAXIND')->get();

			$transData['gl_code_list'] = DB::table('MASTER_GL')->get();

			return view('admin.finance.master.indirectTax.edit_tax_rate',$transData+$dData);
			
		}else{
			$request->session()->flash('alert-error', 'Tax Code Not Found...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Rate-Mast');
		}

	}


	public function UpdateTaxRate(Request $request){

		
		$validate = $this->validate($request, [

			'tax_code'  => 'required',
		]);
        
      	$createdBy  = $request->session()->get('userid');
      	$compName   = $request->session()->get('company_name');
      	$fisYear  =  $request->session()->get('macc_year');

      	$saveData = '';

		$tax_code      = $request->input('tax_code');
		$tax_name      = $request->input('tax_name');
		$amthead       = $request->input('amthead');
		$headName       = $request->input('headName');
		$amthead1      = $request->input('amthead1');
		$afratei       = $request->input('afratei');
		$aflogic       = $request->input('aflogic');
		$afrate        = $request->input('afrate');
		$ToDate        = $request->input('ToDate');
		$FromDate      = $request->input('FromDate');
		$afgl_code     = $request->input('afgl_code');
		$gl_Name       = $request->input('glName');
		$statici       = $request->input('statici');
		$vr_tax_rate   = $request->input('vr_tax_rate');
		$amthiddenhead = $request->input('amthiddenhead');
		$FilterArray = array_filter($amthead);
      	$HeadCount = count($FilterArray);

		$alreadytax = DB::table('MASTER_TAXRATE')->where('TAX_CODE',$tax_code)->get()->toArray();
		$rowCount   = count($alreadytax);
		$taxRowCount = $HeadCount + 1;
		$UpdateData ='';
		$saveData ='';

		DB::table('MASTER_TAXRATE')->where('TAX_CODE',$vr_tax_rate)->delete();

      		$data1 = array(
				"TAX_CODE"    =>  $tax_code,
				"TAX_Name"    =>  $tax_name,
				"TAXIND_CODE" =>  $request->input('amthead1'),
				"SRNO"        =>  1,
				"RATE_INDEX"  =>  NULL,
				"TAX_RATE"    =>  NULL,
				"TAX_LOGIC"   =>  NULL,
				"TAX_GL_CODE" =>  NULL,
				"STATIC_IND"  =>  $request->input('static_ind_bs'),
				"FROM_DATE"   =>  NULL,
				"TO_DATE"     =>  NULL,
				"CREATED_BY"  =>  $createdBy
	    	);

	    	$saveData1 = DB::table('MASTER_TAXRATE')->insert($data1);

	    	for ($j = 0; $j < $HeadCount; $j++) {
	      		$srn = $j+2;

	      		if($ToDate[$j]){
	      			$GetToDt = date('Y-m-d', strtotime($ToDate[$j]));
	      		}else{
	      			$GetToDt = '';
	      		}
	      		

	      		if($FromDate[$j]){
	      			$GetFromDt = date('Y-m-d', strtotime($FromDate[$j]));
	      		}else{
	      			$GetFromDt = '';
	      		}
	      		

	      			$data = array(
						"TAX_CODE"    =>  $tax_code,
						"TAX_NAME"    =>  $tax_name,
						"SRNO"        =>  $srn,
						"TAXIND_CODE" =>  $amthead[$j],
						"TAXIND_NAME" =>  $headName[$j],
						"RATE_INDEX"  =>  $afratei[$j],
						"TAX_LOGIC"   =>  $aflogic[$j],
						"TAX_RATE"    =>  $afrate[$j],
						"TAX_GL_CODE" =>  $afgl_code[$j],
						"TAX_GL_NAME" =>  $gl_Name[$j],
						"STATIC_IND"  =>  $statici[$j],
						"FROM_DATE"   =>  $GetFromDt,
						"TO_DATE"     =>  $GetToDt,
						"CREATED_BY"  =>  $createdBy
				 
				    );	
				$saveData = DB::table('MASTER_TAXRATE')->insert($data);

	      			echo '<PRE>';print_r($data);


      		}

      		// print_r('exit');exit;

		$discriptn_page = "Master tax rate update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Tax Rate Was Successfully Updated...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Rate-Mast');

		} else {

			$request->session()->flash('alert-error', 'Tax Rate Can Not Updated...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tax-Rate-Mast');

		}
		/*$data1 = array(	
			"TAX_CODE"     =>  $tax_code,
			"TAXIND_CODE" =>  $request->input('amthead1'),
			"RATE_INDEX"   =>  NULL,
			"tax_logic"    =>  NULL,
			"tax_rate"     =>  NULL,
			"to_date"      =>  NULL,
			"from_date"    =>  NULL,
			"tax_gl_code"  =>  NULL,
			"static"       =>  NULL,
			"flag"         =>  0,
			"created_by"   =>  $createdBy
	    );*/

	   
	    /*$saveData = DB::table('master_tax_rate')->where('tax_ind_code', $amthead1)->where('vr_tax_rate', $vr_tax_rate)->update($data1);

	    
      	for ($i = 0; $i < $HeadCount; $i++) {

      		$GetToDt = date('Y-m-d', strtotime($ToDate[$i]));
      		$GetFromDt = date('Y-m-d', strtotime($FromDate[$i]));

      			$data = array(
					"comp_name"    =>  $compName,
					"fiscal_year"  =>  $fisYear,
					"tax_code"     =>  $tax_code,
					"tax_ind_code" =>  $amthead[$i],
					"rate_index"   =>  $afratei[$i],
					"tax_logic"    =>  $aflogic[$i],
					"tax_rate"     =>  $afrate[$i],
					"to_date"      =>  $GetToDt,
					"from_date"    =>  $GetFromDt,
					"tax_gl_code"  =>  $afgl_code[$i],
					"static"       =>  $statici[$i],
					"flag"         =>  0,
					"created_by"   =>  $createdBy
			 
			    );

			 $UpdateData = DB::table('master_tax_rate')->where('tax_ind_code',$amthiddenhead[$i])->where('tax_code', $tax_code)->where('vr_tax_rate', $vr_tax_rate)->update($data);

      		
      	}
*/
		/*if ($UpdateData) {

			$request->session()->flash('alert-success', 'Tax Rate Was Successfully Updated...!');
			return redirect('/finance/view-tax-rate-master');

		} else {

			$request->session()->flash('alert-error', 'Tax Rate Can Not Updated...!');
			return redirect('/finance/view-tax-rate-master');

		}*/


	}


	public function GetTaxIndicatorDetail(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$taxInd = $request->input('taxInd');

	    	$taxIndData = DB::table('MASTER_TAXIND')->where('TAXIND_CODE', $taxInd)->get();

    		if ($taxIndData) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $taxIndData;

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

/* --------- end tax rate master --------*/

/* ------- start TDS master ----------*/

	public function AddTDS(Request $request){

		$title = 'Add TDS';

		$compName 	= $request->session()->get('company_name');

		$tds_code         = $request->old('tds_code');
		$tds_name         = $request->old('tds_name');
		$tds_rate         = $request->old('tds_rate');
		$surcharge_rate   = $request->old('surcharge_rate');
		$surchargegl_code = $request->old('surchargegl_code');
		$cess_rate        = $request->old('cess_rate');
		$cessgl_code      = $request->old('cessgl_code');
		$form_no          = $request->old('form_no');
		$gl_code          = $request->old('gl_code');
		$tds_section      = $request->old('tds_section');
		$from_date        = $request->old('from_date');
		$to_date          = $request->old('to_date');
		$tds_id           = $request->old('id');
		$tds_block        = $request->old('tds_block');

		$glData['tds_code_list'] = DB::table('MASTER_TDS')->Orderby('TDS_CODE', 'desc')->limit(5)->get();

		$button='Save';

    	$action='/Master/InDirect-Direct-Tax/Tds-Save';

    	$glData['gl_list'] = DB::table('MASTER_GL')->get();
	
		if(isset($compName)){

	    	return view('admin.finance.master.indirectTax.tds_mast',$glData+compact('title','tds_code','tds_name','tds_rate','surcharge_rate','surchargegl_code','cess_rate','cessgl_code','form_no','gl_code','tds_section','from_date','to_date','tds_id','tds_block','action','button'));

	    }else{

			return redirect('/useractivity');
		}

	}

	public function SaveTDS(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$fromDate = $request->input('from_date');

    	$loginuser = $request->session()->get('userid');

    	$from_date = date("Y-m-d", strtotime($fromDate));

    	$toDate = $request->input('to_date');

    	$to_date = date("Y-m-d", strtotime($toDate));


		$validate = $this->validate($request, [

				'tds_code'         => 'required|max:6|unique:MASTER_TDS,TDS_CODE',
				'tds_name'         => 'required|max:40',
				'tds_section'      => 'required|max:6',
				'tds_rate'         => 'required',
				'gl_code'          => 'required|max:6',
				'surcharge_rate'   => 'required',
				// 'surchargegl_code' => 'required|max:6',
				// 'cess_rate'        => 'required',
				// 'cessgl_code'      => 'required|max:6',
				// 'form_no'          => 'required|max:10',
				// 'from_date'        => 'required',
				

		]);


		$data = array(
				"TDS_CODE"      =>  $request->input('tds_code'),
				"TDS_NAME"      =>  $request->input('tds_name'),
				"TDS_SECTION"   =>  $request->input('tds_section'),
				"TDS_RATE"      =>  $request->input('tds_rate'),
				"gl_code"       =>  $request->input('gl_code'),
				"SURCHG_RATE"   =>  $request->input('surcharge_rate'),
				"SURCHGGL_CODE" =>  $request->input('surchargegl_code'),
				"CESS_RATE"     =>  $request->input('cess_rate'),
				"CESSGL_CODE"   =>  $request->input('cessgl_code'),
				"FORM_NO"       =>  $request->input('form_no'),
				"FROM_DATE"     =>  $from_date,
				"TO_DATE"       =>  $to_date,
				"CREATED_BY"    =>  $request->session()->get('userid')
	    	);

		$saveData = DB::table('MASTER_TDS')->insert($data);

		$discriptn_page = "Master TDS insert done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'TDS Was Successfully Added...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tds-Mast');

		} else {

			$request->session()->flash('alert-error', 'TDS Can Not Added...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tds-Mast');

		}

	}


	public function ViewTDS(Request $request){
		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	        $title = 'View Item Group';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 $data = DB::table('MASTER_TDS')->orderBy('TDS_CODE','DESC');

	    	}
	    	elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data  = DB::table('MASTER_TDS')->orderBy('TDS_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	 return DataTables()->of($data)->addIndexColumn()->toJson();


		    }

		    if(isset($compName)){
		    	return view('admin.finance.master.indirectTax.view_tds_mast');
		    }else{
				return redirect('/useractivity');
			}

    }

    public function DeleteTDS(Request $request){

        $id = $request->input('tdsid');
        if ($id!='') {
			try{
				$Delete = DB::table('MASTER_TDS')->where('TDS_CODE', $id)->delete();

				if ($Delete) {

				$request->session()->flash('alert-success', 'TDS Data Was Deleted Successfully...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tds-Mast');

				} else {

				$request->session()->flash('alert-error', 'TDS Data Can Not Deleted...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tds-Mast');

				}
			}
			catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'TDS Data be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/InDirect-Direct-Tax/View-Tds-Mast');
			}

		}else{

			$request->session()->flash('alert-error', 'TDS Data Not Found...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tds-Mast');

		}
	}


	public function EditTDS($id){

    	$title = 'Edit TDS Master';

    	//print_r($id);
    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('MASTER_TDS');
			$query->where('TDS_CODE', $id);
			$classData= $query->get()->first();

			$tds_code         = $classData->TDS_CODE;
			$tds_name         = $classData->TDS_NAME;
			$tds_section      = $classData->TDS_SECTION;
			$tds_rate         = $classData->TDS_RATE;
			$gl_code          = $classData->GL_CODE;
			$surcharge_rate   = $classData->SURCHG_RATE;
			$surchargegl_code = $classData->SURCHGGL_CODE;
			$cess_rate        = $classData->CESS_RATE;
			$cessgl_code      = $classData->CESSGL_CODE;
			$form_no          = $classData->FORM_NO;
			$from_date        = $classData->FROM_DATE;
			$to_date          = $classData->TO_DATE;
			$tds_id           = $classData->TDS_CODE;
			$tds_block        = $classData->TDS_BLOCK;

			$button='Update';
			$action='/Master/InDirect-Direct-Tax/Tds-Update';

			$glData['gl_list'] = DB::table('MASTER_GL')->get();

			return view('admin.finance.master.indirectTax.tds_mast',$glData+compact('title','tds_code','tds_name','tds_rate','surcharge_rate','surchargegl_code','cess_rate','cessgl_code','form_no','from_date','to_date','gl_code','tds_section','tds_id','tds_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Category Not Found...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tds-Mast');
		}

    }


    public function UpdateTDS(Request $request){

    	$fromDate = $request->input('from_date');

    	$from_date = date("Y-m-d", strtotime($fromDate));

    	$toDate = $request->input('to_date');

    	$to_date = date("Y-m-d", strtotime($toDate));

    	$loginuser = $request->session()->get('userid');


		$validate = $this->validate($request, [

			'tds_code'         => 'required|max:6',
			'tds_name'         => 'required|max:40',
			'tds_section'      => 'required|max:6',
			'tds_rate'         => 'required',
			'gl_code'          => 'required|max:6',
			'surcharge_rate'   => 'required',
			// 'surchargegl_code' => 'required|max:6',
			// 'cess_rate'        => 'required',
			// 'cessgl_code'      => 'required|max:6',
			// 'form_no'          => 'required|max:10',
			// 'from_date'        => 'required',
				
		]);

        $id = $request->input('idtds');
        $updatedDate = date("Y-m-d H:i:s");

		$data = array(
				"TDS_CODE"         =>  $request->input('tds_code'),
				"TDS_NAME"         =>  $request->input('tds_name'),
				"TDS_SECTION"      =>  $request->input('tds_section'),
				"TDS_RATE"         =>  $request->input('tds_rate'),
				"GL_CODE"          =>  $request->input('gl_code'),
				"SURCHG_RATE"      =>  $request->input('surcharge_rate'),
				"SURCHGGL_CODE"    =>  $request->input('surchargegl_code'),
				"CESS_RATE"        =>  $request->input('cess_rate'),
				"CESSGL_CODE"      =>  $request->input('cessgl_code'),
				"FORM_NO"          =>  $request->input('form_no'),
				"FROM_DATE"        =>  $from_date,
				"TO_DATE"          =>  $to_date,
				"TDS_BLOCK"        =>  $request->input('tds_block'),
				"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
				"LAST_UPDATE_DATE" =>  $updatedDate
	 
	    	);

		try{

			$saveData = DB::table('MASTER_TDS')->where('TDS_CODE', $id)->update($data);

			$discriptn_page = "Master TDS update done by user";
			$this->userLogInsert($loginuser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'TDS Data Was Successfully Updated...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tds-Mast');

			} else {

				$request->session()->flash('alert-error', 'TDS Data Can Not Updated...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tds-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'TDS Data be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/InDirect-Direct-Tax/View-Tds-Mast');
			}


	}

/*search TDS code when click on help button*/
	
	public function HelpTDSCodeGet(Request $request){

		$response_array = array();

	    $tdsCodeHelp = $request->input('tdsCodeHelp');

		if ($request->ajax()) {

	    	$tds_code_by_help = DB::select("SELECT * FROM `MASTER_TDS` WHERE TDS_CODE='$tdsCodeHelp' OR TDS_NAME='$tdsCodeHelp' OR TDS_CODE Like '$tdsCodeHelp%' OR TDS_NAME LIKE '$tdsCodeHelp%' ORDER BY TDS_CODE DESC limit 5  ");
	    	
    		if ($tds_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $tds_code_by_help ;

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

/*search TDS code code when click on help button*/


/*search TDS code code on input*/

	public function search_TdsCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$TdsCodeSearch = $request->input('TdsCodeSearch');

	    	$tdsCode_list = DB::select("SELECT * FROM `MASTER_TDS` WHERE TDS_CODE LIKE '$TdsCodeSearch%'");

	    	$count = count($tdsCode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $tdsCode_list ;

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

/*search TDS code code on input*/

/* ------- end TDS master ----------*/

/* ------ start tds rate master ------ */

	public function TDSRate(Request $request){

		$title      = 'Add TDS Rate';
		
		$compName   = $request->session()->get('company_name');
		
		$tds_code   = $request->old('tds_code');
		$acc_code   = $request->old('acc_code');
		$tds_rate   = $request->old('tds_rate');
		$from_date  = $request->old('from_date');
		
		$to_date    = $request->old('to_date');
		$tdsrate_id = $request->old('tdsrateid');
		$button     ='Save';

    	$action='/Master/InDirect-Direct-Tax/Tds-Rate-Save';

    	$userdata['tds_list'] = DB::table('MASTER_TDS')->get();
    	$userdata['acc_list'] = DB::table('MASTER_ACC')->get();

		if(isset($compName)){

	    	return view('admin.finance.master.indirectTax.tds_rate_mast',$userdata+compact('title','tds_code','acc_code','from_date','to_date','tds_rate','tdsrate_id','action','button'));

	    }else{

			return redirect('/useractivity');
		}

	}


	public function SaveTDSRate(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$loginuser = $request->session()->get('userid');

    	$fromDate = $request->input('from_date');

    	$from_date = date("Y-m-d", strtotime($fromDate));

    	$toDate = $request->input('to_date');

    	$to_date = date("Y-m-d", strtotime($toDate));

		$validate = $this->validate($request, [

				'tds_code'  => 'required|max:6|unique:MASTER_TDS_RATE,TDS_CODE',

				'tds_rate'  => 'required',
				// 'acc_code'  => 'required|max:6',
				'from_date' => 'required|unique:MASTER_TDS_RATE,FROM_DATE',
		]);

		$data = array(
					"TDS_CODE"   =>  $request->input('tds_code'),
					"TDS_RATE"   =>  $request->input('tds_rate'),
					"ACC_CODE"   =>  $request->input('acc_code'),
					"FROM_DATE"  =>  $from_date,
					"TO_DATE"    =>  $to_date,
					"CREATED_BY" =>  $request->session()->get('userid')
	    	);

		$saveData = DB::table('MASTER_TDS_RATE')->insert($data);

		$discriptn_page = "Master TDS rate insert done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'TDS Rate Was Successfully Added...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast');

		} else {

			$request->session()->flash('alert-error', 'TDS Rate Can Not Added...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast');

		}

	}

	public function ViewTDSRate(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()){

	        $title = 'View TDS Rate Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    	$data = DB::table('MASTER_TDS_RATE')->orderBy('TDS_CODE','DESC');

	    	//print_r($valData['val_list']);exit;
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_TDS_RATE')->orderBy('TDS_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

    		return DataTables()->of($data)->addIndexColumn()->toJson();
		}

		if(isset($compName)){
	    	return view('admin.finance.master.indirectTax.view_tds_rate_mast');
		}else{
			 return redirect('/useractivity');
		}

    }


    public function DeleteTDSRate(Request $request){

        $id = $request->input('tdsrateid');

        
        if ($id!='') {

			$Delete = DB::table('MASTER_TDS_RATE')->where('TDS_CODE',$id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'TDS Rate Data Was Deleted Successfully...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast');

			} else {

			$request->session()->flash('alert-error', 'TDS Rate Data Can Not Deleted...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast');

			}

		}else{

		$request->session()->flash('alert-error', 'TDS Rate Data Not Found...!');
		return redirect('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast');

		}
	}

	public function EditTDSRate($id){

    	$title = 'Edit TDS Rate';

    	$id = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);

    	if($id!=''){
    	    $query = DB::table('MASTER_TDS_RATE');
			$query->where('TDS_CODE', $id);
			$classData= $query->get()->first();
			
			$tds_code      = $classData->TDS_CODE;
			$tds_rate      = $classData->TDS_RATE;
			$acc_code      = $classData->ACC_CODE;
			$from_date     = $classData->FROM_DATE;
			$to_date       = $classData->TO_DATE;
			$tdsrate_block = $classData->TDS_RATE_BLOCK;
			$tdsrate_id    = $classData->TDS_CODE;

			$button='Update';
			$action='/Master/InDirect-Direct-Tax/Tds-Rate-Update';

			$userdata['tds_list'] = DB::table('MASTER_TDS')->get();

    		$userdata['acc_list'] = DB::table('MASTER_ACC')->get();

			return view('admin.finance.master.indirectTax.tds_rate_mast',$userdata+compact('title','tds_code','acc_code','tds_rate','from_date','to_date','tdsrate_block','tdsrate_id','button','action'));
		}else{
			$request->session()->flash('alert-error', 'TDS Rate Not Found...!');
			return redirect('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast');
		}

    }


    public function UpdateTDSRate(Request $request){

    	$fromDate = $request->input('from_date');

    	$from_date = date("Y-m-d", strtotime($fromDate));

    	$toDate = $request->input('to_date');

    	$to_date = date("Y-m-d", strtotime($toDate));

    	$loginuser = $request->session()->get('userid');

		$validate = $this->validate($request, [

				'tds_code'  => 'required|max:6',
				// 'acc_code'  => 'required|max:6',
				'tds_rate'  => 'required',		
				'from_date' => 'required',		
		]);

       $id = $request->input('idtds');

       $updatedDate = date("Y-m-d H:i:s");

		$data = array(
				"TDS_CODE"        =>  $request->input('tds_code'),
				"TDS_RATE"        =>  $request->input('tds_rate'),
				"ACC_CODE"        =>  $request->input('acc_code'),
				"FROM_DATE"       =>  $from_date,
				"TO_DATE"         =>  $to_date,
				"TDS_RATE_BLOCK"  =>  $request->input('tdsrate_block'),
				"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
				"LAST_UPDATE_DATE" =>  $updatedDate
	 
	    	);

		$saveData = DB::table('MASTER_TDS_RATE')->where('TDS_CODE', $id)->update($data);

		$discriptn_page = "Master TDS rate update done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'TDS Rate Was Successfully Updated...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast');

			} else {

				$request->session()->flash('alert-error', 'TDS Rate Can Not Updated...!');
				return redirect('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast');

			}


	}


/* ------ end tds rate master ------ */

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