<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LogisticController;
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
use App\Images;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\Paginator;
use Image;
class SettingController extends Controller{

	//public $data;

	// 

/* --------------------- START : COMPANY MASTER ----------------------*/

	public function CompanyForm(Request $request){

    	$title = 'Add Master Company';
    	
    	$data['state_list'] = DB::table('MASTER_STATE')->get();
    	$data['acc_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','S')->get();

    	$data['help_copm_list'] = DB::table('MASTER_COMP')->Orderby('COMP_CODE', 'desc')->limit(5)->get();
    	$data['city_lists']         = DB::table('MASTER_CITY')->get();
    	$compDetails = $request->session()->get('company_name');
        if($compDetails){
          return view('admin.finance.master.setting.company_form',$data+compact('title'));
        }else{
        	 return redirect('/useractivity');
        }
    	
    }

   public function CompanyFormSave(Request $request){ 

   		
    	$validate = $this->validate($request, [

			'company_code'  => 'required|max:6|unique:MASTER_COMP,COMP_CODE',
			'company_name'  => 'required|max:40',
			'contact_no1'   => 'required|max:20',
			'emailid'       => 'required|max:20',
			'address_one'   => 'required|max:40',
			'pincode'       => 'required|max:6',
			'country_name'  => 'required|max:30',
			'state_code'    => 'required|max:30',
			'district'      => 'required|max:30',
			'city_code'     => 'required|max:30',
			'pan_no'        => 'required|max:10',
			'logo'          => 'required',

		]);

		$createdBy = $request->session()->get('userid');
		$fisYear =  $request->session()->get('macc_year');

		if($request->hasfile('logo')){ 

               $file = $request->file('logo');
               $extension = $file->getClientOriginalExtension(); // getting image extension
               $filename =time().'.'.$extension;
               $file->move('public/dist/img/', $filename);

	   }else{
	    	$filename='';
	   }
         
         $citycode = explode('[',$request->input('city_code'));
         $cityname = substr($citycode[1], 0, -1);

         $distcode = explode('[',$request->input('district'));
         $distname = substr($distcode[1], 0, -1);

         $statecode = explode('[',$request->input('state_code'));
         $statename = substr($statecode[1], 0, -1);

         $countrycode = explode('[',$request->input('state_code'));
         $countryname = substr($countrycode[1], 0, -1);
         
		$data = array(

			"COMP_CODE"    => $request->input('company_code'),
			"COMP_NAME"    => $request->input('company_name'),
			"ADD1"         => $request->input('address_one'),
			"ADD2"         => $request->input('address_two'),
			"ADD3"         => $request->input('address_three'),
			"ACC_CODE" 	   => $request->input('acc_code'),
			"ACC_NAME"     => $request->input('acc_name'),
			"COUNTRY_CODE" => $countrycode[0],
			"COUNTRY"      => $countryname,
			"STATE_CODE"   => $statecode[0],
			"STATE"        => $statename,
			"DIST_CODE"    => $distcode[0],
			"DIST"         => $distname,
			"CITY_CODE"    => $citycode[0],
			"CITY"         => $cityname,
			"PIN_CODE"     => $request->input('pincode'),
			"PHONE1"       => $request->input('contact_no1'),
			"PHONE2"       => $request->input('contact_no2'),
			"FAX_NO"       => $request->input('fax_no'),
			"EMAIL_ID"     => $request->input('emailid'),
			"PAN_NO"       => $request->input('pan_no'),
			"TAN_NO"       => $request->input('tan_no'),
			"GST_NO"       => $request->input('gst_no'),
			"CIN_NO"       => $request->input('cin_no'),
			"LOGO"         => $filename,
			"CREATED_BY"   => $createdBy

		);

		 print_r($data);
		 exit();

		$saveData = DB::table('MASTER_COMP')->insert($data);

		$discriptn_page = "Master company insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		$dataarray=array(

			'menu_name'    => 'Master Company',
			'submenu_name' => 'Master Company',
			'form_name'    => 'Company',
			'form_code'    => $request->input('company_code'),
		);

		$saveData1 = DB::table('USERACCESS_FORM')->insert($dataarray);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Company Was Successfully Added...!');
			return redirect('/Master/Setting/View-Company-Mast');

		} else {

			$request->session()->flash('alert-error', 'Company Can Not Added...!');
			return redirect('/Master/Setting/View-Company-Mast');

		}
   }

   public function CompanyView(Request $request){


    	if($request->ajax()) {

    	$title = 'View Master Company';

    	$userid	= $request->session()->get('userid');
        
        $userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	$exp = explode("-",$compName);

    	$compName1 =  $exp[1];


    	

         $data = DB::table('MASTER_COMP');

		

		return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
				
			})->toJson();
		}
    	return view('admin.finance.master.setting.view_company');

   }

    public function EditCompanyForm($id){

    	$title = 'Edit Master Company';

    	$COMP_CODE = base64_decode($id);
    	//print_r($COMP_CODE);exit;

    	if($id!=''){
    	    $query = DB::table('MASTER_COMP');
			$query->where('COMP_CODE', $COMP_CODE);
			$compData['comp_list'] = $query->get()->first();

			// echo '<PRE>';print_r($compData);echo '</PRE>';exit();
			$compData['state_list'] = DB::table('MASTER_STATE')->get();

			$compData['city_lists']         = DB::table('MASTER_CITY')->get();
			$compData['acc_list'] = DB::table('MASTER_ACC')->where('ATYPE_CODE','S')->get();

			return view('admin.finance.master.setting.company_list', $compData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Company Not Found...!');
			return redirect('/Master/Setting/View-Company-Mast');
		}
    }


   public function CompanyFormUpdate(Request $request){
    	
    	$validate = $this->validate($request, [

			'company_code'  => 'required|max:6',
			'company_name'  => 'required|max:40',
			'contact_no1'   => 'required|max:20',
			'emailid'       => 'required|max:40',
			'address_one'   => 'required|max:40',
			'pincode'       => 'required|max:6',
			'country_name'  => 'required|max:30',
			'state_code'    => 'required|max:30',
			'district'      => 'required|max:30',
			'city_code'     => 'required|max:30',
			'pan_no'        => 'required|max:10',
			
		]);

		$companyId = $request->input('company_code');
		
		$lastUpdatedBy = $request->session()->get('userid');
		
		$updatedDate = date('Y-m-d');
		
		$logoImg = $request->hasfile('logo');
		
		$citycode = explode('[',$request->input('city_code'));
		$cityname = substr($citycode[1], 0, -1);
		
		$distcode = explode('[',$request->input('district'));
		$distname = substr($distcode[1], 0, -1);
		
		$statecode = explode('[',$request->input('state_code'));
		$statename = substr($statecode[1], 0, -1);
		
		$countrycode = explode('[',$request->input('state_code'));
		$countryname = substr($countrycode[1], 0, -1);
    	
    	if($logoImg == ''){

    		$data = array(
	     		
				"COMP_CODE"        => $request->input('company_code'),
				"COMP_NAME"        => $request->input('company_name'),
				"ADD1"             => $request->input('address_one'),
				"ADD2"             => $request->input('address_two'),
				"ADD3"             => $request->input('address_three'),
				"ACC_CODE" 	       => $request->input('acc_code'),
			    "ACC_NAME"         => $request->input('acc_name'),
				"COUNTRY_CODE"     => $countrycode[0],
				"COUNTRY"          => $countryname,
				"STATE_CODE"       => $statecode[0],
				"STATE"            => $statename,
				"DIST_CODE"        => $distcode[0],
				"DIST"             => $distname,
				"CITY_CODE"        => $citycode[0],
				"CITY"             => $cityname,
				"PIN_CODE"         => $request->input('pincode'),
				"PHONE1"           => $request->input('contact_no1'),
				"PHONE2"           => $request->input('contact_no2'),
				"FAX_NO"           => $request->input('fax_no'),
				"EMAIL_ID"         => $request->input('emailid'),
				"PAN_NO"           => $request->input('pan_no'),
				"TAN_NO"           => $request->input('tan_no'),
				"GST_NO"           => $request->input('gst_no'),
				"CIN_NO"           => $request->input('cin_no'),
				"FLAG"             => $request->input('comp_block'),
				"LAST_UPDATE_BY"   => $lastUpdatedBy,
				"LAST_UPDATE_DATE" => $updatedDate
			
		   );


	      $saveData = DB::table('MASTER_COMP')->where('COMP_CODE',$companyId)->update($data);
	      $discriptn_page = "Master company update done by user";
			$this->userLogInsert($lastUpdatedBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Company Was Successfully Added...!');
				return redirect('/Master/Setting/View-Company-Mast');

			}else{

				$request->session()->flash('alert-error', 'Company Can Not Added...!');
				return redirect('/Master/Setting/View-Company-Mast');

			}

    	}else{
    		
    		if($request->hasfile('logo')) { 
	         $file = $request->file('logo');
	         $extension = $file->getClientOriginalExtension(); // getting image extension
	         $filename =time().'.'.$extension;
	         $file->move('public/dist/img/', $filename);

	     	}else{
	     		$filename='';
	     	}

	     	$data = array(

				"COMP_CODE"        => $request->input('company_code'),
				"COMP_NAME"        => $request->input('company_name'),
				"ADD1"             => $request->input('address_one'),
				"ADD2"             => $request->input('address_two'),
				"ADD3"             => $request->input('address_three'),
				"COUNTRY_CODE"     => $countrycode[0],
				"COUNTRY"          => $countryname,
				"STATE_CODE"       => $statecode[0],
				"STATE"            => $statename,
				"DIST_CODE"        => $distcode[0],
				"DIST"             => $distname,
				"CITY_CODE"        => $citycode[0],
				"CITY"             => $cityname,
				"PIN_CODE"         => $request->input('pincode'),
				"PHONE1"           => $request->input('contact_no1'),
				"PHONE2"           => $request->input('contact_no2'),
				"FAX_NO"           => $request->input('fax_no'),
				"EMAIL_ID"         => $request->input('emailid'),
				"PAN_NO"           => $request->input('pan_no'),
				"GST_NO"           => $request->input('gst_no'),
				"CIN_NO"           => $request->input('cin_no'),
				"LOGO"             => $filename,
				"FLAG"             => $request->input('comp_block'),
				"LAST_UPDATE_BY"   => $lastUpdatedBy,
				"LAST_UPDATE_DATE" => $updatedDate
				
		   );


	      $saveData = DB::table('MASTER_COMP')->where('COMP_CODE',$companyId)->update($data);
	      $discriptn_page = "Master company update done by user";
			$this->userLogInsert($lastUpdatedBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Company Was Successfully Added...!');
				return redirect('/Master/Setting/View-Company-Mast');

			}else{

				$request->session()->flash('alert-error', 'Company Can Not Added...!');
				return redirect('/Master/Setting/View-Company-Mast');

			}

    	}

    	

		
   }

   public function DeleteCompany(Request $request){

    	$CompanyID = $request->post('CompanyID');

    	if ($CompanyID!='') {
    		
    		$Delete = DB::table('MASTER_COMP')->where('COMP_CODE', $CompanyID)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Company Was Deleted Successfully...!');
				return redirect('/Master/Setting/View-Company-Mast');

			} else {

				$request->session()->flash('alert-error', 'Company Can Not Deleted...!');
				return redirect('/Master/Setting/View-Company-Mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Company Not Found...!');
			return redirect('/Master/Setting/View-Company-Mast');

    	}

   }

/* --------------------- END : COMPANY MASTER ----------------------*/


/*FY MASTER*/

 public function FyForm(Request $request){

     	$title = 'Add Master Fy';
    	$data['comp_code'] = DB::table('MASTER_COMP')->where('FLAG',0)->get();

    	$data['help_fy_list'] = DB::table('MASTER_FY')->Orderby('FY_CODE', 'desc')->limit(5)->get();
    	$compDetails = $request->session()->get('company_name');
       if($compDetails){
        	return view('admin.finance.master.setting.fy_form',$data+compact('title'));
        }else{
        	return redirect('/useractivity');
        }

    	
    }

    public function FyFormSave(Request $request)
    {
    	//print_r($request->post());

    	$fyDate = $request->input('fy_from_date');

    	$toDate = $request->input('fy_to_date');

    	$From_date = date("Y-m-d", strtotime($fyDate));

    	$To_date = date("Y-m-d", strtotime($toDate));

		$comp_code = $request->input('company_code');
		$fy_code   = $request->input('fy_code');

       $results = DB::table('MASTER_FY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fy_code)->get();

      // 	print_r($results);exit;

       $rules = [	
    				'company_code' => 'required|max:6',
					'fy_from_date' => 'required|max:12',
					'fy_to_date'   => 'required|max:12',
					'fy_code' => ['required', 'string',Rule::unique('MASTER_FY')->where(function ($query) use ($request) {
					    return $query->where('COMP_CODE', $request->company_code)->where('FY_CODE', $request->fy_code);
							})],
			    ];

			    $customMessages = [
			        'fy_code.unique'=>'The FY Code has already been taken for this <b><u> Comp Code</u></b>',
			    ];

			    $this->validate($request, $rules, $customMessages);
       

         /*   $validate = $this->validate($request, [

				'company_code' => 'required|max:6',
				'fy_from_date' => 'required|max:12',
				'fy_to_date'   => 'required|max:12',
				'fy_code'      => 'required|max:9|unique:MASTER_FY,FY_CODE',
			
			]);*/

		

			$createdBy = $request->session()->get('userid');
			$fisYear   =  $request->session()->get('macc_year');
			$flag      =0;

			$data = array(
				"COMP_CODE"   => $request->input('company_code'),
				"FY_CODE"     => $request->input('fy_code'),
				"FISCAL_YEAR"  => $fisYear,	
				"FY_FROM_DATE" => $From_date,
				"FY_TO_DATE"   => $To_date,
				"FLAG"         => $flag,
				"CREATED_BY"   => $createdBy
				
			);

			$saveData = DB::table('MASTER_FY')->insert($data);

			$discriptn_page = "Master fy insert done by user";
			$this->userLogInsert($createdBy,$discriptn_page);

			if($saveData){

				$request->session()->flash('alert-success', 'Fy Was Successfully Added...!');
				return redirect('/Master/Setting/View-Fy-Mast');

			}else{

				$request->session()->flash('alert-error', 'Fy Can Not Added...!');
				return redirect('/Master/Setting/View-Fy-Mast');
			}

        
    
        

    }

    public function FyView(Request $request){


  if($request->ajax()) {

		$title    = 'View Master Fy';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$fisYear  =  $request->session()->get('macc_year');

		$CompanyCode   = $request->session()->get('company_name');
		$getcompname = explode('-', $CompanyCode);
		$comp_code= $getcompname[0];
		$comp_name= $getcompname[1];

    	if($userType=='admin'){

    		
    		$data = DB::table('MASTER_FY')
            ->join('MASTER_COMP', 'MASTER_FY.COMP_CODE', '=', 'MASTER_COMP.COMP_CODE')
            ->select('MASTER_FY.*', 'MASTER_COMP.COMP_NAME')
            ->where('MASTER_FY.COMP_CODE',$comp_code)
            ->orderBy('MASTER_FY.FY_CODE','DESC');

    		
		}else if($userType=='superAdmin' || $userType=='user'){

			$data = DB::table('MASTER_FY')
            ->join('MASTER_COMP', 'MASTER_FY.COMP_CODE', '=', 'MASTER_COMP.COMP_CODE')
            ->select('MASTER_FY.*', 'MASTER_COMP.COMP_NAME')
            ->where('MASTER_FY.COMP_CODE',$comp_code)
            ->orderBy('MASTER_FY.FY_CODE','DESC');

		}else{

			$data='';
			
		}

		return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
				
			})->toJson();
	}

    	return view('admin.finance.master.setting.view_fy');


    }

    public function EditFyForm($compCode,$fyCode){

    	$title = 'Edit Master Fy';

    	$COMP_CODE = base64_decode($compCode);
    	$FY_CODE = base64_decode($fyCode);

    	if(($COMP_CODE!='') && ($FY_CODE!='')){
    	   
			//DB::enableQueryLog();
			$userData['fy_list'] = DB::table('MASTER_FY')
            ->join('MASTER_COMP', 'MASTER_FY.COMP_CODE', '=', 'MASTER_COMP.COMP_CODE')
            ->select('MASTER_FY.*', 'MASTER_COMP.COMP_NAME')
            ->where('MASTER_FY.COMP_CODE','=',$COMP_CODE)
            ->where('MASTER_FY.FY_CODE','=',$FY_CODE)
            ->orderBy('FY_CODE','DESC')
            ->get()->first();
            //dd(DB::getQueryLog());
			return view('admin.finance.master.setting.fy_list', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Fy Not Found...!');
			return redirect('/Master/Setting/View-Fy-Mast');
		}
    }


    public function FyFormUpdate(Request $request){

    	$fyDate = $request->input('fy_from_date');

    	$toDate = $request->input('fy_to_date');

    	$From_date = date("Y-m-d", strtotime($fyDate));

    	$To_date = date("Y-m-d", strtotime($toDate));

    	$fisYear  =  $request->session()->get('macc_year');


    	//print_r($request->post());exit();
    	$validate = $this->validate($request, [

			'fy_to_date'   => 'required|max:12',
			'fy_code'      => 'required|max:9',
		
		]);

    	$lastUpdatedBy = $request->session()->get('userid'); 

    	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

		$data = array(
			"FISCAL_YEAR"      => $fisYear,	
			"FY_FROM_DATE"     => $From_date,
			"FY_TO_DATE"       => $To_date,
			"BLOCK_FY"         => $request->input('fy_block'),
			"LAST_UPDATE_BY"   => $lastUpdatedBy,
			"LAST_UPDATE_DATE" => $updatedDate
			
		);
		//print_r($data);exit();

		$fy_code = $request->input('fy_code');
		$comp_code = $request->input('company_code');

		$saveData = DB::table('MASTER_FY')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fy_code)->update($data);

		$discriptn_page = "Master fy update done by user";
		$this->userLogInsert($lastUpdatedBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Fy Was Successfully Updated...!');
			return redirect('/Master/Setting/View-Fy-Mast');

		} else {

			$request->session()->flash('alert-error', 'Fy Can Not Updated...!');
			return redirect('/Master/Setting/View-Fy-Mast');

		}
    }

    public function DeleteFy(Request $request){

			$FY_CODE   = $request->post('FyID');
			$comp_CODE = $request->post('compCode');

    		if(($FY_CODE!='') && ($comp_CODE!='')) {
    		
    			$Delete = DB::table('MASTER_FY')->where('COMP_CODE',$comp_CODE)->where('FY_CODE',$FY_CODE)->delete();

	        	/*$comp_code = DB::table('MASTER_FY')->where('COMP_CODE',$fy->COMP_CODE)->get()->toArray();
	        	
	        	$count =count($comp_code);

	        	if($count >1){
	        		$Delete = DB::table('MASTER_FY')->where('FY_CODE', $FY_CODE)->delete();

	        	}else{
	        		$Delete = DB::table('MASTER_FY')->where('FY_CODE', $FY_CODE)->delete();

	        		$data=array(

	        			'fy_mast'=>0

	        		);
	        	
	        	}*/
        	
			if ($Delete) {

				$request->session()->flash('alert-success', 'Fy Was Deleted Successfully...!');
				return redirect('/Master/Setting/View-Fy-Mast');

			} else{

				$request->session()->flash('alert-error', 'Fy Can Not Deleted...!');
				return redirect('/Master/Setting/View-Fy-Mast');

			}

    	    }else{

    		   $request->session()->flash('alert-error', 'Fy Not Found...!');
			   return redirect('/Master/Setting/View-Fy-Mast');

    	    }
    }



/*FY MASTER*/

/* NEW FY YEAER*/

 	public function NewFyYear(Request $request){

     	$title = 'Add Master Fy';
    	$data['comp_code'] = DB::table('MASTER_COMP')->where('FLAG',0)->get();

    	$data['help_fy_list'] = DB::table('MASTER_FY')->Orderby('FY_CODE', 'desc')->limit(5)->get();
    
    	return view('admin.finance.master.setting.new_fy_form',$data+compact('title'));
    }



	public function NewFyFormSave(Request $request){


    	//print_r($request->post());

    	$fyDate = $request->input('fy_from_date');

    	$toDate = $request->input('fy_to_date');

    	$From_date = date("Y-m-d", strtotime($fyDate));

    	$To_date = date("Y-m-d", strtotime($toDate));

		$comp_code = $request->input('company_code');
		$fy_code   = $request->input('fy_code');


        $compName = $request->session()->get('company_name');
    	$spliComp = explode('-',$compName);
    	$compCode = $spliComp[0];
		$createdBy = $request->session()->get('userid');
		$fisYear   =  $request->session()->get('macc_year');
		$GetYear = explode('-', $fisYear);

                           
        $newfirstyear = $GetYear[0] + 1;
		
		$flag      =0;
		$saveData=array();
		if ($comp_code==$compCode) {

			$data = array(
				"COMP_CODE"   => $request->input('company_code'),
				"FY_CODE"     => $request->input('fy_code'),
				"FISCAL_YEAR"  => $newfirstyear,	
				"FY_FROM_DATE" => $From_date,
				"FY_TO_DATE"   => $To_date,
				"FLAG"         => $flag,
				"CREATED_BY"   => $createdBy
				
			);

			$saveData[] = DB::table('MASTER_FY')->insert($data);
			
		}else{

			/*  Create FY Code for all company */

			 $FYCHECK = DB::table('MASTER_FY')->where('FY_CODE',$fisYear)->get();
			 $MFYCHECK = json_decode(json_encode($FYCHECK),true);

	
				foreach ($MFYCHECK as $row) {
					
					$data = array(
						"COMP_CODE"    => $row['COMP_CODE'],
						"FY_CODE"      => $request->input('fy_code'),
						"FISCAL_YEAR"  => $newfirstyear,	
						"FY_FROM_DATE" => $From_date,
						"FY_TO_DATE"   => $To_date,
						"FLAG"         => $flag,
						"CREATED_BY"   => $createdBy
						
					);

					$COMPFOUND = DB::table('MASTER_FY')->where('COMP_CODE',$row['COMP_CODE'])->where('FY_CODE',$fy_code)->get();

					$MCOMPFOUND = json_decode(json_encode($COMPFOUND),true);

					$MCOMPFOUNDCOUNT = count($MCOMPFOUND);

					if ($MCOMPFOUNDCOUNT>0) {
						/*echo '<pre>';
						print_r($MCOMPFOUND);*/
						/* Do Nothing */	
						$saveData[] = '';
					}else{

						$saveData[] = DB::table('MASTER_FY')->insert($data);

					}

				}

			/*  ./ Create FY Code for all company */


		}

		/*echo '<pre>';
		print_r($saveData);
		exit();*/

			if($saveData){

				$request->session()->flash('alert-success', 'Fy Was Successfully Added...!');
				return redirect('/Master/Setting/View-Fy-Mast');

			}else{

				$request->session()->flash('alert-error', 'Fy Can Not Added...!');
				return redirect('/Master/Setting/View-Fy-Mast');
			}


	}

/* NEW FY YEAER*/

/*PROFIT CENTER*/

