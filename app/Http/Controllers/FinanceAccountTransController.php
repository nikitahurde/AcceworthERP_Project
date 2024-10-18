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

class FinanceAccountTransController extends Controller{

	public function __construct(){

	}


/* ------------ START : CASH BANK TRANSACTION ------------ */

	public function CheckCashBankTransaction(Request $request){

		$title         ='Add Cash Bank Transaction';

		$CompanyCode   = $request->session()->get('company_name');
		$compcode      = explode('-', $CompanyCode);
		$getcompcode   =	$compcode[0];
		$macc_year     = $request->session()->get('macc_year');
		$transCode     = 'A0';

		$ConstructData = MyConstruct();

		//$userdata['pfct_list']     = $ConstructData['master_pfct'];
		//$userdata['gl_list']       = $ConstructData['master_gl'];
		$userdata['acc_list']      = $ConstructData['master_party'];
		$userdata['bank_list']     = $ConstructData['master_bank'];
		$userdata['cost_list']     = $ConstructData['master_cost'];
		$userdata['sale_rep_list'] = $ConstructData['sale_rep_code'];
		
		$getCommonData = MyCommonFun($transCode,$getcompcode,$macc_year);

		$getseries   = $getCommonData['getseries'];
		$userdata['pfct_list'] = $getCommonData['masterPFCT'];
		$userdata['remark_list'] = $getCommonData['remark_data'];
		$userdata['gl_list'] = $getCommonData['master_GL'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$tranListCd = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$transCode)->get();
		$userdata['trans_head'] =$tranListCd[0]->TRAN_CODE;

		if(isset($CompanyCode)){

			return view('admin.finance.transaction.account.checknewCashBank',$userdata+compact('getseries','title'));
		}else{

			return redirect('/useractivity');
		}

	}

	public function NewCashBankTransaction(Request $request){

		$title         ='Add Cash Bank Transaction';

		$CompanyCode   = $request->session()->get('company_name');
		$compcode      = explode('-', $CompanyCode);
		$getcompcode   =	$compcode[0];
		$macc_year     = $request->session()->get('macc_year');
		$transCode     = 'A0';

		$ConstructData = MyConstruct();

		//$userdata['pfct_list']     = $ConstructData['master_pfct'];
		//$userdata['gl_list']       = $ConstructData['master_gl'];
		$userdata['acc_list']      = $ConstructData['master_party'];
		$userdata['bank_list']     = $ConstructData['master_bank'];
		$userdata['cost_list']     = $ConstructData['master_cost'];
		$userdata['sale_rep_list'] = $ConstructData['sale_rep_code'];
		
		$getCommonData = MyCommonFun($transCode,$getcompcode,$macc_year);

		$getseries   = $getCommonData['getseries'];
		$userdata['remark_list'] = $getCommonData['remark_data'];
		$userdata['pfct_list'] = $getCommonData['masterPFCT'];
		$userdata['gl_list'] = $getCommonData['master_GL'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$tranListCd = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$transCode)->get();
		$userdata['trans_head'] =$tranListCd[0]->TRAN_CODE;

		if(isset($CompanyCode)){

			return view('admin.finance.transaction.account.newCashBank',$userdata+compact('getseries','title'));
		}else{

			return redirect('/useractivity');
		}

	}

	public function NewCashBankSaveCreate(Request $request){

		$createdBy        = $request->session()->get('userid');
		$compName         = $request->session()->get('company_name');
		$explodeCode      = explode('-', $compName);
		$compcode         = $explodeCode[0];
		$fisYear          =  $request->session()->get('macc_year');
		$vrDate           = $request->input('vrDate');
		$vr_date          = date("Y-m-d", strtotime($vrDate));
		$tranCode         = $request->input('tran_code');
		$seriesCode       = $request->input('seriescode');
		$seriesName       = $request->input('seriesname');
		$vrNo             = $request->input('vr_no');
		$postingCode      = $request->input('glCode');
		$postingName      = $request->input('glName');
		$vrType           = $request->input('vrTypeData');
		$pfctCode         = $request->input('pfctCode');
		$pfctName         = $request->input('profitName');
		$saleRepCode      = $request->input('sale_rep_code');
		$glCode           = $request->input('glCodeName');
		$glName           = $request->input('genrl_name');
		$costCenterCode   = $request->input('costCenterCd');
		$costCenterName   = $request->input('costCenter_name');
		$accCode          = $request->input('acc_code');
		$accName          = $request->input('acc_name');
		$tdsCodeByAcc     = $request->input('tdsCodeByAc');
		$tdsRates         = $request->input('accTds_Rate');
		$tdsGlCode        = $request->input('gltdscode');
		$tdsGlName        = $request->input('gltdsname');
		$instType         = $request->input('instrument_type');
		$instTypeName     = $request->input('intTypeName');
		$chequeNo         = $request->input('instrument_no');
		$cheque_Date      = $request->input('chquedate');
		$remark           = $request->input('ref_text');
		$perticular       = $request->input('particular');
		$drAmount         = $request->input('dr_amount');
		$crAmount         = $request->input('cr_amount');
		$tdsDebitAmt      = $request->input('TdsDebitAmount');
		$tdsCreditAmt     = $request->input('TdsCreditAmount');
		$debitTdsCut      = $request->input('DebitdsAmt');
		$CreditTdsCut     = $request->input('CredittdsAmt');
		$pdfYesNoStatus   = $request->input('pdfYesNoStatus');
		$payAdviceRChk    = $request->input('payAdviceRChk');
		$paymentAdvDone   = $request->input('paymentAdvDone');
		$refTextPA        = $request->input('refTextPA');
		$chChequeBookOpen = $request->input('checkChequeBookOpen');
		$chequeTblcolData = $request->input('chequeTblData');
		$accTranId        = $request->input('accTranId');
		$alocateAmt       = $request->input('alocateAmt');
		$CASHPDFDL        = $request->input('CASHPDFDL');
		$narration        = '';
		$blank_val      = '';

		$rowCount = count($glCode);

		if($vrNo == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrNo;
		}

		$vrno_Exist = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$compcode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$tranCode)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrno_Exist[0]->LAST_NO +1;
		}else{
			$NewVrno = $vrNum;
		}
		
		DB::beginTransaction();

		try {

			for($i=0;$i<$rowCount;$i++){
				$slno = $i+1;
				$perticularText =$perticular[$i].', '.$remark[$i];

				if($cheque_Date[$i]){
					$chequeDate     = date("Y-m-d", strtotime($cheque_Date[$i]));
				}else{
					$chequeDate     = null;
				}

				if($drAmount[$i]){
					$drAmt     = $drAmount[$i];
				}else{
					$drAmt = 0.00;
				}

				if($crAmount[$i]){
					$crAmt     = $crAmount[$i];
				}else{
					$crAmt = 0.00;
				}

				if($drAmt != 0.00){
					$amount = $drAmt;
				}else{
					$amount = $crAmt;
				}

				if($tdsDebitAmt[$i]){
					$tdsDrAmt = $tdsDebitAmt[$i];
				}else{
					$tdsDrAmt = 0.00;
				}

				if($tdsCreditAmt[$i]){
					$tdscrAmt = $tdsCreditAmt[$i];
				}else{
					$tdscrAmt = 0.00;
				}

				if($debitTdsCut[$i]){
					$tdscut_drAmt = $debitTdsCut[$i];
				}else{
					$tdscut_drAmt = 0.00;
				}

				if($CreditTdsCut[$i]){
					$tdscut_CrAmt = $CreditTdsCut[$i];
				}else{
					$tdscut_CrAmt = 0.00;
				}

				if($tdscut_drAmt){
					$cutDr = $tdscut_drAmt;
					$cutCr = $tdscut_CrAmt;
				}else if($tdscut_CrAmt){
					$cutCr = $tdscut_CrAmt;
					$cutDr = $tdscut_drAmt;
				}

				if($tdsDrAmt){
					$tds_DrAmt = $tdsDrAmt;
					$tds_crAmt = $tdscrAmt;
				}else if($tdscrAmt){
					$tds_crAmt = $tdscrAmt;
					$tds_DrAmt = $tdsDrAmt;
				}

				if($paymentAdvDone == 1){
					$ifPayAdvAply = 1;
				}else{
					$ifPayAdvAply = 0;
				}

				/* ------ START : PAYMENT ADVICE IS APPLY ------- */

				if($paymentAdvDone == 1){

					for($z=0;$z<count($payAdviceRChk);$z++){

						$splitData = explode('~',$payAdviceRChk[$z]);
						
						$dataPayAdv = array(
							'PMT_COMP_CODE' =>$compcode,
							'PMT_FY_CODE'   =>$fisYear,
							'PMT_TRAN_CODE' =>$tranCode,
							'PMT_SERIES'    =>$seriesCode,
							'PMT_VRNO'      =>$NewVrno,
							'PMT_SLNO'      =>$slno
						);

						DB::table('PAYMENT_ADVICE_TRAN')->where('PAYID',$splitData[0])->where('COMP_CODE',$splitData[1])->where('FY_CODE',$splitData[2])->where('SERIES_CODE',$splitData[3])->where('VRNO',$splitData[4])->where('SLNO',$splitData[5])->update($dataPayAdv);
					}
					
				}

				/* ------ END : PAYMENT ADVICE IS APPLY ------- */


				if($tdsDebitAmt[$i]!=0 || $tdsCreditAmt[$i]!=0){

					/* ----- START : Insert When TDS Is Apply ------ */


					$this->InsertInCashBankNew($NewVrno,$slno,$compcode,$fisYear,$pfctCode,$pfctName,$tranCode,$seriesCode,$seriesName,$postingCode,$postingName,$vrType,$saleRepCode,$costCenterCode[$i],$costCenterName[$i],$vr_date,$glCode[$i],$glName[$i],$accCode[$i],$accName[$i],$perticularText,$drAmt,$crAmt,$instType[$i],$instTypeName[$i],$chequeNo[$i],$chequeDate,$tdsCodeByAcc[$i],$tdsRates[$i],$tdscut_drAmt,$tdscut_CrAmt,$tdsDrAmt,$tdscrAmt,$ifPayAdvAply,$chequeTblcolData[$i],$createdBy);

					$tds_trans_row = 3;
					$GLPARTICULAR = '';
					for ($t=1; $t <$tds_trans_row ; $t++) { 

						$tdstranH = DB::select("SELECT MAX(TDSTRANID) as TDSTRANID FROM TDS_TRAN");
								$tds_headID = json_decode(json_encode($tdstranH), true); 
							
						if(empty($tds_headID[0]['TDSTRANID'])){
							$tds_head_Id = 1;
						}else{
							$tds_head_Id = $tds_headID[0]['TDSTRANID']+1;
						}

						if($t == 1){

							$perticularTx = 'To -'.$tdsGlCode[$i].' - '.$tdsGlName[$i];
							$GLPARTICULAR = 'To -'.$tdsGlCode[$i].' - '.$tdsGlName[$i];
							$this->InsertInTdsTranNew($tds_head_Id,$compcode,$fisYear,$pfctCode,$pfctName,$tranCode,$seriesCode,$NewVrno,$t,$vrType,$vr_date,$glCode[$i],$glName[$i],$accCode[$i],$accName[$i],$perticularTx,$tdscut_drAmt,$tdscut_CrAmt,$instType[$i],$instTypeName[$i],$chequeNo[$i],$chequeDate,$costCenterCode[$i],$tdsCodeByAcc[$i],$tdsRates[$i],$drAmt,$crAmt,$createdBy);

						}/*else if($t == 2){
							$perticularTx = 'To -'.$accCode[$i].' - '.$accName[$i];
							$this->InsertInTdsTranNew($tds_head_Id,$compcode,$fisYear,$pfctCode,$pfctName,$tranCode,$seriesCode,$NewVrno,$t,$vrType,$vr_date,$tdsGlCode[$i],$tdsGlName[$i],$accCode[$i],$accName[$i],$perticularTx,$tdscut_CrAmt,$tdscut_drAmt,$instType[$i],$instTypeName[$i],$chequeNo[$i],$chequeDate,$costCenterCode[$i],$tdsCodeByAcc[$i],$tdsRates[$i],$drAmt,$crAmt,$createdBy);

						}*/

					}

					$acccgetounts =5;
					for($d=1; $d < $acccgetounts ; $d++){

						if($d == 1){

							$this->AccountTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,1,$vr_date,$pfctCode,$accCode[$i],$accName[$i],$glCode[$i],$glName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$tds_DrAmt,$tds_crAmt,$perticularText,$narration,$createdBy);


							$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,1,$vr_date,$pfctCode,$glCode[$i],$glName[$i],'','',$accCode[$i],$accName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$tds_DrAmt,$tds_crAmt,$perticularText,$blank_val,$createdBy);

						}else if($d == 2){

							$this->AccountTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$d,$vr_date,$pfctCode,$accCode[$i],$accName[$i],$glCode[$i],$glName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$cutDr,$cutCr,$GLPARTICULAR,$narration,$createdBy);

							//$GLPARTICULAR = 'To '.$tdsGlCode[3].' - '.$tdsGlName[3];

							$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$d,$vr_date,$pfctCode,$glCode[$i],$glName[$i],'','',$accCode[$i],$accName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$cutDr,$cutCr,$GLPARTICULAR,$blank_val,$createdBy);

						}else if($d == 3){
							$GLPARTICULAR ='By - '.$accCode[$i].' - '.$accName[$i];
							//$GLPARTICULAR = 'To '.$accCode[$i].' - '.$accName[$i];
							$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$d,$vr_date,$pfctCode,$tdsGlCode[$i],$tdsGlName[$i],'','',$accCode[$i],$accName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$cutCr,$cutDr,$GLPARTICULAR,$blank_val,$createdBy);
						}else if($d == 4){
							$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$d,$vr_date,$pfctCode,$postingCode,$postingName,'','',$accCode[$i],$accName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$tds_crAmt,$tds_DrAmt,$perticularText,$blank_val,$createdBy);
						}

					}

					/* ----- END : Insert When TDS Is Apply ------ */

				}else{

					/* ----- START : Insert When TDS Not Is Apply ------ */
					
					$this->InsertInCashBankNew($NewVrno,$slno,$compcode,$fisYear,$pfctCode,$pfctName,$tranCode,$seriesCode,$seriesName,$postingCode,$postingName,$vrType,$saleRepCode,$costCenterCode[$i],$costCenterName[$i],$vr_date,$glCode[$i],$glName[$i],$accCode[$i],$accName[$i],$perticularText,$drAmt,$crAmt,$instType[$i],$instTypeName[$i],$chequeNo[$i],$chequeDate,$blank_val,$blank_val,$blank_val,$blank_val,$blank_val,$blank_val,$ifPayAdvAply,$chequeTblcolData[$i],$createdBy);

					if($glCode[$i]){

						$gl_ledg = 3;

						for($r=1;$r<$gl_ledg;$r++){

							$gltranH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
							$gl_headID = json_decode(json_encode($gltranH), true); 
						
							if(empty($gl_headID[0]['GLTRANID'])){
								$glt_head_Id = 1;
							}else{
								$glt_head_Id = $gl_headID[0]['GLTRANID']+1;
							}

							if($r==1){
								$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$slno,$vr_date,$pfctCode,$glCode[$i],$glName[$i],'','',$accCode[$i],$accName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$drAmt,$crAmt,$perticularText,$blank_val,$createdBy);
							}else if($r==2){
								$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$slno,$vr_date,$pfctCode,$postingCode,$postingName,'','',$accCode[$i],$accName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$crAmt,$drAmt,$perticularText,$blank_val,$createdBy);
							}

						}
					}

					if($accCode[$i]){

						$acctraH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
						$accheadID = json_decode(json_encode($acctraH), true); 
					
						if(empty($accheadID[0]['ACCTRANID'])){
							$acc_head_Id = 1;
						}else{
							$acc_head_Id = $accheadID[0]['ACCTRANID']+1;
						}

						$this->AccountTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,1,$vr_date,$pfctCode,$accCode[$i],$accName[$i],$glCode[$i],$glName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$drAmt,$crAmt,$perticularText,$narration,$createdBy);
					}

					/* ----- END : Insert When TDS Is Apply ------ */
				}

				/* ---- START : UPDATE IN CHEQUEBOOK ---- */

				if($chChequeBookOpen == 'YES' && $instType[$i]='CH' && $chequeNo[$i]!=''){

					$splitColData = explode('~',$chequeTblcolData[$i]);

					$chqHeadId = $splitColData[1];
					$chqBodyId = $splitColData[2];
					$chqSlno   = $splitColData[3];

					$dataChq = array(
						'CHEQUEDATE' => $chequeDate,
						'GL_CODE'    => $glCode[$i],
						'GL_NAME'    => $glName[$i],
						'ACC_CODE'   => $accCode[$i],
						'ACC_NAME'   => $accName[$i],
						'AMOUNT'     => $drAmt,
						//'AMOUNT'     => $tdsDebitAmt[$i],
						'REMARK'     => $perticularText
					);

					DB::table('MASTER_CHEQUEBOOK_BODY')->where('COMP_CODE',$compcode)->where('SERIES_CODE',$seriesCode)->where('CHQBHID',$chqHeadId)->where('CHQBBID',$chqBodyId)->where('SLNO',$chqSlno)->update($dataChq);

				}

				/* ---- END : UPDATE IN CHEQUEBOOK ---- */

			} /* /. for loop */

			/* ---------- START : BILL TRACKING -------- */

				if($accTranId){
					$AccIDCnt = count($accTranId);

					for($H=0;$H<$AccIDCnt;$H++){

						if($vrType == 'Payment'){

							$getPData = DB::table('ACC_TRAN')->where('ACCTRANID',$accTranId[$H])->where('COMP_CODE',$compcode)->get()->first();

							$oldCrAlocAmt = $getPData->CRALLOC;
							$newAloccrAmt = $oldCrAlocAmt + $alocateAmt[$H];

							$datac = array(
							  'CRALLOC' =>$newAloccrAmt,
							);

							DB::table('ACC_TRAN')->where('ACCTRANID',$accTranId[$H])->where('COMP_CODE',$compcode)->update($datac);

						}else if($vrType == 'Receipt'){

							$getDrData = DB::table('ACC_TRAN')->where('ACCTRANID',$accTranId[$H])->where('COMP_CODE',$compcode)->get()->first();

							$olddrAlocAmt = $getData->DRALLOC;
							$newAlocAmt = $olddrAlocAmt + $alocateAmt[$H];

							$datadr = array(
							  'DRALLOC' =>$newAlocAmt,
							);

							DB::table('ACC_TRAN')->where('ACCTRANID',$accTranId[$H])->where('COMP_CODE',$compcode)->update($datadr);

						}

					}/* ACC ID LOOP*/
				}
			/* ---------- END : BILL TRACKING -------- */

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tranCode)->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$compcode)->where('FY_CODE',$fisYear)->get()->toArray();

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$compcode,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$tranCode,
					'SERIES_CODE' =>$seriesCode,
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tranCode)->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$compcode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();

			if(($pdfYesNoStatus == 1) || ($pdfYesNoStatus == 2)){
				return $this->GeneratePdfForCashBnk($compcode,$fisYear,$seriesCode,$NewVrno,$tranCode,$vrType,$CASHPDFDL);
			}

			$response_array['response'] = 'success';
			$dataget = json_encode($response_array);  
			print_r($dataget);

		}catch (\Exception $e) {
			DB::rollBack();
			//throw $e;
			 $response_array['response'] = 'error';
			 $dataget = json_encode($response_array);  
			print_r($dataget);
		}


	}

	public function InsertInCashBankNew($vrNo,$slno,$compCode,$fyCode,$pfctCode,$pfctName,$transCode,$seriesCode,$seriesName,$postingCd,$postingName,$vrType,$saleRepCode,$costcCode,$costcName,$vrDate,$glCode,$glName,$accCode,$accName,$perticular,$drAmt,$crAmt,$instType,$instTypeName,$chqNo,$chqDate,$tdsCodeOfAcc,$tdsRate,$tdscutdrAmt,$tdsCutCrAmt,$tdsdrAmt,$tdsCrAmt,$ifPayAdvAply,$chequeTblcolData,$loginUser){	

		if($tdscutdrAmt!=''){
			$tdsCutAmt = $tdscutdrAmt;
		}else{
			$tdsCutAmt = $tdsCutCrAmt;
		}

		if($tdsdrAmt!=''){
			$tdsbaseAmt = $tdsdrAmt + $tdsCutAmt;
		}else if($tdsCrAmt !=''){
			$tdsbaseAmt = $tdsCrAmt + $tdsCutAmt;
		}else{
			$tdsbaseAmt = '0.00';
		}

		if(($tdsdrAmt !='') && ($drAmt !='')){
			$dr_Amt = $tdsdrAmt;	
		}else{
			$dr_Amt = $drAmt;
		}

		if(($tdsCrAmt !='') && ($crAmt !='')){
			$cr_Amt = $tdsCrAmt;	
		}else{
			$cr_Amt = $crAmt;
		}

		if($chequeTblcolData){
			$splitChqData = explode('~',$chequeTblcolData);
			$chqHeadId = $splitChqData[1];
			$chqBodyId = $splitChqData[2];
			$chqSlNoId = $splitChqData[3];
		}else{
			$chqHeadId = null;
			$chqBodyId = null;
			$chqSlNoId = null;
		}

		$data = array(

			'COMP_CODE'        => $compCode,
			'FY_CODE'          => $fyCode,
			'PFCT_CODE'        => $pfctCode,
			'PFCT_NAME'        => $pfctName,
			'TRAN_CODE'        => $transCode,
			'SERIES_CODE'      => $seriesCode,
			'SERIES_NAME'      => $seriesName,
			'HEAD_GLCODE'      => $postingCd,
			'HEAD_GLNAME'      => $postingName,
			'VRTYPE'           => $vrType,
			'SR_CODE'          => $saleRepCode,
			'COST_CENTER'      => $costcCode,
			'COST_CENTER_NAME' => $costcName,
			'VRNO'             => $vrNo,
			'SLNO'             => $slno,
			'VRDATE'           => $vrDate,
			'GL_CODE'          => $glCode,
			'GL_NAME'          => $glName,
			'ACC_CODE'         => $accCode,
			'ACC_NAME'         => $accName,
			'PARTICULAR'       => $perticular,
			'DRAMT'            => $dr_Amt,
			'CRAMT'            => $cr_Amt,
			'INST_TYPE'        => $instType,
			'INST_TYPE_NAME'   => $instTypeName,
			'INST_NO'          => $chqNo,
			'INST_DATE'        => $chqDate,
			'TDS_CODE'         => $tdsCodeOfAcc,
			'TDS_RATE'         => $tdsRate,
			'TDSBASE_AMT'      => $tdsbaseAmt,
			'TDS_AMT'          => $tdsCutAmt,
			'PAYMENT_ADVICE'   => $ifPayAdvAply,
			'CHQ_HID'          => $chqHeadId,
			'CHQ_BID'          => $chqBodyId,
			'CHQ_SLNO'         => $chqSlNoId,
			'CREATED_BY'       => $loginUser,
		);

		DB::table('CB_TRAN')->insert($data);

	}

	public function InsertInTdsTranNew($tdsHeadId,$compCode,$fyCode,$pfctCode,$pfctName,$tranCode,$seriesCode,$vrNo,$slNo,$vrType,$vrDate,$glCode,$glName,$accCode,$accName,$perticular,$tdsCutDr,$tdsCutCr,$insType,$instTypeName,$chqNo,$chqDate,$costCCode,$tdsCodeOfAcc,$tdsRate,$drAmt,$crAmt,$loginUser)
	{

		if($tdsCutDr > 0){
			$tdsAmt = $tdsCutDr;
		}else if($tdsCutCr > 0){
			$tdsAmt = $tdsCutCr;
		}

		if($drAmt > 0){
			$tdsbaseAmt = $drAmt;
		}else if($crAmt > 0){
			$tdsbaseAmt = $crAmt;
		}

		$dataTds = array(
			'TDSTRANID'   => $tdsHeadId,
			'COMP_CODE'   => $compCode,
			'FY_CODE'     => $fyCode,
			'PFCT_CODE'   => $pfctCode,
			'PFCT_NAME'   => $pfctName,
			'TRAN_CODE'   => $tranCode,
			'SERIES_CODE' => $seriesCode,
			'VRNO'        => $vrNo,
			'SLNO'        => $slNo,
			'VRTYPE'      => $vrType,
			'VRDATE'      => $vrDate,
			'GL_CODE'     => $glCode,
			'GL_NAME'     => $glName,
			'ACC_CODE'    => $accCode,
			'ACC_NAME'    => $accName,
			'PARTICULAR'  => $perticular,
			'DRAMT'       => $tdsCutDr,
			'CRAMT'       => $tdsCutCr,
			'INST_TYPE'   => $insType,
			'INST_TYPE_NAME' => $instTypeName,
			'INST_NO'     => $chqNo,
			'INST_DATE'   => $chqDate,
			'COST_CODE'   => $costCCode,
			'TDS_CODE'    => $tdsCodeOfAcc,
			'TDS_RATE'    => $tdsRate,
			'BASE_AMT'    => $tdsbaseAmt,
			'TDS_AMT'     => $tdsAmt,
			'CREATED_BY'  => $loginUser,
		);

		DB::table('TDS_TRAN')->insert($dataTds);
	}	

	
/* ------------ new cash bank transaction ------------ */


