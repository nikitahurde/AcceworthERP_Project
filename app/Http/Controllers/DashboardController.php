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
class DashboardController extends Controller{

	//public $data;

	public function __construct(Request $request){

		//$this->data = "smit@121";

	}

/* ------------- TOP SALES ------------ */

	public function TopSales(Request $request){

		$title = 'Top Sales';

		$fisYear =  $request->session()->get('macc_year');
		$splitYR = explode('-', $fisYear);
    	$startYEar = $splitYR[0].'-04-01';

    	$comp_nameval     = $request->session()->get('company_name');
	    $explode          = explode('-', $comp_nameval);
	    $getcom_code      = $explode[0];
    	
    	$data['top_sale_list'] = DB::select("SELECT COUNT(SBILL_HEAD.ACC_CODE) as accCount,SBILL_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME,SUM(SBILL_HEAD.DRAMT) as drAmt FROM `SBILL_HEAD`,SBILL_BODY,MASTER_ACC WHERE SBILL_HEAD.SBILLHID=SBILL_BODY.SBILLHID AND SBILL_HEAD.ACC_CODE=MASTER_ACC.ACC_CODE AND (SBILL_HEAD.VRDATE BETWEEN $startYEar AND SBILL_HEAD.VRDATE) AND SBILL_HEAD.COMP_CODE='$getcom_code' AND SBILL_HEAD.FY_CODE='$fisYear' GROUP BY SBILL_HEAD.ACC_CODE ORDER BY accCount DESC limit 10");

    	//$data['help_copm_list'] = DB::table('MASTER_COMP')->Orderby('COMP_CODE', 'desc')->limit(5)->get();

    	return view('admin.top_sales',$data+compact('title'));

	}

/* ------------- TOP SALES ------------ */

/* ----------- TOP ITEM ---------------*/

	public function TopItem(Request $request){

		$title = 'Top Item';

		$fisYear =  $request->session()->get('macc_year');
		$splitYR = explode('-', $fisYear);
    	$startYEar = $splitYR[0].'-04-01';

    	$comp_nameval     = $request->session()->get('company_name');
	    $explode          = explode('-', $comp_nameval);
	    $getcom_code      = $explode[0];

    	$data['top_item_list'] = DB::select("SELECT COUNT(SBILL_BODY.ITEM_CODE) as itemCount,SBILL_BODY.ITEM_CODE,MASTER_ITEM.ITEM_NAME,SBILL_BODY.UM,SUM(SBILL_BODY.DRAMT) as drAmt,SUM(SBILL_BODY.QTYISSUED) as qtyIssued FROM `SBILL_HEAD`,SBILL_BODY,MASTER_ITEM,MASTER_CONFIG WHERE SBILL_HEAD.SBILLHID=SBILL_BODY.SBILLHID AND MASTER_ITEM.ITEM_CODE=SBILL_BODY.ITEM_CODE AND (SBILL_HEAD.VRDATE BETWEEN $startYEar AND SBILL_HEAD.VRDATE) AND SBILL_HEAD.COMP_CODE='$getcom_code' AND SBILL_HEAD.FY_CODE='$fisYear' GROUP BY SBILL_BODY.ITEM_CODE ORDER BY itemCount DESC limit 10");

    	//$data['help_copm_list'] = DB::table('MASTER_COMP')->Orderby('COMP_CODE', 'desc')->limit(5)->get();

    	return view('admin.top_item',$data+compact('title'));

	}

/* ----------- TOP ITEM ---------------*/

/* ----------- TOP DEBITORS --------- */

	public function TopDebitors(Request $request){

		$title = 'Top Debitors';

		$fisYear =  $request->session()->get('macc_year');
		$splitYR = explode('-', $fisYear);
    	$startYEar = $splitYR[0].'-04-01';

    	$comp_nameval     = $request->session()->get('company_name');
	    $explode          = explode('-', $comp_nameval);
	    $getcom_code      = $explode[0];
    	
    	$data['top_sale_list'] = DB::select("SELECT COUNT(SBILL_HEAD.ACC_CODE) as accCount,SBILL_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME,MASTER_ACC.ATYPE_CODE,SUM(SBILL_HEAD.DRAMT) as drAmt FROM `SBILL_HEAD`,SBILL_BODY,MASTER_ACC WHERE SBILL_HEAD.SBILLHID=SBILL_BODY.SBILLHID AND SBILL_HEAD.ACC_CODE=MASTER_ACC.ACC_CODE AND MASTER_ACC.ATYPE_CODE='D' AND (SBILL_HEAD.VRDATE BETWEEN $startYEar AND SBILL_HEAD.VRDATE) AND SBILL_HEAD.COMP_CODE='$getcom_code' AND SBILL_HEAD.FY_CODE='$fisYear' GROUP BY SBILL_HEAD.ACC_CODE ORDER BY accCount DESC limit 10");

    	//$data['help_copm_list'] = DB::table('MASTER_COMP')->Orderby('COMP_CODE', 'desc')->limit(5)->get();

    	return view('admin.top_debitors',$data+compact('title'));

	}

/* ----------- TOP DEBITORS --------- */

/* ----------- TOP CREDITORS ----------- */
	
	public function TopCreditors(Request $request){

		$title = 'Top Creditors';

		$fisYear   =  $request->session()->get('macc_year');
		$splitYR   = explode('-', $fisYear);
		$startYEar = $splitYR[0].'-04-01';

    	$comp_nameval     = $request->session()->get('company_name');
	    $explode          = explode('-', $comp_nameval);
	    $getcom_code      = $explode[0];
    	
    	$data['top_sale_list'] = DB::select("SELECT COUNT(SBILL_HEAD.ACC_CODE) as accCount,SBILL_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME,MASTER_ACC.ATYPE_CODE,SUM(SBILL_HEAD.DRAMT) as drAmt FROM `SBILL_HEAD`,SBILL_BODY,MASTER_ACC WHERE SBILL_HEAD.SBILLHID=SBILL_BODY.SBILLHID AND SBILL_HEAD.ACC_CODE=MASTER_ACC.ACC_CODE AND MASTER_ACC.ATYPE_CODE='C' AND (SBILL_HEAD.VRDATE BETWEEN $startYEar AND SBILL_HEAD.VRDATE) AND SBILL_HEAD.COMP_CODE='$getcom_code' AND SBILL_HEAD.FY_CODE='$fisYear' GROUP BY SBILL_HEAD.ACC_CODE ORDER BY accCount DESC limit 10");

    	//$data['help_copm_list'] = DB::table('MASTER_COMP')->Orderby('COMP_CODE', 'desc')->limit(5)->get();

    	return view('admin.top_creditors',$data+compact('title'));

	}

/* ----------- TOP CREDITORS ----------- */

/*-------Score Card Defination ----*/

public function scoreCardDefination(Request $request){

	$title        = 'Score Card Defination';
	
	$fisYear      = $request->session()->get('macc_year');
	$splitYR      = explode('-', $fisYear);
	$startYEar    = $splitYR[0].'-04-01';

	$comp_nameval = $request->session()->get('company_name');
	$explode      = explode('-', $comp_nameval);
	$getcom_code  = $explode[0];

	$usertype     = $request->session()->get('usertype');
	$userid       = $request->session()->get('userid');

	$tasklist     = '';

        if($userid != ''){
        	
	     $scorelist = DB::select("SELECT p1.EMP_CODE as ECODE,p1.EMP_NAME as ENAME,p2.* FROM EMP_SCORETASK p2 LEFT JOIN EMP_SCORECARD p1 ON p1.SCORECARDID = p2.SCORECARDID WHERE p1.COMP_CODE = '$getcom_code' AND p1.FY_CODE = '$fisYear' ");

             if($scorelist != ''){
        	
        	$tasklist = $scorelist;	
        	
        	}else{
        	 $tasklist = '';
        	 
             }
        	
        }
       

	return view('admin.score_card_defination',compact('title','tasklist'));
    		
}

/*-------End Score Card Defination*/

/* Start Vehical Documentation Updation */
	public function vehicalDocUpdate(Request $request){

		$title        = 'Vehical Documentation Updation';
		
		$fisYear      = $request->session()->get('macc_year');
		$comp_nameval = $request->session()->get('company_name');
		$getcompcode  = explode('-', $comp_nameval);
		$comp_code    = $getcompcode[0];
		$comp_name    = $getcompcode[1];

		$usertype     = $request->session()->get('usertype');
		$userid       = $request->session()->get('userid');
        
        if($userid != ''){
	        	
		    $data = DB::table('FLEET_CERTF_TRAN')->where('COMP_CODE',$comp_code)->get();

		    date_default_timezone_set('Asia/Kolkata');

	            $current_date = date('Y-m-d');

	            $tenday =  date('Y-m-d', strtotime('28 days', strtotime($current_date)));
	            $fiveday =  date('Y-m-d', strtotime('25 days', strtotime($current_date)));
	            $fourday =  date('Y-m-d', strtotime('22 days', strtotime($current_date)));
	            $threeday =  date('Y-m-d', strtotime('21 days', strtotime($current_date)));

	            $extraFiveDay = date('Y-m-d', strtotime('25 days', strtotime($fiveday)));
	            
	            $twoday  =  date('Y-m-d', strtotime('20 days', strtotime($current_date)));
	            $tenDayData = DB::table('FLEET_CERTF_TRAN')->whereBetween('CERTF_RENEW_DATE',[$fiveday,$extraFiveDay])->where('COMP_CODE',$comp_code)->get()->sortBy('CERTF_RENEW_DATE');
                
                $fiveDayData = DB::table('FLEET_CERTF_TRAN')->whereBetween('CERTF_RENEW_DATE',[$threeday,$fourday])->where('COMP_CODE',$comp_code)->get()->sortBy('CERTF_RENEW_DATE');

			    $twoDayData = DB::table('FLEET_CERTF_TRAN')->whereBetween('CERTF_RENEW_DATE',[$current_date,$twoday])->where('COMP_CODE',$comp_code)->get()->sortBy('CERTF_RENEW_DATE'); 
			    
			    $expireData = DB::table('FLEET_CERTF_TRAN')->where('CERTF_RENEW_DATE','<',$current_date)->where('COMP_CODE',$comp_code)->get()->sortBy('CERTF_RENEW_DATE');

			    return view('admin.vehical_doc_update',compact('title','data','expireData','twoDayData','fiveDayData','tenDayData'));
		    
        }
	       

		
	}

