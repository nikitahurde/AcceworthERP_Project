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
use Intervention\Image\Facades\Image as Image;
use Response;


class ApiController extends Controller{

public function __construct(Request $request){
}

// public function testApi(Request $request){

// 	echo "Welcome";
// }

public function SignIn(Request $request){

	$validation = Validator::make($request->all(),[ 
		'USER_CODE' => 'required',
		'PASSWORD'  => 'required',
		'DEVICE_ID' => 'required',
		'FCM_TOKEN' => 'required',
    ]);

   $response_array = [];

	if($validation->fails()){
     
	     $response_array['response'] =  $validation->messages();
				
		 $data = json_encode($response_array);

		 return $data;

    }else{

		$usercode  = $request->USER_CODE;
		$pass      = md5($request->PASSWORD);
		$device_id = $request->DEVICE_ID;
		$fcm_token = $request->FCM_TOKEN;
	
   	    $checkData = DB::table('MASTER_USER')->select('USER_CODE','USER_NAME','ACC_CODE','PASSWORD','DEVICE_ID','FCM_TOKEN','EMAIL_ID','USER_TYPE','ZONE_ID','STATUS','OTP','ACCESS_FLAG','FLAG','LOGIN_IP')->where('USER_CODE',$usercode)->where('PASSWORD',$pass)->get()->first();


   	    if($checkData){

   	    	$checkImg = DB::table('MASTER_USER')->select('IMAGE')->where('USER_CODE',$usercode)->where('PASSWORD',$pass)->get()->first();

   	    	$usrImg = base64_encode($checkImg->IMAGE);

			$chkDeviceId = $checkData->DEVICE_ID;
			$chkFcmToken = $checkData->FCM_TOKEN;
	        
	        if($chkDeviceId == '' &&  $chkFcmToken == '' || $chkDeviceId == '' || $chkFcmToken == '' ){

				$deviceData = array(
		          'DEVICE_ID' => $device_id,
		          'FCM_TOKEN' => $fcm_token,
				);

				$save = DB::table('MASTER_USER')->where('USER_CODE',$usercode)->where('PASSWORD',$pass)->update($deviceData);

				$getData = DB::table('MASTER_USER')->where('USER_CODE',$usercode)->where('PASSWORD',$pass)->get();

				$response_array['response'] = 'Success';
				$response_array['Message']  = 'Sign In Successfully';
				$response_array['Data']     = $checkData;
				$response_array['UserImg']  = $usrImg;
				
				$data = json_encode($response_array);

				return $data;

			}else{
	      
		      if($chkDeviceId == $device_id){

		      	$fcmTokenData = array(
		         'FCM_TOKEN'  => $fcm_token,
		      	);
		      
		        $save = DB::table('MASTER_USER')->where('USER_CODE',$usercode)->where('PASSWORD',$pass)->update($fcmTokenData);


                $databaseName = \DB::connection()->getDatabaseName();

				$response_array['response'] = 'Success';
				$response_array['Message']  = 'Sign In Successfully';
				$response_array['Data']     = $checkData;
				$response_array['UserImg']  = $usrImg;
				
				$data = json_encode($response_array);

				return $data;

		      }else{

				$response_array['response'] = 'Error';
				$response_array['Message']  = 'Device Id Not Found';
				$response_array['Data']     = '';
				$response_array['UserImg']  = '';
				
				$data = json_encode($response_array);

				return $data;

		      }
		  }

	    }else{

			$response_array['response'] = 'Error';
			$response_array['Message']  = 'You Entered an Incorrect User Name or Password';
			$response_array['Data']     = '';
			$response_array['UserImg']  = '';
				
			$data = json_encode($response_array);

			return $data;

	    }


	}

}

public function getData(Request $request){
	
	$usercode  = $request->USER_CODE;
	$username  = $request->USER_NAME;
	$usertype  = $request->USER_TYPE;
	$comp_name = $request->COMPANY_NAME;
	$macc_year = $request->FY_YEAR;

	$session = array(
					
		'userid'       => $usercode,
		'username'     => $username,
		'usertype'     => $usertype,
		'company_name' => $comp_name,
		'macc_year'    => $macc_year,
		'last_login'   => time(),
		'flag'         => 1,
		'login'        => TRUE
	);

	Session::put($session);

	// $userid = $request->session()->get('userid');
	// $userid = 'raj';
	$response_array  = array();

	if($usercode!= ''){

		$response_array['response']='Login Data Push on Session';
		$response_array['data']=$session;

		$data = json_encode($response_array);

		return $data;


	}else{

		$response_array['response']='Login Data can not push on Session';
		$response_array['data']= '';

		$data = json_encode($response_array);

		return $data;

	}
}

public function ePODTruckList(Request $request){

	$truckData = DB::table('TRIP_HEAD')->get();

	$countData= count($truckData);

	$truck_list = array();

	for ($i=0; $i < $countData; $i++) { 

		array_push($truck_list, $truckData[$i]->VEHICLE_NO );
	}
	
    $response_array = array();

	if($truck_list){

		$response_array['response'] = 'Success';
		$response_array['Message']  = 'Vehical List';
		$response_array['Data']     = $truck_list;

		$data = json_encode($response_array);

		return $data;
		
	}else{

		$response_array['response'] = 'Error';
		$response_array['Message']  = 'Vehical List Not Found';
		$response_array['Data']     = '';

		$data = json_encode($response_array);

		return $data;

	}
}

public function ePODTripDetails(Request $request){

	$vehical_no = $request->TRUCK_NO;

	if($vehical_no){

		// $trip_plan = DB::select("SELECT t1.*,t2.* FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID  WHERE t1.VEHICLE_NO='$vehical_no'");
        
        $trip_head = DB::table('TRIP_HEAD')->where('VEHICLE_NO',$vehical_no)->get()->first();

        $tripId = $trip_head->TRIPHID;

        $trip_body = DB::table('TRIP_BODY')->where('TRIPHID',$tripId)->get();


		if($trip_head) {

				$response_array['response']  = 'Success';
				$response_array['Message']   = 'Trip Data';
				$response_array['Head Data'] =  $trip_head ;
				$response_array['Body Data'] =  $trip_body ;
	          
	            $data = json_encode($response_array);

	            return $data;

			}else{

				$response_array['response'] = 'Error';
				$response_array['Message']  = 'Trip Data Not Found' ;
				$response_array['Data']     = '' ;
         

                $data = json_encode($response_array);

                return $data;
				
			}
	}else{

		$response_array['response'] = 'Error';
		$response_array['Message']  = 'Truck No Not Found' ;
		$response_array['Data']     = '' ;
 

        $data = json_encode($response_array);

        return $data;


	}
}

public function ePODUpdateTrip(Request $request){

    $validation = Validator::make($request->all(),[ 
		'TRIP_NO'       => 'required',
		'SERIES_CODE'   => 'required',
		'VEHICLE_NO'    => 'required',
		'REPORT_DATE'   => 'required',
		'ACK_DATE'      => 'required',
		'ARRIVAL_DATE'  => 'required',
		'DELIVERY_DATE' => 'required',
    ]);

   $response_array = [];

	if($validation->fails()){
     
	     $response_array['response'] =  $validation->messages();
				
		 $data = json_encode($response_array);

		 return $data;

    }
    else{

        $createdBy   = $request->session()->get('userid');
    	$fisYear     =  $request->session()->get('macc_year');
    	// $compName    = $request->session()->get('company_name');
    	// $createdBy = 'admin';
    	// $fisYear = '2022-2023';
		
		// $getcompcode = explode('-', $compName);
		
		// $comp_code   =	$getcompcode[0];
		// $comp_name   =	$getcompcode[1];

		$report_date   = $request->REPORT_DATE;
		$ack_date      = $request->ACK_DATE;
		$arrival_date  = $request->ARRIVAL_DATE;
		$delivery_date = $request->DELIVERY_DATE;
		$received_qty  = $request->RECEIVED_QTY;
		$trip_no       = $request->TRIP_NO;
		$series_code   = $request->SERIES_CODE;
		$vehical_no    = $request->VEHICLE_NO;
		$trip_body     = $request->Trip_body;

        $reportDate = date('Y-m-d',strtotime($report_date));

		$ackDt        = explode(' ', $ack_date);
		$acknow_dt    = date('Y-m-d',strtotime($ackDt[0])); 
		$acknow_time  = $ackDt[1]; 
		$acknow_a     = $ackDt[2]; 

		$acknowle_DT = $acknow_dt. ' ' .$acknow_time. ' ' .$acknow_a ;

		$va_date = explode(' ', $arrival_date);
		$varr_date = date('Y-m-d',strtotime($va_date[0])); 
		$varr_time = $va_date[1]; 
		$varr_a = $va_date[2]; 

		$vehicalArr_DT = $varr_date. ' ' .$varr_time. ' ' .$varr_a ;

		$deliveryDate = date('Y-m-d',strtotime($delivery_date)); 

        $tripB_data = array();

		$data = array(

			'REPORT_DATE'    => $reportDate,
			'ACK_DATE'       => $acknowle_DT,
			'ARRIVAL_DATE'   => $vehicalArr_DT,
			'DELIVERY_DATE'  => $deliveryDate,
			'RECEIVED_QTY'   => $received_qty,
			'LAST_UPDATE_BY' => $createdBy,
			
			
		);

		$updateData = DB::table('TRIP_HEAD')->where('TRIP_NO',$trip_no)->where('VEHICLE_NO',$vehical_no)->where('SERIES_CODE',$series_code)->where('FY_CODE',$fisYear)->update($data);

		$chkData = DB::table('TRIP_HEAD')->where('TRIP_NO',$trip_no)->where('VEHICLE_NO',$vehical_no)->where('SERIES_CODE',$series_code)->where('FY_CODE',$fisYear)->get()->first();

		$id = $chkData->TRIPHID ;

		$countBodyD = count($trip_body);

		for ($i=0; $i < $countBodyD; $i++) { 
        
          $data1 = array(
			
			'RECD_QTY'       => $trip_body[$i]['RECEIVED_QTY'],
			'SHORTAGE_QTY'   => $trip_body[$i]['SHORTAGE_QTY'],
			'LAST_UPDATE_BY' => $createdBy,
		  );
          
          $updateData1 = DB::table('TRIP_BODY')->where('ITEM_CODE',$trip_body[$i]['ITEM_CODE'])->where('TRIPHID',$id)->where('SERIES_CODE',$series_code)->where('FY_CODE',$fisYear)->update($data1);
          
          if($updateData1){
          	 $tripB_data[] = $updateData1;
          }
       
       }

       $countT_body = count($tripB_data);

		if($updateData && $countT_body > 0){

			$response_array['response'] = 'Success';
            $response_array['Message'] = 'Trip Data';
            $response_array['data'] = '';
           
            $data = json_encode($response_array);

            return $data;

		}else{

			$response_array['response'] = 'Error';
            $response_array['Message'] = 'Trip Data Can Not Updated';
           
            $data = json_encode($response_array);

            return $data;

		}

 }   

}

public function empPunchAttendance(Request $request){

	$validation = Validator::make($request->all(),[ 
		'EMP_CODE'   => 'required',
		'DEVICE_ID'  => 'required',
		'DEVICE_LOC' => 'required',
		'DEVICE_ADD' => 'required',
		'FCM_TOKEN'  => 'required',
		'EMP_SELFIE' => 'required',
		'DATE'       => 'required',
		'TIME'       => 'required',
    ]);

   $response_array = [];

	if($validation->fails()){
     
	     $response_array['response'] =  $validation->messages();
				
		 $data = json_encode($response_array);

		 return $data;

    }else{

		$emp_code     = $request->EMP_CODE;
		$comp_code    = $request->COMP_CODE;
		$fy_year      = $request->FY_CODE;
		$device_id    = $request->DEVICE_ID;
		$device_loc   = $request->DEVICE_LOC;
		$device_add   = $request->DEVICE_ADD;
		$fcm_token    = $request->FCM_TOKEN;
		$selfie_image = $request->EMP_SELFIE;
		$date         = $request->DATE;
		$time         = $request->TIME;

		$day=strtotime($date);
		$month=date("F",$day);
		$year=date("Y",$day);

		$year_month = $month .' '.$year;

		$empData = DB::table('MASTER_EMP')->where('EMP_CODE',$emp_code)->where('COMP_CODE',$comp_code)->get()->first();

        if($empData){

        	$emp_name = $empData->EMP_NAME;
        	$emp_comp_name = $empData->COMP_NAME;
        	$att_date =  date("Y-m-d", strtotime($date));
           
            $usrImg = base64_encode($selfie_image);
            $image      = Image::make($usrImg);

			Response::make($image->encode('jpeg'));

            $data = array(
				"FY_CODE"         => $fy_year,
				"COMP_CODE"       => $comp_code,
				"COMP_NAME"       => $emp_comp_name,
				"YR_MONTH"        => $year_month,
				"EMP_CODE"        => $emp_code,
				"EMP_NAME"        => $emp_comp_name,
				"DATE"            => $att_date,
				"TIME"            => $time,
				"DEVICE_ID"       => $device_id,
				"DEVICE_LOCATION" => $device_loc,
				"DEVICE_ADDRESS"  => $device_add,
				"FCM_TOKEN"       => $fcm_token,
				"EMP_SELFIE"      => $image,
				"FLAG"            => '1',
				
			
			);

			$saveData = DB::table('EMP_ATTENDANCE')->insert($data);
			if($saveData){

				$response_array['response'] =  'success';                  
	        	$response_array['Data'] =  '';                  
				$data = json_encode($response_array);

			    return $data;

			}else{

				$response_array['response'] =  'error';                  
	        	$response_array['Data'] =  '';                  
				$data = json_encode($response_array);

			    return $data;

			}

		 }else{

        	$response_array['response'] =  'error1';                  
        	$response_array['Data'] =  '';                  
			$data = json_encode($response_array);
			return $data;

        }
    }
  }

