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
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeSalaryReportExport;
use Illuminate\Support\Facades\Schema;


class HrmTransactionController extends Controller{

  public function __construct(Request $request){

		//$this->data = "smit@121";

	}

	public function EmpAttendance(Request $request){

    $title = 'Employee Attendance Master';

    $compName   = $request->session()->get('company_name');
    
    $fisYear  =  $request->session()->get('macc_year');

    $getcomcode    = explode('-', $compName);
		
		$comp_code = $getcomcode[0];

    $compName = $request->session()->get('company_name');
        
    $id             = $request->old('idAttendence');
    
    $attend_year    = $request->old('attend_year');
		
		$empcode        = $request->old('empcode');
		
		$empname        = $request->old('empname');
		
		$mm_days        = $request->old('mm_days');
		
		$working_days   = $request->old('working_days');
		
		$present_days   = $request->old('present_days');
		
		$leave          = $request->old('leave');
		
		$absent_days    = $request->old('absent_days');
		
		$holidays       = $request->old('holidays');

		$data['emp_list']    = DB::table('MASTER_EMP')->where('COMP_CODE', $comp_code)->get();
		
		
		$button='Save';
    
    $action='/Transaction/Attendance/emp-attendance-save';
		
		if(isset($compName)){

    	return view('admin.finance.transaction.hrm.emp_attendance',$data+compact('title','button','id','attend_year', 'empcode','empname','mm_days','working_days','present_days','leave','absent_days','holidays','action'));

    }else{

		  return redirect('/useractivity');
	  }

  }


  public function SaveEmpAttendance(Request $request){
        
    $validate = $this->validate($request, [

			'attend_year'    => 'required',
			'empcode' 		=> 'required',
			'empname' 		=> 'required',
			'mm_days' 		=> 'required',
			'working_days'  => 'required',
			'present_days'  => 'required',
			'leave'         => 'required',
			'absent_days'   => 'required',
			'holidays'      => 'required',
		]);


    $createdBy 	= $request->session()->get('userid');

    $compName   = $request->session()->get('company_name');
    
    $fisYear  =  $request->session()->get('macc_year');

    $getcomcode    = explode('-', $compName);
		
		$comp_code = $getcomcode[0];
		
		$comp_name = $getcomcode[1];

		$emp_code = $request->input('empcode');
		
		$attend_year = $request->input('attend_year');

		$checkAttData = DB::table('EMP_ATTENDANCE')->where('EMP_CODE', $emp_code)->where('YR_MONTH',$attend_year)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get();

		$countChckData = count($checkAttData);
		
		if($countChckData == 0){
        
      $AttendanceData = DB::table('EMP_ATTENDANCE')->orderBy('ID', 'DESC')->first();

	    if(!empty($AttendanceData)){

	    	$getID= $AttendanceData->ID;

	    	$id=$getID+1;

	    }else{
	    		$id=1;
	    }

	    try{

	      $data = array(

        "FY_CODE"          => $fisYear,
        "COMP_CODE"        => $comp_code,
        "COMP_NAME"        => $comp_name,
        "ID"               => $id,
				"YR_MONTH"       	 => $request->input('attend_year'),
				"EMP_CODE"   		   => $request->input('empcode'),
				"EMP_NAME"   		   => $request->input('empname'),
				"MONTH_DAYS" 		   => $request->input('mm_days'),
				"WORKING_DAYS"   	 => $request->input('working_days'),
				"PRESENT_DAYS"   	 => $request->input('present_days'),
				"LEAVE"   		     => $request->input('leave'),
				"ABSENT_DAYS"  		 => $request->input('absent_days'),
				"HOLIDAY"    		   => $request->input('holidays'),
				"ATTENDANCE_BLOCK" => '0',
				"FLAG"        		 => '0',
				"CREATED_BY"  		 => $createdBy,
				"UPDATED_BY"  		 => $createdBy
				
			);

			$saveData = DB::table('EMP_ATTENDANCE')->insert($data);

			  DB::commit();

			  $request->session()->flash('alert-success', 'Employee Attendance Was Successfully Added...!');

				return redirect('/Transaction/Attendance/view-emp-attendance-transaction');

			}catch (Exception $e) {

		    DB::rollBack();
		    
		    $request->session()->flash('alert-error', 'Employee Attendance Can Not Added...!');
				
				return redirect('/Transaction/Attendance/view-emp-attendance-transaction');
		  }

	  }else{

			$request->session()->flash('alert-error', 'Already Saved This Month Year Employee Attendance ...!');
			
			return redirect('Transaction/Attendance/add-emp-attendance-trans');
		}

  }

  public function ViewEmpAttendance(Request $request){

	  $compName   = $request->session()->get('company_name');
	  $fisYear  =  $request->session()->get('macc_year');

	  $getcomcode    = explode('-', $compName);
		$comp_code = $getcomcode[0];

	  if($request->ajax()){
			
			$title    = 'View Employee Attendance Master';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

	    if($userType=='admin'){

	    	$data = DB::table('EMP_ATTENDANCE')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('ID','DESC');

	    }else if($userType=='superAdmin' || $userType=='user') {    		

	    		$data = DB::table('EMP_ATTENDANCE')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('ID','DESC');

	    }
	    else{
	    		$data ='';
	    }
			
			return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }

		if(isset($compName)){

	    	return view('admin.finance.transaction.hrm.view_emp_attendance');

		}else{
		
		 return redirect('/useractivity');

	  }

  }

  public function DeleteAttendance(Request $request){

	$attendance = $request->input('attendance');
	$compName   = $request->session()->get('company_name');
  $fisYear  =  $request->session()->get('macc_year');

  $getcomcode    = explode('-', $compName);
	$comp_code = $getcomcode[0];
    	

  if ($attendance!=''){

    try{

    	$Delete = DB::table('EMP_ATTENDANCE')->where('ID', $attendance)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->delete();

		  if($Delete){

				$request->session()->flash('alert-success', 'Employee 
				Attendance Was Deleted Successfully...!');

				return redirect('/Transaction/Attendance/view-emp-attendance-transaction');

			}else{

				$request->session()->flash('alert-error', 'Employee Attendance Can Not Deleted...!');
				return redirect('/Transaction/Attendance/view-emp-attendance-transaction');

			}
		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Employee Attendance Can not be Deleted...! Used In Another Transaction...!');
			return redirect('/Transaction/Attendance/view-emp-attendance-transaction');
		}

    }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
			return redirect('/Transaction/Attendance/view-emp-attendance-transaction');

    }

	}

	public function EditEmpAttendance(Request $request,$attendance){

  	$title = 'Edit Emp Attendance Master';

  	$attendance = base64_decode($attendance);

  	$compName   = $request->session()->get('company_name');
    
    $fisYear  =  $request->session()->get('macc_year');

    $getcomcode    = explode('-', $compName);
	  
	  $comp_code = $getcomcode[0];

    	
    $data['emp_list']    = DB::table('MASTER_EMP')->where('COMP_CODE', $comp_code)->get();

		  if($attendance!=''){

  	    $query = DB::table('EMP_ATTENDANCE');
				$query->where('ID', $attendance);
				$query->where('COMP_CODE', $comp_code);
				$query->where('FY_CODE', $fisYear);
				$classData= $query->get()->first();

                  $id               = $classData->ID;
				$attend_year      = $classData->YR_MONTH;
				$empcode          = $classData->EMP_CODE;
				$empname          = $classData->EMP_NAME;
				$mm_days          = $classData->MONTH_DAYS;
				$working_days     = $classData->WORKING_DAYS;
				$present_days     = $classData->PRESENT_DAYS;
				$leave            = $classData->LEAVE;
				$absent_days      = $classData->ABSENT_DAYS;
				$holidays          = $classData->HOLIDAY;
				$attendance_block = $classData->ATTENDANCE_BLOCK;
				$button           ='Update';
				$action           ='/Transaction/Attendance/form-emp-attendance-update';
        
        return view('admin.finance.transaction.hrm.emp_attendance',$data+compact('title','id','attend_year','empcode','empname','mm_days','working_days','present_days'
				,'leave','absent_days','holidays','attendance_block','button','action'));

		  }else{

			$request->session()->flash('alert-error', 'Employee Attendance Not Found...!');

			return redirect('/Transaction/Attendance/view-emp-attendance-transaction');
		}

  }

  public function EmpAttendanceUpdate(Request $request){

		$validate = $this->validate($request, [

			'attend_year'   => 'required',
			'empcode' 		=> 'required',
			'mm_days' 		=> 'required',
			'working_days'  => 'required',
			'present_days'  => 'required',
			'leave'         => 'required',
			'absent_days'   => 'required',
			'holidays'      => 'required',

		]);

		$idattend = $request->input('idAttend');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");
		
		$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

		$createdBy 	= $request->session()->get('userid');

    $fisYear  =  $request->session()->get('macc_year');

    $getcomcode    = explode('-', $compName);

		$comp_code = $getcomcode[0];

		try{

			$data = array(
			
			"FY_CODE"       	=> $fisYear,
			"COMP_CODE"       	=> $comp_code,
			"YR_MONTH"       	=> $request->input('attend_year'),
			"EMP_CODE"   		  => $request->input('empcode'),
			"EMP_NAME"   		  => $request->input('empname'),
			"MONTH_DAYS" 		  => $request->input('mm_days'),
			"WORKING_DAYS"   	=> $request->input('working_days'),
			"PRESENT_DAYS"   	=> $request->input('present_days'),
			"LEAVE"   		    => $request->input('leave'),
			"ABSENT_DAYS"  		=> $request->input('absent_days'),
			"HOLIDAY"    		  => $request->input('holidays'),
			"ATTENDANCE_BLOCK"=> $request->input('attendance_block'),
			"FLAG"        		=> '0',
			"CREATED_BY"  		=> $createdBy,
			"UPDATED_BY"  		=> $createdBy
			
		);

		DB::commit();

		$saveData = DB::table('EMP_ATTENDANCE')->where('ID', $idattend)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($data);

			if($saveData) {

				$request->session()->flash('alert-success', 'Employee Attendance Was Successfully Updated...!');

				return redirect('/Transaction/Attendance/view-emp-attendance-transaction');

			}else{

				$request->session()->flash('alert-error', 'Employee Attendance Can Not Added...!');

				return redirect('/Transaction/Attendance/view-emp-attendance-transaction');

			}
			
    }catch (Exception $e) {

		    DB::rollBack();

		     $request->session()->flash('alert-error', 'Employee Attendance Can not be Updated...! Used In Another Transaction...!');

		    return redirect('/Transaction/Attendance/view-emp-attendance-transaction');
		    
		}

		
}

public function CheckEmpAttend(Request $request){

	$month_attend=$request->attend_monthYr;

	$emp_code = $request->emp_code;
    
  $response_array = array();

  if($request->ajax()){

  	$fetchreocrd = DB::table(' EMP_ATTENDANCE')->where('YR_MONTH', $month_attend)->where('EMP_CODE', $emp_code)->get()->first();

			if ($fetchreocrd) {

		    $response_array['response'] = 'success';
		    $response_array['data'] = $fetchreocrd;
		   
		      
		    $data = json_encode($response_array);

		    print_r($data);

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
	}
}

public function CheckLeaveApplication(Request $request){

	$compName   = $request->session()->get('company_name');
  	
  $fisYear  =  $request->session()->get('macc_year');

  $getcomcode    = explode('-', $compName);
  
  $comp_code = $getcomcode[0];

	$emp_code = $request->emp_code;
	
	$month = $request->attend_monthYr;
	
	$leaveApplication = DB::table('LEAVE_APPLICATION')->where('COMP_CODE',$comp_code)->where('EMP_CODE',$emp_code)->where('FY_YEAR',$fisYear)->get();

	$leaveCount = count($leaveApplication);

	$leaveArr = array();

	for($i=0;$i<$leaveCount;$i++){
		
		array_push($leaveArr,$leaveApplication[$i]->FROMTODATE);
	}

  $leaveArrCount = count($leaveArr);
  
  $datesArr = [];
  
  $explodeDt;
  
  for($j=0;$j<$leaveArrCount;$j++){
   
    $explodeDt = explode(',',$leaveArr[$j]);
    $explodeDtCount = count($explodeDt);
    for($k=0;$k<$explodeDtCount;$k++){
    	array_push($datesArr,$explodeDt[$k]);
    }


  }

	$monthDtCount = count($datesArr);
	
	$totalLeave = 0;
	
	for($l=0;$l<$monthDtCount;$l++){
		
		$explodeDt1 = explode('-',$datesArr[$l]);
		$m = date("F", mktime(null, null, null, $explodeDt1[1], 1));
        $dt = $m.' '.$explodeDt1[0];
		
		if($month == $dt){
			$totalLeave = $totalLeave + 1;
		}
	}

	if($request->ajax()){

		if ($totalLeave) {

			$response_array['response'] = 'success';
		  
		  $response_array['data'] = $totalLeave;
		         
		  $data = json_encode($response_array);

			print_r($data);

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
	}

}

public function CheckPayCalender(Request $request){

  $month_attend=$request->attend_monthYr;

  $compName   = $request->session()->get('company_name');
  
  $fisYear  =  $request->session()->get('macc_year');

  $getcomcode    = explode('-', $compName);
	
	$comp_code = $getcomcode[0];
        
  $response_array = array();
    
  if($request->ajax()){

	  $fetchreocrd = DB::table('PAY_CALENDER')->where('MONTH_YR', $month_attend)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->first();

	  if($fetchreocrd){

    	$response_array['response'] = 'success';

	    $response_array['data'] = $fetchreocrd;
	           
                
	    $data = json_encode($response_array);

	    print_r($data);

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
	}

}


public function PayCalender(Request $request){
      
  $title = 'Add Pay Calender';

  $data['plantData'] =  DB::table('MASTER_PLANT')->get();

  $data['rate_list'] = DB::table('MASTER_RATE_VALUE')->get();

  $compName 	= $request->session()->get('company_name');

  // $data['comp_list'] = DB::table('MASTER_COMP')->get();

  $data['profit_list'] = DB::table('MASTER_PFCT')->get();

  return view('admin.finance.transaction.hrm.add_pay_calender',$data+compact('title','compName'));

}

public function SavePayCalander(Request $request){

	$createdBy  = $request->session()->get('userid');
	
	$compName   = $request->session()->get('company_name');
	
	$fisYear    =  $request->session()->get('macc_year');
	
	$getcomcode = explode('-', $compName);
	
	$comp_code  = $getcomcode[0];
	$comp_name  = $getcomcode[1];

	$validate = $this->validate($request, [
         
	   'month_yr'  => 'required',
	   'comp_code' => 'required'

	]);

	$month = $request->input('month_yr');
	        
	$checkData = DB::table('PAY_CALENDER')->where('MONTH_YR',$month)->where('FY_CODE',$fisYear)->where('COMP_CODE',$comp_code)->get();
    
    $countChkData = count($checkData);

	if($countChkData == 0){
       
	    $hdatee = $request->input('holidayDate');

		$dateArr = explode(",",$hdatee);
			
		$timestamp = array();
      	
	    foreach($dateArr as $row){

			$dateArr1 = explode("00:00:00",$row);

	        date_default_timezone_set('Asia/Kolkata');

			$timestamp[] = date('Y-m-d', strtotime($dateArr1[0]));

		 }

		$days = implode(",",$timestamp);

		$pay_calData = DB::table('PAY_CALENDER')->orderBy('ID', 'DESC')->first();

		if(!empty($pay_calData)){

	  	    $getID= $pay_calData->ID;

	  		$id=$getID+1;

	    }else{

	    		$id=1;
	    }

		$data = array(

			"ID"           =>  $id,
			"MONTH_YR"     =>  $request->input('month_yr'),
			"FY_CODE"      =>  $fisYear,
			"COMP_CODE"    =>  $comp_code,
			"COMP_NAME"    =>  $comp_name,
			"PLANT_CODE"   =>  $request->input('plant_code'),
			"PLANT_NAME"   =>  $request->input('plant_name'),
			"PFCT_CODE"    =>  $request->input('Profit_center_code'),
			"PFCT_NAME"    =>  $request->input('profitcenter_name'),
			"MONTH_DAYS"   =>  $request->input('month_days'),
			"HOLIDAYS"     =>  $request->input('holidays'),
			"HOLIDAY_DATE" =>  $days, 
			"WORK_DAYS"    =>  $request->input('work_days'),
			"FLAG"         =>  '0',
			"CREATED_BY"   =>  $createdBy,
			"UPDATED_BY"   =>  $createdBy,
        
        );

        $saveData = DB::table('PAY_CALENDER')->insert($data);

		if($saveData){

			$request->session()->flash('alert-success', 'Pay Calendar Successfully Save...!');
			
			return redirect('/Master/Setting/view-pay-calender');

		}else{

			$request->session()->flash('alert-error', 'Pay Calendar Can Not Save...!');
			
			return redirect('/Master/Setting/view-pay-calender');

		}

	}else{

		$request->session()->flash('alert-error', 'Already Save this month calendar...!');
		
		return redirect('/Master/Setting/view-pay-calender');
	}

}

public function ViewPayCalender(Request $request){

	$compName   = $request->session()->get('company_name');
	
	$fisYear    =  $request->session()->get('macc_year');
	
	$getcomcode = explode('-', $compName);
	
	$comp_code  = $getcomcode[0];

	if($request->ajax()) {

	    $title ='View Pay Calender';

		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

		if($userType=='admin' || $userType=='Admin'){

		        
	     $data = DB::table('PAY_CALENDER')->where('COMP_CODE',$comp_code)->where('FY_CODE', $fisYear)->orderBy('ID','DESC');
	    
	    }else if($userType=='superAdmin' || $userType=='user'){

		     $data = DB::table('PAY_CALENDER')->where('COMP_CODE',$comp_code)->where('FY_CODE', $fisYear)->orderBy('ID','DESC');

		}else{

		    $data='';
		            
		}

		return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){})->toJson();

	}

	if(isset($compName)){

	  return view('admin.finance.transaction.hrm.view_pay_calender');

	}else{

			return redirect('/useractivity');

	}
        
}


public function EditPayCalender(Request $request,$month_yr){

	$compName            = $request->session()->get('company_name');
	
	$fisYear             =  $request->session()->get('macc_year');
	
	$getcomcode          = explode('-', $compName);
	
	$comp_code           = $getcomcode[0];
	$comp_name           = $getcomcode[1];
	
	$year_month          = base64_decode($month_yr);
	
	$data['plantData']   =  DB::table('MASTER_PLANT')->get();
	
	$data['rate_list']   = DB::table('MASTER_RATE_VALUE')->get();
	
	$data['comp_list']   = DB::table('MASTER_COMP')->get();
	
	$data['profit_list'] = DB::table('MASTER_PFCT')->get();


	if($year_month!=''){

	  $query = DB::table('PAY_CALENDER');
		$query->where('MONTH_YR', $year_month);
		$query->where('COMP_CODE', $comp_code);
		$query->where('FY_CODE', $fisYear);
		$classData= $query->get()->first();

		$monthDate = date("F Y", strtotime($classData->MONTH_YR));

		return view('admin.finance.transaction.hrm.edit_pay_calender',$data+compact('classData', 'monthDate','compName'));

	}else{

		$request->session()->flash('alert-error', 'Employee Grade Not Found...!');

		return redirect('/Master/Setting/view-pay-calender');

	}
}

public function UpdatePayCalender(Request $request){

	$validate = $this->validate($request, [
         
         'comp_code' => 'required'
	]);

	$compName   = $request->session()->get('company_name');
	
	$fisYear    =  $request->session()->get('macc_year');
	
	$getcomcode = explode('-', $compName);
	
	$comp_code  = $getcomcode[0];
	$comp_name  = $getcomcode[1];
	
	$month_yr   = $request->input('month_yr');
	
	$hdatee     = $request->input('holidayDate');
	
	$dateArr    = explode(",",$hdatee);
	
	$timestamp  = ARRAY();
      	
    foreach ($dateArr as $row) {

		$dateArr1 = explode("00:00:00",$row);

		date_default_timezone_set('Asia/Kolkata');

        $timestamp[] = date('Y-m-d', strtotime($dateArr1[0]));

    }

	$days = implode(",",$timestamp);

	$data = array(

		"FY_CODE"      =>  $fisYear,
		"COMP_CODE"    =>  $comp_code,
		"COMP_NAME"    =>  $comp_name,
		"PLANT_CODE"   =>  $request->input('plant_code'),
		"PLANT_NAME"   =>  $request->input('plant_name'),
		"PFCT_CODE"    =>  $request->input('Profit_center_code'),
		"PFCT_NAME"    =>  $request->input('profitcenter_name'),
		"MONTH_DAYS"   =>  $request->input('month_days'),
		"HOLIDAYS"     =>  $request->input('holidays'),
		"HOLIDAY_DATE" =>  $days, 
		"WORK_DAYS"    =>  $request->input('work_days'),

	);

	$saveData = DB::table('PAY_CALENDER')->where('MONTH_YR', $month_yr)->where('FY_CODE',$fisYear)->where('COMP_CODE',$comp_code)->update($data);

	if($saveData){

		$request->session()->flash('alert-success', 'Pay Calendar Update Successfully...!');
		
		return redirect('/Master/Setting/view-pay-calender');

	}else{

		$request->session()->flash('alert-error', 'Pay Calendar Can Not Update...!');
		
		return redirect('/Master/Setting/view-pay-calender');

	}
}

public function DeletePayCalender(Request $request){

	$payCal = $request->input('payCal');
		
    if($payCal !=''){
    		
        try{

             //DB::enableQueryLog();
			$Delete = DB::table('PAY_CALENDER')->where('MONTH_YR', "$payCal")->delete();
    		// dd(DB::getQueryLog());
    		
	    	if($Delete){

				$request->session()->flash('alert-success', 'Pay Calender Was Deleted Successfully...!');
					
				return redirect('/Master/Setting/view-pay-calender');

			}else{

				$request->session()->flash('alert-error', 'Pay Calender Can Not Deleted...!');
					
				return redirect('/Master/Setting/view-pay-calender');

			}

		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Pay Calender Can not be Deleted...! Used In Another Transaction...!');
					
		}

    }else{

        $request->session()->flash('alert-error', 'Zone  Not Found...!');
	}
}

public function LeaveTrans(Request $request){

	$CompanyCode  = $request->session()->get('company_name');

	$MaccYear     = $request->session()->get('macc_year');

	$getcomcode   = explode('-', $CompanyCode);

	$comp_code    = $getcomcode[0];
	$trandCode    = 'E3';

	$transCdData  = DB::table('MASTER_TRANSACTION')->where('TRAN_CODE',$trandCode)->get()->first();
	$trans_list   = $transCdData->TRAN_CODE;

	$seriesData   = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$trandCode)->get()->toArray();

	$plantData    =  DB::table('MASTER_PLANT')->get();

	$empData      =  DB::table('MASTER_EMP')->where('COMP_CODE', $comp_code)->get();

	$leaveData    =  DB::table('MASTER_LEAVETYPE')->get();

	$fyData       =  DB::table('MASTER_FY')->where('FY_CODE', $MaccYear)->get()->first();

	$fy_from_date = $fyData->FY_FROM_DATE;

	$fy_to_date   = $fyData->FY_TO_DATE;

	$title        = 'Add Leave Transaction';

  return view('admin.finance.transaction.hrm.leave_trans',compact('trans_list','seriesData','plantData','empData','leaveData','fy_from_date','fy_to_date'));	
}

public function SaveTransactionLeave(Request $request){

	$validate = $this->validate($request, [

		'leave_trans_date'      => 'required',
		'tranCode'              => 'required',
		'seriesCode'            => 'required',
		'seriesName'            => 'required',
		'emp_code'              => 'required',
		'type_of_leave'         => 'required',
		'from_date'             => 'required',
		'to_date'               => 'required',
		'contact_details'       => 'digits:10',
		'reason_leave'          => 'required',
			
  ]);


  $createdBy  = $request->session()->get('userid');

	$compName   = $request->session()->get('company_name');

  $fisYear 	  = $request->session()->get('macc_year');

	$getcomcode = explode('-', $compName);
	
	$comp_code  = $getcomcode[0];
	
	$comp_name  = $getcomcode[1];


  // $transleaveData = DB::table('MASTER_LEAVETRAN')->orderBy('ID', 'DESC')->first();
  // echo '<PRE>';
  // print_r($transleaveData);echo '</PRE>';exit();

	$flag             = 1;

	$emp_code         = $request->input('empname');
	
	$empName          = DB::table('MASTER_EMP')->where('EMP_CODE', $emp_code)->where('COMP_CODE', $comp_code)->get()->first();
	
	$leave_code       = $request->input('type_of_leave');
	
	$leavename        = DB::table('MASTER_LEAVETYPE')->where('LEAVE_CODE', $leave_code)->get()->first();

	$designation      = $request->input('designation');

	$designame        = DB::table('MASTER_DESIG')->where('DESIG_CODE', $designation)->get()->first();

	$from_date        = date("Y-m-d", strtotime($request->input('from_date')));
	
	$to_date          = date("Y-m-d", strtotime($request->input('to_date')));

	$leave_trans_date = date("Y-m-d", strtotime($request->input('leave_trans_date')));

	$vrno             = $request->input('vrno');
	$trans_code       = $request->input('tranCode');
	$series_code      = $request->input('seriesCode');
	$discriptn_page   = 'Description page';
	$acc_code         = '';

  if($vrno == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrno;
		}

		$vrno_Exist = DB::table('MASTER_LEAVETRAN')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}