/*cash bank trans*/

	public function CbSimulation(Request $request){

		if ($request->ajax()) {
			
			$drAmount     = $request->post('dramount');
			$cramount     = $request->post('cramount');
			$acc_code     = $request->post('acc_code');
			$glCode       = $request->post('glCode');
			$bankGl       = $request->post('bankGl');
			$perticulr    = $request->post('perticulr');
			$reftext      = $request->post('reftext');
			$tdsDebitAmt  = $request->post('tdsDebitAmt');
			$tdsCutDrAmt  = $request->post('tdsCutDrAmt');
			$tdsCreditAmt = $request->post('tdsCreditAmt');
			$tdscutCrAmt  = $request->post('tdscutCrAmt');
			$tdsGlName    = $request->post('tdsGlName');
			$acc_Name     = $request->post('acc_Name');
			$glTDS        = $request->post('glTDS');
			$loginUser    = $request->session()->get('userid');
			$accCount     = count($acc_code);

			DB::table('SIMULATION_TEMP')->where('TCFLAG','CB')->where('CREATED_BY',$loginUser)->delete();
			$totalDrAmt = 0;
			$totalCrAmt = 0;
			/* ----- START MAIN LOOP ----- */
			for($i=0;$i<$accCount;$i++){

				if($drAmount[$i]){
					$drAmt     = $drAmount[$i];
				}else{
					$drAmt = 0.00;
				}

				if($cramount[$i]){
					$crAmt     = $cramount[$i];
				}else{
					$crAmt = 0.00;
				}

				if($tdsDebitAmt[$i]){
					$tdsDrAmt = $tdsDebitAmt[$i];
				}else{
					$tdsDrAmt = 0.00;
				}

				if($tdsCreditAmt[$i]){
					$tdscrAmt = $tdsCreditAmt[$i];
				}else{
					$tdscrAmt = 0.00;
				}

				if($tdsCutDrAmt[$i]){
					$tdscut_drAmt = $tdsCutDrAmt[$i];
				}else{
					$tdscut_drAmt = 0.00;
				}

				if($tdscutCrAmt[$i]){
					$tdscut_CrAmt = $tdscutCrAmt[$i];
				}else{
					$tdscut_CrAmt = 0.00;
				}

				if($tdsDebitAmt[$i] || $tdsCreditAmt[$i]){

					/* ----- START - IF TDS IS APPLY  ------ */

					for($p=0;$p<4;$p++){
						if($p==0){
							$data01 = array(
								'DR_AMT'       => $tdsDrAmt,
								'CR_AMT'       => $tdscrAmt,
								'IND_GL_CODE'  => $glCode[$i],
								'IND_ACC_CODE' => $acc_code[$i],
								'PERTICULAR'   => $perticulr[$i],
								'TCFLAG'       => 'CB',
								'CREATED_BY'   => $loginUser
							);
							DB::table('SIMULATION_TEMP')->insert($data01);
						}else if($p==1){
							$data02 = array(
								'DR_AMT'       => $tdscut_drAmt,
								'CR_AMT'       => $tdscut_CrAmt,
								'IND_GL_CODE'  => $glCode[$i],
								'IND_ACC_CODE' => $acc_code[$i],
								'PERTICULAR'   => 'To - '.$glTDS[$i].' - '.$tdsGlName[$i],
								'TCFLAG'       => 'CB',
								'CREATED_BY'   => $loginUser
							);
							DB::table('SIMULATION_TEMP')->insert($data02);
						}else if($p==2){
							$data03 = array(
								'DR_AMT'       => $tdscut_CrAmt,
								'CR_AMT'       => $tdscut_drAmt,
								'IND_GL_CODE'  => $glTDS[$i],
								'IND_ACC_CODE' => $acc_code[$i],
								'PERTICULAR'   => 'By - '.$acc_code[$i].' - '.$acc_Name[$i],
								'TCFLAG'       => 'CB',
								'CREATED_BY'   => $loginUser
							);
							DB::table('SIMULATION_TEMP')->insert($data03);
						}else if($p==3){
							$data04 = array(
								'DR_AMT'       => $tdscrAmt,
								'CR_AMT'       => $tdsDrAmt,
								'IND_GL_CODE'  => $bankGl,
								'IND_ACC_CODE' => $acc_code[$i],
								'PERTICULAR'   => $perticulr[$i],
								'TCFLAG'       => 'CB',
								'CREATED_BY'   => $loginUser
							);
							DB::table('SIMULATION_TEMP')->insert($data04);
						}
					}
					/* ----- END - IF TDS IS APPLY ------ */

				}else{

					/* --- START - TDS NOT APPLY ----*/
					for($n=0;$n<2;$n++){
						if($n==0){
							$data = array(
								'DR_AMT'       => $drAmt,
								'CR_AMT'       => $crAmt,
								'IND_GL_CODE'  => $glCode[$i],
								'IND_ACC_CODE' => $acc_code[$i],
								'PERTICULAR'   => $perticulr[$i],
								'TCFLAG'       => 'CB',
								'CREATED_BY'   => $loginUser
							);

							DB::table('SIMULATION_TEMP')->insert($data);
						}else if($n==1){
							$data1 = array(
								'DR_AMT'       => $crAmt,
								'CR_AMT'       => $drAmt,
								'IND_GL_CODE'  => $bankGl,
								'IND_ACC_CODE' => $acc_code[$i],
								'PERTICULAR'   => $perticulr[$i],
								'TCFLAG'       => 'CB',
								'CREATED_BY'   => $loginUser
							);

							DB::table('SIMULATION_TEMP')->insert($data1);
						}
					}

					/* --- END - TDS NOT APPLY ----*/

				}
				
			}
			/* ----- END - MAIN LOOP ----- */

			$response_array = array();
			$simData = DB::select("SELECT t1.*,t2.GL_NAME as glName,t3.ACC_NAME AS accName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE LEFT JOIN MASTER_ACC t3 ON t3.ACC_CODE = t1.IND_ACC_CODE WHERE t1.TCFLAG='CB' AND t1.CREATED_BY='$loginUser'");

			if ($simData) {

				$response_array['response'] = 'success';
				$response_array['data_sim'] = $simData;
				echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
				$response_array['data_sim'] = '' ;
				$data = json_encode($response_array);
				
			}

		}
		
	}

	public function selectPayAdviceOnCashBank(Request $request){

			$trans_codePay  = $request->trans_code;
			$series_codePay = $request->series_code;
			$vrno           = $request->vrno;
			$payaccCode     = $request->payaccCode;
			$payflag        = $request->payflag;
			$paymentid      = $request->paymentid;
			$onoffcheck     = $request->onoff;
			$payadviceAmt   = $request->payadviceAmt;

			$combineF=array_combine($payflag,$onoffcheck);
			//$count = count($paymentid);
			$countF = count($payflag);

			$count = count($paymentid);

			$saveData='';


			for ($i=0; $i < $count; $i++) { 
				
				$data=array(
					
						"PMT_VRNO"      => $vrno,
						"PMT_TRAN_CODE" => $trans_codePay,
						"PMT_SERIES"    => $series_codePay,
						"PMT_SLNO"      => $vrno
					
					
					);

				//print_r($data);
				$saveData = DB::table('PAYMENT_ADVICE_TRAN')->where('ACC_CODE',$payaccCode[$i])->where('PAYID',$paymentid[$i])->update($data);
			}

			/*for($j=0;$j<$countF;$j++){

				
				$getval = $j + 101;
			
				
				

				
				
				if($combineF[$getval]=='on'){
				
					$data=array(
					
						"PMT_VRNO"      => $vrno,
						"PMT_TRAN_CODE" => $trans_codePay,
						"PMT_SERIES"    => $series_codePay,
						"PMT_SLNO"      => $vrno
					
					
					);

				
				$saveData = DB::table('PAYMENT_ADVICE_TRAN')->where('ACC_CODE',$payaccCode[$j])->where('PAY_FLAG',$payflag[$j])->update($data);
				

				}*/

					
		/*	}*/
		
		//exit;

		if ($saveData) {

				$response_array['response'] = 'success';
				//$response_array['data'] = $item_um_aum_list ;

				$data = json_encode($response_array);

				print_r($data);

			} else {

				$response_array['response'] = 'error';
			   // $response_array['data'] = '' ;

				$data = json_encode($response_array);

				print_r($data);

			} 


			
	}


	public function cashbank_success_msg(Request $request,$saveData){

	 //	print_r($savedata);exit;

		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/finance/view-cash-bank');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/finance/view-cash-bank');

		}
	}


	public function BillTrackAccountData(Request $request){

		if ($request->ajax()) {

			$company_name 	= $request->session()->get('company_name');
			$compcode = explode('-', $company_name);
			$getcompcode=	$compcode[0];
			$macc_year 		= $request->session()->get('macc_year');
			$usertype 	= $request->session()->get('user_type');
			$userid	= $request->session()->get('userid');

			$party  = $request->partyC;

			$strWhere = '';

			if(isset($party)  && trim($party)!=""){

				$strWhere .= "AND SBILL_HEAD.ACC_CODE= '".$party."' AND SBILL_HEAD.FY_CODE = '".$macc_year."' AND SBILL_HEAD.COMP_CODE='".$getcompcode."'";

			}


			$data = DB::select("SELECT SBILL_HEAD.COMP_CODE,SBILL_HEAD.FY_CODE,SBILL_HEAD.PFCT_CODE,SBILL_HEAD.TRAN_CODE,SBILL_HEAD.SERIES_CODE,SBILL_HEAD.VRNO,SBILL_HEAD.VRDATE,SBILL_HEAD.ACC_CODE,SBILL_HEAD.COST_CENTER,SBILL_BODY.ITEM_CODE,SBILL_BODY.ITEM_NAME,SBILL_BODY.QTYISSUED,SBILL_BODY.DRAMT FROM SBILL_HEAD,SBILL_BODY WHERE SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID $strWhere");

			return DataTables()->of($data)->addIndexColumn()->make(true);


		}else{

			$data = array();

			return DataTables()->of($data)->addIndexColumn()->make(true);
				

		}


	}


	public function ViewBankCashMast(Request $request){

		$company_name = $request->session()->get('company_name');
		$compcode     = explode('-', $company_name);
		$getcompcode  =	$compcode[0];
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');
		$transCode    = 'A0';

		if ($request->ajax()) {

			if (!empty($request->accCode || $request->BankCode || $request->toDate || $request->fromDate)) {

				$party     = $request->accCode;
				$bankcode  = $request->BankCode;
				$toDate    = $request->toDate;
				$from_Date = $request->fromDate;
				$to_date   = date("Y-m-d", strtotime($toDate));
				$frDate    = date("Y-m-d", strtotime($from_Date));
				$strWhere  = '';
				if(isset($bankcode)  && trim($bankcode)!="" && $usertype=='admin')
				{
					$strWhere.="AND CB_TRAN.SERIES_CODE= '$bankcode'";

				}

				if(isset($party)  && trim($party)!="" && $usertype=='admin')
				{
					$strWhere.="AND CB_TRAN.ACC_CODE= '$party'";

				}

				if(isset($to_date)  && trim($to_date)!="")
				{
					$strWhere .="AND CB_TRAN.VRDATE BETWEEN '$frDate' AND  '$to_date'";
				}

				$data = DB::select("SELECT * FROM `CB_TRAN` WHERE 1=1 $strWhere AND TRAN_CODE='$transCode' AND COMP_CODE='$getcompcode' AND FY_CODE='$macc_year'");

				return DataTables()->of($data)->addIndexColumn()->make(true);

				/*return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="JavaScript:Void(0);"  class="btn btn-warning btn-xs" style="font-size: 10px;padding: 0px 2px;" disabled><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#cashBankDelete" style="font-size: 10px;padding: 0px 2px;" class="btn btn-danger btn-xs" onclick="return deleteCashBank('.$data->UPDATED_FLAG.')" disabled><i class="fa fa-trash" title="delete"></i></button>';
					
					return $btn;
				})->make(true);*/

			}else{


				$data = DB::select("SELECT * FROM `CB_TRAN` where 1=1 AND TRAN_CODE='$transCode' AND COMP_CODE='$getcompcode' AND FY_CODE='$macc_year'");

				return DataTables()->of($data)->addIndexColumn()->make(true);
				
				/*return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="JavaScript:Void(0);" style="font-size: 10px;padding: 0px 2px;" class="btn btn-warning btn-xs" disabled><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#cashBankDelete" style="font-size: 10px;padding: 0px 2px;" class="btn btn-danger btn-xs" onclick="return deleteCashBank('.$data->UPDATED_FLAG.')" disabled><i class="fa fa-trash" title="delete"></i></button>';
					
					return $btn;
				})->make(true);*/
	
			}
		}


		$title = 'View Cash Bank Transaction';

		$acc_list        = DB::table('MASTER_ACC')->get();

		$getCommonData = MyCommonFun($transCode,$getcompcode,$macc_year);

		$userdata['series_list']  = $getCommonData['getseries'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		if(isset($company_name)){

			return view('admin.finance.transaction.account.view_cash_bank',$userdata+compact('title','acc_list'));
		}else{
			return redirect('/useractivity');
		}
	}

	public function EditCashBank(Request $request,$compCode,$fyCode,$tranCode,$seriesCode,$vrNo){

        $title = 'Edit Cash/Bank Transaction';

        $CompanyCode   = $request->session()->get('company_name');
        $compcode      = explode('-', $CompanyCode);
        $getcompcode   = $compcode[0];
        $macc_year     = $request->session()->get('macc_year');

		$comp_code   = base64_decode($compCode);
		$fy_code     = base64_decode($fyCode);
		$tran_code   = base64_decode($tranCode);
		$series_code = base64_decode($seriesCode);
		$vr_no       = base64_decode($vrNo);
        
        if($comp_code!='' && $fy_code!='' && $tran_code!='' && $series_code!='' && $vr_no!=''){

            $userdata['cb_tran_data'] = DB::table('CB_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fy_code)->where('TRAN_CODE',$tran_code)->where('SERIES_CODE',$series_code)->where('VRNO',$vr_no)->get();

            $ConstructData = MyConstruct();
			$userdata['acc_list']      = $ConstructData['master_party'];
			$userdata['cost_list']     = $ConstructData['master_cost'];

            $getCommonData = MyCommonFun($tran_code,$getcompcode,$macc_year);

            $userdata['gl_list'] = $getCommonData['master_GL'];
            $userdata['remark_list'] = $getCommonData['remark_data'];

            return view('admin.finance.transaction.account.edit_cash_bank_trans',$userdata+compact('title','macc_year'));

        }else{
            $request->session()->flash('alert-error', 'Cash Bank Not Found...!');
            return redirect('/finance/view-cash-bank');
        }

    }

    public function LoadQueryOnEditCashBank(Request $request){

		$accCode      = $request->input('accCode');
		$seriesCode   = $request->input('seriesCode');
		$seriesGlCode = $request->input('seriesglCode');

    	if ($request->ajax()) {

    		if($accCode){

    			$fetch_tdsCode = DB::table('MASTER_ACC')->where('ACC_CODE',$accCode)->get();
			
				$fetch_tds_rate = DB::table('MASTER_TDS_RATE')->where('TDS_CODE',$fetch_tdsCode[0]->TDS_CODE)->get()->toArray();

				$ACCglList = DB::select("SELECT *,G.GL_CODE,G.GL_NAME FROM MASTER_GLKEY M, MASTER_ACC A,MASTER_GL G WHERE M.ATYPE_CODE=A.ATYPE_CODE AND G.GL_CODE = M.GL_CODE AND ACC_CODE='$accCode'");
    		}else{
				$fetch_tdsCode  = ''; 
				$fetch_tds_rate = '';
				$ACCglList      = '';
    		}

    		if($seriesCode && $seriesGlCode){

    			$chqueNo_list = DB::table('MASTER_CHEQUEBOOK_HEAD')
				->select('MASTER_CHEQUEBOOK_HEAD.*', 'MASTER_CHEQUEBOOK_BODY.*')
				->leftjoin('MASTER_CHEQUEBOOK_BODY', 'MASTER_CHEQUEBOOK_BODY.CHQBHID', '=', 'MASTER_CHEQUEBOOK_HEAD.CHQBHID')
				->where('MASTER_CHEQUEBOOK_HEAD.SERIES_CODE',$seriesCode)
				->where('MASTER_CHEQUEBOOK_HEAD.GL_CODE',$seriesGlCode)
				->where('MASTER_CHEQUEBOOK_BODY.AMOUNT','0.00')
				->whereNull('MASTER_CHEQUEBOOK_BODY.GL_CODE')
				->where('MASTER_CHEQUEBOOK_BODY.PRINT_FLAG','0')
				->get();

    		}else{
    			$chqueNo_list = '';
    		}

    		if ($fetch_tdsCode || $fetch_tds_rate || $ACCglList || $chqueNo_list) {

				$response_array['response']      = 'success';
				$response_array['data_TDS']      = $fetch_tdsCode;
				$response_array['data_TDS_RATE'] = $fetch_tds_rate;
				$response_array['data_ACCGL']    = $ACCglList;
				$response_array['chqNoList']    = $chqueNo_list;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response']      = 'error';
				$response_array['data_TDS']      = '' ;
				$response_array['data_TDS_RATE'] = '' ;
				$response_array['data_ACCGL']    = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

				$response_array['response']      = 'error';
				$response_array['data_TDS']      = '' ;
				$response_array['data_TDS_RATE'] = '' ;
				$response_array['data_ACCGL']    = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


	public function CashBankFormUpdate(Request $request){
			
		$createdBy        = $request->session()->get('userid');
		$compName         = $request->session()->get('company_name');
		$explodeCode      = explode('-', $compName);
		$compcode         = $explodeCode[0];
		$fisYear          =  $request->session()->get('macc_year');
		$vrDate           = $request->input('vrDate');
		$vr_date          = date("Y-m-d", strtotime($vrDate));
		$tranCode         = $request->input('tran_code');
		$seriesCode       = $request->input('seriescode');
		$seriesName       = $request->input('seriesname');
		$NewVrno          = $request->input('vr_no');
		$postingCode      = $request->input('glCode');
		$postingName      = $request->input('glName');
		$vrType           = $request->input('vrTypeData');
		$pfctCode         = $request->input('pfctCode');
		$pfctName         = $request->input('profitName');
		$saleRepCode      = $request->input('sale_rep_code');
		$glCode           = $request->input('glCodeName');
		$glName           = $request->input('genrl_name');
		$costCenterCode   = $request->input('costCenterCd');
		$costCenterName   = $request->input('costCenter_name');
		$accCode          = $request->input('acc_code');
		$accName          = $request->input('acc_name');
		$tdsCodeByAcc     = $request->input('tdsCodeByAc');
		$tdsRates         = $request->input('accTds_Rate');
		$tdsGlCode        = $request->input('gltdscode');
		$tdsGlName        = $request->input('gltdsname');
		$instType         = $request->input('instrument_type');
		$instTypeName     = $request->input('intTypeName');
		$chequeNo         = $request->input('instrument_no');
		$cheque_Date      = $request->input('chquedate');
		$remark           = $request->input('ref_text');
		$perticular       = $request->input('particular');
		$drAmount         = $request->input('dr_amount');
		$crAmount         = $request->input('cr_amount');
		$tdsDebitAmt      = $request->input('TdsDebitAmount');
		$tdsCreditAmt     = $request->input('TdsCreditAmount');
		$debitTdsCut      = $request->input('DebitdsAmt');
		$CreditTdsCut     = $request->input('CredittdsAmt');
		$pdfYesNoStatus   =  $request->input('pdfYesNoStatus');
		$payAdviceRChk    =  $request->input('payAdviceRChk');
		$paymentAdvDone   =  $request->input('paymentAdvDone');
		$refTextPA        =  $request->input('refTextPA');
		$chChequeBookOpen =  $request->input('checkChequeBookOpen');
		$chequeTblcolData =  $request->input('chequeTblData');
		$narration        = '';

		$upCompCode =  $request->input('upCompCode');
		$upFyCd     =  $request->input('upFyCd');
		$upTranCd   =  $request->input('upTranCd');
		$upSeriesCd =  $request->input('upSeriesCd');
		$upVrno     =  $request->input('upVrno');
		$tblName    = 'CB_TRAN';
		$blank_val        = '';
		$cashPDf='PAYMENTVOUCHER_TWO';
		$rowCount         = count($glCode);


		DB::beginTransaction();

		try {

			$this->AccEntryWhenEditDelete($upCompCode,$upFyCd,$upTranCd,$upSeriesCd,$upVrno,$tblName);

			for($i=0;$i<$rowCount;$i++){
				$slno = $i+1;
				$perticularText =$perticular[$i].', '.$remark[$i];

				if($cheque_Date[$i]){
					$chequeDate     = date("Y-m-d", strtotime($cheque_Date[$i]));
				}else{
					$chequeDate     = null;
				}

				if($drAmount[$i]){
					$drAmt     = $drAmount[$i];
				}else{
					$drAmt = 0.00;
				}

				if($crAmount[$i]){
					$crAmt     = $crAmount[$i];
				}else{
					$crAmt = 0.00;
				}

				if($drAmt != 0.00){
					$amount = $drAmt;
				}else{
					$amount = $crAmt;
				}

				if($tdsDebitAmt[$i]){
					$tdsDrAmt = $tdsDebitAmt[$i];
				}else{
					$tdsDrAmt = 0.00;
				}

				if($tdsCreditAmt[$i]){
					$tdscrAmt = $tdsCreditAmt[$i];
				}else{
					$tdscrAmt = 0.00;
				}

				if($debitTdsCut[$i]){
					$tdscut_drAmt = $debitTdsCut[$i];
				}else{
					$tdscut_drAmt = 0.00;
				}

				if($CreditTdsCut[$i]){
					$tdscut_CrAmt = $CreditTdsCut[$i];
				}else{
					$tdscut_CrAmt = 0.00;
				}

				if($tdscut_drAmt){
					$cutDr = $tdscut_drAmt;
					$cutCr = $tdscut_CrAmt;
				}else if($tdscut_CrAmt){
					$cutCr = $tdscut_CrAmt;
					$cutDr = $tdscut_drAmt;
				}

				if($tdsDrAmt){
					$tds_DrAmt = $tdsDrAmt;
					$tds_crAmt = $tdscrAmt;
				}else if($tdscrAmt){
					$tds_crAmt = $tdscrAmt;
					$tds_DrAmt = $tdsDrAmt;
				}

				if($paymentAdvDone == 1){
					$ifPayAdvAply = 1;
				}else{
					$ifPayAdvAply = 0;
				}

				/* ------ START : PAYMENT ADVICE IS APPLY ------- */

				if($paymentAdvDone == 1){

					for($z=0;$z<count($payAdviceRChk);$z++){

						$splitData = explode('~',$payAdviceRChk[$z]);
						
						$dataPayAdv = array(
							'PMT_COMP_CODE' =>$compcode,
							'PMT_FY_CODE'   =>$fisYear,
							'PMT_TRAN_CODE' =>$tranCode,
							'PMT_SERIES'    =>$seriesCode,
							'PMT_VRNO'      =>$NewVrno,
							'PMT_SLNO'      =>$slno
						);

						DB::table('PAYMENT_ADVICE_TRAN')->where('PAYID',$splitData[0])->where('COMP_CODE',$splitData[1])->where('FY_CODE',$splitData[2])->where('SERIES_CODE',$splitData[3])->where('VRNO',$splitData[4])->where('SLNO',$splitData[5])->update($dataPayAdv);
					}
					
				}

				/* ------ END : PAYMENT ADVICE IS APPLY ------- */


				if($tdsDebitAmt[$i]!=0 || $tdsCreditAmt[$i]!=0){

					/* ----- START : Insert When TDS Is Apply ------ */


					$this->InsertInCashBankNew($NewVrno,$slno,$compcode,$fisYear,$pfctCode,$pfctName,$tranCode,$seriesCode,$seriesName,$postingCode,$postingName,$vrType,$saleRepCode,$costCenterCode[$i],$costCenterName[$i],$vr_date,$glCode[$i],$glName[$i],$accCode[$i],$accName[$i],$perticularText,$drAmt,$crAmt,$instType[$i],$instTypeName[$i],$chequeNo[$i],$chequeDate,$tdsCodeByAcc[$i],$tdsRates[$i],$tdscut_drAmt,$tdscut_CrAmt,$tdsDrAmt,$tdscrAmt,$ifPayAdvAply,$chequeTblcolData[$i],$createdBy);

					$tds_trans_row = 3;
					$GLPARTICULAR = '';
					for ($t=1; $t <$tds_trans_row ; $t++) { 

						$tdstranH = DB::select("SELECT MAX(TDSTRANID) as TDSTRANID FROM TDS_TRAN");
								$tds_headID = json_decode(json_encode($tdstranH), true); 
							
						if(empty($tds_headID[0]['TDSTRANID'])){
							$tds_head_Id = 1;
						}else{
							$tds_head_Id = $tds_headID[0]['TDSTRANID']+1;
						}

						if($t == 1){

							$perticularTx = 'To -'.$tdsGlCode[$i].' - '.$tdsGlName[$i];
							$GLPARTICULAR = 'To -'.$tdsGlCode[$i].' - '.$tdsGlName[$i];
							$this->InsertInTdsTranNew($tds_head_Id,$compcode,$fisYear,$pfctCode,$pfctName,$tranCode,$seriesCode,$NewVrno,$t,$vrType,$vr_date,$glCode[$i],$glName[$i],$accCode[$i],$accName[$i],$perticularTx,$tdscut_drAmt,$tdscut_CrAmt,$instType[$i],$instTypeName[$i],$chequeNo[$i],$chequeDate,$costCenterCode[$i],$tdsCodeByAcc[$i],$tdsRates[$i],$drAmt,$crAmt,$createdBy);

						}/*else if($t == 2){
							$perticularTx = 'To -'.$accCode[$i].' - '.$accName[$i];
							$this->InsertInTdsTranNew($tds_head_Id,$compcode,$fisYear,$pfctCode,$pfctName,$tranCode,$seriesCode,$NewVrno,$t,$vrType,$vr_date,$tdsGlCode[$i],$tdsGlName[$i],$accCode[$i],$accName[$i],$perticularTx,$tdscut_CrAmt,$tdscut_drAmt,$instType[$i],$instTypeName[$i],$chequeNo[$i],$chequeDate,$costCenterCode[$i],$tdsCodeByAcc[$i],$tdsRates[$i],$drAmt,$crAmt,$createdBy);

						}*/

					}

					$acccgetounts =5;
					for($d=1; $d < $acccgetounts ; $d++){

						if($d == 1){

							$this->AccountTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,1,$vr_date,$pfctCode,$accCode[$i],$accName[$i],$glCode[$i],$glName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$tds_DrAmt,$tds_crAmt,$perticularText,$narration,$createdBy);


							$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,1,$vr_date,$pfctCode,$glCode[$i],$glName[$i],'','',$accCode[$i],$accName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$tds_DrAmt,$tds_crAmt,$perticularText,$blank_val,$createdBy);

						}else if($d == 2){

							$this->AccountTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$d,$vr_date,$pfctCode,$accCode[$i],$accName[$i],$glCode[$i],$glName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$cutDr,$cutCr,$GLPARTICULAR,$narration,$createdBy);

							//$GLPARTICULAR = 'To '.$tdsGlCode[3].' - '.$tdsGlName[3];

							$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$d,$vr_date,$pfctCode,$glCode[$i],$glName[$i],'','',$accCode[$i],$accName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$cutDr,$cutCr,$GLPARTICULAR,$blank_val,$createdBy);

						}else if($d == 3){
							$GLPARTICULAR ='By - '.$accCode[$i].' - '.$accName[$i];
							//$GLPARTICULAR = 'To '.$accCode[$i].' - '.$accName[$i];
							$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$d,$vr_date,$pfctCode,$tdsGlCode[$i],$tdsGlName[$i],'','',$accCode[$i],$accName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$cutCr,$cutDr,$GLPARTICULAR,$blank_val,$createdBy);
						}else if($d == 4){
							$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$d,$vr_date,$pfctCode,$postingCode,$postingName,'','',$accCode[$i],$accName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$tds_crAmt,$tds_DrAmt,$perticularText,$blank_val,$createdBy);
						}

					}

					/* ----- END : Insert When TDS Is Apply ------ */

				}else{

					/* ----- START : Insert When TDS Not Is Apply ------ */
					
					$this->InsertInCashBankNew($NewVrno,$slno,$compcode,$fisYear,$pfctCode,$pfctName,$tranCode,$seriesCode,$seriesName,$postingCode,$postingName,$vrType,$saleRepCode,$costCenterCode[$i],$costCenterName[$i],$vr_date,$glCode[$i],$glName[$i],$accCode[$i],$accName[$i],$perticularText,$drAmt,$crAmt,$instType[$i],$instTypeName[$i],$chequeNo[$i],$chequeDate,$blank_val,$blank_val,$blank_val,$blank_val,$blank_val,$blank_val,$ifPayAdvAply,$chequeTblcolData[$i],$createdBy);

					if($glCode[$i]){

						$gl_ledg = 3;

						for($r=1;$r<$gl_ledg;$r++){

							$gltranH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
							$gl_headID = json_decode(json_encode($gltranH), true); 
						
							if(empty($gl_headID[0]['GLTRANID'])){
								$glt_head_Id = 1;
							}else{
								$glt_head_Id = $gl_headID[0]['GLTRANID']+1;
							}

							if($r==1){
								$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$slno,$vr_date,$pfctCode,$glCode[$i],$glName[$i],'','',$accCode[$i],$accName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$drAmt,$crAmt,$perticularText,$blank_val,$createdBy);
							}else if($r==2){
								$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$slno,$vr_date,$pfctCode,$postingCode,$postingName,'','',$accCode[$i],$accName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$crAmt,$drAmt,$perticularText,$blank_val,$createdBy);
							}

						}
					}

					if($accCode[$i]){

						$acctraH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
						$accheadID = json_decode(json_encode($acctraH), true); 
					
						if(empty($accheadID[0]['ACCTRANID'])){
							$acc_head_Id = 1;
						}else{
							$acc_head_Id = $accheadID[0]['ACCTRANID']+1;
						}

						$this->AccountTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,1,$vr_date,$pfctCode,$accCode[$i],$accName[$i],$glCode[$i],$glName[$i],$costCenterCode[$i],$costCenterName[$i],$saleRepCode,$blank_val,$drAmt,$crAmt,$perticularText,$narration,$createdBy);
					}

					/* ----- END : Insert When TDS Is Apply ------ */
				}

				/* ---- START : UPDATE IN CHEQUEBOOK ---- */

				if($chChequeBookOpen == 'YES' && $instType[$i]='CH' && $chequeNo[$i]!=''){

					$splitColData = explode('~',$chequeTblcolData[$i]);

					$chqHeadId = $splitColData[1];
					$chqBodyId = $splitColData[2];
					$chqSlno   = $splitColData[3];

					$dataChq = array(
						'CHEQUEDATE' => $chequeDate,
						'GL_CODE'    => $glCode[$i],
						'GL_NAME'    => $glName[$i],
						'ACC_CODE'   => $accCode[$i],
						'ACC_NAME'   => $accName[$i],
						'AMOUNT'     => $tdsDebitAmt[$i],
						'REMARK'     => $perticularText
					);

					DB::table('MASTER_CHEQUEBOOK_BODY')->where('COMP_CODE',$compcode)->where('SERIES_CODE',$seriesCode)->where('CHQBHID',$chqHeadId)->where('CHQBBID',$chqBodyId)->where('SLNO',$chqSlno)->update($dataChq);

				}

				/* ---- END : UPDATE IN CHEQUEBOOK ---- */

			} /* /. for loop */

			DB::commit();

			if(($pdfYesNoStatus == 1) || ($pdfYesNoStatus == 2)){
				return $this->GeneratePdfForCashBnk($compcode,$fisYear,$seriesCode,$NewVrno,$tranCode,$vrType,$cashPDf);
			}

			$response_array['response'] = 'success';
			$dataget = json_encode($response_array);  
			print_r($dataget);

		}catch (\Exception $e) {
			DB::rollBack();
			//throw $e;
			 $response_array['response'] = 'error';
			 $dataget = json_encode($response_array);  
			print_r($dataget);
		}
		
	} /* ./ main function*/

	public function cashbank_update_success_msg(Request $request,$saveData){

	 //	print_r($savedata);exit;

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cash Bank Transaction Was Successfully Updated...!');
			return redirect('/finance/view-cash-bank');

		} else {

			$request->session()->flash('alert-error', 'Cash Bank Not Updated...!');
			return redirect('/finance/view-cash-bank');

		}
	}


	public function DeleteCashBank_old(Request $request){

		$cashbankid = $request->post('cashbankid');
		

		if ($cashbankid!='') {
			
			//$Delete = DB::table('CB_TRAN')->where('UPDATED_FLAG', $cashbankid)->delete();
			//$Delete_acc_led = DB::table('LEDGER_TRAN')->where('UPDATED_FLAG', $cashbankid)->delete();
			//$Delete_tds_tran = DB::table('TDS_TRAN')->where('UPDATED_FLAG', $cashbankid)->delete();

			if ($Delete && $Delete_acc_led && $Delete_tds_tran) {

				$request->session()->flash('alert-success', 'Cash Bank Was Deleted Successfully...!');
				return redirect('/finance/view-cash-bank');

			} else {

				$request->session()->flash('alert-error', 'Cash Bank Can Not Deleted...!');
				return redirect('/finance/view-cash-bank');

			}

		}else{

			$request->session()->flash('alert-error', 'Cash Bank Can Not Found...!');
			return redirect('/finance/view-cash-bank');

		}

	}

	public function DeleteCashBank(Request $request){

		$cashBankid = $request->post('cashbankid');
		$createdBy  = $request->session()->get('userid');

		$splitCol   = explode('~',$cashBankid);
		$compCode   = $splitCol[0];
		$fyCode     = $splitCol[1];
		$tranCode   = $splitCol[2];
		$seriesCode = $splitCol[3];
		$vrNo       = $splitCol[4];
		$tblName    = 'CB_TRAN';

		DB::beginTransaction();

		try {

			$this->AccEntryWhenEditDelete($compCode,$fyCode,$tranCode,$seriesCode,$vrNo,$tblName);

			$discriptn_page = "Cash Bank trans insert done by user";
			$this->userLogInsert($createdBy,$tranCode,$seriesCode,$vrNo,$discriptn_page,'');

			DB::commit();
			$request->session()->flash('alert-success', 'Cash Bank Transaction Data Was Deleted Successfully...!');
			return redirect('/finance/view-cash-bank');

		   }catch (\Exception $e) {

			DB::rollBack();
			//throw $e;
			$request->session()->flash('alert-error', 'Cash Bank Transaction Data Can Not Deleted...!');
			return redirect('/finance/view-cash-bank');
		}

	}

