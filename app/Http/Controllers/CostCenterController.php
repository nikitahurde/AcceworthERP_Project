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
class CostCenterController extends Controller{

	//public $data;

	public function __construct(Request $request){

		//$this->data = "smit@121";

	}


/* ------- start cost type master ------ */

    public function CostType(Request $request){

		$title           ='Add Cost Type Master';
		
		$compName        = $request->session()->get('company_name');
		$cost_type_code  = $request->old('cost_type_code');
		$cost_type_name  = $request->old('cost_type_name');
		$cost_type_id    = $request->old('cost_type_id');
		$cost_type_block = $request->old('cost_type_block');

		$userData['costype_list'] = DB::table('MASTER_CTYPE')->Orderby('CTYPE_CODE', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/Master/Cost-Center/Cost-Type-Save';
	
		if(isset($compName)){

	    	return view('admin.finance.master.costCenter.cost_type_form',$userData+compact('title','cost_type_code','cost_type_name','cost_type_id','cost_type_block','button','action'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function CostTypeSave(Request $request){

		$validate = $this->validate($request, [

			'cost_type_code' => 'required|max:6|unique:MASTER_CTYPE,CTYPE_CODE',
			'cost_type_name' => 'required|max:40',

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$data = array(
			"CTYPE_CODE" => $request->input('cost_type_code'),
			"CTYPE_NAME" => $request->input('cost_type_name'),
			"CREATED_BY" => $createdBy,
			
		);

		$saveData = DB::table('MASTER_CTYPE')->insert($data);

		$discriptn_page = "Master cost type insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Type Was Successfully Added...!');
			return redirect('/Master/Cost-Center/View-Cost-Type-Mast');

		} else {

			$request->session()->flash('alert-error', 'Cost Type Can Not Added...!');
			return redirect('/Master/Cost-Center/View-Cost-Type-Mast');

		}

	}

	 public function EditCostType($id){

    	$title = 'Edit Cost Type Master';

    	//print_r($id);
    	$costtype = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);

    	if($costtype!=''){
    	    $query = DB::table('MASTER_CTYPE');
			$query->where('CTYPE_CODE', $costtype);
			$classData= $query->get()->first();

			$cost_type_code  = $classData->CTYPE_CODE;
			$cost_type_name  = $classData->CTYPE_NAME;
			$cost_type_id    = $classData->CTYPE_CODE;
			$cost_type_block = $classData->CTYPE_BLOCK;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/Master/Cost-Center/Cost-Type-Update';

			return view('admin.finance.master.costCenter.cost_type_form',compact('title','cost_type_code','cost_type_name','cost_type_id','cost_type_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Cost Type Not Found...!');
			return redirect('/Master/Cost-Center/View-Cost-Type-Mast');
		}

    }

    public function CostTypeUpdate(Request $request){

		$validate = $this->validate($request, [

			'cost_type_code' => 'required|max:6',
			'cost_type_name' => 'required|max:40',

		]);

		$cost_typecode = $request->input('cost_type_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"CTYPE_CODE"       => $request->input('cost_type_code'),
			"CTYPE_NAME"       => $request->input('cost_type_name'),
			"CTYPE_BLOCK"      => $request->input('cost_type_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		try{
			$saveData = DB::table('MASTER_CTYPE')->where('CTYPE_CODE', $cost_typecode)->update($data);

			$discriptn_page = "Master cost type update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Cost Type Was Successfully Updated...!');
				return redirect('/Master/Cost-Center/View-Cost-Type-Mast');

			} else {

				$request->session()->flash('alert-error', 'Cost Type Can Not Added...!');
				return redirect('/Master/Cost-Center/View-Cost-Type-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Type be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Cost-Center/View-Cost-Type-Mast');
			}

	}

	public function ViewCostType(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()){

	    	$title = 'View Cost Type Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data  = DB::table('MASTER_CTYPE')->orderBy('CTYPE_CODE','DESC');

	    	}elseif ($userType=='superAdmin' || $userType=='user') {

    			$data = DB::table('MASTER_CTYPE')->orderBy('CTYPE_CODE','DESC');
    		}else{
	    		$data ='';
	    	}

    		return DataTables()->of($data)->addIndexColumn()->toJson();
		}
		if(isset($compName)){

		    return view('admin.finance.master.costCenter.view_cost_type');
		}else{
			return redirect('/useractivity');
	    }

    }

    public function DeleteCostType(Request $request){

		$costTypeCode = $request->post('costTypeId');
    	
    	if ($costTypeCode!='') {

    		try{
    		
	    		$Delete = DB::table('MASTER_CTYPE')->where('CTYPE_CODE', $costTypeCode)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Acc Cost Was Deleted Successfully...!');
					return redirect('/Master/Cost-Center/View-Cost-Type-Mast');

				} else {

					$request->session()->flash('alert-error', 'Acc Cost Can Not Deleted...!');
					return redirect('/Master/Cost-Center/View-Cost-Type-Mast');

				}
			}
			catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Type be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Cost-Center/View-Cost-Type-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Acc Cost Not Found...!');
			return redirect('/Master/Cost-Center/View-Cost-Type-Mast');

    	}

	}

/*search Cost Type when click on help button*/
	
	public function HelpCostTypeCodeGet(Request $request){

		$response_array = array();

	    $CostTypeHelp = $request->input('CostTypeHelp');

		if ($request->ajax()) {

	    	$costtype_code_by_help = DB::select("SELECT * FROM `MASTER_CTYPE` WHERE CTYPE_CODE='$CostTypeHelp' OR CTYPE_NAME='$CostTypeHelp' OR CTYPE_CODE Like '$CostTypeHelp%' OR CTYPE_NAME LIKE '$CostTypeHelp%' ORDER BY CTYPE_CODE DESC limit 5  ");
	    	
    		if ($costtype_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costtype_code_by_help ;

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

/*search Cost Type code when click on help button*/


/*search Cost Type code on input*/

	public function search_CostTypeCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$CostTypeSearch = $request->input('CostTypeSearch');

	    	$costtypecode_list = DB::select("SELECT * FROM `MASTER_CTYPE` WHERE CTYPE_CODE LIKE '$CostTypeSearch%'");

	    	$count = count($costtypecode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costtypecode_list ;

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

/*search Cost Type code on input*/

/* ------ end cost type master ------- */
 
/* ------ start cost class master ------- */

	 public function CostClass(Request $request){

		$title        ='Add Cost Class Master';

		$compName 	= $request->session()->get('company_name');
		
		$cost_class_code  = $request->old('cost_class_code');
		$cost_class_name  = $request->old('cost_class_name');
		$cost_class_id    = $request->old('cost_class_id');
		$cost_class_block = $request->old('cost_class_block');

		$userData['costcls_mst_list'] = DB::table('MASTER_CCLASS')->Orderby('CCLASS_CODE', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/Master/Cost-Center/Cost-Class-Save';
		

		if(isset($compName)){

	    	return view('admin.finance.master.costCenter.cost_class_form',$userData+compact('title','cost_class_code','cost_class_name','cost_class_id','cost_class_block','button','action'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function CostClassSave(Request $request){


		$validate = $this->validate($request, [

			'cost_class_code' => 'required|max:6|unique:MASTER_CCLASS,CCLASS_CODE',
			'cost_class_name' => 'required|max:40',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

			$data             = array(
				"CCLASS_CODE" => $request->input('cost_class_code'),
				"CCLASS_NAME" => $request->input('cost_class_name'),
				"CREATED_BY"  => $createdBy,
			
			);

		$saveData = DB::table('MASTER_CCLASS')->insert($data);

		$discriptn_page = "Master cost class insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Class Was Successfully Added...!');
			return redirect('/Master/Cost-Center/View-Cost-Class-Mast');

		} else {

			$request->session()->flash('alert-error', 'Cost Class Can Not Added...!');
			return redirect('/Master/Cost-Center/View-Cost-Class-Mast');

		}

	}
	 public function EditCostClass($costClass){

    	$title = 'Edit Cost Class Master';

    	//print_r($id);
    	$costClass = base64_decode($costClass);
    	//$btnControl= base64_decode($btnControl);

    	if($costClass!=''){
    	    $query = DB::table('MASTER_CCLASS');
			$query->where('CCLASS_CODE', $costClass);
			$classData= $query->get()->first();

			$cost_class_code  = $classData->CCLASS_CODE;
			$cost_class_name  = $classData->CCLASS_NAME;
			$cost_class_id    = $classData->CCLASS_CODE;
			$cost_class_block = $classData->CCLASS_BLOCK;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/Master/Cost-Center/Cost-Class-Update';

			return view('admin.finance.master.costCenter.cost_class_form',compact('title','cost_class_code','cost_class_name','cost_class_id','cost_class_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Cost Class Not Found...!');
			return redirect('/Master/Cost-Center/View-Cost-Class-Mast');
		}

    }


    public function CostClassFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'cost_class_code' => 'required|max:6',
			'cost_class_name' => 'required|max:40',

		]);

		$cost_classcode = $request->input('cost_class_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"CCLASS_CODE"      => $request->input('cost_class_code'),
			"CCLASS_NAME"      => $request->input('cost_class_name'),
			"CCLASS_BLOCK"     => $request->input('cost_class_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		try{

			$saveData = DB::table('MASTER_CCLASS')->where('CCLASS_CODE', $cost_classcode)->update($data);

			$discriptn_page = "Master cost class update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Cost Class Was Successfully Updated...!');
				return redirect('/Master/Cost-Center/View-Cost-Class-Mast');

			} else {

				$request->session()->flash('alert-error', 'Cost Class Can Not Added...!');
				return redirect('/Master/Cost-Center/View-Cost-Class-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Class be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Cost-Center/View-Cost-Class-Mast');
			}


	}

	public function ViewCostClass(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()){


	    	$title = 'View Cost Class Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    	$data = DB::table('MASTER_CCLASS')->orderBy('CCLASS_CODE','DESC');

	    	//print_r($valData['val_list']);exit;
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_CCLASS')->orderBy('CCLASS_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}


	    	return DataTables()->of($data)->addIndexColumn()->toJson();

		}
		if(isset($compName)){

    		return view('admin.finance.master.costCenter.view_cost_class');
	    }else{
	    	return redirect('/useractivity');
	    }
    }


    public function DeleteCostClass(Request $request){

		$costClassCode = $request->post('costClassId');
    	

    	if ($costClassCode!='') {

    		try{
    		
    		$Delete = DB::table('MASTER_CCLASS')->where('CCLASS_CODE', $costClassCode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Cost Class Was Deleted Successfully...!');
				return redirect('/Master/Cost-Center/View-Cost-Class-Mast');

			} else {

				$request->session()->flash('alert-error', 'Cost Class Can Not Deleted...!');
				return redirect('/Master/Cost-Center/View-Cost-Class-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Class be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Cost-Center/View-Cost-Class-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Cost Class Not Found...!');
			return redirect('/Master/Cost-Center/View-Cost-Class-Mast');

    	}

	}

/* ------ end cost class master ------- */

/* ------ start cost category master --------*/
	
	public function CostCategory(Request $request){

		$title      ='Add Cost Category';
		$compName 	= $request->session()->get('company_name');
		
		$costcatg_code = $request->old('costcatg_code');
		$costcatg_name = $request->old('costcatg_name');
		$costg_block   = $request->old('costg_block');
		$costcatg_id   = $request->old('costcatg_id');

		$userData['cost_category_list'] = DB::table('MASTER_CCATG')->Orderby('CCATG_CODE', 'desc')->limit(5)->get();

		$button ='Save';
		$action ='/Master/Cost-Center/Cost-Category-Save';

		if(isset($compName)){

	    	return view('admin.finance.master.costCenter.cost_category_form',$userData+compact('title','costcatg_code','costcatg_name','costg_block','costcatg_id','button','action'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function CostCategorySave(Request $request){

		$validate = $this->validate($request, [

			'costcatg_code' => 'required|max:6|unique:MASTER_CCATG,CCATG_CODE',
			'costcatg_name' => 'required|max:40',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"CCATG_CODE" => $request->input('costcatg_code'),
			"CCATG_NAME" => $request->input('costcatg_name'),
			"CREATED_BY"    => $createdBy,
			
		);

		$saveData = DB::table('MASTER_CCATG')->insert($data);

		$discriptn_page = "Master cost category insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Category Was Successfully Added...!');
			return redirect('/Master/Cost-Center/View-Cost-Category');

		} else {

			$request->session()->flash('alert-error', 'Cost Category Can Not Added...!');
			return redirect('/Master/Cost-Center/View-Cost-Category');

		}

	}


	public function ViewCostCategory(Request $request){

	$compName = $request->session()->get('company_name');

		if($request->ajax()){


			$title    = 'View Cost Category Master';
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_CCATG')->orderBy('CCATG_CODE','DESC');

	    	//print_r($valData['val_list']);exit;AccClassFormSave
	    	}else if ($userType=='superAdmin' || $userType=='user') {    		
	    		$data = DB::table('MASTER_CCATG')->orderBy('CCATG_CODE','DESC');

	    	}
	    	else{
	    		$data ='';
	    	}


	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}
		if(isset($compName)){
	    	return view('admin.finance.master.costCenter.view_cost_category');
		}else{
			return redirect('/useractivity');
		}
	}


    public function DeleteCostCategory(Request $request){

		$costcat = $request->post('costcat');
    	

    	if ($costcat!='') {
    		try{

    		$Delete = DB::table('MASTER_CCATG')->where('CCATG_CODE', $costcat)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Cost Category Was Deleted Successfully...!');
				return redirect('/Master/Cost-Center/View-Cost-Category');

			} else {

				$request->session()->flash('alert-error', 'Cost Category Can Not Deleted...!');
				return redirect('/Master/Cost-Center/View-Cost-Category');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Category be be Deleted...! Used In Another Transaction...!');
					return redirect('/Master/Cost-Center/View-Cost-Category');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Zone  Not Found...!');
			return redirect('/Master/Cost-Center/View-Cost-Category');

    	}

	}


	public function EditCostCategory($CostCategory){

    	$title = 'Edit Cost Category Master';

    	//print_r($id);
    	$CostCategory = base64_decode($CostCategory);
    	//$btnControl = base64_decode($btnControl);

    	if($CostCategory!=''){
    	    $query = DB::table('MASTER_CCATG');
			$query->where('CCATG_CODE', $CostCategory);
			$classData= $query->get()->first();

			$costcatg_code = $classData->CCATG_CODE;
			$costcatg_name = $classData->CCATG_NAME;
			$costcatg_id   = $classData->CCATG_CODE;
			$costg_block   = $classData->CCATG_BLOCK;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/Master/Cost-Center/Cost-Category-Update';

			return view('admin.finance.master.costCenter.cost_category_form',compact('title','costcatg_code','costcatg_name','costcatg_id','costg_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Cost Category Not Found...!');
			return redirect('/Master/Cost-Center/View-Cost-Category');
		}

    }


    public function CostCategoryUpdate(Request $request){

		$validate = $this->validate($request, [

			'costcatg_code' => 'required|max:6',
			'costcatg_name' => 'required|max:40',

		]);

		$codecostcatg = $request->input('idcostcatg');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");
		
		$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');

		$data = array(
			"CCATG_CODE"       => $request->input('costcatg_code'),
			"CCATG_NAME"       => $request->input('costcatg_name'),
			"CCATG_BLOCK"      => $request->input('costg_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);
		try{

			$saveData = DB::table('MASTER_CCATG')->where('CCATG_CODE', $codecostcatg)->update($data);

			$discriptn_page = "Master cost category update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Cost Category Was Successfully Updated...!');
				return redirect('/Master/Cost-Center/View-Cost-Category');

			} else {

				$request->session()->flash('alert-error', 'Cost Category Can Not Added...!');
				return redirect('/Master/Cost-Center/View-Cost-Category');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Category be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Cost-Center/View-Cost-Category');
			}

	}

	/*search cost category when click on help button*/
	
	public function Helpcostcat_Get(Request $request){

		$response_array = array();

	    $CostCatHelp = $request->input('CostCatHelp');

		if ($request->ajax()) {

	    	$costcat_code_by_help = DB::select("SELECT * FROM `MASTER_CCATG` WHERE CCATG_CODE='$CostCatHelp' OR CCATG_NAME='$CostCatHelp' OR CCATG_CODE Like '$CostCatHelp%' OR CCATG_NAME LIKE '$CostCatHelp%' ORDER BY CCATG_CODE DESC limit 5  ");
	    	
    		if ($costcat_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costcat_code_by_help ;

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

/*search cost category code when click on help button*/


/*search cost category code on input*/

	public function search_costcatCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$CostCatSearch = $request->input('CostCatSearch');

	    	$costcatcode_list = DB::select("SELECT * FROM `MASTER_CCATG` WHERE CCATG_CODE LIKE '$CostCatSearch%'");

	    	$count = count($costcatcode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costcatcode_list ;

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

/*search cost category code on input*/

/* ------ end cost category master --------- */

/* ------ start cost group master ---------*/

	public function CostGroup(Request $request){

		$title        ='Add Cost Group Master';

		$compName 	= $request->session()->get('company_name');
		
		$cost_group_code  = $request->old('cost_group_code');
		$cost_group_name  = $request->old('cost_group_name');
		$cost_group_id    = $request->old('cost_group_id');
		$cost_group_block = $request->old('cost_group_block');
		$cost_type_code   = $request->old('cost_type_code');

		$cost_type = DB::table('MASTER_CTYPE')->get();

		$userData['cost_group_list'] = DB::table('MASTER_CGROUP')->Orderby('CGROUP_CODE', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/Master/Cost-Center/Cost-Group-Save';

		if(isset($compName)){

	    	return view('admin.finance.master.costCenter.cost_group_form',$userData+compact('title','cost_group_code','cost_group_name','cost_type_code','cost_type','cost_group_id','cost_group_block','button','action'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function SaveCostGroup(Request $request){

		$validate = $this->validate($request, [
			
			'cost_group_code' => 'required|max:6|unique:MASTER_CGROUP,CGROUP_CODE',
			'cost_group_name' => 'required|max:40',
			'cost_type_code'  => 'required|max:6',

		]);


    	$createdBy 	= $request->session()->get('userid');

		$data = array(
			"CGROUP_CODE" => $request->input('cost_group_code'),
			"CGROUP_NAME" => $request->input('cost_group_name'),
			"CTYPE_CODE"  => $request->input('cost_type_code'),
			"CREATED_BY"  => $createdBy,
			
		);

		$saveData = DB::table('MASTER_CGROUP')->insert($data);

		$discriptn_page = "Master cost group insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Group Was Successfully Added...!');
			return redirect('/Master/Cost-Center/View-Cost-Group-Mast');

		} else {

			$request->session()->flash('alert-error', 'Cost Group Can Not Added...!');
			return redirect('/Master/Cost-Center/View-Cost-Group-Mast');

		}

	}

	public function EditCostGroup($groupcode){

    	$title = 'Edit Cost Group Master';

    	//print_r($id);
    	$groupcode = base64_decode($groupcode);


    	if($groupcode!=''){
    	    $query = DB::table('MASTER_CGROUP');
			$query->where('CGROUP_CODE', $groupcode);
			$classData= $query->get()->first();

			$cost_group_code  = $classData->CGROUP_CODE;
			$cost_group_name  = $classData->CGROUP_NAME;
			$cost_type_code  = $classData->CTYPE_CODE;
			$cost_group_id    = $classData->CGROUP_CODE;
			$cost_group_block = $classData->CGROUP_BLOCK;

			$cost_type = DB::table('MASTER_CTYPE')->get();
			//print_r($rack_block);exit;

			$button='Update';
			$action='/Master/Cost-Center/COst-Group-Update';

			return view('admin.finance.master.costCenter.cost_group_form',compact('title','cost_group_code','cost_group_name','cost_type_code','cost_group_id','cost_group_block','cost_type','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Cost Group Not Found...!');
			return redirect('/Master/Cost-Center/View-Cost-Group-Mast');
		}

    }


    public function UpdateCostGroup(Request $request){

		$validate = $this->validate($request, [

			'cost_group_code' => 'required|max:6',
			'cost_group_name' => 'required|max:40',
			'cost_type_code'  => 'required|max:6',


		]);

		$cost_groupcode = $request->input('cost_group_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"CGROUP_CODE"      => $request->input('cost_group_code'),
			"CGROUP_NAME"      => $request->input('cost_group_name'),
			"CTYPE_CODE"       => $request->input('cost_type_code'),
			"CGROUP_BLOCK"     => $request->input('cost_group_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		try{
			$saveData = DB::table('MASTER_CGROUP')->where('CGROUP_CODE', $cost_groupcode)->update($data);

			$discriptn_page = "Master cost group update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Cost Group Was Successfully Updated...!');
				return redirect('/Master/Cost-Center/View-Cost-Group-Mast');

			} else {

				$request->session()->flash('alert-error', 'Cost Group Can Not Added...!');
				return redirect('/Master/Cost-Center/View-Cost-Group-Mast');

			}
		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Cost Group be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Cost-Center/View-Cost-Group-Mast');
		}

	}

	public function ViewCostGroup(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()){


	    	$title = 'View Cost Group Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

		    	$data = DB::table('MASTER_CGROUP')->orderBy('CGROUP_CODE','DESC');

	    	}elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_CGROUP')->orderBy('CGROUP_CODE','DESC');
	    	}else{
	    		$data ='';
	    	}

	    	return DataTables()->of($data)->addIndexColumn()->toJson();
		}
		if(isset($compName)){
	    	return view('admin.finance.master.costCenter.view_cost_group');
		}else{
			return redirect('/useractivity');
		}
	}


    public function DeleteCostGroup(Request $request){

		$costGroupCode = $request->post('costGroupId');
    	
    	if ($costGroupCode!='') {
    		try{
    		
	    		$Delete = DB::table('MASTER_CGROUP')->where('CGROUP_CODE', $costGroupCode)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Cost Group Was Deleted Successfully...!');
					return redirect('/Master/Cost-Center/View-Cost-Group-Mast');

				} else {

					$request->session()->flash('alert-error', 'Cost Group Can Not Deleted...!');
					return redirect('/Master/Cost-Center/View-Cost-Group-Mast');

				}
			}
			catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Group be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Cost-Center/View-Cost-Group-Mast');
			}


    	}else{

    		$request->session()->flash('alert-error', 'Cost Group Not Found...!');
			return redirect('/Master/Cost-Center/View-Cost-Group-Mast');

    	}

	}


	/*search Cost Group when click on help button*/
	
	public function HelpCostGroupCodeGet(Request $request){

		$response_array = array();

	    $CostGrpHelp = $request->input('CostGrpHelp');

		if ($request->ajax()) {

	    	$costgroup_code_by_help = DB::select("SELECT * FROM `MASTER_CGROUP` WHERE CGROUP_CODE='$CostGrpHelp' OR CGROUP_NAME='$CostGrpHelp' OR CGROUP_CODE Like '$CostGrpHelp%' OR CGROUP_CODE LIKE '$CostGrpHelp%' ORDER BY CGROUP_CODE DESC limit 5  ");
	    	
    		if ($costgroup_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costgroup_code_by_help ;

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

/*search Cost Group code when click on help button*/


/*search Cost Group code on input*/

	public function search_CostGroupCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$CostGrpSearch = $request->input('CostGrpSearch');

	    	$costgroupcode_list = DB::select("SELECT * FROM `MASTER_CGROUP` WHERE CGROUP_CODE LIKE '$CostGrpSearch%'");

	    	$count = count($costgroupcode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costgroupcode_list ;

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

/*search Cost Group code on input*/

/* ------ end cost group master --------- */


/* ---------- start cost master ----------- */

	public function AddCost(Request $request){

		$title        ='Add Cost Master';

		$compName = $request->session()->get('company_name');

		$userdata['costype_list']  = DB::table('MASTER_CTYPE')->get();
		$userdata['costgrp_list']  = DB::table('MASTER_CGROUP')->get();
		$userdata['costcatg_list'] = DB::table('MASTER_CCATG')->get();
		$userdata['costclss_list'] = DB::table('MASTER_CCLASS')->get();
		$userdata['cost_code_list'] = DB::table('MASTER_COST')->Orderby('COST_CODE', 'desc')->limit(5)->get();
	
	    if(isset($compName)){

	    	return view('admin.finance.master.costCenter.cost_master',$userdata+compact('title'));
	    }else{

			return redirect('/useractivity');
		}

    } 

    public function CostSave(Request $request){

		$validate = $this->validate($request, [

			'cost_code'      => 'required|max:6|unique:MASTER_COST,COST_CODE',
			'cost_name'      => 'required|max:40',
			'costtype_code'  => 'required|max:6',
			'costgroup_code' => 'required|max:6',
			'costcatg_code'  => 'required|max:6',
			'costclass_code' => 'required|max:6',

		]);

    	$createdBy 	= $request->session()->get('userid');
    	$compName 	= $request->session()->get('company_name');
    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(

			"COST_CODE"   => $request->input('cost_code'),
			"COST_NAME"   => $request->input('cost_name'),
			"CTYPE_CODE"  => $request->input('costtype_code'),
			"CTYPE_NAME"  => $request->input('costtype_name'),
			"CGROUP_CODE" => $request->input('costgroup_code'),
			"CGROUP_NAME" => $request->input('costgroup_name'),
			"CCATG_CODE"  => $request->input('costcatg_code'),
			"CCATG_NAME"  => $request->input('costcatg_name'),
			"CCLASS_CODE" => $request->input('costclass_code'),
			"CCLASS_NAME" => $request->input('costclass_name'),
			"CREATED_BY"  => $createdBy,
			
		);

		// print_r($data);exit();

		$saveData = DB::table('MASTER_COST')->insert($data);

		$discriptn_page = "Master cost insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Cost Master Was Successfully Added...!');
			return redirect('/Master/Cost-Center/View-Cost-Mast');

		} else {

			$request->session()->flash('alert-error', 'Cost Master Can Not Added...!');
			return redirect('/Master/Cost-Center/View-Cost-Mast');

		}

	}

	public function ViewCost(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()){

	    	$title = 'View Cost Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

				$data = DB::table('MASTER_COST')->orderBy('COST_CODE','DESC');
	    	
	    	}elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_COST')->orderBy('COST_CODE','DESC');
    		}else{
    			$data ='';
    		}

    		return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
		}
		if(isset($compName)){
    		return view('admin.finance.master.costCenter.view_cost_master');
		}else{
			return redirect('/useractivity');
	   	}
    }

    public function DeleteCost(Request $request){

        $id = $request->input('costid');

        if ($id!='') {

        	try{

				$Delete = DB::table('MASTER_COST')->where('COST_CODE', $id)->delete();

				if ($Delete) {

				$request->session()->flash('alert-success', 'Cost Data Was Deleted Successfully...!');
				return redirect('/Master/Cost-Center/View-Cost-Mast');

				} else {

				$request->session()->flash('alert-error', 'Cost Data Can Not Deleted...!');
				return redirect('/Master/Cost-Center/View-Cost-Mast');

				}
			}
			catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Cost Data be be Deleted...! Used In Another Transaction...!');
					return redirect('/Master/Cost-Center/View-Cost-Mast');
			}

		}else{

			$request->session()->flash('alert-error', 'Cost Data Not Found...!');
			return redirect('/Master/Cost-Center/View-Cost-Mast');

		}
	}


	public function EditCost(Request $request,$id,$btnControl){

    	$title = 'Edit Cost Master';

    	$id = base64_decode($id);
    	$btnControl = base64_decode($btnControl);

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($id!=''){
    	    $query = DB::table('MASTER_COST');
			$query->where('COST_CODE', $id);
			$userData['mastCost_list'] = $query->get()->first();

			
			$userData['costype_list']  = DB::table('MASTER_CTYPE')->get();
			$userData['costgrp_list']  = DB::table('MASTER_CGROUP')->get();
			$userData['costcatg_list'] = DB::table('MASTER_CCATG')->get();
			$userData['costclss_list'] = DB::table('MASTER_CCLASS')->get();

			return view('admin.finance.master.costCenter.edit_cost_mast', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Cost Id Not Found...!');
			return redirect('/Master/Cost-Center/View-Cost-Mast');
		}

    }

    public function UpdateCost(Request $request){
		
		$validate = $this->validate($request, [

			'cost_code'      => 'required|max:6',
			'cost_name'      => 'required|max:40',
			'costtype_code'  => 'required|max:6',
			'costgroup_code' => 'required|max:6',
			'costcatg_code'  => 'required|max:6',
			'costclass_code' => 'required|max:6',

		]);

        $id = $request->input('EcostId');
        $updatedDate = date("Y-m-d H:i:s");
        $createdBy      = $request->session()->get('userid');

		$data = array(

				"COST_CODE"        =>  $request->input('cost_code'),
				"COST_NAME"        =>  $request->input('cost_name'),
				"CTYPE_CODE"       =>  $request->input('costtype_code'),
				"CTYPE_NAME"       =>  $request->input('costtype_name'),
				"CGROUP_CODE"      =>  $request->input('costgroup_code'),
				"CGROUP_NAME"      =>  $request->input('costgroup_name'),
				"CCATG_CODE"       =>  $request->input('costcatg_code'),
				"CCATG_NAME"       =>  $request->input('costcatg_name'),
				"CCLASS_CODE"      =>  $request->input('costclass_code'),
				"CCLASS_NAME"      =>  $request->input('costclass_name'),
				"COST_BLOCK"       =>  $request->input('cost_block'),
				"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
				"LAST_UPDATE_DATE" =>  $updatedDate
	    	);

		// echo '<PRE>';print_r($data);exit();

		try{

			$saveData = DB::table('MASTER_COST')->where('COST_CODE', $id)->update($data);

			$discriptn_page = "Master cost update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Cost Was Successfully Updated...!');
				return redirect('/Master/Cost-Center/View-Cost-Mast');

			} else {

				$request->session()->flash('alert-error', 'Cost Can Not Updated...!');
				return redirect('/Master/Cost-Center/View-Cost-Mast');

			}
		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Cost Data be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Cost-Center/View-Cost-Mast');
		}
	}

	public function GetGroupCode(Request $request){
        
        $response_array = array();
    	
    	if($request->ajax()) {

    		$costtype_code = $request->post('costtype_code');
            
            if($costtype_code){

    	    	$getgroupcode = DB::table('MASTER_CGROUP')->where('CTYPE_CODE',$costtype_code)->get();

    	    	if(!empty($getgroupcode)){

	    	    	$response_array['response'] = 'success';
		            $response_array['data'] = $getgroupcode ;
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

    	}else{

    		$response_array['response'] = 'error';
            $response_array['data'] = '';
            $data = json_encode($response_array);
            print_r($data);

    	}

    }

    /*search cost when click on help button*/
	
	public function Helpcost_Get(Request $request){

		$response_array = array();

	    $CostCodeHelp = $request->input('CostCodeHelp');

		if ($request->ajax()) {

	    	$cost_code_by_help = DB::select("SELECT * FROM `MASTER_COST` WHERE COST_CODE='$CostCodeHelp' OR COST_NAME='$CostCodeHelp' OR COST_CODE Like '$CostCodeHelp%' OR COST_NAME LIKE '$CostCodeHelp%' ORDER BY COST_CODE DESC limit 5  ");
	    	
    		if ($cost_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $cost_code_by_help ;

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

/*search cost code when click on help button*/


/*search cost code on input*/

	public function search_costCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$CostCodeSearch = $request->input('CostCodeSearch');

	    	$costcode_list = DB::select("SELECT * FROM `MASTER_COST` WHERE COST_CODE LIKE '$CostCodeSearch%'");

	    	$count = count($costcode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $costcode_list ;

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

/*search cost code on input*/

/* --------- end cost master --------- */

/* ------- start valuation master ---------- */

	public function AddValuation(Request $request){

		$title        ='Add Valuation Master';

		$compName 	= $request->session()->get('company_name');
		
		$valuation_code  = $request->old('valuation_code');
		$valuation_name  = $request->old('valuation_name');
		$valuation_id    = $request->old('valuation_id');
		$valuation_block = $request->old('valuation_block');
		$valuation_type  = $request->old('valuation_type');

		$userData['valuation_lists'] = DB::table('MASTER_VALUATION')->Orderby('VALUATION_CODE', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/Master/Cost-Center/Valuation-Save';
		
		if(isset($compName)){
	    	return view('admin.finance.master.costCenter.valuation_form',$userData+compact('title','valuation_code','valuation_name','valuation_id','valuation_type','valuation_block','button','action'));
	    }else{
			return redirect('/useractivity');
		}

    } 

    public function ValuationSave(Request $request){

		$validate = $this->validate($request, [

			'valuation_code' => 'required|max:6|unique:MASTER_VALUATION,VALUATION_CODE',
			'valuation_name' => 'required|max:40',
			'valuation_type' => 'required|max:6',

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');
    
		$data = array(
			"VALUATION_CODE" => $request->input('valuation_code'),
			"VALUATION_NAME" => $request->input('valuation_name'),
			"VALUATION_TYPE" => $request->input('valuation_type'),
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData = DB::table('MASTER_VALUATION')->insert($data);

		$discriptn_page = "Master valuation insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Valuation Was Successfully Added...!');
			return redirect('/Master/Cost-Center/View-Valuation-Mast');

		} else {

			$request->session()->flash('alert-error', 'Valuation Can Not Added...!');
			return redirect('/Master/Cost-Center/View-Valuation-Mast');

		}

	}

	public function EditValuation($id){

    	$title = 'Edit Valuation Master';

    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('MASTER_VALUATION');
			$query->where('VALUATION_CODE', $id);
			$valData= $query->get()->first();

			$valuation_code  = $valData->VALUATION_CODE;
			$valuation_name  = $valData->VALUATION_NAME;
			$valuation_type  = $valData->VALUATION_TYPE;
			$valuation_block = $valData->VALUATION_BLOCK;
			$valuation_id    = $valData->VALUATION_CODE;
			$valuation_type    = $valData->VALUATION_TYPE;

			$button='Update';
			$action='/Master/Cost-Center/Valuation-Update';

			return view('admin.finance.master.costCenter.valuation_form',compact('title','valuation_code','valuation_name','valuation_type','valuation_id','valuation_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Config Not Found...!');
			return redirect('/Master/Cost-Center/View-Valuation-Mast');
		}

    }


    public function ValuationUpdate(Request $request){

		$validate = $this->validate($request, [

			'valuation_code' => 'required|max:6',
			'valuation_name' => 'required|max:40',
			'valuation_type' => 'required|max:6',

		]);

		$valuation_id = $request->input('valuation_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"VALUATION_CODE" => $request->input('valuation_code'),
			"VALUATION_NAME" => $request->input('valuation_name'),
			"VALUATION_TYPE" => $request->input('valuation_type'),
			"VALUATION_BLOCK"      => $request->input('valuation_block'),
			"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
			"LAST_UPDATE_DATE" =>  $updatedDate
			
		);

		try{
			$saveData = DB::table('MASTER_VALUATION')->where('VALUATION_CODE', $valuation_id)->update($data);

			$discriptn_page = "Master valuation update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Valuation Was Successfully Updated...!');
				return redirect('/Master/Cost-Center/View-Valuation-Mast');

			} else {

				$request->session()->flash('alert-error', 'Valuation Can Not Added...!');
				return redirect('/Master/Cost-Center/View-Valuation-Mast');

			}

		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Valuation Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Cost-Center/View-Valuation-Mast');
		}

	}

	public function ViewValuation(Request $request){

		$compName = $request->session()->get('company_name');

 		if($request->ajax()) {

	    	$title = 'View  Valuation Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    	$data = DB::table('MASTER_VALUATION')->orderBy('VALUATION_CODE','DESC');

	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_VALUATION')->orderBy('VALUATION_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

    		return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}
    	if(isset($compName)){
    		return view('admin.finance.master.costCenter.view_valuation');
    	}else{
			return redirect('/useractivity');
	    }
    }

    public function DeleteValuation(Request $request){

		$valId = $request->post('valId');
    	
    	if ($valId!='') {

    	try{
    		
    		$Delete = DB::table('MASTER_VALUATION')->where('VALUATION_CODE', $valId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Valuation Was Deleted Successfully...!');
				return redirect('/Master/Cost-Center/View-Valuation-Mast');

			} else {

				$request->session()->flash('alert-error', 'Valuation Can Not Deleted...!');
				return redirect('/Master/Cost-Center/View-Valuation-Mast');

			}
		}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Valuation Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Cost-Center/View-Valuation-Mast');
			}


    	}else{

    		$request->session()->flash('alert-error', 'Valuation Not Found...!');
			return redirect('/Master/Cost-Center/View-Valuation-Mast');

    	}

	}

	/*search Valuation code when click on help button*/
	
	public function HelpValuationSearch(Request $request){

		$response_array = array();

	    $ValuationCodeH = $request->input('ValuationCodeH');

		if ($request->ajax()) {

	    	$item_type_by_help = DB::select("SELECT * FROM `MASTER_VALUATION` WHERE VALUATION_CODE='$ValuationCodeH' OR VALUATION_NAME='$ValuationCodeH' OR VALUATION_CODE Like '$ValuationCodeH%' OR VALUATION_NAME LIKE '$ValuationCodeH%' ORDER BY VALUATION_NAME DESC limit 5  ");
	    	
    		if ($item_type_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_type_by_help ;

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

/*search Valuation code when click on help button*/


/*search Valuation code on input*/

	public function search_ValuationCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$Valuation_code = $request->input('SearchValuationC');

	    	$valuation_list = DB::select("SELECT * FROM `MASTER_VALUATION` WHERE VALUATION_CODE LIKE '$Valuation_code%'");

	    	$count = count($valuation_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $valuation_list ;

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

/*search Valuation code on input*/

/* -------- end valuation master --------- */

/* ---------- start valuation tran master ---------- */

	public function ValuationTran(Request $request){

		$title      = 'Add Valuation Transaction';
		
		$compName   = $request->session()->get('company_name');
		
		$val_code   = $request->old('valution_code');
		$comp_code  = $request->old('comp_code');
		$trans_code = $request->old('transaction_code');
		$item_type  = $request->old('item_type');
		$drgl_code  = $request->old('drgl_code');
		$crgl_code  = $request->old('crgl_code');
		$idvaltrans = $request->old('idvaltrans');
		$button     ='Save';
		
		$action      = '/Master/Cost-Center/Valuation-Tran-Save';

    	$userdata['valution_code'] = DB::table('MASTER_VALUATION')->get();
    	$userdata['itmtype_list'] = DB::table('MASTER_ITEMTYPE')->get();
    	$userdata['comp_list'] = DB::table('MASTER_COMP')->get();

		if(isset($compName)){

	    	return view('admin.finance.master.costCenter.valuation_trans',$userdata+compact('title','comp_code','val_code','trans_code','item_type','drgl_code','crgl_code','idvaltrans','action','button'));

	    }else{

			return redirect('/useractivity');
		}

    }

    public function ValuationTransSave(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$loginUser = $request->session()->get('userid');

		$validate = $this->validate($request, [

				'comp_code'     => 'required|max:6',
				'valution_code' => 'required|max:6',
				'item_type'     => 'required|max:6',
				'drgl_code'     => 'required|max:6',
				'crgl_code'     => 'required|max:6',	
		]);


		$data = array(
			"COMP_CODE"      =>  $request->input('comp_code'),
			"VALUATION_CODE" =>  $request->input('valution_code'),
			"ITEM_TYPE"      =>  $request->input('item_type'),
			"DRGL_CODE"      =>  $request->input('drgl_code'),
			"CRGL_CODE"      =>  $request->input('crgl_code'),
			"CREATED_BY"     =>  $request->session()->get('userid'),
	    );

		$saveData = DB::table('MASTER_VALUATION_TRAN')->insert($data);

		$discriptn_page = "Master valuation tran insert done by user";
		$this->userLogInsert($loginUser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Valuation Transaction Successfully Added...!');
				return redirect('/Master/Cost-Center/View-Valuation-Tran-Mast');

			} else {

				$request->session()->flash('alert-error', 'Valuation Transaction Can Not Added...!');
				return redirect('/Master/Cost-Center/View-Valuation-Tran-Mast');

			}

	}
	
	public function ViewValuationTran(Request $request){

		$CompanyCode = $request->session()->get('company_name');

		if($request->ajax()){

			$user_type   = $request->session()->get('user_type');
			
			$userid      = $request->session()->get('userid');
			
			$CompanyCode = $request->session()->get('company_name');
			
			$macc_year   = $request->session()->get('macc_year');

			if($user_type == 'admin'){
    		
	       	 	//DB::enableQueryLog();
	       	 	 $data = DB::table('MASTER_VALUATION_TRAN')
	            ->join('MASTER_VALUATION','MASTER_VALUATION_TRAN.VALUATION_CODE', '=', 'MASTER_VALUATION.VALUATION_CODE')
	            ->select('MASTER_VALUATION_TRAN.*', 'MASTER_VALUATION.valuation_name')
	            ->orderBy('VALUATION_CODE','DESC');
	         
	           //dd(DB::getQueryLog());

    		}else if($user_type == 'superAdmin' || $user_type == 'user'){

	    	  $data = DB::table('MASTER_VALUATION_TRAN')
	            ->join('MASTER_VALUATION','MASTER_VALUATION_TRAN.VALUATION_CODE', '=', 'MASTER_VALUATION.VALUATION_CODE')
	            ->select('MASTER_VALUATION_TRAN.*', 'MASTER_VALUATION.valuation_name')
	            ->orderBy('VALUATION_CODE','DESC');

	    	}else{
	    		
	    	 $data = '';
	    	}

    		return DataTables()->of($data)->addIndexColumn()->toJson();

    	}

       $title = 'Valuation Transaction List';

       if(isset($CompanyCode)){
       		return view('admin.finance.master.costCenter.valuation_trans_list');
   		}else{
			return redirect('/useractivity');
		}

    }


    public function EditValuationTran($id){


    	$title = 'Edit Valuation Transaction';

    	//print_r($id);
    	$id = base64_decode($id);

    	if($id!=''){

			$query        = DB::table('MASTER_VALUATION_TRAN');
			$query->where('VALUATION_CODE', $id);
			$valTransData = $query->get()->first();
			
			$comp_code      = $valTransData->COMP_CODE;
			$valuation_code = $valTransData->VALUATION_CODE;
			$item_type      = $valTransData->ITEM_TYPE;
			$drgl_code      = $valTransData->DRGL_CODE;
			$crgl_code      = $valTransData->CRGL_CODE;
			$valtran_block  = $valTransData->VALUATION_TRAN_BLOCK;
			$idvaltrans     = $valTransData->VALUATION_CODE;

			$button ='Update';

			$action ='/Master/Cost-Center/Valution-Tran-Update';

			$userdata['valution_code'] = DB::table('MASTER_VALUATION')->get();
	    	$userdata['itmtype_list'] = DB::table('MASTER_ITEMTYPE')->get();
	    	$userdata['comp_list'] = DB::table('MASTER_COMP')->get();

			return view('admin.finance.master.costCenter.valuation_trans',$userdata+compact('title','valuation_code','comp_code','item_type','drgl_code','crgl_code','valtran_block','idvaltrans','button','action'));

		}else{

			$request->session()->flash('alert-error', 'Valuation Tran Record Not Found...!');
			return redirect('/Master/Cost-Center/View-Valuation-Tran-Mast');

		}

    }

    public function UpdateValuationTran(Request $request){

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$loginUser =  $request->session()->get('userid');

		$validate = $this->validate($request, [

				'comp_code'     => 'required|max:6',
				'valution_code' => 'required|max:6',
				'item_type'     => 'required|max:6',
				'drgl_code'     => 'required|max:6',
				'crgl_code'     => 'required|max:6',	
		]);

		$valtranBlock = 0;
		$flag = 1;

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$id = $request->input('idvaltrans');


		$data = array(
			"COMP_CODE"            =>  $request->input('comp_code'),
			"VALUATION_CODE"       =>  $request->input('valution_code'),
			"ITEM_TYPE"            =>  $request->input('item_type'),
			"DRGL_CODE"            =>  $request->input('drgl_code'),
			"CRGL_CODE"            =>  $request->input('crgl_code'),
			"VALUATION_TRAN_BLOCK" =>  $request->input('valtran_block'),
			"LAST_UPDATE_BY"       =>  $request->session()->get('userid'),
			"LAST_UPDATE_DATE"     =>  $updatedDate,
			
	    );


		$UpdatedData = DB::table('MASTER_VALUATION_TRAN')->where('VALUATION_CODE', $id)->update($data);

		$discriptn_page = "Master valuation tran update done by user";
		$this->userLogInsert($loginUser,$discriptn_page);

			if ($UpdatedData) {

				$request->session()->flash('alert-success', 'Valuation Transaction Updated Successfully...!');
				return redirect('/Master/Cost-Center/View-Valuation-Tran-Mast');

			} else {

				$request->session()->flash('alert-error', 'Valuation Transaction Can Not Updated...!');
				return redirect('/Master/Cost-Center/View-Valuation-Tran-Mast');

			}

    }


     public function DeleteValuationTrans(Request $request){

        $id = $request->input('valTransId');

        if ($id!='') {

			$Delete = DB::table('MASTER_VALUATION_TRAN')->where('VALUATION_CODE', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Valuation Trans. Record Was Deleted Successfully...!');
			return redirect('/Master/Cost-Center/View-Valuation-Tran-Mast');

			} else {

			$request->session()->flash('alert-error', 'Valuation Trans. Record Can Not Deleted...!');
			return redirect('/Master/Cost-Center/View-Valuation-Tran-Mast');

			}

		}else{

		$request->session()->flash('alert-error', 'Valuation Trans. Record Not Found...!');
		return redirect('/Master/Cost-Center/View-Valuation-Tran-Mast');

		}
	}


/* ---------- end valuation tran master ---------- */

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

?>