  public function SelectCompName(Request $request){

	$comp_name = DB::table('MASTER_COMP')->get();

	$response_array = array();

	if($comp_name){

		$response_array['response']   = 'Success';
		$response_array['Message']    = 'Company Name List';
		$response_array['Data']       = $comp_name;
		
		$data = json_encode($response_array);

		return $data;
		
	}else{

		$response_array['response']   = 'Error';
		$response_array['Message']    = 'Company Name List Not Found';
		$response_array['Data']       = '';
		

		$data = json_encode($response_array);

		return $data;

	}
	
}

public function listFyYear(Request $request){

	$validation = Validator::make($request->all(),[ 
		'COMP_CODE'       => 'required'
		
    ]);

   $response_array = [];

	if($validation->fails()){
     
	     $response_array['response'] =  $validation->messages();
				
		 $data = json_encode($response_array);

		 return $data;

    }else{

    	$comp_code = $request->COMP_CODE;

    	if($comp_code){

    		$getyear = DB::table('MASTER_FY')->where('COMP_CODE',$comp_code)->Orderby('FY_CODE', 'desc')->get();

    		$count = count($getyear);

    		if($count == 0){

    			$response_array['response']   = 'Error';
				$response_array['Message']    = 'Fy List Not Found';
				$response_array['Data']       =  '';
				
				$data = json_encode($response_array);
				
				return $data;
	

    		}else{

	    		$response_array['response']   = 'Success';
				$response_array['Message']    = 'Fy List';
				$response_array['Data']       = $getyear;
				
				$data = json_encode($response_array);
				
				return $data;

    		}
	

    	}else{

    		$response_array['response']   = 'Error';
			$response_array['Message']    = 'Company Code Required';
			$response_array['Data']       =  '';
			
			$data = json_encode($response_array);
			
			return $data;

    	}
    }

  }

