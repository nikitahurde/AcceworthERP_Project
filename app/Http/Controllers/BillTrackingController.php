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

class BillTrackingController extends Controller{

    public function __construct(){

    }

/* --------- customer vendor position ----------- */

    public function ViewCostVendorPostn(Request $request){

        $compName = $request->session()->get('company_name');
        
        $title    = 'Report Costomer/Vendor Position';
        
        $userid   = $request->session()->get('userid');
        
        $userType = $request->session()->get('usertype');
        
        $fisYear  =  $request->session()->get('macc_year');

        $userData['BIL_TRACK'] = DB::select("SELECT * FROM MASTER_ACCTYPE WHERE BILL_TRACK='1'"); 

        if(isset($compName)){   
            return view('admin.finance.report.bill_tracking.cust_vednor_position',$userData);
        }else{
            return redirect('/useractivity');
        }
    }

    public function getDataCustVenPosition(Request $request){

        if($request->ajax()) {
            if (!empty($request->cust_ven)) {
               
                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $splityear    = explode('-', $macc_year);
                $usertype     = $request->session()->get('user_type');
                $loginUser    = $request->session()->get('userid');
                
                $bgdate       = $request->session()->get('yrbgdate');
                $yrbgdate     = date("Y-m-d", strtotime($bgdate));
                
                $from_date1   = $splityear[0].'-04-01';
                $yearEndDate  = $splityear[1].'-03-31';
                $todayDate    = date("Y-m-d");

                if($todayDate < $yearEndDate){
                    $to_date1 = $todayDate;
                }else{
                    $to_date1 =  $yearEndDate;
                }

                date_default_timezone_set('Asia/Kolkata');

                $strwhere='';
                if(isset($from_date1)  && trim($from_date1)!="")
                {
                        $strwhere .="AND VRDATE BETWEEN '$from_date1' AND '$to_date1'";
                }

                //DB::enableQueryLog();
                $data = DB::select("SELECT t.ACCTRANID,t.ACC_CODE,m.ACC_NAME as acc_name,b.ACC_TYPE,t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt>=0, t.yropdr-t.yropcr+t.yrdramt-t.yrcramt,0) as cldramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt<0, abs(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt),0) as clcramt FROM
                    (
                    SELECT ACCTRANID,ACC_CODE,'' as acc_name, sum(a.yropdr) as yropdr, sum(a.yropcr) as yropcr, sum(a.yrdramt) as yrdramt, sum(a.yrcramt) as yrcramt, 0 as cldramt, 0 as clcramt FROM
                    (
                    #Bring year opening balance
                    SELECT '' as ACCTRANID,'' as ACC_CODE, yropdr as yropdr, yropcr as yropcr, 0 as yrdramt, 0 as yrcramt,'' as acc_name FROM MASTER_ACCBAL WHERE FY_CODE='$macc_year'
                    
                    UNION ALL   
                    #Bring transactions during from date and to date
                    SELECT ACCTRANID,ACC_CODE, 0 as yropdr, 0 as yropcr, if(dramt is NULL,0,dramt) as yrdramt, if(cramt is NULL,0,cramt) as yrcramt,'' as acc_name FROM ACC_TRAN WHERE (VRDATE BETWEEN '$from_date1' AND '$to_date1') AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year'
                    ) a group by a.ACC_CODE order by a.ACC_CODE) t,MASTER_ACCTYPE b,MASTER_ACC m where m.ACC_CODE=t.ACC_CODE AND m.ATYPE_CODE=b.ATYPE_CODE AND m.ATYPE_CODE='$request->cust_ven'");
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

    public function GetDataForAgeAnaForCVPonstn(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $accCode     = $request->input('accCode');
            $accType     = $request->input('accType');
            $macc_year   = $request->session()->get('macc_year');
            $splityear   = explode('-', $macc_year);
            $from_date1  = $splityear[0].'-04-01';
            $yearEndDate = $splityear[1].'-03-31';
            $todayDate   = date("Y-m-d");

            if($todayDate < $yearEndDate){
                $to_date1 = $todayDate;
            }else{
                $to_date1 =  $yearEndDate;
            }

            $company_name = $request->session()->get('company_name');
            $getcomcode   = explode('-', $company_name);
            $comp_code    = $getcomcode[0];

            if($accType == 'C'){

                $pendingBil = DB::select("SELECT A.ACC_CODE, sum(CRAMT) as CRAMT, SUM(DAYS)/COUNT(*) AS AVG_DAYS,SUM(A1) AS ZtoT, SUM(A2) AS TtoS, SUM(A3) AS StN, SUM(A4) AS Nt0OE,SUM(A5) AS G180 FROM ( SELECT ACC_CODE, VRNO, VRDATE, CRAMT- CRALLOC AS CRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, CRAMT - CRALLOC, 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, CRAMT - CRALLOC, 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, CRAMT - CRALLOC, 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, CRAMT - CRALLOC, 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, CRAMT - CRALLOC, 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE BETWEEN '$from_date1' AND '$to_date1') AND CRAMT - CRALLOC>0 ORDER BY DAYS DESC) A GROUP BY A.ACC_CODE");


                $pendingPay = DB::select("SELECT A.ACC_CODE, sum(DRAMT) as DRAMT, SUM(DAYS)/COUNT(*) AS AVG_DAYS,SUM(A1) AS ZtoT, SUM(A2) AS TtoS, SUM(A3) AS StN, SUM(A4) AS Nt0OE,SUM(A5) AS G180 FROM ( SELECT ACC_CODE, VRNO, VRDATE, DRAMT - DRALLOC AS DRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, DRAMT - DRALLOC, 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, DRAMT - DRALLOC, 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, DRAMT - DRALLOC, 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, DRAMT - DRALLOC, 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, DRAMT - DRALLOC, 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE BETWEEN '$from_date1' AND '$to_date1') AND DRAMT - DRALLOC>0 ORDER BY DAYS DESC) A GROUP BY A.ACC_CODE");
                //DB::enableQueryLog();
                $balence = DB::select("SELECT A.ACC_CODE, sum(BALAMT) as BALAMT, SUM(DAYS)/COUNT(*) AS AVG_DAYS,SUM(A1) AS ZtoT, SUM(A2) AS TtoS, SUM(A3) AS StN, SUM(A4) AS Nt0OE,SUM(A5) AS G180 FROM ( SELECT ACC_CODE, VRNO, VRDATE,(CRAMT - CRALLOC) - (DRAMT - DRALLOC)  AS BALAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, (CRAMT - CRALLOC) - (DRAMT - DRALLOC), 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, (CRAMT - CRALLOC) - (DRAMT - DRALLOC), 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, (CRAMT - CRALLOC) - (DRAMT - DRALLOC), 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, (CRAMT - CRALLOC) - (DRAMT - DRALLOC), 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, (CRAMT - CRALLOC) - (DRAMT - DRALLOC), 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE BETWEEN '$from_date1' AND '$to_date1') ORDER BY DAYS DESC) A GROUP BY A.ACC_CODE");
                //dd(DB::getQueryLog());

            }else if($accType == 'D'){

                $pendingBil = DB::select("SELECT A.ACC_CODE, sum(DRAMT) as DRAMT, SUM(DAYS)/COUNT(*) AS AVG_DAYS,SUM(A1) AS ZtoT, SUM(A2) AS TtoS, SUM(A3) AS StN, SUM(A4) AS Nt0OE,SUM(A5) AS G180 FROM ( SELECT ACC_CODE, VRNO, VRDATE, DRAMT -DRALLOC AS DRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, DRAMT - DRALLOC, 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, DRAMT - DRALLOC, 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, DRAMT - DRALLOC, 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, DRAMT - DRALLOC, 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, DRAMT - DRALLOC, 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE BETWEEN '$from_date1' AND '$to_date1') AND DRAMT - DRALLOC>0 ORDER BY DAYS DESC) A GROUP BY A.ACC_CODE");
                //DB::enableQueryLog();
                $pendingPay = DB::select("SELECT A.ACC_CODE, sum(CRAMT) as CRAMT, SUM(DAYS)/COUNT(*) AS AVG_DAYS,SUM(A1) AS ZtoT, SUM(A2) AS TtoS, SUM(A3) AS StN, SUM(A4) AS Nt0OE,SUM(A5) AS G180 FROM ( SELECT ACC_CODE, VRNO, VRDATE, CRAMT - CRALLOC AS CRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, CRAMT - CRALLOC, 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, CRAMT - CRALLOC, 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, CRAMT - CRALLOC, 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, CRAMT - CRALLOC, 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, CRAMT - CRALLOC, 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE BETWEEN '$from_date1' AND '$to_date1') AND CRAMT - CRALLOC>0 ORDER BY DAYS DESC) A GROUP BY A.ACC_CODE");
               // dd(DB::getQueryLog());
                //DB::enableQueryLog();
                $balence = DB::select("SELECT A.ACC_CODE, sum(BALAMT) as BALAMT, SUM(DAYS)/COUNT(*) AS AVG_DAYS,SUM(A1) AS ZtoT, SUM(A2) AS TtoS, SUM(A3) AS StN, SUM(A4) AS Nt0OE,SUM(A5) AS G180 FROM ( SELECT ACC_CODE, VRNO, VRDATE, (DRAMT - DRALLOC) - (CRAMT - CRALLOC) AS BALAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, (DRAMT - DRALLOC) - (CRAMT - CRALLOC), 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, (DRAMT - DRALLOC) - (CRAMT - CRALLOC), 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, (DRAMT - DRALLOC) - (CRAMT - CRALLOC), 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, (DRAMT - DRALLOC) - (CRAMT - CRALLOC), 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, (DRAMT - DRALLOC) - (CRAMT - CRALLOC), 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE BETWEEN '$from_date1' AND '$to_date1') ORDER BY DAYS DESC) A GROUP BY A.ACC_CODE");
                //dd(DB::getQueryLog());
            }else{}
            
            
            if ($pendingBil!='') {

                $response_array['response']    = 'success';
                $response_array['pending_bil'] = $pendingBil;
                $response_array['pending_pay'] = $pendingPay;
                $response_array['balence']     = $balence;

                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data']     = '' ;
                $response_array['message']  = 'NOT FOUND';
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


/* ---------- pending bills ----------- */

    public function PendingBillsDetails(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $company_name = $request->session()->get('company_name');
            $getcomcode   = explode('-', $company_name);
            $comp_code    = $getcomcode[0];
            $macc_year    = $request->session()->get('macc_year');
            $accCode      = $request->input('acc_Code');
            $Dmode        = $request->input('Dmode');
            $accType      = $request->input('accType');
            $todayDate    = date("Y-m-d");
            //DB::enableQueryLog();

            if($accType == 'C'){

                if($Dmode == 'Bill'){
                   $pendingBil = DB::select("SELECT ACCTRANID,ACC_CODE,ACC_NAME,SERIES_CODE,FY_CODE, VRNO, VRDATE, CRAMT - CRALLOC AS CRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, CRAMT - CRALLOC, 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, CRAMT - CRALLOC, 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, CRAMT - CRALLOC, 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, CRAMT - CRALLOC, 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, CRAMT - CRALLOC, 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE <= '$todayDate') AND CRAMT - CRALLOC>0 ORDER BY DAYS DESC");
                }else if($Dmode =='payement'){
                   // DB::enableQueryLog();
                     $pendingBil = DB::select("SELECT ACCTRANID,ACC_CODE,ACC_NAME,SERIES_CODE,FY_CODE, VRNO, VRDATE, DRAMT - DRALLOC AS DRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, DRAMT - DRALLOC, 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, DRAMT - DRALLOC, 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, DRAMT - DRALLOC, 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, DRAMT - DRALLOC, 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, DRAMT - DRALLOC, 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE <= '$todayDate') AND DRAMT - DRALLOC>0 ORDER BY DAYS DESC");
                   //  dd(DB::getQueryLog());
                }
            }else if($accType == 'D'){

                if($Dmode == 'Bill'){
                    $pendingBil = DB::select("SELECT ACCTRANID,ACC_CODE,ACC_NAME,SERIES_CODE,FY_CODE, VRNO, VRDATE, DRAMT - DRALLOC AS DRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, DRAMT - DRALLOC, 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, DRAMT - DRALLOC, 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, DRAMT - DRALLOC, 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, DRAMT - DRALLOC, 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, DRAMT - DRALLOC, 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE <= '$todayDate') AND DRAMT - DRALLOC>0 ORDER BY DAYS DESC");
                }else if($Dmode =='payement'){
                   // DB::enableQueryLog();
                     $pendingBil = DB::select("SELECT ACCTRANID,ACC_CODE,ACC_NAME,SERIES_CODE,FY_CODE, VRNO, VRDATE, CRAMT - CRALLOC AS CRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, CRAMT - CRALLOC, 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, CRAMT - CRALLOC, 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, CRAMT - CRALLOC, 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, CRAMT - CRALLOC, 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, CRAMT - CRALLOC, 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE <= '$todayDate') AND CRAMT - CRALLOC>0 ORDER BY DAYS DESC");
                   //  dd(DB::getQueryLog());
                }
            }

            //dd(DB::getQueryLog());
             if ($pendingBil!='') {

                $response_array['response']    = 'success';
                $response_array['pending_bil'] = $pendingBil;

                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data']     = '' ;
                $response_array['message']  = 'NOT FOUND';
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

    public function AmountAllocation(Request $request){

        $response_array = array();

        if ($request->ajax()) {

            $company_name = $request->session()->get('company_name');
            $getcomcode   = explode('-', $company_name);
            $comp_code    = $getcomcode[0];
            $macc_year    = $request->session()->get('macc_year');
            $accCode      = $request->input('acc_Code');
            $modepb       = $request->input('modepb');
            $accTypes     = $request->input('accTypes');
            $todayDate    = date("Y-m-d");

            if($accTypes == 'D'){

                if($modepb == 'Bill'){

                    $pendingBil = DB::select("SELECT ACCTRANID,ACC_CODE,ACC_NAME,SERIES_CODE,FY_CODE, VRNO, VRDATE, CRAMT - CRALLOC AS CRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, CRAMT - CRALLOC, 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, CRAMT - CRALLOC, 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, CRAMT - CRALLOC, 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, CRAMT - CRALLOC, 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, CRAMT - CRALLOC, 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE <= '$todayDate') AND CRAMT - CRALLOC>0 ORDER BY DAYS DESC");

                }else if($modepb == 'payement'){

                    $pendingBil = DB::select("SELECT ACCTRANID,ACC_CODE,ACC_NAME,SERIES_CODE,FY_CODE, VRNO, VRDATE, DRAMT - DRALLOC AS DRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, DRAMT - DRALLOC, 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, DRAMT - DRALLOC, 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, DRAMT - DRALLOC, 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, DRAMT - DRALLOC, 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, DRAMT - DRALLOC, 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE <= '$todayDate') AND DRAMT - DRALLOC>0 ORDER BY DAYS DESC");
                }

            }else if($accTypes == 'C'){

                if($modepb == 'Bill'){

                    $pendingBil = DB::select("SELECT ACCTRANID,ACC_CODE,ACC_NAME,SERIES_CODE,FY_CODE, VRNO, VRDATE, DRAMT - DRALLOC AS DRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, DRAMT - DRALLOC, 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, DRAMT - DRALLOC, 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, DRAMT - DRALLOC, 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, DRAMT - DRALLOC, 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, DRAMT - DRALLOC, 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE <= '$todayDate') AND DRAMT - DRALLOC>0 ORDER BY DAYS DESC");

                }else if($modepb == 'payement'){

                    $pendingBil = DB::select("SELECT ACCTRANID,ACC_CODE,ACC_NAME,SERIES_CODE,FY_CODE, VRNO, VRDATE, CRAMT - CRALLOC AS CRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, CRAMT - CRALLOC, 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, CRAMT - CRALLOC, 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, CRAMT - CRALLOC, 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, CRAMT - CRALLOC, 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, CRAMT - CRALLOC, 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND COMP_CODE='$comp_code' AND FY_CODE='$macc_year' AND (VRDATE <= '$todayDate') AND CRAMT - CRALLOC>0 ORDER BY DAYS DESC");
                }

            }

            
            
             if ($pendingBil!='') {

                $response_array['response']    = 'success';
                $response_array['pending_bil'] = $pendingBil;

                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data']     = '' ;
                $response_array['message']  = 'NOT FOUND';
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

    public function AmountAllocateUpdate(Request $request){

        if ($request->ajax()){
            
            $CompanyCode  = $request->session()->get('company_name');
            $spliCode     = explode('-', $CompanyCode);
            $comp_code    = $spliCode[0];
            $macc_year    = $request->session()->get('macc_year');
            $loginUser    = $request->session()->get('userid');
            $alocateAmt   = $request->alocateAmt;
            $accTranId    = $request->accTranId;
            $dmode        = $request->dmode;
            $drVrno       = $request->drVrno;
            $drDate       = $request->drDate;
            $cr_vrno      = $request->cr_vrno;
            $cr_vrdate    = $request->cr_vrdate;
            $accCode      = $request->accCode;
            $accTrnsUpId  = $request->accTrnsUpId;
            $acc_types    = $request->acc_types;
            $against_UpID = $request->against_UpID;
            $totlAloAmnt  = $request->totlAloAmnt;

            if($accTranId){
                $AccIDCnt    = count($accTranId);

                DB::beginTransaction();

                try {

                    for($i=0;$i<$AccIDCnt;$i++){

                        if($alocateAmt[$i]){
                            $alocAmount = $alocateAmt[$i];
                        }else{
                            $alocAmount = 0.00;
                        }

                        if($acc_types == 'C'){

                            if($dmode == 'Bill'){

                                $getData       = DB::table('ACC_TRAN')->where('ACCTRANID',$accTranId[$i])->get()->first();
                                
                                $olddr_AlocAmt = $getData->DRALLOC;
                                $newAlocAmt    = $olddr_AlocAmt + $alocAmount;

                                $data = array(
                                  'DRALLOC' =>$newAlocAmt,
                                );

                                DB::table('ACC_TRAN')->where('ACCTRANID',$accTranId[$i])->update($data);

                                $alocDate = array(
                                    'DRVRNO'     => $cr_vrno[$i],
                                    'DRVRNODATE' => $cr_vrdate[$i],
                                    'ACC_CODE'   => $accCode,
                                    'ALLOC_AMT'  => $alocAmount,
                                    'CRVRNO'     => $drVrno,
                                    'CRVRDATE'   => $drDate,
                                    'CREATED_BY' => $loginUser,
                                );

                                DB::table('BILL_TRACK_TRAN')->insert($alocDate);

                            }else if($dmode == 'payement'){

                                $getData       = DB::table('ACC_TRAN')->where('ACCTRANID',$accTranId[$i])->get()->first();
                                
                                $olddr_AlocAmt = $getData->CRALLOC;
                                $newAlocAmt    = $olddr_AlocAmt + $alocAmount;

                                $data = array(
                                  'CRALLOC' =>$newAlocAmt,
                                );

                                DB::table('ACC_TRAN')->where('ACCTRANID',$accTranId[$i])->update($data);

                                $alocDate = array(
                                    'DRVRNO'     => $drVrno,
                                    'DRVRNODATE' => $drDate,
                                    'ACC_CODE'   => $accCode,
                                    'ALLOC_AMT'  => $alocAmount,
                                    'CRVRNO'     => $cr_vrno[$i],
                                    'CRVRDATE'   => $cr_vrdate[$i],
                                    'CREATED_BY' => $loginUser,
                                );

                                DB::table('BILL_TRACK_TRAN')->insert($alocDate);

                            }
                        }else if($acc_types == 'D'){

                            if($dmode == 'Bill'){

                                $getData       = DB::table('ACC_TRAN')->where('ACCTRANID',$accTranId[$i])->get()->first();
                                
                                $olddr_AlocAmt = $getData->CRALLOC;
                                $newAlocAmt    = $olddr_AlocAmt + $alocAmount;

                                $data = array(
                                  'CRALLOC' =>$newAlocAmt,
                                );

                                DB::table('ACC_TRAN')->where('ACCTRANID',$accTranId[$i])->update($data);

                                $alocDate = array(
                                    'DRVRNO'     => $drVrno,
                                    'DRVRNODATE' => $drDate,
                                    'ACC_CODE'   => $accCode,
                                    'ALLOC_AMT'  => $alocAmount,
                                    'CRVRNO'     => $cr_vrno[$i],
                                    'CRVRDATE'   => $cr_vrdate[$i],
                                    'CREATED_BY' => $loginUser,
                                );

                                DB::table('BILL_TRACK_TRAN')->insert($alocDate);

                            }else if($dmode == 'payement'){

                                $getData       = DB::table('ACC_TRAN')->where('ACCTRANID',$accTranId[$i])->get()->first();
                                
                                $olddr_AlocAmt = $getData->DRALLOC;
                                $newAlocAmt    = $olddr_AlocAmt + $alocAmount;

                                $data = array(
                                  'DRALLOC' =>$newAlocAmt,
                                );

                                DB::table('ACC_TRAN')->where('ACCTRANID',$accTranId[$i])->update($data);

                                $alocDate = array(
                                    'DRVRNO'     => $cr_vrno[$i],
                                    'DRVRNODATE' => $cr_vrdate[$i],
                                    'ACC_CODE'   => $accCode,
                                    'ALLOC_AMT'  => $alocAmount,
                                    'CRVRNO'     => $drVrno,
                                    'CRVRDATE'   => $drDate,
                                    'CREATED_BY' => $loginUser,
                                );

                                DB::table('BILL_TRACK_TRAN')->insert($alocDate);

                            }
                        } 

                    } /* /. for lop close*/

                    if($acc_types == 'C'){
                        if($dmode == 'Bill'){

                            $crBAlData       = DB::table('ACC_TRAN')->where('ACCTRANID',$against_UpID)->get()->first();

                            $oldcrb_totlAmt = $crBAlData->CRALLOC;

                            $newTotlAlocrAmt = $oldcrb_totlAmt + $totlAloAmnt;

                            $dataCrBA = array(
                                  'CRALLOC' =>$newTotlAlocrAmt,
                                );

                            DB::table('ACC_TRAN')->where('ACCTRANID',$against_UpID)->update($dataCrBA);

                        }else if($dmode == 'payement'){

                            $drBAlData       = DB::table('ACC_TRAN')->where('ACCTRANID',$against_UpID)->get()->first();

                            $olddrb_totlAmt = $drBAlData->DRALLOC;

                            $newTotlAlodrAmt = $olddrb_totlAmt + $totlAloAmnt;

                            $datadrBA = array(
                                  'DRALLOC' =>$newTotlAlodrAmt,
                                );

                            DB::table('ACC_TRAN')->where('ACCTRANID',$against_UpID)->update($datadrBA);

                        }
                    }else if($acc_types == 'D'){
                        if($dmode == 'Bill'){

                            $drAlData       = DB::table('ACC_TRAN')->where('ACCTRANID',$against_UpID)->get()->first();
                                
                            $olddr_totlAmt = $drAlData->DRALLOC;

                            $newTotlAlocAmt = $olddr_totlAmt + $totlAloAmnt;

                            $dataDrA = array(
                                  'DRALLOC' =>$newTotlAlocAmt,
                                );

                            DB::table('ACC_TRAN')->where('ACCTRANID',$against_UpID)->update($dataDrA);

                        }else if($dmode == 'payement'){

                            $crAlData       = DB::table('ACC_TRAN')->where('ACCTRANID',$against_UpID)->get()->first();
                                
                            $oldcr_totlAmt = $crAlData->CRALLOC;

                            $newTotlcAlocAmt = $oldcr_totlAmt + $totlAloAmnt;

                            $dataCrA = array(
                                  'CRALLOC' =>$newTotlcAlocAmt,
                                );

                            DB::table('ACC_TRAN')->where('ACCTRANID',$against_UpID)->update($dataCrA);

                        }
                    }

                    DB::commit();
                    
                    $response_array['response'] = 'success';
                    $data = json_encode($response_array);
                    print_r($data);

                } catch (\Exception $e) {
                    DB::rollBack();
                    //throw $e;
                    $response_array['response'] = 'error';
                    $data = json_encode($response_array);
                    print_r($data);
                }

                
            }

        }

    }

/* ----- customer/vendor position-------*/

/* ----------- Pending bill/payments -----------*/
    
    public function pendingBilPayment(Request $request){

        //$userData['paybil'] = DB::select("SELECT a.ACC_CODE,a.ACC_NAME,a.ATYPE_CODE,b.ATYPE_CODE,b.ACC_TYPE FROM `MASTER_ACC` a,MASTER_ACCTYPE b WHERE a.ATYPE_CODE=b.ATYPE_CODE AND b.ACC_TYPE='D'");

        $userData['BIL_TRACK'] = DB::select("SELECT * FROM MASTER_ACCTYPE WHERE BILL_TRACK='1'"); 

        return view('admin.finance.report.bill_tracking.pending_bil_payment',$userData);            

    }

    public function getAllDataBilPay(Request $request){

        if($request->ajax()) {

            if (!empty($request->acc_code)) {
                
                $acc_code    = $request->acc_code;
                $acc_type    = $request->acc_type;
                $report_type = $request->report_type;
                $billPay     = $request->billPay;

                //print_r($billPay);
                
                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $splityear    = explode('-', $macc_year);
                $usertype     = $request->session()->get('user_type');
                $loginUser    = $request->session()->get('userid');
                
                $bgdate       = $request->session()->get('yrbgdate');
                $yrbgdate     = date("Y-m-d", strtotime($bgdate));
                
                $from_date1   = $splityear[0].'-04-01';
                $yearEndDate  = $splityear[1].'-03-31';
                $todayDate    = date("Y-m-d");

                if($todayDate < $yearEndDate){
                    $to_date1 = $todayDate;
                }else{
                    $to_date1 =  $yearEndDate;
                }

                date_default_timezone_set('Asia/Kolkata');
                if(($acc_type == 'D' && $billPay == 'Bill') || ($acc_type == 'C' && $billPay == 'Payment')){

                    if($report_type == 'pending'){
                        // DB::enableQueryLog();
                        $data=DB::select("SELECT a.VRNO BilVrno,a.FY_CODE,a.SERIES_CODE, a.VRDATE BilVrDate, a.DRAMT as BillAmt, DATEDIFF(CURDATE(), a.VRDATE) AS DAYS,b.ALLOC_AMT,a.DRALLOC AS AlocAmt,a.DRAMT -a.DRALLOC AS BalAmt FROM ACC_TRAN a LEFT JOIN BILL_TRACK_TRAN b ON b.ACC_CODE=a.ACC_CODE WHERE a.ACC_CODE='$acc_code' AND a.COMP_CODE='$comp_code' AND a.FY_CODE='$macc_year' AND (a.VRDATE <= '$to_date1') AND a.DRAMT - a.DRALLOC>0 ORDER BY DAYS DESC");
                        // dd(DB::getQueryLog());
                    }else if($report_type == 'complete'){
                        $data=DB::select("SELECT a.ACCTRANID,a.VRNO BilVrno,a.FY_CODE,a.SERIES_CODE, a.VRDATE BilVrDate, a.DRAMT as BillAmt, DATEDIFF(CURDATE(), a.VRDATE) AS DAYS,a.DRALLOC AS AlocAmt,a.DRAMT -a.DRALLOC AS BalAmt FROM ACC_TRAN a WHERE a.ACC_CODE='$acc_code' AND a.COMP_CODE='$comp_code' AND a.FY_CODE='$macc_year' AND (a.VRDATE <= '$to_date1') AND a.DRAMT!='0.00' AND a.DRAMT=a.DRALLOC ORDER BY DAYS DESC");
                    }else if($report_type == 'all'){
                        $data=DB::select("SELECT a.ACCTRANID,a.VRNO BilVrno,a.FY_CODE,a.SERIES_CODE, a.VRDATE BilVrDate, a.DRAMT as BillAmt, DATEDIFF(CURDATE(), a.VRDATE) AS DAYS,a.DRALLOC AS AlocAmt,a.DRAMT -a.DRALLOC AS BalAmt FROM ACC_TRAN a WHERE a.ACC_CODE='$acc_code' AND a.COMP_CODE='$comp_code' AND a.FY_CODE='$macc_year' AND (a.VRDATE <= '$to_date1') AND ((a.DRAMT!='0.00' AND a.DRAMT=a.DRALLOC) OR (a.DRAMT - a.DRALLOC>0)) ORDER BY DAYS DESC");
                    }else{
                        $data='';
                    }

                }else if(($acc_type == 'D' && $billPay == 'Payment') || ($acc_type == 'C' && $billPay == 'Bill')){

                    if($report_type == 'pending'){
                        //DB::enableQueryLog();
                        $data=DB::select("SELECT a.VRNO BilVrno,a.FY_CODE,a.SERIES_CODE, a.VRDATE BilVrDate, a.CRAMT as BillAmt, DATEDIFF(CURDATE(), a.VRDATE) AS DAYS,b.ALLOC_AMT,a.CRALLOC AS AlocAmt,a.CRAMT -a.CRALLOC AS BalAmt FROM ACC_TRAN a LEFT JOIN BILL_TRACK_TRAN b ON b.ACC_CODE=a.ACC_CODE WHERE a.ACC_CODE='$acc_code' AND a.COMP_CODE='$comp_code' AND a.FY_CODE='$macc_year' AND (a.VRDATE <= '$to_date1') AND a.CRAMT - a.CRALLOC>0 ORDER BY DAYS DESC");
                          //dd(DB::getQueryLog());
                    }else if($report_type == 'complete'){
                         $data=DB::select("SELECT a.ACCTRANID,a.VRNO BilVrno,a.FY_CODE,a.SERIES_CODE, a.VRDATE BilVrDate, a.CRAMT as BillAmt, DATEDIFF(CURDATE(), a.VRDATE) AS DAYS,a.CRALLOC AS AlocAmt,a.CRAMT -a.CRALLOC AS BalAmt FROM ACC_TRAN a WHERE a.ACC_CODE='$acc_code' AND a.COMP_CODE='$comp_code' AND a.FY_CODE='$macc_year' AND (a.VRDATE <= '$to_date1') AND a.CRAMT!='0.00' AND a.CRAMT=a.CRALLOC ORDER BY DAYS DESC");
                    }else if($report_type == 'all'){
                        $data=DB::select("SELECT a.ACCTRANID,a.VRNO BilVrno,a.FY_CODE,a.SERIES_CODE, a.VRDATE BilVrDate, a.CRAMT as BillAmt, DATEDIFF(CURDATE(), a.VRDATE) AS DAYS,a.CRALLOC AS AlocAmt,a.CRAMT -a.CRALLOC AS BalAmt FROM ACC_TRAN a WHERE a.ACC_CODE='$acc_code' AND a.COMP_CODE='$comp_code' AND a.FY_CODE='$macc_year' AND (a.VRDATE <= '$to_date1') AND ((a.CRAMT!='0.00' AND a.CRAMT=a.CRALLOC) OR (a.CRAMT - a.CRALLOC>0)) ORDER BY DAYS DESC");
                    }else{
                        $data='';
                    }
                    
                }
                return DataTables()->of($data)->make(true);
            }else{

                $data = array();

                return DataTables()->of($data)->make(true);
                
            }

        }else{

            $data = array();

            return DataTables()->of($data)->make(true);

        }

    }

/* ----------- Pending bill/payments -----------*/


    public function pendingBillsReport(Request $request,$accCode){

        $compName    = $request->session()->get('company_name');
        $title       = 'Report Pending Bills';
        $userid      = $request->session()->get('userid');
        $userType    = $request->session()->get('usertype');
        $fisYear     = $request->session()->get('macc_year');
        $splityear   = explode('-', $fisYear);
        $from_date1  = $splityear[0].'-04-01';
        $yearEndDate = $splityear[1].'-03-31';
        $todayDate   = date("Y-m-d");

        if($todayDate < $yearEndDate){
            $to_date1 = $todayDate;
        }else{
            $to_date1 =  $yearEndDate;
        }   
        //DB::enableQueryLog();
        $pendingBil = DB::select("SELECT A.ACC_CODE, A.ACC_NAME,sum(DRAMT) as DRAMT, SUM(DAYS)/COUNT(*) AS AVG_DAYS,SUM(A1) AS ZtoT, SUM(A2) AS TtoS, SUM(A3) AS StN, SUM(A4) AS Nt0OE,SUM(A5) AS G180 FROM ( SELECT ACC_CODE,ACC_NAME, VRNO, VRDATE, DRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, DRAMT - DRALLOC, 0) AS A1, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, DRAMT - DRALLOC, 0) AS A2, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, DRAMT - DRALLOC, 0) AS A3, IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, DRAMT - DRALLOC, 0) AS A4, IF(DATEDIFF(CURDATE(), VRDATE) > 180, DRAMT - DRALLOC, 0) AS A5 FROM ACC_TRAN WHERE ACC_CODE='$accCode' AND (VRDATE BETWEEN '$from_date1' AND '$to_date1') AND DRAMT - DRALLOC>0 ORDER BY DAYS DESC) A GROUP BY A.ACC_CODE");
        //dd(DB::getQueryLog());
        if(isset($compName)){   
            return view('admin.finance.report.bill_tracking.pending_bil',compact('pendingBil'));
        }else{
            return redirect('/useractivity');
        }

    }

    public function pendingBillforDC(Request $request){

        $response_array = array();

        if ($request->ajax()) {

            $CompanyCode = $request->session()->get('company_name');
            $spliCode    = explode('-', $CompanyCode);
            $comp_code   = $spliCode[0];
            $macc_year   = $request->session()->get('macc_year');
            $acc_code    = $request->input('accCode');
            $Qmode       = $request->input('Qmode');
            $accType     = $request->input('accType');
            $todayDate   = date("Y-m-d");

            if($accType =='D'){
                
                if($Qmode == 'Bill'){
                    $BilDetail = DB::select("SELECT A.VRNO,B.TRAN_HEAD ,A.VRDATE, A.DRAMT AS BillAmt, A.DRALLOC AS PrevAlloc, A.DRAMT-A.DRALLOC as BalAmt,A.SERIES_CODE,A.FY_CODE FROM ACC_TRAN A,MASTER_TRANSACTION B WHERE A.ACC_CODE='$acc_code' AND A.VRDATE <= '$todayDate' AND A.DRAMT - A.DRALLOC > 0 AND A.TRAN_CODE=B.TRAN_CODE ORDER BY A.VRDATE");
                }else if($Qmode == 'payement'){

                    $BilDetail = DB::select("SELECT A.VRNO,B.TRAN_HEAD ,A.VRDATE, A.CRAMT AS BillAmt, A.CRALLOC AS PrevAlloc, A.CRAMT-A.CRALLOC as BalAmt,A.SERIES_CODE,A.FY_CODE FROM ACC_TRAN A,MASTER_TRANSACTION B WHERE A.ACC_CODE='$acc_code' AND A.VRDATE <= '$todayDate' AND A.CRAMT - A.CRALLOC > 0 AND A.TRAN_CODE=B.TRAN_CODE ORDER BY A.VRDATE");
                }
            }else if($accType =='C'){

                if($Qmode == 'Bill'){
                    $BilDetail = DB::select("SELECT A.VRNO,B.TRAN_HEAD ,A.VRDATE, A.CRAMT AS BillAmt, A.CRALLOC AS PrevAlloc, A.CRAMT-A.CRALLOC as BalAmt,A.SERIES_CODE,A.FY_CODE FROM ACC_TRAN A,MASTER_TRANSACTION B WHERE A.ACC_CODE='$acc_code' AND A.VRDATE <= '$todayDate' AND A.CRAMT - A.CRALLOC > 0 AND A.TRAN_CODE=B.TRAN_CODE ORDER BY A.VRDATE");
                }else if($Qmode == 'payement'){

                    $BilDetail = DB::select("SELECT A.VRNO,B.TRAN_HEAD ,A.VRDATE, A.DRAMT AS BillAmt, A.DRALLOC AS PrevAlloc, A.DRAMT-A.DRALLOC as BalAmt,A.SERIES_CODE,A.FY_CODE FROM ACC_TRAN A,MASTER_TRANSACTION B WHERE A.ACC_CODE='$acc_code' AND A.VRDATE <= '$todayDate' AND A.DRAMT - A.DRALLOC > 0 AND A.TRAN_CODE=B.TRAN_CODE ORDER BY A.VRDATE");
                    
                }

            }


            

            if ($BilDetail) {

                $response_array['response'] = 'success';
                $response_array['data_bill'] = $BilDetail;

               echo $data = json_encode($response_array);

            }else{

                $response_array['response'] = 'error';
                $response_array['data_bill'] = '';

                $data = json_encode($response_array);

                print_r($data);
                
            }


        }else{

                $response_array['response'] = 'error';
                $response_array['data_bill'] = '';

                $data = json_encode($response_array);

                print_r($data);
        }

    }

/* ---------- pending bills ----------- */

/* ----------- bill allocation ---------- */

    public function BillAllocation(Request $request){

        $userData['customerData'] = DB::select("SELECT A.* FROM MASTER_ACC A,MASTER_ACCTYPE T WHERE A.ATYPE_CODE=T.ATYPE_CODE AND T.BILL_TRACK='1'");
        
        return view('admin.finance.report.bill_tracking.bill_allocation',$userData);
    }

    public function getDataBillAllocation(Request $request){

        if($request->ajax()) {
            if (!empty($request->customer_code)) {
               
                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');

                date_default_timezone_set('Asia/Kolkata');

                $strWhere = '';

                if(isset($request->customer_code)  && trim($request->customer_code)!=""){
                   
                    $strWhere .= " AND  ACC_CODE = '$request->customer_code'";

                    
                } 

                $data = DB::select("SELECT * FROM ACC_TRAN WHERE 1=1 $strWhere");
                
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

/* ----------- bill allocation ---------- */


/* ---------- account code against acctype ---------- */
    
    public function AccListAgainstAType(Request $request){

        $response_array = array();

        if ($request->ajax()) {

            $company_name = $request->session()->get('company_name');
            $getcomcode   = explode('-', $company_name);
            $comp_code    = $getcomcode[0];
            $macc_year    = $request->session()->get('macc_year');
            $accTypeCd    = $request->input('accTypeCd');

            //print_r($accTypeCd);
            $todayDate    = date("Y-m-d");
            //DB::enableQueryLog();
            $accCode = DB::select("SELECT a.ACC_CODE,a.ACC_NAME FROM `MASTER_ACC` a,MASTER_ACCTYPE b WHERE a.ATYPE_CODE=b.ATYPE_CODE AND a.ATYPE_CODE='$accTypeCd'");
           // dd(DB::getQueryLog());
            
             if ($accCode!='') {

                $response_array['response']    = 'success';
                $response_array['accCodeList'] = $accCode;

                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data']     = '' ;
                $response_array['message']  = 'NOT FOUND';
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

/* ---------- account code against acctype ---------- */

}