public function ProfitCenterMaster(Request $request){

    	$title ='Add Transaction Master';
		$compData['comp_list'] = DB::table('MASTER_COMP')->get();

		$compData['city_lists'] = DB::table('MASTER_CITY')->get();

		//print_r($compData['comp_list']);exit;
		$compName 	= $request->session()->get('company_name');

		$compData['help_pfct_list'] = DB::table('MASTER_PFCT')->Orderby('PFCT_CODE', 'desc')->limit(5)->get();

		

	if(isset($compName)){

    	return view('admin.finance.master.setting.profit_center_form',$compData+compact('title'));

    }else{

		return redirect('/useractivity');
	}

    }


    public function ProfitCenterFormSave(Request $request){

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$comp_code   = $request->input('comp_code');
		$pfct_code = $request->input('pfct_code');


    	$rules = [	
						'comp_code'   => 'required|max:6',
						'profit_name' => 'required|max:40',
						'pfct_code'   => ['required', 'string',Rule::unique('MASTER_PFCT')->where(function ($query) use ($request) {
					    return $query->where('COMP_CODE', $request->comp_code)->where('PFCT_CODE', $request->pfct_code);
							})],
		    	];

		$customMessages = [
		  'pfct_code.unique'=>'The Pfct Code has already been taken for this <b><u> Comp Code</u></b>',
		];

		$this->validate($request, $rules, $customMessages);
		
		$cityCode = $request->input('city');

		if($cityCode){

			$splitData = explode('[',$cityCode);
			$citycode = $splitData[0];
		   $cityname = substr($splitData[1], 0, -1);

		}else{

			$citycode = '';
			$cityname = '';

		}
		
		$dist_code = $request->input('district');

		if($dist_code){
			$splitdist = explode('[',$dist_code);
			$distcode  = $splitdist[0];
			$distname  = substr($splitdist[1], 0, -1);
		}else{

			$distcode='';
			$distname='';

		}

		$stateCode = $request->input('state');

		if($stateCode){
         $splitState = explode('[',$stateCode);
         $statecode = $splitState[0];
		   $statename = substr($splitState[1], 0, -1);
		
		}else{
		   $statecode='';
		   $statename='';
		}
		
		$country_code = $request->input('country');

		if($country_code){
         $slitCountry = explode('[',$country_code);
         $countrycode = $slitCountry[0];
		   $countryname = substr($slitCountry[1], 0, -1);
		}else{
           $countrycode='';
		   $countryname='';
		}
		
		
        $data = array(
			"COMP_CODE"    => $request->input('comp_code'),
			"COMP_NAME"    => $request->input('compName'),
			"PFCT_CODE"    => $request->input('pfct_code'),
			"PFCT_NAME"    => $request->input('profit_name'),
			"ADD1"         => $request->input('add1'),
			"ADD2"         => $request->input('add2'),
			"ADD3"         => $request->input('add3'),
			// "CITY"      => $request->input('city'),
			// "DISTRICT"  => $request->input('district'),
			// "STATE"     => $request->input('state'),
			// "COUNTRY"   => $request->input('country'),
			"COUNTRY_CODE" => $countrycode,
			"COUNTRY_NAME" => $countryname,
			"STATE_CODE"   => $statecode,
			"STATE_NAME"   => $statename,
			"DIST_CODE"    => $distcode,
			"DIST_NAME"    => $distname,
			"CITY_CODE"    => $citycode,
			"CITY_NAME"    => $cityname,
			"PIN_CODE"     => $request->input('pin_code'),
			"PHONE1"       => $request->input('phone1'),
			"PHONE2"       => $request->input('phone2'),
			"FAX_NO"       => $request->input('fax_no'),
			"EMAIL_ID"     => $request->input('email_id'),
			"FLAG"         => '0',
			"CREATED_BY"   => $createdBy,
		
		);
		//print_r($data);exit();

		$saveData = DB::table('MASTER_PFCT')->insert($data);

		$discriptn_page = "Master pfct insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if($saveData){

			$request->session()->flash('alert-success', 'Profit Center Was Successfully Added...!');
			return redirect('/Master/Setting/View-Profit-Center-Mast');

		}else{

			$request->session()->flash('alert-error', 'Profit Center Was Not Added...!');
			return redirect('/Master/Setting/View-Profit-Center-Mast');
		}


	}


	public function ViewProfitCenterMast(Request $request){

    $compName = $request->session()->get('company_name');

	if($request->ajax()) {

    	$title = 'View Profit Center';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');
    	$spliComp = explode('-',$compName);
    	$compCode = $spliComp[0];

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){

    	// $data = DB::table('MASTER_PFCT')
     //        ->leftJoin('MASTER_COMP', 'MASTER_PFCT.COMP_CODE', '=','MASTER_COMP.COMP_CODE')
     //        ->select('MASTER_PFCT.*', 'MASTER_COMP.COMP_NAME as CNAME')
     //        ->where('MASTER_PFCT.COMP_CODE',$compCode)
     //        ->orderBy('COMP_CODE','DESC');
    		$data = DB::table('MASTER_PFCT')
            ->leftJoin('MASTER_COMP', 'MASTER_PFCT.COMP_CODE', '=','MASTER_COMP.COMP_CODE')
            ->select('MASTER_PFCT.*', 'MASTER_COMP.COMP_NAME as CNAME')
            ->orderBy('COMP_CODE','DESC');
           

            //print_r($data);exit;
    	}
    	elseif($userType=='superAdmin' || $userType=='user') {

    		/*$pfctData['pfct_list'] = DB::table('master_pfct')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();*/


    		$data = DB::table('MASTER_PFCT')
            ->join('MASTER_COMP', 'MASTER_PFCT.COMP_CODE', '=', 'MASTER_COMP.COMP_CODE')
            ->select('MASTER_PFCT.*', 'MASTER_COMP.COMP_NAME')
            ->orderBy('COMP_CODE','DESC')
            ->get();

            // print_r($data);exit;
    	}
    	else{
    		$data='';
    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

}
		if(isset($compName)){

    	return view('admin.finance.master.setting.view_profit_center');
		}else{
		 return redirect('/useractivity');
	   }
    }


    public function EditProfitCenterMast($id,$comCd){

    	$title = 'Edit Master Transaction';

    	//print_r($id);
    	$PFCT_CODE = base64_decode($id);
    	$com_Cd = base64_decode($comCd);
    	//$btnControl = base64_decode($btnControl);

    	//print_r($id);exit;
    	if($PFCT_CODE!='' && $com_Cd!=''){
    	    $query = DB::table('MASTER_PFCT');
			$query->where('PFCT_CODE', $PFCT_CODE);
			$query->where('COMP_CODE', $com_Cd);
			$pfctData['pfct_list'] = $query->get()->first();

			$pfctData['comp_list'] = DB::table('MASTER_COMP')->get();

			$pfctData['state_list'] = DB::table('MASTER_STATE')->get();

			$pfctData['city_lists']         = DB::table('MASTER_CITY')->get();

			//print_r($userData['transaction_list']);exit;
			return view('admin.finance.master.setting.edit_profit_center', $pfctData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Profit Center Not Found...!');
			return redirect('/Master/Setting/View-Profit-Center-Mast');
		}

    }


    public function ProfitCenterFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'profit_code' => 'required|max:6',
			'comp_code'   => 'required|max:6',
			'profit_name' => 'required|max:40',

		]);

		$pfctId      =$request->input('pfctId');
		
		date_default_timezone_set('Asia/Kolkata');
		
		$updatedDate = date("Y-m-d");

		$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$PFCT_CODE = $request->input('profit_code');
    	$comp_code = $request->input('comp_code');
		
        $cityCode = $request->input('city');
        
        if($cityCode != ''){
        	$city_code = explode('[',$request->input('city'));
        	$citycode = $city_code[0];
	     	$cityname = substr($city_code[1], 0, -1);
        }else{
        	$citycode = '';
			$cityname = '';
        }
		
		$distCode = $request->input('district');

		if($distCode != ''){
          $dist_code = explode('[',$request->input('district'));
          $distcode = $dist_code[0];
		  $distname = substr($dist_code[1], 0, -1);
		}else{
          $distcode = '';
		  $distname = '';
		}
		
		$stateeCode = $request->input('state');
		if($stateeCode != ''){
           $state_code = explode('[',$request->input('state'));
           $statecode = $state_code[0];
		   $statename = substr($state_code[1], 0, -1);
		}else{
          $statecode = '';
		  $statename = '';
		}
		
		$countryCode = $request->input('country');
		// print_r($countryCode);exit();
		if($countryCode != ''){
          $country_code = explode('[',$countryCode);
          $countrycode = $country_code[0];
		  $countryname = substr($country_code[1], 0, -1);
		}else{
          $countrycode = '';
		  $countryname = '';
		}
		
       try{


		$data = array(
			"PFCT_NAME"        => $request->input('profit_name'),
			"ADD1"             => $request->input('add1'),
			"ADD2"             => $request->input('add2'),
			"ADD3"             => $request->input('add3'),
			"COUNTRY_CODE"     => $countrycode,
			"COUNTRY_NAME"     => $countryname,
			"STATE_CODE"       => $statecode,
			"STATE_NAME"       => $statename,
			"DIST_CODE"        => $distcode,
			"DIST_NAME"        => $distname,
			"CITY_CODE"        => $citycode,
			"CITY_NAME"        => $cityname,
			"PIN_CODE"         => $request->input('pin_code'),
			"PHONE1"           => $request->input('phone1'),
			"PHONE2"           => $request->input('phone2'),
			"FAX_NO"           => $request->input('fax_no'),
			"EMAIL_ID"         => $request->input('email_id'),
			"FLAG"             => '0',
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		//DB::enableQueryLog();

		$saveData = DB::table('MASTER_PFCT')->where('PFCT_CODE', $PFCT_CODE)->where('COMP_CODE', $comp_code)->update($data);

		$discriptn_page = "Master pfct update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);
		//dd(DB::getQueryLog());

		if ($saveData) {

			$request->session()->flash('alert-success', 'Profit Center Was Successfully Updated...!');
			return redirect('/Master/Setting/View-Profit-Center-Mast');

		} else {

			$request->session()->flash('alert-error', 'Profit Center Can Not Updated...!');
			return redirect('/Master/Setting/View-Profit-Center-Mast');

		}
	}
	catch(Exception $ex){
	    $request->session()->flash('alert-error', 'Profit Center Cannot be be Updated...! Used In Another Transaction...!');
			return redirect('/Master/Setting/View-Profit-Center-Mast');
	}

	}

	public function DeleteProfitCt(Request $request){

		$pfctId = $request->post('pfctId');
    	

    	if ($pfctId!='') {

    		$splitCd = explode('_',$pfctId);
			$cmpcd = $splitCd[0];
			$pfctcd = $splitCd[1];

    try{
    		
    		$Delete = DB::table('MASTER_PFCT')->where('COMP_CODE', $cmpcd)->where('PFCT_CODE', $pfctcd)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Profit Center Was Deleted Successfully...!');
				return redirect('/Master/Setting/View-Profit-Center-Mast');

			} else {

				$request->session()->flash('alert-error', 'Profit Center Can Not Deleted...!');
				return redirect('/Master/Setting/View-Profit-Center-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Profit Center Cannot be be Deleted...! Used In Another Transaction...!');
					return redirect('/Master/Setting/View-Profit-Center-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Profit Center Not Found...!');
			return redirect('/Master/Setting/View-Profit-Center-Mast');

    	}

	}

/*PROFIT CENTER*/


/*transaction master*/
public function TransactionMaster(Request $request){

		$title ='Add Transaction Master';

		$compName 	= $request->session()->get('company_name');
			//print_r($userData['acctype_list']);exit;

		$userData['trans_mst_list'] = DB::table('MASTER_TRANSACTION')->Orderby('TRAN_CODE', 'desc')->limit(5)->get();

		//$userData['trans_code_list'] = DB::table('TRANSACTION_CODE')->Orderby('id', 'desc')->get();
		$userData['trans_code_list'] = DB::table('TRANSACTION_CODE')->get();
			
			

	if(isset($compName)){

    	return view('admin.finance.master.setting.transaction_form',$userData+compact('title'));

    }else{

		return redirect('/useractivity');
	}
		
	}

	public function TransactionFormSave(Request $request){

		$validate = $this->validate($request, [

			'transaction_code'    => 'required|max:2|unique:MASTER_TRANSACTION,TRAN_CODE',
			'transaction_head'    => 'required|max:40',
			

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');



		$data = array(
			"TRAN_CODE"     => $request->input('transaction_code'),
			"TRAN_HEAD"     => $request->input('transaction_head'),
			"AUTO_POSTCODE" => $request->input('auot_postcode'),
			"CREATED_BY"    => $createdBy,
			
		);

		$saveData = DB::table('MASTER_TRANSACTION')->insert($data);

		$discriptn_page = "Master transaction insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Transaction Was Successfully Added...!');
			return redirect('/Master/Setting/View-Transaction-Mast');

		} else {

			$request->session()->flash('alert-error', 'Transaction Can Not Added...!');
			return redirect('/Master/Setting/View-Transaction-Mast');

		}

	}


	public function ViewTransactionMast(Request $request){

		$compName = $request->session()->get('company_name');

		 if($request->ajax()) {

    	$title = 'View Master Transaction';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){

    	$data  = DB::table('MASTER_TRANSACTION')->orderBy('TRAN_CODE','DESC');
    	}
    	elseif ($userType=='superAdmin' || $userType=='user') {

    		$data  = DB::table('MASTER_TRANSACTION')->orderBy('TRAN_CODE','DESC');
    	}
    	else{
    		$data ='';
    	}

    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    }
    	if(isset($compName)){

    	return view('admin.finance.master.setting.view_transaction');
    	}else{
		return redirect('/useractivity');
	}
   }


    public function EditTransactionMast($id){

    	$title = 'Edit Master Transaction';
    	//print_r($id);
    	$TRAN_CODE = base64_decode($id);
    	//$btnControl = base64_decode($btnControl);
    	$userData['trans_code_list'] = DB::table('TRANSACTION_CODE')->Orderby('id', 'desc')->get();

    	if($TRAN_CODE!=''){
    	    $query = DB::table('MASTER_TRANSACTION');
			$query->where('TRAN_CODE', $TRAN_CODE);
			$userData['transaction_list'] = $query->get()->first();
			//print_r($userData['transaction_list']);exit;
		return view('admin.finance.master.setting.edit_transaction_form', $userData+compact('title'));

		}else{
			$request->session()->flash('alert-error', 'Transaction Not Found...!');
		return redirect('/Master/Setting/View-Transaction-Mast');

		}
    }

    public function TransactionFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'transaction_code'  => 'required|max:2',
			'transaction_head'  => 'required|max:40',
			'transaction_block' => 'required',
			

		]);


		$transId=$request->input('transId');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			
			"TRAN_CODE"        => $request->input('transaction_code'),
			"TRAN_HEAD"        => $request->input('transaction_head'),
			"AUTO_POSTCODE"    => $request->input('auto_postcode'),
			"TRAN_BLOCK"       => $request->input('transaction_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		$saveData = DB::table('MASTER_TRANSACTION')->where('TRAN_CODE', $transId)->update($data);


		$discriptn_page = "Master transaction update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		try{

			if ($saveData) {

			$request->session()->flash('alert-success', 'Transaction Was Successfully Added...!');
			return redirect('/Master/Setting/View-Transaction-Mast');

			} else {

				$request->session()->flash('alert-error', 'Transaction Can Not Added...!');
				return redirect('/Master/Setting/View-Transaction-Mast');

			}
		}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Depot Cannot be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Setting/View-Transaction-Mast');
			}

    }

    public function DeleteTransaction(Request $request){

		$transactionId = $request->post('transactionId');
    	

    	if ($transactionId!='') {

    	try{
    		
    		$Delete = DB::table('MASTER_TRANSACTION')->where('TRAN_CODE', $transactionId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Transaction Was Deleted Successfully...!');
				return redirect('/Master/Setting/View-Transaction-Mast');

			} else {

				$request->session()->flash('alert-error', 'Transaction Can Not Deleted...!');
				return redirect('/Master/Setting/View-Transaction-Mast');

			}
		}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Transaction Cannot be be Deleted...! Used In Another Transaction...!');
					return redirect('/Master/Setting/View-Transaction-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Profit Center Not Found...!');
			return redirect('/Master/Setting/View-Transaction-Mast');

    	}

	}


/*transaction master*/


/*CONFIG MASTER */


public function ConfigMaster(Request $request){

		$title        ='Add Config Master';
		
		$compName     = $request->session()->get('company_name');
		$splitComp    = explode('-',$compName);
		$compCode     = $splitComp[0];
		$fisYear      =  $request->session()->get('macc_year');
		$comp_code    = $request->old('comp_code');
		$tran_code    = $request->old('trans_code');
		$series_code  = $request->old('series_code');
		$series_name  = $request->old('series_name');
		$plant_code   = $request->old('plant_code');
		$plant_name   = $request->old('plant_name');
		$pfct_code    = $request->old('pfct_code');
		$pfct_name    = $request->old('pfct_name');
		$gl_code      = $request->old('gl_code');
		$gl_name      = $request->old('gl_name');
		$stock_flag   = $request->old('stock_flag');
		$post_code    = $request->old('post_code');
		$post_name    = $request->old('post_name');
		$config_block = $request->old('config_block');
		$rfhead1      = $request->old('rfhead1');
		$rfhead2      = $request->old('rfhead2');
		$rfhead3      = $request->old('rfhead3');
		$rfhead4      = $request->old('rfhead4');
		$rfhead5      = $request->old('rfhead5');
		$config_id    = $request->old('config_id');
		$trans_list_autopost = $request->old('trans_list_autopost');

    	$button='Save';
    	$action='/finance/form-mast-config-save';
		//print_r($compData['comp_list']);exit;
		$transData['trans_list'] = DB::table('MASTER_TRANSACTION')->get();

		$transData['post_list']    = DB::SELECT("SELECT * FROM `MASTER_GL` WHERE COMP_CODE IS NULL OR COMP_CODE='$compCode'");

		$transData['plant_list']    = DB::SELECT("SELECT * FROM `MASTER_PLANT` WHERE COMP_CODE IS NULL OR COMP_CODE='$compCode'");

		$transData['pfct_list']    = DB::SELECT("SELECT * FROM `MASTER_PFCT` WHERE COMP_CODE IS NULL OR COMP_CODE='$compCode'");

		

		

		//$userdata['series_list']  = DB::table('MASTER_CONFIG')->where('TRAN_CODE','T0')->get();

		//$transData['series_list']    = DB::SELECT("SELECT * FROM `MASTER_PFCT` WHERE COMP_CODE IS NULL OR COMP_CODE='$compCode'");

		$transData['gl_list']    = DB::SELECT("SELECT * FROM `MASTER_GL` WHERE (COMP_CODE IS NULL OR COMP_CODE='$compCode') AND  AUTOPOSTING='YES' ");

		$transData['approve_ind'] = DB::table('MASTER_APPROVE_IND')->get();

		$transData['help_series_list'] = DB::table('MASTER_CONFIG')->Orderby('SERIES_CODE', 'desc')->limit(5)->get();

		

		if(isset($compName)){

    	return view('admin.finance.master.setting.config_form',$transData+compact('title','compCode','tran_code','series_code','series_name','gl_code','gl_name','stock_flag','trans_list_autopost','post_code','post_name','config_block','config_id','button','action','plant_code','plant_name','pfct_code','pfct_name'));

    }else{

		return redirect('/useractivity');
	}

    }


    

    public function ConfigFormSave(Request $request){


		$gl_code   = $request->input('gl_code');
		$post_code = $request->input('post_code');

		// $plantCode = $request->input('plant_code');

		// $splitPlantCode  = explode('-',$plantCode);
		$plant_code = $request->input('plant_code');
		$plant_name = $request->input('plant_name');

		// $pfctCode = $request->input('pfct_code');

		// $splitPfctCode  = explode('-',$pfctCode);
		$pfct_code = $request->input('pfct_code');
		$pfct_name = $request->input('pfct_name');

		$compName 	= $request->session()->get('company_name');
		$splitCode  = explode('-',$compName);
		$compCode = $splitCode[0];

		 if($gl_code==$post_code){

			$rules['post_code']   = 'required';
		}

		$rules = [	
						'trans_code'  => 'required|max:2',
						'series_code' => 'required|max:6',
						'series_name' => 'required|max:40',
						'series_code' => ['required', 'string',Rule::unique('MASTER_CONFIG')->where(function ($query) use ($request) {
					    return $query->where('COMP_CODE', $request->comp_code)->where('TRAN_CODE', $request->trans_code)->where('SERIES_CODE', $request->series_code);
							})],
			    ];

    	$customMessages = [
	        'series_code.unique'=>'The Series Code has already been taken for this <u><b>comp code and tran code</b></u>.',
    	];

    	$this->validate($request, $rules, $customMessages);
		

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$explode = explode('-', $compName);

    	$com_code = $explode[0];
    	$com_name = $explode[1];

    	$fisYear 	=  $request->session()->get('macc_year');

    	/*$configData = DB::table('MASTER_CONFIG')->orderBy('id', 'DESC')->first();
    	if(!empty($configData)){

    		$getID= $configData->id;

    		$id=$getID+1;

    	}else{
    		$id=1;
    	}*/

		$data = array(
			"COMP_CODE"   => $com_code,
			"COMP_NAME"   => $com_name,
			"TRAN_CODE"   => $request->input('trans_code'),
			"TRAN_HEAD"   => $request->input('tranName'),
			"SERIES_CODE" => $request->input('series_code'),
			"SERIES_NAME" => $request->input('series_name'),
			"GL_CODE"     => $request->input('gl_code'),
			"GL_NAME"     => $request->input('gl_name'),
			"STOCK_FLAG"  => $request->input('stock_flag'),
			"PLANT_CODE"  => $plant_code,
			"PLANT_NAME"  => $plant_name,
			"PFCT_CODE"   => $pfct_code,
			"PFCT_NAME"   => $pfct_name,
			"POST_CODE"   => $request->input('post_code'),
			"POST_NAME"   => $request->input('post_name'),
			"RFHEAD1"     => $request->input('Rfhead1'),
			"RFHEAD2"     => $request->input('Rfhead2'),
			"RFHEAD3"     => $request->input('Rfhead3'),
			"RFHEAD4"     => $request->input('Rfhead4'),
			"RFHEAD5"     => $request->input('Rfhead5'),
			"CREATED_BY"  => $createdBy,
			
		);

		// echo '<pre>';print_r($data);exit();

		$saveData = DB::table('MASTER_CONFIG')->insert($data);

		$discriptn_page = "Master config insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		
		$userhead     = $request->input('userhead');
		$usersequance = $request->input('usersequance');
		$access_name  = $request->input('access_name');

	//	print_r($userhead[0]);exit;

	if($userhead[0]!=''){
		
		$count = count($userhead);
	//	print_r($count);exit;

		$saveData1 ='';

		if($count > 0){

			for ($i=0; $i < $count; $i++){ 

				$data1=array(

				"COMP_CODE"   => $com_code,
				"FY_CODE"     => $fisYear,
				"TRAN_CODE"   => $request->input('trans_code'),
				"SERIES_CODE" => $request->input('series_code'),
				'APPROVE_IND' => $userhead[$i],
				'LAVEL_NAME'  => $usersequance[$i],
				'ACCESS_NAME' => $access_name[$i],
				"CREATED_BY"  => $createdBy,

    			);
        	
        $saveData1 = DB::table('MASTER_CONFIG_APPROVE')->insert($data1);
				
			}

		}
	}else{
		
	}
		if ($saveData) {

			$request->session()->flash('alert-success', 'Config Was Successfully Added...!');
			return redirect('/Master/Setting/View-Config-Mast');

		} else {

			$request->session()->flash('alert-error', 'Config Can Not Added...!');
			return redirect('/Master/Setting/View-Config-Mast');

		}

	}

	public function ViewConfigMast(Request $request){

	$compName = $request->session()->get('company_name');

	if($request->ajax()) {

    	$title = 'View Config Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');
    	$slipComp = explode('-',$compName);
    	$compCode = $slipComp[0];

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){

    	/*$configData['config_list'] = DB::table('master_config')->orderBy('id','DESC')->get();*/

    	    $data = DB::table('MASTER_CONFIG')
    		->select('MASTER_CONFIG.*', 'MASTER_TRANSACTION.TRAN_CODE as transName','MASTER_GL.GL_CODE as glname')
           ->leftjoin('MASTER_TRANSACTION', 'MASTER_CONFIG.TRAN_CODE', '=', 'MASTER_TRANSACTION.TRAN_CODE')
           ->leftjoin('MASTER_GL', 'MASTER_CONFIG.GL_CODE', '=', 'MASTER_GL.GL_CODE')
           ->where('MASTER_CONFIG.COMP_CODE',$compCode)
           ->orderBy('MASTER_CONFIG.SERIES_CODE','DESC');
          

           // print_r($configData['config_list']);exit;
    	}
    	elseif ($userType=='superAdmin' || $userType=='user') {

    		/*$configData['config_list'] = DB::table('master_config')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->;*/

    		 
    	    $data = DB::table('MASTER_CONFIG')
    		->select('MASTER_CONFIG.*', 'MASTER_TRANSACTION.TRAN_CODE as transName','MASTER_GL.GL_CODE as glname')
           ->leftjoin('MASTER_TRANSACTION', 'MASTER_CONFIG.TRAN_CODE', '=', 'MASTER_TRANSACTION.TRAN_CODE')
           ->leftjoin('MASTER_GL', 'MASTER_CONFIG.GL_CODE', '=', 'MASTER_GL.GL_CODE')
           ->where('MASTER_CONFIG.COMP_CODE',$compCode)
           ->orderBy('MASTER_CONFIG.SERIES_CODE','DESC');
            
    	}
    	else{
    		$data='';
    	}


    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
    }
    	if(isset($compName)){
    	return view('admin.finance.master.setting.view_config');
    	}else{
		return redirect('/useractivity');
	}
    }


    public function EditConfigMast(Request $request,$compCd,$tranCd,$seriesCd){

		$title      = 'Edit Config Master';

		$comp_Code   = base64_decode($compCd);
		$transCode  = base64_decode($tranCd);
		$seriesCode = base64_decode($seriesCd);
		$compName   = $request->session()->get('company_name');
		$splitComp  = explode('-',$compName);
		$compCode   = $splitComp[0];

		$fisYear    =  $request->session()->get('macc_year');

    	if($comp_Code!='' && $transCode!='' && $seriesCode!=''){

			$dData  = DB::table('MASTER_CONFIG')->where('COMP_CODE', $comp_Code)->where('TRAN_CODE', $transCode)->where('SERIES_CODE', $seriesCode)->get()->first();

			$configData['compCode']     =$dData->COMP_CODE;
			$configData['tran_code']    =$dData->TRAN_CODE;
			$configData['series_code']  =$dData->SERIES_CODE;
			$configData['series_name']  =$dData->SERIES_NAME;
			$configData['gl_code']      =$dData->GL_CODE;
			$configData['gl_name']      =$dData->GL_NAME;
			$configData['stock_flag']   =$dData->STOCK_FLAG;
			$configData['plant_code']    =$dData->PLANT_CODE;
			$configData['plant_name']    =$dData->PLANT_NAME;
			$configData['pfct_code']    =$dData->PFCT_CODE;
			$configData['pfct_name']    =$dData->PFCT_NAME;
			$configData['post_code']    =$dData->POST_CODE;
			$configData['post_name']    =$dData->POST_NAME;
			$configData['rfhead1']      =$dData->RFHEAD1;
			$configData['rfhead2']      =$dData->RFHEAD2;
			$configData['rfhead3']      =$dData->RFHEAD3;
			$configData['rfhead4']      =$dData->RFHEAD4;
			$configData['rfhead5']      =$dData->RFHEAD5;
			
			$configData['config_block'] =$dData->CONFIG_BLOCK;
			$configData['config_id']    =$dData->SERIES_CODE;
			$button='Update';
			$action='/finance/form-mast-config-update';


			$tran_code  = $dData->TRAN_CODE;
			$series_code = $dData->SERIES_CODE;
			$post_code = $dData->POST_CODE;

			$configData['trans_list'] = DB::table('MASTER_TRANSACTION')->get();


			$configData['trans_list_autopost'] = DB::table('MASTER_TRANSACTION')->where('TRAN_CODE',$dData->TRAN_CODE)->where('AUTO_POSTCODE','YES')->get()->first();

		   $configData['post_list']    = DB::SELECT("SELECT * FROM `MASTER_GL` WHERE COMP_CODE IS NULL OR COMP_CODE='$compCode'");

			$configData['gl_list']    = DB::SELECT("SELECT * FROM `MASTER_GL` WHERE (COMP_CODE IS NULL OR COMP_CODE='$compCode') AND  AUTOPOSTING='YES' ");

			$configData['plant_list']    = DB::SELECT("SELECT * FROM `MASTER_PLANT` WHERE COMP_CODE IS NULL OR COMP_CODE='$compCode'");

		    $configData['pfct_list']    = DB::SELECT("SELECT * FROM `MASTER_PFCT` WHERE COMP_CODE IS NULL OR COMP_CODE='$compCode'");

		    $configData['approve_ind'] = DB::table('MASTER_APPROVE_IND')->get();

		     $configData['config_approve_data'] = DB::table('MASTER_CONFIG_APPROVE')->where('TRAN_CODE',$tran_code)->where('SERIES_CODE',$series_code)->get()->toArray();

		    // print_r($configData['config_approve_data']);exit;

			
			return view('admin.finance.master.setting.config_form', $configData+compact('title','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Config Not Found...!');
			return redirect('/Master/Setting/View-Config-Mast');
		}

    }


    public function ConfigFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'trans_code'  => 'required|max:2',
			'series_code' => 'required|max:11',
			'series_name' => 'required|max:40',
			

		]);

		$config_id   = $request->input('config_id');
		
		date_default_timezone_set('Asia/Kolkata');
		
		$updatedDate = date("Y-m-d H:i:s");
		
		
		$createdBy   = $request->session()->get('userid');
		
		$compName    = $request->session()->get('company_name');
		
		$explode     = explode('-', $compName);
		
		$com_code    = $explode[0];

		$tran_code    = $request->input('trans_code');
		$series_code  = $request->input('series_code');

        $plant_code = $request->input('plant_code');
		$plant_name = $request->input('plant_name');

		$pfct_code = $request->input('pfct_code');
		$pfct_name = $request->input('pfct_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"SERIES_NAME"      => $request->input('series_name'),
			"GL_CODE"          => $request->input('gl_code'),
			"GL_NAME"          => $request->input('gl_name'),
			"STOCK_FLAG"       => $request->input('stock_flag'),
			"PLANT_CODE"       => $plant_code,
			"PLANT_NAME"       => $plant_name,
			"PFCT_CODE"        => $pfct_code,
			"PFCT_NAME"        => $pfct_name,
			"POST_CODE"        => $request->input('post_code'),
			"POST_NAME"        => $request->input('post_name'),
			"RFHEAD1"          => $request->input('Rfhead1'),
			"RFHEAD2"          => $request->input('Rfhead2'),
			"RFHEAD3"          => $request->input('Rfhead3'),
			"RFHEAD4"          => $request->input('Rfhead4'),
			"RFHEAD5"          => $request->input('Rfhead5'),
			"RFHEAD5"          => $request->input('Rfhead5'),
			"CONFIG_BLOCK"     => $request->input('config_block'),
			"LAST_UPDATE_BY"   => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);
        //print_r($data);exit();
		
		$saveData = DB::table('MASTER_CONFIG')->where('COMP_CODE', $com_code)->where('TRAN_CODE', $tran_code)->where('SERIES_CODE', $config_id)->update($data);

		$discriptn_page = "Master config update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		$userhead     = $request->input('userhead');
		$usersequance = $request->input('usersequance');
		$access_name  = $request->input('access_name');

		$count = count($userhead);

		/*echo '<pre>';
			print_r($request->post());
			echo '<pre>';
exit;*/
		/*print_r($prdname);
		print_r($checkname);
		exit;*/

		$saveData1 ='';

		if($count > 0){

			 $delete = DB::table('MASTER_CONFIG_APPROVE')->where('COMP_CODE', $com_code)->where('TRAN_CODE',$tran_code)->where('SERIES_CODE',$series_code)->delete();

			for ($i=0; $i < $count; $i++){ 

				$data1=array(

				"COMP_CODE"   => $com_code,
				"FY_CODE"     => $fisYear,
				"TRAN_CODE"   => $request->input('trans_code'),
				"SERIES_CODE" => $request->input('series_code'),
				'APPROVE_IND' => $userhead[$i],
				'LAVEL_NAME'  => $usersequance[$i],
				'ACCESS_NAME' => $access_name[$i],
				"CREATED_BY"  => $createdBy,

    			);
        	
        $saveData1 = DB::table('MASTER_CONFIG_APPROVE')->insert($data1);
				
			}



				if ($saveData) {

					$request->session()->flash('alert-success', 'Config Was Successfully Updated...!');
					return redirect('/Master/Setting/View-Config-Mast');

				} else {

					$request->session()->flash('alert-error', 'Config Can Not Added...!');
					return redirect('/Master/Setting/View-Config-Mast');

				}
		}

	}

	public function DeleteConfig(Request $request){

			$configcode = $request->post('configId');
			$spliData   = explode('~',$configcode);
			$compCode   = $spliData[0];
			$tranCode   = $spliData[1];
			$seriesCode = $spliData[2];

    	if ($compCode!='' && $tranCode!='' && $seriesCode!='') {

    		try{

    		$Delete = DB::table('MASTER_CONFIG')->where('COMP_CODE', $compCode)->where('TRAN_CODE', $tranCode)->where('SERIES_CODE', $seriesCode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Config Was Deleted Successfully...!');
				return redirect('/Master/Setting/View-Config-Mast');

			} else {

				$request->session()->flash('alert-error', 'Config Can Not Deleted...!');
				return redirect('/Master/Setting/View-Config-Mast');

			}
		}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Config Cannot be be Deleted...! Used In Another Transaction...!');
					return redirect('/Master/Setting/View-Config-Mast');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Config Not Found...!');
			return redirect('/Master/Setting/View-Config-Mast');

    	}

	}

/*CONFIG MASTER */

