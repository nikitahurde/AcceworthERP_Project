<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Dispatch;
use Auth;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PurchaseIndentReportExport;
use App\Exports\PurchaseEnqueryReportExport;
use App\Exports\PurchaseQuotationReportExport;
use App\Exports\PurchaseContractReportExport;
use App\Exports\PurchaseOrderReportExport;
use App\Exports\PurchaseGrnReportExport;
use App\Exports\PurchaseBillReportExport;
use App\Exports\PurchaseMonthlyQuotationExport;
use App\Exports\PurchaseMonthlyContractExport;
use App\Exports\PurchaseMonthlyOrderExport;
use App\Exports\PurchaseMonthlyGrnExport;
use App\Exports\PurchaseMonthlyBillExport;


class FinanacePurchaseReportController extends Controller{


    public function __cunstruct(Request $request){

    }


    public function CommonFunction($macc_year,$Comp_Code,$Tran_Code,$Tran_Code2){

         $queryData['item_um_aum_list'] = DB::table('MASTER_FY')->where('COMP_CODE',$Comp_Code)->where('FY_CODE',$macc_year)->get();

         $queryData['bank_list']        = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=',$Tran_Code)->orWhere('TRAN_CODE', '=',$Tran_Code2)->get();

         $queryData['transpoter_list']  = DB::table('MASTER_ACC')->get();
         $queryData['item_list']        = DB::table('MASTER_ITEM')->get();

      
        $queryData['qc_list']   = DB::table('PQCS_HEAD')->get()->toArray();
        $queryData['qc_body_list'] = DB::table('PQCS_BODY')->groupBy('ITEM_CODE')->get();


        return $queryData;

    }


    public function GetCalTaxDataPurchaseReports(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $HeadId     = $request->input('headid');
            $BodyId     = $request->input('bodyId');
            $tblName    = $request->input('tblName');
            $tblName1    = $request->input('tblName1');
            $headIdName = $request->input('headIdName');
            $bodyIdName = $request->input('bodyIdName');
            
            $fetch_reocrd  = DB::table($tblName)->where($headIdName,$HeadId)->where($bodyIdName,$BodyId)->get();

            $fetch_reocrd1 = DB::table($tblName1)->where($headIdName,$HeadId)->get();


            if ($fetch_reocrd!='') {

                $response_array['response']    = 'success';
                $response_array['data']        = $fetch_reocrd;
                $response_array['tax_code']    = $fetch_reocrd1;

                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data']     = '' ;
                $response_array['tax_code']    = '';
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


   

    public function GetQualityParameter(Request $request){

        $response_array = array();

        $itemcode = $request->input('ItemCode');
        $p_headid = $request->input('HeadId');
        $p_bodyid = $request->input('BodyId');
        $pageName1 = $request->input('pageName');

        $pageName = trim($pageName1,' ');
        
        if ($request->ajax()) {


            if($pageName=='purchaseIndent'){


                if($p_headid && $p_bodyid && $itemcode){

                    $itemcode_get_data = DB::table('PINDENT_QUA')->where('PINDHID',$p_headid)->where('PINDBID',$p_bodyid)->where('ITEM_CODE',$itemcode)->get()->toArray();

                    if(empty($itemcode_get_data)){

                        // $itemcode_get = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemcode)->get()->first();

                        // $itemcode_get = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode_get->ICATG_CODE)->get()->toArray();
                        $itemcode_get = array();

                    }else{
                        // $itemcode_get =  DB::table('PINDENT_QUA')->where('PINDHID',$p_headid)->where('PINDBID',$p_bodyid)->where('ITEM_CODE',$itemcode)->get()->toArray();

                        $itemcode_get = $itemcode_get_data;
                    }

                }else{

                    $itemcode_get = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemcode)->get()->first();
                  //  print_r($itemcode_get);exit;

                   $itemcode_get = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode_get->ICATG_CODE)->get()->toArray();
                }


            }else if($pageName == 'purchaseEnquery'){

                $itemcode_get1 = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemcode)->get()->first();
        
                $itemcode_get = DB::table('PENQ_QUA')->where('ITEM_CODE',$itemcode)->get()->toArray();


            }else if($pageName == 'purchaseQuotation'){

                $PurQuoHeadId = $request->input('headid');
                $PurQuoBodyId = $request->input('bodyId');


                $itemcode_get1 = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemcode)->get()->first();

                $itemcode_get = DB::table('PQTN_QUA')->where('PQTNHID',$PurQuoHeadId)->where('PQTNBID',$PurQuoBodyId)->get();


            }else if($pageName == 'purchaseContract'){

                $PurQuoHeadId = $request->input('headid');
                $PurQuoBodyId = $request->input('bodyId');


                $itemcode_get1 = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemcode)->get()->first();

                $itemcode_get = DB::table('PCNTR_QUA')->where('PCNTRHID',$PurQuoHeadId)->where('PCNTRBID',$PurQuoBodyId)->get();


            }else if($pageName == 'purchaseOrder'){

                $PurQuoHeadId = $request->input('headid');
                $PurQuoBodyId = $request->input('bodyId');


                $itemcode_get1 = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemcode)->get()->first();

                $itemcode_get = DB::table('PORDER_QUA')->where('PORDERHID',$PurQuoHeadId)->where('PORDERBID',$PurQuoBodyId)->get();

            }else if($pageName == 'purchaseGRN'){

                $PurQuoHeadId = $request->input('headid');
                $PurQuoBodyId = $request->input('bodyId');


                $itemcode_get1 = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemcode)->get()->first();

                $itemcode_get = DB::table('GRN_QUA')->where('GRNHID',$PurQuoHeadId)->where('GRNBID',$PurQuoBodyId)->get();

            }else{

                $itemcode_get = array();
                $itemcode = '';
            }

           
            if ($itemcode_get) {

                $response_array['response']  = 'success';
                $response_array['data']      = $itemcode_get;
                $response_array['item_code'] = $itemcode;


                $data = json_encode($response_array);

                print_r($data);

            }else{

                $response_array['response']  = 'error';
                $response_array['data']      = $itemcode_get;
                $response_array['item_code'] = array();

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

    public function PurchaseIndentReport(Request $request){

        $title = "Purchase Indent Report";

        $company_name = $request->session()->get('company_name');
        $macc_year    = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid       = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode   = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);


        $userdata['indent_list'] = DB::select("SELECT PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.VRDATE,PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.PARTYREFNO,PINDENT_HEAD.PARTYREFDATE,PINDENT_BODY.* FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_HEAD.PINDHID  = PINDENT_BODY.PINDHID GROUP BY PINDENT_BODY.PINDHID");

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        $master_emp      = DB::table('MASTER_EMP')->where('COMP_CODE',$CCFromSession)->get();
        $master_dept     = DB::table('MASTER_DEPT')->get();

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_indent_report',$userdata+compact('title','bank_list','transpoter_list','item_list','master_plant','master_series','master_pfct','master_emp','master_dept'));
        }else{

            return redirect('/useractivity');

        }

    }



    public function getDataFromQueryForm(Request $request){

        if($request->ajax()) {

             if (!empty($request->plantCodeOperator || $request->plantCodeValue || $request->seriesCodeOperator || $request->seriesCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->departmentOperator || $request->departmentValue || $request->employeeOperator || $request->employeeValue || $request->QtyOperator || $request->QtyValue || $request->OtherDetailsId || $request->OtherDetValueId || $request->item_code || $request->vr_num || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
                $vrseqNum     = $request->vr_num;
                $series_code  = $request->seriesCodeValue;

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeValue)!=""){
                   
                    $strWhere .= "AND  PINDENT_HEAD.PLANT_CODE $request->plantCodeOperator '$request->plantCodeValue'";
                } 


                if(isset($request->vr_num)  && trim($request->vr_num)!=""){
                    
                    $strWhere .= "AND  PINDENT_HEAD.VRNO = '$request->vr_num'";
                }

                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeValue)!=""){
                    
                    $strWhere .= "AND  PINDENT_HEAD.SERIES_CODE $request->seriesCodeOperator '$request->seriesCodeValue'";
                }

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterValue)!=""){
                    
                    $strWhere .= "AND  PINDENT_HEAD.PFCT_CODE $request->profitCenterOperator '$request->profitCenterValue'";
                }

                if(isset($request->departmentOperator)  && trim($request->departmentValue)!=""){
                    
                    $strWhere .= "AND  PINDENT_HEAD.DEPT_CODE $request->departmentOperator '$request->departmentValue'";
                }

                if(isset($request->employeeOperator)  && trim($request->employeeValue)!=""){
                    
                    $strWhere .= "AND  PINDENT_HEAD.EMP_CODE $request->employeeOperator '$request->employeeValue'";
                }

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    $strWhere .= "AND  PINDENT_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->QtyOperator)  && trim($request->QtyValue)!=""){
                    $strWhere .= "AND  PINDENT_BODY.QTYRECVD $request->QtyOperator '$request->QtyValue'";
                }
               
                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  PINDENT_HEAD.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

                if(isset($comp_code) && isset($macc_year)){
                  
                    $strWhere .= " AND  PINDENT_HEAD.COMP_CODE = '".$comp_code."' AND PINDENT_HEAD.FY_CODE = '".$macc_year."'";

                }

                //DB::enableQueryLog();

                if($request->ReportTypes == 'pending'){

                $data = DB::select("SELECT PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.VRDATE,PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.PLANT_CODE,PINDENT_HEAD.PARTYREFNO,PINDENT_HEAD.FY_CODE AS FYCODE,PINDENT_HEAD.VRNO AS VR_NO,PINDENT_HEAD.SERIES_CODE AS SERIESCODE,PINDENT_HEAD.PARTYREFDATE,PINDENT_BODY.* FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_HEAD.PINDHID = PINDENT_BODY.PINDHID WHERE 1=1 $strWhere AND PINDENT_BODY.PENQBID = '0' AND PINDENT_BODY.PENQHID = '0'");

                

                }else if($request->ReportTypes == 'complete'){

                    $data = DB::select("SELECT PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.VRDATE,PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.PLANT_CODE,PINDENT_HEAD.PARTYREFNO,PINDENT_HEAD.FY_CODE AS FYCODE,PINDENT_HEAD.VRNO AS VR_NO,PINDENT_HEAD.SERIES_CODE AS SERIESCODE,PINDENT_HEAD.PARTYREFDATE,PINDENT_BODY.* FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_HEAD.PINDHID = PINDENT_BODY.PINDHID WHERE 1=1 $strWhere AND PINDENT_BODY.PENQBID != '0' AND PINDENT_BODY.PENQHID != '0'");


                }else{

                    $data = DB::select("SELECT PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.VRDATE,PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.PLANT_CODE,PINDENT_HEAD.PARTYREFNO,PINDENT_HEAD.FY_CODE AS FYCODE,PINDENT_HEAD.VRNO AS VR_NO,PINDENT_HEAD.SERIES_CODE AS SERIESCODE,PINDENT_HEAD.PARTYREFDATE,PINDENT_BODY.* FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_HEAD.PINDHID = PINDENT_BODY.PINDHID WHERE 1=1 $strWhere");


                }

                //dd(DB::getQueryLog());
                $discriptn_page = "Search purchase indent report by user";
                $accountCd = '';
                $this->userLogInsert($loginUser,$vrseqNum,$series_code,$discriptn_page,$accountCd);  
                
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

    

    public function PurchaseIndentReportExcel(Request $request,$vrnum,$item_code,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$departmentOperator,$departmentValue,$employeeOperator,$employeeValue,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes){

            date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            $company_name = $request->session()->get('company_name');
            $getcomcode    = explode('-', $company_name);
            $comp_code = $getcomcode[0];
            $macc_year    = $request->session()->get('macc_year');

            $dt    = date("Y-m-d");
            $expd  = explode('-',$dt);
            $y     = $expd[0];
            $m     = $expd[1];
            $d     = $expd[2];
            $num   =  rand(10,10000);
            $fileName = 'PIR'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
            $vr_num               = $vrnum;


            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));
            $item_code            = $item_code;
            $plantCodeOperator    = $plantCodeOperator;
            $plantCodeValue       = $plantCodeValue;
            $seriesCodeOperator   = $seriesCodeOperator;
            $seriesCodeValue      = $seriesCodeValue;
            $profitCenterOperator = $profitCenterOperator;
            $profitCenterValue    = $profitCenterValue;
            $departmentOperator   = $departmentOperator;
            $departmentValue      = $departmentValue;
            $employeeOperator     = $employeeOperator;
            $employeeValue        = $employeeValue;
            $QtyOperator          = $QtyOperator;
            $QtyValue             = $QtyValue;
            $reportTypes          = $ReportTypes;

            

            public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new PurchaseIndentReportExport($vr_num,$from_date,$to_date,$item_code,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$departmentOperator,$departmentValue,$employeeOperator,$employeeValue,$QtyOperator,$QtyValue,$comp_code,$macc_year,$reportTypes),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

        

    }



    public function PurchaseEnqueryReport(Request $request){

        $title = "Purchase Enquery Report";

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);


        $userdata['enquery_list'] = DB::select("SELECT PENQ_HEAD.VRDATE, PENQ_BODY.* FROM PENQ_HEAD LEFT JOIN PENQ_BODY ON PENQ_HEAD.PENQHID  = PENQ_BODY.PENQHID GROUP BY PENQ_BODY.PENQHID");

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];
        $acc_list        = $functionData['transpoter_list'];

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        $master_dept     = DB::table('MASTER_DEPT')->get();

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_enquery_report',$userdata+compact('title','bank_list','transpoter_list','item_list','acc_list','master_plant','master_series','master_pfct','master_dept'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function PurchaseEnqueryReportExcel(Request $request,$from_date,$to_date,$item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCodeValue,$QtyOperator,$QtyValue){

            date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

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
            $fileName = 'PENQR'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
           
            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));
            $vr_num               = $vr_num;
            $item_code            = $item_code;
            $plantCodeOperator    = $plantCodeOperator;
            $plantCodeValue       = $plantCodeValue;
            $seriesCodeOperator   = $seriesCodeOperator;
            $seriesCodeValue      = $seriesCodeValue;
            $profitCenterOperator = $profitCenterOperator;
            $profitCenterValue    = $profitCenterValue;
            $accCodeOperator      = $accCodeOperator;
            $accCodeValue         = $accCodeValue;
            $QtyOperator          = $QtyOperator;
            $QtyValue             = $QtyValue;
           
            public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new PurchaseEnqueryReportExport($from_date,$to_date,$vr_num,$item_code,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCodeValue,$QtyOperator,$QtyValue,$comp_code,$macc_year),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);


    }


    public function getDataFromQueryFormPurchaseEnquery(Request $request){

        if($request->ajax()) {

            if (!empty($request->plantCodeOperator || $request->plantCodeValue || $request->seriesCodeOperator || $request->seriesCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->accCodeOperator || $request->accCodeValue || $request->QtyOperator || $request->QtyValue || $request->from_date || $request->to_date || $request->item_code || $request->vr_num)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
                $vrseqNum     = $request->vr_num;
                $series_code  = $request->seriesCodeValue;
                $accountCode  = $request->accCodeValue;

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeValue)!=""){
                   
                    $strWhere .= " AND  PENQ_HEAD.PLANT_CODE ".$request->plantCodeOperator." '".$request->plantCodeValue."'";
                } 

                
                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeValue)!=""){
                    
                    $strWhere .= " AND  PENQ_HEAD.SERIES_CODE ".$request->seriesCodeOperator." '".$request->seriesCodeValue."'";
                }

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterValue)!=""){
                    
                    $strWhere .= " AND  PENQ_BODY.SERIES_CODE ".$request->profitCenterOperator." '".$request->profitCenterValue."'";
                }

                if(isset($request->accCodeOperator)  && trim($request->accCodeValue)!=""){
                    $strWhere .= " AND  PENQ_BODY.ACC_CODE ".$request->accCodeOperator." '".$request->accCodeValue."'";
                }

                if(isset($request->QtyOperator)  && trim($request->QtyValue)!=""){
                    $strWhere .= " AND  PENQ_BODY.QTYRECD ".$request->QtyOperator." '".$request->QtyValue."'";
                }


                if(isset($request->item_code) && trim($request->item_code)!=""){
                   
                    $strWhere .= " AND  PENQ_BODY.ITEM_CODE = '".$request->item_code."'";
                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                  
                    $strWhere .= " AND  PENQ_HEAD.VRNO = '".$request->vr_num."'";

                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  PENQ_BODY.VRDATE BETWEEN '".$FromDt."' and  '".$ToDt."'";
                }

                if(isset($comp_code) && isset($macc_year)){
                  
                    $strWhere .= " AND  PENQ_HEAD.COMP_CODE = '".$comp_code."' AND PENQ_HEAD.FY_CODE = '".$macc_year."'";

                }

                //DB::enableQueryLog();

                if(isset($request->accCodeValue) && trim($request->accCodeValue)!=""){

                    //DB::enableQueryLog();
                  
                    $data = DB::select("SELECT PENQ_HEAD.PLANT_CODE,PENQ_HEAD.VRDATE,PENQ_HEAD.SERIES_CODE,PENQ_BODY.* FROM PENQ_HEAD LEFT JOIN PENQ_BODY ON PENQ_HEAD.PENQHID = PENQ_BODY.PENQHID LEFT JOIN PENQ_VENDOR ON PENQ_HEAD.PENQHID = PENQ_VENDOR.PENQHID AND PENQ_BODY.PENQBID = PENQ_VENDOR.PENQBID WHERE 1=1 $strWhere");

                    //dd(DB::getQueryLog());

                }else{

                    $data = DB::select("SELECT PENQ_HEAD.PLANT_CODE,PENQ_HEAD.VRDATE,PENQ_HEAD.SERIES_CODE,PENQ_BODY.* FROM PENQ_HEAD LEFT JOIN PENQ_BODY ON PENQ_HEAD.PENQHID = PENQ_BODY.PENQHID WHERE 1=1 $strWhere");

                }

                //dd(DB::getQueryLog());

                $discriptn_page = "Search purchase enquiry report by user";
                $this->userLogInsert($loginUser,$vrseqNum,$series_code,$discriptn_page,$accountCode);  
                
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


    public function GetVenderDataEnqueryReport(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $vrNo    = $request->input('vrNo');
            $HeadId  = $request->input('headid');
            $BodyId  = $request->input('bodyId');
            
            $fetch_reocrd = DB::table('PENQ_VENDOR')->where('VRNO',$vrNo)->where('PENQHID',$HeadId)->where('PENQBID',$BodyId)->get();


            if ($fetch_reocrd!='') {

                $response_array['response']    = 'success';
                $response_array['data']        = $fetch_reocrd;
                //$response_array['levelAmt']    = $levelAmt;

                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data']     = '' ;
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


    public function PurchaseQuotationReport(Request $request){

        $title = "Purchase Quotation Report";

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];
        $acc_list        = $functionData['transpoter_list'];
        $qc_list         = $functionData['qc_list'];
        $item_list       = $functionData['item_list'];

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_quotation_report',$userdata+compact('title','bank_list','transpoter_list','item_list','qc_list','item_list','master_plant','master_series','master_pfct','acc_list'));
        }else{

            return redirect('/useractivity');

        }

    }



