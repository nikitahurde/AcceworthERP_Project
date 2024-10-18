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

class ReportColdStorageController extends Controller{

	public function __construct(Request $request){

		//$this->data = "smit@121";

	}

	public function BiltyReport(Request $request){

		$title      ='Bilty Report';
		$compName   = $request->session()->get('company_name');

		$userid       = $request->session()->get('userid');

		if($userid != ''){

			$data = DB::select("SELECT t1.*,t2.* FROM BILTY_HEAD t1 LEFT JOIN BILTY_BODY t2 ON t2.BILTYHID = t1.BILTYHID ");

			date_default_timezone_set('Asia/Kolkata');

	        $current_date = date('Y-m-d');

	        $tenday =  date('Y-m-d', strtotime('10 days', strtotime($current_date)));
	        $elevenday =  date('Y-m-d', strtotime('11 days', strtotime($current_date)));
	        $twentyday =  date('Y-m-d', strtotime('20 days', strtotime($current_date)));
	        $twentyOneday =  date('Y-m-d', strtotime('21 days', strtotime($current_date)));
	        $thirtyday =  date('Y-m-d', strtotime('30 days', strtotime($current_date)));
	        // DB::enableQueryLog();
            $tenDayData = DB::select("SELECT  t1.BUILTY_DT,t1.FY_CODE,t1.SERIES_CODE,t1.VRNO,t1.FY_CODE,t1.RECIEPT_TILL_DT,t1.ACC_CODE,t1.ACC_NAME,t1.ITEM_CODE,t1.ITEM_NAME,t1.STORAGE_TYPE,t1.BILTY_QTY,t1.BILTY_UM FROM BILTY_HEAD t1 LEFT JOIN BILTY_BODY t2 ON t2.BILTYHID = t1.BILTYHID WHERE RECIEPT_TILL_DT BETWEEN '$current_date' AND '$tenday' ");
           
            $twentyDayData = DB::select("SELECT t1.BUILTY_DT,t1.FY_CODE,t1.SERIES_CODE,t1.VRNO,t1.FY_CODE,t1.RECIEPT_TILL_DT,t1.ACC_CODE,t1.ACC_NAME,t1.ITEM_CODE,t1.ITEM_NAME,t1.STORAGE_TYPE,t1.BILTY_QTY,t1.BILTY_UM FROM BILTY_HEAD t1 LEFT JOIN BILTY_BODY t2 ON t2.BILTYHID = t1.BILTYHID WHERE RECIEPT_TILL_DT BETWEEN '$elevenday' AND '$twentyday' ");
            
            $thirtyDayData = DB::select("SELECT t1.BUILTY_DT,t1.FY_CODE,t1.SERIES_CODE,t1.VRNO,t1.FY_CODE,t1.RECIEPT_TILL_DT,t1.ACC_CODE,t1.ACC_NAME,t1.ITEM_CODE,t1.ITEM_NAME,t1.STORAGE_TYPE,t1.BILTY_QTY,t1.BILTY_UM FROM BILTY_HEAD t1 LEFT JOIN BILTY_BODY t2 ON t2.BILTYHID = t1.BILTYHID WHERE RECIEPT_TILL_DT BETWEEN '$twentyOneday' AND '$thirtyday' ");
            // print_r($tenDayData);exit();

             // dd(DB::getQueryLog());
			return view('admin.finance.report.cold_storage.bilty_report',compact('title','tenDayData','twentyDayData','thirtyDayData'));

		}else{
            return redirect('/useractivity');
		}
       
       
	}


	public function SaleBillReport(Request $request){

		$title    ='Sale Bill Report';
		$compName = $request->session()->get('company_name');
		
		$userid   = $request->session()->get('userid');

		$userdata['item_list']       = DB::table('SBILL_BODY')->groupBy('ITEM_CODE')->get();
		$userdata['trip_list']       = DB::table('SBILL_HEAD')->groupBy('CPCODE')->get();

		// print_r($userdata['trip_list']);

		if($userid != ''){
          
          return view('admin.finance.report.cold_storage.sale_bill_report',$userdata+compact('title'));
		}
	}

