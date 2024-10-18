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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PurchaseExport;
use App\Exports\ContractExport;

class EmployeeMasterController extends Controller{

	//public $data;

	public function __construct(Request $request){

		//$this->data = "smit@121";

	}


public function AddEmployee(Request $request){

   $title = 'Add Emplyee Master';

	$compName = $request->session()->get('company_name');

	// print_r($compName);exit();

   $getcomcode    = explode('-', $compName);

   $comp_code = $getcomcode[0];
   $comp_name = $getcomcode[1];

   $data['dept_list']   = DB::table('MASTER_DEPT')->get();

   $data['comp_list']   = DB::table('MASTER_COMP')->get();

   $data['plant_list']  = DB::table('MASTER_PLANT')->get();

   $data['profit_list'] = DB::table('MASTER_PFCT')->get();

   $data['cost_list']   = DB::table('MASTER_COST')->get();

   $data['emp_list']    = DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->get();

   $data['designation_list']    = DB::table('MASTER_DESIG')->get();

   $data['grade_list']  = DB::table('MASTER_GRADE')->get();

   $data['state_list']  = DB::table('MASTER_STATE')->get();

   $data['help_acc_type_list'] = DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->Orderby('EMP_CODE', 'desc')->limit(5)->get();

   $data['accTypeData'] =  DB::table('MASTER_ACC')->get();
    if($compName){
       return view('admin.finance.master.employee.add_employee',$data+compact('title','comp_code','comp_name'));
	
    }else{
	  return redirect('/useractivity');
    }
 	
}

public function EditEmployee(Request $request, $EmpCode){
        
   $title = 'Edit Emplyee Master';

   $compName = $request->session()->get('company_name');

   $getcomcode    = explode('-', $compName);

   $comp_code = $getcomcode[0];
   $comp_name = $getcomcode[1];

	$data['dept_list']   = DB::table('MASTER_DEPT')->get();

	$data['comp_list']   = DB::table('MASTER_COMP')->get();

	$data['plant_list']  = DB::table('MASTER_PLANT')->get();

	$data['profit_list'] = DB::table('MASTER_PFCT')->get();

	$data['cost_list']   = DB::table('MASTER_COST')->get();

	$data['emp_list']    = DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->get();

	$data['designation_list']    = DB::table('MASTER_DESIG')->get();

	$data['grade_list']    = DB::table('MASTER_GRADE')->get();

	$data['state_list']  = DB::table('MASTER_STATE')->get();

	$data['help_acc_type_list'] = DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->Orderby('EMP_CODE', 'desc')->limit(5)->get();

	$data['accTypeData'] =  DB::table('MASTER_ACC')->get();

	$EmpCode = base64_decode($EmpCode);
    	
   if($EmpCode!=''){

    	$query = DB::table('MASTER_EMP');
		$query->where('EMP_CODE', $EmpCode);
		$query->where('COMP_CODE', $comp_code);
		$data['empData']= $query->get()->first();

		$query = DB::table('MASTER_EMPFAMILY');
		$query->where('EMP_CODE', $EmpCode);
		$data['familyData']= $query->get()->first();

		$query = DB::table('MASTER_EMPCAREER');
		$query->where('EMP_CODE', $EmpCode);
		$data['careerData']= $query->get()->toArray();

		$query = DB::table('MASTER_EMPEDU');

		$query->where('EMP_CODE', $EmpCode);

		$data['educationData']= $query->get()->toArray();

		return view('admin.finance.master.employee.edit_employee', $data+compact('title', 'comp_code','comp_name'));

	}else{

		$request->session()->flash('alert-error', 'Employee Not Found...!');

		return redirect('/finance/view-employee-master');
		}

}

public function UpdateEmployeeMaster(Request $request){

   $validate = $this->validate($request, [

		'employee_code'      => 'required',
		'employee_name'      => 'required|regex:/^[\pL\s\-]+$/u|max:255',
		'date_of_birth'      => 'required',
		'gender'             => 'required',
		'emp_email'          => 'required|email',
		'emp_mobile'         => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
		'bankName'         => 'required|regex:/^[\pL\s\-]+$/u|max:100',
		'branch_name'         => 'required|regex:/^[\pL\s\-]+$/u|max:100',
		'bank_ifsc'         => 'required|max:11',
		'bank_account'         => 'required|max:30',
		'joining_date'       => 'required',
		'emp_designation'    => 'required|regex:/^[\pL\s\-]+$/u|max:150',
		'emp_department'     => 'required',
		'comp_code'          => 'required',
		'plant_code'         => 'required',
		'Profit_center_code' => 'required',
		'left_date'          => 'required',
		'address_line_1'          => 'required|regex:/[a-zA-Z0-9\s]+/',
		'pin_code'          => 'required|max:6',
		'add_city'          => 'required|regex:/^[\pL\s\-]+$/u|max:150',
		'add_state'          => 'required|regex:/^[\pL\s\-]+$/u|max:150',
		'add_country'          => 'required|regex:/^[\pL\s\-]+$/u|max:150',
		'perm_address_line_1'          => 'required|regex:/[a-zA-Z0-9\s]+/',
		'perm_address_line_2'          => 'required|regex:/[a-zA-Z0-9\s]+/',
		'perm_address_line_3'          => 'required|regex:/[a-zA-Z0-9\s]+/',
		'perm_pin_code'          => 'required|max:6',
		'perm_add_city'          => 'required|regex:/^[\pL\s\-]+$/u|max:150',
		'perm_add_state'          => 'required|regex:/^[\pL\s\-]+$/u|max:150',
		'perm_add_country'          => 'required|regex:/^[\pL\s\-]+$/u|max:150',
		

	]);

	$sesionid = $request->session()->get('userid');

	$emp_code = $request->input('employee_code');
	
	$id       = $request->input('id');

   $emp_dob          = $request->input('date_of_birth');

	$new_dob          = date("Y-m-d", strtotime($emp_dob));

	$joining_date     = $request->input('joining_date');

	$new_joining_date = date("Y-m-d", strtotime($joining_date));

	$left_date        = $request->input('left_date');

	$new_left_date    = date("Y-m-d", strtotime($left_date));


	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');

 	$createdBy 	= $request->session()->get('userid');

 	$passport = $request->input('passportExist');

 	$getcomcode    = explode('-', $compName);

	$comp_code = $getcomcode[0];

   if($file1 = $request->hasFile('passport') == ""){
         
          $passportImg = $passport;
          
        
   }else{

      // $filenamewithext = $request->file('passport')->getClientOriginalName();

      // $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);

      // $extension = $request->file('passport')->getClientOriginalExtension();

      // $filenamestore1 = $filename.'_'.date('Ymd-His').'.'.$extension;

      // $path = $request->file('passport')->move('public/dist/img/credit',$filenamestore1);

      $filenamewithext = $request->file('passport')->getClientOriginalName();

      $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);

      $extension = $request->file('passport')->getClientOriginalExtension();

      $passportImg = $filename.'_'.date('Ymd-His').'.'.$extension;
      
      $path = $request->file('passport')->move('public/dist/img/credit',$passportImg);
   }

   $aadhar_card = $request->input('adharcardExist');

	if($file2 = $request->hasFile('adharcard') == "") {

        	$filenamestore2 = $aadhar_card;

   }else{

      $filenamewithext = $request->file('adharcard')->getClientOriginalName();

      $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);

      $extension = $request->file('adharcard')->getClientOriginalExtension();

      $filenamestore2 = $filename.'_'.date('Ymd-His').'.'.$extension;

      $path = $request->file('adharcard')->move('public/dist/img/credit',$filenamestore2);
   }

   $pan_card = $request->input('pancardExist');

   if($file3 = $request->hasFile('pancard') == ""){
             
      $filenamestore3 = $pan_card;
             
	}else{

      $filenamewithext = $request->file('pancard')->getClientOriginalName();

      $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);

      $extension = $request->file('pancard')->getClientOriginalExtension();

      $filenamestore3 = $filename.'_'.date('Ymd-His').'.'.$extension;

      $path = $request->file('pancard')->move('public/dist/img/credit',$filenamestore3);
   }

   $voter_id = $request->input('voter_idExist');

   if($file4 = $request->hasFile('voter_id') == "") {

      $filenamestore4 = $voter_id;
             
   }else{

      $filenamewithext = $request->file('voter_id')->getClientOriginalName();

      $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);

      $extension = $request->file('voter_id')->getClientOriginalExtension();

      $filenamestore4 = $filename.'_'.date('Ymd-His').'.'.$extension;

      $path = $request->file('voter_id')->move('public/dist/img/credit',$filenamestore4);
   }

   $drivingcard = $request->input('drivingcardExits');

   if($file5 = $request->hasFile('drivingcard') == "") {
             
             $filenamestore5 = $drivingcard;
         
   }else{

      $filenamewithext = $request->file('drivingcard')->getClientOriginalName();

      $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);

      $extension = $request->file('drivingcard')->getClientOriginalExtension();

      $filenamestore5 = $filename.'_'.date('Ymd-His').'.'.$extension;

      $path = $request->file('drivingcard')->move('public/dist/img/credit',$filenamestore5);
   }
     date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");
      $data = array(

	   "EMP_CODE"        =>  $request->input('employee_code'),
	   "FY_CODE"         =>  $fisYear,
		"EMP_NAME"        =>  $request->input('employee_name'),
		"DOB"             =>  $new_dob,
		"BIRTH_PLACE"     =>  $request->input('birth_place'),
		"GENDER"          =>  $request->input('gender'),
		"CAST"            =>  $request->input('emp_cast'),
		"RELIGION"        =>  $request->input('emp_religion'),
		"BLOOD_GROUP"     =>  $request->input('blood_group'),
		"MARITAL_STATUS"  =>  $request->input('marital_status'),
		"EMAIL"           =>  $request->input('emp_email'),
		"CONTACT_NO"      =>  $request->input('emp_mobile'),
		"ADHAR_NO"        =>  $request->input('adhar_no'),
		"PAN_NO"          =>  $request->input('pan_no'),
		"ACC_CODE"        =>  $request->input('acc_code'),
		"BANK_NAME"       =>  $request->input('bankName'),
		"BRANCH_NAME"     =>  $request->input('branch_name'),
		"BANK_IFSC"       =>  $request->input('bank_ifsc'),
		"BANK_ACCOUNT_NO" =>  $request->input('bank_account'),
		"BANK_MICR"       =>  $request->input('bank_micr'),
		"DOJ"             =>  $new_joining_date,
		"DESIG_CODE"      =>  $request->input('emp_designation'),
		"DESIG_NAME"      =>  $request->input('desig_name'),
		"DEPT_CODE"       =>  $request->input('emp_department'),
		"DEPT_NAME"       =>  $request->input('dept_name'),
		"GRADE_CODE"     =>  $request->input('emp_grade'),
		"GRADE_NAME"       =>  $request->input('grade_name'),
		"ORG_CODE"        =>  $request->input('org_position'),
		"COMP_CODE"      =>  $request->input('comp_code'),
		"COMP_NAME"      =>  $request->input('comp_name'),
		"PLANT_CODE"    =>  $request->input('plant_code'),
		"PLANT_NAME"    =>  $request->input('plant_name'),
		"PFCT_CODE"       =>  $request->input('Profit_center_code'),
          "PFCT_NAME"      =>  $request->input('pfct_name'),
		"COST_CODE"      =>  $request->input('cost_code'),
		"COST_NAME"      =>  $request->input('cost_name'),
		"ESIC_NO"         =>  $request->input('esic_no'),
		"EPF_NO"          =>  $request->input('epf_no'),
		"EPFO_UAN"        =>  $request->input('epfo_uan_no'),
		"LEFT_DATE"       =>  $new_left_date,
		"LEFT_REASON"     =>  $request->input('left_reason'),
		"ADD1"            =>  $request->input('address_line_1'),
		"ADD2"            =>  $request->input('address_line_2'),
		"ADD3"            =>  $request->input('address_line_3'),
		"PIN_CODE"        =>  $request->input('pin_code'),
		"CITY"            =>  $request->input('add_city'),
		"STATE"           =>  $request->input('add_state'),
		"COUNTRY"         =>  $request->input('add_country'),
		"PADD1"           =>  $request->input('perm_address_line_1'),
		"PADD2"           =>  $request->input('perm_address_line_2'),
		"PADD3"           =>  $request->input('perm_address_line_3'),
		"PPIN_CODE"       =>  $request->input('perm_pin_code'),
		"PCITY"           =>  $request->input('perm_add_city'),
		"PSTATE"          =>  $request->input('perm_add_state'),
		"PCOUNTRY"        =>  $request->input('perm_add_country'),
		"PASSPORT"        =>  $passportImg,
		"ADHAR_CARD"      =>  $filenamestore2,
		"PAN_CARD"        =>  $filenamestore3,
		"VOTER_ID"        =>  $filenamestore4,
		"DRIVING_LICENCE" =>  $filenamestore5,
		"LAST_UPDATE_BY"  =>  $request->session()->get('userid'),
		"LAST_UPDATE_DATE"  =>  $updatedDate

	);


	$saveData = DB::table('MASTER_EMP')->where('EMP_CODE', $emp_code)->where('COMP_CODE',$comp_code)->update($data);

	if ($saveData){

		$request->session()->flash('alert-success', 'Employee Details Successfully Update...!');
		return redirect('/Master/Employee/View-Employee-Mast');

	}else{

		$request->session()->flash('alert-error', 'Employee Details Can Not Update...!');
		return redirect('/Master/Employee/View-Employee-Mast');

	}

}

public function UpdateEmpFamilyMaster(Request $request){

   $validate = $this->validate($request, [

		'rel_emp_code'           => 'required|max:12',
		'relative_name'          => 'required|regex:/^[\pL\s\-]+$/u|max:255',
		'relative_date_of_birth' => 'required',
		'relation_with_emp'      => 'required|regex:/^[\pL\s\-]+$/u|max:100',
		'relative_mob'           => 'required|max:10',
		'relative_gender'        => 'required'

   ]);
  
   $sesionid = $request->session()->get('userid');

	$rel_emp_dob  = $request->input('relative_date_of_birth');

	$rel_emp_code = $request->input('rel_emp_code');
	// print_r($rel_emp_code);
	
	$new_rel_dob  = date("Y-m-d", strtotime($rel_emp_dob));

	$compName 	  = $request->session()->get('company_name');

   $fisYear 	  =  $request->session()->get('macc_year');

   $createdBy 	  = $request->session()->get('userid');

   $getcomcode    = explode('-', $compName);

   $comp_code = $getcomcode[0];
   $comp_name = $getcomcode[1];

  date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

   $data = array(

		"COMP_CODE"   =>  $comp_code,
		"COMP_NAME"   =>  $comp_name,
		"EMP_CODE"       =>  $request->input('rel_emp_code'),
		"EMP_NAME"       =>  $request->input('rel_emp_name'),
		"RNAME"          =>  $request->input('relative_name'),
		"RDOB"           =>  $new_rel_dob,
		"RRELATION"      =>  $request->input('relation_with_emp'),
		"RGENDER"        =>  $request->input('relative_gender'),
		"RCONTACT"       =>  $request->input('relative_mob'),
		"FLAG"           =>  '0',
		"LAST_UPDATE_BY" =>  $request->session()->get('userid'),
		"LAST_UPDATE_DATE" =>  $updatedDate

   );

   $familyempCode = DB::table('MASTER_EMPFAMILY')->where('EMP_CODE', $rel_emp_code)->get();
         

   $empFamC = count($familyempCode);
    

   if($empFamC > 0){

     $familyData = DB::table('MASTER_EMPFAMILY')->where('EMP_CODE', $rel_emp_code)->update($data);	
     
   }else{

    	$familyData = DB::table('MASTER_EMPFAMILY')->insert($data);
   }

   if ($familyData) {

		$request->session()->flash('alert-success-family', 'Employee Family Details Successfully Save...!');
		
		return redirect('/Master/Employee/View-Employee-Mast');

	}else{

		$request->session()->flash('alert-error-family', 'Employee Family Details Can Not Save...!');
			
		return redirect('/Master/Employee/View-Employee-Mast');

	}
        
}

public function UpdateEmpCareerMaster(Request $request){

	$EmpCodeCount       = $request->input('emp_code');
	
	$CareerDetlSlno     = $request->input('CareerDetlSlno');
	
	$CareerDetlSlnoNew  = $request->input('CareerDetlSlnoNew');

	if(isset($CareerDetlSlno)){

		$SlnoCount          = count($CareerDetlSlno);
	
	}else{

		$CareerDetlSlno1    = array();
		$SlnoCount          = count($CareerDetlSlno1);
	}
	
	if(isset($CareerDetlSlnoNew)){

		$SlnoCountNew       = count($CareerDetlSlnoNew);
	
	}else{

		$CareerDetlSlnoNew1 = array();
		$SlnoCountNew       = count($CareerDetlSlnoNew1);
	}
	
	$compName  = $request->session()->get('company_name');
	
	$fisYear   =  $request->session()->get('macc_year');
	
	$createdBy = $request->session()->get('userid');
	
	$CompName  = $request->input('comp_name');
	
	$desig     = $request->input('designation');
	
	$deptList  = $request->input('DeptList');

	$slNum      = $request->input('careerSlno');

   $EmpCodeCountNew = $request->input('emp_codeNew');
		
	$CompNameNew     = $request->input('comp_nameNew');
	
	$desigNew        = $request->input('designationNew');
	
	$deptListNew     = $request->input('DeptListNew');

	$flag = 1;
   
   $saveData = '';

   $idGet = $request->input('careerId');

   for ($i=0; $i < $SlnoCount; $i++) { 

      $id        = $idGet[$i];

      $slno      = $slNum[$i];

      $form_date = $request->input('form_date');
		
		$FormDate  = date("Y-m-d", strtotime($form_date[$i]));
		
		$to_date   = $request->input('to_date');
		
		$ToDate    = date("Y-m-d", strtotime($to_date[$i]));
        date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

    	$data = array(

			"EMP_CODE"       =>  $EmpCodeCount[$i],
			"COMPANY"        =>  $CompName[$i],
			"DESIGNATION"    =>  $desig[$i],
			"DEPARTMENT"     =>  $deptList[$i],
			"FROM_DATE"      =>  $FormDate,
			"TO_DATE"        =>  $ToDate,
			"FLAG"           =>  $flag,
			"LAST_UPDATE_BY" =>  $createdBy,
			"LAST_UPDATE_DATE" =>  $updatedDate

		); 


		$saveData = DB::table('MASTER_EMPCAREER')->where('EMP_CODE',$EmpCodeCount[$i])->where('SLNO', $slno)->update($data);

    		
   }

   if($SlnoCountNew != ''){

    	for ($i=0; $i < $SlnoCountNew; $i++) { 

			$form_dateNew  = $request->input('form_dateNew');

    		if($form_dateNew == ''){

    			$FormDateNew == '';

    		}else{

    			$FormDateNew = date("Y-m-d", strtotime($form_dateNew[$i]));
    		}

    		$to_dateNew = $request->input('to_dateNew');

			if($to_dateNew == ''){

    			$ToDateNew == '';

    		}else{

    			$ToDateNew = date("Y-m-d", strtotime($to_dateNew[$i]));
    		}

			
    		$data = array(

			"EMP_CODE"       =>  $EmpCodeCountNew[$i],
			"COMPANY"        =>  $CompNameNew[$i],
			"DESIGNATION"    =>  $desigNew[$i],
			"DEPARTMENT"     =>  $deptListNew[$i],
			"FROM_DATE"      =>  $FormDateNew,
			"TO_DATE"        =>  $ToDateNew,
			"FLAG"           =>  $flag,
			"LAST_UPDATE_BY" =>  $createdBy

			); 

			$saveData = DB::table('MASTER_EMPCAREER')->insert($data);
    	}

   }

   if ($saveData) {

		$request->session()->flash('alert-success', 'Employee Career Details Successfully Save...!');
		
		return redirect('Master/Employee/View-Employee-Mast');

	} else {

		$request->session()->flash('alert-error', 'Employee Career Details Can Not Save...!');
		
		return redirect('Master/Employee/View-Employee-Mast');

	}

}

public function UpdateEmpEducationMaster(Request $request){

   $EmpCodeCount = $request->input('eduId');

   $EductnDetlSlno = $request->input('EductnDetlSlno');
 	
 	$EductnDetlSlnoNew = $request->input('EductnDetlSlnoNew');

 	if(isset($EductnDetlSlno)){
 		
 		$SlnoCount    = count($EductnDetlSlno);

 	}else{
    	
    	$EductnDetlSlno1 = array();
      
      $SlnoCount    = count($EductnDetlSlno1);
   }

   if(isset($EductnDetlSlnoNew)){

    	$SlnoCountNew = count($EductnDetlSlnoNew);


   }else{

    	$EductnDetlSlnoNew1 = array();
      
      $SlnoCountNew = count($EductnDetlSlnoNew1);
            
   }

   $compName          = $request->session()->get('company_name');
		
	$fisYear           =  $request->session()->get('macc_year');
		
	$createdBy         = $request->session()->get('userid');
		
	$empl_code         = $request->input('empl_code');
	
	$course_name       = $request->input('course_name');
	
	$universit_name    = $request->input('universit_name');
	
	$passing_year      = $request->input('passing_year');
	
	$percentage        = $request->input('percentage');
	
	$empl_codeNew      = $request->input('empl_codeNew');
		
	$course_nameNew    = $request->input('course_nameNew');
		
	$universit_nameNew = $request->input('universit_nameNew');
	$CourseName        = $request->input('course_name');
	
	$passing_yearNew   = $request->input('passing_yearNew');
	
	$percentageNew     = $request->input('percentageNew');
   
   $flag = 1;
   
   $saveData = '';

   $idGet = $request->input('eduId');
   print_r($idGet);

   $saveData = DB::table('MASTER_EMPEDU')->where('EMP_CODE',$idGet)->delete();

   for ($i=0; $i < $SlnoCount; $i++) { 

      $id = $idGet[$i];

    	$data = array(

			"EMP_CODE"       =>  $EmpCodeCount[$i],
			"COURSE"         =>  $CourseName[$i],
			"UNIVERSITY"     =>  $universit_name[$i],
			"PASSING_YEAR"   =>  $passing_year[$i],
			"PERCENTAGE"     =>  $percentage[$i],
			"FLAG"           =>  $flag,
			"LAST_UPDATE_BY" =>  $createdBy

		); 

		$saveData = DB::table('MASTER_EMPEDU')->insert($data);
   }

   for ($i=0; $i < $SlnoCountNew; $i++) { 
            
      $flag = 1;
		
		$data = array(

			"EMP_CODE"       =>  $empl_codeNew[$i],
			"COURSE"         =>  $course_nameNew[$i],
			"UNIVERSITY"     =>  $universit_nameNew[$i],
			"PASSING_YEAR"   =>  $passing_yearNew[$i],
			"PERCENTAGE"     =>  $percentageNew[$i],
			"FLAG"           =>  $flag,
			"LAST_UPDATE_BY" =>  $createdBy,
		
      ); 

      $saveData = DB::table('MASTER_EMPEDU')->insert($data);
   }

   if ($saveData) {

		$request->session()->flash('alert-success', 'Employee Education Details Successfully Save...!');
		
		return redirect('Master/Employee/View-Employee-Mast');

	} else {

		$request->session()->flash('alert-error', 'Employee Education Details Can Not Save...!');
		
		return redirect('Master/Employee/View-Employee-Mast');

	}
}