/* ---------- END : CASH BANK TRANSACTION ------------- */

/* ------------ START : CONTRA TRANSACTION ----------- */

	public function ContraTrans(Request $request){

		$title         = 'Add Contra Transaction';
		
		$CompanyCode   = $request->session()->get('company_name');
		$compcode      = explode('-', $CompanyCode);
		$getcompcode   = $compcode[0];
		$macc_year     = $request->session()->get('macc_year');
		$transCode     = 'A1';
		
		$ConstructData = MyConstruct();
		
		$getCommonData = MyCommonFun($transCode,$getcompcode,$macc_year);

		$userdata['series_list'] = $getCommonData['getseries'];
		$userdata['remark_list'] = $getCommonData['remark_data'];
		$userdata['pfct_list']   = $getCommonData['masterPFCT'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}
		
		$userdata['List_acc_Code']  = DB::select("SELECT a.GL_CODE, b.GL_NAME FROM MASTER_HOUSEBANK a, MASTER_GL b WHERE a.GL_CODE= b.GL_CODE UNION SELECT a.GL_CODE, b.GL_NAME FROM MASTER_HOUSEBANK a, MASTER_GL b WHERE a.GL_CODE=b.GL_CODE");

		$transMast = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$transCode)->get();
		$userdata['trans_head'] =$transMast[0]->TRAN_CODE;

		if(isset($CompanyCode)){

			return view('admin.finance.transaction.account.contra_transaction',$userdata+compact('title'));
		}else{

			return redirect('/useractivity');
		}

	}

	public function ContraTransSave(Request $request){

		$createdBy      = $request->session()->get('userid');

		$compName       = $request->session()->get('company_name');
		$splitcomp      = explode('-', $compName);
		$compCode       = $splitcomp[0];
		$fisYear        =  $request->session()->get('macc_year');

		$accCode        = $request->input('acc_code');
		$accCount       = count($accCode);

		$ContraDate     = $request->input('contraDate');
		$finlContraDte  = date("Y-m-d", strtotime($ContraDate));
		$VrseqNo        = $request->input('vrNo');
		$TransCode      = $request->input('trancode');
		$series_code    = $request->input('seriescode');
		$series_name    = $request->input('seriesName');
		$pfct_code      = $request->input('pfctcode');
		$pfct_name      = $request->input('profitName');
		$AccName        = $request->input('acc_name');
		$debitTo        = $request->input('debit_to');
		$CreditBy       = $request->input('credit_by');
		$InstrumentType = $request->input('instrument_type');
		$InstrumentNum  = $request->input('instrument_no');
		$nstrumentDate  = $request->input('instrument_date');
		$finlInstruDate = date("Y-m-d", strtotime($nstrumentDate));
		$Perticular     = $request->input('particular');
		$pdfYesNoStatus =  $request->input('pdfYesNoStatus');
		$blankVal       ='';
		if($VrseqNo == ''){
			$vrNum = 1;
		}else{
			$vrNum = $VrseqNo;
		}

		$vrno_Exist = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$TransCode)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrno_Exist[0]->LAST_NO +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {

			for ($i=0; $i < $accCount; $i++) {

				$cbtranH = DB::select("SELECT MAX(CBTRANID) as CBTRANID FROM CB_TRAN");
				$headID = json_decode(json_encode($cbtranH), true); 
				if(empty($headID[0]['CBTRANID'])){
					$head_Id = 1;
				}else{
					$head_Id = $headID[0]['CBTRANID']+1;
				}

				if($debitTo[$i]){
					$drAmt = $debitTo[$i];
				}else{
					$drAmt = 0.00;
				}

				if($CreditBy[$i]){
					$crAmt = $CreditBy[$i];
				}else{
					$crAmt = 0.00;
				}
				$srNo= $i+1;
				$data = array(	
					'CBTRANID'    =>$head_Id,
					'COMP_CODE'   =>$compCode,
					'FY_CODE'     =>$fisYear,
					'PFCT_CODE'   =>$pfct_code,
					'PFCT_NAME'   =>$pfct_name,
					'TRAN_CODE'   =>$TransCode,
					'SERIES_CODE' =>$series_code,
					'SERIES_NAME' =>$series_name,
					'VRNO'        =>$NewVrno,
					'SLNO'        =>$i+1,
					'VRDATE'      =>$finlContraDte,
					'GL_CODE'     =>$accCode[$i],
					'GL_NAME'     =>$AccName[$i],
					'PARTICULAR'  =>$Perticular,
					'DRAMT'       =>$drAmt,
					'CRAMT'       =>$crAmt,
					'INST_TYPE'   =>$InstrumentType,
					'INST_NO'     =>$InstrumentNum,
					'INST_DATE'   =>$finlInstruDate,
					'CREATED_BY'  =>$createdBy,
				);

				$saveDataCB = DB::table('CB_TRAN')->insert($data);

				/*$discriptn_page = "Contra trans insert done by user";
				$this->userLogInsert($createdBy,$TransCode,$series_code,$NewVrno,$discriptn_page,$accCode[$i]);*/

				$this->GlTEntry($compCode,$fisYear,$TransCode,$series_code,$NewVrno,$srNo,$finlContraDte,$pfct_code,$accCode[$i],$AccName[$i],'','',$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$drAmt,$crAmt,$Perticular,$blankVal,$createdBy);
			}

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$TransCode)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->get()->toArray();

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$compCode,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$TransCode,
					'SERIES_CODE' =>$series_code,
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$TransCode)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->update($datavrn);
			}


			DB::commit();

			if($pdfYesNoStatus == 1){
				return $this->GeneratePdfForContra($NewVrno,$TransCode);
			}

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

	public function ContraSaveSuccessMsg(Request $request,$saveData){

	 //	print_r($savedata);exit;

		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/Transaction/Account/View-Contra-Trans');

		} else {

			$request->session()->flash('alert-success', 'Data  Was Successfully Added...!');
			return redirect('/Transaction/Account/View-Contra-Trans');

		}
	}

	public function ViewContraTrans(Request $request){

		$company_name  = $request->session()->get('company_name');
		$splitcompCode = explode('-', $company_name);
		$compCode      = $splitcompCode[0];
		$macc_year     = $request->session()->get('macc_year');
		$usertype      = $request->session()->get('user_type');
		$userid        = $request->session()->get('userid');

		if ($request->ajax()) {

			$data = DB::table('CB_TRAN')
			->where('TRAN_CODE','A1')
			->where('COMP_CODE', $compCode)
			->where('FY_CODE', $macc_year)
			->orderBy('VRDATE', 'ASC')
			->get();

			return DataTables()->of($data)->addIndexColumn()->make(true);
	
			
		}

		$title = 'View Contra Transaction';
		if(isset($company_name)){
			return view('admin.finance.transaction.account.view_contra_transaction',compact('title'));
		}else{
			return redirect('/useractivity');
		}

	}

	public function DeleteContraTrans(Request $request){

		$id         = $request->input('contranum');
		$splitCol   = explode('_',$id);
		$compCode   = $splitCol[0];
		$fyCode     = $splitCol[1];
		$tranCode   = $splitCol[2];
		$seriesCode = $splitCol[3];
		$vrNo       = $splitCol[4];
		$tblName    = 'CB_TRAN';

		DB::beginTransaction();

		try {

			$this->AccEntryWhenEditDelete($compCode,$fyCode,$tranCode,$seriesCode,$vrNo,$tblName);

			DB::commit();
			$request->session()->flash('alert-success', 'Contra Transaction Data Was Deleted Successfully...!');
			return redirect('/Transaction/Account/View-Contra-Trans');

		}catch (\Exception $e) {

			DB::rollBack();
			//throw $e;
			$request->session()->flash('alert-error', 'Contra Transaction Data Can Not Deleted...!');
			return redirect('/Transaction/Account/View-Contra-Trans');
		}

	}

	public function EditContraTrans(Request $request,$compCode,$fyCode,$tranCode,$seriesCode,$vnro){

		$title = 'Edit Contra Transaction';
		$comp_code   = base64_decode($compCode);
		$fy_code     = base64_decode($fyCode);
		$tran_code   = base64_decode($tranCode);
		$series_code = base64_decode($seriesCode);
		$vr_No       = base64_decode($vnro);

		if(($comp_code!='') && ($fy_code!='') && ($tran_code!='') && ($series_code!='') && ($vr_No!='')){
			$query = DB::table('CB_TRAN');
			$query->where('COMP_CODE', $comp_code);
			$query->where('FY_CODE', $fy_code);
			$query->where('TRAN_CODE', $tran_code);
			$query->where('SERIES_CODE', $series_code);
			$query->where('VRNO', $vr_No);
			$userdata['contra_list'] = $query->get()->toArray();

			$CompanyCode   = $request->session()->get('company_name');
			$compcode      = explode('-', $CompanyCode);
			$getcompcode   = $compcode[0];
			$macc_year     = $request->session()->get('macc_year');

			$ConstructData = MyConstruct();
	
			$getCommonData = MyCommonFun($tran_code,$getcompcode,$macc_year);

			$userdata['remark_list'] = $getCommonData['remark_data'];

			$userdata['List_acc_Code']  = DB::select("SELECT a.GL_CODE, b.GL_NAME FROM MASTER_HOUSEBANK a, MASTER_GL b WHERE a.GL_CODE= b.GL_CODE UNION SELECT a.GL_CODE, b.GL_NAME FROM MASTER_HOUSEBANK a, MASTER_GL b WHERE a.GL_CODE=b.GL_CODE");

			return view('admin.finance.transaction.account.edit_contra_transaction', $userdata+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Contra Transaction Id Not Found...!');
			return redirect('/Transaction/Account/View-Contra-Trans');
		}

	}

	public function UpdateContraTrans(Request $request){

		$createdBy      = $request->session()->get('userid');

		$compName       = $request->session()->get('company_name');
		$splitcomp      = explode('-', $compName);
		$compCode       = $splitcomp[0];
		$fisYear        =  $request->session()->get('macc_year');

		$accCode        = $request->input('acc_code');
		$accCount       = count($accCode);

		$ContraDate     = $request->input('contraDate');
		$finlContraDte  = date("Y-m-d", strtotime($ContraDate));
		$vrNo           = $request->input('vrNo');
		$TransCode      = $request->input('trancode');
		$series_code    = $request->input('seriescode');
		$series_name    = $request->input('seriesName');
		$pfct_code      = $request->input('pfctcode');
		$pfct_name      = $request->input('profitName');
		$AccName        = $request->input('acc_name');
		$debitTo        = $request->input('debit_to');
		$CreditBy       = $request->input('credit_by');
		$InstrumentType = $request->input('instrument_type');
		$InstrumentNum  = $request->input('instrument_no');
		$nstrumentDate  = $request->input('instrument_date');
		$finlInstruDate = date("Y-m-d", strtotime($nstrumentDate));
		$Perticular     = $request->input('particular');
		$pdfYesNoStatus =  $request->input('pdfYesNoStatus');
		$upCompCd       =  $request->input('upCompCd');
		$upFyCd         =  $request->input('upFyCd');
		$upTranCd       =  $request->input('upTranCd');
		$UpSeriesCd     =  $request->input('UpSeriesCd');
		$UpvrNo         =  $request->input('UpvrNo');
		$tblName        = 'CB_TRAN';
		$blankVal		='';
		DB::beginTransaction();

		try {

			$this->AccEntryWhenEditDelete($upCompCd,$upFyCd,$upTranCd,$UpSeriesCd,$UpvrNo,$tblName);

			for ($i=0; $i < $accCount; $i++) {

				$cbtranH = DB::select("SELECT MAX(CBTRANID) as CBTRANID FROM CB_TRAN");
				$headID = json_decode(json_encode($cbtranH), true); 
				if(empty($headID[0]['CBTRANID'])){
					$head_Id = 1;
				}else{
					$head_Id = $headID[0]['CBTRANID']+1;
				}

				if($debitTo[$i]){
					$drAmt = $debitTo[$i];
				}else{
					$drAmt = 0.00;
				}

				if($CreditBy[$i]){
					$crAmt = $CreditBy[$i];
				}else{
					$crAmt = 0.00;
				}
				$srNo = $i+1;
				$data = array(	
					'CBTRANID'    =>$head_Id,
					'COMP_CODE'   =>$compCode,
					'FY_CODE'     =>$fisYear,
					'PFCT_CODE'   =>$pfct_code,
					'PFCT_NAME'   =>$pfct_name,
					'TRAN_CODE'   =>$TransCode,
					'SERIES_CODE' =>$series_code,
					'SERIES_NAME' =>$series_name,
					'VRNO'        =>$vrNo,
					'SLNO'        =>$i+1,
					'VRDATE'      =>$finlContraDte,
					'GL_CODE'     =>$accCode[$i],
					'GL_NAME'     =>$AccName[$i],
					'PARTICULAR'  =>$Perticular,
					'DRAMT'       =>$drAmt,
					'CRAMT'       =>$crAmt,
					'INST_TYPE'   =>$InstrumentType,
					'INST_NO'     =>$InstrumentNum,
					'INST_DATE'   =>$finlInstruDate,
					'CREATED_BY'  =>$createdBy,
				);

				$saveDataCB = DB::table('CB_TRAN')->insert($data);

				/*$discriptn_page = "Contra trans insert done by user";
				$this->userLogInsert($createdBy,$TransCode,$series_code,$NewVrno,$discriptn_page,$accCode[$i]);*/

				$this->GlTEntry($compCode,$fisYear,$TransCode,$series_code,$vrNo,$srNo,$finlContraDte,$pfct_code,$accCode[$i],$AccName[$i],'','',$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$drAmt,$crAmt,$Perticular,$blankVal,$createdBy);

			}

			DB::commit();

			if($pdfYesNoStatus == 1){
				return $this->GeneratePdfForContra($vrNo,$TransCode);
			}

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


/* ---------------- END : CONTRA TRANSACTION ----------------- */

/* ----------------- START : JOURNAL TRANSACTION ---------------- */

	public function JournalTrans(Request $request){

		$title       ='Add Journal Transaction';
		
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');
		$transCode   = 'A2';

		$ConstructData = MyConstruct();

		$userdata['glkey_list']    = $ConstructData['master_glkey'];
		$userdata['account_list']  = $ConstructData['master_party'];
		$userdata['cost_list']     = $ConstructData['master_cost'];
		$userdata['sale_rep_list'] = $ConstructData['sale_rep_code'];
		//$userdata['gl_list']       = $ConstructData['master_gl'];
		
		$getCommonData = MyCommonFun($transCode,$getcompcode,$macc_year);

		$userdata['series_list'] = $getCommonData['getseries'];
		$userdata['remark_list'] = $getCommonData['remark_data'];
		$userdata['pfct_list']   = $getCommonData['masterPFCT'];
		$userdata['gl_list']     = $getCommonData['master_GL'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$transMast = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$transCode)->get();
		$userdata['trans_head'] =$transMast[0]->TRAN_CODE;

		//$userdata['reverseCdData'] = DB::select("SELECT S.REVCODE,S.REVNAME FROM ( SELECT ACC_CODE as REVCODE,ACC_NAME AS REVNAME FROM MASTER_ACC UNION ALL SELECT GL_CODE AS REVCODE,GL_NAME AS REVNAME FROM MASTER_GL ) S ORDER BY S.REVCODE");

		$userdata['reverseCdData'] = DB::select("SELECT S.REVCODE,S.REVNAME,S.REVTYPE FROM ( SELECT ACC_CODE as REVCODE,ACC_NAME AS REVNAME,ATYPE_CODE AS REVTYPE FROM MASTER_ACC UNION ALL SELECT GL_CODE AS REVCODE,GL_NAME AS REVNAME,GLSCH_TYPE AS REVTYPE FROM MASTER_GL ) S ORDER BY S.REVCODE");
	
		if(isset($CompanyCode)){

			return view('admin.finance.transaction.account.journal_trans',$userdata+compact('title'));
		}else{

			return redirect('/useractivity');
		}
	}

	public function SaveJournalTrnas(Request $request){

		$vrno           = $request->input('vrno');
		$transcode      = $request->input('tran_code');
		$vrdate         = $request->input('vr_date');
		$pay_vr_date    = date("Y-m-d", strtotime($vrdate));
		$pfctcode       = $request->input('pfct_code');
		$pfctname       = $request->input('pfct_name');
		$cost_code      = $request->input('cost_code');
		$cost_name      = $request->input('costC_name');
		$seriescode     = $request->input('series_Code');
		$seriesName     = $request->input('series_Name');
		$acccount       = $request->input('acc_code');
		$accname        = $request->input('acc_name');
		$glCode         = $request->input('gl_code');
		$glName         = $request->input('gl_name');
		$particular     = $request->input('particular');
		$narration      = $request->input('narration');
		$dramnt         = $request->input('dr_amount');
		$cramnt         = $request->input('cr_amount');
		$srCode         = $request->input('saleRepCode');
		$srName         = $request->input('saleResName');
		$revCode        = $request->input('rev_code');
		$revName        = $request->input('revName');
		$createdBy      = $request->session()->get('userid');
		$compName       = $request->session()->get('company_name');
		$sCompname      = explode('-', $compName);
		$compCode       = $sCompname[0];
		$fisYear        =  $request->session()->get('macc_year');
		$pdfYesNoStatus =  $request->input('pdfYesNoStatus');
		$totlRwCount    =  $request->input('totlRwCount');
		$blankVal       =  '';
		$getcount       =  count($totlRwCount);
		$isTDSApply     =  $request->input('isTDSApply');
		$tdsCutAmt      =  $request->input('tdsCutAmt');
		$tdsNetAmt      =  $request->input('netAmnt');
		$tdsGlCode      =  $request->input('GettdsCode');
		$tdsGlName      =  $request->input('GettdsName');
		$tdsCodeByAc    =  $request->input('tdsCodeByAc');
		$tdsRateH       =  $request->input('tdsRateH');
		$tdsBaseAmt     =  $request->input('tdsBaseAmt');
		$AmntBlank		=  '0.00';
		
		if($vrno == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrno;
		}

		$vrno_Exist = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$seriescode)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$transcode)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrno_Exist[0]->LAST_NO +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {
			$drAmtTotl =0;
			for ($i=0; $i <$getcount ; $i++) { 

				$srno=$i + 1;
				
				$JVtranH = DB::select("SELECT MAX(JVID) as JVID FROM JV_TRAN");
				$headID = json_decode(json_encode($JVtranH), true); 
				if(empty($headID[0]['JVID'])){
					$head_Id = 1;
				}else{
					$head_Id = $headID[0]['JVID']+1;
				}

				if($dramnt[$i]){
					$dr_amount = $dramnt[$i];
					$drAmtTotl += $dramnt[$i];
				}else{
					$dr_amount = 0.00;
				}

				if($cramnt[$i]){
					$cr_amount = $cramnt[$i];
				}else{
					$cr_amount = 0.00;
				}
				
				$data = array(

						'JVID'             =>$head_Id,
						'COMP_CODE'        =>$compCode,
						'FY_CODE'          =>$fisYear,
						'PFCT_CODE'        =>$pfctcode,
						'PFCT_NAME'        =>$pfctname,
						'TRAN_CODE'        =>$transcode,
						'SERIES_CODE'      =>$seriescode,
						'SERIES_NAME'      =>$seriesName,
						'VRNO'             =>$NewVrno,
						'SLNO'             =>$srno,
						'VRDATE'           =>$pay_vr_date,
						'ACC_CODE'         =>$acccount[$i],
						'ACC_NAME'         =>$accname[$i],
						'GL_CODE'          =>$glCode[$i],
						'GL_NAME'          =>$glName[$i],
						'REF_CODE'         =>$revCode[$i],
						'REF_NAME'         =>$revName[$i],
						'PARTICULAR'       =>$particular[$i],
						'NARRATION'        =>$narration[$i],
						'DRAMT'            =>$dr_amount,
						'CRAMT'            =>$cr_amount,
						'SR_CODE'          =>$srCode,
						'SR_NAME'          =>$srName,
						'COST_CODE'        =>$cost_code[$i],
						'COST_NAME'        =>$cost_name[$i],
						'TDS_CODE'         =>$tdsCodeByAc[$i],
						'TDS_RATE'         =>$tdsRateH[$i],
						'BASE_AMT'         =>$tdsBaseAmt[$i],
						'TDS_AMT'          =>$tdsCutAmt[$i],
						'TDS_APPLY_STATUS' =>$isTDSApply[$i],
						'CREATED_BY'       =>$createdBy,
					);
				$saveDataJV = DB::table('JV_TRAN')->insert($data);
				
				if($acccount[$i]){

					$this->AccountTEntry($compCode,$fisYear,$transcode,$seriescode,$NewVrno,$srno,$pay_vr_date,$pfctcode,$acccount[$i],$accname[$i],$revCode[$i],$revName[$i],$blankVal,$blankVal,$blankVal,$blankVal,$dr_amount,$cr_amount,$particular[$i],$narration[$i],$createdBy);

				}

				if($glCode[$i]){

					$this->GlTEntry($compCode,$fisYear,$transcode,$seriescode,$NewVrno,$srno,$pay_vr_date,$pfctcode,$glCode[$i],$glName[$i],$revCode[$i],$revName[$i],$acccount[$i],$accname[$i],$blankVal,$blankVal,$blankVal,$blankVal,$dr_amount,$cr_amount,$particular[$i],$narration[$i],$createdBy);

				}

				if(($isTDSApply[$i] == 1) || ($isTDSApply[$i] == '1')){

					$tdstranH = DB::select("SELECT MAX(TDSTRANID) as TDSTRANID FROM TDS_TRAN");
					$tds_headID = json_decode(json_encode($tdstranH), true); 
						
					if(empty($tds_headID[0]['TDSTRANID'])){
						$tds_head_Id = 1;
					}else{
						$tds_head_Id = $tds_headID[0]['TDSTRANID']+1;
					}
									
					$this->InsertInTdsTranNewWhenJV($tds_head_Id,$compCode,$fisYear,$pfctcode,$pfctname,$transcode,$seriescode,$NewVrno,$srno,'',$pay_vr_date,$tdsGlCode[$i],$tdsGlName[$i],$acccount[$i],$accname[$i],$particular[$i],$dr_amount,$cr_amount,'','','','',$cost_code[$i],$tdsCodeByAc[$i],$tdsRateH[$i],$tdsBaseAmt[$i],$tdsCutAmt[$i],$createdBy);

					$this->AccountTEntry($compCode,$fisYear,$transcode,$seriescode,$NewVrno,$srno,$pay_vr_date,$pfctcode,$acccount[$i],$accname[$i],$revCode[$i],$revName[$i],$blankVal,$blankVal,$blankVal,$blankVal,$tdsCutAmt[$i],$AmntBlank,$particular[$i],$narration[$i],$createdBy);

					$this->GlTEntry($compCode,$fisYear,$transcode,$seriescode,$NewVrno,'3',$pay_vr_date,$pfctcode,$glCode[$i],$glName[$i],$tdsGlCode[$i],$tdsGlName[$i],$acccount[$i],$accname[$i],$blankVal,$blankVal,$blankVal,$blankVal,$tdsCutAmt[$i],$AmntBlank,$particular[$i],$narration[$i],$createdBy);

					$this->GlTEntry($compCode,$fisYear,$transcode,$seriescode,$NewVrno,'4',$pay_vr_date,$pfctcode,$tdsGlCode[$i],$tdsGlName[$i],$acccount[$i],$accname[$i],'','',$blankVal,$blankVal,$blankVal,$blankVal,$AmntBlank,$tdsCutAmt[$i],$particular[$i],$narration[$i],$createdBy);
				}


			}  /* ./ main for loop */

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriescode)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->get()->toArray();

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$compCode,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$transcode,
					'SERIES_CODE' =>$seriescode,
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriescode)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->update($datavrn);
			}
			DB::commit();
			if($pdfYesNoStatus == 1){
				return $this->GeneratePdfForJournal($compCode,$fisYear,$seriescode,$NewVrno,$transcode,$drAmtTotl);
			}
			$data1['response'] = 'success';
			$getalldata = json_encode($data1);  
			print_r($getalldata);

		   }catch (\Exception $e) {

			DB::rollBack();
			//throw $e;
			$data1['response'] = 'error';
			$getalldata = json_encode($data1);  
			print_r($getalldata);
		}
	}

	public function journal_tran_msg(Request $request,$saveData){

		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/Transaction/Account/View-Journal-Trans');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/Transaction/Account/View-Journal-Trans');

		}
	}

	public function DownLoadPDFOnViewPageJV(Request $request){

		$response_array = array();

		$compCd  = $request->input('compCd');
		$fyCd  = $request->input('fyCd');
		$tranCd  = $request->input('tranCd');
		$seriesCd  = $request->input('seriesCd');
		$vrno  = $request->input('vrno');
		$totlAmt=2400;

		$getTotAmt = DB::select("SELECT SUM(DRAMT) as totalAmt FROM JV_TRAN WHERE COMP_CODE='$compCd' AND FY_CODE='$fyCd' AND TRAN_CODE='$tranCd' AND SERIES_CODE='$seriesCd' AND VRNO='$vrno' ");
		
		$total_Amt = $getTotAmt[0]->totalAmt;

		$this->GeneratePdfForJournal($compCd,$fyCd,$seriesCd,$vrno,$tranCd,$total_Amt);
	}

	public function ViewJournalTrans(Request $request){

		$company_name = $request->session()->get('company_name');
		$spliName     = explode('-',$company_name);
		$compCode     = $spliName[0];

		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$transCode    = 'A2';

		if ($request->ajax()) {

			if (!empty($request->accCode || $request->seriesCode || $request->to_date)) {

				$party      = $request->accCode;
				$seriesCode = $request->seriesCode;
				$to_date    = $request->to_date;
				$todate     = date("Y-m-d", strtotime($to_date));
				
				$fromdate   = $request->fromdate;
				$from_date  = date("Y-m-d", strtotime($fromdate));
				
				$strWhere='';

				if(isset($party)  && trim($party)!="")
				{
					$strWhere .="AND JV_TRAN.ACC_CODE= '$party'";
				}

				if(isset($seriesCode)  && trim($seriesCode)!="")
				{
					$strWhere .="AND JV_TRAN.SERIES_CODE= '$seriesCode'";
				}

				if(isset($to_date)  && trim($to_date)!="")
				{
					$strWhere .="AND JV_TRAN.VRDATE BETWEEN '$from_date' AND  '$todate'";
				}

				$data = DB::select("SELECT * FROM JV_TRAN  WHERE 1=1 $strWhere AND COMP_CODE='$compCode' AND FY_CODE='$macc_year' ORDER BY VRDATE,VRNO,SLNO DESC");

				return DataTables()->of($data)->addIndexColumn()->make(true);

				/*return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="'.url('/Transaction/Account/Edit-Journal-Trans/'.base64_encode($data->JVID).'/'.base64_encode($data->VRNO)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#journalDelete" class="btn btn-danger btn-xs" onclick="return deleteJournalT('.$data->VRNO.')"><i class="fa fa-trash" title="delete"></i></button>';
					
					return $btn;
				})->make(true);*/

			}else{

				$data = DB::select("SELECT * FROM JV_TRAN  WHERE COMP_CODE='$compCode' AND FY_CODE='$macc_year' ORDER BY VRDATE,VRNO,SLNO DESC ");

				/*return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="'.url('/Transaction/Account/Edit-Journal-Trans/'.base64_encode($data->JVID).'/'.base64_encode($data->VRNO)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#journalDelete" class="btn btn-danger btn-xs" onclick="return deleteJournalT('.$data->VRNO.')"><i class="fa fa-trash" title="delete"></i></button>';
					
					return $btn;
				})->make(true);*/

				return DataTables()->of($data)->addIndexColumn()->make(true);
			}
		}

		$title        = 'View Journal Transaction';

		$acc_list     = DB::table('MASTER_ACC')->get();

		$getCommonData = MyCommonFun($transCode,$compCode,$macc_year);

		$userdata['series_list']  = $getCommonData['getseries'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		if(isset($company_name)){
			return view('admin.finance.transaction.account.view_journal_transaction',$userdata+compact('title','acc_list'));
		}else{
			return redirect('/useractivity');
		}
		
	}

	public function InsertInTdsTranNewWhenJV($tdsHeadId,$compCode,$fyCode,$pfctCode,$pfctName,$tranCode,$seriesCode,$vrNo,$slNo,$vrType,$vrDate,$glCode,$glName,$accCode,$accName,$perticular,$tdsCutDr,$tdsCutCr,$insType,$instTypeName,$chqNo,$chqDate,$costCCode,$tdsCodeOfAcc,$tdsRate,$tdsbaseAmt,$tdsAmt,$loginUser)
	{

		$dataTds = array(
			'TDSTRANID'   => $tdsHeadId,
			'COMP_CODE'   => $compCode,
			'FY_CODE'     => $fyCode,
			'PFCT_CODE'   => $pfctCode,
			'PFCT_NAME'   => $pfctName,
			'TRAN_CODE'   => $tranCode,
			'SERIES_CODE' => $seriesCode,
			'VRNO'        => $vrNo,
			'SLNO'        => $slNo,
			'VRTYPE'      => $vrType,
			'VRDATE'      => $vrDate,
			'GL_CODE'     => $glCode,
			'GL_NAME'     => $glName,
			'ACC_CODE'    => $accCode,
			'ACC_NAME'    => $accName,
			'PARTICULAR'  => $perticular,
			'DRAMT'       => $tdsCutDr,
			'CRAMT'       => $tdsCutCr,
			'INST_TYPE'   => $insType,
			'INST_TYPE_NAME' => $instTypeName,
			'INST_NO'     => $chqNo,
			'INST_DATE'   => $chqDate,
			'COST_CODE'   => $costCCode,
			'TDS_CODE'    => $tdsCodeOfAcc,
			'TDS_RATE'    => $tdsRate,
			'BASE_AMT'    => $tdsbaseAmt,
			'TDS_AMT'     => $tdsAmt,
			'CREATED_BY'  => $loginUser,
		);

		DB::table('TDS_TRAN')->insert($dataTds);
	}

	public function EditJournalTrans($compCd,$fyCd,$tranCd,$seriesCd,$vrno){

		$title     = 'Edit Journal Transaction';
		$comp_cd   = base64_decode($compCd);
		$fy_cd     = base64_decode($fyCd);
		$tran_cd   = base64_decode($tranCd);
		$series_cd = base64_decode($seriesCd);
		$vr_no     = base64_decode($vrno);

		if(($comp_cd!='') && ($fy_cd!='') && ($tran_cd!='') && ($series_cd!='') && ($vr_no!='')){

			/*$query = DB::table('JV_TRAN');
			$query->where('COMP_CODE', $comp_cd);
			$query->where('FY_CODE', $fy_cd);
			$query->where('TRAN_CODE', $tran_cd);
			$query->where('SERIES_CODE', $series_cd);
			$query->where('VRNO', $vr_no);
			$userdata['journal_list']= $query->get();*/

			/*$userdata['journal_list'] = DB::select("SELECT J.*,T.GL_CODE AS TDS_GLCODE,T.GL_NAME AS TDS_GLNAME FROM JV_TRAN J,TDS_TRAN T WHERE J.COMP_CODE='$comp_cd' AND J.FY_CODE='$fy_cd' AND J.TRAN_CODE='$tran_cd' AND J.SERIES_CODE='$series_cd' AND J.VRNO='$vr_no' AND T.COMP_CODE=J.COMP_CODE AND T.FY_CODE=J.FY_CODE AND T.TRAN_CODE=J.TRAN_CODE AND T.SERIES_CODE=J.SERIES_CODE AND T.VRNO=J.VRNO");*/

			$userdata['journal_list'] = DB::select("SELECT t1.*,t2.GL_CODE AS TDS_GLCODE,t2.GL_NAME AS TDS_GLNAME
									FROM JV_TRAN t1
									LEFT JOIN TDS_TRAN t2
									ON t1.COMP_CODE=t2.COMP_CODE AND t1.FY_CODE=t2.FY_CODE AND t1.SERIES_CODE=t2.SERIES_CODE AND t1.VRNO=t2.VRNO AND t1.TRAN_CODE=t2.TRAN_CODE AND t1.SLNO=t2.SLNO 
									WHERE t1.COMP_CODE='$comp_cd' AND t1.FY_CODE='$fy_cd' AND t1.SERIES_CODE='$series_cd' AND t1.TRAN_CODE='$tran_cd' AND t1.VRNO='$vr_no'");
			/*echo '<pre>';
			print_r($userdata['journal_list']);exit();
			echo '</pre>';*/
			$ConstructData = MyConstruct();

			$userdata['glkey_list']    = $ConstructData['master_glkey'];
			$userdata['account_list']  = $ConstructData['master_party'];
			$userdata['cost_list']     = $ConstructData['master_cost'];
			$userdata['sale_rep_list'] = $ConstructData['sale_rep_code'];
			$userdata['gl_list']       = $ConstructData['master_gl'];

			$getCommonData = MyCommonFun($tran_cd,$comp_cd,$fy_cd);

			$userdata['series_list'] = $getCommonData['getseries'];
			$userdata['remark_list'] = $getCommonData['remark_data'];
			$userdata['pfct_list']   = $getCommonData['masterPFCT'];

			$userdata['reverseCdData'] = DB::select("SELECT S.REVCODE,S.REVNAME FROM ( SELECT ACC_CODE as REVCODE,ACC_NAME AS REVNAME FROM MASTER_ACC UNION ALL SELECT GL_CODE AS REVCODE,GL_NAME AS REVNAME FROM MASTER_GL ) S ORDER BY S.REVCODE");

			return view('admin.finance.transaction.account.edit_journal_transaction',$userdata+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Journal Not Found...!');
			return redirect('/finance/view-journal-transaction');
		}

	}

	public function UpdateJournalTrans(Request $request){

		$vrno           = $request->input('vrno');
		$transcode      = $request->input('tran_code');
		$vrdate         = $request->input('vr_date');
		$pay_vr_date    = date("Y-m-d", strtotime($vrdate));
		$pfctcode       = $request->input('pfct_code');
		$pfctname       = $request->input('pfct_name');
		$cost_code      = $request->input('cost_code');
		$cost_name      = $request->input('costC_name');
		$seriescode     = $request->input('series_Code');
		$seriesName     = $request->input('series_Name');
		$acccount       = $request->input('acc_code');
		$accname        = $request->input('acc_name');
		$glCode         = $request->input('gl_code');
		$glName         = $request->input('gl_name');
		$particular     = $request->input('particular');
		$narration      =  $request->input('narration');
		$dramnt         = $request->input('dr_amount');
		$cramnt         = $request->input('cr_amount');
		$srCode         = $request->input('saleRepCode');
		$srName         = $request->input('saleResName');
		$revCode        = $request->input('rev_code');
		$revName        = $request->input('revName');
		$createdBy      = $request->session()->get('userid');
		$compName       = $request->session()->get('company_name');
		$sCompname      = explode('-', $compName);
		$compCode       = $sCompname[0];
		$fisYear        =  $request->session()->get('macc_year');
		$pdfYesNoStatus =  $request->input('pdfYesNoStatus');
		$totlRwCount    =  $request->input('totlRwCount');

		$upCompCd       =  $request->input('upCompCd');
		$upFyCd         =  $request->input('upFyCd');
		$upTranCd       =  $request->input('upTranCd');
		$UpSeriesCd     =  $request->input('UpSeriesCd');
		$UpvrNo         =  $request->input('UpvrNo');
		$tblName        = 'JV_TRAN';
		$getcount       = count($totlRwCount);
		$blankVal       ='';

		$isTDSApply     =  $request->input('isTDSApply');
		$tdsCutAmt      =  $request->input('tdsCutAmt');
		$tdsNetAmt      =  $request->input('netAmnt');
		$tdsGlCode      =  $request->input('GettdsCode');
		$tdsGlName      =  $request->input('GettdsName');
		$tdsCodeByAc    =  $request->input('tdsCodeByAc');
		$tdsRateH       =  $request->input('tdsRateH');
		$tdsBaseAmt     =  $request->input('tdsBaseAmt');
		$AmntBlank		=  '0.00';
		//print_r($getcount);exit;
		DB::beginTransaction();

		try {

			$this->AccEntryWhenEditDelete($upCompCd,$upFyCd,$upTranCd,$UpSeriesCd,$UpvrNo,$tblName);

			$drAmtTotl =0;
			for ($i=0; $i <$getcount ; $i++) { 

				$srno=$i + 1;
				
				$JVtranH = DB::select("SELECT MAX(JVID) as JVID FROM JV_TRAN");
				$headID = json_decode(json_encode($JVtranH), true); 
				if(empty($headID[0]['JVID'])){
					$head_Id = 1;
				}else{
					$head_Id = $headID[0]['JVID']+1;
				}

				if($dramnt[$i]){
					$dr_amount = $dramnt[$i];
					$drAmtTotl += $dramnt[$i];
				}else{
					$dr_amount = 0.00;
				}

				if($cramnt[$i]){
					$cr_amount = $cramnt[$i];
				}else{
					$cr_amount = 0.00;
				}
				
				$data = array(

							'JVID'             =>$head_Id,
							'COMP_CODE'        =>$compCode,
							'FY_CODE'          =>$fisYear,
							'PFCT_CODE'        =>$pfctcode,
							'PFCT_NAME'        =>$pfctname,
							'TRAN_CODE'        =>$transcode,
							'SERIES_CODE'      =>$seriescode,
							'SERIES_NAME'      =>$seriesName,
							'VRNO'             =>$vrno,
							'SLNO'             =>$srno,
							'VRDATE'           =>$pay_vr_date,
							'ACC_CODE'         =>$acccount[$i],
							'ACC_NAME'         =>$accname[$i],
							'GL_CODE'          =>$glCode[$i],
							'GL_NAME'          =>$glName[$i],
							'REF_CODE'         =>$revCode[$i],
							'REF_NAME'         =>$revName[$i],
							'PARTICULAR'       =>$particular[$i],
							'NARRATION'        =>$narration[$i],
							'DRAMT'            =>$dr_amount,
							'CRAMT'            =>$cr_amount,
							'SR_CODE'          =>$srCode,
							'SR_NAME'          =>$srName,
							'COST_CODE'        =>$cost_code[$i],
							'COST_NAME'        =>$cost_name[$i],
							'TDS_CODE'         =>$tdsCodeByAc[$i],
							'TDS_RATE'         =>$tdsRateH[$i],
							'BASE_AMT'         =>$tdsBaseAmt[$i],
							'TDS_AMT'          =>$tdsCutAmt[$i],
							'TDS_APPLY_STATUS' =>$isTDSApply[$i],
							'CREATED_BY'       =>$createdBy,
						);
				$saveDataJV = DB::table('JV_TRAN')->insert($data);
				
				if($acccount[$i]){

					$this->AccountTEntry($compCode,$fisYear,$transcode,$seriescode,$vrno,$srno,$pay_vr_date,$pfctcode,$acccount[$i],$accname[$i],$revCode[$i],$revName[$i],$blankVal,$blankVal,$blankVal,$blankVal,$dr_amount,$cr_amount,$particular[$i],$narration[$i],$createdBy);

				}

				if($glCode[$i]){

					$this->GlTEntry($compCode,$fisYear,$transcode,$seriescode,$vrno,$srno,$pay_vr_date,$pfctcode,$glCode[$i],$glName[$i],$revCode[$i],$revName[$i],$acccount[$i],$accname[$i],$blankVal,$blankVal,$blankVal,$blankVal,$dr_amount,$cr_amount,$particular[$i],$narration[$i],$createdBy);

				}

				if(($isTDSApply[$i] == 1) || ($isTDSApply[$i] == '1')){

					$tdstranH = DB::select("SELECT MAX(TDSTRANID) as TDSTRANID FROM TDS_TRAN");
					$tds_headID = json_decode(json_encode($tdstranH), true); 
						
					if(empty($tds_headID[0]['TDSTRANID'])){
						$tds_head_Id = 1;
					}else{
						$tds_head_Id = $tds_headID[0]['TDSTRANID']+1;
					}
									
					$this->InsertInTdsTranNewWhenJV($tds_head_Id,$compCode,$fisYear,$pfctcode,$pfctname,$transcode,$seriescode,$vrno,$srno,'',$pay_vr_date,$tdsGlCode[$i],$tdsGlName[$i],$acccount[$i],$accname[$i],$particular[$i],$dr_amount,$cr_amount,'','','','',$cost_code[$i],$tdsCodeByAc[$i],$tdsRateH[$i],$tdsBaseAmt[$i],$tdsCutAmt[$i],$createdBy);

					$this->AccountTEntry($compCode,$fisYear,$transcode,$seriescode,$vrno,$srno,$pay_vr_date,$pfctcode,$acccount[$i],$accname[$i],$revCode[$i],$revName[$i],$blankVal,$blankVal,$blankVal,$blankVal,$tdsCutAmt[$i],$AmntBlank,$particular[$i],$narration[$i],$createdBy);

					$this->GlTEntry($compCode,$fisYear,$transcode,$seriescode,$vrno,'3',$pay_vr_date,$pfctcode,$glCode[$i],$glName[$i],$tdsGlCode[$i],$tdsGlName[$i],$acccount[$i],$accname[$i],$blankVal,$blankVal,$blankVal,$blankVal,$tdsCutAmt[$i],$AmntBlank,$particular[$i],$narration[$i],$createdBy);

					$this->GlTEntry($compCode,$fisYear,$transcode,$seriescode,$vrno,'4',$pay_vr_date,$pfctcode,$tdsGlCode[$i],$tdsGlName[$i],$acccount[$i],$accname[$i],'','',$blankVal,$blankVal,$blankVal,$blankVal,$AmntBlank,$tdsCutAmt[$i],$particular[$i],$narration[$i],$createdBy);
				}

			}  /* ./ main for loop */

			DB::commit();
			if($pdfYesNoStatus == 1){
				return $this->GeneratePdfForJournal($compCode,$fisYear,$seriescode,$vrno,$transcode,$drAmtTotl);
			}
			$data1['response'] = 'success';
			$getalldata = json_encode($data1);
			print_r($getalldata);

		}catch (\Exception $e) {

			DB::rollBack();
			//throw $e;
			$data1['response'] = 'error';
			$getalldata = json_encode($data1);  
			print_r($getalldata);
		}

	}

	public function DeleteJournalTrans(Request $request){

		$journalid  = $request->post('journalid');

		$splitCol   = explode('_',$journalid);
		$compCode   = $splitCol[0];
		$fyCode     = $splitCol[1];
		$tranCode   = $splitCol[2];
		$seriesCode = $splitCol[3];
		$vrNo       = $splitCol[4];
		$tblName    = 'JV_TRAN';

		DB::beginTransaction();

		try {

			$this->AccEntryWhenEditDelete($compCode,$fyCode,$tranCode,$seriesCode,$vrNo,$tblName);

			DB::commit();
			$request->session()->flash('alert-success', 'Journal Transaction Data Was Deleted Successfully...!');
			return redirect('/Transaction/Account/View-Journal-Trans');

		   }catch (\Exception $e) {

			DB::rollBack();
			//throw $e;
			$request->session()->flash('alert-error', 'Journal Transaction Data Can Not Deleted...!');
			return redirect('/Transaction/Account/View-Journal-Trans');
		}

	}

/* ----------------- START : JOURNAL TRANSACTION ---------------- */

/* -------------- START : ACCOUNT ENTRY OF TRANSACTION ------------ */

	public function GlTEntry($compCode,$fyCode,$tranCode,$seriesCode,$vrno,$slno,$vrDate,$pfctCode,$glCode,$glName,$refCode,$refName,$accCode,$accName,$costCode,$costName,$srCode,$srName,$drAmt,$crAmt,$perticular,$narration,$loginUser){

		$getdata = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('GL_CODE', $glCode)->get()->first();

		if($getdata){

			$RDRAMT = $getdata->RDRAMT;
			$RCRAMT = $getdata->RCRAMT;
			$YROPDR = $getdata->YROPDR;
			$YROPCR = $getdata->YROPCR;

			$debitAmt =  $drAmt + $RDRAMT;

			$creditAmt =  $crAmt + $RCRAMT;

			$RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);
				  
			$dataarqty = array(
				
				'RDRAMT'  => $debitAmt,
				'RCRAMT'  => $creditAmt,
				'RBAL'    => $RBAL,
		
			);

			$updateData12 = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('GL_CODE', $glCode)->update($dataarqty);

		}else{

			$rbalGl = $drAmt - $crAmt;

			$dataItmBal = array(
				'COMP_CODE' => $compCode,
				'FY_CODE'   => $fyCode,
				'PFCT_CODE' => $pfctCode,
				'GL_CODE'   => $glCode,
				'RDRAMT'    => $drAmt,
				'RCRAMT'    => $crAmt,
				'RBAL'      => $rbalGl,
			);

			DB::table('MASTER_GLBAL')->insert($dataItmBal);
		}

		$gledgH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
		$gledgID = json_decode(json_encode($gledgH), true); 
		if(empty($gledgID[0]['GLTRANID'])){
			$gledg_Id = 1;
		}else{
			$gledg_Id = $gledgID[0]['GLTRANID']+1;
		}

		$dataGl = array(
			'GLTRANID'    =>$gledg_Id,
			'COMP_CODE'   =>$compCode,
			'FY_CODE'     =>$fyCode,
			'TRAN_CODE'   =>$tranCode,
			'SERIES_CODE' =>$seriesCode,
			'VRNO'        =>$vrno,
			'SLNO'        =>$slno,
			'VRDATE'      =>$vrDate,
			'PFCT_CODE'   =>$pfctCode,
			'GL_CODE'     =>$glCode,
			'GL_NAME'     =>$glName,
			'REF_CODE'    =>$refCode,
			'REF_NAME'    =>$refName,
			'ACC_CODE'    =>$accCode,
			'ACC_NAME'    =>$accName,
			'COST_CODE'   =>$costCode,
			'COST_NAME'   =>$costName,
			'SR_NO'       =>$srCode,
			'SR_NAME'     =>$srName,
			'DRAMT'       =>$drAmt,
			'CRAMT'       =>$crAmt,
			'PARTICULAR'  =>$perticular,
			'NARRATION'   =>$narration,
			'CREATED_BY'  =>$loginUser,
		);

		DB::table('GL_TRAN')->insert($dataGl);
	}

	public function AccountTEntry($compCode,$fyCode,$tranCode,$seriesCode,$vrNo,$slno,$vrDate,$pfctCode,$accCode,$accName,$refCode,$refName,$costCode,$costName,$srCode,$srName,$drAmt,$crAmt,$percular,$narration,$loginUser){

		$getdata = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('ACC_CODE', $accCode)->get()->first();

			if($getdata){

				$RDRAMT = $getdata->RDRAMT;
				$RCRAMT = $getdata->RCRAMT;
				$YROPDR = $getdata->YROPDR;
				$YROPCR = $getdata->YROPCR;

				$debitAmt =  $drAmt + $RDRAMT;

				$creditAmt =  $crAmt + $RCRAMT;

				$RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);

				$dataarqty = array(
					
					'RDRAMT'  => $debitAmt,
					'RCRAMT'  => $creditAmt,
					'RBAL'    => $RBAL,
			
				);

				$updateData12 = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('ACC_CODE', $accCode)->update($dataarqty);

			}else{

				$rBal = $drAmt - $crAmt;

				$dataItmBal = array(
					'COMP_CODE' => $compCode,
					'FY_CODE'   => $fyCode,
					'PFCT_CODE' => $pfctCode,
					'ACC_CODE'  => $accCode,
					'RDRAMT'    => $drAmt,
					'RCRAMT'    => $crAmt,
					'RBAL'      => $rBal
				);

				DB::table('MASTER_ACCBAL')->insert($dataItmBal);
			}

			$AcledgerH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
			$AledgID = json_decode(json_encode($AcledgerH), true); 
			if(empty($AledgID[0]['ACCTRANID'])){
				$Aledg_Id = 1;
			}else{
				$Aledg_Id = $AledgID[0]['ACCTRANID']+1;
			}

			$dataAcc = array(
				'ACCTRANID'   =>$Aledg_Id,
				'COMP_CODE'   =>$compCode,
				'FY_CODE'     =>$fyCode,
				'TRAN_CODE'   =>$tranCode,
				'SERIES_CODE' =>$seriesCode,
				'VRNO'        =>$vrNo,
				'SLNO'        =>$slno,
				'VRDATE'      =>$vrDate,
				'PFCT_CODE'   =>$pfctCode,
				'ACC_CODE'    =>$accCode,
				'ACC_NAME'    =>$accName,
				'REF_CODE'    =>$refCode,
				'REF_NAME'    =>$refName,
				'COST_CODE'   =>$costCode,
				'COST_NAME'   =>$costName,
				'SR_NO'       =>$srCode,
				'SR_NAME'     =>$srName,
				'DRAMT'       =>$drAmt,
				'CRAMT'       =>$crAmt,
				'PARTICULAR'  =>$percular,
				'NARRATION'   =>$narration,
				'CREATED_BY'  =>$loginUser,
			);

			DB::table('ACC_TRAN')->insert($dataAcc);

	}
  
	public function AccEntryWhenEditDelete($compCode,$fyCode,$tranCode,$seriesCode,$vrNo,$tblName){

		if (($compCode!='') && ($fyCode!='')  && ($tranCode!='')  && ($seriesCode!='')  && ($vrNo!='')) {

			$getData = DB::table($tblName)->where('COMP_CODE', $compCode)->where('FY_CODE', $fyCode)->where('TRAN_CODE', $tranCode)->where('SERIES_CODE', $seriesCode)->where('VRNO', $vrNo)->get();

			$getCount = count($getData);

			for ($i = 0; $i <$getCount ; ++$i) {

				/* -----------START GL ENTRY --------- */

				$glCodeED  = $getData[$i]->GL_CODE;
				$accCodeED = $getData[$i]->ACC_CODE;
				$drAmtED   = $getData[$i]->DRAMT;
				$crAmtED   = $getData[$i]->CRAMT;

				$getglBal = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('GL_CODE', $glCodeED)->get()->first();

				$RDRAMT    = $getglBal->RDRAMT;
				$RCRAMT    = $getglBal->RCRAMT;
				$YROPDR    = $getglBal->YROPDR;
				$YROPCR    = $getglBal->YROPCR;

				$debitAmt  =   $RDRAMT - $drAmtED;

				$creditAmt =  $RCRAMT - $crAmtED;

				$RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);

				$dataGlED = array(
				
					'RDRAMT'  => $debitAmt,
					'RCRAMT'  => $creditAmt,
					'RBAL'    => $RBAL,
			
				);

				DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('GL_CODE', $glCodeED)->update($dataGlED);

				/* -----------END GL ENTRY --------- */

				/* -----------START ACC ENTRY --------- */
				if($accCodeED){

					$getaccBal = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('ACC_CODE', $accCodeED)->get()->first();

					if($getaccBal !=''){
			
						$RDRAMT_ED    = $getaccBal->RDRAMT;
						$RCRAMT_ED    = $getaccBal->RCRAMT;
						$YROPDR_ED    = $getaccBal->YROPDR;
						$YROPCR_ED    = $getaccBal->YROPCR;
						$debitAmt_ED  =  $RDRAMT_ED - $drAmtED;
						$creditAmt_ED =  $RCRAMT_ED - $crAmtED;

						$RBAL_ED  = floatval($YROPDR_ED - $YROPCR_ED) + floatval($debitAmt_ED - $creditAmt_ED);

						$dataAccED = array(
							'RDRAMT'  => $debitAmt_ED,
							'RCRAMT'  => $creditAmt_ED,
							'RBAL'    => $RBAL_ED,
						);

						DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('ACC_CODE', $accCodeED)->update($dataAccED);
					}

				}
				/* -----------END ACC ENTRY --------- */

				if($tblName == 'JV_TRAN'){

					if(($getData[$i]->TDS_APPLY_STATUS == 1) || ($getData[$i]->TDS_APPLY_STATUS == '1')){

						DB::table('TDS_TRAN')->where('COMP_CODE', $compCode)->where('FY_CODE', $fyCode)->where('TRAN_CODE', $tranCode)->where('SERIES_CODE', $seriesCode)->where('VRNO', $vrNo)->delete();
					}

				}

				if($tblName == 'CB_TRAN'){

					$payAdvice = $getData[$i]->PAYMENT_ADVICE;
					$slNo      = $getData[$i]->SLNO;
					$chqHeadId = $getData[$i]->CHQ_HID;
					$chqBodyId = $getData[$i]->CHQ_BID;
					$chqSlno   = $getData[$i]->CHQ_SLNO;

					if($getData[$i]->TDS_CODE != ''){
						
						DB::table('TDS_TRAN')->where('COMP_CODE', $compCode)->where('FY_CODE', $fyCode)->where('TRAN_CODE', $tranCode)->where('SERIES_CODE', $seriesCode)->where('VRNO', $vrNo)->delete();
					}

					if($payAdvice == 1){

						$payData = array(
							'PMT_COMP_CODE' => null,
							'PMT_FY_CODE' => null,
							'PMT_TRAN_CODE' => null,
							'PMT_SERIES' => null,
							'PMT_VRNO' => null,
							'PMT_SLNO' => null,
						);

						DB::table('PAYMENT_ADVICE_TRAN')->where('PMT_COMP_CODE', $compCode)->where('PMT_FY_CODE', $fyCode)->where('PMT_TRAN_CODE', $tranCode)->where('PMT_SERIES', $seriesCode)->where('PMT_VRNO', $vrNo)->where('PMT_SLNO', $slNo)->update($payData);
					}

					if($chqHeadId && $chqBodyId && $chqSlno){

						$chqData = array(
							'CHEQUEDATE' => '0000-00-00',
							'GL_CODE' => null,
							'GL_NAME' => null,
							'ACC_CODE' => null,
							'ACC_NAME' => null,
							'AMOUNT' => '0.00',
							'REMARK' => null,
						);
						DB::table('MASTER_CHEQUEBOOK_BODY')->where('CHQBHID', $chqHeadId)->where('CHQBBID', $chqBodyId)->where('SLNO', $chqSlno)->update($chqData);
					}
				}

			}/* ________ GET TOTAL ROW COUNT ________*/

			DB::table($tblName)->where('COMP_CODE', $compCode)->where('FY_CODE', $fyCode)->where('TRAN_CODE', $tranCode)->where('SERIES_CODE', $seriesCode)->where('VRNO', $vrNo)->delete();

			DB::table('GL_TRAN')->where('COMP_CODE', $compCode)->where('FY_CODE', $fyCode)->where('TRAN_CODE', $tranCode)->where('SERIES_CODE', $seriesCode)->where('VRNO', $vrNo)->delete();

			DB::table('ACC_TRAN')->where('COMP_CODE', $compCode)->where('FY_CODE', $fyCode)->where('TRAN_CODE', $tranCode)->where('SERIES_CODE', $seriesCode)->where('VRNO', $vrNo)->delete();

		}/* _____ CONDITION CHEN DATA IS EXIST ________ */

	}

