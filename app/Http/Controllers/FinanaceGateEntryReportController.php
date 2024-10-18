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

class FinanaceGateEntryReportController extends Controller{


    public function __cunstruct(Request $request){

    }

   


    public function GateEntryPurchaseReport(Request $request){

        $title = "Gate Entry Purchase Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

       $userdata['contract_list'] = DB::select("SELECT GRNGATE_HEAD.VRDATE,GRNGATE_BODY.* FROM GRNGATE_HEAD LEFT JOIN GRNGATE_BODY ON GRNGATE_HEAD.GRNGATEHID = GRNGATE_BODY.GRNGATEHID  GROUP BY GRNGATE_BODY.VRNO");

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

           return view('admin.finance.report.gate_entry.gate_entry_purchase_report',$userdata+compact('title','bank_list','transpoter_list','item_list','acc_list','item_list'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function getDataFromQueryFormGateEntryPur(Request $request){


        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date || $request->store_action)) {

                date_default_timezone_set('Asia/Kolkata');

                $action      = $request->store_action;
                $loginUser   = $request->session()->get('userid');
                $seriesCode  = $request->SeriesNoValueId;
                $accountCode = $request->AccCodeValueId;

                $vrnum = $request->vr_num;
                if($vrnum){
                    $splitnum = explode(' ', $vrnum);
                    $vrseqNum = $splitnum[2];
                }else{
                    $vrseqNum ='';
                }
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  GRNGATE_HEAD.PLANT_CODE $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  GRNGATE_BODY.LAST_UPDATE_DATE $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  GRNGATE_BODY.VRNO $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  GRNGATE_HEAD.SERIES_CODE $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  GRNGATE_BODY.ITEM_CODE $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  GRNGATE_BODY.QTYRECD $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  GRNGATE_BODY.REMARK LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  GRNGATE_HEAD.SERIES_CODE = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  GRNGATE_BODY.ITEM_CODE = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  GRNGATE_BODY.VRNO = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  GRNGATE_HEAD.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

            


                 $data = DB::select("SELECT GRNGATE_HEAD.PLANT_CODE AS plantCode,GRNGATE_HEAD.VRDATE as vrdate,GRNGATE_HEAD.SERIES_CODE AS seriesCode,GRNGATE_HEAD.PREFNO,GRNGATE_HEAD.PREFDATE,GRNGATE_HEAD.DEPT_CODE AS accCode,GRNGATE_HEAD.PFCT_CODE AS pfctCode,GRNGATE_BODY.* FROM GRNGATE_HEAD LEFT JOIN GRNGATE_BODY ON GRNGATE_HEAD.GRNGATEHID = GRNGATE_BODY.GRNGATEHID WHERE 1=1 $strWhere");

                //dd(DB::getQueryLog());

                $discriptn_page = "Search gate entry report by user";
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



public function GateEntryReturnReport(Request $request){

        $title = "Gate Entry Return Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

       $userdata['contract_list'] = DB::select("SELECT GP_HEAD.VRDATE,GP_BODY.* FROM GP_HEAD LEFT JOIN GP_BODY ON GP_HEAD.GATEHID = GP_BODY.GATEHID  GROUP BY GP_BODY.VRNO");

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

           return view('admin.finance.report.gate_entry.gate_entry_return_report',$userdata+compact('title','bank_list','transpoter_list','item_list','acc_list','item_list'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function getDataFromQueryFormGateEntryReturn(Request $request){


        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date || $request->return_type)) {

                date_default_timezone_set('Asia/Kolkata');

                $action      = $request->return_type;
                $loginUser   = $request->session()->get('userid');
                $seriesCode  = $request->SeriesNoValueId;
                $accountCode = $request->AccCodeValueId;
                $vrnum       = $request->vr_num;
                if($vrnum){
                    $splivr = explode(' ', $vrnum);
                    $vrseqNum = $splivr[2];
                }else{
                    $vrseqNum ='';
                }
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  GP_HEAD.PLANT_CODE $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  GP_BODY.LAST_UPDATE_DATE $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  GP_BODY.VRNO $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  GP_HEAD.SERIES_CODE $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  GP_BODY.ITEM_CODE $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  GP_BODY.QTYRECD $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  GP_BODY.REMARK LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  GP_HEAD.SERIES_CODE = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  GP_BODY.ITEM_CODE = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  GP_BODY.VRNO = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  GP_HEAD.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

            


                 $data = DB::select("SELECT GP_HEAD.PLANT_CODE AS plantCode,GP_HEAD.VRDATE as vrdate,GP_HEAD.SERIES_CODE AS seriesCode,GP_HEAD.PARTY_REF_NAME,GP_HEAD.PARTY_REF_DATE,GP_HEAD.DEPT_CODE AS accCode,GP_HEAD.PFCT_CODE AS pfctCode,GP_BODY.* FROM GP_HEAD LEFT JOIN GP_BODY ON GP_HEAD.GATEHID = GP_BODY.GATEHID WHERE 1=1 $strWhere AND GP_HEAD.GP_TYPE='$action'");

                //dd(DB::getQueryLog());

                $discriptn_page = "Search gate entry return report by user";
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


    public function GateEntryNonReturnReport(Request $request){

        $title = "Gate Entry Non Return Report";

        $company_name  = $request->session()->get('company_name');
        $macc_year     = $request->session()->get('macc_year');
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $item_um_aum_list = DB::table('master_fy')->where('comp_code',$CCFromSession)->where('fy_code',$macc_year)->get();

       $userdata['contract_list'] = DB::select("SELECT gate_entry_nonreturn_heads.vr_date,gate_entry_nonreturn_bodies.* FROM gate_entry_nonreturn_heads LEFT JOIN gate_entry_nonreturn_bodies ON gate_entry_nonreturn_heads.id = gate_entry_nonreturn_bodies.gate_entry_nonreturn_head_id  GROUP BY gate_entry_nonreturn_bodies.vrno");

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

           return view('admin.finance.report.gate_entry.gate_entry_nonreturn_report',$userdata+compact('title','bank_list','transpoter_list','item_list','acc_list','item_list'));
        }else{

            return redirect('/useractivity');

        }

    }

    public function getDataFromQueryFormGateEntryNonReturn(Request $request){


        if($request->ajax()) {

            if (!empty($request->recNoId || $request->recNoValueId || $request->lastUpId || $request->lastUpValueId || $request->VrNoId || $request->VrNoValueId || $request->SeriesNoId || $request->SeriesNoValueId || $request->AccCodeId || $request->AccCodeValueId || $request->AmountId || $request->AmountValueId || $request->OtherDetailsId || $request->OtherDetValueId || $request->bank_code || $request->acct_code || $request->vr_num || $request->from_date || $request->to_date || $request->store_action)) {

                date_default_timezone_set('Asia/Kolkata');

                $action = $request->store_action;
                
                $strWhere = '';

                if(isset($request->recNoId)  && trim($request->recNoValueId)!=""){
                   
                    $strWhere .= " AND  gate_entry_nonreturn_heads.plant_code $request->recNoId '$request->recNoValueId'";
                } 

                if(isset($request->lastUpId)  && trim($request->lastUpValueId)!="" && empty($request->from_date) && empty($request->to_date)){

                    $newUpDt = date("Y-m-d", strtotime($request->lastUpValueId));
                  
                    $strWhere .= " AND  gate_entry_nonreturn_bodies.updated_date $request->lastUpId '$newUpDt'";

                }

                if(isset($request->VrNoId)  && trim($request->VrNoValueId)!=""){
                    
                    $strWhere .= " AND  gate_entry_nonreturn_bodies.vrno $request->VrNoId '$request->VrNoValueId'";
                }

                if(isset($request->SeriesNoId)  && trim($request->SeriesNoValueId)!=""){
                    
                    $strWhere .= " AND  gate_entry_nonreturn_heads.series_code $request->SeriesNoId '$request->SeriesNoValueId'";
                }

                if(isset($request->AccCodeId)  && trim($request->AccCodeValueId)!=""){
                    $strWhere .= " AND  gate_entry_nonreturn_bodies.item_code $request->AccCodeId '$request->AccCodeValueId'";
                }

                if(isset($request->AmountId)  && trim($request->AmountValueId)!=""){
                    $strWhere .= " AND  gate_entry_nonreturn_bodies.quantity $request->AmountId '$request->AmountValueId'";
                }

                if(isset($request->OtherDetailsId)  && trim($request->OtherDetValueId)!=""){
                    $strWhere .= " AND  gate_entry_nonreturn_bodies.remark LIKE '%$request->OtherDetValueId%'";
                }


                if(isset($request->bank_code) && trim($request->bank_code)!=""){
                   
                    $strWhere .= " AND  gate_entry_nonreturn_heads.series_code = '$request->bank_code'";
                }

                if(isset($request->acct_code) && trim($request->acct_code)!=""){
                  
                    $strWhere .= " AND  gate_entry_nonreturn_bodies.item_code = '$request->acct_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  gate_entry_nonreturn_bodies.vrno = '$request->vr_num'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  gate_entry_nonreturn_heads.vr_date BETWEEN '$FromDt' and  '$ToDt'";
                }

            


                 $data = DB::select("SELECT gate_entry_nonreturn_heads.plant_code AS plantCode,gate_entry_nonreturn_heads.vr_date,gate_entry_nonreturn_heads.series_code AS seriesCode,gate_entry_nonreturn_heads.party_ref_name,gate_entry_nonreturn_heads.party_ref_date,gate_entry_nonreturn_heads.dept_code AS accCode,gate_entry_nonreturn_heads.pfct_code AS pfctCode,gate_entry_nonreturn_bodies.* FROM gate_entry_nonreturn_heads LEFT JOIN gate_entry_nonreturn_bodies ON gate_entry_nonreturn_heads.id = gate_entry_nonreturn_bodies.gate_entry_nonreturn_head_id WHERE 1=1 $strWhere");

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

    
public function GateEntryPdf(Request $request){

        $company_name   = $request->session()->get('company_name');

        $title = 'Gate Entry Purchase';

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
                    $strWhere .= " AND  $body_table.quantity $request->AmountId '$request->AmountValueId'";
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

            
                    if($body_table=='gate_entry_return_bodies'){

                        $gate_entry_head_id = 'gate_entry_return_head_id';
                    }else if($body_table=='gate_entry_nonreturn_bodies'){

                        $gate_entry_head_id = 'gate_entry_nonreturn_head_id';
                        
                    }else{

                        $gate_entry_head_id = 'gate_entry_head_id';
                    }

                 $data1 = DB::select("SELECT $head_table.plant_code AS plantCode,$head_table.vr_date,$head_table.series_code AS seriesCode,$head_table.party_ref_name,$head_table.party_ref_date,$head_table.dept_code AS accCode,$head_table.pfct_code AS pfctCode,$body_table.* FROM $head_table LEFT JOIN $body_table ON $head_table.id = $body_table.$gate_entry_head_id WHERE 1=1 $strWhere");

                //dd(DB::getQueryLog());

                $plant= DB::table('master_plant')->where('comp_name',$company_name)->get()->first();

                //dd(DB::getQueryLog());
                    header('Content-Type: application/pdf');
     

                    $pdf = PDF::loadView('admin.finance.report.gate_entry.gate_entry_pdf_view',compact('data1','company_name','plant','title'));
                      
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
