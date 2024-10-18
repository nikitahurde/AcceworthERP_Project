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

class MyAdminController extends Controller{

	public function __cunstruct(){

	}


  public function index(Request $request){

  	$title = 'ERP Login';

  	$data['comp_name'] = DB::table('MASTER_COMP')->get();

  	return view('admin.login',$data+compact('title'));
  }


  public function ChkLoginDetails(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$user_name  = $request->input('userName');
			$password   = $request->input('password');
			$mdPassword = md5($password);

 			//DB::enableQueryLog();
			$checkLoginData = DB::table('MASTER_USER')->where('USER_CODE',$user_name)->where('PASSWORD',$mdPassword)->get()->first();
			//dd(DB::getQueryLog());

    		if ($checkLoginData) {

    			$response_array['response'] = 'success';
	        
	         echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data_login'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data_login'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

   
  public function GetCompnyLogin(Request $request){

    	$cmp_name = $request->post('comp_name');

    	$response_array = array();
    	 
    	$explode = explode('-', $cmp_name);

    	$getcom_code = $explode[0];

    	$getyear = DB::table('MASTER_FY')->where('COMP_CODE',$getcom_code)->Orderby('FY_CODE', 'desc')->get();
    	
      if ($getyear) {

  			$response_array['response'] = 'success';
  			$response_array['message'] = '';
        $response_array['fy_list'] = $getyear;
          
        $data = json_encode($response_array);

        print_r($data);

			}else{

				$response_array['response'] = 'error';
				$response_array['message'] = 'FY Not Found...!';
	      $response_array['fy_list'] = '' ;

	      $data = json_encode($response_array);

	      print_r($data);
					
			}
			

    }
    

  public function login(Request $request){


    $validate = $this->validate($request, [

			'username'     => 'required',
			'password'     => 'required|min:4',
			'company_name' => 'required',
			'fyCode'       => 'required',

		]);

		$username     = $request->input('username');
		$pass         = md5($request->input('password'));
		$company_name = $request->input('company_name');
		$macc_year    = $request->input('fyCode');

		$loginip   = $request->getClientIp();

		$UserLogin = DB::table('MASTER_USER')->where('USER_CODE', $username)->where('PASSWORD', $pass)->get();

		if ($UserLogin->isEmpty()) {

			return back()->with('error', 'Wrong Login Details');

		}else{

			/* -------- START : GET YEAR FROM LOGIN PAGE ----------- */

			$ExYEar    = explode('-', $macc_year);
		    $yearstart =  $ExYEar[0];
		    $yearend   =  $ExYEar[1];

	    /* -------- END : GET YEAR FROM LOGIN PAGE ----------- */


	    $internet_connection = connection_status();


	    /* ......START : CREATE YEAR FROM SYSTEM DATE....... */

				$year      = date('Y');
				$prevYear  = $year - 1;
				$nextYear  = $year + 1;
				$oldFyYear = $prevYear.'-'.$year;
				$currFyYear = $year.'-'.$nextYear;

		/* ......END : CREATE YEAR FROM SYSTEM DATE....... */

		


	   /* ---------------- START : MAIN SESSION --------------------------*/

	    	$yrbgdate  = '01-04'.'-'.$yearstart;

			$yrenddate = '31-03'.'-'.$yearend;

			$explode   = explode('-', $company_name);

	    	$getcom_code = $explode[0];

			  $datastate = DB::table('MASTER_COMP')->where('COMP_CODE',$getcom_code)->get()->first();

			 // print_r($datastate->EWB_ORGID);exit;

				foreach ($UserLogin as $row) {
					
					$userid   = $row->USER_CODE;
					$acc_code = $row->ACC_CODE;
					$username = $row->USER_NAME;
					$userType = $row->USER_TYPE;
					$email    = $row->EMAIL_ID;
					$usrImg   = $row->IMAGE;

				}

                //print_r($internet_connection);exit();

				/*if ($internet_connection == 0) {

					$tokenId = '';

					$token_Id = '';

					$token_Id2 = '';

					echo '<PRE>';print_r('login');exit();
					
				}else{*/


					$ch = curl_init('https://ulip.logilocker.in/logilocker/v1/auth/login');
					
					$payload = json_encode( array( "userid"=> "9823541095",
					 	    "password"=> "541095" ) );
					curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
					curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
					
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
					
					$result = curl_exec($ch);

					curl_close($ch);

					$data1 = json_decode($result, true);

					 

					if($data1 == '' || $data1 == null){
						$tokenId = '';
					}else{

					    $tokendata = $data1['response'];

					    // echo '<PRE>';print_r($tokendata);
					    // exit;

						if($tokendata){

							$tokenId = $tokendata['token'];
						}else{
							$tokenId = '';
						}
					}

					$ch = curl_init('https://api.easywaybill.in/ezewb/v1/auth/initlogin');
					
					$payload = json_encode( array( "userid"=> "swetalenterprises7@gmail.com",
					 	    "password"=> "Shreyas@123" ) );

					curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );

					curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
					
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
					
					$result = curl_exec($ch);

					curl_close($ch);

					$data_info = json_decode($result, true);

					// 
					$token_Id = '';

					if($data_info == '' || $data_info == null){
						$token_Id = '';
					}else{
						
					    $token_data = $data_info['response'];

					    // print_r($token_data);exit();

						if($token_data){

							$token_Id = $token_data['token'];
							//$token_Id = '';
							
						}else{
							$token_Id = '';
						}
					}

					$org_id = $datastate->EWB_ORGID;

					

					$ch1 = curl_init('https://api.easywaybill.in/ezewb/v1/auth/completelogin');
					
					$payload1 = json_encode( array( "token" => "$token_Id",
					 	    "orgid"=> $org_id ) );

					curl_setopt( $ch1, CURLOPT_POSTFIELDS, $payload1 );

					curl_setopt( $ch1, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
					
					curl_setopt( $ch1, CURLOPT_RETURNTRANSFER, true );
					
					$result1 = curl_exec($ch1);

					//print_r($result1);exit();

					curl_close($ch1);

					$login_data = json_decode($result1, true);

					$token_Id2 = '';

					if($login_data == '' || $login_data == null){

						$token_Id2 = '';

					}else{

						$token_data1 = $login_data['response'];

						if($token_data1){

							$token_Id2 = $token_data1['token'];

						// echo '<PRE>';	print_r($tokenId);exit();
						}else{
							$token_Id2 = '';
						}

					}

				//}
			
				
				// end eway bill comoplete login
				// End eway bill

				# Print response.
				
				$databaseName = \DB::connection()->getDatabaseName();

				$getBaseUrl = url()->current();

    		    $expUrl = explode('/',$getBaseUrl);

    		    $baseUrl = $expUrl[0].'//'.$expUrl[2].'/'.$expUrl[3].'/';

				$session = array(
					'userid'         => $userid,
					'userImg'        => $usrImg,
					'acc_code'       => $acc_code,
					'username'       => $username,
					'usertype'       => $userType,
					'company_name'   => $company_name,
					'macc_year'      => $macc_year,
					'fiscal_year'    => $yearstart,
					'yrbgdate'       => $yrbgdate,
					'yrenddate'      => $yrenddate,
					'state'          => $datastate->STATE_CODE,
					'country'        => $datastate->COUNTRY_CODE,
					'email'          => $email,
					'dbName'         => $databaseName,
					'api_token'      => $tokenId,
					'ewaybill_token' => $token_Id2,
					'internet_status' => $internet_connection,
					'base_url' 		 => $baseUrl,
					'last_login'     => time(),
					'flag'           => 1,
					'login'          => TRUE
			  );

				$request->session()->put($session);

		/* ---------------- END : MAIN SESSION --------------------------*/


		/* ****** START : CHECK USER RIGHTS ******* */

			$masterForm = DB::table('USER_RIGHTFORM')->where('USER_CODE', $userid)->get();

			if($userType!='admin'){
				
				if ($masterForm->isEmpty()) {

					return back()->with('error', 'You dont have any rights for login');

				}else{
					
						return redirect('/dashboard');

					}

			}else{
	
	    
	    /* ______ START : CHECK BACK-YEAR ON LOGIN________ */

	    // echo '<pre>';
	    // print_r($macc_year);
	    // echo '<br>';
	    // print_r($currFyYear);
	    // exit();


		    if($macc_year != $currFyYear){

		    	$title = 'ERP Login';
			
					$FormName = [];
					foreach ($masterForm as $key) {

						$Fid = $key->FORMCODE;

						$FormName[] = DB::table('USERACCESS_FORM')->where('FORM_CODE', $Fid)->get();

					}
				
					$countF = count($FormName);


					for ($i=0; $i < $countF ; $i++) { 
						
						foreach ($FormName[$i] as $row1) {

							$form_name = $row1->form_code;

							$request->session()->push('form_name', $form_name);

						
						}

					}

					if($userType=='CRM' || $userType=='SRM'){

						return redirect('/crmdashboard');
					}else{

						$data['comp_name'] = DB::table('MASTER_COMP')->get();
	        			return view('admin.check_year',$data+compact('title','company_name','macc_year'));

					}


		    }else{

					$FormName = [];
					foreach ($masterForm as $key) {

						$Fid = $key->FORMCODE;

						$FormName[] = DB::table('USERACCESS_FORM')->where('form_code', $Fid)->get();

					}
				
					$countF = count($FormName);


					for ($i=0; $i < $countF ; $i++) { 
						
						foreach ($FormName[$i] as $row1) {

							$form_name = $row1->form_code;

							$request->session()->push('form_name', $form_name);

						
						}
						

					}

					
					if($userType=='CRM' || $userType=='SRM'){

						return redirect('/crmdashboard');
					}else{

						return redirect('/dashboard');

					}

				}

			/* ______ END : CHECK BACK-YEAR ON LOGIN________ */


			}

		/* ****** END : CHECK USER RIGHTS ******* */
	
			
		}		


  }



  public function YearSubmit(Request $request){

    	$validate = $this->validate($request, [

				'company_name' 	=> 'required',
				'macc_year' 		=> 'required',

			]);

			$company_name = $request->input('company_name');
			$macc_year    = $request->input('macc_year');

    	return redirect('/dashboard');
    
  }

    public function Dashboard(Request $request){
    	
    	$title 				=	'C & F Management System';

			$usrID        = $request->session()->get('username');

			$login        = $request->session()->get('login');

			$company_name = $request->session()->get('company_name');
			$getcompcode  = explode('-', $company_name);
			$comp_code    =	$getcompcode[0];

			$macc_year    = $request->session()->get('macc_year');

			$userid       = $request->session()->get('userid');

		
      $chkApp_user = DB::table('USER_APPROVE_IND')->where('USER_CODE',$userid)->get()->first();

      // if($chkApp_user){

	    	$pageData = DB::select("SELECT MASTER_USERTCODE.*,USERACCESS_FORM.form_link FROM `MASTER_USERTCODE`,USERACCESS_FORM WHERE MASTER_USERTCODE.FORM_CODE = USERACCESS_FORM.form_code AND USER_CODE='$userid'");
			//DB::enableQueryLog();
	    	$taskData = DB::select("SELECT TASK_TRAN.*,MASTER_USER.USER_NAME,(SELECT USER_NAME FROM MASTER_USER WHERE USER_CODE=TASK_TRAN.TO_USERCODE)AS TO_USER_NAME FROM TASK_TRAN,MASTER_USER WHERE TASK_TRAN.FROM_USERCODE=MASTER_USER.USER_CODE AND TASK_TRAN.CREATED_BY='$userid' ");

	    	$MytaskData = DB::select("SELECT TASK_TRAN.*,MASTER_USER.USER_NAME FROM TASK_TRAN,MASTER_USER WHERE TASK_TRAN.FROM_USERCODE=MASTER_USER.USER_CODE AND TASK_TRAN.TO_USERCODE='$userid' ");
			//dd(DB::getQueryLog());

				$task_list=DB::table('MASTER_TASK')->get()->toArray();
				
				$user_list=DB::select("SELECT * FROM MASTER_USER WHERE USER_CODE<>'$userid' ");

		    $getapprove =	DB::SELECT("SELECT p1.* FROM PORDER_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0' AND p1.REJECTED_STATUS='0'");

		    if($getapprove){

		     $ordercount = count($getapprove);
			 	}else{
			 	$ordercount=0;
			 	}
	     
	      $getindentapprove =	DB::SELECT("SELECT p1.* FROM PINDENT_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0' AND p1.REJECTED_STATUS='0'");
	     
		    if($getindentapprove){
				 $indentcount = count($getindentapprove);
				}else{
				 $indentcount=0;
				}

	      $getcontarctapprove =	DB::SELECT("SELECT p1.* FROM PCNTR_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0' AND p1.REJECTED_STATUS='0'");

	     if($getcontarctapprove){

		    $contractcount = count($getcontarctapprove);
		   }else{
		 	 $contractcount=0;
		   }

	     $getquatationapprove =	DB::SELECT("SELECT p1.* FROM PQTN_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.flag='0' AND p1.REJECTED_STATUS='0'");

	     if($getquatationapprove){

			     $quotationcount = count($getquatationapprove);
			 }else{
			 	$quotationcount=0;
			 }

       // Approve Task
			 $getEmpTaskApprove =	DB::SELECT("SELECT p1.* FROM EMP_SCOREAPPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0' AND p1.REJECTED_STATUS='0' AND p1.COMP_CODE ='$comp_code' AND p1.FY_CODE ='$macc_year'");

	     if($getEmpTaskApprove){

			 $taskcount = count($getEmpTaskApprove);
			 }else{
			 $taskcount =0;
			 }

			 //Approve Emp Payment Advice

			 $getPaymentAdviceApprove =	DB::SELECT("SELECT p1.* FROM EMPADVICE_TRAN_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0' AND p1.REJECTED_STATUS='0' AND p1.COMP_CODE ='$comp_code' AND p1.FY_CODE ='$macc_year'");

			 if($getPaymentAdviceApprove){

			 $advicecount = count($getPaymentAdviceApprove);
			 }else{
			 $advicecount =0;
			 }

	     	$totalcount = $ordercount + $indentcount + $contractcount + $quotationcount + $taskcount+$advicecount;


        $userID=array();

        if($getapprove){

        	foreach($getapprove as $key) {

        	$userID= $key->APPROVE_USER;
        	# code...
        	}
        }else{
        	$userID='';
        }


	    	if($login == 1 || $login == TRUE  && $company_name!='' && $macc_year!=''){

	    		$usrID 		= $request->session()->get('userid');
	    		$user_data 	= DB::table('MASTER_USER')->where('USER_CODE', $usrID)->get()->first();

	    		$session1 = array(
					'username'  => $user_data->USER_NAME,
					'user_type' => $user_data->USER_TYPE,
					'email_id'  => $user_data->EMAIL_ID,
					'password'  => $user_data->PASSWORD,
					'usercode'  => $user_data->USER_CODE,
			    );

					$request->session()->put($session1);


					date_default_timezone_set('Asia/Kolkata');
          $current_date = date('Y-m-d');

          $tenday =  date('Y-m-d', strtotime('28 days', strtotime($current_date)));

          $fiveday =  date('Y-m-d', strtotime('25 days', strtotime($current_date)));

          $fourday =  date('Y-m-d', strtotime('22 days', strtotime($current_date)));

           $threeday =  date('Y-m-d', strtotime('21 days', strtotime($current_date)));
          
          $extraFiveDay = date('Y-m-d', strtotime('25 days', strtotime($fiveday)));
          
          $twoday  =  date('Y-m-d', strtotime('20 days', strtotime($current_date)));

			    $tenDayData = DB::table('FLEET_CERTF_TRAN')->whereBetween('CERTF_RENEW_DATE',[$fiveday,$extraFiveDay])->where('COMP_CODE',$comp_code)->get();

			    $tenDayC = count($tenDayData);
			    
			    $fiveDayData = DB::table('FLEET_CERTF_TRAN')->whereBetween('CERTF_RENEW_DATE',[$threeday,$fourday])->where('COMP_CODE',$comp_code)->get();

            $fivedayC = count($fiveDayData);
		
					$twoDayData = DB::table('FLEET_CERTF_TRAN')->whereBetween('CERTF_RENEW_DATE',[$current_date,$twoday])->where('COMP_CODE',$comp_code)->get(); 
		    
		    	$twodayC = count($twoDayData);

		    	$expireData = DB::table('FLEET_CERTF_TRAN')->where('CERTF_RENEW_DATE','<',$current_date)->where('COMP_CODE',$comp_code)->get();	

		    	$countPenData = $tenDayC + $fivedayC + $twodayC ;
		    	$countExpData = count($expireData);

		    	$countData = $countPenData + $countExpData;

	         $emptasklist = DB::select("SELECT p2.*,p1.EMP_CODE as ECODE FROM EMP_SCORECARD p1 LEFT JOIN EMP_SCORETASK p2 ON p2.SCORECARDID = p1.SCORECARDID WHERE(p2.SELF_SCORE = '0' AND p1.EMP_CODE = '$userid' AND p1.COMP_CODE ='$comp_code' AND p1.FY_CODE ='$macc_year') ");


	         /* ----- START : e-Trans API------ */

		        $ch = curl_init('https://etranssolutions.com/eTransRestApi/reports/location');
					
						// $payload = json_encode( array( "userid"=> "9975830086",
						//  	    "password"=> "123456" ) );
						
						curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','username:shreyasho','password:10hstc4Xa3ODTW9f61'));
						
						curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
						
						$result = curl_exec($ch);

						curl_close($ch);

						// $e_trans = json_decode($result, true);
						$e_trans ='';
						$eTrans ='';

						// if($e_trans['result']){
						// 	$eTrans = count($e_trans['result']);
						// }else{
						// 	$eTrans = 0;
						// }
					

					/* ----- END : e-Trans API------ */


			     if($emptasklist){
					 	$taskcount = count($emptasklist);
					 }else{
					 	$taskcount =0;
					 }

					 $totalcount = $taskcount;

					 return view('admin.dashboard',compact('title','userid','pageData','taskData','MytaskData','task_list','user_list','countData','tenDayC','fivedayC','twodayC','countExpData','eTrans'));

			    /*if($chkApp_user){

			    	return view('admin.dashboard',compact('title','totalcount','userid','pageData','taskData','MytaskData','task_list','user_list'));

			    }else{

						 	return view('admin.dashboard',compact('title','totalcount','userid','pageData','taskData','MytaskData','task_list','user_list','countData','tenDayC','fivedayC','twodayC','countExpData'));
			    	
			    }*/

	    		
    	
    	}else{

    		Auth::logout();
				$request->session()->flush();
				$request->session()->regenerate();
				return redirect('/');

    	}
   
    	
    }

    function CrmDashboard(Request $request){

       $title='C & F Management System';

    	$usrID 			= $request->session()->get('username');

    	$login 			= $request->session()->get('login');

    	$userid 		= $request->session()->get('userid');

    	$pageData = DB::select("SELECT MASTER_USERTCODE.*,USERACCESS_FORM.form_link FROM `MASTER_USERTCODE`,USERACCESS_FORM WHERE MASTER_USERTCODE.FORM_CODE = USERACCESS_FORM.form_code AND USER_CODE='$userid'");
		//DB::enableQueryLog();
    	$taskData = DB::select("SELECT TASK_TRAN.*,MASTER_USER.USER_NAME,(SELECT USER_NAME FROM MASTER_USER WHERE USER_CODE=TASK_TRAN.TO_USERCODE)AS TO_USER_NAME FROM TASK_TRAN,MASTER_USER WHERE TASK_TRAN.FROM_USERCODE=MASTER_USER.USER_CODE AND TASK_TRAN.CREATED_BY='$userid' ");
    	$MytaskData = DB::select("SELECT TASK_TRAN.*,MASTER_USER.USER_NAME FROM TASK_TRAN,MASTER_USER WHERE TASK_TRAN.FROM_USERCODE=MASTER_USER.USER_CODE AND TASK_TRAN.TO_USERCODE='$userid' ");
		//dd(DB::getQueryLog());

		$task_list=DB::table('MASTER_TASK')->get();
		$user_list=DB::select("SELECT * FROM MASTER_USER WHERE USER_CODE<>'$userid' ");

	     $getapprove =	DB::SELECT("SELECT p1.* FROM PORDER_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0' AND p1.REJECTED_STATUS='0'");

	    if($getapprove){

	     $ordercount = count($getapprove);
	 	}else{
	 	$ordercount=0;
	 	}


     	$getindentapprove =	DB::SELECT("SELECT p1.* FROM PINDENT_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0' AND p1.REJECTED_STATUS='0'");
     
	    if($getindentapprove){
		 $indentcount = count($getindentapprove);
		}else{
		 $indentcount=0;
		}

     	$getcontarctapprove =	DB::SELECT("SELECT p1.* FROM PCNTR_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0' AND p1.REJECTED_STATUS='0'");



		    if($getcontarctapprove){

		    $contractcount = count($getcontarctapprove);
		    }else{
		 	$contractcount=0;
		    }

		     $getquatationapprove =	DB::SELECT("SELECT p1.* FROM PQTN_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.flag='0' AND p1.REJECTED_STATUS='0'");

		     //print_r($userid);exit;
		     if($getquatationapprove){

		     $quotationcount = count($getquatationapprove);
		 }else{
		 	$quotationcount=0;
		 }

			     $totalcount = $ordercount + $indentcount + $contractcount + $quotationcount;

    	return view('admin.crm_dashboard',compact('title','totalcount','userid','pageData','taskData','MytaskData','task_list','user_list'));

    }

    

    public function Logout(Request $request) {

    	$userid = $request->session()->get('userid');

    	$updatedata=array(

				'login_ip'=>'',
			);

	   $updateData = DB::table('MASTER_USER')->where('USER_CODE', $userid)->update($updatedata);



		Auth::logout();
		$request->session()->flush();
		$request->session()->regenerate();
		return redirect('/');
	}

	public function UserInactivity(Request $request) {
		
		//print_r($userinactivity);exit;
    	/*$userid = $request->session()->get('userid');

    	$updatedata=array(

				'flag'=>'0',
			);

	   $updateData = DB::table('master_user')->where('id', $userid)->update($updatedata);*/

	   $userid = $request->session()->get('userid');


        $inactivity=base64_encode('userinactivity');
        //print_r($inactivity);exit;
		Auth::logout();
		$request->session()->flush();
		$request->session()->regenerate();
		return redirect('/userinactivity'.'/'.$inactivity);
	}

public function ResetPass(Request $request) {
		
        $inactivity=base64_encode('userinactivity');
        //print_r($inactivity);exit;
		Auth::logout();
		$request->session()->flush();
		$request->session()->regenerate();
		return redirect('/userlogout'.'/'.$inactivity);
	}
/*dashboard link pages*/	

    public function actualStock(Request $request){

    	$sql_depopt= "SELECT receipt_view_1.Depot,receipt_view_1.item 
	FROM `receipt_view_1` 
	left join dispatch_view_2 on dispatch_view_2.month_recept=receipt_view_1.month_std_month 
	group by receipt_view_1.Depot,receipt_view_1.item
	order by month_std_month,receipt_view_1.Depot,receipt_view_1.item ";

	$sql_depopt = DB::select($sql_depopt);

	$data['depot_list']=$sql_depopt;

$actualStoc=[];
$depot_name='';
	foreach ($sql_depopt as $key) {

		$depot_code = $key->Depot;
		$item_code = $key->item;

		$depot	= DB::table('master_depot')->where('depot_code', $depot_code)->get()->first();

	if(isset($depot)){

	     $depot_name = $depot->depot_name;
		}
		else{
			$depot_name='';
		}
		
	
    	$sql = "(SELECT month_std_month,reciept_qty_mt,month_recept,dispatch_qty_mt,(reciept_qty_mt-dispatch_qty_mt) as closing1 , receipt_view_1.Depot,receipt_view_1.item FROM `receipt_view_1` LEFT JOIN dispatch_view_2 on ( dispatch_view_2.month_recept=receipt_view_1.month_std_month  and dispatch_view_2.depot=receipt_view_1.depot AND dispatch_view_2.item=receipt_view_1.item) where (
		receipt_view_1.depot='$depot_code'  AND receipt_view_1.item='$item_code' ) group by month_std_month ,receipt_view_1.item )
		UNION ALL
		(
		SELECT dispatch_view_2.month_recept, reciept_qty_mt, month_recept, dispatch_qty_mt, (reciept_qty_mt-dispatch_qty_mt) as closing1 , dispatch_view_2.Depot, dispatch_view_2.item FROM dispatch_view_2 LEFT join `receipt_view_1` on (dispatch_view_2.month_recept=receipt_view_1.month_std_month and dispatch_view_2.depot=receipt_view_1.depot AND dispatch_view_2.item=receipt_view_1.item) where dispatch_view_2.depot='$depot_code' AND dispatch_view_2.item='$item_code' AND month_std_month is NULL group by month_recept ,dispatch_view_2.item
		)";

		$actualStock[] = DB::select($sql);


	}
		if(!empty($actualStock)){
			 $data['actual_stock'] = $actualStock;
			}else{
			 $data['actual_stock'] ='';
		}
	
     
      

    	return view('admin.actual_stock',$data+compact('depot_name'));
    }


/*dashboard link pages*/