  public function TripLrStatus(Request $request){

	// $getcom_code = 'SA';
 //    $fisYear = '2022-2023';

  	$comp_nameval = $request->session()->get('company_name');
	$getcompcode  = explode('-', $comp_nameval);
	$getcom_code  = $getcompcode[0];
	$comp_name    = $getcompcode[1];
	$fisYear      = $request->session()->get('macc_year');
    // $fisYearSS     =  $request->session()->get('macc_year');

    $do_data = DB::table('DORDER_BODY')->where('COMP_CODE', $getcom_code)->where('FY_CODE',$fisYear)->get();

	$count_doData = count($do_data);

	$tripbody_data = DB::table('TRIP_BODY')->where('COMP_CODE', $getcom_code)->where('FY_CODE',$fisYear)->get();

	$count_tripB =  count($tripbody_data);

    $do_count=0;

	for($i=0;$i<$count_doData;$i++){

		$doNo = $do_data[$i]->DORDER_NO;

		$tripbody_data = DB::table('TRIP_BODY')->where('COMP_CODE', $getcom_code)->where('FY_CODE',$fisYear)->where('DO_NO',$doNo)->get();

		$rowCount = count($tripbody_data);
		if($rowCount == 0){
			$do_count = $do_count+1;
		}else{
		}

	}

	$count_lr = 0;
    $do_lr = array();
    $head_id = array();
    $sl_no = array();

	for($i=0;$i<$count_doData;$i++){

		$doNo = $do_data[$i]->DORDER_NO;
		$slNo = $do_data[$i]->SLNO;

		$tripbody_data = DB::table('TRIP_BODY')->where('COMP_CODE', $getcom_code)->where('FY_CODE',$fisYear)->where('DO_NO',$doNo)->where('SLNO',$slNo)->get();

		$counttrip = count($tripbody_data);
		
		if($counttrip > 0){

			for($m=0;$m<$counttrip;$m++){

				$chk_lrno = $tripbody_data[$m]->LR_NO;
				$headId = $tripbody_data[$m]->TRIPHID;

				if($chk_lrno == ''){
				 $count_lr = $count_lr + 1;

                 array_push($do_lr, $doNo);
                 array_push($head_id, $headId);
                 array_push($sl_no, $slNo);
                }else{

				}

			}

		}else{

		}

	}

	$not_availLr = count($do_lr);
	
	$doLr_info = array();
    $countdolr = 0;
	for($k=0;$k<$not_availLr;$k++){

		$doLr_find = DB::select("SELECT p1.DO_NO as do_no,p2.DORDER_DATE as dorder_dt,p2.DORDER_NO as dorder_no,p2.CP_CODE as cp_code,p2.CP_NAME as cp_name,p2.TO_PLACE as to_place,p1.ITEM_CODE as item_code,p1.ITEM_NAME as item_name,p1.QTY as qty,p1.UM as um,p2.ACC_CODE as acc_code,p2.ACC_NAME as acc_name, p3.TRIP_NO as trip_no,p3.VRDATE as trip_dt from TRIP_BODY p1 LEFT JOIN DORDER_BODY p2 ON p1.DO_NO = p2.DORDER_NO AND p1.SLNO = p2.SLNO LEFT JOIN TRIP_HEAD p3 ON p3.TRIPHID = p1.TRIPHID WHERE p2.COMP_CODE = '$getcom_code' AND p2.FY_CODE = '$fisYear' AND p2.DORDER_NO = '$do_lr[$k]' AND p2.SLNO = '$sl_no[$k]' AND p3.TRIPHID = '$head_id[$k]' ");

		if($doLr_find){
			array_push($doLr_info,$doLr_find);
			$countdolr = $countdolr + count($doLr_find);
		}else{

		}
    } 

    $countLR = count($doLr_info);


    // PENDING EPOD TRIP LR COUNT

    $epodData = DB::select("SELECT H.TRIPHID,B.TRIPHID,H.EPOD_STATUS, D.VRDATE AS DO_DATE,D.DORDER_NO AS DO_NUMBER,B.LR_NO,B.LR_DATE,H.VEHICLE_NO,D.CP_CODE,D.CP_NAME,B.ITEM_CODE,B.ITEM_NAME, B.QTY,B.UM,B.ACC_CODE,B.ACC_NAME FROM TRIP_HEAD H INNER JOIN TRIP_BODY B ON H.TRIPHID = B.TRIPHID INNER JOIN DORDER_BODY D ON B.DO_NO = D.DORDER_NO AND B.SLNO = D.SLNO WHERE H.EPOD_STATUS = 0 AND H.COMP_CODE = '$getcom_code' AND H.FY_CODE = '$fisYear';");
 

	$pending_epod_count = count($epodData);

	// Count E-way bill Status 

	$ewaybill_info = DB::select("SELECT H.TRIPHID,B.TRIPHID,H.LR_ACK_STATUS, D.VRDATE AS DO_DATE,D.DORDER_NO AS DO_NUMBER,B.LR_NO,B.LR_DATE,B.VEHICLE_NO,D.CP_CODE,D.CP_NAME,B.ITEM_CODE,B.ITEM_NAME, B.QTY,B.ACC_CODE,B.ACC_NAME,B.EBILL_NO, B.EWAYB_VALIDDT FROM TRIP_HEAD H INNER JOIN TRIP_BODY B ON H.TRIPHID = B.TRIPHID INNER JOIN DORDER_BODY D ON B.DO_NO = D.DORDER_NO AND B.SLNO = D.SLNO WHERE  H.LR_STATUS = 1 AND H.LR_ACK_STATUS = 0 AND H.COMP_CODE = '$getcom_code' AND H.FY_CODE = '$fisYear'");

	$countEwb = count($ewaybill_info);

	// PENDING LR ACK

	$pending_lrAck = DB::table('TRIP_HEAD')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('LR_ACK_STATUS',0)->get(); 

	$pending_lrAck_count = count($pending_lrAck);

	$lr_ack = array();

	$lrAck_count = 0;

	for($i=0;$i<$pending_lrAck_count;$i++){

		$tripHId = $pending_lrAck[$i]->TRIPHID;

		$lr_data = DB::select("SELECT p1.VEHICLE_NO as vehical_no,p1.ITEM_CODE as item_code,p1.ITEM_NAME as item_name,p1.QTY as qty,p1.UM as um, p1.*, p2.* FROM TRIP_BODY p1 LEFT JOIN DORDER_BODY p2 ON p1.DO_NO = p2.DORDER_NO
			LEFT JOIN TRIP_HEAD p3 ON p3.TRIPHID = p1.TRIPHID 
            WHERE p2.COMP_CODE = '$getcom_code' AND p2.FY_CODE = '$fisYear' AND p1.TRIPHID = '$tripHId'");

		array_push($lr_ack,$lr_data);
		$lrAck_count = $lrAck_count + count($lr_data);

	}


	// DO PLANNING

	$acc_list = DB::table('DORDER_HEAD')->where('COMP_CODE', $getcom_code)->where('FY_CODE',$fisYear)->groupBy('ACC_CODE')->get();

	$series_list = DB::table('DORDER_HEAD')->where('COMP_CODE', $getcom_code)->where('FY_CODE',$fisYear)->groupBy('SERIES_CODE')->get();
    

	if($count_doData >= 0){
		$response_array['response']       =  'success';    
		$response_array['count_doLr']     =  $countdolr;                  
		$response_array['epod_count']     =  $pending_epod_count;                  
		$response_array['lr_ack_count']   =  $lrAck_count;                  
		$response_array['ewaybill_count'] =  $countEwb;                  
		// $response_array['epod_data']      = $epodData;                  
		// $response_array['do_lr_data']     = $doLr_info;                  
		// $response_array['lr_ack_data']    = $lr_ack;                  
		// $response_array['ewaybill_data']  = $ewaybill_info;                  
		// $response_array['acc_list']       = $acc_list;                  
		// $response_array['series_list']    = $series_list;                  
		$data   = json_encode($response_array);

	    return $data;

	}else{

		$response_array['response']       =  'error';                  
		$response_array['count_doLr']     =  '';                  
		$response_array['epod_count']     =  '';                  
		$response_array['lr_ack_count']   =  '';                  
		$response_array['ewaybill_count'] =  '';  
		$response_array['acc_list']       =  '';                  
		$response_array['series_list']    =  '';                   
		$response_array['Data']           =  '';                  
		$data   = json_encode($response_array);

	    return $data;

	}
 }

 public function lrTrips(Request $request){

 	// $getcom_code = 'SA';
  //   $fisYear = '2022-2023';
    $comp_nameval = $request->session()->get('company_name');
	$getcompcode  = explode('-', $comp_nameval);
	$getcom_code  = $getcompcode[0];
	$comp_name    = $getcompcode[1];
	$fisYear      = $request->session()->get('macc_year');


    $do_data = DB::table('DORDER_BODY')->where('COMP_CODE', $getcom_code)->where('FY_CODE',$fisYear)->get();

	$count_doData = count($do_data);

	$tripbody_data = DB::table('TRIP_BODY')->where('COMP_CODE', $getcom_code)->where('FY_CODE',$fisYear)->get();

	$count_tripB =  count($tripbody_data);

    $count_lr = 0;
    $do_lr = array();
    $head_id = array();
    $sl_no = array();

	for($i=0;$i<$count_doData;$i++){

		$doNo = $do_data[$i]->DORDER_NO;
		$slNo = $do_data[$i]->SLNO;
		
		$tripbody_data = DB::table('TRIP_BODY')->where('COMP_CODE', $getcom_code)->where('FY_CODE',$fisYear)->where('DO_NO',$doNo)->where('SLNO',$slNo)->get();

		$counttrip = count($tripbody_data);
		
		if($counttrip > 0){

			for($m=0;$m<$counttrip;$m++){

				$chk_lrno = $tripbody_data[$m]->LR_NO;
				$headId = $tripbody_data[$m]->TRIPHID;

				if($chk_lrno == ''){
				 $count_lr = $count_lr + 1;

                 array_push($do_lr, $doNo);
                 array_push($head_id, $headId);
                 array_push($sl_no, $slNo);
                }else{

				}

			}
        }else{

		}

	 }

	$not_availLr = count($do_lr);
	
	$doLr_info = array();
    for($k=0;$k<$not_availLr;$k++){
        
        $doLr_find = DB::select("SELECT p1.DO_NO as do_no,p2.DORDER_DATE as dorder_dt,p2.DORDER_NO as dorder_no,p2.CP_CODE as cp_code,p2.CP_NAME as cp_name,p2.TO_PLACE as to_place,p1.ITEM_CODE as item_code,p1.ITEM_NAME as item_name,p1.QTY as qty,p1.UM as um,p2.ACC_CODE as acc_code,p2.ACC_NAME as acc_name, p3.TRIP_NO as trip_no,p3.VRDATE as trip_dt from TRIP_BODY p1 LEFT JOIN DORDER_BODY p2 ON p1.DO_NO = p2.DORDER_NO AND p1.SLNO = p2.SLNO LEFT JOIN TRIP_HEAD p3 ON p3.TRIPHID = p1.TRIPHID WHERE p2.COMP_CODE = '$getcom_code' AND p2.FY_CODE = '$fisYear' AND p2.DORDER_NO = '$do_lr[$k]' AND p2.SLNO = '$sl_no[$k]' AND p3.TRIPHID = '$head_id[$k]' ");

		if($doLr_find){

			array_push($doLr_info,$doLr_find);
			
		}else{

		}
	}

	$username = $request->session()->get('username');

	if($doLr_info){

		$response_array['response']     =  'Data';    
		$response_array['lrTrips_data'] =  $doLr_info;                  
		                
		$data   = json_encode($response_array);

	    return $data;

	}else{

		$response_array['response']     =  'Data not found';  
		$response_array['lrTrips_data'] =  $doLr_info;                  
		              
		$data   = json_encode($response_array);

	    return $data;

	} 	

 }

 public function epodData(Request $request){
    
    // $getcom_code = 'SA';
    // $fisYear = '2022-2023';
    $comp_nameval = $request->session()->get('company_name');
	$getcompcode  = explode('-', $comp_nameval);
	$getcom_code  = $getcompcode[0];
	$comp_name    = $getcompcode[1];
	$fisYear      = $request->session()->get('macc_year');

    $pending_epod = DB::table('TRIP_HEAD')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('EPOD_STATUS',0)->get(); 

	$epodData = DB::select("SELECT H.TRIPHID,B.TRIPHID,H.EPOD_STATUS, D.VRDATE AS DO_DATE,D.DORDER_NO AS DO_NUMBER,B.LR_NO,B.LR_DATE,H.VEHICLE_NO,D.CP_CODE,D.CP_NAME,B.ITEM_CODE,B.ITEM_NAME, B.QTY,B.UM,B.ACC_CODE,B.ACC_NAME FROM TRIP_HEAD H INNER JOIN TRIP_BODY B ON H.TRIPHID = B.TRIPHID INNER JOIN DORDER_BODY D ON B.DO_NO = D.DORDER_NO AND B.SLNO = D.SLNO WHERE H.EPOD_STATUS = 0 AND H.COMP_CODE = '$getcom_code' AND H.FY_CODE = '$fisYear';");

	if($epodData){
		$response_array['response']      =  'Data';    
		$response_array['data']          =  $epodData;                  
		                
		$data   = json_encode($response_array);

	    return $data;

	}else{

		$response_array['response'] =  'Data Not Found';                  
    	$response_array['data']     =  '';                  
		            
		$data   = json_encode($response_array);

	    return $data;

	}
 }

 public function doPlanningApi(Request $request){

 	
 	// $comp_code = 'SA';
  //   $fisYear = '2022-2023';
 	$comp_nameval = $request->session()->get('company_name');
	$getcompcode  = explode('-', $comp_nameval);
	$comp_code  = $getcompcode[0];
	$comp_name    = $getcompcode[1];
	$fisYear      = $request->session()->get('macc_year');
    $aa=$request->acc_code;
    $sa=$request->series_code;

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

		$data = DB::select("SELECT t1.DORDER_DATE as do_date,t1.DORDER_NO,t1.CP_CODE,t1.CP_NAME,t1.TO_PLACE,t1.ITEM_CODE,t1.ITEM_NAME,t1.QTY,t1.UM,t1.ACC_CODE,t1.ACC_NAME,t1.SERIES_CODE FROM DORDER_BODY t1 LEFT JOIN DORDER_HEAD t2 ON t2.ACC_CODE = t1.ACC_CODE AND t2.DORDERHID = t1.DORDERHID   WHERE (t1.QTY - t1.DISPATCH_PLAN_QTY > 0) AND  1=1 $strWhere  AND t1.COMP_CODE='$comp_code' AND t1.FY_CODE ='$fisYear'");
		
	}else if($request->allData == 'blank'){

		$data = DB::select("SELECT t1.DORDER_DATE as do_date,t1.DORDER_NO,t1.CP_CODE,t1.CP_NAME,t1.TO_PLACE,t1.ITEM_CODE,t1.ITEM_NAME,t1.QTY,t1.UM,t1.ACC_CODE,t1.ACC_NAME,t1.SERIES_CODE FROM DORDER_BODY t1 LEFT JOIN DORDER_HEAD t2 ON t2.ACC_CODE = t1.ACC_CODE AND t2.DORDERHID = t1.DORDERHID   WHERE (t1.QTY - t1.DISPATCH_PLAN_QTY > 0)  AND t1.COMP_CODE='$comp_code' AND t1.FY_CODE ='$fisYear'");

	}else{

		$data = array();

	    
	}

    if($data){
		$response_array['response']      =  'Search Data';    
		$response_array['search_data']   =  $data;                  
		                
		$data   = json_encode($response_array);

	    return $data;

	}else{

		$response_array['response'] =  'Data Not Found';                  
    	$response_array['search_data']    =  '';                  
		            
		$data   = json_encode($response_array);

	    return $data;

	}

 }

