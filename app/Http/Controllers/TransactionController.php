<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Session;
use DataTables;
use PHPMailer\PHPMailer\PHPMailer;

class TransactionController extends Controller
{

     public function __cunstruct(){

	}


	

/*sap bill start*/

    public function SapBill(Request $request){

    	$title = 'Add Sap Bill';

    	$CompanyCode   = $request->session()->get('company_name');
		$MaccYear      = $request->session()->get('macc_year');
		$getcomcode    = explode('-', $CompanyCode);
		$CCFromSession = $getcomcode[0];

		$userData['user_list']       = DB::table('master_depot')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
		$userData['item_list']       = DB::table('master_item')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
		$userData['acc_list']        = DB::table('master_acc')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
		$userData['area_list']       = DB::table('master_area')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
		$userData['transpoter_list'] = DB::table('master_acctype')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();

		
		//DB::enableQueryLog();
		$item_um_aum_list = DB::table('master_fy')->where('comp_code',$CCFromSession)->where('fy_code',$MaccYear)->get();
		//dd(DB::getQueryLog());
					foreach ($item_um_aum_list as $key) {
					$userData['fromDate'] =  $key->fy_from_date;
					$userData['toDate']   =  $key->fy_to_date;
					}

    	return view('admin.cf.transaction.sap_bill',$userData+compact('title'));

    }

    

    

