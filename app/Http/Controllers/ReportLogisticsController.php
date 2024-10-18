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



class ReportLogisticsController extends Controller
{
    public function __cunstruct(){

	}


	public function SalebillReport(Request $request){

		$title        =	'Logistics - Sale Bill Report';
		$compCodeName = $request->session()->get('company_name');
		$compcode     = explode('-', $compCodeName);
		$getcompcode  = $compcode[0];
		$macc_year    = $request->session()->get('macc_year');

		$accCatglist  = DB::table('MASTER_ACATG')->get();

		$item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->get();

	    foreach ($item_um_aum_list as $key) {
	        $userdata['fromDate'] =  $key->FY_FROM_DATE;
	        $userdata['toDate']   =  $key->FY_TO_DATE;
	    }

	    $userdata['status_list'] =  DB::select("SELECT CURRENT_STATUS FROM SBILL_BODY_PROV WHERE CURRENT_STATUS!='' GROUP BY CURRENT_STATUS");

	    $userdata['series_list'] =  DB::select("SELECT SERIES_CODE,SERIES_NAME FROM SBILL_HEAD_PROV WHERE SERIES_CODE!='' GROUP BY SERIES_CODE  ");

	    $userdata['plantlist'] =  DB::select("SELECT PLANT_CODE,PLANT_NAME FROM SBILL_HEAD_PROV WHERE PLANT_CODE!='' GROUP BY PLANT_CODE  ");

	    $userdata['tran_list'] =  DB::select("SELECT TRAN_TYPE FROM SBILL_HEAD_PROV WHERE TRAN_TYPE!='' GROUP BY TRAN_TYPE  ");

	    $userdata['acc_list'] =  DB::select("SELECT ACC_CODE,ACC_NAME FROM SBILL_HEAD_PROV WHERE ACC_CODE!='' GROUP BY ACC_CODE  ");
	  // echo '<PRE>';  print_r($userData['status_list']);exit();

		if(isset($compCodeName)){

	    	return view('admin.finance.report.logistic.sale_bill_report',$userdata+compact('title','accCatglist'));

		}else{

		    return redirect('/useractivity');
		
		}

       	
	}

