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

class InfrastructureTranController extends Controller{

	public function __construct(){

	}

/* --------- START : PROJECT BUDGET TRANSACTION -------- */

	public function AddProjectBudgetTran(Request $request){

		$title       ='Add Project Budget Transaction';

		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$userdata['projectList'] = DB::table('MASTER_PROJECT')->get();
		$userdata['glList'] = DB::table('MASTER_GL')->get();

		if(isset($CompanyCode)){

			return view('admin.finance.transaction.infrastructure.add_project_budeget_tran',$userdata+compact('title'));
		}else{

			return redirect('/useractivity');
		}

	}

	public function SaveProjectBudget(Request $request){

		$createdBy         = $request->session()->get('userid');
		$compName          = $request->session()->get('company_name');
		$explodeCode       = explode('-', $compName);
		$compcode          = $explodeCode[0];
		$compname          = $explodeCode[1];
		$fisYear           =  $request->session()->get('macc_year');
		$project_code      = $request->input('project_code');
		$project_name      = $request->input('project_name');
		$wbs_Code          = $request->input('wbsCode');
		$wbs_Name          = $request->input('wbsName');
		$wbs_PlanStartDate = $request->input('wbsPlanStartDate');
		$wbs_PlanEndDate   = $request->input('wbsPlanEndDate');
		$plan_Amt          = $request->input('planAmt');
		$budget_Amt        = $request->input('budgetAmt');
		$gl_Code           = $request->input('glCode');
		$gl_Name           = $request->input('glName');
		$row_Count          = $request->input('rowCount');

		DB::beginTransaction();

		try {

			for($i=0;$i<count($row_Count);$i++){

				$dataAry= array(
					'COMP_CODE'     =>$compcode,
					'COMP_NAME'     =>$compname,
					'PROJECT_CODE'  =>$project_code,
					'PROJECT_NAME'  =>$project_name,
					'WBS_CODE'      =>$wbs_Code[$i],
					'WBS_NAME'      =>$wbs_Name[$i],
					'PLAN_AMOUNT'   =>$plan_Amt[$i],
					'BUDGET_AMOUNT' =>$budget_Amt[$i],
					'GL_CODE'       =>$gl_Code[$i],
					'GL_NAME'       =>$gl_Name[$i],
					'CREATED_BY'    =>$createdBy,
				);

				DB::table('PROJECT_BUDGET_TRAN')->insert($dataAry);

			}

			DB::commit();

		    $data['response'] = 'Success';
			$getalldata = json_encode($data);  
			print_r($getalldata);

		}catch (\Exception $e) {
	        DB::rollBack();
		    //throw $e;
	        $data['response'] = 'Error';
			$getalldata = json_encode($data);  
			print_r($getalldata);
		}

	}

	public function ViewrojectBudgetTran(Request $request){
		
	 	$compName = $request->session()->get('company_name');
	 	$title    = 'View  Project Budget';
		if($request->ajax()){

	 		$userid   = $request->session()->get('userid');
	 		$userType = $request->session()->get('usertype');
	 		$compName = $request->session()->get('company_name');
	 		$fisYear  =  $request->session()->get('macc_year');

	 		if($userType=='admin'){
	 			$data = DB::table('PROJECT_BUDGET_TRAN')->orderBy('PBUDGETID','DESC');
	 		}else if ($userType=='superAdmin' || $userType=='user'){    		
	 			$data = DB::table('PROJECT_BUDGET_TRAN')->orderBy('PBUDGETID','DESC');
	 		}else{
	 			$data ='';
	 		}
 			return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
 		}
	 	if(isset($compName)){
	 		return view('admin.finance.transaction.infrastructure.view_project_budget_tran',compact('title'));
	 	}else{
	 		return redirect('/useractivity');
	 	}		
 	}

	public function SaveInfraDataMsg(Request $request,$saveData,$tranName){

		if ($saveData == 'false') {

			if($tranName == 'PROJECTBUDGET'){
				$request->session()->flash('alert-error', 'Data Can Not Added...!');
				return redirect('/Transaction/Infrastructure/view-project-budget-tranasction');
			}else if( $tranName == 'PROJECTEXPENSE'){
				$request->session()->flash('alert-error', 'Data Can Not Added...!');
				return redirect('/Transaction/Infrastructure/view-project-budget-tranasction');
			}

		} else {

			if($tranName == 'PROJECTBUDGET'){
				$request->session()->flash('alert-success', 'Data  Was Successfully Added...!');
		  		return redirect('/Transaction/Infrastructure/view-project-budget-tranasction');
			}else if( $tranName == 'PROJECTEXPENSE'){
				$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
				return redirect('/Transaction/Infrastructure/view-project-budget-tranasction');
			}
		}

	}

/* --------- END : PROJECT BUDGET TRANSACTION -------- */

/* --------- START : PROJECT EXPENSE TRANSACTION -------- */
	