  // try{

  $data = array(

    "COMP_CODE"            =>   $comp_code,
	  "COMP_NAME"            =>   $comp_name,
	  "FY_YEAR"              =>   $fisYear,
	  "DATE"                 =>   $leave_trans_date,
	  "TRAN_CODE"            =>   $request->input('tranCode'),
	  "SERIES_CODE"          =>   $request->input('seriesCode'),
	  "SERIES_NAME"          =>   $request->input('seriesName'),
	  "VRNO"                 =>   $NewVrno,
	  "PLANT_CODE"           =>   $request->input('PlantCode'),
	  "PLANT_NAME"           =>   $request->input('plantName'),
	  "PFCT_CODE"            =>   $request->input('profitcen_code'),
	  "PFCT_NAME"            =>   $request->input('profitcenter_name'),
	  "EMP_CODE"             =>   $request->input('emp_code'),
	  "EMP_NAME"             =>   $request->input('emp_name'),
	  "DESIG_NAME"          =>   $designame->DESIG_NAME,
	  "DESIG_CODE"           =>   $request->input('designation'),
	  "LEAVE_CODE"           =>   $request->input('type_of_leave'),
	  "LEAVE_NAME"           =>   $leavename->LEAVE_NAME,
	  "FROM_DATE"            =>   $from_date,
	  "TO_DATE"              =>   $to_date,
	  "NO_OF_DAYS"           =>   $request->input('no_of_days'),
	  "REASON_LEAVE"         =>   $request->input('reason_leave'),
	  "CONTACT"              =>   $request->input('contact_details'),
	  "APPROVE"              =>   $request->input('approved'),
	  "FLAG"                 =>   '0',
	  "TRANLEAVE_BLOCK"      =>   'NO',
	  "CREATED_BY"           =>   $createdBy,
	  "UPDATED_BY"           =>   $createdBy,

  );

  $saveData = DB::table('MASTER_LEAVETRAN')->insert($data);

  $checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->get()->toArray();

			if(empty($checkvrnoExist)){
				$datavrnIn =array(
					'COMP_CODE'   =>$comp_code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);
			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->update($datavrn);
			}

  if ($saveData) {

		$request->session()->flash('alert-success', 'Transaction Leave Was Successfully Added...!');

		return redirect('/Transaction/Leave/view-leave-trans');

	}else{

		$request->session()->flash('alert-error', 'Transaction Leave Can Not Added...!');
		
		return redirect('/Transaction/Leave/view-leave-trans');

	}

	// $this->userLogInsert($createdBy,$trans_code,$series_code,$vrno,$discriptn_page,$acc_code);

	// 	DB::commit();
			
  // }catch (\Exception $e) {

	// 	DB::rollBack();

	// 	$request->session()->flash('alert-error', 'Transaction Leave Can Not Added...!');
		
	// 	return redirect('/Transaction/Leave/view-leave-trans');
		   
	// }     
  
}


public function ViewLeaveTrans(Request $request){

	$compName = $request->session()->get('company_name');

  if($request->ajax()) {

    $title ='View Leave Transaction';

    $userid    = $request->session()->get('userid');

    $userType = $request->session()->get('usertype');

    $compName = $request->session()->get('company_name');
    
    $getcomcode = explode('-', $compName);
	
		$comp_code  = $getcomcode[0];

    $fisYear =  $request->session()->get('macc_year');

		if($userType=='admin' || $userType=='Admin'){
			
			$data = DB::table('MASTER_LEAVETRAN')->where('COMP_CODE',$comp_code)->where('FY_YEAR',$fisYear)->orderBy('ID','DESC');

    }else if($userType=='superAdmin' || $userType=='user'){

      $data = DB::table('MASTER_LEAVETRAN')->orderBy('ID','DESC');
		}else{

	    $data='';
	  }

	  return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){})->toJson();

	}

	if(isset($compName)){

	  return view('admin.finance.transaction.hrm.view_leave_trans');

	}else{

			return redirect('/useractivity');
	}
        
}

public function LeaveTransChieldRTowData(Request $request){
  
  $response_array = array();

	$id = $request->input('id');

	if ($request->ajax()) {

	  $leave_details = DB::table("MASTER_LEAVETRAN")->where('ID',$id)->get()->first();
            
	  if($leave_details){

    	$response_array['response'] = 'success';
	    
	    $response_array['data'] = $leave_details ;

      $data = json_encode($response_array);

      print_r($data);

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
	}

}

public function DeleteLeaveTrans(Request $request){

  $transleaveId = $request->input('transleaveId');
		
		if($transleaveId!=''){
    		
    	try{

    		$Delete = DB::table('MASTER_LEAVETRAN')->where('ID', $transleaveId)->delete();

			  if ($Delete) {

				$request->session()->flash('alert-success', 'Leave Transaction Was Deleted Successfully...!');
				return redirect('/Transaction/Leave/view-leave-trans');

			  }else{

				$request->session()->flash('alert-error', 'Leave Transaction Can Not Deleted...!');
				return redirect('/Transaction/Leave/view-leave-trans');

			 }

		  }catch(Exception $ex){

			    $request->session()->flash('alert-error', 'Leave Transaction Can not be Deleted...! Used In Another Transaction...!');
					return redirect('/Transaction/Leave/view-leave-trans');
			}

    }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
			return redirect('/Transaction/Leave/view-leave-trans');

    }

}

public function EditLeaveTrans(Request $request,$id){

  $title = 'Edit Leave Transaction';

  $CompanyCode   = $request->session()->get('company_name');

	$MaccYear      = $request->session()->get('macc_year');

  $seriesData = DB::table('MASTER_CONFIG')->where('TRAN_CODE','E3')->get()->toArray();

  $plantData =  DB::table('MASTER_PLANT')->get();

  $empData   =  DB::table('MASTER_EMP')->get();
            
  $leaveData =  DB::table('MASTER_LEAVETYPE')->get();
      
  $fyData =  DB::table('MASTER_FY')->where('FY_CODE', $MaccYear)->get()->first();

  $fy_from_date = $fyData->FY_FROM_DATE;
  
  $fy_to_date   = $fyData->FY_TO_DATE;

	$transId = base64_decode($id);
	
	if($transId!=''){
    $query = DB::table('MASTER_LEAVETRAN');
		$query->where('ID', $transId);
		$classData['leaveTrasData']= $query->get()->first();

	  return view('admin.finance.transaction.hrm.edit_leave_trans',$classData+compact('title','seriesData','empData','plantData','leaveData','fyData','fy_from_date','fy_to_date'));

	}else{

		$request->session()->flash('alert-error', 'Leave Transaction Not Found...!');
			return redirect('/finance/transaction/view-leave-trans');
	}

}

public function LeaveTransUpdate(Request $request){

  $validate = $this->validate($request, [

		'leave_trans_date'      => 'required',
		'tranCode'              => 'required',
		'seriesCode'            => 'required',
		'seriesName'            => 'required',
		'vrno'                  => 'required',
		'emp_code'              => 'required',
		'type_of_leave'         => 'required',
		'from_date'             => 'required',
		'to_date'               => 'required',
		'contact_details'       => 'digits:10',
		
  ]);

	$compName 	= $request->session()->get('company_name');

  $fisYear 	=  $request->session()->get('macc_year');

  $createdBy 	= $request->session()->get('userid');

  $getcomcode    = explode('-', $compName);
	
	$comp_code = $getcomcode[0];
	
	$comp_name = $getcomcode[1];

	date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d");
		
	$leaveTransId = $request->input('leaveTransId');
		
  $designation = $request->input('designation');

  $designame = $request->input('desig_name');

  $leave_code = $request->input('type_of_leave');
        
  $leavename = DB::table('MASTER_LEAVETYPE')->where('LEAVE_CODE', $leave_code)->get()->first();

  $from_date = date("Y-m-d", strtotime($request->input('from_date')));
  
  $to_date = date("Y-m-d", strtotime($request->input('to_date')));
  
  $leave_trans_date = date("Y-m-d", strtotime($request->input('leave_trans_date')));
        
  try{

  $data = array(
         
	  "DATE"                 =>   $leave_trans_date,
	  "COMP_CODE"            =>   $comp_code,
	  "COMP_NAME"            =>   $comp_name,
	  "FY_YEAR"              =>   $fisYear,
	  "TRAN_CODE"            =>   $request->input('tranCode'),
	  "SERIES_CODE"          =>   $request->input('seriesCode'),
	  "SERIES_NAME"          =>   $request->input('seriesName'),
	  "VRNO"                 =>   $request->input('vrno'),
	  "PLANT_CODE"           =>   $request->input('PlantCode'),
	  "PLANT_NAME"           =>   $request->input('plantName'),
	  "PFCT_CODE"            =>   $request->input('profitcen_code'),
	  "PFCT_NAME"            =>   $request->input('profitcenter_name'),
	  "EMP_CODE"             =>   $request->input('emp_code'),
	  "EMP_NAME"             =>   $request->input('emp_name'),
	  "DESIG_NAME"          =>   $request->input('desig_name'),
	  "DESIG_CODE"           =>   $request->input('designation'),
	  "LEAVE_CODE"           =>   $request->input('type_of_leave'),
	  "LEAVE_NAME"           =>   $leavename->LEAVE_NAME,
	  "FROM_DATE"            =>   $from_date,
	  "TO_DATE"              =>   $to_date,
	  "NO_OF_DAYS"           =>   $request->input('no_of_days'),
	  "REASON_LEAVE"         =>   $request->input('reason_leave'),
	  "CONTACT"              =>   $request->input('contact_details'),
	  "APPROVE"              =>   $request->input('approved'),
	  "CREATED_BY"           =>   $createdBy,
	  "UPDATED_BY"           =>   $createdBy,

  );

  $saveData = DB::table('MASTER_LEAVETRAN')->where('ID', $leaveTransId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Leave Transaction Was Successfully Updated...!');
			
			return redirect('/Transaction/Leave/view-leave-trans');

		}else{

			$request->session()->flash('alert-error', 'Leave Transaction Can Not Added...!');
			
			return redirect('/Transaction/Leave/view-leave-trans');

		}

	$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);

			DB::commit();
			
  }catch (\Exception $e) {
		
		DB::rollBack();

		$request->session()->flash('alert-error', 'Leave Transaction Can not be Updated...! Used In Another Transaction...!');
		return redirect('/Transaction/Leave/view-leave-trans');
		  
	}
}


public function LeaveApplication(Request $request){

  $CompanyCode   = $request->session()->get('company_name');

  $MaccYear      = $request->session()->get('macc_year');

  $getcomcode    = explode('-', $CompanyCode);

  $comp_code = $getcomcode[0];

	$empname   =  DB::table('MASTER_EMP')->where('COMP_CODE', $comp_code)->get();

	$data['designation_list']    = DB::table('MASTER_DESIG')->get();

	return view('admin.finance.transaction.hrm.leaveApplication', $data+compact('empname'));
}

public function SaveLeaveApplication(Request $request){

	$validate = $this->validate($request, [

	'leave_date'      => 'required',
	'empcode'         => 'required',
	'emp_designation' => 'required',
	'leaveList'       => 'required',
	'fromto'          => 'required',
	'noOfDay'         => 'required',

	]);

  $compName 	= $request->session()->get('company_name');

	$fisYear 	=  $request->session()->get('macc_year');

	$createdBy 	= $request->session()->get('userid');

	$getcomcode    = explode('-', $compName);
  
  $comp_code = $getcomcode[0];
  
  $comp_name = $getcomcode[1];
	
	$date = date("Y-m-d", strtotime($request->leave_date));

  if($file = $request->hasFile('signature')) {

   $filenamewithext = $request->file('signature')->getClientOriginalName();
   $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
   $extension = $request->file('signature')->getClientOriginalExtension();
   $filenamestore = $filename.'_'.date('Ymd-His').'.'.$extension;
   $path = $request->file('signature')->move('public/dist/img/sign',$filenamestore);
        
  }else{

    $filenamestore = 'noimage';
  }

  try{

	  $data = array(

    "DATE"            =>$date,
    "COMP_CODE"       =>$comp_code,
    "COMP_NAME"       =>$comp_name,
    "FY_YEAR"         =>$fisYear,
    "EMP_CODE"        =>$request->input('empcode'),
    "EMP_NAME"        =>$request->input('empName'),
    "DESIG_CODE"     =>$request->input('emp_designation'),
    "DESIG_NAME"     =>$request->input('desig_name'),
    "FUNCTION"        =>$request->input('function'),
    "LEAVE_TYPE"      =>$request->input('leaveList'),
    "FROMTODATE"      =>$request->input('fromto'),
    "NOOFDAYS"        =>$request->input('noOfDay'),
    "LEAVE_REASON"    =>$request->input('reason'),
    "CONTACT"         =>$request->input('contact_details'),
    "EMP_SIGNATURE"   =>$filenamestore,
    "FLAG"            =>'0',
    "CREATED_BY"      =>$createdBy,
    "LAST_UPDATE_BY"  =>$createdBy,
  );

  $saveData = DB::table('LEAVE_APPLICATION')->insert($data);

  if($saveData){

		$request->session()->flash('alert-success', 'Employee Leave Application Was Successfully Saved...!');
		
		return redirect('/Transaction/LeaveApplication/ViewLeaveApplication');

	}else{

		$request->session()->flash('alert-error', 'Employee Leave Application Can Not Added...!');
		
		return redirect('/Transaction/LeaveApplication/ViewLeaveApplication');

	}

	DB::commit();
			
  }catch (\Exception $e) {
		
		DB::rollBack();

		$request->session()->flash('alert-error', 'Employee Leave Application Can Not Added...!');
		
		return redirect('/Transaction/LeaveApplication/ViewLeaveApplication');
		    
	}

  

}

public function EditLeaveApplication(Request $request,$id){

	$title       = 'Edit Leave Application';

	$CompanyCode = $request->session()->get('company_name');

	$MaccYear    = $request->session()->get('macc_year');
	
	$createdBy   = $request->session()->get('userid');

	$getcomcode  = explode('-', $CompanyCode);
	
	$comp_code   = $getcomcode[0];
	
	$transId     = base64_decode($id);

  if($transId!=''){

  	$query = DB::table('LEAVE_APPLICATION');
		$query->where('ID', $transId);
		$query->where('COMP_CODE', $comp_code);
		$query->where('FY_YEAR', $MaccYear);
		$classData['leaveApplData']= $query->get()->first();
    
    return view('admin.finance.transaction.hrm.edit_leaveApplication',$classData+compact('title'));

	}else{

		$request->session()->flash('alert-error', 'Leave Application Not Found...!');
			
		return redirect('/Transaction/LeaveApplication/ViewLeaveApplication');
	}

}

public function UpdateLeaveApplication(Request $request){

  $validate = $this->validate($request, [

			'leave_date'      => 'required',
			'empcode'         => 'required',
			'emp_designation' => 'required',
			'leaveList'       => 'required',
			'fromto'          => 'required',
			'noOfDay'         => 'required',
	
	]);

		
	$compName   = $request->session()->get('company_name');

	$fisYear    = $request->session()->get('macc_year');

	$createdBy  = $request->session()->get('userid');

	$getcomcode = explode('-', $compName);
	
	$comp_code  = $getcomcode[0];
	
	$comp_name  = $getcomcode[1];

	$id         = $request->leaveId;
	
	$date       = date("Y-m-d", strtotime($request->leave_date));

	$emp_sign   = $request->input('empSignExist');

	$emp_code   = $request->input('empcode');

  if($file = $request->hasFile('signature') == '') {

       $filenamestore = $emp_sign;
  
  }else{

  	$filenamewithext = $request->file('signature')->getClientOriginalName();
    
    $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
    
    $extension = $request->file('signature')->getClientOriginalExtension();
    
    $filenamestore = $filename.'_'.date('Ymd-His').'.'.$extension;
    
    $path = $request->file('signature')->move('public/dist/img/sign',$filenamestore);

  }

  try{

   $data = array(

    "DATE"            =>$date,
    "COMP_CODE"       =>$comp_code,
    "COMP_NAME"       =>$comp_name,
    "FY_YEAR"         =>$fisYear,
    "EMP_CODE"        =>$request->input('empcode'),
    "EMP_NAME"        =>$request->input('empname'),
    "DESIG_CODE"     =>$request->input('emp_designation'),
    "DESIG_NAME"     =>$request->input('desig_name'),
    "FUNCTION"        =>$request->input('function'),
    "LEAVE_TYPE"      =>$request->input('leaveList'),
    "FROMTODATE"      =>$request->input('fromto'),
    "NOOFDAYS"        =>$request->input('noOfDay'),
    "LEAVE_REASON"    =>$request->input('reason'),
    "CONTACT"         =>$request->input('contact_details'),
    "EMP_SIGNATURE"   =>$filenamestore,
    "FLAG"            =>'0',
    "CREATED_BY"      =>$createdBy,
    "LAST_UPDATE_BY"  =>$createdBy,

  );

  $saveData = DB::table('LEAVE_APPLICATION')->where('ID', $id)->where('EMP_CODE',$emp_code)->where('COMP_CODE', $comp_code)->where('FY_YEAR', $fisYear)->update($data);

  if ($saveData) {

		$request->session()->flash('alert-success', 'Update Employee Leave Application Was Successfully Saved...!');
		
		return redirect('/Transaction/LeaveApplication/ViewLeaveApplication');

	} else {

	$request->session()->flash('alert-error', 'Employee Leave Application Can Not Update...!');
	
	return redirect('/Transaction/LeaveApplication/ViewLeaveApplication');

	}

	 DB::commit();
			
  }catch (\Exception $e) {
		
		DB::rollBack();

	$request->session()->flash('alert-error', 'Employee Leave Application Can Not Update...!');
	
	return redirect('/Transaction/LeaveApplication/ViewLeaveApplication');
		   
	}

        
}