	public function getLogisticsSaleReport(Request $request){
		
		$from_dt     = $request->input('from_date');
		$to_dt       = $request->input('to_date');
		$series_code = $request->input('series_code');
		$plant_code  = $request->input('plant_code');
		$tranType    = $request->input('tranType');
		$accountCode = $request->input('accountCode');
		$curr_status = $request->input('curr_status');
		$from_date   =  date("Y-m-d", strtotime($from_dt));
		$to_date     =  date("Y-m-d", strtotime($to_dt));
		// print_r($vr_date);exit();
		
		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		if($request->ajax()){

			 if (!empty($request->series_code || $request->plant_code || $request->tranType ||  $request->accountCode || $request->from_dt || $request->to_dt || $request->curr_status )) {

			 	if($series_code){
			 		$getseriesCode = explode('[',$series_code);
			 		$seriesCode = $getseriesCode[0];
			 	}else{
			 		$getseriesCode = '';
			 		$seriesCode = '';
			 	}

                // print_r($seriesCode);
			 	if($plant_code){
			 		$getplantCode = explode('[',$plant_code);
			 		$plantCode = $getplantCode[0];
			 	}else{
			 		$getplantCode = '';
			 		$plantCode = '';
			 	}
			 	// print_r($plantCode);

			 	$strWhere = '';
			 	$strWhere1 = '';
				

				if(isset($seriesCode)  && trim($seriesCode)!=""){

					$SRCODE = trim($seriesCode);

			      	$strWhere .= " AND H.SERIES_CODE = '$SRCODE' ";
			      	$strWhere1 .= " AND H.SERIES_CODE = '$SRCODE' ";
			     
			    }
			    if(isset($plantCode)  && trim($plantCode)!=""){
			    	$plantCd = trim($plantCode);
			      	$strWhere .= " AND H.PLANT_CODE = '$plantCd' ";
			      	$strWhere1 .= " AND H.PLANT_CODE = '$plantCd' ";
			     
			    }
			    if(isset($tranType)  && trim($tranType)!=""){

			      	$strWhere .= " AND H.TRAN_TYPE = '$tranType' ";
			      	$strWhere1 .= " AND H.TRAN_TYPE = '$tranType' ";
			     
			    }
			    if(isset($accountCode)  && trim($accountCode)!=""){

			      	$strWhere .= " AND H.ACC_CODE = '$accountCode' ";
			      	$strWhere1 .= " AND H.ACC_CODE = '$accountCode' ";
			     
			    }

			    if(isset($curr_status)  && trim($curr_status)!=""){

			      	$strWhere .= " AND B.CURRENT_STATUS = '$curr_status' ";
			     
			    }

			   //  DB::enableQueryLog();

			    $data =  DB::select("SELECT H.VRNO,H.SERIES_CODE,H.FY_CODE,B.TRANSACTION_NO,B.CURRENT_STATUS,B.INVC_NO,B.DELIVERY_NO,B.ITEM_SLNO,H.SR_CODE,H.SR_NAME,B.CP_NAME,H.ACC_CODE,H.ACC_NAME,SUM(B.BASICAMT) AS BASICAMT,B.IGST,B.SGST_UGST,B.CGST,B.CAL_FRGHT_VALUE,B.CAL_BONUS_AMT,B.TARP_VALUE,B.UPLOAD_PENALTY_AMT,B.CAL_PENALTY_AMT,B.UPLOAD_BILL_AMT,B.CAL_BILL_AMT,B.SHORT_VALUE,B.LATE_DEL_VALUE,B.PAYBLE_BILL_AMT,B.RATE,SUM(B.NET_WEIGHT) AS NET_WEIGHT FROM SBILL_HEAD_PROV H LEFT JOIN SBILL_BODY_PROV B ON H.PSBILLHID= B.PSBILLHID  WHERE 1=1 $strWhere AND (B.SBILLHID IS NULL OR B.SBILLHID=0) AND H.VRDATE BETWEEN '$from_date' AND '$to_date' GROUP BY INVC_NO,ITEM_SLNO");


			 	// dd(DB::getQueryLog());

			 	return DataTables()->of($data)->addIndexColumn()->make(true);


			 }else if($request->curr_status == ''){

			 	if($series_code){
			 		$getseriesCode = explode('[',$series_code);
			 		$seriesCode = $getseriesCode[0];
			 	}else{
			 		$getseriesCode = '';
			 		$seriesCode = '';
			 	}

                // print_r($seriesCode);
			 	if($plant_code){
			 		$getplantCode = explode('[',$plant_code);
			 		$plantCode = $getplantCode[0];
			 	}else{
			 		$getplantCode = '';
			 		$plantCode = '';
			 	}
			 	// print_r($plantCode);
			 	
			 	$strWhere1 = '';
				

				if(isset($seriesCode)  && trim($seriesCode)!=""){

					$SRCODE = trim($seriesCode);

			      	$strWhere1 .= " AND H.SERIES_CODE = '$SRCODE' ";
			     
			    }
			    if(isset($plantCode)  && trim($plantCode)!=""){
			    	$plantCd = trim($plantCode);
			      	$strWhere1 .= " AND H.PLANT_CODE = '$plantCd' ";
			     
			    }
			    if(isset($tranType)  && trim($tranType)!=""){

			      	$strWhere1 .= " AND H.TRAN_TYPE = '$tranType' ";
			     
			    }
			    if(isset($accountCode)  && trim($accountCode)!=""){

			      	$strWhere1 .= " AND H.ACC_CODE = '$accountCode' ";
			     
			    }


			 	 // DB::enableQueryLog();

			 	$data =  DB::select("SELECT H.*,B.* FROM SBILL_HEAD_PROV H LEFT JOIN SBILL_BODY_PROV B ON H.PSBILLHID= B.PSBILLHID  WHERE 1=1 $strWhere1 AND H.VRDATE BETWEEN '$from_date' AND '$to_date'");

			 	// dd(DB::getQueryLog());

			 	return DataTables()->of($data)->addIndexColumn()->make(true);

			}


			 if($request->blankData == 'Blank'){

			 	$data= array();
            	return DataTables()->of($data)->addIndexColumn()->make(true);

            }else{

            	$data= array();
            	return DataTables()->of($data)->addIndexColumn()->make(true);
            }
		}

	}

	public function dailyTripReport(Request $request){

		$title        = 'Daily Trip Plan Report';
		
		$fisYear      =  $request->session()->get('macc_year');
		$splitYR      = explode('-', $fisYear);
		$startYEar    = $splitYR[0].'-04-01';

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		$userdata['trip_list']       = DB::table('TRIP_BODY')->groupBy('CP_CODE')->get();
		$userdata['trip_head_list']  = DB::table('TRIP_HEAD')->get();
		$userdata['trip_list_trans'] = DB::table('TRIP_HEAD')->groupBy('TRANSPORT_CODE')->get();
		$userdata['acc_list'] = DB::table('TRIP_HEAD')->groupBy('ACC_CODE')->get();
		$userdata['city_list']       = DB::table('MASTER_CITY')->get();
    	
    	$fyYear_info = DB::table('MASTER_FY')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->get()->first();
         
		return view('admin.finance.report.logistic.daily_trip_plan',$userdata+compact('title','fyYear_info'));
	}
    
    

