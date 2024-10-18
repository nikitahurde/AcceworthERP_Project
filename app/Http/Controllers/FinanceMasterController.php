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
class FinanceMasterController extends Controller{

	//public $data;

	public function __construct(Request $request){

		//$this->data = "smit@121";

	}

	public function printindex(){
            $students = DB::table('MASTER_TAX')->get();
            return view('admin.finance.transaction.studentsprint',compact('students'));
    }
	public function prnpriview(){
	    $students = DB::table('MASTER_TAX')->get();
            return view('admin.finance.transaction.printstudent',compact('students'));
	}

	

/*	Tax master start */

	public function Tax(Request $request){

		$title = 'Add Master Tax';

		$compName 	= $request->session()->get('company_name');

//print_r($compName);exit;

		$taxData['help_tax_list'] = DB::table('master_tax')->Orderby('tax_code', 'desc')->limit(5)->get();


	if(isset($compName)){

    	return view('admin.finance.master.tax',$taxData+compact('title'));
    }else{

		return redirect('/useractivity');
	}
	
	}

	public function SaveTax(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$validate = $this->validate($request, [

				'tax_code' => 'required|max:11|unique:master_tax,tax_code',
				'tax_name' => 'required|max:30',
				'tax_type' => 'required|max:12',

		]);

		$taxData = DB::table('master_tax')->orderBy('id', 'DESC')->first();
		
    	if(!empty($taxData)){

    		$getID= $taxData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(
					"id"          =>  $id,
					"tax_code"    =>  $request->input('tax_code'),
					"tax_name"    =>  $request->input('tax_name'),
					"tax_type"    =>  $request->input('tax_type'),
					"created_by"  =>  $request->session()->get('userid'),
					"comp_name"   =>  $compName,
					"fiscal_year" => $fisYear
	 
	    	);

		$saveData = DB::table('master_tax')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Tax Was Successfully Added...!');
				return redirect('/finance/view-tax');

			} else {

				$request->session()->flash('alert-error', 'Tax Can Not Added...!');
				return redirect('/finance/view-tax');

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

    	 $data = DB::table('master_tax')->orderBy('id','DESC');
    	}
    	elseif ($userType=='superAdmin' || $userType=='user') {

    		$data = DB::table('master_tax')->orderBy('id','DESC');
    	}
    	else{
    		$data='';
    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }
    if(isset($compName)){

    	return view('admin.finance.master.view_tax');
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

			$Delete = DB::table('master_tax')->where('tax_code', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Tax Data Was Deleted Successfully...!');
			return redirect('/finance/view-tax');

			} else {

			$request->session()->flash('alert-error', 'Tax Data Can Not Deleted...!');
			return redirect('/finance/view-tax');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Tax Cannot be be Deleted...! Used In Another Transaction...!');
					return redirect('/finance/view-tax');
			}

		}else{

		$request->session()->flash('alert-error', 'Tax Data Not Found...!');
		return redirect('/finance/view-tax');

		}
	}

	public function EditTax($id){

    	$title = 'Edit Tax';

    	//print_r($id);
    	$id = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);


    	if($id!=''){
    	    $query = DB::table('master_tax');
			$query->where('tax_code', $id);
			$userData['tax_list'] = $query->get()->first();


			return view('admin.finance.master.edit_tax', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Tax Id Not Found...!');
			return redirect('/finance/view-tax');
		}

    }


    public function UpdateTax(Request $request){

		
		$validate = $this->validate($request, [
				
				'tax_code' => 'required|max:11',
				'tax_name' => 'required|max:30',
				'tax_type' => 'required|max:12',
		]);

       $id = $request->input('tax_id');
       $updatedDate = date('Y-m-d');

		$data = array(
					"tax_code"        =>  $request->input('tax_code'),
					"tax_name"        =>  $request->input('tax_name'),
					"tax_type"        =>  $request->input('tax_type'),
					"tax_block"       =>  $request->input('tax_block'),
					"last_updat_by"   =>  $request->session()->get('userid'),
					"last_updat_date" =>  $updatedDate
	 
	    	);

try
		{

		$saveData = DB::table('master_tax')->where('tax_code', $id)->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'Tax Was Successfully Updated...!');
				return redirect('/finance/view-tax');

			} else {

				$request->session()->flash('alert-error', 'Tax Can Not Updated...!');
				return redirect('/finance/view-tax');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Tax Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-tax');
			}


	}


/*	Tax master end */




	

	