	public function TripStatus(Request $request){

		$title        = 'Trips or LR Status';

		$fisYear     =  $request->session()->get('macc_year');
		
		$comp_name   = $request->session()->get('company_name');
		$explode     = explode('-', $comp_name);
		$getcom_code = $explode[0];
		// print_r($getcom_code);exit();

		$do_data = DB::table('DORDER_BODY')->where('COMP_CODE', $getcom_code)->where('FY_CODE',$fisYear)->get();

		$count_doData = count($do_data);

		$tripbody_data = DB::table('TRIP_BODY')->where('COMP_CODE', $getcom_code)->where('FY_CODE',$fisYear)->get();

		$count_tripB =  count($tripbody_data);

        $do_count1=0;

		
		$do_count = 'Status';
		// $countdolr = 'Status';
		// $pending_epod_count = 'Status';
		$countlr_ack = 'Status';
		$countEwb = 'Status';

		// count DO LR PENDING

		$countdo_lr = DB::select("SELECT p1.DO_NO as do_no,p1.DO_DATE as dorder_dt,p1.DO_NO as dorder_no,p1.CP_CODE as cp_code,p1.CP_NAME as cp_name,p1.TO_PLACE as to_place,p1.ITEM_CODE as item_code,p1.ITEM_NAME as item_name,SUM(p1.QTY) as qty,p1.UM as um,p1.ACC_CODE as acc_code,p1.ACC_NAME as acc_name, p3.TRIP_NO as trip_no,p3.VRDATE as trip_dt from TRIP_BODY p1 LEFT JOIN TRIP_HEAD p3 ON p3.TRIPHID = p1.TRIPHID  WHERE p3.COMP_CODE = '$getcom_code' AND p3.FY_CODE = '$fisYear' AND p3.LR_STATUS = 0 group by p3.TRIP_NO");

		$countdolr = count($countdo_lr);

        // COUNT PENDING OUTWARD

        $outward_trip = DB::select("SELECT p1.DO_DATE as dorder_dt,p1.DO_NO as dorder_no,p1.CP_CODE as cp_code,p1.CP_NAME as cp_name,p1.TO_PLACE as to_place,p1.ITEM_CODE as item_code,p1.ITEM_NAME as item_name,SUM(p1.QTY) as qty,p1.UM as um,p1.ACC_CODE as acc_code,p1.ACC_NAME as acc_name, p3.TRIP_NO as trip_no,p3.VRDATE as trip_dt from TRIP_BODY p1 LEFT JOIN TRIP_HEAD p3 ON p3.TRIPHID = p1.TRIPHID WHERE p3.COMP_CODE = '$getcom_code' AND p3.FY_CODE = '$fisYear' AND p3.LR_STATUS = 1 AND p3.GATE_OUT_STATUS=0 group by p3.TRIP_NO");

		$countOutwardPending = count($outward_trip);

		//COUNT PENDING EPOD

		$epodData = DB::select("SELECT H.TRIPHID,B.TRIPHID,H.EPOD_STATUS, B.DO_DATE AS DO_DATE,B.DO_NO AS DO_NUMBER,B.LR_NO,B.LR_DATE,H.VEHICLE_NO,B.CP_CODE,B.CP_NAME,B.ITEM_CODE,B.ITEM_NAME,SUM(B.QTY) AS QTY,B.UM,B.ACC_CODE,B.ACC_NAME FROM TRIP_HEAD H INNER JOIN TRIP_BODY B ON H.TRIPHID = B.TRIPHID WHERE  H.EPOD_STATUS = '0' AND H.LR_STATUS='1' AND B.LR_NO IS NOT NULL AND  H.COMP_CODE ='$getcom_code' AND H.FY_CODE ='$fisYear' GROUP BY H.TRIPHID");

		$pending_epod_count = count($epodData);

		// LR ACK COUNT 

		$countLrAck = DB::select("SELECT p3.TRIPHID,p3.TRIP_NO as trip_no,p3.VEHICLE_NO as vehical_no,p1.ITEM_CODE as item_code,p1.ITEM_NAME as item_name,SUM(p1.QTY) as qty,p1.UM as um,p1.DO_DATE as do_date,p1.DO_NO as DO_NO,p1.CP_CODE as CP_CODE,p1.CP_NAME as CP_NAME,p1.ACC_CODE as ACC_CODE,p1.ACC_NAME as ACC_NAME,p1.LR_NO as LR_NO,p1.LR_DATE as LR_DATE FROM TRIP_BODY p1 LEFT JOIN TRIP_HEAD p3 ON p3.TRIPHID = p1.TRIPHID WHERE p3.COMP_CODE = '$getcom_code' AND p3.EPOD_STATUS = '1' AND p3.LR_ACK_STATUS='0' AND p1.LR_NO IS NOT NULL GROUP BY p3.TRIPHID");


        $countlr_ack = count($countLrAck);


		return view('admin.trips_status',compact('title','do_count','countdolr','pending_epod_count','countlr_ack','countEwb','countOutwardPending'));

 	
	}

// End vehical documentation updation

/* --------- OPEN ORDER ------------- */
	
	public function openOrdr(Request $request){

		$title = 'Open Order';
		$comp_nameval     = $request->session()->get('company_name');
		

		$fisYear   =  $request->session()->get('macc_year');
		$splitYR   = explode('-', $fisYear);
		$startYEar = $splitYR[0].'-04-01';

    	$comp_nameval     = $request->session()->get('company_name');
	    $explode          = explode('-', $comp_nameval);
	    $getcom_code      = $explode[0];
	
		//DB::enableQueryLog();

		$data['open_order'] = DB::select("SELECT SORDERHID,ITEM_CODE,ITEM_NAME,SUM(ORDERQTY) as OrderQty,SUM(QTYISSUED) as qtyIssued,DRAMT,(CASE WHEN SUM(ORDERQTY)=SUM(QTYISSUED) THEN 'COMPLETE' ELSE 'PENDING' END)AS status FROM `SORDER_BODY` WHERE COMP_CODE='$getcom_code' AND FY_CODE='$fisYear' GROUP BY SORDER_BODY.ITEM_CODE");

	   //dd(DB::getQueryLog());

		return view('admin.open_order',$data+compact('title'));
    		
	}

	

	public function showDetailOfOpenOrdr(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$CompanyCode = $request->session()->get('company_name');
			$spliCode    = explode('-', $CompanyCode);
			$comp_code   = $spliCode[0];
			$macc_year   = $request->session()->get('macc_year');
			$headId      = $request->input('headid');
			$item_code   = $request->input('itemCd');
 	
 			//DB::enableQueryLog();

			$ordrDetl = DB::select("SELECT SORDER_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME,SORDER_BODY.VRDATE,SORDER_BODY.VRNO,SORDER_BODY.SERIES_CODE,SORDER_BODY.FY_CODE,SUM(SORDER_BODY.ORDERQTY) as OrderQty,SUM(SORDER_BODY.QTYISSUED) as IssuedQty,SORDER_BODY.ITEM_CODE,SORDER_BODY.ITEM_NAME FROM SORDER_HEAD,SORDER_BODY,MASTER_ACC WHERE SORDER_HEAD.SORDERHID=SORDER_BODY.SORDERHID AND SORDER_HEAD.ACC_CODE=MASTER_ACC.ACC_CODE AND SORDER_BODY.ITEM_CODE='$item_code' AND SORDER_HEAD.COMP_CODE='$comp_code' AND SORDER_HEAD.FY_CODE='$macc_year' GROUP BY SORDER_HEAD.ACC_CODE");


			//dd(DB::getQueryLog());

    		if ($ordrDetl) {

    			$response_array['response'] = 'success';
	            $response_array['data_ordrDetl'] = $ordrDetl;

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data_ordrDetl'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data_ordrDetl'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }
	}
	
/* --------- OPEN ORDER ------------- */


	/* --------- START: OPEN ORDER ------------- */