	public function getdailyTripPlanReport(Request $request){

		if ($request->ajax()) {

			if (!empty($request->vehicleType || $request->acc_code  || $request->from_date || $request->to_date || $request->Consinee || $request->transpAgent || $request->plant || $request->from_place || $request->to_place)) {

				$vehicleType = $request->input('vehicleType');
				$acc_no = $request->input('acc_no');
				if($acc_no){
					$accExp = explode('-', $acc_no);
				}else{
					$accExp = '';
				}

				$from_date   = $request->input('from_date');
				$to_date     = $request->input('to_date');
				$Consinee    = $request->input('Consinee');
				if($Consinee){
					$ConsineeExp = explode('-', $Consinee);
				}else{
					$ConsineeExp = '';
				}
				
				$transpAgent = $request->input('transpAgent');
				$trspAgtExp  = explode('-', $transpAgent);
				$from_place  = $request->input('from_place');
				if($from_place){
					$fromPlaceExp   = explode('-', $from_place);
				}else{
					$fromPlaceExp   = '';
				}
				
				$to_place    = $request->input('to_place');

				if($to_place){
					$tPlaceExp   = explode('-', $to_place);
				}else{
					$tPlaceExp   = '';
				}
				
				
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

		      	 	$strWhere .= " AND H.VRDATE BETWEEN '$fromDate' AND  '$toDate' ";
		      	 }

		      	if(isset($accExp[0])  && trim($accExp[0])!=""){

					$strWhere .= " AND B.ACC_CODE = '$accExp[0]' ";

				}
				
				if(isset($ConsineeExp[0])  && trim($ConsineeExp[0])!=""){

					$strWhere .= " AND B.CP_CODE = '$ConsineeExp[0]' ";

				}

				if(isset($trspAgtExp[0])  && trim($trspAgtExp[0])!=""){

					$strWhere .= " AND H.TRANSPORT_CODE = '$trspAgtExp[0]' ";
				}

				if(isset($fPlaceExp[1])  && trim($fPlaceExp[1])!="" && isset($tPlaceExp[1])  && trim($tPlaceExp[1])!=""){

					$strWhere .= " AND B.FROM_PLACE = '$fPlaceExp[1]' AND B.TO_PLACE = '$tPlaceExp[1]' ";

				}

				if(isset($vehicleType)  && trim($vehicleType)!="" && $vehicleType == 'self' || $vehicleType == 'market' || $vehicleType == 'dump'){

					$strWhere .= " AND H.OWNER= '$vehicleType' ";

				}else{

					$strWhere .= " AND 2=2 ";
				}
				// DB::enableQueryLog();
				

					

				$data = DB::select("SELECT H.COMP_CODE AS COMPCODE,H.FY_CODE AS FYCODE,H.PFCT_CODE AS PFCTCODE,H.PFCT_NAME AS PFCTNAME,H.SERIES_CODE AS SERIESCODE,H.SERIES_NAME AS SERIESNAME,H.ACC_CODE AS ACCCODE,H.ACC_NAME AS ACCNAME,H.VRNO AS VRN,H.TRIP_NO,H.TRIPHID,H.VRDATE AS VRDT,H.PLANT_CODE AS PLANTCODE,H.PLANT_NAME AS PLANTNAME,H.FSO_NO,H.FSO_RATE,H.FSO_QTY,
					H.ROUTE_CODE,H.ROUTE_NAME,H.TRIP_DAY,H.OFF_DAY,H.FROM_PLACE AS FROMPLACE,H.TO_PLACE AS TOPLACE,
					H.VEHICLE_NO AS VEHICLENO,H.OLD_VEHICLE_NO,H.OWNER,H.TRANSPORT_CODE,H.TRANSPORT_NAME,
					H.FPO_NO,H.FPO_RATE,H.MFPO_RATE,H.AMOUNT,H.FREIGHT_QTY,H.RATE_BASIS,
					H.PAYMENT_MODE,H.TRIP_FREIGHT_AMT,H.ADV_TYPE,H.ADV_RATE,H.ADV_AMT,H.DRIVER_NAME,H.DRIVER_MOBILE,CONCAT(H.SERIES_CODE,'-',LEFT(H.FY_CODE,4),'-',H.VRNO) AS VRNO,H.VRDATE, H.FROM_PLACE,H.TO_PLACE, H.VEHICLE_NO,H.VEHICLE_TYPE,H.FREIGHT_QTY AS QTY,H.FPO_RATE,IF(H.AMOUNT>0,H.AMOUNT,(SELECT SUM(AMOUNT) FROM FLEET_TRAN_EXP E WHERE E.TRIPHID=H.TRIPHID GROUP BY E.TRIPHID)) AS AMOUNT,H.ADV_RATE,H.ADV_AMT,H.TRANSPORT_NAME, B.DO_NO, B.DO_DATE, B.ACC_NAME, B.CP_CODE,B.CP_NAME, B.ITEM_CODE,B.ITEM_NAME FROM TRIP_HEAD H, TRIP_BODY B WHERE 1=1 $strWhere AND B.TRIPHID=H.TRIPHID GROUP BY H.TRIPHID");

				// dd(DB::getQueryLog());

				// print_r($data);exit();

				return DataTables()->of($data)->addIndexColumn()->make(true);

		}

	}

	$data = array();
	return DataTables()->of($data)->addIndexColumn()->make(true);
	}