/* ----- start department master -----*/

	public function DepartmentMaster(Request $request){

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

    public function DepartFormSave(Request $request){
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

		if ($saveData) {

			$request->session()->flash('alert-success', 'Department Was Successfully Added...!');
			return redirect('/Master/other/View-Department-Mast');

		} else {

			$request->session()->flash('alert-error', 'Department Can Not Added...!');
			return redirect('/Master/other/View-Department-Mast');

		}

	}


	public function ViewDepartmentMast(Request $request){

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


    public function EditDepartmentMast($deptcode){

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


    public function DepartmentFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'department_code'  => 'required|max:6',
			'department_name'  => 'required|max:40',
			
		]);

		$deptCode = $request->input('deptId');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

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



	

	public function TaxRateMaster(Request $request){
		
		$tran_code    = $request->old('trans_code');
		$series_code  = $request->old('series_code');
		$series_name  = $request->old('series_name');
		$gl_code      = $request->old('gl_code');
		$config_block = $request->old('config_block');
		$config_id    = $request->old('config_id');

		$compName   = $request->session()->get('company_name');

    	$button='Save';
    	$action='/finance/form-mast-trantax-save';
		//print_r($compData['comp_list']);exit;
		$transData['trans_list'] = DB::table('master_transaction')->get();
		$transData['tax_list'] = DB::table('master_tax')->get();

		$transData['config_list'] = DB::table('master_config')->get();

		$transData['gl_list'] = DB::table('master_gl')->get();

		$transData['rate_list'] = DB::table('rate_value')->get();

		$transData['tax_ind_list'] = DB::table('master_tax_indicator')->get();

		$transData['gl_code_list'] = DB::table('master_gl')->get();

		

		if(isset($compName)){

    	return view('admin.finance.master.tax_rate_form',$transData+compact('tran_code','series_code','series_name','gl_code','config_block','config_id','button','action'));

    }else{

		return redirect('/useractivity');
	}

    }


    public function TaxRateFormSave(Request $request){
        
      	

		$validate = $this->validate($request, [

			'tax_code'  => 'required|unique:master_tax_rate,tax_code',
		]);
        
      	$createdBy  = $request->session()->get('userid');
      	$compName   = $request->session()->get('company_name');
      	$fisYear  =  $request->session()->get('macc_year');

      	$headC = $request->input('amthead');

      	$FilterArray = array_filter($headC);

      	$HeadCount = count($FilterArray);

      	$getData = DB::table('master_tax_rate')->find(DB::table('master_tax_rate')->max('id'));

      	$getVrId = '';
      	if ($getData) {

      	$getVrId = $getData->vr_tax_rate + 1;
      		
      	}else{

      	$getVrId = 1001;

      	}


      	$saveData = '';

		$tax_code    = $request->input('tax_code');
		$amthead     = $request->input('amthead');
		$afratei     = $request->input('afratei');
		$aflogic     = $request->input('aflogic');
		$afrate      = $request->input('afrate');
		$ToDate      = $request->input('ToDate');
		$FromDate    = $request->input('FromDate');
		$afgl_code   = $request->input('afgl_code');
		$statici     = $request->input('statici');
		$static_ind  = $request->input('static_ind');
		$VrTaxTran   = $getVrId;

		$taxtype = DB::table('master_tax')->where('tax_code',$tax_code)->get()->first();

		$taxTypegt = $taxtype->tax_type;
	
		$data1 = array(
			"comp_name"       =>  $compName,
			"fiscal_year"     =>  $fisYear,
			"tax_code"        =>  $tax_code,
			"tax_type"        =>  $taxTypegt,
			"tax_ind_code"    =>  $request->input('amthead1'),
			"rate_index"      =>  NULL,
			"tax_logic"       =>  NULL,
			"tax_rate"        =>  NULL,
			"to_date"         =>  NULL,
			"from_date"       =>  NULL,
			"vr_tax_rate"     =>  $VrTaxTran,
			"tax_gl_code"     =>  NULL,
			"static"          =>  NULL,
			"static_ind"      =>  $request->input('static_ind_bs'),
			"flag"            =>  0,
			"created_by"      =>  $createdBy
	    );

	    $saveData1 = DB::table('master_tax_rate')->insert($data1);


      	for ($i = 0; $i < $HeadCount; $i++) {

      		$GetToDt = date('Y-m-d', strtotime($ToDate[$i]));
      		$GetFromDt = date('Y-m-d', strtotime($FromDate[$i]));

      			$data = array(
					"comp_name"    =>  $compName,
					"fiscal_year"  =>  $fisYear,
					"tax_code"     =>  $tax_code,
					"tax_type"     =>  $taxTypegt,
					"tax_ind_code" =>  $amthead[$i],
					"rate_index"   =>  $afratei[$i],
					"tax_logic"    =>  $aflogic[$i],
					"tax_rate"     =>  $afrate[$i],
					"to_date"      =>  $GetToDt,
					"from_date"    =>  $GetFromDt,
					"vr_tax_rate"  =>  $VrTaxTran,
					"tax_gl_code"  =>  $afgl_code[$i],
					"static"       =>  $statici[$i],
					"static_ind"   =>  $static_ind[$i],
					"flag"         =>  0,
					"created_by"   =>  $createdBy
			 
			    );
			
			$saveData = DB::table('master_tax_rate')->insert($data);

      		
      	}

     

       

		if ($saveData) {

			$request->session()->flash('alert-success', 'Tax Was Successfully Added...!');
			return redirect('/finance/view-tax-rate-master');

		} else {

			$request->session()->flash('alert-error', 'Tax Can Not Added...!');
			return redirect('/finance/view-tax-rate-master');

		}
    }



    public function ViewTaxRateMast(Request $request){

    	$CompanyCode   = $request->session()->get('company_name');

    	if($request->ajax()) {

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    
       	 $data = DB::table('master_tax_rate')
            ->join('master_tax_indicator', 'master_tax_rate.tax_ind_code', '=', 'master_tax_indicator.tax_ind_code')
            ->join('master_tax', 'master_tax_rate.tax_code', '=', 'master_tax.tax_code')
            ->select('master_tax_rate.*', 'master_tax.tax_name','master_tax_indicator.tax_ind_name')
            ->groupBy('master_tax_rate.tax_code')
            ->get()->toArray();

       /* echo '<pre>'; print_r($data);echo '</pre>';exit;*/

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){


    	  $data = DB::table('master_tax_rate')
            ->join('master_tax_indicator', 'master_tax_rate.tax_ind_code', '=', 'master_tax_indicator.tax_ind_code')
            ->join('master_tax', 'master_tax_rate.tax_code', '=', 'master_tax.tax_code')
            ->select('master_tax_rate.*', 'master_tax.tax_name','master_tax_indicator.tax_ind_name')
            ->groupBy('master_tax_rate.tax_code')
            ->get()->toArray();
    	 

    	}else{
    		
    	 $data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->toJson();

       }

       $title = 'View Tax Rate';
       if(isset($CompanyCode)){

       return view('admin.finance.master.view_tax_rate');
       }else{
		return redirect('/useractivity');
	   }

    }

    public function EditTaxRateMast($vr_tax_rate,$btnControl){


    	$vr_tax_rate = base64_decode($vr_tax_rate);
    	//print_r($vr_tax_rate);exit();
    	$btnControl = base64_decode($btnControl);
    	

    	if($vr_tax_rate!=''){

    	    $dData['tran_tax_data'] = DB::table('master_tax_rate')->where('vr_tax_rate', $vr_tax_rate)->get();
    	  // print_r($dData['tran_tax_data']);exit;

    	    $dData['tax_code_lists'] = DB::table('master_tax_rate')->where('vr_tax_rate', $vr_tax_rate)->get()->first();

    	    $dData['tax_code_indicator'] = DB::table('master_tax_rate')->where('tax_code', 'TGST18')->where('vr_tax_rate', $vr_tax_rate)->where('tax_ind_code', '!=', 'B01')->get();
    	   // print_r($dData['tax_code']);exit;

			$button='Update';
	    	$action='/finance/form-mast-trantax-update';
			//print_r($compData['comp_list']);exit;
			$transData['trans_list'] = DB::table('master_transaction')->get();
			$transData['tax_list'] = DB::table('master_tax')->get();

			$transData['config_list'] = DB::table('master_config')->get();

			$transData['gl_list'] = DB::table('master_gl')->get();

			$transData['rate_list'] = DB::table('rate_value')->get();

			$transData['tax_ind_list'] = DB::table('master_tax_indicator')->get();

			$transData['gl_code_list'] = DB::table('master_gl')->get();


			return view('admin.finance.master.edit_tax_rate',$transData+$dData);
			
			//print_r($deptData['dept_list']);exit;
		}else{
			$request->session()->flash('alert-error', 'Tax Code Not Found...!');
			return redirect('/finance/view-tax-rate-master');
		}

	}










	


	public function sales_order_msg(Request $request,$saveData){

	 //	print_r($savedata);exit;

	if ($saveData) {

			$request->session()->flash('alert-success', 'Sales Order Was Successfully Added...!');
			return redirect('/finance/transaction/view-sales-order-transaction');

		} else {

			$request->session()->flash('alert-error', 'Plant Can Not Added...!');
			return redirect('/finance/transaction/view-sales-order-transaction');

		}
}

public function purchase_order_msg(Request $request,$saveData){

	 //	print_r($savedata);exit;

	if ($saveData) {

			$request->session()->flash('alert-success', 'Purchase Order Was Successfully Added...!');
			return redirect('/finance/transaction/view-purchase-order-transaction');

		} else {

			$request->session()->flash('alert-error', 'Purchase Can Not Added...!');
			return redirect('/finance/transaction/view-purchase-order-transaction');

		}
}

public function purchase_quotatn_save_msg(Request $request,$saveData){

	 //	print_r($savedata);exit;

	if ($saveData) {

			$request->session()->flash('alert-success', 'Purchase Quotation Was Successfully Added...!');
			return redirect('/finance/view-purchase-quatation');

		} else {

			$request->session()->flash('alert-error', 'Purchase Quotation Can Not Added...!');
			return redirect('/finance/view-purchase-quatation');

		}
}

	


	public function GetPfctCode(Request $request){

    	 $comp_code = $request->post('comp_code');
    	 //print_r($cmp_name);exit();

    	$getcompcode = DB::table('master_pfct')->where('company_code',$comp_code)->get();
    	//print_r($getcompcode);exit;

      
      if(!empty($getcompcode))
      {
        $response = '<option value="">--SELECT--</option>';
        foreach ($getcompcode as $row) 
        {
          $response .= '<option value="'.$row->pfct_code.'">'.$row->pfct_code.'='.$row->pfct_name.'</option>';
        }
      }
      else
      {
        $response = '<option value="">--SELECT--</option>';
      }
      echo $response;exit; 

    }


    public function GetGroupCode(Request $request){

    	 $costtype_code = $request->post('costtype_code');
    	 //print_r($cmp_name);exit();

    	$getgroupcode = DB::table('master_cost_group')->where('cost_type_code',$costtype_code)->get();
    	//print_r($getcompcode);exit;

      
      if(!empty($getgroupcode))
      {
      //	$response= $row->cost_group_code;
        $response = '<option value="">--SELECT--</option>';
        foreach ($getgroupcode as $row) 
        {
          $response .= '<option value="'.$row->cost_group_code.'">'.$row->cost_group_code.'='.$row->cost_group_name.'</option>';
        }
      }
      else
      {
        $response = '<option value="">--SELECT--</option>';
      }
      echo $response;exit; 

    }



 

	public function ValuationMast(Request $request){

		$title        ='Add Valuation Master';

		$compName 	= $request->session()->get('company_name');
		
		$valuation_code = $request->old('valuation_code');
		$valuation_name = $request->old('valuation_name');
		$valuation_id   = $request->old('valuation_id');
		$valuation_block   = $request->old('valuation_block');

		$userData['valuation_lists'] = DB::table('master_valuation')->Orderby('valuation_code', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/finance/form-mast-valuation-save';
		//print_r($compData['comp_list']);exit;

		

	if(isset($compName)){

    	return view('admin.finance.master.valuation_form',$userData+compact('title','valuation_code','valuation_name','valuation_id','valuation_block','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function ValuationFormSave(Request $request){


		$validate = $this->validate($request, [

			'valuation_code' => 'required|max:11|unique:master_valuation,valuation_code',
			'valuation_name' => 'required|max:40',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');
    	$flag =0;

    	$valuationData = DB::table('master_valuation')->orderBy('id', 'DESC')->first();
    	if(!empty($valuationData)){

    		$getID= $valuationData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(
			"id"             => $id,
			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"valuation_code" => $request->input('valuation_code'),
			"valuation_name" => $request->input('valuation_name'),
			"flag"=>$flag,
			"created_by"     => $createdBy,
			
		);

		$saveData = DB::table('master_valuation')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Valuation Was Successfully Added...!');
			return redirect('/finance/view-mast-valuation');

		} else {

			$request->session()->flash('alert-error', 'Valuation Can Not Added...!');
			return redirect('/finance/view-mast-valuation');

		}

	}
	 public function EditValuationMast($id){

    	$title = 'Edit Valuation Master';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_valuation');
			$query->where('valuation_code', $id);
			$valData= $query->get()->first();

			$valuation_code  = $valData->valuation_code;
			$valuation_name  = $valData->valuation_name;
			$valuation_block = $valData->val_block;
			$valuation_id    = $valData->valuation_code;

			$button='Update';
			$action='/finance/form-mast-valuation-update';

			return view('admin.finance.master.valuation_form',compact('title','valuation_code','valuation_name','valuation_id','valuation_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Config Not Found...!');
			return redirect('/finance/view-mast-valuation');
		}

    }


    public function ValuationFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'valuation_code' => 'required|max:11',
			'valuation_name' => 'required|max:40',

		]);

		$valuation_id = $request->input('valuation_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"valuation_code" => $request->input('valuation_code'),
			"valuation_name" => $request->input('valuation_name'),
			"val_block"      => $request->input('valuation_block'),
			"created_by"     => $createdBy,
			
		);

try{
	$saveData = DB::table('master_valuation')->where('valuation_code', $valuation_id)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Valuation Was Successfully Updated...!');
			return redirect('/finance/view-mast-valuation');

		} else {

			$request->session()->flash('alert-error', 'Valuation Can Not Added...!');
			return redirect('/finance/view-mast-valuation');

		}

	}
	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Valuation Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-mast-valuation');
			}

	}

	public function ViewValuationMast(Request $request){

$compName = $request->session()->get('company_name');

 if($request->ajax()) {

    	$title = 'View  Valuation Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data = DB::table('master_valuation')->orderBy('id','DESC');

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$data = DB::table('master_valuation')->orderBy('id','DESC');
    	}
    	else{
    		$data ='';
    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }
    	if(isset($compName)){

    	return view('admin.finance.master.view_valuation');
    	}else{
		return redirect('/useractivity');
	   }
    }


    public function DeleteValuation(Request $request){

		$valId = $request->post('valId');
    	

    	if ($valId!='') {

    	try{
    		
    		$Delete = DB::table('master_valuation')->where('valuation_code', $valId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Valuation Was Deleted Successfully...!');
				return redirect('/finance/view-mast-valuation');

			} else {

				$request->session()->flash('alert-error', 'Valuation Can Not Deleted...!');
				return redirect('/finance/view-mast-valuation');

			}
		}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Valuation Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-mast-valuation');
			}


    	}else{

    		$request->session()->flash('alert-error', 'Valuation Not Found...!');
			return redirect('/finance/view-mast-valuation');

    	}

	}

   public function ItemClassMast(Request $request){

		$title        ='Add Item Class Master';

		$compName 	= $request->session()->get('company_name');
		
		$item_class_code  = $request->old('item_class_code');
		$item_class_name  = $request->old('item_class_name');
		$item_class_id    = $request->old('item_class_id');
		$item_class_block = $request->old('item_class_block');

		$userData['itemc_mst_list'] = DB::table('master_item_class')->Orderby('item_class_code', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/finance/form-mast-item-class-save';
		//print_r($compData['comp_list']);exit;

		if(isset($compName)){

    	return view('admin.finance.master.item_class_form',$userData+compact('title','item_class_code','item_class_name','item_class_id','item_class_block','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function ItemClassFormSave(Request $request){


		$validate = $this->validate($request, [

			'item_class_code' => 'required|max:11|unique:master_item_class,item_class_code',
			'item_class_name' => 'required|max:40',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$itemclassData = DB::table('master_item_class')->orderBy('id', 'DESC')->first();
    	if(!empty($itemclassData)){

    		$getID= $itemclassData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}
    	$flag=0;

		$data = array(
			"id"              => $id,
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"item_class_code" => $request->input('item_class_code'),
			"item_class_name" => $request->input('item_class_name'),
			"flag" => $flag,
			"created_by"      => $createdBy,
			
		);

		$saveData = DB::table('master_item_class')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Class Was Successfully Added...!');
			return redirect('/finance/view-mast-item-class');

		} else {

			$request->session()->flash('alert-error', 'Item Class Can Not Added...!');
			return redirect('/finance/view-mast-item-class');

		}

	}
	 public function EditItemClassMast($id){

    	$title = 'Edit Valuation Master';

    	//print_r($id);
    	$id = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);


    	if($id!=''){
    	    $query = DB::table('master_item_class');
			$query->where('item_class_code', $id);
			$classData= $query->get()->first();

			$item_class_code  = $classData->item_class_code;
			$item_class_name  = $classData->item_class_name;
			$item_class_id    = $classData->item_class_code;
			$item_class_block = $classData->class_block;

			$button='Update';
			$action='/finance/form-mast-item-class-update';

			return view('admin.finance.master.item_class_form',compact('title','item_class_code','item_class_name','item_class_id','item_class_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Config Not Found...!');
			return redirect('/finance/view-mast-item-class');
		}

    }


    public function ItemClassFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'item_class_code' => 'required|max:11',
			'item_class_name' => 'required|max:40'
		]);

		$item_class_id = $request->input('item_class_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"item_class_code" => $request->input('item_class_code'),
			"item_class_name" => $request->input('item_class_name'),
			"class_block"     => $request->input('item_class_block'),
			"updated_by"      => $createdBy,
			"updated_by"      => $updatedDate,
			
		);

	$saveData = DB::table('master_item_class')->where('item_class_code', $item_class_id)->update($data);
	try{

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Class Was Successfully Updated...!');
			return redirect('/finance/view-mast-item-class');

		} else {

			$request->session()->flash('alert-error', 'Item Class Can Not Added...!');
			return redirect('/finance/view-mast-item-class');

		}
	}
	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Class Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-mast-item-class');
			}


	}

	public function ViewItemClassMast(Request $request){
$compName = $request->session()->get('company_name');

		 if($request->ajax()) {

    	$title = 'View  Valuation Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data = DB::table('master_item_class')->orderBy('id','DESC');

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$data = DB::table('master_item_class')->orderBy('id','DESC');
    	}
    	else{
    		$data ='';
    	}

    	 return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }

    if(isset($compName)){
    	return view('admin.finance.master.view_item_class');

    }else{
		 return redirect('/useractivity');
	   }

    }


    public function DeleteItemClass(Request $request){

		$classId = $request->post('classId');
    	

    	if ($classId!='') {

    try{

    		$Delete = DB::table('master_item_class')->where('item_class_code', $classId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Item Class Was Deleted Successfully...!');
				return redirect('/finance/view-mast-item-class');

			} else {

				$request->session()->flash('alert-error', 'Item Class Can Not Deleted...!');
				return redirect('/finance/view-mast-item-class');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Class Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-mast-item-class');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Valuation Not Found...!');
			return redirect('/finance/view-mast-valuation');

    	}

	}


	public function ItemTypeMast(Request $request){

		$title        ='Add Item Class Master';

		$compName 	= $request->session()->get('company_name');
		
		$item_type_code  = $request->old('item_type_code');
		$item_type_name  = $request->old('item_type_name');
		$item_type_id    = $request->old('item_type_id');
		$item_type_block = $request->old('item_type_block');

		$userData['item_type_lists'] = DB::table('master_item_type')->Orderby('item_type_code', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/finance/form-mast-item-type-save';
		//print_r($compData['comp_list']);exit;

	if(isset($compName)){

    	return view('admin.finance.master.item_type_form',$userData+compact('title','item_type_code','item_type_name','item_type_id','item_type_block','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function ItemTypeFormSave(Request $request){


		$validate = $this->validate($request, [

			'item_type_code' => 'required|max:11|unique:master_item_type,item_type_code',
			'item_type_name' => 'required|max:40',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$itemtypeData = DB::table('master_item_type')->orderBy('id', 'DESC')->first();
    	if(!empty($itemtypeData)){

    		$getID= $itemtypeData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(
			"id"             => $id,
			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"item_type_code" => $request->input('item_type_code'),
			"item_type_name" => $request->input('item_type_name'),
			"created_by"     => $createdBy,
			
		);

		$saveData = DB::table('master_item_type')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Type Was Successfully Added...!');
			return redirect('/finance/view-mast-item-type');

		} else {

			$request->session()->flash('alert-error', 'Item Type Can Not Added...!');
			return redirect('/finance/view-mast-item-type');

		}

	}
	 public function EditItemTypeMast($id){

    	$title = 'Edit Type Master';

    	//print_r($id);
    	$id = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);


    	if($id!=''){
    	    $query = DB::table('master_item_type');
			$query->where('item_type_code', $id);
			$classData= $query->get()->first();

			$item_type_code  = $classData->item_type_code;
			$item_type_name  = $classData->item_type_name;
			$item_type_id    = $classData->item_type_code;
			$item_type_block = $classData->type_block;

			$button='Update';
			$action='/finance/form-mast-item-type-update';

			return view('admin.finance.master.item_type_form',compact('title','item_type_code','item_type_name','item_type_id','item_type_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Type Not Found...!');
			return redirect('/finance/view-mast-item-type');
		}

    }


    public function ItemTypeFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'item_type_code' => 'required|max:11',
			'item_type_name' => 'required|max:40',

		]);

		$item_type_id = $request->input('item_type_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"item_type_code" => $request->input('item_type_code'),
			"item_type_name" => $request->input('item_type_name'),
			"type_block"     => $request->input('item_type_block'),
			"updated_by"      => $createdBy,
			"updated_by"      => $updatedDate,
			
		);

try{

	$saveData = DB::table('master_item_type')->where('item_type_code', $item_type_id)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item type Was Successfully Updated...!');
			return redirect('/finance/view-mast-item-type');

		} else {

			$request->session()->flash('alert-error', 'Item type Can Not Added...!');
			return redirect('/finance/view-mast-item-type');

		}
	}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Type Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-mast-item-type');
			}

	}

	public function ViewItemTypeMast(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

    	$title = 'View Item Type Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data = DB::table('master_item_type')->orderBy('id','DESC');

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$data = DB::table('master_item_type')->orderBy('id','DESC');
    	}
    	else{
    		$data ='';
    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }

    	if(isset($compName)){
    	return view('admin.finance.master.view_item_type');
    	}else{
		 return redirect('/useractivity');
	   }
    }


    public function DeleteItemType(Request $request){

		$typeId = $request->post('typeId');
    	

    	if ($typeId!='') {
    	try{
    		$Delete = DB::table('master_item_type')->where('item_type_code', $typeId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Item Type Was Deleted Successfully...!');
				return redirect('/finance/view-mast-item-type');

			} else {

				$request->session()->flash('alert-error', 'Item Type Can Not Deleted...!');
				return redirect('/finance/view-mast-item-type');

			}
		}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Type Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-mast-item-type');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Item Type Not Found...!');
			return redirect('/finance/view-mast-item-type');

    	}

	}


	public function RackMast(Request $request){

		$title        ='Add Rack Master';
		
		$rack_code  = $request->old('rack_code');
		$rack_name  = $request->old('rack_name');
		$rack_id    = $request->old('rack_id');
		$rack_block = $request->old('rack_block');

		$compName 	= $request->session()->get('company_name');

		$userData['RackM_lists'] = DB::table('master_rack')->Orderby('rack_code', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/finance/form-mast-rack-save';
		


	if(isset($compName)){

    	return view('admin.finance.master.rack_form',$userData+compact('title','rack_code','rack_name','rack_id','rack_block','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function RackFormSave(Request $request){


		$validate = $this->validate($request, [

			'rack_code' => 'required|max:11|unique:master_rack,rack_code',
			'rack_name' => 'required|max:40',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$rackData = DB::table('master_rack')->orderBy('id', 'DESC')->first();
    	if(!empty($rackData)){

    		$getID= $rackData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(
			"id"          => $id,
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"rack_code"   => $request->input('rack_code'),
			"rack_name"   => $request->input('rack_name'),
			"created_by"  => $createdBy,
			
		);

		$saveData = DB::table('master_rack')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Rack Was Successfully Added...!');
			return redirect('/finance/view-mast-rack');

		} else {

			$request->session()->flash('alert-error', 'Rack Can Not Added...!');
			return redirect('/finance/view-mast-rack');

		}

	}
	 public function EditRackMast($id){

    	$title = 'Edit Rack Master';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_rack');
			$query->where('rack_code', $id);
			$classData= $query->get()->first();

			$rack_code  = $classData->rack_code;
			$rack_name  = $classData->rack_name;
			$rack_id    = $classData->rack_code;
			$rack_block = $classData->rack_block;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/finance/form-mast-rack-update';

			return view('admin.finance.master.rack_form',compact('title','rack_code','rack_name','rack_id','rack_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Rack Not Found...!');
			return redirect('/finance/view-mast-rack');
		}

    }


    public function RackFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'rack_code' => 'required|max:11',
			'rack_name' => 'required|max:40',

		]);

		$rack_id = $request->input('rack_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"rack_code"   => $request->input('rack_code'),
			"rack_name"   => $request->input('rack_name'),
			"rack_block"  => $request->input('rack_block'),
			"updated_by"  => $createdBy,
			"updated_by"  => $updatedDate,
			
		);

try{
	$saveData = DB::table('master_rack')->where('rack_code', $rack_id)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Rack Was Successfully Updated...!');
			return redirect('/finance/view-mast-rack');

		} else {

			$request->session()->flash('alert-error', 'Rack Can Not Added...!');
			return redirect('/finance/view-mast-rack');

		}
	}
	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Rack Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-mast-rack');
			}

	}

	public function ViewRackMast(Request $request){

$compName = $request->session()->get('company_name');

	if ($request->ajax()) {

    	$title = 'View Rack Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data = DB::table('master_rack')->orderBy('id','DESC');

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$data = DB::table('master_rack')->orderBy('id','DESC');
    	}
    	else{
    		$data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->toJson();

    }
    	if(isset($compName)){
    	return view('admin.finance.master.view_rack');
    	}else{
		return redirect('/useractivity');
	   }
    }


    public function DeleteRack(Request $request){

		$rackId = $request->post('rackId');
    	

    	if ($rackId!='') {
    		try{
    		
    		$Delete = DB::table('master_rack')->where('rack_code', $rackId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Rack Was Deleted Successfully...!');
				return redirect('/finance/view-mast-rack');

			} else {

				$request->session()->flash('alert-error', 'Rack Can Not Deleted...!');
				return redirect('/finance/view-mast-rack');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Rack Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-mast-rack');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Rack Not Found...!');
			return redirect('/finance/view-mast-rack');

    	}

	}




	public function ItemCategory(Request $request){

		$title = 'Add Item Category';

		$compName 	= $request->session()->get('company_name');

		$itemcategory_code    = $request->old('itemcategory_code');
		$itemcategory_name  = $request->old('itemcategory_name');
		$itemcategory_id  = $request->old('id');
		$category_block      = $request->old('category_block');

		$userData['ItemCat_lists'] = DB::table('master_item_category')->Orderby('itemcategory_code', 'desc')->limit(5)->get();

		$button='Save';

    	$action='/form-itemcategory-save';

		

		if(isset($compName)){

    	return view('admin.finance.master.item_category',$userData+compact('title','itemcategory_code','itemcategory_name','itemcategory_id','category_block','action','button'));

    }else{

		return redirect('/useractivity');
	}

	}


	public function SaveItemCategory(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$validate = $this->validate($request, [

				'itemcategory_code' => 'required|max:11|unique:master_item_category,itemcategory_code',
				'itemcategory_name' => 'required|max:40',

		]);

		$itemcatData = DB::table('master_item_category')->orderBy('id', 'DESC')->first();
    	if(!empty($itemcatData)){

    		$getID= $itemcatData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(
					"id"                =>  $id,
					"itemcategory_code" =>  $request->input('itemcategory_code'),
					"itemcategory_name" =>  $request->input('itemcategory_name'),
					"created_by"        =>  $request->session()->get('userid'),
					"comp_name"         =>  $compName,
					"fiscal_year"       => $fisYear
					
	    	);

		$saveData = DB::table('master_item_category')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Category Was Successfully Added...!');
				return redirect('/finance/view-item-category');

			} else {

				$request->session()->flash('alert-error', 'Item Category Can Not Added...!');
				return redirect('/finance/view-item-category');

			}

	}


	public function ViewItemCategory(Request $request){


	$compName = $request->session()->get('company_name');

	if($request->ajax()) {

       $title = 'View Rack Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data  = DB::table('master_item_category')->orderBy('id','DESC');

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$data  = DB::table('master_item_category')->orderBy('id','DESC');
    	}
    	else{
  			 $data ='';
    	}

    return DataTables()->of($data)->addIndexColumn()->toJson();

}
		if(isset($compName)){

    	return view('admin.finance.master.view_item_category');
		}else{
		 return redirect('/useractivity');
	   }

    }


    public function DeleteItemCategory(Request $request){

        $id = $request->input('itemcat');
        if ($id!='') {
        	try{
			$Delete = DB::table('master_item_category')->where('itemcategory_code', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Item Category Data Was Deleted Successfully...!');
			return redirect('/finance/view-item-category');

			} else {

			$request->session()->flash('alert-error', 'Item Category Data Can Not Deleted...!');
			return redirect('/finance/view-item-category');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Category be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-item-category');
			}

		}else{

		$request->session()->flash('alert-error', 'Item Category Data Not Found...!');
		return redirect('/finance/view-item-category');

		}
	}


	public function EditItemCategory($id){

    	$title = 'Edit Item Category';

    	//print_r($id);
    	$id = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);


    	if($id!=''){
    	    $query = DB::table('master_item_category');
			$query->where('itemcategory_code', $id);
			$classData= $query->get()->first();

			$itemcategory_code  = $classData->itemcategory_code;
			$itemcategory_name  = $classData->itemcategory_name;
			$itemcategory_id    = $classData->itemcategory_code;
			$category_block = $classData->category_block;

			$button='Update';
			$action='/form-item-category-update';

			return view('admin.finance.master.item_category',compact('title','itemcategory_code','itemcategory_name','itemcategory_id','category_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Category Not Found...!');
			return redirect('/finance/view-item-category');
		}

    }


    public function UpdateItemCategory(Request $request){

		
		$validate = $this->validate($request, [

				'itemcategory_code' => 'required|max:11',
				'itemcategory_name' => 'required|max:40',
				

		]);

       $id = $request->input('idcat');
       $updatedDate = date('Y-m-d');

		$data = array(
				"itemcategory_code" =>  $request->input('itemcategory_code'),
				"itemcategory_name" =>  $request->input('itemcategory_name'),
				"category_block"    =>  $request->input('category_block'),
				"last_updat_by"     =>  $request->session()->get('userid'),
				"last_updat_date"   =>  $updatedDate
	 
	    	);

try{
		$saveData = DB::table('master_item_category')->where('itemcategory_code', $id)->update($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Category Was Successfully Updated...!');
				return redirect('/finance/view-item-category');

			} else {

				$request->session()->flash('alert-error', 'Item Category Can Not Updated...!');
				return redirect('/finance/view-item-category');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Category be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-item-category');
			}


	}

/*item category*/


/*item group*/

	public function ItemGroup(Request $request){

		$title = 'Add Item Group';

		$compName 	= $request->session()->get('company_name');

		$itemgroup_code = $request->old('itemgroup_code');
		$itemgroup_name = $request->old('itemgroup_name');
		$itemgroup_id   = $request->old('id');
		$group_block    = $request->old('group_block');

		$userData['itemgrp_mst_list'] = DB::table('master_itemgroup')->Orderby('itemgroup_code', 'desc')->limit(5)->get();

		$button='Save';

    	$action='/form-itemgroup-save';

	if(isset($compName)){

    	return view('admin.finance.master.item_group',$userData+compact('title','itemgroup_code','itemgroup_name','itemgroup_id','group_block','action','button'));

    }else{

		return redirect('/useractivity');
	}

	}

	public function SaveItemGroup(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$validate = $this->validate($request, [

				'itemgroup_code' => 'required|max:11|unique:master_itemgroup,itemgroup_code',
				'itemgroup_name' => 'required|max:40',

		]);

		$itemgrpData = DB::table('master_itemgroup')->orderBy('id', 'DESC')->first();
    	if(!empty($itemgrpData)){

    		$getID= $itemgrpData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(
					"id"             =>  $id,
					"itemgroup_code" =>  $request->input('itemgroup_code'),
					"itemgroup_name" =>  $request->input('itemgroup_name'),
					"created_by"     =>  $request->session()->get('userid'),
					"comp_name"      =>  $compName,
					"fiscal_year"    =>  $fisYear
					
	    	);

		$saveData = DB::table('master_itemgroup')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Group Was Successfully Added...!');
				return redirect('/finance/view-item-group');

			} else {

				$request->session()->flash('alert-error', 'Item Group Can Not Added...!');
				return redirect('/finance/view-item-group');

			}

	}

	public function ViewItemGroup(Request $request){

$compName = $request->session()->get('company_name');

if($request->ajax()) {

       $title = 'View Item Group';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){

    	 $data = DB::table('master_itemgroup')->orderBy('id','DESC');


    	 //print_r($GlschData['glsch_data']);exit;
    	}
    	elseif ($userType=='superAdmin' || $userType=='user') {

    		$data = DB::table('master_itemgroup')->orderBy('id','DESC');
    	}
    	else{
    		$data ='';
    	}

    	 return DataTables()->of($data)->addIndexColumn()->toJson();

}	
	if(isset($compName)){
    	return view('admin.finance.master.view_item_group');
	}else{
		return redirect('/useractivity');
	   }

    }


    public function DeleteItemgroup(Request $request){

        $id = $request->input('itemgroupid');
        if ($id!='') {

        	try{

			$Delete = DB::table('master_itemgroup')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Item Group Data Was Deleted Successfully...!');
			return redirect('/finance/view-item-group');

			} else {

			$request->session()->flash('alert-error', 'Item Group Data Can Not Deleted...!');
			return redirect('/finance/view-item-group');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Group be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-item-group');
			}

		}else{

		$request->session()->flash('alert-error', 'Item Group Data Not Found...!');
		return redirect('/finance/view-item-group');

		}
	}


	public function EditItemGroup($id,$btnControl){

    	$title = 'Edit Item Group';

    	//print_r($id);
    	$id = base64_decode($id);
    	$btnControl = base64_decode($btnControl);


    	if($id!=''){
    	    $query = DB::table('master_itemgroup');
			$query->where('id', $id);
			$classData= $query->get()->first();

			$itemgroup_code = $classData->itemgroup_code;
			$itemgroup_name = $classData->itemgroup_name;
			$itemgroup_id   = $classData->id;
			$group_block    = $classData->group_block;

			$button='Update';
			$action='/form-item-group-update';

			return view('admin.finance.master.item_group',compact('title','itemgroup_code','itemgroup_name','itemgroup_id','group_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Category Not Found...!');
			return redirect('/finance/view-item-group');
		}

    }

    public function UpdateItemGroup(Request $request){

		
		$validate = $this->validate($request, [

				'itemgroup_code' => 'required|max:11',
				'itemgroup_name' => 'required|max:40',
				

		]);

       $id = $request->input('idgroup');
       $updatedDate = date('Y-m-d');

		$data = array(
				"itemgroup_code"  =>  $request->input('itemgroup_code'),
				"itemgroup_name"  =>  $request->input('itemgroup_name'),
				"group_block"     =>  $request->input('group_block'),
				"last_updat_by"   =>  $request->session()->get('userid'),
				"last_updat_date" =>  $updatedDate
	 
	    	);
		try{
		$saveData = DB::table('master_itemgroup')->where('id', $id)->update($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Group Was Successfully Updated...!');
				return redirect('/finance/view-item-group');

			} else {

				$request->session()->flash('alert-error', 'Item Group Can Not Updated...!');
				return redirect('/finance/view-item-group');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Group be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-item-group');
			}


	}

/*item group*/

/*TDS Master*/

	public function TDSMast(Request $request){

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

		$glData['tds_code_list'] = DB::table('master_tds')->Orderby('tds_code', 'desc')->limit(5)->get();

		$button='Save';

    	$action='/form-tdsmast-save';

    	$glData['gl_list'] = DB::table('master_gl')->get();
	

	if(isset($compName)){

    	return view('admin.finance.master.tds_mast',$glData+compact('title','tds_code','tds_name','tds_rate','surcharge_rate','surchargegl_code','cess_rate','cessgl_code','form_no','gl_code','tds_section','from_date','to_date','tds_id','tds_block','action','button'));

    }else{

		return redirect('/useractivity');
	}

	}

	public function SaveTDSMast(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$fromDate = $request->input('from_date');

    	$from_date = date("Y-m-d", strtotime($fromDate));

    	$toDate = $request->input('to_date');

    	$to_date = date("Y-m-d", strtotime($toDate));



		$validate = $this->validate($request, [

				'tds_code'         => 'required|max:11|unique:master_tds,tds_code',
				'tds_name'         => 'required|max:40',
				'tds_rate'         => 'required|max:11',
				'surcharge_rate'   => 'required|max:11',
				'surchargegl_code' => 'required|max:11',
				'cess_rate'        => 'required|max:11',
				'cessgl_code'      => 'required|max:11',
				'form_no'          => 'required|max:10',
				'gl_code'          => 'required|max:11',
				'tds_section'      => 'required|max:6',
				'from_date'        => 'required|max:10',
				'to_date'          => 'required|max:10',
				

		]);

		$tdsData = DB::table('master_tds')->orderBy('id', 'DESC')->first();
    	if(!empty($tdsData)){

    		$getID= $tdsData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(
					"id"               =>  $id,
					"tds_code"         =>  $request->input('tds_code'),
					"tds_name"         =>  $request->input('tds_name'),
					"tds_rate"         =>  $request->input('tds_rate'),
					"surcharge_rate"   =>  $request->input('surcharge_rate'),
					"surchargegl_code" =>  $request->input('surchargegl_code'),
					"cess_rate"        =>  $request->input('cess_rate'),
					"cessgl_code"      =>  $request->input('cessgl_code'),
					"form_no"          =>  $request->input('form_no'),
					"gl_code"          =>  $request->input('gl_code'),
					"tds_section"      =>  $request->input('tds_section'),
					"from_date"        =>  $from_date,
					"to_date"          =>  $to_date,
					"created_by"       =>  $request->session()->get('userid'),
					"comp_name"        =>  $compName,
					"fiscal_year"      =>  $fisYear
					
	    	);

		$saveData = DB::table('master_tds')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'TDS Was Successfully Added...!');
				return redirect('/finance/view-tds-mast');

			} else {

				$request->session()->flash('alert-error', 'TDS Can Not Added...!');
				return redirect('/finance/view-tds-mast');

			}

	}


	public function ViewTDSMast(Request $request){
$compName = $request->session()->get('company_name');

if($request->ajax()) {

       $title = 'View Item Group';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){

    	 $data = DB::table('master_tds')->orderBy('id','DESC');


    	 //print_r($GlschData['glsch_data']);exit;
    	}
    	elseif ($userType=='superAdmin' || $userType=='user') {

    		$data  = DB::table('master_tds')->orderBy('id','DESC');
    	}
    	else{
    		$data ='';
    	}

    	 return DataTables()->of($data)->addIndexColumn()->toJson();


    }

    if(isset($compName)){

    	return view('admin.finance.master.view_tds_mast');
    }else{
		return redirect('/useractivity');
	   }


    }

    public function DeleteTDSMast(Request $request){

        $id = $request->input('tdsid');
        if ($id!='') {
try{
			$Delete = DB::table('master_tds')->where('tds_code', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'TDS Data Was Deleted Successfully...!');
			return redirect('/finance/view-tds-mast');

			} else {

			$request->session()->flash('alert-error', 'TDS Data Can Not Deleted...!');
			return redirect('/finance/view-tds-mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'TDS Data be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-tds-mast');
			}

		}else{

		$request->session()->flash('alert-error', 'TDS Data Not Found...!');
		return redirect('/finance/view-tds-mast');

		}
	}


	public function EditTDSMast($id){

    	$title = 'Edit TDS Master';

    	//print_r($id);
    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('master_tds');
			$query->where('tds_code', $id);
			$classData= $query->get()->first();

			$tds_code         = $classData->tds_code;
			$tds_name         = $classData->tds_name;
			$tds_rate         = $classData->tds_rate;
			$surcharge_rate   = $classData->surcharge_rate;
			$surchargegl_code = $classData->surchargegl_code;
			$cess_rate        = $classData->cess_rate;
			$cessgl_code      = $classData->cessgl_code;
			$form_no          = $classData->form_no;
			$from_date        = $classData->from_date;
			$to_date          = $classData->to_date;
			$gl_code          = $classData->gl_code;
			$tds_section      = $classData->tds_section;
			$tds_id           = $classData->tds_code;
			$tds_block        = $classData->tds_block;

			$button='Update';
			$action='/form-tds-mast-update';

			$glData['gl_list'] = DB::table('master_gl')->get();

			return view('admin.finance.master.tds_mast',$glData+compact('title','tds_code','tds_name','tds_rate','surcharge_rate','surchargegl_code','cess_rate','cessgl_code','form_no','from_date','to_date','gl_code','tds_section','tds_id','tds_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Category Not Found...!');
			return redirect('/finance/view-tds-mast');
		}

    }


    public function UpdateTDSMast(Request $request){

    	$fromDate = $request->input('from_date');

    	$from_date = date("Y-m-d", strtotime($fromDate));

    	$toDate = $request->input('to_date');

    	$to_date = date("Y-m-d", strtotime($toDate));


		$validate = $this->validate($request, [

				'tds_code'         => 'required|max:11',
				'tds_name'         => 'required|max:30',
				'tds_rate'         => 'required|max:30',
				'surcharge_rate'   => 'required|max:30',
				'surchargegl_code' => 'required|max:11',
				'cess_rate'        => 'required|max:25',
				'cessgl_code'      => 'required|max:11',
				'form_no'          => 'required|max:10',
				'gl_code'          => 'required|max:11',
				'tds_section'      => 'required|max:6',
				'from_date'        => 'required|max:10',
				'to_date'          => 'required|max:10',
				

		]);

       $id = $request->input('idtds');
       $updatedDate = date('Y-m-d');

		$data = array(
				"tds_code"         =>  $request->input('tds_code'),
				"tds_name"         =>  $request->input('tds_name'),
				"tds_rate"         =>  $request->input('tds_rate'),
				"surcharge_rate"   =>  $request->input('surcharge_rate'),
				"surchargegl_code" =>  $request->input('surchargegl_code'),
				"cess_rate"        =>  $request->input('cess_rate'),
				"cessgl_code"      =>  $request->input('cessgl_code'),
				"form_no"          =>  $request->input('form_no'),
				"gl_code"          =>  $request->input('gl_code'),
				"tds_section"      =>  $request->input('tds_section'),
				"from_date"        =>  $from_date,
				"to_date"          =>  $to_date,
				"tds_block"        =>  $request->input('tds_block'),
				"last_updat_by"    =>  $request->session()->get('userid'),
				"last_updat_date"  =>  $updatedDate
	 
	    	);
try{
		$saveData = DB::table('master_tds')->where('tds_code', $id)->update($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'TDS Data Was Successfully Updated...!');
				return redirect('/finance/view-tds-mast');

			} else {

				$request->session()->flash('alert-error', 'TDS Data Can Not Updated...!');
				return redirect('/finance/view-tds-mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'TDS Data be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-tds-mast');
			}


	}


	public function AccClassMast(Request $request){

		$title        ='Add Rack Master';

		$compName 	= $request->session()->get('company_name');
		
		$acc_class_code  = $request->old('acc_class_code');
		$acc_class_name  = $request->old('acc_class_name');
		$acc_class_id    = $request->old('acc_class_id');
		$acc_class_block = $request->old('acc_class_block');

		$userData['AccClass_mst_list'] = DB::table('master_acc_class')->Orderby('acc_class_code', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/finance/form-mast-acc-class-save';
		

	if(isset($compName)){

    	return view('admin.finance.master.acc_class_form',$userData+compact('title','acc_class_code','acc_class_name','acc_class_id','acc_class_block','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function AccClassFormSave(Request $request){


		$validate = $this->validate($request, [

			'acc_class_code' => 'required|max:11|unique:master_acc_class,acc_class_code',
			'acc_class_name' => 'required|max:40',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$accClassData = DB::table('master_acc_class')->orderBy('id', 'DESC')->first();
    	if(!empty($accClassData)){

    		$getID= $accClassData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(
			"id"             => $id,
			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"acc_class_code" => $request->input('acc_class_code'),
			"acc_class_name" => $request->input('acc_class_name'),
			"created_by"     => $createdBy,
			
		);

		$saveData = DB::table('master_acc_class')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Acc Class Was Successfully Added...!');
			return redirect('/finance/view-mast-acc-class');

		} else {

			$request->session()->flash('alert-error', 'Acc Class Can Not Added...!');
			return redirect('/finance/view-mast-acc-class');

		}

	}
	 public function EditAccClassMast($accClass){

    	$title = 'Edit Acc Class Master';

    	//print_r($id);
    	$accClass = base64_decode($accClass);


    	if($accClass!=''){
    	    $query = DB::table('master_acc_class');
			$query->where('acc_class_code', $accClass);
			$classData= $query->get()->first();

			$acc_class_code  = $classData->acc_class_code;
			$acc_class_name  = $classData->acc_class_name;
			$acc_class_id    = $classData->acc_class_code;
			$acc_class_block = $classData->class_block;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/finance/form-mast-acc-class-update';

			return view('admin.finance.master.acc_class_form',compact('title','acc_class_code','acc_class_name','acc_class_id','acc_class_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Acc Class Not Found...!');
			return redirect('/finance/view-mast-acc-class');
		}

    }


    public function AccClassFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'acc_class_code' => 'required|max:11',
			'acc_class_name' => 'required|max:40',

		]);

		$acc_classCode = $request->input('acc_class_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"acc_class_code" => $request->input('acc_class_code'),
			"acc_class_name" => $request->input('acc_class_name'),
			"class_block"    => $request->input('acc_class_block'),
			"updated_by"     => $createdBy,
			"updated_by"     => $updatedDate,
			
		);

try{

	$saveData = DB::table('master_acc_class')->where('acc_class_code', $acc_classCode)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Acc Class Was Successfully Updated...!');
			return redirect('/finance/view-mast-acc-class');

		} else {

			$request->session()->flash('alert-error', 'Acc Class Can Not Added...!');
			return redirect('/finance/view-mast-acc-class');

		}
	}
	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Acc Class be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-mast-acc-class');
			}

	}

	public function ViewAccClassMast(Request $request){

   $compName = $request->session()->get('company_name');

if($request->ajax()){

    	$title = 'View Acc Class Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data  = DB::table('master_acc_class')->orderBy('id','DESC');

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$data  = DB::table('master_acc_class')->orderBy('id','DESC');
    	}
    	else{
    		$data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->toJson();

}
		if(isset($compName)){

    	return view('admin.finance.master.view_acc_class');
    }else{
		return redirect('/useractivity');
	   }
    }


    public function DeleteAccClass(Request $request){

		$classCode = $request->post('classId');
    	

    	if ($classCode!='') {

    		try{
    		
    		$Delete = DB::table('master_acc_class')->where('acc_class_code', $classCode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Acc Class Was Deleted Successfully...!');
				return redirect('/finance/view-mast-acc-class');

			} else {

				$request->session()->flash('alert-error', 'Acc Class Can Not Deleted...!');
				return redirect('/finance/view-mast-acc-class');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Acc Class be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-mast-acc-class');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Acc Class Not Found...!');
			return redirect('/finance/view-mast-acc-class');

    	}

	}

/*TDS Master*/


/*TDS Rate Master*/

	public function TDSRateMast(Request $request){

		$title = 'Add TDS Rate';

		$compName 	= $request->session()->get('company_name');

		$tds_code  = $request->old('tds_code');
		$acc_code  = $request->old('acc_code');
		$tds_rate  = $request->old('tds_rate');
		$from_date = $request->old('from_date');

		$to_date   = $request->old('to_date');
		$tdsrate_id   = $request->old('tdsrateid');
		$button='Save';

    	$action='/form-tds-rate-mast-save';

    	$userdata['tds_list'] = DB::table('master_tds')->get();
    	$userdata['acc_list'] = DB::table('master_party')->get();

		

	if(isset($compName)){

    	return view('admin.finance.master.tds_rate_mast',$userdata+compact('title','tds_code','acc_code','from_date','to_date','tds_rate','tdsrate_id','action','button'));

    }else{

		return redirect('/useractivity');
	}

	}


	public function SaveTDSRateMast(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


    	$fromDate = $request->input('from_date');

    	$from_date = date("Y-m-d", strtotime($fromDate));

    	$toDate = $request->input('to_date');

    	$to_date = date("Y-m-d", strtotime($toDate));

		$validate = $this->validate($request, [

				'tds_code'      => 'required|max:11',
				'tds_rate'      => 'required|max:11',
		]);

		$data = array(
					"tds_code"      =>  $request->input('tds_code'),
					"acc_code"      =>  $request->input('acc_code'),
					"tds_rate"      =>  $request->input('tds_rate'),
					"from_date"     =>  $from_date,
					"to_date"       =>  $to_date,
					"created_by"    =>  $request->session()->get('userid'),
					"comp_name"     =>  $compName,
					"fiscal_year"   =>  $fisYear	
	    	);

		$saveData = DB::table('master_tds_rate')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'TDS Rate Was Successfully Added...!');
				return redirect('/finance/view-tds-rate-mast');

			} else {

				$request->session()->flash('alert-error', 'TDS Rate Can Not Added...!');
				return redirect('/finance/view-tds-rate-mast');

			}

	}

	public function ViewTDSRateMast(Request $request){

$compName = $request->session()->get('company_name');

if($request->ajax()){



       $title = 'View Acc Class Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data = DB::table('master_tds_rate')->orderBy('id','DESC');

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$data = DB::table('master_tds_rate')->orderBy('id','DESC');
    	}
    	else{
    		$data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->toJson();

}

	if(isset($compName)){

    	return view('admin.finance.master.view_tds_rate_mast');
	}else{
		 return redirect('/useractivity');
	   }

    }


    public function DeleteTDSRateMast(Request $request){

        $id = $request->input('tdsrateid');
        if ($id!='') {

			$Delete = DB::table('master_tds_rate')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'TDS Rate Data Was Deleted Successfully...!');
			return redirect('/finance/view-tds-rate-mast');

			} else {

			$request->session()->flash('alert-error', 'TDS Rate Data Can Not Deleted...!');
			return redirect('/finance/view-tds-rate-mast');

			}

		}else{

		$request->session()->flash('alert-error', 'TDS Rate Data Not Found...!');
		return redirect('/finance/view-tds-rate-mast');

		}
	}



	public function EditTDSRateMast($id,$btnControl){

    	$title = 'Edit TDS Rate';

    	//print_r($id);
    	$id = base64_decode($id);
    	$btnControl = base64_decode($btnControl);

    	if($id!=''){
    	    $query = DB::table('master_tds_rate');
			$query->where('id', $id);
			$classData= $query->get()->first();
			
			$tds_code      = $classData->tds_code;
			$acc_code      = $classData->acc_code;
			$tds_rate      = $classData->tds_rate;
			$from_date     = $classData->from_date;
			$to_date       = $classData->to_date;
			$tdsrate_block = $classData->tdsrate_block;
			$tdsrate_id    = $classData->id;

			$button='Update';
			$action='/form-tds-rate-mast-update';

			$userdata['tds_list'] = DB::table('master_tds')->get();

    		$userdata['acc_list'] = DB::table('master_party')->get();

			return view('admin.finance.master.tds_rate_mast',$userdata+compact('title','tds_code','acc_code','tds_rate','from_date','to_date','tdsrate_block','tdsrate_id','button','action'));
		}else{
			$request->session()->flash('alert-error', 'TDS Rate Not Found...!');
			return redirect('/finance/view-tds-rate-mast');
		}

    }


    public function UpdateTDSRateMast(Request $request){


    	$fromDate = $request->input('from_date');

    	$from_date = date("Y-m-d", strtotime($fromDate));

    	$toDate = $request->input('to_date');

    	$to_date = date("Y-m-d", strtotime($toDate));

		$validate = $this->validate($request, [

				'tds_code'      => 'required|max:11',
				'acc_code'      => 'required|max:11',
				'tds_rate'      => 'required|max:11',		
		]);

       $id = $request->input('idtds');

       $updatedDate = date('Y-m-d');

		$data = array(
				"tds_code"        =>  $request->input('tds_code'),
				"acc_code"        =>  $request->input('acc_code'),
				"tds_rate"        =>  $request->input('tds_rate'),
				"from_date"       =>  $from_date,
				"to_date"         =>  $to_date,
				"tdsrate_block"   =>  $request->input('tdsrate_block'),
				"last_updat_by"   =>  $request->session()->get('userid'),
				"last_updat_date" =>  $updatedDate
	 
	    	);

		$saveData = DB::table('master_tds_rate')->where('id', $id)->update($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'TDS Rate Was Successfully Updated...!');
				return redirect('/finance/view-tds-rate-mast');

			} else {

				$request->session()->flash('alert-error', 'TDS Rate Can Not Updated...!');
				return redirect('/finance/view-tds-rate-mast');

			}


	}

/*TDS Rate Master*/

	public function ValuationTransMaster(Request $request){

		$title       = 'Add Valuation Transaction';

		$compName 	= $request->session()->get('company_name');
		
		$val_code    = $request->old('valution_code');
		$trans_code  = $request->old('transaction_code');
		$seriescode = $request->old('series_code');
		$drgl_code   = $request->old('drgl_code');
		$crgl_code   = $request->old('crgl_code');
		$idvaltrans  = $request->old('idvaltrans');
		$button      ='Save';
		
		$action      = '/finance/form-valuation-transaction-save';

    	$userdata['valution_code'] = DB::table('master_valuation')->get();
    	$userdata['transaction_code'] = DB::table('master_transaction')->get();
    	$userdata['series_code'] = DB::table('master_config')->get();

		

	if(isset($compName)){

    	return view('admin.finance.master.valuation_trans',$userdata+compact('title','val_code','trans_code','seriescode','drgl_code','crgl_code','idvaltrans','action','button'));

    }else{

		return redirect('/useractivity');
	}

    	

    }



    public function ValuationTransMasterSave(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$validate = $this->validate($request, [

				'valution_code'    => 'required|max:11',
				'transaction_code' => 'required|max:2',
				'series_code'      => 'required|max:11',
				'drgl_code'        => 'required|max:11',
				'crgl_code'        => 'required|max:11',	
		]);

		$valtranBlock = 0;
		$flag = 1;

		$data = array(
			"comp_name"      =>  $compName,
			"fiscal_year"    =>  $fisYear,
			"valuation_code" =>  $request->input('valution_code'),
			"tran_code"      =>  $request->input('transaction_code'),
			"series_code"    =>  $request->input('series_code'),
			"drgl_code"      =>  $request->input('drgl_code'),
			"crgl_code"      =>  $request->input('crgl_code'),
			"created_by"     =>  $request->session()->get('userid'),
			"valtran_block"  =>  $valtranBlock,
			"flag" 			 =>  $flag

	    );



		$saveData = DB::table('master_valution_trans')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Valuation Transaction Successfully Added...!');
				return redirect('/finance/valuation-transaction-list');

			} else {

				$request->session()->flash('alert-error', 'Valuation Transaction Can Not Added...!');
				return redirect('/finance/valuation-transaction-list');

			}

	}
	
	public function ValuationTransMasterList(Request $request){

$CompanyCode = $request->session()->get('company_name');

if($request->ajax()){

		$user_type   = $request->session()->get('user_type');
		
		$userid      = $request->session()->get('userid');
		
		$CompanyCode = $request->session()->get('company_name');
		
		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    		
       	 	//DB::enableQueryLog();
       	 	 $data = DB::table('master_valution_trans')
            ->join('master_valuation','master_valution_trans.valuation_code', '=', 'master_valuation.valuation_code')
            ->join('master_transaction','master_valution_trans.tran_code','=','master_transaction.tran_code')
            ->join('master_config','master_valution_trans.series_code','=','master_config.series_code')
            ->select('master_valution_trans.*', 'master_valuation.valuation_name','master_transaction.tran_head','master_config.series_name')
            ->orderBy('id','DESC');
         
           //dd(DB::getQueryLog());

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	  $data = DB::table('master_valution_trans')
            ->join('master_valuation','master_valution_trans.valuation_code', '=', 'master_valuation.valuation_code')
            ->join('master_transaction','master_valution_trans.tran_code','=','master_transaction.tran_code')
            ->join('master_config','master_valution_trans.series_code','=','master_config.series_code')
            ->select('master_valution_trans.*', 'master_valuation.valuation_name','master_transaction.tran_head','master_config.series_name')
            ->orderBy('id','DESC');
            

    	}else{
    		
    	 $data = '';
    	}

    	return DataTables()->of($data)->addIndexColumn()->toJson();


    }

    	/*print_r($data);
    	exit;
*/
       $title = 'Valuation Transaction List';

       if(isset($CompanyCode)){

       return view('admin.finance.master.valuation_trans_list');
   }else{
		return redirect('/useractivity');
	}

    }


    public function EditValuationTrans($id,$btnControl){


    	$title = 'Edit Valuation Transaction';

    	//print_r($id);
    	$id = base64_decode($id);
    	$btnControl = base64_decode($btnControl);

    	if($id!=''){

			$query        = DB::table('master_valution_trans');
			$query->where('id', $id);
			$valTransData = $query->get()->first();
			
			$valuation_code = $valTransData->valuation_code;
			$tran_code      = $valTransData->tran_code;
			$series_code    = $valTransData->series_code;
			$drgl_code      = $valTransData->drgl_code;
			$crgl_code      = $valTransData->crgl_code;
			$valtran_block  = $valTransData->valtran_block;
			$idvaltrans     = $valTransData->id;

			$button ='Update';

			$action ='/finance/form-valution-trans-update';

			$userdata['valution_code'] = DB::table('master_valuation')->get();
	    	$userdata['transaction_code'] = DB::table('master_transaction')->get();
	    	$userdata['series_code_data'] = DB::table('master_config')->get();

			return view('admin.finance.master.valuation_trans',$userdata+compact('title','valuation_code','tran_code','series_code','drgl_code','crgl_code','valtran_block','idvaltrans','button','action'));
		}else{

			$request->session()->flash('alert-error', 'Valuation Tran Record Not Found...!');
			return redirect('/finance/valuation-transaction-list');

		}

    }

    public function ValuationTransMasterUpdate(Request $request){

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$validate = $this->validate($request, [

				'valution_code'    => 'required|max:11',
				'transaction_code' => 'required|max:2',
				'series_code'      => 'required|max:11',
				'drgl_code'        => 'required|max:11',
				'crgl_code'        => 'required|max:11',	
		]);

		$valtranBlock = 0;
		$flag = 1;

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$id = $request->input('idvaltrans');


		$data = array(
			"comp_name"         =>  $compName,
			"fiscal_year"       =>  $fisYear,
			"valuation_code"    =>  $request->input('valution_code'),
			"tran_code"         =>  $request->input('transaction_code'),
			"series_code"       =>  $request->input('series_code'),
			"drgl_code"         =>  $request->input('drgl_code'),
			"crgl_code"         =>  $request->input('crgl_code'),
			"last_updated_by"   =>  $request->session()->get('userid'),
			"last_updated_date" =>  $updatedDate,
			"valtran_block"     =>  $request->input('valtran_block'),
			"flag"              =>  $flag

	    );


		$UpdatedData = DB::table('master_valution_trans')->where('id', $id)->update($data);

			if ($UpdatedData) {

				$request->session()->flash('alert-success', 'Valuation Transaction Updated Successfully...!');
				return redirect('/finance/valuation-transaction-list');

			} else {

				$request->session()->flash('alert-error', 'Valuation Transaction Can Not Updated...!');
				return redirect('/finance/valuation-transaction-list');

			}

    }


     public function DeleteValuationTrans(Request $request){

        $id = $request->input('valTransId');

        if ($id!='') {

			$Delete = DB::table('master_valution_trans')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Valuation Trans. Record Was Deleted Successfully...!');
			return redirect('/finance/valuation-transaction-list');

			} else {

			$request->session()->flash('alert-error', 'Valuation Trans. Record Can Not Deleted...!');
			return redirect('/finance/valuation-transaction-list');

			}

		}else{

		$request->session()->flash('alert-error', 'Valuation Trans. Record Not Found...!');
		return redirect('/finance/valuation-transaction-list');

		}
	}


	

	public function HouseBankMast(Request $request){

        $title        ='Add Config Master';

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
    	$action='/finance/form-mast-config-save';
		//print_r($compData['comp_list']);exit;
		$transData['comp_list'] = DB::table('master_comp')->get();
		$transData['gl_list'] = DB::table('master_gl')->get();
		$transData['bank_list'] = DB::table('master_bank')->get();
		$transData['state_list'] = DB::table('master_state')->get();


	if(isset($compName)){

    	return view('admin.finance.master.house_bank_form',$transData+compact('title','tran_code','series_code','series_name','gl_code','config_block','config_id','button','action'));

    }else{

		return redirect('/useractivity');
	}


    }


 public function HouseBankFormSave(Request $request){

 	//print_r('hi');exit;

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');
    	

		$data = array(
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"comp_code"   => $request->input('comp_code'),
			"profit_code" => $request->input('profit_code'),
			"bank_code"   => $request->input('bank_name'),
			"gl_code"     => $request->input('gl_name'),
			"gl_name"     => $request->input('gl_code_name'),
			"bank_name"   => $request->input('bank_code_name'),
			"micr_code"   => $request->input('micr_code'),
			"ifs_code"    => $request->input('ifs_name'),
			"address1"   => $request->input('address1'),
			"address2"   => $request->input('address2'),
			"address3"   => $request->input('address3'),
			"phone1"     => $request->input('phone1'),
			"phone2"     => $request->input('phone2'),
			"fax"        => $request->input('fax'),
			"email"      => $request->input('email_id'),
			"country"    => $request->input('country'),
			"district"   => $request->input('district'),
			"state"      => $request->input('state'),
			"city"       => $request->input('city'),
			"pin"        => $request->input('pincode'),
			"country"    => $request->input('country'),
			"created_by"  => $createdBy,
			
		);

		$saveData = DB::table('master_house_bank')->insert($data);
		$lastid= DB::getPdo()->lastInsertId();

		if ($saveData) {

			$request->session()->flash('alert-success', 'House bank Was Successfully Added...!');
			return redirect('/finance/view-house-bank-mast');

		} else {

			$request->session()->flash('alert-error', 'Gl Bal Can Not Added...!');
			return redirect('/finance/view-house-bank-mast');

		}

	}

	public function HouseBankFormUpdate(Request $request){

	//	print_r('hi');exit;

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$HouseBankID = $request->input('updateid1');

    	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		//print_r($HouseBankID);exit;
		
		$data = array(
			"comp_name"    => $compName,
			"fiscal_year"  => $fisYear,
			"comp_code"   => $request->input('comp_code'),
			"profit_code" => $request->input('profit_code'),
			"bank_code"   => $request->input('bank_name'),
			"gl_code"     => $request->input('gl_name'),
			"gl_name"     => $request->input('gl_code_name'),
			"bank_name"   => $request->input('bank_code_name'),
			"micr_code"   => $request->input('micr_code'),
			"ifs_code"    => $request->input('ifs_name'),
			"address1"   => $request->input('address1'),
			"address2"   => $request->input('address2'),
			"address3"   => $request->input('address3'),
			"phone1"     => $request->input('phone1'),
			"phone2"     => $request->input('phone2'),
			"fax"        => $request->input('fax'),
			"email"      => $request->input('email_id'),
			"country"    => $request->input('country'),
			"district"   => $request->input('district'),
			"state"      => $request->input('state'),
			"city"       => $request->input('city'),
			"pin"        => $request->input('pincode'),
			"country"    => $request->input('country'),
			"updated_by"   => $createdBy,
			"updated_date" => $updatedDate,
			
		);

		$saveData = DB::table('master_house_bank')->where('id', $HouseBankID)->update($data);
		

		if ($saveData) {

			$request->session()->flash('alert-success', 'House bank Was Successfully Updated...!');
			return redirect('/finance/view-house-bank-mast');

		} else {

			$request->session()->flash('alert-error', 'House bank Was Successfully Updated...!');
			return redirect('/finance/view-house-bank-mast');

		}

	}


	public function HouseBankFormSave2(Request $request){

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");


		//print_r($request->post());exit;

    	
    	$lastid = $request->input('lastid');
    		
		$data1 = array(
	
			"address1"   => $request->input('address1'),
			"address2"   => $request->input('address2'),
			"address3"   => $request->input('address3'),
			"phone1"     => $request->input('phone1'),
			"phone2"     => $request->input('phone2'),
			"fax"        => $request->input('fax'),
			"email"      => $request->input('email_id'),
			"country"    => $request->input('country'),
			"district"   => $request->input('district'),
			"state"      => $request->input('state'),
			"city"       => $request->input('city'),
			"pin"        => $request->input('pincode'),
			"country"    => $request->input('country'),
			"created_by" => $createdBy,
			
		);

		$saveData = DB::table('master_house_bank')->where('id', $lastid)->update($data1);

		 if($saveData){

		  				$data2['message'] = 'Success';
		  				$data2['id'] = $lastid;
		  				$getalldata = json_encode($data2);  
		  				print_r($getalldata);

					}else{

						$data2['message'] = 'Error';
		  				$getalldata = json_encode($data2);  
		  				print_r($getalldata);

			}

	}



 public function ViewHouseBankMast(Request $request){

        $CompanyCode   = $request->session()->get('company_name');

    	if($request->ajax()) {

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    
           $data = DB::select("select a.id, a.comp_code, b.comp_name, a.gl_code, c.gl_name, a.city,a.profit_code,d.pfct_name from master_house_bank a, master_comp b, master_gl c, master_pfct d where a.comp_code=b.comp_code and a.gl_code=c.gl_code and a.profit_code=d.pfct_code ORDER By a.id DESC");

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	  $data = DB::select("select a.id, a.comp_code, b.comp_name, a.gl_code, c.gl_name, a.city,a.profit_code,d.pfct_name from master_house_bank a, master_comp b, master_gl c, master_pfct d where a.comp_code=b.comp_code and a.gl_code=c.gl_code and a.profit_code=d.pfct_code ORDER By a.id DESC");

    	}else{
    		
    	 $data ='';
    	}

		return DataTables()->of($data)->addIndexColumn()->toJson();
    	

       }
       if(isset($CompanyCode)){
       return view('admin.finance.master.view_house_bank'); 	
       }else{
		return redirect('/useractivity');
	   }
       
    }


   public function EditHouseBankMast(Request $request,$id,$btnControl){


    	$id = base64_decode($id);

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	

    	if($id!=''){
    	    $query = DB::table('master_house_bank');
			$query->where('id', $id);
			$bankData['bank_data'] = $query->get()->first();

			//print_r($bankData['bank_data']);exit;

			$bankData['comp_list'] = DB::table('master_comp')->get();
			$bankData['gl_list']   = DB::table('master_gl')->get();
			$bankData['bank_list'] = DB::table('master_bank')->get();


		    return view('admin.finance.master.edit_house_bank_form',$bankData);
			
			//print_r($deptData['dept_list']);exit;
		}else{
			$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('/finance/view-department-mast');
		}


       
    }

    



