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

class LoanNhundiController extends Controller{

	public function __construct(){
	
	}

	public function AllTableName(Request $request,$tranCode){

		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$getTBLData['fy_list']     = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();
		$getTBLData['acc_list']    = DB::table('MASTER_ACC')->where('ATYPE_CODE','L')->get();
		$getTBLData['gl_list']     = DB::table('MASTER_GL')->get();
		$getTBLData['series_list'] = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>$tranCode,'COMP_CODE'=>$getcompcode])->get();
		$getTBLData['saleRe_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','SR')->get();
		$getTBLData['CP_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->get();
		return $getTBLData;
	}

	public function AddLoanHundi(Request $request){

		$title      ='Add Loan & Hundi';
		$tranCode = 'F1';

		$allTblName = $this->AllTableName($request,$tranCode);

		$userdata['accList']    = $allTblName['acc_list'];
		$userdata['glList']     = $allTblName['gl_list'];
		$userdata['seriesList'] = $allTblName['series_list'];
		$userdata['SRList']     = $allTblName['saleRe_list'];
		$userdata['CPList']     = $allTblName['CP_list'];
		$fyList                 = $allTblName['fy_list'];
		
		foreach ($fyList as $key) {
          $userdata['fromDate'] =  $key->FY_FROM_DATE;
          $userdata['toDate']   =  $key->FY_TO_DATE;
      	}

    	return view('admin.finance.transaction.loanAndHundi.add_loan_entry',$userdata+compact('title','tranCode'));

	}

	public function SaveLoanHundi(Request $request){

		$createdBy      = $request->session()->get('userid');
		$compName       = $request->session()->get('company_name');
		$compcode       = explode('-', $compName);
		$getcompcode    = $compcode[0];
		$getcompname    = $compcode[1];
		$fisYear        = $request->session()->get('macc_year');
		$pdfYesNoStatus = $request->session()->get('pdfYesNoStatus');
		$vr_no          = $request->input('vr_no');
		$interestIncome = $request->input('int_inc_code');
		$splitInterest  = explode('(',$interestIncome);
		$int_inc_code   = $splitInterest[0];
		$unsecuredLoan  = $request->input('unsecured_loan_code');
		$splitLoan      = explode('(',$unsecuredLoan);
		$loan_code      = $splitLoan[0];
		$account_gl     = $request->input('acc_Gl');
		$series_code    = $request->input('series_code');
		$createJvORBank = $request->input('adv_int_jv');
		$isBrokeargeChk = $request->input('isBrokeargeChk');
		$donwloadStatus = $request->input('donwloadStatus');
		$maturityDate   = date("Y-m-d",strtotime($request->input('maturity_date')));
		$transDate      = date("Y-m-d", strtotime($request->input('transaction_date')));
		$splitSeries    = explode('(',$series_code);
		$seriesCD       = $splitSeries[0];
		$seriesNM       = $splitSeries[1];

		if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('LOAN_TRAN')->where('SERIES_CODE',$seriesCD)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrNum +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::table('INDICATOR_TEMP')->where('TCFLAG','LNHT')->where('CREATED_BY',$createdBy)->delete();

		DB::beginTransaction();

		$headTable = 'LOAN_TRAN';
		$pdfName   = 'IRR CALC';
		$vrPName   = 'LOAN NO';

		try {

			$data = array(

				'COMP_CODE'      => $getcompcode,
				'COMP_NAME'      => $getcompname,
				'FY_CODE'        => $fisYear,
				'VRDATE'         => $transDate,
				'TRAN_CODE'      => $request->input('tran_code'),
				'SERIES_CODE'    => $seriesCD,
				'SERIES_NAME'    => $seriesNM,
				'VRNO'           => $NewVrno,
				'ACC_CODE'       => $request->input('acc_code'),
				'ACC_NAME'       => $request->input('acc_name'),
				'LOAN_AMT'       => $request->input('loan_amt'),
				'TENURE'         => $request->input('tenure'),
				'MATURITY_DATE'  => $maturityDate,
				'INT_RATE'       => $request->input('interest_rate'),
				'INT_IND'        => $request->input('interest_Ind'),
				'INT_AMT'        => $request->input('interestAmt'),
				'ADV_INT_MONTH'  => $request->input('adv_int_month'),
				'ADV_INT_AMT'    => $request->input('adv_int_amt'),
				'SR_CODE'        => $request->input('sr_code'),
				'SR_NAME'        => $request->input('sr_name'),
				'CP_CODE'        => $request->input('cp_code'),
				'CP_NAME'        => $request->input('cp_name'),
				'BROKERAGE_RATE' => $request->input('brokerage_rate'),
				'BROKERAGE_AMT'  => $request->input('brokerage_amt'),
				'ADV_INT_JV'     => $request->input('adv_int_jv'),
				'NPV_RATE'       => $request->input('NPV_rate'),
				'EMI_AMT'        => $request->input('EMIAmount'),
				'SERVICE_RATE'   => $request->input('service_charges'),
				'SERVICE_AMT'    => $request->input('serviceAmount'),
				'REBATE_RATE'    => $request->input('rebaterate'),
				'REBATE_AMT'     => $request->input('rebateamt'),
				'CREATED_BY'     => $createdBy,
			);

			DB::table('LOAN_TRAN')->insert($data);
			$headid= DB::getPdo()->lastInsertId();

			/* ---- START : POSTING ENTRY ----- */

				if($createJvORBank == 'ADV_INT_JV'){

					for($i=1;$i<5;$i++){
						if($i == 1){
							$glCd     = $account_gl;
							$drAmt    = $request->input('loan_amt');
							$crAmt    = 0.00;
							$glAccChk = 'ACC';
							$refCode  = $request->input('acc_code');
							$refName  = $request->input('acc_name');
						}else if($i == 2){
							$glCd     = $account_gl;
							$drAmt    = $request->input('interestAmt');
							$crAmt    = 0.00;
							$glAccChk = 'ACC';
							$refCode  = $request->input('acc_code');
							$refName  = $request->input('acc_name');
						}else if($i == 3){
							$glCd     = $int_inc_code;
							$crAmt    = $request->input('interestAmt');
							$drAmt    = 0.00;
							$glAccChk = '';
							$refCode  = '';
							$refName  = '';
						}else if($i == 4){
							$glCd     = $loan_code;
							$crAmt    = $request->input('loan_amt');
							$drAmt    = 0.00;
							$glAccChk = '';
							$refCode  = '';
							$refName  = '';
						}

						$data1 = array(
							'IND_GL_CODE' => $glCd,
							'REF_ACCCODE' => $refCode,
							'REF_ACCNAME' => $refName,
							'DR_AMT'      => $drAmt,
							'CR_AMT'      => $crAmt,
							'GLACC_Chk'   => $glAccChk,
							'TCFLAG'      => 'LNHT',
							'CREATED_BY'  => $createdBy,
						);

						DB::table('INDICATOR_TEMP')->insert($data1);
					}/*/. FOR LOOP*/

					$PostingData = DB::select("SELECT t1.*,t2.GL_NAME FROM INDICATOR_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE=t1.IND_GL_CODE WHERE t1.CREATED_BY='$createdBy' AND t1.TCFLAG='LNHT'");

					$slno=1;
					foreach ($PostingData as $rows) {

		                $perticulerText='';
		                $blankVal='';

		                $jvOne = (new AccountingController)->InsertInJournalTran($getcompcode,$fisYear,$blankVal,$blankVal,$request->input('tran_code'),$seriesCD,$seriesNM,$NewVrno,$slno,$transDate,'','',$rows->IND_GL_CODE,$rows->GL_NAME,$perticulerText,$rows->DR_AMT,$rows->CR_AMT,$blankVal,$blankVal,$blankVal,$blankVal,$createdBy);

		                $resultgl = (new AccountingController)->GlTEntry($getcompcode,$fisYear,$request->input('tran_code'),$seriesCD,$NewVrno,$slno,$transDate,$blankVal,$rows->IND_GL_CODE,$rows->GL_NAME,$rows->REF_ACCCODE,$rows->REF_ACCNAME,$blankVal,$blankVal,$blankVal,$blankVal,$rows->DR_AMT,$rows->CR_AMT,$perticulerText,$createdBy);

	                   	if($rows->GLACC_Chk == 'ACC'){

	                       	$result = (new AccountingController)->AccountTEntry($getcompcode,$fisYear,$request->input('tran_code'),$seriesCD,$NewVrno,$slno,$transDate,$blankVal,$request->input('acc_code'),$request->input('acc_name'),$rows->IND_GL_CODE,$rows->GL_NAME,$blankVal,$blankVal,$blankVal,$blankVal,$rows->DR_AMT,$rows->CR_AMT,$perticulerText,$createdBy);
	                    }

		                $slno++;
		            }

				} /* IF CODN*/

				/* ----- START : BROKERAGE JV IF BROKERAGE DONE ----- */


				/*if($isBrokeargeChk == 'YES'){

				}*/

				/* ----- END : BROKERAGE JV IF BROKERAGE DONE----- */
			/* ---- END : POSTING ENTRY ----- */

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('tran_code'))->where('SERIES_CODE',$seriesCD)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->toArray();
		
			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$getcompcode,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$request->input('tran_code'),
					'SERIES_CODE' =>$seriesCD,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);

			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$request->input('tran_code'))->where('SERIES_CODE',$seriesCD)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();

			if($donwloadStatus ==1 ){
				return $this->GeneratePdfForLoanHundi($getcompcode,$fisYear,$request->input('tran_code'),$seriesCD,$headTable,$headid,$createdBy,$pdfName,$vrPName);
			}

			$response_array['response'] = 'success';
		    $data = json_encode($response_array);
		    print_r($data);

		} catch (\Exception $e) {
		    DB::rollBack();
		   // throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}
		
	}

	public function loanHundiSaveMsg(Request $request,$saveData){

		if ($saveData == 'false'){

				$request->session()->flash('alert-error', 'Data Can Not Be Save...!');
				return redirect('/Transaction/LoanAndHundi/view-loan-hundi-Tran');

		} else {

				$request->session()->flash('alert-success', 'Data Was Successfully Save...!');
				return redirect('/Transaction/LoanAndHundi/view-loan-hundi-Tran');

		}
	}

	public function ViewLoanNHundi(Request $request){

		$compName  = $request->session()->get('company_name');
		$splitData = explode('-',$compName);
		$comp_code = $splitData[0];

		if($request->ajax()) {

	    	$title = 'View Loan/Hundi';

			$userid   = $request->session()->get('userid');
			$fisYear  =  $request->session()->get('macc_year');

	    	$data = DB::table('LOAN_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('VRDATE','ASC');

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.transaction.loanAndHundi.view_loan_entry');
    	}else{
		 	return redirect('/useractivity');
	   }
    }

    public function CreateInterestSch(Request $request){

    	$title = "Create Interst Schedule";
    	$tranCode='';
    	$allTblName = $this->AllTableName($request,$tranCode);
		$userdata['accList']    = $allTblName['acc_list'];

    	$userdata['loan_list'] = DB::table('LOAN_TRAN')->where('ADV_INT_JV','ADV_INT_JV')->get();

    	return view('admin.finance.transaction.loanAndHundi.create_int_schedule',$userdata+compact('title'));

    }

	public function SimulationForLoanHundi(Request $request){

		$int_inc_glcode = $request->int_inc_glcode;
		$loan_glcode    = $request->loanGlCode;
		$acc_glcode     = $request->accGl;
		$loan_amt       = $request->loanAmt;
		$interest_amt   = $request->intAmt;
		$createJvORBank = $request->createJvORBank;
		$userId         = $request->session()->get('userid');

		DB::table('SIMULATION_TEMP')->where('TCFLAG','LNHT')->where('CREATED_BY',$userId)->delete();

		if($createJvORBank == 'ADV_INT_JV'){

			for($i=1;$i<5;$i++){
				if($i == 1){
					$glCd = $acc_glcode;
					$drAmt = $loan_amt;
					$crAmt = 0.00;
				}else if($i == 2){
					$glCd = $acc_glcode;
					$drAmt = $interest_amt;
					$crAmt = 0.00;
				}else if($i == 3){
					$glCd = $int_inc_glcode;
					$crAmt = $interest_amt;
					$drAmt = 0.00;
				}else if($i == 4){
					$glCd = $loan_glcode;
					$crAmt = $loan_amt;
					$drAmt = 0.00;
				}

				$data1 = array(
					'IND_GL_CODE' => $glCd,
					'DR_AMT'      => $drAmt,
					'CR_AMT'      => $crAmt,
					'TCFLAG'      => 'LNHT',
					'CREATED_BY'  => $userId,
				);

				DB::table('SIMULATION_TEMP')->insert($data1);
			}

		}else{

			/*for($j=1;$j<4;$j++){

				if($j==1){
					$glCd = $loan_glcode;
					$crAmt=0.00;
					$drAmt=$loan_amt;
				}else if($j==2){
					$glCd = $acc_glcode;
					$crAmt=0.00;
				}

			}*/

		}/* IF CONDITION*/

		

		$response_array = array();
    	$taxData = DB::select("SELECT t1.*,t2.GL_NAME as glName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE WHERE t1.TCFLAG='LNHT' AND t1.CREATED_BY='$userId'");

    	if ($taxData) {

	      $response_array['response'] = 'success';
	      $response_array['data_sim'] = $taxData;
	      echo $data = json_encode($response_array);

	    }else{

	      $response_array['response'] = 'error';
	      $response_array['data_sim'] = '' ;
	      $data = json_encode($response_array);
	      print_r($data);
	          
	    }
	
	}

	public function DonwloandfOnViewPageLoanHundi(Request $request){

		$userid    = $request->session()->get('userid');
		$head_ID   = $request->headID;
		$comp_cd   = $request->compCd;
		$fy_cd     = $request->fyCd;
		$tran_cd   = $request->tranCd;
		$series_cd = $request->seriesCd;
		$vrno      = $request->vrno;
		$pdfName   = 'IRR CALC';
		$vrPName   = 'LOAN NO';
		$headTbl   = 'LOAN_TRAN';

		$this->GeneratePdfForLoanHundi($comp_cd,$fy_cd,$tran_cd,$series_cd,$headTbl,$head_ID,$userid,$pdfName,$vrPName);

	}

	public function GeneratePdfForLoanHundi($compCd,$fyCd,$tranCd,$seriesCd,$headTbl,$headID,$loginUser,$pdfName,$vrPName){

		$response_array = array();
		//DB::enableQueryLog();
		$dataheadB = DB::SELECT("SELECT * FROM $headTbl WHERE LOANTRANID='$headID' AND TRAN_CODE='$tranCd'");
		//dd(DB::getQueryLog());
		$compDetail = DB::SELECT("SELECT * FROM MASTER_COMP WHERE COMP_CODE = '$compCd'");

		header('Content-Type: application/pdf');

		$pdf = PDF::loadView('admin.finance.transaction.loanAndHundi.irr_calculationpdf',compact('dataheadB','pdfName','compDetail','vrPName'));

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

/* ---------- START AJAX FUNCTION --------- */
	
	public function getLoanNoAgainstAcc(Request $request){

	   	if ($request->ajax()) {

			$accCode     = $request->accCode;
			
			$CompanyCode = $request->session()->get('company_name');
			$compcode    = explode('-', $CompanyCode);
			$getcompcode = $compcode[0];
			$macc_year   = $request->session()->get('macc_year');

            $loanDetail = DB::table('LOAN_TRAN')->where('ACC_CODE',$accCode)->groupBy('ACC_CODE')->get()->toArray();

            if ($loanDetail) {

				$response_array['response'] = 'success';
				$response_array['get_data'] = $loanDetail;
            	$data = json_encode($response_array);
            	print_r($data);

        	}else{

				$response_array['response']  = 'error';
				$response_array['get_data']  = '';
				$data = json_encode($response_array);
				print_r($data);
            
        	}

		}else{

			$response_array['response'] = 'error';
			$response_array['get_data'] = '';
			$data = json_encode($response_array);
			print_r($data);

		}

   }

/* ---------- END AJAX FUNCTION --------- */

}

?>