	public function AddProjectExpenseTran(Request $request){

		$title       ='Add Project Expense Transaction';

		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$userdata['projectList'] = DB::table('MASTER_PROJECT')->get();
		$userdata['projectList'] = DB::table('MASTER_PROJECT')->get();
		$userdata['glList'] = DB::select("SELECT * FROM `GL_TRAN` WHERE DRAMT - WBS_ALLOC_AMT > 0 GROUP BY GL_CODE");

		if(isset($CompanyCode)){

			return view('admin.finance.transaction.infrastructure.add_project_expense_tran',$userdata+compact('title'));
		}else{

			return redirect('/useractivity');
		}

	}

	public function SaveProjectExpense(Request $request){

		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$macc_year   = $request->session()->get('macc_year');
		$glTranTblId = $request->input('glTranTblId');
		$projectCode = $request->input('project_code');
		$projectName = $request->input('project_name');
		$glCode      = $request->input('gl_code');
		$glName      = $request->input('gl_name');
		$pmt_vrno    = $request->input('pmt_vrno');
		$wbs_code    = $request->input('wbs_code');
		$wbs_name    = $request->input('wbs_name');
		$budgetAmt   = $request->input('budgetAmt');
		$expDrAmt    = $request->input('expenseDrAmt');
		$dr_amount   = $request->input('dr_amount');
		$allocateAmt = $request->input('allocateAmt');
		$totlRwCount = $request->input('totlRwCount');

		DB::beginTransaction();

		try {

			for($i=0;$i<count($totlRwCount);$i++){

				$data = array(
					'PROJECT_CODE'   =>$projectCode,
					'PROJECT_NAME'   =>$projectName,
					'GL_CODE'        =>$glCode,
					'GL_NAME'        =>$glName,
					'PMT_VOUCHER_NO' =>$pmt_vrno,
					'WBS_CODE'       =>$wbs_code[$i],
					'WBS_NAME'       =>$wbs_name[$i],
					'BUDGET_AMT'     =>$budgetAmt[$i],
					'EXP_DRAMT'      =>$expDrAmt[$i],
					'DR_AMT'         =>$dr_amount[$i],
				);

				DB::table('PROJECT_EXPENSE_TRAN')->insert($data);

				$dataDr = array(
					'DRAMT' =>$dr_amount[$i]
				);

				DB::table('PROJECT_BUDGET_TRAN')->where('PROJECT_CODE',$projectCode)->where('WBS_CODE',$wbs_code[$i])->update($dataDr);

			}

			$alocAmtData = array(
				'WBS_ALLOC_AMT' => $allocateAmt
			);

			DB::table('GL_TRAN')->where('GLTRANID',$glTranTblId)->update($alocAmtData);

			DB::commit();

		    $data['response'] = 'Success';
			$getalldata = json_encode($data);  
			print_r($getalldata);

		}catch (\Exception $e) {
	        DB::rollBack();
		    //throw $e;
	        $data['response'] = 'Error';
			$getalldata = json_encode($data);  
			print_r($getalldata);
		}

	}

	public function viewProjectExpense(Request $request){

	    $compName = $request->session()->get('company_name');
	 	$title    = 'View Project Expense';

 	    if($request->ajax()){

	 		$userid   = $request->session()->get('userid');
	 		$userType = $request->session()->get('usertype');
	 		$compName = $request->session()->get('company_name');
	 		$fisYear  =  $request->session()->get('macc_year');

	 		if($userType=='admin'){

	 			$data = DB::table('PROJECT_EXPENSE_TRAN')->orderBy('PEXPID','DESC');

	 		}else if ($userType=='superAdmin' || $userType=='user'){ 

	 			$data = DB::table('PROJECT_EXPENSE_TRAN')->orderBy('PEXPID','DESC');

	 		}else{
	 			$data ='';
	 		}
	      	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
 	    }

 	    if(isset($compName)){

		   return view('admin.finance.transaction.infrastructure.view_project_expense_tran');
        }else{
 		   return redirect('/useractivity');
 	    }	
	
    }


/* --------- END : PROJECT EXPENSE TRANSACTION -------- */


/* ------------- START : AJAX FUNCTION ----------- */
	