	public function sapStock(Request $request){

		$sql_depopt= "SELECT receipt_view_1.Depot,receipt_view_1.item 
	FROM `receipt_view_1` 
	left join dispatch_view_2 on dispatch_view_2.month_recept=receipt_view_1.month_std_month 
	group by receipt_view_1.Depot,receipt_view_1.item
	order by month_std_month,receipt_view_1.Depot,receipt_view_1.item ";

	$sql_depopt = DB::select($sql_depopt);

	$data['depot_list']=$sql_depopt;

	//print_r($data['depot_list']);exit;

	$actualStoc=[];
	$depot_name='';
	foreach ($sql_depopt as $key) {


		$depot_code = $key->Depot;
		$item_code = $key->item;

		$depot	= DB::table('master_depot')->where('depot_code', $depot_code)->get()->first();
		//print_r($depot);exit;
		if(isset($depot)){
	     $depot_name = $depot->depot_name;
		}else{
			$depot_name='';
		}
		
	
    	$sql = "(
		SELECT month_std_month ,reciept_qty_mt,sap_month,sap_qty_mt,(reciept_qty_mt-sap_qty_mt) as closing1  , receipt_view_1.Depot,receipt_view_1.item
		 FROM `receipt_view_1` 
		left join sap_view_1 on (sap_view_1.sap_month=receipt_view_1.month_std_month and sap_view_1.depot=receipt_view_1.depot AND sap_view_1.item=receipt_view_1.item ) 
		where receipt_view_1.depot='$depot_code'  AND receipt_view_1.item='$item_code'
		group by  month_std_month,receipt_view_1.item  )
		UNION ALL
		(		  
		SELECT sap_view_1.sap_month , reciept_qty_mt, sap_month, sap_qty_mt, (reciept_qty_mt-sap_qty_mt) as closing1 , sap_view_1.Depot, sap_view_1.item 
		FROM sap_view_1		
		LEFT join `receipt_view_1` on (sap_view_1.sap_month=receipt_view_1.month_std_month and sap_view_1.Depot=receipt_view_1.depot AND sap_view_1.item=receipt_view_1.item) 		
		where sap_view_1.Depot='$depot_code' AND sap_view_1.item='$item_code' AND month_std_month is NULL group by sap_month ,sap_view_1.item
		)";

		$actualStock[] = DB::select($sql);

	}
		if(!empty($actualStock)){
	
      		$data['actual_stock'] = $actualStock;

  		}else{
  			$$data['actual_stock'] ='';
  		}
 