 public function lrAck(Request $request){

 	// $getcom_code = 'SA';
  //   $fisYear = '2022-2023';
 	$comp_nameval = $request->session()->get('company_name');
	$getcompcode  = explode('-', $comp_nameval);
	$getcom_code  = $getcompcode[0];
	$comp_name    = $getcompcode[1];
	$fisYear      = $request->session()->get('macc_year');

    $pending_lrAck = DB::table('TRIP_HEAD')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('LR_ACK_STATUS',0)->get(); 

	$pending_lrAck_count = count($pending_lrAck);

	$lr_ack = array();

	for($i=0;$i<$pending_lrAck_count;$i++){

		$tripHId = $pending_lrAck[$i]->TRIPHID;

		$lr_data = DB::select("SELECT p1.VEHICLE_NO as vehical_no,p1.ITEM_CODE as item_code,p1.ITEM_NAME as item_name,p1.QTY as qty,p1.UM as um, p1.*, p2.* FROM TRIP_BODY p1 LEFT JOIN DORDER_BODY p2 ON p1.DO_NO = p2.DORDER_NO
			LEFT JOIN TRIP_HEAD p3 ON p3.TRIPHID = p1.TRIPHID 
            WHERE p2.COMP_CODE = '$getcom_code' AND p2.FY_CODE = '$fisYear' AND p1.TRIPHID = '$tripHId'");

		array_push($lr_ack,$lr_data);

	}

	if($lr_ack){
		$response_array['response']  =  'Search Data';    
		$response_array['data']      =  $lr_ack;                  
		                
		$data   = json_encode($response_array);

	    return $data;

	}else{

		$response_array['response'] =  'Data Not Found';                  
    	$response_array['data']     =  '';                  
		            
		$data   = json_encode($response_array);

	    return $data;

	}


 }


 public function ewaybilldata(Request $request){

	$comp_nameval = $request->session()->get('company_name');
	$getcompcode  = explode('-', $comp_nameval);
	$getcom_code  = $getcompcode[0];
	$comp_name    = $getcompcode[1];
	$fisYear      = $request->session()->get('macc_year');
 	// $getcom_code = 'SA';
  //   $fisYear = '2022-2023';

    $ewaybill_info = DB::select("SELECT H.TRIPHID,B.TRIPHID,H.LR_ACK_STATUS, D.VRDATE AS DO_DATE,D.DORDER_NO AS DO_NUMBER,B.LR_NO,B.LR_DATE,B.VEHICLE_NO,D.CP_CODE,D.CP_NAME,B.ITEM_CODE,B.ITEM_NAME, B.QTY,B.UM,B.ACC_CODE,B.INVC_NO,B.ACC_NAME,B.EBILL_NO, B.EWAYB_VALIDDT FROM TRIP_HEAD H INNER JOIN TRIP_BODY B ON H.TRIPHID = B.TRIPHID INNER JOIN DORDER_BODY D ON B.DO_NO = D.DORDER_NO AND B.SLNO = D.SLNO WHERE  H.LR_STATUS = 1 AND H.LR_ACK_STATUS = 0 AND H.COMP_CODE = '$getcom_code' AND H.FY_CODE = '$fisYear'");

    if($ewaybill_info){

		$response_array['response']  =  'Search Data';    
		$response_array['data']      =  $ewaybill_info;                  
		                
		$data   = json_encode($response_array);

	    return $data;

	}else{

		$response_array['response'] =  'Data Not Found';                  
    	$response_array['data']     =  '';                  
		            
		$data   = json_encode($response_array);

	    return $data;

	}
 }

 public function VehicleDocUpdate(Request $request){


 	$title        = 'Vehical Documentation Updation';
		
	$fisYear      = $request->session()->get('macc_year');
	$comp_nameval = $request->session()->get('company_name');
	$getcompcode  = explode('-', $comp_nameval);
	$comp_code    = $getcompcode[0];
	// $comp_name    = $getcompcode[1];

	$userid       = $request->session()->get('userid');

	// echo $userid;

	$response_array = array();
    
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
        $tenDayData = DB::table('FLEET_CERTF_TRAN')->whereBetween('CERTF_RENEW_DATE',[$fiveday,$extraFiveDay])->get()->sortBy('CERTF_RENEW_DATE');
        
        $fiveDayData = DB::table('FLEET_CERTF_TRAN')->whereBetween('CERTF_RENEW_DATE',[$threeday,$fourday])->get()->sortBy('CERTF_RENEW_DATE');

	    $twoDayData = DB::table('FLEET_CERTF_TRAN')->whereBetween('CERTF_RENEW_DATE',[$current_date,$twoday])->get()->sortBy('CERTF_RENEW_DATE'); 
	    
	    $expireData = DB::table('FLEET_CERTF_TRAN')->where('CERTF_RENEW_DATE','<',$current_date)->get()->sortBy('CERTF_RENEW_DATE');
        	
	   // $countdata = count($data);
		$response_array['response']    =  'Success';    
		$response_array['data']        =  $data;                  
		$response_array['expireData']  =  $expireData;                  
		$response_array['twoDayData']  =  $twoDayData;                  
		$response_array['fiveDayData'] =  $fiveDayData;                  
		$response_array['tenDayData']  =  $tenDayData;                  
		
		$data   = json_encode($response_array);
		
		return $data;
	   
	    
    }else{
    	$response_array['response']  =  'error';    
		$response_array['data']        =  $userid;                  
		$response_array['expireData']  =  '';                  
		$response_array['twoDayData']  =  '';                  
		$response_array['fiveDayData'] =  '';                  
		$response_array['tenDayData']  =  '';               
		
		$data   = json_encode($response_array);
		
		return $data;
	   
    }


 }

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