	public function GetAllProjectWbsForProject(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$projectCode = $request->input('projectCode');
	   
	    	$wbsList = DB::select("SELECT * FROM PROJECT_WBS WHERE PROJECT_CODE='$projectCode'");

    		if ($wbsList!='') {

				$response_array['response'] = 'success';
				$response_array['data_wbs'] = $wbsList;
	            $data = json_encode($response_array);
	            print_r($data);

			}else{

				$response_array['response'] = 'error';
				$response_array['data_wbs'] = '';
                $data = json_encode($response_array);
                print_r($data);
			}

	    }else{

			$response_array['response'] = 'error';
			$response_array['data_wbs'] = '';
            $data = json_encode($response_array);
            print_r($data);
	    }

 	}


 	public function GetvrnoAlocAmtForExpenseGl(Request $request){

 		$response_array = array();

		if ($request->ajax()) {

			$field_Type  = $request->input('fieldType');
			$gl_Code     = $request->input('gl_code');
			$pmt_vrno    = $request->input('pmt_vrno');
			$pmtFyYear   = $request->input('pmtFyYear');
			$glTranTblId = $request->input('glTranTblId');
			$pmtVoucherNoList = '';
	   		$alocAmtData ='';
	   		if($gl_Code && $field_Type == 'GLCODE'){
	   			$pmtVoucherNoList = DB::select("SELECT * FROM GL_TRAN WHERE GL_CODE='$gl_Code'");
	   			$alocAmtData ='';
	   		}else if($gl_Code && $pmt_vrno && $field_Type == 'PMTVRNO'){

				$splivrno      = explode('/',$pmt_vrno);
				$pmtSeriesCode = $splivrno[1];
				$pmtVrno       = $splivrno[2];

				$alocAmtData = DB::select("SELECT * FROM GL_TRAN WHERE GL_CODE='$gl_Code' AND FY_CODE='$pmtFyYear' AND SERIES_CODE='$pmtSeriesCode' AND VRNO='$pmtVrno' AND GLTRANID='$glTranTblId'");

	   		}else{
	   			$pmtVoucherNoList = '';
	   			$alocAmtData = '';
	   		}

	    	

    		if ($pmtVoucherNoList!='' || $alocAmtData!='') {

				$response_array['response']       = 'success';
				$response_array['data_voucherNo'] = $pmtVoucherNoList;
				$response_array['data_alocAmt']   = $alocAmtData;
	            $data = json_encode($response_array);
	            print_r($data);

			}else{

				$response_array['response']       = 'error';
				$response_array['data_voucherNo'] = '';
				$response_array['data_alocAmt']   = '';
                $data = json_encode($response_array);
                print_r($data);
			}

	    }else{

			$response_array['response']       = 'error';
			$response_array['data_voucherNo'] = '';
			$response_array['data_alocAmt']   = '';
            $data = json_encode($response_array);
            print_r($data);
	    }

 	}

 	public function GetBudgetAmtOfProjectWBS(Request $request){

 		$response_array = array();

		if ($request->ajax()) {

			$wbs_Code     = $request->input('wbs_Code');
			$project_code = $request->input('project_code');
			//DB::enableQueryLog();
			$budgetAmtData = DB::select("SELECT * FROM PROJECT_BUDGET_TRAN WHERE WBS_CODE='$wbs_Code' AND PROJECT_CODE='$project_code' ");
			//dd(DB::getQueryLog());
    		if ($budgetAmtData!='') {

				$response_array['response']   = 'success';
				$response_array['amountData'] = $budgetAmtData;
	            $data = json_encode($response_array);
	            print_r($data);

			}else{

				$response_array['response']   = 'error';
				$response_array['amountData'] = '';
                $data = json_encode($response_array);
                print_r($data);
			}

	    }else{

			$response_array['response']     = 'error';
			$response_array['amountData']   = '';
            $data = json_encode($response_array);
            print_r($data);
	    }

 	}

/* ------------- END : AJAX FUNCTION ------------ */

/* ----------- START : REPORT ------------------- */
	
	public function projectBudgetReport(Request $request){

		if ($request->ajax()) {

		   $data = DB::table('PROJECT_BUDGET_TRAN')->get();
			
		   return DataTables::of($data)->addIndexColumn()->toJson();

		}


		return view('admin.finance.report.infrastructure.project_budget_report');
	}

/* ----------- END : REPORT ------------------- */


}


?>