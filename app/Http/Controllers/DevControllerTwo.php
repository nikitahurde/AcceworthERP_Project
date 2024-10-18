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
use PDF;

class DevControllerTwo extends Controller{


	public function ViwePandingOutword(Request $request){

        if ($request->ajax()) {

			

		 $data = DB::table('CF_GATE_ENTRY');

			
		return DataTables::of($data)->addIndexColumn()->toJson();

		}


     
	}

	public function PandingOutword(Request $request){



			return view('admin.finance.report.C_and_F.panding_outward');

	}
	public function viewChamberReport(Request $request){

        if ($request->ajax()) {

         $data = DB::table('MASTER_CHAMBER');

			
			return DataTables::of($data)->addIndexColumn()->toJson();


        }
        

	}
   public function chamberReport(Request $request){
   
    return view('admin.finance.report.C_and_F.chamber_report');




   }
   public function waterMarkImage(Request $request){

   	// print_r('hello');exit();
   	

    return view('admin.finance.report.C_and_F.watermark_image');




   }

/* ------------- INFRASTRUCTURE MASTER START ----------------- */

	

	public function AddProjectInfra(Request $request){

      //print_r('hello');exit();


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
			'Poject_code' =>'required|unique:MASTER_PROJECT,PROJECT_CODE',
			'Name_project'=>'required',
			'Project_dis' =>'required',
			'Plant_start' =>'required',
			'Plant_enddate'=>'required',
			'Actual_start' =>'required',
			'Actual_enddate'=>'required',


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
		
       // print_r($newsacttartend);exit;

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
		  // print_r('hello');
		  // exit();

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
		
        $data = array(

			"PROJECT_CODE"   =>  $projectcode,
			"PROJECT_NAME"   =>  $projectname,
			"PROJECT_DESC"   =>  $projectdis,
			"PLAN_STDATE"    =>  $plant_start,
			"PLAN_ENDATE"    =>  $plant_end, 
			"ACT_STDATE"     =>  $actual_start,
			"ACT_ENDATE"     =>  $actual_end,
			"LAST_UPDATE_BY" => $createdBy
      	
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


	public function DeleteProjectInfra(Request $request){
    
    
		    $tblId = $request->input('tblId');
		     // print_r($tblId);
		     // exit();
    	

    	
    		
    			$Delete = DB::table('MASTER_PROJECT')->where('PROJECT_CODE', $tblId)->delete();
        if($Delete){

	     $request->session()->flash('alert-success', 'Project Master Successfully deleted...!');
			        return redirect('Master/Infrastructure/View-Project-Master');

		}else{

		 $request->session()->flash('alert-error', 'Project Master Can Not deleted...!');
			return redirect('Master/Infrastructure/View-Project-Master');
	    }

	}

	

/* ------------- INFRASTRUCTURE MASTER END ------------------- */

/* ------------- START Milestone Master ------------------- */
    public function AddMileStone(Request $request){


	  $title = 'Add Milestone Master';

 		$compName = $request->session()->get('company_name');

		if(isset($compName)){

 			return view('admin.finance.master.Infrastructure.add_milestone',compact('title'));

 		}else{
 			return redirect('/useractivity');
 		}

	}

    public function SaveMilestone(Request $request){


		$request->validate([
			'milestone_code'  =>'required',
			'milestone_name'  =>'required'
			
		]);
        $createdBy 	= $request->session()->get('userid');

	 	$compName 	= $request->session()->get('company_name');

	 	$fisYear 	=  $request->session()->get('macc_year');


        $stonecode    = $request->input('milestone_code');
        $stonename   = $request->input('milestone_name');
		
		
		$data = array(
			"MILESTONE_CODE" => $stonecode, 
			"MILESTONE_NAME" => $stonename,
			"FLAG"           =>  0,
			"CREATED_BY"     =>  $createdBy
		);
		//print_r($data);exit();



	

	    $savedata =  DB::table('MASTER_MILESTONE')->insert($data);
	    if ($savedata) {

			$request->session()->flash('alert-success', 'Milestone Was Successfully Added...!');
			return redirect('Master/Infrastructure/View-Milestone');

		} else {

			$request->session()->flash('alert-error', 'Milestone Can Not Added...!');
			return redirect('Master/Infrastructure/View-Milestone');

		}

   
	}
	
	public function ViewMilestoneMaster(Request $request){
		//print_r('hello');exit();
		$compName = $request->session()->get('company_name');

		$title    = 'View Milestone Master';


		if($request->ajax()){
      
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

			if($userType=='admin'){

			    $data = DB::table('MASTER_MILESTONE')->orderBy('MILESTONEID','DESC');

		    }else if ($userType=='superAdmin' || $userType=='user'){    		

			    $data = DB::table('MASTER_MILESTONE')->orderBy('MILESTONEID','DESC');

			}else{
			    		$data ='';
			}

	  	 return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}

		if(isset($compName)){
    	
	    	return view('admin.finance.master.Infrastructure.view_milestone',compact('title'));
		
		}else{

			return redirect('/useractivity');
		}

    }
    public function EditMilestoneMaster(Request $request,$getId){

         //print_r('hello');exit();

     $title = 'Edit Milestone Master';
		 
		$id = base64_decode($getId);


		if($id!=''){

			$editdata = DB::table('MASTER_MILESTONE')->where('MILESTONE_CODE',$id)->get()->first();
        
			$response_array['MASTER_MILESTONE'] = json_decode(json_encode($editdata ),true);

			return view('admin.finance.master.Infrastructure.edit_milestone',compact('editdata','title'));

		}else{

            $request->session()->flash('alert-error', 'Project Code Not  Found...!');
			
			return redirect('Master/Infrastructure/View-Milestone');
		}
   
	
    }
    public function updateMilestone(Request $request){
	
	        $request->validate([
				'milestone_code'  =>'required',
				'milestone_name' =>'required'
				
		    ]);

	        $createdBy   = $request->session()->get('userid');

		
		    $codehiden   = $request->input('codehidn');
		    $stonecode   = $request->input('milestone_code');
            $stonename   = $request->input('milestone_name');
		
		
		$data = array(
			"MILESTONE_CODE" => $stonecode, 
			"MILESTONE_NAME" => $stonename,
			"LAST_UPDATE_BY" => $createdBy
		);
	
       $updateData = DB::table('MASTER_MILESTONE')->where('MILESTONE_CODE', $codehiden)->update($data);
    
	   if ($updateData) {

			$request->session()->flash('alert-success', ' Milestone Successfully update...!');
			return redirect('Master/Infrastructure/View-Milestone');

		} else {

			$request->session()->flash('alert-error', 'Milestone Can Not update...!');
			return redirect('Master/Infrastructure/View-Milestone');

		}

    }

  /* ------------- END Milestone Master ------------------- */



  /* ------------- PROJECT WBS MASTER START ----------------- */
    public function AddProjectWbs(Request $request){
	//print_r('hello');exit();

	  $title = 'Add Project WBS';
     $getData['project_code'] = DB::table('MASTER_PROJECT')->get();

 		$compName = $request->session()->get('company_name');

 		if(isset($compName)){

 			return view('admin.finance.master.Infrastructure.add_project_wbs',$getData+compact('title'));

 		}else{
 			return redirect('/useractivity');
 		}

	
    }
   public function SaveProjectWbs(Request $request){


	//print_r('hello');exit();

	/*$request->validate([

			'Poject_code'       =>'required',
			
			'WBS_code'          =>'required',
			'WBS_name'          =>'required',
			'Plant_start_date'  =>'required',
			'Plant_enddate'     =>'required',
			'Actual_start'      =>'required',
			'WBS_actual_enddate'=>'required',
			'Wbs_status'        =>'required',
			'Wbs_prograss'      =>'required',

			]);*/
      $createdBy 	= $request->session()->get('userid');

	  $compName 	= $request->session()->get('company_name');

	  $fisYear 	=  $request->session()->get('macc_year');

      $projectcode    = $request->input('project_code');
       //print_r($projectcode);exit();
      $codecount      =count($projectcode);
      $wbscode        = $request->input('wbscode');
      $wbsname        = $request->input('wbsname');
      $plantstartdt   = $request->input('wbs_plantst_date');
      //print_r($plantstartdt);exit();
      $plantend       = $request->input('wbs_planted_date');
      $actualstart    = $request->input('wbs_actual_stdate');
      $actualend      = $request->input('wbs_actual_eddate');
      $wbsstatus      = $request->input('wbs_status'); 
      $wbsprogress    = $request->input('wbs_progress');
  
        for($i=0; $i<$codecount; $i++){


        if($plantstartdt){
          $plant_start       = date("Y-m-d",strtotime($plantstartdt[$i]));
		}else{
          $plant_start       = '';
		}
        //print_r($plant_start);exit();
		if($plantend){
          $plant_end    = date("Y-m-d",strtotime($plantend[$i]));
		}else{
          $plant_end    = date("Y-m-d",strtotime($plantend[$i]));
		}
        
		 if($actualstart){
          $actual_start    = date("Y-m-d",strtotime($actualstart[$i]));
		}else{
          $actual_start    = '';
		}	
			

	    if($actualend){
          $actual_end= date("Y-m-d",strtotime($actualend[$i]));
		}else{
          $actual_end= '';
		}
				
		
		$projectCd        = $request->input('project_code');
		$explodeProjectCd = explode('-', $projectCd[$i]);

   
		$data = array(

		      	"PROJECT_CODE"    =>  $explodeProjectCd[0],
		    
		        "PROJECT_NAME"    =>  $explodeProjectCd[1], 
		      	"WBS_CODE"        =>  $wbscode[$i],
		      	"WBS_NAME"        =>  $wbsname[$i],
		      	"WBS_PLAN_STDATE" =>  $plant_start, 
		      	"WBS_PLAN_ENDATE" =>  $plant_end,
		      	"WBS_ACT_STDATE"  =>  $actual_start, 
		      	"WBS_ACT_ENDATE"  =>  $actual_end,
		      	"WBS_STATUS"      =>  $wbsstatus[0], 
		      	"WBS_PROGRESS"    =>  $wbsprogress[$i],
		      	"FLAG"            =>  0,
			    "CREATED_BY"      =>  $createdBy
      	 
		      	
        );
       
          $saveData = DB::table('PROJECT_WBS')->insert($data);
        
        }
        if($saveData)	
        {

		 $request->session()->flash('alert-success', 'Account Was Successfully Added...!');
			 return redirect('Master/Infrastructure/View-Project-Wbs-Master');

		}else{

		 $request->session()->flash('alert-error', 'Account Can Not Added...!');
			return redirect('Master/Infrastructure/View-Project-Wbs-Master');
		}

    }

	public function ViewProjectWbs(Request $request){
		  
		$compName = $request->session()->get('company_name');

		$title    = 'View Project WBS';

		if($request->ajax()){
      
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

		if($userType=='admin'){

		  $data = DB::table('PROJECT_WBS')->orderBy('PROJECTID','DESC');
        
		}else if ($userType=='superAdmin' || $userType=='user'){    		

		 $data = DB::table('PROJECT_WBS')->orderBy('PROJECTID','DESC');

		}else{
			    		
			   $data ='';
		}

	  	 return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}

		if(isset($compName)){
    	
	    	return view('admin.finance.master.Infrastructure.view_peoject_wbs',compact('title'));
		
		}else{

			return redirect('/useractivity');
		}

    

        if ($request->ajax()) {


			$data = DB::table('PROJECT_WBS')->get();
         
		
			return DataTables::of($data)->addIndexColumn()->toJson();
		}

	}

    public function EditProjectWbsMaster(Request $request,$getId){
    
         //print_r('hello');exit();


	  $title = 'Edit Project WBS';
		 
		$id = base64_decode($getId);

        $getData['project_code'] = DB::table('MASTER_PROJECT')->get();
         //print_r($getData['project_code']);exit();
		if($id!=''){

		 $editdata = DB::table('PROJECT_WBS')->where('PROJECTID',$id)->get()->first();
		 
          //print_r($editdata);exit();
		 $response_array['PROJECT_WBS'] = json_decode(json_encode($editdata ),true);
		 //print_r($response_array['PROJECT_WBS']);exit();
        
		 return view('admin.finance.master.Infrastructure.edit_project_wbs',$getData+compact('title','editdata'));

		}else{

         $request->session()->flash('alert-error', 'Project Code Not  Found...!');
			
			return redirect('Master/Infrastructure/View-Project-Wbs-Master');
		}

	
    }
    public function updateProjectWbs(Request $request){


              $createdBy   = $request->session()->get('userid');
               
			  $projeid       = $request->input('codehidn');
              $projectcode    = $request->input('project_code');
		       //print_r($projectcode);exit();
		      $codecount      =count($projectcode);
		      $wbscode        = $request->input('wbscode');
		      $wbsname        = $request->input('wbsname');
		      $plantstartdt   = $request->input('wbs_plantst_date');
		      $plantend       = $request->input('wbs_planted_date');
		      $actualstart    = $request->input('wbs_actual_stdate');
		      $actualend      = $request->input('wbs_actual_eddate');
		      $wbsstatus      = $request->input('wbs_status'); 
		      $wbsprogress    = $request->input('wbs_progress');
  
        for($i=0; $i<$codecount; $i++){


        if($plantstartdt){
          $plant_start       = date("Y-m-d",strtotime($plantstartdt[$i]));
		}else{
          $plant_start       = '';
		}
         //print_r($plant_start);exit();
		if($plantend){
          $plant_end    = date("Y-m-d",strtotime($plantend[$i]));
		}else{
          $plant_end    = date("Y-m-d",strtotime($plantend[$i]));
		}
        
		 if($actualstart){
          $actual_start    = date("Y-m-d",strtotime($actualstart[$i]));
		}else{
          $actual_start    = '';
		}	
			

	    if($actualend){
          $actual_end= date("Y-m-d",strtotime($actualend[$i]));
		}else{
          $actual_end= '';
		}
				
		
		$projectCd        = $request->input('project_code');
		$explodeProjectCd = explode('-', $projectCd[$i]);

   
		$data = array(
                "PROJECTID"       =>  $projeid, 
		      	"PROJECT_CODE"    =>  $explodeProjectCd[0],
		    
		        "PROJECT_NAME"    =>  $explodeProjectCd[1], 
		      	"WBS_CODE"        =>  $wbscode[$i],
		      	"WBS_NAME"        =>  $wbsname[$i],
		      	"WBS_PLAN_STDATE" =>  $plant_start, 
		      	"WBS_PLAN_ENDATE" =>  $plant_end,
		      	"WBS_ACT_STDATE"  =>  $actual_start, 
		      	"WBS_ACT_ENDATE"  =>  $actual_end,
		      	"WBS_STATUS"      =>  $wbsstatus[0], 
		      	"WBS_PROGRESS"    =>  $wbsprogress[$i],
      	        "LAST_UPDATE_BY"  => $createdBy
		      	
        );
      
            //print_r($data);exit();
         $updateData = DB::table('PROJECT_WBS')->where('PROJECTID',$projeid)->update($data);
        }
        
        if($updateData){

		 $request->session()->flash('alert-success', 'Project WBS Successfully Update...!');
			        return redirect('Master/Infrastructure/View-Project-Wbs-Master');

		}else{

		 $request->session()->flash('alert-error', 'Project WBS Not Update...!');
			return redirect('Master/Infrastructure/View-Project-Wbs-Master');
		}


    }

  /* ------------- PROJECT WBS MASTER END ----------------- */





  /* -------------UNIT SALE TRAN MASTER START ----------------- */
	 public function getdataunitmaster(Request $request){

	   $companyFull    = $request->session()->get('company_name');
	   $fisYear        =  $request->session()->get('macc_year');
	   $splitComp      = explode('-', $companyFull);
	   $comp_code      = $splitComp[0];
	   $response_array = array();
	   $response_array = array();
	   $unitCode       = $request->input('unitCode');
	  
	   if ($request->ajax()) {

	    	$unitdetails = DB::select("SELECT * FROM MASTER_UNIT WHERE UNIT_CODE='$unitCode'");
				
			if ($unitdetails ) {

				$response_array['response'] = 'success';
				$response_array['dataUnit']  = $unitdetails;
	         $data = json_encode($response_array);
	         print_r($data);

			}else{

				$response_array['response'] = 'error';
				$response_array['dataUnit'] = '' ;
	         $data = json_encode($response_array);
	         print_r($data);
			}	
				
		        
	   }

	}




    public function AddUnitSaleTran(Request $request){
 
      //print_r('hello');exit();


	    $title = 'Unit sale tran';
	  
		  $getData['unit_List']      = DB::table('MASTER_UNIT')->get();
		  $getData['acc_list']       = DB::table('MASTER_ACC')->get();
		  $getData['stone_list']     = DB::table('MASTER_MILESTONE')->get();


 		  $compName = $request->session()->get('company_name');

 	    if(isset($compName)){

	 		return view('admin.finance.transaction.infrastructure.add_unit_sale_tran',$getData+compact('title'));

 	    }else{
 			return redirect('/useractivity');
 	    }

    }
    public function SaveUnitSaleTran(Request $request){

	
	    $request->validate([
            'Vrdate'    =>'required',
			'Unitcode'  =>'required',
			
			'NameUnit'  =>'required',
			'Acc_code'  =>'required',
			'Acc_name'  =>'required',
			'customer1' =>'required',
			'customer2' =>'required',
			'customer3' =>'required',
			'customer4' =>'required',
			'Phone1'    =>'required',
			'Phone2'    =>'required',
			'Phone3'    =>'required',
			'Phone4'    =>'required',
			'unitarea'  =>'required',
			'unitum'    =>'required',
			'unitrate'  =>'required',
			'unitamount'=>'required',

		]);

		// print_r('hello');exit();

	  $createdBy 	= $request->session()->get('userid');

	  $compName 	= $request->session()->get('company_name');

	  $fisYear 	    =  $request->session()->get('macc_year');
	  
	  $vrdate       = $request->input('Vrdate');
	  $newvrdate    = date("Y-m-d",strtotime($vrdate));
	  $unitcd       = $request->input('Unitcode');
      $unitname     = $request->input('NameUnit');
      $acccode      = $request->input('Acc_code');
      $accname      = $request->input('Acc_name');
      $customer1    = $request->input('customer1');
      $customer2    = $request->input('customer2');
      $customer3    = $request->input('customer3');
      $customer4    = $request->input('customer4');
      $phone1       = $request->input('Phone1');
      $phone2       = $request->input('Phone2'); 
      $phone3       = $request->input('Phone3');
      $phone4       = $request->input('Phone4');
      $unitarea     = $request->input('unitarea');
      $unitum       = $request->input('unitum');
      $unitrate     = $request->input('unitrate');
      $unitamount   = $request->input('unitamount');

      // $milestnecd       = $request->input('Milestone_name');
      // $count_mile           = count($milestnecd);
      // // print_r($count_mile);exit();


      $data = array(
      	"UNITID"      => '1',
      	"VRDATE"      => $newvrdate,
      	"UNIT_CODE"   => $unitcd,
      	"UNIT_NAME"   => $unitname, 
      	"ACC_CODE"    => $acccode,
      	"ACC_NAME"    => $accname,
      	"CUSTOMER1"   => $customer1,
      	"CUSTOMER2"   => $customer2,
      	"CUSTOMER3"   => $customer3,
      	"CUSTOMER4"   => $customer4,
      	"PHONE1"      => $phone1, 
      	"PHONE2"      => $phone2, 
      	"PHONE3"      => $phone3, 
      	"PHONE4"      => $phone4,
      	"UNIT_AREA"   => $unitarea,
      	"UNIT_UM"     => $unitum,
      	"UNIT_RATE"   => $unitrate,
      	"UNIT_AMOUNT" => $unitamount,
        "FLAG"        =>  0,
		"CREATED_BY"  =>  $createdBy
      );
      //print_r($data);exit();

        $saveData         = DB::table('UNIT_SALE_TRAN')->insert($data);
        // $lastgetId   = DB::getPdo()->lastinserId();
        $unitcode         = $request->input('Unit_code');
     
        $unitname         = $request->input('Unit_name');
        $acccode          = $request->input('Acc_code');
        $accname          = $request->input('Acc_name');
        $milestnecd       = $request->input('Milestone_cd');
        $count_milest           = count($milestnecd);
         // print_r($count_milest);exit();
        $milestnename     = $request->input('Milestone_name');
        $milestnedt       = $request->input('Milestone_date');
        $amount           = $request->input('Amount');
        $Ramount          = $request->input('Read_amount');
        $particular       = $request->input('Particular');


        $unitcode         = $request->input('Unit_code');
     
		$explodeunitcode  = explode('-', $unitcode);

        $acccode          = $request->input('Acc_code');
     
		$explodeacccode   = explode('-', $acccode);


    
		      	
        for($i=0; $i<$count_milest; $i++){

        if($milestnedt){
          $mile_date       = date("Y-m-d",strtotime($milestnedt[$i]));
		}else{
          $mile_date       = '';
		}
    
		        $data1 = array(
		            "UNITID"         => '1',
		        	"UNIT_CODE"      => $explodeunitcode, 
		        	"UNIT_NAME"      => $explodeunitcode,
		        	"ACC_CODE"       => $explodeacccode,
		        	"ACC_NAME"       => $explodeacccode,
		        	"MILESTONE_CODE" => $milestnecd[$i],
		        	"MILESTONE_NAME" => $milestnename[$i],
		        	"MILESTONE_DATE" => $mile_date[$i],
		        	"AMOUNT"         => $amount[$i], 
		        	"PARTICULAR"     => $particular[$i], 
		             
		        );

          // print_r($i);exit();
           $savedata= DB::table('UNIT_PMT_SCH')->insert($data1);

        }

          if($saveData)
        {

		 $request->session()->flash('alert-success', 'Account Was Successfully Added...!');
			        return redirect('Transaction/Infrastructure/View-Unit-Sale-Tran');

		}else{

			$request->session()->flash('alert-error', 'Account Can Not Added...!');
			return redirect('Transaction/Infrastructure/View-Unit-Sale-Tran');
		}


    }

    public function ViewUnitTran(Request $request){
		  //print_r('hello');//exit();

	    $compName = $request->session()->get('company_name');

		$title    = 'View Unit Sale Tran';

		if($request->ajax()){
      
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

			if($userType=='admin'){

			    $data = DB::table('UNIT_SALE_TRAN')->orderBy('UNIT_CODE','DESC');

		    }else if ($userType=='superAdmin' || $userType=='user'){    		

			    $data = DB::table('UNIT_SALE_TRAN')->orderBy('UNIT_CODE','DESC');

			}else{
			    		$data ='';
			}

	  	       return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}

		if(isset($compName)){
    	
	    	return view('admin.finance.transaction.infrastructure.view_unit_sale_tran',compact('title'));
		
		}else{

			return redirect('/useractivity');
		}


    }

    public function EditUnitSaleTran(Request $request,$getId){

     //print_r('hello');exit();

	    $title = 'Edit Unit Sale tran';
		 
		$id = base64_decode($getId);
		$getData['unit_List'] = DB::table('MASTER_UNIT')->get();

		if($id!=''){

			$editdata = DB::table('UNIT_SALE_TRAN')->where('UNIT_CODE',$id)->get()->first();

			$response_array['UNIT_SALE_TRAN'] = json_decode(json_encode($editdata ),true);

			return view('admin.finance.transaction.infrastructure..edit_unit_sale_tran',$getData+compact('title','editdata'));

		}else{

            $request->session()->flash('alert-error', 'Project Code Not  Found...!');
			
			return redirect('Transaction/Infrastructure/View-Unit-Sale-Tran');
		}
	 	

    }

    public function updateUnitSaleTran(Request $request){
       //print_r('hello');exit();
	    $request->validate([

			'Unitcode'  =>'required',
			
			'NameUnit'  =>'required',
			'Acc_code'  =>'required',
			'Acc_name'  =>'required',
			'customer1' =>'required',
			'customer2' =>'required',
			'customer3' =>'required',
			'customer4' =>'required',
			'Phone1'    =>'required',
			'Phone2'    =>'required',
			'Phone3'    =>'required',
			'Phone4'    =>'required',
			'unitarea'  =>'required',
			'unitum'    =>'required',
			'unitrate'  =>'required',
			'unitamount'=>'required',

		]);

	  $createdBy   = $request->session()->get('userid');

	  $hidunitcd    = $request->input('hdnunitcd');
	  //print_r($ProjectID);exit();
	  $unitcd       = $request->input('Unitcode');
      $unitname     = $request->input('NameUnit');
      $acccode      = $request->input('Acc_code');
      $accname      = $request->input('Acc_name');
      $customer1    = $request->input('customer1');
      $customer2    = $request->input('customer2');
      $customer3    = $request->input('customer3');
      $customer4    = $request->input('customer4');
      $phone1       = $request->input('Phone1');
      $phone2       = $request->input('Phone2'); 
      $phone3       = $request->input('Phone3');
      $phone4       = $request->input('Phone4');
      $unitarea     = $request->input('unitarea');
      $unitum       = $request->input('unitum');
      $unitrate     = $request->input('unitrate');
      $unitamount   = $request->input('unitamount');




      $data = array(
      	
      	"PEOJECT_CODE"   => $hidunitcd,   
      	"UNIT_CODE"      => $unitcd,
      	"UNIT_NAME"      => $unitname, 
      	"ACC_CODE"       => $acccode,
      	"ACC_NAME"       => $accname,
      	"CUSTOMER1"      => $customer1,
      	"CUSTOMER2"      => $customer2,
      	"CUSTOMER3"      => $customer3,
      	"CUSTOMER4"      => $customer4,
      	"PHONE1"         => $phone1, 
      	"PHONE2"         => $phone2, 
      	"PHONE3"         => $phone3, 
      	"PHONE4"         => $phone4,
      	"UNIT_AREA"      => $unitarea,
      	"UNIT_UM"        => $unitum,
      	"UNIT_RATE"      => $unitrate,
      	"UNIT_AMOUNT"    => $unitamount,
        "LAST_UPDATE_BY" => $createdBy
      );
         //print_r($data);exit();
         $updateData = DB::table('UNIT_SALE_TRAN')->where('UNIT_CODE',$hidunitcd)->update($data);
   
    
        if($updateData)	
        {

		 $request->session()->flash('alert-success', 'Account Was Successfully Update...!');
			        return redirect('Transaction/Infrastructure/View-Unit-Sale-Tran');

		}else{

					
		 $request->session()->flash('alert-error', 'Account Can Not Update...!');
			   return redirect('Transaction/Infrastructure/View-Unit-Sale-Tran');
		}



    }

    

    /* ------------- UNIT SALE TRAN END ----------------- */

   public function editFreightSaleQuatation(Request $request){
   	print_r('hello');exit();
   }

}