    $response_array = array();

	// if($userid){

        
		$ch = curl_init('https://etranssolutions.com/eTransRestApi/reports/location');
	
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','username:shreyasho','password:10hstc4Xa3ODTW9f61'));
		
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		
		$result = curl_exec($ch);

		curl_close($ch);

		$e_trans = json_decode($result, true);

		if($e_trans['result']){

			$eTrans = count($e_trans['result']);
			
			$response_array['response'] = 'Success';
			$response_array['data'] = $e_trans;
			
			$data   = json_encode($response_array);
			
			return $data;
	    }else{
	      $eTrans = 0;

	      $response_array['response'] = 'Error';
		  $response_array['data'] = '';

		  $data   = json_encode($response_array);
		
		  return $data;
	    }

		
	// }else{

	// 	$response_array['response'] = 'Error';
	// 	$response_array['data'] = '';

	// 	$data   = json_encode($response_array);
		
	// 	return $data;

	// }

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

    $defaultInp = $request->input('getDefalutType');
	$changeInp  = $request->velType;
	// echo $changeInp;

	$response_array = array();

	if(empty($changeInp) || $changeInp=='AllVel'){

		$arr1 = array(
			"FLAG"            => 0,
		);

		DB::table('VEHICLE_GPS_TRAN')->where('LAST_UPDATE_BY',$userid)->update($arr1);

		$data1 = DB::table('VEHICLE_GPS_TRAN')->where('FLAG',0)->get()->toArray();

		$countdata = count($data1);

		if($data1){
			
			$response_array['response'] = 'suceess';
			$response_array['data'] = $data1;
			$response_array['count'] = $countdata;
			
			$data   = json_encode($response_array);
			
			return $data;

		}else{


			$response_array['response'] = 'error';
			$response_array['data'] = '';
			$response_array['count'] = '';
			
			$data   = json_encode($response_array);
			
			return $data;


		}
	

	}else{

		if($changeInp == 'RunningVel') {

			$arr1 = array(
				"FLAG"  => 0,
			);

			DB::table('VEHICLE_GPS_TRAN')->where('LAST_UPDATE_BY',$userid)->update($arr1);

			$tripData1 = DB::select("SELECT H.VEHICLE_NO,H.TO_PLACE,H.FROM_PLACE, H.ACC_NAME AS ACCNAME,H.ACC_CODE AS ACCCODE,B.DELORDER_NO,B.DELORDER_DATE,B.ITEM_CODE,B.ITEM_NAME,B.REMARK,B.CP_CODE,B.CP_NAME, B.QTY,H.OWNER,H.TRANSPORT_CODE,H.TRANSPORT_NAME FROM TRIP_HEAD H INNER JOIN TRIP_BODY B ON H.TRIPHID = B.TRIPHID AND H.EPOD_STATUS = 0");

			$tripData = json_decode(json_encode($tripData1),true);

			foreach ($tripData as $row) {

				$data1 = DB::table('VEHICLE_GPS_TRAN')->where('VEHICLE_NO',$row['VEHICLE_NO'])->get()->toArray();

				$getData = json_decode(json_encode($data1),true);

				foreach($getData as $key){


					date_default_timezone_set('Asia/Kolkata');

					$updatedDate = date("Y-m-d h:i:s");

					$arr0 = array(
						"VEHICLE_NO"       => $key['VEHICLE_NO'],
						"ENTITY_NAME"      => $key['ENTITY_NAME'],
						"VEHICLE_TIME"     => $key['VEHICLE_TIME'],
						"LATITUDE"         => $key['LATITUDE'],
						"LONGITUDE"        => $key['LONGITUDE'],
						"SPEED"            => $key['SPEED'],
						"DISTANCE"         => $key['DISTANCE'],
						"IGNITION"         => $key['IGNITION'],
						"ANGLE"            => $key['ANGLE'],
						"LOCATION"         => $key['LOCATION'],
						"BATTERY"          => $key['BATTERY'],
						"FLAG"            => 1,
						"LAST_UPDATE_BY"   => $userid,
						"LAST_UPDATE_DATE" => $updatedDate
					);

					$saveData = DB::table('VEHICLE_GPS_TRAN')->where('VEHICLE_NO',$row['VEHICLE_NO'])->update($arr0);


				}

			}

			$dataArr = DB::table('VEHICLE_GPS_TRAN')->where('FLAG',1)->where('LAST_UPDATE_BY',$userid)->get()->toArray();

			$count_running = count($dataArr);

			if($dataArr){

				$response_array['response'] = 'succcess';
				$response_array['data']  = $dataArr;
				$response_array['count'] = $count_running;
				
				$data = json_encode($response_array);
				
				return $data;
			}else{

				$response_array['response'] = 'error';
				$response_array['data']  = '';
				$response_array['count'] = '';
				
				$data = json_encode($response_array);
				
				return $data;
			}

			
		}else if($changeInp == 'IdelVel'){

			$arr1 = array(
						"FLAG"  => 0,
			);

			DB::table('VEHICLE_GPS_TRAN')->where('LAST_UPDATE_BY',$userid)->update($arr1);

			$tripData1 = DB::select("SELECT H.VEHICLE_NO,H.TO_PLACE,H.FROM_PLACE, H.ACC_NAME AS ACCNAME,H.ACC_CODE AS ACCCODE,B.DELORDER_NO,B.DELORDER_DATE,B.ITEM_CODE,B.ITEM_NAME,B.REMARK,B.CP_CODE,B.CP_NAME, B.QTY,H.OWNER,H.TRANSPORT_CODE,H.TRANSPORT_NAME FROM TRIP_HEAD H INNER JOIN TRIP_BODY B ON H.TRIPHID = B.TRIPHID AND H.EPOD_STATUS = 1");

			$tripData = json_decode(json_encode($tripData1),true);

			foreach ($tripData as $row) {

				$data1 = DB::table('VEHICLE_GPS_TRAN')->where('VEHICLE_NO',$row['VEHICLE_NO'])->get()->toArray();

				$getData = json_decode(json_encode($data1),true);

				foreach($getData as $key){


					date_default_timezone_set('Asia/Kolkata');

					$updatedDate = date("Y-m-d h:i:s");

					$arr0 = array(
						"VEHICLE_NO"       => $key['VEHICLE_NO'],
						"ENTITY_NAME"      => $key['ENTITY_NAME'],
						"VEHICLE_TIME"     => $key['VEHICLE_TIME'],
						"LATITUDE"         => $key['LATITUDE'],
						"LONGITUDE"        => $key['LONGITUDE'],
						"SPEED"            => $key['SPEED'],
						"DISTANCE"         => $key['DISTANCE'],
						"IGNITION"         => $key['IGNITION'],
						"ANGLE"            => $key['ANGLE'],
						"LOCATION"         => $key['LOCATION'],
						"BATTERY"          => $key['BATTERY'],
						"FLAG"             => 1,
						"LAST_UPDATE_BY"   => $userid,
						"LAST_UPDATE_DATE" => $updatedDate
					);

					$saveData = DB::table('VEHICLE_GPS_TRAN')->where('VEHICLE_NO',$row['VEHICLE_NO'])->update($arr0);


				}

				
				
			}

			$dataArr = DB::table('VEHICLE_GPS_TRAN')->where('FLAG',1)->where('LAST_UPDATE_BY',$userid)->get()->toArray();

            $count_IdelVel = count($dataArr);

			if($dataArr){

				$response_array['response'] = 'succcess';
				$response_array['data']  = $dataArr;
				$response_array['count'] = $count_IdelVel;
				
				$data = json_encode($response_array);
				
				return $data;

			}else{

				$response_array['response'] = 'error';
				$response_array['data']  = '';
				$response_array['count'] = '';
				
				$data = json_encode($response_array);
				
				return $data;

			}

		}else{

			$response_array['response'] = 'error';
			$response_array['data']  = '';
			$response_array['count'] = '';
			
			$data = json_encode($response_array);
			
			return $data;

		}

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

	$velNo = $request->input('velNo');
	$velId = $request->input('velId');
	$lats  = $request->input('lats');
	$longs = $request->input('longs');

	$trip_data = DB::select("SELECT H.PLANT_CODE,H.PLANT_NAME,H.ACC_CODE,H.ACC_NAME,H.TRIP_NO,H.VRDATE,H.FROM_PLACE,H.TO_PLACE,H.OWNER,H.TRANSPORT_CODE,H.TRANSPORT_NAME,B.DO_NO,B.ITEM_CODE,B.ITEM_NAME,B.REMARK,B.CP_CODE,B.CP_NAME FROM TRIP_BODY B LEFT JOIN TRIP_HEAD H ON B.TRIPHID = H.TRIPHID  WHERE H.VEHICLE_NO = '$velNo' AND H.LR_ACK_STATUS = 0");


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

 }  
 