/*House Bank Master*/



/*ACC BAL Master*/

public function AccBalMast(Request $request){

		$title        ='Add Item Rack Master';

		$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');


    	$button='Save';
    	$action='/finance/form-acc-bal-save';
		//print_r($compData['comp_list']);exit;
		$data['comp_list'] = DB::table('master_comp')->get();
		$data['fy_list']   = DB::table('master_fy')->get();
		$data['pfct_list'] = DB::table('master_pfct')->get();

		$data['acc_list']  = DB::table('master_party')->get();
	//print_r($data['comp_list']);exit;

		

	if(isset($compName)){

    	return view('admin.finance.master.acc_bal_form',$data+compact('title','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function AccBalFormSave(Request $request){


    	//print_r($request->post());exit;


		$validate = $this->validate($request, [

			'comp_code' => 'required',
			'fy_code'   => 'required',
			'pfct_code' => 'required',
			'acc_code'  => 'required',
			'vrDate'    => 'required',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	//print_r($request->input('item_code'));exit;

    	$transDate = date("Y-m-d", strtotime($request->input('vrDate')));

		$data = array(
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"comp_code"   => $request->input('comp_code'),
			"fy_year"     => $request->input('fy_code'),
			"pfct_code"   => $request->input('pfct_code'),
			"acc_code"    => $request->input('acc_code'),
			"vr_date"     => $transDate,
			"yropdr"      => $request->input('pdr_code'),
			"yropcr"      => $request->input('pcr_code'),
			"reference"   => $request->input('reference'),
			"created_by"  => $createdBy,
			
		);

		$data_acledg = array(
			"company_code"    => $request->input('comp_code'),
			"fy_code"         => $request->input('fy_code'),
			"vr_date"         => $transDate,
			"vr_no"           => null,
			"trans_code"      => null,
			"acc_code"        => $request->input('acc_code'),
			"acc_name"        => $request->input('acc_name'),
			"acc_class"       => $request->input('accclass_code'),
			"acc_type"        => $request->input('acctype_code'),
			"series_code"     => null,
			"pfct_code"       => $request->input('pfct_code'),
			"cr_amt"          => $request->input('pcr_code'),
			"dr_amt"          => $request->input('pdr_code'),
			"instrument_type" => null,
			"instrument_no"   => null,
			"particular"      => $request->input('reference'),
			"created_by"      => $createdBy,
			
		);

		$saveData = DB::table('master_acc_bal')->insert($data);
		$saveData = DB::table('ledger_tran')->insert($data_acledg);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Acc Bal Was Successfully Added...!');
			return redirect('/finance/view-acc-bal-mast');

		} else {

			$request->session()->flash('alert-error', 'Acc Bal Can Not Added...!');
			return redirect('/finance/view-acc-bal-mast');

		}

	}

	public function EditAccBalMast(Request $request,$id,$btnControl){

    	$title = 'Edit Master Department';

    	//print_r($id);
    	$id = base64_decode($id);
    	$btnControl = base64_decode($btnControl);

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');



    	if($id!=''){
    	    $query = DB::table('master_acc_bal');
			$query->where('id', $id);
			$accbalData['accbal_list'] = $query->get()->first();


			$button='Save';
    	    $action='/finance/form-mast-acc-bal-update';

		   $accbalData['comp_list'] = DB::table('master_comp')->get();
		   $accbalData['fy_list']   = DB::table('master_fy')->get();
		   $accbalData['pfct_list'] = DB::table('master_pfct')->get();
		   $accbalData['acc_list']   = DB::table('master_party')->get();
			//print_r($userData['transaction_list']);exit;
			return view('admin.finance.master.edit_acc_bal_form', $accbalData+compact('title','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('/finance/view-gl-bal-mastt');
		}

    }
	 


    public function AccBalFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'comp_code' => 'required',
			'fy_code'   => 'required',
			'pfct_code' => 'required',
			'acc_code'  => 'required',

		]);

		$accbal_id = $request->input('accbal_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$transDate = date("Y-m-d", strtotime($request->input('vrDate')));

    	$data = array(
			"comp_name"     => $compName,
			"fiscal_year"   => $fisYear,
			"comp_code"     => $request->input('comp_code'),
			"fy_year"       => $request->input('fy_code'),
			"pfct_code"     => $request->input('pfct_code'),
			"acc_code"      => $request->input('acc_code'),
			"yropdr"        => $request->input('pdr_code'),
			"yropcr"        => $request->input('pcr_code'),
			"vr_date"       => $transDate,
			"reference"     => $request->input('reference'),
			"acc_bal_block" => $request->input('acc_bal_block'),
			"updated_by"    => $createdBy,
			"updated_by"    => $updatedDate,
			
		);



	$saveData = DB::table('master_acc_bal')->where('id', $accbal_id)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Acc Bal Was Successfully Updated...!');
			return redirect('/finance/view-acc-bal-mast');

		} else {

			$request->session()->flash('alert-error', 'Acc Bal Can Not Added...!');
			return redirect('/finance/view-acc-bal-mast');

		}

	}

	public function ViewAccBalMast(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()){


    	$title = 'View Rack Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	/*$itemrackData['item_rack'] = DB::table('master_item_rack')->orderBy('id','DESC')->get();*/

    	$data = DB::table('master_acc_bal')
            ->join('master_comp', 'master_acc_bal.comp_code', '=', 'master_comp.comp_code')
            ->join('master_pfct', 'master_acc_bal.pfct_code', '=', 'master_pfct.pfct_code')
            ->join('master_party', 'master_acc_bal.acc_code', '=', 'master_party.acc_code')
            ->select('master_acc_bal.*', 'master_comp.comp_name as cmp_name','master_pfct.pfct_name','master_party.acc_name')
            ->orderBy('id','DESC');

    	//print_r($glbalData['gl_bal']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    	$data = DB::table('master_acc_bal')
            ->join('master_comp', 'master_acc_bal.comp_code', '=', 'master_comp.comp_code')
            ->join('master_pfct', 'master_acc_bal.pfct_code', '=', 'master_pfct.pfct_code')
            ->join('master_party', 'master_acc_bal.acc_code', '=', 'master_party.acc_code')
            ->select('master_acc_bal.*', 'master_comp.comp_name as cmp_name','master_pfct.pfct_name','master_party.acc_name')
            ->orderBy('id','DESC');

    	}
    	else{
    		$data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->toJson();

    }
    	if(isset($compName)){

    	return view('admin.finance.master.view_acc_bal');
    }else{
		return redirect('/useractivity');
	   }
    }


    public function DeleteAccBal(Request $request){

		$accbalId = $request->post('accbalId');
    	

    	if ($accbalId!='') {
    		
    		$Delete = DB::table('master_acc_bal')->where('id', $accbalId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Acc Bal Was Deleted Successfully...!');
				return redirect('/finance/view-acc-bal-mast');

			} else {

				$request->session()->flash('alert-error', 'Acc Bal Can Not Deleted...!');
				return redirect('/finance/view-acc-bal-mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Acc Bal Not Found...!');
			return redirect('/finance/view-acc-bal-mast');

    	}

	}
/*ACC BAL Master*/

 public function GetYear(Request $request){

    	 $cmp_code = $request->post('comp_code');
    	// print_r($cmp_code);exit();

    	//$explode = explode('-', $cmp_code);

    	//$getcom_code = $explode[0];

    	$fisYear  =  $request->session()->get('macc_year');

    	$getyear = DB::table('master_fy')->where('comp_code',$cmp_code)->get();
    	//print_r($getyear);exit;

      
      if(!empty($getyear))
      {
        $response = '<option value="">Select Year</option>';
        foreach ($getyear as $row) 
        {	

          $response .= '<option value="'.$row->fy_code.'">'.$row->fy_code.'</option>';
        }
      }
      else
      {
        $response = '<option value="">Select Year</option>';
      }
      echo $response;exit; 

    }



 public function GetTranHead(Request $request){

    	 $tran_code = $request->post('tran_code');
    	 //print_r($cmp_name);exit();

     if ($tran_code){

	    	$gettranhead= DB::table('TRANSACTION_CODE')->where('tran_code',$tran_code)->get()->first();
	    	//print_r($gettranhead);exit;
	    	
    		if ($gettranhead) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $gettranhead ;

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


/*---- start Bank Master -----*/

	public function BankMaster(Request $request){

		$title = 'Add Bank';

		$compName 	= $request->session()->get('company_name');

		$bank_code  = $request->old('bank_code');
		$bank_name  = $request->old('bank_name');
		$bank_block = $request->old('bank_block');
		$bank_id    = $request->old('bank_id');

		$userData['bank_mst_list'] = DB::table('MASTER_BANK')->Orderby('BANK_CODE', 'desc')->limit(5)->get();

		$button='Save';

    	$action='/form-bank-mast-save';

	
		if(isset($compName)){

	    	return view('admin.finance.master.houseCaskBank.bank_mast',$userData+compact('title','bank_code','bank_name','bank_block','bank_id','action','button'));

	    }else{

			return redirect('/useractivity');
		}

	}


	public function SaveBankMast(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$validate = $this->validate($request, [

				'bank_code'      => 'required|max:6|unique:MASTER_BANK,BANK_CODE',
				'bank_name'      => 'required|max:40',
		]);

		$data = array(

					"BANK_CODE"     =>  $request->input('bank_code'),
					"BANK_NAME"     =>  $request->input('bank_name'),
					"CREATED_BY"    =>  $request->session()->get('userid')	
	    );

		$saveData = DB::table('MASTER_BANK')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Bank Was Successfully Added...!');
			return redirect('/Master/House-Bank-Cash/View-Bank-Mast');

		} else {

			$request->session()->flash('alert-error', 'Bank Can Not Added...!');
			return redirect('/Master/House-Bank-Cash/View-Bank-Mast');

		}

	}


	public function ViewBankMast(Request $request){

		$compName = $request->session()->get('company_name');

  		if($request->ajax()){

       		$title = 'View Bank';

    		$userid	= $request->session()->get('userid');

    		$userType = $request->session()->get('usertype');

    		$compName = $request->session()->get('company_name');

    		$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_BANK')->orderBy('BANK_CODE','DESC');

	    	//print_r($valData['val_list']);exit;
	    	}elseif ($userType=='superAdmin' || $userType=='user') {

    			$data = DB::table('MASTER_BANK')->orderBy('BANK_CODE','DESC');
    		}else{
    			$data ='';
    		}

    		return DataTables()->of($data)->addIndexColumn()->toJson();
   	 	}
		if(isset($compName)){
		   return view('admin.finance.master.houseCaskBank.view_bank_mast');	
		}else{
			return redirect('/useractivity');
	   	}

    }


    public function DeleteBankMast(Request $request){

        $bankcode = $request->input('bankid');
       // print_r($bankcode);exit;
        if ($bankcode!='') {

        	try{

				$Delete = DB::table('MASTER_BANK')->where('BANK_CODE',$bankcode)->delete();

				if($Delete) {

					$request->session()->flash('alert-success', 'Bank Data Was Deleted Successfully...!');
				return redirect('/Master/House-Bank-Cash/View-Bank-Mast');

				} else {

					$request->session()->flash('alert-error', 'Bank Data Can Not Deleted...!');
				return redirect('/Master/House-Bank-Cash/View-Bank-Mast');

				}
			}
			catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Bank Data be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/House-Bank-Cash/View-Bank-Mast');
			}

		}else{

			$request->session()->flash('alert-error', 'Bank Data Not Found...!');
			return redirect('/Master/House-Bank-Cash/View-Bank-Mast');

		}
	}


	public function EditBankMast($bankcode){

    	$title = 'Edit Bank';
    	//print_r($id);
    	$bankcode = base64_decode($bankcode);
    	//$btnControl = base64_decode($btnControl);

    	if($bankcode!=''){
    	    $query = DB::table('MASTER_BANK');
			$query->where('BANK_CODE', $bankcode);
			$classData= $query->get()->first();
			
			$bank_code  = $classData->BANK_CODE;
			$bank_name  = $classData->BANK_NAME;
			$bank_block = $classData->BANK_BLOCK;
			$bank_id    = $classData->BANK_CODE;

			$button='Update';
			$action='/form-bank-mast-update';

			return view('admin.finance.master.houseCaskBank.bank_mast',compact('title','bank_code','bank_name','bank_block','bank_id','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Bank Data Not Found...!');
			return redirect('/Master/House-Bank-Cash/View-Bank-Mast');
		}

    }

    public function UpdateBankMast(Request $request){

		$validate = $this->validate($request, [

				'bank_code'  => 'required|max:6',
				'bank_name'  => 'required|max:40',
				'bank_block' => 'required',
		]);

        $bankcode = $request->input('idbank');

        $updatedDate = date('Y-m-d');

		$data = array(
				"BANK_CODE"        =>  $request->input('bank_code'),
				"BANK_NAME"        =>  $request->input('bank_name'),
				"BANK_BLOCK"       =>  $request->input('bank_block'),
				"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
				"LAST_UPDATE_DATE" =>  $updatedDate
	 
	    	);
		try{

			$saveData = DB::table('MASTER_BANK')->where('BANK_CODE', $bankcode)->update($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Bank Data Was Successfully Updated...!');
				return redirect('/Master/House-Bank-Cash/View-Bank-Mast');

			} else {

				$request->session()->flash('alert-error', 'Bank Data Can Not Updated...!');
				return redirect('/Master/House-Bank-Cash/View-Bank-Mast');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Bank Data be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/House-Bank-Cash/View-Bank-Mast');
		}

	}

	/*search Bank code when click on help button*/
	
	public function HelpBankCodeGet(Request $request){

		$response_array = array();

	    $BankCodeHelp = $request->input('BankCodeHelp');

		if ($request->ajax()) {

	    	$bank_code_by_help = DB::select("SELECT * FROM `MASTER_BANK` WHERE BANK_CODE='$BankCodeHelp' OR BANK_NAME='$BankCodeHelp' OR BANK_CODE Like '$BankCodeHelp%' OR BANK_NAME LIKE '$BankCodeHelp%' ORDER BY BANK_CODE DESC limit 5  ");
	    	
    		if ($bank_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $bank_code_by_help ;

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

	/*search Bank code code when click on help button*/

	/*search Bank code code on input*/

	public function search_BankCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$bankCodeSearch = $request->input('bankCodeSearch');

	    	$BankCode_list = DB::select("SELECT * FROM `MASTER_BANK` WHERE BANK_CODE LIKE '$bankCodeSearch%'");

	    	$count = count($BankCode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $BankCode_list ;

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

	/*search Bank code code on input*/

/* ---- end Bank Master ----*/


/*Acc Category Master*/

	public function AccCategory(Request $request){

		$title = 'Add Acc Category';

		$compName 	= $request->session()->get('company_name');

		$acc_category_code  = $request->old('acc_category_code');
		$acc_category_name  = $request->old('acc_category_name');
		$category_block  = $request->old('category_block');
		$category_id   = $request->old('category_id');

		$userData['AccCat_mst_list'] = DB::table('master_acc_category')->Orderby('acc_category_code', 'desc')->limit(5)->get();

		$button='Save';

    	$action='/form-acc-category-save';

		

	if(isset($compName)){

    	return view('admin.finance.master.acc_category',$userData+compact('title','acc_category_code','acc_category_name','category_block','category_id','action','button'));

    }else{

		return redirect('/useractivity');
	}

	}


	public function SaveAccCategory(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$validate = $this->validate($request, [

				'acc_category_code'      => 'required|max:12|unique:master_acc_category,acc_category_code',
				'acc_category_name'      => 'required|max:40',
		]);

		$accCateData = DB::table('master_acc_category')->orderBy('id', 'DESC')->first();
    	if(!empty($accCateData)){

    		$getID= $accCateData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(

					"id"                =>  $id,
					"acc_category_code" =>  $request->input('acc_category_code'),
					"acc_category_name" =>  $request->input('acc_category_name'),
					"created_by"        =>  $request->session()->get('userid'),
					"comp_name"         =>  $compName,
					"fiscal_year"       =>  $fisYear	
	    	);

		$saveData = DB::table('master_acc_category')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Acc Category Data Was Successfully Added...!');
				return redirect('/finance/view-acc-category');

			} else {

				$request->session()->flash('alert-error', 'Acc Category Data Can Not Added...!');
				return redirect('/finance/view-acc-category');

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
    
       	 $data = DB::table('master_acc_category')->orderBy('id','DESC');

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 $data = DB::table('master_acc_category')->orderBy('id','DESC');
    	}else{
    		
    	 $data ='';
    	}

		return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
    	

       }

       if(isset($CompanyCode)){
       return view('admin.finance.master.view_acc_category');

   }else{
		return redirect('/useractivity');
	   }

    }


    public function DeleteAccCat(Request $request){

        $accCate = $request->input('acccatid');
        if ($accCate!='') {
       
       try{

			$Delete = DB::table('master_acc_category')->where('acc_category_code', $accCate)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Acc Category Data Was Deleted Successfully...!');
			return redirect('/finance/view-acc-category');

			} else {

			$request->session()->flash('alert-error', 'Acc Category Data Can Not Deleted...!');
			return redirect('/finance/view-acc-category');

			}

		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Acc Category be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-acc-category');
			}
	}
	else{

		$request->session()->flash('alert-error', 'Acc Category Data Not Found...!');
		return redirect('/finance/view-acc-category');

		}
	}


	public function EditAccCategory($accCate){

    	$title = 'Edit Acc Category';

    	//print_r($id);
    	$accCate = base64_decode($accCate);

    	if($accCate!=''){
    	    $query = DB::table('master_acc_category');
			$query->where('acc_category_code', $accCate);
			$classData= $query->get()->first();
			
			$acc_category_code = $classData->acc_category_code;
			$acc_category_name = $classData->acc_category_name;
			$category_block    = $classData->category_block;
			$category_id       = $classData->id;

			$button='Update';
			$action='/form-acc-category-update';

			return view('admin.finance.master.acc_category',compact('title','acc_category_code','acc_category_name','category_block','category_id','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Acc Category Data Not Found...!');
			return redirect('/finance/view-acc-category');
		}

    }


    public function UpdateAccCategory(Request $request){

		$validate = $this->validate($request, [

				'acc_category_code' => 'required|max:11',
				'acc_category_name' => 'required|max:40',
				'category_block'    => 'required',
		]);

       $id = $request->input('idcategory');
       $updatedDate = date('Y-m-d');

		$data = array(
				"acc_category_code" =>  $request->input('acc_category_code'),
				"acc_category_name" =>  $request->input('acc_category_name'),
				"category_block"    =>  $request->input('category_block'),
				"last_updat_by"     =>  $request->session()->get('userid'),
				"last_updat_date"   =>  $updatedDate
	 
	    	);

try{
		$saveData = DB::table('master_acc_category')->where('id', $id)->update($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Acc Category Data Was Successfully Updated...!');
				return redirect('/finance/view-acc-category');

			} else {

				$request->session()->flash('alert-error', 'Acc Category Data Can Not Updated...!');
				return redirect('/finance/view-acc-category');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Acc Category be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-acc-category');
			}


	}


/*Acc Category Master*/


/*house cash master*/


	public function HouseCash(Request $request){

		$title        ='Add House Cash Master';

		$compName 	= $request->session()->get('company_name');
		
		$company_code = $request->old('company_code');
		$pfct_code    = $request->old('pfct_code');
		$cash_code    = $request->old('cash_code');
		$gl_code      = $request->old('gl_code');
		$houscash_id  = $request->old('houscash_id');
		$house_block  = $request->old('house_block');

		$button ='Save';
		$action ='/form-house-cash-save';
		
		$userdata['comp_list']  = DB::table('master_comp')->get();
		$userdata['pfct_list']  = DB::table('master_pfct')->get();
		$userdata['glmst_list'] = DB::table('master_gl')->get();
		$userdata['help_cash_list'] = DB::table('master_housecash')->Orderby('cash_code', 'desc')->limit(5)->get();


	if(isset($compName)){

    	return view('admin.finance.master.house_cash_form',$userdata+compact('title','company_code','pfct_code','cash_code','gl_code','house_block','houscash_id','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 


    public function HouseCashSave(Request $request){


		$validate = $this->validate($request, [

			'company_code' => 'required|max:11',
			'pfct_code'    => 'required|max:11',
			'cash_code'    => 'required|max:11|unique:master_housecash,cash_code',
			'gl_code'      => 'required|max:11',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(

			"company_code" => $request->input('company_code'),
			"pfct_code"    => $request->input('pfct_code'),
			"cash_code"    => $request->input('cash_code'),
			"gl_code"      => $request->input('gl_code'),
			"gl_name"      => $request->input('gl_code_name'),
			"bank_name"    => 'CASH',
			"created_by"   => $createdBy,
			"comp_name"    => $compName,
			"fiscal_year"  => $fisYear,
			
		);

		$saveData = DB::table('master_housecash')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'House Cash Was Successfully Added...!');
			return redirect('/finance/view-house-cash');

		} else {

			$request->session()->flash('alert-error', 'House Cash Can Not Added...!');
			return redirect('/finance/view-house-cash');

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

    	$data= DB::table('master_housecash')
    		->join('master_comp','master_housecash.company_code','=','master_comp.comp_code')
    		->join('master_pfct','master_housecash.pfct_code','=','master_pfct.pfct_code')
    		->select('master_housecash.*','master_comp.comp_name as company_name','master_pfct.pfct_name')
    		->orderBy('id','DESC');
    		

    	//print_r($valData['val_list']);exit;AccClassFormSave
    	}else if ($userType=='superAdmin' || $userType=='user') {    		

    		$data = DB::table('master_housecash')
    		->join('master_comp','master_housecash.company_code','=','master_comp.comp_code')
    		->join('master_pfct','master_housecash.pfct_code','=','master_pfct.pfct_code')
    		->select('master_housecash.*','master_comp.comp_name as company_name','master_pfct.pfct_name')
    		->orderBy('id','DESC');
    		
    	}
    	else{
    		$data='';
    	}
    	return DataTables()->of($data)->addIndexColumn()->toJson();

    }
    	if(isset($compName)){
    	return view('admin.finance.master.view_house_cash');
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
    	    $query = DB::table('master_housecash');
			$query->where('cash_code', $cashCode);
			$classData= $query->get()->first();

			$company_code = $classData->company_code;
			$pfct_code    = $classData->pfct_code;
			$cash_code    = $classData->cash_code;
			$gl_code      = $classData->gl_code;
			$houscash_id  = $classData->cash_code;
			$house_block  = $classData->house_block;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/form-house-cash-update';

			$userdata['comp_list']  = DB::table('master_comp')->get();
			$userdata['pfct_list']  = DB::table('master_pfct')->get();
			$userdata['glmst_list'] = DB::table('master_gl')->get();

			return view('admin.finance.master.house_cash_form',$userdata+compact('title','company_code','pfct_code','cash_code','gl_code','houscash_id','house_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'House Cash Not Found...!');
			return redirect('/finance/view-house-cash');
		}

    }


    public function HouseCashUpdate(Request $request){

		$validate = $this->validate($request, [

			'company_code' => 'required|max:11',
			'pfct_code'    => 'required|max:11',
			'cash_code'    => 'required|max:11',
			'gl_code'      => 'required|max:11',

		]);

		$cashcode = $request->input('idhousecash');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"company_code"    => $request->input('company_code'),
			"pfct_code"       => $request->input('pfct_code'),
			"cash_code"       => $request->input('cash_code'),
			"gl_code"         => $request->input('gl_code'),
			"house_block"     => $request->input('house_block'),
			"last_updat_by"   => $createdBy,
			"last_updat_date" => $updatedDate,
			
		);

	$saveData = DB::table('master_housecash')->where('cash_code', $cashcode)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'House Cash Was Successfully Updated...!');
			return redirect('/finance/view-house-cash');

		} else {

			$request->session()->flash('alert-error', 'House Cash Can Not Added...!');
			return redirect('/finance/view-house-cash');

		}

	}

	public function DeleteHouseCash(Request $request){

		$cashcode = $request->post('houseId');
    	

    	if ($cashcode!='') {
    		
    		$Delete = DB::table('master_housecash')->where('cash_code', $cashcode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'House Cash Was Deleted Successfully...!');
				return redirect('/finance/view-house-cash');

			} else {

				$request->session()->flash('alert-error', 'House Cash Can Not Deleted...!');
				return redirect('/finance/view-house-cash');

			}

    	}else{

    		$request->session()->flash('alert-error', 'House Cash  Not Found...!');
			return redirect('/finance/view-house-cash');

    	}

	}


/*house cash master*/





/*COST TYPE Master*/

    public function CostTypeMast(Request $request){

		$title        ='Add Cost Type Master';

		$compName 	= $request->session()->get('company_name');
		
		$cost_type_code  = $request->old('cost_type_code');
		$cost_type_name  = $request->old('cost_type_name');
		$cost_type_id    = $request->old('cost_type_id');
		$cost_type_block = $request->old('cost_type_block');

		$userData['costype_list'] = DB::table('master_cost_type')->Orderby('cost_type_code', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/finance/form-mast-cost-type-save';
	
		

	if(isset($compName)){

    	return view('admin.finance.master.cost_type_form',$userData+compact('title','cost_type_code','cost_type_name','cost_type_id','cost_type_block','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function CostTypeFormSave(Request $request){


		$validate = $this->validate($request, [

			'cost_type_code' => 'required|max:11|unique:master_cost_type,cost_type_code',
			'cost_type_name' => 'required|max:40',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$costTypeData = DB::table('master_cost_type')->orderBy('id', 'DESC')->first();
    	if(!empty($costTypeData)){

    		$getID= $costTypeData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(
			"id"          => $id,
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"cost_type_code"   => $request->input('cost_type_code'),
			"cost_type_name"   => $request->input('cost_type_name'),
			"created_by"  => $createdBy,
			
		);

		$saveData = DB::table('master_cost_type')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Type Was Successfully Added...!');
			return redirect('/finance/view-cost-type-mast');

		} else {

			$request->session()->flash('alert-error', 'Cost Type Can Not Added...!');
			return redirect('/finance/view-cost-type-mast');

		}

	}
	 public function EditCostTypeMast($id){

    	$title = 'Edit Cost Type Master';

    	//print_r($id);
    	$costtype = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);


    	if($costtype!=''){
    	    $query = DB::table('master_cost_type');
			$query->where('cost_type_code', $costtype);
			$classData= $query->get()->first();

			$cost_type_code  = $classData->cost_type_code;
			$cost_type_name  = $classData->cost_type_name;
			$cost_type_id    = $classData->cost_type_code;
			$cost_type_block = $classData->cost_type_block;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/finance/form-mast-cost-type-update';

			return view('admin.finance.master.cost_type_form',compact('title','cost_type_code','cost_type_name','cost_type_id','cost_type_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Cost Type Not Found...!');
			return redirect('/finance/view-cost-type-mast');
		}

    }


    public function CostTypeFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'cost_type_code' => 'required|max:11',
			'cost_type_name' => 'required|max:40',

		]);

		$cost_typecode = $request->input('cost_type_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"cost_type_code"  => $request->input('cost_type_code'),
			"cost_type_name"  => $request->input('cost_type_name'),
			"cost_type_block" => $request->input('cost_type_block'),
			"updated_by"      => $createdBy,
			"updated_date"      => $updatedDate,
			
		);

try{
	$saveData = DB::table('master_cost_type')->where('cost_type_code', $cost_typecode)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Type Was Successfully Updated...!');
			return redirect('/finance/view-cost-type-mast');

		} else {

			$request->session()->flash('alert-error', 'Cost Type Can Not Added...!');
			return redirect('/finance/view-cost-type-mast');

		}
	}
	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Type be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-cost-type-mast');
			}

	}

	public function ViewCostTypeMast(Request $request){

	$compName = $request->session()->get('company_name');

	if($request->ajax()){


    	$title = 'View Cost Type Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data  = DB::table('master_cost_type')->orderBy('id','DESC');

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    	$data = DB::table('master_cost_type')->orderBy('id','DESC');
    	}
    	else{
    		$data ='';
    	}


    return DataTables()->of($data)->addIndexColumn()->toJson();
}
if(isset($compName)){

    	return view('admin.finance.master.view_cost_type');
}else{
		return redirect('/useractivity');
	   }


    }


    public function DeleteCostType(Request $request){

		$costTypeCode = $request->post('costTypeId');
    	

    	if ($costTypeCode!='') {

    		try{
    		
    		$Delete = DB::table('master_cost_type')->where('cost_type_code', $costTypeCode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Acc Cost Was Deleted Successfully...!');
				return redirect('/finance/view-cost-type-mast');

			} else {

				$request->session()->flash('alert-error', 'Acc Cost Can Not Deleted...!');
				return redirect('/finance/view-cost-type-mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Type be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-cost-type-mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Acc Cost Not Found...!');
			return redirect('/finance/view-cost-type-mast');

    	}

	}

/*COST TYPE Master*/
 
/* Start COST Group Master*/

public function CostGroupMast(Request $request){

		$title        ='Add Cost Group Master';

		$compName 	= $request->session()->get('company_name');
		
		$cost_group_code  = $request->old('cost_group_code');
		$cost_group_name  = $request->old('cost_group_name');
		$cost_group_id    = $request->old('cost_group_id');
		$cost_group_block = $request->old('cost_group_block');
		$cost_type_code   = $request->old('cost_type_code');

		$cost_type = DB::table('master_cost_type')->get();

		$userData['cost_group_list'] = DB::table('master_cost_group')->Orderby('cost_group_code', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/finance/form-mast-cost-group-save';
		

	if(isset($compName)){

    	return view('admin.finance.master.cost_group_form',$userData+compact('title','cost_group_code','cost_group_name','cost_type_code','cost_type','cost_group_id','cost_group_block','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function CostGroupFormSave(Request $request){


		$validate = $this->validate($request, [
			
			'cost_group_code' => 'required|max:11|unique:master_cost_group,cost_group_code',
			'cost_group_name' => 'required|max:40',
			'cost_type_code'  => 'required|max:11',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$costGroupData = DB::table('master_cost_group')->orderBy('id', 'DESC')->first();
    	if(!empty($costGroupData)){

    		$getID= $costGroupData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(
			"id"              => $id,
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"cost_group_code" => $request->input('cost_group_code'),
			"cost_group_name" => $request->input('cost_group_name'),
			"cost_type_code"  => $request->input('cost_type_code'),
			"created_by"      => $createdBy,
			
		);

		$saveData = DB::table('master_cost_group')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Group Was Successfully Added...!');
			return redirect('/finance/view-cost-group-mast');

		} else {

			$request->session()->flash('alert-error', 'Cost Group Can Not Added...!');
			return redirect('/finance/view-cost-group-mast');

		}

	}
	 public function EditCostGroupMast($groupcode){

    	$title = 'Edit Cost Group Master';

    	//print_r($id);
    	$groupcode = base64_decode($groupcode);


    	if($groupcode!=''){
    	    $query = DB::table('master_cost_group');
			$query->where('cost_group_code', $groupcode);
			$classData= $query->get()->first();

			$cost_group_code  = $classData->cost_group_code;
			$cost_group_name  = $classData->cost_group_name;
			$cost_type_code  = $classData->cost_type_code;
			$cost_group_id    = $classData->cost_group_code;
			$cost_group_block = $classData->cost_group_block;

			$cost_type = DB::table('master_cost_type')->get();
			//print_r($rack_block);exit;

			$button='Update';
			$action='/finance/form-mast-cost-group-update';

			return view('admin.finance.master.cost_group_form',compact('title','cost_group_code','cost_group_name','cost_type_code','cost_group_id','cost_group_block','cost_type','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Cost Group Not Found...!');
			return redirect('/finance/view-cost-group-mast');
		}

    }


    public function CostGroupFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'cost_group_code' => 'required',
			'cost_group_name' => 'required',
			'cost_type_code'  => 'required',


		]);

		$cost_groupcode = $request->input('cost_group_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"        => $compName,
			"fiscal_year"      => $fisYear,
			"cost_group_code"  => $request->input('cost_group_code'),
			"cost_group_name"  => $request->input('cost_group_name'),
			"cost_group_block" => $request->input('cost_group_block'),
			"cost_type_code"   => $request->input('cost_type_code'),
			"updated_by"       => $createdBy,
			"updated_date"       => $updatedDate,
			
		);

try{
	$saveData = DB::table('master_cost_group')->where('cost_group_code', $cost_groupcode)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Group Was Successfully Updated...!');
			return redirect('/finance/view-cost-group-mast');

		} else {

			$request->session()->flash('alert-error', 'Cost Group Can Not Added...!');
			return redirect('/finance/view-cost-group-mast');

		}
	}
	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Group be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-cost-group-mast');
			}

	}

	public function ViewCostGroupMast(Request $request){

	$compName = $request->session()->get('company_name');

	if($request->ajax()){


    	$title = 'View Cost Group Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data = DB::table('master_cost_group')->orderBy('id','DESC');

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$data = DB::table('master_cost_group')->orderBy('id','DESC');
    	}
    	else{
    		$data ='';
    	}

    		 return DataTables()->of($data)->addIndexColumn()->toJson();
}
	if(isset($compName)){
    	return view('admin.finance.master.view_cost_group');
	}else{
		return redirect('/useractivity');
	   }
    }


    public function DeleteCostGroup(Request $request){

		$costGroupCode = $request->post('costGroupId');
    	

    	if ($costGroupCode!='') {
    		try{
    		
    		$Delete = DB::table('master_cost_group')->where('cost_group_code', $costGroupCode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Cost Group Was Deleted Successfully...!');
				return redirect('/finance/view-cost-group-mast');

			} else {

				$request->session()->flash('alert-error', 'Cost Group Can Not Deleted...!');
				return redirect('/finance/view-cost-group-mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Group be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-cost-group-mast');
			}


    	}else{

    		$request->session()->flash('alert-error', 'Cost Group Not Found...!');
			return redirect('/finance/view-cost-group-mast');

    	}

	}

/*COST Group Master*/


 public function CostClassMast(Request $request){

		$title        ='Add Cost Class Master';

		$compName 	= $request->session()->get('company_name');
		
		$cost_class_code  = $request->old('cost_class_code');
		$cost_class_name  = $request->old('cost_class_name');
		$cost_class_id    = $request->old('cost_class_id');
		$cost_class_block = $request->old('cost_class_block');

		$userData['costcls_mst_list'] = DB::table('master_cost_class')->Orderby('cost_class_code', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/finance/form-mast-cost-class-save';
		

	if(isset($compName)){

    	return view('admin.finance.master.cost_class_form',$userData+compact('title','cost_class_code','cost_class_name','cost_class_id','cost_class_block','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function CostClassFormSave(Request $request){


		$validate = $this->validate($request, [

			'cost_class_code' => 'required|max:11|unique:master_cost_class,cost_class_code',
			'cost_class_name' => 'required|max:40',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$costClassData = DB::table('master_cost_class')->orderBy('id', 'DESC')->first();
    	if(!empty($costClassData)){

    		$getID= $costClassData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(
			"id"          => $id,
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"cost_class_code"   => $request->input('cost_class_code'),
			"cost_class_name"   => $request->input('cost_class_name'),
			"created_by"  => $createdBy,
			
		);

		$saveData = DB::table('master_cost_class')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Class Was Successfully Added...!');
			return redirect('/finance/view-cost-class-mast');

		} else {

			$request->session()->flash('alert-error', 'Cost Class Can Not Added...!');
			return redirect('/finance/view-cost-class-mast');

		}

	}
	 public function EditCostClassMast($costClass){

    	$title = 'Edit Cost Class Master';

    	//print_r($id);
    	$costClass = base64_decode($costClass);
    	//$btnControl= base64_decode($btnControl);


    	if($costClass!=''){
    	    $query = DB::table('master_cost_class');
			$query->where('cost_class_code', $costClass);
			$classData= $query->get()->first();

			$cost_class_code  = $classData->cost_class_code;
			$cost_class_name  = $classData->cost_class_name;
			$cost_class_id    = $classData->cost_class_code;
			$cost_class_block = $classData->cost_class_block;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/finance/form-mast-cost-class-update';

			return view('admin.finance.master.cost_class_form',compact('title','cost_class_code','cost_class_name','cost_class_id','cost_class_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Cost Class Not Found...!');
			return redirect('/finance/view-cost-class-mast');
		}

    }


    public function CostClassFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'cost_class_code' => 'required|max:11',
			'cost_class_name' => 'required|max:40',

		]);

		$cost_classcode = $request->input('cost_class_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"cost_class_code"  => $request->input('cost_class_code'),
			"cost_class_name"  => $request->input('cost_class_name'),
			"cost_class_block" => $request->input('cost_class_block'),
			"updated_by"      => $createdBy,
			"updated_date"      => $updatedDate,
			
		);

try{
	$saveData = DB::table('master_cost_class')->where('cost_class_code', $cost_classcode)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Class Was Successfully Updated...!');
			return redirect('/finance/view-cost-class-mast');

		} else {

			$request->session()->flash('alert-error', 'Cost Class Can Not Added...!');
			return redirect('/finance/view-cost-class-mast');

		}
	}
	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Class be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-cost-class-mast');
			}


	}

	public function ViewCostClassMast(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()){


    	$title = 'View Cost Class Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data = DB::table('master_cost_class')->orderBy('id','DESC');

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$data = DB::table('master_cost_class')->orderBy('id','DESC');
    	}
    	else{
    		$data ='';
    	}


    		return DataTables()->of($data)->addIndexColumn()->toJson();

}
if(isset($compName)){

    	return view('admin.finance.master.view_cost_class');
    }else{
    	return redirect('/useractivity');
    }
    }


    public function DeleteCostClass(Request $request){

		$costClassCode = $request->post('costClassId');
    	

    	if ($costClassCode!='') {

    		try{
    		
    		$Delete = DB::table('master_cost_class')->where('cost_class_code', $costClassCode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Cost Class Was Deleted Successfully...!');
				return redirect('/finance/view-cost-class-mast');

			} else {

				$request->session()->flash('alert-error', 'Cost Class Can Not Deleted...!');
				return redirect('/finance/view-cost-class-mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Class be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-cost-class-mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Cost Class Not Found...!');
			return redirect('/finance/view-cost-class-mast');

    	}

	}

	
/*zone master*/

	public function ZoneMast(Request $request){

		$title      ='Add Zone Master';

		$compName 	= $request->session()->get('company_name');
		
		$zone_code  = $request->old('zone_code');
		$zone_name  = $request->old('zone_name');
		$zone_block = $request->old('zone_block');
		$zone_id    = $request->old('zone_id');

		$userData['zonecode_list'] = DB::table('master_zone')->Orderby('zone_code', 'desc')->limit(5)->get();

		$button ='Save';
		$action ='/form-zone-mast-save';

		

 if(isset($compName)){

    	return view('admin.finance.master.zone_mast_form',$userData+compact('title','zone_code','zone_name','zone_block','zone_id','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 


    public function ZoneMastSave(Request $request){


		$validate = $this->validate($request, [

			'zone_code' => 'required|max:11|unique:master_zone,zone_code',
			'zone_name' => 'required|max:40',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(

			"zone_code" => $request->input('zone_code'),
			"zone_name"    => $request->input('zone_name'),
			"created_by"   => $createdBy,
			"comp_name"    => $compName,
			"fiscal_year"  => $fisYear,
			
		);

		$saveData = DB::table('master_zone')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Zone Was Successfully Added...!');
			return redirect('/finance/view-zone-mast');

		} else {

			$request->session()->flash('alert-error', 'Zone Can Not Added...!');
			return redirect('/finance/view-zone-mast');

		}

	}


	public function ViewZoneMast(Request $request){

	$compName = $request->session()->get('company_name');

	if($request->ajax()){


		$title    = 'View Zone Master';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data = DB::table('master_zone')->orderBy('id','DESC');

    	//print_r($valData['val_list']);exit;AccClassFormSave
    	}else if ($userType=='superAdmin' || $userType=='user') {    		

    		$data = DB::table('master_zone')->orderBy('id','DESC');
    		

    	}
    	else{
    		$data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->toJson();

    }
    	if(isset($compName)){

    	return view('admin.finance.master.view_zone_mast');
    }else{
		return redirect('/useractivity');
	}
    }


    public function DeleteZoneMast(Request $request){

		$zoneId = $request->post('zoneId');
    	

    	if ($zoneId!='') {
    		
    		$Delete = DB::table('master_zone')->where('zone_code', $zoneId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Zone Was Deleted Successfully...!');
				return redirect('/finance/view-zone-mast');

			} else {

				$request->session()->flash('alert-error', 'Zone Can Not Deleted...!');
				return redirect('/finance/view-zone-mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Zone  Not Found...!');
			return redirect('/finance/view-zone-mast');

    	}

	}


	public function EditZoneMast($id){

    	$title = 'Edit Zone Master';

    	//print_r($id);
    	$id = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);


    	if($id!=''){
    	    $query = DB::table('master_zone');
			$query->where('zone_code', $id);
			$classData= $query->get()->first();

			$zone_code = $classData->zone_code;
			$zone_name    = $classData->zone_name;
			$zone_id     = $classData->zone_code;
			$zone_block  = $classData->zone_block;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/form-zone-mast-update';

			return view('admin.finance.master.zone_mast_form',compact('title','zone_code','zone_name','zone_id','zone_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Zone Not Found...!');
			return redirect('/finance/view-zone-mast');
		}

    }

    public function ZoneMastUpdate(Request $request){

		$validate = $this->validate($request, [

			'zone_code' => 'required|max:11',
			'zone_name' => 'required|max:40',

		]);

		$zone_id = $request->input('idzone');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");
		
		$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

		$data = array(
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"zone_code"       => $request->input('zone_code'),
			"zone_name"       => $request->input('zone_name'),
			"zone_block"      => $request->input('zone_block'),
			"last_updat_by"   => $createdBy,
			"last_updat_date" => $updatedDate,
			
		);

		$saveData = DB::table('master_zone')->where('zone_code', $zone_id)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Zone Was Successfully Updated...!');
			return redirect('/finance/view-zone-mast');

		} else {

			$request->session()->flash('alert-error', 'Zone Can Not Added...!');
			return redirect('/finance/view-zone-mast');

		}

	}

/*zone master*/






/*cost category master*/


/*cost category master*/

	public function CostCategory(Request $request){

		$title      ='Add Cost Category';
		$compName 	= $request->session()->get('company_name');
		
		$costcatg_code = $request->old('costcatg_code');
		$costcatg_name = $request->old('costcatg_name');
		$costg_block   = $request->old('costg_block');
		$costcatg_id   = $request->old('costcatg_id');

		$userData['cost_category_list'] = DB::table('master_costcatg')->Orderby('costcatg_code', 'desc')->limit(5)->get();

		$button ='Save';
		$action ='/form-cost-category-save';

		

	if(isset($compName)){

    	return view('admin.finance.master.cost_category_form',$userData+compact('title','costcatg_code','costcatg_name','costg_block','costcatg_id','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function CostCategorySave(Request $request){


		$validate = $this->validate($request, [

			'costcatg_code' => 'required|max:11|unique:master_costcatg,costcatg_code',
			'costcatg_name' => 'required|max:40',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$costCatData = DB::table('master_costcatg')->orderBy('id', 'DESC')->first();
    	if(!empty($costCatData)){

    		$getID= $costCatData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(

			"id" => $id,
			"costcatg_code" => $request->input('costcatg_code'),
			"costcatg_name" => $request->input('costcatg_name'),
			"created_by"    => $createdBy,
			"comp_name"     => $compName,
			"fiscal_year"   => $fisYear,
			
		);

		$saveData = DB::table('master_costcatg')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Category Was Successfully Added...!');
			return redirect('/finance/view-cost-category');

		} else {

			$request->session()->flash('alert-error', 'Cost Category Can Not Added...!');
			return redirect('/finance/view-cost-category');

		}

	}


	public function ViewCostCategory(Request $request){

	$compName = $request->session()->get('company_name');

	if($request->ajax()){


		$title    = 'View Cost Category Master';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data = DB::table('master_costcatg')->orderBy('id','DESC');

    	//print_r($valData['val_list']);exit;AccClassFormSave
    	}else if ($userType=='superAdmin' || $userType=='user') {    		

    		$data = DB::table('master_costcatg')->orderBy('id','DESC');

    	}
    	else{
    		$data ='';
    	}


    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

}
	if(isset($compName)){
    	return view('admin.finance.master.view_cost_category');
	}else{
		return redirect('/useractivity');
	   }
    }


    public function DeleteCostCategory(Request $request){

		$costcat = $request->post('costcat');
    	

    	if ($costcat!='') {
    		try{

    		$Delete = DB::table('master_costcatg')->where('costcatg_code', $costcat)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Cost Category Was Deleted Successfully...!');
				return redirect('/finance/view-cost-category');

			} else {

				$request->session()->flash('alert-error', 'Cost Category Can Not Deleted...!');
				return redirect('/finance/view-cost-category');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Category be be Deleted...! Used In Another Transaction...!');
					return redirect('/finance/view-cost-category');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Zone  Not Found...!');
			return redirect('/finance/view-cost-category');

    	}

	}



	public function EditCostCategory($CostCategory){

    	$title = 'Edit Cost Category Master';

    	//print_r($id);
    	$CostCategory = base64_decode($CostCategory);
    	//$btnControl = base64_decode($btnControl);


    	if($CostCategory!=''){
    	    $query = DB::table('master_costcatg');
			$query->where('costcatg_code', $CostCategory);
			$classData= $query->get()->first();

			$costcatg_code = $classData->costcatg_code;
			$costcatg_name = $classData->costcatg_name;
			$costcatg_id   = $classData->costcatg_code;
			$costg_block   = $classData->costg_block;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/form-cost-category-update';

			return view('admin.finance.master.cost_category_form',compact('title','costcatg_code','costcatg_name','costcatg_id','costg_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Cost Category Not Found...!');
			return redirect('/finance/view-cost-category');
		}

    }


    public function CostCategoryUpdate(Request $request){

		$validate = $this->validate($request, [

			'costcatg_code' => 'required|max:11',
			'costcatg_name' => 'required|max:40',

		]);

		$codecostcatg = $request->input('idcostcatg');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");
		
		$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

		$data = array(
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"costcatg_code"   => $request->input('costcatg_code'),
			"costcatg_name"   => $request->input('costcatg_name'),
			"costg_block"     => $request->input('costg_block'),
			"last_updat_by"   => $createdBy,
			"last_updat_date" => $updatedDate,
			
		);
		try{


		$saveData = DB::table('master_costcatg')->where('costcatg_code', $codecostcatg)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Category Was Successfully Updated...!');
			return redirect('/finance/view-cost-category');

		} else {

			$request->session()->flash('alert-error', 'Cost Category Can Not Added...!');
			return redirect('/finance/view-cost-category');

		}
	}
	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Category be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-cost-category');
			}


	}

/*cost category master*/





/*fetch fy year when select company code*/

	public function get_fy_year(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	 $companycode = $request->input('company_code');

	    	 $compnay_code_list = DB::table('MASTER_FY')->where('COMP_CODE', $companycode)->get();

	    	 //print_r($compnay_code_list);exit();

    		if ($compnay_code_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $compnay_code_list ;

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

/*fetch fy year when select company code*/


/*fetch series code when select transaction code*/

	public function get_series_code(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	 $tran_code = $request->input('tran_code');

	    	 $transaction_code_list = DB::table('MASTER_CONFIG')->where('TRAN_CODE', $tran_code)->get();

	    	 //print_r($compnay_code_list);exit();

    		if ($transaction_code_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $transaction_code_list ;

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

/*fetch series code when select transaction code*/


/*cost master*/

	public function CostMaster(Request $request){

		$title        ='Add Cost Master';

		$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');



		
		$userdata['comp_list']  = DB::table('master_comp')->get();

		$userdata['costype_list']  = DB::table('master_cost_type')->get();
		$userdata['costgrp_list']  = DB::table('master_cost_group')->get();
		$userdata['costcatg_list']  = DB::table('master_costcatg')->get();
		$userdata['costclss_list']  = DB::table('master_cost_class')->get();
		$userdata['pfct_list']  = DB::table('master_pfct')->get();

		$userdata['cost_code_list'] = DB::table('master_cost')->Orderby('cost_code', 'desc')->limit(5)->get();

	
    if(isset($compName)){

    	return view('admin.finance.master.cost_master',$userdata+compact('title'));
    }else{

		return redirect('/useractivity');
	}

    } 

    public function CostMastSave(Request $request){


		$validate = $this->validate($request, [

			'company_code'   => 'required|max:11',
			'cost_code'      => 'required|max:11|unique:master_cost,cost_code',
			'cost_name'      => 'required|max:40',
			'costtype_code'  => 'required|max:11',
			'costgroup_code' => 'required|max:11',
			'costcatg_code'  => 'required|max:11',
			'costclass_code' => 'required|max:11',
			'pfct_code'      => 'required|max:11',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

        $costData = DB::table('master_cost')->orderBy('id', 'DESC')->first();
    	if(!empty($costData)){

    		$getID= $costData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}


		$data = array(

			"id"             => $id,
			"company_code"   => $request->input('company_code'),
			"cost_code"      => $request->input('cost_code'),
			"cost_name"      => $request->input('cost_name'),
			"costtype_code"  => $request->input('costtype_code'),
			"costgroup_code" => $request->input('costgroup_code'),
			"costcatg_code"  => $request->input('costcatg_code'),
			"costclass_code" => $request->input('costclass_code'),
			"pfct_code"      => $request->input('pfct_code'),
			"created_by"     => $createdBy,
			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			
		);

		$saveData = DB::table('master_cost')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Master Was Successfully Added...!');
			return redirect('/finance/view-cost-mast');

		} else {

			$request->session()->flash('alert-error', 'Cost Master Can Not Added...!');
			return redirect('/finance/view-cost-mast');

		}

	}

	public function ViewCostMast(Request $request){

	$compName = $request->session()->get('company_name');

	if($request->ajax()){


    	$title = 'View Cost Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){

			$data = DB::table('master_cost')
			->leftjoin('master_comp','master_cost.company_code','=','master_comp.comp_code')
			->select('master_cost.*','master_comp.comp_name as compname')
			->orderBy('id','DESC');
    	
    	}
    	elseif ($userType=='superAdmin' || $userType=='user') {

    		$data = DB::table('master_cost')
			->select('master_cost.*','master_comp.comp_name as compname')
			->leftjoin('master_comp','master_cost.company_code','=','master_comp.comp_code')
			->orderBy('id','DESC');
    	}
    	else{
    		$data ='';
    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

}
	if(isset($compName)){
    	return view('admin.finance.master.view_cost_master');
	}else{
		return redirect('/useractivity');
	   }
    }

    public function DeleteCostMast(Request $request){

        $id = $request->input('costid');
        if ($id!='') {

        	try{

			$Delete = DB::table('master_cost')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Cost Data Was Deleted Successfully...!');
			return redirect('/finance/view-cost-mast');

			} else {

			$request->session()->flash('alert-error', 'Cost Data Can Not Deleted...!');
			return redirect('/finance/view-cost-mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Data be be Deleted...! Used In Another Transaction...!');
					return redirect('/finance/view-cost-mast');
			}

		}else{

		$request->session()->flash('alert-error', 'Cost Data Not Found...!');
		return redirect('/finance/view-cost-mast');

		}
	}


	public function EditCostMast(Request $request,$id,$btnControl){

    	$title = 'Edit Cost Master';

    	//print_r($id);
    	$id = base64_decode($id);
    	$btnControl = base64_decode($btnControl);

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');



    	if($id!=''){
    	    $query = DB::table('master_cost');
			$query->where('id', $id);
			$userData['mastCost_list'] = $query->get()->first();

			$userData['comp_list']     = DB::table('master_comp')->get();
			$userData['costype_list']  = DB::table('master_cost_type')->get();
			$userData['costgrp_list']  = DB::table('master_cost_group')->get();
			$userData['costcatg_list'] = DB::table('master_costcatg')->get();
			$userData['costclss_list'] = DB::table('master_cost_class')->get();
			$userData['pfct_list']     = DB::table('master_pfct')->get();

			return view('admin.finance.master.edit_cost_mast', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Cost Id Not Found...!');
			return redirect('/finance/view-cost-mast');
		}

    }


    public function UpdateCostMast(Request $request){

		
		$validate = $this->validate($request, [

			'company_code'   => 'required|max:11',
			'cost_code'      => 'required|max:11',
			'cost_name'      => 'required|max:40',
			'costtype_code'  => 'required|max:11',
			'costgroup_code' => 'required|max:11',
			'costcatg_code'  => 'required|max:11',
			'costclass_code' => 'required|max:11',
			'pfct_code'      => 'required|max:11',

		]);

       $id = $request->input('EcostId');
       $updatedDate = date('Y-m-d');

		$data = array(
					"company_code"    =>  $request->input('company_code'),
					"cost_code"       =>  $request->input('cost_code'),
					"cost_name"       =>  $request->input('cost_name'),
					"costtype_code"   =>  $request->input('costtype_code'),
					"costgroup_code"  =>  $request->input('costgroup_code'),
					"costcatg_code"   =>  $request->input('costcatg_code'),
					"costclass_code"  =>  $request->input('costclass_code'),
					"pfct_code"       =>  $request->input('pfct_code'),
					"cost_block"      =>  $request->input('cost_block'),
					"last_updat_by"   =>  $request->session()->get('userid'),
					"last_updat_date" =>  $updatedDate
					
	    	);

try{
		$saveData = DB::table('master_cost')->where('id', $id)->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'Cost Was Successfully Updated...!');
				return redirect('/finance/view-cost-mast');

			} else {

				$request->session()->flash('alert-error', 'Cost Can Not Updated...!');
				return redirect('/finance/view-cost-mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Data be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-cost-mast');
			}


	}

/*cost master*/




/*account master for finance*/

	public function PartyFinance(Request $request){

		$title = 'Add Account Master';

		$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

		$userData['acctype_lists']     = DB::table('master_finance_acctype')->get();

		$userData['acccategory_lists'] = DB::table('master_acc_category')->get();

		$userData['accclass_lists']    = DB::table('master_acc_class')->get();

		$userData['state_lists']       = DB::table('master_state')->get();

		$userData['tax_lists']         = DB::table('master_tax')->get();

		$userData['tds_lists']         = DB::table('master_tds')->get();

		$userData['acc_mst_list'] = DB::table('master_party')->Orderby('acc_code', 'desc')->limit(5)->get();

		

		if(isset($compName)){

    	return view('admin.finance.master.party_finance',$userData+compact('title'));
    }else{

		return redirect('/useractivity');
	}

	}


	public function PartyMastSave(Request $request){

		
		//print_r($request->post());exit;
	
		//print_r($slno);exit;
		$validate = $this->validate($request, [

			'acc_code'      => 'required|max:11|unique:master_party,acc_code',
			

		]);
		
    	$createdBy 	= $request->session()->get('userid');
    	$compName 	= $request->session()->get('company_name');
    	$fisYear 	=  $request->session()->get('macc_year');

    	$partyData = DB::table('master_party')->orderBy('id', 'DESC')->first();
    	if(!empty($partyData)){

    		$getID= $partyData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

			$acc_code         = $request->input('acc_code');
			$slno             = $request->input('slno');
			$acc_name         = $request->input('acc_name');
			$acctype_code     = $request->input('acctype_code');
			$acccategory_code = $request->input('acccategory_code');
			$accclass_code    = $request->input('accclass_code');
			$bill_track       = $request->input('bill_track');
			$contact_person   = $request->input('contact_person');
			$address1         = $request->input('address');
			$city             = $request->input('city');
			$pincode          = $request->input('pincode');
			$district         = $request->input('district');
			$state            = $request->input('state');
			//$country        = $request->input('country');
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
			

		$data = array(

			"id"               => $id,
			"acc_code"         => $acc_code,
			"acc_name"         => $acc_name,
			"acctype_code"     => $acctype_code,
			"acccategory_code" => $acccategory_code,
			"accclass_code"    => $accclass_code,
			"bill_track"       => $bill_track,
			"tax_code"         => $tax_code,
			"tds_code"         => $tds_code,
			"tan_no"           => $tan_no,
			"tinno"            => $tinno,
			"sales_taxno"      => $sales_taxno,
			"csales_taxno"     => $csales_taxno,
			"service_taxno"    => $service_taxno,
			"panno"            => $panno,
			"bank_name"        => $bank_name,
			"acc_number"       => $acc_number,
			"branch_name"      => $branch_name,
			"ifsc_code"        => $ifsc_code,
			"bank_address"     => $bank_address,
			"created_by"       => $createdBy,
			"comp_name"        => $compName,
			"fiscal_year"      => $fisYear,
			
		);

		$saveData = DB::table('master_party')->insert($data);


		$address = $request->input('address');

	    $count = count($address);


	    for ($i=0; $i < $count; $i++){ 

	    	$data1 =array(

				'comp_name'      => $compName,
				'fiscal_year'    => $fisYear,
				'acc_code'       => $acc_code,
				'sl_no'          => $slno[$i],
				'contact_person' => $contact_person[$i],
				'address'        => $address[$i],
				'pincode'        => $pincode[$i],
				'city'           => $city[$i],
				'state'          => $state[$i],
				'district'       => $district[$i],
				'phone'          => $phone[$i],
				'email'          => $email[$i],
				'fax'            => $fax[$i],
				'range_address'  => $range_address[$i],
				'gst_type'       => $gst_type[$i],
				'gst_num'        => $gst_num[$i],
				'ecc_no'         => $ecc_no[$i],
				'range_no'       => $range_no[$i],
				'range_name'     => $range_name[$i],
				'division'       => $division[$i],
				'collector'      => $collector[$i],
				'created_by'     => $createdBy,



	    	);

	    $saveData1 = DB::table('master_acc_address')->insert($data1);

	    }



		if ($saveData && $saveData1) {

			$request->session()->flash('alert-success', 'Account Master Was Successfully Added...!');
			return redirect('/finance/view-party-finance-master');

		} else {

			$request->session()->flash('alert-error', 'Account Master Can Not Added...!');
			return redirect('/finance/view-party-finance-master');

		}

	}

	public function ViewPartFinance(Request $request){

	$compName = $request->session()->get('company_name');

	if($request->ajax()){


    	$title = 'View Account Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){

			$data = DB::table('master_party')->orderBy('id','DESC');
    	
    	}
    	elseif ($userType=='superAdmin' || $userType=='user') {

			$data = DB::table('master_party')->orderBy('id','DESC');
    	}
    	else{

    		$data ='';
    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }
    	if(isset($compName)){

    	return view('admin.finance.master.view_party_finance');
    	}else{
		return redirect('/useractivity');
	   }
    }


    


	public function EditPartyFinance(Request $request,$id,$btnControl){

    	$title = 'Edit Account Master';

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');


    	//print_r($id);
    	$id = base64_decode($id);

       
    	if($id!=''){
    	    $query = DB::table('master_party');
			$query->where('id', $id);
			$userData['PartyFinance_list'] = $query->get()->first();

			$acc_code = $userData['PartyFinance_list']->acc_code;

			$userData['party_address'] = DB::table('master_acc_address')->where('acc_code',$acc_code)->get()->toArray();

//print_r($userData['party_address']);exit;
			$userData['acctype_lists']     = DB::table('master_finance_acctype')->get();

			$userData['acccategory_lists'] = DB::table('master_acc_category')->get();

			$userData['accclass_lists']    = DB::table('master_acc_class')->get();

			$userData['state_lists']       = DB::table('master_state')->get();

			$userData['tax_lists']         = DB::table('master_tax')->get();

			$userData['tds_lists']         = DB::table('master_tds')->get();

           
			return view('admin.finance.master.edit_party_finance', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Cost Id Not Found...!');
			return redirect('/finance/view-party-finance-master');
		}

    }

    public function UpdatePartyFinance(Request $request){
       
       $id = $request->input('F_party_id');
       $acc_code_id = $request->input('acc_code_id');
       $updatedDate = date('Y-m-d');

        $compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');


            $acc_code         = $request->input('acc_code');
            $slno             = $request->input('slno');
			$acc_name         = $request->input('acc_name');
			$acctype_code     = $request->input('acctype_code');
			$acccategory_code = $request->input('acccategory_code');
			$accclass_code    = $request->input('accclass_code');
			$bill_track       = $request->input('bill_track');
			$contact_person   = $request->input('contact_person');
			$address1         = $request->input('address');
			$city             = $request->input('city');
			$pincode          = $request->input('pincode');
			$district         = $request->input('district');
			$state            = $request->input('state');
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
			

		$data = array(

			"id"               => $id,
			"acc_code"         => $acc_code,
			"acc_name"         => $acc_name,
			"acctype_code"     => $acctype_code,
			"acccategory_code" => $acccategory_code,
			"accclass_code"    => $accclass_code,
			"bill_track"       => $bill_track,
			"tax_code"         => $tax_code,
			"tds_code"         => $tds_code,
			"tan_no"           => $tan_no,
			"tinno"            => $tinno,
			"sales_taxno"      => $sales_taxno,
			"csales_taxno"     => $csales_taxno,
			"service_taxno"    => $service_taxno,
			"panno"            => $panno,
			"bank_name"        => $bank_name,
			"acc_number"       => $acc_number,
			"branch_name"      => $branch_name,
			"ifsc_code"        => $ifsc_code,
			"bank_address"     => $bank_address,
			"updated_by"       => $request->session()->get('userid'),
			"updated_date"     => $updatedDate
			
		);


	$saveData = DB::table('master_party')->where('id',$id)->update($data);

	
    $deleteData = DB::table('master_acc_address')->where('acc_code',$acc_code_id)->delete();

	$address = $request->input('address');
        // echo "<PRE>";
        // print_r($address);
        // exit;
	    $count = count($address);


	    for ($i=0; $i < $count; $i++){ 



	    	$data1 =array(

				'comp_name'      => $compName,
				'fiscal_year'    => $fisYear,
				'acc_code'       => $acc_code,
				'sl_no'          => $slno[$i],
				'contact_person' => $contact_person[$i],
				'address'        => $address[$i],
				'pincode'        => $pincode[$i],
				'city'           => $city[$i],
				'state'          => $state[$i],
				'district'       => $district[$i],
				'phone'          => $phone[$i],
				'email'          => $email[$i],
				'fax'            => $fax[$i],
				'range_address'  => $range_address[$i],
				'gst_type'       => $gst_type[$i],
				'gst_num'        => $gst_num[$i],
				'ecc_no'         => $ecc_no[$i],
				'range_no'       => $range_no[$i],
				'range_name'     => $range_name[$i],
				'division'       => $division[$i],
				'collector'      => $collector[$i],
				"updated_by"     => $request->session()->get('userid'),
			    "updated_date"     => $updatedDate



	    	);

	    $saveData1 = DB::table('master_acc_address')->insert($data1);
	}

        if($saveData && $saveData1 || $saveData || $saveData1) {

				$request->session()->flash('alert-success', 'Account Was Successfully Updated...!');
				return redirect('/finance/view-party-finance-master');

			} else {

				$request->session()->flash('alert-error', 'Account Can Not Updated...!');
				return redirect('/finance/view-party-finance-master');

			}
	}
/*account master for finance*/

public function CashBankTransaction_old(Request $request){

	$title      ='Add Cost Category';
		
		$costcatg_code = $request->old('costcatg_code');
		$company_code  = $request->old('company_code');	
		$costcatg_name = $request->old('costcatg_name');
		$costg_block   = $request->old('costg_block');
		$costcatg_id   = $request->old('costcatg_id');

		$button ='Save';
		$action ='/form-cost-category-save';

		$userdata['comp_list']       = DB::table('master_comp')->get();
		$userdata['config_list']     = DB::table('master_config')->get();
		$userdata['pfct_list']       = DB::table('master_pfct')->get();
		$userdata['bank_list']       = DB::table('master_bank')->get();
		$userdata['cost_list']       = DB::table('master_cost')->get();
		//print_r($userdata['cost_list']);exit;
		$userdata['help_gl_list'] = DB::table('master_gl')->Orderby('gl_code', 'desc')->limit(5)->get();
		$userdata['help_acc_list'] = DB::table('master_party')->Orderby('acc_code', 'desc')->limit(5)->get();

		return view('admin.finance.transaction.cash_bank_trans',$userdata+compact('company_code','button'));
}

public function CashBankFormSave_old(Request $request){


    	$createdBy 	=  $request->session()->get('userid');

    	$compName 	=  $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	//print_r($request->post());exit;
    	$cheque_date = $request->input('cheque_date');

    	$chequeDate = date("Y-m-d", strtotime($cheque_date));

    	$vr_date = $request->input('vr_date');

    	$vrDate = date("Y-m-d", strtotime($vr_date));


		$data = array(


			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"comp_code"      => $request->input('company_code'),
			"fy_code"        => $request->input('fy_code'),
			"vr_no"          => $request->input('vr_no'),
			"vr_type"        => $request->input('vr_type'),
			"series_code"    => $request->input('series_code'),
			"vr_date"        => $vrDate,
			"gl_key"         => $request->input('gl_key'),
			"gl_code"        => $request->input('gll_code'),
			"gl_name"        => $request->input('gll_name'),
			"acc_code"       => $request->input('acc_code'),
			"acc_name"       => $request->input('acc_name'),
			"amount"         => $request->input('amount'),
			"cheque_type"    => $request->input('cheque_type'),
			"cheque_no"      => $request->input('cheque_no'),
			"cheque_date"    => $chequeDate,
			"pfct_code"      => $request->input('pfct_code'),
			"pfct_name"      => $request->input('pfct_name'),
			"perticuler"     => $request->input('perticuler'),
			"bank_code"      => $request->input('bank_code'),
			"bank_name"      => $request->input('bank_name'),
			"cost_code"      => $request->input('cost_code'),
			"cost_name"      => $request->input('cost_name'),
			"tds_code"       => $request->input('tds_code'),
			"tds_name"       => $request->input('tds_name'),
			"tds_rate"       => $request->input('tds_rate'),
			"base_amt"       => $request->input('base_amount'),
			"tds_amt"        => $request->input('tds_amount'),
			"ref_type"       => $request->input('ref_type'),
			"purchase_order" => $request->input('purchase_order'),
			"created_by"     => $createdBy,
			
			
		);

		$saveData = DB::table('cb_tran')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cash Bank Was Successfully Added...!');
			return redirect('/finance/view-cash-bank');

		} else {

			$request->session()->flash('alert-error', 'Cash Bank Can Not Added...!');
			return redirect('/finance/view-cash-bank');

		}
    }

    public function ViewBankCashMast_old(Request $request){

    	$title = 'View Cost Class Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$CashBankData['bank_cash'] = DB::table('cb_tran')->orderBy('id','DESC')->get();

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    	$CashBankData['bank_cash'] = DB::table('cb_tran')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();
    	}
    	else{
    		$CashBankData['bank_cash']='';
    	}

    	return view('admin.finance.transaction.view_bank_cash',$CashBankData+compact('title'));
    }

    public function EditCashBank_old($id){

    	$title = 'Edit House Cash Master';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('cb_tran');
			$query->where('id', $id);
			$userdata['cashbank_list']= $query->get()->first();

			//print_r($userdata['cashbank_list']);exit;

			$button ='Update';

			$userdata['comp_list']       = DB::table('master_comp')->get();
			$userdata['config_list']     = DB::table('master_config')->get();
			$userdata['pfct_list']       = DB::table('master_pfct')->get();
			$userdata['bank_list']       = DB::table('master_bank')->get();
			$userdata['cost_list']       = DB::table('master_cost')->get();

			$userdata['help_gl_list'] = DB::table('master_gl')->Orderby('gl_code', 'desc')->limit(5)->get();
			
		    $userdata['help_acc_list'] = DB::table('master_party')->Orderby('acc_code', 'desc')->limit(5)->get();

			return view('admin.finance.transaction.edit_cash_bank_trans',$userdata+compact('button'));
		}else{
			$request->session()->flash('alert-error', 'House Cash Not Found...!');
			return redirect('/finance/view-cash-bank');
		}

    }

    

public function HelpGlCodeSearch(Request $request){

		$response_array = array();

	    $gl_code_help = $request->input('HelpglCode');

	   /// print_r($gl_code_help);exit();

		if ($request->ajax()) {

	    	$Seach_gl_Code_by_help = DB::select("SELECT * FROM `master_gl` WHERE gl_code='$gl_code_help' OR gl_name='$gl_code_help' OR gl_code Like '$gl_code_help%' OR gl_name LIKE '$gl_code_help%' ORDER BY gl_code DESC limit 5");

	    	//print_r($Seach_depot_Code_by_help);exit;
	    	
    		if ($Seach_gl_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_gl_Code_by_help ;

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

    public function HelpAccCodeSearch(Request $request){

		$response_array = array();

	    $acc_code_help = $request->input('HelpaccCode');

	   //print_r($acc_code_help);exit();

		if ($request->ajax()) {

	    	$Seach_Acc_Code_by_help = DB::select("SELECT * FROM `master_party` WHERE acc_code='$acc_code_help' OR acc_name='$acc_code_help' OR acc_code Like '$acc_code_help%' OR acc_name LIKE '$acc_code_help%' ORDER BY acc_code DESC limit 5");

	    	//print_r($Seach_Acc_Code_by_help);exit;
	    	
    		if ($Seach_Acc_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_Acc_Code_by_help;

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


public function get_gl_data(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	 $SeriesCode = $request->input('series_code');

	    	 $series_code_list1 = DB::table('MASTER_CONFIG')->where('SERIES_CODE', $SeriesCode)->get()->first();

	    	 $series_code_list = json_decode(json_encode($series_code_list1), true);

	    	 $gl_data = DB::table('MASTER_GL')->where('GL_CODE', $series_code_list['POST_CODE'])->get()->first();

    		if ($gl_data) {

    			$response_array['response'] = 'success';
	            $response_array['gl_data'] = $gl_data;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['gl_data'] = '' ;

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


    public function get_cost_code_data(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	 $CostCode = $request->input('cost_code');

	    	 $cost_code_list = DB::table('master_cost')->where('cost_code', $CostCode)->get()->first();

	    	 /*$gl_data = DB::table('master_gl')->where('gl_code', $series_code_list->gl_code)->get()->first();*/



	    	// print_r($gl_data);exit();

    		if ($cost_code_list) {

    			$response_array['response'] = 'success';
	            $response_array['cost_data'] = $cost_code_list;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['cost_data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['cost_data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function get_pfct_data(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	 $PfctCode = $request->input('pfct_code');

	    	 $pfct_list = DB::table('master_pfct')->where('pfct_code', $PfctCode)->get()->first();

	    	/* $gl_data = DB::table('master_gl')->where('gl_code', $series_code_list->gl_code)->get()->first();*/



	    	 //print_r($pfct_list);exit();

    		if ($pfct_list) {

    			$response_array['response'] = 'success';
	            $response_array['pfct_data'] = $pfct_list;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['pfct_data'] = '' ;

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

    public function get_gl_code_data(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	 $gl_key = $request->input('gl_key');

	    	 $glkey_list = DB::table('glkey_master')->where('glkey_code', $gl_key)->get()->first();

	    	$gl_data = DB::table('master_gl')->where('gl_code', $glkey_list->gl_code)->get()->first();



	    	 //print_r($glkey_list);exit();

    		if (!empty($glkey_list)) {

    			$response_array['response'] = 'success';
	            $response_array['gl_key_data'] = $glkey_list;
	            $response_array['gl_name_data'] = $gl_data;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['gl_key_data'] ='' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['gl_key_data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

     public function get_bank_data(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	 $BankCode = $request->input('bank_code');

	    	 $bank_list = DB::table('master_bank')->where('bank_code', $BankCode)->get()->first();

	    	/* $gl_data = DB::table('master_gl')->where('gl_code', $series_code_list->gl_code)->get()->first();*/



	    	 //print_r($pfct_list);exit();

    		if ($bank_list) {

    			$response_array['response'] = 'success';
	            $response_array['bank_data'] = $bank_list;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['bank_data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['bank_data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function get_acc_code_data(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	 $AccCode = $request->input('acc_code');

	    	 $acc_list = DB::table('master_party')->where('acc_code', $AccCode)->get()->first();
	     

	    	 $tds_data = DB::table('master_tds')->where('tds_code', $acc_list->tds_code)->get()->first();

	    	// print_r($tds_data);exit();

    		if ($acc_list) {

    			$response_array['response'] = 'success';
	            $response_array['acc_data'] = $acc_list;
	            $response_array['tds_data'] = $tds_data;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['acc_data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['acc_data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }



    


 	public function search_PfctCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$profit_code = $request->input('profit_code');

	    	$pfct_list = DB::select("SELECT * FROM `master_pfct` WHERE pfct_code LIKE '$profit_code%'");

	    	$count = count($pfct_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $pfct_list ;

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
   	public function HelpPfctCodeSearch(Request $request){

		$response_array = array();

	    $pfct_code_help = $request->input('HelppfctCode');

		if ($request->ajax()) {

	    	$Seach_pfct_Code_by_help = DB::select("SELECT * FROM `master_pfct` WHERE pfct_code='$pfct_code_help' OR pfct_name='$pfct_code_help' OR pfct_code Like '$pfct_code_help%' OR pfct_name LIKE '$pfct_code_help%' ORDER BY pfct_code DESC limit 5  ");
	    	
    		if ($Seach_pfct_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_pfct_Code_by_help;

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



public function search_TaxCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$tax_code = $request->input('tax_code');

	    	$tax_list = DB::select("SELECT * FROM `master_tax` WHERE tax_code LIKE '$tax_code%'");

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
/*search account code on input*/

/*search account code when click on help button*/
   	public function HelpTaxCodeSearch(Request $request){

		$response_array = array();

	    $tax_code_help = $request->input('HelptaxCode');

		if ($request->ajax()) {

	    	$Seach_tax_Code_by_help = DB::select("SELECT * FROM `master_tax` WHERE tax_code='$tax_code_help' OR tax_name='$tax_code_help' OR tax_code Like '$tax_code_help%' OR tax_name LIKE '$tax_code_help%' ORDER BY tax_code DESC limit 5  ");
	    	
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


    public function search_GlschCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$glsch_code = $request->input('glsch_code');

	    	$glsch_list = DB::select("SELECT * FROM `master_glsch` WHERE glsch_code LIKE '$glsch_code%'");

	    	$count = count($glsch_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $glsch_list ;

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

/*search glsch type*/

	public function search_GlschType(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$glschType = $request->input('glschType');

	    	$glschtyp_list = DB::select("SELECT * FROM `master_glsch` WHERE glsch_type='$glschType' ORDER BY glsch_code DESC LIMIT 5 ");

	    	if ($glschtyp_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $glschtyp_list ;

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

/*search glsch type*/

/*search account code when click on help button*/
   	public function HelpGlschCodeSearch(Request $request){

		$response_array = array();

	    $glsch_code_help = $request->input('HelpglschCode');

		if ($request->ajax()) {

	    	$Seach_glsch_Code_by_help = DB::select("SELECT * FROM `master_glsch` WHERE glsch_code='$glsch_code_help' OR glsch_name='$glsch_code_help' OR glsch_code Like '$glsch_code_help%' OR glsch_name LIKE '$glsch_code_help%' ORDER BY glsch_code DESC limit 5  ");
	    	
    		if ($Seach_glsch_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_glsch_Code_by_help;

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



/*search gl code when click on help button*/
	
	public function HelpGlMastCodeHelp(Request $request){

		$response_array = array();

	    $gl_code_help = $request->input('HelpGlCode');

		if ($request->ajax()) {

	    	$Seach_glcode_by_help = DB::select("SELECT * FROM `master_gl` WHERE gl_code='$gl_code_help' OR gl_name='$gl_code_help' OR gl_code Like '$gl_code_help%' OR gl_name LIKE '$gl_code_help%' ORDER BY gl_code DESC limit 5  ");
	    	
    		if ($Seach_glcode_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_glcode_by_help ;

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

/*search gl code when click on help button*/


/*search gl code on input*/

	public function search_glCd(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$gl_code = $request->input('gl_code_search');

	    	$glcode_list = DB::select("SELECT * FROM `master_gl` WHERE gl_code LIKE '$gl_code%'");

	    	$count = count($glcode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $glcode_list ;

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

/*search gl code on input*/


/*search series code when click on help button*/
	
	public function HelpSeriesCodeHelp(Request $request){

		$response_array = array();

	    $series_code_help = $request->input('HelpSeriesCode');

		if ($request->ajax()) {

	    	$Seach_series_by_help = DB::select("SELECT * FROM `master_config` WHERE series_code='$series_code_help' OR series_name='$series_code_help' OR series_code Like '$series_code_help%' OR series_name LIKE '$series_code_help%' ORDER BY series_code DESC limit 5  ");
	    	
    		if ($Seach_series_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_series_by_help ;

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

/*search series code when click on help button*/


/*search series code on input*/

	public function search_serieCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$series_Code = $request->input('serach_series_code');

	    	$series_list = DB::select("SELECT * FROM `master_config` WHERE series_code LIKE '$series_Code%'");

	    	$count = count($series_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $series_list ;

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

/*search series code on input*/




/*search Transaction code when click on help button*/
	
	public function HelptransactionSearch(Request $request){

		$response_array = array();

	    $trans_code_help = $request->input('TransCodeH');

		if ($request->ajax()) {

	    	$trans_dept_by_help = DB::select("SELECT * FROM `master_transaction` WHERE tran_code='$trans_code_help' OR tran_head='$trans_code_help' OR tran_code Like '$trans_code_help%' OR tran_head LIKE '$trans_code_help%' ORDER BY tran_code DESC limit 5  ");
	    	
    		if ($trans_dept_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $trans_dept_by_help ;

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

/*search Transaction code when click on help button*/

/*search Transaction code on input*/

	public function search_TransactionCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$transaction_code = $request->input('transCodeSearch');

	    	$transaction_list = DB::select("SELECT * FROM `master_transaction` WHERE tran_code LIKE '$transaction_code%'");

	    	$count = count($transaction_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $transaction_list ;

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

/*search Transaction code on input*/


/*search Item Class code when click on help button*/
	
	public function HelpItemClassSearch(Request $request){

		$response_array = array();

	    $ItemClass_Help = $request->input('ItemClassHelp');

		if ($request->ajax()) {

	    	$item_class_by_help = DB::select("SELECT * FROM `master_item_class` WHERE item_class_code='$ItemClass_Help' OR item_class_name='$ItemClass_Help' OR item_class_code Like '$ItemClass_Help%' OR item_class_name LIKE '$ItemClass_Help%' ORDER BY item_class_code DESC limit 5  ");
	    	
    		if ($item_class_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_class_by_help ;

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

/*search Item Class code when click on help button*/


/*search Item Class code on input*/

	public function search_ItemClassCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$ItemClass_code = $request->input('ItemCSearch');

	    	$itemclass_list = DB::select("SELECT * FROM `master_item_class` WHERE item_class_code LIKE '$ItemClass_code%'");

	    	$count = count($itemclass_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemclass_list ;

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

/*search Item Class code on input*/

/*search Item type code when click on help button*/
	
	public function HelpItemTypeSearch(Request $request){

		$response_array = array();

	    $ItemType_H = $request->input('ItemTypeH');

		if ($request->ajax()) {

	    	$item_type_by_help = DB::select("SELECT * FROM `master_item_type` WHERE item_type_code='$ItemType_H' OR item_type_name='$ItemType_H' OR item_type_code Like '$ItemType_H%' OR item_type_name LIKE '$ItemType_H%' ORDER BY item_type_code DESC limit 5  ");
	    	
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

	    	$itemtype_list = DB::select("SELECT * FROM `master_item_type` WHERE item_type_code LIKE '$ItemType_code%'");

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

/*search Item type code on input*/


/*search Valuation code when click on help button*/
	
	public function HelpValuationSearch(Request $request){

		$response_array = array();

	    $ValuationCodeH = $request->input('ValuationCodeH');

		if ($request->ajax()) {

	    	$item_type_by_help = DB::select("SELECT * FROM `master_valuation` WHERE valuation_code='$ValuationCodeH' OR valuation_name='$ValuationCodeH' OR valuation_code Like '$ValuationCodeH%' OR valuation_name LIKE '$ValuationCodeH%' ORDER BY valuation_code DESC limit 5  ");
	    	
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

/*search Valuation code when click on help button*/


/*search Valuation code on input*/

	public function search_ValuationCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$Valuation_code = $request->input('SearchValuationC');

	    	$valuation_list = DB::select("SELECT * FROM `master_valuation` WHERE valuation_code LIKE '$Valuation_code%'");

	    	$count = count($valuation_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $valuation_list ;

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

/*search Valuation code on input*/

/*search Rack code when click on help button*/
	
	public function HelpRackCodeGet(Request $request){

		$response_array = array();

	    $rackCodeH = $request->input('rackCodeH');

		if ($request->ajax()) {

	    	$rack_code_by_help = DB::select("SELECT * FROM `master_rack` WHERE rack_code='$rackCodeH' OR rack_name='$rackCodeH' OR rack_code Like '$rackCodeH%' OR rack_name LIKE '$rackCodeH%' ORDER BY rack_code DESC limit 5  ");
	    	
    		if ($rack_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $rack_code_by_help ;

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

/*search Rack code when click on help button*/


/*search Rack code on input*/

	public function search_RackCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$RackSearch_code = $request->input('RackSearch');

	    	$RackCode_list = DB::select("SELECT * FROM `master_rack` WHERE rack_code LIKE '$RackSearch_code%'");

	    	$count = count($RackCode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $RackCode_list ;

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

/*search Rack code on input*/

/*search Item Category code when click on help button*/
	
	public function HelpItemCatCodeGet(Request $request){

		$response_array = array();

	    $ItemCateCodeH = $request->input('ItemCateCodeH');

		if ($request->ajax()) {

	    	$itemcat_code_by_help = DB::select("SELECT * FROM `master_item_category` WHERE itemcategory_code='$ItemCateCodeH' OR itemcategory_name='$ItemCateCodeH' OR itemcategory_code Like '$ItemCateCodeH%' OR itemcategory_name LIKE '$ItemCateCodeH%' ORDER BY itemcategory_code DESC limit 5  ");
	    	
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

	    	$itemcatCode_list = DB::select("SELECT * FROM `master_item_category` WHERE itemcategory_code LIKE '$SearchItemCatCode%'");

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


/*search Item Group code when click on help button*/
	
	public function HelpItemGroupCodeGet(Request $request){

		$response_array = array();

	    $ItemGroupH = $request->input('ItemGroupH');

		if ($request->ajax()) {

	    	$itemgroup_code_by_help = DB::select("SELECT * FROM `master_itemgroup` WHERE itemgroup_code='$ItemGroupH' OR itemgroup_name='$ItemGroupH' OR itemgroup_code Like '$ItemGroupH%' OR itemgroup_name LIKE '$ItemGroupH%' ORDER BY itemgroup_code DESC limit 5  ");
	    	
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

	    	$itemgroupCode_list = DB::select("SELECT * FROM `master_itemgroup` WHERE itemgroup_code LIKE '$SearchItemGroup%'");

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





/*search TDS code when click on help button*/
	
	public function HelpTDSCodeGet(Request $request){

		$response_array = array();

	    $tdsCodeHelp = $request->input('tdsCodeHelp');

		if ($request->ajax()) {

	    	$tds_code_by_help = DB::select("SELECT * FROM `master_tds` WHERE tds_code='$tdsCodeHelp' OR tds_name='$tdsCodeHelp' OR tds_code Like '$tdsCodeHelp%' OR tds_name LIKE '$tdsCodeHelp%' ORDER BY tds_code DESC limit 5  ");
	    	
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

	    	$tdsCode_list = DB::select("SELECT * FROM `master_tds` WHERE tds_code LIKE '$TdsCodeSearch%'");

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


/*search Acc Class when click on help button*/
	
	public function HelpAccClasCodeGet(Request $request){

		$response_array = array();

	    $AccClsHelp = $request->input('AccClsHelp');

		if ($request->ajax()) {

	    	$accCls_code_by_help = DB::select("SELECT * FROM `master_acc_class` WHERE acc_class_code='$AccClsHelp' OR acc_class_name='$AccClsHelp' OR acc_class_code Like '$AccClsHelp%' OR acc_class_name LIKE '$AccClsHelp%' ORDER BY acc_class_code DESC limit 5  ");
	    	
    		if ($accCls_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $accCls_code_by_help ;

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

/*search Acc Class code code when click on help button*/


/*search Acc Class code code on input*/

	public function search_AccClsCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$AccClassSearch = $request->input('AccClassSearch');

	    	$AccClasCode_list = DB::select("SELECT * FROM `master_acc_class` WHERE acc_class_code LIKE '$AccClassSearch%'");

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







/*search Acc Category when click on help button*/
	
	public function HelpAccCatCodeGet(Request $request){

		$response_array = array();

	    $AccCatHelp = $request->input('AccCatHelp');

		if ($request->ajax()) {

	    	$accCat_code_by_help = DB::select("SELECT * FROM `master_acc_category` WHERE acc_category_code='$AccCatHelp' OR acc_category_name='$AccCatHelp' OR acc_category_code Like '$AccCatHelp%' OR acc_category_name LIKE '$AccCatHelp%' ORDER BY acc_category_code DESC limit 5  ");
	    	
    		if ($accCat_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $accCat_code_by_help ;

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

/*search Acc Category code when click on help button*/


/*search Acc Category code on input*/

	public function search_AccCatCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$AccCateSearch = $request->input('AccCateSearch');

	    	$AccCatcode_list = DB::select("SELECT * FROM `master_acc_category` WHERE acc_category_code LIKE '$AccCateSearch%'");

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




/*search Cost Type when click on help button*/
	
	public function HelpCostTypeCodeGet(Request $request){

		$response_array = array();

	    $CostTypeHelp = $request->input('CostTypeHelp');

		if ($request->ajax()) {

	    	$costtype_code_by_help = DB::select("SELECT * FROM `master_cost_type` WHERE cost_type_code='$CostTypeHelp' OR cost_type_name='$CostTypeHelp' OR cost_type_code Like '$CostTypeHelp%' OR cost_type_name LIKE '$CostTypeHelp%' ORDER BY cost_type_code DESC limit 5  ");
	    	
    		if ($costtype_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costtype_code_by_help ;

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

/*search Cost Type code when click on help button*/


/*search Cost Type code on input*/

	public function search_CostTypeCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$CostTypeSearch = $request->input('CostTypeSearch');

	    	$costtypecode_list = DB::select("SELECT * FROM `master_cost_type` WHERE cost_type_code LIKE '$CostTypeSearch%'");

	    	$count = count($costtypecode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costtypecode_list ;

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

/*search Cost Type code on input*/



/*search Cost Group when click on help button*/
	
	public function HelpCostGroupCodeGet(Request $request){

		$response_array = array();

	    $CostGrpHelp = $request->input('CostGrpHelp');

		if ($request->ajax()) {

	    	$costgroup_code_by_help = DB::select("SELECT * FROM `master_cost_group` WHERE cost_group_code='$CostGrpHelp' OR cost_group_name='$CostGrpHelp' OR cost_group_code Like '$CostGrpHelp%' OR cost_group_name LIKE '$CostGrpHelp%' ORDER BY cost_group_code DESC limit 5  ");
	    	
    		if ($costgroup_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costgroup_code_by_help ;

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

/*search Cost Group code when click on help button*/


/*search Cost Group code on input*/

	public function search_CostGroupCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$CostGrpSearch = $request->input('CostGrpSearch');

	    	$costgroupcode_list = DB::select("SELECT * FROM `master_cost_group` WHERE cost_group_code LIKE '$CostGrpSearch%'");

	    	$count = count($costgroupcode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costgroupcode_list ;

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

/*search Cost Group code on input*/


/*search Cost Class when click on help button*/
	
	public function HelpCostClassCodeGet(Request $request){

		$response_array = array();

	    $CostClsHelp = $request->input('CostClsHelp');

		if ($request->ajax()) {

	    	$costclass_code_by_help = DB::select("SELECT * FROM `master_cost_class` WHERE cost_class_code='$CostClsHelp' OR cost_class_name='$CostClsHelp' OR cost_class_code Like '$CostClsHelp%' OR cost_class_name LIKE '$CostClsHelp%' ORDER BY cost_class_code DESC limit 5  ");
	    	
    		if ($costclass_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costclass_code_by_help ;

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

/*search Cost Class code when click on help button*/


/*search Cost Class code on input*/

	public function search_CostClassCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$CostClsSearch = $request->input('CostClsSearch');

	    	$costclascode_list = DB::select("SELECT * FROM `master_cost_class` WHERE cost_class_code LIKE '$CostClsSearch%'");

	    	$count = count($costclascode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costclascode_list ;

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

/*search Cost Class code on input*/


/*search zone when click on help button*/
	
	public function HelpZoneCodeGet(Request $request){

		$response_array = array();

	    $ZoneCodeHelp = $request->input('ZoneCodeHelp');

		if ($request->ajax()) {

	    	$zone_code_by_help = DB::select("SELECT * FROM `master_zone` WHERE zone_code='$ZoneCodeHelp' OR zone_name='$ZoneCodeHelp' OR zone_code Like '$ZoneCodeHelp%' OR zone_name LIKE '$ZoneCodeHelp%' ORDER BY zone_code DESC limit 5  ");
	    	
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

	    	$Zonecode_list = DB::select("SELECT * FROM `master_zone` WHERE zone_code LIKE '$zoneCodeSearch%'");

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


/*search cost category when click on help button*/
	
	public function Helpcostcat_Get(Request $request){

		$response_array = array();

	    $CostCatHelp = $request->input('CostCatHelp');

		if ($request->ajax()) {

	    	$costcat_code_by_help = DB::select("SELECT * FROM `master_costcatg` WHERE costcatg_code='$CostCatHelp' OR costcatg_name='$CostCatHelp' OR costcatg_code Like '$CostCatHelp%' OR costcatg_name LIKE '$CostCatHelp%' ORDER BY costcatg_code DESC limit 5  ");
	    	
    		if ($costcat_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costcat_code_by_help ;

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

/*search cost category code when click on help button*/


/*search cost category code on input*/

	public function search_costcatCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$CostCatSearch = $request->input('CostCatSearch');

	    	$costcatcode_list = DB::select("SELECT * FROM `master_costcatg` WHERE costcatg_code LIKE '$CostCatSearch%'");

	    	$count = count($costcatcode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costcatcode_list ;

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

/*search cost category code on input*/


/*search cost when click on help button*/
	
	public function Helpcost_Get(Request $request){

		$response_array = array();

	    $CostCodeHelp = $request->input('CostCodeHelp');

		if ($request->ajax()) {

	    	$cost_code_by_help = DB::select("SELECT * FROM `master_cost` WHERE cost_code='$CostCodeHelp' OR cost_name='$CostCodeHelp' OR cost_code Like '$CostCodeHelp%' OR cost_name LIKE '$CostCodeHelp%' ORDER BY cost_code DESC limit 5  ");
	    	
    		if ($cost_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $cost_code_by_help ;

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

/*search cost code when click on help button*/


/*search cost code on input*/

	public function search_costCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$CostCodeSearch = $request->input('CostCodeSearch');

	    	$costcode_list = DB::select("SELECT * FROM `master_cost` WHERE cost_code LIKE '$CostCodeSearch%'");

	    	$count = count($costcode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costcode_list ;

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

/*search cost code on input*/


/*search Account code when click on help button*/
	
	public function HelpAccCode_Get(Request $request){

		$response_array = array();

	    $AccCodeHelp = $request->input('AccCodeHelp');

		if ($request->ajax()) {

	    	$Acc_code_by_help = DB::select("SELECT * FROM `master_party` WHERE acc_code='$AccCodeHelp' OR acc_name='$AccCodeHelp' OR acc_code Like '$AccCodeHelp%' OR acc_name LIKE '$AccCodeHelp%' ORDER BY acc_code DESC limit 5  ");
	    	
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

	    	$Acccode_list = DB::select("SELECT * FROM MASTER_ACC WHERE ACC_CODE LIKE '$acc_code%'");

	    	$Acccode = DB::select("SELECT * FROM MASTER_ACC WHERE ACC_CODE='$acc_code'");

	    	$count = count($Acccode);

    		if ($count > 0) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Acccode_list ;
	            $response_array['data_acc'] = $Acccode ;

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


/*search glkey code when click on help button*/
	
	public function HelpGl_key_Get(Request $request){

		$response_array = array();

	    $GlkeyHelp = $request->input('GlkeyHelp');

		if ($request->ajax()) {

	    	$glkeycode_by_help = DB::select("SELECT * FROM `glkey_master` WHERE glkey_code='$GlkeyHelp' OR glkey_code Like '$GlkeyHelp%' ORDER BY glkey_code DESC limit 5  ");
	    	
    		if ($glkeycode_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $glkeycode_by_help ;

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

/*search glkey code when click on help button*/

/*search Glkey on input*/

	public function search_glkeycode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$glkeysearch = $request->input('glkeysearch');

	    	$glkey_list = DB::select("SELECT * FROM `glkey_master` WHERE glkey_code LIKE '$glkeysearch%'");

	    	$count = count($glkey_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $glkey_list ;

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

/*search Glkey on input*/





/*get tdsname and tdscode by tdsection on applytds button*/

	public function GetTdsCodeNameBySectn(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$tdssectionC = $request->input('tdssectionC');

	    	$tdscode_list = DB::table('MASTER_TDS')->where('TDS_CODE', $tdssectionC)->get()->first();

	    	 $glcode_data = DB::table('MASTER_GL')->where('GL_CODE', $tdscode_list->GL_CODE)->get()->first();


	    	//$count = count($glcode_data);

    		if ($glcode_data) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $glcode_data;
	           

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

/*get tdsname and tdscode by tdsection on applytds button*/


/*sales transaction*/

	public function item_code_for_sale_tran(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$itemCode = $request->input('itemcode');
	    
	    	//DB::enableQueryLog();
	    	$fetch_reocrd = DB::table('master_item')->where('item_code',$itemCode)->get();
	    	//dd(DB::getQueryLog());

	    	//$fetch_tds_rate = DB::table('master_tds_rate')->where('acc_code',$itemCode)->get()->toArray();

    		if ($fetch_reocrd!='') {

    			//echo "<PRE>";
	    	//print_r($fetch_tds_rate);
	    	//echo "</PRE>";

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fetch_reocrd ;
	           // $response_array['data_tds'] = $fetch_tds_rate ;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
               // $response_array['data_tds'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '';
                $response_array['data_tds'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

 	}
/*sales transaction*/


/*get data from trans tax master for sales order*/



/*get data from trans tax master for sales order*/



/*plant code by profit center code*/

	public function Plant_code_by_pfct(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$Profit_Center_code = $request->input('Profit_Center_code');

	    
	    	$profit_center_list = DB::table('master_plant')->where('pfct_code', $Profit_Center_code)->get();

    		if ($profit_center_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $profit_center_list ;

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


/*plant code by profit center code*/

/*get pfct code by plant in indend trans*/
	public function pfct_by_plant_in_indend(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$Plant_code = $request->input('Plant_code');
	    	//DB::enableQueryLog();
	   		$pfct_list = DB::table('MASTER_PLANT')
				->select('MASTER_PLANT.*', 'MASTER_PFCT.*')
           		->leftjoin('MASTER_PFCT', 'MASTER_PLANT.PFCT_CODE', '=', 'MASTER_PFCT.PFCT_CODE')
            	->where([['MASTER_PLANT.PLANT_CODE','=',$Plant_code]])
            	->get();
            //	dd(DB::getQueryLog());
           
    		if ($pfct_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $pfct_list;

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


    public function get_seriscode_data(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$sers_code = $request->input('sers_code');

	    	//DB::enableQueryLog();
	   		$series_data = DB::table('MASTER_CONFIG')->where('SERIES_CODE',$sers_code)->get()->toArray();
	    	//print_r($series_data);exit;
            //	dd(DB::getQueryLog());
           
    		if ($series_data) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $series_data;

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


    

    public function get_AccCode_data(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$accCode = $request->input('accCode');

	    	//print_r($accCode);exit;

	    	//DB::enableQueryLog();
	   		/*$acc_data = DB::table('MASTER_ACC')->where('ACC_CODE',$accCode)->get()->toArray();

	   		$data =	DB::SELECT("SELECT S.*,C,* FROM MASTER_ACC S  LEFT JOIN MASTER_ACCADD C ON C.SERIES_CODE = S.SERIES_CODE");*/

	   		$acc_data = DB::table('MASTER_ACC')
				->select('MASTER_ACC.*','MASTER_ACCADD.ADD1','MASTER_ACCADD.CITY_CODE','MASTER_ACCADD.STATE_CODE','MASTER_ACCADD.EMAIL_ID','MASTER_ACCADD.CONTACT_NO')
           		->leftjoin('MASTER_ACCADD', 'MASTER_ACCADD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
            	->where([['MASTER_ACC.ACC_CODE','=',$accCode]])
            	->get();
	    	//print_r($acc_data);exit;
            //	dd(DB::getQueryLog());
           
    		if($acc_data) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $acc_data;

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
/*get pfct code by plant in indend trans*/

/*get pfct code by plant code*/
	
	

/*get pfct code by plant code*/



/*get pfct code and quotation num by plant code*/
	
	public function pfct_quotn_by_plantcode(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$Plant_code = $request->input('Plant_code');

	   		$pfct_list = DB::table('MASTER_PLANT')
				->select('MASTER_PLANT.*', 'MASTER_PFCT.*')
           		->leftjoin('MASTER_PFCT', 'MASTER_PLANT.PFCT_CODE', '=', 'MASTER_PFCT.PFCT_CODE')
            	->where([['MASTER_PLANT.PLANT_CODE','=',$Plant_code]])
            	->get();
            //DB::enableQueryLog();
           	$quotnNum = DB::table('PQTN_HEAD')->where([['PLANT_CODE','=',$Plant_code]])
            	->get();
			//dd(DB::getQueryLog());
    		if ($pfct_list && $quotnNum) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $pfct_list ;
	            $response_array['quotn'] = $quotnNum ;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['quotn'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['quotn'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

/*get pfct code by plant code*/

/*get enquiry by plant code for quotation*/

	

/*get enquiry by plant code for quotation*/

public function search_cash_code(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$cash_code_search = $request->input('cash_code_search');

	    	$cash_code = DB::select("SELECT * FROM `master_housecash` WHERE cash_code LIKE '$cash_code_search%'");

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

	    	$Seach_cash_Code_by_help = DB::select("SELECT * FROM `master_housecash` WHERE cash_code='$cash_code_help' OR cash_code Like '$cash_code_help%' ORDER BY cash_code DESC limit 5  ");
	    	
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


    public function AccountTypeForm(Request $request){

     	$title = 'Add Master A Type';

     	$compName  = $request->session()->get('company_name');

     	$data['help_acc_type_list'] = DB::table('master_finance_acctype')->Orderby('acctype_code', 'desc')->limit(5)->get();

    	return view('admin.finance.master.acc_type_form',$data+compact('title'));

    if(isset($compName)){

    	return view('admin.finance.transaction.journal_trans',$userdata+compact('glkey_list','title'));
    }else{

		return redirect('/useractivity');
	}

    }

    public function AccountTypeFormSave(Request $request){

 	//print_r($request->post());exit;
    	$validate = $this->validate($request, [

			'acc_type_code' => 'required|max:20|unique:master_finance_acctype,acctype_code',
			'acc_type_name' => 'required|max:30',	
			
		]);

		$createdBy = $request->session()->get('userid');
		
		$compName  = $request->session()->get('company_name');
		
		$fisYear   =  $request->session()->get('macc_year');
		$flag=0;

		$acctypeData = DB::table('master_finance_acctype')->orderBy('id', 'DESC')->first();
    	if(!empty($acctypeData)){

    		$getID= $acctypeData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}
		$data = array(
			"id"           => $id,
			"comp_name"    => $compName,
			"fiscal_year"  => $fisYear,
			"acctype_code" => $request->input('acc_type_code'),
			"acctype_name" => $request->input('acc_type_name'),
			"flag"         => $flag,
			"created_by"   => $createdBy
			
		);

		$saveData = DB::table('master_finance_acctype')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Account Type Was Successfully Added...!');
			return redirect('/finance/view-mast-acc-type');

		} else {

			$request->session()->flash('alert-error', 'Account Type Can Not Added...!');
			return redirect('/finance/view-mast-acc-type');

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

    		$data = DB::table('master_finance_acctype')->orderBy('id','DESC');

    		/*$data = DB::table('master_finance_acctype')
            ->leftJoin('code_access', 'master_finance_acctype.acctype_code', '=', 'code_access.code')
            ->select('master_finance_acctype.*', 'code_access.inward_trans','code_access.sap_bill','code_access.fleet_trans','code_access.fleet_mast','code_access.rate_mast','code_access.acc_mast')
            ->orderBy('id','DESC');*/

            
		
    	 
		}else if($userType=='superAdmin' || $userType=='user'){

			$data = DB::table('master_finance_acctype')->orderBy('id','DESC');

			

		}else{

			$data ='';
			
		}

		 return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
				
			})->toJson();

	}
    	if(isset($compName)){

    	return view('admin.finance.master.view_acc_type');
    }else{
		return redirect('/useractivity');
	   }


    }

    public function EditAccountTypeForm($typeCode){

    	$title = 'Edit Master Account Type';

    	$typeCode= base64_decode($typeCode);
    	//print_r($typeCode);exit;
    	//$btnControl = base64_decode($btnControl);
    	//print_r($id);
    	if($typeCode!=''){
				$query = DB::table('master_finance_acctype');
				$query->where('acctype_code', $typeCode);
				$acctypeData['acctype_list']  = $query->get()->first();
				
			return view('admin.finance.master.acc_type_list', $acctypeData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Account Type Not Found...!');
			return redirect('/view-mast-account-type');
		}

    }

    public function AccountTypeFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'acc_type_code' => 'required|max:20',
			'acc_type_name' => 'required|max:30',	
			
		]);

		$acctypeCode = $request->input('acctypeCode');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');

		$data = array(
			"acctype_code"    => $request->input('acc_type_code'),
			"acctype_name"    => $request->input('acc_type_name'),
			"flag"            => $request->input('acctype_block'),
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" => $updatedDate
			
		);

		try{

		$saveData = DB::table('master_finance_acctype')->where('acctype_code',$acctypeCode)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Account Type Was Successfully Update...!');
			return redirect('/finance/view-mast-acc-type');

		} else {

			$request->session()->flash('alert-error', 'Account Type Can Not Update...!');
			return redirect('/finance/view-mast-acc-type');

		}
	}
	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Account Type be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-mast-acc-type');
			}
    }

    public function DeleteAccountType(Request $request){

    	$acctypeCode= $request->post('acctypeID');
   // print_r($acctypeCode);exit;

    	if ($acctypeCode!='') {

    		try{
    		
    		$Delete = DB::table('master_finance_acctype')->where('acctype_code',$acctypeCode)->delete();



			if ($Delete) {

				$request->session()->flash('alert-success', ' Account Type Was Deleted Successfully...!');
				return redirect('/finance/view-mast-acc-type');

			} else {

				$request->session()->flash('alert-error', 'Account Type Can Not Deleted...!');
				return redirect('/finance/view-mast-acc-type');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Account Type be be Deleted...! Used In Another Transaction...!');
					return redirect('/finance/view-mast-acc-type');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Account Type Found...!');
			return redirect('/finance/view-mast-acc-type');

    	}
    }




  /*Item Form*/







/*search item code finance on input*/
	 public function search_ItemsCodeFinance(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$ItemCodeSearch = $request->input('ItemCodeSearch');

	    	$item_code_list = DB::select("SELECT * FROM `master_item_finance` WHERE item_code LIKE '$ItemCodeSearch%'");

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
/*search item code finance on input*/

/*search item code when click on help button finance*/
	public function HelpItemCodeSearchFinance(Request $request){

		$response_array = array();

	    $item_code_help = $request->input('HelpItemCode');

		if ($request->ajax()) {

	    	$Seach_item_Code_by_help = DB::select("SELECT * FROM `master_item_finance` WHERE item_code='$item_code_help' OR item_name='$item_code_help' OR item_code Like '$item_code_help%' OR item_name LIKE '$item_code_help%' ORDER BY item_code DESC limit 5  ");
	    	
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
/*search item code when click on help button finance*/

/*search hsn code finance on input*/
	 public function search_hsn_for_item(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$hsnCode = $request->input('hsnCode');

	    	$hsn_code_list = DB::select("SELECT * FROM `master_hsn` WHERE hsn_code LIKE '$hsnCode%'");

	    	$count = count($hsn_code_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $hsn_code_list ;

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
/*search hsn code finance on input*/

/*search hsn code when click on help button finance*/
	public function HelpHsnCodeSearch(Request $request){

		$response_array = array();

	    $HelphsnCode = $request->input('HelphsnCode');

		if ($request->ajax()) {

	    	$Seach_hsn_Code_by_help = DB::select("SELECT * FROM `master_hsn` WHERE hsn_code='$HelphsnCode' OR hsn_name='$HelphsnCode' OR hsn_code Like '$HelphsnCode%' OR hsn_name LIKE '$HelphsnCode%' ORDER BY hsn_code DESC limit 5  ");
	    	
    		if ($Seach_hsn_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_hsn_Code_by_help ;

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
/*search hsn code when click on help button finance*/


/*tax indicator master*/

	public function TaxIndicator(Request $request){

    	$title = 'Add Master Item';

    	$compName 	= $request->session()->get('company_name');

    	$data['help_tax_ind_list'] = DB::table('master_tax_indicator')->Orderby('tax_ind_code', 'desc')->get();
        
    	
    if(isset($compName)){

    	return view('admin.finance.master.tax_indicator_form',$data+compact('title'));

    }else{

		return redirect('/useractivity');
	}

    }

    public function TaxIndicatorSave(Request $request){

    	$validate = $this->validate($request, [

			'tax_ind_code'      => 'required|max:4|unique:master_tax_indicator,tax_ind_code',
			'tax_ind_name'      => 'required|max:40',

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$flag=0;

    	$taxindData = DB::table('master_tax_indicator')->orderBy('id', 'DESC')->first();
    	if(!empty($taxindData)){

    		$getID= $taxindData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}

		$data = array(
			"id"           => $id,
			"comp_name"    => $compName,
			"fiscal_year"  => $fisYear,
			"tax_ind_code" => $request->input('tax_ind_code'),
			"tax_ind_name" => $request->input('tax_ind_name'),
			"flag"         => $flag,
			"created_by"   => $createdBy,
			
		);

		$saveData = DB::table('master_tax_indicator')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Tax Indicator Was Successfully Added...!');
			return redirect('/finance/view-tax-indicator');

		} else {

			$request->session()->flash('alert-error', 'Tax Indicator Can Not Added...!');
			return redirect('/finance/view-tax-indicator');

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

	    	//$data = DB::table('master_depot')->orderBy('id','DESC');

	    	$data = DB::table('master_tax_indicator')->orderBy('id','DESC');

	    	
	    	}
	    	elseif ($userType=='superAdmin' || $userType=='user') {

	    	$data = DB::table('master_tax_indicator')->orderBy('id','DESC');
	    	}
	    	

	   return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
					
				})->toJson();

	    }

	    if(isset($compName)){
    	return view('admin.finance.master.view_tax_indicator_form');
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
    	    $query = DB::table('master_tax_indicator');
			$query->where('tax_ind_code', $id);
			$userData['tax_ind_list'] = $query->get()->first();

			

			return view('admin.finance.master.edit_tax_indicator', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Item-Id Not Found...!');
			return redirect('/form-mast-depot');
		}

    }

    public function TaxIndicatorUpdate(Request $request){

    	//print_r($request->post());exit;

    	
    	$validate = $this->validate($request, [

			'tax_ind_code'      => 'required|max:4',
			'tax_ind_name'      => 'required|max:40',

		]);

		$TaxIndId=$request->input('updateTaxIndId');
		//print_r($request->post());exit;
		$compName = $request->session()->get('company_name');

	    $fisYear =  $request->session()->get('macc_year');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');
		 

		$data = array(
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"tax_ind_code"    => $request->input('tax_ind_code'),
			"tax_ind_name"    => $request->input('tax_ind_name'),
			"flag"            => $request->input('tax_ind_block'),
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" => $updatedDate,
			
		);
		
try{
		$saveData = DB::table('master_tax_indicator')->where('tax_ind_code', $TaxIndId)->update($data);
		if ($saveData) {

			$request->session()->flash('alert-success', 'Tax Indicator Was Successfully Updated...!');
			return redirect('/finance/view-tax-indicator');

		} else {

			$request->session()->flash('alert-error', 'Tax Indicator Can Not Updated...!');
			return redirect('/finance/view-tax-indicator');

		}
	}
	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Tax Indicator Not Be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-tax-indicator');
			}
    }


    public function DeleteTaxIndicator(Request $request){

        $id = $request->input('taxindelete');
        if ($id!='') {
        	try{

			$Delete = DB::table('master_tax_indicator')->where('tax_ind_code', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Tax Indicator Data Was Deleted Successfully...!');
			return redirect('/finance/view-tax-indicator');

			} else {

			$request->session()->flash('alert-error', 'Tax Indicator Data Can Not Deleted...!');
			return redirect('/finance/view-tax-indicator');

			}
		}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Tax Indicator Not Be Deleted...! Used In Another Transaction...!');
					return redirect('/finance/view-tax-indicator');
			}


		}else{

		$request->session()->flash('alert-error', 'Tax Indicator Data Not Found...!');
		return redirect('/finance/view-tax-indicator');

		}
	}

/*tax indicator master*/

/*um master*/

    public function UmFormMaster(Request $request){

        $title = 'Add Master Um';

        $compName = $request->session()->get('company_name');
        
        $data['help_um_list'] = DB::table('master_um_finance')->Orderby('um_code', 'desc')->limit(5)->get();

        return view('admin.finance.master.um_form_finance',$data+compact('title'));

     if(isset($compName)){

    	return view('admin.finance.master.tax_indicator_form',$data+compact('title'));

    }else{

		return redirect('/useractivity');
	}

    }

    public function UmFormSaveMaster(Request $request){

        $validate = $this->validate($request, [

            'um_code'    => 'required|max:2|unique:master_um_finance,um_code',
            'um_name'    => 'required|max:30',
            
        ]);

        $createdBy = $request->session()->get('userid');

        $compName = $request->session()->get('company_name');

        $fisYear =  $request->session()->get('macc_year');
        $flag =0;
        $umData = DB::table('master_um_finance')->orderBy('id', 'DESC')->first();
    	if(!empty($umData)){

    		$getID= $umData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}
        $data = array(
            "id"   => $id,
            "comp_name"   => $compName,
            "fiscal_year" => $fisYear,
            "um_code"     => $request->input('um_code'),
            "um_name"     => $request->input('um_name'),
            "flag"        => $flag,
            "created_by"  => $createdBy
            
        );

        $saveData = DB::table('master_um_finance')->insert($data);

        if ($saveData) {

            $request->session()->flash('alert-success', 'Um Was Successfully Added...!');
            return redirect('/finance/view-um-master');

        } else {

            $request->session()->flash('alert-error', 'Um Can Not Added...!');
            return redirect('/finance/view-um-master');

        }

    }

    public function UmViewMaster(Request $request){

    $compName = $request->session()->get('company_name');

    if($request->ajax()) {

        $title = 'View Master Um';

        $userid    = $request->session()->get('userid');

        $userType = $request->session()->get('usertype');

        $compName = $request->session()->get('company_name');

        $fisYear =  $request->session()->get('macc_year');


        if($userType=='admin'){

            //$data = DB::table('master_um')->orderBy('id','DESC');

            $data = DB::table('master_um_finance')
            ->leftJoin('code_access', 'master_um_finance.um_code', '=', 'code_access.code')
            ->select('master_um_finance.*','code_access.item_um_mast')
            ->orderBy('id','DESC');

         
        }else if($userType=='superAdmin' || $userType=='user'){

            /*$data = DB::table('master_um')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear]);*/

            $data = DB::table('master_um_finance')
            ->leftJoin('code_access', 'master_um_finance.um_code', '=', 'code_access.code')
            ->select('master_um_finance.*','code_access.item_um_mast')
            ->orderBy('id','DESC');

            
        }else{

            $data='';
            
        }

         return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
    }

    	if(isset($compName)){
        return view('admin.finance.master.view_um_form_finance');
    	}else{
		return redirect('/useractivity');
	   }

    }

    public function EditUmFormMaster($id){

        $title = 'Edit Master Um';

        $umcode = base64_decode($id);
        //$btnControl = base64_decode($btnControl);
        //print_r($id);
        if($umcode!=''){
            $query = DB::table('master_um_finance');
            $query->where('um_code', $umcode);
            $umData['um_list'] = $query->get()->first();

            return view('admin.finance.master.edit_um_form_finance', $umData+compact('title'));
        }else{
            $request->session()->flash('alert-error', 'Um Not Found...!');
            return redirect('/finance/view-um-master');
        }

    }

    public function UmFormUpdateMaster(Request $request){

        $validate = $this->validate($request, [

            'um_code'    => 'required|max:2',
            'um_name'    => 'required|max:30',
            
        ]);

        $lastUpdatedBy = $request->session()->get('userid');
        $updatedDate = date('Y-m-d');

        $umCode = $request->input('umId');
        $data = array(
            "um_code"      => $request->input('um_code'),
            "um_name"      => $request->input('um_name'),
            "flag"         => $request->input('um_block'),
            "updated_by"   => $lastUpdatedBy,
            "updated_date" => $updatedDate
            
            
        );
try{
         $saveData = DB::table('master_um_finance')->where('um_code',$umCode)->update($data);

        if ($saveData) {

            $request->session()->flash('alert-success', 'Um Was Successfully Added...!');
            return redirect('/finance/view-um-master');

        } else {

            $request->session()->flash('alert-error', 'Um Can Not Added...!');
            return redirect('/finance/view-um-master');

        }
    }
    catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'UM Code Cannot be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-um-master');
			}
    }

    public function DeleteUmMaster(Request $request){

        $UmID = $request->post('UmID');

        if ($UmID!='') {
            try{
            $Delete = DB::table('master_um_finance')->where('um_code', $UmID)->delete();

            if ($Delete) {

                $request->session()->flash('alert-success', ' Um Was Deleted Successfully...!');
                return redirect('/finance/view-um-master');

            } else {

                $request->session()->flash('alert-error', 'Um Can Not Deleted...!');
                return redirect('/finance/view-um-master');

            }
        }
          catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'UM Code Cannot be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-um-master');
			}

        }else{

            $request->session()->flash('alert-error', 'Um Not Found...!');
            return redirect('/finance/view-um-master');

        }
    }

/*um master*/

/*master hsn*/

public function hsnMaster(Request $request){

		$title = 'Add Master HSN';

		$compName 	= $request->session()->get('company_name');

		$data['help_hsn_list'] = DB::table('master_hsn')->Orderby('hsn_code', 'desc')->get();


		
		if(isset($compName)){

    	return view('admin.finance.master.hsn_form',$data+compact('title'));

    }else{

		return redirect('/useractivity');
	}

}


public function SaveHsnMaster(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$validate = $this->validate($request, [

				'hsn_code'        => 'required|max:8|unique:master_hsn,hsn_code',
				'hsn_name'        => 'required|max:50',
				'hsn_discription' => 'required|max:100',

		]);

		$hsnData = DB::table('master_hsn')->orderBy('id', 'DESC')->first();
        if(!empty($hsnData)){

            $getID= $hsnData->id;

            $id=$getID+1;

        }else{
            $id=1;
        }

		$data = array(
				"id"			  => $id,
				"hsn_code"        => $request->input('hsn_code'),
				"hsn_name"        => $request->input('hsn_name'),
				"hsn_discription" => $request->input('hsn_discription'),
				"created_by"      => $request->session()->get('userid'),
				"comp_name"       => $compName,
				"fiscal_year"     => $fisYear
	 
	    	);

		$saveData = DB::table('master_hsn')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'HSN Was Successfully Added...!');
				return redirect('/finance/view-hsn-master');

			} else {

				$request->session()->flash('alert-error', 'HSN Can Not Added...!');
				return redirect('/finance/view-hsn-master');

			}

	}


public function ViewHsnMaster(Request $request){

    
    $compName = $request->session()->get('company_name');

	if($request->ajax()) {
       

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){

    	 $data = DB::table('master_hsn')->orderBy('id','DESC');
    	}
    	elseif ($userType=='superAdmin' || $userType=='user') {

    		$data = DB::table('master_hsn')->orderBy('id','DESC');
    	}
    	else{
    		$data='';
    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }
    	$title = 'View Master HSN';

    	if(isset($compName)){

    	return view('admin.finance.master.view_hsn_form',compact('title'));
    }else{
		return redirect('/useractivity');
	   }

    }


   	public function EditHsnMaster($id){

    	$title = 'Edit HSN';

    	$hsncode = base64_decode($id);
    	//print_r($id);


    	if($hsncode!=''){
    	    $query = DB::table('master_hsn');
			$query->where('hsn_code', $hsncode);
			$userData['hsn_list'] = $query->get()->first();


			return view('admin.finance.master.edit_hsn_form', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'HSN Id Not Found...!');
			return redirect('/finance/view-hsn-master');
		}

    }


    public function UpdateHsnMaster(Request $request){

		//print($request->post());exit;
		$validate = $this->validate($request, [
				
				'hsn_code' => 'required|max:8',
				'hsn_name' => 'required|max:50',
				'hsn_discription' => 'required|max:100',


		]);

        $id = $request->input('hsn_id');
        $updatedDate = date('Y-m-d');

		$data = array(
				"hsn_code"        =>  $request->input('hsn_code'),
				"hsn_name"        =>  $request->input('hsn_name'),
				"hsn_discription" =>  $request->input('hsn_discription'),
				"hsn_block"       =>  $request->input('hsn_block'),
				"last_updat_by"   =>  $request->session()->get('userid'),
				"last_updat_date" =>  $updatedDate
	 
	    	);

		//print_r($data);exit;

try{
		$saveData = DB::table('master_hsn')->where('hsn_code', $id)->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'HSN Was Successfully Updated...!');
				return redirect('/finance/view-hsn-master');

			} else {

				$request->session()->flash('alert-error', 'HSN Can Not Updated...!');
				return redirect('/finance/view-hsn-master');

			}
		}
		  catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'HSN Code Cannot be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-hsn-master');
			}


	}


	public function DeletehsnMaster(Request $request){

        $id = $request->input('hsn_code');
        if ($id!='') {

try{
			$Delete = DB::table('master_hsn')->where('hsn_code', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'HSN Data Was Deleted Successfully...!');
			return redirect('/finance/view-hsn-master');

			} else {

			$request->session()->flash('alert-error', 'HSN Data Can Not Deleted...!');
			return redirect('/finance/view-hsn-master');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'HSN Data Cannot be Deleted...! Used In Another Transaction...!');
					return redirect('/finance/view-hsn-master');
			}

		}else{

		$request->session()->flash('alert-error', 'HSN Data Not Found...!');
		return redirect('/finance/view-hsn-master');

		}
	}


/*master hsn*/


/*master hsn rate*/

	public function hsnRate(Request $request){

		$title = 'Add Master HSN Rate';

		$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

		$userData['hsn_list']  = DB::table('master_hsn')->get();
		$userData['tax_code']  = DB::table('master_tax')->get();
		

	if(isset($compName)){

    	return view('admin.finance.master.hsn_rate_form',$userData+compact('title'));

    }else{

		return redirect('/useractivity');
	}

	}


	public function SaveHsnRate(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		/*$validate = $this->validate($request, [

				'hsn_code' => 'required',
				'tax_code'  => 'required|unique:master_hsn_rate,tax_code',

		]);*/

		request()->validate([

            'hsn_code'        => 'required|max:255',

            'tax_code'  => [

                'required', 

                Rule::unique('master_hsn_rate')->where(function ($query) use ($request) {

                    return $query
                        ->where('hsn_code',$request->hsn_code)
                        ->where('tax_code',$request->tax_code);
                }),
            ],
        ],
        [
            'tax_code.unique' => __('*tax code already taken, for this HSN.', [

                'hsn_code'  => $request->hsn_code, 
                'tax_code'  => $request->tax_code
            ]),
        ]);

		$data = array(
				//"id"          => $id,
				"hsn_code"    => $request->input('hsn_code'),
				"tax_code"    => $request->input('tax_code'),
				"tax_type"    => $request->input('taxType'),
				"created_by"  => $request->session()->get('userid'),
				"comp_name"   => $compName,
				"fiscal_year" => $fisYear
	 
	    	);

		$saveData = DB::table('master_hsn_rate')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'HSN Rate Was Successfully Added...!');
				return redirect('/finance/view-hsn-rate-master');

			} else {

				$request->session()->flash('alert-error', 'HSN Rate Can Not Added...!');
				return redirect('/finance/view-hsn-rate-master');

			}

	}


	public function ViewHsnRateMaster(Request $request){
$compName = $request->session()->get('company_name');
    	
	if($request->ajax()) {
       

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){

    	 $data = DB::table('master_hsn_rate')->orderBy('id','DESC');
    	}
    	elseif ($userType=='superAdmin' || $userType=='user') {

    		$data = DB::table('master_hsn_rate')->orderBy('id','DESC');
    	}
    	else{
    		$data='';
    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }
    	$title = 'View Master HSN Rate';

    	if(isset($compName)){

    	return view('admin.finance.master.view_hsn_rate_form',compact('title'));
    }else{
    	return redirect('/useractivity');
    }

    }


    public function EditHsnRate(Request $request,$id){

    	$title = 'Edit HSN Rate';

    	$id = base64_decode($id);
    	//print_r($id);
    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($id!=''){
    	    $query = DB::table('master_hsn_rate');
			$query->where('id', $id);
			$userData['hsnrate_list'] = $query->get()->first();

			$userData['hsn_list']  = DB::table('master_hsn')->get();
			$userData['tax_code']  = DB::table('master_tax')->get();


			return view('admin.finance.master.edit_hsn_rate_form', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'HSN Id Not Found...!');
			return redirect('/finance/view-hsn-rate-master');
		}

    }

    public function UpdateHsnRate(Request $request){

		//print($request->post());exit;
		$validate = $this->validate($request, [
				
				'hsn_code' => 'required',
				'tax_code'  => 'required|unique:master_hsn_rate,tax_code',


		]);

        $id = $request->input('hsnrate_id');
       $updatedDate = date('Y-m-d');

		$data = array(
				"hsn_code"        =>  $request->input('hsn_code'),
				"tax_code"        =>  $request->input('tax_code'),
				"tax_type"        => $request->input('taxType'),
				"hsnrate_block"   =>  $request->input('hsnrate_block'),
				"last_updat_by"   =>  $request->session()->get('userid'),
				"last_updat_date" =>  $updatedDate
				
	    	);

		//print_r($data);exit;

		$saveData = DB::table('master_hsn_rate')->where('id', $id)->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'HSN Rate Was Successfully Updated...!');
				return redirect('/finance/view-hsn-rate-master');

			} else {

				$request->session()->flash('alert-error', 'HSN Rate Can Not Updated...!');
				return redirect('/finance/view-hsn-rate-master');

			}


	}

	public function DeletehsnRate(Request $request){

        $id = $request->input('hsnrate_id');
        if ($id!='') {

			$Delete = DB::table('master_hsn_rate')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'HSN Rate Data Was Deleted Successfully...!');
			return redirect('/finance/view-hsn-rate-master');

			} else {

			$request->session()->flash('alert-error', 'HSN Rate Data Can Not Deleted...!');
			return redirect('/finance/view-hsn-rate-master');

			}

		}else{

		$request->session()->flash('alert-error', 'HSN Rate Data Not Found...!');
		return redirect('/finance/view-hsn-rate-master');

		}
	}


/*master hsn rate*/


	
    /*perchase transaction*/
    



/*purchase indend transaction*/


    // Leave type

    public function HouseBankChieldRTowData(Request $request){

		$response_array = array();
        $id = $request->input('id');
	    if ($request->ajax()) {

	    	$housebank_details = DB::table("master_house_bank")->where('id',$id)->get()->first();
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


  //  public function ViewPartyFinanceChieldRTowData(Request $request){

		// $response_array = array();

	 //    $acc_code = $request->input('acc_code');
	    
	 //    if ($request->ajax()) {

	 //    	$partyFinance_details = DB::table("master_party")->where('acc_code',$acc_code)->get()->first();

	 //    	if ($partyFinance_details) {

  //   			$response_array['response'] = 'success';
	 //            $response_array['data'] = $partyFinance_details ;

	 //            $data = json_encode($response_array);

	 //            print_r($data);

		// 	}else{

		// 		$response_array['response'] = 'error';
  //               $response_array['data'] = '' ;

  //               $data = json_encode($response_array);

  //               print_r($data);
				
		// 	}

	 //    }else{

	 //    		$response_array['response'] = 'error';
  //               $response_array['data'] = '' ;

  //               $data = json_encode($response_array);

  //               print_r($data);
	 //    }

  //   }


 public function ViewPartyFinanceChieldRTowData(Request $request){

		$response_array = array();

	    $acc_code = $request->input('acc_code');
	   
	    if ($request->ajax()) {

	    	// $partyFinance_details = DB::table("master_party")->where('acc_code',$acc_code)->get()->first();
	    	// DB::enableQueryLog();
		    $partyFinance_details = DB::table('master_party')
				->select('master_party.*','master_acc_address.acc_code as accCode', 'master_acc_address.sl_no as slNo', 'master_acc_address.contact_person as contactPerson', 'master_acc_address.address as addAddress', 'master_acc_address.pincode as addPin', 'master_acc_address.city as addCity', 'master_acc_address.state as addState', 'master_acc_address.district as addDistrict', 'master_acc_address.phone as addPhone', 'master_acc_address.email as addEmail', 'master_acc_address.fax as addFax')
           		->leftjoin('master_acc_address', 'master_acc_address.acc_code', '=', 'master_party.acc_code')
            	->where('master_acc_address.acc_code',$acc_code)
            	->get()->toArray();
				// dd(DB::getQueryLog());
            	

            	if($partyFinance_details){

            		$array = json_decode( json_encode($partyFinance_details), true);

            	}else{

            		$array = DB::table("master_party")->where('acc_code',$acc_code)->get()->toArray();

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


    public function GetTaxIndicatorDetail(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$taxInd = $request->input('taxInd');

	    	$taxIndData = DB::table('master_tax_indicator')->where('tax_ind_code', $taxInd)->get();

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


    public function CheckAutoPostInTrnas(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$transCode = $request->input('val');

	    	$taxIndData = DB::table('MASTER_TRANSACTION')->where('TRAN_CODE', $transCode)->get();

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



    /* -------- START : Geogaraphycal Master -------- */

    public function CountryMaster(Request $request){

    	$title = 'Country Master';

		$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

		/*$userData['hsn_list']  = DB::table('master_hsn')->get();
		$userData['tax_code']  = DB::table('master_tax')->get();
		*/

		if(isset($compName)){

	    	return view('admin.finance.master.geogaraphycal.add_country',compact('title'));

	    }else{

			return redirect('/useractivity');
		}

    }


    public function CountryMasterSave(Request $request){


    	$validate = $this->validate($request, [
				
			'country_code' => 'required|unique:MASTER_COUNTRY,COUNTRY_CODE',
			'country_name' => 'required|max:40',

		]);

        $flag = 1;

        $userid   = $request->session()->get('userid');

		$data = array(
				"COUNTRY_CODE"  =>  $request->input('country_code'),
				"COUNTRY_NAME"  =>  $request->input('country_name'),
				"CREATED_BY"    =>  $userid,
				"FLAG"          =>  $flag
	    	);

		
		$saveData = DB::table('MASTER_COUNTRY')->insert($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'Country Was Successfully Save...!');
				return redirect('/master/geogaraphycal/view-country-master');

			} else {

				$request->session()->flash('alert-error', 'Country Can Not Be Save...!');
				return redirect('/master/geogaraphycal/view-country-master');

			}


    }


    public function ViewCountryMaster(Request $request){

		$compName = $request->session()->get('company_name');
    	
		if($request->ajax()) {
	       

			$userid   = $request->session()->get('userid');

			$userType = $request->session()->get('usertype');

			$compName = $request->session()->get('company_name');

			$fisYear  =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 $data = DB::table('MASTER_COUNTRY')->orderBy('ID','ASC');
	    	}
	    	elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_COUNTRY')->orderBy('ID','ASC');
	    	}
	    	else{
	    		$data='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

	    }

    	$title = 'View Country';

    	if(isset($compName)){

	    	return view('admin.finance.master.geogaraphycal.view_country',compact('title'));

	    }else{

	    	return redirect('/useractivity');

	    }

    }

    public function DeleteCountryMaster(Request $request){

        $id = $request->input('country_id');
        $countryCode = $request->input('country_code');
        
        if ($id!='' && $countryCode!='') {

	       try{

				$Delete = DB::table('MASTER_COUNTRY')->where('ID', $id)->where('COUNTRY_CODE', $countryCode)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Country Data Was Deleted Successfully...!');
					return redirect('/master/geogaraphycal/view-country-master');

				} else {

					$request->session()->flash('alert-error', 'Country Data Can Not Be Deleted...!');
					return redirect('/master/geogaraphycal/view-country-master');

				}

			}catch(Exception $ex){

				$request->session()->flash('alert-error', 'Country Can Not Be Deleted...! Used In Another Transaction...!');
						return redirect('/master/geogaraphycal/view-country-maste');
			}

		}else{

			$request->session()->flash('alert-error', 'Country Data Not Found...!');
			return redirect('/master/geogaraphycal/view-country-maste');

		}

	}


	public function EditCountryMaster(Request $request,$tblId,$countryCode){

    	$title = 'Edit Country';

		$idTbl       = base64_decode($tblId);
		$countryCode = base64_decode($countryCode);
    	
    	$compName = $request->session()->get('company_name');

    	$fisYear  =  $request->session()->get('macc_year');

    	if($idTbl!='' && $countryCode!=''){

    	    $query = DB::table('MASTER_COUNTRY');
			$query->where('ID', $idTbl);
			$query->where('COUNTRY_CODE', $countryCode);
			$userData['country_list'] = $query->get()->first();

			return view('admin.finance.master.geogaraphycal.edit_country', $userData+compact('title'));
		}else{

			$request->session()->flash('alert-error', 'Country Not Found...!');
			return redirect('/master/geogaraphycal/view-country-maste');

		}

    }


    public function CountryMasterUpdate(Request $request){
		
		$validate = $this->validate($request, [
				
			'country_code' => 'required',
			'country_name' => 'required|max:40',


		]);

        $cId = $request->input('countryId');

        date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

        $userid   = $request->session()->get('userid');

		$data = array(
				"COUNTRY_CODE"     =>  $request->input('country_code'),
				"COUNTRY_NAME"     =>  $request->input('country_name'),
				"COUNTRY_BLOK"     =>  $request->input('country_block'),
				"LAST_UPDATE_BY"   =>  $userid,
				"LAST_UPDATE_DATE" =>  $updatedDate
	    	);

		//print_r($data);exit;

		$saveData = DB::table('MASTER_COUNTRY')->where('ID', $cId)->where('COUNTRY_CODE', $request->input('country_code'))->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'Country Was Successfully Updated...!');
				return redirect('/master/geogaraphycal/view-country-master');

			} else {

				$request->session()->flash('alert-error', 'Country Can Not Be Updated...!');
				return redirect('/master/geogaraphycal/view-country-master');

			}


	}


	public function RegionMaster(Request $request){

		$title = 'Region Master';

		$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	$data['state_list'] = DB::table('MASTER_STATE')->get();

		
		if(isset($compName)){

	    	return view('admin.finance.master.geogaraphycal.add_region',$data+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

	}


	public function RegionMasterSave(Request $request){


		$validate = $this->validate($request, [
				
			'region_code' => 'required|max:6|unique:MASTER_REGION,REGION_CODE',
			'region_name' => 'required|max:40',
			'state_code'  => 'required',

		]);

        $flag = 1;

        $userid   = $request->session()->get('userid');

		$data = array(
				"REGION_CODE"  =>  $request->input('region_code'),
				"REGION_NAME"  =>  $request->input('region_name'),
				"STATE_CODE"   =>  $request->input('state_code'),
				"STATE_NAME"   =>  $request->input('state_name'),
				"CREATED_BY"   =>  $userid,
				"FLAG"         =>  $flag
	    	);

		
		$saveData = DB::table('MASTER_REGION')->insert($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'Region Was Successfully Save...!');
				return redirect('/master/geogaraphycal/view-region-master');

			} else {

				$request->session()->flash('alert-error', 'Region Can Not Be Save...!');
				return redirect('/master/geogaraphycal/view-region-master');

			}


	}

	public function ViewRegionMaster(Request $request){

		$compName = $request->session()->get('company_name');
    	
		if($request->ajax()) {
	       
			$userid   = $request->session()->get('userid');

			$userType = $request->session()->get('usertype');

			$compName = $request->session()->get('company_name');

			$fisYear  =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 	$data = DB::table('MASTER_REGION')->orderBy('ID','ASC');

	    	}elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_REGION')->orderBy('ID','ASC');

	    	}else{

	    		$data='';

	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

	    }

    	$title = 'View Region';

    	if(isset($compName)){

	    	return view('admin.finance.master.geogaraphycal.view_region',compact('title'));

	    }else{

	    	return redirect('/useractivity');

	    }

    }

    public function DeleteRegionMaster(Request $request){

        $id = $request->input('region_id');
        $countryCode = $request->input('region_code');
        
        if ($id!='' && $countryCode!='') {

	       try{

				$Delete = DB::table('MASTER_REGION')->where('ID', $id)->where('REGION_CODE', $countryCode)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Region Data Was Deleted Successfully...!');
					return redirect('/master/geogaraphycal/view-region-master');

				} else {

					$request->session()->flash('alert-error', 'Region Data Can Not Be Deleted...!');
					return redirect('/master/geogaraphycal/view-region-master');

				}

			}catch(Exception $ex){

				$request->session()->flash('alert-error', 'Region Can Not Be Deleted...! Used In Another Transaction...!');
						return redirect('/master/geogaraphycal/view-region-maste');
			}

		}else{

			$request->session()->flash('alert-error', 'Region Data Not Found...!');
			return redirect('/master/geogaraphycal/view-region-maste');

		}

	}


	public function EditRegionMaster(Request $request,$tblId,$regionCode){

    	$title = 'Edit Region';

		$idTbl       = base64_decode($tblId);
		$regionCode = base64_decode($regionCode);
    	
    	$compName = $request->session()->get('company_name');

    	$fisYear  =  $request->session()->get('macc_year');

    	$userData['state_list'] = DB::table('MASTER_STATE')->get();

    	if($idTbl!='' && $regionCode!=''){

    	    $query = DB::table('MASTER_REGION');
			$query->where('ID', $idTbl);
			$query->where('REGION_CODE', $regionCode);
			$userData['region_list'] = $query->get()->first();

			return view('admin.finance.master.geogaraphycal.edit_region', $userData+compact('title'));
		}else{

			$request->session()->flash('alert-error', 'Region Not Found...!');
			return redirect('/master/geogaraphycal/view-region-maste');

		}

    }


    public function RegionMasterUpdate(Request $request){
		
		$validate = $this->validate($request, [
				
			'region_code' => 'required',
			'region_name' => 'required|max:40',
			'state_code' => 'required',


		]);

        $cId = $request->input('regionId');

        $userid   = $request->session()->get('userid');

        date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

		$data = array(
				"REGION_CODE"      =>  $request->input('region_code'),
				"REGION_NAME"      =>  $request->input('region_name'),
				"STATE_CODE"       =>  $request->input('state_code'),
				"STATE_NAME"       =>  $request->input('state_name'),
				"REGION_BLOK"      =>  $request->input('region_block'),
				"LAST_UPDATE_BY"   =>  $userid,
				"LAST_UPDATE_DATE" =>  $updatedDate
	    	);

		//print_r($data);exit;

		$saveData = DB::table('MASTER_REGION')->where('ID', $cId)->where('REGION_CODE', $request->input('region_code'))->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'Region Was Successfully Updated...!');
				return redirect('/master/geogaraphycal/view-region-master');

			} else {

				$request->session()->flash('alert-error', 'Region Can Not Be Updated...!');
				return redirect('/master/geogaraphycal/view-region-master');

			}


	}



	public function StateMaster(Request $request){

		$title = 'State Master';

		$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	$data['country_list'] = DB::table('MASTER_COUNTRY')->get();

		
		if(isset($compName)){

	    	return view('admin.finance.master.geogaraphycal.add_state',$data+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

	}


	public function StateMasterSave(Request $request){


		$validate = $this->validate($request, [
				
			'state_code'   => 'required|unique:MASTER_STATE,STATE_CODE',
			'state_name'   => 'required|max:40',
			'country_code' => 'required|max:40',

		]);

        $flag = 1;

        $userid   = $request->session()->get('userid');

		$data = array(
				"STATE_CODE"   =>  $request->input('state_code'),
				"STATE_NAME"   =>  $request->input('state_name'),
				"COUNTRY_CODE" =>  $request->input('country_code'),
				"COUNTRY_NAME" =>  $request->input('countryName'),
				"CREATED_BY"   =>  $userid,
				"FLAG"         =>  $flag
	    	);

		
		$saveData = DB::table('MASTER_STATE')->insert($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'State Was Successfully Save...!');
				return redirect('/master/geogaraphycal/view-state-master');

			} else {

				$request->session()->flash('alert-error', 'State Can Not Be Save...!');
				return redirect('/master/geogaraphycal/view-state-master');

			}


	}


	public function ViewStateMaster(Request $request){

		$compName = $request->session()->get('company_name');
    	
		if($request->ajax()) {
	       
			$userid   = $request->session()->get('userid');

			$userType = $request->session()->get('usertype');

			$compName = $request->session()->get('company_name');

			$fisYear  =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 	$data = DB::table('MASTER_STATE')->orderBy('ID','ASC');

	    	}elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_STATE')->orderBy('ID','ASC');

	    	}else{

	    		$data='';

	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

	    }

    	$title = 'View State';

    	if(isset($compName)){

	    	return view('admin.finance.master.geogaraphycal.view_state',compact('title'));

	    }else{

	    	return redirect('/useractivity');

	    }

    }

    public function DeleteStateMaster(Request $request){

        $id = $request->input('state_id');
        $stateCode = $request->input('state_code');
        
        if ($id!='' && $stateCode!='') {

	       try{

				$Delete = DB::table('MASTER_STATE')->where('ID', $id)->where('STATE_CODE', $stateCode)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'State Data Was Deleted Successfully...!');
					return redirect('/master/geogaraphycal/view-state-master');

				} else {

					$request->session()->flash('alert-error', 'State Data Can Not Be Deleted...!');
					return redirect('/master/geogaraphycal/view-state-master');

				}

			}catch(Exception $ex){

				$request->session()->flash('alert-error', 'State Can Not Be Deleted...! Used In Another Transaction...!');
						return redirect('/master/geogaraphycal/view-state-maste');
			}

		}else{

			$request->session()->flash('alert-error', 'State Data Not Found...!');
			return redirect('/master/geogaraphycal/view-state-maste');

		}

	}



	public function EditStateMaster(Request $request,$tblId,$stateCode){

    	$title = 'Edit State';

		$idTbl       = base64_decode($tblId);
		$stateCode = base64_decode($stateCode);
    	
    	$compName = $request->session()->get('company_name');

    	$fisYear  =  $request->session()->get('macc_year');

    	if($idTbl!='' && $stateCode!=''){

    	    $query = DB::table('MASTER_STATE');
			$query->where('ID', $idTbl);
			$query->where('STATE_CODE', $stateCode);
			$userData['state_list'] = $query->get()->first();

			$userData['country_list'] = DB::table('MASTER_COUNTRY')->get();

			return view('admin.finance.master.geogaraphycal.edit_state', $userData+compact('title'));
		}else{

			$request->session()->flash('alert-error', 'State Not Found...!');
			return redirect('/master/geogaraphycal/view-state-maste');

		}

    }


    public function StateMasterUpdate(Request $request){
		
		$validate = $this->validate($request, [
				
			'state_code'   => 'required|max:6',
			'state_name'   => 'required|max:40',
			'country_code' => 'required|max:6',

		]);

        $cId = $request->input('stateId');

        date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

        $userid   = $request->session()->get('userid');

		$data = array(
				"STATE_CODE"       =>  $request->input('state_code'),
				"STATE_NAME"       =>  $request->input('state_name'),
				"COUNTRY_CODE"     =>  $request->input('country_code'),
				"COUNTRY_NAME"     =>  $request->input('country_code'),
				"STATE_BLOK"       =>  $request->input('state_block'),
				"LAST_UPDATE_BY"   =>  $userid,
				"LAST_UPDATE_DATE" =>  $updatedDate
	    	);

		//print_r($data);exit;

		$saveData = DB::table('MASTER_STATE')->where('ID', $cId)->where('STATE_CODE', $request->input('state_code'))->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'State Was Successfully Updated...!');
				return redirect('/master/geogaraphycal/view-state-master');

			} else {

				$request->session()->flash('alert-error', 'State Can Not Be Updated...!');
				return redirect('/master/geogaraphycal/view-state-master');

			}


	}


	public function DistrictMaster(Request $request){

		$title = 'District Master';

		$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	$data['state_list'] = DB::table('MASTER_STATE')->get();

		
		if(isset($compName)){

	    	return view('admin.finance.master.geogaraphycal.add_district',$data+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

	}


	public function DistrictMasterSave(Request $request){


		$validate = $this->validate($request, [
				
			'district_code' => 'required|max:6|unique:MASTER_DISTRICT,DISTRICT_CODE',
			'district_name' => 'required|max:40',
			'state_code'    => 'required|max:40',

		]);

        $flag = 1;

        $userid   = $request->session()->get('userid');

		$data = array(
				"DISTRICT_CODE" =>  $request->input('district_code'),
				"DISTRICT_NAME" =>  $request->input('district_name'),
				"STATE_CODE"    =>  $request->input('state_code'),
				"STATE_NAME"    =>  $request->input('state_name'),
				"CREATED_BY"    =>  $userid,
				"FLAG"          =>  $flag
	    	);

		
		$saveData = DB::table('MASTER_DISTRICT')->insert($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'District Was Successfully Save...!');
				return redirect('/master/geogaraphycal/view-district-master');

			} else {

				$request->session()->flash('alert-error', 'District Can Not Be Save...!');
				return redirect('/master/geogaraphycal/view-district-master');

			}


	}

	public function ViewDistrictMaster(Request $request){

		$compName = $request->session()->get('company_name');
    	
		if($request->ajax()) {
	       
			$userid   = $request->session()->get('userid');

			$userType = $request->session()->get('usertype');

			$compName = $request->session()->get('company_name');

			$fisYear  =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 	$data = DB::table('MASTER_DISTRICT')->orderBy('ID','ASC');

	    	}elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_DISTRICT')->orderBy('ID','ASC');

	    	}else{

	    		$data='';

	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

	    }

    	$title = 'View District';

    	if(isset($compName)){

	    	return view('admin.finance.master.geogaraphycal.view_district',compact('title'));

	    }else{

	    	return redirect('/useractivity');

	    }

    }

    public function DeleteDistrictMaster(Request $request){

        $id = $request->input('district_id');
        $districtCode = $request->input('district_code');
        
        if ($id!='' && $districtCode!='') {

	       try{

				$Delete = DB::table('MASTER_DISTRICT')->where('ID', $id)->where('DISTRICT_CODE', $districtCode)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'District Data Was Deleted Successfully...!');
					return redirect('/master/geogaraphycal/view-district-master');

				} else {

					$request->session()->flash('alert-error', 'District Data Can Not Be Deleted...!');
					return redirect('/master/geogaraphycal/view-district-master');

				}

			}catch(Exception $ex){

				$request->session()->flash('alert-error', 'District Can Not Be Deleted...! Used In Another Transaction...!');
						return redirect('/master/geogaraphycal/view-district-maste');
			}

		}else{

			$request->session()->flash('alert-error', 'District Data Not Found...!');
			return redirect('/master/geogaraphycal/view-district-maste');

		}

	}



	public function EditDistrictMaster(Request $request,$tblId,$districtCode){

    	$title = 'Edit District';

		$idTbl       = base64_decode($tblId);
		$districtCode = base64_decode($districtCode);
    	
    	$compName = $request->session()->get('company_name');

    	$fisYear  =  $request->session()->get('macc_year');

    	if($idTbl!='' && $districtCode!=''){

    	    $query = DB::table('MASTER_DISTRICT');
			$query->where('ID', $idTbl);
			$query->where('DISTRICT_CODE', $districtCode);
			$userData['district_list'] = $query->get()->first();

			$userData['state_list'] = DB::table('MASTER_STATE')->get();

			return view('admin.finance.master.geogaraphycal.edit_district', $userData+compact('title'));
		}else{

			$request->session()->flash('alert-error', 'District Not Found...!');
			return redirect('/master/geogaraphycal/view-district-master');

		}

    }

    public function DistrictMasterUpdate(Request $request){
		
		$validate = $this->validate($request, [
				
			'district_code' => 'required|max:6',
			'district_name' => 'required|max:40',
			'state_code'    => 'required|max:6',

		]);

        $cId = $request->input('districtId');

        date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

        $userid   = $request->session()->get('userid');

		$data = array(
				"DISTRICT_CODE"    =>  $request->input('district_code'),
				"DISTRICT_NAME"    =>  $request->input('district_name'),
				"STATE_CODE"       =>  $request->input('state_code'),
				"STATE_NAME"       =>  $request->input('state_name'),
				"DISTRICT_BLOCK"   =>  $request->input('district_block'),
				"LAST_UPDATE_BY"   =>  $userid,
				"LAST_UPDATE_DATE" =>  $updatedDate
	    	);


		$saveData = DB::table('MASTER_DISTRICT')->where('ID', $cId)->where('DISTRICT_CODE', $request->input('district_code'))->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'District Was Successfully Updated...!');
				return redirect('/master/geogaraphycal/view-district-master');

			} else {

				$request->session()->flash('alert-error', 'District Can Not Be Updated...!');
				return redirect('/master/geogaraphycal/view-district-master');

			}


	}


	/*...City...*/

	public function CityMaster(Request $request){

		$title = 'City Master';

		$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	$data['district_list'] = DB::table('MASTER_DISTRICT')->get();

		
		if(isset($compName)){

	    	return view('admin.finance.master.geogaraphycal.add_city',$data+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

	}


	public function CityMasterSave(Request $request){


		$validate = $this->validate($request, [
				
			'city_code'     => 'required|max:6|unique:MASTER_CITY,CITY_CODE',
			'city_name'     => 'required|max:40',
			'pin_code'      => 'required|max:6',
			'district_code' => 'required|max:6',

		]);

        $flag = 1;

        $userid   = $request->session()->get('userid');

		$data = array(
				"CITY_CODE"   =>  $request->input('city_code'),
				"CITY_NAME"   =>  $request->input('city_name'),
				"PIN_CODE"    =>  $request->input('pin_code'),
				"DIST_CODE"   =>  $request->input('district_code'),
				//"DIST_NAME" =>  $request->input('state_code'),
				"CREATED_BY"  =>  $userid,
				"FLAG"        =>  $flag
	    	);

		
		$saveData = DB::table('MASTER_CITY')->insert($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'City Was Successfully Save...!');
				return redirect('/master/geogaraphycal/view-city-master');

			} else {

				$request->session()->flash('alert-error', 'City Can Not Be Save...!');
				return redirect('/master/geogaraphycal/view-city-master');

			}


	}

	public function ViewCityMaster(Request $request){

		$compName = $request->session()->get('company_name');
    	
		if($request->ajax()) {
	       
			$userid   = $request->session()->get('userid');

			$userType = $request->session()->get('usertype');

			$compName = $request->session()->get('company_name');

			$fisYear  =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 	$data = DB::table('MASTER_CITY');

	    	}elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_CITY');

	    	}else{

	    		$data='';

	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

	    }

    	$title = 'View District';

    	if(isset($compName)){

	    	return view('admin.finance.master.geogaraphycal.view_city',compact('title'));

	    }else{

	    	return redirect('/useractivity');

	    }

    }

    public function DeleteCityMaster(Request $request){

        $id = $request->input('district_id');
        $districtCode = $request->input('district_code');
        
        if ($id!='' && $districtCode!='') {

	       try{

				$Delete = DB::table('MASTER_DISTRICT')->where('ID', $id)->where('DISTRICT_CODE', $districtCode)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'District Data Was Deleted Successfully...!');
					return redirect('/master/geogaraphycal/view-district-master');

				} else {

					$request->session()->flash('alert-error', 'District Data Can Not Be Deleted...!');
					return redirect('/master/geogaraphycal/view-district-master');

				}

			}catch(Exception $ex){

				$request->session()->flash('alert-error', 'District Can Not Be Deleted...! Used In Another Transaction...!');
						return redirect('/master/geogaraphycal/view-district-maste');
			}

		}else{

			$request->session()->flash('alert-error', 'District Data Not Found...!');
			return redirect('/master/geogaraphycal/view-district-maste');

		}

	}



	public function EditCityMaster(Request $request,$cityCode){

    	$title = 'Edit District';

		// $idTbl       = base64_decode($tblId);
		$cityCode = base64_decode($cityCode);
    	
    	$compName = $request->session()->get('company_name');

    	$fisYear  =  $request->session()->get('macc_year');

    	if( $cityCode!=''){

    	    $query = DB::table('MASTER_CITY');
			$query->where('CITY_CODE', $cityCode);
			$userData['city_list'] = $query->get()->first();

			$userData['district_list'] = DB::table('MASTER_DISTRICT')->get();

			return view('admin.finance.master.geogaraphycal.edit_city', $userData+compact('title'));
		}else{

			$request->session()->flash('alert-error', 'District Not Found...!');
			return redirect('/master/geogaraphycal/view-district-master');

		}

    }

    public function CityMasterUpdate(Request $request){
		
		$validate = $this->validate($request, [
				
			'pin_code'      => 'required|max:40',
			'district_code' => 'required|max:6',

		]);

        $cId = $request->input('city_code');

        date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

        $userid   = $request->session()->get('userid');

		$data = array(
				"PIN_CODE"         =>  $request->input('pin_code'),
				"DIST_CODE"        =>  $request->input('district_code'),
				"DIST_NAME"        =>  $request->input('district_name'),
				"CITY_BLOCK"       =>  $request->input('city_block'),
				"LAST_UPDATE_BY"   =>  $userid,
				"LAST_UPDATE_DATE" =>  $updatedDate
	    	);


		$saveData = DB::table('MASTER_CITY')->where('CITY_CODE', $cId)->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'District Was Successfully Updated...!');
				return redirect('/master/geogaraphycal/view-city-master');

			} else {

				$request->session()->flash('alert-error', 'District Can Not Be Updated...!');
				return redirect('/master/geogaraphycal/view-city-master');

			}


	}


    /* -------- END : Geogaraphycal Master -------- */

 

    



}


?>