	public function AgeAnalysis(Request $request){

		$title = 'Age-Analysis';
		$comp_nameval     = $request->session()->get('company_name');
		
		$fisYear   =  $request->session()->get('macc_year');
		$splitYR   = explode('-', $fisYear);
		$startYEar = $splitYR[0].'-04-01';

    	$comp_nameval     = $request->session()->get('company_name');
	    $explode          = explode('-', $comp_nameval);
	    $getcom_code      = $explode[0];
    	
		//DB::enableQueryLog();

		$data['accTypeList'] = DB::table('MASTER_ACCTYPE')->get();

		$data['age_analysis'] = DB::select("SELECT SERIES_CODE,FY_CODE,ACC_CODE,ACC_NAME, VRNO, VRDATE, DRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, DRAMT, 0) AS ZEROTOTHRTEE,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, DRAMT, 0) AS THARTIONETOSIXTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, DRAMT, 0) AS SIXTYONETONINTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, DRAMT, 0) AS NINTYONETOONEEAIGHTY,IF(DATEDIFF(CURDATE(), VRDATE) > 180, DRAMT, 0) AS ONEEAIGHTYTOABOVE FROM ACC_TRAN WHERE DRAMT>0 GROUP BY ACC_CODE ORDER BY DAYS DESC");

	   //dd(DB::getQueryLog());

		return view('admin.age-analysis',$data+compact('title'));
    		
	}

	public function getPaytyTypeWiseAgeAnalysisData(Request $request){

		$compName = $request->session()->get('company_name');

	      

	       if ($request->accType!='') {

	       		$accType = $request->accType;

		        $userid    = $request->session()->get('userid');

		        $userType = $request->session()->get('usertype');

		        $compName = $request->session()->get('company_name');

		        $compcode    = explode('-', $compName);

				$getcompcode =	$compcode[0];

		        $fisYear =  $request->session()->get('macc_year');

		        $data1 = DB::select("SELECT T.SERIES_CODE,T.FY_CODE,T.ACC_CODE,T.ACC_NAME,T.VRNO,T.VRDATE,T.DRAMT, DATEDIFF(CURDATE(), T.VRDATE) AS DAYS,IF(DATEDIFF(CURDATE(), T.VRDATE) BETWEEN 0 AND 30, T.DRAMT, 0) AS ZEROTOTHRTEE,IF(DATEDIFF(CURDATE(), T.VRDATE) BETWEEN 31 AND 60, T.DRAMT, 0) AS THARTIONETOSIXTY,IF(DATEDIFF(CURDATE(), T.VRDATE) BETWEEN 61 AND 90, T.DRAMT, 0) AS SIXTYONETONINTY,IF(DATEDIFF(CURDATE(), T.VRDATE) BETWEEN 91 AND 180, T.DRAMT, 0) AS NINTYONETOONEEAIGHTY,IF(DATEDIFF(CURDATE(), T.VRDATE) > 180, T.DRAMT, 0) AS ONEEAIGHTYTOABOVE FROM ACC_TRAN T INNER JOIN MASTER_ACC A ON T.ACC_CODE = A.ACC_CODE INNER JOIN MASTER_ACCTYPE M ON A.ATYPE_CODE = M.ATYPE_CODE WHERE T.DRAMT>0 AND M.ATYPE_CODE = '$accType' GROUP BY ACC_CODE ORDER BY DAYS DESC");

		        // echo '<PRE>'; print_r($data);exit();
		        
		    	return DataTables()->of($data1)->addIndexColumn()->make(true);

	    	}else{

	    		$data = DB::select("SELECT SERIES_CODE,FY_CODE,ACC_CODE,ACC_NAME, VRNO, VRDATE, DRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, DRAMT, 0) AS ZEROTOTHRTEE,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, DRAMT, 0) AS THARTIONETOSIXTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, DRAMT, 0) AS SIXTYONETONINTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, DRAMT, 0) AS NINTYONETOONEEAIGHTY,IF(DATEDIFF(CURDATE(), VRDATE) > 180, DRAMT, 0) AS ONEEAIGHTYTOABOVE FROM ACC_TRAN WHERE DRAMT>0 GROUP BY ACC_CODE ORDER BY DAYS DESC");

                  // echo '<PRE>';print_r($data);exit();
	    		return DataTables()->of($data)->addIndexColumn()->make(true);

	    	}
	  

	    if(isset($compName)){
	       return redirect('/Dashboard/Age-Analysis');
	    }else{
			return redirect('/useractivity');
		}

	}

	public function partyWiseBarGraph(Request $request){

		$partyCode  = $request->input('acc_code');

		$response_array = array();

		if ($partyCode!='') {

			$getData = DB::select("SELECT SERIES_CODE,FY_CODE,ACC_CODE,ACC_NAME, VRNO, VRDATE, DRAMT, DATEDIFF(CURDATE(), VRDATE) AS DAYS,SUM(IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, DRAMT, 0)) AS ZEROTOTHRTEE,SUM(IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, DRAMT, 0)) AS THARTIONETOSIXTY,SUM(IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, DRAMT, 0)) AS SIXTYONETONINTY,SUM(IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, DRAMT, 0)) AS NINTYONETOONEEAIGHTY,SUM(IF(DATEDIFF(CURDATE(), VRDATE) > 180, DRAMT, 0)) AS ONEEAIGHTYTOABOVE FROM ACC_TRAN WHERE ACC_CODE='$partyCode' AND DRAMT>0 ORDER BY DAYS DESC");

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

	/* --------- END: OPEN ORDER ------------- */

	/* ------------- start add user t code --------- */

	public function userTcodeForm(Request $request){

		$userFormData = DB::table('USERACCESS_FORM')->get();

		return view('admin.userTcodeForm',compact('userFormData'));
	}

	public function SaveUserTcodeForm(Request $request){

		$userid	= $request->session()->get('userid');
		$usertype	= $request->session()->get('usertype');

			$data = array(
				"USER_CODE"  => $request->input('user_code'),
				"FORM_CODE"  => $request->input('form_code'),
				"FORM_NAME"  => $request->input('form_name'),
				"CREATED_BY" => $userid,
			);

			$saveData = DB::table('MASTER_USERTCODE')->insert($data);

			if ($saveData) {

			$request->session()->flash('alert-success', 'Successfully Added...!');
			if($usertype=='CRM'){
				return redirect('/crmdashboard');
			}else{
				return redirect('/dashboard');
			}
			

			} else {

				$request->session()->flash('alert-error', ' 
					Can Not Added...!');

				if($usertype=='CRM'){
				return redirect('/crmdashboard');
					}else{
						return redirect('/dashboard');
					}
			}

	}

	public function DeleteUserCode(Request $request){
		$id = $request->input('usertcodeId');

		$usertype	= $request->session()->get('usertype');


		if ($id!='') {

			$Delete = DB::table('MASTER_USERTCODE')->where('USERTCODEID', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Data Was Deleted Successfully...!');

			if($usertype=='CRM'){
				return redirect('/crmdashboard');
			}else{
			    return redirect('/dashboard');
			}
		

			} else {

			$request->session()->flash('alert-error', 'Data Can Not Deleted...!');
			if($usertype=='CRM'){
				return redirect('/crmdashboard');
			}else{
			    return redirect('/dashboard');
			}

			}

		}else{

			$request->session()->flash('alert-error', 'Data Not Found...!');
			if($usertype=='CRM'){
				return redirect('/crmdashboard');
			}else{
			    return redirect('/dashboard');
			}

		}

	}

	/* ------------- end add user t code --------- */

	/* --------- start assign task to user ---------- */

	public function AssignTaskUser(Request $request){
		$userid	= $request->session()->get('userid');
		$vrDate = $request->input('vr_date');
		$targetDate = $request->input('target_date');
		$tr_vr_date     = date("Y-m-d", strtotime($vrDate));
		$target_date     = date("Y-m-d", strtotime($targetDate));

				$data = array(
				"VRDATE"        => $tr_vr_date,
				"FROM_USERCODE" => $request->input('from_user_Code'),
				"TO_USERCODE"   => $request->input('to_user_Code'),
				"TASK_CODE"     => $request->input('task_code'),
				"TASK_NAME"     => $request->input('taskName'),
				"TARGET_DATE"   => $target_date,
				"DESCRIPTION"   => $request->input('description'),
				"CREATED_BY"    => $userid,
			);

			$saveData = DB::table('TASK_TRAN')->insert($data);

			if ($saveData) {

				$response_array['response'] = 'success';
	            $data = json_encode($response_array);
	            print_r($data);

			} else {

				$response_array['response'] = 'error';
	            $data = json_encode($response_array);
	            print_r($data);

			}

	}

	/* --------- end assign task to user ---------- */

	/* -------------- start update task status of user ---------- */

	public function updateTaskStatus(Request $request){

		$userid       = $request->session()->get('userid');
		$vrDate       = $request->input('vrDateUP');
		$update_date  = date("Y-m-d", strtotime($vrDate));
		$remark       = $request->input('remarkUP');
		$taskTranId   = $request->input('uniqTaskId');
		$closeDate    = $request->input('closeDate');
		$close_date  = date("Y-m-d", strtotime($closeDate));
		$close_remark = $request->input('close_remark');

		$data = array(
			"TASKID"     => $taskTranId,
			"VRDATE"     => $update_date,
			"REMARK"     => $remark,
			"CREATED_BY" => $userid,
		);

		$saveData = DB::table('TASKTRACK_TRAN')->insert($data);

		if($close_date!='' && $close_remark !=''){
			$closedata = array(
				"CL_DATE"   => $close_date,
				"CL_REMARK" => $close_remark,
				"STATUS"    => '1',
			);

			$saveData1 = DB::table('TASK_TRAN')->where('TASKID',$taskTranId)->update($closedata);
		}

		if ($saveData) {

			$response_array['response'] = 'success';
            $data = json_encode($response_array);
            print_r($data);

		} else {

			$response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);

		}

	}
	/* -------------- end update task status of user ---------- */

	/* -------------- start save reply from user to user task of user ----------- */

	public function replyTaskStatus(Request $request){

		$userid      = $request->session()->get('userid');
		$openVrDt    = $request->input('openVrDt');
		$update_date = date("Y-m-d", strtotime($openVrDt));
		$openRemark  = $request->input('openRemark');
		$taskTranId  = $request->input('tranTaskId');

		$data = array(
			"TASKID"     => $taskTranId,
			"VRDATE"     => $update_date,
			"REMARK"     => $openRemark,
			"CREATED_BY" => $userid,
		);

		$saveData = DB::table('TASKTRACK_TRAN')->insert($data);
		
		if ($saveData) {

			$response_array['response'] = 'success';
            $data = json_encode($response_array);
            print_r($data);

		} else {

			$response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);

		}

	}

	/* -------------- end save reply from user to user task of user ----------- */

	/* ---------- start save task track ---------------*/

	public function SaveClosedTransTrack(Request $request){

		$userid     = $request->session()->get('userid');
		$transId    =  $request->input('taskTranId');
		$closedTask =  $request->input('closedTask');

		$data = array(
			"STATUS"     =>$closedTask,
		);

		$saveData = DB::table('TASK_TRAN')->where('TASKID',$transId)->update($data);

		if ($saveData) {

			$response_array['response'] = 'success';
            $data = json_encode($response_array);
            print_r($data);

		} else {

			$response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);

		}

	}

