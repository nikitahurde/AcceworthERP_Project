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


class ItemController extends Controller{

	//public $data;

	public function __construct(Request $request){

		//$this->data = "smit@121";

	}


/* ---------- start item type master ------------ */

	public function ItemType(Request $request){

		$title        ='Add Item Type Master';

		$compName 	= $request->session()->get('company_name');
		
		$item_type_code  = $request->old('item_type_code');
		$item_type_name  = $request->old('item_type_name');
		$item_type_id    = $request->old('item_type_id');
		$post_code       = $request->old('post_code');
		$item_type_block = $request->old('item_type_block');


		$userData['post_list'] = DB::table('MASTER_GL')->get();

		$userData['item_type_lists'] = DB::table('MASTER_ITEMTYPE')->Orderby('ITEMTYPE_CODE', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/Master/Item/Item-Type-Save';
		//print_r($compData['comp_list']);exit;

		if(isset($compName)){

	    	return view('admin.finance.master.item.item_type_form',$userData+compact('title','item_type_code','item_type_name','item_type_id','post_code','item_type_block','button','action'));

	    }else{

			return redirect('/useractivity');
		}

    } 

    public function ItemTypeSave(Request $request){


		$validate = $this->validate($request, [

			'item_type_code' => 'required|max:6|unique:MASTER_ITEMTYPE,ITEMTYPE_CODE',
			'item_type_name' => 'required|max:40',
			'post_code'      => 'required',

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"ITEMTYPE_CODE"  => $request->input('item_type_code'),
			"ITEM_TYPE_NAME" => $request->input('item_type_name'),
			"POST_CODE"      => $request->input('post_code'),
			"POST_NAME"      => $request->input('post_name'),
			"CREATED_BY"     => $createdBy,
			
		);

		$saveData = DB::table('MASTER_ITEMTYPE')->insert($data);

		$discriptn_page = "Master item type insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Type Was Successfully Added...!');
			return redirect('/Master/Item/View-Item-Type');

		} else {

			$request->session()->flash('alert-error', 'Item Type Can Not Added...!');
			return redirect('/Master/Item/View-Item-Type');

		}

	}

	public function EditItemType($id){

    	$title = 'Edit Type Master';

    	$id = base64_decode($id);
    	
    	if($id!=''){
    	    $query = DB::table('MASTER_ITEMTYPE');
			$query->where('ITEMTYPE_CODE', $id);
			$classData= $query->get()->first();

			$item_type_code  = $classData->ITEMTYPE_CODE;
			$item_type_name  = $classData->ITEM_TYPE_NAME;
			$post_code       = $classData->POST_CODE;
			$item_type_id    = $classData->ITEMTYPE_CODE;
			$item_type_block = $classData->ITEMTYPE_BLOCK;


			$userData['post_list'] = DB::table('MASTER_GL')->get();

			$button='Update';
			$action='/Master/Item/Item-Type-Update';

			return view('admin.finance.master.item.item_type_form',$userData+compact('title','item_type_code','item_type_name','post_code','item_type_id','item_type_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Type Not Found...!');
			return redirect('/Master/Item/View-Item-Type');
		}

    }

    public function ItemTypeUpdate(Request $request){

		$validate = $this->validate($request, [

			'item_type_code' => 'required|max:6',
			'item_type_name' => 'required|max:40',
			'post_code'      =>	'required'

		]);

		$item_type_id = $request->input('item_type_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"ITEMTYPE_CODE"    => $request->input('item_type_code'),
			"ITEM_TYPE_NAME"   => $request->input('item_type_name'),
			"POST_CODE"        => $request->input('post_code'),
			"POST_NAME"      => $request->input('post_name'),
			"ITEMTYPE_BLOCK"   => $request->input('item_type_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		try{

			$saveData = DB::table('MASTER_ITEMTYPE')->where('ITEMTYPE_CODE', $item_type_id)->update($data);

			$discriptn_page = "Master item type update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item type Was Successfully Updated...!');
				return redirect('/Master/Item/View-Item-Type');

			} else {

				$request->session()->flash('alert-error', 'Item type Can Not Added...!');
				return redirect('/Master/Item/View-Item-Type');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Item Type Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Item/View-Item-Type');
		}

	}

	public function ViewItemType(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Item Type Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_ITEMTYPE')->orderBy('ITEMTYPE_CODE','DESC');
	    	
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_ITEMTYPE')->orderBy('ITEMTYPE_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.item.view_item_type');
    	}else{
		 	return redirect('/useractivity');
	   }
    }


    public function DeleteItemType(Request $request){

		$typeId = $request->post('typeId');
    	

    	if ($typeId!='') {
    		try{
    			$Delete = DB::table('MASTER_ITEMTYPE')->where('ITEMTYPE_CODE', $typeId)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Item Type Was Deleted Successfully...!');
					return redirect('/Master/Item/View-Item-Type');

				} else {

					$request->session()->flash('alert-error', 'Item Type Can Not Deleted...!');
					return redirect('/Master/Item/View-Item-Type');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Type Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Item/View-Item-Type');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Item Type Not Found...!');
			return redirect('/Master/Item/View-Item-Type');

    	}

	}

/*search Item type code when click on help button*/
	
	public function HelpItemTypeSearch(Request $request){

		$response_array = array();

	    $ItemType_H = $request->input('ItemTypeH');

		if ($request->ajax()) {

	    	$item_type_by_help = DB::select("SELECT * FROM `MASTER_ITEMTYPE` WHERE ITEMTYPE_CODE='$ItemType_H' OR ITEM_TYPE_NAME='$ItemType_H' OR ITEMTYPE_CODE Like '$ItemType_H%' OR ITEM_TYPE_NAME LIKE '$ItemType_H%' ORDER BY ITEMTYPE_CODE DESC limit 5  ");
	    	
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

/*search Item type code when click on help button*/


/*search Item type code on input*/

	public function search_ItemTypeCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$ItemType_code = $request->input('itemTypeSearch');

	    	$itemtype_list = DB::select("SELECT * FROM `MASTER_ITEMTYPE` WHERE ITEMTYPE_CODE LIKE '$ItemType_code%'");

	    	$count = count($itemtype_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemtype_list ;

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

/*search Item type code on input*/


/* ---------- end item type master ------------ */


/* ---------- start item group master ---------- */

	public function ItemGroup(Request $request){

		$title = 'Add Item Group';

		$compName 	= $request->session()->get('company_name');

		$itemgroup_code = $request->old('itemgroup_code');
		$itemgroup_name = $request->old('itemgroup_name');
		$itemgroup_id   = $request->old('id');
		$group_block    = $request->old('group_block');

		$userData['itemgrp_mst_list'] = DB::table('MASTER_ITEMGROUP')->Orderby('ITEMGROUP_CODE', 'desc')->limit(5)->get();

		$button='Save';

    	$action='/Master/Item/Item-Group-Save';

		if(isset($compName)){

	    	return view('admin.finance.master.item.item_group',$userData+compact('title','itemgroup_code','itemgroup_name','itemgroup_id','group_block','action','button'));

	    }else{

			return redirect('/useractivity');
		}

	}

	public function SaveItemGroup(Request $request){

		$compName  = $request->session()->get('company_name');
		$fisYear   =  $request->session()->get('macc_year');
		$loginuser = $request->session()->get('userid');

		$validate = $this->validate($request, [

				'itemgroup_code' => 'required|max:6|unique:MASTER_ITEMGROUP,ITEMGROUP_CODE',
				'itemgroup_name' => 'required|max:40',

		]);


		$data = array(
					"ITEMGROUP_CODE" =>  $request->input('itemgroup_code'),
					"ITEMGROUP_NAME" =>  $request->input('itemgroup_name'),
					"CREATED_BY"     =>  $request->session()->get('userid'),
	    	);

		$saveData = DB::table('MASTER_ITEMGROUP')->insert($data);

		$discriptn_page = "Master item group insert done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Group Was Successfully Added...!');
			return redirect('/Master/Item/View-Item-Group-Mast');

		} else {

			$request->session()->flash('alert-error', 'Item Group Can Not Added...!');
			return redirect('/Master/Item/View-Item-Group-Mast');

		}

	}

	public function ViewItemGroup(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	       	$title = 'View Item Group';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 	$data = DB::table('MASTER_ITEMGROUP')->orderBy('ITEMGROUP_CODE','DESC');

	    	}
	    	elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_ITEMGROUP')->orderBy('ITEMGROUP_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

    	 	return DataTables()->of($data)->addIndexColumn()->toJson();

		}	
		if(isset($compName)){
	    	return view('admin.finance.master.item.view_item_group');
		}else{
			return redirect('/useractivity');
		}

    }


    public function DeleteItemgroup(Request $request){

        $id = $request->input('itemgroupid');
        if ($id!='') {

        	try{

			$Delete = DB::table('MASTER_ITEMGROUP')->where('ITEMGROUP_CODE', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Item Group Data Was Deleted Successfully...!');
			return redirect('/Master/Item/View-Item-Group-Mast');

			} else {

			$request->session()->flash('alert-error', 'Item Group Data Can Not Deleted...!');
			return redirect('/Master/Item/View-Item-Group-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Group be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Item/View-Item-Group-Mast');
			}

		}else{

		$request->session()->flash('alert-error', 'Item Group Data Not Found...!');
		return redirect('/Master/Item/View-Item-Group-Mast');

		}
	}


	public function EditItemGroup($id){

    	$title = 'Edit Item Group';

    	//print_r($id);
    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('MASTER_ITEMGROUP');
			$query->where('ITEMGROUP_CODE', $id);
			$classData= $query->get()->first();

			$itemgroup_code = $classData->ITEMGROUP_CODE;
			$itemgroup_name = $classData->ITEMGROUP_NAME;
			$itemgroup_id   = $classData->ITEMGROUP_CODE;
			$group_block    = $classData->ITEMGROUP_BLOCK;

			$button='Update';
			$action='/Master/Item/Item-Group-Update';

			return view('admin.finance.master.item.item_group',compact('title','itemgroup_code','itemgroup_name','itemgroup_id','group_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Category Not Found...!');
			return redirect('/Master/Item/View-Item-Group-Mast');
		}

    }

    public function UpdateItemGroup(Request $request){

		$validate = $this->validate($request, [

				'itemgroup_code' => 'required|max:6',
				'itemgroup_name' => 'required|max:40',
				

		]);

       $id = $request->input('idgroup');
       $updatedDate = date("Y-m-d H:i:s");
       $loginUser  = $request->session()->get('userid');

		$data = array(
				"ITEMGROUP_CODE"  =>  $request->input('itemgroup_code'),
				"ITEMGROUP_NAME"  =>  $request->input('itemgroup_name'),
				"ITEMGROUP_BLOCK"     =>  $request->input('group_block'),
				"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
				"LAST_UPDATE_DATE" =>  $updatedDate
	 
	    	);
		try{
		$saveData = DB::table('MASTER_ITEMGROUP')->where('ITEMGROUP_CODE', $id)->update($data);

		$discriptn_page = "Master item group update done by user";
		$this->userLogInsert($loginUser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Group Was Successfully Updated...!');
				return redirect('/Master/Item/View-Item-Group-Mast');

			} else {

				$request->session()->flash('alert-error', 'Item Group Can Not Updated...!');
				return redirect('/Master/Item/View-Item-Group-Mast');

			}
		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Item Group be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Item/View-Item-Group-Mast');
		}


	}

/*search Item Group code when click on help button*/
	
	public function HelpItemGroupCodeGet(Request $request){

		$response_array = array();

	    $ItemGroupH = $request->input('ItemGroupH');

		if ($request->ajax()) {

	    	$itemgroup_code_by_help = DB::select("SELECT * FROM `MASTER_ITEMGROUP` WHERE ITEMGROUP_CODE='$ItemGroupH' OR ITEMGROUP_NAME='$ItemGroupH' OR ITEMGROUP_CODE Like '$ItemGroupH%' OR ITEMGROUP_NAME LIKE '$ItemGroupH%' ORDER BY ITEMGROUP_CODE DESC limit 5  ");
	    	
    		if ($itemgroup_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemgroup_code_by_help ;

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

/*search Item Group code when click on help button*/


/*search Item Group code on input*/

	public function search_ItemGroupCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$SearchItemGroup = $request->input('SearchItemGroup');

	    	$itemgroupCode_list = DB::select("SELECT * FROM `MASTER_ITEMGROUP` WHERE ITEMGROUP_CODE LIKE '$SearchItemGroup%'");

	    	$count = count($itemgroupCode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemgroupCode_list ;

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

/*search Item Group code on input*/

/* ---------- end item group master ---------- */

/* --------- start item category master ------ */

	public function ItemCategory(Request $request){

		$title = 'Add Item Category';

		$compName 	= $request->session()->get('company_name');

		$itemcategory_code = $request->old('itemcategory_code');
		$itemcategory_name = $request->old('itemcategory_name');
		$itemcategory_id   = $request->old('id');
		$category_block    = $request->old('category_block');

		$userData['ItemCat_lists'] = DB::table('MASTER_ITEM_CATEGORY')->Orderby('ICATG_CODE', 'desc')->limit(5)->get();

		$button='Save';

    	$action='/Master/Item/Item-Category-Save';

		if(isset($compName)){

    	return view('admin.finance.master.item.item_category',$userData+compact('title','itemcategory_code','itemcategory_name','itemcategory_id','category_block','action','button'));

	    }else{

			return redirect('/useractivity');
		}

	}


	public function SaveItemCategory(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');
    	$loginuser = $request->session()->get('userid');

		$validate = $this->validate($request, [

				'itemcategory_code' => 'required|max:6|unique:MASTER_ITEM_CATEGORY,ICATG_CODE',
				'itemcategory_name' => 'required|max:40',

		]);

		$data = array(
					"ICATG_CODE" =>  $request->input('itemcategory_code'),
					"ICATG_NAME" =>  $request->input('itemcategory_name'),
					"CREATED_BY" =>  $request->session()->get('userid')
					
	    	);

		$saveData = DB::table('MASTER_ITEM_CATEGORY')->insert($data);

		$discriptn_page = "Master item category insert done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Category Was Successfully Added...!');
				return redirect('/Master/Item/View-Item-Category-Mast');

			} else {

				$request->session()->flash('alert-error', 'Item Category Can Not Added...!');
				return redirect('/Master/Item/View-Item-Category-Mast');

			}

	}


	public function ViewItemCategory(Request $request){

	$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	       $title = 'View Rack Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    	$data  = DB::table('MASTER_ITEM_CATEGORY')->orderBy('ICATG_CODE','DESC');

	    	//print_r($valData['val_list']);exit;
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data  = DB::table('MASTER_ITEM_CATEGORY')->orderBy('ICATG_CODE','DESC');
	    	}
	    	else{
	  			 $data ='';
	    	}

	    	return DataTables()->of($data)->addIndexColumn()->toJson();

		}
		if(isset($compName)){
			return view('admin.finance.master.item.view_item_category');
		}else{
		 	return redirect('/useractivity');
	   	}

    }


    public function DeleteItemCategory(Request $request){

        $id = $request->input('itemcat');
        if ($id!='') {
        	try{
			$Delete = DB::table('MASTER_ITEM_CATEGORY')->where('ICATG_CODE', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Item Category Data Was Deleted Successfully...!');
			return redirect('/Master/Item/View-Item-Category-Mast');

			} else {

			$request->session()->flash('alert-error', 'Item Category Data Can Not Deleted...!');
			return redirect('/Master/Item/View-Item-Category-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Category be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Item/View-Item-Category-Mast');
			}

		}else{

		$request->session()->flash('alert-error', 'Item Category Data Not Found...!');
		return redirect('/Master/Item/View-Item-Category-Mast');

		}
	}


	public function EditItemCategory($id){

    	$title = 'Edit Item Category';

    	//print_r($id);
    	$id = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);

    	if($id!=''){
    	    $query = DB::table('MASTER_ITEM_CATEGORY');
			$query->where('ICATG_CODE', $id);
			$classData= $query->get()->first();

			$itemcategory_code = $classData->ICATG_CODE;
			$itemcategory_name = $classData->ICATG_NAME;
			$itemcategory_id   = $classData->ICATG_CODE;
			$category_block    = $classData->ICATG_BLOCK;

			$button='Update';
			$action='/Master/Item/Item-Category-Update';

			return view('admin.finance.master.item.item_category',compact('title','itemcategory_code','itemcategory_name','itemcategory_id','category_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Category Not Found...!');
			return redirect('/Master/Item/View-Item-Category-Mast');
		}

    }

    public function UpdateItemCategory(Request $request){

		
		$validate = $this->validate($request, [

				'itemcategory_code' => 'required|max:6',
				'itemcategory_name' => 'required|max:40',
				
		]);

        $id = $request->input('idcat');
        $updatedDate = date("Y-m-d H:i:s");
        $loginuser = $request->session()->get('userid');

		$data = array(
				"ICATG_CODE"       =>  $request->input('itemcategory_code'),
				"ICATG_NAME"       =>  $request->input('itemcategory_name'),
				"ICATG_BLOCK"      =>  $request->input('category_block'),
				"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
				"LAST_UPDATE_DATE" =>  $updatedDate
	 
	    );

		try{
			$saveData = DB::table('MASTER_ITEM_CATEGORY')->where('ICATG_CODE', $id)->update($data);

			$discriptn_page = "Master item category update done by user";
			$this->userLogInsert($loginuser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Category Was Successfully Updated...!');
				return redirect('/Master/Item/View-Item-Category-Mast');

			} else {

				$request->session()->flash('alert-error', 'Item Category Can Not Updated...!');
				return redirect('/Master/Item/View-Item-Category-Mast');

			}
		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Item Category be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Item/View-Item-Category-Mast');
		}
	}

/*search Item Category code when click on help button*/
	
	public function HelpItemCatCodeGet(Request $request){

		$response_array = array();

	    $ItemCateCodeH = $request->input('ItemCateCodeH');

		if ($request->ajax()) {

	    	$itemcat_code_by_help = DB::select("SELECT * FROM `MASTER_ITEM_CATEGORY` WHERE ICATG_CODE='$ItemCateCodeH' OR ICATG_NAME='$ItemCateCodeH' OR ICATG_CODE Like '$ItemCateCodeH%' OR ICATG_NAME LIKE '$ItemCateCodeH%' ORDER BY ICATG_CODE DESC limit 5  ");
	    	
    		if ($itemcat_code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemcat_code_by_help ;

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

/*search Item Category code when click on help button*/


/*search Item Category code on input*/

	public function search_ItemCatCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$SearchItemCatCode = $request->input('SearchItemCatCode');

	    	$itemcatCode_list = DB::select("SELECT * FROM `MASTER_ITEM_CATEGORY` WHERE ICATG_CODE LIKE '$SearchItemCatCode%'");

	    	$count = count($itemcatCode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemcatCode_list ;

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

/*search Item Category code on input*/

/* --------- end item category master ------ */


/* --------- Start Item Schedule master ------ */
	

	public function ItemSchedule(Request $request){

		$title = 'Add Item Schedule';

		$compName 	= $request->session()->get('company_name');

		$itemschedule_code = $request->old('itemschedule_code');
		$itemschedule_name = $request->old('itemschedule_name');
		$itemschedule_id   = $request->old('id');
		$schedule_block    = $request->old('schedule_block');
		$itemschedule_code = $request->old('itemschedule_code');
		$itemschedule_name  = $request->old('itemschedule_name');
		$itemtype_code  = $request->old('itemtype_code');
		$itemtype_name  = $request->old('itemtype_name');

		$userData['ItemSche_lists'] = DB::table('MASTER_ITEM_SCHEDULE')->Orderby('ISCHE_CODE', 'desc')->limit(5)->get();

		$userData['ItemType_lists'] = DB::table('MASTER_ITEMTYPE')->Orderby('ITEMTYPE_CODE')->get();

		$button='Save';

    	$action='/Master/Item/Item-Schedule-Save';

		if(isset($compName)){

    	return view('admin.finance.master.item.item_schedule',$userData+compact('title','itemschedule_code','itemschedule_name','itemschedule_id','schedule_block','action','button','itemschedule_code','itemschedule_name','itemtype_code','itemtype_name'));

	    }else{

			return redirect('/useractivity');
		}

	
	}

	public function SaveItemSchedule(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');
    	$loginuser = $request->session()->get('userid');

		$validate = $this->validate($request, [

				'itemschedule_code' => 'required|max:6|unique:MASTER_ITEM_SCHEDULE,ISCHE_CODE',
				'itemschedule_name' => 'required|max:40',
				'itemtype_code' => 'required',
				'itemtype_name' => 'required',

		]);

		$data = array(
					"ISCHE_CODE" =>  $request->input('itemschedule_code'),
					"ISCHE_NAME" =>  $request->input('itemschedule_name'),
					"ITEMTYPE_CODE" =>  $request->input('itemtype_code'),
					"ITEM_TYPE_NAME" =>  $request->input('itemtype_name'),
					"CREATED_BY" =>  $request->session()->get('userid')
					
	    	);

		$saveData = DB::table('MASTER_ITEM_SCHEDULE')->insert($data);

		$discriptn_page = "Master item schedule insert done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Schedule Was Successfully Added...!');
				return redirect('/Master/Item/View-Item-Schedule-Mast');

			} else {

				$request->session()->flash('alert-error', 'Item Schedule Can Not Added...!');
				return redirect('/Master/Item/View-Item-Schedule-Mast');

			}

	}


	public function ViewItemSchedule(Request $request){

	$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	       $title = 'View Item Schedule Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');


	    	$data  = DB::table('MASTER_ITEM_SCHEDULE')->orderBy('ISCHE_CODE','DESC');


	    	return DataTables()->of($data)->addIndexColumn()->toJson();

		}
		if(isset($compName)){
			return view('admin.finance.master.item.view_item_schedule');
		}else{
		 	return redirect('/useractivity');
	   	}

    }

    public function EditItemSchedule($id){

    	$title = 'Edit Item Schedule';

    	//print_r($id);
    	$id = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);

    	if($id!=''){
    	    $query = DB::table('MASTER_ITEM_SCHEDULE');
			$query->where('ISCHE_CODE', $id);
			$classData= $query->get()->first();

			$itemschedule_code = $classData->ISCHE_CODE;
			$itemschedule_name = $classData->ISCHE_NAME;
			$itemschedule_id   = $classData->ISCHE_CODE;
			$itemtype_code    = $classData->ITEMTYPE_CODE;
			$itemtype_name    = $classData->ITEM_TYPE_NAME;
			$schedule_block    = $classData->ISCHE_BLOCK;

			$button='Update';
			$action='/Master/Item/Item-Schedule-Update';

			$userData['ItemType_lists'] = DB::table('MASTER_ITEMTYPE')->Orderby('ITEMTYPE_CODE')->get();

			return view('admin.finance.master.item.item_schedule',$userData+compact('title','itemschedule_code','itemschedule_name','itemschedule_id','schedule_block','button','action','itemtype_code','itemtype_name'));
		}else{
			$request->session()->flash('alert-error', 'Item Schedule Not Found...!');
			return redirect('/Master/Item/View-Item-Schedule-Mast');
		}

    }

    public function UpdateItemSchedule(Request $request){

		
		$validate = $this->validate($request, [

				'itemschedule_code' => 'required|max:6',
				'itemschedule_name' => 'required|max:40',
				
		]);

        $id = $request->input('idsche');
        $updatedDate = date("Y-m-d H:i:s");
        $loginuser = $request->session()->get('userid');

		$data = array(
				"ISCHE_CODE"       =>  $request->input('itemschedule_code'),
				"ISCHE_NAME"       =>  $request->input('itemschedule_name'),
				"ITEMTYPE_CODE"    =>  $request->input('itemtype_code'),
				"ITEM_TYPE_NAME"   =>  $request->input('itemtype_name'),
				"ISCHE_BLOCK"      =>  $request->input('schedule_block'),
				"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
				"LAST_UPDATE_DATE" =>  $updatedDate
	 
	    );
	    // print_r($data);exit();

		try{
			$saveData = DB::table('MASTER_ITEM_SCHEDULE')->where('ISCHE_CODE', $id)->update($data);

			$discriptn_page = "Master item schedule update done by user";
			$this->userLogInsert($loginuser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Schedule Was Successfully Updated...!');
				return redirect('/Master/Item/View-Item-Schedule-Mast');

			} else {

				$request->session()->flash('alert-error', 'Item Schedule Can Not Updated...!');
				return redirect('/Master/Item/View-Item-Schedule-Mast');

			}
		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Item Schedule be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Item/View-Item-Schedule-Mast');
		}
	}


	public function DeleteItemSchedule(Request $request){

        $id = $request->input('itemsche');
        if ($id!='') {
        	try{
			$Delete = DB::table('MASTER_ITEM_SCHEDULE')->where('ISCHE_CODE', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Item Schedule Data Was Deleted Successfully...!');
			return redirect('/Master/Item/View-Item-Schedule-Mast');

			} else {

			$request->session()->flash('alert-error', 'Item Schedule Data Can Not Deleted...!');
			return redirect('/Master/Item/View-Item-Schedule-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Schedule Be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Item/View-Item-Schedule-Mast');
			}

		}else{

		$request->session()->flash('alert-error', 'Item Schedule Data Not Found...!');
		return redirect('/Master/Item/View-Item-Schedule-Mast');

		}
	}


/* --------- End Item Schedule master ------ */


/* ------ start item class master ------- */

	public function ItemClass(Request $request){

		$title        ='Add Item Class Master';

		$compName 	= $request->session()->get('company_name');
		
		$item_class_code  = $request->old('item_class_code');
		$item_class_name  = $request->old('item_class_name');
		$item_class_id    = $request->old('item_class_id');
		$item_class_block = $request->old('item_class_block');

		$userData['itemc_mst_list'] = DB::table('MASTER_ITEM_CLASS')->Orderby('ITEMCLASS_CODE', 'desc')->limit(5)->get();

    	$button='Save';
    	$action='/Master/Item/Item-Class-Save';
		//print_r($compData['comp_list']);exit;

		if(isset($compName)){

    	return view('admin.finance.master.item.item_class_form',$userData+compact('title','item_class_code','item_class_name','item_class_id','item_class_block','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function ItemClassSave(Request $request){


		$validate = $this->validate($request, [

			'item_class_code' => 'required|max:6|unique:MASTER_ITEM_CLASS,ITEMCLASS_CODE',
			'item_class_name' => 'required|max:40',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$data = array(
			"ITEMCLASS_CODE" => $request->input('item_class_code'),
			"ITEMCLASS_NAME" => $request->input('item_class_name'),
			"created_by"      => $createdBy,
			
		);

		$saveData = DB::table('MASTER_ITEM_CLASS')->insert($data);

		$discriptn_page = "Master item class insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Class Was Successfully Added...!');
			return redirect('/Master/Item/View-Item-Class-Mast');

		} else {

			$request->session()->flash('alert-error', 'Item Class Can Not Added...!');
			return redirect('/Master/Item/View-Item-Class-Mast');

		}

	}

	public function EditItemClass($id){

    	$title = 'Edit Item Class Master';

    	$id = base64_decode($id);
    	
    	if($id!=''){
    	    $query = DB::table('MASTER_ITEM_CLASS');
			$query->where('ITEMCLASS_CODE', $id);
			$classData= $query->get()->first();

			$item_class_code  = $classData->ITEMCLASS_CODE;
			$item_class_name  = $classData->ITEMCLASS_NAME;
			$item_class_id    = $classData->ITEMCLASS_CODE;
			$item_class_block = $classData->ITEMCLASS_BLOCK;

			$button='Update';
			$action='/Master/Item/Item-Class-Update';

			return view('admin.finance.master.item.item_class_form',compact('title','item_class_code','item_class_name','item_class_id','item_class_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Config Not Found...!');
			return redirect('/Master/Item/View-Item-Class-Mast');
		}

    }


    public function ItemClassUpdate(Request $request){

		$validate = $this->validate($request, [

			'item_class_code' => 'required|max:6',
			'item_class_name' => 'required|max:40'
		]);

		$item_class_id = $request->input('item_class_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"ITEMCLASS_CODE"   => $request->input('item_class_code'),
			"ITEMCLASS_NAME"   => $request->input('item_class_name'),
			"ITEMCLASS_BLOCK"  => $request->input('item_class_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		$saveData = DB::table('MASTER_ITEM_CLASS')->where('ITEMCLASS_CODE', $item_class_id)->update($data);

		$discriptn_page = "Master item class update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		try{

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Class Was Successfully Updated...!');
				return redirect('/Master/Item/View-Item-Class-Mast');

			} else {

				$request->session()->flash('alert-error', 'Item Class Can Not Added...!');
				return redirect('/Master/Item/View-Item-Class-Mast');

			}
		}
		catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Item Class Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Item/View-Item-Class-Mast');
		}
	}

	public function ViewItemClass(Request $request){
		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Item Class Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){
	    		$data = DB::table('MASTER_ITEM_CLASS')->orderBy('ITEMCLASS_CODE','DESC');
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {
	    		$data = DB::table('MASTER_ITEM_CLASS')->orderBy('ITEMCLASS_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

    	 	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

	    if(isset($compName)){
	    	return view('admin.finance.master.item.view_item_class');

	    }else{
			 return redirect('/useractivity');
		}

    }

    public function DeleteItemClass(Request $request){

		$classId = $request->post('classId');
    	
    	if ($classId!='') {

    		try{

    			$Delete = DB::table('MASTER_ITEM_CLASS')->where('ITEMCLASS_CODE', $classId)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Item Class Was Deleted Successfully...!');
					return redirect('/Master/Item/View-Item-Class-Mast');

				} else {

					$request->session()->flash('alert-error', 'Item Class Can Not Deleted...!');
					return redirect('/Master/Item/View-Item-Class-Mast');

				}
			}
			catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Class Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Item/View-Item-Class-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Valuation Not Found...!');
			return redirect('/Master/Item/View-Item-Class-Mast');

    	}

	}


/* ------ end item class master ------- */

/* ------ start um master -------- */
	
	public function AddUm(Request $request){

        $title = 'Add Master Um';

        $compName = $request->session()->get('company_name');
        
        $data['help_um_list'] = DB::table('MASTER_UM')->Orderby('UM_CODE', 'desc')->limit(5)->get();

        return view('admin.finance.master.item.um_form',$data+compact('title'));

	    if(isset($compName)){
	    	return view('admin.finance.master.item.um_form',$data+compact('title'));
	    }else{
			return redirect('/useractivity');
		}

    }

    public function UmSave(Request $request){

        $validate = $this->validate($request, [

            'um_code'    => 'required|max:3|unique:MASTER_UM,UM_CODE',
            'um_name'    => 'required|max:40',
            
        ]);

        $createdBy = $request->session()->get('userid');

        $compName = $request->session()->get('company_name');

        $fisYear =  $request->session()->get('macc_year');
      
        $data = array(
            "UM_CODE"     => $request->input('um_code'),
            "UM_NAME"     => $request->input('um_name'),
            "created_by"  => $createdBy
            
        );

        $saveData = DB::table('MASTER_UM')->insert($data);

        $discriptn_page = "Master UM insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

        if ($saveData) {

            $request->session()->flash('alert-success', 'Um Was Successfully Added...!');
            return redirect('/Master/Item/view-Um-Mast');

        } else {

            $request->session()->flash('alert-error', 'Um Can Not Added...!');
            return redirect('/Master/Item/view-Um-Mast');

        }

    }

    public function ViewUm(Request $request){

    $compName = $request->session()->get('company_name');

    	if($request->ajax()) {

	        $title = 'View Master Um';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $compName = $request->session()->get('company_name');

	        $fisYear =  $request->session()->get('macc_year');

        	if($userType=='admin'){

	           /* $data = DB::table('master_um_finance')
	            ->leftJoin('code_access', 'master_um_finance.um_code', '=', 'code_access.code')
	            ->select('master_um_finance.*','code_access.item_um_mast')
	            ->orderBy('id','DESC');*/

           		$data = DB::table('MASTER_UM')->orderBy('UM_CODE','DESC');
         
        	}else if($userType=='superAdmin' || $userType=='user'){
	            /*$data = DB::table('master_um')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear]);*/
	            $data = DB::table('MASTER_UM')->orderBy('UM_CODE','DESC');
	        }else{

	            $data='';
	            
       		}

         	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
    	}

    	if(isset($compName)){
        	return view('admin.finance.master.item.view_um_form');
    	}else{
			return redirect('/useractivity');
	   	}

    }

    public function EditUm($id){

        $title = 'Edit Master Um';

        $umcode = base64_decode($id);
        //$btnControl = base64_decode($btnControl);
        //print_r($id);
        if($umcode!=''){
            $query = DB::table('MASTER_UM');
            $query->where('UM_CODE', $umcode);
            $umData['um_list'] = $query->get()->first();

            return view('admin.finance.master.item.edit_um_form', $umData+compact('title'));
        }else{
            $request->session()->flash('alert-error', 'Um Not Found...!');
            return redirect('/Master/Item/view-Um-Mast');
        }

    }

    public function UmUpdate(Request $request){

        $validate = $this->validate($request, [

            'um_code'    => 'required|max:3',
            'um_name'    => 'required|max:30',
            
        ]);

        $lastUpdatedBy = $request->session()->get('userid');
        $updatedDate = date("Y-m-d H:i:s");

        $umCode = $request->input('umId');
        $data = array(
			"UM_CODE"          => $request->input('um_code'),
			"UM_NAME"          => $request->input('um_name'),
			"UM_BLOCK"         => $request->input('um_block'),
			"LAST_UPDATE_BY"   => $lastUpdatedBy,
			"LAST_UPDATE_DATE" => $updatedDate
            
            
        );
		try{
        	$saveData = DB::table('MASTER_UM')->where('UM_CODE',$umCode)->update($data);

        	$discriptn_page = "Master UM update done by user";
			$this->userLogInsert($lastUpdatedBy,$discriptn_page);

	        if ($saveData) {

	            $request->session()->flash('alert-success', 'Um Was Successfully Added...!');
	            return redirect('/Master/Item/view-Um-Mast');

	        } else {

	            $request->session()->flash('alert-error', 'Um Can Not Added...!');
	            return redirect('/Master/Item/view-Um-Mast');

	        }
    	}
    	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'UM Code Cannot be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Item/view-Um-Mast');
			}
    }

    public function DeleteUm(Request $request){

        $UmID = $request->post('UmID');

        if ($UmID!='') {
            try{

            	$Delete = DB::table('MASTER_UM')->where('UM_CODE', $UmID)->delete();

	            if ($Delete) {

	                $request->session()->flash('alert-success', ' Um Was Deleted Successfully...!');
	                return redirect('/Master/Item/view-Um-Mast');

	            } else {

	                $request->session()->flash('alert-error', 'Um Can Not Deleted...!');
	                return redirect('/Master/Item/view-Um-Mast');

	            }
        	}
          	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'UM Code Cannot be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Item/view-Um-Mast');
			}

        }else{

            $request->session()->flash('alert-error', 'Um Not Found...!');
            return redirect('/Master/Item/view-Um-Mast');

        }
    }

    public function search_um_code(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$um_code = $request->input('um_code');

	    	$um_code_list = DB::select("SELECT * FROM `MASTER_UM` WHERE UM_CODE LIKE '$um_code%'");

	    	$count = count($um_code_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $um_code_list ;

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

    public function HelpUmCodeSearch(Request $request){

		$response_array = array();

	    $um_code_help = $request->input('HelpUmCode');

		if ($request->ajax()) {

	    	$Seach_Um_Code_by_help = DB::select("SELECT * FROM `MASTER_UM` WHERE UM_CODE='$um_code_help' OR UM_NAME='$um_code_help' OR UM_CODE Like '$um_code_help%' OR UM_NAME LIKE '$um_code_help%' ORDER BY UM_CODE DESC limit 5");
	    	
    		if ($Seach_Um_Code_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Seach_Um_Code_by_help ;

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


/* ------ end um master -------- */


/*item um master*/

	public function ItemUmForm(Request $request){

    	 $title = 'Add Master Item Um';
    	 $compName  = $request->session()->get('company_name');
    	
    	 $data['item_code'] = DB::table('MASTER_ITEM')->get();
    	 $data['um_code'] = DB::table('MASTER_UM')->get();
    	

    if(isset($compName)){

    	return view('admin.finance.master.item.itemum_form',$data+compact('title'));

    }else{

		return redirect('/useractivity');
	}

    }

     public function GetUmAum(Request $request){

    	 $item_code = $request->post('item_code');
    	// print_r($item_code);exit();

    	

    	$getumaum = DB::table('MASTER_ITEM')->where('ITEM_CODE',$item_code)->get()->first();
    	
     // echo $getumaum;exit;
    	if(!empty($getumaum)){

      	echo json_encode($getumaum);
    	}
    }

    public function ItemUmFormSave(Request $request){

		$rules = [	
					'item_code'  => 'required|max:15',
					'um_code'    => 'required|max:3',
					'aum'        => 'required|max:3',
					'aum_factor' => 'required',
					'item_code'  => ['required', 'string',Rule::unique('MASTER_ITEMUM')->where(function ($query) use ($request) {
					    return $query->where('ITEM_CODE', $request->item_code)->where('UM_CODE', $request->um_code)->where('AUM_CODE', $request->aum);
							})],
			    ];

	    $customMessages = [
	        'item_code.unique'=>'The Item Code has already been taken for this <b><u>UM code and AUM code</u></b>',
	    ];

	    $this->validate($request, $rules, $customMessages);

		$createdby = $request->session()->get('userid');
		
		$compName  = $request->session()->get('company_name');
		
		$fisYear   =  $request->session()->get('macc_year');

		$data = array(
	
			"ITEM_CODE"  => $request->input('item_code'),
			"UM_CODE"    => $request->input('um_code'),
			"AUM_CODE"   => $request->input('aum'),
			"AUM_FACTOR" => $request->input('aum_factor'),
			"CREATED_BY" => $createdby
		);

		$saveData = DB::table('MASTER_ITEMUM')->insert($data);

		$discriptn_page = "Master item UM insert done by user";
		$this->userLogInsert($createdby,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item UM Was Successfully Added...!');
			return redirect('/Master/Item/View-ItemUM_Mast');

		} else {

			$request->session()->flash('alert-error', 'Item UM Can Not Added...!');
			return redirect('/Master/Item/View-ItemUM_Mast');

		}

    }

    public function ItemUmView(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Item Um Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');


	    	if($userType=='admin'){

	    		//$data = DB::table('MASTER_ITEMUM')->orderBy('ITEM_CODE','DESC');
	    		$data = DB::table('MASTER_ITEMUM')
	    	    ->leftJoin('MASTER_ITEM', 'MASTER_ITEMUM.ITEM_CODE', '=', 'MASTER_ITEM.ITEM_CODE')
	            ->select('MASTER_ITEMUM.*','MASTER_ITEM.ITEM_NAME')
	            ->orderBy('ITEM_CODE','DESC');
	    	
	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_ITEMUM')
	    	    ->leftJoin('MASTER_ITEM', 'MASTER_ITEMUM.ITEM_CODE', '=', 'MASTER_ITEM.ITEM_CODE')
	            ->select('MASTER_ITEMUM.*','MASTER_ITEM.ITEM_NAME')
	            ->orderBy('ITEM_CODE','DESC');
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.item.view_itemum');
    	}else{
		 	return redirect('/useractivity');
	   }
    }



    public function EditItemUmForm($itemCd,$umCd,$aumcd){

    	$title = 'Edit Item Um';

		$ITEM_CODE = base64_decode($itemCd);
		$UM_CODE   = base64_decode($umCd);
		$AUM_CODE  = base64_decode($aumcd);
    	//print_r($id);
    	if($ITEM_CODE!='' && $UM_CODE!='' && $AUM_CODE!=''){
    	    $query = DB::table('MASTER_ITEMUM');
			$query->where('ITEM_CODE', $ITEM_CODE);
			$query->where('UM_CODE', $UM_CODE);
			$query->where('AUM_CODE', $AUM_CODE);
			$itemData['itemum_list'] = $query->get()->first();

			$itemData['item_code'] = DB::table('MASTER_ITEM')->get();
    	    $itemData['um_code'] = DB::table('MASTER_ITEMUM')->get();

			return view('admin.finance.master.item.itemum_list', $itemData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Item Not Found...!');
			return redirect('/form-mast-itemum');
		}

    }

    public function ItemUmFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'item_code'  => 'required|max:15',
			'um_code'    => 'required|max:3',
			'aum'        => 'required|max:3',
			'aum_factor' => 'required',
			
		]);

		$itemumId = $request->input('itemumId');
		$umcode   = $request->input('umcd');
		$aumcode  = $request->input('aumcd');

		$updatedDate = date("Y-m-d H:i:s");

		$lastUpdatedBy = $request->session()->get('userid');

		$data = array(
				"ITEM_CODE"      => $request->input('item_code'),
				"UM_CODE"        => $request->input('um_code'),
				"AUM_CODE"       => $request->input('aum'),
				"AUM_FACTOR"     => $request->input('aum_factor'),
				"LAST_UPDATE_BY" => $lastUpdatedBy,
				"LAST_UPDATE_DATE"=> $updatedDate
					
		);

		
		$saveData = DB::table('MASTER_ITEMUM')->where('ITEM_CODE',$itemumId)->where('UM_CODE',$umcode)->where('AUM_CODE',$aumcode)->update($data);

		$discriptn_page = "Master item UM update done by user";
		$this->userLogInsert($lastUpdatedBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item UM Was Successfully Added...!');
			return redirect('/Master/Item/View-ItemUM_Mast');

		} else {

			$request->session()->flash('alert-error', 'Item UM Can Not Added...!');
			return redirect('/Master/Item/View-ItemUM_Mast');

		}
    }

    public function DeleteItemUm(Request $request){

		$ItemumID = $request->post('ItemumID');
		$splititm = explode('/',$ItemumID);
		$itemcd   =$splititm[0];
		$itemum   =$splititm[1];
		$itemaum  =$splititm[2];

    	if ($itemcd!='' && $itemum!='' && $itemaum!='') {
    		
    		$Delete = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemcd)->where('UM_CODE', $itemum)->where('AUM_CODE', $itemaum)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Item UM Was Deleted Successfully...!');
				return redirect('/Master/Item/View-ItemUM_Mast');

			} else {

				$request->session()->flash('alert-error', 'Item UM Can Not Deleted...!');
				return redirect('/Master/Item/View-ItemUM_Mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Item Not Found...!');
			return redirect('/Master/Item/View-ItemUM_Mast');

    	}
    }

/*item um master*/



/*item rack master*/

	public function ItemRackMast(Request $request){

		$title             ='Add Item Rack Master';
		
		$compName          = $request->session()->get('company_name');
		
		$item_code       = $request->old('item_code');
		$rack_code       = $request->old('rack_code');
		$plant_code      = $request->old('plant_code');
		$comp_code       = $request->old('comp_code');
		$pfct_code       = $request->old('pfct_code');
		$item_rack_id    = $request->old('item_rack_id');
		$item_rack_block = $request->old('item_rack_block');
		
		$button            ='Save';
		$action            ='/Master/Item/form-mast-item-rack-save';
		//print_r($compData['comp_list']);exit;
		$data['item_list']  = DB::table('MASTER_ITEM')->get();

		$data['rack_list']  = DB::table('MASTER_RACK')->get();

		$data['comp_list']  = DB::table('MASTER_COMP')->get();

		$data['plant_list'] = DB::table('MASTER_PLANT')->get();

		$data['pfct_list']  = DB::table('MASTER_PFCT')->get();
	//print_r($data['comp_list']);exit;

		

   if(isset($compName)){

    	return view('admin.finance.master.item.item_rack_form',$data+compact('title','item_code','rack_code','plant_code','pfct_code','comp_code','item_rack_id','item_rack_block','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function ItemRackFormSave(Request $request){


		$validate = $this->validate($request, [
			
			'item_code'  => 'required|max:15',
			'rack_code'  => 'required|max:6',
			'comp_code'  => 'required|max:6',
			'plant_code' => 'required|max:6',
			'pfct_code'  => 'required|max:6',

		]);

		$rules = [	
				'item_code'  => 'required|max:15',
				'rack_code'  => 'required|max:6',
				'comp_code'  => 'required|max:6',
				'plant_code' => 'required|max:6',
				'pfct_code'  => 'required|max:6',
				'item_code'  => ['required', 'string',Rule::unique('MASTER_ITEM_RACK')->where(function ($query) use ($request) {
				    return $query->where('ITEM_CODE', $request->item_code)->where('RACK_CODE', $request->rack_code);
						})],
		    ];

	    $customMessages = [
	        'item_code.unique'=>'The Item Code has already been taken for this <u><b>rack code<b></u>.',
	    ];

	    $this->validate($request, $rules, $customMessages);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	//print_r($request->input('item_code'));exit;

		$data = array(
			"ITEM_CODE"  => $request->input('item_code'),
			"RACK_CODE"  => $request->input('rack_code'),
			"COMP_CODE"  => $request->input('comp_code'),
			"PLANT_CODE" => $request->input('plant_code'),
			"PFCT_CODE"  => $request->input('pfct_code'),
			"created_by" => $createdBy,
			
		);

		$saveData = DB::table('MASTER_ITEM_RACK')->insert($data);

		$discriptn_page = "Master item rack insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Rack Was Successfully Added...!');
			return redirect('/Master/Item/View-Item-Rack-Mast');

		} else {

			$request->session()->flash('alert-error', 'Item Rack Can Not Added...!');
			return redirect('/Master/Item/View-Item-Rack-Mast');

		}

	}
	 public function EditItemRackMast($id,$rackcd){

    	$title = 'Edit Rack Master';

    	//print_r($id);
    	$ITEM_CODE = base64_decode($id);
    	$rack_CODE = base64_decode($rackcd);
    	///$btnControl = base64_decode($btnControl);


    	if($ITEM_CODE!='' && $rack_CODE!=''){
    	    $query = DB::table('MASTER_ITEM_RACK');
			$query->where('ITEM_CODE', $ITEM_CODE);
			$query->where('RACK_CODE', $rack_CODE);
			$classData= $query->get()->first();

			$item_code       = $classData->ITEM_CODE;
			$rack_code       = $classData->RACK_CODE;
			$plant_code      = $classData->PLANT_CODE;
			$comp_code       = $classData->COMP_CODE;
			$pfct_code       = $classData->PFCT_CODE;
			$item_rack_id    = $classData->ITEM_CODE;
			$item_rack_block = $classData->ITEM_RACK_BLOCK;
			//print_r($rack_block);exit;
			$data['item_list'] = DB::table('MASTER_ITEM')->get();
		    $data['rack_list'] = DB::table('MASTER_RACK')->get();
		    $data['comp_list'] = DB::table('MASTER_COMP')->get();
		    $data['plant_list'] = DB::table('MASTER_PLANT')->get();
		    $data['pfct_list'] = DB::table('MASTER_PFCT')->get();

			$button='Update';
			$action='/Master/Item/form-mast-item-rack-update';

			return view('admin.finance.master.item.item_rack_form',$data+compact('title','item_code','rack_code','plant_code','item_rack_id','item_rack_block','button','action','pfct_code','comp_code'));
		}else{
			$request->session()->flash('alert-error', 'Item Rack Not Found...!');
			return redirect('/finance/view-mast-item-rack');
		}

    }


    public function ItemRackFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'item_code'  => 'required|max:15',
			'rack_code'  => 'required|max:6',
			'comp_code'  => 'required|max:6',
			'plant_code' => 'required|max:6',
			'pfct_code'  => 'required|max:6',

		]);

		$item_rack_id = $request->input('item_rack_id');
		$rack_code = $request->input('rack_code');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			
			"ITEM_CODE"       => $request->input('item_code'),
			"RACK_CODE"       => $request->input('rack_code'),
			"COMP_CODE"       => $request->input('comp_code'),
			"PLANT_CODE"      => $request->input('plant_code'),
			"PFCT_CODE"       => $request->input('pfct_code'),
			"ITEM_RACK_BLOCK" => $request->input('item_rack_block'),
			"LAST_UPDATE_BY"  => $createdBy,
			"LAST_UPDATE_DATE"  => $updatedDate,
			
		);

		$saveData = DB::table('MASTER_ITEM_RACK')->where('ITEM_CODE', $item_rack_id)->where('RACK_CODE', $rack_code)->update($data);
		$discriptn_page = "Master item rack update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Rack Was Successfully Updated...!');
			return redirect('/Master/Item/View-Item-Rack-Mast');

		} else {

			$request->session()->flash('alert-error', 'Item Rack Can Not Added...!');
			return redirect('/Master/Item/View-Item-Rack-Mast');

		}

	}

	public function ViewItemRackMast(Request $request){

		$compName  = $request->session()->get('company_name');
		$title     = 'View Rack Master';
		$compSplit = explode('-',$compName);
		$compCode  = $compSplit[0];
		$userid    = $request->session()->get('userid');
		$userType  = $request->session()->get('usertype');
		$fisYear   =  $request->session()->get('macc_year');

	if($request->ajax()) {

    	if($userType=='admin'){

    	/*$itemrackData['item_rack'] = DB::table('master_item_rack')->orderBy('id','DESC')->get();*/

    	$data = DB::table('MASTER_ITEM_RACK')
            ->join('MASTER_ITEM', 'MASTER_ITEM_RACK.ITEM_CODE', '=', 'MASTER_ITEM.ITEM_CODE')
            ->join('MASTER_RACK', 'MASTER_ITEM_RACK.RACK_CODE', '=', 'MASTER_RACK.RACK_CODE')
            ->select('MASTER_ITEM_RACK.*', 'MASTER_ITEM.ITEM_NAME','MASTER_RACK.RACK_NAME')
            ->orderBy('ITEM_CODE','DESC');
            
            //print_r($data);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		

    		$data = DB::table('MASTER_ITEM_RACK')
            ->join('MASTER_ITEM', 'MASTER_ITEM_RACK.ITEM_CODE', '=', 'MASTER_ITEM.ITEM_CODE')
            ->join('MASTER_RACK', 'MASTER_ITEM_RACK.RACK_CODE', '=', 'MASTER_RACK.RACK_CODE')
            ->select('MASTER_ITEM_RACK.*', 'MASTER_ITEM.ITEM_NAME','MASTER_RACK.RACK_NAME')
            ->orderBy('ITEM_CODE','DESC');

    	}
    	else{
    		$data='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->toJson();

    }
    	if(isset($compName)){
    	return view('admin.finance.master.item.view_item_rack');
    	}else{
		 return redirect('/useractivity');
	   }
    }


    public function DeleteItemRack(Request $request){

		$itemrackId = $request->post('itemrackId');
    	$splicd = explode('_',$itemrackId);
    	$itemCode = $splicd[0];
    	$rackCode = $splicd[1];
    	if ($itemCode!='' && $rackCode!='') {
    		
    		$Delete = DB::table('MASTER_ITEM_RACK')->where('ITEM_CODE', $itemCode)->where('RACK_CODE', $rackCode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Item Rack Was Deleted Successfully...!');
				return redirect('/Master/Item/View-Item-Rack-Mast');

			} else {

				$request->session()->flash('alert-error', 'Item Rack Can Not Deleted...!');
				return redirect('/Master/Item/View-Item-Rack-Mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Item Rack Not Found...!');
			return redirect('/Master/Item/View-Item-Rack-Mast');

    	}

	}

/*item category*/

/*item balance*/

public function ItemBalance(Request $request){

		$title          = 'Add Item Blance';
		$compName       = $request->session()->get('company_name');
		$macc_year      = $request->session()->get('macc_year');
		$company_name   = $request->old('company_name');
		$fy_year        = $request->old('fy_year');
		$plant_name     = $request->old('plant_name');
		$item_name      = $request->old('item_name');
		$YROPQTY        = $request->old('YROPQTY');
		$YROPAQTY       = $request->old('YROPAQTY');
		$YROPVAL        = $request->old('YROPVAL');
		$moving_avg_val = $request->old('moving_avg_val');
		$standard_price = $request->old('standard_price');
		$ItemBalId      = $request->old('ItemBalId');
		$yrQtyRecd      = $request->old('yrQtyRecd');
		$yrAQtyRecd     = $request->old('yrAQtyRecd');
		$yrQtyIssued    = $request->old('yrQtyIssued');
		$yrAQtyIssue    = $request->old('yrAQtyIssue');
		$yrQtyBlock     = $request->old('yrQtyBlock');
		$BlockQty       = $request->old('BlockQty');
		$BlockAQty      = $request->old('BlockAQty');
		$button         ='Save';
		
		$action         = '/Master/Item/form-item-balance-save';

		$userdata['company_data'] = DB::table('MASTER_COMP')->get();
		$userdata['fy_data']      = DB::table('MASTER_FY')->groupBy('fy_code')->get();
		$userdata['plant_data']   = DB::table('MASTER_PLANT')->get();
		$userdata['item_data']    = DB::table('MASTER_ITEM')->get();
		$userdata['item_legder']  = DB::table('ITEM_LEDGER')->where('TRAN_CODE','I1')->get()->toArray();
		//print_r($item_legder);
		/*if(empty($item_legder->vr_no)){
			
				$userdata['itmvrno'] = $key1->vr_no;
			
		}else{
			
		}*/
		
		$vr_No_list= DB::table('MASTER_VRSEQ')->where([['TRAN_CODE','=','I1']])->get();

//print($vr_No_list);exit;

	
		foreach ($vr_No_list as $key) {
					$userdata['last_num']   = $key->LAST_NO;
					$userdata['to_num']     = $key->TO_NO;
					$userdata['trans_head'] = $key->TRAN_CODE;
					$userdata['seriesCode'] = $key->SERIES_CODE;
					
				}
			

    if(isset($compName)){

    	return view('admin.finance.master.item.item_balance',$userdata+compact('title','company_name','fy_year','plant_name','item_name','YROPQTY','YROPAQTY','YROPVAL','moving_avg_val','standard_price','ItemBalId','yrQtyRecd','yrAQtyRecd','yrQtyIssued','yrAQtyIssue','yrQtyBlock','BlockQty','BlockAQty','action','button'));

    }else{

		return redirect('/useractivity');
	}

	}

	public function getCfactorByItem(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$ItemCode = $request->input('itemC');

	    	//print_r($accCode);exit;

	    	//DB::enableQueryLog();
	   		$tolrance_data = DB::table('MASTER_ITEMUM')->where('ITEM_CODE',$ItemCode)->get()->first();
	    	//print_r($acc_data);exit;
            //	dd(DB::getQueryLog());
           
    		if($tolrance_data) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $tolrance_data;

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

	public function ItemBalanceSave(Request $request){

		$rules = [	
    				'company_name'   => 'required|max:11',
				    'plant_name'     => 'required|max:11',
				    'fy_year'        => 'required|max:9',
				    'YROPQTY'        => 'required',
				    'item_code'      => 'required',
				    'YROPVAL'        => 'required',	
					'item_code'      => ['required', 'string',Rule::unique('MASTER_ITEMBAL')->where(function ($query) use ($request) {
					    return $query->where('ITEM_CODE', $request->item_code)->where('FY_CODE', $request->fy_year)->where('COMP_CODE', $request->company_name)->where('PLANT_CODE', $request->plant_name);
							})],
			    ];

	    $customMessages = [
	        'item_code.unique'=>'The Item Code has already been taken for this <u><b>comp code and fy year and plant code</b></u>.',
	    ];

	    $this->validate($request, $rules, $customMessages);

		$compName  = $request->session()->get('company_name');

		$fisYear   =  $request->session()->get('macc_year');

		$userid    = $request->session()->get('userid');

		$compcode  = $request->input('company_name');

		$transCode = $request->input('trans_head');
		$vrnum     = $request->input('vrnum');

		$fyYear    =  $request->input('fy_year');

		$expldfy   = explode('-', $fyYear);

        if(isset($expldfy)){
        	$lastyr = $expldfy[1].'-03-31';
        }else{
        	$lastyr = '';
        }	
	
		$flag = 1;

		$data = array(
			
			"FY_CODE"    =>  $request->input('fy_year'),
			"COMP_CODE"  =>  $request->input('company_name'),
			"PLANT_CODE" =>  $request->input('plant_name'),
			"ITEM_CODE"  =>  $request->input('item_code'),
			"YROPQTY"    =>  $request->input('YROPQTY'),
			"YROPAQTY"   =>  $request->input('YROPAQTY'),
			"YROPVAL"    =>  $request->input('YROPVAL'),
			"MAVGRATE"   =>  $request->input('moving_avg_val'),
			"STDRATE"    =>  $request->input('standard_price'),
			"CREATED_BY" =>  $request->session()->get('userid'),
			"FLAG"       =>  $flag

	    );

		$saveData       = DB::table('MASTER_ITEMBAL')->insert($data);

		$discriptn_page = "Master item balance insert done by user";
		$this->userLogInsert($userid,$discriptn_page);

		$existData = DB::table('ITEM_LEDGER')->where('COMP_CODE',$compcode)->where('FY_CODE',$fyYear)->where('TRAN_CODE',$transCode)->where('ITEM_CODE',$request->input('item_code'))->get()->toArray();

		if(empty($existData)){

			$data_itmLedg = array(
				"VRDATE"      => $lastyr,
				"VRNO"        => $vrnum,
				"TRAN_CODE"   => $transCode,
				"PFCT_CODE"   => $request->input('pfctCode'),
				"SERIES_CODE" => $request->input('seriesCode'),
				"ITEM_CODE"   => $request->input('item_code'),
				"ITEM_NAME"   => $request->input('itmName'),
				"QTYRECD"     => $request->input('YROPQTY'),
				"BASIC"       => $request->input('YROPVAL'),
				"CREATED_BY"  => $userid

		    );
		    $saveData = DB::table('ITEM_LEDGER')->insert($data_itmLedg);

		    $datavr =array(
						'LAST_NO'=>$request->input('vrnum')
			);
			$updatevr = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transCode)->update($datavr);


		}else{

			
		}

		if ($saveData) {
			$request->session()->flash('alert-success', 'Item Balance Successfully Added...!');
			return redirect('/Master/Item/View-Item-Bal-Mast');
		} else {
			$request->session()->flash('alert-error', 'Item Balance Can Not Added...!');
			return redirect('/Master/Item/View-Item-Bal-Mast');
		}

	}

	public function ViewItemBalance(Request $request){

	$CompanyName = $request->session()->get('company_name');
	$splitData   = explode('-',$CompanyName);
	$compCode    = $splitData[0];
	$user_type   = $request->session()->get('user_type');
	$userid      = $request->session()->get('userid');
	$macc_year   = $request->session()->get('macc_year');

	if($request->ajax()){

		if($user_type == 'admin'){
    		
       	 	//DB::enableQueryLog();
       	 	 $data = DB::table('MASTER_ITEMBAL')
            ->join('MASTER_COMP','MASTER_ITEMBAL.COMP_CODE', '=', 'MASTER_COMP.COMP_CODE')
            ->join('MASTER_PLANT','MASTER_ITEMBAL.PLANT_CODE','=','MASTER_PLANT.PLANT_CODE')
            ->join('MASTER_ITEM','MASTER_ITEMBAL.ITEM_CODE','=','MASTER_ITEM.ITEM_CODE')
            ->select('MASTER_ITEMBAL.*', 'MASTER_COMP.COMP_NAME as COMPANY_NAME','MASTER_PLANT.PLANT_NAME','MASTER_ITEM.ITEM_NAME')
            ->where('MASTER_ITEMBAL.COMP_CODE', $compCode)
            ->where('MASTER_ITEMBAL.FY_CODE', $macc_year)
            ->get();
           //dd(DB::getQueryLog());

          // echo '<pre>';
          //   print_r($data);
          //   exit;
             return DataTables()->of($data)->addIndexColumn()->toJson();

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	   $data = DB::table('MASTER_ITEMBAL')
            ->join('MASTER_COMP','MASTER_ITEMBAL.COMP_CODE', '=', 'MASTER_COMP.COMP_CODE')
            ->join('MASTER_PLANT','MASTER_ITEMBAL.PLANT_CODE','=','MASTER_PLANT.PLANT_CODE')
            ->join('MASTER_ITEM','MASTER_ITEMBAL.ITEM_CODE','=','MASTER_ITEM.ITEM_CODE')
            ->select('MASTER_ITEMBAL.*', 'MASTER_COMP.COMP_NAME as COMPANY_NAME','MASTER_PLANT.PLANT_NAME','MASTER_ITEM.ITEM_NAME')
            ->where('MASTER_ITEMBAL.COMP_CODE', $compCode)
            ->where('MASTER_ITEMBAL.FY_CODE', $macc_year)
            ->get();

            return DataTables()->of($data)->addIndexColumn()->toJson();

    	}else{
    		
    	 $data = '';
    	 return DataTables()->of($data)->addIndexColumn()->toJson();
    	}

    		

    }

    
    if(isset($CompanyName)){

       return view('admin.finance.master.item.view_item_balance');
    }else{
		return redirect('/useractivity');
	   }

	}

	public function EditItemBalance($compCd,$fyCd,$plCd,$itmCd){


		$title   = 'Edit Item Balance';    	
		$comp_Cd = base64_decode($compCd);
		$fy_Cd   = base64_decode($fyCd);
		$pl_Cd   = base64_decode($plCd);
		$itm_Cd  = base64_decode($itmCd);

    	if(($comp_Cd!='') && ($fy_Cd!='') && ($pl_Cd!='') && ($itm_Cd!='')){

			$query        = DB::table('MASTER_ITEMBAL');
			$query->where('COMP_CODE', $comp_Cd);
			$query->where('FY_CODE', $fy_Cd);
			$query->where('PLANT_CODE', $pl_Cd);
			$query->where('ITEM_CODE', $itm_Cd);
			$ItemData = $query->get()->first();


			
			$company_name   = $ItemData->COMP_CODE;
			$fy_year        = $ItemData->FY_CODE;
			$plant_name     = $ItemData->PLANT_CODE;
			$item_name      = $ItemData->ITEM_CODE;
			$YROPQTY        = $ItemData->YROPQTY;
			$YROPAQTY       = $ItemData->YROPAQTY;
			$YROPVAL        = $ItemData->YROPVAL;
			$moving_avg_val = $ItemData->MAVGRATE;
			$standard_price = $ItemData->STDRATE;
			$ItemBalId      = $ItemData->ITEM_CODE;
			$button ='Update';

			$action ='/Master/Item/form-item-balance-update';

			$userdata['company_data'] = DB::table('MASTER_COMP')->get();
			$userdata['fy_data']      = DB::table('MASTER_FY')->groupBy('fy_code')->get();
			$userdata['plant_data']   = DB::table('MASTER_PLANT')->get();
			$userdata['item_data']    = DB::table('MASTER_ITEM')->get();

			return view('admin.finance.master.item.item_balance',$userdata+compact('title','company_name','fy_year','plant_name','item_name','YROPQTY','YROPAQTY','YROPVAL','moving_avg_val','standard_price','ItemBalId','action','button'));;
		}else{

			$request->session()->flash('alert-error', 'Item Balance Record Not Found...!');
			return redirect('/Master/Item/View-Item-Bal-Mast');

		}


	}


	public function ItemBalanceUpdate(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$loginuser = $request->session()->get('userid');

		$validate = $this->validate($request, [

				'company_name'   => 'required|max:11',
				'fy_year'        => 'required|max:12',
				'plant_name'     => 'required|max:11',
				'item_name'      => 'required|max:11',
				'YROPQTY'        => 'required',
				'YROPVAL'        => 'required',
				
		]);
		
		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

		$id      = $request->input('ItemBalId');
		$fy_year = $request->input('fy_year');
		$compCd  = $request->input('company_name');
		$plantCd = $request->input('plant_name');

		//print_r($id);exit;


		$data = array(
		
			"COMP_CODE"      =>  $request->input('company_name'),
			"FY_CODE"        =>  $request->input('fy_year'),
			"PLANT_CODE"     =>  $request->input('plant_name'),
			"ITEM_CODE"      =>  $request->input('item_name'),
			"YROPQTY"        =>  $request->input('YROPQTY'),
			"YROPAQTY"       =>  $request->input('YROPAQTY'),
			"YROPVAL"        =>  $request->input('YROPVAL'),
			"MAVGRATE"       =>  $request->input('moving_avg_val'),
			"STDRATE"        =>  $request->input('standard_price'),
			"LAST_UPDATE_BY" =>  $request->session()->get('userid'),
			"LAST_UPDATE_DATE" =>  $updatedDate,
			
	    );

      	$UpdatedData = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE', $id)->where('FY_CODE', $fy_year)->where('PLANT_CODE', $plantCd)->where('COMP_CODE', $compCd)->update($data);

      	$discriptn_page = "Master item balance update done by user";
		$this->userLogInsert($loginuser,$discriptn_page);

			if ($UpdatedData) {

				$request->session()->flash('alert-success', 'Item Balance Updated Successfully...!');
				return redirect('/Master/Item/View-Item-Bal-Mast');

			} else {

				$request->session()->flash('alert-error', 'Item Balance Can Not Updated...!');
				return redirect('/Master/Item/View-Item-Bal-Mast');

			}


	}

	public function ItemBalanceDelete(Request $request){

		$id      = $request->input('ItemBalId');
		$splitcd = explode('/',$id);
		$itemCd  = $splitcd[0];
		$fyCode  = $splitcd[1];
		$plantCd = $splitcd[2];
		$compCd  = $splitcd[3];

        if ($id!='') {

			$Delete = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE', $itemCd)->where('FY_CODE', $fyCode)->where('PLANT_CODE', $plantCd)->where('COMP_CODE', $compCd)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Item Balance Record Was Deleted Successfully...!');
			return redirect('/Master/Item/View-Item-Bal-Mast');

			} else {

			$request->session()->flash('alert-error', 'Item Balance Record Can Not Deleted...!');
			return redirect('/Master/Item/View-Item-Bal-Mast');

			}

		}else{

		$request->session()->flash('alert-error', 'Item Balance Record Not Found...!');
		return redirect('/Master/Item/View-Item-Bal-Mast');

		}
	}

/*item balance*/


/*item master finance*/

	public function ItemMasterFinanc(Request $request){

    	$title = 'Add Master Item';
    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');
		$data['help_item_list'] = DB::table('MASTER_ITEM')->Orderby('ITEM_CODE', 'desc')->get();
		$data['item_type']      = DB::table('MASTER_ITEMTYPE')->where('ITEMTYPE_BLOCK','NO')->get();
		$data['item_group']     = DB::table('MASTER_ITEMGROUP')->where('ITEMGROUP_BLOCK','NO')->get();
		$data['item_sch']     = DB::table('MASTER_ITEM_SCHEDULE')->where('ISCHE_BLOCK','NO')->get();

		$data['item_class']     = DB::table('MASTER_ITEM_CLASS')->where('ITEMCLASS_BLOCK','NO')->get();
		
		$data['item_category']  = DB::table('MASTER_ITEM_CATEGORY')->where('ICATG_BLOCK','NO')->get();

		$data['tax_code_list']  = DB::table('MASTER_TAX')->where('TAX_BLOCK','NO')->get();
		
		$data['valuation_code'] = DB::table('MASTER_VALUATION')->where('VALUATION_BLOCK','NO')->get();
		$data['comp_list']      = DB::table('MASTER_COMP')->get();
		$data['um_list']        = DB::table('MASTER_UM')->get();
		$data['hsn_code_list']  = DB::table('MASTER_HSN')->get();
    
    	

    if(isset($compName)){

    	return view('admin.finance.master.item.item_master_form',$data+compact('title'));

    }else{

		return redirect('/useractivity');
	}

    }

    public function ItemMasterFinanceSave(Request $request){

    	$batch_check = $request->input('batch_check');

    	if($batch_check=='YES'){

			$rules['bacth_ref']   = 'required';
		}

        $rules =  [

			'item_code'      => 'required|unique:MASTER_ITEM,ITEM_CODE',
			'item_name'      => 'required|max:40',
			'hsn_code'       => 'required|max:8',
			'valuation_code' => 'required|max:6',
			'item_detail'    => 'required|max:50',
			'aum_factor'      => 'required',
			'item_type'      => 'required',
			'item_schedule'  => 'required',
			'item_group'     => 'required|max:6',
			'item_class'     => 'required|max:6',
			'item_category'  => 'required|max:6',
			'um'             => 'required|max:6',
			'qtydecimal'     => 'required|max:6',
			
			

		];

		$this->validate($request, $rules);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$flag=0;

    	$itemCn = $request->input('item_type');
    	$itemtype_code = '';
    	$itemtype_name = '';
    	if($itemCn){
    		$itemsplit =explode('[',$itemCn);
    		$itemtype_code=$itemsplit[0];
    		$genitypename=$itemsplit[1];
    		$gen_itypename = explode(']', $genitypename);
            $itemtype_name = $gen_itypename[0];
		}

		$materialval = $request->input('material_value');
		$materialvalue = '';
		if($materialval == ''){
			$materialvalue = '0.00';
		}else{
			$materialvalue = $materialval;
		}

		$itemsch = $request->input('item_schedule');
		$itemsch_gencode = '';
		$itemsch_genname = '';
		if($itemsch){
			$itemsch_code = explode('[',$itemsch);
			$itemsch_gencode = $itemsch_code[0];
			$itemschName     = $itemsch_code[1];
            $itemschGenName = explode(']',$itemschName);
            $itemsch_genname = $itemschGenName[0];

		}
    	

		$data = array(
			
			"COMP_TYPE"       => $request->input('companySelect'),
			"COMP_CODE"       => $request->input('comp_code'),
			"COMP_NAME"       => $request->input('comp_name'),
			"ITEM_CODE"       => $request->input('item_code'),
			"ITEM_NAME"       => $request->input('item_name'),
			"HSN_CODE"        => $request->input('hsn_code'),
			"HSN_NAME"        => $request->input('hsn_name'),
			"VALUATION_CODE"  => $request->input('valuation_code'),
			"VALUATION_NAME"  => $request->input('valuation_name'),
			"ITEM_DETAIL"     => $request->input('item_detail'),
			"ITEM_SCH"        => $itemsch_gencode,
			"ITEM_SCHNAME"    => $itemsch_genname,
			"ITEMTYPE_CODE"   => $itemtype_code,
			"ITEMTYPE_NAME"   => $itemtype_name,
			"ITEMGROUP_CODE"  => $request->input('item_group'),
			"ITEMGROUP_NAME"  => $request->input('item_groupname'),
			"ITEMCLASS_CODE"  => $request->input('item_class'),
			"ITEMCLASS_NAME"  => $request->input('item_classname'),
			"ICATG_CODE"      => $request->input('item_category'),
			"ICATG_NAME"      => $request->input('item_catname'),
			"UM"              => $request->input('um'),
			"AUM"             => $request->input('aum'),
			"AUM_FACTOR"      => $request->input('aum_factor'),
			"QTYDECIMAL"      => $request->input('qtydecimal'),
			"RATE_TYPE"       => $request->input('rate_type'),
			"STDRATE"         => $materialvalue,
			"SCRAP_CODE"      => $request->input('scrap_code'),
			"SCRAP_Name"      => $request->input('scrap_name'),
			"BATCH_CHECKE"    => $request->input('batch_check'),
			"BATCH_REFRENCE"  => $request->input('bacth_ref'),
			"TOLERANCE_QTY"   => $request->input('tolrance_rate'),
			"TOLERANCE_BASIS" => $request->input('tolranceindex'),
			"TOLERANCE_NAME"  => $request->input('tolrancename'),
			"LENGTH"          => $request->input('length'),
			"WIDTH"           => $request->input('width'),
			"HEIGHT"          => $request->input('height'),
			"ODC"             => $request->input('odc'),
			"FLAG"            => $flag,
			"CREATED_BY"      => $createdBy,
			
		);

		// echo '<PRE>';print_r($data);exit();

		$saveData = DB::table('MASTER_ITEM')->insert($data);

		$discriptn_page = "Master item insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		$itemumData =array(
        
			"ITEM_CODE"  => $request->input('item_code'),
			"UM_CODE"    => $request->input('um'),
			"AUM_CODE"   => $request->input('aum'),
			"AUM_FACTOR" => $request->input('aum_factor'),
        );

        $saveData1 = DB::table('MASTER_ITEMUM')->insert($itemumData);


        if ($request->ajax()) {


        	$tableId  = $request->input('temptableid');
        	$itemCode = $request->input('item_code');
			$itemName = $request->input('item_name');
			$tblcol   = $request->input('tblcol');



	    	$data = array(

				'ITEM_STATUS' => 'NO',
				 $tblcol     => $itemName.' - '.$itemCode,
	    	);
		

	     	$updateDate =  DB::table('TEMP_DELIVERY_ORDER')->where('ID', $tableId)->update($data);

        	if($saveData){

        		$response_array['response'] = 'success';
	            echo $data = json_encode($response_array);
        	}else{

        		$response_array['response'] = 'error';
        		$data = json_encode($response_array);
                print_r($data);
        	}	

        	
        }else{

        	if($saveData){

			$request->session()->flash('alert-success', 'item Was Successfully Added...!');
			return redirect('/Master/Item/View-Item-Master');

			}else{

				$request->session()->flash('alert-error', 'item Can Not Added...!');
				return redirect('/Master/Item/View-Item-Master');

			}

        }

		
    	
    	

    }


    public function itemMasterView(Request $request){

    $compName = $request->session()->get('company_name');

	    if($request->ajax()) {

	    	$title = 'View Master Item';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	//$data = DB::table('master_depot')->orderBy('id','DESC');

	    	$data = DB::table('MASTER_ITEM')->orderBy('ITEM_CODE','DESC');

	    	
	    	}
	    	elseif ($userType=='superAdmin' || $userType=='user') {

	    	$data = DB::table('MASTER_ITEM')->orderBy('ITEM_CODE','DESC');
	    	}

	    
	    	

	   return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
					
				})->toJson();

	    }

	    if(isset($compName)){
    	return view('admin.finance.master.item.view_item_master_form');
	    }else{
		 return redirect('/useractivity');
	   }
    }



    public function itemMasterViewExcel(Request $request){

    $compName = $request->session()->get('company_name');

	    if($request->ajax()) {

	    	$title = 'View Master Item';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	$data = DB::table('MASTER_ITEM')->where('ITEMTYPE_CODE','TP')->get()->toArray();
	   
	  

	             return DataTables()->of($data)->addIndexColumn()->make(true);



	    }

	   
    }


    public function EditItemMaster(Request $request,$id){

    	$title = 'Edit Master Item';

    	//print_r($id);
    	$itemcode = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);

    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');


    	if($itemcode!=''){
    	    $query = DB::table('MASTER_ITEM');
			$query->where('ITEM_CODE', $itemcode);
			$userData['item_list'] = $query->get()->first();

			$userData['help_item_list'] = DB::table('MASTER_ITEM')->Orderby('ITEM_CODE', 'desc')->get();

			$userData['item_type']     = DB::table('MASTER_ITEMTYPE')->where('ITEMTYPE_BLOCK','NO')->get();
			$userData['item_group']    = DB::table('MASTER_ITEMGROUP')->where('ITEMGROUP_BLOCK','NO')->get();
			$userData['item_class']    = DB::table('MASTER_ITEM_CLASS')->where('ITEMCLASS_BLOCK','NO')->get();
			$userData['item_category'] = DB::table('MASTER_ITEM_CATEGORY')->where('ICATG_BLOCK','NO')->get();

			$userData['tax_code_list'] = DB::table('MASTER_TAX')->where('TAX_BLOCK','NO')->get();
			$userData['hsn_code_list'] = DB::table('MASTER_HSN')->get();

			$userData['valuation_code']    = DB::table('MASTER_VALUATION')->where('VALUATION_BLOCK','NO')->get();
			$userData['comp_list']      = DB::table('MASTER_COMP')->get();

			$userData['um_list'] = DB::table('MASTER_UM')->get();
			//print_r($userData['um_list']);exit;
			return view('admin.finance.master.item.edit_item_master_form', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Item-Id Not Found...!');
			return redirect('/form-mast-depot');
		}

    }


    public function ItemMasterFormUpdate(Request $request){

    	$batch_check = $request->input('batch_check');

    	if($batch_check=='YES'){

			$rules['bacth_ref']   = 'required';
		}
		
		$rules =  [

			'item_code'      => 'required',
			'item_name'      => 'required|max:40',
			'hsn_code'       => 'required|max:8',
			'valuation_code' => 'required|max:6',
			'item_detail'    => 'required|max:50',
			'item_type'      => 'required',
			'item_schedule'  => 'required',
			'item_group'     => 'required|max:6',
			'item_class'     => 'required|max:6',
			'item_category'  => 'required|max:6',
			'item_schedule'  => 'required',
			'um'             => 'required|max:6',
			'qtydecimal'     => 'required|max:6',
			
			

		];

		$this->validate($request, $rules);


		$itemcode =$request->input('updateItemId');
		// $itemcode =$request->input('item_code');
		
		$compName = $request->session()->get('company_name');

	    $fisYear =  $request->session()->get('macc_year');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');
   
		$itemCn = $request->input('item_type');
    	$itemtype_code = '';
    	$itemtype_name = '';
    	if($itemCn){
    		$itemsplit =explode('[',$itemCn);
    		// print_r(count($itemsplit));exit();
    		$itemtype_code=$itemsplit[0];

    		$countitem = count($itemsplit);
    		if($countitem > 1){

	    		$genitypename=$itemsplit[1];
	    		if($genitypename){
					$gen_itypename = explode(']', $genitypename);
					$itemtype_name = $gen_itypename[0];
	    		}else{
					$itemtype_name = '';
	    		}

    		}else{
    			$itemtype_name = '';
    		}
    		
    		

		}

		$materialval = $request->input('material_value');
		$materialvalue = '';
		if($materialval == ''){
			$materialvalue = '0.00';
		}else{
			$materialvalue = $materialval;
		}

		$itemsch = $request->input('item_schedule');
		$itemsch_gencode = '';
		$itemsch_genname = '';
		if($itemsch){
			$itemsch_code = explode('[',$itemsch);
			$itemsch_gencode = $itemsch_code[0];

			$countitem_sch = count($itemsch_code);

			if($countitem_sch > 1){
			  $itemschName     = $itemsch_code[1];
			  if($itemschName){
				$itemschGenName = explode(']',$itemschName);
				$itemsch_genname = $itemschGenName[0];
			  }else{
				$itemsch_genname = '';
			  }	
			}else{
				$itemsch_genname = '';
			}
			
           

		}

		$updatedDate = date("Y-m-d H:i:s"); 

		$data = array(
			"COMP_TYPE"       => $request->input('companySelect'),
			"COMP_CODE"       => $request->input('comp_code'),
			"COMP_NAME"       => $request->input('comp_name'),
			"ITEM_CODE"       => $request->input('item_code'),
			"ITEM_NAME"       => $request->input('item_name'),
			"HSN_CODE"        => $request->input('hsn_code'),
			"HSN_NAME"        => $request->input('hsn_name'),
			"VALUATION_CODE"  => $request->input('valuation_code'),
			"VALUATION_NAME"  => $request->input('valuation_name'),
			"ITEM_DETAIL"     => $request->input('item_detail'),
			"ITEM_SCH"        => $itemsch_gencode,
			"ITEM_SCHNAME"    => $itemsch_genname,
			"ITEMTYPE_CODE"   => $itemtype_code,
			"ITEMTYPE_NAME"   => $itemtype_name,
			"ITEMGROUP_CODE"  => $request->input('item_group'),
			"ITEMGROUP_NAME"  => $request->input('item_groupname'),
			"ITEMCLASS_CODE"  => $request->input('item_class'),
			"ITEMCLASS_NAME"  => $request->input('item_classname'),
			"ICATG_CODE"      => $request->input('item_category'),
			"ICATG_NAME"      => $request->input('item_catname'),
			"UM"              => $request->input('um'),
			"AUM"             => $request->input('aum'),
			"AUM_FACTOR"      => $request->input('aum_factor'),
			"QTYDECIMAL"      => $request->input('qtydecimal'),
			"FLAG"            => $request->input('item_block'),
			"RATE_TYPE"       => $request->input('rate_type'),
			"STDRATE"         => $materialvalue,
			"SCRAP_CODE"      => $request->input('scrap_code'),
			"SCRAP_NAME"      => $request->input('scrap_name'),
			"BATCH_CHECKE"    => $request->input('batch_check'),
			"BATCH_REFRENCE"  => $request->input('bacth_ref'),
			"LENGTH"          => $request->input('length'),
			"WIDTH"           => $request->input('width'),
			"HEIGHT"          => $request->input('height'),
			"ODC"             => $request->input('odc'),
			"TOLERANCE_QTY"   => $request->input('tolrance_rate'),
			"TOLERANCE_BASIS" => $request->input('tolranceindex'),
			"TOLERANCE_NAME"  => $request->input('tolrancename'),
			"LAST_UPDATE_BY"  => $lastUpdatedBy,
			"LAST_UPDATE_DATE"=> $updatedDate
			
		);

		// echo '<PRE>';print_r($data);exit();
		
try{
		$saveData = DB::table('MASTER_ITEM')->where('ITEM_CODE', $itemcode)->update($data);

		$existItm = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemcode)->get()->first();

		$discriptn_page = "Master item update done by user";
		$this->userLogInsert($lastUpdatedBy,$discriptn_page);

		if($existItm){
			//print_r('yes');
			$itemumData =array(
				"UM_CODE"    => $request->input('um'),
				"AUM_CODE"   => $request->input('aum'),
				"AUM_FACTOR" => $request->input('aum_factor'),
	        );

	        $saveData1 = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemcode)->update($itemumData);

		}else{
			//print_r('no');
			$itemumDataIns =array(
				"ITEM_CODE"  => $request->input('item_code'),
				"UM_CODE"    => $request->input('um'),
				"AUM_CODE"   => $request->input('aum'),
				"AUM_FACTOR" => $request->input('aum_factor'),
				"CREATED_BY" => $lastUpdatedBy,
	        );

	        $saveData1 = DB::table('MASTER_ITEMUM')->insert($itemumDataIns);
		}

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Was Successfully Updated...!');
			return redirect('/Master/Item/View-Item-Master');

		} else {

			$request->session()->flash('alert-error', 'Item Can Not Updated...!');
			return redirect('/Master/Item/View-Item-Master');

		}
	}
	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Can Not Be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Item/View-Item-Master');
			}
    }

    public function DeleteItemFinance(Request $request){

        $itemcode = $request->input('itemdelete');
        if ($itemcode!='') {
        	try{

			$Delete = DB::table('MASTER_ITEM')->where('ITEM_CODE', $itemcode)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'item Data Was Deleted Successfully...!');
			return redirect('/Master/Item/View-Item-Master');

			} else {

			$request->session()->flash('alert-error', 'item Data Can Not Deleted...!');
			return redirect('/Master/Item/View-Item-Master');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Can Not Be Deleted...! Used In Another Transaction...!');
					return redirect('/Master/Item/View-Item-Master');
			}

		}else{

		$request->session()->flash('alert-error', 'item Data Not Found...!');
		return redirect('/Master/Item/View-Item-Master');

		}
	}


	public function ListItemSch(Request $request){

		$itemtype_code = $request->itemTypeCode;

		$response_array = array();

		if($request->ajax()) {
          
          if($itemtype_code){

			$data = DB::table('MASTER_ITEM_SCHEDULE')->where('ITEMTYPE_CODE',$itemtype_code)->get();

			if($data){
				$response_array['response'] = 'success';
                $response_array['data'] = $data ;

                $data = json_encode($response_array);

                print_r($data);
			}else{
				$response_array['response'] = 'list_not_available';
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

/*item master finance*/


/* start item quality */

public function ItemQualityMast(Request $request){

		$title        ='Add Item Quality Master';

		$compName 	= $request->session()->get('company_name');
		
		$item_qua_char  = $request->old('item_qua_char');
		$item_qua_desc  = $request->old('item_qua_desc');
		$item_qua_um    = $request->old('item_quality_um');
		$item_qua_block = $request->old('item_qua_block');
		$item_qua_id    = $request->old('item_qua_id');

		$userData['itemc_mst_list'] = DB::table('MASTER_IQUA')->Orderby('IQUA_CODE','desc')->limit(5)->get();

    	$button='Save';
    	$action='/Master/Item/form-mast-item-quality-save';
		//print_r($action);exit;

		if(isset($compName)){

    	return view('admin.finance.master.item.item_quality_form',$userData+compact('title','item_qua_char','item_qua_desc','item_qua_um','item_qua_block','item_qua_id','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

    public function ItemQualityFormSave(Request $request){


		$validate = $this->validate($request, [

			'item_qua_char' => 'required|max:6|unique:MASTER_IQUA,IQUA_CODE',
			'item_qua_desc' => 'required|max:40',
			'item_quality_um' => 'required|max:3',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


    //print_r($fisYear);exit;

    	/*$itemclassData = DB::table('master_item_qua')->orderBy('id', 'DESC')->first();
    	if(!empty($itemclassData)){

    		$getID= $itemclassData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}*/
    	$flag=0;

		$data = array(
			//"id"              => $id,
			"IQUA_CODE"  => $request->input('item_qua_char'),
			"IQUA_NAME"  => $request->input('item_qua_desc'),
			"IQUA_UM"    => $request->input('item_quality_um'),
			"FLAG"       => $flag,
			"CREATED_BY" => $createdBy,
			
		);

		$saveData = DB::table('MASTER_IQUA')->insert($data);

		$discriptn_page = "Master item quality insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Quality Was Successfully Added...!');
			return redirect('/Master/Item/View-Item-Quality-Mast');

		} else {

			$request->session()->flash('alert-error', 'Item Quality Can Not Added...!');
			return redirect('/Master/Item/View-Item-Quality-Mast');

		}

	}
	 public function EditItemQualityMast($id){

    	$title = 'Edit Valuation Master';

    	//print_r($id);
    	$IQUA_CODE = base64_decode($id);
     //$btnControl = base64_decode($btnControl);
    	//print_r($id);exit;

    	if($IQUA_CODE!=''){
    	    $query = DB::table('MASTER_IQUA');
			$query->where('IQUA_CODE', $IQUA_CODE);
			$classData= $query->get()->first();

			$item_qua_char    = $classData->IQUA_CODE;
			$item_qua_desc    = $classData->IQUA_NAME;
			$item_qua_um      = $classData->IQUA_UM;
			$item_qua_block   = $classData->IQUA_BLOCK;
			$item_qua_id  =     $classData->IQUA_CODE;

			$button='Update';
			$action='/Master/Item/form-mast-item-quality-update';

			return view('admin.finance.master.item.item_quality_form',compact('title','item_qua_char','item_qua_desc','item_qua_um','item_qua_block','item_qua_id','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Quality Not Found...!');
			return redirect('/Master/Item/View-Item-Quality-Mast');
		}

    }


    public function ItemQualityFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'item_qua_char'   => 'required|max:6',
			'item_qua_desc'   => 'required|max:40',
			'item_quality_um' => 'required|max:3',
		]);

		$IQUA_CODE = $request->input('item_qua_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

    	$updatedBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
		
			"IQUA_CODE"     => $request->input('item_qua_char'),
			"IQUA_NAME"      => $request->input('item_qua_desc'),
			"IQUA_UM"        => $request->input('item_quality_um'),
			"IQUA_BLOCK"     => $request->input('item_qua_block'),
			"LAST_UPDATE_BY" => $updatedBy,
			"LAST_UPDATE_DATE"=> $updatedDate
			
			
			
		);

	$saveData = DB::table('MASTER_IQUA')->where('IQUA_CODE', $IQUA_CODE)->update($data);

	$discriptn_page = "Master item quality update done by user";
	$this->userLogInsert($updatedBy,$discriptn_page);

	try{

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Quality Was Successfully Updated...!');
			return redirect('/Master/Item/View-Item-Quality-Mast');

		} else {

			$request->session()->flash('alert-error', 'Item Quality Can Not Updated...!');
			return redirect('/Master/Item/View-Item-Quality-Mast');

		}
	}
	catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Quality Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Item/View-Item-Quality-Mast');
			}


	}

	public function ViewItemQualityMast(Request $request){


		$compName = $request->session()->get('company_name');

		//print_r($compName);exit;

		 if($request->ajax()) {

    	$title = 'View  Item Quality Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$data = DB::table('MASTER_IQUA')->orderBy('IQUA_CODE','DESC');

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    	$data = DB::table('MASTER_IQUA')->orderBy('IQUA_CODE','DESC');
    	}
    	else{
    		$data ='';
    	}

    	 return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }

    if(isset($compName)){
    	return view('admin.finance.master.item.view_item_quality');

    }else{
		 return redirect('/useractivity');
	   }

    }


    public function DeleteItemQuality(Request $request){

		$itemQuaId = $request->post('itemQuaId');
		//print_r($itemQuaId);exit;
    	

    	if ($itemQuaId!='') {

    try{

    		$Delete = DB::table('MASTER_IQUA')->where('IQUA_CODE', $itemQuaId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Item Quality Was Deleted Successfully...!');
				return redirect('/Master/Item/View-Item-Quality-Mast');

			} else {

				$request->session()->flash('alert-error', 'Item Quality Can Not Deleted...!');
				return redirect('/Master/Item/View-Item-Quality-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Quality Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/finance/view-mast-item-quality');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Item Quality Not Found...!');
			return redirect('/finance/view-mast-item-quality');

    	}

	}

/* end item quality */

/*item category quality master*/

	public function ItemCatQuality(Request $request){

		$title = 'Add Master Item Category quality';

		$compName 	= $request->session()->get('company_name');

		$itemData['item_qua_mast'] = DB::table('MASTER_IQUA')->get();
		$itemData['item_cat_mast'] = DB::table('MASTER_ITEM_CATEGORY')->get();

	    if(isset($compName)){

	    	return view('admin.finance.master.item.item_cat_qua',$itemData+compact('title'));
	    }else{

			return redirect('/useractivity');
		}

	}

	public function SaveItemCatQuality(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$loginuser = $request->session()->get('userid');

		$rules = [  
					'icatg_code'     => 'required|max:6',
					'iqua_code'      => 'required|max:6',
					'iqua_um'        => 'required|max:3',
					'char_fromvalue' => 'required',
					'char_tovalue'   => 'required',
					'icatg_code'     => ['required', 'string',Rule::unique('MASTER_ICATG_QUA')->where(function ($query) use ($request) {
                        return $query->where('ICATG_CODE', $request->icatg_code)->where('IQUA_CODE', $request->iqua_code);
                            })],
                ];

                $customMessages = [
                    'icatg_code.unique'=>'The Item Category has already been taken for this <b><u>IQUA Char</u></b>',
                ];

                $this->validate($request, $rules, $customMessages);


		$data = array(
			"ICATG_CODE" =>  $request->input('icatg_code'),
			"IQUA_CODE"  =>  $request->input('iqua_code'),
			"IQUA_UM"    =>  $request->input('iqua_um'),
			"VALUE_FROM" =>  $request->input('char_fromvalue'),
			"VALUE_TO"   =>  $request->input('char_tovalue'),
			"CREATED_BY" =>  $request->session()->get('userid'),
	    	);

	$saveData = DB::table('MASTER_ICATG_QUA')->insert($data);

	$discriptn_page = "Master item category quality insert done by user";
	$this->userLogInsert($loginuser,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Category quality Was Successfully Added...!');
				return redirect('/Master/Item/View-Item-Category-Quality-Mast');

			} else {

				$request->session()->flash('alert-error', 'Item Category quality Can Not Added...!');
				return redirect('/Master/Item/View-Item-Category-Quality-Mast');

			}

	}


	public function ViewItemCatQuality(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

		       $title = 'View Master Item Category quality';

		    	$userid	= $request->session()->get('userid');

		    	$userType = $request->session()->get('usertype');

		    	$compName = $request->session()->get('company_name');

		    	$fisYear =  $request->session()->get('macc_year');

		    	if($userType=='admin' || $userType=='Admin'){

		    	 $data = DB::table('MASTER_ICATG_QUA')->orderBy('ICATG_CODE','ASC');

		    	//print_r($GlschData['glsch_data']);exit;
		    	}
		    	elseif ($userType=='superAdmin' || $userType=='user') {

		    		$data = DB::table('MASTER_ICATG_QUA')->orderBy('ICATG_CODE','ASC');
		    	}
		    	else{
		    		$data='';
		    	}

		    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		    }
    	if(isset($compName)){	
    	return view('admin.finance.master.item.view_Item_cat_quality');
    	}else{
		 return redirect('/useractivity');
	   }
    }

    public function DeleteItemCatQuality(Request $request){

        $itemcatqcode = $request->input('iqid');
        if ($itemcatqcode!='') {

        	$isExp = explode('_',$itemcatqcode);
        	$icatCd =$isExp[0];
        	$iquaCd = $isExp[1];
        	try
		{


			$Delete = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE', $icatCd)->where('IQUA_CODE', $iquaCd)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Item Category quality Data Was Deleted Successfully...!');
			return redirect('/Master/Item/View-Item-Category-Quality-Mast');

			} else {

			$request->session()->flash('alert-error', 'Item Category quality Can Not Deleted...!');
			return redirect('/Master/Item/View-Item-Category-Quality-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Category quality be Deleted...! Used In Another Transaction...!');
					return redirect('/Master/Item/View-Item-Category-Quality-Mast');
			}

		}else{

		$request->session()->flash('alert-error', 'Item Category quality Data Not Found...!');
		return redirect('/Master/Item/View-Item-Category-Quality-Mast');

		}
	}


	public function EditItemCatQuality($id,$iquaCd){

    	$title = 'Edit Item Category quality';

    	//print_r($id);
    	$icatcode = base64_decode($id);
    	$iquaCd = base64_decode($iquaCd);
    	//$btnControl = base64_decode($btnControl);


    	if($icatcode!='' && $iquaCd!=''){
    	    $query = DB::table('MASTER_ICATG_QUA');
			$query->where('ICATG_CODE', $icatcode);
			$query->where('IQUA_CODE', $iquaCd);
			$userData['itemcat_list'] = $query->get()->first();

			$userData['item_qua_mast'] = DB::table('MASTER_IQUA')->get();
			$userData['item_cat_mast'] = DB::table('MASTER_ITEM_CATEGORY')->get();

			return view('admin.finance.master.item.edit_item_cat_Quality', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Item Category quality Not Found...!');
			return redirect('/Master/Item/View-Item-Category-Quality-Mast');
		}

    }

    public function UpdateItemCategoryQuality(Request $request){

		
		$validate = $this->validate($request, [

				'iqua_um'        => 'required|max:3',
				'char_fromvalue' => 'required',
				'char_tovalue'   => 'required',

		]);

		$loginuser = $request->session()->get('userid');

       $itemQ_code = $request->input('itemQ_id');
       $iqua_code_up = $request->input('iqua_code_up');
       $updatedDate = date("Y-m-d H:i:s");

		$data = array(
					"IQUA_UM"            =>  $request->input('iqua_um'),
					"VALUE_FROM"         =>  $request->input('char_fromvalue'),
					"VALUE_TO"           =>  $request->input('char_tovalue'),
					"ITEM_QUA_CAT_BLOCK" =>  $request->input('item_cat_qua_block'),
					"LAST_UPDATE_BY"     =>  $request->session()->get('userid'),
					"LAST_UPDATE_DATE"     =>  $updatedDate
	 
	    	);

		$saveData = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE', $itemQ_code)->where('IQUA_CODE', $iqua_code_up)->update($data);

		$discriptn_page = "Master item category quality update done by user";
	    $this->userLogInsert($loginuser,$discriptn_page);

		try
		{

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Category quality Was Successfully Updated...!');
				return redirect('/Master/Item/View-Item-Category-Quality-Mast');

			} else {

				$request->session()->flash('alert-error', 'Item Category quality Can Not Updated...!');
				return redirect('/Master/Item/View-Item-Category-Quality-Mast');

			}

		}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Item Category quality Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Item/View-Item-Category-Quality-Mast');
			}


	}


/*item category quality master*/

public function GetDescAndUm(Request $request){

    	 $iqua_char = $request->post('iqua_char');
    	// print_r($item_code);exit();

    	

    	$getiqua_char = DB::table('MASTER_IQUA')->where('IQUA_CODE',$iqua_char)->get()->first();
    	
     // echo $getumaum;exit;
    	if(!empty($getiqua_char)){

      	echo json_encode($getiqua_char);
    	}
    }


/* --------------- START : STORAGE LOCATION ----------------- */
	
	public function StorageLocation(Request $request){

		$title    ='Add Storage Location Master';
		$compName = $request->session()->get('company_name');
		$splitData      = explode('-', $compName);
		$compCode = $splitData[0];
		$data['comp_list'] = DB::table('MASTER_COMP')->get();
		
		if(isset($compName)){

	    	return view('admin.finance.master.item.add_storage_location',$data+compact('title','compCode'));

	    }else{

			return redirect('/useractivity');
		}

    }

    public function SaveStorageLocation(Request $request){


		$validate = $this->validate($request, [

			'comp_code'     => 'required',
			'comp_name'     => 'required',
			'plant_code'    => 'required',
			'plant_name'    => 'required',
			'location_code' => 'required',
			'location_name' => 'required',
			
		]);

		$createdBy        = $request->session()->get('userid');
		
		$compName         = $request->session()->get('company_name');
		$fisYear          = $request->session()->get('macc_year');
		$getCompCode      = explode('-', $compName);

		$data = array(
			"COMP_CODE"     => $request->input('comp_code'),
			"COMP_NAME"     => $request->input('comp_name'),
			"PLANT_CODE"    => $request->input('plant_code'),
			"PLANT_NAME"    => $request->input('plant_name'),
			"LOCATION_CODE" => $request->input('location_code'),
			"LOCATION_NAME" => $request->input('location_name'),
			"FLAG"          => 1,
			"BLOCK"         => 'NO',
			"CREATED_BY"    => $createdBy,
			
		);

		$saveData = DB::table('MASTER_STORAGE_LOCATION')->insert($data);

		//$discriptn_page = "Master Storage Location insert done by user";
		//$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Storage Location Master Was Successfully Added...!');
			return redirect('/Master/Item/View-Storage-location-Mast');

		} else {

			$request->session()->flash('alert-error', 'Storage Location Master Can Not Added...!');
			return redirect('/Master/Item/View-Storage-location-Mast');

		}

	}

	public function ViewStorageLocation(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	    	$title = 'View Storage Location Master';

	    	$userid	= $request->session()->get('userid');
	    	$userType = $request->session()->get('usertype');
	    	$compName = $request->session()->get('company_name');
	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    		$data = DB::table('MASTER_STORAGE_LOCATION')->orderBy('ID','DESC');
	    	
	    	}elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_STORAGE_LOCATION')->orderBy('ID','DESC');
	    	}else{
	    		$data ='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    	}

    	if(isset($compName)){
    		return view('admin.finance.master.item.view_storage_location');
    	}else{
		 	return redirect('/useractivity');
	   }
    }

    public function EditStoLocation($id){

    	$title = 'Edit Storage Location Master';

    	$id = base64_decode($id);
    	
    	if($id!=''){
    	    $query = DB::table('MASTER_STORAGE_LOCATION');
			$query->where('ID', $id);
			$data['storage_list']= $query->get()->first();
		
			$data['comp_list'] = DB::table('MASTER_COMP')->get();

			return view('admin.finance.master.item.edit_storage_location',$data+compact('title',));
		}else{
			$request->session()->flash('alert-error', 'Storage Location Not Found...!');
			return redirect('/Master/Item/View-Storage-location-Mast');
		}

    }

    public function UpdateStoLocation(Request $request){

		$validate = $this->validate($request, [
		
			'location_code' => 'required',
			'location_name' => 'required',

		]);

		$location_id      = $request->input('location_id');
		$createdBy        = $request->session()->get('userid');
		$compName         = $request->session()->get('company_name');
		$fisYear          = $request->session()->get('macc_year');
		$getCompCode      = explode('-', $compName);
		$comp_code        = $getCompCode[0];
		$comp_name        = $getCompCode[1];
	
		$data = array(
			"LOCATION_CODE" => $request->input('location_code'),
			"LOCATION_NAME" => $request->input('location_name'),
			"BLOCK"         => $request->input('location_block'),
			"UPDATED_BY"    => $createdBy,
			
		);

		try{

			$saveData = DB::table('MASTER_STORAGE_LOCATION')->where('ID',$location_id)->update($data);

			//$discriptn_page = "Master Chamber update done by user";
			//$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Storage location Was Successfully Updated...!');
				return redirect('/Master/Item/View-Storage-location-Mast');

			} else {

				$request->session()->flash('alert-error', 'Storage location Can Not Added...!');
				return redirect('/Master/Item/View-Storage-location-Mast');

			}
		}catch(Exception $ex)
		{
		    $request->session()->flash('alert-error', 'Storage location Cannot be be Updated...! Used In Another Transaction...!');
				return redirect('/Master/Item/View-Storage-location-Mast');
		}

	}

	public function DeleteStoLocation(Request $request){

		$location_id = $request->post('locationId');

		if ($location_id!='') {
    		try{
    			$Delete = DB::table('MASTER_STORAGE_LOCATION')->where('ID', $location_id)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Storage location Was Deleted Successfully...!');
					return redirect('/Master/Item/View-Storage-location-Mast');

				} else {

					$request->session()->flash('alert-error', 'Storage location Can Not Deleted...!');
					return redirect('/Master/Item/View-Storage-location-Mast');

				}
			}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Storage location Can not be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Item/View-Storage-location-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Storage location Not Found...!');
			return redirect('/Master/Item/View-Storage-location-Mast');

    	}

	}