 public function getReportData(Request $request){

    $compName   = $request->session()->get('company_name');
	$macc_year  = $request->session()->get('macc_year');
	$usertype   = $request->session()->get('usertype');
	$userid     = $request->session()->get('userid');
    $response_array = array();
	
	$getcomcode = explode('-', $compName);
	$compCode   = $getcomcode[0];

	$userdata['item_list']  = DB::table('CFSTOCK_LEDGER')->groupBy('ITEM_CODE')->get();
	$userdata['trip_list']  = DB::table('CFSTOCK_LEDGER')->groupBy('CP_CODE')->get();
	$userdata['rake_list']  = DB::table('CFSTOCK_LEDGER')->groupBy('RAKE_NO')->get();
	$userdata['wagon_list'] = DB::table('CFSTOCK_LEDGER')->groupBy('WAGON_NO')->get();
	
    if($compName){

    	$response_array['response'] = 'success';
        $response_array['data'] = $userdata;
        
        $data = json_encode($response_array);

        print_r($data);

    }else{

    	
		$response_array['response'] = 'error';
        $response_array['data'] = '';
        
        $data = json_encode($response_array);

        print_r($data);

    }


 }


 public function stock_summary(Request $request){

 	if (!empty($request->rack_no || $request->stocksummary || $request->cust_no || $request->item_code )) {

 		$rackno   = $request->input('rack_no');
		// $stocksum = $request->input('stocksummary');
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


	    $data = DB::select("SELECT COMP_CODE,RAKE_NO,WAGON_NO,RAKE_DATE,PLANT_CODE,PLANT_NAME,ORDER_NO,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,BATCH_NO,ITEM_CODE,ITEM_NAME, SQTYRECD, SAQTYRECD, SQTYISSUED, SAQTYISSUED,UM,AUM FROM ( SELECT
			COMP_CODE,RAKE_NO,WAGON_NO,RAKE_DATE,PLANT_CODE,PLANT_NAME,ORDER_NO,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,BATCH_NO,ITEM_CODE,ITEM_NAME,SUM(QTYRECD) AS SQTYRECD,SUM(AQTYRECD) AS SAQTYRECD,SUM(QTYISSUED) AS SQTYISSUED,SUM(AQTYISSUED) AS SAQTYISSUED,UM,AUM FROM `CFSTOCK_LEDGER` WHERE 1=1  $strWhere GROUP BY RAKE_NO,CP_CODE,ITEM_CODE) A WHERE A.SQTYRECD - A.SQTYISSUED != 0 ");

	    if($data){

			$response_array['response'] = 'success';
			$response_array['data'] = $data;
			
			$data = json_encode($response_array);
			
			print_r($data);

	    }else{

			$response_array['response'] = 'error';
	        $response_array['data'] = '';
	        
	        $data = json_encode($response_array);

	        print_r($data);
	    }

 	}else if($request->blankData == 'Blank'){

        $data = array();

        if($data == ''){

			$response_array['response'] = 'success';
			$response_array['data'] = '';
			
			$data = json_encode($response_array);
			
			print_r($data);

	    }
		

	}else{

		$data = DB::select("SELECT COMP_CODE,RAKE_NO,WAGON_NO,RAKE_DATE,PLANT_CODE,PLANT_NAME,ORDER_NO,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,BATCH_NO,ITEM_CODE,ITEM_NAME, SQTYRECD, SAQTYRECD, SQTYISSUED, SAQTYISSUED,UM,AUM FROM ( SELECT
		COMP_CODE,RAKE_NO,WAGON_NO,RAKE_DATE,PLANT_CODE,PLANT_NAME,ORDER_NO,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,BATCH_NO,ITEM_CODE,ITEM_NAME,SUM(QTYRECD) AS SQTYRECD,SUM(AQTYRECD) AS SAQTYRECD,SUM(QTYISSUED) AS SQTYISSUED,SUM(AQTYISSUED) AS SAQTYISSUED,UM,AUM FROM `CFSTOCK_LEDGER`  GROUP BY RAKE_NO,CP_CODE,ITEM_CODE) A WHERE A.SQTYRECD - A.SQTYISSUED != 0 ");

		if($data){

			$response_array['response'] = 'success';
			$response_array['data'] = $data;
			
			$data = json_encode($response_array);
			
			print_r($data);

	    }else{

			$response_array['response'] = 'error';
	        $response_array['data'] = '';
	        
	        $data = json_encode($response_array);

	        print_r($data);
	    }
	}

 }

public function StockLedgerReport(Request $request){

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

    $data = DB::select("SELECT VRDATE,RAKE_NO,LR_NO,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,WAGON_NO,BATCH_NO,ITEM_CODE,ITEM_NAME,REMARK,QTYRECD,AQTYRECD,QTYISSUED,UM,AQTYISSUED,AUM FROM CFSTOCK_LEDGER WHERE 1=1  $strWhere");

    if($data){

		$response_array['response'] = 'success';
		$response_array['data'] = $data;
		
		$data = json_encode($response_array);
		
		print_r($data);

    }else{

		$response_array['response'] = 'error';
        $response_array['data'] = '';
        
        $data = json_encode($response_array);

        print_r($data);
    }

 }else if($request->blankData == 'Blank'){

 	 $data = array();

 	 if($data == ''){

		$response_array['response'] = 'success';
		$response_array['data'] = '';
		
		$data = json_encode($response_array);
		
		print_r($data);

    }

 }else{

 	$data = DB::select("SELECT VRDATE,RAKE_NO,LR_NO,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,WAGON_NO,BATCH_NO,ITEM_CODE,ITEM_NAME,REMARK,QTYRECD,AQTYRECD,QTYISSUED,UM,AQTYISSUED,AUM FROM CFSTOCK_LEDGER ");

 	if($data){

		$response_array['response'] = 'success';
		$response_array['data'] = $data;
		
		$data = json_encode($response_array);
		
		print_r($data);

    }else{

		$response_array['response'] = 'error';
        $response_array['data'] = '';
        
        $data = json_encode($response_array);

        print_r($data);
    }

 }

}

