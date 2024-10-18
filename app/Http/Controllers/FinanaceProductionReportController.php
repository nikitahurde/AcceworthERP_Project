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
class FinanaceProductionReportController extends Controller{


    public function __cunstruct(Request $request){

    }

   


    public function BomReport(Request $request){

        $title = "Bom Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

       $userdata['contract_list'] = DB::select("SELECT BOM_HEAD.VRDATE,BOM_BODY.* FROM BOM_HEAD LEFT JOIN BOM_BODY ON BOM_HEAD.BOMHID = BOM_BODY.BOMHID  GROUP BY BOM_BODY.VRNO");

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

           return view('admin.finance.report.production.bom_report',$userdata+compact('title','bank_list','transpoter_list','item_list','acc_list','item_list'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function getDataFromQueryFormProductionBom(Request $request){


        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date || $request->bom_type)) {

                date_default_timezone_set('Asia/Kolkata');

                $action    = $request->bom_type;
                $loginUser = $request->session()->get('userid');
                $vrseq     = $request->vr_num;
                $accountcd = $request->AccCodeValueId;
                $seriesCode = $request->SeriesNoValueId;

                if($vrseq){
                    $vrsplit = explode(' ', $vrseq);
                    $vrseq_num = $vrsplit[2];
                }else{
                    $vrseq_num ='';
                }
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  BOM_HEAD.PLANT_CODE $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  BOM_BODY.LAST_UPDATE_DATE $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  BOM_BODY.VRNO $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  BOM_HEAD.SERIES_CODE $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  BOM_BODY.ITEM_CODE $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  BOM_BODY.QTYRECD $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  BOM_BODY.REMARK LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  BOM_HEAD.SERIES_CODE = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  BOM_BODY.ITEM_CODE = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  BOM_BODY.VRNO = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  BOM_HEAD.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

            


                 $data = DB::select("SELECT BOM_HEAD.PLANT_CODE AS plantCode,BOM_HEAD.VRDATE,BOM_HEAD.SERIES_CODE AS seriesCode,BOM_HEAD.PLANT_CODE AS plantCode,BOM_BODY.* FROM BOM_HEAD LEFT JOIN BOM_BODY ON BOM_HEAD.BOMHID = BOM_BODY.BOMHID WHERE 1=1 $strWhere AND BOM_HEAD.BOM_TYPE ='$action'");

                //dd(DB::getQueryLog());

                $discriptn_page = "Search production bom report by user";
                $this->userLogInsert($loginUser,$vrseq_num,$seriesCode,$discriptn_page,$accountcd);  

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


     public function DailyProductionReport(Request $request){

        $title = "Daily Production Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

       $userdata['contract_list'] = DB::select("SELECT PRODUCTION_HEAD.VRDATE,PRODUCTION_BODY.* FROM PRODUCTION_HEAD LEFT JOIN  PRODUCTION_BODY ON PRODUCTION_HEAD.PRODHID = PRODUCTION_BODY.PRODHID  GROUP BY PRODUCTION_BODY.VRNO");

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

           return view('admin.finance.report.production.daily_production_report',$userdata+compact('title','bank_list','transpoter_list','item_list','acc_list','item_list'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function getDataFromQueryFormDailyProduction(Request $request){


        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date || $request->store_action)) {

                date_default_timezone_set('Asia/Kolkata');

                $action     = $request->store_action;
                $loginUser  = $request->session()->get('userid');
                $vrno       = $request->vr_num;
                $seriesCode = $request->SeriesNoValueId;
                $accountcd  = $request->AccCodeValueId;
                if($vrno){
                    $splivr = explode(' ', $vrno);
                    $vrseq_num = $splivr[2];
                }else{
                    $vrseq_num ='';
                }
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  PRODUCTION_HEAD.PLANT_CODE $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  PRODUCTION_BODY.LAST_UPDATE_DATE $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  PRODUCTION_BODY.VRNO $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  PRODUCTION_HEAD.SERIES_CODE $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  PRODUCTION_BODY.ITEM_CODE $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  PRODUCTION_BODY.QTYRECD $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  PRODUCTION_BODY.REMARK LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  PRODUCTION_HEAD.SERIES_CODE = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  PRODUCTION_BODY.    ITEM_CODE = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  PRODUCTION_BODY.VRNO = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  PRODUCTION_HEAD.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

            


                 $data = DB::select("SELECT PRODUCTION_HEAD.PLANT_CODE AS plantCode,PRODUCTION_HEAD.VRDATE,PRODUCTION_HEAD.SERIES_CODE AS seriesCode,PRODUCTION_HEAD.PLANT_CODE AS plantCode,PRODUCTION_BODY.* FROM PRODUCTION_HEAD LEFT JOIN PRODUCTION_BODY ON PRODUCTION_HEAD.PRODHID = PRODUCTION_BODY.PRODHID WHERE 1=1 $strWhere");

                //dd(DB::getQueryLog());
                $discriptn_page = "Search daily production report by user";
                $this->userLogInsert($loginUser,$vrseq_num,$seriesCode,$discriptn_page,$accountcd); 
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


    public function WoBomReport(Request $request){

        $title = "WoBom Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

       $userdata['contract_list'] = DB::select("SELECT wo_production_heads.vr_date,wo_production_bodies.* FROM wo_production_heads LEFT JOIN wo_production_bodies ON wo_production_heads.id = wo_production_bodies.wo_production_head_id  GROUP BY wo_production_bodies.vrno");

            //print_r($userdata['contract_list']);exit;

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->fy_from_date;
            $userdata['toDate']   =  $key->fy_to_date;
        }

        $bank_list       = DB::table('master_config')->where('tran_code', '=','A0')->orWhere('tran_code', '=','A1')->get();

        $transpoter_list = DB::table('master_party')->get();
        $item_list       = DB::table('master_item_finance')->get();

        $acc_list        = DB::table('master_party')->get();

        if(isset($company_name)){

           return view('admin.finance.report.production.wobom_report',$userdata+compact('title','bank_list','transpoter_list','item_list','acc_list','item_list'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function getDataFromQueryFormProductionWoBom(Request $request){


        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date || $request->store_action)) {

                date_default_timezone_set('Asia/Kolkata');

                $action = $request->store_action;
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  wo_production_heads.plant_code $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  wo_production_bodies.updated_date $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  wo_production_bodies.vrno $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  wo_production_headswo_production_heads.series_code $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  wo_production_bodies.item_code $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  wo_production_bodies.qty_recvd $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  wo_production_bodies.remark LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  wo_production_headswo_production_heads.series_code = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  wo_production_bodies.item_code = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  wo_production_bodies.vrno = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  wo_production_heads.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }

            


                 $data = DB::select("SELECT wo_production_heads.plant_code AS plantCode,wo_production_heads.vr_date,wo_production_heads.series_code AS seriesCode,wo_production_heads.plant_code AS plantCode,wo_production_bodies.* FROM wo_production_heads LEFT JOIN wo_production_bodies ON wo_production_heads.id = wo_production_bodies.wo_production_head_id WHERE 1=1 $strWhere");

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

   
   
    

public function ProductionPdf(Request $request){

        $company_name   = $request->session()->get('company_name');

        $title = 'Production Report';

        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date || $request->store_action)) {

                date_default_timezone_set('Asia/Kolkata');

              $head_table = $request->head_table;
              $body_table = $request->body_table;
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  $head_table.plant_code $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  $body_table.updated_date $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  $body_table.vrno $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  $head_table.series_code $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  $body_table.item_code $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  $body_table.qty_recvd $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  $body_table.remark LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  $head_table.series_code = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  $body_table.item_code = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  $body_table.vrno = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  $head_table.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }

            
                if($body_table=='production_bodies'){

                        $prod_head_id = 'production_head_id';
                    }else if($body_table=='wo_production_bodies'){

                        $prod_head_id = 'wo_production_head_id';
                        
                    }else{

                        $prod_head_id = 'daily_production_head_id';
                    }

                 $data1 = DB::select("SELECT $head_table.plant_code AS plantCode,$head_table.vr_date,$head_table.series_code AS seriesCode,$head_table.plant_code AS plantCode,$body_table.* FROM $head_table LEFT JOIN $body_table ON $head_table.id = $body_table.$prod_head_id WHERE 1=1 $strWhere");

                //dd(DB::getQueryLog());

                 $plant= DB::table('master_plant')->where('comp_name',$company_name)->get()->first();

                //dd(DB::getQueryLog());
                    header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.production.production_pdf_view',compact('data1','company_name','plant','title'));
                      
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