public function PurchaseQuotationMonthlyReport(Request $request){

        $title = "Purchase Quotation Monthly Report";

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];
        $acc_list        = $functionData['transpoter_list'];
        $qc_list         = $functionData['qc_list'];
        $item_list       = $functionData['item_list'];

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_quotation_monthly_report',$userdata+compact('title','bank_list','transpoter_list','item_list','qc_list','item_list','master_plant','master_series','master_pfct','acc_list'));
        }else{

            return redirect('/useractivity');

        }

    }

public function PurchaseContractMonthlyReport(Request $request){

        $title = "Purchase Quotation Monthly Report";

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];
        $acc_list        = $functionData['transpoter_list'];
        $qc_list         = $functionData['qc_list'];
        $item_list       = $functionData['item_list'];

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_contract_monthly_report',$userdata+compact('title','bank_list','transpoter_list','item_list','qc_list','item_list','master_plant','master_series','master_pfct','acc_list'));
        }else{

            return redirect('/useractivity');

        }

    }


     public function getDataMonthlyPurchaseQuotation(Request $request){

        if($request->ajax()) {

            if (!empty($request->from_date || $request->to_date || $request->code)) {


                $loginUser = $request->session()->get('userid');

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  PQTN_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->acc_code) && trim($request->acc_code)!=""){
                    
                    $strWhere .= " AND  PQTN_HEAD.ACC_CODE = '$request->acc_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($request->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($request->from_date));
                  
                  $strWhere .= " AND  PQTN_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  PQTN_HEAD.COMP_CODE = '".$this->comp_code."' AND PQTN_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


                // print_r($request->post());exit;
                  if($request->code=='series code'){
                  //  DB::enableQueryLog();

                     $data = DB::select("SELECT  CONCAT(PQTN_BODY.SERIES_CODE,' - ',MASTER_CONFIG.SERIES_NAME) as SERIES_CODE,CONCAT(PQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PQTN_BODY.ITEM_CODE,' - ',PQTN_BODY.ITEM_NAME) as ITEM_CODE,PQTN_TAX_VIEW.* FROM PQTN_HEAD LEFT JOIN PQTN_BODY ON PQTN_HEAD.PQTNHID = PQTN_BODY.PQTNHID LEFT JOIN PQTN_TAX_VIEW ON PQTN_TAX_VIEW.PQTNBID = PQTN_BODY.PQTNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PQTN_HEAD.ACC_CODE LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE = PQTN_HEAD.SERIES_CODE WHERE 1=1 $strWhere GROUP BY PQTN_HEAD.SERIES_CODE");

                     //dd(DB::getQueryLog());

                  }else if($request->code=='acc code' || $request->code=='acc item code'){
                    $data = DB::select("SELECT  CONCAT(PQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PQTN_BODY.ITEM_CODE,' - ',PQTN_BODY.ITEM_NAME) as ITEM_CODE,PQTN_TAX_VIEW.* FROM PQTN_HEAD LEFT JOIN PQTN_BODY ON PQTN_HEAD.PQTNHID = PQTN_BODY.PQTNHID LEFT JOIN PQTN_TAX_VIEW ON PQTN_TAX_VIEW.PQTNBID = PQTN_BODY.PQTNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PQTN_HEAD.ACC_CODE");

                  }else if($request->code=='item code' || $request->code=='item code acc code'){

                    $data = DB::select("SELECT  CONCAT(PQTN_BODY.ITEM_CODE,' - ',PQTN_BODY.ITEM_NAME) as ITEM_CODE,CONCAT(PQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,PQTN_TAX_VIEW.* FROM PQTN_HEAD LEFT JOIN PQTN_BODY ON PQTN_HEAD.PQTNHID = PQTN_BODY.PQTNHID LEFT JOIN PQTN_TAX_VIEW ON PQTN_TAX_VIEW.PQTNBID = PQTN_BODY.PQTNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PQTN_BODY.ITEM_CODE");

                  }else if($request->code=='month' || $request->code=='acc item code month' || $request->code=='item acc code month'){

                    $data = DB::select("SELECT  CONCAT(PQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PQTN_BODY.ITEM_CODE,' - ',PQTN_BODY.ITEM_NAME) as ITEM_CODE,PQTN_MONTH_VIEW.* FROM PQTN_HEAD LEFT JOIN PQTN_BODY ON PQTN_HEAD.PQTNHID = PQTN_BODY.PQTNHID LEFT JOIN PQTN_MONTH_VIEW ON PQTN_MONTH_VIEW.ACC_CODE = PQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PQTN_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='item code month'){

                    $data = DB::select("SELECT CONCAT(PQTN_BODY.ITEM_CODE,' - ',PQTN_BODY.ITEM_NAME) as ITEM_CODE,PQTN_MONTH_VIEW.* FROM PQTN_HEAD LEFT JOIN PQTN_BODY ON PQTN_HEAD.PQTNHID = PQTN_BODY.PQTNHID LEFT JOIN PQTN_MONTH_VIEW ON PQTN_MONTH_VIEW.ACC_CODE = PQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PQTN_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='acc code month'){

                    $data = DB::select("SELECT CONCAT(PQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,PQTN_MONTH_VIEW.* FROM PQTN_HEAD LEFT JOIN PQTN_BODY ON PQTN_HEAD.PQTNHID = PQTN_BODY.PQTNHID LEFT JOIN PQTN_MONTH_VIEW ON PQTN_MONTH_VIEW.ACC_CODE = PQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PQTN_HEAD.ACC_CODE");
                  }else if($request->code=='tax code'){

                    $data = DB::select("SELECT PQTN_BODY.TAX_CODE,CONCAT(PQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PQTN_BODY.ITEM_CODE,' - ',PQTN_BODY.ITEM_NAME) as ITEM_CODE,PQTN_TAX_VIEW.* FROM PQTN_HEAD LEFT JOIN PQTN_BODY ON PQTN_HEAD.PQTNHID = PQTN_BODY.PQTNHID LEFT JOIN PQTN_TAX_VIEW ON PQTN_TAX_VIEW.PQTNBID = PQTN_BODY.PQTNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PQTN_BODY.TAX_CODE");
                  }else if($request->code=='cost code'){

                    $data = DB::select("SELECT PQTN_HEAD.COST_CENTER,CONCAT(PQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PQTN_BODY.ITEM_CODE,' - ',PQTN_BODY.ITEM_NAME) as ITEM_CODE,PQTN_TAX_VIEW.* FROM PQTN_HEAD LEFT JOIN PQTN_BODY ON PQTN_HEAD.PQTNHID = PQTN_BODY.PQTNHID LEFT JOIN PQTN_TAX_VIEW ON PQTN_TAX_VIEW.PQTNBID = PQTN_BODY.PQTNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PQTN_HEAD.COST_CENTER");
                  }else if($request->code=='date'){

                    $data = DB::select("SELECT PQTN_HEAD.VRDATE,CONCAT(PQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PQTN_BODY.ITEM_CODE,' - ',PQTN_BODY.ITEM_NAME) as ITEM_CODE,PQTN_TAX_VIEW.* FROM PQTN_HEAD LEFT JOIN PQTN_BODY ON PQTN_HEAD.PQTNHID = PQTN_BODY.PQTNHID LEFT JOIN PQTN_TAX_VIEW ON PQTN_TAX_VIEW.PQTNBID = PQTN_BODY.PQTNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PQTN_HEAD.VRDATE");
                  }

                 // print_r($data);exit;
                /*if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  purchase_quotation_head.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }*/

                //DB::enableQueryLog();tax_code


                   /* $data1 = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere");*/


                   /* $data = DB::select("SELECT MASTER_ACC.ACC_NAME,SQTN_BODY.ITEM_CODE,SQTN_BODY.ITEM_NAME, SALES_QTN_MONTH_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SALES_QTN_MONTH_VIEW ON SALES_QTN_MONTH_VIEW.ACC_CODE = SQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SALES_QTN_MONTH_VIEW.ACC_CODE");*/

                   /* echo '<pre>';

                    print_r($data);exit;

                    echo '</pre>';*/

                    
                  /*  $data = DB::select("SELECT SQTN_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,MASTER_ITEM.ITEM_NAME AS ITEM_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE LEFT JOIN MASTER_ITEM ON SQTN_BODY.ITEM_CODE = MASTER_ITEM.ITEM_CODE WHERE 1=1 $strWhere");*/

                //dd(DB::getQueryLog());


                  /*$newarray = array(
                            "data"            => $data,
                            "column"         => $columnName   
                        );

                echo json_encode($newarray);*/

               // echo json_encode($data);

              //  print_r($data);exit;

            $discriptn_page = "Search purchase quotation monthly report by user";
            $vrseqNum ='';
            $series_code ='';
            $accountCode ='';
            $this->userLogInsert($loginUser,$vrseqNum,$series_code,$discriptn_page,$accountCode); 
                    
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



    public function PurchaseQuotationMonthlyExcel(Request $request,$from_date,$to_date,$code){


            date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            $userId = $request->session()->get('userid');
            $company_name = $request->session()->get('company_name');
            $getcomcode    = explode('-', $company_name);
            $comp_code = $getcomcode[0];
            $macc_year    = $request->session()->get('macc_year');

            $dt    = date("Y-m-d");
            $expd  = explode('-',$dt);
            $y     = $expd[0];
            $m     = $expd[1];
            $d     = $expd[2];
            $num   =  rand(10,10000);
            $fileName = 'PQCR'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
            //$vr_num               = $vrnum;
          //  $item_code     = $item_code;

            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));

          
           /* if (isset($vr_num) && trim($seriesCodeOperator)!="" &&  $vr_num!='0') {

                    $exp = explode(" ",$vr_num);

                    $vr_num = $exp[2];

                }*/


             public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new PurchaseMonthlyQuotationExport($from_date,$to_date,$comp_code,$macc_year,$code),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }




    public function PurchaseQuotationReportExcel(Request $request,$item_code,$acct_code,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$type){


            date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            $userId       = $request->session()->get('userid');
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
            $fileName = 'PQCSR'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
            //$vr_num               = $vrnum;
            $item_code     = $item_code;

            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));
                     	

            public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new PurchaseQuotationReportExport($item_code,$acct_code,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$comp_code,$macc_year,$type),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }



    public function getDataFromQueryFormPurchaseQuotation(Request $request){

        if($request->ajax()) {

            if (!empty($request->plantCodeOperator || $request->plantCodeValue || $request->seriesCodeOperator || $request->seriesCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->QtyOperator || $request->QtyValue || $request->accCodeOperator || $request->accCode  || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
                $vrseqNum     = $request->vr_num;
                $series_code  = $request->seriesCodeValue;
                $accountCode  = $request->accCode;

                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeOperator)!=""){
                   
                    $strWhere .= " AND  PQCS_BODY.SERIES_CODE $request->seriesCodeOperator '$request->seriesCodeValue'";


                } 

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeOperator)!=""){
                   
                    $strWhere .= " AND  PQCS_HEAD.PLANT_CODE $request->plantCodeOperator '$request->plantCodeValue'";

                    
                } 

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterOperator)!=""){
                    
                    $strWhere .= " AND  PQCS_HEAD.PFCT_CODE $request->profitCenterOperator '$request->profitCenterValue'";
                }

                if(isset($request->QtyOperator)  && trim($request->QtyOperator)!=""){
                    
                    $strWhere .= " AND  PQCS_BODY.QTYRECD $request->QtyOperator '$request->QtyValue'";
                }

                if(isset($request->accCodeOperator)  && trim($request->accCodeOperator)!=""){
                    $strWhere .= " AND  PQCS_BODY.ACC_CODE $request->accCodeOperator '$request->accCode'";
                }

               
                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  PQCS_BODY.PQCSHID = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  PQCS_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }

                if(isset($comp_code) && isset($macc_year)){
                  
                    $strWhere .= " AND  PQCS_HEAD.COMP_CODE = '".$comp_code."' AND PQCS_HEAD.FY_CODE = '".$macc_year."'";

                }

                //DB::enableQueryLog();tax_code

                    // $data = DB::select("SELECT PQCS_HEAD.PQCSHID AS qcNo,PQCS_HEAD.RFQNO AS rfqNo,PQCS_HEAD.PQCSHID AS QcsHeadId, PQCS_BODY.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID WHERE 1=1 $strWhere");

                

                if($request->ReportTypes == 'pending'){

                    $data = DB::select("SELECT PQCS_HEAD.VRDATE,PQCS_HEAD.PFCT_CODE,PQCS_HEAD.PLANT_CODE,PQCS_HEAD.PQCSHID,PQCS_BODY.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID WHERE 1=1 $strWhere AND PQCS_BODY.PCNTRHID = 0 AND PQCS_BODY.PCNTRBID = 0");


                }else if($request->ReportTypes == 'complete'){

                    $data = DB::select("SELECT PQCS_HEAD.VRDATE,PQCS_HEAD.PFCT_CODE,PQCS_HEAD.PLANT_CODE,PQCS_HEAD.PQCSHID,PQCS_BODY.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID WHERE 1=1 $strWhere  AND PQCS_BODY.PCNTRHID != 0 AND PQCS_BODY.PCNTRBID != 0");


                }else{

                    $data = DB::select("SELECT PQCS_HEAD.VRDATE,PQCS_HEAD.PFCT_CODE,PQCS_HEAD.PLANT_CODE,PQCS_HEAD.PQCSHID,PQCS_BODY.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID WHERE 1=1 $strWhere");


                }

                //dd(DB::getQueryLog());

                $discriptn_page = "Search purchase quotation report by user";
                $this->userLogInsert($loginUser,$vrseqNum,$series_code,$discriptn_page,$accountCode);
                
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


    public function GetCalTaxDataEnqueryReports(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $HeadId  = $request->input('headid');
            $BodyId  = $request->input('bodyId');
            
            $fetch_reocrd = DB::table('PQTN_TAX')->where('PQTNHID',$HeadId)->where('PQTNBID',$BodyId)->get();

            $fetch_reocrd1 = DB::table('PQTN_HEAD')->where('PQTNHID',$HeadId)->get();


            if ($fetch_reocrd!='') {

                $response_array['response']    = 'success';
                $response_array['data']        = $fetch_reocrd;
                $response_array['tax_code']    = $fetch_reocrd1;

                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data']     = '' ;
                $response_array['tax_code']    = '';
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


    public function GetQuaParDataEnqueryReports(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $HeadId  = $request->input('headid');
            $BodyId  = $request->input('bodyId');
            
            $fetch_reocrd = DB::table('purchase_quotation_qua')->where('purchase_quotation_head',$HeadId)->where('purchase_quotation_body',$BodyId)->get();


            if ($fetch_reocrd!='') {

                $response_array['response']    = 'success';
                $response_array['data']        = $fetch_reocrd;
                //$response_array['levelAmt']    = $levelAmt;

                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data']     = '' ;
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

    public function PurchaseContractReport(Request $request){


        $title = "Purchase Contract Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $userdata['contract_list'] = DB::select("SELECT PCNTR_HEAD.VRDATE,PCNTR_HEAD.PREFNO,PCNTR_HEAD.PREFDATE,PCNTR_BODY.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID GROUP BY PCNTR_BODY.PCNTRHID");

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $item_list       = $functionData['item_list'];
        $acc_list        = $functionData['transpoter_list'];
        
        $vr_list       = DB::table('PCNTR_HEAD')->get()->toArray();

        $master_plant  = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct   = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        $master_cost   = DB::table('MASTER_COST')->get();
        

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_contract_report',$userdata+compact('title','item_list','acc_list','master_plant','master_series','master_pfct','master_cost','vr_list'));
        }else{

            return redirect('/useractivity');

        }



    }



    public function getDataMonthlyPurchaseContract(Request $request){

        if($request->ajax()) {

            if (!empty($request->from_date || $request->to_date || $request->code)) {


         

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  PCNTR_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->acc_code) && trim($request->acc_code)!=""){
                    
                    $strWhere .= " AND  PCNTR_HEAD.ACC_CODE = '$request->acc_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($request->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($request->from_date));
                  
                  $strWhere .= " AND  PCNTR_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  PCNTR_HEAD.COMP_CODE = '".$this->comp_code."' AND PCNTR_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


                // print_r($request->post());exit;
                  if($request->code=='series code'){
                  //  DB::enableQueryLog();

                     $data = DB::select("SELECT  CONCAT(PCNTR_BODY.SERIES_CODE,' - ',MASTER_CONFIG.SERIES_NAME) as SERIES_CODE,CONCAT(PCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PCNTR_BODY.ITEM_CODE,' - ',PCNTR_BODY.ITEM_NAME) as ITEM_CODE,PCNTR_TAX_VIEW.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN PCNTR_TAX_VIEW ON PCNTR_TAX_VIEW.PCNTRBID = PCNTR_BODY.PCNTRBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PCNTR_HEAD.ACC_CODE LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE = PCNTR_HEAD.SERIES_CODE WHERE 1=1 $strWhere GROUP BY PCNTR_HEAD.SERIES_CODE");

                     //dd(DB::getQueryLog());

                  }else if($request->code=='acc code' || $request->code=='acc item code'){
                    $data = DB::select("SELECT  CONCAT(PCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PCNTR_BODY.ITEM_CODE,' - ',PCNTR_BODY.ITEM_NAME) as ITEM_CODE,PCNTR_TAX_VIEW.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN PCNTR_TAX_VIEW ON PCNTR_TAX_VIEW.PCNTRBID = PCNTR_BODY.PCNTRBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PCNTR_HEAD.ACC_CODE");

                  }else if($request->code=='item code' || $request->code=='item code acc code'){

                    $data = DB::select("SELECT  CONCAT(PCNTR_BODY.ITEM_CODE,' - ',PCNTR_BODY.ITEM_NAME) as ITEM_CODE,CONCAT(PCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,PCNTR_TAX_VIEW.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN PCNTR_TAX_VIEW ON PCNTR_TAX_VIEW.PCNTRBID = PCNTR_BODY.PCNTRBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PCNTR_BODY.ITEM_CODE");

                  }else if($request->code=='month' || $request->code=='acc item code month' || $request->code=='item acc code month'){

                    $data = DB::select("SELECT  CONCAT(PCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PCNTR_BODY.ITEM_CODE,' - ',PCNTR_BODY.ITEM_NAME) as ITEM_CODE,PCNTR_MONTH_VIEW.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN PCNTR_MONTH_VIEW ON PCNTR_MONTH_VIEW.ACC_CODE = PCNTR_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PCNTR_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='item code month'){

                    $data = DB::select("SELECT CONCAT(PCNTR_BODY.ITEM_CODE,' - ',PCNTR_BODY.ITEM_NAME) as ITEM_CODE,PCNTR_MONTH_VIEW.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN PCNTR_MONTH_VIEW ON PCNTR_MONTH_VIEW.ACC_CODE = PCNTR_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PCNTR_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='acc code month'){

                    $data = DB::select("SELECT CONCAT(PCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,PCNTR_MONTH_VIEW.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN PCNTR_MONTH_VIEW ON PCNTR_MONTH_VIEW.ACC_CODE = PCNTR_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PCNTR_HEAD.ACC_CODE");
                  }else if($request->code=='tax code'){

                    $data = DB::select("SELECT PCNTR_BODY.TAX_CODE,CONCAT(PCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PCNTR_BODY.ITEM_CODE,' - ',PCNTR_BODY.ITEM_NAME) as ITEM_CODE,PCNTR_TAX_VIEW.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN PCNTR_TAX_VIEW ON PCNTR_TAX_VIEW.PCNTRBID = PCNTR_BODY.PCNTRBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PCNTR_BODY.TAX_CODE");
                  }else if($request->code=='cost code'){

                    $data = DB::select("SELECT PCNTR_HEAD.COST_CENTER,CONCAT(PCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PCNTR_BODY.ITEM_CODE,' - ',PCNTR_BODY.ITEM_NAME) as ITEM_CODE,PCNTR_TAX_VIEW.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN PCNTR_TAX_VIEW ON PCNTR_TAX_VIEW.PCNTRBID = PCNTR_BODY.PCNTRBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PCNTR_HEAD.COST_CENTER");
                  }else if($request->code=='date'){

                    $data = DB::select("SELECT PCNTR_HEAD.VRDATE,CONCAT(PCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PCNTR_BODY.ITEM_CODE,' - ',PCNTR_BODY.ITEM_NAME) as ITEM_CODE,PCNTR_TAX_VIEW.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN PCNTR_TAX_VIEW ON PCNTR_TAX_VIEW.PCNTRBID = PCNTR_BODY.PCNTRBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PCNTR_HEAD.VRDATE");
                  }

                 // print_r($data);exit;
                /*if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  purchase_quotation_head.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }*/

                //DB::enableQueryLog();tax_code


                   /* $data1 = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere");*/


                   /* $data = DB::select("SELECT MASTER_ACC.ACC_NAME,SQTN_BODY.ITEM_CODE,SQTN_BODY.ITEM_NAME, SALES_QTN_MONTH_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SALES_QTN_MONTH_VIEW ON SALES_QTN_MONTH_VIEW.ACC_CODE = SQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SALES_QTN_MONTH_VIEW.ACC_CODE");*/

                   /* echo '<pre>';

                    print_r($data);exit;

                    echo '</pre>';*/

                    
                  /*  $data = DB::select("SELECT SQTN_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,MASTER_ITEM.ITEM_NAME AS ITEM_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE LEFT JOIN MASTER_ITEM ON SQTN_BODY.ITEM_CODE = MASTER_ITEM.ITEM_CODE WHERE 1=1 $strWhere");*/

                //dd(DB::getQueryLog());


                  /*$newarray = array(
                            "data"            => $data,
                            "column"         => $columnName   
                        );

                echo json_encode($newarray);*/

               // echo json_encode($data);

              //  print_r($data);exit;


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


    public function PurchaseContractMonthlyExcel(Request $request,$from_date,$to_date,$code){


            date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            $userId = $request->session()->get('userid');
            $company_name = $request->session()->get('company_name');
            $getcomcode    = explode('-', $company_name);
            $comp_code = $getcomcode[0];
            $macc_year    = $request->session()->get('macc_year');

            $dt    = date("Y-m-d");
            $expd  = explode('-',$dt);
            $y     = $expd[0];
            $m     = $expd[1];
            $d     = $expd[2];
            $num   =  rand(10,10000);
            $fileName = 'PQCR'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
            //$vr_num               = $vrnum;
          //  $item_code     = $item_code;

            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));

          
           /* if (isset($vr_num) && trim($seriesCodeOperator)!="" &&  $vr_num!='0') {

                    $exp = explode(" ",$vr_num);

                    $vr_num = $exp[2];

                }*/


             public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new PurchaseMonthlyContractExport($from_date,$to_date,$comp_code,$macc_year,$code),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }



    public function purchaseContractDemo(Request $request){


        $title = "Purchase Contract Demo";
        $company_name  = $request->session()->get('company_name');

               define("field_key", "field_key");

            DB::raw('SET @sql = NULL');
            DB::table('Meeting')->selectRaw("GROUP_CONCAT(DISTINCT CONCAT('MAX(CASE WHEN field_key = "," field_key", " THEN field_value END)', field_key))
                        INTO @sql")->get();
            $GetData = DB::selectOne('select @sql')->{'@sql'};
            DB::select('Meeting', DB::raw('Meeting_id'))
                ->selectRaw($data1)
                ->groupBy('PCNTR_BODY.PCNTRBID')
                ->get();

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_contract_demo',compact('GetData'));
        }else{

            return redirect('/useractivity');

        }



    }


    public function getDataFromQueryFormPurchaseContract(Request $request){

        if($request->ajax()) {

            if (!empty($request->seriesCodeOperator || $request->seriesCodeValue || $request->plantCodeOperator || $request->plantCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->accCodeOperator || $request->accCode || $request->costCetOperator || $request->costCetCode || $request->QtyOperator || $request->QtyValue || $request->from_date || $request->to_date || $request->item_code || $request->vr_num | $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                $loginUser   = $request->session()->get('userid');
                $vrseqNum    = $request->vr_num;
                $series_code = $request->seriesCodeValue;
                $accountCode = $request->accCode;
                
                $strWhere = '';

                $ContractVrno = $request->vr_num;

                if (isset($ContractVrno)) {

                    $exp = explode(" ",$ContractVrno);

                    $ContractVrno = $exp[2];

                }else{
                    $ContractVrno ='';
                }

                //print_r($ContractVrno);

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeValue)!=""){
                   
                    $strWhere .= " AND  PCNTR_HEAD.PLANT_CODE ".$request->plantCodeOperator." '".$request->plantCodeValue."'";
                } 


                if(isset($ContractVrno)  && trim($ContractVrno)!=""){
                    
                    $strWhere .= " AND  PCNTR_HEAD.VRNO = '".$ContractVrno."'";
                }

                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeValue)!=""){
                    
                    $strWhere .= " AND  PCNTR_HEAD.SERIES_CODE ".$request->seriesCodeOperator." '".$request->seriesCodeValue."'";
                }

                if(isset($request->accCodeOperator)  && trim($request->accCode)!=""){
                    $strWhere .= " AND  PCNTR_BODY.ACC_CODE ".$request->accCodeOperator." '".$request->accCode."'";
                }

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterValue)!=""){
                    $strWhere .= " AND  PCNTR_BODY.PFCT_CODE ".$request->profitCenterOperator." '".$request->profitCenterValue."'";
                }

                if(isset($request->costCetOperator)  && trim($request->costCetCode)!=""){
                    $strWhere .= " AND  PCNTR_BODY.COST_CENTER ".$request->costCetOperator." '".$request->costCetCode."'";
                }


                if(isset($request->QtyOperator) && trim($request->QtyValue)!=""){
                   
                    $strWhere .= " AND  PCNTR_BODY.QTYRECD ".$request->QtyOperator." '".$request->QtyValue."'";
                }

                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  PCNTR_BODY.ITEM_CODE = '".$request->item_code."'";

                }


                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  PCNTR_BODY.VRDATE BETWEEN '".$FromDt."' and  '".$ToDt."'";
                }

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');

                if(isset($comp_code) && isset($macc_year)){
                  
                    $strWhere .= " AND  PCNTR_HEAD.COMP_CODE = '".$comp_code."' AND PCNTR_HEAD.FY_CODE = '".$macc_year."'";

                }

                //DB::enableQueryLog();

                if($request->ReportTypes == 'pending'){
                  
                    $data = DB::select("SELECT PCNTR_HEAD.PLANT_CODE AS plantCode,PCNTR_HEAD.VRNO,PCNTR_HEAD.SERIES_CODE AS seriesCode,PCNTR_HEAD.PREFNO,PCNTR_HEAD.PREFDATE,PCNTR_HEAD.ACC_CODE AS accCode,PCNTR_HEAD.PFCT_CODE AS pfctCode,PCNTR_BODY.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID WHERE 1=1 $strWhere AND PCNTR_BODY.PORDERHID=0 AND PCNTR_BODY.PORDERBID=0");

               
                }else if($request->ReportTypes == 'complete'){

                    $data = DB::select("SELECT PCNTR_HEAD.PLANT_CODE AS plantCode,PCNTR_HEAD.VRNO,PCNTR_HEAD.SERIES_CODE AS seriesCode,PCNTR_HEAD.PREFNO,PCNTR_HEAD.PREFDATE,PCNTR_HEAD.ACC_CODE AS accCode,PCNTR_HEAD.PFCT_CODE AS pfctCode,PCNTR_BODY.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID WHERE 1=1 $strWhere AND PCNTR_BODY.PORDERHID != 0 AND PCNTR_BODY.PORDERBID != 0");

                }else{

                    $data = DB::select("SELECT PCNTR_HEAD.PLANT_CODE AS plantCode,PCNTR_HEAD.VRNO,PCNTR_HEAD.SERIES_CODE AS seriesCode,PCNTR_HEAD.PREFNO,PCNTR_HEAD.PREFDATE,PCNTR_HEAD.ACC_CODE AS accCode,PCNTR_HEAD.PFCT_CODE AS pfctCode,PCNTR_BODY.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID WHERE 1=1 $strWhere");
                }

                //dd(DB::getQueryLog());

                $discriptn_page = "Search purchase contract report by user";
                $this->userLogInsert($loginUser,$ContractVrno,$series_code,$discriptn_page,$accountCode);
                    

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

    public function PurchaseContractReportExcel(Request $request,$from_date,$to_date,$vrn,$item_code,$seriesCodeOperator,$seriesCodeValue,$plantCodeOperator,$plantCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$costCetOperator,$costCetCode,$QtyOperator,$QtyValue,$ReportTypes,$type){

            date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            $userId       = $request->session()->get('userid');
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
            $fileName = 'PCNTR'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
            
            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));
       

            public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new PurchaseContractReportExport($from_date,$to_date,$vrn,$item_code,$seriesCodeOperator,$seriesCodeValue,$plantCodeOperator,$plantCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$costCetOperator,$costCetCode,$QtyOperator,$QtyValue,$ReportTypes,$comp_code,$macc_year,$type),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }

