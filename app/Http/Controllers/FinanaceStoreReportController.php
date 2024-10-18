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
use Illuminate\Support\Facades\Response;
use PDF;


class FinanaceStoreReportController extends Controller{


    public function __cunstruct(Request $request){

    }

    public function CommonFunction($macc_year,$Comp_Code,$Tran_Code,$Tran_Code2){

         $queryData['item_um_aum_list'] = DB::table('MASTER_FY')->where('COMP_CODE',$Comp_Code)->where('FY_CODE',$macc_year)->get();

         $queryData['bank_list']        = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=',$Tran_Code)->orWhere('TRAN_CODE', '=',$Tran_Code2)->get();

         $queryData['transpoter_list']  = DB::table('MASTER_ACC')->get();
         $queryData['item_list']        = DB::table('MASTER_ITEM')->get();

      
        $queryData['qc_list']   = DB::table('PQCS_HEAD')->get()->toArray();
        $queryData['item_list'] = DB::table('PQCS_BODY')->groupBy('ITEM_CODE')->get();


        return $queryData;

    }


    public function StoreRequsitionReport(Request $request){

        $title = "Purchase Order Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

       $userdata['contract_list'] = DB::select("SELECT SREQ_HEAD.VRDATE as vrdate,SREQ_BODY.* FROM SREQ_HEAD LEFT JOIN SREQ_BODY ON SREQ_HEAD.SREQHID = SREQ_BODY.SREQHID WHERE SREQ_BODY.STORE_ACTION='REQ'  GROUP BY SREQ_BODY.VRNO");

            //print_r($userdata['contract_list']);exit;

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();

        $transpoter_list = DB::table('MASTER_ACC')->get();
        $item_list       = DB::table('MASTER_ITEM')->get();

        $acc_list        = DB::table('MASTER_ACC')->get();

        if(isset($company_name)){

           return view('admin.finance.report.store.store_requistion_report',$userdata+compact('title','bank_list','transpoter_list','item_list','acc_list','item_list'));
        }else{

            return redirect('/useractivity');

        }

    }

    public function StoreRequsitionPendingReport(Request $request){

        $title        ='Store Quotation Pending/Complete Report';

        $company_name = $request->session()->get('company_name');
        $macc_year    = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid       = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name); 
        $CCFromSession = $getcomcode[0];

        $TranCode      = 'S0';
        $Tran_Code2    = 'S1';

        $functionData = $this->CommonFunction($macc_year,$CCFromSession,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];

        $SREQHEAD   = DB::table('SREQ_HEAD')->get();
        $MASACC     = DB::table('MASTER_ACC')->get();
        $MASITEM    = DB::table('MASTER_ITEM')->get();

        $getImp = explode("-",$macc_year);

        //print_r($getImp);
        