public function RakeDoSummReport(Request $request){

	$compName   = $request->session()->get('company_name');
	$getcomcode = explode('-', $compName);
	$compCode   = $getcomcode[0];

	$MCOMP_CODE = $compCode;
	$strWhere = '';
	$str_Where = '';

	$strWhere .= "AND RAKE_NO !='''' ";
    $str_Where .= "AND RAKE_NO !='' ";

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

	    if($data){

			$response_array['response'] = 'success';
			$response_array['data'] = $data;
			
			$data = json_encode($response_array);
			
			print_r($data);

   		}else{

			$response_array['response'] = 'error';
	        $response_array['data'] = '';
	        
	        $data = json_encode($response_array);

	        print_r($data);
	    }

    }else if($request->blankData == 'Blank'){

	    $data = array();

	    if($data == ''){

			$response_array['response'] = 'success';
			$response_array['data'] = $data;
			
			$data = json_encode($response_array);
			
			print_r($data);

   		}
	    	

	}else{
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

		$data = json_decode(json_encode($data1),true);

		if($data){

			$response_array['response'] = 'success';
			$response_array['data'] = $data;
			
			$data = json_encode($response_array);
			
			print_r($data);

   		}else{

			$response_array['response'] = 'error';
	        $response_array['data'] = '';
	        
	        $data = json_encode($response_array);

	        print_r($data);
	    }
	}
}