public function GetQuaParDataOrderReports(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $HeadId  = $request->input('headid');
            $BodyId  = $request->input('bodyId');
            
            
            $fetch_reocrd = DB::table('PORDER_QUA')->where('PORDERHID',$HeadId)->where('PORDERBID',$BodyId)->get();
                

            if ($fetch_reocrd!='') {

                $response_array['response']    = 'success';
                $response_array['data']        = $fetch_reocrd;
                //$response_array['levelAmt']    = $levelAmt;

                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data']     = '' ;
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

    public function get_contrapdf_data(Request $request){

        $response_array = array();

        /*if ($request->ajax()) {


            $acct_code = $request->input('acct_code');
            $strWhere='';
            if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                $strWhere .= " AND  contract_head.acc_code = '$request->acct_code'";
            }

            $pdfdata = DB::select("SELECT contract_head.plant_code AS plantCode,contract_head.vr_date,contract_head.series_code AS seriesCode,contract_head.partyref_no,contract_head.partyref_date,contract_head.acc_code AS accCode,contract_head.pfct_code AS pfctCode,contract_body.* FROM contract_head LEFT JOIN contract_body ON contract_head.id = contract_body.contract_head_id WHERE 1=1 $strWhere");

            if($pdfdata) {

                $response_array['response'] = 'success';
                $response_array['data'] = $pdfdata;

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
        }*/


        $filename = 'download.pdf';

        $mpdf  = new \Mpdf\Mpdf();
        $html  = view('admin.finance.report.purchase.purchase_contrPdf');
        $html  = $html->render();
        $mpdf->SetHeader('chapter 1');
        $mpdf->SetFooter('Footer');
        /*for load css file*/
            //$stylesheet = file_get_contents(url('/css/mpdf.css'));
            //$mpdf->WriteHTML($stylesheet, 1);
        /*for load css file*/
        $mpdf->WriteHTML($html);
        $mpdf->Output($filename,'I');   

    }



      public function PurchaseOrderReport(Request $request){


        $title = "Purchase Order Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];
        $acc_list        = $functionData['transpoter_list'];
        

        $userdata['order_list'] = DB::select("SELECT PORDER_HEAD.VRNO,PORDER_HEAD.PREFNO,PORDER_HEAD.PREFDATE,PORDER_BODY.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID GROUP BY PORDER_BODY.PORDERHID");

        $vr_list       = DB::table('PORDER_HEAD')->get()->toArray();

        $master_plant  = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct   = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        $master_cost   = DB::table('MASTER_COST')->get();


        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_order_report',$userdata+compact('title','bank_list','transpoter_list','item_list','acc_list','vr_list','master_plant','master_series','master_pfct','master_cost'));
        }else{

            return redirect('/useractivity');

        }



    }



 public function getDataFromQueryFormPurchaseOrder(Request $request){


        if($request->ajax()) {

            if (!empty($request->seriesCodeOperator || $request->seriesCodeValue || $request->plantCodeOperator || $request->plantCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->accCodeOperator || $request->accCode || $request->costCetOperator || $request->costCetCode || $request->QtyOperator || $request->QtyValue || $request->from_date || $request->to_date || $request->item_code || $request->vr_num || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
                $vrseqNum     = $request->vr_num;
                $series_code  = $request->seriesCodeValue;
                $accountCode  = $request->accCode;
                
                $strWhere = '';

                $OrderVrno = $request->vr_num;

                if (isset($OrderVrno)) {

                    $exp = explode(" ",$OrderVrno);

                    $OrderVrno = $exp[2];

                }else{
                    $OrderVrno='';
                }

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeValue)!=""){
                   
                    $strWhere .= " AND  PORDER_BODY.PLANT_CODE ".$request->plantCodeOperator." '".$request->plantCodeValue."'";
                } 


                if(isset($request->vr_num)  && trim($OrderVrno)!=""){
                    
                    $strWhere .= " AND  PORDER_HEAD.VRNO = '".$OrderVrno."'";
                }

                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeValue)!=""){
                    
                    $strWhere .= " AND  PORDER_HEAD.SERIES_CODE ".$request->seriesCodeOperator." '".$request->seriesCodeValue."'";
                }

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterValue)!=""){
                    
                    $strWhere .= " AND  PORDER_HEAD.PFCT_CODE ".$request->profitCenterOperator." '".$request->profitCenterValue."'";
                }

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    $strWhere .= " AND  PORDER_BODY.ITEM_CODE = '".$request->item_code."'";
                }

                if(isset($request->QtyOperator)  && trim($request->QtyValue)!=""){
                    $strWhere .= " AND  PORDER_BODY.QTYRECD ".$request->QtyOperator." '".$request->QtyValue."'";
                }


                if(isset($request->costCetOperator) && trim($request->costCetCode)!=""){
                   
                    $strWhere .= " AND  PORDER_HEAD.COST_CENTER ".$request->costCetOperator." '".$request->costCetCode."'";
                }

                if(isset($request->accCodeOperator) && trim($request->accCode)!=""){
                  
                    $strWhere .= " AND  PORDER_HEAD.ACC_CODE ".$request->accCodeOperator." '".$request->accCode."'";

                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  PORDER_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

                if(isset($comp_code) && isset($macc_year)){
                  
                    $strWhere .= " AND  PORDER_HEAD.COMP_CODE = '".$comp_code."' AND PORDER_HEAD.FY_CODE = '".$macc_year."'";

                }

                //DB::enableQueryLog();

                if($request->ReportTypes == 'pending'){

                 $data = DB::select("SELECT PORDER_BODY.PLANT_CODE AS PLANT_CODE,PORDER_HEAD.VRDATE,PORDER_HEAD.SERIES_CODE AS SERIES_CODE,PORDER_HEAD.PREFNO,PORDER_HEAD.PREFDATE,PORDER_HEAD.ACC_CODE AS ACC_CODE,PORDER_HEAD.PFCT_CODE AS PFCT_CODE,PORDER_BODY.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID  WHERE 1=1 $strWhere AND PORDER_BODY.GRNHID = 0 AND PORDER_BODY.GRNBID = 0");


                }else if($request->ReportTypes == 'complete'){

                    $data = DB::select("SELECT PORDER_BODY.PLANT_CODE AS PLANT_CODE,PORDER_HEAD.VRDATE,PORDER_HEAD.SERIES_CODE AS SERIES_CODE,PORDER_HEAD.PREFNO,PORDER_HEAD.PREFDATE,PORDER_HEAD.ACC_CODE AS ACC_CODE,PORDER_HEAD.PFCT_CODE AS PFCT_CODE,PORDER_BODY.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID WHERE 1=1 $strWhere AND PORDER_BODY.GRNHID != 0 AND PORDER_BODY.GRNBID != 0");

                }else{

                    $data = DB::select("SELECT PORDER_BODY.PLANT_CODE AS PLANT_CODE,PORDER_HEAD.VRDATE,PORDER_HEAD.SERIES_CODE AS SERIES_CODE,PORDER_HEAD.PREFNO,PORDER_HEAD.PREFDATE,PORDER_HEAD.ACC_CODE AS ACC_CODE,PORDER_HEAD.PFCT_CODE AS PFCT_CODE,PORDER_BODY.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID WHERE 1=1 $strWhere");

                }

                //dd(DB::getQueryLog());

                $discriptn_page = "Search purchase order report by user";
                $this->userLogInsert($loginUser,$OrderVrno,$series_code,$discriptn_page,$accountCode);
               
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

     public function PurchaseOrderReportExcel(Request $request,$from_date,$to_date,$vrn,$item_code,$seriesCodeOperator,$seriesCodeValue,$plantCodeOperator,$plantCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$costCetOperator,$costCetCode,$QtyOperator,$QtyValue,$ReportTypes,$type){

            date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            $userId       = $request->session()->get('userid');
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
            $fileName = 'PORDER'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
            
            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));
       

            public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new PurchaseOrderReportExport($from_date,$to_date,$vrn,$item_code,$seriesCodeOperator,$seriesCodeValue,$plantCodeOperator,$plantCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$costCetOperator,$costCetCode,$QtyOperator,$QtyValue,$ReportTypes,$comp_code,$macc_year,$type),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);
        
    }