public function DeleteEmpMaster(Request $request){


	$delempcode = $request->input('delempcode');
	

	if ($delempcode!='') {

 		try{

 		$Delete = DB::table('MASTER_EMP')->where('EMP_CODE', $delempcode)->delete();


 		$Delete = DB::table('MASTER_EMPFAMILY')->where('EMP_CODE', $delempcode)->delete();

 		
 		
 		$Delete = DB::table('MASTER_EMPCAREER')->where('EMP_CODE', $delempcode)->delete();
 		
 		$Delete = DB::table('MASTER_EMPEDU')->where('EMP_CODE', $delempcode)->delete();

		if ($Delete) {

			$request->session()->flash('alert-success', 'Employee 
			 Was Deleted Successfully...!');
			return redirect('Master/Employee/View-Employee-Mast');

		} else {

			$request->session()->flash('alert-error', 'Employee Can Not Deleted...!');
			return redirect('Master/Employee/View-Employee-Mast');

		}
	}catch(Exception $ex){

		    $request->session()->flash('alert-error', 'Employee Can not be Deleted...! Used In Another Transaction...!');
				return redirect('Master/Employee/View-Employee-Mast');
		}

 	}else{

 		$request->session()->flash('alert-error', 'Zone  Not Found...!');
		return redirect('Master/Employee/View-Employee-Mast');

 	}

}

public function HelpEmpCodeSearch(Request $request){

   $response_array = array();

   $emp_code_help = $request->input('HelpEmpCode');
   
   $compName = $request->session()->get('company_name');
   
   $getcomcode    = explode('-', $compName);
   
   $comp_code = $getcomcode[0];
    
	if ($request->ajax()) {

      $Seach_Emp_Code_by_help = DB::select("SELECT * FROM `MASTER_EMP` WHERE (EMP_CODE='$emp_code_help' OR EMP_NAME='$emp_code_help' OR EMP_CODE Like '$emp_code_help%' OR EMP_NAME LIKE '$emp_code_help%') AND (COMP_CODE='$comp_code') ORDER BY EMP_CODE DESC limit 5  ");


	   if ($Seach_Emp_Code_by_help) {

    			$response_array['response'] = 'success';
	         
	         $response_array['data'] = $Seach_Emp_Code_by_help ;

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
    

public function AddEmpGrade(Request $request){

 	$title = 'Employee Grade Master';

 	$compName = $request->session()->get('company_name');

 	$grade_code = $request->old('grade_code');
	
	$grade_name = $request->old('grade_name');
	
   $button='Save';
 	
 	$action='/Master/Employee/Emp-Grade-Save';

   if(isset($compName)){

    	return view('admin.finance.master.employee.emp_grade',compact('title','button','action','grade_code','grade_name'));

   }else{

		return redirect('/useractivity');
	}

}

public function ViewEmployeeGrade(Request $request){

   $compName = $request->session()->get('company_name');

	if($request->ajax()){
      
      $title    = 'View Employee Grade Master';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

	   if($userType=='admin'){

	    	$data = DB::table('MASTER_GRADE')->orderBy('GRADE_CODE','DESC');

      }else if ($userType=='superAdmin' || $userType=='user'){    		

	    	$data = DB::table('MASTER_GRADE')->orderBy('GRADE_CODE','DESC');

	   }else{
	    		$data ='';
	   }

	   return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){
    	
    	return view('admin.finance.master.employee.view_emp_grade');
	
	}else{

		return redirect('/useractivity');
	}
}

public function EditEmpGrade($EmpGrade){

   $title = 'Edit Emp Grade Master';

   $EmpGrade = base64_decode($EmpGrade);
   
   if($EmpGrade!=''){

 	   $query = DB::table('MASTER_GRADE');
		$query->where('GRADE_CODE', $EmpGrade);
		$classData= $query->get()->first();

		$grade_code = $classData->GRADE_CODE;

		$grade_name = $classData->GRADE_NAME;

		$grade_block = $classData->GRADE_BLOCK;

		$button='Update';

		$action='Master/Employee/Emp-Grade-Update';

		return view('admin.finance.master.employee.emp_grade',compact('title','grade_code','grade_name','grade_block','button','action'));
	
	}else{
		
		$request->session()->flash('alert-error', 'Employee Grade Not Found...!');
		
		return redirect('/Master/Employee/View-Emp-Grade-Mast');
	}

}

public function EmpGradeUpdate(Request $request){

	$validate = $this->validate($request, [

		'grade_code' => 'required|max:12',
		'grade_name' => 'required|max:40',

	]);

	$gradecode = $request->input('idcostcatg');

	date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d H:i:s");
	
	$createdBy   = $request->session()->get('userid');
	
	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');

	$data = array(
		
		"GRADE_CODE"       => $request->input('grade_code'),
		"GRADE_NAME"       => $request->input('grade_name'),
		"GRADE_BLOCK"      => $request->input('grade_block'),
		"FLAG"             => '0',
		"LAST_UPDATE_BY"   => $createdBy,
		"LAST_UPDATE_DATE" => $updatedDate,
			
	);
	
	try{

		$saveData = DB::table('MASTER_GRADE')->where('GRADE_CODE', $gradecode)->update($data);

		if($saveData){

			$request->session()->flash('alert-success', 'Employee Grade Was Successfully Updated...!');
			
			return redirect('/Master/Employee/View-Emp-Grade-Mast');

		}else{

			$request->session()->flash('alert-error', 'Employee Grade Can Not Added...!');
			
			return redirect('/Master/Employee/View-Emp-Grade-Mast');

		}
	}catch(Exception $ex){

		$request->session()->flash('alert-error', 'Employee Grade Can not be Updated...! Used In Another Transaction...!');
		
		return redirect('/Master/Employee/View-Emp-Grade-Mast');
	}


}

public function DeleteEmpGrade(Request $request){

	$costcat = $request->input('costcat');
    	
   if ($costcat!='') {
    	
    	try{

    		$Delete = DB::table('MASTER_GRADE')->where('GRADE_CODE', $costcat)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Employee 
				Grade Was Deleted Successfully...!');
				
				return redirect('Master/Employee/View-Emp-Grade-Mast');

			}else{

				$request->session()->flash('alert-error', 'Employee Grade Can Not Deleted...!');
				
				return redirect('Master/Employee/View-Emp-Grade-Mast');

			}
		}catch(Exception $ex){

			    $request->session()->flash('alert-error', 'Employee Grade Can not be Deleted...! Used In Another Transaction...!');
				 
				 return redirect('/finance/view-employee-grade-master');
		}

   }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
		
		return redirect('/finance/view-employee-grade-master');

   }

}

public function SaveEmployeeGradeMaster(Request $request){
        
   $validate = $this->validate($request, [

		'grade_code' => 'required|max:6|unique:MASTER_GRADE,GRADE_CODE',
		'grade_name' => 'required|max:40',

	]);


 	$createdBy 	= $request->session()->get('userid');

 	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');
   
   $data = array(

   	"GRADE_CODE"  => $request->input('grade_code'),
		"GRADE_NAME"  => $request->input('grade_name'),
		"GRADE_BLOCK" => 'NO',
		"FLAG"        => '0',
		"CREATED_BY"  => $createdBy,
			
	);

   $saveData = DB::table('MASTER_GRADE')->insert($data);

   if ($saveData) {

		$request->session()->flash('alert-success', 'Employee Grade Was Successfully Added...!');
		
		return redirect('/Master/Employee/View-Emp-Grade-Mast');

	}else{

		$request->session()->flash('alert-error', 'Employee Grade Can Not Added...!');
		
		return redirect('/Master/Employee/View-Emp-Grade-Mast');

	}

}

public function AddEmpDesignation(Request $request){

 	$title = 'Employee Grade Master';

 	$compName = $request->session()->get('company_name');

 	$designation_code = $request->old('designation_code');
	
	$designation_name = $request->old('designation_name');
	
   $button='Save';
 	
 	$action='/Master/Employee/employee-designation-save';

 	if(isset($compName)){

 	return view('admin.finance.master.employee.emp_designation',compact('title','button','action','designation_code','designation_name'));

    }else{

		return redirect('/useractivity');
	}

}

public function SaveEmployeeDesignation(Request $request){
        
   $validate = $this->validate($request, [

		'designation_code' => 'required|max:6|unique:MASTER_DESIG,DESIG_CODE',
		'designation_name' => 'required|max:40',

   ]);


 	$createdBy 	= $request->session()->get('userid');

 	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');

   $data = array(

   	"DESIG_CODE"  => $request->input('designation_code'),
		"DESIG_NAME"  => $request->input('designation_name'),
		"DESIG_BLOCK" => 'Null',
		"FLAG"        => '0',
		"CREATED_BY"  => $createdBy,
		
	);
   
   $saveData = DB::table('MASTER_DESIG')->insert($data);

   if ($saveData) {

		$request->session()->flash('alert-success', 'Employee Grade Was Successfully Added...!');
		
		return redirect('/Master/Employee/View-Emp-Designation-Mast');

	} else {

		$request->session()->flash('alert-error', 'Employee Grade Can Not Added...!');
		
		return redirect('/Master/Employee/View-Emp-Designation-Mast');

	}

}

public function ViewEmployeeDesignation(Request $request){

   $compName = $request->session()->get('company_name');

	if($request->ajax()){
     
      $title    = 'View Employee Designation';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data = DB::table('MASTER_DESIG')->orderBy('DESIG_CODE','DESC');

    	}else if ($userType=='superAdmin' || $userType=='user') {    		

    		$data = DB::table('MASTER_DESIG')->orderBy('DESIG_CODE','DESC');

    	}
    	else{
    		$data ='';
    	}


    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }

	if(isset($compName)){

    	return view('admin.finance.master.employee.view_emp_designation');

	}else{
		return redirect('/useractivity');
	}
}

public function EditEmpDesignation($descode){

   $title = 'Edit Designation Master';

   $DesCode = base64_decode($descode);
   
   if($DesCode!=''){

 	   $query = DB::table('MASTER_DESIG');
		$query->where('DESIG_CODE', $DesCode);
		$classData= $query->get()->first();

		$designation_code = $classData->DESIG_CODE;

		$designation_name = $classData->DESIG_NAME;

		$designation_block = $classData->DESIG_BLOCK;

		$button='Update';

		$action='Master/Employee/form-emp-designation-update';

		return view('admin.finance.master.employee.emp_designation',compact('title','designation_code','designation_name','designation_block','button','action'));

	}else{

			$request->session()->flash('alert-error', 'Employee Grade Not Found...!');
			
			return redirect('/Master/Employee/View-Emp-Designation-Mast');
	}

}

public function EmpDesignationUpdate(Request $request){

	$validate = $this->validate($request, [

		'designation_code' => 'required|max:12',
		'designation_name' => 'required|max:40',

	]);

	$desigcode = $request->input('iddesignation');

	date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d H:i:s");
		
	$createdBy   = $request->session()->get('userid');
	
	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');

	$data = array(
			
		"DESIG_CODE"     => $request->input('designation_code'),
		"DESIG_NAME"     => $request->input('designation_name'),
		"DESIG_BLOCK"    => $request->input('designation_block'),
		"FLAG"           => '0',
		"LAST_UPDATE_BY" => $createdBy,
		"LAST_UPDATED_DATE" => $updatedDate,
		
			
	);
	try{	

		$saveData = DB::table('MASTER_DESIG')->where('DESIG_CODE', $desigcode)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Employee Designation Was Successfully Updated...!');
			
			return redirect('/Master/Employee/View-Emp-Designation-Mast');

		}else{

			$request->session()->flash('alert-error', 'Employee Designation Can Not Added...!');
			
			return redirect('/Master/Employee/View-Emp-Designation-Mast');

		}

	}catch(Exception $ex){
      
      $request->session()->flash('alert-error', 'Employee Grade Can not be Updated...! Used In Another Transaction...!');
		
		return redirect('/Master/Employee/View-Emp-Designation-Mast');
	}
}

public function DeleteEmpDesignation(Request $request){

	$designation = $request->input('designation');
    	
   if ($designation!='') {

    	try{

    		$Delete = DB::table('MASTER_DESIG')->where('DESIG_CODE', $designation)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Employee 
				Designation Was Deleted Successfully...!');
				
				return redirect('/Master/Employee/View-Emp-Designation-Mast');

			}else{

				$request->session()->flash('alert-error', 'Employee Designation Can Not Deleted...!');
				
				return redirect('/Master/Employee/View-Emp-Designation-Mast');

			}
		}catch(Exception $ex){
			    
			   $request->session()->flash('alert-error', 'Employee Designation Can not be Deleted...! Used In Another Transaction...!');
				
				return redirect('/Master/Employee/View-Emp-Designation-Mast');
		}

   }else{

    		$request->session()->flash('alert-error', 'Zone  Not Found...!');
			return redirect('/finance/view-employee-grade-master');

   }

}

/* EMP POSITION MASTER*/

public function AddEmpPosition(Request $request){

  $title = 'Employee Position Master';

  $compName = $request->session()->get('company_name');

  $position_code = $request->old('position_code');

  $position_name = $request->old('position_name');
	
  $button='Save';

  $action='/Master/Employee/employee-position-save';

  if(isset($compName)){

   return view('admin.finance.master.employee.add_emp_position',compact('title','button','action','position_code','position_name'));

  }else{

  return redirect('/useractivity');
  }

}

public function SaveEmployeePosition(Request $request){
        
   $validate = $this->validate($request, [

		'position_code' => 'required|max:6|unique:MASTER_EMPPOSITION,POSITION_CODE',
		'position_name' => 'required|max:30',

   ]);

   $createdBy 	= $request->session()->get('userid');

   $compName 	= $request->session()->get('company_name');

   $fisYear 	=  $request->session()->get('macc_year');

   $data = array(

     "POSITION_CODE"       => $request->input('position_code'),
	  "POSITION_NAME"       => $request->input('position_name'),
	  "FUNCTIONAL_REPPOS"   => $request->input('functional_reppos'),
	  "ADMISTRATIVE_REPPOS" => $request->input('admini_reppos'),
	  "HR_REPPOS"           => $request->input('hr_reppos'),
	  "FLAG"                => '0',
	  "POSITION_BLOCK"      => 'NO',
	  "CREATED_BY"          => $createdBy,
			
   );

   $saveData = DB::table('MASTER_EMPPOSITION')->insert($data);

   if($saveData) {

	  $request->session()->flash('alert-success', 'Employee Position is Successfully Added...!');
	  
	  return redirect('/Master/Employee/View-Emp-Position-Mast');

   }else{

	 $request->session()->flash('alert-error', 'Employee Position Can Not Added...!');
	 
	 return redirect('/Master/Employee/View-Emp-Position-Mast');

   }
}

public function ViewEmployeePosition(Request $request){

   $compName = $request->session()->get('company_name');

	if($request->ajax()){
         
      $title    = 'View Employee Position';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

	   if($userType=='admin'){

	    	  $data = DB::table('MASTER_EMPPOSITION')->orderBy('POSITION_CODE','DESC');

	   }else if ($userType=='superAdmin' || $userType=='user') {    		
            $data = DB::table('MASTER_EMPPOSITION')->orderBy('POSITION_CODE','DESC');

	   }else{

	    	  $data ='';

	   }


    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

    	  return view('admin.finance.master.employee.view_emp_position');

	}else{
		return redirect('/useractivity');
	}

}

public function DeleteEmpPosition(Request $request){

	$position = $request->input('position');
    	
    	if ($position!='') {
    		
    		try{

	    		$Delete = DB::table('MASTER_EMPPOSITION')->where('POSITION_CODE', $position)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Employee 
					Position is Deleted Successfully...!');
				return redirect('/Master/Employee/View-Emp-Position-Mast');

			}else{

				$request->session()->flash('alert-error', 'Employee Position Can Not Deleted...!');
				return redirect('/Master/Employee/View-Emp-Position-Mast');
	          
	          }
		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Employee Position Can not be Deleted...! Used In Another Transaction...!');
			return redirect('/Master/Employee/View-Emp-Position-Mast');
		}

    	}else{

    		$request->session()->flash('alert-error', 'Zone  Not Found...!');
		return redirect('/Master/Employee/View-Emp-Position-Mast');

    	}

}

public function EditEmpPosition($position_code){

 	$title = 'Edit Position Master';

 	$position_code = base64_decode($position_code);
 	
 	if($position_code!=''){

 	   $query = DB::table('MASTER_EMPPOSITION');
		$query->where('POSITION_CODE', $position_code);
		$classData= $query->get()->first();

		$position_code = $classData->POSITION_CODE;

		$position_name = $classData->POSITION_NAME;

		$functional_reppos = $classData->FUNCTIONAL_REPPOS;

		$admini_reppos = $classData->ADMISTRATIVE_REPPOS;

		$hr_reppos = $classData->HR_REPPOS;

		$position_block = $classData->POSITION_BLOCK;
		$button='Update';

		$action='Master/Employee/form-emp-position-update';

	   return view('admin.finance.master.employee.add_emp_position',compact('title','position_code','position_name','functional_reppos','admini_reppos','hr_reppos','position_block','button','action'));

	}else{

		$request->session()->flash('alert-error', 'Employee Position Not Found...!');
		return redirect('/Master/Employee/View-Emp-Position-Mast');

	}

}

public function EmpPositionUpdate(Request $request){

	$validate = $this->validate($request, [

		'position_code' => 'required',
		'position_name' => 'required|max:30',

	]);

	$positioncode = $request->input('idposition');

	date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d H:i:s");
	
	$createdBy   = $request->session()->get('userid');
	
	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');

	$data = array(
			
	  "POSITION_CODE"       => $request->input('position_code'),
	  "POSITION_NAME"       => $request->input('position_name'),
	  "FUNCTIONAL_REPPOS"   => $request->input('functional_reppos'),
	  "ADMISTRATIVE_REPPOS" => $request->input('admini_reppos'),
	  "HR_REPPOS"           => $request->input('hr_reppos'),
	  "FLAG"                => '0',
	  "POSITION_BLOCK"      => $request->input('position_block'),
	  "UPDATED_BY"          => $createdBy,
	  "UPDATED_DATE"        => $updatedDate,
	
		
	);
	try{
      
      $saveData = DB::table('MASTER_EMPPOSITION')->where('POSITION_CODE', $positioncode)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Employee Position is Successfully Updated...!');
			return redirect('/Master/Employee/View-Emp-Position-Mast');

		} else {

			$request->session()->flash('alert-error', 'Employee Position Can Not Added...!');
			return redirect('/Master/Employee/View-Emp-Position-Mast');

		}
   }catch(Exception $ex){

      $request->session()->flash('alert-error', 'Employee Position Can not be Updated...! Used In Another Transaction...!');
		
		return redirect('/Master/Employee/View-Emp-Position-Mast');
	}
}

/*----Start employee Activity--*/

public function AddEmpActivity(Request $request){

  $title = 'Employee Activity Master';

  $compName = $request->session()->get('company_name');

  $activity_code = $request->old('activity_code');

  $activity_name = $request->old('activity_name');
  
  $activity_remark = $request->old('activity_remark');
	
  $button='Save';

  $action='/Master/Employee/employee-activity-save';

  if(isset($compName)){

   return view('admin.finance.master.employee.add_emp_activity',compact('title','button','action','activity_code','activity_name','activity_remark'));

  }else{

  return redirect('/useractivity');
  }

}

public function SaveEmployeeActivity(Request $request){
        
   $validate = $this->validate($request, [

	 'activity_code' => 'required|max:6|unique:MASTER_EMPACTIVITY,ACTIVITY_CODE',
	 'activity_name' =>'required|max:30',
	 'activity_remark' =>'required|max:40',

   ]);

   $createdBy 	= $request->session()->get('userid');

   $compName 	= $request->session()->get('company_name');

   $fisYear 	=  $request->session()->get('macc_year');

   $data = array(

      "ACTIVITY_CODE"       => $request->input('activity_code'),
	   "ACTIVITY_NAME"       => $request->input('activity_name'),
	   "REMARK"   => $request->input('activity_remark'),
	   "FLAG"                => '0',
	   "ACTIVITY_BLOCK"      => 'NO',
	   "CREATED_BY"          => $createdBy,
			
   );

   $saveData = DB::table('MASTER_EMPACTIVITY')->insert($data);

   if($saveData) {

	  $request->session()->flash('alert-success', 'Employee Activity is Successfully Added...!');
	  
	  return redirect('/Master/Employee/View-Emp-Activity-Mast');

   }else{

	  $request->session()->flash('alert-error', 'Employee Activity Can Not Added...!');
	  
	  return redirect('/Master/Employee/View-Emp-Activity-Mast');

   }
}