	public function getDataSalebill(Request $request){
    
		$title     = 'Get Data Sale Bill Report';
		$compName  = $request->session()->get('company_name');
		$spliComp  = explode('-', $compName);
		$comp_code = $spliComp[0];
		
		$userid   = $request->session()->get('userid');

		if($request->ajax()){

			if (!empty($request->cust_no || $request->item_code)) {

            $custno   = $request->input('cust_no');
			$itemcode = $request->input('item_code');
			

			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];

			$strWhere = '';

			if(isset($custno)  && trim($custno)!=""){

		      	$strWhere .= " AND T1.CPCODE = '$custno' ";
		    }

		    if(isset($itemcode)  && trim($itemcode)!=""){

		      	$strWhere .= " AND T2.ITEM_CODE = '$itemcode' ";
		    }

		    // DB::enableQueryLog();
			
			$data = DB::select("SELECT T1.VRDATE,T1.VRNO,T1.ACC_CODE,T1.ACC_NAME,T1.CPCODE,T2.BASICAMT,SUM(T3.TAX_AMT) AS TAX_AMT,SUM(T2.BASICAMT+T3.TAX_AMT) AS TOTAL FROM SBILL_HEAD T1 LEFT JOIN SBILL_BODY T2 ON T2.SBILLHID = T1.SBILLHID LEFT JOIN SBILL_TAX T3 ON T3.SBILLHID = T1.SBILLHID AND T3.SBILLBID = T2.SBILLBID WHERE 1=1 $strWhere");

			// dd(DB::getQueryLog());
			return DataTables()->of($data)->addIndexColumn()->make(true);

		}else{

		}

		if($request->blankData == 'Blank'){
          
            $data = array();
			return DataTables()->of($data)->addIndexColumn()->make(true);

		}else{
			
	    	$data = DB::select("SELECT T1.VRDATE,T1.VRNO,T1.ACC_CODE,T1.ACC_NAME,T1.CPCODE,T2.BASICAMT,SUM(T3.TAX_AMT) AS TAX_AMT,SUM(T2.BASICAMT+T3.TAX_AMT) AS TOTAL FROM SBILL_HEAD T1 LEFT JOIN SBILL_BODY T2 ON T2.SBILLHID = T1.SBILLHID LEFT JOIN SBILL_TAX T3 ON T3.SBILLHID = T1.SBILLHID AND T3.SBILLBID = T2.SBILLBID");

			return DataTables()->of($data)->addIndexColumn()->make(true);
       }

		}
       

    }

    public function dailyPadtaReport(Request $request){

		$title      ='Daily Padta Report';
		$compName   = $request->session()->get('company_name');
		$getcomcode = explode('-', $compName);
		$compCode   = $getcomcode[0];

		$macc_year  = $request->session()->get('macc_year');
		
		$userid   = $request->session()->get('userid');
		$item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$compCode)->where('FY_CODE',$macc_year)->get();

	    foreach ($item_um_aum_list as $key) {
	        $userdata['fromDate'] =  $key->FY_FROM_DATE;
	        $userdata['toDate']   =  $key->FY_TO_DATE;
	    }

		$userdata['acc_list'] = DB::table('TRIP_HEAD')->groupBy('ACC_CODE')->get();
		$userdata['vehicle_list'] = DB::table('TRIP_HEAD')->groupBy('VEHICLE_NO')->get()->toArray();
		// echo '<PRE>';print_r($userdata['vehicle_list']);exit();

		if($compName != ''){
          
          return view('admin.finance.report.logistic.daily_padta',$userdata+compact('title'));
		}
	} 

	 public function getDatadailyPadta(Request $request){

	 	$from_dt    = $request->input('from_dt');
		$to_dt   = $request->input('to_dt');
		$formdate     =  date("Y-m-d", strtotime($from_dt));
		$todate       =  date("Y-m-d", strtotime($to_dt));

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		if($request->ajax()){

            if (!empty($request->from_dt || $request->to_dt || $request->custno ||  $request->vehicle_no || $request->owner  )) {

            	
				$from_dt    = $request->input('from_dt');
				$to_dt      = $request->input('to_dt');
				$cust_no    = $request->input('custno');
				$vehicle_no = $request->input('vehicle_no');
				$owner      = $request->input('owner');
				
				

				$strWhere = '';
				$str_Where = '';

				if(isset($vehicle_no)  && trim($vehicle_no)!=""){

			      	$strWhere .= " AND H.VEHICLE_NO = '$vehicle_no' ";
			      	$str_Where .= " AND I.VEHICLE_NO = '$vehicle_no' ";
			    }

			    if(isset($cust_no)  && trim($cust_no)!=""){

			      	$strWhere .= " AND H.ACC_CODE = '$cust_no' ";
			      	$str_Where .= " AND I.ACC_CODE = '$cust_no' ";
			    }

			    if(isset($owner)  && trim($owner)!=""){

			    	if($owner != 'Both'){
			    		$strWhere .= "AND H.OWNER='$owner'";
			         	$str_Where .= "AND I.OWNER='$owner'";
			    	}

			      	
			    }

			    $data = DB::select("
			    		SELECT S.TRIPHID, S.VRDATE, S.VRNO, S.VEHICLE_NO, S.OWNER , S.ACC_CODE,S.ACC_NAME,S.FROM_PLACE,S.TO_PLACE,S.FREIGHT_QTY,S.FSO_RATE,S.DRAMT, S.FPO_RATE,S.CRAMT, S.EXPAMT, S.DRAMT - S.CRAMT AS PROFIT FROM (

			    		SELECT H.TRIPHID, H.VRDATE, CONCAT(H.SERIES_CODE,'/',LEFT(H.FY_CODE,4),'/',H.VRNO) AS VRNO, H.VEHICLE_NO, H.OWNER , H.ACC_CODE,H.ACC_NAME,H.FROM_PLACE,H.TO_PLACE,H.FREIGHT_QTY,(CASE WHEN H.FSO_RATE IS NULL THEN 0 ELSE H.FSO_RATE END)FSO_RATE,H.FREIGHT_QTY*H.FSO_RATE AS DRAMT, FPO_RATE, H.FREIGHT_QTY*H.FPO_RATE AS CRAMT, (SELECT SUM(E.AMOUNT) FROM FLEET_TRAN_EXP E WHERE E.TRIPHID= H.TRIPHID GROUP BY E.TRIPHID) AS EXPAMT FROM TRIP_HEAD H WHERE  H.VRDATE BETWEEN '$formdate' AND '$todate' AND H.COMP_CODE='$getcom_code' $strWhere) S");

				// dd(DB::getQueryLog());
				return DataTables()->of($data)->addIndexColumn()->make(true);

            }


            /*if($request->blankData == 'Blank'){

            	$data= array();
            	return DataTables()->of($data)->addIndexColumn()->make(true);

            }else if($request->owner == 'Both'){
               // DB::enableQueryLog();
            	$data = DB::select("SELECT H.TRIPHID, H.VRDATE, CONCAT(H.SERIES_CODE,'/',LEFT(H.FY_CODE,4),'/',H.VRNO) AS VRNO, H.VEHICLE_NO, H.OWNER , H.ACC_CODE,H.ACC_NAME,H.FROM_PLACE,H.TO_PLACE,H.FREIGHT_QTY,H.FSO_RATE,H.FREIGHT_QTY*H.FPO_RATE AS DRAMT, FPO_RATE, H.FREIGHT_QTY*H.FPO_RATE AS CRAMT, (SELECT SUM(E.AMOUNT) FROM TRIP_CHARGE_EXP E WHERE E.TRIPHID= H.TRIPHID GROUP BY E.TRIPHID) AS EXPAMT FROM TRIP_HEAD H WHERE  H.VRDATE BETWEEN '$formdate' AND '$todate' AND H.COMP_CODE='$getcom_code' $strWhere");
 // dd(DB::getQueryLog());
				return DataTables()->of($data)->addIndexColumn()->make(true);

            }else{

            	$data= array();
            	return DataTables()->of($data)->addIndexColumn()->make(true);
            }*/

        }
		
	} 


    public function dailyTripPlan(Request $request){

    	$title      ='Daily Trip Plan';
		$compName   = $request->session()->get('company_name');
		$getcomcode = explode('-', $compName);
		$compCode   = $getcomcode[0];

		$macc_year  = $request->session()->get('macc_year');
		
		$userid   = $request->session()->get('userid');
		$item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$compCode)->where('FY_CODE',$macc_year)->get();

	    foreach ($item_um_aum_list as $key) {
	        $userdata['fromDate'] =  $key->FY_FROM_DATE;
	        $userdata['toDate']   =  $key->FY_TO_DATE;
	    }

		$userdata['acc_list'] = DB::table('TRIP_HEAD')->groupBy('ACC_CODE')->get();
		$vehicleList = DB::table('TRIP_HEAD')->groupBy('VEHICLE_NO')->get()->toArray();

      $userdata['vehicle_list'] = json_decode(json_encode($vehicleList),true);

      $userdata['city_list'] = DB::table('MASTER_CITY')->groupBy('CITY_CODE')->get();

      /*echo '<pre>';
      print_r($userdata['vehicle_list']);
      exit();*/
		// echo '<PRE>';print_r($userdata['vehicle_list']);exit();

		if($compName != ''){
          
          return view('admin.finance.report.logistic.daily_trip_plan',$userdata+compact('title'));
		}

    }

    public function getdailyTripData(Request $request){

    	$from_dt    = $request->input('from_dt');
		$to_dt   = $request->input('to_dt');
		$formdate     =  date("Y-m-d", strtotime($from_dt));
		$todate       =  date("Y-m-d", strtotime($to_dt));

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		if($request->ajax()){

            if (!empty($request->from_dt || $request->to_dt || $request->custno ||  $request->vehicle_no || $request->owner  )) {

            	
				$from_dt    = $request->input('from_dt');
				$to_dt      = $request->input('to_dt');
				$cust_no    = $request->input('custno');
				$vehicle_no = $request->input('vehicle_no');
				$owner      = $request->input('owner');
				
				$strWhere = '';
				
				if(isset($vehicle_no)  && trim($vehicle_no)!=""){

			      	$strWhere .= " AND H.VEHICLE_NO = '$vehicle_no' ";
			      
			    }

			    if(isset($cust_no)  && trim($cust_no)!=""){

			      	$strWhere .= " AND H.ACC_CODE = '$cust_no' ";
			      	
			    }

			    if(isset($owner)  && trim($owner)!=""){

			    	if($owner != 'Both'){
			    		$strWhere .= "AND H.OWNER='$owner'";
			         	
			    	}

			      	
			    }

			    $data = DB::select("SELECT H.VRDATE, CONCAT(H.SERIES_CODE,'/',LEFT(H.FY_CODE,4),'/',H.VRNO) AS VRNO, H.VEHICLE_NO, H.OWNER , H.ACC_CODE,H.ACC_NAME,H.FROM_PLACE,H.TO_PLACE,H.FREIGHT_QTY,H.FPO_RATE, (SELECT SUM(E.AMOUNT) FROM TRIP_CHARGE_EXP E WHERE E.TRIPHID=H.TRIPHID GROUP BY E.TRIPHID) AS EXPAMT,  H.FREIGHT_QTY*H.FPO_RATE AS CRAMT FROM TRIP_HEAD H WHERE 1=1 $strWhere AND H.VRDATE BETWEEN '$formdate' AND '$todate' AND H.COMP_CODE='$getcom_code' ");

				// dd(DB::getQueryLog());
				return DataTables()->of($data)->addIndexColumn()->make(true);

            }


            if($request->blankData == 'Blank'){

            	$data= array();
            	return DataTables()->of($data)->addIndexColumn()->make(true);

            }else if($request->owner == 'Both'){
               //DB::enableQueryLog();
            	$data = DB::select("SELECT H.VRDATE, CONCAT(H.SERIES_CODE,'/',LEFT(H.FY_CODE,4),'/',H.VRNO) AS VRNO, H.VEHICLE_NO, H.OWNER , H.ACC_CODE,H.ACC_NAME,H.FROM_PLACE,H.TO_PLACE,H.FREIGHT_QTY,H.FPO_RATE, (SELECT SUM(E.AMOUNT) FROM TRIP_CHARGE_EXP E WHERE E.TRIPHID=H.TRIPHID GROUP BY E.TRIPHID) AS EXPAMT,  H.FREIGHT_QTY*H.FPO_RATE AS CRAMT FROM TRIP_HEAD H WHERE H.VRDATE BETWEEN 'formdate' AND '$todate' AND H.COMP_CODE='SA'");
 //dd(DB::getQueryLog());
				return DataTables()->of($data)->addIndexColumn()->make(true);

            }else{

            	$data= array();
            	return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

    }
		

	


}

?>