public function DeleteLeaveApplication(Request $request){

	$id = $request->input('leaveAppId');

	$compName 	= $request->session()->get('company_name');

	$fisYear 	= $request->session()->get('macc_year');

	$createdBy 	= $request->session()->get('userid');

	$getcomcode    = explode('-', $compName);
  
  $comp_code = $getcomcode[0];

  $Delete = DB::table('LEAVE_APPLICATION')->where('ID', $id)->where('COMP_CODE', $comp_code)->where('FY_YEAR', $fisYear)->delete();

  if($Delete){

		$request->session()->flash('alert-success', 'Delete Employee Leave Application Was Successfully Saved...!');
		
		return redirect('/Transaction/LeaveApplication/ViewLeaveApplication');

	}else{

		$request->session()->flash('alert-error', ' Employee Leave Application Can Not Delete...!');
		
		return redirect('/Transaction/LeaveApplication/ViewLeaveApplication');

	}

}

    public function DeleteTravelRequisition(Request $request){

    	$id = $request->input('travelReqId');

    	$Delete = DB::table('EMP_TRAVELREQACCOM_BODY')->where('TRAVELREQHID', $id)->delete();

    	$Delete1 = DB::table('EMP_TRAVELSHEDULEREQ_BODY')->where('TRAVELREQHID', $id)->delete();

    	$Delete2 = DB::table('EMP_TRAVELREQ_HEAD')->where('ID', $id)->delete();

    	if ($Delete && $Delete1 && $Delete2) {

				$request->session()->flash('alert-success', 'Delete Travel Requisition Was Successfully Saved...!');
				return redirect('/Transaction/TravelRequisition/view-travelRequision');

			} else {

				$request->session()->flash('alert-error', ' Travel Requisition Can Not Delete...!');
				return redirect('/Transaction/TravelRequisition/view-travelRequision');

			}

    }

    public function saveTravelReq(Request $request){
     
      $compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$createdBy 	= $request->session()->get('userid');

    	$getcomcode    = explode('-', $compName);

		  $comp_code = $getcomcode[0];
		  
		  $comp_name = $getcomcode[1];

		  $date = date("Y-m-d", strtotime($request->travelReqSh_date));

    	try{

    		$data = array(

					"DATE"              => $date,
					"COMP_CODE"         => $comp_code,
					"COMP_NAME"         => $comp_name,
					"FY_YEAR"           => $fisYear,
					"EMP_CODE"          => $request->input('empcode'),
					"EMP_NAME"          => $request->input('empname'),
					"DESIG_CODE"        => $request->input('desig_code'),
					"DESIG_NAME"        => $request->input('desig_name'),
					"AGE"               => $request->input('age'),
					"GRADE_CODE"        => $request->input('grade_code'),
					"GRADE_NAME"        => $request->input('grade_name'),
					"GENDER"            => $request->input('gender'),
					"FUNCTION"          => $request->input('functionData'),
					"PURPOSE_OF_TRAVEL" => $request->input('pur_travel'),
					"FLAG"              => '0',
					"CREATED_BY"        => $createdBy,
					"LAST_UPDATED_BY"   => $createdBy,
    	);

    	$saveData = DB::table('EMP_TRAVELREQ_HEAD')->insert($data);

    	$lastid= DB::getPdo()->lastInsertId();

    	$travelSlno = $request->input('TravelDetlSlno');

    	$AccoSlno   = $request->input('AccoDetlSlno');

    	$travelCount = count($travelSlno);

			$accoCount   = count($AccoSlno);

    	for ($i=0; $i < $travelCount; $i++) { 

    		$travel_date  = $request->input('travelReqDate');

        $travelDt = date("Y-m-d", strtotime($travel_date[$i]));

        $tPicker   = $request->input('tPicker');

        $placeFrom = $request->input('placeFrom');

        $placeTo   = $request->input('placeTo');

        $mode      = $request->input('mode');

        $travelRemarks = $request->input('travelRemarks');

        $data1 = array(

             "TRAVELREQHID"        =>  $lastid,
             "TRAVEL_SHEDULE_DATE" =>  $travelDt,
             "TIME"                =>  $tPicker[$i],
             "PLACE_FROM"          =>  $placeFrom[$i],
             "PLACE_TO"            =>  $placeTo[$i],
             "MODE_OF_TRANSPORT"   =>  $mode[$i],
             "REMARKS"             =>  $travelRemarks[$i],
             "FLAG"                =>  '0',
             "CREATED_BY"          =>  $createdBy,
             "LAST_UPDATE_BY"      =>  $createdBy,
        );

        $saveData1 = DB::table('EMP_TRAVELSHEDULEREQ_BODY')->insert($data1);

    	}

    	for ($i=0; $i < $accoCount; $i++) { 

    		$place_id  = $request->input('place_id');

    		$hotel_id   = $request->input('hotel_id');

    		$FromDate = $request->input('FromDate');
        
        $dtFrom = date("Y-m-d h:m A", strtotime($FromDate[$i]));
            
        $toDateTime   = $request->input('dtTo');

        $dtTo = date("Y-m-d h:m A", strtotime($toDateTime[$i]));

        $tblAccoremark      = $request->input('tblAccoremark');
        
        $data2 = array(

         "TRAVELREQHID"    =>  $lastid,
         "PLACE"           =>  $place_id[$i],
         "HOTEL"           =>  $hotel_id[$i],
         "DATE_TIME_FROM"  =>  $dtFrom,
         "DATE_TIME_TO"    =>  $dtTo,
         "REMARKS"         =>  $tblAccoremark[$i],
         "FLAG"            =>  '0',
         "CREATED_BY"      =>  $createdBy,
         "LAST_UPDATED_BY"  =>  $createdBy,
        );

        $saveData2 = DB::table('EMP_TRAVELREQACCOM_BODY')->insert($data2);

    	}

			  DB::commit();

			  $response_array['response'] = 'success';

		    $data = json_encode($response_array);

		    print_r($data);
			 

       }catch (Exception $e) {
		    
		    DB::rollBack();
				
				$response_array['response'] = 'error';

        $data = json_encode($response_array);

        print_r($data);
		  }

    }

    public function UpdateTravelReq(Request $request){
     
      $compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$createdBy 	= $request->session()->get('userid');

    	$getcomcode    = explode('-', $compName);

		  $comp_code = $getcomcode[0];
		  
		  $comp_name = $getcomcode[1];

    	$id         = $request->input('headId');

    	$date = date("Y-m-d", strtotime($request->travelReqSh_date));

    	try{

    	$data = array(

         "DATE"              => $date,
         "COMP_CODE"         => $comp_code,
         "COMP_NAME"         => $comp_name,
         "FY_YEAR"           =>  $fisYear,
         "EMP_CODE"          => $request->input('empcode'),
         "EMP_NAME"          => $request->input('empname'),
         "DESIG_CODE"        => $request->input('desig_code'),
         "DESIG_NAME"        => $request->input('desig_name'),
         "AGE"               => $request->input('age'),
         "GENDER"            => $request->input('gender'),
         "FUNCTION"          => $request->input('functionData'),
         "PURPOSE_OF_TRAVEL" => $request->input('pur_travel'),
         "FLAG"              => '0',
         "CREATED_BY"        => $createdBy,
         "LAST_UPDATED_BY"   => $createdBy,
    	);



    	$updateData = DB::table('EMP_TRAVELREQ_HEAD')->where('ID', $id)->update($data);



    	// $lastid= DB::getPdo()->lastInsertId();

    	$travelSlno = $request->input('TravelDetlSlno');
    	$AccoSlno   = $request->input('AccoDetlSlno');

    	$travelCount = count($travelSlno);
    	$accoCount   = count($AccoSlno);

    	$deleteData = DB::table('EMP_TRAVELSHEDULEREQ_BODY')->where('TRAVELREQHID', $id)->delete();

    	for ($i=0; $i < $travelCount; $i++) { 

    		$bodyId = $request->input('travelShId');

		    $travel_date  = $request->input('travelReqDate');
	      $travelDt = date("Y-m-d", strtotime($travel_date[$i]));
	      $tPicker   = $request->input('tPicker');
	      $placeFrom = $request->input('placeFrom');
	      $placeTo   = $request->input('placeTo');
	      $mode      = $request->input('mode');
	      $travelRemarks = $request->input('travelRemarks');

	      $data1 = array(

	       "TRAVELREQHID"        =>  $id,
	       "TRAVEL_SHEDULE_DATE" =>  $travelDt,
	       "TIME"                =>  $tPicker[$i],
	       "PLACE_FROM"          =>  $placeFrom[$i],
	       "PLACE_TO"            =>  $placeTo[$i],
	       "MODE_OF_TRANSPORT"   =>  $mode[$i],
	       "REMARKS"             =>  $travelRemarks[$i],
	       "FLAG"                =>  '0',
	       "CREATED_BY"          =>  $createdBy,
	       "LAST_UPDATE_BY"      =>  $createdBy,
	      );


          $updateData1 = DB::table('EMP_TRAVELSHEDULEREQ_BODY')->insert($data1);

    	}

    	 $deleteData2 = DB::table('EMP_TRAVELREQACCOM_BODY')->where('TRAVELREQHID', $id)->delete();

    	for ($i=0; $i < $accoCount; $i++) { 

    		$accoId = $request->input('travelAccoId');

    		$place_id  = $request->input('place_id');

    		$hotel_id   = $request->input('hotel_id');

    		$FromDate = $request->input('FromDate');
        $dtFrom = date("Y-m-d h:m A", strtotime($FromDate[$i]));
        
        $toDateTime   = $request->input('dtTo');
        $dtTo = date("Y-m-d h:m A", strtotime($toDateTime[$i]));

        $tblAccoremark      = $request->input('tblAccoremark');

       
            

        $data2 = array(

         "TRAVELREQHID"    =>  $id,
         "PLACE"           =>  $place_id[$i],
         "HOTEL"           =>  $hotel_id[$i],
         "DATE_TIME_FROM"  =>  $dtFrom,
         "DATE_TIME_TO"    =>  $dtTo,
         "REMARKS"         =>  $tblAccoremark[$i],
         "FLAG"            =>  '0',
         "CREATED_BY"      =>  $createdBy,
         "LAST_UPDATED_BY"  =>  $createdBy,
        );

        $updateData2 = DB::table('EMP_TRAVELREQACCOM_BODY')->insert($data2);
       }

        DB::commit();

			  $response_array['response'] = 'success';

		    $data = json_encode($response_array);

		    print_r($data);
			 

       }catch (Exception $e) {
		    
		    DB::rollBack();

		    
		    $response_array['response'] = 'error';

        $data = json_encode($response_array);

        print_r($data);
		  }
    }

    public function TravelRequisition(Request $request){

    	$MaccYear    = $request->session()->get('macc_year');

    	$compName 	= $request->session()->get('company_name');

	    $getcomcode    = explode('-', $compName);

		  $comp_code = $getcomcode[0];

    	$empname   =  DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->get();

    	$data['designation_list']    = DB::table('MASTER_DESIG')->get();
    	$data['transport_list']    = DB::table('MASTER_MODEOFTRANSPORT')->get();
    	$data['hotel_list']    = DB::table('MASTER_HOTEL')->get();

    	return view('admin.finance.transaction.hrm.travelRequisition', $data+compact('empname'));
    }


    public function ViewTravelRequisition(Request $request){

	    $compName = $request->session()->get('company_name');

	    if($request->ajax()){

	    $title    = 'View Travel Requisition';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');

			$getcomcode    = explode('-', $compName);

		  $comp_code = $getcomcode[0];
			
			$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	  $data = DB::table('EMP_TRAVELREQ_HEAD')->where('COMP_CODE',$comp_code)->where('FY_YEAR',$fisYear)->orderBy('ID','DESC');

    	}
    	else if($userType=='superAdmin'|| $userType=='user') {    		

    		$data = DB::table('EMP_TRAVELREQ_HEAD')->where('COMP_CODE',$comp_code)->where('FY_YEAR',$fisYear)->orderBy('ID','DESC');

    	}
    	else{
    		$data ='';
    	}


    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

      }

      if(isset($compName)){

	    	return view('admin.finance.transaction.hrm.view_travelRequision');

	  }else{

			return redirect('/useractivity');

	  }
	  }


	public function ViewLeaveApplication(Request $request){

    $compName = $request->session()->get('company_name');

    if($request->ajax()){

	    $title    = 'View Leave Application';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');

			$getcomcode    = explode('-', $compName);

		  $comp_code = $getcomcode[0];
			
			$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	  $data = DB::table('LEAVE_APPLICATION')->where('COMP_CODE',$comp_code)->where('FY_YEAR',$fisYear)->orderBy('id','DESC');

    	}
    	else if ($userType=='superAdmin' || $userType=='user') {    		

    		$data = DB::table('LEAVE_APPLICATION')->where('COMP_CODE',$comp_code)->where('FY_YEAR',$fisYear)->orderBy('id','DESC');

    	}
    	else{
    		$data ='';
    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

      }

      if(isset($compName)){

	    	return view('admin.finance.transaction.hrm.view_leaveApplication');

		  }else{

				return redirect('/useractivity');
			}
	}

    public function ViewTravelReqData(Request $request){
    	$response_array = array();

	    $travelHeadId = $request->input('travelHeadId');
	    if ($request->ajax()) {

	    	$travelShData = DB::table('EMP_TRAVELSHEDULEREQ_BODY')->where('TRAVELREQHID',$travelHeadId)->get();

	    	if ($travelShData) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $travelShData ;

	            $data = json_encode($response_array);

	            print_r($data);

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
	    }


    }

     public function ViewAccommodationData(Request $request){
    	$response_array = array();

	    $travelHeadId = $request->input('travelHeadId');
	    if ($request->ajax()) {

	    	$travelShData = DB::table('EMP_TRAVELREQACCOM_BODY')->where('TRAVELREQHID',$travelHeadId)->get();

	    	if ($travelShData) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $travelShData ;

	            $data = json_encode($response_array);

	            print_r($data);

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
	    }


    }

    public function EditTravelRequisition(Request $request, $id){

    	$title = 'Edit Travel Requisition';

      $CompanyCode   = $request->session()->get('company_name');

			$MaccYear      = $request->session()->get('macc_year');

			$travelReqId = base64_decode($id);

    	if($travelReqId!=''){

				$query = DB::table('EMP_TRAVELREQ_HEAD');
				$query->where('ID', $travelReqId);
				$classData['travelReqData']= $query->get()->first();

				$emp_grade =  $classData['travelReqData']->GRADE_CODE;
				
				$transportData = DB::table('MASTER_MODEOFTRANSPORT')->where('GRADE_CODE', $emp_grade)->get();

				$hotelData     = DB::table('MASTER_HOTEL')->where('GRADE_CODE', $emp_grade)->get();


				$travelheadId = $classData['travelReqData']->ID;

				$query = DB::table('EMP_TRAVELSHEDULEREQ_BODY');
				$query->where('TRAVELREQHID', $travelReqId);
				$classData['travelShReqData']= $query->get();


				$query = DB::table('EMP_TRAVELREQACCOM_BODY');
				$query->where('TRAVELREQHID', $travelReqId);
				$classData['traReqAccoData']= $query->get();

			
        return view('admin.finance.transaction.hrm.edit_travelRequisition',$classData+compact('title','transportData','hotelData'));

		  }else{
			
		  }

    }

    public function SuccessMessage(Request $request,$getName)
    {
       $transName = base64_decode($getName);
       $userid    = $request->session()->get('userid');

       if($transName == 'TravelRequisition')
       {
       	  	$request->session()->flash('alert-success', 'Travel Requisition is Successfully Saved...!');
				return redirect('/Transaction/TravelRequisition/view-travelRequision');
       } 
       if($transName == 'UpdateTravelRequisition')
       {
       	  	$request->session()->flash('alert-success', 'Travel Requisition is Update Successfully');
				return redirect('/Transaction/TravelRequisition/view-travelRequision');
       }
       if($transName == 'EMPPAYMENTADVICE')
       {
       	  	$request->session()->flash('alert-success', 'Employee Payment Advice is Successfully Saved...!');
				return redirect('/Transaction/PaymentAdvice/view-emp-payment-advice-transaction');
       }
       if($transName == 'EmpPayTrans')
       {
       	  	$request->session()->flash('alert-success', 'Employee Payment Transaction is Successfully Saved...!');
				return redirect('/Transaction/EmployeePay/emp-pay-trans');
       }
        if($transName == 'JobApplicationTran')
       {
       	  	$request->session()->flash('alert-success', 'Job Application  Successfully Saved...!');
				return redirect('/Transaction/JobApplication/view-job-application-trans');
       }
       if($transName == 'UpdateJobApplicationTran')
       {
       	  	$request->session()->flash('alert-success', 'Update Job Application  Successfully!');
				return redirect('/Transaction/JobApplication/view-job-application-trans');
       } 
       if($transName == 'ErrorJobApplicationTran')
       {
       	  	$request->session()->flash('alert-error', 'Job Application Can Not be Added.');
				return redirect('/Transaction/JobApplication/view-job-application-trans');
       }
       if($transName == 'ScoreCardUpdate')
       {
       	  	$request->session()->flash('alert-success', 'Score Card Updated Successfully.');
				return redirect('Transaction/ScoreCard/view-score-card-trans');
       }
       if($transName == 'PaymentAdvice')
       {
       	  	$request->session()->flash('alert-success', 'Payment Advice Rejected.');
				return redirect('/finance/user-approval-list/'.base64_encode($userid));
       }

        
    }

    public function EmpPayTrans(Request $request){

		$CompanyCode = $request->session()->get('company_name');
		
		$MaccYear    = $request->session()->get('macc_year');
		
		$getcomcode  = explode('-', $CompanyCode);
		
		$comp_code   = $getcomcode[0];
		
		$title       = 'Employee Pay Transaction';
		$trandCode   = 'PT';

		$data['transData']  = DB::table('MASTER_TRANSACTION')->where('TRAN_CODE','PT')->get()->first();
		
		$data['seriesData'] = DB::table('MASTER_CONFIG')->where('TRAN_CODE','PT')->get()->toArray();
		
		$data['plantData']  =  DB::table('MASTER_PLANT')->get();
		
		$data['empData']    =  DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->where('FY_CODE',$MaccYear)->get();
		
		$data['fyData']     =  DB::table('MASTER_FY')->where('FY_CODE', $MaccYear)->get()->first();
		
		$data['rate_list']  = DB::table('MASTER_RATE_VALUE')->get();
      
        return view('admin.finance.transaction.hrm.add_emp_pay_trans',$data+compact('title','CompanyCode'));	

    }

    public function ViewEmppay(Request $request){

		$CompanyCode        = $request->session()->get('company_name');
		
		$MaccYear           = $request->session()->get('macc_year');
		
		$getcomcode         = explode('-', $CompanyCode);
		
		$comp_code          = $getcomcode[0];
		
		$title              = 'Employee Pay Transaction';
		$trandCode          = 'PT';
		
		$data['transData']  = DB::table('MASTER_TRANSACTION')->where('TRAN_CODE','PT')->get()->first();
		
		$data['seriesData'] = DB::table('MASTER_CONFIG')->where('TRAN_CODE','PT')->get()->toArray();
		
		$data['plantData']  =  DB::table('MASTER_PLANT')->get();
		
		$data['empData']    =  DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->where('FY_CODE',$MaccYear)->get();
		
		$data['fyData']     =  DB::table('MASTER_FY')->where('FY_CODE', $MaccYear)->get()->first();
		
		$data['rate_list']  = DB::table('MASTER_RATE_VALUE')->get();
      
        return view('admin.finance.transaction.hrm.view_emp_pay_tran',$data+compact('title','CompanyCode'));	


    }


    public function EmpPayPfctCode(Request $request){

    	$plant_code=$request->plant_code;
        
      $response_array = array();
  	
	    if ($request->ajax()) {

    	$fetchreocrd = DB::table('MASTER_PLANT')->where('PLANT_CODE', $plant_code)->get()->first();

    	$pfct_code = $fetchreocrd->PLANT_CODE;

    	$fetch_reocrd = DB::table('MASTER_PLANT')->where('PLANT_CODE', $pfct_code)->get()->first();

    	$array1 = array(
             'pfct_code' => $fetchreocrd->PLANT_CODE,
             'pfct_name' => $fetch_reocrd->PLANT_NAME,

    	);
      
      if ($fetch_reocrd) {

    		$response_array['response'] = 'success';

	      $response_array['data'] = $array1;
	           
        $data = json_encode($response_array);

	      print_r($data);

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
	    }
    }


    public function EmployeeList(Request $request){

		$from_date = $request->monthYR;
		
		$plantCode = $request->plant_code;
		
		$previousMon = $request->previousMon;
		
		$MaccYear    = $request->session()->get('macc_year');
		
		$compName 	= $request->session()->get('company_name');
		
		$getcomcode    = explode('-', $compName);
		
		$comp_code = $getcomcode[0];

		$dataCheck = DB::table('EMP_PAYTRAN_HEAD')->where('MONTH_YR',$from_date)->where('FY_YEAR',$MaccYear)->where('COMP_CODE',$comp_code)->get();

		$countDataCheck = count($dataCheck);
				// echo '<PRE>'; print_r($dataCheck);	echo '</PRE>';exit();

    	if ($request->ajax()) {

    	 if (!empty($from_date)) {

				$dataCheck = DB::table('EMP_PAYTRAN_HEAD')->where('MONTH_YR',$from_date)->where('FY_YEAR',$MaccYear)->where('COMP_CODE',$comp_code)->get();

				$countDataCheck = count($dataCheck);
				// echo '<PRE>'; print_r($countDataCheck);	echo '</PRE>';exit();

        $data = array();

				if($countDataCheck == 0){

        $data = DB::select("SELECT `MASTER_EMP`.*, `EMP_ATTENDANCE`.*, `PAY_CALENDER`.*, `MASTER_EMPWAGEHEAD`.*, `MASTER_EMPWAGEHEAD`.`ID` as `pay_id`,`MASTER_FY`.`FY_TO_DATE` as `fy_to_date`,`MASTER_FY`.`FY_FROM_DATE` as `fy_from_date`,`EMP_ITD`.`ACTUAL_AMT` as `actual_amt`,`EMP_ITD`.`PROVISIONAL_AMT` as `provisional_amt`,`EMPPAYMENT_ADVICE_TRAN`.`ACC_CODE` as `emp_acc_code`,`EMPPAYMENT_ADVICE_TRAN`.`MONTH_YR` as `MONTH_YR`,`EMPPAYMENT_ADVICE_TRAN`.`PAYMENT_TYPE` as `payment_type`,`EMPPAYMENT_ADVICE_TRAN`.`CR_AMT` as `CR_AMT`,`EMPPAYMENT_ADVICE_TRAN`.`DR_AMT` as `Advance_amt`,`EMPPAYMENT_ADVICE_TRAN`.`EMI_AMOUNT` as `EMI_AMT` from `MASTER_EMP`

				left join `EMP_ATTENDANCE` on `MASTER_EMP`.`EMP_CODE` = `EMP_ATTENDANCE`.`EMP_CODE`
						AND `MASTER_EMP`.`COMP_CODE` = `EMP_ATTENDANCE`.`COMP_CODE`
						AND `MASTER_EMP`.`FY_CODE` = `EMP_ATTENDANCE`.`FY_CODE`
						
				left join `PAY_CALENDER` on `EMP_ATTENDANCE`.`YR_MONTH` = `PAY_CALENDER`.`MONTH_YR` AND `EMP_ATTENDANCE`.`FY_CODE` = `PAY_CALENDER`.`FY_CODE`  AND `EMP_ATTENDANCE`.`COMP_CODE` = `PAY_CALENDER`.`COMP_CODE`
						
				left join `MASTER_EMPWAGEHEAD` on `MASTER_EMP`.`EMP_CODE` = `MASTER_EMPWAGEHEAD`.`EMP_CODE`AND `MASTER_EMP`.`COMP_CODE` = `MASTER_EMPWAGEHEAD`.`COMP_CODE` AND `MASTER_EMP`.`FY_CODE` = `MASTER_EMPWAGEHEAD`.`FISCAL_YEAR`

				left join `MASTER_FY` on `MASTER_FY`.`FY_CODE` = `EMP_ATTENDANCE`.`FY_CODE` AND `MASTER_FY`.`COMP_CODE` = `EMP_ATTENDANCE`.`COMP_CODE`

				left join `EMP_ITD` on `EMP_ATTENDANCE`.`EMP_CODE` = `EMP_ITD`.`EMP_CODE`AND `EMP_ATTENDANCE`.`COMP_CODE` = `EMP_ITD`.`COMP_CODE`AND `EMP_ATTENDANCE`.`FY_CODE` = `EMP_ITD`.`FY_YEAR`

				left join `EMPPAYMENT_ADVICE_TRAN` on `MASTER_EMP`.`ACC_CODE` = `EMPPAYMENT_ADVICE_TRAN`.`ACC_CODE` AND `MASTER_EMP`.`COMP_CODE` = `EMPPAYMENT_ADVICE_TRAN`.`COMP_CODE` AND `MASTER_EMP`.`FY_CODE` = `EMPPAYMENT_ADVICE_TRAN`.`FY_CODE`  

				where `EMP_ATTENDANCE`.`YR_MONTH` = '".$from_date."' AND `EMP_ATTENDANCE`.`FY_CODE` = '".$MaccYear."' AND `EMP_ATTENDANCE`.`COMP_CODE` = '".$comp_code."' AND `MASTER_FY`.`FY_CODE` = '".$MaccYear."' AND `MASTER_EMP`.`COMP_CODE` = '".$comp_code."' AND `MASTER_EMPWAGEHEAD`.`COMP_CODE` = '".$comp_code."' AND `MASTER_EMPWAGEHEAD`.`FISCAL_YEAR` = '".$MaccYear."' AND `MASTER_EMPWAGEHEAD`.`EMPPAY_BLOCK` = '1'");

				return DataTables()->of($data)->addIndexColumn()->make(true);
				 
				}else{

				  if($dataCheck){

				  return DataTables()->of($data)->addIndexColumn()->make(true);
			      
				  }

				}
      }else{

        $data = array();

        return DataTables()->of($data)->addIndexColumn()->make(true);
            
    }

		}else{

      $data = array();

      return DataTables()->of($data)->addIndexColumn()->make(true);

    }

   }

   public function ViewEmployeeList(Request $request){

			$from_date   = $request->monthYR;
			
			$plantCode   = $request->plant_code;

			$previousMon = $request->previousMon;

			$MaccYear    = $request->session()->get('macc_year');

			$compName    = $request->session()->get('company_name');

			$getcomcode  = explode('-', $compName);

			$comp_code   = $getcomcode[0];

		  if ($request->ajax()) {

    		$data = DB::select("SELECT `EMP_PAYTRAN_HEAD`.`MONTH_YR` as `salary_Month`,`EMP_PAYTRAN_BODY`.* from `EMP_PAYTRAN_HEAD`

           left join `EMP_PAYTRAN_BODY` on `EMP_PAYTRAN_HEAD`.`ID` = `EMP_PAYTRAN_BODY`.`PAY_TRANHEAD_ID` 

           where `EMP_PAYTRAN_HEAD`.`FY_YEAR` = '".$MaccYear."' AND `EMP_PAYTRAN_HEAD`.`COMP_CODE` = '".$comp_code."' ");

           return DataTables()->of($data)->addIndexColumn()->make(true);
				 
				

      }else{
      		return DataTables()->of($data)->addIndexColumn()->make(true);
      }
    

   }

  public function ViewEmployeeDetails(Request $request){

		$monYr    = $request->salmon_yr;
		$emp_code = $request->emp_code;

		$compName   = $request->session()->get('company_name');

    $fisYear  =  $request->session()->get('macc_year');

    $getcomcode    = explode('-', $compName);

		$comp_code = $getcomcode[0];

		$comp_name = $getcomcode[1];

    if ($request->ajax()) {

    $comp_add = DB::table('MASTER_COMP')->where('COMP_CODE',$comp_code)->get()->first();

			$add1 = $comp_add->ADD1;

			$add2 = $comp_add->ADD2;

			$add3 = $comp_add->ADD3;
			
			$compAddr = $add1 .' '.$add2.' '.$add3;

			
			$headData  = DB::table('EMP_PAYTRAN_HEAD')->where('MONTH_YR',$monYr)->get()->first();

			$id = $headData->ID;

			$empData = DB::table('MASTER_EMP')->where('EMP_CODE',$emp_code)->get()->first();

			$headBodyData = DB::table('EMP_PAYTRAN_BODY')->where('PAY_TRANHEAD_ID',$id)->where('EMP_CODE', $emp_code)->get()->first();

			$empBodyId = $headBodyData->ID;

			$headWageData =  DB::table('EMP_PAYTRAN_WAGECAL')->where('PAY_TRANHEAD_ID',$id)->where('PAY_TRANBODY_ID', $empBodyId)->get();

			$headForm16Data =   DB::table('EMP_PAYTRAN_FORM16')->where('PAY_TRANHEAD_ID',$id)->where('PAY_TRANBODY_ID', $empBodyId)->get()->first();

			$empAttendData =   DB::table('EMP_ATTENDANCE')->where('EMP_CODE',$emp_code)->where('YR_MONTH', $monYr)->get()->first();

			$ctcData = DB::table('MASTER_EMPWAGEHEAD')->where('COMP_CODE',$comp_code)->where('EMP_CODE',$emp_code)->where('EMPPAY_BLOCK',1)->get()->first();

			$array1 = array(

				'headData'       => $headData,
				'empData'        => $empData,
				'headBodyData'   => $headBodyData,
				'headWageData'   => $headWageData,
				'headForm16Data' => $headForm16Data,
				'compAddr'       => $compAddr,
				'empAttendData'  => $empAttendData,
				'ctcData'        => $ctcData,
      );

			if($empData && $headData && $headBodyData && $headWageData && $headForm16Data){

				$response_array['response'] = 'success';

				$response_array['data'] = $array1;
				
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

   public function TempSaveSalary(Request $request){

    $compName = $request->session()->get('company_name');

    $createdBy 	= $request->session()->get('userid');

    $CompanyCode    = $request->session()->get('company_name');

		$MaccYear      = $request->session()->get('macc_year');

		$getcomcode     = explode('-', $CompanyCode);
		$compcode       =     $getcomcode[0];

		$comp_add = DB::table('MASTER_COMP')->where('COMP_CODE',$compcode)->get()->first();

		$query = DB::select("SELECT ADD1,ADD2,ADD3 FROM `MASTER_COMP` WHERE COMP_CODE = '".$compcode."' ");
		
		$add1 = $comp_add->ADD1;

		$add2 = $comp_add->ADD2;

		$add3 = $comp_add->ADD3;
		
    $compAddr = $add1 .' '.$add2.' '.$add3;

  	$wageInd = $request->wageInd;

  	$wageAmt = $request->wageAmt;

  	$emp_code = $request->empCode;

  	$emp_grade = $request->empGrade;

  	$month_yr = $request->month_yr;

  	$wageType = $request->wageType;

  	$accCode = $request->accCode;

    $FilterArray = array_filter($wageType);

    $HeadCount = count($FilterArray);

    $deleteData1 = DB::table('TEMP_SALARY')->where('EMP_CODE',$emp_code)->where('MONTH_YR',$month_yr)->where('FY_CODE',$MaccYear)->where('COMP_CODE',$compcode)->where('FLAG','1')->where('CREATED_BY',$createdBy)->delete();

    for ($m=0; $m < $HeadCount; $m++) { 

         $data = array(

      	   "MONTH_YR"      => $month_yr,
      	   "FY_CODE"       => $MaccYear,
      	   "COMP_CODE"     => $compcode,
      	   "EMP_CODE"      => $emp_code,
      	   "GRADE_CODE"    => $emp_grade,
      	   "WAGEIND"       => $wageInd[$m],
      	   "WAGETYPE"      => $wageType[$m],
      	   "AMOUNT"        => $wageAmt[$m],
      	   "FLAG"          => '1',
      	   "CREATED_BY"    => $createdBy,
      	   "UPDATED_BY"    => $createdBy

    );

    $saveData1 = DB::table('TEMP_SALARY')->insert($data);

    }

    // $advLoanData = DB::table('EMPPAYMENT_ADVICE_TRAN')->where('ACC_CODE',$accCode)->get();
     
    // $payAdvC = count($advLoanData);

    // if($payAdvC > 0){
    	
    	
    // }
    $response_array = array();
    
    if ($request->ajax()) {

	  	$fetch_reocrd = DB::table('MASTER_EMPWAGEHEAD')->where('EMP_CODE', $emp_code)->where('FISCAL_YEAR',$MaccYear)->where('COMP_CODE',$compcode)->get()->first();

	  	$emppay_id = $fetch_reocrd->ID;

	  	$fetch_reocrd1 = DB::table('EMP_ATTENDANCE')->where('EMP_CODE', $emp_code)->where('YR_MONTH', $month_yr)->where('FY_CODE',$MaccYear)->where('COMP_CODE',$compcode)->get()->first();

	  	$fetch_reocrd2 = DB::table('PAY_CALENDER')->where('MONTH_YR', $month_yr)->where('FY_CODE',$MaccYear)->where('COMP_CODE',$compcode)->get()->first();

	    $fetch_reocrd3 = DB::table('MASTER_WAGE_TYPE')->where('GRADE_CODE', $emp_grade)->where('FY_CODE',$MaccYear)->where('COMP_CODE',$compcode)->get();

	    $fetch_reocrd4 = DB::table('MASTER_EMP')->where('EMP_CODE', $emp_code)->where('COMP_CODE',$compcode)->get()->first();

	    $desigCode = $fetch_reocrd4->DESIG_CODE;

	    $desigName = DB::table('MASTER_DESIG')->where('DESIG_CODE', $desigCode)->get()->first();

	    $nameDesig = $desigName->DESIG_NAME;

	    $fetch_reocrd5 = DB::table('EMP_ITD')->where('EMP_CODE', $emp_code)->where('FY_YEAR',$MaccYear)->where('COMP_CODE',$compcode)->get();

	    $fetch_reocrd6 = DB::table('MASTER_FY')->where('FY_CODE',$MaccYear)->get();

	    $fetch_reocrd7 = DB::table('MASTER_EMPWAGEBODY')->where('EMP_PAYID',$emppay_id)->get();

	    $fetch_reocrd8 = DB::table('MASTER_PTAX')->where('FY_CODE',$MaccYear)->where('COMP_CODE',$compcode)->get();

	    $fetch_reocrd9 = DB::table('TEMP_SALARY')->where('EMP_CODE',$emp_code)->where('MONTH_YR',$month_yr)->where('FY_CODE',$MaccYear)->where('COMP_CODE',$compcode)->get();

      $array1 = array(
					'ctcdata'    => $fetch_reocrd,
					'attendance' => $fetch_reocrd1,
					'month_year' => $fetch_reocrd2,
					'gradeCode'  => $fetch_reocrd3,
					'empdata'    => $fetch_reocrd4,
					'empITD'     => $fetch_reocrd5,
					'fy_data'    => $fetch_reocrd6,
					'fy_yr'      => $MaccYear,
					'emppaystructure' => $fetch_reocrd7,
					'p_tax'      => $fetch_reocrd8,
					'salaryData'      => $fetch_reocrd9,
					'nameDesig'  => $nameDesig,
					'compAddr'   => $compAddr
      );
        	

    	if ($fetch_reocrd &&  $fetch_reocrd1 && $fetch_reocrd3 && $fetch_reocrd4 && $fetch_reocrd5 && $fetch_reocrd6 && $fetch_reocrd7 && $fetch_reocrd8 && $fetch_reocrd9) {

    		$response_array['response'] = 'success';

	      $response_array['data'] = $array1;
	            
	      $data = json_encode($response_array);

	      print_r($data);
	           
			}else{

				  $response_array['response'] = 'error';
          
          $response_array['data'] = '' ;
                
          $data = json_encode($response_array);

          print_r($data);
                // print_r($data1);
			}

	    }else{

	    		$response_array['response'] = 'error';

          $response_array['data'] = '' ;

          $response_array['data1'] = '' ;

          $data = json_encode($response_array);

          print_r($data);
          
	    }
      
    }

    public function EmpPaySalaryTrans(Request $request){
     
		$compName   = $request->session()->get('company_name');
		
		$createdBy  = $request->session()->get('userid');
		
		$fisYear    =  $request->session()->get('macc_year');
		
		$getcomcode  = explode('-', $request->comp_code);
		
		$comp_code   = $getcomcode[0];
		
		$comp_name   = $getcomcode[1];
		
		$vr_date     = date("Y-m-d", strtotime($request->vr_date));
		$series_code = $request->input('seriesCode');
		$trans_code  = $request->input('tranCode');

		$vrno = $request->input('vrno');

	    if($vrno == ''){
      		$vrNum = 1;
	    }else{
	      $vrNum = $vrno;
	    }

	    $vrno_Exist = DB::table('EMP_PAYTRAN_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->where('VRNO',$vrNum)->get()->toArray();

	    if($vrno_Exist){
	        $NewVrno = $vrNum +1;
	    }else{
	        $NewVrno = $vrNum;
	    }

         // SAVE HEAD DATA

		try{

			  $headdata = array(

	            "COMP_CODE"              => $comp_code,
	            "COMP_NAME"              => $comp_name,
	            "FY_YEAR"                => $request->fy_year,
	            "DATE"                   => $vr_date,
	            "TRAN_CODE"              => $trans_code,
	            "SERIES_CODE"            => $series_code,
	            "SERIES_NAME"            => $request->seriesName,
	            "VRNO"                   => $NewVrno,
	            "PLANT_CODE"             => $request->plant_list,
	            "PLANT_NAME"             => $request->plantName,
	            "PFCT_CODE"              => $request->profitcen_code,
	            "PFCT_NAME"              => $request->profitcenter_name,
	            "MONTH_YR"               => $request->monthYR,
	            "FLAG"                   => '0',
	            "CREATED_BY"             => $createdBy,
	            "LAST_UPDATE_BY"         => $createdBy,
	          );

	        $saveData = DB::table('EMP_PAYTRAN_HEAD')->insert($headdata);
	        
	        $lastid= DB::getPdo()->lastInsertId();

	        $checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->get()->toArray();

		    if(empty($checkvrnoExist)){

		        $datavrnIn =array(
		          'COMP_CODE'   =>$comp_code,
		          'FY_CODE'     =>$fisYear,
		          'TRAN_CODE'   =>$trans_code,
		          'SERIES_CODE' =>$series_code,
		          'FROM_NO'     =>1,
		          'TO_NO'       =>99999,
		          'LAST_NO'     =>$NewVrno,
		          'CREATED_BY'  =>$createdBy,
		        );

		        DB::table('MASTER_VRSEQ')->insert($datavrnIn);

		    }else{

		        $datavrn =array(
		          'LAST_NO'=>$NewVrno
		        );

		        DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->update($datavrn);
		    }

			$headC          = $request->all_emp_name;
			
			$FilterArray    = array_filter($headC);
			
			$HeadCount      = count($FilterArray);
			
			$pay_tranheadId = $lastid;

	      	$emp_name           = $request->all_emp_name;
	      	$totalEarn_Amt      = $request->totalEarn_Amt;
	      	$all_department     = $request->all_department;
	      	$all_totalDeducAmt  = $request->all_totalDeducAmt;
	      	$all_totalSalVal    = $request->all_totalSalVal;
	      	$all_empcode        = $request->all_empcode;
	      	$all_empAccCode     = $request->all_empAccCode;
	      	$idictrCount        = $request->all_idictrCount;
	      	$fromSCount         = $request->all_formCount;
	      	$totalRowc          = $request->totalRowc;
	      	$bodyIdTax =[];
	      	$datalistrray = array();
	      	$bIdList = array();

	      	for ($i = 0; $i < $HeadCount; $i++) {
	      		
	      		$data1 = array(

	      		 	"PAY_TRANHEAD_ID"    => $pay_tranheadId,
	      		 	"DEPARTMENT"         => $all_department[$i],
	      		 	"TOT_EARNING"        => $totalEarn_Amt[$i],
	      		 	"TOT_DEDUCTION"      => $all_totalDeducAmt[$i],
	      		 	"TOT_SALARY"         => $all_totalSalVal[$i],
	      		 	"EMP_CODE"           => $all_empcode[$i],
	      		 	"EMP_NAME"           => $emp_name[$i],
	      		 	"ACC_CODE"           => $all_empAccCode[$i],
	      		 	"FLAG"               => '0',
	      		 	"CREATED_BY"         => $createdBy,
	      		 	"LAST_UPDATE_BY"     => $createdBy,

	      		);

	      		$saveData1 = DB::table('EMP_PAYTRAN_BODY')->insert($data1);
	      		
	      		$bodylastid= DB::getPdo()->lastInsertId();
	             
	      		if($idictrCount[$i] == 0){

				}else{

					for ($q=0; $q < $idictrCount[$i]; $q++) { 

						$a = array_fill(1, $idictrCount[$i], $bodylastid);

						$str = implode(',',$a); 

			            $last_id = explode(',',$str);

			            $datalistrray[]= $last_id[0];

					}

				}

				if($fromSCount[$i] == 0){

				}else{

					for ($g=0; $g < $fromSCount[$i]; $g++) { 

						$h = array_fill(1, $fromSCount[$i], $bodylastid);

						$hstr = implode(',',$h); 

				        $blast_id = explode(',',$hstr);

				        $bIdList[]= $blast_id[0];

				    }
				}
		      
		    }

		    $empAccCode    = $request->all_empAccCode;

	        $empAdvAmt     = $request->all_empAdvAmt;

	        $empAdvType    = $request->all_empAdvType;

	        $empEmiAmt     = $request->all_empEmiAmt;

	        $crAmt         = $request->all_crAmt; 

	        $tldeduc_amt   = $request->all_totalDeducAmt;

	        $empAdvOrLoanM = $request->all_empAdvOrLoanM; 
	        
		    for ($l = 0; $l < $HeadCount; $l++) {
	          
	          if($empAccCode[$l] != ''){

	          	$info = DB::table('EMPPAYMENT_ADVICE_TRAN')->where('ACC_CODE',$empAccCode[$l])->where('MONTH_YR',$empAdvOrLoanM[$l])->get()->first();
	          	
	          	$chkDrAmt = $info->DR_AMT;

	          	$chkCrAmt = $info->CR_AMT;
	            
	            if($chkDrAmt == $chkCrAmt){
	               
	            }else{
	              
	            	if($empAdvType[$l] == 'Loan'){

	            		$crLoanAmt = $chkCrAmt + $tldeduc_amt[$l];
	            		
	            		DB::table('EMPPAYMENT_ADVICE_TRAN')->where('ACC_CODE',$empAccCode[$l])->where('MONTH_YR',$empAdvOrLoanM[$l])->update(['CR_AMT' => $crLoanAmt]);
	              
	                }else{
	               
		            	if($empAdvType[$l] == 'Advance'){
	                
			                $crAdvAmt = $chkCrAmt + $tldeduc_amt[$l];
			                
			                DB::table('EMPPAYMENT_ADVICE_TRAN')->where('ACC_CODE',$empAccCode[$l])->where('MONTH_YR',$empAdvOrLoanM[$l])->update(['CR_AMT' => $crAdvAmt]);

		               }

		            } 

	            }
	            
	           }

	          }

	          $wage_code = $request->all_wage_code;

	          $wage_ind  = $request->all_head_wage_ind;

	          $rate      = $request->all_rate;

	          $amount    = $request->all_amount;

	          $logic     = $request->all_logic;

	          $wagetype  = $request->all_wagetype;

		      for ($j=0; $j < $totalRowc; $j++) { 

		        $calData = array(

	         	     "PAY_TRANHEAD_ID" => $lastid,
	                 "PAY_TRANBODY_ID" => $datalistrray[$j],
	                 "WAGEIND_CODE"    => $wage_code[$j],
	                 "WAGE_INDICATOR"  => $wage_ind[$j],
	                 "WAGE_TYPE"       => $wagetype[$j],
	                 "RATE"            => $rate[$j],
	                 "LOGIC"           => $logic[$j],
	                 "AMOUNT"          => $amount[$j],
	                 "FLAG"            => '0',
	                 "CREATED_BY"      => $createdBy,
	                 "LAST_UPDATE_BY"  => $createdBy,	

		        );
	            
	            $saveData2 = DB::table('EMP_PAYTRAN_WAGECAL')->insert($calData);
		         	
		     }

			$grossSal      = $request->all_grossSal;
			$duduction     = $request->all_duduction;
			$taxableIn     = $request->all_taxableIn;
			$taxAmt        = $request->all_taxAmt;
			$taxpaid       = $request->all_taxpaid;
			$taxDueRefund  = $request->all_taxDueRefund;
			$totalWorkDays = $request->all_totalWorkDays;
			$holiday       = $request->all_holiday;
			$leaves        = $request->all_leaves;
			$absent        = $request->all_absent;
			$numWorkDay    = $request->all_numWorkDay;


			$headC1       = $request->all_grossSal;
			
			$FilterArray1 = array_filter($headC1);
			
			$HeadCount1   = count($FilterArray1);

		    for ($m=0; $m < $HeadCount1; $m++) { 

		        $formSixteen = array(

	         		 "PAY_TRANHEAD_ID" => $lastid,
	                 "PAY_TRANBODY_ID" => $bIdList[$m],
	                 "GROSS_SAL"       => $grossSal[$m],
	                 "DEDUCTION"       => $duduction[$m],
	                 "TAXABLE_INCOME"  => $taxableIn[$m],
	                 "TAX_AMT"         => $taxAmt[$m],
	                 "TAX_PAID"        => $taxpaid[$m],
	                 "NET_TAX"         => $taxDueRefund[$m],
	                 "MONTH_DAY"       => $totalWorkDays[$m],
	                 "HOLIDAY"         => $holiday[$m],
	                 "MONTH_LEAVE"     => $leaves[$m],
	                 "ABSENT"          => $absent[$m],
	                 "WORKING_DAY"     => $numWorkDay[$m],
	                 "FLAG"            => '0',
	                 "CREATED_BY"      => $createdBy,
	                 "LAST_UPDATE_BY"  => $createdBy,

		        );

		        $saveData3 = DB::table('EMP_PAYTRAN_FORM16')->insert($formSixteen);
	          
	        }

			$trans_code     = $request->tranCode;
			$series_code    = $request->seriesCode;
			$NewVrno        = $request->vrno;
			$discriptn_page = 'Saved Payement Trans';
			$acc_code       = '';

	        $transData = DB::table('MASTER_VRSEQ')->where('TRAN_CODE', 'PT')->update(['LAST_NO' => $NewVrno+1]);

			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);
			
			DB::commit();
			
			$response_array['response'] = 'success';
	            
	        $response_array['head_data'] = $headdata;
	            
	        $data = json_encode($response_array);

	        print_r($data);

		}catch (Exception $e) {

			DB::rollBack();
			
			$response_array['response'] = 'Error';
			
			$response_array['data'] = $headdata;
			
			$data = json_encode($response_array);
			
			print_r($data);
		}

    }

    public function EmpSalaryExcelReport(Request $request,$MONTH_YR,$COMP_CODE,$FY_YEAR,$PLANT_CODE){
     
        date_default_timezone_set('Asia/Kolkata');

        $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

	    $company_name = $request->session()->get('company_name');

        $getcomcode   = explode('-', $company_name);

        $comp_code    = $getcomcode[0];

        $comp_add = DB::table('MASTER_COMP')->where('COMP_CODE',$comp_code)->get()->first();

		$add1      = $comp_add->ADD1;
		
		$add2      = $comp_add->ADD2;
		
		$add3      = $comp_add->ADD3;
		
		$address   = $add1 .' '.$add2.' '.$add3;
		
		$macc_year = $request->session()->get('macc_year');
		
		$monthYear = $MONTH_YR;
		
		$mon       = explode(' ',$monthYear);
		
		$month     = $mon[0];
		
		$yr        = $mon[1];
		
		$dt        = date("Y-m-d");
		
		$expd      = explode('-',$dt);
		
		$y         = $expd[0];
		
		$m         = $expd[1];
		
		$d         = $expd[2];
		
		$num       =  rand(10,10000);
		
		$fileName  = $month.'_'.$yr.'_'.$y.$m.$d.'_'.$num.'.xlsx';
  
	    public_path('/dist/report_excel/' . $fileName);

	     // DB::enableQueryLog();
        // $data = DB::select("SELECT MASTER_EMP.EMP_NAME, MASTER_EMP.DOJ,EMP_PAYTRAN_WAGECAL_VIEW.*,EMP_PAYTRAN_FORM16.GROSS_SAL,EMP_PAYTRAN_FORM16.MONTH_DAY,EMP_PAYTRAN_FORM16.WORKING_DAY,EMP_PAYTRAN_FORM16.ABSENT,EMP_PAYTRAN_BODY.TOT_EARNING,EMP_PAYTRAN_BODY.TOT_DEDUCTION,EMP_PAYTRAN_BODY.TOT_SALARY FROM EMP_PAYTRAN_HEAD 
        //     LEFT JOIN EMP_PAYTRAN_BODY ON EMP_PAYTRAN_HEAD.ID = EMP_PAYTRAN_BODY.PAY_TRANHEAD_ID 
        //     LEFT JOIN MASTER_EMP ON MASTER_EMP.EMP_CODE = EMP_PAYTRAN_BODY.EMP_CODE 
        //     LEFT JOIN EMP_PAYTRAN_WAGECAL_VIEW ON EMP_PAYTRAN_BODY.ID = EMP_PAYTRAN_WAGECAL_VIEW.PAY_TRANBODY_ID 
        //     LEFT JOIN EMP_PAYTRAN_FORM16 ON EMP_PAYTRAN_HEAD.ID = EMP_PAYTRAN_FORM16.PAY_TRANHEAD_ID AND EMP_PAYTRAN_BODY.ID = EMP_PAYTRAN_FORM16.PAY_TRANBODY_ID
                
        //     WHERE  EMP_PAYTRAN_HEAD.MONTH_YR = 'May 2022' AND EMP_PAYTRAN_HEAD.PLANT_CODE = 'BTEPC0' AND EMP_PAYTRAN_HEAD.COMP_CODE = 'MT01' AND EMP_PAYTRAN_HEAD.FY_YEAR = '2022-2023' ");
        
            // dd(DB::getQueryLog());
            // exit();
       //   $data1 = json_decode(json_encode($data,2), true);
       // echo '<PRE>'; print_r($data1);exit();
	    $db_name = $request->session()->get('dbName');
	    // print_r($db_name);exit();

	    
	           
	    return  Excel::download(new EmployeeSalaryReportExport($comp_code,$macc_year,$monthYear,$PLANT_CODE,$address,$db_name),$fileName, null, [\Maatwebsite\Excel\Excel::XLS]);

    }

    public function EmpPayWage(Request $request){
     
      $id=$request->payid;

      $CompanyCode    = $request->session()->get('company_name');
		  
		  $MaccYear      = $request->session()->get('macc_year');
        
      $response_array = array();
    	

		  if ($request->ajax()) {

        $fetch_reocrd = DB::table('MASTER_EMPWAGEBODY')->where('EMP_PAYID', $id)->get();

        $getCount = count($fetch_reocrd);

	    	$fetch_reocrd1 = DB::table('MASTER_PTAX')->where('FY_CODE',$MaccYear)->get();

        $array1 = array(

         'ctcdata' => $fetch_reocrd,
         'payTax' => $fetch_reocrd1,
         'getCount' => $getCount,

        );
        
        if ($fetch_reocrd  && $fetch_reocrd1) {

    			$response_array['response'] = 'success';
          
          $response_array['data'] = $array1;
          
          $response_array['data_count'] = $getCount;
	            
	        $data = json_encode($response_array);

	        print_r($data);
	           

			  }else{

				$response_array['response'] = 'error';
       
        $response_array['data'] = '' ;
        
        $data = json_encode($response_array);

        print_r($data);
                
			  }

	      }else{

	    		$response_array['response'] = 'error';
          $response_array['data'] = '' ;
          $response_array['data1'] = '' ;

          $data = json_encode($response_array);

          print_r($data);
         
		    }

	     }


     public function EmppayCTC(Request $request){

			$emp_code  =    $request->emp_code;

			$month_yr  =    $request->month_yr;

			$emp_grade =    $request->emp_grade;

			$CompanyCode    = $request->session()->get('company_name');

			$MaccYear      = $request->session()->get('macc_year');

			$getcomcode     = explode('-', $CompanyCode);

			$compcode       =     $getcomcode[0];

	    $response_array = array();
	    	
      if ($request->ajax()) {

	    	$fetch_reocrd = DB::table('MASTER_EMPWAGEHEAD')->where('EMP_CODE', $emp_code)->get()->first();

	    	$emppay_id = $fetch_reocrd->ID;

	    	$fetch_reocrd1 = DB::table('EMP_ATTENDANCE')->where('EMP_CODE', $emp_code)->where('YR_MONTH', $month_yr)->get()->first();

	    	$fetch_reocrd2 = DB::table('PAY_CALENDER')->where('MONTH_YR', $month_yr)->get()->first();

      	$fetch_reocrd3 = DB::table('MASTER_WAGE_TYPE')->where('GRADE_CODE', $emp_grade)->get();

      	$fetch_reocrd4 = DB::table('MASTER_EMP')->where('EMP_CODE', $emp_code)->get()->first();

      	$fetch_reocrd5 = DB::table('EMP_ITD')->where('EMP_CODE', $emp_code)->get();

      	$fetch_reocrd6 = DB::table('MASTER_FY')->where('FY_CODE',$MaccYear)->get();

      	$fetch_reocrd7 = DB::table('MASTER_EMPWAGEBODY')->where('EMP_PAYID',$emppay_id)->get();

      	$fetch_reocrd8 = DB::table('MASTER_PTAX')->where('FY_CODE',$MaccYear)->get();

	    	$array1 = array(
					'ctcdata'    => $fetch_reocrd,
					'attendance' => $fetch_reocrd1,
					'month_year' => $fetch_reocrd2,
					'gradeCode'  => $fetch_reocrd3,
					'empdata'    => $fetch_reocrd4,
					'empITD'     => $fetch_reocrd5,
					'fy_data'    => $fetch_reocrd6,
					'fy_yr'      => $MaccYear,
					'emppaystructure' => $fetch_reocrd7,
					'p_tax'      => $fetch_reocrd8,
        );
        	

    		if ($fetch_reocrd &&  $fetch_reocrd1 && $fetch_reocrd3 && $fetch_reocrd4 && $fetch_reocrd5 && $fetch_reocrd6 && $fetch_reocrd7 && $fetch_reocrd8) {

    			$response_array['response'] = 'success';
	        
	        $response_array['data'] = $array1;
	        
	        $data = json_encode($response_array);

          print_r($data);
	           
        }else{

					$response_array['response'] = 'error';

          $response_array['data'] = '' ;
          
          $data = json_encode($response_array);

          print_r($data);
	      
	      }

	    }else{

	    	$response_array['response'] = 'error';

        $response_array['data'] = '' ;

        $response_array['data1'] = '' ;

        $data = json_encode($response_array);

        print_r($data);
            
	    }

    }

    public function document(Request $request){
                    
      $compName   = $request->session()->get('company_name');

    	$fisYear  =  $request->session()->get('macc_year');

    	$getcomcode    = explode('-', $compName);

			$comp_code = $getcomcode[0];

			$comp_name = $getcomcode[1];

			$comp_add = DB::table('MASTER_COMP')->where('COMP_CODE',$comp_code)->get()->first();

			$add1 = $comp_add->ADD1;

			$add2 = $comp_add->ADD2;

			$add3 = $comp_add->ADD3;

			$address = $add1 .' '.$add2.' '.$add3;

      $name = $request->name;$accNo = $request->accNo;
      $empcode = $request->empcode;
      $pfNum = $request->pfNum;
      $empDesig = $request->empDesig;
      $saNum = $request->saNum;
      $empDOJ = $request->empDOJ;
      $bankName = $request->bankName;
      $payPeriod = $request->payPeriod;
      $grade = $request->grade;
      $panNo = $request->panNo;
      $ifsc = $request->ifsc;
      $totalWorkDays = $request->totalWorkDays;
      $holiday = $request->holiday;
      $leaves = $request->leaves;
      $absent = $request->absent;
      $numWorkDay = $request->numWorkDay;
      $grossSal = $request->grossSal;
      $deduction = $request->deduction;
      $taxableIn = $request->taxableIn;
      $taxAmt = $request->taxAmt;
      $taxpaid = $request->taxpaid;
      $taxDueRefund = $request->taxDueRefund;
      $htmlTo = $request->htmlTo;
      $ctcAmt = $request->ctcAmt;
      $wageInEarning = $request->wageInEarning;
      $wageInEarningAmt = $request->wageInEarningAmt;
      $wageInDeduction = $request->wageInDeduction;
      $wageInDeducAmt = $request->wageInDeducAmt;
      $totalNp = $request->totalNp;
      $tlEarnAmt = $request->tlEarnAmt;
      $tlDeducAmt = $request->tlDeducAmt;
      $ptax =$request->ptax;
      $itax =$request->itax;
      $advOrLoanAmt =$request->advOrLoanAmt;
      $data = $request->name;
 
      $pdf = PDF::loadView('admin/finance/transaction/hrm/salarySlipPdf', compact('name','accNo','empcode','pfNum','empDesig','saNum','empDOJ','bankName','panNo','ifsc','totalWorkDays','holiday','leaves','absent','numWorkDay','comp_name','address','grossSal','deduction','taxableIn','taxAmt','taxpaid','taxDueRefund','htmlTo','ctcAmt','wageInEarning','wageInEarningAmt','wageInDeduction','wageInDeducAmt','totalNp','tlEarnAmt','tlDeducAmt','ptax','itax','advOrLoanAmt','grade','payPeriod'));
        
      $path = public_path('dist/downloadpdf'); 

      $fileName =  time().'.'. 'pdf' ; 

      $pdf->save($path . '/' . $fileName);

      $PublicPath = url('public/dist/downloadpdf/');  

      $downloadPdf = $PublicPath.'/'.$fileName;

       $response_array['response'] = 'success';
       $response_array['url'] = $downloadPdf;
       $response_array['data'] = $data;

      return $response_array;
		
    }

    public function EmpPaymentAdvice(Request $request){

		$CompanyCode   = $request->session()->get('company_name');
		
		$MaccYear      = $request->session()->get('macc_year');
		
		$getcomcode    = explode('-', $CompanyCode);
		
		$CCFromSession = $getcomcode[0];
		
		$title         = 'Employee Advance & Loan';
		
		$transData     = DB::table('MASTER_TRANSACTION')->where('TRAN_CODE','A8')->get()->first();
		
		$trans_list    = $transData->TRAN_CODE;
		
		$seriesData    = DB::table('MASTER_CONFIG')->where('TRAN_CODE','A8')->get()->toArray();
		
		$plantData     =  DB::table('MASTER_PLANT')->get();
		
		$accTypeData   =  DB::table('MASTER_ACC')->get();

    	return view('admin.finance.transaction.hrm.emp_payment_advice_trans',compact('title','trans_list','seriesData','plantData','accTypeData','transData'));

    }

    public function SaveEmpPaymentAdvice(Request $request){

		$compName    = $request->session()->get('company_name');
		
		$getcomcode  = explode('-', $compName);
		
		$comp_code   = $getcomcode[0];
		
		$comp_name   = $getcomcode[1];
		
		$fisYear     = $request->session()->get('macc_year');
		
		$createdBy   = $request->session()->get('userid');
		
		$vrDt        = $request->todayDate;
		
		$dt          = explode('-',$vrDt);
		
		$trans_code  = $request->transcode;
		
		$series_code = $request->series_code;

        $vrno = $request->vr_num;

		if($vrno == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrno;
		}

    	$vrno_Exist = DB::table('EMPPAYMENT_ADVICE_TRAN')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->where('VRNO',$vrNum)->get()->toArray();

        if($vrno_Exist){
      	  $NewVrno = $vrNum +1;
        }else{
          $NewVrno = $vrNum;
        }

		$month   = date("F", mktime(null, null, null, $dt[1], 1));

		$yr      = $dt[2];

		$mon_yr  = $month.' '.$yr;

		$vrno    = $request->vr_num;

		$vr_date = date('Y-m-d', strtotime($request->todayDate));
		
		$emi_amt = $request->emiAmount;

		$emiAmt  = 0;

        if($emi_amt != ''){

          $emiAmt = $request->emiAmount;

        }

		$tenure    = $request->tenure;

		$tenureVal = 0;

	    if($tenure != ''){

	       $tenureVal = $request->tenure;

	    }

	    $acc_code = $request->accCodId;
	    $new_drAmt = $request->dr_amt;

        $data = array(

	      'VR_DATE'     => $vr_date,
	      'MONTH_YR'    => $mon_yr,
	      'COMP_CODE'   => $comp_code,
	      'COMP_NAME'   => $comp_name,
	      'FY_CODE'     => $fisYear,
	      'TRAN_CODE'   => $trans_code,
	      'VRNO'        => $vrNum,
	      'SLNO'        => '1',
	      'SERIES_CODE' => $series_code,
	      'SERIES_NAME' => $request->seriesName,
	      'PLANT_CODE'  => $request->plantCode,
	      'PLANT_NAME'  => $request->plantName,
	      'PFCT_CODE'   => $request->profitcen_code,
	      'PFCT_NAME'   => $request->profitcenter_name,
	      'ACC_CODE'    => $request->accCodId,
	      'ACC_NAME'    => $request->acc_name,
	      'PAYMENT_TYPE'=> $request->pmt_type,
	      'DR_AMT'      => $request->dr_amt,
	      'EMI_AMOUNT'  => $emiAmt,
	      'TENURE'      => $tenureVal,
	      'FLAG'        => '0',
	      'CR_AMT'      => '0',
	      'CREATED_BY'  => $createdBy,
	      'UPDATED_BY'  => $createdBy,
    	);


    	$chkExit_data = DB::table('EMPPAYMENT_ADVICE_TRAN')->where('COMP_CODE',$comp_code)->where('ACC_CODE', $acc_code)->get()->first();

    	try{
        
        if($chkExit_data){
        	$dr_amt = $chkExit_data->DR_AMT;
            
           if($dr_amt > 0){
           	    $total_drAmt = $new_drAmt + $chkExit_data->DR_AMT;

	    		$data_update = array(
	    		  'DR_AMT'      => $total_drAmt,	
	    		  'UPDATED_BY'  => $createdBy,
	    		);

	    		$saveData = DB::table('EMPPAYMENT_ADVICE_TRAN')->where('COMP_CODE',$comp_code)->where('ACC_CODE',$acc_code)->update($data_update);

	    	}

        }else{



		    	$saveData = DB::table('EMPPAYMENT_ADVICE_TRAN')->insert($data);
			    $lastid   = DB::getPdo()->lastInsertId();

			    $bodyTblNm = 'EMPPAYMENT_ADVICE_TRAN';
				$apvTblNm  = 'EMPADVICE_TRAN_APPROVE';
				$bodyCol   = 'ID';
				$apvCol    = 'ADVICEAID';
				$headCol   = 'ADVICEHEADID';
				

				$this->approve_Trans($bodyTblNm,$bodyCol,$trans_code,$series_code,$apvTblNm,$comp_code,$comp_name,$fisYear,$NewVrno,$createdBy,$lastid,$apvCol,$headCol,$vr_date);

	    	    $checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->get()->toArray();

			    if(empty($checkvrnoExist)){
			        $datavrnIn =array(
			          'COMP_CODE'   =>$comp_code,
			          'FY_CODE'     =>$fisYear,
			          'TRAN_CODE'   =>$trans_code,
			          'SERIES_CODE' =>$series_code,
			          'FROM_NO'     =>1,
			          'TO_NO'       =>99999,
			          'LAST_NO'     =>$NewVrno,
			          'CREATED_BY'  =>$createdBy,
			        );

			        DB::table('MASTER_VRSEQ')->insert($datavrnIn);
			    }else{
			        
			        $datavrn =array(
			          'LAST_NO'=>$NewVrno
			        );

			        DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->update($datavrn);
			    }

			    $discriptn_page ='Payment Advice Trans';

			    $acc_code = '';

				$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);

				DB::commit();
				$response_array['response'] = 'success';
				$data = json_encode($response_array);
				print_r($data);

        }
        }catch (Exception $e) {

		    DB::rollBack();
		    $response_array['response'] = 'error';
	        $data = json_encode($response_array);
	        print_r($data);
		}


    	// try{

	    	// if($dr_amt > 0){

	    	// 	$data_update = array(
	    	// 	  'DR_AMT'      => $total_drAmt,	
	    	// 	  'UPDATED_BY'  => $createdBy,
	    	// 	);

	    	// 	$saveData = DB::table('EMPPAYMENT_ADVICE_TRAN')->update($data_update);

	    	// }else{

		    // }

		// }catch (Exception $e) {

		//     DB::rollBack();
		//     $response_array['response'] = 'error';
	 //        $data = json_encode($response_array);
	 //        print_r($data);
		// }
    
    }

    public function ViewEmpPaymentAdvice(Request $request){

    $compName = $request->session()->get('company_name');

	  if($request->ajax()){
      
      $title    = 'View Employee Payment Advice';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

			$getcomcode    = explode('-', $compName);
	    $comp_code = $getcomcode[0];

    	if($userType=='admin'){

    	// DB::enableQueryLog();

    	 $data = DB::table('EMPPAYMENT_ADVICE_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear);
    	// dd(DB::getQueryLog());

    	}else if ($userType=='superAdmin' || $userType=='user') {    		

    		 $data = DB::table('EMPPAYMENT_ADVICE_TRAN')->where('COMP_CODE', $comp_code)->where('FY_CODE',$fisYear)->orderBy('ID','DESC');

    	}
    	else{
    		$data ='';
    	}

     return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }

		if(isset($compName)){

	    	return view('admin.finance.transaction.hrm.view_emppayment_advice');

		}else{

		 return redirect('/useractivity');

	  }

    }

    public function DeletePaymentAdvice(Request $request){

		  $paymentAdviceId = $request->input('paymentAdviceId');

  	  $compName   = $request->session()->get('company_name');

  	  $fisYear  =  $request->session()->get('macc_year');

  	  $getcomcode    = explode('-', $compName);

		  $comp_code = $getcomcode[0];
      
      if ($paymentAdviceId!='') {
    		
    		try{

    		$Delete = DB::table('EMPPAYMENT_ADVICE_TRAN')->where('ID', $paymentAdviceId)->where('COMP_CODE',$comp_code)->delete();

			   if ($Delete) {

					$request->session()->flash('alert-success', 'Employee 
					Payment Advice Was Deleted Successfully...!');

					return redirect('/Transaction/PaymentAdvice/view-emp-payment-advice-transaction');

				}else{

					$request->session()->flash('alert-error', 'Employee Payment Advice Can Not Deleted...!');
					return redirect('/Transaction/PaymentAdvice/view-emp-payment-advice-transaction');

				}
		   }catch(Exception $ex){

			    $request->session()->flash('alert-error', 'Employee Attendance Can not be Deleted...! Used In Another Transaction...!');
					return redirect('/Transaction/PaymentAdvice/view-emp-payment-advice-transaction');
			  }

    	}else{

    		$request->session()->flash('alert-error', 'Zone  Not Found...!');
			return redirect('/Transaction/PaymentAdvice/view-emp-payment-advice-transaction');

    	}

	}

	public function EditEmpPaymentAdvice(Request $request,$acc_code){

  	$title = 'Edit Emp Payment Advice';

  	$compName   = $request->session()->get('company_name');

  	$fisYear  =  $request->session()->get('macc_year');

  	$getcomcode    = explode('-', $compName);

		$comp_code = $getcomcode[0];

  	$accCode = base64_decode($acc_code);

  	$seriesData = DB::table('MASTER_CONFIG')->where('TRAN_CODE','A8')->get()->toArray();
      
    $plantData =  DB::table('MASTER_PLANT')->get();
      
    $accTypeData =  DB::table('MASTER_ACC')->get();
    
    if($accCode!=''){

    	$data['paymentAdvice_list'] = DB::table('EMPPAYMENT_ADVICE_TRAN')->where('ACC_CODE', $accCode)->where('COMP_CODE',$comp_code)->get()->first();

    	return view('admin.finance.transaction.hrm.edit_emppayment_advice',$data+compact('title','seriesData','plantData','accTypeData'));

		}else{

			$request->session()->flash('alert-error', 'Employee Attendance Not Found...!');

			return redirect('/Transaction/PaymentAdvice/view-emp-payment-advice-transaction');
		}

  }

  public function UpdateEmpPaymentAdvice(Request $request){

    $compName 	= $request->session()->get('company_name');
	  
	  $getcomcode    = explode('-', $compName);

    $comp_code = $getcomcode[0];
    
    $comp_name = $getcomcode[1];

  	$fisYear 	= $request->session()->get('macc_year');

  	$createdBy 	= $request->session()->get('userid');

  	$paymentType = $request->pmt_type;
  	
  	$paymentId   = $request->paymentId;
  	
  	$acc_code    = $request->accCodId;

  	$emiAmt = 0;
  	
  	$tenure = 0;

  	if($paymentType == 'Loan'){
        
        $emiAmt = $request->emiAmount;
        $tenure = $request->tenure;
  	}

  	$trans_code = $request->transcode;
    $NewVrno         = $request->vr_num;
    $series_code     = $request->series_code;
    $discriptn_page  = 'Update Payment Advice Trans';
    $acc_code   = '';

  	// try{

  		$data = array(

      'COMP_CODE'   => $comp_code,
      'COMP_NAME'   => $comp_name,
      'FY_CODE'     =>$fisYear,
      'TRAN_CODE'   =>$request->transcode,
      'VRNO'       => $request->vr_num,
      'SERIES_CODE' => $request->series_code,
      'SERIES_NAME' => $request->seriesName,
      'PLANT_CODE'  => $request->plantCode,
      'PLANT_NAME'  => $request->plantName,
      'PFCT_CODE'   => $request->profitcen_code,
      'PFCT_NAME'   => $request->profitcenter_name,
      'ACC_CODE'    => $request->accCodId,
      'ACC_NAME'    => $request->acc_name,
      'PAYMENT_TYPE'=> $request->pmt_type,
      'DR_AMT'      => $request->dr_amount,
      'EMI_AMOUNT'  => $emiAmt,
      'TENURE'      => $tenure,
      'FLAG'        => '0',
      'CREATED_BY'  => $createdBy,
      'UPDATED_BY'  => $createdBy,

    );
	

    $saveData = DB::table('EMPPAYMENT_ADVICE_TRAN')->where('ID',$paymentId)->where('COMP_CODE',$comp_code)->update($data);

    	// $this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);

			// DB::commit();
     if($saveData){
      $response_array['response'] = 'success';
			$data = json_encode($response_array);
			print_r($data);
     }else{
      $response_array['response'] = 'error';
      $data = json_encode($response_array);
      print_r($data);
     }
			

		// }catch (Exception $e) {

		  // DB::rollBack();
		  
		// }

  }

  public function AddPaymentAdviceHead(Request $request){

		$compName    = $request->session()->get('company_name');

		$getcompcode = explode('-', $compName);
		$comp_code   =	$getcompcode[0];

		$fisYear     =  $request->session()->get('macc_year');

		$userId      = $request->session()->get('userid');

		$headId  = $request->input('headId');
		$user    = $request->input('userId');
		$vrno    = $request->input('vrno');
		$apprInd = $request->input('approveInd');
		$remark  = $request->input('remark');
		

		if($apprInd==''){

			$data1=array(
	    			'APPROVE_STATUS'=>'1',
	    			'APPROVE_REMARK'=>$remark,

	    );
	  }

	   $flagData = array(
	   	'FLAG' => '1');

     $statusLevel=array(
    			'APPROVE_STATUS'=> '3'
      );
      $status=array(
    			'APPROVE_STATUS'=> '1'
      );

    if ($user!='') {

			$checkData = DB::table('EMPADVICE_TRAN_APPROVE')->where('APPROVE_USER',$user)->where('ADVICEHEADID',$headId)->where('VRNO', $vrno)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->first();

			$level = $checkData->LEVEL_NO;
			$id    = $checkData->ADVICEHEADID;


      if($level){

			 $updateStatus = DB::table('EMPADVICE_TRAN_APPROVE')->where('APPROVE_USER',$user)->where('VRNO', $vrno)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($data1);

			 if($updateStatus){
			 	$updateFlag = DB::table('EMPPAYMENT_ADVICE_TRAN')->where('ID',$id)->update($flagData);
			 }
       
      // CHECK NEXT LEVEL

       $nextLevel = $level + 1;
       $chknextLevel = DB::table('EMPADVICE_TRAN_APPROVE')->where('LEVEL_NO',$nextLevel)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get();

       if($chknextLevel){
       	DB::table('EMPADVICE_TRAN_APPROVE')->where('LEVEL_NO',$nextLevel)->where('ADVICEHEADID',$headId)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($statusLevel);
       }
       
      }
		}

		if($updateStatus){

			return redirect('finance/user-approval-list/'.base64_encode($userId));
		}
		
	}

	public function RejectPaymentAdviceReq(Request $request){

			$compName    = $request->session()->get('company_name');

			$getcompcode = explode('-', $compName);
			$comp_code   =	$getcompcode[0];

			$fisYear     =  $request->session()->get('macc_year');

		  $tran_code     = $request->input('tran_code');
			$vrno          = $request->input('vrno');
			$reject_remark = $request->input('remark');
			$headId        = $request->input('headId');
			$userId        = $request->input('userId');

			$data =array(
	    			'APPROVE_REMARK'=>$reject_remark,
	    			'FLAG'=>'2',
	    			'REJECTED_STATUS'=>1,
	    			'APPROVE_STATUS'=>2,

	    );

	    $flatData=array('FLAG' => '2');

	    try{

				$Updatedata  = DB::table('EMPADVICE_TRAN_APPROVE')->where('TRAN_CODE',$tran_code)->where('VRNO',$vrno)->where('APPROVE_USER',$userId)->update($data);

				$UpdateFlag  = DB::table('EMPPAYMENT_ADVICE_TRAN')->where('TRAN_CODE',$tran_code)->where('VRNO',$vrno)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($flatData);

					DB::commit();

				$response_array['response'] = 'success';

				$data  = json_encode($response_array);

				print_r($data);

	    }catch (Exception $e) {
		    
		    DB::rollBack();
				
				$response_array['response'] = 'error';

        $data = json_encode($response_array);

        print_r($data);
		  }

    }

    public function ViewPaymentAdviceChildRow(Request $request){

    	$id = $request->input('tblid');
    	$vrno = $request->input('vrno');

    	if ($request->ajax()) {

	    	$data = DB::table('EMPADVICE_TRAN_APPROVE')->where('ADVICEHEADID',$id)->where('VRNO',$vrno)->get()->toArray();

	      $response_array = array();

	      if($data){

					$response_array['response'] = 'success';
					$response_array['data'] = $data;

					echo $data = json_encode($response_array);
	      
	      }else{

					$response_array['response'] = 'error';
	        
	        $response_array['data'] = '' ;

	        $data = json_encode($response_array);

	      }


	    }else{

	    		$response_array['response'] = 'error';
          $response_array['data'] = '' ;

          $data = json_encode($response_array);

          print_r($data);
	    }
    }

   public function JobOpening(Request $request){

      $CompanyCode   = $request->session()->get('company_name');

	    $MaccYear      = $request->session()->get('macc_year');

      $getcomcode    = explode('-', $CompanyCode);

	    $comp_code = $getcomcode[0];
	    
	    $comp_name = $getcomcode[1];

      $title = 'Job Opening Trans';

      $position_list = DB::table('MASTER_EMPPOSITION')->get();
      
      $dept_list = DB::table('MASTER_DEPT')->get();

      $jobOpen_date      = $request->old('jobOpen_date');
      $position_code     = $request->old('position_code');
      $position_name     = $request->old('position_name');
      $dept_code        = $request->old('dept_code');
      $dept_name        = $request->old('dept_name');
      $applDate          = $request->old('applDate');
      $applCloseDate     = $request->old('applCloseDate');
      $contactPerson     = $request->old('contactPerson');
      $noOfOpening       = $request->old('noOfOpening');
      $qualification       = $request->old('qualification');
      $sal_range         = $request->old('sal_range');
      $jobDescrption       = $request->old('jobDescrption');
      $jobType           = $request->old('jobType');
      $work_experience    = $request->old('work_experience');

      $button='Save';
    
      $action='/Transaction/JobOpening/save-job-opening';

      if($CompanyCode){

      	return view('admin.finance.transaction.hrm.add_job_opening_trans',compact('title','comp_code','comp_name','position_list','dept_list','button','action','jobOpen_date','position_code','position_name','dept_code','dept_name','applDate','applCloseDate','contactPerson','noOfOpening','qualification','sal_range','jobDescrption','jobType','work_experience'));

      }else{

		  return redirect('/useractivity');
	   }
     
      

   }

   public function SaveJobOpening(Request $request){
        
    $validate = $this->validate($request, [

			'jobOpen_date'    => 'required',
			'position_code' 			  => 'required',
			'dept_code' 		  => 'required',
			'applDate' 		    => 'required',
			'applCloseDate'   => 'required',
			'contactPerson'   => 'required',
			'noOfOpening'     => 'required',
			'qualification'   => 'required',
			'sal_range'       => 'required',
			
		]);

    
    $createdBy 	= $request->session()->get('userid');

    $compName   = $request->session()->get('company_name');
    
    $fisYear  =  $request->session()->get('macc_year');

    $getcomcode    = explode('-', $compName);
		
		$comp_code = $getcomcode[0];
		
		$comp_name = $getcomcode[1];

		$jobOpenDt = $request->input('jobOpen_date');
		$applDt = $request->input('applDate');
		$applCloseDt = $request->input('applCloseDate');

		$jobOpen_date = date("Y-m-d", strtotime($jobOpenDt));
		$applDate = date("Y-m-d", strtotime($applDt));
		$applCloseDate = date("Y-m-d", strtotime($applCloseDt));

		$checkPos_Code = $request->input('position_code');
		$chkStartChar =  substr($checkPos_Code, 0, 3);
		$data = DB::table('JOBOPEN_TRAN')->where('POSITION_CODE',$checkPos_Code)->get()->last();

		if($data == ''){
			$startNo = 101;
      $crJobId = $chkStartChar.'-'.$startNo;
		}else{
			$genCode = $data->JOBID;
			$getJobId = explode('-',$genCode);
			$getPosId = $getJobId[1];
			$getPosIdIncre = $getPosId + 1;
			$crJobId = $chkStartChar.'_'.$getPosIdIncre;

		}
		

		try{

	      $data = array(

        "COMP_CODE"        => $comp_code,
        "COMP_NAME"        => $comp_name,
        "FY_CODE"          => $fisYear,
				"JOBOPEN_DATE"     => $jobOpen_date,
				"POSITION_CODE"    => $request->input('position_code'),
				"POSITION_NAME"    => $request->input('position_name'),
				"DEPT_CODE"   		 => $request->input('dept_code'),
				"DEPT_NAME"   		 => $request->input('dept_name'),
				"APPL_DATE"   		 => $applDate,
				"APPL_CLOSEDATE" 	=> $applCloseDate,
				"CONTACT" 	      => $request->input('contactPerson'),
				"NO_OF_OPENING"   => $request->input('noOfOpening'),
				"QUALIFICATION"  	=> $request->input('qualification'),
				"SALARY_RANGE"    => $request->input('sal_range'),
				"JOB_TYPE"    		=> $request->input('jobType'),
				"JOB_DESCRIPTION" => $request->input('jobDescrption'),
				"WORK_EXPERIENCE"  => $request->input('work_experience'),
				"JOBID"  => $crJobId,
				"FLAG"        		 => '0',
				"JOBOPENING_BLOCK" => 'NO',
				"CREATED_BY"  		 => $createdBy,
				
				
			);
	      
   
			$saveData = DB::table('JOBOPEN_TRAN')->insert($data);
      

			  DB::commit();

			  $request->session()->flash('alert-success', 'Job Opening is Successfully Added...!');

				return redirect('/Transaction/JobOpening/view-job-opening-trans');

			}catch (Exception $e) {

		     DB::rollBack();
		    
		     $request->session()->flash('alert-error', 'Employee Attendance Can Not Added...!');
		   
				 return redirect('/Transaction/JobOpening/view-job-opening-trans');
		  }

	  

  }

  public function ViewJobOpening(Request $request){

	  $compName   = $request->session()->get('company_name');
	  $fisYear  =  $request->session()->get('macc_year');

	  $getcomcode    = explode('-', $compName);
		$comp_code = $getcomcode[0];

	  if($request->ajax()){
			
			$title    = 'View Job Opening Transaction';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

	    if($userType=='admin'){

	    	$data = DB::table('JOBOPEN_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('ID','DESC');

	    }else if($userType=='superAdmin' || $userType=='user') {    		

	    		$data = DB::table('JOBOPEN_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('ID','DESC');

	    }
	    else{
	    		$data ='';
	    }
			
			return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }

		if(isset($compName)){

	    	return view('admin.finance.transaction.hrm.view_job_opening_tran');

		}else{
		
		 return redirect('/useractivity');

	  }

  }

  public function DeleteJobOpening(Request $request){

	$jobId = $request->input('jobId');
	$compName   = $request->session()->get('company_name');
  $fisYear  =  $request->session()->get('macc_year');

  $getcomcode    = explode('-', $compName);
	
	$comp_code = $getcomcode[0];
    	

  if ($jobId!=''){

    try{

    	$Delete = DB::table('JOBOPEN_TRAN')->where('ID', $jobId)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->delete();

		  if($Delete){

				$request->session()->flash('alert-success', 'Job Opening is Deleted Successfully...!');

				return redirect('/Transaction/JobOpening/view-job-opening-trans');

			}else{

				$request->session()->flash('alert-error', 'Job Opening Can Not Deleted...!');
				return redirect('/Transaction/JobOpening/view-job-opening-trans');

			}
		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Job Opening Can not be Deleted...! Used In Another Transaction...!');
			return redirect('/Transaction/JobOpening/view-job-opening-trans');
		}

    }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
			return redirect('/Transaction/JobOpening/view-job-opening-trans');

    }

	}

	public function EditJobOpening(Request $request,$jobId){

  	$title = 'Edit Emp Attendance Master';

  	$jobId = base64_decode($jobId);

  	$compName   = $request->session()->get('company_name');
    
    $fisYear  =  $request->session()->get('macc_year');

    $getcomcode    = explode('-', $compName);
	  
	  $comp_code = $getcomcode[0];
    
    $data['position_list']    = DB::table('MASTER_EMPPOSITION')->get();
    $data['dept_list']    = DB::table('MASTER_DEPT')->get();

		  if($jobId!=''){

  	    $query = DB::table('JOBOPEN_TRAN');
				$query->where('ID', $jobId);
				$query->where('COMP_CODE', $comp_code);
				$query->where('FY_CODE', $fisYear);
				$classData= $query->get()->first();
      
      $jobOpen_date      = $classData->JOBOPEN_DATE;
      $comp_name         = $classData->COMP_NAME;
      $position_code     = $classData->POSITION_CODE;
      $position_name     = $classData->POSITION_NAME;
      $dept_code        = $classData->DEPT_CODE;
      $dept_name        = $classData->DEPT_NAME;
      $applDate          = $classData->APPL_DATE;
      $applCloseDate     = $classData->APPL_CLOSEDATE;
      $contactPerson     = $classData->CONTACT;
      $noOfOpening       = $classData->NO_OF_OPENING;
      $qualification       = $classData->QUALIFICATION;
      $sal_range         = $classData->SALARY_RANGE;
      $jobDescrption       = $classData->JOB_DESCRIPTION;
      $jobType           = $classData->JOB_TYPE;
      $work_experience    = $classData->WORK_EXPERIENCE;
      $jobOpen_Block    = $classData->JOBOPENING_BLOCK;
      $id    = $classData->ID;

      $button='Update';
    
      $action='/Transaction/JobOpening/form-job-opening-update';

      if($compName){

      	return view('admin.finance.transaction.hrm.add_job_opening_trans',$data+compact('title','comp_code','button','action','jobOpen_date','position_code','position_name','dept_code','dept_name','applDate','applCloseDate','contactPerson','noOfOpening','qualification','sal_range','jobDescrption','jobType','work_experience','jobOpen_Block','id','comp_name'));

      }else{

		  return redirect('/useractivity');
	   }

  }}

  public function UpdateJobOpening(Request $request){


		 $validate = $this->validate($request, [

			'jobOpen_date'    => 'required',
			'position_code' 			  => 'required',
			'dept_code' 		  => 'required',
			'applDate' 		    => 'required',
			'applCloseDate'   => 'required',
			'contactPerson'   => 'required',
			'noOfOpening'     => 'required',
			'qualification'   => 'required',
			'sal_range'       => 'required',
			
		]);

		$idJobId = $request->input('idJobOpen');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");
		
		$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

		$createdBy 	= $request->session()->get('userid');

    $fisYear  =  $request->session()->get('macc_year');

    $getcomcode    = explode('-', $compName);

		$comp_code = $getcomcode[0];
		
		$comp_name = $getcomcode[1];

		$comp_code = $getcomcode[0];
		
		$comp_name = $getcomcode[1];

		$jobOpenDt = $request->input('jobOpen_date');
		$applDt = $request->input('applDate');
		$applCloseDt = $request->input('applCloseDate');

		$jobOpen_date = date("Y-m-d", strtotime($jobOpenDt));
		$applDate = date("Y-m-d", strtotime($applDt));
		$applCloseDate = date("Y-m-d", strtotime($applCloseDt));

		try{

	      $data = array(

        "COMP_CODE"        => $comp_code,
        "COMP_NAME"        => $comp_name,
        "FY_CODE"          => $fisYear,
				"JOBOPEN_DATE"     => $jobOpen_date,
				"POSITION_CODE"    => $request->input('position_code'),
				"POSITION_NAME"    => $request->input('position_name'),
				"DEPT_CODE"   		 => $request->input('dept_code'),
				"DEPT_NAME"   		 => $request->input('dept_name'),
				"APPL_DATE"   		 => $applDate,
				"APPL_CLOSEDATE" 	=> $applCloseDate,
				"CONTACT" 	      => $request->input('contactPerson'),
				"NO_OF_OPENING"   => $request->input('noOfOpening'),
				"QUALIFICATION"  	=> $request->input('qualification'),
				"SALARY_RANGE"    => $request->input('sal_range'),
				"JOB_TYPE"    		=> $request->input('jobType'),
				"JOB_DESCRIPTION" => $request->input('jobDescrption'),
				"WORK_EXPERIENCE"  => $request->input('work_experience'),
				"FLAG"        		 => '0',
				"JOBOPENING_BLOCK" => $request->input('job_block'),
				"UPDATED_BY"  		 => $createdBy,
				
				
			);
	      
   
			$saveData = DB::table('JOBOPEN_TRAN')->where('ID',$idJobId)->update($data);
      

			  DB::commit();

			  $request->session()->flash('alert-success', 'Job Opening is Successfully Added...!');

				return redirect('/Transaction/JobOpening/view-job-opening-trans');

			}catch (Exception $e) {

		    DB::rollBack();

		     $request->session()->flash('alert-error', 'Job Opening Can Not Added...!');

				return redirect('/Transaction/JobOpening/view-job-opening-trans');
		    
		}

	}

	/*---Start Job Application Tran-----*/


	/*---Start Emp Interview Tran----*/

  public function EmpInterview(Request $request){

      $CompanyCode   = $request->session()->get('company_name');

	    $MaccYear      = $request->session()->get('macc_year');

      $getcomcode    = explode('-', $CompanyCode);

	    $comp_code = $getcomcode[0];
	    
	    $comp_name = $getcomcode[1];

      $title = 'Emp Interview Trans';

      $name    = $request->old('name');
      $interview_type    = $request->old('interview_type');
      $interview_by    = $request->old('interviewBy');
      $email    = $request->old('email');
      $education    = $request->old('education');
      $position    = $request->old('position');
      $location    = $request->old('location');
      $interview_date    = $request->old('interview_date');
      $applStatus    = $request->old('applStatus');
      $hr_remark    = $request->old('hr_remark');
      $managment_remark    = $request->old('managment_remark');
      $position_name    = $request->old('position_name');
      

      $position_list    = DB::table('MASTER_EMPPOSITION')->get();

      $button='Save';
    
      $action='/Transaction/EmpInterview/save-emp-interview';

      if($CompanyCode){

      	return view('admin.finance.transaction.hrm.add_emp_interview_trans',compact('title','interview_by','interview_date','applStatus','hr_remark','managment_remark','button','action','name','interview_type','email','education','location','position','position_list','position_name'));

      }else{

		  return redirect('/useractivity');
	   }
     
      

   }

   public function SaveEmpInterview(Request $request){
        
    $validate = $this->validate($request, [

			'interview_date'   => 'required',
			'name'             => 'required',
			'interview_type'   => 'required',
			'email'            => 'required',
			'education'        => 'required',
			'location'         => 'required',
			'position'         => 'required',
			'interview_by'     => 'required',
			'interview_date' 	 => 'required',
			'applStatus' 		   => 'required',
			'hr_remark' 		   => 'required',
			'managment_remark' => 'required'
			
		]);

    
    $createdBy 	= $request->session()->get('userid');

    $compName   = $request->session()->get('company_name');
    
    $fisYear  =  $request->session()->get('macc_year');

    $getcomcode    = explode('-', $compName);
		
		$comp_code = $getcomcode[0];
		
		$comp_name = $getcomcode[1];

		$interview_date = $request->input('interview_date');
		
		$interviewdt = date("Y-m-d", strtotime($interview_date));
		
		try{

	      $data = array(

        "COMP_CODE"        => $comp_code,
        "COMP_NAME"        => $comp_name,
        "FY_CODE"          => $fisYear,
				"INTERVIEW_BY"     => $request->input('interview_by'),
				"NAME"             => $request->input('name'),
				"INTERVIEW_TYPE"   => $request->input('interview_type'),
				"EMAIL"            => $request->input('email'),
				"EDUCATION"        => $request->input('education'),
				"LOCATION"         => $request->input('location'),
				"POSITION_CODE"    => $request->input('position'),
				"POSITION_NAME"    => $request->input('position_name'),
				"INTERVIEW_DATE"   => $interviewdt,
				"APPLICATION_STATUS" => $request->input('applStatus'),
				"HR_REMARK"          => $request->input('hr_remark'),
				"MANAGEMENT_REMARK"  => $request->input('managment_remark'),
				"FLAG"        		   => '0',
				"EMPINTERVIEW_BLOCK" => 'NO',
				"CREATED_BY"  		   => $createdBy,
				
			);
	      
      $saveData = DB::table('EMPINTERVIEW_TRAN')->insert($data);
      

		  DB::commit();

		  $request->session()->flash('alert-success', 'Emp Interview is Successfully Added...!');

			return redirect('/Transaction/EmpInterview/view-emp-interview-trans');

			}catch (Exception $e) {

		     DB::rollBack();
		    
		     $request->session()->flash('alert-error', 'Emp Interview Can Not Added...!');
		   
				 return redirect('/Transaction/EmpInterview/view-emp-interview-trans');
		  }

	  

  }

  public function ViewEmpInterview(Request $request){

	  $compName   = $request->session()->get('company_name');

	  $fisYear  =  $request->session()->get('macc_year');

	  $getcomcode    = explode('-', $compName);

		$comp_code = $getcomcode[0];

	  if($request->ajax()){
			
			$title    = 'View Emp Interview Transaction';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

	    if($userType=='admin'){

	    	$data = DB::table('EMPINTERVIEW_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('ID','DESC');

	    }else if($userType=='superAdmin' || $userType=='user') {    		

	    		$data = DB::table('EMPINTERVIEW_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('ID','DESC');

	    }
	    else{
	    		$data ='';
	    }
			
			return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }

		if(isset($compName)){

	    	return view('admin.finance.transaction.hrm.view_emp_interview_trans');

		}else{
		
		 return redirect('/useractivity');

	  }

  }

  public function DeleteEmpInterview(Request $request){

	$interviewId = $request->input('interviewId');
	$compName   = $request->session()->get('company_name');
  $fisYear  =  $request->session()->get('macc_year');

  $getcomcode    = explode('-', $compName);
	
	$comp_code = $getcomcode[0];
    	

  if ($interviewId!=''){

    try{

    	$Delete = DB::table('EMPINTERVIEW_TRAN')->where('ID', $interviewId)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->delete();

		  if($Delete){

				$request->session()->flash('alert-success', '
				Emp Interview is Deleted Successfully...!');

				return redirect('/Transaction/EmpInterview/view-emp-interview-trans');

			}else{

				$request->session()->flash('alert-error', 'Emp Interview Can Not Deleted...!');
				return redirect('/Transaction/EmpInterview/view-emp-interview-trans');

			}
		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Emp Interview Can not be Deleted...! Used In Another Transaction...!');
			return redirect('/Transaction/EmpInterview/view-emp-interview-trans');
		}

    }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
			return redirect('/Transaction/EmpInterview/view-emp-interview-trans');

    }

	}

	public function EditEmpInterview(Request $request,$interviewId){

  	$title = 'Edit Emp Attendance Master';

  	$interviewId = base64_decode($interviewId);

  	$compName   = $request->session()->get('company_name');
    
    $fisYear  =  $request->session()->get('macc_year');

    $getcomcode    = explode('-', $compName);
	  
	  $comp_code = $getcomcode[0];
    
    if($interviewId!=''){

	    $query = DB::table('EMPINTERVIEW_TRAN');
			$query->where('ID', $interviewId);
			$query->where('COMP_CODE', $comp_code);
			$query->where('FY_CODE', $fisYear);
			$classData= $query->get()->first();
      
      $interview_by      = $classData->INTERVIEW_BY;
      $interview_date    = $classData->INTERVIEW_DATE;
      $applStatus    = $classData->APPLICATION_STATUS;
      $hr_remark    = $classData->HR_REMARK;
      $managment_remark    = $classData->MANAGEMENT_REMARK;
      $empInterview_block   = $classData->EMPINTERVIEW_BLOCK;
      $id    = $classData->ID;
      $name   =  $classData->NAME;
      $interview_type = $classData->INTERVIEW_TYPE;  
      $email   = $classData->EMAIL;
      $education = $classData->EDUCATION;  
      $position  = $classData->POSITION_CODE; 
      $position_name  = $classData->POSITION_NAME;
      $location  = $classData->LOCATION;
     
      $position_list    = DB::table('MASTER_EMPPOSITION')->get();

      $button='Update';
    
      $action='/Transaction/EmpInterview/form-emp-interview-update';

      if($compName){

      	return view('admin.finance.transaction.hrm.add_emp_interview_trans',compact('title','comp_code','button','action','id','interview_by','interview_date','applStatus','hr_remark','managment_remark','empInterview_block','name','interview_type','email','education','position','position_name','location','position_list'));

      }else{

		  return redirect('/useractivity');
	   }

  }}

  public function UpdateEmpInterview(Request $request){

    $validate = $this->validate($request, [

			'interview_date'   => 'required',
			'name'             => 'required',
			'interview_type'   => 'required',
			'email'            => 'required',
			'education'        => 'required',
			'location'         => 'required',
			'position'         => 'required',
			'interview_by'     => 'required',
			'interview_date' 	 => 'required',
			'applStatus' 		   => 'required',
			'hr_remark' 		   => 'required',
			'managment_remark' => 'required'
			
		]);
		 
    $id = $request->input('idInterAppl');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");
		
		$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

	  $getcomcode    = explode('-', $compName);

		$comp_code = $getcomcode[0];
		
		$comp_name = $getcomcode[1];

		$interview_date = $request->input('interview_date');
		
		$interviewdt = date("Y-m-d", strtotime($interview_date));
		
		try{


	    $data = array(

        "COMP_CODE"        => $comp_code,
        "COMP_NAME"        => $comp_name,
        "FY_CODE"          => $fisYear,
				"INTERVIEW_BY"     => $request->input('interview_by'),
				"NAME"             => $request->input('name'),
				"INTERVIEW_TYPE"   => $request->input('interview_type'),
				"EMAIL"            => $request->input('email'),
				"EDUCATION"        => $request->input('education'),
				"LOCATION"         => $request->input('location'),
				"POSITION_CODE"    => $request->input('position'),
				"POSITION_NAME"    => $request->input('position_name'),
				"INTERVIEW_DATE"   => $interviewdt,
				"APPLICATION_STATUS" => $request->input('applStatus'),
				"HR_REMARK"          => $request->input('hr_remark'),
				"MANAGEMENT_REMARK"  => $request->input('managment_remark'),
				"FLAG"        		   => '0',
				"EMPINTERVIEW_BLOCK" => $request->input('empInterview_block'),
				"UPDATED_BY"  		   => $createdBy,
				
			);
	      
      $saveData = DB::table('EMPINTERVIEW_TRAN')->where('ID',$id)->update($data);
      

		  DB::commit();

		  $request->session()->flash('alert-success', 'Emp Interview is Updated Successfully...!');

			return redirect('/Transaction/EmpInterview/view-emp-interview-trans');

			}catch (Exception $e) {

		    DB::rollBack();

		     $request->session()->flash('alert-error', 'Emp Interview Can Not Added...!');

				return redirect('/Transaction/EmpInterview/view-emp-interview-trans');
		    
		}

	}

	/* ---End Emp Interview Tran---*/

	/*---Start Score Card -----*/
	public function AddScoreFunctionHead(Request $request){

    $compName    = $request->session()->get('company_name');

		$getcompcode = explode('-', $compName);
		$comp_code   =	$getcompcode[0];

    $fisYear =  $request->session()->get('macc_year');
		$userId      = $request->session()->get('userid');
		$scoreCardId = $request->input('scoreCardId');
		$taskslno    = $request->input('taskslno');
		$score       = $request->input('score');
		$remark      = $request->input('remark');
		$approve_ind = $request->input('approve_ind');

		if($userId && $approve_ind==''){

			$data1=array(
	    			'SELF_SCORE'=>$score,
	    			'SELF_REMARK'=>$remark,

	    );
	  }else if($userId && $approve_ind=='FH01'){
      
      $data1=array(
    			'FUNCTION_SCORE'=>$score,
    			'FUNCTION_REMARK'=>$remark,

      );
      $status=array(
    			'APPROVE_STATUS'=> '1'
      );
      // print_r('hello');
    }else if($userId && $approve_ind=='AH01'){
      
      $data1=array(
    			'ADMIN_SCORE'=>$score,
    			'ADMIN_REMARK'=>$remark,

    );
    }else{}

     $statusLevel=array(
    			'APPROVE_STATUS'=> '3'
      );
      $status=array(
    			'APPROVE_STATUS'=> '1'
      );

    if ($userId!='') {

			$checkData = DB::table('EMP_SCOREAPPROVE')->where('APPROVE_USER',$userId)->where('SCORECARDID',$scoreCardId)->where('SLNO',$taskslno)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->first();

			$level = $checkData->LEVEL_NO;

      if($level){

			 $updateScore = DB::table('EMP_SCORETASK')->where('SCORECARDID',$scoreCardId)->where('SLNO',$taskslno)->update($data1);
       
       $updateStatus = DB::table('EMP_SCOREAPPROVE')->where('APPROVE_USER',$userId)->where('SCORECARDID',$scoreCardId)->where('SLNO',$taskslno)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($status);

       // CHECK NEXT LEVEL

       $nextLevel = $level + 1;
       $chknextLevel = DB::table('EMP_SCOREAPPROVE')->where('LEVEL_NO',$nextLevel)->where('SCORECARDID',$scoreCardId)->where('SLNO',$taskslno)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get();

       if($chknextLevel){
       	DB::table('EMP_SCOREAPPROVE')->where('LEVEL_NO',$nextLevel)->where('SCORECARDID',$scoreCardId)->where('SLNO',$taskslno)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->update($statusLevel);
       }
       
      }
		}

		if($updateScore){

			return redirect('finance/user-approval-list/'.base64_encode($userId));
		}
		
	}

	public function AddScoreSelfHead(Request $request){

		$compName    = $request->session()->get('company_name');

		$getcompcode = explode('-', $compName);
		$comp_code   =	$getcompcode[0];

    $fisYear =  $request->session()->get('macc_year');
		$userId      = $request->session()->get('userid');
		$scoretaskId = $request->input('scoretaskId');
		$scorecardId = $request->input('scorecardId');
		$slno = $request->input('slno');
		$selfScore = $request->input('selfScore');
		$remark = $request->input('remark');

		if($userId){

			$data1=array(
	    			'SELF_SCORE'=>$selfScore,
	    			'SELF_REMARK'=>$remark,

	    );

	    $updateScore = DB::table('EMP_SCORETASK')->where('SCORETASKID',$scoretaskId)->where('SCORECARDID',$scorecardId)->where('SLNO',$slno)->update($data1);

	    if($updateScore){

				return redirect('finance/user-approval-list/'.base64_encode($userId));
			}

  	}
  }

	public function FindFunActivityDate(Request $request){

		$funActiName = $request->input('findDt');

		$dt = DB::table('TEMP_FUN_SCORECARD')->where('FUNCTION_ACTIVITY', $funActiName)->get();
		if($dt != ''){
      
      $response_array['response'] = 'success';
			$response_array['FuncDate'] = $dt;
			$data = json_encode($response_array);
			print_r($data);

		}else{

			$response_array['response'] = 'error';
			$data = json_encode($response_array);
			print_r($data);

		}
	}

	public function SaveFunActivity(Request $request){

		$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

	  $getcomcode    = explode('-', $compName);

		$comp_code = $getcomcode[0];
		
		$comp_name = $getcomcode[1];

		$funAct = $request->funActivity;
		$targetDt = $request->funTargetDt;
		$startDt = $request->funStartDt;
		$endDt = $request->funEndDt;
		$trCount = count($funAct);

		$deleteData = DB::table('TEMP_FUN_SCORECARD')->delete();

		try{

		for($i=0;$i<$trCount;$i++){

			 $tarDate = date("Y-m-d", strtotime($targetDt[$i]));
			 $startDate = date("Y-m-d", strtotime($startDt[$i]));
			 $endDate = date("Y-m-d", strtotime($endDt[$i]));

			 $data = array(

				"COMP_CODE"         => $comp_code,
				"COMP_NAME"         => $comp_name,
				"FY_YEAR"           => $fisYear,
				"FUNCTION_ACTIVITY" => $funAct[$i],
				"TARGET_DATE"       => $tarDate,
				"START_DATE"        => $startDate,
				"END_DATE"          => $endDate,
				"FLAG"              => '0',
				"CREATED_BY"        => $createdBy,
				
				
			);

			$savedata = DB::table('TEMP_FUN_SCORECARD')->insert($data);
		}
		  DB::commit();
			
			$funList = DB::table('TEMP_FUN_SCORECARD')->where('CREATED_BY',$createdBy)->get();

			$response_array['response'] = 'success';
			$response_array['funList'] = $funList;
			$data = json_encode($response_array);
			print_r($data);

	 }catch(Exception $e){

	 	  DB::rollBack();

	 	  $response_array['response'] = 'error';
			$data = json_encode($response_array);
			print_r($data);

	 }
	}

  public function ScoreCard(Request $request){

			$CompanyCode = $request->session()->get('company_name');

			$MaccYear    = $request->session()->get('macc_year');

			$getcomcode  = explode('-', $CompanyCode);

			$comp_code   = $getcomcode[0];
			
			$comp_name   = $getcomcode[1];

			$trandCode   = 'PA';

			$title       = 'Score Card Trans';
			$emp_list    = DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->get();

			$transCdData = DB::table('MASTER_TRANSACTION')->where('TRAN_CODE',$trandCode)->get()->first();

			$trans_list  = $transCdData->TRAN_CODE;

			$seriesData  = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$trandCode)->get()->toArray();
      
      if($CompanyCode){

      	return view('admin.finance.transaction.hrm.add_score_card',compact('title','emp_list','MaccYear','trans_list','seriesData'));

      }else{

		  return redirect('/useractivity');
	   }
     
   }
   
   /*---Start Emp Task Approve---*/

   public function EmpApprovalTask(Request $request,$userid){
   }

   /*---End Emp Task Approve*/
   /*---common approved function--*/

   public function approve_Trans($bodyTable,$bodyCol,$transCode,$seriesCode,$apvTable,$comp_code,$comp_name,$fisYear,$vr_no,$createdBy,$head_Id,$apvCol,$headCol,$vrDate){

   	// print_r($transCode);
   	// print_r($seriesCode);

      $getbody      = DB::table($bodyTable)->orderBy($bodyCol, 'DESC')->get()->first();
      $getvrnoCount = DB::table($bodyTable)->where('VRNO',$getbody->VRNO)->get()->toArray();
      
      $sl_no        =array();

			foreach ($getvrnoCount as $keyS){
			
			$sl_no[]      = $keyS->SLNO;
			}

			$vrnocount = count($getvrnoCount);

		  $getapprove =	DB::SELECT("SELECT t1.*,t2.* FROM MASTER_CONFIG_APPROVE t1  LEFT JOIN USER_APPROVE_IND t2 ON t2.APPROVE_USER = t1.APPROVE_IND WHERE t1.TRAN_CODE='$transCode' AND t1.SERIES_CODE='$seriesCode'");

		  // echo '<PRE>';print_r($getapprove);

      if($getapprove){

			$configapprove=array();
			$approveind=array();
			$userid=array();

			foreach ($getapprove as $key) {
			
				$configapprove[] =$key->TRAN_CODE;
				$approveind[]    =$key->APPROVE_IND;
				$userid[]        =$key->USER_CODE;
				$level_no[]      =$key->LAVEL_NAME;

			}

			// print_r($userid);exit();

			$countApv = count($configapprove);
			
			for ($s=0; $s < $countApv; $s++) {

				for ($b=0; $b < $vrnocount; $b++) { 

					$PApvH = DB::select("SELECT MAX($apvCol) as apvCol FROM $apvTable");
					$apvID = json_decode(json_encode($PApvH), true); 
				
					if(empty($apvID[0]['apvCol'])){
						$apv_Id = 1;
					}else{
						$apv_Id = $apvID[0]['apvCol']+1;
					}

					if($level_no[$s]==1){

						$approve_status=3;

						$data_approve = array(
								$headCol         =>$head_Id,
								$apvCol          =>$apv_Id,
								'COMP_CODE'      =>$comp_code,
								'COMP_NAME'      =>$comp_name,
								'FY_CODE'        =>$fisYear,
								'TRAN_CODE'      =>$transCode,
								'SERIES_CODE'    =>$seriesCode,
								'VRNO'           =>$vr_no,
								'SLNO'           =>$sl_no[$b],
								'VRDATE'         =>$vrDate,
								'APPROVE_IND'    =>$approveind[$s],
								'APPROVE_USER'   =>$userid[$s],
								'LEVEL_NO'       =>$level_no[$s],
								'APPROVE_STATUS' =>$approve_status,
								'APPROVE_REMARK' =>'',
								'APPROVE_DATE'   =>date('Y-m-d'),
								'FLAG'           =>'0',
								'LASTUSER'       =>'0',
								'CREATED_BY'     =>$createdBy,
								
						);
					
					}else{ 
						
						$countmain=$countApv-1;
							
						if($countmain==$s){

							$lastusr='3';
						}else{
							$lastusr='0';
						}

						$data_approve = array(
								$headCol         =>$head_Id,
								$apvCol          =>$apv_Id,
								'COMP_CODE'      =>$comp_code,
								'COMP_NAME'      =>$comp_name,
								'FY_CODE'        =>$fisYear,
								'TRAN_CODE'      =>$transCode,
								'SERIES_CODE'    =>$seriesCode,
								'VRNO'           =>$vr_no,
								'SLNO'           =>$sl_no[$b],
								'VRDATE'         =>$vrDate,
								'APPROVE_IND'    =>$approveind[$s],
								'APPROVE_USER'   =>$userid[$s],
								'LEVEL_NO'       =>$level_no[$s],
								'APPROVE_STATUS' =>0,
								'APPROVE_REMARK' =>'',
								'APPROVE_DATE'   =>date('Y-m-d'),
								'FLAG'           =>'',
								'LASTUSER'       =>$lastusr,
								'CREATED_BY'     =>$createdBy,
								
							);
					} /* /. LEVEL O IF*/

					$saveDataApv = DB::table($apvTable)->insert($data_approve);

				} /* /. B LOOP*/
			} /* /. S LOOP */

		}

	}

	/*-End Approved Function--*/

   public function SaveScoreCard(Request $request){
    
		$createdBy   = $request->session()->get('userid');

		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

		$getcomcode  = explode('-', $compName);
		
		$comp_code   = $getcomcode[0];
		$comp_name   = $getcomcode[1];

		$vr_date     = $request->input('vr_date');

		$vrDate      = date("Y-m-d", strtotime($vr_date));
		$vrno        = $request->input('vrno');
		$trans_code  = $request->input('t_code');
		$series_code = $request->input('seriesCode');
		
    if($vrno == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vrno;
		}

		$vrno_Exist = DB::table('EMP_SCORECARD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->where('VRNO',$vrNum)->get()->toArray();
   
		if($vrno_Exist){
			$NewVrno = $vrNum +1;
		}else{
			$NewVrno = $vrNum;
		}

		try{

		$data = array(

				"COMP_CODE"   => $comp_code,
				"COMP_NAME"   => $comp_name,
				"FY_CODE"     => $fisYear,
				"TRAN_CODE"   => $request->input('t_code'),
				"SERIES_CODE" => $request->input('seriesCode'),
				"SERIES_NAME" => $request->input('seriesName'),
				"VRNO"        => $NewVrno,
				"EMP_CODE"    => $request->input('emp_code'),
				"EMP_NAME"    => $request->input('emp_name'),
				"GRADE_CODE"  => $request->input('grade_code'),
				"GRADE_NAME"  => $request->input('grade_name'),
				"DESIG_CODE"  => $request->input('desig_code'),
				"DESIG_NAME"  => $request->input('desig_name'),
				"DEPT_CODE"   => $request->input('dept_code'),
				"DEPT_NAME"   => $request->input('dept_name'),
				"REMARKS"     => $request->input('remarks'),
				"FLAG"        => '0',
				"CREATED_BY"  => $createdBy,
				
		);

		$save           = DB::table('EMP_SCORECARD')->insert($data);
		$lastid         = DB::getPdo()->lastInsertId();

		$funAct         = $request->input('function');
		
		$scoreCardSlno  = $request->input('function');
		
		$scoreCardCount = count($scoreCardSlno);

		$target_dt      = $request->input('targetDt');
		$start_dt       = $request->input('startDt');
		$end_dt         = $request->input('EndDate'); 
		
		for ($i=0;$i < $scoreCardCount;$i++) {

			$slno       = $i + 1;

			$targetDate = date("Y-m-d", strtotime($target_dt[$i]));
			$startDate  = date("Y-m-d", strtotime($start_dt[$i]));
			$endDate    = date("Y-m-d", strtotime($end_dt[$i]));

			$data1 = array(

        "SCORECARDID"      => $lastid,
        "COMP_CODE"        => $comp_code,
        "COMP_NAME"        => $comp_name,
        "FY_CODE"          => $fisYear,
        "SLNO"             => $slno,
        "VRNO"             => $NewVrno,
        "FUN_ACTIVATE"     => $funAct[$i],
				"TARGET_DATE"   	 => $targetDate,
				"START_DATE"   		 => $startDate,
				"END_DATE"   		   => $endDate,
				"FLAG"        		 => '0',
				"CREATED_BY"  		 => $createdBy,
				
			);

			$save = DB::table('EMP_SCOREFUN')->insert($data1);
			$slno++;

    }

		$milestoneFun       = $request->input('milestoneFun');
		$milestone          = $request->input('milestone');
		$milestoneTask      = $request->input('milestoneTask');
		$milstoneWeightage  = $request->input('milstoneWeightage');
		$milstoneSuccRate   = $request->input('milstoneSuccRate');
		
		$milstoneScore      = $request->input('milstoneScore');

		$scoreCardMilestone = $request->input('milestoneFun');
		$milestoneCount     = count($scoreCardMilestone);

		$milstoneTargetDt   = $request->input('milstoneTargetDt');
		$milstoneStartDt    = $request->input('milstoneStartDt');
		$milstoneEndDate    = $request->input('milstoneEndDate');

		for ($j=0; $j< $milestoneCount;$j++) { 

			$slNo = $j+1;
			
			$miletargetDt = date("Y-m-d", strtotime($milstoneTargetDt[$j]));
			$milestartDt  = date("Y-m-d", strtotime($milstoneStartDt[$j]));
			$mileendDt    = date("Y-m-d", strtotime($milstoneEndDate[$j]));

			$getfunName   = $milestoneFun[$j];
			// DB::enableQueryLog();
			$funInfo      = DB::table('EMP_SCOREFUN')->where('FUN_ACTIVATE',$getfunName)->get();
			$funData      = json_decode(json_encode($funInfo), true);
			$funId        = $funData[0]['SCOREFUNID'];
			
			$data2 = array(
        
				"SCORECARDID"  => $lastid,
				"SCOREFUNID"   => $funId,
				"SLNO"         => $slNo,
				"VRNO"         => $NewVrno,
				"FUNCTION"     => $milestoneFun[$j],
				"MILESTONE"    => $milestone[$j],
				"TASK"         => $milestoneTask[$j],
				"WEIGHTAGE"    => $milstoneWeightage[$j],
				"TARGET_DATE"  => $miletargetDt,
				"START_DATE"   => $milestartDt,
				"END_DATE"     => $mileendDt,
				"FLAG"         => '0',
				"CREATED_BY"   => $createdBy,
				
			);

			 $save = DB::table('EMP_SCORETASK')->insert($data2);

			 $slNo++;

    }
      $bodyTblNm = 'EMP_SCORETASK';
			$apvTblNm  = 'EMP_SCOREAPPROVE';
			$bodyCol   = 'SCORETASKID';
			$apvCol    = 'SCORECARDAID';
			$headCol   = 'SCORECARDID';
			


			$this->approve_Trans($bodyTblNm,$bodyCol,$trans_code,$series_code,$apvTblNm,$comp_code,$comp_name,$fisYear,$NewVrno,$createdBy,$lastid,$apvCol,$headCol,$vrDate);

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->get()->toArray();

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$comp_code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);

			}else{
					$datavrn =array(
					'LAST_NO'=>$NewVrno
					);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$comp_code)->update($datavrn);
			}

    $deleteTemp = DB::table('TEMP_FUN_SCORECARD')->where('CREATED_BY',$createdBy)->delete();

     DB::commit();

		  $response_array['response'] = 'success';
	        
	    $data = json_encode($response_array);

	    print_r($data);

    }catch (Exception $e){

		    DB::rollBack();
		    
		    $response_array['response'] = 'Error';
           
         $data = json_encode($response_array);

        print_r($data);
   }

  }

  public function ViewScoreCard(Request $request){

	  $compName   = $request->session()->get('company_name');

	  $fisYear  =  $request->session()->get('macc_year');

	  $getcomcode    = explode('-', $compName);

		$comp_code = $getcomcode[0];

	  if($request->ajax()){
			
			$title    = 'View Score Card Transaction';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

	    if($userType=='admin'){

	    	$data = DB::table('EMP_SCORETASK')
	    	->leftJoin('EMP_SCORECARD', 'EMP_SCORETASK.SCORECARDID', '=', 'EMP_SCORECARD.SCORECARDID')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear);
	    
	    }else if($userType=='superAdmin' || $userType=='user') {    		

	    		$data = DB::table('EMP_SCORETASK')
	    	->leftJoin('EMP_SCORECARD', 'EMP_SCORETASK.SCORECARDID', '=', 'EMP_SCORECARD.SCORECARDID')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear);

	    }
	    else{
	    		$data ='';
	    }
			
			return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }

		if(isset($compName)){

	    	return view('admin.finance.transaction.hrm.view_score_card');

		}else{
		
		 return redirect('/useractivity');

	  }

  }

  public function DeleteScoreCard(Request $request){

	$scoreId    = $request->input('scoreId');
	$slnoId     = $request->input('slnoId');
	$compName   = $request->session()->get('company_name');
	$fisYear    =  $request->session()->get('macc_year');

	$getcomcode = explode('-', $compName);
	
	$comp_code = $getcomcode[0];
    	

  if ($scoreId!='' && $slnoId!=''){

    try{

      $delfun = DB::table('EMP_SCOREFUN')->where('SCORECARDID',$scoreId)->delete();
      
      $delTask = DB::table('EMP_SCORETASK')->where('SCORECARDID',$scoreId)->where('SLNO',$slnoId)->delete();
      
      $delApprove = DB::table('EMP_SCOREAPPROVE')->where('SCORECARDID',$scoreId)->where('SLNO',$slnoId)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->delete();
     

      $chkScoreTask = DB::table('EMP_SCORETASK')->where('SCORECARDID',$scoreId)->get();

      if($chkScoreTask==''){
        	$Delete = DB::table('EMP_SCORECARD')->where('SCORECARDID', $scoreId)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->delete();
      }

      if($delfun && $delTask && $chkScoreTask){

				$request->session()->flash('alert-success', '
				Score Card is Deleted Successfully...!');

				return redirect('/Transaction/ScoreCard/view-score-card-trans');

			}else{

				$request->session()->flash('alert-error', 'Score Card Can Not Deleted...!');
				return redirect('/Transaction/ScoreCard/view-score-card-trans');

			}
		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Score Card Can not be Deleted...! Used In Another Transaction...!');
			return redirect('/Transaction/ScoreCard/view-score-card-trans');
		}

    }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
			return redirect('/Transaction/ScoreCard/view-score-card-trans');

    }

	}

	public function EditScoreCard(Request $request,$scoreId){

  	$title = 'Edit Score Card Master';

  	$scoreId = base64_decode($scoreId);

  	$compName   = $request->session()->get('company_name');
    
    $fisYear  =  $request->session()->get('macc_year');

    $getcomcode    = explode('-', $compName);
	  
	  $comp_code = $getcomcode[0];

	  if($scoreId!=''){

	    $getData = DB::table('EMP_SCORECARD')->where('SCORECARDID',$scoreId)->get()->first();
     
      $getFunData = DB::table('EMP_SCOREFUN')->where('SCORECARDID',$scoreId)->get()->toArray();

      $getTask = DB::table('EMP_SCORETASK')->where('SCORECARDID',$scoreId)->get()->toArray();

      if($compName){

      	return view('admin.finance.transaction.hrm.edit_score_card',compact('title','getData','getFunData','getTask','fisYear'));

      }else{

		  return redirect('/useractivity');
	   }

  }
}

  public function UpdateScoreCard(Request $request){
   
   $createdBy   = $request->session()->get('userid');

		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

		$getcomcode  = explode('-', $compName);
		
		$comp_code   = $getcomcode[0];
		$comp_name   = $getcomcode[1];

		$scoreId     = $request->input('scoreCardId');
		$vr_date     = $request->input('vr_date');

		$vrDate      = date("Y-m-d", strtotime($vr_date));
		$vrno        = $request->input('vrno');
		$trans_code  = $request->input('t_code');
		$series_code = $request->input('seriesCode');
		
   

		try{

		$data = array(

				"COMP_CODE"   => $comp_code,
				"COMP_NAME"   => $comp_name,
				"FY_CODE"     => $fisYear,
				"TRAN_CODE"   => $request->input('t_code'),
				"SERIES_CODE" => $request->input('seriesCode'),
				"SERIES_NAME" => $request->input('seriesName'),
				"VRNO"        => $request->input('vrno'),
				"EMP_CODE"    => $request->input('emp_code'),
				"EMP_NAME"    => $request->input('emp_name'),
				"GRADE_CODE"  => $request->input('grade_code'),
				"GRADE_NAME"  => $request->input('grade_name'),
				"DESIG_CODE"  => $request->input('desig_code'),
				"DESIG_NAME"  => $request->input('desig_name'),
				"DEPT_CODE"   => $request->input('dept_code'),
				"DEPT_NAME"   => $request->input('dept_name'),
				"REMARKS"     => $request->input('remarks'),
				"FLAG"        => '0',
				"CREATED_BY"  => $createdBy,
				
		);

		$save           = DB::table('EMP_SCORECARD')->where('SCORECARDID',$scoreId)->update($data);

		$funAct         = $request->input('function');
		$funActslno     = $request->input('Slno');
		
		$scoreCardSlno  = $request->input('function');
		
		$scoreCardCount = count($scoreCardSlno);

		$target_dt      = $request->input('targetDt');
		$start_dt       = $request->input('startDt');
		$end_dt         = $request->input('EndDate'); 
		
		for ($i=0;$i < $scoreCardCount;$i++) {

			$targetDate = date("Y-m-d", strtotime($target_dt[$i]));
			$startDate  = date("Y-m-d", strtotime($start_dt[$i]));
			$endDate    = date("Y-m-d", strtotime($end_dt[$i]));

			$data1 = array(

        "SCORECARDID"      => $scoreId,
        "COMP_CODE"        => $comp_code,
        "COMP_NAME"        => $comp_name,
        "FY_CODE"          => $fisYear,
        "SLNO"             => $funActslno[$i],
        "VRNO"             => $request->input('vrno'),
        "FUN_ACTIVATE"     => $funAct[$i],
				"TARGET_DATE"   	 => $targetDate,
				"START_DATE"   		 => $startDate,
				"END_DATE"   		   => $endDate,
				"FLAG"        		 => '0',
				"CREATED_BY"  		 => $createdBy,
				
			);

			$save = DB::table('EMP_SCOREFUN')->where('SCORECARDID',$scoreId)->where('SLNO',$funActslno[$i])->update($data1);
		

    }

		$milestoneFun       = $request->input('milestoneFun');
		$milestone          = $request->input('milestone');
		$milestoneTask      = $request->input('milestoneTask');
		$milstoneWeightage  = $request->input('milstoneWeightage');
		$milstoneScore      = $request->input('milstoneScore');
		$milstoneSlno       = $request->input('milstoneSlno');

		$scoreCardMilestone = $request->input('milestoneFun');
		$milestoneCount     = count($scoreCardMilestone);

		$milstoneTargetDt   = $request->input('milstoneTargetDt');
		$milstoneStartDt    = $request->input('milstoneStartDt');
		$milstoneEndDate    = $request->input('milstoneEndDate');

		for ($j=0; $j< $milestoneCount;$j++) { 

			$miletargetDt = date("Y-m-d", strtotime($milstoneTargetDt[$j]));
			$milestartDt  = date("Y-m-d", strtotime($milstoneStartDt[$j]));
			$mileendDt    = date("Y-m-d", strtotime($milstoneEndDate[$j]));

			$getfunName   = $milestoneFun[$j];
			// DB::enableQueryLog();
			$funInfo      = DB::table('EMP_SCOREFUN')->where('FUN_ACTIVATE',$getfunName)->get();
			$funData      = json_decode(json_encode($funInfo), true);
			$funId        = $funData[0]['SCOREFUNID'];
			
			$data2 = array(
        
				"SCORECARDID"  => $scoreId,
				"SCOREFUNID"   => $funId,
				"SLNO"         => $milstoneSlno[$j],
				"VRNO"         => $request->input('vrno'),
				"FUNCTION"     => $milestoneFun[$j],
				"MILESTONE"    => $milestone[$j],
				"TASK"         => $milestoneTask[$j],
				"WEIGHTAGE"    => $milstoneWeightage[$j],
				"TARGET_DATE"  => $miletargetDt,
				"START_DATE"   => $milestartDt,
				"END_DATE"     => $mileendDt,
				"FLAG"         => '0',
				"CREATED_BY"   => $createdBy,
				
			);

			 $save = DB::table('EMP_SCORETASK')->where('SCORECARDID',$scoreId)->where('SLNO',$milstoneSlno[$j])->update($data2);

			

    }
      $bodyTblNm = 'EMP_SCORETASK';
			$apvTblNm  = 'EMP_SCOREAPPROVE';
			$bodyCol   = 'SCORETASKID';
			$apvCol    = 'SCORECARDAID';
			$headCol   = 'SCORECARDID';
			

		 DB::commit();

		  $response_array['response'] = 'success';
	        
	    $data = json_encode($response_array);

	    print_r($data);

    }catch (Exception $e){

		    DB::rollBack();
		    
		    $response_array['response'] = 'Error';
           
         $data = json_encode($response_array);

        print_r($data);
   }


	}

	/*---End Score Card -------*/

  public function JobApplication(Request $request){

			$CompanyCode   = $request->session()->get('company_name');

			$MaccYear      = $request->session()->get('macc_year');

			$getcomcode    = explode('-', $CompanyCode);

			$comp_code     = $getcomcode[0];
			
			$comp_name     = $getcomcode[1];

			$title         = 'Job Application Trans';

			$position_list = DB::table('MASTER_EMPPOSITION')->get();
			
			$dept_list     = DB::table('MASTER_DEPT')->get();
			$emp_list      = DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->get();
			
			$jobOpen_list  = DB::table('JOBOPEN_TRAN')->get();

      if($CompanyCode){

      	return view('admin.finance.transaction.hrm.add_job_application_trans',compact('title','jobOpen_list','emp_list'));

      }else{

		  return redirect('/useractivity');
	   }
  
  }

  public function FindJobPosition(Request $request){

   	 $response_array = array();

       if ($request->ajax()) {
			
					$pos_code = $request->pos_id;
					$jobId    = $request->jobId;
					
					$fetch_reocrd = DB::table('JOBOPEN_TRAN')->where('JOBID',$jobId)->where('POSITION_CODE',$pos_code)->get();

					if ($fetch_reocrd!='') {

					$response_array['response'] = 'success';

					$response_array['data']     = $fetch_reocrd;
					
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

  public function EmpInfo(Request $request){

   	 $response_array = array();

       if ($request->ajax()) {
			
				$emp_code     = $request->emp_code;
				
				$fetch_reocrd = DB::table('MASTER_EMP')->where('EMP_CODE',$emp_code)->get();

        if ($fetch_reocrd!='') {

					$response_array['response']    = 'success';

					$response_array['data']        = $fetch_reocrd;
					
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

   public function TravelInformation(Request $request){

   	 $response_array = array();

       if ($request->ajax()) {
			
				$emp_code      = $request->emp_code;
				
				$fetch_reocrd  = DB::table('MASTER_EMP')->where('EMP_CODE',$emp_code)->get()->first();

				$emp_grade     = $fetch_reocrd->GRADE_CODE;

				$transportData = DB::table('MASTER_MODEOFTRANSPORT')->where('GRADE_CODE', $emp_grade)->get();

				$hotelData     = DB::table('MASTER_HOTEL')->where('GRADE_CODE', $emp_grade)->get();


        $array1 = array(

					'info'          => $fetch_reocrd,
					'transportData' => $transportData,
					'hotelData'     => $hotelData,

        );

        if ($fetch_reocrd!='') {

					$response_array['response']    = 'success';

					$response_array['data']        = $array1;
					
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

  public function SaveJobApplication(Request $request){

		$createdBy     = $request->session()->get('userid');

		$compName      = $request->session()->get('company_name');
		
		$fisYear       =  $request->session()->get('macc_year');

		$getcomcode    = explode('-', $compName);
		
		$comp_code     = $getcomcode[0];
		
		$comp_name     = $getcomcode[1];

		$jobApplDt     = $request->input('todayDt');

		$jobAppFromlDt = $request->input('fromDate');
		
		$jobAppl_date  = date("Y-m-d", strtotime($jobApplDt));

    $jobApplFrom_dt = date("Y-m-d", strtotime($jobAppFromlDt));

		$panNo = $request->input('pan_no');
		$moNo = $request->input('mobile_no');
		
		$chkData = DB::table('JOBAPPL_HEAD')->where('PAN_NO',$panNo)->where('MOBILE_NO', $moNo)->get();
		$crossChk = count($chkData);

		if($crossChk == 0){

			try{

			  $educationData = $request->input('eduSlno');
			  $countslno = count($educationData);
			  
			  $data = array(

        "COMP_CODE"        => $comp_code,
        "COMP_NAME"        => $comp_name,
        "FY_CODE"          => $fisYear,
				"JOBAPPLICATION_DATE" => $jobAppl_date ,
				"JOBOPENING_NO"    => $request->input('jobOpeningNo'),
				"EMP_CODE"         => $request->input('emp_code'),
				"EMP_NAME"         => $request->input('emp_name'),
				"ADDRESS"   	  	 => $request->input('address'),
				"PAN_NO"   		     => $request->input('pan_no'),
				"ADHAR_NO"   	  	 =>$request->input('adhar_no'),
				"MOBILE_NO" 	     => $request->input('mobile_no'),
				"POSITION_CODE" 	 => $request->input('position_code'),
				"POSITION_NAME" 	 => $request->input('pos_name'),
				"SALARY"           => $request->input('salary'),
				"JOBTYPE"          => $request->input('jobType'),
				"NOTICE_PERIOD"    => $request->input('notice_period'),
				"COMPANY_NAME"     => $request->input('compName'),
				"DESIGNATION"      => $request->input('designation'),
				"DEPARTMENT"       => $request->input('department'),
				"FROM_DATE"        => $jobApplFrom_dt,
				"FLAG"        		 => '0',
				"JOBAPPL_BLOCK"    => 'NO',
				"CREATED_BY"  		 => $createdBy,
				
			);
			  

    	$savedata = DB::table('JOBAPPL_HEAD')->insert($data);
			  

    	$lastid= DB::getPdo()->lastInsertId();

    	for ($i=0; $i < $countslno; $i++) { 

				$courseName     = $request->input('courseName');

				$universityName = $request->input('universityName');

				$passYr         = $request->input('passYr');

				$percen         = $request->input('percen');
        
        $data1 = array(

             "COMP_CODE"   =>  $comp_code,
             "COMP_NAME"   =>  $comp_name,
             "FY_YEAR"     =>  $fisYear,
             "JOBAPPLTRAN_ID"   =>  $lastid,
             "COURSE_NAME"      =>  $courseName[$i],
             "UNIVERSITY_NAME"  =>  $universityName[$i],
             "PASSING_YEAR"     =>  $passYr[$i],
             "PERCENTAGE"       =>  $percen[$i],
             "FLAG"             =>  '0',
             "CREATED_BY"       =>  $createdBy,
        );

        $saveData1 = DB::table('JOBAPP_BODY')->insert($data1);

    	}
    	
    	  DB::commit();

			  $response_array['response'] = 'success';
            
        // $response_array['head_data'] = $headdata;
            
        $data = json_encode($response_array);

        print_r($data);
 

			}catch (Exception $e) {

		    DB::rollBack();
		    
		    $response_array['response'] = 'Error';
           
         // $response_array['data'] = $headdata;
            
        $data = json_encode($response_array);

        print_r($data);
		  }

		}else{

			  $response_array['response'] = 'Error';
           
        //$response_array['data'] = $headdata;
            
        $data = json_encode($response_array);

        print_r($data);
		}

	}

  public function ViewJobApplication(Request $request){


	  $compName   = $request->session()->get('company_name');

	  $fisYear  =  $request->session()->get('macc_year');

	  $getcomcode    = explode('-', $compName);

		$comp_code = $getcomcode[0];

	  if($request->ajax()){
			
			$title    = 'View Job Application Transaction';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

	    if($userType=='admin'){

	    	$data = DB::table('JOBAPPL_HEAD')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('ID','DESC');
	    	
	    

	    }else if($userType=='superAdmin' || $userType=='user') {   

	      	$data = DB::table('JOBAPPL_HEAD')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('ID','DESC');
	      	
      }
	    else{
	    		$data ='';
	    }
			
			return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }

		if(isset($compName)){

	    	return view('admin.finance.transaction.hrm.view_job_application_tran');

		}else{
		
		 return redirect('/useractivity');

	  }

  }

  public function DeleteJobApplication(Request $request){

	$jobApplId  = $request->input('jobApplId');

	$compName   = $request->session()->get('company_name');

	$fisYear    =  $request->session()->get('macc_year');

	$getcomcode = explode('-', $compName);
	
	$comp_code  = $getcomcode[0];
    	
  if ($jobApplId!=''){

  	  try{

    	$Delete = DB::table('JOBAPP_BODY')->where('JOBAPPLTRAN_ID', $jobApplId)->where('COMP_CODE',$comp_code)->where('FY_YEAR',$fisYear)->delete();

    	$Delete1 = DB::table('JOBAPPL_HEAD')->where('ID', $jobApplId)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->delete();

		  if($Delete && $Delete1){

				$request->session()->flash('alert-success', 'Job Application is Deleted Successfully...!');

				return redirect('/Transaction/JobApplication/view-job-application-trans');

			}else{

				$request->session()->flash('alert-error', 'Job Application Can Not Deleted...!');
				return redirect('/Transaction/JobApplication/view-job-application-trans');

			}

		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Job Application Can not be Deleted...! Used In Another Transaction...!');
			return redirect('/Transaction/JobApplication/view-job-application-trans');
		}

    }else{
    	
    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
			return redirect('/Transaction/JobApplication/view-job-application-trans');

    }

	}

	public function EditJobApplication(Request $request,$jobApplId){

		$title      = 'Edit Job Application Master';

		$jobApplId  = base64_decode($jobApplId);

		$compName   = $request->session()->get('company_name');
		
		$fisYear    =  $request->session()->get('macc_year');

		$getcomcode = explode('-', $compName);
		
		$comp_code  = $getcomcode[0];
    
    $data['position_list'] = DB::table('MASTER_EMPPOSITION')->get();
      
    $data['dept_list'] = DB::table('MASTER_DEPT')->get();
      
    $data['jobOpen_list'] = DB::table('JOBOPEN_TRAN')->get();
    
    $data['emp_list'] = DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->get();
      
		if($jobApplId!=''){

  	    $query = DB::table('JOBAPPL_HEAD');
				$query->where('ID', $jobApplId);
				$query->where('COMP_CODE', $comp_code);
				$query->where('FY_CODE', $fisYear);
				$classData= $query->get()->first();

				$educationData = DB::table('JOBAPP_BODY')->where('JOBAPPLTRAN_ID',$jobApplId)->get();
      
       if($compName){

      	return view('admin.finance.transaction.hrm.edit_job_application_trans',$data+compact('title','classData','educationData'));

      }else{

		  return redirect('/useractivity');
	   }

   }
  }

  public function UpdateJobApplication(Request $request){

		$createdBy  = $request->session()->get('userid');

		$compName   = $request->session()->get('company_name');
		
		$fisYear    =  $request->session()->get('macc_year');

		$getcomcode = explode('-', $compName);
		
		$comp_code  = $getcomcode[0];
		
		$comp_name  = $getcomcode[1];

		$id         = $request->input('jobApplID');

		$jobApplDt  = $request->input('todayDt');

		$jobAppFromlDt  = $request->input('fromDate');
		
		$jobAppl_date   = date("Y-m-d", strtotime($jobApplDt));


		$jobApplFrom_dt = date("Y-m-d", strtotime($jobAppFromlDt));

		try{

			  $educationData = $request->input('eduSlno');
			  $countslno = count($educationData);

			  $data = array(

        "COMP_CODE"        => $comp_code,
        "COMP_NAME"        => $comp_name,
        "FY_CODE"          => $fisYear,
				"JOBAPPLICATION_DATE" => $jobAppl_date ,
				"JOBOPENING_NO"    => $request->input('jobOpeningNo'),
				"EMP_CODE"         => $request->input('emp_code'),
				"EMP_NAME"         => $request->input('emp_name'),
				"ADDRESS"   	  	 => $request->input('address'),
				"PAN_NO"   		     => $request->input('pan_no'),
				"ADHAR_NO"   	  	 =>$request->input('adhar_no'),
				"MOBILE_NO" 	     => $request->input('mobile_no'),
				"POSITION_CODE" 	 => $request->input('position_code'),
				"POSITION_NAME" 	 => $request->input('pos_name'),
				"SALARY"           => $request->input('salary'),
				"JOBTYPE"          => $request->input('jobType'),
				"NOTICE_PERIOD"    => $request->input('notice_period'),
				"COMPANY_NAME"     => $request->input('compName'),
				"DESIGNATION"      => $request->input('designation'),
				"DEPARTMENT"       => $request->input('department'),
				"FROM_DATE"        => $jobApplFrom_dt,
				"FLAG"        		 => '0',
				"JOBAPPL_BLOCK"    => 'NO',
				"CREATED_BY"  		 => $createdBy,
				
			);


    	$savedata = DB::table('JOBAPPL_HEAD')->where('ID',$id)->update($data);

    	$delete = DB::table('JOBAPP_BODY')->where('JOBAPPLTRAN_ID', $id)->delete();

    	$lastid= DB::getPdo()->lastInsertId();

    	for ($i=0; $i < $countslno; $i++) { 

				$courseName     = $request->input('courseName');

				$universityName = $request->input('universityName');

				$passYr         = $request->input('passYr');

				$percen         = $request->input('percen');
        
        $data1 = array(

             "COMP_CODE"   =>  $comp_code,
             "COMP_NAME"   =>  $comp_name,
             "FY_YEAR"     =>  $fisYear,
             "JOBAPPLTRAN_ID"   =>  $id,
             "COURSE_NAME"      =>  $courseName[$i],
             "UNIVERSITY_NAME"  =>  $universityName[$i],
             "PASSING_YEAR"     =>  $passYr[$i],
             "PERCENTAGE"       =>  $percen[$i],
             "FLAG"             =>  '0',
             "CREATED_BY"       =>  $createdBy,
        );

        $saveData1 = DB::table('JOBAPP_BODY')->insert($data1);

    	}
    	
    	  DB::commit();

			  $response_array['response'] = 'success';
            
        $data = json_encode($response_array);

        print_r($data);
 

			}catch (Exception $e) {

		    DB::rollBack();
		    
		    $response_array['response'] = 'Error';
           
        $data = json_encode($response_array);

        print_r($data);
		  }
		
} 

	/*----End Job Application Tran---*/  


   
  function userLogInsert($loginuserId,$transCode,$seriesCode,$vrno,$perticular,$acc_code){
		
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
				'TRAN_CODE'   =>$transCode,
				'SERIES_CODE' =>$seriesCode,
				'ACC_CODE'    =>$acc_code,
				'VRNO'        =>$vrno,
				'PERTICULAR'  =>$discptn,
				'CREATED_BY'  =>$loginuserId
			);
			DB::table('USER_LOG')->insert($userLog);
		
	}








}

?>