/*approved index master*/

	public function ApproveIndMaster(Request $request){

		$title        = 'Add Approve';
		
		$compName     = $request->session()->get('company_name');
		$approve_code = $request->old('approve_code');
		$approve_name = $request->old('approve_name');
		$approve_id   = $request->old('approve_id');
		
		$button       ='Save';
		
		$action       ='/form-approve-ind-mast-save';
	
		if(isset($compName)){

	    	return view('admin.finance.master.setting.approve_ind_mast',compact('title','approve_code','approve_name','approve_id','action','button'));

	    }else{

			return redirect('/useractivity');
		}

	}

	public function SaveApproveIndMast(Request $request){

		$compName  = $request->session()->get('company_name');
		$splitName = explode('-',$compName);
		$compCode  = $splitName[0];
		$compName  = $splitName[1];
		$fisYear   =  $request->session()->get('macc_year');
		$createdBy = $request->session()->get('userid');

		$validate = $this->validate($request, [

				'approve_code'      => 'required|max:10|unique:MASTER_APPROVE_IND,approve_code',
				'approve_name'      => 'required|max:40',
		]);

		$data = array(

					"approve_code" =>  $request->input('approve_code'),
					"approve_name" =>  $request->input('approve_name'),
					"created_by"   =>  $request->session()->get('userid'),
					"comp_code"    =>  $compCode,
					"fy_code"      =>  $fisYear,	
					"created_by"   =>  $createdBy	
	    	);
              
		$saveData = DB::table('MASTER_APPROVE_IND')->insert($data);

		$discriptn_page = "Master approve ind insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Approve Was Successfully Added...!');
				return redirect('/Master/Setting/View-Approved-Ind-Mast');

			} else {

				$request->session()->flash('alert-error', 'Approve Can Not Added...!');
				return redirect('/Master/Setting/View-Approved-Ind-Mast');

			}

	}

	public function ViewApproveIndMast(Request $request){

		$compName = $request->session()->get('company_name');

	  if($request->ajax()){


	       $title = 'View Approve Master';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin'){

	    	//$data = DB::table('MASTER_APPROVE_IND')->where('fy_code', $fisYear)->orderBy('id','DESC');
	    	$data = DB::table('MASTER_APPROVE_IND')->get();

	    	}
			elseif ($userType=='superAdmin' || $userType=='user') {

	    		//$data = DB::table('MASTER_APPROVE_IND')->where('fy_code', $fisYear)->orderBy('id','DESC');
	    		$data = DB::table('MASTER_APPROVE_IND')->get();
	    	}
	    	else{
	    		$data ='';
	    	}

	    	return DataTables()->of($data)->addIndexColumn()->toJson();

	    }
		if(isset($compName)){
		   return view('admin.finance.master.setting.view_approve_ind_mast');	
		}else{
			return redirect('/useractivity');
	   	}

    }


    public function EditApproveIndMast($approveid){

    	$title = 'Edit Bank';

    	//print_r($id);
    	$approvecode = base64_decode($approveid);
    	//$btnControl = base64_decode($btnControl);

    	if($approvecode!=''){
    	    $query = DB::table('MASTER_APPROVE_IND');
			$query->where('id', $approvecode);
			$classData= $query->get()->first();
			
			$approve_code = $classData->approve_code;
			$approve_name = $classData->approve_name;
			$approve_id = $classData->id;

			$button='Update';
			$action='/form-approve-ind-mast-update';

			return view('admin.finance.master.setting.approve_ind_mast',compact('title','approve_code','approve_name','approve_id','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Approve Data Not Found...!');
			return redirect('/Master/Setting/View-Approved-Ind-Mast');
		}

    }


    public function UpdateApproveIndMast(Request $request){

		$validate = $this->validate($request, [

				'approve_code'      => 'required|max:10',
				'approve_name'      => 'required|max:40',
		]);

        $approvecode = $request->input('idapprov');
        $createdBy = $request->session()->get('userid');
         date_default_timezone_set('Asia/Kolkata');

		 $updatedDate = date("Y-m-d H:i:s");


		$data = array(
				"approve_code"    =>  $request->input('approve_code'),
				"approve_name"    =>  $request->input('approve_name'),
				"last_update_by"   =>  $createdBy,
				"last_update_date" =>  $updatedDate
	 
	    	);

			$saveData = DB::table('MASTER_APPROVE_IND')->where('id', $approvecode)->update($data);

			$discriptn_page = "Master approve ind update done by user";
			$this->userLogInsert($createdBy,$discriptn_page);
		try{
	


			if ($saveData) {

				$request->session()->flash('alert-success', 'Approve Index Data Was Successfully Updated...!');
				return redirect('/Master/Setting/View-Approved-Ind-Mast');

			} else {

				$request->session()->flash('alert-error', 'Approve Index Data Can Not Updated...!');
				return redirect('/Master/Setting/View-Approved-Ind-Mast');

			}
		}catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Approve Index Data be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Setting/View-Approved-Ind-Mast');
			}


	}

	public function DeleteApproveIndMast(Request $request){

        $approvecode = $request->input('approvid');
       // print_r($bankcode);exit;

        if ($approvecode!='') {

        	try{

			$Delete = DB::table('MASTER_APPROVE_IND')->where('id',$approvecode)->delete();

			if($Delete) {

			$request->session()->flash('alert-success', 'Approve Data Was Deleted Successfully...!');
			return redirect('/Master/Setting/View-Approved-Ind-Mast');

			} else {

			$request->session()->flash('alert-error', 'Approve Data Can Not Deleted...!');
			return redirect('/Master/Setting/View-Approved-Ind-Mast');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Approve Data be be Updated...! Used In Another Transaction...!');
					return redirect('/Master/Setting/View-Approved-Ind-Mast');
			}

		}else{

		$request->session()->flash('alert-error', 'Approve Data Not Found...!');
		return redirect('/Master/Setting/View-Approved-Ind-Mast');

		}
	}

/*approved index master*/



/*vrser master*/

	public function VrSequence(Request $request){

		$title        ='Add Vr Seq Master';

		$compName 	= $request->session()->get('company_name');

		$company_code = $request->old('company_code');
		$tran_code    = $request->old('tran_code');
		$series_code  = $request->old('series_code');
		$from_no      = $request->old('from_no');
		$to_no        = $request->old('to_no');
		$last_no      = $request->old('last_no');
		$vrseq_block  = $request->old('vrseq_block');
		$vrseq_id     = $request->old('vrseq_id');

		$button ='Save';
		$action ='/form-vr-sequence-save';
		
		$userdata['comp_list']  = DB::table('MASTER_COMP')->get();
		$userdata['pfct_list']  = DB::table('MASTER_PFCT')->get();
		$userdata['plant_list']  = DB::table('MASTER_PLANT')->get();

		$userdata['transaction_list'] = DB::table('MASTER_TRANSACTION')->get();

		

	if(isset($compName)){

    	return view('admin.finance.master.setting.vr_sequence_form',$userdata+compact('title','company_code','tran_code','series_code','from_no','to_no','last_no','vrseq_block','vrseq_id','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 


    public function VrSequenceSave(Request $request){

		$rules = [	
					'company_code' => 'required|max:6',
					'tran_code'    => 'required|max:2',
					'series_code'  => 'required|max:6',
					'from_no'      => 'required',
					'to_no'        => 'required',
					'last_no'      => 'required',
					'series_code'  => ['required', 'string',Rule::unique('MASTER_VRSEQ')->where(function ($query) use ($request) {
				    return $query->where('COMP_CODE', $request->company_code)->where('FY_CODE', $request->fy_code)->where('TRAN_CODE', $request->tran_code)->where('SERIES_CODE', $request->series_code);
						})],
		    ];

		$customMessages = [
		  'series_code.unique'=>'The Series Code has already been taken for this <b><u> Comp Code and fy code and trans code</u></b>',
		];

		$this->validate($request, $rules, $customMessages);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(

			"COMP_CODE"   => $request->input('company_code'),
			"FY_CODE"     => $request->input('fy_code'),
			"TRAN_CODE"   => $request->input('tran_code'),
			"SERIES_CODE" => $request->input('series_code'),
			"FROM_NO"     => $request->input('from_no'),
			"TO_NO"       => $request->input('to_no'),
			"LAST_NO"     => $request->input('last_no'),
			"CREATED_BY"  => $createdBy,
			
		);

		$saveData = DB::table('MASTER_VRSEQ')->insert($data);

		$discriptn_page = "Master vrseq insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Vr Sequence Was Successfully Added...!');
			return redirect('/Master/Setting/View-Vr-Sequence');

		} else {

			$request->session()->flash('alert-error', 'Vr Sequence Can Not Added...!');
			return redirect('/Master/Setting/View-Vr-Sequence');

		}

	}

	public function ViewVrSequence(Request $request){

	$comp_Name  = $request->session()->get('company_name');
	$splitCode = explode('-',$comp_Name);
	$compCode  = $splitCode[0];
	$compName  = $splitCode[1];
	$fisYear   =  $request->session()->get('macc_year');
	$userid    = $request->session()->get('userid');
	$userType  = $request->session()->get('usertype');
	$title     = 'View Vr Sequence Master';

		if($request->ajax()){

    		if($userType=='admin'){

    			$classData['cr_squnce'] = DB::table('MASTER_VRSEQ')->get();

				//dd(DB::getQueryLog());
		    	$data = DB::table('MASTER_VRSEQ')
		    	     ->select('MASTER_VRSEQ.*','MASTER_TRANSACTION.TRAN_HEAD','MASTER_CONFIG.SERIES_NAME','MASTER_COMP.COMP_NAME')
		    		->join('MASTER_COMP','MASTER_VRSEQ.COMP_CODE','=','MASTER_COMP.COMP_CODE')
		    		->join('MASTER_TRANSACTION','MASTER_VRSEQ.TRAN_CODE','=','MASTER_TRANSACTION.TRAN_CODE')
		    		->join('MASTER_CONFIG','MASTER_VRSEQ.SERIES_CODE','=','MASTER_CONFIG.SERIES_CODE')
		    		->where('MASTER_VRSEQ.COMP_CODE', $compCode)
		    		->where('MASTER_VRSEQ.FY_CODE', $fisYear);
    		
    		}else if ($userType=='superAdmin' || $userType=='user') {    		

	           $data = DB::table('MASTER_VRSEQ')
	    	     	->select('MASTER_VRSEQ.*','MASTER_TRANSACTION.TRAN_HEAD','MASTER_CONFIG.SERIES_NAME','MASTER_COMP.COMP_NAME')
		    		->join('MASTER_COMP','MASTER_VRSEQ.COMP_CODE','=','MASTER_COMP.COMP_CODE')
		    		->join('MASTER_TRANSACTION','MASTER_VRSEQ.TRAN_CODE','=','MASTER_TRANSACTION.TRAN_CODE')
		    		->join('MASTER_CONFIG','MASTER_VRSEQ.SERIES_CODE','=','MASTER_CONFIG.SERIES_CODE')
		    		->where('MASTER_VRSEQ.COMP_CODE', $compCode)
	    			->where('MASTER_VRSEQ.FY_CODE', $fisYear);
    	
    		}else{
    			$data ='';
    		}

    		return DataTables()->of($data)->addIndexColumn()->toJson();

    	}
    	if(isset($comp_Name)){
    		return view('admin.finance.master.setting.view_vr_sequnce');
    	}else{
			return redirect('/useractivity');
		}
 	}


    public function DeletevrSequence(Request $request){

		$vrseqId = $request->post('vrseqId');
    	

    	if ($vrseqId!='') {

				$spliVr   = explode('_',$vrseqId);
				$compCd   = $spliVr[0];
				$fyCd     = $spliVr[1];
				$tranCd   = $spliVr[2];
				$seriesCd = $spliVr[3];
    		
    		$Delete = DB::table('MASTER_VRSEQ')->where('COMP_CODE', $compCd)->where('FY_CODE', $fyCd)->where('TRAN_CODE', $tranCd)->where('SERIES_CODE', $seriesCd)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Vr Sequence Was Deleted Successfully...!');
				return redirect('/Master/Setting/View-Vr-Sequence');

			} else {

				$request->session()->flash('alert-error', 'Vr Sequence Can Not Deleted...!');
				return redirect('/Master/Setting/View-Vr-Sequence');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Vr Sequence  Not Found...!');
			return redirect('/Master/Setting/View-Vr-Sequence');

    	}

	}


	public function EditVrSequence($cmpcd,$fycd,$trnascd,$seriescd){

    	$title = 'Edit Vr Sequence Master';

    	//print_r($id);
			$COMP_CODE   = base64_decode($cmpcd);
			$FY_CODE     = base64_decode($fycd);
			$TRAN_CODE   = base64_decode($trnascd);
			$SERIES_CODE = base64_decode($seriescd);
   //$btnControl = base64_decode($btnControl);


    	if(($COMP_CODE!='') && ($FY_CODE!='') && ($TRAN_CODE!='') && ($SERIES_CODE!='')){
    	   $query = DB::table('MASTER_VRSEQ');
			$query->where('COMP_CODE', $COMP_CODE);
			$query->where('FY_CODE', $FY_CODE);
			$query->where('TRAN_CODE', $TRAN_CODE);
			$query->where('SERIES_CODE', $SERIES_CODE);
			$classData    = $query->get()->first();

			$company_code =	$classData->COMP_CODE;
			$tran_code    =	$classData->TRAN_CODE;
			$series_code  =	$classData->SERIES_CODE;
			$from_no      =	$classData->FROM_NO;
			$to_no        =	$classData->TO_NO;
			$last_no      =	$classData->LAST_NO;
			$vrseq_id     =	$classData->TRAN_CODE;
			$vrseq_block  =	$classData->VRSEQ_BLOCK;

			$button='Update';
			$action='/form-vr-sequence-update';

			$userdata['comp_list']        = DB::table('MASTER_COMP')->get();
			$userdata['pfct_list']        = DB::table('MASTER_PFCT')->get();
			$userdata['transaction_list'] = DB::table('MASTER_TRANSACTION')->get();
			$userdata['plant_list']  = DB::table('MASTER_PLANT')->get();

			return view('admin.finance.master.setting.vr_sequence_form',$userdata+compact('company_code','tran_code','series_code','from_no','to_no','last_no','vrseq_id','vrseq_block','title','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Vr Sequence Cash Not Found...!');
			return redirect('/Master/Setting/Vr-Sequence');
		}

    }



    public function VrSequenceUpdate(Request $request){

		$validate = $this->validate($request, [

			'company_code' => 'required|max:6',
			'tran_code'    => 'required|max:2',
			'series_code'  => 'required|max:6',
			'from_no'      => 'required',
			'to_no'        => 'required',
			'last_no'      => 'required',

		]);

		$vrSeq_id = $request->input('vrseqId');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");


			$createdBy   = $request->session()->get('userid');

			$compName    = $request->session()->get('company_name');

			$fisYear     =  $request->session()->get('macc_year');

			$compCD      = $request->input('company_code');
			$fyCd        = $request->input('fy_code');
			$trnaCd      = $request->input('tran_code');
			$seriesCd    = $request->input('series_code');
            
		$data = array(
			
			"FROM_NO"             => $request->input('from_no'),
			"TO_NO"               => $request->input('to_no'),
			"LAST_NO"             => $request->input('last_no'),
			"VRSEQ_BLOCK"         => $request->input('vrseq_block'),
			"LAST_UPDATE_BY"      => $createdBy,
			"LAST_UPDATE_DATE"    => $updatedDate,
			
		);
		//print_r($data);exit();

		$saveData = DB::table('MASTER_VRSEQ')->where('COMP_CODE', $compCD)->where('FY_CODE', $fyCd)->where('TRAN_CODE', $trnaCd)->where('SERIES_CODE', $seriesCd)->update($data);

		$discriptn_page = "Master vrseq update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Vr Sequence Was Successfully Updated...!');
			return redirect('/Master/Setting/View-Vr-Sequence');

		} else {

			$request->session()->flash('alert-error', 'Vr Sequence Can Not Added...!');
			return redirect('/Master/Setting/View-Vr-Sequence');

		}

	}



	public function NewVrSequence(Request $request){

		$title        ='Add Vr Seq Master';

		$compName 	= $request->session()->get('company_name');

		$company_code = $request->old('company_code');
		$tran_code    = $request->old('tran_code');
		$series_code  = $request->old('series_code');
		$from_no      = $request->old('from_no');
		$to_no        = $request->old('to_no');
		$last_no      = $request->old('last_no');
		$vrseq_block  = $request->old('vrseq_block');
		$vrseq_id     = $request->old('vrseq_id');

		$button ='Save';
		$action ='/form-vr-sequence-save';
		
		$userdata['comp_list']  = DB::table('MASTER_COMP')->get();
		$userdata['pfct_list']  = DB::table('MASTER_PFCT')->get();
		$userdata['plant_list']  = DB::table('MASTER_PLANT')->get();

		$userdata['transaction_list'] = DB::table('MASTER_TRANSACTION')->get();

		

	if(isset($compName)){

    	return view('admin.finance.master.setting.new_vr_sequence_form',$userdata+compact('title','company_code','tran_code','series_code','from_no','to_no','last_no','vrseq_block','vrseq_id','button','action'));

    }else{

		return redirect('/useractivity');
	}

    } 

/*vrser master*/

/* ----------- START : OFFLINE CHEQUE ISSUE MASTER ------------- */

	public function AddOfflineChequeIssue(Request $request){

		$title     ='Add Offline Cheque Issue Master';
		$macc_year = $request->session()->get('macc_year');
		$company   = $request->session()->get('company_name');
		$splitName = explode('-',$company);
		$compCode  = $splitName[0];
		$compName  = $splitName[1];
		$transCode ='A0';
		$userdata['party_list']  = DB::table('MASTER_ACC')->get();
		$userdata['series_list']  = DB::table('MASTER_CONFIG')->where('COMP_CODE',$compCode)->where('TRAN_CODE',$transCode)->get();

		$ConstructData = MyConstruct();
		$userdata['gl_list']       = $ConstructData['master_gl'];

		$getCommonData = MyCommonFun($transCode,$compCode,$macc_year);

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}
    	
    	if(isset($compName)){
        	return view('admin.finance.master.setting.add_offlineChequeIss',$userdata+compact('title','compCode','compName'));
     	}else{
      	return redirect('/useractivity');
    	}

	}

	public function SaveOfflineChequeIssue(Request $request){
	
		$macc_year       = $request->session()->get('macc_year');
		$company         = $request->session()->get('company_name');
		$splitName       = explode('-',$company);
		$compCode        = $splitName[0];
		$compName        = $splitName[1];
		$updateFieldName = $request->input('updatedataId');
		$cancle_chq = $request->input('cancle_chq');

		

		/*if($cancle_chq == 'NO'){

			$rules = [	
    				'gl_code' => 'required|max:6',
			    ];

			    $this->validate($request, $rules);
		}else{

			$validate = $this->validate($request, [

				'cheque_no'   => 'required|max:6',
				'series_code' => 'required|max:6',

			]);
		}*/

		

		$splitField      = explode('~',$updateFieldName);

		$chequeNo        = $splitField[0];
          
		$headID          = $splitField[1];

		$bodyID          = $splitField[2];
		$slNum           = $splitField[3];

		$data = array(

			'CHEQUEDATE'  => date("Y-m-d", strtotime($request->input('chequeDate'))),
			'GL_CODE'     => $request->input('gl_code'),
			'GL_NAME'     => $request->input('gl_name'),
			'ACC_CODE'    => $request->input('acc_code'),
			'ACC_NAME'    => $request->input('acc_name'),
			'AMOUNT'      => $request->input('amount'),
			'REMARK'      => $request->input('remark'),
			'CANCLE_FLAG' => $request->input('cancle_chq'),
		);

		$saveData = DB::table('MASTER_CHEQUEBOOK_BODY')->where('COMP_CODE',$compCode)->where('CHEQUENO',$chequeNo)->where('CHQBHID',$headID)->where('CHQBBID',$bodyID)->where('SLNO',$slNum)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Offline Cheque Issue Was Successfully Updated...!');
			return redirect('/Master/Setting/View-Vr-Sequence');

		} else {

			$request->session()->flash('alert-error', 'Offline Cheque Issue Can Not Added...!');
			return redirect('/Master/Setting/View-Vr-Sequence');

		}
	}

	public function ViewOfflineChequeIssue(Request $request){

    	if($request->ajax()) {

	    	$title = 'View Master chequebook';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	$exp = explode("-",$compName);

	    	$compcode =  $exp[0];


	    	if($userType=='admin'){

	         $data = DB::select("SELECT * FROM MASTER_CHEQUEBOOK_BODY WHERE COMP_CODE='$compcode'");
	         

			}else if($userType=='superAdmin' || $userType=='user'){

				$data = DB::select("SELECT * FROM MASTER_CHEQUEBOOK_BODY WHERE COMP_CODE='$compcode'");
				
			}else{

				$data='';
				
			}

			return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();
    		

   	}
   	return view('admin.finance.master.setting.view_OfflineChequeIss');
   }

/* ----------- END : OFFLINE CHEQUE ISSUE MASTER ------------- */

/* ----------- START : CHECK LEAF CONFIG MASTER ------------- */

	public function AddChqLeafConfig(Request $request){

		//DB::enableQueryLog();
		$chqLeafNo = DB::select("SELECT MAX(CHQLEAF_NO) as CHQLEAF_NO FROM MASTER_CHQLEAF_CONFIG");
		//dd(DB::getQueryLog());
		$DataChqLfNo = json_decode(json_encode($chqLeafNo), true);

		if(empty($DataChqLfNo[0]['CHQLEAF_NO'])){
			$leafNo = 'LEF01';
		}else{
			$numbers = preg_replace('/[^0-9]/', '', $DataChqLfNo[0]['CHQLEAF_NO']);
			$genNo = $numbers+1;
			$leafNo = 'LEF0'.$genNo;
		}
		$title    ='Add Chek Leaf Config Master';
		$compName = $request->session()->get('company_name');
		$transCode ='A0';
		$userdata['series_list']  = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$transCode)->get();
    	if(isset($compName)){
        	return view('admin.finance.master.setting.add_chqLeafConfig',$userdata+compact('title','leafNo'));
     	}else{
      	return redirect('/useractivity');
    	}

   }

   public function SaveChqLeafConfig(Request $request){

   	$userid	= $request->session()->get('userid');
		$date_rw   = $request->input('rwData');
		$date_col  = $request->input('ColData');
		$srno      = $request->input('srno');
		$fieldName = $request->input('fieldName');
		$getCount  = count($srno);
		$saveData='';
   	for($i=0;$i<$getCount;$i++){
   		
   		$data = array(

				'SERIES_CODE' =>$request->input('series'),
				'GL_CODE'     =>$request->input('gl_code'),
				'SL_NO'       =>$srno[$i],
				'CHQLEAF_NO'  =>$request->input('chqLeafNo'),
				'FIELD'       =>$fieldName[$i],
				'LEAFROW'     =>$date_rw[$i],
				'LEAFCOLUMN'  =>$date_col[$i],
				'CREATED_BY'  =>$userid,
   		);

   		$saveData = DB::table('MASTER_CHQLEAF_CONFIG')->insert($data);
   	}

   	if ($saveData) {

				$request->session()->flash('alert-success', 'Cheque Leaf Config Was Successfully Added...!');
				return redirect('/configration/Setting/view-cheque-leaf-config');

			} else {

				$request->session()->flash('alert-error', 'Cheque Leaf Config Can Not Added...!');
				return redirect('/configration/Setting/view-cheque-leaf-config');

			}

   }

   public function ViewChqLeafConfig(Request $request){

    	if($request->ajax()) {

	    	$title = 'View Master ChqLeaf Config';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	$exp = explode("-",$compName);

	    	$compcode =  $exp[0];


	    	if($userType=='admin'){

	         $data = DB::select("SELECT * FROM MASTER_CHQLEAF_CONFIG GROUP BY CHQLEAF_NO");
	         
			}else if($userType=='superAdmin' || $userType=='user'){

				$data = DB::select("SELECT * FROM MASTER_CHQLEAF_CONFIG GROUP BY CHQLEAF_NO");
				
			}else{

				$data='';
				
			}

			return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();
    		

   	}
   	return view('admin.finance.master.setting.view_chqLeafConfig');
   }

   public function ChequeLeafChieldRTowData(Request $request){

    $response_array = array();

      $leafNum = $request->input('leafNo');

      $compName = $request->session()->get('company_name');

      $exp = explode("-",$compName);

      $compcode =  $exp[0];

    if ($request->ajax()) {

        $chequebook_chield = DB::table("MASTER_CHQLEAF_CONFIG")->where('CHQLEAF_NO',$leafNum)->get();

        if ($chequebook_chield) {

          $response_array['response'] = 'success';
            $response_array['data'] = $chequebook_chield ;
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

   public function DeleteChqLeafConfig(Request $request){

   	$chqLeaf_no = $request->post('leafNum');
    	

    	if ($chqLeaf_no!='') {
    		
    		$Delete = DB::table('MASTER_CHQLEAF_CONFIG')->where('CHQLEAF_NO', $chqLeaf_no)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Cheque Leaf Config Deleted Successfully...!');
				return redirect('/configration/Setting/view-cheque-leaf-config');

			} else {

				$request->session()->flash('alert-error', 'Cheque Leaf Config Deleted Can Not Deleted...!');
				return redirect('/configration/Setting/view-cheque-leaf-config');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Plant Not Found...!');
			return redirect('/configration/Setting/view-cheque-leaf-config');

    	}

   }

   public function EditChqLeafConfig($leafNo){

    	$leaf_No = base64_decode($leafNo);
    	
    	if($leaf_No!=''){
    	   $query = DB::table('MASTER_CHQLEAF_CONFIG');
			$query->where('CHQLEAF_NO', $leaf_No);
			$plantData['leafNo_data'] = $query->get();

		   return view('admin.finance.master.setting.edit_chqLeafConfig',$plantData);
			
		}else{
			$request->session()->flash('alert-error', 'Cheque Leaf Config Not Found...!');
			return redirect('/configration/Setting/view-cheque-leaf-config');
		}
       
   }

   public function UpdateChqLeafConfig(Request $request){

   	$date_rw   = $request->input('rwData');
		$date_col  = $request->input('ColData');
		$srno      = $request->input('srno');
		$fieldName = $request->input('fieldName');
		$chqLeafNo = $request->input('chqLeafNo');
		$userid	= $request->session()->get('userid');
		$getCount  = count($srno);
		$saveData ='';
        date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

   	for($i=0;$i<$getCount;$i++){
   		
   		$data = array(
				'LEAFROW'     =>$date_rw[$i],
				'LEAFCOLUMN'  =>$date_col[$i],
				'LAST_UPDATE_BY'  =>$userid,
				'LAST_UPDATE_DATE'=>$updatedDate,
   		);
        //print_r($data);exit();
   		 $saveData = DB::table('MASTER_CHQLEAF_CONFIG')->where('SL_NO',$srno[$i])->where('CHQLEAF_NO',$chqLeafNo)->update($data);
   		//$saveData = DB::table('MASTER_CHQLEAF_CONFIG')->where('SL_NO',$srno[$i])->update($data);
   	}
   		
   	if ($saveData) {

			$request->session()->flash('alert-success', 'Cheque Leaf Config Was Successfully Added...!');
			return redirect('/configration/Setting/view-cheque-leaf-config');

		} else {

			$request->session()->flash('alert-error', 'Cheque Leaf Config Can Not Added...!');
			return redirect('/configration/Setting/view-cheque-leaf-config');

		}
   }

/* ----------- END :  CHECK LEAF CONFIG  MASTER ------------- */

/* -------------- START : CHEQUE PRINTING ----------------------- */

	public function AddChequePrint(Request $request){

		$title       = 'Add Master Cheque Print';

		$compName    = $request->session()->get('company_name');
		$splitCd     = explode('-', $compName);
		$getcompcode = $splitCd[0];
		$fisYear     = $request->session()->get('macc_year');
		$userData['series_list'] = DB::table('MASTER_CONFIG')->where('COMP_CODE',$getcompcode)->where('TRAN_CODE', 'A0')->get();
		
		if(isset($compName)){
	    	return view('admin.finance.master.setting.add_chequePrint',$userData+compact('title'));
	   }else{
			return redirect('/useractivity');
		}
	
	}

	public function printingCheque(Request $request,$bnf_name,$chqDate,$leafNo,$amount,$amtInWord,$updateChqNo){

		$splitData = explode('~',$updateChqNo);
		$userid	= $request->session()->get('userid');

		$BNFName = str_replace('_', ' ', $bnf_name);

		$chq_no  = $splitData[0];
		$head_id = $splitData[1];
		$body_id = $splitData[2];
		$slno    = $splitData[3];

		//print_r($splitData);exit;

		$dataUp = array(
			'BNF_NAME'       =>$BNFName,
			'PRINT_FLAG'     =>'1',
			'LAST_UPDATE_BY' =>$userid
		);

		DB::table('MASTER_CHEQUEBOOK_BODY')->where('CHEQUENO',$chq_no)->where('CHQBHID',$head_id)->where('CHQBBID',$body_id)->where('SLNO',$slno)->where('PRINT_FLAG','0')->update($dataUp);

		$title    = 'Add Printing cheque';
		$chqConf = DB::table('MASTER_CHQLEAF_CONFIG')->where('CHQLEAF_NO',$leafNo)->get();
        return view('admin.finance.master.setting.chequePrinting',compact('chqDate','amount','bnf_name','chqConf','amtInWord'));
	}

/* -------------- END : CHEQUE PRINTING ----------------------- */

/* ----------- START : CHEQUEBOOK MASTER ------------- */
  
  	public function AddChequebook(Request $request){

		$title     ='Add Chequebook Master';
		$macc_year     = $request->session()->get('macc_year');
		$company  = $request->session()->get('company_name');
		$splitName = explode('-',$company);
		$compCode  = $splitName[0];
		$compName  = $splitName[1];
    	$userdata['gl_list']  = DB::table('MASTER_GL')->get();
    	$userdata['series_list']  = DB::table('MASTER_CONFIG')->where('COMP_CODE',$compCode)->where('TRAN_CODE','A0')->get();
    	$transCode ='';

    	$getCommonData = MyCommonFun($transCode,$compCode,$macc_year);

		foreach ($getCommonData['getdate'] as $key) {

			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

    	if(isset($compName)){
        	return view('admin.finance.master.setting.add_chequebook',$userdata+compact('title','compCode','compName'));
     	}else{
      	return redirect('/useractivity');
    	}

   } 

   public function SaveChequeBookData(Request $request){

		$frChequeNo   = $request->input('from_cheque_no');
		$toChequeNo   = $request->input('to_cheque_no');
		$lastChequeNo = $request->input('last_cheque_no');
		$chequeBDate  = $request->input('chequeBDate');
		$cheque_Date  = date("Y-m-d", strtotime($chequeBDate));
		$createdBy    = $request->session()->get('userid');
		$chequeHid    = DB::select("SELECT MAX(CHQBHID) as CHQBHID FROM MASTER_CHEQUEBOOK_HEAD");
		$headID       = json_decode(json_encode($chequeHid), true); 
	
		if(empty($headID[0]['CHQBHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['CHQBHID']+1;
		}

		$fromNum = str_pad($frChequeNo,6,"0",STR_PAD_LEFT);
		$toNum   = str_pad($toChequeNo,6,"0",STR_PAD_LEFT);
		$lastNum = str_pad($lastChequeNo,6,"0",STR_PAD_LEFT);

		$validate = $this->validate($request, [

			'company_code'   => 'required|max:6',
			'gl_code'        => 'required|max:6',
			'series_code'    => 'required|max:6',
			'chequeBDate'    => 'required',
			'from_cheque_no' => 'required|max:6',
			'to_cheque_no'   => 'required|max:6',
			'last_cheque_no' => 'required|max:6',

		]);

		DB::beginTransaction();
		try {

	   	$headData = array(
				'CHQBHID'      => $head_Id,
				'COMP_CODE'    => $request->input('company_code'),
				'SERIES_CODE'  => $request->input('series_code'),
				'SERIES_NAME'  => $request->input('seriesName'),
				'GL_CODE'      => $request->input('gl_code'),
				'GL_NAME'      => $request->input('gl_name'),
				'CHQBKDATE'    => $cheque_Date,
				'FROMCHEQUENO' => $fromNum,
				'TOCHEQUENO'   => $toNum,
				'LASTCHEQUENO' => $lastNum,
				'CREATED_BY'   => $createdBy,
	   	);
   	
   		DB::table('MASTER_CHEQUEBOOK_HEAD')->insert($headData);

   		$slno=1;
	   	for($i=$frChequeNo; $i<=$toChequeNo; $i++){

	   		$chequeBid = DB::select("SELECT MAX(CHQBBID) as CHQBBID FROM MASTER_CHEQUEBOOK_BODY");
				$bodyID = json_decode(json_encode($chequeBid), true); 
		
				if(empty($bodyID[0]['CHQBBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['CHQBBID']+1;
				}

				$chequeNum = str_pad($i,6,"0",STR_PAD_LEFT);

					$bodyData = array(
					'CHQBHID'     => $head_Id,
					'CHQBBID'     => $body_Id,
					'COMP_CODE'   => $request->input('company_code'),
					'SERIES_CODE' => $request->input('series_code'),
					'SERIES_NAME' => $request->input('seriesName'),
					'SLNO'        => $slno,
					'CHEQUENO'    => $chequeNum,
					'CREATED_BY'  => $createdBy,
				);
				DB::table('MASTER_CHEQUEBOOK_BODY')->insert($bodyData);
				$slno++;
			}

			DB::commit();
			$request->session()->flash('alert-success', 'Chequebook Was Successfully Added...!');
			return redirect('/configration/Setting/view-chequeBook');

    	}catch (\Exception $e){

		    DB::rollBack();
		    //throw $e;
	    	$request->session()->flash('alert-error', 'Chequebook Can Not Added...!');
			return redirect('/configration/Setting/view-chequeBook');

		}
		

   }

   public function ViewChequeBook(Request $request){

    	if($request->ajax()) {

	    	$title = 'View Master chequebook';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');

	    	$compName = $request->session()->get('company_name');

	    	$fisYear =  $request->session()->get('macc_year');

	    	$exp = explode("-",$compName);

	    	$compcode =  $exp[0];


	    	if($userType=='admin'){

	         $data = DB::select("SELECT MASTER_CHEQUEBOOK_HEAD.*,MASTER_CHEQUEBOOK_BODY.CHQBHID as indHid,group_concat(concat(MASTER_CHEQUEBOOK_BODY.GL_CODE))AS CASHGLCD FROM MASTER_CHEQUEBOOK_HEAD LEFT JOIN MASTER_CHEQUEBOOK_BODY ON MASTER_CHEQUEBOOK_BODY.CHQBHID = MASTER_CHEQUEBOOK_HEAD.CHQBHID WHERE MASTER_CHEQUEBOOK_HEAD.COMP_CODE='$compcode' AND MASTER_CHEQUEBOOK_HEAD.CREATED_BY='$userid' GROUP BY MASTER_CHEQUEBOOK_HEAD.CHQBHID");
	         //$data = DB::table('MASTER_CHEQUEBOOK_HEAD')->where('CREATED_BY',$userid)->where('COMP_CODE',$compcode);

			}else if($userType=='superAdmin' || $userType=='user'){

				$data = DB::select("SELECT MASTER_CHEQUEBOOK_HEAD.*,MASTER_CHEQUEBOOK_BODY.CHQBHID as indHid,group_concat(concat(MASTER_CHEQUEBOOK_BODY.GL_CODE))AS CASHGLCD FROM MASTER_CHEQUEBOOK_HEAD LEFT JOIN MASTER_CHEQUEBOOK_BODY ON MASTER_CHEQUEBOOK_BODY.CHQBHID = MASTER_CHEQUEBOOK_HEAD.CHQBHID WHERE MASTER_CHEQUEBOOK_HEAD.COMP_CODE='$compcode' AND MASTER_CHEQUEBOOK_HEAD.CREATED_BY='$userid' GROUP BY MASTER_CHEQUEBOOK_HEAD.CHQBHID");
				
			}else{

				$data='';
				
			}

			return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();
    		

   	}
   	return view('admin.finance.master.setting.view_chequeBook');
   }

   public function ChequebookChieldRTowData(Request $request){

		$response_array = array();

    	$headId = $request->input('tblHeadId');

    	$compName = $request->session()->get('company_name');

    	$exp = explode("-",$compName);

    	$compcode =  $exp[0];

		if ($request->ajax()) {

	    	$chequebook_chield = DB::table("MASTER_CHEQUEBOOK_BODY")->where('CHQBHID',$headId)->where('COMP_CODE',$compcode)->get();

    		if ($chequebook_chield) {

    			$response_array['response'] = 'success';
            $response_array['data'] = $chequebook_chield ;
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

   public function EditChequebook(Request $request,$headid,$bodyid='',$slno=''){

		$head_id   = base64_decode($headid);
		$body_id   = base64_decode($bodyid);
		$sl_no     = base64_decode($slno);

		$title     ='Edit Chequebook Master';
		$macc_year = $request->session()->get('macc_year');
		$company   = $request->session()->get('company_name');
		$splitName = explode('-',$company);
		$compCode  = $splitName[0];
		$compName  = $splitName[1];

		$userdata['gl_list']  = DB::table('MASTER_GL')->get();
    	$userdata['series_list']  = DB::table('MASTER_CONFIG')->where('TRAN_CODE','A0')->get();
    	$transCode ='';

    	if($head_id!='' && $body_id=='NULL' && $sl_no=='NULL' ){
    		
    		$userdata['chequebook_list'] = DB::select("SELECT t1.*,t2.SLNO,t2.CHQBBID,t2.CHEQUENO,t2.CHEQUEDATE,t2.GL_CODE as glCode,t2.GL_NAME as glName,t2.ACC_CODE,t2.ACC_NAME,t2.AMOUNT,t2.REMARK,'ALL' as dataFl FROM MASTER_CHEQUEBOOK_HEAD t1 LEFT JOIN MASTER_CHEQUEBOOK_BODY t2 ON t2.CHQBHID = t1.CHQBHID WHERE t1.CHQBHID='$head_id'");
    		
    		return view('admin.finance.master.setting.edit_chequeBook', $userdata+compact('title','compCode','compName')); 
    	}else if($head_id!='' && $body_id!='' && $sl_no!=''){
    		
    		$userdata['chequebook_list'] = DB::select("SELECT t1.*,t2.SLNO,t2.CHQBBID,t2.CHEQUENO,t2.CHEQUEDATE,t2.GL_CODE as glCode,t2.GL_NAME as glName,t2.ACC_CODE,t2.ACC_NAME,t2.AMOUNT,t2.REMARK,'ONE' as dataFl FROM MASTER_CHEQUEBOOK_HEAD t1 LEFT JOIN MASTER_CHEQUEBOOK_BODY t2 ON t2.CHQBHID = t1.CHQBHID WHERE t1.CHQBHID='$head_id' AND t2.CHQBBID='$body_id' AND t2.SLNO='$sl_no'");
    		return view('admin.finance.master.setting.edit_chequeBook', $userdata+compact('title','compCode','compName'));
    	}else{
    		$request->session()->flash('alert-error', 'Chequebook Not Found...!');
			return redirect('/configration/Setting/view-chequeBook');
    	}
   }

   public function UpdateChequebook(Request $request){

		$tblhead_id = $request->input('headID');
		$tblBody_id = $request->input('bodyID');
		$tblSlno    = $request->input('slNum');
		$checkField = $request->input('checkField');

		if($checkField == 'ALL'){

		}else if($checkField == 'ONE'){

			$data = array(

					'CHEQUENO'   =>$request->input('cheque_No'),
					'CHEQUEDATE' =>$request->input('cheque_Date'),
					'GL_CODE'    =>$request->input('gl_code'),
					'GL_NAME'    =>$request->input('gl_name'),
					'ACC_CODE'   =>$request->input('acc_code'),
					'ACC_NAME'   =>$request->input('acc_name'),
					'AMOUNT'     =>$request->input('amount'),
					'REMARK'     =>$request->input('remark'),
			);

			$updateData = DB::table('MASTER_CHEQUEBOOK_BODY')->where('CHQBHID',$tblhead_id)->where('CHQBBID',$tblBody_id)->where('SLNO',$tblSlno)->update($data);

			if ($updateData) {

				$request->session()->flash('alert-success', 'Chequebook Was Successfully Added...!');
			      return redirect('/configration/Setting/view-chequeBook');


				// $request->session()->flash('alert-success', 'Chequebook Was Successfully Added...!');
				// return redirect('/configration/Setting/view-chequeBook');

			}else{

				$request->session()->flash('alert-error', 'Chequebook Can Not Added...!');
				return redirect('/configration/Setting/view-chequeBook');

			}

		}
		
   }

   public function DeleteChequebook(Request $request){

		$head_id = $request->post('headID');
		$body_id = $request->post('bodyID');
		$sl_num = $request->post('slNum');
    	
		if(($head_id!='') && ($body_id=='ALL')  && ($sl_num=='ALL')){

			$DeleteHead = DB::table('MASTER_CHEQUEBOOK_HEAD')->where('CHQBHID', $head_id)->delete();
			$DeleteBody = DB::table('MASTER_CHEQUEBOOK_BODY')->where('CHQBHID', $head_id)->delete();

			if($DeleteHead && $DeleteBody){

				$request->session()->flash('alert-success', ' Chequebook Was Deleted Successfully...!');
				return redirect('/configration/Setting/view-chequeBook');

			}else{

				$request->session()->flash('alert-error', 'Chequebook Can Not Deleted...!');
				return redirect('/configration/Setting/view-chequeBook');

			}

		}else if ($head_id!='' && $body_id!='' && $sl_num!='') {
    		
    		$Delete = DB::table('MASTER_CHEQUEBOOK_BODY')->where('CHQBHID', $head_id)->where('CHQBBID', $body_id)->where('SLNO', $sl_num)->delete();

			if($Delete){

				$request->session()->flash('alert-success', ' Chequebook Was Deleted Successfully...!');
				return redirect('/configration/Setting/view-chequeBook');

			}else{

				$request->session()->flash('alert-error', 'Chequebook Can Not Deleted...!');
				return redirect('/configration/Setting/view-chequeBook');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Chequebook Not Found...!');
			return redirect('/configration/Setting/view-chequeBook');

    	}

	}

/* ----------- END : CHEQUEBOOK MASTER ------------- */

	public function PlantMast(Request $request){

		$title        ='Add Config Master';
		
		$compName     = $request->session()->get('company_name');
		
		$tran_code    = $request->old('trans_code');
		$series_code  = $request->old('series_code');
		$series_name  = $request->old('series_name');
		$gl_code      = $request->old('gl_code');
		$config_block = $request->old('config_block');
		$rfhead1      = $request->old('rfhead1');
		$rfhead2      = $request->old('rfhead2');
		$rfhead3      = $request->old('rfhead3');
		$rfhead4      = $request->old('rfhead4');
		$rfhead5      = $request->old('rfhead5');
		$config_id    = $request->old('config_id');

		$transData['plant_code_list'] = DB::table('MASTER_PLANT')->Orderby('PLANT_CODE', 'desc')->limit(5)->get();
		$transData['city_lists']         = DB::table('MASTER_CITY')->get();


    	$button='Save';
		//print_r($compData['comp_list']);exit;
		$transData['comp_list'] = DB::table('MASTER_COMP')->get();
		$transData['state_list'] = DB::table('MASTER_STATE')->get();

		

	if(isset($compName)){

    	return view('admin.finance.master.setting.plant_form',$transData+compact('title','tran_code','series_code','series_name','gl_code','config_block','config_id','button'));

    }else{

		return redirect('/useractivity');
	}


    }


 public function PlantFormSave(Request $request){


 	    $validate = $this->validate($request, [
 
			'comp_code'   => 'required',
			'profit_code' => 'required',
			'plant_code'  => 'required',
			'plant_name'  => 'required',
			'email_id'    => 'required|email|max:40',
			'city'        => 'required',
			'district'    => 'required',
			'state'       => 'required',
			'country'     => 'required',
			'pincode'     => 'required',
			'plantCat'    => 'required',
				
		
		]);

 	
    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');
    	//print_r($request->post());exit;

    	$cityCd      = $request->input('city');
		$splicity    = explode('[',$cityCd);

		$distCd      = $request->input('district');
		$splidist    = explode('[',$distCd);

		$stateCd     = $request->input('state');
		$splistate   = explode('[',$stateCd);

		$countryCd   = $request->input('country');
		$splicountry = explode('[',$countryCd);

		$plantcode = $request->input('profit_code');
		$plantCode = '';
		if($plantcode){
			$genspitecode = explode('[',$plantcode);
		    $plantCode = $genspitecode[0];
		}
		

		$data = array(
			
			"PLANT_CODE"    => $request->input('plant_code'),
			"PLANT_NAME"    => $request->input('plant_name'),
			"COMP_CODE"     => $request->input('comp_code'),
			"COMP_NAME"     => $request->input('compName'),
			"PFCT_CODE"     => $plantCode,
			"ADD1"          => $request->input('address1'),
			"ADD2"          => $request->input('address2'),
			"ADD3"          => $request->input('address3'),
			"PHONE1"        => $request->input('phone1'),
			"PHONE2"        => $request->input('phone2'),
			"FAX"           => $request->input('fax'),
			"EMAIL"         => $request->input('email_id'),
			"CITY_CODE"     => $splicity[0],
			"CITY_NAME"     => substr($splicity[1], 0, -1),
			"DIST_CODE"     => $splidist[0],
			"DIST_NAME"     => substr($splidist[1], 0, -1),
			"STATE_CODE"    => $splistate[0],
			"STATE_NAME"    => substr($splistate[1], 0, -1),
			"COUNTRY_CODE"  => $splicountry[0],
			"COUNTRY_NAME"  => substr($splicountry[1], 0, -1),
			"PIN_CODE"      => $request->input('pincode'),
			"PLANT_CATEGORY"=> $request->input('plantCat'),
			"TAN_NO"        => $request->input('tan_no'),
			"TIN_NO"        => $request->input('tin_no'),
			"CIN_NO"        => $request->input('cin_no'),
			"PAN_NO"        => $request->input('pan_no'),
			"GST_NO"        => $request->input('gst_no'),
			"ESIC_NO"       => $request->input('esic_no'),
			"EPFO_NO"       => $request->input('epfo_no'),
			"SALES_TAXNO"   => $request->input('sale_tax_no'),
			"CSALES_TAXNO"  => $request->input('csale_tax_no'),
			"SERVICE_TAXNO" => $request->input('service_tax_no'),
			"ECC_NO"        => $request->input('ecc_no'),
			"RANGE_NO"      => $request->input('range_no'),
			"RANGE_NAME"    => $request->input('range_name'),
			"RANGE_ADD1"    => $request->input('range_addres1'),
			"RANGE_ADD2"    => $request->input('range_addres2'),
			"DIVISION"      => $request->input('division'),
			"COLLECTOR"     => $request->input('collector'),
			"CREATED_BY"    => $createdBy,
			
		);

		// echo '<PRE>';print_r($data);exit();

		$saveData = DB::table('MASTER_PLANT')->insert($data);

		$discriptn_page = "Master plant insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		 if ($saveData) {

				$request->session()->flash('alert-success', 'Plant Code Was Successfully Added...!');
				return redirect('/Master/Setting/View-Plant_Mast');

			} else {

				$request->session()->flash('alert-error', 'Plant Code Can Not Added...!');
				return redirect('/Master/Setting/View-Plant_Mast');

			}

	}

	public function PlantFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'comp_code'   => 'required',
			'profit_code' => 'required',
			'plant_code'  => 'required',
			'plant_name'  => 'required',
			'email_id'    => 'required|email|max:40',
			'city'        => 'required',
			'district'    => 'required',
			'state'       => 'required',
			'country'     => 'required',
			'pincode'     => 'required',
			'plantCat'    => 'required',
				
		
		]);



    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$compCode   = $request->input('comp_code');
		$profitCode = $request->input('profit_code');
		$PlantCode  = $request->input('plant_code');

    	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");

		$cityCd      = $request->input('city');
		$splicity    = explode('[',$cityCd);

		$distCd      = $request->input('district');
		$splidist    = explode('[',$distCd);

		$stateCd     = $request->input('state');
		$splistate   = explode('[',$stateCd);

		$countryCd   = $request->input('country');
		$splicountry = explode('[',$countryCd);

		$data = array(
		
			"PLANT_NAME"     => $request->input('plant_name'),
			"ADD1"           => $request->input('address1'),
			"ADD2"           => $request->input('address2'),
			"ADD3"           => $request->input('address3'),
			"PHONE1"         => $request->input('phone1'),
			"PHONE2"         => $request->input('phone2'),
			"FAX"            => $request->input('fax'),
			"EMAIL"          => $request->input('email_id'),
			"CITY_CODE"      => $splicity[0],
			"CITY_NAME"      => substr($splicity[1], 0, -1),
			"DIST_CODE"      => $splidist[0],
			"DIST_NAME"      => substr($splidist[1], 0, -1),
			"STATE_CODE"     => $splistate[0],
			"STATE_NAME"     => substr($splistate[1], 0, -1),
			"COUNTRY_CODE"   => $splicountry[0],
			"COUNTRY_NAME"   => substr($splicountry[1], 0, -1),
			"PIN_CODE"       => $request->input('pincode'),
			"PLANT_CATEGORY" => $request->input('plantCat'),
			"TAN_NO"         => $request->input('tan_no'),
			"TIN_NO"         => $request->input('tin_no'),
			"CIN_NO"         => $request->input('cin_no'),
			"PAN_NO"         => $request->input('pan_no'),
			"GST_NO"         => $request->input('gst_no'),
			"ESIC_NO"        => $request->input('esic_no'),
			"EPFO_NO"        => $request->input('epfo_no'),
			"SALES_TAXNO"    => $request->input('sale_tax_no'),
			"CSALES_TAXNO"   => $request->input('csale_tax_no'),
			"SERVICE_TAXNO"  => $request->input('service_tax_no'),
			"ECC_NO"         => $request->input('ecc_no'),
			"RANGE_NO"       => $request->input('range_no'),
			"RANGE_NAME"     => $request->input('range_name'),
			"RANGE_ADD1"     => $request->input('range_addres1'),
			"RANGE_ADD2"     => $request->input('range_addres2'),
			"DIVISION"       => $request->input('division'),
			"COLLECTOR"      => $request->input('collector'),
			"LAST_UPDATE_BY" => $createdBy,
			"LAST_UPDATE_DATE" => $updatedDate,
			
		);

		// print_r($data);exit();
		$saveData = DB::table('MASTER_PLANT')->where('COMP_CODE',$compCode)->where('PFCT_CODE',$profitCode)->where('PLANT_CODE',$PlantCode)->update($data);
		
		$discriptn_page = "Master plant update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		 if($saveData) {

				$request->session()->flash('alert-success', 'Plant Code Was Successfully Updated...!');
				return redirect('/Master/Setting/View-Plant_Mast');

			} else {

				$request->session()->flash('alert-error', 'Plant Code Can Not Updated...!');
				return redirect('/Master/Setting/View-Plant_Mast');

			}

	}


	public function PlantFormSave2(Request $request){


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	
    	$lastid = $request->input('lastid');


    		
		$data1 = array(
	
			"tan_no"        => $request->input('tan_no'),
			"tin_no"        => $request->input('tin_no'),
			"cin_no"        => $request->input('cin_no'),
			"pan_no"        => $request->input('pan_no'),
			"gst_no"        => $request->input('gst_no'),
			"esic_no"       => $request->input('esic_no'),
			"epfo_no"       => $request->input('epfo_no'),
			"sales_taxno"   => $request->input('sale_tax_no'),
			"csales_taxno"  => $request->input('csale_tax_no'),
			"service_taxno" => $request->input('service_tax_no'),
			"updated_by"    => $createdBy,
			"updated_date"  => $updatedDate,
			
		);

		$saveData = DB::table('master_plant')->where('id', $lastid)->update($data1);

		 if($saveData){

		  				$data2['message'] = 'Success';
		  				$data2['id'] = $lastid;
		  				$getalldata = json_encode($data2);  
		  				print_r($getalldata);

					}else{

						$data2['message'] = 'Error';
		  				$getalldata = json_encode($data2);  
		  				print_r($getalldata);

			}

	}


	public function PlantFormSave3(Request $request){

    	$createdBy 	= $request->session()->get('userid');

    	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$lastid1 = $request->input('lastid1');

    	
    		
		$data1 = array(
	
			"ecc_no"       => $request->input('ecc_no'),
			"range_no"     => $request->input('range_no'),
			"range_name"   => $request->input('range_name'),
			"range_add1"   => $request->input('range_addres1'),
			"range_add2"   => $request->input('range_addres2'),
			"division"     => $request->input('division'),
			"collector"    => $request->input('collector'),
			"updated_by"   => $createdBy,
			
			
		);
		

		$saveData = DB::table('master_plant')->where('id', $lastid1)->update($data1);

		 if($saveData){

		  				$data2['message'] = 'Success';
		  				
		  				$getalldata = json_encode($data2);  
		  				print_r($getalldata);

					}else{

						$data2['message'] = 'Error';
		  				$getalldata = json_encode($data2);  
		  				print_r($getalldata);

			}

	}



	public function ViewPlantMast(Request $request){

 	$CompanyCode   = $request->session()->get('company_name');

    	if ($request->ajax()) {

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');
		$splitComp = explode('-',$CompanyCode);
		$comp_code = $splitComp[0];

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    
       	/* $data = DB::table('master_tax_rate')->get();*/

       	 // $data = DB::table('MASTER_PLANT')
         //    ->join('MASTER_STATE', 'MASTER_PLANT.STATE_CODE', '=', 'MASTER_STATE.STATE_CODE')
         //    ->select('MASTER_PLANT.*', 'MASTER_STATE.STATE_NAME')
         //    ->where('MASTER_PLANT.COMP_CODE',$comp_code)
         //    ->get();

       	 $data = DB::table('MASTER_PLANT')
            ->join('MASTER_STATE', 'MASTER_PLANT.STATE_CODE', '=', 'MASTER_STATE.STATE_CODE')
            ->select('MASTER_PLANT.*', 'MASTER_STATE.STATE_NAME')
            ->get();

          
    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	  $data = DB::table('MASTER_PLANT')
            ->join('MASTER_STATE', 'MASTER_PLANT.STATE_CODE', '=', 'MASTER_STATE.STATE_CODE')
            ->select('MASTER_PLANT.*', 'MASTER_STATE.STATE_NAME')
            ->get();

    	}else{
    		
    	 $data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<a href="'.url('/Master/Setting/Edit-Plant_Mast/'.base64_encode($data->COMP_CODE).'/'.base64_encode($data->PFCT_CODE).'/'.base64_encode($data->PLANT_CODE)).'" class="btn btn-warning btn-xs allBtnStyle"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button"  class="btn btn-danger btn-xs allBtnStyle" onclick="return deletePlant(\''.$data->COMP_CODE.'\',\''.$data->PFCT_CODE.'\',\''.$data->PLANT_CODE.'\')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View Tax';
       if(isset($CompanyCode)){
       return view('admin.finance.master.setting.view_plant',compact('title'));

       }else{
		 return redirect('/useractivity');
	   }
    }

    public function PlantMasterChieldRTowData(Request $request){

    	$response_array = array();

		$comp_code  = $request->input('compCode');
		$pfct_code  = $request->input('pftcCode');
		$plant_code = $request->input('plantCode');

		if ($request->ajax()) {

	    	$basic_details = DB::table("MASTER_PLANT")->where('COMP_CODE',$comp_code)->where('PFCT_CODE',$pfct_code)->where('PLANT_CODE',$plant_code)->get()->first();
	    	
    		if ($basic_details) {

    			$response_array['response'] = 'success';
	         $response_array['data'] = $basic_details ;
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


   public function EditPlantMast($compcd,$pfctcd,$plantcd){

		$compCode  = base64_decode($compcd);
		$pfctCode  = base64_decode($pfctcd);
		$plantCode = base64_decode($plantcd);
    	
    	if($compCode!='' && $pfctCode!='' && $plantCode!=''){

    	   $query = DB::table('MASTER_PLANT');
			$query->where('COMP_CODE', $compCode);
			$query->where('PFCT_CODE', $pfctCode);
			$query->where('PLANT_CODE', $plantCode);
			$plantData['plant_data'] = $query->get()->first();

			$plantData['comp_list'] = DB::table('MASTER_COMP')->get();
			$plantData['state_list'] = DB::table('MASTER_STATE')->get();
			$plantData['city_lists']         = DB::table('MASTER_CITY')->get();

		    return view('admin.finance.master.setting.edit_plant_form',$plantData);
			
		}else{
			$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('/Master/Setting/View-Plant_Mast');
		}


       
    }

    public function DeletePlant(Request $request){

		$plantID    = $request->post('PlantID');
		$hiddnField = explode('~',$plantID);
		$compCode   = $hiddnField[0];
		$pfctCode   = $hiddnField[1];
		$plantCode  = $hiddnField[2];

    	if ($compCode!='' && $pfctCode!='' && $plantCode!='') {
    		
    		$Delete = DB::table('MASTER_PLANT')->where('COMP_CODE', $compCode)->where('PFCT_CODE', $pfctCode)->where('PLANT_CODE', $plantCode)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Plant Was Deleted Successfully...!');
				return redirect('/Master/Setting/View-Plant_Mast');

			} else {

				$request->session()->flash('alert-error', 'Plant Can Not Deleted...!');
				return redirect('/Master/Setting/View-Plant_Mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Plant Not Found...!');
			return redirect('/Configration/Setting/View-Plant_Mast');

    	}

	}


	public function plant_msg(Request $request,$saveData){

		if ($saveData) {

			$request->session()->flash('alert-success', 'Plant Was Successfully Added...!');
			return redirect('/Configration/Setting/View-Plant_Mast');

		} else {

			$request->session()->flash('alert-error', 'Plant Can Not Added...!');
			return redirect('/Configration/Setting/View-Plant_Mast');

		}
	}

public function plant_msg_update(Request $request,$updateData){

	 //	print_r($savedata);exit;

	if ($updateData) {

			$request->session()->flash('alert-success', 'Plant Was Successfully Updated...!');
			return redirect('/Configration/Setting/View-Plant_Mast');

		} else {

			$request->session()->flash('alert-error', 'Plant Can Not Updated...!');
			return redirect('/Configration/Setting/View-Plant_Mast');

		}
}


/*search Plant code when click on help button*/
	
	public function HelpPlantCode_Get(Request $request){

		$response_array = array();

	    $PlantCodeHelp = $request->input('PlantCodeHelp');

		if ($request->ajax()) {

	    	$palntcode_by_help = DB::select("SELECT * FROM `MASTER_PLANT` WHERE PLANT_CODE='$PlantCodeHelp' OR PLANT_NAME='$PlantCodeHelp' OR PLANT_CODE Like '$PlantCodeHelp%' OR PLANT_NAME LIKE '$PlantCodeHelp%' ORDER BY PLANT_CODE DESC limit 5  ");
	    	
    		if ($palntcode_by_help) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $palntcode_by_help ;

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

/*search Plant code when click on help button*/

/*search Plant on input*/

	public function search_PlantCodeF(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$plantcode = $request->input('plant_code');
			$compcode  = $request->input('comp_code');
			$pfctcode  = $request->input('pfct_code');

	    	$existpl_list = DB::select("SELECT * FROM `MASTER_PLANT` WHERE PLANT_CODE='$plantcode' AND COMP_CODE='$compcode' AND PFCT_CODE='$pfctcode' ");
	    	$plant_list = DB::select("SELECT * FROM `MASTER_PLANT` WHERE PLANT_CODE LIKE '$plantcode%'");

	    	$count = count($plant_list);

    		if ($count >=1 || $existpl_list) {

					$response_array['response']     = 'success';
					$response_array['data']         = $plant_list;
					$response_array['existpl_data'] = $existpl_list;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

					$response_array['response'] = 'error';
               $response_array['data'] = '' ;
               $response_array['existpl_data'] = '';
               $data = json_encode($response_array);
               print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
          	$response_array['data'] = '' ;
          	$response_array['existpl_data'] = '';
          	$data = json_encode($response_array);
          	print_r($data);
	    }

    }

/*search Plant on input*/

/*User Master*/

	public function UserForm(Request $request){

     	$title = 'Add Master User';

     	$compName   = $request->session()->get('company_name');
    
	   $fisYear  =  $request->session()->get('macc_year');

	   $getcomcode    = explode('-', $compName);
		
		$comp_code = $getcomcode[0];
    	 
    	$userData['approve_ind'] = DB::table('MASTER_APPROVE_IND')->get();
    	$userData['profile_list'] = DB::table('USER_RIGHTFORM')->groupBy('PROFILE_CODE')->orderBy('ID','DESC')->get();
    	$userData['acc_code'] = DB::table('MASTER_ACC')->get();
    	$userData['empList'] = DB::table('MASTER_EMP')->where('COMP_CODE',$comp_code)->get();

		//DB::enableQueryLog();

    	$userData['copy_userList'] = DB::table('MASTER_USER')
		            ->join('MASTER_USERRIGHT', 'MASTER_USER.USER_CODE', '=', 'MASTER_USERRIGHT.USER_CODE')
		            ->join('USER_APPROVE_IND', 'MASTER_USER.USER_CODE', '=', 'USER_APPROVE_IND.USER_CODE')
		            ->select('MASTER_USER.*', 'MASTER_USERRIGHT.PROFILE_CODE AS PROFILECODE','USER_APPROVE_IND.APPROVE_USER AS APPRVUSR')
		            ->groupBy('MASTER_USER.USER_CODE')
		            ->orderBy('MASTER_USER.USER_CODE')
		            ->get()->toArray();

		//dd(DB::getQueryLog());

	
    	return view('admin.finance.master.setting.user_form',$userData+compact('title'));
    }


    public function ApproveUsrDetails(Request $request){

    	if ($request->ajax()) {

    		$getID = $request->input('getID');
    		$usrId = $request->input('usrId');

    		$getAppData = DB::table('USER_APPROVE_IND')->where('USER_CODE',$usrId)->get();


    		if ($getAppData) {

    			$response_array['response'] = 'success';
    			$response_array['message'] = 'success';
	         $response_array['data'] = $getAppData ;

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


    	}


    }


    public function UsrProfileDetails(Request $request){

    	if ($request->ajax()) {

    		$getID = $request->input('getID');
    		$usrId = $request->input('usrId');

    		$getProfData = DB::table('MASTER_USERRIGHT')->where('USER_CODE',$usrId)->get();


    		if ($getProfData) {

    			$response_array['response'] = 'success';
    			$response_array['message'] = 'success';
	         $response_array['data'] = $getProfData ;

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


    	}

    }

    public function CopyUserDetails(Request $request){

    	if ($request->ajax()) {

    		$userCopy = $request->input('userCopy');

    		$exp = explode('_',$userCopy);

    		$uCode = $exp[0];
    		$uName = $exp[1];
    		$uType = $exp[2];
    		
    		//DB::enableQueryLog();
			$copy_user = DB::table('MASTER_USER')->select('USER_CODE','USER_NAME','ACC_CODE','ACC_NAME','PASSWORD','DEVICE_ID','FCM_TOKEN','EMAIL_ID','USER_TYPE','APPROVE_USER','ZONE_ID','STATUS','OTP','ACCESS_FLAG','FLAG','LOGIN_IP')->where('USER_CODE',$uCode)->where('USER_NAME',$uName)->where('USER_TYPE',$uType)->get()->toArray();
			//dd(DB::getQueryLog());

		
			//DB::enableQueryLog();
			$copy_user_prof = DB::table('MASTER_USERRIGHT')->where('USER_CODE',$uCode)->get()->toArray();
			//dd(DB::getQueryLog());

			//DB::enableQueryLog();
			$copy_user_app = DB::table('USER_APPROVE_IND')->where('USER_CODE',$uCode)->get()->toArray();
			//dd(DB::getQueryLog());
			

    		if ($copy_user && $copy_user_prof && $copy_user_app) {

				$response_array['response']   = 'success';
				$response_array['message']    = 'success';
				$response_array['user_list']  = $copy_user;
				$response_array['prof_list']  = $copy_user_prof;
				$response_array['apprv_list'] = $copy_user_app;

	         $data = json_encode($response_array);

	         print_r($data);

			}else{

				$response_array['response']   = 'error';
				$response_array['message']    = 'error';
				$response_array['user_list']  = '';
				$response_array['prof_list']  = '';
				$response_array['apprv_list'] = '';

            $data = json_encode($response_array);

            print_r($data);
				
			}


    	}else{


    	}


    }
    public function docUploadImg(Request $request,$docImage){
    	//return response()->json('result');
    	print_r($request->file($docImage)->getClientOriginalName());
   //  	$image_file = $docImage;
			// // print_r($image_file);exit();

			// $image      = Image::make($image_file);
			// print_r($image);

			// Response::make($image->encode('jpeg'));
    	
    }

    public function UserFormSave(Request $request)
    {
    	$useremp_type = $request->input('userTypeEmp');

   //  	if($useremp_type == ''){

   //  		$validate = $this->validate($request, [

			// 	'user_code'        => 'required|max:30',
			// 	'user_name'        => 'required|max:30',
			// 	'password'         => 'required|max:15|same:confirm_password',
			// 	'confirm_password' => 'required|max:15',
			// 	'email_id'         => 'required|email|max:30',
			// 	'user_type'        => 'required|max:30',
			// 	'user_img'         => 'required',
		
			// ]);

   //  	}else{

   //  		$validate = $this->validate($request, [

			// 	'user_code'        => 'required|max:30',
			// 	'user_name'        => 'required|max:30',
			// 	'password'         => 'required|max:15|same:confirm_password',
			// 	'confirm_password' => 'required|max:15',
			// 	'email_id'         => 'required|email|max:30',
			// 	'user_img'         => 'required',
		
			// ]);

   //  	}
    	

			$createdBy    = $request->session()->get('userid');

			if (isset($useremp_type)) {

				$utype = $request->input('userTypeEmp');
				
			}else{

				$utype  = $request->input('user_type');
			}
			


			$saveData1  ='';

			$flag = 0;

			$image_file = $request->user_img;
			echo '<PRE>';print_r($image_file);echo '</PRE>';exit();

			$image      = Image::make($image_file);

			Response::make($image->encode('jpeg'));


			// DB::beginTransaction();

			// try {

			$accCode1 = $request->input('acc_code');

			if (isset($accCode1)) {

				$exp1 = explode('_',$accCode1);

				$accCode = $exp1[0];
				$accName = $exp1[1];
				
			}else{

				$accCode = '';
				$accName = '';

			}
		
				
			$data = array(
				"USER_CODE"        => $request->input('user_code'),
				"USER_NAME"        => $request->input('user_name'),
				"ACC_CODE"         => $accCode,
				"ACC_NAME"         => $accName,
				"PASSWORD"         => md5($request->input('password')),
				"EMAIL_ID"         => $request->input('email_id'),
				"USER_TYPE"        => $utype,
				"IMAGE"            => $image,
				"FLAG"             => $flag,
				"CREATED_BY"       => $createdBy,
			
			);
				

				$saveData = DB::table('MASTER_USER')->insert($data);

				$discriptn_page = "Master user insert done by user";

				$this->userLogInsert($createdBy,$discriptn_page);

				$LastUserId = DB::getPdo()->lastInsertId();


				$getAppUsrCopy = $request->input('approve_user_copy');

				if(isset($getAppUsrCopy)){

					$getExp = explode(',',$getAppUsrCopy);

					$count12 = count($getExp);

					$saveData1;

					for ($i=0; $i < $count12; $i++) {

						$exp = explode('-',$getExp[$i]);

						$appUcode = $exp[0];
						$appUname = $exp[1];

						$data1 =array(
							"USER_CODE"     => $request->input('user_code'),
							"USER_NAME"     => $request->input('user_name'),
							"USER_EMAIL"    => $request->input('email_id'),
							"APPROVE_USER"  => $appUcode,
							"APP_USER_NAME" => $appUname,
							"CREATED_BY"    => $createdBy,
						);


						$saveData1 = DB::table('USER_APPROVE_IND')->insert($data1);


					}

				}else{

					$approve_user = $request->input('approve_user');

					if($approve_user){
						$count = count($approve_user);
					}else{
						$count ='';
					}

					$saveData1;
					for ($i=0; $i < $count; $i++) { 

						$exp = explode('-',$approve_user[$i]);

						$appUcode = $exp[0];
						$appUname = $exp[1];

						$data1 =array(
							"USER_CODE"     => $request->input('user_code'),
							"USER_NAME"     => $request->input('user_name'),
							"USER_EMAIL"    => $request->input('email_id'),
							"APPROVE_USER"  => $appUcode,
							"APP_USER_NAME" => $appUname,
							"CREATED_BY"    => $createdBy,
						);


						$saveData1 = DB::table('USER_APPROVE_IND')->insert($data1);
						
					}


				}
				


				$getProfUsrCopy = $request->input('usr_profile_copy');

				if (isset($getProfUsrCopy)) {

					$getExp1 = explode(',',$getProfUsrCopy);
					
					$countProf = count($getExp1);

					$FLAG = 1;

					$saveData2;

					for ($j=0; $j < $countProf; $j++) { 

						$exp = explode('-',$getExp1[$j]);

						$profUcode = $exp[0];
						$profUname = $exp[1];

						$data =array(

							"USER_CODE"    => $request->input('user_code'),
							"USER_NAME"    => $request->input('user_name'),
							"PROFILE_CODE" => $profUcode,
							"PROFILE_NAME" => $profUname,
							"FLAG" 			=> $FLAG,
							"CREATED_BY"   => $createdBy,

						);


						$saveData2 = DB::table('MASTER_USERRIGHT')->insert($data);

					}

					
					
				}else{

					$usr_profile  = $request->input('usr_profile');
			
					if($usr_profile){
						$countProf = count($usr_profile);
					}else{
						$countProf ='';
					}

					$FLAG = 1;
					$saveData2;

					for ($j=0; $j < $countProf; $j++) { 

						$exp = explode('-',$usr_profile[$j]);

						$profUcode = $exp[0];
						$profUname = $exp[1];

						$data =array(

							"USER_CODE"    => $request->input('user_code'),
							"USER_NAME"    => $request->input('user_name'),
							"PROFILE_CODE" => $profUcode,
							"PROFILE_NAME" => $profUname,
							"FLAG" 			=> $FLAG,
							"CREATED_BY"   => $createdBy,

						);


						$saveData2 = DB::table('MASTER_USERRIGHT')->insert($data);
						
					}

				}
				

				if($saveData && $saveData1 && $saveData2){

					$request->session()->flash('alert-success', 'User  Added Successfully...!');
					return redirect('/Master/Setting/View-User-Mast');

				}else{

					$request->session()->flash('alert-error', 'User Can Not Be Added...!');
					return redirect('/Master/Setting/View-User-Mast');

				}

			
				

			// }catch (\Exception $e){

		   //  	DB::rollBack();
		   //  	throw $e;

		   //  	$request->session()->flash('alert-error', 'User Can Not Be Added...!');
			// 	return redirect('/Master/Setting/View-User-Mast');
		    	

			// }

   }

    function UserRightForm(Request $request){

    	
    	$getform = $request->input('getform');
    	//print_r($user_code);exit;

    	// $form = $request->input('getform');

    	 if($request->ajax()) {


			$userid	= $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear =  $request->session()->get('macc_year');

			$data = DB::table('USERACCESS_FORM')->orderBy('id','DESC')->get()->toArray();	

			if($data) {

				$response_array['response'] = 'success';
	         $response_array['data'] = $data ;

	         $data = json_encode($response_array);

	         print_r($data);

			}else {

				$response_array['response'] = 'error';
             
            $data = json_encode($response_array);

            print_r($data);

			}  


    	 }


    }


     function UserRightFormByFilter(Request $request){

    	
    	$getform = $request->input('getform');
    	
    	 if($request->ajax()) {	

				$userid	= $request->session()->get('userid');
				
				$userType = $request->session()->get('usertype');
				
				$compName = $request->session()->get('company_name');
				
				$fisYear =  $request->session()->get('macc_year');

				$getcomcode    = explode('-', $compName);
		
				$comp_code = $getcomcode[0];

				if($getform=='All'){
					$data = DB::table('USERACCESS_FORM')->get()->toArray();
				}else{
					$data = DB::table('USERACCESS_FORM')->where('SUBMENU_NAME',$getform)->get()->toArray();
				}

				/* _______ BEFORE _______ 04_02_2023 */

				/*if($getform=='All'){

					$data = DB::table('USERACCESS_FORM')->get()->toArray();

				}else if($getform=='Master Company'){

					$data = DB::table('MASTER_FY')
					            ->join('MASTER_COMP', 'MASTER_FY.COMP_CODE', '=', 'MASTER_COMP.COMP_CODE')
					            ->select('MASTER_FY.*', 'MASTER_COMP.*')
					            ->orderBy('MASTER_COMP.COMP_CODE')
					            ->get()->toArray();


				}else if($getform=='Profit-Center'){

					$data = DB::table('MASTER_PFCT')->where('COMP_CODE',$comp_code)->get()->toArray();

				}else if($getform=='Plant'){

					$data = DB::table('MASTER_PLANT')->where('COMP_CODE',$comp_code)->get()->toArray();

				}else{

					$data = DB::table('USERACCESS_FORM')->where('menu_name',$getform)->get()->toArray();

				}*/

				/* _______ BEFORE _______ */

			if($data) {

				$response_array['response'] = 'success';
	            $response_array['data'] = $data ;

	            $data = json_encode($response_array);

	            print_r($data);

			}else {

				$response_array['response'] = 'error';
               // $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);

			}  


    	 }


    }


     function EditUserRightForm(Request $request){


     	$user_code = $request->input('user_code');

    	 if($request->ajax()) {

    	 			

					$userid	= $request->session()->get('userid');
					
					
					$userType = $request->session()->get('usertype');
					
					$compName = $request->session()->get('company_name');
					
					$fisYear =  $request->session()->get('macc_year');


				   $data1 = DB::table('USER_RIGHTFORM')->where('USER_CODE',$user_code)->get()->toArray();

				   $data = DB::table('USERACCESS_FORM')->get()->toArray();	


				//print_r($data);exit;
		if($data) {

				$response_array['response'] = 'success';
	            $response_array['data'] = $data;
	            $response_array['user_right'] = $data1;

	            $data = json_encode($response_array);

	            print_r($data);

			}else {

				$response_array['response'] = 'error';
               // $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);

			}  


    	 }


    }


    public function UserView(Request $request){

		$userid      = $request->session()->get('userid');

		$userType    = $request->session()->get('usertype');

		$fisYear     =  $request->session()->get('macc_year');

		$compName    = $request->session()->get('company_name');

		$compcode    = explode('-', $compName);

		$comp_code =	$compcode[0];

    	if($comp_code) {
    
        $data = DB::table('MASTER_USER')->orderBy('USER_CODE','DESC')->paginate(20);

    	  return view('admin.finance.master.setting.view_user',compact('data'));

      }else{

      	return redirect('/useractivity');
      }
}
    


    // if($request->ajax()) {

    // 	$title = 'View Master Depot';

    // 	$userid	= $request->session()->get('userid');

    // 	$userType = $request->session()->get('usertype');

    // 	$compName = $request->session()->get('company_name');

    // 	$fisYear =  $request->session()->get('macc_year');

    // 	if($userType=='admin' || $userType=='Admin'){
    	
    //    $data = DB::table('MASTER_USER')->orderBy('USER_CODE','DESC');

   	// }

    // 	 return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

    // }

    // 	return view('admin.finance.master.setting.view_user');

    // }



    public function getAccType(Request $request){
    	
    	$acc_code = $request->input('acc_code');

    	$acc_type = DB::table('MASTER_ACC')->where('ACC_CODE',$acc_code)->get()->first();

    	if($acc_type){

    		$response_array['response'] = 'success';
	        $response_array['data'] = $acc_type;

	        $data = json_encode($response_array);

	        print_r($data);

    	}else{

    		$response_array['response'] = 'success';
	            //$response_array['data'] = $item_um_aum_list ;
	        $data = json_encode($response_array);
	        print_r($data);
    	}
    	
    }

    public function EditUserForm($id){

    	$title = 'Edit Master User';

    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('MASTER_USER');
			$query->where('USER_CODE', $id);
			$userData['user_list'] = $query->get()->first();
			$userData['acc_code'] = DB::table('MASTER_ACC')->get();

			$userData['approve_ind'] = DB::table('MASTER_APPROVE_IND')->get();

			return view('admin.finance.master.setting.user_list', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'User-Id Not Found...!');
			return redirect('/Master/Setting/View-User-Mast');
		}
    }


    public function UserFormUpdate(Request $request){
    	
    	$validate = $this->validate($request, [

			'user_code'        => 'required|max:30',
			'user_name'        => 'required|max:30',
			'email_id'         => 'required|email|max:30',
			'user_type'        => 'required|max:30',
			
		
		]);

		$lastUpdatedBy = $request->session()->get('userid');

    	$updatedDate = date('Y-m-d');

    	$utype = $request->input('user_type');
    	
    	$approve_user = $request->input('approve_user');

    	$image_file = $request->user_img;

    	if($image_file == ''){
    		
    		if($utype=='admin'){
    		
				$data = array(

					"USER_CODE"        => $request->input('user_code'),
					"ACC_CODE"         => $request->input('acc_code'),
					"USER_NAME"        => $request->input('user_name'),
					"EMAIL_ID"         => $request->input('email_id'),
					"USER_TYPE"        => $utype,
					"FLAG"             => $request->input('user_block'),
					"LAST_UPDATE_BY"   => $lastUpdatedBy,
					"LAST_UPDATE_DATE" => $updatedDate
				
				);

				$userId = $request->input('UserID');

				$saveData = DB::table('MASTER_USER')->where('USER_CODE',$userId)->update($data);

				$discriptn_page = "Master user update done by user";
					$this->userLogInsert($lastUpdatedBy,$discriptn_page);

				if ($saveData) {

					$request->session()->flash('alert-success', 'User Was Successfully Updated...!');
					return redirect('/Master/Setting/View-User-Mast');

				} else {

					$request->session()->flash('alert-error', 'User Can Not Updated...!');
					return redirect('/Master/Setting/View-User-Mast');

				}

			}else if($utype=='superAdmin' || $utype=='user' || $utype=='CRM' || $utype=='SRM' ||  $utype=='Employee' ||  $utype=='employee'  || $utype=='CRM Employee' || $utype=='SRM Employee'){

				$data = array(

					"USER_CODE"           => $request->input('user_code'),
					"ACC_CODE"            => $request->input('acc_code'),
					"USER_NAME"           => $request->input('user_name'),
					"EMAIL_ID"            => $request->input('email_id'),
					"USER_TYPE"           => $utype,
					"FLAG"                => $request->input('user_block'),
					"LAST_UPDATE_BY"      => $lastUpdatedBy,
					"LAST_UPDATE_DATE"    => $updatedDate
		
		      );

				$LastUserId = $request->input('UserID');

				$saveData = DB::table('MASTER_USER')->where('USER_CODE',$LastUserId)->update($data);

				$discriptn_page = "Master user update done by user";
					$this->userLogInsert($lastUpdatedBy,$discriptn_page);

				$title = 'Add User Right';
		    	

				$userData['user_code']   = DB::table('MASTER_USER')->where('USER_NAME','!=','admin')->get();
				$userData['comp_code']   = DB::table('MASTER_COMP')->get();
				$userData['profit_code'] = DB::table('MASTER_PFCT')->get();
				$userData['plant_code']  = DB::table('MASTER_PLANT')->get();
				$userData['trans_code']  = DB::table('USERACCESS_FORM')->where('menu_name','Transaction')->get();
				$userData['form_code']  =  DB::table('USERACCESS_FORM')->where('menu_name','!=','Transaction')->get();

				return view('admin.finance.master.setting.user_right',$userData+compact('title','LastUserId'));
	
      	}

    	}else{

    		$image      = Image::make($image_file);

		   Response::make($image->encode('jpeg'));
		  
			if($utype=='admin'){
    		
				$data = array(

					"USER_CODE"        => $request->input('user_code'),
					"ACC_CODE"         => $request->input('acc_code'),
					"USER_NAME"        => $request->input('user_name'),
					"EMAIL_ID"         => $request->input('email_id'),
					"USER_TYPE"        => $utype,
					"FLAG"             => $request->input('user_block'),
					"LAST_UPDATE_BY"   => $lastUpdatedBy,
					"LAST_UPDATE_DATE" => $updatedDate
				
				); 

				$userId = $request->input('UserID');

				$saveData = DB::table('MASTER_USER')->where('USER_CODE',$userId)->update($data);

				$discriptn_page = "Master user update done by user";
					$this->userLogInsert($lastUpdatedBy,$discriptn_page);

				if ($saveData) {

					$request->session()->flash('alert-success', 'User Was Successfully Updated...!');
					return redirect('/Master/Setting/View-User-Mast');

				} else {

					$request->session()->flash('alert-error', 'User Can Not Updated...!');
					return redirect('/Master/Setting/View-User-Mast');

				}

			}else if($utype=='superAdmin' || $utype=='user' || $utype=='CRM' || $utype=='SRM' ||  $utype=='employee' || $utype=='Employee' || $utype=='CRM Employee' || $utype=='SRM Employee'){

				$data = array(

					"USER_CODE"           => $request->input('user_code'),
					"ACC_CODE"            => $request->input('acc_code'),
					"USER_NAME"           => $request->input('user_name'),
					"EMAIL_ID"            => $request->input('email_id'),
					"USER_TYPE"           => $utype,
					"IMAGE"               => $image,
					"FLAG"                => $request->input('user_block'),
					"LAST_UPDATE_BY"      => $lastUpdatedBy,
					"LAST_UPDATE_DATE"    => $updatedDate
		
		      );

				$LastUserId = $request->input('UserID');

				$saveData = DB::table('MASTER_USER')->where('USER_CODE',$LastUserId)->update($data);

				$discriptn_page = "Master user update done by user";
					$this->userLogInsert($lastUpdatedBy,$discriptn_page);

				$title = 'Add User Right';

				$userData['user_code']   = DB::table('MASTER_USER')->where('USER_NAME','!=','admin')->get();
				$userData['comp_code']   = DB::table('MASTER_COMP')->get();
				$userData['profit_code'] = DB::table('MASTER_PFCT')->get();
				$userData['plant_code']  = DB::table('MASTER_PLANT')->get();
				$userData['trans_code']  = DB::table('USERACCESS_FORM')->where('menu_name','Transaction')->get();
				$userData['form_code']  =  DB::table('USERACCESS_FORM')->where('menu_name','!=','Transaction')->get();

				return view('admin.finance.master.setting.user_right',$userData+compact('title','LastUserId'));
	
      	}

    		
    	}

    }

    public function DeleteUser(Request $request){

    	$userId = $request->post('UserID');

    	//print_r($userId);exit;

    	if ($userId!='') {
    		
    		$Delete = DB::table('MASTER_USER')->where('USER_CODE', $userId)->delete();

    		/*$Delete1 = DB::table('master_form')->where('user_id', $userId)->delete();*/

			if($Delete) {

				$request->session()->flash('alert-success', 'User Was Deleted Successfully...!');
				return redirect('/Master/Setting/View-User-Mast');

			} else {

				$request->session()->flash('alert-error', 'User Can Not Deleted...!');
				return redirect('/Master/Setting/View-User-Mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'User Not Found...!');
			return redirect('/Master/Setting/View-User-Mast');

    	}
    }


    public function UserRight(Request $request){

     	$title = 'Add User Right';

		$userData['user_code']   = DB::table('MASTER_USER')->where('USER_NAME','!=','Admin')->get();
		$userData['comp_code']   = DB::table('MASTER_COMP')->get();
		$userData['profit_code'] = DB::table('MASTER_PFCT')->get();
		$userData['plant_code']  = DB::table('MASTER_PLANT')->get();
		$userData['trans_code']  = DB::table('USERACCESS_FORM')->where('menu_name','Transaction')->get();

		$userData['form_code']  =  DB::table('USERACCESS_FORM')->where([['menu_name','!=','Transaction'],['menu_name','!=','Master Company']])->get();
   
    	return view('admin.finance.master.setting.user_right',$userData+compact('title'));
    }
/*user right */

	public function UpdateUserAccess(Request $request,$id){

     	$title = 'Add User Right';

     	$id=base64_decode($id);
    	

		$userData['user_code']   = DB::table('MASTER_USER')->where('USER_CODE',$id)->get()->first();
		//print_r($userData['user_code']);exit;
		$userData['comp_code']   = DB::table('MASTER_COMP')->get();
		$userData['profit_code'] = DB::table('MASTER_PFCT')->get();
		$userData['plant_code']  = DB::table('MASTER_PLANT')->get();
		$userData['trans_code']  = DB::table('USERACCESS_FORM')->where('menu_name','Transaction')->get();

	
		$userData['form_code']  =  DB::table('USERACCESS_FORM')->where([['menu_name','!=','Transaction'],['menu_name','!=','Master Company']])->get();

		$userId=$id;
		$userData['form_name'] = DB::table('USER_RIGHTFORM')->where('USER_CODE', $userId)->get()->toArray();

    	return view('admin.finance.master.setting.update_user_access',$userData+compact('title','userId'));
   }


	



public function UserRightUpdate(Request $request)
    {

    	//print_r($request->post());exit;
    	$userid      = $request->input('userid');
		$createdBy   = $request->session()->get('userid');
    	$totcount    = $request->input('totalcount');
    	$form_name    = $request->input('form_name');

    	$count = $totcount;
    	//print_r($count);exit;

    	
    	


    if($userid!='') {
    		
     	$Delete = DB::table('USER_RIGHTFORM')->where('USER_CODE',$userid)->delete();


     	if($form_name){

    		$form_count = count($form_name);

    	for ($j=0; $j < $form_count; $j++) { 

        $formname = explode('_', $form_name[$j]);

    	
    		//print_r($formname);

    		$data1=array(

    			'USER_CODE'   =>$userid,
    			'FORMCODE'    =>$formname[0],
    			'FORMNAME'    =>$formname[1],
    		);

    		$saveData = DB::table('USER_RIGHTFORM')->insert($data1);
    	}
    	}

    	
    	$saveData ='';
    	for ($i=0; $i < $count; $i++) { 


    		///print_r($count);exit;

			if(!empty($request->input('form_name_'.$i))){

				$form_name = $request->input('form_name_'.$i);

				$formcode = explode('_', $form_name);



				$add     = $request->input('add_'.$i);
				if(!empty($add)){
					$add ='YES';
				}else{
					$add ='NO';	
				}

				$edit     = $request->input('edit_'.$i);

				if(!empty($edit)){
					$edit ='YES';
				}else{
					$edit ='NO';	
				}
				$delete   = $request->input('delete_'.$i);

				if(!empty($delete)){
					$delete ='YES';
				}else{
					$delete ='NO';	
				}
				$view     = $request->input('view_'.$i);

				if(!empty($view)){
					$view ='YES';
				}else{
					$view ='NO';	
				}

				$data=array(

				'USER_CODE'   =>$userid,
				'FORMCODE'    =>$formcode[0],
				'FORMNAME'    =>$formcode[1],
				'ADD_FORM'    =>$add,
				'EDIT_FORM'   =>$edit,
				'DELETE_FORM' =>$delete,
				'VIEW_FORM'   =>$view,

    			);

     	   	 //


     	     $saveData = DB::table('USER_RIGHTFORM')->insert($data);
			 	# code...
			 

			   
           
			}



	}

        $discriptn_page = "Master user right insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

		if($saveData){

			$request->session()->flash('alert-success', 'UserRight Was Successfully Updated...!');

				return redirect('/Master/Setting/view-user-right');

			} else {

				$request->session()->flash('alert-error', 'User Can Not Updated...!');
				return redirect('/Master/Setting/view-user-right');

			}
    
	}	
    }

    public function UserRightUpdate1(Request $request)
    {
		$formcode  = $request->input('form_name');
		$userid    = $request->input('userid');
		$createdBy = $request->session()->get('userid');

    //	print_r($userid);exit;
    
    	

    	//print_r($userid);exit;

    	if($userid!='') {
    		
    	$Delete = DB::table('USER_RIGHTFORM')->where('USER_CODE',$userid)->delete();

     if($formcode){

    	$count =count($formcode);

    	
    	for ($i=0; $i < $count ; $i++) { 

        	$data=array(

        		'USER_CODE'=>$userid,
        		'FORMCODE'=>$formcode[$i],

    			);
        	
        $saveData = DB::table('USER_RIGHTFORM')->insert($data);

			
        }

        $discriptn_page = "Master user right update done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

        if ($saveData) {

				$response_array['response'] = 'success';
	            //$response_array['data'] = $item_um_aum_list ;

	            $data = json_encode($response_array);

	            print_r($data);

			} else {

				$response_array['response'] = 'error';
               // $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);

			}
    }else{

				$response_array['response'] = 'success';
               // $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);

			}

    }

    	
        
    
    	   	
    }


     public function DeleteUserRight(Request $request){

    	$userId = $request->post('user_code');

    	//print_r($userId);exit;

    	if ($userId!='') {
    		
    		$Delete = DB::table('USER_RIGHTFORM')->where('USER_CODE', $userId)->delete();

    		/*$Delete1 = DB::table('master_form')->where('user_id', $userId)->delete();*/

			if($Delete) {

				$request->session()->flash('alert-success', 'User Was Deleted Successfully...!');
				return redirect('/Master/Setting/view-user-right');

			} else {

				$request->session()->flash('alert-error', 'User Can Not Deleted...!');
				return redirect('/Master/Setting/view-user-right');

			}

    	}else{

    		$request->session()->flash('alert-error', 'User Not Found...!');
			return redirect('/Master/Setting/view-user-right');

    	}
    }

    public function user_right_msg(Request $request,$saveData){

	 //	print_r($savedata);exit;

	if ($saveData) {

			$request->session()->flash('alert-success', 'User Right Was Successfully Added...!');
			return redirect('/Master/Setting/view-user-right');

		} else {

			$request->session()->flash('alert-error', 'User Can Not Added...!');
			return redirect('/Master/Setting/view-user-right');

		}
}

public function user_right_update_msg(Request $request,$update){

	 //	print_r($savedata);exit;

	if ($update) {

			$request->session()->flash('alert-success', 'User Right Was Successfully Updated...!');
			return redirect('/Master/Setting/view-user-right');

		} else {

			$request->session()->flash('alert-error', 'User Can Not Added...!');
			return redirect('/Master/Setting/view-user-right');

		}
}


   public function UserRightcheck(Request $request)
    {
    	
    	$userid = $request->input('userid');
    
    		//print_r($userid);exit;

    	if ($userid!='') {
    		//print_r($userid);exit;

    		$userData['form_name'] = DB::table('USER_RIGHTFORM')->where('USER_CODE', $userid)->get()->toArray();

    		$userData['user_name'] = DB::table('MASTER_USER')->where('USER_CODE', $userid)->get()->first();

    		//print_r($userData['form_name']);exit;

    		$username= $userData['user_name']->USER_NAME;

    		if($userData['form_name']){

    			
                //print_r($data);
    			$userData['user_code']   = DB::table('MASTER_USER')->get();
				$userData['comp_code']   = DB::table('MASTER_COMP')->get();
				$userData['profit_code'] = DB::table('MASTER_PFCT')->get();
				$userData['plant_code']  = DB::table('MASTER_PLANT')->get();
				$userData['trans_code']  = DB::table('USERACCESS_FORM')->where('menu_name','Transaction')->get();

		
				$userData['UNIQU_TABLE'] = DB::select("SELECT  USER_CODE,FORMCODE,FORMNAME,ADD_FORM,EDIT_FORM,DELETE_FORM,VIEW_FORM from USER_RIGHTFORM WHERE USER_CODE ='$userid' GROUP BY FORMCODE
					UNION 
					SELECT '' as USER_CODE,form_code as FORMCODE,form_name as FORMNAME,'' as ADD_FORM,'' as EDIT_FORM,'' AS DELETE_FORM,'' as VIEW_FORM from USERACCESS_FORM GROUP BY FORMCODE");



    		return view('admin.finance.master.setting.edit_userright',$userData+compact('userid'));

    		

    		   
    		}else{

    			//print_r('hii');exit;
    			$response_array['response'] = 'error';
                $response_array['data'] = $username ;

                $data = json_encode($response_array);

                print_r($data);


    		}
    	}

    	

    	   	
    }


    public function GetuserView(Request $request)
    {
    	//$formcode = $request->input('form_name');
    	$userid = $request->input('id');
    
    	
    	//print_r($userid);exit;

    	if ($userid!='') {
    		//print_r($userid);exit;


    		$userData['form_name1'] = DB::table('USER_RIGHTFORM')->where('USER_CODE', $userid)->get()->toArray();
    		//print_r($userData['form_name']);exit;
    	//	$username= $userData['form_name']->name;

    		$userData['form_name'] = DB::SELECT("SELECT * FROM USER_RIGHTFORM a, USERACCESS_FORM b WHERE a.FORMCODE= b.form_code AND a.USER_CODE='$userid'");

    		//print_r($userData['form_name']);exit;


    		if($userData['form_name']){

    			
    			

    	

    			
              return view('admin.finance.master.setting.append_user_right',$userData);

    		

    		   
    		}
    	}

    	

    	   	
    }


      public function Getusername(Request $request)
    {
    	//$formcode = $request->input('form_name');
    	$userid = $request->input('userid');
    
    	
    	//print_r($userid);exit;

    	if ($userid!='') {
    		//print_r($userid);exit;
    		
    		$userData['user_name'] = DB::table('MASTER_USER')->where('USER_CODE', $userid)->get()->first();


    		$username = $userData['user_name']->USER_NAME;
    	//	print_r($username);exit;

    		if($username){

    			$response_array['response'] = 'success';
                $response_array['data'] = $username ;

                $data = json_encode($response_array);

                print_r($data);
    		}else{

    			$response_array['response'] = 'error';
                $response_array['data'] = '';
             //   print_r($response_array);exit;

                $data = json_encode($response_array);

                print_r($data);


    		}
    	}

    	 	
    }


    public function New_Yr_Item_Bal1(Request $request){

    	$compName       = $request->session()->get('company_name');
		$macc_year      = $request->session()->get('macc_year');

		$title          = 'Add Item Blance';
		
		$button         ='Save';
		
		$action         = '/Master/Item/form-item-balance-save';

	
	
    if(isset($compName)){

    	return view('admin.finance.master.setting.new_item_bal');

    }else{

		return redirect('/useractivity');
	}

	}

	public function New_Yr_Item_Bal(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->item_code || $request->getqty || $request->getqtyval)) {

					$itemCode = $request->item_code;
					
					//print_r($qtyval);exit;
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];

                $macc_year = $request->session()->get('macc_year');

                $bgdate     = $request->session()->get('yrbgdate');
                $yrbgdate = date("Y-m-d", strtotime($bgdate));

                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');

                $from_date = $request->from_date;

                $from_date1 = date("Y-m-d", strtotime($request->from_date));

                $to_date = $request->to_date;

                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                $oneDayBack	=date('Y-m-d', strtotime('-1 day', strtotime($from_date1)));

				$strWhere  ='';
				$strWhere1 ='';
				$tableName ='';
				$fieldName ='';
				$otherName ='';
				$otherCode ='';
            



//DB::enableQueryLog();
	$data = DB::select("SELECT t.ITEM_CODE,t.ITEM_NAME as ITEM_NAME,g.PLANT_CODE as PLANT_CODE, format(t.OPQTY + t.QTYRECD - t.QTYISSUED,3,'en_IN') AS CLSQTY,format(t.OPVAL + t.CRAMT - t.DRAMT,2,'en_IN') AS CLSVAL FROM 
                 (
                  SELECT ITEM_CODE,sum(a.CRAMT) as CRAMT,sum(a.DRAMT) as DRAMT,sum(a.opval) as OPVAL,sum(a.opqty) as OPQTY, sum(a.QTYRECD) as QTYRECD, sum(a.QTYISSUED) as  QTYISSUED, '' as ITEM_NAME,'' as PLANT_CODE FROM 
                  (    
               #Bring year opening balance
                SELECT ITEM_CODE,0 AS CRAMT,0 AS DRAMT,YROPVAL AS OPVAL, YROPQTY as OPQTY, 0 as QTYRECD, 0 AS QTYISSUED,'' as ITEM_NAME,'' as PLANT_CODE FROM MASTER_ITEMBAL WHERE FY_CODE='2021-2022' AND ITEM_CODE='$itemCode'
                 UNION ALL
                #Bring transactions during year opening and before from date
                SELECT ITEM_CODE as ITEM_CODE,0 AS CRAMT,0 AS DRAMT,CRAMT-DRAMT as OPVAL,QTYRECD-QTYISSUED as OPQTY, 0 as QTYRECD, 0 as QTYISSUED, ITEM_NAME as ITEM_NAME,'' as PLANT_CODE FROM ITEM_LEDGER WHERE 1=1 AND vrdate BETWEEN '2021-04-01' AND DATE_SUB('2021-04-01',INTERVAL 1 DAY)
                  UNION ALL    
                  SELECT ITEM_CODE as ITEM_CODE,CRAMT AS CRAMT,DRAMT AS DRAMT,0 as OPVAL,0 as OPQTY, QTYRECD as QTYRECD, QTYISSUED as QTYISSUED, ITEM_NAME as ITEM_NAME,'' as PLANT_CODE FROM ITEM_LEDGER where 1=1 AND  VRDATE BETWEEN '2021-04-01' AND '2022-04-11'
                 ) a group by a.ITEM_CODE ORDER BY a.item_code
                 ) t,MASTER_ITEMBAL g  JOIN (SELECT @running_total:=0)r group by t.ITEM_CODE");

//dd(DB::getQueryLog());


               
             
                  return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $title = 'Item Ledger';

        //DB::enableQueryLog();
        $item_um_aum_list = DB::table('MASTER_FY')->where('COMP_CODE',$CCFromSession)->where('FY_CODE',$macc_year)->get();

            foreach ($item_um_aum_list as $key) {
                $userdata['fromDate'] =  $key->FY_FROM_DATE;
                $userdata['toDate']   =  $key->FY_TO_DATE;
            }

		$item_list = DB::table('MASTER_ITEM')->get();
		$itemt_list = DB::table('MASTER_ITEMTYPE')->get();
		$itemcc_list = DB::table('MASTER_ITEM_CATEGORY')->get();
		$itemc_list = DB::table('MASTER_ITEM_CLASS')->get();
		$itemg_list  = DB::table('MASTER_ITEMGROUP')->get();
		
		$tran_list  = DB::table('MASTER_TRANSACTION')->get();

        if(isset($company_name)){

        return view('admin.finance.master.setting.new_item_bal',$userdata+compact('title','item_list','itemt_list','itemcc_list','itemc_list','itemg_list','macc_year','tran_list'));
        }else{
        return redirect('/useractivity');
        }
        
    }




    public function AccGlBalNewYr(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date)) {

                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];

                $bgdate     = $request->session()->get('yrbgdate');
                $yrbgdate = date("Y-m-d", strtotime($bgdate));

                $macc_year = $request->session()->get('macc_year');
               
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));
                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                //DB::table('acc_ledger_temp')->truncate();

                $strwhere='';
                if(isset($from_date1)  && trim($from_date1)!="")
                {
                    	$strwhere .="AND vr_date BETWEEN '$from_date1' AND '$to_date1'";
                }

// DB::enableQueryLog();
                
 //dd(DB::getQueryLog());
             	//DB::enableQueryLog();
                $data= DB::select("SELECT t.GL_CODE,m.gl_name as gl_name,g.PFCT_CODE as pfct_code, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt>=0, t.yropdr-t.yropcr+t.yrdramt-t.yrcramt,0) as cldramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt<0, abs(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt),0) as clcramt FROM
					(
					SELECT GL_CODE,'' as gl_name,'' as pfct_code, sum(a.yropdr) as yropdr, sum(a.yropcr) as yropcr, sum(a.yrdramt) as yrdramt, sum(a.yrcramt) as yrcramt, 0 as cldramt, 0 as clcramt FROM
					(
#Bring year opening balance
				 	SELECT '' as GL_CODE,'' as pfct_code, yropdr as yropdr, yropcr as yropcr, 0 as yrdramt, 0 as yrcramt,'' as gl_name FROM MASTER_GLBAL WHERE FY_CODE='$macc_year'
					UNION ALL
#Bring transactions during year opening and before from date
					SELECT GL_CODE,'' as pfct_code, dramt as yropdr, cramt as yropcr, 0 as yrdramt, 0 as yrcramt,'' as gl_name FROM LEDGER_TRAN WHERE vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY)
					UNION ALL   
#Bring transactions during from date and to date
					SELECT GL_CODE,'' as pfct_code, 0 as yropdr, 0 as yropcr, if(dramt is NULL,0,dramt) as yrdramt, if(cramt is NULL,0,cramt) as yrcramt,'' as gl_name FROM LEDGER_TRAN WHERE vrdate BETWEEN '$from_date1' AND '$to_date1'
					) a group by a.GL_CODE order by a.GL_CODE) t,MASTER_GLBAL g,MASTER_GL m where m.gl_code=t.gl_code group by t.GL_CODE");
                //dd(DB::getQueryLog());
//print_r($data);exit;
	            
               return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

        $company_name     = $request->session()->get('company_name');
        $macc_year         = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid    = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$CCFromSession,'FY_CODE'=>$macc_year])->get();
     

            foreach ($getdate as $key) {
                $userdata['fromDate'] =  $key->FY_FROM_DATE;
                $userdata['toDate']   =  $key->FY_TO_DATE;
            }
            
        $title = 'Trial Balence Report';

        return view('admin.finance.master.setting.new_acc_bal_gl_bal',$userdata+compact('title'));
        
    }


     public function DemoAccGlBalNewYr(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date)) {

                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];

                $bgdate     = $request->session()->get('yrbgdate');
                $yrbgdate = date("Y-m-d", strtotime($bgdate));

                $macc_year = $request->session()->get('macc_year');
               
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));
                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                //DB::table('acc_ledger_temp')->truncate();

                $strwhere='';
                if(isset($from_date1)  && trim($from_date1)!="")
                {
                    	$strwhere .="AND vr_date BETWEEN '$from_date1' AND '$to_date1'";
                }

// DB::enableQueryLog();
                
 //dd(DB::getQueryLog());
             	//DB::enableQueryLog();
                $data= DB::select("SELECT t.GL_CODE,m.gl_name as gl_name,g.PFCT_CODE as pfct_code, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt>=0, t.yropdr-t.yropcr+t.yrdramt-t.yrcramt,0) as cldramt, if(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt<0, abs(t.yropdr-t.yropcr+t.yrdramt-t.yrcramt),0) as clcramt FROM
					(
					SELECT GL_CODE,'' as gl_name,'' as pfct_code, sum(a.yropdr) as yropdr, sum(a.yropcr) as yropcr, sum(a.yrdramt) as yrdramt, sum(a.yrcramt) as yrcramt, 0 as cldramt, 0 as clcramt FROM
					(
#Bring year opening balance
				 	SELECT '' as GL_CODE,'' as pfct_code, yropdr as yropdr, yropcr as yropcr, 0 as yrdramt, 0 as yrcramt,'' as gl_name FROM MASTER_GLBAL WHERE FY_CODE='$macc_year'
					UNION ALL
#Bring transactions during year opening and before from date
					SELECT GL_CODE,'' as pfct_code, dramt as yropdr, cramt as yropcr, 0 as yrdramt, 0 as yrcramt,'' as gl_name FROM LEDGER_TRAN WHERE vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY)
					UNION ALL   
#Bring transactions during from date and to date
					SELECT GL_CODE,'' as pfct_code, 0 as yropdr, 0 as yropcr, if(dramt is NULL,0,dramt) as yrdramt, if(cramt is NULL,0,cramt) as yrcramt,'' as gl_name FROM LEDGER_TRAN WHERE vrdate BETWEEN '$from_date1' AND '$to_date1'
					) a group by a.GL_CODE order by a.GL_CODE) t,MASTER_GLBAL g,MASTER_GL m where m.gl_code=t.gl_code group by t.GL_CODE");
                //dd(DB::getQueryLog());
//print_r($data);exit;
	            
               return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

        $company_name     = $request->session()->get('company_name');
        $macc_year         = $request->session()->get('macc_year');
        $usertype     = $request->session()->get('user_type');
        $userid    = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];

        $getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$CCFromSession,'FY_CODE'=>$macc_year])->get();
     

            foreach ($getdate as $key) {
                $userdata['fromDate'] =  $key->FY_FROM_DATE;
                $userdata['toDate']   =  $key->FY_TO_DATE;
            }
            
        $title = 'Trial Balence Report';

        return view('admin.finance.master.setting.demo_new_acc_bal_gl_bal',$userdata+compact('title'));
        
    }

public function VrseqcompDetails(Request $request){

        if ($request->ajax()) {

            if (!empty($request->comp_code || $request->comptype)) {

					$comp_code   = $request->comp_code;
					$comptype    = $request->comptype;
				
                
                $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];

                $macc_year = $request->session()->get('macc_year');

                $bgdate     = $request->session()->get('yrbgdate');
                $yrbgdate = date("Y-m-d", strtotime($bgdate));

                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');

                $from_date = $request->from_date;

                $from_date1 = date("Y-m-d", strtotime($request->from_date));

                $to_date = $request->to_date;

                $to_date1   = date("Y-m-d", strtotime($request->to_date));

                $oneDayBack	=date('Y-m-d', strtotime('-1 day', strtotime($from_date1)));


                if($comptype=='allcomp'){
                	 $data = DB::table('MASTER_VRSEQ')->get();

                	// print_r($data);exit;
                	}else{

                	$data = DB::table('MASTER_VRSEQ')->where('COMP_CODE',$comp_code)->get();

                //	print_r($data);exit;
                	}
              
               
               
                  return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

        $company_name   = $request->session()->get('company_name');
        $macc_year      = $request->session()->get('macc_year');
        $usertype   = $request->session()->get('user_type');
        $userid = $request->session()->get('userid');

        $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];


        if(isset($company_name)){

        return view('admin.finance.report.item_stock_report');
        }else{
        return redirect('/useractivity');
        }
        
    }


 public function NewVrSequenceSave(Request $request)
    {

    	$createdBy      = $request->session()->get('userid');
    	//print_r($request->fy_code);exit;
    	$fy_code = $request->fy_code;
    	$comptype = $request->getcomp;
    	$comp_code = $request->company_code;

    	$getdata =DB::table('MASTER_VRSEQ')->where('FY_CODE',$fy_code)->get()->toArray();

    if(empty($getdata)){

         if($comptype=='allcomp'){

    	$getdata =DB::table('MASTER_VRSEQ')->get()->toArray();

    	$count = count($getdata);

    	
		
    	foreach ($getdata as $key) {

		$data =array(

				'COMP_CODE'   => $key->COMP_CODE,
				'FY_CODE'     => $fy_code, 
				'TRAN_CODE'   => $key->TRAN_CODE,
				'SERIES_CODE' => $key->SERIES_CODE,
				'FROM_NO'     => $key->FROM_NO,
				'TO_NO'       => $key->TO_NO,
				'LAST_NO'     => $key->LAST_NO,
    		
    		);

    	$saveData1 = DB::table('MASTER_VRSEQ')->insert($data);

    	$discriptn_page = "Master new vrseq insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

    	}

    	}else{

    	$getcomp =DB::table('MASTER_VRSEQ')->where('COMP_CODE',$comp_code)->get()->toArray();


    	foreach ($getcomp as $key) {

		$data =array(

				'COMP_CODE'   => $comp_code,
				'FY_CODE'     => $fy_code, 
				'TRAN_CODE'   => $key->TRAN_CODE,
				'SERIES_CODE' => $key->SERIES_CODE,
				'FROM_NO'     => $key->FROM_NO,
				'TO_NO'       => $key->TO_NO,
				'LAST_NO'     => $key->LAST_NO,
    		
    		);

    	$saveData1 = DB::table('MASTER_VRSEQ')->insert($data);

    	}

    	$discriptn_page = "Master vrseq insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);


    	}
    	if($saveData1){
    			$response_array['response'] = 'Success';
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


    public function VrSeqCheckdata(Request $request)
    {

          $fy_code = $request->fy_code;
    	  $comptype = $request->getcomp;
    	  $comp_code = $request->company_code;


            $company_name = $request->session()->get('company_name');
            $explodeCnm   = explode('-', $company_name);
		    $compCode = $explodeCnm[0];
								
		    $fisYear   =  Session::get('macc_year'); 
								
			$GetYear = explode('-', $fisYear);
								
			$firstyear = $GetYear[0] + 1;
			$lastyear = $GetYear[1] + 1;
								
			$nextyr = $firstyear.'-'.$lastyear;

         if($comptype=='allcomp'){

		 $getdata =DB::table('MASTER_VRSEQ')->where('FY_CODE',$nextyr)->get()->toArray();

		}else{

		 $getdata =DB::table('MASTER_VRSEQ')->where('FY_CODE',$nextyr)->where('COMP_CODE',$compCode)->get()->toArray();
		}

		 $count = count($getdata);

		 if($count ==0){

		 		$response_array['response'] = 'error';

                $data = json_encode($response_array);

                print_r($data);
		 }else{

		 	$response_array['response'] = 'Success';
                
                $data = json_encode($response_array);

                print_r($data);
		 }


         

    	


    }



      public function ItemBalCheckdata(Request $request)
    {

            $item_code = $request->item_code;
            $open_qty = $request->cls_qty;
            $open_val = $request->cls_val;
          
            $company_name = $request->session()->get('company_name');
            $explodeCnm   = explode('-', $company_name);
		    $compCode = $explodeCnm[0];
								
		    $fisYear   =  Session::get('macc_year'); 
								
			$GetYear = explode('-', $fisYear);
								
			$firstyear = $GetYear[0] + 1;
			$lastyear = $GetYear[1] + 1;
								
			$nextyr = $firstyear.'-'.$lastyear;

            //print_r($open_val);exit;
           

         $count =  count($item_code);

         //$getdata=[];

       for ($i=0; $i < $count; $i++) { 



		 $getdata =DB::table('MASTER_ITEMBAL')->where('ITEM_CODE',$item_code[$i])->where('FY_CODE',$nextyr)->where('COMP_CODE',$compCode)->get()->toArray();

		}
		 $getcount = count($getdata);
		//print_r($getcount);exit;
		  if($getcount ==0){

		 		$response_array['response'] = 'error';

                $data = json_encode($response_array);

                print_r($data);
		 }else{

		 	$response_array['response'] = 'Success';
                
                $data = json_encode($response_array);

                print_r($data);
		 }

		

		 
    }


    public function NewItemBalSave(Request $request)
    {

			$item_code  = $request->item_code;
			$open_qty   = $request->cls_qty;
			$openval   = $request->cls_val;
			$plant_code = $request->plant_code;

           	$createdBy      = $request->session()->get('userid');
            $company_name = $request->session()->get('company_name');
            $explodeCnm   = explode('-', $company_name);
		    $compCode = $explodeCnm[0];
								
		    $fisYear   =  Session::get('macc_year'); 
								
			$GetYear = explode('-', $fisYear);
								
			$firstyear = $GetYear[0] + 1;
			$lastyear = $GetYear[1] + 1;
								
			$nextyr = $firstyear.'-'.$lastyear;
			$open_val = str_replace(',', '', $openval);
             //print_r($open_val);exit;

            $itemcount =  count($item_code);



           //print_r($open_val);exit;

       for ($i=0; $i < $itemcount; $i++) { 



           	$getdata =DB::table('MASTER_ITEMBAL')->where('ITEM_CODE',$item_code[$i])->where('FY_CODE',$nextyr)->where('COMP_CODE',$compCode)->get()->toArray();

    	    $getdatacount = count($getdata);


    	    if($getdatacount==0){


			$data =array(

				'COMP_CODE'  => $compCode,
				'FY_CODE'    => $nextyr, 
				'PLANT_CODE' => $plant_code[$i], 
				'ITEM_CODE'  => $item_code[$i],
				'YROPQTY'    => $open_qty[$i],
				'YROPVAL'    => $open_val[$i],
				
    		);

    	$saveData1 = DB::table('MASTER_ITEMBAL')->insert($data);

    	$discriptn_page = "Master item balence insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);
			
		}else{

		$getdata =DB::table('MASTER_ITEMBAL')->where('ITEM_CODE',$item_code[$i])->where('FY_CODE',$nextyr)->where('COMP_CODE',$compCode)->delete();	

			$data =array(

				'COMP_CODE'  => $compCode,
				'FY_CODE'    => $nextyr, 
				'PLANT_CODE' => $plant_code[$i], 
				'ITEM_CODE'  => $item_code[$i],
				'YROPQTY'    => $open_qty[$i],
				'YROPVAL'    => $open_val[$i],
				
    		);

    	$saveData1 = DB::table('MASTER_ITEMBAL')->insert($data);

    	$discriptn_page = "Master item balence insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

    }
          
  }

    	if($saveData1){

       
    	        $response_array['response'] = 'Success';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);

    	}
    	else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
		
    	}

}

  


   


    public function GlBalCheckdata(Request $request)
    {

            $gl_code  = $request->gl_code;
			$crdr_amt = $request->crdr_amt;
			$clcr_amt = $request->clcr_amt;



            $company_name = $request->session()->get('company_name');
            $explodeCnm   = explode('-', $company_name);
		    $compCode = $explodeCnm[0];
								
		    $fisYear   =  Session::get('macc_year'); 
								
			$GetYear = explode('-', $fisYear);
								
			$firstyear = $GetYear[0] + 1;
			$lastyear = $GetYear[1] + 1;
								
			$nextyr = $firstyear.'-'.$lastyear;

             //print_r($nextyr);exit;
           

         $count =  count($gl_code);

         //$getdata=[];
       for ($i=0; $i < $count; $i++) { 

		 $getdata =DB::table('MASTER_GLBAL')->where('GL_CODE',$gl_code[$i])->where('FY_CODE',$nextyr)->where('COMP_CODE',$compCode)->get()->toArray();


		 $getcount = count($getdata);
		}

		//print_r($getcount);exit;

		 if($getcount ==0){

		 		$response_array['response'] = 'error';

                $data = json_encode($response_array);

                print_r($data);
		 }else{

		 	$response_array['response'] = 'Success';
                
                $data = json_encode($response_array);

                print_r($data);
		 }


         

    	


    }





     public function NewItemGlSave(Request $request)
    {
			$createdBy = $request->session()->get('userid');
			$gl_code   = $request->gl_code;
			$crdr_amt  = $request->crdr_amt;
			$clcr_amt  = $request->clcr_amt;
			$pfct_code = $request->pfct_code;

    	//print_r($clcr_amt);exit;
           /* $getitemdata =DB::table('MASTER_GLBAL')->where('GL_CODE',$gl_code)->first();*/

           // $plant_code = $getitemdata->PLANT_CODE;
           

            $company_name = $request->session()->get('company_name');
            $explodeCnm   = explode('-', $company_name);
		    $compCode = $explodeCnm[0];
								
		    $fisYear   =  Session::get('macc_year'); 
								
			$GetYear = explode('-', $fisYear);
								
			$firstyear = $GetYear[0] + 1;
			$lastyear = $GetYear[1] + 1;
								
			$nextyr = $firstyear.'-'.$lastyear;

          //  print_r($gl_code);exit;

			$count = count($gl_code);



		for ($i=0; $i < $count; $i++) { 

			$getdata =DB::table('MASTER_GLBAL')->where('GL_CODE',$gl_code[$i])->where('FY_CODE',$nextyr)->where('COMP_CODE',$compCode)->get()->toArray();

			$datacount = count($getdata);


		if($datacount == 0){

			$data =array(

				'COMP_CODE' => $compCode,
				'FY_CODE'   => $nextyr, 
				'PFCT_CODE' => $pfct_code[$i], 
				'GL_CODE'   => $gl_code[$i], 
				'YROPDR'    => $crdr_amt[$i],
				'YROPCR'    => $clcr_amt[$i],
				
				
    		
    		);

    	$saveData1 = DB::table('MASTER_GLBAL')->insert($data);

    	$discriptn_page = "Master acc/gl balence insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);
         }else{

         	$getdata =DB::table('MASTER_GLBAL')->where('GL_CODE',$gl_code[$i])->where('FY_CODE',$nextyr)->where('COMP_CODE',$compCode)->delete();	

         	$data =array(

				'COMP_CODE' => $compCode,
				'FY_CODE'   => $nextyr, 
				'PFCT_CODE' => $pfct_code[$i], 
				'GL_CODE'   => $gl_code[$i], 
				'YROPDR'    => $crdr_amt[$i],
				'YROPCR'    => $clcr_amt[$i],
				
				
    		
    		);

    	$saveData1 = DB::table('MASTER_GLBAL')->insert($data);

    	$discriptn_page = "Master acc/gl balence insert done by user";
		$this->userLogInsert($createdBy,$discriptn_page);

         }
			
		}
		
    	if($saveData1){

       
    	        $response_array['response'] = 'Success';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);

    	}
    	else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
		
    	}

	}

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





	function engineTblConfig(Request $request){
		
			$company_name = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$usertype     = $request->session()->get('user_type');
			$userid       = $request->session()->get('userid');

         $getcomcode    = explode('-', $company_name);
         $compCode = $getcomcode[0];

         $title = 'Engine Tbl Config';

         $tranCode = DB::table('MASTER_TRANSACTION')->get();


        if(isset($company_name)){

    			return view('admin.finance.master.setting.engine_tbl_config',compact('title','tranCode'));

        }else{

        		return redirect('/useractivity');

        }
		
	}


	public function getTransactionCode(Request $request){

		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');

      $getcomcode    = explode('-', $company_name);
      $compCode = $getcomcode[0];

      $tCode = $request->input('Tcode');

      $getData = DB::table('MASTER_TRANSACTION')->where('TRAN_CODE',$tCode)->get();


      if($getData){

	      $response_array['response'] = 'Success';
         $response_array['getTranCodeList'] = $getData;

         $data = json_encode($response_array);

         print_r($data);

    	}else{

			$response_array['response'] = 'error';
         $response_array['getTranCodeList'] = '' ;

         $data = json_encode($response_array);

         print_r($data);
		
    	}


	}


	public function getMasterTblList(Request $request){


		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');
		$dbName       = $request->session()->get('dbName');

      $getcomcode    = explode('-', $company_name);
      $compCode = $getcomcode[0];

      $masTbl = $request->input('masterTblName');

      $tblData1 = DB::select(DB::raw('SELECT table_name as tblName FROM information_schema.tables WHERE table_schema="'.$dbName.'" AND TABLE_NAME LIKE "MAS%"'));

  		$tblData = json_decode(json_encode($tblData1), true); 


      if($tblData){

	      $response_array['response'] = 'Success';
         $response_array['masterTbl'] = $tblData;

         $data = json_encode($response_array);

         print_r($data);

    	}else{

			$response_array['response'] = 'error';
         $response_array['masterTbl'] = '' ;

         $data = json_encode($response_array);

         print_r($data);
		
    	}


	}


	public function getTblColumnList(Request $request){


		$company_name = $request->session()->get('company_name');
		$macc_year    = $request->session()->get('macc_year');
		$usertype     = $request->session()->get('user_type');
		$userid       = $request->session()->get('userid');
		$dbName       = $request->session()->get('dbName');

		$getcomcode    = explode('-', $company_name);
		$compCode      = $getcomcode[0];

		$NameTbl       = $request->input('masterTblName');
		$NameTblStatus = $request->input('tabNameStatus');
    
      $tblData1 = DB::select(DB::raw('SELECT TABLE_NAME AS TBLNAME,COLUMN_NAME AS COLNAME,DATA_TYPE AS DATATYPE,CHARACTER_MAXIMUM_LENGTH AS COLLENGTH FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "'.$NameTbl.'" AND TABLE_SCHEMA = "'.$dbName.'"'));

  		$tblData = json_decode(json_encode($tblData1), true); 

      if($tblData){

			$response_array['response']   = 'Success';
			$response_array['tblColList'] = $tblData;
			$response_array['tblStatus']  = $NameTblStatus;

         $data = json_encode($response_array);

         print_r($data);

    	}else{

			$response_array['response']   = 'error';
			$response_array['tblColList'] = '';
			$response_array['tblStatus']  = '';

         $data = json_encode($response_array);

         print_r($data);
		
    	}


	}

	public function engineTblConfigSave(Request $request){


		$validator = Validator::make($request->all(), [
         'tCode'  => 'required|max:6|unique:MASTER_ENGINETBL_CONFIG,TRAN_CODE',
     	]);

     	$response_array = array();

     	DB::beginTransaction();

    	try {

	     	if($validator->fails()) {

	         return response()->json(['error'=>$validator->errors()->all()]);

	      }else{

				$compName       = $request->session()->get('company_name');
				$compcode       = explode('-', $compName);
				$getcompcode    =	$compcode[0];
				$getcompN    =	$compcode[1];
				$macc_year    = $request->session()->get('macc_year');
				$usertype     = $request->session()->get('user_type');
				$userid       = $request->session()->get('userid');

				$getSrNo     = $request->input('getSrNo');
				$tblName     = $request->input('tblName');

				if($getSrNo!='' && $tblName!=''){
					
					$masterName  = $request->input('masterName');
					$columnName  = $request->input('columnName');
					$colType     = $request->input('colType');
					$colLen      = $request->input('colLen');
					$whereClause = $request->input('whereClause');
					$tCode       = $request->input('tCode');
					$tCodeName   = $request->input('tCodeName');

					$colCount    = count($columnName);

					for ($i=0; $i < $getSrNo; $i++) { 

						if($tblName[$i] == 'MASTERS'){

							$getTblN = $masterName[$i];

						}else{

							$getTblN = $tblName[$i];
						}

						$tblExp = explode("_",$getTblN);

						$firstChr  = mb_substr($tblExp[0], 0, 1);
						$secondChr = mb_substr($tblExp[1], 0, 2);

						$tblAlias = $firstChr.''.$secondChr.'.';

						$exp  = explode(",",$columnName[$i]);
						$exp1 = explode(",",$colType[$i]);
						$exp2 = explode(",",$colLen[$i]);

						$expCount = count($exp);

						for ($j=0; $j < $expCount; $j++) { 

							$flag = 1;

							$data = array(
								"COMP_CODE"     => $getcompcode,
								"COMP_NAME"     => $getcompN,
								"FY_CODE"       => $macc_year,
								"TRAN_CODE"     => $tCode,
								"TRAN_CODENAME" => $tCodeName,
								"TABLE_NAME"    => $getTblN,
								"COLUMN_NAME"   => $exp[$j],
								"ALIAS"         => $tblAlias,
								"WHERE_CLAUSE"  => $whereClause[$i],
								"COLUMN_TYPE"   => $exp1[$j],
								"COLUMN_LEN"    => $exp2[$j],
								"FLAG"          => $flag,
								"CREATED_BY"    => $userid
							);

							$saveData = DB::table('MASTER_ENGINETBL_CONFIG')->insert($data);
						}
						
					}

				}
			
			}

			DB::commit();
			$response_array['response'] = 'success';
			$data = json_encode($response_array);
			print_r($data);

			}catch (\Exception $e) {
			   DB::rollBack();
			   //throw $e;
			   $response_array['response'] = 'error';
			   $data = json_encode($response_array);
			   print_r($data);
			}


	}

	public function SaveEngineTbleMsg(Request $request,$saveData){

		if ($saveData == 'false'){

				$request->session()->flash('alert-error', 'Data Can Not Be Save...!');
				return redirect('/configration/view-engine-table-config');

		} else {

				$request->session()->flash('alert-success', 'Data Was Successfully Save...!');
				return redirect('/configration/view-engine-table-config');

		}
	}


	public function dynamicQueryView(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

	      $title = 'View Master Engine Table Config';

	    	$userid	= $request->session()->get('userid');

	    	$userType = $request->session()->get('usertype');
	    	
	    	$fisYear =  $request->session()->get('macc_year');

	    	if($userType=='admin' || $userType=='Admin'){

	    	 $data = DB::table('MASTER_ENGINETBL_CONFIG')->groupBy('TRAN_CODE')->orderBy('ID','DESC');
	    	}
	    	elseif ($userType=='superAdmin' || $userType=='user') {

	    		$data = DB::table('MASTER_ENGINETBL_CONFIG')->groupBy('TRAN_CODE')->orderBy('ID','DESC');
	    	}
	    	else{
	    		$data='';
	    	}

	    	return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   	}

	   if(isset($compName)){

	    	return view('admin.finance.master.setting.view_enginetbl_config');

	    }else{

			return redirect('/useractivity');
		}


	}

	public function ViewEngineTblConfigChildRow(Request $request){

		$response_array = array();

			$tCode    = $request->input('tCode');
			$tCodeName  =  $request->input('tCodeName');

		if ($request->ajax()) {

	    	//DB::enableQueryLog();
	    	$ptdata = DB::table('MASTER_ENGINETBL_CONFIG')->where('TRAN_CODE',$tCode)->where('TRAN_CODENAME',$tCodeName)->get()->toArray();
	    	//dd(DB::getQueryLog());

    		if($ptdata){

    			$response_array['response'] = 'success';
	         $response_array['data'] = $ptdata;
	         $response_array['message'] = 'success';

	         $data = json_encode($response_array);

	         print_r($data);

			}else{

				$response_array['response'] = 'error';
            $response_array['data'] = '';
            $response_array['message'] = 'error';

            $data = json_encode($response_array);

            print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
            $response_array['data'] = '' ;
            $response_array['message'] = 'error';

            $data = json_encode($response_array);

            print_r($data);
	    }

   }

   public function EditengineTableConfig($tCode){

    	$title = 'Edit Engine Table Config';

    	$tCode = base64_decode($tCode);


    	if($tCode!=''){
    	   $query = DB::table('MASTER_ENGINETBL_CONFIG')->where('TRAN_CODE', $tCode);
    	   $query2 = DB::table('MASTER_ENGINETBL_CONFIG')->where('TRAN_CODE', $tCode)->groupBy('TABLE_NAME')->Orderby('ID', 'ASC');

			$engineData['col_list'] = $query->get();
			$engineData['table_list'] = $query2->get();
    	  
			return view('admin.finance.master.setting.edit_engineTableConfig', $engineData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Company Not Found...!');
			return redirect('/configration/view-engine-table-config');
		}
   }

   public function UpdateEngineTbleCofnig(Request $request){

     	$response_array = array();

			$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			$getcompN    =	$compcode[1];
			$macc_year   = $request->session()->get('macc_year');
			$usertype    = $request->session()->get('user_type');
			$userid      = $request->session()->get('userid');

			$getSrNo     = $request->input('getSrNo');
			$tblName     = $request->input('tblName');

		DB::beginTransaction();

		try {

			if($getSrNo!='' && $tblName!=''){
				
				$masterName  = $request->input('masterName');
				$columnName  = $request->input('columnName');
				$colType     = $request->input('colType');
				$colLen      = $request->input('colLen');
				$whereClause = $request->input('whereClause');
				$tCode       = $request->input('tCode');
				$tCodeName   = $request->input('tCodeName');

				DB::table('MASTER_ENGINETBL_CONFIG')->where('TRAN_CODE',$tCode)->where('CREATED_BY',$userid)->delete();

				$colCount    = count($columnName);

				for ($i=0; $i < $getSrNo; $i++) { 

					if($tblName[$i] == 'MASTERS'){

						$getTblN = $masterName[$i];

					}else{

						$getTblN = $tblName[$i];
					}

					$tblExp = explode("_",$getTblN);

					$firstChr  = mb_substr($tblExp[0], 0, 1);
					$secondChr = mb_substr($tblExp[1], 0, 2);

					$tblAlias = $firstChr.''.$secondChr.'.';

					$exp  = explode(",",$columnName[$i]);
					$exp1 = explode(",",$colType[$i]);
					$exp2 = explode(",",$colLen[$i]);

					$expCount = count($exp);

					for ($j=0; $j < $expCount; $j++) { 

						$flag = 1;

						$data = array(
								"COMP_CODE"     => $getcompcode,
								"COMP_NAME"     => $getcompN,
								"FY_CODE"       => $macc_year,
								"TRAN_CODE"     => $tCode,
								"TRAN_CODENAME" => $tCodeName,
								"TABLE_NAME"    => $getTblN,
								"COLUMN_NAME"   => $exp[$j],
								"ALIAS"         => $tblAlias,
								"WHERE_CLAUSE"  => $whereClause[$i],
								"COLUMN_TYPE"   => $exp1[$j],
								"COLUMN_LEN"    => $exp2[$j],
								"FLAG"          => $flag,
								"CREATED_BY"    => $userid
							);

							DB::table('MASTER_ENGINETBL_CONFIG')->insert($data);
					}

				}

			}

			DB::commit();
			$response_array['response'] = 'success';
		    $data = json_encode($response_array);
		    print_r($data);

		}catch (\Exception $e) {
		    DB::rollBack();
		    //throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}
		
	}

	public function updateEngineTbleMsg(Request $request,$saveData){

		if ($saveData == 'false'){

				$request->session()->flash('alert-error', 'Data Can Not Be Save...!');
				return redirect('/configration/view-engine-table-config');

		} else {

				$request->session()->flash('alert-success', 'Data Was Successfully Save...!');
				return redirect('/configration/view-engine-table-config');

		}
	}

	public function DeletEnginTble(Request $request){

		$tranCode = $request->post('tranCode');
    	
    	if($tranCode!='') {

    		try{
    		
	    		$Delete = DB::table('MASTER_ENGINETBL_CONFIG')->where('TRAN_CODE', $tranCode)->delete();

				if ($Delete) {

					$request->session()->flash('alert-success', 'Data Was Deleted Successfully...!');
					return redirect('/configration/view-engine-table-config');

				} else {

					$request->session()->flash('alert-error', 'Data Can Not Deleted...!');
					return redirect('/configration/view-engine-table-config');

				}
			}
			catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Data be be Updated...! Used In Another Transaction...!');
					return redirect('/configration/view-engine-table-config');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Data Not Found...!');
			return redirect('/configration/view-engine-table-config');

    	}

	}


	// Start Master Remark

	public function MasterRemark(Request $request){

		$title = 'Add Master Remark';

		$t_code = $request->old('t_code');
		$t_name = $request->old('t_name');
		$srno   = $request->old('srno');
		$remark = $request->old('remark');
		$id = $request->old('id');
		$action = 'form-master-remark-save';
		$button = 'Save';

		$data['tranCodeList'] = DB::table('MASTER_TRANSACTION')->orderBy('TRAN_CODE','asc')->get();
    	
    	return view('admin.finance.master.setting.master_remark',$data+compact('title','t_code','t_name','srno','remark','action','button','id'));

	}

	public function MasterRemarkSave(Request $request){
     // print_r('hell0');exit();

     $validate = $this->validate($request, [

     	't_code'  => 'required',
     	't_name'  => 'required',
     	'srno'  => 'required',
     	'remark'  => 'required',
     ]);

      $createdBy = $request->session()->get('userid');
      $fisYear =  $request->session()->get('macc_year');
      $compName    = $request->session()->get('company_name');

		$getcompcode = explode('-', $compName);
		$comp_code   =	$getcompcode[0];
		$comp_name   =	$getcompcode[1];

      $data = array(

			"COMP_CODE"  => $comp_code,
			"COMP_NAME"  => $comp_name,
			"FY_CODE"    => $fisYear,
			"TRAN_CODE"  => $request->input('t_code'),
			"TRAN_NAME"  => $request->input('t_name'),
			"SRNO"       => $request->input('srno'),
			"REMARK"     => $request->input('remark'),
			"FLAG"       => 0,
			"CREATED_BY" => $createdBy,
         
      );

      $saveData = DB::table('MASTER_REMARK')->insert($data);
      
      if($saveData){

      	$request->session()->flash('alert-success', 'Tran Code Remark Add Successfully...!');
			return redirect('/Master/Setting/View-Master-Remark');

      }else{

      	$request->session()->flash('alert-error', 'Tran Code Remark Can not Saved!');
			return redirect('/Master/Setting/Master-Remark');

      }
	}

	public function EditMasterRemark(Request $request,$id){

		$title = 'Edit Master Remark';

		$compName    = $request->session()->get('company_name');

		$getcompcode = explode('-', $compName);
		$comp_code   =	$getcompcode[0];
		$comp_name   =	$getcompcode[1];
		$userdata['tranCodeList'] = DB::table('MASTER_TRANSACTION')->orderBy('TRAN_CODE','asc')->get();

    	$id = base64_decode($id);
    	
    	if($id!=''){

    	   $data = DB::table('MASTER_REMARK')->where('ID',$id)->where('COMP_CODE',$comp_code)->get()->first();

			$t_code = $data->TRAN_CODE;
			$t_name = $data->TRAN_NAME;
			$srno   = $data->SRNO;
			$remark = $data->REMARK;
			$id     = $data->ID;
			$button ='Update';
			$action = 'form-mast-remark-update';


			return view('admin.finance.master.setting.master_remark', $userdata+compact('title','t_code','t_name','srno','remark','button','action','id'));
		}else{
			$request->session()->flash('alert-error', 'Company Not Found...!');
			return redirect('/Master/Setting/View-Company-Mast');
		}

	}

	public function MasterRemarkUpdate(Request $request){

		$validate = $this->validate($request, [

     	't_code'  => 'required',
     	't_name'  => 'required',
     	'srno'  => 'required',
     	'remark'  => 'required',
     ]);

		$createdBy   = $request->session()->get('userid');
		$fisYear     = $request->session()->get('macc_year');
		$compName    = $request->session()->get('company_name');
		$id          = $request->input('remark_id');

		$getcompcode = explode('-', $compName);
		$comp_code   =	$getcompcode[0];
		$comp_name   =	$getcompcode[1];
		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");


      $data = array(

			"COMP_CODE"  => $comp_code,
			"COMP_NAME"  => $comp_name,
			"FY_CODE"    => $fisYear,
			"TRAN_CODE"  => $request->input('t_code'),
			"TRAN_NAME"  => $request->input('t_name'),
			"SRNO"       => $request->input('srno'),
			"REMARK"     => $request->input('remark'),
			"FLAG"       => 0,
			"UPDATED_BY" => $createdBy,
			"UPDATED_DATE"=> $updatedDate,
         
      );
      //print_r($data);exit();

      $saveData = DB::table('MASTER_REMARK')->where('ID',$id)->update($data);
      
      if($saveData){

      	$request->session()->flash('alert-success', 'Tran Code Remark Update Successfully...!');
			return redirect('/Master/Setting/View-Master-Remark');

      }else{

      	$request->session()->flash('alert-error', 'Tran Code Remark Can not Update!');
			return redirect('/Master/Setting/View-Master-Remark');

      }
	}

	public function MasterRemarkDelete(Request $request){

		$remark_id = $request->post('tcoderemrk_id');
		// print_r($remark_id);exit();

		$compName    = $request->session()->get('company_name');
		$getcompcode = explode('-', $compName);
		$comp_code   =	$getcompcode[0];

    	if ($remark_id!='') {
    		
    		$Delete = DB::table('MASTER_REMARK')->where('COMP_CODE', $comp_code)->where('ID',$remark_id)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Master Remark Deleted Successfully...!');
				return redirect('/Master/Setting/View-Master-Remark');

			} else {

				$request->session()->flash('alert-error', 'Master Remark Can Not Deleted...!');
				return redirect('/Master/Setting/View-Master-Remark');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Master Remark Not Found...!');
			return redirect('/Master/Setting/View-Master-Remark');

    	}
	}

	public function TCodeInformation(Request $request){

   	 $response_array = array();


       if ($request->ajax()) {
			
				$tran_code     = $request->tcode;

				$fetch_reocrd = DB::table('MASTER_REMARK')->where('TRAN_CODE',$tran_code)->get();


				$countData = count($fetch_reocrd);
				
				if ($countData == 0 ) {

        	      $srno = 1;

					$response_array['response']    = 'success';

					$response_array['data']        = $srno;
					
					$data = json_encode($response_array);

	            print_r($data);

	        }else{

	        	      $lastRecord = $fetch_reocrd->last();

	        	      $srno = $lastRecord->SRNO;

	        	      $srNo = $srno+1;

	        	      // print_r($srNo);exit();
	        	      

						$response_array['response'] = 'success';

						$response_array['data']     = $srNo ;

	              $data = json_encode($response_array);

	              print_r($data);
	              
	        }

      }
      else{

        $response_array['response'] = 'error';

        $response_array['data'] = '';

        $data = json_encode($response_array);

        print_r($data);
      
      }
   }

   public function MasterRemarkView(Request $request){

   $compName = $request->session()->get('company_name');
   // $data = DB::table('MASTER_REMARK')->orderBy('ID','DESC')->get();
   // print_r($data);exit();

	if($request->ajax()){
      
      $title    = 'View Master Remark';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');

		$getcompcode = explode('-',$compName);
		$comp_code = $getcompcode[0];
		
		$fisYear  =  $request->session()->get('macc_year');

	   if($userType=='admin'){

	    	$data = DB::table('MASTER_REMARK')->where('COMP_CODE',$comp_code)->orderBy('TRAN_CODE','desc');

      }else if ($userType=='superAdmin' || $userType=='user'){    		

	    	$data = DB::table('MASTER_REMARK')->where('COMP_CODE',$comp_code)->orderBy('TRAN_CODE','desc');

	   }else{
	    		$data ='';
	   }

	   // return DataTables::queryBuilder($data)->addIndexColumn()->toJson();
	   return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){
    	
    	return view('admin.finance.master.setting.view_master_remark');
	
	}else{

		return redirect('/useractivity');
	}
}

	// End Master Remark

// START EXCEL CONFIGURATION

public function ExcelConfiguration(Request $request){

   $title = 'Add Excel Configuration';

   $compName = $request->session()->get('company_name');

   $getcompcode = explode('-',$compName);
   $comp_code = $getcompcode[0];
		
	$fisYear  =  $request->session()->get('macc_year');

  

	return view('admin.finance.master.setting.excel_config',compact('title'));


}

public function ExcelTblCol(Request $request){

	$tran_name = $request->input('trancode');

	$dbname =  $request->session()->get('dbName');

    $compName = $request->session()->get('company_name');

    $getcompcode = explode('-',$compName);

    $comp_code = $getcompcode[0];
		
    $fisYear  =  $request->session()->get('macc_year');

	$response_array = array();

	if($tran_name != ''){

		if($tran_name == 'DO'){

			// $tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'DORDER_BODY' ");

			$tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND  TABLE_NAME = 'DORDER_BODY' ");

			$series_list = DB::table('MASTER_CONFIG')->where('COMP_CODE',$comp_code)->where('TRAN_CODE','T0')->orderBy('SERIES_CODE','ASC')->get()->toArray();

			$response_array['response'] = 'success';

         $response_array['data'] = $tblList;

         $response_array['data_series'] = $series_list;

         $data = json_encode($response_array);

         print_r($data);


      }else if($tran_name == 'RAKE'){
         
         // $tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'LR_BODY' ");

          $tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND  TABLE_NAME = 'RACK_TRAN' ");

          $series_list = DB::table('MASTER_CONFIG')->where('COMP_CODE',$comp_code)->where('TRAN_CODE','T3')->orderBy('SERIES_CODE','ASC')->get()->toArray();

         $response_array['response'] = 'success';

         $response_array['data'] = $tblList;

         $response_array['data_series'] = $series_list;

         $data = json_encode($response_array);

         print_r($data);

      }else if($tran_name == 'LR'){
         
         // $tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'LR_BODY' ");

          $tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND  TABLE_NAME = 'TRIP_BODY' ");

          $series_list = DB::table('MASTER_CONFIG')->where('COMP_CODE',$comp_code)->where('TRAN_CODE','T3')->orderBy('SERIES_CODE','ASC')->get()->toArray();

         $response_array['response'] = 'success';

         $response_array['data'] = $tblList;

         $response_array['data_series'] = $series_list;

         $data = json_encode($response_array);

         print_r($data);

      }else if($tran_name == 'SO'){
         
         // $tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'LR_BODY' ");

          $tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND  TABLE_NAME = 'FSO_BODY' ");

          $series_list = DB::table('MASTER_CONFIG')->where('COMP_CODE',$comp_code)->where('TRAN_CODE','T1')->orderBy('SERIES_CODE','ASC')->get()->toArray();

         $response_array['response'] = 'success';

         $response_array['data'] = $tblList;

         $response_array['data_series'] = $series_list;

         $data = json_encode($response_array);

         print_r($data);

      }
      else if($tran_name == 'EPROC'){
         
         // $tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'LR_BODY' ");

          $tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND  TABLE_NAME = 'SBILL_HEAD_PROV' ");

          $series_list = DB::table('MASTER_CONFIG')->where('COMP_CODE',$comp_code)->where('TRAN_CODE','T1')->orderBy('SERIES_CODE','ASC')->get()->toArray();

         $response_array['response'] = 'success';

         $response_array['data'] = $tblList;

         $response_array['data_series'] = $series_list;

         $data = json_encode($response_array);

         print_r($data);

      }
      else{
      	$tblList = '';

      	$response_array['response'] = 'error';

         $response_array['data'] = '';

         $data = json_encode($response_array);

         print_r($data);
      }

	}else{
		$tblList = '';

		   $response_array['response'] = 'error';

         $response_array['data'] = $tblList;

         $data = json_encode($response_array);

         print_r($data);
	}
}

public function ExcelConfigSave(Request $request){

	$companyName      = $request->session()->get('company_name');

	$getcompcode      = explode('-',$companyName);

	$comp_code        = $getcompcode[0];
	$comp_name        = $getcompcode[1];

	$fy_year          = $request->session()->get('macc_year');
	$createdBy        = $request->session()->get('userid');

	$tran_name        = $request->input('tran_name');
	$tran_code        = $request->input('tran_code');
	$excelCfgCode     = $request->input('excelCfgCode');
	$excelCfgName     = $request->input('excelCfgName');
	$all_tblCol       = $request->input('all_tblCol');
	$all_excelCol     = $request->input('all_excelCol');
	$all_tempExcelCol = $request->input('all_tempExcelCol');


	$chkTraData = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE',$tran_code)->where('EXLCONFIG_CODE',$excelCfgCode)->get()->first();

	$response_array = array();

	if($chkTraData == ''){

		$count   = count($all_tblCol);

		for($i=0;$i<$count;$i++){

			$data = array(
				"COMP_CODE"      => $comp_code,
				"COMP_NAME"      => $comp_name,
				"TRAN_CODE"      => $tran_code,
				"TRAN_NAME"      => $tran_name,
				"EXLCONFIG_CODE" => $excelCfgCode,
				"EXLCONFIG_NAME" => $excelCfgName,
				"TBL_COL"        => $all_tblCol[$i],
				"EXCEL_COL"      => $all_excelCol[$i],
				"TEMPEXCEL_COL"  => $all_tempExcelCol[$i],
				"FLAG"           => 0,
				"CREATED_BY"     => $createdBy,
			);

			$savedata = DB::table('MASTER_EXCELCONFIG')->insert($data);
		}
		if($savedata){

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

public function ExcelConfigView(Request $request){

	if ($request->ajax()) {

			$title = 'View Excel Configuration';

			$user_type = $request->session()->get('user_type');

			$userid = $request->session()->get('userid');

			$company   = $request->session()->get('company_name');
			$getcompcode = explode('-', $company);
			$comp_code = $getcompcode[0];
			$comp_name = $getcompcode[1];

			$fisYear   = $request->session()->get('macc_year');

			// if($user_type == 'admin'){

			$data = DB::table('MASTER_EXCELCONFIG')->groupBy(['TRAN_CODE','EXLCONFIG_CODE'])->orderBy('ID','DESC');

			// }else if($user_type == 'superAdmin' || $user_type == 'user'){

			// $data = DB::table('MASTER_EXCELCONFIG')->where('COMP_CODE', $comp_code)->groupBy('TRAN_CODE')->orderBy('ID','DESC');
			// }	
			
			return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

		}

		
		return view('admin.finance.master.setting.view_excel_config');
}

public function ViewExcelConfigChild(Request $request){

    $response_array = array();

    if ($request->ajax()) {

        $tran_code = $request->input('tran_code');
        
        $trancodeData = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE', $tran_code)->get()->toArray();
        

        if($trancodeData) {

            $response_array['response'] = 'success';
            $response_array['data'] = $trancodeData;
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

    public function EditExcelConfig(Request $request, $tranCode,$exlConfigCode){

    	$title = 'Edit Excel Configuration';

		$compName    = $request->session()->get('company_name');

		$getcompcode = explode('-', $compName);
		$comp_code   =	$getcompcode[0];
		$comp_name   =	$getcompcode[1];
        
	    $tranCode = base64_decode($tranCode);
	    $exlConfigCode = base64_decode($exlConfigCode);

	    if($tranCode!=''){

    	   $data = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE',$tranCode)->where('EXLCONFIG_CODE',$exlConfigCode)->where('COMP_CODE',$comp_code)->get()->toArray();

    	    $dbname =  $request->session()->get('dbName');
    	    // print_r($dbname);exit();
            $countData = count($data);

    	   if($countData > 0){
				$trancode   = $data[0]->TRAN_CODE;
				$configC    = $data[0]->EXLCONFIG_CODE;
				$configName = $data[0]->EXLCONFIG_NAME;
				$tranname   = $data[0]->TRAN_NAME;
    	   }else{

    	   	    $trancode   = '';
				$configC    = '';
				$configName = '';
				$tranname   = '';

    	   }

		   if($tranCode == 'DO'){

			  $tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND  TABLE_NAME = 'DORDER_BODY' ");

		   }else if($tranCode == 'LR'){

		   	$tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = 'LR_BODY' ");
		   	
		   }else if($tranCode == 'RAKE'){

		   	  $tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND  TABLE_NAME = 'RACK_TRAN' ");
		   	  // print_r($tblList);exit();
		   	
		   }else if($tranCode == 'SO'){

		   	  $tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND  TABLE_NAME = 'FSO_BODY' ");
		   	
		   }else if($tranCode == 'EPROC'){

		   	  $tblList = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND  TABLE_NAME = 'SBILL_HEAD_PROV' ");
		   	
		   }else{
		   	$tblList = '';
		   }

           // echo '<PRE>';print_r($tblList);exit();
			return view('admin.finance.master.setting.edit_excel_config', $data+compact('title','countData','data','tranname','trancode','configC','configName','tblList'));

		}else{

			$request->session()->flash('alert-error', 'Excel Configuration Not Found...!');
			return redirect('/Master/Setting/View-Excel-Configuration');

		}
    }

   public function ExcelConfigUpdate(Request $request){
   
	   $companyName  = $request->session()->get('company_name');

		$getcompcode  = explode('-',$companyName);

		$comp_code    = $getcompcode[0];
		$comp_name    = $getcompcode[1];

		$fy_year      = $request->session()->get('macc_year');
		$createdBy    = $request->session()->get('userid');

		$id           = $request->input('all_excelCId');
		$tran_name    = $request->input('tran_name');
		$tran_code    = $request->input('tran_code');
		$all_tblCol   = $request->input('all_tblCol');
		$all_excelCol = $request->input('all_excelCol');
		$all_tempExcelCol = $request->input('all_tempExcelCol');
		$excelCfgCode     = $request->input('excelCfgCode');
		$excelCfgName     = $request->input('excelCfgName');
		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d H:i:s");


      //echo '<PRE>';print_r($excelCfgName);echo '</PRE>';exit();
		$response_array = array();

		$count   = count($all_tblCol);

        // print_r($count );
        $savedata1 = array();

        for($i=0;$i<$count;$i++){

        	if($id[$i] != ''){

        		$deldata = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE',$tran_code)->where('ID',$id[$i])->delete();
        	}

       
        }

       
		for($i=0;$i<$count;$i++){

			// $data = array(
			// 	"EXLCONFIG_NAME" => $excelCfgName,
			// 	"TBL_COL"        => $all_tblCol[$i],
			// 	"EXCEL_COL"      => $all_excelCol[$i],
			// 	"TEMPEXCEL_COL"  => $all_tempExcelCol[$i],
			// 	"FLAG"           => 0,
			// 	"UPDATED_BY"     => $createdBy,
			// );

			// echo '<PRE>';print_r($i);


            // if($id[$i] != ''){

            	// $savedata = DB::table('MASTER_EXCELCONFIG')->where('TRAN_CODE',$tran_code)->where('ID',$id[$i])->update($data);

            // }else{
			$data = array(
				"COMP_CODE"      => $comp_code,
				"COMP_NAME"      => $comp_name,
				"TRAN_CODE"      => $tran_code,
				"TRAN_NAME"      => $tran_name,
				"EXLCONFIG_CODE" => $excelCfgCode,
				"EXLCONFIG_NAME" => $excelCfgName,
				"TBL_COL"        => $all_tblCol[$i],
				"EXCEL_COL"      => $all_excelCol[$i],
				"TEMPEXCEL_COL"  => $all_tempExcelCol[$i],
				"FLAG"           => 0,
				"UPDATED_BY"     => $createdBy,
				"UPDATED_DATE"     => $updatedDate,
			);
            	$savedata = DB::table('MASTER_EXCELCONFIG')->insert($data);
            // }
   //          $savedata = '';
			// echo '<PRE>';print_r($data);

			if($savedata){
               $savedata1[] = $savedata;
			}else{
                $savedata1[] = '';
			}
		}

		// print_r('hello');exit();
        $getcount = count($savedata1);

		if($getcount > 0){

			$response_array['response'] = 'success';
			$response_array['data'] = $savedata;
			
			echo $data = json_encode($response_array);

		}else{

			$response_array['response'] = 'error';
			$response_array['data'] = $savedata;
			
			echo $data = json_encode($response_array);

		}

		
    }

    public function SuccessMessage(Request $request,$getName){
       $transName = base64_decode($getName);
       $userid    = $request->session()->get('userid');

       if($transName == 'ExcelConfig')
       {
       	  	$request->session()->flash('alert-success', 'Excel Configuration is Successfully Saved...!');
				return redirect('/Master/Setting/View-Excel-Configuration');
       } 
    }

    

    public function ProfileRights(Request $request){

		$title      = 'User Profile Right';

		$userid     = $request->session()->get('userid');
		
		$userType   = $request->session()->get('usertype');
		
		$compName   = $request->session()->get('company_name');
		
		$fisYear    =  $request->session()->get('macc_year');

		$getcomcode = explode('-', $compName);

		$comp_code  = $getcomcode[0];

		$userData['comp_data'] = DB::table('MASTER_FY')
										->join('MASTER_COMP', 'MASTER_FY.COMP_CODE', '=', 'MASTER_COMP.COMP_CODE')
										->select('MASTER_FY.*', 'MASTER_COMP.*')
										->orderBy('MASTER_COMP.COMP_CODE','ASC')
										->get()->toArray();

		$userData['pfct_data'] = DB::table('MASTER_PFCT')->where('COMP_CODE',$comp_code)->orderBy('PFCT_CODE','ASC')->get()->toArray();

		$userData['plant_data'] = DB::table('MASTER_PLANT')->where('COMP_CODE',$comp_code)->orderBy('PLANT_CODE','ASC')->get()->toArray();

		$userData['transaction_data'] = DB::table('MASTER_CONFIG')->where('COMP_CODE',$comp_code)->orderBy('SERIES_CODE','ASC')->get()->toArray();
		// DB::enableQueryLog();
		$userData['master_form']  =  DB::table('USERACCESS_FORM')->whereIn('MENU_NAME',["Master Configuration","System"])->where([['SUBMENU_NAME','!=','Master'],['FORM_NAME','NOT LIKE','%View'],['FORM_NAME','NOT LIKE','%Edit'],['FORM_NAME','NOT LIKE','%Delete']])->orderBy('FORM_NAME','ASC')->get();

		// dd(DB::getQueryLog());

		$userData['master_form_one']  =  DB::table('USERACCESS_FORM')->where([['SUBMENU_NAME','=','Master'],['MENU_NAME','!=','Master Configuration'],['FORM_NAME','NOT LIKE','%View'],['FORM_NAME','NOT LIKE','%Edit'],['FORM_NAME','NOT LIKE','%Delete']])->orderBy('FORM_NAME','ASC')->get();

		$userData['report_form']  =  DB::table('USERACCESS_FORM')->where([['submenu_name','=','Reports']])->get()->toArray();

		$userData['form_list']  =  DB::table('USERACCESS_FORM')->where([['SUBMENU_NAME','=','Transaction'],['FORM_NAME','NOT LIKE','%View'],['FORM_NAME','NOT LIKE','%Edit'],['FORM_NAME','NOT LIKE','%Delete']])->orderBy('FORM_NAME','ASC')->get();

		$userProf = DB::select("SELECT MAX(PROFILE_CODE) as PROFILE_CODE FROM USER_RIGHTFORM");
		
		$DataUserProf = json_decode(json_encode($userProf), true);

		if(empty($DataUserProf[0]['PROFILE_CODE'])){
			$profNo = 'PROF01';
		}else{
			$numbers = preg_replace('/[^0-9]/', '', $DataUserProf[0]['PROFILE_CODE']);
			$genNo = $numbers+1;
			$profNo = 'PROF0'.$genNo;
		}

   
    	return view('admin.finance.master.setting.user_profile_rights',$userData+compact('title','profNo'));
    }


    public function UserRightSave(Request $request){

    	$validate = $this->validate($request, [

			'user_profile_code'  => 'required|max:10|unique:USER_RIGHTFORM,PROFILE_CODE'

		]);


		$userProCode      = $request->input('user_profile_code');
		$userProName      = $request->input('user_profile');
		$getComp      		= $request->input('getComp');
		
		$compC = count($getComp);
		
		$createdBy        = $request->session()->get('userid');
		$userid           = $request->session()->get('userid');

		$masterFmCount    = $request->input('masterFmCount');
		$masterFmOneCount = $request->input('masterFmOneCount');
		$pfctNmCount      = $request->input('pfctNmCount');
		$plantNmCount     = $request->input('plantNmCount');
		$tranNmCount      = $request->input('tranNmCount');
		

		$formNmCount      = $request->input('formNmCount');
		$reportNmCount    = $request->input('reportNmCount');

		$getChcekAll      = $request->input('chkAll');

		$totalCt = $masterFmCount + $masterFmOneCount + $pfctNmCount + $plantNmCount + $tranNmCount;

		if($compC > 0){

			for ($i=0; $i < $compC; $i++) { 

				if(!empty($getComp[$i])){

					$formname = $getComp[$i];

					$formcode = explode('_', $formname);

					$Flag = 1;

					$view   = 'YES';
					$add    = 'NO';
					$edit   = 'NO';
					$delete = 'NO';

					$data=array(
					'PROFILE_CODE' => $userProCode,
					'PROFILE_NAME' => $userProName,
					'FORMCODE'     => $formcode[0],
					'FORMNAME'     => $formcode[1],
					'ADD_FORM'     => $add,
					'EDIT_FORM'    => $edit,
					'DELETE_FORM'  => $delete,
					'VIEW_FORM'    => $view,
					'FLAG'    		=> $Flag,
					'CREATED_BY'   => $createdBy
	    			);

	     	   	
	     	     $saveData0 = DB::table('USER_RIGHTFORM')->insert($data);
				 
				}


			}


		}


		if($getChcekAll == 'selectAll'){

				$Flag = 1;

				$checkAllVal = '*';

				$data=array(
					'PROFILE_CODE' => $userProCode,
					'PROFILE_NAME' => $userProName,
					'MENU_NAME'    => $checkAllVal,
					'SUBMENU_NAME' => $checkAllVal,
					'FORMCODE'     => $checkAllVal,
					'FORMNAME'     => $checkAllVal,
					'FORM_LINK'    => $checkAllVal,
					'ADD_FORM'     => $checkAllVal,
					'EDIT_FORM'    => $checkAllVal,
					'DELETE_FORM'  => $checkAllVal,
					'VIEW_FORM'    => $checkAllVal,
					'FLAG'    		=> $Flag,
					'CREATED_BY'   => $createdBy
    			);

     	   	
     	     $saveData = DB::table('USER_RIGHTFORM')->insert($data);


		}else{
		
			if ($totalCt > 0) {

				for ($j=0; $j < $totalCt; $j++) { 

					if(!empty($request->input('form_name_'.$j))){

						$formname = $request->input('form_name_'.$j);

						$formcode = explode('_', $formname);

						$add = $request->input('add_'.$j);
						if(!empty($add)){
							$add ='YES';
						}else{
							$add ='NO';	
						}

						$edit = $request->input('edit_'.$j);

						if(!empty($edit)){
							$edit ='YES';
						}else{
							$edit ='NO';	
						}
						$delete   = $request->input('delete_'.$j);

						if(!empty($delete)){
							$delete ='YES';
						}else{
							$delete ='NO';	
						}
						$view     = $request->input('view_'.$j);

						if(!empty($view)){
							$view ='YES';
						}else{
							$view ='NO';	
						}

						if (isset($formcode[5]) && isset($formcode[6])) {

							$getFormCode = $formcode[0]."_".$formcode[6]."_".$formcode[5];

							$Flag = 2;
							
						}else{

							$getFormCode = $formcode[0];

							$Flag = 1;

						}

						

						$data=array(
						'PROFILE_CODE' => $userProCode,
						'PROFILE_NAME' => $userProName,
						'MENU_NAME'    => $formcode[2],
						'SUBMENU_NAME' => $formcode[3],
						'FORMCODE'     => $getFormCode,
						'FORMNAME'     => $formcode[1],
						'FORM_LINK'    => $formcode[4],
						'ADD_FORM'     => $add,
						'EDIT_FORM'    => $edit,
						'DELETE_FORM'  => $delete,
						'VIEW_FORM'    => $view,
						'FLAG'    		=> $Flag,
						'CREATED_BY'   => $createdBy
		    			);

		     	   	
		     	     $saveData = DB::table('USER_RIGHTFORM')->insert($data);
					 
					}


				}
				
			}

			
			if($formNmCount > 0){

				for ($s=11111; $s < $formNmCount; $s++) { 

					if(!empty($request->input('form_name_'.$s))){

						$formname = $request->input('form_name_'.$s);

						$formcode = explode('_', $formname);

						$add = $request->input('add_'.$s);
						if(!empty($add)){
							$add ='YES';
						}else{
							$add ='NO';	
						}

						$edit = $request->input('edit_'.$s);

						if(!empty($edit)){
							$edit ='YES';
						}else{
							$edit ='NO';	
						}
						$delete   = $request->input('delete_'.$s);

						if(!empty($delete)){
							$delete ='YES';
						}else{
							$delete ='NO';	
						}
						$view     = $request->input('view_'.$s);

						if(!empty($view)){
							$view ='YES';
						}else{
							$view ='NO';	
						}

						$Flag = 1;

						$data=array(
						'PROFILE_CODE' => $userProCode,
						'PROFILE_NAME' => $userProName,
						'MENU_NAME'    => $formcode[2],
						'SUBMENU_NAME' => $formcode[3],
						'FORMCODE'     => $formcode[0],
						'FORMNAME'     => $formcode[1],
						'FORM_LINK'    => $formcode[4],
						'ADD_FORM'     => $add,
						'EDIT_FORM'    => $edit,
						'DELETE_FORM'  => $delete,
						'VIEW_FORM'    => $view,
						'FLAG'    		=> $Flag,
						'CREATED_BY'   => $createdBy
		    			);

		     	   	
		     	     $saveData1 = DB::table('USER_RIGHTFORM')->insert($data);
					 
					}


				}

			}
			
			if ($reportNmCount > 0) {

				for ($u=99999; $u < $reportNmCount; $u++) { 

					if(!empty($request->input('form_name_'.$u))){

						$formname = $request->input('form_name_'.$u);

						$formcode = explode('_', $formname);

						$add = $request->input('add_'.$u);
						if(!empty($add)){
							$add ='YES';
						}else{
							$add ='NO';	
						}

						$edit = $request->input('edit_'.$u);

						if(!empty($edit)){
							$edit ='YES';
						}else{
							$edit ='NO';	
						}
						$delete   = $request->input('delete_'.$u);

						if(!empty($delete)){
							$delete ='YES';
						}else{
							$delete ='NO';	
						}
						$view     = $request->input('view_'.$u);

						if(!empty($view)){
							$view ='YES';
						}else{
							$view ='NO';	
						}

						$Flag = 1;

						$data=array(
						'PROFILE_CODE' => $userProCode,
						'PROFILE_NAME' => $userProName,
						'MENU_NAME'    => $formcode[2],
						'SUBMENU_NAME' => $formcode[3],
						'FORMCODE'     => $formcode[0],
						'FORMNAME'     => $formcode[1],
						'FORM_LINK'    => $formcode[4],
						'ADD_FORM'     => $add,
						'EDIT_FORM'    => $edit,
						'DELETE_FORM'  => $delete,
						'VIEW_FORM'    => $view,
						'FLAG'    		=> $Flag,
						'CREATED_BY'   => $createdBy
		    			);

		     	   	
		     	    $saveData2 = DB::table('USER_RIGHTFORM')->insert($data);
					 
					}


				}
				
			}

		}
		

		if ($saveData0) {

			$request->session()->flash('alert-success', 'User Profile Was Successfully Created...!');
			return redirect('/master/setting/view-user-profile-right');

		} else {

			$request->session()->flash('alert-error', 'User Profile Can Not Be Created...!');
			return redirect('/master/setting/view-user-profile-right');

		}


   }

   public function UserViewRight(Request $request){


   	$compName = $request->session()->get('company_name');

        if($request->ajax()) {
    
            $title ='View User Profile Right';
    
            $userid    = $request->session()->get('userid');
    
            $userType = $request->session()->get('usertype');
    
            $compName = $request->session()->get('company_name');
    		
	    		$explode          = explode('-', $compName);
	    		$getcom_code      = $explode[0];
            $fisYear =  $request->session()->get('macc_year');
    
           
           	$data = DB::table('USER_RIGHTFORM')->groupBy('PROFILE_CODE')->orderBy('ID','DESC');
            

        	   return DataTables()->of($data)->addIndexColumn()->make(true);

         }else{
		    		$data ='';
		   }

      if(isset($compName)){

       	return view('admin.finance.master.setting.view_user_profile_right');
      }else{

			return redirect('/useractivity');

		}

    }


    public function UserViewRightChildRow(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$proID   = $request->input('profID');
		   $proCode = $request->input('profCode');

	    	$userRightQuery = DB::table('USER_RIGHTFORM')->where('PROFILE_CODE',$proCode)->get();

	    	$getCount = count($userRightQuery);

    		if ($userRightQuery) {

				$response_array['response'] = 'success';
				$response_array['message']  = '';
				$response_array['data']     = $userRightQuery;
				$response_array['count']    = $getCount;

            $data = json_encode($response_array);

            print_r($data);

			}else{

				$response_array['response'] = 'error';
				$response_array['message']  = 'Rights Error';
				$response_array['data']     = '' ;
				$response_array['count']    = '';

				$data = json_encode($response_array);

				print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
	    		$response_array['message']  = 'Ajax Error';
				$response_array['data']     = '' ;
				$response_array['count']    = '';

				$data = json_encode($response_array);

				print_r($data);
	    }

    }


    function getDataFromComp(Request $request){
    	
    	$getComp = $request->input('getComp');

    	if($request->ajax()) {	

			$userid	= $request->session()->get('userid');
			
			$userType = $request->session()->get('usertype');
			
			$compName = $request->session()->get('company_name');
			
			$fisYear =  $request->session()->get('macc_year');

			$getcomcode    = explode('-', $compName);
	
			$comp_code = $getcomcode[0];

			$getCount = count($getComp);

			$pfct_data = array();
			$plant_data = array();
			$config_data = array();

			for ($i = 0; $i < $getCount; ++$i){

				$formcode = explode('_', $getComp[$i]);

				$pfct_data1 = DB::table('MASTER_PFCT')->where('COMP_CODE',$formcode[0])->get()->toArray();

				array_push($pfct_data,$pfct_data1);

				$plant_data1 = DB::table('MASTER_PLANT')->where('COMP_CODE',$formcode[0])->get()->toArray();

				array_push($plant_data,$plant_data1);

				$config_data1 = DB::table('MASTER_CONFIG')->where('COMP_CODE',$formcode[0])->get()->toArray();

				array_push($config_data,$config_data1);

				
			}

			$pfct_data01 = array();

			foreach ($pfct_data as $valueGet) {

				foreach ($valueGet as $value) {

					array_push($pfct_data01,$value);

				}

			}

			$plant_data01 = array();

			foreach ($plant_data as $valueGet) {

				foreach ($valueGet as $value) {

					array_push($plant_data01,$value);

				}

			}

			$config_data01 = array();

			foreach ($config_data as $valueGet) {

				foreach ($valueGet as $value) {

					array_push($config_data01,$value);

				}

			}
			
		
			$data = 1;

			if($data){

				$response_array['response']    = 'success';
				$response_array['pfct_list']   = $pfct_data01 ;
				$response_array['plant_list']  = $plant_data01 ;
				$response_array['config_list'] = $config_data01 ;

            $data = json_encode($response_array);

            print_r($data);

			}else{

				$response_array['response'] = 'error';
				$response_array['pfct_list']   = '';
				$response_array['plant_list']  = '';
				$response_array['config_list'] = '';
            
            $data = json_encode($response_array);

            print_r($data);

			}  


    	 }


    }

    // START DATABASE CONFIG

    public function databaseConfig(Request $request){

    	$userid	= $request->session()->get('userid');
			
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear =  $request->session()->get('macc_year');
		$dbname =  $request->session()->get('dbName');

		$getcomcode    = explode('-', $compName);

		$comp_code = $getcomcode[0];

		// $db = DB::connection()->query('SHOW DATABASES');
		$userdata['database_list'] = \DB::select('SHOW DATABASES');

		// $db->query('SHOW DATABASES');

		// print_r($db);exit();

		$userdata['result'] = '';
		
    	if(isset($compName)){

       	   return view('admin.finance.master.setting.database_config',$userdata+compact('dbname'));
        
        }else{

			return redirect('/useractivity');

		}

    }

    public function listDBConfig(Request $request){
    	
		$createdBy 	= $request->session()->get('userid');
		
		$compName 	= $request->session()->get('company_name');
		
		$fisYear 	=  $request->session()->get('macc_year');

	    if($request->ajax()){

	    	$fromdb = $request->input('fromDB');

	    	$todb = $request->input('targetDB');
 			// DB::enableQueryLog();	
		 	$data = DB::select("SELECT a.TABLE_NAME, a.COLUMN_NAME, a.DATA_TYPE, a.CHARACTER_MAXIMUM_LENGTH,
			    b.COLUMN_NAME as COL_NAME, b.DATA_TYPE AS DTYPE, b.CHARACTER_MAXIMUM_LENGTH AS CMLENGTH
			FROM information_schema.COLUMNS a
			    LEFT JOIN information_schema.COLUMNS b ON b.COLUMN_NAME = a.COLUMN_NAME
			        AND b.TABLE_NAME = a.TABLE_NAME
			        AND b.TABLE_SCHEMA = '$fromdb'
			WHERE a.TABLE_SCHEMA = '$todb'
			    AND (
			        b.COLUMN_NAME IS NULL
			        OR b.COLUMN_NAME != a.COLUMN_NAME
			        OR b.DATA_TYPE != a.DATA_TYPE
			        OR b.CHARACTER_MAXIMUM_LENGTH != a.CHARACTER_MAXIMUM_LENGTH
            )"); 

            // dd(DB::getQueryLog());

            // print_r($data);

            if(isset($data)){
              return DataTables()->of($data)->addIndexColumn()->make(true);	
            }else{
               $data = array();
	    	   return DataTables()->of($data)->addIndexColumn()->make(true);	
            }

           
	    }

	    if(isset($compName)){

       	   return view('admin.finance.master.setting.database_config',compact('result'));
        
        }else{

			return redirect('/useractivity');

		}
    }

    public function updateColumn(Request $request){

    	 $response_array = array();

    	 $dbName       = $request->session()->get('dbName');

    	if($request->ajax()){

         	$tblname =  $request->tblname;
	    	$colname = $request->colname;
	    	$datatype = $request->datatype;
	    	$collength = $request->collength;
	    	$dataFlag = $request->dataFlag;
	        
		    // DB::enableQueryLog();

		    if($dataFlag != '' && $dataFlag == 0){

		    	$res = DB::select("SELECT count(*) as counttbl FROM information_schema.TABLES WHERE (TABLE_SCHEMA = '$dbName') AND (TABLE_NAME = '$tblname')");

		    	$res_col = $res[0]->counttbl;

		    	if($res_col == 0){

                    // DB::enableQueryLog();
		    		$create_tbl = DB::select("CREATE TABLE $tblname ( $colname $datatype($collength) )");

		    		if($create_tbl !=''){

						$response_array['response'] = 'success';
						echo $data = json_encode($response_array);

					}else{

						$response_array['response'] = 'error';
						echo $data = json_encode($response_array);

					}

		    		// dd(DB::getQueryLog());
		    	}else{

		    		$add_col = DB::select("ALTER TABLE $tblname ADD $colname $datatype($collength) ");

		    		if($add_col!=''){

						$response_array['response'] = 'success';
						echo $data = json_encode($response_array);

					}else{

						$response_array['response'] = 'error';
						echo $data = json_encode($response_array);

					}
		    	}

		    }else{

		    	 $result = DB::select("ALTER TABLE $tblname CHANGE $colname $colname $datatype($collength)");

		    	 if($result!=''){

					$response_array['response'] = 'success';
					echo $data = json_encode($response_array);

				 }else{

					$response_array['response'] = 'error';
					echo $data = json_encode($response_array);

				 }
		    }

	       

	        // print_r($result);

	         // $result = DB::select('ALTER TABLE `CS_GATE_ENTRY` CHANGE `FY_CODE` `FY_CODE` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;');
	       // dd(DB::getQueryLog());



	        

    	}else{

    		$response_array['response'] = 'error';
    		echo $data = json_encode($response_array);
    	}

    	
    	// print_r($result);exit();



    }
    // END DATABASE CONFIG

    // START MENU URL

   public function MenuUrl(Request $request){

 	$title = 'Menu URL Master';

 	$compName = $request->session()->get('company_name');

 	
    if(isset($compName)){

    	return view('admin.finance.master.setting.add_menu_url',compact('title'));

    }else{

		return redirect('/useractivity');
	}

}

public function SaveMenuUrl(Request $request){

	    
    $validate = $this->validate($request, [
		
		'menu_name'    => 'required|max:100',
		'submenu_name' => 'required|max:100',
		'form_name'    => 'required|max:60|unique:USERACCESS_FORM,FORM_NAME',
		'form_code'    => 'required|max:10|unique:USERACCESS_FORM,FORM_CODE',
		'form_url'     => 'required|max:200',

	]);


 	$createdBy 	= $request->session()->get('userid');

 	$compName 	= $request->session()->get('company_name');

 	$fisYear 	=  $request->session()->get('macc_year');
   
    $data = array(
		
		"MENU_NAME"    => $request->input('menu_name'),
		"SUBMENU_NAME" => $request->input('submenu_name'),
		"FORM_NAME"    => $request->input('form_name'),
		"FORM_CODE"    => $request->input('form_code'),
		"FORM_LINK"    => $request->input('form_url'),
		"FLAG"         => '0',
		"CREATED_BY"   => $createdBy,
			
	);


   $saveData = DB::table('USERACCESS_FORM')->insert($data);

   if ($saveData) {

		$request->session()->flash('alert-success', 'Menu URL Was Successfully Added...!');
		
		return redirect('/Master/Setting/view-menu-url');

	}else{

		$request->session()->flash('alert-error', 'Menu URL Can Not Added...!');
		
		return redirect('/Master/Setting/view-menu-url');

	}

}

public function ViewMenuUrl(Request $request){

    $compName = $request->session()->get('company_name');

	if($request->ajax()){
      
        $title    = 'View Menu Url';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

	    if($userType=='admin'){

	    	$data = DB::table('USERACCESS_FORM')->orderBy('ID','DESC');

        }else if ($userType=='superAdmin' || $userType=='user'){    		

	    	$data = DB::table('USERACCESS_FORM')->orderBy('ID','DESC');

	    }else{
	    		$data ='';
	    }

	   return DataTables::queryBuilder($data)->addIndexColumn()->toJson();

   }

	if(isset($compName)){
    	
    	return view('admin.finance.master.setting.view_menu_url');
	
	}else{

		return redirect('/useractivity');
	}
}

public function EditMenuUrl($id){

   $title = 'Edit Menu URL';

   $form_id = base64_decode($id);
   // print_r($form_id);exit;
   
   if($form_id!=''){

 	   $query = DB::table('USERACCESS_FORM');
		$query->where('ID', $form_id);
		$editData= $query->get()->first();

		return view('admin.finance.master.setting.edit_menu_url',compact('title','editData'));
	
	}else{
		
		$request->session()->flash('alert-error', ' Not Found...!');
		
		return redirect('/Master/Setting/view-menu-url');
	}

}

	public function UpdateMenuUrl(Request $request){

		$validate = $this->validate($request, [
			
			'menu_name'    => 'required',
			'submenu_name' => 'required',
			'form_name'    => 'required',
			'form_code'    => 'required',
			'form_link'    => 'required',
			

		]);

		// 'form_link'   => ['required', 'string',Rule::unique('USERACCESS_FORM')->where(function ($query) use ($request) {
		// 		    return $query->where('FORM_NAME', $request->form_name)->where('FORM_CODE', $request->form_code)->where('FORM_LINK', $request->form_link);
		// 				})],

		// $customMessages = [
	 //        'form_link.unique'=>'The Form link  has already been taken for this Form Code and Form Name.',
	 //    ];

	 //    $this->validate($request, $rules, $customMessages);

	 	$createdBy 	= $request->session()->get('userid');

	 	$compName 	= $request->session()->get('company_name');

	 	$fisYear 	=  $request->session()->get('macc_year');

	 	$id  = $request->input('form_id');
	   
	    $data = array(
			
			"MENU_NAME"    => $request->input('menu_name'),
			"SUBMENU_NAME" => $request->input('submenu_name'),
			"FORM_NAME"    => $request->input('form_name'),
			"FORM_CODE"    => $request->input('form_code'),
			"FORM_LINK"    => $request->input('form_link'),
			"FLAG"         => '0',
			"CREATED_BY"   => $createdBy,
				
		);

		
	    $saveData = DB::table('USERACCESS_FORM')->where('ID',$id)->update($data);

	    if ($saveData) {

			$request->session()->flash('alert-success', 'Menu URL Was Updated Successfully Added...!');
			
			return redirect('/Master/Setting/view-menu-url');

		}else{

			$request->session()->flash('alert-error', 'Menu URL Can Not Updated...!');
			
			return redirect('/Master/Setting/view-menu-url');

		}


	}
    // END MENU URL



}