/* ------------------ END : ACCOUNT ENTRY OF TRANSACTION ---------------*/

	public function get_glKeyForJournl_data(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			 $SeriesCode = $request->input('series_code');

			 $series_code_list = DB::table('glkey_master')->where('glkey_code', $SeriesCode)->get()->first();

			 $gl_data = DB::table('master_gl')->where('gl_code', $series_code_list->gl_code)->get()->first();



			// print_r($gl_data);exit();

			if ($gl_data) {

				$response_array['response'] = 'success';
				$response_array['gl_data'] = $gl_data;
				$response_array['glamttype'] = $series_code_list;

			   echo $data = json_encode($response_array);

				//print_r($data);

			}else{

				$response_array['response'] = 'error';
				$response_array['gl_data'] = '' ;
				$response_array['glamttype'] = '';

				$data = json_encode($response_array);

				print_r($data);
				
			}


		}else{

				$response_array['response'] = 'error';
				$response_array['data'] = '' ;
				$response_array['glamttype'] = '';

				$data = json_encode($response_array);

				print_r($data);
		}

	}


/* ----------- payment advice ----------- */

	public function paymentAdvice(Request $request){

		$title        ='Add Payment Advice Master';

		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =    $compcode[0];
		$macc_year   = $request->session()->get('macc_year');
		$transCode   = 'A9';

		$ConstructData = MyConstruct();

		//$userdata['pfct_list'] = $ConstructData['master_pfct'];
		$userdata['acc_list']  = $ConstructData['master_party'];
	   
		$getCommonData = MyCommonFun($transCode,$getcompcode,$macc_year);

		$userdata['series_list'] = $getCommonData['getseries'];
		$userdata['pfct_list'] = $getCommonData['masterPFCT'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$transMast = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$transCode)->get();
		$userdata['trans_head'] =$transMast[0]->TRAN_CODE;

		return view('admin.finance.transaction.account.payment_advice',$userdata+compact('title'));
	} 


	public function GetDataByAccCodeForPayAd(Request $request){

		$response_array = array();

		$accCode = $request->input('accCode');
		//print_r($itemGet);exit();
		
		if ($request->ajax()) {

		

			$acc_code_get = DB::SELECT("SELECT t1.*,t2.PAYID as pdid ,t2.REF_TRAN_CODE,t2.REF_SERIES,t2.REF_VRNO,t2.PMT_TRAN_CODE,t2.PMT_SERIES,t2.PMT_VRNO,t2.PMT_SLNO,t2.ADVICE_AMT,SUM(CASE WHEN PMT_TRAN_CODE Is NULL THEN t2.ADVICE_AMT END) as pendingAmt,SUM(CASE WHEN PMT_TRAN_CODE!='' THEN t2.ADVICE_AMT END) as paidAmt FROM PORDER_HEAD t1 LEFT JOIN PAYMENT_ADVICE_TRAN t2 ON t2.ACC_CODE = t1.ACC_CODE AND t2.REF_VRNO=t1.VRNO AND t2.REF_TRAN_CODE=t1.TRAN_CODE AND t2.REF_SERIES=t1.SERIES_CODE WHERE t1.ACC_CODE='$accCode' GROUP BY t1.PORDERHID");


			/*$count = count($acc_code_get);
			print_r($count);exit;*/
	
			if ($acc_code_get) {

				$response_array['response'] = 'success';
				$response_array['data'] = $acc_code_get;
			   // $response_array['data_1'] = $pay_Advice_trans;

				$data = json_encode($response_array);

				print_r($data);

			}else{

				$response_array['response'] = 'error';
				$response_array['data'] = '' ;
			   // $response_array['data_1'] = '' ;

				$data = json_encode($response_array);

				print_r($data);
				
			}

		}else{

				$response_array['response'] = 'error';
				$response_array['data'] = '' ;
				$response_array['data_1'] = '' ;

				$data = json_encode($response_array);

				print_r($data);
		}

	}


		