    	return view('admin.sap_stock',$data+compact('depot_name'));
    }

    public function SendMailPassword(){

	return view('admin.sendmailpassword');

}

public function sendMail(Request $request){

	$validate = $this->validate($request, [

						'user_id'       => 'required',
						'email_id'      => 'required',
					]);

	            $developmentMode = true;
        		$mailer = new PHPMailer($developmentMode);

    	    	$UserId =  $request->input('user_id');

				$accEmailId = $request->input('email_id');

			$getdata = DB::table('MASTER_USER')->where(['USER_CODE' => $UserId, 'EMAIL_ID' => $accEmailId])->get();

			if($getdata->isEmpty()){
				$request->session()->flash('alert-error', 'Please Enter Valid UserName And Email Id...!');
				return redirect('/sendotpmail');

			}else{


				$mailer->SMTPDebug = 1;
                $mailer->isSMTP();

                if ($developmentMode) {
                    $mailer->SMTPOptions = [
                        'ssl'=> [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        ]
                    ];
                }


                $mailer->Host = 'smtp.rediffmailpro.com';
                $mailer->SMTPAuth = true;
                $mailer->Username = 'sangit.kachahe@aceworth.in';
                $mailer->Password = 'sangit@13';
                $mailer->CharSet = 'iso-8859-1'; 
                $mailer->Port = 587;
                $mailer->WordWrap = TRUE;

           //     print_r($accEmailId);exit;

                $mailer->setFrom('sangit.kachahe@aceworth.in', 'Aceworth Private Limitate');
                $mailer->addAddress($accEmailId, 'Aceworth Private Limitate');
                $mailer->addReplyTo('sangit.kachahe@aceworth.in', 'Aceworth Private Limitate');

                $mailer->isHTML(true);
                $mailer->Subject = 'Change Password';

                $code = rand(5, 99999);

                $message = '<div>
                            <p style="font-size: 130%;font-weight: 800;color: #696868;">Aceworth Account</p>
                            <p style="font-size: 190%;font-weight: 800;color: #696868;">Security Code</p>
                            <p style="font-size: 110%;font-weight: 400;color: #696868;">Please Use This OTP to Change Your Password.</p>
                            <p style="font-size: 150%;font-weight: 600;color: #696868;">Here is Your OTP: ';
                $message .= $code;
                $message .= '</p>
                                <p><strong>Thanks,</strong></p>
                                <p><strong>The Aceworth Account Team</strong></p>
                            </div>';

                       //print_r($message);exit;


                $mailer->Body = $message;

                

                $updatedDate = date("Y-m-d");

             $data = array(
					"OTP"            =>  $code,
					"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
					"LAST_UPDATE_DATE" =>  $updatedDate
				
	    	);

		      $saveData = DB::table('MASTER_USER')->where('EMAIL_ID', $accEmailId)->update($data);

		      $mailSend = $mailer->send();
                //print_r($mailSend);exit;
                $mailer->ClearAllRecipients();

                if($mailSend){

					
				return redirect('/change_password');

				}else{

					
				return redirect('/change_password');
				}
			}
}

