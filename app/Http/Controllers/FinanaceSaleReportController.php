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
use App\Exports\SaleQuotationReportExport;
use App\Exports\SaleContractReportExport;
use App\Exports\SaleOrderReportExport;
use App\Exports\SaleBillReportExport;
use App\Exports\SaleChallanReportExport;
use App\Exports\SaleEnqueryReportExport;
use App\Exports\SaleMonthlyQuotationReportExport;
use App\Exports\SaleMonthlyQuotationExport;
use App\Exports\SaleMonthlyContractExport;
use App\Exports\SaleMonthlyOrderExport;
use App\Exports\SaleMonthlyChallanExport;
use App\Exports\SaleMonthlyBillExport;


class FinanaceSaleReportController extends Controller{


    public function __cunstruct(Request $request){

    }




public function SalesEnquiryReport(Request $request){

        $title            = "Sale Enquiry Report";
        
        $company_name     = $request->session()->get('company_name');
        $macc_year        = $request->session()->get('macc_year');
        $usertype         = $request->session()->get('user_type');
        $userid           = $request->session()->get('userid');
        
        $getcomcode       = explode('-', $company_name);
        $CCFromSession    = $getcomcode[0];
        
        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        
        $acc_list = DB::table('MASTER_ACC')->get();
        $item_list       = DB::table('MASTER_ITEM')->get();
      //  $qc_list         = DB::table('MASTER_ACC')->groupBy('ACC_CODE')->get();
       // $item_list       = DB::table('SQTN_BODY')->groupBy('ITEM_CODE')->get();
        $SQTNHEAD       = DB::table('SENQ_HEAD')->get();

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_enquiry_report',$userdata+compact('title','bank_list','acc_list','item_list','item_list','SQTNHEAD','master_plant','master_series','master_pfct'));
        }else{

            return redirect('/useractivity');

        }

    }


 public function getDataFromQueryFormSalesEnquiry(Request $request){

        if($request->ajax()) {

            if (!empty($request->plantCodeOperator || $request->plantCodeValue || $request->seriesCodeOperator || $request->seriesCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->QtyOperator || $request->QtyValue  || $request->bank_code || $request->acct_code || $request->vr_num || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {

                $seriesCode   = $request->seriesCodeValue;
                $vrSeqNo      = $request->vr_num;
                if($vrSeqNo){
                    $vrSplit      = explode(' ', $vrSeqNo);
                    $vr_seqNum    = $vrSplit[2];
                }else{
                    $vr_seqNum='';
                }
                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
             // print_r($macc_year);exit;

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $QuotationNo = $request->vr_num;

                if (isset($QuotationNo)) {

                    $exp = explode(" ",$QuotationNo);

                    $QuotationNo = $exp[2];

                }

               $strWhere = '';


                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeOperator)!=""){
                   
                    $strWhere .= " AND  SENQ_BODY.SERIES_CODE $request->seriesCodeOperator '$request->seriesCodeValue'";


                } 

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeOperator)!=""){
                   
                    $strWhere .= " AND  SENQ_BODY.PLANT_CODE $request->plantCodeOperator '$request->plantCodeValue'";

                    
                } 

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterOperator)!=""){
                    
                    $strWhere .= " AND  SENQ_HEAD.PFCT_CODE $request->profitCenterOperator '$request->profitCenterValue'";
                }

                if(isset($request->QtyOperator)  && trim($request->QtyOperator)!=""){
                    
                    $strWhere .= " AND  SENQ_BODY.QTYRECD $request->QtyOperator '$request->QtyValue'";
                }

             
               
                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  SENQ_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  SENQ_BODY.VRNO = '$QuotationNo'";
                }


                 if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($request->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($request->from_date));
                  
                  $strWhere .= " AND  SENQ_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  SENQ_HEAD.COMP_CODE = '".$this->comp_code."' AND SENQ_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  SENQ_HEAD.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

                //DB::enableQueryLog();


                if($request->ReportTypes == 'pending'){

                    $data = DB::select("SELECT SENQ_HEAD.VRDATE,SENQ_HEAD.PFCT_CODE,SENQ_HEAD.PLANT_CODE,SENQ_HEAD.TRAN_CODE,SENQ_BODY.* FROM SENQ_HEAD LEFT JOIN SENQ_BODY ON SENQ_HEAD.SENQHID = SENQ_BODY.SENQHID WHERE 1=1 $strWhere AND SENQ_BODY.SENQHID = '0' AND SENQ_BODY.SENQBID = '0' AND SENQ_BODY.COMP_CODE='$comp_code' AND SENQ_BODY.FY_CODE='$macc_year'");



                }else if($request->ReportTypes == 'complete'){

                    $data = DB::select("SELECT SENQ_HEAD.VRDATE,SENQ_HEAD.PFCT_CODE,SENQ_HEAD.PLANT_CODE,SENQ_HEAD.TRAN_CODE,SENQ_BODY.* FROM SENQ_HEAD LEFT JOIN SENQ_BODY ON SENQ_HEAD.SENQHID = SENQ_BODY.SENQHID  WHERE 1=1 $strWhere AND SENQ_BODY.SENQHID != '0' AND SENQ_BODY.SENQBID != '0' AND SENQ_BODY.COMP_CODE='$comp_code' AND SENQ_BODY.FY_CODE='$macc_year'");
                   


                }else{

                  
                    $data = DB::select("SELECT SENQ_HEAD.VRDATE,SENQ_HEAD.PFCT_CODE,SENQ_HEAD.PLANT_CODE,SENQ_HEAD.TRAN_CODE,SENQ_BODY.* FROM SENQ_HEAD LEFT JOIN SENQ_BODY ON SENQ_HEAD.SENQHID = SENQ_BODY.SENQHID WHERE 1=1 $strWhere AND SENQ_BODY.COMP_CODE='$comp_code' AND SENQ_BODY.FY_CODE='$macc_year'");
                     
                }


                  /*  $data = DB::select("SELECT SQTN_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,MASTER_ITEM.ITEM_NAME AS ITEM_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE LEFT JOIN MASTER_ITEM ON SQTN_BODY.ITEM_CODE = MASTER_ITEM.ITEM_CODE WHERE 1=1 $strWhere");*/

             //   dd(DB::getQueryLog());


                $accountCd ='';
                $discriptn_page = "Search sale enquiry report by user";
                $this->userLogInsert($loginUser,$vr_seqNum,$seriesCode,$discriptn_page,$accountCd);  
                
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



    public function SaleEnquiryReportExcel(Request $request,$item_code,$vr_nums,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$type){


    	//print_r($vr_nums);exit;
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
            $vr_num               = $vr_nums;
            $item_code            = $item_code;
            $plantCodeOperator    = $plantCodeOperator;
            $plantCodeValue       = $plantCodeValue;
            $seriesCodeOperator   = $seriesCodeOperator;
            $seriesCodeValue      = $seriesCodeValue;
            $profitCenterOperator = $profitCenterOperator;
            $profitCenterValue    = $profitCenterValue;
            $QtyOperator          = $QtyOperator;
            $QtyValue             = $QtyValue;
           
            public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new SaleEnqueryReportExport($from_date,$to_date,$vr_num,$item_code,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$QtyOperator,$QtyValue,$comp_code,$macc_year,$type),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }



    public function SalesQuotationReport(Request $request){

        $title            = "Sale Quotation Report";
        
        $company_name     = $request->session()->get('company_name');
        $macc_year        = $request->session()->get('macc_year');
        $usertype         = $request->session()->get('user_type');
        $userid           = $request->session()->get('userid');
        
        $getcomcode       = explode('-', $company_name);
        $CCFromSession    = $getcomcode[0];
        
        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        
        $acc_list = DB::table('MASTER_ACC')->get();
        $item_list       = DB::table('MASTER_ITEM')->get();
        $qc_list         = DB::table('SQTN_HEAD')->groupBy('ACC_CODE')->get();
       // $item_list       = DB::table('SQTN_BODY')->groupBy('ITEM_CODE')->get();
        $SQTNHEAD       = DB::table('SQTN_HEAD')->get();

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_quotation_report',$userdata+compact('title','bank_list','acc_list','item_list','qc_list','item_list','SQTNHEAD','master_plant','master_series','master_pfct'));
        }else{

            return redirect('/useractivity');

        }

    }