/*payment advice*/

   

	public function SavePaymentAdvicePayOrder(Request $request){

		
		$paymentid   = $request->paymentid;
		$refvrno     = $request->refvrno;
		
		$trans_code  = $request->trans_code;
		$series_code = $request->series_code;
		$series_name = $request->series_name;
		$pfct_code   = $request->pfct_code;
		$pfct_name   = $request->pfct_name;
		$series_name = $request->series_name;
		$vrseq_num   = $request->vrseq_num;
		$vr_date     = $request->vr_date;
		$pay_vr_date = date("Y-m-d", strtotime($vr_date));
		$slnum       = $request->slnum;
		$acc_code    = $request->acc_code;
		$acc_name    = $request->acc_name;
		$reftrans    = $request->reftrans;
		$refseris    = $request->refseris;
		
		$adviceamt   = $request->adviceamt;
		
		$tdsamt      = $request->tdsamt;
		$netpay      = $request->netpay;
		$remarkDes   = $request->remarkDes;
		
		$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$explodeCn   = explode('-', $compName);
		
		$getcom_code = $explodeCn[0];
		
		$fisYear     =  $request->session()->get('macc_year');

			
		if($vrseq_num == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrseq_num;
		}

		$vrno_Exist = DB::table('PAYMENT_ADVICE_TRAN')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->where('VRNO',$vrNum)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrNum +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try { 

			$srNum = 1;
			foreach($request->refvrno as $key => $value){
				
				$PAdv = DB::select("SELECT MAX(PAYID) as PAYID FROM PAYMENT_ADVICE_TRAN");
				$headID = json_decode(json_encode($PAdv), true); 

				if(empty($headID[0]['PAYID'])){
					$head_Id = 1;
					
				}else{
					$head_Id = $headID[0]['PAYID']+1;
				}

				if(in_array($request->refvrno[$key], $paymentid)){

					$data=array(
					
						"PAYID"         => $head_Id,
						"COMP_CODE"     => $getcom_code,
						"FY_CODE"       => $fisYear,
						"TRAN_CODE"     => $trans_code,
						"SERIES_CODE"   => $series_code,
						"SERIES_NAME"   => $series_name,
						"PFCT_CODE"     => $pfct_code,
						"PFCT_NAME"     => $pfct_name,
						"VRNO"          => $NewVrno,
						"VRDATE"        => $pay_vr_date,
						"SLNO"          => $srNum,
						"ACC_CODE"      => $acc_code,
						"ACC_NAME"      => $acc_name,
						"REF_TRAN_CODE" => $reftrans[$key],
						"REF_SERIES"    => $refseris[$key],
						"REF_VRNO"      => $refvrno[$key],
						"ADVICE_AMT"    => $adviceamt[$key],
						"TDS_AMT"       => $tdsamt[$key],
						"NET_AMT"       => $netpay[$key],
						"REMARK"        => $remarkDes[$key],
						"CREATED_BY"    => $createdBy,

					);
			   
				$saveData = DB::table('PAYMENT_ADVICE_TRAN')->insert($data);

				 }
  
			$srNum++;}

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->get()->toArray();

			if(empty($checkvrnoExist)){
				$datavrnIn =array(
					'COMP_CODE'   =>$getcom_code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->update($datavrn);
			}


			DB::commit();
			$response_array['response'] = 'success';
			//$response_array['lastid'] = $headID;
			$data = json_encode($response_array);
			print_r($data);

		}catch (\Exception $e) {

			DB::rollBack();
			throw $e;
			$response_array['response'] = 'error';
			$data = json_encode($response_array);
			print_r($data);
		}
		
	}


	public function SavePaymentAdvicePayOrder1(Request $request){

				$paymentid = $request->paymentid;
				$vrdate    = $request->vrdate;
				$vrno      = $request->vrno;
				$cr_amt    = $request->cr_amt;
				$adpaydone = $request->adpaydone;
				$adpaypend = $request->adpaypend;
				$balnc     = $request->balnc;
				$adviceamt = $request->adviceamt;
				$tdsamt    = $request->tdsamt;


		$createdBy 	= $request->session()->get('userid');

		$compName 	= $request->session()->get('company_name');

		$fisYear 	=  $request->session()->get('macc_year');

			  $count = count($paymentid);

		 $saveData ='';
		for ($i=0; $i < $count ; $i++) { 

			$data=array(
				
				
				"vr_date"        =>$vrdate[$i],
				"vr_no"          =>$vrno[$i],
				"order_amt"      =>$cr_amt[$i],
				"advice_done"     =>$adpaydone[$i],
				"advice_pedding" =>$adpaypend[$i],
				"balnce_amt"     =>$balnc[$i],
				"advice_amt"     =>$adviceamt[$i],
				"tds_amt"        =>$tdsamt[$i],
				//"created_by"     => $createdBy[$i],

				);
			
		$saveData = DB::table('payment_advice_trans')->insert($data);

			
		}
	
		if ($saveData) {

				$response_array['response'] = 'success';
				//$response_array['data'] = $item_um_aum_list ;

				$data = json_encode($response_array);

				print_r($data);

			} else {

				$response_array['response'] = 'error';
			   // $response_array['data'] = '' ;

				$data = json_encode($response_array);

				print_r($data);

			}  




			

	}

	public function GetAdvicByAccCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$accCode = $request->input('acc_code');
		
			//DB::enableQueryLog();
			$fetch_reocrd = DB::table('PAYMENT_ADVICE_TRAN')->where('ACC_CODE',$accCode)->where('PMT_TRAN_CODE',NULL)->where('PMT_VRNO',NULL)->where('PMT_SERIES',NULL)->get();
			//dd(DB::getQueryLog());
		
			if ($fetch_reocrd!='') {

				//echo "<PRE>";
			//print_r($fetch_tds_rate);
			//echo "</PRE>";

				$response_array['response'] = 'success';
				$response_array['data'] = $fetch_reocrd ;

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
				$response_array['data'] = '';

				$data = json_encode($response_array);

				print_r($data);
		}


	}

 

	public function ViewPaymentAdvice(Request $request){

		
		if ($request->ajax()) {

			if (!empty($request->accCode || $request->BankCode)) {

				$party  = $request->accCode;
				$bankcode  = $request->BankCode;

				$company_name 	= $request->session()->get('company_name');
				$splitComp = explode('-', $company_name);
				$compCode = $splitComp[0];
				$macc_year 		= $request->session()->get('macc_year');

				$usertype 	= $request->session()->get('user_type');

				

				// $data = DB::select("SELECT * FROM `PAYMENT_ADVICE_TRAN` WHERE 1=1 GROUP BY VRNO");
				

				$data = DB::table('PAYMENT_ADVICE_TRAN')->where('FY_CODE', $macc_year)->where('COMP_CODE', $compCode)->get();


				//print_r($data);exit;

				return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="'.url('/finance/edit-journal-transaction/'.base64_encode($data->PAYID).'/'.base64_encode($data->VRNO)).'" class="btn btn-warning btn-xs" disabled><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#journalDelete" class="btn btn-danger btn-xs" onclick="return deleteJournalT('.$data->PAYID.')" disabled><i class="fa fa-trash" title="delete"></i></button>';
					
					return $btn;
				})->make(true);

			}else{

				$company_name 	= $request->session()->get('company_name');

				$macc_year 		= $request->session()->get('macc_year');

				$usertype 	= $request->session()->get('user_type');
				

				$comp_code = explode('-', $company_name);
				//$comp_code = substr($company_name,0,4);

				$getdate = DB::table('MASTER_FY')->where([
				['COMP_CODE', '=', $comp_code[0]],
				['FY_CODE', '=', $macc_year],
				])->first();

				$fy_from_date = $getdate->FY_FROM_DATE;
				$fy_to_date = $getdate->FY_TO_DATE;

				$Data['formDate']= $fy_from_date;
				$Data['toDate']= $fy_to_date;

				$from_date =$fy_from_date;
				$to_date =$fy_to_date;

				


				// $data = DB::select("SELECT * FROM `PAYMENT_ADVICE_TRAN` where 1=1 GROUP BY VRNO");
			   
			   $data = DB::table('PAYMENT_ADVICE_TRAN')->where('COMP_CODE',$comp_code[0])->where('FY_CODE',$macc_year)->get();

				//return DataTables()->of($data)->make(true);

				return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="JavaScript:Void(0);" class="btn btn-warning btn-xs" disabled><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#journalDelete" class="btn btn-danger btn-xs" onclick="return deleteJournalT('.$data->PAYID.')" disabled><i class="fa fa-trash" title="delete"></i></button>';
					
					return $btn;
				})->make(true);
	
			}
		}

			$company_name 	= $request->session()->get('company_name');

			$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			

			$comp_code = explode('-', $company_name);
			//DB::enableQueryLog();
			$getdate = DB::table('MASTER_FY')->where([
			['COMP_CODE', '=', $comp_code[0]],
			['FY_CODE', '=', $macc_year],
			])->first();
			//dd(DB::getQueryLog());
			$fy_from_date = $getdate->FY_FROM_DATE;
			$fy_to_date = $getdate->FY_TO_DATE;

			$Data['formDate']= $fy_from_date;
			$Data['toDate']= $fy_to_date;

			$from_date =$fy_from_date;
			$to_date =$fy_to_date;


		$title = 'View Journal Transaction';

		$bank_list        = DB::table('MASTER_BANK')->get();


		$acc_list        = DB::table('MASTER_ACC')->get();

		if(isset($company_name)){

		return view('admin.finance.transaction.account.view_payment_advice',compact('title','bank_list','acc_list'));
		}else{
		return redirect('/useractivity');
	}
		
	}

	public function payment_advice_msg(Request $request,$saveData){

	 //	print_r($savedata);exit;
	if ($saveData=='true'){

			$request->session()->flash('alert-success', 'Payment Advice Was Successfully Added...!');
			return redirect('view-payment-advice');

		} else {

			$request->session()->flash('alert-error', 'Payment Advice Can Not Added...!');
			return redirect('view-payment-advice');

		}
}


 


public function GetByAccFromAccLegderForPayAdvice(Request $request){

		$response_array = array();

		$accCode = $request->input('accCode');
		$pmtType = $request->input('pmt_type');
		//print_r($itemGet);exit();
		
		if ($request->ajax()) {

			if($pmtType == 'Bill'){
				$acc_code_get = DB::SELECT("SELECT t1.TRAN_CODE,t1.SERIES_CODE,t1.FLAG,t1.PARTYBILLNO,t1.PARTYBILLDATE,t1.ACC_CODE,t1.CRAMT AS billamt,t2.PAYID as pdid ,t2.REF_TRAN_CODE,t2.REF_SERIES,t2.REF_VRNO,t2.PMT_TRAN_CODE,t2.PMT_SERIES,t2.PMT_VRNO,t2.PMT_SLNO,SUM(CASE WHEN PMT_TRAN_CODE!='' AND REF_TRAN_CODE='P3' THEN t2.ADVICE_AMT END) as paidAmt,SUM(CASE WHEN PMT_TRAN_CODE IS NULL AND REF_TRAN_CODE='P3' THEN t2.ADVICE_AMT END) as pendingAmt,SUM(CASE WHEN PMT_TRAN_CODE!='' AND REF_TRAN_CODE='P5' THEN t2.ADVICE_AMT END) as billpaidAmt,SUM(CASE WHEN PMT_TRAN_CODE IS NULL AND REF_TRAN_CODE='P5' THEN t2.ADVICE_AMT END) as billpendingAmt FROM PBILL_HEAD t1 LEFT JOIN PAYMENT_ADVICE_TRAN t2 ON t2.ACC_CODE =t1.ACC_CODE AND t1.FLAG=t2.REF_VRNO WHERE t1.ACC_CODE='$accCode' GROUP BY t1.PBILLHID");
			}else if($pmtType == 'Order/Contract'){

				$acc_code_get = DB::SELECT("SELECT t1.*,t2.PAYID as pdid ,t2.REF_TRAN_CODE,t2.REF_SERIES,t2.REF_VRNO,t2.PMT_TRAN_CODE,t2.PMT_SERIES,t2.PMT_VRNO,t2.PMT_SLNO,t2.ADVICE_AMT,SUM(CASE WHEN PMT_TRAN_CODE Is NULL THEN t2.ADVICE_AMT END) as pendingAmt,SUM(CASE WHEN PMT_TRAN_CODE!='' THEN t2.ADVICE_AMT END) as paidAmt FROM PORDER_HEAD t1 LEFT JOIN PAYMENT_ADVICE_TRAN t2 ON t2.ACC_CODE = t1.ACC_CODE AND t2.REF_VRNO=t1.VRNO AND t2.REF_TRAN_CODE=t1.TRAN_CODE AND t2.REF_SERIES=t1.SERIES_CODE WHERE t1.ACC_CODE='$accCode' GROUP BY t1.PORDERHID");

			}else{
				$acc_code_get = '';
			}
			
			if ($acc_code_get) {

				$response_array['response'] = 'success';
				$response_array['data'] = $acc_code_get ;


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

	public function donwloadPdfOnViewPage(Request $request){

		$response_array = array();

		$compCd   = $request->input('compCd');
		$fyCd     = $request->input('fyCd');
		$tranCd   = $request->input('tranCd');
		$seriesCd = $request->input('seriesCd');
		$vrno     = $request->input('vrno');
		$vrType   = $request->input('vrType');
		$cashPDf  = $request->input('cashPDf');

		$this->GeneratePdfForCashBnk($compCd,$fyCd,$seriesCd,$vrno,$tranCd,$vrType,$cashPDf);
	}	

public function GeneratePdfForCashBnk($compcode,$fisYear,$seriesCode,$vrno,$trnCode,$payType,$cashPDf){

		$response_array = array();
		//$data030 = DB::SELECT("SELECT * FROM CB_TRAN WHERE CBTRANID='$headId'");

		//$data030 = DB::select("SELECT t1.*,t2.SERIES_NAME FROM CB_TRAN t1 LEFT JOIN MASTER_CONFIG t2 ON t2.SERIES_CODE=t1.SERIES_CODE WHERE t1.VRNO='$vrno' AND t1.TRAN_CODE='$trnCode'");
		//$data030 = DB::select("SELECT t1.*,t2.SERIES_NAME FROM CB_TRAN t1 LEFT JOIN MASTER_CONFIG t2 ON t2.SERIES_CODE=t1.SERIES_CODE AND t2.COMP_CODE=t1.COMP_CODE WHERE t1.VRNO='$vrno' AND t1.TRAN_CODE='$trnCode'");
		$data030 = DB::select("SELECT t1.*,t2.SERIES_NAME FROM CB_TRAN t1 LEFT JOIN MASTER_CONFIG t2 ON t2.SERIES_CODE=t1.SERIES_CODE AND t2.COMP_CODE=t1.COMP_CODE AND t2.TRAN_CODE=t1.TRAN_CODE WHERE t1.VRNO='$vrno' AND t1.TRAN_CODE='$trnCode' AND t1.COMP_CODE='$compcode' AND t1.FY_CODE='$fisYear' AND t1.SERIES_CODE='$seriesCode' ");
		$totlDrAmt =0;
		foreach($data030 as $drRow){
			$totlDrAmt += $drRow->DRAMT;
		}

		$compCode = $data030[0]->COMP_CODE;
		$accCode  = $data030[0]->ACC_CODE;
		$drAmount = $data030[0]->DRAMT;
		$amtInWord = (new AccountingController)->amountInWords($drAmount);
		$totDramtInWord = (new AccountingController)->amountInWords($totlDrAmt);
		$compDetail = DB::SELECT("SELECT * FROM MASTER_COMP WHERE COMP_CODE = '$compCode'");

		if(($accCode !='') || (!empty($accCode))){
			$accDetails = DB::select("SELECT A.*,B.ADD1,B.CITY_NAME,B.DIST_NAME,B.STATE_NAME,B.PIN_CODE,B.CONTACT_NO,B.CONTACT_PERSON,B.EMAIL_ID FROM `MASTER_ACC` A,MASTER_ACCADD B WHERE A.ACC_CODE=B.ACC_CODE AND A.ACC_CODE='$accCode'");
		}else{
			$accDetails='';
		}

		$title='CASH BANK REPORT';

		header('Content-Type: application/pdf');
		
		
		if($payType == 'Payment'){

			if($cashPDf == 'PAYMENT_VOUCHER'){
				$pdf = PDF::loadView('admin.finance.transaction.account.payemnt_vouchertwoPDF',compact('data030','title','compDetail','accDetails','totDramtInWord'));
			}else if($cashPDf == 'PAYMENT_REMITTANCE'){
				$pdf = PDF::loadView('admin.finance.transaction.account.payment_voucherPDF',compact('data030','title','compDetail','accDetails','amtInWord'));
			}
			/*$pdf = PDF::loadView('admin.finance.transaction.account.payemnt_vouchertwoPDF',compact('data030','title','compDetail','accDetails'));*/
			//$pdf = PDF::loadView('admin.finance.transaction.account.payment_voucherPDF',compact('data030','title','compDetail','accDetails','amtInWord'));

		}else if($payType == 'Receipt'){

			$CrAmount = $data030[0]->CRAMT;
			$cramtInWord = (new AccountingController)->amountInWords($CrAmount);

			$pdf = PDF::loadView('admin.finance.transaction.account.cashBankPDF',compact('data030','title','compDetail','cramtInWord'));
		}
		
		
		//$pdf = PDF::loadView('admin.finance.transaction.account.payment_voucherPDF',compact('data030','title','compDetail'));
					  
		$path = public_path('dist/downloadpdf'); 
		$fileName =  time().'_CashBank.'. 'pdf' ; 
		$pdf->save($path . '/' . $fileName);
		$PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['fileName'] = $fileName;
		$response_array['data'] = $data030;
		$dataget = json_encode($response_array);
	   print_r($dataget);

		
		/*$data = json_encode($response_array);
		print_r($data);*/

		//return $response_array;
}

public function GeneratePdfForContra($vrno,$transCd){

		$response_array = array();
		//DB::enableQueryLog();
		$data030 = DB::select("SELECT t1.*,t2.SERIES_NAME FROM CB_TRAN t1 LEFT JOIN MASTER_CONFIG t2 ON t2.SERIES_CODE=t1.SERIES_CODE AND t2.COMP_CODE=t1.COMP_CODE AND t2.TRAN_CODE=t1.TRAN_CODE WHERE t1.VRNO='$vrno' AND t1.TRAN_CODE='$transCd'");
		//dd(DB::getQueryLog());
		$compCode   = $data030[0]->COMP_CODE;
		$compDetail = DB::SELECT("SELECT * FROM MASTER_COMP WHERE COMP_CODE = '$compCode'");

		$title='CASH BANK REPORT';

		header('Content-Type: application/pdf');
	 
		$pdf = PDF::loadView('admin.finance.transaction.account.contraPDF',compact('data030','title','compDetail'));

		$path = public_path('dist/downloadpdf'); 
		$fileName =  time().'Contra.'. 'pdf' ; 
		$pdf->save($path . '/' . $fileName);
		$PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['fileName'] = $fileName;
		$response_array['data'] = $data030;
		echo $data = json_encode($response_array);

}
	
	public function GeneratePdfForJournal($compCode,$fisYear,$seriescode,$vrno,$transCd,$totlAmount){

		$response_array = array();
		
		$data030 = DB::select("SELECT t1.*,t2.SERIES_NAME,t3.ACC_NAME FROM JV_TRAN t1 LEFT JOIN MASTER_CONFIG t2 ON t2.SERIES_CODE=t1.SERIES_CODE AND t2.COMP_CODE=t1.COMP_CODE AND t2.TRAN_CODE=t1.TRAN_CODE LEFT JOIN MASTER_ACC t3 ON t3.ACC_CODE=t1.ACC_CODE WHERE t1.COMP_CODE='$compCode' AND t1.FY_CODE='$fisYear' AND t1.SERIES_CODE='$seriescode' AND t1.VRNO='$vrno' AND t1.TRAN_CODE='$transCd'");
		
		$compCode   = $data030[0]->COMP_CODE;
		$compDetail = DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$compCode'");

		$title='JOURNAL REPORT';

		$amtInWord = (new AccountingController)->amountInWords($totlAmount);
		
		$this->ConvertAmountIntoWordForJv($totlAmount,$compDetail,$data030,$title,$amtInWord);

	}

	public function ConvertAmountIntoWordForJv($totlAmount,$compDetail,$data030,$title,$amtInWord){

		$response_array = array();

		$num = str_replace(array(',', ' '), '' , trim($totlAmount));

		//print_r($num);exit;
		if(! $num) {
			return false;
		}
		$num = (int) $num;
		$words = array();
		$list1 = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven',
			'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
		);
		$list2 = array('', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety', 'Hundred');
		$list3 = array('', 'Thousand', 'Million', 'Billion', 'Trillion', 'Quadrillion', 'Quintillion', 'Sextillion', 'Septillion',
			'Octillion', 'Nonillion', 'Decillion', 'Nndecillion', 'Duodecillion', 'Tredecillion', 'Quattuordecillion',
			'Quindecillion', 'Sexdecillion', 'Septendecillion', 'Octodecillion', 'Novemdecillion', 'Vigintillion'
		);
		$num_length = strlen($num);
		$levels = (int) (($num_length + 2) / 3);
		$max_length = $levels * 3;
		$num = substr('00' . $num, -$max_length);
		$num_levels = str_split($num, 3);
		for ($i = 0; $i < count($num_levels); $i++) {
			$levels--;
			$hundreds = (int) ($num_levels[$i] / 100);
			$hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
			$tens = (int) ($num_levels[$i] % 100);
			$singles = '';
			if ( $tens < 20 ) {
				$tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
			} else {
				$tens = (int)($tens / 10);
				$tens = ' ' . $list2[$tens] . ' ';
				$singles = (int) ($num_levels[$i] % 10);
				$singles = ' ' . $list1[$singles] . ' ';
			}
			$words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
		} //end for loop
		$commas = count($words);
		if ($commas > 1) {
			$commas = $commas - 1;
		}
		//return implode(' ', $words);

		$numwords= implode(' ', $words);

		header('Content-Type: application/pdf');

		$pdf = PDF::loadView('admin.finance.transaction.account.journalPDF',compact('data030','title','compDetail','numwords','amtInWord'));

		$path = public_path('dist/downloadpdf'); 
		$fileName =  time().'Contra.'. 'pdf' ; 
		$pdf->save($path . '/' . $fileName);
		$PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['fileName'] = $fileName;
		$response_array['data'] = $data030;
		//return $response_array;
		echo $data = json_encode($response_array);

	}

/* -------------- bill track in cash bank -------------------*/
	
	public function BillTrackDetail(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$CompanyCode = $request->session()->get('company_name');
			$spliCode    = explode('-', $CompanyCode);
			$comp_code   = $spliCode[0];
			$macc_year   = $request->session()->get('macc_year');
			$acc_code    = $request->input('accCode');
			$vr_type     = $request->input('vr_type');
			
			if($vr_type == 'Payment'){
				//$trans_code  = 'P5';
				$bilTrackData = DB::select("SELECT * FROM ACC_TRAN WHERE COMP_CODE='$comp_code' AND ACC_CODE='$acc_code' AND CRAMT > CRALLOC");
			}else if($vr_type == 'Receipt'){
				//$trans_code   = 'S5';
				$bilTrackData = DB::select("SELECT * FROM ACC_TRAN WHERE COMP_CODE='$comp_code' AND ACC_CODE='$acc_code' AND DRAMT > DRALLOC");
			}

			

			if ($bilTrackData) {

				$response_array['response'] = 'success';
				$response_array['data_biltrack'] = $bilTrackData;

			   echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
				$response_array['data_biltrack'] = '';

				$data = json_encode($response_array);

				print_r($data);
				
			}


		}else{

				$response_array['response'] = 'error';
				$response_array['data_biltrack'] = '';

				$data = json_encode($response_array);

				print_r($data);
		}

	}

	public function SaveBillTrackOnCB(Request $request){

		if ($request->ajax()){

			$CompanyCode   = $request->session()->get('company_name');
			$spliCode      = explode('-', $CompanyCode);
			$comp_code     = $spliCode[0];
			$macc_year     = $request->session()->get('macc_year');
			$alocateAmt    = $request->alocateAmt;
			$accTranId     = $request->accTranId;
			$cbtransCode   = $request->cbTCd;
			$cbvrno        = $request->cbVrno;
			$cbvrDate      = $request->cbVrdate;
			$cbacc_code    = $request->cbAccCd;
			$vrType        = $request->vrType;
			$accTranVrno   = $request->accTranVrno;
			$accTranVrDate = $request->accTranVrDate;
			$perticular    = $request->cbPerticular;
			
			if($accTranId){
				$AccIDCnt    = count($accTranId);
				$saveData ='';
				for($i=0;$i<$AccIDCnt;$i++){

					if($vrType == 'Receipt'){

						$getData = DB::table('ACC_TRAN')->where('TRAN_CODE','S5')->where('ACCTRANID',$accTranId[$i])->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->get()->first();

						$olddrAlocAmt = $getData->DRALLOC;
						$newAlocAmt = $olddrAlocAmt + $alocateAmt[$i];
						$data = array(
						  'DRALLOC' =>$newAlocAmt,
						);
						$saveData = DB::table('ACC_TRAN')->where('TRAN_CODE','S5')->where('ACCTRANID',$accTranId[$i])->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->update($data);

					}else if($vrType == 'Payment'){

						$getPData = DB::table('ACC_TRAN')->where('TRAN_CODE','P5')->where('ACCTRANID',$accTranId[$i])->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->get()->first();

						$oldCrAlocAmt = $getPData->CRALLOC;
						$newAloccrAmt = $oldCrAlocAmt + $alocateAmt[$i];
						$datac = array(
						  'CRALLOC' =>$newAloccrAmt,
						);
						$savecData = DB::table('ACC_TRAN')->where('TRAN_CODE','P5')->where('ACCTRANID',$accTranId[$i])->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->update($datac);

					}

					$cbvr_Date     = date("Y-m-d", strtotime($cbvrDate[$i]));
					//print_r($cbvr_Date);exit;

					if($vrType == 'Receipt'){
					
						$drTcode    = 'S5';
						$drvrno     = $accTranVrno[$i];
						$drDate     = $accTranVrDate[$i];
						$acc_Code   = $cbacc_code[$i];
						$crtcode    = $cbtransCode[$i];
						$crvrno     = $cbvrno[$i];
						$crvrdate   = $cbvr_Date;

					}else if($vrType == 'Payment'){
						$drTcode    = $cbtransCode[$i];
						$drvrno     = $cbvrno[$i];
						$drDate     = $cbvr_Date;
						$acc_Code   = $cbacc_code[$i];
						$crtcode    = 'P5';
						$crvrno     = $accTranVrno[$i];
						$crvrdate   = $accTranVrDate[$i];
					}

					if($alocateAmt[$i] !=0){
						$billTdata = array(

							'DRTCODE'    =>$drTcode,
							'DRVRNO'     =>$drvrno,
							'DRVRNODATE' =>$drDate,
							'ACC_CODE'   =>$acc_Code,
							'ALLOC_AMT'  =>$alocateAmt[$i],
							'CRTCODE'    =>$crtcode,
							'CRVRNO'     =>$crvrno,
							'CRVRDATE'   =>$crvrdate,
							'PERTICULAR' =>$perticular[$i],
						);
						DB::table('BILL_TRACK_TRAN')->insert($billTdata);
					}

				}

				if ($saveData) {

					$data1['message'] = 'Success';
					//$data1['headid'] = $headlastid;
					//$data1['bodyid'] = $bodyLid;
					//$getalldata = json_encode($saveData);  
					print_r($data1);

				}else{

					$data1['message'] = 'Error';
					//$getalldata = json_encode($saveData);  
					print_r($data1);

				}
			} 	
		}
	}

/* -------------- bill track in cash bank -------------------*/	

/* ------------------- START USE AJAX FUNCTION -------------- */
	
	public function getGlTagFromGl(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$CompanyCode = $request->session()->get('company_name');
			$spliCode    = explode('-', $CompanyCode);
			$comp_code   = $spliCode[0];
			$macc_year   = $request->session()->get('macc_year');
			$glCode    = $request->input('glCode');
			
			$tagData = DB::select("SELECT * FROM MASTER_GL WHERE GL_CODE='$glCode'");

			if ($tagData) {

				$response_array['response'] = 'success';
				$response_array['data_tag'] = $tagData;

			   echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
				$response_array['data_tag'] = '';

				$data = json_encode($response_array);

				print_r($data);
				
			}


		}else{

				$response_array['response'] = 'error';
				$response_array['data_tag'] = '';

				$data = json_encode($response_array);

				print_r($data);
		}
	}

	public function acc_code_for_cash_bank(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$accCode = $request->input('accountcode');
		
			//DB::enableQueryLog();
			//$fetch_reocrd = DB::table('MASTER_ACC')->where('ACC_CODE',$accCode)->get();
			if($accCode){

				$fetch_reocrd = DB::select("SELECT MASTER_ACC.*,(SELECT BILL_TRACK FROM MASTER_ACCTYPE WHERE ATYPE_CODE=MASTER_ACC.ATYPE_CODE) AS BILLTRACKAPPLY FROM `MASTER_ACC` WHERE MASTER_ACC.ACC_CODE='$accCode'");
				//dd(DB::getQueryLog());
			
				$fetch_tds_rate = DB::table('MASTER_TDS_RATE')->where('TDS_CODE',$fetch_reocrd[0]->TDS_CODE)->get()->toArray();

				$glList = DB::select("SELECT G.GL_CODE,G.GL_NAME FROM MASTER_GLKEY M, MASTER_ACC A,MASTER_GL G WHERE M.ATYPE_CODE=A.ATYPE_CODE AND A.ACC_CODE='$accCode' AND G.GL_CODE = M.GL_CODE");
				$allGlList ='';
			}else{
				$fetch_reocrd ='';
				$fetch_tds_rate ='';
				$glList ='';
				$allGlList =DB::select("SELECT * FROM MASTER_GL");
			}

			if ($fetch_reocrd!='' || $fetch_tds_rate!='' || $glList!='' || $allGlList!='') {

				$response_array['response'] = 'success';
				$response_array['data']     = $fetch_reocrd;
				$response_array['data_tds'] = $fetch_tds_rate;
				$response_array['data_gl'] = $glList;
				$response_array['data_glList'] = $allGlList;

				$data = json_encode($response_array);

				print_r($data);

			}else{

				$response_array['response'] = 'error';
				$response_array['data']     = '';
				$response_array['data_tds'] = '';
				$response_array['data_gl']  = '';
				$response_array['data_glList']  = '';

				$data = json_encode($response_array);

				print_r($data);
				
			}

		}else{

				$response_array['response'] = 'error';
				$response_array['data']     = '';
				$response_array['data_tds'] = '';
				$response_array['data_gl']  = '';
				$response_array['data_glList']  = '';

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

	public function GetCashBankInfoForChequePrint(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$CompanyCode   = $request->session()->get('company_name');
			$compcode      = explode('-', $CompanyCode);
			$getcompcode   = $compcode[0];
			$macc_year     = $request->session()->get('macc_year');

			$seriesCd      = $request->input('sereisCd');
			$chequeNo      = $request->input('chequeNo');
			$chqNoColId    = $request->input('chqNoColId');
			$cheqNoList    = '';
			$chequeConfig  = '';
			$cheqNoDetails = '';

			if($seriesCd && $chequeNo){

				$SplitChqData = explode('~',$chqNoColId);
				$chqHeadId = $SplitChqData[1];
				$chqBodyId = $SplitChqData[2];
				$chqSlno  = $SplitChqData[3];

				$cheqNoDetails = DB::select("SELECT * FROM MASTER_CHEQUEBOOK_BODY WHERE COMP_CODE='$getcompcode' AND SERIES_CODE='$seriesCd' AND CHQBHID='$chqHeadId' AND CHQBBID='$chqBodyId' AND SLNO='$chqSlno' ");

			}else{

				$cheqNoList = DB::select("SELECT * FROM MASTER_CHEQUEBOOK_BODY WHERE COMP_CODE='$getcompcode' AND SERIES_CODE='$seriesCd' ");

				$chequeConfig = DB::select("SELECT * FROM MASTER_CHQLEAF_CONFIG WHERE SERIES_CODE='$seriesCd'");

			}

			if($cheqNoList !='' || $chequeConfig!='' || $cheqNoDetails!='') {

				$response_array['response']          = 'success';
				$response_array['data_chequeNoList'] = $cheqNoList;
				$response_array['data_chqLeafList'] = $chequeConfig;
				$response_array['data_chequeNoDetails'] = $cheqNoDetails;
				echo $data = json_encode($response_array);

			}else{

				$response_array['response']          = 'error';
				$response_array['data_chequeNoList'] = '' ;
				$response_array['data_chqLeafList'] = '' ;
				$response_array['data_chequeNoDetails'] = '' ;
				$data = json_encode($response_array);
				print_r($data);
		
			}

		}else{

				$response_array['response']          = 'error';
				$response_array['data_chequeNoList'] = '' ;
				$response_array['data_chqLeafList'] = '' ;
				$response_array['data_chequeNoDetails'] = '' ;
				$data = json_encode($response_array);
				print_r($data);
		}

	}

	
/* ------------------- END USE AJAX FUNCTION -------------- */

/* --------- create entry in USER_LOG when user submit any form ------*/

	function userLogInsert($loginuserId,$transCode,$seriesCode,$vrno,$perticular,$acc_code){
		
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
				'TRAN_CODE'   =>$transCode,
				'SERIES_CODE' =>$seriesCode,
				'ACC_CODE'    =>$acc_code,
				'VRNO'        =>$vrno,
				'PERTICULAR'  =>$discptn,
				'CREATED_BY'  =>$loginuserId
			);
			DB::table('USER_LOG')->insert($userLog);
		
	}