public function rakeReport(Request $request){

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
 		
 		$data = DB::select("SELECT * FROM RAKE_TRAN WHERE 1=1  $strWhere");

 		if($data){

			$response_array['response'] = 'success';
			$response_array['data'] = $data;
			
			$data = json_encode($response_array);
			
			print_r($data);

   		}else{

			$response_array['response'] = 'error';
	        $response_array['data'] = '';
	        
	        $data = json_encode($response_array);

	        print_r($data);
	    }

		
	}else{

		$data = array();

		if($data == ''){

			$response_array['response'] = 'success';
			$response_array['data'] = '';
			
			$data = json_encode($response_array);
			
			print_r($data);

   		}
	}
}


public function RakeSummary(Request $request){

	$validation = Validator::make($request->all(),[ 
		'stocksummary' => 'required',
	]);

   $response_array = [];

	if($validation->fails()){
     
	     $response_array['response'] =  $validation->messages();
				
		 $data = json_encode($response_array);

		 return $data;

    }else{

    	if (!empty( $request->stocksummary)) {

	        $stocksum = $request->input('stocksummary');
			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];

			$rackno   = $request->input('rack_no');
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

				$data = DB::select("SELECT A.RAKE_NO, A.RAKE_DATE, A.CP_CODE, A.CP_NAME, COUNT(A.WAGON_NO) AS WAGON_NO, SUM(A.QTY) AS QTY, SUM(A.QTY)/COUNT(A.WAGON_NO) AS AVGQTY FROM (select T.RAKE_NO, T.RAKE_DATE, T.CP_CODE, T.CP_NAME, T.WAGON_NO, SUM(T.QTY) AS QTY from RAKE_TRAN T WHERE 1=1 $strWhere GROUP BY T.RAKE_NO,T.CP_CODE,T.WAGON_NO) A GROUP BY A.RAKE_NO,A.CP_CODE");
	             
	            if($data){

					$response_array['response'] = 'success';
					$response_array['data'] = $data;
					
					$data = json_encode($response_array);
					
					print_r($data);

		   		}else{

					$response_array['response'] = 'error';
			        $response_array['data'] = '';
			        
			        $data = json_encode($response_array);

			        print_r($data);
			    }
	            

			}else if($stocksum == 'SS2'){

				$data = DB::select("SELECT A.RAKE_NO, A.WAGON_NO, COUNT(A.CP_CODE) AS CP_COUNT FROM (select T.RAKE_NO, T.WAGON_NO, T.CP_CODE FROM RAKE_TRAN T WHERE 1=1 $strWhere GROUP BY T.RAKE_NO,T.WAGON_NO,T.CP_CODE) A  GROUP BY A.RAKE_NO,A.WAGON_NO");
	            
	            if($data){

					$response_array['response'] = 'success';
					$response_array['data'] = $data;
					
					$data = json_encode($response_array);
					
					print_r($data);

		   		}else{

					$response_array['response'] = 'error';
			        $response_array['data'] = '';
			        
			        $data = json_encode($response_array);

			        print_r($data);
			    }

			}else{

			}

		}else{

			$data = array();

			if($data == ''){

				$response_array['response'] = 'success';
				$response_array['data'] = '';
				
				$data = json_encode($response_array);
				
				print_r($data);

	   		}

		}

    }

	
}

public function GrnInwardReport(Request $request){

	$validation = Validator::make($request->all(),[ 
		'from_date' => 'required',
		'to_date'   => 'required',
	]);

   $response_array = [];

	if($validation->fails()){
     
	    $response_array['response'] =  $validation->messages();
				
		$data = json_encode($response_array);

		return $data;

    }else{

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
			
			$data = DB::select("SELECT RAKE_NO,VRDATE,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,ORDER_NO,WAGON_NO,BATCH_NO,ITEM_CODE,ITEM_NAME,REMARK,QTYRECD,UM,AQTYRECD,AUM,LOCATION_NAME,LOCATION_CODE FROM CFINWARD_TRAN WHERE 1=1  $strWhere AND VRDATE BETWEEN '$fromDate' AND '$toDate'");

			 if($data){

				$response_array['response'] = 'success';
				$response_array['data'] = $data;
				
				$data = json_encode($response_array);
				
				print_r($data);

	   		}else{

				$response_array['response'] = 'error';
		        $response_array['data'] = '';
		        
		        $data = json_encode($response_array);

		        print_r($data);
		    }

		}

		if($request->blankData == 'Blank'){

	        $data = array();

			if($data == ''){

				$response_array['response'] = 'success';
				$response_array['data'] = '';
				
				$data = json_encode($response_array);
				
				print_r($data);

	   		}

		}else{

			$data = array();

			if($data == ''){

				$response_array['response'] = 'success';
				$response_array['data'] = '';
				
				$data = json_encode($response_array);
				
				print_r($data);

	   		}

		}

    }


}


public function DispatchOutwardReport(Request $request){

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

	    $data = DB::select("SELECT RAKE_NO,VRDATE,CP_CODE,CP_NAME,SP_CODE,SP_NAME,TO_PLACE,ORDER_NO,WAGON_NO,BATCH_NO,ITEM_CODE,ITEM_NAME,REMARK,QTYISSUED,UM,AQTISSUED,AUM,LOCATION_NAME,LOCATION_CODE FROM CFOUTWARD_TRAN WHERE 1=1  $strWhere AND VRDATE BETWEEN '$fromDate' AND '$toDate'");

        if($data){

			$response_array['response'] = 'success';
			$response_array['data'] = $data;
			
			$data = json_encode($response_array);
			
			print_r($data);

   		}else{

			$response_array['response'] = 'error';
	        $response_array['data'] = '';
	        
	        $data = json_encode($response_array);

	        print_r($data);
	    }

	}

	if($request->blankData == 'Blank'){

        $data = array();

		if($data == ''){

			$response_array['response'] = 'success';
			$response_array['data'] = $data;
			
			$data = json_encode($response_array);
			
			print_r($data);

   		}

	}else{

		$data = array();

		if($data == ''){

			$response_array['response'] = 'success';
			$response_array['data'] = $data;
			
			$data = json_encode($response_array);
			
			print_r($data);

   		}

	}

}






}