public function PurchaseOrderMonthlyReport(Request $request){

        $title = "Purchase Order Monthly Report";

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];
        $acc_list        = $functionData['transpoter_list'];
        $qc_list         = $functionData['qc_list'];
        $item_list       = $functionData['item_list'];

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_order_monthly_report',$userdata+compact('title','bank_list','transpoter_list','item_list','qc_list','item_list','master_plant','master_series','master_pfct','acc_list'));
        }else{

            return redirect('/useractivity');

        }

    }



 public function getDataMonthlyPurchaseOrder(Request $request){

        if($request->ajax()) {

            if (!empty($request->from_date || $request->to_date || $request->code)) {


         

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  PORDER_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->acc_code) && trim($request->acc_code)!=""){
                    
                    $strWhere .= " AND  PORDER_HEAD.ACC_CODE = '$request->acc_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($request->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($request->from_date));
                  
                  $strWhere .= " AND  PORDER_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  PORDER_HEAD.COMP_CODE = '".$this->comp_code."' AND PORDER_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


                // print_r($request->post());exit;
                  if($request->code=='series code'){
                  //  DB::enableQueryLog();

                     $data = DB::select("SELECT  CONCAT(PORDER_BODY.SERIES_CODE,' - ',MASTER_CONFIG.SERIES_NAME) as SERIES_CODE,CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN PORDER_TAX_VIEW ON PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE = PORDER_HEAD.SERIES_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.SERIES_CODE");

                     //dd(DB::getQueryLog());

                  }else if($request->code=='acc code' || $request->code=='acc item code'){
                    $data = DB::select("SELECT  CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN     PORDER_TAX_VIEW ON  PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.ACC_CODE");

                  }else if($request->code=='item code' || $request->code=='item code acc code'){

                    $data = DB::select("SELECT  CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN     PORDER_TAX_VIEW ON  PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_BODY.ITEM_CODE");

                  }else if($request->code=='month' || $request->code=='acc item code month' || $request->code=='item acc code month'){

                    $data = DB::select("SELECT  CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,PORDER_MONTH_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN    PORDER_MONTH_VIEW ON    PORDER_MONTH_VIEW.ACC_CODE = PORDER_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='item code month'){

                    $data = DB::select("SELECT CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,  PORDER_MONTH_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN    PORDER_MONTH_VIEW ON PORDER_MONTH_VIEW.ACC_CODE = PORDER_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='acc code month'){

                    $data = DB::select("SELECT CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,PORDER_MONTH_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN    PORDER_MONTH_VIEW ON    PORDER_MONTH_VIEW.ACC_CODE = PORDER_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.ACC_CODE");
                  }else if($request->code=='tax code'){

                    $data = DB::select("SELECT PORDER_BODY.TAX_CODE,CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,  PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN     PORDER_TAX_VIEW ON  PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_BODY.TAX_CODE");
                  }else if($request->code=='cost code'){

                    $data = DB::select("SELECT PORDER_HEAD.COST_CENTER,CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,   PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN  PORDER_TAX_VIEW ON   PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.COST_CENTER");
                  }else if($request->code=='date'){

                    $data = DB::select("SELECT PORDER_HEAD.VRDATE,CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,    PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN   PORDER_TAX_VIEW ON   PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.VRDATE");
                  }

                 // print_r($data);exit;
                /*if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  purchase_quotation_head.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }*/

                //DB::enableQueryLog();tax_code


                   /* $data1 = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere");*/


                   /* $data = DB::select("SELECT MASTER_ACC.ACC_NAME,SQTN_BODY.ITEM_CODE,SQTN_BODY.ITEM_NAME, SALES_QTN_MONTH_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SALES_QTN_MONTH_VIEW ON SALES_QTN_MONTH_VIEW.ACC_CODE = SQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SALES_QTN_MONTH_VIEW.ACC_CODE");*/

                   /* echo '<pre>';

                    print_r($data);exit;

                    echo '</pre>';*/

                    
                  /*  $data = DB::select("SELECT SQTN_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,MASTER_ITEM.ITEM_NAME AS ITEM_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE LEFT JOIN MASTER_ITEM ON SQTN_BODY.ITEM_CODE = MASTER_ITEM.ITEM_CODE WHERE 1=1 $strWhere");*/

                //dd(DB::getQueryLog());


                  /*$newarray = array(
                            "data"            => $data,
                            "column"         => $columnName   
                        );

                echo json_encode($newarray);*/

               // echo json_encode($data);

              //  print_r($data);exit;


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



    public function PurchaseOrderMonthlyExcel(Request $request,$from_date,$to_date,$code){


            date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            $userId = $request->session()->get('userid');
            $company_name = $request->session()->get('company_name');
            $getcomcode    = explode('-', $company_name);
            $comp_code = $getcomcode[0];
            $macc_year    = $request->session()->get('macc_year');

            $dt    = date("Y-m-d");
            $expd  = explode('-',$dt);
            $y     = $expd[0];
            $m     = $expd[1];
            $d     = $expd[2];
            $num   =  rand(10,10000);
            $fileName = 'PQCR'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
            //$vr_num               = $vrnum;
          //  $item_code     = $item_code;

            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));

          
           /* if (isset($vr_num) && trim($seriesCodeOperator)!="" &&  $vr_num!='0') {

                    $exp = explode(" ",$vr_num);

                    $vr_num = $exp[2];

                }*/


             public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new PurchaseMonthlyOrderExport($from_date,$to_date,$comp_code,$macc_year,$code),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }



    public function PurchaseGrnReport(Request $request){


        $title = "Purchase Order Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];
        $acc_list        = $functionData['transpoter_list'];


        $userdata['grn_list'] = DB::select("SELECT GRN_HEAD.VRDATE,GRN_HEAD.PREFNO,GRN_HEAD.PREFDATE,GRN_BODY.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID  GROUP BY GRN_BODY.GRNHID");

        $vr_list       = DB::table('PORDER_HEAD')->get()->toArray();

        $master_plant  = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct   = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        $master_cost   = DB::table('MASTER_COST')->get();

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_grn_report',$userdata+compact('title','transpoter_list','item_list','acc_list','vr_list','master_plant','master_series','master_pfct','master_cost'));
        }else{

            return redirect('/useractivity');

        }



    }


    public function getDataFromQueryFormGrn(Request $request){

            if (!empty($request->seriesCodeOperator || $request->seriesCodeValue || $request->plantCodeOperator || $request->plantCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->accCodeOperator || $request->accCode || $request->costCetOperator || $request->costCetCode || $request->QtyOperator || $request->QtyValue || $request->from_date || $request->to_date || $request->item_code || $request->vr_num || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
                $vrseqNum     = $request->vr_num;
                $series_code  = $request->seriesCodeValue;
                $accountCode  = $request->accCode;
                
                $strWhere = '';

                $GrnVrno = $request->vr_num;

                if (isset($GrnVrno)) {

                    $exp = explode(" ",$GrnVrno);

                    $GrnVrno = $exp[2];

                }else{
                    $GrnVrno ='';
                }

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeValue)!=""){
                   
                    $strWhere .= " AND  GRN_BODY.PLANT_CODE ".$request->plantCodeOperator." '".$request->plantCodeValue."'";
                } 

                if(isset($request->vr_num)  && trim($GrnVrno)!=""){
                    
                    $strWhere .= " AND  GRN_HEAD.VRNO = '".$GrnVrno."'";
                }

                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeValue)!=""){
                    
                    $strWhere .= " AND  GRN_HEAD.SERIES_CODE ".$request->seriesCodeOperator." '".$request->seriesCodeValue."'";
                }

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterValue)!=""){
                    
                    $strWhere .= " AND  GRN_HEAD.PFCT_CODE ".$request->profitCenterOperator." '".$request->profitCenterValue."'";
                }

                if(isset($request->costCetOperator)  && trim($request->costCetCode)!=""){
                    
                    $strWhere .= " AND  GRN_HEAD.COST_CENTER ".$request->costCetOperator." '".$request->costCetCode."'";
                }

                if(isset($request->accCodeOperator) && trim($request->accCode)!=""){
                  
                    $strWhere .= " AND  GRN_HEAD.ACC_CODE ".$request->accCodeOperator." '".$request->accCode."'";

                }

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    $strWhere .= " AND  GRN_BODY.ITEM_CODE = '".$request->item_code."'";
                }

                if(isset($request->QtyOperator)  && trim($request->QtyValue)!=""){
                    $strWhere .= " AND  GRN_BODY.QTYRECED ".$request->QtyOperator." '".$request->QtyValue."'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  GRN_BODY.VRDATE BETWEEN '".$FromDt."' and  '".$ToDt."'";
                }


                if(isset($comp_code) && isset($macc_year)){
                  
                    $strWhere .= " AND  GRN_HEAD.COMP_CODE = '".$comp_code."' AND GRN_HEAD.FY_CODE = '".$macc_year."'";

                }

                

               // print_r($request->post());exit;
               
                //DB::enableQueryLog();

                if($request->ReportTypes == 'pending'){

                 $data = DB::select("SELECT GRN_HEAD.VRDATE,GRN_HEAD.VRNO,GRN_HEAD.TRAN_CODE,GRN_HEAD.SERIES_CODE,GRN_HEAD.PLANT_CODE,GRN_HEAD.PFCT_CODE,GRN_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME,GRN_BODY.ITEM_CODE,GRN_BODY.ITEM_NAME,GRN_BODY.QTYRECED,GRN_BODY.UM_CODE,GRN_BODY.AQTYRECD,GRN_BODY.AUM_CODE,if(GRN_BODY.PBILLHID = '0' && GRN_BODY.PBILLBID = '0','Pending',' '),GRN_BODY.TAX_CODE,GRN_TAX_VIEW.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN GRN_TAX_VIEW ON GRN_TAX_VIEW.GRNBID = GRN_BODY.GRNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere AND GRN_BODY.PBILLHID = 0 AND GRN_BODY.PBILLBID = 0");


                }else if($request->ReportTypes == 'complete'){

                    $data = DB::select("SELECT GRN_HEAD.VRDATE,GRN_HEAD.VRNO,GRN_HEAD.TRAN_CODE,GRN_HEAD.SERIES_CODE,GRN_HEAD.PLANT_CODE,GRN_HEAD.PFCT_CODE,GRN_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME,GRN_BODY.ITEM_CODE,GRN_BODY.ITEM_NAME,GRN_BODY.QTYRECED,GRN_BODY.UM_CODE,GRN_BODY.AQTYRECD,GRN_BODY.AUM_CODE,if(GRN_BODY.PBILLHID != '0' && GRN_BODY.PBILLBID != '0','Complete',' '),GRN_BODY.TAX_CODE,GRN_TAX_VIEW.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN GRN_TAX_VIEW ON GRN_TAX_VIEW.GRNBID = GRN_BODY.GRNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere AND GRN_BODY.PBILLHID != 0 AND GRN_BODY.PBILLBID != 0");

                }else{

                    $data = DB::select("SELECT GRN_HEAD.VRDATE,GRN_HEAD.VRNO,GRN_HEAD.TRAN_CODE,GRN_HEAD.SERIES_CODE,GRN_HEAD.PLANT_CODE,GRN_HEAD.PFCT_CODE,GRN_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME,GRN_BODY.ITEM_CODE,GRN_BODY.ITEM_NAME,GRN_BODY.QTYRECED,GRN_BODY.UM_CODE,GRN_BODY.AQTYRECD,GRN_BODY.AUM_CODE,GRN_BODY.TAX_CODE,GRN_TAX_VIEW.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN GRN_TAX_VIEW ON GRN_TAX_VIEW.GRNBID = GRN_BODY.GRNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere");

                }

                //dd(DB::getQueryLog());
                 // $data = DB::select("SELECT GRN_HEAD.VRDATE,GRN_HEAD.SERIES_CODE AS SERIES_CODE,GRN_HEAD.PREFNO,GRN_HEAD.PREFDATE,GRN_HEAD.ACC_CODE AS ACC_CODE,GRN_HEAD.PFCT_CODE AS PFCT_CODE,GRN_BODY.*,MASTER_ACC.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere");

                //dd(DB::getQueryLog());

                $discriptn_page = "Search GRN report by user";
                $this->userLogInsert($loginUser,$GrnVrno,$series_code,$discriptn_page,$accountCode);

                return DataTables()->of($data)->addIndexColumn()->make(true);
                       
               

            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
                
               

            }


    }


    public function PurchaseGrnMonthlyReport(Request $request){

        $title = "Purchase Grn Monthly Report";

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];
        $acc_list        = $functionData['transpoter_list'];
        $qc_list         = $functionData['qc_list'];
        $item_list       = $functionData['item_list'];

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_grn_monthly_report',$userdata+compact('title','bank_list','transpoter_list','item_list','qc_list','item_list','master_plant','master_series','master_pfct','acc_list'));
        }else{

            return redirect('/useractivity');

        }

    }