/* --------- create entry in USER_LOG when user submit any form ------*/


/* --------- create entry in USER_LOG when user submit any form ------*/

public function PdcChqTransaction(Request $request){

		$title         ='Add Pdc Cheque Transaction';

		$CompanyCode   = $request->session()->get('company_name');
		$compcode      = explode('-', $CompanyCode);
		$getcompcode   =	$compcode[0];
		$macc_year     = $request->session()->get('macc_year');
		$transCode     = 'A6';

		$ConstructData = MyConstruct();

		$userdata['pfct_list']     = $ConstructData['master_pfct'];
		$userdata['gl_list']       = $ConstructData['master_gl'];
		$userdata['acc_list']      = $ConstructData['master_party'];
		$userdata['bank_list']     = $ConstructData['master_bank'];
		$userdata['cost_list']     = $ConstructData['master_cost'];
		$userdata['sale_rep_list'] = $ConstructData['sale_rep_code'];
		
		$getCommonData = MyCommonFun($transCode,$getcompcode,$macc_year);

		$getseries   = $getCommonData['getseries'];
		$userdata['remark_list'] = $getCommonData['remark_data'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$tranListCd = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$transCode)->get();
		$userdata['trans_head'] =$tranListCd[0]->TRAN_CODE;

		if(isset($CompanyCode)){

			return view('admin.finance.transaction.account.pdcCheqTran',$userdata+compact('getseries','title'));
		}else{

			return redirect('/useractivity');
		}

	}



	public function SavePdcChequeTran(Request $request){

		//print_r($request->post());exit;

		$vrDate        = $request->input('vrDate');
		$tr_vrDate     = date('Y-m-d',strtotime($vrDate));
		$tran_code     = $request->input('tran_code');
		$seriescode    = $request->input('seriescode');
		$seriesname    = $request->input('seriesname');
		$glCode        = $request->input('glCode');
		$glName        = $request->input('glName');
		$accCode       = $request->input('accCode');
		$accName       = $request->input('accName');
		$pfctCode      = $request->input('pfctCode');
		$profitName    = $request->input('profitName');
		$chqstartDate  = $request->input('chqstartDate');
		$checkDate     = $request->input('checkDate');
		$chequeNo      = $request->input('chequeNo');
		$Amount        = $request->input('Amount');
		$checkDate     = $request->input('checkDate');
		$Nocheque      = $request->input('Nocheque');
		$vr_no         = $request->input('vr_no');
		$Particuler    = $request->input('Particuler');
		$createdBy 	   = $request->session()->get('userid');
		$compName 	   = $request->session()->get('company_name');
		$splitComp      = explode('-', $compName);
		$comp_code      = $splitComp[0];

		$fisYear 	=  $request->session()->get('macc_year');

		$count = count($chequeNo);

		
		   $datahead=array(
				
				
				"COMP_CODE"    =>$comp_code,
				"FY_CODE"      =>$fisYear,
				"VRDATE"       =>$tr_vrDate,
				"TRAN_CODE"    =>$tran_code,
				"VRNO"         =>$vr_no,
				"ACC_CODE"     =>$accCode,
				"ACC_NAME"     =>$accName,
				"GL_CODE"      =>$glCode,
				"GL_NAME"      =>$glName,
				"SERIES_CODE"  =>$seriescode,
				"SERIES_NAME"  =>$seriesname,
				"PFCT_CODE"    =>$pfctCode,
				"PFCT_NAME"    =>$profitName,
				"CHQ_TOTAL"    =>$Nocheque,
				"created_by"   => $createdBy,

				);
			
			$saveData = DB::table('PDC_CHQ_TRAN_HEAD')->insert($datahead);

			$headId =  DB::getPdo()->lastInsertId();


			for ($i=0; $i < $count ; $i++) { 

				$tr_checkDate   = date("Y-m-d", strtotime($checkDate[$i]));

				$data=array(
					
					
					"PCHQHID"      =>$headId,
					"COMP_CODE"    =>$comp_code,
					"FY_CODE"      =>$fisYear,
					"VRDATE"       =>$tr_vrDate,
					"TRAN_CODE"    =>$tran_code,
					"VRNO"         =>$vr_no,
					"ACC_CODE"     =>$accCode,
					"ACC_NAME"     =>$accName,
					"GL_CODE"      =>$glCode,
					"GL_NAME"      =>$glName,
					"SERIES_CODE"  =>$seriescode,
					"SERIES_NAME"  =>$seriesname,
					"PFCT_CODE"    =>$pfctCode,
					"PFCT_NAME"    =>$profitName,
					"CHEQUE_NO"    =>$chequeNo[$i],
					"CHEQUE_DATE"  =>$tr_checkDate,
					"CHEQUE_AMT"   =>$Amount[$i],
					"PARTICULAR"   =>$Particuler[$i],
					"CREATED_BY"   =>$createdBy,

					);
				
			$saveData1 = DB::table('PDC_CHQ_TRAN_BODY')->insert($data);

				
			}
	
		if ($saveData) {

				$response_array['response'] = 'success';
				//$response_array['data'] = $item_um_aum_list ;

				$data = json_encode($response_array);

				print_r($data);

			} else {

				$response_array['response'] = 'error';
			   // $response_array['data'] = '' ;

				$data = json_encode($response_array);

				print_r($data);

			}  
 
	}


  public function ViewPdcChqTransaction(Request $request){

		$company_name = $request->session()->get('company_name');
		$compcode     = explode('-', $company_name);
		$getcompcode  =	$compcode[0];
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');
		$transCode    = 'A6';

		if ($request->ajax()) {

			if (!empty($request->accCode || $request->BankCode || $request->toDate || $request->fromDate)) {

				$party     = $request->accCode;
				$bankcode  = $request->BankCode;
				$toDate    = $request->toDate;
				$from_Date = $request->fromDate;
				$to_date   = date("Y-m-d", strtotime($toDate));
				$frDate    = date("Y-m-d", strtotime($from_Date));
				$strWhere  = '';
				if(isset($bankcode)  && trim($bankcode)!="" && $usertype=='admin')
				{
					$strWhere.="AND PDC_CHQ_TRAN_HEAD.SERIES_CODE= '$bankcode'";

				}

				if(isset($party)  && trim($party)!="" && $usertype=='admin')
				{
					$strWhere.="AND PDC_CHQ_TRAN_HEAD.ACC_CODE= '$party'";

				}

				if(isset($to_date)  && trim($to_date)!="")
				{
					$strWhere .="AND PDC_CHQ_TRAN_HEAD.VRDATE BETWEEN '$frDate' AND  '$to_date'";
				}

					//DB::enableQueryLog();

				$data = DB::select("SELECT * FROM `PDC_CHQ_TRAN_HEAD` WHERE 1=1 $strWhere AND TRAN_CODE='$transCode' AND COMP_CODE='$getcompcode' AND FY_CODE='$macc_year'");

			//dd(DB::getQueryLog());

				return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="JavaScript:Void(0);"  class="btn btn-warning btn-xs" style="font-size: 10px;padding: 0px 2px;" disabled><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#cashBankDelete" style="font-size: 10px;padding: 0px 2px;" class="btn btn-danger btn-xs" onclick="return deleteCashBank()" disabled><i class="fa fa-trash" title="delete"></i></button>';
					
					return $btn;
				})->make(true);

			}else{

		//	DB::enableQueryLog();


				$data = DB::select("SELECT * FROM `PDC_CHQ_TRAN_HEAD` where 1=1 AND TRAN_CODE='$transCode' AND COMP_CODE='$getcompcode' AND FY_CODE='$macc_year'");

			//dd(DB::getQueryLog());

				return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="JavaScript:Void(0);" style="font-size: 10px;padding: 0px 2px;" class="btn btn-warning btn-xs" disabled><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#cashBankDelete" style="font-size: 10px;padding: 0px 2px;" class="btn btn-danger btn-xs" onclick="return deleteCashBank()" disabled><i class="fa fa-trash" title="delete"></i></button>';
					
					return $btn;
				})->make(true);
	
			}
		}


		$title = 'View Pdc Cheque Transaction';

		$acc_list        = DB::table('MASTER_ACC')->get();

		$getCommonData = MyCommonFun($transCode,$getcompcode,$macc_year);

		$userdata['series_list']  = $getCommonData['getseries'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		if(isset($company_name)){

			return view('admin.finance.transaction.account.view_pdc_cheque_tran',$userdata+compact('title','acc_list'));
		}else{
			return redirect('/useractivity');
		}
	}