public function ViewEmployeeActivity(Request $request){

   $compName = $request->session()->get('company_name');

	if($request->ajax()){
         
      $title    = 'View Employee Activity';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

	   if($userType=='admin'){

	    	  $data = DB::table('MASTER_EMPACTIVITY')->orderBy('ACTIVITY_CODE','DESC');

	   }else if ($userType=='superAdmin' || $userType=='user') {    		
         
         $data = DB::table('MASTER_EMPACTIVITY')->orderBy('ACTIVITY_CODE','DESC');

      }else{

	    	  $data ='';

	   }


    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

    	return view('admin.finance.master.employee.view_emp_activity');

	}else{

		return redirect('/useractivity');
	}

}

public function DeleteEmpActivity(Request $request){

	$activity = $request->input('activity');
    	
   if ($activity!='') {
    		
    	try{

	    	$Delete = DB::table('MASTER_EMPACTIVITY')->where('ACTIVITY_CODE', $activity)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Employee 
					Activity is Deleted Successfully...!');
				
				return redirect('/Master/Employee/View-Emp-Activity-Mast');

			}else{

				$request->session()->flash('alert-error', 'Employee Activity Can Not Deleted...!');
				
				return redirect('/Master/Employee/View-Emp-Activity-Mast');
	          
	          }
		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Employee Activity Can not be Deleted...! Used In Another Transaction...!');
			
			return redirect('/Master/Employee/View-Emp-Activity-Mast');
		}

    	}else{

    		$request->session()->flash('alert-error', 'Zone  Not Found...!');
		return redirect('/Master/Employee/View-Emp-Position-Mast');

    	}

}

public function EditEmpActivity($activity_code){

 	$title = 'Edit Activity Master';

 	$activity_code = base64_decode($activity_code);
 	
 	if($activity_code!=''){

 	   $query = DB::table('MASTER_EMPACTIVITY');
		$query->where('ACTIVITY_CODE', $activity_code);
		$classData= $query->get()->first();

		$activity_code   = $classData->ACTIVITY_CODE;

		$activity_name   = $classData->ACTIVITY_NAME;

		$activity_remark = $classData->REMARK;

		$activity_block  = $classData->ACTIVITY_BLOCK;

		$button='Update';

		$action='/Master/Employee/form-emp-activity-update';

	   return view('admin.finance.master.employee.add_emp_activity',compact('title','activity_code','activity_name','activity_remark','activity_block','button','action'));

	}else{

		$request->session()->flash('alert-error', 'Employee Activity Not Found...!');
		
		return redirect('/Master/Employee/View-Emp-Activity-Mast');

	}

}

public function EmpActivityUpdate(Request $request){

	$validate = $this->validate($request, [

		'activity_code' => 'required',
		'activity_name' => 'required|max:30',

	]);



	$activitycode = $request->input('idActivity');

	date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d H:i:s");
	
	$createdBy   = $request->session()->get('userid');
	
	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');
	
	$data = array(
		
	  "ACTIVITY_CODE"       => $request->input('activity_code'),
	  "ACTIVITY_NAME"       => $request->input('activity_name'),
	  "REMARK"              => $request->input('activity_remark'),
	  "FLAG"                => '0',
	  "ACTIVITY_BLOCK"      => $request->input('activity_block'),
	  "UPDATED_BY"          => $createdBy,
	  "UPDATED_DATE"    => $updatedDate,
	
	);
		
	try{

		$saveData = DB::table('MASTER_EMPACTIVITY')->where('ACTIVITY_CODE', $activitycode)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Employee Activity is Successfully Updated...!');
			
			return redirect('/Master/Employee/View-Emp-Activity-Mast');

		} else {

			$request->session()->flash('alert-error', 'Employee Activity Can Not Added...!');
			
			return redirect('/Master/Employee/View-Emp-Activity-Mast');

		}

	}catch(Exception $ex){

		$request->session()->flash('alert-error', 'Employee Activity Can not be Updated...! Used In Another Transaction...!');
		
		return redirect('/Master/Employee/View-Emp-Activity-Mast');
	}
}
/*---End employee Activity-----*/

/*---Start emp position activity---*/

public function AddEmpPosActivity(Request $request){

  $title = 'Emp Position Activity Master';

  $compName = $request->session()->get('company_name');

  $position_code = $request->old('position_code');
  $position_name = $request->old('pos_name');

  $mult_activity_code = $request->old('mult_activity_code');

  $position_list = DB::table('MASTER_EMPPOSITION')->orderBy('POSITION_CODE','DESC')->get();
  $activity_list = DB::table('MASTER_EMPACTIVITY')->orderBy('ACTIVITY_CODE','DESC')->get();

  $button='Save';

  $action='/Master/Employee/employee-position-activity-save';

  if(isset($compName)){

  return view('admin.finance.master.employee.emp_position_activity',compact('title','button','action','position_code','mult_activity_code','position_list','position_name','activity_list'));

  }else{

   return redirect('/useractivity');
  }

}

public function SaveEmployeePosActivity(Request $request){
        
   $validate = $this->validate($request, [

	 'position_code' => 'required|max:6',
	 'mult_activity_code' =>'required',
	 
	]);

   $createdBy 	= $request->session()->get('userid');

 	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');

 	$mulActivitycode = $request->input('mult_activity_code');
 	
 	$count = count($mulActivitycode);

   $saveData ='';
   
   for ($i=0; $i < $count ; $i++) { 

      $data = array(

	      "POSITION_CODE"         => $request->input('position_code'),
	      "POSITION_NAME"         => $request->input('pos_name'),
		   "MULTIPLE_ACTIVITYCODE" => $mulActivitycode[$i],
		   "FLAG"                  => '0',
		   "MULT_ACTIVITY_BLOCK"   => 'NO',
		   "CREATED_BY"            => $createdBy,
			
      );
        	
      $saveData = DB::table('MASTER_EMPPOSACTIVITY')->insert($data);
     
   }

   if($saveData) {

	 $request->session()->flash('alert-success', 'Employee Position Activity is Successfully Saved...!');
	 
	 return redirect('/Master/Employee/View-Emp-Position-Activity-Mast');

   }else{

	 $request->session()->flash('alert-error', 'Employee Position Activity Can Not Added...!');
	
	 return redirect('/Master/Employee/View-Emp-Position-Activity-Mast');

   }
}

public function ViewEmployeePosActivity(Request $request){

   $compName = $request->session()->get('company_name');

	if($request->ajax()){
         
      $title    = 'View Employee Position Activity';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

	   if($userType=='admin'){

	    	  $data = DB::table('MASTER_EMPPOSACTIVITY')->groupBy('POSITION_CODE');

	   }else if ($userType=='superAdmin' || $userType=='user') {    		
            $data = DB::table('MASTER_EMPPOSACTIVITY')->groupBy('POSITION_CODE');

	   }
	    	else{

	    	  $data ='';

	   }


    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

    	  return view('admin.finance.master.employee.view_emp_pos_activity');

	}else{
		return redirect('/useractivity');
	}

}

public function DeleteEmpPosActivity(Request $request){

	$posActivity = $request->input('mulActivity');
    	
   if ($posActivity!='') {
    		
    	try{

	    	$Delete = DB::table('MASTER_EMPPOSACTIVITY')->where('POSITION_CODE', $posActivity)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Employee 
					Position Activity is Deleted Successfully...!');
				return redirect('/Master/Employee/View-Emp-Position-Activity-Mast');

			}else{

				$request->session()->flash('alert-error', 'Employee Position Activity Can Not Deleted...!');
				return redirect('/Master/Employee/View-Emp-Position-Activity-Mast');
	          
	          }

		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Employee Position Activity Can not be Deleted...! Used In Another Transaction...!');
			
			return redirect('/Master/Employee/View-Emp-Position-Activity-Mast');
		}

   }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
		return redirect('/Master/Employee/View-Emp-Position-Activity-Mast');

   }

}

public function EmpMulPosActivity(Request $request){

   $posCode = $request->posId;

   $response_array = array();
    	

	if ($request->ajax()) {
		
		$data = DB::select("SELECT MULTIPLE_ACTIVITYCODE FROM `MASTER_EMPPOSACTIVITY` WHERE (POSITION_CODE='$posCode')");

	   if ($data) {

			$response_array['response'] = 'success';

		   $response_array['data'] = $data;
		       
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

public function EditEmpPosActivity($position_code){

 	$title = 'Edit Position Activity Master';

 	$positionCode = base64_decode($position_code);
 	
 	if($positionCode!=''){
	
	$mulPos1 = DB::table('MASTER_EMPPOSACTIVITY')->select('MULTIPLE_ACTIVITYCODE')->where('POSITION_CODE',$positionCode)->get()->toArray();

	$mulPos = json_decode( json_encode($mulPos1), true);

	$arr = [];

	foreach ($mulPos as $key) {
		
		$arr[] = $key['MULTIPLE_ACTIVITYCODE'];
	}
       
   $position_code   = $positionCode;
   $activity_list = DB::table('MASTER_EMPACTIVITY')->orderBy('ACTIVITY_CODE','DESC')->get();

	$mulActivityCode = $arr;

	$positionAct_block1 =  DB::table('MASTER_EMPPOSACTIVITY')->where('POSITION_CODE',$positionCode)->get()->first();

	$positionAct_block = $positionAct_block1->MULT_ACTIVITY_BLOCK;
	$position_name = $positionAct_block1->POSITION_NAME;
	
	$button='Update';
	$action='/Master/Employee/form-emp-pos-activity-update';
	$position_list = DB::table('MASTER_EMPPOSITION')->orderBy('POSITION_CODE','DESC')->get();

     return view('admin.finance.master.employee.emp_position_activity',compact('title','position_code','mulActivityCode','button','action','position_list','positionAct_block','position_name','activity_list'));

   }else{

		$request->session()->flash('alert-error', 'Employee Activity Not Found...!');
		
		return redirect('/Master/Employee/view-emp-pos_activity');
	}

}

public function EmpPosActivityUpdate(Request $request){

	$validate = $this->validate($request, [

		'position_code' => 'required',
		'mult_activity_code' => 'required',

	]);

	$position_code = $request->input('posAct_code');

	date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d H:i:s");
	
	$createdBy   = $request->session()->get('userid');
	
	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');

	$mulActivitycode = $request->input('mult_activity_code');
 
 	$count = count($mulActivitycode);

	$saveData ='';

	$saveData = DB::table('MASTER_EMPPOSACTIVITY')->where('POSITION_CODE', $position_code)->delete();

  	for ($i=0; $i < $count ; $i++) { 

   	$data = array(

      "POSITION_CODE"         => $request->input('position_code'),
      "POSITION_NAME"         => $request->input('pos_name'),
	   "MULTIPLE_ACTIVITYCODE" => $mulActivitycode[$i],
	   "FLAG"                  => '0',
	   "MULT_ACTIVITY_BLOCK"   => $request->input('positionAct_block'),
	   "UPDATED_BY"            => $createdBy,
	   "UPDATED_DATE"      => $updatedDate,
		
      );
   	
      $saveData = DB::table('MASTER_EMPPOSACTIVITY')->insert($data);
   }       
	
	try{

	 if($saveData){

		$request->session()->flash('alert-success', 'Employee Position Activity is Successfully Updated...!');
		return redirect('/Master/Employee/View-Emp-Position-Activity-Mast');

	 }else{

		$request->session()->flash('alert-error', 'Employee Position Activity Can Not Added...!');
		return redirect('/Master/Employee/View-Emp-Position-Activity-Mast');

	 }

	}catch(Exception $ex){

	  $request->session()->flash('alert-error', 'Employee Position Activity Can not be Updated...! Used In Another Transaction...!');
	  
	  return redirect('/Master/Employee/View-Emp-Position-Activity-Mast');
	}

}


/*---end Position Activity master*/

/*---Start City Class master*/

public function AddEmpCityClass(Request $request){

	$title = 'Employee City Class Master';

	$compName = $request->session()->get('company_name');

	$city_code = $request->old('city_code');

	$city_class = $request->old('city_class');

	$button='Save';

	$action='/Master/Employee/emp-city-class-save';

	if(isset($compName)){

	  return view('admin.finance.master.employee.emp_city_class',compact('title','button','action','city_code','city_class'));

	}else{

	   return redirect('/useractivity');
	}

}

public function SaveEmployeeCityClass(Request $request){
        
   $validate = $this->validate($request, [

	 'city_code' => 'required|max:6|unique:MASTER_EMPCITYCLASS,CITY_CODE',
	 'city_class' =>'required',
	 
	]);

   $createdBy 	= $request->session()->get('userid');

 	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');

 	$data = array(

    "CITY_CODE"  => $request->input('city_code'),
    "CITY_CLASS" => $request->input('city_class'),
    "FLAG"       => '0',
    "CITY_BLOCK" => 'NO',
    "CREATED_BY"  => $createdBy,
			
   );
        	
   $saveData = DB::table('MASTER_EMPCITYCLASS')->insert($data);
     
   if($saveData) {

		$request->session()->flash('alert-success', 'Employee City Class is Successfully Saved...!');
		return redirect('/Master/Employee/View-Emp-City-Class-Mast');

   }else{

	   $request->session()->flash('alert-error', 'Employee City Class Can Not Added...!');
	   
	   return redirect('/Master/Employee/View-Emp-City-Class-Mast');

   }
}

public function ViewEmployeeCityClass(Request $request){

   $compName = $request->session()->get('company_name');

	if($request->ajax()){
         
      $title    = 'View Employee City Class';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	  $data = DB::table('MASTER_EMPCITYCLASS')->orderBy('CITY_CODE','DESC');

    	}else if ($userType=='superAdmin' || $userType=='user') {    		
         $data = DB::table('MASTER_EMPCITYCLASS')->orderBy('CITY_CODE','DESC');

    	}
    	else{

    	  $data ='';

    	}


    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

    	  return view('admin.finance.master.employee.view_emp_city_class');

	}else{
		return redirect('/useractivity');
	}

}

public function DeleteEmpCityClass(Request $request){

	$citycode = $request->input('citycode');
    	
 	if ($citycode!='') {
 		
 		try{

    		$Delete = DB::table('MASTER_EMPCITYCLASS')->where('CITY_CODE', $citycode)->delete();

		if ($Delete) {

			$request->session()->flash('alert-success', 'Employee 
				City Class  is Deleted Successfully...!');
			
			return redirect('/Master/Employee/View-Emp-City-Class-Mast');

		}else{

			$request->session()->flash('alert-error', 'Employee Position Activity Can Not Deleted...!');
			
			return redirect('/Master/Employee/View-Emp-City-Class-Mast');
          
      }

	}catch(Exception $ex){

		$request->session()->flash('alert-error', 'Employee City Class Can not be Deleted...! Used In Another Transaction...!');
		
		return redirect('/Master/Employee/View-Emp-City-Class-Mast');
	}

 	}else{

 		$request->session()->flash('alert-error', 'Zone  Not Found...!');
	   
	   return redirect('/Master/Employee/View-Emp-City-Class-Mast');

 	}

}

public function EditEmpCityClass($city_code){

 	$title = 'Edit City Code Master';

 	$citycode = base64_decode($city_code);
 	
 	if($citycode!=''){

 	   $query = DB::table('MASTER_EMPCITYCLASS');
		$query->where('CITY_CODE', $citycode);
		$classData= $query->get()->first();

		$city_code  = $classData->CITY_CODE;

		$city_class = $classData->CITY_CLASS;

		$city_block = $classData->CITY_BLOCK;

		$button ='Update';

		$action ='/Master/Employee/form-emp-city-class-update';

      return view('admin.finance.master.employee.emp_city_class',compact('title','city_code','city_class','city_block','button','action'));

   }else{

		$request->session()->flash('alert-error', 'Employee Activity Not Found...!');
		
		return redirect('/Master/Employee/View-Emp-City-Class-Mast');

   }

}

public function EmpCityClassUpdate(Request $request){

	$validate = $this->validate($request, [

		'city_code' => 'required',
		'city_class' => 'required',

	]);

	$city_code = $request->input('idCityClass');

	date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d H:i:s");
	
	$createdBy   = $request->session()->get('userid');
	
	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');

	$data = array(
			
		  "CITY_CODE"    => $request->input('city_code'),
		  "CITY_CLASS"   => $request->input('city_class'),
		  "FLAG"         => '0',
		  "CITY_BLOCK"   => $request->input('city_block'),
		  "UPDATED_BY"   => $createdBy,
		  "UPDATED_DATE"   => $updatedDate,
	);
		
	try{

		$saveData = DB::table('MASTER_EMPCITYCLASS')->where('CITY_CODE', $city_code)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Employee City Class is Successfully Updated...!');
			
			return redirect('/Master/Employee/View-Emp-City-Class-Mast');

		} else {

			$request->session()->flash('alert-error', 'Employee City Class Can Not Added...!');
			
			return redirect('/Master/Employee/View-Emp-City-Class-Mast');

		}

	}catch(Exception $ex){

		$request->session()->flash('alert-error', 'Employee City Class Can not be Updated...! Used In Another Transaction...!');
		
		return redirect('/Master/Employee/View-Emp-City-Class-Mast');
	}
}



/*---End City Class master*/

/*-- Start Employee KPI---*/

public function AddEmpKPI(Request $request){

	$title = 'Employee KPI Master';

	$compName = $request->session()->get('company_name');

	$kpi_code = $request->old('kpi_code');

	$kpi_name     = $request->old('kpi_name');

	$buss_goal     = $request->old('buss_goal');

	$target_source = $request->old('target_source');

	$button='Save';

	$action='/Master/Employee/emp-KPI-save';

	if(isset($compName)){

	  return view('admin.finance.master.employee.add_emp_kpi',compact('title','button','action','kpi_code','kpi_name','buss_goal','target_source'));

	}else{

	   return redirect('/useractivity');
	}

}

public function SaveEmployeeKPI(Request $request){
        
   $validate = $this->validate($request, [

	 'kpi_code' => 'required|max:6|unique:MASTER_EMPKPI,KPI_CODE',
	 'kpi_name' =>'required',
	 'buss_goal' =>'required',
	 'target_source' =>'required',
	 
	]);

   $createdBy 	= $request->session()->get('userid');

 	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');

 	$data = array(

    "KPI_CODE"  => $request->input('kpi_code'),
    "KPI_NAME" => $request->input('kpi_name'),
    "BUSINESS_GOAL" => $request->input('buss_goal'),
    "TARGET_SOURCE" => $request->input('target_source'),
    "FLAG"       => '0',
    "KPI_BLOCK" => 'NO',
    "CREATED_BY"  => $createdBy,
			
   );
        	
   $saveData = DB::table('MASTER_EMPKPI')->insert($data);
     
   if($saveData) {

	 $request->session()->flash('alert-success', 'Employee KPI is Successfully Saved...!');
	 
	 return redirect('/Master/Employee/View-Emp-KPI-Mast');

   }else{

	 $request->session()->flash('alert-error', 'Employee KPI Can Not Added...!');
	 
	 return redirect('/Master/Employee/View-Emp-KPI-Mast');

   }
}

public function ViewEmployeeKPI(Request $request){

   $compName = $request->session()->get('company_name');

	if($request->ajax()){
         
      $title    = 'View Employee KPI';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	  $data = DB::table('MASTER_EMPKPI')->orderBy('KPI_CODE','DESC');

    	}else if ($userType=='superAdmin' || $userType=='user') {    		
         $data = DB::table('MASTER_EMPKPI')->orderBy('KPI_CODE','DESC');

    	}else{

	    	  $data ='';

	   }

      return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

    	  return view('admin.finance.master.employee.view_emp_kpi');

	}else{
		
		return redirect('/useractivity');
	}

}

public function DeleteEmpKPI(Request $request){

	$kpicode = $request->input('empkpicode');
    	
   if ($kpicode!='') {
    		
 		try{

    		$Delete = DB::table('MASTER_EMPKPI')->where('KPI_CODE', $kpicode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Employee 
					KPI is Deleted Successfully...!');
				
				return redirect('/Master/Employee/View-Emp-KPI-Mast');

			}else{

				$request->session()->flash('alert-error', 'Employee KPI Can Not Deleted...!');
				
				return redirect('/Master/Employee/View-Emp-KPI-Mast');
	          
	      }
		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Employee KPI Can not be Deleted...! Used In Another Transaction...!');
			
			return redirect('/Master/Employee/View-Emp-KPI-Mast');
		}

   }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
		
		return redirect('/Master/Employee/View-Emp-KPI-Mast');

   }

}

public function EditEmpKPI($kpi_code){

 	$title = 'Edit KPI Master';

 	$kpicode = base64_decode($kpi_code);
 	
 	if($kpicode!=''){

 	   $query = DB::table('MASTER_EMPKPI');
		$query->where('KPI_CODE', $kpicode);
		$classData= $query->get()->first();

		$kpi_code  = $classData->KPI_CODE;

		$kpi_name = $classData->KPI_NAME;

		$buss_goal = $classData->BUSINESS_GOAL;

		$target_source = $classData->TARGET_SOURCE;

		$kpi_block = $classData->KPI_BLOCK;

		$button ='Update';

		$action ='/Master/Employee/form-emp-KPI-update';

	   return view('admin.finance.master.employee.add_emp_kpi',compact('title','kpi_code','kpi_name','buss_goal','target_source','kpi_block','button','action'));

	}else{

		$request->session()->flash('alert-error', 'Employee KPI Not Found...!');
		return redirect('/Master/Employee/View-Emp-KPI-Mast');

	}

}

