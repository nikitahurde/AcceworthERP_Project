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

class DevControllerOne extends Controller{

	public function ProcessItemAge(Request $request){

		$companyDetailss = $request->session()->get('company_name');
		$splitDataa = explode('-',$companyDetailss);
		$compCodee = $splitDataa[0];

		$userDataa['plantList']=DB::table('MASTER_PLANT')->where('COMP_CODE',$compCodee)->get();

		return view('admin.finance.report.stock.process_item_age',$userDataa);

	}

	public function ProcessItemSave(Request $request){

		$request->validate([
			'plantCode'      => 'required',
			'plantName'      => 'required',
			'asonDate'       => 'required',
			'Rng1'           => 'required',
			'Rng2'           => 'required',
			'Rng3'           => 'required',
			'Rng4'           => 'required',
			'Rng5'           => 'required',

		]);

		$companyDetails = $request->session()->get('company_name');
		$splitData      = explode('-',$companyDetails);
		$compCode       = $splitData[0];
		$comp_name      = $splitData[1];

		$userData['plantList']=DB::table('MASTER_PLANT')->where('COMP_CODE',$compCode)->get();

		$createdBy     = $request->session()->get('userid');
		$fisYear       = $request->session()->get('macc_year');
		$asondt        = $request->input('asonDate');
		$asonDate      =  date("Y-m-d", strtotime($asondt));

		$data = array(
			"COMP_CODE"  => $compCode,
			"COMP_NAME"  => $comp_name,
			"PLANT_CODE" => $request->input('plantCode'),
			"PLANT_NAME" => $request->input('plantName'),
			"ASON_DATE"  => $asonDate,
			"RANGE01"    => $request->input('Rng1'),
			"RANGE02"    => $request->input('Rng2'),
			"RANGE03"    => $request->input('Rng3'),
			"RANGE04"    => $request->input('Rng4'),
			"RANGE05"    => $request->input('Rng5'),
			"CREATED_BY" => $createdBy,

		);

		$saveData = DB::table('ITEM_AGE_PARA')->insert($data);

		if($saveData){

			$request->session()->flash('alert-success', 'Item Type Was Successfully Added...!');
			return redirect('/report/stock-inventory/process-item-age');

		}else{

			$request->session()->flash('alert-error', 'Item Type Can Not Added...!');
			return redirect('/report/stock-inventory/process-item-age');

		}

	}


	public function dailyPData(Request $request){

		return view('admin.finance.report.stock.daily_data');

	}

	/* ----------- START INSFRASTRUCTURE MASTER ----------- */

	public function AddUnitTypeInfra(Request $request){

		$title = 'Add Unit Type Master';

		$compName = $request->session()->get('company_name');

		if(isset($compName)){

		  return view('admin.finance.master.Infrastructure.Add_unit_type',compact('title'));

		}else{
			return redirect('/useractivity');
		}

	}