public function ChangePassword(Request $request){

	return view('admin.change_password');
}

public function ResetPassword(Request $request){

	$validate = $this->validate($request, [

						'newpassword'       => 'required',
						'cpassword'      => 'required',
						'otp'      => 'required',
					]);

	$newpassword= $request->input('newpassword');
	$cpassword= $request->input('cpassword');

	//print_r($newpassword);exit;
	$otp= $request->input('otp');
//print_r($otp);
	$email = $request->session()->get('email');
	//print_r($email);exit;

	if($newpassword==$cpassword){

		$getdata = DB::table('MASTER_USER')->where(['OTP' => $otp, 'EMAIL_ID' => $email])->get();
		//print_r($getdata);exit;

	if($getdata->isEmpty()){

		$request->session()->flash('alert-error', 'Please Enter Valid Otp...!');
				return redirect('/change_password');
	}else{

		$updatedDate = date("Y-m-d");

		$data = array(
					"PASSWORD"            =>  md5($newpassword),
					//"CONFIRM_PASSWORD"    =>  $cpassword,
					"LAST_UPDATE_BY"      =>  $request->session()->get('userid'),
					"LAST_UPDATE_DATE"   =>  $updatedDate
				
	    	);

       $saveData = DB::table('MASTER_USER')->where('EMAIL_ID', $email)->update($data);

       if($saveData){
       	return redirect('/resetactivity');
       }else{
       	return redirect('/change_password');
       }

	}

	}else{
		$request->session()->flash('alert-error', 'Password and confirm password does not match...!');
				return redirect('/change_password');

	}

	//print_r($email);exit;
}




}