public function EmpKPIUpdate(Request $request){

   $validate = $this->validate($request, [

	 'kpi_code'      => 'required',
	 'kpi_name'     =>'required',
	 'buss_goal'     =>'required',
	 'target_source' =>'required',
	 
	]);

	$kpi_code = $request->input('idKpi_code');

	date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d H:i:s");
	
	$createdBy   = $request->session()->get('userid');
	
	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');

	$data = array(

     "KPI_CODE"   => $request->input('kpi_code'),
	  "KPI_NAME"   => $request->input('kpi_name'),
	  "BUSINESS_GOAL"  => $request->input('buss_goal'),
	  "TARGET_SOURCE" => $request->input('target_source'),
	  "FLAG"       => '0',
	  "KPI_BLOCK"  => $request->input('kpi_block'),
	  "UPDATED_BY"  => $createdBy,
	  "UPDATED_DATE"  => $updatedDate,
			
   );
		
	try{


		$saveData = DB::table('MASTER_EMPKPI')->where('KPI_CODE', $kpi_code)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Employee KPI is Successfully Updated...!');
			
			return redirect('/Master/Employee/View-Emp-KPI-Mast');

		} else {

			$request->session()->flash('alert-error', 'Employee KPI Can Not Added...!');
			
			return redirect('/Master/Employee/View-Emp-KPI-Mast');

		}

	}catch(Exception $ex){

		$request->session()->flash('alert-error', 'Employee KPI Can not be Updated...! Used In Another Transaction...!');
		
		return redirect('/Master/Employee/View-Emp-KPI-Mast');
	}
}

/*---End Employee KPI*---/

/*---Start Employee Eligible--- */

public function AddEmpTourEligible(Request $request){

	$title = 'Employee Tour Eligible';

	$compName = $request->session()->get('company_name');

	$grade = $request->old('grade');

	$gradeName  = $request->old('gradeName');

	$city_code = $request->old('city_code');
	
	$city_class = $request->old('city_class');
	$city_name = $request->old('city_name');

   $city_gradeList = DB::table('MASTER_EMPCITYCLASS')->orderBy('CITY_CLASS','DESC')->get();

   $gradeList = DB::table('MASTER_GRADE')->get();

	$city_list = $city_gradeList;

	$expenditure_head     = $request->old('expenditure_head');

	$eligible_amt     = $request->old('eligible_amt');
	
	$button='Save';

	$action='/Master/Employee/Emp-Tour-Eligible-Save';

	if(isset($compName)){

	  return view('admin.finance.master.employee.add_emp_tour_eligible',compact('title','button','action','grade','city_list','city_code','city_class','expenditure_head','eligible_amt','gradeList','gradeName','city_name'));

	}else{

	   return redirect('/useractivity');
	}

}

public function SaveEmpTourEligible(Request $request){
        
   $validate = $this->validate($request, [

	 'grade' => 'required',
	 'city_code' =>'required',
	 'expenditure_head' =>'required',
	 'eligible_amt' =>'required',
	 
	]);

    $createdBy 	= $request->session()->get('userid');

 	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');
 	$city_name = $request->input('city_name');

 	// print_r($city_name);exit();

 	$data = array(

		"GRADE"          => $request->input('grade'),
		"GRADE_NAME"     => $request->input('grade_name'),
		"CITY_CODE"      => $request->input('city_code'),
		"CITY_CLASS"     => $request->input('city_name'),
		"EXPHEAD"        => $request->input('expenditure_head'),
		"ELIGAMT"        => $request->input('eligible_amt'),
		"FLAG"           => '0',
		"BLOCK_TOURELIG" => 'NO',
		"CREATED_BY"     => $createdBy,
	
	);
   //print_r($data);exit();
   $saveData = DB::table('MASTER_EMPTOURELIGIBLE')->insert($data);
     
   if($saveData) {

	  $request->session()->flash('alert-success', 'Employee Tour Eligible is Successfully Saved...!');
	  
	  return redirect('/Master/Employee/View-Emp-Tour-Eligible-Mast');

   }else{

	  $request->session()->flash('alert-error', 'Employee KPI Can Not Added...!');
	  
	  return redirect('/Master/Employee/View-Emp-Tour-Eligible-Mast');

   }
}

public function ViewEmpTourEligible(Request $request){

   $compName = $request->session()->get('company_name');

	if($request->ajax()){
         
      $title    = 'View Employee Tour Eligible';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	  $data = DB::table('MASTER_EMPTOURELIGIBLE')->orderBy('GRADE','DESC');

    	}else if ($userType=='superAdmin' || $userType=='user') {    		
         $data = DB::table('MASTER_EMPTOURELIGIBLE')->orderBy('GRADE','DESC');

    	}
    	else{

    	  $data ='';

    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

    	  return view('admin.finance.master.employee.view_emp_tourEligible');

	}else{

		return redirect('/useractivity');
	}

}

public function DeleteEmpTourEligible(Request $request){

	$tourEligid = $request->input('tourEligId');
    	
 	if ($tourEligid!='') {
 		
 		try{

    		$Delete = DB::table('MASTER_EMPTOURELIGIBLE')->where('TOURELIGID', $tourEligid)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Employee 
					Tour Eligible is Deleted Successfully...!');
				
				return redirect('/Master/Employee/View-Emp-Tour-Eligible-Mast');

			}else{

				$request->session()->flash('alert-error', 'Employee Tour Eligible Can Not Deleted...!');
				
				return redirect('/Master/Employee/View-Emp-Tour-Eligible-Mast');
	          
	      }

	}catch(Exception $ex){

		$request->session()->flash('alert-error', 'Employee Tour Eligible Can not be Deleted...! Used In Another Transaction...!');
		
		return redirect('/Master/Employee/View-Emp-Tour-Eligible-Mast');
	}

 	}else{

 		$request->session()->flash('alert-error', 'Zone  Not Found...!');
	   return redirect('/Master/Employee/View-Emp-Tour-Eligible-Mast');

 	}

}

public function EditEmpTourEligible($tourEligId){

 	$title = 'Edit Tour Eligible Master';

 	$tourElig_Id = base64_decode($tourEligId);
 	
 	if($tourElig_Id!=''){

 		$city_gradeList = DB::table('MASTER_EMPCITYCLASS')->orderBy('CITY_CLASS','DESC')->get();

      $city_list = $city_gradeList;

 	   $classData = DB::table('MASTER_EMPTOURELIGIBLE')->where('TOURELIGID', $tourElig_Id)->get()->first();

 	   $tourEligId       = $classData->TOURELIGID ;

		$grade            = $classData->GRADE;

		$gradeName        = $classData->GRADE_NAME;

		$city_code        = $classData->CITY_CODE;

		$city_class       = $classData->CITY_CLASS;

		$expenditure_head = $classData->EXPHEAD;

		$eligible_amt     = $classData->ELIGAMT;

		$tourElig_block   = $classData->BLOCK_TOURELIG;

		$button ='Update';

		$action ='/Master/Employee/Form-Emp-Tour-Eligible-Update';

	     return view('admin.finance.master.employee.add_emp_tour_eligible',compact('title','grade','gradeName','tourEligId','city_code','city_class','expenditure_head','eligible_amt','tourElig_block','city_list','button','action'));

	}else{

		$request->session()->flash('alert-error', 'Employee KPI Not Found...!');
		
		return redirect('/Master/Employee/View-Emp-Tour-Eligible-Mast');

	}

}

public function EmpTourEligibleUpdate(Request $request){

   $validate = $this->validate($request, [

	 'grade' => 'required',
	 'city_code' =>'required',
	 'expenditure_head' =>'required',
	 'eligible_amt' =>'required',
	 
	]);
	
   $tourElig_Id = $request->input('tourElig_Id');

	date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d H:i:s");
	
	$createdBy   = $request->session()->get('userid');
	
	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');

	$data = array(

       "GRADE" 	  => $request->input('grade'),
	  "CITY_CODE"    => $request->input('city_code'),
	  "CITY_CLASS"   => $request->input('city_class'),
	  "EXPHEAD" => $request->input('expenditure_head'),
	  "ELIGAMT" => $request->input('eligible_amt'),
	  "FLAG"         => '0',
	  "BLOCK_TOURELIG" => $request->input('tourElig_block'),
	  "UPDATED_BY"  => $createdBy,
	  "UPDATED_DATE"  => $updatedDate,
			
     );
		
	try{

		$saveData = DB::table('MASTER_EMPTOURELIGIBLE')->where('TOURELIGID', $tourElig_Id)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Employee Tour Eligible is Successfully Updated...!');
			return redirect('/Master/Employee/View-Emp-Tour-Eligible-Mast');

		} else {

			$request->session()->flash('alert-error', 'Employee Tour Eligible Can Not Added...!');
			return redirect('/Master/Employee/View-Emp-Tour-Eligible-Mast');

		}

	}catch(Exception $ex){

		$request->session()->flash('alert-error', 'Employee Tour Eligible Can not be Updated...! Used In Another Transaction...!');
		return redirect('/Master/Employee/View-Emp-Tour-Eligible-Mast');
	}
}


/*---End Employee Tour Eligible-----*/

/*--Start Employee KRA--*/

public function AddEmpKRA(Request $request){

	$title = 'Employee KRA Master';

	$compName = $request->session()->get('company_name');

	$kra_code = $request->old('kra_code');

	$kra_name = $request->old('kra_name');

	$weight   = $request->old('weight');
	
	$button='Save';

	$action='/Master/Employee/emp-KRA-save';

	if(isset($compName)){

	  return view('admin.finance.master.employee.add_emp_kra',compact('title','button','action','kra_code','kra_name','weight'));

	}else{

	   return redirect('/useractivity');
	}

}

public function SaveEmployeeKRA(Request $request){
        
   $validate = $this->validate($request, [

	 'kra_code' => 'required|max:6|unique:MASTER_EMPKRA,KRA_CODE',
	 'kra_name' =>'required',
	 'weight' =>'required',
	 
	]);

   $createdBy 	= $request->session()->get('userid');

 	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');

 	$data = array(

    "KRA_CODE"  => $request->input('kra_code'),
    "KRA_NAME"  => $request->input('kra_name'),
    "WEIGHT"    => $request->input('weight'),
    "FLAG"      => '0',
    "KRA_BLOCK" => 'NO',
    "CREATED_BY" => $createdBy,
		
   );
        	
   $saveData = DB::table('MASTER_EMPKRA')->insert($data);
     
   if($saveData) {

		 $request->session()->flash('alert-success', 'Employee KRA is Successfully Saved...!');
		 
		 return redirect('/Master/Employee/View-Emp-KRA-Mast');

    }else{

		 $request->session()->flash('alert-error', 'Employee KRA Can Not Added...!');
		
		 return redirect('/Master/Employee/View-Emp-KRA-Mast');

     }
}

public function ViewEmployeeKRA(Request $request){

   $compName = $request->session()->get('company_name');

	if($request->ajax()){
         
      $title    = 'View Employee KPI';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	  $data = DB::table('MASTER_EMPKRA')->orderBy('KRA_CODE','DESC');

    	}else if ($userType=='superAdmin' || $userType=='user') {    		
         $data = DB::table('MASTER_EMPKRA')->orderBy('KRA_CODE','DESC');

    	}
    	else{

    	  $data ='';

    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

    	  return view('admin.finance.master.employee.view_emp_kra');

	}else{

		return redirect('/useractivity');
	}

}

public function DeleteEmpKRA(Request $request){

	$kracode = $request->input('empkracode');
    	
   if ($kracode!='') {
    		
    	try{

	    		$Delete = DB::table('MASTER_EMPKRA')->where('KRA_CODE', $kracode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Employee 
					KRA is Deleted Successfully...!');
				return redirect('/Master/Employee/View-Emp-KRA-Mast');

			}else{

				$request->session()->flash('alert-error', 'Employee KRA Can Not Deleted...!');
				return redirect('/Master/Employee/View-Emp-KRA-Mast');
	          
	      }

		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Employee KRA Can not be Deleted...! Used In Another Transaction...!');
			
			return redirect('/Master/Employee/View-Emp-KRA-Mast');
		}

   }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
		
		return redirect('/Master/Employee/View-Emp-KRA-Mast');

   }

}

public function EditEmpKRA($kra_code){

 	$title = 'Edit KRA Master';

 	$kracode = base64_decode($kra_code);
 	
 	if($kracode!=''){

 	   $query = DB::table('MASTER_EMPKRA');
		$query->where('KRA_CODE', $kracode);
		$classData= $query->get()->first();

		$kra_code  = $classData->KRA_CODE;

		$kra_name = $classData->KRA_NAME;

		$weight = $classData->WEIGHT;

		$kra_block = $classData->KRA_BLOCK;

		$button ='Update';

		$action ='/Master/Employee/form-emp-KRA-update';

      return view('admin.finance.master.employee.add_emp_kra',compact('title','kra_code','kra_name','weight','kra_block','button','action'));

	}else{

		$request->session()->flash('alert-error', 'Employee KRA Not Found...!');
		return redirect('/Master/Employee/View-Emp-KRA-Mast');

	}

}

public function EmpKRAUpdate(Request $request){

   $validate = $this->validate($request, [

	 'kra_code' => 'required',
	 'kra_name' =>'required',
	 'weight'   =>'required',
	 
	]);

	$kra_code = $request->input('idKra_code');

	date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d H:i:s");
	
	$createdBy   = $request->session()->get('userid');
	
	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');

	$data = array(

      "KRA_CODE"   => $request->input('kra_code'),
	   "KRA_NAME"   => $request->input('kra_name'),
	   "WEIGHT"     => $request->input('weight'),
	   "FLAG"       => '0',
	   "KRA_BLOCK"  => $request->input('kra_block'),
	   "UPDATED_BY" => $createdBy,
	   "UPDATED_DATE" => $updatedDate,
			
   );
		
	try{

		$saveData = DB::table('MASTER_EMPKRA')->where('KRA_CODE', $kra_code)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Employee KRA is Successfully Updated...!');
			
			return redirect('/Master/Employee/View-Emp-KRA-Mast');

		} else {

			$request->session()->flash('alert-error', 'Employee KRA Can Not Added...!');
			
			return redirect('/Master/Employee/View-Emp-KRA-Mast');

		}
	}catch(Exception $ex){

		$request->session()->flash('alert-error', 'Employee KRA Can not be Updated...! Used In Another Transaction...!');
		
		return redirect('/Master/Employee/View-Emp-KRA-Mast');
	}
}

/*---End Employee KRA--*/

/*--Start Mode of Transport--*/

public function AddModeOfTransport(Request $request){

	$title = 'Mode Of Transport Master';

	$compName = $request->session()->get('company_name');

	$grade_code = $request->old('grade_code');

	$grade_name = $request->old('grade_name');
	
	$transportId = $request->old('transportId');

	$mode_of_transport = $request->old('mode_of_transport');

	$grade_list = DB::table('MASTER_GRADE')->get();

	$button='Save';

	$action='/Master/ModeOfTransport/emp-mode-of-transport-save';

	if(isset($compName)){

	  return view('admin.finance.master.employee.add_mode_of_transport',compact('title','button','action','grade_code','mode_of_transport','grade_name','grade_list','transportId'));

	}else{

	   return redirect('/useractivity');
	}

}

public function SaveModeOfTransport(Request $request){
        
   $validate = $this->validate($request, [

	 'grade_code' => 'required',
	 'mode_of_transport' =>'required',
	 
	 
	]);

   $createdBy 	= $request->session()->get('userid');

 	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');

 	$getcomcode    = explode('-', $compName);

   $comp_code = $getcomcode[0];
   
   $comp_name = $getcomcode[1];

   $gradecode = $request->input('grade_code');

   $modeTransport = $request->input('mode_of_transport');

 	$checkData = DB::table('MASTER_MODEOFTRANSPORT')->where('COMP_CODE', $comp_code)->where('GRADE_CODE', $gradecode)->where('TRANSPORT_MODE', $modeTransport)->get();
 	
 	$dataCount = count($checkData);

 	if($dataCount == 0){

 		$data = array(

	    "COMP_CODE"   => $comp_code,
	    "COMP_NAME"   => $comp_name,
	    "FY_CODE"     => $fisYear,
	    "GRADE_CODE"  => $gradecode,
	    "GRADE_NAME"  => $request->input('grade_name'),
	    "TRANSPORT_MODE"    => $modeTransport,
	    "FLAG"      => '0',
	    "TRANSPORT_BLOCK" => 'NO',
	    "CREATED_BY" => $createdBy,
			
	   );

	   $saveData = DB::table('MASTER_MODEOFTRANSPORT')->insert($data);
     
	   if($saveData) {

			 $request->session()->flash('alert-success', 'Mode of Transport is Successfully Saved...!');
			 
			 return redirect('/Master/ModeOfTransport/View-Emp-Mode-of-Transport-Mast');

	    }else{

			 $request->session()->flash('alert-error', 'Mode of Transport Can Not Added...!');
			
			 return redirect('/Master/ModeOfTransport/View-Emp-Mode-of-Transport-Mast');

	     }

 	}else{

 		$request->session()->flash('alert-error', 'Mode of Transport Can Not Added...!');
		
		return redirect('/Master/ModeOfTransport/View-Emp-Mode-of-Transport-Mast');

 	}
 	
}

public function ViewModeOfTransport(Request $request){

   $compName = $request->session()->get('company_name');

	if($request->ajax()){
         
      $title    = 'View Mode of Transport';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

		$getcomcode    = explode('-', $compName);

   	$comp_code = $getcomcode[0];

    	if($userType=='admin'){

    	  $data = DB::table('MASTER_MODEOFTRANSPORT')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('ID','DESC');

    	}else if ($userType=='superAdmin' || $userType=='user') {    		
        $data = DB::table('MASTER_MODEOFTRANSPORT')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('ID','DESC');

    	}
    	else{

    	  $data ='';

    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

    	  return view('admin.finance.master.employee.view_mode_of_transport');

	}else{

		return redirect('/useractivity');
	}

}

public function DeleteModeOfTransport(Request $request){

	$transportId = $request->input('modeTranstId');
    	
   if ($transportId!='') {
    		
    	try{

	    		$Delete = DB::table('MASTER_MODEOFTRANSPORT')->where('ID', $transportId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Mode of Transport is Deleted Successfully...!');
				return redirect('/Master/ModeOfTransport/View-Emp-Mode-of-Transport-Mast');

			}else{

				$request->session()->flash('alert-error', 'Mode of Transport Can Not Deleted...!');
				return redirect('/Master/ModeOfTransport/View-Emp-Mode-of-Transport-Mast');
	          
	      }

		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Mode of Transport Can not be Deleted...! Used In Another Transaction...!');
			
			return redirect('/Master/ModeOfTransport/View-Emp-Mode-of-Transport-Mast');
		}

   }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
		
		return redirect('/Master/ModeOfTransport/View-Emp-Mode-of-Transport-Mast');

   }

}

public function EditModeOfTransport($transportId){

 	$title = 'Edit Mode of Transport Master';

 	$transportId = base64_decode($transportId);
 	
 	if($transportId!=''){

 	   $query = DB::table('MASTER_MODEOFTRANSPORT');
		$query->where('ID', $transportId);
		$classData= $query->get()->first();

		$grade_code  = $classData->GRADE_CODE;

		$grade_name = $classData->GRADE_NAME;

		$mode_of_transport  = $classData->TRANSPORT_MODE;

		$transport_block = $classData->TRANSPORT_BLOCK;
		$transportId  = $classData->ID;
		$grade_list = DB::table('MASTER_GRADE')->get();

		$button ='Update';

		$action ='/Master/ModeOfTransport/form-emp-mode-of-transport-update';

      return view('admin.finance.master.employee.add_mode_of_transport',compact('title','grade_code','grade_name','transport_block','button','action','grade_list','mode_of_transport','transportId'));

	}else{

		$request->session()->flash('alert-error', 'Mode of Transport Not Found...!');
		return redirect('/Master/ModeOfTransport/View-Emp-Mode-of-Transport-Mast');

	}

}

public function UpdateModeOfTransport(Request $request){

   $validate = $this->validate($request, [

	 'grade_code' => 'required',
	 'mode_of_transport' =>'required',
	 
	 
	]);

   $createdBy 	= $request->session()->get('userid');

 	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');

 	$getcomcode    = explode('-', $compName);

   $comp_code = $getcomcode[0];
   
   $comp_name = $getcomcode[1];

   $gradecode = $request->input('grade_code');

   $id = $request->input('transportId');

   $modeTransport = $request->input('mode_of_transport');

 	$checkData = DB::table('MASTER_MODEOFTRANSPORT')->where('COMP_CODE', $comp_code)->where('GRADE_CODE', $gradecode)->where('TRANSPORT_MODE', $modeTransport)->get();
 	
 	$dataCount = count($checkData);
 	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

 	if($dataCount == 0){

 		$data = array(

	    "COMP_CODE"   => $comp_code,
	    "COMP_NAME"   => $comp_name,
	    "FY_CODE"     => $fisYear,
	    "GRADE_CODE"  => $gradecode,
	    "GRADE_NAME"  => $request->input('grade_name'),
	    "TRANSPORT_MODE"    => $modeTransport,
	    "FLAG"      => '0',
	    "TRANSPORT_BLOCK" =>$request->input('transport_block'),
	    "UPDATED_BY" => $createdBy,
	    "UPDATED_DATE" => $updatedDate,
			
	   );

	   $saveData = DB::table('MASTER_MODEOFTRANSPORT')->where('ID',$id)->update($data);
     
	   if($saveData) {

			 $request->session()->flash('alert-success', 'Mode of Transport is Update Successfully ');
			 
			 return redirect('/Master/ModeOfTransport/View-Emp-Mode-of-Transport-Mast');

	    }else{

			 $request->session()->flash('alert-error', 'Mode of Transport Can Not Added...!');
			
			 return redirect('/Master/ModeOfTransport/View-Emp-Mode-of-Transport-Mast');

	     }

 	}else{

 		$request->session()->flash('alert-error', 'Mode of Transport Can Not Added...!');
		
		return redirect('/Master/ModeOfTransport/View-Emp-Mode-of-Transport-Mast');

 	}
}

/*---End Mode of Transport----*/

/*--Start Hotel Master-*/

public function AddHotel(Request $request){

	$title = 'Hotel Master';

	$compName = $request->session()->get('company_name');

	$grade_code = $request->old('grade_code');

	$grade_name = $request->old('grade_name');
	
	$hotelId = $request->old('hotelId');

	$hotel = $request->old('hotel');

	$grade_list = DB::table('MASTER_GRADE')->get();

	$button='Save';

	$action='/Master/Hotel/emp-hotel-save';

	if(isset($compName)){

	  return view('admin.finance.master.employee.add_hotel',compact('title','button','action','grade_code','hotel','grade_name','grade_list','hotelId'));

	}else{

	   return redirect('/useractivity');
	}

}