	public function ExpReport(Request $request){
		
		$title        = 'Daily Trip Plan Report';
		
		$fisYear      =  $request->session()->get('macc_year');
		$splitYR      = explode('-', $fisYear);
		$startYEar    = $splitYR[0].'-04-01';

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		$userdata['trip_list']       = DB::table('TRIP_BODY')->groupBy('CP_CODE')->get();
		$userdata['trip_head_list']  = DB::table('TRIP_HEAD')->get();
		$userdata['trip_list_trans'] = DB::table('TRIP_HEAD')->groupBy('TRANSPORT_CODE')->get();
		$userdata['acc_list'] = DB::table('TRIP_HEAD')->groupBy('ACC_CODE')->get();
		$userdata['city_list']       = DB::table('MASTER_CITY')->get();
    	
    	$fyYear_info = DB::table('MASTER_FY')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->get()->first();

    	$userdata['acc_list'] = DB::select("SELECT B.ACC_CODE,B.ACC_NAME FROM TRIP_HEAD H, TRIP_BODY B, MASTER_FLEET V, MASTER_DRIVER D, VIEW_TRIP_EXP E1, VIEW_TRIP_PMT P1 WHERE B.TRIPHID=H.TRIPHID AND E1.TRIPHID=H.TRIPHID AND P1.TRIPHID=H.TRIPHID AND V.TRUCK_NO=H.VEHICLE_NO AND D.VEHICLE_NO=H.VEHICLE_NO GROUP BY B.ACC_CODE");

    	$userdata['cp_list'] = DB::select("SELECT B.CP_CODE,B.CP_NAME FROM TRIP_HEAD H, TRIP_BODY B, MASTER_FLEET V, MASTER_DRIVER D, VIEW_TRIP_EXP E1, VIEW_TRIP_PMT P1 WHERE B.TRIPHID=H.TRIPHID AND E1.TRIPHID=H.TRIPHID AND P1.TRIPHID=H.TRIPHID AND V.TRUCK_NO=H.VEHICLE_NO AND D.VEHICLE_NO=H.VEHICLE_NO GROUP BY B.CP_CODE");

    	$userdata['item_list'] = DB::select("SELECT B.ITEM_CODE,B.ITEM_NAME FROM TRIP_HEAD H, TRIP_BODY B, MASTER_FLEET V, MASTER_DRIVER D, VIEW_TRIP_EXP E1, VIEW_TRIP_PMT P1 WHERE B.TRIPHID=H.TRIPHID AND E1.TRIPHID=H.TRIPHID AND P1.TRIPHID=H.TRIPHID AND V.TRUCK_NO=H.VEHICLE_NO AND D.VEHICLE_NO=H.VEHICLE_NO GROUP BY B.ITEM_CODE");

    	$fyYear_info = DB::table('MASTER_FY')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->get()->first();

    	
		if(isset($comp_nameval)){

    		return view('admin.finance.report.logistic.daily_trip_expense',$userdata+compact('title','fyYear_info'));

	    }else{

			return redirect('/useractivity');
		}
	}