	public function SaveUnitTypeInfra(Request $request){

		$request->validate([
			'unit_type_code'      => 'required',
			'unit_type_name'      => 'required',
			'unit_type_desc'      => 'required',

		]);


		$createdBy = $request->session()->get('userid');

		$compName  = $request->session()->get('company_name');

		$fisYear   =  $request->session()->get('macc_year');


		$data = array(
			"UNITTYPE_CODE" => $request->input('unit_type_code'),
			"UNITTYPE_NAME" => $request->input('unit_type_name'),
			"UNITTYPE_DESC" => $request->input('unit_type_desc'),
			"FLAG"          => 1,
			"CREATED_BY"    => $createdBy

		);

		$saveData = DB::table('MASTER_UNIT_TYPE')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Unit Type Was Successfully Added...!');
			return redirect('/Master/Infrastructure/View-unit-type');

		} else {

			$request->session()->flash('alert-error', 'Unit Type Can Not Added...!');
			return redirect('/Master/Infrastructure/View-unit-type');

		}

	}

	public function ViewUnitTypeInfra(Request $request){

		$compName = $request->session()->get('company_name');

		$title    = 'View Unit Type Master';

		if($request->ajax()) {

			$userid	= $request->session()->get('userid');

			$userType = $request->session()->get('usertype');

			$compName = $request->session()->get('company_name');

			$fisYear =  $request->session()->get('macc_year');


			if($userType=='admin'){

				$data = DB::table('MASTER_UNIT_TYPE')->orderBy('UNITTYPEID','DESC');

			}else if($userType=='superAdmin' || $userType=='user'){

				$data = DB::table('MASTER_UNIT_TYPE')->orderBy('UNITTYPEID','DESC');
			}else{

				$data ='';

			}

			return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){

			})->toJson();
		}

		if(isset($compName)){

		  return view('admin.finance.master.Infrastructure.View_unit_type',compact('title'));


		}else{

			return redirect('/useractivity');
		}


	}

	public function EditUnitTypeInfra(Request $request,$getId){

		$title = 'Edit Master Unit Type';

		$id = base64_decode($getId);

		if($id!=''){

			$query = DB::table('MASTER_UNIT_TYPE');
			$query->where('UNITTYPEID', $id);
			$acctypeData['acctype_list']  = $query->get()->first();

		    return view('admin.finance.master.Infrastructure.Edit_unit_type', $acctypeData+compact('title'));

		}else{

			$request->session()->flash('alert-error', 'Unit Type Code Not  Found...!');

			return redirect('/Master/Infrastructure/View-unit-type');
		}

	}

	public function UpdateUnitTypeInfra(Request $request){

		$request->validate([
			'unit_type_code'      => 'required',
			'unit_type_name'      => 'required',
			'unit_type_desc'      => 'required',

		]);

		$createdBy = $request->session()->get('userid');

		$compName  = $request->session()->get('company_name');

		$fisYear   =  $request->session()->get('macc_year');

		$lastUpdatedBy = $request->session()->get('userid');

		$acctypeCode = $request->input('unitId');

		$data = array(

			"UNITTYPE_CODE"    => $request->input('unit_type_code'),
			"UNITTYPE_NAME"    => $request->input('unit_type_name'),
			"UNITTYPE_DESC"    => $request->input('unit_type_desc'),	
			"LAST_UPDATE_BY"   => $lastUpdatedBy,
			
		);

		$updataData = DB::table('MASTER_UNIT_TYPE')->where('UNITTYPEID',$acctypeCode)->update($data);

		if ($updataData) {

			$request->session()->flash('alert-success', 'Unit Type Was Successfully Update...!');
			return redirect('/Master/Infrastructure/View-unit-type');

		} else {

			$request->session()->flash('alert-error', 'Unit Type Can Not Update...!');
			return redirect('/Master/Infrastructure/View-unit-type');

		}

	}

	public function AddUnitMasterInfra(Request $request){

		$title = 'Add Unit Master';

		$userData['plantList']=DB::table('MASTER_PROJECT_DETAIL')->get();
       
		$userData['unitList']=DB::table('MASTER_UNIT_TYPE')->get();

		$userData['unitUM']=DB::table('MASTER_UM')->get();

		$compName = $request->session()->get('company_name');

		if(isset($compName)){

         return view('admin.finance.master.Infrastructure.add_unit_master',$userData+compact('title'));

		}else{
			return redirect('/useractivity');
		}

		
	}

	public function SaveUnitMasterInfra(Request $request){

		$createdBy     = $request->session()->get('userid');
		$fisYear       = $request->session()->get('macc_year');
		$acctypeCode   = $request->input('acctypeCode');
		$updatedDate   = date("Y-m-d");
		$lastUpdatedBy = $request->session()->get('userid');
		$codeUnit      = $request->input('unitCode');
		$unitCodee     = count($codeUnit);
		$unitNamee     = $request->input('unitName');
		$unitTypee     = $request->input('unitType');
		$unitAreaa     = $request->input('unitArea');
		$unitUmm       = $request->input('unitUm');
		$unitRatee     = $request->input('unitRate');
		$wingNoo       = $request->input('wingNo');
		$towerNoo      = $request->input('towerNo');
		$floorNoo      = $request->input('floorNo');
		$unitNoo       = $request->input('unitNo');


		for($i=0; $i<$unitCodee;$i++){

			$data2 = array(

				"UNIT_CODE"     => $codeUnit[$i],
				"UNIT_NAME"     => $unitNamee[$i],
				"UNIT_TYPE"     => $unitTypee[$i],
				"UNIT_AREA"     => $unitAreaa[$i],
				"UNIT_UM"       => $unitUmm[$i],
				"UNIT_RATE"     => $unitRatee[$i],
				"WING_NO"       => $wingNoo[$i],
				"TOWER_NO"      => $towerNoo[$i],
				"FLOOR_NO"      => $floorNoo[$i],
				"UNIT_NO"       => $unitNoo[$i],

				"CREATED_BY"    => $createdBy,

			);


			$saveData = DB::table('MASTER_UNIT')->insert($data2);


		}                 

		$request->session()->flash('alert-success', 'Data successfully added...!');


		if($saveData){
			$response_array['response']='success';

			$response_array['data']=$saveData;

			$response_array['massage']=$request;

			$data1 = json_encode($response_array);

			print_r($data1);

		}

		else{

			$request->session()->flash('alert-danger', 'Data can not added...!');
			$response_array['response']='error';
			$response_array['data']=$saveData;
			$response_array['massage']=$request;

			$data1 = json_encode($response_array);
			print_r($data1);

		}

	}

	public function ViewUnitMasterInfra(Request $request){	

		$compName = $request->session()->get('company_name');

		$title    = 'View Unit Type Master';

		if($request->ajax()) {

			$userid	= $request->session()->get('userid');

			$userType = $request->session()->get('usertype');

			$compName = $request->session()->get('company_name');

			$fisYear =  $request->session()->get('macc_year');


			if($userType=='admin'){

				$data = DB::table('MASTER_UNIT')->orderBy('UNITID','DESC');

			}else if($userType=='superAdmin' || $userType=='user'){

				$data = DB::table('MASTER_UNIT')->orderBy('UNITID','DESC');
			}else{

				$data ='';

			}

			return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){

			})->toJson();
		}

		if(isset($compName)){

		  return view('admin.finance.master.Infrastructure.view_unit_master',compact('title'));


		}else{

			return redirect('/useractivity');
		}


	}


	public function editUnitMasterInfra(Request $request,$typeCode){


		$title    = 'Edit Master Unit ';

		$typeCode = base64_decode($typeCode);

		if($typeCode!=''){
			$query = DB::table('MASTER_UNIT');
			$query->where('UNITID', $typeCode);
			$userData['acctype_list'] = $query->get()->first();

			$userData['unitUM']=DB::table('MASTER_UM')->get();
             

			$userData['unitList'] = DB::table('MASTER_UNIT_TYPE')->get();

			$userData['plantList'] = DB::table('MASTER_PROJECT_DETAIL')->get();


			return view('admin.finance.master.Infrastructure.edit_unit_master', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Account Code Not Found...!');
			return redirect('/form-mast-depot');
		}

	}

	public function updateUnitMasterInfra(Request $request){

		$createdBy     = $request->session()->get('userid');

		$fisYear       = $request->session()->get('macc_year');

		$acctypeCode   = $request->input('acctypeCode');

		$updatedDate   = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');

		$codeUnit      = $request->input('unitCode');
		$unitCodee     = count($codeUnit);
		$unitNamee     = $request->input('unitName');
		$unitTypee     = $request->input('unitType');
		$unitAreaa     = $request->input('unitArea');
		$unitUmm       = $request->input('unitUm');
		$unitRatee     = $request->input('unitRate');
		$wingNoo       = $request->input('wingNo');
		$towerNoo      = $request->input('towerNo');
		$floorNoo      = $request->input('floorNo');
		$unitNoo       = $request->input('unitNo');


		for($i=0; $i<$unitCodee;$i++){

			$data2 = array(

				"UNIT_CODE"     => $codeUnit[$i],
				"UNIT_NAME"     => $unitNamee[$i],
				"UNIT_TYPE"     => $unitTypee[$i],
				"UNIT_AREA"     => $unitAreaa[$i],
				"UNIT_UM"       => $unitUmm[$i],
				"UNIT_RATE"     => $unitRatee[$i],
				"WING_NO"       => $wingNoo[$i],
				"TOWER_NO"      => $towerNoo[$i],
				"FLOOR_NO"      => $floorNoo[$i],
				"UNIT_NO"       => $unitNoo[$i],

				"CREATED_BY"    => $createdBy,

			);

			$updataData = DB::table('MASTER_UNIT')->where('UNIT_CODE',$acctypeCode)->update($data2);

		}                 


		$request->session()->flash('alert-success', 'Data successfully Updated...!');

		if($updataData){
			$response_array['response']='success';

			$response_array['data']=$updataData;

			$response_array['massage']=$request;

			$data1 = json_encode($response_array);

			print_r($data1);

		}

		else{

			$request->session()->flash('alert-danger', 'Data can not Updated...!');
			$response_array['response']='error';
			$response_array['data']=$updataData;
			$response_array['massage']=$request;
			$data1 = json_encode($response_array);
			print_r($data1);

		}

	}

	public function AddUnitWbs(Request $request){


		$title = 'Add Unit Wbs Master';

		$userData['unitListmaster'] = DB::table('MASTER_UNIT')->get();

		$userData['wbscodelist']=DB::table('PROJECT_WBS')->get();

		return view('admin.finance.master.Infrastructure.add_unit_wbs',$userData+compact('title'));


	}


	public function saveUnitWbs(Request $request){


		$createdBy      = $request->session()->get('userid');
		$compName       = $request->session()->get('company_name');
		$fisYear        =  $request->session()->get('macc_year');
		$unitcode       =    $request->input('unit_code');
		$codecount      = count($unitcode);
		$unitname       = $request->input('unit_name');
		$wbscode        = $request->input('wbscode');
		$wbsname        = $request->input('wbsname');
		$wbsplnstdtT    = $request->input('wbs_plantst_date');
		$plantend       = $request->input('wbs_planted_date');
		$actualstart    = $request->input('wbs_actual_stdate');
		$actualend      = $request->input('wbs_actual_eddate');
		$wbsstatus      = $request->input('wbs_status'); 
		$wbsprogress    = $request->input('wbs_progress');

		for($i=0; $i<$codecount; $i++){

			$newstart       = date('Y-m-d',strtotime($wbsplnstdtT[$i]));

			$newplantend    = date("Y-m-d", strtotime($plantend[$i]));

			$newsacttart    = date("Y-m-d",strtotime($actualstart[$i]));

			$newsacttartend = date("Y-m-d",strtotime($actualend[$i]));

			$data = array(

				"UNITWBS_CODE"        =>  $unitcode[$i],
				"UNITWBS_NAME"        =>  $unitname[$i],
				"WBS_CODE"            =>  $wbscode[$i], 
				"WBS_NAME"            =>  $wbsname[$i],
				"WBS_PLAN_STDATE"     =>  $newstart, 
				"WBS_PLAN_ENDATE"     =>  $newplantend,
				"WBS_ACT_STDATE"      =>  $newsacttart, 
				"WBS_ACT_ENDATE"      =>  $newsacttartend,
				"WBS_STATUS"          =>  $wbsstatus[$i], 
				"WBS_PROGRESS"        =>  $wbsprogress[$i],
				"CREATED_BY"          => $createdBy, 

			);

			$saveData = DB::table('UNIT_WBS')->insert($data);

		}   
		$request->session()->flash('alert-success', 'Data successfully added...!');


		if($saveData){
			$response_array['response']='success';

			$response_array['data']=$saveData;

			$response_array['massage']=$request;


			echo $data1 = json_encode($response_array);

		}else{

			$response_array['response']='error';
			$response_array['data']=$saveData;
			$response_array['massage']=$request;
			echo $data1 = json_encode($response_array);

		}

	}

	public function viewUnitWbs(Request $request){

		$compName = $request->session()->get('company_name');

		if($request->ajax()) {

			$title = 'View Wbs Master Unit';

			$userid	= $request->session()->get('userid');

			$userType = $request->session()->get('usertype');

			$compName = $request->session()->get('company_name');

			$fisYear =  $request->session()->get('macc_year');


			if($userType=='admin'){

				$data = DB::table('UNIT_WBS')->orderBy('UNITWBSID','DESC');

			}else if($userType=='superAdmin' || $userType=='user'){

				$data = DB::table('UNIT_WBS')->orderBy('UNITWBSID','DESC');

			}else{

				$data ='';

			}

			return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){

			})->toJson();
		}

		return view('admin.finance.master.Infrastructure.view_unit_wbs');


	}


	public function editUnitWbs(Request $request,$typeCode){


		$title = 'Edit Master Unit ';

		$typeCode = base64_decode($typeCode);

		if($typeCode!=''){
			$query = DB::table('UNIT_WBS');
			$query->where('UNITWBSID', $typeCode);
			$userData['acctype_list'] = $query->get()->first();

			$userData['unitListmaster'] = DB::table('MASTER_UNIT')->get();

			$userData['wbscodelist']=DB::table('PROJECT_WBS')->get();

			return view('admin.finance.master.Infrastructure.edit_unit_wbs', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Unit Wbs Code Not Found...!');
			return redirect('/form-mast-depot');
		}

	}


	public function updateUnitWbs(Request $request){

		$createdBy     = $request->session()->get('userid');

		$compName      = $request->session()->get('company_name');

		$fisYear        =  $request->session()->get('macc_year');


		$acctypeCode    = $request->input('ProjectInfoDetlSlno');


		$updatedDate    = date("Y-m-d");

		$lastUpdatedBy  = $request->session()->get('userid');

		$unitcode       =    $request->input('unit_code');

		$codecount      = count($unitcode);
		$unitname       = $request->input('unit_name');
		$wbscode        = $request->input('wbscode');
		$wbsname        = $request->input('wbsname');
		$wbsplnstdtT    = $request->input('wbs_plantst_date');
		$plantend       = $request->input('wbs_planted_date');
		$actualstart    = $request->input('wbs_actual_stdate');
		$actualend      = $request->input('wbs_actual_eddate');
		$wbsstatus      = $request->input('wbs_status'); 
		$wbsprogress    = $request->input('wbs_progress');

		for($i=0; $i<$codecount; $i++){

			$newstart       = date('Y-m-d',strtotime($wbsplnstdtT[$i]));

			$newplantend    = date("Y-m-d", strtotime($plantend[$i]));

			$newsacttart    = date("Y-m-d",strtotime($actualstart[$i]));

			$newsacttartend = date("Y-m-d",strtotime($actualend[$i]));

			$data = array(

				"UNITWBS_CODE"        =>  $unitcode[$i],
				"UNITWBS_NAME"        =>  $unitname[$i],
				"WBS_CODE"            =>  $wbscode[$i], 
				"WBS_NAME"            =>  $wbsname[$i],
				"WBS_PLAN_STDATE"     =>  $newstart, 
				"WBS_PLAN_ENDATE"     =>  $newplantend,
				"WBS_ACT_STDATE"      =>  $newsacttart, 
				"WBS_ACT_ENDATE"      =>  $newsacttartend,
				"WBS_STATUS"          =>  $wbsstatus[$i], 
				"WBS_PROGRESS"        =>  $wbsprogress[$i],
				"LAST_UPDATE_BY"      => $lastUpdatedBy,
				"LAST_UPDATE_DATE"    => $updatedDate

			);

			$updateData = DB::table('UNIT_WBS')->where('UNITWBSID',$acctypeCode)->update($data);


		}   

		$request->session()->flash('alert-success', 'Data successfully updated...!');

		if($updateData){
			$response_array['response']='success';

			$response_array['data']=$updateData;

			$response_array['massage']=$request;


			echo $data1 = json_encode($response_array);

		}else{

			$response_array['response']='error';
			$response_array['data']=$updateData;
			$response_array['massage']=$request;
			echo $data1 = json_encode($response_array);


		}



	}

	/* ----------- END INSFRASTRUCTURE MASTER ----------- */


	/* ~~~~~~~~~~~~~~~~~~ START : TEST API ~~~~~~~~~~~~~~~~~ */
	

	public function testApi(Request $request){

  	 	
		$compName = $request->session()->get('company_name');

		$title    = 'Test Api Config';

		if($request->ajax()) {

			$userid	= $request->session()->get('userid');

			$userType = $request->session()->get('usertype');

			$compName = $request->session()->get('company_name');

			$fisYear =  $request->session()->get('macc_year');


			$data = DB::table('API_LIST')->where('FLAG',1)->orderBy('API_CODE','DESC');


			return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){

			})->toJson();
		}

		if(isset($compName)){

		  return view('admin.finance.master.setting.testApiConfig',compact('title'));


		}else{

			return redirect('/useractivity');
		}




}

	public function getApiData(Request $request){

		if ($request->ajax()) {
			
			$userName = $request->post('userName');
			$passWord = $request->post('passWord');
			$apiLink  = $request->post('apiLink');
			$apiName  = $request->post('apiName');

			$createdBy = $request->session()->get('userid');
			$Company   = $request->session()->get('company_name');

			$explode   = explode('-', $Company);

	    	$getcom_code = $explode[0];

			$datastate = DB::table('MASTER_COMP')->where('COMP_CODE',$getcom_code)->get()->first();

			if (!empty($userName || $passWord || $apiLink || $apiName)) {

				$etransApi='';
				$easyWayBillCompLogin='';
				$easyWayBillLogin='';
				$logiLockerApi='';

				if ($apiName == 'LOGILOCKER') {

					$ch = curl_init('https://ulip.logilocker.in/logilocker/v1/auth/login');
					
				
					$payload = json_encode( array( "userid"=> "9975830086",
					 	    "password"=> "123456" ) );
					curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
					curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
					
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
					
					$result = curl_exec($ch);

					curl_close($ch);

					$logiLockerApi = json_decode($result, true);	
					
				}else if($apiName == 'EWAY-BILL' || $apiName == 'EWAYBILL COMPLETE LOGIN'){

					$ch = curl_init('https://api.easywaybill.in/ezewb/v1/auth/initlogin');
					
					$payload = json_encode( array( "userid"=> "swetalenterprises7@gmail.com",
					 	    "password"=> "Shreyas@123" ) );

					curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );

					curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
					
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
					
					$result = curl_exec($ch);

					curl_close($ch);

					$DATA = json_decode($result, true);

					$loginToken = $DATA['response']['token'];

					if ($getcom_code == 'SA') {
						
						$orgid = $DATA['response']['orgs'][0]['orgId'];

					}else if($getcom_code == 'SE'){

						$orgid = $DATA['response']['orgs'][1]['orgId'];

					}else{

						$orgid = 000;

					}

					$ch1 = curl_init('https://api.easywaybill.in/ezewb/v1/auth/completelogin');
							
					$payload1 = json_encode( array( "token" => $loginToken,
					 	    "orgid"=> $orgid ) );

					curl_setopt( $ch1, CURLOPT_POSTFIELDS, $payload1 );
					
					curl_setopt($ch1, CURLOPT_HTTPHEADER, array(
					   'Content-Type: application/json',
					   'Authorization: Bearer ' . $loginToken
					   ));
					curl_setopt( $ch1, CURLOPT_RETURNTRANSFER, true );
					
					$result1 = curl_exec($ch1);
					curl_close($ch1);

					$easyWayBillLogin = json_decode($result1, true);


				}else if($apiName == 'ETRANS'){

					$ch = curl_init('https://etranssolutions.com/eTransRestApi/reports/location');
					
					curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','username:shreyasho','password:10hstc4Xa3ODTW9f61'));
					
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
					
					$result = curl_exec($ch);

					curl_close($ch);

					$etransApi = json_decode($result, true);


				}else{


					$etransApi = '';
					$easyWayBillCompLogin = '';
					$easyWayBillLogin = '';
					$logiLockerApi = '';

				}


				$FLEETLIST = DB::table('MASTER_FLEET')->where('FLEET_BLOCK','NO')->get()->toArray();
				$TRIPBODY  = DB::table('TRIP_BODY')->where('COMP_CODE',$getcom_code)->get()->toArray();
				$MASTERPLANT = DB::table('MASTER_PLANT')->where('COMP_CODE',$getcom_code)->groupBy('GST_NO')->get()->toArray();


				$data['response']             	   = 'success';
				$data['etransApi_list']            = $etransApi;
				$data['easyWayBillCompLogin_list'] = $easyWayBillCompLogin;
				$data['easyWayBillLogin_list']     = $easyWayBillLogin;
				$data['logiLockerApi_list']        = $logiLockerApi;
				$data['fleet_list']        		   = $FLEETLIST;
				$data['ewaybill_list']        	   = $TRIPBODY;
				$data['gst_list']        	   	   = $MASTERPLANT;
				$getalldata = json_encode($data);  
				print_r($getalldata);

			}else{

				$data['response'] 			       = 'error';
				$data['etransApi_list']            = '';
				$data['easyWayBillCompLogin_list'] = '';
				$data['easyWayBillLogin_list']     = '';
				$data['logiLockerApi_list']        = '';
				$data['fleet_list']        		   = '';
				$data['ewaybill_list']        	   = '';
				$data['gst_list']        	   	   = '';
				$getalldata = json_encode($data);  
				print_r($getalldata);

			} /* ~~~ Second If Condition Check ~~~~ */


		}else{

			$data['response'] 			  	   = 'ajax error';
			$data['etransApi_list']            = '';
			$data['easyWayBillCompLogin_list'] = '';
			$data['easyWayBillLogin_list']     = '';
			$data['logiLockerApi_list']        = '';
			$data['fleet_list']        		   = '';
			$data['ewaybill_list']        	   = '';
			$data['gst_list']        	       = '';
			$getalldata = json_encode($data);  
			print_r($getalldata);


		} /* --- Check Ajax Response If Close--- */

		
	}


	public function runApiData(Request $request){


		if ($request->ajax()) {
			
			$mVar1   = $request->post('mVar1');
			$mVar2   = $request->post('mVar2');
			$mVar3   = $request->post('mVar3');
			$mVar4   = $request->post('mVar4');
			$apiName = $request->post('apiName');


			if (!empty($mVar1 || $mVar2 || $mVar3 || $mVar4 || $apiName)) {

				$etransApi='';
				$easyWayBillCompLogin='';
				$easyWayBillLogin='';
				$logiLockerApi='';

				if ($apiName == 'LOGILOCKER') {

					$authorization = "Authorization: Bearer ".$mVar4;

			    	$curl = curl_init();
			        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); 
			    
					curl_setopt($curl, CURLOPT_URL, "https://ulip.logilocker.in/logilocker/api/vahan?vehicleNo=".$mVar1."&gstin=''&forceUpdate=true");
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$result = curl_exec($curl);
					curl_close($curl);

					$logiLockerApi = json_decode($result, true);	
					
				}else if($apiName == 'EWAY-BILL' || $apiName == 'EWAYBILL COMPLETE LOGIN'){

					$authorization = "Authorization: Bearer ".$mVar4;

					$curl = curl_init();

			        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
			    
					curl_setopt($curl, CURLOPT_URL, "https://api.easywaybill.in/ezewb/v1/ewb/refreshEwb?ewbNo=".$mVar1."&gstin=".$mVar3."");

					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

					$result = curl_exec($curl);

					curl_close($curl);

					$easyWayBillCompLogin = json_decode($result, true);


				}else if($apiName == 'ETRANS'){

					$ch = curl_init('https://etranssolutions.com/eTransRestApi/reports/location');

					$payload = json_encode( array("$mVar1"));

					curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
					curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','username:shreyasho','password:10hstc4Xa3ODTW9f61'));
					
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
					
					$result = curl_exec($ch);

					curl_close($ch);

					$etransApi = json_decode($result, true);


				}else{


					$etransApi = '';
					$easyWayBillCompLogin = '';
					$easyWayBillLogin = '';
					$logiLockerApi = '';

				}

				$data['response']             	   = 'success';
				$data['etransApi_list']            = $etransApi;
				$data['easyWayBillCompLogin_list'] = $easyWayBillCompLogin;
				$data['easyWayBillLogin_list']     = $easyWayBillLogin;
				$data['logiLockerApi_list']        = $logiLockerApi;
				
				$getalldata = json_encode($data);  
				print_r($getalldata);

			}else{

				$data['response'] 			       = 'error';
				$data['etransApi_list']            = '';
				$data['easyWayBillCompLogin_list'] = '';
				$data['easyWayBillLogin_list']     = '';
				$data['logiLockerApi_list']        = '';
				$getalldata = json_encode($data);  
				print_r($getalldata);

			} /* ~~~ Second If Condition Check ~~~~ */




		}else{

			$data['response'] 			       = 'error';
			$data['etransApi_list']            = '';
			$data['easyWayBillCompLogin_list'] = '';
			$data['easyWayBillLogin_list']     = '';
			$data['logiLockerApi_list']        = '';
			$getalldata = json_encode($data);  
			print_r($getalldata);


		} /* ~~~~ Ajax condition IF Close ~~~~~ */
		
	}


	public function  apiNotRunSendMail(Request $request){


		if ($request->ajax()) {

			$apiName  = $request->post('apiName');

			$accEmailId = 'mit.agarkar@gmail.com';

			$developmentMode = true;
        	$mailer = new PHPMailer($developmentMode);

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
            $mailer->Username = 'info@aceworth.in';
            $mailer->Password = 'init1234';
            $mailer->CharSet = 'iso-8859-1'; 
            $mailer->Port = 587;
            $mailer->WordWrap = TRUE;

            $mailer->setFrom('info@aceworth.in', 'Aceworth Private Limitate');
            $mailer->addAddress($accEmailId, 'Aceworth Private Limitate');
            $mailer->addReplyTo('info@aceworth.in', 'Aceworth Private Limitate');

            $mailer->isHTML(true);
            $mailer->Subject = $apiName.' API NOT WORKING PROPERLY';

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

            $mailer->Body = $message;

            $mailSend = $mailer->send();
           
            $mailer->ClearAllRecipients();


            if($mailSend){

            	$data['response']  = 'success';
            	$data['msg'] = 'Mail Send';
				
				$getalldata = json_encode($data);  
				print_r($getalldata);

			}else{

				$data['response'] = 'error';
				$data['msg'] = 'Mail Not Send';
				
				$getalldata = json_encode($data);  
				print_r($getalldata);
			
			}
			

		}else{

			$data['response']  = 'error';
        	$data['msg'] = 'error';
			
			$getalldata = json_encode($data);  
			print_r($getalldata);

		} /* ~~~ Ajax condition If close ~~~ */

		
	}


	/* ~~~~~~~~~~~~~~~~~~ END : TEST API ~~~~~~~~~~~~~~~~~ */

        public function editFreightSaleQuatation(Request $request,$id){
        	print_r('hii');exit();
        }

}