public function getDataMonthlyPurchaseGrn(Request $request){

        if($request->ajax()) {

            if (!empty($request->from_date || $request->to_date || $request->code)) {


         

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  GRN_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->acc_code) && trim($request->acc_code)!=""){
                    
                    $strWhere .= " AND  GRN_HEAD.ACC_CODE = '$request->acc_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($request->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($request->from_date));
                  
                  $strWhere .= " AND  GRN_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  GRN_HEAD.COMP_CODE = '".$this->comp_code."' AND GRN_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


                // print_r($request->post());exit;
                  if($request->code=='series code'){
                  //  DB::enableQueryLog();

                     $data = DB::select("SELECT  CONCAT(GRN_BODY.SERIES_CODE,' - ',MASTER_CONFIG.SERIES_NAME) as SERIES_CODE,CONCAT(GRN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(GRN_BODY.ITEM_CODE,' - ',GRN_BODY.ITEM_NAME) as ITEM_CODE,GRN_TAX_VIEW.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN GRN_TAX_VIEW ON GRN_TAX_VIEW.GRNBID = GRN_BODY.GRNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE = GRN_HEAD.SERIES_CODE WHERE 1=1 $strWhere GROUP BY GRN_HEAD.SERIES_CODE");

                     //dd(DB::getQueryLog());

                  }else if($request->code=='acc code' || $request->code=='acc item code'){
                    $data = DB::select("SELECT  CONCAT(GRN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(GRN_BODY.ITEM_CODE,' - ',GRN_BODY.ITEM_NAME) as ITEM_CODE,GRN_TAX_VIEW.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN  GRN_TAX_VIEW ON  GRN_TAX_VIEW.GRNBID = GRN_BODY.GRNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY GRN_HEAD.ACC_CODE");

                  }else if($request->code=='item code' || $request->code=='item code acc code'){

                    $data = DB::select("SELECT  CONCAT(GRN_BODY.ITEM_CODE,' - ',GRN_BODY.ITEM_NAME) as ITEM_CODE,CONCAT(GRN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,GRN_TAX_VIEW.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN  GRN_TAX_VIEW ON  GRN_TAX_VIEW.GRNBID = GRN_BODY.GRNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY GRN_BODY.ITEM_CODE");

                  }else if($request->code=='month' || $request->code=='acc item code month' || $request->code=='item acc code month'){

                    $data = DB::select("SELECT  CONCAT(GRN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(GRN_BODY.ITEM_CODE,' - ',GRN_BODY.ITEM_NAME) as ITEM_CODE,GRN_MONTH_VIEW.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN    GRN_MONTH_VIEW ON    GRN_MONTH_VIEW.ACC_CODE = GRN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY GRN_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='item code month'){

                    $data = DB::select("SELECT CONCAT(GRN_BODY.ITEM_CODE,' - ',GRN_BODY.ITEM_NAME) as ITEM_CODE,  GRN_MONTH_VIEW.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN    GRN_MONTH_VIEW ON GRN_MONTH_VIEW.ACC_CODE = GRN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY GRN_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='acc code month'){

                    $data = DB::select("SELECT CONCAT(GRN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,GRN_MONTH_VIEW.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN    GRN_MONTH_VIEW ON    GRN_MONTH_VIEW.ACC_CODE = GRN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY GRN_HEAD.ACC_CODE");
                  }else if($request->code=='tax code'){

                    $data = DB::select("SELECT GRN_BODY.TAX_CODE,CONCAT(GRN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(GRN_BODY.ITEM_CODE,' - ',GRN_BODY.ITEM_NAME) as ITEM_CODE,  GRN_TAX_VIEW.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN     GRN_TAX_VIEW ON  GRN_TAX_VIEW.GRNBID = GRN_BODY.GRNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY GRN_BODY.TAX_CODE");
                  }else if($request->code=='cost code'){

                    $data = DB::select("SELECT GRN_HEAD.COST_CENTER,CONCAT(GRN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(GRN_BODY.ITEM_CODE,' - ',GRN_BODY.ITEM_NAME) as ITEM_CODE,   GRN_TAX_VIEW.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN  GRN_TAX_VIEW ON   GRN_TAX_VIEW.GRNBID = GRN_BODY.GRNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY GRN_HEAD.COST_CENTER");
                  }else if($request->code=='date'){

                    $data = DB::select("SELECT GRN_HEAD.VRDATE,CONCAT(GRN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(GRN_BODY.ITEM_CODE,' - ',GRN_BODY.ITEM_NAME) as ITEM_CODE,    GRN_TAX_VIEW.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN   GRN_TAX_VIEW ON   GRN_TAX_VIEW.GRNBID = GRN_BODY.GRNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY GRN_HEAD.VRDATE");
                  }

                 // print_r($data);exit;
                /*if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  purchase_quotation_head.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }*/

                //DB::enableQueryLog();tax_code


                   /* $data1 = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere");*/


                   /* $data = DB::select("SELECT MASTER_ACC.ACC_NAME,SQTN_BODY.ITEM_CODE,SQTN_BODY.ITEM_NAME, SALES_QTN_MONTH_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SALES_QTN_MONTH_VIEW ON SALES_QTN_MONTH_VIEW.ACC_CODE = SQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SALES_QTN_MONTH_VIEW.ACC_CODE");*/

                   /* echo '<pre>';

                    print_r($data);exit;

                    echo '</pre>';*/

                    
                  /*  $data = DB::select("SELECT SQTN_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,MASTER_ITEM.ITEM_NAME AS ITEM_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE LEFT JOIN MASTER_ITEM ON SQTN_BODY.ITEM_CODE = MASTER_ITEM.ITEM_CODE WHERE 1=1 $strWhere");*/

                //dd(DB::getQueryLog());


                  /*$newarray = array(
                            "data"            => $data,
                            "column"         => $columnName   
                        );

                echo json_encode($newarray);*/

               // echo json_encode($data);

              //  print_r($data);exit;


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


    public function PurchaseGrnReportExcel(Request $request,$from_date,$to_date,$vrn,$item_code,$seriesCodeOperator,$seriesCodeValue,$plantCodeOperator,$plantCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$costCetOperator,$costCetCode,$QtyOperator,$QtyValue,$ReportTypes){

            date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            $userId       = $request->session()->get('userid');
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
            $fileName = 'PGRNR'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
            
            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));
       

            public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new PurchaseGrnReportExport($from_date,$to_date,$vrn,$item_code,$seriesCodeOperator,$seriesCodeValue,$plantCodeOperator,$plantCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$costCetOperator,$costCetCode,$QtyOperator,$QtyValue,$ReportTypes,$comp_code,$macc_year),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);
        
    }


     public function PurchaseGrnMonthlyExcel(Request $request,$from_date,$to_date,$code){


            date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            $userId = $request->session()->get('userid');
            $company_name = $request->session()->get('company_name');
            $getcomcode    = explode('-', $company_name);
            $comp_code = $getcomcode[0];
            $macc_year    = $request->session()->get('macc_year');

            $dt    = date("Y-m-d");
            $expd  = explode('-',$dt);
            $y     = $expd[0];
            $m     = $expd[1];
            $d     = $expd[2];
            $num   =  rand(10,10000);
            $fileName = 'PQCR'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
            //$vr_num               = $vrnum;
          //  $item_code     = $item_code;

            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));

          
           /* if (isset($vr_num) && trim($seriesCodeOperator)!="" &&  $vr_num!='0') {

                    $exp = explode(" ",$vr_num);

                    $vr_num = $exp[2];

                }*/


             public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new PurchaseMonthlyGrnExport($from_date,$to_date,$comp_code,$macc_year,$code),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }


    public function PurchaseBillReport(Request $request){


        $title = "Purchase Order Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];
        $acc_list        = $functionData['transpoter_list'];


        $master_plant  = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct   = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        $master_cost   = DB::table('MASTER_COST')->get();

        

        $userdata['contract_list'] = DB::select("SELECT PBILL_HEAD.VRDATE,PBILL_HEAD.PREFNO,PBILL_HEAD.PREFDATE,PBILL_BODY.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID  GROUP BY PBILL_BODY.PBILLHID");

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_bill_report',$userdata+compact('title','transpoter_list','item_list','acc_list','master_plant','master_series','master_pfct','master_cost'));
        }else{

            return redirect('/useractivity');

        }



    }

    public function getDataFromQueryFormPurchaseBill(Request $request){


        if($request->ajax()) {

            if (!empty($request->seriesCodeOperator || $request->seriesCodeValue || $request->plantCodeOperator || $request->plantCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->accCodeOperator || $request->accCode || $request->costCetOperator || $request->costCetCode || $request->QtyOperator || $request->QtyValue || $request->from_date || $request->to_date || $request->item_code || $request->vr_num)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';
                $loginUser   = $request->session()->get('userid');
                $vrseqNum    = $request->vr_num;
                $series_code = $request->seriesCodeValue;
                $accountCode = $request->accCode;

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeValue)!=""){
                   
                    $strWhere .= " AND  PBILL_HEAD.PLANT_CODE $request->plantCodeOperator '$request->plantCodeValue'";
                } 

                

                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeValue)!=""){
                    
                    $strWhere .= " AND  PBILL_HEAD.SERIES_CODE $request->seriesCodeOperator '$request->seriesCodeValue'";
                }


                 if(isset($request->profitCenterOperator)  && trim($request->profitCenterValue)!=""){
                    
                    $strWhere .= " AND  PBILL_HEAD.PFCT_CODE ".$request->profitCenterOperator." '".$request->profitCenterValue."'";
                }
               

                if(isset($request->QtyOperator)  && trim($request->QtyValue)!=""){
                    $strWhere .= " AND  PBILL_BODY.QTYRECD ".$request->QtyOperator." '".$request->QtyValue."'";
                }



                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  PBILL_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  PBILL_BODY.VRNO = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  PBILL_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

               
           



                    $data = DB::select("SELECT PBILL_HEAD.PLANT_CODE AS PLANT_CODE,PBILL_HEAD.VRDATE,PBILL_HEAD.SERIES_CODE AS SERIES_CODE,PBILL_HEAD.PREFNO,PBILL_HEAD.PREFDATE,PBILL_HEAD.ACC_CODE AS ACC_CODE,PBILL_HEAD.PFCT_CODE AS PFCT_CODE,PBILL_BODY.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID WHERE 1=1 $strWhere");

                
                $discriptn_page = "Search purchase bill report by user";
                $this->userLogInsert($loginUser,$vrseqNum,$series_code,$discriptn_page,$accountCode);
                    
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


    public function PurchaseBillMonthlyReport(Request $request){

        $title = "Purchase Bill Monthly Report";

        $company_name = $request->session()->get('company_name');
        $macc_year    = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid       = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $TranCode = 'A0';
        $Tran_Code2 = 'A1';

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];
        $acc_list        = $functionData['transpoter_list'];
        $qc_list         = $functionData['qc_list'];
        $item_list       = $functionData['item_list'];

        if(isset($company_name)){

            return view('admin.finance.report.purchase.purchase_bill_monthly_report',$userdata+compact('title','bank_list','transpoter_list','item_list','qc_list','item_list','master_plant','master_series','master_pfct','acc_list'));
        }else{

            return redirect('/useractivity');

        }

    }