	public function dailyExpenseReport(Request $request){


		$compName   = $request->session()->get('company_name');
		$getcomcode = explode('-', $compName);
		$compCode   = $getcomcode[0];

		$MCOMP_CODE = $compCode;
		$strWhere = '';
		$str_Where = '';



		if ($request->ajax()) {
			// DB::enableQueryLog();
			
		   

			if (!empty($request->from_date || $request->to_date || $request->acc_no || $request->cust_no || $request->item_code)) {


			// DB::enableQueryLog();
		 //    $data = DB::select('DROP VIEW_TRIP_EXP');

		    // dd(DB::getQueryLog());

             
				$from_date = $request->from_date;

				$fromdate = date("Y-m-d", strtotime($request->from_date));
				

				$to_date = $request->to_date;

				$todate = date("Y-m-d", strtotime($request->to_date));
				

                $acc_code = $request->acc_no;
                $accCode = '';
                if($acc_code){
                	$gen_acccode = explode('-',$acc_code);
                	$accCode = $gen_acccode[0];
                }else{
                	$accCode = '';
                }

                $cust_no = $request->cust_no;
                $custCode = '';
                if($cust_no){
                	$gen_custcode = explode('-',$cust_no);
                	$custCode = $gen_custcode[0];
                }else{
                	$custCode = '';
                }

                $item_code = $request->item_code;
                $itemCode = '';
                if($item_code){
                	$gen_itemcode = explode('-',$item_code);
                	$itemCode = $gen_itemcode[0];
                }else{
                	$itemCode = '';
                }


				if(isset($accCode)  && trim($accCode)!=""){

		            $strWhere .= "AND B.ACC_CODE = '$accCode' ";
		           
		        }

		        if(isset($custCode)  && trim($custCode)!=""){

		            $strWhere .= "AND B.CP_CODE = '$custCode' ";
		           
		        }

		        if(isset($itemCode)  && trim($itemCode)!=""){

		            $strWhere .= "AND B.ITEM_CODE = '$itemCode' ";
		           
		        }

                 // DB::enableQueryLog();

				$data = DB::select("SELECT H.TRIPHID,CONCAT(H.SERIES_CODE,'-',LEFT(H.FY_CODE,4),'-',H.VRNO) AS VRNO,H.VRDATE,B.LR_NO, B.LR_DATE, H.FROM_PLACE,H.TO_PLACE,V.LOAD_AVG, V.UL_AVG,V.EMPTY_AVG, (SELECT E.KM FROM TRIP_EXPENSE_ROUTE E WHERE E.TRIPHID=H.TRIPHID AND E.VEHICLE_TYPE='fullload' GROUP BY E.TRIPHID) AS LOAD_KM, (SELECT SUM(E.KM) FROM TRIP_EXPENSE_ROUTE E WHERE E.TRIPHID=H.TRIPHID AND E.VEHICLE_TYPE='empty' GROUP BY E.TRIPHID) AS EMPTY_KM, H.VEHICLE_NO,V.MODEL,H.FREIGHT_QTY,ROUND(H.FREIGHT_QTY-V.LOAD_CPCT, 3) AS ENHANCE_QTY, V.ENH_RATE, ROUND((B.QTY-V.LOAD_CPCT)*V.ENH_RATE,2) AS ENHANCE_AMT, B.ITEM_NAME, D.EMP_NAME, D.MOBILE_NO, H.TRANSPORT_NAME, (SELECT SUM(DIESEL_AMT) FROM FLEET_TRAN_PMT P WHERE P.TRIPHID=H.TRIPHID GROUP BY P.TRIPHID) AS DIESELAMT, (SELECT SUM(CASH_AMT) FROM FLEET_TRAN_PMT P WHERE P.TRIPHID=H.TRIPHID GROUP BY P.TRIPHID) AS CASHAMT, E1.*,P1.*, B.CP_NAME FROM TRIP_HEAD H, TRIP_BODY B, MASTER_FLEET V, MASTER_DRIVER D, VIEW_TRIP_EXP E1, VIEW_TRIP_PMT P1 WHERE 1=1 $strWhere AND H.VRDATE BETWEEN '$fromdate' AND '$todate' AND B.TRIPHID=H.TRIPHID AND E1.TRIPHID=H.TRIPHID AND P1.TRIPHID=H.TRIPHID AND V.TRUCK_NO=H.VEHICLE_NO AND D.VEHICLE_NO=H.VEHICLE_NO GROUP BY H.TRIPHID");

				// print_r($data);exit();

				 // dd(DB::getQueryLog());

				return DataTables()->of($data)->make(true);

			}else if($request->blankData == 'Blank'){

				// print_r('blank');

		    	$data = array();
		    	return DataTables()->of($data)->make(true);

	        }else{

	        	$data = array();
		    	return DataTables()->of($data)->make(true);

	        }

			

			
		}
	}


}