/* --------------- END : STORAGE LOCATION ----------------- */

/*------------- ADD BATCH BALANCE--------------------*/

     public function AddBatchBalance(Request $request){
		//print_r('hello');exit();
	     $title = 'Add Batch Balance';
	    $getData['item_code'] = DB::table('MASTER_ITEM')->get();
		$compName = $request->session()->get('company_name');

		if(isset($compName)){

			return view('admin.finance.master.item.add_item_batch_bal',$getData+compact('title'));

		}else{
			return redirect('/useractivity');
		}

	}

     public function SaveBatchBalance(Request $request){
     	//print_r('hello');exit();
     	$request->validate([
			'item_code'    =>'required',
			'Name_item'    =>'required',
			'batch_no'     =>'required',
			'rqty_recd'    =>'required',
			'raqty_recd'   =>'required',
			'rqty_issued'  =>'required',
			'raqty_issued' =>'required',
			'Um'           =>'required',
			'Aum'          =>'required',
		]);

		$createdBy   = $request->session()->get('userid');

	    $company_name = $request->session()->get('company_name');

		$explodeCnm   = explode('-', $company_name);
		$compCode     = $explodeCnm[0];
        $comname      = $explodeCnm[1];
	 	$fisYear 	 = $request->session()->get('macc_year');
        $itemcode    = $request->input('item_code');
        $itemname    = $request->input('Name_item');
        $batchNo     = $request->input('batch_no');
        $rqtyrecd    = $request->input('rqty_recd');
        $raqtyrecd   = $request->input('raqty_recd');
        $rqtyissued  = $request->input('rqty_issued');
        $raqtyissued = $request->input('raqty_issued');
        $um          = $request->input('Um');
        $aum         = $request->input('Aum');

        $data=array(
        	"COMP_CODE"  => $compCode,
        	"COMP_NAME"  => $comname,
        	"FY_CODE"    => $fisYear,
        	"ITEM_CODE"  => $itemcode,
        	"ITEM_NAME"  => $itemname,
        	"BATCH_NO"   => $batchNo,
        	"RQTYRECD"   => $rqtyrecd,
        	"RAQTYRECD"  => $raqtyrecd,
        	"RQTYISSUED" => $rqtyissued,
        	"RAQTYISSUED" => $raqtyissued,
        	"UM"          => $um,
        	"AUM"         => $aum,
        	"CREATED_BY"  =>  $createdBy 
        );
        //print_r($data);exit();
         $saveData = DB::table('MASTER_ITEM_BATCH_BAL')->insert($data);

        if($saveData){

			$request->session()->flash('alert-success', 'Item Batch Bal Master Successfully Added...!');
	        return redirect('/Master/Item/View-Item-Batch-balance');

		}else{

			$request->session()->flash('alert-error', 'Item Batch Bal Master Can Not Added...!');
			return redirect('/Master/Item/View-Item-Batch-balance');
		}

    }

    public function ViewBatchBalance(Request $request) {

     	$compName = $request->session()->get('company_name');

		$title    = 'View Item Batch Bal Master';

		if($request->ajax()){
      
			
			$userid   = $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear  =  $request->session()->get('macc_year');

			if($userType=='admin'){

			  $data = DB::table('MASTER_ITEM_BATCH_BAL')->orderBy('ITEM_CODE','DESC');
			  //print_r($data);exit();
	        
			}else if ($userType=='superAdmin' || $userType=='user'){    		

			 $data = DB::table('MASTER_ITEM_BATCH_BAL')->orderBy('ITEM_CODE','DESC');

			}else{
				    		
				   $data ='';
			}

		  	 return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

		}

		if(isset($compName)){
    	
	    	return view('admin.finance.master.item.view_item_batch_bal',compact('title'));
		
		}else{

			return redirect('/useractivity');
		}

		
	}

	 public function EditBatchBalance(Request $request,$getId){

	 	$title = 'Edit Batch Balance';
		 
		$id = base64_decode($getId);

        $getData['item_code'] = DB::table('MASTER_ITEM')->get();
        
		if($id!=''){

		 	$editdata = DB::table('MASTER_ITEM_BATCH_BAL')->where('ITEM_CODE',$id)->get()->first();
		 
          	//print_r($editdata);exit();
		 	$response_array['MASTER_ITEM_BATCH_BAL'] = json_decode(json_encode($editdata ),true);
		 	//print_r($response_array['PROJECT_WBS']);exit();
        
		 	return view('admin.finance.master.item.edit_item_batch_bal',$getData+compact('title','editdata'));

		}else{

         	$request->session()->flash('alert-error', 'Item Batch Balance Not  Found...!');
			
			return redirect('/Master/Item/View-Item-Batch-balance');
		}
    }

    public function updateBatchBalance(Request $request){
    	//print_r('hello');exit();
    	$request->validate([
			'item_code'   =>'required',
			'Name_item'   =>'required',
			'batch_no'    =>'required',
			'rqty_recd'   =>'required',
			'raqty_recd'   =>'required',
			'rqty_issued' =>'required',
			'raqty_issued' =>'required',
			'Um'          =>'required',
			'Aum'         =>'required',


		]);

		$updatedDate   = $request->session()->get('userid');
		$codehiden   = $request->input('codehidn');
        $itemcode    = $request->input('item_code');
        $itemname    = $request->input('Name_item');
        $batchNo     = $request->input('batch_no');
        $rqtyrecd    = $request->input('rqty_recd');
        $raqtyrecd   = $request->input('raqty_recd');
        $rqtyissued  = $request->input('rqty_issued');
        $raqtyissued = $request->input('raqty_issued');
        $um          = $request->input('Um');
        $aum         = $request->input('Aum');

        $data=array(
        	"ITEM_CODE"  => $itemcode,
        	"ITEM_NAME"  => $itemname,
        	"BATCH_NO"   => $batchNo,
        	"RQTYRECD"   => $rqtyrecd,
        	"RAQTYRECD"  => $raqtyrecd,
        	"RQTYISSUED" => $rqtyissued,
        	"RAQTYISSUED" => $raqtyissued,
        	"UM"          => $um,
        	"AUM"         => $aum,
        	"LAST_UPDATE_DATE" => $updatedDate,
        );
        //print_r($data);exit();
         
      	$updateData = DB::table('MASTER_ITEM_BATCH_BAL')->where('ITEM_CODE', $codehiden)->update($data);
    
        if($updateData){

			$request->session()->flash('alert-success', 'Item Batch Bal Master Successfully Update...!');
	        return redirect('/Master/Item/View-Item-Batch-balance');

		}else{

			$request->session()->flash('alert-error', 'Item Batch Bal Master Can Not Update...!');
			return redirect('/Master/Item/View-Item-Batch-balance');
		}

    }

/*----------------------END BATCH BALANCE MASTER-------------------------*/

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