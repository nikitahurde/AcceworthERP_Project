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
class GlController extends Controller{

	//public $data;

	public function __construct(Request $request){

		//$this->data = "smit@121";

	}




/* -------------------- START GENERAL LEDGER ----------------------*/

/* ------ start glsch master ------- */

	public function Glsch(Request $request){

		$title = 'Add Master GLSCH';

		$compName 	= $request->session()->get('company_name');

		$glschData['help_glsch_list'] = DB::table('MASTER_GLSCH')->Orderby('GLSCH_CODE', 'desc')->limit(5)->get();

	    if(isset($compName)){

	    	return view('admin.finance.master.generalLedger.glsch_form',$glschData+compact('title'));
	    }else{

			return redirect('/useractivity');
		}

	}

	public function SaveGlsch(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');
    	$loginuser = $request->session()->get('userid');
    	$glschcode =  $request->input('glsch_code');
    	
    	$glschtype = DB::table('MASTER_GLSCH')->where('GLSCH_CODE',$glschcode)->get();
    	$glsch_type='';
    	foreach ($glschtype as $key) {
    		$glsch_type = $key->GLSCH_TYPE;
    	}

		$rules = [
			        'glsch_type'  => 'required|max:12',
					'glsch_code'  => 'required|max:6|unique:MASTER_GLSCH,GLSCH_CODE',
					'glsch_name'  => 'required|max:40',
					'glsch_seqno' => 'required|max:4',
			    ];

			    $customMessages = [
			        'glsch_code.unique'=>'The glsch code has already been taken for '.$glsch_type.' GLSCH type',
			    ];

			    $this->validate($request, $rules, $customMessages);


		$data = array(

					"GLSCH_TYPE"  =>  $request->input('glsch_type'),
					"GLSCH_TYPE_NAME"  =>  $request->input('glsch_type_name'),
					"GLSCH_CODE"  =>  $request->input('glsch_code'),
					"GLSCH_NAME"  =>  $request->input('glsch_name'),
					"GLSCH_SEQNO" =>  $request->input('glsch_seqno'),
					"CREATED_BY"  =>  $request->session()->get('userid'),
	 
	    	);

		$saveData = DB::table('MASTER_GLSCH')->insert($data);

		$discriptn_page = "Master glsch insert done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'GLSCH Was Successfully Added...!');
			return redirect('/Master/General-Ledger/View-Glsch');

		} else {

			$request->session()->flash('alert-error', 'GLSCH Can Not Added...!');
			return redirect('/Master/General-Ledger/View-Glsch');

		}

	}


	public function ViewGlsch(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	       	$title = 'View Master Glsch';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){	

	    	 $data = DB::table('MASTER_GLSCH')->orderBy('GLSCH_CODE','ASC');

	    	//print_r($GlschData['glsch_data']);exit;
	    	}elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_GLSCH')->orderBy('GLSCH_CODE','ASC');
	    	}else{
	    		$data='';
	    	}

		    return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}

    	if(isset($compName)){	
    		return view('admin.finance.master.generalLedger.view_glsch');
    	}else{
		 	return redirect('/useractivity');
	   	}
    }


    public function DeleteGlsch(Request $request){

        $glschcode = $request->input('id');
        if ($glschcode!='') {

        	try
		{


			$Delete = DB::table('MASTER_GLSCH')->where('GLSCH_CODE', $glschcode)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'GLSCH Data Was Deleted Successfully...!');
			return redirect('/Master/General-Ledger/View-Glsch');

			} else {

			$request->session()->flash('alert-error', 'GLSCH Data Can Not Deleted...!');
			return redirect('/Master/General-Ledger/View-Glsch');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'GLSCH Cannot be be Deleted...! Used In Another Transaction...!');
					return redirect('/Master/General-Ledger/View-Glsch');
			}

		}else{

		$request->session()->flash('alert-error', 'GLSCH Data Not Found...!');
		return redirect('/Master/General-Ledger/View-Glsch');

		}
	}


	public function EditGlsch($id){

    	$title = 'Edit GLSCH';

    	//print_r($id);
    	$glschcode = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);

    	if($glschcode!=''){
    	    $query = DB::table('MASTER_GLSCH');
			$query->where('GLSCH_CODE', $glschcode);
			$userData['glsch_list'] = $query->get()->first();


			return view('admin.finance.master.generalLedger.edit_glsch', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'GLSCH Id Not Found...!');
			return redirect('/Master/General-Ledger/View-Glsch');
		}

    }

     public function UpdateGlsch(Request $request){
	
		$validate = $this->validate($request, [

				'glsch_type'  => 'required|max:12',
				'glsch_code'  => 'required|max:6',
				'glsch_name'  => 'required|max:40',
				'glsch_seqno' => 'required|max:4',

		]);

       $glschcode = $request->input('glschCod');
       $updatedDate = date('Y-m-d');
       $loginuser = $request->session()->get('userid');

		$data = array(
					"GLSCH_TYPE"      =>  $request->input('glsch_type'),
					"GLSCH_CODE"      =>  $request->input('glsch_code'),
					"GLSCH_NAME"      =>  $request->input('glsch_name'),
					"GLSCH_SEQNO"     =>  $request->input('glsch_seqno'),
					"GLSCH_BLOCK"     =>  $request->input('glsch_block'),
					"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
					"LAST_UPDATE_DATE" =>  $updatedDate
	 
	    	);

		$saveData = DB::table('MASTER_GLSCH')->where('GLSCH_CODE', $glschcode)->update($data);
		$discriptn_page = "Master glsch update done by user";
		$this->userLogInsert($loginuser,$discriptn_page);
		try
		{

			if ($saveData) {

				$request->session()->flash('alert-success', 'GLSCH Was Successfully Updated...!');
				return redirect('/Master/General-Ledger/View-Glsch');

			} else {

				$request->session()->flash('alert-error', 'GLSCH Can Not Updated...!');
				return redirect('/Master/General-Ledger/View-Glsch');

			}

		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Glsch Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/General-Ledger/View-Glsch');
		}

	}

	public function HelpGlschCodeSearch(Request $request){

		$response_array = array();

	    $glsch_code_help = $request->input('HelpglschCode');

		if ($request->ajax()) {

	    	$Seach_glsch_Code_by_help = DB::select("SELECT * FROM `MASTER_GLSCH` WHERE GLSCH_CODE='$glsch_code_help' OR GLSCH_NAME='$glsch_code_help' OR GLSCH_CODE Like '$glsch_code_help%' OR GLSCH_NAME LIKE '$glsch_code_help%' ORDER BY GLSCH_CODE DESC limit 5  ");
	    	
    		if ($Seach_glsch_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_glsch_Code_by_help;

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

    public function search_GlschType(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$glschType = $request->input('glschType');

	    	$glschtyp_list = DB::select("SELECT * FROM `MASTER_GLSCH` WHERE GLSCH_TYPE='$glschType' ORDER BY GLSCH_CODE DESC LIMIT 5 ");

	    	if ($glschtyp_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $glschtyp_list ;

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

    public function GlSchList(Request $request){

      $gltype_code = $request->gltypeCode;

      $response_array = array();

	  if ($request->ajax()) {

	  	 if($gltype_code){

	  	 	$glsch_list = DB::table('MASTER_GLSCH')->where('GLSCH_TYPE',$gltype_code)->get();

	  	 	if($glsch_list){

	  	 		$response_array['response'] = 'success';
	            $response_array['data'] = $glsch_list ;

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

	  }else{

	    $response_array['response'] = 'error';
        $response_array['data'] = '' ;

        $data = json_encode($response_array);

        print_r($data);

	  }

     

      
    }

    public function search_GlschCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$glsch_code = $request->input('glsch_code');

	    	$glsch_list = DB::select("SELECT * FROM `MASTER_GLSCH` WHERE GLSCH_CODE LIKE '$glsch_code%'");

	    	$count = count($glsch_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $glsch_list ;

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

/* ----- end glsch master ------*/

/* ------- start gl master ---------*/

	public function GlMast(Request $request){

		$title = 'Add Master GL';

		$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');


		$userData['glsch_lists']  = DB::table('MASTER_GLSCH')->get();

		$userData['comp_list'] = DB::table('MASTER_COMP')->get();
		$userData['help_gl_list'] = DB::table('MASTER_GL')->Orderby('GL_CODE', 'desc')->limit(5)->get();

		if(isset($compName)){

	    	return view('admin.finance.master.generalLedger.gl_form',$userData+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

	}

	public function glschForGenerateGlCode(Request $request){

		$response_array = array();

	    $glschCode = $request->input('glschCode');

		if ($request->ajax()) {

	    	$Seach_glschCode = DB::table('MASTER_GL')->where('GLSCH_CODE',$glschCode)->get();
	    	
    		if ($Seach_glschCode) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_glschCode ;

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

	public function SaveGlMast(Request $request){

		$compName 	= $request->session()->get('company_name');
    	$fisYear 	=  $request->session()->get('macc_year');
    	$loginuser  =  $request->session()->get('userid');


		$validate = $this->validate($request, [

				'gl_code'    => 'required|unique:MASTER_GL,GL_CODE',
				'gl_name'    => 'required|max:40',
				'glsch_type' => 'required',
				'glsch_code' => 'required'

		]);

		$glschtype = $request->input('glsch_type');
        $glsch_type = '';
        $glschtype_name = '';

		if($glschtype){

			$genglschtype = explode('[',$glschtype);
			$glsch_type   = $genglschtype[0];
			$glschtype_cn  = explode(']', $genglschtype[1]);
			$glschtype_name   = $glschtype_cn[0];
		}

		$glschcode = $request->input('glsch_code');
        $glsch_code = '';
        $glsch_name = '';

		if($glschcode){

			$genglschcn  = explode('[',$glschcode);
			$glsch_code  = $genglschcn[0];
			$genglsch_cn = explode(']', $genglschcn[1]);
			$glsch_name  = $genglsch_cn[0];
		}
       

		$data = array(

			"COMP_CODE"      =>  $request->input('comp_code'),
			"COMP_NAME"      =>  $request->input('comp_name'),
			"GL_CODE"        =>  $request->input('gl_code'),
			"GL_NAME"        =>  $request->input('gl_name'),
			"GLSCH_TYPE"     =>  $glsch_type,
			"GLSCHTYPE_NAME" =>  $glschtype_name,
			"GLSCH_CODE"     =>  $glsch_code,
			"GLSCH_NAME"     =>  $glsch_name,
			"ACCOUNT_TAG"    =>  $request->input('account_tag'),
			"COST_TAG"       =>  $request->input('cost_tag'),
			"ASSET_TAG"      =>  $request->input('asset_tag'),
			"AUTOPOSTING"    =>  $request->input('autoposting'),
			"CREATED_BY"     =>  $request->session()->get('userid'),
					
	    );

		// echo '<PRE>';print_r($data);exit();

		$saveData = DB::table('MASTER_GL')->insert($data);

		$discriptn_page = "Master gl insert done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Gl Was Successfully Added...!');
				return redirect('/Master/General-Ledger/View-Gl-Mast');

			} else {

				$request->session()->flash('alert-error', 'Gl Can Not Added...!');
				return redirect('/Master/General-Ledger/View-Gl-Mast');

			}

	}


	public function ViewGlMast(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

       		$title = 'View Gl';

    		$userid	= $request->session()->get('userid');

    		$userType = $request->session()->get('usertype');

    		$compName = $request->session()->get('company_name');
    		$slipComp = explode('-',$compName);
    		$compCode = $slipComp[0];

    		$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    		$data = DB::select("SELECT * FROM `MASTER_GL` WHERE COMP_CODE IS NULL OR COMP_CODE='$compCode'");

	    	}
	    	elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::select("SELECT * FROM `MASTER_GL` WHERE COMP_CODE IS NULL OR COMP_CODE='$compCode'");
	    	}
	    	else{
	    		$data ='';
	    	}

    	 	//return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
    	 	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	         })->toJson();
		}
		if(isset($compName)){
	    	return view('admin.finance.master.generalLedger.view_glmast');
		}else{
			return redirect('/useractivity');
		}

    }


    public function DeleteGl(Request $request){

        $glcode = $request->input('id');
        if ($glcode!='') {

       try{

			$Delete = DB::table('MASTER_GL')->where('GL_CODE', $glcode)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Gl Data Was Deleted Successfully...!');
			return redirect('/Master/General-Ledger/View-Gl-Mast');

			} else {

			$request->session()->flash('alert-error', 'Gl Data Can Not Deleted...!');
			return redirect('/Master/General-Ledger/View-Gl-Mast');

			}
		}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Gl Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/General-Ledger/View-Gl-Mast');
			}

		}else{

		$request->session()->flash('alert-error', 'Gl data Not Found...!');
		return redirect('/Master/General-Ledger/View-Gl-Mast');

		}
	}

	public function EditGlMast(Request $request,$id){

    	$title = 'Edit Gl';

    	$glcode = base64_decode($id);
    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($glcode!=''){
    	    $query = DB::table('MASTER_GL');
			$query->where('GL_CODE', $glcode);
			$userData['gl_list'] = $query->get()->first();

			$userData['comp_list'] = DB::table('MASTER_COMP')->get();

			$userData['glsch_lists']  = DB::table('MASTER_GLSCH')->get();

			return view('admin.finance.master.generalLedger.edit_gl_mast', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Gl Id Not Found...!');
			return redirect('/Master/General-Ledger/View-Gl-Mast');
		}

    }


    public function UpdateGlMast(Request $request){

		
		$validate = $this->validate($request, [

				'gl_code'    => 'required|max:6',
				'gl_name'    => 'required|max:40',
				'glsch_type' => 'required|max:12',
				'glsch_code' => 'required|max:6'

		]);

       $glcode = $request->input('glmast_id');
       $updatedDate = date('Y-m-d');
       $loginuser = $request->session()->get('userid');

       //print_r($request->post());

		$data = array(
			
			"COMP_CODE"        =>  $request->input('comp_code'),
			"COMP_NAME"        =>  $request->input('comp_name'),
			"GL_CODE"          =>  $request->input('gl_code'),
			"GL_NAME"          =>  $request->input('gl_name'),
			"GLSCH_TYPE"       =>  $request->input('glsch_type'),
			"GLSCHTYPE_NAME"   =>  $request->input('gltype_name'),
			"GLSCH_CODE"       =>  $request->input('glsch_code'),
			"GLSCH_NAME"       =>  $request->input('glsch_name'),
			"ACCOUNT_TAG"      =>  $request->input('account_tag'),
			"COST_TAG"         =>  $request->input('cost_tag'),
			"ASSET_TAG"        =>  $request->input('asset_tag'),
			"AUTOPOSTING"      =>  $request->input('autoposting'),
			"GL_BLOCK"         =>  $request->input('gl_block'),
			"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
			"LAST_UPDATE_DATE" =>  $updatedDate
					
	    );

	    // echo '<PRE>';print_r($data);exit();

		$saveData = DB::table('MASTER_GL')->where('GL_CODE', $glcode)->update($data);

		$discriptn_page = "Master gl update done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

		try{

			if ($saveData) {

				$request->session()->flash('alert-success', 'Gl Was Successfully Updated...!');
				return redirect('/Master/General-Ledger/View-Gl-Mast');

			} else {

				$request->session()->flash('alert-error', 'Gl Can Not Updated...!');
				return redirect('/Master/General-Ledger/View-Gl-Mast');

			} 
		}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Gl Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/General-Ledger/View-Gl-Mast');
			}

	}

/* ------ end gl mast ----- */

/* ------ start glbal mast ---- */

	public function GlBalMast(Request $request){

		$title        ='Add Gl Balence Master';

		$compName = $request->session()->get('company_name');
		$splitName = explode('-',$compName);
		$compCode =$splitName[0];
		$comp_name =$splitName[1];

    	$fisYear =  $request->session()->get('macc_year');
    	

		$item_code  = $request->old('item_code');
		$rack_code  = $request->old('rack_code');
		$item_rack_id    = $request->old('item_rack_id');
		$item_rack_block = $request->old('item_rack_block');

    	$button='Save';
    	$action='/finance/form-gl-bal-save';
		$data['comp_list'] = DB::table('MASTER_COMP')->where('COMP_CODE','!=',$compCode)->get();

		$data['fy_list']   = DB::table('MASTER_FY')->get();

		$data['pfct_list'] = DB::table('MASTER_PFCT')->where('COMP_CODE',$compCode)->get();
		$data['gl_list']   = DB::table('MASTER_GL')->where('COMP_CODE',$compCode)->orWhereNull('COMP_CODE')->get();

		// print_r($data['gl_list'] );exit();
	
	    if(isset($compName)){

	    	return view('admin.finance.master.generalLedger.gl_bal_form',$data+compact('title','item_code','rack_code','item_rack_id','item_rack_block','comp_name','fisYear','button','action','compCode'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function GlBalFormSave(Request $request){

		$rules = [	
				'comp_code' => 'required|max:6',
				'fy_code'   => 'required|max:11',
				'pfct_code' => 'required|max:6',
				'gl_code'   => 'required|max:6',
				'gl_code'   => ['required', 'string',Rule::unique('MASTER_GLBAL')->where(function ($query) use ($request) {
				    return $query->where('GL_CODE', $request->gl_code)->where('COMP_CODE', $request->comp_code)->where('FY_CODE', $request->fy_code);
						})],
		    ];

	    $customMessages = [
	        'gl_code.unique'=>'The gl code has already been taken for this comp code and fy code.',
	    ];

	    $this->validate($request, $rules, $customMessages);


    	$createdBy 	= $request->session()->get('userid');
		$data = array(
			"COMP_CODE"   => $request->input('comp_code'),
			"COMP_NAME"   => $request->input('comp_name'),
			"FY_CODE"     => $request->input('fy_code'),
			"PFCT_CODE"   => $request->input('pfct_code'),
			"PFCT_NAME"   => $request->input('pfct_name'),
			"GL_CODE"     => $request->input('gl_code'),
			"GL_NAME"     => $request->input('gl_name'),
			"YROPDR"      => $request->input('pdr_code'),
			"YROPCR"      => $request->input('pcr_code'),
			"created_by"  => $createdBy,
			
		);

		$saveData = DB::table('MASTER_GLBAL')->insert($data);

		$discriptn_page = "Master gl balence insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Gl Bal Was Successfully Added...!');
			return redirect('/Master/General-Ledger/View-Gl-Bal-Mast');

		} else {

			$request->session()->flash('alert-error', 'Gl Bal Can Not Added...!');
			return redirect('/Master/General-Ledger/View-Gl-Bal-Mast');

		}

	}

	public function EditGlBalMast(Request $request,$id,$btnControl){

    	$title = 'Edit Master Department';

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');


    	//print_r($id);
    	$GL_CODE = base64_decode($id);
    	//print_r($id);exit;
    	$btnControl = base64_decode($btnControl);


    	if($GL_CODE!=''){
    	    $query = DB::table('MASTER_GLBAL');
			$query->where('GL_CODE', $GL_CODE);
			$glbalData['glbal_list'] = $query->get()->first();


			$button='Update';
    	    $action='/finance/form-mast-gl-bal-update';

		   $glbalData['comp_list'] = DB::table('MASTER_COMP')->get();
		   $glbalData['fy_list']   = DB::table('MASTER_FY')->get();
		   $glbalData['pfct_list'] = DB::table('MASTER_PFCT')->get();
		   $glbalData['gl_list']   = DB::table('MASTER_GL')->get();
			//print_r($userData['transaction_list']);exit;
			return view('admin.finance.master.generalLedger.edit_gl_bal_form', $glbalData+compact('title','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('/finance/view-gl-bal-mastt');
		}

    }
	 

    public function GlBalFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'comp_code' => 'required|max:6',
			'fy_code'   => 'required|max:9',
			'pfct_code' => 'required|max:6',
			'gl_code'   => 'required|max:6',

		]);

		$GL_CODE = $request->input('gl_code');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


    	$data = array(
			"COMP_CODE"      => $request->input('comp_code'),
			"FY_CODE"        => $request->input('fy_code'),
			"PFCT_CODE"      => $request->input('pfct_code'),
			"GL_CODE"        => $request->input('gl_code'),
			"YROPDR"         => $request->input('pdr_code'),
			"YROPCR"         => $request->input('pcr_code'),
			"GLBAL_BLOCK"    => $request->input('glbal_block'),
			"LAST_UPDATE_BY" => $updatedDate,
			
		);

    	
	$saveData = DB::table('MASTER_GLBAL')->where('GL_CODE', $GL_CODE)->update($data);

	$discriptn_page = "Master gl balence update done by user";
	$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Gl Bal Was Successfully Updated...!');
			return redirect('/Master/General-Ledger/View-Gl-Bal-Mast');

		} else {

			$request->session()->flash('alert-error', 'Gl Bal Can Not Added...!');
			return redirect('/Master/General-Ledger/View-Gl-Bal-Mast');

		}

	}

	public function ViewGlBalMast(Request $request){

		$compName  = $request->session()->get('company_name');
		$splitData = explode('-',$compName);
		$comp_code = $splitData[0];

		if($request->ajax()){

	    	$title = 'View GL Balence Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

		    	$data = DB::table('MASTER_GLBAL')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear);
		           

		    	return DataTables()->of($data)->addIndexColumn()->toJson();
	   		}
   		}
   		
	   	if(isset($compName)){
	    	return view('admin.finance.master.generalLedger.view_gl_bal');
	   	}else{
			return redirect('/useractivity');
	   	}
    }


    public function DeleteGlBal(Request $request){

		$glbalId = $request->post('glbalId');
    	

    	if ($glbalId!='') {
    		
    		$Delete = DB::table('MASTER_GLBAL')->where('id', $glbalId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Gl Bal Was Deleted Successfully...!');
				return redirect('/finance/view-gl-bal-mast');

			} else {

				$request->session()->flash('alert-error', 'Gl Bal Can Not Deleted...!');
				return redirect('/finance/view-gl-bal-mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Item Rack Not Found...!');
			return redirect('/finance/view-mast-item-rack');

    	}

	}
/* ------ end glbal mast ---- */

/* ------ start gl key ------ */

	public function GlKey(Request $request){

		$title       = 'Add GL Key Master';
		
		$compName    = $request->session()->get('company_name');
		
		$fisYear     =  $request->session()->get('macc_year');
		
		$glkeycode   = $request->old('glkey_code');
		$glcode      = $request->old('gl_code');
		$glname      = $request->old('gl_name');
		$acctypecode = $request->old('acctype_code');
		$acctypename = $request->old('acctype_name');
		$amt_type    = $request->old('amt_type');
		$key_id      = $request->old('key_id');
		$glkey_block = $request->old('glkey_block');

		$userData['gl_code_list']      = DB::table('MASTER_GL')->get();
		
		$userData['acctype_code_list'] = DB::table('MASTER_ACCTYPE')->get();
		
		$userData['glkey_mst_list']    = DB::table('MASTER_GLKEY')->Orderby('GLKEY_CODE', 'desc')->limit(5)->get();

		$button='Save';

    	$action='/finance/form-mast-glkey-save';
		
		if(isset($compName)){

	    	return view('admin.finance.master.generalLedger.gl_key_mast',$userData+compact('button','action','glkeycode','glcode','acctypecode','glkey_block','amt_type','key_id','glname','acctypename'));

	    }else{

			return redirect('/useractivity');
		}

	}

	public function SaveGlKey(Request $request){

		$compName  = $request->session()->get('company_name');

		$fisYear   =  $request->session()->get('macc_year');

		$loginuser =  $request->session()->get('userid');

		$rules = [	
					'glkey_code'   => 'required|max:4',
					'gl_code'      => 'required|max:6',
					'acctype_code' => 'required|max:6',
					'amt_type'     => 'required|max:1',
					'glkey_code'   => ['required', 'string',Rule::unique('MASTER_GLKEY')->where(function ($query) use ($request) {
					    return $query->where('GLKEY_CODE', $request->glkey_code)->where('GL_CODE', $request->gl_code);
							})],
			    ];

			    $customMessages = [
			        'glkey_code.unique'=>'The Glkey Code has already been taken for this Gl Code.',
			    ];

			    $this->validate($request, $rules, $customMessages);

		$data = array(
			"GLKEY_CODE" =>  $request->input('glkey_code'),
			"GL_CODE"    =>  $request->input('gl_code'),
			"GL_NAME"    =>  $request->input('gl_name'),
			"ATYPE_CODE" =>  $request->input('acctype_code'),
			"ATYPE_NAME" =>  $request->input('acctype_name'),
			"AMT_TYPE"   =>  $request->input('amt_type'),
			"CREATED_BY" =>  $request->session()->get('userid'),
					
	    	);

		$saveData = DB::table('MASTER_GLKEY')->insert($data);

		$discriptn_page = "Master gl key insert done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Tax Was Successfully Added...!');
			return redirect('/Master/General-Ledger/View-Gl-Key-Mast');

		} else {

			$request->session()->flash('alert-error', 'Tax Can Not Added...!');
			return redirect('/Master/General-Ledger/View-Gl-Key-Mast');

		}

	}

	public function ViewGlKey(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()){

	      	$title = 'View Gl Key';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 $data = DB::table('MASTER_GLKEY')->orderBy('GLKEY_CODE','DESC');

	    	}elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_GLKEY')->orderBy('GLKEY_CODE','DESC');
	    	}else{
	    		$data ='';
	    	}

    		return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
		}
		if(isset($compName)){
	    	return view('admin.finance.master.generalLedger.view_gl_key');
		}else{
			return redirect('/useractivity');
		}

    }


    public function DeleteGlKey(Request $request){

		$glkeycode = $request->input('glkeyId');
		$glkeycd   = explode('/',$glkeycode);
		$glkey = $glkeycd[0];
		$glCd = $glkeycd[1];

        if ($glkeycode!='') {
			try{
				$Delete = DB::table('MASTER_GLKEY')->where('GLKEY_CODE', $glkey)->where('GL_CODE', $glCd)->delete();

				if($Delete) {

				$request->session()->flash('alert-success', 'Gl Key Was Deleted Successfully...!');
				return redirect('/Master/General-Ledger/View-Gl-Key-Mast');

				} else {

				$request->session()->flash('alert-error', 'Gl Key Can Not Deleted...!');
				return redirect('/Master/General-Ledger/View-Gl-Key-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Gl Key Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/General-Ledger/View-Gl-Key-Mast');
			}

		}else{

			$request->session()->flash('alert-error', 'Gl Key Not Found...!');
			return redirect('/Master/General-Ledger/View-Gl-Key-Mast');

		}
	}

	public function EditGlKey(Request $request,$id,$glcd){

    	$title = 'Edit Gl Key Master';

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	$glkeycode = base64_decode($id);
    	$glcode = base64_decode($glcd);

    	if($glkeycode!=''){
			$query       = DB::table('MASTER_GLKEY');
			$query->where('GLKEY_CODE', $glkeycode);
			$query->where('GL_CODE', $glcode);
			$uData       = $query->get()->first();
			$glkeycode   = $uData->GLKEY_CODE;
			$glcode      = $uData->GL_CODE;
			$glname      = $uData->GL_NAME;
			$acctypecode = $uData->ATYPE_CODE;
			$acctypename = $uData->ATYPE_NAME;
			$amt_type    = $uData->AMT_TYPE;
			$key_id      = $uData->GLKEY_CODE;
			$glkey_block = $uData->GLKEY_BLOCK;

			$button='Update';
			
			$action='/finance/update-gl-keymast';

			$userData['gl_code_list'] = DB::table('MASTER_GL')->get();

			$userData['acctype_code_list'] = DB::table('MASTER_ACCTYPE')->get();
			
			return view('admin.finance.master.generalLedger.gl_key_mast',$userData+compact('title','glkeycode','glcode','acctypecode','amt_type','key_id','glname','acctypename','glkey_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Config Not Found...!');
			return redirect('/Master/General-Ledger/View-Gl-Key-Mast');
		}

    }


    public function UpdateGlKey(Request $request){

		
		$validate = $this->validate($request, [

				'glkey_code'   => 'required|max:4',
				'gl_code'      => 'required|max:6',
				'acctype_code' => 'required|max:6',
				'amt_type'     => 'required|max:1',
		]);

        $glkeycode = $request->input('glkey_id');
        $glcode = $request->input('glcode');
        $updatedDate = date('Y-m-d');
        $loginuser = $request->session()->get('userid');

		$data = array(
			"ATYPE_CODE"       =>  $request->input('acctype_code'),
			"ATYPE_NAME"       =>  $request->input('acctype_name'),
			"AMT_TYPE"         =>  $request->input('amt_type'),
			"GLKEY_BLOCK"      =>  $request->input('glkey_block'),
			"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
			"LAST_UPDATE_DATE" =>  $updatedDate,
			

	 
	    );

		$saveData = DB::table('MASTER_GLKEY')->where('GLKEY_CODE', $glkeycode)->where('GL_CODE', $glcode)->update($data);

		$discriptn_page = "Master gl key update done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

		try{

			if ($saveData) {

				$request->session()->flash('alert-success', 'Gl Key Was Successfully Updated...!');
				return redirect('/Master/General-Ledger/View-Gl-Key-Mast');

			} else {

				$request->session()->flash('alert-error', 'Gl Key Can Not Updated...!');
				return redirect('/Master/General-Ledger/View-Gl-Key-Mast');

			}

		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Gl Key Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/General-Ledger/View-Gl-Key-Mast');
			}

	}

	/*search glkey code when click on help button*/
	
	public function HelpGl_key_Get(Request $request){

		$response_array = array();

	    $GlkeyHelp = $request->input('GlkeyHelp');

		if ($request->ajax()) {

	    	$glkeycode_by_help = DB::select("SELECT * FROM `MASTER_GLKEY` WHERE GLKEY_CODE='$GlkeyHelp' OR GLKEY_CODE Like '$GlkeyHelp%' ORDER BY GLKEY_CODE DESC limit 5  ");
	    	
    		if ($glkeycode_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $glkeycode_by_help ;

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

/*search glkey code when click on help button*/

/*search Glkey on input*/

	public function search_glkeycode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$glkeysearch = $request->input('glkeysearch');

	    	$glkey_list = DB::select("SELECT * FROM `MASTER_GLKEY` WHERE GLKEY_CODE LIKE '$glkeysearch%'");

	    	$count = count($glkey_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $glkey_list ;

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

/*search Glkey on input*/

/* ------ end gl key ------ */


 /* -------------------- END GENERAL LEDGER ----------------------*/

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