public function AddBgTran(Request $request)
	{
		//print_r($this->data);exit;
		$title                      ='Bank Gurrantee Transaction';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		//print_r($compcode);exit;
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'A7'])->where(['COMP_CODE'=>$getcompcode])->get();
		
		$userdata['tax_code_list']  = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
		$userdata['dept_list']      = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']     = DB::table('MASTER_PLANT')->where('COMP_CODE',$getcompcode)->get();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['gl_list']        = DB::table('MASTER_HOUSEBANK')->get();
		$userdata['bgtype_list']    = DB::table('MASTER_BGTYPE')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->get();
		
	//	$userdata['acc_list'] = DB::table('PORDER_HEAD')->groupBY('ACC_CODE')->get();
		$userdata['acc_list'] = DB::table('MASTER_ACC')->groupBY('ACC_CODE')->get();

		$userdata['sr_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','SR')->get();

		$userdata['cp_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->get();
			//print_r($userdata['acc_list']);exit;
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

		//$userdata['truck_list']      = DB::table('TRIP_HEAD')->where('GATE_STATUS','0')->get();

		$userdata['planing_list']      = DB::table('TRIP_HEAD')->where('GATE_IN_STATUS','0')->where('OWNER','!=','DUMP')->get();

		$userdata['item_list']      = DB::table('MASTER_ITEM')->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		

		$requistion = DB::table('VEHICLE_GATE_INWARD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();
		//print_r($requistion);exit;

			$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		   $tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','A7')->get();
		   	if($tranHeadL){

			  $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
		   	}else{
		   		$userdata['trans_head'] = '';
		   	}
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='A7'");
			//print_r($vr_No_list);exit;
		//dd(DB::getQueryLog());
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userdata['last_num']   = $key->LAST_NO;
					$userdata['to_num']     = $key->TO_NO;
					//$userdata['trans_head'] = $key->TRAN_CODE;
				}

			}else{

					$userdata['last_num']  ='';
					$userdata['to_num']  ='';
					//$userdata['trans_head']  ='';

			}



		if(isset($CompanyCode)){

			return view('admin.finance.transaction.account.bank_guarantee_tran',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
	   

	}



	public function SaveBankGurnteeTran(Request $request){

		/*echo '<pre>';

		print_r($request->post());exit;

		echo '</pre>';*/

		$validate = $this->validate($request, [
				
				'upload_document' => 'required',
				'cp_code' => 'required',
				'cp_name' => 'required',
				'bg_number' => 'required|unique:BG_TRAN,BG_NO',
				'bg_date' => 'required',
				'amount'  => 'required',
				'gl_code' => 'required',
				'gl_name' => 'required',
		]);


		$vr_date       = $request->input('vr_date');
		$tr_vrDate     = date('Y-m-d',strtotime($vr_date));
		$trans_code    = $request->input('trans_code');
		$series_code   = $request->input('series_code');
		$series_name   = $request->input('series_name');
		$accCode       = $request->input('acc_code');
		$accName       = $request->input('acc_name');
		$gl_code       = $request->input('gl_code');
		$gl_name       = $request->input('gl_name');
		$bg_type_code  = $request->input('bg_type');
		$bg_type_name  = $request->input('bg_type_name');
		$plant_code    = $request->input('plant_code');
		$plant_name    = $request->input('plant_name');
		$pfctCode      = $request->input('pfct_code');
		$profitName    = $request->input('pfct_name');
		$tenure        = $request->input('tenure');
		$maturity_date = $request->input('maturity_date');
		$gp_days       = $request->input('gp_days');
		$Amount        = $request->input('amount');
		$particuler    = $request->input('particuler');
		$sr_code       = $request->input('sr_code');
		$sr_name       = $request->input('sr_name');
		$cp_code       = $request->input('cp_code');
		$cp_name       = $request->input('cp_name');
		$margin_money  = $request->input('margin_money');
		$vr_no         = $request->input('vr_no');
		$mmrefgl_code  = $request->input('mmrefgl_code');
		$mmrefgl_name  = $request->input('mmrefgl_name');
		$termscondition  = $request->input('termscondition');
		$gl_tran_id    = $request->input('gl_tran_id');
		$bg_number    = $request->input('bg_number');
		$bg_date      = $request->input('bg_date');
		$bg_date      = $request->input('bg_date');
		$bgdate        = date('Y-m-d',strtotime($bg_date));
		$upload_document = $request->upload_document;

		$createdBy 	   = $request->session()->get('userid');
		$compName 	   = $request->session()->get('company_name');
		$splitComp      = explode('-', $compName);
		$comp_code      = $splitComp[0];
		$comp_name     = $splitComp[1];

		$fisYear 	=  $request->session()->get('macc_year');

		$image      = Image::make($upload_document);

		Response::make($image->encode('jpeg'));


		  if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('BG_TRAN')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}
	

		 
		   $datahead=array(
				
				"COMP_CODE"    =>$comp_code,
				"COMP_NAME"    =>$comp_name,
				"FY_CODE"      =>$fisYear,
				"VRDATE"       =>$tr_vrDate,
				"TRAN_CODE"    =>$trans_code,
				"VRNO"         =>$NewVrno,
				"ACC_CODE"     =>$accCode,
				"ACC_NAME"     =>$accName,
				"GL_CODE"      =>$gl_code,
				"GL_NAME"      =>$gl_name,
				"SERIES_CODE"  =>$series_code,
				"SERIES_NAME"  =>$series_name,
				"PLANT_CODE"   =>$plant_code,
				"PLANT_NAME"   =>$plant_name,
				"PFCT_CODE"    =>$pfctCode,
				"PFCT_NAME"    =>$profitName,
				"BGTYPE_CODE"  =>$bg_type_code,
				"BGTYPE_NAME"  =>$bg_type_name,
				"AMOUNT"       =>$Amount,
				"TENURE"       =>$tenure,
				"MATURITY_DATE" =>$maturity_date,
				"DP_DAYS"      =>$gp_days,
				"PARTICULER"   =>$particuler,
				"SR_CODE"      =>$sr_code,
				"SR_NAME"      =>$sr_name,
				"DOCUMENT"     =>$image,
				"CP_CODE"      =>$cp_code,
				"CP_NAME"      =>$cp_name,
				"MARGIN_MONEY" =>$margin_money,
				"TERM_AND_COND" =>$termscondition,
				"REF_GL_CODE"  =>$mmrefgl_code,
				"REF_GL_NAME"  =>$mmrefgl_name,
				"GL_TRAN_ID"   =>$gl_tran_id,
				"BG_NO"       =>$bg_number,
				"BG_DATE"     =>$bgdate,
				"FLAG"         =>1,
				"CREATED_BY"   =>$createdBy,

				);
			
			$saveData = DB::table('BG_TRAN')->insert($datahead);


			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->toArray();
			

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$comp_code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($datavrn);
			}

		  
	
		if ($saveData) {
	
			$request->session()->flash('alert-success', 'Bg Tran  Added Successfully...!');
					return redirect('/Transaction/Account/View-Bank-Guarantee-Tran');

			}else{
				$request->session()->flash('alert-error', 'Bg Tran Can Not Be Added...!');
					return redirect('/Transaction/Account/View-Bank-Guarantee-Tran');
			}
 
	}


	 public function ViewBankGurnteeTran(Request $request)
	{
			$compName = $request->session()->get('company_name');

			$title       ='View Bank Guarntee';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');


			$data = DB::table('BG_TRAN')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->get();
			
		
		if(isset($compName)){

		   return view('admin.finance.transaction.account.view_bank_guarntee',compact('data'));
		}else{
			return redirect('/useractivity');
		}
	}



	public function AddRenewBgTran(Request $request)
	{
		//print_r($this->data);exit;
		$title                      ='Renew Bank Gurrantee Transaction';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		//print_r($compcode);exit;
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'A7'])->where(['COMP_CODE'=>$getcompcode])->get();
		
		$userdata['tax_code_list']  = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
		$userdata['dept_list']      = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']     = DB::table('MASTER_PLANT')->where('COMP_CODE',$getcompcode)->get();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		//dd(DB::getQueryLog());
		$userdata['gl_list']        = DB::table('MASTER_HOUSEBANK')->get();
		$userdata['bgtype_list']    = DB::table('MASTER_BGTYPE')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->get();
		
		$userdata['bgnum_list'] = DB::table('BG_TRAN')->where('RENEW_BG_TRAN_STATUS','0')->get();
		
	//	$userdata['acc_list'] = DB::table('PORDER_HEAD')->groupBY('ACC_CODE')->get();
		$userdata['acc_list'] = DB::table('MASTER_ACC')->groupBY('ACC_CODE')->get();

		$userdata['sr_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','SR')->get();

		$userdata['cp_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->get();
			//print_r($userdata['acc_list']);exit;
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

		//$userdata['truck_list']      = DB::table('TRIP_HEAD')->where('GATE_STATUS','0')->get();

		$userdata['planing_list']      = DB::table('TRIP_HEAD')->where('GATE_IN_STATUS','0')->where('OWNER','!=','DUMP')->get();

		$userdata['item_list']      = DB::table('MASTER_ITEM')->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		

		$requistion = DB::table('VEHICLE_GATE_INWARD')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();
		//print_r($requistion);exit;

			$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		   $tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T4')->get();

			  $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='T4'");
			//print_r($vr_No_list);exit;
		//dd(DB::getQueryLog());
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userdata['last_num']   = $key->LAST_NO;
					$userdata['to_num']     = $key->TO_NO;
					//$userdata['trans_head'] = $key->TRAN_CODE;
				}

			}else{

					$userdata['last_num']  ='';
					$userdata['to_num']  ='';
					//$userdata['trans_head']  ='';

			}



		if(isset($CompanyCode)){

			return view('admin.finance.transaction.account.renew_bank_guarantee_tran',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
	   

	}

   
	public function getDataOldBankGurntee(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$CompanyCode = $request->session()->get('company_name');
			$spliCode    = explode('-', $CompanyCode);
			$comp_code   = $spliCode[0];
			$macc_year   = $request->session()->get('macc_year');
			$bgNumber    = $request->input('bgNumber');
			
			$bgData = DB::select("SELECT TRAN_CODE,SERIES_CODE,SERIES_NAME,VRNO,ACC_CODE,ACC_NAME,GL_CODE,GL_NAME,BGTYPE_CODE,BGTYPE_NAME,PLANT_CODE,PLANT_NAME,PFCT_CODE,PFCT_NAME,AMOUNT,TENURE,MATURITY_DATE,DP_DAYS,PARTICULER,SR_CODE,SR_NAME,CP_CODE,CP_NAME,MARGIN_MONEY,TERM_AND_COND,REF_GL_CODE,REF_GL_NAME,GL_TRAN_ID FROM BG_TRAN WHERE BG_NO='$bgNumber' AND COMP_CODE='$comp_code'");

		//print_r($bgData);exit;

			if ($bgData) {

				$response_array['response'] = 'success';
				$response_array['data'] = $bgData;

			   echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
				$response_array['data'] = '';

				$data = json_encode($response_array);

				print_r($data);
				
			}


		}else{

				$response_array['response'] = 'error';
				$response_array['data'] = '';

				$data = json_encode($response_array);

				print_r($data);
		}
	}



	 public function SaveRenewBankGurnteeTran(Request $request){

		/*echo '<pre>';

		print_r($request->post());exit;

		echo '</pre>';*/

		$validate = $this->validate($request, [
				
				'upload_document' => 'required',
				'new_bg_num' => 'required',
				
		]);

		$vr_date       = $request->input('vr_date');
		$tr_vrDate     = date('Y-m-d',strtotime($vr_date));
		$trans_code    = $request->input('trans_code');
		$series_code   = $request->input('series_code');
		$series_name   = $request->input('series_name');
		$accCode       = $request->input('acc_code');
		$accName       = $request->input('acc_name');
		$gl_code       = $request->input('gl_code');
		$gl_name       = $request->input('gl_name');
		$bg_type_code  = $request->input('bg_type');
		$bg_type_name  = $request->input('bg_type_name');
		$plant_code    = $request->input('plant_code');
		$plant_name    = $request->input('plant_name');
		$pfctCode      = $request->input('pfct_code');
		$profitName    = $request->input('pfct_name');
		$tenure        = $request->input('tenure');
		$maturity_date = $request->input('maturity_date');
		$gp_days       = $request->input('gp_days');
		$Amount        = $request->input('amount');
		$particuler    = $request->input('particuler');
		$sr_code       = $request->input('sr_code');
		$sr_name       = $request->input('sr_name');
		$cp_code       = $request->input('cp_code');
		$cp_name       = $request->input('cp_name');
		$margin_money  = $request->input('margin_money');
		$vr_no         = $request->input('vr_no');
		$mmrefgl_code  = $request->input('mmrefgl_code');
		$mmrefgl_name  = $request->input('mmrefgl_name');
		$termscondition  = $request->input('termscondition');
		$gl_tran_id    = $request->input('gl_tran_id');
		$bg_number    = $request->input('bg_num');
		$bg_date      = $request->input('bg_date');
		$bgdate        = date('Y-m-d',strtotime($bg_date));
		$new_bg_num      = $request->input('new_bg_num');
		$upload_document = $request->upload_document;

		$createdBy 	   = $request->session()->get('userid');
		$compName 	   = $request->session()->get('company_name');
		$splitComp      = explode('-', $compName);
		$comp_code      = $splitComp[0];
		$comp_name     = $splitComp[1];

		$fisYear 	=  $request->session()->get('macc_year');

		$image      = Image::make($upload_document);

		Response::make($image->encode('jpeg'));

		   $datahead=array(
				
				"COMP_CODE"    =>$comp_code,
				"COMP_NAME"    =>$comp_name,
				"FY_CODE"      =>$fisYear,
				"VRDATE"       =>$tr_vrDate,
				"TRAN_CODE"    =>$trans_code,
				"VRNO"         =>$vr_no,
				"ACC_CODE"     =>$accCode,
				"ACC_NAME"     =>$accName,
				"GL_CODE"      =>$gl_code,
				"GL_NAME"      =>$gl_name,
				"SERIES_CODE"  =>$series_code,
				"SERIES_NAME"  =>$series_name,
				"PLANT_CODE"   =>$plant_code,
				"PLANT_NAME"   =>$plant_name,
				"PFCT_CODE"    =>$pfctCode,
				"PFCT_NAME"    =>$profitName,
				"BGTYPE_CODE"  =>$bg_type_code,
				"BGTYPE_NAME"  =>$bg_type_name,
				"AMOUNT"       =>$Amount,
				"TENURE"       =>$tenure,
				"MATURITY_DATE" =>$maturity_date,
				"DP_DAYS"      =>$gp_days,
				"PARTICULER"   =>$particuler,
				"SR_CODE"      =>$sr_code,
				"SR_NAME"      =>$sr_name,
				"DOCUMENT"     =>$image,
				"CP_CODE"      =>$cp_code,
				"CP_NAME"      =>$cp_name,
				"MARGIN_MONEY" =>$margin_money,
				"TERM_AND_COND" =>$termscondition,
				"REF_GL_CODE"  =>$mmrefgl_code,
				"REF_GL_NAME"  =>$mmrefgl_name,
				"GL_TRAN_ID"   =>$gl_tran_id,
				"BG_NO"        =>$new_bg_num,
				"OLD_BG_NO"    =>$bg_number,
				"BG_DATE"      =>$bgdate,
				"FLAG"         =>1,
				"CREATED_BY"   =>$createdBy,

				);
			
		//	print_r($datahead);exit;

			//DB::enableQueryLog();
			$saveData = DB::table('RENEW_BG_TRAN')->insert($datahead);



			$dataUpdate = $arrayName = array('RENEW_BG_TRAN_STATUS' =>'1');

			$saveData = DB::table('BG_TRAN')->where('BG_NO',$bg_number)->where('VRNO',$vr_no)->where('COMP_CODE',$comp_code)->update($dataUpdate);

		 //  dd(DB::getQueryLog());
		
		if ($saveData) {
	
			$request->session()->flash('alert-success', 'Bg Tran  Added Successfully...!');
					return redirect('/Transaction/Account/View-Bank-Guarantee-Tran');

			}else{
				$request->session()->flash('alert-error', 'Bg Tran Can Not Be Added...!');
					return redirect('/Transaction/Account/View-Bank-Guarantee-Tran');
			}
 
	}



	public function ViewRenewBankGurnteeTran(Request $request)
	{
			$compName = $request->session()->get('company_name');

			$title       ='View Renew Bank Guarntee';
			
			$userid      = $request->session()->get('userid');
			
			$userType    = $request->session()->get('usertype');
			
			$compName    = $request->session()->get('company_name');
			
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			
			$fisYear     =  $request->session()->get('macc_year');


			$data = DB::table('RENEW_BG_TRAN')->where('COMP_CODE', $getcompcode)->where('FY_CODE', $fisYear)->get();
			
		
		if(isset($compName)){

		   return view('admin.finance.transaction.account.view_renew_bank_guarntee',compact('data'));
		}else{
			return redirect('/useractivity');
		}
	}



	public function bankReconciliation(Request $request){


		$title         = 'Bank Reconciliation';

		/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

			$BASE_URL    = $request->session()->get('base_url');
			$COMPCODE    = $request->session()->get('company_name');
			$FIRSTFYCODE = $request->session()->get('fiscal_year');
			$COMPCD      = explode('-', $COMPCODE);
			$MCOMPCODE   = $COMPCD[0];
			$FYCODE      = $request->session()->get('macc_year');
			$USERID      = $request->session()->get('userid');

		/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */

		$TCODE     = 'A0';

		$getCommonData = MyCommonFun($TCODE,$MCOMPCODE,$FYCODE);

		$getseries   = $getCommonData['getseries'];
		$userdata['pfct_list'] = $getCommonData['masterPFCT'];
		$userdata['remark_list'] = $getCommonData['remark_data'];
		$userdata['gl_list'] = $getCommonData['master_GL'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$tranListCd = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$TCODE)->get();
		$userdata['trans_head'] =$tranListCd[0]->TRAN_CODE;

		if(isset($COMPCODE)){

			return view('admin.finance.transaction.account.bank_reconciliation',$userdata+compact('getseries','title'));
		}else{

			return redirect('/useractivity');
		}


	}

	public function getDataOnBankRecon(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

				$BASE_URL    = $request->session()->get('base_url');
				$COMPCODE    = $request->session()->get('company_name');
				$FIRSTFYCODE = $request->session()->get('fiscal_year');
				$COMPCD      = explode('-', $COMPCODE);
				$MCOMPCODE   = $COMPCD[0];
				$FYCODE      = $request->session()->get('macc_year');
				$USERID      = $request->session()->get('userid');

			/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */


			if (!empty($request->series_code || $request->from_date || $request->to_date || $request->series_name)) {


				$SERIESCODE = $request->input('series_code');
				$SERIESNAME = $request->input('series_name');
				$TODATE     = $request->input('to_date');
				$FROMDATE   = $request->input('from_date');

				$MTODATE 	= date("Y-m-d", strtotime($TODATE));
				$MFROMDATE  = date("Y-m-d", strtotime($FROMDATE));

				//DB::enableQueryLog();
				$data0 = DB::table('CB_TRAN')->WHERE('COMP_CODE',$MCOMPCODE)->WHERE('FY_CODE',$FYCODE)->WHERE('SERIES_CODE',$SERIESCODE)->whereBetween('VRDATE',[$MFROMDATE, $MTODATE])->whereNull('BANK_DATE')->get();
				//dd(DB::getQueryLog());
			   
				if($data0) {

					return DataTables()->of($data0)->addIndexColumn()->make(true);

					//print_r($data);

				}else{

					$data1 = array();

					return DataTables()->of($data1)->addIndexColumn()->make(true);
					
				}



			}else{

				$data1 = array();

				return DataTables()->of($data1)->addIndexColumn()->make(true);

			}


		}else{

			$data1 = array();

			return DataTables()->of($data1)->addIndexColumn()->make(true);

		}


	}


	public function saveBankReconciliation(Request $request){

	

		/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

			$BASE_URL    = $request->session()->get('base_url');
			$COMPCODE    = $request->session()->get('company_name');
			$FIRSTFYCODE = $request->session()->get('fiscal_year');
			$COMPCD      = explode('-', $COMPCODE);
			$MCOMPCODE   = $COMPCD[0];
			$FYCODE      = $request->session()->get('macc_year');
			$USERID      = $request->session()->get('userid');

		/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */


		$VRDT         = $request->input('vrDt');
		$LVRNO         = $request->input('vrNo');
		$CBTRANID     = $request->input('cbtranid');
		$PFCT         = $request->input('pfct');
		$TCODE        = $request->input('tcode');
		$SERIESCD     = $request->input('seriesCd');
		$VRNO         = $request->input('vrno');
		$SLNO         = $request->input('slno');
		$VRDATE       = $request->input('vrdate');
		$ACCCD        = $request->input('accCd');
		$ACCNM        = $request->input('accNm');
		$CBPARTICULAR = $request->input('cbParticular');
		$CBDRAMT      = $request->input('cbDrAmt');
		$CBCRAMT      = $request->input('cbCrAmt');
		$BANKDATE     = $request->input('bankDate');

		
		$MATCHARR = array_keys(array_filter($CBTRANID));
		$MATCHARR0 = array_keys(array_filter($BANKDATE));


		$BKDTCOUNT = count($MATCHARR0);

		DB::beginTransaction();

		try {

	
			for ($i = 0; $i < $BKDTCOUNT; $i++) {

				$getkey = $MATCHARR0[$i];

				$MCBTRANID = $CBTRANID[$getkey];
				$MSCRIES   = $SERIESCD[$getkey];
				$MTCODE    = $TCODE[0];
				$MVRNO     = $VRNO[$getkey];
				$MPFCT     = $PFCT[$getkey];
				$MACCCD    = $ACCCD[$getkey];
				$MBANKDT   = $BANKDATE[$getkey];


				$MBANKDATE 	= date("Y-m-d", strtotime($MBANKDT));


				$DATA = array(
					'BANK_DATE' =>$MBANKDATE
				);


				DB::table('CB_TRAN')->where('CBTRANID',$MCBTRANID)->where('COMP_CODE',$MCOMPCODE)->where('FY_CODE',$FYCODE)->where('SERIES_CODE',$MSCRIES)->where('TRAN_CODE',$MTCODE)->where('VRNO',$MVRNO)->where('SLNO',$SLNO)->where('PFCT_CODE',$MPFCT)->update($DATA);

				
			}/* ./ ~~~~ FOR LOOP END ~~~~ */

			//exit();

		
			DB::commit();

			$request->session()->flash('alert-success', 'Bank Date Updated Successfully...!');
			return redirect('/transaction/account/add-bank-reconciliation');

		}catch (\Exception $e) {

			DB::rollBack();
			//throw $e;
			$request->session()->flash('alert-error', 'Bank Date Can Not Be Updated...!');
			return redirect('/transaction/account/add-bank-reconciliation');

		}


		
	}


	public function bankReconciliationStatement(Request $request){

		$title         = 'Bank Reconciliation Statement';

		/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

			$BASE_URL    = $request->session()->get('base_url');
			$COMPCODE    = $request->session()->get('company_name');
			$FIRSTFYCODE = $request->session()->get('fiscal_year');
			$COMPCD      = explode('-', $COMPCODE);
			$MCOMPCODE   = $COMPCD[0];
			$MCOMPNAME   = $COMPCD[1];
			$FYCODE      = $request->session()->get('macc_year');
			$USERID      = $request->session()->get('userid');

		/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */

		$TCODE     = 'A0';

		$getCommonData = MyCommonFun($TCODE,$MCOMPCODE,$FYCODE);

		$getseries   = $getCommonData['getseries'];
		$userdata['pfct_list'] = $getCommonData['masterPFCT'];
		$userdata['remark_list'] = $getCommonData['remark_data'];
		$userdata['gl_list'] = $getCommonData['master_GL'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$tranListCd = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$TCODE)->get();
		$userdata['trans_head'] =$tranListCd[0]->TRAN_CODE;

		if(isset($COMPCODE)){

			return view('admin.finance.transaction.account.bank_reconciliation_statement',$userdata+compact('getseries','title','MCOMPNAME'));

		}else{

			return redirect('/useractivity');
			
		}


	}


	public function bankReconciliationStatementData(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$CompanyCode = $request->session()->get('company_name');
			$spliCode    = explode('-', $CompanyCode);
			$comp_code   = $spliCode[0];
			$macc_year   = $request->session()->get('macc_year');
			$bgNumber    = $request->input('bgNumber');

			if (!empty($request->fromDate || $request->toDate)) {

				$frDate    = date("Y-m-d", strtotime($request->fromDate));
				$toDate    = date("Y-m-d", strtotime($request->toDate));
				$seriesCode    = $request->seriesCode;
				$strWhere  = '';


				$configDt = DB::select("SELECT * FROM `MASTER_CONFIG` WHERE TRAN_CODE = 'A0' AND COMP_CODE = '$comp_code' AND SERIES_CODE='$seriesCode'");

				$configData = json_decode(json_encode($configDt),true);

				

				$GLCODE = $configData[0]['POST_CODE'];



				if ($GLCODE!='' || $GLCODE!='NULL' || $GLCODE!=null) {
				
					$bankBalPassBook = DB::select("SELECT M.YROPDR-M.YROPCR AS YROPBAL FROM MASTER_GLBAL M WHERE M.COMP_CODE='$comp_code' AND M.FY_CODE='$macc_year' AND M.GL_CODE='$GLCODE' UNION ALL SELECT SUM(T.CRAMT)-SUM(T.DRAMT) AS YROPBAL FROM CB_TRAN T WHERE T.COMP_CODE='$comp_code' AND T.SERIES_CODE='$seriesCode' AND T.VRDATE BETWEEN '$frDate' AND '$toDate'");

					$cqIssNtPres = DB::select("SELECT SUM(T.DRAMT) AS cqIsNotPres FROM CB_TRAN T WHERE T.COMP_CODE='$comp_code' AND T.SERIES_CODE='$seriesCode' AND T.VRDATE BETWEEN '$frDate' AND '$toDate' AND T.BANK_DATE IS NULL");

					$OpCqIssNtPres = DB::select("SELECT SUM(T.DRAMT) AS opCqIsNotPres FROM CB_TRAN T WHERE T.COMP_CODE='$comp_code' AND T.SERIES_CODE='$seriesCode' AND T.VRDATE < '$frDate' AND T.BANK_DATE IS NULL");

					$cqDepNtClrd = DB::select("SELECT SUM(T.CRAMT) AS cqDepNotClrd FROM CB_TRAN T WHERE T.COMP_CODE='$comp_code' AND T.SERIES_CODE='$seriesCode' AND T.VRDATE BETWEEN '$frDate' AND '$toDate' AND T.BANK_DATE IS NULL");
					
					$opCqDepNtClrd = DB::select("SELECT SUM(T.CRAMT) AS opCqDepNotClr FROM CB_TRAN T WHERE T.COMP_CODE='$comp_code' AND T.SERIES_CODE='$seriesCode' AND T.VRDATE < '$frDate' AND T.BANK_DATE IS NULL");


					//print_r($bankBalPassBook);
					//exit;

					if ($bankBalPassBook && $cqIssNtPres && $OpCqIssNtPres && $cqDepNtClrd & $opCqDepNtClrd) {

						$response_array['response']        = 'success';
						$response_array['data']            = '';
						$response_array['bankBalPassBook'] = $bankBalPassBook;
						$response_array['cqIssNtPres']     = $cqIssNtPres;
						$response_array['OpCqIssNtPres']   = $OpCqIssNtPres;
						$response_array['cqDepNtClrd']     = $cqDepNtClrd;
						$response_array['opCqDepNtClrd']   = $opCqDepNtClrd;

					   echo $data = json_encode($response_array);

					}else{

						$response_array['response'] = 'error';
						$response_array['data']            = '';
						$response_array['bankBalPassBook'] = '';
						$response_array['cqIssNtPres']     = '';
						$response_array['OpCqIssNtPres']   = '';
						$response_array['cqDepNtClrd']     = '';
						$response_array['opCqDepNtClrd']   = '';

						$data = json_encode($response_array);

						print_r($data);
						
					}

				}else{

					$response_array['response']        = 'error';
					$response_array['data']            = 'Series Code Not Found...!';
					$response_array['bankBalPassBook'] = '';
					$response_array['cqIssNtPres']     = '';
					$response_array['OpCqIssNtPres']   = '';
					$response_array['cqDepNtClrd']     = '';
					$response_array['opCqDepNtClrd']   = '';

					$data = json_encode($response_array);

					print_r($data);

				}

			}else{

				$response_array['response'] = 'error';
				$response_array['data']            = '';
				$response_array['bankBalPassBook'] = '';
				$response_array['cqIssNtPres']     = '';
				$response_array['OpCqIssNtPres']   = '';
				$response_array['cqDepNtClrd']     = '';
				$response_array['opCqDepNtClrd']   = '';

				$data = json_encode($response_array);

				print_r($data);

			}


		}else{

				$response_array['response'] = 'error';
				$response_array['data']            = '';
				$response_array['bankBalPassBook'] = '';
				$response_array['cqIssNtPres']     = '';
				$response_array['OpCqIssNtPres']   = '';
				$response_array['cqDepNtClrd']     = '';
				$response_array['opCqDepNtClrd']   = '';

				$data = json_encode($response_array);

				print_r($data);
		}
		


	}

	public function bankReconStatementDetails(Request $request){

		$response_array = array();


		if ($request->ajax()) {

			$CompanyCode = $request->session()->get('company_name');
			$spliCode    = explode('-', $CompanyCode);
			$comp_code   = $spliCode[0];
			$macc_year   = $request->session()->get('macc_year');

			if (!empty($request->statementType)) {

				$seriesCode = $request->seriesCode;
				$type       = $request->statementType;
				$frDate    = date("Y-m-d", strtotime($request->fromDate));
				$toDate    = date("Y-m-d", strtotime($request->toDate));

				$configDt = DB::select("SELECT * FROM `MASTER_CONFIG` WHERE TRAN_CODE = 'A0' AND COMP_CODE = '$comp_code' AND SERIES_CODE='$seriesCode'");

				$configData = json_decode(json_encode($configDt),true);

				$GLCODE = $configData[0]['GL_CODE'];

				

				if($type == 'CIBNP'){
					//DB::enableQueryLog();
					$bankBalPassBook = DB::select("SELECT * FROM CB_TRAN T WHERE T.COMP_CODE='$comp_code' AND T.DRAMT >0 AND T.SERIES_CODE='$seriesCode' AND T.VRDATE BETWEEN '$frDate' AND '$toDate' AND T.BANK_DATE IS NULL");
					//dd(DB::getQueryLog());
				}else if($type == 'OCIBNP'){
					
					$bankBalPassBook = DB::select("SELECT * FROM CB_TRAN T WHERE T.COMP_CODE='$comp_code' AND T.DRAMT >0  AND T.SERIES_CODE='$seriesCode' AND T.VRDATE < '$frDate' AND T.BANK_DATE IS NULL");

				}else if($type == 'CDBNYP'){
					
					$bankBalPassBook = DB::select("SELECT * FROM CB_TRAN T WHERE T.COMP_CODE='$comp_code' AND T.CRAMT >0 AND T.SERIES_CODE='$seriesCode' AND T.VRDATE BETWEEN '$frDate' AND '$toDate' AND T.BANK_DATE IS NULL");

				}else if($type == 'OCDBNP'){
					
					$bankBalPassBook = DB::select("SELECT * FROM CB_TRAN T WHERE T.COMP_CODE='$comp_code' AND T.CRAMT >0 AND T.SERIES_CODE='$seriesCode' AND T.VRDATE < '$frDate' AND T.BANK_DATE IS NULL");
				}else{
					$bankBalPassBook =array();
				}

				if($bankBalPassBook) {

					return DataTables()->of($bankBalPassBook)->addIndexColumn()->make(true);

					//print_r($data);

				}else{

					$data1 = array();

					return DataTables()->of($data1)->addIndexColumn()->make(true);
				}	

			}else{

				$data1 = array();

				return DataTables()->of($data1)->addIndexColumn()->make(true);

			}

		}else{

			$data1 = array();

			return DataTables()->of($data1)->addIndexColumn()->make(true);

		}

	}

/* ------------ START : ADD POSTING PAYMENT ADVICE ------------ */
	
	public function AddPostingPayAdvice(Request $request){

		$title       = 'Add Posting Payment Advice';
		$COMPCODE    = $request->session()->get('company_name');
		$COMPCD      = explode('-', $COMPCODE);
		$MCOMPCODE   = $COMPCD[0];
		$FYCODE      = $request->session()->get('macc_year');
		$USERID      = $request->session()->get('userid');
		$transCode   = 'A0';

		$ConstructData = MyConstruct();

		$userdata['cost_list'] = $ConstructData['master_cost'];

		$getCommonData = MyCommonFun($transCode,$MCOMPCODE,$FYCODE);

		$getseries   = $getCommonData['getseries'];
		$userdata['pfct_list'] = $getCommonData['masterPFCT'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$tranListCd = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$transCode)->get();
		$userdata['trans_head'] =$tranListCd[0]->TRAN_CODE;

		//$userdata['accList'] = DB::table('PAYMENT_ADVICE_TRAN')->where('PMT_TRAN_CODE',NULL)->where('PMT_VRNO',NULL)->where('PMT_SERIES',NULL)->groupby('ACC_CODE')->get();
		$userdata['accList'] = DB::select("SELECT B.GL_CODE,B.BANK_CODE,B.BANK_NAME,B.ACC_NUMBER,B.ACC_CODE,B.ACC_NAME,(SELECT GL_NAME FROM MASTER_GL WHERE GL_CODE=B.GL_CODE ) AS GLNAME FROM `PAYMENT_ADVICE_TRAN` A,MASTER_ACC B WHERE A.ACC_CODE=B.ACC_CODE AND A.PMT_TRAN_CODE IS NULL AND A.PMT_VRNO IS NULL AND A.PMT_SERIES IS NULL AND A.ADVICE_AMT >0");


		if(isset($COMPCODE)){

	    	return view('admin.finance.transaction.account.add_posting_payment_advice',$userdata+compact('title','getseries'));
	    }else{

			return redirect('/useractivity');
		}
		
	}

	public function getPostingDataAgainstAcc(Request $request){

    	$response_array = array();

		if ($request->ajax()) {


			/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

				$BASE_URL    = $request->session()->get('base_url');
				$COMPCODE    = $request->session()->get('company_name');
				$FIRSTFYCODE = $request->session()->get('fiscal_year');
				$COMPCD      = explode('-', $COMPCODE);
				$MCOMPCODE   = $COMPCD[0];
				$FYCODE      = $request->session()->get('macc_year');
				$USERID      = $request->session()->get('userid');

			/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */


			if (!empty($request->accCode)) {


				$accCode = $request->input('accCode');

				//DB::enableQueryLog();
				$data0 = DB::select("SELECT * FROM `PAYMENT_ADVICE_TRAN` WHERE ACC_CODE='$accCode' AND PMT_TRAN_CODE IS NULL AND PMT_VRNO IS NULL AND PMT_SERIES IS NULL AND ADVICE_AMT >0");
		   		 //$data0 = DB::table('PAYMENT_ADVICE_TRAN')->where('ACC_CODE',$accCode)->where('PMT_TRAN_CODE',NULL)->where('PMT_VRNO',NULL)->where('PMT_SERIES',NULL)->get();
		    	//dd(DB::getQueryLog());
	           
	    		if($data0) {

	    			return DataTables()->of($data0)->addIndexColumn()->make(true);

		            //print_r($data);

				}else{

					$data1 = array();

					return DataTables()->of($data1)->addIndexColumn()->make(true);
					
				}



			}else{

				$data1 = array();

				return DataTables()->of($data1)->addIndexColumn()->make(true);

			}


	    }else{

    		$data1 = array();

			return DataTables()->of($data1)->addIndexColumn()->make(true);

	    }


    }

    public function SavePostingPaymentAdvice(Request $request){

		$slno             = 1;
		$createdBy        = $request->session()->get('userid');
		$compName         = $request->session()->get('company_name');
		$splitComp        = explode('-', $compName);
		$comp_code        = $splitComp[0];
		$comp_name        = $splitComp[1];
		$fisYear          = $request->session()->get('macc_year');
		$vrNo             = $request->input('vr_no');
		$pfctCode         = $request->input('pfctCode');
		$pfctName         = $request->input('profitName');
		$tranCode         = $request->input('tran_code');
		$seriesCode       = $request->input('seriescode');
		$seriesName       = $request->input('seriesname');
		$postingCode      = $request->input('postingCode');
		$postingName      = $request->input('postingName');
		$vrType           = $request->input('vrType');
		$costCenterCode   = $request->input('costCode');
		$costCenterName   = $request->input('costName');
		$glCode           = $request->input('glCode');
		$glName           = $request->input('glName');
		$accCode          = $request->input('accCode');
		$accName          = $request->input('accName');
		$perticularText   = $request->input('remark');
		$drAmt            = $request->input('dr_amount');
		$crAmt            = 0.00;
		$instType         = $request->input('instrument_type');
		$chequeNo         = $request->input('instrument_no');
		$payAdvTblData    = $request->input('payAdvTblData');
		$ChequeBookOpen   = $request->input('checkChequeBookOpen');
		$chequeTblcolData =  $request->input('chequeTblData');
		$instTypeName     = '';
		$vr_date          = date("Y-m-d", strtotime($request->input('vrDate')));
		$saleRepCode      ='';
		$chequeDate       ='';
		$blank_val        ='';
		$ifPayAdvAply     = 1;
		$cashPDf          ='PAYMENT_REMITTANCE';
		if($vrNo == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrNo;
		}

		$vrno_Exist = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$tranCode)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrno_Exist[0]->LAST_NO +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {

    		$this->InsertInCashBankNew($NewVrno,$slno,$comp_code,$fisYear,$pfctCode,$pfctName,$tranCode,$seriesCode,$seriesName,$postingCode,$postingName,$vrType,$saleRepCode,$costCenterCode,$costCenterName,$vr_date,$glCode,$glName,$accCode,$accName,$perticularText,$drAmt,$crAmt,$instType,$instTypeName,$chequeNo,$chequeDate,$blank_val,$blank_val,$blank_val,$blank_val,$blank_val,$blank_val,$ifPayAdvAply,$chequeTblcolData,$createdBy);

	    	/* ------- PAYMENT ADVICE POSTING ------- */

	    		$data_PA_mul = explode(',',$payAdvTblData);

				for($q=0;$q<count($data_PA_mul);$q++){

					$splitData = explode('~',$data_PA_mul[$q]);

					$dataPayAdv = array(
						'PMT_COMP_CODE' =>$comp_code,
						'PMT_FY_CODE'   =>$fisYear,
						'PMT_TRAN_CODE' =>$tranCode,
						'PMT_SERIES'    =>$seriesCode,
						'PMT_VRNO'      =>$NewVrno,
						'PMT_SLNO'      =>$slno
					);

					DB::table('PAYMENT_ADVICE_TRAN')->where('PAYID',$splitData[0])->where('COMP_CODE',$splitData[1])->where('FY_CODE',$splitData[2])->where('SERIES_CODE',$splitData[3])->where('VRNO',$splitData[4])->where('SLNO',$splitData[5])->update($dataPayAdv);

				}

		    	/*$splitData = explode('~',$payAdvTblData);
								
				$dataPayAdv = array(
					'PMT_TRAN_CODE' =>$tranCode,
					'PMT_SERIES'    =>$seriesCode,
					'PMT_VRNO'      =>$NewVrno,
					'PMT_SLNO'      =>$slno
				);

				DB::table('PAYMENT_ADVICE_TRAN')->where('PAYID',$splitData[0])->where('COMP_CODE',$splitData[1])->where('FY_CODE',$splitData[2])->where('SERIES_CODE',$splitData[3])->where('VRNO',$splitData[4])->where('SLNO',$splitData[5])->update($dataPayAdv);*/

	    	/* ------- PAYMENT ADVICE POSTING ------- */

	    	/* -------- GL ENTRY -------- */

	    		if($glCode){

					$gl_ledg = 3;

					for($r=1;$r<$gl_ledg;$r++){

						$gltranH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
						$gl_headID = json_decode(json_encode($gltranH), true); 
					
						if(empty($gl_headID[0]['GLTRANID'])){
							$glt_head_Id = 1;
						}else{
							$glt_head_Id = $gl_headID[0]['GLTRANID']+1;
						}

						if($r==1){
							$this->GlTEntry($comp_code,$fisYear,$tranCode,$seriesCode,$NewVrno,$r,$vr_date,$pfctCode,$glCode,$glName,'','',$accCode,$accName,$costCenterCode,$costCenterName,$saleRepCode,$blank_val,$drAmt,$crAmt,$perticularText,$blank_val,$createdBy);
						}else if($r==2){
							$this->GlTEntry($comp_code,$fisYear,$tranCode,$seriesCode,$NewVrno,$r,$vr_date,$pfctCode,$postingCode,$postingName,'','',$accCode,$accName,$costCenterCode,$costCenterName,$saleRepCode,$blank_val,$crAmt,$drAmt,$perticularText,$blank_val,$createdBy);
						}

					}
				}

	    	/* -------- GL ENTRY -------- */

	    	/* -------- ACC ENTRY ---------- */

	    		if($accCode){

					$acctraH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
					$accheadID = json_decode(json_encode($acctraH), true); 
				
					if(empty($accheadID[0]['ACCTRANID'])){
						$acc_head_Id = 1;
					}else{
						$acc_head_Id = $accheadID[0]['ACCTRANID']+1;
					}

					$this->AccountTEntry($comp_code,$fisYear,$tranCode,$seriesCode,$NewVrno,1,$vr_date,$pfctCode,$accCode,$accName,$glCode,$glName,$costCenterCode,$costCenterName,$saleRepCode,$blank_val,$drAmt,$crAmt,$perticularText,'',$createdBy);
				}

	    	/* -------- ACC ENTRY ---------- */

	    	/* ---- START : UPDATE IN CHEQUEBOOK ---- */

				if($ChequeBookOpen == 'YES' && $instType='CH' && $chequeNo!=''){

					$splitColData = explode('~',$chequeTblcolData);

					$chqHeadId = $splitColData[1];
					$chqBodyId = $splitColData[2];
					$chqSlno   = $splitColData[3];

					$dataChq = array(
						'CHEQUEDATE' => $chequeDate,
						'GL_CODE'    => $glCode,
						'GL_NAME'    => $glName,
						'ACC_CODE'   => $accCode,
						'ACC_NAME'   => $accName,
						'AMOUNT'     => $drAmt,
						'REMARK'     => $perticularText
					);

					DB::table('MASTER_CHEQUEBOOK_BODY')->where('COMP_CODE',$comp_code)->where('SERIES_CODE',$seriesCode)->where('CHQBHID',$chqHeadId)->where('CHQBBID',$chqBodyId)->where('SLNO',$chqSlno)->update($dataChq);

				}

			/* ---- END : UPDATE IN CHEQUEBOOK ---- */

    		$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tranCode)->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->toArray();

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$comp_code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$tranCode,
					'SERIES_CODE' =>$seriesCode,
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tranCode)->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($datavrn);
			}


			DB::commit();
			return $this->GeneratePdfForCashBnk($comp_code,$fisYear,$seriesCode,$NewVrno,$tranCode,'Payment',$cashPDf);

			$response_array['response'] = 'success';
		    $dataget = json_encode($response_array);  
		    print_r($dataget);

	    }catch (\Exception $e) {
	        DB::rollBack();
		    //throw $e;
	         $response_array['response'] = 'error';
			 $dataget = json_encode($response_array);  
			print_r($dataget);
		}

    }

    public function postingPayAdv_success_msg(Request $request,$saveData){

	 //	print_r($savedata);exit;

		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/transaction/account/add-posting-payment-advice');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/transaction/account/add-posting-payment-advice');

		}
	}