public function SaveHotel(Request $request){
        
   $validate = $this->validate($request, [

	 'grade_code' => 'required',
	 'hotel' =>'required',
	 
	 
	]);

	$createdBy 	= $request->session()->get('userid');
	
	$compName 	= $request->session()->get('company_name');
	
	$fisYear 	=  $request->session()->get('macc_year');
	
	$getcomcode    = explode('-', $compName);
	
	$comp_code = $getcomcode[0];
	
	$comp_name = $getcomcode[1];
	
	$gradecode = $request->input('grade_code');
	
	$hotel = $request->input('hotel');

 	$checkData = DB::table('MASTER_HOTEL')->where('COMP_CODE', $comp_code)->where('GRADE_CODE', $gradecode)->where('HOTEL', $hotel)->get();
 	
 	$dataCount = count($checkData);

 	if($dataCount == 0){

 		$data = array(

	    "COMP_CODE"   => $comp_code,
	    "COMP_NAME"   => $comp_name,
	    "FY_CODE"     => $fisYear,
	    "GRADE_CODE"  => $gradecode,
	    "GRADE_NAME"  => $request->input('grade_name'),
	    "HOTEL"       => $hotel,
	    "FLAG"      => '0',
	    "HOTEL_BLOCK" => 'NO',
	    "CREATED_BY" => $createdBy,
			
	   );

	   $saveData = DB::table('MASTER_HOTEL')->insert($data);
     
	   if($saveData) {

			 $request->session()->flash('alert-success', 'Hotel is Successfully Saved...!');
			 
			 return redirect('/Master/Hotel/View-Emp-Hotel-Mast');

	    }else{

			 $request->session()->flash('alert-error', 'Hotel Can Not Added...!');
			
			 return redirect('/Master/Hotel/View-Emp-Hotel-Mast');

	     }

 	}else{

 		$request->session()->flash('alert-error', 'Hotel Can Not Added...!');
		
		return redirect('/Master/Hotel/View-Emp-Hotel-Mast');

 	}
 	
}

public function ViewHotel(Request $request){

   $compName = $request->session()->get('company_name');

	if($request->ajax()){
         
		$title    = 'View Hotel';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$getcomcode    = explode('-', $compName);
		
		$comp_code = $getcomcode[0];
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	  $data = DB::table('MASTER_HOTEL')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('ID','DESC');

    	}else if ($userType=='superAdmin' || $userType=='user') { 

          $data = DB::table('MASTER_HOTEL')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('ID','DESC');


    	}
    	else{

    	  $data ='';

    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

    	  return view('admin.finance.master.employee.view_hotel');

	}else{

		return redirect('/useractivity');
	}

}

public function DeleteHotel(Request $request){

	$hotelId = $request->input('hotelId');
    	
   if ($hotelId!='') {
    		
    	try{

	    		$Delete = DB::table('MASTER_HOTEL')->where('ID', $hotelId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Hotel is Deleted Successfully...!');
				return redirect('/Master/Hotel/View-Emp-Hotel-Mast');

			}else{

				$request->session()->flash('alert-error', 'Hotel Can Not Deleted...!');
				return redirect('/Master/Hotel/View-Emp-Hotel-Mast');
	          
	      }

		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Hotel Can not be Deleted...! Used In Another Transaction...!');
			
			return redirect('/Master/Hotel/View-Emp-Hotel-Mast');
		}

   }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
		
		return redirect('/Master/Hotel/View-Emp-Hotel-Mast');

   }

}

public function EditHotel($hotelId){

 	$title = 'Edit Hotel Master';

 	$hotelId = base64_decode($hotelId);
 	
 	if($hotelId!=''){

 	   $query = DB::table('MASTER_HOTEL');
		$query->where('ID', $hotelId);
		$classData= $query->get()->first();

		$grade_code  = $classData->GRADE_CODE;

		$grade_name = $classData->GRADE_NAME;

		$hotel  = $classData->HOTEL;

		$hotel_block = $classData->HOTEL_BLOCK;
		$hotelId  = $classData->ID;
		$grade_list = DB::table('MASTER_GRADE')->get();

		$button ='Update';

		$action ='/Master/Hotel/form-emp-hotel-update';

      return view('admin.finance.master.employee.add_hotel',compact('title','grade_code','grade_name','hotel','button','action','grade_list','hotel_block','hotelId'));

	}else{

		$request->session()->flash('alert-error', 'Hotel Not Found...!');
		return redirect('/Master/Hotel/View-Emp-Hotel-Mast');

	}

}

public function UpdateHotel(Request $request){

   $validate = $this->validate($request, [

	 'grade_code' => 'required',
	 'hotel' =>'required',
	 
	 
	]);

   $createdBy 	= $request->session()->get('userid');

 	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');

 	$getcomcode    = explode('-', $compName);

   $comp_code = $getcomcode[0];
   
   $comp_name = $getcomcode[1];

   $gradecode = $request->input('grade_code');

   $id = $request->input('hotelId');
   $hotelBlock = $request->input('hotel_block');
   // print_r($hotelBlock);

   $hotel = $request->input('hotel');

 	$checkData = DB::table('MASTER_HOTEL')->where('COMP_CODE', $comp_code)->where('GRADE_CODE', $gradecode)->where('HOTEL', $hotel)->get();
 	
 	$dataCount = count($checkData);
 	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

 	if($dataCount == 0){

 		$data = array(

	    "COMP_CODE"   => $comp_code,
	    "COMP_NAME"   => $comp_name,
	    "FY_CODE"     => $fisYear,
	    "GRADE_CODE"  => $gradecode,
	    "GRADE_NAME"  => $request->input('grade_name'),
	    "HOTEL"       => $hotel,
	    "FLAG"        => '0',
	    "HOTEL_BLOCK" => $hotelBlock,
	    "UPDATED_BY"  => $createdBy,
	    "UPDATED_DATE"  => $updatedDate,
			
	   );
	   // echo '<PRE>';
	   // print_r($data);
 	


	   $saveData = DB::table('MASTER_HOTEL')->where('ID',$id)->update($data);
     
	   if($saveData) {

			 $request->session()->flash('alert-success', 'Hotel is Update Successfully ');
			 
			 return redirect('/Master/Hotel/View-Emp-Hotel-Mast');

	    }else{

			 $request->session()->flash('alert-error', 'Hotel Can Not Added...!');
			
			 return redirect('/Master/Hotel/View-Emp-Hotel-Mast');

	     }

 	}else{

 		$request->session()->flash('alert-error', 'Hotel Can Not Added...!');
		
		return redirect('/Master/Hotel/View-Emp-Hotel-Mast');

 	}
}

/*----End Hotel Master--*/

/*EMP PAY MASTER*/

// start emp-pay-master

public function EmpPayMaster(Request $request){

	$CompanyCode   = $request->session()->get('company_name');

	$MaccYear      = $request->session()->get('macc_year');

	$getcomcode    = explode('-', $CompanyCode);

	$comp_code = $getcomcode[0];

	$comp_name = $getcomcode[1];

	$title = 'Add Payroll Structure';

	$transData = DB::table('MASTER_VRSEQ')->where('TRAN_CODE','EP')->where('FY_CODE',$MaccYear)->where('COMP_CODE',$comp_code)->get()->first();
    	    
    if($transData){
    	    	 
		$trans_list = $transData->TRAN_CODE;
		
		$series_code = $transData->SERIES_CODE;
		
		$vrno = $transData->LAST_NO;
   
    }else{
        	
		$trans_list ='';
		
		$series_code = '';
		
		$vrno = '';
        	
    }

   $seriesData = DB::table('MASTER_CONFIG')->where('TRAN_CODE','EP')->get()->toArray();
   
   $plantData =  DB::table('MASTER_PLANT')->get();

   $empData   =  DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->get();
   // print_r($empData);exit();
   
	$leaveData =  DB::table('MASTER_LEAVETYPE')->get();
	   
	$fyData =  DB::table('MASTER_FY')->where('FY_CODE', $MaccYear)->get()->first();

	$fy_from_date = $fyData->FY_FROM_DATE;
	 
	$fy_to_date   = $fyData->FY_TO_DATE;

	$rate_list = DB::table('MASTER_RATE_VALUE')->get();

   return view('admin.finance.master.employee.emp_pay_master',compact('trans_list','series_code','seriesData','vrno','plantData','empData','leaveData','fy_from_date','fy_to_date','rate_list'));	

}

public function ViewEmpPayMaster(Request $request){

   $compName = $request->session()->get('company_name');
    
   if($request->ajax()){

        $title    = 'View Emp Pay Master';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

		$getcomcode    = explode('-', $compName);

	    $comp_code = $getcomcode[0];

	    if($userType=='admin'){

	    	$data = DB::table('MASTER_EMPWAGEHEAD')->where('COMP_CODE',$comp_code)->where('FISCAL_YEAR',$fisYear)->orderBy('ID','DESC');

	    }else if($userType=='superAdmin' || $userType=='user') {    		

	    	$data = DB::table('MASTER_EMPWAGEHEAD')->where('COMP_CODE',$comp_code)->where('FISCAL_YEAR',$fisYear)->orderBy('ID','DESC');

	    }else{

	    		$data ='';

	    }

      return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

	   return view('admin.finance.master.employee.view_emp_pay_master');

	}else{

		 return redirect('/useractivity');
	}

}