public function getDataMonthlyPurchaseBill(Request $request){

        if($request->ajax()) {

            if (!empty($request->from_date || $request->to_date || $request->code)) {


         

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  PBILL_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->acc_code) && trim($request->acc_code)!=""){
                    
                    $strWhere .= " AND  PBILL_HEAD.ACC_CODE = '$request->acc_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($request->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($request->from_date));
                  
                  $strWhere .= " AND  PBILL_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  PBILL_HEAD.COMP_CODE = '".$this->comp_code."' AND PBILL_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


                // print_r($request->post());exit;
                   //DB::enableQueryLog();
                  if($request->code=='series code'){
                  

                     $data = DB::select("SELECT  CONCAT(PBILL_BODY.SERIES_CODE,' - ',MASTER_CONFIG.SERIES_NAME) as SERIES_CODE,CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,PBILL_TAX_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN PBILL_TAX_VIEW ON PBILL_TAX_VIEW.PBILLBID = PBILL_BODY.PBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE = PBILL_HEAD.SERIES_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.SERIES_CODE");

                     

                  }else if($request->code=='acc code' || $request->code=='acc item code'){
                    $data = DB::select("SELECT  CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,PBILL_TAX_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN  PBILL_TAX_VIEW ON  PBILL_TAX_VIEW.PBILLBID = PBILL_BODY.PBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.ACC_CODE");

                  }else if($request->code=='item code' || $request->code=='item code acc code'){

                    $data = DB::select("SELECT  CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,PBILL_TAX_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN  PBILL_TAX_VIEW ON  PBILL_TAX_VIEW.PBILLBID = PBILL_BODY.PBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_BODY.ITEM_CODE");

                  }else if($request->code=='month' || $request->code=='acc item code month' || $request->code=='item acc code month'){

                    $data = DB::select("SELECT  CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,PBILL_MONTH_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN    PBILL_MONTH_VIEW ON    PBILL_MONTH_VIEW.ACC_CODE = PBILL_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='item code month'){

                    $data = DB::select("SELECT CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,  PBILL_MONTH_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN    PBILL_MONTH_VIEW ON PBILL_MONTH_VIEW.ACC_CODE = PBILL_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='acc code month'){

                    $data = DB::select("SELECT CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,PBILL_MONTH_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN    PBILL_MONTH_VIEW ON    PBILL_MONTH_VIEW.ACC_CODE = PBILL_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.ACC_CODE");
                  }else if($request->code=='tax code'){

                    $data = DB::select("SELECT PBILL_BODY.TAX_CODE,CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,  PBILL_TAX_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN     PBILL_TAX_VIEW ON  PBILL_TAX_VIEW.PBILLBID = PBILL_BODY.PBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_BODY.TAX_CODE");
                  }else if($request->code=='cost code'){

                    $data = DB::select("SELECT PBILL_HEAD.COST_CENTER,CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE, PBILL_TAX_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN  PBILL_TAX_VIEW ON  PBILL_TAX_VIEW.PBILLBID = PBILL_BODY.PBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.COST_CENTER");
                  }else if($request->code=='date'){

                    $data = DB::select("SELECT PBILL_HEAD.VRDATE,CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,PBILL_TAX_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN   PBILL_TAX_VIEW ON  PBILL_TAX_VIEW.PBILLBID = PBILL_BODY.PBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.VRDATE");
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



public function PurchaseBillMonthlyExcel(Request $request,$from_date,$to_date,$code){


            date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            $userId = $request->session()->get('userid');
            $company_name = $request->session()->get('company_name');
            $getcomcode    = explode('-', $company_name);
            $comp_code = $getcomcode[0];
            $macc_year    = $request->session()->get('macc_year');

            $dt    = date("Y-m-d");
            $expd  = explode('-',$dt);
            $y     = $expd[0];
            $m     = $expd[1];
            $d     = $expd[2];
            $num   =  rand(10,10000);
            $fileName = 'PQCR'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
            //$vr_num               = $vrnum;
          //  $item_code     = $item_code;

            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));

          
           /* if (isset($vr_num) && trim($seriesCodeOperator)!="" &&  $vr_num!='0') {

                    $exp = explode(" ",$vr_num);

                    $vr_num = $exp[2];

                }*/


             public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new PurchaseMonthlyBillExport($from_date,$to_date,$comp_code,$macc_year,$code),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }

public function PurchaseBillReportExcel(Request $request,$from_date,$to_date,$vrn,$item_code,$seriesCodeOperator,$seriesCodeValue,$plantCodeOperator,$plantCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$costCetOperator,$costCetCode,$QtyOperator,$QtyValue){

            date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            $userId       = $request->session()->get('userid');
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
            $fileName = 'PGRNR'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
            
            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));
       

            public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new PurchaseBillReportExport($from_date,$to_date,$vrn,$item_code,$seriesCodeOperator,$seriesCodeValue,$plantCodeOperator,$plantCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$costCetOperator,$costCetCode,$QtyOperator,$QtyValue,$comp_code,$macc_year),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);
        
    }

    public function GetCalTaxDataPurchaseBillReports(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $HeadId  = $request->input('headid');
            $BodyId  = $request->input('bodyId');
            
            $fetch_reocrd = DB::table('purchase_tax')->where('purchase_head_id',$HeadId)->where('purchase_body_id',$BodyId)->get();

            $fetch_reocrd1 = DB::table('purchase_head')->where('id',$HeadId)->get();


            if ($fetch_reocrd!='') {

                $response_array['response']    = 'success';
                $response_array['data']        = $fetch_reocrd;
                $response_array['tax_code']    = $fetch_reocrd1;

                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data']     = '' ;
                $response_array['tax_code']    = '';
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


    public function GetQuaParDataBillReports(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $HeadId  = $request->input('headid');
            $BodyId  = $request->input('bodyId');
            
            
            $fetch_reocrd = DB::table('purchase_qua')->where('purchase_head_id',$HeadId)->where('purchase_body_id',$BodyId)->get();
                

            if ($fetch_reocrd!='') {

                $response_array['response']    = 'success';
                $response_array['data']        = $fetch_reocrd;
                //$response_array['levelAmt']    = $levelAmt;

                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data']     = '' ;
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


    public function PurchaseIndentPdf(Request $request){

        $company_name  = $request->session()->get('company_name');
        $getcomcode    = explode('-', $company_name);
        $COMP_CODE = $getcomcode[0];

        $title = 'Purchase Indent Report';

        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= "AND  PINDENT_HEAD.PLANT_CODE $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= "AND PINDENT_BODY.LAST_UPDATE_DATE $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= "AND  PINDENT_BODY.VRNO $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= "AND  PINDENT_BODY.SERIES_CODE $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= "AND  PINDENT_BODY.ITEM_CODE $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= "AND  PINDENT_BODY.QTYRECVD $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= "AND  PINDENT_BODY.REMARK LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= "AND  PINDENT_BODY.SERIES_CODE = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= "AND  PINDENT_BODY.ITEM_CODE = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= "AND  PINDENT_BODY.VRNO = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  PINDENT_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

                //DB::enableQueryLog();

                $data1 = DB::select("SELECT PINDENT_HEAD.EMP_CODE,PINDENT_HEAD.VRDATE,PINDENT_HEAD.DEPT_CODE,PINDENT_HEAD.PARTYREFNO,PINDENT_HEAD.PARTYREFDATE,PINDENT_BODY.* FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_HEAD.PINDHID = PINDENT_BODY.PINDHID  WHERE 1=1 $strWhere");

              

                $plant= DB::table('MASTER_PLANT')->where('COMP_CODE',$COMP_CODE)->get()->first();

                 
              

                 header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.purchase.purchase_indent_pdf_view',compact('data1','plant','title'));
                      
                    $path = public_path('dist/downloadpdf'); 

                    $fileName =  time().'.'. 'pdf' ; 

                    $pdf->save($path . '/' . $fileName);

                    $PublicPath = url('public/dist/downloadpdf/');  

                    $downloadPdf = $PublicPath.'/'.$fileName;

                     $response_array['response'] = 'success';
                     $response_array['url'] = $downloadPdf;
                     $response_array['data'] = $data1;

                    return $response_array;
                       
               

            }else{

                $data = array();

            

            }

        }else{

            $data = array();

        
        }


    }



    


    public function PurchaseEnqueryPdf(Request $request){


        $company_name  = $request->session()->get('company_name');
        $getcomcode    = explode('-', $company_name);
        $COMP_CODE = $getcomcode[0];
        $title = 'Purchase Enquery Report';

        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  PENQ_HEAD.PLANT_CODE $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  PENQ_BODY.LAST_UPDATE_DATE $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  PENQ_BODY.VRNO $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  PENQ_BODY.SERIES_CODE $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  PENQ_BODY.ITEM_CODE $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  PENQ_BODY.QTYRECD $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  PENQ_BODY.PARTICULAR LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  PENQ_BODY.SERIES_CODE = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  PENQ_VENDOR.ACC_CODE = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  PENQ_BODY.VRNO  = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  PENQ_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

                //DB::enableQueryLog();

              
                  
                    $data1 = DB::select("SELECT PENQ_HEAD.VRDATE,PENQ_HEAD.SERIES_CODE,PENQ_HEAD.PLANT_CODE AS plantCode,PENQ_HEAD.SERIES_CODE AS seriesCode,PENQ_HEAD.PFCT_CODE AS pfctCode,PENQ_BODY.* FROM PENQ_HEAD LEFT JOIN PENQ_BODY ON PENQ_HEAD.PENQHID = PENQ_BODY.PENQHID LEFT JOIN PENQ_VENDOR ON PENQ_HEAD.PENQHID  = PENQ_VENDOR.PENQHID AND PENQ_BODY.PENQBID = PENQ_VENDOR.PENQBID WHERE 1=1 $strWhere");

                    //dd(DB::getQueryLog());

                

                $party= DB::table('MASTER_ACC')->where('ACC_CODE',$request->acct_code)->get()->first();

                $plant= DB::table('MASTER_PLANT')->where('COMP_CODE',$COMP_CODE)->get()->first();

                //print_r($party);exit;

                //dd(DB::getQueryLog());

                 header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.purchase.purchase_enq_view_pdf',compact('data1','party','plant','title'));
                      
                    $path = public_path('dist/downloadpdf'); 

                    $fileName =  time().'.'. 'pdf' ; 

                    $pdf->save($path . '/' . $fileName);

                    $PublicPath = url('public/dist/downloadpdf/');  

                    $downloadPdf = $PublicPath.'/'.$fileName;

                     $response_array['response'] = 'success';
                     $response_array['url'] = $downloadPdf;
                     $response_array['data'] = $data1;

                    return $response_array;
                       
               

            }else{

                $data = array();

            }

        }else{

            $data = array();

        }


    }

    public function PurchaseQuotationPdf(Request $request){

        $company_name  = $request->session()->get('company_name');

        $getcomcode    = explode('-', $company_name);
        $COMP_CODE = $getcomcode[0];

        $title = 'Purchase Quotation Report';

        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  PQCS_HEAD.RFQNO = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  PQCS_BODY.ITEM_CODE = '$request->vr_num'";
                }

                

                //DB::enableQueryLog();tax_code

                $data1 = DB::select("SELECT PQCS_HEAD.RFQNO AS qcNo,PQCS_HEAD.PFCT_CODE AS PFCT_CODE,PQCS_HEAD.PQCSHID AS QcsHeadId, PQCS_BODY.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID  WHERE 1=1 $strWhere");


                $amt = 0;
                 foreach ($data1 as $key) {
                    $amt += $key->BASICAMT;
                 }

                $party = DB::select("SELECT MASTER_ACCADD.*,MASTER_ACC.ACC_CODE as accCode,MASTER_ACC.ACC_NAME FROM  MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE  = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE='$request->acct_code'");

                $plant= DB::table('MASTER_PLANT')->where('COMP_CODE',$COMP_CODE)->get()->first();

                $view = 'admin.finance.report.purchase.purchase_qua_pdf_view';

                return $this->convert_number_to_words($data1, $party,$plant,$title,$amt,$view);
                
                       
                       
               

            }else{

                $data = array();

        
            }

        }else{

            $data = array();

        }


    }


    

    public function PurchaseContractPdf(Request $request){

        $company_name  = $request->session()->get('company_name');

         $getcomcode    = explode('-', $company_name);
        $COMP_CODE = $getcomcode[0];
        $title = 'Purchase Contract Report';

       if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  PCNTR_HEAD.PLANT_CODE $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  PCNTR_BODY.LAST_UPDATE_DATE $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  PCNTR_BODY.VRNO $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  PCNTR_HEAD.SERIES_CODE $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  PCNTR_BODY.ITEM_CODE $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  PCNTR_BODY.QTYRECD $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  PCNTR_BODY.PARTICULAR LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  PCNTR_HEAD.SERIES_CODE = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  PCNTR_HEAD.ACC_CODE = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  PCNTR_BODY.VRNO = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  PCNTR_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

               
                //DB::enableQueryLog();
                  
                $data1 = DB::select("SELECT PCNTR_HEAD.PLANT_CODE AS plantCode,PCNTR_HEAD.VRDATE,PCNTR_HEAD.SERIES_CODE AS seriesCode,PCNTR_HEAD.PREFNO,PCNTR_HEAD.PREFDATE,PCNTR_HEAD.ACC_CODE AS accCode,PCNTR_HEAD.PFCT_CODE AS pfctCode,PCNTR_BODY.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID WHERE 1=1 $strWhere");

                $amt = 0;
                 foreach ($data1 as $key) {
                    $amt += $key->BASICAMT;
                 }

                $party = DB::select("SELECT MASTER_ACCADD.*,MASTER_ACC.ACC_CODE as accCode,MASTER_ACC.ACC_NAME FROM  MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE  = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE='$request->acct_code'");

                $plant= DB::table('MASTER_PLANT')->where('COMP_CODE',$COMP_CODE)->get()->first();

                
                $view = 'admin.finance.report.purchase.purchase_contract_pdf';

                   return $this->convert_number_to_words($data1, $party,$plant,$title,$amt,$view);
               

            }else{

                $data = array();

            }

        }else{

            $data = array();

        }
    }



    public function PurchaseOrderPdf(Request $request){

        $company_name  = $request->session()->get('company_name');
        $getcomcode    = explode('-', $company_name);
        $COMP_CODE = $getcomcode[0];

        $title = 'Purchase Order Report';

        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  PORDER_HEAD.PLANT_CODE $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  PORDER_BODY.LAST_UPDATE_DATE $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  PORDER_BODY.VRNO $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  PORDER_HEAD.SERIES_CODE $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  PORDER_BODY.ITEM_CODE $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  PORDER_BODY.QTYRECD $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  PORDER_BODY.PARTICULAR LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  PORDER_HEAD.SERIES_CODE = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  PORDER_HEAD.ACC_CODE = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  PORDER_BODY.VRNO = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  PORDER_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

               
                //DB::enableQueryLog();
                  
               /* $data = DB::select("SELECT contract_head.plant_code AS plantCode,contract_head.vr_date,contract_head.series_code AS seriesCode,contract_head.partyref_no,contract_head.partyref_date,contract_head.acc_code AS accCode,contract_head.pfct_code AS pfctCode,contract_body.* FROM contract_head LEFT JOIN contract_body ON contract_head.id = contract_body.contract_head_id WHERE 1=1 $strWhere");*/


                 $data1 = DB::select("SELECT PORDER_HEAD.PLANT_CODE AS plantCode,PORDER_HEAD.VRDATE,PORDER_HEAD.SERIES_CODE  AS seriesCode,PORDER_HEAD.PREFNO,PORDER_HEAD.PREFDATE,PORDER_HEAD.ACC_CODE AS accCode,PORDER_HEAD.PFCT_CODE AS pfctCode,PORDER_BODY.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID  = PORDER_BODY.PORDERHID  WHERE 1=1 $strWhere");

                 $amt = 0;
                 foreach ($data1 as $key) {
                    $amt += $key->BASICAMT;
                 }

                $party = DB::select("SELECT MASTER_ACCADD.*,MASTER_ACC.ACC_CODE as accCode,MASTER_ACC.ACC_NAME FROM  MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE  = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE='$request->acct_code'");

                


                $plant= DB::table('MASTER_PLANT')->where('COMP_CODE',$COMP_CODE)->get()->first();

                        
               $view = 'admin.finance.report.purchase.purchase_order_pdf';


              return $this->convert_number_to_words($data1, $party,$plant,$title,$amt,$view);
                  
                       
               

            }else{

                $data = array();

            }

        }else{

            $data = array();
        }

    }
    

    public function PurchaseGrnPdf(Request $request){

        $company_name  = $request->session()->get('company_name');
        $title = 'Purchase Grn Report';

        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  grn_head.plant_code $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  grn_body.updated_date $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  grn_body.vrno $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  grn_head.series_code $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  grn_body.item_code $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  grn_body.quantity $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  grn_body.remark LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  grn_head.series_code = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  grn_head.acc_code = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  grn_body.vrno = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  grn_body.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }

               


                 $data1 = DB::select("SELECT grn_head.plant_code AS plantCode,grn_head.vr_date,grn_head.series_code AS seriesCode,grn_head.partyref_no,grn_head.partyref_date,grn_head.acc_code AS accCode,grn_head.pfct_code AS pfctCode,grn_body.* FROM grn_head LEFT JOIN grn_body ON grn_head.id = grn_body.grn_head_id WHERE 1=1 $strWhere");

                //dd(DB::getQueryLog());

                $party= DB::table('master_party')->where('acc_code',$request->acct_code)->get()->first();

                $plant= DB::table('master_plant')->where('comp_name',$company_name)->get()->first();

                //print_r($party);exit;

                //dd(DB::getQueryLog());

                 header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.purchase.pdf_view_purchase',compact('data1','party','plant','title'));
                      
                    $path = public_path('dist/downloadpdf'); 

                    $fileName =  time().'.'. 'pdf' ; 

                    $pdf->save($path . '/' . $fileName);

                    $PublicPath = url('public/dist/downloadpdf/');  

                    $downloadPdf = $PublicPath.'/'.$fileName;

                     $response_array['response'] = 'success';
                     $response_array['url'] = $downloadPdf;
                     $response_array['data'] = $data1;

                    return $response_array;
                       
               

            }else{

                $data = array();  

            }

        }else{

            $data = array();

        }

    }


    public function PurchaseBillPdf(Request $request){


         $company_name = $request->session()->get('company_name');
         
         
         $explode      = explode('-', $company_name);
         $comp_code    = $explode[0];
         $title        = 'Purchase Bill Report';

        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  PBILL_HEAD.PLANT_CODE $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  PBILL_BODY.LAST_UPDATE_DATE $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  PBILL_BODY.VRNO $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  PBILL_HEAD.SERIES_CODE $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  PBILL_BODY.ITEM_CODE $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  PBILL_BODY.QTYRECD $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  PBILL_BODY.PARTICULAR LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  PBILL_HEAD.SERIES_CODE = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  PBILL_HEAD.ACC_CODE = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  PBILL_BODY.VRNO = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  PBILL_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

              


                 $data1 = DB::select("SELECT PBILL_HEAD.PLANT_CODE AS plantCode,PBILL_HEAD.VRDATE,PBILL_HEAD.SERIES_CODE AS seriesCode,PBILL_HEAD.PARTYBILLNO,PBILL_HEAD.PARTYBILLDATE,PBILL_HEAD.ACC_CODE AS accCode,PBILL_HEAD.PFCT_CODE AS pfctCode,PBILL_BODY.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID WHERE 1=1 $strWhere");

                 $amt = 0;
                 foreach ($data1 as $key) {
                    $amt += $key->BASICAMT;
                 }

                $party = DB::select("SELECT MASTER_ACCADD.*,MASTER_ACC.ACC_CODE as accCode,MASTER_ACC.ACC_NAME FROM  MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE  = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE='$request->acct_code'");

             //   print_r($party);exit;

                $plant= DB::table('MASTER_PLANT')->where('COMP_CODE',$comp_code)->get()->first();

                $view = 'admin.finance.report.purchase.pdf_view_purchase';

                 return $this->convert_number_to_words($data1, $party,$plant,$title,$amt,$view);

                

            }else{

                $data = array();

            }

        }else{

            $data = array();

         
        }

    }


