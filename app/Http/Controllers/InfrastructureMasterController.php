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

class InfrastructureMasterController extends Controller{

	public function AddProjectInfra(Request $request){

		$title = 'Add Project Master';

 		$compName = $request->session()->get('company_name');

 		if(isset($compName)){

 			return view('admin.finance.master.Infrastructure.add_project',compact('title'));

 		}else{
 			return redirect('/useractivity');
 		}

    	
	
	}

	public function SaveProjectInfra(Request $request){
      
		$request->validate([

			'Poject_code'    =>'required|unique:MASTER_PROJECT,PROJECT_CODE',
			'Name_project'   =>'required',
			'Project_dis'    =>'required',
			'Plant_start'    =>'required',
			'Plant_enddate'  =>'required',
			'Actual_start'   =>'required',
			'Actual_enddate' =>'required',
		]);

		$createdBy 	= $request->session()->get('userid');

	 	$compName 	= $request->session()->get('company_name');

	 	$fisYear 	=  $request->session()->get('macc_year');

		$projectcode    = $request->input('Poject_code');
		$projectname    = $request->input('Name_project');
		$projectdis     = $request->input('Project_dis');
		$Plantstart     = $request->input('Plant_start');

		if($Plantstart){
          $plant_start       = date("Y-m-d",strtotime($Plantstart));
		}else{
          $plant_start       = '';
		}
		
		$plantend       = $request->input('Plant_enddate');
        
        if($plantend){
          $plant_end    = date("Y-m-d",strtotime($plantend));
		}else{
          $plant_end    = date("Y-m-d",strtotime($plantend));
		}
		
		$actualstart    = $request->input('Actual_start');

        if($plantend){
          $actual_start    = date("Y-m-d",strtotime($actualstart));
		}else{
          $actual_start    = '';
		}

		$actualend      = $request->input('Actual_enddate');

		if($actualend){
          $actual_end= date("Y-m-d",strtotime($actualend));
		}else{
          $actual_end= '';
		}
		
       
        $data = array(

			"PROJECT_CODE" =>  $projectcode,
			"PROJECT_NAME" =>  $projectname,
			"PROJECT_DESC" =>  $projectdis,
			"PLAN_STDATE"  =>  $plant_start,
			"PLAN_ENDATE"  =>  $plant_end, 
			"ACT_STDATE"   =>  $actual_start,
			"ACT_ENDATE"   =>  $actual_end,
			"FLAG"         =>  0,
			"CREATED_BY"   =>  $createdBy
      	
        );

        $saveData = DB::table('MASTER_PROJECT')->insert($data);

        if($saveData){

			$request->session()->flash('alert-success', 'Project Master Successfully Added...!');
	        return redirect('Master/Infrastructure/View-Project-Master');

		}else{

			$request->session()->flash('alert-error', 'Project Master Can Not Added...!');
			return redirect('Master/Infrastructure/View-Project-Master');
		}
 
	}

	public function ViewProjectMasterInfra(Request $request){

		$compName = $request->session()->get('company_name');

		$title    = 'View Project Master';

		if($request->ajax()){
      
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

			if($userType=='admin'){

			    $data = DB::table('MASTER_PROJECT')->orderBy('PROJECTID','DESC');

		    }else if ($userType=='superAdmin' || $userType=='user'){    		

			    $data = DB::table('MASTER_PROJECT')->orderBy('PROJECTID','DESC');

			}else{
			    		$data ='';
			}

	  	 return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}

		if(isset($compName)){
    	
	    	return view('admin.finance.master.Infrastructure.view_project',compact('title'));
		
		}else{

			return redirect('/useractivity');
		}

    
	}

	public function EditProjectInfra(Request $request,$getId){

		$title = 'Edit Project Master';
		 
		$id = base64_decode($getId);

		if($id!=''){

			$editdata = DB::table('MASTER_PROJECT')->where('PROJECT_CODE',$id)->get()->first();
        
			$response_array['MASTER_PROJECT'] = json_decode(json_encode($editdata ),true);

			return view('admin.finance.master.Infrastructure.Edit_project',compact('editdata','title'));

		}else{

            $request->session()->flash('alert-error', 'Project Code Not  Found...!');
			
			return redirect('Master/Infrastructure/View-Project-Master');
		}
	 	
	}

	public function updatedataProjectInfra(Request $request){

		$request->validate([
			'Poject_code'  =>'required',
			'Name_project' =>'required',
			'Project_dis'  =>'required',
			'Plant_start'  =>'required',
			'Plant_enddate'=>'required',
			'Actual_start' =>'required',
			'Actual_enddate'=>'required',
		]);

	   $createdBy   = $request->session()->get('userid');

	   $id        = $request->input('codehidn');

       $projectcode      = $request->input('Poject_code');

       $projectname      = $request->input('Name_project');

       $projectdis       = $request->input('Project_dis');

       $Plantstart       = $request->input('Plant_start');

        if($Plantstart){
          $plant_start       = date("Y-m-d",strtotime($Plantstart));
		}else{
          $plant_start       = '';
		}
		
		$plantend       = $request->input('Plant_enddate');
        
        if($plantend){
          $plant_end    = date("Y-m-d",strtotime($plantend));
		}else{
          $plant_end    = date("Y-m-d",strtotime($plantend));
		}
		
		$actualstart    = $request->input('Actual_start');

        if($plantend){
          $actual_start    = date("Y-m-d",strtotime($actualstart));
		}else{
          $actual_start    = '';
		}

		$actualend      = $request->input('Actual_enddate');

		if($actualend){
          $actual_end= date("Y-m-d",strtotime($actualend));
		}else{
          $actual_end= '';
		}
		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

        $data = array(

			"PROJECT_CODE"   =>  $projectcode,
			"PROJECT_NAME"   =>  $projectname,
			"PROJECT_DESC"   =>  $projectdis,
			"PLAN_STDATE"    =>  $plant_start,
			"PLAN_ENDATE"    =>  $plant_end, 
			"ACT_STDATE"     =>  $actual_start,
			"ACT_ENDATE"     =>  $actual_end,
			"LAST_UPDATE_BY" => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate
      	
        );
      

        $updateData = DB::table('MASTER_PROJECT')->where('PROJECT_CODE', $id)->update($data);

        if($updateData){

			$request->session()->flash('alert-success', 'Project Master Successfully update...!');
	        return redirect('Master/Infrastructure/View-Project-Master');

		}else{

			$request->session()->flash('alert-error', 'Project Master Can Not update...!');
			return redirect('Master/Infrastructure/View-Project-Master');
	    }

     
	}


}