public function GradecodePay(Request $request){

   $emp_grade=$request->emp_grade;

   $emp_code=$request->emp_code;

   $compName   = $request->session()->get('company_name');

 	$fisYear  =  $request->session()->get('macc_year');

 	$getcomcode    = explode('-', $compName);

	$comp_code = $getcomcode[0];  
        
   $response_array = array();

   if ($request->ajax()) {
		
		$fetch_reocrd = DB::table('MASTER_WAGE_TYPE')->where('GRADE_CODE', $emp_grade)->where('FY_CODE',$fisYear)->where('COMP_CODE',$comp_code)->get();

	   $fetch_reocrd1 = DB::table('MASTER_EMPWAGEHEAD')->where('EMP_CODE', $emp_code)->where('FISCAL_YEAR',$fisYear)->where('COMP_CODE',$comp_code)->get()->first();

	   if($fetch_reocrd1 == ''){

	    	 	$array1 = array(
				'wagetype_data'    => $fetch_reocrd,
				);

	   }else{
	    	 	 
	    	$emppayId = $fetch_reocrd1->ID;

	    	$fetch_reocrd2 = DB::table('MASTER_EMPWAGEBODY')->where('EMP_PAYID', $emppayId)->get();

	    	$array1 = array(

				'wagetype_data'  => $fetch_reocrd,
				'emppayData'     => $fetch_reocrd2,
				'empInfo'        => $fetch_reocrd1
			);
	   }

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

public function EmppayStructure(Request $request){

   $emppay_id=$request->emppay_id;
     
   $response_array = array();

   if ($request->ajax()) {
		
	   $fetch_reocrd = DB::table('MASTER_EMPWAGEBODY')->where('EMP_PAYID', $emppay_id)->get()->toArray();
			
    	if ($fetch_reocrd) {

    		$response_array['response'] = 'success';
	      
	      $response_array['data'] = $fetch_reocrd;

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

public function EmpDesignation(Request $request){

   $emp_code=$request->emp_code;

   $compName   = $request->session()->get('company_name');

   $fisYear 	  = $request->session()->get('macc_year');

   $getcomcode    = explode('-', $compName);
	
	$comp_code = $getcomcode[0];
        
   $response_array = array();
    	
   if ($request->ajax()){

	   $fetch_reocrd = DB::table('MASTER_EMP')->where('EMP_CODE', $emp_code)->where('COMP_CODE',$comp_code)->get()->first();

	   $plantCode = $fetch_reocrd->PLANT_CODE;

    	$fetch_reocrd1 = DB::table('MASTER_PLANT')->where('PLANT_CODE', $plantCode)->get()->first();

    	$pfctCode = $fetch_reocrd->PFCT_CODE;

    	$fetch_reocrd2 = DB::table('MASTER_PFCT')->where('PFCT_CODE', $pfctCode)->get()->first();

    	$array1 = array(
            'plant_name' => $fetch_reocrd1->PLANT_NAME,
            'pfct_name' => $fetch_reocrd2->PFCT_NAME,

    	);
        
      if ($fetch_reocrd) {

			$response_array['response'] = 'success';
         
         $response_array['data'] = $fetch_reocrd;
         
         $response_array['data1'] = $array1;
          
         $data = json_encode($response_array);

         print_r($data);

		}else{

			$response_array['response'] = 'error';
         
         $response_array['data'] = '' ;
        
         $response_array['data1'] = '' ;

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

public function SaveEmpPayMaster(Request $request){
	
	$validate = $this->validate($request, [

		'vr_date'               => 'required',
		'emp_code'              => 'required',
		'from_date'             => 'required',
		'to_date'               => 'required',
		'basic'                 => 'required'
	]);


	$headC = $request->input('head_wage_ind');

	$FilterArray = array_filter($headC);

	$HeadCount = count($FilterArray);

   $compName   = $request->session()->get('company_name');

 	$fisYear 	  = $request->session()->get('macc_year');

 	$getcomcode    = explode('-', $compName);
	
	$comp_code = $getcomcode[0];
	
	$comp_name = $getcomcode[1];

 	$createdBy  = $request->session()->get('userid');

 	$emppayData = DB::table('MASTER_EMPWAGEHEAD')->where('COMP_CODE',$comp_code)->where('FISCAL_YEAR',$fisYear)->orderBy('ID', 'DESC')->first();

 	$date = date("Y-m-d", strtotime($request->input('vr_date')));

   $from_date = date("Y-m-d", strtotime($request->input('from_date')));
  
   $to_date = date("Y-m-d", strtotime($request->input('to_date')));

   $empcode = $request->input('emp_code');

   $checkData = DB::table('MASTER_EMPWAGEHEAD')->where('COMP_CODE',$comp_code)->where('FISCAL_YEAR',$fisYear)->where('EMP_CODE',$empcode)->where('EMPPAY_BLOCK', 1)->get();
    
   $chkDataCount = count($checkData);

   if($chkDataCount == 0){

   	if(!empty($emppayData)){

 		$getID= $emppayData->ID;

 		$id=$getID+1;

    	}else{

    		$id=1;
    	}

		$flag = 1;
	      
      $data = array(
       
      "COMP_CODE"            =>   $comp_code,
      "COMP_NAME"            =>   $comp_name,
      "FISCAL_YEAR"          =>   $fisYear,
      "DATE"                 =>   $date,
      "EMP_CODE"             =>   $request->input('emp_code'),
      "EMP_NAME"             =>   $request->input('emp_name'),
      "GRADE_CODE"            =>   $request->input('emp_grade'),
      "GRADE_NAME"            =>   $request->input('grade_name'),
      "PLANT_CODE"           =>   $request->input('plant_code'),
      "PLANT_NAME"           =>   $request->input('plant_name'),
      "PFCT_CODE"            =>   $request->input('profitcen_code'),
      "PFCT_NAME"            =>   $request->input('profitcenter_name'),
      "DESIG_CODE"          =>   $request->input('designation'),
      "DESIG_NAME"          =>   $request->input('desig_name'),
      "FROM_DATE"            =>   $from_date,
      "TO_DATE"              =>   $to_date,
      "CTC"                  =>   $request->input('basic'),
      "FLAG"                 =>   $flag,
      "EMPPAY_BLOCK"         =>   'NO',
      "CREATED_BY"           =>   $createdBy,
      "UPDATED_BY"           =>   $createdBy,
	   );

	   $saveData = DB::table('MASTER_EMPWAGEHEAD')->insert($data);
	  
	   $lastid= DB::getPdo()->lastInsertId();

	   $emppayId       = $lastid;

      $emp_code       = $request->input('emp_code');

      $emp_name       = $request->input('emp_name');

      $emp_grade      = $request->input('emp_grade');

      $grade_name      = $request->input('grade_name');

      $wage_indicator = $request->input('head_wage_ind');

      $rate_indicator = $request->input('rate_code');

      $wageInd_type   = $request->input('wageInd_type');

      $wageInd_name   = $request->input('wageInd_name');

      $rate           = $request->input('rate');

      $logic          = $request->input('logic');

      $amount         = $request->input('amount');

      $monOrYr         = $request->input('wageInd_monOrYr');

      $structure_block = 1;

	   $amtCount = count($amount);

	   for($i=0; $i<$amtCount; $i++){

      	$amt = $amount[$i];

      	if($amt == ''){
      		$finalamt = '';
      	}else{
      		$finalamt = $amt;
      	}

      	$data1 = array(
	   	
	   	"EMP_PAYID"    => $emppayId,
	   	"GRADE_CODE"    => $emp_grade,
	   	"GRADE_NAME"    => $grade_name,
	   	"WAGE_IND"    	=> $wage_indicator[$i],
	   	"WAGE_INDTYPE" => $wageInd_type[$i],
	   	"WAGEIND_NAME" => $wageInd_name[$i],
	      "RATE_IND"    	=> $rate_indicator[$i],
	   	"RATE"     	=> $rate[$i],
	   	"LOGIC"     	=> $logic[$i],
	   	"AMOUNT"     	=> $finalamt,
	   	"MONTH_OR_YR"  => $monOrYr[$i],
	   	"FLAG"     	=> '0',
	   	"STRUCTURE_BLOCK"  => '0',
	   	"CREATED_BY"     => $createdBy,
	   	"UPDATED_BY"     => $createdBy,
	      );

	      $saveData1 = DB::table('MASTER_EMPWAGEBODY')->insert($data1);
	   
	   }

	   if($saveData){

			$request->session()->flash('alert-success', 'Employee Pay Save Successfully ');
			
			return redirect('/Master/Employee/View-Emp-Pay-Mast');

		}else{

			$request->session()->flash('alert-error', 'Employee Details Can Not Insert...!');
			
			return redirect('/Master/Employee/View-Emp-Pay-Mast');
      }

   }else{

   	$request->session()->flash('alert-error', ' Please Inactive Status Before CTC');
	   
	   return redirect('/Master/Employee/View-Emp-Pay-Mast');
   }
}

public function EditEmpPay($emppayId){

   $title = 'Edit Emp Pay Master';

   $plantData =  DB::table('MASTER_PLANT')->get();

   $empData   =  DB::table('MASTER_EMP')->get();

   $rate_list = DB::table('MASTER_RATE_VALUE')->get();

   $emppayId = base64_decode($emppayId);
    	
   if($emppayId!=''){
 	   
 	   $query = DB::table('MASTER_EMPWAGEHEAD');
		$query->where('ID', $emppayId);
		$classData= $query->get()->first();

		$paystruct = DB::table('MASTER_EMPWAGEBODY')->where('EMP_PAYID', $emppayId)->get()->first();
      
      return view('admin.finance.master.employee.edit_emppay_master',compact('title','classData','plantData','empData','rate_list','paystruct'));

	}else{
			
		$request->session()->flash('alert-error', 'Employee Pay Not Found...!');
		
		return redirect('/finance/view-emp-pay-master');
	}

}

public function EmppayUpdate(Request $request){


	$validate = $this->validate($request, [

		'vr_date'               => 'required',
		'emp_code'              => 'required',
		'from_date'             => 'required',
		'to_date'               => 'required',
		'basic'                 => 'required'

   ]);

       
	$headC = $request->input('head_wage_ind');

	if($headC != ''){

		$FilterArray = array_filter($headC);

   	$HeadCount = count($FilterArray);

	}else{

	}

	$emppayid = $request->input('emppayid');

	$compName 	= $request->session()->get('company_name');

	$fisYear 	=  $request->session()->get('macc_year');
	    	
   $getcomcode    = explode('-', $compName);
	
	$comp_code = $getcomcode[0];
	
	$comp_name = $getcomcode[1];

	$createdBy 	= $request->session()->get('userid');

 	$date = date("Y-m-d", strtotime($request->input('vr_date')));

   $from_date = date("Y-m-d", strtotime($request->input('from_date')));

   $to_date = date("Y-m-d", strtotime($request->input('to_date')));
   date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

	$flag = 1;

	$data = array(
         
      "COMP_CODE"            =>   $comp_code,
      "COMP_NAME"            =>   $comp_name,
      "FISCAL_YEAR"          =>   $fisYear,
	   "DATE"                 =>  $date,
	   "EMP_CODE"             =>   $request->input('emp_code'),
	   "EMP_NAME"             =>   $request->input('emp_name'),
	   "GRADE_CODE"            =>   $request->input('emp_grade'),
	   "GRADE_NAME"            =>   $request->input('grade_name'),
	   "PLANT_CODE"           =>   $request->input('plant_code'),
	   "PLANT_NAME"           =>   $request->input('plant_name'),
      "PFCT_CODE"            =>   $request->input('profitcen_code'),
	   "PFCT_NAME"            =>   $request->input('profitcenter_name'),
	   "DESIG_CODE"          =>   $request->input('designation'),
	   "DESIG_NAME"          =>   $request->input('desig_name'),
	   "FROM_DATE"            =>   $from_date,
	   "TO_DATE"              =>   $to_date,
	   "CTC"                  =>   $request->input('basic'),
	   "FLAG"                 =>   $flag,
	   "EMPPAY_BLOCK"         =>   $request->input('emppay_block'),
	   "CREATED_BY"           =>   $createdBy,
	   "UPDATED_BY"           =>   $createdBy,
	   "UPDATED_DATE"           =>   $updatedDate,
	
	);

   $saveData = DB::table('MASTER_EMPWAGEHEAD')->where('ID',$emppayid)->update($data);

   $emp_code       = $request->input('emp_code');
   $emp_name       = $request->input('emp_name');
   $emp_grade      = $request->input('emp_grade');
   $wage_indicator = $request->input('head_wage_ind');
   $rate_indicator = $request->input('rate_code');
   $wageInd_type   = $request->input('wageInd_type');
   $rate           = $request->input('rate');
   $logic          = $request->input('logic');
   $amount         = $request->input('amount');
   $structure_block = 1;

   if($amount == ''){

   }else{

   	$saveData1 = DB::table('MASTER_EMPWAGEBODY')->where('EMP_PAYID', $emppayid)->delete();

   	$amtCount = count($amount);


   	for($i=0; $i<$amtCount; $i++){

		   $amt = $amount[$i];

      	if($amt == ''){

      		$finalamt = '';

      	}else{

      		$finalamt = $amt;
      	}

      	$data1 = array(
	         	
	   	   "EMP_PAYID"    => $emppayid,
	      	"EMP_GRADE"    => $emp_grade,
	      	"WAGE_IND"    	=> $wage_indicator[$i],
	      	"WAGE_INDTYPE" => $wageInd_type[$i],
	         "RATE_IND"    	=> $rate_indicator[$i],
	      	"RATE"     	=> $rate[$i],
	      	"LOGIC"     	=> $logic[$i],
	      	"AMOUNT"     	=> $finalamt,
	      	"FLAG"     	=> '0',
	      	"STRUCTURE_BLOCK"  => '0',
	      	"CREATED_BY"       => $createdBy,
	      	"UPDATED_BY"       => $createdBy,

			);

	      $saveData2 = DB::table('MASTER_EMPWAGEBODY')->insert($data1);
         
      }
   }

	if($saveData || $amount) {

		$request->session()->flash('alert-success', 'Employee Pay Save Successfully ');
		
		return redirect('/Master/Employee/View-Emp-Pay-Mast');

	}else{

		$request->session()->flash('alert-error', 'Employee Pay Details Can Not Insert...!');
		
		return redirect('/Master/Employee/View-Emp-Pay-Mast');

	}

}

public function DeleteEmppay(Request $request){

	$emppay = $request->input('emppay');
	
		
   if ($emppay !='') {
   
   try{

	   $Delete1 = DB::table('MASTER_EMPWAGEBODY')->where('EMP_PAYID', $emppay)->delete();

	   if($Delete1){

	      $Delete = DB::table('MASTER_EMPWAGEHEAD')->where('ID', $emppay)->delete();

    	   if($Delete){

				$request->session()->flash('alert-success', 'Employee 
				Pay Was Deleted Successfully...!');
				
				return redirect('/Master/Employee/View-Emp-Pay-Mast');

			}else{

				$request->session()->flash('alert-error', 'Employee Pay Can Not Deleted...!');
				
				return redirect('/Master/Employee/View-Emp-Pay-Mast');

			}

    	}else{

			$request->session()->flash('alert-error', 'Employee Pay Can Not Deleted...!');
			
			return redirect('/Master/Employee/View-Emp-Pay-Mast');

		}

   }catch(Exception $ex){

	   $request->session()->flash('alert-error', 'Employee Pay Can not be Deleted...! Used In Another Transaction...!');
		return redirect('/Master/Employee/View-Emp-Pay-Mast');
	}

   }else{

 		$request->session()->flash('alert-error', 'Zone  Not Found...!');
		
		return redirect('/Master/Employee/View-Emp-Pay-Mast');

   }

}

// end emp-pay-master

/*END EMP PAY MASTER*/


public function SaveEmployeeMaster(Request $request){

   $validate = $this->validate($request, [

	'employee_code'      => 'required|unique:MASTER_EMP,EMP_CODE|max:6',
	'employee_name'      => 'required|regex:/^[\pL\s\-]+$/u|max:40',
	'date_of_birth'      => 'required',
	'gender'             => 'required',
	'emp_email'          => 'required|email',
	'emp_mobile'         => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
	'adhar_no'           => 'required|max:12',
	'pan_no'             => 'required|max:10',
	'bankName'           => 'required|regex:/^[\pL\s\-]+$/u|max:40',
	'branch_name'        => 'required|regex:/^[\pL\s\-]+$/u|max:40',
	'bank_ifsc'          => 'required|max:10',
	'bank_account'       => 'required|max:20',
	'joining_date'       => 'required',
	'emp_designation'    => 'required',
	'emp_department'     => 'required|max:6',
	'emp_grade'     => 'required',
	'comp_code'          => 'required|max:6',
	'plant_code'         => 'required|max:6',
	'Profit_center_code' => 'required',
	'left_date'          => 'required',
	'address_line_1'     => 'required|regex:/[a-zA-Z0-9\s]+/',
	'pin_code'           => 'required|max:6',
	'add_city'           => 'required|regex:/^[\pL\s\-]+$/u|max:20',
	'add_state'          => 'required|regex:/^[\pL\s\-]+$/u|max:20',
	'add_country'        => 'required|regex:/^[\pL\s\-]+$/u|max:20',
	'perm_address_line_1' => 'required|regex:/[a-zA-Z0-9\s]+/',
	'perm_address_line_2' => 'required|regex:/[a-zA-Z0-9\s]+/',
	'perm_address_line_3' => 'required|regex:/[a-zA-Z0-9\s]+/',
	'perm_pin_code'       => 'required|max:6',
	'perm_add_city'       => 'required|regex:/^[\pL\s\-]+$/u|max:20',
	'perm_add_state'      => 'required|regex:/^[\pL\s\-]+$/u|max:20',
	'perm_add_country'    => 'required|regex:/^[\pL\s\-]+$/u|max:20',
			

   ]);
	$adharImg = $request->file('adharcard');
    // echo '<PRE>';print_r($adharImg);exit(); echo '</PRE>';

	$sesionid         = $request->session()->get('userid');
	
	$emp_dob          = $request->input('date_of_birth');
	
	$new_dob          = date("Y-m-d", strtotime($emp_dob));
	
	$joining_date     = $request->input('joining_date');
	
	$new_joining_date = date("Y-m-d", strtotime($joining_date));
	
	$left_date        = $request->input('left_date');
	
	$new_left_date    = date("Y-m-d", strtotime($left_date));
	
	$compName         = $request->session()->get('company_name');
	
	$fisYear          =  $request->session()->get('macc_year');
	
	$createdBy        = $request->session()->get('userid');
	
	$flag = 1;

    	if($file1 = $request->hasFile('passport')) {

         $filenamewithext = $request->file('passport')->getClientOriginalName();
         $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
         $extension = $request->file('passport')->getClientOriginalExtension();
         $filenamestore1 = $filename.'_'.date('Ymd-His').'.'.$extension;
         $path = $request->file('passport')->move('public/dist/img/credit',$filenamestore1);

     }else{

            $filenamestore1 = 'noimage';
     }

     if($file2 = $request->hasFile('adharcard')) {

         $filenamewithext = $request->file('adharcard')->getClientOriginalName();
        
         $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
         
         $extension = $request->file('adharcard')->getClientOriginalExtension();
         
         $filenamestore2 = $filename.'_'.date('Ymd-His').'.'.$extension;
         
         $path = $request->file('adharcard')->move('public/dist/img/credit',$filenamestore2);

     }else{

            $filenamestore2 = 'noimage';
     }

     if($file3 = $request->hasFile('pancard')) {

        $filenamewithext = $request->file('pancard')->getClientOriginalName();
        $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
        $extension = $request->file('pancard')->getClientOriginalExtension();
        $filenamestore3 = $filename.'_'.date('Ymd-His').'.'.$extension;
        $path = $request->file('pancard')->move('public/dist/img/credit',$filenamestore3);

     }else{

          $filenamestore3 = 'noimage';
     }

     if($file4 = $request->hasFile('voter_id')) {

        $filenamewithext = $request->file('voter_id')->getClientOriginalName();
        $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
        $extension = $request->file('voter_id')->getClientOriginalExtension();
        $filenamestore4 = $filename.'_'.date('Ymd-His').'.'.$extension;
        $path = $request->file('voter_id')->move('public/dist/img/credit',$filenamestore4);

     }else{

          $filenamestore4 = 'noimage';
     }

     if($file5 = $request->hasFile('drivingcard')) {

        $filenamewithext = $request->file('drivingcard')->getClientOriginalName();
        $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
        $extension = $request->file('drivingcard')->getClientOriginalExtension();
        $filenamestore5 = $filename.'_'.date('Ymd-His').'.'.$extension;
        $path = $request->file('drivingcard')->move('public/dist/img/credit',$filenamestore5);

     }else{

            $filenamestore5 = 'noimage';
     }

     $data = array(

		"EMP_CODE"        =>  $request->input('employee_code'),
		"FY_CODE"         =>  $fisYear,
		"EMP_NAME"        =>  $request->input('employee_name'),
		"DOB"             =>  $new_dob,
		"BIRTH_PLACE"     =>  $request->input('birth_place'),
		"GENDER"          =>  $request->input('gender'),
		"CAST"            =>  $request->input('emp_cast'),
		"RELIGION"        =>  $request->input('emp_religion'),
		"BLOOD_GROUP"     =>  $request->input('blood_group'),
		"BLOOD_GROUP_NAME"     =>  $request->input('emp_blood_name'),
		"MARITAL_STATUS"  =>  $request->input('marital_status'),
		"EMAIL"           =>  $request->input('emp_email'),
		"CONTACT_NO"      =>  $request->input('emp_mobile'),
		"ADHAR_NO"        =>  $request->input('adhar_no'),
		"PAN_NO"          =>  $request->input('pan_no'),
		"ACC_CODE"        =>  $request->input('acc_code'),
		"BANK_NAME"       =>  $request->input('bankName'),
		"BRANCH_NAME"     =>  $request->input('branch_name'),
		"BANK_IFSC"       =>  $request->input('bank_ifsc'),
		"BANK_ACCOUNT_NO" =>  $request->input('bank_account'),
		"BANK_MICR"       =>  $request->input('bank_micr'),
		"DOJ"             =>  $new_joining_date,
		"DESIG_CODE"      =>  $request->input('emp_designation'),
		"DESIG_NAME"      =>  $request->input('desigN_name'),
		"DEPT_CODE"       =>  $request->input('emp_department'),
		"DEPT_NAME"       =>  $request->input('deptR_name'),
		"GRADE_CODE"       =>  $request->input('emp_grade'),
		"GRADE_NAME"       =>  $request->input('Grade_Name'),
		"ORG_CODE"        =>  $request->input('org_position'),
		"COMP_CODE"       =>  $request->input('comp_code'),
		"COMP_NAME"       =>  $request->input('comp_name'),
		"PLANT_CODE"      =>  $request->input('plant_code'),
		"PLANT_NAME"      =>  $request->input('Plant_Name'),
		"PFCT_CODE"       =>  $request->input('Profit_center_code'),
		"PFCT_NAME"       =>  $request->input('ptct_name'),
		"COST_CODE"       =>  $request->input('cost_code'),
		"COST_NAME"       =>  $request->input('costST_NameE'),
		"ESIC_NO"         =>  $request->input('esic_no'),
		"EPF_NO"          =>  $request->input('epf_no'),
		"EPFO_UAN"        =>  $request->input('epfo_uan_no'),
		"LEFT_DATE"       =>  $new_left_date,
		"LEFT_REASON"     =>  $request->input('left_reason'),
		"ADD1"            =>  $request->input('address_line_1'),
		"ADD2"            =>  $request->input('address_line_2'),
		"ADD3"            =>  $request->input('address_line_3'),
		"PIN_CODE"        =>  $request->input('pin_code'),
		"CITY"            =>  $request->input('add_city'),
		"STATE"           =>  $request->input('add_state'),
		"STATE_NAME"           =>  $request->input('emp_add_state'),
		"COUNTRY"         =>  $request->input('add_country'),
		"PADD1"           =>  $request->input('perm_address_line_1'),
		"PADD2"           =>  $request->input('perm_address_line_2'),
		"PADD3"           =>  $request->input('perm_address_line_3'),
		"PPIN_CODE"       =>  $request->input('perm_pin_code'),
		"PCITY"           =>  $request->input('perm_add_city'),
		"PSTATE"          =>  $request->input('perm_add_state'),
		"PSTATE_NAME"          =>  $request->input('emp_perm_add_state'),
		"PCOUNTRY"        =>  $request->input('perm_add_country'),
		"PASSPORT"        =>  $filenamestore1,
		"ADHAR_CARD"      =>  $filenamestore2,
		"PAN_CARD"        =>  $filenamestore3,
		"VOTER_ID"        =>  $filenamestore4,
		"DRIVING_LICENCE" =>  $filenamestore5,
		"FLAG"            =>  $flag,
		"CREATED_BY"      =>  $request->session()->get('userid')
   
   );


     // echo "<pre>";
     // print_r($data);
     // exit();


	$saveData = DB::table('MASTER_EMP')->insert($data);

	if ($saveData) {

		$request->session()->flash('alert-success', 'Employee Details Successfully Save...!');
		return redirect('/Master/Employee/View-Employee-Mast');

	}else{

		$request->session()->flash('alert-error', 'Employee Details Can Not Save...!');
		return redirect('/Master/Employee/View-Employee-Mast');

     }
}

public function AddEmployeeFamily(Request $request){

	$sesionid     = $request->session()->get('userid');
	
	$rel_emp_dob  = $request->input('relative_date_of_birth');
	
	$rel_emp_code = $request->input('rel_emp_code');
	
	$new_rel_dob  = date("Y-m-d", strtotime($rel_emp_dob));
	
	$compName     = $request->session()->get('company_name');
	
	$fisYear      =  $request->session()->get('macc_year');
	
	$createdBy    = $request->session()->get('userid');
   
   $getcomcode    = explode('-', $compName);

	$comp_code = $getcomcode[0];
	$comp_name = $getcomcode[1];

	$empcode = $request->input('rel_emp_code');

	$checkData = DB::table('MASTER_EMPFAMILY')->where('COMP_CODE',$comp_code)->where('EMP_CODE',$empcode)->first();

	

	$response_array = array();

	if($checkData == ''){

		$flag=1;

		$data = array(

			"COMP_CODE"   =>  $comp_code,
			"COMP_NAME"   =>  $comp_name,
			"EMP_CODE"   =>  $request->input('rel_emp_code'),
			"EMP_NAME"   =>  $request->input('rel_emp_name'),
			"RNAME"      =>  $request->input('relative_name'),
			"RDOB"       =>  $new_rel_dob,
			"RRELATION"  =>  $request->input('relation_with_emp'),
			"RGENDER"    =>  $request->input('relative_gender'),
			"RCONTACT"   =>  $request->input('relative_mob'),
			"FLAG"       =>  $flag,
			"CREATED_BY" =>  $request->session()->get('userid')

		);



		if ($request->ajax()) {

	   	$saveData = DB::table('MASTER_EMPFAMILY')->insert($data);
	   	
	   	if($saveData){

	   		$response_array['response']    = 'success';
	   		$data = json_encode($response_array);
	   
	         print_r($data);

	   	}else{

	   		$response_array['response']    = 'error';
	   		$data = json_encode($response_array);
	   
	         print_r($data);

	   	}

		}

   }else{

		if ($request->ajax()) {

   	
   		$response_array['response']    = 'error';
   		$data = json_encode($response_array);
   
         print_r($data);

   	}
   }

        
}


public function SaveEmpCareerDetails(Request $request){

   $EmpCodeCount   = $request->input('emp_code');

   $EmpnNameCount   = $request->input('emp_name');
	
	$CareerDetlSlno = $request->input('CareerDetlSlno');
	
	$SlnoCount      = count($CareerDetlSlno);
	
	$compName       = $request->session()->get('company_name');
	$getcomcode    = explode('-', $compName);

	$comp_code = $getcomcode[0];
	$comp_name = $getcomcode[1];
	
	$fisYear        =  $request->session()->get('macc_year');
	
	$createdBy      = $request->session()->get('userid');
	
	$CompName       = $request->input('comp_name');
	
	$desig          = $request->input('designation');

	$designame          = $request->input('designation_name');
	
	$deptList       = $request->input('DeptList');

	$deptListName       = $request->input('DeptListName');

	$flag = 1;
   
   $saveData = '';

   $checkData = DB::table('MASTER_EMPCAREER')->where('COMP_CODE',$comp_code)->where('EMP_CODE',$EmpCodeCount[0])->first();

	$response_array = array();

	if($checkData == ''){

    for($i=0; $i < $SlnoCount; $i++) { 

   	$form_date = $request->input('form_date');
		
		$FormDate  = date("Y-m-d", strtotime($form_date[$i]));
		
		$to_date   = $request->input('to_date');
		
		$ToDate    = date("Y-m-d", strtotime($to_date[$i]));


    	$data = array(

			"EMP_CODE"    =>  $EmpCodeCount[$i],
			"EMP_NAME"    =>  $EmpnNameCount[$i],
			"COMP_CODE"   =>  $comp_code,
			"SLNO"        =>  $CareerDetlSlno[$i],
			"COMPANY"     =>  $CompName[$i],
			"DESIGNATION" =>  $desig[$i],
			"DESIGNATION_NAME" =>  $designame[$i],
			"DEPARTMENT"  =>  $deptList[$i],
			"DEPARTMENT_NAME"  =>  $deptListName[$i],
			"FROM_DATE"   =>  $FormDate,
			"TO_DATE"     =>  $ToDate,
			"FLAG"        =>  $flag,
			"CREATED_BY"  =>  $createdBy

		); 


		$saveData = DB::table('MASTER_EMPCAREER')->insert($data);

		

	}

	if ($request->ajax()) {

			if($saveData){

   			$response_array['response']    = 'success';
   		   $data = json_encode($response_array);
   
           print_r($data);

   		}else{

   			$response_array['response']    = 'error';
   		   $data = json_encode($response_array);
   
           print_r($data);

   		}

   	}

	}else{

		if ($request->ajax()) {

			   $response_array['response']    = 'error';
   		   $data = json_encode($response_array);
   
            print_r($data);
      }

	}

}


public function SaveEmpEduDetails(Request $request){

	$EmpCodeCount   = $request->input('empl_code');

	$EmpNameCount   = $request->input('empl_name');
	
	$EductnDetlSlno = $request->input('EductnDetlSlno');
	
	$SlnoCount      = count($EductnDetlSlno);
	
	$compName       = $request->session()->get('company_name');

	$getcomcode    = explode('-', $compName);

	$comp_code = $getcomcode[0];
	$comp_name = $getcomcode[1];
	
	$fisYear        =  $request->session()->get('macc_year');
	
	$createdBy      = $request->session()->get('userid');
	
	$CourseName     = $request->input('course_name');
	
	$universit_name = $request->input('universit_name');
	
	$passing_year   = $request->input('passing_year');
	
	$percentage     = $request->input('percentage');

 	$flag = 1;
 	
 	$saveData = '';

 	$checkData = DB::table('MASTER_EMPEDU')->where('COMP_CODE',$comp_code)->where('EMP_CODE',$EmpCodeCount[0])->first();

	$response_array = array();

	if($checkData == ''){

		for ($i=0; $i < $SlnoCount; $i++) { 

 		$data = array(

		"EMP_CODE"     =>  $EmpCodeCount[$i],
		"EMP_NAME"     =>  $EmpNameCount[$i],
		"COMP_CODE"    =>  $comp_code,
		"SLNO"         =>  $EductnDetlSlno[$i],
		"COURSE"       =>  $CourseName[$i],
		"UNIVERSITY"   =>  $universit_name[$i],
		"PASSING_YEAR" =>  $passing_year[$i],
		"PERCENTAGE"   =>  $percentage[$i],
		"FLAG"         =>  $flag,
		"CREATED_BY"   =>  $createdBy

		); 

		// print_r($data);
		// exit();


	  $saveData = DB::table('MASTER_EMPEDU')->insert($data);


	}

	if ($request->ajax()) {

			if($saveData){

   			$response_array['response']    = 'success';
   		   $data = json_encode($response_array);
   
           print_r($data);

   		}else{

   			$response_array['response']    = 'error';
   		   $data = json_encode($response_array);
   
           print_r($data);

   		}

   	}

   }else{

   	if ($request->ajax()) {

   		$response_array['response']    = 'error';
   		   $data = json_encode($response_array);
   
           print_r($data);

   	}
   }

}

public function GetEmplyeeByDepartment(Request $request){

   $response_array = array();

   if ($request->ajax()) {
			
		$deptCode    = $request->input('deptCode');
           
      $fetch_reocrd = DB::table('MASTER_EMP')->where('DEPT_CODE',$deptCode)->get();

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

public function ViewEmpDetails(Request $request){

	$compName = $request->session()->get('company_name');
	
	$getcomcode    = explode('-', $compName);
	
	$comp_code = $getcomcode[0];

      if($request->ajax()) {

         $title ='View Employee';

         $userid    = $request->session()->get('userid');

         $userType = $request->session()->get('usertype');

         $compName = $request->session()->get('company_name');

         $fisYear =  $request->session()->get('macc_year');


	      if($userType=='admin' || $userType=='Admin'){

	        
	          $data = DB::table('MASTER_EMP')
				->select('MASTER_EMP.*')->where('COMP_CODE',$comp_code)
           		->orderBy('MASTER_EMP.EMP_CODE','DESC');
            	

	       }else if($userType=='superAdmin' || $userType=='user'){

	             $data = DB::table('MASTER_EMP')
				->select('MASTER_EMP.*')->where('COMP_CODE',$comp_code)
           		->orderBy('MASTER_EMP.EMP_CODE','DESC');

	       }else{

	            $data='';
	            
	       }

	    	return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	   }

	   if(isset($compName)){

	       return view('admin.finance.master.employee.view_employee');
	   
	   }else{

			return redirect('/useractivity');
		}
        
}

public function EmployeeChieldRTowData(Request $request){

	$response_array = array();

	$emp_code = $request->input('emp_code');
	
	if ($request->ajax()) {

	   $employee_details = DB::table("MASTER_EMPEDU")->where('EMP_CODE',$emp_code)->get();

	   if ($employee_details) {

    		$response_array['response'] = 'success';
	      
	      $response_array['data'] = $employee_details ;

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

public function EmployeeDetailsChieldRTowData(Request $request){
   
   $response_array = array();

	$emp_code = $request->input('emp_code');

   if ($request->ajax()) {

	   $employee_details = DB::table("MASTER_EMP")->where('EMP_CODE',$emp_code)->get()->first();

	   if ($employee_details) {

    		$response_array['response'] = 'success';
	      
	      $response_array['data'] = $employee_details ;

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
   }

}

public function EmployeeFamilyChieldRTowData(Request $request){

	$response_array = array();

	$emp_code = $request->input('emp_code');
	
	if ($request->ajax()) {

	$family_details = DB::table("MASTER_EMPFAMILY")->where('EMP_CODE',$emp_code)->get()->first();

		if ($family_details) {

 			$response_array['response'] = 'success';
         
         $response_array['data'] = $family_details ;

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

public function EmployeeCareerChieldRTowData(Request $request){

	$response_array = array();
   
   $emp_code = $request->input('emp_code');
	
	if($request->ajax()){

	   $carrer_details = DB::table("MASTER_EMPCAREER")->where('EMP_CODE',$emp_code)->get()->first();

    	if ($carrer_details) {

    		$response_array['response'] = 'success';
         
         $response_array['data'] = $carrer_details;

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

/*  Employee WAGE TYPE MASTER*/

public function WageTypeMaster(Request $request){
		
	$compName  	= $request->session()->get('company_name');

	$transData['wageindicator_list'] = DB::table('MASTER_WAGEIND')->get();
	
	$transData['grade_list'] = DB::table('MASTER_GRADE')->get();

	$transData['rate_list'] = DB::table('MASTER_RATE_VALUE')->get();
		
	if(isset($compName)){

 		return view('admin.finance.master.employee.wage_type',$transData);

   }else{

		return redirect('/useractivity');
	}

}

public function WageTypeFormSave(Request $request){ 
     
 	$validate = $this->validate($request, [

		'grade_code'  => 'required',
	]);
	
	$createdBy  = $request->session()->get('userid');

 	$compName   = $request->session()->get('company_name');

 	$fisYear  =  $request->session()->get('macc_year');

 	$getcomcode    = explode('-', $compName);

	$comp_code = $getcomcode[0];

	$comp_name = $getcomcode[1];

	$gradecode = $request->input('grade_code');

	$checkData = DB::table('MASTER_WAGE_TYPE')->where('GRADE_CODE',$gradecode)->where('FY_CODE',$fisYear)->where('COMP_CODE',$comp_code)->get();

	$countChkData = count($checkData);

	if($countChkData == 0){
	          
      $headC = $request->input('wageindicator_code');

      $FilterArray = array_filter($headC);

      $HeadCount = count($FilterArray);

      $gradecode = $request->input('grade_code');

      $gradeName = DB::table('MASTER_GRADE')->where('GRADE_CODE', $gradecode)->get()->first();

      $wageIncode = $request->input('wageindicator_code2');

      $wageInName = DB::table('MASTER_WAGEIND')->where('WAGEIND_CODE', $wageIncode)->get()->first();
		    
		$sr                 = $request->input('srNo');

		$grade_code         = $request->input('grade_code');

		$grade_name         = $gradeName->GRADE_NAME;

		$wageindicator_code = $request->input('wageindicator_code');

		$wageIndType        = $request->input('wageIndType');

		$rate_code          = $request->input('rate_code');

		$rate_name          = $request->input('rate_name');

		$rate               = $request->input('rate');

		$logic              = $request->input('logic');

		$static             = $request->input('static');

		$monOrYy            = $request->input('monthOrYr');

		$wagetype_block     = '0';

		$flag               = '0';

		$created_by         = $createdBy;

		$updated_by         = $createdBy;

		$lg =array();
				
		            
		for($i = 0; $i < $HeadCount; $i++){

			$wageIncode = $wageindicator_code[$i];

			$wageInName = DB::table('MASTER_WAGEIND')->where('WAGEIND_CODE', $wageIncode)->get()->first();

	    	$data = array(

				"FY_CODE"        => $fisYear,
				"COMP_CODE"      => $comp_code,
				"COMP_NAME"      => $comp_name,
				"GRADE_CODE"     => $grade_code,
				"GRADE_NAME"     => $gradeName->GRADE_NAME,
				"WAGEIND_CODE"   => $wageindicator_code[$i],
				"WAGEIND_NAME"   => $wageInName->WAGEIND_NAME,
				"WAGEIND_TYPE"   => $wageIndType[$i],
				"RATE_CODE"      => $rate_code[$i],
				"RATE_NAME"      => $rate_name[$i],
				"RATE"           => $rate[$i],
				"LOGIC"          => $logic[$i],
				"STATIC"         => $static[$i],
				"MONTH_OR_YEAR"  => $monOrYy[$i],
				"WAGETYPE_BLOCK" => '0',
				"FLAG"           => '0',
				"CREATED_BY"     => $createdBy,
				"LAST_UPDATE_BY" => $createdBy
		 
		   );

			$saveData = DB::table('MASTER_WAGE_TYPE')->insert($data);

	   }

	   if($saveData){

		   $discriptn_page = "Master wage type insert done by user";

			$this->userLogInsert($createdBy,$discriptn_page);

			$request->session()->flash('alert-success', 'Employee Wage Type Was Successfully Added...!');

			return redirect('/Master/Employee/View-Emp-Wage-Type-Mast');

		}else{

			$request->session()->flash('alert-error', 'Employee Wage Type Can Not Added...!');
			
			return redirect('/Master/Employee/View-Emp-Wage-Type-Mast');

		}
	}else{
			$request->session()->flash('alert-error', 'Already Saved This Employee Wage Type...!');
				return redirect('/Master/Employee/View-Emp-Wage-Type-Mast');
	}
}

public function ViewEmpWageType(Request $request){

   $compName   = $request->session()->get('company_name');

   $fisYear  =  $request->session()->get('macc_year');

   $getcomcode    = explode('-', $compName);

   $comp_code = $getcomcode[0];

	if($request->ajax()){
      
        $title    = 'View Employee Wage Type Master';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){
			
			$data = DB::table('MASTER_WAGE_TYPE')->where('FY_CODE', $fisYear)->where('COMP_CODE',$comp_code)->groupBy('GRADE_CODE')->orderBy('ID','DESC');

    	}else if($userType=='superAdmin' || $userType=='user'){    		

    	 $data = DB::table('MASTER_WAGE_TYPE')->where('FY_CODE', $fisYear)->where('COMP_CODE',$comp_code)->groupBy('GRADE_CODE')->orderBy('ID','DESC');
    	
    	}else{

    		$data ='';
    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

    	return view('admin.finance.master.employee.view_wage_type');
	
	}else{

		return redirect('/useractivity');
	}

}

public function DeleteWagetype(Request $request){

	$wagetype   = $request->input('wagetype');
	
	$compName   = $request->session()->get('company_name');
	
	$fisYear    =  $request->session()->get('macc_year');
	
	$getcomcode = explode('-', $compName);
	
	$comp_code  = $getcomcode[0];
    	
   if($wagetype!=''){
    		
    	try{

    		$Delete = DB::table('MASTER_WAGE_TYPE')->where('GRADE_CODE', $wagetype)->where('FY_CODE', $fisYear)->where('COMP_CODE', $comp_code)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Employee 
				Wage Type Was Deleted Successfully...!');
				return redirect('/Master/Employee/View-Emp-Wage-Type-Mast');

			}else{

				$request->session()->flash('alert-error', 'Employee Attendance Can Not Deleted...!');
				
				return redirect('/Master/Employee/View-Emp-Wage-Type-Mast');

			}
		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Employee Wage Type Can not be Deleted...! Used In Another Transaction...!');
					
		   return redirect('/Master/Employee/View-Emp-Wage-Type-Mast');
		}

   }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
		
		return redirect('/Master/Employee/View-Emp-Wage-Type-Mast');

   }

}

public function EditEmpWageType(Request $request,$gradecode){

 	$title = 'Edit Emp Wage Type';

 	$compName   = $request->session()->get('company_name');
	
	$fisYear  =  $request->session()->get('macc_year');

	$getcomcode    = explode('-', $compName);
   
   $comp_code = $getcomcode[0];

   $comp_name = $getcomcode[1];

 	$gradecode = base64_decode($gradecode);

   if($gradecode!=''){

 	   $query = DB::table('MASTER_WAGE_TYPE');
		$query->where('GRADE_CODE', $gradecode);
		$query->where('FY_CODE', $fisYear);
		$query->where('COMP_CODE', $comp_code);
		$classData= $query->get()->toArray();

		$transData['wagetype_value'] = $classData;
		
		$grade_list = DB::table('MASTER_GRADE')->where('GRADE_CODE', $gradecode)->get()->first();

		$gradecode  = $grade_list->GRADE_CODE;

      $transData['rate_list'] = DB::table('MASTER_RATE_VALUE')->get();
		
		$transData['wageindicator_list'] = DB::table('MASTER_WAGEIND')->get();

		
		$transData['grade_list'] = DB::table('MASTER_GRADE')->get();

      return view('admin.finance.master.employee.edit_wage_type',$transData+compact('title','gradecode', 'classData'));

	}else{
			
			$request->session()->flash('alert-error', 'Employee Wage Type Not Found...!');
			return redirect('/Master/Employee/View-Emp-Wage-Type-Mast');
	}

}

public function EmpWageTypeUpdate(Request $request){

	$headC = $request->input('wageindicator_code');

	$headC1 = $request->input('wageindicator_code_new');

	$FilterArray = array_filter($headC);

	$FilterArray1 = array_filter($headC1);

	$HeadCount = count($FilterArray);

	$HeadCount1 = count($FilterArray1);

	$updateData1;

	$idwagetype = $request->input('wagetypeId');

	date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d H:i:s");
	
	$createdBy   = $request->session()->get('userid');
	
	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');
   
   $getcomcode    = explode('-', $compName);
	
	$comp_code = $getcomcode[0];
	
	$comp_name = $getcomcode[1];
	
	$gradecode = $request->input('grade_code');
	
   $gradeName = DB::table('MASTER_GRADE')->where('GRADE_CODE', $gradecode)->get()->first();

   $grade_code             = $request->input('grade_code');

	$grade_name             = $gradeName->GRADE_NAME;

	$wageindicator_code     = $request->input('wageindicator_code');

	$rate_code              = $request->input('rate_code');
	
	$rate_name              = $request->input('rate_name');

	$rate                   = $request->input('rate');

	$logic                  = $request->input('logic');

	$static                 = $request->input('static');

	$monOrYr                = $request->input('monOrYr');

	$wagetype_block         = '0';

	$flag                   = '0';

	$created_by             = $createdBy;

	$updated_by             = $createdBy;
	
	
	$wageindicator_code_new = $request->input('wageindicator_code_new');

	$rate_code_new      = $request->input('rate_code_new');
	
	$rate_name_new      = $request->input('rate_name_new');

	$rate_new               = $request->input('rate_new');

	$logic_new              = $request->input('logic_new');

	$static_new             = $request->input('static_new');

	$monOrYr_new            = $request->input('monOrYr_new');
  
			
	for($i = 0; $i < $HeadCount; $i++){

		$id         = $idwagetype[$i];

      $wageIncode = $wageindicator_code[$i];

    	$wageInName = DB::table('MASTER_WAGEIND')->where('WAGEIND_CODE', $wageIncode)->get()->first();

    	$data = array(
					
			"FY_CODE"        => $fisYear,
			"COMP_CODE"      => $comp_code,
			"COMP_NAME"      => $comp_name,
			"GRADE_CODE"     => $grade_code,
			"GRADE_NAME"     => $gradeName->GRADE_NAME,
			"WAGEIND_CODE"   => $wageindicator_code[$i],
			"WAGEIND_NAME"   => $wageInName->WAGEIND_NAME,
			"RATE_CODE"      => $rate_code[$i],
			"RATE_NAME"      => $rate_name[$i],
			"RATE"           => $rate[$i],
			"LOGIC"          => $logic[$i],
			"STATIC"         => $static[$i],
			"MONTH_OR_YEAR"  => $monOrYr[$i],
			"WAGETYPE_BLOCK" => '0',
			"FLAG"           => '0',
			"LAST_UPDATE_BY" => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
	   );

      $updateData1 = DB::table('MASTER_WAGE_TYPE')->where('ID',$id)->update($data);

			// try{
			

			// 	if ($updateData1) {

			// 		$request->session()->flash('alert-success', 'Employee Wage Type Was Successfully Updated...!');
			// 		return redirect('/Master/Employee/View-Emp-Wage-Type-Mast');

			// 	} else {

			// 		$request->session()->flash('alert-error', 'Employee Wage Type Can Not Added...!');
			// 		return redirect('/Master/Employee/View-Emp-Wage-Type-Mast');

			// 	}
			// }
			// catch(Exception $ex)
			// {
			// 		    $request->session()->flash('alert-error', 'Employee Wage Type Can not be Updated...! Used In Another Transaction...!');
			// 				return redirect('/Master/Employee/View-Emp-Wage-Type-Mast');
			// }
			
	}

   $saveData="";
   
   for($i = 0; $i < $HeadCount1; $i++){

      $wageIncode = $wageindicator_code_new[$i];

    	$wageInName = DB::table('MASTER_WAGEIND')->where('WAGEIND_CODE', $wageIncode)->get()->first();

    	$data = array(
			"FY_CODE"        => $fisYear,
			"COMP_CODE"      => $comp_code,
			"COMP_NAME"      => $comp_name,
			"GRADE_CODE"     => $grade_code,
			"GRADE_NAME"     => $gradeName->GRADE_NAME,
			"WAGEIND_CODE"   => $wageindicator_code_new[$i],
			"WAGEIND_NAME"   => $wageInName->WAGEIND_NAME,
			"RATE_CODE"      => $rate_code_new[$i],
			"RATE_NAME"      => $rate_name_new[$i],
			"RATE"           => $rate_new[$i],
			"LOGIC"          => $logic_new[$i],
			"STATIC"         => $static_new[$i],
			"MONTH_OR_YEAR"  => $monOrYr_new[$i],
			"WAGETYPE_BLOCK" => 'NO',
			"FLAG"           => '0',
			"created_by"     => $createdBy,

      );

      $saveData = DB::table('MASTER_WAGE_TYPE')->insert($data);

   }
   
   if($saveData || $updateData1){

		$request->session()->flash('alert-success', 'Employee Wage Type Was Successfully Updated...!');
		
		return redirect('/Master/Employee/View-Emp-Wage-Type-Mast');

		$discriptn_page = "Master wage type update done by user";
		
		$this->userLogInsert($createdBy,$discriptn_page);

     }else{

		$request->session()->flash('alert-error', 'Employee Wage Type Can Not Added...!');
		
		return redirect('/Master/Employee/View-Emp-Wage-Type-Mast');

   }

}

  /*  Employee WAGE TYPE MASTER*/


  /*LEAVE TYPE*/

public function LeaveType(Request $request){

 	$title = 'Employee Leave Type Master';

 	$compName = $request->session()->get('company_name');

 	$leave_code = $request->old('leavetype_code');
	
	$leave_name = $request->old('leave_name');
	
    $button='Save';
 	
 	$action='/Master/Employee/employee-leave-type-save';

    if(isset($compName)){

    	return view('admin.finance.master.employee.leave_type',compact('title','button','action','leave_code','leave_name'));

    }else{

		return redirect('/useractivity');
	}

}

public function SaveLeaveTypeMaster(Request $request){
        
   $validate = $this->validate($request, [

		'leave_code' => 'required|max:4|unique:MASTER_LEAVETYPE,LEAVE_CODE',
		'leave_name' => 'required|max:40',

	]);


 	$createdBy 	= $request->session()->get('userid');

 	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');

 	$data = array(

			"LEAVE_CODE"  => $request->input('leave_code'),
			"LEAVE_NAME"  => $request->input('leave_name'),
			"leave_block" => 'NO',
			"FLAG"        => '0',
			"CREATED_BY"  => $createdBy,
		
	);
   
   $saveData = DB::table('MASTER_LEAVETYPE')->insert($data);
   
   $discriptn_page = "Master leave type insert done by user";
	
	$this->userLogInsert($createdBy,$discriptn_page);

   if ($saveData) {

		$request->session()->flash('alert-success', 'Leave Type Was Successfully Added...!');
		return redirect('/Master/Employee/View-Emp-leaveType-Mast');

   }else{

	  $request->session()->flash('alert-error', 'Leave Type Can Not Added...!');
	  return redirect('/Master/Employee/View-Emp-leaveType-Mast');

   }

}

public function ViewLeaveType(Request $request){

   $compName = $request->session()->get('company_name');

	if($request->ajax()){

		$title    = 'View Leave Type Master';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

      $data = DB::table('MASTER_LEAVETYPE')->orderBy('LEAVE_CODE','DESC');

    	}else if($userType=='superAdmin'||$userType=='user'){    		
        $data = DB::table('MASTER_LEAVETYPE')->orderBy('LEAVE_CODE','DESC');

    	}
    	else{

    		$data ='';
    	}

      return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

    	return view('admin.finance.master.employee.view_leave_type');

	}else{

		return redirect('/useractivity');

	}

}

public function DeleteLeaveType(Request $request){

	$leavetype = $request->input('leavetype');
    	
	if ($leavetype!=''){

    	try{

    		$Delete = DB::table('MASTER_LEAVETYPE')->where('LEAVE_CODE', $leavetype)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Employee 
				Leave Type Was Deleted Successfully...!');
				
				return redirect('/Master/Employee/View-Emp-leaveType-Mast');

			}else{

				$request->session()->flash('alert-error', 'Employee Leave Type Can Not Deleted...!');
				return redirect('/Master/Employee/View-Emp-leaveType-Mast');

			}
		}catch(Exception $ex){
			    
			 $request->session()->flash('alert-error', 'Employee Leave Type Can not be Deleted...! Used In Another Transaction...!');
			
			 return redirect('/Master/Employee/View-Emp-leaveType-Mast');
		}

   }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
		
		return redirect('/Master/Employee/View-Emp-leaveType-Mast');

   }

}

public function EditLeaveType($leavecode){

 	$title = 'Edit Emp Leave Type Master';

 	$leavecode = base64_decode($leavecode);
 	
   if($leavecode!=''){

 	   $query = DB::table('MASTER_LEAVETYPE');
		$query->where('LEAVE_CODE', $leavecode);
		$classData= $query->get()->first();

		$leave_code = $classData->LEAVE_CODE;

		$leave_name = $classData->LEAVE_NAME;

		$leave_block = $classData->LEAVE_BLOCK;

		$button='Update';

		$action='Master/Employee/form-emp-leave-type-update';

		return view('admin.finance.master.employee.leave_type',compact('title','leave_code','leave_name','leave_block','button','action'));

	}else{
		
		$request->session()->flash('alert-error', 'Employee Leave Type Not Found...!');
		
		return redirect('/Master/Employee/View-Emp-leaveType-Mast');
	}

}

public function EmpLeaveTypeUpdate(Request $request){

	$validate = $this->validate($request, [

		'leave_code' => 'required|max:6',
		'leave_name' => 'required|max:40',

	]);

	$leavecode = $request->input('idleavecode');

	date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d H:i:s");
	
	$createdBy   = $request->session()->get('userid');
	
	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');

	$data = array(
		
		"LEAVE_CODE"     => $request->input('leave_code'),
		"LEAVE_NAME"     => $request->input('leave_name'),
		"LEAVE_BLOCK"    => $request->input('leave_block'),
		"FLAG"           => '0',
		"LAST_UPDATE_BY" => $createdBy,
		"LAST_UPDATE_DATE" => $updatedDate,
	
	);
	try{


	$saveData = DB::table('MASTER_LEAVETYPE')->where('LEAVE_CODE', $leavecode)->update($data);

	$discriptn_page = "Master leave type update done by user";
	$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Employee Leave Type Was Successfully Updated...!');
			
			return redirect('/Master/Employee/View-Emp-leaveType-Mast');

		}else{

			$request->session()->flash('alert-error', 'Employee Leave Type Can Not Added...!');
			
			return redirect('/Master/Employee/View-Emp-leaveType-Mast');

			}
		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Employee Grade Can not be Updated...! Used In Another Transaction...!');
			
			return redirect('/Master/Employee/View-Emp-leaveType-Mast');
		}

}

/*LEAVE TYPE*/

/*LEAVE QUOTA*/

public function LeaveQuota(Request $request){

	$title           = 'Employee Leave Quota Master';
	
	$compName        = $request->session()->get('company_name');
	$getcomcode = explode('-', $compName);
	
	$comp_code  = $getcomcode[0];
	
	$id              = $request->old('idleavequota');
	$leave_year      = $request->old('leave_year');
	$empcode         = $request->old('empcode');
	$empname         = $request->old('empname');
	$leave_type      = $request->old('leave_type');
	$leave_name      = $request->old('leave_name');
	$leave_opening   = $request->old('leave_opening');
	$leave_addition  = $request->old('leave_addition');
	$leave_deduction = $request->old('leave_deduction');
	$leave_balance   = $request->old('leave_balance');

	$data['emp_list']    = DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->get();

	$data['emp_leavetype']    = DB::table('MASTER_LEAVETYPE')->get();

	$button='Save';

 	$action='/Master/Employee/employee-leave-quota-save';

   if(isset($compName)){

    	return view('admin.finance.master.employee.leave_quota',$data+compact('title','button','action','id','leave_year','empcode','empname','leave_type','leave_name','leave_opening','leave_addition','leave_deduction','leave_balance'));

   }else{

		return redirect('/useractivity');
	}

}

public function SaveLeaveQuotaMaster(Request $request){

   $validate = $this->validate($request, [

	'leave_year'      => 'required',
	'empcode'         => 'required|max:6',
	'leave_type'      => 'required|max:6',
	'leave_opening'   => 'required',
	'leave_addition'  => 'required',
	'leave_deduction' => 'required',
	'leave_balance'   => 'required',
   ]);

	$createdBy  = $request->session()->get('userid');

	$compName   = $request->session()->get('company_name');

	$getcomcode = explode('-', $compName);
	
	$comp_code  = $getcomcode[0];
	
	$fisYear    =  $request->session()->get('macc_year');

	$leaveYr = $request->input('leave_year');
	$empname = $request->input('empname');

	$checkData = DB::table('MASTER_EMPLEAVEQUOTA')->where('EMP_NAME',$empname)->where('FISCAL_YEAR',$leaveYr)->get()->first();

	if($checkData){

		$request->session()->flash('alert-error', 'Already Save Data...!');
				return redirect('/Master/Employee/Emp-leave-Quota-Mast');

	}else{

  
	   $data = array(

			"COMP_CODE"        => $comp_code,
			"FY_YEAR"          => $fisYear,
			"FISCAL_YEAR"      => $request->input('leave_year'),
			"EMP_CODE"         => $request->input('empcode'),
			"EMP_NAME"         => $request->input('empname'),
			"LEAVE_TYPE"       => $request->input('leave_type'),
			"LEAVE_NAME"       => $request->input('leave_name'),
			"YROPEN"           => $request->input('leave_opening'),
			"YRADD"            => $request->input('leave_addition'),
			"YRDEDUCTION"      => $request->input('leave_deduction'),
			"YROPBAL"          => $request->input('leave_balance'),
			"LEAVEQUOTA_BLOCK" => 'NO',
			"FLAG"             => '0',
			"CREATED_BY"       => $createdBy,
			
		);

		$saveData = DB::table('MASTER_EMPLEAVEQUOTA')->insert($data);

	   $discriptn_page = "Master employee leave quota insert done by user";

		$this->userLogInsert($createdBy,$discriptn_page);

	   if($saveData){

				$request->session()->flash('alert-success', 'Leave Quota Was Successfully Added...!');
				return redirect('/Master/Employee/View-Emp-leave-Quota-Mast');

		}else{

				$request->session()->flash('alert-error', 'Leave Quota Can Not Added...!');
				return redirect('/Master/Employee/Emp-leave-Quota-Mast');

		}
	}

}

public function ViewLeaveQuota(Request $request){

	$compName   = $request->session()->get('company_name');
	$getcomcode = explode('-', $compName);
	
	$comp_code  = $getcomcode[0];
	

	if($request->ajax()){

		$title    = 'View Leave Quota Master';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data = DB::table('MASTER_EMPLEAVEQUOTA')->where('COMP_CODE',$comp_code)->orderBy('ID','DESC');

    	}else if($userType=='superAdmin' || $userType=='user') {    		

    		$data = DB::table('MASTER_EMPLEAVEQUOTA')->orderBy('ID','DESC');

    	}
    	else{
    		$data ='';
    	}

      return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

    	return view('admin.finance.master.employee.view_leave_quota');

	}else{

		return redirect('/useractivity');
	}

}

public function DeleteLeaveQuota(Request $request){

	$id = $request->input('leavequota');
    	
	if($id!=''){

 		try{

 		$Delete = DB::table('MASTER_EMPLEAVEQUOTA')->where('ID',$id)->delete();

		if ($Delete) {

			$request->session()->flash('alert-success', 'Employee 
			Leave Quota Was Deleted Successfully...!');
			return redirect('/Master/Employee/View-Emp-leave-Quota-Mast');

		}else{

			$request->session()->flash('alert-error', 'Employee Leave Quota Can Not Deleted...!');
			return redirect('/Master/Employee/View-Emp-leave-Quota-Mast');

		}
	}catch(Exception $ex){

		$request->session()->flash('alert-error', 'Employee Leave Quota Can not be Deleted...! Used In Another Transaction...!');

		return redirect('/Master/Employee/View-Emp-leave-Quota-Mast');
	}

 	}else{

 		$request->session()->flash('alert-error', 'Zone  Not Found...!');
		return redirect('/Master/Employee/View-Emp-leave-Quota-Mast');

 	}

}

public function EditLeaveQuota($leavequota){

 	$title = 'Edit Emp Leave Quota Master';

 	$leavequota = base64_decode($leavequota);
 	
   $data['emp_list']    = DB::table('MASTER_EMP')->get();

   $data['emp_leavetype']    = DB::table('MASTER_LEAVETYPE')->get();

   if($leavequota!=''){
	   
	   $query = DB::table('MASTER_EMPLEAVEQUOTA');
		$query->where('ID', $leavequota);
		$classData= $query->get()->first();
      
      $leaveId 		   = $classData->ID;
      $leave_year 		= $classData->FISCAL_YEAR;
		$empcode    		= $classData->EMP_CODE;
		$empname    		= $classData->EMP_NAME;
		$leave_type 		= $classData->LEAVE_TYPE;
		$leave_name		   = $classData->LEAVE_NAME;
		$leave_opening    = $classData->YROPEN;
		$leave_addition 	= $classData->YRADD;
		$leave_deduction 	= $classData->YRDEDUCTION;
		$leave_balance 	= $classData->YROPBAL;
		$leavequota_block = $classData->LEAVEQUOTA_BLOCK;
		$button='Update';
		$action='/Master/Employee/form-emp-leave-quota-update';
            
      return view('admin.finance.master.employee.leave_quota',$data+compact('title','leaveId','leave_year','empcode','leave_type','leave_opening','empname','leave_name'
				,'leave_addition','leave_deduction','leave_balance','leavequota_block','button','action'));
	}else{

		$request->session()->flash('alert-error', 'Employee Leave Quota Not Found...!');

		return redirect('/Master/Employee/View-Emp-leave-Quota-Mast');
	}

}


public function EmpLeaveQuotaUpdate(Request $request){

	$validate = $this->validate($request, [

		'leave_year'      => 'required',
		'empcode'         => 'required|max:6',
		'leave_type'      => 'required|max:6',
		'leave_opening'   => 'required',
		'leave_addition'  => 'required',
		'leave_deduction' => 'required',
		'leave_balance'   => 'required',

	]);

	$leaveId = $request->input('leaveId');
	
	$empcode = $request->input('empcode');

	$fy_yr   = $request->input('leave_year');

	$leaveQuata = $request->input('leaveQuata_block');
   
   date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d H:i:s");
	
	$createdBy   = $request->session()->get('userid');
	
	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');

	$data = array(
			
		"FISCAL_YEAR"       => $request->input('leave_year'),
		"EMP_CODE"          => $request->input('empcode'),
		"EMP_NAME"          => $request->input('empname'),
		"LEAVE_TYPE"        => $request->input('leave_type'),
		"LEAVE_NAME"        => $request->input('leave_name'),
		"YROPEN"            => $request->input('leave_opening'),
		"YRADD"             => $request->input('leave_addition'),
		"YRDEDUCTION"       => $request->input('leave_deduction'),
		"YROPBAL"           => $request->input('leave_balance'),
		"LEAVEQUOTA_BLOCK"  => $request->input('leaveQuata_block'),
		"FLAG"        		=> '0',
		"LAST_UPDATE_BY"  	=> $createdBy,
		"LAST_UPDATE_DATE"  => $updatedDate,
			
	);

	$saveData = DB::table('MASTER_EMPLEAVEQUOTA')->where('EMP_CODE', $empcode)->where('FISCAL_YEAR',$fy_yr)->update($data);

	$discriptn_page = "Master employee leave quota update done by user";
	
	$this->userLogInsert($createdBy,$discriptn_page);
	
	if($saveData){

			$request->session()->flash('alert-success', 'Employee Leave Quota Was Successfully Updated...!');
			return redirect('/Master/Employee/View-Emp-leave-Quota-Mast');

	}else{

			$request->session()->flash('alert-error', 'Employee Leave Quota Can Not Added...!');
			return redirect('/Master/Employee/View-Emp-leave-Quota-Mast');

	}
	
}

/*LEAVE QUOTA*/


/*WAGE INDICATOR*/

public function WageIndicator(Request $request){

	$title              = 'Employee Wage Indicator Master';
	
	$compName           = $request->session()->get('company_name');
	
	$wageindicator_code = $request->old('wageindicator_code');
	$wageindicator_name = $request->old('wageindicator_name');
	$wageIndType        = $request->old('wageIndType');
	
	$button='Save';
 	
 	$action='/Master/Employee/employee-wage-indicator-save';

 	if(isset($compName)){

 	  return view('admin.finance.master.employee.wage_indicator',compact('title','button','action','wageindicator_code','wageindicator_name','wageIndType'));

   }else{

		return redirect('/useractivity');
	}

}

public function SaveWageIndicatorMaster(Request $request){
        
    $validate = $this->validate($request, [

		'wageindicator_code' => 'required|max:4|unique:MASTER_WAGEIND,WAGEIND_CODE',
		'wageindicator_name' => 'required|max:30',
		'wageIndType'        => 'required|max:10',

	]);


 	$createdBy 	= $request->session()->get('userid');

 	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');
   
   $data = array(

		"WAGEIND_CODE"  => $request->input('wageindicator_code'),
		"WAGEIND_NAME"  => $request->input('wageindicator_name'),
		"WAGEIND_TYPE"  => $request->input('wageIndType'),
		"WAGEIND_BLOCK" => 'NO',
		"FLAG"        => '0',
		"CREATED_BY"  => $createdBy
		
	);
   
   $saveData = DB::table('MASTER_WAGEIND')->insert($data);

   $discriptn_page = "Master wege indicator insert done by user";
   
   $this->userLogInsert($createdBy,$discriptn_page);

   if($saveData){

		$request->session()->flash('alert-success', 'Wage Indicator Was Successfully Added...!');
		
		return redirect('/Master/Employee/View-Emp-Wage-Indicator-Mast');

   }else{

		$request->session()->flash('alert-error', 'Wage Indicator Can Not Added...!');
		
		return redirect('/Master/Employee/employee-wage-indicator-save');

   }

}

public function ViewWageIndicator(Request $request){

   $compName = $request->session()->get('company_name');

	if($request->ajax()){

		$title    = 'View Wage Indicator Master';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    		$data = DB::table('MASTER_WAGEIND')->orderBy('WAGEIND_CODE','DESC');

    	}else if($userType=='superAdmin' ||$userType=='user'){    		
         $data = DB::table('MASTER_WAGEIND')->orderBy('WAGEIND_CODE','DESC');
      
      }else{

    		$data ='';
    	}


    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

    	return view('admin.finance.master.employee.view_wage_indicator');
	}else{

		return redirect('/useractivity');
	}

}

public function DeleteWageIndicator(Request $request){

	$wageindicator = $request->input('wageIn');
    	
   if ($wageindicator!='') {
    	
    	try{

    		$Delete = DB::table('MASTER_WAGEIND')->where('WAGEIND_CODE', $wageindicator)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Employee 
				Wage Indicator Was Deleted Successfully...!');
				
				return redirect('/Master/Employee/View-Emp-Wage-Indicator-Mast');

			}else{

				$request->session()->flash('alert-error', 'Employee Wage Indicator Can Not Deleted...!');
				
				return redirect('/Master/Employee/View-Emp-Wage-Indicator-Mast');

			}
		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Employee Wage Indicator Can not be Deleted...! Used In Another Transaction...!');
			
			return redirect('/Master/Employee/View-Emp-Wage-Indicator-Mast');
		}

   }else{

    	$request->session()->flash('alert-error', 'Zone  Not Found...!');
		
		return redirect('/Master/Employee/View-Emp-Wage-Indicator-Mast');

   }

}

public function EditEmpWageIndicator($WageIndicator){

 	$title = 'Edit Emp Wage Indicator Master';
   
   $WageIndicator = base64_decode($WageIndicator);
 	
 	if($WageIndicator!=''){

 	   $query = DB::table('MASTER_WAGEIND');
		$query->where('WAGEIND_CODE', $WageIndicator);
		$classData= $query->get()->first();

		$wageindicator_code = $classData->WAGEIND_CODE;

		$wageindicator_name = $classData->WAGEIND_NAME;

		$wageindicator_block = $classData->WAGEIND_BLOCK;

		$wageIndType = $classData->WAGEIND_TYPE;

		$button='Update';

		$action='/Master/Employee/form-emp-wage-indicator-update';

		return view('admin.finance.master.employee.wage_indicator',compact('title','wageindicator_code','wageindicator_name','wageindicator_block','button','action','wageIndType'));

		}else{

			$request->session()->flash('alert-error', 'Employee Wage Indicator Not Found...!');
			
			return redirect('/Master/Employee/View-Emp-Wage-Indicator-Mast');
		}

}

public function EmpWageIndicatorUpdate(Request $request){

	$validate = $this->validate($request, [

		'wageindicator_code' => 'required|max:4',
		'wageindicator_name' => 'required|max:30',
		'wageIndType'        => 'required|max:10',

	]);
		
         
	$wageIncode = $request->input('idwageindicator');

	date_default_timezone_set('Asia/Kolkata');

	$updatedDate = date("Y-m-d H:i:s");
	
	$createdBy   = $request->session()->get('userid');
	
	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');

	$data = array(
			
			"WAGEIND_CODE"   => $request->input('wageindicator_code'),
			"WAGEIND_NAME"   => $request->input('wageindicator_name'),
			"WAGEIND_TYPE"   => $request->input('wageIndType'),
			"WAGEIND_BLOCK"  => $request->input('wageindicator_block'),
			"FLAG"           => '0',
			"LAST_UPDATE_BY" => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
	);

		
	$saveData = DB::table('MASTER_WAGEIND')->where('WAGEIND_CODE', $wageIncode)->update($data);

	$discriptn_page = "Master wege indicator update done by user";
	$this->userLogInsert($createdBy,$discriptn_page);


	try{

		if ($saveData) {

			$request->session()->flash('alert-success', 'Employee Wage Indicator Was Successfully Updated...!');
			return redirect('/Master/Employee/View-Emp-Wage-Indicator-Mast');

		} else {

			$request->session()->flash('alert-error', 'Employee Wage Indicator Can Not Added...!');
			return redirect('/Master/Employee/View-Emp-Wage-Indicator-Mast');

		}
	}catch(Exception $ex){

	      $request->session()->flash('alert-error', 'Employee Wage Indicator Can not be Updated...! Used In Another Transaction...!');
			
			return redirect('/Master/Employee/View-Emp-Wage-Indicator-Mast');
	}

}

public function WageIndicatorType(Request $request){

   $wageindicator_code = $request->wageindicator_code;
     
   $response_array = array();
    	
    if ($request->ajax()) {

	   $fetch_reocrd = DB::table('MASTER_WAGEIND')->where('WAGEIND_CODE', $wageindicator_code)->get()->first();

	   if ($fetch_reocrd) {

		   $response_array['response'] = 'success';
         
         $response_array['data'] = $fetch_reocrd;
           
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

/*WAGE INDICATOR*/


/*Emp pay master*/

public function purchaseExcel(Request $request){
      return Excel::download(new PurchaseExport, 'purchase.xlsx');
}

public function contractExcel(Request $request){

    return Excel::download(new ContractExport('row'), 'contract.xlsx');
}

/*end Emp Pay Master*/

/* Star self declaration*/

public function SelfDeclaration(Request $request){
		
	$compName   = $request->session()->get('company_name');
   
   $fisYear  =  $request->session()->get('macc_year');
   
   $getcomcode    = explode('-', $compName);
	
	$comp_code = $getcomcode[0];
	
	$comp_name = $getcomcode[1];

   $transData['emp_list']    = DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->get();

	$transData['wageindicator_list'] = DB::table('MASTER_WAGEIND')->get();
		
	$transData['grade_list'] = DB::table('MASTER_GRADE')->get();

	$transData['rate_list'] = DB::table('MASTER_RATE_VALUE')->get();
	

	if(isset($compName)){

    		return view('admin.finance.master.employee.add_self_declaration',$transData, compact('compName','fisYear'));

	}else{

			return redirect('/useractivity');
	}

}

public function selfDeclarationSave(Request $request) { 
     
 	$validate = $this->validate($request, [

		'emp_code'  => 'required|unique:EMP_ITD,emp_code',
	]);
	 
	$createdBy   = $request->session()->get('userid');

	$compName    = $request->session()->get('company_name');
	
	$fisYear     =  $request->session()->get('macc_year');
	
	$getcomcode  = explode('-', $compName);
	
	$comp_code   = $getcomcode[0];
	
	$comp_name   = $getcomcode[1];
	
	$headC       = $request->input('wageindicator_code');
	
	$FilterArray = array_filter($headC);
	
	$HeadCount   = count($FilterArray);
	
	$emp_code    = $request->input('emp_code');

   $emp_details = DB::table('MASTER_EMP')->where('EMP_CODE', $emp_code)->get()->first();

	$sr                 = $request->input('srNo');
	
	$emp_code           = $request->input('emp_code');
	
	$emp_name           = $emp_details->EMP_NAME;
	
	$wageindicator_code = $request->input('wageindicator_code');
	
	$provAmt            = $request->input('provAmt');
	
	$actualAmt          = $request->input('actualAmt');
	
	$rangeAmt           = $request->input('rangeAmt');
	
	$flag               = '0';		
            
	for ($i = 0; $i < $HeadCount; $i++) {

	  	$wageIncode = $wageindicator_code[$i];
	  	
	  	$wageInName = DB::table('MASTER_WAGEIND')->where('WAGEIND_CODE', $wageIncode)->get()->first();
	  
	  	$data = array(
					
			"COMP_CODE"          => $comp_code,
			"COMPANY_NAME"       => $comp_name,
			"FY_YEAR"            => $request->input('fy_year'),
			"EMP_CODE"           => $request->input('emp_code'),
			"EMP_NAME"           => $emp_details->EMP_NAME,
			"WAGE_INDICATOR"     => $wageindicator_code[$i],
			"WAGEINDICATOR_NAME" => $wageInName->WAGEIND_NAME,
			"PROVISIONAL_AMT"    => $provAmt[$i],
			"ACTUAL_AMT"         => $actualAmt[$i],
			"RANGE_AMT"          => $rangeAmt[$i],
			"FLAG"               => '0',
			"CREATED_BY"         => $createdBy,
			"UPDATED_BY"         => $createdBy,
			 
		);

      $saveData = DB::table('EMP_ITD')->insert($data);

   }

   $discriptn_page = "Master selft declaration insert done by user";
	
	$this->userLogInsert($createdBy,$discriptn_page);
	    

	if($saveData) {

			$request->session()->flash('alert-success', 'Save Self Declaration Successfully...!');
			return redirect('/Master/Employee/view-self-declaration');

	}else{

			$request->session()->flash('alert-error', 'Self Declaration Can Not Added...!');
			return redirect('/Master/Employee/view-self-declaration');

   }

}

public function ViewSelfDeclaration(Request $request){
   
   $compName = $request->session()->get('company_name');

   if($request->ajax()){

   	$title    = 'View Self Declaration Master';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

		$getcomcode    = explode('-', $compName);
      
      $comp_code = $getcomcode[0];

    	if($userType=='admin'){

			$data = DB::table('EMP_ITD')->where('FY_YEAR',$fisYear)->where('COMP_CODE',$comp_code)->orderBy('ID','DESC');

    	}else if ($userType=='superAdmin' || $userType=='user') {    		

    	 $data = DB::table('EMP_ITD')->where('FY_YEAR',$fisYear)->where('COMP_CODE',$comp_code)->orderBy('ID','DESC');
    	
    	}
    	else{
    		$data ='';
    	}

        
    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){

	    	return view('admin.finance.master.employee.view_self_declaration');

	}else{

			return redirect('/useractivity');
	}

}


public function PTaxMaster(Request $request){
		
	$compName   = $request->session()->get('company_name');
   
   $fisYear  =  $request->session()->get('macc_year');

   $getcomcode    = explode('-', $compName);
	
	$comp_code = $getcomcode[0];

   $transData['pfct_list']    = DB::table('MASTER_PFCT')->get();

   if(isset($compName)){

    	return view('admin.finance.master.employee.add_p_tax',$transData, compact('compName','comp_code', 'fisYear'));

	    }else{

			return redirect('/useractivity');
	}

}

public function PTaxSave(Request $request){
		
	$validate = $this->validate($request, [

      'pfct_code' => 'required|unique:MASTER_PTAX',
      'april'    => 'required',
      'may'      => 'required',
      'jun'      => 'required',
      'jul'      => 'required',
      'aug'      => 'required',
      'sep'      => 'required',
      'oct'      => 'required',
      'nov'      => 'required',
      'dec'      => 'required',
      'jan'      => 'required',
      'feb'      => 'required',
      'mar'      => 'required',
	]);

	$compName   = $request->session()->get('company_name');
   
   $fisYear  =  $request->session()->get('macc_year');

   $getcomcode    = explode('-', $compName);
	
	$comp_code = $getcomcode[0];

	$comp_name = $getcomcode[1];

	$loginUser = $request->session()->get('userid');

	$data = array(

	 "COMP_CODE"      =>  $request->input('comp_code'),
	 "COMP_NAME"      =>  $comp_name,
	 "PFCT_CODE"      =>  $request->input('pfct_code'),
	 "PFCT_NAME"      =>  $request->input('pfct_name'),
	 "FY_CODE"        =>  $request->input('fy_code'),
	 "M04"            =>  $request->input('april'),
	 "M05"            =>  $request->input('may'),
	 "M06"            =>  $request->input('jun'),
	 "M07"            =>  $request->input('jul'),
	 "M08"            =>  $request->input('aug'),
	 "M09"            =>  $request->input('sep'),
	 "M10"            =>  $request->input('oct'),
	 "M11"            =>  $request->input('nov'),
	 "M12"            =>  $request->input('dec'),
	 "M01"            =>  $request->input('jan'),
	 "M02"            =>  $request->input('feb'),
	 "M03"            =>  $request->input('mar'),
	 "TOTAL"          =>  $request->input('total'),
	 "created_by"     =>  $request->session()->get('userid')
	);
	
	$saveData = DB::table('MASTER_PTAX')->insert($data);
	
	$discriptn_page = "Master PTax insert done by user";
	
	$this->userLogInsert($loginUser,$discriptn_page);

	if ($saveData) {

		$request->session()->flash('alert-success', 'P-TAX Details Successfully Save...!');
		
		return redirect('/Master/Employee/p-tax-master');

	}else{

		$request->session()->flash('alert-error', 'Employee Details Can Not Save...!');
		
		return redirect('/Master/Employee/p-tax-master');

	}

}
   /*end self declaration*/



/* --------- create entry in USER_LOG when user submit any form ------*/

function userLogInsert($loginuserId,$perticular){
		
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
		'PERTICULAR'  =>$discptn,
		'CREATED_BY'  =>$loginuserId
	);
	DB::table('USER_LOG')->insert($userLog);
		
}

/* --------- create entry in USER_LOG when user submit any form ------*/

}