function convert_number_to_words($data1, $party,$plant,$title,$amt,$view)
{

    $response_array = array();

     //$num   = $request->input('amt');
     

    $num = str_replace(array(',', ' '), '' , trim($amt));

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
        'Octillion', 'Nonillion', 'Decillion', 'Undecillion', 'Duodecillion', 'Tredecillion', 'quattuordecillion',
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
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ' ' : '');
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
     

                    $pdf = PDF::loadView($view,compact('data1','party','plant','title','numwords'));
                      
                    $path = public_path('dist/downloadpdf'); 

                    $fileName =  time().'.'. 'pdf' ; 

                    $pdf->save($path . '/' . $fileName);

                    $PublicPath = url('public/dist/downloadpdf/');  

                    $downloadPdf = $PublicPath.'/'.$fileName;

                     $response_array['response'] = 'success';
                     $response_array['url'] = $downloadPdf;
                     $response_array['data'] = $data1;

                    return $response_array;

   
   

}


public function PurchaseIndentReportExcel_old(Request $request){

        if($request->ajax()) {

            date_default_timezone_set('Asia/Kolkata');

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            $company_name = $request->session()->get('company_name');
            $getcomcode    = explode('-', $company_name);
            $comp_code = $getcomcode[0];
            $macc_year    = $request->session()->get('macc_year');

            $dt    = date("Y-m-d");
            $expd  = explode('-',$dt);
            $y     = $expd[0];
            $m     = $expd[1];
            $d     = $expd[2];
            $num   =  rand(10,10000);
            $fileName = 'PIR'.'_'.$y.$m.$d.'_'.$num.'.xlsx';

            $fromDate             = $request->from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $request->to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));
            $vr_num               = $request->vr_num;
            $item_code            = $request->item_code;
            $plantCodeOperator    = $request->plantCodeOperator;
            $plantCodeValue       = $request->plantCodeValue;
            $seriesCodeOperator   = $request->seriesCodeOperator;
            $seriesCodeValue      = $request->seriesCodeValue;
            $profitCenterOperator = $request->profitCenterOperator;
            $profitCenterValue    = $request->profitCenterValue;
            $departmentOperator   = $request->departmentOperator;
            $departmentValue      = $request->departmentValue;
            $employeeOperator     = $request->employeeOperator;
            $employeeValue        = $request->employeeValue;
            $QtyOperator          = $request->QtyOperator;
            $QtyValue             = $request->QtyValue;

            

            $pathToFile = public_path('public/dist/report_excel/' . $fileName);
           
            /*return  Excel::download(new PurchaseIndentReportExport($from_date,$to_date,$vr_num,$item_code,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$departmentOperator,$departmentValue,$employeeOperator,$employeeValue,$QtyOperator,$QtyValue,$comp_code,$macc_year),$fileName);*/

            return  Excel::download(new PurchaseIndentReportExport($from_date,$to_date,$vr_num,$item_code,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$departmentOperator,$departmentValue,$employeeOperator,$employeeValue,$QtyOperator,$QtyValue,$comp_code,$macc_year),$fileName);


            //return response()->download($pathToFile, $fileName, $headers);

               

             //return response()->json($response);
            

        }

    }


/* --------- create entry in USER_LOG when user submit any form ------*/
    function userLogInsert($loginuserId,$vrno,$serieCode,$perticular,$acc_code){
        
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
                'SERIES_CODE' =>$serieCode,
                'ACC_CODE'    =>$acc_code,
                'VRNO'        =>$vrno,
                'PERTICULAR'  =>$discptn,
                'CREATED_BY'  =>$loginuserId
            );
            DB::table('USER_LOG')->insert($userLog);
        
    }

/* --------- create entry in USER_LOG when user submit any form ------*/



}
