<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Dispatch;
use Auth;
use DB;
use Session;
use DataTables;
use Validator;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DynQueryReportExport;
use App\Exports\TripPlanningMonthlyReportExport;



class ReportMisController extends Controller
{
    public function __cunstruct(){

		}

/* -------------- START : CASHB BANK REPORT ----------------- */

		public function ReportcashBank(Request $request){

			$company_name = $request->session()->get('company_name');
			$explodeCnm   = explode('-', $company_name);
			$compCode     = $explodeCnm[0];
			$macc_year    = $request->session()->get('macc_year');
			$ExYEar       = explode('-', $macc_year);
			$yearstart    =  $ExYEar[0]-1;
			$yearend      =  $ExYEar[1]-1;
			$backYear     =  $yearstart.'-'.$yearend;
			$bgdate       = $request->session()->get('yrbgdate');
			$yrbgdate     = date("Y-m-d", strtotime($bgdate));

			$usertype     = $request->session()->get('user_type');
			$userid       = $request->session()->get('userid');

        	if ($request->ajax()) {

            	if (!empty($request->from_date || $request->to_date || $request->acct_code || $request->series_code || $request->gl_code || $request->vrNum || $request->vr_type )) {

					$frDate     = $request->from_date;
					$toDte      = $request->to_date;
					$accCode    = $request->acct_code;
					$seriesCode = $request->series_code;
					$glCode     = $request->gl_code;
					$vr_Num     = $request->vrNum;
					$vrType     = $request->vr_type;
                
	                $fromDate = date("Y-m-d", strtotime($frDate));
					$toDate   = date("Y-m-d", strtotime($toDte));
					        
	                $strWhere='';
                	
                	if(isset($glCode)  && trim($glCode)!="")
	                {
	                 	$strWhere .= "AND HEAD_GLCODE='$glCode'";
	                }
              
		      		if(isset($accCode)  && trim($accCode)!="")
	                {
	                 	$strWhere .= "AND ACC_CODE='$accCode'";
	                }

	             	if(isset($vr_Num)  && trim($vr_Num)!="")
	             	{
	             		$strWhere .= "AND VRNO='$vr_Num'";
	             	}

						//DB::enableQueryLog();
						$data =DB::select("SELECT a.vrdate AS vrdate,a.vrno as vrno,'' as BalType,a.particular as particular,'' as instrument_type,'' as instrument_no,'' as gl_code,'' as gl_name,'' as fy_code,'' as series_code, sum(a.dramt) as drAmt, sum(a.cramt) as  CrAmt FROM

							(   

							#Bring year opening balance 

							SELECT '$fromDate' AS vrdate,'' as vrno,'' as BalType,'Opening balance' as particular,'' as instrument_type,'' as instrument_no,'' as gl_code,'' as gl_name,'' as fy_code,'' as series_code, yropdr as dramt,yropcr as CrAmt FROM MASTER_GLBAL WHERE COMP_CODE='$compCode' AND FY_CODE='$macc_year' AND GL_CODE='$glCode'

							UNION

							#Bring transactions during year opening and before from date

							SELECT '$fromDate' as vrdate, ''  as vrno,'' as BalType,'Opening balance' as particular,'' as instrument_type,'' as instrument_no,ACC_CODE as gl_code,ACC_NAME as gl_name,fy_code as fy_code,'' as series_code,sum(dramt) as drAmt, sum(cramt) as cramt FROM CB_TRAN WHERE COMP_CODE='$compCode' $strWhere AND vrdate BETWEEN '$fromDate' AND DATE_SUB('$fromDate',INTERVAL 1 DAY)) a

							UNION   

							SELECT date(VRDATE) as vrdate,VRNO as vrno,'' as BalType,particular as particular,'' as instrument_type,'' as instrument_no,if(isnull(ACC_CODE) OR ACC_CODE='',GL_CODE,ACC_CODE) as gl_code,if(isnull(ACC_CODE) OR ACC_CODE='',GL_NAME,ACC_NAME) as gl_name,fy_code as fy_code,series_code as series_code, dramt as drAmt,cramt as cramt FROM CB_TRAN WHERE COMP_CODE='$compCode' $strWhere AND VRDATE BETWEEN '$fromDate' AND '$toDate' ORDER BY vrdate ,vrno");
						//dd(DB::getQueryLog());
					
					$discriptn_page = "Search cash bank report by user";
					$this->userLogInsert($userid,$seriesCode,$vr_Num,$accCode,$discriptn_page,$glCode);
				                   
               		return DataTables()->of($data)->addIndexColumn()->make(true);
                                
	            }else{

	                $data = array();

	                return DataTables()->of($data)->addIndexColumn()->make(true);
	            }

        	}

        	$title = 'Cash/Bank Transaction';

			$item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$compCode)->where('FY_CODE',$macc_year)->get();

		    foreach ($item_um_aum_list as $key) {
		        $userdata['fromDate'] =  $key->FY_FROM_DATE;
		        $userdata['toDate']   =  $key->FY_TO_DATE;
		    }
		   // DB::enableQueryLog();
			$bank_list       = DB::select("SELECT * FROM `MASTER_CONFIG` WHERE COMP_CODE='$compCode' AND TRAN_CODE IN('A0','A1')");
			//dd(DB::getQueryLog());
			$acc_list        = DB::table('MASTER_ACC')->get();

        	if(isset($company_name)){

	    		return view('admin.finance.report.account.cash_bank_report',$userdata+compact('title','bank_list','acc_list'));
			}else{
				return redirect('/useractivity');
			}
        
    	}

/* -------------- END : CASHB BANK REPORT ----------------- */


/*REPORT INTREST LEDGER*/
	public function ReportIntrestLedger(Request $request){

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

			

        	if ($request->ajax()) {

            	if (!empty($request->acct_code || $request->year_days || $request->gp_days || $request->intrest_rate || $request->op_bal_gp_days || $request->vr_date_dr || $request->vr_date_cr || $request->neg_interest || $request->amt_grace_prd  || $request->from_date ||  $request->to_date)) {

					$accCode        = $request->acct_code;
					$year_days      = $request->year_days;
					$gp_days        = $request->gp_days;
					$intrest_rate   = $request->intrest_rate;
					$op_bal_gp_days = $request->op_bal_gp_days;
					$vr_date_dr     = $request->vr_date_dr;
					$vr_date_cr     = $request->vr_date_cr;
					$neg_interest   = $request->neg_interest;
					$amt_grace_prd  = $request->amt_grace_prd;
					$from_date1     = date('Y-m-d',strtotime($request->from_date));
					$to_date1       = date('Y-m-d',strtotime($request->to_date));
                
	              
					        
	                $strwhere='';
                	
                
		      		if(isset($accCode)  && trim($accCode)!="")
	                {
	                 	$strwhere .= "AND ACC_CODE='$accCode'";
	                }

	             	/*if(isset($year_days)  && trim($year_days)!="")
	             	{
	             		$strWhere .= "AND VRNO='$year_days'";
	             	}

	             	if(isset($gp_days)  && trim($gp_days)!="")
	             	{
	             		$strWhere .= "AND VRNO='$gp_days'";
	             	}

	             	if(isset($intrest_rate)  && trim($intrest_rate)!="")
	             	{
	             		$strWhere .= "AND VRNO='$intrest_rate'";
	             	}*/

	             	if($accCode){
						//DB::enableQueryLog();

	             		if($yrbgdate==$from_date1){

	             			$data=DB::select("SELECT S.COMP_CODE, S.ACC_CODE, S.VRDATE, S.SERIES_CODE,S.VRNO, S.PARTICULAR, S.DRAMT, S.CRAMT,S.FY_CODE FROM(
	             				SELECT B.COMP_CODE, B.ACC_CODE, '$from_date1' AS VRDATE, ' ' AS SERIES_CODE, '' AS VRNO, 'Yr Opening Balance' AS PARTICULAR, B.YROPDR AS DRAMT, B.YROPCR AS CRAMT,B.FY_CODE FROM MASTER_ACCBAL B WHERE B.COMP_CODE='$comp_code' AND B.FY_CODE='$macc_year' AND B.ACC_CODE='$accCode'
	             				UNION ALL
								SELECT T.COMP_CODE, T.ACC_CODE, T.VRDATE, T.SERIES_CODE, T.VRNO, T.PARTICULAR, T.DRAMT, T.CRAMT,T.FY_CODE FROM ACC_TRAN T WHERE T.COMP_CODE='$comp_code' AND T.VRDATE BETWEEN '$from_date1' AND '$to_date1' AND T.ACC_CODE='$accCode') S ORDER BY S.VRDATE,S.SERIES_CODE");
	             		}else{

	             			$data=DB::select("SELECT S.COMP_CODE, S.ACC_CODE, S.VRDATE, S.SERIES_CODE, S.VRNO, S.PARTICULAR, S.DRAMT, S.CRAMT,S.FY_CODE FROM
	             				(
	             				SELECT D.COMP_CODE, D.ACC_CODE, D.VRDATE, ' ' AS SERIES_CODE, ' ' AS VRNO, 'Yr Opening Balance' AS PARTICULAR, IF(SUM(D.DRAMT)-SUM(D.CRAMT)>=0,SUM(D.DRAMT)-SUM(D.CRAMT),0) AS DRAMT, IF(SUM(D.CRAMT)-SUM(D.DRAMT)>=0,SUM(D.CRAMT)-SUM(D.DRAMT),0) AS CRAMT,D.FY_CODE FROM
	             				(
	             				SELECT B.COMP_CODE, B.ACC_CODE, '$from_date1' AS VRDATE, ' ' AS SERIES_CODE, '' AS VRNO, 'Yr Opening Balance' AS PARTICULAR, B.YROPDR AS DRAMT, B.YROPCR AS CRAMT,B.FY_CODE FROM MASTER_ACCBAL B WHERE B.COMP_CODE='$comp_code' AND B.FY_CODE='$macc_year' AND B.ACC_CODE='$accCode'
	             				UNION ALL
	             				SELECT A.COMP_CODE, A.ACC_CODE, '$from_date1' AS VRDATE, ' ' AS SERIES_CODE, '' AS VRNO, 'Yr Opening Balance' AS PARTICULAR, SUM(A.DRAMT) AS DRAMT, SUM(A.CRAMT) AS CRAMT,A.FY_CODE FROM ACC_TRAN A WHERE A.COMP_CODE='$comp_code' AND A.VRDATE BETWEEN '$from_date1' AND DATE_SUB('$from_date1',INTERVAL 1 DAY) AND A.ACC_CODE='$accCode') D GROUP BY S.COMP_CODE, S.ACC_CODE, S.VRDATE
	             				UNION ALL
							  SELECT T.COMP_CODE, T.ACC_CODE, T.VRDATE, T.SERIES_CODE, T.VRNO, T.PARTICULAR, T.DRAMT, T.CRAMT,T.FY_CODE FROM ACC_TRAN T WHERE T.COMP_CODE='$comp_code' AND T.VRDATE BETWEEN '$from_date1' AND '$to_date1' AND T.ACC_CODE='$accCode') S ORDER BY S.VRDATE,S.SERIES_CODE");
	             		}

					}else{
						$data = array();
					}

					$glcode='';
					$discriptn_page = "Search cash bank report by user";
					$seriesCode='';
				   //   $this->userLogInsert($userid,$seriesCode,$vr_Num,$accCode,$discriptn_page,$glcode);
				                   
               		return DataTables()->of($data)->addIndexColumn()->make(true);
                                
	            }else{

	                $data = array();

	                return DataTables()->of($data)->addIndexColumn()->make(true);
	            }

        	}

        	$title = 'Cash/Bank Transaction';

			$item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->get();

		    foreach ($item_um_aum_list as $key) {
		        $userdata['fromDate'] =  $key->FY_FROM_DATE;
		        $userdata['toDate']   =  $key->FY_TO_DATE;
		    }

			$bank_list       = DB::table('MASTER_CONFIG')->where('COMP_CODE',$comp_code)->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();
			$acc_list        = DB::table('MASTER_ACC')->get();

        	if(isset($company_name)){

	    		return view('admin.finance.report.account.interest_ledger_report',$userdata+compact('title','bank_list','acc_list'));
			}else{
				return redirect('/useractivity');
			}
        
    	}


/* -------------- START : STATEMENT OF ACC REPORT ----------------- */


   	public function ReportstatementofAcc(Request $request){

        $company_name = $request->session()->get('company_name');
		$explodeCnm   = explode('-', $company_name);
		$compCode     = $explodeCnm[0];
		$macc_year    = $request->session()->get('macc_year');
		
       	$title = 'Statement of Report';

		$userdata['acc_list']     = DB::table('MASTER_ACC')->get();
		$userdata['accType_list'] = DB::table('MASTER_ACCTYPE')->get();

       	return view('admin.finance.report.account.statement_of_acc',$userdata+compact('title'));

    }

   public function statemantOfAccData(Request $request){

    	$company_name = $request->session()->get('company_name');
		$explodeCnm   = explode('-', $company_name);
		$compCode     = $explodeCnm[0];
		$macc_year    = $request->session()->get('macc_year');
		$from_date1   = '2023-04-01';
		$to_date1     = '2023-06-22';

		if ($request->ajax()) {

		   //if(!empty($request->acct_code)) {

				$accCode  = $request->input('acct_code');
				$accttype = $request->input('acct_type');
				//print_r($accttype);
				$strwhere='';
				$strwhereAcc='';
				if($accttype){
					$strwhere .="AND m.ATYPE_CODE='$accttype'";
				}else{
					$strwhere .="OR m.ATYPE_CODE='$accttype'";
				}

				if($accCode){
					$strwhereAcc .="AND ACC_CODE='$accCode'";
				}else{
					$strwhereAcc .='';
				}

		      	//DB::enableQueryLog();  	
		      	$data = DB::select("SELECT t.ACC_CODE as ACC_CODE ,m.acc_name as acc_name, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt>=0, t.yropdr-t.yropcr+t.yrdramt-t.yrcramt,0) as cldramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt<0, abs(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt),0) as clcramt FROM
							(
							SELECT ACC_CODE,acc_name, sum(a.yropdr) as yropdr, sum(a.yropcr) as yropcr, sum(a.yrdramt) as yrdramt, sum(a.yrcramt) as yrcramt, 0 as cldramt, 0 as clcramt FROM
							(
								#Bring year opening balance
						 	SELECT ACC_CODE, yropdr as yropdr, yropcr as yropcr, 0 as yrdramt, 0 as yrcramt,acc_name FROM MASTER_ACCBAL WHERE comp_code='$compCode' and FY_CODE='$macc_year' $strwhereAcc
							UNION ALL
								
								#Bring transactions during from date and to date
							SELECT ACC_CODE, 0 as yropdr, 0 as yropcr,dramt as yrdramt, cramt as yrcramt, acc_name FROM ACC_TRAN WHERE comp_code='$compCode' $strwhereAcc and vrdate BETWEEN '$from_date1' AND '$to_date1'
							) a group by a.ACC_CODE order by a.ACC_CODE) t,MASTER_ACC m where m.acc_code=t.acc_code $strwhere");
				//dd(DB::getQueryLog());	
				return DataTables()->of($data)->addIndexColumn()->make(true);

		   //} /* ./ condition if-else close */


		}else{

			$data = array();
		    return DataTables()->of($data)->addIndexColumn()->make(true);

		} /* ./ Ajax If Close */

   }

   public function StatementOfAccPrintFun(Request $request,$Statementdata){


		$company_name = $request->session()->get('company_name');
		$explodeCnm   = explode('-', $company_name);
		$compCode     = $explodeCnm[0];
		$compName     = $explodeCnm[1];
		$macc_year    = $request->session()->get('macc_year');
		$userid       = $request->session()->get('userid');
		$AllAccData   = explode(',',$Statementdata);
		$from_date1   = '2023-04-01';
		$to_date1     = '2024-03-31';

		$accNameAry=array();
		$allDataGet=array();
		$getAccOpng=array();
		$accAddres=array();
		for($i=0;$i<count($AllAccData);$i++){
			$dataExplode = explode('~',$AllAccData[$i]);
			//$accName = DB::table('MASTER_ACC')->where('ACC_CODE',$dataExplode[0])->get()->first();
			//$accNameAry[] =$accName->ACC_NAME;
			//DB::enableQueryLog();
			$allDataGet[] = DB::select("SELECT date(VRDATE) as VRDATE,VRNO as VRNO,'' as BalType,particular as particular,acc_code as acc_code,ACC_NAME as ACC_NAME,fy_code as fy_code,series_code as series_code,TRAN_CODE as TRAN_CODE, format(dramt,2,'en_IN') as DrAmt,dramt as rDrAmt,format(cramt,2,'en_IN') as CrAmt,cramt as rCrAmt,REF_CODE as REF_CODE,REF_NAME as REF_NAME FROM ACC_TRAN where 1=1 AND COMP_CODE='$compCode' AND FY_CODE='$macc_year' AND ACC_CODE='$dataExplode[0]' AND VRDATE BETWEEN '$from_date1' AND '$to_date1'  ORDER BY VRDATE");

			$getAccOpng[] = DB::select("SELECT VRDATE AS yropDate,yropdr as dramt,yropcr as CrAmt,yropdr-yropcr AS BAL FROM MASTER_ACCBAL WHERE COMP_CODE='$compCode' AND FY_CODE='$macc_year' AND acc_code='$dataExplode[0]'");

			$accAddres[] = DB::table('MASTER_ACCADD')->where('ACC_CODE',$dataExplode[0])->get()->first();

		}
		
		$title    = 'Add Printing Statement Of Account';

        return view('admin.finance.report.account.statemntOfaccPrint',compact('AllAccData','allDataGet','compName','getAccOpng','accAddres','macc_year'));
		
	}

/* -------------- END : STATEMENT OF ACC REPORT ----------------- */

/* -------------- START : JOURNAL REPORT ------------------ */

		public function index(Request $request){

			$company_name = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$usertype     = $request->session()->get('user_type');
			$explodeCnm   = explode('-', $company_name);
			$comp_code    = $explodeCnm[0];
			$transCode    = 'A2';

			if ($request->ajax()) {

				if (!empty($request->from_date || $request->to_date || $request->series_code || $request->acct_code || $request->vr_no)) {

					$fromDate   = $request->input('from_date');
					$fromDvar   = date("Y-m-d", strtotime($fromDate));

					$toDate     = $request->input('to_date');
					$toDvar     = date("Y-m-d", strtotime($toDate));

					$seriesCode = $request->input('series_code');
					$accCode    = $request->input('acct_code');
					$vrNo       = $request->input('vr_no');
					$strWhere='';

		    	if(isset($fromDate)  && trim($fromDate)!="")
					{
						$strWhere .="AND (JV_TRAN.VRDATE BETWEEN '$fromDvar' AND '$toDvar')";
					}

				 	if(isset($seriesCode)  && trim($seriesCode)!="")
					{
						$strWhere.="AND JV_TRAN.SERIES_CODE= '$seriesCode'";
					}

					if(isset($accCode)  && trim($accCode)!="")
					{
						$strWhere.="AND JV_TRAN.ACC_CODE= '$accCode'";
					}

					if(isset($vrNo)  && trim($vrNo)!="")
					{
						$strWhere.="AND JV_TRAN.VRNO= '$vrNo'";
					}
					//DB::enableQueryLog();
			    $data = DB::select("SELECT * FROM JV_TRAN WHERE 1=1 $strWhere AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' ORDER BY VRDATE,VRNO,SLNO");
			   // dd(DB::getQueryLog());
			    return DataTables()->of($data)->make(true);
					
				}else{

					$data = DB::select("SELECT * FROM JV_TRAN WHERE COMP_CODE='$comp_code' AND FY_CODE='$macc_year' ORDER BY VRDATE,VRNO,SLNO");
					return DataTables()->of($data)->make(true);
				}

				
				
			}

	    	$acc_list     = DB::table('MASTER_ACC')->get();

   		 	$getCommonData = MyCommonFun($transCode,$comp_code,$macc_year);

			$userdata['series_list']  = $getCommonData['getseries'];

			foreach ($getCommonData['getdate'] as $key) {

				$userdata['fromDate'] =  $key->FY_FROM_DATE;
				$userdata['toDate']   =  $key->FY_TO_DATE;
			}

			$title = 'Journal Report';

			if(isset($company_name)){
				return view('admin.finance.report.account.journal_report',$userdata+compact('title','acc_list'));
			}else{
				return redirect('/useractivity');
			}


		}

/* -------------- END : JOURNAL REPORT ------------------ */

/* -------------- START : ACCOUNT LEDGER REPORT ---------------- */

		public function ReportAccLedger(Request $request){

			$company_name  = $request->session()->get('company_name');
			$macc_year     = $request->session()->get('macc_year');
			$ExYEar        = explode('-', $macc_year);
			$yearstart     =  $ExYEar[0]-1;
			$yearend       =  $ExYEar[1]-1;
			$backYear      =  $yearstart.'-'.$yearend;
			$usertype      = $request->session()->get('user_type');
			$userid        = $request->session()->get('userid');

			$getcomcode    = explode('-', $company_name);
			$CCFromSession = $getcomcode[0];
			$bgdate     = $request->session()->get('yrbgdate');
          	$yrbgdate = date("Y-m-d", strtotime($bgdate));

      		if ($request->ajax()) {

	        	if (!empty($request->from_date || $request->acct_code || $request->pfct_code || $request->glC_code || $request->vr_num || $request->comp_text || $request->glsch_code)) {

					$acct_code = $request->acct_code;
					$pfct_code = $request->pfct_code;
					$glC_code  = $request->glC_code;
					$vr_num    = $request->vr_num;
					$from_date = $request->from_date;
					$comp_text = $request->comp_text;
					$glsch_code = $request->glsch_code;
	          
		          	$from_date1 = date("Y-m-d", strtotime($request->from_date));
		          	$to_date1   = date("Y-m-d", strtotime($request->to_date));

	          		$strwhere='';

		          	if(isset($acct_code)  && trim($acct_code)!="")
		          	{
		           		$strwhere .= "AND ACC_CODE='$acct_code'";
		           		$strwhere1= "ACC_CODE";
		          	}

		         	if(isset($pfct_code)  && trim($pfct_code)!="")
		         	{
		         		$strwhere .= "AND PFCT_CODE='$pfct_code'";
		         	}

		         	if(isset($glC_code)  && trim($glC_code)!="")
		         	{
		         		$strwhere .= "AND GL_CODE='$glC_code'";
		         		$strwhere1= "GL_CODE";
		         	}

		         	if(isset($vr_num)  && trim($vr_num)!="")
		         	{
		         		$strwhere .= "AND VRNO ='$vr_num'";
		         	}

		         	if(isset($comp_text)  && trim($comp_text)!="")
		         	{
		         		$strwhere .= "AND COMP_CODE ='$CCFromSession'";
		         	}
	             	
		        	/*if($acct_code){
		         		$post_code='t.acc_code as acc_code';
		         	}else{
		         		$post_code='t.gl_code as gl_code,t.acc_code as acc_code';
		         	}*/
	            
	          		if($acct_code && $vr_num || $acct_code){
	          			//DB::enableQueryLog();
		            	$data = DB::select("SELECT COMP_CODE as comp_code,PFCT_CODE as pfct_code,'' as headid,'$from_date1' as VRDATE,'' as VRNO,'' as BalType,'Op Balance C/F' as particular,acc_code as acc_code,acc_name,'' as gl_code, '' as gl_name,fy_code as fy_code,'' as series_code,'' as TRAN_CODE, format(YROPDR,2,'en_IN') as DrAmt,0 as rDrAmt,format(YROPCR,2,'en_IN') as CrAmt,0 as rCrAmt,'' as REF_CODE,'' as REF_NAME FROM MASTER_ACCBAL WHERE 1=1 AND FY_CODE='$macc_year' $strwhere
		            		UNION ALL
		            		SELECT COMP_CODE as comp_code,PFCT_CODE as pfct_code,ACCTRANID as headid,date(VRDATE) as VRDATE,VRNO as VRNO,'' as BalType,particular as particular,acc_code as acc_code,acc_name,'' as gl_code, '' as gl_name,fy_code as fy_code,series_code as series_code,TRAN_CODE as TRAN_CODE, format(dramt,2,'en_IN') as DrAmt,dramt as rDrAmt,format(cramt,2,'en_IN') as CrAmt,cramt as rCrAmt,REF_CODE as REF_CODE,REF_NAME as REF_NAME FROM ACC_TRAN where 1=1 AND FY_CODE='$macc_year' $strwhere AND VRDATE BETWEEN '$from_date1' AND '$to_date1'  ORDER BY VRDATE,VRNO");
	            	//dd(DB::getQueryLog());
	         		}else if($glC_code && $vr_num || $vr_num || $glC_code){
	         			//DB::enableQueryLog();
	         			$data = DB::select("SELECT COMP_CODE as comp_code,PFCT_CODE as pfct_code,'' as headid,'$from_date1' as VRDATE,'' as VRNO,'' as BalType,'Op Balance C/F' as particular,'' as acc_code,'' as acc_name,gl_code as gl_code, gl_name as gl_name,fy_code as fy_code,'' as series_code,'' as TRAN_CODE, format(YROPDR,2,'en_IN') as DrAmt,0 as rDrAmt,format(YROPCR,2,'en_IN') as CrAmt,0 as rCrAmt,'' as REF_CODE,'' as REF_NAME FROM MASTER_GLBAL WHERE 1=1 AND FY_CODE='$macc_year' $strwhere
		            		UNION ALL
		            		SELECT COMP_CODE as comp_code,PFCT_CODE as pfct_code,GLTRANID as headid,date(VRDATE) as VRDATE,VRNO as VRNO,'' as BalType,particular as particular,gl_code as gl_code,gl_name as gl_name,ACC_CODE as acc_code,ACC_NAME as acc_name,fy_code as fy_code,series_code as series_code,TRAN_CODE as TRAN_CODE, format(dramt,2,'en_IN') as DrAmt,dramt as rDrAmt,format(cramt,2,'en_IN') as CrAmt,cramt as rCrAmt,REF_CODE as REF_CODE,REF_NAME as REF_NAME FROM GL_TRAN where 1=1 AND FY_CODE='$macc_year' $strwhere AND VRDATE BETWEEN '$from_date1' AND '$to_date1'  ORDER BY VRDATE");
	         		}else if($glsch_code){

	         			$data = DB::select("SELECT G.COMP_CODE as comp_code,G.PFCT_CODE as pfct_code,'' as headid,'$from_date1' as VRDATE,'' as VRNO,'' as BalType,'Op Balance C/F' as particular,'' as acc_code,'' as acc_name,G.gl_code as gl_code, G.gl_name as gl_name,G.fy_code as fy_code,'' as series_code,'' as TRAN_CODE, format(G.YROPDR,2,'en_IN') as DrAmt,0 as rDrAmt,format(G.YROPCR,2,'en_IN') as CrAmt,0 as rCrAmt,'' as REF_CODE,'' as REF_NAME FROM MASTER_GLBAL G,MASTER_GLSCH H WHERE 1=1 AND FY_CODE='$macc_year' $strwhere
		            		UNION ALL
		            		SELECT G.COMP_CODE as comp_code,G.PFCT_CODE as pfct_code,G.GLTRANID as headid,date(G.VRDATE) as VRDATE,G.VRNO as VRNO,'' as BalType,particular as particular,G.gl_code as gl_code,G.gl_name as gl_name,G.ACC_CODE as acc_code,G.ACC_NAME as acc_name,G.fy_code as fy_code,G.series_code as series_code,G.TRAN_CODE as TRAN_CODE, format(G.dramt,2,'en_IN') as DrAmt,G.dramt as rDrAmt,format(G.cramt,2,'en_IN') as CrAmt,G.cramt as rCrAmt,G.REF_CODE as REF_CODE,G.REF_NAME as REF_NAME FROM GL_TRAN G,MASTER_GLSCH H where 1=1 AND G.FY_CODE='$macc_year' $strwhere AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'  ORDER BY G.VRDATE");

	         		}	
	         			//dd(DB::getQueryLog());
	      //      			$data = DB::select("SELECT t.VRDATE,t.VRNO,format(t.drAmt,2,'en_IN') as DrAmt, format(t.cramt,2,'en_IN') as CrAmt, if(t.drAmt>0,format(@running_total:=@running_total + t.drAmt,2,'en_IN'),format(@running_total:=@running_total - t.cramt,2,'en_IN')) AS balence,if(t.dramt>t.cramt,'Dr','Cr') as BalType, t.particular as particular,t.instrument_type as instrument_type,t.instrument_no as instrument_no,t.fy_code as fy_code,t.series_code as series_code,t.REF_CODE,t.REF_NAME,t.gl_code as gl_code FROM 
							// 	(
							// 	SELECT '$from_date1' AS vrdate,'Op-Bal' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as gl_code,'' as fy_code,'' as series_code, if(if(b.dramt>0,b.dramt,0) - if(b.cramt>0,b.cramt,0) >0,b.dramt- if(b.cramt>0,b.cramt,0),0) as dramt, if(if(b.cramt>0,b.cramt,0) - if(b.dramt>0,b.dramt,0) >0,b.cramt- if(b.dramt>0,b.dramt,0),0) as CrAmt,'' as REF_CODE,'' as REF_NAME FROM    
							// 	(
							// 	SELECT '$from_date1' AS vrdate,'Op-Bal' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as gl_code,'' as fy_code,'' as series_code, sum(a.dramt) as drAmt, sum(a.cramt) as  CrAmt,'' as REF_CODE,'' as REF_NAME FROM 
							// 	((    
							// 	#Bring year opening balance
							// SELECT '$from_date1' AS vrdate,'Opening' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as gl_code,'' as fy_code,'' as series_code, yropdr as dramt,yropcr as CrAmt,'' as REF_CODE,'' as REF_NAME FROM MASTER_GLBAL WHERE  FY_CODE='$macc_year' AND gl_code='$glC_code')
							// UNION
							// #Bring transactions during year opening and before from date
							// SELECT '$from_date1' as vrdate, 'Before Date'  as vrno,'' as BalType,particular as particular,'' as instrument_type,'' as instrument_no,gl_code as gl_code,fy_code as fy_code,series_code as series_code,sum(dramt) as drAmt, sum(cramt) as cramt,'' as REF_CODE,'' as REF_NAME FROM GL_TRAN WHERE 1=1 AND COMP_CODE='$CCFromSession' AND FY_CODE='$macc_year' $strwhere AND vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY) ) a) b
							// UNION    
							// SELECT date(VRDATE) as vrdate,VRNO as vrno,'' as BalType,particular as particular,'' as instrument_type,'' as instrument_no,gl_code as gl_code,fy_code as fy_code,series_code as series_code, dramt as drAmt,cramt as cramt,REF_CODE as REF_CODE,REF_NAME as REF_NAME FROM GL_TRAN where 1=1 AND COMP_CODE='$CCFromSession' AND FY_CODE='$macc_year' $strwhere AND VRDATE BETWEEN '$from_date1' AND '$to_date1'  ORDER BY vrdate ASC
							// )t JOIN (SELECT @running_total:=0) r");

	         		

	         		$serieCD='';
	         		$discriptn_page = "Search account ledger report by user";
						$this->userLogInsert($userid,$serieCD,$vr_num,$acct_code,$discriptn_page,$glC_code);

	               return DataTables()->of($data)->addIndexColumn()->make(true);
	                                
		        }else{

		              $data = array();

		              return DataTables()->of($data)->addIndexColumn()->make(true);
		       	}

      		}

      		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$CCFromSession,'FY_CODE'=>$macc_year])->get();

	        foreach ($getdate as $key) {
	            $userdata['fromDate'] =  $key->FY_FROM_DATE;
	            $userdata['toDate']   =  $key->FY_TO_DATE;
	        }
            
			$title = 'Acc Ledger Report';
			
			$acc_list     = DB::table('MASTER_ACC')->get();
			
			$vrno_list    = DB::table('GL_TRAN')->groupBy('GL_TRAN.VRNO')->get();

			$glCode_list  = DB::table('MASTER_GL')->get();
			$comp_list  = DB::table('MASTER_COMP')->get();
			$cost_list  = DB::table('MASTER_COST')->get();
			$glsch_list  = DB::table('MASTER_GLSCH')->get();

			$acc_led_list = DB::table('GL_TRAN')->where('FY_CODE',$backYear)->get();
        
        	return view('admin.finance.report.account.acc_ledger_report',$userdata+compact('title','acc_list','acc_led_list','glCode_list','vrno_list','comp_list','company_name','cost_list','glsch_list'));
        
    	}

    	public function getOpeningBalOfacc(Request $request){

			$response_array = array();

			if ($request->ajax()) {

				$CompanyCode = $request->session()->get('company_name');
				$compcode    = explode('-', $CompanyCode);
				$getcompcode = $compcode[0];
				$macc_year   = $request->session()->get('macc_year');

				$acc_Code    = $request->input('accCode');
				$glCode      = $request->input('glCode');

				if($acc_Code){

					$opnBalDetails = DB::select("SELECT ifnull(yropdr,0) as dramt,ifnull(yropcr,0) as CrAmt,ifnull(yropdr,0)-ifnull(yropcr,0) AS BAL FROM MASTER_ACCBAL WHERE FY_CODE='$macc_year' AND acc_code='$acc_Code'");

				}else if($glCode){

					$opnBalDetails = DB::select("SELECT ifnull(yropdr,0) as dramt,ifnull(yropcr,0) as CrAmt,ifnull(yropdr,0)-ifnull(yropcr,0) AS BAL FROM MASTER_GLBAL WHERE  FY_CODE='$macc_year' AND gl_code='$glCode' AND COMP_CODE='$getcompcode'");

				}else{
					$opnBalDetails ='';
				}

				if($opnBalDetails !='') {

					$response_array['response']    = 'success';
					$response_array['data_opgBal'] = $opnBalDetails;
					echo $data = json_encode($response_array);

				}else{

					$response_array['response']    = 'error';
					$response_array['data_opgBal'] = '' ;
					$data = json_encode($response_array);
					print_r($data);
			
				}

			}else{

					$response_array['response']    = 'error';
					$response_array['data_opgBal'] = '' ;
					$data = json_encode($response_array);
					print_r($data);
			}

    	}

    	public function ReportAccSubLegder(Request $request){

    		//print_r('sub table');exit;

			$company_name  = $request->session()->get('company_name');
			$macc_year     = $request->session()->get('macc_year');
			$ExYEar        = explode('-', $macc_year);
			$yearstart     =  $ExYEar[0]-1;
			$yearend       =  $ExYEar[1]-1;
			$backYear      =  $yearstart.'-'.$yearend;
			$usertype      = $request->session()->get('user_type');
			$userid        = $request->session()->get('userid');

			$getcomcode    = explode('-', $company_name);
			$CCFromSession = $getcomcode[0];
			$bgdate        = $request->session()->get('yrbgdate');
			$yrbgdate      = date("Y-m-d", strtotime($bgdate));

	  		if ($request->ajax()) {

	        	//if (!empty($request->accCode)) {

					$acct_code  = $request->accCode;
					$glCode     = $request->glCode;
					$compCode   = $request->compCode;
					$glschCode  = $request->glschCode;
					$costCode   = $request->costCode;
					$field_Type = $request->fieldType;

					//print_r($glschCode);
		          
		          	$from_date1 = date("Y-m-d", strtotime($request->from_date));
		          	$to_date1   = date("Y-m-d", strtotime($request->to_date));

	          		$strwhere='';
	          		$strwhere1='';

		          	if(isset($acct_code)  && trim($acct_code)!="")
		          	{
		           		$strwhere .= "AND G.ACC_CODE='$acct_code'";
		           		$strwhere1= "AND B.ACC_CODE='$acct_code'";
		          	}

		         	if(isset($glCode)  && trim($glCode)!="")
		         	{
		         		$strwhere .= "AND G.GL_CODE='$glCode'";
		         		$strwhere1 .= "AND B.GL_CODE='$glCode'";
		         		
		         	}

		         	if(isset($compCode)  && trim($compCode)!="")
		         	{
		         		$strwhere .= "AND G.COMP_CODE ='$compCode'";
		         		$strwhere1 .= "AND B.COMP_CODE ='$compCode'";
		         	}

		         	if(isset($costCode)  && trim($costCode)!="")
		         	{
		         		$strwhere .= "AND G.COST_CODE ='$costCode'";
		         		//$strwhere1 .= "AND G.COST_CODE ='$costCode'";
		         	}

	         	if($glCode){
		            
	          		if($field_Type=='ACCGLSCH'){
	          			//DB::enableQueryLog();
		            	$data = DB::select("SELECT S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
							(
							SELECT B.comp_code,B.pfct_code,H.glsch_code as gl_code, H.glsch_name  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_GLBAL B, MASTER_GL L, MASTER_GLSCH H WHERE B.GL_CODE=L.GL_CODE AND L.GLSCH_CODE=H.GLSCH_CODE $strwhere1 AND B.FY_CODE='$macc_year'
							UNION ALL
							SELECT G.comp_code,G.pfct_code,H.glsch_code as gl_code,H.glsch_name as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM GL_TRAN G, MASTER_GL L, MASTER_GLSCH H WHERE G.GL_CODE=L.GL_CODE AND L.GLSCH_CODE=H.GLSCH_CODE $strwhere AND G.FY_CODE='$macc_year'
							AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

							    ) S GROUP BY S.comp_code,S.gl_code");

	            		//dd(DB::getQueryLog());
	         		}else if($field_Type == 'COSTCENTER'){

	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
								(
								SELECT 0 as slno,B.comp_code,B.pfct_code,'' as gl_code,'OPENING BALANCE'  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_GLBAL B WHERE 1=1 $strwhere1 AND B.FY_CODE='$macc_year'
								UNION ALL
								SELECT 1 as slno,G.comp_code,G.pfct_code,H.cost_code as gl_code,H.cost_name as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM GL_TRAN G LEFT JOIN MASTER_COST H ON G.COST_CODE=H.COST_CODE WHERE 1=1 $strwhere AND G.FY_CODE='$macc_year'
								AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

								    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.slno");
		               
	         		}else if($field_Type == 'PROFITCENTER'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
							(
							SELECT 0 as slno,B.comp_code,B.pfct_code,B.pfct_code as gl_code,P.pfct_name  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_GLBAL B,MASTER_PFCT P WHERE B.PFCT_CODE=P.PFCT_CODE $strwhere1 AND B.FY_CODE='$macc_year'
							UNION ALL
							SELECT 1 as slno,G.comp_code,G.pfct_code,H.pfct_code as gl_code,H.pfct_name as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM GL_TRAN G LEFT JOIN MASTER_PFCT H ON G.PFCT_CODE=H.PFCT_CODE WHERE 1=1 $strwhere AND G.FY_CODE='$macc_year'
							AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

							    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.gl_code");
	         		}else if($field_Type == 'COMPANY'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
							(
							SELECT 0 as slno,B.comp_code,B.pfct_code,B.comp_code as gl_code,P.comp_name  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_GLBAL B,MASTER_COMP P WHERE B.COMP_CODE=P.COMP_CODE $strwhere1 AND B.FY_CODE='$macc_year'
							UNION ALL
							SELECT 1 as slno,G.comp_code,G.pfct_code,H.COMP_CODE as gl_code,H.comp_name as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM GL_TRAN G LEFT JOIN MASTER_COMP H ON G.COMP_CODE=H.COMP_CODE WHERE 1=1 $strwhere AND G.FY_CODE='$macc_year'
							AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

							    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.gl_code");
	         		}else if($field_Type == 'MONTHLY'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
								(
								SELECT 0 as slno,B.comp_code,B.pfct_code,B.FY_CODE as gl_code,''  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_GLBAL B,MASTER_COMP P WHERE B.COMP_CODE=P.COMP_CODE $strwhere1 AND B.FY_CODE='$macc_year'
								UNION ALL
								SELECT 1 as slno,G.comp_code,G.pfct_code,CONCAT(YEAR(G.vrdate),'-',MONTH(G.vrdate)) as gl_code,CONCAT(MONTHNAME(G.vrdate),'-',YEAR(G.vrdate)) as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM GL_TRAN G WHERE 1=1 $strwhere AND G.FY_CODE='$macc_year'
								AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

								    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.gl_code");
	         		}else if($field_Type == 'DAILY'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
								(
								SELECT 0 as slno,B.comp_code,B.pfct_code,B.FY_CODE as gl_code,''  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_GLBAL B,MASTER_COMP P WHERE B.COMP_CODE=P.COMP_CODE $strwhere1 AND B.FY_CODE='$macc_year'
								UNION ALL
								SELECT 1 as slno,G.comp_code,G.pfct_code,G.vrdate as gl_code,CONCAT(DAY(G.vrdate),'-',MONTHNAME(G.vrdate),'-',YEAR(G.vrdate)) as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM GL_TRAN G WHERE 1=1 $strwhere AND G.FY_CODE='$macc_year'
								AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

								    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.slno,S.gl_code");
	         		}else if($field_Type == 'TNATURE'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
								(
								SELECT 0 as slno,B.comp_code,B.pfct_code,B.FY_CODE as gl_code,''  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_GLBAL B,MASTER_COMP P WHERE B.COMP_CODE=P.COMP_CODE $strwhere1 AND B.FY_CODE='$macc_year'
								UNION ALL
								SELECT 1 as slno,G.comp_code,G.pfct_code,G.TRAN_CODE as gl_code,T.TRAN_HEAD as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM GL_TRAN G,MASTER_TRANSACTION T WHERE G.TRAN_CODE=T.TRAN_CODE $strwhere AND G.FY_CODE='$macc_year'
								AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

								    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.slno,S.gl_code");
	         		}else if($field_Type == 'SERIES'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
							(
							SELECT 0 as slno,B.comp_code,B.pfct_code,B.FY_CODE as gl_code,''  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_GLBAL B,MASTER_COMP P WHERE B.COMP_CODE=P.COMP_CODE $strwhere1 AND B.FY_CODE='$macc_year'
							UNION ALL
							SELECT 1 as slno,G.comp_code,G.pfct_code,G.SERIES_CODE as gl_code,T.SERIES_NAME as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM GL_TRAN G,MASTER_CONFIG T WHERE G.COMP_CODE=T.COMP_CODE AND G.TRAN_CODE=T.TRAN_CODE AND G.SERIES_CODE=T.SERIES_CODE $strwhere AND G.FY_CODE='$macc_year'
								AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'
							    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.slno,S.gl_code");
	         		}else if($field_Type == 'REVACC'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
								(
								SELECT 0 as slno,B.comp_code,B.pfct_code,B.FY_CODE as gl_code,''  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_GLBAL B,MASTER_COMP P WHERE B.COMP_CODE=P.COMP_CODE $strwhere1 AND B.FY_CODE='$macc_year'
								UNION ALL
								SELECT 1 as slno,G.comp_code,G.pfct_code,G.REF_CODE as gl_code,G.REF_NAME as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM GL_TRAN G WHERE 1=1 $strwhere AND G.FY_CODE='$macc_year'
								AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'
								    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.slno,S.gl_code");
	         		}else{
	         			$data = array();
	         		}

	         	}else if($acct_code){

	         		if($field_Type == 'COSTCENTER'){

	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
								(
								SELECT 0 as slno,B.comp_code,B.pfct_code,'' as gl_code,'OPENING BALANCE'  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_ACCBAL B WHERE 1=1 $strwhere1 AND B.FY_CODE='$macc_year'
								UNION ALL
								SELECT 1 as slno,G.comp_code,G.pfct_code,H.cost_code as gl_code,H.cost_name as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM ACC_TRAN G LEFT JOIN MASTER_COST H ON G.COST_CODE=H.COST_CODE WHERE 1=1 $strwhere AND G.FY_CODE='$macc_year'
								AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

								    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.slno");
		               
	         		}else if($field_Type == 'PROFITCENTER'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
							(
							SELECT 0 as slno,B.comp_code,B.pfct_code,B.pfct_code as gl_code,P.pfct_name  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_ACCBAL B,MASTER_PFCT P WHERE B.PFCT_CODE=P.PFCT_CODE $strwhere1 AND B.FY_CODE='$macc_year'
							UNION ALL
							SELECT 1 as slno,G.comp_code,G.pfct_code,H.pfct_code as gl_code,H.pfct_name as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM ACC_TRAN G LEFT JOIN MASTER_PFCT H ON G.PFCT_CODE=H.PFCT_CODE WHERE 1=1 $strwhere AND G.FY_CODE='$macc_year'
							AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

							    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.gl_code");

	         		}else if($field_Type == 'COMPANY'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
							(
							SELECT 0 as slno,B.comp_code,B.pfct_code,B.comp_code as gl_code,P.comp_name  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_ACCBAL B,MASTER_COMP P WHERE B.COMP_CODE=P.COMP_CODE $strwhere1 AND B.FY_CODE='$macc_year'
							UNION ALL
							SELECT 1 as slno,G.comp_code,G.pfct_code,H.COMP_CODE as gl_code,H.comp_name as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM ACC_TRAN G LEFT JOIN MASTER_COMP H ON G.COMP_CODE=H.COMP_CODE WHERE 1=1 $strwhere AND G.FY_CODE='$macc_year'
							AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

							    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.gl_code");
	         		}else if($field_Type == 'MONTHLY'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
								(
								SELECT 0 as slno,B.comp_code,B.pfct_code,B.FY_CODE as gl_code,''  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_ACCBAL B,MASTER_COMP P WHERE B.COMP_CODE=P.COMP_CODE $strwhere1 AND B.FY_CODE='$macc_year'
								UNION ALL
								SELECT 1 as slno,G.comp_code,G.pfct_code,CONCAT(YEAR(G.vrdate),'-',MONTH(G.vrdate)) as gl_code,CONCAT(MONTHNAME(G.vrdate),'-',YEAR(G.vrdate)) as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM ACC_TRAN G WHERE 1=1 $strwhere AND G.FY_CODE='$macc_year'
								AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

								    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.gl_code");

	         		}else if($field_Type == 'DAILY'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
								(
								SELECT 0 as slno,B.comp_code,B.pfct_code,B.FY_CODE as gl_code,''  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_ACCBAL B,MASTER_COMP P WHERE B.COMP_CODE=P.COMP_CODE $strwhere1 AND B.FY_CODE='$macc_year'
								UNION ALL
								SELECT 1 as slno,G.comp_code,G.pfct_code,G.vrdate as gl_code,CONCAT(DAY(G.vrdate),'-',MONTHNAME(G.vrdate),'-',YEAR(G.vrdate)) as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM ACC_TRAN G WHERE 1=1 $strwhere AND G.FY_CODE='$macc_year'
								AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

								    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.slno,S.gl_code");
	         		}else if($field_Type == 'TNATURE'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
								(
								SELECT 0 as slno,B.comp_code,B.pfct_code,B.FY_CODE as gl_code,''  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_ACCBAL B,MASTER_COMP P WHERE B.COMP_CODE=P.COMP_CODE $strwhere1 AND B.FY_CODE='$macc_year'
								UNION ALL
								SELECT 1 as slno,G.comp_code,G.pfct_code,G.TRAN_CODE as gl_code,T.TRAN_HEAD as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM ACC_TRAN G,MASTER_TRANSACTION T WHERE G.TRAN_CODE=T.TRAN_CODE $strwhere AND G.FY_CODE='$macc_year'
								AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

								    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.slno,S.gl_code"
							);
	         		}else if($field_Type == 'SERIES'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
							(
							SELECT 0 as slno,B.comp_code,B.pfct_code,B.FY_CODE as gl_code,''  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_ACCBAL B,MASTER_COMP P WHERE B.COMP_CODE=P.COMP_CODE $strwhere1 AND B.FY_CODE='$macc_year'
							UNION ALL
							SELECT 1 as slno,G.comp_code,G.pfct_code,G.SERIES_CODE as gl_code,T.SERIES_NAME as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM ACC_TRAN G,MASTER_CONFIG T WHERE G.COMP_CODE=T.COMP_CODE AND G.TRAN_CODE=T.TRAN_CODE AND G.SERIES_CODE=T.SERIES_CODE $strwhere AND G.FY_CODE='$macc_year'
								AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'
							    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.slno,S.gl_code");
	         		}else if($field_Type == 'REVACC'){
	         			$data = DB::select("SELECT S.slno,S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
								(
								SELECT 0 as slno,B.comp_code,B.pfct_code,B.FY_CODE as gl_code,''  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_ACCBAL B,MASTER_COMP P WHERE B.COMP_CODE=P.COMP_CODE $strwhere1 AND B.FY_CODE='$macc_year'
								UNION ALL
								SELECT 1 as slno,G.comp_code,G.pfct_code,G.REF_CODE as gl_code,G.REF_NAME as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM ACC_TRAN G WHERE 1=1 $strwhere AND G.FY_CODE='$macc_year'
								AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'
								    ) S GROUP BY S.comp_code,S.gl_code ORDER BY S.slno,S.gl_code");
	         		}else{
	         			$data = array();
	         		}

	         	}else if($glschCode){
	         		//DB::enableQueryLog();
	         		$data = DB::select("SELECT S.comp_code,S.pfct_code,S.gl_code, S.gl_name,SUM(S.opDrAmt) AS opDrAmt,SUM(S.opCrAmt) AS opCrAmt,SUM(S.DrAmt) AS DrAmt,SUM(S.CrAmt) AS CrAmt FROM 
							(
							SELECT B.comp_code,B.pfct_code,L.gl_code as gl_code, L.gl_name  as gl_name, B.YROPDR as opDrAmt,B.YROPCR as opCrAmt,0 as DrAmt,0 as CrAmt FROM MASTER_GLBAL B, MASTER_GL L, MASTER_GLSCH H WHERE B.GL_CODE=L.GL_CODE AND L.GLSCH_CODE=H.GLSCH_CODE AND H.GLSCH_CODE='$glschCode' $strwhere1 AND B.FY_CODE='$macc_year'
							UNION ALL
							SELECT G.comp_code,G.pfct_code,L.gl_code as gl_code,L.gl_name as gl_name, 0 as opDrAmt,0 as opCrAmt,G.dramt as DrAmt,G.cramt as CrAmt FROM GL_TRAN G, MASTER_GL L, MASTER_GLSCH H WHERE G.GL_CODE=L.GL_CODE AND L.GLSCH_CODE=H.GLSCH_CODE AND H.GLSCH_CODE='$glschCode' $strwhere AND G.FY_CODE='$macc_year'
							AND G.VRDATE BETWEEN '$from_date1' AND '$to_date1'

							    ) S GROUP BY S.comp_code,S.gl_code");
	         		//dd(DB::getQueryLog());
	         	}else{
	         		$data = array();
	         	}

	         		return DataTables()->of($data)->addIndexColumn()->make(true);
		                                
		        /*}else{

	              	$data = array();
	              	return DataTables()->of($data)->addIndexColumn()->make(true);
		       	}*/

	  		}

        	//return view('admin.finance.report.account.acc_ledger_report',$userdata+compact('title','acc_list','acc_led_list','glCode_list','vrno_list','comp_list','company_name','cost_list','glsch_list'));
        
		}

		public function ReportAccSubLegderbillAloc(Request $request){

			$company_name = $request->session()->get('company_name');
			$explodeCnm   = explode('-', $company_name);
			$compCode     = $explodeCnm[0];
			$macc_year    = $request->session()->get('macc_year');
			$usertype     = $request->session()->get('user_type');
			$userid       = $request->session()->get('userid');
			$fieldType    = $request->input('fieldType');
			$accCode    = $request->input('accCode');

			$response_array = array();

			if ($request->ajax()) {

				if($fieldType == 'PENDINGBILLS'){
					//DB::enableQueryLog();
					$billdrAlocData = DB::select("SELECT * FROM `ACC_TRAN` WHERE COMP_CODE='$compCode' AND ACC_CODE='$accCode' AND DRAMT - DRALLOC > 0");
					//dd(DB::getQueryLog());
					$billcrAlocData = DB::select("SELECT * FROM `ACC_TRAN` WHERE COMP_CODE='$compCode' AND ACC_CODE='$accCode' AND CRAMT - CRALLOC > 0");
				}else{
					$billdrAlocData = '';
					$billcrAlocData = '';
				}

				if($billdrAlocData || $billcrAlocData){

					$response_array['response'] = 'success';
					$response_array['datadr']   = $billdrAlocData;
					$response_array['datacr']   = $billcrAlocData;
		           	echo $data = json_encode($response_array);

				}else{

					$response_array['response'] = 'error';
					$response_array['datadr']   = '';
					$response_array['datacr']   = '';
	                $data = json_encode($response_array);
	                print_r($data);
					
				}

			}else{

				$response_array['response'] = 'error';
				$response_array['datadr']   = '';
				$response_array['datacr']   = '';
                $data = json_encode($response_array);
                print_r($data);
	    	}

		}
/* -------------- END : ACCOUNT LEDGER REPORT ------------------ */

/* ------------- START : TRIAL BALENCE REPORT ---------- */

		public function ReportTrialBal(Request $request){

			$company_name = $request->session()->get('company_name');
			$explodeCnm   = explode('-', $company_name);
			$compCode     = $explodeCnm[0];

			$bgdate       = $request->session()->get('yrbgdate');
			$yrbgdate     = date("Y-m-d", strtotime($bgdate));

			$macc_year    = $request->session()->get('macc_year');
			
			$usertype     = $request->session()->get('user_type');
			$userid       = $request->session()->get('userid');
			$searchType = $request->search_type;

			// print_r($searchType);
			

        	 if ($request->ajax()) {

            	if (!empty($request->from_date)) {
                
	                $from_date1 = date("Y-m-d", strtotime($request->from_date));
	                $to_date1   = date("Y-m-d", strtotime($request->to_date));

	                $strwhere='';
	                if(isset($from_date1)  && trim($from_date1)!="")
	                {
	                    $strwhere .="AND vr_date BETWEEN '$from_date1' AND '$to_date1'";
	                }

	                if($searchType == 'GL'){

	                	//DB::enableQueryLog();
	                	$data= DB::select("SELECT t.GL_CODE,m.gl_name as gl_name, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt>=0, t.yropdr-t.yropcr+t.yrdramt-t.yrcramt,0) as cldramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt<0, abs(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt),0) as clcramt FROM
						(
						SELECT GL_CODE,'' as gl_name, sum(a.yropdr) as yropdr, sum(a.yropcr) as yropcr, sum(a.yrdramt) as yrdramt, sum(a.yrcramt) as yrcramt, 0 as cldramt, 0 as clcramt FROM
						(
							#Bring year opening balance
					 	SELECT '' as GL_CODE, yropdr as yropdr, yropcr as yropcr, 0 as yrdramt, 0 as yrcramt,'' as gl_name FROM MASTER_GLBAL WHERE comp_code='$compCode' and FY_CODE='$macc_year'
						UNION ALL
							#Bring transactions during year opening and before from date
						SELECT GL_CODE, dramt as yropdr, cramt as yropcr, 0 as yrdramt, 0 as yrcramt,'' as gl_name FROM GL_TRAN WHERE comp_code='$compCode' and vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY)
						UNION ALL   
							#Bring transactions during from date and to date
						SELECT GL_CODE, 0 as yropdr, 0 as yropcr, if(dramt is NULL,0,dramt) as yrdramt, if(cramt is NULL,0,cramt) as yrcramt,'' as gl_name FROM GL_TRAN WHERE comp_code='$compCode' and vrdate BETWEEN '$from_date1' AND '$to_date1'
						) a group by a.GL_CODE order by a.GL_CODE) t,MASTER_GL m where m.gl_code=t.gl_code");
	                	//dd(DB::getQueryLog());
		            
	              		return DataTables()->of($data)->addIndexColumn()->make(true);

					}else if($searchType == 'Account'){
                         
						// DB::enableQueryLog();
                      
						if($from_date1 == $yrbgdate){
						 // DB::enableQueryLog();
                          
                          $data= DB::select("SELECT t.ACC_CODE as GL_CODE ,m.acc_name as gl_name, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt>=0, t.yropdr-t.yropcr+t.yrdramt-t.yrcramt,0) as cldramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt<0, abs(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt),0) as clcramt FROM
							(
							SELECT ACC_CODE,acc_name, sum(a.yropdr) as yropdr, sum(a.yropcr) as yropcr, sum(a.yrdramt) as yrdramt, sum(a.yrcramt) as yrcramt, 0 as cldramt, 0 as clcramt FROM
							(
								#Bring year opening balance
						 	SELECT ACC_CODE, yropdr as yropdr, yropcr as yropcr, 0 as yrdramt, 0 as yrcramt,acc_name FROM MASTER_ACCBAL WHERE comp_code='$compCode' and FY_CODE='$macc_year'
							UNION ALL
								
							
								#Bring transactions during from date and to date
							SELECT ACC_CODE, 0 as yropdr, 0 as yropcr,dramt as yrdramt, cramt as yrcramt, acc_name FROM ACC_TRAN WHERE comp_code='$compCode' and vrdate BETWEEN '$from_date1' AND '$to_date1'
							) a group by a.ACC_CODE order by a.ACC_CODE) t,MASTER_ACC m where m.acc_code=t.acc_code");

                          // dd(DB::getQueryLog());
						}else{

							$data= DB::select("SELECT t.ACC_CODE as GL_CODE,m.acc_name as gl_name, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt>=0, t.yropdr-t.yropcr+t.yrdramt-t.yrcramt,0) as cldramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt<0, abs(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt),0) as clcramt FROM
							(
							SELECT ACC_CODE, acc_name, sum(a.yropdr) as yropdr, sum(a.yropcr) as yropcr, sum(a.yrdramt) as yrdramt, sum(a.yrcramt) as yrcramt, 0 as cldramt, 0 as clcramt FROM
							(
								#Bring year opening balance
						 	SELECT ACC_CODE, yropdr as yropdr, yropcr as yropcr, 0 as yrdramt, 0 as yrcramt,acc_name FROM MASTER_ACCBAL WHERE comp_code='$compCode' and FY_CODE='$macc_year'
							UNION ALL
								#Bring transactions during year opening and before from date
							SELECT ACC_CODE, dramt as yropdr, cramt as yropcr, 0 as yrdramt, 0 as yrcramt,acc_name FROM ACC_TRAN WHERE comp_code='$compCode' and vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY)
							UNION ALL   
								#Bring transactions during from date and to date
							SELECT ACC_CODE, 0 as yropdr, 0 as yropcr, dramt as yrdramt, cramt as yrcramt, acc_name FROM ACC_TRAN WHERE comp_code='$compCode' and vrdate BETWEEN '$from_date1' AND '$to_date1'
							) a group by a.ACC_CODE order by a.ACC_CODE) t,MASTER_ACC m where m.acc_code=t.acc_code");

						}
						
	                	
		            
	              		return DataTables()->of($data)->addIndexColumn()->make(true);

					}else if($searchType == 'Both'){
                        //DB::enableQueryLog();
						// print_r('data');

						$data2= DB::select("SELECT  S.GL_CODE,S.GL_NAME as gl_name,S.ACC_CODE as acc_code,S.ACC_NAME as acc_name, S.YROPDR, S.YROPCR, S.YRDRAMT, S.YRCRAMT, S.CLDRAMT, S.CLCRAMT        
      FROM (
          SELECT t.GL_CODE,m.gl_name as gl_name,t.acc_code,t.acc_name, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt>=0, t.yropdr-t.yropcr+t.yrdramt-t.yrcramt,0) as cldramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt<0, abs(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt),0) as clcramt FROM
     (
         SELECT GL_CODE,GL_NAME as gl_name,acc_code,acc_name, sum(yropdr) as yropdr, sum(yropcr) as yropcr, sum(yrdramt) as yrdramt, sum(a.yrcramt) as yrcramt, 0 as cldramt, 0 as clcramt FROM
     (

#Bring year opening balance
     SELECT GL_CODE as GL_CODE,GL_NAME as gl_name,'' as acc_code,'' as acc_name, yropdr as yropdr, yropcr as yropcr, 0 as yrdramt, 0 as yrcramt FROM MASTER_GLBAL WHERE comp_code='$compCode' and FY_CODE='$macc_year' AND GL_CODE NOT IN (SELECT DRGL_CODE FROM MASTER_ACCTYPE UNION ALL SELECT CRGL_CODE FROM MASTER_ACCTYPE)
     UNION ALL
      #Bring transactions during year opening and before from date
      SELECT GL_CODE,GL_NAME as gl_name,'' as acc_code,'' as acc_name, dramt as yropdr, cramt as yropcr, 0 as yrdramt, 0 as yrcramt FROM GL_TRAN WHERE comp_code='$compCode' and vrdate BETWEEN '$from_date1' AND DATE_SUB('$from_date1',INTERVAL 1 DAY) AND GL_CODE NOT IN (SELECT DRGL_CODE FROM MASTER_ACCTYPE UNION ALL SELECT CRGL_CODE FROM MASTER_ACCTYPE)
      UNION ALL   
      #Bring transactions during from date and to date
      SELECT GL_CODE,GL_NAME,'' as acc_code,'' as acc_name, 0 as yropdr, 0 as yropcr, if(dramt is NULL,0,dramt) as yrdramt, if(cramt is NULL,0,cramt) as yrcramt FROM GL_TRAN WHERE comp_code='$compCode' and vrdate BETWEEN '$from_date1' AND '$to_date1' AND GL_CODE NOT IN (SELECT DRGL_CODE FROM MASTER_ACCTYPE UNION ALL SELECT CRGL_CODE FROM MASTER_ACCTYPE) ) a group by a.GL_CODE order by a.GL_CODE) t, MASTER_GL m where m.gl_code=t.gl_code 
 
 UNION ALL      
      
SELECT j.DRGL_CODE as GL_CODE,j.DRGL_NAME as gl_name,k.acc_code,m.acc_name, k.yropdr, k.yropcr, k.yrdramt, k.yrcramt, if(k.yropdr-k.yropcr+k.yrdramt-k.yrcramt>=0, k.yropdr-k.yropcr+k.yrdramt-k.yrcramt,0) as cldramt, if(k.yropdr-k.yropcr+k.yrdramt-k.yrcramt<0, abs(k.yropdr-k.yropcr+k.yrdramt-k.yrcramt),0) as clcramt FROM
              (
              SELECT ACC_CODE, acc_name, sum(a.yropdr) as yropdr, sum(a.yropcr) as yropcr, sum(a.yrdramt) as yrdramt, sum(a.yrcramt) as yrcramt, 0 as cldramt, 0 as clcramt FROM
              (
                #Bring year opening balance
              SELECT ACC_CODE,acc_name, yropdr as yropdr, yropcr as yropcr, 0 as yrdramt, 0 as yrcramt FROM MASTER_ACCBAL WHERE comp_code='$compCode' and FY_CODE='$macc_year'
              UNION ALL
                #Bring transactions during year opening and before from date
              SELECT ACC_CODE,acc_name, dramt as yropdr, cramt as yropcr, 0 as yrdramt, 0 as yrcramt FROM ACC_TRAN WHERE comp_code='$compCode' and vrdate BETWEEN '$from_date1' AND DATE_SUB('$from_date1',INTERVAL 1 DAY)
              UNION ALL   
                #Bring transactions during from date and to date
              SELECT ACC_CODE, acc_name, 0 as yropdr, 0 as yropcr, dramt as yrdramt, cramt as yrcramt FROM ACC_TRAN WHERE comp_code='$compCode' and vrdate BETWEEN '$from_date1' AND '$to_date1'
              ) a group by a.ACC_CODE order by a.ACC_CODE) k,MASTER_ACC m,MASTER_ACCTYPE j where m.acc_code=k.acc_code AND LEFT(k.ACC_CODE,1) = j.ATYPE_CODE
          
          ) S ORDER BY S.GL_CODE,S.GL_NAME,S.ACC_CODE,S.ACC_NAME");

						//dd(DB::getQueryLog());
						$data = json_decode(json_encode($data2),true);
						// echo '<PRE>';print_r($data);exit;
 						// dd(DB::getQueryLog());
						return DataTables()->of($data)->addIndexColumn()->make(true);

					}else{

						$data = array();

	                 	return DataTables()->of($data)->addIndexColumn()->make(true);
					}
             		
                                
	            }else{

	                $data = array();

	                 return DataTables()->of($data)->addIndexColumn()->make(true);
	            }

        	}

        	$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$compCode,'FY_CODE'=>$macc_year])->get();

	        foreach ($getdate as $key) {
	            $userdata['fromDate'] =  $key->FY_FROM_DATE;
	            $userdata['toDate']   =  $key->FY_TO_DATE;
	        }

	        $bgdate       = $request->session()->get('yrbgdate');
	        $Enddate       = $request->session()->get('yrenddate');
            
        	$title = 'Trial Balence Report';

        	return view('admin.finance.report.account.trial_balence_report',$userdata+compact('title','bgdate','Enddate'));
        
    	}

/* ------------- END : TRIAL BALENCE REPORT ---------- */	

    public function ReportSalesTransList(Request $request){

			//print_r('hi');exit;


		if ($request->ajax()) {

			//print_r($request->vrNo);exit;

			if (!empty($request->depotCode || $request->accountCode || $request->fromDate || $request->vrNo)) {


				$FromDate = $request->input('fromDate');
				$ToDate = $request->input('toDate');

				$bank = $request->input('depotCode');
				//print_r($bank);exit;

	    		$party = $request->input('accountCode');
	    		//print_r($party);exit;

	    		$vr_no = $request->input('vrNo');

				$from_date = date("Y-m-d", strtotime($FromDate));
				//print_r($from_date);exit;

				$to_date = date("Y-m-d", strtotime($ToDate));

				//print_r($to_date);exit;

			$company_name = $request->session()->get('company_name');
			
			$macc_year    = $request->session()->get('macc_year');
			
			$usertype     = $request->session()->get('user_type');

		    	
	    	if(isset($from_date)  && trim($from_date)!="")
	      	 {
	      		$strWhere="sales_head.vr_date BETWEEN '$from_date' and  '$to_date'";
	      	}

			 if(isset($bank)  && trim($bank)!="" && $usertype=='admin')
			{
				$strWhere="jv_tran.bank_code= '$bank' AND jv_tran.fiscal_year = '$macc_year'";
			}
			else if (isset($bank)  && trim($bank)!="" && ($usertype=='superAdmin' || $usertype=='user')) {

				$strWhere="jv_tran.bank_code='$bank' AND jv_tran.jr_date BETWEEN '$from_date' and  '$to_date' AND jv_tran.comp_name='$company_name'";
			}

			if(isset($party)  && trim($party)!="" && $usertype=='admin')
			{
				$strWhere="sales_head.acc_code= '$party' AND sales_head.fiscal_year = '$macc_year'";
			}
			else if(isset($party)  && trim($party)!="" && ($usertype=='superAdmin'&& $usertype=='user')){
				$strWhere="sales_head.acc_code= '$party' AND sales_head.vr_date BETWEEN '$from_date' AND  '$to_date' AND sales_head.comp_name='$company_name'";

			}
			if(isset($vr_no)  && trim($vr_no)!="" && $usertype=='admin')
			{
				$strWhere="sales_head.vr_no= '$vr_no' AND sales_head.fiscal_year = '$macc_year'";
			}
			else if(isset($vr_no)  && trim($vr_no)!="" && ($usertype=='superAdmin'&& $usertype=='user')){
				$strWhere="sales_head.vr_no= '$vr_no' AND sales_head.vr_date BETWEEN '$from_date' AND  '$to_date' AND sales_head.comp_name='$company_name'";

			}


			

		    $data = DB::select("SELECT sales_head.vr_no, sales_head.vr_date, sales_head.acc_code, sales_head.tax_code, sales_tax.tax_ind, sales_tax.tax_rate, sales_tax.tax_amt, sales_body.basic_amt, sales_body.dr_amount,master_party.acc_name FROM sales_head LEFT JOIN sales_body ON sales_head.id = sales_body.sales_head_id LEFT JOIN sales_tax ON sales_head.id = sales_tax.sales_head_id LEFT JOIN master_party ON sales_head.acc_code = master_party.acc_code WHERE $strWhere GROUP BY sales_head.id");

		    	/*$data = DB::select("SELECT jv_tran.jr_date,jv_tran.acc_name,jv_tran.acc_code, jv_tran.dr_amount,jv_tran.bank_code,jv_tran.cr_amount FROM jv_tran WHERE $strWhere");
*/
//print_r($data);exit;
				
			}else{

		   $company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			
			$explodeCnm = explode('-', $company_name);

            $comp_code = $explodeCnm[0];


			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

		    if($usertype=='admin'){

		    $strWhere="sales_head.fiscal_year = '$macc_year'";
		    }
		    else if($usertype=='superAdmin' || $usertype=='user'){
		    	
		    $strWhere="sales_head.vr_date BETWEEN '$from_date' and  '$to_date' AND sales_head.comp_code='$company_name'";
			}

				/*$data = DB::select("SELECT jv_tran.jr_date,jv_tran.acc_name,jv_tran.acc_code, jv_tran.dr_amount,jv_tran.bank_code,jv_tran.cr_amount FROM jv_tran WHERE $strWhere");*/

			 $data = DB::select("SELECT sales_head.id,sales_head.vr_no, sales_head.vr_date, sales_head.acc_code, sales_head.tax_code, sales_tax.tax_ind, sales_tax.tax_rate, sales_tax.tax_amt, sales_body.basic_amt, sales_body.dr_amount,master_party.acc_name FROM sales_head LEFT JOIN sales_body ON sales_head.id = sales_body.sales_head_id LEFT JOIN sales_tax ON sales_head.id = sales_tax.sales_head_id LEFT JOIN master_party ON sales_head.acc_code = master_party.acc_code  WHERE $strWhere GROUP BY sales_head.id");
			 	//print_r($data);exit;

				//print_r($data);exit;

				/*$data = DB::select("SELECT outward_trans.*, master_depot.depot_name as depot_name,master_acc.acc_name as party_name FROM outward_trans 
			left JOIN master_depot ON master_depot.depot_code =outward_trans.depot_code 
			left JOIN master_acc ON master_acc.acc_code =outward_trans.acc_code 
			left JOIN master_transporter ON master_transporter.code =outward_trans.trans_code where 1=1  $strWhere");*/

			}

			return DataTables()->of($data)->make(true);
			
		}

		    $company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			

	        $explodeCnm = explode('-', $company_name);

            $comp_code = $explodeCnm[0];

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

			//print_r($getdate);exit;

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

		$title = 'SAP Vs Dispatch Report';

		$user_list       = DB::table('master_bank')->get();
		
		$acc_list        = DB::table('master_party')->get();

		if(isset($company_name)){

		return view('admin.finance.report.sales_trans_report',compact('title','user_list','acc_list','from_date','to_date'));
		}else{
		return redirect('/useractivity');
	}


	}

	public function GetTaxData(Request $request){

    	 $id = $request->post('id');
    	// print_r($id);exit();

    	
    	//print_r($gettaxcode);exit;

    	 if (!empty($id)) {

	    	$gettax = DB::table('sales_head')->where('id',$id)->get()->first();
	    	$gettaxcode = DB::table('sales_tax')->where('sales_order_head_id',$id)->get();
	    	
    		if ($gettaxcode) {

    			$response_array['response'] = 'success';
	            $response_array['taxdata'] = $gettaxcode ;
	            $response_array['taxcode'] = $gettax ;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['taxdata'] = '' ;

                $data = json_encode($gettaxcode);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }
      
      /*if(!empty($gettaxcode))
      {
        $response = '';
        foreach($gettaxcode as $row) 
        {
          $response = '<tr>
      <th scope="row">'.$row->tax_ind.'</th>
      <td>'.$row->rate_ind.'</td>
      <td>'.$row->tax_rate.'</td>
      <td>'.$row->tax_amt.'</td>
    </tr>';
        }
      }
      else
      {
        $response = '<option value="">--SELECT--</option>';
      }
      echo $response;exit;

    }*/
}


    public function SapDespatchAjax(Request $request){

    	 $validator = Validator::make($request->all(), [
            'dept_code' => 'required',
            'acct_code' => 'required',
        ]);

    	 if ($validator->fails()) {

          //  return response()->json(['error'=>$validator->errors()], 401);

            $response_array['response'] = 'validation_error';
            $response_array['validation'] = $validator->errors();

            $data = json_encode($response_array);

            print_r($data);


        }else{

		 $response_array = array();

		if ($request->ajax()) {


	    	$dept_code = $request->input('dept_code');
	    	$acct_code = $request->input('acct_code');
	    	

	    	$serachSaplist = DB::select("SELECT inward_trans.acc_code, inward_trans.item_code, inward_trans.vr_date, inward_trans.sto_qty, inward_trans.depot_code, sap_bill.vr_date, sap_bill.truck_no, sap_bill.qty_issued, sap_bill.depot_code FROM inward_trans,sap_bill WHERE inward_trans.item_code='JSWPSC-01' AND inward_trans.depot_code='$dept_code' AND sap_bill.acct_code='$acct_code' ");

	    	

    		if ($serachSaplist) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $serachSaplist ;

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

    }

/*Report/MIS -> Bill Register*/

  public function ReportSapList(Request $request){

  		
  		if ($request->ajax()) {

			if (!empty($request->depotCode || $request->accCode || $request->formDate || $request->transCode)) {


				
		    	
				$depot      = $request->depotCode;
				$party      = $request->accCode;
				$from_date  = date("Y-m-d", strtotime($request->formDate));
				$to_date    = date("Y-m-d", strtotime($request->toDate));
				$trans_code = $request->transCode;

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');

			$userid	= $request->session()->get('userid');

			$explodeCnm = explode('-', $company_name);

            $comp_code = $explodeCnm[0];

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date1 =$fy_from_date;
		    $to_date1 =$fy_to_date;

				
			if(isset($from_date)  && trim($from_date)!="")
	      	 {
	      		$strWhere="AND `vr_date` BETWEEN '$from_date' and  '$to_date' AND sap_bill.comp_code='$company_name' AND sap_bill.fy_year= '$macc_year'";
	      	}
	      	else if(isset($from_date)  && trim($from_date)!="" && ($usertype=='superAdmin' || $usertype=='user')){
		    	$strWhere="AND `vr_date` BETWEEN '$from_date' and  '$to_date' AND sap_bill.comp_code='$company_name' AND sap_bill.fy_year= '$macc_year' AND created_by = '$userid'";
		    }

			if(isset($depot)  && trim($depot)!="" && $usertype=='admin')
			{
				$strWhere="AND  sap_bill.depot_code= '$depot' AND sap_bill.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
			else if(isset($depot)  && trim($depot)!="" && ($usertype=='superAdmin' || $usertype=='user')){

				$strWhere="AND  sap_bill.depot_code= '$depot' AND sap_bill.vr_date BETWEEN '$from_date1' and  '$to_date1' AND comp_code='$company_name' AND sap_bill.fy_year= '$macc_year'  AND created_by = '$userid'";
			}

			if(isset($party)  && trim($party)!="" && $usertype=='admin')
			{
				$strWhere="AND  sap_bill.acct_code= '$party' AND sap_bill.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
			else if(isset($party)  && trim($party)!="" && ($usertype=='superAdmin' || $usertype=='user')){
				$strWhere="AND  sap_bill.acct_code= '$party' AND sap_bill.vr_date BETWEEN '$from_date1' and  '$to_date1' AND comp_code='$company_name' AND sap_bill.fy_year= '$macc_year'  AND created_by = '$userid'";
			}

			if(isset($trans_code)  && trim($trans_code)!="" && $usertype=='admin')
			{
				$strWhere="AND  sap_bill.acct_code= '$trans_code' AND sap_bill.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
			else if(isset($trans_code)  && trim($trans_code)!="" && ($usertype=='superAdmin' || $usertype=='user')){
				$strWhere="AND  sap_bill.acct_code= '$trans_code' AND sap_bill.vr_date BETWEEN '$from_date1' and  '$to_date1' AND comp_code='$company_name' AND sap_bill.fy_year= '$macc_year'  AND created_by = '$userid'";
			}

			$data = DB::select("SELECT *,(SELECT depot_name FROM master_depot WHERE depot_code=sap_bill.depot_code) as depot_code,(SELECT acc_name FROM master_acc WHERE acc_code=sap_bill.acct_code) as acc_code,(SELECT name FROM master_transporter WHERE code=sap_bill.trpt_code) as trans_name,(SELECT name FROM master_area WHERE code=sap_bill.area_code) as area_name FROM `sap_bill` WHERE 1=1 $strWhere");

			/*$data = DB::table('sap_bill')
				->select('sap_bill.*', 'master_acc.acc_name as acc_code','master_depot.depot_name as depot_code','master_transporter.code as trans_name','master_area.name as area_name')
           		->leftjoin('master_depot', 'sap_bill.depot_code', '=', 'master_depot.depot_code')
           		->leftjoin('master_acc', 'sap_bill.acct_code', '=', 'master_acc.acc_code')
           		->leftjoin('master_transporter', 'sap_bill.trpt_code', '=', 'master_transporter.code')
           		->leftjoin('master_area', 'sap_bill.area_code', '=', 'master_area.code')
            	->whereRaw('1 = 1')
            	->where($strWhere)
            	->get();*/

			return DataTables()->of($data)->make(true);
				
		}else{

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');

			$userid	= $request->session()->get('userid');
			

	        $explodeCnm = explode('-', $company_name);

            $comp_code = $explodeCnm[0];

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

		     if($usertype=='admin'){

		    $strWhere="  AND   sap_bill.fy_year= '$macc_year' AND comp_code='$company_name'";
		    }
		    else if($usertype=='superAdmin' || $usertype=='user'){
		    	
		    $strWhere="  AND sap_bill.vr_date BETWEEN '$from_date' and  '$to_date' AND comp_code='$company_name' AND   sap_bill.fy_year= '$macc_year'  AND created_by = '$userid'";
			}


			$data = DB::select("SELECT *,(SELECT depot_name FROM master_depot WHERE depot_code=sap_bill.depot_code) as depot_code,(SELECT acc_name FROM master_acc WHERE acc_code=sap_bill.acct_code) as acc_code,(SELECT name FROM master_transporter WHERE code=sap_bill.trpt_code) as trans_name,(SELECT name FROM master_area WHERE code=sap_bill.area_code) as area_name FROM `sap_bill` where 1=1  $strWhere");

			return DataTables()->of($data)->make(true);
		}

		}

		$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');


			

	        $explodeCnm = explode('-', $company_name);

            $comp_code = $explodeCnm[0];

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;


  		$title = 'Bill Register';

		$user_list      = DB::table('master_depot')->get();
		
		$acc_list        = DB::table('master_acc')->get();

		$transpoter_list = DB::table('master_acc')->where('acctype_code','T')->get();

		
    return view('admin.cf.report.sap_list_report',compact('title','user_list','acc_list','transpoter_list','from_date','to_date'));
    }


  public function SapListSearchAjax(Request $request){

  		$validator = Validator::make($request->all(), [
           /* 'dept_code' => 'required',
            'acct_code' => 'required',
            'trans_code' => 'required',*/
        ]);

    	 if ($validator->fails()) {

          //  return response()->json(['error'=>$validator->errors()], 401);

            $response_array['response'] = 'validation_error';
            $response_array['validation'] = $validator->errors();

            $data = json_encode($response_array);

            print_r($data);


        }else{

		$response_array = array();

		if ($request->ajax()) {


	    	$dept_code = $request->input('dept_code');
	    	$acct_code = $request->input('acct_code');
	    	$trans_code = $request->input('trans_code');
	    	
	    	if(isset($dept_code)  && trim($dept_code)!=""){
	    		$AndString = " AND `depot_code`='$dept_code'";
	    	}
	    	if(isset($acct_code)  && trim($acct_code)!=""){
	    		$AndString = "AND `acct_code`='$acct_code' ";
	    	}
	    	if(isset($trans_code)  && trim($trans_code)!=""){
	    		$AndString = "AND `trpt_code`='$trans_code'";
	    	}
	    	
	    	$serachSaplist = DB::select("SELECT *,(SELECT depot_name FROM master_depot WHERE depot_code=sap_bill.depot_code) as depot_code,(SELECT acc_name FROM master_acc WHERE acc_code=sap_bill.acct_code) as acc_code,(SELECT name FROM master_transporter WHERE code=sap_bill.trpt_code) as trans_name,(SELECT name FROM master_area WHERE code=sap_bill.area_code) as area_name FROM `sap_bill` WHERE 1=1 $AndString");

	    	

    		if ($serachSaplist) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $serachSaplist ;

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

    }

/*Report/MIS -> Bill Register*/

/*Report/MIS -> Inward STO Register*/

    public function ReportInwardSto(Request $request){


    	if ($request->ajax()) {

			if (!empty($request->depotCode || $request->accCode || $request->formDate || $request->transCode)) {

		    	
				$depot     = $request->depotCode;
				$party     = $request->accCode;
				$from_date = date("Y-m-d", strtotime($request->formDate));

				$to_date   = date("Y-m-d", strtotime($request->toDate));
				//print_r($to_date);exit;
				$tran_code = $request->transCode;


			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');

			$userid	= $request->session()->get('userid');
			
			$explodeCnm = explode('-', $company_name);

            $comp_code = $explodeCnm[0];

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date1 =$fy_from_date;
		    $to_date1 =$fy_to_date;
				
			if(isset($from_date)  && trim($from_date)!="" && $usertype=='admin')
	      	 {
	      		$strWhere="  AND `vr_date` BETWEEN '$from_date' and  '$to_date' AND comp_code='$company_name' AND fy_year= '$macc_year'";
	      	}else if(isset($from_date)  && trim($from_date)!="" && ($usertype=='superAdmin' || $usertype=='user')){
		    	$strWhere="  AND `vr_date` BETWEEN '$from_date' and  '$to_date' AND comp_code='$company_name' AND fy_year= '$macc_year' AND inward_trans.created_by ='$userid'";
		    }


			if(isset($depot)  && trim($depot)!="" && $usertype=='admin')
			{
			$strWhere="  AND  inward_trans.depot_code= '$depot' AND inward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
		     else if(isset($depot)  && trim($depot)!="" && ($usertype=='superAdmin' || $usertype=='user')){
		    	$strWhere="  AND  inward_trans.depot_code= '$depot' AND inward_trans.vr_date BETWEEN '$from_date1' AND  '$to_date1' AND inward_trans.comp_code='$company_name' AND inward_trans.fy_year= '$macc_year' AND inward_trans.created_by ='$userid'";
		    }

			if(isset($party)  && trim($party)!="" && $usertype=='admin')
			{
				$strWhere=" AND   inward_trans.acc_code= '$party' AND inward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
			 else if(isset($party)  && trim($party)!="" && ($usertype=='superAdmin' || $usertype=='user')){
		    	$strWhere=" AND   inward_trans.acc_code= '$party' AND inward_trans.vr_date BETWEEN '$from_date1' AND  '$to_date1' AND inward_trans.comp_code='$company_name' AND inward_trans.fy_year= '$macc_year' AND inward_trans.created_by ='$userid'";
		    }

		    if(isset($tran_code)  && trim($tran_code)!="" && $usertype=='admin')
			{
				$strWhere=" AND   inward_trans.acc_code= '$tran_code' AND inward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
			 else if(isset($tran_code)  && trim($tran_code)!="" && ($usertype=='superAdmin' || $usertype=='user')){
		    	$strWhere=" AND   inward_trans.acc_code= '$tran_code' AND inward_trans.vr_date BETWEEN '$from_date1' AND  '$to_date1' AND inward_trans.comp_code='$company_name' AND inward_trans.fy_year= '$macc_year' AND inward_trans.created_by ='$userid'";
		    }

			$data = DB::select("SELECT *,(SELECT depot_name FROM master_depot WHERE depot_code=inward_trans.depot_code) as depot_nam,(SELECT acc_name FROM master_acc WHERE acc_code=inward_trans.acc_code) as acc_name,(SELECT name FROM master_transporter WHERE code=inward_trans.trpt_code) as trans_name FROM `inward_trans` where 1=1  $strWhere");

			return DataTables()->of($data)->make(true);
				
		}else{

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			
			$userid	= $request->session()->get('userid');

	        $explodeCnm = explode('-', $company_name);

            $comp_code = $explodeCnm[0];

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

		    if($usertype=='admin'){

		    $strWhere="  AND   inward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
		    }
		    if($usertype=='superAdmin' || $usertype=='user'){
		    	
		    $strWhere="  AND vr_date BETWEEN '$from_date' and  '$to_date' AND comp_code='$company_name' AND fy_year= '$macc_year' AND created_by ='$userid'";
			}

			$data = DB::select("SELECT *,(SELECT depot_name FROM master_depot WHERE depot_code=inward_trans.depot_code) as depot_nam,(SELECT acc_name FROM master_acc WHERE acc_code=inward_trans.acc_code) as acc_name,(SELECT name FROM master_transporter WHERE code=inward_trans.trpt_code) as trans_name FROM `inward_trans` where 1=1  $strWhere");

			return DataTables()->of($data)->make(true);
		}

		}

		    $company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');

			$userid	= $request->session()->get('userid');
			

	        $explodeCnm = explode('-', $company_name);

            $comp_code = $explodeCnm[0];

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

    	$title = 'Inward STO Register';

		$user_list       = DB::table('master_depot')->get();
		
		$acc_list       = DB::table('master_acc')->get();

		$transpoter_list = DB::table('master_acc')->where('acctype_code','T')->get();

		
    	return view('admin.cf.report.inward_sto_reg_report',compact('title','user_list','acc_list','transpoter_list','from_date','to_date'));
    	
    }


    public function InwardStoSearchAjax(Request $request){

  		$validator = Validator::make($request->all(), [
           	'dept_code' => 'required',
           	'acct_code' => 'required',
           	'trans_code' => 'required',
        ]);

    	 if ($validator->fails()) {

          //  return response()->json(['error'=>$validator->errors()], 401);

            $response_array['response'] = 'validation_error';
            $response_array['validation'] = $validator->errors();

            $data = json_encode($response_array);

            print_r($data);


        }else{

		$response_array = array();

		if ($request->ajax()) {


	    	$dept_code = $request->input('dept_code');
	    	$acct_code = $request->input('acct_code');
	    	$trans_code = $request->input('trans_code');

	    	$from_date = $request->input('from_date');
	    	$to_date = $request->input('to_date');

	    	
	    	
	    	/*if(isset($dept_code)  && trim($dept_code)!=""){
	    		$AndString = " `Depot`='$dept_code'";
	    	}
	    	if(isset($acct_code)  && trim($acct_code)!=""){
	    		$AndString = " `acc_code`='$acct_code' ";
	    	}
	    	if(isset($trans_code)  && trim($trans_code)!=""){
	    		$AndString = "inward_trans.trans_code='$trans_code'";
	    	}*/
	    	
	    	$serachSaplist = DB::select("SELECT *,(SELECT depot_name FROM master_depot WHERE depot_code=inward_trans.depot_code) as depot_nam,(SELECT acc_name FROM master_acc WHERE acc_code=inward_trans.acc_code) as acc_name,(SELECT name FROM master_transporter WHERE code=inward_trans.trpt_code) as trans_name FROM `inward_trans` WHERE inward_trans.depot_code='$dept_code' AND inward_trans.acc_code='$acct_code' AND inward_trans.trpt_code='$trans_code'");

	    	
	    	

    		if ($serachSaplist) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $serachSaplist ;

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

    }

/*Report/MIS -> Inward STO Register*/


/*Report/MIS -> Outward Despatch Report*/

public function OutwardDespatchReport(Request $request){

	//print_r($request->depotCode);

		if ($request->ajax()) {

			if (!empty($request->depotCode || $request->accCode || $request->formDate || $request->transCode)) {



		    	
				$depot     = $request->depotCode;
				$party     = $request->accCode;
				$from_date = date("Y-m-d", strtotime($request->formDate));

				$to_date   = date("Y-m-d", strtotime($request->toDate));

				$trans_code   = $request->transCode;

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			
			$explodeCnm = explode('-', $company_name);

            $comp_code = $explodeCnm[0];

			$userid	= $request->session()->get('userid');

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date1 =$fy_from_date;
		    $to_date1 =$fy_to_date;

				
			if(isset($from_date)  && trim($from_date)!="")
	      	 {
	      		$strWhere="  AND `tr_date` BETWEEN '$from_date' and  '$to_date' AND comp_code='$company_name'";
	      	}

			if(isset($depot)  && trim($depot)!="" && $usertype=='admin')
			{
			$strWhere="  AND   outward_trans.depot_code= '$depot' AND outward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
			else if(isset($depot)  && trim($depot)!="" && ($usertype=='superAdmin' || $usertype=='user')){
				$strWhere="  AND   outward_trans.depot_code= '$depot' AND `tr_date` BETWEEN '$from_date1' and  '$to_date1' AND comp_code='$company_name' AND outward_trans.fy_year= '$macc_year' AND created_by = '$userid'";
			}

			if(isset($party)  && trim($party)!="" && $usertype=='admin')
			{
				$strWhere=" AND   outward_trans.acc_code= '$party' AND outward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
			}

			else if(isset($party)  && trim($party)!="" && ($usertype=='superAdmin' || $usertype=='user'))
			{
				$strWhere=" AND   outward_trans.acc_code= '$party' AND `tr_date` BETWEEN '$from_date1' and  '$to_date1' AND comp_code='$company_name' AND outward_trans.fy_year= '$macc_year' AND created_by = '$userid'";
			}

			if(isset($trans_code)  && trim($trans_code)!="" && $usertype=='admin')
			{
				$strWhere=" AND   outward_trans.acc_code= '$trans_code' AND outward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
			}

			else if(isset($trans_code)  && trim($trans_code)!="" && ($usertype=='superAdmin' || $usertype=='user'))
			{
				$strWhere=" AND   outward_trans.acc_code= '$trans_code' AND `tr_date` BETWEEN '$from_date1' and  '$to_date1' AND comp_code='$company_name' AND outward_trans.fy_year= '$macc_year' AND created_by = '$userid'";
			}

			$data = DB::select("SELECT outward_trans.*, master_depot.depot_name as depot_name,master_acc.acc_name as party_name FROM outward_trans 
			left JOIN master_depot ON master_depot.depot_code =outward_trans.depot_code 
			left JOIN master_acc ON master_acc.acc_code =outward_trans.acc_code 
			left JOIN master_transporter ON master_transporter.code =outward_trans.trans_code where 1=1  $strWhere");

			return DataTables()->of($data)->make(true);
				
		}else{

			

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');

			$userid	= $request->session()->get('userid');
			

	        $explodeCnm = explode('-', $company_name);

            $comp_code = $explodeCnm[0];

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

		    if($usertype=='admin'){

		    $strWhere="  AND   outward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
		    }
		    else if($usertype=='superAdmin' || $usertype=='user'){
		    	
		    $strWhere="  AND `tr_date` BETWEEN '$from_date' and  '$to_date' AND comp_code='$company_name' AND   outward_trans.fy_year= '$macc_year' AND created_by = '$userid'";
			}

			$data = DB::select("SELECT outward_trans.*, master_depot.depot_name as depot_name,master_acc.acc_name as party_name FROM outward_trans 
			left JOIN master_depot ON master_depot.depot_code =outward_trans.depot_code 
			left JOIN master_acc ON master_acc.acc_code =outward_trans.acc_code 
			left JOIN master_transporter ON master_transporter.code =outward_trans.trans_code where 1=1  $strWhere");



			return DataTables()->of($data)->make(true);
		}

		}

		$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			

	        $explodeCnm = explode('-', $company_name);

            $comp_code = $explodeCnm[0];

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

		$title = 'Outward Dispatch Register';

    	$depot_list = DB::table('master_depot')->get();

        $dealer_list = DB::table('master_acc')->get();
       
        $transporter_list = DB::table('master_acc')->where('acctype_code','T')->get();


		return view('admin.cf.report.view_outward_dispatch',compact('title','depot_list','dealer_list','transporter_list','from_date','to_date'));

	}




/*report / MIS*/



public function CashBankReportPdf(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->gl_code || $request->acct_code || $request->vr_num || $request->to_date )) {

				$bankCode     = $request->gl_code;
				$acct_code    = $request->acct_code;
				$vr_num       = $request->vr_num;
				$vr_type      = $request->vr_type;
				
				$company_name = $request->session()->get('company_name');
				$explodeCnm   = explode('-', $company_name);
				$compCode     = $explodeCnm[0];
				$macc_year    = $request->session()->get('macc_year');
				$ExYEar       = explode('-', $macc_year);
				$yearstart    =  $ExYEar[0]-1;
				$yearend      =  $ExYEar[1]-1;
				$backYear     =  $yearstart.'-'.$yearend;
				
				$usertype     = $request->session()->get('user_type');
				$userid       = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));

				$to_date1   = date("Y-m-d", strtotime($request->to_date));

                DB::table('cb_tran_temp')->truncate();

                $strWhere='';
                
                if(isset($from_date1)  && trim($from_date1)!="")
	      	 	{
	      			$strWhere .=" AND `vr_date` BETWEEN '$from_date1' and  '$to_date1'";
	      		}

                if(isset($bankCode)  && trim($bankCode)!="")
                {
                 $strWhere .= "AND series_code='$bankCode'";
                }

             	if(isset($acct_code)  && trim($acct_code)!="")
             	{
             		$strWhere .= "AND acc_code='$acct_code'";
             	}

             	if(isset($vr_num)  && trim($vr_num)!="")
             	{
             		$strWhere .= "AND vrno='$vr_num'";
             	}

             	if(isset($vr_type)  && trim($vr_type)!="")
             	{
             		$strWhere .= "AND vr_type='$vr_type'";
             	}

             	//DB::enableQueryLog();
                
                $data0 = DB::select("SELECT *,(SELECT tran_head FROM master_transaction WHERE tran_code=cb_tran.tran_code) as tran_head FROM `cb_tran` where 1=1  $strWhere AND fy_code='$macc_year' ORDER BY  vrno desc");
                //dd(DB::getQueryLog());
                $data11 = DB::table('cb_tran')
                			->leftjoin('master_transaction', 'cb_tran.tran_code', '=', 'master_transaction.tran_code');

    			if(isset($from_date1)  && trim($from_date1)!="")
                {
                    $data11->whereBetween('vr_date', [$from_date1, $to_date1]);
                }

                if(isset($bankCode)  && trim($bankCode)!="")
             	{
             		$data11->where('series_code',$bankCode);
             	}

    			if(isset($acct_code)  && trim($acct_code)!="")
    			{
                   $data11->where('acc_code',$acct_code);
                }

                if(isset($vr_num)  && trim($vr_num)!="")
             	{
             		$data11->where('vrno',$vr_num);
             	}

             	if(isset($vr_type)  && trim($vr_type)!="")
             	{
             		$data11->where('vr_type',$vr_type);
             	}
                $data11->where('cb_tran.company_code',$compCode);
                $data11->where('cb_tran.fy_code',$backYear);
                $GetData1 = $data11->select('cb_tran.*', 'master_transaction.tran_head')->get()->toArray();

                $data1 = json_decode(json_encode($GetData1), true); 

    			$bal_dr_amt =0;
                $bal_cr_amt =0;

                //print_r($data1);

                foreach ($data1 as $key) {
                    $bal_dr_amt += $key['dr_amount'];
                    $bal_cr_amt += $key['cr_amount'];
                }
                 $data01 = json_decode(json_encode($data0), true); 



                  $getData = array();
	                    $counter = 1;
	                    $counter1 = 1;

                 foreach ($data01 as $row) { 

            	if($row['dr_amount']){
            		$amnt = $row['dr_amount'];
            		$baltypeI ='Dr';
            	}else if($row['cr_amount']){
            		$amnt = $row['cr_amount'];
            		$baltypeI ='Cr';
            	}

            	if($bal_dr_amt > $bal_cr_amt){
            		$balence = $bal_dr_amt - $bal_cr_amt;
                	$getcrDrval = 'Dr';
            	}else if($bal_cr_amt > $bal_dr_amt){
            		$balence = $bal_cr_amt - $bal_dr_amt;
                		$getcrDrval = 'Cr';
                }else{
                	$balence = 0;
                		$getcrDrval = '--';
                }

                if($getcrDrval == '--'){
                	if($row['dr_amount']){
                		$open_bal = $amnt;
                		$getcrDrval = 'Dr';
                	}else if($row['cr_amount']){
                		$open_bal = $amnt;
                		$getcrDrval = 'Cr';
                	}else{
                		$open_bal = 0;
                		$getcrDrval = '--';
                	}
                }else if($getcrDrval =='Dr'){
                	if($row['dr_amount']){
                		$open_bal = $balence + $amnt;
                		$getcrDrval = 'Dr';
                	}else if($row['cr_amount'] ){
                		$open_bal = abs($balence - $amnt);
                		if($balence > $row['cr_amount']){
                			$getcrDrval = 'Dr';
                		}else if($row['cr_amount'] > $balence){
                			$getcrDrval = 'Cr';
                		}else{
                			$getcrDrval = '--';
                		}
                	}else{
                		$open_bal = 0;
                		$getcrDrval = '--';
                	}
                }else if($getcrDrval =='Cr'){
                	if($row['cr_amount']){
                		$open_bal = $balence + $amnt;
                		$getcrDrval = 'Cr';
                	}else if($row['dr_amount'] ){
                		$open_bal = abs($balence - $amnt);
                		if($balence > $row['dr_amount']){
                			$getcrDrval = 'Cr';
                		}else if( $row['dr_amount'] > $balence){
                			$getcrDrval = 'Dr';
                		}else{
                			$getcrDrval = '--';
                		}
                	}else{
                		$open_bal = 0;
                		$getcrDrval = '--';
                	}
                }else{
                	$open_bal = 0;
                	$getcrDrval = '--';
                }
            	

            	$row['bal_dr_amt'] = $bal_dr_amt;
            	$row['bal_cr_amt'] = $bal_cr_amt;
            	$getData[] = $row;

            	if($counter == $counter1){

            		$arraydta =  array(
						'company_code'    => $row['company_code'],
						'pfct_code'       => $row['pfct_code'],
						'pfct_name'       => $row['pfct_name'],
						'fy_code'         => $row['fy_code'],
						'tran_code'       => $row['tran_code'],
						'series_code'     => $row['series_code'],
						'vrno'            => $row['vrno'],
						'slno'            => $row['slno'],
						'vr_type'         => $row['vr_type'],
						'vr_date'         => $row['vr_date'],
						'gl_code'         => $row['gl_code'],
						'gl_name'         => $row['gl_name'],
						'acc_code'        => $row['acc_code'],
						'acc_name'        => $row['acc_name'],
						'particular'      => $row['particular'],
						'dr_amount'       => $row['dr_amount'],
						'cr_amount'       => $row['cr_amount'],
						'ope_bal'         => $open_bal,
						'bal_type'        => $getcrDrval,
						'bank_code'       => $row['bank_code'],
						'instrument_type' => $row['instrument_type'],
						'instrument_no'   => $row['instrument_no'],
						'instrument_date' => $row['instrument_date'],
						'bank_date'       => $row['bank_date'],
						'cost_code'       => $row['cost_code'],
						'tds_code'        => $row['tds_code'],
						'tds_rate'        => $row['tds_rate'],
						'base_amt'        => $row['base_amt'],
						'tds_amt'         => $row['tds_amt'],
						'ref_type'        => $row['ref_type'],
						'refpo_no'        => $row['refpo_no'],
						'ref_text'        => $row['ref_text'],
		 	   		);

		 	 	 	DB::table('cb_tran_temp')->insert($arraydta);
	            }else{

			 	  	$lastid= DB::getPdo()->lastInsertId();

                	if(isset($lastid)){
                			$data3 = DB::table('cb_tran_temp')
                    		->where(['id'=>$lastid])
                    		->get()->first();
                            $data03 = json_decode(json_encode($data3), true);

                        if($data03['bal_type']=='--' &&  $row['dr_amount']){
                       		$open_bal1 = abs($data03['ope_bal'] + $amnt);
		                    $baltypeI10 ='Dr';
                       	}else if($data03['bal_type']=='--' &&  $row['cr_amount']){
                       		$open_bal1 = abs($data03['ope_bal'] + $amnt);
		                    $baltypeI10 ='Cr';
                       	}

                        if($data03['bal_type']=='Dr' && $row['dr_amount']){

                        	$open_bal1 = abs($data03['ope_bal'] + $amnt);
	                        	if($open_bal1 ==0.00){
	                        		$baltypeI10 ='--';
	                        	}else{
	                        		$baltypeI10 ='Dr';
	                        	}

                       	}else if($data03['bal_type']=='Dr' && $row['cr_amount']){
                       		if($row['cr_amount'] > $data03['ope_bal'] ){

	                        	$open_bal1 = abs($data03['ope_bal'] - $amnt);
	                        	if($open_bal1 ==0.00){
	                        		$baltypeI10 ='--';
	                        	}else{
	                        	    $baltypeI10 ='Cr';
	                        	}
                        	}else if($data03['ope_bal'] > $row['cr_amount']){

                        		$open_bal1 = abs($data03['ope_bal'] - $amnt);
	                        	if($open_bal1 ==0.00){
	                        		$baltypeI10 ='--';
	                        	}else{
	                        	    $baltypeI10 =$data03['bal_type'];
	                        	}
                        	}else if($data03['ope_bal'] == $row['cr_amount']){
                        		$open_bal1 = abs($data03['ope_bal'] - $amnt);
                        		if($open_bal1 ==0.00){
	                        		$baltypeI10 ='--';
	                        	}else{
	                        	    $baltypeI10 ='--';
	                        	}
                        	}
                       	}


                       	if($data03['bal_type']=='Cr' && $row['dr_amount']){

                       		if($row['dr_amount'] > $data03['ope_bal']){

	                        	$open_bal1 = abs($data03['ope_bal'] - $amnt);
	                        	if($open_bal1 ==0.00){
	                        		$baltypeI10 ='--';
	                        	}else{
	                        	    $baltypeI10 ='Dr';
	                        	}
                        	}else if($data03['ope_bal'] > $row['dr_amount']){
                        		$open_bal1 = abs($data03['ope_bal'] - $amnt);
	                        	if($open_bal1 ==0.00){
	                        		$baltypeI10 ='--';
	                        	}else{
	                        	    $baltypeI10 =$data03['bal_type'];
	                        	}
                        	}else if($data03['ope_bal'] == $row['dr_amount']){
                        		$open_bal1 = abs($data03['ope_bal'] - $amnt);
	                        	if($open_bal1 ==0.00){
	                        		$baltypeI10 ='--';
	                        	}else{
	                        		$baltypeI10 ='--';
	                        	}
                        	}
                       	}else if(($data03['bal_type']=='Cr' && $row['cr_amount'])){
                       		
                       		$open_bal1 = abs($data03['ope_bal'] + $amnt);
	                        	if($open_bal1 ==0.00){
	                        		$baltypeI10 ='--';
	                        	}else{
	                        		$baltypeI10 ='Cr';
	                        	}
                       	}


			                       	
			        }

                    $arraydta_1 =  array(
						'company_code'    => $row['company_code'],
						'pfct_code'       => $row['pfct_code'],
						'pfct_name'       => $row['pfct_name'],
						'fy_code'         => $row['fy_code'],
						'tran_code'       => $row['tran_code'],
						'series_code'     => $row['series_code'],
						'vrno'            => $row['vrno'],
						'slno'            => $row['slno'],
						'vr_type'         => $row['vr_type'],
						'vr_date'         => $row['vr_date'],
						'gl_code'         => $row['gl_code'],
						'gl_name'         => $row['gl_name'],
						'acc_code'        => $row['acc_code'],
						'acc_name'        => $row['acc_name'],
						'particular'      => $row['particular'],
						'dr_amount'       => $row['dr_amount'],
						'cr_amount'       => $row['cr_amount'],
						'ope_bal'         => $open_bal1,
						'bal_type'        => $baltypeI10,
						'bank_code'       => $row['bank_code'],
						'instrument_type' => $row['instrument_type'],
						'instrument_no'   => $row['instrument_no'],
						'instrument_date' => $row['instrument_date'],
						'bank_date'       => $row['bank_date'],
						'cost_code'       => $row['cost_code'],
						'tds_code'        => $row['tds_code'],
						'tds_rate'        => $row['tds_rate'],
						'base_amt'        => $row['base_amt'],
						'tds_amt'         => $row['tds_amt'],
						'ref_type'        => $row['ref_type'],
						'refpo_no'        => $row['refpo_no'],
						'ref_text'        => $row['ref_text'],
			 	   	);


			 	   	DB::table('cb_tran_temp')->insert($arraydta_1);


					}

	                $counter++;
	            }

            	/*$data030 = DB::table('cb_tran_temp')
                		->select('cb_tran_temp.*', 'master_bank.*','master_comp.*')
                       ->leftjoin('master_bank', 'cb_tran_temp.bank_code', '=', 'master_bank.bank_code')
                       ->leftjoin('master_comp', 'cb_tran_temp.company_code', '=', 'master_comp.comp_code')
                       ->get()
                       ->toArray();

                  print_r($data030);*/

                 $data030 = DB::select("SELECT cb_tran_temp.* FROM cb_tran_temp");

                $party= DB::table('master_party')->where('acc_code',$request->acct_code)->get()->first();

                $plant= DB::table('master_plant')->where('comp_name',$company_name)->get()->first();

	            $data031 = json_decode(json_encode($data030), true);

	            $getData = array();
                foreach ($data031 as $Getrows) {
                	$Getrows['bal_dr_amt'] = $bal_dr_amt;
                	$Getrows['bal_cr_amt'] = $bal_cr_amt;
                	$getData[] = $Getrows;
                }

                $title='Cash Bank Report';

	           header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.pdf_cash_bank_report',compact('data030','party','plant','title'));
                      
                    $path = public_path('dist/downloadpdf'); 

                    $fileName =  time().'.'. 'pdf' ; 

                    $pdf->save($path . '/' . $fileName);

                    $PublicPath = url('public/dist/downloadpdf/');  

                    $downloadz = $PublicPath.'/'.$fileName;

                     $response_array['response'] = 'success';
                     $response_array['url'] = $downloadPdf;
                     $response_array['data'] = $data030;

                    return $response_array;
                 
            }else{

                $data = array();

                
            }

        }
        
    }
/*cash bank report*/



/*contra report*/

	public function ReportContra(Request $request){

    	if ($request->ajax()) {

			if (!empty($request->from_date || $request->acct_code || $request->vr_num )) {

				$acct_code = $request->acct_code;
				$vr_num    = $request->vr_num;
				
				$company_name 	= $request->session()->get('company_name');
		    	$macc_year 		= $request->session()->get('macc_year');
				$usertype 	= $request->session()->get('user_type');
				$userid	= $request->session()->get('userid');

				 $from_date1 = date("Y-m-d", strtotime($request->from_date));

				$to_date1   = date("Y-m-d", strtotime($request->to_date));


				if(isset($from_date1)  && trim($from_date1)!="")
	      	 	{
	      		$strWhere=" AND `contra_date` BETWEEN '$from_date1' and  '$to_date1'";
	      		}
				
				

			    if(isset($acct_code)  && trim($acct_code)!="" && $usertype=='admin')
				{
				$strWhere="AND contra_transaction.acc_code= '$acct_code'";
				
				}else if(isset($acct_code)  && trim($acct_code)!="" && ($usertype=='superAdmin' || $usertype=='user')){
			    	$strWhere="AND  contra_transaction.acc_code= '$acct_code'";
			    }

			    if(isset($vr_num)  && trim($vr_num)!="" && $usertype=='admin')
				{
				$strWhere="AND contra_transaction.vr_no= '$vr_num'";
				
				}else if(isset($vr_num)  && trim($vr_num)!="" && ($usertype=='superAdmin' || $usertype=='user')){
			    	$strWhere="AND  contra_transaction.vr_no= '$vr_num'";
			    }
			    $serieCD='';
			    $glCode='';
			    $discriptn_page = "Search contra report by user";
				$this->userLogInsert($userid,$serieCD,$vr_num,$acct_code,$discriptn_page,$glCode);

				$data = DB::select("SELECT * FROM `contra_transaction` where 1=1  $strWhere");

				return DataTables()->of($data)->make(true);
				
			}else{

				$company_name 	= $request->session()->get('company_name');
		    	$macc_year 		= $request->session()->get('macc_year');
				$usertype 	= $request->session()->get('user_type');
				$userid	= $request->session()->get('userid');

				$data = DB::select("SELECT * FROM `contra_transaction` where 1=1  ");

				return DataTables()->of($data)->make(true);
			}

		}

	    $company_name 	= $request->session()->get('company_name');
    	$macc_year 		= $request->session()->get('macc_year');
		$usertype 	= $request->session()->get('user_type');
		$userid	= $request->session()->get('userid');

		$getcomcode    = explode('-', $company_name);
		$CCFromSession = $getcomcode[0];

			
    	$title = 'Contra Transaction';

    	//DB::enableQueryLog();
		$item_um_aum_list = DB::table('master_fy')->where('comp_code',$CCFromSession)->where('fy_code',$macc_year)->get();
		//dd(DB::getQueryLog());
					foreach ($item_um_aum_list as $key) {
						//print_r($key);exit;

					$userData['fromDate'] =  $key->fy_from_date;
					$userData['toDate']   =  $key->fy_to_date;
					}

		$bank_list       = DB::table('master_bank')->get();
		$transpoter_list       = DB::table('master_party')->get();
		$acc_list       = DB::table('master_config')->get();
		
		if(isset($company_name)){

    	return view('admin.finance.report.contra_report',$userData+compact('title','bank_list','transpoter_list','acc_list'));
		}else{
		return redirect('/useractivity');
	}
    	
    }

/*contra report*/

/*acc ledger report*/






public function SummaryReportAccLedger(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->acct_code || $request->pfct_code || $request->glC_code || $request->vr_num)) {

					$acct_code = $request->acct_code;
					$pfct_code = $request->pfct_code;
					$glC_code  = $request->glC_code;
					$vr_num    = $request->vr_num;
					$from_date = $request->from_date;
					
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];


                $macc_year = $request->session()->get('macc_year');
                $ExYEar    = explode('-', $macc_year);
                $yearstart =  $ExYEar[0]-1;
                $yearend   =  $ExYEar[1]-1;
                $backYear =  $yearstart.'-'.$yearend;
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));
                $to_date1   = date("Y-m-d", strtotime($request->to_date));

              //  DB::table('acc_ledger_temp')->truncate();

                $strwhere='';
                /*if(isset($from_date1)  && trim($from_date1)!="")
                {
                    	$strwhere .="AND VRDATE BETWEEN '$from_date1' AND '$to_date1'";
                }*/

                if(isset($acct_code)  && trim($acct_code)!="")
                {
                 		$strwhere .= "AND ACC_CODE='$acct_code'";
                 		$strwhere1= "ACC_CODE";
                }


             	if(isset($pfct_code)  && trim($pfct_code)!="")
             	{
             		$strwhere .= "AND PFCT_CODE='$pfct_code'";
             	}

             	if(isset($glC_code)  && trim($glC_code)!="")
             	{
             		$strwhere .= "AND GL_CODE='$glC_code'";
             		$strwhere1= "GL_CODE";
             	}

             	if(isset($vr_num)  && trim($vr_num)!="")
             	{
             		$strwhere .= "AND VRNO ='$vr_num'";
             	}
             	

             if($acct_code && $vr_num || $acct_code){

             //DB::enableQueryLog();

               $data = DB::select("SELECT t.YYYYMM, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, format(@running_total:=@running_total + t.yropdr - t.yropcr + t.yrdramt - t.yrcramt ,2,'en_IN') AS balence
               	FROM
				(
				SELECT ' Yr. Op.' AS YYYYMM, if(yropdr is NULL,0,yropdr) as yropdr, if(yropcr is NULL,0,yropcr) as yropcr, 0 as yrdramt, 0 as yrcramt FROM MASTER_ACCBAL WHERE FY_CODE='$macc_year' AND ACC_CODE='$acct_code'
				UNION
				SELECT a.YYYYMM AS YYYYMM, SUM(a.YROPDR) AS YEOPDR, SUM(a.YROPCR) AS YROPCR, SUM(a.YRDRAMT) AS YRDRAMT, SUM(a.YRCRAMT) AS YRCRAMT FROM
				(
				SELECT CONCAT(YEAR(VRDATE),'-',MONTH(VRDATE)) as YYYYMM, '' as yropdr, '' as yropcr, if(dramt is NULL,0,dramt) as yrdramt, if(cramt is NULL,0,cramt) as yrcramt FROM ACC_TRAN WHERE 1=1 $strwhere AND vrdate BETWEEN '$from_date1' AND '$to_date1'
				) a) t JOIN (SELECT @running_total:=0) r ORDER BY yyyymm");

             //print_r($data);exit;

               // dd(DB::getQueryLog());

           }else if($glC_code && $vr_num || $vr_num || $glC_code){

           

           	$data = DB::select("SELECT t.YYYYMM, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, format(@running_total:=@running_total + t.yropdr - t.yropcr + t.yrdramt - t.yrcramt ,2,'en_IN') AS balence
               	FROM
				(
				SELECT ' Yr. Op.' AS YYYYMM, if(yropdr is NULL,0,yropdr) as yropdr, if(yropcr is NULL,0,yropcr) as yropcr, 0 as yrdramt, 0 as yrcramt FROM MASTER_GLBAL WHERE FY_CODE='$macc_year' AND GL_CODE='$glC_code'
				UNION
				SELECT a.YYYYMM AS YYYYMM, SUM(a.YROPDR) AS YEOPDR, SUM(a.YROPCR) AS YROPCR, SUM(a.YRDRAMT) AS YRDRAMT, SUM(a.YRCRAMT) AS YRCRAMT FROM
				(
				SELECT CONCAT(YEAR(VRDATE),'-',MONTH(VRDATE)) as YYYYMM, 0 as yropdr, 0 as yropcr, if(dramt is NULL,0,dramt) as yrdramt, if(cramt is NULL,0,cramt) as yrcramt FROM GL_TRAN WHERE 1=1 $strwhere AND vrdate BETWEEN '$from_date1' AND '$to_date1'
				) a) t JOIN (SELECT @running_total:=0) r ORDER BY yyyymm");

           	


           }	

                   
               return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

            

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

        $company_name     = $request->session()->get('company_name');
         $macc_year         = $request->session()->get('macc_year');
         $ExYEar    = explode('-', $macc_year);
         $yearstart =  $ExYEar[0]-1;
         $yearend   =  $ExYEar[1]-1;
         $backYear =  $yearstart.'-'.$yearend;
        $usertype     = $request->session()->get('user_type');
        $userid    = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$CCFromSession,'FY_CODE'=>$macc_year])->get();

            foreach ($getdate as $key) {
                $userdata['fromDate'] =  $key->FY_FROM_DATE;
                $userdata['toDate']   =  $key->FY_TO_DATE;
            }


            
		$title = 'Acc Ledger Report';
		
		$acc_list = DB::table('MASTER_ACC')->get();
		
		$vrno_list = DB::table('GL_TRAN')->groupBy('GL_TRAN.VRNO')->get();

		$acc_class_list = DB::table('MASTER_ACLASS')->get();
		$acc_type_list  = DB::table('MASTER_ACCTYPE')->get();
		
		$glsch_list     = DB::table('MASTER_GLSCH')->get();
		$pfct_list      = DB::table('MASTER_PFCT')->get();
		$comp_list      = DB::table('MASTER_COMP')->get();
		$glCode_list    = DB::table('MASTER_GL')->get();

        $acc_led_list = DB::table('LEDGER_TRAN')->where('FY_CODE',$backYear)->get();
        
        return view('admin.finance.report.acc_ledger_report',$userdata+compact('title','acc_list','acc_class_list','acc_type_list','glsch_list','pfct_list','comp_list','acc_led_list','glCode_list','vrno_list'));
        
    }



    public function AccLedgerSummaryPdf(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->acct_code || $request->pfct_code || $request->glC_code || $request->vr_num)) {

					$acct_code = $request->acct_code;
					$pfct_code = $request->pfct_code;
					$glC_code  = $request->glC_code;
					$vr_num    = $request->vr_num;
					$from_date = $request->from_date;
					
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];


                $macc_year = $request->session()->get('macc_year');
                $ExYEar    = explode('-', $macc_year);
                $yearstart =  $ExYEar[0]-1;
                $yearend   =  $ExYEar[1]-1;
                $backYear =  $yearstart.'-'.$yearend;
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));
                $to_date1   = date("Y-m-d", strtotime($request->to_date));

              //  DB::table('acc_ledger_temp')->truncate();

                $strwhere='';
                /*if(isset($from_date1)  && trim($from_date1)!="")
                {
                    	$strwhere .="AND VRDATE BETWEEN '$from_date1' AND '$to_date1'";
                }*/

                if(isset($acct_code)  && trim($acct_code)!="")
                {
                 		$strwhere .= "AND ACC_CODE='$acct_code'";
                 		$strwhere1= "ACC_CODE";
                }


             	if(isset($pfct_code)  && trim($pfct_code)!="")
             	{
             		$strwhere .= "AND PFCT_CODE='$pfct_code'";
             	}

             	if(isset($glC_code)  && trim($glC_code)!="")
             	{
             		$strwhere .= "AND GL_CODE='$glC_code'";
             		$strwhere1= "GL_CODE";
             	}

             	if(isset($vr_num)  && trim($vr_num)!="")
             	{
             		$strwhere .= "AND VRNO ='$vr_num'";
             	}
             	

             if($acct_code && $vr_num || $acct_code){

            // DB::enableQueryLog();

                $tableName='ACC_TRAN';

               $data['data030'] = DB::select("SELECT t.YYYYMM, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, format(@running_total:=@running_total + t.yropdr - t.yropcr + t.yrdramt - t.yrcramt ,2,'en_IN') AS balence,t.acc_code as acc_code,t.acc_name as acc_name,'$from_date1' as FromDate,'$to_date1' as ToDate,'$tableName' as tableName
               	FROM
				(
				SELECT ' Yr. Op.' AS YYYYMM, if(yropdr is NULL,0,yropdr) as yropdr, if(yropcr is NULL,0,yropcr) as yropcr, 0 as yrdramt, 0 as yrcramt,'' as acc_code,'' as acc_name FROM MASTER_ACCBAL WHERE FY_CODE='$macc_year' AND ACC_CODE='$acct_code'
				UNION
				SELECT a.YYYYMM AS YYYYMM, SUM(a.YROPDR) AS YEOPDR, SUM(a.YROPCR) AS YROPCR, SUM(a.YRDRAMT) AS YRDRAMT, SUM(a.YRCRAMT) AS YRCRAMT,acc_code as acc_code,acc_name as acc_name FROM
				(
				SELECT CONCAT(YEAR(VRDATE),'-',MONTH(VRDATE)) as YYYYMM, '' as yropdr, '' as yropcr, if(dramt is NULL,0,dramt) as yrdramt, if(cramt is NULL,0,cramt) as yrcramt,acc_code as acc_code,acc_name as acc_name FROM ACC_TRAN WHERE 1=1 $strwhere AND vrdate BETWEEN '$from_date1' AND '$to_date1'
				) a) t JOIN (SELECT @running_total:=0) r ORDER BY yyyymm");

             //print_r($data);exit;

               //dd(DB::getQueryLog());

           }else if($glC_code && $vr_num || $vr_num || $glC_code){

            $tableName='GL_TRAN';

            //DB::enableQueryLog();

           	$data['data030'] = DB::select("SELECT t.YYYYMM, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, format(@running_total:=@running_total + t.yropdr - t.yropcr + t.yrdramt - t.yrcramt ,2,'en_IN') AS balence,t.REF_CODE as REF_CODE,t.REF_NAME as REF_NAME,'$from_date1' as FromDate,'$to_date1' as ToDate,'$tableName' as tableName
               	FROM
				(
				SELECT ' Yr. Op.' AS YYYYMM, if(yropdr is NULL,0,yropdr) as yropdr, if(yropcr is NULL,0,yropcr) as yropcr, 0 as yrdramt, 0 as yrcramt,'' as REF_CODE,'' as REF_NAME FROM MASTER_GLBAL WHERE FY_CODE='$macc_year' AND GL_CODE='$glC_code'
				UNION
				SELECT a.YYYYMM AS YYYYMM, SUM(a.YROPDR) AS YEOPDR, SUM(a.YROPCR) AS YROPCR, SUM(a.YRDRAMT) AS YRDRAMT, SUM(a.YRCRAMT) AS YRCRAMT,a.REF_CODE as REF_CODE,a.REF_NAME as REF_NAME FROM
				(
				SELECT CONCAT(YEAR(VRDATE),'-',MONTH(VRDATE)) as YYYYMM, 0 as yropdr, 0 as yropcr, if(dramt is NULL,0,dramt) as yrdramt, if(cramt is NULL,0,cramt) as yrcramt,REF_CODE as REF_CODE,REF_NAME as REF_NAME FROM GL_TRAN WHERE 1=1 $strwhere AND vrdate BETWEEN '$from_date1' AND '$to_date1'
				) a) t JOIN (SELECT @running_total:=0) r ORDER BY yyyymm");

           	
           	//dd(DB::getQueryLog());

           }	


                $party= DB::table('MASTER_ACC')->where('ACC_CODE',$request->acct_code)->get()->first();

                 $plant= DB::table('MASTER_PLANT')->where('COMP_CODE',$compCode)->get()->first();  
                   
                 $title='Account Ledger Report';

	               header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.pdf_acc_ledger_summary_report',$data,compact('party','plant','title'));
                      
                    $path = public_path('dist/downloadpdf'); 

                    $fileName =  time().'.'. 'pdf' ; 

                    $pdf->save($path . '/' . $fileName);

                    $PublicPath = url('public/dist/downloadpdf/');  

                    $downloadPdf = $PublicPath.'/'.$fileName;

                     $response_array['response'] = 'success';
                     $response_array['url'] = $downloadPdf;
                     $response_array['data'] = $data;

                    return $response_array;
                  
                                
            }else{

            

                $data = array();

               
            }

        }

       
        
    }


public function TransReportAccLedger(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->acct_code || $request->pfct_code || $request->glC_code || $request->vr_num)) {

					$acct_code = $request->acct_code;
					$pfct_code = $request->pfct_code;
					$glC_code  = $request->glC_code;
					$vr_num    = $request->vr_num;
					$from_date = $request->from_date;
					
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];
                $macc_year = $request->session()->get('macc_year');
                $ExYEar    = explode('-', $macc_year);
                $yearstart =  $ExYEar[0]-1;
                $yearend   =  $ExYEar[1]-1;
                $backYear =  $yearstart.'-'.$yearend;
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));
                $to_date1   = date("Y-m-d", strtotime($request->to_date));

              //  DB::table('acc_ledger_temp')->truncate();

                $strwhere='';
                /*if(isset($from_date1)  && trim($from_date1)!="")
                {
                    	$strwhere .="AND VRDATE BETWEEN '$from_date1' AND '$to_date1'";
                }*/

                if(isset($acct_code)  && trim($acct_code)!="")
                {
                 		$strwhere .= "AND ACC_CODE='$acct_code'";
                 		$strwhere1= "ACC_CODE";
                }


             	if(isset($pfct_code)  && trim($pfct_code)!="")
             	{
             		$strwhere .= "AND PFCT_CODE='$pfct_code'";
             	}

             	if(isset($glC_code)  && trim($glC_code)!="")
             	{
             		$strwhere .= "AND GL_CODE='$glC_code'";
             		$strwhere1= "GL_CODE";
             	}

             	if(isset($vr_num)  && trim($vr_num)!="")
             	{
             		$strwhere .= "AND VRNO ='$vr_num'";
             	}
             	

             if($acct_code && $vr_num || $acct_code){

               $data = DB::select("SELECT t.SERIES, t.particular, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, 
				format(@running_total:=@running_total + t.yropdr - t.yropcr + t.yrdramt - t.yrcramt ,2,'en_IN') AS balence
				FROM
				(
				SELECT ' Yr. Op.' AS SERIES, 'Opening Balance' as particular, if(yropdr is NULL,0,yropdr) as yropdr, if(yropcr is NULL,0,yropcr) as yropcr, 0 as yrdramt, 0 as yrcramt FROM MASTER_ACCBAL WHERE COMP_CODE='$compCode' AND FY_CODE='$macc_year' AND ACC_CODE='$acct_code'
				UNION
				SELECT c.SERIES AS SERIES, c.particular as particular, SUM(c.YROPDR) AS YEOPDR, SUM(c.YROPCR) AS YROPCR, SUM(c.YRDRAMT) AS YRDRAMT, SUM(c.YRCRAMT) AS YRCRAMT FROM
				(
				SELECT CONCAT(a.TRAN_CODE,'-',a.SERIES_CODE) as series, b.SERIES_NAME as particular, 0 as yropdr, 0 as yropcr, if(a.dramt is NULL,0,a.dramt) as yrdramt, if(a.cramt is NULL,0,a.cramt) as yrcramt FROM ACC_TRAN a, MASTER_CONFIG b WHERE a.COMP_CODE='$compCode' AND a.vrdate BETWEEN '$from_date1' AND '$to_date1' AND a.ACC_CODE='$acct_code' AND a.TRAN_CODE=b.TRAN_CODE AND a.SERIES_CODE=b.SERIES_CODE
				) c group by c.SERIES
				) t JOIN (SELECT @running_total:=0) r order by t.series");

           }else if($glC_code && $vr_num || $vr_num || $glC_code){

           	$data = DB::select("SELECT t.SERIES, t.particular, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, 
				format(@running_total:=@running_total + t.yropdr - t.yropcr + t.yrdramt - t.yrcramt ,2,'en_IN') AS balence
				FROM
				(
				SELECT ' Yr. Op.' AS SERIES, 'Opening Balance' as particular, if(yropdr is NULL,0,yropdr) as yropdr, if(yropcr is NULL,0,yropcr) as yropcr, 0 as yrdramt, 0 as yrcramt FROM MASTER_GLBAL WHERE COMP_CODE='$compCode' AND FY_CODE='$macc_year' AND GL_CODE='$glC_code'
				UNION
				SELECT c.SERIES AS SERIES, c.particular as particular, SUM(c.YROPDR) AS YEOPDR, SUM(c.YROPCR) AS YROPCR, SUM(c.YRDRAMT) AS YRDRAMT, SUM(c.YRCRAMT) AS YRCRAMT FROM
				(
				SELECT CONCAT(a.TRAN_CODE,'-',a.SERIES_CODE) as series, b.SERIES_NAME as particular, 0 as yropdr, 0 as yropcr, if(a.dramt is NULL,0,a.dramt) as yrdramt, if(a.cramt is NULL,0,a.cramt) as yrcramt FROM GL_TRAN a, MASTER_CONFIG b WHERE a.COMP_CODE='$compCode' AND a.vrdate BETWEEN '$from_date1' AND '$to_date1' AND a.GL_CODE='$glC_code' AND a.TRAN_CODE=b.TRAN_CODE AND a.SERIES_CODE=b.SERIES_CODE
				) c group by c.SERIES
				) t JOIN (SELECT @running_total:=0) r order by t.series");

           }

                   
               return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

            

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

        $company_name     = $request->session()->get('company_name');
         $macc_year         = $request->session()->get('macc_year');
         $ExYEar    = explode('-', $macc_year);
         $yearstart =  $ExYEar[0]-1;
         $yearend   =  $ExYEar[1]-1;
         $backYear =  $yearstart.'-'.$yearend;
        $usertype     = $request->session()->get('user_type');
        $userid    = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$CCFromSession,'FY_CODE'=>$macc_year])->get();

            foreach ($getdate as $key) {
                $userdata['fromDate'] =  $key->FY_FROM_DATE;
                $userdata['toDate']   =  $key->FY_TO_DATE;
            }


            
		$title = 'Acc Ledger Report';
		
		$acc_list = DB::table('MASTER_ACC')->get();
		
		$vrno_list = DB::table('LEDGER_TRAN')->groupBy('LEDGER_TRAN.VRNO')->get();

		$acc_class_list = DB::table('MASTER_ACLASS')->get();
		$acc_type_list  = DB::table('MASTER_ACCTYPE')->get();
		
		$glsch_list     = DB::table('MASTER_GLSCH')->get();
		$pfct_list      = DB::table('MASTER_PFCT')->get();
		$comp_list      = DB::table('MASTER_COMP')->get();
		$glCode_list    = DB::table('MASTER_GL')->get();

        $acc_led_list = DB::table('LEDGER_TRAN')->where('FY_CODE',$backYear)->get();
        
        return view('admin.finance.report.acc_ledger_report',$userdata+compact('title','acc_list','acc_class_list','acc_type_list','glsch_list','pfct_list','comp_list','acc_led_list','glCode_list','vrno_list'));
        
    }



    public function AccLedgerTransPdf(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->acct_code || $request->pfct_code || $request->glC_code || $request->vr_num)) {

					$acct_code = $request->acct_code;
					$pfct_code = $request->pfct_code;
					$glC_code  = $request->glC_code;
					$vr_num    = $request->vr_num;
					$from_date = $request->from_date;
					
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];
                $macc_year = $request->session()->get('macc_year');
                $ExYEar    = explode('-', $macc_year);
                $yearstart =  $ExYEar[0]-1;
                $yearend   =  $ExYEar[1]-1;
                $backYear =  $yearstart.'-'.$yearend;
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));
                $to_date1   = date("Y-m-d", strtotime($request->to_date));

              //  DB::table('acc_ledger_temp')->truncate();

                $strwhere='';
                /*if(isset($from_date1)  && trim($from_date1)!="")
                {
                    	$strwhere .="AND VRDATE BETWEEN '$from_date1' AND '$to_date1'";
                }*/

                if(isset($acct_code)  && trim($acct_code)!="")
                {
                 		$strwhere .= "AND ACC_CODE='$acct_code'";
                 		$strwhere1= "ACC_CODE";
                }


             	if(isset($pfct_code)  && trim($pfct_code)!="")
             	{
             		$strwhere .= "AND PFCT_CODE='$pfct_code'";
             	}

             	if(isset($glC_code)  && trim($glC_code)!="")
             	{
             		$strwhere .= "AND GL_CODE='$glC_code'";
             		$strwhere1= "GL_CODE";
             	}

             	if(isset($vr_num)  && trim($vr_num)!="")
             	{
             		$strwhere .= "AND VRNO ='$vr_num'";
             	}
             	


             if($acct_code && $vr_num || $acct_code){


               $tableName='ACC_TRAN';

             //   DB::enableQueryLog();


               $data['data030'] = DB::select("SELECT t.SERIES, t.particular, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, 
				format(@running_total:=@running_total + t.yropdr - t.yropcr + t.yrdramt - t.yrcramt ,2,'en_IN') AS balence,t.acc_code as acc_code,t.acc_name as acc_name,'$from_date1' as FromDate,'$to_date1' as ToDate,'$tableName' as tableName
				FROM
				(
				SELECT ' Yr. Op.' AS SERIES, 'Opening Balance' as particular, if(yropdr is NULL,0,yropdr) as yropdr, if(yropcr is NULL,0,yropcr) as yropcr, 0 as yrdramt, 0 as yrcramt,'' as acc_code,'' as acc_name FROM MASTER_ACCBAL WHERE FY_CODE='$macc_year' AND ACC_CODE='$acct_code'
				UNION
				SELECT c.SERIES AS SERIES, c.particular as particular, SUM(c.YROPDR) AS YEOPDR, SUM(c.YROPCR) AS YROPCR, SUM(c.YRDRAMT) AS YRDRAMT, SUM(c.YRCRAMT) AS YRCRAMT,c.acc_code as acc_code,c.acc_name as acc_name FROM
				(
				SELECT CONCAT(a.TRAN_CODE,'-',a.SERIES_CODE) as series, b.SERIES_NAME as particular, 0 as yropdr, 0 as yropcr, if(a.dramt is NULL,0,a.dramt) as yrdramt, if(a.cramt is NULL,0,a.cramt) as yrcramt,a.acc_code as acc_code,a.acc_name as acc_name FROM ACC_TRAN a, MASTER_CONFIG b WHERE a.vrdate BETWEEN '$from_date1' AND '$to_date1' AND a.ACC_CODE='$acct_code' AND a.TRAN_CODE=b.TRAN_CODE AND a.SERIES_CODE=b.SERIES_CODE
				) c group by c.SERIES
				) t JOIN (SELECT @running_total:=0) r order by t.series");

              // dd(DB::getQueryLog());

           }else if($glC_code && $vr_num || $vr_num || $glC_code){


           	 $tableName='GL_TRAN';

           	$data['data030'] = DB::select("SELECT t.SERIES, t.particular, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, 
				format(@running_total:=@running_total + t.yropdr - t.yropcr + t.yrdramt - t.yrcramt ,2,'en_IN') AS balence,t.REF_CODE as REF_CODE,t.REF_NAME as REF_NAME,'$from_date1' as FromDate,'$to_date1' as ToDate,'$tableName' as tableName
				FROM
				(
				SELECT ' Yr. Op.' AS SERIES, 'Opening Balance' as particular, if(yropdr is NULL,0,yropdr) as yropdr, if(yropcr is NULL,0,yropcr) as yropcr, 0 as yrdramt, 0 as yrcramt,'' as REF_CODE,'' as REF_NAME FROM MASTER_GLBAL WHERE FY_CODE='$macc_year' AND GL_CODE='$glC_code'
				UNION
				SELECT c.SERIES AS SERIES, c.particular as particular, SUM(c.YROPDR) AS YEOPDR, SUM(c.YROPCR) AS YROPCR, SUM(c.YRDRAMT) AS YRDRAMT, SUM(c.YRCRAMT) AS YRCRAMT,c.REF_CODE as REF_CODE,c.REF_NAME as REF_NAME FROM
				(
				SELECT CONCAT(a.TRAN_CODE,'-',a.SERIES_CODE) as series, b.SERIES_NAME as particular, 0 as yropdr, 0 as yropcr, if(a.dramt is NULL,0,a.dramt) as yrdramt, if(a.cramt is NULL,0,a.cramt) as yrcramt,REF_CODE as REF_CODE,REF_NAME as REF_NAME FROM GL_TRAN a, MASTER_CONFIG b WHERE a.vrdate BETWEEN '$from_date1' AND '$to_date1' AND a.GL_CODE='$glC_code' AND a.TRAN_CODE=b.TRAN_CODE AND a.SERIES_CODE=b.SERIES_CODE
				) c group by c.SERIES
				) t JOIN (SELECT @running_total:=0) r order by t.series");

           }

                   
                $party= DB::table('MASTER_ACC')->where('ACC_CODE',$request->acct_code)->get()->first();

                 $plant= DB::table('MASTER_PLANT')->where('COMP_CODE',$compCode)->get()->first();  
                   
                 $title='Trnsaction Ledger Report';

	               header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.pdf_acc_ledger_trans_report',$data,compact('party','plant','title'));
                      
                    $path = public_path('dist/downloadpdf'); 

                    $fileName =  time().'.'. 'pdf' ; 

                    $pdf->save($path . '/' . $fileName);

                    $PublicPath = url('public/dist/downloadpdf/');  

                    $downloadPdf = $PublicPath.'/'.$fileName;

                     $response_array['response'] = 'success';
                     $response_array['url'] = $downloadPdf;
                     $response_array['data'] = $data;

                    return $response_array;
                                
            }else{

            

                $data = array();

                
            }

        }

        
        
    }


public function ReportAccLedger22(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->acct_code || $request->pfct_code || $request->glC_code || $request->vr_num)) {

					$acct_code = $request->acct_code;
					$pfct_code = $request->pfct_code;
					$glC_code  = $request->glC_code;
					$vr_num    = $request->vr_num;
					$from_date = $request->from_date;
					
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];
                $macc_year = $request->session()->get('macc_year');
                $ExYEar    = explode('-', $macc_year);
                $yearstart =  $ExYEar[0]-1;
                $yearend   =  $ExYEar[1]-1;
                $backYear =  $yearstart.'-'.$yearend;
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));
                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                DB::table('acc_ledger_temp')->truncate();

                $strwhere='';
                if(isset($from_date1)  && trim($from_date1)!="")
                {
                    	$strwhere .="AND vr_date BETWEEN '$from_date1' AND '$to_date1'";
                }

                if(isset($acct_code)  && trim($acct_code)!="")
                {
                 		$strwhere .= "AND acc_code='$acct_code'";
                }


             	if(isset($pfct_code)  && trim($pfct_code)!="")
             	{
             		$strwhere .= "AND pfct_code='$pfct_code'";
             	}

             	if(isset($glC_code)  && trim($glC_code)!="")
             	{
             		$strwhere .= "AND gl_code='$glC_code'";
             	}

             	if(isset($vr_num)  && trim($vr_num)!="")
             	{
             		$strwhere .= "AND vr_no='$vr_num'";
             	}
             	

             	//DB::enableQueryLog();
                /*$data0 = DB::select("SELECT *,(SELECT tran_head FROM master_transaction WHERE tran_code=ledger_tran.trans_code)as tran_head FROM ledger_tran WHERE 1=1 $strwhere AND fy_code='$macc_year' ORDE R BY  vr_no desc ");*/
                //dd(DB::getQueryLog());
                $data = DB::select("SELECT t.vrdate,t.vrno,format(t.drAmt,2,'en_IN') as DrAmt, format(t.cramt,2,'en_IN') as CrAmt, format(@running_total:=@running_total + t.drAmt - t.cramt,2,'en_IN') AS balence,if(t.dramt>t.cramt,'Dr','Cr') as BalType, t.particular as particular,t.instrument_type as instrument_type,t.instrument_no as instrument_no,t.acc_code as acc_code,t.gl_code as gl_code,t.fy_code as fy_code,t.series_code as series_code FROM 
					((
					SELECT '$from_date' AS vrdate,'Opening Balance' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as gl_code,'' as fy_code,'' as series_code, if(sum(a.dramt)-sum(a.cramt) > 0,sum(a.dramt)-sum(a.cramt),0) as dramt, if(sum(a.cramt)-sum(a.dramt) > 0,sum(a.cramt)-sum(a.dramt),0) as  CrAmt FROM 
					(    
#Bring year opening balance
					SELECT '$from_date' AS vrdate,'Opening' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as gl_code,'' as fy_code,'' as series_code, yropdr as dramt,yropcr as CrAmt FROM master_acc_bal WHERE fiscal_year='$macc_year' AND acc_code='$acct_code'
					UNION
#Bring transactions during year opening and before from date
					SELECT '$from_date' as vrdate, 'Before Date'  as vrno,'' as BalType,particular as particular,instrument_type as instrument_type,instrument_no as instrument_no,acc_code as acc_code,gl_code as gl_code,fy_code as fy_code,series_code as series_code,sum(dr_amt) as drAmt, sum(cr_amt) as cramt
  					FROM ledger_tran WHERE vr_date BETWEEN '$from_date1' AND DATE_SUB('$to_date1',INTERVAL 1 DAY ) AND acc_code='$acct_code'
					) a)
				UNION    
				(
				SELECT date(vr_date) as vrdate,vr_no as vrno,'' as BalType,particular as particular,instrument_type as instrument_type,instrument_no as instrument_no,acc_code as acc_code,gl_code as gl_code,fy_code as fy_code,series_code as series_code, dr_amt as drAmt,cr_amt as cramt FROM ledger_tran where vr_date BETWEEN '$from_date1' AND CURRENT_DATE() AND acc_code='$acct_code'
					)
				)t 
				JOIN (SELECT @running_total:=0) r ORDER BY vrdate");


               // print_r($data);exit;
                   
               return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

            

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

        $company_name     = $request->session()->get('company_name');
         $macc_year         = $request->session()->get('macc_year');
         $ExYEar    = explode('-', $macc_year);
         $yearstart =  $ExYEar[0]-1;
         $yearend   =  $ExYEar[1]-1;
         $backYear =  $yearstart.'-'.$yearend;
        $usertype     = $request->session()->get('user_type');
        $userid    = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $getdate = DB::table('master_fy')->where(['comp_code'=>$CCFromSession,'fy_code'=>$macc_year])->get();

            foreach ($getdate as $key) {
                $userdata['fromDate'] =  $key->fy_from_date;
                $userdata['toDate']   =  $key->fy_to_date;
            }


            
        $title = 'Acc Ledger Report';

        $acc_list = DB::table('viewparty')->get();

        $vrno_list = DB::table('ledger_tran')->groupBy('ledger_tran.vr_no')->get();

        $acc_class_list = DB::table('master_acc_class')->get();
        $acc_type_list = DB::table('master_finance_acctype')->get();

        $glsch_list = DB::table('master_glsch')->get();
        $pfct_list = DB::table('master_pfct')->get();
        $comp_list = DB::table('master_comp')->get();
        $glCode_list = DB::table('master_gl')->get();

        $acc_led_list = DB::table('ledger_tran')->where('fy_code',$backYear)->get();
        
        return view('admin.finance.report.acc_ledger_report',$userdata+compact('title','acc_list','acc_class_list','acc_type_list','glsch_list','pfct_list','comp_list','acc_led_list','glCode_list','vrno_list'));
        
    }

    
	public function ReportAccLedger11(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->acct_code || $request->pfct_code || $request->glC_code || $request->vr_num)) {

                 $acct_code = $request->acct_code;
                 $pfct_code = $request->pfct_code;
                 $glC_code = $request->glC_code;
                 $vr_num = $request->vr_num;
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];
                $macc_year = $request->session()->get('macc_year');
                $ExYEar    = explode('-', $macc_year);
                $yearstart =  $ExYEar[0]-1;
                $yearend   =  $ExYEar[1]-1;
                $backYear =  $yearstart.'-'.$yearend;
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));
                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                DB::table('acc_ledger_temp')->truncate();

                $strwhere='';
                if(isset($from_date1)  && trim($from_date1)!="")
                {
                    	$strwhere .="AND vr_date BETWEEN '$from_date1' AND '$to_date1'";
                }

                if(isset($acct_code)  && trim($acct_code)!="")
                {
                 		$strwhere .= "AND acc_code='$acct_code'";
                }


             	if(isset($pfct_code)  && trim($pfct_code)!="")
             	{
             		$strwhere .= "AND pfct_code='$pfct_code'";
             	}

             	if(isset($glC_code)  && trim($glC_code)!="")
             	{
             		$strwhere .= "AND gl_code='$glC_code'";
             	}

             	if(isset($vr_num)  && trim($vr_num)!="")
             	{
             		$strwhere .= "AND vr_no='$vr_num'";
             	}
             	

             	
                $data0 = DB::select("SELECT *,(SELECT tran_head FROM master_transaction WHERE tran_code=ledger_tran.trans_code)as tran_head FROM ledger_tran WHERE 1=1 $strwhere AND fy_code='$macc_year' ORDER BY  vr_no ASC ");
                //dd(DB::getQueryLog());
                $data11 = DB::table('ledger_tran')
                			->leftjoin('master_transaction', 'ledger_tran.trans_code', '=', 'master_transaction.tran_code')
                			->orderBy('ledger_tran.vr_no','ASC');

                			if(isset($from_date1)  && trim($from_date1)!="")
			                {
			                    $data11->whereBetween('vr_date', [$from_date1, $to_date1]);
			                }

                			if(isset($acct_code)  && trim($acct_code)!="")
                			{
                               $data11->where('acc_code',$acct_code);
                            }

			             	if(isset($pfct_code)  && trim($pfct_code)!="")
			             	{
			             		$data11->where('pfct_code',$pfct_code);
			             	}

			             	if(isset($glC_code)  && trim($glC_code)!="")
			             	{
			             		$data11->where('gl_code',$glC_code);
			             	}


			             	$data11->where('ledger_tran.fy_code',$backYear);
                            $data1 = $data11->select('ledger_tran.*', 'master_transaction.tran_head')->get()->toArray();

                			$bal_dr_amt =0;
                            $bal_cr_amt =0;

                            foreach ($data1 as $key) {
                                $bal_dr_amt += $key->dr_amt;
                                $bal_cr_amt += $key->cr_amt;
                            }
                           
                 $data01 = json_decode(json_encode($data0), true); 

                  $getData = array();
	                    $counter = 1;
	                    $counter1 = 1;

                 foreach ($data01 as $row) { 

	                    	if($row['dr_amt']){
	                    		$amnt = $row['dr_amt'];
	                    		$baltypeI ='Dr';
	                    	}else if($row['cr_amt']){
	                    		$amnt = $row['cr_amt'];
	                    		$baltypeI ='Cr';
	                    	}

	                    	if($bal_dr_amt > $bal_cr_amt){
	                    		$balence = $bal_dr_amt - $bal_cr_amt;
		                    	$getcrDrval = 'Dr';
	                    	}else if($bal_cr_amt > $bal_dr_amt){
	                    		$balence = $bal_cr_amt - $bal_dr_amt;
		                    		$getcrDrval = 'Cr';
		                    }else{
		                    	$balence = 0;
		                    	$getcrDrval = '--';
		                    }

		                   /* echo "<PRE>";
		                    print_r('balnc'.$balence);
		                    echo "<PRE>";
		                    print_r('getcrDrval'.$getcrDrval);*/

		                   // print_r($getcrDrval);

		                    if($getcrDrval == '--'){
		                    	if($row['dr_amt'] && $row['cr_amt'] == 0.00){
		                    		$open_bal = $amnt;
		                    		$getcrDrval = 'Dr';
		                    	}else if($row['cr_amt'] && $row['dr_amt'] == 0.00){
		                    		$open_bal = $amnt;
		                    		$getcrDrval = 'Cr';
		                    	}else{
		                    		$open_bal = 0;
		                    		$getcrDrval = '--';
		                    	}
		                    }else if($getcrDrval =='Dr'){
		                    	if($row['dr_amt']){
		                    		$open_bal = $balence + $amnt;
		                    		$getcrDrval = 'Dr';
		                    	}else if($row['cr_amt'] ){
		                    		$open_bal = abs($balence - $amnt);
		                    		if($balence > $row['cr_amt']){
		                    			$getcrDrval = 'Dr';
		                    		}else if($row['cr_amt'] > $balence){
		                    			$getcrDrval = 'Cr';
		                    		}else{
		                    			$getcrDrval = '--';
		                    		}
		                    	}else{
		                    		$open_bal = 0;
		                    		$getcrDrval = '--';
		                    	}
		                    }else if($getcrDrval =='Cr'){
		                    	if($row['cr_amt']){
		                    		$open_bal = $balence + $amnt;
		                    		$getcrDrval = 'Cr';
		                    	}else if($row['dr_amt'] ){
		                    		$open_bal = abs($balence - $amnt);
		                    		if($balence > $row['dr_amt']){
		                    			$getcrDrval = 'Cr';
		                    		}else if( $row['dr_amt'] > $balence){
		                    			$getcrDrval = 'Dr';
		                    		}else{
		                    			$getcrDrval = '--';
		                    		}
		                    	}else{
		                    		$open_bal = 0;
		                    		$getcrDrval = '--';
		                    	}
		                    }else{
		                    	$open_bal = 0;
		                    	$getcrDrval = '--';
		                    }

	                    	$row['bal_dr_amt'] = $bal_dr_amt;
	                    	$row['bal_cr_amt'] = $bal_cr_amt;
	                    	$getData[] = $row;

	                    	if(isset($acct_code)  && trim($acct_code)!="")
              				{
						        $flag = 'A';
						    }else if(isset($glC_code)  && trim($glC_code)!="")
						    {
						         $flag = 'G';
						    }else{
						    	$flag ='A';
						    }

						     

	                    	if($counter == $counter1){

	                    		$arraydta =  array(
					 	   		 'company_code'=> $row['company_code'],
					 	   		 'fy_code'=> $row['fy_code'],
					 	   		 'vr_date'=> $row['vr_date'],
					 	   		 'vr_no'=> $row['vr_no'],
					 	   		 'trans_code'=> $row['trans_code'],
					 	   		 'acc_code'=> $row['acc_code'],
					 	   		 'acc_name'=> $row['acc_name'],
					 	   		 'ref_acc_code'=> $row['ref_acc_code'],
					 	   		 'ref_acc_name'=> $row['ref_acc_name'],
					 	   		 'gl_code'=> $row['gl_code'],
					 	   		 'series_code'=> $row['series_code'],
					 	   		 'pfct_code'=> $row['pfct_code'],
					 	   		 'cr_amt'=> $row['cr_amt'],
					 	   		 'dr_amt'=> $row['dr_amt'],
					 	   		 'ope_bal'=> $open_bal,
					 	   		 'bal_type'=> $getcrDrval,
					 	   		 'instrument_type'=> $row['instrument_type'],
					 	   		 'instrument_no'=> $row['instrument_no'],
					 	   		 'particular'=> $row['particular'],
					 	   		 'check_code'=> $flag,
					 	   		);

					 	 	 	DB::table('acc_ledger_temp')->insert($arraydta);
	                    	}else{

						 	  	$lastid= DB::getPdo()->lastInsertId();

		                    	if(isset($lastid)){
		                    			$data3 = DB::table('acc_ledger_temp')
	                            		->where(['id'=>$lastid])
	                            		->get()->first();
			                            $data03 = json_decode(json_encode($data3), true);

			                        if($data03['bal_type']=='--' &&  $row['dr_amt']){
			                       		$open_bal1 = abs($data03['ope_bal'] + $amnt);
					                    $baltypeI10 ='Dr';
			                       	}else if($data03['bal_type']=='--' &&  $row['cr_amt']){
			                       		$open_bal1 = abs($data03['ope_bal'] + $amnt);
					                    $baltypeI10 ='Cr';
			                       	}

			                        if($data03['bal_type']=='Dr' && $row['dr_amt']){

			                        	$open_bal1 = abs($data03['ope_bal'] + $amnt);
				                        	if($open_bal1 ==0.00){
				                        		$baltypeI10 ='--';
				                        	}else{
				                        		$baltypeI10 ='Dr';
				                        	}

			                       	}else if($data03['bal_type']=='Dr' && $row['cr_amt']){
			                       		if($row['cr_amt'] > $data03['ope_bal'] ){

				                        	$open_bal1 = abs($data03['ope_bal'] - $amnt);
				                        	if($open_bal1 ==0.00){
				                        		$baltypeI10 ='--';
				                        	}else{
				                        	    $baltypeI10 ='Cr';
				                        	}
			                        	}else if($data03['ope_bal'] > $row['cr_amt']){

			                        		$open_bal1 = abs($data03['ope_bal'] - $amnt);
				                        	if($open_bal1 ==0.00){
				                        		$baltypeI10 ='--';
				                        	}else{
				                        	    $baltypeI10 =$data03['bal_type'];
				                        	}
			                        	}else if($data03['ope_bal'] == $row['cr_amt']){
			                        		$open_bal1 = abs($data03['ope_bal'] - $amnt);
			                        		if($open_bal1 ==0.00){
				                        		$baltypeI10 ='--';
				                        	}else{
				                        	    $baltypeI10 ='--';
				                        	}
			                        	}
			                       	}


			                       	if($data03['bal_type']=='Cr' && $row['dr_amt']){

			                       		if($row['dr_amt'] > $data03['ope_bal']){

				                        	$open_bal1 = abs($data03['ope_bal'] - $amnt);
				                        	if($open_bal1 ==0.00){
				                        		$baltypeI10 ='--';
				                        	}else{
				                        	    $baltypeI10 ='Dr';
				                        	}
			                        	}else if($data03['ope_bal'] > $row['dr_amt']){
			                        		$open_bal1 = abs($data03['ope_bal'] - $amnt);
				                        	if($open_bal1 ==0.00){
				                        		$baltypeI10 ='--';
				                        	}else{
				                        	    $baltypeI10 =$data03['bal_type'];
				                        	}
			                        	}else if($data03['ope_bal'] == $row['dr_amt']){
			                        		$open_bal1 = abs($data03['ope_bal'] - $amnt);
				                        	if($open_bal1 ==0.00){
				                        		$baltypeI10 ='--';
				                        	}else{
				                        		$baltypeI10 ='--';
				                        	}
			                        	}
			                       	}else if(($data03['bal_type']=='Cr' && $row['cr_amt'])){
			                       		
			                       		$open_bal1 = abs($data03['ope_bal'] + $amnt);
				                        	if($open_bal1 ==0.00){
				                        		$baltypeI10 ='--';
				                        	}else{
				                        		$baltypeI10 ='Cr';
				                        	}
			                       	}


			                       	
			                    }
			                    if(isset($acct_code)  && trim($acct_code)!="")
              				{
						        $flag = 'A';
						    }else if(isset($glC_code)  && trim($glC_code)!="")
						    {
						         $flag = 'G';
						    }else{
						    	$flag ='A';
						    }



			                    $arraydta_1 =  array(
							 	   		 'company_code'=> $row['company_code'],
							 	   		 'fy_code'=> $row['fy_code'],
							 	   		 'vr_date'=> $row['vr_date'],
							 	   		 'vr_no'=> $row['vr_no'],
							 	   		 'trans_code'=> $row['trans_code'],
							 	   		 'acc_code'=> $row['acc_code'],
							 	   		 'acc_name'=> $row['acc_name'],
							 	   		 'ref_acc_code'=> $row['ref_acc_code'],
					 	   		 		'ref_acc_name'=> $row['ref_acc_name'],
							 	   		 'gl_code'=> $row['gl_code'],
							 	   		 'series_code'=> $row['series_code'],
							 	   		 'pfct_code'=> $row['pfct_code'],
							 	   		 'cr_amt'=> $row['cr_amt'],
							 	   		 'dr_amt'=> $row['dr_amt'],
							 	   		 'ope_bal'=> $open_bal1,
							 	   		 'bal_type'=> $baltypeI10,
							 	   		 'check_code'=> $flag,
							 	   		 'instrument_type'=> $row['instrument_type'],
							 	   		 'instrument_no'=> $row['instrument_no'],
							 	   		 'particular'=> $row['particular'],
						 	   		);


						 	   	DB::table('acc_ledger_temp')->insert($arraydta_1);


					 	   }

	                    	$counter++;
	                	}
//DB::enableQueryLog();
	                	$data030 = DB::table('acc_ledger_temp')
	                    		->select('acc_ledger_temp.*', 'master_transaction.*','master_comp.*')
                               ->leftjoin('master_transaction', 'acc_ledger_temp.trans_code', '=', 'master_transaction.tran_code')
                                ->leftjoin('master_comp', 'acc_ledger_temp.company_code', '=', 'master_comp.comp_code')
                                ->orderBy('acc_ledger_temp.vr_no','ASC')
                               ->get();
//dd(DB::getQueryLog());
	                    $data031 = json_decode(json_encode($data030), true);

	                    $getData = array();
	                    foreach ($data031 as $Getrows) {
	                    	$Getrows['bal_dr_amt'] = $bal_dr_amt;
	                    	$Getrows['bal_cr_amt'] = $bal_cr_amt;
	                    	$getData[] = $Getrows;
	                    }

	                    $data = $getData;
                   
               return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

            

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

        $company_name     = $request->session()->get('company_name');
         $macc_year         = $request->session()->get('macc_year');
         $ExYEar    = explode('-', $macc_year);
         $yearstart =  $ExYEar[0]-1;
         $yearend   =  $ExYEar[1]-1;
         $backYear =  $yearstart.'-'.$yearend;
        $usertype     = $request->session()->get('user_type');
        $userid    = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $getdate = DB::table('master_fy')->where(['comp_code'=>$CCFromSession,'fy_code'=>$macc_year])->get();

            foreach ($getdate as $key) {
                $userdata['fromDate'] =  $key->fy_from_date;
                $userdata['toDate']   =  $key->fy_to_date;
            }


            
        $title = 'Acc Ledger Report';

        $acc_list = DB::table('viewparty')->get();

        $vrno_list = DB::table('ledger_tran')->groupBy('ledger_tran.vr_no')->get();

        $acc_class_list = DB::table('master_acc_class')->get();
        $acc_type_list = DB::table('master_finance_acctype')->get();

        $glsch_list = DB::table('master_glsch')->get();
        $pfct_list = DB::table('master_pfct')->get();
        $comp_list = DB::table('master_comp')->get();
        $glCode_list = DB::table('master_gl')->get();

        $acc_led_list = DB::table('ledger_tran')->where('fy_code',$backYear)->get();
        
        return view('admin.finance.report.acc_ledger_report',$userdata+compact('title','acc_list','acc_class_list','acc_type_list','glsch_list','pfct_list','comp_list','acc_led_list','glCode_list','vrno_list'));
        
    }

/*acc ledger  report*/
public function AccLedgerReportPdf(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->acct_code || $request->pfct_code || $request->glC_code || $request->vr_num)) {

                 $acct_code = $request->acct_code;
                 $pfct_code = $request->pfct_code;
                 $glC_code = $request->glC_code;
                 $vr_num = $request->vr_num;
                 $op_drAmt = $request->opDrAmt;
                 $op_crAmt = $request->opCrAmt;
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];
                $bgdate     = $request->session()->get('yrbgdate');
                $yrbgdate = date("Y-m-d", strtotime($bgdate));
                $macc_year = $request->session()->get('macc_year');
                $ExYEar    = explode('-', $macc_year);
                $yearstart =  $ExYEar[0]-1;
                $yearend   =  $ExYEar[1]-1;
                $backYear =  $yearstart.'-'.$yearend;
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));
                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                //DB::table('acc_ledger_temp')->truncate();

                $strwhere='';
                if(isset($from_date1)  && trim($from_date1)!="")
                {
                    	$strwhere .="AND VRDATE BETWEEN '$from_date1' AND '$to_date1'";
                }

                if(isset($acct_code)  && trim($acct_code)!="")
                {
                 		$strwhere .= "AND ACC_CODE='$acct_code'";
                }


             	if(isset($pfct_code)  && trim($pfct_code)!="")
             	{
             		$strwhere .= "AND PFCT_CODE='$pfct_code'";
             	}

             	if(isset($glC_code)  && trim($glC_code)!="")
             	{
             		$strwhere .= "AND GL_CODE='$glC_code'";
             	}

             	if(isset($vr_num)  && trim($vr_num)!="")
             	{
             		$strwhere .= "AND VRNO='$vr_num'";
             	}
             	

             //	DB::enableQueryLog();
                 if($acct_code){
             		$post_code='t.acc_code as acc_code';
             		$tableName='ACC_TRAN';
             	}else{
             		$post_code='t.gl_code as gl_code,t.acc_code as acc_code';
             		$tableName='GL_TRAN';
             	}
             

		//dd(DB::getQueryLog());

          //	DB::enableQueryLog();   	

             if($acct_code && $vr_num || $acct_code){

             	$data['data030'] = DB::select("SELECT date(VRDATE) as VRDATE,VRNO as VRNO,'' as BalType,particular as particular,acc_code as acc_code,acc_name,'' as gl_code, '' as gl_name,fy_code as fy_code,series_code as series_code,TRAN_CODE as TRAN_CODE, format(dramt,2,'en_IN') as DrAmt,dramt as rDrAmt,format(cramt,2,'en_IN') as CrAmt,cramt as rCrAmt,REF_CODE as REF_CODE,REF_NAME as REF_NAME,'$tableName' as tableName,'$from_date1' as FromDate,'$to_date1' as ToDate FROM ACC_TRAN where 1=1 AND COMP_CODE='$compCode' AND FY_CODE='$macc_year' $strwhere AND VRDATE BETWEEN '$from_date1' AND '$to_date1'  ORDER BY VRDATE");


               /*$data['data030'] = DB::select("SELECT t.VRDATE,t.VRNO,format(t.drAmt,2,'en_IN') as DrAmt, format(t.cramt,2,'en_IN') as CrAmt, if(t.drAmt>0,format(@running_total:=@running_total + t.drAmt,2,'en_IN'),format(@running_total:=@running_total - t.cramt,2,'en_IN')) AS balence,if(t.dramt>t.cramt,'Dr','Cr') as BalType, t.particular as particular,t.instrument_type as instrument_type,t.instrument_no as instrument_no,t.fy_code as fy_code,t.series_code as series_code,t.TRAN_CODE as TRAN_CODE, t.REF_CODE,t.REF_NAME,t.acc_code as acc_code,t.acc_name as acc_name,'$from_date1' as FromDate,'$to_date1' as ToDate,'$tableName' as tableName FROM 
				(
				SELECT '$from_date1' AS vrdate,'Op-Bal' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as acc_name,'' as fy_code,'' as series_code,''as TRAN_CODE, if(if(b.dramt>0,b.dramt,0) - if(b.cramt>0,b.cramt,0) >0,b.dramt- if(b.cramt>0,b.cramt,0),0) as dramt, if(if(b.cramt>0,b.cramt,0) - if(b.dramt>0,b.dramt,0) >0,b.cramt- if(b.dramt>0,b.dramt,0),0) as CrAmt,'' as REF_CODE,'' as REF_NAME FROM    
				(
				SELECT '$from_date1' AS vrdate,'Op-Bal' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as acc_name,'' as fy_code,'' as series_code,''as TRAN_CODE, sum(a.dramt) as drAmt, sum(a.cramt) as  CrAmt,'' as REF_CODE,'' as REF_NAME FROM 
				((    
					#Bring year opening balance
			SELECT '$from_date1' AS vrdate,'Opening' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as acc_name,'' as fy_code,'' as series_code,''as TRAN_CODE, yropdr as dramt,yropcr as CrAmt,'' as REF_CODE,'' as REF_NAME FROM MASTER_ACCBAL WHERE  FY_CODE='$macc_year' AND acc_code='$acct_code')
			UNION
				#Bring transactions during year opening and before from date
			SELECT '$from_date1' as vrdate, 'Before Date'  as vrno,'' as BalType,particular as particular,'' as instrument_type,'' as instrument_no,acc_code as acc_code,acc_name as acc_name,fy_code as fy_code,series_code as series_code,TRAN_CODE as TRAN_CODE,sum(dramt) as drAmt, sum(cramt) as cramt,'' as REF_CODE,'' as REF_NAME FROM ACC_TRAN WHERE 1=1 $strwhere AND vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY) ) a) b
			UNION    
			SELECT date(VRDATE) as vrdate,VRNO as vrno,'' as BalType,particular as particular,'' as instrument_type,'' as instrument_no,acc_code as acc_code, acc_name as acc_name,fy_code as fy_code,series_code as series_code,TRAN_CODE as TRAN_CODE, dramt as drAmt,cramt as cramt,REF_CODE as REF_CODE,REF_NAME as REF_NAME FROM ACC_TRAN where 1=1 $strwhere AND VRDATE BETWEEN '$from_date1' AND '$to_date1'  ORDER BY vrdate
			)t JOIN (SELECT @running_total:=0) r");*/

              // dd(DB::getQueryLog());

           }else if($glC_code && $vr_num || $vr_num || $glC_code){

           		$data['data030'] = DB::select("SELECT date(T.VRDATE) as VRDATE,T.VRNO as VRNO,'' as BalType,T.particular as particular,T.gl_code as gl_code,T.gl_name as gl_name,'' as acc_code,'' as acc_name,T.fy_code as fy_code,T.series_code as series_code,T.TRAN_CODE as TRAN_CODE, format(T.dramt,2,'en_IN') as DrAmt,T.dramt as rDrAmt,format(T.cramt,2,'en_IN') as CrAmt,T.cramt as rCrAmt,T.REF_CODE as REF_CODE,M.TRAN_HEAD as REF_NAME,'$tableName' as tableName,'$from_date1' as FromDate,'$to_date1' as ToDate FROM GL_TRAN T,MASTER_TRANSACTION M where 1=1 AND T.TRAN_CODE=M.TRAN_CODE AND T.COMP_CODE='$compCode' AND T.FY_CODE='$macc_year' $strwhere AND T.VRDATE BETWEEN '$from_date1' AND '$to_date1'  ORDER BY T.VRDATE");

           	/*$data['data030'] = DB::select("SELECT t.VRDATE,t.VRNO,format(t.drAmt,2,'en_IN') as DrAmt, format(t.cramt,2,'en_IN') as CrAmt, if(t.drAmt>0,format(@running_total:=@running_total + t.drAmt,2,'en_IN'),format(@running_total:=@running_total - t.cramt,2,'en_IN')) AS balence,if(t.dramt>t.cramt,'Dr','Cr') as BalType, t.particular as particular,t.instrument_type as instrument_type,t.instrument_no as instrument_no,t.fy_code as fy_code,t.series_code as series_code,t.REF_CODE,t.REF_NAME,t.gl_code as gl_code,t.gl_name as gl_name,'$from_date1' as FromDate,'$to_date1' as ToDate,'$tableName' as tableName FROM 
				(
				SELECT '$from_date1' AS vrdate,'Op-Bal' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as gl_code,'' as gl_name,'' as fy_code,'' as series_code, if(if(b.dramt>0,b.dramt,0) - if(b.cramt>0,b.cramt,0) >0,b.dramt- if(b.cramt>0,b.cramt,0),0) as dramt, if(if(b.cramt>0,b.cramt,0) - if(b.dramt>0,b.dramt,0) >0,b.cramt- if(b.dramt>0,b.dramt,0),0) as CrAmt,'' as REF_CODE,'' as REF_NAME FROM    
				(
				SELECT '$from_date1' AS vrdate,'Op-Bal' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as gl_code,'' as gl_name,'' as fy_code,'' as series_code, sum(a.dramt) as drAmt, sum(a.cramt) as  CrAmt,'' as REF_CODE,'' as REF_NAME FROM 
				((    
#Bring year opening balance
			SELECT '$from_date1' AS vrdate,'Opening' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as gl_code,'' as gl_name,'' as fy_code,'' as series_code, yropdr as dramt,yropcr as CrAmt,'' as REF_CODE,'' as REF_NAME FROM MASTER_GLBAL WHERE  FY_CODE='$macc_year' AND gl_code='$glC_code')
			UNION
#Bring transactions during year opening and before from date
			SELECT '$from_date1' as vrdate, 'Before Date'  as vrno,'' as BalType,particular as particular,'' as instrument_type,'' as instrument_no,gl_code as gl_code,gl_name as gl_name,fy_code as fy_code,series_code as series_code,sum(dramt) as drAmt, sum(cramt) as cramt,'' as REF_CODE,'' as REF_NAME FROM GL_TRAN WHERE 1=1 $strwhere AND vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY) ) a) b
			UNION    
			SELECT date(VRDATE) as vrdate,VRNO as vrno,'' as BalType,particular as particular,'' as instrument_type,'' as instrument_no,gl_code as gl_code,gl_name as gl_name,fy_code as fy_code,series_code as series_code, dramt as drAmt,cramt as cramt,REF_CODE as REF_CODE,REF_NAME as REF_NAME FROM GL_TRAN where 1=1 $strwhere AND VRDATE BETWEEN '$from_date1' AND '$to_date1'  ORDER BY vrdate
			)t JOIN (SELECT @running_total:=0) r");*/

           }

                 //dd(DB::getQueryLog());

                               //print_r($data['data030']);exit;
                $party= DB::table('MASTER_ACC')->where('ACC_CODE',$request->acct_code)->get()->first();

                $plant= DB::table('MASTER_COMP')->where('COMP_CODE',$compCode)->get()->first();  
                   
               $title='Account Ledger Report';

	           header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.pdf_acc_ledger_report',$data,compact('party','plant','title','op_drAmt','op_crAmt'));
                      
                    $path = public_path('dist/downloadpdf'); 

                    $fileName =  time().'.'. 'pdf' ; 

                    $pdf->save($path . '/' . $fileName);

                    $PublicPath = url('public/dist/downloadpdf/');  

                    $downloadPdf = $PublicPath.'/'.$fileName;

                     $response_array['response'] = 'success';
                     $response_array['url'] = $downloadPdf;
                     $response_array['data'] = $data;

                    return $response_array;
                                
            }else{

            

                $data = array();

               
            }

        }
 
        
    }


/*item ledger report*/
public function ReportItemLedger(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->item_code || $request->pfct_code || $request->vr_num || $request->tran_code )) {

					$itemCode  = $request->item_code;
					$pfct_code = $request->pfct_code;
					$vr_num    = $request->vr_num;
					$tran_code = $request->tran_code;

				if($vr_num){
					$splivrno = explode(' ', $vr_num);
					$vrseq_num = $splivrno[2];
				}else{
					$vrseq_num ='';
				}
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];

                $bgdate     = $request->session()->get('yrbgdate');
                $yrbgdate = date("Y-m-d", strtotime($bgdate));

                $macc_year = $request->session()->get('macc_year');
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                $from_date = $request->from_date;
                $from_date1 = date("Y-m-d", strtotime($request->from_date));

                $to_date = $request->to_date;

                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                $oneDayBack	=date('Y-m-d', strtotime('-1 day', strtotime($from_date1)));

                $strWhere='';
                $strWhere1='';
                
                /*if(isset($from_date1)  && trim($from_date1)!="")
	      	 	{
	      		$strWhere .="AND VRDATE BETWEEN '$from_date1' and '$to_date1'";
	      		}*/

                if(isset($itemCode)  && trim($itemCode)!="")
                {
                 $strWhere .= "AND ITEM_CODE='$itemCode'";
                 $strWhere1 .= "AND ITEM_CODE='$itemCode'";
                }

                if(isset($pfct_code)  && trim($pfct_code)!="")
                {
                    $strWhere .= "AND PFCT_CODE='$pfct_code'";
                    $strWhere1 .= "AND PFCT_CODE='$pfct_code'";
                }

                if(isset($vr_num)  && trim($vr_num)!="")
                {
                    $strWhere .= "AND VRNO='$vr_num'";
                    $strWhere1 .= "AND VRNO='$vr_num'";
                }

                if(isset($tran_code)  && trim($tran_code)!="")
                {
                    $strWhere .= "AND TRAN_CODE='$tran_code'";
                    $strWhere1 .= "AND TRAN_CODE='$tran_code'";
                }

                //DB::enableQueryLog();
               
             $data = DB::select("SELECT t.VRDATE,t.VRNO ,t.MAVGRATE as MAVGRATE,format(t.QTYRECD,2,'en_IN') as QTYRECD, format(t.QTYISSUED,2,'en_IN') as QTYISSUED, if(t.QTYRECD>0,format(@running_total:=@running_total + t.QTYRECD,2,'en_IN'),format(@running_total:=@running_total - t.QTYISSUED,2,'en_IN')) AS balence,if(t.QTYRECD>t.QTYISSUED,'Dr','Cr') as BalType, t.PARTICULAR as PARTICULAR,t.ITEM_CODE as ITEM_CODE,t.gl_code as gl_code,t.fy_code as fy_code,t.series_code as series_code,t.TRAN_CODE as TRAN_CODE,t.CLVAL as CLVAL FROM 
				(
				SELECT '$from_date' AS vrdate,'OP-BAL' as vrno,b.MAVGRATE as MAVGRATE,'' as BalType,'' as PARTICULAR,'' as ITEM_CODE,'' as gl_code,'' as fy_code,'' as series_code,'' as TRAN_CODE, if(if(b.QTYRECD>0,b.QTYRECD,0) - if(b.QTYISSUED>0,b.QTYISSUED,0) >0,b.QTYRECD- if(b.QTYISSUED>0,b.QTYISSUED,0),0) as QTYRECD, if(if(b.QTYISSUED>0,b.QTYISSUED,0) - if(b.QTYRECD>0,b.QTYRECD,0) >0,b.QTYISSUED- if(b.QTYRECD>0,b.QTYRECD,0),0) as QTYISSUED,b.CLVAL as CLVAL FROM    
				(
				SELECT '$from_date' AS vrdate,'OP-BAL' as vrno,a.MAVGRATE as MAVGRATE,'' as BalType,'' as PARTICULAR,'' as ITEM_CODE,'' as gl_code,'' as fy_code,'' as series_code,'' as TRAN_CODE, sum(a.QTYRECD) as QTYRECD, sum(a.QTYISSUED) as  QTYISSUED,a.CLVAL as CLVAL FROM 
				((    
#Bring year opening balance
				SELECT '$from_date' AS vrdate,'OP-BAL' as vrno,MAVGRATE as MAVGRATE,'' as BalType,'' as PARTICULAR,'' as ITEM_CODE,'' as gl_code,'' as fy_code,'' as series_code,'' as TRAN_CODE, YROPQTY as QTYRECD, 0 as QTYISSUED,CLVAL as CLVAL  FROM MASTER_ITEMBAL WHERE FY_CODE='$macc_year' AND ITEM_CODE='$itemCode')
				UNION
#Bring transactions during year opening and before from date
				SELECT '$from_date' as vrdate, 'Before Date'  as vrno,'' as MAVGRATE,'' as BalType,PARTICULAR as PARTICULAR,ITEM_CODE as ITEM_CODE,'' as gl_code,fy_code as fy_code,series_code as series_code,TRAN_CODE as TRAN_CODE,sum(QTYRECD) as QTYRECD, sum(QTYISSUED) as QTYISSUED,0 as CLVAL FROM ITEM_LEDGER WHERE 1=1 $strWhere AND vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY) ) a) b
				UNION    
				SELECT date(VRDATE) as vrdate,VRNO as vrno,'' as MAVGRATE,'' as BalType,PARTICULAR as PARTICULAR,ITEM_CODE as ITEM_CODE,'' as gl_code,fy_code as fy_code,series_code as series_code,TRAN_CODE as TRAN_CODE, QTYRECD as QTYRECD,QTYISSUED as QTYISSUED,0 as CLVAL FROM ITEM_LEDGER where 1=1 $strWhere AND VRDATE BETWEEN '$from_date1' AND '$to_date1' ORDER BY vrdate
			       )t  JOIN (SELECT @running_total:=0) r ORDER BY vrdate");

             //dd(DB::getQueryLog());
              // DB::enableQueryLog();
               /*$data1 = DB::select("SELECT t.VRDATE,t.VRNO as VRNO, format(t.QTYRECD,2,'en_IN') as QTYRECD, format(t.QTYISSUED,2,'en_IN') as QTYISSUED, format(@running_total:=@running_total + t.QTYRECD-t.QTYISSUED,2,'en_IN') AS balence,t.FY_YEAR as FY_YEAR,t.SERIES_CODE as SERIES_CODE,t.UM_CODE as UM_CODE,t.PARTICULAR as PARTICULAR,t.TRAN_CODE as TRAN_CODE,t.ITEM_CODE as ITEM_CODE FROM 
						((
				  SELECT '$from_date' AS vrdate,'Opening Balance' as VRNO, if(sum(a.QTYRECD)-sum(a.QTYISSUED) > 0,sum(a.QTYRECD)-sum(a.QTYISSUED),0) as  QTYRECD, if(sum(a.QTYISSUED)-sum(a.QTYRECD) > 0,sum(a.QTYISSUED)-sum(a.QTYRECD),0) as QTYISSUED,'' as FY_YEAR,'' as SERIES_CODE,'' as UM_CODE,'' as PARTICULAR,'' as TRAN_CODE,'' as ITEM_CODE FROM 
						(    
						#Bring year opening balance
				  SELECT '$from_date' AS vrdate,'Opening' as VRNO, YROPQTY as QTYRECD, 0 as QTYISSUED,'' as FY_YEAR,'' as SERIES_CODE,'' as UM_CODE,'' as PARTICULAR,'' as TRAN_CODE,'' as ITEM_CODE FROM MASTER_ITEMBAL WHERE FY_CODE='$macc_year' AND ITEM_CODE='$itemCode'
				  UNION
				  SELECT '$from_date' as vrdate, VRNO  as VRNO,sum(QTYRECD) as QTYRECD, sum(QTYISSUED) as QTYISSUED,FY_YEAR  as FY_YEAR,SERIES_CODE  as SERIES_CODE,UM_CODE as UM_CODE,PARTICULAR as PARTICULAR,TRAN_CODE as TRAN_CODE,ITEM_CODE as ITEM_CODE
	 				 FROM ITEM_LEDGER WHERE 1=1 $strWhere AND  VRDATE BETWEEN '$from_date1' AND DATE_SUB('$from_date1',INTERVAL 1 DAY ) ) a)
						UNION    
					(
					SELECT date(VRDATE) as vrdate,VRNO as VRNO, QTYRECD as QTYRECD, QTYISSUED as QTYISSUED,FY_YEAR as fy_year,SERIES_CODE as SERIES_CODE,UM_CODE as UM_CODE,PARTICULAR as PARTICULAR,TRAN_CODE as TRAN_CODE,ITEM_CODE as ITEM_CODE FROM ITEM_LEDGER where 1=1 $strWhere AND VRDATE BETWEEN '$from_date1' AND '$to_date1' ))
					t JOIN (SELECT @running_total:=0) r ORDER BY VRDATE");*/

              //dd(DB::getQueryLog());

				$serieCD='';
				$acct_code='';
				$glC_code='';
	           	$discriptn_page = "Search item ledger report by user";
				$this->userLogInsert($userid,$serieCD,$vrseq_num,$acct_code,$discriptn_page,$glC_code);
   
                 return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $title = 'Item Ledger';

        //DB::enableQueryLog();
        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

            foreach ($item_um_aum_list as $key) {
                $userdata['fromDate'] =  $key->FY_FROM_DATE;
                $userdata['toDate']   =  $key->FY_TO_DATE;
            }

		$itemc_list = DB::table('MASTER_ITEM')->get();
		$pfct_list  = DB::table('MASTER_PFCT')->get();
		
		$tran_list  = DB::table('MASTER_TRANSACTION')->get();

        if(isset($company_name)){

        return view('admin.finance.report.item_ledger_report',$userdata+compact('title','itemc_list','pfct_list','macc_year','tran_list'));
        }else{
        return redirect('/useractivity');
        }
        
    }



public function ReportItemLedgerPdf(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->item_code || $request->pfct_code || $request->vr_num || $request->tran_code )) {

					$itemCode  = $request->item_code;
					$pfct_code = $request->pfct_code;
					$vr_num    = $request->vr_num;
					$tran_code = $request->tran_code;
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];

                $bgdate     = $request->session()->get('yrbgdate');
                $yrbgdate = date("Y-m-d", strtotime($bgdate));

                $macc_year = $request->session()->get('macc_year');
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                $from_date = $request->from_date;
                $from_date1 = date("Y-m-d", strtotime($request->from_date));

                $to_date = $request->to_date;

                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                $oneDayBack	=date('Y-m-d', strtotime('-1 day', strtotime($from_date1)));

                $strWhere='';
                $strWhere1='';
                
                /*if(isset($from_date1)  && trim($from_date1)!="")
	      	 	{
	      		$strWhere .="AND VRDATE BETWEEN '$from_date1' and '$to_date1'";
	      		}*/

                if(isset($itemCode)  && trim($itemCode)!="")
                {
                 $strWhere .= "AND ITEM_CODE='$itemCode'";
                 $strWhere1 .= "AND ITEM_CODE='$itemCode'";
                }

                if(isset($pfct_code)  && trim($pfct_code)!="")
                {
                    $strWhere .= "AND PFCT_CODE='$pfct_code'";
                    $strWhere1 .= "AND PFCT_CODE='$pfct_code'";
                }

                if(isset($vr_num)  && trim($vr_num)!="")
                {
                    $strWhere .= "AND VRNO='$vr_num'";
                    $strWhere1 .= "AND VRNO='$vr_num'";
                }

                if(isset($tran_code)  && trim($tran_code)!="")
                {
                    $strWhere .= "AND TRAN_CODE='$tran_code'";
                    $strWhere1 .= "AND TRAN_CODE='$tran_code'";
                }

              // DB::enableQueryLog();
               
             $data['data030'] = DB::select("SELECT t.VRDATE,t.VRNO ,t.MAVGRATE as MAVGRATE,format(t.QTYRECD,2,'en_IN') as QTYRECD, format(t.QTYISSUED,2,'en_IN') as QTYISSUED, if(t.QTYRECD>0,format(@running_total:=@running_total + t.QTYRECD,2,'en_IN'),format(@running_total:=@running_total - t.QTYISSUED,2,'en_IN')) AS balence,if(t.QTYRECD>t.QTYISSUED,'Dr','Cr') as BalType, t.PARTICULAR as PARTICULAR,t.ITEM_CODE as ITEM_CODE,t.ITEM_NAME as ITEM_NAME,t.gl_code as gl_code,t.fy_code as fy_code,t.series_code as series_code,t.TRAN_CODE as TRAN_CODE,t.CLVAL as CLVAL,'$from_date1' as FromDate,'$to_date1' as ToDate FROM 
				(
				SELECT '$from_date' AS vrdate,'OP-BAL' as vrno,b.MAVGRATE as MAVGRATE,'' as BalType,'' as PARTICULAR,'' as ITEM_CODE,'' as ITEM_NAME,'' as gl_code,'' as fy_code,'' as series_code,'' as TRAN_CODE, if(if(b.QTYRECD>0,b.QTYRECD,0) - if(b.QTYISSUED>0,b.QTYISSUED,0) >0,b.QTYRECD- if(b.QTYISSUED>0,b.QTYISSUED,0),0) as QTYRECD, if(if(b.QTYISSUED>0,b.QTYISSUED,0) - if(b.QTYRECD>0,b.QTYRECD,0) >0,b.QTYISSUED- if(b.QTYRECD>0,b.QTYRECD,0),0) as QTYISSUED,b.CLVAL as CLVAL FROM    
				(
				SELECT '$from_date' AS vrdate,'OP-BAL' as vrno,a.MAVGRATE as MAVGRATE,'' as BalType,'' as PARTICULAR,'' as ITEM_CODE,'' as ITEM_NAME,'' as gl_code,'' as fy_code,'' as series_code,'' as TRAN_CODE, sum(a.QTYRECD) as QTYRECD, sum(a.QTYISSUED) as  QTYISSUED,a.CLVAL as CLVAL FROM 
				((    
#Bring year opening balance
				SELECT '$from_date' AS vrdate,'OP-BAL' as vrno,MAVGRATE as MAVGRATE,'' as BalType,'' as PARTICULAR,'' as ITEM_CODE,'' as ITEM_NAME,'' as gl_code,'' as fy_code,'' as series_code,'' as TRAN_CODE, YROPQTY as QTYRECD, 0 as QTYISSUED,CLVAL as CLVAL  FROM MASTER_ITEMBAL WHERE FY_CODE='$macc_year' AND ITEM_CODE='$itemCode')
				UNION
#Bring transactions during year opening and before from date
				SELECT '$from_date' as vrdate, 'Before Date'  as vrno,'' as MAVGRATE,'' as BalType,PARTICULAR as PARTICULAR,ITEM_CODE as ITEM_CODE,ITEM_NAME as ITEM_NAME,'' as gl_code,fy_code as fy_code,series_code as series_code,TRAN_CODE as TRAN_CODE,sum(QTYRECD) as QTYRECD, sum(QTYISSUED) as QTYISSUED,0 as CLVAL FROM ITEM_LEDGER WHERE 1=1 $strWhere AND vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY) ) a) b
				UNION    
				SELECT date(VRDATE) as vrdate,VRNO as vrno,'' as MAVGRATE,'' as BalType,PARTICULAR as PARTICULAR,ITEM_CODE as ITEM_CODE,ITEM_NAME as ITEM_NAME,'' as gl_code,fy_code as fy_code,series_code as series_code,TRAN_CODE as TRAN_CODE, QTYRECD as QTYRECD,QTYISSUED as QTYISSUED,0 as CLVAL FROM ITEM_LEDGER where 1=1 $strWhere AND VRDATE BETWEEN '$from_date1' AND '$to_date1' ORDER BY vrdate
			       )t  JOIN (SELECT @running_total:=0) r ORDER BY vrdate");

             	//dd(DB::getQueryLog());

	               $party= DB::table('MASTER_ACC')->where('ACC_CODE',$request->acct_code)->get()->first();

	               $plant= DB::table('MASTER_PLANT')->where('COMP_CODE',$compCode)->get()->first();  
	                   
	               $title='Item Ledger Report';

		           header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.pdf_item_ledger_report',$data,compact('party','plant','title'));
                      
                    $path = public_path('dist/downloadpdf'); 

                    $fileName =  time().'.'. 'pdf' ; 

                    $pdf->save($path . '/' . $fileName);

                    $PublicPath = url('public/dist/downloadpdf/');  

                    $downloadPdf = $PublicPath.'/'.$fileName;

                     $response_array['response'] = 'success';
                     $response_array['url'] = $downloadPdf;
                     $response_array['data'] = $data;

                    return $response_array;
                                
            }else{

                $data = array();

                
            }

        }

    }

public function ReportItemStock(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->item_code || $request->getqty || $request->getqtyval)) {

					$itemCode = $request->item_code;
					$qty      = $request->getqty;
					$qtyval   = $request->getqtyval;
					
					//print_r($qtyval);exit;
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];

                $macc_year = $request->session()->get('macc_year');

                $bgdate     = $request->session()->get('yrbgdate');
                $yrbgdate = date("Y-m-d", strtotime($bgdate));

                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');

                $from_date = $request->from_date;

                $from_date1 = date("Y-m-d", strtotime($request->from_date));

                $to_date = $request->to_date;

                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                $oneDayBack	=date('Y-m-d', strtotime('-1 day', strtotime($from_date1)));

				$strWhere  ='';
				$strWhere1 ='';
				$tableName ='';
				$fieldName ='';
				$otherName ='';
				$otherCode ='';
            
				if($itemCode=='ITEM CODE'){	

					$strWhere .= 'AND i.ITEM_CODE=g.ITEM_CODE';
					$tableName .= 'MASTER_ITEM g';
					$fieldName .= 'i.ITEM_CODE as ITEM_CODES,g.ITEM_NAME as ITEM_NAMES';
					$otherName .= 'ITEM_CODES';
					$otherCode .= 'ITEM_NAMES';

                }else if($itemCode=='ITEM TYPE'){	

					$strWhere .= 'AND i.ITEMTYPE_CODE=m.ITEMTYPE_CODE';
					$tableName .= 'MASTER_ITEMTYPE m';
					$fieldName .= 'i.ITEMTYPE_CODE as ITEMTYPE_CODE,m.ITEM_TYPE_NAME as ITEM_TYPE_NAME';
					$otherName .= 'ITEM_TYPE_NAME';
					$otherCode .= 'ITEM_TYPE_CODE';

                }else if($itemCode=='ITEM CATEGORY'){

	                $strWhere .= "AND i.ICATG_CODE=k.ICATG_CODE";
	                $tableName .= 'MASTER_ITEM_CATEGORY k';
					$fieldName .= 'i.ICATG_CODE as ICATG_CODE,k.ICATG_NAME as ICATG_NAME';
					$otherName .= 'ICATG_NAME';
					$otherCode .= 'ICATG_CODE';

                }else if($itemCode=='ITEM CLASS'){

	                $strWhere .= "AND i.ITEMCLASS_CODE=c.ITEMCLASS_CODE";
	                $tableName .= 'MASTER_ITEM_CLASS c';
					$fieldName .= 'i.ITEMCLASS_CODE as ITEMCLASS_CODE,c.ITEMCLASS_NAME as ITEMCLASS_NAME';
					$otherName .= 'ITEMCLASS_NAME';
					$otherCode .= 'ITEMCLASS_CODE';

                }else if($itemCode=='ITEM GROUP'){

	                $strWhere .= "AND i.ITEMGROUP_CODE=g.ITEMGROUP_CODE";
	                $tableName .= 'MASTER_ITEMGROUP g';
					$fieldName .= 'i.ITEMGROUP_CODE as ITEMGROUP_CODE,g.ITEMGROUP_NAME as ITEMGROUP_NAME';
					$otherName .= 'ITEMGROUP_NAME';
					$otherCode .= 'ITEMGROUP_CODE';
                }

               //print_r($tableName);exit;
                if($qty=='quantity'){

	      			$qtyrcd = 'QTYRECD';
	      			$qtyissued = 'QTYISSUED';
	      			$um = 'u.UM_CODE as UM_CODE';

	      		}else if($qty=='aquantity'){
	      			$qtyrcd = 'AQTYRECD';
	      			$qtyissued = 'AQTYISSUED';
	      			$um = 'u.AUM_CODE as AUM_CODE';
	      		}else{

	      		}

					if($qtyval=='clsqty'){
					//DB::enableQueryLog();
						$data = DB::select("SELECT t.ITEM_CODE,i.item_name as item_name, format(t.OPQTY + t.QTYRECD - t.QTYISSUED,3,'en_IN') AS CLSQTY,format(t.OPVAL + t.CRAMT - t.DRAMT,2,'en_IN') AS CLSVAL,$fieldName FROM 
					           (
					            SELECT ITEM_CODE,sum(a.CRAMT) as CRAMT,sum(a.DRAMT) as DRAMT,sum(a.opval) as OPVAL,sum(a.opqty) as OPQTY, sum(a.QTYRECD) as QTYRECD, sum(a.QTYISSUED) as  QTYISSUED, '' as item_name, '' as ITEM_TYPE_CODE, '' as ITEM_TYPE_NAME  FROM 
					            (    
					         #Bring year opening balance
					          SELECT ITEM_CODE,0 AS CRAMT,0 AS DRAMT,YROPVAL AS OPVAL, YROPQTY as OPQTY, 0 as QTYRECD, 0 AS QTYISSUED,'' as item_name, '' as ITEM_TYPE_CODE,'' as ITEM_TYPE_NAME FROM MASTER_ITEMBAL WHERE FY_CODE='$macc_year' AND ITEM_CODE=''
					           UNION ALL
					          #Bring transactions during year opening and before from date
					          SELECT ITEM_CODE as ITEM_CODE,0 AS CRAMT,0 AS DRAMT,CRAMT-DRAMT as OPVAL,QTYRECD-QTYISSUED as OPQTY, 0 as QTYRECD, 0 as QTYISSUED, '' as item_name,'' as ITEM_TYPE_NAME,'' as ITEM_TYPE_CODE FROM ITEM_LEDGER WHERE 1=1 AND vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY)
					            UNION ALL    
					            SELECT ITEM_CODE as ITEM_CODE,CRAMT AS CRAMT,DRAMT AS DRAMT,0 as OPVAL,0 as OPQTY, QTYRECD as QTYRECD, QTYISSUED as QTYISSUED, '' as item_name, '' as ITEM_TYPE_CODE,'' as ITEM_TYPE_NAME  FROM ITEM_LEDGER where 1=1 AND  VRDATE BETWEEN '$from_date1' AND '$to_date1'
					           ) a group by a.ITEM_CODE ORDER BY a.item_code
					           ) t,MASTER_ITEM i,ITEM_LEDGER,$tableName   JOIN (SELECT @running_total:=0)r JOIN (SELECT @running_VALUE:=0)S where t.ITEM_CODE=i.ITEM_CODE $strWhere   group by t.ITEM_CODE");

					//dd(DB::getQueryLog());

					}else if($qtyval=='qtyonly'){


					//DB::enableQueryLog();
							$data = DB::select("SELECT t.ITEM_CODE,i.item_name as item_name, format(t.OPQTY,2,'en_IN') as OPQTY, format(t.QTYRECD,2,'en_IN') as QTYRECD, format(t.QTYISSUED,2,'en_IN') as QTYISSUED, format(t.OPQTY + t.QTYRECD - t.QTYISSUED,3,'en_IN') AS CLSQTY,$fieldName FROM 
					           (
					            SELECT ITEM_CODE,sum(a.opqty) as OPQTY, sum(a.QTYRECD) as QTYRECD, sum(a.QTYISSUED) as  QTYISSUED, '' as item_name, '' as ITEM_TYPE_CODE, '' as ITEM_TYPE_NAME  FROM 
					            (    
					         #Bring year opening balance
					          SELECT ITEM_CODE, YROPQTY as OPQTY, 0 as QTYRECD, 0 AS QTYISSUED,'' as item_name, '' as ITEM_TYPE_CODE,'' as ITEM_TYPE_NAME FROM MASTER_ITEMBAL WHERE FY_CODE='$macc_year' AND ITEM_CODE=''
					           UNION ALL
					          #Bring transactions during year opening and before from date
					          SELECT ITEM_CODE as ITEM_CODE,QTYRECD-QTYISSUED as OPQTY, 0 as QTYRECD, 0 as QTYISSUED, '' as item_name,'' as ITEM_TYPE_NAME,'' as ITEM_TYPE_CODE FROM ITEM_LEDGER WHERE 1=1 AND vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY)
					            UNION ALL    
					            SELECT ITEM_CODE as ITEM_CODE,0 as OPQTY, QTYRECD as QTYRECD, QTYISSUED as QTYISSUED, '' as item_name, '' as ITEM_TYPE_CODE,'' as ITEM_TYPE_NAME  FROM ITEM_LEDGER where 1=1 AND  VRDATE BETWEEN '$from_date1' AND '$to_date1'
					           ) a group by a.ITEM_CODE ORDER BY a.item_code
					           ) t,MASTER_ITEM i,ITEM_LEDGER,$tableName  JOIN (SELECT @running_total:=0)r JOIN (SELECT @running_VALUE:=0)S where t.ITEM_CODE=i.ITEM_CODE $strWhere  group by t.ITEM_CODE");

							//dd(DB::getQueryLog());
							
					}else if($qtyval=='qtyvalue'){
					//DB::enableQueryLog();

						$data = DB::select("SELECT t.ITEM_CODE,i.item_name as item_name,format(t.OPQTY,2,'en_IN') as OPQTY, format(t.QTYRECD,2,'en_IN') as QTYRECD, format(t.QTYISSUED,2,'en_IN') as QTYISSUED, format(t.OPQTY + t.QTYRECD - t.QTYISSUED,3,'en_IN') AS CLSQTY,format(t.OPVAL,2,'en_IN') as OPVAL, format(t.CRAMT,2,'en_IN') as CRAMT, format(t.DRAMT,2,'en_IN') as DRAMT,format(t.OPVAL + t.CRAMT - t.DRAMT,2,'en_IN') AS CLSVAL,$fieldName FROM 
					           (
					            SELECT ITEM_CODE,sum(a.CRAMT) as CRAMT,sum(a.DRAMT) as DRAMT,sum(a.opval) as OPVAL,sum(a.opqty) as OPQTY, sum(a.QTYRECD) as QTYRECD, sum(a.QTYISSUED) as  QTYISSUED, '' as item_name, '' as $otherCode, '' as $otherName   FROM 
					            (    
					         #Bring year opening balance
					          SELECT ITEM_CODE,0 AS CRAMT,0 AS DRAMT,YROPVAL AS OPVAL, YROPQTY as OPQTY, 0 as QTYRECD, 0 AS QTYISSUED,'' as item_name, '' as $otherCode,'' as $otherName  FROM MASTER_ITEMBAL WHERE FY_CODE='$macc_year' AND ITEM_CODE=''
					           UNION ALL
					          #Bring transactions during year opening and before from date
					          SELECT ITEM_CODE as ITEM_CODE,0 AS CRAMT,0 AS DRAMT,CRAMT-DRAMT as OPVAL,QTYRECD-QTYISSUED as OPQTY, 0 as QTYRECD, 0 as QTYISSUED, '' as item_name,'' as $otherCode,'' as $otherName  FROM ITEM_LEDGER WHERE 1=1 AND vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY)
					            UNION ALL    
					            SELECT ITEM_CODE as ITEM_CODE,CRAMT AS CRAMT,DRAMT AS DRAMT,0 as OPVAL,0 as OPQTY, QTYRECD as QTYRECD, QTYISSUED as QTYISSUED, '' as item_name, '' as $otherCode,'' as $otherName   FROM ITEM_LEDGER where 1=1 AND  VRDATE BETWEEN '$from_date1' AND '$to_date1'
					           ) a group by a.ITEM_CODE ORDER BY a.item_code
					           ) t,MASTER_ITEM i,ITEM_LEDGER,$tableName   JOIN (SELECT @running_total:=0)r JOIN (SELECT @running_VALUE:=0)S where t.ITEM_CODE=i.ITEM_CODE $strWhere  group by t.ITEM_CODE");

						//dd(DB::getQueryLog());

					}else{
					//DB::enableQueryLog();
						$data = DB::select("SELECT t.ITEM_CODE, format(t.OPQTY,2,'en_IN') as OPQTY, format(t.QTYRECD,2,'en_IN') as QTYRECD, format(t.QTYISSUED,2,'en_IN') as QTYISSUED, format(t.OPQTY + t.QTYRECD - t.QTYISSUED,2,'en_IN') as balance,i.item_name as item_name,$um,$fieldName FROM 
											(
											SELECT ITEM_CODE,sum(a.opqty) as OPQTY, sum(a.QTYRECD) as QTYRECD, sum(a.QTYISSUED) as  QTYISSUED, '' as item_name,'' as UM_CODE,'' as AUM_CODE, '' as $otherCode, '' as $otherName  FROM 
											(    
											#Bring year opening balance
											SELECT ITEM_CODE, YROPQTY as OPQTY, 0 as QTYRECD, 0 AS QTYISSUED, '' as item_name,'' as UM_CODE,'' as AUM_CODE, '' as $otherCode,'' as $otherName FROM MASTER_ITEMBAL WHERE FY_CODE='$macc_year' AND ITEM_CODE=''
											UNION ALL
											#Bring transactions during year opening and before from date
											SELECT ITEM_CODE as ITEM_CODE,$qtyrcd-$qtyissued as OPQTY, 0 as QTYRECD, 0 as QTYISSUED, '' as item_name,'' as UM_CODE,'' as AUM_CODE,'' as $otherName,'' as $otherCode FROM ITEM_LEDGER WHERE 1=1 AND vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY)
											UNION ALL    
											SELECT ITEM_CODE as ITEM_CODE,0 as OPQTY, $qtyrcd as QTYRECD, $qtyissued as QTYISSUED, '' as item_name,'' as UM_CODE,'' as AUM_CODE, '' as $otherCode,'' as $otherName  FROM ITEM_LEDGER where 1=1 AND  VRDATE BETWEEN '$from_date1' AND '$to_date1'
											) a group by a.ITEM_CODE ORDER BY a.item_code
											) t,MASTER_ITEMUM u,MASTER_ITEM i,ITEM_LEDGER,$tableName   JOIN (SELECT @running_total:=0)r where t.ITEM_CODE=i.ITEM_CODE $strWhere AND t.ITEM_CODE=u.ITEM_CODE  group by t.ITEM_CODE");

					}

              
               	$serieCD='';
				$vrseq_num='';
				$acct_code='';
				$glC_code='';
	           	$discriptn_page = "Search item stock report by user";
				$this->userLogInsert($userid,$serieCD,$vrseq_num,$acct_code,$discriptn_page,$glC_code);
             
                return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $title = 'Item Ledger';

        //DB::enableQueryLog();
        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

            foreach ($item_um_aum_list as $key) {
                $userdata['fromDate'] =  $key->FY_FROM_DATE;
                $userdata['toDate']   =  $key->FY_TO_DATE;
            }

				$item_list = DB::table('MASTER_ITEM')->get();
				$itemt_list = DB::table('MASTER_ITEMTYPE')->get();
				$itemcc_list = DB::table('MASTER_ITEM_CATEGORY')->get();
				$itemc_list = DB::table('MASTER_ITEM_CLASS')->get();
				$itemg_list  = DB::table('MASTER_ITEMGROUP')->get();
		
		$tran_list  = DB::table('MASTER_TRANSACTION')->get();

        if(isset($company_name)){

        	return view('admin.finance.report.item_stock_report',$userdata+compact('title','item_list','itemt_list','itemcc_list','itemc_list','itemg_list','macc_year','tran_list'));
        }else{
        	return redirect('/useractivity');
        }
        
    }

    public function ReportItemStockClsqty(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->item_code || $request->getqty || $request->getqtyval)) {

					$itemCode   = $request->item_code;
					$qty    = $request->getqty;
					$qtyval = $request->getqtyval;
					
					//print_r($qtyval);exit;
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];

                $macc_year = $request->session()->get('macc_year');

                $bgdate     = $request->session()->get('yrbgdate');
                $yrbgdate = date("Y-m-d", strtotime($bgdate));

                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');

                $from_date = $request->from_date;

                $from_date1 = date("Y-m-d", strtotime($request->from_date));

                $to_date = $request->to_date;

                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                $oneDayBack	=date('Y-m-d', strtotime('-1 day', strtotime($from_date1)));

				$strWhere  ='';
				$strWhere1 ='';
				$tableName ='';
				$fieldName ='';
				$otherName ='';
				$otherCode ='';
            

                if($itemCode=='ITEM TYPE')
                {	
				$strWhere .= 'AND i.ITEMTYPE_CODE=m.ITEMTYPE_CODE';
				$tableName .= 'MASTER_ITEMTYPE m';
				$fieldName .= 'i.ITEMTYPE_CODE as ITEMTYPE_CODE,m.ITEM_TYPE_NAME as ITEM_TYPE_NAME';
				$otherName .= 'ITEM_TYPE_NAME';
				$otherCode .= 'ITEM_TYPE_CODE';
                }else if($itemCode=='ITEM CATEGORY')
                {
                $strWhere .= "AND i.ICATG_CODE=k.ICATG_CODE";
                $tableName .= 'MASTER_ITEM_CATEGORY k';
				$fieldName .= 'i.ICATG_CODE as ICATG_CODE,k.ICATG_NAME as ICATG_NAME';
				$otherName .= 'ICATG_NAME';
				$otherCode .= 'ICATG_CODE';
                }else if($itemCode=='ITEM CLASS')
                {
                $strWhere .= "AND i.ITEMCLASS_CODE=c.ITEMCLASS_CODE";
                $tableName .= 'MASTER_ITEM_CLASS c';
				$fieldName .= 'i.ITEMCLASS_CODE as ITEMCLASS_CODE,c.ITEMCLASS_NAME as ITEMCLASS_NAME';
				$otherName .= 'ITEMCLASS_NAME';
				$otherCode .= 'ITEMCLASS_CODE';
                }else if($itemCode=='ITEM GROUP')
                {
                $strWhere .= "AND i.ITEMGROUP_CODE=g.ITEMGROUP_CODE";
                $tableName .= 'MASTER_ITEMGROUP g';
				$fieldName .= 'i.ITEMGROUP_CODE as ITEMGROUP_CODE,g.ITEMGROUP_NAME as ITEMGROUP_NAME';
				$otherName .= 'ITEMGROUP_NAME';
				$otherCode .= 'ITEMGROUP_CODE';
                }

               //print_r($tableName);exit;
                if($qty=='quantity'){

	      			$qtyrcd = 'QTYRECD';
	      			$qtyissued = 'QTYISSUED';

	      		}else if($qty=='aquantity'){
	      			$qtyrcd = 'AQTYRECD';
	      			$qtyissued = 'AQTYISSUED';
	      		}


	   $data = DB::select("SELECT t.ITEM_CODE,i.item_name as item_name,i.ITEMTYPE_CODE as ITEMTYPE_CODE,m.ITEM_TYPE_NAME as ITEM_TYPE_NAME, format(@running_total:=@running_total + t.OPQTY + t.QTYRECD - t.QTYISSUED,2,'en_IN') as BALQTY,if(t.QTYRECD>0,format(@running_total:=@running_total + t.QTYRECD,2,'en_IN'),format(@running_total:=@running_total - t.QTYISSUED,2,'en_IN')) AS CLSQTY,format(@running_total:=@running_total + t.OPVAL + t.CRAMT - t.DRAMT,2,'en_IN') as BALVAL,if(t.CRAMT>0,format(@running_total:=@running_total + t.CRAMT,2,'en_IN'),format(@running_total:=@running_total - t.DRAMT,2,'en_IN')) AS CLSVAL FROM 
		(
		SELECT ITEM_CODE,sum(a.opqty) as OPQTY,sum(a.OPVAL) as OPVAL,sum(a.CRAMT) as CRAMT,sum(a.DRAMT) AS DRAMT, sum(a.QTYRECD) as QTYRECD, sum(a.QTYISSUED) as  QTYISSUED, '' as item_name, '' as ITEM_TYPE_CODE, '' as ITEM_TYPE_NAME  FROM 
		(    
		#Bring year opening balance
		SELECT ITEM_CODE, YROPQTY as OPQTY, 0 as QTYRECD, 0 AS QTYISSUED,YROPVAL as OPVAL,0 AS CRAMT,0 AS DRAMT, '' as item_name, '' as ITEM_TYPE_CODE,'' as ITEM_TYPE_NAME FROM MASTER_ITEMBAL WHERE FY_CODE='2021-2022' AND ITEM_CODE=''
		UNION ALL
		#Bring transactions during year opening and before from date
		SELECT ITEM_CODE as ITEM_CODE,QTYRECD-QTYISSUED as OPQTY,CRAMT-DRAMT as OPVAL,0 AS CRAMT,0 AS DRAMT, 0 as QTYRECD, 0 as QTYISSUED, '' as item_name,'' as ITEM_TYPE_NAME,'' as ITEM_TYPE_CODE FROM ITEM_LEDGER WHERE 1=1 AND vrdate BETWEEN '2021-04-01' AND DATE_SUB('2021-04-01',INTERVAL 1 DAY)
		UNION ALL    
		SELECT ITEM_CODE as ITEM_CODE,CRAMT AS CRAMT,DRAMT AS DRAMT,0 as OPQTY,0 as OPVAL, QTYRECD as QTYRECD, QTYISSUED as QTYISSUED, '' as item_name, '' as ITEM_TYPE_CODE,'' as ITEM_TYPE_NAME  FROM ITEM_LEDGER where 1=1 AND  VRDATE BETWEEN '2021-04-01' AND '2022-04-01'
		) a group by a.ITEM_CODE ORDER BY a.item_code
		) t,MASTER_ITEM i,ITEM_LEDGER,MASTER_ITEMTYPE m   JOIN (SELECT @running_total:=0)r where t.ITEM_CODE=i.ITEM_CODE AND i.ITEMTYPE_CODE=m.ITEMTYPE_CODE   group by t.ITEM_CODE");



			
             
                  return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $title = 'Item Ledger';

        //DB::enableQueryLog();
        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

            foreach ($item_um_aum_list as $key) {
                $userdata['fromDate'] =  $key->FY_FROM_DATE;
                $userdata['toDate']   =  $key->FY_TO_DATE;
            }

		$item_list = DB::table('MASTER_ITEM')->get();
		$itemt_list = DB::table('MASTER_ITEMTYPE')->get();
		$itemcc_list = DB::table('MASTER_ITEM_CATEGORY')->get();
		$itemc_list = DB::table('MASTER_ITEM_CLASS')->get();
		$itemg_list  = DB::table('MASTER_ITEMGROUP')->get();
		
		$tran_list  = DB::table('MASTER_TRANSACTION')->get();

        if(isset($company_name)){

        return view('admin.finance.report.item_stock_report',$userdata+compact('title','item_list','itemt_list','itemcc_list','itemc_list','itemg_list','macc_year','tran_list'));
        }else{
        return redirect('/useractivity');
        }
        
    }


 

public function ReportItemLedger11(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->item_code || $request->pfct_code || $request->vr_num || $request->tran_code )) {

					$itemCode  = $request->item_code;
					$pfct_code = $request->pfct_code;
					$vr_num    = $request->vr_num;
					$tran_code = $request->tran_code;
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];
                $macc_year = $request->session()->get('macc_year');
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                $from_date = $request->from_date;
                $from_date1 = date("Y-m-d", strtotime($request->from_date));

                $to_date = $request->to_date;

                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                $oneDayBack	=date('Y-m-d', strtotime('-1 day', strtotime($from_date1)));

                $strWhere='';
                $strWhere1='';
                
                if(isset($from_date1)  && trim($from_date1)!="")
	      	 	{
	      		$strWhere .="AND vr_date BETWEEN '$from_date1' and '$to_date1'";
	      		}

                if(isset($itemCode)  && trim($itemCode)!="")
                {
                 $strWhere .= "AND item_code='$itemCode'";
                 $strWhere1 .= "AND item_code='$itemCode'";
                }

                if(isset($pfct_code)  && trim($pfct_code)!="")
                {
                    $strWhere .= "AND pfct_code='$pfct_code'";
                    $strWhere1 .= "AND pfct_code='$pfct_code'";
                }

                if(isset($vr_num)  && trim($vr_num)!="")
                {
                    $strWhere .= "AND vr_no='$vr_num'";
                    $strWhere1 .= "AND vr_no='$vr_num'";
                }

                if(isset($tran_code)  && trim($tran_code)!="")
                {
                    $strWhere .= "AND trans_code='$tran_code'";
                    $strWhere1 .= "AND trans_code='$tran_code'";
                }

               
               
                	$data = DB::select("SELECT t.vrdate,t.vrno, format(t.recieved_qty,2,'en_IN') as recieved_qty, format(t.issued_qty,2,'en_IN') as issued_qty, format(@running_total:=@running_total + t.recieved_qty-t.issued_qty,2,'en_IN') AS balence,t.fy_year as fy_year,t.series_code as series_code,t.um_code as um_code,t.discription as discription FROM 
						((
						SELECT '$from_date' AS vrdate,'Opening Balance' as vrno, if(sum(a.recieved_qty)-sum(a.issued_qty) > 0,sum(a.recieved_qty)-sum(a.issued_qty),0) as  recieved_qty, if(sum(a.issued_qty)-sum(a.recieved_qty) > 0,sum(a.issued_qty)-sum(a.recieved_qty),0) as issued_qty,'' as fy_year,'' as series_code,'' as um_code,'' as discription FROM 
						(    
						#Bring year opening balance
						SELECT '$from_date' AS vrdate,'Opening' as vrno, yrQtyRecd as recieved_qty, yrQtyIssued as issued_qty,'' as fy_year,'' as series_code,'' as um_code,'' as discription FROM master_item_balance WHERE fiscal_year='$macc_year' AND item_code='$itemCode'
						UNION

					SELECT '$from_date' as vrdate, 'Before Date'  as vrno,sum(recieved_qty) as recieved_qty, sum(issued_qty) as issued_qty,fy_year as fy_year,series_code as series_code,um_code as um_code,discription as discription
	 				 FROM item_ledger WHERE vr_date BETWEEN '$from_date1' AND DATE_SUB('$from_date1',INTERVAL 1 DAY ) AND item_code='$itemCode') a)
						UNION    
					(
					SELECT date(vr_date) as vrdate,vr_no as vrno, recieved_qty as recieved_qty, issued_qty as issued_qty,fy_year as fy_year,series_code as series_code,um_code as um_code,discription as discription FROM item_ledger where vr_date BETWEEN '$from_date1' AND '$to_date1' AND item_code='$itemCode'))
					t JOIN (SELECT @running_total:=0) r ORDER BY vrdate");
   
                  return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $title = 'Item Ledger';

        //DB::enableQueryLog();
        $item_um_aum_list = DB::table('master_fy')->where('comp_code',$CCFromSession)->where('fy_code',$macc_year)->get();

            foreach ($item_um_aum_list as $key) {
                $userdata['fromDate'] =  $key->fy_from_date;
                $userdata['toDate']   =  $key->fy_to_date;
            }

        $itemc_list = DB::table('master_item_finance')->get();
        $pfct_list        = DB::table('master_pfct')->get();

        $tran_list        = DB::table('master_transaction')->get();

        if(isset($company_name)){

        return view('admin.finance.report.item_ledger_report',$userdata+compact('title','itemc_list','pfct_list','macc_year','tran_list'));
        }else{
        return redirect('/useractivity');
        }
        
    }


public function ReportItemLedger12(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->item_code || $request->pfct_code || $request->vr_num || $request->tran_code )) {

					$itemCode  = $request->item_code;
					$pfct_code = $request->pfct_code;
					$vr_num    = $request->vr_num;
					$tran_code = $request->tran_code;
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];
                $macc_year = $request->session()->get('macc_year');
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));

                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                $oneDayBack	=date('Y-m-d', strtotime('-1 day', strtotime($from_date1)));

                $strWhere='';
                $strWhere1='';
                
                if(isset($from_date1)  && trim($from_date1)!="")
	      	 	{
	      		$strWhere .="AND vr_date BETWEEN '$from_date1' and '$to_date1'";
	      		}

                if(isset($itemCode)  && trim($itemCode)!="")
                {
                 $strWhere .= "AND item_code='$itemCode'";
                 $strWhere1 .= "AND item_code='$itemCode'";
                }

                if(isset($pfct_code)  && trim($pfct_code)!="")
                {
                    $strWhere .= "AND pfct_code='$pfct_code'";
                    $strWhere1 .= "AND pfct_code='$pfct_code'";
                }

                if(isset($vr_num)  && trim($vr_num)!="")
                {
                    $strWhere .= "AND vr_no='$vr_num'";
                    $strWhere1 .= "AND vr_no='$vr_num'";
                }

                if(isset($tran_code)  && trim($tran_code)!="")
                {
                    $strWhere .= "AND trans_code='$tran_code'";
                    $strWhere1 .= "AND trans_code='$tran_code'";
                }

               
               
                //DB::enableQueryLog();
               DB::table('item_ledger_temp')->truncate();

                /*$data0 = DB::select("SELECT * FROM `item_ledger` where 1=1  $strWhere AND fy_year='$macc_year' ORDER BY  vr_no desc");*/
                	//DB::enableQueryLog();
                $data0 = DB::SELECT("SELECT * FROM item_ledger   where 1=1 $strWhere ORDER BY  vr_no desc");



               //print_r($data0);exit;
                //dd(DB::getQueryLog());

                //DB::enableQueryLog();
                $backdata = DB::select("SELECT * FROM item_ledger  where 1=1  $strWhere1 AND vr_date='$oneDayBack' ORDER BY  vr_no desc");

                /*$backdata = DB::SELECT("SELECT t2.* FROM item_ledger t2 LEFT JOIN master_itemum_finance t1 ON t1.item_code = t2.item_code $strWhere1 AND t2.vr_date='$oneDayBack' ORDER BY  vr_no desc");*/
                //dd(DB::getQueryLog());
                $one_day_back = json_decode(json_encode($backdata), true); 

                $reciveQty=0;
				$issuedQty=0;
                foreach ($one_day_back as $row) {
                	$reciveQty += $row['recieved_qty'];
                	$issuedQty += $row['issued_qty'];
                }
                 $openingBal = $reciveQty - $issuedQty;

                $data01 = json_decode(json_encode($data0), true); 

                $getData = array();
                $counter = 1;
                $counter1 = 1;
                foreach ($data01 as $row) {
                	 $receivQty = $row['recieved_qty'];
                	 $issedQty = $row['issued_qty'];

                	 if($receivQty){
                	 	$closeQty = $receivQty;
                	 }else if($issedQty){
                	 	$closeQty = $issedQty;
                	 }else{
                	 	$closeQty = null;
                	 }

                	 $getData[] = $row;
                	 if($counter == $counter1){

                	 	$arraydta =  array(
							'comp_code'    => $row['comp_code'],
							'fy_year'      => $row['fy_year'],
							'vr_date'      => $row['vr_date'],
							'vr_no'        => $row['vr_no'],
							'trans_code'   => $row['trans_code'],
							'pfct_code'    => $row['pfct_code'],
							'series_code'  => $row['series_code'],
							'item_code'    => $row['item_code'],
							'item_name'    => $row['item_name'],
							'discription'  => $row['discription'],
							'recieved_qty' => $row['recieved_qty'],
							'issued_qty'   => $row['issued_qty'],
							'closing_qty'  => $closeQty,
							'opn_bal'      => $openingBal,
							'rate'         => $row['rate'],
							'basic'        => $row['basic'],
							'um_code'      => $row['um_code'],
						);

						DB::table('item_ledger_temp')->insert($arraydta);
                	 }else{

                	 	 $lastid= DB::getPdo()->lastInsertId();

                	 	 if(isset($lastid)){
                            $data3 = DB::table('item_ledger_temp')
                            ->where(['id'=>$lastid])
                            ->get()->first();
                            $dataitem = json_decode(json_encode($data3), true);

                            if($dataitem['closing_qty'] == 0.00){
                            	if($dataitem['recieved_qty']){
                            		$closing_qty1 = abs($dataitem['closing_qty'] + $closeQty);
                            	}else if($dataitem['issued_qty']){
                            		$closing_qty1 = abs($dataitem['closing_qty'] + $closeQty);
                            	}else{

                            	}
                            }

                            if($dataitem['recieved_qty'] && $row['recieved_qty']){
                            	$closing_qty1 = abs($dataitem['closing_qty'] + $closeQty);
                            }else if($dataitem['issued_qty'] && $row['issued_qty']){

                            	$closing_qty1 = abs($dataitem['closing_qty'] + $closeQty);
                            }else if($dataitem['recieved_qty'] && $row['issued_qty']){
                            	$closing_qty1 = abs($dataitem['closing_qty'] - $closeQty);
                            }else if($dataitem['issued_qty'] && $row['recieved_qty']){
                            	$closing_qty1 = abs($dataitem['closing_qty'] - $closeQty);
                            }

                            

                    	}

                    	$arraydta_1 =  array(
							'comp_code'    => $row['comp_code'],
							'fy_year'      => $row['fy_year'],
							'vr_date'      => $row['vr_date'],
							'vr_no'        => $row['vr_no'],
							'trans_code'   => $row['trans_code'],
							'pfct_code'    => $row['pfct_code'],
							'series_code'  => $row['series_code'],
							'item_code'    => $row['item_code'],
							'item_name'    => $row['item_name'],
							'discription'  => $row['discription'],
							'recieved_qty' => $row['recieved_qty'],
							'issued_qty'   => $row['issued_qty'],
							'closing_qty'  => $closing_qty1,
							'opn_bal'      => $openingBal,
							'rate'         => $row['rate'],
							'basic'        => $row['basic'],
							'um_code'      => $row['um_code'],
						);

                    	DB::table('item_ledger_temp')->insert($arraydta_1);
                	 	
                	 }
               	$counter++;
                } // ./foreach close
                //DB::enableQueryLog();
                $data030 = DB::table('item_ledger_temp')->get();
               // dd(DB::getQueryLog());
                $data031 = json_decode(json_encode($data030), true);
                //$data0310['item_temp'] = json_decode(json_encode($data030), true);

                $itmList =array();

                foreach ($data031 as $key ) {

                	if($key['trans_code'] == 'P4'){
                		
                		$itmList[] =  DB::table('grn_head')->select('grn_head.*', 'grn_body.*')
		           		->leftjoin('grn_body', 'grn_body.grn_head_id', '=', 'grn_head.id')
		           		->where([['grn_head.vr_no','=',$key['vr_no']],['grn_head.tran_code','=',$key['trans_code']],['grn_head.series_code','=',$key['series_code']],['grn_body.item_code','=',$key['item_code']]])
		            	->get()->toArray();
		            	
                	}else if($key['trans_code'] == 'S3'){

                		$itmList[] =  DB::table('sales_head')->select('sales_head.*', 'sales_body.*')
		           		->leftjoin('sales_body', 'sales_body.sales_head_id', '=', 'sales_head.id')
		           		->where([['sales_head.vr_no','=',$key['vr_no']],['sales_head.tran_code','=',$key['trans_code']],['sales_head.series_code','=',$key['series_code']],['sales_body.item_code','=',$key['item_code']]])
		            	->get()->toArray();

                	}else if($key['trans_code'] == 'I1'){
                		$itmList[] =  DB::table('master_item_balance')->where('item_code',$key['item_code'])->get();
                	}else if($key['trans_code'] == 'R3'){

                		$itmList[] =  DB::table('store_return_heads')->select('store_return_heads.*', 'store_return_bodies.*')
		           		->leftjoin('store_return_bodies', 'store_return_bodies.store_return_head_id', '=', 'store_return_heads.id')
		           		->where([['store_return_heads.vr_no','=',$key['vr_no']],['store_return_heads.tran_code','=',$key['trans_code']],['store_return_heads.series_code','=',$key['series_code']],['store_return_bodies.item_code','=',$key['item_code']]])
		            	->get()->toArray();
                	}else if($key['trans_code'] == 'S9'){
                		$itmList[] =  DB::table('store_requisition_heads')->select('store_requisition_heads.*', 'store_requisition_bodies.*')
		           		->leftjoin('store_requisition_bodies', 'store_requisition_bodies.store_requistion_head_id', '=', 'store_requisition_heads.id')
		           		->where([['store_requisition_heads.vr_no','=',$key['vr_no']],['store_requisition_heads.tran_code','=',$key['trans_code']],['store_requisition_heads.series_code','=',$key['series_code']],['store_requisition_bodies.item_code','=',$key['item_code']]])
		            	->get()->toArray();
                	}
                	/*echo "<PRE>";
                	print_r($key['vr_no']);
                	echo "<PRE>";
                	print_r($key['trans_code']);
                	echo "<PRE>";
                	print_r($key['series_code']);
                	echo "<PRE>";
                	print_r($key['item_code']);
                	echo "</PRE>";*/
                }
               // $data031['item_list'] = json_decode(json_encode($itmList), true);
                //echo "<PRE>";

                	//print_r($data0310);
             
               // $data = $data031;
                   
               return DataTables()->of($data031)->addIndexColumn()->make(true);
                                
            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $title = 'Item Ledger';

        //DB::enableQueryLog();
        $item_um_aum_list = DB::table('master_fy')->where('comp_code',$CCFromSession)->where('fy_code',$macc_year)->get();

            foreach ($item_um_aum_list as $key) {
                $userdata['fromDate'] =  $key->fy_from_date;
                $userdata['toDate']   =  $key->fy_to_date;
            }

        $itemc_list = DB::table('master_item_finance')->get();
        $pfct_list        = DB::table('master_pfct')->get();

        $tran_list        = DB::table('master_transaction')->get();

        if(isset($company_name)){

        return view('admin.finance.report.item_ledger_report',$userdata+compact('title','itemc_list','pfct_list','macc_year','tran_list'));
        }else{
        return redirect('/useractivity');
        }
        
    }

/*item ledger report*/

	public function GetDataFromTransInItemLedger(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$vrNo    = $request->input('vrNo');
			$transC  = $request->input('transC');
			$itmC    = $request->input('itmC');

		//print_r($transC);exit;
			if($transC == 'P4'){

				$fetch_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.TRAN_HEAD,t4.AQTYRECD AS RECDAQTY,t4.AQTYISSUED AS ISSUEDAQTY,t4.PARTICULAR,t5.ACC_NAME FROM GRN_BODY t2 LEFT JOIN GRN_HEAD t1 ON t1.GRNHID = t2.GRNHID LEFT JOIN MASTER_TRANSACTION t3 ON t3.TRAN_CODE = t2.TRAN_CODE LEFT JOIN MASTER_ACC t5 ON t5.ACC_CODE = t1.ACC_CODE LEFT JOIN ITEM_LEDGER t4 ON t4.TRAN_CODE = t3.TRAN_CODE WHERE t2.ITEM_CODE='$itmC' AND t1.VRNO='$vrNo' AND t1.TRAN_CODE='$transC'");

			}else if($transC == 'R3'){
				$fetch_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.TRAN_HEAD,t4.AQTYRECD AS RECDAQTY,t4.AQTYISSUED AS ISSUEDAQTY,t4.PARTICULAR  FROM SRET_BODY t2 LEFT JOIN SRET_HEAD t1 ON t1.SRETHID = t2.SRETHID  LEFT JOIN MASTER_TRANSACTION t3 ON t3.TRAN_CODE = t2.TRAN_CODE  LEFT JOIN ITEM_LEDGER t4 ON t4.TRAN_CODE = t3.TRAN_CODE WHERE t2.ITEM_CODE='$itmC' AND t1.VRNO='$vrNo' AND t1.TRAN_CODE='$transC'");

			}else if($transC == 'S8' || $transC == 'S9'){
				$fetch_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.TRAN_HEAD,t4.AQTYRECD AS RECDAQTY,t4.AQTYISSUED AS ISSUEDAQTY,t4.PARTICULAR FROM SREQ_BODY t2 LEFT JOIN SREQ_HEAD t1 ON t1.SREQHID = t2.SREQHID LEFT JOIN MASTER_TRANSACTION t3 ON t3.TRAN_CODE = t2.TRAN_CODE  LEFT JOIN ITEM_LEDGER t4 ON t4.TRAN_CODE = t3.TRAN_CODE WHERE t2.ITEM_CODE='$itmC' AND t1.VRNO='$vrNo' AND t1.TRAN_CODE='$transC'");
			}
			else if($transC == 'S4'){
				$fetch_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.TRAN_HEAD,t4.AQTYRECD AS RECDAQTY,t4.AQTYISSUED AS ISSUEDAQTY,t4.PARTICULAR,t5.ACC_NAME FROM SCHALLAN_BODY t2 LEFT JOIN SCHALLAN_HEAD t1 ON t1.SCHALLANHID = t2.SCHALLANHID LEFT JOIN MASTER_TRANSACTION t3 ON t3.TRAN_CODE = t2.TRAN_CODE LEFT JOIN MASTER_ACC t5 ON t5.ACC_CODE = t1.ACC_CODE LEFT JOIN ITEM_LEDGER t4 ON t4.TRAN_CODE = t3.TRAN_CODE WHERE t2.ITEM_CODE='$itmC' AND t1.VRNO='$vrNo' AND t1.TRAN_CODE='$transC'");
			}
          //  print_r($fetch_reocrd);exit;

            if ($fetch_reocrd) {

				$response_array['response'] = 'success';
				$response_array['data']     = $fetch_reocrd;
				
				//$response_array['levelAmt']    = $levelAmt;

                $data = json_encode($response_array);
                print_r($data);

            }else{

				$response_array['response'] = 'error';
				$response_array['data']     = '' ;
				$response_array['message']     = 'NOT FOUND';
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


    public function GetDataFromTransInAccLedger(Request $request){

    	$response_array = array();

        if ($request->ajax()) {	
			
			$compName    = $request->session()->get('company_name');
			$explodeCode = explode('-', $compName);
			$compcode    = $explodeCode[0];
			$vrNo        = $request->input('vrNo');
			$transC      = $request->input('transC');
			$acC         = $request->input('acC');
			$glC         = $request->input('glC');
			$headId      = $request->input('headId');
			$acctCdH     = $request->input('acctCdH');
			$gl_CdH      = $request->input('gl_CdH');

			if($acctCdH){
                
 				//dd(DB::getQueryLog());
                //DB::enableQueryLog();
				//$ledger = DB::SELECT("SELECT t1.*,t2.TRAN_HEAD,t3.ACC_NAME FROM ACC_TRAN t1 LEFT JOIN MASTER_TRANSACTION t2 ON t2.TRAN_CODE = t1.TRAN_CODE LEFT JOIN MASTER_ACC t3 ON t3.ACC_CODE = t1.ACC_CODE WHERE t1.VRNO='$vrNo' AND t1.ACC_CODE='$acC'");

				$ledger = DB::SELECT("SELECT *,(SELECT TRAN_HEAD FROM MASTER_TRANSACTION WHERE TRAN_CODE=ACC_TRAN.TRAN_CODE) AS TRAN_HEAD,REF_CODE AS GLCODE,REF_NAME AS GLNAME,'' AS ACCCODE,'' AS ACCNAME FROM ACC_TRAN WHERE ACCTRANID='$headId' AND COMP_CODE='$compcode'");

				$purchase_head = DB::SELECT("SELECT t1.* FROM PBILL_HEAD t1  WHERE t1.VRNO ='$vrNo' AND t1.TRAN_CODE ='$transC'");

			//dd(DB::getQueryLog());
			}else if($gl_CdH){

				//DB::enableQueryLog();
				$ledger = DB::SELECT("SELECT *,(SELECT TRAN_HEAD FROM MASTER_TRANSACTION WHERE TRAN_CODE=GL_TRAN.TRAN_CODE) AS TRAN_HEAD,REF_CODE AS GLCODE,REF_NAME AS GLNAME,ACC_CODE AS ACCCODE,ACC_NAME AS ACCNAME FROM GL_TRAN WHERE GLTRANID='$headId' AND COMP_CODE='$compcode'");

				$purchase_head = DB::SELECT("SELECT t1.* FROM PBILL_HEAD t1  WHERE t1.VRNO ='$vrNo' AND t1.TRAN_CODE ='$transC'");
				//dd(DB::getQueryLog());

			}

            
			//print_r($ledger);exit;

            if ($ledger!='') {

				$response_array['response']      = 'success';
				$response_array['data']          = $ledger;
				$response_array['purchase_head'] = $purchase_head;
				

                $data = json_encode($response_array);
                print_r($data);

            }else{

				$response_array['response'] = 'error';
				$response_array['data']     = '' ;
				$response_array['message']    = 'NOT FOUND';
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

/*acc ledger  report*/
public function TrialBalReportPdf(Request $request){


	 if ($request->ajax()) {

            if (!empty($request->from_date)) {

                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];

                $bgdate     = $request->session()->get('yrbgdate');
                $yrbgdate = date("Y-m-d", strtotime($bgdate));

                $macc_year = $request->session()->get('macc_year');
               
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));
                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                //DB::table('acc_ledger_temp')->truncate();

                $strwhere='';
                if(isset($from_date1)  && trim($from_date1)!="")
                {
                    	$strwhere .="AND vr_date BETWEEN '$from_date1' AND '$to_date1'";
                }

// DB::enableQueryLog();
                
 //dd(DB::getQueryLog());
             	//DB::enableQueryLog();
                $data= DB::select("SELECT t.GL_CODE,m.gl_name as gl_name, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt>=0, t.yropdr-t.yropcr+t.yrdramt-t.yrcramt,0) as cldramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt<0, abs(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt),0) as clcramt FROM
					(
					SELECT GL_CODE,'' as gl_name, sum(a.yropdr) as yropdr, sum(a.yropcr) as yropcr, sum(a.yrdramt) as yrdramt, sum(a.yrcramt) as yrcramt, 0 as cldramt, 0 as clcramt FROM
					(
#Bring year opening balance
				 	SELECT '' as GL_CODE, yropdr as yropdr, yropcr as yropcr, 0 as yrdramt, 0 as yrcramt,'' as gl_name FROM MASTER_ACCBAL WHERE FY_CODE='$macc_year'
					UNION ALL
#Bring transactions during year opening and before from date
					SELECT GL_CODE, dramt as yropdr, cramt as yropcr, 0 as yrdramt, 0 as yrcramt,'' as gl_name FROM LEDGER_TRAN WHERE vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY)
					UNION ALL   
#Bring transactions during from date and to date
					SELECT GL_CODE, 0 as yropdr, 0 as yropcr, if(dramt is NULL,0,dramt) as yrdramt, if(cramt is NULL,0,cramt) as yrcramt,'' as gl_name FROM LEDGER_TRAN WHERE vrdate BETWEEN '$from_date1' AND '$to_date1'
					) a group by a.GL_CODE order by a.GL_CODE) t,MASTER_GL m where m.gl_code=t.gl_code");
                //dd(DB::getQueryLog());
//print_r($data);exit;
	            
               $party= DB::table('MASTER_ACC')->where('ACC_CODE',$request->acct_code)->get()->first();

                $plant= DB::table('MASTER_PLANT')->where('COMP_CODE',$compCode)->get()->first();  
                   
               $title='Account Ledger Report';

	           header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.pdf_acc_ledger_report',$data,compact('party','plant','title'));
                      
                    $path = public_path('dist/downloadpdf'); 

                    $fileName =  time().'.'. 'pdf' ; 

                    $pdf->save($path . '/' . $fileName);

                    $PublicPath = url('public/dist/downloadpdf/');  

                    $downloadPdf = $PublicPath.'/'.$fileName;

                     $response_array['response'] = 'success';
                     $response_array['url'] = $downloadPdf;
                     $response_array['data'] = $data;

                    return $response_array;
                                
            }else{

                $data = array();

               
            }

        }

       
        
    }

/* --------- create entry in USER_LOG when user submit any form ------*/

	function userLogInsert($loginuserId,$seriesCd,$vrno,$accCode,$perticular,$glCode){
		
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
				'SERIES_CODE' =>$seriesCd,
				'VRNO'        =>$vrno,
				'GL_CODE'     =>$glCode,
				'ACC_CODE'    =>$accCode,
				'PERTICULAR'  =>$discptn,
				'CREATED_BY'  =>$loginuserId
			);
			DB::table('USER_LOG')->insert($userLog);
		
	}

/* --------- create entry in USER_LOG when user submit any form ------*/


/* ........Dynamic Query Function.......... */
	
	public function dynamicQuery(Request $request){

    	$title ='Dynamic Query';
			$compName   = $request->session()->get('company_name');
			$macc_year  = $request->session()->get('macc_year');
			$usertype   = $request->session()->get('user_type');
			$userid     = $request->session()->get('userid');

			$getcomcode = explode('-', $compName);
			$compCode   = $getcomcode[0];

			$userdata['comp_list'] = DB::table('MASTER_COMP')->get();
			$userdata['dept_mst_list'] = DB::table('MASTER_DEPT')->Orderby('DEPT_CODE', 'desc')->limit(5)->get();

			$TranCode   = 'A0';
			$Tran_Code2 = 'A1';

      $functionData = DB::table('MASTER_FY')->where('COMP_CODE',$compCode)->where('FY_CODE',$macc_year)->get();
      $userdata['user_list'] = DB::table('MASTER_USER')->get();
      $userdata['pfct_list'] = DB::table('MASTER_PFCT')->get();
      $userdata['plant_list'] = DB::table('MASTER_PLANT')->get();
      $userdata['tran_list'] = DB::table('MASTER_ENGINETBL_CONFIG')->groupBy('TRAN_CODE')->get();

      foreach ($functionData as $key) {
          $userdata['fromDate'] =  $key->FY_FROM_DATE;
          $userdata['toDate']   =  $key->FY_TO_DATE;
      }

			if(isset($compName)){

		    	return view('admin.finance.report.dynamic_query',$userdata+compact('title'));

		    }else{

				return redirect('/useractivity');
			}

  }

  public function stock_summary(Request $request){

  	$title ='stock_summary';
	$compName   = $request->session()->get('company_name');
	$macc_year  = $request->session()->get('macc_year');
	$usertype   = $request->session()->get('user_type');
	$userid     = $request->session()->get('userid');

	$fisYear      =  $request->session()->get('macc_year');
	$splitYR      = explode('-', $fisYear);
	$startYEar    = $splitYR[0].'-04-01';

	$getcomcode = explode('-', $compName);
	$compCode   = $getcomcode[0];

	$userdata['item_list']       = DB::table('CFSTOCK_LEDGER')->groupBy('ITEM_CODE')->get();
	$userdata['trip_list']       = DB::table('CFSTOCK_LEDGER')->groupBy('CP_CODE')->get();
	$userdata['rake_list']       = DB::table('CFSTOCK_LEDGER')->groupBy('RAKE_NO')->get();
	$userdata['wagon_list']       = DB::table('CFSTOCK_LEDGER')->groupBy('WAGON_NO')->get();
	

	$fyYear_info = DB::table('MASTER_FY')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->get()->first();

	if(isset($compName)){

    	return view('admin.finance.report.C_and_F.stock_summary',$userdata+compact('title','fyYear_info'));

    }else{

		return redirect('/useractivity');
	}

  }

  public function stock_ledger(Request $request){

  	$title ='stock_ledger';
	$compName   = $request->session()->get('company_name');
	$macc_year  = $request->session()->get('macc_year');
	$usertype   = $request->session()->get('user_type');
	$userid     = $request->session()->get('userid');

	$fisYear      =  $request->session()->get('macc_year');
	$splitYR      = explode('-', $fisYear);
	$startYEar    = $splitYR[0].'-04-01';

	$getcomcode = explode('-', $compName);
	$compCode   = $getcomcode[0];

	$userdata['item_list']       = DB::table('CFSTOCK_LEDGER')->groupBy('ITEM_CODE')->get();
	$userdata['trip_list']       = DB::table('CFSTOCK_LEDGER')->groupBy('CP_CODE')->get();
	$userdata['rake_list']       = DB::table('CFSTOCK_LEDGER')->groupBy('RAKE_NO')->get();
	$userdata['wagon_list']      = DB::table('CFSTOCK_LEDGER')->groupBy('WAGON_NO')->get();
	

	if(isset($compName)){

    	return view('admin.finance.report.C_and_F.stock_ledger',$userdata+compact('title'));

    }else{

		return redirect('/useractivity');
	}

  }

  public function rakeSummaryReport(Request $request){

  	$title = 'Rake Summary Report';
	$compName   = $request->session()->get('company_name');
	$macc_year  = $request->session()->get('macc_year');
	$usertype   = $request->session()->get('user_type');
	$userid     = $request->session()->get('userid');

	$fisYear      =  $request->session()->get('macc_year');
	$splitYR      = explode('-', $fisYear);
	$startYEar    = $splitYR[0].'-04-01';

	$getcomcode = explode('-', $compName);
	$compCode   = $getcomcode[0];

	$userdata['item_list']       = DB::table('RAKE_TRAN')->groupBy('ITEM_CODE')->get();
	$userdata['trip_list']       = DB::table('RAKE_TRAN')->groupBy('CP_CODE')->get();
	$userdata['rake_list']       = DB::table('RAKE_TRAN')->groupBy('RAKE_NO')->get();
	$userdata['wagon_list']       = DB::table('RAKE_TRAN')->groupBy('WAGON_NO')->get();
	

	if(isset($compName)){

    	return view('admin.finance.report.C_and_F.rake_summary',$userdata+compact('title'));

    }else{

		return redirect('/useractivity');
	}

  }

  public function rake_do_summary(Request $request){

  	$title = 'Rake DO Summary Report';
	$compName   = $request->session()->get('company_name');
	$macc_year  = $request->session()->get('macc_year');
	$usertype   = $request->session()->get('user_type');
	$userid     = $request->session()->get('userid');

	$fisYear      =  $request->session()->get('macc_year');
	$splitYR      = explode('-', $fisYear);
	$startYEar    = $splitYR[0].'-04-01';

	$getcomcode = explode('-', $compName);
	$compCode   = $getcomcode[0];

	$userdata['item_list']     = DB::table('DORDER_BODY')->groupBy('ITEM_CODE')->get();
	$userdata['trip_list']     = DB::table('DORDER_BODY')->groupBy('CP_CODE')->get();
	$userdata['rake_list']     = DB::table('DORDER_BODY')->groupBy('RAKE_NO')->get();
	$userdata['toplace_list']  = DB::table('DORDER_BODY')->groupBy('TO_PLACE')->get();
	$userdata['acccode_list']  = DB::table('DORDER_BODY')->groupBy('ACC_CODE')->get();
	

	if(isset($compName)){

    	return view('admin.finance.report.C_and_F.rake_do_summary',$userdata+compact('title'));

    }else{

		return redirect('/useractivity');
	}

  }



  public function TransactionData(Request $request){
  	

		$tranName   = $request->input('tranName');
		$groupVal   = $request->input('groupOne');
		$queryNm    = $request->input('queryNm');
		$userid     = $request->session()->get('userid');
		$compName   = $request->session()->get('company_name');
		$macc_year  = $request->session()->get('macc_year');
		$getcomcode = explode('-', $compName);
		$compCode   = $getcomcode[0];

  	$response_array = array();

  	if(isset($tranName)){
  		
  		//DB::enableQueryLog();

			$dyQueryData = DB::table('DYNAMIC_QUERY_REP')->where('TRAN_HEAD',$tranName)->where('QUERY_NAME_WSPACE',$queryNm)->get()->toArray();
			$tblData     = DB::table('MASTER_ENGINETBL_CONFIG')->where('TRAN_CODE',$tranName)->get()->toArray();
			//dd(DB::getQueryLog());
			$chrTblData  = DB::table('MASTER_ENGINETBL_CONFIG')->where('TRAN_CODE',$tranName)->where('COLUMN_TYPE','varchar')->get()->toArray();

			$intTblData  = DB::table('MASTER_ENGINETBL_CONFIG')->where('TRAN_CODE',$tranName)->where('COLUMN_TYPE','int')->orwhere('COLUMN_TYPE','double')->orwhere('COLUMN_TYPE','float')->get()->toArray();
			$aliesData   = DB::table('MASTER_ENGINETBL_CONFIG')->where('TRAN_CODE',$tranName)->where('COLUMN_NAME',$groupVal)->get()->toArray();


  		if(isset($tblData) && isset($chrTblData) && isset($intTblData) || isset($aliesData) || isset($dyQueryData)){

				$response_array['response']     = 'success';
				$response_array['configTbl']    = $tblData;
				$response_array['chrConfigTbl'] = $chrTblData;
				$response_array['intConfigTbl'] = $intTblData;
				$response_array['aliesTData']   = $aliesData;
				$response_array['dynamicQData'] = $dyQueryData;

	  		$data = json_encode($response_array);
        print_r($data);

  		}else{

				$response_array['response']        = 'error';
				$response_array['engineConfigTbl'] = '';
				$response_array['chrConfigTbl']    = '';
				$response_array['intConfigTbl']    = '';

	  		$data = json_encode($response_array);
        print_r($data);

  		}


  }
	
}

	public function dynamicQuerySave(Request $request,$dynamicQuery,$tranCode,$reportName,$user_name,$fromdate,$todate,$queryName,$queryNameWS,$groupOneval,$groupTwoval,$groupThreeVal,$dataColumn,$columnNameFr,$columnNameSc,$columnNameThr,$columnNameFour){

			$compName    = $request->session()->get('company_name');
      $compcode    = explode('-', $compName);
      $getcompcode =  $compcode[0];
      $macc_year   = $request->session()->get('macc_year');
				
			date_default_timezone_set('Asia/Kolkata');

				$headers = [
			              'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			          ];

				$from_date = date("Y-m-d", strtotime($fromdate));
				$to_date   = date("Y-m-d", strtotime($todate));
				$createdBy = $request->session()->get('userid');

				DB::table('DYNAMIC_QUERY_REP')->where('TRAN_HEAD',$tranCode)->where('QUERY_NAME_WSPACE',$queryNameWS)->delete();

				$queryName_WS = str_replace(' ', '', $queryName);

			  $dataArray  = array(
					'COMP_CODE'         => $getcompcode,
					'FY_CODE'           => $macc_year,
					'TRAN_HEAD'         => $tranCode,
					'REPORT_NAME'       => $reportName,
					'USER_LIST'         => $user_name,
					'FROM_DATE'         => $from_date,
					'TO_DATE'           => $to_date,
					'QUERY_NAME'        => $queryName,
					'QUERY_NAME_WSPACE' => $queryName_WS,
					'GROUP1'            => $groupOneval,
					'GROUP2'            => $groupTwoval,
					'GROUP3'            => $columnNameThr,
					'DATA_COLUMN'       => $columnNameFour,
					'SQLQUERY'          => $dynamicQuery,
					'CREATED_BY'        => $createdBy,
			  );

			  $savedata = DB::table('DYNAMIC_QUERY_REP')->insert($dataArray);

			  $company_name = $request->session()->get('company_name');
			  $getcomcode   = explode('-', $company_name);
			  $comp_code    = $getcomcode[0];
			  $macc_year    = $request->session()->get('macc_year');

			  $dt    = date("Y-m-d");
        $expd  = explode('-',$dt);
        $y     = $expd[0];
        $m     = $expd[1];
        $d     = $expd[2];
        $num   =  rand(10,10000);
        $fileName = 'DYNQUERY'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
        $getdynQuery = $dynamicQuery;
        public_path('/dist/report_excel/' . $fileName);

        /*if($savedata == 1){
			  	return redirect('/Master/Employee/View-Employee-Mast');
			  }else{
			  	return redirect('/Master/Employee/View-Emp-Grade-Mast');
			  }*/
			  
        /*$response = Excel::download(new DynQueryReportExport($getdynQuery,$comp_code,$macc_year,$columnNameFr,$columnNameSc,$columnNameThr,$columnNameFour,$queryName,$fromdate,$todate),$fileName, null, [\Maatwebsite\Excel\Excel::XLSX]);

        //return redirect()->refresh();
        ob_end_clean();

    	return $response; */

    	$response = Excel::download(new DynQueryReportExport($getdynQuery,$comp_code,$macc_year,$columnNameFr,$columnNameSc,$columnNameThr,$columnNameFour,$queryName,$from_date,$to_date),$fileName, null, [\Maatwebsite\Excel\Excel::XLSX]);

    	ob_end_clean();

    	return $response; 
	}	


	public function ViewDynamicQuery(Request $request){

		$comp_Name = $request->session()->get('company_name');
		$spliComp  = explode('-', $comp_Name);
		$compCode  = $spliComp[0];
		$fis_Year =  $request->session()->get('macc_year');
		if($request->ajax()){

	    	$title = 'View Dyanamic Query';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	$data  = DB::table('DYNAMIC_QUERY_REP');

    		return DataTables()->of($data)->addIndexColumn()->toJson();
		}

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$compCode,'FY_CODE'=>$fis_Year])->get();

		foreach ($getdate as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}
		if(isset($comp_Name)){
	    return view('admin.finance.report.view_dynamicReport',$userdata);
		}else{
			return redirect('/useractivity');
    }

  }

  public function ViewExcelOnViewDR(Request $request,$newSqlQuery,$fromDate,$toDate,$tableID){

  	$company_name = $request->session()->get('company_name');
	  $getcomcode   = explode('-', $company_name);
	  $comp_code    = $getcomcode[0];
	  $macc_year    = $request->session()->get('macc_year');
  	
  	$queryData = DB::table('DYNAMIC_QUERY_REP')->where('ID',$tableID)->get();
  	
		$getdynQuery    = $newSqlQuery;
		$columnNameFr   = $queryData[0]->GROUP1;
		$columnNameSc   = $queryData[0]->GROUP2;
		$columnNameThr  = $queryData[0]->GROUP3;
		$columnNameFour = $queryData[0]->DATA_COLUMN;
		$queryName      = $queryData[0]->QUERY_NAME;
		$from_date      = $fromDate;
		$to_date        = $toDate;
		$dt             = date("Y-m-d");
		$expd           = explode('-',$dt);
		$y              = $expd[0];
		$m              = $expd[1];
		$d              = $expd[2];
		$num            =  rand(10,10000);
    $fileName = 'DYNQUERY'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
    $getdynQuery = $getdynQuery;
    public_path('/dist/report_excel/' . $fileName);

		$fromDateForm = date("Y-m-d", strtotime($from_date));
		$toDateForm   = date("Y-m-d", strtotime($to_date));

	    $arrayData = array(
				'FROM_DATE' =>$fromDateForm,
				'TO_DATE'   =>$toDateForm,
	    );
	    DB::table('DYNAMIC_QUERY_REP')->where('ID',$tableID)->update($arrayData);

    $response = Excel::download(new DynQueryReportExport($getdynQuery,$comp_code,$macc_year,$columnNameFr,$columnNameSc,$columnNameThr,$columnNameFour,$queryName,$from_date,$to_date),$fileName, null, [\Maatwebsite\Excel\Excel::XLSX]);

    ob_end_clean();

    return $response; 
  	
  }

  public function getDynamicQueryForChange(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$CompanyCode = $request->session()->get('company_name');
			$spliCode    = explode('-', $CompanyCode);
			$comp_code   = $spliCode[0];
			$macc_year   = $request->session()->get('macc_year');
			$table_id    = $request->input('tblId');
			$dyQuery = DB::table('DYNAMIC_QUERY_REP')->where('ID',$table_id)->get();
    	if ($dyQuery) {

    		$response_array['response'] = 'success';
	      $response_array['data_query'] = $dyQuery;
	      echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
        $response_array['data_query'] = '';
        $data = json_encode($response_array);
        print_r($data);
				
			}

    }else{

    		$response_array['response'] = 'error';
        $response_array['data_query'] = '';
        $data = json_encode($response_array);
        print_r($data);
    }

  }

  public function getQueryNameAgainstTCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$CompanyCode = $request->session()->get('company_name');
			$spliCode    = explode('-', $CompanyCode);
			$comp_code   = $spliCode[0];
			$macc_year   = $request->session()->get('macc_year');
			$tranCode    = $request->input('tranCode');
			$queryName    = $request->input('queryName');
			$dyQuery = DB::table('DYNAMIC_QUERY_REP')->where('TRAN_HEAD',$tranCode)->get();
			$AlldyQuery = DB::table('DYNAMIC_QUERY_REP')->where('TRAN_HEAD',$tranCode)->where('QUERY_NAME_WSPACE',$queryName)->get();
    	if ($dyQuery || $AlldyQuery) {

				$response_array['response']      = 'success';
				$response_array['data_query']    = $dyQuery;
				$response_array['alldata_query'] = $AlldyQuery;
	      echo $data = json_encode($response_array);

			}else{

				$response_array['response']      = 'error';
				$response_array['data_query']    = '';
				$response_array['alldata_query'] = '';
        $data = json_encode($response_array);
        print_r($data);
				
			}

    }else{

				$response_array['response']      = 'error';
				$response_array['data_query']    = '';
				$response_array['alldata_query'] = '';
        $data = json_encode($response_array);
        print_r($data);
    }

  }


  public function stockAgeAnalysis(Request $request){

		$title        = 'Stock Age Analysis';

		$comp_nameval = $request->session()->get('company_name');
		
		$fisYear      =  $request->session()->get('macc_year');
		$splitYR      = explode('-', $fisYear);
		$startYEar    = $splitYR[0].'-04-01';

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];
    	
		//DB::enableQueryLog();

		$data['itemTypeList'] = DB::table('MASTER_ITEMTYPE')->get();

		$data['age_analysis'] = DB::select("SELECT SERIES_CODE,FY_CODE,ITEM_CODE,ITEM_NAME, VRNO, VRDATE, QTYRECD, DATEDIFF(CURDATE(), VRDATE) AS DAYS,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, QTYRECD, 0) AS ZEROTOTHRTEE,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, QTYRECD, 0) AS THARTIONETOSIXTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, QTYRECD, 0) AS SIXTYONETONINTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, QTYRECD, 0) AS NINTYONETOONEEAIGHTY,IF(DATEDIFF(CURDATE(), VRDATE) > 180, QTYRECD, 0) AS ONEEAIGHTYTOABOVE FROM ITEM_LEDGER WHERE QTYRECD>0 GROUP BY ITEM_CODE ORDER BY DAYS DESC");

	   //dd(DB::getQueryLog());

		return view('admin.finance.report.stock.stock-age-analysis',$data+compact('title'));


  }

  public function StockAgeBarGraph(Request $request){

		$itemCode  = $request->input('item_code');

		$response_array = array();

		if ($itemCode!='') {

			$getData = DB::select("SELECT SERIES_CODE,FY_CODE,ITEM_CODE,ITEM_NAME, VRNO, VRDATE, QTYRECD, DATEDIFF(CURDATE(), VRDATE) AS DAYS,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, QTYRECD, 0) AS ZEROTOTHRTEE,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, QTYRECD, 0) AS THARTIONETOSIXTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, QTYRECD, 0) AS SIXTYONETONINTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, QTYRECD, 0) AS NINTYONETOONEEAIGHTY,IF(DATEDIFF(CURDATE(), VRDATE) > 180, QTYRECD, 0) AS ONEEAIGHTYTOABOVE FROM ITEM_LEDGER WHERE ITEM_CODE='$itemCode' AND QTYRECD>0 GROUP BY ITEM_CODE ORDER BY DAYS DESC");

			if ($getData){ 

				$response_array['response']		= 'Success';
				$response_array['age_analysis'] = $getData;
				$data = json_encode($response_array);  
				print_r($data);

			}else{

				$response_array['response'] = 'Error';
				$response_array['age_analysis'] = array();
				$data = json_encode($response_array);  
				print_r($data);

			}
			

		}else{
			$data10 = array();
			$response_array['response'] = 'Error';
			$data = json_encode($response_array);  
			print_r($data);

		}

		

	}


	public function getItemTypeWiseAgeAnalysisData(Request $request){

		$compName = $request->session()->get('company_name');

	       if ($request->itemType!='') {

				$itemType    = $request->itemType;

				$userid      = $request->session()->get('userid');

				$userType    = $request->session()->get('usertype');

				$compName    = $request->session()->get('company_name');

				$compcode    = explode('-', $compName);

				$getcompcode =	$compcode[0];

				$fisYear     =  $request->session()->get('macc_year');

		        $data1 = DB::select("SELECT L.SERIES_CODE,L.FY_CODE,L.ITEM_CODE,L.ITEM_NAME, L.VRNO, L.VRDATE, L.QTYRECD,DATEDIFF(CURDATE(), L.VRDATE) AS DAYS,IF(DATEDIFF(CURDATE(), L.VRDATE) BETWEEN 0 AND 30, L.QTYRECD, 0) AS ZEROTOTHRTEE,IF(DATEDIFF(CURDATE(), L.VRDATE) BETWEEN 31 AND 60, L.QTYRECD, 0) AS THARTIONETOSIXTY,IF(DATEDIFF(CURDATE(), L.VRDATE) BETWEEN 61 AND 90, L.QTYRECD, 0) AS SIXTYONETONINTY,IF(DATEDIFF(CURDATE(), L.VRDATE) BETWEEN 91 AND 180, L.QTYRECD, 0) AS NINTYONETOONEEAIGHTY,IF(DATEDIFF(CURDATE(), L.VRDATE) > 180, L.QTYRECD, 0) AS ONEEAIGHTYTOABOVE FROM ITEM_LEDGER L INNER JOIN MASTER_ITEM I ON L.ITEM_CODE = I.ITEM_CODE INNER JOIN MASTER_ITEMTYPE T ON I.ITEMTYPE_CODE = T.ITEMTYPE_CODE WHERE T.ITEMTYPE_CODE='$itemType' AND L.QTYRECD>0 GROUP BY L.ITEM_CODE ORDER BY DAYS DESC");
		        
		    	return DataTables()->of($data1)->addIndexColumn()->make(true);

	    	}else{

	    		$data = DB::select("SELECT SERIES_CODE,FY_CODE,ITEM_CODE,ITEM_NAME, VRNO, VRDATE, QTYRECD, DATEDIFF(CURDATE(), VRDATE) AS DAYS,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, QTYRECD, 0) AS ZEROTOTHRTEE,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, QTYRECD, 0) AS THARTIONETOSIXTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, QTYRECD, 0) AS SIXTYONETONINTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, QTYRECD, 0) AS NINTYONETOONEEAIGHTY,IF(DATEDIFF(CURDATE(), VRDATE) > 180, QTYRECD, 0) AS ONEEAIGHTYTOABOVE FROM ITEM_LEDGER WHERE QTYRECD>0 GROUP BY ITEM_CODE ORDER BY DAYS DESC");

	    		return DataTables()->of($data)->addIndexColumn()->make(true);

	    	}
	  

	    if(isset($compName)){
	       return redirect('/Dashboard/Age-Analysis');
	    }else{
			return redirect('/useractivity');
		}

	}
	

/* ........Dynamic Query Function.......... */


/* Logistic Report Start */
	
	public function tripPlanningMonthlyReport(Request $request){


		$title        = 'Trip Planning Monthly Report';
		
		$fisYear      =  $request->session()->get('macc_year');
		$splitYR      = explode('-', $fisYear);
		$startYEar    = $splitYR[0].'-04-01';

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		$userdata['trip_list']       = DB::table('TRIP_BODY')->groupBy('CP_CODE')->get();
		$userdata['trip_head_list']  = DB::table('TRIP_HEAD')->get();
		$userdata['trip_list_trans'] = DB::table('TRIP_HEAD')->groupBy('TRANSPORT_CODE')->get();
		$userdata['city_list']       = DB::table('MASTER_CITY')->get();
    	
    	$fyYear_info = DB::table('MASTER_FY')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->get()->first();

		return view('admin.finance.report.logistic.trip-planning-monthly-report',$userdata+compact('title','fyYear_info'));

	}

	public function tripPlanningMonthlyReportSearch(Request $request){

		if ($request->ajax()) {

			if (!empty($request->vehicleType || $request->from_date || $request->to_date || $request->Consinee || $request->transpAgent || $request->plant || $request->from_place || $request->to_place)) {

				$vehicleType = $request->input('vehicleType');
				$from_date   = $request->input('from_date');
				$to_date     = $request->input('to_date');
				$Consinee    = $request->input('Consinee');
				$ConsineeExp = explode('-', $Consinee);
				$transpAgent = $request->input('transpAgent');
				$trspAgtExp  = explode('-', $transpAgent);
				$from_place  = $request->input('from_place');
				$fPlaceExp   = explode('-', $from_place);
				$to_place    = $request->input('to_place');
				$tPlaceExp   = explode('-', $to_place);
				
				$fromDate     = date("Y-m-d", strtotime($from_date));
				$toDate       = date("Y-m-d", strtotime($to_date));

				$fisYear      =  $request->session()->get('macc_year');
				$splitYR      = explode('-', $fisYear);
				$startYEar    = $splitYR[0].'-04-01';

				$comp_nameval = $request->session()->get('company_name');
				$explode      = explode('-', $comp_nameval);
				$getcom_code  = $explode[0];

				$strWhere = '';

				if(isset($fromDate)  && trim($fromDate)!=""){

		      	 	$strWhere .= " AND TRIP_HEAD.VRDATE BETWEEN '$fromDate' AND  '$toDate' ";
		      	 }
				
				if(isset($ConsineeExp[0])  && trim($ConsineeExp[0])!=""){

					$strWhere .= " AND TRIP_BODY.CP_CODE = '$ConsineeExp[0]' ";

				}

				if(isset($trspAgtExp[0])  && trim($trspAgtExp[0])!=""){

					$strWhere .= " AND TRIP_HEAD.TRANSPORT_CODE = '$trspAgtExp[0]' ";
				}

				if(isset($fPlaceExp[1])  && trim($fPlaceExp[1])!="" && isset($tPlaceExp[1])  && trim($tPlaceExp[1])!=""){

					$strWhere .= " AND TRIP_BODY.FROM_PLACE = '$fPlaceExp[1]' AND TRIP_BODY.TO_PLACE = '$tPlaceExp[1]' ";

				}

				if(isset($vehicleType)  && trim($vehicleType)!="" && $vehicleType == 'self' || $vehicleType == 'market' || $vehicleType == 'dump'){

					$strWhere .= " AND TRIP_HEAD.OWNER= '$vehicleType' ";

				}else{

					$strWhere .= " AND 2=2 ";
				}
				//DB::enableQueryLog();
				$data = DB::select("SELECT TRIP_HEAD.COMP_CODE AS COMPCODE,TRIP_HEAD.FY_CODE AS FYCODE,TRIP_HEAD.PFCT_CODE AS PFCTCODE,TRIP_HEAD.PFCT_NAME AS PFCTNAME,
						TRIP_HEAD.SERIES_CODE AS SERIESCODE,TRIP_HEAD.SERIES_NAME AS SERIESNAME,TRIP_HEAD.ACC_CODE AS ACCCODE,TRIP_HEAD.ACC_NAME AS ACCNAME,TRIP_HEAD.VRNO AS VRN,TRIP_HEAD.TRIP_NO,
						TRIP_HEAD.VRDATE AS VRDT,TRIP_HEAD.PLANT_CODE AS PLANTCODE,TRIP_HEAD.PLANT_NAME AS PLANTNAME,TRIP_HEAD.FSO_NO,TRIP_HEAD.FSO_RATE,TRIP_HEAD.FSO_QTY,
						TRIP_HEAD.ROUTE_CODE,TRIP_HEAD.ROUTE_NAME,TRIP_HEAD.TRIP_DAY,TRIP_HEAD.OFF_DAY,TRIP_HEAD.FROM_PLACE AS FROMPLACE,TRIP_HEAD.TO_PLACE AS TOPLACE,
						TRIP_HEAD.VEHICLE_NO AS VEHICLENO,TRIP_HEAD.OLD_VEHICLE_NO,TRIP_HEAD.OWNER,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,
						TRIP_HEAD.FPO_NO,TRIP_HEAD.FPO_RATE,TRIP_HEAD.MFPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.FREIGHT_QTY,TRIP_HEAD.RATE_BASIS,
						TRIP_HEAD.PAYMENT_MODE,TRIP_HEAD.ADV_TYPE,TRIP_HEAD.ADV_RATE,TRIP_HEAD.ADV_AMT,TRIP_HEAD.DRIVER_NAME,TRIP_HEAD.DRIVER_MOBILE,TRIP_BODY.* 
						FROM TRIP_HEAD INNER JOIN TRIP_BODY 
						ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1  $strWhere");

					//dd(DB::getQueryLog());

				return DataTables()->of($data)->addIndexColumn()->make(true);

		}

	}

	$data = array();
	return DataTables()->of($data)->addIndexColumn()->make(true);
}


public function tripPlanningMonthlyReportExcel(Request $request,$fromDate,$toDate,$velType,$consineeCode,$fromPlace,$toPlace,$trnpAgent){

	$from_date   = $fromDate;
	$to_date     = $toDate;
	$vehicleType = $velType;
	$Consinee    = $consineeCode;
	$transpAgent = $trnpAgent;
	$from_place  = $fromPlace;
	$to_place    = $toPlace;

	
	date_default_timezone_set('Asia/Kolkata');

    $headers = [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ];

    $userId       = $request->session()->get('userid');
    $company_name = $request->session()->get('company_name');
    $getcomcode   = explode('-', $company_name);
    $comp_code    = $getcomcode[0];
    $macc_year    = $request->session()->get('macc_year');
    $db_name      = $request->session()->get('dbName');

    $dt    = date("Y-m-d");
    $expd  = explode('-',$dt);
    $y     = $expd[0];
    $m     = $expd[1];
    $d     = $expd[2];
    $num   =  rand(10,10000);
    $fileName = 'TRIP_PLANNING_MONTHLY_REPORT'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
    
    $fromDate             = $from_date;
    $fromDt               = date("Y-m-d", strtotime($fromDate));
    $toDate               = $to_date;
    $toDt              	  = date("Y-m-d", strtotime($toDate));

    public_path('/dist/report_excel/' . $fileName);
   
    return  Excel::download(new TripPlanningMonthlyReportExport($fromDt,$toDt,$vehicleType,$Consinee,$transpAgent,$from_place,$to_place),$fileName, null, [\Maatwebsite\Excel\Excel::XLSX]);
	
}

	public function pendingGateInward(Request $request){


		$title        = 'Gate Inward Pending Report';
		
		$fisYear      =  $request->session()->get('macc_year');
		$splitYR      = explode('-', $fisYear);
		$startYEar    = $splitYR[0].'-04-01';

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];
		
		$userdata['city_list']       = DB::table('MASTER_CITY')->get();
    	
    	$fyYear_info = DB::table('MASTER_FY')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->get()->first();

		return view('admin.finance.report.logistic.gate-inward-planning-report',$userdata+compact('title','fyYear_info'));


	}

/* Logistic Report End */

// Start C and F Report

public function getStockSummaryReport(Request $request){

	if ($request->ajax()) {

	    if (!empty($request->rack_no || $request->stocksummary || $request->cust_no || $request->item_code )) {

            $rackno   = $request->input('rack_no');
			$stocksum = $request->input('stocksummary');
			$custno   = $request->input('cust_no');
			$wagon_no   = $request->input('wagon_no');
			
			$itemcode = $request->input('item_code');
			

			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];

			$strWhere = '';

			if(isset($rackno)  && trim($rackno)!=""){

		      	$strWhere .= " AND RAKE_NO = '$rackno' ";
		    }

		    if(isset($custno)  && trim($custno)!=""){

		      	$strWhere .= " AND CP_CODE = '$custno' ";
		    }

		    if(isset($itemcode)  && trim($itemcode)!=""){

		      	$strWhere .= " AND ITEM_CODE = '$itemcode' ";
		    }

		    if(isset($wagon_no)  && trim($wagon_no)!=""){

		      	$strWhere .= " AND WAGON_NO = '$wagon_no' ";
		    }

		    // DB::enableQueryLog();
			// $data = DB::select("SELECT COMP_CODE,RAKE_NO,WAGON_NO,RAKE_DATE,PLANT_CODE,PLANT_NAME,ORDER_NO,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,ITEM_CODE,ITEM_NAME,SUM(QTYRECD) AS SQTYRECD,SUM(AQTYRECD) AS SAQTYRECD,SUM(QTYISSUED) AS SQTYISSUED,SUM(AQTYISSUED) AS SAQTYISSUED,UM,AUM FROM `CFSTOCK_LEDGER` WHERE 1=1 AND QTYRECD - QTYISSUED > 0 $strWhere GROUP BY RAKE_NO,CP_CODE,ITEM_CODE");

			$data = DB::select("SELECT COMP_CODE,RAKE_NO,WAGON_NO,RAKE_DATE,PLANT_CODE,PLANT_NAME,ORDER_NO,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,BATCH_NO,ITEM_CODE,ITEM_NAME, SQTYRECD, SAQTYRECD, SQTYISSUED, SAQTYISSUED,UM,AUM FROM ( SELECT
			COMP_CODE,RAKE_NO,WAGON_NO,RAKE_DATE,PLANT_CODE,PLANT_NAME,ORDER_NO,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,BATCH_NO,ITEM_CODE,ITEM_NAME,SUM(QTYRECD) AS SQTYRECD,SUM(AQTYRECD) AS SAQTYRECD,SUM(QTYISSUED) AS SQTYISSUED,SUM(AQTYISSUED) AS SAQTYISSUED,UM,AUM FROM `CFSTOCK_LEDGER` WHERE 1=1  $strWhere GROUP BY RAKE_NO,CP_CODE,ITEM_CODE) A");

			// print_r($data);



			// dd(DB::getQueryLog());
			return DataTables()->of($data)->addIndexColumn()->make(true);

		}if($request->blankData == 'Blank'){
            $data0 = array();
			return DataTables()->of($data0)->addIndexColumn()->make(true);
		}else{

			$data = DB::select("SELECT COMP_CODE,RAKE_NO,WAGON_NO,RAKE_DATE,PLANT_CODE,PLANT_NAME,ORDER_NO,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,BATCH_NO,ITEM_CODE,ITEM_NAME, SQTYRECD, SAQTYRECD, SQTYISSUED, SAQTYISSUED,UM,AUM FROM ( SELECT
			COMP_CODE,RAKE_NO,WAGON_NO,RAKE_DATE,PLANT_CODE,PLANT_NAME,ORDER_NO,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,BATCH_NO,ITEM_CODE,ITEM_NAME,SUM(QTYRECD) AS SQTYRECD,SUM(AQTYRECD) AS SAQTYRECD,SUM(QTYISSUED) AS SQTYISSUED,SUM(AQTYISSUED) AS SAQTYISSUED,UM,AUM FROM `CFSTOCK_LEDGER`  GROUP BY RAKE_NO,CP_CODE,ITEM_CODE) A WHERE A.SQTYRECD - A.SQTYISSUED != 0 ");

			return DataTables()->of($data)->addIndexColumn()->make(true);

		}



    }
}


public function getRakeReport(Request $request){

	if ($request->ajax()) {

	    if (!empty( $request->stocksummary)) {

            $stocksum = $request->input('stocksummary');
			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];

			$rackno   = $request->input('rack_no');
			// print_r($rackno);
			$custno   = $request->input('cust_no');
			$wagon_no   = $request->input('wagon_no');
			$itemcode = $request->input('item_code');

			$strWhere = '';

			if(isset($rackno)  && trim($rackno)!=""){

		      	$strWhere .= " AND T.RAKE_NO = '$rackno' ";
		    }

		    if(isset($custno)  && trim($custno)!=""){

		      	$strWhere .= " AND T.CP_CODE = '$custno' ";
		    }

		    if(isset($itemcode)  && trim($itemcode)!=""){

		      	$strWhere .= " AND T.ITEM_CODE = '$itemcode' ";
		    }

		    if(isset($wagon_no)  && trim($wagon_no)!=""){

		      	$strWhere .= " AND T.WAGON_NO = '$wagon_no' ";
		    }


			if($stocksum == 'SS1'){

				 // DB::enableQueryLog();
				$data = DB::select("SELECT A.RAKE_NO, A.RAKE_DATE, A.CP_CODE, A.CP_NAME, A.ACC_CODE,A.ACC_NAME,A.PLACE_DATE, COUNT(A.WAGON_NO) AS WAGON_NO, SUM(A.QTY) AS QTY, SUM(A.QTY)/COUNT(A.WAGON_NO) AS AVGQTY FROM (select T.RAKE_NO, T.RAKE_DATE, T.CP_CODE, T.CP_NAME, T.WAGON_NO, T.ACC_CODE,T.ACC_NAME,T.PLACE_DATE, SUM(T.QTY) AS QTY from RAKE_TRAN T WHERE 1=1 $strWhere GROUP BY T.RAKE_NO,T.CP_CODE,T.WAGON_NO) A GROUP BY A.RAKE_NO,A.CP_CODE");
                // dd(DB::getQueryLog());

				return DataTables()->of($data)->addIndexColumn()->make(true);

			}else if($stocksum == 'SS2'){

				// DB::enableQueryLog();
				$data = DB::select("SELECT A.RAKE_NO,A.RAKE_DATE, A.WAGON_NO,A.ACC_CODE,A.ACC_NAME,A.PLACE_DATE, COUNT(A.CP_CODE) AS CP_COUNT FROM (select T.RAKE_NO,T.RAKE_DATE, T.WAGON_NO, T.CP_CODE, T.ACC_CODE,T.ACC_NAME,T.PLACE_DATE FROM RAKE_TRAN T WHERE 1=1 $strWhere GROUP BY T.RAKE_NO,T.WAGON_NO,T.CP_CODE) A  GROUP BY A.RAKE_NO,A.WAGON_NO");
                // dd(DB::getQueryLog());
                
				return DataTables()->of($data)->addIndexColumn()->make(true);

			}else{

			}

			

		}else{

			$data = array();
			return DataTables()->of($data)->addIndexColumn()->make(true);

		}

    }
}

public function viewDetailsRakeConsig(Request $request){

	 if ($request->ajax()) {

		$cp_code = $request->rake_cpcode;
		$rackno = $request->rakeno;
		$rakeno1 = $request->rakeno1;
		$wagonno = $request->wagonno;
		$itemcode = $request->itemcode;
		$r_cpcodee = $request->rakecpcode;
		$r_wagonno = $request->rakewagonno;
		$r_no = $request->r_no;
		
		$strWhere = '';

		if(isset($rackno)  && trim($rackno)!=""){

	      	$strWhere .= " AND RAKE_NO = '$r_no' AND CP_CODE ='$r_cpcodee' ";
	    }

	    if(isset($cp_code)  && trim($cp_code)!=""){

	      	$strWhere .= " AND CP_CODE = '$cp_code' ";
	    }

	    if(isset($itemcode)  && trim($itemcode)!=""){

	      	$strWhere .= " AND ITEM_CODE = '$itemcode' ";
	    }

	    if(isset($wagonno)  && trim($wagonno)!=""){

	      	$strWhere .= " AND WAGON_NO = '$wagonno' ";
	    }
        
        if($cp_code != ''|| $rackno != '' || $wagonno != '' || $itemcode!= ''){

            // print_r($rackno);
           // DB::enableQueryLog();
        	$data = DB::select("SELECT wagon_no,ITEM_CODE,BATCH_NO,ITEM_NAME,REMARK,sum(qty) as qty, sum(aqty)as totalQty from RAKE_TRAN WHERE 1=1 $strWhere group by RAKE_NO,CP_CODE,WAGON_NO");

        	// dd(DB::getQueryLog());

        	if($data){

				$response_array['response'] = 'success';
				
				$response_array['data'] = $data ;
				$response_array['consignee'] = '' ;
				$data = json_encode($response_array);
				
				print_r($data);

			}else{

				$response_array['response'] = 'error';
				
				$response_array['data'] = '' ;
				$response_array['consignee'] = '' ;
				$data = json_encode($response_array);
				
				print_r($data);
					
			}

	    }else{

            $data = DB::select("SELECT wagon_no,ITEM_CODE,BATCH_NO,ITEM_NAME,REMARK,sum(qty) as qty, sum(aqty)as totalQty from RAKE_TRAN WHERE RAKE_NO = '$r_no' AND CP_CODE ='$r_cpcodee' group by RAKE_NO,CP_CODE,WAGON_NO");

            if($data){

				$response_array['response'] = 'success';
				
				$response_array['data'] = $data ;
				$response_array['consignee'] = '' ;
				$data = json_encode($response_array);
				
				print_r($data);

			}else{

				$response_array['response'] = 'error';
				
				$response_array['data'] = '' ;
				$response_array['consignee'] = '' ;
				$data = json_encode($response_array);
				
				print_r($data);
					
			}

	    }





	    if($rakeno1!='' && $wagonno != ''){
	    	// print_r('wagon');
           
           $data1 = DB::select("SELECT cp_code,cp_name, sum(qty), sum(aqty) from RAKE_TRAN where rake_no='$rakeno1' and WAGON_NO='$wagonno' group by RAKE_NO,CP_CODE,WAGON_NO");
           // print_r($data1);

           if($data1){

				$response_array['response'] = 'success';
				$response_array['data'] = '' ;
				
				$response_array['consignee'] = $data1 ;
				
				$data = json_encode($response_array);
				
				print_r($data);

			}else{

				$response_array['response'] = 'error';
				$response_array['data'] = '' ;
				
				$response_array['consignee'] = '' ;
				
				$data = json_encode($response_array);
				
				print_r($data);
					
			}
			
	    }else{

	    	$response_array['response'] = 'error';
			
			$response_array['data'] = '' ;
			
			$data = json_encode($response_array);
	    }

    }else{

		$response_array['response'] = 'error';
		
		$response_array['data'] = '' ;
		
		$data = json_encode($response_array);

    }
}


public function viewcountConsignee(Request $request){

	 if ($request->ajax()) {

		$rakeno1 = $request->rakeno1;
		$wagonno = $request->wagonno;
		// print_r($wagonno);exit();
        
        if($rakeno1!='' && $wagonno != ''){
	    	
	    	// print_r('wagon');
           
           $data1 = DB::select("SELECT cp_code,cp_name, sum(qty) as qty, sum(aqty) as aqty from RAKE_TRAN where rake_no='$rakeno1' and WAGON_NO='$wagonno' group by RAKE_NO,CP_CODE,WAGON_NO");
           // print_r($data1);

           if($data1){

				$response_array['response'] = 'success';
				$response_array['data'] = $data1 ;
				
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
	    }

    }else{

		$response_array['response'] = 'error';
		
		$response_array['data'] = '' ;
		
		$data = json_encode($response_array);

    }
}

public function getStockLedgerReport(Request $request){

	if ($request->ajax()) {

	    if (!empty($request->rack_no || $request->cust_no || $request->item_code ||  $request->wagon_no )) {

            $rackno   = $request->input('rack_no');
			$custno   = $request->input('cust_no');
			$wagon_no   = $request->input('wagon_no');
			
			$itemcode = $request->input('item_code');
			

			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];

			$strWhere = '';

			if(isset($rackno)  && trim($rackno)!=""){

		      	$strWhere .= " AND RAKE_NO = '$rackno' ";
		    }

		    if(isset($custno)  && trim($custno)!=""){

		      	$strWhere .= " AND CP_CODE = '$custno' ";
		    }

		    if(isset($itemcode)  && trim($itemcode)!=""){

		      	$strWhere .= " AND ITEM_CODE = '$itemcode' ";
		    }

		    if(isset($wagon_no)  && trim($wagon_no)!=""){

		      	$strWhere .= " AND WAGON_NO = '$wagon_no' ";
		    }

		    // DB::enableQueryLog();
			
			$data = DB::select("SELECT VRDATE,RAKE_NO,LR_NO,VEHICLE_NO,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,WAGON_NO,INVOICE_NO,WAGON_NO,INVOICE_DATE,EWAY_BILL_NO,EWAY_BILL_DT,ITEM_CODE,ITEM_NAME,REMARK,LENGTH,WIDTH,HEIGHT,QTYRECD,AQTYRECD,QTYISSUED,UM,AUM,BATCH_NO,NET_WEIGHT,AQTYISSUED FROM CFSTOCK_LEDGER WHERE 1=1  $strWhere");

			// dd(DB::getQueryLog());
			return DataTables()->of($data)->addIndexColumn()->make(true);

		}

		if($request->blankData == 'Blank'){

            $data0 = array();
			return DataTables()->of($data0)->addIndexColumn()->make(true);

		}else{

			$data = DB::select("SELECT VRDATE,RAKE_NO,LR_NO,VEHICLE_NO,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,WAGON_NO,INVOICE_NO,WAGON_NO,INVOICE_DATE,EWAY_BILL_NO,EWAY_BILL_DT,ITEM_CODE,ITEM_NAME,REMARK,LENGTH,WIDTH,HEIGHT,QTYRECD,AQTYRECD,QTYISSUED,UM,AUM,BATCH_NO,NET_WEIGHT FROM CFSTOCK_LEDGER ");

			return DataTables()->of($data)->addIndexColumn()->make(true);

		}



    }
}

public function grn_inward(Request $request){

  	$title ='grn_inward';
	$compName   = $request->session()->get('company_name');
	$macc_year  = $request->session()->get('macc_year');
	$usertype   = $request->session()->get('user_type');
	$userid     = $request->session()->get('userid');

	$fisYear      =  $request->session()->get('macc_year');
	$splitYR      = explode('-', $fisYear);
	$startYEar    = $splitYR[0].'-04-01';

	$getcomcode = explode('-', $compName);
	$compCode   = $getcomcode[0];

	$userdata['item_list']       = DB::table('CFINWARD_TRAN')->groupBy('ITEM_CODE')->get();
	$userdata['trip_list']       = DB::table('CFINWARD_TRAN')->groupBy('CP_CODE')->get();
	$userdata['rake_list']       = DB::table('CFINWARD_TRAN')->groupBy('RAKE_NO')->get();
	$userdata['wagon_list']      = DB::table('CFINWARD_TRAN')->groupBy('WAGON_NO')->get();

	$item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$compCode)->where('FY_CODE',$macc_year)->get();

    foreach ($item_um_aum_list as $key) {
        $userdata['fromDate'] =  $key->FY_FROM_DATE;
        $userdata['toDate']   =  $key->FY_TO_DATE;
    }
	

	if(isset($compName)){

    	return view('admin.finance.report.C_and_F.grn_inward',$userdata+compact('title'));

    }else{

		return redirect('/useractivity');
	}

  }
public function getGrnInwardReport(Request $request){

	if ($request->ajax()) {

	    if (!empty($request->rack_no || $request->cust_no || $request->item_code ||  $request->wagon_no || $request->from_date || $request->to_date )) {

			$rackno   = $request->input('rack_no');
			$custno   = $request->input('cust_no');
			$wagon_no = $request->input('wagon_no');
			$itemcode = $request->input('item_code');
			$fromdt   = $request->input('from_date');
			$todt     = $request->input('to_date');

			$fromDate = date("Y-m-d", strtotime($fromdt));
			$toDate   = date("Y-m-d", strtotime($todt));
			
			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];

			$strWhere = '';

			if(isset($rackno)  && trim($rackno)!=""){

		      	$strWhere .= " AND RAKE_NO = '$rackno' ";
		    }

		    if(isset($custno)  && trim($custno)!=""){

		      	$strWhere .= " AND CP_CODE = '$custno' ";
		    }

		    if(isset($itemcode)  && trim($itemcode)!=""){

		      	$strWhere .= " AND ITEM_CODE = '$itemcode' ";
		    }

		    if(isset($wagon_no)  && trim($wagon_no)!=""){

		      	$strWhere .= " AND WAGON_NO = '$wagon_no' ";
		    }

		    // DB::enableQueryLog();
			
			$data = DB::select("SELECT RAKE_NO,VRDATE,CP_CODE,ACC_CODE,ACC_NAME,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,ORDER_NO,WAGON_NO,BATCH_NO,ITEM_CODE,ITEM_NAME,REMARK,QTYRECD,UM,AQTYRECD,AUM,LOCATION_NAME,LOCATION_CODE FROM CFINWARD_TRAN WHERE 1=1  $strWhere AND VRDATE BETWEEN '$fromDate' AND '$toDate'");

			// dd(DB::getQueryLog());
			return DataTables()->of($data)->addIndexColumn()->make(true);

		}

		if($request->blankData == 'Blank'){

            $data = array();
			return DataTables()->of($data)->addIndexColumn()->make(true);

		}else{

			$data = array();

			return DataTables()->of($data)->addIndexColumn()->make(true);

		}



    }
}

public function dispatch_outward(Request $request){

	$title ='Dispatch Outward';
	$compName   = $request->session()->get('company_name');
	$macc_year  = $request->session()->get('macc_year');
	$usertype   = $request->session()->get('user_type');
	$userid     = $request->session()->get('userid');

	$fisYear      =  $request->session()->get('macc_year');
	$splitYR      = explode('-', $fisYear);
	$startYEar    = $splitYR[0].'-04-01';

	$getcomcode = explode('-', $compName);
	$compCode   = $getcomcode[0];

	$userdata['item_list']       = DB::table('CFINWARD_TRAN')->groupBy('ITEM_CODE')->get();
	$userdata['trip_list']       = DB::table('CFINWARD_TRAN')->groupBy('CP_CODE')->get();
	$userdata['rake_list']       = DB::table('CFINWARD_TRAN')->groupBy('RAKE_NO')->get();
	$userdata['wagon_list']      = DB::table('CFINWARD_TRAN')->groupBy('WAGON_NO')->get();

	$item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$compCode)->where('FY_CODE',$macc_year)->get();

    foreach ($item_um_aum_list as $key) {
        $userdata['fromDate'] =  $key->FY_FROM_DATE;
        $userdata['toDate']   =  $key->FY_TO_DATE;
    }
	

	if(isset($compName)){

    	return view('admin.finance.report.C_and_F.dispatch_outward',$userdata+compact('title'));

    }else{

		return redirect('/useractivity');
	}

}

public function getDispatchOutwardReport(Request $request){

	if ($request->ajax()) {

	    if (!empty($request->rack_no || $request->cust_no || $request->item_code ||  $request->wagon_no || $request->from_date || $request->to_date )) {

			$rackno   = $request->input('rack_no');
			$custno   = $request->input('cust_no');
			$wagon_no = $request->input('wagon_no');
			$itemcode = $request->input('item_code');
			$fromdt   = $request->input('from_date');
			$todt     = $request->input('to_date');

			$fromDate = date("Y-m-d", strtotime($fromdt));
			$toDate   = date("Y-m-d", strtotime($todt));
			
			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];

			$strWhere = '';

			if(isset($rackno)  && trim($rackno)!=""){

		      	$strWhere .= " AND RAKE_NO = '$rackno' ";
		    }

		    if(isset($custno)  && trim($custno)!=""){

		      	$strWhere .= " AND CP_CODE = '$custno' ";
		    }

		    if(isset($itemcode)  && trim($itemcode)!=""){

		      	$strWhere .= " AND ITEM_CODE = '$itemcode' ";
		    }

		    if(isset($wagon_no)  && trim($wagon_no)!=""){

		      	$strWhere .= " AND WAGON_NO = '$wagon_no' ";
		    }

		    $data = DB::select("SELECT RAKE_NO,LR_NO,LR_DATE,DELIVERY_NO,VEHICLE_NO,VRDATE,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,ORDER_NO,WAGON_NO,BATCH_NO,ITEM_CODE,ITEM_NAME,REMARK,QTYISSUED,UM,AQTISSUED,AUM,LOCATION_NAME,LOCATION_CODE,ACC_CODE,ACC_NAME,TRPT_CODE,TRPT_NAME,NET_WEIGHT,INVOICE_NO FROM CFOUTWARD_TRAN WHERE 1=1  $strWhere AND VRDATE BETWEEN '$fromDate' AND '$toDate' AND LR_NO != '' ");

			// dd(DB::getQueryLog());
			return DataTables()->of($data)->addIndexColumn()->make(true);

		}

		if($request->blankData == 'Blank'){

            $data = array();
			return DataTables()->of($data)->addIndexColumn()->make(true);

		}else{

			$data = array();

			return DataTables()->of($data)->addIndexColumn()->make(true);

		}



    }
}

public function getRakeDoSummReport(Request $request){

	
	//$strWhere .= "AND COMP_CODE = ''$MCOMP_CODE'' ";
    //$str_Where .= "AND COMP_CODE = '$MCOMP_CODE' ";

	$compName   = $request->session()->get('company_name');
	$getcomcode = explode('-', $compName);
	$compCode   = $getcomcode[0];

	$MCOMP_CODE = $compCode;
	$strWhere = '';
	$str_Where = '';

	$strWhere .= "AND RAKE_NO !='''' ";
    $str_Where .= "AND RAKE_NO !='' ";

    // $strWhere .= "AND COMP_CODE = ''$compCode'' ";
    // $str_Where .= "AND COMP_CODE ='$compCode' ";
	
	if ($request->ajax()) {

    // DB::enableQueryLog();

	    if(!empty($request->rack_no || $request->acc_code || $request->cust_no || $request->item_code ||  $request->toPlace )) { 


	    	$rackno   = $request->input('rack_no');
	    	$acccode   = $request->input('acc_code');
	    	// print_r($acccode);
			$custno   = $request->input('cust_no');
			$itemcode = $request->input('item_code');
			$toplace   = $request->input('toPlace');
			
        
	        if(isset($rackno)  && trim($rackno)!=""){

	            $strWhere .= "AND RAKE_NO = ''$rackno'' ";
	            $str_Where .= "AND RAKE_NO = '$rackno' ";
	        }

	        if(isset($acccode)  && trim($acccode)!=""){

	            $strWhere .= "AND ACC_CODE = ''$acccode'' ";
	            $str_Where .= "AND ACC_CODE = '$acccode' ";
	        }

	        if(isset($custno)  && trim($custno)!=""){


	            $strWhere .= "AND CP_CODE = ''$custno''";
	            $str_Where .= "AND CP_CODE = '$custno'";
	        }

	        if(isset($itemcode)  && trim($itemcode)!=""){

	            $strWhere .= "AND ITEM_CODE = ''$itemcode'' ";
	            $str_Where .= "AND ITEM_CODE = '$itemcode'  " ;
	        }

	        if(isset($toplace)  && trim($toplace)!=""){

	            $strWhere .= "AND TO_PLACE = ''$toplace'' ";
	            $str_Where .= "AND TO_PLACE = '$toplace' ";
	        }

	    //DB::enableQueryLog();
		      DB::raw("SET @sql = NULL");
		      DB::select(DB::raw("SELECT
			GROUP_CONCAT(DISTINCT
			CONCAT(
			'ifnull(SUM(case when RAKE_NO = ''',
			RAKE_NO,
			''' then QTY-DISPATCH_PLAN_QTY-CANCEL_QTY end),0) AS `',
			RAKE_NO, '`'
			)
			) INTO @sql
			FROM
			DORDER_BODY WHERE 1=1 $str_Where;
			SET @sql = CONCAT('SELECT CP_NAME,TO_PLACE,ITEM_NAME,ACC_CODE, ', @sql, ' 
			FROM DORDER_BODY WHERE 1=1 $strWhere 
			GROUP BY CP_NAME,TO_PLACE,ITEM_NAME')"));
		      
		      DB::Statement("PREPARE stmt FROM @sql");
		      $data =  \DB::select("EXECUTE stmt");
		      DB::raw("DEALLOCATE PREPARE stmt");
        //dd(DB::getQueryLog());
           
            
			
			return DataTables()->of($data)->addIndexColumn()->make(true);

	    }else if($request->blankData == 'Blank'){

	    	$data = array();
	    	return DataTables()->of($data)->addIndexColumn()->make(true);

	    }else{
	    	// print_r('else');
			//DB::enableQueryLog();
	    	DB::raw("SET @sql = NULL");
			DB::select(DB::raw("SELECT
			GROUP_CONCAT(DISTINCT
			CONCAT(
			'ifnull(SUM(case when RAKE_NO = ''',
			RAKE_NO,
			''' then QTY-DISPATCH_PLAN_QTY-CANCEL_QTY end),0) AS `',
			RAKE_NO, '`'
			)
			) INTO @sql
			FROM
			DORDER_BODY WHERE 1=1 $str_Where order By RAKE_NO;
			SET @sql = CONCAT('SELECT ',@sql,',ITEM_NAME,TO_PLACE,CP_NAME,ACC_NAME,ACC_CODE 
			FROM DORDER_BODY  WHERE 1=1 $strWhere  
			GROUP BY CP_NAME,TO_PLACE,ITEM_NAME')"));
			
			DB::Statement("PREPARE stmt FROM @sql");
			$data1 =  \DB::select("EXECUTE stmt");
			DB::raw("DEALLOCATE PREPARE stmt");

			//dd(DB::getQueryLog());

			// $data1 = DB::select("SELECT ACC_CODE,CP_NAME,TO_PLACE,ITEM_NAME,RAKE_NO FROM RAKE_TRAN");

            $data = json_decode(json_encode($data1),true);

			return DataTables()->of($data)->make(true);

	    }

   
    }else{

    	$data = array();
    	return DataTables()->of($data)->addIndexColumn()->make(true);

    }

}


public function rakeReport(Request $request){

	$title      = 'Rake Report';
	$compName   = $request->session()->get('company_name');
	$macc_year  = $request->session()->get('macc_year');
	$usertype   = $request->session()->get('user_type');
	$userid     = $request->session()->get('userid');

	$fisYear    =  $request->session()->get('macc_year');
	$splitYR    = explode('-', $fisYear);
	$startYEar  = $splitYR[0].'-04-01';

	$getcomcode = explode('-', $compName);
	$compCode   = $getcomcode[0];

	$item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$compCode)->where('FY_CODE',$macc_year)->get();

    foreach ($item_um_aum_list as $key) {
        $userdata['fromDate'] =  $key->FY_FROM_DATE;
        $userdata['toDate']   =  $key->FY_TO_DATE;
    }

	$userdata['item_list']  = DB::table('RAKE_TRAN')->groupBy('ITEM_CODE')->get();
	$userdata['trip_list']  = DB::table('RAKE_TRAN')->groupBy('CP_CODE')->get();
	$userdata['rake_list']  = DB::table('RAKE_TRAN')->groupBy('RAKE_NO')->get();
	$userdata['wagon_list'] = DB::table('RAKE_TRAN')->groupBy('WAGON_NO')->get();
	

	if(isset($compName)){

    	return view('admin.finance.report.C_and_F.rake_report',$userdata+compact('title'));

    }else{

		return redirect('/useractivity');
	}


}


public function rakeReportData(Request $request){

	if ($request->ajax()) {

    // 

	    if(!empty($request->rackNo || $request->wagonNo || $request->consigneeCd || $request->item_code)) { 


			$rackNo      = $request->input('rackNo');
			$wagonNo     = $request->input('wagonNo');
			
			$consigneeCd = $request->input('consigneeCd');
			$item_code   = $request->input('item_code');
			
			$strWhere = '';

	        if(isset($rackNo)  && trim($rackNo)!=""){
	          
	            $strWhere .= "AND RAKE_NO = '$rackNo' ";

	        }

	        if(isset($wagonNo)  && trim($wagonNo)!=""){

	            $strWhere .= "AND WAGON_NO = '$wagonNo' ";
	        }

	        if(isset($consigneeCd)  && trim($consigneeCd)!=""){

	            $strWhere .= "AND CP_CODE = '$consigneeCd'";

	        }

	        if(isset($item_code)  && trim($item_code)!=""){

	            $strWhere .= "AND ITEM_CODE = '$item_code'  " ;

	        }

	      	//DB::enableQueryLog();
	        $data = DB::select("SELECT * FROM RAKE_TRAN WHERE 1=1  $strWhere");
			//dd(DB::getQueryLog());

			return DataTables()->of($data)->addIndexColumn()->make(true);


	    }else{

	    	$data = array();
	    	return DataTables()->of($data)->addIndexColumn()->make(true);


	    } /* /. condition if-else close */



	}else{

		$data = array();
	    return DataTables()->of($data)->addIndexColumn()->make(true);

	} /* /. Ajax If Close */



}


// End C and F Report
	
/* --------- REPORT ITEM AGE ANALISYS --------- */
	
	public function ItemAgeAnalysisReport(Request $request){

		$macc_year  = $request->session()->get('macc_year');
		$compDetail = $request->session()->get('company_name');
		$splitData  = explode('-', $compDetail);
		$mCompCode  = $splitData[0];
		$mCompName  = $splitData[1];
		$plantCode  = '3120';
		$plantName  = 'MAHALGAON';
		$YrBegDate  = '2022-04-01';
		$toDayDate  = '2023-03-10';

		if($plantCode){

			DB::table("ITEM_AGE")->where('COMP_CODE',$mCompCode)->where('PLANT_CODE',$plantCode)->delete();
		}else{
			DB::table("ITEM_AGE")->where('COMP_CODE',$mCompCode)->delete();
		}

		//$itemBalData = DB::select("SELECT ITEM_CODE,YROPQTY+YRQTRECD-YRQTYISSUED AS CLQTY FROM MASTER_ITEMBAL WHERE YROPQTY+YRQTRECD-YRQTYISSUED >0");

		$itemBalData = DB::select("SELECT T.ITEM_CODE, T.OPQTY + T.QTYRECD - T.QTYISSUED AS CLQTY FROM 
				(
				     SELECT ITEM_CODE, SUM(A.OPQTY) AS OPQTY, SUM(A.QTYRECD) AS QTYRECD, SUM(A.QTYISSUED) AS  QTYISSUED FROM 
				     (    
				         #Bring year opening balance
				          SELECT ITEM_CODE, YROPQTY AS OPQTY, 0 AS QTYRECD, 0 AS QTYISSUED FROM MASTER_ITEMBAL WHERE COMP_CODE='$mCompCode' AND PLANT_CODE='$plantCode' AND FY_CODE='$macc_year' 
				           UNION ALL
				          #Bring transactions during year
				          SELECT ITEM_CODE, QTYRECD-QTYISSUED AS OPQTY, 0 AS QTYRECD, 0 AS QTYISSUED FROM ITEM_LEDGER WHERE 1=1 AND VRDATE BETWEEN '$YrBegDate' AND '$toDayDate' AND COMP_CODE='$mCompCode' AND PLANT_CODE='$plantCode'
				     ) A GROUP BY A.ITEM_CODE ORDER BY A.ITEM_CODE
				) T WHERE T.OPQTY + T.QTYRECD - T.QTYISSUED > 0 ORDER BY T.ITEM_CODE");

		for($j=0;$j<count($itemBalData);$j++){

			$itemCode = $itemBalData[$j]->ITEM_CODE;
			$mStock   = $itemBalData[$j]->CLQTY;

			$itemLegd  = DB::select("SELECT ITEM_CODE,CONCAT(SERIES_CODE,'/',FY_CODE,'/',VRNO) AS VRNO,VRDATE,QTYRECD FROM ITEM_LEDGER WHERE COMP_CODE='$mCompCode' AND PLANT_CODE='$plantCode' AND ITEM_CODE='$itemCode' AND VRDATE BETWEEN '$YrBegDate' AND '$toDayDate' AND QTYRECD>0 ORDER BY VRDATE DESC");

			for($i=0;$i<count($itemLegd);$i++){

				$now = strtotime($toDayDate); // or your date as well
				$your_date = strtotime($itemLegd[$i]->VRDATE);
				$datediff = $now - $your_date;

				$mDays = round($datediff / (60 * 60 * 24));

				$slno = $i + 1;

				$recdQty = $itemLegd[$i]->QTYRECD;

				if($mStock >= $recdQty){

					$data = array(

						'COMP_CODE'  =>$mCompCode,
						'COMP_NAME'  =>$mCompName,
						'PLANT_CODE' =>$plantCode,
						'PLANT_NAME' =>$plantName,
						'ITEM_CODE'  =>$itemCode,
						'BATCH_NO'   =>$slno,
						'TO_DATE'    =>$toDayDate,
						'CL_QTY'     =>$mStock,
						'PBILL_DATE' =>$itemLegd[$i]->VRDATE,
						'PBILL_NO'   =>$itemLegd[$i]->VRNO,
						'QTYRECD'    =>$recdQty,
						'RANGE_01'   =>($mDays<=30) ? ($recdQty) : (0), 
						'RANGE_02'   =>($mDays >= 31  && $mDays<=60) ? ($recdQty) : (0), 
						'RANGE_03'   =>($mDays >=61  && $mDays<=90) ? ($recdQty) : (0), 
						'RANGE_04'   =>($mDays >= 91  && $mDays<=180) ? ($recdQty) : (0),
						'RANGE_05'   =>($mDays > 180) ? ($recdQty) : (0), 
					);;

					DB::table('ITEM_AGE')->insert($data);

					$mStock = $mStock - $recdQty;

					if($mStock <= 0){
						exit();
					}
				}else{

					$data = array(

						'COMP_CODE'  =>$mCompCode,
						'COMP_NAME'  =>$mCompName,
						'PLANT_CODE' =>$plantCode,
						'PLANT_NAME' =>$plantName,
						'ITEM_CODE'  =>$itemCode,
						'BATCH_NO'   =>$slno,
						'TO_DATE'    =>$toDayDate,
						'CL_QTY'     =>$mStock,
						'PBILL_DATE' =>$itemLegd[$i]->VRDATE,
						'PBILL_NO'   =>$itemLegd[$i]->VRNO,
						'QTYRECD'    =>$mStock,
						'RANGE_01'   =>($mDays<=30) ? ($mStock) : (0), 
						'RANGE_02'   =>($mDays >=31  && $mDays<=60) ? ($mStock) : (0),
						'RANGE_03'   =>($mDays >=61  && $mDays<=90) ? ($mStock) : (0),
						'RANGE_04'   =>($mDays >=91  && $mDays<=180) ? ($mStock) : (0), 
						'RANGE_05'   =>($mDays > 180) ? ($mStock) : (0),
					);

					DB::table('ITEM_AGE')->insert($data);

					$mStock = $mStock - $mStock;

					exit();
				}

			}

			if($mStock > 0){
				$slno = $slno + 1;

				$now       = strtotime($toDayDate); // or your date as well
				$your_date = strtotime($YrBegDate);
				$datediff  = $now - $your_date;
				$mDays     = round($datediff / (60 * 60 * 24));

				$data = array(

					'COMP_CODE'  =>$mCompCode,
					'COMP_NAME'  =>$mCompName,
					'PLANT_CODE' =>$plantCode,
					'PLANT_NAME' =>$plantName,
					'ITEM_CODE'  =>$itemCode,
					'BATCH_NO'   =>$slno,
					'TO_DATE'    =>$toDayDate,
					'CL_QTY'     =>$mStock,
					'PBILL_DATE' =>$YrBegDate,
					'PBILL_NO'   =>'Opening Stock',
					'QTYRECD'    =>$mStock,
					'RANGE_01'   =>($mDays<=30) ? ($mStock) : (0), 
					'RANGE_02'   =>($mDays >=31  && $mDays<=60) ? ($mStock) : (0), 
					'RANGE_03'   =>($mDays >=61  && $mDays<=90) ? ($mStock) : (0), 
					'RANGE_04'   =>($mDays >=91  && $mDays<=180) ? ($mStock) : (0),
					'RANGE_05'   =>($mDays > 180) ? ($mStock) : (0),
				);

				DB::table('ITEM_AGE')->insert($data);
			}

		}/* /. item balance*/
		
	}/* /. main function*/

/* --------- REPORT ITEM AGE ANALISYS --------- */



 	public function getBankReconReport(Request $request){


    	$title         = 'Bank Reconciliation Report';

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
		$userdata['acc_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->get();

	    if(isset($COMPCODE)){

	    	return view('admin.finance.report.account.bank_reconciliation',$userdata+compact('getseries','title'));
	    }else{

			return redirect('/useractivity');
		}



    }

    public function getGlOnSeriesBankRecon(Request $request){

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


			if (!empty($request->getSeries)) {

				$SERIESCODE = $request->getSeries;

				$TCODE     = 'A0';

				$GETGLCODE = DB::table('MASTER_CONFIG')->where('COMP_CODE',$MCOMPCODE)->where('TRAN_CODE',$TCODE)->where('SERIES_CODE',$SERIESCODE)->get();

				$response_array['response'] = 'success';
	            $response_array['gl_list'] = $GETGLCODE ;
	            
	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['gl_list'] = '' ;

                $data = json_encode($gettaxcode);

                print_r($data);

			}

		}else{

			$response_array['response'] = 'error';
            $response_array['gl_list'] = '' ;

            $data = json_encode($gettaxcode);

            print_r($data);

		}


    }

     public function getDataOnBankReconReport(Request $request){


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
				$BGDATE      = $request->session()->get('yrbgdate');
				$YRBGDATE    = date("Y-m-d", strtotime($BGDATE));

			/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */


			if (!empty($request->series_code || $request->from_date || $request->to_date || $request->seriesGlCd)) {


				$SERIESCODE = $request->input('series_code');
				$GLCODE 	= $request->input('seriesGlCd');
				$TODATE     = $request->input('to_date');
				$FROMDATE   = $request->input('from_date');

				$MFROMDATE = date("Y-m-d", strtotime($request->from_date));
                $MTODATE   = date("Y-m-d", strtotime($request->to_date));

                $strwhere='';
               /* if(isset($MFROMDATE)  && trim($MFROMDATE)!="")
                {
                    $strwhere .="AND BANK_DATE BETWEEN '$MFROMDATE' AND '$MTODATE'";
                }*/

                if(isset($SERIESCODE)  && trim($SERIESCODE)!="")
                {
                    $strwhere .="AND SERIES_CODE = '$SERIESCODE'";
                }

                /*$strwhere1='';
                if(isset($GLCODE)  && trim($GLCODE)!="")
                {
                    $strwhere1 .="AND GL_CODE = '$GLCODE'";
                }*/

               // print_r($MFROMDATE);
                //print_r($BGDATE);

                //DB::enableQueryLog();

               /* if ($MFROMDATE == $YRBGDATE) {

                	$data1= DB::select("SELECT S.BankDate,S.vrno,S.particular,S.drAmt,S.CrAmt FROM ( 
                		SELECT '$MFROMDATE' AS BankDate,'0' as vrno,'Op Bal' as particular, yropdr as drAmt,yropcr as CrAmt FROM MASTER_GLBAL WHERE  FY_CODE='$FYCODE' AND gl_code='$GLCODE'
					      #Bring transactions during year opening and before from date - GL Tran
					      UNION ALL
					      #Bring transactions during period - GL Tran
					      SELECT BANK_DATE as BankDate,VRNO as vrno,PARTICULAR,DRAMT as drAmt, CRAMT as CrAmt FROM CB_TRAN where COMP_CODE='$MCOMPCODE' AND FY_CODE='$FYCODE' AND 1=1 AND SERIES_CODE = '$SERIESCODE' AND HEAD_GLCODE='$GLCODE' AND BANK_DATE BETWEEN '$MFROMDATE' AND '$MTODATE' ORDER BY BankDate) S ORDER BY S.BankDate,S.vrno");

                	
                }else{*/

                	$data1= DB::select("SELECT M.BankDate,M.vrno,M.SERIES_CODE,M.SERIES_NAME,M.FY_CODE,M.ACC_CODE,M.ACC_NAME,M.GL_CODE,M.GL_NAME,M.INST_TYPE,M.INST_NO,M.INST_DATE,M.particular, M.drAmt,M.CrAmt FROM(
							      #Bring Op Balance from MasterGLBal
							      SELECT '$MFROMDATE' AS BankDate,'0' as vrno,'' AS SERIES_CODE,'' AS SERIES_NAME,'' AS FY_CODE,'' AS ACC_CODE,'' AS ACC_NAME,'' AS GL_CODE,'' AS GL_NAME,'' AS INST_TYPE,'' AS INST_NO,'' AS INST_DATE,'Op Bal' as particular, yropdr as drAmt,yropcr as CrAmt FROM MASTER_GLBAL WHERE  FY_CODE='$FYCODE' AND gl_code='$GLCODE'
							      UNION ALL
							      #Bring transactions during year opening and before from date - GL Tran
							      SELECT '$MFROMDATE' as BankDate, '0'  as vrno,'' AS SERIES_CODE,'' AS SERIES_NAME,'' AS FY_CODE,'' AS ACC_CODE,'' AS ACC_NAME,'' AS GL_CODE,'' AS GL_NAME,'' AS INST_TYPE,'' AS INST_NO,'' AS INST_DATE,'Op Bal' as particular,sum(dramt) as drAmt, sum(cramt) as CrAmt FROM CB_TRAN WHERE 1=1 AND COMP_CODE='$MCOMPCODE' AND FY_CODE='$FYCODE' AND HEAD_GLCODE='$GLCODE' AND 1=1 AND vrdate BETWEEN '$YRBGDATE' AND DATE_SUB('$MFROMDATE',INTERVAL 1 DAY)
							      ) M GROUP BY  M.BankDate,M.vrno,M.particular
							      UNION ALL
							      #Bring transactions during period - GL Tran
							      SELECT BANK_DATE as BankDate,VRNO as vrno,SERIES_CODE AS SERIES_CODE,SERIES_NAME AS SERIES_NAME,FY_CODE AS FY_CODE,ACC_CODE AS ACC_CODE,ACC_NAME AS ACC_NAME,GL_CODE AS GL_CODE,GL_NAME AS GL_NAME,INST_TYPE AS INST_TYPE,INST_NO AS INST_NO,INST_DATE AS INST_DATE,particular,dramt as drAmt,cramt as CrAmt FROM CB_TRAN where COMP_CODE='$MCOMPCODE' AND FY_CODE='$FYCODE' AND 1=1 AND SERIES_CODE = '$SERIESCODE' AND HEAD_GLCODE='$GLCODE' AND BANK_DATE BETWEEN '$MFROMDATE' AND '$MTODATE' ORDER BY BankDate,vrno");

               /* }*/
                
                //dd(DB::getQueryLog());

                $data = json_decode(json_encode($data1),true);

               /*	echo '<pre>';
               	print_r($data);
               	exit();*/
         	
	           
	    		if($data) {

	    			return DataTables()->of($data)->addIndexColumn()->make(true);

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

/*------------ START :  RAKE STOCK SUMMERY ---------- */
	
	public function ProceedRackStockReportData(Request $request){

    	if ($request->ajax()) {

		   if(!empty($request->rackNo)) { 
		  	    $rackNo      = $request->input('rackNo');
		  	    $strWhere = '';

			    if(isset($rackNo)  && trim($rackNo)!=""){
			          
			            $strWhere .= "AND RAKE_NO = '$rackNo' ";

		        }

		        DB::table('TEMP_RAKE_STOCK')->truncate();

				DB::select("INSERT INTO TEMP_RAKE_STOCK (COMP_CODE,RAKE_NO,RAKE_DATE,WAGON_NO,QTYRECD,UM,AQTYRECD,AUM) SELECT COMP_CODE,RAKE_NO,RAKE_DATE,WAGON_NO,QTY,UM,AQTY,AUM FROM CFINWARD_TRAN WHERE 1=1 $strWhere");

				$getOutwardData = DB::select("SELECT * FROM CFOUTWARD_TRAN WHERE 1=1 $strWhere");
		              //print_r($getOutwardData);exit();

		        foreach($getOutwardData as $row){

					$getTempData = DB::table('TEMP_RAKE_STOCK')->where('RAKE_NO',$row->RAKE_NO)->where('WAGON_NO',$row->WAGON_NO)->where('QTYISSUED',0.000)->get();
		              //print_r($getTempData);exit();

					if(count($getTempData) >=1){

						$dataAry = array(
							'LR_NO'        => $row->LR_NO,
							'LR_DATE'      => $row->LR_DATE,
							'LR_SLNO'      => $row->LR_SLNO,
							'VEHICLE_NO'   => $row->VEHICLE_NO,
							'VRDATE'       => $row->VRDATE,
							'QTYISSUED'    => $row->QTY,
							'AQTYISSUED'   => $row->AQTY,
							'ITEM_NAME'    => $row->ITEM_NAME,
							'REMARK'       => $row->REMARK,
							'LENGTH'       => $row->LENGTH,
							'WIDTH'        => $row->WIDTH,
							'HEIGHT'       => $row->HEIGHT,
							'BATCH_NO'     => $row->BATCH_NO,
							'ACC_CODE'     => $row->ACC_CODE,
							'ACC_NAME'     => $row->ACC_NAME,
							'CP_CODE'      => $row->CP_CODE,
							'CP_NAME'      => $row->CP_NAME,
							'SP_CODE'      => $row->SP_CODE,
							'SP_NAME'      => $row->SP_NAME,
							'TO_PLACE'     => $row->TO_PLACE,
							'INVOICE_NO'   => $row->INVOICE_NO,
							'INVOICE_DATE' => $row->INVOICE_DATE,
							'EWAY_BILL_NO' => $row->EWAY_BILL_NO,
							'EWAY_BILL_DT' => $row->EWAY_BILL_DT,
							'DELIVERY_NO'  => $row->DELIVERY_NO,
							'ORDER_NO'     => $row->ORDER_NO,
							'DATATYPE'	   => 'UPDATE'
						);
		                 
						DB::table('TEMP_RAKE_STOCK')->where('RAKE_NO',$row->RAKE_NO)->where('WAGON_NO',$row->WAGON_NO)->where('QTYISSUED','0.000')->where('TEMPID',$getTempData[0]->TEMPID)->update($dataAry);
					}else{

						$dataAry1 = array(
							'COMP_CODE'    => $row->COMP_CODE,
							'RAKE_NO'      => $row->RAKE_NO,
							'RAKE_DATE'    => $row->RAKE_DATE,
							'WAGON_NO'     => $row->WAGON_NO,
							'QTYRECD'      => 0.000,
							'UM'           => $row->UM,
							'AQTYRECD'     => 0.000,
							'AUM'          => $row->AUM,
							'LR_NO'        => $row->LR_NO,
							'LR_DATE'      => $row->LR_DATE,
							'LR_SLNO'      => $row->LR_SLNO,
							'VEHICLE_NO'   => $row->VEHICLE_NO,
							'VRDATE'       => $row->VRDATE,
							'QTYISSUED'    => $row->QTY,
							'AQTYISSUED'   => $row->AQTY,
							'ITEM_NAME'    => $row->ITEM_NAME,
							'REMARK'       => $row->REMARK,
							'LENGTH'       => $row->LENGTH,
							'WIDTH'        => $row->WIDTH,
							'HEIGHT'       => $row->HEIGHT,
							'BATCH_NO'     => $row->BATCH_NO,
							'ACC_CODE'     => $row->ACC_CODE,
							'ACC_NAME'     => $row->ACC_NAME,
							'CP_CODE'      => $row->CP_CODE,
							'CP_NAME'      => $row->CP_NAME,
							'SP_CODE'      => $row->SP_CODE,
							'SP_NAME'      => $row->SP_NAME,
							'TO_PLACE'     => $row->TO_PLACE,
							'INVOICE_NO'   => $row->INVOICE_NO,
							'INVOICE_DATE' => $row->INVOICE_DATE,
							'EWAY_BILL_NO' => $row->EWAY_BILL_NO,
							'EWAY_BILL_DT' => $row->EWAY_BILL_DT,
							'DELIVERY_NO'  => $row->DELIVERY_NO,
							'ORDER_NO'     => $row->ORDER_NO,
							'DATATYPE'	   => 'INSERT'
						);
		                 //print_r($dataAry1);exit();
						DB::table('TEMP_RAKE_STOCK')->insert($dataAry1);

					}

				}

		        //print_r($strWhere);exit();

		         $data = DB::select("SELECT * FROM TEMP_RAKE_STOCK WHERE 1=1");
		         //echo "<PRE>";
		         //print_r($data);exit();
		      	return DataTables()->of($data)->addIndexColumn()->make(true);

			}else{

	    	 	$data = array();
	    	
		     	return DataTables::of($data)->addIndexColumn()->toJson();

    		}

	 	}   

	 	$title      = 'Rake Stock Summary';
 	$userdata['rake_list']  = DB::table('RAKE_TRAN')->groupBy('RAKE_NO')->get();

	 	return view('admin.finance.report.C_and_F.rake_stock_summary',$userdata+compact('title'));

 	}

/*------------ END :  RAKE STOCK SUMMERY ---------- */


/* ----------- START : LORRY RECEIPT --------------------- */
	
	public function lorry_Receipt(Request $request){

		// print_r('hello');
		// exit();

		$title ='Lorry Receipt';
		$compName   = $request->session()->get('company_name');
		$macc_year  = $request->session()->get('macc_year');
		$usertype   = $request->session()->get('user_type');
		$userid     = $request->session()->get('userid');

		$fisYear      =  $request->session()->get('macc_year');
		$splitYR      = explode('-', $fisYear);
		$startYEar    = $splitYR[0].'-04-01';

		$getcomcode = explode('-', $compName);
		$compCode   = $getcomcode[0];

		$userdata['item_list']       = DB::table('TRIP_BODY')->groupBy('ITEM_CODE')->get();
		$userdata['consinee_list']       = DB::table('TRIP_BODY')->groupBy('CP_CODE')->get();
		$userdata['lr_list']       = DB::table('TRIP_BODY')->groupBy('LR_NO')->get();
		$userdata['wagon_list']      = DB::table('TRIP_BODY')->groupBy('WAGON_NO')->get();
		$userdata['do_list']      = DB::table('TRIP_BODY')->groupBy('DO_NO')->get();

		$item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$compCode)->where('FY_CODE',$macc_year)->get();

	    foreach ($item_um_aum_list as $key) {
	        $userdata['fromDate'] =  $key->FY_FROM_DATE;
	        $userdata['toDate']   =  $key->FY_TO_DATE;
	    }
		

		if(isset($compName)){

	    	return view('admin.finance.report.logistic.lorry_receipt_form',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

	}



	/* ------- START : Logistics Sale Bill Posting ----------  */

 public function MISReport(Request $request){

	$title       =	'Logistics - Sale Bill Provisional';
	$compCodeName = $request->session()->get('company_name');
	$compcode    = explode('-', $compCodeName);
	$getcompcode = $compcode[0];
	$macc_year   = $request->session()->get('macc_year');
	$transCode   = 'S5';

	$tableData = MyConstruct();

	$userdata['acc_list']     = $tableData['master_party'];

	$getCommonData = MyCommonFun($transCode,$compcode,$macc_year);

	$userdata['series_list'] = $getCommonData['getseries'];

	$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$transCode)->get();

	$userdata['trans_head'] =$transCode[0]->TRAN_CODE;

	$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

        foreach ($getdate as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }
		
	$accCatglist  = DB::table('MASTER_ACATG')->get();

	$complist  = DB::table('MASTER_COMP')->get();

	$tripBodylist  = DB::table('TRIP_BODY')->get()->toArray();
	
	$tripHeadVehiclelist  = DB::table('TRIP_HEAD')->groupBy('VEHICLE_NO')->get()->toArray();

	$Acclist  = DB::table('MASTER_ACC')->where('ATYPE_CODE','D')->get()->toArray();

	$Transporterlist  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get()->toArray();

	$cplist  = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->get()->toArray();

	$toplacelist  = DB::table('MASTER_CITY')->get()->toArray();

	$plantlist  = DB::table('MASTER_PLANT')->where('COMP_CODE',$getcompcode)->get()->toArray();

	$itemList  = DB::table('MASTER_ITEM')->where('ITEMTYPE_CODE','SR')->get()->toArray();

	
 	if(isset($compCodeName)){

	 return view('admin.finance.report.logistic.MIS_REPORT',$userdata+compact('title','accCatglist','tripBodylist','plantlist','tripHeadVehiclelist','Transporterlist','transCode','itemList','complist','cplist','Acclist','toplacelist'));

	}else{

	    return redirect('/useractivity');
	
	}

 	
 }



public function getMISReportData(Request $request){



    	if ($request->ajax()) {


    	    if (!empty($request->vrDateId || $request->comp_code || $request->plant_code || $request->to_place || $request->accountCode || $request->AccountText || $request->from_date || $request->to_date || $request->transpoter_code || $request->cp_code || $request->vehicleNo || $request->select_mis )) {


				$vrDateId    = $request->vrDateId;
				$comp_code   = $request->comp_code;
				$plantCode   = $request->plant_code;

				$exp_plant = explode("[",$plantCode);
				$newPlantCode = explode("]",$exp_plant[0]);
				$plant_code = $newPlantCode[0];

				$to_place    = $request->to_place;
				$accountCode = $request->accountCode;
				$AccountText = $request->AccountText;
				$from_date   = $request->from_date;
				$to_date     = $request->to_date;
				$transpoter_code  = $request->transpoter_code;
				$cp_code     = $request->cp_code;
				$vehicleNo   = $request->vehicleNo;
				$select_mis   = $request->select_mis;
		                
		        $CompanyCode = $request->session()->get('company_name');
				$compcode    = explode('-', $CompanyCode);
				$getcompcode = $compcode[0];
				$macc_year   = $request->session()->get('macc_year');

				$vrDate   = date("Y-m-d", strtotime($vrDateId));
				$fromDate = date("Y-m-d", strtotime($from_date));
				$toDate   = date("Y-m-d", strtotime($to_date));


				        
                $strWhere = '';
                $strWhere1 = '';

                if(isset($fromDate)  && trim($fromDate)!=""){

		      	    $strWhere.=" AND H.VRDATE BETWEEN '$fromDate' AND  '$toDate'";
		      	    $strWhere1.=" AND H.VRDATE BETWEEN '$fromDate' AND  '$toDate'";
		      	   
		      	}

		      	if(isset($comp_code)  && trim($comp_code)!=""){

                    $strWhere .= " AND H.COMP_CODE = '$comp_code'";
                    $strWhere1 .= " AND H.COMP_CODE = '$comp_code'";

                }
        	
        		if(isset($accountCode)  && trim($accountCode)!=""){

                    $strWhere .= " AND H.ACC_CODE = '$accountCode'";
                    $strWhere1 .= " AND H.ACC_CODE = '$accountCode'";

                }
      
	      		if(isset($to_place)  && trim($to_place)!=""){

                    $strWhere .= " AND H.TO_PLACE = '$to_place'";
                    $strWhere1 .= " AND B.TO_PLACE = '$to_place'";

                }

             	if(isset($transpoter_code)  && trim($transpoter_code)!=""){

             	     $strWhere .= " AND H.TRANSPORT_CODE = '$transpoter_code'";
             	     $strWhere1 .= " AND H.TRANSPORT_CODE = '$transpoter_code'";

             	}

             	if(isset($cp_code)  && trim($cp_code)!=""){

             	     $strWhere .= " AND B.CP_CODE = '$cp_code'";
             	     $strWhere1 .= " AND B.CP_CODE = '$cp_code'";

             	}

             	if(isset($vehicleNo)  && trim($vehicleNo)!=""){

             	     $strWhere .= " AND H.VEHICLE_NO = '$vehicleNo'";
             	     $strWhere1 .= " AND H.VEHICLE_NO = '$vehicleNo'";

             	}

             	/*if(isset($getcompcode)  && trim($getcompcode)!=""){

             	     $strWhere .= " AND TRIP_HEAD.COMP_CODE = '$getcompcode'";
             	    // $strWhere1 .= " AND H.COMP_CODE = '$getcompcode'";

             	}*/

             	if(isset($plant_code)  && trim($plant_code)!=""){

                    $strWhere .= " AND H.PLANT_CODE = '$plant_code'";
                    $strWhere1 .= " AND H.PLANT_CODE = '$plant_code'";

                }


                if($select_mis=='Zero Freight Rate for Sale Bill'){

                		$data = DB::select("SELECT H.*,B.QTY,B.CP_CODE,B.CP_NAME,B.LR_NO,B.LR_DATE,B.FSO_RATE AS fsorate,B.SHORTAGE_QTY,B.RECD_QTY,'0.00' AS amount,B.INVC_NO,B.INVC_DATE,B.DELIVERY_NO,'' AS SR_CODE,'' AS SR_NAME,'' AS BILL_TYPE,B.ITEM_NAME,'' as PAYBLE_BILL_AMT,'' as SGST_UGST,'' as CGST FROM TRIP_HEAD H ,TRIP_BODY B  WHERE B.TRIPHID = H.TRIPHID AND H.LR_ACK_STATUS = 1  AND (H.FSO_RATE IS NULL OR H.FSO_RATE=0) $strWhere GROUP BY H.TRIPHID");

                }else if($select_mis=='Zero Freight Rate for Purchase Bill'){

                		$data = DB::select("SELECT H.*,B.QTY,B.CP_CODE,B.CP_NAME,B.LR_NO,B.LR_DATE,B.FSO_RATE AS fsorate,B.SHORTAGE_QTY,B.RECD_QTY,'0.00' AS amount,B.INVC_NO,B.INVC_DATE,B.DELIVERY_NO,'' AS SR_CODE,'' AS SR_NAME,'' AS BILL_TYPE,B.ITEM_NAME,'' as PAYBLE_BILL_AMT,'' as SGST_UGST,'' as CGST FROM TRIP_HEAD H ,TRIP_BODY B  WHERE B.TRIPHID = H.TRIPHID AND H.LR_ACK_STATUS = 1  AND (H.FPO_RATE IS NULL OR H.FPO_RATE =0) $strWhere GROUP BY H.TRIPHID");

                }else if($select_mis=='Pending Temporary Bill(EX-SIDING)'){

                	    $data = DB::select("SELECT H.*,B.NET_WEIGHT,B.QTY,B.CP_CODE,B.CP_NAME,B.LR_NO,B.LR_DATE,B.FSO_RATE AS fsorate,B.SHORTAGE_QTY,B.RECD_QTY,'0.00' AS amount,B.INVC_NO,B.INVC_DATE,B.DELIVERY_NO,'' AS SR_CODE,'' AS SR_NAME,'' AS BILL_TYPE,B.ITEM_NAME,'' as PAYBLE_BILL_AMT,'' as SGST_UGST,'' as CGST FROM TRIP_HEAD H ,TRIP_BODY B, MASTER_PLANT P WHERE B.TRIPHID = H.TRIPHID AND H.LR_ACK_STATUS = 1  AND  B.PROVBILL_STATUS=0 AND H.FSO_RATE > 0  AND  H.PLANT_CODE=P.PLANT_CODE AND P.PLANT_CATEGORY='EX-SID' $strWhere GROUP BY H.TRIPHID");

                }else if($select_mis=='Market Vehicle Advance Details'){

                	    $data = DB::select("SELECT H.*,B.QTY,B.CP_CODE,B.CP_NAME,B.LR_NO,B.LR_DATE,B.FSO_RATE AS fsorate,B.SHORTAGE_QTY,B.RECD_QTY,'0.00' AS amount,B.INVC_NO,B.INVC_DATE,B.DELIVERY_NO,'' AS SR_CODE,'' AS SR_NAME,'' AS BILL_TYPE,B.ITEM_NAME,'' as PAYBLE_BILL_AMT,'' as SGST_UGST,'' as CGST FROM TRIP_HEAD H ,TRIP_BODY B  WHERE B.TRIPHID = H.TRIPHID AND H.TRIP_PMT_STATUS = 1  AND  H.OWNER='MARKET' $strWhere GROUP BY B.TRIPHID");

                }else if($select_mis=='Daily LR Report'){

                		$current_date = date('Y-m-d');

                	    $data = DB::select("SELECT H.*,SUM(B.QTY) AS QTY,B.CP_CODE,B.CP_NAME,B.LR_NO,B.LR_DATE,B.FSO_RATE AS fsorate,B.SHORTAGE_QTY,SUM(B.RECD_QTY) AS RECD_QTY,'0.00' AS amount,B.INVC_NO,B.INVC_DATE,B.DELIVERY_NO,'' AS SR_CODE,'' AS SR_NAME,'' AS BILL_TYPE,B.ITEM_NAME,'' as PAYBLE_BILL_AMT,'' as SGST_UGST,'' as CGST FROM TRIP_HEAD H ,TRIP_BODY B  WHERE B.TRIPHID = H.TRIPHID AND H.LR_STATUS = 1 AND (LR_NO IS NOT NULL OR LR_NO!='')  $strWhere GROUP BY B.TRIPHID");
                }else if($select_mis=='Daily LR Acknowledgment Report'){

                	    $data = DB::select("SELECT H.*,SUM(B.QTY) AS QTY,B.CP_CODE,B.CP_NAME,B.LR_NO,B.LR_DATE,B.FSO_RATE AS fsorate,B.SHORTAGE_QTY,SUM(B.RECD_QTY) AS RECD_QTY,'0.00' AS amount,B.INVC_NO,B.INVC_DATE,B.DELIVERY_NO,'' AS SR_CODE,'' AS SR_NAME,'' AS BILL_TYPE,'' as PAYBLE_BILL_AMT,B.ITEM_NAME FROM TRIP_HEAD H ,TRIP_BODY B  WHERE B.TRIPHID = H.TRIPHID AND H.LR_ACK_STATUS = 1 AND B.LR_NO IS NOT NULL $strWhere GROUP BY B.TRIPHID");

                }else if($select_mis=='LR Pending For Acknowledgment'){

                	    $data = DB::select("SELECT H.*,SUM(B.QTY) AS QTY,B.CP_CODE,B.CP_NAME,B.LR_NO,B.LR_DATE,B.FSO_RATE AS fsorate,B.SHORTAGE_QTY,SUM(B.RECD_QTY) AS RECD_QTY,'0.00' AS amount,B.INVC_NO,B.INVC_DATE,B.DELIVERY_NO,'' AS SR_CODE,'' AS SR_NAME,'' AS BILL_TYPE,B.ITEM_NAME,'' as PAYBLE_BILL_AMT,'' as SGST_UGST,'' as CGST FROM TRIP_HEAD H ,TRIP_BODY B  WHERE B.TRIPHID = H.TRIPHID AND  H.LR_STATUS = 1 AND H.EPOD_STATUS = 1 AND H.LR_ACK_STATUS = 0 AND B.LR_NO IS NOT NULL  $strWhere GROUP BY H.TRIPHID");

                }else if($select_mis=='LR Pending For Sale Bill'){

                	    $data = DB::select("SELECT H.*,SUM(B.NET_WEIGHT) AS NET_WEIGHT,B.QTY,B.CP_CODE,B.CP_NAME,B.LR_NO,B.LR_DATE,B.FSO_RATE AS fsorate,B.SHORTAGE_QTY,SUM(B.RECD_QTY) AS RECD_QTY,'0.00' AS amount,B.INVC_NO,B.INVC_DATE,B.DELIVERY_NO,'' AS SR_CODE,'' AS SR_NAME,'' AS BILL_TYPE,B.ITEM_NAME,'' as PAYBLE_BILL_AMT,'' as SGST_UGST,'' as CGST FROM TRIP_HEAD H ,TRIP_BODY B  WHERE B.TRIPHID = H.TRIPHID AND  H.EPOD_STATUS = 1 AND H.LR_ACK_STATUS = 1 AND H.FSO_RATE > 0 AND B.PROVBILL_STATUS='0' $strWhere GROUP BY B.LR_NO");

                }else if($select_mis=='LR Pending For Purchase Bill'){

                	    $data = DB::select("SELECT H.*,SUM(B.NET_WEIGHT) AS NET_WEIGHT,B.QTY,B.CP_CODE,B.CP_NAME,B.LR_NO,B.LR_DATE,B.FSO_RATE AS fsorate,C.COMP_NAME,B.SHORTAGE_QTY,SUM(B.RECD_QTY) AS RECD_QTY,'0.00' AS amount,B.INVC_NO,B.INVC_DATE,B.DELIVERY_NO,'' AS SR_CODE,'' AS SR_NAME,'' AS BILL_TYPE,B.ITEM_NAME,'' as PAYBLE_BILL_AMT,'' as SGST_UGST,'' as CGST FROM TRIP_HEAD H ,TRIP_BODY B,MASTER_COMP C  WHERE B.TRIPHID = H.TRIPHID AND H.COMP_CODE=C.COMP_CODE AND H.LR_STATUS = 1  AND H.EPOD_STATUS = 1 AND  H.LR_ACK_STATUS = 1 AND H.FPO_RATE > 0 AND H.PBILL_STATUS = 0  AND H.OWNER='MARKET' $strWhere GROUP BY B.LR_NO");

                }else if($select_mis=='LR Details For Warai Charges'){

                	    $data = DB::select("SELECT H.*,B.QTY,B.CP_CODE,B.CP_NAME,B.LR_NO,B.LR_DATE,B.FSO_RATE AS fsorate,B.SHORTAGE_QTY,B.RECD_QTY,C.AMOUNT AS amount,B.INVC_NO,B.INVC_DATE,B.DELIVERY_NO,'' AS SR_CODE,'' AS SR_NAME,'' AS BILL_TYPE,B.ITEM_NAME,'' as PAYBLE_BILL_AMT,'' as SGST_UGST,'' as CGST FROM TRIP_HEAD H ,TRIP_BODY B,TRIP_CHARGE_EXP C  WHERE B.TRIPHID = H.TRIPHID AND C.TRIPHID = H.TRIPHID AND  H.LR_ACK_STATUS = 1 AND C.DESCRIPTION='Warai Charges'  $strWhere GROUP BY H.TRIPHID");

                }else if($select_mis=='LR Acknowledgment Shortage'){

                	    $data = DB::select("SELECT H.*,B.QTY,B.CP_CODE,B.CP_NAME,B.LR_NO,B.LR_DATE,B.FSO_RATE AS fsorate,B.SHORTAGE_QTY,B.RECD_QTY,B.NET_WEIGHT,'0.00' AS amount,B.INVC_NO,B.INVC_DATE,B.DELIVERY_NO,'' AS SR_CODE,'' AS SR_NAME,'' AS BILL_TYPE,B.ITEM_NAME,'' as PAYBLE_BILL_AMT,'' as SGST_UGST,'' as CGST FROM TRIP_HEAD H ,TRIP_BODY B WHERE B.TRIPHID = H.TRIPHID AND H.LR_ACK_STATUS = 1 AND B.SHORTAGE_QTY > 0 $strWhere");

                }else if($select_mis=='Pending Final Bill Against Provisional'){

                	    $data = DB::select("SELECT B.*,C.COMP_CODE,C.ACC_CODE,C.ACC_NAME,H.FSO_RATE,H.FPO_RATE,B.ACK_QTY AS QTY,C.SR_CODE,C.SR_NAME,'' AS amount,B.ALIAS_ITEM_NAME AS ITEM_NAME,H.TRANSPORT_CODE,H.TRANSPORT_NAME FROM SBILL_HEAD_PROV C,SBILL_BODY_PROV B,TRIP_HEAD H WHERE C.PSBILLHID = B.PSBILLHID AND H.TRIPHID = B.TRIPHID AND B.SBILLHID IS NULL $strWhere1  GROUP BY B.PSBILLHID");

                }

                   // DB::enableQueryLog();

                	

                	//dd(DB::getQueryLog());
                
               
                //dd(DB::getQueryLog());

			//DB::enableQueryLog();

	               
            
            //dd(DB::getQueryLog());

			return DataTables()->of($data)->addIndexColumn()->make(true);

					
	    }else{

			$data = array();
			return DataTables()->of($data)->addIndexColumn()->make(true);

	    }/* ./ Data Check Condition If Close */



    	}else{

		    $data = array();
		    return DataTables()->of($data)->addIndexColumn()->make(true);

    	}/* ./ ajax if close */


    }




	public function getDispatchLorryReceipt(Request $request){
	
    if ($request->ajax()) {
	        if (!empty($request->lr_no || $request->cust_no || $request->item_code ||  $request->wagon_no || $request->from_date || $request->to_date || $request->do_number)) {
	            $lr_no     = $request->input('lr_no');
	            $custno    = $request->input('cust_no');
	            $wagon_no  = $request->input('wagon_no');
	            $itemcode  = $request->input('item_code');
	            $fromdt    = $request->input('from_date');
	            $todt      = $request->input('to_date');
	            $do_number = $request->input('do_number');
	            $fromDate  = date("Y-m-d", strtotime($fromdt));
	            $toDate    = date("Y-m-d", strtotime($todt));
	            
	            $comp_nameval = $request->session()->get('company_name');
	            $explode      = explode('-', $comp_nameval);
	            $getcom_code  = $explode[0];

	            $strWhere = '';

	            if (isset($lr_no) && trim($lr_no) != "") {
	                $strWhere .= " AND LR_NO = '$lr_no' ";
	            }

	            if (isset($custno) && trim($custno) != "") {
	                $strWhere .= " AND CP_CODE = '$custno' ";
	            }

	            if (isset($itemcode) && trim($itemcode) != "") {
	                $strWhere .= " AND ITEM_CODE = '$itemcode' ";
	            }

	            if (isset($wagon_no) && trim($wagon_no) != "") {
	                $strWhere .= " AND WAGON_NO = '$wagon_no' ";
	            }

	             if (isset($do_number) && trim($do_number) != "") {
	                $strWhere .= " AND DO_NO = '$do_number' ";
	            }

	            $data = DB::select("
	                SELECT H.TRIPHID,H.ACC_CODE,H.ACC_NAME,H.VRDATE,H.VEHICLE_NO,H.TO_PLACE,H.TRANSPORT_CODE,H.TRANSPORT_NAME, B.TRIPHID,B.ACC_CODE,B.ACC_NAME,B.VRDATE,B.TO_PLACE, B.LR_NO,B.CP_CODE,B.CP_NAME,B.SP_CODE,B.SP_NAME,B.DO_NO,B.WAGON_NO,B.BATCH_NO,B.ITEM_CODE,B.ITEM_NAME,B.REMARK,B.UM,B.AUM,B.QTY,B.AQTY
	                FROM TRIP_HEAD H
	                JOIN TRIP_BODY B ON H.TRIPHID = B.TRIPHID
	                WHERE 1=1 $strWhere
	                AND B.VRDATE BETWEEN '$fromDate' AND '$toDate'
	                AND B.TRIPHID != ''
	            ");

	            return DataTables()->of($data)->addIndexColumn()->make(true);
	        }

	        if ($request->blankData == 'Blank') {
	            $data = array();
	            return DataTables()->of($data)->addIndexColumn()->make(true);
	        } else {
	            $data = array();
	            return DataTables()->of($data)->addIndexColumn()->make(true);
	        }
	    }
	}

/* ----------- END : LORRY RECEIPT --------------------- */
/*------------------------	 MONTH WISE SUMMURY ------------------------*/
   public function getMonthWiseSummary(Request $request){



    	$title         = 'Month Wise Summary';

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

		$tranListCd = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$TCODE)->get()->toArray();
		 
		$userdata['trans_head'] =$tranListCd[0]->TRAN_CODE;
		$userdata['acc_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->get();
        
	    if(isset($COMPCODE)){

	    	return view('admin.finance.report.account.month_wise_summary',$userdata+compact('getseries','title'));
	    }else{

			return redirect('/useractivity');
		}
    }

    public function getDataMonthWiseSummary(Request $request){
         
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


			if (!empty($request->getSeries)) {

				$SERIESCODE = $request->getSeries;

				$TCODE     = 'A0';

				$GETGLCODE = DB::table('MASTER_CONFIG')->where('COMP_CODE',$MCOMPCODE)->where('TRAN_CODE',$TCODE)->where('SERIES_CODE',$SERIESCODE)->get();
                //print_r($GETGLCODE);exit();
				$response_array['response'] = 'success';
	            $response_array['gl_list'] = $GETGLCODE ;
	            
	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['gl_list'] = '' ;

                $data = json_encode($response_array);

                print_r($data);

			}

		}else{

			$response_array['response'] = 'error';
            $response_array['gl_list'] = '' ;

            $data = json_encode($gettaxcode);

            print_r($data);

		}


    }

     public function getDataOnMonthWiseSummaryReport(Request $request){
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

				$BGDATE      = $request->session()->get('yrbgdate');
				$YRBGDATE    = date("Y-m-d", strtotime($BGDATE));

			/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */


			if (!empty($request->series_code || $request->from_date || $request->to_date || $request->seriesGlCd)) {
				$SERIESCODE = $request->input('series_code');

				$GLCODE 	= $request->input('seriesGlCd');

				$TODATE     = $request->input('to_date');

				$FROMDATE   = $request->input('from_date');

				$MFROMDATE  = date("Y-m-d", strtotime($request->from_date));

                $MTODATE    = date("Y-m-d", strtotime($request->to_date));
                     
                $strwhere='';
             
                 if(isset($SERIESCODE)  && trim($SERIESCODE)!="")
               
                {
                    $strwhere .="AND SERIES_CODE = '$SERIESCODE'";
                   
                }
                //DB::enableQueryLog();
                if ($YRBGDATE == $YRBGDATE) {

                	//DB::enableQueryLog();
                	$data1= DB::select("SELECT '$MFROMDATE' AS BankDate, EXTRACT(MONTH FROM '$MFROMDATE') AS month,'' as vrno,'' AS ACCCODE,'' AS ACCNAME,'' AS INSTTYPE,'' AS INSTNO,'' AS INSTDATE,'Op Bal' as particular, sum(yropdr) as drAmt,sum(yropcr) as CrAmt FROM MASTER_GLBAL WHERE FY_CODE='$FYCODE' AND gl_code='$GLCODE' 
                	      #Bring transactions during year opening and  before from date - GL Tran 
                      UNION ALL 
                          #Bring transactions during period - GL Tran 
                      SELECT BANK_DATE as BankDate,EXTRACT(MONTH FROM BANK_DATE) AS month,VRNO as vrno,ACC_CODE AS ACCCODE,ACC_NAME AS ACCNAME,INST_TYPE AS INSTTYPE,INST_NO AS INSTNO,INST_DATE AS INSTDATE,particular,sum(dramt) as drAmt,sum(cramt) as CrAmt FROM CB_TRAN where COMP_CODE='SA' AND FY_CODE='$FYCODE' AND 1=1 AND SERIES_CODE = '$SERIESCODE' AND HEAD_GLCODE='$GLCODE' AND BANK_DATE BETWEEN '$MFROMDATE' AND '$MTODATE' GROUP BY month ORDER BY month");
                	//dd(DB::getQueryLog());
                }else{

                	$data1= DB::select("SELECT M.BankDate,M.vrno,M.SERIES_CODE,M.SERIES_NAME,M.FY_CODE,M.ACC_CODE,M.ACC_NAME,M.GL_CODE,M.GL_NAME,M.INST_TYPE,M.INST_NO,M.INST_DATE,M.particular, M.drAmt,M.CrAmt FROM(
							      #Bring Op Balance from MasterGLBal
							      SELECT '$YRBGDATE' AS BankDate,'' as vrno,'' AS SERIES_CODE,'' AS SERIES_NAME,'' AS FY_CODE,'' AS ACC_CODE,'' AS ACC_NAME,'' AS GL_CODE,'' AS GL_NAME,'' AS INST_TYPE,'' AS INST_NO,'' AS INST_DATE,'Op Bal' as particular, yropdr as drAmt,yropcr as CrAmt FROM MASTER_GLBAL WHERE  FY_CODE='$FYCODE' AND gl_code='$GLCODE'
							      UNION ALL
							      #Bring transactions during year opening and before from date - GL Tran
							      SELECT '$YRBGDATE' as BankDate, ''  as vrno,'' AS SERIES_CODE,'' AS SERIES_NAME,'' AS FY_CODE,'' AS ACC_CODE,'' AS ACC_NAME,'' AS GL_CODE,'' AS GL_NAME,'' AS INST_TYPE,'' AS INST_NO,'' AS INST_DATE,'Op Bal' as particular,sum(dramt) as drAmt, sum(cramt) as CrAmt FROM CB_TRAN WHERE 1=1 AND COMP_CODE='$MCOMPCODE' AND FY_CODE='$FYCODE' AND HEAD_GLCODE='$GLCODE' AND 1=1 AND vrdate BETWEEN '$YRBGDATE' AND DATE_SUB('$MFROMDATE',INTERVAL 1 DAY)
							      ) M GROUP BY  M.BankDate,M.vrno,M.particular
							      UNION ALL
							      #Bring transactions during period - GL Tran
							      SELECT BANK_DATE as BankDate,VRNO as vrno,SERIES_CODE AS SERIES_CODE,SERIES_NAME AS SERIES_NAME,FY_CODE AS FY_CODE,ACC_CODE AS ACC_CODE,ACC_NAME AS ACC_NAME,GL_CODE AS GL_CODE,GL_NAME AS GL_NAME,INST_TYPE AS INST_TYPE,INST_NO AS INST_NO,INST_DATE AS INST_DATE,particular,dramt as drAmt,cramt as CrAmt FROM CB_TRAN where COMP_CODE='$MCOMPCODE' AND FY_CODE='$FYCODE' AND 1=1 AND SERIES_CODE = '$SERIESCODE' AND HEAD_GLCODE='$GLCODE' AND BANK_DATE BETWEEN '$MFROMDATE' AND '$MTODATE' GROUP BY BankDate ORDER BY BankDate");

                }
                
                                  //dd(DB::getQueryLog());

                $data = json_decode(json_encode($data1),true);
	    		if($data) {

	    			return DataTables()->of($data)->addIndexColumn()->make(true);
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
    /* ---------------------------- MONTH WISE SUMMARY --------------------*/

    public function rake_stock_party_summary(Request $request){

  	$title = 'Rake Stock Party Summary Report';
	$compName   = $request->session()->get('company_name');
	$macc_year  = $request->session()->get('macc_year');
	$usertype   = $request->session()->get('user_type');
	$userid     = $request->session()->get('userid');

	$fisYear      =  $request->session()->get('macc_year');
	$splitYR      = explode('-', $fisYear);
	$startYEar    = $splitYR[0].'-04-01';

	$getcomcode = explode('-', $compName);
	$compCode   = $getcomcode[0];

	$userdata['item_list']     = DB::table('DORDER_BODY')->groupBy('ITEM_CODE')->get();
	$userdata['trip_list']     = DB::table('DORDER_BODY')->groupBy('CP_CODE')->get();
	$userdata['rake_list']     = DB::table('DORDER_BODY')->groupBy('RAKE_NO')->get();
	$userdata['toplace_list']  = DB::table('DORDER_BODY')->groupBy('TO_PLACE')->get();
	$userdata['acccode_list']  = DB::table('RAKE_TRAN')->where('COMP_CODE',$compCode)->groupBy('ACC_CODE')->get();
	

	if(isset($compName)){

    	return view('admin.finance.report.C_and_F.rake_stock_party_summary',$userdata+compact('title'));

    }else{

		return redirect('/useractivity');
	}

  }


  	public function getRakeStockPartyReport(Request $request){

		//$strWhere .= "AND COMP_CODE = ''$MCOMP_CODE'' ";
	    //$str_Where .= "AND COMP_CODE = '$MCOMP_CODE' ";

		$compName   = $request->session()->get('company_name');
		$getcomcode = explode('-', $compName);
		$compCode   = $getcomcode[0];

		$MCOMP_CODE = $compCode;
		$strWhere = '';
		$str_Where = '';

		$strWhere .= "AND RAKE_NO !='''' ";
	    $str_Where .= "AND RAKE_NO !='' ";

	    // $strWhere .= "AND COMP_CODE = ''$compCode'' ";
	    // $str_Where .= "AND COMP_CODE ='$compCode' ";
		
		if ($request->ajax()) {

	    // DB::enableQueryLog();

		    if(!empty($request->acc_code)){ 

		    	$acccode   = $request->input('acc_code');
		   
		        if(isset($acccode)  && trim($acccode)!=""){

		            $strWhere .= "AND T.ACC_CODE = ''$acccode'' ";
		            $str_Where .= "AND T.ACC_CODE = '$acccode' ";
		        }

		       
		    //DB::enableQueryLog();
			    DB::raw("SET @sql = NULL");
			    DB::select(DB::raw("SELECT GROUP_CONCAT(DISTINCT CONCAT( 'SUM(case when T.RAKE_NO = ''', T.RAKE_NO, ''' then T.QTYRECD-T.QTYISSUED end) as `', T.RAKE_NO, '`') ) INTO @sql FROM CFINWARD_TRAN T WHERE T.ACC_CODE='$acccode' AND T.RAKE_NO IN (SELECT DISTINCT D.RAKE_NO FROM CFINWARD_TRAN D WHERE D.QTYRECD-D.QTYISSUED > 0);
			    	SET @sql = CONCAT('SELECT  ', @sql, ', T.ITEM_CODE,T.ITEM_NAME AS MATERIAL,T.TO_PLACE AS DESTINATION,T.SP_NAME AS SHIP_TO_PARTY_NAME,T.CP_NAME AS SOLD_TO_PARTY_NAME,IFNULL(M.STATE_CODE,0) AS REGION  from CFINWARD_TRAN T,MASTER_ACCADD M WHERE 1=1 $strWhere AND T.CP_CODE=M.ACC_CODE AND T.TO_PLACE=M.CITY_NAME AND T.QTYRECD-T.QTYISSUED > 0 group by T.CP_CODE,T.SP_CODE,T.TO_PLACE ORDER BY T.CP_CODE,M.STATE_CODE');
	PREPARE stmt FROM @sql"));
			      DB::Statement("PREPARE stmt FROM @sql");
			      $data =  \DB::select("EXECUTE stmt");
			      DB::raw("DEALLOCATE PREPARE stmt");
	      //  dd(DB::getQueryLog());
	           
	            
				
				return DataTables()->of($data)->make(true);

		    }else if($request->blankData == 'Blank'){

		    	$data = array();
		    	return DataTables()->of($data)->addIndexColumn()->make(true);

		    }else{
		    	// print_r('else');
				//DB::enableQueryLog();
		    	DB::raw("SET @sql = NULL");
				DB::select(DB::raw("SELECT GROUP_CONCAT(DISTINCT CONCAT( 'SUM(case when T.RAKE_NO = ''', T.RAKE_NO, ''' then T.QTYRECD-T.QTYISSUED end) as `', T.RAKE_NO, '`') ) INTO @sql FROM CFINWARD_TRAN T;
			    	SET @sql = CONCAT('SELECT  ', @sql, ', T.ITEM_CODE,T.ITEM_NAME AS MATERIAL,T.TO_PLACE AS DESTINATION,T.SP_NAME AS SHIP_TO_PARTY_NAME,T.CP_NAME AS SOLD_TO_PARTY_NAME,CASE WHEN M.STATE_CODE IS NOT NULL THEN  M.STATE_CODE ELSE 0 END AS REGION  from CFINWARD_TRAN T,MASTER_ACCADD M WHERE 1=1 $strWhere AND T.CP_CODE=M.ACC_CODE AND T.TO_PLACE=M.CITY_NAME AND  T.QTYRECD-T.QTYISSUED > 0 group by T.CP_CODE,T.SP_CODE,T.TO_PLACE ORDER BY T.CP_CODE,M.STATE_CODE');
	PREPARE stmt FROM @sql"));
				DB::Statement("PREPARE stmt FROM @sql");
				$data1 =  \DB::select("EXECUTE stmt");
				DB::raw("DEALLOCATE PREPARE stmt");

				//dd(DB::getQueryLog());

				// $data1 = DB::select("SELECT ACC_CODE,CP_NAME,TO_PLACE,ITEM_NAME,RAKE_NO FROM RAKE_TRAN");

	            $data = json_decode(json_encode($data1),true);

				return DataTables()->of($data)->make(true);

		    }

	   
	    }else{

	    	$data = array();
	    	return DataTables()->of($data)->make(true);

	    }

	}


	/* ~~~~~~~~~~~~ TRIP EXPENSES PAYMENT ADVICE ~~~~~~~~~~~~~~ */
	
	public function tripExpPaymentAdvice(Request $request){

		$title = "TRIP EXPENSES PAYMENT ADVICE - REPORT";

        $company_name = $request->session()->get('company_name');
        $getcomcode   = explode('-', $company_name);
        $comp_code    = $getcomcode[0];
        $macc_year    = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid       = $request->session()->get('userid');

       

		$userdata['acc_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userdata['vehicle_list'] = DB::table('TRIP_HEAD')->WHERE('TRIP_PMT_STATUS','0')->get();
		$userdata['tran_list'] = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','A2')->get()->first();

		$series_data = DB::table('MASTER_CONFIG')->WHERE('TRAN_CODE','A2')->WHERE('SERIES_CODE','JT')->WHERE('COMP_CODE',$comp_code)->get()->first();

	    if($series_data){

	      $userdata['series_list'] = $series_data;

	    }else{

	      $userdata['series_list']='';
	    }

		$userdata['taxList'] = DB::table('MASTER_TAX')->get();

		$userdata['ratval_list'] = DB::table('MASTER_RATE_VALUE')->get();

		$fy_list = DB::table('MASTER_FY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->get();

		foreach ($fy_list as $key) {	

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}
 

        if(isset($company_name)){

            return view('admin.finance.report.logistic.trip_exp_payment_advice',$userdata);
        }else{

            return redirect('/useractivity');

        }

	}


	/* ~~~~~~~~~~~~ TRIP EXPENSES PAYMENT ADVICE ~~~~~~~~~~~~~~ */

/* ---------- START :  TDS REPORT ------------- */
	
	public function tdsReport(Request $request){

		$title        = 'TDS Report';

		$comp_nameval = $request->session()->get('company_name');
		
		$fisYear      =  $request->session()->get('macc_year');
		
		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		$data['tds_list'] = DB::table('MASTER_TDS')->get();
		$data['acc_list'] = DB::table('MASTER_ACC')->get();
		$data['gl_list'] = DB::table('MASTER_GL')->get();

		$fy_list = DB::table('MASTER_FY')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->get();

	    foreach ($fy_list as $key) {
	        $data['fromDate'] =  $key->FY_FROM_DATE;
	        $data['toDate']   =  $key->FY_TO_DATE;
	    }

		return view('admin.finance.report.account.tds_ledger_report',$data+compact('title'));

  	}

  	public function TdsReportData(Request $request){

    	$company_name = $request->session()->get('company_name');
		$explodeCnm   = explode('-', $company_name);
		$compCode     = $explodeCnm[0];
		$macc_year    = $request->session()->get('macc_year');

		if ($request->ajax()) {

		   //if(!empty($request->acct_code)) {

				$tdsCode    = $request->input('tds_code');
				$accCode    = $request->input('acc_code');
				$glCode     = $request->input('gl_code');
				$fromDate   = $request->input('from_date');
				$toDate     = $request->input('to_date');
				$reportType = $request->input('report_type');
				
				$fromDvar   = date('Y-m-d',strtotime($fromDate));
				$toDvar     = date('Y-m-d',strtotime($toDate));

				$strwhere='';

				if(isset($tdsCode)){
					$strwhere .="AND TDS_CODE='$tdsCode'";
				}

				if(isset($accCode)){
					$strwhere .="AND ACC_CODE='$accCode'";
				}

				if(isset($glCode)){
					$strwhere .="AND GL_CODE='$glCode'";
				}

				if(isset($fromDate)){
					$strwhere .="AND (VRDATE BETWEEN '$fromDvar' AND '$toDvar')";
				}

				if($reportType == 'pending'){
					$strwhere .= "AND PMT_DRAMT ='0'";
				}else if($reportType == 'complete'){
					$strwhere .= "AND PMT_DRAMT >'0'";
				}
		      	//DB::enableQueryLog();  	
		      	$data = DB::select("SELECT * FROM TDS_TRAN WHERE 1=1 $strwhere");
				//dd(DB::getQueryLog());	
				return DataTables()->of($data)->addIndexColumn()->make(true);

		   //} /* ./ condition if-else close */


		}else{

			$data = array();
		    return DataTables()->of($data)->addIndexColumn()->make(true);

		} /* ./ Ajax If Close */

   }

/* ---------- END : TDS REPORT ------------- */

}