	/* ---------- end save task track -----------------*/

	/*------------- start fetch data against task of user --------- */

	public function fetchAlTaskOfUser(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$taskID = $request->input('uniqId');
	    	
	    
	    	//DB::enableQueryLog();
	    	$fetch_reocrd = DB::select("SELECT TASKTRACK_TRAN.*,MASTER_USER.USER_CODE,MASTER_USER.USER_NAME,MASTER_USER.ACC_CODE,MASTER_USER.ACC_NAME,MASTER_USER.EMAIL_ID,MASTER_USER.USER_TYPE,MASTER_USER.CREATED_BY FROM `MASTER_USER`,TASKTRACK_TRAN WHERE TASKTRACK_TRAN.CREATED_BY=MASTER_USER.USER_CODE AND TASKTRACK_TRAN.TASKID='$taskID'");
	    	//dd(DB::getQueryLog());


    		if ($fetch_reocrd) {

    			$response_array['response'] = 'success';
	            $response_array['task_data'] = $fetch_reocrd ;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['task_data'] = '' ;

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

	/*------------- end fetch data against task of user --------- */

	/* ---Start Trips/Lr Status ---*/
	// DO PLANNING

	public function DoPlanning(Request $request){
		
		$compName   = $request->session()->get('company_name');
	   
	    $fisYear  =  $request->session()->get('macc_year');

	    $getcomcode    = explode('-', $compName);
		
		$comp_code = $getcomcode[0];

		if ($request->ajax()) {

			if(!empty($request->acc_code  || $request->series_code)) {

					$accCode = $request->acc_code;
				    $seriesCode = $request->series_code;
	                $strWhere ='';
					
					if(isset($seriesCode)  && trim($seriesCode)!="")
					{
						$strWhere.="AND t1.SERIES_CODE= '$seriesCode'";
						
					}

					if(isset($accCode)  && trim($accCode)!="")
					{
						$strWhere.="AND t1.ACC_CODE= '$accCode'";
						
					}

					if(isset($accCode)  && isset($seriesCode))
					{
						$strWhere.="AND t1.SERIES_CODE= '$seriesCode' AND t1.ACC_CODE= '$accCode'";
						
					}

					if($accCode ==''  && $seriesCode== '')
					{
						$strWhere.="AND t1.SERIES_CODE= '' AND t1.ACC_CODE= ''";
						
					}

					
					// DB::enableQueryLog();
			    	$data = DB::select("SELECT t1.DORDER_DATE as do_date,t1.DORDER_NO,t1.CP_CODE,t1.CP_NAME,t1.TO_PLACE,t1.ITEM_CODE,t1.ITEM_NAME,t1.QTY,t1.UM,t1.ACC_CODE,t1.ACC_NAME,t1.SERIES_CODE,t1.ALIAS_ITEM_CODE,t1.ALIAS_ITEM_NAME,t1.RAKE_NO,t1.DO_WAGON_NO FROM DORDER_BODY t1 LEFT JOIN DORDER_HEAD t2 ON t2.ACC_CODE = t1.ACC_CODE AND t2.DORDERHID = t1.DORDERHID   WHERE (t1.QTY - t1.DISPATCH_PLAN_QTY > 0) AND  1=1 $strWhere  AND t1.COMP_CODE='$comp_code' AND t1.FY_CODE ='$fisYear'");
			  		 // dd(DB::getQueryLog());

			   		  return DataTables()->of($data)->make(true);
					
				}else if($request->allData == 'blank'){
					// DB::enableQueryLog();

					$data = DB::select("SELECT t1.DORDER_DATE as do_date,t1.DORDER_NO,t1.CP_CODE,t1.CP_NAME,t1.TO_PLACE,t1.ITEM_CODE,t1.ITEM_NAME,t1.QTY,t1.UM,t1.ACC_CODE,t1.ACC_NAME,t1.SERIES_CODE,t1.ALIAS_ITEM_CODE,t1.ALIAS_ITEM_NAME,t1.RAKE_NO,t1.DO_WAGON_NO FROM DORDER_BODY t1 LEFT JOIN DORDER_HEAD t2 ON t2.ACC_CODE = t1.ACC_CODE AND t2.DORDERHID = t1.DORDERHID   WHERE (t1.QTY - t1.DISPATCH_PLAN_QTY > 0)  AND t1.COMP_CODE='$comp_code' AND t1.FY_CODE ='$fisYear' ORDER BY t1.DORDER_DATE");
					 // dd(DB::getQueryLog());

					return DataTables()->of($data)->make(true);

				}else{

					$data = array();
				    return DataTables()->of($data)->make(true);
				}

			}else{

				$title = 'DO Planning Pending';
				
				$acc_list = DB::table('DORDER_HEAD')->where('COMP_CODE', $comp_code)->where('FY_CODE',$fisYear)->groupBy('ACC_CODE')->get();

				$series_list = DB::table('DORDER_HEAD')->where('COMP_CODE', $comp_code)->where('FY_CODE',$fisYear)->groupBy('SERIES_CODE')->get();
				
				return view('admin.finance.report.trips_status.do_planning_pending',compact('title','acc_list','series_list'));
			}

		
	}

	public function DoLrPending(Request $request){

		$title = 'DO for LR Pending';
		
		$fisYear     =  $request->session()->get('macc_year');
		
		$comp_name   = $request->session()->get('company_name');
		$explode     = explode('-', $comp_name);
		$getcom_code = $explode[0];

		if($request->ajax()){

			$data = DB::select("SELECT p1.DO_NO as do_no,p1.DO_DATE as dorder_dt,p1.DO_NO as dorder_no,p1.CP_CODE as cp_code,p1.CP_NAME as cp_name,p1.TO_PLACE as to_place,p1.ITEM_CODE as item_code,p1.ITEM_NAME as item_name,SUM(p1.QTY) as qty,p1.UM as um,p1.ACC_CODE as acc_code,p1.ACC_NAME as acc_name, p3.TRIP_NO as trip_no,p3.VRDATE as trip_dt from TRIP_BODY p1 LEFT JOIN TRIP_HEAD p3 ON p3.TRIPHID = p1.TRIPHID  WHERE p3.COMP_CODE = '$getcom_code' AND p3.FY_CODE = '$fisYear' AND p3.LR_STATUS = 0 group by p3.TRIP_NO");

			return DataTables()->of($data)->make(true);


		}else{

			return view('admin.finance.report.trips_status.do_lr_pending',compact('title'));
		}
		
		

	}

	public function PendingOutwordTrip(Request $request){

		$title = 'Pending Outward Trip';
		
		$fisYear     =  $request->session()->get('macc_year');
		
		$comp_name   = $request->session()->get('company_name');
		$explode     = explode('-', $comp_name);
		$getcom_code = $explode[0];

		if($request->ajax()){

			$data = DB::select("SELECT p1.DO_DATE as dorder_dt,p1.DO_NO as dorder_no,p1.CP_CODE as cp_code,p1.CP_NAME as cp_name,p1.TO_PLACE as to_place,p1.ITEM_CODE as item_code,p1.ITEM_NAME as item_name,SUM(p1.QTY) as qty,p1.UM as um,p1.ACC_CODE as acc_code,p1.ACC_NAME as acc_name, p3.TRIP_NO as trip_no,p3.VRDATE as trip_dt,p3.VEHICLE_NO from TRIP_BODY p1 LEFT JOIN TRIP_HEAD p3 ON p3.TRIPHID = p1.TRIPHID WHERE p3.COMP_CODE = '$getcom_code' AND p3.FY_CODE = '$fisYear' AND p3.LR_STATUS = 1 AND p3.GATE_OUT_STATUS=0 group by p3.TRIP_NO");

			// echo '<PRE>';print_r($data);exit;

			return DataTables()->of($data)->make(true);


		}else{

			return view('admin.finance.report.trips_status.outward_pending',compact('title'));
		}
		
		

	}

	public function epodstatus(Request $request){


		$title = 'EPOD Status';
		
		$fisYear     =  $request->session()->get('macc_year');
		
		$comp_name   = $request->session()->get('company_name');
		$explode     = explode('-', $comp_name);
		$getcom_code = $explode[0];

		if($request->ajax()){

		$data = DB::select("SELECT H.TRIPHID,B.TRIPHID,H.EPOD_STATUS, B.DO_DATE AS DO_DATE,B.DO_NO AS DO_NUMBER,B.LR_NO,B.LR_DATE,H.VEHICLE_NO,B.CP_CODE,B.CP_NAME,B.ITEM_CODE,B.ITEM_NAME,SUM(B.QTY) AS QTY,B.UM,B.ACC_CODE,B.ACC_NAME FROM TRIP_HEAD H INNER JOIN TRIP_BODY B ON H.TRIPHID = B.TRIPHID WHERE  H.LR_STATUS = '1' AND H.EPOD_STATUS = '0' AND B.LR_NO IS NOT NULL  AND  H.COMP_CODE = '$getcom_code' AND H.FY_CODE = '$fisYear' GROUP BY H.TRIPHID");

		return DataTables()->of($data)->make(true);
  

		}else{

			return view('admin.finance.report.trips_status.epod_pending',compact('title'));

		}
		
		
		
	}

	public function ewaybill(Request $request){

		$title = 'E-Way bill No';

		$fisYear     =  $request->session()->get('macc_year');
		
		$comp_name   = $request->session()->get('company_name');
		$explode     = explode('-', $comp_name);
		$getcom_code = $explode[0];

       $ewaybill_info = DB::select("SELECT H.TRIPHID,B.TRIPHID,H.LR_ACK_STATUS, D.VRDATE AS DO_DATE,D.DORDER_NO AS DO_NUMBER,B.LR_NO,B.LR_DATE,H.VEHICLE_NO,D.CP_CODE,D.CP_NAME,B.ITEM_CODE,B.ITEM_NAME, B.QTY,B.UM,B.ACC_CODE,B.INVC_NO,B.ACC_NAME,B.EBILL_NO, B.EWAYB_VALIDDT FROM TRIP_HEAD H INNER JOIN TRIP_BODY B ON H.TRIPHID = B.TRIPHID INNER JOIN DORDER_BODY D ON B.DO_NO = D.DORDER_NO AND B.SLNO = D.SLNO WHERE  H.LR_STATUS = 1 AND H.LR_ACK_STATUS = 0 AND B.EBILL_NO != 'NULL'AND H.COMP_CODE = '$getcom_code' AND H.FY_CODE = '$fisYear'");

       // echo '<PRE>';print_r($ewaybill_info);exit();

		$countEwb = count($ewaybill_info);
		
		$ewbvalid_data = array();

		return view('admin.finance.report.trips_status.e-way-bill',compact('title','ewaybill_info'));
	}

	public function refreshEwb(Request $request){
     
        $title = 'E-Way bill No';

		$token  = $request->session()->get('ewaybill_token');

		$ewbvalid_data = array();

		$ewbNo = $request->ewbNo;
			// echo '<PRE>'; print_r($ewbNo);exit();
		$gstin = '05AAAAT2562R1Z3';

	    $authorization = "Authorization: Bearer ".$token;

	    if ($request->ajax()) {

	    if($ewbNo != ''){

    		$curl = curl_init();

	        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
	    
			curl_setopt($curl, CURLOPT_URL, "https://dev.api.easywaybill.in/ezewb/v1/ewb/refreshEwb?ewbNo=".$ewbNo."&gstin=".$gstin."");

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

			$result = curl_exec($curl);

			curl_close($curl);

			$data1 = json_decode($result, true);

			if($data1){
				$response_array['response'] = 'success';
	            $response_array['info'] = $data1;

	            echo $data = json_encode($response_array);
			}else{
				$response_array['response'] = 'error';
	            $response_array['info'] = '';

	            echo $data = json_encode($response_array);
			}
			// echo '<PRE>';print_r($data1);

		}else{

	    }

	    }else{

	    }  

	    // }

	}

    // Eway bill extend validity
    public function extendEwb(Request $request){

     // if($request->ajax()) {

		$ewbNo             = $request->ewbNo;
		$vehicleNo         = $request->vehicleNo;
		$fromPlace         = $request->fromPlace;
		$fromState         = $request->fromState;
		$remainingDistance = $request->remainingDistance;
		$transDocNo        = $request->transDocNo;
		// $transDocDate      = date('d/m/Y',strtotime($request->transDocDate));
		$transDocDate      = $request->transDocDate;
         
		$transMode         = $request->transMode;
		$extnRsnCode       = $request->extnRsnCode;
		$extnRemarks       = $request->extnRemarks;
		$userGstin         = $request->userGstin;
		$fromPincode       = $request->fromPincode;
		$transitType       = $request->transitType;
		$consignmentStatus = $request->consignmentStatus;
    	
        $gstin = '05AAAAT2562R1Z3';

        $token  = $request->session()->get('ewaybill_token');

        // $token  = "eyJhbGciOiJIUzI1NiJ9.eyJzIjowLCJ1IjoxNTcsImV4cCI6MTY3MzAxMTEzMCwiaWF0IjoxNjcyOTg5NTMwLCJuIjoiSGFpIGxvZ2ljcyIsIm8iOjR9.yevtiqP0z7FEv7f_aFlr3ED4ZGbZTs4cSvW5Iko65dg";

	    $authorization = "Authorization: Bearer ".$token;

	    $data = array( 
				"ewbNo"             => $ewbNo,
				"vehicleNo"         => $vehicleNo, 
				"fromPlace"         => $fromPlace,
				"fromState"         => $fromState,
				"remainingDistance" => $remainingDistance,
				"transDocNo"        => $transDocNo,
				"transDocDate"      => $transDocDate,
				"transMode"         => $transMode,
				"extnRsnCode"       => $extnRsnCode,
				"extnRemarks"       => $extnRemarks,
				"userGstin"         => $gstin ,
				"transitType"       => null,
				"addressLine1"      => null,
				"addressLine2"      => null,
				"fromPincode"       => $fromPincode,
				"addressLine3"      => null,
				"consignmentStatus" => $consignmentStatus ,

		);

		$payload = json_encode($data);
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
    
		curl_setopt($curl, CURLOPT_URL, "https://dev.api.easywaybill.in/ezewb/v1/ewb/extendValidityByNo?gstin=".$gstin."");

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $payload );

		$result = curl_exec($curl);

		curl_close($curl);

		$data1 = json_decode($result, true);
		
		if($request->ajax()) {

	    if($data1['status'] == 1){

	    	$response_array['response'] = 'success';
	    	$response_array['valid_data'] = $data1['response'];
	    	$response_array['message'] = $data1['message'];
            
            echo $data = json_encode($response_array);
           //print_r($data);

	    }else if($data1['status'] == 0){

	    	$response_array['response'] = 'error';
	    	$response_array['valid_data'] = '';
	    	$response_array['message'] = $data1['errorList'][0]['message'];
            
            echo $data = json_encode($response_array);
           // print_r($data);

	    }

     }
    }

	public function updateEwbValidUpto(Request $request){

		$ewbNo       = $request->ewbNo;
		$validUpto   = $request->validUpto;
		$fisYear     =  $request->session()->get('macc_year');
		
		$comp_name   = $request->session()->get('company_name');
		$explode     = explode('-', $comp_name);
		$comp_code = $explode[0];
        
        if($request->ajax()){

        	$data = array(
	         "EWAYB_VALIDDT" => $validUpto
	        );

        	$update_date = DB::table('TRIP_HEAD')->where('COMP_CODE',$comp_code)->where('EBILL_NO', $ewbNo)->where('LR_ACK_STATUS',0)->update($data);

        	if($update_date){

        		$response_array['response']='success';
        		$response_array['data'] = '';
        		echo $data = json_encode($response_array);

        	}else{

        		$response_array['response']='error';
        		$response_array['data'] = '';
        		echo $data = json_encode($response_array);


        	}
        }
		
    }

	public function lrAckstatus(Request $request){

		$title = 'LR Ack Status';
		
		$fisYear     =  $request->session()->get('macc_year');
		
		$comp_name   = $request->session()->get('company_name');
		$explode     = explode('-', $comp_name);
		$getcom_code = $explode[0];

		if($request->ajax()){

			
			$data = DB::select("SELECT p3.TRIPHID,p3.TRIP_NO as trip_no,p3.VEHICLE_NO as vehical_no,p1.ITEM_CODE as item_code,p1.ITEM_NAME as item_name,SUM(p1.QTY) as qty,p1.UM as um,p1.DO_DATE as do_date,p1.DO_NO as DONO,p1.CP_CODE as CP_CODE,p1.CP_NAME as CP_NAME,p1.ACC_CODE as ACC_CODE,p1.INVC_NO AS INVCNO,p1.INVC_DATE AS INVCDATE,p1.ACC_NAME as ACC_NAME,p1.LR_NO as LR_NO,p1.LR_DATE as LR_DATE FROM TRIP_HEAD p3 LEFT JOIN  TRIP_BODY p1 ON p3.TRIPHID = p1.TRIPHID WHERE p3.COMP_CODE = '$getcom_code' AND p3.EPOD_STATUS = '1' AND p3.LR_ACK_STATUS='0' AND p1.LR_NO IS NOT NULL GROUP BY p3.TRIPHID");

			return DataTables()->of($data)->make(true);

		}else{

		return view('admin.finance.report.trips_status.lr_ack_pending',compact('title'));
		}
		


	}


	/* ---End Trips/Lr Status ---*/


	/* START : TRACK VEHICLE ETRAN API */
		
	public function TrackVehicle(Request $request){

		$title        = 'Track Vehicle';

		/* SESSION */
		
		$fisYear      = $request->session()->get('macc_year');
		$splitYR      = explode('-', $fisYear);
		$startYEar    = $splitYR[0].'-04-01';

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		$usertype     = $request->session()->get('usertype');
		$userid       = $request->session()->get('userid');
        
		$response_array['vehicle_list'] = DB::table('VEHICLE_GPS_TRAN')->get()->toArray();
		   
		if(isset($comp_nameval)){

		    return view('admin.track_vehicle',compact('title'));

		}else{

			return redirect('/useractivity');

		}
	      


	}

	public function getSyncAllVehicleeTrans(Request $request){


		$fisYear      = $request->session()->get('macc_year');
		$splitYR      = explode('-', $fisYear);
		$startYEar    = $splitYR[0].'-04-01';

		$compCodeName = $request->session()->get('company_name');
		$explode      = explode('-', $compCodeName);
		$getcom_code  = $explode[0];

		$usertype     = $request->session()->get('usertype');
		$userid       = $request->session()->get('userid');
		$interNetStatus = $request->session()->get('internet_status');
		$response_array = array();

	
		if ($request->ajax()) {


			if(!empty($request->getParameters) && $request->getParameters == 'Dashboard') {

					
			DB::table('VEHICLE_GPS_TRAN')->truncate();

	
		/* --------------- START : e-Trans API ------------------- */

	    		$ch = curl_init('https://etranssolutions.com/eTransRestApi/reports/location');
			
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','username:shreyasho','password:10hstc4Xa3ODTW9f61'));
				
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				
				$result = curl_exec($ch);

				curl_close($ch);

				$e_trans = json_decode($result, true);

				
				if($e_trans['result']){

					$eTrans = count($e_trans['result']);

					$saveData = array();
					$saveData1 = array();

					foreach ($e_trans['result'] as $row) {

						$velNo = $row['vehicleNo'];


								$data = array(
									"VEHICLE_NO"   => $row['vehicleNo'],
									"ENTITY_NAME"  => $row['entityName'],
									"VEHICLE_TIME" => $row['timestamp'],
									"LATITUDE"     => $row['latitude'],
									"LONGITUDE"    => $row['longitude'],
									"SPEED"        => $row['speed'],
									"DISTANCE"     => $row['distance'],
									"IGNITION"     => $row['ignition'],
									"ANGLE"        => $row['angle'],
									"LOCATION"     => '',
									"BATTERY"      => $row['battery'],
									"FLAG"        	=> 0,
									"CREATED_BY"   => $userid,
								);

								$saveData[] = DB::table('VEHICLE_GPS_TRAN')->insert($data);

								$gpsTranId = DB::getPdo()->lastInsertId();

								$velNo = $row['vehicleNo'];
							
								$TRIPDATA = DB::select("SELECT H.PLANT_CODE,H.PLANT_NAME,H.ACC_CODE,H.ACC_NAME,H.TRIP_NO,H.VRDATE,H.FROM_PLACE,H.TO_PLACE,H.OWNER,H.TRANSPORT_CODE,H.TRANSPORT_NAME,B.DO_NO,B.ITEM_CODE,B.ITEM_NAME,B.REMARK,B.CP_CODE,B.CP_NAME FROM TRIP_BODY B LEFT JOIN TRIP_HEAD H ON B.TRIPHID = H.TRIPHID  WHERE H.VEHICLE_NO = '$velNo' AND H.LR_ACK_STATUS = 0");

								if($TRIPDATA){

									// echo '<PRE>';print_r($TRIP_DATA);exit;

									$TRIP_DATA = json_decode(json_encode($TRIPDATA),true);

									$DATA0 = array(
									"PLANT_CODE" => $TRIP_DATA[0]['PLANT_CODE'],
									"PLANT_NAME" => $TRIP_DATA[0]['PLANT_NAME'],
									"ACC_CODE"   => $TRIP_DATA[0]['ACC_CODE'],
									"ACC_NAME"   => $TRIP_DATA[0]['ACC_NAME'],
									"TRIP_NO"    => $TRIP_DATA[0]['TRIP_NO'],
									"TRIP_DATE"  => $TRIP_DATA[0]['VRDATE'],
									"FROM_PLACE" => $TRIP_DATA[0]['FROM_PLACE'],
									"TO_PLACE"   => $TRIP_DATA[0]['TO_PLACE'],
									"TRPT_NAME"  => $TRIP_DATA[0]['TRANSPORT_NAME'],
									"TRPT_CODE"  => $TRIP_DATA[0]['TRANSPORT_CODE'],
									"DO_NO"      => $TRIP_DATA[0]['DO_NO'],
									"ITEM_CODE"  => $TRIP_DATA[0]['ITEM_CODE'],
									"ITEM_NAME"  => $TRIP_DATA[0]['ITEM_NAME'],
									"REMARK"     => $TRIP_DATA[0]['REMARK'],
									"CP_CODE"    => $TRIP_DATA[0]['CP_CODE'],
									"CP_NAME"    => $TRIP_DATA[0]['CP_NAME'],
									"FLAG"       => 0,
									"CREATED_BY" => $userid,
								);

								$saveData1[] = DB::table('VEHICLE_GPS_TRAN')->where('ID',$gpsTranId)->update($DATA0);

								}else{

									// DO NOTHING
								}


					}

					
				}else{
					$eTrans = 0;
				}
				

		/* ----------- END : e-Trans API -------------------- */

				// print_r($saveData);
				
				$response_array['response'] = 'success';
	            $response_array['track_data'] = $saveData;
	            
	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
	            $response_array['track_data'] = '' ;
	           
	            $data = json_encode($response_array);

	            print_r($data);
			}

			
		}else{

			$response_array['response'] = 'error';
            $response_array['track_data'] = '' ;

            $data = json_encode($response_array);

            print_r($data);

		}


		
	}

	public function TrackVehicleTblData(Request $request){

		$fisYear      = $request->session()->get('macc_year');
		$splitYR      = explode('-', $fisYear);
		$startYEar    = $splitYR[0].'-04-01';

		$compCodeName = $request->session()->get('company_name');
		$explode      = explode('-', $compCodeName);
		$getcom_code  = $explode[0];

		$usertype     = $request->session()->get('usertype');
		$userid       = $request->session()->get('userid');



		if ($request->ajax()) {

			$defaultInp = $request->input('getDefalutType');
			$changeInp  = $request->input('velType');

			

			if(empty($changeInp) || $changeInp=='AllVel'){

				$arr1 = array(
					"FLAG"            => 0,
				);

				DB::table('VEHICLE_GPS_TRAN')->where('LAST_UPDATE_BY',$userid)->update($arr1);

				$data1 = DB::table('VEHICLE_GPS_TRAN')->where('FLAG',0)->get()->toArray();

				return DataTables()->of($data1)->addIndexColumn()->make(true);

			}else{


				if ($changeInp == 'RunningVel') {

					$dataArr = DB::table('VEHICLE_GPS_TRAN')->where('SPEED','>',0)->get()->toArray();

					return DataTables()->of($dataArr)->addIndexColumn()->make(true);

					
				}else if($changeInp == 'IdelVel'){

					$dataArr = DB::table('VEHICLE_GPS_TRAN')->where('SPEED','=',0)->get()->toArray();

					return DataTables()->of($dataArr)->addIndexColumn()->make(true);


				}else{

					$data1 = array();

					return DataTables()->of($data1)->addIndexColumn()->make(true);
				}

				
			}


		}else{

			$data = array();

			return DataTables()->of($data)->addIndexColumn()->make(true);
		}


	}

	public function getTrackVehicleFromApi(Request $request){

		$fisYear      = $request->session()->get('macc_year');
		$splitYR      = explode('-', $fisYear);
		$startYEar    = $splitYR[0].'-04-01';

		$compCodeName = $request->session()->get('company_name');
		$explode      = explode('-', $compCodeName);
		$getcom_code  = $explode[0];

		$usertype     = $request->session()->get('usertype');
		$userid       = $request->session()->get('userid');

		$response_array = array();

		if ($request->ajax()) {

			$velNo = $request->input('velNo');
			$velId = $request->input('velId');
			$lats  = $request->input('lats');
			$longs = $request->input('longs');

			// DB::enableQueryLog();
			$trip_data = DB::select("SELECT H.PLANT_CODE,H.PLANT_NAME,H.ACC_CODE,H.ACC_NAME,H.TRIP_NO,H.VRDATE,H.FROM_PLACE,H.TO_PLACE,H.OWNER,H.TRANSPORT_CODE,H.TRANSPORT_NAME,B.DO_NO,B.ITEM_CODE,B.ITEM_NAME,B.REMARK,B.CP_CODE,B.CP_NAME FROM TRIP_BODY B LEFT JOIN TRIP_HEAD H ON B.TRIPHID = H.TRIPHID  WHERE H.VEHICLE_NO = '$velNo' AND H.LR_ACK_STATUS = 0");


			// echo '<PRE>';print_r($trip_data);echo '</PRE>';exit();
			// dd(DB::getQueryLog());
			$ch = curl_init('https://etranssolutions.com/eTransRestApi/reports/location');

			$payload = json_encode( array("$velNo"));
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','username:shreyasho','password:10hstc4Xa3ODTW9f61'));
			
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			
			$result = curl_exec($ch);

			curl_close($ch);

			$e_trans = json_decode($result, true);


			if ($e_trans) {

    			$response_array['response'] = 'success';
	            $response_array['track_data'] = $e_trans['result'][0];
	            $response_array['trip_data'] = $trip_data;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['track_data'] = '' ;
                $response_array['trip_data'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['track_data'] = '' ;
                $response_array['trip_data'] = $trip_data;

                $data = json_encode($response_array);

                print_r($data);
	    }

		
	}


	/* END : TRACK VEHICLE ETRAN API */

	/* START : TRIP STATUS AT A GLANCE*/

    public function TripCompleationReport(Request $request){
 	
	 	$title = 'TRIP STATUS';
	 	$compCodeName = $request->session()->get('company_name');
		$explode      = explode('-', $compCodeName);
		$getcom_code  = $explode[0];

	 	if($request->ajax()) {

	 		if(!empty($request->searchType  || $request->compCode || $request->accCode || $request->ReportTypes)) {

					$searchType    = $request->searchType;
					$compCode      = $request->compCode;
					$accCode       = $request->accCode;
					$ReportTypes   = $request->ReportTypes;


				    $strWhere = '';

				    if(isset($compCode)  && trim($compCode)!=""){

						$strWhere.="AND H.COMP_CODE= '$compCode'";
						
					}else{

						$strWhere.="AND H.COMP_CODE= '$getcom_code'";

					}

					if(isset($accCode)  && trim($accCode)!=""){

						$strWhere.="AND C.ACC_CODE= '$accCode'";
						
					}

				    if ($ReportTypes=='pending') {
				    	
				    	if (isset($searchType) || $searchType!='') {

				    		if($searchType=='Gate_In_Status'){

								$strWhere1="AND H.GATE_IN_STATUS= '0'";

							}else if($searchType=='LR_Status'){

								$strWhere1="AND H.LR_STATUS= '0'";
								
							}else if($searchType=='SLR_Status'){

								$strWhere1="AND H.SLR_STATUS= '0'";
								
							}else if($searchType=='Gate_Out_Status'){

								$strWhere1="AND H.GATE_OUT_STATUS= '0'";
								
							}else if($searchType=='EPOD_Status'){

								$strWhere1="AND H.EPOD_STATUS= '0'";

							}else if($searchType=='LR_Ackonwledgment'){

								$strWhere1="AND H.LR_ACK_STATUS= '0'";
								
							}else if($searchType=='Trip_Expenses_Status'){

								$strWhere1="AND H.TRIP_EXP_STATUS= '0'";
								
							}else if($searchType=='Trip_PMT_Status'){

								$strWhere1="AND H.TRIP_PMT_STATUS= '0'";

							}else if($searchType=='Temp_Bill_Status'){

								$strWhere1="AND B.PROVBILL_STATUS= '0'";
								
							}else if($searchType=='Bill_Status'){

								$strWhere1="AND H.BILL_STATUS= '0'";
								
							}else{

								/*DO NOTHING*/
							}
				    		
				    	}else{

				    		$strWhere1="AND 1=1";

				    	}
						
						

						//DB::enableQueryLog();
						$data = DB::select("SELECT H.COMP_CODE,C.COMP_NAME,CONCAT(LEFT(H.FY_CODE,4),'-',H.SERIES_CODE,'-',H.VRNO) TRIPNO ,H.TRIP_NO,H.VRDATE,H.VEHICLE_NO,H.OWNER,B.LR_NO,B.LR_DATE,B.REMARK,H.FREIGHT_QTY,B.UM,H.FROM_PLACE,H.TO_PLACE,H.TRIP_DAY,H.ACC_CODE,H.ACC_NAME,B.RCOMP_CODE,B.CP_CODE,B.CP_NAME,B.INVC_NO,B.INVC_DATE,B.EBILL_NO,B.EWAYB_VALIDDT,B.DELIVERY_NO,B.WAGON_NO,B.RAKE_NO,B.PROVBILL_STATUS,H.TRIP_FREIGHT_AMT,H.EBILL_NO,H.EWAYB_VALIDDT,H.REF_TRIP_NO,H.TRANSPORT_CODE,H.TRANSPORT_NAME,H.GATE_IN_STATUS,H.GATE_STATUS,H.CFINWARD_STATUS,H.PLAN_STATUS,H.LR_STATUS,H.OUTWARD_LR_STATUS,H.SLR_STATUS,H.GATE_OUT_STATUS,H.VEHICLE_OUT_DT_TIME,H.EPOD_STATUS,H.REPORT_DATE,H.LR_ACK_STATUS,H.ACK_DATE,H.RECEIVED_QTY,H.TRIP_ACHIVE_DAY,H.TRIP_EXP_STATUS,H.TRIP_PMT_STATUS,H.BILL_STATUS FROM TRIP_HEAD H, TRIP_BODY B, MASTER_COMP C WHERE B.TRIPHID=H.TRIPHID $strWhere  $strWhere1  AND C.COMP_CODE=H.COMP_CODE  GROUP BY H.TRIPHID ORDER BY H.VRDATE,H.TRIP_NO");
 						//dd(DB::getQueryLog());
        				return DataTables()->of($data)->addIndexColumn()->make(true);
							
					}else if ($ReportTypes=='complete') {
				    	
						if (isset($searchType) || $searchType!='') {

							if ($searchType=='Trip_Plan_Status') {

								$strWhere1="AND H.TRIP_NO != 'NULL'";
								
							}else if($searchType=='Gate_In_Status'){

								$strWhere1="AND H.GATE_IN_STATUS= '1'";

							}else if($searchType=='LR_Status'){

								$strWhere1="AND H.LR_STATUS= '1'";
								
							}else if($searchType=='SLR_Status'){

								$strWhere1="AND H.SLR_STATUS= '1'";
								
							}else if($searchType=='Gate_Out_Status'){

								$strWhere1="AND H.GATE_OUT_STATUS= '1'";
								
							}else if($searchType=='EPOD_Status'){

								$strWhere1="AND H.EPOD_STATUS= '1'";

							}else if($searchType=='LR_Ackonwledgment'){

								$strWhere1="AND H.LR_ACK_STATUS= '1'";
								
							}else if($searchType=='Trip_Expenses_Status'){

								$strWhere1="AND H.TRIP_EXP_STATUS= '1'";
								
							}else if($searchType=='Trip_PMT_Status'){

								$strWhere1="AND H.TRIP_PMT_STATUS= '1'";

							}else if($searchType=='Temp_Bill_Status'){

								$strWhere1="AND B.PROVBILL_STATUS= '0'";
								
							}else if($searchType=='Bill_Status'){

								$strWhere1="AND H.BILL_STATUS= '1'";
								
							}else{

								/*DO NOTHING*/
							}

						}else{

							$strWhere1="AND 1=1";
						}


						$data = DB::select("SELECT H.COMP_CODE,C.COMP_NAME,CONCAT(LEFT(H.FY_CODE,4),'-',H.SERIES_CODE,'-',H.VRNO) TRIPNO ,H.TRIP_NO,H.VRDATE,H.VEHICLE_NO,H.OWNER,B.LR_NO,B.LR_DATE,B.REMARK,H.FREIGHT_QTY,B.UM,H.FROM_PLACE,H.TO_PLACE,H.TRIP_DAY,H.ACC_CODE,H.ACC_NAME,B.RCOMP_CODE,B.CP_CODE,B.CP_NAME,B.INVC_NO,B.INVC_DATE,B.EBILL_NO,B.EWAYB_VALIDDT,B.DELIVERY_NO,B.WAGON_NO,B.RAKE_NO,B.PROVBILL_STATUS,H.TRIP_FREIGHT_AMT,H.EBILL_NO,H.EWAYB_VALIDDT,H.TRANSPORT_CODE,H.REF_TRIP_NO,H.TRANSPORT_NAME,H.GATE_IN_STATUS,H.GATE_STATUS,H.CFINWARD_STATUS,H.PLAN_STATUS,H.LR_STATUS,H.OUTWARD_LR_STATUS,H.SLR_STATUS,H.GATE_OUT_STATUS,H.VEHICLE_OUT_DT_TIME,H.EPOD_STATUS,H.REPORT_DATE,H.LR_ACK_STATUS,H.ACK_DATE,H.RECEIVED_QTY,H.TRIP_ACHIVE_DAY,H.TRIP_EXP_STATUS,H.TRIP_PMT_STATUS,H.BILL_STATUS FROM TRIP_HEAD H, TRIP_BODY B, MASTER_COMP C WHERE B.TRIPHID=H.TRIPHID $strWhere1 $strWhere AND C.COMP_CODE=H.COMP_CODE  GROUP BY H.TRIPHID ORDER BY H.VRDATE,H.TRIP_NO");
 				
        				return DataTables()->of($data)->addIndexColumn()->make(true);
							
					}else{

						$data = DB::select("SELECT H.COMP_CODE,C.COMP_NAME,CONCAT(LEFT(H.FY_CODE,4),'-',H.SERIES_CODE,'-',H.VRNO) TRIPNO ,H.TRIP_NO,H.VRDATE,H.VEHICLE_NO,H.OWNER,B.LR_NO,B.LR_DATE,B.REMARK,H.FREIGHT_QTY,B.UM,H.FROM_PLACE,H.TO_PLACE,H.TRIP_DAY,H.ACC_CODE,H.ACC_NAME,B.RCOMP_CODE,B.CP_CODE,B.CP_NAME,B.INVC_NO,B.INVC_DATE,B.EBILL_NO,B.EWAYB_VALIDDT,B.DELIVERY_NO,B.WAGON_NO,B.RAKE_NO,B.PROVBILL_STATUS,H.TRIP_FREIGHT_AMT,H.EBILL_NO,H.EWAYB_VALIDDT,H.TRANSPORT_CODE,H.REF_TRIP_NO,H.TRANSPORT_NAME,H.GATE_IN_STATUS,H.GATE_STATUS,H.CFINWARD_STATUS,H.PLAN_STATUS,H.LR_STATUS,H.OUTWARD_LR_STATUS,H.SLR_STATUS,H.GATE_OUT_STATUS,H.VEHICLE_OUT_DT_TIME,H.EPOD_STATUS,H.REPORT_DATE,H.LR_ACK_STATUS,H.ACK_DATE,H.RECEIVED_QTY,H.TRIP_ACHIVE_DAY,H.TRIP_EXP_STATUS,H.TRIP_PMT_STATUS,H.BILL_STATUS FROM TRIP_HEAD H, TRIP_BODY B, MASTER_COMP C WHERE B.TRIPHID=H.TRIPHID $strWhere AND C.COMP_CODE=H.COMP_CODE  GROUP BY H.TRIPHID ORDER BY H.VRDATE,H.TRIP_NO");
	 				// print_r($data);exit;
	        			return DataTables()->of($data)->addIndexColumn()->make(true);


					}

					

			}else{


				$data = DB::select("SELECT H.COMP_CODE,C.COMP_NAME,CONCAT(LEFT(H.FY_CODE,4),'-',H.SERIES_CODE,'-',H.VRNO) TRIPNO ,H.TRIP_NO,H.VRDATE,H.VEHICLE_NO,H.OWNER,B.LR_NO,B.LR_DATE,B.REMARK,H.FREIGHT_QTY,B.UM,H.FROM_PLACE,H.TO_PLACE,H.TRIP_DAY,H.ACC_CODE,H.ACC_NAME,B.RCOMP_CODE,B.CP_CODE,B.CP_NAME,B.INVC_NO,B.INVC_DATE,B.EBILL_NO,B.EWAYB_VALIDDT,B.DELIVERY_NO,B.WAGON_NO,B.RAKE_NO,B.PROVBILL_STATUS,H.TRIP_FREIGHT_AMT,H.EBILL_NO,H.EWAYB_VALIDDT,H.TRANSPORT_CODE,H.TRANSPORT_NAME,H.GATE_IN_STATUS,H.REF_TRIP_NO,H.GATE_STATUS,H.CFINWARD_STATUS,H.PLAN_STATUS,H.LR_STATUS,H.OUTWARD_LR_STATUS,H.SLR_STATUS,H.GATE_OUT_STATUS,H.VEHICLE_OUT_DT_TIME,H.EPOD_STATUS,H.REPORT_DATE,H.LR_ACK_STATUS,H.ACK_DATE,H.RECEIVED_QTY,H.TRIP_ACHIVE_DAY,H.TRIP_EXP_STATUS,H.TRIP_PMT_STATUS,H.BILL_STATUS FROM TRIP_HEAD H, TRIP_BODY B, MASTER_COMP C WHERE B.TRIPHID=H.TRIPHID AND H.COMP_CODE='$getcom_code' AND C.COMP_CODE=H.COMP_CODE  GROUP BY H.TRIPHID ORDER BY H.VRDATE,H.TRIP_NO");
	 			// print_r($data);exit;
	        	return DataTables()->of($data)->addIndexColumn()->make(true);

			}

	 		
	    }

	    $masterCompData = DB::table('MASTER_COMP')->where('BLOCK_COMP','NO')->get()->toArray();
	    $masterAccData = DB::table('MASTER_ACC')->where('ATYPE_CODE','D')->where('ACC_BLOCK','NO')->get()->toArray();
	    $masterConsigneeData = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->where('ACC_BLOCK','NO')->get()->toArray();
	      
	 	return view('admin.trip_compleation',compact('title','masterCompData','masterAccData','masterConsigneeData'));
	} 

	/* END : TRIP STATUS AT A GLANCE*/


/* -------- E INVOICE REPORT -------- */
	
	public function eInvoiceReport(Request $request){

		$title        = 'e-Invoice Report';
		$compCodeName = $request->session()->get('company_name');
		$explode      = explode('-', $compCodeName);
		$getcom_code  = $explode[0];
		$macc_year    = $request->session()->get('macc_year');

	    $getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcom_code,'FY_CODE'=>$macc_year])->get();

	    foreach ($getdate as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$userdata['AccData'] = DB::select("SELECT DISTINCT ACC_CODE,ACC_NAME FROM SBILL_HEAD WHERE INR_NO IS NULL OR INR_NO=''");
	      
	 	return view('admin.finance.report.logistic.e_Invoice',$userdata+compact('title'));
	}

	public function accListForEInvoice(Request $request){

		if ($request->ajax()) {
			
			$createdBy       = $request->session()->get('userid');
			$compName        = $request->session()->get('company_name');
			$explodeCode     = explode('-', $compName);
			$compcode        = $explodeCode[0];
			$fisYear         =  $request->session()->get('macc_year');
			$eInvoice_Status = $request->post('eInvoiceStatus');
			$account_code    = $request->post('account_code');
			$fieldType       = $request->post('fieldType');

			$response_array = array();

			if($fieldType == 'EINVOICE'){

				if($eInvoice_Status == 'saleInvoice'){

					$AccList = DB::select("SELECT DISTINCT ACC_CODE,ACC_NAME FROM SBILL_HEAD WHERE INR_NO IS NULL OR INR_NO=''");
					$vrNoList = '';
				}else{
					$AccList ='';
					$vrNoList = '';
				}

			}else if($fieldType == 'ACCLIST'){
				
				if($eInvoice_Status == 'saleInvoice'){
					$vrNoList = DB::select("SELECT *,SUBSTRING(FY_CODE, 1, 4)AS STARTYR FROM SBILL_HEAD WHERE ACC_CODE ='$account_code' AND (INR_NO IS NULL OR INR_NO='') ");
					$AccList  = '';
				}else{
					$vrNoList = '';
					$AccList  ='';
				}
			}

			
			

			if ($AccList || $vrNoList) {

				$response_array['response']      = 'success';
				$response_array['data_accList']  = $AccList;
				$response_array['data_vrnoList'] = $vrNoList;
				echo $data = json_encode($response_array);

			}else{

				$response_array['response']      = 'error';
				$response_array['data_accList']  = '' ;
				$response_array['data_vrnoList'] = '' ;
				$data = json_encode($response_array);
				
			}

		}else{

				$response_array['response']      = 'error';
				$response_array['data_accList']  = '' ;
				$response_array['data_vrnoList'] = '' ;
				$data = json_encode($response_array);
				
		}
		
	}

	public function eInvoicegetData(Request $request){
 	
	 	$title = 'e Invoice';
	 	$compCodeName = $request->session()->get('company_name');
		$explode      = explode('-', $compCodeName);
		$getcom_code  = $explode[0];

	 	if($request->ajax()) {

	 		if(!empty($request->eInvoice_Status  || $request->account_code || $request->vrNo || $request->t_Code || $request->sbillHeadID)) {

					$eInvoice_Status = $request->eInvoice_Status;
					$account_code    = $request->account_code;
					$vrNo            = $request->vrNo;
					$t_Code          = $request->t_Code;
					$sbillHeadID     = $request->sbillHeadID;


				    $strWhere = '';

				    if($eInvoice_Status == 'saleInvoice'){
				    	//DB::enableQueryLog();
				    	$data = DB::select("SELECT S.ITEM_CODE,S.ITEM_NAME,S.QTYISSUED,S.UM,S.RATE,S.BASICAMT,V.CGST,V.SGST,V.IGST,S.DRAMT FROM SBILL_BODY S,SBILL_TAX_VIEW V WHERE S.SBILLBID=S.SBILLBID AND S.SBILLHID=S.SBILLHID AND S.SBILLHID='$sbillHeadID'");
				    	//dd(DB::getQueryLog());
				    }

	        		return DataTables()->of($data)->addIndexColumn()->make(true);
					

			}else{


				$data = array();
	 			// print_r($data);exit;
	        	return DataTables()->of($data)->addIndexColumn()->make(true);

			}
	 		
	    }
	      
	} 

/* -------- E INVOICE REPORT -------- */

	
}

?>