/* ------------ END : ADD POSTING PAYMENT ADVICE ------------ */

/* ------------- START : REPAIR  ENTRY ---------- */
	
	public function AddRepairEntry(Request $request){

		$title       = 'Add Sister Concern';
		$COMPCODE    = $request->session()->get('company_name');
		$COMPCD      = explode('-', $COMPCODE);
		$MCOMPCODE   = $COMPCD[0];
		$FYCODE      = $request->session()->get('macc_year');
		$USERID      = $request->session()->get('userid');
		$transCode   = 'A0';

		$ConstructData = MyConstruct();

		$userdata['cost_list'] = $ConstructData['master_cost'];
		$userdata['acc_list']  = $ConstructData['master_party'];

		$getCommonData = MyCommonFun($transCode,$MCOMPCODE,$FYCODE);

		$getseries             = $getCommonData['getseries'];
		$userdata['pfct_list'] = $getCommonData['masterPFCT'];
		$userdata['gl_list']   = $getCommonData['master_GL'];

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$userdata['accList'] = DB::select("SELECT B.*,A.COMP_NAME AS COMP_NAME_CTBL,A.COMP_CODE AS COMP_CODE_CTBL FROM CB_TRAN B, MASTER_COMP A WHERE A.ACC_CODE=B.ACC_CODE AND A.COMP_CODE !='$MCOMPCODE' AND B.COMP_CODE ='$MCOMPCODE' AND B.SCE_STATUS='0'");

		$userdata['accGlOfComp'] = DB::select("SELECT B.ACC_CODE,B.ACC_NAME,A.GL_CODE,A.GL_NAME FROM MASTER_ACC A,MASTER_COMP B WHERE A.ACC_CODE=B.ACC_CODE AND B.COMP_CODE='$MCOMPCODE'");

		$userdata['accCdList'] = DB::select("SELECT * FROM MASTER_ACC");

		if(isset($COMPCODE)){

	    	return view('admin.finance.transaction.account.add_repair_entry',$userdata+compact('title','getseries'));
	    }else{

			return redirect('/useractivity');
		}
		
	}

	public function AccListForSSType(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$CompanyCode = $request->session()->get('company_name');
			$spliCode    = explode('-', $CompanyCode);
			$comp_code   = $spliCode[0];
			$macc_year   = $request->session()->get('macc_year');
			$tranType_SS = $request->input('tranTypeSS');

			if($tranType_SS == 'CashBank'){
				
				$accList = DB::select("SELECT B.*,A.COMP_NAME AS COMP_NAME_CTBL,A.COMP_CODE AS COMP_CODE_CTBL FROM CB_TRAN B, MASTER_COMP A WHERE A.ACC_CODE=B.ACC_CODE AND A.COMP_CODE !='$comp_code' AND B.COMP_CODE ='$comp_code' AND B.SCE_STATUS='0'");

			}else if($tranType_SS == 'Journal'){
				
				$accList = DB::select("SELECT B.*,A.COMP_NAME AS COMP_NAME_CTBL,A.COMP_CODE AS COMP_CODE_CTBL FROM JV_TRAN B, MASTER_COMP A WHERE A.ACC_CODE=B.ACC_CODE AND A.COMP_CODE !='$comp_code' AND B.COMP_CODE ='$comp_code' AND B.SCE_STATUS='0'");
				
			}else{

				$accList ='';
			}

			if ($accList) {

				$response_array['response'] = 'success';
				$response_array['data_acc'] = $accList;
			    echo $data = json_encode($response_array);

			}else{
				$response_array['response'] = 'error';
				$response_array['data_acc'] = '';
				$data = json_encode($response_array);
				print_r($data);
			}

		}else{
			$response_array['response'] = 'error';
			$response_array['data_acc'] = '';
			$data = json_encode($response_array);
			print_r($data);
		}

	}

	public function getRepairData(Request $request){

    	$response_array = array();

		if ($request->ajax()) {

			/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

				$BASE_URL    = $request->session()->get('base_url');
				$COMPCODE    = $request->session()->get('company_name');
				$FIRSTFYCODE = $request->session()->get('fiscal_year');
				$COMPCD      = explode('-', $COMPCODE);
				$MCOMPCODE   = $COMPCD[0];
				$FYCODE      = $request->session()->get('macc_year');
				$USERID      = $request->session()->get('userid');

			/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */

			if (!empty($request->accCode)) {

				$accCode  = $request->input('accCode');
				$tranType = $request->input('tranType');

				if($tranType == 'CashBank'){

					$data0 = DB::select("SELECT *,CBTRANID as TBLHEADID FROM CB_TRAN WHERE ACC_CODE ='$accCode' AND DRAMT !='0.00' AND SCE_STATUS='0' ");

				}else if($tranType == 'Journal'){

					$data0 = DB::select("SELECT *,JVID as TBLHEADID FROM JV_TRAN WHERE ACC_CODE ='$accCode' AND DRAMT !='0.00' AND SCE_STATUS='0' ");

				}
	           
	    		if($data0) {

	    			return DataTables()->of($data0)->addIndexColumn()->make(true);
		            //print_r($data);
				}else{

					$data1 = array();
					return DataTables()->of($data1)->addIndexColumn()->make(true);
					
				}

			}else{

				$data1 = array();

				return DataTables()->of($data1)->addIndexColumn()->make(true);

			}

	    }else{

    		$data1 = array();

			return DataTables()->of($data1)->addIndexColumn()->make(true);

	    }

    }

    public function GetSeriesListOfAccComp(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$CompanyCode = $request->session()->get('company_name');
			$spliCode    = explode('-', $CompanyCode);
			$comp_code   = $spliCode[0];
			$macc_year   = $request->session()->get('macc_year');
			$acc_CompCd  = $request->input('accCompCd');
			$tranType    = $request->input('tranType');

			if($tranType == 'CashBank'){
				$tranCode = 'A0';
			}else if($tranType == 'Journal'){
				$tranCode = 'A2';
			}

			$seriesList = DB::select("SELECT * FROM MASTER_CONFIG WHERE COMP_CODE='$acc_CompCd' AND TRAN_CODE='$tranCode'");
 
			if ($seriesList) {

				$response_array['response']    = 'success';
				$response_array['data_series'] = $seriesList;
			    echo $data = json_encode($response_array);

			}else{
				$response_array['response']    = 'error';
				$response_array['data_series'] = '';
				$data = json_encode($response_array);
				print_r($data);
			}

		}else{
			$response_array['response']    = 'error';
			$response_array['data_series'] = '';
			$data = json_encode($response_array);
			print_r($data);
		}

	}

    public function SaveSisterConcernEntry(Request $request){

		$compName       = $request->session()->get('company_name');
		$sCompname      = explode('-', $compName);
		$compcode       = $request->input('accCompCd');
		$createdBy      = $request->session()->get('userid');
		$vrNo           = $request->input('vr_no');
		$tranType       = $request->input('seleTranType');
		$slno           = 1;
		$fisYear        = $request->session()->get('macc_year');
		$pfctCode       = $request->input('pfctCode');
		$pfctName       = $request->input('profitName');
		$tranCode       = $request->input('tran_code');
		$seriesCode     = $request->input('seriescode');
		$seriesName     = $request->input('seriesname');
		$postingCode    = $request->input('postingCode');
		$postingName    = $request->input('postingName');
		$vrType         = $request->input('vrType');
		$saleRepCode    = null;
		$costCenterCode = null;
		$costCenterName = null;
		$vr_date        = date('Y-m-d',strtotime($request->input('vrDate')));
		$glCode         = $request->input('glCode');
		$glName         = $request->input('glName');
		$accCode        = $request->input('accCode');
		$accName        = $request->input('accName');
		$perticularText ='';
		$drAmt          = '0.00';
		$crAmt          = $request->input('cr_amountcb');
		$blank_val      ='';
		$instType       =null;
		$instTypeName   =null;
		$chequeNo       =null;
		$chequeDate     =null;
		$ifPayAdvAply   =0;
		$accCodeJv      = $request->input('accCodeJV');
		$accNameJV      = $request->input('accNameJV');
		$glCodeJV      = $request->input('glCodeJV');
		$glNameJV      = $request->input('glNameJV');
		$drAmtJV        = $request->input('dr_amountJV');
		$crAmtJV        = $request->input('cr_amountJv');
		$pfctCodeJV     = $request->input('pfctCodeJV');
		$pfctNameJV     = $request->input('profitNameJV');
		$tranTbl_HId    = $request->input('tranTbl_HId');
		$transcodeJV    = '';

		if($vrNo == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrNo;
		}

		$vrno_Exist = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$compcode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$tranCode)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrno_Exist[0]->LAST_NO +1;
		}else{
			$NewVrno = $vrNum;
		}

    	DB::beginTransaction();

		try {

			if($tranType == 'CashBank'){

	    		$this->InsertInCashBankNew($NewVrno,$slno,$compcode,$fisYear,$pfctCode,$pfctName,$tranCode,$seriesCode,$seriesName,$postingCode,$postingName,$vrType,$saleRepCode,$costCenterCode,$costCenterName,$vr_date,$glCode,$glName,$accCode,$accName,$perticularText,$drAmt,$crAmt,$instType,$instTypeName,$chequeNo,$chequeDate,$blank_val,$blank_val,$blank_val,$blank_val,$blank_val,$blank_val,$ifPayAdvAply,$blank_val,$createdBy);

	    		$gl_ledg = 3;

				for($r=1;$r<$gl_ledg;$r++){

					$gltranH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
					$gl_headID = json_decode(json_encode($gltranH), true); 
				
					if(empty($gl_headID[0]['GLTRANID'])){
						$glt_head_Id = 1;
					}else{
						$glt_head_Id = $gl_headID[0]['GLTRANID']+1;
					}

					if($r==1){
						$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$slno,$vr_date,$pfctCode,$glCode,$glName,'','',$accCode,$accName,$costCenterCode,$costCenterName,$saleRepCode,$blank_val,$drAmt,$crAmt,$perticularText,$blank_val,$createdBy);
					}else if($r==2){
						$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$slno,$vr_date,$pfctCode,$postingCode,$postingName,'','',$accCode,$accName,$costCenterCode,$costCenterName,$saleRepCode,$blank_val,$crAmt,$drAmt,$perticularText,$blank_val,$createdBy);
					}

				}

				if($accCode){

					$acctraH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
					$accheadID = json_decode(json_encode($acctraH), true); 
				
					if(empty($accheadID[0]['ACCTRANID'])){
						$acc_head_Id = 1;
					}else{
						$acc_head_Id = $accheadID[0]['ACCTRANID']+1;
					}

					$this->AccountTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,1,$vr_date,$pfctCode,$accCode,$accName,$glCode,$glName,$costCenterCode,$costCenterName,$saleRepCode,$blank_val,$drAmt,$crAmt,$perticularText,'',$createdBy);
				}

				$statusAryCB = array(
					'SCE_STATUS' => '1'
				);

				DB::table('CB_TRAN')->where('CBTRANID',$tranTbl_HId)->update($statusAryCB);

			}else if($tranType == 'Journal'){	

				for($w=0;$w<count($accCodeJv);$w++){

					$srno=$w + 1;
				
					$JVtranH = DB::select("SELECT MAX(JVID) as JVID FROM JV_TRAN");
					$headID = json_decode(json_encode($JVtranH), true); 
					if(empty($headID[0]['JVID'])){
						$head_Id = 1;
					}else{
						$head_Id = $headID[0]['JVID']+1;
					}

					if($drAmtJV[$w]){
						$dr_amountjv = $drAmtJV[$w];
					}else{
						$dr_amountjv = 0.00;
					}

					if($crAmtJV[$w]){
						$cr_amountjv = $crAmtJV[$w];
					}else{
						$cr_amountjv = 0.00;
					}

					$blankVal ='';

					$data = array(

						'JVID'        =>$head_Id,
						'COMP_CODE'   =>$compcode,
						'FY_CODE'     =>$fisYear,
						'PFCT_CODE'   =>$pfctCodeJV,
						'PFCT_NAME'   =>$pfctNameJV,
						'TRAN_CODE'   =>$tranCode,
						'SERIES_CODE' =>$seriesCode,
						'SERIES_NAME' =>$seriesName,
						'VRNO'        =>$NewVrno,
						'SLNO'        =>$srno,
						'VRDATE'      =>$vr_date,
						'ACC_CODE'    =>$accCodeJv[$w],
						'ACC_NAME'    =>$accNameJV[$w],
						'GL_CODE'     =>$glCodeJV[$w],
						'GL_NAME'     =>$glNameJV[$w],
						'PARTICULAR'  =>'',
						'DRAMT'       =>$dr_amountjv,
						'CRAMT'       =>$cr_amountjv,
						'SR_CODE'     =>'',
						'SR_NAME'     =>'',
						'COST_CODE'   =>'',
						'COST_NAME'   =>'',
						'CREATED_BY'  =>$createdBy,
					);
					
					DB::table('JV_TRAN')->insert($data);

					if($accCodeJv[$w]){

						$this->AccountTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$srno,$vr_date,$pfctCodeJV,$accCodeJv[$w],$accNameJV[$w],$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$dr_amountjv,$cr_amountjv,$perticularText,'',$createdBy);

					}

					if($glCodeJV[$w]){

						$this->GlTEntry($compcode,$fisYear,$tranCode,$seriesCode,$NewVrno,$srno,$vr_date,$pfctCodeJV,$glCodeJV[$w],$glNameJV[$w],'','',$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$blankVal,$dr_amountjv,$cr_amountjv,$perticularText,$blankVal,$createdBy);

					}
				}

				$statusAryJV = array(
					'SCE_STATUS' => '1'
				);

				DB::table('JV_TRAN')->where('CBTRANID',$tranTbl_HId)->update($statusAryJV);

			} // tran type

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tranCode)->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$compcode)->where('FY_CODE',$fisYear)->get()->toArray();

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$compcode,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$tranCode,
					'SERIES_CODE' =>$seriesCode,
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tranCode)->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$compcode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();

			$response_array['response'] = 'success';
			$dataget = json_encode($response_array);  
			print_r($dataget);

		}catch (\Exception $e) {
			DB::rollBack();
			//throw $e;
			$response_array['response'] = 'error';
			$dataget = json_encode($response_array);  
			print_r($dataget);
		}

    }

    public function SisterConcernSaveMsg(Request $request,$saveData){

		if ($saveData) {

			$request->session()->flash('alert-success', 'Sister Concern Was Successfully Created...!');
			return redirect('/finance/view-cash-bank');

		} else {

			$request->session()->flash('alert-error', 'Sister Concern Not Created...!');
			return redirect('/finance/view-cash-bank');

		}
	}
/* ------------- END : REPAIR  ENTRY ---------- */
   
/* ----------- START : SHOW DETAILS ON TRANSACTION VIEW PAGE -------------- */

	public function ShowBodyDetailInAccSection(Request $request){

		if ($request->ajax()) {
			
			$createdBy   = $request->session()->get('userid');
			$compName    = $request->session()->get('company_name');
			$explodeCode = explode('-', $compName);
			$compcode    = $explodeCode[0];
			$fisYear     =  $request->session()->get('macc_year');
			$comp_cd     = $request->post('compCd');
			$fy_cd       = $request->post('fyCd');
			$tran_cd     = $request->post('tranCd');
			$series_cd   = $request->post('seriesCd');
			$vr_num      = $request->post('vrNo');
			$jvTblId     = $request->post('jvTblId');

			$response_array = array();
			$detailData = DB::select("SELECT * FROM JV_TRAN WHERE COMP_CODE='$comp_cd' AND FY_CODE='$fy_cd' AND TRAN_CODE='$tran_cd' AND SERIES_CODE='$series_cd' AND VRNO='$vr_num' AND JVID='$jvTblId' ");

			if ($detailData) {

				$response_array['response']    = 'success';
				$response_array['data_detail'] = $detailData;
				echo $data = json_encode($response_array);

			}else{

				$response_array['response']    = 'error';
				$response_array['data_detail'] = '' ;
				$data = json_encode($response_array);
				
			}

		}else{

				$response_array['response']    = 'error';
				$response_array['data_detail'] = '' ;
				$data = json_encode($response_array);
				
		}
		
	}

/* ----------- START : SHOW DETAILS ON TRANSACTION VIEW PAGE -------------- */

/* -------- START : TDS PAYMENT ALLOCATION --------- */
	
	public function TdsPaymentAllowcation(Request $request){

        $company_name  = $request->session()->get('company_name');
		$macc_year     = $request->session()->get('macc_year');
		$ExYEar        = explode('-', $macc_year);
		$yearstart     =  $ExYEar[0]-1;
		$yearend       =  $ExYEar[1]-1;
		$backYear      =  $yearstart.'-'.$yearend;
		$usertype      = $request->session()->get('user_type');
		$userid        = $request->session()->get('userid');

		$getcomcode    = explode('-', $company_name);
		$comp_code = $getcomcode[0];
		$bgdate     = $request->session()->get('yrbgdate');
      	$yrbgdate = date("Y-m-d", strtotime($bgdate));
        
      	$userdata['tds_list']       = DB::table('TDS_TRAN')->groupBy('TDS_CODE')->get();

     	$userdata['pmtListKey']    = DB::table('TDS_TRAN')->groupBy('VRTYPE')->get();
			
        // $userdata['tds_gl_list']       = 	DB::table('SELECT GL_CODE
		// 					          		FROM MASTER_TDS
		// 					          		WHERE TDS_CODE = 194H;')->get();

        // $userdata['tds_gl_list']       = DB::table('MASTER_TDS')->select('GL_CODE')->groupBy('GL_CODE')->get();
        //$tdsGldata = DB::select("SELECT G.GL_CODE, M.GL_NAME FROM MASTER_TDS G,MASTER_GL M WHERE M.GL_CODE = G.GL_CODE $strWhere");

        $userdata['tds_gl_list'] = DB::table('MASTER_TDS')->select('TDS_CODE', 'GL_CODE')->groupBy('GL_CODE')->get();

            // echo "<pre>";
          	// print_r($userdata['tds_gl_list']);
          	// exit();

          	// $glCodes = [];

          	// foreach ($userdata['tds_gl_list'] as $tds_gl) {
          	// 	$tdsCode = $tds_gl->TDS_CODE;
          	// 	$glCode = $tds_gl->GL_CODE;

          	// 	  $glCodes[$tdsCode] = $glCode;
          	// }
           
            // echo "<pre>";
          	// print_r($glCodes);
          	// exit();


          	// $tdsCoderetrieve = '194H';

          	// print_r( $glCodes[$tdsCode]);
          	// // exit();

          	// if (isset($glCodes[$tdsCoderetrieve])) {
          	// 	$glCode = $glCodes[$tdsCoderetrieve];
          	// 	echo "$tdsCoderetrieve $glCode";
          	// } else {
          		
          	// }


          	// print_r($glCodes[$tdsCoderetrieve]);
          	// exit();

         //  	echo "<pre>";
         // print_r($userdata['tds_gl_list']);
         // exit();

          	
          
          	// $userdata['tds_gl_list'] = DB::table('MASTER_TDS')
          	// ->select('TDS_CODE')
          	// ->where('GL_CODE', $tdsCode)
          	// ->get();


         //  echo "<pre>";
         // print_r($data);
         // exit();

    	$title = 'Cash/Bank Transaction';

		$item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->get();

	    foreach ($item_um_aum_list as $key) {
	        $userdata['fromDate'] =  $key->FY_FROM_DATE;
	        $userdata['toDate']   =  $key->FY_TO_DATE;
	    }

		$acc_list = DB::table('MASTER_ACC')->get();

    	if(isset($company_name)){

    		return view('admin.finance.transaction.account.view_tds_payment_allowaction',$userdata+compact('title','acc_list'));
		}else{
			return redirect('/useractivity');
		}
	}

	public function getDataTdsCode(Request $request){

		$companyFull    = $request->session()->get('company_name');
	    $splitComp      = explode('-', $companyFull);
		$comp_code      = $splitComp[0];
		$fisYear        =  $request->session()->get('macc_year');
		$response_array = array();
		$tds_code       = $request->input('selectCodeTds');

		if ($request->ajax()) {

			if($tds_code){

				$tdsGldata = DB::select("SELECT G.GL_CODE, M.GL_NAME FROM MASTER_TDS G, MASTER_GL M WHERE M.GL_CODE = G.GL_CODE AND G.TDS_CODE = '$tds_code'");

				// $data = DB::select("SELECT ACC_CODE, GL_CODE, SUM(DRAMT) AS DR_AMT, SUM(CRAMT) AS CR_AMT FROM CB_TRAN WHERE GL_CODE = '$tdsGldata' AND VRTYPE = 'Payment' GROUP BY GL_CODE");

			}else{
				$tdsGldata ='';
			}


			if($tdsGldata){

				$response_array['response']        = 'success';
				$response_array['dataItemList'] = $tdsGldata;
				$data = json_encode($response_array);
				print_r($data);

			}else{

				$response_array['response']        = 'error';
				$response_array['dataItemList'] = $tdsGldata;
				$data = json_encode($response_array);
				print_r($data);

			}

		}

		//$data = DB::select("SELECT ACC_CODE, GL_CODE, SUM(DRAMT) AS DR_AMT, SUM(CRAMT) AS CR_AMT FROM CB_TRAN WHERE GL_CODE = '$tdsGldata' AND VRTYPE = 'Payment' GROUP BY GL_CODE");
		// print_r($data);
		// exit();

	}

	public function getDataTdsGlCode(Request $request){

		if ($request->ajax()) {

			$fromDate  = $request->input('from_date');
			$toDate    = $request->input('to_date');
			// $pmtVocher = $request->input('getPayment');
			//$tdsCode   = $request->input('tds_code');
			$pmtGlCode = $request->input('getGlPayment');

			$fmDt  =  date("Y-m-d", strtotime($fromDate));
			$toDt  =  date("Y-m-d", strtotime($toDate));

			if(!empty($fromDate || $toDate || $pmtGlCode)){

         		//DB::enableQueryLog();

				$tdspmtVoucherdata = DB::select("SELECT * FROM CB_TRAN WHERE GL_CODE = '$pmtGlCode' AND DRAMT IS NOT NULL AND DRAMT != '0.00' AND VRDATE BETWEEN '$fmDt' AND '$toDt' AND TDSTRAN_STATUS = '0'");

				//	dd(DB::getQueryLog());

				if($tdspmtVoucherdata){

					$response_array['response']     = 'success';
					$response_array['dataItemList'] = $tdspmtVoucherdata;
					$data                           = json_encode($response_array);
					print_r($data);

				}else{

					$response_array['response']     = 'error';
					$response_array['dataItemList'] = '';
					$data                           = json_encode($response_array);
					print_r($data);

				}

			}else{

				$response_array['response']     = 'error';
				$response_array['dataItemList'] = '';
				$data                           = json_encode($response_array);
				print_r($data);
	 
			} /* EMPTY CONDITION IF CLOSE  */

		}else{

				$response_array['response']     = '';
				$response_array['dataItemList'] = '';
				$data                           = json_encode($response_array);
				print_r($data);


		} /* AJAX CONDITION IF CLOSE */

	}

	public function getDataPaymentVocherNo(Request $request){

		if ($request->ajax()) {

			$PaymentVocher = $request->input('getPaymentVocherNo');

			$splitData     = explode('/',$PaymentVocher);

			$startYear     = $splitData[0];
			$seriesCode    = $splitData[1];
			$vrNo          = $splitData[2];

		 	$fromDate  = $request->input('from_date');
		  	$toDate    = $request->input('to_date');
		  	$pmtGlCode = $request->input('gl_code');

		  	$fmDt  =  date("Y-m-d", strtotime($fromDate));
		  	$toDt  =  date("Y-m-d", strtotime($toDate));

		  	$strWhere = '';
		  	$FLAG=0;

	  		if(!empty($fromDate||$toDate||$PaymentVocher||$pmtGlCode)){

				if (isset($pmtGlCode) && trim($pmtGlCode) != "") {
					$strWhere .= " AND GL_CODE = '$pmtGlCode' ";
				}

				if(isset($fromDate)  && trim($fromDate)!=""){
					$strWhere .=" AND VRDATE BETWEEN '$fmDt' AND '$toDt'";
				}

				if (isset($seriesCode) && trim($seriesCode) != "") {
					$strWhere .= " AND SERIES_CODE = '$seriesCode' ";
				}

				if (isset($vrNo) && trim($vrNo) != "") {
					$strWhere .= " AND VRNO = '$vrNo' ";
				}

				// if($FLAG==0){

				// 	$strWhere .=" AND TDSTRAN_STATUS = '0'";

				// }

		 	  	// DB::enableQueryLog();
	 	 		$CBTRAN_DATA = DB::select("SELECT * FROM CB_TRAN WHERE 1=1  $strWhere");
		 		//dd(DB::getQueryLog());
 	 		
				if($CBTRAN_DATA){

					$response_array['response']     = 'success';
					$response_array['cb_data_list'] = $CBTRAN_DATA;
					$data                           = json_encode($response_array);
					print_r($data);

				}else{

					$response_array['response']     = 'error';
					$response_array['cb_data_list'] = '';
					$data                           = json_encode($response_array);
					print_r($data);

				}

			}else{

				$response_array['response']     = 'error';
				$response_array['cb_data_list'] = '';
				$data                           = json_encode($response_array);
				print_r($data);
	 
			} /* EMPTY CONDITION IF CLOSE  */

		}else{

			$response_array['response']     = '';
			$response_array['cb_data_list'] = '';
			$data                           = json_encode($response_array);
			print_r($data);

	 	} /* AJAX CONDITION IF CLOSE */

	}

	public function updateProceedIdGetData(Request $request){

		$checkitm      = $request->input('checkitm');
		$dataCount     = $request->input('dataCount');
		$pmtTranId     = $request->input('pmtTranIdGetName');
		$pmtTranCode   = $request->input('pmtTranCodeGetName');
		$pmtSeriesCode = $request->input('pmtSeriesCode');
		$pmtVrNo       = $request->input('pmtVrNo');
		$pmtSlNo       = $request->input('pmtSlNo');
		$pmtVrDate     = $request->input('pmtVrDate');
		$pmtParticular = $request->input('pmtParticular');

		for ($j = 0; $j < $dataCount; $j++) {
			$exp = explode('~', $checkitm[$j]);

			$data = array(
				'PMT_TRANID'      => $pmtTranId,
				'PMT_TRANCODE'    => $pmtTranCode,
				'PMT_SERIES_CODE' => $pmtSeriesCode,
				'PMT_VR_NO'       => $pmtVrNo,
				'PMT_SLNO'        => $pmtSlNo,
				'PMT_VRDATE'      => $pmtVrDate,
				'PMT_DRAMT'       => $exp[10],
				'PMT_PARTICULAR'  => $pmtParticular
			);

			$updataData = DB::table('TDS_TRAN')->where('TDSTRANID', $exp[1])->update($data);

			$data1 = array(
				'TDSTRAN_STATUS' => 1,
			);

			$updataData = DB::table('CB_TRAN')->where('CBTRANID', $pmtTranId)->update($data1);
		}

		if($updataData){
			$response_array['response']='success';

			$response_array['data']=$updataData;

			$response_array['massage']='';

			$data1 = json_encode($response_array);

			print_r($data1);

		}else{

			$request->session()->flash('alert-danger', 'Data can not Updated...!');
			$response_array['response']='error';
			$response_array['data']=$updataData;
			$response_array['massage']='';
			$data1 = json_encode($response_array);
			print_r($data1);

		}

	}

	public function getViewTdsPaymentAllowcation(Request $request){

      	if ($request->ajax()) {

        	if (!empty($request->from_date ||  $request->to_date || $request->gl_tds || $request->PaymentVocher || $request->tds_code )) {

				$tdsCode       = $request->tds_code;
				$glCode        = $request->gl_tds;
				$PaymentVocher = $request->PaymentVocher;
				$fromDate      = date('Y-m-d',strtotime($request->from_date));
				$toDate        = date('Y-m-d',strtotime($request->to_date));
                
	            $strWhere = '';

	            $FLAG = 1;

	            if (isset($tdsCode) && trim($tdsCode) != "") {
	                $strWhere .= " AND TDS_CODE = '$tdsCode' ";
	            }

	            if (isset($glCode) && trim($glCode) != "") {
	                $strWhere .= " AND GL_CODE = '$glCode' ";
	            }

	            if (isset($PaymentVocher) && trim($PaymentVocher) != "") {
	                $strWhere .= " AND VRTYPE = '$PaymentVocher' ";
	            }

	            if(isset($fromDate)  && trim($fromDate)!=""){
					$strWhere .=" AND VRDATE BETWEEN '$fromDate' AND '$toDate'";
				}

              	$data = DB::select("SELECT * FROM TDS_TRAN WHERE 1=1 $strWhere");

           		return DataTables()->of($data)->addIndexColumn()->make(true);

	        }else{

        		$data10 = array();

        		return DataTables()->of($data10)->addIndexColumn()->make(true);

	        }

    	}else{

	    	$data1 = array();

	    	return DataTables()->of($data1)->addIndexColumn()->make(true);

	    } /* AJAX IF CLOSE */
        
	}

/* -------- START : TDS PAYMENT ALLOCATION --------- */

}


?>
