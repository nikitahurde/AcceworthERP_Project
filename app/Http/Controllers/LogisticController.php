<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Session;
use DataTables;
use PHPMailer\PHPMailer\PHPMailer;
use Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Schema;
use App\Images;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\Paginator;
use Image;
use PDF;
use App\Exports\DeliveryOrderPendingReportExport;
use App\Exports\DeliveryOrderExport;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AccountingController;
use Maatwebsite\Excel\Facades\Excel;

class LogisticController extends Controller{

	private $data;

	public function __cunstruct($data){

		//$this->data = "smit@121";

	}

	public function CommonFunction($macc_year,$Comp_Code,$Tran_Code,$Tran_Code2){

         $queryData['item_um_aum_list'] = DB::table('MASTER_FY')->where('COMP_CODE',$Comp_Code)->where('FY_CODE',$macc_year)->get();

         $queryData['bank_list']        = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=',$Tran_Code)->orWhere('TRAN_CODE', '=',$Tran_Code2)->get();

         $queryData['transpoter_list']  = DB::table('MASTER_ACC')->get();
         $queryData['item_list']        = DB::table('MASTER_ITEM')->get();

      
        $queryData['qc_list']   = DB::table('PQCS_HEAD')->get()->toArray();
        $queryData['qc_body_list'] = DB::table('PQCS_BODY')->groupBy('ITEM_CODE')->get();


        return $queryData;

    }

/* ----------- start task master ------------*/

	public function TaskForm(Request $request){

    	$title = 'Add Task';
    	$userData['dept_list'] = DB::table('MASTER_DEPT')->get();
    
    	return view('admin.finance.master.task.task_master',$userData+compact('title'));
    }

    public function SaveTaskForm(Request $request)
    {

    	$validate = $this->validate($request, [

			'task_code'  => 'required|unique:MASTER_TASK,TASK_CODE',
			'task_name'  => 'required|max:40',
		
		]);

		$createdBy  = $request->session()->get('userid');
		
		$compName   = $request->session()->get('company_name');
		
		$fisYear    =  $request->session()->get('macc_year');
		
		$task_code  = $request->input('task_code');
		$task_name  = $request->input('task_name');
		$department = $request->input('department');
		$dept_name = $request->input('department');

		$data = array(

			"TASK_CODE"  => $task_code,
			"TASK_NAME"  => $task_name,
			"DEPT_CODE"  => $department,
			"DEPT_NAME"  => $dept_name,
			"CREATED_BY" => $createdBy,
			
		);

		$saveData = DB::table('MASTER_TASK')->insert($data);

		if($saveData){

			$request->session()->flash('alert-success', 'Task Was Successfully Added...!');
				return redirect('/view-mast-task');

		} else {

			$request->session()->flash('alert-error', 'Task Can Not Added...!');
			return redirect('/view-mast-task');

		}
    }

    public function TaskView(Request $request){

    	if($request->ajax()) {
			$title    = 'View Master Task';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');


	    	if($userType=='admin'){

	    		

	    		$data = DB::table('MASTER_TASK')
			->leftjoin('MASTER_DEPT','MASTER_TASK.DEPT_CODE','=','MASTER_DEPT.DEPT_CODE')
			->select('MASTER_TASK.*','MASTER_DEPT.DEPT_NAME as DEPTNAME')
			->orderBy('TASK_CODE','DESC');

			}else if($userType=='superAdmin' || $userType=='user'){

				$data = DB::table('MASTER_TASK')
			->leftjoin('MASTER_DEPT','MASTER_TASK.DEPT_CODE','=','MASTER_DEPT.DEPT_CODE')
			->select('MASTER_TASK.*','MASTER_DEPT.DEPT_NAME as DEPTNAME')
			->orderBy('TASK_CODE','DESC');
			}
			else{

				$data ='';
				
			}

			return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}
    	return view('admin.finance.master.task.view_task');

    }

    public function DeleteTask(Request $request){

    	$id = $request->post('deptId');
    	//print_r($destinationId);exit;

    	if ($id!='') {
    		
    		$Delete = DB::table('MASTER_TASK')->where('TASK_CODE', $id)->delete();

    		$request->session()->flash('alert-success', ' Task Was Deleted Successfully...!');
				return redirect('/view-mast-task');

    	}else{

    		$request->session()->flash('alert-error', 'Task Not Found...!');
			return redirect('/view-mast-task');

    	}
    }

    public function EditTaskMast(Request $request,$id){

    	$title = 'Edit Master Task';

    	$id = base64_decode($id);

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($id!=''){
    	    $query = DB::table('MASTER_TASK');
			$query->where('TASK_CODE', $id);
			$userData['task_list'] = $query->get()->first();

			$userData['dept_list']= DB::table('MASTER_DEPT')->get();

			return view('admin.finance.master.task.edit_task', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Task Not Found...!');
			return redirect('/view-mast-task');
		}
    }

    public function TaskMastUpdate(Request $request){

		$validate = $this->validate($request, [
			'task_code' => 'required|max:6',
			'task_name' => 'required|max:40',
		]);

        date_default_timezone_set('Asia/Kolkata');

		$lastUpdatedBy = $request->session()->get('userid');
		$updatedDate   = date("Y-m-d");

       $taskId = $request->input('taskcodeId');
		$data = array(
			"TASK_CODE"        => $request->input('task_code'),
			"TASK_NAME"        => $request->input('task_name'),
			"DEPT_CODE"        => $request->input('dept_code'),
			"DEPT_NAME"        => $request->input('dept_name'),
			"TASK_BLOCK"       => $request->input('task_block'),
			"LAST_UPDATE_BY"   => $lastUpdatedBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);
		
		$saveData = DB::table('MASTER_TASK')->where('TASK_CODE',$taskId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Task Was Successfully Updated...!');
			return redirect('/view-mast-task');

		} else {

			$request->session()->flash('alert-error', 'Task Can Not Updated...!');
			return redirect('/view-mast-task');

		}
    }

/* ----------- end task master ------------*/


/* ----------- start disel rate master ----------- */
	
	public function DiselRateForm(Request $request){

		$title = 'Add Diesel Rate';

		$date  = $request->old('date');
		$diesel_rate  = $request->old('diesel_rate');
		$petrol_rate    = $request->old('petrol_rate');
		$gas_rate       = $request->old('gas_rate');
		$electronic_rate = $request->old('electronic_rate');
		$id = $request->old('id');

		$button='Save';
    	$action='diesel-rate-save';
    	
    	return view('admin.finance.master.Logistic.diesel_rate',compact('title','date','diesel_rate','petrol_rate','gas_rate','electronic_rate','button','action','id'));
    }

    public function DiselRateSave(Request $request){

    	$validate = $this->validate($request, [

			'date'        => 'required',
			'diesel_rate' => 'required',

		]);

    	

    	$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

		$getDate = $request->input('date');

		$date = date("Y-m-d", strtotime($getDate)); 
        $createdBy = $request->session()->get('userid');

		$data = array(

			"DATE"        => $date,
			"DIESEL_RATE" => $request->input('diesel_rate'),
			"PETROL_RATE" => $request->input('petrol_rate'),
			"GAS_RATE"    => $request->input('gas_rate'),
			"ELECT_RATE"  => $request->input('electronic_rate'),
			"CREATED_BY"  => $createdBy,
			
		);
       
		$saveData = DB::table('MASTER_DIESEL_RATE')->insert($data);

		$discriptn_page = "Master Diesel Rate insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Diesel Rate Was Successfully Added...!');
			return redirect('/view-diesel-rate-mast');

		} else {

			$request->session()->flash('alert-error', 'Diesel Rate Can Not Added...!');
			return redirect('/view-diesel-rate-mast');

		}
    	
    }

    public function DiselRateView(Request $request){

    	if($request->ajax()) {

	    	$title    = 'View Diesel Rate';
			
			$userid   = $request->session()->get('userid');
			//print_r($userid);exit;
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

	    	if($userType=='admin'){
	    	
	    		$data = DB::table('MASTER_DIESEL_RATE')->orderBy('ID','DESC');

			}else if($userType=='superAdmin' || $userType=='user'){

				$data = DB::table('MASTER_DIESEL_RATE')->orderBy('ID','DESC');
				
			}
			else{

				$data ='';
				
			}

			return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}
       
        	return view('admin.finance.master.Logistic.view_diesel_rate');

        
    	
    }


     public function DeleteDiselRate(Request $request){

    	$MfgId = $request->post('mfgId');
    	//print_r($destinationId);exit;

    	if ($MfgId!='') {
    		
    		$Delete = DB::table('MASTER_VEHICLE_MFG')->where('MFG_CODE', $MfgId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Manufature Was Deleted Successfully...!');
				return redirect('/view-manufature');

			} else {

				$request->session()->flash('alert-error', 'Manufature Can Not Deleted...!');
				return redirect('/view-manufature');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Fleet Truck Wheel Not Found...!');
			return redirect('/view-flet-truck-wheel');

    	}
    }

    public function EditDiselRateMaster($id){

    	//print_r($id);
    	$id=base64_decode($id);

    	
    	if($id!=''){

		$title           = 'Add Diesel Rate';
		$data            = DB::table('MASTER_DIESEL_RATE')->where('ID', $id)->get()->first();
		
		$date            = $data->DATE;
		$diesel_rate     = $data->DIESEL_RATE;
		$petrol_rate     = $data->PETROL_RATE;
		$gas_rate        = $data->GAS_RATE;
		$electronic_rate = $data->ELECT_RATE;
		$id = $data->ID;

		$button='Update';
    	$action='diesel-rate-update';

    	 
    	
    	return view('admin.finance.master.Logistic.diesel_rate',compact('title','date','diesel_rate','petrol_rate','gas_rate','electronic_rate','button','action','id'));


		}else{
			$request->session()->flash('alert-error', 'Diesel Rate Not Found...!');
			return redirect('/diesel-rate-mast');
		}

    }

    public function DiselRateUpdate(Request $request){

    	//print_r($request->post());exit;

    	$validate = $this->validate($request, [

			'date'        => 'required',
			'diesel_rate' => 'required',

		]);

		$createdBy = $request->session()->get('userid');
		
		$compName  = $request->session()->get('company_name');
		
		$fisYear   =  $request->session()->get('macc_year');
		
		$getDate   = $request->input('date');
		$id        = $request->input('id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

		$data = array(

			"DATE"        => $getDate,
			"DIESEL_RATE" => $request->input('diesel_rate'),
			"PETROL_RATE" => $request->input('petrol_rate'),
			"GAS_RATE"    => $request->input('gas_rate'),
			"ELECT_RATE"  => $request->input('electronic_rate'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
		);
		

		$saveData = DB::table('MASTER_DIESEL_RATE')->where('ID', $id)->update($data);

		$discriptn_page = "Master Diesel Rate insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Diesel Rate Was Successfully Added...!');
			return redirect('/view-diesel-rate-mast');

		} else {

			$request->session()->flash('alert-error', 'Diesel Rate Can Not Added...!');
			return redirect('/view-diesel-rate-mast');

		}
    }



/*----------- start fleet master -----------*/

	



    public function LrExpenseForm(Request $request){

    	$title = 'Add Master LR Expnse';

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');
    	
		$userData['user_list']  = DB::table('MASTER_DEPOT')->get();
		
		$userData['mfg_list']   = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userData['wheel_list'] = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

		$userData['gl_list'] = DB::table('MASTER_GL')->get();

		$userData['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();
    
    	return view('admin.finance.master.Logistic.lr_exp_form',$userData+compact('title'));
    }



     public function LRExpFormSave(Request $request){

    	$createdBy = $request->session()->get('userid');

		$compName = $request->session()->get('company_name');
		$sliComp = explode('-',$compName);
	    $comp_code= $sliComp[0];
		
		$fisYear  =  $request->session()->get('macc_year');

		$indicator = $request->input('indicator');
		$indicator_name = $request->input('indicator_name');

		$FilterArray = array_filter($indicator);
			
		$count   = count($FilterArray);

		$index       = $request->input('index');
		$gl_code = $request->input('gl_code');
		$gl_name = $request->input('gl_name');


		for ($i=0; $i < $count; $i++) { 

			$data = array(

			"COMP_CODE"  => $comp_code,
			"FY_CODE"    => $fisYear,
			"LRIND"      => $indicator[$i],
			"LRIND_NAME" => $indicator_name[$i],
			"LRINDEX"    => $index[$i],
			"GL_CODE"    => $gl_code[$i],
			"GL_NAME"    => $gl_name[$i],
			"CREATED_BY" => $createdBy,
			
			
		);

		$saveData = DB::table('MASTER_LREXP')->insert($data);
			# code...
		}

	

		$discriptn_page = "Master LR Exp insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if($saveData){

			$request->session()->flash('alert-success', 'LR Expense Was Successfully Added...!');
				return redirect('/view-lr-exp-mast');

		} else {

			$request->session()->flash('alert-error', 'LR Expense Can Not Added...!');
			return redirect('/view-lr-exp-mast');

		}
    }


    public function LrExpenseView(Request $request){

    	if($request->ajax()) {

			$title    = 'View Master Fleet';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			$sliComp = explode('-',$compName);
			$comp_code= $sliComp[0];
			$fisYear  =  $request->session()->get('macc_year');


	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_LREXP')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('LREXPID','ASC');

	    	 

			}else if($userType=='superAdmin' || $userType=='user'){

				$data = DB::table('MASTER_LREXP')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->orderBy('LREXPID','ASC');

				//return view('admin.view_dealer',$dealerData);
			}
			else{

				$data ='';
				//return view('admin.view_dealer',$dealerData);
			}


			 return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}
    	return view('admin.finance.master.Logistic.view_lrexp');

    }

    public function EditLrExpenseMaster(Request $request,$id){

    	$title = 'Edit LrExpense Master';

    	$id = base64_decode($id);
    	// print_r($id);exit;

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');


    	if($id!=''){
    	    $query = DB::table('MASTER_LREXP');
			$query->where('LREXPID', $id);
			$userData['lrexp_list'] = $query->get()->first();

			// $count = count($userData['lrexp_list']);

			// print_r($count);exit();

			$LRIND = $userData['lrexp_list']->LRIND;

			$userData['user_list']= DB::table('MASTER_DEPOT')->get();

    		$userData['mfg_list']= DB::table('MASTER_VEHICLE_MFG')->get();

   			$userData['wheel_list']= DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

   			$userData['gl_list'] = DB::table('MASTER_GL')->get();

		    $userData['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();
    

			return view('admin.finance.master.Logistic.edit_lr_exp_form', $userData+compact('title','LRIND'));

		}else{
			$request->session()->flash('alert-error', 'Fleet Not Found...!');
			return redirect('/view-mast-fleet');
		}
    }

    public function LrExpenseFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'indicator' => 'required',
			'index'     => 'required',
			'gl_code'   => 'required',
			

		]);

    	$createdBy      = $request->session()->get('userid');
		
		$compName       = $request->session()->get('company_name');
		$sliComp        = explode('-',$compName);
		$comp_code      = $sliComp[0];
		
		$fisYear        =  $request->session()->get('macc_year');
		
		$indicator      = $request->input('indicator');
		$indicator_name = $request->input('indicator_name');
		$id             = $request->input('lrIndId');
		
		$index          = $request->input('index');
		$gl_code        = $request->input('gl_code');
		$gl_name        = $request->input('gl_name');
		// print_r($gl_name);exit();


		$data = array(

			"COMP_CODE"  => $comp_code,
			"FY_CODE"    => $fisYear,
			"LRIND"      => $indicator,
			"LRIND_NAME" => $indicator_name,
			"LRINDEX"    => $index,
			"GL_CODE"    => $gl_code,
			"GL_NAME"    => $gl_name,
			"CREATED_BY" => $createdBy,
			
			
		);

		$saveData = DB::table('MASTER_LREXP')->where('LREXPID',$id)->update($data);
		
		$discriptn_page = "Master LR Expenses done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if($saveData){

			$request->session()->flash('alert-success', 'LR Expense Was Update Successfully ...!');
				return redirect('/view-lr-exp-mast');

		} else {

			$request->session()->flash('alert-error', 'LR Expense Can Not Added...!');
			return redirect('/view-lr-exp-mast');

		}
    }



    public function FleetExpenseForm(Request $request){

    	$title = 'Add Master LR Expnse';

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');
    	
		$userData['user_list']  = DB::table('MASTER_DEPOT')->get();
		
		$userData['mfg_list']   = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userData['wheel_list'] = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

		$userData['gl_list'] = DB::table('MASTER_GL')->get();

		$userData['lrexp_list'] = DB::table('MASTER_LREXP')->get();

		$userData['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();
    
    	return view('admin.finance.master.Logistic.fleet_exp_form',$userData+compact('title'));
    }



    public function FleetExpenseFormSave(Request $request)
    {

    	

    	$validate = $this->validate($request, [

			'indicator' => 'required',
			'index'     => 'required',
			'gl_code'   => 'required|max:30',
			

		]);

		$createdBy = $request->session()->get('userid');

		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

		$fleet_type = $request->input('fleet_type');

		$FilterArray = array_filter($fleet_type);

		$count = count($FilterArray);

		$indicator = $request->input('indicator');

		$rate    = $request->input('rate');

		$index       = $request->input('index');
		$gl_code = $request->input('gl_code');


		for ($i=0; $i < $count; $i++) { 

			$data = array(

			"COMP_CODE"  => $compName,
			"FY_CODE"    => $fisYear,
			"FLEET_TYPE" => $fleet_type[$i],
			"RATE"       => $rate[$i],
			"FLEETIND"   => $indicator[$i],
			"FLEETINDEX" => $index[$i],
			"GL_CODE"    => $gl_code[$i],
			"CREATED_BY" => $createdBy,
			
			
		);

		$saveData = DB::table('MASTER_FLEETEXP')->insert($data);
			# code...
		}
	

		$discriptn_page = "Master LR Exp insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if($saveData){

			$request->session()->flash('alert-success', 'Fleet Was Successfully Added...!');
				return redirect('/view-mast-fleet');

		} else {

			$request->session()->flash('alert-error', 'Fleet Can Not Added...!');
			return redirect('/view-mast-fleet');

		}
    }



    public function FleetExpenseView(Request $request){

    	if($request->ajax()) {
			$title    = 'View Master Fleet';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');


	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_FLEETEXP')->orderBy('FLEETIND','DESC');


			}else if($userType=='superAdmin' || $userType=='user'){

				$data = DB::table('MASTER_FLEETEXP')->orderBy('FLEETIND','DESC');

				//return view('admin.view_dealer',$dealerData);
			}
			else{

				$data ='';
				//return view('admin.view_dealer',$dealerData);
			}


			 return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}
    	return view('admin.finance.master.Logistic.view_fleetexp');

    }

    public function FleetForm(Request $request){

		$title                       = 'Add Master Fleet';
		
		$compName                    = $request->session()->get('company_name');
		
		$fisYear                     =  $request->session()->get('macc_year');
		
		$userData['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userData['truck_list']      = DB::table('MASTER_FLEET')->get();
		
		$userData['comp_list']       = DB::table('MASTER_COMP')->get();
		
		$userData['cost_list']       = DB::table('MASTER_COST')->get();
		
		$userData['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userData['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();
		
		$userData['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();
    
    	return view('admin.finance.master.Logistic.fleet_form',$userData+compact('title'));
    }


    public function FleetListSyncAllVehcile(Request $request){
    	
    	if($request->ajax()) {

    		$response_array = array();

    		$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			$sliComp = explode('-',$compName);
			$comp_code= $sliComp[0];
			$comp_name= $sliComp[1];
			$fisYear  =  $request->session()->get('macc_year');

    		$fleet_list1 = DB::table('MASTER_FLEET')->get();
			$fleet_list = json_decode(json_encode($fleet_list1),true);

    		
    		foreach ($fleet_list as $row) {

    			$vehicle_no = $row['TRUCK_NO'];



    			$fleet_comp_code = $row['COMP_CODE'];

    			$fleet_comp_name = $row['COMP_NAME'];

    			$token = $request->session()->get('api_token');

    			/*echo "<pre>";
				print_r($token);
    			exit();*/

		    	$authorization = "Authorization: Bearer ".$token;

		    	$curl = curl_init();
		        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); 
		    
				curl_setopt($curl, CURLOPT_URL, "https://ulip.logilocker.in/logilocker/api/vahan?vehicleNo=".$vehicle_no."&gstin=''&forceUpdate=true");
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($curl);
				curl_close($curl);
				$data1 = json_decode($result, true);



				// echo '<PRE>';print_r($data1['response']=='puccUpto');

				/*$fitUpto         = $data1['response']['fitUpto'];
				$insuranceUpto   = $data1['response']['insuranceUpto'];
				$taxUpto         = $data1['response']['taxUpto'];
				$permitValidUpto = $data1['response']['permitValidUpto'];
				$puccUpto        = $data1['response']['puccUpto'];*/

				if($data1 !='' || $data1 !=null){

				$FLEETCERTF = DB::table('FLEET_CERTF_TRAN')->where('TRUCK_NO',$vehicle_no)->get()->toArray();

				$FLEETCERTFCOUNT = count($FLEETCERTF);


				if ($FLEETCERTFCOUNT > 0) {

					foreach ($FLEETCERTF as $key) {
					       

						if (isset($key->CERTF_CODE) && $key->CERTF_CODE == 'CF') {

							$getNewRenewDt = $data1['response']['fitUpto'];

							date_default_timezone_set('Asia/Kolkata');

							$dateReDt = str_replace('/', '-', $getNewRenewDt);

							$newDate = date("Y-m-d", strtotime($dateReDt));

							$crtNwRewDt = date_create($newDate);

							date_sub($crtNwRewDt,date_interval_create_from_date_string("1 days"));

							$updatedDate = date("Y-m-d h:i:s");

							$data = array(
								"CRENEW_DUEDT"     =>  $newDate,
								"CERTF_RENEW_DATE" =>  $crtNwRewDt,
								"FLAG"             =>  0,
								"LAST_UPDATE_BY"   =>  $userid,
								"LAST_UPDATE_DATE" =>  $updatedDate
					    	);

					    	$updateData = DB::table('FLEET_CERTF_TRAN')->where([['TRUCK_NO', '=', $key->TRUCK_NO],['CERTF_CODE','=','CF']])->update($data);

							
						}else if(isset($key->CERTF_CODE) && $key->CERTF_CODE == 'Insurance'){

							$getNewRenewDt = $data1['response']['insuranceUpto'];

							date_default_timezone_set('Asia/Kolkata');

							$dateReDt = str_replace('/', '-', $getNewRenewDt);

							$newDate = date("Y-m-d", strtotime($dateReDt));

							$crtNwRewDt = date_create($newDate);

							date_sub($crtNwRewDt,date_interval_create_from_date_string("1 days"));

							$updatedDate = date("Y-m-d h:i:s");

							$data = array(
								"CRENEW_DUEDT"     =>  $newDate,
								"CERTF_RENEW_DATE" =>  $crtNwRewDt,
								"FLAG"             =>  0,
								"LAST_UPDATE_BY"   =>  $userid,
								"LAST_UPDATE_DATE" =>  $updatedDate
					    	);

					    	$updateData = DB::table('FLEET_CERTF_TRAN')->where([['TRUCK_NO', '=', $key->TRUCK_NO],['CERTF_CODE','=','Insurance']])->update($data);


						}else if(isset($key->CERTF_CODE) && $key->CERTF_CODE == 'RTO'){

							$getNewRenewDt = $data1['response']['taxUpto'];

							date_default_timezone_set('Asia/Kolkata');

							$dateReDt = str_replace('/', '-', $getNewRenewDt);

							$newDate = date("Y-m-d", strtotime($dateReDt));

							$crtNwRewDt = date_create($newDate);

							date_sub($crtNwRewDt,date_interval_create_from_date_string("1 days"));

							$updatedDate = date("Y-m-d h:i:s");

							$data = array(
								"CRENEW_DUEDT"     =>  $newDate,
								"CERTF_RENEW_DATE" =>  $crtNwRewDt,
								"FLAG"             =>  0,
								"LAST_UPDATE_BY"   =>  $userid,
								"LAST_UPDATE_DATE" =>  $updatedDate
					    	);

					    	$updateData = DB::table('FLEET_CERTF_TRAN')->where([['TRUCK_NO', '=', $key->TRUCK_NO],['CERTF_CODE','=','RTO']])->update($data);


						}else if(isset($key->CERTF_CODE) && $key->CERTF_CODE == 'S-Permit'){

							$getNewRenewDt = $data1['response']['permitValidUpto'];

							date_default_timezone_set('Asia/Kolkata');

							$dateReDt = str_replace('/', '-', $getNewRenewDt);

							$newDate = date("Y-m-d", strtotime($dateReDt));

							$crtNwRewDt = date_create($newDate);

							date_sub($crtNwRewDt,date_interval_create_from_date_string("1 days"));

							$updatedDate = date("Y-m-d h:i:s");

							$data = array(
								"CRENEW_DUEDT"     =>  $newDate,
								"CERTF_RENEW_DATE" =>  $crtNwRewDt,
								"FLAG"             =>  0,
								"LAST_UPDATE_BY"   =>  $userid,
								"LAST_UPDATE_DATE" =>  $updatedDate
					    	);

					    	$updateData = DB::table('FLEET_CERTF_TRAN')->where([['TRUCK_NO', '=', $key->TRUCK_NO],['CERTF_CODE','=','S-Permit']])->update($data);


						}else if(isset($key->CERTF_CODE) && $key->CERTF_CODE == 'N-Permit'){

							$getNewRenewDt = $data1['response']['permitValidUpto'];

							date_default_timezone_set('Asia/Kolkata');

							$dateReDt = str_replace('/', '-', $getNewRenewDt);

							$newDate = date("Y-m-d", strtotime($dateReDt));

							$crtNwRewDt = date_create($newDate);

							date_sub($crtNwRewDt,date_interval_create_from_date_string("1 days"));

							$updatedDate = date("Y-m-d h:i:s");

							$data = array(
								"CRENEW_DUEDT"     =>  $newDate,
								"CERTF_RENEW_DATE" =>  $crtNwRewDt,
								"FLAG"             =>  0,
								"LAST_UPDATE_BY"   =>  $userid,
								"LAST_UPDATE_DATE" =>  $updatedDate
					    	);

					    	$updateData = DB::table('FLEET_CERTF_TRAN')->where([['TRUCK_NO', '=', $key->TRUCK_NO],['CERTF_CODE','=','N-Permit']])->update($data);


						}else if(isset($key->CERTF_CODE) && $key->CERTF_CODE == 'Pollution'){

							// echo '<PRE>';print_r($data1['response'][]);

							

							if (array_key_exists("puccUpto",$data1['response'])){

                              $getNewRenewDt = $data1['response']['puccUpto'];

							}else{
								$getNewRenewDt = '';
							}
							// if($getNewRenewDt){

							// }
							// $getNewRenewDt = $data1['response']['puccUpto'];

							date_default_timezone_set('Asia/Kolkata');

							$dateReDt = str_replace('/', '-', $getNewRenewDt);

							$newDate = date("Y-m-d", strtotime($dateReDt));

							$crtNwRewDt = date_create($newDate);

							date_sub($crtNwRewDt,date_interval_create_from_date_string("1 days"));

							$updatedDate = date("Y-m-d h:i:s");

							$data = array(
								"CRENEW_DUEDT"     =>  $newDate,
								"CERTF_RENEW_DATE" =>  $crtNwRewDt,
								"FLAG"             =>  0,
								"LAST_UPDATE_BY"   =>  $userid,
								"LAST_UPDATE_DATE" =>  $updatedDate
					    	);

					    	$updateData = DB::table('FLEET_CERTF_TRAN')->where([['TRUCK_NO', '=', $key->TRUCK_NO],['CERTF_CODE','=','Pollution']])->update($data);

						}else{

							$updateData = false;

						}

					}
					
				}else{

					$curl = curl_init();
			        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); 
			    
					curl_setopt($curl, CURLOPT_URL, "https://ulip.logilocker.in/logilocker/api/vahan?vehicleNo=".$vehicle_no."&gstin=''&forceUpdate=true");
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$result = curl_exec($curl);
					curl_close($curl);
					$data1 = json_decode($result, true);

					if (isset($data1['response']['fitUpto']) && $data1['response']['fitUpto'] != ' ') {

						$getNewRenewDt = $data1['response']['fitUpto'];

						date_default_timezone_set('Asia/Kolkata');

						$dateReDt = str_replace('/', '-', $getNewRenewDt);

						$newDate = date("Y-m-d", strtotime($dateReDt));

						$crtNwRewDt = date_create($newDate);

						date_sub($crtNwRewDt,date_interval_create_from_date_string("1 days"));

						$data = array(
							"COMP_CODE"        =>  $fleet_comp_code,
							"COMP_NAME"        =>  $fleet_comp_name,
							"TRUCK_NO"         =>  $vehicle_no,
							"CERTF_CODE"       =>  'CF',
							"CERTF_NAME"       =>  'Certificate Of Fitness',
							"CRENEW_DUEDT"     =>  $newDate,
							"CERTF_RENEW_DATE" =>  $crtNwRewDt,
							"FLAG"             =>  0,
							"CREATED_BY"       =>  $userid
				    	);

				    	$addData = DB::table('FLEET_CERTF_TRAN')->insert($data);

						
					}else{

					} 

					if(isset($data1['response']['insuranceUpto']) && $data1['response']['insuranceUpto'] != ' '){

						$getNewRenewDt = $data1['response']['insuranceUpto'];

						date_default_timezone_set('Asia/Kolkata');

						$dateReDt = str_replace('/', '-', $getNewRenewDt);

						$newDate = date("Y-m-d", strtotime($dateReDt));

						$crtNwRewDt = date_create($newDate);

						date_sub($crtNwRewDt,date_interval_create_from_date_string("1 days"));

						$data = array(
							"COMP_CODE"        =>  $fleet_comp_code,
							"COMP_NAME"        =>  $fleet_comp_name,
							"TRUCK_NO"         =>  $vehicle_no,
							"CERTF_CODE"       =>  'Insurance',
							"CERTF_NAME"       =>  'Vehicle Insurance',
							"CRENEW_DUEDT"     =>  $newDate,
							"CERTF_RENEW_DATE" =>  $crtNwRewDt,
							"FLAG"             =>  0,
							"CREATED_BY"       =>  $userid
				    	);

				    	$addData = DB::table('FLEET_CERTF_TRAN')->insert($data);


					}else{}

					 if(isset($data1['response']['taxUpto']) && $data1['response']['taxUpto'] != ' '){

						$getNewRenewDt = $data1['response']['taxUpto'];

						date_default_timezone_set('Asia/Kolkata');

						$dateReDt = str_replace('/', '-', $getNewRenewDt);

						$newDate = date("Y-m-d", strtotime($dateReDt));

						$crtNwRewDt = date_create($newDate);

						date_sub($crtNwRewDt,date_interval_create_from_date_string("1 days"));

						$data = array(
							"COMP_CODE"        =>  $fleet_comp_code,
							"COMP_NAME"        =>  $fleet_comp_name,
							"TRUCK_NO"         =>  $vehicle_no,
							"CERTF_CODE"       =>  'RTO',
							"CERTF_NAME"       =>  'RTO Tax',
							"CRENEW_DUEDT"     =>  $newDate,
							"CERTF_RENEW_DATE" =>  $crtNwRewDt,
							"FLAG"             =>  0,
							"CREATED_BY"       =>  $userid
				    	);

				    	$addData = DB::table('FLEET_CERTF_TRAN')->insert($data);


					}else{}

					if(isset($data1['response']['permitValidUpto']) && $data1['response']['permitValidUpto'] != ' '){

						$getNewRenewDt = $data1['response']['permitValidUpto'];

						date_default_timezone_set('Asia/Kolkata');

						$dateReDt = str_replace('/', '-', $getNewRenewDt);

						$newDate = date("Y-m-d", strtotime($dateReDt));

						$crtNwRewDt = date_create($newDate);

						date_sub($crtNwRewDt,date_interval_create_from_date_string("1 days"));

						$data = array(
							"COMP_CODE"        =>  $fleet_comp_code,
							"COMP_NAME"        =>  $fleet_comp_name,
							"TRUCK_NO"         =>  $vehicle_no,
							"CERTF_CODE"       =>  'S-Permit',
							"CERTF_NAME"       =>  'State Permit',
							"CRENEW_DUEDT"     =>  $newDate,
							"CERTF_RENEW_DATE" =>  $crtNwRewDt,
							"FLAG"             =>  0,
							"CREATED_BY"       =>  $userid
				    	);

				    	$addData = DB::table('FLEET_CERTF_TRAN')->insert($data);


					}else{} 

					if(isset($data1['response']['permitValidUpto']) && $data1['response']['permitValidUpto'] != ' '){

						$getNewRenewDt = $data1['response']['permitValidUpto'];

						date_default_timezone_set('Asia/Kolkata');

						$dateReDt = str_replace('/', '-', $getNewRenewDt);

						$newDate = date("Y-m-d", strtotime($dateReDt));

						$crtNwRewDt = date_create($newDate);

						date_sub($crtNwRewDt,date_interval_create_from_date_string("1 days"));

						$data = array(
							"COMP_CODE"        =>  $fleet_comp_code,
							"COMP_NAME"        =>  $fleet_comp_name,
							"TRUCK_NO"         =>  $vehicle_no,
							"CERTF_CODE"       =>  'N-Permit',
							"CERTF_NAME"       =>  'National Permit',
							"CRENEW_DUEDT"     =>  $newDate,
							"CERTF_RENEW_DATE" =>  $crtNwRewDt,
							"FLAG"             =>  0,
							"CREATED_BY"       =>  $userid
				    	);

				    	$addData = DB::table('FLEET_CERTF_TRAN')->insert($data);


					}else{} 

					if(isset($data1['response']['puccUpto']) && $data1['response']['puccUpto'] != ' '){

						$getNewRenewDt = $data1['response']['puccUpto'];

						date_default_timezone_set('Asia/Kolkata');

						$dateReDt = str_replace('/', '-', $getNewRenewDt);

						$newDate = date("Y-m-d", strtotime($dateReDt));

						$crtNwRewDt = date_create($newDate);

						date_sub($crtNwRewDt,date_interval_create_from_date_string("1 days"));

						$data = array(
							"COMP_CODE"        =>  $fleet_comp_code,
							"COMP_NAME"        =>  $fleet_comp_name,
							"TRUCK_NO"         =>  $vehicle_no,
							"CERTF_CODE"       =>  'Pollution',
							"CERTF_NAME"       =>  'PUC',
							"CRENEW_DUEDT"     =>  $newDate,
							"CERTF_RENEW_DATE" =>  $crtNwRewDt,
							"FLAG"             =>  0,
							"CREATED_BY"       =>  $userid
				    	);

				    	$addData = DB::table('FLEET_CERTF_TRAN')->insert($data);

					}else{

						$addData = false;

					}

				}/* /.second query if close */

				}


    		}/* /.first foreach loop */

    		$response_array = array();

	    	if(isset($addData) || isset($updateData)){

	    		$response_array['response'] = 'success';
	    		$response_array['data'] = 'success';
	    		$data = json_encode($response_array);

	            print_r($data);


	    	}else{

	    		$response_array['response'] = 'error';
	    		$response_array['data'] = '';
	    		$data = json_encode($response_array);

	            print_r($data);

	    	}

    		
    	}/* /.ajax if */


    }/* /.function close */


    public function FleetFormSave(Request $request){

    	if($request->ajax()) {

    	 $regd_date = $request->input('regd_date'); 
    	 $truck_no = $request->input('truck_no'); 
    	 $comp_code = $request->input('comp_code'); 

    	 $checkExitData = DB::table('MASTER_FLEET')->where('TRUCK_NO',$truck_no)->where('COMP_CODE', $comp_code)->get()->first();
          $createdBy 	= $request->session()->get('userid');

    	 //$createdBy = $request->session()->get('userid');
         
    	 if($checkExitData == ''){

    	 	$data = array(
			
			"COMP_CODE"    => $request->input('comp_code'),
			"COMP_NAME"    => $request->input('comp_name'),
			"TRUCK_NO"     => $request->input('truck_no'),
			"OWNER"        => $request->input('owner'),
			"OWNER_NAME"   => $request->input('owner_name'),
			"REGD_DATE"    => $regd_date,
			"MAKE"         => $request->input('make'),
			"MODEL"        => $request->input('model'),
			"COST_CODE"    => $request->input('cost_code'),
			"WHEEL_TYPE"   => $request->input('wheel_type'),
			"WHEEL_TYPE_NAME"   => $request->input('wheelTypeName'),
			"FREIGHTTYPE_CODE"  => $request->input('freight_type_code'),
			"FREIGHTTYPE_NAME"  => $request->input('freight_type_name'),
			"BODY_LENGTH"  => $request->input('body_length'),
			"COLOUR"       => $request->input('colour'),
			"CHASIS_NO"    => $request->input('chasis_no'),
			"ENGINE_NO"    => $request->input('engine_no'),
			"MFG_YR"       => $request->input('mfg_yr'),
			"GROSS_WEIGHT" => $request->input('gross_weight'),
			"TARE_WEIGHT"  => $request->input('tare_weight'),
			"RC_WEIGHT"    => $request->input('rc_weight'),
			"LOAD_CPCT"    => $request->input('load_capacity'),
			"LOAD_AVG"     => $request->input('load_average'),
			"UL_CPCT"      => $request->input('underload_capacity'),
			"UL_AVG"       => $request->input('underload_average'),
			"EMPTY_AVG"    => $request->input('empty_average'),
			"CREATED_BY"   => $createdBy,
			
			
		);
    	 	
		$saveData = DB::table('MASTER_FLEET')->insert($data);

		$lastid = DB::getPdo()->lastInsertId();

		$vehicalData = DB::table('MASTER_FLEET')->where('MASTERFLEETID', $lastid)->get()->first();


		$response_array = array();
			if($saveData){
				$response_array['response'] = 'success';
				$response_array['data'] = $vehicalData;
				$data = json_encode($response_array);
	            print_r($data);
	        }else{
	        	$response_array['response'] = 'error';
	        	$response_array['data'] = '';
				$data = json_encode($response_array);
	            print_r($data);
	        }

    	 }else{

			$response_array['response'] = 'duplicate';
			$response_array['data']     = '';
			$response_array['message']  = 'Can not save duplicate Truck No';
			$data = json_encode($response_array);
	        print_r($data);

    	 }
    	 

    	 

    	}else{

	        $validate = $this->validate($request, [

				'owner'         => 'required',
				
			]);

    	$regd_date = date("Y-m-d", strtotime($request->input('regd_date')));

    	$owner = $request->input('owner');

    	if($owner=='MARKET'){
    		
    		$validate = $this->validate($request, [

			'owner_name'    => 'required',
			'truck_no'      => 'required|max:13',
			'owner'         => 'required',
			'regd_date'     => 'required|max:10',
			'make'          => 'required|max:30',
			'model'         => 'required|max:30',
			'wheel_type'    => 'required|max:4',
			'colour'        => 'required',
			'chasis_no'     => 'required',
			'engine_no'     => 'required',
			'mfg_yr'        => 'required',
			'tare_weight'   => 'required',
			'gross_weight'  => 'required',
			'load_capacity' => 'required|max:6',
			'load_average'  => 'required',
			'empty_average' => 'required',
			

		]);
    	}else{

    		$validate = $this->validate($request, [

			'comp_code'     => 'required|max:6',
			'comp_name'     => 'required',
			'cost_code'     => 'required|max:6',
			'owner'         => 'required',
			'truck_no'      => 'required|max:13',
			'regd_date'     => 'required|max:10',
			'make'          => 'required|max:30',
			'model'         => 'required|max:30',
			'wheel_type'    => 'required|max:4',
			'colour'        => 'required',
			'chasis_no'     => 'required',
			'engine_no'     => 'required',
			'mfg_yr'        => 'required',
			'tare_weight'   => 'required',
			'gross_weight'  => 'required',
			'load_capacity' => 'required|max:6',
			'load_average'  => 'required',
			'empty_average' => 'required',
			

		]);

    	}

    	
		$createdBy = $request->session()->get('userid');

		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

		$depot_code = $request->input('depot_code');
		$make       = $request->input('make');
		$wheel_type = $request->input('wheel_type');

	    $truck_no = $request->input('truck_no'); 
	    $comp_code = $request->input('comp_code'); 

	    $checkExitData = DB::table('MASTER_FLEET')->where('TRUCK_NO',$truck_no)->where('COMP_CODE', $comp_code)->get()->first();

	    if($checkExitData == ''){

		    	$data = array(
				
				"COMP_CODE"    => $request->input('comp_code'),
				"COMP_NAME"    => $request->input('comp_name'),
				"TRUCK_NO"     => $request->input('truck_no'),
				"OWNER"        => $request->input('owner'),
				"OWNER_NAME"   => $request->input('owner_name'),
				"REGD_DATE"    => $regd_date,
				"MAKE"         => $request->input('make'),
				"MODEL"        => $request->input('model'),
				"COST_CODE"    => $request->input('cost_code'),
				"WHEEL_TYPE"   => $request->input('wheel_type'),
				"COLOUR"       => $request->input('colour'),
				"FREIGHTTYPE_CODE"  => $request->input('freight_type_code'),
				"FREIGHTTYPE_NAME"  => $request->input('freight_type_name'),
				"BODY_LENGTH"  => $request->input('body_length'),
				"CHASIS_NO"    => $request->input('chasis_no'),
				"ENGINE_NO"    => $request->input('engine_no'),
				"MFG_YR"       => $request->input('mfg_yr'),
				"GROSS_WEIGHT" => $request->input('gross_weight'),
				"TARE_WEIGHT"  => $request->input('tare_weight'),
				"RC_WEIGHT"    => $request->input('rc_weight'),
				"LOAD_CPCT"    => $request->input('load_capacity'),
				"LOAD_AVG"     => $request->input('load_average'),
				"UL_CPCT"      => $request->input('underload_capacity'),
				"UL_AVG"       => $request->input('underload_average'),
				"EMPTY_AVG"    => $request->input('empty_average'),
				"CREATED_BY"   => $createdBy,
				
				
			);

			$saveData = DB::table('MASTER_FLEET')->insert($data);

			$discriptn_page = "Master fleet insert done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if($saveData){

				$request->session()->flash('alert-success', 'Fleet Was Successfully Added...!');
					return redirect('/view-mast-fleet');

			} else {

				$request->session()->flash('alert-error', 'Fleet Can Not Added...!');
				return redirect('/view-mast-fleet');

			}

	    }else{

	    	$request->session()->flash('alert-error', 'Duplicate Fleet Can Not Added...!');
				return redirect('/form-mast-fleet');

	    }
		
     }

       
    }

    public function FleetView(Request $request){

    	if($request->ajax()) {
			$title    = 'View Master Fleet';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');


	    	$data = DB::table('MASTER_FLEET')->orderBy('TRUCK_NO','DESC');


			 return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}
    	return view('admin.finance.master.Logistic.view_fleet');

    }

    public function EditFleetMaster(Request $request,$id){

    	$title = 'Edit Master Fleet';

    	$id = base64_decode($id);

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');


    	if($id!=''){
    	    $query = DB::table('MASTER_FLEET');
			$query->where('MASTERFLEETID', $id);
			$userData['fleet_list'] = $query->get()->first();

			$userData['user_list']  = DB::table('MASTER_DEPOT')->get();

			$userData['truck_list']  = DB::table('MASTER_FLEET')->get();

			$userData['comp_list']  = DB::table('MASTER_COMP')->get();

			$userData['cost_list']  = DB::table('MASTER_COST')->get();
			
			$userData['mfg_list']   = DB::table('MASTER_VEHICLE_MFG')->get();
			
			$userData['wheel_list'] = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

			$userData['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();

			return view('admin.finance.master.Logistic.fleet_list', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Fleet Not Found...!');
			return redirect('/view-mast-fleet');
		}
    }

    public function FleetFormUpdate(Request $request){

    	$regd_date = date("Y-m-d", strtotime($request->input('regd_date')));


  //   		$validate = $this->validate($request, [

		// 	'owner'         => 'required',
		// 	'truck_no'      => 'required|max:13',
		// 	'regd_date'     => 'required|max:10',
		// 	'make'          => 'required|max:30',
		// 	'model'         => 'required|max:30',
		// 	'cost_code'     => 'required|max:30',
		// 	'wheel_type'    => 'required|max:4',
		// 	'load_capacity' => 'required|max:6',
		// 	'load_average'  => 'required',
		// 	'empty_average' => 'required',

			

		// ]);

		$validate = $this->validate($request, [

				'owner'         => 'required',
				
		]);

		$owner = $request->input('owner');

		if($owner=='MARKET'){
    		
    		$validate = $this->validate($request, [

			'truck_no'      => 'required|max:13',
			'owner'         => 'required',
			'owner_name'    => 'required',
			'regd_date'     => 'required|max:10',
			'make'          => 'required|max:30',
			'model'         => 'required|max:30',
			'wheel_type'    => 'required|max:4',
			'colour'        => 'required',
			'chasis_no'     => 'required',
			'engine_no'     => 'required',
			'mfg_yr'        => 'required',
			'tare_weight'   => 'required',
			'gross_weight'  => 'required',
			'load_capacity' => 'required|max:6',
			'load_average'  => 'required',
			'empty_average' => 'required',
			

		]);
    	}else{

    		$validate = $this->validate($request, [

			'comp_code'     => 'required|max:6',
			'comp_name'     => 'required',
			'cost_code'     => 'required|max:6',
			'owner'         => 'required',
			'truck_no'      => 'required|max:13',
			'regd_date'     => 'required|max:10',
			'make'          => 'required|max:30',
			'model'         => 'required|max:30',
			'wheel_type'    => 'required|max:4',
			'colour'        => 'required',
			'chasis_no'     => 'required',
			'engine_no'     => 'required',
			'mfg_yr'        => 'required',
			'tare_weight'   => 'required',
			'gross_weight'  => 'required',
			'load_capacity' => 'required|max:6',
			'load_average'  => 'required',
			'empty_average' => 'required',
			

		]);

    	}

        date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');


       $fleetId = $request->input('fleetIdId');
		$data = array(
			"COMP_CODE"    => $request->input('comp_code'),
			"COMP_NAME"    => $request->input('comp_name'),
			"OWNER"        => $request->input('owner'),
			"OWNER_NAME"   => $request->input('owner_name'),
			"TRUCK_NO"     => $request->input('truck_no'),
			"REGD_DATE"    => $regd_date,
			"MAKE"         => $request->input('make'),
			"MODEL"        => $request->input('model'),
			"COST_CODE"    => $request->input('cost_code'),
			"WHEEL_TYPE"   => $request->input('wheel_type'),
			"COLOUR"       => $request->input('colour'),
			"FREIGHTTYPE_CODE"  => $request->input('freight_type_code'),
			"FREIGHTTYPE_NAME"  => $request->input('freight_type_name'),
			"BODY_LENGTH"  => $request->input('body_length'),
			"CHASIS_NO"    => $request->input('chasis_no'),
			"ENGINE_NO"    => $request->input('engine_no'),
			"MFG_YR"       => $request->input('mfg_yr'),
			"GROSS_WEIGHT" => $request->input('gross_weight'),
			"TARE_WEIGHT"  => $request->input('tare_weight'),
			"RC_WEIGHT"  => $request->input('rc_weight'),
			"LOAD_CPCT"    => $request->input('load_capacity'),
			"LOAD_AVG"     => $request->input('load_average'),
			"UL_CPCT"      => $request->input('underload_capacity'),
			"UL_AVG"       => $request->input('underload_average'),
			"EMPTY_AVG"    => $request->input('empty_average'),
			"CREATED_BY"   => $lastUpdatedBy,
			
		);

		
		$saveData = DB::table('MASTER_FLEET')->where('MASTERFLEETID',$fleetId)->update($data);

		$discriptn_page = "Master fleet update done by user";
		$this->userLogInsert($lastUpdatedBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Fleet Was Successfully Updated...!');
			return redirect('/view-mast-fleet');

		} else {

			$request->session()->flash('alert-error', 'Fleet Can Not Updated...!');
			return redirect('/view-mast-fleet');

		}
    }


     public function DeleteFleet(Request $request){

    	$id = $request->post('FleetID');
    	//print_r($destinationId);exit;

    	if ($id!='') {
    		
    		

    		$depot = DB::table('master_fleet')->where('id',$id)->get()->first();


        	$depot_code = DB::table('master_fleet')->where('location',$depot->location)->get()->toArray();

        
        	
        	$count =count($depot_code);

        	if($count >1){
        		$Delete = DB::table('master_fleet')->where('id', $id)->delete();

        	}else{
        		$Delete = DB::table('master_fleet')->where('id', $id)->delete();

        		$data=array(

        			'fleet_mast'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$depot->location)->update($data);
        	
        	}

			if ($Delete) {

				$request->session()->flash('alert-success', ' Fleet Was Deleted Successfully...!');
				return redirect('/view-mast-fleet');

			} else {

				$request->session()->flash('alert-error', 'Fleet Can Not Deleted...!');
				return redirect('/view-mast-fleet');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Fleet Not Found...!');
			return redirect('/view-mast-fleet');

    	}
    }

/*----------- end fleet master -----------*/



/*----------- Start: Driver master -----------*/



	public function driverMaster(Request $request){

		$title ='Driver Master';
    	
    	$createdBy   = $request->session()->get('userid');
		
		$company     = $request->session()->get('company_name');
		$spliName    = explode('-', $company);
		$compName    = $spliName[0];
		$fisYear     =  $request->session()->get('macc_year');

		$employee_list = DB::table('MASTER_EMP')->get();

    	return view('admin.finance.master.Logistic.driver_master',compact('title','employee_list'));

	}

	

	public function saveDriverMaster(Request $request){

		$validate = $this->validate($request, [

			'vehicleNo'      => 'required|max:15|unique:MASTER_DRIVER,VEHICLE_NO',
			'driverNm'       => 'required',
			'fromeDate'      => 'required|min:10',
			'driveMobNo'     => 'required|min:10',
			'licenseNo'      => 'required|max:20',
			'licenseExpDate' => 'required|min:10',

		]);

		date_default_timezone_set('Asia/Kolkata');

		$createdBy         = $request->session()->get('userid');
		$company           = $request->session()->get('company_name');
		$spliName          = explode('-', $company);
		$compName          = $spliName[0];
		$fisYear           =  $request->session()->get('macc_year');

		$vehicleNo         = $request->input('vehicleNo');
		$driverNmCd        = $request->input('driverNm');
		$exp 			   = explode('-',$driverNmCd);
		$driverCd 		   = $exp[0];
		$driverNm 		   = $exp[1];
		$fromeDate         = $request->input('fromeDate');
		$toDate            = $request->input('toDate');
		$driveMobNo   	   = $request->input('driveMobNo');
		$licenseNo         = $request->input('licenseNo');
		$licenseExpDate    = $request->input('licenseExpDate');
		$contactname       = $request->input('contactname');
		$referenceNo       = $request->input('referenceNo');
		$relation          = $request->input('relation');
		$Permentaddress    = $request->input('Permentaddress');
		$temporaryaddress  = $request->input('temporaryaddress');
		$adharno           = $request->input('adharno');
		$guarantername     = $request->input('guarantername');
		

		$lineExpDate 	   = date("Y-m-d", strtotime($licenseExpDate));
		$frmDate 		   = date("Y-m-d", strtotime($fromeDate));

		if($toDate == ''){
			$to_Date=NULL;
		}else{
			$to_Date = date("Y-m-d", strtotime($toDate));
		}
		

		//$toDt = '9999-12-01';
		$flag = 0;

		$data = array(
			"VEHICLE_NO"           => $vehicleNo,
			"EMP_CODE"             => $driverCd,
			"EMP_NAME"             => $driverNm,
			"MOBILE_NO"            => $driveMobNo,
			"LICENSE_NO"           => $licenseNo,
			"LICENSE_EXPDT"        => $lineExpDate,
			"FROM_DATE"            => $frmDate,
			"TO_DATE"              => $to_Date,
			"CONTACT_NAME"         => $contactname,
			"REFERENCE_MOBILE_NO"  => $referenceNo,
			"RELATION"             => $relation,
			"PERMANENT_ADDRESS"    => $Permentaddress,
			"TEMPORARY_ADDRESS"    => $temporaryaddress,
			"ADHAR_NO"             => $adharno,
			"GUARANTER_NAME"       => $guarantername,
			"FLAG"                 => $flag,
			"CREATED_BY"           => $createdBy,
			
		);

		$saveData = DB::table('MASTER_DRIVER')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Deriver Data Successfully Added...!');
			return redirect('/master/logistic/view-driver-master');

		} else {

			$request->session()->flash('alert-error', 'Deriver Data Can Not Be Added...!');
			return redirect('/master/logistic/view-driver-master');

		}


	}

	public function viewDriverMaster(Request $request){

		if($request->ajax()) {

	    	$title    = 'View Driver Master';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$company = $request->session()->get('company_name');
			$spliName = explode('-', $company);
	    	$compName = $spliName[0];
			
			$fisYear  =  $request->session()->get('macc_year');

    	
	    	$data = DB::table('MASTER_DRIVER')->orderBy('VEHICLE_NO','DESC')->get()->toArray();

    		return DataTables()->of($data)->addIndexColumn()->make(true);
   	
		}
    	
    	return view('admin.finance.master.Logistic.view_driver_master');

	}

	public function EditDriverMaster(Request $request){

		$id=base64_decode($request->emp_code);
    	$title = 'Edit Driver List';
    	$vehicleNo=base64_decode($request->vehicle_no);

    	if($id!='' &&  $vehicleNo){

    	    $query = DB::table('MASTER_DRIVER');
			$query->where('VEHICLE_NO', $vehicleNo);
			$query->where('EMP_CODE', $id);

			$userData['editdriver_data'] = $query->get()->first();

			$userData['employee_list'] = DB::table('MASTER_EMP')->get();

			return view('admin.finance.master.Logistic.edit_driver_master', $userData+compact('title'));
		}else{

			$request->session()->flash('alert-error', 'Driver Not Found...!');

			return redirect('/master/logistic/view-driver-master');

		}

	}

	public function UpdateDriverMaster(Request $request){

		$validate = $this->validate($request, [

			'vehicleNo'      => 'required',
			'driverNm'       => 'required',
			'fromeDate'      => 'required|min:10',
			'driveMobNo'     => 'required|min:10',
			'licenseNo'      => 'required|max:20',
			'licenseExpDate' => 'required|min:10',


		]);

		date_default_timezone_set('Asia/Kolkata');

		       $updatedDate = date("Y-m-d H:i:s");
               
		$createdBy         = $request->session()->get('userid');
		$company           = $request->session()->get('company_name');
		$spliName          = explode('-', $company);
		$compName          = $spliName[0];
		$fisYear           =  $request->session()->get('macc_year');

		$vehicleNo         = $request->input('vehicleNo');
		$driverNmCd        = $request->input('driverNm');
		$exp 			   = explode('-',$driverNmCd);
		$driverCd 		   = $exp[0];
		$driverNm 		   = $exp[1];
		$fromeDate         = $request->input('fromeDate');
		$toDate            = $request->input('toDate');
		$driveMobNo   	   = $request->input('driveMobNo');
		$licenseNo         = $request->input('licenseNo');
		$licenseExpDate    = $request->input('licenseExpDate');
		$contactname       = $request->input('contactname');
		$referenceNo       = $request->input('referenceNo');
		$relation          = $request->input('relation');
		$Permentaddress    = $request->input('Permentaddress');
		$temporaryaddress  = $request->input('temporaryaddress');
		
		$adharno           = $request->input('adharno');
		$guarantername     = $request->input('guarantername');
		$block             = $request->input('driver_block');
        //print_r($lineExpDate);exit();
		$frmDate 		   = date("Y-m-d", strtotime($fromeDate));
		$todt 		       = date("Y-m-d", strtotime($toDate));

		//$toDt = '9999-12-01';
		$flag = 0;

		if($toDate == ''){
			$to_Date=NULL;
		}else{
			$to_Date = date("Y-m-d", strtotime($toDate));
		}

		$data = array(
			"EMP_CODE"             => $driverCd,
			"EMP_NAME"             => $driverNm,
			"MOBILE_NO"            => $driveMobNo,
			"LICENSE_NO"           => $licenseNo,
			"LICENSE_EXPDT"        => date("Y-m-d", strtotime($licenseExpDate)),
			"FROM_DATE"            => $frmDate,
			"TO_DATE"              => $to_Date,
			"CONTACT_NAME"         => $contactname,
			"REFERENCE_MOBILE_NO"  => $referenceNo,
			"RELATION"             => $relation,
			"PERMANENT_ADDRESS"    => $Permentaddress,
			"TEMPORARY_ADDRESS"    => $temporaryaddress,
			"ADHAR_NO"             => $adharno,
			"GUARANTER_NAME"       => $guarantername,
			"BLOCK_DRIVER"         => $block,
			"FLAG"                 => $flag,
			"CREATED_BY"           => $createdBy,
			"LAST_UPDATE_DATE"     => $updatedDate,
			
		);
      //   print_r($data);exit();
     
		$saveData = DB::table('MASTER_DRIVER')->where('VEHICLE_NO',$vehicleNo)->update($data);
		//print_r($saveData);exit();

		if ($saveData) {

			$request->session()->flash('alert-success', 'Deriver Data Successfully Updated...!');
			return redirect('/master/logistic/view-driver-master');

		} else {

			$request->session()->flash('alert-error', 'Deriver Data Can Not Be Updated...!');
			return redirect('/master/logistic/view-driver-master');

		}


	

		$lineExpDate 	= date("Y-m-d", strtotime($licenseExpDate));
		$frmDate 		= date("Y-m-d", strtotime($fromeDate));
		$todt 		    = date("Y-m-d", strtotime($toDate));

		// $toDt = '9999-12-01';
		$flag = 0;

		$data = array(
			"EMP_CODE"      => $driverCd,
			"EMP_NAME"      => $driverNm,
			"MOBILE_NO"     => $driveMobNo,
			"LICENSE_NO"    => $licenseNo,
			"LICENSE_EXPDT" => $lineExpDate,
			"FROM_DATE"     => $frmDate,
			"TO_DATE"       => $todt,
			"FLAG"          => $flag,
			"CREATED_BY"    => $createdBy,
			
		);

		$saveData = DB::table('MASTER_DRIVER')->where('VEHICLE_NO',$vehicleNo)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Deriver Data Successfully Updated...!');
			return redirect('/master/logistic/view-driver-master');

		} else {

			$request->session()->flash('alert-error', 'Deriver Data Can Not Be Updated...!');
			return redirect('/master/logistic/view-driver-master');

		}


	}

/*----------- End: Driver master -----------*/



/* --------- start fleet truck wheel ------------------ */


	public function FleetTruckWheelForm(Request $request){
    	
    	$title ='Add Master Fleet Truck Wheel';
    	$data['help_Twheel_list'] = DB::table('MASTER_FLEETTRUCK_WHEEL')->Orderby('WHEEL_CODE', 'desc')->limit(5)->get();

    	$data['gl_list'] = DB::table('MASTER_GL')->get();
		$data['lrexp_list'] = DB::table('MASTER_LREXP')->get();

    	return view('admin.finance.master.Logistic.fleet_truck_wheel_form',$data+compact('title'));
    }


    public function FleetTruckWhelSave(Request $request){

    	//print_r($request->post());exit;

    	$validate = $this->validate($request, [

			'wheel_code'    => 'required|max:4|unique:MASTER_FLEETTRUCK_WHEEL,WHEEL_CODE',
			'wheel_name'    => 'required|max:30',

		]);

		$createdBy   = $request->session()->get('userid');
		
		$company     = $request->session()->get('company_name');
		$spliName    = explode('-', $company);
		$compName    = $spliName[0];
		$fisYear     =  $request->session()->get('macc_year');

		// print_r($fisYear);exit();
		
		$indicator   = $request->input('indicator');
		
		$FilterArray = array_filter($indicator);
		
		$count       = count($FilterArray);
		
		$rate        = $request->input('rate');
		
		$index       = $request->input('index');
		
		$gl_code     = $request->input('gl_code');
		
		$wheel_code  = $request->input('wheel_code');

		$data = array(
			"COMP_CODE"  => $compName,
			"FY_CODE"    => $fisYear,
			"WHEEL_CODE" => $request->input('wheel_code'),
			"WHEEL_NAME" => $request->input('wheel_name'),
			"CREATED_BY" => $createdBy,
			
		);

		$saveData = DB::table('MASTER_FLEETTRUCK_WHEEL')->insert($data);



		for ($i=0; $i < $count; $i++) { 

			$data = array(

			"COMP_CODE"  => $compName,
			"FLEET_TYPE" => $request->input('wheel_code'),
			"RATE"       => $rate[$i],
			"FLEETIND"   => $indicator[$i],
			"FLEETINDEX" => $index[$i],
			"GL_CODE"    => $gl_code[$i],
			"CREATED_BY" => $createdBy,
			
			
		);

		$saveData = DB::table('MASTER_FLEETEXP')->insert($data);
			# code...
		}

		$discriptn_page = "Master fleet truck insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Fleet Truck Wheel Was Successfully Added...!');
			return redirect('/view-flet-truck-wheel');

		} else {

			$request->session()->flash('alert-error', 'Fleet Truck Wheel Can Not Added...!');
			return redirect('/view-flet-truck-wheel');

		}
    	
    	

    }


    public function FleetTruckWhelView(Request $request){

   		if($request->ajax()) {

	    	$title    = 'View Fleet Truck Wheel';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$company = $request->session()->get('company_name');
			$spliName = explode('-', $company);
	    	$compName = $spliName[0];
			
			$fisYear  =  $request->session()->get('macc_year');

    		

	    	$data = DB::table('MASTER_FLEETTRUCK_WHEEL')->orderBy('WHEEL_CODE','DESC');


    		return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
   	
		}
    	
    	return view('admin.finance.master.Logistic.view_flet_truck_whel');
	}

    public function EditFleetTruckWhel($id,$btnControl){

    	$id=base64_decode($id);
    	$title = 'Edit Flet truck wheel';
    	$btnControl=base64_decode($btnControl);

        $userData['help_Twheel_list'] = DB::table('MASTER_FLEETTRUCK_WHEEL')->Orderby('WHEEL_CODE', 'desc')->limit(5)->get();

    	$userData['gl_list'] = DB::table('MASTER_GL')->get();

		$userData['lrexp_list'] = DB::table('MASTER_LREXP')->get();
    	
    	if($id!=''){
    	    $query = DB::table('MASTER_FLEETTRUCK_WHEEL');
			$query->where('WHEEL_CODE', $id);
			$userData['editfleet_truc'] = $query->get()->first();

			$fleetType = $userData['editfleet_truc']->WHEEL_CODE ;
			
			$userData['FleetExp'] = DB::table('MASTER_FLEETEXP')->where('FLEET_TYPE',$fleetType)->get();

			$countFleet = count($userData['FleetExp']);

			return view('admin.finance.master.Logistic.flet_truck_whel_list', $userData+compact('title','btnControl','countFleet'));
		}else{
			$request->session()->flash('alert-error', 'Fleet Truck Wheel-Id Not Found...!');
			return redirect('/form-mast-depot');
		}

    }

    public function fletTrucWhelUpdate(Request $request){

    	//print_r($request->post());exit;

    	$validate = $this->validate($request, [

			'wheel_code'    => 'required|max:4',
			'wheel_name'    => 'required|max:30',

		]);

		$whelId=$request->input('whelID');
		
		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$company     = $request->session()->get('company_name');
		$getcompcode = explode('-', $company);
		$comp_code   = $getcompcode[0];
		$fisYear     = $request->session()->get('macc_year');

		$lastUpdatedBy = $request->session()->get('userid');
		$wheel_Code = $request->input('wheel_code');
		// print_r($whelId);exit();

		DB::beginTransaction();

		try {

			$data = array(
				"WHEEL_CODE"       => $request->input('wheel_code'),
				"WHEEL_NAME"       => $request->input('wheel_name'),
				"STATUS"           => $request->input('truck_block'),
				"LAST_UPDATE_BY"   => $lastUpdatedBy,
				"LAST_UPDATE_DATE" => $updatedDate,
				
			);

			$saveData = DB::table('MASTER_FLEETTRUCK_WHEEL')->where('WHEEL_CODE', $wheel_Code)->where('ID', $whelId)->update($data);

			$indicator   = $request->input('indicator');
		    
		    $FilterArray = array_filter($indicator);
		    
		    $count       = count($FilterArray);

		    $rate        = $request->input('rate');
		    
		    $index       = $request->input('index');
		    
		    $gl_code     = $request->input('gl_code');

		    $wheelType   = $request->input('wheel_code');

		    $deleteData = DB::table('MASTER_FLEETEXP')->where('FLEET_TYPE',$wheelType)->delete();

		    for ($i=0; $i < $count; $i++) { 

		      $data = array(
				"COMP_CODE"  => $comp_code,
				"FY_CODE"    => $fisYear,
				"FLEET_TYPE" => $wheelType,
				"RATE"       => $rate[$i],
				"FLEETIND"   => $indicator[$i],
				"FLEETINDEX" => $index[$i],
				"GL_CODE"    => $gl_code[$i],
				"CREATED_BY" => $lastUpdatedBy,
		      
		      
		    );

		    $saveData = DB::table('MASTER_FLEETEXP')->insert($data);
		      # code...
		    }

		    DB::commit();

		    $discriptn_page = "Master fleet truck update done by user";
		   $this->userLogInsert($lastUpdatedBy,$discriptn_page);

            $request->session()->flash('alert-success', 'fleet Truck Wheel Was Successfully Updated...!');
			return redirect('/view-flet-truck-wheel');

		} catch (\Exception $e) {
		    DB::rollBack();

		    $request->session()->flash('alert-error', 'fleet Truck Wheel Can Not Updated...!');
			return redirect('/view-flet-truck-wheel');
		    
		}

    }

    public function DeleteFletTruckWhel(Request $request){

    	$fleetId = $request->post('FleetID');
    	//print_r($destinationId);exit;

    	if ($fleetId!='') {
    		
    		$Delete = DB::table('MASTER_FLEETTRUCK_WHEEL')->where('WHEEL_CODE', $fleetId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Fleet Truck Wheel Was Deleted Successfully...!');
				return redirect('/view-flet-truck-wheel');

			} else {

				$request->session()->flash('alert-error', 'Fleet Truck Wheel Can Not Deleted...!');
				return redirect('/view-flet-truck-wheel');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Fleet Truck Wheel Not Found...!');
			return redirect('/view-flet-truck-wheel');

    	}
    }

/* --------- end fleet truck wheel ------------------ */


/* --------- start fleet truck wheel ------------------ */


	public function FleetTripExpenseForm(Request $request){
    	
    	$title ='Add Master Fleet Truck Wheel';
    	$data['help_Twheel_list'] = DB::table('MASTER_FLEETTRUCK_WHEEL')->Orderby('WHEEL_CODE', 'desc')->limit(5)->get();

    	$data['gl_list'] = DB::table('MASTER_GL')->get();
		$data['lrexp_list'] = DB::table('MASTER_LREXP')->get();

    	return view('admin.finance.master.Logistic.fleet_trip_expense_form',$data+compact('title'));
    }


    public function FleetTripExpenseSave(Request $request){

    	//print_r($request->post());exit;

    	$validate = $this->validate($request, [

			'km'    => 'required',
		

		]);

		$createdBy   = $request->session()->get('userid');
		
		$company        = $request->session()->get('company_name');
		$spliName       = explode('-', $company);
		$compName       = $spliName[0];
		$fisYear        =  $request->session()->get('macc_year');
		
		$indicator      = $request->input('indicator');
		$indicator_name = $request->input('indicator_name');
		
		$FilterArray    = array_filter($indicator);
		
		$count          = count($FilterArray);
		
		$rate           = $request->input('rate');
		
		$index          = $request->input('index');
		
		$gl_code        = $request->input('gl_code');
		
		$km             = $request->input('km');

		$trip_type      = $request->input('trip_type');

	

		for ($i=0; $i < $count; $i++) { 

			$data = array(

			"COMP_CODE"     => $compName,
			"KM"            => $km,
			"RATE"          => $rate[$i],
			"FLEETIND"      => $indicator_name[$i],
			"FLEETIND_CODE" => $indicator[$i],
			"FLEETINDEX"    => $index[$i],
			"GL_CODE"       => $gl_code[$i],
			"TRIP_TYPE"     => $trip_type,
			"CREATED_BY"    => $createdBy,
			
			
		);

		$saveData = DB::table('MASTER_FLEETEXP')->insert($data);
			# code...
		}

		$discriptn_page = "Master fleet truck insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Fleet Trip Expense Was Successfully Added...!');
			return redirect('/view-fleet-trip-expense');

		} else {

			$request->session()->flash('alert-error', 'Fleet Trip Expense Can Not Added...!');
			return redirect('/view-fleet-trip-expense');

		}
    	
    	

    }


    public function FleetTripExpenseView(Request $request){

   		if($request->ajax()) {

	    	$title    = 'View Fleet Trip Expense';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$company = $request->session()->get('company_name');
			$spliName = explode('-', $company);
	    	$compName = $spliName[0];
			
			$fisYear  =  $request->session()->get('macc_year');

    		if($userType=='admin'){

	    		//$data = DB::table('fleet_truck_wheel')->orderBy('id','DESC');

	    		$data = DB::table('MASTER_FLEETEXP')->where('COMP_CODE',$compName)->orderBy('KM','DESC');

			}else if($userType=='superAdmin' || $userType=='user'){

				$data = DB::table('MASTER_FLEETEXP')->where('COMP_CODE',$compName)->orderBy('KM','DESC');
			}else{

				$data ='';
			}

    		return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
   	
		}
    	
    	return view('admin.finance.master.Logistic.view_fleet_trip_expense');
	}

    public function EditTripExpense($km){

    	//print_r($id);
    	$km=base64_decode($km);

    //	print_r($id);exit;

    	if($km!=''){
    	    $query = DB::table('MASTER_FLEETEXP');
			$query->where('KM', $km);
			$userData['trip_exp'] = $query->get()->toArray();

			//print_r($userData['trip_exp']);exit;

			$userData['gl_list'] = DB::table('MASTER_GL')->get();
		    $userData['lrexp_list'] = DB::table('MASTER_LREXP')->get();

			return view('admin.finance.master.Logistic.flet_trip_expense_list', $userData);
		}else{
			$request->session()->flash('alert-error', 'Fleet Truck Wheel-Id Not Found...!');
			return redirect('/form-fleet-trip-expense');
		}

    }

    public function TripExpenseUpdate(Request $request){

    	//print_r($request->post());exit;

    	$validate = $this->validate($request, [

			'km'    => 'required',
		

		]);

		$createdBy   = $request->session()->get('userid');
		
		$company     = $request->session()->get('company_name');
		$spliName    = explode('-', $company);
		$compName    = $spliName[0];
		$fisYear     =  $request->session()->get('macc_year');
		
		$indicator   = $request->input('indicator');
		$indicator_name   = $request->input('indicator_name');


		$FilterArray = array_filter($indicator);
		
		$count       = count($FilterArray);
		//print_r($count);exit;
		
		$rate        = $request->input('rate');
		
		$index       = $request->input('index');
		
		$gl_code     = $request->input('gl_code');
		
		$km          = $request->input('km');
		$truck_block = $request->input('truck_block');
		
		$id          = $request->input('id');

	

		for ($i=0; $i < $count; $i++) { 

			$data = array(

			"COMP_CODE"      => $compName,
			"KM"             => $km,
			"RATE"           => $rate[$i],
			"FLEETIND"       => $indicator_name[$i],
			"FLEETIND_CODE"  => $indicator[$i],
			"FLEETINDEX"     => $index[$i],
			"GL_CODE"        => $gl_code[$i],
			"BLOCK_TRIPEXP"  => $truck_block,
			"LAST_UPDATE_BY" => $createdBy,
			
			
		);

			$saveData = DB::table('MASTER_FLEETEXP')->where('FLEETEXPID', $id[$i])->update($data);
			
		}
		

	

		$discriptn_page = "Master fleet truck update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'fleet Truck Wheel Was Successfully Updated...!');
			return redirect('/view-fleet-trip-expense');

		} else {

			$request->session()->flash('alert-error', 'fleet Truck Wheel Can Not Updated...!');
			return redirect('/view-fleet-trip-expense');

		}
    }

    public function DeleteTripExpense(Request $request){

    	$fleetId = $request->post('FleetID');
    	//print_r($destinationId);exit;

    	if ($fleetId!='') {
    		
    		$Delete = DB::table('MASTER_FLEETTRUCK_WHEEL')->where('WHEEL_CODE', $fleetId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Fleet Truck Wheel Was Deleted Successfully...!');
				return redirect('/view-flet-truck-wheel');

			} else {

				$request->session()->flash('alert-error', 'Fleet Truck Wheel Can Not Deleted...!');
				return redirect('/view-flet-truck-wheel');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Fleet Truck Wheel Not Found...!');
			return redirect('/view-flet-truck-wheel');

    	}
    }

/* --------- end fleet truck wheel ------------------ */

/* ----------- start freight rate master ------------- */
	
	public function FreightRateForm(Request $request){

    	$title = 'Add Master Rate';

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	$getcompcode = explode('-', $compName);
		$comp_code = $getcompcode[0];
		$comp_name = $getcompcode[1];
		
		$data['depot_code']       = DB::table('MASTER_DEPOT')->get();
			
		$data['area_code'] = DB::table('MASTER_CITY')->get();
			
		$data['wheel_list']       = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

		$data['help_route_code_list'] = DB::table('MASTER_FREIGHT_ROUTE')->Orderby('ROUTE_CODE', 'desc')->limit(5)->get();

    	return view('admin.finance.master.Logistic.frightrate_form',$data+compact('title'));
    }

    public function FreightRateFormSave(Request $request){

    	$validate = $this->validate($request, [

			'route_code'     => 'required|max:6|unique:MASTER_FREIGHT_ROUTE,ROUTE_CODE',
			'route_name'     => 'required'
			
		]);

        // $vehicletype = $request->input('from_place');

		
		
		$from_place = $request->input('from_place');
		$count = count($from_place);
		$to_place   = $request->input('to_place');
		$km         = $request->input('km');
		$toll       = $request->input('toll');
		$extra_km   = $request->input('extra_km');
		$less_km    = $request->input('less_km');
		$extra_toll = $request->input('extra_toll');
		$trip_days  = $request->input('trip_days');
		$off_days   = $request->input('off_days');
		$weight_rate   = $request->input('weight_rate');
		$extra_Mileage   = $request->input('extraMileage');
		
		$createdBy  = $request->session()->get('userid');
		
		$company    = $request->session()->get('company_name');
		$getcompcode   = explode('-', $company);
		$comp_code   = $getcompcode[0];
		$comp_name   = $getcompcode[1];
		$fisYear    =  $request->session()->get('macc_year');
		
		$depot_code = $request->input('depot_code');
		$area_code  = $request->input('area_code');
		$wheel_type = $request->input('wheel_type');

        for($i=0; $i < $count; $i++) { 

			$dkm         = $km[$i]!='' ? $km[$i] : '0';
			$dtoll       = $toll[$i]!='' ? $toll[$i] : '0';
			$dextra_km   = $extra_km[$i]!='' ? $extra_km[$i] : '0';
			$dless_km    = $less_km[$i]!='' ? $less_km[$i] : '0';
			$dextra_toll = $extra_toll[$i]!='' ? $extra_toll[$i] : '0';
			$dtrip_days  = $trip_days[$i]!='' ? $trip_days[$i] : '0';
			$dweight_rate  = $weight_rate[$i]!='' ? $weight_rate[$i] : '0';
			$dextra_Mileage  = $extra_Mileage[$i]!='' ? $extra_Mileage[$i] : '0';

			$data1 = array(

			"ROUTE_CODE"   => $request->input('route_code'),
			"ROUTE_NAME"   => $request->input('route_name'),
			"FROM_PLACE"   => $from_place[$i],
			"TO_PLACE"     => $to_place[$i],
			"KM"           => $dkm,
			"TOLL"         => $dtoll,
			"EXTRA_KM"     => $dextra_km,
			"LESS_KM"      => $dless_km,
			"EXTRA_TOLL"   => $dextra_toll,
			"WEIGHT_RATE"  => $dweight_rate,
			"EXTRA_MILEAGE"=> $dextra_Mileage,
			"TRIP_DAYS"    => $dtrip_days,
			"HOLIDAYS"     => $off_days[$i],
			"CREATED_BY"   => $createdBy,
			
		);
			//print_r($data1);exit();

		$saveData1 = DB::table('MASTER_FREIGHT_ROUTE')->insert($data1);

		}


		$discriptn_page = "Master Route insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		

		if ($saveData1) {

			$request->session()->flash('alert-success', 'Route Was Successfully Added...!');
				return redirect('/view-mast-freight-rate');

		} else {

			$request->session()->flash('alert-error', 'Rate Can Not Added...!');
			return redirect('/view-mast-freight-rate');

		}

    }

    public function FreightRateView(Request $request){

    	// $data = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('ROUTE_NAME')->orderBy('FREIGHTROUTEID','DESC')->get();
    	// echo '<PRE>';
    	// print_r($data); echo '</PRE>';exit();

    	if($request->ajax()) {

			$title    = 'View Master Rate';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			$spliCode = explode('-',$compName);
			$comp_code = $spliCode[0];
			$fisYear  =  $request->session()->get('macc_year');

	   	
			$data = DB::table('MASTER_FREIGHT_ROUTE')->orderBy('FREIGHTROUTEID','DESC');

			

	 		return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

	}


    	return view('admin.finance.master.Logistic.view_rate');

    }

    public function EditFreightRateForm(Request $request, $id){

    	$title = 'Edit Master Rate';

    	$route_code = base64_decode($id);

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($route_code!=''){

			$query = DB::table('MASTER_FREIGHT_ROUTE');
			$query->where('ROUTE_CODE', $route_code);
			$rateData['rate_list']  = $query->get();
			return view('admin.finance.master.Logistic.freightrate_list', $rateData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Item Not Found...!');
			return redirect('/view-mast-freight-rate');
		}

    }

    public function FreightRateFormUpdate(Request $request){

  //   	$validate = $this->validate($request, [

		// 	'route_code'     => 'required|max:4|unique:MASTER_FREIGHT_ROUTE,ROUTE_CODE',
		// 	'route_name'     => 'required'
			
		// ]);

        $vehicletype = $request->input('from_place');

		$count = count($vehicletype);
		

		$freightRId   = $request->input('freightId');
		$route_id   = $request->input('route_id');
		$route_code   = $request->input('route_code');
		// print_r($route_code);
		// print_r($freightRId);exit();
		$from_place   = $request->input('from_place');
		$to_place     = $request->input('to_place');
		$km           = $request->input('km');
		$toll         = $request->input('toll');
		$Weightrate   = $request->input('Weightrate');
		$extraMileage = $request->input('extraMileage');
		$extra_km     = $request->input('extra_km');
		$less_km      = $request->input('less_km');
		$extra_toll   = $request->input('extra_toll');
		$trip_days    = $request->input('trip_days');
		$off_days     = $request->input('off_days');
		
		$updatedBy  = $request->session()->get('userid');
		
		
		for($i=0; $i < $count; $i++) { 

			
			$data1 = array(

			"ROUTE_CODE"   => $request->input('route_code'),
			"ROUTE_NAME"   => $request->input('route_name'),
			"FROM_PLACE"   => $from_place[$i],
			"TO_PLACE"     => $to_place[$i],
			"KM"           => $km[$i],
			"WEIGHT_RATE"  => $Weightrate[$i],
			"EXTRA_MILEAGE"=> $extraMileage[$i],
			"TOLL"         => $toll[$i],
			"EXTRA_KM"     => $extra_km[$i],
			"LESS_KM"      => $less_km[$i],
			"EXTRA_TOLL"   => $extra_toll[$i],
			"TRIP_DAYS"    => $trip_days[$i],
			"HOLIDAYS"     => $off_days[$i],
			"LAST_UPDATE_BY"   => $updatedBy,
			
		);

		$saveData1 = DB::table('MASTER_FREIGHT_ROUTE')->where('ROUTE_CODE',$route_code)->where('FREIGHTROUTEID',$freightRId)->update($data1);

		}

		$discriptn_page = "Master freight route update done by user";
		$this->userLogInsert($updatedBy,$discriptn_page);

		if ($saveData1) {

			$request->session()->flash('alert-success', 'Route Was Successfully Updated...!');
			return redirect('/view-mast-freight-rate');

		} else {

			$request->session()->flash('alert-error', 'Route Can Not Updated...!');
			return redirect('/view-mast-freight-rate');

		}
    }

    public function DeleteFreightRate(Request $request){

    	$id = $request->post('rateId');
    	//print_r($ItemumID);exit;

    	if ($id!='') {
    		
    		$Delete = DB::table('MASTER_FREIGHT_ROUTE')->where('FREIGHTROUTEID', $id)->delete();
        	
        	if($Delete){

				$request->session()->flash('alert-success', ' Freight Route Was Deleted Successfully...!');
					return redirect('/view-mast-freight-rate');

				} else {

				$request->session()->flash('alert-error', 'Freight Route Can Not Deleted...!');
					return redirect('/view-mast-freight-rate');

				}

    	}else{

    		$request->session()->flash('alert-error', 'Freight Route Not Found...!');
			return redirect('/view-mast-freight-rate');

    	}
    }

    public function FreightrateChieldRTowData(Request $request){

		$response_array = array();

	   // $vrno = $request->input('vrno');
	    $tblid = $request->input('tblid');

		if ($request->ajax()) {

	    	$freight_rate_chield = DB::table("MASTER_FREIGHT_ROUTE")->where('FREIGHTRATEID',$tblid)->get();

    		if ($freight_rate_chield) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $freight_rate_chield ;

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

    public function HelpRouteCodeSearch(Request $request){



       $response_array = array();

	   $route_code_help = $request->input('HelpRouteCode');
	   
	   $compName = $request->session()->get('company_name');
	   
	   $getcomcode    = explode('-', $compName);
	   
	   $comp_code = $getcomcode[0];
	    
		if ($request->ajax()) {

	      $Seach_Route_code_by_help = DB::select("SELECT * FROM `MASTER_FREIGHT_ROUTE` WHERE (ROUTE_CODE='$route_code_help' OR ROUTE_NAME='$route_code_help' OR ROUTE_CODE Like '$route_code_help%' OR ROUTE_CODE LIKE '$route_code_help%') AND (COMP_CODE='$comp_code') ORDER BY ROUTE_CODE DESC limit 5  ");


		   if ($Seach_Route_code_by_help) {

	    		 $response_array['response'] = 'success';
		         
		         $response_array['data'] = $Seach_Route_code_by_help ;

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

     function TruckNoDetails(Request $request){


    	$response_array = array();

		if ($request->ajax()) {


		$fy_code     = $request->fy_code;
		$series_code = $request->series_code;
		$vr_no       = $request->vr_no;

		//print_r($vr_no);exit;
    	    
	    //$getadata = DB::table('VEHICLE_INWARD')->where('FY_CODE',$fy_code)->where('SERIES_CODE',$series_code)->where('VRNO',$vr_no)->get()->first();

	    $getadata  = DB::table('VEHICLE_GATE_INWARD')->where('SERIES_CODE',$series_code)->where('VRNO',$vr_no)->get()->first();

	    $getfleet = DB::table('MASTER_FLEET')->where('TRUCK_NO',$getadata->VEHICLE_NO)->get()->first();

	    $fleetexp  = DB::table('MASTER_FLEETEXP')->where('FLEET_TYPE',$getfleet->WHEEL_TYPE)->get();

	   // print_r($getadata);exit;

	    	
    		if ($getadata) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $getadata;
	            $response_array['datafleet'] = $getfleet;
	            $response_array['dataexp'] = $fleetexp;

	           echo $data = json_encode($response_array);

	            //print_r($data);

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

    function VehicleTypeDetails(Request $request){


    	$response_array = array();

		if ($request->ajax()) {


		$truckNo     = $request->truckNo;
		
		//print_r($vr_no);exit;
    	    
	    //$getadata = DB::table('VEHICLE_INWARD')->where('FY_CODE',$fy_code)->where('SERIES_CODE',$series_code)->where('VRNO',$vr_no)->get()->first();

	   

	    $getadata = DB::table('MASTER_FLEET')->where('TRUCK_NO',$truckNo)->get()->first();

	    
	    	
    		if ($getadata) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $getadata;
	            

	           echo $data = json_encode($response_array);

	            //print_r($data);

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



    function WheelTypeDetails(Request $request){


    	$response_array = array();

		if ($request->ajax()) {


	    $wheelType = $request->wheelType;
    	    
	    $getadata = DB::select("SELECT * FROM MASTER_FLEETEXP H WHERE H.FLEET_TYPE ='$wheelType'");

	    //	print_r($getadata);exit;

	    	$count=count($getadata);
    		if ($count > 0) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $getadata;

	           echo $data = json_encode($response_array);

	            //print_r($data);

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

    function DieselRateDetails(Request $request){


    	$response_array = array();

		if ($request->ajax()) {


	    $trdate = $request->tr_date;

	   //$tr_date = $request->input('date');
		$tr_date = date("Y-m-d", strtotime($trdate));
    	    
	    
	    $getadata = DB::table('MASTER_DIESEL_RATE')->where('DATE', $tr_date)->get()->first();
        	
	    	
    		if ($getadata) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $getadata;

	           echo $data = json_encode($response_array);

	            //print_r($data);

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
/* ----------- end freight rate master ------------- */

/* ----------- Start LR acknowledgement Penalty master ------------- */

public function LrAckPenalty(Request $request){

	$title = 'Add LR Acknowledgement Penalty';

	$compName = $request->session()->get('company_name');

	$fisYear =  $request->session()->get('macc_year');

	$getcompcode = explode('-', $compName);
	$comp_code = $getcompcode[0];
	$comp_name = $getcompcode[1];
	
	$data['gl_list'] = DB::table('MASTER_GL')->get();

	return view('admin.finance.master.Logistic.lr_acknowledgement_penalty',$data+compact('title'));

}

public function LrAckPenaltySave(Request $request){

    	
        $penaltyCode = $request->input('all_penaltyCode');

		$count = count($penaltyCode);

		$head      = $request->input('all_head');
		$index     = $request->input('all_index');
		$indexName = $request->input('all_indexName');
		$rate      = $request->input('all_rate');
		$amount    = $request->input('all_amount');
		$glcode    = $request->input('all_glcode');
		$glname    = $request->input('all_glname');
		$defaultval    = $request->input('all_defaultval');
		// print_r($defaultval);exit();
		
		
		$createdBy   = $request->session()->get('userid');
		
		$company     = $request->session()->get('company_name');
		$getcompcode = explode('-', $company);
		$comp_code   = $getcompcode[0];
		$comp_name   = $getcompcode[1];
		$fisYear     =  $request->session()->get('macc_year');
		
		

        for($i=0; $i < $count; $i++) { 

			
			$data1 = array(
			
				"COMP_CODE"    => $comp_code,
				"COMP_NAME"    => $comp_name,
				"FY_CODE"      => $fisYear,
				"PENALTY_CODE" => $penaltyCode[$i],
				"HEAD"         => $head[$i],
				"INDEX_CODE"   => $index[$i],
				"INDEX_NAME"   => $indexName[$i],
				"RATE"         => $rate[$i],
				"AMOUNT"       => $amount[$i],
				"GL_CODE"      => $glcode[$i],
				"GL_NAME"      => $glname[$i],
				"DEFAULTVAL"   => $defaultval[$i],
				"CREATED_BY"   => $createdBy,
			
		   );

		$saveData1 = DB::table('MASTER_LRACK_PENALTY')->insert($data1);

		}

		$discriptn_page = "Master LR Acknowledgement Penalty insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		$response_array = array();

		if ($saveData1) {

			$response_array['response'] = 'success';
            $response_array['data'] = '' ;

            $data = json_encode($response_array);

            print_r($data);

		} else {

			$response_array['response'] = 'error';
            $response_array['data'] = '' ;

            $data = json_encode($response_array);

            print_r($data);

		}

    }

   public function LrAckPenaltyView(Request $request){

    	if($request->ajax()) {

			$title    = 'View LR Acknowledgement Penalty';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

	   		if($userType=='admin'){
	   		  $data = DB::table('MASTER_LRACK_PENALTY')->orderBy('ID','DESC');
	   		 
			}else if($userType=='superAdmin' || $userType=='user'){

				 $data = DB::table('MASTER_LRACK_PENALTY')->orderBy('ID','DESC');

			}
			else{

				$data ='';
				
			}

	 		return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

	}


    	return view('admin.finance.master.Logistic.view_lr_ack_penalty');

    }

    public function EditLrAckPenalty(Request $request, $id){

    	$title = 'Edit Master LR Acknowledgement Penalty';

    	$id = base64_decode($id);

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	$data['gl_list'] = DB::table('MASTER_GL')->get();

    	if($id!=''){

			$query = DB::table('MASTER_LRACK_PENALTY');
			$query->where('PENALTY_CODE', $id);
			$lrData  = $query->get()->first();
			
			return view('admin.finance.master.Logistic.edit_lr_ack_penalty', $data+compact('title','lrData'));
		}else{
			$request->session()->flash('alert-error', 'Item Not Found...!');
			return redirect('/logistic-transportation/master/view-lr-acknowledgement-penalty');
		}

    }

    public function LrAckPenaltyUpdate(Request $request){

    	
        $penaltyCode = $request->input('penalty_code');

		$head        = $request->input('head');
		$index       = $request->input('lrIndex');
		$indexName   = $request->input('lrIndexName');
		$rate        = $request->input('rate');
		$amount      = $request->input('amt');
		$glcode      = $request->input('glcode');
		$glname      = $request->input('glname');
		$defaultval  = $request->input('defaultval');
		
		$createdBy   = $request->session()->get('userid');
		
		$company     = $request->session()->get('company_name');
		$getcompcode = explode('-', $company);
		$comp_code   = $getcompcode[0];
		$comp_name   = $getcompcode[1];
		$fisYear     =  $request->session()->get('macc_year');
		
		$data1 = array(
			
				"HEAD"         => $head,
				"INDEX_CODE"   => $index,
				"INDEX_NAME"   => $indexName,
				"RATE"         => $rate,
				"AMOUNT"       => $amount,
				"GL_CODE"      => $glcode,
				"GL_NAME"      => $glname,
				"DEFAULTVAL"   => $defaultval,
				"CREATED_BY"   => $createdBy,
			
		);

		$saveData1 = DB::table('MASTER_LRACK_PENALTY')->where('PENALTY_CODE', $penaltyCode)->update($data1);

		

		$discriptn_page = "Master LR Acknowledgement Penalty insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		$response_array = array();

		if ($saveData1) {

			$response_array['response'] = 'success';
            $response_array['data'] = '' ;

            $data = json_encode($response_array);

            print_r($data);

		} else {

			$response_array['response'] = 'error';
            $response_array['data'] = '' ;

            $data = json_encode($response_array);

            print_r($data);

		}

    }

    public function ChkLrAckPenaltyCode(Request $request){

    	$penalty_code = $request->input('penaltyCode');

    	if($penalty_code != ''){

    		$data = DB::table('MASTER_LRACK_PENALTY')->where('PENALTY_CODE',$penalty_code)->get()->first();

    		$response_array = array();

    		if($data){

	    		$response_array['response'] = 'success';
	            $response_array['data'] = '' ;

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

    public function DeleteLrAckPenalty(Request $request){

    	$id = $request->post('lrAckId');
    	//print_r($ItemumID);exit;

    	if ($id!='') {
    		
    		$Delete = DB::table('MASTER_LRACK_PENALTY')->where('ID', $id)->delete();
        	
        	if($Delete){

				$request->session()->flash('alert-success', ' LR Acknowledgement Penalty Was Deleted Successfully...!');
					return redirect('/logistic-transportation/master/view-lr-acknowledgement-penalty');

				} else {

				$request->session()->flash('alert-error', 'LR Acknowledgement Penalt Can Not Deleted...!');
					return redirect('/logistic-transportation/master/view-lr-acknowledgement-penalty');

				}

    	}else{

    		$request->session()->flash('alert-error', 'LR Acknowledgement Penalty Not Found...!');
			return redirect('/logistic-transportation/master/view-lr-acknowledgement-penalty');

    	}
    }

/* ----------- End LR acknowledgement Penalty master ------------- */



/* ----------- start manufacturing master ----------- */
	
	public function MastManufacturingForm(Request $request){

		$title = 'Add Master Manufacturing';

		$data['help_Manufact_list'] = DB::table('MASTER_VEHICLE_MFG')->Orderby('MFG_CODE', 'desc')->limit(5)->get();
    	
    	return view('admin.finance.master.Logistic.manufacturing_form',$data);
    }

    public function ManufaturSave(Request $request){

    	$validate = $this->validate($request, [

			'vehicle_mfg_code'    => 'required|max:12',
			'vehicle_mfg_name'    => 'required|max:15',

		]);

    	$createdBy = $request->session()->get('userid');

    	$compName = $request->session()->get('company_name');
		$splitCode = explode('-',$compName);
		$compCode =$splitCode[0];
		$fisYear  =  $request->session()->get('macc_year');

		$data = array(

			"COMP_CODE"  => $compCode,
			"FY_CODE"    => $fisYear,
			"MFG_CODE"   => $request->input('vehicle_mfg_code'),
			"MFG_NAME"   => $request->input('vehicle_mfg_name'),
			"CREATED_BY" => $createdBy,
			
		);

		$saveData = DB::table('MASTER_VEHICLE_MFG')->insert($data);

		$discriptn_page = "Master vehicle manufacturing insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Manufature Was Successfully Added...!');
			return redirect('/view-manufature');

		} else {

			$request->session()->flash('alert-error', 'Manufature Can Not Added...!');
			return redirect('/view-manufature');

		}
    	
    }

    public function manufatureView(Request $request){

    	if($request->ajax()) {

			$title     = 'View Fleet Truck Wheel';
			
			$userid    = $request->session()->get('userid');
			//print_r($userid);exit;
			
			$userType  = $request->session()->get('usertype');
			
			$compName  = $request->session()->get('company_name');
			$splitCode = explode('-',$compName);
			$compCode  =$splitCode[0];
			$fisYear   =  $request->session()->get('macc_year');

	    	if($userType=='admin'){
	    	
	    		$data = DB::table('MASTER_VEHICLE_MFG')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->orderBy('MFG_CODE','DESC');

			}else if($userType=='superAdmin' || $userType=='user'){

				$data = DB::table('MASTER_VEHICLE_MFG')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->orderBy('MFG_CODE','DESC');
				
			}
			else{

				$data ='';
				
			}

			return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}

    	return view('admin.finance.master.Logistic.view_manufature');

    }


     public function Deletemanufature(Request $request){

    	$MfgId = $request->post('mfgId');
    	//print_r($destinationId);exit;

    	if ($MfgId!='') {
    		
    		$Delete = DB::table('MASTER_VEHICLE_MFG')->where('MFG_CODE', $MfgId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Manufature Was Deleted Successfully...!');
				return redirect('/view-manufature');

			} else {

				$request->session()->flash('alert-error', 'Manufature Can Not Deleted...!');
				return redirect('/view-manufature');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Fleet Truck Wheel Not Found...!');
			return redirect('/view-flet-truck-wheel');

    	}
    }

    public function EditManufactur($id,$btnControl){

    	//print_r($id);
    	$id=base64_decode($id);
    	$btnControl=base64_decode($btnControl);
    	if($id!=''){
    	    $query = DB::table('MASTER_VEHICLE_MFG');
			$query->where('MFG_CODE', $id);
			$userData['edit_manufactur'] = $query->get()->first();

			return view('admin.finance.master.Logistic.manufactur_list', $userData+compact('btnControl'));
		}else{
			$request->session()->flash('alert-error', 'Manufacturing-Id Not Found...!');
			return redirect('/form-mast-depot');
		}

    }

    public function ManufacturUpdate(Request $request){

    	//print_r($request->post());exit;

    	$validate = $this->validate($request, [

			'vehicle_mfg_code'    => 'required|max:12',
			'vehicle_mfg_name'    => 'required|max:15',

		]);

		$mfg_id=$request->input('MfgID');
		//print_r($request->post());exit;

		date_default_timezone_set('Asia/Kolkata');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");


		$lastUpdatedBy = $request->session()->get('userid');

		$data = array(
			"MFG_CODE"         => $request->input('vehicle_mfg_code'),
			"MFG_NAME"         => $request->input('vehicle_mfg_name'),
			"FLAG"             => $request->input('mfg_block'),
			"LAST_UPDATE_BY"   => $lastUpdatedBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);
		

		$saveData = DB::table('MASTER_VEHICLE_MFG')->where('MFG_CODE', $mfg_id)->update($data);

		$discriptn_page = "Master vehicle manufacturing update done by user";
		$this->userLogInsert($lastUpdatedBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'MAnufacturing Was Successfully Updated...!');
			return redirect('/view-manufature');

		} else {

			$request->session()->flash('alert-error', 'MAnufacturing Can Not Updated...!');
			return redirect('/view-manufature');

		}
    }

/* ----------- end manufacturing master ----------- */


/* ---------- start fleet tranaction -------------- */
	
	public function FleetTrnas(Request $request){

		$CompanyCode              = $request->session()->get('company_name');
		$compcode                 = explode('-', $CompanyCode);
		$getcompcode              =$compcode[0];
		$macc_year                = $request->session()->get('macc_year');
		
		$title                    ='Add Fleet Transaction';
		
		$userData['acc_list']     = DB::table('MASTER_ACC')->get();
		$userData['depot_list']   = DB::table('MASTER_DEPOT')->get();
		$userData['area_list']    = DB::table('MASTER_AREA')->get();
		$userData['acctype_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userData['series_list']  = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T5'])->get();
		$userData['item_list']    = DB::table('MASTER_ITEM')->get();
		$userData['truck_list']   = DB::table('MASTER_FLEET')->get();
		$userData['bank_list']    = DB::table('MASTER_HOUSEBANK')->get();
		$userData['vehicle_list'] = DB::table('VEHICLE_GATE_INWARD')->get();
		$userData['diesel_rate']  = DB::table('MASTER_DIESEL_RATE')->Orderby('ID','desc')->get()->first();

		//print_r($userData['diesel_rate']);exit;

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userData['fromDate'] =  $key->FY_FROM_DATE;
					$userData['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		$requistion = DB::table('FLEET_TRAN')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();

	//	print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userData['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T5')->get();

   		      $userData['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r($tranHeadL);exit;
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='T5'");
		//	print_r($vr_No_list);exit;
		//dd(DB::getQueryLog());
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userData['last_num']   = $key->LAST_NO;
					$userData['to_num']     = $key->TO_NO;
					//$userdata['trans_head'] = $key->TRAN_CODE;
				}

			}else{

					$userData['last_num']  ='';
					$userData['to_num']  ='';
					//$userdata['trans_head']  ='';

			}

		$NewLrNo = 'LR-101';

		$userData['lr_no']  = DB::table('FLEET_TRAN')->orderBy('FLEETTRANID','DESC')->get()->first();

    //  print_r($userdata['lr_no']->LR_NO);exit;
		if(isset($userData['lr_no'])){

			$lrno = $userData['lr_no']->LR_NO;

			$explode = explode('-', $lrno);

			$LRNo = $explode[1] + 1;

			$LRNO = $explode[0].'-'.$LRNo;

		}else{
			$LRNO = $NewLrNo;
		}
			//print_r($userData['acctype_list']);exit;
		
		return view('admin.finance.transaction.logistic.fleet_trans_form',$userData+compact('title','LRNO'));
		
	}

	public function FleetTransSave(Request $request){

	/*	echo '<pre>';
		print_r($request->post());exit;
		echo '</pre>';*/


		$trdate = $request->input('date');
		$Transaction_date = date("Y-m-d", strtotime($trdate));

    	$validate = $this->validate($request, [

			'date'        => 'required',
			'dept_code'   => 'required',
			'invoice_no'  => 'required',
			'shipment_no' => 'required',
			'acct_code'   => 'required',
			'area_code'   => 'required',
			'lr_no'       => 'required|unique:FLEET_TRAN,LR_NO',
			'trans_code'  => 'required',
			'truck_no'    => 'required',
			'material'    => 'required',
			'sto_qty_um'  => 'required',
			'sto_qty_aum' => 'required',
			'overload'    => 'required',
			
			
		]);

		$createdBy = $request->session()->get('userid');
		
		$comapny   = $request->session()->get('company_name');
		$slipcode  = explode('-', $comapny);
		$compName  = $slipcode[0];
		$fisYear   =  $request->session()->get('macc_year');
		$itemcode  = $request->input('material');
		$itemCode  = explode('-', $itemcode);
		$item_code = $itemCode[0];
		$indicator = $request->input('indicator');

		$FilterArray = array_filter($indicator);
		
		$count       = count($FilterArray);
		$gl_code         = $request->input('gl_code');
		$Amt             = $request->input('Amt');
		$bank_code       = $request->input('bank_code');
		$FilterArrayCode = array_filter($bank_code);
		$bankcount       = count($FilterArrayCode);
		$bank_name       = $request->input('bank_name');
		$bankAmt         = $request->input('bankAmt');
		$loadAvg         = $request->input('loadAvg');
		$emptyAvg        = $request->input('emptyAvg');
		$loadcpct        = $request->input('loadcpct');
		$model           = $request->input('model');

    	/*$diselexp = $request->input('Disel');

    	if($diselexp!=''){ 
    		$diselexp;
    	}else{ 
    		$diselexp ='';
    	}

    	$diselslipno = $request->input('deisel_slip_no');
    	if($diselslipno!=''){
    		$diselslipno;
    	}else{
    		$diselslipno='';
    	}

    	$drvexp = $request->input('drv_exp');
    	if($drvexp!=''){
    		$drvexp;
    	}else{
    		$drvexp='';
    	}

    	$foodinfexp = $request->input('fooding');
    	if($foodinfexp!=''){
    		$foodinfexp;
    	}else{
    		$foodinfexp='';
    	}

    	$adminexp = $request->input('p_exp');
    	if($adminexp!=''){
    		$adminexp;
    	}else{
    		$adminexp='';
    	}

    	$uloding = $request->input('lu_exp');
    	if($uloding!=''){
    		$uloding;
    	}else{
    		$uloding='';
    	}

    	$tollexp = $request->input('toll');
    	if($tollexp!=''){
    		$tollexp;
    	}else{
    		$tollexp='';
    	}

    	$otherexp = $request->input('other_exp');
    	if($otherexp!=''){
    		$otherexp;
    	}else{
    		$otherexp='';
    	}

    	$totaladv = $request->input('total_adv');
    	if($totaladv!=''){
    		$totaladv;
    	}else{
    		$totaladv='';
    	}

    	$dieselcr = $request->input('DIESEL_CR');
    	if($dieselcr!=''){
    		$dieselcr;
    	}else{
    		$dieselcr='';
    	}

    	$meterreding = $request->input('METER_READING');
    	if($meterreding!=''){
    		$meterreding;
    	}else{
    		$meterreding='';
    	}

    	$deselQty = $request->input('diesel_qty');
    	if($deselQty!=''){
    		$deselQty;
    	}else{
    		$deselQty='';
    	}*/

		$depot_code   = $request->input('dept_code');
		$account_code = $request->input('acct_code');
		$area_code    = $request->input('area_code');
		$item_code    = $item_code;
		$trpt_code    = $request->input('trans_code');

		$fLeetH = DB::select("SELECT MAX(FLEETTRANID) as FLEETTRANID FROM FLEET_TRAN");
	    $headID = json_decode(json_encode($fLeetH), true); 
	  
	    if(empty($headID[0]['FLEETTRANID'])){
	      $head_Id = 1;
	    }else{
	      $head_Id = $headID[0]['FLEETTRANID']+1;
	    }

		$data = array(
			"FLEETTRANID"       => $head_Id,
			"COMP_CODE"         => $compName,
			"FY_CODE"           => $fisYear,
			"TR_DATE"           => $Transaction_date,
			"DEPOT_CODE"        => $request->input('dept_code'),
			"INVOICE_NO"        => $request->input('invoice_no'),
			"SHIPMENT_NO"       => $request->input('shipment_no'),
			"ACC_CODE"          => $request->input('acct_code'),
			"AREA_CODE"         => $request->input('area_code'),
			"DIESEL_RATE"       => $request->input('diesel_rate'),
			"VEHICLE_INWARD_NO" => $request->input('vehicle_inward_no'),
			"VEHICLE_TYPE"      => $request->input('vehicle_type'),
			"LR_NO"             => $request->input('lr_no'),
			"TRPT_CODE"         => $request->input('trans_code'),
			"TRUCK_NO"          => $request->input('truck_no'),
			"VEHICLE_TYPE"      => $request->input('vehicle_type'),
			"DRIVER_NAME"       => $request->input('driver_name'),
			"ITEM_CODE"         => $item_code,
			"QTY"               => $request->input('sto_qty_um'),
			"AQTY"              => $request->input('sto_qty_aum'),
			"UM"                => $request->input('stoUM'),
			"AUM"               => $request->input('stoAum'),
			"OVERLOAD"          => $request->input('overload'),
			"RATE"              => $request->input('rate'),
			"LOAD_AVERAGE"      => $request->input('loadAvg'),
			"EMPTY_AVERAGE"     => $request->input('emptyAvg'),
			"LOAD_CAPACITY"     => $request->input('loadcpct'),
			"MODEL"             => $request->input('model'),
			/*"DRIVER_EXP"     => $drvexp,
			"FOODING_EXP"    => $foodinfexp,
			"ADMIN_EXP"      => $adminexp,
			"ULOADING_EXP"   => $uloding,
			"TOLL_EXP"       => $tollexp,
			"DIESEL_EXP"     => $diselexp,
			"OTHER_EXP"      => $otherexp,
			"TOTAL_ADV"      => $totaladv,
			"DIESEL_CR"      => $dieselcr,
			"DIESEL_SLIP_NO" => $diselslipno,
			"METER_READING"  => $meterreding,
			"DIESEL_QTY"     => $deselQty,*/
			"created_by"     => $createdBy,
			
		);

		$saveData = DB::table('FLEET_TRAN')->insert($data);

		

		for ($i=0; $i < $count; $i++) { 

			$fLeetH1 = DB::select("SELECT MAX(FLEETTRANEXPID) as FLEETTRANEXPID FROM FLEET_TRAN_EXP");
		    $expID = json_decode(json_encode($fLeetH1), true); 
		  
		    if(empty($expID[0]['FLEETTRANEXPID'])){
		      $exp_Id = 1;
		    }else{
		      $exp_Id = $expID[0]['FLEETTRANEXPID']+1;
		    }

			$data = array(
			"FLEETTRANEXPID" => $exp_Id,
			"FLEETTRANID"    => $head_Id,
			"COMP_CODE"      => $compName,
			"FY_CODE"        => $fisYear,
			"INDICATOR"      => $indicator[$i],
			"GL_CODE"        => $gl_code[$i],
			"AMOUNT"         => $Amt[$i],
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData1 = DB::table('FLEET_TRAN_EXP')->insert($data);

		}


		

		for ($j=0; $j < $bankcount; $j++) {

				$fLeetP = DB::select("SELECT MAX(FLEETTRANPMTID) as FLEETTRANPMTID FROM FLEET_TRAN_PMT");
			    $pmtID = json_decode(json_encode($fLeetP), true); 
			  
			    if(empty($pmtID[0]['FLEETTRANPMTID'])){
			      $pmt_Id = 1;
			    }else{
			      $pmt_Id = $pmtID[0]['FLEETTRANPMTID']+1;
			    } 

			$data = array(
			"FLEETTRANPMTID" => $pmt_Id,
			"FLEETTRANID"    => $head_Id,
			"COMP_CODE"      => $compName,
			"FY_CODE"        => $fisYear,
			"BANK_CODE"      => $bank_code[$j],
			"BANK_NAME"      => $bank_name[$j],
			"PAYMENT"        => $bankAmt[$j],
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData2 = DB::table('FLEET_TRAN_PMT')->insert($data);

		}
		if($saveData){

			$request->session()->flash('alert-success', 'Fleet Transaction Was Successfully Added...!');
			return redirect('/logistic/view-fleet-transaction');

		} else {

			$request->session()->flash('alert-error', 'Fleet Transaction Can Not Added...!');
			return redirect('/logistic/view-fleet-transaction');
		}
    	
    	
    }

    public function ViewFleetTrans(Request $request){

	//print_r('hi');exit;
		if ($request->ajax()) {

			$title = 'View Fleet Transaction';

			$user_type = $request->session()->get('user_type');

			$userid = $request->session()->get('userid');

			$company   = $request->session()->get('company_name');
			$splicode = explode('-', $company);
			$compName = $splicode[0];
			$fisYear   = $request->session()->get('macc_year');

			if($user_type == 'admin'){

			$data = DB::table('FLEET_TRAN')->where(['COMP_CODE' => $compName, 'FY_CODE' => $fisYear])->orderBy('FLEETTRANID','DESC');

			}else if($user_type == 'superAdmin' || $user_type == 'user'){

			$data = DB::table('FLEET_TRAN')->where(['CREATED_BY' => $userid, 'COMP_CODE' => $compName, 'FY_CODE' => $fisYear])->orderBy('FLEETTRANID','DESC')->get();
			}	
			//print_r($data);exit;
			/*return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="'.url('/logistic/edit-fleet-transaction/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#fleetDelete" class="btn btn-danger btn-xs" onclick="return deletefleet('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';

	     			return $btn;
			})->make(true);*/
			return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

		}

		return view('admin.finance.transaction.logistic.view_fleet_trans_logistic');
		/*return DataTables::queryBuilder($data)->toJson();*/
		//print_r($data);exit;
	}


	 public function ViewChildFleetTrans(Request $request){

		$response_array = array();

		if ($request->ajax()) {

		   	$headid = $request->input('tblid');

	    	$fleettran = DB::table('FLEET_TRAN_EXP')->where('FLEETTRANID', $headid)->get()->toArray();
	    	

    		if($fleettran) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fleettran;
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }




    /* ---------- supplimentry trip -------------- */
	
	public function SupplimentryTrnas(Request $request){

		$CompanyCode              = $request->session()->get('company_name');
		$compcode                 = explode('-', $CompanyCode);
		$getcompcode              =$compcode[0];
		$macc_year                = $request->session()->get('macc_year');
		
		$title                    ='Add Fleet Transaction';
		
		$userData['acc_list']     = DB::table('MASTER_ACC')->get();
		$userData['depot_list']   = DB::table('MASTER_DEPOT')->get();
		$userData['area_list']    = DB::table('MASTER_AREA')->get();
		$userData['acctype_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userData['series_list']  = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T5'])->get();
		$userData['item_list']    = DB::table('MASTER_ITEM')->get();
		$userData['truck_list']   = DB::table('MASTER_FLEET')->get();
		$userData['bank_list']    = DB::table('MASTER_HOUSEBANK')->get();
		$userData['vehicle_list'] = DB::table('VEHICLE_GATE_INWARD')->get();
		$userData['diesel_rate']  = DB::table('MASTER_DIESEL_RATE')->Orderby('ID','desc')->get()->first();

		//print_r($userData['diesel_rate']);exit;

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userData['fromDate'] =  $key->FY_FROM_DATE;
					$userData['toDate']   =  $key->FY_TO_DATE;
					}

		/*$purchase = DB::table('purchase_indent_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();*/

		$requistion = DB::table('FLEET_TRAN')->where('COMP_CODE', $getcompcode)->where('FY_CODE',$macc_year)->get();

	//	print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userData['vrNumber'] =$vrseqnum;

			//print_r(expression)
			//DB::enableQueryLog();
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T5')->get();

   		      $userData['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r($tranHeadL);exit;
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='T5'");
		//	print_r($vr_No_list);exit;
		//dd(DB::getQueryLog());
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userData['last_num']   = $key->LAST_NO;
					$userData['to_num']     = $key->TO_NO;
					//$userdata['trans_head'] = $key->TRAN_CODE;
				}

			}else{

					$userData['last_num']  ='';
					$userData['to_num']  ='';
					//$userdata['trans_head']  ='';

			}

		$NewLrNo = 'LR-101';

		$userData['lr_no']  = DB::table('FLEET_TRAN')->orderBy('FLEETTRANID','DESC')->get()->first();

    //  print_r($userdata['lr_no']->LR_NO);exit;
		if(isset($userData['lr_no'])){

			$lrno = $userData['lr_no']->LR_NO;

			$explode = explode('-', $lrno);

			$LRNo = $explode[1] + 1;

			$LRNO = $explode[0].'-'.$LRNo;

		}else{
			$LRNO = $NewLrNo;
		}
			//print_r($userData['acctype_list']);exit;
		
		return view('admin.finance.transaction.logistic.supplimentry_trans',$userData+compact('title','LRNO'));
		
	}

	public function SupplimentryTransSave(Request $request){

	/*	echo '<pre>';
		print_r($request->post());exit;
		echo '</pre>';*/


		$trdate = $request->input('date');
		$Transaction_date = date("Y-m-d", strtotime($trdate));

    	$validate = $this->validate($request, [

			'date'        => 'required',
			'dept_code'   => 'required',
			'invoice_no'  => 'required',
			'shipment_no' => 'required',
			'acct_code'   => 'required',
			'area_code'   => 'required',
			'lr_no'       => 'required|unique:FLEET_TRAN,LR_NO',
			'trans_code'  => 'required',
			'truck_no'    => 'required',
			'material'    => 'required',
			'sto_qty_um'  => 'required',
			'sto_qty_aum' => 'required',
			'overload'    => 'required',
			
			
		]);

		$createdBy = $request->session()->get('userid');
		
		$comapny   = $request->session()->get('company_name');
		$slipcode  = explode('-', $comapny);
		$compName  = $slipcode[0];
		$fisYear   =  $request->session()->get('macc_year');
		$itemcode  = $request->input('material');
		$itemCode  = explode('-', $itemcode);
		$item_code = $itemCode[0];
		$indicator = $request->input('indicator');

		$FilterArray = array_filter($indicator);
		
		$count       = count($FilterArray);
		$gl_code         = $request->input('gl_code');
		$Amt             = $request->input('Amt');
		$bank_code       = $request->input('bank_code');
		$FilterArrayCode = array_filter($bank_code);
		$bankcount       = count($FilterArrayCode);
		$bank_name       = $request->input('bank_name');
		$bankAmt         = $request->input('bankAmt');
		$loadAvg         = $request->input('loadAvg');
		$emptyAvg        = $request->input('emptyAvg');
		$loadcpct        = $request->input('loadcpct');
		$model           = $request->input('model');

    	/*$diselexp = $request->input('Disel');

    	if($diselexp!=''){ 
    		$diselexp;
    	}else{ 
    		$diselexp ='';
    	}

    	$diselslipno = $request->input('deisel_slip_no');
    	if($diselslipno!=''){
    		$diselslipno;
    	}else{
    		$diselslipno='';
    	}

    	$drvexp = $request->input('drv_exp');
    	if($drvexp!=''){
    		$drvexp;
    	}else{
    		$drvexp='';
    	}

    	$foodinfexp = $request->input('fooding');
    	if($foodinfexp!=''){
    		$foodinfexp;
    	}else{
    		$foodinfexp='';
    	}

    	$adminexp = $request->input('p_exp');
    	if($adminexp!=''){
    		$adminexp;
    	}else{
    		$adminexp='';
    	}

    	$uloding = $request->input('lu_exp');
    	if($uloding!=''){
    		$uloding;
    	}else{
    		$uloding='';
    	}

    	$tollexp = $request->input('toll');
    	if($tollexp!=''){
    		$tollexp;
    	}else{
    		$tollexp='';
    	}

    	$otherexp = $request->input('other_exp');
    	if($otherexp!=''){
    		$otherexp;
    	}else{
    		$otherexp='';
    	}

    	$totaladv = $request->input('total_adv');
    	if($totaladv!=''){
    		$totaladv;
    	}else{
    		$totaladv='';
    	}

    	$dieselcr = $request->input('DIESEL_CR');
    	if($dieselcr!=''){
    		$dieselcr;
    	}else{
    		$dieselcr='';
    	}

    	$meterreding = $request->input('METER_READING');
    	if($meterreding!=''){
    		$meterreding;
    	}else{
    		$meterreding='';
    	}

    	$deselQty = $request->input('diesel_qty');
    	if($deselQty!=''){
    		$deselQty;
    	}else{
    		$deselQty='';
    	}*/

		$depot_code   = $request->input('dept_code');
		$account_code = $request->input('acct_code');
		$area_code    = $request->input('area_code');
		$item_code    = $item_code;
		$trpt_code    = $request->input('trans_code');

		$fLeetH = DB::select("SELECT MAX(FLEETTRANID) as FLEETTRANID FROM FLEET_TRAN");
	    $headID = json_decode(json_encode($fLeetH), true); 
	  
	    if(empty($headID[0]['FLEETTRANID'])){
	      $head_Id = 1;
	    }else{
	      $head_Id = $headID[0]['FLEETTRANID']+1;
	    }

		$data = array(
			"FLEETTRANID"       => $head_Id,
			"COMP_CODE"         => $compName,
			"FY_CODE"           => $fisYear,
			"TR_DATE"           => $Transaction_date,
			"DEPOT_CODE"        => $request->input('dept_code'),
			"INVOICE_NO"        => $request->input('invoice_no'),
			"SHIPMENT_NO"       => $request->input('shipment_no'),
			"ACC_CODE"          => $request->input('acct_code'),
			"AREA_CODE"         => $request->input('area_code'),
			"DIESEL_RATE"       => $request->input('diesel_rate'),
			"VEHICLE_INWARD_NO" => $request->input('vehicle_inward_no'),
			"VEHICLE_TYPE"      => $request->input('vehicle_type'),
			"LR_NO"             => $request->input('lr_no'),
			"TRPT_CODE"         => $request->input('trans_code'),
			"TRUCK_NO"          => $request->input('truck_no'),
			"VEHICLE_TYPE"      => $request->input('vehicle_type'),
			"DRIVER_NAME"       => $request->input('driver_name'),
			"ITEM_CODE"         => $item_code,
			"QTY"               => $request->input('sto_qty_um'),
			"AQTY"              => $request->input('sto_qty_aum'),
			"UM"                => $request->input('stoUM'),
			"AUM"               => $request->input('stoAum'),
			"OVERLOAD"          => $request->input('overload'),
			"RATE"              => $request->input('rate'),
			"LOAD_AVERAGE"      => $request->input('loadAvg'),
			"EMPTY_AVERAGE"     => $request->input('emptyAvg'),
			"LOAD_CAPACITY"     => $request->input('loadcpct'),
			"MODEL"             => $request->input('model'),
			/*"DRIVER_EXP"     => $drvexp,
			"FOODING_EXP"    => $foodinfexp,
			"ADMIN_EXP"      => $adminexp,
			"ULOADING_EXP"   => $uloding,
			"TOLL_EXP"       => $tollexp,
			"DIESEL_EXP"     => $diselexp,
			"OTHER_EXP"      => $otherexp,
			"TOTAL_ADV"      => $totaladv,
			"DIESEL_CR"      => $dieselcr,
			"DIESEL_SLIP_NO" => $diselslipno,
			"METER_READING"  => $meterreding,
			"DIESEL_QTY"     => $deselQty,*/
			"created_by"     => $createdBy,
			
		);

		$saveData = DB::table('FLEET_TRAN')->insert($data);

		

		for ($i=0; $i < $count; $i++) { 

			$fLeetH1 = DB::select("SELECT MAX(FLEETTRANEXPID) as FLEETTRANEXPID FROM FLEET_TRAN_EXP");
		    $expID = json_decode(json_encode($fLeetH1), true); 
		  
		    if(empty($expID[0]['FLEETTRANEXPID'])){
		      $exp_Id = 1;
		    }else{
		      $exp_Id = $expID[0]['FLEETTRANEXPID']+1;
		    }

			$data = array(
			"FLEETTRANEXPID" => $exp_Id,
			"FLEETTRANID"    => $head_Id,
			"COMP_CODE"      => $compName,
			"FY_CODE"        => $fisYear,
			"INDICATOR"      => $indicator[$i],
			"GL_CODE"        => $gl_code[$i],
			"AMOUNT"         => $Amt[$i],
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData1 = DB::table('FLEET_TRAN_EXP')->insert($data);

		}


		

		for ($j=0; $j < $bankcount; $j++) {

				$fLeetP = DB::select("SELECT MAX(FLEETTRANPMTID) as FLEETTRANPMTID FROM FLEET_TRAN_PMT");
			    $pmtID = json_decode(json_encode($fLeetP), true); 
			  
			    if(empty($pmtID[0]['FLEETTRANPMTID'])){
			      $pmt_Id = 1;
			    }else{
			      $pmt_Id = $pmtID[0]['FLEETTRANPMTID']+1;
			    } 

			$data = array(
			"FLEETTRANPMTID" => $pmt_Id,
			"FLEETTRANID"    => $head_Id,
			"COMP_CODE"      => $compName,
			"FY_CODE"        => $fisYear,
			"BANK_CODE"      => $bank_code[$j],
			"BANK_NAME"      => $bank_name[$j],
			"PAYMENT"        => $bankAmt[$j],
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData2 = DB::table('FLEET_TRAN_PMT')->insert($data);

		}
		if($saveData){

			$request->session()->flash('alert-success', 'Fleet Transaction Was Successfully Added...!');
			return redirect('/logistic/view-fleet-transaction');

		} else {

			$request->session()->flash('alert-error', 'Fleet Transaction Can Not Added...!');
			return redirect('/logistic/view-fleet-transaction');
		}
    	
    	
    }

    public function ViewSupplimentryTrans(Request $request){

	//print_r('hi');exit;
		if ($request->ajax()) {

			$title = 'View Fleet Transaction';

			$user_type = $request->session()->get('user_type');

			$userid = $request->session()->get('userid');

			$company   = $request->session()->get('company_name');
			$splicode = explode('-', $company);
			$compName = $splicode[0];
			$fisYear   = $request->session()->get('macc_year');

			if($user_type == 'admin'){

			$data = DB::table('FLEET_TRAN')->where(['COMP_CODE' => $compName, 'FY_CODE' => $fisYear])->orderBy('FLEETTRANID','DESC');

			}else if($user_type == 'superAdmin' || $user_type == 'user'){

			$data = DB::table('FLEET_TRAN')->where(['CREATED_BY' => $userid, 'COMP_CODE' => $compName, 'FY_CODE' => $fisYear])->orderBy('FLEETTRANID','DESC')->get();
			}	
			//print_r($data);exit;
			/*return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					$btn = '<a href="'.url('/logistic/edit-fleet-transaction/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#fleetDelete" class="btn btn-danger btn-xs" onclick="return deletefleet('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';

	     			return $btn;
			})->make(true);*/
			return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

		}

		return view('admin.finance.transaction.logistic.view_supplimentry_trans');
		/*return DataTables::queryBuilder($data)->toJson();*/
		//print_r($data);exit;
	}


	 public function ViewChildSupplimentry(Request $request){

		$response_array = array();

		if ($request->ajax()) {

		   	$headid = $request->input('tblid');

	    	$fleettran = DB::table('FLEET_TRAN_EXP')->where('FLEETTRANID', $headid)->get()->toArray();
	    	

    		if($fleettran) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fleettran;
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }
// supplimentry trip

    public function ViewChildTruckWheel(Request $request){

		$response_array = array();

		if ($request->ajax()) {

		   	$wheel_code = $request->input('wheel_code');

		  	//print_r($headid);exit;

	    	$fleettran = DB::table('MASTER_FLEETEXP')->where('FLEET_TYPE', $wheel_code)->get()->toArray();
	    	

    		if($fleettran) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fleettran;
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


/* ---------- end fleet tranaction -------------- */
	
/* ------------- start fleet certificate transaction ----------------*/
	
	public function FleetCertTransForm(Request $request){

		$truckData = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->get();

   	    return view('admin.finance.master.Logistic.fleet_cert_transaction_form',compact('truckData'));

   }

   public function FleetCertTransData(Request $request){
        
        $response_array = array();

		if ($request->ajax()) {


	    	$truck_no = $request->truck_no;
    	    $cert_code = $request->cert_code;

	    	$getadata = DB::table('FLEET_CERTF_TRAN')->where('TRUCK_NO',$truck_no)->where('CERTF_CODE',$cert_code)->whereNull('CERTF_RENEW_DATE')->get();

	    	//print_r($getadata);exit;
	    	$count=count($getadata);
    		if ($count > 0) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $getadata;

	           echo $data = json_encode($response_array);

	            //print_r($data);

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

    public function FleetCertTransFormSave(Request $request){

		$createdBy   = $request->session()->get('userid');
		$company     = $request->session()->get('company_name');
		$fisYear     =  $request->session()->get('macc_year');
		$getcompcode = explode('-', $company);
		$comp_code   = $getcompcode[0];
		$comp_name   = $getcompcode[1];

		$truckNo         = $request->input('truckNo');

		if($truckNo != ''){

        // DB::enableQueryLog();
		$chkTruckNoExit = DB::table('FLEET_CERTF_TRAN')->where('TRUCK_NO',$truckNo)->get()->first();
		// dd(DB::getQueryLog());

			$response_array = array();
			
			if($chkTruckNoExit == ''){

				$cert_code       = $request->input('all_certCode');

				$FilterArray     = array_filter($cert_code);

				$count           = count($FilterArray);

				$allcertCode      = $request->input('all_certCode');
				$allcertName      = $request->input('all_certName');
				$allcertNo       = $request->input('all_certNo');
				$allcertDate     = $request->input('all_certDate');
				$allcertRDuedate = $request->input('all_certRDuedate');
				$allcertRnewdate = $request->input('all_certRnewdate');

		        for ($i=0; $i < $count; $i++) {

			        $data = array(

						"COMP_CODE"        => $comp_code,
						"FY_CODE"          => $fisYear,
						"COMP_NAME"        => $comp_name,
						"TRUCK_NO"         => $truckNo,
						"CERTF_CODE"       => $allcertCode[$i],
						"CERTF_NAME"       => $allcertName[$i],
						"CERTF_NO"         => $allcertNo[$i],
						"CERTF_DATE"       => date("Y-m-d", strtotime($allcertDate[$i])),
						"CRENEW_DUEDT"     => date("Y-m-d", strtotime($allcertRDuedate[$i])),
						"CERTF_RENEW_DATE" => date("Y-m-d", strtotime($allcertRnewdate[$i])),
						"FLAG"             => 0,
						"CERTF_BLOCK"      => 'NO',
						"CREATED_BY"       => $createdBy,
			        );

			        $saveData = DB::table('FLEET_CERTF_TRAN')->insert($data);
				}

				$discriptn_page = "Fleet Certificate transaction update by user";

				$this->userLogInsert($createdBy,$discriptn_page);
		        
		        if($saveData){

		        	 $response_array['response'] = 'success';
		             $response_array['data'] = '';

		             echo $data = json_encode($response_array);

		         }else{

		         	$response_array['response'] = 'error';
		            $response_array['data'] = '';

		            echo $data = json_encode($response_array);


		         }

			}else{

				$response_array['response'] = 'duplicate';
		        $response_array['data'] = '';

		        echo $data = json_encode($response_array);

			}
		}
}



public function ViewFleetCertTrans(Request $request){

	if ($request->ajax()) {

			$title = 'View Fleet Certificate';

			$user_type = $request->session()->get('user_type');

			$userid = $request->session()->get('userid');

			$company   = $request->session()->get('company_name');
			$splicode = explode('-', $company);
			$compName = $splicode[0];
			$fisYear   = $request->session()->get('macc_year');
		
			$data = DB::table('FLEET_CERTF_TRAN')->groupBy('TRUCK_NO')->orderBy('ID','DESC');

			return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

		}

		
		return view('admin.finance.master.Logistic.view_fleet_certificate');
		
	}

	public function ViewChildFleetCert(Request $request){

    $response_array = array();

    if ($request->ajax()) {

        $truckNo = $request->input('truckNo');
        $id = $request->input('tblid');

        $fleetCertTrans = DB::table('FLEET_CERTF_TRAN')->where('TRUCK_NO', $truckNo)->get()->toArray();
        

        if($fleetCertTrans) {

            $response_array['response'] = 'success';
            $response_array['data'] = $fleetCertTrans;
            echo $data = json_encode($response_array);

	    }else{

				$response_array['response'] = 'error';
				$response_array['data'] = '' ;
				$response_array['count'] = '';

				$data = json_encode($response_array);

				print_r($data);
	        
	    }

    }else{

			$response_array['response'] = 'error';
			$response_array['data'] = '' ;
			$response_array['count'] = '';
			
			$data = json_encode($response_array);
			
			print_r($data);
      }

    }

    public function FleetCertVehicalInfo(Request $request){

    	$vehicle_no = $request->input('truck_no');

        $token = $request->session()->get('api_token');

    	$authorization = "Authorization: Bearer ".$token;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
    
		curl_setopt($curl, CURLOPT_URL, "https://ulip.logilocker.in/logilocker/api/vahan?vehicleNo=".$vehicle_no."&gstin=''&forceUpdate=true");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		curl_close($curl);
		$data1 = json_decode($result, true);
		// echo '<PRE>';print_r($data1['response']['vehicleNo']);echo '</PRE>';

    	$response_array = array();

    	if($vehicle_no){

    		$response_array['response'] = 'success';
    		$response_array['data'] = $data1['response'];
    		$data = json_encode($response_array);

            print_r($data);


    	}else{

    		$response_array['response'] = 'error';
    		$response_array['data'] = '';
    		$data = json_encode($response_array);

            print_r($data);

    	}

    }

/* ------------- end fleet certificate transaction ----------------*/

/* ----------- start fleet challan receipt ------------ */
	
	public function SubmitPartyBilReport(Request $request){

    	if ($request->ajax()) {

			if (!empty($request->challan_no)) {

				
				$party     = $request->challan_no;
				$trDate    = date("Y-m-d", strtotime($request->tr_date));
				
				$usertype  = $request->session()->get('user_type');
				$comp_Name = $request->session()->get('company_name');
				$explode   = explode('-', $comp_Name);
				$compName  = $explode[0];
				$fisYear   =  $request->session()->get('macc_year');
				


				if(isset($party)  && trim($party)!=""  && $usertype=='admin')
				{
					$strWhere=" AND FLEET_TRAN.LR_NO= '$party' AND FLEET_TRAN.LR_REC_DATE='0000-00-00'";

				}
				 else if(isset($party)  && trim($party)!="" &&  ($usertype=='superAdmin' || $usertype=='user')){
			    	$strWhere=" AND FLEET_TRAN.LR_NO= '$party' AND FLEET_TRAN.COMP_CODE='$compName' AND FLEET_TRAN.FLEET_TRAN='$fisYear' AND FLEET_TRAN.LR_REC_DATE='0000-00-00'";
			    }

				$data1 = DB::select("SELECT * FROM `FLEET_TRAN` where 1=1  $strWhere");

				$array1 = json_decode( json_encode($data1), true);

				foreach ($array1 as $key => $row) {

					$array1[$key]['trdate']=$trDate;
				}

				$data=$array1;

				return DataTables()->of($data)->addIndexColumn()->make(true);


				
			}
		    

		}

			$usertype 	= $request->session()->get('user_type');
			
			$title = 'Manage Party Bill';
   		   
            return view('admin.logistic.transaction.submit_party_bill',compact('title'));

    	
    }

    public function EditChallanReceipt($id,$trdate){

    	$title = 'Edit Submit Challan';
    	//print_r($id);
    	$id = base64_decode($id);
    	$trdate = base64_decode($trdate);
    	if($id!=''){
    	    $query = DB::table('FLEET_TRAN');
			$query->where('FLEETTRANID', $id);
			$userData['FLEET_TRAN'] = $query->get()->first();

			$acc_code = $userData['FLEET_TRAN']->ACC_CODE;
			//print_r($acc_code);exit;
			$userData['servicechrg'] = DB::table('MASTER_ACC')->where('ACC_CODE',$acc_code)->get()->first();
			

			//print_r($userData['fleet_trans']);exit;
			$userData['acc_list']     = DB::table('MASTER_ACC')->get();
			$userData['depot_list']   = DB::table('MASTER_DEPOT')->get();
			$userData['area_list']    = DB::table('MASTER_AREA')->get();
			$userData['acctype_list'] = DB::table('MASTER_ACCTYPE')->get();
			$userData['item_list']    = DB::table('MASTER_ITEM')->get();

			$tr_date = $trdate;
			/*
			$userData['state_list'] = DB::table('master_state')->get();

			 $userData['acc_type_list'] = DB::table('master_acctype')->get();*/

			return view('admin.finance.transaction.logistic.edit_submit_party_bill', $userData+compact('title','tr_date'));
		}else{
			$request->session()->flash('alert-error', 'Account Code Not Found...!');
			return redirect('/form-mast-depot');
		}

    }

/* ----------- end fleet challan receipt ------------ */

/* ----------- start TRPT bill generate -------------- */
	
	public function PartyBillReport(Request $request){

	

    	if ($request->ajax()) {

			if (!empty($request->acct_code)) {
		    	
				$acct_code     = $request->acct_code;

				
				$usertype 	= $request->session()->get('user_type');
				$CompanyCode   = $request->session()->get('company_name');
				$MaccYear      = $request->session()->get('macc_year');
				
				if(isset($acct_code)  && trim($acct_code)!="" && $usertype=='admin')
				{
					$strWhere=" AND TRIP_BODY.ACC_CODE= '$acct_code'";

				}
				 else if(isset($acct_code)  && trim($acct_code)!="" && ($usertype=='superAdmin' || $usertype=='user')){
			    	$strWhere=" AND TRIP_BODY.ACC_CODE= '$acct_code' AND FLEET_TRAN.COMP_CODE='$CompanyCode' AND TRIP_BODY.FY_CODE='$MaccYear'";
			    }

				//$data = DB::select("SELECT * FROM `FLEET_TRAN` where 1=1  $strWhere AND BILL_NO='' AND LR_REC_DATE!='0000-00-00'");*/

				$data = DB::select("SELECT t1.ACC_CODE as Acc_code,t2.* FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID = t2.TRIPHID  WHERE 1=1  $strWhere");

				print_r($data);exit;

				return DataTables()->of($data)->addIndexColumn()->make(true);
				
			}

		}

			$usertype 	= $request->session()->get('user_type');

			$CompanyCode   = $request->session()->get('company_name');

		    $MaccYear      = $request->session()->get('macc_year');

			
			$title = 'Manage Party Bill';

   		   /*$userdata['acc_list'] = DB::table('master_acc')->where('acctype_code','T')->get();*/

   		   $userdata['acc_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
   		   $userdata['vehicle_list'] = DB::table('MASTER_FLEET')->get();


   		   $partybilget = DB::table('PARTY_BILL')->get();
   		   $gtebilid = '';
   		   foreach($partybilget as $row){
   		   		$gtebilid = $row->bill_no;
   		   		
   		   }

   		   $userdata['bilno'] = $gtebilid;

            return view('admin.finance.transaction.logistic.manage_party_bill',$userdata+compact('title'));

    	
    }


/* ----------- end TRPT bill generate -------------- */


 public function TransporterBillPosting(Request $request){

        $title = "Transporter Bill Posting";

        $company_name = $request->session()->get('company_name');
        $macc_year    = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid       = $request->session()->get('userid');

       

		$userdata['acc_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userdata['vehicle_list'] = DB::table('MASTER_FLEET')->get();
 

        if(isset($company_name)){

            return view('admin.finance.transaction.logistic.transporter_bill_posting',$userdata);
        }else{

            return redirect('/useractivity');

        }

    }


 public function TransporterPartyBill(Request $request){

        if($request->ajax()) {

             if (!empty($request->acct_code || $request->vehicle_no || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
                $vehicle_no     = $request->vehicle_no;
             

                if(isset($request->vehicle_no)  && trim($request->vehicle_no)!=""){
                    
                    $strWhere .= "AND  TRIP_HEAD.VEHICLE_NO = '$request->vehicle_no'";
                }


                if(isset($request->acct_code)  && trim($request->acct_code)!=""){
                    $strWhere .= "AND  TRIP_HEAD.TRANSPORT_CODE = '$request->acct_code'";
                }

             
                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  TRIP_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

              
              // DB::enableQueryLog();

                    $data = DB::select("SELECT TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.NET_AMOUNT,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1 $strWhere AND TRIP_HEAD.LR_ACK_STATUS ='1' GROUP BY TRIP_BODY.TRIPHID");


              // dd(DB::getQueryLog());
                $discriptn_page = "Search purchase indent report by user";
                $accountCd = '';
             //   $this->userLogInsert($loginUser,$vrseqNum,$series_code,$discriptn_page,$accountCd);  
                
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


	public function SaveInPartyBill_old(Request $request){
				
				
				

				$company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $compCode    = $getcomcode[0];

				$fisYear    = $request->session()->get('macc_year');
				$createdBy      = $request->session()->get('userid');
		  		
			if ($request->ajax()) {

		  		$getid = $request->flitClass;
		  		$transDate = $request->transDate;
		  		$bill_no = $request->bill_no;

		  		$getcountid = count($getid);

		  		$saveData ='';


		  		for ($i=0; $i < $getcountid ; $i++) { 

		  			$checkid = $getid[$i];

		  			//$data = DB::select("SELECT * FROM TRIP_BODY WHERE TRIPBID='$checkid'");

		  			$data = DB::select("SELECT TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIPBID='$checkid'");

		  		//print_r($data);exit;

		  			
		  		
		  			foreach ($data as $key) {

		  					

				  			$ACC_CODE = $key->TRANSPORT_CODE;

				  			$fetch_acctype =  DB::table('MASTER_ACC')->where('ACC_CODE',$ACC_CODE)->get()->first();

				  			$party ='';

				  	//DB::enableQueryLog();

				        $fetch_glCode = DB::table('MASTER_GLKEY')->select('MASTER_GLKEY.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')->leftjoin('MASTER_GL', 'MASTER_GLKEY.GL_CODE', '=', 'MASTER_GL.GL_CODE')->where('MASTER_GLKEY.ATYPE_CODE',$fetch_acctype->ATYPE_CODE)->get()->first();

				  // dd(DB::getQueryLog());


		  					
		                ///print_r($fetch_glCode->GL_CODE);

							$vehicleNo      = $key->VehicleNo;
							$lr_no          = $key->LR_NO;
							$transport_code = $key->TRANSPORT_CODE;
							$transport_name = $key->TRANSPORT_NAME;
							$to_place       = $key->TO_PLACE;
							$lr_qty         = $key->QTY;
							$pfctcode       = $key->PFCT_CODE;
							$pfctname       = $key->pfctName;
							$transcode      = 'A2';
							$seriescode     = 'JB02';
							$seriesName     = 'JOURNAL EXPENSE';
							$glCode         = $fetch_glCode->GL_CODE;
							$glName         = $fetch_glCode->GL_NAME;
							$pay_vr_date    = $key->VrDate;
							$freight_amt    = $key->TRIP_FREIGHT_AMT;
							$net_amt        = $key->NET_AMOUNT;


							


							for ($k = 0; $k < 2; $k++){

								$srno=$k + 1;
								$NewVrno=$k + 1;
				
								$JVtranH = DB::select("SELECT MAX(JVID) as JVID FROM JV_TRAN");
								$headID = json_decode(json_encode($JVtranH), true); 
								if(empty($headID[0]['JVID'])){
									$head_Id = 1;
								}else{
									$head_Id = $headID[0]['JVID']+1;
								}

								/*$vrno_Exist = DB::table('JV_TRAN')->where('SERIES_CODE',$seriescode)->where('COMP_CODE',$CompanyCode)->where('FY_CODE',$MaccYear)->where('TRAN_CODE',$transcode)->where('VRNO',$vrNum)->get()->toArray();

								if($vrno_Exist){
									$NewVrno = $vrNum +1;
								}else{
									$NewVrno = 1;
								}*/

								$particular = 'TESTING';

								if($k==1){


									$data = array(

										'JVID'        =>$head_Id,
										'COMP_CODE'   =>$compCode,
										'FY_CODE'     =>$fisYear,
										'PFCT_CODE'   =>$pfctcode,
										'PFCT_NAME'   =>$pfctname,
										'TRAN_CODE'   =>$transcode,
										'SERIES_CODE' =>$seriescode,
										'SERIES_NAME' =>$seriesName,
										'VRNO'        =>$NewVrno,
										'SLNO'        =>$srno,
										'VRDATE'      =>$pay_vr_date,
										'ACC_CODE'    =>$transport_code,
										'ACC_NAME'    =>$transport_name,
										'GL_CODE'     =>$glCode,
										'GL_NAME'     =>$glName,
										'PARTICULAR'  =>$particular,
										'CRAMT'       =>$freight_amt,
										'CREATED_BY'  =>$createdBy,

									);

								//	print_r($data);

									$saveData = DB::table('JV_TRAN')->insert($data);


								/*$this->JournalAccEntry($compCode,$fisYear,$transcode,$seriescode,$NewVrno,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$net_amt,$particular,$createdBy);*/

									

								}else{

									$data = array(

										'JVID'        =>$head_Id,
										'COMP_CODE'   =>$compCode,
										'FY_CODE'     =>$fisYear,
										'PFCT_CODE'   =>$pfctcode,
										'PFCT_NAME'   =>$pfctname,
										'TRAN_CODE'   =>$transcode,
										'SERIES_CODE' =>$seriescode,
										'SERIES_NAME' =>$seriesName,
										'VRNO'        =>$srno,
										'SLNO'        =>$srno,
										'VRDATE'      =>$pay_vr_date,
										'ACC_CODE'    =>$transport_code,
										'ACC_NAME'    =>$transport_name,
										'GL_CODE'     =>$glCode,
										'GL_NAME'     =>$glName,
										'PARTICULAR'  =>$particular,
										'DRAMT'       =>$net_amt,
										'CREATED_BY'  =>$createdBy,

									);


									$saveData = DB::table('JV_TRAN')->insert($data);

									/*$this->JournalGlLegEntry($compCode,$fisYear,$transcode,$seriescode,$glCode,$glName,$NewVrno,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$net_amt,$particular,$createdBy);*/
								}

								$BillArray = array(

									'BILL_STATUS' => 1


								);

						       $updateData = DB::table('TRIP_BODY')->where('TRIPBID',$checkid)->update($BillArray);


					    //  
								
					}
					
		  	}
		  			
		 }
		  		

		  			$data1 = array();

		  			if ($saveData) {

		  				$data1['message'] = 'Success';
		  				$data1['party'] = $data;

		  				$getalldata = json_encode($data1);  
		  				print_r($getalldata);

					} else {

						$data1['message'] = 'Error';
		  				$getalldata = json_encode($data1);  
		  				print_r($getalldata);

					}
		  		

		 }


    }



    public function JournalAccEntry($compCode,$fisYear,$transcode,$seriescode,$NewVrno,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$net_amt,$particular,$createdBy){

		$AcledgerH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
		$AledgID = json_decode(json_encode($AcledgerH), true); 
		if(empty($AledgID[0]['ACCTRANID'])){
			$Aledg_Id = 1;
		}else{
			$Aledg_Id = $AledgID[0]['ACCTRANID']+1;
		}

		$data_led = array(	
			'ACCTRANID'   =>$Aledg_Id,
			'COMP_CODE'   =>$compCode,
			'FY_CODE'     =>$fisYear,
			'TRAN_CODE'   =>$transcode,
			'SERIES_CODE' =>$seriescode,
			'VRNO'        =>$NewVrno,
			'SLNO'        =>$srno,
			'VRDATE'      =>$pay_vr_date,
			'PFCT_CODE'   =>$pfctcode,
			'ACC_CODE'    =>$transport_code,
			'ACC_NAME'    =>$transport_name,
			'DRAMT'       =>'',
			'CRAMT'       =>$net_amt,
			'PARTICULAR'  =>$particular,
			'CREATED_BY'  =>$createdBy,
			
    	);
		$saveDataLEGD = DB::table('ACC_TRAN')->insert($data_led);

		$getdata = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('ACC_CODE', $transport_code)->get()->first();

			if($getdata){

				$RDRAMT    = $getdata->RDRAMT;
				$RCRAMT    = $getdata->RCRAMT;
				$YROPDR    = $getdata->YROPDR;
				$YROPCR    = $getdata->YROPCR;
				$debitAmt  =  '';
				$creditAmt =  $net_amt + $RCRAMT;

			    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);

	            $dataarqty = array(
					'RDRAMT'  => $debitAmt,
					'RCRAMT'  => $creditAmt,
					'RBAL'    => $RBAL,
	            );

         		$updateData12 = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('ACC_CODE', $transport_code)->update($dataarqty);

			}else{

				$dataItmBal = array(
					'COMP_CODE' => $compCode,
					'FY_CODE'   => $fisYear,
					'PFCT_CODE' => $pfctcode,
					'ACC_CODE'  => $transport_code,
					'RDRAMT'    => '',
					'RCRAMT'    => $net_amt,
				);

				DB::table('MASTER_ACCBAL')->insert($dataItmBal);
			}

	}



	public function JournalGlLegEntry($compCode,$fisYear,$transcode,$seriescode,$glCode,$glName,$NewVrno,$srno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$net_amt,$particular,$createdBy){

		$getdata = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('GL_CODE', $glCode)->get()->first();

			if($getdata){

				$RDRAMT = $getdata->RDRAMT;
			    $RCRAMT = $getdata->RCRAMT;
			    $YROPDR = $getdata->YROPDR;
			    $YROPCR = $getdata->YROPCR;

			    $debitAmt  =  $net_amt + $RDRAMT;
				$creditAmt =  '';

			    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);
			  
	            $dataarqty = array(
	            	
					'RDRAMT'  => $debitAmt,
					'RCRAMT'  => $creditAmt,
					'RBAL'    => $RBAL,
			
	            );

         		$updateData12 = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('GL_CODE', $glCode)->update($dataarqty);

			}else{

				$dataItmBal = array(
					'COMP_CODE' => $compCode,
					'FY_CODE'   => $fisYear,
					'PFCT_CODE' => $pfctcode,
					'GL_CODE'   => $glCode,
					'RDRAMT'    => $net_amt,
					'RCRAMT'    => '',
				);

				DB::table('MASTER_GLBAL')->insert($dataItmBal);
			}

			$gledgH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
			$gledgID = json_decode(json_encode($gledgH), true); 
			if(empty($gledgID[0]['GLTRANID'])){
				$gledg_Id = 1;
			}else{
				$gledg_Id = $gledgID[0]['GLTRANID']+1;
			}

			$data_gl = array(	
				'GLTRANID'    =>$gledg_Id,
				'COMP_CODE'   =>$compCode,
				'FY_CODE'     =>$fisYear,
				'TRAN_CODE'   =>$transcode,
				'SERIES_CODE' =>$seriescode,
				'VRNO'        =>$NewVrno,
				'SLNO'        =>$srno,
				'VRDATE'      =>$pay_vr_date,
				'PFCT_CODE'   =>$pfctcode,
				'GL_CODE'     =>$glCode,
				'GL_NAME'     =>$glName,
				'DRAMT'       =>$net_amt,
				'CRAMT'       =>'',
				'PARTICULAR'  =>$particular,
				'CREATED_BY'  =>$createdBy
	    	);
	    	DB::table('GL_TRAN')->insert($data_gl);

	}


	

   


    public function GeneratePdfForTransportBill($uniqNo,$headId,$vrno,$tCode,$compCode,$accCode){

		$response_array = array();


		$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

		$compDetail =  DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$compCode'");

		$headtable = 'JV_TRAN';

		$dataheadB = DB::SELECT("SELECT t1.*,t2.*,'$headtable' as tableName FROM $headtable t1  WHERE t1.$columnheadid='$tripid'");

		$data = DB::table('JV_TRAN')
				->where('COMP_CODE',$compCode)
				->where('FY_CODE',$macc_year)
				->where('SERIES_CODE','JB02')
				->orderBy('VRDATE','ASC')
				->get();

		//print_r($dataheadB);exit;
		/*$amt = [];
		foreach($expDetail as  $key){

			$amt[] += $key->AMOUNT;
		}*/

		//print_r($amt);exit;

		header('Content-Type: application/pdf');
     
    	$pdf = PDF::loadView('admin.finance.transaction.logistic.trip_expense_pdf',compact('dataheadB','dataAccDetail','pumpDetail','expDetail','compDetail','vrNoPname'));

    	$path = public_path('dist/downloadpdf'); 
    	$fileName =  time().'.'. 'pdf' ; 
    	$pdf->save($path . '/' . $fileName);
    	$PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['data'] = $dataheadB;
        echo $data = json_encode($response_array);

		

		//$this->ConvertAmountIntoWord($dataheadB,,$dataAccDetail,$compDetail,$vrNoPname);

	}

    public function FleetRate(Request $request){

    	
	    if ($request->ajax()) {

    	$depot_code = $request->DEPOT_PLANT;
    	$loadType = $request->loadType;
    	$area_code = $request->DESTINATION;


	    	if($loadType=='Y'){

			    $date = date("Y-m-d");
				$data =DB::select("SELECT RATE FROM `MASTER_FREIGHT_RATE` where DEPOT_PLANT='$depot_code' AND AREA_CODE='$area_code' and TO_DATE<='$date'  ");

				foreach ($data as $key) {
					# code...
					print_r(json_encode($key));
				}

			}else{

				
			}
	  
			
			

   		 }


}



public function EditFleetForm(Request $request,$id){

    	$title = 'Edit Fleet Transaction';

    	//print_r($id);
    	$id = base64_decode($id);

    	$compName = $request->session()->get('company_name');

        $fisYear =  $request->session()->get('macc_year');



    	if($id!=''){
    	    $query = DB::table('FLEET_TRAN');
			$query->where('FLEETTRANID', $id);
			$userData['fleet_trans'] = $query->get()->first();

			$userData['acc_list']     = DB::table('MASTER_ACC')->get();

			$userData['depot_list']   = DB::table('MASTER_DEPOT')->get();

			$userData['area_list']    = DB::table('MASTER_AREA')->get();

			$userData['acctype_list'] = DB::table('MASTER_ACCTYPE')->get();

			$userData['item_list']    = DB::table('MASTER_ITEM')->get();
			$userData['bank_list']    = DB::table('MASTER_HOUSEBANK')->get();

			$userData['truck_list']   = DB::table('MASTER_FLEET')->get();

			$userData['tran_exp_list']    = DB::table('FLEET_TRAN_EXP')->where('FLEETTRANID', $id)->get();

			$userData['tran_pmt_list']    = DB::table('FLEET_TRAN_PMT')->where('FLEETTRANID', $id)->get();


			/*echo "<pre>";*/
			//print_r($userData['acc_list']);exit;
			/*print_r($userData['fleet_trans']);exit;*/
			
			return view('admin.finance.transaction.logistic.fleet_trans_list', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Depot-Id Not Found...!');
			return redirect('/form-mast-depot');
		}

    }
    public function FleetTransUpdate(Request $request){

		$fleetId = $request->input('fleet_id');

		$trdate = $request->input('date');
		$Transaction_date = date("Y-m-d", strtotime($trdate));

    	$validate = $this->validate($request, [

			'date'        => 'required',
			'dept_code'   => 'required',
			'invoice_no'  => 'required',
			'shipment_no' => 'required',
			'acct_code'   => 'required',
			'area_code'   => 'required',
			'lr_no'       => 'required',
			'trans_code'  => 'required',
			'truck_no'    => 'required',
			'material'    => 'required',
			'sto_qty_um'  => 'required',
			'sto_qty_aum' => 'required',
			'overload'    => 'required',
			
			
		]);

		$createdBy = $request->session()->get('userid');
		
		$comapny   = $request->session()->get('company_name');
		$slipcode  = explode('-', $comapny);
		$compName  = $slipcode[0];
		$fisYear   =  $request->session()->get('macc_year');
		$itemcode  = $request->input('material');
		$itemCode  = explode('-', $itemcode);
		$item_code = $itemCode[0];
		$indicator = $request->input('indicator');

		$FilterArray = array_filter($indicator);
		
		$count       = count($FilterArray);


		$gl_code         = $request->input('gl_code');
		$Amt             = $request->input('Amt');
		$bank_code       = $request->input('bank_code');
		$FilterArrayCode = array_filter($bank_code);
		$bankcount       = count($FilterArrayCode);
		$bank_name       = $request->input('bank_name');
		$bankAmt         = $request->input('bankAmt');

		$loadAvg         = $request->input('loadAvg');
		$emptyAvg        = $request->input('emptyAvg');
		$loadcpct        = $request->input('loadcpct');
		$model           = $request->input('model');
    	/*$diselexp = $request->input('Disel');

    	if($diselexp!=''){ 
    		$diselexp;
    	}else{ 
    		$diselexp ='';
    	}

    	$diselslipno = $request->input('deisel_slip_no');
    	if($diselslipno!=''){
    		$diselslipno;
    	}else{
    		$diselslipno='';
    	}

    	$drvexp = $request->input('drv_exp');
    	if($drvexp!=''){
    		$drvexp;
    	}else{
    		$drvexp='';
    	}

    	$foodinfexp = $request->input('fooding');
    	if($foodinfexp!=''){
    		$foodinfexp;
    	}else{
    		$foodinfexp='';
    	}

    	$adminexp = $request->input('p_exp');
    	if($adminexp!=''){
    		$adminexp;
    	}else{
    		$adminexp='';
    	}

    	$uloding = $request->input('lu_exp');
    	if($uloding!=''){
    		$uloding;
    	}else{
    		$uloding='';
    	}

    	$tollexp = $request->input('toll');
    	if($tollexp!=''){
    		$tollexp;
    	}else{
    		$tollexp='';
    	}

    	$otherexp = $request->input('other_exp');
    	if($otherexp!=''){
    		$otherexp;
    	}else{
    		$otherexp='';
    	}

    	$totaladv = $request->input('total_adv');
    	if($totaladv!=''){
    		$totaladv;
    	}else{
    		$totaladv='';
    	}

    	$dieselcr = $request->input('DIESEL_CR');
    	if($dieselcr!=''){
    		$dieselcr;
    	}else{
    		$dieselcr='';
    	}

    	$meterreding = $request->input('METER_READING');
    	if($meterreding!=''){
    		$meterreding;
    	}else{
    		$meterreding='';
    	}

    	$deselQty = $request->input('diesel_qty');
    	if($deselQty!=''){
    		$deselQty;
    	}else{
    		$deselQty='';
    	}*/

		$depot_code   = $request->input('dept_code');
		$account_code = $request->input('acct_code');
		$area_code    = $request->input('area_code');
		$item_code    = $item_code;
		$trpt_code    = $request->input('trans_code');
		$fleettransId = $request->input('fleettransId');
		$fleetpmtId   = $request->input('fleetpmtId');


		$data = array(
			"FLEETTRANID"	 => $fleetId,
			"COMP_CODE"      => $compName,
			"FY_CODE"        => $fisYear,
			"TR_DATE"        => $Transaction_date,
			"DEPOT_CODE"     => $request->input('dept_code'),
			"INVOICE_NO"     => $request->input('invoice_no'),
			"SHIPMENT_NO"    => $request->input('shipment_no'),
			"ACC_CODE"       => $request->input('acct_code'),
			"AREA_CODE"      => $request->input('area_code'),
			"LR_NO"          => $request->input('lr_no'),
			"TRPT_CODE"      => $request->input('trans_code'),
			"TRUCK_NO"       => $request->input('truck_no'),
			"VEHICLE_TYPE"   => $request->input('vehicle_type'),
			"DRIVER_NAME"    => $request->input('driver_name'),
			"ITEM_CODE"      => $item_code,
			"QTY"            => $request->input('sto_qty_um'),
			"AQTY"           => $request->input('sto_qty_aum'),
			"UM"             => $request->input('stoUM'),
			"AUM"            => $request->input('stoAum'),
			"OVERLOAD"       => $request->input('overload'),
			"RATE"           => $request->input('rate'),
			"LOAD_AVERAGE"  => $request->input('loadAvg'),
			"EMPTY_AVERAGE" => $request->input('emptyAvg'),
			"LOAD_CAPACITY" => $request->input('loadcpct'),
			"MODEL"         => $request->input('model'),
			/*"DRIVER_EXP"     => $drvexp,
			"FOODING_EXP"    => $foodinfexp,
			"ADMIN_EXP"      => $adminexp,
			"ULOADING_EXP"   => $uloding,
			"TOLL_EXP"       => $tollexp,
			"DIESEL_EXP"     => $diselexp,
			"OTHER_EXP"      => $otherexp,
			"TOTAL_ADV"      => $totaladv,
			"DIESEL_CR"      => $dieselcr,
			"DIESEL_SLIP_NO" => $diselslipno,
			"METER_READING"  => $meterreding,
			"DIESEL_QTY"     => $deselQty,*/
			"created_by"     => $createdBy,
			
		);

		$saveData = DB::table('FLEET_TRAN')->where('FLEETTRANID',$fleetId)->update($data);

		DB::table('FLEET_TRAN_EXP')->where('FLEETTRANID',$fleetId)->delete();

		for ($i=0; $i < $count; $i++) { 


			$fLeetH1 = DB::select("SELECT MAX(FLEETTRANEXPID) as FLEETTRANEXPID FROM FLEET_TRAN_EXP");
		    $expID = json_decode(json_encode($fLeetH1), true); 
		  
		    if(empty($expID[0]['FLEETTRANEXPID'])){
		      $exp_Id = 1;
		    }else{
		      $exp_Id = $expID[0]['FLEETTRANEXPID']+1;
		    }

			$data1 = array(
			"FLEETTRANEXPID" => $exp_Id,
			"FLEETTRANID"    => $fleetId,
			"COMP_CODE"      => $compName,
			"FY_CODE"        => $fisYear,
			"INDICATOR"      => $indicator[$i],
			"GL_CODE"        => $gl_code[$i],
			"AMOUNT"         => $Amt[$i],
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData1 = DB::table('FLEET_TRAN_EXP')->insert($data1);

		}


		

		for ($j=0; $j < $bankcount; $j++) {

			$data2 = array(

			"FLEETTRANPMTID" => $fleetpmtId,
			"FLEETTRANID"    => $fleetId,
			"COMP_CODE"      => $compName,
			"FY_CODE"        => $fisYear,
			"BANK_CODE"      => $bank_code[$j],
			"BANK_NAME"      => $bank_name[$j],
			"PAYMENT"        => $bankAmt[$j],
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData2 = DB::table('FLEET_TRAN_PMT')->where('FLEETTRANID',$fleetId)->where('FLEETTRANPMTID',$fleetpmtId)->update($data2);

		}
		if($saveData || $saveData1 || $saveData2){

			$request->session()->flash('alert-success', 'Fleet Transaction Was Successfully Added...!');
			return redirect('/logistic/view-fleet-transaction');

		} else {

			$request->session()->flash('alert-error', 'Fleet Transaction Can Not Added...!');
			return redirect('/logistic/view-fleet-transaction');
		}
    	
    	
    	

    }

    public function DeleteFleetTrans(Request $request){

    	$id = $request->post('FleetId');
    	//print_r($destinationId);exit;

    	if ($id!='') {

    		$fleet_tran = DB::table('fleet_trans')->where('id',$id)->get()->first();

			$fleet_depot_code = DB::table('fleet_trans')->where('DEPOT_CODE',$fleet_tran->DEPOT_CODE)->get()->toArray();
			
			$fleet_area_code = DB::table('fleet_trans')->where('AREA_CODE',$fleet_tran->AREA_CODE)->get()->toArray();
			
			$fleet_acc_code = DB::table('fleet_trans')->where('ACC_CODE',$fleet_tran->ACC_CODE)->get()->toArray();
			
			$fleet_item_code = DB::table('fleet_trans')->where('ITEM_CODE',$fleet_tran->ITEM_CODE)->get()->toArray();
			
			$fleet_trpt_code = DB::table('fleet_trans')->where('TRPT_CODE',$fleet_tran->TRPT_CODE)->get()->toArray();



        	$count =count($fleet_depot_code);

        	if($count >1){
        		$Delete = DB::table('fleet_trans')->where('id', $id)->delete();

        	}else{
        		$Delete = DB::table('fleet_trans')->where('id', $id)->delete();

        		$data=array(

        			'fleet_trans'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$fleet_tran->DEPOT_CODE)->update($data);
        	
        	}

        	$area_code_count= count($fleet_area_code);

        	if($area_code_count >1){
        		$Delete1 = DB::table('fleet_trans')->where('id', $id)->delete();

        	}else{
        		$Delete1 = DB::table('fleet_trans')->where('id', $id)->delete();

        		$data=array(

        			'fleet_trans'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$fleet_tran->AREA_CODE)->update($data);
        	
        	}


        	$fleet_acc_count = count($fleet_acc_code);

        	if($fleet_acc_count >1){
        		$Delete2 = DB::table('fleet_trans')->where('id', $id)->delete();

        	}else{
        		$Delete2 = DB::table('fleet_trans')->where('id', $id)->delete();

        		$data=array(

        			'fleet_trans'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$fleet_tran->ACC_CODE)->update($data);
        	
        	}

        	
        	$fleet_item_count = count($fleet_item_code);

        	if($fleet_item_count >1){
        		$Delete3 = DB::table('fleet_trans')->where('id', $id)->delete();

        	}else{
        		$Delete3 = DB::table('fleet_trans')->where('id', $id)->delete();

        		$data=array(

        			'fleet_trans'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$fleet_tran->ITEM_CODE)->update($data);
        	
        	}

        	
        	$fleet_trpt_count = count($fleet_trpt_code);

        	if($fleet_trpt_count >1){
        		$Delete4 = DB::table('fleet_trans')->where('id', $id)->delete();

        	}else{
        		$Delete4 = DB::table('fleet_trans')->where('id', $id)->delete();

        		$data=array(

        			'fleet_trans'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$fleet_tran->TRPT_CODE)->update($data);
        	
        	}



			if($Delete  &&  empty($Delete1) && empty($Delete2) && empty($Delete3) && empty($Delete4) || $Delete1  &&  empty($Delete) && empty($Delete2) && empty($Delete3) && empty($Delete4)|| $Delete2 &&  empty($Delete) && empty($Delete1) && empty($Delete3) && empty($Delete4) || $Delete3 &&  empty($Delete) && empty($Delete1) && empty($Delete2) && empty($Delete4) || $Delete4 &&  empty($Delete) && empty($Delete1) && empty($Delete2) && empty($Delete3)){

			$request->session()->flash('alert-success', 'Fleet Transaction Was Deleted Successfully...!');
				return redirect('/logistic/view-fleet-transaction');

			} else {

			$request->session()->flash('alert-error', 'Fleet Transaction Can Not Deleted...!');
				return redirect('/logistic/view-fleet-transaction');

			}
    	

    	}else{

    		$request->session()->flash('alert-error', 'Fleet Transaction Not Found...!');
			return redirect('/logistic/view-fleet-transaction');

    	}
    }


  /*submit part bill*/

    


    


    public function UpdateChallanReceipt(Request $request){

		$fleetId = $request->input('fleet_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");


		$lastUpdatedBy = $request->session()->get('userid');

    	$createdBy = $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	      $developmentMode = true;
        		$mailer = new PHPMailer($developmentMode);

    	    	$AccCode =  $request->input('acct_code');

    	    	$getemail = DB::select("SELECT * FROM `master_acc` WHERE acc_code='$AccCode'");
    	    	foreach ($getemail as $row) {
    	    		$accEmailId = $row->email_id;
    	    		$transName = $row->acc_name;
    	    	}

        		$areaCode = $request->input('area_code');

        		$getemail = DB::select("SELECT * FROM `master_area` WHERE code='$areaCode'");
        		foreach ($getemail as $rowar) {
        			$areaName = $rowar->name;
        		}
                
                $vehicle_num = $request->input('vehicle_no');
                $despatch_qty = $request->input('despatch_qty');
                $invoic_num = $request->input('invoice_no');

                $mailer->SMTPDebug = 0;
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


                $mailer->Host = 'localhost';
                $mailer->SMTPAuth = false;
                $mailer->Username = 'kamini.khapre@aceworth.in';
                $mailer->Password = 'Kaminikhapre';
                $mailer->CharSet = 'iso-8859-1'; 
                $mailer->Port = 25;
                $mailer->WordWrap = TRUE;

                $mailer->setFrom('kamini.khapre@aceworth.in', 'Aceworth Private Limitate');
                $mailer->addAddress($accEmailId, 'Aceworth Private Limitate');
                $mailer->addReplyTo('kamini.khapre@aceworth.in.in', 'Aceworth Private Limitate');

                $mailer->isHTML(true);
                $mailer->Subject = 'Fleet Challan Receipt';

                

		$data = array(
			"comp_name"         => $compName,
			"fiscal_year"       => $fisYear,
			"RECEIVED_QTY"      => $request->input('recvd_qty'),
			"RECEIVED_UM"       => $request->input('recivdUm'),
			"RECEIVED_AQTY_AUM" => $request->input('aqty_recd'),
			"RECEIVED_AUM"      => $request->input('recivdAum'),
			"DAMAGE_QTY"        => $request->input('dmg_qty'),
			"SHORTAGE_QTY"      => $request->input('shortage_qty'),
			"STAMP"             => $request->input('Stamp'),
			"STAMP_CHARGES"     => $request->input('stamp_charge'),
			"ADDL_EXP"          => $request->input('addl_exp'),
			"ADDL_EXP_REMARK"   => $request->input('addl_exp_remark'),
			"FRIGHT_AMT"        => $request->input('fright_amt'),
			"SUB_TOTAL"         => $request->input('sub_total'),
			"SERVICE_AMT"       => $request->input('service_amt'),
			"SERVICE_CHARGES"   => $request->input('service_chrge'),
			"TDS_RATE"          => $request->input('tds_rate'),
			"TDS_AMT"           => $request->input('tds_amt'),
			"NET_PAYMENT"       => $request->input('net_payment'),
			"LR_REC_DATE"       => $request->input('LR_REC_DATE'),
			"last_updat_by"     => $lastUpdatedBy,
			"last_updat_date"   => $updatedDate,
			
		);

		$saveData = DB::table('fleet_trans')->where('id',$fleetId)->update($data);

		if ($saveData) {

			$getData = DB::table('fleet_trans')->where('id',$fleetId)->get()->first();

			/*echo '<pre>';
			print_r($getData);
			echo '</pre>';
			exit();*/

			$getArea = DB::table('master_area')->where('code',$getData->AREA_CODE)->get()->first();

			$getTrpt = DB::table('master_acc')->where('acc_code',$getData->ACC_CODE)->where('acctype_code',$getData->TRPT_CODE)->get()->first();

			

//print_r($getTrpt->acc_name);exit;
			/*$getPatyName = DB::table('master_acc')->where('acc_code',$getData->ACC_CODE)->where('acctype_code', '!=', 'T')->get()->first();*/

			/*$getPatyName = DB::select("SELECT * FROM master_acc WHERE acc_code='$getData->ACC_CODE' AND acctype_code!='T'")->toArray();*/




			$getPatyName = DB::table('master_acc')->where([
			['acc_code', '=', $getData->ACC_CODE],
			['acctype_code', '=', 'T'],
			])->get()->first();

			/*echo '<pre>';
			print_r($getPatyName->acc_name);
			echo '</pre>';
			exit();*/

			if($getPatyName){

				$AccName = $getPatyName->acc_name;

			}else{
				$AccName='';
				
			}
			


			$message = '<div style="padding-left: 13%;font-size: 16px;font-weight: 600;color: gray;">Fleet Challan Receipt</div><table id="OutwardTrans" style="border: 1px solid #a99999;border-radius: 5px;padding: 11px;border-top: 3px solid #3c8dbc;">
  <tbody><tr><td><b>Invoice Number</b></td><td><b>'.$getData->INVOICE_NO.'</b></td></tr><tr><td><b>Invoice Date</b></td><td><b>2020-12-05 06:11:08</b></td></tr><tr><td><b>Route</b></td><td><b>'.$getArea->code.'&nbsp;&nbsp;&nbsp;'.$getArea->name.'</b></td></tr><tr><td><b>Trip Id</b></td><td></td></tr><tr><td><b>Truck Number</b></td><td><b>'.$getData->TRUCK_NO.'</b></td></tr><tr><td><b>Transporter Name</b></td><td>'.$getTrpt->acc_name.'</td></tr><tr><td><b>Driver Name</b></td><td></td></tr><tr><td><b>Driver Contact Number(s)</b></td><td></td></tr><tr><td><b>Ship To Party</b></td><td>'.$AccName.'</td></tr><tr><td><b>Sold To Party</b></td><td>'.$AccName.'</td></tr><tr><td><b>Invoice Quantity</b></td><td>'.$getData->RECEIVED_QTY.' - '.$getData->RECEIVED_UM.' - '.$getData->RECEIVED_AQTY_AUM.'</td></tr></tbody></table>';

                $mailer->Body = $message;

                $mailSend = $mailer->send();
                $mailer->ClearAllRecipients();
			/*print_r($getData);exit;*/
		    if ($mailSend) {

				$request->session()->flash('alert-success', 'Fleet Transaction Was Successfully Updated...!');
				
				return redirect('/logistic/fleet-challan-receipt');

			} else {

				$request->session()->flash('alert-error', 'Fleet Transaction Not Updated...!');
				return redirect('/logistic/fleet-challan-receipt');

			}
		}else {

			$request->session()->flash('alert-error', 'Fleet Transaction Not Updated...!');
			return redirect('/logistic/fleet-challan-receipt');

		}
		

    }

/*submit part bill*/

  /*  manage party bill*/

  	   
  /*  manage party bill*/






    public function TrptPaymentAdvice(Request $request){

		if ($request->ajax()) {

			if (!empty($request->trans_code || $request->billNo)) {
		    	
			$transCode   = $request->input('trans_code');

			$billNo  = $request->input('billNo');

			$usertype 	= $request->session()->get('user_type');

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

	    	$userid       = $request->session()->get('userid');


			if(isset($transCode)  && trim($transCode)!="" && $usertype=='admin'){

				$strWhere=" AND party_bill.party= '$transCode'";
			}else if(isset($transCode)  && trim($transCode)!="" && ($usertype=='superAdmin' || $usertype=='user')){

				$strWhere=" AND party_bill.party= '$transCode' AND party_bill.comp_name='$company_name' AND party_bill.fiscal_year='$macc_year' AND fleet_trans.id='$userid'";
			}


			if(isset($billNo)  && trim($billNo)!="" && $usertype=='admin')
			{
				$strWhere=" AND party_bill.bill_no= '$billNo'";
			}else if(isset($billNo)  && trim($billNo)!="" && ($usertype=='superAdmin' || $usertype=='user'))
			{
				$strWhere=" AND party_bill.bill_no= '$billNo' AND party_bill.comp_name='$company_name' AND party_bill.fiscal_year='$macc_year' AND fleet_trans.id='$userid'";
			}

			$data = DB::select("SELECT * FROM party_bill where 1=1  $strWhere");

			//print_r($data);

			return DataTables()->of($data)->make(true);
				
		}else{

			

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');

			$userid       = $request->session()->get('userid');


			if($usertype=='admin'){

		    $strWhere="  AND party_bill.fiscal_year='$macc_year'";
		    }
		    else if($usertype=='superAdmin' || $usertype=='user'){
		    	
		    $strWhere="  AND party_bill.comp_name='$company_name' AND party_bill.fiscal_year='$macc_year' AND fleet_trans.id='$userid'";
			}

			$data = DB::select("SELECT *  FROM party_bill where 1=1 $strWhere");

			return DataTables()->of($data)->make(true);
		}

		}

		$title = 'TRPT Payment Advice';

    	$userdata['transpoter_list'] = DB::select("SELECT *,(SELECT acc_name FROM master_acc WHERE acc_code=fleet_trans.ACC_CODE) as accName FROM fleet_trans WHERE TRPT_CODE='T' GROUP BY ACC_CODE");

		
    	return view('admin.logistic.report.trpt_payment_advice',$userdata+compact('title'));


	}


	public function  TrptPayment(Request $request){


		if ($request->ajax()) {


			if (!empty($request->dept_code || $request->acct_code || $request->trans_code || $request->from_date)) {

				if(isset($request->from_date)  && trim($request->from_date)!=""){

					$strWhere = "fleet_trans.TR_DATE = '$request->from_date' ";
				}
				 
				
				if(isset($request->dept_code)  && trim($request->dept_code)!=""){

					$strWhere = "master_depot.depot_name = '$request->dept_code' ";
				}
					
				if(isset($request->acct_code)  && trim($request->acct_code)!=""){

					$strWhere = "master_area.name = '$request->acct_code' ";
				}
				
				if(isset($request->trans_code)  && trim($request->trans_code)!=""){

					$strWhere = "master_transporter.name = '$request->trans_code' ";
					 
				}

				$data = DB::select("SELECT fleet_trans.*, master_depot.depot_name AS DEPOT_PLANT, master_dealer.name As PARTY, master_area.name As DESTINATION, master_transporter.name as Transporter, master_fleet.truck_no FROM fleet_trans left JOIN master_depot ON master_depot.depot_code = fleet_trans.DEPOT_CODE left JOIN master_dealer ON master_dealer.code = fleet_trans.ACC_CODE left JOIN master_area on master_area.code = fleet_trans.AREA_CODE left JOIN master_transporter on master_transporter.code = fleet_trans.TRPT_CODE left JOIN master_fleet on master_fleet.truck_no = fleet_trans.TRUCK_NO WHERE $strWhere order by fleet_trans.id desc");

				return DataTables()->of($data)->make(true);

			}else{


				$company_name 	= $request->session()->get('company_name');

		    	$macc_year 		= $request->session()->get('macc_year');

				$usertype 	= $request->session()->get('user_type');
				

		        $comp_code = substr($company_name,0,4);

				$getdate = DB::table('master_fy')->where([
				['comp_code', '=', $comp_code],
				['fy_code', '=', $macc_year],
				])->first();

		        $fy_from_date = $getdate->fy_from_date;
		        $fy_to_date = $getdate->fy_to_date;

		        $Data['formDate']= $fy_from_date;
		        $Data['toDate']= $fy_to_date;

			    $from_date =$fy_from_date;
			    $to_date =$fy_to_date;

		    	$title = 'TRPT Payment';

				$user_list       = DB::table('master_depot')->get();
				
				$area_list       = DB::table('master_area')->get();

				$transpoter_list = DB::table('master_transporter')->get();



				$data = DB::select("SELECT fleet_trans.*, master_depot.depot_name AS DEPOT_PLANT, master_dealer.name As PARTY, master_area.name As DESTINATION, master_transporter.name as Transporter, master_fleet.truck_no FROM fleet_trans left JOIN master_depot ON master_depot.depot_code = fleet_trans.DEPOT_CODE left JOIN master_dealer ON master_dealer.code = fleet_trans.ACC_CODE left JOIN master_area on master_area.code = fleet_trans.AREA_CODE left JOIN master_transporter on master_transporter.code = fleet_trans.TRPT_CODE left JOIN master_fleet on master_fleet.truck_no = fleet_trans.TRUCK_NO order by fleet_trans.id desc");

				return DataTables()->of($data)->make(true);

			}

			
		}

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			

	        $comp_code = substr($company_name,0,4);

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

	    	$title = 'TRPT Payment';

			$user_list       = DB::table('master_depot')->get();
			
			$area_list       = DB::table('master_area')->get();

			$transpoter_list = DB::table('master_transporter')->get();

		
    	return view('admin.trpt_payment',compact('title','user_list','area_list','transpoter_list','from_date','to_date'));


		
	}


/*fleet transaction report*/
	public function FleetTransReport(Request $request){

		if ($request->ajax()) {

			if (!empty($request->TRUCK_NO || $request->dept_code || $request->trans_code || $request->from_date)) {

				$From_Date = $request->input('from_date');
				
				$To_Date   = $request->input('to_date');
			

		    	
			$depotCode    = $request->input('dept_code');
			
			$Truck_no     = $request->input('TRUCK_NO');
			
			$transCode    = $request->input('trans_code');
			
			$fromDate     = date("Y-m-d", strtotime($From_Date));
			
			$toDate       = date("Y-m-d", strtotime($To_Date));

			
			$usertype     = $request->session()->get('user_type');
			
			$company_name = $request->session()->get('company_name');
			
			$macc_year    = $request->session()->get('macc_year');

			$userid       = $request->session()->get('userid');


			if(isset($fromDate)  && trim($fromDate)!="")
	      	 {
	      	 	$strWhere=" AND `TR_DATE` BETWEEN '$fromDate' and  '$toDate'";
	      	 }
			
			if(isset($depotCode)  && trim($depotCode)!="" && $usertype=='admin'){

				$strWhere=" AND fleet_trans.DEPOT_CODE= '$depotCode' AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year='$macc_year'";

			}else if(isset($depotCode)  && trim($depotCode)!="" && ($usertype=='superAdmin' || $usertype=='user')){

				$strWhere=" AND fleet_trans.DEPOT_CODE= '$depotCode' AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year='$macc_year' AND fleet_trans.id='$userid'";
			}

			if(isset($transCode)  && trim($transCode)!="" && $usertype=='admin'){

				$strWhere=" AND fleet_trans.ACC_CODE= '$transCode' AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year='$macc_year'";
			}else if(isset($transCode)  && trim($transCode)!="" && ($usertype=='superAdmin' || $usertype=='user')){

				$strWhere=" AND fleet_trans.ACC_CODE= '$transCode' AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year='$macc_year' AND fleet_trans.id='$userid'";
			}


			if(isset($Truck_no)  && trim($Truck_no)!="" && $usertype=='admin')
			{
				$strWhere=" AND fleet_trans.TRUCK_NO= '$Truck_no' AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year='$macc_year'";
			}else if(isset($Truck_no)  && trim($Truck_no)!="" && ($usertype=='superAdmin' || $usertype=='user'))
			{
				$strWhere=" AND fleet_trans.TRUCK_NO= '$Truck_no' AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year='$macc_year' AND fleet_trans.id='$userid'";
			}

			$data = DB::select("SELECT *,(SELECT acc_name FROM master_acc WHERE acc_code=fleet_trans.ACC_CODE) as AccName, (SELECT name FROM master_area WHERE code=fleet_trans.AREA_CODE) as AreaName FROM fleet_trans where 1=1  $strWhere");

			//print_r($data);

			return DataTables()->of($data)->addIndexColumn()->make(true);
				
		}else{
			

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');

			$userid       = $request->session()->get('userid');

		    if($usertype=='admin'){

		    $strWhere="  AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year= '$macc_year'";
		    }
		    else if($usertype=='superAdmin' || $usertype=='user'){
		    	
		    $strWhere="  AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year='$macc_year' AND fleet_trans.id='$userid'";
			}

			$data = DB::select("SELECT *,(SELECT acc_name FROM master_acc WHERE acc_code=fleet_trans.ACC_CODE) as AccName, (SELECT name FROM master_area WHERE code=fleet_trans.AREA_CODE) as AreaName FROM fleet_trans where 1=1  $strWhere");

			return DataTables()->of($data)->addIndexColumn()->make(true);
		}

		}

		$company_name 	= $request->session()->get('company_name');

    	$macc_year 		= $request->session()->get('macc_year');

		$usertype 	= $request->session()->get('user_type');
		

        $comp_code = substr($company_name,0,4);

		$getdate = DB::table('master_fy')->where([
		['comp_code', '=', $comp_code],
		['fy_code', '=', $macc_year],
		])->first();

        $fy_from_date = $getdate->fy_from_date;
        $fy_to_date = $getdate->fy_to_date;

		$title = 'Fleet Transaction Report';

    	$depot_list = DB::table('master_depot')->where(['comp_name' => $company_name, 'fiscal_year' => $macc_year,'flag'=>0])->get();

    	
    	$transporter_list= DB::table('master_acc')->where(['comp_name' => $company_name, 'fiscal_year' => $macc_year,'acctype_code'=>'T'])->get();

		return view('admin.logistic.report.report_fleet_trans',compact('title','depot_list','transporter_list','fy_from_date','fy_to_date'));

	}

/*fleet transaction report*/



   public function PrinFletChalanRecept(Request $request,$id){

		$company_name = $request->session()->get('company_name');
		
		$macc_year    = $request->session()->get('macc_year');
		
		$usertype     = $request->session()->get('user_type');

		if($usertype == 'admin'){

			$userdata['fleetdata'] = DB::select("SELECT * FROM `fleet_trans` WHERE id='$id'");

		}else if($usertype=='superAdmin' || $usertype=='user'){

			$userdata['fleetdata'] = DB::select("SELECT * FROM `fleet_trans` WHERE id='$id' AND comp_name='$company_name' AND fiscal_year='$macc_year'");

		}else{
			$userdata['fleetdata'] ='';
		}

		$title = 'Print Fleet Challan Receipt';

		return view('admin.logistic.report.print_fleet_chalan_recept',$userdata+compact('title'));
      			
		

    }

    public function SendMailForPartyBil($party){
		
		$accountCode = base64_decode($party);

		$userdata = DB::table('master_acc')->where('acc_code',$accountCode)->get()->first();

		 $emialId = $userdata->email_id;

		$partydata = DB::table('party_bill')->where('party',$accountCode)->where('email_flag','NO')->get()->toArray();

		$getbyAccCode = json_decode( json_encode($partydata), true);

		$developmentMode = true;
        $mailer = new PHPMailer($developmentMode);

        $mailer->SMTPDebug = 0;
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


        $mailer->Host = 'localhost';
        $mailer->SMTPAuth = false;
        $mailer->Username = 'kamini.khapre@aceworth.in';
        $mailer->Password = 'Kaminikhapre';
        $mailer->CharSet = 'iso-8859-1'; 
        $mailer->Port = 25;
        $mailer->WordWrap = TRUE;

        $mailer->setFrom('kamini.khapre@aceworth.in', 'Aceworth Private Limitate');
        $mailer->addAddress($emialId, 'Aceworth Private Limitate');
        $mailer->addReplyTo('kamini.khapre@aceworth.in.in', 'Aceworth Private Limitate');

        $mailer->isHTML(true);
        $mailer->Subject = 'Party Bill Generate';

        $message = '<div style="padding-left: 13%;font-size: 16px;font-weight: 600;color: gray;">Party Bill Generate</div><table id="OutwardTrans" style="border: 1px solid #a99999;border-radius: 5px;border-top: 3px solid #3c8dbc;border-collapse: collapse;"><thead><th style="border:1px solid #e6d7d7;">L R No</th><th style="border:1px solid #e6d7d7;">Depot Plant</th><th style="border:1px solid #e6d7d7;">Invoice Number</th><th style="border:1px solid #e6d7d7;">Party</th></thead><tbody>';

        foreach ($getbyAccCode as $row) {
        	$message .= '<tr><td style="border:1px solid #e6d7d7;text-align:right;">'.$row['L_R_NO'].'</td><td style="border:1px solid #e6d7d7;text-align:right;">'.$row['DEPOT_PLANT'].'</td><td style="border:1px solid #e6d7d7;text-align:right;">'.$row['INVOICE_NO'].'</td><td style="border:1px solid #e6d7d7;">'.$row['party'].'</td></tr>';

        }

        $message .= '</tbody></table>';

        $mailer->Body = $message;

        $mailSend = $mailer->send();
        $mailer->ClearAllRecipients();

        if($mailSend){

        	$data1 = array(
        			'email_flag' => 'YES'
        		);

        	$UpdateParty = DB::table('party_bill')->where('party',$accountCode)->where('email_flag','NO')->update($data1);

        	if($UpdateParty){
        		return redirect('logistic/trpt-bill-generate');
        	}else{
        		return redirect('logistic/trpt-bill-generate');
        	}

	    }else{

	        return redirect('logistic/trpt-bill-generate');

	    }



    }

    public function FleetCertTrans(Request $request){

    	return view('admin.logistic.transaction.fleet_cert_transaction');

    }	

   

    

   public function FleetCertTransFormSave_old(Request $request){

   		$compName 	= $request->session()->get('company_name');

		$fisYear 	=  $request->session()->get('macc_year');

   		$code = $request->input('cert_code');
   		$truckno = $request->input('truck_no');

   	$results = DB::table('fleet_certificate_trans')->where('comp_name',$compName)->where('fiscal_year',$fisYear)->where('truck_no',$truckno)->where('certificate_code',$code)->get();

	    if(empty($results))
	    {

				$validate = $this->validate($request, [

				'truck_no'  => 'required',
				'cert_code' => 'required',
				//'employee' => 'required|in:'.$employee->implode('id', ', '),
				'cert_no'   => 'required|unique:fleet_certificate_trans,certificate_no',
				'cert_date' => 'required',
				'cert_rnew' => 'required',

			]);



		    $createdBy 	= $request->session()->get('userid');

		    	
			$data = array(
				"comp_name"         => $compName,
				"fiscal_year"       => $fisYear,
				"truck_no"          => $request->input('truck_no'),
				"certificate_code"  => $request->input('cert_code'),
				"certificate_no"    => $request->input('cert_no'),
				"certificate_date"  => $request->input('cert_date'),
				"certificate_renew" => $request->input('cert_rnew'),
				"created_by"        => $createdBy,
				
			);

			$saveData = DB::table('fleet_certificate_trans')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Fleet Certificate  Was Successfully Added...!');
				return redirect('/logistic/fleet-certificate-transaction-form');

			} else {

				$request->session()->flash('alert-error', 'Fleet Certificate Can Not Added...!');
				return redirect('/logistic/fleet-certificate-transaction-form');

			}

	    }
	    else
	    {
	        
	        $request->session()->flash('alert-error', 'Certificate already exist for this truck number...!');
			return redirect('/logistic/fleet-certificate-transaction-form');
	    }

   
   }

  public function FleetCertTransFormView(Request $request){
  		//print_r($request->vehicle_no);exit;

  		$vehicle_no = $request->vehicle_no;

  	   $getData = DB::table('fleet_certificate_trans')->where('truck_no',$vehicle_no)->get()->toArray();

  	   $vehicleData = json_decode( json_encode($getData), true);
  	   
  	 //  print_r($vehicleData);exit;

  	 return view('admin.logistic.transaction.fleet_cert_transaction_viewform',compact('vehicleData'));
  	   

  }

  public function FleetCertTransFormUpdate(Request $request){

  		 $id = $request->fleetId;
  		 $renewdate = $request->renewdt;

  		 //print_r($renewdate);

         $certrenewdate = date("Y-m-d", strtotime($renewdate));

    // print_r($certrenewdate);exit;

  		date_default_timezone_set('Asia/Kolkata');
  		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

  		 $data = array(
			"comp_name"         => $compName,
			"fiscal_year"       => $fisYear,
			"cert_renew_date"   => $certrenewdate,
			"last_updated_by"   => $lastUpdatedBy,
			"last_updated_date" => $updatedDate,			
		);

		$saveData = DB::table('fleet_certificate_trans')->where('id',$id)->update($data);

		$data1=array();
		if ($saveData) 
		{

			$data1['message'] = 'Success';
			$data1['id'] = $id;

			$getalldata = json_encode($data1);  
			print_r($getalldata);

	   } else{

		$data1['message'] = 'Error';
			$getalldata = json_encode($data1);  
			print_r($getalldata);

	    }


  }


  public function FleetCertTransReport(Request $request){


    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){

    		$data = DB::table('fleet_certificate_trans')->where('created_by',$userid)->whereNotNull('cert_renew_date')->get();
    	
    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 	$data = DB::table('fleet_certificate_trans')->where('created_by',$userid)->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->whereNotNull('cert_renew_date')->get();

    	}else{

    		$data ='';
    	}


    	$array1 = json_decode( json_encode($data), true);
    
    	$title = 'View Outward Transaction';


    	$due_date =[];
    	$i = 1;
    	foreach ($array1 as $key => $row) {

    		$i++;
    		$due_date[$key]['demo_key_'.$i] = $row['certificate_renew'];

    	}
    
    	DB::table('fleet_certificate_report')->truncate();

		$uniques = [];
    	foreach ($array1 as $key) {

	 		$tr_no= $key['truck_no'];

			if (!in_array($key['truck_no'],$uniques)) {

				$uniques[] = $key['truck_no'];

				if($user_type == 'admin'){
				
					$data00 = DB::table('fleet_certificate_trans')->where('truck_no',$key['truck_no'])->where('created_by',$userid)->whereNotNull('cert_renew_date')->get()->toArray();

				}else if($user_type == 'superAdmin' || $user_type == 'user'){

					$data00 = DB::table('fleet_certificate_trans')->where('truck_no',$key['truck_no'])->where('created_by',$userid)->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->whereNotNull('cert_renew_date')->get()->toArray();


				}else{

					$data00 = array();
				}

				$array12 = json_decode( json_encode($data00), true);

				foreach ($array12 as $value0) {

					if ($value0['certificate_code'] == 'CF') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_cf" 		=> $value0['certificate_code'],	
								"due_date_cf" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"cert_code_cf" 		=> $value0['certificate_code'],	
								"due_date_cf" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}


					if ($value0['certificate_code'] == 'S-Permit') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_spermit" 		=> $value0['certificate_code'],	
								"due_date_spermit" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_spermit" 		=> $value0['certificate_code'],	
								"due_date_spermit" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}

					if ($value0['certificate_code'] == 'N-Permit') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_npermit" 		=> $value0['certificate_code'],	
								"due_date_npermit" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_npermit" 		=> $value0['certificate_code'],	
								"due_date_npermit" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}	


					if ($value0['certificate_code'] == 'RTO') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_rto" 		=> $value0['certificate_code'],	
								"due_date_rto" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_rto" 		=> $value0['certificate_code'],	
								"due_date_rto" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}	


					if ($value0['certificate_code'] == 'Danta') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_danta" 		=> $value0['certificate_code'],	
								"due_date_danta" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_danta" 		=> $value0['certificate_code'],	
								"due_date_danta" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}	

					if ($value0['certificate_code'] == 'Insurance') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_insurance" 		=> $value0['certificate_code'],	
								"due_date_insurance" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_insurance" 		=> $value0['certificate_code'],	
								"due_date_insurance" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}	

					if ($value0['certificate_code'] == 'Pollution') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_puc" 		=> $value0['certificate_code'],	
								"due_date_puc" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_puc" 		=> $value0['certificate_code'],	
								"due_date_puc" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}	

				    
				}

				
				
			}
    	 	
    	}
    	
    	
    	$saveData01 = DB::table('fleet_certificate_report')->get()->toArray();

    	$array10['fetchdata'] = json_decode( json_encode($saveData01), true);

    	return view('admin.logistic.report.fleet_cert_transaction_report',$array10+compact('title'));

    }

    
    
    public function FleetCertReport(Request $request){

		if ($request->ajax()) {

			
			if (!empty($request->truck_no || $request->from_date)) {
		    

			$Truck_no  = $request->truck_no;
			//print_r($Truck_no);exit;

			$fromDate  = $request->from_date;

			$toDate  = $request->to_date;

			$usertype 	= $request->session()->get('user_type');

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');


			if(isset($fromDate)  && trim($fromDate)!="")
	      	 {
	      		$strWhere=" AND `TR_DATE` BETWEEN '$fromDate' and  '$toDate'";
	      	}
			
			if(isset($Truck_no)  && trim($Truck_no)!="" && $usertype=='admin')
			{
				$strWhere=" AND fleet_certificate_report.truck_no= '$Truck_no'";
			}else if(isset($Truck_no)  && trim($Truck_no)!="" && ($usertype=='superAdmin' || $usertype=='user'))
			{
				$strWhere=" AND fleet_trans.TRUCK_NO= '$Truck_no' AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year='$macc_year'";
			}

			$data = DB::select("SELECT * FROM fleet_certificate_report where 1=1  $strWhere");

			
			
			return DataTables()->of($data)->addIndexColumn()->make(true);
				
		}else{
			

			
		}

		}

		$title = 'Fleet Transaction Report';

    	$depot_list = DB::table('master_depot')->get();

    	 $transporter_list= DB::table('master_acc')->where('acctype_code','T')->get();

		return view('admin.logistic.report.report_fleet_trans',compact('title','depot_list','transporter_list'));

	}

	// 
	public function SuccessMessage(Request $request,$getName){
       $transName = base64_decode($getName);
       print_r($transName);
       $userid    = $request->session()->get('userid');

       if($transName == 'FleetCertTran')
       {
       	  	$request->session()->flash('alert-success', 'Fleet Certificate Transaction is Successfully Saved...!');

			return redirect('/logistic/view-fleet-certificate-transaction');
       } 
        if($transName == 'LRAckPenalty')
       {
       	  	$request->session()->flash('alert-success', 'LR Acknowledgement Penalty is Successfully Saved...!');

			return redirect('/logistic-transportation/master/view-lr-acknowledgement-penalty');
       }

       if($transName == 'SUCCESSPOD')
       {
       	  	$request->session()->flash('alert-success', 'ePOD Tran Was Successfully Added...!');
			return redirect('/view-ePOD-transaction');
       }
    }

    /*ePOD Tran*/

    public function ePODForm(Request $request){

		$title         = 'Add ePOD';
		$fisYear       =  $request->session()->get('macc_year');
		$CompanyCode   =  $request->session()->get('company_name');
		$getcompcode   = explode('-', $CompanyCode);
		$comp_code     = $getcompcode[0];

		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();
		
		$userdata['vehicle_list']    = DB::table('MASTER_FLEET')->get();
		
		$userdata['inward_list']     = DB::table('MASTER_INWARD_SLIP')->get();
		
		$userdata['transport_list']  = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		
		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();
		
		$userdata['getacc']          = DB::table('MASTER_ACC')->get();
		
		$userdata['series_list']     = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'T3'])->get();
		
		$userdata['tax_code_list']   = DB::table('MASTER_TAXRATE')->groupBy('TAX_CODE')->get();
		
		$userdata['dept_list']       = DB::table('MASTER_DEPT')->get();
		$userdata['plant_list']      = DB::table('MASTER_PLANT')->get();
		$userdata['pfct_list']       = DB::table('MASTER_PFCT')->get();
		
		$userdata['bank_list']       = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']       = DB::table('MASTER_COST')->get();
		$userdata['emp_list']        = DB::table('MASTER_EMP')->get();
		
		$userdata['item_list']       = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']       = DB::table('MASTER_RATE_VALUE')->get();
		
		$userdata['area_list']       = DB::table('MASTER_AREA')->get();

		$userdata['lr_list']         = DB::table('LR_HEAD')->where('FLAG','0')->get();

		$userdata['user_list']       = DB::table('MASTER_DEPOT')->get();
		
		$userdata['truck_list']      = DB::table('TRIP_HEAD')->where('EPOD_STATUS','0')->where('GATE_OUT_STATUS','1')->get();
		// echo '<PRE>';print_r($userdata['truck_list']);exit();
		
		$userdata['comp_list']       = DB::table('MASTER_COMP')->get();
		
		$userdata['mfg_list']        = DB::table('MASTER_VEHICLE_MFG')->get();
		
		$userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

		$userdata['fpo_list']        = DB::table('FPO_HEAD')->get();

		$userdata['penalty_list']        = DB::table('MASTER_LRACK_PENALTY')->get();

		$userdata['trip_list']         = DB::table('TRIP_HEAD')->where('EPOD_STATUS','0')->where('LR_STATUS','1')->where('GATE_OUT_STATUS','1')->where('COMP_CODE',$comp_code)->get();

		$userdata['triplr_list'] = DB::select("SELECT t1.VEHICLE_NO AS VEHICLENO,t1.VRDATE,t2.* FROM TRIP_HEAD t1 LEFT JOIN TRIP_BODY t2 ON t1.TRIPHID  = t2.TRIPHID  WHERE t1.EPOD_STATUS ='0' AND t1.LR_STATUS='1' AND t1.GATE_OUT_STATUS='1'  GROUP BY t1.TRIPHID,t2.LR_NO");

		// echo '<PRE>';print_r($userdata['trip_list']);exit;

		$userdata['help_truck_list'] = DB::table('MASTER_FLEET')->Orderby('TRUCK_NO', 'desc')->limit(5)->get();


		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$fisYear])->get();

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}
		$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T3')->get();

   		$userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
		
        // $truckData = DB::table('TRIP_HEAD')->where('EPOD_STATUS',0)->where('LR_STATUS',1)->Orderby('VEHICLE_NO', 'desc')->get();

    
    	return view('admin.finance.transaction.logistic.ePOD_tran',$userdata+compact('title'));
    }

     public function getTruckDetails(Request $request){

		$response_array = array();


		if ($request->ajax()) {

	    	$struck_no   = $request->input('set_truckNo');
	    	$strip_no   = $request->input('set_trip_no');
	    	$slr_no   = $request->input('set_lrNo');
	    	$TripId   = $request->input('TripId');

	    	if($struck_no || $strip_no){

	    		$trip_plan = DB::select("SELECT t1.*,t2.ITEM_CODE,t2.ITEM_NAME,t2.DO_NO,t2.LR_NO,t2.DELORDER_NO,t2.INVC_NO,t2.MATERIAL_VAL,t2.DELIVERY_NO as delivery_no,t2.LR_DATE as lr_date,t2.QTY,t2.NET_WEIGHT FROM TRIP_BODY t2 LEFT JOIN TRIP_HEAD t1 ON t1.TRIPHID = t2.TRIPHID  WHERE t1.TRIPHID='$TripId' AND t1.VEHICLE_NO='$struck_no' AND t1.TRIP_NO='$strip_no' AND t1.EPOD_STATUS='0' AND t1.GATE_OUT_STATUS='1' ");

	    	}else{

	    		$trip_plan = DB::select("SELECT t1.*,t2.ITEM_CODE,t2.ITEM_NAME,t2.DO_NO,t2.LR_NO,t2.DELORDER_NO,t2.INVC_NO,t2.MATERIAL_VAL,t2.DELIVERY_NO as delivery_no,t2.LR_DATE as lr_date,t2.QTY,t2.NET_WEIGHT FROM TRIP_BODY t2 LEFT JOIN TRIP_HEAD t1 ON t1.TRIPHID = t2.TRIPHID  WHERE t2.TRIPHID='$TripId' AND t2.LR_NO='$slr_no' AND t1.EPOD_STATUS='0' AND t1.GATE_OUT_STATUS='1'");

	    	}
	    	
	    	

	    	$vrdate = $trip_plan[0]->VRDATE;
	    	$lr_date = $trip_plan[0]->lr_date;

	    	$GretestDate = DB::select("SELECT GREATEST('$vrdate', '$lr_date') AS DATE");

      //       echo '<PRE>';
	    	// print_r($trip_plan);echo '</PRE>';exit();
	    	/*echo '<PRE>';
	    	print_r($GretestDate);
	    	echo '</PRE>';*/


	    	
    		if($trip_plan) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $trip_plan;
	            $response_array['max_data'] = $GretestDate;
	            $response_array['data_inward'] ='';
	          
	         

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
         

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['count'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function ePODtranSaveold(Request $request){
        
        // $request->header('Content-Type','multipart/form-data');
           print_r($request->docuImg);

           $docuImg = $_FILES['docuImg'];
           print_r($docuImg);exit();
  //       $exp = explode("\\",$docuImg);

		// $last = end($exp);

		// $imgName = explode('.',$last);
		// $filename = $imgName[0];
		// $extensions = $imgName[1];

		//  $filenamewithext = $last;
  //        $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
  //        $extension = $extensions;
  //        $filenamestore1 = $filename.'_'.date('Ymd-His').'.'.$extension;
  //        $path = $request->file('last')->move('public/dist/img/credit',$filenamestore1);



  //       // $extension = $request->file('docuImg')->getClientOriginalExtension();
  //       print_r($path);exit();

  //       $exp = explode("\\",$docuImg);

		// $last = end($exp);
  //       print_r($docuImg);
  //       print_r($last);
        // $img_name  = getimagesize($_FILES['file'][$last]);
  //       // // $img_name = $_FILES[$docuImg]["name"];
  //       print_r($img_name);
    	// $docName = $request->formData;
    	// $docImg = $request->file('docuImg');
  //   	$data = $request->formData;
    	// print_r($docImg);exit();
     
		// $exp = explode("\\",$docImg);

		// $last = end($exp);

  //       print_r('rftert');
  //       print_r($docImg);exit();

		// $filenamewithext = $docImg->getClientOriginalName();
		
		// $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
		
		// $extension = $last->getClientOriginalExtension();
		
		// $filenamestore2 = $filename.'_'.date('Ymd-His').'.'.$extension;
		// print_r($filenamestore2);exit();
		
		// $path = $last->move('public/dist/img/credit',$filenamestore2);
		
		// $result = new SettingController;
        
		// $res = $result->docUploadImg($docImg);
		// print_r();
		//return response()->json($res);
		

		// $image_file = $request->docuImg;

		// $image      = Image::make($image_file);

		// Response::make($image->encode('jpeg'));
		// print_r('hello');
		// print_r($res);
		// print_r($image_file);exit();

		// $countdocImg = count($docImgname);
		// print_r($countdocImg);

		 // $image_file =$request->docuImg;

		 // $image      = Image::make($image_file);

		 // Response::make($image->encode('jpeg'));
		 // print_r($image);exit();

   //      $saveData2 = '';
		// for ($j=0; $j < $countdocImg; $j++) { 

		//   print_r($docImgname[$j]);
		//   print_r($docImg[$j]);

		  // $image_file = $docImg[$j];

		  // $image      = Image::make($image_file);

		  // Response::make($image->encode('jpeg'));
          
		// }

		// if ($request->file('photo')->isValid()) {
  //       $avatar = $request->file('photo');

  //       $filename = time() . '.' . $avatar->getClientOriginalExtension();

  //       Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename) );

  //   }
    }


    public function ePODtranSave(Request $request){


        $item_code      =  $request->input('item_code');

		$count_itemCode = count($item_code);
		
		$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$getcompcode = explode('-', $compName);
		
		$comp_code   =	$getcompcode[0];
		$comp_name   =	$getcompcode[1];
		
		$fisYear     =  $request->session()->get('macc_year');
		$vehical_no  =  $request->input('truck_no');
		$trip_no     =  $request->input('trip_no');
		$series_code =  $request->input('series_code');

		$reporting_dt = '';
		
		$report_date  = date('Y-m-d',strtotime($reporting_dt)); 
		
		// $ask_date     = $request->input('ack_date');
		
		// $ackDt        = explode(' ', $ask_date);
		// $acknow_dt    = date('Y-m-d',strtotime($ackDt[0])); 
		// $acknow_time  = $ackDt[1]; 
		// $acknow_a     = $ackDt[2]; 

		// $acknowle_DT   = $acknow_dt. ' ' .$acknow_time. ' ' .$acknow_a ;
		
		$vechicalArrDT = $request->input('vechicalArrDT');
		
		$va_date       = explode(' ', $vechicalArrDT);
		$varr_date     = date('Y-m-d',strtotime($va_date[0])); 
		$varr_time     = $va_date[1]; 
		$varr_a        = $va_date[2]; 

		$vehicalArr_DT  = $varr_date. ' ' .$varr_time. ' ' .$varr_a ;
		
		$delivery_dt    = $request->input('delivery_dt');
		
		$delivery_date  = date('Y-m-d',strtotime($delivery_dt)); 
		
		$recd_qty       =  $request->input('recd_qty');
		$shortage_qty   =  $request->input('shortage_qty');
		$TripHId   =  $request->input('TripHId');



		$updateTripB = array();
		
			
		$data = array(

			'ARRIVAL_DATE'   => $vehicalArr_DT,
			'DELIVERY_DATE'  => $delivery_date,
			// 'RECEIVED_QTY'   => $request->input('receivedQty'),
			'EPOD_STATUS'    => 1,
			'TRIP_ACHIVE_DAY'=> $request->achive_day,
			'LAST_UPDATE_BY' => $createdBy,
			
			
		);

		$saveData = DB::table('TRIP_HEAD')->where('TRIPHID',$TripHId)->where('TRIP_NO',$trip_no)->where('VEHICLE_NO',$vehical_no)->where('SERIES_CODE',$series_code)->update($data);

        $chkData = DB::table('TRIP_HEAD')->where('TRIPHID',$TripHId)->where('TRIP_NO',$trip_no)->where('VEHICLE_NO',$vehical_no)->where('SERIES_CODE',$series_code)->get()->first();
        
        $countTbody = DB::table('TRIP_BODY')->where('TRIP_NO',$trip_no)->get();

        $countData = count($countTbody);
		$id = $chkData->TRIPHID ;
		$trip_no = $chkData->TRIP_NO;
		$vr_no = $chkData->VRNO;

		// echo '<PRE>'; print_r($chkData);echo '</PRE>';exit();

        for ($i=0; $i < $count_itemCode; $i++) { 
        
          $data1 = array(
			
			'RECD_QTY'       => $recd_qty[$i],
			'SHORTAGE_QTY'   => $shortage_qty[$i],
			'EPOD_STATUS'    => 1,
			'LAST_UPDATE_BY' => $createdBy,
			
			
		);

        $saveData1 = DB::table('TRIP_BODY')->where('TRIPHID',$TripHId)->where('TRIPBID',$countTbody[$i]->TRIPBID)->update($data1);

        $updateTripB[] = $saveData1;

		}

        $discriptn_page = "Master ePOD tran done by user";

		$countT_body = count($updateTripB);
		$response_array = array();
		
		if($saveData && $countT_body > 0){

			$response_array['response'] = 'success';
			$response_array['data'] = '';
			$data = json_encode($response_array);
            print_r($data);

			
		} else {

			$response_array['response'] = 'error';
			$response_array['data'] = '';
			$data = json_encode($response_array);
			print_r($data);

		}
    }

    public function ePODTranView(Request $request){

    	 
    	if($request->ajax()) {

			$title    = 'View ePOD Tran';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

			$getcompcode = explode('-', $compName);
		
			$comp_code   =	$getcompcode[0];
			$comp_name   =	$getcompcode[1];


	    	//$data = DB::table('TRIP_HEAD')->where('EPOD_STATUS',1)->where('COMP_CODE',$comp_code)->get();

	    	$data = DB::table('TRIP_HEAD')
				->select('TRIP_HEAD.*', 'TRIP_BODY.LR_NO')
           		->leftjoin('TRIP_BODY', 'TRIP_BODY.TRIPHID', '=', 'TRIP_HEAD.TRIPHID')
           		->where('TRIP_HEAD.COMP_CODE',$comp_code)
           		->where('TRIP_HEAD.LR_STATUS','1')
           		->where('TRIP_HEAD.EPOD_STATUS','1')
           		->orderBy('TRIPHID','DESC')
           		->groupBy('TRIP_BODY.LR_NO');
	    	 


			 //return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

			 return DataTables()->of($data)->addIndexColumn()->make(true);

		}

    	return view('admin.finance.transaction.logistic.view_ePOD_tran');

    }

    public function EditePODTran(Request $request,$tripHeadId,$epodStatus){

    	$title = 'Edit ePOD Tran';

    	$tripHeadid = base64_decode($tripHeadId);
    	$epodStatus = base64_decode($epodStatus);

    	$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');

    	$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		foreach ($getdate as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

    	if(($tripHeadid!='') && ($epodStatus!='')){

    		$classData=DB::select("SELECT t1.*,t2.ITEM_CODE as bITEM_CODE,t2.ITEM_NAME as bITEM_NAME,t2.DO_NO as bDO_NO,IFNULL(t2.DELIVERY_NO,0) as bDELIVERY_NO,IFNULL(t2.LR_NO,0) as bLR_NO,IFNULL(t2.INVC_NO,0) as bINVC_NO,IFNULL(t2.MATERIAL_VAL,0) as bMATERIAL_VAL,IFNULL(t2.QTY,0) as bISSUED_QTY,t2.RECD_QTY as bRECD_QTY,IFNULL(t2.SHORTAGE_QTY,0) as bSHORTAGE_QTY,IFNULL(t2.LR_DATE,0) as blrDate,t2.TRIPBID,IFNULL(t2.NET_WEIGHT,0) AS NET_WEIGHT FROM TRIP_HEAD t1,TRIP_BODY t2 WHERE t1.TRIPHID=t2.TRIPHID AND t1.EPOD_STATUS='$epodStatus' AND t1.TRIPHID='$tripHeadid'");

    		$vrdate  = $classData[0]->VRDATE;
    		$lr_date = $classData[0]->blrDate;



    		$GretestDate = DB::select("SELECT GREATEST('$vrdate', '$lr_date') AS DATE");

    		//print_r($GretestDate);exit;


			return view('admin.finance.transaction.logistic.edit_epod_tran',$userdata+compact('title','classData','GretestDate'));
		}else{
			$request->session()->flash('alert-error', 'ePOD Not Found...!');
			return redirect('/view-ePOD-transaction');
		}
    }

    public function ePODtranUpdate(Request $request){

    	//print_r($request->post());exit;

		$createdBy      = $request->session()->get('userid');
		$compName       = $request->session()->get('company_name');
		$getcompcode    = explode('-', $compName);
		$comp_code      = $getcompcode[0];
		$comp_name      = $getcompcode[1];
		$fisYear        = $request->session()->get('macc_year');
		$item_code      = $request->input('item_code');
		$recd_qty       = $request->input('recd_qty');
		$achive_day     = $request->input('achive_day');
		$shortage_qty   = $request->input('shortage_qty');
		$hidnTripBodyId = $request->input('hidnTripBodyId');
		$hidnTripHeadId = $request->input('hidnTripHeadId');

		$vechicalArrDT = $request->input('vechicalArrDT');
		
		$va_date       = explode(' ', $vechicalArrDT);
		$varr_date     = date('Y-m-d',strtotime($va_date[0])); 
		$varr_time     = $va_date[1]; 
		$varr_a        = $va_date[2]; 
		
		$vehicalArr_DT  = $varr_date. ' ' .$varr_time. ' ' .$varr_a ;
		
		$delivery_dt    = $request->input('delivery_dt');
		
		$delivery_date  = date('Y-m-d',strtotime($delivery_dt)); 

		DB::beginTransaction();

		try {

			$dataHead = array(
				'DELIVERY_DATE' =>$delivery_date,
				'ARRIVAL_DATE'  =>$vehicalArr_DT,
				'TRIP_ACHIVE_DAY'=>$achive_day,
			);

			DB::table('TRIP_HEAD')->where('TRIPHID',$hidnTripHeadId)->update($dataHead);

			for ($i=0; $i <count($item_code) ; $i++) { 

				$data = array(
					'RECD_QTY'     =>$recd_qty[$i],
					'SHORTAGE_QTY' =>$shortage_qty[$i]
				);

				DB::table('TRIP_BODY')->where('TRIPHID',$hidnTripHeadId)->where('TRIPBID',$hidnTripBodyId[$i])->update($data);

			}

			DB::commit();
			$data1['response'] = 'success';
			$getalldata = json_encode($data1);  
			print_r($getalldata);

		   }catch (\Exception $e) {

			DB::rollBack();
			//throw $e;
			$data1['response'] = 'error';
			$getalldata = json_encode($data1);  
			print_r($getalldata);
		}
		
    }

    public function epod_update_msg(Request $request,$saveData){

		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/view-ePOD-transaction');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/view-ePOD-transaction');

		}
	}


    public function EPODdelete(Request $request){

     	$statusid = $request->post('ePODID');

     	DB::beginTransaction();

		try {

			if ($statusid!='') {

				$splitData  = explode('~',$statusid);
				$tripHeadID = $splitData[0];
				$epodStatus = $splitData[1];

	            $getTripBodyRow = DB::table('TRIP_BODY')->where('TRIPHID',$tripHeadID)->get();

	            /* -------- UPDATE IN TRIP BODY ------ */

		            for($i=0;$i<count($getTripBodyRow);$i++){

		                $tripBodyId = $getTripBodyRow[$i]->TRIPBID;

		                 $dataQty = array(
		                    'RECD_QTY'       => NULL,
		                    'SHORTAGE_QTY'   => NULL,   
		                );

		                DB::table('TRIP_BODY')->where('TRIPHID',$tripHeadID)->where('TRIPBID',$tripBodyId)->update($dataQty);

		            }

	            /* -------- UPDATE IN TRIP BODY ------ */

	            /* -------- UPDATE IN TRIP HEAD ------ */

		            $dataDate = array(
		                'ARRIVAL_DATE'   => NULL,
		                'DELIVERY_DATE'  => NULL,
		                'EPOD_STATUS'    => 0,
		                'TRIP_ACHIVE_DAY'=> NULL                
		            );
		            DB::table('TRIP_HEAD')->where('TRIPHID',$tripHeadID)->where('EPOD_STATUS',$epodStatus)->update($dataDate);

	            /* -------- UPDATE IN TRIP HEAD ------ */

			}/* ./ IF CODN*/
    	
    		DB::commit();

			$request->session()->flash('alert-success', 'ePOD tran was Deleted Successfully...!');
			return redirect('/view-ePOD-transaction');
			
		}catch (\Exception $e) {

	        DB::rollBack();
	       	// throw $e;
	        $request->session()->flash('alert-error', 'ePOD tran Not Found...!');
		   	return redirect('/view-ePOD-transaction');
    	}
    } /* /.main function*/

    public function ePODTruckDetails(Request $request){

    	$truck_no = $request->input('val');
    	$response_array = array();

    	if($truck_no != ''){

    		$truckDetails = DB::table('TRIP_HEAD')->where('VEHICLE_NO',$truck_no)->get()->first();

    		if($truckDetails){

    			$response_array['response'] = 'success';
    			$response_array['data'] = $truckDetails;
				$data = json_encode($response_array);
	            print_r($data);
    		}else{
    			$response_array['response'] = 'error';
    			$response_array['data'] = '';
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
    public function epodChildData(Request $request){

    	$vehicalNo = $request->input('vehicalNo');
    	$tripId = $request->input('tripId');
    	$series_code = $request->input('series_code');
    	$fycode = $request->input('fycode');
    	$response_array = array();

    	if($tripId !='' ){
    		$childData = DB::table('TRIP_BODY')->where('TRIPHID' , $tripId)->get();
            
            $response_array['response'] = 'success';
			$response_array['data'] = $childData;
			$data = json_encode($response_array);
            print_r($data);

    	}else{


            $response_array['response'] = 'error';
			$response_array['data'] = '';
			$data = json_encode($response_array);
            print_r($data);
    	}
    }
//  end ePOD Tran */

// Start Logistics DO Reports

    public function DO_pendingReport(Request $request){

        $title = "DO Order Pending Report";
        // print_r('report');exit();

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $comp_code = $getcomcode[0];


        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $userdata['dorder_list'] = DB::table('DORDER_BODY')->get();

        $master_plant  = DB::table('MASTER_PLANT')->where('COMP_CODE',$comp_code)->get();
        $master_series = DB::table('MASTER_CONFIG')->where('COMP_CODE',$comp_code)->get();

       echo '<PRE>'; print_r($master_series);exit();
        $master_pfct   = DB::table('MASTER_PFCT')->where('COMP_CODE',$comp_code)->get();

        if(isset($company_name)){

            return view('admin.finance.report.logistic.do_pending_order_report',$userdata+compact('title','master_plant','master_series','master_pfct'));
        }else{

            return redirect('/useractivity');

        }

    }

    public function DoMonthlyReport(Request $request){

        $title = "Delivery Order Monthly Report";
        
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

		$fisYear      =  $request->session()->get('macc_year');
		$splitYR      = explode('-', $fisYear);
		$startYEar    = $splitYR[0].'-04-01';

		$company_name = $request->session()->get('company_name');
		$explode      = explode('-', $company_name);
		$getcom_code  = $explode[0];

        $userdata['dorder_list'] = DB::table('DORDER_BODY')->get();
        $userdata['consinee_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->get();
        $userdata['city_list']       = DB::table('MASTER_CITY')->get();
        $fyYear_info = DB::table('MASTER_FY')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->get()->first();

        if(isset($company_name)){

            return view('admin.finance.report.logistic.do_monthly_order_report',$userdata+compact('title','fyYear_info'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function getDoMonthlyReport(Request $request){

    	if ($request->ajax()) {

			if (!empty($request->from_date || $request->to_date || $request->Consinee || $request->from_place || $request->to_place)) {

				$from_date   = $request->input('from_date');
				$to_date     = $request->input('to_date');
				$Consinee    = $request->input('Consinee');
				$ConsineeExp = explode('-', $Consinee);
				
				$from_place  = $request->input('from_place');
				$fPlaceExp   = explode('-', $from_place);
				$to_place    = $request->input('to_place');
				$tPlaceExp   = explode('-', $to_place);
				
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

		      	 	$strWhere .= " AND DORDER_HEAD.VRDATE BETWEEN '$fromDate' AND  '$toDate' ";

		      	 }
				
				if(isset($ConsineeExp[0])  && trim($ConsineeExp[0])!=""){

					$strWhere .= " AND DORDER_BODY.CP_CODE = '$ConsineeExp[0]' ";

				}

				// if(isset($fPlaceExp[1])  && trim($fPlaceExp[1])!="" && isset($tPlaceExp[1])  && trim($tPlaceExp[1])!=""){

				// 	$strWhere .= " AND DORDER_BODY.FROM_PLACE = '$fPlaceExp[1]' AND DORDER_BODY.TO_PLACE = '$tPlaceExp[1]' ";

				// }
				if(isset($tPlaceExp[1])  && trim($tPlaceExp[1])!=""){

					$strWhere .= " AND DORDER_BODY.TO_PLACE = '$tPlaceExp[1]' ";
                     
				}
				
				
				//DB::enableQueryLog();
				$data = DB::select("SELECT DORDER_HEAD.COMP_CODE AS COMPCODE,DORDER_HEAD.FY_CODE AS FYCODE,DORDER_HEAD.PFCT_CODE AS PFCTCODE,DORDER_HEAD.PFCT_NAME AS PFCTNAME,DORDER_HEAD.SERIES_CODE AS SERIESCODE,DORDER_HEAD.SERIES_NAME AS SERIESNAME,DORDER_HEAD.ACC_CODE AS ACCCODE,DORDER_HEAD.ACC_NAME AS ACCNAME,DORDER_HEAD.VRNO AS VRN,
						DORDER_HEAD.VRDATE AS VRDT,DORDER_HEAD.PLANT_CODE AS PLANTCODE,DORDER_HEAD.PLANT_NAME AS PLANTNAME,
						DORDER_BODY.FROM_PLACE AS FROMPLACE,DORDER_BODY.TO_PLACE AS TOPLACE,
						DORDER_BODY.* 
						FROM DORDER_HEAD INNER JOIN DORDER_BODY 
						ON DORDER_HEAD.DORDERHID = DORDER_BODY.DORDERHID WHERE 1=1  $strWhere");

					//dd(DB::getQueryLog());

				return DataTables()->of($data)->addIndexColumn()->make(true);

		}

	}

	$data = array();
	return DataTables()->of($data)->addIndexColumn()->make(true);

    }

    public function DoCompleteReport(Request $request){

        $title = "DO Order Pending Report";
        // print_r('report');exit();

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $comp_code = $getcomcode[0];
        $comp_name = $getcomcode[1];
        // print_r($comp_code);

        $TranCode = 'T0';
        $Tran_Code2 = '';

        $functionData = $this->CommonFunction($macc_year,$comp_code,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = $functionData['bank_list'];
        $transpoter_list = $functionData['transpoter_list'];
        $item_list       = $functionData['item_list'];
        $acc_list        = $functionData['transpoter_list'];

       // echo '<PRE>'; print_r($acc_list);exit();
       $fyYear_info = DB::table('MASTER_FY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->get()->first();


        $userdata['dorder_list'] = DB::table('DORDER_BODY')->groupBy('DORDER_NO')->get();
        $userdata['dorder_list_acc'] = DB::table('DORDER_BODY')->groupBy('ACC_CODE')->get();
        $userdata['dorder_vrno'] = DB::table('DORDER_HEAD')->get();

        $master_plant  = DB::table('MASTER_PLANT')->where('COMP_CODE',$comp_code)->get();
        $master_series = DB::table('MASTER_CONFIG')->where('COMP_CODE',$comp_code)->get();
        $master_pfct   = DB::table('MASTER_PFCT')->where('COMP_CODE',$comp_code)->get();

        $city_list   = DB::table('MASTER_CITY')->get();

        if(isset($company_name)){

            return view('admin.finance.report.logistic.do_pending_order_report',$userdata+compact('title','fyYear_info','master_plant','master_series','master_pfct','acc_list','city_list'));
        }else{

            return redirect('/useractivity');

        }

    }


     public function InwrdDoChangeDest(Request $request){

        $title = "Inward Do Change Destination";
       
		$company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $comp_code = $getcomcode[0];
        $comp_name = $getcomcode[1];
        // print_r($comp_code);

        $TranCode = 'T0';
        $Tran_Code2 = '';

        $functionData = $this->CommonFunction($macc_year,$comp_code,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $fyYear_info = DB::table('MASTER_FY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->get()->first();

		$userdata['dorder_list']  = DB::table('DORDER_BODY')->where('COMP_CODE',$comp_code)->groupBy('DORDER_NO')->get();
		$userdata['dorder_list1'] = DB::table('DORDER_BODY')->where('COMP_CODE',$comp_code)->groupBy('CP_CODE')->get();
		$userdata['rake_list']    = DB::table('DORDER_BODY')->where('COMP_CODE',$comp_code)->groupBy('RAKE_NO')->get();
		$userdata['acc_list']     = DB::table('DORDER_BODY')->where('COMP_CODE',$comp_code)->groupBy('ACC_CODE')->get();
		$userdata['toplace_list']    = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('TO_PLACE')->get();
		$userdata['dorder_vrno']  = DB::table('DORDER_HEAD')->get();

        if(isset($company_name)){

            return view('admin.finance.transaction.logistic.inward_do_change_dest',$userdata+compact('title','fyYear_info'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function InwardDoDestChange(Request $request){

    	 if($request->ajax()) {


            if (!empty($request->acc_code || $request->cust_no  || $request->do_no || $request->wagon_no || $request->item_name || $request->rake_no)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $exp = explode('-',$request->cust_no);


                if(isset($exp[0])  && trim($exp[0])!=""){
                    $custNo = trim($exp[0]);
                    $strWhere .= " AND  TRIM(DORDER_BODY.CP_CODE) = '$custNo'";
                }

                if(isset($request->acc_code)  && trim($request->acc_code)!=""){
                    
                    $strWhere .= " AND  TRIM(DORDER_BODY.ACC_CODE) = '$request->acc_code'";
                }
                if(isset($request->do_no)  && trim($request->do_no)!=""){
                    
                    $strWhere .= " AND  TRIM(DORDER_BODY.DORDER_NO) = '$request->do_no'";
                }
                if(isset($request->rake_no)  && trim($request->rake_no)!=""){
                    
                    $strWhere .= " AND  DORDER_BODY.RAKE_NO = '$request->rake_no'";
                }
                if(isset($request->wagon_no)  && trim($request->wagon_no)!=""){
                    
                    $strWhere .= " AND  TRIM(DORDER_BODY.DO_WAGON_NO) = '$request->wagon_no'";
                }
                if(isset($request->item_name)  && trim($request->item_name)!=""){
                    
                    $strWhere .= " AND  TRIM(DORDER_BODY.REMARK) = '$request->item_name'";
                }

               // DB::enableQueryLog();

                	$data = DB::select("SELECT DORDER_HEAD.VRDATE,DORDER_HEAD.PLANT_CODE,DORDER_HEAD.PLANT_NAME,DORDER_HEAD.TRAN_CODE,DORDER_HEAD.PFCT_CODE,DORDER_HEAD.PFCT_NAME,DORDER_HEAD.SERIES_CODE,DORDER_HEAD.SERIES_NAME,DORDER_HEAD.ROUTE_CODE,DORDER_HEAD.ROUTE_NAME,DORDER_HEAD.DO_STATUS,DORDER_BODY.* FROM DORDER_HEAD LEFT JOIN DORDER_BODY ON DORDER_HEAD.DORDERHID = DORDER_BODY.DORDERHID  WHERE 1=1 $strWhere  AND  DORDER_HEAD.DO_STATUS = '0' AND (DORDER_BODY.QTY - DORDER_BODY.DISPATCH_PLAN_QTY - DORDER_BODY.CANCEL_QTY) > 0.000");

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


     public function deliveryOrderChangeDest(Request $request){

        $title = "Delivery Order Change Destination";
       
		$company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $comp_code = $getcomcode[0];
        $comp_name = $getcomcode[1];
        // print_r($comp_code);

        $TranCode = 'T0';
        $Tran_Code2 = '';

        $functionData = $this->CommonFunction($macc_year,$comp_code,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $fyYear_info = DB::table('MASTER_FY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->get()->first();

		$userdata['dorder_list']  = DB::table('DORDER_BODY')->where('COMP_CODE',$comp_code)->groupBy('DORDER_NO')->get();
		$userdata['dorder_list1'] = DB::table('DORDER_BODY')->where('COMP_CODE',$comp_code)->groupBy('CP_CODE')->get();
		$userdata['acc_list']    = DB::table('DORDER_BODY')->where('COMP_CODE',$comp_code)->groupBy('ACC_CODE')->get();
		$userdata['toplace_list']    = DB::table('MASTER_FREIGHT_ROUTE')->groupBy('TO_PLACE')->get();
		$userdata['dorder_vrno']  = DB::table('DORDER_HEAD')->get();

        if(isset($company_name)){

            return view('admin.finance.transaction.logistic.delivery_order_change_dest',$userdata+compact('title','fyYear_info'));
        }else{

            return redirect('/useractivity');

        }

    }


    public function deliveryOrderDestChange(Request $request){

    	 if($request->ajax()) {

            if (!empty($request->acc_code || $request->cust_no  || $request->do_no)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $exp = explode('-',$request->cust_no);


                if(isset($exp[0])  && trim($exp[0])!=""){
                    $custNo = trim($exp[0]);
                    $strWhere .= " AND  TRIM(DORDER_BODY.CP_CODE) = '$custNo'";
                }

                if(isset($request->acc_code)  && trim($request->acc_code)!=""){
                    
                    $strWhere .= " AND  TRIM(DORDER_BODY.ACC_CODE) = '$request->acc_code'";
                }

                if(isset($request->do_no)  && trim($request->do_no)!=""){
                    
                    $strWhere .= " AND  TRIM(DORDER_BODY.DORDER_NO) = '$request->do_no'";
                }

                //DB::enableQueryLog();

                	$data = DB::select("SELECT DORDER_HEAD.VRDATE,DORDER_HEAD.PLANT_CODE,DORDER_HEAD.PLANT_NAME,DORDER_HEAD.TRAN_CODE,DORDER_HEAD.PFCT_CODE,DORDER_HEAD.PFCT_NAME,DORDER_HEAD.SERIES_CODE,DORDER_HEAD.SERIES_NAME,DORDER_HEAD.ROUTE_CODE,DORDER_HEAD.ROUTE_NAME,DORDER_HEAD.DO_STATUS,DORDER_BODY.* FROM DORDER_HEAD LEFT JOIN DORDER_BODY ON DORDER_HEAD.DORDERHID = DORDER_BODY.DORDERHID  WHERE 1=1 $strWhere  AND  DORDER_HEAD.DO_STATUS = '0' AND (DORDER_BODY.QTY - DORDER_BODY.DISPATCH_PLAN_QTY - DORDER_BODY.CANCEL_QTY) > 0.000");

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

    public function deliveryOrderQtyCancel(Request $request){

        $title = "Delivery Order Cancel Report";
       
		$company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $comp_code = $getcomcode[0];
        $comp_name = $getcomcode[1];
        // print_r($comp_code);

        $TranCode = 'T0';
        $Tran_Code2 = '';

        $functionData = $this->CommonFunction($macc_year,$comp_code,$TranCode,$Tran_Code2);

        foreach ($functionData['item_um_aum_list'] as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $fyYear_info = DB::table('MASTER_FY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$macc_year)->get()->first();

		$userdata['dorder_list']  = DB::table('DORDER_BODY')->groupBy('DORDER_NO')->get();
		$userdata['dorder_list1'] = DB::table('DORDER_BODY')->groupBy('CP_CODE')->get();
		$userdata['dorder_vrno']  = DB::table('DORDER_HEAD')->get();

        if(isset($company_name)){

            return view('admin.finance.report.logistic.delivery_order_cancel_report',$userdata+compact('title','fyYear_info'));
        }else{

            return redirect('/useractivity');

        }

    }

     public function getDataFromDeliveryOrder(Request $request){
     	// print_r($request->seriesCodeOperator);exit();

    	if($request->ajax()){

	    	if (!empty($request->seriesCodeOperator || $request->seriesCodeValue || $request->plantCodeOperator || $request->plantCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->QtyOperator || $request->QtyValue || $request->odcOperator  || $request->odcValue || $request->from_date || $request->to_date || $request->cust_no || $request->ReportTypes || $request->do_no || $request->from_place || $request->to_place)) {

	    		date_default_timezone_set('Asia/Kolkata');
	    		$strWhere = '';

	            $company_name = $request->session()->get('company_name');
	            $getcomcode   = explode('-', $company_name);
	            $comp_code    = $getcomcode[0];
	            $macc_year    = $request->session()->get('macc_year');
	            $loginUser    = $request->session()->get('userid');
	            $cust_no      = $request->cust_no;
	            $from_date    = $request->from_date;
	            $to_date      = $request->to_date;
	            $do_no        = $request->do_no;
	            $cust_no        = $request->cust_no;

	          

	            if(isset($request->plantCodeOperator)  && trim($request->plantCodeValue)!=""){
	                   
	                // print_r('plantcode');
	                $strWhere .= " AND  DORDER_BODY.PLANT_CODE ".$request->plantCodeOperator." '".$request->plantCodeValue."'";
	            } 


	            if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeValue)!=""){

	            	$strWhere .= " AND  DORDER_HEAD.SERIES_CODE ".$request->seriesCodeOperator." '".$request->seriesCodeValue."'";
	            }

	            if(isset($request->cust_no) && trim($request->cust_no)!=""){
	                    
	                $strWhere .= " AND  DORDER_HEAD.ACC_CODE = '".$request->cust_no."' ";

	            }

	            if(isset($request->profitCenterOperator)  && trim($request->profitCenterValue)!=""){
	                
	                $strWhere .= " AND  DORDER_HEAD.PFCT_CODE ".$request->profitCenterOperator." '".$request->profitCenterValue."'";
	            }

	            if(isset($request->QtyOperator)  && trim($request->QtyValue)!=""){
                    $strWhere .= " AND  DORDER_BODY.QTY ".$request->QtyOperator." '".$request->QtyValue."'";
                }

                if(isset($request->odcOperator)  && trim($request->odcValue)!=""){
                    $strWhere .= " AND  DORDER_BODY.ODC ".$request->odcOperator." '".$request->odcValue."'";
                }

                if(isset($request->from_place)  && trim($request->from_place)!=""){
	                
	                $strWhere .= " AND  DORDER_BODY.FROM_PLACE = '".$from_place."'";
	            }

	            if(isset($request->to_place)  && trim($request->to_place)!=""){
	                
	                $strWhere .= " AND  DORDER_BODY.TO_PLACE = '".$to_place."'";
	            }

	            if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

	            	$ToDt = date("Y-m-d", strtotime($request->to_date));

	                $FromDt = date("Y-m-d", strtotime($request->from_date));

	                $strWhere .= " AND  DORDER_BODY.VRDATE BETWEEN '$FromDt' AND  '$ToDt' ";
	            }
                

		        if(isset($comp_code) && isset($macc_year)){
	                  
	                    $strWhere .= " AND  DORDER_HEAD.COMP_CODE = '".$comp_code."' AND DORDER_HEAD.FY_CODE = '".$macc_year."'";

	            }

		        if(isset($do_no)){
	                  
	                    $strWhere .= " AND  DORDER_BODY.DORDER_NO = '".$do_no."' ";

	            }



	            if($request->ReportTypes == 'pending'){

	              // DB::enableQueryLog();	   
	                $data = DB::select("SELECT DORDER_BODY.PLANT_CODE AS PLANT_CODE,DORDER_BODY.PLANT_NAME AS PLANT_NAME,DORDER_BODY.ALIAS_ITEM_CODE,DORDER_BODY.ALIAS_ITEM_NAME,DORDER_BODY.RAKE_NO,DORDER_BODY.DO_WAGON_NO,DORDER_HEAD.VRDATE,DORDER_HEAD.SERIES_CODE AS SERIES_CODE,DORDER_HEAD.SERIES_NAME AS SERIES_NAME,DORDER_HEAD.ACC_CODE AS ACC_CODE,DORDER_HEAD.ACC_NAME AS ACC_NAME,DORDER_HEAD.PFCT_CODE AS PFCT_CODE,DORDER_HEAD.PFCT_NAME AS PFCT_NAME,DORDER_HEAD.DO_STATUS,DORDER_BODY.* FROM DORDER_HEAD LEFT JOIN DORDER_BODY ON DORDER_HEAD.DORDERHID = DORDER_BODY.DORDERHID  WHERE 1=1 $strWhere AND DORDER_BODY.QTY-DORDER_BODY.DISPATCH_PLAN_QTY-DORDER_BODY.CANCEL_QTY > 0 AND DORDER_HEAD.DO_STATUS = 0" );
	                	// dd(DB::getQueryLog());

				}else if($request->ReportTypes == 'complete'){

	                 
	                $data = DB::select("SELECT DORDER_BODY.PLANT_CODE AS PLANT_CODE,DORDER_BODY.PLANT_NAME AS PLANT_NAME,DORDER_BODY.ALIAS_ITEM_CODE,DORDER_BODY.ALIAS_ITEM_NAME,DORDER_BODY.RAKE_NO,DORDER_BODY.DO_WAGON_NO,DORDER_HEAD.VRDATE,DORDER_HEAD.SERIES_CODE AS SERIES_CODE,DORDER_HEAD.SERIES_NAME AS SERIES_NAME,DORDER_HEAD.ACC_CODE AS ACC_CODE,DORDER_HEAD.ACC_NAME AS ACC_NAME,DORDER_HEAD.PFCT_CODE AS PFCT_CODE,DORDER_HEAD.PFCT_NAME AS PFCT_NAME,DORDER_HEAD.DO_STATUS,DORDER_BODY.* FROM DORDER_HEAD LEFT JOIN DORDER_BODY ON DORDER_HEAD.DORDERHID = DORDER_BODY.DORDERHID  WHERE 1=1 $strWhere AND DORDER_BODY.QTY-DORDER_BODY.DISPATCH_PLAN_QTY-DORDER_BODY.CANCEL_QTY > 0 AND DORDER_HEAD.DO_STATUS = 1" );
	            }else{

	                 
	                $data = DB::select("SELECT DORDER_BODY.PLANT_CODE AS PLANT_CODE,DORDER_BODY.PLANT_NAME AS PLANT_NAME,DORDER_BODY.ALIAS_ITEM_CODE,DORDER_BODY.ALIAS_ITEM_NAME,DORDER_BODY.RAKE_NO,DORDER_BODY.DO_WAGON_NO,DORDER_HEAD.VRDATE,DORDER_HEAD.SERIES_CODE AS SERIES_CODE,DORDER_HEAD.SERIES_NAME AS SERIES_NAME,DORDER_HEAD.ACC_CODE AS ACC_CODE,DORDER_HEAD.ACC_NAME AS ACC_NAME,DORDER_HEAD.PFCT_CODE AS PFCT_CODE,DORDER_HEAD.PFCT_NAME AS PFCT_NAME,DORDER_HEAD.DO_STATUS,DORDER_BODY.* FROM DORDER_HEAD LEFT JOIN DORDER_BODY ON DORDER_HEAD.DORDERHID = DORDER_BODY.DORDERHID  WHERE 1=1 $strWhere AND DORDER_BODY.QTY-DORDER_BODY.DISPATCH_PLAN_QTY-DORDER_BODY.CANCEL_QTY > 0" );

	            }

	            // echo '<PRE>';print_r($data);

	            return DataTables()->of($data)->addIndexColumn()->make(true);
	            // return DataTables()->of($data)->addIndexColumn()->toJson();
	            


	    	}else{

	                $data = array();

	                return DataTables()->of($data)->addIndexColumn()->make(true);
	                
	        }

        }else{
        	 $data = array();

            return DataTables()->of($data)->make(true);
        }



    }

    public function DeliveryOrderPendingReportExcel(Request $request,$from_date,$to_date,$vrn,$do_no,$cust_no,$from_place,$to_place,$seriesCodeOperator,$seriesCodeValue,$plantCodeOperator,$plantCodeValue,$profitCenterOperator,$profitCenterValue,$QtyOperator,$QtyValue,$odcOperator,$odcValue,$ReportTypes,$type){

    	date_default_timezone_set('Asia/Kolkata');

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        $userId       = $request->session()->get('userid');
        $company_name = $request->session()->get('company_name');
        $getcomcode   = explode('-', $company_name);
        $comp_code    = $getcomcode[0];
        $macc_year    = $request->session()->get('macc_year');
        $db_name      = $request->session()->get('dbName');

        $dt    = date("Y-m-d");
        $expd  = explode('-',$dt);
        $y     = $expd[0];
        $m     = $expd[1];
        $d     = $expd[2];
        $num   =  rand(10,10000);
        $fileName = 'DORDER_REPORT'.'_'.$y.$m.$d.'_'.$num.'.xlsx';
        
        $fromDate             = $from_date;
        $from_date            = date("Y-m-d", strtotime($fromDate));
        $toDate               = $to_date;
        $to_date              = date("Y-m-d", strtotime($toDate));
   

        public_path('/dist/report_excel/' . $fileName);
       
         $response =  Excel::download(new DeliveryOrderPendingReportExport($from_date,$to_date,$vrn,$do_no,$cust_no,$from_place,$to_place,$seriesCodeOperator,$seriesCodeValue,$plantCodeOperator,$plantCodeValue,$profitCenterOperator,$profitCenterValue,$QtyOperator,$QtyValue,$odcOperator,$odcValue,$ReportTypes,$comp_code,$macc_year,$type),$fileName, null, [\Maatwebsite\Excel\Excel::XLSX]);

        ob_end_clean();

        return $response;


    }

  
// End Logistics DO Reports

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


 public function purchaseDataOrderCancel(Request $request){

    	 if($request->ajax()) {

            if (!empty($request->OrderNo || $request->item_code || $request->from_date || $request->to_date)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $IndentNu = $request->OrderNo;

                if (isset($IndentNu)) {

                	$exp = explode(" ",$IndentNu);

                	$IndVrno = $exp[2];

                }

               
                if(isset($IndVrno)  && trim($IndVrno)!=""){
                   
                    $strWhere .= "AND  PORDER_HEAD.VRNO = '$IndVrno'";
                } 

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    
                    $strWhere .= "AND  PORDER_BODY.ITEM_CODE = '$request->item_code'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND  PORDER_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt'";
                }


                

                //DB::enableQueryLog();

                	$data = DB::select("SELECT PORDER_HEAD.VRDATE,PORDER_HEAD.PLANT_CODE,PORDER_HEAD.TRAN_CODE,PORDER_HEAD.ACC_CODE,MASTER_ITEMUM.AUM_FACTOR,MASTER_ITEMUM.AUM_CODE,MASTER_ITEMUM.UM_CODE,PORDER_BODY.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN MASTER_ITEMUM ON PORDER_BODY.ITEM_CODE = MASTER_ITEMUM.ITEM_CODE WHERE 1=1 $strWhere  AND  PORDER_BODY.GRNHID = '0' AND PORDER_BODY.GRNBID = '0'");

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


    public function OrderUpdateCancelQty(Request $request){

		$PORDERHID = $request->input('PORDERHID');
		$PORDERBID  = $request->input('PORDERBID');
		$AUMFACT   = $request->input('AUMFACT');
		$CANCELQTY = $request->input('CANCELQTY');
		$QTYRECD   = $request->input('QTYRECD');
		$TAXCODE   = $request->input('TAXCODE');
		$RATE      = $request->input('RATE');
		$QTYISSUED = $request->input('QTYISSUED');
		$QTYCANCEL = $request->input('QTYCANCEL');

		$response_array = array();

		if($request->ajax()) {

			if($QTYRECD  == 0){

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
			
			}else{

				$CAL_TAX_D = DB::select("SELECT t1.*,t2.*,t3.* FROM PORDER_TAX t3 LEFT JOIN PORDER_BODY t2 ON t2.PORDERBID = t3.PORDERBID LEFT JOIN PORDER_HEAD t1 ON t1.PORDERHID = t3.PORDERHID WHERE t2.TAX_CODE='$TAXCODE' AND t3.PORDERHID='$PORDERHID' AND t3.PORDERBID='$PORDERBID'");

				$REMANINGQTY = $QTYRECD - $QTYISSUED;

				$FINALQTY    = $REMANINGQTY - $QTYCANCEL;

				$FINALBASIC  = $FINALQTY * $RATE;

				$CHECKCANCELQTY = $CANCELQTY + $QTYCANCEL;


				if($CANCELQTY > $FINALQTY){

					$response_array['response'] = 'Qty Error';
		            $response_array['data'] = '' ;
		            $data = json_encode($response_array);

		            print_r($data);

				}else{

					$data_body = array(
						'QTYCANCEL'  => $CHECKCANCELQTY
					);

					//DB::enableQueryLog();

					$UPDATE_PCNTR_BODY = DB::table('PORDER_BODY')->where('PORDERHID',$PORDERHID)->where('PORDERBID',$PORDERBID)->update($data_body);

					//dd(DB::getQueryLog());

					if ($UPDATE_PCNTR_BODY) {

						$response_array['response'] = 'success';
						$response_array['data']     = '';
						$response_array['calTax']   = '';
			            $data = json_encode($response_array);

			            print_r($data);

					}else{

						$response_array['response'] = 'error';
		                $response_array['data'] = '' ;
		                $data = json_encode($response_array);

		                print_r($data);
						
					}

				}

			}

    	}else{

			$response_array['response'] = 'Ajax Error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);
				
		}


    }


    


   /* .... START : Cancel Delivery Order.... */
   	
   	 public function deliveryOrderCancelQty(Request $request){

    	 if($request->ajax()) {

            if (!empty($request->from_date || $request->to_date || $request->do_no || $request->cust_no)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $exp = explode('-',$request->cust_no);


                if(isset($exp[0])  && trim($exp[0])!=""){
                    $custNo = trim($exp[0]);
                    $strWhere .= " AND  TRIM(DORDER_BODY.CP_CODE) = '$custNo'";
                }

                if(isset($request->do_no)  && trim($request->do_no)!=""){
                    
                    $strWhere .= " AND  TRIM(DORDER_BODY.DORDER_NO) = '$request->do_no'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  TRIM(DORDER_HEAD.VRDATE) BETWEEN '$FromDt' AND  '$ToDt'";
                }
                

                //DB::enableQueryLog();

                	$data = DB::select("SELECT DORDER_HEAD.VRDATE,DORDER_HEAD.PLANT_CODE,DORDER_HEAD.PLANT_NAME,DORDER_HEAD.TRAN_CODE,DORDER_HEAD.PFCT_CODE,DORDER_HEAD.PFCT_NAME,DORDER_HEAD.SERIES_CODE,DORDER_HEAD.SERIES_NAME,DORDER_HEAD.ROUTE_CODE,DORDER_HEAD.ROUTE_NAME,DORDER_HEAD.DO_STATUS,DORDER_BODY.* FROM DORDER_HEAD LEFT JOIN DORDER_BODY ON DORDER_HEAD.DORDERHID = DORDER_BODY.DORDERHID  WHERE 1=1 $strWhere  AND  DORDER_HEAD.DO_STATUS = '0' AND (DORDER_BODY.QTY - DORDER_BODY.DISPATCH_PLAN_QTY - DORDER_BODY.CANCEL_QTY) > 0.000");

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


    public function OrderUpdateCancelQty1(Request $request){

		$PORDERHID = $request->input('PORDERHID');
		$PORDERBID  = $request->input('PORDERBID');
		$AUMFACT   = $request->input('AUMFACT');
		$CANCELQTY = $request->input('CANCELQTY');
		$QTYRECD   = $request->input('QTYRECD');
		$TAXCODE   = $request->input('TAXCODE');
		$RATE      = $request->input('RATE');
		$QTYISSUED = $request->input('QTYISSUED');
		$QTYCANCEL = $request->input('QTYCANCEL');

		$response_array = array();

		if($request->ajax()) {

			if($QTYRECD  == 0){

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
			
			}else{

				$CAL_TAX_D = DB::select("SELECT t1.*,t2.*,t3.* FROM PORDER_TAX t3 LEFT JOIN PORDER_BODY t2 ON t2.PORDERBID = t3.PORDERBID LEFT JOIN PORDER_HEAD t1 ON t1.PORDERHID = t3.PORDERHID WHERE t2.TAX_CODE='$TAXCODE' AND t3.PORDERHID='$PORDERHID' AND t3.PORDERBID='$PORDERBID'");

				$REMANINGQTY = $QTYRECD - $QTYISSUED;

				$FINALQTY    = $REMANINGQTY - $QTYCANCEL;

				$FINALBASIC  = $FINALQTY * $RATE;

				$CHECKCANCELQTY = $CANCELQTY + $QTYCANCEL;


				if($CANCELQTY > $FINALQTY){

					$response_array['response'] = 'Qty Error';
		            $response_array['data'] = '' ;
		            $data = json_encode($response_array);

		            print_r($data);

				}else{

					$data_body = array(
						'QTYCANCEL'  => $CHECKCANCELQTY
					);

					//DB::enableQueryLog();

					$UPDATE_PCNTR_BODY = DB::table('PORDER_BODY')->where('PORDERHID',$PORDERHID)->where('PORDERBID',$PORDERBID)->update($data_body);

					//dd(DB::getQueryLog());

					if ($UPDATE_PCNTR_BODY) {

						$response_array['response'] = 'success';
						$response_array['data']     = '';
						$response_array['calTax']   = '';
			            $data = json_encode($response_array);

			            print_r($data);

					}else{

						$response_array['response'] = 'error';
		                $response_array['data'] = '' ;
		                $data = json_encode($response_array);

		                print_r($data);
						
					}

				}

			}

    	}else{

			$response_array['response'] = 'Ajax Error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);
				
		}


    }

    public function deliveryOrderUpdateCancelQty(Request $request){

		$DORDERHID       = $request->input('DORDERHID');
		$DORDERBID       = $request->input('DORDERBID');
		$QTY             = $request->input('QTY');
		$DISPATCHPLANQTY = $request->input('DISPATCHPLANQTY');
		$CANCEL_QTY      = $request->input('CANCEL_QTY');
		$CANCELQTY       = $request->input('CANCELQTY');
		$getSrNo         = $request->input('getSrNo');
		
		$response_array = array();

		if($request->ajax()) {

			if($CANCELQTY  == 0){

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $data = json_encode($response_array);

                print_r($data);
			
			}else{

				$CAL_TAX_D = DB::select("SELECT t1.*,t2.* FROM DORDER_HEAD t1 LEFT JOIN DORDER_BODY t2 ON t1.DORDERHID = t2.DORDERHID WHERE t2.DORDERBID='$DORDERBID' AND t2.DORDERHID='$DORDERHID'");

				$REMANINGQTY = $QTY - $DISPATCHPLANQTY;

				$FINALQTY    = $REMANINGQTY - $CANCEL_QTY;

				$CHECKCANCELQTY = $CANCELQTY + $CANCEL_QTY;


				if($CANCELQTY > $FINALQTY){

					$response_array['response'] = 'Qty Error';
		            $response_array['data'] = '' ;
		            $data = json_encode($response_array);

		            print_r($data);

				}else{

					$data_body = array(
						'CANCEL_QTY'  => $CHECKCANCELQTY
					);

					//DB::enableQueryLog();

					$UPDATE_DORDER_BODY = DB::table('DORDER_BODY')->where('DORDERHID',$DORDERHID)->where('DORDERBID',$DORDERBID)->update($data_body);

					//dd(DB::getQueryLog());

					if ($UPDATE_DORDER_BODY) {

						$response_array['response'] = 'success';
						$response_array['data']     = '';
						$response_array['calTax']   = '';
			            $data = json_encode($response_array);

			            print_r($data);

					}else{

						$response_array['response'] = 'error';
		                $response_array['data'] = '' ;
		                $data = json_encode($response_array);

		                print_r($data);
						
					}

				}

			}

    	}else{

			$response_array['response'] = 'Ajax Error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);
				
		}


    }


     public function deliveryOrderChangeDestination(Request $request){

     	$company_name = $request->session()->get('company_name');
	    $getcomcode   = explode('-', $company_name);
	    $compCode     = $getcomcode[0];
	    $fisYear      = $request->session()->get('macc_year');
		$accCode       = $request->input('acc_code');
		$doNo           = $request->input('do_no');
		$custNo           = $request->input('cust_no');
		$to_place           = $request->input('to_place');
	
		$response_array = array();

		/*echo "<pre>";
		print_r($accCode);
		echo "<pre>";

		print_r($doNo);
		echo "<pre>";
		print_r($custNo);
		echo "<pre>";
		print_r($to_place);exit;*/
		

		if($request->ajax()) {


					$data_body = array(

						'TO_PLACE'  => $to_place
					);

					//DB::enableQueryLog();

					$UpdateDo = DB::table('DORDER_BODY')->where('COMP_CODE',$compCode)->where('ACC_CODE',$accCode)->where('CP_CODE',$custNo)->where('DORDER_NO',$doNo)->update($data_body);


			if($UpdateDo){

	      			$response_array['response'] = 'success';
	      			$data = json_encode($response_array);  
			        print_r($data);

	            }else{

	            	$response_array['response'] = 'error';
	      			$data = json_encode($response_array);  
			        print_r($data);
	            }
		}

		     

}


public function inwardDoChangeDestination(Request $request){

     	$company_name = $request->session()->get('company_name');
	    $getcomcode   = explode('-', $company_name);
	    $compCode     = $getcomcode[0];
	    $fisYear      = $request->session()->get('macc_year');
		$accCode      = $request->input('acc_code');
		$doNo         = $request->input('do_no');
		$custNo       = $request->input('cust_no');
		$wagonNo      = $request->input('wagon_no');
		$itemName     = $request->input('item_name');
		$to_place     = $request->input('to_place');
	
		$response_array = array();


		if($request->ajax()) {


					$data_body = array(

						'TO_PLACE'  => $to_place
					);

					//DB::enableQueryLog();

					$UpdateDo = DB::table('DORDER_BODY')->where('COMP_CODE',$compCode)->where('ACC_CODE',$accCode)->where('CP_CODE',$custNo)->where('DORDER_NO',$doNo)->where('DO_WAGON_NO',$wagonNo)->where('REMARK',$itemName)->update($data_body);

					//dd(DB::getQueryLog());

			if($UpdateDo){

	      			$response_array['response'] = 'success';
	      			$data = json_encode($response_array);  
			        print_r($data);

	            }else{

	            	$response_array['response'] = 'error';
	      			$data = json_encode($response_array);  
			        print_r($data);
	            }
		}

		     

}


public function inwardDoChangeDestInward(Request $request){

     	$company_name = $request->session()->get('company_name');
	    $getcomcode   = explode('-', $company_name);
	    $compCode     = $getcomcode[0];
	    $fisYear      = $request->session()->get('macc_year');
		
		$to_place     = $request->input('to_place');
		$bodyid     = $request->input('flitClass');

		$count = count($bodyid);
	
		$response_array = array();

		//print_r($bodyid);exit;

		if($request->ajax()) {


			/*print_r($bodyid);
			echo '<pre>';
			print_r($to_place);
			echo '<pre>';
			print_r($count);*/

			//exit;

				for($i = 0; $i < $count; $i++) {

					$data_body = array(

						'TO_PLACE'  => $to_place
					);

				   $UpdateDo = DB::table('DORDER_BODY')->where('DORDERBID',$bodyid[$i])->update($data_body);
				}



					//DB::enableQueryLog();

					/*$UpdateDo = DB::table('DORDER_BODY')->where('COMP_CODE',$compCode)->where('ACC_CODE',$accCode)->where('CP_CODE',$custNo)->where('DORDER_NO',$doNo)->where('DO_WAGON_NO',$wagonNo)->where('REMARK',$itemName)->update($data_body);*/

					//dd(DB::getQueryLog());

			if($UpdateDo){

	      			$response_array['response'] = 'success';
	      			$data = json_encode($response_array);  
			        print_r($data);

	            }else{

	            	$response_array['response'] = 'error';
	      			$data = json_encode($response_array);  
			        print_r($data);
	            }
		}

		     

}

   /* .... END : Cancel Delivery Order.... */


   // START : FREIGHT TYPE MASTER

   public function FreightTypeMaster(Request $request){

	 	$title = 'Freight Type Master';

	 	$compName = $request->session()->get('company_name');

	 	$freighttype_code = $request->old('freighttype_code');
		
		$freighttype_name = $request->old('freighttype_name');
		
	    $button='Save';
	 	
	 	$action='/logistic-transportation/master/save-freight-type-master';

	    if(isset($compName)){

	    	return view('admin.finance.master.Logistic.add_freight_type',compact('title','button','action','freighttype_code','freighttype_name'));

	    }else{

			return redirect('/useractivity');
		}

	}

	public function FreightTypeSave(Request $request){
        
	    $validate = $this->validate($request, [

			'freighttype_code' => 'required|max:6|unique:MASTER_FREIGHTTYPE,FREIGHTTYPE_CODE',
			'freighttype_name' => 'required|max:40',

		]);


	 	$createdBy 	= $request->session()->get('userid');

	 	$compName 	= $request->session()->get('company_name');

	 	$fisYear 	=  $request->session()->get('macc_year');
	   
	    $data = array(

	   		"FREIGHTTYPE_CODE"  => $request->input('freighttype_code'),
			"FREIGHTTYPE_NAME"  => $request->input('freighttype_name'),
			"FREIGHTTYPE_BLOCK" => 'NO',
			"FLAG"        => '0',
			"CREATED_BY"  => $createdBy,
				
		);

	    $saveData = DB::table('MASTER_FREIGHTTYPE')->insert($data);

	    if ($saveData) {

			$request->session()->flash('alert-success', 'Freight type Was Successfully Added...!');
			
			return redirect('/logistic-transportation/master/view-freight-type-master');

		}else{

			$request->session()->flash('alert-error', 'Freight type Can Not Added...!');
			
			return redirect('/logistic-transportation/master/view-freight-type-master');

		}

	}

	public function FreightTypeView(Request $request){

	    $compName = $request->session()->get('company_name');

		if($request->ajax()){
	      
	        $title    = 'View Freight Type Master';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

		    if($userType=='admin'){

		    	$data = DB::table('MASTER_FREIGHTTYPE')->orderBy('FREIGHTTYPE_CODE','DESC');

	        }else if ($userType=='superAdmin' || $userType=='user'){    		

		    	$data = DB::table('MASTER_FREIGHTTYPE')->orderBy('FREIGHTTYPE_CODE','DESC');

		    }else{
		    		$data ='';
		    }

		    return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

	    }

		if(isset($compName)){
	    	
	    	return view('admin.finance.master.Logistic.view_freight_type');
		
		}else{

			return redirect('/useractivity');
		}
	}

	public function EditFreightType($freight_code){

	    $title = 'Edit Freight Type Master';

	    $freightType_code = base64_decode($freight_code);
	    
	    if($freightType_code!=''){

	 	    $query = DB::table('MASTER_FREIGHTTYPE');
			$query->where('FREIGHTTYPE_CODE', $freightType_code);
			$classData= $query->get()->first();

			$freighttype_code = $classData->FREIGHTTYPE_CODE;

			$freighttype_name = $classData->FREIGHTTYPE_NAME;

			$freighttype_block = $classData->FREIGHTTYPE_BLOCK;

			$button='Update';

			$action='/logistic-transportation/master/update-freight-type-master';

			return view('admin.finance.master.Logistic.add_freight_type',compact('title','freighttype_code','freighttype_name','freighttype_block','button','action'));
		
		}else{
			
			$request->session()->flash('alert-error', 'Freight Type Code Not Found...!');
			
			return redirect('/logistic-transportation/master/view-freight-type-master');
		}

	}

	public function FreightTypeUpdate(Request $request){

		$validate = $this->validate($request, [

			'freighttype_code' => 'required',
			'freighttype_name' => 'required|max:40',

		]);

		$id = $request->input('freighttype_code');

		date_default_timezone_set('Asia/Kolkata');
        $updatedDate = date("Y-m-d H:i:s");
		//$updatedDate = date("Y-m-d");
		
		$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

		 $data = array(

			"FREIGHTTYPE_CODE"  => $request->input('freighttype_code'),
			"FREIGHTTYPE_NAME"  => $request->input('freighttype_name'),
			"FREIGHTTYPE_BLOCK" => $request->input('freighttype_block'),
			"FLAG"              => '0',
			"LAST_UPDATE_BY"    => $createdBy,
			"LAST_UPDATE_DATE"    => $updatedDate,
				
		);
		
		try{

			$saveData = DB::table('MASTER_FREIGHTTYPE')->where('FREIGHTTYPE_CODE', $id)->update($data);

			if($saveData){

				$request->session()->flash('alert-success', 'Freight Type Was Successfully Updated...!');
				
				return redirect('/logistic-transportation/master/view-freight-type-master');

			}else{

				$request->session()->flash('alert-error', 'Freight Type Can Not Added...!');
				
				return redirect('/logistic-transportation/master/view-freight-type-master');

			}

		}catch(Exception $ex){

			$request->session()->flash('alert-error', 'Employee Grade Can not be Updated...! Used In Another Transaction...!');
			
			return redirect('/Master/Employee/View-Emp-Grade-Mast');
		}


	}

/*----------- START : APPROVE TRIP MARKET -------- */

	public function ApproveTripMarket(Request $request){

        $title       ='Add Arrove Trip Market';
        $compDetails = $request->session()->get('company_name');
        $splitData   = explode('-',$compDetails);
        $comp_code   = $splitData[0];
        $fisYear  =  $request->session()->get('macc_year');

       // $userdata['vehicleTripNo']   = DB::table('TRIP_HEAD')->where('COMP_CODE',$comp_code)->where('PLAN_STATUS','1')->where('OWNER','MARKET')->where('BILL_STATUS','0')->get();

        $userdata['vehicleTripNo']   = DB::select("SELECT * FROM TRIP_HEAD WHERE COMP_CODE='$comp_code' AND PLAN_STATUS='1' AND BILL_STATUS='0' AND OWNER IN ('MARKET','DUMP','SELF') ");

        $userdata['plant_list']      = DB::table('MASTER_PLANT')->where('COMP_CODE',$comp_code)->get();

        $userdata['area_list']       = DB::table('MASTER_CITY')->get();
        $userdata['vehicle_list']    = DB::table('MASTER_FLEET')->get();
        $userdata['fpo_list']    = DB::table('FPO_HEAD')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get();
        $userdata['transport_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();

        $userdata['freightType_list'] = DB::table('MASTER_FREIGHTTYPE')->get();
        $userdata['wheel_list']      = DB::table('MASTER_FLEETTRUCK_WHEEL')->get();

        if(isset($compDetails)){
            return view('admin.finance.transaction.logistic.approve_trip_market',$userdata+compact('title'));
        }else{
            return redirect('/useractivity');
        }
        
    }

    public function GetDetailsFromTrip(Request $request){

        $tblid = $request->input('tblHeadID');

        if ($request->ajax()) {

            $trip_transBody = DB::select("SELECT A.SERIES_CODE AS HSERIES_CODE,A.SERIES_NAME AS HSERIES_NAME,A.ACC_CODE,A.ACC_NAME,A.VRDATE,A.PLANT_CODE,A.PLANT_NAME,A.FSO_RATE,A.VEHICLE_NO AS HVEHICLE_NO,A.VRNO AS HVRNO,A.ACC_CODE AS HACCODE,A.ACC_NAME AS HACCNAME,A.PFCT_CODE AS HPFCTCODE,A.PFCT_NAME AS HPFCTNAME,A.FROM_PLACE AS HFROMPLACE,A.TO_PLACE AS HTOPLACE,A.TRIP_DAY,A.OFF_DAY,A.OWNER,A.VEHICLE_TYPE AS VEHICLETYPE,A.TRANSPORT_CODE,A.TRANSPORT_NAME,A.FPO_NO,A.FREIGHT_QTY,A.FPO_RATE,A.AMOUNT,A.PAYMENT_MODE,A.ADV_TYPE,A.ADV_RATE,A.ADV_AMT,A.TRIP_EXPENSE,A.WHEELTYPE_CODE,A.WHEELTYPE_NAME,A.MIN_GUARANTEE,A.MODEL,B.* FROM TRIP_HEAD A,TRIP_BODY B WHERE A.TRIPHID=B.TRIPHID AND A.TRIPHID='$tblid'");
            
            if ($trip_transBody) {

                $response_array['response']  = 'success';
                $response_array['data_body'] = $trip_transBody;
                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response']  = 'error';
                $response_array['data_body'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
                
            }

        }else{

                $response_array['response']  = 'error';
                $response_array['data_body'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
        }

    }

    public function UpdateApproveTripMarket(Request $request){

        $createdBy    = $request->session()->get('userid');
        $compName     = $request->session()->get('company_name');
        $compcode     = explode('-', $compName);
        $getcompcode  = $compcode[0];
        $fisYear      =  $request->session()->get('macc_year');
        $trip_headId  = $request->input('upTrip_headId');

        DB::beginTransaction();

        try {

            $data = array(
                
                "VEHICLE_NO"     => $request->input('vehicle_no'),
                "OWNER"          => $request->input('vehicle_owner'),
                "VEHICLE_TYPE"   => $request->input('vehicle_type'),
                "VEHICLE_TYPE_NAME"   => $request->input('vehicleType_name'),
                "WHEELTYPE_CODE" => $request->input('whee_type_code'),
                "WHEELTYPE_NAME" => $request->input('whee_type_name'),
                "MIN_GUARANTEE"  => $request->input('min_gurrentee'),
                "TRANSPORT_CODE" => $request->input('transporter_code'),
                "TRANSPORT_NAME" => $request->input('transporter_name'),
                "FPO_NO"         => $request->input('fright_order'),
                "FREIGHT_QTY"    => $request->input('freight_qty'),
                "FPO_RATE"       => $request->input('rate'),
                "AMOUNT"         => $request->input('amount'),
                "PAYMENT_MODE"   => $request->input('payment_mode'),
                "ADV_TYPE"       => $request->input('adv_type'),
                "ADV_RATE"       => $request->input('adv_rate'),
                "ADV_AMT"        => $request->input('adv_amount'),
                "TRIP_EXPENSE"   => $request->input('trip_expense'),
                "MODEL"          => $request->input('vehicle_model'),
                "LAST_UPDATE_BY" => $createdBy,

            );

            DB::table('TRIP_HEAD')->where('TRIPHID',$trip_headId)->update($data);

            DB::commit();
            $data['response'] = 'success';
            $getalldata = json_encode($data);  
            print_r($getalldata);

        }catch (\Exception $e) {

            DB::rollBack();
           // throw $e;
            $data['response'] = 'error';
            $getalldata = json_encode($data);  
            print_r($getalldata);

        }
    }

/*----------- END : APPROVE TRIP MARKET -------- */

	// public function FreightTypeDelete(Request $request){

	// 	$costcat = $request->input('costcat');
	    	
	//     if ($costcat!='') {
	    	
	//     	try{

	//     		$Delete = DB::table('MASTER_GRADE')->where('GRADE_CODE', $costcat)->delete();

	// 			if ($Delete) {

	// 				$request->session()->flash('alert-success', 'Employee 
	// 				Grade Was Deleted Successfully...!');
					
	// 				return redirect('Master/Employee/View-Emp-Grade-Mast');

	// 			}else{

	// 				$request->session()->flash('alert-error', 'Employee Grade Can Not Deleted...!');
					
	// 				return redirect('Master/Employee/View-Emp-Grade-Mast');

	// 			}

	// 		}catch(Exception $ex){

	// 			    $request->session()->flash('alert-error', 'Employee Grade Can not be Deleted...! Used In Another Transaction...!');
					 
	// 				 return redirect('/finance/view-employee-grade-master');
	// 		}

	//     }else{

	//     	$request->session()->flash('alert-error', 'Zone  Not Found...!');
			
	// 		return redirect('/finance/view-employee-grade-master');

	//     }

	// }

   // END : FREIGHT TYPE MASTER

/* --------- START : TRANSPORT BILL POSTING -------------- */
	
	public function SaveInPartyBill(Request $request){

	    $company_name = $request->session()->get('company_name');
	    $getcomcode   = explode('-', $company_name);
	    $compCode     = $getcomcode[0];
	    $fisYear      = $request->session()->get('macc_year');
	    $createdBy    = $request->session()->get('userid');


	   // print_r($request->post());exit;
	    

	    if ($request->ajax()) {

	    	$checkchebox = $request->flitClass;
			$trans_code     = $request->trans_code;
			$series_code    = $request->series_code;
			$series_name    = $request->series_name;
			$seriesGlCd     = $request->seriesGlCd;
			$seriesGlName   = $request->seriesGlName;
			$partyPostCd    = $request->partyPostCd;
			$partyPostName  = $request->partyPostName;
			$NetAmnt        = $request->NetAmnt;
			$taxCode        = $request->taxCode;
			$transport_code = $request->acct_code;
			$transport_name = $request->acct_name;
			$taxIndCode     = $request->taxIndCode;
			$rate_indName   = $request->rate_indName;
			$af_rate        = $request->af_rate;
			$taxamount      = $request->amount;
			$taxGlCode      = $request->taxGlCode;
			$taxRowCount    = $request->taxRowCount;
			$pdfYesNoStatus = $request->pdfYesNoStatus;
			$pfctcode       = $request->pfct_code;
			$pfctname       = $request->pfct_name;
			$pay_vr_date    = $request->vrdate;
			$basic_amnt     = $request->basic_amnt;
			$tds_deductAmt  = $request->tds_deductAmt;
			$tds_gl_code    = $request->tdsglCode;
			$taxAply        = $request->taxApplyChk;
			$tdsApply       = $request->tdsApplyChk;
			$vehicleType    = $request->vehicle_type;
			$tdsRate        = $request->tdsRate;
			$donwloadStatus   = $request->pdfYesNoStatus;
			//print_r($vehicleType);exit;
			$getcountid = count($checkchebox);

			$getvrno =  DB::table('MASTER_VRSEQ')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->get()->first();

	        if($getvrno==''){
	          $last_no = 1;
	        }else{
	          $last_no = $getvrno->LAST_NO;
	        }

	        $getJvVrno =  DB::table('JV_TRAN')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('VRNO',$last_no)->get()->first();

	        if($getJvVrno){
	          $JvVrNo = $getJvVrno->VRNO + 1;
	        }else{
	          $JvVrNo = $last_no;
	        }

			DB::beginTransaction();
    		try {

    			DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->delete();
    			/* -------- CHECK VEHICLE TYPE -------- */
    			if($vehicleType == 'SELF'){

    				$check_Exist_SELF = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->get()->toArray();

    				if(empty($check_Exist_SELF)){

    					$tripHead_Idself = array();

    					for ($g = 0; $g <count($checkchebox); $g++) {

    						$split_Id =  explode('~', $checkchebox[$g]);
            				$tbodyId = $split_Id[0];

            				$body_data = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.BASIC_AMT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_HEAD.DRIVER_NAME,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIPBID='$tbodyId'");

            				foreach($body_data as $trows){

								$tripHead_Idself[] = $trows->TRIPHID;
								$freightAmt        = $trows->TRIP_FREIGHT_AMT;
								$addLessCharge     = $trows->ADD_LESS_CHRG;
								$basicAmnt         = $trows->BASIC_AMT;

	            			}/*/. FOREACH LOOP*/

    					}/* -- CHECKBOX CHECK LOOP*/


    					/* --------- trip charges ----------- */

    					for($r=0;$r<count($tripHead_Idself);$r++){

    						$triChargeDataSelf = DB::table('TRIP_CHARGE_EXP')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRIPHID',$tripHead_Idself[$r])->where('CREATED_BY',$createdBy)->get();

    						//echo "<PRE>";print_r($triChargeDataSelf);exit;

    						foreach($triChargeDataSelf as $charge){

    							/* ----- CHECK GL IS BLANK IN CHARGE ------ */

				        		if(($charge->GL_CODE == '') || ($charge->GL_CODE == null)){

				        		}else{

				        			if($charge->INDEX_NAME ==  'M'){
					        			$drAmtch = $charge->AMOUNT;
					        			$crAmtch = 0.00;
					        		}else if($charge->INDEX_NAME ==  'L'){
					        			$drAmtch = $charge->AMOUNT;
					        			$crAmtch = 0.00;
					        		}else{
					        			$drAmtch = 0.00;
					        			$crAmtch = 0.00;
					        		}

					        		$checkGlExist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->where('IND_GL_CODE',$charge->GL_CODE)->get()->first();
					        		/*echo "<PRE>";
					        		print_r($checkGlExist);*/
					        		if($checkGlExist){

					        			$drAmt_gl   = $checkGlExist->DR_AMT;

										$addWith_Dr = $drAmt_gl+$drAmtch;

										$updateData   = array(
						                    'DR_AMT'      => $addWith_Dr,
						                );

										DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->where('IND_GL_CODE',$charge->GL_CODE)->update($updateData);

					        		}else{

					        			$chargeData   = array(

						                    'DR_AMT'      => $drAmtch,
						                    'CR_AMT'	  => 0.00,
						                    'IND_GL_CODE' => $charge->GL_CODE,
						                    'TCFLAG'      => 'LSTB',
						                    'GLACC_Chk'	  => 'GL',
						                    'CREATED_BY'  => $createdBy,
					                	);


					                	DB::table('INDICATOR_TEMP')->insert($chargeData);

					        		}

				        		}
				        		/* ----- CHECK GL IS BLANK IN CHARGE ------ */

    						}/* /.foreach loop*/

    					}/*/.get multiple data of headid*/

    					/* --------- trip charges ----------- */

    					/* -------- account credit --------*/

	            			$accData = array(

								'IND_CODE'    => '',
								'DR_AMT'      => '',
								'CR_AMT'      => $NetAmnt,
								'IND_GL_CODE' => $partyPostCd,
								'TCFLAG'      => 'LSTB',
								'GLACC_Chk'   => 'ACC',
								'CREATED_BY'  => $createdBy,
				            );

				            DB::table('INDICATOR_TEMP')->insert($accData);

	            		/* -------- account credit --------*/

    				}
    				/* ---- CHECK DATA IS IN INDICATOR ---- */

    			}else{

    				$check_Exist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->get()->toArray();


	    			if(empty($check_Exist)){

	    				$tripHead_Id =array();

	    				// if tax apply 
	    				if($taxAply ==1){
	    					// tax row count
	    					for($l=0;$l<$taxRowCount;$l++){

								$rateindex   = $rate_indName[$l];
								$taxamt      = $taxamount[$l];
								$tax_gl_code = $taxGlCode[$l];
								$uniqCheck   = $taxIndCode[$l];

								$checkExist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->get()->toArray();

								$indData = DB::table('INDICATOR_TEMP')->where('IND_CODE',$uniqCheck)->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->get()->toArray();

								if($taxamt !=0.00){

									if($rateindex == 'Z'){

	                          		}else{

	                          			if(empty($checkExist)){

			                                 $idary = array(
			                                      'IND_CODE'    => $uniqCheck,
			                                      'DR_AMT'      => $basic_amnt,
			                                      'CR_AMT'      => '',
			                                      'IND_GL_CODE' => $seriesGlCd,
			                                      'TCFLAG'      => 'LSTB',
			                                      'GLACC_Chk'   => 'GL',
			                                      'CREATED_BY'  => $createdBy,
			                                  
			                                );
			                                DB::table('INDICATOR_TEMP')->insert($idary);

		                              	}else  if($tax_gl_code == ''){

		                                  	$bscVal = DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->get()->toArray();

			                                  	$updateId = $bscVal[0]->CREATED_BY;
			                                  	$basicAmt = $bscVal[0]->DR_AMT + $taxamt;
			                              
			                                  	$idary_bsic = array(
			                                      	'DR_AMT'       =>$basicAmt,
			                                      	'CR_AMT'      =>0.00,
			                                  	);

			                                   	DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('TCFLAG','LSTB')->where('CREATED_BY',$createdBy)->update($idary_bsic);

		                              	}else if(empty($indData)){

		                                  	$idary   = array(
			                                      'IND_CODE'    => $uniqCheck,
			                                      'DR_AMT'      => $taxamt,
			                                      'CR_AMT'      => '',
			                                      'IND_GL_CODE' => $tax_gl_code,
			                                      'GLACC_Chk'   => 'GL',
			                                      'TCFLAG'      => 'LSTB',
			                                      'CREATED_BY'  => $createdBy,
			                                      
		                                  	);

		                                  	DB::table('INDICATOR_TEMP')->insert($idary);
		                              	}else{

		                                  	$indData1 = DB::table('INDICATOR_TEMP')->where('IND_CODE',$uniqCheck)->where('TCFLAG','LSTB')->where('CREATED_BY',$createdBy)->get()->first();

		                                  	$newTaxAmt = $indData1->DR_AMT + $taxamt;

		                                  	$idary1 = array(
		                                      	'DR_AMT' => $newTaxAmt,
		                                      	'CR_AMT' =>0.00,
		                                  	);

		                                  	$updatevr = DB::table('INDICATOR_TEMP')->where('IND_CODE',$uniqCheck)->where('TCFLAG','LSTB')->where('CREATED_BY',$createdBy)->update($idary1);
		                              	}

	                          		}/* /. chk index*/

								}/* /. tax amount  not zero*/

	    					} /* /. tax row count*/

	    					$accData = array(

			                      'IND_CODE'     => '',
			                      'DR_AMT'       => '',
			                      'CR_AMT'       => $NetAmnt,
			                      'IND_GL_CODE'  => $partyPostCd,
			                      'TCFLAG'       => 'LSTB',
			                      'GLACC_Chk'    => 'ACC',
			                      'CREATED_BY'   => $createdBy,
		                  	);

		                  	DB::table('INDICATOR_TEMP')->insert($accData);

		                  	/* ----- get head id from tri head ---- */
		                  	for($t=0;$t<count($checkchebox);$t++){

			                    $splitId =  explode('~', $checkchebox[$t]);
			                  	$checkid = $splitId[0];

			                  	$bodydata = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_BODY.TRIPHID FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIP_BODY.TRIPBID='$checkid'");

			                  	foreach($bodydata as $row){
				                    $tripHead_Id[] = $row->TRIPHID;
			                  	}

	                  		}
	                  		/* ----- get head id from tri head ---- */

	    				}else{

	    					// checkbox check count
	    					for ($i = 0; $i <count($checkchebox); $i++) {

			                    $split_Id =  explode('~', $checkchebox[$i]);
			                    $tbodyId = $split_Id[0];

			                    $body_data = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.BASIC_AMT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_HEAD.DRIVER_NAME,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIPBID='$tbodyId'");
			                    
			                    foreach($body_data as $trow){

					                $tripHead_Id[] = $trow->TRIPHID;
					                $freightAmt    = $trow->TRIP_FREIGHT_AMT;
					                $addLessCharge = $trow->ADD_LESS_CHRG;
					                $basicAmnt     = $trow->BASIC_AMT;

			                      	for ($s = 1; $s < 3; ++$s) {

			                        	if($s==1){

			                          		$idary = array(
			                                  	'DR_AMT'      => $freightAmt,
			                                  	'CR_AMT'      => 0.00,
			                                  	'IND_GL_CODE' => $seriesGlCd,
			                                  	'TCFLAG'      => 'LSTB',
			                                  	'GLACC_Chk'   => 'GL',
			                                  	'CREATED_BY'  => $createdBy,
				                              
			                              	);
			                              	DB::table('INDICATOR_TEMP')->insert($idary);

			                        	}else if($s==2){

			                          		$add_chargePos = abs($addLessCharge);
			                    			$crAmt =$freightAmt - $add_chargePos;

			                          		$idary1 = array(
			                            		'IND_CODE'    => $trow->TRIPHID,
			                                  	'DR_AMT'      => 0.00,
			                                  	'CR_AMT'      => $basicAmnt,
			                                  	'IND_GL_CODE' => $partyPostCd,
			                                  	'TCFLAG'      => 'LSTB',
			                                  	'GLACC_Chk'   => 'ACC',
			                                  	'CREATED_BY'  => $createdBy,
			                              
			                              	);
			                              	DB::table('INDICATOR_TEMP')->insert($idary1);

			                        	}
			                      	}

			                    }/* get body data */
			                    
		                  	} /* checkbox check count*/

	    				}/* tax apply*/

	    				/* --------- trip charges ----------- */

		                  	for($r=0;$r<count($tripHead_Id);$r++){

		                    	$triChargeData = DB::table('TRIP_CHARGE_EXP')->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('TRIPHID',$tripHead_Id[$r])->where('CREATED_BY',$createdBy)->get();

		                    	foreach($triChargeData as $charge){

		                    	/* ----- CHECK GL IS BLANK IN CHARGE ------ */

		                    		if(($charge->GL_CODE == '') || ($charge->GL_CODE == null)){

			                      		$checkExist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->where('IND_CODE',$tripHead_Id[$r])->get()->first();
			                    
			                      		$seriescrAmt = $checkExist->CR_AMT + abs($charge->AMOUNT);

			                      		$updateData   = array(
			                              	'CR_AMT'      => $seriescrAmt,
			                          	);

			                          	DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','LSTB')->where('IND_CODE',$tripHead_Id[$r])->update($updateData);

		                    		}else{

				                      	if($charge->INDEX_NAME ==  'M'){
					                        $crAmtch = abs($charge->AMOUNT);
					                        $drAmtch = 0.00;
				                      	}else if($charge->INDEX_NAME ==  'L'){
					                        $drAmtch = $charge->AMOUNT;
					                        $crAmtch = 0.00;
				                      	}else{
					                        $crAmtch = 0.00;
					                        $drAmtch = 0.00;
				                      	}

		                      			$chargeData   = array(
											'DR_AMT'      => $drAmtch,
											'CR_AMT'      => $crAmtch,
											'IND_GL_CODE' => $charge->GL_CODE,
											'TCFLAG'      => 'LSTB',
											'GLACC_Chk'   => 'GL',
											'CREATED_BY'  => $createdBy,
		                              
		                          		);

		                          		DB::table('INDICATOR_TEMP')->insert($chargeData);

		                    		} 

		                    		/* ----- CHECK GL IS BLANK IN CHARGE ------ */
		                    
		                  		}

		                  	}

		                /* --------- trip charges ----------- */

		                /* ------------- TDS apply ------------ */

		                  	if($tdsApply == 1){

		                    	for ($f = 1; $f < 3; ++$f) {

		                      		if($f == 1){
		                        		$chargeData   = array(
			                              	'DR_AMT'      => $tds_deductAmt,
			                              	'CR_AMT'      => 0.00,
			                              	'IND_GL_CODE' => $partyPostCd,
			                              	'TCFLAG'      => 'LSTB',
			                              	'GLACC_Chk'   => 'ACC',
			                              	'CREATED_BY'  => $createdBy,
		                          		);

		                          		DB::table('INDICATOR_TEMP')->insert($chargeData);
		                      		}else if($f==2){
		                       	 		$chargeData   = array(
			                              	'DR_AMT'      => 0.00,
			                              	'CR_AMT'      => $tds_deductAmt,
			                              	'IND_GL_CODE' => $tds_gl_code,
			                              	'TCFLAG'      => 'LSTB',
			                              	'GLACC_Chk'   => 'GL',
		                              		'CREATED_BY'  => $createdBy,
		                          		);

		                          		DB::table('INDICATOR_TEMP')->insert($chargeData);
		                      		}
		                      
		                    	}
		                  	}
		                /* ------------- TDS apply ------------ */

	    			}/* /. chck exist*/

    			} /* /. CHECK VEHICLE TYPE*/

    			/* ------- CHECK VEHICLE TYPE ---------- */

    			$response_array = array();

           	 	$allBillData = DB::select("SELECT t1.*,t2.GL_NAME as glName,t3.ACC_NAME AS accName FROM INDICATOR_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE LEFT JOIN MASTER_ACC t3 ON t3.ACC_CODE =t1.IND_ACC_CODE WHERE t1.CREATED_BY='$createdBy' AND t1.TCFLAG='LSTB'");

           	 	/* ------------start : insert data in jv/acc/gl ------------- */

           	 	for($g=0;$g<count($allBillData);$g++){

           	 		$blankVal='';
           	 		$slno = $g+1;
           	 		$perticulerText='';
					$drAmt     = $allBillData[$g]->DR_AMT;
					$crAmt     = $allBillData[$g]->CR_AMT;
					$gl_code   = $allBillData[$g]->IND_GL_CODE;
					$gl_name   = $allBillData[$g]->glName;
					$chk_glAcc = $allBillData[$g]->GLACC_Chk;

           	 		$jvOne = (new AccountingController)->InsertInJournalTran($compCode,$fisYear,$pfctcode,$pfctname,$trans_code,$series_code,$series_name,$JvVrNo,$slno,$pay_vr_date,$transport_code,$transport_name,$gl_code,$gl_name,$perticulerText,$drAmt,$crAmt,$blankVal,$blankVal,$blankVal,$blankVal,$createdBy);

           	 		$resultgl = (new AccountingController)->GlTEntry($compCode,$fisYear,$trans_code,$series_code,$JvVrNo,$slno,$pay_vr_date,$pfctcode,$gl_code,$gl_name,$transport_code,$transport_name,$blankVal,$blankVal,$blankVal,$blankVal,$drAmt,$crAmt,$perticulerText,$createdBy);
           	 		if($chk_glAcc == 'ACC'){

           	 			$result = (new AccountingController)->AccountTEntry($compCode,$fisYear,$trans_code,$series_code,$JvVrNo,$slno,$pay_vr_date,$pfctcode,$transport_code,$transport_name,$gl_code,$gl_name,$blankVal,$blankVal,$blankVal,$blankVal,$drAmt,$crAmt,$perticulerText,$createdBy);
           	 		}

           	 	}

           	 	$tripIdCount =count($tripHead_Id);

           	 	//print_r($tripHead_Id);exit();

           	 	for ($k = 0; $k < $tripIdCount; $k++) {


           	 		$datatripstatus =array(

           	 				'PBILL_STATUS'=>'1',
           	 		);

              	  DB::table('TRIP_HEAD')->where('TRIPHID',$tripHead_Id[$k])->update($datatripstatus);
           	 		
           	 	}
           	 	           	 	

           	 	/* ------------end : insert data in jv/acc/gl ------------- */

           	 	$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->get()->toArray();
		
				if(empty($checkvrnoExist)){

					$datavrnIn =array(
						'COMP_CODE'   =>$compCode,
						'FY_CODE'     =>$fisYear,
						'TRAN_CODE'   =>$trans_code,
						'SERIES_CODE' =>$series_code,
						'FROM_NO'     =>1,
						'TO_NO'       =>99999,
						'LAST_NO'     =>$JvVrNo,
						'CREATED_BY'  =>$createdBy,
					);

					DB::table('MASTER_VRSEQ')->insert($datavrnIn);

				}else{
					$datavrn =array(
						'LAST_NO'=>$JvVrNo
					);
					DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->update($datavrn);
				}




    			DB::commit();

	    		$data1['response'] = 'success';

	    		if($donwloadStatus == 1){

	    			//print_r($checkchebox);exit;

	    			$pdfPageName='BILL POSTING';

	    			return $this->GeneratePdfForTransportBillPosting($createdBy,$compCode,$pdfPageName,$trans_code,$JvVrNo,$pay_vr_date,$tds_deductAmt,$tripHead_Id,$checkchebox,$tdsRate);

	    			
					}else{}

		        $getalldata = json_encode($data1);  
		        print_r($getalldata);

        	}catch (\Exception $e) {

		        DB::rollBack();
		        throw $e;
		        $data1['response'] = 'error';
		        $getalldata = json_encode($data1);  
		        print_r($getalldata);
    		}

	    }/* /. AJAX*/

	} /* /. MAIN FUNCTION */


	public function GeneratePdfForTransportBillPosting($userId,$getcom_code,$pdfName,$tCode,$JvVrNo,$pay_vr_date,$tds_deductAmt,$tripHead_Id,$checkchebox,$tdsRate){


	$response_array = array();

	/*$dataheadB = DB::SELECT("SELECT A.*,B.*,A.VEHICLE_NO AS vehicleNoHead,C.ADD1,C.CITY_NAME,C.DIST_NAME,C.CONTACT_NO,C.CONTACT_PERSON,C.GST_NUM FROM TRIP_HEAD A,TRIP_BODY B,MASTER_ACCADD C WHERE A.TRIPHID=B.TRIPHID AND A.ACC_CODE = C.ACC_CODE AND A.TRIPHID='$headId'");

	
*/

	//print_r($bodyId);exit;

	/*$dataheadB = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_HEAD.PLANT_CODE,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_HEAD.DRIVER_NAME,TRIP_HEAD.VEHICLE_NO AS vehicleNo,TRIP_HEAD.VEHICLE_TYPE,TRIP_HEAD.ARRIVAL_DATE,TRIP_HEAD.FPO_NO,TRIP_HEAD.TRIP_DAY,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIP_BODY.TRIPBID='$bodyId'");

	print_r($dataheadB);exit;*/
		
		
			$dataheadB=array();
			$dataTripCharges=array();

	     for ($h = 0; $h <count($checkchebox); $h++) {
    						$splitb_Id =  explode('~', $checkchebox[$h]);
            				$btbodyId = $splitb_Id[0];

            				//print_r($btbodyId);

            	$datahead = DB::select("SELECT TRIP_HEAD.TRIPHID,TRIP_HEAD.PLANT_CODE,TRIP_HEAD.ACC_CODE AS accCode,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.FPO_RATE,TRIP_HEAD.AMOUNT,TRIP_HEAD.VRDATE as VrDate,TRIP_HEAD.VEHICLE_NO AS VehicleNo,TRIP_HEAD.TO_PLACE,TRIP_HEAD.PFCT_CODE as pfctCode,TRIP_HEAD.SERIES_NAME as seriesName,TRIP_HEAD.TRIP_FREIGHT_AMT,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.ADD_LESS_CHRG,TRIP_HEAD.LESS_ADVANCE,TRIP_HEAD.NET_AMOUNT,TRIP_HEAD.BASIC_AMT,TRIP_HEAD.PFCT_NAME as pfctName,TRIP_HEAD.DRIVER_NAME,TRIP_HEAD.VEHICLE_NO AS vehicleNo,TRIP_HEAD.VEHICLE_TYPE,TRIP_HEAD.ARRIVAL_DATE,TRIP_HEAD.FPO_NO,TRIP_HEAD.TRIP_DAY,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIP_BODY.TRIPBID='$btbodyId'");

            	//print_r($datahead);

            	foreach($datahead as $key) {

            		//print_r($key);
            		array_push($dataheadB,$key);


            		
            	}

            $trippHid = $dataheadB[$h]->TRIPHID;

            $datachargeB = DB::SELECT("SELECT TRIP_CHARGE_EXP.*,TRIP_HEAD.TRIPHID as tripHid FROM TRIP_CHARGE_EXP LEFT JOIN TRIP_HEAD ON TRIP_HEAD.TRIPHID = TRIP_CHARGE_EXP.TRIPHID WHERE TRIP_CHARGE_EXP.TRIPHID = '$trippHid'");
            	
            	//print_r($dataTripCharges);

            	foreach($datachargeB as $row) {

            		//print_r($key);
            		array_push($dataTripCharges,$row);


            		
            	}

            }
            
//exit;

      $accCode = $dataheadB[0]->ACC_CODE;
      $consiner = $dataheadB[0]->CP_CODE;
      $plant_code = $dataheadB[0]->PLANT_CODE;
      $tripheadId = $dataheadB[0]->TRIPHID;

	
      //print_r($consiner);exit;

      $dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE AS ACCCODE,MASTER_ACC.ACC_NAME AS ACCNAME,MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

        $consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.ACC_CODE = '$consiner'");

        //print_r($consinerDetail);exit;
     // dd(DB::getQueryLog());
	
		
		$compDetail = DB::SELECT("SELECT A.*,B.COMP_NAME,B.COMP_CODE FROM `MASTER_PLANT` A,MASTER_COMP B WHERE A.COMP_CODE=B.COMP_CODE AND B.COMP_CODE='$getcom_code' AND A.PLANT_CODE='$plant_code'");

		header('Content-Type: application/pdf');
		

			$pdf = PDF::loadView('admin.finance.transaction.logistic.transporter_bill_posting_PDF',compact('pdfName','compDetail','dataheadB','dataAccDetail','consinerDetail','pay_vr_date','JvVrNo','tds_deductAmt','dataTripCharges','tdsRate'));

		
		
		$path        = public_path('dist/coldStoragePDF'); 
		$fileName    =  time().'.'. 'pdf' ;
		$pdf->save($path . '/' . $fileName);
		$PublicPath  = url('public/dist/coldStoragePDF/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url']      = $downloadPdf;
		$response_array['data']     = $dataheadB;
		echo $data = json_encode($response_array);

	}

	public function billtaxWithPosting($allBillData,$compCode,$fisYear,$pfctcode,$pfctname,$trans_code,$series_code,$JvVrNo,$pay_vr_date,$createdBy){

		echo '<PRE>';
		print_r($allBillData);

		
	}

	// Excel delivery order

    public function getExcelConfigData(Request $request){


    	$exconfig_code = $request->input("do_excel_cd");

    	$dt    = date("Y-m-d");
        $expd  = explode('-',$dt);
        $y     = $expd[0];
        $m     = $expd[1];
        $d     = $expd[2];
        $num   =  rand(10,10000);

    	//print_r($exconfig_code);exit;

         $response = Excel::download(New DeliveryOrderExport($exconfig_code), $exconfig_code.$y.$m.$d.'-'.$num.'.xlsx', \Maatwebsite\Excel\Excel::XLSX);

         ob_end_clean();

    	return $response; 
       


    }

    public function NewSupplimentryTrnas(Request $request){
      
		$CompanyCode              = $request->session()->get('company_name');
		$compcode                 = explode('-', $CompanyCode);
		$getcompcode              =$compcode[0];
		$macc_year                = $request->session()->get('macc_year');
		
		$title                    ='Change Vehicle LR Transaction';

		$userData['truck_list']   = DB::table('MASTER_FLEET')->get();
		/*$userData['trip_list']    = DB::table('TRIP_HEAD')->where('GATE_OUT_STATUS','0')->where('LR_STATUS','0')->get();
		$userData['old_truck_list']   = DB::table('TRIP_HEAD')->where('GATE_OUT_STATUS','0')->where('LR_STATUS','0')->get()*/;
		
		$userData['trip_list']    = DB::table('TRIP_HEAD')->get();
		$userData['old_truck_list']   = DB::table('TRIP_HEAD')->get();

		
		return view('admin.finance.transaction.logistic.new_supplimentry_trans',$userData+compact('title'));
    }

        public function NewConsineeTrnas(Request $request){
        	
		$CompanyCode              = $request->session()->get('company_name');
		$compcode                 = explode('-', $CompanyCode);
		$getcompcode              =$compcode[0];
		$macc_year                = $request->session()->get('macc_year');
		
		$title                    ='Change Consinee LR Transaction';

		$userData['do_list']   = DB::table('DORDER_BODY')->get();
		$userData['rakeNo_list'] = DB::table('RAKE_TRAN')->groupBy('RAKE_NO')->get();

        $userData['cp_list']   = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')-> get();

		
		return view('admin.finance.transaction.logistic.new_consinee_trans',$userData+compact('title'));
    }


    public function getDataDoNo(Request $request){

    	$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =$compcode[0];
		$macc_year   = $request->session()->get('macc_year');
		$do_code     = $request->input('selectDoNo');
		$rake_No     = $request->input('rakeNo');
		$fieldType   = $request->input('fieldType');

		if ($request->ajax()) {

			if($rake_No && ($fieldType == 'RAKENO')){
				//DB::enableQueryLog();
				$doNoList = DB::table('DORDER_BODY')->where('RAKE_NO',$rake_No)->get();
				//dd(DB::getQueryLog());
				$cpListdata ='';
			}else if($do_code && ($fieldType == 'DONOSL')){

				if($rake_No==''){

					$cpListdata = DB::select("SELECT CP_CODE,CP_NAME FROM DORDER_BODY WHERE DORDER_NO = '$do_code'");
				
					$doNoList   = '';
				}else{

					$cpListdata = DB::select("SELECT CP_CODE,CP_NAME FROM DORDER_BODY WHERE DORDER_NO = '$do_code' AND RAKE_NO='$rake_No'");
					
					$doNoList   = '';
				}
				
			}else{
				$cpListdata = '';
				$doNoList   = '';
			}

			if($doNoList || $cpListdata){

				$response_array['response']     = 'success';
				$response_array['dataDoNoList'] = $doNoList;
				$response_array['dataCpList'] = $cpListdata;
				$data = json_encode($response_array);
				print_r($data);

			}else{

				$response_array['response']     = 'error';
				$response_array['dataDoNoList'] = '';
				$response_array['dataCpList'] = '';
				$data = json_encode($response_array);
				print_r($data);

			}

		}else{
			$response_array['response']     = 'error';
			$response_array['dataDoNoList'] = '';
			$response_array['dataCpList'] = '';
			$data = json_encode($response_array);
			print_r($data);
		}		

	}

    public function getDatanewConsineeAddress(Request $request){

		$CompanyCode     = $request->session()->get('company_name');
		$compcode        = explode('-', $CompanyCode);
		$getcompcode     =$compcode[0];
		$macc_year       = $request->session()->get('macc_year');
		$newConsineeCode = $request->input('newConsineeCode');

	// print_r($newConsineeCode);
	// exit;


	if ($request->ajax()) {

		if($newConsineeCode){

        	$newConsineeAddress = DB::select("SELECT ADD1 FROM MASTER_ACCADD WHERE ACC_CODE ='$newConsineeCode'");
			
		}else{
			$newConsineeAddress ='';
		}


		if($newConsineeAddress){

			$response_array['response']        = 'success';
			$response_array['datacpAddress'] = $newConsineeAddress;
			$data = json_encode($response_array);
			print_r($data);

		}else{

			$response_array['response']        = 'error';
			$response_array['datacpAddress'] = $newConsineeAddress;
			$data = json_encode($response_array);
			print_r($data);

		}

	}

} 

	public function ShipToPartyFun(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$rakeNum   = $request->input('rakeNum');
			$doNum     = $request->input('doNum');
			$batchNo   = $request->input('batchNo');
			$newSpCd   = $request->input('newSpCd');
			$fieldType = $request->input('fieldType');

	    	if($rakeNum && $fieldType=='RAKENO'){
				$orderNoList = DB::table('DORDER_BODY')->where('RAKE_NO', $rakeNum)->get();
				$batchNoList ='';
				$oldSpList   ='';
	    	}else if($rakeNum && $doNum && ($fieldType =='DONO')){
				
				$batchNoList = DB::table('DORDER_BODY')->where('RAKE_NO', $rakeNum)->where('DORDER_NO', $doNum)->get();
			
				$orderNoList = '';
				$oldSpList   ='';
	    	}else if($rakeNum && $doNum && $batchNo && ($fieldType == 'BATCHNO')){
	    		
	    		$oldSpList = DB::table('DORDER_BODY')->where('RAKE_NO', $rakeNum)->where('DORDER_NO', $doNum)->where('BATCH_NO', $batchNo)->groupBy('SP_CODE')->get();
	    	
	    		$batchNoList ='';
	    		$orderNoList = '';

	    	}else{
				$oldSpList   = '';
				$batchNoList ='';
				$orderNoList = '';
	    	}

	    	if($newSpCd && ($fieldType == 'SPADDR')){

	    		$spAddrList = DB::table('MASTER_ACCADD')->where('ACC_CODE', $newSpCd)->get();
	    	}else{
	    		$spAddrList = '';
	    	}

    		if ($batchNoList || $orderNoList || $oldSpList || $spAddrList) {

				$response_array['response']         = 'success';
				$response_array['data_batchNoList'] = $batchNoList;
				$response_array['data_orderNoList'] = $orderNoList;
				$response_array['data_oldSpList']   = $oldSpList;
				$response_array['data_spAddrList']  = $spAddrList;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response']         = 'error';
				$response_array['data_batchNoList'] = '' ;
				$response_array['data_orderNoList'] = '' ;
				$response_array['data_oldSpList']   = '' ;
				$response_array['data_spAddrList']  = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

				$response_array['response']         = 'error';
				$response_array['data_batchNoList'] = '' ;
				$response_array['data_orderNoList'] = '' ;
				$response_array['data_oldSpList']   = '' ;
				$response_array['data_spAddrList']  = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

	}

	public function ConsineeTransUpdate(Request $request){
	  
		$CompanyCode  = $request->session()->get('company_name');
		$splitComp    = explode('-', $CompanyCode);
		$compcode     = $splitComp[0];
		$rake_no      = $request->input('rake_no');
		$doNo         = $request->input('do_no');
		$oldconsg     = $request->input('old_consinee_no');
		$cpAdd        = $request->input('cpAddress');
		$rakeNoSP     = $request->input('rakeNoSP');
		$do_no_sp     = $request->input('do_no_sp');
		$batchNoSP    = $request->input('batchNoSP');
		$old_spcd_SP  = $request->input('old_spcd_SP');
		$oldSpNameSP  = $request->input('oldSpNameSP');
		$newSpCd_SP   = $request->input('newSpCd_SP');
		$newspName_SP = $request->input('newspName_SP');
		$newspAddr_SP = $request->input('newspAddr_SP');
		$funs_type    = $request->input('funs_type');

	    DB::beginTransaction();

		try {


			if($funs_type == 'SOLD_TO_PARTY'){
			   	
			   	if($rake_no){

					$data = array(

				    	'CP_CODE' => $request->input('new_Consinee_no'),
				        'CP_NAME' => $request->input('new_Consinee_name'),
				    );

				    $updateData = DB::table('DORDER_BODY')->where('COMP_CODE',$compcode)->where('DORDER_NO',$doNo)->where('RAKE_NO',$rake_no)->where('CP_CODE',$oldconsg)->update($data);

				    $data1 = array(

						'CP_CODE' => $request->input('new_Consinee_no'),
						'CP_NAME' => $request->input('new_Consinee_name'),
						'CP_ADD'  => $request->input('cpAddress'),
				    );

				    DB::table('CFOUTWARD_TRAN')->where('COMP_CODE',$compcode)->where('DORDER_NO',$doNo)->where('RAKE_NO',$rake_no)->where('CP_CODE',$oldconsg)->update($data1);

				    $data2 = array(

						'CP_ADDRESS' => $request->input('cpAddress'),
						'CP_CODE'    => $request->input('new_Consinee_no'),
						'CP_NAME'    => $request->input('new_Consinee_name'),
				    );

			    	DB::table('TRIP_BODY')->where('RAKE_NO', $rake_no)->where('DO_NO', $doNo)->where('CP_CODE', $oldconsg)->update($data2);

				}else{

					$data = array(

			    	'CP_CODE' => $request->input('new_Consinee_no'),
			        'CP_NAME' => $request->input('new_Consinee_name'),
				    );

				    $updateData = DB::table('DORDER_BODY')->where('DORDER_NO',$doNo)->where('CP_CODE',$oldconsg)->update($data);

				    $data1 = array(

						'CP_ADDRESS' => $request->input('cpAddress'),
						'CP_CODE'    => $request->input('new_Consinee_no'),
						'CP_NAME'    => $request->input('new_Consinee_name'),
				    );

			    	$updateDataTo = DB::table('TRIP_BODY')->where('DO_NO', $doNo)->where('CP_CODE', $oldconsg)->update($data1);

				}/* /. check rake no */

		    }else if($funs_type == 'SHIP_TO_PARTY'){

		    	$dataSP = array(
					'SP_CODE' => $request->input('newSpCd_SP'),
					'SP_NAME' => $request->input('newspName_SP'),
					'SP_ADD'  => $request->input('newspAddr_SP')
		    	);

		    	DB::table('DORDER_BODY')->where('RAKE_NO',$rakeNoSP)->where('DORDER_NO',$do_no_sp)->where('BATCH_NO',$batchNoSP)->where('SP_CODE',$old_spcd_SP)->update($dataSP);
		    	DB::table('TRIP_BODY')->where('RAKE_NO',$rakeNoSP)->where('DO_NO',$do_no_sp)->where('BATCH_NO',$batchNoSP)->where('SP_CODE',$old_spcd_SP)->update($dataSP);
		    	DB::table('CFOUTWARD_TRAN')->where('RAKE_NO',$rakeNoSP)->where('ORDER_NO',$do_no_sp)->where('BATCH_NO',$batchNoSP)->where('SP_CODE',$old_spcd_SP)->update($dataSP);

		    }

	    	DB::commit();

			$request->session()->flash('alert-success', 'Consinee lr Was Successfully Updated!');
			return redirect('/logistic/change_Consinee-lr');

		}catch (\Exception $e) {

	        DB::rollBack();
	        //throw $e;
	        $request->session()->flash('alert-error', 'Consinee lr Can Not Added...!');
			return redirect('/logistic/change_Consinee-lr');

	    }

	    
	}

 
    public function GetTripData(Request $request){

      $response_array = array();
      if($request->ajax()){

      	$trip_no = $request->trip_no;
      	$vehicle_no = $request->vehicle_no;

      	if($trip_no){
      		$trip_data = DB::table('TRIP_HEAD')->where('TRIP_NO',$trip_no)->where('PLAN_STATUS',1)->get()->toArray();
				
			if($trip_data){

      			$response_array['response'] = 'success';
      			$response_array['data'] = $trip_data;

      			$data = json_encode($response_array);  
		        print_r($data);



            }else{

            	$response_array['response'] = 'error';
      			$response_array['data'] = '';

      			$data = json_encode($response_array);  
		        print_r($data);
            }
      	}else{

            if($vehicle_no){

      		   $vehicle_data = DB::table('TRIP_HEAD')->where('VEHICLE_NO',$vehicle_no)->where('PLAN_STATUS',1)->get()->toArray();

               if($vehicle_data){

	      			$response_array['response'] = 'success';
	      			$response_array['data'] = $vehicle_data;

	      			$data = json_encode($response_array);  
			        print_r($data);

	            }else{

	            	$response_array['response'] = 'error';
	      			$response_array['data'] = '';

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

      }else{
      	$response_array['response'] = 'error';
      	$response_array['data'] = '';

		$data = json_encode($response_array);  
		print_r($data);
      }
    	
    } 

    public function NewViewSupplimentryTrans(Request $request){
    	 print_r('view supp');
    }

    public function UpdateTripData(Request $request){

    	$validate = $this->validate($request, [
			
			'trip_no'        => 'required',
			'vehicle_no'     => 'required',
			'new_vehicle_no' => 'required',
			'from_place'     => 'required',
			'to_place'       => 'required',
		
		]);
    	 
    	$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$getcompcode = explode('-', $compName);
		
		$vehicleno = $request->vehicle_no;
		$newVehicleNo = $request->new_vehicle_no;
		// print_r($newVehicleNo);exit();
		$vehicleNo = $request->vehicle_no;

		$tripNo = $request->trip_no;
		$comp_code   =	$getcompcode[0];
		$comp_name   =	$getcompcode[1];
		
		$fisYear     =  $request->session()->get('macc_year');

         
		$data = array(

			'OLD_VEHICLE_NO'  => $vehicleno,
			'VEHICLE_NO'    =>$newVehicleNo,
			
		); 

		$saveData = DB::table('TRIP_HEAD')->where('TRIP_NO',$tripNo)->where('PLAN_STATUS',1)->update($data);

        if($saveData){

			$request->session()->flash('alert-success', 'Supplimentry Trip Successfully Updated...!');
				return redirect('/Transaction/Logistic/View-lorry-receipt-trans');

		} else {

			$request->session()->flash('alert-error', 'Supplimentry Trip Can Not Added...!');
			return redirect('/Transaction/Logistic/View-lorry-receipt-trans');

		}



    }
    	

    // end Excel delivery order

/* --------- END : TRANSPORT BILL POSTING -------------- */
 
/* --------- START : GET RATE FOR PURCHASE FREIGHT ORDER ------------- */
	
	public function GetRateFromFreightPurchase(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$freightOrderNo = $request->input('freightOrderNo');
			$fromPlace = $request->input('fromPlace');
			$toPlace = $request->input('toPlace');

			$splitNo = explode(' ',$freightOrderNo);
			$startFyYr = $splitNo[0];
			$seriesCd = $splitNo[1];
			$vrNo = $splitNo[2];
			//DB::enableQueryLog();
    	 	$fsoRateList = DB::select("SELECT B.RATE FROM FPO_HEAD A,FPO_BODY B WHERE A.FPOHID=B.FPOHID AND A.SERIES_CODE='$seriesCd' AND A.VRNO='$vrNo' AND B.FROM_PLACE='$fromPlace' AND B.TO_PLACE='$toPlace'");
			//dd(DB::getQueryLog());
			if ($fsoRateList) {

				$response_array['response'] = 'success';
            	$response_array['data_rate'] = $fsoRateList;

	           	echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
            	$response_array['data_rate'] = '' ;
            	$data = json_encode($response_array);

            	print_r($data);
				
			}


	    	}else{

    			$response_array['response'] = 'error';
            	$response_array['dataList'] = '' ;
            	$data = json_encode($response_array);

            	print_r($data);
	    	}

	}




/* --------- END : GET RATE FOR PURCHASE FREIGHT ORDER ------------- */


	/* ~~~~~~~~~~~~~~~~~~~ TRANSPORTER SALE BILL ~~~~~~~~~~~~~~~~~~~~~~~~ */
	
	public function TransporterSaleBill(Request $request){

        $title = "Transporter Bill Posting";

        $company_name = $request->session()->get('company_name');
        $getcomcode   = explode('-', $company_name);
        $comp_code    = $getcomcode[0];
        $macc_year    = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid       = $request->session()->get('userid');
        //DB::enableQueryLog();
       	$accList = DB::table('TRIP_HEAD')->WHERE('LR_ACK_STATUS','1')->WHERE('TSALEBILL_STATUS','0')->groupBy('ACC_CODE')->get();
       ///	dd(DB::getQueryLog());
       	$userdata['acc_list_data'] = json_decode(json_encode($accList), true); 
       	//echo "<RE>";print_r($userdata['accList']);exit;
		//$userdata['acc_list']     = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get();
		$userdata['vehicle_list'] = DB::table('TRIP_HEAD')->WHERE('LR_ACK_STATUS','1')->WHERE('TSALEBILL_STATUS','0')->get();

		$userdata['tran_list'] = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','S5')->get()->first();

		$series_data = DB::table('MASTER_CONFIG')->WHERE('TRAN_CODE','S5')->WHERE('COMP_CODE',$comp_code)->get();

	    if($series_data){

	      $userdata['series_list'] = $series_data;

	    }else{

	      $userdata['series_list']='';
	    }

		$userdata['taxList'] = DB::table('MASTER_TAX')->get();

		$userdata['ratval_list'] = DB::table('MASTER_RATE_VALUE')->get();

		$itemList  = DB::table('MASTER_ITEM')->where('ITEMTYPE_CODE','SR')->get()->toArray();

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$comp_code,'FY_CODE'=>$macc_year])->get();

        foreach ($getdate as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }
 

        if(isset($company_name)){

            return view('admin.finance.transaction.logistic.transporter_sale_bill',$userdata+compact('itemList'));
        }else{

            return redirect('/useractivity');

        }

    }


     public function get_postCodeByAccSaleBill(Request $request){

		$response_array = array();

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		if ($request->ajax()) {

		//$vehicle_Type   = $request->input('vehicle_Type');
		$account_code   = $request->input('acc_code');
		
		$acc_data       ='';
		$fetch_tds_rate ='';
		$trip_data      ='';
		$fetch_glCode   ='';

		$acc_data = DB::table('MASTER_ACC')->where('ACC_CODE',$account_code)->get()->first();
			

		$fetch_glCode = DB::table('MASTER_GLKEY')->select('MASTER_GLKEY.*')->leftjoin('MASTER_GL', 'MASTER_GLKEY.GL_CODE', '=', 'MASTER_GL.GL_CODE')->where('MASTER_GLKEY.ATYPE_CODE',$acc_data->ATYPE_CODE)->get();

		//$sale_order = DB::table('SORDER_HEAD')->where('ACC_CODE',$account_code)->get()->toArray();

		$sale_order = DB::select("SELECT H.FSOHID,T.ACC_CODE,H.VRNO,H.FY_CODE AS FYCODE,H.SERIES_CODE AS SERIESCODE FROM TRIP_HEAD T,FSO_HEAD H, FSO_BODY B WHERE  B.FSOHID=H.FSOHID AND H.ACC_CODE=T.ACC_CODE  AND T.ACC_CODE='$account_code' AND H.COMP_CODE ='$getcom_code' AND T.TSALEBILL_STATUS='0' GROUP BY H.VRNO");

		/*$sale_order = DB::select("SELECT T.ACC_CODE,H.VRNO,H.FY_CODE AS FYCODE,H.SERIES_CODE AS SERIESCODE FROM TRIP_HEAD T,SORDER_HEAD H, SORDER_BODY B,TRIP_BODY M WHERE M.TRIPHID=T.TRIPHID AND B.SORDERHID=H.SORDERHID AND B.ITEM_CODE=M.ITEM_CODE AND H.ACC_CODE=T.ACC_CODE  AND T.ACC_CODE='$account_code' AND H.COMP_CODE ='$getcom_code' AND T.TSALEBILL_STATUS='0' GROUP BY H.VRNO");*/
		

           
    	if($acc_data || $fetch_glCode || $sale_order) {

			$response_array['response']          = 'success';
			$response_array['data']              = $acc_data;
			$response_array['multiple_data']     = $fetch_glCode;
			$response_array['data_sale']          = $sale_order;
		

	           	echo $data = json_encode($response_array);

	            //print_r($data);

		}else{

			$response_array['response']          = 'error';
			$response_array['data']              = '' ;
			$response_array['multiple_data']     = '';
			$data                            = json_encode($response_array);

	                print_r($data);
				
		}


	    }else{

    		$response_array['response']          = 'error';
		$response_array['data']              = '' ;
		$response_array['trip_data']         = '';
		$response_array['multiple_data']     = '';
		$response_array['data_tds']          = '';
		$response_array['data_vehicle_list'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function TransporterSaleBillData(Request $request){

        if($request->ajax()) {

             if (!empty($request->acct_code || $request->fsoHeadId || $request->from_date || $request->to_date || $request->billType)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
               // $sale_order_no   = $request->fsoHeadId;
             	$fso_headID = $request->fsoHeadId;
               /* if(isset($request->fsoHeadId)  && trim($request->fsoHeadId)!=""){

                    $strWhere .= "AND  H.VRNO = '$request->sale_order_no'";
                }*/

               if(isset($request->acct_code)  && trim($request->acct_code)!=""){
	                   $strWhere .= "AND T.ACC_CODE = '$request->acct_code'";
	             }
                
                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= "AND T.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

                 //DB::enableQueryLog();
                 $data = DB::select("SELECT T.ACC_CODE,T.ACC_NAME,T.TRIPHID,T.VEHICLE_NO AS VEHICLENO,B.LR_NO,B.WAGON_NO,B.INVC_NO,B.TRIP_ACK,B.ITEM_CODE,B.ITEM_NAME, B.LR_DATE,SUM(B.QTY) AS DISPATCH_QTY,C.RATE AS FSO_RATE,SUM(B.QTY)*C.RATE AS AMOUNT,T.PFCT_CODE,T.PFCT_NAME,T.PLANT_CODE,T.PLANT_NAME,T.TO_PLACE,T.SERIES_CODE,T.SERIES_NAME FROM TRIP_HEAD T,TRIP_BODY B,FSO_BODY C WHERE 1=1 $strWhere AND B.TRIPHID=T.TRIPHID AND T.TSALEBILL_STATUS='0' AND T.FROM_PLACE=C.FROM_PLACE AND T.TO_PLACE=C.TO_PLACE AND T.ACC_CODE=C.ACC_CODE AND C.FSOHID='$fso_headID' AND T.LR_ACK_STATUS='1' GROUP BY T.ACC_CODE,T.ACC_NAME,T.TRIPHID,B.LR_NO");
                //dd(DB::getQueryLog()); 
                

              //dd(DB::getQueryLog());

                $discriptn_page = "Search purchase indent report by user";
                $accountCd = '';
             //   $this->userLogInsert($loginUser,$vrseqNum,$series_code,$discriptn_page,$accountCd);  
                
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

    public function SaveTransporterSaleBillData(Request $request){

		$CompanyCode  = $request->session()->get('company_name');
		$compcode_get = explode('-', $CompanyCode);
		$compcode     = $compcode_get[0];
		$fyCode       = $request->session()->get('macc_year');
		$FYEXP 		  = explode('-', $fyCode);
		$createdBy    = $request->session()->get('userid');
		$username    = $request->session()->get('username');

		//single
		$vrDate       = $request->input('vrDate');
		$tr_vr_date   = date("Y-m-d", strtotime($vrDate));
		$acctCode     = $request->input('acctCode');
		$acctName     = $request->input('acctName');
		$acc_glCode   = $request->input('PostCode');
		$acc_glName   = $request->input('PostName');
		$seriesCode   = $request->input('seriesCode');
		$seriesName   = $request->input('seriesName');
		$transCode    = $request->input('transCode');
		$taxCode      = $request->input('gstTaxCd');
		$basicValue   = $request->input('basicValue');
		$NetAmnt      = $request->input('NetAmnt');
		$triphid      = $request->input('triphid');
		$drAmt        = $request->input('drAmt');
		$fsoHid       = $request->input('fsoHid');

		//multi
		$pfct_code    = $request->input('pfct_code');
		$pfct_name    = $request->input('pfct_name');
		$plant_code   = $request->input('plant_code');
		$plant_name   = $request->input('plant_name');
		$jwitem_code  = $request->input('item_code');
		$jwitem_name  = $request->input('item_name');
		$dispatch_qty = $request->input('dispatch_qty');
		$rate         = $request->input('rate');
		$basicHAmt    = $request->input('freightAmt');
		$rate         = $request->input('rate');
		$flit_id      = $request->input('flit_id');
		$head_tax_ind = $request->input('head_tax_ind');
		$tax_ind_code = $request->input('taxIndCode');
		$rate_ind     = $request->input('rate_ind');
		$af_rate      = $request->input('af_rate');
		$amount       = $request->input('amount');
		$logicget     = $request->input('logicget');
		$staticget    = $request->input('staticget');
		$tax_gl_code  = $request->input('taxGlCode');
		$series_gl    = $request->input('series_gl');
		$rowCount     = $request->input('rowCount');
		$isChkChecked = $request->input('isChkChecked');
		$lr_no 		  = $request->input('lr_no');
		$donwloadStatus   = $request->input('pdfYesNoStatus');
		$gstTaxData   = $request->input('gstTaxData');
		$rowIndexTbl  = $request->input('rowIndexTbl');


		
		$datacount = count($flit_id);
		//print_r($datacount);exit;

		if(isset($head_tax_ind)){

			$head_tax_count = count($head_tax_ind);
		}else{
			$head_tax_count='';
		}
		

		

		DB::beginTransaction();

		try {

		/* ----- /. START : VRNO CREATE OR GET FROM DB -------- */

					$lastVrno1 = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$compcode)->where('FY_CODE',$fyCode)->where('TRAN_CODE',$transCode)->get()->first();

					$lastVrno = json_decode(json_encode($lastVrno1),true);
				
					if ($lastVrno) {

					   $newVr = $lastVrno['LAST_NO'] + 1;

					   $datavrn =array(
						   'LAST_NO' => $newVr
						);

					   DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$compcode)->where('FY_CODE',$fyCode)->where('TRAN_CODE',$transCode)->update($datavrn);

					}else{

						$datavrnIn =array(
							'COMP_CODE'   => $compcode,
							'FY_CODE'     => $fyCode,
							'TRAN_CODE'   => $transCode,
							'SERIES_CODE' => $seriesCode,
							'FROM_NO'     => 1,
							'TO_NO'       => 99999,
							'LAST_NO'     => 1,
							'CREATED_BY'  => $createdBy,
						);

						DB::table('MASTER_VRSEQ')->insert($datavrnIn);

						$newVr = 1;

					}

						   $pdfbillNo = $FYEXP[0].'/'.trim($seriesCode).'/'.$newVr;

					        $GETMAXID = DB::select("SELECT MAX(SBILLHID) AS SBHID FROM SBILL_HEAD");

			     			$DATAGETMAXID = json_decode(json_encode($GETMAXID),true);

			     			$MDATAGETMAXID = count($DATAGETMAXID);

			     			if ($MDATAGETMAXID > 0) {
			     				
			     				$GETID = $DATAGETMAXID[0]['SBHID'] + 1;

			     			}else{

			     				$GETID = 1;

			     			}

			     			$slNo = 1;


				            $HEADDATA = array(

								'SBILLHID'		=> $GETID,
								'COMP_CODE'		=> $compcode,
								'FY_CODE'     	=> $fyCode,
								'PFCT_CODE'   	=> $pfct_code[0],
								'PFCT_NAME'    	=> $pfct_name[0],
								'TRAN_CODE'    	=> $transCode,
								'SERIES_CODE'   => $seriesCode,
								'SERIES_NAME'   => $seriesName,
								'VRNO'    		=> $newVr,
								'SLNO'    		=> $slNo,
								'VRDATE'    	=> $tr_vr_date ,
								'PLANT_CODE'    => $plant_code[0],
								'PLANT_NAME'    => $plant_name[0],
								'ACC_CODE'    	=> $acctCode,
								'ACC_NAME'    	=> $acctName,
								'DRAMT'    	    => $NetAmnt,
								'TRAN_TYPE'    	=> 'TBSB',
								'TAX_CODE'    	=> $taxCode,
								'FLAG'    		=> '1',
								'CREATED_BY' 	=> $createdBy

							);

							DB::table('SBILL_HEAD')->insert($HEADDATA);

							$SBILLHID = $GETID;

							DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->delete();


					$GETLR = array();
					$TBLBID = array();
					for ($i = 0; $i < $rowCount; $i++) {

						if ($isChkChecked[$i] =='NO') {

							// DO NOTHING...
							
						}else{

						    $GETMAXIDBD = DB::select("SELECT MAX(SBILLBID) AS SBBID FROM SBILL_BODY");

			     			$DATAGETMAXIDBD = json_decode(json_encode($GETMAXIDBD),true);

			     			$MDATAGETMAXIDBD = count($DATAGETMAXIDBD);

			     			if ($MDATAGETMAXIDBD > 0) {
			     				
			     				$GETBID = $DATAGETMAXIDBD[0]['SBBID'] + 1;

			     			}else{

			     				$GETBID = 1;

			     			}

			     			$TBLBID[] = $GETBID;

			     			$srno = $i + 1;

				     		$getDrAmt = $basicHAmt[$i] * 100 / $basicValue;

				     		$MDRAMT = $NetAmnt * $getDrAmt / 100;
				     		
				     		$BILL_NO = $FYEXP[0].'/'.$seriesCode.'/'.$newVr;


				     		$REMARK = 'Against Bill - '.$BILL_NO.' Date - '.$tr_vr_date.' Bill Amount - '.$MDRAMT.' For LR '.$lr_no[$i].' and Item - '.$jwitem_code.' - '.$jwitem_name;

				     		$GETLR[] = $lr_no[$i];

							$MBODYDATA = array(
									'SBILLHID'		=> $GETID,
									'SBILLBID'		=> $GETBID,
									'COMP_CODE'		=> $compcode,
									'FY_CODE'     	=> $fyCode,
									'PFCT_CODE'   	=> $pfct_code[$i],
									'TRAN_CODE'    	=> $transCode,
									'SERIES_CODE'   => $seriesCode,
									'VRNO'    		=> $newVr,
									'SLNO'    		=> $srno,
									'VRDATE'    	=> $tr_vr_date,
									'PLANT_CODE'    => $plant_code[$i],
									'ITEM_CODE'     => $jwitem_code,
									'ITEM_NAME'     => $jwitem_name,
									'PARTICULAR'    => $REMARK,
									'HSN_CODE'      => '',
									'QTYISSUED'    	=> $dispatch_qty[$i],
									'UM'    		=> '',
									'AQTYISSUED'    => '',
									'AUM'    		=> '',
									'RATE'    		=> $rate[$i],
									'BASICAMT'    	=> $basicHAmt[$i],
									'TAX_CODE'    	=> $taxCode,
									'DRAMT'    		=> $MDRAMT,
									'TRIPHID'    	=> $triphid[$i],
									'FLAG'    		=> '1',
									'CREATED_BY' 	=> $createdBy

								);

								DB::table('SBILL_BODY')->insert($MBODYDATA);


								$SALEBILLUPDATE =array(

									'TSALEBILL_STATUS' =>'1',
									'SBILLHID'	=> $SBILLHID
								);

								DB::table('TRIP_HEAD')->where('TRIPHID',$triphid[$i])->update($SALEBILLUPDATE);

								$TAXAMT = 'rowtaxAmount_'.$rowIndexTbl[$i];

								$TAXAMTDT = $request->input($TAXAMT);


							/* ~~~~~ TAX DATA SAVE ~~~~~~ */


								$TAXRATEDATA = DB::select("SELECT * FROM `MASTER_TAXRATE` WHERE TAX_CODE = '$taxCode'");

								$MTAXRATE = json_decode(json_encode($TAXRATEDATA),true);


								$MTAXRATECOUNT = count($MTAXRATE);

								$srNo = 1;
								for ($j = 0; $j < $MTAXRATECOUNT; $j++) {
									
									$FLAG = 1;

									$GETMAXIDTD = DB::select("SELECT MAX(SBILLTID) AS SBTID FROM SBILL_TAX");

					     			$DATAGETMAXIDTD = json_decode(json_encode($GETMAXIDTD),true);

					     			$MDATAGETMAXIDTD = count($DATAGETMAXIDTD);

					     			if ($MDATAGETMAXIDTD > 0) {
					     				
					     				$GETTID = $DATAGETMAXIDTD[0]['SBTID'] + 1;

					     			}else{

					     				$GETTID = 1;

					     			}

									$MDATA = array(

										'SBILLHID'   	=> $GETID,
										'SBILLBID'   	=> $GETBID,
										'SBILLTID'   	=> $GETTID,
										'TAXIND_CODE'   => $MTAXRATE[$j]['TAXIND_CODE'],
										'TAXIND_NAME'   => $MTAXRATE[$j]['TAXIND_NAME'],
										'RATE_INDEX'   	=> $MTAXRATE[$j]['RATE_INDEX'],
										'TAX_RATE'    	=> $MTAXRATE[$j]['TAX_RATE'],
										'TAX_AMT'    	=> $TAXAMTDT[$j],
										'TAX_LOGIC'    	=> $MTAXRATE[$j]['TAX_LOGIC'],
										'TAXGL_CODE'    => $MTAXRATE[$j]['TAX_GL_CODE'],
										'TAXGL_NAME'    => $MTAXRATE[$j]['TAX_GL_NAME'],
										'STATIC_IND'    => $MTAXRATE[$j]['STATIC_IND'],
										'FLAG'    		=> $FLAG,
										'CREATED_BY' 	=> $createdBy

									);


									DB::table('SBILL_TAX')->insert($MDATA);


									$srNo++;
									
								} /* ./ $j for loop close */


							/* ~~~~~ ./ TAX DATA SAVE CLOSE ~~~~~~ */


						} /* ./ YES/NO IF ELSE CLOSE  */


					} /* ./ FOR LOOP ROW COUNT CLOSE */



				/* _________ START : GET DATA FROM SALE BILL TAX _____________ */

					$GETTAXDATA = DB::select("SELECT * FROM `SBILL_TAX` WHERE SBILLHID = '$GETID'");

					$taxAmtTot = 0;
					foreach($GETTAXDATA as $rowT){

						if($rowT->TAXIND_CODE == 'GT01'){
							$taxAmtTot += $rowT->TAX_AMT;
						}

						if($rowT->TAX_AMT != '' && $rowT->TAX_AMT !=0.00){

							if($rowT->RATE_INDEX != 'Z'){
							
								$CHKFIRSTDATAEXIST = DB::table('INDICATOR_TEMP')->where('TCFLAG','TBSB')->where('CREATED_BY',$createdBy)->get()->toArray();

								$existGlData = DB::table('INDICATOR_TEMP')->where('IND_GL_CODE',$rowT->TAXGL_CODE)->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->toArray();

								if(empty($CHKFIRSTDATAEXIST)){

									$idary = array(
										'IND_CODE'    => $rowT->TAXIND_CODE,
										'CR_AMT'      => $rowT->TAX_AMT,
										'DR_AMT'      => 0.00,
										'IND_GL_CODE' => $series_gl,
										'IND_GL_NAME' => $series_gl,
										'TCFLAG'      => 'TBSB',
										'CREATED_BY'  => $createdBy,
									
									);
									DB::table('INDICATOR_TEMP')->insert($idary);

								}else if(($rowT->TAXGL_CODE == '') || ($rowT->TAXGL_CODE == NULL)){

		                            $bscVal = DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->toArray();

		                            $updateId = $bscVal[0]->CREATED_BY;
		                            $basicAmt = $bscVal[0]->CR_AMT + $rowT->TAX_AMT;
		                        
		                            $idary_bsic = array(
		                                'CR_AMT'      =>$basicAmt,
		                                'DR_AMT'      =>0.00,
		                            );

		                            DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('TCFLAG','TBSB')->where('CREATED_BY',$updateId)->update($idary_bsic);

		                        }else if(empty($existGlData)){

		                            $idary   = array(
		                                'IND_CODE'    => $rowT->TAXIND_CODE,
		                                'DR_AMT'      => 0.00,
		                                'CR_AMT'      => $rowT->TAX_AMT,
		                                'IND_GL_CODE' => $rowT->TAXGL_CODE,
		                                'IND_GL_NAME' => $rowT->TAXGL_NAME,
		                                'TCFLAG'      => 'TBSB',
		                                'CREATED_BY'  => $createdBy,
		                                
		                            );

		                            DB::table('INDICATOR_TEMP')->insert($idary);

		                        }else{

		                            $indData1 = DB::table('INDICATOR_TEMP')->where('IND_GL_CODE',$rowT->TAXGL_CODE)->where('TCFLAG','TBSB')->where('CREATED_BY',$createdBy)->get()->first();

		                            $newTaxAmt = $indData1->CR_AMT + $rowT->TAX_AMT;

		                            $idary1 = array(
		                                'CR_AMT' =>$newTaxAmt,
		                                'DR_AMT' => '0.00',
		                            );

		                            DB::table('INDICATOR_TEMP')->where('IND_GL_CODE',$rowT->TAXGL_CODE)->where('TCFLAG','TBSB')->where('CREATED_BY',$createdBy)->update($idary1);
		                        }

							}/* /. CHECK TAX IND IS Z*/
						} /* /.CHECK TAX AMOUNT IS ZERO OR BLANK*/

					} /* /.FOREACH LOOP*/


				/* START : TEMP-ACC ENTRY */

					$idary   = array(
                        'GLACC_Chk'   => 'ACC',
                        'DR_AMT'      => $taxAmtTot,
                        'CR_AMT'      => 0.00,
                        'IND_GL_CODE' => $acc_glCode,
                        'IND_GL_NAME' => $acc_glName,
                        'TCFLAG'      => 'TBSB',
                        'CREATED_BY'  => $createdBy,
                        
                    );

                    DB::table('INDICATOR_TEMP')->insert($idary);

                /* END : TEMP-ACC ENTRY */

				/* _________ END : GET DATA FROM SALE BILL TAX _____________ */


			/* ~~~~~~~~~~~~~~ START : LEDGER ENTRY EFFECT ~~~~~~~~~~~~~~~~~~~~~ */


				$GETTEMPDATA = DB::table('INDICATOR_TEMP')->where('TCFLAG','TBSB')->where('CREATED_BY',$createdBy)->get()->toArray();

                $SRNO = 1;

                foreach ($GETTEMPDATA as $ROW) {     

					$pfctcode       = '';
					$transport_code = '';
					$transport_name = '';
					$blankVal       = '';
					$GLCODE         = $ROW->IND_GL_CODE;
					$GLNAME         = $ROW->IND_GL_NAME;
					$DRAMT          = $ROW->DR_AMT;
					$CRAMT          = $ROW->CR_AMT;
					$slno           = $SRNO;
					$EXP            = explode('[',$seriesCode);
					$NEWSERICECD    = $EXP[0];
					

					$BILLNO 	= $FYEXP[0].'/'.$seriesCode.'/'.$newVr;

					$LRNO = implode(" ", $GETLR);

					$perticulerText = 'Against Bill - '.$BILLNO.' Date - '.$tr_vr_date.' Bill Amount - '.$NetAmnt.' For LR '.$LRNO.' and Item - '.$jwitem_code.' - '.$jwitem_name;


					$resultgl = (new AccountingController)->GlTEntry($compcode,$fyCode,$transCode,$seriesCode,$newVr,$slno,$tr_vr_date,$pfct_code[0],$ROW->IND_GL_CODE,$ROW->IND_GL_NAME,$ROW->REF_ACCCODE,$ROW->REF_ACCNAME,$blankVal,$blankVal,$blankVal,$blankVal,$ROW->DR_AMT,$ROW->CR_AMT,$perticulerText,$createdBy);


	           	    if($ROW->GLACC_Chk == 'ACC'){

	           	 	   $result = (new AccountingController)->AccountTEntry($compcode,$fyCode,$transCode,$seriesCode,$newVr,$slno,$tr_vr_date,$pfct_code[0],$acctCode,$acctName,$acc_glCode,$acc_glName,$blankVal,$blankVal,$blankVal,$blankVal,$ROW->DR_AMT,$ROW->CR_AMT,$perticulerText,$createdBy);
	           	 	}


	           	 $SRNO++;
                	
                }


			/* ~~~~~~~~~~~~~~ END : LEDGER ENTRY EFFECT ~~~~~~~~~~~~~~~~~~~~~ */


				DB::commit();

				$response_array['response'] = 'success';

				if($donwloadStatus == 1){
					/*tr_vr_date*/
					$transCD='TRAN_SALE_BILL';
					$pdfPageName='TRANSPORTER SALE BILL';
					return $this->GeneratePdfForTranSaleBill($createdBy,$compcode,$plant_code,$flit_id,$fsoHid,$pdfPageName,$transCD,$lr_no,$datacount,$isChkChecked,$NetAmnt,$gstTaxData,$jwitem_code,$jwitem_name,$username,$pdfbillNo,$TBLBID,$GETID,$tr_vr_date);

					/*transporter_code,transporter_name*/

					}else{}

			    $data = json_encode($response_array);
			    print_r($data);

		}catch(\Exception $e) {
		    DB::rollBack();
		    throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}

				//print_r($newVr);exit;

			

        	/* ------ /. END : VRNO CREATE OR GET FROM DB ------ */

  	}


  	public function trpt_sale_bill_msg(Request $request,$saveData){

		if ($saveData == 'false') {
			
			$request->session()->flash('alert-error', 'Transporter Sale Bill Can Not Be Generated...!');
			return redirect('/transaction/Logistic/transporter-sale-bill');

		}else{

			$request->session()->flash('alert-success', 'Transporter Sale Bill Was Successfully Generated...!');
			return redirect('/transaction/Logistic/transporter-sale-bill');

		}
	}


	public function simulationForTransSaleBill(Request $request){

    	if ($request->ajax()) {

			
			$createdBy       = $request->session()->get('userid');
			$acctCode        = $request->input('acctCode');
		    $acctName        = $request->input('acctName');
			$NetAmnt         = $request->input('NetAmnt');
			$head_tax_ind    = $request->input('head_tax_ind');
			$tax_ind_code    = $request->input('taxIndCode');
			$rate_ind        = $request->input('rate_ind');
			$amount          = $request->input('amount');
			$tax_gl_code     = $request->input('taxGlCode');
			$series_gl       = $request->input('series_gl');
			$acc_glCode      = $request->input('PostCode');
	    	$acc_glName      = $request->input('PostName');

	    	$head_tax_count = count($head_tax_ind);

	    	//print_r($head_tax_count);exit;

				$saveData ='';

				   DB::table('SIMULATION_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->delete();

				
					for ($j = 0; $j < $head_tax_count; $j++) {
						
						$indData = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->toArray();

					    $checkExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->toArray();


					    if($amount[$j] != 0.00){

						if($rate_ind[$j] == 'Z'){}else{

							if(empty($checkExist)){

								$idary = array(
									'IND_CODE'    => $tax_ind_code[$j],
									'CR_AMT'      => $amount[$j],
									'DR_AMT'      => 0.00,
									'IND_GL_CODE' => $series_gl,
									'CREATED_BY'  => $createdBy,
									'TCFLAG'      => 'TBSB',
								);
								DB::table('SIMULATION_TEMP')->insert($idary);
							}else  if($tax_gl_code[$j] == ''){

								$bscVal = DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->toArray();
								$updateId = $bscVal[0]->CREATED_BY;
								$basicAmt = $bscVal[0]->CR_AMT + $amount[$j];
							
								$idary_bsic = array(
									'CR_AMT' 	  => $basicAmt,
									'DR_AMT'      => 0.00,
								);

								DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$updateId)->where('TCFLAG','TBSB')->update($idary_bsic);

							}else if(empty($indData)){

									$idary   = array(
										'IND_CODE'    => $tax_ind_code[$j],
										'CR_AMT'      => $amount[$j],
										'DR_AMT'      => 0.00,
										'IND_GL_CODE' => $tax_gl_code[$j],
										//'IND_GL_NAME' => $gl_name,
										'CREATED_BY'  => $createdBy,
										'TCFLAG'      => 'TBSB',
										
									);
									DB::table('SIMULATION_TEMP')->insert($idary);
								}else{

									$indData1 = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->get()->first();

									$newTaxAmt = $indData1->CR_AMT + $amount[$j];

									$idary1 = array(
										'CR_AMT' 	  => $newTaxAmt,
										'DR_AMT'      => 0.00,
									);

									$updatevr = DB::table('SIMULATION_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','TBSB')->update($idary1);

								}
						} /* check 
						*/

					} /* chek amount is blank*/
					
			} // for loop end 


			$accData =  array(
						'IND_CODE'     => '',
						'DR_AMT'       => $NetAmnt,
						'CR_AMT'       => 0.00,
						'IND_GL_CODE'  => $acc_glCode,
						'IND_ACC_CODE' => $acctCode,
						//'GLACC_Chk'    => 'ACC',
						'TCFLAG'       => 'TBSB',
						'CREATED_BY'   => $createdBy,
			);
			DB::table('SIMULATION_TEMP')->insert($accData);


			$taxData = DB::table('SIMULATION_TEMP')
					->select('SIMULATION_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME','MASTER_ACC.ACC_NAME')
	           		->leftjoin('MASTER_GL', 'SIMULATION_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
	           		->leftjoin('MASTER_ACC', 'SIMULATION_TEMP.IND_ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
	            	->where('SIMULATION_TEMP.TCFLAG','TBSB')
	            	->where('SIMULATION_TEMP.CREATED_BY',$createdBy)
	            	->get()->toArray();


	         /* echo '<pre>';

	          print_r($taxData);exit;

	          echo '</pre>';*/

    		if ($taxData) {

    			$response_array['response'] = 'success';
	            $response_array['data_tax'] = $taxData;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data_tax'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

		} /* /. ajax*/

    } /* ./ function close*/



    public function GeneratePdfForTranSaleBill($userId,$getcom_code,$plant_code,$headId,$fsoHid,$pdfName,$tCode,$lr_no,$datacount,$isChkChecked,$NetAmnt,$gstTaxData,$jwitem_code,$jwitem_name,$username,$pdfbillNo,$bodyIdGet,$GETID,$tr_vr_date){


		
    	$createdBy       = $username;
		$response_array = array();

		if($tCode == 'TRAN_SALE_BILL'){

			
				$urlArray =array();

			  	$dataheadB=array();
				$sbILL = array();
			  	for($i=0;$i < $datacount;$i++){

			 		$getheadData = DB::select("SELECT T.VRDATE,T.ACC_CODE,T.ACC_NAME,T.ACK_DATE,T.TRIPHID,T.FREIGHT_QTY,T.VEHICLE_NO AS vehicleNoHead,T.VRNO,T.SERIES_CODE,T.FY_CODE,T.REMARK,T.FSOHID,T.MODEL,T.TRANSPORT_CODE,T.TRANSPORT_NAME,T.VEHICLE_TYPE,B.LR_NO,B.INVC_NO,B.INVC_DATE,B.DELIVERY_NO,B.WAGON_NO,B.CP_CODE,B.SP_CODE,B.FROM_PLACE,B.ISSUED_QTY,B.TO_PLACE,B.SP_NAME,B.CP_NAME,B.WAGON_NO,B.INVC_NO,B.TRIP_ACK,B.ITEM_CODE,B.ITEM_NAME, B.LR_DATE,SUM(B.QTY) AS DISPATCH_QTY,C.RATE AS FSO_RATE,SUM(B.QTY)*C.RATE AS AMOUNT,T.PFCT_CODE,T.PFCT_NAME,T.PLANT_CODE,T.PLANT_NAME,T.TO_PLACE,T.SERIES_CODE,T.SERIES_NAME,B.GROSS_WEIGHT,B.NET_WEIGHT AS NET_WEIGHT,T.WHEELTYPE_NAME,T.MIN_GUARANTEE,T.VEHICLE_TYPE_NAME FROM TRIP_HEAD T,TRIP_BODY B,FSO_BODY C WHERE  B.TRIPHID=T.TRIPHID  AND T.FROM_PLACE=C.FROM_PLACE AND T.TO_PLACE=C.TO_PLACE AND T.ACC_CODE=C.ACC_CODE AND C.FSOHID='$fsoHid' AND T.TRIPHID='$headId[$i]' AND T.LR_ACK_STATUS='1' GROUP BY T.ACC_CODE,T.ACC_NAME,T.TRIPHID,B.LR_NO");
			 	  // dd(DB::getQueryLog());


			 	  	foreach ($getheadData as $key) {

			 	  		$dataheadB[] = $key;

			 	  		$key->VEHICLE_TYPE;
			 	  		$key->vehicleNoHead;
			 	  		
			 	  	}

			 	  	$sbillTax = DB::select("SELECT * FROM SBILL_TAX_VIEW WHERE SBILLHID='$GETID' AND SBILLBID='$bodyIdGet[$i]'");
			 	 
					$getSbillTax = json_decode( json_encode($sbillTax), true);

					$sbILL[] = $getSbillTax[0];
				 	
				}

				$SGSTGET = 0;
				$CGSTGET = 0;
				$IGSTGET = 0;
				$SUBTOT  = 0;
				$GRANDTOT  = 0;
				$CGSTRATE  = 0;
				$SGSTRATE  = 0;
				$IGSTRATE  = 0;
				$ROUNDOFF1  = 0;
				foreach ($sbILL as $rows) {

					$SGSTGET += $rows['SGST'];
					$CGSTGET += $rows['CGST'];
					$IGSTGET += $rows['IGST'];
					$SUBTOT += $rows['SUB_TOTAL'];
					$GRANDTOT += $rows['GRAND_TOTAL'];
					$ROUNDOFF1 += $rows['ROUND_OFF'];
					$CGSTRATE = $rows['CGST_RATE'];
					$SGSTRATE = $rows['SGST_RATE'];
					$IGSTRATE = $rows['IGST_RATE'];
					
				}

				//$GRANDTOT = $GRANDTOT1 + $ROUNDOFF1;

				
				$accCode = $dataheadB[0]->ACC_CODE;
				$to_place = $dataheadB[0]->TO_PLACE;
				$cpCode = $dataheadB[0]->CP_CODE;
				$spCode = $dataheadB[0]->SP_CODE;
				$plantCode = $dataheadB[0]->PLANT_CODE;
				$vehicle_no = $dataheadB[0]->vehicleNoHead;


     		   $dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME,MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

        		$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.ACC_CODE ='$cpCode' AND MASTER_ACCADD.CITY_NAME='$to_place'");

        		$consineeDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.ACC_CODE ='$spCode' AND MASTER_ACCADD.CITY_NAME='$to_place'");
        		//print_r($consineeDetail);exit;

        		$compDetail = DB::SELECT("SELECT * FROM MASTER_COMP WHERE COMP_CODE='$getcom_code'");

        		
        		$itemDetail = DB::SELECT("SELECT * FROM MASTER_ITEM  WHERE ITEM_CODE='$jwitem_code'");

        		$HSNCODE = $itemDetail[0]->HSN_CODE;

        		$hsnDetail = DB::SELECT("SELECT * FROM MASTER_HSN  WHERE HSN_CODE='$HSNCODE'");

        		//print_r($compDetail);exit;

        		$file_data= [];
        		$file_data1= [];
        		$downloadPdf = '';
        		$downloadPdf1 = '';
				for ($t = 0; $t < 2; $t++) {

					header('Content-Type: application/pdf');

					$BillTypeNameOrg = '';

					if ($t==0) {

						$BillTypeNameOrg = 'ORIGINAL FOR CUSTOMER';
						//$file_data['BillTypeNameDup'] = '';

						$pdf = PDF::loadView('admin.finance.transaction.logistic.transporter_sale_bill_pdf',$file_data+compact('pdfName','compDetail','dataheadB','dataAccDetail','itemDetail','hsnDetail','consinerDetail','consineeDetail','NetAmnt','gstTaxData','createdBy','pdfbillNo','SGSTGET','CGSTGET','IGSTGET','GRANDTOT','CGSTRATE','SGSTRATE','IGSTRATE','ROUNDOFF1','BillTypeNameOrg','tr_vr_date'),[],['format' => 'A4-L','orientation' => 'L']);


						$path        = public_path('dist/coldStoragePDF'); 
						$fileName    =  time().'.'. 'pdf' ;
						$pdf->save($path . '/' . $fileName);
						$PublicPath  = url('public/dist/coldStoragePDF/');  
						$downloadPdf = $PublicPath.'/'.$fileName;
						
					}else{

						$BillTypeNameOrg = 'DUPLICATE FOR RECEIVER';
						//$file_data1['BillTypeNameDup'] = 'DUPLICATE FOR RECEIVER';

						$pdf1 = PDF::loadView('admin.finance.transaction.logistic.transporter_sale_bill_pdf',$file_data1+compact('pdfName','compDetail','dataheadB','dataAccDetail','itemDetail','hsnDetail','consinerDetail','consineeDetail','NetAmnt','gstTaxData','createdBy','pdfbillNo','SGSTGET','CGSTGET','IGSTGET','GRANDTOT','CGSTRATE','SGSTRATE','IGSTRATE','ROUNDOFF1','BillTypeNameOrg','tr_vr_date'),[],['format' => 'A4-L','orientation' => 'L']);


						$path1        = public_path('dist/coldStoragePDF'); 
						$fileName1    =  time().'.'. 'pdf' ;
						$pdf1->save($path1 . '/' . $fileName1);
						$PublicPath1  = url('public/dist/coldStoragePDF/');  
						$downloadPdf1 = $PublicPath1.'/'.$fileName1;


					}
					
				}
			

			    $response_array['response'] = 'success';
				$response_array['url']      = $downloadPdf;
				$response_array['url1']     = $downloadPdf1;
				$response_array['data']     = $dataheadB;
				echo $data = json_encode($response_array);

			
		}else{}
		
		

	}


	public function nagitive_check($value){

		if (isset($value)){
		    if (substr(strval($value), 0, 1) == "-"){
		    	return 'It is negative';
			} else {
			    return 'It is not negative';
			}
		}
	}

	public function viewTransporterSaleBill(Request $request){


		$compName = $request->session()->get('company_name');

	    if($request->ajax()) {

			$title        = 'View Transporter Sale Bill';
			
			$userid       = $request->session()->get('userid');
			
			$userType     = $request->session()->get('usertype');
			
			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];
			
			$fisYear      =  $request->session()->get('macc_year');
	        

	         $data = DB::select("SELECT T.ACC_CODE,T.ACC_NAME,T.TRIPHID,T.SBILLHID,T.VEHICLE_NO AS VEHICLENO,B.LR_NO,B.WAGON_NO,B.INVC_NO,B.TRIP_ACK,B.ITEM_CODE,B.ITEM_NAME, B.LR_DATE,SUM(B.QTY) AS DISPATCH_QTY,C.RATE AS FSO_RATE,SUM(B.QTY)*C.RATE AS AMOUNT,T.PFCT_CODE,T.PFCT_NAME,T.PLANT_CODE,T.PLANT_NAME,T.TO_PLACE,T.SERIES_CODE,T.SERIES_NAME,S.VRNO AS SVRNO,S.VRDATE AS SVRDATE,S.SERIES_CODE AS SSERIES_CODE,S.FY_CODE AS SFYCODE FROM TRIP_HEAD T,TRIP_BODY B,FSO_BODY C,SBILL_HEAD S WHERE B.TRIPHID=T.TRIPHID AND T.SBILLHID = S.SBILLHID AND T.SBILLHID != 0 AND T.TSALEBILL_STATUS = '1' AND T.FROM_PLACE=C.FROM_PLACE AND T.TO_PLACE=C.TO_PLACE AND T.ACC_CODE=C.ACC_CODE AND T.LR_ACK_STATUS='1' GROUP BY T.SBILLHID");



	    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
                
            })->toJson();

	    }

	    if(isset($compName)){

	       return view('admin.finance.transaction.logistic.view_transporter_sale_bill');

	    }else{

			return redirect('/useractivity');

		}

	}

	public function ViewChildTransporterSaleBill(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$tempBillData1 = DB::table('SBILL_BODY_PROV')->where('PSBILLHID',$headid)->get();

	    	$tempBillData = DB::select("SELECT H.SBILLHID,H.COMP_CODE,H.FY_CODE,H.SLNO,H.VRNO AS VR_NO,H.PFCT_CODE,H.PFCT_NAME,H.TRAN_CODE,H.SERIES_CODE,H.SERIES_NAME,H.SLNO,H.VRDATE,H.PLANT_CODE,H.PLANT_NAME,H.TRAN_TYPE,H.ACC_CODE,H.ACC_NAME,B.ITEM_CODE,B.ITEM_NAME,B.PARTICULAR,B.QTYISSUED,B.RATE,B.BASICAMT,B.TAX_CODE,V.Basic,V.CGST,V.GRAND_TOTAL,V.ROUND_OFF,V.SGST,V.IGST,V.SUB_TOTAL FROM SBILL_HEAD H, SBILL_BODY B,SBILL_TAX_VIEW V WHERE H.SBILLHID = B.SBILLHID AND H.SBILLHID = V.SBILLHID AND H.SBILLHID='$headid' AND H.TRAN_TYPE='TBSB'");

    		if ($tempBillData) {

    			$response_array['response'] = 'success';
    			$response_array['message'] = 'success';
	            $response_array['data'] = $tempBillData;
	           
	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
				$response_array['message'] = 'error';
                $response_array['data'] = '' ;
               
                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

    		$response_array['response'] = 'error';
    		$response_array['message'] = 'error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);

	    }


	}

	public function DeleteTransporterSaleBill(Request $request){

		$updatedId  = $request->post('tsaleBilldeleteid');

		$splitCol    = explode('~',$updatedId);
		$trapHeadId  = $splitCol[0];
		$sBillHeadId = $splitCol[1];

		DB::beginTransaction();

		try {

			$sbillHeadDat = DB::table('SBILL_HEAD')->where('SBILLHID',$sBillHeadId)->get();
			
			$sCompCode   = $sbillHeadDat[0]->COMP_CODE;
			$sFyCode     = $sbillHeadDat[0]->FY_CODE;
			$sTranCode   = $sbillHeadDat[0]->TRAN_CODE;
			$sseriesCode = $sbillHeadDat[0]->SERIES_CODE;
			$sVrNo       = $sbillHeadDat[0]->VRNO;


			/* ------ START : REVERSE DATA FROM GL BALENCE WHEN DELETE -------- */

				$glTRanData = DB::table('GL_TRAN')->where('COMP_CODE', $sCompCode)->where('FY_CODE', $sFyCode)->where('TRAN_CODE', $sTranCode)->where('SERIES_CODE', $sseriesCode)->where('VRNO', $sVrNo)->get();
				
				for ($i = 0; $i <count($glTRanData); $i++) {
					
					$glCode = $glTRanData[$i]->GL_CODE;
					$drAmtED = $glTRanData[$i]->DRAMT;
					$crAmtED = $glTRanData[$i]->CRAMT;

					$getglBal = DB::table('MASTER_GLBAL')->where('COMP_CODE',$sCompCode)->where('FY_CODE',$sFyCode)->where('GL_CODE', $glCode)->get()->first();

					$RDRAMT    = $getglBal->RDRAMT;
					$RCRAMT    = $getglBal->RCRAMT;
					$YROPDR    = $getglBal->YROPDR;
					$YROPCR    = $getglBal->YROPCR;

					$debitAmt  =   $RDRAMT - $drAmtED;

					$creditAmt =  $RCRAMT - $crAmtED;

					$RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);

					$dataGlED = array(
					
						'RDRAMT'  => $debitAmt,
						'RCRAMT'  => $creditAmt,
						'RBAL'    => $RBAL,
				
					);

					DB::table('MASTER_GLBAL')->where('COMP_CODE',$sCompCode)->where('FY_CODE',$sFyCode)->where('GL_CODE', $glCode)->update($dataGlED);
				}

			/* ------ END : REVERSE DATA FROM GL BALENCE WHEN DELETE -------- */

			/* ------ START : REVERSE DATA FROM ACC BALENCE WHEN DELETE -------- */

				$accTranData = DB::table('ACC_TRAN')->where('COMP_CODE', $sCompCode)->where('FY_CODE', $sFyCode)->where('TRAN_CODE', $sTranCode)->where('SERIES_CODE', $sseriesCode)->where('VRNO', $sVrNo)->get();

				if($accTranData){

					for($j=0;$j<count($accTranData);$j++){

						$a_accCode = $accTranData[$j]->ACC_CODE;
						$a_drAmt   =$accTranData[$j]->DRAMT;
						$a_crAmt   = $accTranData[$j]->CRAMT;

						$getaccBal = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$sCompCode)->where('FY_CODE',$sFyCode)->where('ACC_CODE', $a_accCode)->get()->first();

						if($getaccBal !=''){
			
							$RDRAMT_ED    = $getaccBal->RDRAMT;
							$RCRAMT_ED    = $getaccBal->RCRAMT;
							$YROPDR_ED    = $getaccBal->YROPDR;
							$YROPCR_ED    = $getaccBal->YROPCR;
							$debitAmt_ED  =  $RDRAMT_ED - $a_drAmt;
							$creditAmt_ED =  $RCRAMT_ED - $a_crAmt;

							$RBAL_ED  = floatval($YROPDR_ED - $YROPCR_ED) + floatval($debitAmt_ED - $creditAmt_ED);

							$dataAccED = array(
								'RDRAMT'  => $debitAmt_ED,
								'RCRAMT'  => $creditAmt_ED,
								'RBAL'    => $RBAL_ED,
							);

							DB::table('MASTER_ACCBAL')->where('COMP_CODE',$sCompCode)->where('FY_CODE',$sFyCode)->where('ACC_CODE', $a_accCode)->update($dataAccED);
						}
					}

				}/* ./ check in acc tran*/
				

			/* ------ END : REVERSE DATA FROM ACC BALENCE WHEN DELETE -------- */

			DB::table('ACC_TRAN')->where('COMP_CODE', $sCompCode)->where('FY_CODE', $sFyCode)->where('TRAN_CODE', $sTranCode)->where('SERIES_CODE', $sseriesCode)->where('VRNO', $sVrNo)->delete();
			DB::table('GL_TRAN')->where('COMP_CODE', $sCompCode)->where('FY_CODE', $sFyCode)->where('TRAN_CODE', $sTranCode)->where('SERIES_CODE', $sseriesCode)->where('VRNO', $sVrNo)->delete();

			DB::table('SBILL_HEAD')->where('SBILLHID', $sBillHeadId)->delete();
			DB::table('SBILL_BODY')->where('SBILLHID', $sBillHeadId)->delete();
			DB::table('SBILL_TAX')->where('SBILLHID', $sBillHeadId)->delete();

			$SALEBILLUPDATE =array(

				'TSALEBILL_STATUS' =>'0',
				'SBILLHID'         =>'0'
			);

			DB::table('TRIP_HEAD')->where('TRIPHID',$trapHeadId)->update($SALEBILLUPDATE);

			DB::commit();
			$request->session()->flash('alert-success', 'Transporter Sale Bill Data Was Deleted Successfully...!');
			return redirect('/transaction/Logistic/view-transporter-sale-bill');

		   }catch (\Exception $e) {

			DB::rollBack();
			//throw $e;
			$request->session()->flash('alert-error', 'Transporter Sale Bill Data Can Not Deleted...!');
			return redirect('/transaction/Logistic/view-transporter-sale-bill');
		}

	}


	public function TransporterSaleBillOffLinePdf(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$TRIPHID      = $request->input('TRIPHID');/*----*/
			$SBILLHID     = $request->input('SBILLHID');/*----*/
			$DTRowIndex   = $request->input('DTRowIndex');/*----*/
			$SVRNO        = $request->input('SVRNO');/*----*/
			$T_CODE       = $request->input('T_CODE');/*----*/
			$SVRDATE      = $request->input('SVRDATE');/*----*/
			$amtToWord    = '';/*----*/
			
			$userid       = $request->session()->get('userid');
			$username     = $request->session()->get('username');
			$userType     = $request->session()->get('usertype');
			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];
			$fisYear      =  $request->session()->get('macc_year');
			$expYr        = explode('-', $fisYear);
			$firstYear    = $explode[0]; 

			$response_array = array();

			$compDetail = DB::select("SELECT * FROM MASTER_COMP WHERE COMP_CODE='$getcom_code'");
			
			//DB::enableQueryLog();
			$trptBillData = DB::select("SELECT A.ACC_NAME AS ACCNAME,A.ACC_CODE AS ACCCODE,A.SERIES_CODE AS SERIESCODE,A.FY_CODE AS FYCODE,A.VRNO AS VR_NO,A.VRDATE AS VRDT,A.PLANT_CODE AS PLANTCODE,A.TO_PLACE AS TOPLACE,A.FSOHID,A.FSOBID,A.VEHICLE_TYPE AS VEHICLETYPE, B.* FROM TRIP_HEAD A LEFT JOIN TRIP_BODY B ON A.TRIPHID=B.TRIPHID WHERE A.SBILLHID='$SBILLHID' AND A.TSALEBILL_STATUS='1'");
			//dd(DB::getQueryLog()); 

			$trptDt = json_decode( json_encode($trptBillData), true);

			$ACCCD       = $trptDt[0]['ACCCODE']; /*----*/
			$SERCODE     = $trptDt[0]['SERIESCODE']; /*----*/
			$VEHICLETYPE = $trptDt[0]['VEHICLETYPE']; /*----*/
			$VRDT        = $trptDt[0]['VRDT']; /*----*/
			$PLANTCODE   = $trptDt[0]['PLANTCODE']; /*----*/
			$TOPLACE     = $trptDt[0]['TOPLACE']; /*----*/
			$TFSOHID     = $trptDt[0]['FSOHID']; /*----*/
			$TFSOBID     = $trptDt[0]['FSOBID']; /*----*/


			$AccDetail = DB::select("SELECT * FROM MASTER_ACC WHERE ACC_CODE='$ACCCD'");

			$getAccDetail = json_decode( json_encode($AccDetail), true);

			$ACC_PAN = $getAccDetail[0]['PAN_NO']; /*----*/


			$SBILLTAXVIEWDT = DB::select("SELECT * FROM SBILL_TAX_VIEW WHERE SBILLHID='$SBILLHID'");

			$SBILLTAXVIEW = json_decode( json_encode($SBILLTAXVIEWDT), true);

			$SBILLTAXVIEWCOUNT = count($SBILLTAXVIEW);

			if ($SBILLTAXVIEWCOUNT>0) {
				$gstTaxData = '1';
			}else{
				$gstTaxData = '0';

			}

			
			$AccAddDetail = DB::select("SELECT * FROM MASTER_ACCADD WHERE ACC_CODE='$ACCCD'"); /*----*/

			$getAccAddDetail = json_decode( json_encode($AccAddDetail), true); /*----*/

			$ACC_ADDRESS = $getAccAddDetail[0]['ADD1'].''.$getAccAddDetail[0]['CITY_NAME'].','.$getAccAddDetail[0]['PIN_CODE']; /*----*/

			$ACC_CITY = $getAccAddDetail[0]['CITY_NAME'];  /*----*/
			$ACC_GSTIN = $getAccAddDetail[0]['GST_NUM'];   /*----*/
			$ACCSTATE = $getAccAddDetail[0]['STATE_NAME']; /*----*/

			if ($TFSOHID=='' || $TFSOHID=='NULL') {

				//DB::enableQueryLog();
				$FSODATA = DB::select("SELECT FSO_BODY.*,FSO_HEAD.REF_NO FROM FSO_BODY LEFT JOIN FSO_HEAD ON FSO_HEAD.FSOHID = FSO_BODY.FSOHID WHERE FSO_BODY.COMP_CODE='$getcom_code' AND FSO_BODY.ACC_CODE='$ACCCD' AND FSO_BODY.VEHICLE_TYPE='$VEHICLETYPE' AND '$VRDT' BETWEEN FSO_BODY.VALID_FROM_DATE AND FSO_BODY.VALID_TO_DATE AND FSO_BODY.PLANT_CODE='$PLANTCODE' AND FSO_BODY.TO_PLACE LIKE '%$TOPLACE%'");
				//dd(DB::getQueryLog()); 

				$GETFSODATA = json_decode( json_encode($FSODATA), true); /*----*/

				$FSODT = count($GETFSODATA);


				if ($FSODT>0) {
					# code...
					$FSOHID = $GETFSODATA[0]['FSOHID'];

				}else{

					$FSOHID = '0';

				}
				
			}else{

				$FSOHID = $TFSOHID;

			}
			
			
			$HIDBID = array();
			$BODYIDGET = array();
			$pdfBillNo = '';
			$vrDate = '';
			$SITEMCODE = '';
			$SITEMNAME = '';
			for($q=0;$q<count($trptDt);$q++){

				$TRIPHID = $trptDt[$q]['TRIPHID']; /*----*/
				$TRIPBID = $trptDt[$q]['TRIPBID']; /*----*/


				$HIDBID[] = $TRIPHID; /*----*/


				$dataHead = DB::select("SELECT * FROM SBILL_HEAD WHERE SBILLHID='$SBILLHID'");

				$headData = json_decode( json_encode($dataHead), true);

				$dataBody = DB::select("SELECT * FROM SBILL_BODY WHERE SBILLHID='$SBILLHID'");

				$bodyData = json_decode( json_encode($dataBody), true);

				if ($q==0) {

					$BODYIDGET[] = $bodyData[0]['SBILLBID']; 

				}else{

					if (in_array($bodyData[0]['SBILLBID'], $BODYIDGET)) {

					}else{

						$BODYIDGET[] = $bodyData[0]['SBILLBID']; 

					}

				}
				


				$SITEMCODE = $bodyData[0]['ITEM_CODE'];
				$SITEMNAME = $bodyData[0]['ITEM_NAME'];

				
				$MVRNO      = $headData[0]['VRNO'];
				$MFYCODE    = $headData[0]['FY_CODE'];
				$SERIESCD   = $headData[0]['SERIES_CODE'];
				$VRDT       = $headData[0]['VRDATE'];

				$vrDate     = date("d-m-Y", strtotime($VRDT)); 

				$EXP = explode('-',$MFYCODE);

				$FIRSTYR = $EXP[0];

				$pdfBillNo = $FIRSTYR.'/'.$SERIESCD.'/'.$MVRNO; /* ----- */


			} /* trip data count if close */

			$GRANDTOTWORD = '';
			$plantCode = '';
			$pdfPageName='BILL POSTING';
			$tCode = 'TRAN_SALE_BILL';
			$lr_no = '';
			$datacount = count($trptDt);
			$isChkChecked = '';
			$NetAmnt = '';

			return  $this->GeneratePdfForTranSaleBill($userid,$getcom_code,$plantCode,$HIDBID,$FSOHID,$pdfPageName,$tCode,$lr_no,$datacount,$isChkChecked,$NetAmnt,$gstTaxData,$SITEMCODE,$SITEMNAME,$username,$pdfBillNo,$BODYIDGET,$SBILLHID,$SVRDATE);


	    }else{

    		$response_array['response']  = 'error';
			$response_array['url']       = '';
			$response_array['bill_no']   = '';
			

		    $data = json_encode($response_array);
		    print_r($data);

	    }

	}

	/* ~~~~~~~~~~~~~~~~~~~ ./ TRANSPORTER SALE BILL ~~~~~~~~~~~~~~~~~~~~~~~~ */

	public function getFreightType(Request $request){


		if($request->ajax()) {

        	if (!empty($request->wheel_code)) {

	            date_default_timezone_set('Asia/Kolkata');
	            
	            $strWhere = '';
	            $response_array = array();
	            $company_name = $request->session()->get('company_name');
	            $getcomcode   = explode('-', $company_name);
	            $comp_code    = $getcomcode[0];
	            $macc_year    = $request->session()->get('macc_year');
	            $loginUser    = $request->session()->get('userid');
	          

	         	$wheel_code = $request->input('wheel_code');

	      
	             //DB::enableQueryLog();
	             $data = DB::select("SELECT * FROM MASTER_FLEETTRUCK_WHEEL WHERE WHEEL_CODE='$wheel_code'");
	            //dd(DB::getQueryLog()); 
	        	
	        	//print_r($data);exit;

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

	}

}

	/* ~~~~~~~~~~~~~~~~~~~ FREIGHT SALE QUOTATION  ~~~~~~~~~~~~~~~~~~~~~~~~ */



	public function FreightSaleQuotationVelTypeName(Request $request){


		if($request->ajax()) {

        	if (!empty($request->acct_code || $request->fsoHeadId || $request->from_date || $request->to_date || $request->billType)) {

	            date_default_timezone_set('Asia/Kolkata');
	            
	            $strWhere = '';
	            $response_array = array();
	            $company_name = $request->session()->get('company_name');
	            $getcomcode   = explode('-', $company_name);
	            $comp_code    = $getcomcode[0];
	            $macc_year    = $request->session()->get('macc_year');
	            $loginUser    = $request->session()->get('userid');
	          

	         	$vehicleType = $request->input('vehicleType');

	         	print_r($vehicleType);
	          
	             //DB::enableQueryLog();
	             $data = DB::select("SELECT * FROM MASTER_FLEETTRUCK_WHEEL WHERE WHEEL_CODE='$vehicleType'");
	            //dd(DB::getQueryLog()); 
	        

	            $response_array['response'] = 'success';
	            $response_array['data_list'] = $data;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data_list'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

		}



	}



	/* ~~~~~~~~~~~~~~~~~~~ ./ FREIGHT SALE QUOTATION  ~~~~~~~~~~~~~~~~~~~~~~~~ */

/* ----------------  START :  CHANGE CONSIGNEE -------------*/

	public function deliveryOrderChangeConsinee(Request $request){

	    $title = "Delivery Order Change Consinee";
		$company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');
        $getcomcode    = explode('-', $company_name);
        $comp_code = $getcomcode[0];
        $comp_name = $getcomcode[1];
        
        $atypeCode = 'N';
		
		$userdata['Change_consinee'] = DB::table('MASTER_ACC')->where('ATYPE_CODE',$atypeCode)->get();
	
		$userdata['acc_list']    = DB::table('DORDER_HEAD')->groupBy('ACC_CODE')->get();
        
        if(isset($company_name)){

            return view('admin.finance.transaction.logistic.delivery_order_change_consinee',$userdata+compact('title'));
        }else{

            return redirect('/useractivity');

        }

    }

    public function getDoNoChangeConsinee(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$account_code = $request->input('account_code');
			$do_no        = $request->input('do_no');
			$fieldType    = $request->input('fieldType');

	    	if($account_code && $fieldType='ACCFIELD'){

	    		$delivery_order = DB::table('DORDER_BODY')->select('DORDER_NO')->where('ACC_CODE',$account_code)->get();

	    	}else if($account_code  && $do_no && $fieldType='DONOFIELD'){

	    		$delivery_order = DB::table('DORDER_BODY')->select('CP_CODE','CP_NAME','DORDERHID')->where('ACC_CODE',$account_code)->where('DORDER_NO',$do_no)->get();
	    	}else{
	    		$delivery_order ='';
	    	}

    		if($delivery_order) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $delivery_order;
	            echo $data = json_encode($response_array);

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
/* ----------------  END :  CHANGE CONSIGNEE -------------*/


}