public function SalesQuotationMonthlyReport(Request $request){

        $title            = "Sale Quotation Report";
        
        $company_name     = $request->session()->get('company_name');
        $macc_year        = $request->session()->get('macc_year');
        $usertype         = $request->session()->get('user_type');
        $userid           = $request->session()->get('userid');
        
        $getcomcode       = explode('-', $company_name);
        $CCFromSession    = $getcomcode[0];
        
        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list     = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();
        
        $master_plant  = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct   = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        
        $acc_list      = DB::table('MASTER_ACC')->get();
        $item_list     = DB::table('MASTER_ITEM')->get();
        $qc_list       = DB::table('SQTN_HEAD')->groupBy('ACC_CODE')->get();
        // $item_list  = DB::table('SQTN_BODY')->groupBy('ITEM_CODE')->get();
        $SQTNHEAD      = DB::table('SQTN_HEAD')->get();

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_quotation_monthly_report',$userdata+compact('title','bank_list','acc_list','item_list','qc_list','item_list','SQTNHEAD','master_plant','master_series','master_pfct'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function getDataFromQueryFormSalesQuotation(Request $request){

        if($request->ajax()) {

            if (!empty($request->plantCodeOperator || $request->plantCodeValue || $request->seriesCodeOperator || $request->seriesCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->QtyOperator || $request->QtyValue || $request->accCodeOperator || $request->accCode  || $request->bank_code || $request->acct_code || $request->vr_num || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {


             // print_r($request->ReportTypes);exit;

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere    = '';
                $loginUser   = $request->session()->get('userid');
                $QuotationNo = $request->vr_num;
                $seriesCode  = $request->seriesCodeValue;
                $accountCode = $request->accCode;

                if (isset($QuotationNo)) {

                    $exp = explode(" ",$QuotationNo);

                    $QuotationNo = $exp[2];

                }else{

                    $QuotationNo = '';
                }

               $strWhere = '';


                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeOperator)!=""){
                   
                    $strWhere .= " AND  SQTN_BODY.SERIES_CODE $request->seriesCodeOperator '$request->seriesCodeValue'";


                } 

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeOperator)!=""){
                   
                    $strWhere .= " AND  SQTN_BODY.PLANT_CODE $request->plantCodeOperator '$request->plantCodeValue'";

                    
                } 

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterOperator)!=""){
                    
                    $strWhere .= " AND  SQTN_HEAD.PFCT_CODE $request->profitCenterOperator '$request->profitCenterValue'";
                }

                if(isset($request->QtyOperator)  && trim($request->QtyOperator)!=""){
                    
                    $strWhere .= " AND  SQTN_BODY.QTYRECD $request->QtyOperator '$request->QtyValue'";
                }

                if(isset($request->accCodeOperator)  && trim($request->accCodeOperator)!=""){
                    $strWhere .= " AND  SQTN_HEAD.ACC_CODE $request->accCodeOperator '$request->accCode'";
                }

               
                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  SQTN_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  SQTN_BODY.VRNO = '$QuotationNo'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($request->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($request->from_date));
                  
                  $strWhere .= " AND  SQTN_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  SQTN_HEAD.COMP_CODE = '".$this->comp_code."' AND SQTN_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }
                /*if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  purchase_quotation_head.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }*/

                //DB::enableQueryLog();tax_code


                if($request->ReportTypes == 'pending'){

                    $data = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere AND SQTN_BODY.SCNTRHID = '0' AND SQTN_BODY.SCNTRBID = '0'");



                }else if($request->ReportTypes == 'complete'){

                    $data = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere AND SQTN_BODY.SCNTRHID != '0' AND SQTN_BODY.SCNTRBID != '0'");
                   


                }else{

                    $data = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere");

                     
                }


                  /*  $data = DB::select("SELECT SQTN_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,MASTER_ITEM.ITEM_NAME AS ITEM_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE LEFT JOIN MASTER_ITEM ON SQTN_BODY.ITEM_CODE = MASTER_ITEM.ITEM_CODE WHERE 1=1 $strWhere");*/

                //dd(DB::getQueryLog());

                $discriptn_page = "Search sale quotation report by user";
                $this->userLogInsert($loginUser,$QuotationNo,$seriesCode,$discriptn_page,$accountCode);  
                
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



     public function getDataMonthlySalesQuotation(Request $request){

        if($request->ajax()) {

            if (!empty($request->from_date || $request->to_date || $request->code)) {


         

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  SQTN_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->acc_code) && trim($request->acc_code)!=""){
                    
                    $strWhere .= " AND  SQTN_HEAD.ACC_CODE = '$request->acc_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($request->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($request->from_date));
                  
                  $strWhere .= " AND  SQTN_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  SQTN_HEAD.COMP_CODE = '".$this->comp_code."' AND SQTN_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


                // print_r($request->post());exit;
                  if($request->code=='series code'){
                  //  DB::enableQueryLog();

                     $data = DB::select("SELECT  CONCAT(SQTN_BODY.SERIES_CODE,' - ',MASTER_CONFIG.SERIES_NAME) as SERIES_CODE,CONCAT(SQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SQTN_BODY.ITEM_CODE,' - ',SQTN_BODY.ITEM_NAME) as ITEM_CODE,SQTN_TAX_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SQTN_TAX_VIEW ON SQTN_TAX_VIEW.SQTNBID = SQTN_BODY.SQTNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE = SQTN_HEAD.SERIES_CODE WHERE 1=1 $strWhere GROUP BY SQTN_HEAD.SERIES_CODE");

                     //dd(DB::getQueryLog());

                  }else if($request->code=='acc code' || $request->code=='acc item code'){
                    $data = DB::select("SELECT  CONCAT(SQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SQTN_BODY.ITEM_CODE,' - ',SQTN_BODY.ITEM_NAME) as ITEM_CODE,SQTN_TAX_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SQTN_TAX_VIEW ON SQTN_TAX_VIEW.SQTNBID = SQTN_BODY.SQTNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SQTN_HEAD.ACC_CODE");

                  }else if($request->code=='item code' || $request->code=='item code acc code'){

                    $data = DB::select("SELECT  CONCAT(SQTN_BODY.ITEM_CODE,' - ',SQTN_BODY.ITEM_NAME) as ITEM_CODE,CONCAT(SQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,SQTN_TAX_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SQTN_TAX_VIEW ON SQTN_TAX_VIEW.SQTNBID = SQTN_BODY.SQTNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SQTN_BODY.ITEM_CODE");

                  }else if($request->code=='month' || $request->code=='acc item code month' || $request->code=='item acc code month'){

                    $data = DB::select("SELECT  CONCAT(SQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SQTN_BODY.ITEM_CODE,' - ',SQTN_BODY.ITEM_NAME) as ITEM_CODE,SALES_QTN_MONTH_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SALES_QTN_MONTH_VIEW ON SALES_QTN_MONTH_VIEW.ACC_CODE = SQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SQTN_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='item code month'){

                    $data = DB::select("SELECT CONCAT(SQTN_BODY.ITEM_CODE,' - ',SQTN_BODY.ITEM_NAME) as ITEM_CODE,SALES_QTN_MONTH_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SALES_QTN_MONTH_VIEW ON SALES_QTN_MONTH_VIEW.ACC_CODE = SQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SQTN_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='acc code month'){

                    $data = DB::select("SELECT CONCAT(SQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,SALES_QTN_MONTH_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SALES_QTN_MONTH_VIEW ON SALES_QTN_MONTH_VIEW.ACC_CODE = SQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SQTN_HEAD.ACC_CODE");
                  }else if($request->code=='tax code'){

                    $data = DB::select("SELECT SQTN_BODY.TAX_CODE,CONCAT(SQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SQTN_BODY.ITEM_CODE,' - ',SQTN_BODY.ITEM_NAME) as ITEM_CODE,SQTN_TAX_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SQTN_TAX_VIEW ON SQTN_TAX_VIEW.SQTNBID = SQTN_BODY.SQTNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SQTN_BODY.TAX_CODE");
                  }else if($request->code=='cost code'){

                    $data = DB::select("SELECT SQTN_HEAD.COST_CENTER,CONCAT(SQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SQTN_BODY.ITEM_CODE,' - ',SQTN_BODY.ITEM_NAME) as ITEM_CODE,SQTN_TAX_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SQTN_TAX_VIEW ON SQTN_TAX_VIEW.SQTNBID = SQTN_BODY.SQTNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SQTN_HEAD.COST_CENTER");
                  }else if($request->code=='date'){

                    $data = DB::select("SELECT SQTN_HEAD.VRDATE,CONCAT(SQTN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SQTN_BODY.ITEM_CODE,' - ',SQTN_BODY.ITEM_NAME) as ITEM_CODE,SQTN_TAX_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SQTN_TAX_VIEW ON SQTN_TAX_VIEW.SQTNBID = SQTN_BODY.SQTNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SQTN_HEAD.VRDATE");
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




    public function SaleQuotationReportExcel(Request $request,$item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$type){


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
            $item_code     = $item_code;

            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));

          
            if (isset($vr_num) && trim($seriesCodeOperator)!="" &&  $vr_num!='0') {

                    $exp = explode(" ",$vr_num);

                    $vr_num = $exp[2];

                }


             public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new SaleQuotationReportExport($item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$comp_code,$macc_year,$type),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }

    public function SaleQuotationMonthlyReportExcel(Request $request,$item_code,$acc_code,$from_date,$to_date){


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
            $item_code     = $item_code;

            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));

          
            if (isset($vr_num) && trim($seriesCodeOperator)!="" &&  $vr_num!='0') {

                    $exp = explode(" ",$vr_num);

                    $vr_num = $exp[2];

                }


             public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new SaleMonthlyQuotationReportExport($item_code,$acc_code,$from_date,$to_date,$comp_code,$macc_year),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }


     public function SaleQuotationMonthlyExcel(Request $request,$from_date,$to_date,$code){


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
           
            return  Excel::download(new SaleMonthlyQuotationExport($from_date,$to_date,$comp_code,$macc_year,$code),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }


public function SaleContractMonthlyExcel(Request $request,$from_date,$to_date,$code){


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
           
            return  Excel::download(new SaleMonthlyContractExport($from_date,$to_date,$comp_code,$macc_year,$code),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }


public function SalesContractMonthlyReport(Request $request){

        $title            = "Sale Contract Report";
        
        $company_name     = $request->session()->get('company_name');
        $macc_year        = $request->session()->get('macc_year');
        $usertype         = $request->session()->get('user_type');
        $userid           = $request->session()->get('userid');
        
        $getcomcode       = explode('-', $company_name);
        $CCFromSession    = $getcomcode[0];
        
        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list     = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();
        
        $master_plant  = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct   = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        
        $acc_list      = DB::table('MASTER_ACC')->get();
        $item_list     = DB::table('MASTER_ITEM')->get();
        $qc_list       = DB::table('SQTN_HEAD')->groupBy('ACC_CODE')->get();
        // $item_list  = DB::table('SQTN_BODY')->groupBy('ITEM_CODE')->get();
        $SQTNHEAD      = DB::table('SQTN_HEAD')->get();

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_contract_monthly_report',$userdata+compact('title','bank_list','acc_list','item_list','qc_list','item_list','SQTNHEAD','master_plant','master_series','master_pfct'));
        }else{

            return redirect('/useractivity');

        }

    }



     public function getDataMonthlySalesContract(Request $request){

        if($request->ajax()) {

            if (!empty($request->from_date || $request->to_date || $request->code)) {


         

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  SCNTR_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->acc_code) && trim($request->acc_code)!=""){
                    
                    $strWhere .= " AND  SCNTR_HEAD.ACC_CODE = '$request->acc_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($request->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($request->from_date));
                  
                  $strWhere .= " AND  SCNTR_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  SCNTR_HEAD.COMP_CODE = '".$this->comp_code."' AND SCNTR_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


                // print_r($request->post());exit;
                  if($request->code=='series code'){
                   // DB::enableQueryLog();

                     $data = DB::select("SELECT  CONCAT(SCNTR_BODY.SERIES_CODE,' - ',MASTER_CONFIG.SERIES_NAME) as SERIES_CODE,CONCAT(SCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SCNTR_BODY.ITEM_CODE,' - ',SCNTR_BODY.ITEM_NAME) as ITEM_CODE,SCNTR_TAX_VIEW.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID LEFT JOIN SCNTR_TAX_VIEW ON SCNTR_TAX_VIEW.SCNTRBID = SCNTR_BODY.SCNTRBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCNTR_HEAD.ACC_CODE LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE = SCNTR_HEAD.SERIES_CODE WHERE 1=1 $strWhere GROUP BY SCNTR_HEAD.SERIES_CODE");

                  //  dd(DB::getQueryLog());

                  }else if($request->code=='acc code' || $request->code=='acc item code'){
                    $data = DB::select("SELECT  CONCAT(SCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SCNTR_BODY.ITEM_CODE,' - ',SCNTR_BODY.ITEM_NAME) as ITEM_CODE,SCNTR_TAX_VIEW.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID LEFT JOIN SCNTR_TAX_VIEW ON SCNTR_TAX_VIEW.SCNTRBID = SCNTR_BODY.SCNTRBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCNTR_HEAD.ACC_CODE");

                  }else if($request->code=='item code' || $request->code=='item code acc code'){

                    $data = DB::select("SELECT  CONCAT(SCNTR_BODY.ITEM_CODE,' - ',SCNTR_BODY.ITEM_NAME) as ITEM_CODE,CONCAT(SCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,SCNTR_TAX_VIEW.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID LEFT JOIN SCNTR_TAX_VIEW ON SCNTR_TAX_VIEW.SCNTRBID = SCNTR_BODY.SCNTRBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCNTR_BODY.ITEM_CODE");

                  }else if($request->code=='month' || $request->code=='acc item code month' || $request->code=='item acc code month'){

                    $data = DB::select("SELECT  CONCAT(SCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SCNTR_BODY.ITEM_CODE,' - ',SCNTR_BODY.ITEM_NAME) as ITEM_CODE,SALE_CNTR_MONTH_VIEW.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID LEFT JOIN SALE_CNTR_MONTH_VIEW ON SALE_CNTR_MONTH_VIEW.ACC_CODE = SCNTR_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCNTR_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='item code month'){

                    $data = DB::select("SELECT CONCAT(SCNTR_BODY.ITEM_CODE,' - ',SCNTR_BODY.ITEM_NAME) as ITEM_CODE,SALE_CNTR_MONTH_VIEW.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID LEFT JOIN SALE_CNTR_MONTH_VIEW ON SALE_CNTR_MONTH_VIEW.ACC_CODE = SCNTR_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCNTR_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='acc code month'){

                    $data = DB::select("SELECT CONCAT(SCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,SALE_CNTR_MONTH_VIEW.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID LEFT JOIN SALE_CNTR_MONTH_VIEW ON SALE_CNTR_MONTH_VIEW.ACC_CODE = SCNTR_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCNTR_HEAD.ACC_CODE");
                  }else if($request->code=='tax code'){

                    $data = DB::select("SELECT SCNTR_BODY.TAX_CODE,CONCAT(SCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SCNTR_BODY.ITEM_CODE,' - ',SCNTR_BODY.ITEM_NAME) as ITEM_CODE,SCNTR_TAX_VIEW.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID LEFT JOIN SCNTR_TAX_VIEW ON SCNTR_TAX_VIEW.SCNTRBID = SCNTR_BODY.SCNTRBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCNTR_BODY.TAX_CODE");
                  }else if($request->code=='cost code'){

                    $data = DB::select("SELECT SCNTR_HEAD.COST_CENTER,CONCAT(SCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SCNTR_BODY.ITEM_CODE,' - ',SCNTR_BODY.ITEM_NAME) as ITEM_CODE,SCNTR_TAX_VIEW.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID LEFT JOIN SCNTR_TAX_VIEW ON SCNTR_TAX_VIEW.SCNTRBID = SCNTR_BODY.SCNTRBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCNTR_HEAD.COST_CENTER");
                  }else if($request->code=='date'){

                    $data = DB::select("SELECT SCNTR_HEAD.VRDATE,CONCAT(SCNTR_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SCNTR_BODY.ITEM_CODE,' - ',SCNTR_BODY.ITEM_NAME) as ITEM_CODE,SCNTR_TAX_VIEW.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID LEFT JOIN SCNTR_TAX_VIEW ON SCNTR_TAX_VIEW.SCNTRBID = SCNTR_BODY.SCNTRBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCNTR_HEAD.VRDATE");
                  }

                 // print_r($data);exit;
                /*if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  purchase_quotation_head.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }*/

                //DB::enableQueryLog();tax_code


                   /* $data1 = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere");*/


                   /* $data = DB::select("SELECT MASTER_ACC.ACC_NAME,SQTN_BODY.ITEM_CODE,SQTN_BODY.ITEM_NAME, SALE_CNTR_MONTH_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SALES_QTN_MONTH_VIEW ON SALES_QTN_MONTH_VIEW.ACC_CODE = SQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SALES_QTN_MONTH_VIEW.ACC_CODE");*/

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

    public function GetCalTaxDataSalesQuoReports(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $HeadId  = $request->input('headid');
            $BodyId  = $request->input('bodyId');
            
            $fetch_reocrd = DB::table('SQTN_TAX')->where('SQTNHID',$HeadId)->where('SQTNBID',$BodyId)->get();

            $fetch_reocrd1 = DB::table('SQTN_HEAD')->where('SQTNHID',$HeadId)->get();


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


    public function GetQuaSaleReports(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $HeadId  = $request->input('headid');
            $BodyId  = $request->input('bodyId');
            
            $fetch_reocrd = DB::table('SQTN_QUA')->where('SQTNHID',$HeadId)->where('SQTNBID',$BodyId)->get();


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



    public function SalesOrderReport(Request $request){


        $title = "Sale Order Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

        $userdata['contract_list'] = DB::select("SELECT SORDER_HEAD.VRDATE,SORDER_HEAD.PREFNO,SORDER_HEAD.PREFDATE,SORDER_BODY.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID  GROUP BY SORDER_BODY.SORDERHID");

            //print_r($userdata['contract_list']);exit;

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();

       // $transpoter_list = DB::table('MASTER_ACC')->get();
        $item_list       = DB::table('MASTER_ITEM')->get();

        $acc_list        = DB::table('MASTER_ACC')->get();

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_order_report',$userdata+compact('title','bank_list','item_list','acc_list','master_plant','master_series','master_pfct'));
        }else{

            return redirect('/useractivity');

        }



    }


    public function SalesOrderMonthlyReport(Request $request){

        $title            = "Sale Order Report";
        
        $company_name     = $request->session()->get('company_name');
        $macc_year        = $request->session()->get('macc_year');
        $usertype         = $request->session()->get('user_type');
        $userid           = $request->session()->get('userid');
        
        $getcomcode       = explode('-', $company_name);
        $CCFromSession    = $getcomcode[0];
        
        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list     = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();
        
        $master_plant  = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct   = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        
        $acc_list      = DB::table('MASTER_ACC')->get();
        $item_list     = DB::table('MASTER_ITEM')->get();
        $qc_list       = DB::table('SQTN_HEAD')->groupBy('ACC_CODE')->get();
        // $item_list  = DB::table('SQTN_BODY')->groupBy('ITEM_CODE')->get();
        $SQTNHEAD      = DB::table('SQTN_HEAD')->get();

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_order_monthly_report',$userdata+compact('title','bank_list','acc_list','item_list','qc_list','item_list','SQTNHEAD','master_plant','master_series','master_pfct'));
        }else{

            return redirect('/useractivity');

        }

    }


public function SaleOrderMonthlyExcel(Request $request,$from_date,$to_date,$code){


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
           
            return  Excel::download(new SaleMonthlyOrderExport($from_date,$to_date,$comp_code,$macc_year,$code),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }

public function getDataMonthlySalesOrder(Request $request){

        if($request->ajax()) {

            if (!empty($request->from_date || $request->to_date || $request->code)) {


          //  print_r($request->from_date);exit;

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  SORDER_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->acc_code) && trim($request->acc_code)!=""){
                    
                    $strWhere .= " AND  SORDER_HEAD.ACC_CODE = '$request->acc_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($request->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($request->from_date));
                  
                  $strWhere .= " AND  SORDER_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  SORDER_HEAD.COMP_CODE = '".$this->comp_code."' AND SORDER_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


                  //print_r($strWhere);exit;

                // print_r($request->post());exit;
                  if($request->code=='series code'){
                   // DB::enableQueryLog();

                     $data = DB::select("SELECT  CONCAT(SORDER_BODY.SERIES_CODE,' - ',MASTER_CONFIG.SERIES_NAME) as SERIES_CODE,CONCAT(SORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SORDER_BODY.ITEM_CODE,' - ',SORDER_BODY.ITEM_NAME) as ITEM_CODE,SORDER_TAX_VIEW.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID LEFT JOIN SORDER_TAX_VIEW ON SORDER_TAX_VIEW.SORDERBID = SORDER_BODY.SORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SORDER_HEAD.ACC_CODE LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE = SORDER_HEAD.SERIES_CODE WHERE 1=1 $strWhere GROUP BY SORDER_HEAD.SERIES_CODE");

                  //  dd(DB::getQueryLog());

                  }else if($request->code=='acc code' || $request->code=='acc item code'){
                    $data = DB::select("SELECT  CONCAT(SORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SORDER_BODY.ITEM_CODE,' - ',SORDER_BODY.ITEM_NAME) as ITEM_CODE,SORDER_TAX_VIEW.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID LEFT JOIN SORDER_TAX_VIEW ON SORDER_TAX_VIEW.SORDERBID = SORDER_BODY.SORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SORDER_HEAD.ACC_CODE");

                  }else if($request->code=='item code' || $request->code=='item code acc code'){

                    $data = DB::select("SELECT  CONCAT(SORDER_BODY.ITEM_CODE,' - ',SORDER_BODY.ITEM_NAME) as ITEM_CODE,CONCAT(SORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,SORDER_TAX_VIEW.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID LEFT JOIN SORDER_TAX_VIEW ON SORDER_TAX_VIEW.SORDERBID = SORDER_BODY.SORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SORDER_BODY.ITEM_CODE");

                  }else if($request->code=='month' || $request->code=='acc item code month' || $request->code=='item acc code month'){

                    $data = DB::select("SELECT  CONCAT(SORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SORDER_BODY.ITEM_CODE,' - ',SORDER_BODY.ITEM_NAME) as ITEM_CODE,SALE_ORDER_MONTH_VIEW.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID LEFT JOIN SALE_ORDER_MONTH_VIEW ON SALE_ORDER_MONTH_VIEW.ACC_CODE = SORDER_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SORDER_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='item code month'){

                    $data = DB::select("SELECT CONCAT(SORDER_BODY.ITEM_CODE,' - ',SORDER_BODY.ITEM_NAME) as ITEM_CODE,SALE_ORDER_MONTH_VIEW.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID LEFT JOIN SALE_ORDER_MONTH_VIEW ON SALE_ORDER_MONTH_VIEW.ACC_CODE = SORDER_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SORDER_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='acc code month'){

                    $data = DB::select("SELECT CONCAT(SORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,SALE_ORDER_MONTH_VIEW.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID LEFT JOIN SALE_ORDER_MONTH_VIEW ON SALE_ORDER_MONTH_VIEW.ACC_CODE = SORDER_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SORDER_HEAD.ACC_CODE");
                  }else if($request->code=='tax code'){

                    $data = DB::select("SELECT SORDER_BODY.TAX_CODE,CONCAT(SORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SORDER_BODY.ITEM_CODE,' - ',SORDER_BODY.ITEM_NAME) as ITEM_CODE,SORDER_TAX_VIEW.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID LEFT JOIN SORDER_TAX_VIEW ON SORDER_TAX_VIEW.SORDERBID = SORDER_BODY.SORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SORDER_BODY.TAX_CODE");
                  }else if($request->code=='cost code'){

                    $data = DB::select("SELECT SORDER_HEAD.COST_CENTER,CONCAT(SORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SORDER_BODY.ITEM_CODE,' - ',SORDER_BODY.ITEM_NAME) as ITEM_CODE,SORDER_TAX_VIEW.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID LEFT JOIN SORDER_TAX_VIEW ON SORDER_TAX_VIEW.SORDERBID = SORDER_BODY.SORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SORDER_HEAD.COST_CENTER");
                  }else if($request->code=='date'){

                      //DB::enableQueryLog();

                    $data = DB::select("SELECT SORDER_HEAD.VRDATE,CONCAT(SORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SORDER_BODY.ITEM_CODE,' - ',SORDER_BODY.ITEM_NAME) as ITEM_CODE,SORDER_TAX_VIEW.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID LEFT JOIN SORDER_TAX_VIEW ON SORDER_TAX_VIEW.SORDERBID = SORDER_BODY.SORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SORDER_HEAD.VRDATE");

                    //dd(DB::getQueryLog());
                  }

                 // print_r($data);exit;
                /*if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  purchase_quotation_head.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }*/

                //DB::enableQueryLog();tax_code


                   /* $data1 = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere");*/


                   /* $data = DB::select("SELECT MASTER_ACC.ACC_NAME,SQTN_BODY.ITEM_CODE,SQTN_BODY.ITEM_NAME, SALE_CNTR_MONTH_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SALES_QTN_MONTH_VIEW ON SALES_QTN_MONTH_VIEW.ACC_CODE = SQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SALES_QTN_MONTH_VIEW.ACC_CODE");*/

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

    public function getDataFromQueryFormSalesOrder(Request $request){


        if($request->ajax()) {

           if (!empty($request->plantCodeOperator || $request->plantCodeValue || $request->seriesCodeOperator || $request->seriesCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->QtyOperator || $request->QtyValue || $request->accCodeOperator || $request->accCode  || $request->bank_code  || $request->vr_num || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere    = '';
                $vrseqNum    =$request->vr_num;
                $seriesCode  =$request->seriesCodeValue;
                $accountCode =$request->accCode;
                $loginUser   = $request->session()->get('userid');

                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeOperator)!=""){
                   
                    $strWhere .= " AND  SORDER_BODY.SERIES_CODE $request->seriesCodeOperator '$request->seriesCodeValue'";


                } 

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeOperator)!=""){
                   
                    $strWhere .= " AND  SORDER_HEAD.PLANT_CODE $request->plantCodeOperator '$request->plantCodeValue'";

                    
                } 

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterOperator)!=""){
                    
                    $strWhere .= " AND  SORDER_BODY.PFCT_CODE $request->profitCenterOperator '$request->profitCenterValue'";
                }

                if(isset($request->QtyOperator)  && trim($request->QtyOperator)!=""){
                    
                    $strWhere .= " AND  SORDER_BODY.QTYRECD $request->QtyOperator '$request->QtyValue'";
                }

                if(isset($request->accCodeOperator)  && trim($request->accCodeOperator)!=""){
                    $strWhere .= " AND  SORDER_HEAD.ACC_CODE $request->accCodeOperator '$request->accCode'";
                }

               
                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  SORDER_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  SORDER_BODY.VRNO = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($request->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($request->from_date));
                  
                  $strWhere .= " AND  SORDER_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  SORDER_HEAD.COMP_CODE = '".$this->comp_code."' AND SORDER_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }

              
              if($request->ReportTypes == 'pending'){

                    $data = DB::select("SELECT SORDER_HEAD.PLANT_CODE AS plantCode,SORDER_HEAD.VRDATE,SORDER_HEAD.SERIES_CODE  AS seriesCode,SORDER_HEAD.PREFNO,SORDER_HEAD.PREFDATE,SORDER_HEAD.ACC_CODE AS accCode,SORDER_HEAD.PFCT_CODE AS pfctCode,SORDER_BODY.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID WHERE 1=1 $strWhere AND SORDER_BODY.SCHALLANHID = '0' AND SORDER_BODY.SCHALLANBID = '0'");



                }else if($request->ReportTypes == 'complete'){

                    $data = DB::select("SELECT SORDER_HEAD.PLANT_CODE AS plantCode,SORDER_HEAD.VRDATE,SORDER_HEAD.SERIES_CODE  AS seriesCode,SORDER_HEAD.PREFNO,SORDER_HEAD.PREFDATE,SORDER_HEAD.ACC_CODE AS accCode,SORDER_HEAD.PFCT_CODE AS pfctCode,SORDER_BODY.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID WHERE 1=1 $strWhere AND SORDER_BODY.SCHALLANHID != '0' AND SORDER_BODY.SCHALLANBID != '0'");


                }else{

                    $data = DB::select("SELECT SORDER_HEAD.PLANT_CODE AS plantCode,SORDER_HEAD.VRDATE,SORDER_HEAD.SERIES_CODE  AS seriesCode,SORDER_HEAD.PREFNO,SORDER_HEAD.PREFDATE,SORDER_HEAD.ACC_CODE AS accCode,SORDER_HEAD.PFCT_CODE AS pfctCode,SORDER_BODY.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID WHERE 1=1 $strWhere");


                }
                /* $data = DB::select("SELECT SORDER_HEAD.PLANT_CODE AS plantCode,SORDER_HEAD.VRDATE,SORDER_HEAD.SERIES_CODE  AS seriesCode,SORDER_HEAD.PREFNO,SORDER_HEAD.PREFDATE,SORDER_HEAD.ACC_CODE AS accCode,SORDER_HEAD.PFCT_CODE AS pfctCode,SORDER_BODY.* FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_HEAD.SORDERHID = SORDER_BODY.SORDERHID WHERE 1=1 $strWhere");*/

                //dd(DB::getQueryLog());
                $discriptn_page = "Search sale order report by user";
                $this->userLogInsert($loginUser,$vrseqNum,$seriesCode,$discriptn_page,$accountCode);  
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




    public function SaleOrderReportExcel(Request $request,$item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$type){


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
            $item_code     = $item_code;

            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));

          
                      


             public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new SaleOrderReportExport($item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$comp_code,$macc_year,$type),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }


     public function GetCalTaxDataSalesOrderReports(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $HeadId  = $request->input('headid');
            $BodyId  = $request->input('bodyId');
            
            $fetch_reocrd = DB::table('SORDER_TAX')->where('SORDERHID',$HeadId)->where('SORDERBID',$BodyId)->get();

            $fetch_reocrd1 = DB::table('SORDER_HEAD')->where('SORDERHID',$HeadId)->get();


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

    public function GetQuaSaleOrderReports(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $HeadId  = $request->input('headid');
            $BodyId  = $request->input('bodyId');
            
            $fetch_reocrd = DB::table('SORDER_QUA')->where('SORDERHID',$HeadId)->where('SORDERBID',$BodyId)->get();


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
   

   public function SalesContractReport(Request $request){

        $title            = "Sale Quotation Report";
        
        $company_name     = $request->session()->get('company_name');
        $macc_year        = $request->session()->get('macc_year');
        $usertype         = $request->session()->get('user_type');
        $userid           = $request->session()->get('userid');
        
        $getcomcode       = explode('-', $company_name);
        $CCFromSession    = $getcomcode[0];
        
        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        
        $acc_list = DB::table('MASTER_ACC')->get();
        $item_list       = DB::table('MASTER_ITEM')->get();

        $SCNTRHEAD       = DB::table('SCNTR_HEAD')->get();
       /* $qc_list         = DB::table('SQTN_HEAD')->groupBy('ACC_CODE')->get();
        $item_list       = DB::table('SQTN_BODY')->groupBy('ITEM_CODE')->get();*/

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_contract_report',$userdata+compact('title','bank_list','acc_list','item_list','master_plant','master_series','master_pfct','SCNTRHEAD'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function getDataFromQueryFormSalesContract(Request $request){

        if($request->ajax()) {

           if (!empty($request->plantCodeOperator || $request->plantCodeValue || $request->seriesCodeOperator || $request->seriesCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->QtyOperator || $request->QtyValue || $request->accCodeOperator || $request->accCode  || $request->bank_code || $request->vr_num || $request->item_code || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $QuotationNo = $request->vr_num;
                $serieCode   = $request->seriesCodeValue;
                $accountCode = $request->accCode;
                $loginUser = $request->session()->get('userid');

                if (isset($QuotationNo)) {

                    $exp = explode(" ",$QuotationNo);

                    $QuotationNo = $exp[2];

                }else{
                    $QuotationNo ='';
                }

               $strWhere = '';


                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeOperator)!=""){
                   
                    $strWhere .= " AND  SQTN_BODY.SERIES_CODE $request->seriesCodeOperator '$request->seriesCodeValue'";


                } 

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeOperator)!=""){
                   
                    $strWhere .= " AND  SCNTR_BODY.PLANT_CODE $request->plantCodeOperator '$request->plantCodeValue'";

                    
                } 

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterOperator)!=""){
                    
                    $strWhere .= " AND  SCNTR_HEAD.PFCT_CODE $request->profitCenterOperator '$request->profitCenterValue'";
                }

                if(isset($request->QtyOperator)  && trim($request->QtyOperator)!=""){
                    
                    $strWhere .= " AND  SQTN_BODY.QTYISSUED $request->QtyOperator '$request->QtyValue'";
                }

                if(isset($request->accCodeOperator)  && trim($request->accCodeOperator)!=""){
                    $strWhere .= " AND  SCNTR_HEAD.ACC_CODE $request->accCodeOperator '$request->accCode'";
                }

              

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  SCNTR_BODY.VRNO = '$QuotationNo'";
                }


                if(isset($request->accCode) && trim($request->accCode)!=""){
                  
                    $strWhere .= " AND SCNTR_HEAD.ACC_CODE = '$request->accCode'";

                }

                if(isset($request->item_code) && trim($request->item_code)!=""){
                    
                    $strWhere .= " AND  SCNTR_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  SCNTR_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

                  
                 if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  SCNTR_HEAD.COMP_CODE = '".$this->comp_code."' AND SCNTR_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }

                //DB::enableQueryLog();tax_code

                    /*$data = DB::select("SELECT SCNTR_HEAD.ACC_CODE,SCNTR_BODY.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID  WHERE 1=1 $strWhere");*/

                //dd(DB::getQueryLog());


                    if($request->ReportTypes == 'pending'){

                    $data = DB::select("SELECT SCNTR_HEAD.VRDATE,SCNTR_HEAD.ACC_CODE,SCNTR_HEAD.PFCT_CODE,SCNTR_HEAD.PLANT_CODE,SCNTR_HEAD.TRAN_CODE,SCNTR_BODY.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID WHERE 1=1 $strWhere AND SCNTR_BODY.SORDERHID = '0' AND SCNTR_BODY.SORDERBID = '0'");



                }else if($request->ReportTypes == 'complete'){

                    $data = DB::select("SELECT SCNTR_HEAD.VRDATE,SCNTR_HEAD.ACC_CODE,SCNTR_HEAD.PFCT_CODE,SCNTR_HEAD.PLANT_CODE,SCNTR_HEAD.TRAN_CODE,SCNTR_BODY.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID WHERE 1=1 $strWhere AND SCNTR_BODY.SORDERHID != '0' AND SCNTR_BODY.SORDERBID != '0'");


                }else{

                    $data = DB::select("SELECT SCNTR_HEAD.VRDATE,SCNTR_HEAD.ACC_CODE,SCNTR_HEAD.PFCT_CODE,SCNTR_HEAD.PLANT_CODE,SCNTR_HEAD.TRAN_CODE,SCNTR_BODY.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID WHERE 1=1 $strWhere");


                }


               // print_r($data);exit;


                $discriptn_page = "Search sale contract report by user";
                $this->userLogInsert($loginUser,$QuotationNo,$serieCode,$discriptn_page,$accountCode);
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


 public function SaleContractReportExcel1(Request $request,$item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes){


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
            $item_code     = $item_code;

            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));

          
            if (isset($vr_num) && trim($seriesCodeOperator)!="" &&  $vr_num!='0') {

                    $exp = explode(" ",$vr_num);

                    $vr_num = $exp[2];

                }

           

             $strWhere = '';


                if(isset($seriesCodeOperator)  && trim($seriesCodeOperator)!="" && $seriesCodeOperator!='0'){
                   
                    $strWhere .= " AND  SCNTR_BODY.SERIES_CODE $seriesCodeOperator '$seriesCodeValue'";


                } 

                if(isset($plantCodeOperator)  && trim($plantCodeOperator)!="" && $plantCodeOperator!='0'){
                   
                    $strWhere .= " AND  SCNTR_BODY.PLANT_CODE $plantCodeOperator '$plantCodeValue'";

                    
                } 

                if(isset($profitCenterOperator)  && trim($profitCenterOperator)!="" && $profitCenterOperator!='0'){
                    
                    $strWhere .= " AND  SCNTR_HEAD.PFCT_CODE $profitCenterOperator '$profitCenterValue'";
                }

                if(isset($QtyOperator)  && trim($QtyOperator)!="" && $QtyOperator!='0'){
                    
                    $strWhere .= " AND  SCNTR_BODY.QTYISSUED $QtyOperator '$QtyValue'";
                }

                if(isset($accCodeOperator)  && trim($accCodeOperator)!="" && $accCodeOperator!='0'){
                    $strWhere .= " AND  SCNTR_HEAD.ACC_CODE $accCodeOperator '$accCode'";
                }

                if(isset($vr_num) && trim($vr_num)!="" && $vr_num!='0'){
                  
                    $strWhere .= " AND  SCNTR_BODY.VRNO = '$vr_num'";

                }

                if(isset($item_code) && trim($item_code)!="" && $item_code!='0'){
                    
                    $strWhere .= " AND  SCNTR_BODY.ITEM_CODE = '$item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  SCNTR_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

                  
                 if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  SCNTR_HEAD.COMP_CODE = '".$this->comp_code."' AND SCNTR_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }
         
    //  DB::enableQueryLog();
 
           /* $CONTRACT_BODY = DB::select("SELECT SCNTR_HEAD.SCNTRHID as headId,SCNTR_BODY.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID WHERE 1=1 $strWhere");
*/



             if($ReportTypes == 'pending'){

                    $CONTRACT_BODY = DB::select("SELECT SCNTR_HEAD.VRDATE,SCNTR_HEAD.PFCT_CODE,SCNTR_HEAD.PLANT_CODE,SCNTR_HEAD.TRAN_CODE,SCNTR_BODY.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID WHERE 1=1 $strWhere AND SCNTR_BODY.SORDERHID = '0' AND SCNTR_BODY.SORDERBID = '0'");



                }else if($ReportTypes == 'complete'){

                    $CONTRACT_BODY = DB::select("SELECT SCNTR_HEAD.VRDATE,SCNTR_HEAD.PFCT_CODE,SCNTR_HEAD.PLANT_CODE,SCNTR_HEAD.TRAN_CODE,SCNTR_BODY.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID WHERE 1=1 $strWhere AND SCNTR_BODY.SORDERHID != '0' AND SCNTR_BODY.SORDERBID != '0'");


                }else{

                    $CONTRACT_BODY = DB::select("SELECT SCNTR_HEAD.VRDATE,SCNTR_HEAD.PFCT_CODE,SCNTR_HEAD.PLANT_CODE,SCNTR_HEAD.TRAN_CODE,SCNTR_BODY.* FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_HEAD.SCNTRHID = SCNTR_BODY.SCNTRHID WHERE 1=1 $strWhere");


                }


   //dd(DB::getQueryLog());

          //  print_r($CONTRACT_BODY);exit;

        /*   $QTN_BODY = DB::select("SELECT PQTN_BODY.*  FROM PQTN_BODY  where ITEM_CODE='$item_code'");*/

           $delete =  DB::delete("DELETE FROM PURCHASE_EXCEL_TEMP WHERE CREATED_BY='$userId' AND FLAG='SC'");


           //print_r($QTN_BODY);exit;
           
           $bodycount =  count($CONTRACT_BODY);

           
              for ($i=0; $i < $bodycount; $i++) { 

                            $saleTax =  DB::table('SCNTR_TAX')->select('SCNTR_TAX.*')->where('SCNTRHID','=',$CONTRACT_BODY[$i]->SCNTRHID)->where('SCNTRBID','=',$CONTRACT_BODY[$i]->SCNTRBID)->get()->toArray();

                            $tax_count = count($saleTax);


                            $data_body = array(
                            
                            'COMP_CODE'   =>$comp_code,
                            'FY_CODE'     =>$macc_year,
                            'SHID'        =>$CONTRACT_BODY[$i]->SCNTRHID,
                            'SBID'        =>$CONTRACT_BODY[$i]->SCNTRBID,
                            'ITEM_CODE'   =>$CONTRACT_BODY[$i]->ITEM_CODE,
                            'ITEM_NAME'   =>$CONTRACT_BODY[$i]->ITEM_NAME,
                            'TAX_CODE'    =>$CONTRACT_BODY[$i]->TAX_CODE,
                            'FLAG'        =>'SC',
                            'CREATED_BY'  =>$userId,
                            
                            );
                            
                            $saveData = DB::table('PURCHASE_EXCEL_TEMP')->insert($data_body);


                            $lastId = DB::getPdo()->lastInsertId();

                            $tax_array = array();



                        for ($j=0; $j < $tax_count; $j++) { 

                            $srno = $j +1;

                             array_push($tax_array, $saleTax[$j]->TAX_AMT);

                       
                    }


                    $first = reset($tax_array);
                    $last  =end($tax_array);


                    $data_tax = array(
                            
                            'BASIC' =>$first,
                            'GRANDTOTAL' =>$last,
                            
                         );
                            

                    $updateData = DB::table('PURCHASE_EXCEL_TEMP')->where('ID',$lastId)->update($data_tax);


                                
                 }              


             public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new SaleContractReportExport($item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$comp_code,$macc_year,$type),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }


    public function SaleContractReportExcel(Request $request,$item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$type){


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
            $item_code     = $item_code;

            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));

          
            if (isset($vr_num) && trim($seriesCodeOperator)!="" &&  $vr_num!='0') {

                    $exp = explode(" ",$vr_num);

                    $vr_num = $exp[2];

                }

            

             public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new SaleContractReportExport($item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$comp_code,$macc_year,$type),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }


    public function GetCalTaxDataSalesContReports(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $HeadId  = $request->input('headid');
            $BodyId  = $request->input('bodyId');
            
            $fetch_reocrd = DB::table('SCNTR_TAX')->where('SCNTRHID',$HeadId)->where('SCNTRBID',$BodyId)->get();

            $fetch_reocrd1 = DB::table('SCNTR_HEAD')->where('SCNTRHID',$HeadId)->get();


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

    public function GetContSaleReports(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
            $HeadId  = $request->input('headid');
            $BodyId  = $request->input('bodyId');
            
            $fetch_reocrd = DB::table('SCNTR_QUA')->where('SCNTRHID',$HeadId)->where('SCNTRBID',$BodyId)->get();


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



public function SalesTransReport(Request $request){

        $title            = "Sale Quotation Report";
        
        $company_name     = $request->session()->get('company_name');
        $macc_year        = $request->session()->get('macc_year');
        $usertype         = $request->session()->get('user_type');
        $userid           = $request->session()->get('userid');
        
        $getcomcode       = explode('-', $company_name);
        $CCFromSession    = $getcomcode[0];
        
        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();

        $userdata['bill_list'] = DB::select("SELECT SBILL_HEAD.VRDATE,SBILL_HEAD.PREFNO,SBILL_HEAD.PREFDATE,SBILL_BODY.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID  GROUP BY SBILL_BODY.VRNO");

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();

        
        $acc_list = DB::table('MASTER_ACC')->get();
        $item_list       = DB::table('MASTER_ITEM')->get();
       /* $qc_list         = DB::table('SQTN_HEAD')->groupBy('ACC_CODE')->get();
        $item_list       = DB::table('SQTN_BODY')->groupBy('ITEM_CODE')->get();*/

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_trans_report',$userdata+compact('title','bank_list','acc_list','item_list','master_plant','master_series','master_pfct'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function getDataFromQueryFormSalesTrans(Request $request){

        if($request->ajax()) {

            if (!empty($request->plantCodeOperator || $request->plantCodeValue || $request->seriesCodeOperator || $request->seriesCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->QtyOperator || $request->QtyValue || $request->accCodeOperator || $request->accCode  || $request->bank_code || $request->vr_num || $request->item_code || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');

                 $loginUser   = $request->session()->get('userid');
                 
                 $strWhere    = '';
                 
                 $QuotationNo = $request->vr_num;
                 $seriesCode  = $request->seriesCodeValue;
                 $accCode     = $request->accCode;

                if (isset($QuotationNo)) {

                    $exp = explode(" ",$QuotationNo);

                    $QuotationNo = $exp[2];

                }else{
                    $QuotationNo ='';
                }

               $strWhere = '';


                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeOperator)!=""){
                   
                    $strWhere .= " AND  SBILL_BODY.SERIES_CODE $request->seriesCodeOperator '$request->seriesCodeValue'";


                } 

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeOperator)!=""){
                   
                    $strWhere .= " AND  SBILL_BODY.PLANT_CODE $request->plantCodeOperator '$request->plantCodeValue'";

                    
                } 

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterOperator)!=""){
                    
                    $strWhere .= " AND  SBILL_HEAD.PFCT_CODE $request->profitCenterOperator '$request->profitCenterValue'";
                }

                if(isset($request->QtyOperator)  && trim($request->QtyOperator)!=""){
                    
                    $strWhere .= " AND  SBILL_BODY.QTYISSUED $request->QtyOperator '$request->QtyValue'";
                }

                if(isset($request->accCodeOperator)  && trim($request->accCodeOperator)!=""){
                    $strWhere .= " AND  SBILL_HEAD.ACC_CODE $request->accCodeOperator '$request->accCode'";
                }


                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  SBILL_BODY.VRNO = '$QuotationNo'";
                }

                if(isset($request->item_code) && trim($request->item_code)!=""){
                    
                    $strWhere .= " AND  SBILL_BODY.ITEM_CODE = '$request->item_code'";
                }


                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  SBILL_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

                  
                 if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  SBILL_HEAD.COMP_CODE = '".$this->comp_code."' AND SBILL_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }

              
                //DB::enableQueryLog();tax_code

                    $data = DB::select("SELECT SBILL_HEAD.ACC_CODE,SBILL_BODY.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID  WHERE 1=1 $strWhere");

               /*if($request->ReportTypes == 'pending'){

                    $data = DB::select("SELECT SBILL_HEAD.ACC_CODE,SBILL_BODY.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID  WHERE 1=1 $strWhere AND SBILL_BODY.SCHALLANHID = '0' AND SBILL_BODY.SCHALLANBID = '0'");



                }else if($request->ReportTypes == 'complete'){

                    $data = DB::select("SELECT SELECT SBILL_HEAD.ACC_CODE,SBILL_BODY.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID  WHERE 1=1 $strWhere AND SBILL_BODY.SCHALLANHID != '0' AND SBILL_BODY.SCHALLANBID != '0'");


                }else{

                    $data = DB::select("SELECT SBILL_HEAD.ACC_CODE,SBILL_BODY.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SCHALLANBID = SBILL_HEAD.SCHALLANBID  WHERE 1=1 $strWhere");


                }*/

                //dd(DB::getQueryLog());

                $discriptn_page = "Search sale bill report by user";
                $this->userLogInsert($loginUser,$QuotationNo,$seriesCode,$discriptn_page,$accCode);  
                
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



    public function SaleBillReportExcel(Request $request,$item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$type){




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
            $item_code     = $item_code;

            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));

          
           /* if (isset($vr_num) && trim($seriesCodeOperator)!="" &&  $vr_num!='0') {

                    $exp = explode(" ",$vr_num);

                    $vr_num = $exp[2];

                }*/



             public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new SaleBillReportExport($item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$comp_code,$macc_year,$type),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }


public function SalesBillMonthlyReport(Request $request){

        $title            = "Sale Order Report";
        
        $company_name     = $request->session()->get('company_name');
        $macc_year        = $request->session()->get('macc_year');
        $usertype         = $request->session()->get('user_type');
        $userid           = $request->session()->get('userid');
        
        $getcomcode       = explode('-', $company_name);
        $CCFromSession    = $getcomcode[0];
        
        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list     = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();
        
        $master_plant  = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct   = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        
        $acc_list      = DB::table('MASTER_ACC')->get();
        $item_list     = DB::table('MASTER_ITEM')->get();
        $qc_list       = DB::table('SQTN_HEAD')->groupBy('ACC_CODE')->get();
        // $item_list  = DB::table('SQTN_BODY')->groupBy('ITEM_CODE')->get();
        $SQTNHEAD      = DB::table('SQTN_HEAD')->get();

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_bill_monthly_report',$userdata+compact('title','bank_list','acc_list','item_list','qc_list','item_list','SQTNHEAD','master_plant','master_series','master_pfct'));
        }else{

            return redirect('/useractivity');

        }

    }


public function getDataMonthlySalesBill(Request $request){

        if($request->ajax()) {

            if (!empty($request->from_date || $request->to_date || $request->code)) {


                $loginUser = $request->session()->get('userid');
                $accCode = $request->acc_code;

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  SBILL_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->acc_code) && trim($request->acc_code)!=""){
                    
                    $strWhere .= " AND  SBILL_HEAD.ACC_CODE = '$request->acc_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($request->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($request->from_date));
                  
                  $strWhere .= " AND  SBILL_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  SBILL_HEAD.COMP_CODE = '".$this->comp_code."' AND SBILL_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


                // print_r($request->post());exit;
                  if($request->code=='series code'){
                   // DB::enableQueryLog();

                     $data = DB::select("SELECT  CONCAT(SBILL_BODY.SERIES_CODE,' - ',MASTER_CONFIG.SERIES_NAME) as SERIES_CODE,CONCAT(SBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SBILL_BODY.ITEM_CODE,' - ',SBILL_BODY.ITEM_NAME) as ITEM_CODE,SBILL_TAX_VIEW.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID LEFT JOIN SBILL_TAX_VIEW ON SBILL_TAX_VIEW.SBILLBID = SBILL_BODY.SBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SBILL_HEAD.ACC_CODE LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE = SBILL_HEAD.SERIES_CODE WHERE 1=1 $strWhere GROUP BY SBILL_HEAD.SERIES_CODE");

                  //  dd(DB::getQueryLog());

                  }else if($request->code=='acc code' || $request->code=='acc item code'){
                    $data = DB::select("SELECT  CONCAT(SBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SBILL_BODY.ITEM_CODE,' - ',SBILL_BODY.ITEM_NAME) as ITEM_CODE,SBILL_TAX_VIEW.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID LEFT JOIN SBILL_TAX_VIEW ON SBILL_TAX_VIEW.SBILLBID = SBILL_BODY.SBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SBILL_HEAD.ACC_CODE");

                  }else if($request->code=='item code' || $request->code=='item code acc code'){

                    $data = DB::select("SELECT  CONCAT(SBILL_BODY.ITEM_CODE,' - ',SBILL_BODY.ITEM_NAME) as ITEM_CODE,CONCAT(SBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,SBILL_TAX_VIEW.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID LEFT JOIN SBILL_TAX_VIEW ON SBILL_TAX_VIEW.SBILLBID = SBILL_BODY.SBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SBILL_BODY.ITEM_CODE");

                  }else if($request->code=='month' || $request->code=='acc item code month' || $request->code=='item acc code month'){

                    $data = DB::select("SELECT  CONCAT(SBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SBILL_BODY.ITEM_CODE,' - ',SBILL_BODY.ITEM_NAME) as ITEM_CODE,SALE_BILL_MONTH_VIEW.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID LEFT JOIN SALE_BILL_MONTH_VIEW ON SALE_BILL_MONTH_VIEW.ACC_CODE = SBILL_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SBILL_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='item code month'){

                    $data = DB::select("SELECT CONCAT(SBILL_BODY.ITEM_CODE,' - ',SBILL_BODY.ITEM_NAME) as ITEM_CODE,SALE_BILL_MONTH_VIEW.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID LEFT JOIN SALE_BILL_MONTH_VIEW ON SALE_BILL_MONTH_VIEW.ACC_CODE = SBILL_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SBILL_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='acc code month'){

                    $data = DB::select("SELECT CONCAT(SBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,SALE_BILL_MONTH_VIEW.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID LEFT JOIN SALE_BILL_MONTH_VIEW ON SALE_BILL_MONTH_VIEW.ACC_CODE = SBILL_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SBILL_HEAD.ACC_CODE");
                  }else if($request->code=='tax code'){

                    $data = DB::select("SELECT SBILL_BODY.TAX_CODE,CONCAT(SBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SBILL_BODY.ITEM_CODE,' - ',SBILL_BODY.ITEM_NAME) as ITEM_CODE,SBILL_TAX_VIEW.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID LEFT JOIN SBILL_TAX_VIEW ON SBILL_TAX_VIEW.SBILLBID = SBILL_BODY.SBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SBILL_BODY.TAX_CODE");
                  }else if($request->code=='cost code'){

                    $data = DB::select("SELECT SBILL_HEAD.COST_CENTER,CONCAT(SBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SBILL_BODY.ITEM_CODE,' - ',SBILL_BODY.ITEM_NAME) as ITEM_CODE,SBILL_TAX_VIEW.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID LEFT JOIN SBILL_TAX_VIEW ON SBILL_TAX_VIEW.SBILLBID = SBILL_BODY.SBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SBILL_HEAD.COST_CENTER");
                  }else if($request->code=='date'){

                    $data = DB::select("SELECT SBILL_HEAD.VRDATE,CONCAT(SBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SBILL_BODY.ITEM_CODE,' - ',SBILL_BODY.ITEM_NAME) as ITEM_CODE,SBILL_TAX_VIEW.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID LEFT JOIN SBILL_TAX_VIEW ON SBILL_TAX_VIEW.SBILLBID = SBILL_BODY.SBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SBILL_HEAD.VRDATE");
                  }

                 // print_r($data);exit;
                /*if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  purchase_quotation_head.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }*/

                //DB::enableQueryLog();tax_code


                   /* $data1 = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere");*/


                   /* $data = DB::select("SELECT MASTER_ACC.ACC_NAME,SQTN_BODY.ITEM_CODE,SQTN_BODY.ITEM_NAME, SALE_CNTR_MONTH_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SALES_QTN_MONTH_VIEW ON SALES_QTN_MONTH_VIEW.ACC_CODE = SQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SALES_QTN_MONTH_VIEW.ACC_CODE");*/

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

            $discriptn_page = "Search sale bill mothly report by user";
            $this->userLogInsert($loginUser,$QuotationNo,$seriesCode,$discriptn_page,$accCode);  
                    
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


     public function SaleBillMonthlyExcel(Request $request,$from_date,$to_date,$code){


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
           
            return  Excel::download(new SaleMonthlyBillExport($from_date,$to_date,$comp_code,$macc_year,$code),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }


    public function SalesGrnReport(Request $request){


        $title = "Sale Grn Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

        $userdata['contract_list'] = DB::select("SELECT SCHALLAN_HEAD.VRDATE,SCHALLAN_HEAD.PREFNO,SCHALLAN_HEAD.PREFDATE,SCHALLAN_BODY.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID  GROUP BY SCHALLAN_BODY.SCHALLANHID");

            //print_r($userdata['contract_list']);exit;

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();

        $master_plant    = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct     = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();

       // $transpoter_list = DB::table('MASTER_ACC')->get();
        $item_list       = DB::table('MASTER_ITEM')->get();

        $acc_list        = DB::table('MASTER_ACC')->get();

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_grn_report',$userdata+compact('title','bank_list','item_list','acc_list','master_plant','master_series','master_pfct'));
        }else{

            return redirect('/useractivity');

        }



    }



    public function getDataFromQueryFormSalesGrn(Request $request){


        if($request->ajax()) {

           if (!empty($request->plantCodeOperator || $request->plantCodeValue || $request->seriesCodeOperator || $request->seriesCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->QtyOperator || $request->QtyValue || $request->accCodeOperator || $request->accCode  || $request->bank_code  || $request->vr_num || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $loginUser   = $request->session()->get('userid');
                $vrseqNum    =  $request->vr_num;
                $accountCode =  $request->accCode;
                $seriesCode  = $request->seriesCodeValue;
                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeOperator)!=""){
                   
                    $strWhere .= " AND  SCHALLAN_BODY.SERIES_CODE $request->seriesCodeOperator '$request->seriesCodeValue'";


                } 

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeOperator)!=""){
                   
                    $strWhere .= " AND  SCHALLAN_HEAD.PLANT_CODE $request->plantCodeOperator '$request->plantCodeValue'";

                    
                } 

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterOperator)!=""){
                    
                    $strWhere .= " AND  SCHALLAN_BODY.PFCT_CODE $request->profitCenterOperator '$request->profitCenterValue'";
                }

                if(isset($request->QtyOperator)  && trim($request->QtyOperator)!=""){
                    
                    $strWhere .= " AND  SCHALLAN_BODY.QTYRECD $request->QtyOperator '$request->QtyValue'";
                }

                if(isset($request->accCodeOperator)  && trim($request->accCodeOperator)!=""){
                    $strWhere .= " AND  SCHALLAN_HEAD.ACC_CODE $request->accCodeOperator '$request->accCode'";
                }

               
                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  SCHALLAN_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  SCHALLAN_BODY.VRNO = '$request->vr_num'";
                }

              	if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  SCHALLAN_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

                  
                 if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  SCHALLAN_HEAD.COMP_CODE = '".$this->comp_code."' AND SCHALLAN_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }

              /*   $data = DB::select("SELECT SCHALLAN_HEAD.PLANT_CODE AS plantCode,SCHALLAN_HEAD.VRDATE,SCHALLAN_HEAD.SERIES_CODE  AS seriesCode,SCHALLAN_HEAD.PREFNO,SCHALLAN_HEAD.PREFDATE,SCHALLAN_HEAD.ACC_CODE AS accCode,SCHALLAN_HEAD.PFCT_CODE AS pfctCode,SCHALLAN_BODY.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID WHERE 1=1 $strWhere");*/

                 if($request->ReportTypes == 'pending'){

                     $data = DB::select("SELECT SCHALLAN_HEAD.PLANT_CODE AS plantCode,SCHALLAN_HEAD.VRDATE,SCHALLAN_HEAD.SERIES_CODE  AS seriesCode,SCHALLAN_HEAD.PREFNO,SCHALLAN_HEAD.PREFDATE,SCHALLAN_HEAD.ACC_CODE AS accCode,SCHALLAN_HEAD.PFCT_CODE AS pfctCode,SCHALLAN_BODY.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID WHERE 1=1 $strWhere AND SCHALLAN_BODY.SBILLHID = '0' AND SCHALLAN_BODY.SBILLBID = '0' ");



                }else if($request->ReportTypes == 'complete'){

                     $data = DB::select("SELECT SCHALLAN_HEAD.PLANT_CODE AS plantCode,SCHALLAN_HEAD.VRDATE,SCHALLAN_HEAD.SERIES_CODE  AS seriesCode,SCHALLAN_HEAD.PREFNO,SCHALLAN_HEAD.PREFDATE,SCHALLAN_HEAD.ACC_CODE AS accCode,SCHALLAN_HEAD.PFCT_CODE AS pfctCode,SCHALLAN_BODY.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID WHERE 1=1 $strWhere AND SCHALLAN_BODY.SBILLHID != '0' AND SCHALLAN_BODY.SBILLBID != '0'");


                }else{

                     $data = DB::select("SELECT SCHALLAN_HEAD.PLANT_CODE AS plantCode,SCHALLAN_HEAD.VRDATE,SCHALLAN_HEAD.SERIES_CODE  AS seriesCode,SCHALLAN_HEAD.PREFNO,SCHALLAN_HEAD.PREFDATE,SCHALLAN_HEAD.ACC_CODE AS accCode,SCHALLAN_HEAD.PFCT_CODE AS pfctCode,SCHALLAN_BODY.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID WHERE 1=1 $strWhere");


                }

                //dd(DB::getQueryLog());
                $discriptn_page = "Search sale pgi/chllan report by user";
                $this->userLogInsert($loginUser,$vrseqNum,$seriesCode,$discriptn_page,$accountCode); 
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



    public function getDataMonthlySalesChallan(Request $request){

        if($request->ajax()) {

            if (!empty($request->from_date || $request->to_date || $request->code)) {


         

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';


                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  SCHALLAN_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->acc_code) && trim($request->acc_code)!=""){
                    
                    $strWhere .= " AND  SCHALLAN_HEAD.ACC_CODE = '$request->acc_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($request->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($request->from_date));
                  
                  $strWhere .= " AND  SCHALLAN_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  SCHALLAN_HEAD.COMP_CODE = '".$this->comp_code."' AND SCHALLAN_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


                // print_r($request->post());exit;
                  if($request->code=='series code'){
                   // DB::enableQueryLog();

                     $data = DB::select("SELECT  CONCAT(SCHALLAN_BODY.SERIES_CODE,' - ',MASTER_CONFIG.SERIES_NAME) as SERIES_CODE,CONCAT(SCHALLAN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SCHALLAN_BODY.ITEM_CODE,' - ',SCHALLAN_BODY.ITEM_NAME) as ITEM_CODE,SCHALLAN_TAX_VIEW.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID LEFT JOIN SCHALLAN_TAX_VIEW ON SCHALLAN_TAX_VIEW.SCHALLANBID = SCHALLAN_BODY.SCHALLANBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCHALLAN_HEAD.ACC_CODE LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE = SCHALLAN_HEAD.SERIES_CODE WHERE 1=1 $strWhere GROUP BY SCHALLAN_HEAD.SERIES_CODE");

                  //  dd(DB::getQueryLog());

                  }else if($request->code=='acc code' || $request->code=='acc item code'){
                    $data = DB::select("SELECT  CONCAT(SCHALLAN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SCHALLAN_BODY.ITEM_CODE,' - ',SCHALLAN_BODY.ITEM_NAME) as ITEM_CODE,SCHALLAN_TAX_VIEW.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID LEFT JOIN SCHALLAN_TAX_VIEW ON SCHALLAN_TAX_VIEW.SCHALLANBID = SCHALLAN_BODY.SCHALLANBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCHALLAN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCHALLAN_HEAD.ACC_CODE");

                  }else if($request->code=='item code' || $request->code=='item code acc code'){

                    $data = DB::select("SELECT  CONCAT(SCHALLAN_BODY.ITEM_CODE,' - ',SCHALLAN_BODY.ITEM_NAME) as ITEM_CODE,CONCAT(SCHALLAN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,SCHALLAN_TAX_VIEW.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID LEFT JOIN SCHALLAN_TAX_VIEW ON SCHALLAN_TAX_VIEW.SCHALLANBID = SCHALLAN_BODY.SCHALLANBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCHALLAN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCHALLAN_BODY.ITEM_CODE");

                  }else if($request->code=='month' || $request->code=='acc item code month' || $request->code=='item acc code month'){

                    $data = DB::select("SELECT  CONCAT(SCHALLAN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SCHALLAN_BODY.ITEM_CODE,' - ',SCHALLAN_BODY.ITEM_NAME) as ITEM_CODE,SALE_CHALLAN_MONTH_VIEW.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID LEFT JOIN SALE_CHALLAN_MONTH_VIEW ON SALE_CHALLAN_MONTH_VIEW.ACC_CODE = SCHALLAN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCHALLAN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCHALLAN_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='item code month'){

                    $data = DB::select("SELECT CONCAT(SCHALLAN_BODY.ITEM_CODE,' - ',SCHALLAN_BODY.ITEM_NAME) as ITEM_CODE,SALE_CHALLAN_MONTH_VIEW.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID LEFT JOIN SALE_CHALLAN_MONTH_VIEW ON SALE_CHALLAN_MONTH_VIEW.ACC_CODE = SCHALLAN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCHALLAN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCHALLAN_HEAD.ACC_CODE");
                  }else if($request->code=='month' || $request->code=='acc code month'){

                    $data = DB::select("SELECT CONCAT(SCHALLAN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,SALE_CHALLAN_MONTH_VIEW.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID LEFT JOIN SALE_CHALLAN_MONTH_VIEW ON SALE_CHALLAN_MONTH_VIEW.ACC_CODE = SCHALLAN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCHALLAN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCHALLAN_HEAD.ACC_CODE");
                  }else if($request->code=='tax code'){

                    $data = DB::select("SELECT SCHALLAN_BODY.TAX_CODE,CONCAT(SCHALLAN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SCHALLAN_BODY.ITEM_CODE,' - ',SCHALLAN_BODY.ITEM_NAME) as ITEM_CODE,SCHALLAN_TAX_VIEW.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID LEFT JOIN SCHALLAN_TAX_VIEW ON SCHALLAN_TAX_VIEW.SCHALLANBID = SCHALLAN_BODY.SCHALLANBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCHALLAN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCHALLAN_BODY.TAX_CODE");
                  }else if($request->code=='cost code'){

                    $data = DB::select("SELECT SCHALLAN_HEAD.COST_CENTER,CONCAT(SCHALLAN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SCHALLAN_BODY.ITEM_CODE,' - ',SCHALLAN_BODY.ITEM_NAME) as ITEM_CODE,SCHALLAN_TAX_VIEW.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID LEFT JOIN SCHALLAN_TAX_VIEW ON SCHALLAN_TAX_VIEW.SCHALLANBID = SCHALLAN_BODY.SCHALLANBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCHALLAN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCHALLAN_HEAD.COST_CENTER");
                  }else if($request->code=='date'){

                    $data = DB::select("SELECT SCHALLAN_HEAD.VRDATE,CONCAT(SCHALLAN_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(SCHALLAN_BODY.ITEM_CODE,' - ',SCHALLAN_BODY.ITEM_NAME) as ITEM_CODE,SCHALLAN_TAX_VIEW.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID LEFT JOIN SCHALLAN_TAX_VIEW ON SCHALLAN_TAX_VIEW.SCHALLANBID = SCHALLAN_BODY.SCHALLANBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SCHALLAN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SCHALLAN_HEAD.VRDATE");
                  }

                 // print_r($data);exit;
                /*if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  purchase_quotation_head.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }*/

                //DB::enableQueryLog();tax_code


                   /* $data1 = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere");*/


                   /* $data = DB::select("SELECT MASTER_ACC.ACC_NAME,SQTN_BODY.ITEM_CODE,SQTN_BODY.ITEM_NAME, SALE_CNTR_MONTH_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SALES_QTN_MONTH_VIEW ON SALES_QTN_MONTH_VIEW.ACC_CODE = SQTN_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SALES_QTN_MONTH_VIEW.ACC_CODE");*/

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


     public function SalesChallanMonthlyReport(Request $request){

        $title            = "Sale Order Report";
        
        $company_name     = $request->session()->get('company_name');
        $macc_year        = $request->session()->get('macc_year');
        $usertype         = $request->session()->get('user_type');
        $userid           = $request->session()->get('userid');
        
        $getcomcode       = explode('-', $company_name);
        $CCFromSession    = $getcomcode[0];
        
        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list     = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();
        
        $master_plant  = DB::table('MASTER_PLANT')->where('COMP_CODE',$CCFromSession)->get();
        $master_series = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CCFromSession)->get();
        $master_pfct   = DB::table('MASTER_PFCT')->where('COMP_CODE',$CCFromSession)->get();
        
        $acc_list      = DB::table('MASTER_ACC')->get();
        $item_list     = DB::table('MASTER_ITEM')->get();
        $qc_list       = DB::table('SQTN_HEAD')->groupBy('ACC_CODE')->get();
        // $item_list  = DB::table('SQTN_BODY')->groupBy('ITEM_CODE')->get();
        $SQTNHEAD      = DB::table('SQTN_HEAD')->get();

        if(isset($company_name)){

            return view('admin.finance.report.sales.sale_challan_monthly_report',$userdata+compact('title','bank_list','acc_list','item_list','qc_list','item_list','SQTNHEAD','master_plant','master_series','master_pfct'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function SaleChallanReportExcel(Request $request,$item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$type){


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
            $item_code     = $item_code;

            $fromDate             = $from_date;
            $from_date            = date("Y-m-d", strtotime($fromDate));
            $toDate               = $to_date;
            $to_date              = date("Y-m-d", strtotime($toDate));

                       


             public_path('/dist/report_excel/' . $fileName);
           
            return  Excel::download(new SaleChallanReportExport($item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$comp_code,$macc_year,$type),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }


    public function SaleChallanMonthlyExcel(Request $request,$from_date,$to_date,$code){


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
           
            return  Excel::download(new SaleMonthlyChallanExport($from_date,$to_date,$comp_code,$macc_year,$code),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

           
        
    }

public function SalesOrderPdf(Request $request){

     $company_name  = $request->session()->get('company_name');

     $title = 'Purchase Bill Report';

        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  sales_order_head.plant_code $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  sales_order_body.updated_date $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  sales_order_body.vrno $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  sales_order_head.series_code $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  sales_order_body.item_code $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  sales_order_body.quantity $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  sales_order_body.remark LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  sales_order_head.series_code = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  sales_order_head.acc_code = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  sales_order_body.vrno = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  sales_order_body.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }

               
              


                 $data1 = DB::select("SELECT sales_order_head.plant_code AS plantCode,sales_order_head.vr_date,sales_order_head.series_code AS seriesCode,sales_order_head.partyref_no,sales_order_head.partyref_date,sales_order_head.acc_code AS accCode,sales_order_head.pfct_code AS pfctCode,sales_order_body.* FROM sales_order_head LEFT JOIN sales_order_body ON sales_order_head.id = sales_order_body.sales_order_head_id WHERE 1=1 $strWhere");

                //dd(DB::getQueryLog());

                $party= DB::table('master_party')->where('acc_code',$request->acct_code)->get()->first();

                $plant= DB::table('master_plant')->where('comp_name',$company_name)->get()->first();

                //print_r($party);exit;

                //dd(DB::getQueryLog());

                 header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.sales.sale_order_pdf_view',compact('data1','party','plant','title'));
                      
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



    public function SalesTransPdf(Request $request){

     $company_name  = $request->session()->get('company_name');

     $title = 'Purchase Trans Report';

        if($request->ajax()) {

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

            $company_name   = $request->session()->get('company_name');

            $macc_year      = $request->session()->get('macc_year');

            $usertype   = $request->session()->get('user_type');

                
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


            

            $data1 = DB::select("SELECT sales_head.vr_no, sales_head.vr_date, sales_head.acc_code, sales_head.tax_code, sales_tax.tax_ind, sales_tax.tax_rate, sales_tax.tax_amt, sales_body.basic_amt, sales_body.dr_amount,master_party.acc_name FROM sales_head LEFT JOIN sales_body ON sales_head.id = sales_body.sales_head_id LEFT JOIN sales_tax ON sales_head.id = sales_tax.sales_head_id LEFT JOIN master_party ON sales_head.acc_code = master_party.acc_code WHERE $strWhere GROUP BY sales_head.id");

                //dd(DB::getQueryLog());

                $party= DB::table('master_party')->where('acc_code',$party)->get()->first();

                $plant= DB::table('master_plant')->where('comp_name',$company_name)->get()->first();

                //print_r($party);exit;

                //dd(DB::getQueryLog());

                 header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.sales.sale_trans_pdf_view',compact('data1','party','plant','title'));
                      
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