        if(isset($company_name)){

            return view('admin.finance.report.store.store_req_pending_complete_report',$userdata+compact('title','bank_list','transpoter_list','item_list','SREQHEAD','MASACC','MASITEM'));
        }else{

            return redirect('/useractivity');

        }

    }

    public function StoreRequsitionPendingAllReport(Request $request){

        if($request->ajax()) {

            if (!empty($request->requistionNo || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $RequistionNo = $request->requistionNo;
                $loginUser   = $request->session()->get('userid');

                if (isset($RequistionNo)) {

                    $exp = explode(" ",$RequistionNo);

                    $RequistionNo = $exp[2];
                    $SericeCode   = $exp[1];

                }else{
                    $RequistionNo ='';
                }

               
                if(isset($RequistionNo)  && trim($RequistionNo)!=""){
                   
                    $strWhere .= "AND  SREQ_HEAD.VRNO = '$RequistionNo' AND SREQ_HEAD.SERIES_CODE='$SericeCode'";
                } 
                

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  SREQ_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  SREQ_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }

                //DB::enableQueryLog();

                if($request->ReportTypes == 'pending'){

                    $data = DB::select("SELECT SREQ_HEAD.VRDATE AS tranDate,SREQ_HEAD.PFCT_CODE,SREQ_HEAD.PLANT_CODE,SREQ_HEAD.TRAN_CODE,SREQ_BODY.* FROM SREQ_HEAD LEFT JOIN SREQ_BODY ON SREQ_HEAD.SREQHID = SREQ_BODY.SREQHID WHERE 1=1 $strWhere AND SREQ_BODY.STORE_ACTION = 'REQ'");



                }else if($request->ReportTypes == 'complete'){

                    $data = DB::select("SELECT SREQ_HEAD.VRDATE AS tranDate,SREQ_HEAD.PFCT_CODE,SREQ_HEAD.PLANT_CODE,SREQ_HEAD.TRAN_CODE,SREQ_BODY.* FROM SREQ_HEAD LEFT JOIN SREQ_BODY ON SREQ_HEAD.SREQHID = SREQ_BODY.SREQHID WHERE 1=1 $strWhere AND SREQ_BODY.STORE_ACTION != 'REQ'");


                }else{

                    $data = DB::select("SELECT SREQ_HEAD.VRDATE AS tranDate,SREQ_HEAD.PFCT_CODE,SREQ_HEAD.PLANT_CODE,SREQ_HEAD.TRAN_CODE,SREQ_BODY.* FROM SREQ_HEAD LEFT JOIN SREQ_BODY ON SREQ_HEAD.SREQHID = SREQ_BODY.SREQHID WHERE 1=1 $strWhere");


                }
                
                $seriesCode ='';
                $accountCode ='';
                //dd(DB::getQueryLog());
                $discriptn_page = "Search store requisition pending/complete report by user";
                $this->userLogInsert($loginUser,$RequistionNo,$seriesCode,$discriptn_page,$accountCode);  

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

    public function getDataFromQueryFormStoreRequsition(Request $request){


        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date || $request->store_action)) {

                date_default_timezone_set('Asia/Kolkata');

                $action      = $request->store_action;
                $loginUser   = $request->session()->get('userid');
                $vr_seqNum   = $request->vr_num;
                $seriesCode  = $request->SeriesNoValueId;
                $accountCode = $request->AccCodeValueId;
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  SREQ_HEAD.PLANT_CODE $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  SREQ_BODY.LAST_UPDATE_DATE $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  SREQ_BODY.VRNO $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  SREQ_HEAD.SERIES_CODE $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  SREQ_BODY.ITEM_CODE $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  SREQ_BODY.QTYRECD $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  SREQ_BODY.REMARK LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  SREQ_HEAD.SERIES_CODE = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  SREQ_BODY.ITEM_CODE = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  SREQ_BODY.VRNO = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  SREQ_HEAD.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

               
                //DB::enableQueryLog();
                  
               /* $data = DB::select("SELECT contract_head.plant_code AS plantCode,contract_head.vr_date,contract_head.series_code AS seriesCode,contract_head.partyref_no,contract_head.partyref_date,contract_head.acc_code AS accCode,contract_head.pfct_code AS pfctCode,contract_body.* FROM contract_head LEFT JOIN contract_body ON contract_head.id = contract_body.contract_head_id WHERE 1=1 $strWhere");*/


                 $data = DB::select("SELECT SREQ_HEAD.PLANT_CODE AS plantCode,SREQ_HEAD.VRDATE as vrdate,SREQ_HEAD.SERIES_CODE AS seriesCode,SREQ_HEAD.PARTY_REF_NAME,SREQ_HEAD.PARTY_REF_DATE,SREQ_HEAD.DEPT_CODE AS accCode,SREQ_HEAD.PFCT_CODE AS pfctCode,SREQ_BODY.* FROM SREQ_HEAD LEFT JOIN SREQ_BODY ON SREQ_HEAD.SREQHID = SREQ_BODY.SREQHID WHERE 1=1 $strWhere AND SREQ_BODY.STORE_ACTION = '$action'");

                $discriptn_page = "Search store requisition report by user";
                $this->userLogInsert($loginUser,$vr_seqNum,$seriesCode,$discriptn_page,$accountCode);  



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


    public function StoreIssueReport(Request $request){

        $title = "Purchase Order Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

       $userdata['contract_list'] = DB::select("SELECT SREQ_HEAD.VRDATE,SREQ_BODY.* FROM SREQ_HEAD LEFT JOIN SREQ_BODY ON SREQ_HEAD.SREQHID = SREQ_BODY.SREQHID WHERE SREQ_BODY.STORE_ACTION='ISSUE'  GROUP BY SREQ_BODY.VRNO");

            //print_r($userdata['contract_list']);exit;

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();

        $transpoter_list = DB::table('MASTER_ACC')->get();
        $item_list       = DB::table('MASTER_ITEM')->get();

        $acc_list        = DB::table('MASTER_ACC')->get();

        if(isset($company_name)){

           return view('admin.finance.report.store.store_issue_report',$userdata+compact('title','bank_list','transpoter_list','item_list','acc_list','item_list'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function StoreReturnReport(Request $request){

        $title = "Store Return Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

       $userdata['contract_list'] = DB::select("SELECT SRET_HEAD.VRDATE,SRET_BODY.* FROM SRET_HEAD LEFT JOIN SRET_BODY ON SRET_HEAD.SRETHID = SRET_BODY.SRETHID  GROUP BY SRET_BODY.VRNO");

            //print_r($userdata['contract_list']);exit;

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();

        $transpoter_list = DB::table('MASTER_ACC')->get();
        $item_list       = DB::table('MASTER_ITEM')->get();

        $acc_list        = DB::table('MASTER_ACC')->get();

        if(isset($company_name)){

           return view('admin.finance.report.store.store_return_report',$userdata+compact('title','bank_list','transpoter_list','item_list','acc_list','item_list'));
        }else{

            return redirect('/useractivity');

        }

    }


     public function getDataFromQueryFormStoreReturn(Request $request){


        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date || $request->store_action)) {

                date_default_timezone_set('Asia/Kolkata');

                $action = $request->store_action;

                $loginUser=$request->session()->get('userid');
                $vrSeq = $request->vr_num;
                
                $seriesCode = $request->SeriesNoValueId;
                $accountCode = $request->acct_code;

                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  SRET_HEAD.PLANT_CODE $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  SRET_BODY.LAST_UPDATE_DATE $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  SRET_BODY.VRNO $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  SRET_HEAD.SERIES_CODE $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  SRET_BODY.ITEM_CODE $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  SRET_BODY.QTYRECD $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  SRET_BODY.REMARK LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  SRET_HEAD.SERIES_CODE = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  SRET_BODY.ITEM_CODE = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  SRET_BODY.VRNO = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  SRET_HEAD.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

               
                //DB::enableQueryLog();
                  
               /* $data = DB::select("SELECT contract_head.plant_code AS plantCode,contract_head.vr_date,contract_head.series_code AS seriesCode,contract_head.partyref_no,contract_head.partyref_date,contract_head.acc_code AS accCode,contract_head.pfct_code AS pfctCode,contract_body.* FROM contract_head LEFT JOIN contract_body ON contract_head.id = contract_body.contract_head_id WHERE 1=1 $strWhere");*/


                 $data = DB::select("SELECT SRET_HEAD.PLANT_CODE AS plantCode,SRET_HEAD.VRDATE as vrdate,SRET_HEAD.SERIES_CODE AS seriesCode,SRET_HEAD.PARTY_REF_NAME,SRET_HEAD.PARTY_REF_DATE,SRET_HEAD.DEPT_CODE AS accCode,SRET_HEAD.PFCT_CODE AS pfctCode,SRET_BODY.* FROM SRET_HEAD LEFT JOIN SRET_BODY ON SRET_HEAD.SRETHID = SRET_BODY.SRETHID WHERE 1=1 $strWhere");

                $discriptn_page = "Search store return report by user";
                $this->userLogInsert($loginUser,$vrSeq,$seriesCode,$discriptn_page,$accountCode);  

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
            
            $fetch_reocrd = DB::table('sale_quotation_taxes')->where('sale_quotation_head_id',$HeadId)->where('sale_quotation_body_id',$BodyId)->get();

            $fetch_reocrd1 = DB::table('sale_quotation_heads')->where('id',$HeadId)->get();


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


public function createPDF(Request $request){

        $company_name   = $request->session()->get('company_name');

        $macc_year      = $request->session()->get('macc_year');



        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date || $request->store_action)) {

                date_default_timezone_set('Asia/Kolkata');

                $action = $request->store_action;
                $title = $request->title;
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  store_requisition_heads.plant_code $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  store_requisition_bodies.updated_date $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  store_requisition_bodies.vrno $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  store_requisition_heads.series_code $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  store_requisition_bodies.item_code $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  store_requisition_bodies.quantity $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  store_requisition_bodies.remark LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  store_requisition_heads.series_code = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  store_requisition_bodies.item_code = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  store_requisition_bodies.vrno = '$request->vr_num'";
                }

               // print_r($strWhere);exit();

                /*if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  store_requisition_heads.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }*/

                //DB::enableQueryLog();
                 $data1 = DB::select("SELECT store_requisition_heads.plant_code AS plantCode,store_requisition_heads.vr_date,store_requisition_heads.series_code AS seriesCode,store_requisition_heads.party_ref_name,store_requisition_heads.party_ref_date,store_requisition_heads.dept_code AS accCode,store_requisition_heads.pfct_code AS pfctCode,store_requisition_bodies.* FROM store_requisition_heads LEFT JOIN store_requisition_bodies ON store_requisition_heads.id = store_requisition_bodies.store_requistion_head_id WHERE 1=1 $strWhere AND store_requisition_bodies.store_action = '$action'");

                 $plant= DB::table('master_plant')->where('comp_name',$company_name)->get()->first();

                //dd(DB::getQueryLog());
                    header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.store.pdf_view',compact('data1','company_name','plant','title'));
                      
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

    
    public function storeReturnPDF(Request $request){

        $company_name   = $request->session()->get('company_name');

        $macc_year      = $request->session()->get('macc_year');

        $title = 'Store Return Report';

        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date || $request->store_action)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  store_return_heads.plant_code $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  store_return_bodies.updated_date $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  store_return_bodies.vrno $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  store_return_heads.series_code $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  store_return_bodies.item_code $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  store_return_bodies.quantity $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  store_return_bodies.remark LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  store_return_heads.series_code = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  store_return_bodies.item_code = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  store_return_bodies.vrno = '$request->vr_num'";
                }

              

                //DB::enableQueryLog();
                 $data1 = DB::select("SELECT store_return_heads.plant_code AS plantCode,store_return_heads.vr_date,store_return_heads.series_code AS seriesCode,store_return_heads.party_ref_name,store_return_heads.party_ref_date,store_return_heads.dept_code AS accCode,store_return_heads.pfct_code AS pfctCode,store_return_bodies.* FROM store_return_heads LEFT JOIN store_return_bodies ON store_return_heads.id = store_return_bodies.store_return_head_id WHERE 1=1 $strWhere");

                 $plant= DB::table('master_plant')->where('comp_name',$company_name)->get()->first();

                //dd(DB::getQueryLog());
                    header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.store.return_pdf_view',compact('data1','company_name','plant','title'));
                      
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