    public function SaveSapBill(Request $request){

    	//print_r($request->post());exit();

    	$trDate = $request->input('transaction_date');

    	$Transaction_date = date("Y-m-d", strtotime($trDate));


    	$InvoiceDate = $request->input('invoice_date');


    	$Invoice_date = date("Y-m-d", strtotime($InvoiceDate));


    	$validate = $this->validate($request, [

				'transaction_date' => 'required',
				'transaction_no'   => 'required',
				'invoice_date'     => 'required',
				'invoice_no'       => 'required',
				'depot_code'       => 'required',
				'account_code'     => 'required',
				'area_code'        => 'required',
				'transport_code'   => 'required',
				'vehicle_no'       => 'required',
				'item_code'        => 'required',
				'inv_qty_um'       => 'required',
				'inv_qty_aum'      => 'required',
				'so_code'          => 'required',

		]);

    	$depot_code = $request->input('depot_code');
    	$account_code = $request->input('account_code');
    	$area_code = $request->input('area_code');
    	$item_code = $request->input('item_code');
    	$trpt_code = $request->input('transport_code');

		$data = array(
					"comp_code"    =>  $request->input('comp_code'),
					"fy_year"      =>  $request->input('fy_year'),
					"vr_date"      =>  $Transaction_date,
					"vr_no"        =>  $request->input('transaction_no'),
					"invoice_date" =>  $Invoice_date,
					"invoice_no"   =>  $request->input('invoice_no'),
					"depot_code"   =>  $request->input('depot_code'),
					"acct_code"    =>  $request->input('account_code'),
					"area_code"    =>  $request->input('area_code'),
					"trpt_code"    =>  $request->input('transport_code'),
					"truck_no"     =>  $request->input('vehicle_no'),
					"item_code"    =>  $request->input('item_code'),
					"qty_issued"   =>  $request->input('inv_qty_um'),
					"aqty_issued"  =>  $request->input('inv_qty_aum'),
					"so_code"      =>  $request->input('so_code'),
					"created_by"   =>  $request->session()->get('userid')
	 
	    	);



		$saveData = DB::table('sap_bill')->insert($data);

		
	   
	

			if ($saveData) {


				 $getCode1= DB::table('code_access')->where('code',$depot_code)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode1)){

				 	 $getCode= DB::table('code_access')->where('code',$depot_code)->where('sap_bill',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'       =>$depot_code,
								'sap_bill'   =>1,
								"created_by" =>  $request->session()->get('userid')
					 	);

					 	//DB::enableQueryLog();

					 	$saveData1 = DB::table('code_access')->where('code',$depot_code)->update($data1);

					 	//dd(DB::getQueryLog());
					 }


				 }else{

				 	$data1=array(
								'code'       =>$depot_code,
								'sap_bill'   =>1,
								"created_by" =>  $request->session()->get('userid')
					 	);

					//DB::enableQueryLog(); 	
					$saveData1 = DB::table('code_access')->insert($data1);

					//dd(DB::getQueryLog());
				 }


				$getCode2= DB::table('code_access')->where('code',$account_code)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode2)){

				 	 $getCode = DB::table('code_access')->where('code',$account_code)->where('sap_bill',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'       =>$account_code,
								'sap_bill'   =>1,
								"created_by" =>  $request->session()->get('userid')
					 	);

					 	//DB::enableQueryLog();

					 	$saveData2 = DB::table('code_access')->where('code',$account_code)->update($data1);

					 	//dd(DB::getQueryLog());
					 }


				 }else{

				 	$data1=array(
								'code'       =>$account_code,
								'sap_bill'   =>1,
								"created_by" =>  $request->session()->get('userid')
					 	);

					//DB::enableQueryLog(); 	
					$saveData2 = DB::table('code_access')->insert($data1);

					//dd(DB::getQueryLog());
				 }


				$getCode3= DB::table('code_access')->where('code',$area_code)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode3)){

				 	 $getCode = DB::table('code_access')->where('code',$area_code)->where('sap_bill',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'       =>$area_code,
								'sap_bill'   =>1,
								"created_by" =>$request->session()->get('userid')
					 	);

					 	//DB::enableQueryLog();

					 	$saveData3 = DB::table('code_access')->where('code',$area_code)->update($data1);

					 	//dd(DB::getQueryLog());
					 }


				 }else{

				 	$data1=array(
								'code'       =>$area_code,
								'sap_bill'   =>1,
								"created_by" =>  $request->session()->get('userid')
					 	);

					//DB::enableQueryLog(); 	
					$saveData3 = DB::table('code_access')->insert($data1);

					//dd(DB::getQueryLog());
				 }

				 $getCode4= DB::table('code_access')->where('code',$item_code)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode4)){

				 	 $getCode = DB::table('code_access')->where('code',$item_code)->where('sap_bill',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'       =>$item_code,
								'sap_bill'   =>1,
								"created_by" =>$request->session()->get('userid')
					 	);

					 	//DB::enableQueryLog();

					 	$saveData4 = DB::table('code_access')->where('code',$item_code)->update($data1);

					 	//dd(DB::getQueryLog());
					 }


				 }else{

				 	$data1=array(
								'code'       =>$item_code,
								'sap_bill'   =>1,
								"created_by" =>  $request->session()->get('userid')
					 	);

					//DB::enableQueryLog(); 	
					$saveData4 = DB::table('code_access')->insert($data1);

					//dd(DB::getQueryLog());
				 }

				 $getCode5= DB::table('code_access')->where('code',$trpt_code)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode5)){

				 	 $getCode = DB::table('code_access')->where('code',$trpt_code)->where('sap_bill',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'       =>$trpt_code,
								'sap_bill'   =>1,
								"created_by" =>$request->session()->get('userid')
					 	);

					 	//DB::enableQueryLog();

					 	$saveData5 = DB::table('code_access')->where('code',$trpt_code)->update($data1);

					 	//dd(DB::getQueryLog());
					 }


				 }else{

				 	$data1=array(
								'code'       =>$trpt_code,
								'sap_bill'   =>1,
								"created_by" =>  $request->session()->get('userid')
					 	);

					//DB::enableQueryLog(); 	
					$saveData5 = DB::table('code_access')->insert($data1);

					//dd(DB::getQueryLog());
				 }


				if($saveData1 || $saveData2 || $saveData3 || $saveData4 || $saveData5){

					$request->session()->flash('alert-success', 'Sap Bill Was Successfully Added...!');
				return redirect('/view-sap-bill');

				}else{

					$request->session()->flash('alert-error', 'Sap Bill Can Not Added...!');
				return redirect('/view-sap-bill');
				}

			} else {

				$request->session()->flash('alert-error', 'Sap Bill Can Not Added...!');
				return redirect('/view-sap-bill');

			}

    }

    public function viewSapBill(Request $request){
    	//print_r($request->session()->get('userid'));exit;

    	if ($request->ajax()) {

    	

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');
		//print_r($userid);exit;

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){

    	$data = DB::table('sap_bill')
            ->join('master_acc', 'sap_bill.acct_code', '=', 'master_acc.acc_code')
            ->select('sap_bill.*', 'master_acc.acc_name')
            ->where([['sap_bill.comp_code','=',$CompanyCode],['sap_bill.fy_year','=',$macc_year]])
            ->orderBy('id','DESC')
            ->get();
    	

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	//DB::enableQueryLog();
		$data = DB::table('sap_bill')
				->select('sap_bill.*', 'master_acc.acc_name')
           		->leftjoin('master_acc', 'sap_bill.acct_code', '=', 'master_acc.acc_code')
            	->where([['sap_bill.created_by','=',$userid],['sap_bill.comp_code','=',$CompanyCode],['sap_bill.fy_year','=',$macc_year]])
            	->orderBy('id','DESC')
            	->get();
    	 //dd(DB::getQueryLog());

    	}else{
    		
    		$data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){ 
    		$depot_code = $data->depot_code;

				$btn = '<button type="button"  class="btn btn-primary btn-xs" data-toggle="modal" data-target="#sapbillview" onclick="return ViewSapBil('.$data->id.')"><i class="fa fa-eye" title="view"></i></button> | <a href="'.url('/edit-form-sap-bil/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#sapbillDelete" class="btn btn-danger btn-xs" onclick="return deletesapbil('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View Sap Bill';
       return view('admin.cf.transaction.view_sap_bill',compact('title'));

    }

    public function DeleteSapBill(Request $request){

        $id = $request->input('id');
        if ($id!='') {

        	$sap = DB::table('sap_bill')->where('id',$id)->get()->first();

        	$sap_depot_code = DB::table('sap_bill')->where('depot_code',$sap->depot_code)->get()->toArray();

        	$sap_area_code = DB::table('sap_bill')->where('area_code',$sap->area_code)->get()->toArray();

        	$sap_acc_code = DB::table('sap_bill')->where('acct_code',$sap->acct_code)->get()->toArray();

        	$sap_item_code = DB::table('sap_bill')->where('item_code',$sap->item_code)->get()->toArray();

        	$sap_trpt_code = DB::table('sap_bill')->where('trpt_code',$sap->trpt_code)->get()->toArray();



        	$count =count($sap_depot_code);

        	if($count >1){
        		$Delete = DB::table('sap_bill')->where('id', $id)->delete();

        	}else{
        		$Delete = DB::table('sap_bill')->where('id', $id)->delete();

        		$data=array(

        			'sap_bill'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$sap->depot_code)->update($data);
        	
        	}

        	$area_code_count= count($sap_area_code);

        	if($area_code_count >1){
        		$Delete1 = DB::table('sap_bill')->where('id', $id)->delete();

        	}else{
        		$Delete1 = DB::table('sap_bill')->where('id', $id)->delete();

        		$data=array(

        			'sap_bill'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$sap->area_code)->update($data);
        	
        	}


        	$sap_acc_count = count($sap_acc_code);

        	if($sap_acc_count >1){
        		$Delete2 = DB::table('sap_bill')->where('id', $id)->delete();

        	}else{
        		$Delete2 = DB::table('sap_bill')->where('id', $id)->delete();

        		$data=array(

        			'sap_bill'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$sap->acct_code)->update($data);
        	
        	}

        	
        	$sap_item_count = count($sap_item_code);

        	if($sap_item_count >1){
        		$Delete3 = DB::table('sap_bill')->where('id', $id)->delete();

        	}else{
        		$Delete3 = DB::table('sap_bill')->where('id', $id)->delete();

        		$data=array(

        			'sap_bill'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$sap->item_code)->update($data);
        	
        	}

        	
        	$sap_trpt_count = count($sap_trpt_code);

        	if($sap_trpt_count >1){
        		$Delete4 = DB::table('sap_bill')->where('id', $id)->delete();

        	}else{
        		$Delete4 = DB::table('sap_bill')->where('id', $id)->delete();

        		$data=array(

        			'sap_bill'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$sap->trpt_code)->update($data);
        	
        	}



			if($Delete  &&  empty($Delete1) && empty($Delete2) && empty($Delete3) && empty($Delete4) || $Delete1  &&  empty($Delete) && empty($Delete2) && empty($Delete3) && empty($Delete4)|| $Delete2 &&  empty($Delete) && empty($Delete1) && empty($Delete3) && empty($Delete4) || $Delete3 &&  empty($Delete) && empty($Delete1) && empty($Delete2) && empty($Delete4) || $Delete4 &&  empty($Delete) && empty($Delete1) && empty($Delete2) && empty($Delete3)){

			$request->session()->flash('alert-success', 'Sap Bill Data Was Deleted Successfully...!');
			return redirect('/view-sap-bill');

			} else {

			$request->session()->flash('alert-error', 'Sap Bill Data Can Not Deleted...!');
			return redirect('/view-sap-bill');

			}

		}else{

		$request->session()->flash('alert-error', 'Sap Bill Data Not Found...!');
		return redirect('/view-sap-bill');

		}
	}

	public function EditSapBill($id, Request $request){
		$title = 'Edit Sap Bill';

		$id = base64_decode($id);

		$CompanyCode   = $request->session()->get('company_name');
		$MaccYear      = $request->session()->get('macc_year');
		$getcomcode    = explode('-', $CompanyCode);
		$CCFromSession = $getcomcode[0];

		if($id!=''){
    	    $query = DB::table('sap_bill');
			$query->where('id', $id);
			$compData['sapbil_list']     = $query->get()->first();
			
			$compData['user_list']       = DB::table('master_depot')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
			
			$compData['acc_list']        = DB::table('master_acc')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
			
			$compData['area_list']       = DB::table('master_area')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
			
			$compData['transpoter_list'] = DB::table('master_acctype')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
			
			$compData['item_list']       = DB::table('master_item')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();

			//DB::enableQueryLog();
			$item_um_aum_list = DB::table('master_fy')->where('comp_code',$CCFromSession)->where('fy_code',$MaccYear)->get();
			//dd(DB::getQueryLog());


					foreach ($item_um_aum_list as $key) {
					$compData['fromDate'] =  $key->fy_from_date;
					$compData['toDate']   =  $key->fy_to_date;
					}

			return view('admin.cf.transaction.edit_sap_bill', $compData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Company Not Found...!');
			return redirect('/view-sap-bill');
		}

	}

	public function UpdateSapBill(Request $request){


		$trDate = $request->input('transaction_date');

    	$Transaction_date = date("Y-m-d", strtotime($trDate));


    	$InvoiceDate = $request->input('invoice_date');


    	$Invoice_date = date("Y-m-d", strtotime($InvoiceDate));

		
		$validate = $this->validate($request, [

				'transaction_date' => 'required',
				'transaction_no'   => 'required',
				'invoice_date'     => 'required',
				'invoice_no'       => 'required',
				'depot_code'       => 'required',
				'account_code'     => 'required',
				'area_code'        => 'required',
				'transport_code'   => 'required',
				'vehicle_no'       => 'required',
				'item_code'        => 'required',
				'inv_qty_um'       => 'required',
				'inv_qty_aum'      => 'required',
				'so_code'          => 'required',
		]);

       $id = $request->input('sapbil_id');
       $updatedDate = date('Y-m-d');

       $depot_code = $request->input('depot_code');
       $account_code = $request->input('account_code');

		$data = array(
					"comp_code"    =>  $request->input('comp_code'),
					"fy_year"      =>  $request->input('fy_year'),
					"vr_date"      =>  $Transaction_date,
					"vr_no"        =>  $request->input('transaction_no'),
					"invoice_date" =>  $Invoice_date,
					"invoice_no"   =>  $request->input('invoice_no'),
					"depot_code"   =>  $request->input('depot_code'),
					"acct_code"    =>  $request->input('account_code'),
					"area_code"    =>  $request->input('area_code'),
					"trpt_code"    =>  $request->input('transport_code'),
					"truck_no"     =>  $request->input('vehicle_no'),
					"item_code"    =>  $request->input('item_code'),
					"qty_issued"   =>  $request->input('inv_qty_um'),
					"aqty_issued"  =>  $request->input('inv_qty_aum'),
					"so_code"      =>  $request->input('so_code'),
					"last_updat_by"   =>  $request->session()->get('userid'),
					"last_updat_date" =>  $updatedDate
	 
	    	);

		$saveData = DB::table('sap_bill')->where('id', $id)->update($data);
		

			if ($saveData) {

				$request->session()->flash('alert-success', 'Sap Bill Was Successfully Updated...!');
				return redirect('/view-sap-bill');

			} else {

				$request->session()->flash('alert-error', 'Sap Bill Can Not Updated...!');
				return redirect('/view-sap-bill');

			}


	}

/*sap bill end*/

    public function Item_UM_AUM(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$itemCode = $request->input('itemcode');

	    
	    	$item_um_aum_list = DB::table('master_itemum')->where('item_code', $itemCode)->get();

    		if ($item_um_aum_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_um_aum_list ;

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

/*inward Transaction start*/
    public function InwardTrans(Request $request){

			$CompanyCode   = $request->session()->get('company_name');

			$MaccYear      = $request->session()->get('macc_year');

			$getcomcode    = explode('-', $CompanyCode);
			$CCFromSession = $getcomcode[0];

    	$title = 'Add Inward Transaction';

		$userData['user_list']       = DB::table('master_depot')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
		$userData['acc_list']        = DB::table('master_acc')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
		$userData['area_list']       = DB::table('master_area')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
		$userData['transpoter_list'] = DB::table('master_acctype')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
		$userData['item_list']       = DB::table('master_item')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();

		//DB::enableQueryLog();


		$item_um_aum_list = DB::table('master_fy')->where(['comp_code'=>$CCFromSession,'fy_code'=>$MaccYear])->get();


		
		//dd(DB::getQueryLog());

				foreach ($item_um_aum_list as $key) {
				$userData['fromDate'] =  $key->fy_from_date;
				$userData['toDate']   =  $key->fy_to_date;
				}

		$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		if($user_type == 'admin'){

	
			$OutwardTransNo =  DB::table('inward_trans')->where([['comp_code','=',$CompanyCode],['fy_year','=',$MaccYear]])->get()->toArray();
		
			if (!empty($OutwardTransNo)) {

				$TblId = DB::table('inward_trans')->max('id');

				$userData['trn_no'] = DB::table('inward_trans')->where([['id','=',$TblId],['comp_code','=',$CompanyCode],['fy_year','=',$MaccYear]])->get()->first();

			}else{

				$mas_trans = DB::table('master_transaction')->where([['tran_head','=','Inward'],['comp_name','=',$CompanyCode],['fiscal_year','=',$MaccYear]])->get()->first();

				if(!empty($mas_trans)){

					$TrCode = $mas_trans->tran_code;

				$userData['trn_no_vr'] = DB::table('master_vrseq')->where([['tran_code','=',$TrCode],['comp_name','=',$CompanyCode],['fiscal_year','=',$MaccYear]])->get()->first();
				}else{
					$userData['trn_no_vr'] =array();
				}

				


					//print_r($userData['trn_no_vr']);exit;
				

			}
    	
    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    		$OutwardTransNo =  DB::table('inward_trans')->where([['comp_code','=',$CompanyCode],['fy_year','=',$MaccYear]])->get()->toArray();
		

			if (!empty($OutwardTransNo)) {

				$TblId = DB::table('inward_trans')->max('id');

				$userData['trn_no'] = DB::table('inward_trans')->where([['id','=',$TblId],['created_by','=',$userid],['comp_code','=',$CompanyCode],['fy_year','=',$MaccYear]])->get()->first();
				
			}else{

				$mas_trans = DB::table('master_transaction')->where([['tran_head','=','Inward'],['comp_name','=',$CompanyCode],['fiscal_year','=',$MaccYear]])->get()->first();

				if(!empty($mas_trans)){
					$TrCode = $mas_trans->tran_code;

				$userData['trn_no_vr'] = DB::table('master_vrseq')->where([['tran_code','=',$TrCode],['created_by','=',$userid],['comp_name','=',$CompanyCode],['fiscal_year','=',$MaccYear]])->get()->first();

				}else{
					$userData['trn_no_vr']=array();
				}

				
				
			}
    	}else{

    		$data ='';
    	}

    	$OutwardTrans01 =  DB::table('inward_trans')->where([['comp_code','=',$CompanyCode],['fy_year','=',$MaccYear]])->get()->toArray();

    	if (!empty($OutwardTrans01)) {

    		$mas_trans = DB::table('master_transaction')->where([['tran_head','=','Inward'],['comp_name','=',$CompanyCode],['fiscal_year','=',$MaccYear]])->get()->first();

    	if(!empty($mas_trans)){

			$TrCode = $mas_trans->tran_code;
		}else{

			$TrCode='';
		}



    		$mas_vrseq1 = DB::table('master_vrseq')->where([['tran_code','=',$TrCode],['comp_name','=',$CompanyCode],['fiscal_year','=',$MaccYear]])->get()->first();

    		if(!empty($mas_vrseq1)){

    		$ToNo = $mas_vrseq1->to_no;
    		$tran_code = $mas_vrseq1->tran_code;
    	}else{
    		$ToNo='';
    	}

			$TblId = DB::table('inward_trans')->max('id');

			$trn_no1 = DB::table('inward_trans')->where([['id','=',$TblId],['created_by','=',$userid],['comp_code','=',$CompanyCode],['fy_year','=',$MaccYear]])->get()->first();
			//print_r($trn_no1);exit;

			if (!empty($trn_no1)) {
				$TrNo01 = $trn_no1->vr_no;
				
			}else{
				$TrNo01 = 0;
			}

    	}else{

    		$TrNo01 = 1;
    		$ToNo   = 2;	

		}

		

			if ($TrNo01 > $ToNo) {

				$check_trNo = 0;
				
			}else{

				$check_trNo = 1;
			}

    	
    	return view('admin.cf.transaction.inward_trans',$userData+compact('title','check_trNo','tran_code'));

    }

    public function SaveInwardTrans(Request $request){


    	$trDate = $request->input('transaction_date');

    	$Transaction_date = date("Y-m-d", strtotime($trDate));


    	$InvoiceDate = $request->input('invoice_date');


    	$Invoice_date = date("Y-m-d", strtotime($InvoiceDate));

    	//print_r($FromDate);exit;
    	
	    	$validate = $this->validate($request, [

				
				'depot_code'       => 'required',
				'transaction_date' => 'required',
				'transaction_no'   => 'required',
				'invoice_no'       => 'required|unique:inward_trans,invoice_no',
				'invoice_date'     => 'required',
				'account_code'     => 'required',
				'transporter_code' => 'required',
				'vehicle_no'       => 'required',
				'item_code'        => 'required',
				'sto_qty'          => 'required',
				'sto_aqty'         => 'required',
				'qty_recd'         => 'required',
				'aqty_recd'        => 'required',
				'flag'             => 'required',

			]);

			$sortQty = $request->input('sort_qty');

			if($sortQty!=''){ 
	    		$sortQty;
	    	}else{ 
	    		$sortQty ='';
    		}

    		$sortAQty = $request->input('sort_aqty');

    		if($sortAQty!=''){ 
	    		$sortAQty;
	    	}else{ 
	    		$sortAQty ='';
    		}

    		$damageQty = $request->input('damage_qty');

    		if($damageQty!=''){ 
	    		$damageQty;
	    	}else{ 
	    		$damageQty ='';
    		}

    		$damageAQty = $request->input('damage_aqty');

    		if($damageAQty!=''){ 
	    		$damageAQty;
	    	}else{ 
	    		$damageAQty ='';
    		}

    		$returnQty = $request->input('return_qty');

    		if($returnQty!=''){ 
	    		$returnQty;
	    	}else{ 
	    		$returnQty ='';
    		}

    		$depot_code = $request->input('depot_code');
    		$account_code = $request->input('account_code');
    		$item_code = $request->input('item_code');
    		$trpt_code = $request->input('transporter_code');
    		$tran_code = $request->input('tran_code');
    		$vrno = $request->input('transaction_no');

	    	$data = array(
				"comp_code"    =>  $request->input('comp_code'),
				"fy_year"      =>  $request->input('fy_year'),
				"depot_code"   =>  $request->input('depot_code'),
				"vr_date"      =>  $Transaction_date,
				"vr_no"        =>  $request->input('transaction_no'),
				"invoice_no"   =>  $request->input('invoice_no'),
				"invoice_date" =>  $Invoice_date,
				"acc_code"     =>  $request->input('account_code'),
				"trpt_code"    =>  $request->input('transporter_code'),
				"truck_no"     =>  $request->input('vehicle_no'),
				"item_code"    =>  $request->input('item_code'),
				"sto_qty"      =>  $request->input('sto_qty'),
				"sto_aqty"     =>  $request->input('sto_aqty'),
				"qty_recd"     =>  $request->input('qty_recd'),
				"aqty_recd"    =>  $request->input('aqty_recd'),
				"short_qty"    =>  $sortQty,
				"short_aqty"   =>  $sortAQty,
				"damage_qty"   =>  $damageQty,
				"damage_aqty"  =>  $damageAQty,
				"return_qty"   =>  $returnQty,
				"flag"         =>  $request->input('flag'),
				"created_by"   =>  $request->session()->get('userid')
	 
	    	);

	    $saveData = DB::table('inward_trans')->insert($data);
	    	

			if($saveData){

				$datavr =array(
					'last_no'=>$vrno
				);
			$updatevr = DB::table('master_vrseq')->where('tran_code',$tran_code)->update($datavr);


				$getCode1= DB::table('code_access')->where('code',$depot_code)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode1)){

				 	 $getCode= DB::table('code_access')->where('code',$depot_code)->where('inward_trans',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'         =>$depot_code,
								'inward_trans' =>1,
								"created_by"   =>  $request->session()->get('userid')
					 	);

					 
					 	$saveData1 = DB::table('code_access')->where('code',$depot_code)->update($data1);

					 }


				 }else{

				 	$data1=array(
								'code'         =>$depot_code,
								'inward_trans' =>1,
								"created_by"   =>  $request->session()->get('userid')
					 	);

						
					$saveData1 = DB::table('code_access')->insert($data1);
				 }


				$getCode2= DB::table('code_access')->where('code',$account_code)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode2)){

				 	 $getCode = DB::table('code_access')->where('code',$account_code)->where('inward_trans',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'         =>$account_code,
								'inward_trans' =>1,
								"created_by"   =>  $request->session()->get('userid')
					 	);

					 	//DB::enableQueryLog();

					 	$saveData2 = DB::table('code_access')->where('code',$account_code)->update($data1);

					 	//dd(DB::getQueryLog());
					 }


				 }else{

				 	$data1=array(
								'code'         =>$account_code,
								'inward_trans' =>1,
								"created_by"   =>  $request->session()->get('userid')
					 	);

					//DB::enableQueryLog(); 	
					$saveData2 = DB::table('code_access')->insert($data1);

					//dd(DB::getQueryLog());
				 }

				 $getCode3= DB::table('code_access')->where('code',$trpt_code)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode3)){

				 	 $getCode = DB::table('code_access')->where('code',$trpt_code)->where('inward_trans',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'         =>$trpt_code,
								'inward_trans' =>1,
								"created_by"   =>$request->session()->get('userid')
					 	);

					 	//DB::enableQueryLog();

					 	$saveData3 = DB::table('code_access')->where('code',$item_code)->update($data1);

					 	//dd(DB::getQueryLog());
					 }


				 }else{

				 	$data1=array(
								'code'         =>$trpt_code,
								'inward_trans' =>1,
								"created_by"   =>  $request->session()->get('userid')
					 	);

					//DB::enableQueryLog(); 	
					$saveData3 = DB::table('code_access')->insert($data1);

					//dd(DB::getQueryLog());
				 }


				 $getCode4= DB::table('code_access')->where('code',$item_code)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode4)){

				 	 $getCode = DB::table('code_access')->where('code',$item_code)->where('inward_trans',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'       =>$item_code,
								'inward_trans'   =>1,
								"created_by" =>$request->session()->get('userid')
					 	);

					 	//DB::enableQueryLog();

					 	$saveData4 = DB::table('code_access')->where('code',$item_code)->update($data1);

					 	//dd(DB::getQueryLog());
					 }


				 }else{

				 	$data1=array(
								'code'         =>$item_code,
								'inward_trans' =>1,
								"created_by"   =>  $request->session()->get('userid')
					 	);

					//DB::enableQueryLog(); 	
					$saveData4 = DB::table('code_access')->insert($data1);

					//dd(DB::getQueryLog());
				 }


				if($saveData1 || $saveData2 || $saveData3 || $saveData4){

					$request->session()->flash('alert-success', 'Inward Transaction Was Successfully Added...!');
				return redirect('/view-inward-trans');

				}else{

					$request->session()->flash('alert-error', 'Inward Transaction Can Not Added...!');
				return redirect('/view-inward-trans');
				}

			} else {

				$request->session()->flash('alert-error', 'Inward Transaction Can Not Added...!');
				return redirect('/view-inward-trans');

			}

    }

    public function viewInwardTrnas(Request $request){

    	
    	if ($request->ajax()) {

		$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		 $CompanyCode   = $request->session()->get('company_name');

		 $macc_year   = $request->session()->get('macc_year');
		 

		if($user_type == 'admin'){

    	$data = DB::table('inward_trans')
				->select('inward_trans.*', 'master_depot.depot_name as depotName','master_acc.acc_name as accountName')
           		->leftjoin('master_acc', 'inward_trans.acc_code', '=', 'master_acc.acc_code')
           		->leftjoin('master_depot', 'inward_trans.depot_code', '=', 'master_depot.depot_code')
           		->where([['inward_trans.comp_code','=',$CompanyCode],['inward_trans.fy_year','=',$macc_year]])
           		->orderBy('id','DESC')
            	->get();


    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 $data = DB::table('inward_trans')
				->select('inward_trans.*', 'master_depot.depot_name as depotName','master_acc.acc_name as accountName')
           		->leftjoin('master_acc', 'inward_trans.acc_code', '=', 'master_acc.acc_code')
           		->leftjoin('master_depot', 'inward_trans.depot_code', '=', 'master_depot.depot_code')
            	->where([['inward_trans.created_by','=',$userid],['inward_trans.comp_code','=',$CompanyCode],['inward_trans.fy_year','=',$macc_year]])
            	->orderBy('id','DESC')
            	->get();

    	}else{

    		$data ='';
    	}

			return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<button type="button"  class="btn btn-primary btn-xs" data-toggle="modal" data-target="#inwardTransview" onclick="return inwardView('.$data->id.')"><i class="fa fa-eye" title="view"></i></button> | <a href="'.url('/edit-form-inward-trans/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#inwardTransDelete" class="btn btn-danger btn-xs" onclick="return deleteinwrd('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

    	}

         	$title = 'View Inward Transaction';

    		return view('admin.cf.transaction.view_inward_trans',compact('title'));
    }


   

    public function DeleteInwardTrans(Request $request){

        $id = $request->input('id');
        if ($id!='') {


        	$inward = DB::table('inward_trans')->where('id',$id)->get()->first();

        	$inward_depot_code = DB::table('inward_trans')->where('depot_code',$inward->depot_code)->get()->toArray();

        	$inward_acc_code = DB::table('inward_trans')->where('acc_code',$inward->acc_code)->get()->toArray();

        	$inward_item_code = DB::table('inward_trans')->where('item_code',$inward->item_code)->get()->toArray();

        	$inward_trpt_code = DB::table('inward_trans')->where('trpt_code',$inward->trpt_code)->get()->toArray();



        	$count =count($inward_depot_code);

        	if($count >1){
        		$Delete = DB::table('inward_trans')->where('id', $id)->delete();

        	}else{
        		$Delete = DB::table('inward_trans')->where('id', $id)->delete();

        		$data=array(

        			'inward_trans'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$inward->depot_code)->update($data);
        	
        	}



        	$inward_acc_count = count($inward_acc_code);

        	if($inward_acc_count >1){
        		$Delete1 = DB::table('inward_trans')->where('id', $id)->delete();

        	}else{
        		$Delete1 = DB::table('inward_trans')->where('id', $id)->delete();

        		$data=array(

        			'inward_trans'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$inward->acc_code)->update($data);
        	
        	}

        	
        	$inward_item_count = count($inward_item_code);

        	if($inward_item_count >1){
        		$Delete2 = DB::table('inward_trans')->where('id', $id)->delete();

        	}else{
        		$Delete2 = DB::table('inward_trans')->where('id', $id)->delete();

        		$data=array(

        			'inward_trans'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$inward->item_code)->update($data);
        	
        	}

        	
        	$inward_trpt_count = count($inward_trpt_code);

        	if($inward_trpt_count >1){
        		$Delete3 = DB::table('inward_trans')->where('id', $id)->delete();

        	}else{
        		$Delete3 = DB::table('inward_trans')->where('id', $id)->delete();

        		$data=array(

        			'inward_trans'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$inward->trpt_code)->update($data);
        	
        	}


        	if($Delete  &&  empty($Delete1) && empty($Delete2) && empty($Delete3)|| $Delete1  &&  empty($Delete) && empty($Delete2) && empty($Delete3) || $Delete2 &&  empty($Delete) && empty($Delete1) && empty($Delete3)  || $Delete3 &&  empty($Delete) && empty($Delete1) && empty($Delete2)){

			$request->session()->flash('alert-success', ' Inward Transaction Was Deleted Successfully...!');
			return redirect('/view-inward-trans');

			} else {

			$request->session()->flash('alert-error', 'Inward Transaction Can Not Deleted...!');
			return redirect('/view-inward-trans');

			}
			
		}else{

		$request->session()->flash('alert-error', 'Inward Transaction Not Found...!');
		return redirect('/view-inward-trans');

		}
	}

	 public function EditInwardTrans($id, Request $request){

	 	$title = 'Edit Inward Transaction';

	 	   $id = base64_decode($id);

    	if($id!=''){

    		$CompanyCode   = $request->session()->get('company_name');
			$MaccYear      = $request->session()->get('macc_year');
			$getcomcode    = explode('-', $CompanyCode);
			$CCFromSession = $getcomcode[0];

    	    $query = DB::table('inward_trans');
			$query->where('id', $id);
			$compData['inward_list'] = $query->get()->first();

			$compData['user_list']       = DB::table('master_depot')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
			$compData['acc_list']        = DB::table('master_acc')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
			$compData['area_list']       = DB::table('master_area')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
			$compData['transpoter_list'] = DB::table('master_acctype')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
			$compData['item_list']       = DB::table('master_item')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();

			//DB::enableQueryLog();

			$item_um_aum_list = DB::table('master_fy')->where(['comp_code'=>$CCFromSession,'fy_code'=>$MaccYear])->get();

			//dd(DB::getQueryLog());

				foreach ($item_um_aum_list as $key) {
				$compData['fromDate'] =  $key->fy_from_date;
				$compData['toDate']   =  $key->fy_to_date;
				}


			return view('admin.cf.transaction.edit_inward_trans', $compData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Company Not Found...!');
			return redirect('/view-inward-trans');
		}
    }

    public function UpdateInwardTrans(Request $request){


    	$trDate = $request->input('transaction_date');

    	$Transaction_date = date("Y-m-d", strtotime($trDate));


    	$InvoiceDate = $request->input('invoice_date');


    	$Invoice_date = date("Y-m-d", strtotime($InvoiceDate));


	    	$validate = $this->validate($request, [

				
				'depot_code'       => 'required',
				'transaction_date' => 'required',
				'transaction_no'   => 'required',
				'invoice_no'       => 'required',
				'invoice_date'     => 'required',
				'account_code'     => 'required',
				'transporter_code' => 'required',
				'vehicle_no'       => 'required',
				'item_code'        => 'required',
				'sto_qty'          => 'required',
				'sto_aqty'         => 'required',
				'qty_recd'         => 'required',
				'aqty_recd'        => 'required',
				'flag'             => 'required',

			]);
			
	    	$id =  $request->input('inward_id');

	    	$sortQty = $request->input('sort_qty');

			if($sortQty!=''){ 
	    		$sortQty;
	    	}else{ 
	    		$sortQty ='';
    		}

    		$sortAQty = $request->input('sort_aqty');

    		if($sortAQty!=''){ 
	    		$sortAQty;
	    	}else{ 
	    		$sortAQty ='';
    		}

    		$damageQty = $request->input('damage_qty');

    		if($damageQty!=''){ 
	    		$damageQty;
	    	}else{ 
	    		$damageQty ='';
    		}

    		$damageAQty = $request->input('damage_aqty');

    		if($damageAQty!=''){ 
	    		$damageAQty;
	    	}else{ 
	    		$damageAQty ='';
    		}

    		$returnQty = $request->input('return_qty');

    		if($returnQty!=''){ 
	    		$returnQty;
	    	}else{ 
	    		$returnQty ='';
    		}

    		$updatedDate = date('Y-m-d'); 

    		$depot_code = $request->input('depot_code');
    		$account_code = $request->input('account_code');

	    	$data = array(
				"comp_code"       =>  $request->input('comp_code'),
				"fy_year"         =>  $request->input('fy_year'),
				"depot_code"      =>  $request->input('depot_code'),
				"vr_date"         =>  $Transaction_date,
				"vr_no"           =>  $request->input('transaction_no'),
				"invoice_no"      =>  $request->input('invoice_no'),
				"invoice_date"    =>  $Invoice_date,
				"acc_code"        =>  $request->input('account_code'),
				"trpt_code"       =>  $request->input('transporter_code'),
				"truck_no"        =>  $request->input('vehicle_no'),
				"item_code"       =>  $request->input('item_code'),
				"sto_qty"         =>  $request->input('sto_qty'),
				"sto_aqty"        =>  $request->input('sto_aqty'),
				"qty_recd"        =>  $request->input('qty_recd'),
				"aqty_recd"       =>  $request->input('aqty_recd'),
				"short_qty"       =>  $sortQty,
				"short_aqty"      =>  $sortAQty,
				"damage_qty"      =>  $damageQty,
				"damage_aqty"     =>  $damageAQty,
				"return_qty"      =>  $returnQty,
				"flag"            =>  $request->input('flag'),
				"last_updat_by"   =>  $request->session()->get('userid'),
				"last_updat_date" =>  $updatedDate

	 
	    	);

	    	//print_r($data);exit();
	    	$saveData = DB::table('inward_trans')->where('id', $id)->update($data);

	    	

			if ($saveData) {

				$request->session()->flash('alert-success', 'Inward Transaction Was Successfully Updated...!');
				return redirect('/view-inward-trans');

			} else {

				$request->session()->flash('alert-error', 'Inward Transaction Can Not Updated...!');
				return redirect('/view-inward-trans');

			}

    }
/*inward Transaction end*/

/*outward Transaction start*/

	public function OutwardTrans(Request $request){

		$title = 'Add Outward Transaction';

		$CompanyCode   = $request->session()->get('company_name');
		$MaccYear      = $request->session()->get('macc_year');
		$getcomcode    = explode('-', $CompanyCode);
		$CCFromSession = $getcomcode[0];

		$userData['acc_list']  = DB::table('master_acc')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
		$userData['user_list'] = DB::table('master_depot')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
		$userData['area_list'] = DB::table('master_area')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
		
		//DB::enableQueryLog();

		$item_um_aum_list = DB::table('master_fy')->where(['comp_code'=>$CCFromSession,'fy_code'=>$MaccYear])->get();

		//dd(DB::getQueryLog());

				foreach ($item_um_aum_list as $key) {
				$userData['fromDate'] =  $key->fy_from_date;
				$userData['toDate']   =  $key->fy_to_date;
				}

		$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		

		if($user_type == 'admin'){

	
			$OutwardTransNo =  DB::table('outward_trans')->where([['comp_code','=',$CompanyCode],['fy_year','=',$MaccYear]])->get()->toArray();
			///print_r($CompanyCode);exit;

			//print_r($OutwardTransNo);exit;
		
			if (!empty($OutwardTransNo)) {

				$TblId = DB::table('outward_trans')->max('id');

				$userData['trn_no'] = DB::table('outward_trans')->where([['id','=',$TblId],['comp_code','=',$CompanyCode],['fy_year','=',$MaccYear]])->get()->first();

				//print_r($userData['trn_no']);exit;

			}else{

				$mas_trans = DB::table('master_transaction')->where([['tran_head','=','Outward'],['comp_name','=',$CompanyCode],['fiscal_year','=',$MaccYear]])->get()->first();

				if(!empty($mas_trans)){

					$TrCode = $mas_trans->tran_code;

				$userData['trn_no_vr'] = DB::table('master_vrseq')->where([['tran_code','=',$TrCode],['comp_name','=',$CompanyCode],['fiscal_year','=',$MaccYear]])->get()->first();

				}else{

					$userData['trn_no_vr']=array();
				}

				
				

			}
    	
    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    		$OutwardTransNo =  DB::table('outward_trans')->where([['comp_code','=',$CompanyCode],['fy_year','=',$MaccYear]])->get()->toArray();
		

			if (!empty($OutwardTransNo)) {

				$TblId = DB::table('outward_trans')->max('id');

				$userData['trn_no'] = DB::table('outward_trans')->where([['id','=',$TblId],['created_by','=',$userid],['comp_code','=',$CompanyCode],['fy_year','=',$MaccYear]])->get()->first();
				
			}else{

				$mas_trans = DB::table('master_transaction')->where([['tran_head','=','Outward'],['comp_name','=',$CompanyCode],['fiscal_year','=',$MaccYear]])->get()->first();

				if(!empty($mas_trans)){

					$TrCode = $mas_trans->tran_code;

				$userData['trn_no_vr'] = DB::table('master_vrseq')->where([['tran_code','=',$TrCode],['created_by','=',$userid],['comp_name','=',$CompanyCode],['fiscal_year','=',$MaccYear]])->get()->first();

				}else{

					$userData['trn_no_vr']=array();
				}

				
				
			}
    	}else{

    		$data ='';
    	}

    	$OutwardTrans01 =  DB::table('outward_trans')->where([['comp_code','=',$CompanyCode],['fy_year','=',$MaccYear]])->get()->toArray();

    	if (!empty($OutwardTrans01)) {

    		$mas_trans = DB::table('master_transaction')->where([['tran_head','=','Outward'],['comp_name','=',$CompanyCode],['fiscal_year','=',$MaccYear]])->get()->first();

			$TrCode = $mas_trans->tran_code;


    		$mas_vrseq1 = DB::table('master_vrseq')->where([['tran_code','=',$TrCode],['comp_name','=',$CompanyCode],['fiscal_year','=',$MaccYear]])->get()->first();

    		$ToNo = $mas_vrseq1->to_no;

			$TblId = DB::table('outward_trans')->max('id');

			$trn_no1 = DB::table('outward_trans')->where([['id','=',$TblId],['created_by','=',$userid],['comp_code','=',$CompanyCode],['fy_year','=',$MaccYear]])->get()->first();

			if (!empty($trn_no1)) {
				$TrNo01 = $trn_no1->tr_no;
			}else{
				$TrNo01 = 0;
			}

    	}else{

    		$TrNo01 = 1;
    		$ToNo   = 2;	

		}

		

			if ($TrNo01 > $ToNo) {

				$check_trNo = 0;
				
			}else{

				$check_trNo = 1;
			}


    	return view('admin.cf.transaction.outward_trans',$userData+compact('title','check_trNo','TrCode'));
    }

    public function SaveOutwardTrans(Request $request){

    	    	$trDate = $request->input('transaction_date');

    	        $Transaction_date = date("Y-m-d", strtotime($trDate));

    	        //print_r($Transaction_date);exit;

    	    	$despatch_type =  $request->input('despatch_type');

    	    	if($despatch_type == 'ST'){

    	    		$validate = $this->validate($request, [

						'depot_code'       => 'required',
						'account_code'     => 'required',
						'transaction_date' => 'required',
						'transaction_no'   => 'required',
						'despatch_type'    => 'required',
						'chalan_no'        => 'required',
						'area_code'        => 'required',
						'driver_name'      => 'required',
						'driver_number'    => 'required',
						'invoice_no'       => 'required',
					]);

    	    	}else{

    	    		$validate = $this->validate($request, [

						'depot_code'       => 'required',
						'account_code'     => 'required',
						'transaction_date' => 'required',
						'transaction_no'   => 'required',
						'despatch_type'    => 'required',
						'chalan_no'        => 'required',
						'area_code'        => 'required',
						'driver_name'      => 'required',
						'driver_number'    => 'required',
					]);

    	    	}

    	    	$developmentMode = true;
        		$mailer = new PHPMailer($developmentMode);

    	    	$AccCode =  $request->input('account_code');

				$getemail = DB::table('master_acc')->where(['acc_code'=>$AccCode,'acctype_code'=>'T'])->get();
				//print_r($getemail);exit;

    	    	foreach ($getemail as $row) {
    	    		$accEmailId = $row->email_id;
    	    		$transName = $row->acc_name;
    	    	}

    	    	$allaccount = DB::select("SELECT * FROM `master_acc` WHERE acc_code='$AccCode' AND acctype_code!='T' ");

    	    	if(!empty($allaccount)){
    	    		foreach ($allaccount as $rowacc) {
	    	    		$accNAme = $rowacc->acc_name;
	    	    	}
    	    	}else{
    	    		$accNAme = '-';
    	    	}
    	    	

        		$areaCode = $request->input('area_code');

        		$getareaname = DB::select("SELECT * FROM `master_area` WHERE code='$areaCode'");
        		if(!empty($getareaname)){

	        		foreach ($getareaname as $rowar) {
	        			$areaName = $rowar->name;
        			}
        		}else{
        			$areaName = '';
        		}

        		$itemname = $request->input('item');
        		$itmname = DB::select("SELECT * FROM `master_itemum` WHERE item_code='$itemname'");

        		if(!empty($itmname)){
        			foreach ($itmname as $itmrow) {
	        			$umcode = $itmrow->um_code;
	        			$aumcode = $itmrow->aum;
        			}
    	    		
    	    	}else{
	    	    	$umcode = '-';
    	    		$aumcode = '-';
    	   		}
        		
                
				$vehicle_num   = $request->input('vehicle_no');
				$despatch_qty  = $request->input('despatch_qty');
				$invoic_num    = $request->input('invoice_no');
				$trip_trans_no = $request->input('transaction_no');
				$driver_Name   = $request->input('driver_name');
				$driver_number = $request->input('driver_number');
				$despatchAqty = $request->input('despatch_aqty');

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
                $mailer->addReplyTo('kamini.khapre@aceworth.in', 'Aceworth Private Limitate');

                $mailer->isHTML(true);
                $mailer->Subject = 'Outward Transaction';

                $message = '<div style="padding-left: 14%;font-size: 16px;font-weight: 600;color: gray;">Outward Transaction</div><table id="OutwardTrans" style="border: 1px solid #a99999;border-radius: 5px;padding: 11px;border-top: 3px solid #3c8dbc;">
  <tbody><tr><td><b>Invoice Number</b></td><td><b>'.$invoic_num.'</b></td></tr><tr><td><b>Invoice Date</b></td><td><b>2020-12-05 06:11:08</b></td></tr><tr><td><b>Route</b></td><td><b>'.$areaName.'</b></td></tr><tr><td><b>Trip Id</b></td><td>'.$trip_trans_no.'</td></tr><tr><td><b>Truck Number</b></td><td><b>'.$vehicle_num.'</b></td></tr><tr><td><b>Transporter Name</b></td><td>'.$transName.'</td></tr><tr><td><b>Driver Name</b></td><td>'.$driver_Name.'</td></tr><tr><td><b>Driver Contact Number(s)</b></td><td>'.$driver_number.'</td></tr><tr><td><b>Ship To Party</b></td><td>'.$accNAme.'</td></tr><tr><td><b>Sold To Party</b></td><td>'.$accNAme.'</td></tr><tr><td><b>Invoice Quantity</b></td><td>'.$despatch_qty.'-'.$umcode.'-'.$despatchAqty.'-'.$aumcode.'</td></tr></tbody></table>';

                $mailer->Body = $message;

        $itemcd = $request->input('item');

			if($itemcd!=''){ 
	    		$itemcd;
	    	}else{ 
	    		$itemcd ='';
    		}


        $desQty = $request->input('despatch_qty');

			if($desQty!=''){ 
	    		$desQty;
	    	}else{ 
	    		$desQty ='';
    		}

    	$destAQty = $request->input('despatch_aqty');

			if($destAQty!=''){ 
	    		$destAQty;
	    	}else{ 
	    		$destAQty ='';
    		}

    	$vehiclNo = $request->input('vehicle_no');

			if($vehiclNo!=''){ 
	    		$vehiclNo;
	    	}else{ 
	    		$vehiclNo ='';
    		}

    	$transCode = $request->input('transport_code');

			if($transCode!=''){ 
	    		$transCode;
	    	}else{ 
	    		$transCode ='';
    		}

		$depot_code   = $request->input('depot_code');
		$account_code = $request->input('account_code');
		$area_code = $request->input('area_code');
		$transcode     = $request->input('Trancode');
		$vrno     = $request->input('transaction_no');
    	 $data = array(
					"comp_code"     =>  $request->input('comp_code'),
					"fy_year"       =>  $request->input('fy_year'),
					"depot_code"    =>  $request->input('depot_code'),
					"tr_date"       =>  $Transaction_date,
					"tr_no"         =>  $request->input('transaction_no'),
					"chalan_no"     =>  $request->input('chalan_no'),
					"acc_code"      =>  $request->input('account_code'),
					"area_code"     =>  $request->input('area_code'),
					"trans_code"    =>  $transCode,
					"truck_no"      =>  $vehiclNo,
					"item_code"     =>  $itemcd,
					"desp_qty"      =>  $desQty,
					"desp_aqty"     =>  $destAQty,
					"inv_no"        =>  $request->input('invoice_no'),
					"desp_type"     =>  $request->input('despatch_type'),
					"driver_name"   =>  $request->input('driver_name'),
					"driver_number" =>  $request->input('driver_number'),
					"created_by"    =>  $request->session()->get('userid')
				
	    	);

		$saveData = DB::table('outward_trans')->insert($data);

		$datavr =array(
					'last_no'=>$vrno
				);
			$updatevr = DB::table('master_vrseq')->where('tran_code',$transcode)->update($datavr);

		      $mailSend = $mailer->send();
                $mailer->ClearAllRecipients();

			if ($saveData && $mailSend) {



				$getCode1= DB::table('code_access')->where('code',$depot_code)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode1)){

				 	 $getCode= DB::table('code_access')->where('code',$depot_code)->where('outward_trans',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'          =>$depot_code,
								'outward_trans' =>1,
								"created_by"    =>  $request->session()->get('userid')
					 	);

					 	//DB::enableQueryLog();

					 	$saveData1 = DB::table('code_access')->where('code',$depot_code)->update($data1);

					 	//dd(DB::getQueryLog());
					 }


				 }else{

				 	$data1=array(
								'code'          =>$depot_code,
								'outward_trans' =>1,
								"created_by"    =>  $request->session()->get('userid')
					 	);

					//DB::enableQueryLog(); 	
					$saveData1 = DB::table('code_access')->insert($data1);

					//dd(DB::getQueryLog());
				 }


				$getCode2= DB::table('code_access')->where('code',$account_code)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode2)){

				 	 $getCode = DB::table('code_access')->where('code',$account_code)->where('outward_trans',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'          =>$account_code,
								'outward_trans' =>1,
								"created_by"    =>  $request->session()->get('userid')
					 	);

					 	//DB::enableQueryLog();

					 	$saveData2 = DB::table('code_access')->where('code',$account_code)->update($data1);

					 	//dd(DB::getQueryLog());
					 }


				 }else{

				 	$data1=array(
								'code'          =>$account_code,
								'outward_trans' =>1,
								"created_by"    =>  $request->session()->get('userid')
					 	);

					//DB::enableQueryLog(); 	
					$saveData2 = DB::table('code_access')->insert($data1);

					//dd(DB::getQueryLog());
				 }


				 $getCode3= DB::table('code_access')->where('code',$area_code)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode3)){

				 	 $getCode = DB::table('code_access')->where('code',$area_code)->where('outward_trans',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'          =>$area_code,
								'outward_trans' =>1,
								"created_by"    =>$request->session()->get('userid')
					 	);

					 	//DB::enableQueryLog();

					 	$saveData3 = DB::table('code_access')->where('code',$area_code)->update($data1);

					 	//dd(DB::getQueryLog());
					 }


				 }else{

				 	$data1=array(
								'code'          =>$area_code,
								'outward_trans' =>1,
								"created_by"    =>  $request->session()->get('userid')
					 	);

					//DB::enableQueryLog(); 	
					$saveData3 = DB::table('code_access')->insert($data1);

					//dd(DB::getQueryLog());
				 }


				 $getCode4= DB::table('code_access')->where('code',$itemcd)->get()->toArray();
				 //print_r($getCode1);exit;

				 if(!empty($getCode4)){

				 	 $getCode = DB::table('code_access')->where('code',$itemcd)->where('outward_trans',0)->get();

					 if($getCode){

					 	$data1=array(
								'code'          =>$itemcd,
								'outward_trans' =>1,
								"created_by"    =>$request->session()->get('userid')
					 	);

					 	//DB::enableQueryLog();

					 	$saveData4 = DB::table('code_access')->where('code',$itemcd)->update($data1);

					 	//dd(DB::getQueryLog());
					 }


				 }else{

				 	$data1=array(
								'code'          =>$itemcd,
								'outward_trans' =>1,
								"created_by"    =>  $request->session()->get('userid')
					 	);

					//DB::enableQueryLog(); 	
					$saveData4 = DB::table('code_access')->insert($data1);

					//dd(DB::getQueryLog());
				 }


				if($saveData1 || $saveData2 || $saveData3 || $saveData4){

					$request->session()->flash('alert-success', 'Outward Transaction Was Successfully Added...!');
				return redirect('/view-outward-trans');

				}else{

					$request->session()->flash('alert-error', 'Outward Transaction Can Not Added...!');
				return redirect('/view-outward-trans');
				}

			}else {

				$request->session()->flash('alert-error', 'Outward Transaction Can Not Added...!');
				return redirect('/view-outward-trans');

			}
    }

       public function viewOutwardTrans(Request $request){

    	if ($request->ajax()) {

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){

    	
    	$data = DB::table('outward_trans')
				->select('outward_trans.*', 'master_depot.depot_name as depotName','master_acc.acc_name as accountName')
           		->leftjoin('master_acc', 'outward_trans.acc_code', '=', 'master_acc.acc_code')
           		->leftjoin('master_depot', 'outward_trans.depot_code', '=', 'master_depot.depot_code')
           		->where([['outward_trans.comp_code','=',$CompanyCode],['outward_trans.fy_year','=',$macc_year]])
           		->orderBy('id','DESC')
            	->get();
    	
    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	$data = DB::table('outward_trans')
				->select('outward_trans.*', 'master_depot.depot_name as depotName','master_acc.acc_name as accountName')
           		->leftjoin('master_acc', 'outward_trans.acc_code', '=', 'master_acc.acc_code')
           		->leftjoin('master_depot', 'outward_trans.depot_code', '=', 'master_depot.depot_code')
           		->where([['outward_trans.created_by','=',$userid],['outward_trans.comp_code','=',$CompanyCode],['outward_trans.fy_year','=',$macc_year]])
           		->orderBy('id','DESC')
            	->get();

    	}else{

    		$data ='';
    	}

    	//return DataTables()->of($data)->make(true);

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<button type="button"  class="btn btn-primary btn-xs" data-toggle="modal" data-target="#outwardtransView" onclick="return outwardView('.$data->id.')"><i class="fa fa-eye" title="view"></i></button> | <a href="'.url('/edit-form-outward-trans/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#OutwardTranssDelete" class="btn btn-danger btn-xs" onclick="return deleteoutwrd('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);


    }

    	 $title = 'View Outward Transaction';

    	 return view('admin.cf.transaction.view_outward_trans',compact('title'));

    }

    public function DeleteOutwardTrans(Request $request){

        $id = $request->input('id');
        if ($id!='') {

		
			$outward = DB::table('outward_trans')->where('id',$id)->get()->first();

        	$outward_depot_code = DB::table('outward_trans')->where('depot_code',$outward->depot_code)->get()->toArray();

        	$outward_acc_code = DB::table('outward_trans')->where('acc_code',$outward->acc_code)->get()->toArray();

        	$outward_item_code = DB::table('outward_trans')->where('item_code',$outward->item_code)->get()->toArray();

        	$outward_area_code = DB::table('outward_trans')->where('area_code',$outward->area_code)->get()->toArray();



        	$count =count($outward_depot_code);

        	if($count >1){
        		$Delete = DB::table('outward_trans')->where('id', $id)->delete();

        	}else{
        		$Delete = DB::table('outward_trans')->where('id', $id)->delete();

        		$data=array(

        			'outward_trans'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$outward->depot_code)->update($data);
        	
        	}



        	$outward_acc_count = count($outward_acc_code);

        	if($outward_acc_count >1){
        		$Delete1 = DB::table('outward_trans')->where('id', $id)->delete();

        	}else{
        		$Delete1 = DB::table('outward_trans')->where('id', $id)->delete();

        		$data=array(

        			'outward_trans'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$outward->acc_code)->update($data);
        	
        	}

        	
        	$outward_item_count = count($outward_item_code);

        	if($outward_item_count >1){
        		$Delete2 = DB::table('outward_trans')->where('id', $id)->delete();

        	}else{
        		$Delete2 = DB::table('outward_trans')->where('id', $id)->delete();

        		$data=array(

        			'outward_trans'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$outward->item_code)->update($data);
        	
        	}

        	
        	$outward_area_count = count($outward_area_code);

        	if($outward_area_count >1){

        		$Delete3 = DB::table('outward_trans')->where('id', $id)->delete();

        	}else{
        		$Delete3 = DB::table('outward_trans')->where('id', $id)->delete();

        		$data=array(

        			'outward_trans'=>0

        		);

        	$saveData = DB::table('code_access')->where('code',$outward->area_code)->update($data);
        	
        	}

        	if($Delete  &&  empty($Delete1) && empty($Delete2) && empty($Delete3)|| $Delete1  &&  empty($Delete) && empty($Delete2) && empty($Delete3) || $Delete2 &&  empty($Delete) && empty($Delete1) && empty($Delete3)  || $Delete3 &&  empty($Delete) && empty($Delete1) && empty($Delete2)){

			$request->session()->flash('alert-success', 'Outward Tranaction Data Was Deleted Successfully...!');
			return redirect('/view-outward-trans');

			} else {

			$request->session()->flash('alert-error', 'Outward Tranaction Data Can Not Deleted...!');
			return redirect('/view-outward-trans');

			}

		}else{

		$request->session()->flash('alert-error', 'Outward Tranaction Data Not Found...!');
		return redirect('/view-outward-trans');

		}
	}

	public function EditOutwardTrans($id,Request $request){

		$title = 'Edit Outward Tranaction';

		$id = base64_decode($id);

		$CompanyCode   = $request->session()->get('company_name');
		$MaccYear      = $request->session()->get('macc_year');
		$getcomcode    = explode('-', $CompanyCode);
		$CCFromSession = $getcomcode[0];

		if($id!=''){
    	    $query = DB::table('outward_trans');
			$query->where('id', $id);
			$compData['outward_trans_list'] = $query->get()->first();
			
			$compData['user_list']          = DB::table('master_depot')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
			
			$compData['acc_list']           = DB::table('master_acc')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
			
			$compData['area_list']          = DB::table('master_area')->where(['comp_name' => $CompanyCode, 'fiscal_year' => $MaccYear, 'flag'=>0])->get();
			
			/*$compData['transpoter_list']    = DB::table('transporter')->get();
			
			$compData['item_list']          = DB::table('master_item')->get();*/


			$item_um_aum_list = DB::table('master_fy')->where(['comp_code'=>$CCFromSession,'fy_code'=>$MaccYear])->get();


				foreach ($item_um_aum_list as $key) {
					$compData['fromDate'] =  $key->fy_from_date;
					$compData['toDate']   =  $key->fy_to_date;
				}

			return view('admin.cf.transaction.edit_outward_list', $compData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Company Not Found...!');
			return redirect('/view-outward-trans');
		}

	}

	public function UpdateOutwardTrans(Request $request){
		
    	 $despatch_type =  $request->input('despatch_type');

    	 $trDate = $request->input('transaction_date');

        $Transaction_date = date("Y-m-d", strtotime($trDate));

    	    	if($despatch_type == 'ST'){

    	    		$validate = $this->validate($request, [

						'depot_code'       => 'required',
						'account_code'     => 'required',
						'transaction_date' => 'required',
						'transaction_no'   => 'required',
						'despatch_type'    => 'required',
						'chalan_no'        => 'required',
						'area_code'        => 'required',
						'driver_name'      => 'required',
						'driver_number'    => 'required',
						'invoice_no'       => 'required',
					]);

    	    	}else{
    	    		
    	    		$validate = $this->validate($request, [

						'depot_code'       => 'required',
						'account_code'     => 'required',
						'transaction_date' => 'required',
						'transaction_no'   => 'required',
						'despatch_type'    => 'required',
						'chalan_no'        => 'required',
						'area_code'        => 'required',
						'driver_name'      => 'required',
						'driver_number'    => 'required',
					]);

    	    	}

    	 $id= $request->input('outward_id');
    	 $updatedDate = date("Y-m-d");

    	 $itemcd = $request->input('item');

			if($itemcd!=''){ 
	    		$itemcd;
	    	}else{ 
	    		$itemcd ='';
    		}


        $desQty = $request->input('despatch_qty');

			if($desQty!=''){ 
	    		$desQty;
	    	}else{ 
	    		$desQty ='';
    		}

    	$destAQty = $request->input('despatch_aqty');

			if($destAQty!=''){ 
	    		$destAQty;
	    	}else{ 
	    		$destAQty ='';
    		}

    	$vehiclNo = $request->input('vehicle_no');

			if($vehiclNo!=''){ 
	    		$vehiclNo;
	    	}else{ 
	    		$vehiclNo ='';
    		}

    	$transCode = $request->input('transport_code');

			if($transCode!=''){ 
	    		$transCode;
	    	}else{ 
	    		$transCode ='';
    		}
    	 $data = array(
					"comp_code"       =>  $request->input('comp_code'),
					"fy_year"         =>  $request->input('fy_year'),
					"depot_code"      =>  $request->input('depot_code'),
					"tr_date"         =>  $Transaction_date,
					"tr_no"           =>  $request->input('transaction_no'),
					"chalan_no"       =>  $request->input('chalan_no'),
					"acc_code"        =>  $request->input('account_code'),
					"area_code"       =>  $request->input('area_code'),
					"trans_code"      =>  $transCode,
					"truck_no"        =>  $vehiclNo,
					"item_code"       =>  $itemcd,
					"desp_qty"        =>  $desQty,
					"desp_aqty"       =>  $destAQty,
					"inv_no"          =>  $request->input('invoice_no'),
					"desp_type"       =>  $request->input('despatch_type'),
					"driver_name"     =>  $request->input('driver_name'),
					"driver_number"   =>  $request->input('driver_number'),
					"last_updat_by"   =>  $request->session()->get('userid'),
					"last_updat_date" =>  $updatedDate
				
	    	);

    	 $saveData = DB::table('outward_trans')->where('id', $id)->update($data);
    	

			if ($saveData) {

				$request->session()->flash('alert-success', 'Outward Transaction Was Successfully Updated...!');
				return redirect('/view-outward-trans');

			} else {

				$request->session()->flash('alert-error', 'Outward Transaction Can Not Updated...!');
				return redirect('/view-outward-trans');

			}


	}


/*outward Transaction end*/

/*fetch invoice no when select desptach type*/
  public function Dpt_Type_Ajax(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$inv_no = $request->input('inv_no');
	    	$desp_type = $request->input('desp_type');
	    	$comp_code = $request->input('comp_code');
	    	$fy_year = $request->input('fy_year');
	    
	    	/*$item_um_aum_list = DB::select("SELECT inward_trans.item_code,inward_trans.truck_no,inward_trans.invoice_no,inward_trans.trpt_code,inward_trans.sto_qty,inward_trans.sto_aqty FROM `inward_trans` WHERE inward_trans.invoice_no='$inv_no' AND inward_trans.comp_code ='$comp_code' AND  inward_trans.fy_year='$fy_year' ");*/

	    	$item_um_aum_list = DB::select("SELECT inward_trans.item_code,inward_trans.truck_no,inward_trans.invoice_no,inward_trans.trpt_code,inward_trans.sto_qty,inward_trans.sto_aqty FROM `inward_trans` WHERE inward_trans.invoice_no='$inv_no'AND inward_trans.flag='$desp_type' AND inward_trans.comp_code ='$comp_code' AND  inward_trans.fy_year='$fy_year' ");


	    	/*$item_um_aum_list = DB::table('inward_trans')
				->select('inward_trans.item_code','inward_trans.truck_no','inward_trans.invoice_no','inward_trans.trpt_code','inward_trans.sto_qty','inward_trans.sto_aqty')
           		->where([['inward_trans.invoice_no','=',$inv_no],['inward_trans.comp_code','=',$comp_code],['inward_trans.fy_year','=',$fy_year]])
            	->get();*/

    		if ($item_um_aum_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_um_aum_list ;

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
/*fetch invoice no when select desptach type*/



/*get UM and AUM from master_itemum table for edit pages*/

public function Get_UmAum_Show_In_Edit(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$item_code = $request->input('item_code');
	    
	    	 $item_um_aum_list = DB::table('master_itemum')->where('item_code',$item_code)->get();
    		if ($item_um_aum_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_um_aum_list ;

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

/*get UM and AUM from master_itemum table for edit pages*/


/*fetch all data on model load outward form*/

public function outward_data_fetch(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$formid = $request->input('id');
	    
	    	$fetch_reocrd = DB::table('outward_trans')->where('id',$formid)->get();

    		if ($fetch_reocrd) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fetch_reocrd ;

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

/*fetch all data on model load outward form*/



/*fetch all data on model load inward form*/
public function inward_data_fetch(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$formid = $request->input('id');
	    
	    	$fetch_reocrd = DB::table('inward_trans')->where('id',$formid)->get();

    		if ($fetch_reocrd) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fetch_reocrd ;

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

 /*fetch all data on model load inward form*/


 /*fetch all data on model load sapbill form*/
public function sap_bill_fetch(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$formid = $request->input('id');
	    
	    	//DB::enableQueryLog();
	    	$fetch_reocrd = DB::table('sap_bill')->where('id',$formid)->get();
	    	//dd(DB::getQueryLog());


    		if ($fetch_reocrd) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fetch_reocrd ;

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

 // start leave transaction

    


    



    public function ProfitCenterName(Request $request){

    	$pfctcode=$request->pfctcode;
        
        // print_r($pfctcode);exit;
    	$response_array = array();
    	

		if ($request->ajax()) {

	    	$fetch_reocrd = DB::table('master_pfct')->where('pfct_code', $pfctcode)->get()->first();
        

    		if ($fetch_reocrd) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fetch_reocrd ;

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
    	

    	if ($transleaveId!='') {
    		try{

    		$Delete = DB::table('master_leave_transaction')->where('id', $transleaveId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Leave Transaction Was Deleted Successfully...!');
				return redirect('/finance/transaction/view-leave-trans');

			} else {

				$request->session()->flash('alert-error', 'Leave Transaction Can Not Deleted...!');
				return redirect('/finance/transaction/view-leave-trans');

			}
		}
		catch(Exception $ex)
			{
			    $request->session()->flash('alert-error', 'Leave Transaction Can not be Deleted...! Used In Another Transaction...!');
					return redirect('/finance/transaction/view-leave-trans');
			}

    	}else{

    		$request->session()->flash('alert-error', 'Zone  Not Found...!');
			return redirect('/finance/transaction/view-leave-trans');

    	}

	}

	
 // end leave transaction



 // start employee pay trascation 

   


    
 // end employee pay transaction

    // start Emp Payroll structure

    

    

	// public function GradecodePayroll(Request $request){
	// 	$gradecode = $request->input('grade_code');

	// 	$data = DB::table('master_employee_wage_type')->where('grade_code','A+')->get()->toArray();

	// 	return view('admin.cf.transaction.emp_payroll_structure',$data+compact());

	// }

	

    // end emp Payroll Structure

 /*fetch all data on model load sapbill form*/






}
