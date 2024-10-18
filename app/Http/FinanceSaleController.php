<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Session;
use PHPMailer\PHPMailer\PHPMailer;
use DataTables;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Schema;
use PDF;


class FinanceSaleController extends Controller
{
    
	public function __cunstruct(Request $request,$data){

		//$this->data = "smit@121";

	}




	/* ------- approve common function ------ */
	
	public function approve_Trans($bodyTable,$bodyCol,$transCode,$seriesCode,$apvTable,$comp_code,$fy_code,$pfct_code,$trans_code,$series_code,$vr_no,$vr_date,$createdBy,$head_Id,$apvCol,$headCol){

		$getbody = DB::table($bodyTable)->orderBy($bodyCol, 'DESC')->get()->first();

		$getvrnoCount  = DB::table($bodyTable)->where('VRNO',$getbody->VRNO)->get()->toArray();

		$sl_no=array();

		foreach ($getvrnoCount as $keyS){
			
			$sl_no[]= $keyS->SLNO;
		}

		$vrnocount = count($getvrnoCount);
		
		$getapprove =	DB::SELECT("SELECT t1.*,t2.* FROM MASTER_CONFIG_APPROVE t1  LEFT JOIN USER_APPROVE_IND t2 ON t2.APPROVE_USER = t1.APPROVE_IND WHERE t1.TRAN_CODE='$transCode' AND t1.SERIES_CODE='$seriesCode'");

		if($getapprove){

			$configapprove=array();
			$approveind=array();
			$userid=array();

			foreach ($getapprove as $key) {
				# code...
				$configapprove[] =$key->TRAN_CODE;
				$approveind[]    =$key->APPROVE_IND;
				$userid[]        =$key->USER_CODE;
				$level_no[]      =$key->LAVEL_NAME;

			}

			$countApv = count($configapprove);


			for ($s=0; $s < $countApv; $s++) {

				for ($b=0; $b < $vrnocount; $b++) { 

					$PApvH = DB::select("SELECT MAX($apvCol) as apvCol FROM $apvTable");
					$apvID = json_decode(json_encode($PApvH), true); 
				
					if(empty($apvID[0]['apvCol'])){
						$apv_Id = 1;
					}else{
						$apv_Id = $apvID[0]['apvCol']+1;
					}

					if($level_no[$s]==1){

						$approve_status=3;

						$data_approve = array(
								$headCol         =>$head_Id,
								$apvCol          =>$apv_Id,
								'COMP_CODE'      =>$comp_code,
								'FY_CODE'        =>$fy_code,
								'PFCT_CODE'      =>$pfct_code,
								'TRAN_CODE'      =>$trans_code,
								'SERIES_CODE'    =>$series_code,
								'VRNO'           =>$vr_no,
								'SLNO'           =>$sl_no[$b],
								'VRDATE'         =>$vr_date,
								'APPROVE_IND'    =>$approveind[$s],
								'APPROVE_USER'   =>$userid[$s],
								'LEVEL_NO'       =>$level_no[$s],
								'APPROVE_STATUS' =>$approve_status,
								'APPROVE_REMARK' =>'',
								'APPROVE_DATE'   =>date('Y-m-d'),
								'FLAG'           =>'0',
								'LASTUSER'       =>'0',
								'CREATED_BY'     =>$createdBy,
								/*'acc_code'     =>$departCode,
								'plant_code'     =>$plant_code*/
						);

					}else{ 
						
						$countmain=$countApv-1;
							
						if($countmain==$s){

							$lastusr='3';
						}else{
							$lastusr='0';
						}

						$data_approve = array(
								$headCol         =>$head_Id,
								$apvCol          =>$apv_Id,
								'COMP_CODE'      =>$comp_code,
								'FY_CODE'        =>$fy_code,
								'PFCT_CODE'      =>$pfct_code,
								'TRAN_CODE'      =>$trans_code,
								'SERIES_CODE'    =>$series_code,
								'VRNO'           =>$vr_no,
								'SLNO'           =>$sl_no[$b],
								'VRDATE'         =>$vr_date,
								'APPROVE_IND'    =>$approveind[$s],
								'APPROVE_USER'   =>$userid[$s],
								'LEVEL_NO'       =>$level_no[$s],
								'APPROVE_STATUS' =>0,
								'APPROVE_REMARK' =>'',
								'APPROVE_DATE'   =>date('Y-m-d'),
								'FLAG'           =>'',
								'LASTUSER'       =>$lastusr,
								'CREATED_BY'     =>$createdBy,
								/*'acc_code'     =>$departCode,
								'plant_code'     =>$plant_code,
								*/
							);
					} /* /. LEVEL O IF*/

					$saveDataApv = DB::table($apvTable)->insert($data_approve);

				} /* /. B LOOP*/
			} /* /. S LOOP */

		} /* /. IF APPROVE */
	}

/* ------- approve common function ------ */


/* ---- start sale enquiry transaction ---- */

	public function SalesEnquiryTrans(Request $request){

		$title       ='Add Sales Enquiry';

		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$userdata['series_list'] = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'S0'])->get();

		$userdata['item_list']   = DB::table('MASTER_ITEM')->get();

		$acc_list      =  DB::table('MASTER_ACC')->get();
		$tax_code_list =  DB::table('MASTER_TAX')->get();
		//DB::enableQueryLog();
		/*$userdata['plant_list'] = DB::table('PINDENT_HEAD')
				->select('PINDENT_HEAD.*', 'MASTER_PLANT.*','MASTER_PFCT.*')
           		->leftjoin('MASTER_PLANT', 'MASTER_PLANT.PLANT_CODE', '=', 'PINDENT_HEAD.PLANT_CODE')
           		->leftjoin('MASTER_PFCT', 'MASTER_PFCT.PFCT_CODE', '=', 'PINDENT_HEAD.PFCT_CODE')
           		->groupBy('PINDENT_HEAD.PLANT_CODE')
            	->get();*/

        $userdata['plant_list']      = DB::table('MASTER_PLANT')->get()->toArray();
		//dd(DB::getQueryLog());
		
		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		foreach ($getdate as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$transMast = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','S0')->get();
		$userdata['trans_head'] =$transMast[0]->TRAN_CODE;

		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.sales.sale_enquery_trans',$userdata+compact('title','acc_list','tax_code_list'));

	    }else{

			return redirect('/useractivity');
		}
	}

	public function SaveSalesEnquiry(Request $request){


		$createdBy      = $request->session()->get('userid');
		$compName       = $request->session()->get('company_name');
		$spliN          = explode('-', $compName);
		$compCode       = $spliN[0];
		$fisYear        =  $request->session()->get('macc_year');
		$comp_nameval   = $request->input('comp_name');
		$fy_year        = $request->input('fy_year');
		$pfct_code      = $request->input('pfct_code');
		$trans_code     = $request->input('trans_code');
		$series_code    = $request->input('series_code');
		$acc_code       = $request->input('accountCode');
		$vr_no          = $request->input('vr_no');
		$trans_date     = $request->input('trans_date');
		$tr_vr_date     = date("Y-m-d", strtotime($trans_date));
		$getduedate     = $request->input('getdue_date');
		$dueDate        = date("Y-m-d", strtotime($getduedate));
		$accountCode    = $request->input('accountCode');
		$plant_code     = $request->input('plant_code');
		$item_code      = $request->input('item_code');
		$countItemCode  = count($item_code);
		$item_name      = $request->input('item_name');
		$remark         = $request->input('remark');
		$qty            = $request->input('qty');
		$unit_M         = $request->input('unit_M');
		$Aqty           = $request->input('Aqty');
		$add_unit_M     = $request->input('add_unit_M');
		$rate           = $request->input('rate');
		$basic_amt      = $request->input('basic_amt');
		$hsn_code       = $request->input('hsn_code');
		$enqacc_code    = $request->input('enqacc_code');
		$enqacc_name    = $request->input('enqacc_name');
		$city_name      = $request->input('city_name');
		$contact_no     = $request->input('contact_no');
		$quaP_count     = $request->input('quaP_count');
		$allquaPcount   = $request->input('allquaPcount');
		$item_code_que  = $request->input('item_code_que');
		$item_category  = $request->input('item_category');
		$iqua_char      = $request->input('iqua_char');
		$iqua_desc      = $request->input('iqua_desc');
		$char_fromvalue = $request->input('char_fromvalue');
		$char_tovalue   = $request->input('char_tovalue');
		$partyrefNo     = $request->input('party_ref_no');
		$partyrefDate   = $request->input('party_ref_date');
		$indentHeadId   = $request->input('indentHeadId');
		$indentBodyId   = $request->input('indentBodyId');
		$party_ref_Date = date("Y-m-d", strtotime($partyrefDate));
		$consineCode    = $request->input('consine_code');
		$rfhead1        = $request->input('rfhead1');
		$rfhead2        = $request->input('rfhead2');
		$rfhead3        = $request->input('rfhead3');
		$rfhead4        = $request->input('rfhead4');
		$rfhead5        = $request->input('rfhead5');

		$donwloadStatus   = $request->input('donwloadStatus');

		$PEnqH = DB::select("SELECT MAX(SENQHID) as SENQHID FROM SENQ_HEAD");
		$head_ID = json_decode(json_encode($PEnqH), true); 
	
		if(empty($head_ID[0]['SENQHID'])){
			$headId = 1;
		}else{
			$headId = $head_ID[0]['SENQHID']+1;
		}

		if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('SENQ_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('VRNO',$vrNum)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrNum +1;
		}else{
			$NewVrno = $vrNum;
		}

		DB::beginTransaction();

		try {

			$data = array(

				'SENQHID'     =>$headId,
				'COMP_CODE'   =>$compCode,
				'FY_CODE'     =>$fisYear,
				'PFCT_CODE'   =>$pfct_code,
				'PFCT_NAME'   =>$request->input('pfct_name'),
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'SERIES_NAME' =>$request->input('series_name'),
				'ACC_CODE'    =>$acc_code,
				'ACC_NAME'    =>$request->input('account_name'),
				'VRNO'        =>$NewVrno,
				'SLNO'        =>1,
				'VRDATE'      =>$tr_vr_date,
				'PLANT_CODE'  =>$plant_code,
				'PLANT_NAME' =>$request->input('plant_name'),
				'CPCODE'      =>$consineCode,
				'DUEDATE'     =>$dueDate,
				'RFHEAD1'     =>$rfhead1,
				'RFHEAD2'     =>$rfhead2,
				'RFHEAD3'     =>$rfhead3,
				'RFHEAD4'     =>$rfhead4,
				'rfhead5'     =>$rfhead5,
				'CREATED_BY'  =>$createdBy,

			);
		
			$saveDataH = DB::table('SENQ_HEAD')->insert($data);

			$discriptn_page = "Sale enquiry trans insert done by user";
			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);

			$datalistrray = array();

			for ($i=0; $i < $countItemCode; $i++) { 

				$PEnqB = DB::select("SELECT MAX(SENQBID) as SENQBID FROM SENQ_BODY");
				$body_ID = json_decode(json_encode($PEnqB), true); 
		
				if(empty($body_ID[0]['SENQBID'])){
					$bodyId = 1;
				}else{
					$bodyId = $body_ID[0]['SENQBID']+1;
				}

		
				$slno  =$i+1;
				$data_body = array(
				
					'SENQHID'     =>$headId,
					'SENQBID'     =>$bodyId,
					'COMP_CODE'   =>$compCode,
					'FY_CODE'     =>$fisYear,
					'PFCT_CODE'   =>$pfct_code,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'VRNO'        =>$NewVrno,
					'SLNO'        =>$slno,
					'VRDATE'      =>$tr_vr_date,
					'PLANT_CODE'  =>$plant_code,
					'ITEM_CODE'   =>$item_code[$i],
					'ITEM_NAME'   =>$item_name[$i],
					'PARTICULAR'  =>$remark[$i],
					'QTYRECD'     =>$qty[$i],
					'UM'          =>$unit_M[$i],
					'AQTYRECD'    =>$Aqty[$i],
					'AUM'         =>$add_unit_M[$i],
					'CREATED_BY'  =>$createdBy,
				);
				$saveDataB = DB::table('SENQ_BODY')->insert($data_body);

				

				if($quaP_count[$i] == 0){
				}else{
					for ($q=0; $q < $quaP_count[$i]; $q++) { 

					$a = array_fill(1, $quaP_count[$i], $bodyId);
					$str = implode(',',$a); 
					$last_id = explode(',',$str);

					$datalistrray[]= $last_id[0];

				    }
				}


				 /* /. vendor */

		    }/*-- for loop close --*/


		    for ($j=0; $j < $allquaPcount; $j++) { 

		    	$PEnqQ = DB::select("SELECT MAX(SENQQID) as SENQQID FROM SENQ_QUA");
					$QuaID = json_decode(json_encode($PEnqQ), true);		
					if(empty($QuaID[0]['SENQQID'])){
						$quaPId = 1;
					}else{
						$quaPId = $QuaID[0]['SENQQID']+1;
					}

					$slNo = $j+1; 


					$data_Qp = array(

						'SENQHID'        =>$headId,
						'SENQBID'        =>$datalistrray[$j],
						'SENQQID'        =>$quaPId,
						'COMP_CODE'      =>$compCode,
						'FY_CODE'        =>$fisYear,
						'PFCT_CODE'      =>$pfct_code,
						'TRAN_CODE'      =>$trans_code,
						'SERIES_CODE'    =>$series_code,
						'VRNO'           =>$NewVrno,
						'SLNO'           =>$slNo,
						'VRDATE'         =>$tr_vr_date,
						'PLANT_CODE'     =>$plant_code,
						'ITEM_CODE'      =>$item_code_que[$j],
						'ICATG_CODE'     =>$item_category[$j],
						'IQUA_CHAR'      =>$iqua_char[$j],
						'IQUA_DESC'      =>'',
						'IQUA_UM'        =>'',
						'CHAR_FROMVALUE' =>$char_fromvalue[$j],
						'CHAR_TOVALUE'   =>$char_tovalue[$j],
						'CREATED_BY'     =>$createdBy,
					);
				$saveDataQ = DB::table('SENQ_QUA')->insert($data_Qp);

		    } /* /. quality parameter */

		    $checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->get()->toArray();

		    if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$compCode,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);

			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->update($datavrn);
			}

			$headtable    = 'SENQ_HEAD';
			$bodytable    = 'SENQ_BODY';
			$columnheadid = 'SENQHID';
		
			DB::commit();
			/*if($donwloadStatus == 1){
				return $this->GeneratePdfForSaleEnq($compCode,$headId,$headtable,$bodytable,$columnheadid);
			}*/
			$response_array['response'] = 'success';
		    $data = json_encode($response_array);
		    print_r($data);

		} catch (\Exception $e) {
		    DB::rollBack();
		  //  throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}
		
    }


    public function SaveTrackSalesEnquiry(Request $request){


			$createdBy    = $request->session()->get('userid');
			$compName     = $request->session()->get('company_name');
			$spliN        = explode('-', $compName);
			$compCode     = $spliN[0];
			$fisYear      =  $request->session()->get('macc_year');
			$enqno        = $request->input('enq_no');
			
			$enq_no       = explode(' ', $enqno);
			
			$enq_date     = $request->input('enquiry_date');
			//print_r($enq_date);exit;
			$enquiry_date =  date("Y-m-d", strtotime($enq_date));
			$tr_date      = $request->input('track_date');
			$track_date   = date("Y-m-d", strtotime($tr_date));
			$track_remark = $request->input('track_remark');
			$notes        = $request->input('notes');
			$cl_date      = $request->input('close_date');
			$close_date   = date("Y-m-d", strtotime($cl_date));


			

			$SEnqQ = DB::select("SELECT MAX(TESID) as TESID FROM TRACK_ENQ_SALE");
					$QuaID = json_decode(json_encode($SEnqQ), true);		
					if(empty($QuaID[0]['TESID'])){
						$TSID = 1;
					}else{
						$TSID = $QuaID[0]['TESID']+1;
					}


			$data = array(

						'TESID'        =>$TSID,
						'COMP_CODE'    =>$compCode,
						'FY_CODE'      =>$fisYear,
						'ENQ_NO'       =>$enq_no[1],
						'ENQ_DATE'     =>$enquiry_date,
						'TRACK_DATE'   =>$track_date,
						'TRACK_REMARK' =>$track_remark,
						'NOTES'        =>$notes,
						'created_by'   =>$createdBy,

					);
			
		    $saveData = DB::table('TRACK_ENQ_SALE')->insert($data);
			$trans_code  ='';
			$series_code ='';
			$NewVrno     ='';
			$acc_code    ='';
		    $discriptn_page = "Sale track enquiry trans insert done by user";
			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);


			if ($saveData) {

    			$response_array['response'] = 'success';
	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';

                $data = json_encode($response_array);

                print_r($data);
					
			}


    }


    public function UpdateTrackSalesEnquiry(Request $request){


    //	print_r($request->input('enq_no'));exit;
			$createdBy    = $request->session()->get('userid');
			$compName     = $request->session()->get('company_name');
			$spliN        = explode('-', $compName);
			$compCode     = $spliN[0];
			$fisYear      =  $request->session()->get('macc_year');
			$enqno        = $request->input('enq_no');
			$cl_date      = $request->input('cls_date');
			$close_date   = date("Y-m-d", strtotime($cl_date));

			$count = count($enqno);

			
		for ($i=0; $i < $count; $i++) { 


			$SEnqQ = DB::select("SELECT MAX(TESID) as TESID FROM TRACK_ENQ_SALE");
					$QuaID = json_decode(json_encode($SEnqQ), true);		
					if(empty($QuaID[0]['TESID'])){
						$TSID = 1;
					}else{
						$TSID = $QuaID[0]['TESID']+1;
					}


			$data = array(

						'TESID'        =>$TSID,
						'COMP_CODE'    =>$compCode,
						'FY_CODE'      =>$fisYear,
						'CLS_DATE'     =>$close_date[$i],
						'created_by'   =>$createdBy,

					);
			
		    $saveData = DB::table('TRACK_ENQ_SALE')->where('ENQ_NO',$enqno[$i])->update($data);
			
		}

			


			if ($saveData) {

    			$response_array['response'] = 'success';
	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';

                $data = json_encode($response_array);

                print_r($data);
					
			}


    }

    public function ViewSaleEnquiryTransaction(Request $request){

     	$compName = $request->session()->get('company_name');

        if($request->ajax()) {
    
            $title ='View Enquiry';
    
            $userid    = $request->session()->get('userid');
    
            $userType = $request->session()->get('usertype');
    
            $compName = $request->session()->get('company_name');

            $compcode    = explode('-', $compName);

			$getcompcode =	$compcode[0];
    
            $fisYear =  $request->session()->get('macc_year');
    
            if($userType=='admin' || $userType=='Admin'){

               $data = DB::select("SELECT SENQ_HEAD.*,SENQ_BODY.SENQHID as salehid,SENQ_BODY.SENQBID,SENQ_BODY.SQTNHID,SENQ_BODY.SQTNBID,group_concat(concat(SENQ_BODY.SQTNHID))AS SQTNSTATUSHD,group_concat(concat(SENQ_BODY.SQTNBID))AS SQTNSTATUSBD FROM SENQ_HEAD 
               LEFT JOIN SENQ_BODY ON SENQ_BODY.SENQHID = SENQ_HEAD.SENQHID WHERE SENQ_HEAD.FY_CODE='$fisYear' AND SENQ_HEAD.COMP_CODE ='$getcompcode' GROUP BY SENQ_HEAD.SENQHID");

               

            }else if($userType=='superAdmin' || $userType=='user'){
    
               $data = DB::select("SELECT SENQ_HEAD.*,SENQ_BODY.SENQHID as salehid,SENQ_BODY.SENQBID,SENQ_BODY.SQTNHID,SENQ_BODY.SQTNBID,group_concat(concat(SENQ_BODY.SQTNHID))AS SQTNSTATUSHD,group_concat(concat(SENQ_BODY.SQTNBID))AS SQTNSTATUSBD FROM SENQ_HEAD 
               LEFT JOIN SENQ_BODY ON SENQ_BODY.SENQHID = SENQ_HEAD.SENQHID WHERE SENQ_HEAD.FY_CODE='$fisYear' AND SENQ_HEAD.COMP_CODE ='$getcompcode' GROUP BY SENQ_HEAD.SENQHID");
            }
            else{
    
                $data='';
                
            }

        	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();
        }

        if(isset($compName)){

       		return view('admin.finance.transaction.sales.view_sale_enquiry_transaction');
        }else{
			return redirect('/useractivity');
		}
        
    }

    public function ViewSalesEnquiryChildRow(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$enquidata = DB::table('SENQ_BODY')->where('VRNO',$vrno)->where('SENQHID',$headid)->get();

	    	$account = DB::table('SENQ_VENDOR')->where('VRNO',$vrno)->where('SENQHID',$headid)->groupBy('SENQ_VENDOR.ACC_CODE')->get();

	    	

    		if ($enquidata && $account) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $enquidata;
	            $response_array['count'] = $account;

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

	public function sale_enquiry_msg(Request $request,$saveData){

		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Added ...!');
			return redirect('/Transaction/Sales/View-Sales-Enquery-Trans');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/Transaction/Sales/View-Sales-Enquery-Trans');

		}
	}

	public function EditSalesEnquiry(Request $request,$headid,$bodyid,$vrno){

    	$id =base64_decode($headid);
    	$body_id =base64_decode($bodyid);
    	$vrno  =base64_decode($vrno);

    	if($id!=''){
			$userdata['getPurchasenquiry'] = DB::select("SELECT t1.*,t2.*,t2.SENQBID as bodyid FROM SENQ_BODY t2 LEFT JOIN SENQ_HEAD t1 ON t1.SENQHID = t2.SENQHID AND t1.VRNO = t2.VRNO WHERE t1.SENQHID='$id' AND t1.VRNO='$vrno'");

			$title       ='Edit Purchase Enquiry';

			$userdata['help_item_list'] = DB::table('MASTER_ITEM')->get();

			return view('admin.finance.transaction.edit_sale_enquiry', $userdata+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Sale Enquiry Not Found...!');
			return redirect('/Transaction/Sales/View-Sales-Enquery-Trans');
		}

    }

/* ---- sale enquiry transaction ---- */

/*sales track enquiery */

public function TrackSaleEnquiryTransaction(Request $request){

		$title      ='Add Sales Enquiry';

		$CompanyCode   = $request->session()->get('company_name');
		$compcode = explode('-', $CompanyCode);
		$getcompcode=	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$userdata['series_list'] = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'P0'])->get();

		$userdata['enq_list'] = DB::table('SENQ_BODY')->groupBy('VRNO')->get();

		$acc_list      =  DB::table('MASTER_ACC')->get();
		$tax_code_list =  DB::table('MASTER_TAX')->get();
		//DB::enableQueryLog();
		$userdata['plant_list'] = DB::table('PINDENT_HEAD')
				->select('PINDENT_HEAD.*', 'MASTER_PLANT.*','MASTER_PFCT.*')
           		->leftjoin('MASTER_PLANT', 'MASTER_PLANT.PLANT_CODE', '=', 'PINDENT_HEAD.PLANT_CODE')
           		->leftjoin('MASTER_PFCT', 'MASTER_PFCT.PFCT_CODE', '=', 'PINDENT_HEAD.PFCT_CODE')
           		->groupBy('PINDENT_HEAD.PLANT_CODE')
            	->get();
		//dd(DB::getQueryLog());
		
		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		foreach ($getdate as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$purEnqVrno = DB::table('PENQ_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->get();

		   	$vrseqnum = '';
			foreach ($purEnqVrno as $keyvr) {
				$vrseqnum =  $keyvr->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

		$vr_No_list = DB::table('MASTER_VRSEQ')->where(['TRAN_CODE'=>'P0','COMP_CODE'=>$getcompcode])->get();

		if(!empty($vr_No_list)){

			foreach ($vr_No_list as $key) {
				$userdata['last_num']   = $key->LAST_NO;
				$userdata['to_num']     = $key->TO_NO;
				$userdata['trans_head'] = $key->TRAN_CODE;
			}

		}else{

				$userdata['last_num']  ='';
				$userdata['to_num']  ='';
				$userdata['trans_head']  ='';

		}

		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.sales.track_sale_enquery_trans',$userdata+compact('title','acc_list','tax_code_list'));

	    }else{

			return redirect('/useractivity');
		}
	}
/*sales track enquiery */

/*------ start sales quotation -----*/

	public function GetitemByEnquiryInsale(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$enquiryno = $request->input('enquiryno');
			$accnum    = $request->input('accnum');
			$seriesEnq = $request->input('seriesEnq');

			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];
			$fisYear      =  $request->session()->get('macc_year');


	    	if($enquiryno == ''){
	    		$itemListData = DB::table('MASTER_ITEM')->get();
	    	}else{
	    		//DB::enableQueryLog();
	    		$itemListData = DB::select("SELECT t1.ITEM_CODE,t1.ITEM_NAME,t1.SENQHID FROM SENQ_HEAD t2 LEFT JOIN SENQ_BODY t1 ON t1.SENQHID = t2.SENQHID WHERE t2.VRNO='$enquiryno' AND t2.ACC_CODE='$accnum' AND t2.SERIES_CODE='$seriesEnq' AND t1.COMP_CODE='$getcom_code' AND t1.FY_CODE='$fisYear' AND t1.SQTNHID IS NULL AND t1.SQTNBID IS NULL UNION SELECT t1.ITEM_CODE,t1.ITEM_NAME,t1.CRMENQHID FROM CRM_ENQ_HEAD t2 LEFT JOIN CRM_ENQ_BODY t1 ON t1.CRMENQHID = t2.CRMENQHID WHERE t2.VRNO='$enquiryno' AND t2.ACC_CODE='$accnum' AND t2.SERIES_CODE='$seriesEnq' AND t1.SQTNHID IS NULL AND t1.SQTNBID IS NULL");

	    		
	    		//dd(DB::getQueryLog());
	    	}

    		if ($itemListData) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemListData;

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

    public function GetItmBYConditnInAddMoreSale(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$enquiryno = $request->input('enquiryno');
			$accnum    = $request->input('accnum');
			$tax_code  = $request->input('tax_code');
			$stateC    = $request->input('stateCode');
			$seriesEnq = $request->input('seriesEnq');

			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];
			$fisYear      =  $request->session()->get('macc_year');

			if($enquiryno){
				//DB::enableQueryLog();
				$itemListData = DB::select("SELECT t1.ITEM_CODE,t1.ITEM_NAME,t1.SENQHID FROM SENQ_HEAD t2 LEFT JOIN SENQ_BODY t1 ON t1.SENQHID = t2.SENQHID WHERE t2.VRNO='$enquiryno' AND t2.ACC_CODE='$accnum' AND t2.SERIES_CODE='$seriesEnq' AND t1.COMP_CODE='$getcom_code' AND t1.FY_CODE='$fisYear' AND t1.SQTNHID IS NULL AND t1.SQTNBID IS NULL UNION SELECT t1.ITEM_CODE,t1.ITEM_NAME,t1.CRMENQHID FROM CRM_ENQ_HEAD t2 LEFT JOIN CRM_ENQ_BODY t1 ON t1.CRMENQHID = t2.CRMENQHID WHERE t2.VRNO='$enquiryno' AND t2.ACC_CODE='$accnum' AND t2.SERIES_CODE='$seriesEnq' AND t1.SQTNHID IS NULL AND t1.SQTNBID IS NULL");
				//dd(DB::getQueryLog());
			}else if($accnum && $tax_code){

				$itemListData =	DB::SELECT("SELECT t1.*,t2.* FROM MASTER_HSNRATE t1  LEFT JOIN MASTER_ITEM t2 ON t2.HSN_CODE = t1.HSN_CODE WHERE t1.TAX_CODE='$tax_code'");

			}else if($accnum && $tax_code==''){

				$itemListData= DB::table('MASTER_ITEM')->get();

			}

    		if ($itemListData) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemListData;

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

	public function AddsalesQuotation(Request $request)
    {

		$title       ='Sale Quatation Transaction';
		$CompanyCode = $request->session()->get('company_name');
		$splitcode   = explode('-', $CompanyCode);
		$compCode    =	$splitcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$tableData = MyConstruct();

		$userdata['acc_list']      = $tableData['master_party'];
		$userdata['taxcode_list']  = $tableData['master_tax'];
		$userdata['plant_list']    = $tableData['master_plant'];
		$userdata['item_list']     = $tableData['master_item'];
		$userdata['ratval_list']   = $tableData['master_rateValue'];
		$userdata['sale_rep_list'] = $tableData['sale_rep_code'];
		$userdata['cost_list']     = $tableData['master_cost'];
		$transCode   = 'S1';

		$transMast = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$transCode)->get();
		$userdata['trans_head'] =$transMast[0]->TRAN_CODE;

		$getCommonData = MyCommonFun($transCode,$compCode,$macc_year);

		$userdata['series_list'] = $getCommonData['getseries'];
		
		foreach ($getCommonData['getdate'] as $fydata) {

			$userdata['fromDate'] =  $fydata->FY_FROM_DATE;
			$userdata['toDate']   =  $fydata->FY_TO_DATE;
			
		}

		if(isset($CompanyCode)){
		    return view('admin.finance.transaction.sales.sale_quotation_trans',$userdata+compact('title'));
		}else{
			return redirect('/useractivity');
		}
       

    }


    public function AfieldCalculationSaleQuo(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tax_code     = $request->input('tax_code');
			$ItemCode     = $request->input('ItemCode');
			$saleQtnHeadId = $request->input('saleQtnHeadId');
			$saleQtnBodyId = $request->input('saleQtnBodyId');
			$CompanyCode  = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$userid       = $request->session()->get('userid');
			//DB::enableQueryLog();
	    	if($ItemCode && $saleQtnHeadId && $saleQtnBodyId){
	    		//DB::enableQueryLog();
	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.*,t3.SQTNTID as taxhid FROM SQTN_TAX t3 LEFT JOIN SQTN_BODY t2 ON t2.SQTNBID = t3.SQTNBID LEFT JOIN SQTN_HEAD t1 ON t1.SQTNHID = t3.SQTNHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.SQTNHID='$saleQtnHeadId' AND t3.SQTNBID='$saleQtnBodyId'");
	    		//dd(DB::getQueryLog());
	    	}else{

	    		$transcode_list = DB::table('MASTER_TAXRATE')
	            ->join('MASTER_TAXIND', 'MASTER_TAXRATE.TAXIND_CODE', '=', 'MASTER_TAXIND.TAXIND_CODE')
	            ->select('MASTER_TAXRATE.*', 'MASTER_TAXIND.TAXIND_NAME','MASTER_TAXIND.TAXIND_BLOCK')
	            ->where([['MASTER_TAXRATE.TAX_CODE','=',$tax_code]])
	            ->get();
	    	}
            

             $ratevalue = DB::table('MASTER_RATE_VALUE')->get();

            //dd(DB::getQueryLog());
	    	$count = count($transcode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $transcode_list;
	            $response_array['data_rate'] = $ratevalue;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '';
                $response_array['data_rate'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data_rate'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function SaveSalesQuotation(Request $request){

		$createdBy    = $request->session()->get('userid');
		$compName     = $request->session()->get('company_name');
		$splitname    = explode('-', $compName);
		$compCode     = $splitname[0];
		$fisYear      =  $request->session()->get('macc_year');
		
		$pfct_code    = $request->input('pfct_code');
		$trans_code   = $request->input('trans_code');
		$series_code  = $request->input('series_code');
		$vr_no        = $request->input('vr_no');
		
		$trans_date   = $request->input('trans_date');
		$tr_vr_date   = date("Y-m-d", strtotime($trans_date));

		$partyRef_date   = $request->input('party_ref_date');
		$pref_date   = date("Y-m-d", strtotime($partyRef_date));
		
		$duadate_date = $request->input('dueDate');
		$dua_date     = date("Y-m-d", strtotime($duadate_date));
		
		$accountCode  = $request->input('accountCode');
		$plant_code   = $request->input('plant_code');
		
		$tax_code     = $request->input('tax_code');
		$tax_byitem   = $request->input('tax_byitem');
		
		$item_code    = $request->input('item_code');
		
		$countItemCode  = count($item_code);
		$item_name      = $request->input('item_name');
		$remark         = $request->input('remark');
		$qty            = $request->input('qty');
		$unit_M         = $request->input('unit_M');
		$Aqty           = $request->input('Aqty');
		$add_unit_M     = $request->input('add_unit_M');
		$rate           = $request->input('rate');
		$basic_amt      = $request->input('basic_amt');
		$crAmtPerItm    = $request->input('crAmtPerItem');
		$hsn_code       = $request->input('hsn_code');
		$getdatacount   = $request->input('getdatacount');
		
		$head_tax_ind   = $request->input('head_tax_ind');
		$af_rate        = $request->input('af_rate');
		$amount         = $request->input('amount');
		
		$data_Count     = $request->input('data_Count');
		//print_r($data_Count);
		$rate_ind       = $request->input('rate_ind');
		$logicget       = $request->input('logicget');
		$staticget      = $request->input('staticget');
		$taxGlCode      = $request->input('taxGlCode');
		$taxIndCod      = $request->input('taxIndCode');
		
		$tol_index      = $request->input('tolerence_index');
		$tol_rate       = $request->input('tolerence_rate');
		$tol_value      = $request->input('tolerence_value');
		$quoComp_no     = $request->input('quoComp_no');
		
		$quaP_count     = $request->input('quaP_count');
		$allquaPcount   = $request->input('allquaPcount');
		$item_code_que  = $request->input('item_code_que');
		$item_category  = $request->input('item_category');
		$iqua_char      = $request->input('iqua_char');
		$iqua_desc      = $request->input('iqua_desc');
		$char_fromvalue = $request->input('char_fromvalue');
		$char_tovalue   = $request->input('char_tovalue');
		$saleQuoHead    = $request->input('saleQuoHead');
		$saleQuoBody    = $request->input('saleQuoBody');
		$saleEnqHId    = $request->input('saleEnqHId');
		$saleEnqBId    = $request->input('saleEnqBId');
		$existQty       = $request->input('existQty');
		$taxhid         = $request->input('taxhid');

		$donwloadStatus   = $request->input('donwloadStatus');

		$SquoH = DB::select("SELECT MAX(SQTNHID) as SQTNHID FROM SQTN_HEAD");
		$headID = json_decode(json_encode($SquoH), true); 
	
		if(empty($headID[0]['SQTNHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['SQTNHID']+1;
		}

		if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('SQTN_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

		DB::beginTransaction();

		try {

			$dataHead = array(

				'SQTNHID'          =>$head_Id,
				'COMP_CODE'        =>$compCode,
				'FY_CODE'          =>$fisYear,
				'PFCT_CODE'        =>$pfct_code,
				'PFCT_NAME'        =>$request->input('pfct_name'),
				'TRAN_CODE'        =>$trans_code,
				'SERIES_CODE'      =>$series_code,
				'SERIES_NAME'      =>$request->input('series_name'),
				'VRNO'             =>$NewVrno,
				'VRDATE'           =>$tr_vr_date,
				'PLANT_CODE'       =>$plant_code,
				'PLANT_NAME'       =>$request->input('plant_name'),
				'DUEDAYS'          =>$request->input('gate_dueDays'),
				'DUEDATE'          =>$dua_date,
				'ACC_CODE'         =>$accountCode,
				'ACC_NAME'         =>$request->input('plant_name'),
				'CPCODE'           =>$request->input('cp_codeGet'),
				'COST_CENTER'      =>$request->input('Cost_Center'),
				'COST_CENTER_NAME' =>$request->input('CostName'),
				'SR_CODE'          =>$request->input('Sale_Reps'),
				'SR_NAME'          =>$request->input('sale_reps_name'),
				'TAX_CODE'         =>$tax_code,
				'PREFNO'           =>$request->input('party_ref_no'),
				'PREFDATE'         =>$pref_date,
				'RFHEAD1'          =>$request->input('rfhead1'),
				'RFHEAD2'          =>$request->input('rfhead2'),
				'RFHEAD3'          =>$request->input('rfhead3'),
				'RFHEAD4'          =>$request->input('rfhead4'),
				'RFHEAD5'          =>$request->input('rfhead5'),
				'PMT_TERMS'        =>$request->input('payment_terms'),
				'DRAMT'            =>$request->input('grand_total'),
				'ADV_RATE_I'       =>$request->input('adv_rate_i'),
				'ADV_RATE'         =>$request->input('adv_rate'),
				'ADV_AMT'          =>$request->input('adv_amt'),
				'CREATED_BY'       =>$createdBy,
				

			);
	
			$saveDatah = DB::table('SQTN_HEAD')->insert($dataHead);

			$discriptn_page = "Sale quotation trans insert done by user";
			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$accountCode);
		
			$databody_tax = array();
			$databody_quo = array();
			$existHidrray = array();
			$existBidrray = array();
			$existqtyA = array();
			$newqtyA   = array();

			for ($i=0; $i < $countItemCode ; $i++) {
				$sQuoB = DB::select("SELECT MAX(SQTNBID) as SQTNBID FROM SQTN_BODY");
					$bodyID = json_decode(json_encode($sQuoB), true); 
				
					if(empty($bodyID[0]['SQTNBID'])){
						$body_Id = 1;
					}else{
						$body_Id = $bodyID[0]['SQTNBID']+1;
					}

					$data_body = array(
			
						'SQTNHID'     =>$head_Id,
						'SQTNBID'     =>$body_Id,
						'COMP_CODE'   =>$compCode,
						'FY_CODE'     =>$fisYear,
						'PFCT_CODE'   =>$pfct_code,
						'TRAN_CODE'   =>$trans_code,
						'SERIES_CODE' =>$series_code,
						'VRNO'        =>$NewVrno,
						'SLNO'        =>$i+1,
						'VRDATE'      =>$tr_vr_date,
						'PLANT_CODE'  =>$plant_code,
						'ITEM_CODE'   =>$item_code[$i],
						'ITEM_NAME'   =>$item_name[$i],
						'PARTICULAR'  =>$remark[$i],
						'HSN_CODE'    =>$hsn_code[$i],
						'QTYISSUED'   =>$qty[$i],
						'UM'          =>$unit_M[$i],
						'AQTYISSUED'  =>$Aqty[$i],
						'AUM'         =>$add_unit_M[$i],
						'RATE'        =>$rate[$i],
						'BASICAMT'    =>$basic_amt[$i],
						'TAX_CODE'    =>$tax_byitem[$i],
						'DRAMT'       =>$crAmtPerItm[$i],
						'CREATED_BY'  =>$createdBy,
					);

					$saveDataB =DB::table('SQTN_BODY')->insert($data_body);

					if($saleEnqHId[$i] && $saleEnqBId[$i] && $item_code[$i]){
			
						$data_QUO= array(
					
								'SQTNHID' =>$head_Id,
								'SQTNBID' =>$body_Id,
							);
					 	DB::table('SENQ_BODY')->where(['SENQHID'=>$saleEnqHId[$i],'SENQBID'=>$saleEnqBId[$i],'ITEM_CODE'=>$item_code[$i]])->update($data_QUO);

					}

					if($data_Count[$i] == 0){

					}else{

						for ($q=0; $q < $data_Count[$i]; $q++) { 

							$a = array_fill(1, $data_Count[$i], $body_Id);
							$str = implode(',',$a); 
							$last_id = explode(',',$str);

							$databody_tax[]= $last_id[0];
						
					  	}

					}

					if($quaP_count[$i] == 0){

					}else{

						for ($u=0; $u < $quaP_count[$i]; $u++) { 

							$qp = array_fill(1, $quaP_count[$i], $body_Id);
							$strqp = implode(',',$qp); 
							$last_idqp = explode(',',$strqp);

							$databody_quo[]= $last_idqp[0];

						}

					} /* /. qp*/

			} /* /. for loop ietm */

			$chck  =count($existqtyA);
			
			for ($j=0; $j < $getdatacount; $j++) { 

				$squoH = DB::select("SELECT MAX(SQTNTID) as SQTNTID FROM SQTN_TAX");
				$quoID = json_decode(json_encode($squoH), true); 
			
				if(empty($quoID[0]['SQTNTID'])){
					$quo_Id = 1;
				}else{
					$quo_Id = $quoID[0]['SQTNTID']+1;
				}

				if(($amount[$j] == '') || ($amount[$j] == null)){
					$taxAmount = 0.00;
				}else{
					$taxAmount = $amount[$j];
				}

				$data_tax = array(
					'SQTNHID'     => $head_Id,
					'SQTNBID'     => $databody_tax[$j],
					'SQTNTID'     => $quo_Id,
					'TAXIND_NAME' => $head_tax_ind[$j],
					'TAXIND_CODE' => $taxIndCod[$j],
					'RATE_INDEX'  => $rate_ind[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $taxAmount,
					'TAX_LOGIC'   => $logicget[$j],
					'STATIC_IND'  => $staticget[$j],
					'TAXGL_CODE'  => $taxGlCode[$j],
					'CREATED_BY'  => $createdBy,
				);
			
				$saveData1 =DB::table('SQTN_TAX')->insert($data_tax);
				
			} /*-- for loop close --*/

			$headtable    = 'SQTN_HEAD';
			$bodytable    = 'SQTN_BODY';
			$taxtable     = 'SQTN_TAX';
			$columnheadid = 'SQTNHID';
			$pdfPageName  = 'SALES QUOTATION';
			$vrNoPname    = 'QTN NO';
			$tcode        = $trans_code;

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->get()->toArray();

			if(empty($checkvrnoExist)){
				$datavrnIn =array(
					'COMP_CODE'   =>$compCode,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);
			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->update($datavrn);
			}

			

			DB::commit();
			
			$response_array['response'] = 'success';
			if($donwloadStatus == 1){

			return $this->GeneratePdfForSale($createdBy,$compCode,$head_Id,$headtable,$bodytable,$taxtable,$columnheadid,$pdfPageName,$vrNoPname,$tcode);

			}else{}
		    $data = json_encode($response_array);
		    print_r($data);

		} catch (\Exception $e) {
		    DB::rollBack();
		    //throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}
			
			
	} /*-- function close --  */

	public function SaleQuoSaveMsg(Request $request,$saveData){
	 //	print_r($savedata);exit;
		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/Transaction/Sales/View-Sales-Quotation-Trans');

		} else {

			$request->session()->flash('alert-success', 'Data  Was Successfully Added...!');
			return redirect('/Transaction/Sales/View-Sales-Quotation-Trans');

		}
	}


	public function ViewSaleQuotation(Request $request){

		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

	        $title ='View Sale Quatation';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $compName = $request->session()->get('company_name');

	        $compcode    = explode('-', $compName);

			$getcompcode =	$compcode[0];

	        $fisYear =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	        
	         /*$data = DB::table('purchase_quotation_head')
				->select('purchase_quotation_head.*')
           		->orderBy('purchase_quotation_head.id','DESC');*/
           		
           		// DB::enableQueryLog();
           		$data =DB::select("SELECT SQTN_HEAD.*,SQTN_BODY.SQTNHID as salehid,SQTN_BODY.SQTNBID,SQTN_BODY.SCNTRHID,SQTN_BODY.SCNTRBID,group_concat(concat(SQTN_BODY.SCNTRHID))AS SCTRSTATUSHD,group_concat(concat(SQTN_BODY.SCNTRBID))AS SCTRSTATUSBD,group_concat(concat(SQTN_BODY.QTYRECD))AS nextTranQty FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_BODY.SQTNHID = SQTN_HEAD.SQTNHID WHERE SQTN_HEAD.FY_CODE='$fisYear' AND SQTN_HEAD.COMP_CODE='$getcompcode' GROUP BY SQTN_HEAD.SQTNHID");


           		//dd(DB::getQueryLog());	
            	  
	        }else if($userType=='superAdmin' || $userType=='user'){

              
	           $data =DB::select("SELECT SQTN_HEAD.*,SQTN_BODY.SQTNHID as salehid,SQTN_BODY.SQTNBID,SQTN_BODY.SCNTRHID,SQTN_BODY.SCNTRBID,group_concat(concat(SQTN_BODY.SCNTRHID))AS SCTRSTATUSHD,group_concat(concat(SQTN_BODY.SCNTRBID))AS SCTRSTATUSBD,group_concat(concat(SQTN_BODY.QTYRECD))AS nextTranQty FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_BODY.SQTNHID = SQTN_HEAD.SQTNHID WHERE SQTN_HEAD.FY_CODE='$fisYear' AND SQTN_HEAD.COMP_CODE='$getcompcode' GROUP BY SQTN_HEAD.SQTNHID");
 				

	        }
	        else{

	            $data='';
	            
	        }
	        //return DataTables()->of($data)->addIndexColumn()->make(true);
	    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }

	    if(isset($compName)){

	       return view('admin.finance.transaction.sales.view_sale_quotation_trans');
	    }else{
			return redirect('/useractivity');
		}
        
	}

	public function SaleQuoChieldRTowData(Request $request){

		$response_array = array();

	    $vrno = $request->input('vrno');
	    $tblid = $request->input('tblid');

	   /// print_r($gl_code_help);exit();

		if ($request->ajax()) {

	    	$purchase_indent_chield = DB::table("SQTN_BODY")->where('SQTNHID',$tblid)->where('VRNO',$vrno)->get();

	    	//print_r($Seach_depot_Code_by_help);exit;
	    	
    		if ($purchase_indent_chield) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $purchase_indent_chield ;

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

	public function GetQtyParametrFrmSaleQuoByItm(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$itemCode    = $request->input('ItemCode');
			$saleQHead    = $request->input('saleQuoHeadId');
			$saleQBody    = $request->input('saleQuoBodyId');
            
            $fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM SQTN_QUA t3 LEFT JOIN SQTN_BODY t2 ON t2.SQTNBID = t3.SQTNBID LEFT JOIN SQTN_HEAD t1 ON t1.SQTNHID = t3.SQTNHID WHERE t2.ITEM_CODE='$itemCode' AND t3.SQTNHID='$saleQHead' AND t3.SQTNBID='$saleQBody'");

            if($fetch_qua_reocrd){
            	$fetch_reocrd = $fetch_qua_reocrd;
            }else{
            	$itemcode_get = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();
       
   				$fetch_reocrd = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode_get->ICATG_CODE)->get()->toArray();
            }


            if ($fetch_reocrd!='') {

				$response_array['response']    = 'success';
				$response_array['data']        = $fetch_reocrd;
				$response_array['item_code'] = $itemCode;
				//$response_array['levelAmt']    = $levelAmt;

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


public function SaleTranChieldRTowData(Request $request){

		$response_array = array();

	    $vrno = $request->input('vrno');
	    $tblid = $request->input('tblid');

	   /// print_r($gl_code_help);exit();

		if ($request->ajax()) {

	    	$sale_trans = DB::table("SBILL_BODY")->where('SBILLHID',$tblid)->where('VRNO',$vrno)->get();

	    	//print_r($Seach_depot_Code_by_help);exit;
	    	
    		if ($sale_trans) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $sale_trans ;

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


    public function EditsalesQuotation(Request $request,$headid,$bodyid,$vrNo){

		$id      =base64_decode($headid);
		$body_id =base64_decode($bodyid);
		$vr_No =base64_decode($vrNo);


    	if($id!=''){
    	   	//DB::enableQueryLog();
			$userdata['getSaleQuo'] = DB::select("SELECT t1.*,t2.*,t2.SQTNBID as bodyid FROM SQTN_BODY t2 LEFT JOIN SQTN_HEAD t1 ON t1.SQTNHID = t2.SQTNHID AND t1.VRNO = t2.VRNO WHERE t1.SQTNHID='$id' AND t1.VRNO='$vr_No' ");
			//dd(DB::getQueryLog());
			$plantCode = $userdata['getSaleQuo'][0]->PLANT_CODE;
			$acc_code  = $userdata['getSaleQuo'][0]->ACC_CODE;
			$shipAddr  = $userdata['getSaleQuo'][0]->CPCODE;
			$userdata['pfct_data'] = DB::table('MASTER_PLANT')
				->select('MASTER_PLANT.PLANT_CODE','MASTER_PLANT.STATE', 'MASTER_PFCT.*')
           		->leftjoin('MASTER_PFCT', 'MASTER_PLANT.PFCT_CODE', '=', 'MASTER_PFCT.PFCT_CODE')
            	->where([['MASTER_PLANT.PLANT_CODE','=',$plantCode]])
            	->get();

            $getStateCode = DB::table('MASTER_ACCADD')->where('ACC_CODE',$acc_code)->where('ADD1',$shipAddr)->get()->first();

           	$stateOfAcc = $getStateCode->STATE_CODE;
			
			$title       ='Sale Quatation Transaction';
			
			$CompanyCode = $request->session()->get('company_name');
			$getcompcode    = explode('-', $CompanyCode);
			$compCode =	$getcompcode[0];
			$macc_year   = $request->session()->get('macc_year');

			$tableData = MyConstruct();
			$userdata['item_list']    = $tableData['master_item'];
			$userdata['ratval_list']  = $tableData['master_rateValue'];
			$transCode   = 'S1';

			$getCommonData = MyCommonFun($transCode,$compCode,$macc_year);
			$userdata['series_list'] = $getCommonData['getseries'];

			foreach ($getCommonData['getdate'] as $fydata) {

				$userdata['fromDate'] =  $fydata->FY_FROM_DATE;
				$userdata['toDate']   =  $fydata->FY_TO_DATE;
			
			}
		
			return view('admin.finance.transaction.sales.edit_sale_quotation_form', $userdata+compact('title','stateOfAcc'));
		}else{
			$request->session()->flash('alert-error', 'Sales Quotation Not Found...!');
			return redirect('/Transaction/Sales/View-Sales-Quotation-Trans');
		}

    }

    public function DeleteSaleQuotation(Request $request){

        $head_id = $request->input('headID');
        //print_r($id);exit;
        if ($head_id!='') {

			$DeleteHead = DB::table('SQTN_HEAD')->where('SQTNHID',$head_id)->delete();
			$DeleteBody = DB::table('SQTN_BODY')->where('SQTNHID',$head_id)->delete();
			$DeleteTax  = DB::table('SQTN_TAX')->where('SQTNHID',$head_id)->delete();

			if ($DeleteHead && $DeleteBody && $DeleteTax) {

				$request->session()->flash('alert-success', 'Sale Quotation Data Was Deleted Successfully...!');
				return redirect('/Transaction/Sales/View-Sales-Quotation-Trans');

			} else {

				$request->session()->flash('alert-error', 'Sale Quotation Data Can Not Deleted...!');
				return redirect('/Transaction/Sales/View-Sales-Quotation-Trans');

			}
		
		}else{

			$request->session()->flash('alert-error', 'Sale Quotation Data Not Found...!');
			return redirect('/Transaction/Sales/View-Sales-Quotation-Trans');

		}
	}


 public function GetItemSaleEnquiryData(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$itemcode = $request->input('itemcode');
	    
	    
	    	$itemData = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemcode)->get()->first();

	    	$itemfactor = DB::table('MASTER_ITEMUM')->where('ITEM_CODE',$itemcode)->get()->first();

   		   $fetch_reocrd = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode)->get()->toArray();
            
	    	
    		if ($itemData && $itemfactor) {

				$response_array['response']   = 'success';
				$response_array['data']       = $itemData;
				$response_array['datafactor'] = $itemfactor;
				$response_array['qp_data']    = $fetch_reocrd;

	           echo $data = json_encode($response_array);
	            //print_r($data);
			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['datafactor'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['datafactor'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function GetEnqDateSaleEnquiryData(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$enq_no = $request->input('enq_no');
	    
	    
	    	$enqData = DB::table('SENQ_BODY')->where('VRNO',$enq_no)->get()->first();

	    	
	    	
    		if ($enqData) {

				$response_array['response']   = 'success';
				$response_array['data']       = $enqData;
				
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
                $response_array['datafactor'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function GetEnqTrackSaleEnquiryData(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	//$enq_no = $request->input('enq_no');
	    	$todayDate =  date("Y-m-d");

	   // 	print_r($todayDate);exit;
	    
	    	$enqData = DB::table('TRACK_ENQ_SALE')->where('TRACK_DATE',$todayDate)->get();

	    	
	    		//print_r($enqData);exit;

    		if ($enqData) {

				$response_array['response']   = 'success';
				$response_array['data']       = $enqData;
				
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
                $response_array['datafactor'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }



	public function UpdateSaleQuotation(Request $request){

		$createdBy    = $request->session()->get('userid');
		$compName     = $request->session()->get('company_name');
		$splitname    = explode('-', $compName);
		$compCode     = $splitname[0];
		$fisYear      =  $request->session()->get('macc_year');
		
		$pfct_code    = $request->input('pfct_code');
		$trans_code   = $request->input('trans_code');
		$series_code  = $request->input('series_code');
		$vr_no        = $request->input('vr_no');
		
		$trans_date   = $request->input('trans_date');
		$tr_vr_date   = date("Y-m-d", strtotime($trans_date));
		
		$duadate_date = $request->input('dueDate');
		$dua_date     = date("Y-m-d", strtotime($duadate_date));
		
		$accountCode  = $request->input('accountCode');
		$plant_code   = $request->input('plant_code');
		
		$tax_code     = $request->input('tax_code');
		$tax_byitem   = $request->input('tax_byitem');
		
		$item_code    = $request->input('item_code');
		
		$countItemCode  = count($item_code);
		$item_name      = $request->input('item_name');
		$remark         = $request->input('remark');
		$qty            = $request->input('qty');
		$unit_M         = $request->input('unit_M');
		$Aqty           = $request->input('Aqty');
		$add_unit_M     = $request->input('add_unit_M');
		$rate           = $request->input('rate');
		$basic_amt      = $request->input('basic_amt');
		$crAmtPerItm    = $request->input('crAmtPerItem');
		$hsn_code       = $request->input('hsn_code');
		$getdatacount   = $request->input('getdatacount');
		
		$head_tax_ind   = $request->input('head_tax_ind');
		$af_rate        = $request->input('af_rate');
		$amount         = $request->input('amount');
		
		$data_Count     = $request->input('data_Count');
		//print_r($data_Count);
		$rate_ind       = $request->input('rate_ind');
		$logicget       = $request->input('logicget');
		$staticget      = $request->input('staticget');
		$taxGlCode      = $request->input('taxGlCode');
		$taxIndCod      = $request->input('taxIndCode');
		
		$tol_index      = $request->input('tolerence_index');
		$tol_rate       = $request->input('tolerence_rate');
		$tol_value      = $request->input('tolerence_value');
		$quoComp_no     = $request->input('quoComp_no');
		
		$quaP_count     = $request->input('quaP_count');
		$allquaPcount   = $request->input('allquaPcount');
		$item_code_que  = $request->input('item_code_que');
		$item_category  = $request->input('item_category');
		$iqua_char      = $request->input('iqua_char');
		$iqua_desc      = $request->input('iqua_desc');
		$char_fromvalue = $request->input('char_fromvalue');
		$char_tovalue   = $request->input('char_tovalue');
		$saleQuoHead    = $request->input('saleQuoHead');
		$saleQuoBody    = $request->input('saleQuoBody');
		$existQty       = $request->input('existQty');
		$taxhid         = $request->input('taxhid');
		$datahead_tax =array();
		$databody_tax =array();

		for ($i=0; $i <$countItemCode ; $i++) { 

			$data_body = array(
				
				'ITEM_CODE'      =>$item_code[$i],
				'ITEM_NAME'      =>$item_name[$i],
				'PARTICULAR'     =>$remark[$i],
				'HSN_CODE'       =>$hsn_code[$i],
				'QTYISSUED'      =>$qty[$i],
				'UM'             =>$unit_M[$i],
				'AQTYISSUED'     =>$Aqty[$i],
				'AUM'            =>$add_unit_M[$i],
				'RATE'           =>$rate[$i],
				'BASICAMT'       =>$basic_amt[$i],
				'TAX_CODE'       =>$tax_byitem[$i],
				'DRAMT'          =>$crAmtPerItm[$i],
				'LAST_UPDATE_BY' =>$createdBy,
			);

			$dataBody = DB::table('SQTN_BODY')->where('SQTNHID',$saleQuoHead[$i])->where('SQTNBID',$saleQuoBody[$i])->update($data_body);

			DB::table('SQTN_TAX')->where('SQTNHID',$saleQuoHead[$i])->where('SQTNBID',$saleQuoBody[$i])->delete();

			if($data_Count[$i] == 0){

			}else{
				for ($q=0; $q < $data_Count[$i]; $q++) { 

					$a = array_fill(1, $data_Count[$i], $saleQuoBody[$i]);
					$str = implode(',',$a); 
					$last_id = explode(',',$str);
					$databody_tax[]= $last_id[0];

					$ab = array_fill(1, $data_Count[$i], $saleQuoHead[$i]);
					$strh = implode(',',$ab); 
					$lasthid = explode(',',$strh);
					$datahead_tax[]= $lasthid[0];

			    }
			}
		} /* /. for loop*/

		

		for ($j=0; $j < $getdatacount; $j++) { 

			$staxH = DB::select("SELECT MAX(SQTNTID) as SQTNTID FROM SQTN_TAX");
			$taxID = json_decode(json_encode($staxH), true); 
		
			if(empty($taxID[0]['SQTNTID'])){
				$tax_Id = 1;
			}else{
				$tax_Id = $taxID[0]['SQTNTID']+1;
			}

				$data_tax = array(
					'SQTNHID'     => $datahead_tax[$j],
					'SQTNBID'     => $databody_tax[$j],
					'SQTNTID'     => $tax_Id,
					'TAXIND_NAME' => $head_tax_ind[$j],
					'TAXIND_CODE' => $taxIndCod[$j],
					'RATE_INDEX'  => $rate_ind[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $amount[$j],
					'TAX_LOGIC'   => $logicget[$j],
					'STATIC_IND'  => $staticget[$j],
					'TAXGL_CODE'  => $taxGlCode[$j],
					'CREATED_BY'  => $createdBy,
				);
			
				$data_tax =DB::table('SQTN_TAX')->insert($data_tax);
			
		} /*-- for loop close --*/

		if ($dataBody && $data_tax) {

				$response_array['response'] = 'success';

            	$data = json_encode($response_array);

          		print_r($data);

		}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
		}
	}


/*---- start sale contract transaction ----*/
	
	public function AddsalesContract(Request $request)
    {

		$title       ='Sale Contract Transaction';
		$CompanyCode = $request->session()->get('company_name');
		$splitcode   = explode('-', $CompanyCode);
		$compCode    =	$splitcode[0];
		$macc_year   = $request->session()->get('macc_year');
		$transCode   = 'S2';

		$tableData = MyConstruct();

		$userdata['acc_list']     = $tableData['master_party'];
		$userdata['taxcode_list'] = $tableData['master_tax'];
		$userdata['plant_list']   = $tableData['master_plant'];
		$userdata['item_list']    = $tableData['master_item'];
		$userdata['ratval_list']  = $tableData['master_rateValue'];
		$userdata['sale_rep_list'] = $tableData['sale_rep_code'];
		$userdata['cost_list']     = $tableData['master_cost'];

		$getCommonData = MyCommonFun($transCode,$compCode,$macc_year);

		$userdata['series_list'] = $getCommonData['getseries'];

		foreach ($getCommonData['getdate'] as $fydata) {

			$userdata['fromDate'] =  $fydata->FY_FROM_DATE;
			$userdata['toDate']   =  $fydata->FY_TO_DATE;
			
		}

		$transCode = DB::table('MASTER_TRANSACTION')->where('TRAN_CODE',$transCode)->get();

		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;

		if(isset($CompanyCode)){

		    return view('admin.finance.transaction.sales.sale_contract_trans',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}

    }


    public function SaveSaleContractTrans(Request $request){

		$createdBy       = $request->session()->get('userid');
		$fisYear         =  $request->session()->get('macc_year');
		$comp_nameval    = $request->session()->get('company_name');
		$explode         = explode('-', $comp_nameval);
		$getcom_code     = $explode[0];
		$trans_date      = $request->input('trans_date');
		$tr_vr_date      = date("Y-m-d", strtotime($trans_date));
		$trans_code      = $request->input('trans_code');
		$series_code     = $request->input('series_code');
		$vr_no           = $request->input('vr_no');
		$plant_code      = $request->input('plant_code');
		$pfct_code       = $request->input('pfct_code');
		$accountCode     = $request->input('accountCode');
		$accountName     = $request->input('accountName');
		$tax_code        = $request->input('tax_code');
		$dueDateget      = $request->input('dueDate');
		$dueDate         = date("Y-m-d", strtotime($dueDateget));
		$partyRefNo      = $request->input('party_ref_no');
		$partyRefDate    = $request->input('party_ref_date');
		$getpartyRefDate = date("Y-m-d", strtotime($partyRefDate));
		$gateDueDays     = $request->input('gate_dueDays');
		$consineCode     = $request->input('consine_code');
		$rFHeadO         = $request->input('rfhead1');
		$rFHeadT         = $request->input('rfhead2');
		$rFHeadTh        = $request->input('rfhead3');
		$rFHeadF         = $request->input('rfhead4');
		$rFHeadFi        = $request->input('rfhead5');
		$itembyPo        = $request->input('itemsale');
		$item_code       = $request->input('item_code');
		$item_count      = $request->input('itemcodeC');
		$countItemCode   = count($item_count);
		$item_name       = $request->input('item_name');
		$remark          = $request->input('remark');
		$qty             = $request->input('qty');
		$unit_M          = $request->input('unit_M');
		$Aqty            = $request->input('Aqty');
		$add_unit_M      = $request->input('add_unit_M');
		$rate            = $request->input('rate');
		$basic_amt       = $request->input('basic_amt');
		$hsn_code        = $request->input('hsn_code');
		$tax_byitem      = $request->input('tax_byitem');
		$grandAmt_cr     = $request->input('TotalGrandAmt');
		$getdatacount    = $request->input('getdatacount');
		$head_tax_ind    = $request->input('head_tax_ind');
		$tax_ind_code    = $request->input('taxIndCode');
		$af_rate         = $request->input('af_rate');
		$amount          = $request->input('amount');
		$logicget        = $request->input('logicget');
		$staticget       = $request->input('staticget');
		$dr_grandAmt     = $request->input('crAmtPerItem');
		$data_Count      = $request->input('data_Count');
		$sqseries        = $request->input('sq_series');
		$sqtranscode     = $request->input('sq_trans');
		$sqvrno          = $request->input('sq_vrno');
		$sqslno          = $request->input('sq_slno');
		$sqheadid        = $request->input('sq_head');
		$sqbodyid        = $request->input('sq_body');
		$rate_ind        = $request->input('rate_ind');
		
		$quaP_count      = $request->input('quaP_count');
		$allquaPcount    = $request->input('allquaPcount');
		$item_code_que   = $request->input('item_code_que');
		$item_category   = $request->input('item_category');
		$iqua_char       = $request->input('iqua_char');
		$iqua_desc       = $request->input('iqua_desc');
		$char_fromvalue  = $request->input('char_fromvalue');
		$char_tovalue    = $request->input('char_tovalue');
		$tax_gl_code     = $request->input('taxGlCode');
		$donwloadStatus   = $request->input('donwloadStatus');

		$SconH = DB::select("SELECT MAX(SCNTRHID) as SCNTRHID FROM SCNTR_HEAD");
		$headID = json_decode(json_encode($SconH), true); 
	
		if(empty($headID[0]['SCNTRHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['SCNTRHID']+1;
		}

		if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('SCNTR_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

		DB::beginTransaction();

		try {

			$data = array(

				'SCNTRHID'         =>$head_Id,
				'COMP_CODE'        =>$getcom_code,
				'FY_CODE'          =>$fisYear,
				'PFCT_CODE'        =>$pfct_code,
				'PFCT_NAME'        =>$request->input('pfct_name'),
				'TRAN_CODE'        =>$trans_code,
				'SERIES_CODE'      =>$series_code,
				'SERIES_NAME'      =>$request->input('series_name'),
				'VRNO'             =>$NewVrno,
				'VRDATE'           =>$tr_vr_date,
				'PLANT_CODE'       =>$plant_code,
				'PLANT_NAME'       =>$request->input('plant_name'),
				'DUEDAYS'          =>$gateDueDays,
				'DUEDATE'          =>$dueDate,
				'ACC_CODE'         =>$accountCode,
				'ACC_NAME'         =>$request->input('account_name'),
				'CPCODE'           =>$request->input('cp_codeGet'),
				'COST_CENTER'      =>$request->input('Cost_Center'),
				'COST_CENTER_NAME' =>$request->input('CostName'),
				'SR_CODE'          =>$request->input('Sale_Reps'),
				'SR_NAME'          =>$request->input('sale_reps_name'),
				'TAX_CODE'         =>$tax_code,
				'PREFNO'           =>$partyRefNo,
				'PREFDATE'         =>$getpartyRefDate,
				'RFHEAD1'          =>$rFHeadO,
				'RFHEAD2'          =>$rFHeadT,
				'RFHEAD3'          =>$rFHeadTh,
				'RFHEAD4'          =>$rFHeadF,
				'RFHEAD5'          =>$rFHeadFi,
				'DRAMT'            =>$grandAmt_cr,
				'PMT_TERMS'        =>$request->input('payment_terms'),
				'ADV_RATE_I'       =>$request->input('adv_rate_i'),
				'ADV_RATE'         =>$request->input('adv_rate'),
				'ADV_AMT'          =>$request->input('adv_amt'),
				'CREATED_BY'       =>$createdBy,
			);

			$saveDataH = DB::table('SCNTR_HEAD')->insert($data);

			$discriptn_page = "Sale contract trans insert done by user";
			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$accountCode);

			$bodyid_tax = array();
			$bodyid_qp  = array();

    		for ($i=0; $i < $countItemCode ; $i++) {

	    		$SconB = DB::select("SELECT MAX(SCNTRBID) as SCNTRBID FROM SCNTR_BODY");
				$bodyID = json_decode(json_encode($SconB), true); 
			
				if(empty($bodyID[0]['SCNTRBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['SCNTRBID']+1;
				}

	    		if($itembyPo[$i]){
					$itmcd = $itembyPo[$i];
				}else if($item_code[$i]){
					$itmcd =$item_code[$i];
				}

				$data_body = array(
			
					'SCNTRHID'    =>$head_Id,
					'SCNTRBID'    =>$body_Id,
					'COMP_CODE'   =>$getcom_code,
					'FY_CODE'     =>$fisYear,
					'PFCT_CODE'   =>$pfct_code,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'VRNO'        =>$NewVrno,
					'SLNO'        =>$i+1,
					'VRDATE'      =>$tr_vr_date,
					'PLANT_CODE'  =>$plant_code,
					'SQTNHID'     =>$sqheadid[$i],
					'SQTNBID'     =>$sqbodyid[$i],
					'ITEM_CODE'   =>$itmcd,
					'ITEM_NAME'   =>$item_name[$i],
					'PARTICULAR'  =>$remark[$i],
					'HSN_CODE'    =>$hsn_code[$i],
					'QTYISSUED'   =>$qty[$i],
					'UM'          =>$unit_M[$i],
					'AQTYISSUED'  =>$Aqty[$i],
					'AUM'         =>$add_unit_M[$i],
					'RATE'        =>$rate[$i],
					'BASICAMT'    =>$basic_amt[$i],
					'TAX_CODE'    =>$tax_byitem[$i],
					'DRAMT'       =>$dr_grandAmt[$i],
					'CREATED_BY'  =>$createdBy,
				);

				$saveDataB = DB::table('SCNTR_BODY')->insert($data_body);

				if($sqheadid[$i] && $sqbodyid[$i] && $itmcd){
			
					$getQtyIsue = DB::table('SQTN_BODY')->where(['SQTNHID'=>$sqheadid[$i],'SQTNBID'=>$sqbodyid[$i],'ITEM_CODE'=>$itmcd])->get()->first();

					$getqtyIsued = $getQtyIsue->QTYRECD;

					$data_qtyIsd = array(
						'QTYRECD' =>$getqtyIsued+$qty[$i],
					);

					$getQtyIsue =  DB::table('SQTN_BODY')->where(['SQTNHID'=>$sqheadid[$i],'SQTNBID'=>$sqbodyid[$i],'ITEM_CODE'=>$itmcd])->update($data_qtyIsd);

					$getQtyisEq = DB::table('SQTN_BODY')->where(['SQTNHID'=>$sqheadid[$i],'SQTNBID'=>$sqbodyid[$i],'ITEM_CODE'=>$itmcd])->get()->first();

					if($getQtyisEq->QTYISSUED == $getQtyisEq->QTYRECD){

						$data_QUO= array(
				
							'SCNTRHID' =>$head_Id,
							'SCNTRBID' =>$body_Id,
						);
					 DB::table('SQTN_BODY')->where(['SQTNHID'=>$sqheadid[$i],'SQTNBID'=>$sqbodyid[$i],'ITEM_CODE'=>$itmcd])->update($data_QUO);
					}

				}

				if($data_Count[$i] == 0){

				}else{

					for ($q=0; $q < $data_Count[$i]; $q++) { 

						$a = array_fill(1, $data_Count[$i], $body_Id);
						$str = implode(',',$a); 
						$last_id = explode(',',$str);

						$bodyid_tax[]= $last_id[0];

					}

				}


				if($quaP_count[$i] == 0){

				}else{

					for ($u=0; $u < $quaP_count[$i]; $u++) { 

						$qp = array_fill(1, $quaP_count[$i], $body_Id);
						$strqp = implode(',',$qp); 
						$last_idqp = explode(',',$strqp);

						$bodyid_qp[]= $last_idqp[0];	

					}

				}
			
    		} /* ./ BODY FOR LOOP*/

    		for ($j=0; $j < $getdatacount; $j++) { 

	    		$SconT = DB::select("SELECT MAX(SCNTRTID) as SCNTRTID FROM SCNTR_TAX");
				$taxID = json_decode(json_encode($SconT), true); 
			
				if(empty($taxID[0]['SCNTRTID'])){
					$tax_Id = 1;
				}else{
					$tax_Id = $taxID[0]['SCNTRTID']+1;
				}

				if(($amount[$j] == '') || ($amount[$j] == null)){
					$taxAmount = 0.00;
				}else{
					$taxAmount = $amount[$j];
				}

				$data_tax = array(
					'SCNTRHID'    => $head_Id,
					'SCNTRBID'    => $bodyid_tax[$j],
					'SCNTRTID'    => $tax_Id,
					'TAXIND_CODE' => $tax_ind_code[$j],
					'TAXIND_NAME' => $head_tax_ind[$j],
					'RATE_INDEX'  => $rate_ind[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $taxAmount,
					'TAX_LOGIC'   => $logicget[$j],
					'TAXGL_CODE'  => $tax_gl_code[$j],
					'STATIC_IND'  => $staticget[$j],
					'CREATED_BY'  => $createdBy,
				);
				
				$saveDataT = DB::table('SCNTR_TAX')->insert($data_tax);
		
			} /*-- for loop close --*/

			for ($p=0; $p < $allquaPcount; $p++) { 

				$SconQ = DB::select("SELECT MAX(SCNTRQID) as SCNTRQID FROM SCNTR_QUA");
				$quoID = json_decode(json_encode($SconQ), true); 
			
				if(empty($quoID[0]['SCNTRQID'])){
					$quo_Id = 1;
				}else{
					$quo_Id = $quoID[0]['SCNTRQID']+1;
				}

				$data_quaP = array(
					'SCNTRHID'       => $head_Id,
					'SCNTRBID'       => $bodyid_qp[$p],
					'SCNTRQID'       => $quo_Id,
					'COMP_CODE'      => $getcom_code,
					'FY_CODE'        => $fisYear,
					'PFCT_CODE'      => $pfct_code,
					'TRAN_CODE'      => $trans_code,
					'SERIES_CODE'    => $series_code,
					'VRNO'           => $NewVrno,
					'VRDATE'         => $tr_vr_date,
					'PLANT_CODE'     => $plant_code,
					'ITEM_CODE'      => $item_code_que[$p],
					'ICATG_CODE'     => $item_category[$p],
					'IQUA_CHAR'      => $iqua_char[$p],
					'CHAR_FROMVALUE' => $char_fromvalue[$p],
					'CHAR_TOVALUE'   => $char_tovalue[$p],
					'CREATED_BY'     => $createdBy,
				);
				
				$saveDataQ = DB::table('SCNTR_QUA')->insert($data_quaP);
			
			} /*-- for loop close --*/

			$headtable    = 'SCNTR_HEAD';
			$bodytable    = 'SCNTR_BODY';
			$taxtable     = 'SCNTR_TAX';
			$columnheadid = 'SCNTRHID';
			$pdfPageName  = 'SALES CONTRACT';
			$vrNoPname    = 'CNTR NO';
			$tcode        = $trans_code;

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->get()->toArray();

			if(empty($checkvrnoExist)){
				$datavrnIn =array(
					'COMP_CODE'   =>$getcom_code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);
			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->update($datavrn);
			}

			DB::commit();
			if($donwloadStatus == 1){

				return $this->GeneratePdfForSale($createdBy,$getcom_code,$head_Id,$headtable,$bodytable,$taxtable,$columnheadid,$pdfPageName,$vrNoPname,$tcode);

			}else{}
			$response_array['response'] = 'success';
		    $data = json_encode($response_array);
		    print_r($data);

		} catch (\Exception $e) {
		    DB::rollBack();
		    throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}

    } /* . /MAIN FUNCTION*/

    public function SaleContractSaveMsg(Request $request,$saveData){
	 //	print_r($savedata);exit;
		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/Transaction/Sales/View-Sale-Contract-Trans');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/Transaction/Sales/View-Sale-Contract-Trans');

		}
	}

    public function ViewSaleContractTrans(Request $request){

     $compName = $request->session()->get('company_name');

        if($request->ajax()) {
    
            $title ='View Sale Contract Transaction';
    
            $userid    = $request->session()->get('userid');
    
            $userType = $request->session()->get('usertype');
    
            $compName = $request->session()->get('company_name');
    	
    		$compcode    = explode('-', $compName);

			$getcompcode =	$compcode[0];

            $fisYear =  $request->session()->get('macc_year');
    
    
            if($userType=='admin' || $userType=='Admin'){

           //DB::enableQueryLog();

            $data =DB::select("SELECT SCNTR_HEAD.*,SCNTR_BODY.SCNTRHID as salehid,SCNTR_BODY.SCNTRBID,SCNTR_BODY.SORDERHID,SCNTR_BODY.SORDERBID,group_concat(concat(SCNTR_BODY.SORDERHID))AS SORDRSTATUSHD,group_concat(concat(SCNTR_BODY.SORDERBID))AS SORDRSTATUSBD,group_concat(concat(SCNTR_BODY.QTYRECD))AS nextTranQty FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_BODY.SCNTRHID = SCNTR_HEAD.SCNTRHID WHERE SCNTR_HEAD.FY_CODE='$fisYear' AND SCNTR_HEAD.COMP_CODE ='$getcompcode' GROUP BY SCNTR_HEAD.SCNTRHID");


    
           // $data = DB::table('SCNTR_HEAD')->where('FY_CODE',$fisYear)->orderBy('SCNTRHID','DESC');

           // dd(DB::getQueryLog());
    
            }else if($userType=='superAdmin' || $userType=='user'){
    
               // $data = DB::table('SCNTR_HEAD')->where('FY_CODE',$fisYear)->orderBy('SCNTRHID','DESC');

            	$data =DB::select("SELECT SCNTR_HEAD.*,SCNTR_BODY.SCNTRHID as salehid,SCNTR_BODY.SCNTRBID,SCNTR_BODY.SORDERHID,SCNTR_BODY.SORDERBID,group_concat(concat(SCNTR_BODY.SORDERHID))AS SORDRSTATUSHD,group_concat(concat(SCNTR_BODY.SORDERBID))AS SORDRSTATUSBD,group_concat(concat(SCNTR_BODY.QTYRECD))AS nextTranQty FROM SCNTR_HEAD LEFT JOIN SCNTR_BODY ON SCNTR_BODY.SCNTRHID = SCNTR_HEAD.SCNTRHID WHERE SCNTR_HEAD.FY_CODE='$fisYear' AND SCNTR_HEAD.COMP_CODE ='$getcompcode' GROUP BY SCNTR_HEAD.SCNTRHID");
    
            }
            else{
    
                $data='';
                
            }	

            return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();
    
        /*return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();*/
    
    
        }

        if(isset($compName)){

      	 	return view('admin.finance.transaction.sales.view_sale_contract');
        }else{
			return redirect('/useractivity');
		}
        
    }

    public function ViewSaleContractChildRow(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$vrno   = $request->input('vrno');
		    $headid = $request->input('tblid');

	    
	    	$grndata = DB::table('SCNTR_BODY')->where('VRNO',$vrno)->where('SCNTRHID',$headid)->get();

    		if ($grndata) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $grndata;

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

    public function EditSaleContract(Request $request,$headid,$bodyid,$vrno){

    	$id =base64_decode($headid);
    	$body_id =base64_decode($bodyid);
    	$vrno  =base64_decode($vrno);
    	
    	if($id!=''){
    	   	//DB::enableQueryLog();
			$userdata['getSalecontract'] = DB::select("SELECT t1.*,t2.*,t2.id as bodyid FROM sale_contract_body t2 LEFT JOIN sale_contract_head t1 ON t1.id = t2.sale_contract_id AND t1.vr_no = t2.vrno WHERE t1.id='$id' AND t1.vr_no='$vrno'");
			//dd(DB::getQueryLog());
			
			$title                      ='Sale Contract Transaction';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		$userdata['getacc']         = DB::table('master_party')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('master_config')->where(['tran_code'=>'S2'])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']  = DB::table('master_tax_rate')->groupBy('tax_code')->get();
		
		//DB::enableQueryLog();
		$userdata['getplant']     = DB::table('master_plant')->get();
		//dd(DB::getQueryLog());
		$userdata['help_item_list'] = DB::table('master_item_finance')->get();
		
		$userdata['rate_list']      = DB::table('rate_value')->get();

		$getdate = DB::table('master_fy')->where(['comp_code'=>$getcompcode,'fy_code'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->fy_from_date;
					$userdata['toDate']   =  $key->fy_to_date;
					}

		$quotation_head = new sale_quotation_head();
		//DB::enableQueryLog();
   		$requistion = $quotation_head->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();
   		//dd(DB::getQueryLog());

   		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->vr_no;
			}
			$userdata['vrNumber'] =$vrseqnum;

		    $vr_No_list= DB::select("SELECT * FROM `master_vrseq` WHERE comp_name='$CompanyCode' AND fiscal_year='$macc_year' AND tran_code='S2'");
		
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userdata['last_num']  = $key->last_no;
					$userdata['to_num']  = $key->to_no;
					$userdata['trans_head']  = $key->tran_code;
				}

			}else{

					$userdata['last_num']  ='';
					$userdata['to_num']  ='';
					$userdata['trans_head']  ='';

			}

			return view('admin.finance.transaction.sales.edit_sale_contract', $userdata+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'HSN Id Not Found...!');
			return redirect('/finance/view-hsn-rate-master');
		}

    }

    public function DeleteSaleContract(Request $request){

        $head_id = $request->input('headID');
        //print_r($id);exit;
        if ($head_id!='') {

			$DeleteHead = DB::table('SCNTR_HEAD')->where('SCNTRHID',$head_id)->delete();
			$DeleteBody = DB::table('SCNTR_BODY')->where('SCNTRHID',$head_id)->delete();
			$DeleteTax  = DB::table('SCNTR_TAX')->where('SCNTRHID',$head_id)->delete();
			$DeleteQp   = DB::table('SCNTR_QUA')->where('SCNTRHID',$head_id)->delete();

			if ($DeleteHead && $DeleteBody && $DeleteTax && $DeleteQp) {

				$request->session()->flash('alert-success', 'Sale Contract Data Was Deleted Successfully...!');
				return redirect('/Transaction/Sales/View-Sale-Contract-Trans');

			} else {

				$request->session()->flash('alert-error', 'Sale Contract Data Can Not Deleted...!');
				return redirect('/Transaction/Sales/View-Sale-Contract-Trans');

			}
		
		}else{

			$request->session()->flash('alert-error', 'Sale Contract Data Not Found...!');
			return redirect('/Transaction/Sales/View-Sale-Contract-Trans');

		}
	}

/*---- sale contract transaction ----*/


/*---- sale order transaction ----*/
	
	public function AddsalesOrder(Request $request)
    {

		$title       ='Sale Order Transaction';
		
		$CompanyCode = $request->session()->get('company_name');
		$splitcode   = explode('-', $CompanyCode);
		$compcode    =	$splitcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$tableData = MyConstruct();

		$userdata['acc_list']     = $tableData['master_party'];
		$userdata['taxcode_list'] = $tableData['master_tax'];
		$userdata['plant_list']   = $tableData['master_plant'];
		$userdata['item_list']    = $tableData['master_item'];
		$userdata['ratval_list']  = $tableData['master_rateValue'];
		$userdata['sale_rep_list'] = $tableData['sale_rep_code'];
		$userdata['cost_list']     = $tableData['master_cost'];
		$transCode   = 'S3';
		
		$getCommonData = MyCommonFun($transCode,$compcode,$macc_year);

		$userdata['series_list'] = $getCommonData['getseries'];

		foreach ($getCommonData['getdate'] as $fydata) {

			$userdata['fromDate'] =  $fydata->FY_FROM_DATE;
			$userdata['toDate']   =  $fydata->FY_TO_DATE;
			
		}	

		$transCode = DB::table('MASTER_TRANSACTION')->where('TRAN_CODE',$transCode)->get();

		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;
		

		if(isset($CompanyCode)){

		    return view('admin.finance.transaction.sales.sale_order_trans',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }

    public function SaveSalesOrder(Request $request){

		$createdBy = $request->session()->get('userid');
		$compName  = $request->session()->get('company_name');
		$fisYear   =  $request->session()->get('macc_year');
		$comp_nameval     = $request->session()->get('company_name');
		$explode          = explode('-', $comp_nameval);
		$getcom_code      = $explode[0];
		$trans_date       = $request->input('trans_date');
		$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
		$trans_code       = $request->input('trans_code');
		$series_code      = $request->input('series_code');
		$vr_no            = $request->input('vr_no');
		$plant_code       = $request->input('plant_code');
		$pfct_code        = $request->input('pfct_code');
		$accountCode      = $request->input('accountCode');
		$accountName      = $request->input('accountName');
		$tax_code         = $request->input('tax_code');
		$dueDateget       = $request->input('dueDate');
		$dueDate          = date("Y-m-d", strtotime($dueDateget));
		$partyRefNo       = $request->input('party_ref_no');
		$partyRefDate     = $request->input('party_ref_date');
		$getpartyRefDate  = date("Y-m-d", strtotime($partyRefDate));
		$dueDays      = $request->input('gate_dueDays');
		$consineCode      = $request->input('consine_code');
		$rFHeadO          = $request->input('rfhead1');
		$rFHeadT          = $request->input('rfhead2');
		$rFHeadTh         = $request->input('rfhead3');
		$rFHeadF          = $request->input('rfhead4');
		$rFHeadFi         = $request->input('rfhead5');
		$itembyPo         = $request->input('itemsale');
		$item_code        = $request->input('item_code');
		$item_count       = $request->input('itemcodeC');
		$countItemCode    = count($item_count);
		$item_name        = $request->input('item_name');
		$remark           = $request->input('remark');
		$qty              = $request->input('qty');
		$unit_M           = $request->input('unit_M');
		$Aqty             = $request->input('Aqty');
		$add_unit_M       = $request->input('add_unit_M');
		$rate             = $request->input('rate');
		$basic_amt        = $request->input('basic_amt');
		$hsn_code         = $request->input('hsn_code');
		$tax_byitem       = $request->input('tax_byitem');
		$grandAmt_cr      = $request->input('TotalGrandAmt');
		$getdatacount     = $request->input('getdatacount');
		$head_tax_ind     = $request->input('head_tax_ind');
		$tax_ind_code     = $request->input('taxIndCode');
		$af_rate          = $request->input('af_rate');
		$amount           = $request->input('amount');
		$logicget         = $request->input('logicget');
		$staticget        = $request->input('staticget');
		$dr_grandAmt      = $request->input('crAmtPerItem');
		$data_Count       = $request->input('data_Count');
		$scseries         = $request->input('sc_series');
		$sctranscode      = $request->input('sc_trans');
		$scvrno           = $request->input('sc_vrno');
		$scslno           = $request->input('sc_slno');
		$scheadid         = $request->input('sc_head');
		$scbodyid         = $request->input('sc_body');
		$rate_ind         = $request->input('rate_ind');

		$quaP_count       = $request->input('quaP_count');
		$allquaPcount     = $request->input('allquaPcount');
		$item_code_que    = $request->input('item_code_que');
		$item_category    = $request->input('item_category');
		$iqua_char        = $request->input('iqua_char');
		$iqua_desc        = $request->input('iqua_desc');
		$char_fromvalue   = $request->input('char_fromvalue');
		$char_tovalue     = $request->input('char_tovalue');
		$tax_gl_code      = $request->input('taxGlCode');
		$donwloadStatus   = $request->input('donwloadStatus');

		$sorderH = DB::select("SELECT MAX(SORDERHID) as SORDERHID FROM SORDER_HEAD");
		$headID = json_decode(json_encode($sorderH), true); 
	
		if(empty($headID[0]['SORDERHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['SORDERHID']+1;
		}

		if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('SORDER_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

		DB::beginTransaction();

		try {

			$dataH = array(

				'SORDERHID'        =>$head_Id,
				'COMP_CODE'        =>$getcom_code,
				'FY_CODE'          =>$fisYear,
				'PFCT_CODE'        =>$pfct_code,
				'PFCT_NAME'        =>$request->input('pfct_name'),
				'TRAN_CODE'        =>$trans_code,
				'SERIES_CODE'      =>$series_code,
				'SERIES_NAME'      =>$request->input('series_name'),
				'VRNO'             =>$NewVrno,
				'VRDATE'           =>$tr_vr_date,
				'PLANT_CODE'       =>$plant_code,
				'PLANT_NAME'       =>$request->input('plant_name'),
				'DUEDAYS'          =>$dueDays,
				'DUEDATE'          =>$dueDate,
				'ACC_CODE'         =>$accountCode,
				'ACC_NAME'         =>$request->input('account_name'),
				'CPCODE'           =>$request->input('cp_codeGet'),
				'COST_CENTER'      =>$request->input('Cost_Center'),
				'COST_CENTER_NAME' =>$request->input('CostName'),
				'SR_CODE'          =>$request->input('Sale_Reps'),
				'SR_NAME'          =>$request->input('sale_reps_name'),
				'TAX_CODE'         =>$tax_code,
				'PREFNO'           =>$partyRefNo,
				'PREFDATE'         =>$getpartyRefDate,
				'RFHEAD1'          =>$rFHeadO,
				'RFHEAD2'          =>$rFHeadT,
				'RFHEAD3'          =>$rFHeadTh,
				'RFHEAD4'          =>$rFHeadF,
				'RFHEAD5'          =>$rFHeadFi,
				'DRAMT'            =>$grandAmt_cr,
				'PMT_TERMS'        =>$request->input('payment_terms'),
				'ADV_RATE_I'       =>$request->input('adv_rate_i'),
				'ADV_RATE'         =>$request->input('adv_rate'),
				'ADV_AMT'          =>$request->input('adv_amt'),
				'CREATED_BY'       =>$createdBy,
			);

			$saveDataH = DB::table('SORDER_HEAD')->insert($dataH);

			$discriptn_page = "Sale order trans insert done by user";
			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$accountCode);

			$bodyid_tax = array();
			$bodyid_qp  = array();

    		for ($i=0; $i < $countItemCode ; $i++) {

	    		$sorderB = DB::select("SELECT MAX(SORDERBID) as SORDERBID FROM SORDER_BODY");
				$bodyID = json_decode(json_encode($sorderB), true); 
			
				if(empty($bodyID[0]['SORDERBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['SORDERBID']+1;
				}

	    		if($itembyPo[$i]){
					$itmcd = $itembyPo[$i];
				}else if($item_code[$i]){
					$itmcd =$item_code[$i];
				}

				$configapp = DB::table('MASTER_CONFIG_APPROVE')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->get()->toArray();

				if($configapp){
				//	print_r('hi');exit;
					$FLAG = 0;
				}else{
					//print_r('hello');exit;
					$FLAG = 3;
				}

				$data_body = array(
			
					'SORDERHID'   =>$head_Id,
					'SORDERBID'   =>$body_Id,
					'COMP_CODE'   =>$getcom_code,
					'FY_CODE'     =>$fisYear,
					'PFCT_CODE'   =>$pfct_code,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'VRNO'        =>$NewVrno,
					'SLNO'        =>$i+1,
					'VRDATE'      =>$tr_vr_date,
					'PLANT_CODE'  =>$plant_code,
					'SCNTRHID'    =>$scheadid[$i],
					'SCNTRBID'    =>$scbodyid[$i],
					'ITEM_CODE'   =>$itmcd,
					'ITEM_NAME'   =>$item_name[$i],
					'PARTICULAR'  =>$remark[$i],
					'HSN_CODE'    =>$hsn_code[$i],
					'ORDERQTY'    =>$qty[$i],
					'UM'          =>$unit_M[$i],
					'ORDERAQTY'   =>$Aqty[$i],
					'AUM'         =>$add_unit_M[$i],
					'RATE'        =>$rate[$i],
					'BASICAMT'    =>$basic_amt[$i],
					'TAX_CODE'    =>$tax_byitem[$i],
					'DRAMT'       =>$dr_grandAmt[$i],
					'FLAG'        =>$FLAG,
					'CREATED_BY'  =>$createdBy,
				);

				$saveDataB = DB::table('SORDER_BODY')->insert($data_body);
			
				if($scheadid[$i] && $scbodyid[$i]&& $itmcd){
			
					$getQtyIsue = DB::table('SCNTR_BODY')->where(['SCNTRHID'=>$scheadid[$i],'SCNTRBID'=>$scbodyid[$i],'ITEM_CODE'=>$itmcd])->get()->first();

					$getqtyIsued = $getQtyIsue->QTYRECD;

					$data_qtyIsd = array(
						'QTYRECD' =>$getqtyIsued+$qty[$i],
					);

					$getQtyIsue =  DB::table('SCNTR_BODY')->where(['SCNTRHID'=>$scheadid[$i],'SCNTRBID'=>$scbodyid[$i],'ITEM_CODE'=>$itmcd])->update($data_qtyIsd);

					$getQtyisEq = DB::table('SCNTR_BODY')->where(['SCNTRHID'=>$scheadid[$i],'SCNTRBID'=>$scbodyid[$i],'ITEM_CODE'=>$itmcd])->get()->first();

					if($getQtyisEq->QTYRECD == $getQtyisEq->QTYISSUED){

						$data_QUO= array(
				
							'SORDERHID' =>$head_Id,
							'SORDERBID' =>$body_Id,
						);
					 DB::table('SCNTR_BODY')->where(['SCNTRHID'=>$scheadid[$i],'SCNTRBID'=>$scbodyid[$i],'ITEM_CODE'=>$itmcd])->update($data_QUO);
					}

				}

				if($data_Count[$i] == 0){

				}else{

					for ($q=0; $q < $data_Count[$i]; $q++) { 

						$a = array_fill(1, $data_Count[$i], $body_Id);
						$str = implode(',',$a); 
						$last_id = explode(',',$str);

						$bodyid_tax[]= $last_id[0];

					}

				}

				if($quaP_count[$i] == 0){

				}else{

					for ($u=0; $u < $quaP_count[$i]; $u++) { 

						$qp = array_fill(1, $quaP_count[$i], $body_Id);
						$strqp = implode(',',$qp); 
						$last_idqp = explode(',',$strqp);

						$bodyid_qp[]= $last_idqp[0];

					}

				}
			
    		} /* ./ BODY FOR LOOP*/

    		for ($j=0; $j < $getdatacount; $j++) { 

	    		$sorderT = DB::select("SELECT MAX(SORDERTID) as SORDERTID FROM SORDER_TAX");
				$taxID = json_decode(json_encode($sorderT), true); 
			
				if(empty($taxID[0]['SORDERTID'])){
					$tax_Id = 1;
				}else{
					$tax_Id = $taxID[0]['SORDERTID']+1;
				}

				if(($amount[$j] == '') || ($amount[$j] == null)){
					$taxAmount = 0.00;
				}else{
					$taxAmount = $amount[$j];
				}

				$data_tax = array(
					'SORDERHID'   => $head_Id,
					'SORDERBID'   => $bodyid_tax[$j],
					'SORDERTID'   => $tax_Id,
					'TAXIND_CODE' => $tax_ind_code[$j],
					'TAXIND_NAME' => $head_tax_ind[$j],
					'RATE_INDEX'  => $rate_ind[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $taxAmount,
					'TAX_LOGIC'   => $logicget[$j],
					'TAXGL_CODE'  => $tax_gl_code[$j],
					'STATIC_IND'  => $staticget[$j],
					'CREATED_BY'  => $createdBy,
				);
				
				$saveDataT = DB::table('SORDER_TAX')->insert($data_tax);
		
			} /*-- for loop close --*/

			for ($p=0; $p < $allquaPcount; $p++) { 

				$sqpT = DB::select("SELECT MAX(SORDERQID) as SORDERQID FROM SORDER_QUA");
				$qpID = json_decode(json_encode($sqpT), true); 
			
				if(empty($qpID[0]['SORDERQID'])){
					$qp_Id = 1;
				}else{
					$qp_Id = $qpID[0]['SORDERQID']+1;
				}

				$data_quaP = array(
					'SORDERHID'      => $head_Id,
					'SORDERBID'      => $bodyid_qp[$p],
					'SORDERQID'      => $qp_Id,
					'COMP_CODE'      => $getcom_code,
					'FY_CODE'        => $fisYear,
					'PFCT_CODE'      => $pfct_code,
					'TRAN_CODE'      => $trans_code,
					'SERIES_CODE'    => $series_code,
					'VRNO'           => $NewVrno,
					'SLNO'           => $p+1,
					'VRDATE'         => $tr_vr_date,
					'PLANT_CODE'     => $plant_code,
					'ITEM_CODE'      => $item_code_que[$p],
					'ICATG_CODE'     => $item_category[$p],
					'IQUA_CHAR'      => $iqua_char[$p],
					'IQUA_UM'        => '',
					'CHAR_FROMVALUE' => $char_fromvalue[$p],
					'CHAR_TOVALUE'   => $char_tovalue[$p],
					'CREATED_BY'     => $createdBy,
				);
				
				$saveDataQ = DB::table('SORDER_QUA')->insert($data_quaP);
			
			} /*-- for loop close --*/

			$bodyTblNm = 'SORDER_BODY';
			$apvTblNm  = 'SORDER_APPROVE';
			$bodyCol   = 'SORDERBID';
			$apvCol    = 'SORDERAID';
			$headCol   = 'SORDERHID';

			$this->approve_Trans($bodyTblNm,$bodyCol,$trans_code,$series_code,$apvTblNm,$getcom_code,$fisYear,$pfct_code,$trans_code,$series_code,$NewVrno,$tr_vr_date,$createdBy,$head_Id,$apvCol,$headCol);

			$headtable    = 'SORDER_HEAD';
			$bodytable    = 'SORDER_BODY';
			$taxtable     = 'SORDER_TAX';
			$columnheadid = 'SORDERHID';
			$pdfPageName  = 'SALES ORDER';
			$vrNoPname    = 'ORDER NO';
			$tcode        = $trans_code;

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->get()->toArray();

			if(empty($checkvrnoExist)){
				$datavrnIn =array(
					'COMP_CODE'   =>$getcom_code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);
			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->update($datavrn);
			}

			DB::commit();
			if($donwloadStatus == 1){

				return $this->GeneratePdfForSale($createdBy,$getcom_code,$head_Id,$headtable,$bodytable,$taxtable,$columnheadid,$pdfPageName,$vrNoPname,$tcode);

			}else{}
			$response_array['response'] = 'success';
		    $data = json_encode($response_array);
		    print_r($data);

		} catch (\Exception $e) {
		    DB::rollBack();
		    //throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}

    } /* . /MAIN FUNCTION*/

    public function SaleOrderSaveMsg(Request $request,$saveData){
	 //	print_r($savedata);exit;
		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/Transaction/Sales/View-Sales-Order-Trans');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/Transaction/Sales/View-Sales-Order-Trans');

		}
	}

	public function DeleteSaleOrder(Request $request){

        $head_id = $request->input('headID');
        //print_r($id);exit;
        if ($head_id!='') {

			$DeleteHead = DB::table('SORDER_HEAD')->where('SORDERHID',$head_id)->delete();
			$DeleteBody = DB::table('SORDER_BODY')->where('SORDERHID',$head_id)->delete();
			$DeleteTax  = DB::table('SORDER_TAX')->where('SORDERHID',$head_id)->delete();
			$DeleteQP  = DB::table('SORDER_QUA')->where('SORDERHID',$head_id)->delete();

			if ($DeleteHead && $DeleteBody && $DeleteTax) {

				$request->session()->flash('alert-success', 'Sale Order Data Was Deleted Successfully...!');
				return redirect('/Transaction/Sales/View-Sales-Order-Trans');

			} else {

				$request->session()->flash('alert-error', 'Sale Order Data Can Not Deleted...!');
				return redirect('/Transaction/Sales/View-Sales-Order-Trans');

			}
		
		}else{

			$request->session()->flash('alert-error', 'Sale Order Data Not Found...!');
			return redirect('/Transaction/Sales/View-Sales-Order-Trans');

		}
	}



	public function AddDirectSaleTrans(Request $request)
    {

		$title       ='Direct Sale Transaction';
		
		$CompanyCode = $request->session()->get('company_name');
		$splitcode   = explode('-', $CompanyCode);
		$compcode    =	$splitcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$tableData = MyConstruct();

		$userdata['acc_list']     = $tableData['master_party'];
		$userdata['taxcode_list'] = $tableData['master_tax'];
		$userdata['plant_list']   = $tableData['master_plant'];
		$userdata['item_list']    = $tableData['master_item'];
		$userdata['ratval_list']  = $tableData['master_rateValue'];
		$userdata['sale_rep_list'] = $tableData['sale_rep_code'];
		$userdata['cost_list']     = $tableData['master_cost'];
		$transCode   = 'S5';

		$getCommonData = MyCommonFun($transCode,$compcode,$macc_year);

		$userdata['series_list'] = $getCommonData['getseries'];

		foreach ($getCommonData['getdate'] as $fydata) {

			$userdata['fromDate'] =  $fydata->FY_FROM_DATE;
			$userdata['toDate']   =  $fydata->FY_TO_DATE;
			
		}	

		$ordrVrno = DB::table('SORDER_HEAD')->where('COMP_CODE',$compcode)->where('FY_CODE',$macc_year)->get();

		   	$vrseqnum = '';
			foreach ($ordrVrno as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;


		$vr_No_list = DB::table('MASTER_VRSEQ')->where(['TRAN_CODE'=>$transCode,'COMP_CODE'=>$compcode])->get();

		if(!empty($vr_No_list)){

			foreach ($vr_No_list as $key) {
				$userdata['last_num']   = $key->LAST_NO;
				$userdata['to_num']     = $key->TO_NO;
				$userdata['trans_head'] = $key->TRAN_CODE;
			}

		}else{

				$userdata['last_num']  ='';
				$userdata['to_num']  ='';
				$userdata['trans_head']  ='';

		}

		if(isset($CompanyCode)){

		    return view('admin.finance.transaction.sales.direct_sale_trans',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }

/*DIRECT SALE TRANSACTION*/

     public function SaveDirectSalesTrans(Request $request){

		$createdBy       = $request->session()->get('userid');
		$compName        = $request->session()->get('company_name');
		$fisYear         =  $request->session()->get('macc_year');
		$comp_nameval    = $request->session()->get('company_name');
		$explode         = explode('-', $comp_nameval);
		$getcom_code     = $explode[0];
		$trans_date      = $request->input('trans_date');
		$tr_vr_date      = date("Y-m-d", strtotime($trans_date));
		$trans_code      = $request->input('trans_code');
		$series_code     = $request->input('series_code');
		$series_name     = $request->input('series_name');
		$vr_no           = $request->input('vr_no');
		$plant_code      = $request->input('plant_code');
		$plant_name      = $request->input('plant_name');
		$pfct_code       = $request->input('pfct_code');
		$pfct_name       = $request->input('pfct_name');
		$accountCode     = $request->input('accountCode');
		$accountName     = $request->input('account_name');
		$tax_code        = $request->input('tax_code');
		$dueDateget      = $request->input('dueDate');
		$dueDate         = date("Y-m-d", strtotime($dueDateget));
		$partyRefNo      = $request->input('party_ref_no');
		$partyRefDate    = $request->input('party_ref_date');
		$getpartyRefDate = date("Y-m-d", strtotime($partyRefDate));
		$dueDays         = $request->input('gate_dueDays');
		$consineCode     = $request->input('consine_code');
		$rFHeadO         = $request->input('rfhead1');
		$rFHeadT         = $request->input('rfhead2');
		$rFHeadTh        = $request->input('rfhead3');
		$rFHeadF         = $request->input('rfhead4');
		$rFHeadFi        = $request->input('rfhead5');
		$itembyPo        = $request->input('itemsale');
		$item_code       = $request->input('item_code');
		$item_count      = $request->input('itemcodeC');
		$countItemCode   = count($item_count);
		$item_name       = $request->input('item_name');
		$remark          = $request->input('remark');
		$qty             = $request->input('qty');
		$unit_M          = $request->input('unit_M');
		$Aqty            = $request->input('Aqty');
		$add_unit_M      = $request->input('add_unit_M');
		$rate            = $request->input('rate');
		$basic_amt       = $request->input('basic_amt');
		$hsn_code        = $request->input('hsn_code');
		$tax_byitem      = $request->input('tax_byitem');
		$grandAmt_cr     = $request->input('TotalGrandAmt');
		$getdatacount    = $request->input('getdatacount');
		$head_tax_ind    = $request->input('head_tax_ind');
		$tax_ind_code    = $request->input('taxIndCode');
		$af_rate         = $request->input('af_rate');
		$amount          = $request->input('amount');
		$logicget        = $request->input('logicget');
		$staticget       = $request->input('staticget');
		$dr_grandAmt     = $request->input('crAmtPerItem');
		$data_Count      = $request->input('data_Count');
		$scseries        = $request->input('sc_series');
		$sctranscode     = $request->input('sc_trans');
		$scvrno          = $request->input('sc_vrno');
		$scslno          = $request->input('sc_slno');
		$scheadid        = $request->input('sc_head');
		$scbodyid        = $request->input('sc_body');
		$rate_ind        = $request->input('rate_ind');
		
		$quaP_count      = $request->input('quaP_count');
		$allquaPcount    = $request->input('allquaPcount');
		$item_code_que   = $request->input('item_code_que');
		$item_category   = $request->input('item_category');
		$iqua_char       = $request->input('iqua_char');
		$iqua_desc       = $request->input('iqua_desc');
		$char_fromvalue  = $request->input('char_fromvalue');
		$char_tovalue    = $request->input('char_tovalue');
		$tax_gl_code     = $request->input('taxGlCode');
		$bill_type       = $request->input('bill_type');
		$series_gl       = $request->input('series_gl');
		$acc_glCode      = $request->input('acc_glCode');
		$acc_glName      = $request->input('acc_glName');
		$donwloadStatus  = $request->input('donwloadStatus');

		$sorderH = DB::select("SELECT MAX(SBILLHID) as SBILLHID FROM SBILL_HEAD");
		$headID = json_decode(json_encode($sorderH), true); 
	
		if(empty($headID[0]['SBILLHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['SBILLHID']+1;
		}

		if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('SBILL_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

			$headtable    = 'SBILL_HEAD';
			$bodytable    = 'SBILL_BODY';
			$taxtable     = 'SBILL_TAX';
			$columnheadid = 'SBILLHID';
			$pdfPageName  = 'SALES DIRECT BILL';
			$vrNoPname    = 'BILL NO';
			$tcode        = $trans_code;

		DB::beginTransaction();

		try {

			$dataH = array(

				'SBILLHID'   =>$head_Id,
				'COMP_CODE'   =>$getcom_code,
				'FY_CODE'     =>$fisYear,
				'PFCT_CODE'   =>$pfct_code,
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'SERIES_NAME' =>$series_name,
				'VRNO'        =>$NewVrno,
				'VRDATE'      =>$tr_vr_date,
				'PLANT_CODE'  =>$plant_code,
				'PLANT_NAME'  =>$plant_name,
				'DUEDAYS'     =>$dueDays,
				'DUEDATE'     =>$dueDate,
				'ACC_CODE'    =>$accountCode,
				'ACC_NAME'    =>$accountName,
				'CPCODE'      =>$request->input('cp_codeGet'),
				'COST_CENTER' =>$request->input('Cost_Center'),
				'SR_CODE'     =>$request->input('Sale_Reps'),
				'TAX_CODE'    =>$tax_code,
				'PREFNO'      =>$partyRefNo,
				'PREFDATE'    =>$getpartyRefDate,
				'RFHEAD1'     =>$rFHeadO,
				'RFHEAD2'     =>$rFHeadT,
				'RFHEAD3'     =>$rFHeadTh,
				'RFHEAD4'     =>$rFHeadF,
				'RFHEAD5'     =>$rFHeadFi,
				'DRAMT'       =>$grandAmt_cr,
				'BILL_TYPE'   =>'DS',
				'CREATED_BY'  =>$createdBy,
			);

			$saveDataH = DB::table('SBILL_HEAD')->insert($dataH);

			$discriptn_page = "Direct sale bill trans insert done by user";
			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$accountCode);

			$bodyid_tax = array();
			$bodyid_qp  = array();

			DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','DSB')->delete();

    		for ($i=0; $i < $countItemCode ; $i++) {

	    		$sorderB = DB::select("SELECT MAX(SBILLBID) as SBILLBID FROM SBILL_BODY");
				$bodyID = json_decode(json_encode($sorderB), true); 
			
				if(empty($bodyID[0]['SBILLBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['SBILLBID']+1;
				}

	    		if($itembyPo[$i]){
					$itmcd = $itembyPo[$i];
				}else if($item_code[$i]){
					$itmcd =$item_code[$i];
				}

				$configapp = DB::table('MASTER_CONFIG_APPROVE')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->get()->toArray();

				if($configapp){
				//	print_r('hi');exit;
					$FLAG = 0;
				}else{
					//print_r('hello');exit;
					$FLAG = 3;
				}

				$data_body = array(
				
					'SBILLHID'    =>$head_Id,
					'SBILLBID'    =>$body_Id,
					'COMP_CODE'   =>$getcom_code,
					'FY_CODE'     =>$fisYear,
					'PFCT_CODE'   =>$pfct_code,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'VRNO'        =>$NewVrno,
					'SLNO'        =>$i+1,
					'VRDATE'      =>$tr_vr_date,
					'PLANT_CODE'  =>$plant_code,
					'ITEM_CODE'   =>$itmcd,
					'ITEM_NAME'   =>$item_name[$i],
					'PARTICULAR'  =>$remark[$i],
					'HSN_CODE'    =>$hsn_code[$i],
					'QTYISSUED'    =>$qty[$i],
					'UM'          =>$unit_M[$i],
					'AQTYISSUED'   =>$Aqty[$i],
					'AUM'         =>$add_unit_M[$i],
					'RATE'        =>$rate[$i],
					'BASICAMT'    =>$basic_amt[$i],
					'TAX_CODE'    =>$tax_byitem[$i],
					'DRAMT'       =>$dr_grandAmt[$i],
					'BILL_TYPE'   =>'DS',
					'FLAG'        =>$FLAG,
					'CREATED_BY'  =>$createdBy,
				);

				$saveDataB = DB::table('SBILL_BODY')->insert($data_body);
			
				if($data_Count[$i] == 0){

				}else{

					for ($q=0; $q < $data_Count[$i]; $q++) { 

						$a = array_fill(1, $data_Count[$i], $body_Id);
						$str = implode(',',$a); 
						$last_id = explode(',',$str);

						$bodyid_tax[]= $last_id[0];

					}

				}

				/*if($quaP_count[$i] == 0){

				}else{

					for ($u=0; $u < $quaP_count[$i]; $u++) { 

						$qp = array_fill(1, $quaP_count[$i], $body_Id);
						$strqp = implode(',',$qp); 
						$last_idqp = explode(',',$strqp);

						$bodyid_qp[]= $last_idqp[0];

					}

				}*/
			
    		} /* ./ BODY FOR LOOP*/

    		for ($j=0; $j < $getdatacount; $j++) { 

	    		$sorderT = DB::select("SELECT MAX(SBILLTID) as SBILLTID FROM SBILL_TAX");
				$taxID = json_decode(json_encode($sorderT), true); 
			
				if(empty($taxID[0]['SBILLTID'])){
					$tax_Id = 1;
				}else{
					$tax_Id = $taxID[0]['SBILLTID']+1;
				}

				if(($amount[$j] == '') || ($amount[$j] == null)){
					$taxAmount = 0.00;
				}else{
					$taxAmount = $amount[$j];
				}

				$data_tax = array(
					'SBILLHID'    => $head_Id,
					'SBILLBID'    => $bodyid_tax[$j],
					'SBILLTID'    => $tax_Id,
					'TAXIND_CODE' => $tax_ind_code[$j],
					'TAXIND_NAME' => $head_tax_ind[$j],
					'RATE_INDEX'  => $rate_ind[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $taxAmount,
					'TAX_LOGIC'   => $logicget[$j],
					'TAXGL_CODE'  => $tax_gl_code[$j],
					'STATIC_IND'  => $staticget[$j],
					'CREATED_BY'  => $createdBy,
				);
				
				$saveDataT = DB::table('SBILL_TAX')->insert($data_tax);

				/* ---- START  : ACCOUNT ENTRY ------ */

					$indData = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','DSB')->get()->toArray();

					$checkExist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','DSB')->get()->toArray();

					if($amount[$j] != 0.00){
						if($rate_ind[$j] == 'Z'){}else{
							if(empty($checkExist)){

								$idary = array(
									'IND_CODE'    => $tax_ind_code[$j],
									'CR_AMT'      => $amount[$j],
									'IND_GL_CODE' => $series_gl,
									'REF_ACCCODE' => $accountCode,
									'REF_ACCNAME' => $accountName,
									'CREATED_BY'  => $createdBy,
									'TCFLAG'      => 'DSB',
								);
								DB::table('INDICATOR_TEMP')->insert($idary);
							}else  if($tax_gl_code[$j] == ''){

								$bscVal = DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$createdBy)->where('TCFLAG','DSB')->get()->toArray();
								$updateId = $bscVal[0]->CREATED_BY;
								$basicAmt = $bscVal[0]->CR_AMT + $amount[$j];
							
								$idary_bsic = array(
									'CR_AMT' 	  => $basicAmt,
								);

								DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$updateId)->where('TCFLAG','DSB')->update($idary_bsic);

							}else if(empty($indData)){

									$idary   = array(
										'IND_CODE'    => $tax_ind_code[$j],
										'CR_AMT'      => $amount[$j],
										'IND_GL_CODE' => $tax_gl_code[$j],
										//'IND_GL_NAME' => $gl_name,
										'REF_ACCCODE' => $accountCode,
										'REF_ACCNAME' => $accountName,
										'CREATED_BY'  => $createdBy,
										'TCFLAG'      => 'DSB',
										
									);
									DB::table('INDICATOR_TEMP')->insert($idary);
								}else{

									$indData1 = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','DSB')->get()->first();

									$newTaxAmt = $indData1->CR_AMT + $amount[$j];

									$idary1 = array(
										'CR_AMT' 	  => $newTaxAmt,
									);

									$updatevr = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','DSB')->update($idary1);

								}
						} /* check 
						*/

					} /* chek amount is blank*/

				/* ---- END  : ACCOUNT ENTRY ------ */
		
			} /*-- for loop close --*/

			$accData =  array(
						'IND_CODE'     => '',
						'DR_AMT'       => $grandAmt_cr,
						'IND_GL_CODE'  => $acc_glCode,
						'IND_GL_NAME'  => $acc_glName,
						'IND_ACC_CODE' => $accountCode,
						'IND_ACC_NAME' => $accountName,
						'REF_ACCCODE'  => $accountCode,
						'REF_ACCNAME'  => $accountName,
						'GLACC_Chk'    => 'ACC',
						'TCFLAG'       => 'DSB',
						'CREATED_BY'   => $createdBy,
			);
			DB::table('INDICATOR_TEMP')->insert($accData);

			//$ledgCount = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','DSB')->get()->toArray();

			$ledgCount = DB::table('INDICATOR_TEMP')
					->select('INDICATOR_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')
	           		->leftjoin('MASTER_GL', 'INDICATOR_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
	            	->where('INDICATOR_TEMP.TCFLAG','DSB')
	            	->where('INDICATOR_TEMP.CREATED_BY',$createdBy)
	            	->get()->toArray();

			/* START : insert account entry in gl and acc tran*/

			foreach ($ledgCount as $rows) {

				$gledgH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
					$gheadLedgID = json_decode(json_encode($gledgH), true); 
				
				if(empty($gheadLedgID[0]['GLTRANID'])){
					$ghead_ledg_Id = 1;
				}else{
					$ghead_ledg_Id = $gheadLedgID[0]['GLTRANID']+1;
				}

				$datalegd = array(
						'GLTRANID'    =>$ghead_ledg_Id,
						'COMP_CODE'   =>$getcom_code,
						'FY_CODE'     =>$fisYear,
						'TRAN_CODE'   =>$trans_code,
						'SERIES_CODE' =>$series_code,
						'VRNO'        =>$NewVrno,
						'VRDATE'      =>$tr_vr_date,
						//'PFCT_CODE' =>$pofitcCode,
						'GL_CODE'     =>$rows->IND_GL_CODE,
						'GL_NAME'     =>$rows->GL_NAME,
						'REF_CODE'    =>$rows->REF_ACCCODE,
						'REF_NAME'    =>$rows->REF_ACCNAME,
						'DRAMT'       =>$rows->DR_AMT,
						'CRAMT'       =>$rows->CR_AMT,
						'CREATED_BY'  => $createdBy,
						//'PARTICULAR' =>'Billno -'.$partyBilNo.', Billdate -'.$getPartyBilD.', BillAmt -'.$partyBilAmt,

					);
					DB::table('GL_TRAN')->insert($datalegd);


					$drAmt = $rows->DR_AMT;
				    $crAmt = $rows->CR_AMT;
				    $glcode = $rows->IND_GL_CODE;


				if(($drAmt == '') || ($drAmt == null)){
					$drAmntVal = 0.00;
				}else{
					$drAmntVal = $drAmt;
				}

				if(($crAmt == '') || ($crAmt == null)){
					$creAmntVal = 0.00;
				}else{
					$creAmntVal = $crAmt;
				}


			$getdata = DB::table('MASTER_GLBAL')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('GL_CODE', $glcode)->get()->first();

				if($getdata){

					$RDRAMT = $getdata->RDRAMT;
				    $RCRAMT = $getdata->RCRAMT;
				    $YROPDR = $getdata->YROPDR;
				    $YROPCR = $getdata->YROPCR;

				    $debitAmt =  $drAmntVal + $RDRAMT;

				    $creditAmt =  $creAmntVal + $RCRAMT;

				    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);
				  

				  //  print_r($RBAL);exit;

		            $dataarqty = array(
		            	
						'RDRAMT'  => $debitAmt,
						'RCRAMT'  => $creditAmt,
						'RBAL'    => $RBAL,
				
		            );

             $updateData12 = DB::table('MASTER_GLBAL')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('GL_CODE', $glcode)->update($dataarqty);

				}else{

					$dataItmBal = array(
						'COMP_CODE' => $getcom_code,
						'FY_CODE'   => $fisYear,
						'GL_CODE'   => $glcode,
						'RDRAMT'    => $drAmntVal,
						'RCRAMT'    => $creAmntVal,
					);

					DB::table('MASTER_GLBAL')->insert($dataItmBal);
				}

				if($rows->GLACC_Chk == 'ACC'){

					$ACCledgH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
					$AheadLedgID = json_decode(json_encode($ACCledgH), true); 
				
					if(empty($AheadLedgID[0]['ACCTRANID'])){
						$ahead_ledg_Id = 1;
					}else{
						$ahead_ledg_Id = $AheadLedgID[0]['ACCTRANID']+1;
					}

					$dataaclegd = array(
						'ACCTRANID'    =>$ahead_ledg_Id,
						'COMP_CODE'    =>$getcom_code,
						'FY_CODE'      =>$fisYear,
						'TRAN_CODE'    =>$trans_code,
						'SERIES_CODE'  =>$series_code,
						'VRNO'         =>$NewVrno,
						'VRDATE'       =>$tr_vr_date,
						//'PFCT_CODE'  =>$pofitcCode,
						//'GL_CODE'      =>$rows->IND_GL_CODE,
						'ACC_CODE'     =>$rows->IND_ACC_CODE,
						'ACC_NAME'     =>$rows->IND_ACC_NAME,
						'REF_CODE'     =>$acc_glCode,
						'REF_NAME'     =>$acc_glName,
						'DRAMT'        =>$rows->DR_AMT,
						'CRAMT'        =>$rows->CR_AMT,
						'CREATED_BY'   => $createdBy,
						//'PARTICULAR' =>'Billno -'.$partyBilNo.', Billdate -'.$getPartyBilD.', BillAmt -'.$partyBilAmt,

					);
					DB::table('ACC_TRAN')->insert($dataaclegd);



				$getdata = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('ACC_CODE', $rows->IND_ACC_CODE)->get()->first();

			          $dramnt = $rows->DR_AMT;
			          $cramnt = $rows->CR_AMT;
				
				if($getdata){

		            $RDRAMT = $getdata->RDRAMT;
				    $RCRAMT = $getdata->RCRAMT;
				    $YROPDR = $getdata->YROPDR;
				    $YROPCR = $getdata->YROPCR;

				    $debitAmt =  $dramnt + $RDRAMT;

				    $creditAmt =  $cramnt + $RCRAMT;

				    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);

				  //  print_r($RBAL);exit;

		            $dataarqty = array(
		            	
						'RDRAMT'  => $debitAmt,
						'RCRAMT'  => $creditAmt,
						'RBAL'    => $RBAL,
				
		            );

             $updateData12 = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('ACC_CODE', $rows->IND_ACC_CODE)->update($dataarqty);

				}else{

					$dataItmBal = array(
						'COMP_CODE' => $getcom_code,
						'FY_CODE'   => $fisYear,
						'PFCT_CODE' => $pfct_code,
						'ACC_CODE'  => $rows->IND_ACC_CODE,
						'RDRAMT'    => $dramnt,
						'RCRAMT'    => $cramnt,
					);

					DB::table('MASTER_ACCBAL')->insert($dataItmBal);
				}

			}

		}

			/* END : insert account entry in gl and acc tran*/

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->get()->toArray();

			if(empty($checkvrnoExist)){
				$datavrnIn =array(
					'COMP_CODE'   =>$getcom_code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);
			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->update($datavrn);
			}
		DB::commit();

			$response_array['response'] = 'success';
			if($donwloadStatus == 1){

				return $this->GeneratePdfForSale($createdBy,$getcom_code,$head_Id,$headtable,$bodytable,$taxtable,$columnheadid,$pdfPageName,$vrNoPname,$tcode);

			}else{}
		    $data = json_encode($response_array);
		    print_r($data);
		} catch (\Exception $e) {
		    DB::rollBack();
		    throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}

    } 

    public function DirectSaleBillSaveMsg(Request $request,$saveData){
	 //	print_r($savedata);exit;
		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/transaction/sales/view-sales-transaction');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/transaction/sales/view-sales-transaction');

		}
	}

/*DIRECT SALE TRANSACTION*/


	public function GetSaleOrdForApp(Request $request){

    	$response_array = array();

        if ($request->ajax()) {

			$tran_code   = $request->input('tran_code');
			$series_code = $request->input('series_code');
			$slno        = $request->input('slno');
			$vr_no       = $request->input('vr_no');
            //print_r($slno);exit;
        
            $fetch_reocrd = DB::SELECT("SELECT p1.* FROM SORDER_BODY p1  WHERE p1.TRAN_CODE='$tran_code' AND p1.VRNO ='$vr_no' AND p1.SLNO='$slno'");

        

            /*$fetch_reocrd = DB::SELECT("SELECT p1.*,p2.* FROM purchase_order_head p1  LEFT JOIN purchase_order_body p2 ON p2.purchase_order_head_id = p1.id WHERE p1.tran_code='$tran_code' AND p1.series_code='$series_code' AND p1.vr_no='$vr_no'");*/

          // print_r($fetch_reocrd);exit;
            //dd(DB::getQueryLog());
        
            if ($fetch_reocrd!='') {

               

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
                $response_array['data'] = '';

                $data = json_encode($response_array);

                print_r($data);
        }


    }



    public function StatusSaleOrder(Request $request){

		$userId         = $request->session()->get('userid');
		$tran_code      = $request->input('tran_code');
		$series_code    = $request->input('series_code');
		$vr_no          = $request->input('vr_no');
		$sl_no          = $request->input('sl_no');
		$approve_remark = $request->input('approve_remark_sale');
		

		//print_r($approve_remark);exit;

        if ($userId!='') {

        		 //DB::enableQueryLog();
        	$getlevleno = DB::table('SORDER_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->get()->first();

        	//dd(DB::getQueryLog());

        	 $levno = $getlevleno->LEVEL_NO;
        	// print_r($getlevleno->level_no);exit;

        	 $levelNo =  $levno + 1;

        	 $data1=array(
    			'APPROVE_STATUS'=>'3'
    		);

        	// DB::enableQueryLog();

			$UpdateLevel = DB::table('SORDER_APPROVE')->where('LEVEL_NO', $levelNo)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);

			//dd(DB::getQueryLog());

    		$data=array(
    			'APPROVE_STATUS'=>'1',
    			'APPROVE_REMARK'=>$approve_remark,
    			'FLAG'=>'1',

    		);


			$Updatedata = DB::table('SORDER_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data);


			$selectdata = DB::table('SORDER_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->where('LASTUSER','3')->where('APPROVE_STATUS','1')->get()->first();


			if ($selectdata) {

				$data1=array(
	    			'APPROVE_REMARK'=>$approve_remark,
	    			'FLAG'=>'1',

	    		);

	    		$Updatedata1 = DB::table('SORDER_BODY')->where('TRAN_CODE',$selectdata->TRAN_CODE)->where('VRNO',$selectdata->VRNO)->where('SLNO',$selectdata->SLNO)->update($data1);

			}else{

				$Updatedata1 = TRUE;

			}

			

			

			if($Updatedata && $Updatedata1){

				$request->session()->flash('alert-success', 'Purchase Order Approved Successfully...!');
				return redirect('finance/user-approval-list/'.base64_encode($userId));

			} else {

				$request->session()->flash('alert-error', 'Purchase Order Can Not Approved...!');
				return redirect('finance/user-approval-list/'.base64_encode($userId));

			}

		}else{

		$request->session()->flash('alert-error', 'HSN Rate Data Not Found...!');
		return redirect('/finance/view-hsn-rate-master');

		}

}


function RejectSaleOrder(Request $request){

    	$userid    = $request->session()->get('userid');
    	
			$approval_remark = $request->input('approve_remark');
			$vr_no           = $request->input('vr_no');
			$tran_code       = $request->input('tran_code');
			$sl_no           = $request->input('sl_no');



				$data1=array(
	    			'APPROVE_REMARK'=>$approval_remark,
	    			'FLAG'=>'2',

	    		);

	    		$Updatedata = DB::table('SORDER_BODY')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);

	    		$data12=array(
	    			'REJECTED_STATUS'=>1,
	    			'APPROVE_STATUS'=>2,

	    		);

	    	$Updatedata12 = DB::table('SORDER_APPROVE')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data12);

	    		

	    	 $DeleteData = DB::table('SORDER_APPROVE')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('APPROVE_USER',$userid)->where('SLNO',$sl_no)->delete();


			
			if ($Updatedata && $DeleteData) {

	            $response_array['response'] = 'success';
                $response_array['data'] = '' ;

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

}


	public function ViewSalesOrder(Request $request){

 		$compName = $request->session()->get('company_name');

     	if($request->ajax()) {

	        $title ='View Master Account';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $compName = $request->session()->get('company_name');

	        $compcode    = explode('-', $compName);

			$getcompcode =	$compcode[0];

	        $fisYear =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){
	      // DB::enableQueryLog();

	         //$data = DB::table('SORDER_HEAD')->orderBy('SORDERHID','DESC');
            
	        /* $data = DB::table('SORDER_HEAD')
				->select('SORDER_HEAD.*','SORDER_BODY.SORDERHID as salehid','SORDER_BODY.SORDERBID','SORDER_BODY.SCHALLANHID','SORDER_BODY.SCHALLANBID','SORDER_BODY.FLAG as sbglag', 'MASTER_CONFIG.SERIES_NAME','MASTER_PLANT.PLANT_NAME','MASTER_ACC.ACC_NAME')
           		->leftjoin('MASTER_CONFIG', 'MASTER_CONFIG.SERIES_CODE', '=', 'SORDER_HEAD.SERIES_CODE')
           		->leftjoin('MASTER_PLANT', 'MASTER_PLANT.PLANT_CODE', '=', 'SORDER_HEAD.PLANT_CODE')
           		->leftjoin('MASTER_ACC', 'MASTER_ACC.ACC_CODE', '=', 'SORDER_HEAD.ACC_CODE')
           		->leftjoin('SORDER_BODY', 'SORDER_BODY.SORDERHID', '=', 'SORDER_HEAD.SORDERHID')
           		->groupBy('SORDER_HEAD.SORDERHID')
           		->orderBy('SORDER_HEAD.SORDERHID','DESC');*/

           		$data =DB::select("SELECT SORDER_HEAD.*,SORDER_BODY.SORDERHID as salehid,SORDER_BODY.SORDERBID,SORDER_BODY.SCHALLANHID,SORDER_BODY.SCHALLANBID,group_concat(concat(SORDER_BODY.SCHALLANHID))AS SCHLANSTATUSHD,group_concat(concat(SORDER_BODY.SCHALLANBID))AS SCHLANSTATUSBD,group_concat(concat(SORDER_BODY.QTYISSUED))AS nextTranQty FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_BODY.SORDERHID = SORDER_HEAD.SORDERHID WHERE SORDER_HEAD.FY_CODE='$fisYear' AND SORDER_HEAD.COMP_CODE='$getcompcode' GROUP BY SORDER_HEAD.SORDERHID");



				}else if($userType=='superAdmin' || $userType=='user'){

	          $data =DB::select("SELECT SORDER_HEAD.*,SORDER_BODY.SORDERHID as salehid,SORDER_BODY.SORDERBID,SORDER_BODY.SCHALLANHID,SORDER_BODY.SCHALLANBID,group_concat(concat(SORDER_BODY.SCHALLANHID))AS SCHLANSTATUSHD,group_concat(concat(SORDER_BODY.SCHALLANBID))AS SCHLANSTATUSBD,group_concat(concat(SORDER_BODY.QTYISSUED))AS nextTranQty FROM SORDER_HEAD LEFT JOIN SORDER_BODY ON SORDER_BODY.SORDERHID = SORDER_HEAD.SORDERHID WHERE SORDER_HEAD.FY_CODE='$fisYear' AND SORDER_HEAD.COMP_CODE='$getcompcode' GROUP BY SORDER_HEAD.SORDERHID");
	        }
	        else{

	            $data='';
	            
	        }

    		return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();


    	}

    	if(isset($compName)){

       		return view('admin.finance.transaction.sales.view_sale_order');
    	}else{
			return redirect('/useractivity');
		}
        
	}

	public function SaleorderChieldRTowData(Request $request){

		$response_array = array();

	    $vrno = $request->input('vrno');
	    $tblid = $request->input('tblid');

	   /// print_r($gl_code_help);exit();

		if ($request->ajax()) {

	    	$sale_ordr_chield = DB::table("SORDER_BODY")->where('SORDERHID',$tblid)->where('VRNO',$vrno)->get();

	    	//print_r($sale_ordr_chield);exit;
	    	
    		if ($sale_ordr_chield) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $sale_ordr_chield ;

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

    public function EditSaleOrder(Request $request,$headid,$bodyid,$vrno){

    	$id =base64_decode($headid);
    	$body_id =base64_decode($bodyid);
    	$vrno  =base64_decode($vrno);
    	
    	if($id!=''){
    	   	//DB::enableQueryLog();
			$userdata['getSaleOrder'] = DB::select("SELECT t1.*,t2.*,t2.id as bodyid FROM sales_order_body t2 LEFT JOIN sales_order_head t1 ON t1.id = t2.sales_order_head_id AND t1.vr_no = t2.vrno WHERE t1.id='$id' AND t1.vr_no='$vrno'");
			//dd(DB::getQueryLog());
			
			$title                      ='Sale Order Transaction';
		
		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['getacc']         = DB::table('master_party')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('master_config')->where(['tran_code'=>'S3'])->get();
		//dd(DB::getQueryLog());
		
		$userdata['tax_code_list']  = DB::table('master_tax_rate')->groupBy('tax_code')->get();
		
		//DB::enableQueryLog();
		$userdata['getplant']     = DB::table('master_plant')->get();
		//dd(DB::getQueryLog());
		$userdata['help_item_list'] = DB::table('master_item_finance')->get();
		
		$userdata['rate_list']      = DB::table('rate_value')->get();

		$getdate = DB::table('master_fy')->where(['comp_code'=>$getcompcode,'fy_code'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->fy_from_date;
					$userdata['toDate']   =  $key->fy_to_date;
					}

		$quotation_head = new sale_quotation_head();
		//DB::enableQueryLog();
   		$requistion = $quotation_head->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();
   		//dd(DB::getQueryLog());

   		//print_r($requistion);exit;

		   	$vrseqnum = '';
			foreach ($requistion as $key) {
				$vrseqnum =  $key->vr_no;
			}
			$userdata['vrNumber'] =$vrseqnum;

		$vr_No_list= DB::select("SELECT * FROM `master_vrseq` WHERE comp_name='$CompanyCode' AND fiscal_year='$macc_year' AND tran_code='S3'");
		
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userdata['last_num']  = $key->last_no;
					$userdata['to_num']  = $key->to_no;
					$userdata['trans_head']  = $key->tran_code;
				}

			}else{

					$userdata['last_num']  ='';
					$userdata['to_num']  ='';
					$userdata['trans_head']  ='';

			}

			return view('admin.finance.transaction.sales.edit_sale_order_trans', $userdata+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'HSN Id Not Found...!');
			return redirect('/finance/view-hsn-rate-master');
		}

    }



/*---- sale order transaction ----*/

/*---- sale bill transaction ----*/

	public function AddSalesTrans(Request $request){

		$title      ='Add Sales';
		
		$CompanyCode = $request->session()->get('company_name');
		$splitcode    = explode('-', $CompanyCode);
		$compcode =	$splitcode[0];
		$macc_year   = $request->session()->get('macc_year');
		$transCode   = 'S5';

		$tableData = MyConstruct();

		$userdata['acc_list']     = $tableData['master_party'];

		$getCommonData = MyCommonFun($transCode,$compcode,$macc_year);

		$userdata['series_list'] = $getCommonData['getseries'];

		foreach ($getCommonData['getdate'] as $fydata) {

			$userdata['fromDate'] =  $fydata->FY_FROM_DATE;
			$userdata['toDate']   =  $fydata->FY_TO_DATE;
			
		}

		$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$transCode)->get();

   		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;


		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.sales.sale_trans',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

	}

	public function GetDataFrmSoForSaleBill(Request $request){


        if ($request->ajax()) {

            if (!empty($request->account_code || $request->saleOrderNo)) {
                
				$account_code = $request->account_code;
				$saleOrderNo  = $request->saleOrderNo;

                $strWhere='';

                if(isset($account_code)  && trim($account_code)!="")
                {
                     $strWhere .= "AND SCHALLAN_HEAD.ACC_CODE='$account_code'";
                }

                 if(isset($saleOrderNo)  && trim($saleOrderNo)!="")
                {
                    $strWhere .= "AND SCHALLAN_HEAD.VRNO='$saleOrderNo'";
                }
              //  DB::enableQueryLog();
                $data = DB::select("SELECT SCHALLAN_HEAD.*, SCHALLAN_BODY.*, SCHALLAN_BODY.SCHALLANBID as salchalnbodyid,SCHALLAN_BODY.DRAMT as grandAmt FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID WHERE 1=1 $strWhere AND SCHALLAN_BODY.SBILLHID='0' AND SCHALLAN_BODY.SBILLBID='0'");
              //  dd(DB::getQueryLog());
                //DB::enableQueryLog();
                /*$data =  DB::table('grn_head')->select('grn_head.*','grn_body.*','grn_body.id as grnbodyid')
                   ->leftjoin('grn_body', 'grn_head.id', '=', 'grn_body.grn_head_id')
                ->where([['grn_head.vr_no','=',$grnrvrno],['grn_head.acc_code','=',$account_code]])
                ->get();*/
                //dd(DB::getQueryLog());
                //print_r($data);exit();
                return DataTables()->of($data)->addIndexColumn()->make(true);
                
            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);

               

            }

        }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);

               

        }

        
    }

	public function SaveSaleTrans(Request $request){

		$CompanyCode  = $request->session()->get('company_name');
		$compcode_get = explode('-', $CompanyCode);
		$compcode     = $compcode_get[0];
		$MaccYear     = $request->session()->get('macc_year');
		$userId       = $request->session()->get('userid');
		

		

		if ($request->ajax()) {

			$donwloadStatus   = $request->donwloadStatus;

			//print_r($donwloadStatus);exit;

			$data_Count       = 9;
			$chkcitm          = $request->checkitm;
			$accCode          = $request->accCode;
			$accountName      = $request->accountName;
			$sovrno           = $request->sovrno;
			$transcode        = $request->transcode;
			$trans_date       = $request->trans_date;
			$vrseqnum         = $request->vrseqnum;
			$pofitcCode       = $request->pofitcCode;
			$plantCode        = $request->plantCodeso;
			$seriesCode       = $request->seriesCode;
			$series_Code      = $request->series_Code;
			$series_name      = $request->series_name;
			$seriesGl         = $request->seriesGl;
			$netAmount        = $request->netAmount;
			$accGlCode        = $request->accGlCode;
			$accGlName        = $request->accGlName;
			$cpCode           = $request->cpCode;
			$pfctNamePgi      = $request->pfctNamePgi;
			$plantNamePgi     = $request->plantNamePgi;
			$dueDayPgi        = $request->dueDayPgi;
			$dueDatePgi       = $request->dueDatePgi;
			$costCnterPgi     = $request->costCnterPgi;
			$costCentrNamePgi = $request->costCentrNamePgi;
			$srcodePgi        = $request->srcodePgi;
			$srcodeNamePgi    = $request->srcodeNamePgi;
			$trptcodePgi      = $request->trptcodePgi;
			$trptNamePgi      = $request->trptNamePgi;
			$vehicleNoPgi     = $request->vehicleNoPgi;
			$ebillNoPgi       = $request->ebillNoPgi;
			$lrnoPgi          = $request->lrnoPgi;
			$seriesCodePgi    = $request->seriesCodePgi;
			$partyBilNo       = $request->partyBilNo;
			$partyBilDate     = $request->partyBilDate;
			$rfHeadOne        = $request->rfHeadOne;
			$rfHeadTwo        = $request->rfHeadTwo;
			$rfHeadThre       = $request->rfHeadThre;
			$rfHeadFour       = $request->rfHeadFour;
			$rfHeadFive       = $request->rfHeadFive;
			
			$getdate      = date("Y-m-d", strtotime($trans_date));

			$getcountitm  = count($chkcitm);

			$sBillH = DB::select("SELECT MAX(SBILLHID) as SBILLHID FROM SBILL_HEAD");
			$headID = json_decode(json_encode($sBillH), true); 
		
			if(empty($headID[0]['SBILLHID'])){
				$head_Id = 1;
			}else{
				$head_Id = $headID[0]['SBILLHID']+1;
			}

			if($vrseqnum == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vrseqnum;
			}

			$vrno_Exist = DB::table('SBILL_HEAD')->where('SERIES_CODE',$series_Code)->where('COMP_CODE',$compcode)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}


			$headtable    = 'SBILL_HEAD';
			$bodytable    = 'SBILL_BODY';
			$taxtable     = 'SBILL_TAX';
			$columnheadid = 'SBILLHID';
			$pdfPageName  = 'SALES BILL';
			$vrNoPname    = 'BILL NO';
			$tcode        = $transcode;

		DB::beginTransaction();

		try {

			$datahead  = array(
				'SBILLHID'         => $head_Id,
				'COMP_CODE'        => $compcode,
				'FY_CODE'          => $MaccYear,
				'PFCT_CODE'        => $pofitcCode,
				'PFCT_NAME'        => $pfctNamePgi,
				'TRAN_CODE'        => $transcode,
				'SERIES_CODE'      => $series_Code,
				'SERIES_NAME'      => $series_name,
				'VRNO'             => $NewVrno,
				'SLNO'             => 1,
				'VRDATE'           => $getdate,
				'PLANT_CODE'       => $plantCode,
				'PLANT_NAME'       => $plantNamePgi,
				'DUEDAYS'          => $dueDayPgi,
				'DUEDATE'          => $dueDatePgi,
				'ACC_CODE'         => $accCode,
				'ACC_NAME'         => $accountName,
				'CPCODE'           => $cpCode,
				'COST_CENTER'      => $costCnterPgi,
				'COST_CENTER_NAME' => $costCentrNamePgi,
				'SR_CODE'          => $srcodePgi,
				'SR_NAME'          => $srcodeNamePgi,
				'PREFNO'           => $partyBilNo,
				'PREFDATE'         => $partyBilDate,
				'RFHEAD1'          => $rfHeadOne,
				'RFHEAD2'          => $rfHeadTwo,
				'RFHEAD3'          => $rfHeadThre,
				'RFHEAD4'          => $rfHeadFour,
				'RFHEAD5'          => $rfHeadFive,
				'TRPT_CODE'        => $trptcodePgi,
				'TRPT_NAME'        => $trptNamePgi,
				'VEHICAL_NO'       => $vehicleNoPgi,
				'E_WAY_BILL_NO'    => $ebillNoPgi,
				'LR_NO'            => $lrnoPgi,
				'BILL_TYPE'        => 'SB',
				'CREATED_BY'       => $userId
			);

			DB::table('SBILL_HEAD')->insert($datahead);

			$discriptn_page = "Sale bill trans insert done by user";
			$this->userLogInsert($userId,$transcode,$series_Code,$NewVrno,$discriptn_page,$accCode);

			DB::table('INDICATOR_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','S')->delete();

			for ($i=0; $i < $getcountitm ; $i++) {

				$sBillB = DB::select("SELECT MAX(SBILLBID) as SBILLBID FROM SBILL_BODY");
				$bodyID = json_decode(json_encode($sBillB), true); 
			
				if(empty($bodyID[0]['SBILLBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['SBILLBID']+1;
				}

				$getcheckdata = $chkcitm[$i];

				$explodedata = explode('/', $getcheckdata);

				$headid  = $explodedata[0];
				$bodyid  = $explodedata[1];
				$itmcode = $explodedata[2];

				$dataB = DB::table('SCHALLAN_BODY')->where('SCHALLANHID',$headid)->where('SCHALLANBID',$bodyid)->where('ITEM_CODE',$itmcode)->get();

				foreach ($dataB as $row) {

					$dataBody  = array(

						'SBILLHID'    => $head_Id,
						'SBILLBID'    => $body_Id,
						'COMP_CODE'   => $compcode,
						'FY_CODE'     => $MaccYear,
						'TRAN_CODE'   => $transcode,
						'SERIES_CODE' => $series_Code,
						'VRNO'        => $NewVrno,
						'VRDATE'      => $getdate,
						'SORDERHID'   => $row->SORDERHID,
						'SORDERBID'   => $row->SORDERBID,
						'ITEM_CODE'   => $row->ITEM_CODE,
						'ITEM_NAME'   => $row->ITEM_NAME,
						'PARTICULAR'  => $row->PARTICULAR,
						'HSN_CODE'    => $row->HSN_CODE,
						'QTYISSUED'   => $row->QTYISSUED,
						'UM'          => $row->UM,
						'AQTYISSUED'  => $row->AQTYISSUED,
						'AUM'         => $row->AUM,
						'RATE'        => $row->RATE,
						'BASICAMT'    => $row->BASICAMT,
						'TAX_CODE'    => $row->TAX_CODE,
						'DRAMT'       => $row->DRAMT,
						'BILL_TYPE'   =>'SB',
						'CREATED_BY'  => $userId,
			
					);

					$saveDataB = DB::table('SBILL_BODY')->insert($dataBody);

					$data_bil= array(
		
						'SBILLHID' =>$head_Id,
						'SBILLBID' =>$body_Id,
					);
			 		DB::table('SCHALLAN_BODY')->where(['SCHALLANHID'=>$headid,'SCHALLANBID'=>$bodyid,'ITEM_CODE'=>$itmcode])->update($data_bil);

				} /* /. foreach loop*/

				$taxsData = DB::select("SELECT t1.*,t2.*,t3.*,t4.GL_CODE,t4.GL_NAME FROM SCHALLAN_TAX t3 LEFT JOIN SCHALLAN_BODY t2 ON t2.SCHALLANBID = t3.SCHALLANBID LEFT JOIN SCHALLAN_HEAD t1 ON t1.SCHALLANHID = t3.SCHALLANHID LEFT JOIN MASTER_GL t4 ON t4.GL_CODE=t3.TAXGL_CODE WHERE t2.ITEM_CODE='$itmcode' AND t3.SCHALLANHID='$headid' AND t3.SCHALLANBID='$bodyid'");

				$taxcount = count($taxsData);

				for($k=0;$k<$taxcount;$k++){

					$sBillT = DB::select("SELECT MAX(SBILLTID) as SBILLTID FROM SBILL_TAX");
					$taxID = json_decode(json_encode($sBillT), true); 
					
					if(empty($taxID[0]['SBILLTID'])){
						$tax_Id = 1;
					}else{
						$tax_Id = $taxID[0]['SBILLTID']+1;
					}

					$uniqCheck   = $taxsData[$k]->TAXIND_CODE;
					$taxamt      = $taxsData[$k]->TAX_AMT;
					$rateindex   = $taxsData[$k]->RATE_INDEX;
					$tax_gl_code = $taxsData[$k]->TAXGL_CODE;
					$gl_name     = $taxsData[$k]->GL_NAME;

					$datatax = array(
						'SBILLHID'    => $head_Id,
						'SBILLBID'    => $body_Id,
						'SBILLTID'    => $tax_Id,
						'TAXIND_CODE' => $taxsData[$k]->TAXIND_CODE,
						'TAXIND_NAME' => $taxsData[$k]->TAXIND_NAME,
						'RATE_INDEX'  => $taxsData[$k]->RATE_INDEX,
						'TAX_RATE'    => $taxsData[$k]->TAX_RATE,
						'TAX_AMT'     => $taxsData[$k]->TAX_AMT,
						'TAX_LOGIC'   => $taxsData[$k]->TAX_LOGIC,
						'TAXGL_CODE'  => $taxsData[$k]->TAXGL_CODE,
						'STATIC_IND'  => $taxsData[$k]->STATIC_IND 
					);

					DB::table('SBILL_TAX')->insert($datatax);

					$indData = DB::table('INDICATOR_TEMP')->where('IND_CODE',$uniqCheck)->where('CREATED_BY',$userId)->where('TCFLAG','S')->get()->toArray();

					$checkExist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','S')->get()->toArray();

					if($taxamt != 0.00){
						if($rateindex == 'Z'){}else{

							if(empty($checkExist)){

								$idary = array(
									'IND_CODE'    => $uniqCheck,
									'CR_AMT'      => $taxamt,
									'IND_GL_CODE' => $seriesGl,
									'REF_ACCCODE' => $accCode,
									'REF_ACCNAME' => $accountName,
									'CREATED_BY'  => $userId,
									'TCFLAG'      => 'S',
								);
								DB::table('INDICATOR_TEMP')->insert($idary);
							}else if($tax_gl_code == ''){

								$bscVal = DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$userId)->where('TCFLAG','S')->get()->toArray();
								$updateId = $bscVal[0]->CREATED_BY;
								$basicAmt = $bscVal[0]->CR_AMT + $taxamt;
							
								$idary_bsic = array(
									'CR_AMT' 	  => $basicAmt,
								);

								DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$updateId)->where('TCFLAG','S')->update($idary_bsic);

							}else if(empty($indData)){

								$idary   = array(
									'IND_CODE'    => $uniqCheck,
									'CR_AMT'      => $taxamt,
									'IND_GL_CODE' => $tax_gl_code,
									'IND_GL_NAME' => $gl_name,
									'REF_ACCCODE' => $accCode,
									'REF_ACCNAME' => $accountName,
									'CREATED_BY'  => $userId,
									'TCFLAG'      => 'S',
									
								);
								DB::table('INDICATOR_TEMP')->insert($idary);
							}else{

								$indData1 = DB::table('INDICATOR_TEMP')->where('IND_CODE',$uniqCheck)->where('CREATED_BY',$userId)->where('TCFLAG','S')->get()->first();

								$newTaxAmt = $indData1->CR_AMT + $taxamt;

								$idary1 = array(
									'CR_AMT' 	  => $newTaxAmt,
								);

								$updatevr = DB::table('INDICATOR_TEMP')->where('IND_CODE',$uniqCheck)->where('CREATED_BY',$userId)->where('TCFLAG','S')->update($idary1);

							}
						}
					}

				} /* /. tax data*/


			} /* /. MAIN FOR LOOP */

			$accData =  array(
							'IND_CODE'     => '',
							'DR_AMT'       => $netAmount,
							'IND_GL_CODE'  => $accGlCode,
							'IND_GL_NAME'  => $accGlName,
							'IND_ACC_CODE' => $accCode,
							'IND_ACC_NAME' => $accountName,
							'REF_ACCCODE'  => $accCode,
							'REF_ACCNAME'  => $accountName,
							'GLACC_Chk'    => 'ACC',
							'TCFLAG'       => 'S',
							'CREATED_BY'   => $userId,
						);
			DB::table('INDICATOR_TEMP')->insert($accData);

			$ledgCount = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','S')->get()->toArray();

			foreach ($ledgCount as $rows) {

				$gledgH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
					$gheadLedgID = json_decode(json_encode($gledgH), true); 
				
				if(empty($gheadLedgID[0]['GLTRANID'])){
					$ghead_ledg_Id = 1;
				}else{
					$ghead_ledg_Id = $gheadLedgID[0]['GLTRANID']+1;
				}

				$datalegd = array(
						'GLTRANID'    =>$ghead_ledg_Id,
						'COMP_CODE'   =>$compcode,
						'FY_CODE'     =>$MaccYear,
						'TRAN_CODE'   =>$transcode,
						'SERIES_CODE' =>$series_Code,
						'VRNO'        =>$NewVrno,
						'VRDATE'      =>$getdate,
						//'PFCT_CODE' =>$pofitcCode,
						'GL_CODE'     =>$rows->IND_GL_CODE,
						'GL_NAME'     =>$rows->IND_GL_NAME,
						'REF_CODE'    =>$rows->REF_ACCCODE,
						'REF_NAME'    =>$rows->REF_ACCNAME,
						'DRAMT'       =>$rows->DR_AMT,
						'CRAMT'       =>$rows->CR_AMT,
						'CREATED_BY'  => $userId,
						//'PARTICULAR' =>'Billno -'.$partyBilNo.', Billdate -'.$getPartyBilD.', BillAmt -'.$partyBilAmt,

					);
					DB::table('GL_TRAN')->insert($datalegd);


				$drAmt = $rows->DR_AMT;
				$crAmt = $rows->CR_AMT;
				$glcode = $rows->IND_GL_CODE;


				if(($drAmt == '') || ($drAmt == null)){
					$drAmntVal = 0.00;
				}else{
					$drAmntVal = $drAmt;
				}

				if(($crAmt == '') || ($crAmt == null)){
					$creAmntVal = 0.00;
				}else{
					$creAmntVal = $crAmt;
				}


			$getdata = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->where('GL_CODE', $glcode)->get()->first();

				if($getdata){

					$RDRAMT = $getdata->RDRAMT;
				    $RCRAMT = $getdata->RCRAMT;
				    $YROPDR = $getdata->YROPDR;
				    $YROPCR = $getdata->YROPCR;

				    $debitAmt =  $drAmntVal + $RDRAMT;

				    $creditAmt =  $creAmntVal + $RCRAMT;

				    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);
				  

				  //  print_r($RBAL);exit;

		            $dataarqty = array(
		            	
						'RDRAMT'  => $debitAmt,
						'RCRAMT'  => $creditAmt,
						'RBAL'    => $RBAL,
				
		            );

             $updateData12 = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->where('GL_CODE', $glcode)->update($dataarqty);

				}else{

					$dataItmBal = array(
						'COMP_CODE' => $compcode,
						'FY_CODE'   => $MaccYear,
						'GL_CODE'   => $glcode,
						'RDRAMT'    => $drAmntVal,
						'RCRAMT'    => $creAmntVal,
					);

					DB::table('MASTER_GLBAL')->insert($dataItmBal);
				}

				if($rows->GLACC_Chk == 'ACC'){

					$ACCledgH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
					$AheadLedgID = json_decode(json_encode($ACCledgH), true); 
				
					if(empty($AheadLedgID[0]['ACCTRANID'])){
						$ahead_ledg_Id = 1;
					}else{
						$ahead_ledg_Id = $AheadLedgID[0]['ACCTRANID']+1;
					}

					$dataaclegd = array(
						'ACCTRANID'    =>$ahead_ledg_Id,
						'COMP_CODE'    =>$compcode,
						'FY_CODE'      =>$MaccYear,
						'TRAN_CODE'    =>$transcode,
						'SERIES_CODE'  =>$series_Code,
						'VRNO'         =>$NewVrno,
						'VRDATE'       =>$getdate,
						//'PFCT_CODE'  =>$pofitcCode,
						//'GL_CODE'      =>$rows->IND_GL_CODE,
						'ACC_CODE'     =>$rows->IND_ACC_CODE,
						'ACC_NAME'     =>$rows->IND_ACC_NAME,
						'REF_CODE'     =>$accGlCode,
						'REF_NAME'     =>$accGlName,
						'DRAMT'        =>$rows->DR_AMT,
						'CRAMT'        =>$rows->CR_AMT,
						'CREATED_BY'   => $userId,
						//'PARTICULAR' =>'Billno -'.$partyBilNo.', Billdate -'.$getPartyBilD.', BillAmt -'.$partyBilAmt,

					);
					DB::table('ACC_TRAN')->insert($dataaclegd);


				   $dramnt = $rows->DR_AMT;
			       $cramnt = $rows->CR_AMT;
			       $acc_code = $rows->IND_ACC_CODE;

			       $getdata = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->where('ACC_CODE', $acc_code)->get()->first();

			       
				
				   if($getdata){

		            $RDRAMT = $getdata->RDRAMT;
				    $RCRAMT = $getdata->RCRAMT;
				    $YROPDR = $getdata->YROPDR;
				    $YROPCR = $getdata->YROPCR;

				    $debitAmt =  $dramnt + $RDRAMT;

				    $creditAmt =  $cramnt + $RCRAMT;

				    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);

				  //  print_r($RBAL);exit;

		            $dataarqty = array(
		            	
						'RDRAMT'  => $debitAmt,
						'RCRAMT'  => $creditAmt,
						'RBAL'    => $RBAL,
				
		            );

                   $updateData12 = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->where('ACC_CODE', $acc_code)->update($dataarqty);

				}else{

					$dataItmBal = array(
						'COMP_CODE' => $compcode,
						'FY_CODE'   => $MaccYear,
						'PFCT_CODE' => $pofitcCode,
						'ACC_CODE'  => $acc_code,
						'RDRAMT'    => $dramnt,
						'RCRAMT'    => $cramnt,
					);

					DB::table('MASTER_ACCBAL')->insert($dataItmBal);
				}

		}

				

			}

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$series_Code)->where('COMP_CODE',$compcode)->get()->toArray();

			if(empty($checkvrnoExist)){
				$datavrnIn =array(
					'COMP_CODE'   =>$compcode,
					'TRAN_CODE'   =>$transcode,
					'SERIES_CODE' =>$series_Code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$userId,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);
			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$series_Code)->where('COMP_CODE',$compcode)->update($datavrn);
			}

		DB::commit();

			
			$response_array['response'] = 'success';
			if($donwloadStatus == 1){

				return $this->GeneratePdfForSale($userId,$compcode,$head_Id,$headtable,$bodytable,$taxtable,$columnheadid,$pdfPageName,$vrNoPname,$tcode);

			}else{}
		    $data = json_encode($response_array);
		    print_r($data);

		} catch (\Exception $e) {
		    DB::rollBack();
		    throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}

		} /* ./ AJAX */


	}

	public function SaleBillSaveMsg(Request $request,$saveData){
	 //	print_r($savedata);exit;
		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/transaction/sales/view-sales-transaction');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/transaction/sales/view-sales-transaction');

		}
	}

    public function ViewSalesTransaction(Request $request){

		$compName = $request->session()->get('company_name');
    
        if($request->ajax()) {
    
            $title ='View Sales';
    
            $userid    = $request->session()->get('userid');
    
            $userType = $request->session()->get('usertype');
    
            $compName = $request->session()->get('company_name');

            $compcode    = explode('-', $compName);

			$getcompcode =	$compcode[0];

    
            $fisYear =  $request->session()->get('macc_year');
    
    
            if($userType=='admin' || $userType=='Admin'){
    
            
            $data = DB::table('SBILL_HEAD')->where('FY_CODE', $fisYear)->where('COMP_CODE',$getcompcode)->orderBy('SBILLHID','DESC');
    
            }else if($userType=='superAdmin' || $userType=='user'){
    
            $data = DB::table('SBILL_HEAD')->where('FY_CODE', $fisYear)->where('COMP_CODE',$getcompcode)->orderBy('SBILLHID','DESC');
    
            }
            else{
    
                $data='';
                
            }
    
        	return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();
    
    
        }

        if(isset($compName)){
       		return view('admin.finance.transaction.sales.view_sale_tran');
        }else{
			return redirect('/useractivity');
		}
        
    }


    public function GetsoDetailsBySoVrno(Request $request){

		$response_array = array();

	    $so_vrno = $request->input('soVrno');
	    $splitso = explode(' ', $so_vrno);
	    //print_r($splitGrn);
	    $soyear = $splitso[0];
	    $soseries = $splitso[1];
	    $soVrno = $splitso[2];

		if ($request->ajax()) {

	    	//DB::enableQueryLog();
		$grnno_list = DB::table('SCHALLAN_HEAD')->where('VRNO',$soVrno)->where('SERIES_CODE',$soseries)->get();
    	 //dd(DB::getQueryLog());

	    	
    		if ($grnno_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $grnno_list ;

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

/*---- sale bill transaction ----*/

/* ------- start post good challan -------- */

	public function AddPostGoodIssue(Request $request)
    {

		$title       ='Post Good Issue / Challan';
		
		$CompanyCode = $request->session()->get('company_name');
		$splitcode   = explode('-', $CompanyCode);
		$compcode    =	$splitcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$tableData = MyConstruct();

		$userdata['acc_list']      = $tableData['master_party'];
		$userdata['taxcode_list']  = $tableData['master_tax'];
		$userdata['plant_list']    = $tableData['master_plant'];
		$userdata['item_list']     = $tableData['master_item'];
		$userdata['ratval_list']   = $tableData['master_rateValue'];
		$userdata['sale_rep_list'] = $tableData['sale_rep_code'];
		$userdata['cost_list']     = $tableData['master_cost'];
		$userdata['transp_list']   = $tableData['transp_code'];
		$transCode   = 'S4';

		$getCommonData = MyCommonFun($transCode,$compcode,$macc_year);

		$userdata['series_list'] = $getCommonData['getseries'];

		foreach ($getCommonData['getdate'] as $fydata) {

			$userdata['fromDate'] =  $fydata->FY_FROM_DATE;
			$userdata['toDate']   =  $fydata->FY_TO_DATE;
			
		}	

		$ordrVrno = DB::table('SCHALLAN_HEAD')->where('COMP_CODE',$compcode)->where('FY_CODE',$macc_year)->get();

		   	$vrseqnum = '';
			foreach ($ordrVrno as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;


		$transCode = DB::table('MASTER_TRANSACTION')->where('TRAN_CODE',$transCode)->get();

		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;


		if(isset($CompanyCode)){

		    return view('admin.finance.transaction.sales.post_good_issue',$userdata+compact('title'));

		}else{

				return redirect('/useractivity');
		}
       

    }

    public function SavePostGoddIssue(Request $request){

		$createdBy = $request->session()->get('userid');
		$compName  = $request->session()->get('company_name');
		$fisYear   =  $request->session()->get('macc_year');

		$donwloadStatus   = $request->input('donwloadStatus');
		$comp_nameval     = $request->session()->get('company_name');
		$explode          = explode('-', $comp_nameval);
		$getcom_code      = $explode[0];
		$trans_date       = $request->input('trans_date');
		$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
		$trans_code       = $request->input('trans_code');
		$series_code      = $request->input('series_code');
		$vr_no            = $request->input('vr_no');
		$plant_code       = $request->input('plant_code');
		$pfct_code        = $request->input('pfct_code');
		$accountCode      = $request->input('accountCode');
		$accountName      = $request->input('accountName');
		$tax_code         = $request->input('tax_code');
		$dueDateget       = $request->input('dueDateget');
		$dueDate          = date("Y-m-d", strtotime($dueDateget));
		$partyRefNo       = $request->input('party_ref_no');
		$partyRefDate     = $request->input('party_ref_date');
		$getpartyRefDate  = date("Y-m-d", strtotime($partyRefDate));
		$dueDays         = $request->input('gate_dueDays');
		$consineCode      = $request->input('consine_code');
		$rFHeadO          = $request->input('rfhead1');
		$rFHeadT          = $request->input('rfhead2');
		$rFHeadTh         = $request->input('rfhead3');
		$rFHeadF          = $request->input('rfhead4');
		$rFHeadFi         = $request->input('rfhead5');
		$itembyPo         = $request->input('itemsale');
		$item_code        = $request->input('item_code');
		$item_count       = $request->input('itemcodeC');
		$countItemCode    = count($item_count);
		$item_name        = $request->input('item_name');
		$remark           = $request->input('remark');
		$qty              = $request->input('qty');
		$unit_M           = $request->input('unit_M');
		$Aqty             = $request->input('Aqty');
		$add_unit_M       = $request->input('add_unit_M');
		$rate             = $request->input('rate');
		$basic_amt        = $request->input('basic_amt');
		$hsn_code         = $request->input('hsn_code');
		$tax_byitem       = $request->input('tax_byitem');
		$grandAmt_cr      = $request->input('TotalGrandAmt');
		$getdatacount     = $request->input('getdatacount');
		$head_tax_ind     = $request->input('head_tax_ind');
		$tax_ind_code     = $request->input('taxIndCode');
		$af_rate          = $request->input('af_rate');
		$amount           = $request->input('amount');
		$logicget         = $request->input('logicget');
		$staticget        = $request->input('staticget');
		$dr_grandAmt      = $request->input('crAmtPerItem');
		$data_Count       = $request->input('data_Count');
		$scseries         = $request->input('sc_series');
		$sctranscode      = $request->input('sc_trans');
		$scvrno           = $request->input('sc_vrno');
		$scslno           = $request->input('sc_slno');
		$scheadid         = $request->input('sc_head');
		$scbodyid         = $request->input('sc_body');
		$rate_ind         = $request->input('rate_ind');

		$quaP_count       = $request->input('quaP_count');
		$allquaPcount     = $request->input('allquaPcount');
		$item_code_que    = $request->input('item_code_que');
		$item_category    = $request->input('item_category');
		$iqua_char        = $request->input('iqua_char');
		$iqua_desc        = $request->input('iqua_desc');
		$char_fromvalue   = $request->input('char_fromvalue');
		$char_tovalue     = $request->input('char_tovalue');
		$tax_gl_code      = $request->input('taxGlCode');
		$seriesPostc      = $request->input('seriesPostc');
		$seriesGlC        = $request->input('seriesGlCode');
		$totStdRateAmt    = $request->input('totalStdRateAmt');
		$glByItem         = $request->input('glByItem');
		$std_rateitm      = $request->input('std_rateitm');
		$glNameByItem     = $request->input('glNameByItem');
		$getStock_Qty     = $request->input('stock_quantity');


		DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','SC')->delete();	

		$schalanH = DB::select("SELECT MAX(SCHALLANHID) as SCHALLANHID FROM SCHALLAN_HEAD");
		$headID = json_decode(json_encode($schalanH), true); 
	
		if(empty($headID[0]['SCHALLANHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['SCHALLANHID']+1;
		}

		if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('SCHALLAN_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}


		$headtable    = 'SCHALLAN_HEAD';
		$bodytable    = 'SCHALLAN_BODY';
		$taxtable     = 'SCHALLAN_TAX';
		$columnheadid ='SCHALLANHID';
		$pdfPageName  = 'SALES CHALLAN';
		$vrNoPname    = 'CHALLAN NO';
		$tcode        = $trans_code;

		DB::beginTransaction();

		try {

			$dataH = array(

				'SCHALLANHID'      =>$head_Id,
				'COMP_CODE'        =>$getcom_code,
				'FY_CODE'          =>$fisYear,
				'PFCT_CODE'        =>$pfct_code,
				'PFCT_NAME'        =>$request->input('pfct_name'),
				'TRAN_CODE'        =>$trans_code,
				'SERIES_CODE'      =>$series_code,
				'SERIES_NAME'      =>$request->input('series_name'),
				'VRNO'             =>$NewVrno,
				'VRDATE'           =>$tr_vr_date,
				'PLANT_CODE'       =>$plant_code,
				'PLANT_NAME'       =>$request->input('plant_name'),
				'DUEDATE'          =>$dueDate,
				'DUEDAYS'          =>$dueDays,
				'ACC_CODE'         =>$accountCode,
				'ACC_NAME'         =>$request->input('account_name'),
				'CPCODE'           =>$request->input('cp_codeGet'),
				'COST_CENTER'      =>$request->input('Cost_Center'),
				'COST_CENTER_NAME' =>$request->input('CostName'),
				'SR_CODE'          =>$request->input('Sale_Reps'),
				'SR_NAME'          =>$request->input('sale_reps_name'),
				'TAX_CODE'         =>$tax_code,
				'PREFNO'           =>$partyRefNo,
				'PREFDATE'         =>$getpartyRefDate,
				'RFHEAD1'          =>$rFHeadO,
				'RFHEAD2'          =>$rFHeadT,
				'RFHEAD3'          =>$rFHeadTh,
				'RFHEAD4'          =>$rFHeadF,
				'RFHEAD5'          =>$rFHeadFi,
				'TRPT_CODE'        =>$request->input('transpt_code'),
				'TRPT_NAME'        =>$request->input('transpt_name'),
				'VEHICAL_NO'       =>$request->input('vehical_no'),
				'LR_NO'            =>$request->input('lrNum'),
				'E_WAY_BILL_NO'    =>$request->input('eWayBilNo'),
				'DRAMT'            =>$grandAmt_cr,
				'ADV_RATE_I'       =>$request->input('adv_rate_i'),
				'ADV_RATE'         =>$request->input('adv_rate'),
				'ADV_AMT'          =>$request->input('adv_amt'),
				'CREATED_BY'       =>$createdBy,
			);

			$saveDataH = DB::table('SCHALLAN_HEAD')->insert($dataH);

			$discriptn_page = "Sale post goods issue trans insert done by user";
			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$accountCode);

			$seriesPost   = array(
	            'DR_AMT'      => $totStdRateAmt,
	            'IND_GL_CODE' => $seriesGlC,
	            'TCFLAG'      => 'SC',
	            'CREATED_BY'  => $createdBy,
	                  
	        );

        	DB::table('INDICATOR_TEMP')->insert($seriesPost);

			$bodyid_tax = array();
			$bodyid_qp  = array();

    		for ($i=0; $i < $countItemCode ; $i++) {

	    		$schalanB = DB::select("SELECT MAX(SCHALLANBID) as SCHALLANBID FROM SCHALLAN_BODY");
				$bodyID = json_decode(json_encode($schalanB), true); 
			
				if(empty($bodyID[0]['SCHALLANBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['SCHALLANBID']+1;
				}

	    		if($itembyPo[$i]){
					$itmcd = $itembyPo[$i];
				}else if($item_code[$i]){
					$itmcd =$item_code[$i];
				}

				$data_body = array(
			
					'SCHALLANHID' =>$head_Id,
					'SCHALLANBID' =>$body_Id,
					'COMP_CODE'   =>$getcom_code,
					'FY_CODE'     =>$fisYear,
					'PFCT_CODE'   =>$pfct_code,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'VRNO'        =>$NewVrno,
					'SLNO'        =>$i+1,
					'VRDATE'      =>$tr_vr_date,
					'PLANT_CODE'  =>$plant_code,
					'SORDERHID'   =>$scheadid[$i],
					'SORDERBID'   =>$scbodyid[$i],
					'ITEM_CODE'   =>$itmcd,
					'ITEM_NAME'   =>$item_name[$i],
					'PARTICULAR'  =>$remark[$i],
					'HSN_CODE'    =>$hsn_code[$i],
					'QTYISSUED'   =>$qty[$i],
					'UM'          =>$unit_M[$i],
					'AQTYISSUED'  =>$Aqty[$i],
					'AUM'         =>$add_unit_M[$i],
					'RATE'        =>$rate[$i],
					'BASICAMT'    =>$basic_amt[$i],
					'TAX_CODE'    =>$tax_byitem[$i],
					'DRAMT'       =>$dr_grandAmt[$i],
					'CREATED_BY'  =>$createdBy,
				);

				$saveDataB = DB::table('SCHALLAN_BODY')->insert($data_body);

				if($scheadid[$i] && $scbodyid[$i]&& $itmcd){
			
					$getQtyIsue = DB::table('SORDER_BODY')->where(['SORDERHID'=>$scheadid[$i],'SORDERBID'=>$scbodyid[$i],'ITEM_CODE'=>$itmcd])->get()->first();

					$getqtyIsued = $getQtyIsue->QTYISSUED;

					$data_qtyIsd = array(
						'QTYISSUED' =>$getqtyIsued+$qty[$i],
					);

					$getQtyIsue =  DB::table('SORDER_BODY')->where(['SORDERHID'=>$scheadid[$i],'SORDERBID'=>$scbodyid[$i],'ITEM_CODE'=>$itmcd])->update($data_qtyIsd);

					$getQtyisEq = DB::table('SORDER_BODY')->where(['SORDERHID'=>$scheadid[$i],'SORDERBID'=>$scbodyid[$i],'ITEM_CODE'=>$itmcd])->get()->first();

					if($getQtyisEq->ORDERQTY == $getQtyisEq->QTYISSUED){

						$data_QUO= array(
				
							'SCHALLANHID' =>$head_Id,
							'SCHALLANBID' =>$body_Id,
						);
						 DB::table('SORDER_BODY')->where(['SORDERHID'=>$scheadid[$i],'SORDERBID'=>$scbodyid[$i],'ITEM_CODE'=>$itmcd])->update($data_QUO);
					}

				}

				if($getStock_Qty[$i] !=''){

					$prestockGet = DB::table('MASTER_ITEMBAL')->where('FY_CODE',$fisYear)->where('PLANT_CODE',$plant_code)->where('COMP_CODE',$getcom_code)->where('ITEM_CODE',$itmcd)->get()->first();

					$getqtyIsued = $prestockGet->YRQTYISSUED;

					$data_UpqtyIsd = array(
						'YRQTYISSUED' =>$getqtyIsued+$qty[$i],
					);

					DB::table('MASTER_ITEMBAL')->where(['FY_CODE'=>$fisYear,'PLANT_CODE'=>$plant_code,'COMP_CODE'=>$getcom_code,'ITEM_CODE'=>$itmcd])->update($data_UpqtyIsd);
				}



				$legdH = DB::select("SELECT MAX(ITEM_LEDGER_ID) as ITEM_LEDGER_ID FROM ITEM_LEDGER");
				$legdID = json_decode(json_encode($legdH), true); 
			
				if(empty($legdID[0]['ITEM_LEDGER_ID'])){
					$legd_Id = 1;
				}else{
					$legd_Id = $legdID[0]['ITEM_LEDGER_ID']+1;
				}

				$item_led = array(	
					'ITEM_LEDGER_ID' =>$legd_Id,
					'COMP_CODE'      =>$getcom_code,
					'FY_CODE'        =>$fisYear,
					'VRDATE'         =>$tr_vr_date,
					'VRNO'           =>$NewVrno,
					'SLNO'           =>$i+1,
					'TRAN_CODE'      =>$trans_code,
					'SERIES_CODE'    =>$series_code,
					'PFCT_CODE'      =>$pfct_code,
					'ITEM_CODE'      =>$itmcd,
					'ITEM_NAME'      =>$item_name[$i],
					'UM_CODE'        =>$unit_M[$i],
					'PARTICULAR'     =>$remark[$i],
					'QTYISSUED'      =>$qty[$i],
					'RATE'           =>$rate[$i],
					'BASIC'          =>$basic_amt[$i],
					'AQTYRECD'       =>$Aqty[$i],
					'CREATED_BY'     =>$createdBy,
		    	);

				$saveIemLdg = DB::table('ITEM_LEDGER')->insert($item_led);

				$checkEmptyInldg = DB::table('INDICATOR_TEMP')->where('TCFLAG','SC')->where('CREATED_BY',$createdBy)->where('IND_GL_CODE',$glByItem[$i])->get()->toArray();

				if(empty($checkEmptyInldg)){

					$itmD   = array(
			            'CR_AMT'      => $std_rateitm[$i],
			            'IND_GL_CODE' => $glByItem[$i],
			            'TCFLAG'      => 'SC',
			            'CREATED_BY'  => $createdBy,
			                  
		            );

	            	DB::table('INDICATOR_TEMP')->insert($itmD);
				}else{
					$getglAl = DB::table('INDICATOR_TEMP')->where('TCFLAG','SC')->where('CREATED_BY',$createdBy)->where('IND_GL_CODE',$glByItem[$i])->get()->toArray();

					$addAmt = $getglAl[0]->CR_AMT + $std_rateitm[$i];

	          		$itmDUp   = array(
	          			'CR_AMT'      => $addAmt,
	              	);

	              	DB::table('INDICATOR_TEMP')->where('TCFLAG','SC')->where('CREATED_BY',$createdBy)->where('IND_GL_CODE',$glByItem[$i])->update($itmDUp);
				}
			
				if($data_Count[$i] == 0){

				}else{

					for ($q=0; $q < $data_Count[$i]; $q++) { 

						$a = array_fill(1, $data_Count[$i], $body_Id);
						$str = implode(',',$a); 
						$last_id = explode(',',$str);

						$bodyid_tax[]= $last_id[0];

					}

				}
			
				if($quaP_count[$i] == 0){

				}else{

					for ($u=0; $u < $quaP_count[$i]; $u++) { 

						$qp = array_fill(1, $quaP_count[$i], $body_Id);
						$strqp = implode(',',$qp); 
						$last_idqp = explode(',',$strqp);

						$bodyid_qp[]= $last_idqp[0];

					}

				}
			
    		} /* ./ BODY FOR LOOP*/

	    	$getstoreIsuD = DB::table('INDICATOR_TEMP')
					->select('INDICATOR_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')
	           		->leftjoin('MASTER_GL', 'INDICATOR_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
	            	->where('INDICATOR_TEMP.TCFLAG','SC')
	            	->where('INDICATOR_TEMP.CREATED_BY',$createdBy)
	            	->get()->toArray();
        	$storeICount = count($getstoreIsuD);

			for($q=0;$q<$storeICount;$q++){

				$glledgT = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
				$glledgID = json_decode(json_encode($glledgT), true); 
						
				if(empty($glledgID[0]['GLTRANID'])){
					$gl_ledg_Id = 1;
				}else{
					$gl_ledg_Id = $glledgID[0]['GLTRANID']+1;
				}

				$srnol = $q+1;
				$ledgData = array(
					'GLTRANID'    => $gl_ledg_Id,
					'COMP_CODE'   => $getcom_code,
					'FY_CODE'     => $fisYear,
					'TRAN_CODE'   => $trans_code,
					'SERIES_CODE' => $series_code,
					'VRNO'        => $NewVrno,
					'SLNO'        => $srnol,
					'VRDATE'      => $tr_vr_date,
					'GL_CODE'     => $getstoreIsuD[$q]->IND_GL_CODE,
					'GL_NAME'     => $getstoreIsuD[$q]->GL_NAME,
					'DRAMT'       => $getstoreIsuD[$q]->DR_AMT,
					'CRAMT'       => $getstoreIsuD[$q]->CR_AMT,
					'CREATED_BY'  => $getstoreIsuD[$q]->CREATED_BY,
				);

				DB::table('GL_TRAN')->insert($ledgData);

				$drAmt = $getstoreIsuD[$q]->DR_AMT;
				$crAmt = $getstoreIsuD[$q]->CR_AMT;
				$glcode = $getstoreIsuD[$q]->IND_GL_CODE;

				if(($drAmt == '') || ($drAmt == null)){
						$drAmntVal = 0.00;
					}else{
						$drAmntVal = $drAmt;
					}

					if(($crAmt == '') || ($crAmt == null)){
						$creAmntVal = 0.00;
					}else{
						$creAmntVal = $crAmt;
					}
		
		$getdata = DB::table('MASTER_GLBAL')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('GL_CODE', $glcode)->get()->first();

				if($getdata){

					$RDRAMT = $getdata->RDRAMT;
				    $RCRAMT = $getdata->RCRAMT;
				    $YROPDR = $getdata->YROPDR;
				    $YROPCR = $getdata->YROPCR;

				    $debitAmt =  $drAmntVal + $RDRAMT;

				    $creditAmt =  $creAmntVal + $RCRAMT;

				    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);
				  

				  //  print_r($RBAL);exit;

		            $dataarqty = array(
		            	
						'RDRAMT'  => $debitAmt,
						'RCRAMT'  => $creditAmt,
						'RBAL'    => $RBAL,
				
		            );

                 $updateData12 = DB::table('MASTER_GLBAL')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('GL_CODE', $glcode)->update($dataarqty);

				}else{

					$dataItmBal = array(
						'COMP_CODE' => $getcom_code,
						'FY_CODE'   => $fisYear,
						'PFCT_CODE' => $pfct_code,
						'GL_CODE'   => $glcode,
						'RDRAMT'    => $drAmntVal,
						'RCRAMT'    => $creAmntVal,
					);

					DB::table('MASTER_GLBAL')->insert($dataItmBal);
				}

			}

    		for ($j=0; $j < $getdatacount; $j++) { 

	    		$schalanT = DB::select("SELECT MAX(SCHALLANTID) as SCHALLANTID FROM SCHALLAN_TAX");
				$taxID = json_decode(json_encode($schalanT), true); 
			
				if(empty($taxID[0]['SCHALLANTID'])){
					$tax_Id = 1;
				}else{
					$tax_Id = $taxID[0]['SCHALLANTID']+1;
				}

				if(($amount[$j] == '') || ($amount[$j] == null)){
					$taxAmount = 0.00;
				}else{
					$taxAmount = $amount[$j];
				}

				$data_tax = array(
					'SCHALLANHID' => $head_Id,
					'SCHALLANBID' => $bodyid_tax[$j],
					'SCHALLANTID' => $tax_Id,
					'TAXIND_CODE' => $tax_ind_code[$j],
					'TAXIND_NAME' => $head_tax_ind[$j],
					'RATE_INDEX'  => $rate_ind[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $taxAmount,
					'TAX_LOGIC'   => $logicget[$j],
					'TAXGL_CODE'  => $tax_gl_code[$j],
					'STATIC_IND'  => $staticget[$j],
					'CREATED_BY'  => $createdBy,
				);
			
				$saveDataT = DB::table('SCHALLAN_TAX')->insert($data_tax);
		
			} /*-- for loop close --*/

			for ($p=0; $p < $allquaPcount; $p++) { 

				$schalanqpT = DB::select("SELECT MAX(SCHALLANQID) as SCHALLANQID FROM SCHALLAN_QUA");
				$qpID = json_decode(json_encode($schalanqpT), true); 
			
				if(empty($qpID[0]['SCHALLANQID'])){
					$qp_Id = 1;
				}else{
					$qp_Id = $qpID[0]['SCHALLANQID']+1;
				}

				$data_quaP = array(
					'SCHALLANHID'    => $head_Id,
					'SCHALLANBID'    => $bodyid_qp[$p],
					'SCHALLANQID'    => $qp_Id,
					'COMP_CODE'      => $getcom_code,
					'FY_CODE'        => $fisYear,
					'PFCT_CODE'      => $pfct_code,
					'TRAN_CODE'      => $trans_code,
					'SERIES_CODE'    => $series_code,
					'VRNO'           => $NewVrno,
					'SLNO'           => $p+1,
					'VRDATE'         => $tr_vr_date,
					'PLANT_CODE'     => $plant_code,
					'ITEM_CODE'      => $item_code_que[$p],
					'ICATG_CODE'     => $item_category[$p],
					'IQUA_CHAR'      => $iqua_char[$p],
					'IQUA_UM'        => '',
					'CHAR_FROMVALUE' => $char_fromvalue[$p],
					'CHAR_TOVALUE'   => $char_tovalue[$p],
					'CREATED_BY'     => $createdBy,
				);
				
				$saveDataQ = DB::table('SCHALLAN_QUA')->insert($data_quaP);
			
			} /*-- for loop close --*/

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->get()->toArray();

			if(empty($checkvrnoExist)){
				$datavrnIn =array(
					'COMP_CODE'   =>$getcom_code,
					'FY_CODE'     =>$fisYear,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'FROM_NO'     =>1,
					'TO_NO'       =>99999,
					'LAST_NO'     =>$NewVrno,
					'CREATED_BY'  =>$createdBy,
				);

				DB::table('MASTER_VRSEQ')->insert($datavrnIn);
			}else{
				$datavrn =array(
					'LAST_NO'=>$NewVrno
				);
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->update($datavrn);
			}

			DB::commit();
			if($donwloadStatus == 1){

				return $this->GeneratePdfForSale($createdBy,$getcom_code,$head_Id,$headtable,$bodytable,$taxtable,$columnheadid,$pdfPageName,$vrNoPname,$tcode);

			}else{}
			$response_array['response'] = 'success';
		    $data = json_encode($response_array);
		    print_r($data);

		} catch (\Exception $e) {
		    DB::rollBack();
		    //throw $e;
		    $response_array['response'] = 'error';
	        $data = json_encode($response_array);
	        print_r($data);
		}

    } /* . /MAIN FUNCTION*/

    public function PostGoodIssueSaveMsg(Request $request,$saveData){
	 //	print_r($savedata);exit;
		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Post Good Issue Can Not Added...!');
			return redirect('/Transaction/Sales/View-Post-Good-Issue-Trans');			

		} else {

			$request->session()->flash('alert-success', 'Post Good Issue Was Successfully Added...!');
			return redirect('/Transaction/Sales/View-Post-Good-Issue-Trans');
		}
	}

    public function ViewPostGoddIssue(Request $request){

     $compName = $request->session()->get('company_name');

        if($request->ajax()) {
    
            $title ='View Post Good Issue';
    
            $userid    = $request->session()->get('userid');
    
            $userType = $request->session()->get('usertype');
    
            $compName = $request->session()->get('company_name');
            $splitCmp = explode('-',$compName);
    		$compCode = $splitCmp[0];
            $fisYear =  $request->session()->get('macc_year');
    
    
            if($userType=='admin' || $userType=='Admin'){

           // DB::enableQueryLog();
    
           // $data = DB::table('SCHALLAN_HEAD')->where('FY_CODE', $fisYear)->orderBy('SCHALLANHID','DESC');

            $data =DB::select("SELECT SCHALLAN_HEAD.*,SCHALLAN_BODY.SCHALLANHID as salehid,SCHALLAN_BODY.SCHALLANBID,SCHALLAN_BODY.SBILLHID,SCHALLAN_BODY.SBILLBID,group_concat(concat(SCHALLAN_BODY.SBILLHID))AS SBILTATUSHD,group_concat(concat(SCHALLAN_BODY.SBILLBID))AS SBILSTATUSBD FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_BODY.SCHALLANHID = SCHALLAN_HEAD.SCHALLANHID WHERE SCHALLAN_HEAD.FY_CODE='$fisYear' AND SCHALLAN_HEAD.COMP_CODE='$compCode' GROUP BY SCHALLAN_HEAD.SCHALLANHID");

            

           // dd(DB::getQueryLog());
    
            }else if($userType=='superAdmin' || $userType=='user'){
    
               // $data = DB::table('SCHALLAN_HEAD')->where('FY_CODE', $fisYear)->orderBy('SCHALLANHID','DESC');

            	$data =DB::select("SELECT SCHALLAN_HEAD.*,SCHALLAN_BODY.SCHALLANHID as salehid,SCHALLAN_BODY.SCHALLANBID,SCHALLAN_BODY.SBILLHID,SCHALLAN_BODY.SBILLBID,group_concat(concat(SCHALLAN_BODY.SBILLHID))AS SBILTATUSHD,group_concat(concat(SCHALLAN_BODY.SBILLBID))AS SBILSTATUSBD FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_BODY.SCHALLANHID = SCHALLAN_HEAD.SCHALLANHID WHERE SCHALLAN_HEAD.FY_CODE='$fisYear' AND SCHALLAN_HEAD.COMP_CODE='$compCode' GROUP BY SCHALLAN_HEAD.SCHALLANHID");
    
            }
            else{
    
                $data='';
                
            }
    
        return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();
    
    
        }

        if(isset($compName)){

      	 	return view('admin.finance.transaction.sales.view_post_good_issue');
        }else{
			return redirect('/useractivity');
		}
        
    }

    public function ViewPostGoodIssueChildRow(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$vrno   = $request->input('vrno');
		    $headid = $request->input('tblid');

	    
	    	$grndata = DB::table('SCHALLAN_BODY')->where('VRNO',$vrno)->where('SCHALLANHID',$headid)->get();

    		if ($grndata) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $grndata;

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

    public function DeletePostGoodsIssue(Request $request){

        $head_id = $request->input('headID');
        //print_r($id);exit;
        if ($head_id!='') {

			$DeleteHead = DB::table('SCHALLAN_HEAD')->where('SCHALLANHID',$head_id)->delete();
			$DeleteBody = DB::table('SCHALLAN_BODY')->where('SCHALLANHID',$head_id)->delete();
			$DeleteTax  = DB::table('SCHALLAN_TAX')->where('SCHALLANHID',$head_id)->delete();
			$DeleteQua  = DB::table('SCHALLAN_QUA')->where('SCHALLANHID',$head_id)->delete();

			if ($DeleteHead && $DeleteBody && $DeleteTax) {

				$request->session()->flash('alert-success', 'Post Good Issues Data Was Deleted Successfully...!');
				return redirect('/Transaction/Sales/View-Post-Good-Issue-Trans');

			} else {

				$request->session()->flash('alert-error', 'Post Good Issues Data Can Not Deleted...!');
				return redirect('/Transaction/Sales/View-Post-Good-Issue-Trans');

			}
		
		}else{

			$request->session()->flash('alert-error', 'Post Good Issues Data Not Found...!');
			return redirect('/Transaction/Sales/View-Post-Good-Issue-Trans');

		}
	}

/* ------- end post good challan -------- */

/* ----- sale quotation reverse js ------- */

	public function GetDataByQuoationNo(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$revQuo    = $request->input('revQuo');
            //print_r($slno);exit;
            $fetch_reocrd = DB::table('SQTN_HEAD')->get();

            if ($fetch_reocrd!='') {

				$response_array['response']    = 'success';
				$response_array['data']        = $fetch_reocrd;
				//$response_array['levelAmt']    = $levelAmt;

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

    public function GetItmFrmSaleQuotatn(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$quoNo    = $request->input('quoNo');
           
        	//DB::enableQueryLog();
        	 /*$fetch_reocrd = DB::SELECT("SELECT t1.*,t2.* FROM sale_quotation_bodies t2 LEFT JOIN sale_quotation_heads t1 ON t1.id = t2.sale_quotation_head_id WHERE t1.vr_no='$quoNo'");*/
        	$fetch_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM SQTN_BODY t2 LEFT JOIN MASTER_ITEMUM t3 ON t3.ITEM_CODE=t2.ITEM_CODE LEFT JOIN SQTN_HEAD t1 ON t1.SQTNHID = t2.SQTNHID WHERE t1.VRNO='$quoNo'");
        	// dd(DB::getQueryLog());


            if ($fetch_reocrd!='') {

				$response_array['response']    = 'success';
				$response_array['data']        = $fetch_reocrd;
				//$response_array['levelAmt']    = $levelAmt;

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


/* ----- sale quotation reverse js ------- */

/*------- sale ajax common function function  ------- */

	public function checkStateN_GetPrevTransData(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$trans_code      = $request->input('trans_code');
			$account_code    = $request->input('account_code');
			$transDate       = $request->input('transDate');
			$plstateCode     = $request->input('plstateCode');
			
			$vr_date         = date("Y-m-d", strtotime($transDate));
			$fisYear         =  $request->session()->get('macc_year');
			$expldeYr        = explode('-', $fisYear);
			$startDate       = $expldeYr[0].'-04-01';
			
			$comp_nameval    = $request->session()->get('company_name');
			$explode         = explode('-', $comp_nameval);
			$getcom_code     = $explode[0];
			
			$saleOrderdata   = '';
			$dataOpngAmt     = '';
			$enquiry_no_list = '';

			//DB::enableQueryLog();
				
            	//dd(DB::getQueryLog());

			if($trans_code == 'S1'){

				$saleQuodata = DB::SELECT("SELECT t1.*,t2.* FROM SQTN_HEAD t1 LEFT JOIN SQTN_BODY t2 ON t2.SQTNHID = t1.SQTNHID WHERE t1.ACC_CODE='$account_code' AND t1.VRDATE BETWEEN '$startDate' AND '$vr_date' AND t2.SCNTRHID='0' AND t2.SCNTRBID='0' GROUP BY t2.SQTNHID");

				//
            	//$enquiry_no_list = DB::select("SELECT SENQ_HEAD.VRNO,SENQ_HEAD.SERIES_CODE,SENQ_HEAD.FY_CODE FROM SENQ_HEAD WHERE SENQ_HEAD.ACC_CODE='$account_code' AND SENQ_HEAD.COMP_CODE='$getcom_code' AND SENQ_HEAD.FY_CODE='$fisYear' AND (SENQ_HEAD.VRDATE BETWEEN '$startDate' AND '$vr_date') UNION SELECT CRM_ENQ_HEAD.VRNO,CRM_ENQ_HEAD.SERIES_CODE,'' as FY_CODE FROM CRM_ENQ_HEAD WHERE CRM_ENQ_HEAD.ACC_CODE='$account_code'");
				
            	$enquiry_no_list = DB::SELECT("SELECT t1.*,t2.* FROM SENQ_HEAD t1 LEFT JOIN SENQ_BODY t2 ON t2.SENQHID = t1.SENQHID WHERE t1.ACC_CODE='$account_code' AND t1.VRDATE BETWEEN '$startDate' AND '$vr_date' AND t2.SQTNHID IS NULL AND t2.SQTNBID IS NULL GROUP BY t2.SENQHID");
            	//dd(DB::getQueryLog());

			}else if($trans_code == 'S2'){

				$saleQuodata = DB::SELECT("SELECT t1.*,t2.* FROM SQTN_HEAD t1 LEFT JOIN SQTN_BODY t2 ON t2.SQTNHID = t1.SQTNHID WHERE t1.ACC_CODE='$account_code' AND t1.VRDATE BETWEEN '$startDate' AND '$vr_date' AND t2.SCNTRHID='0' AND t2.SCNTRBID='0' GROUP BY t2.SQTNHID");


			}else if($trans_code == 'S3'){

				$saleQuodata = DB::SELECT("SELECT t1.*,t2.* FROM SCNTR_HEAD t1 LEFT JOIN SCNTR_BODY t2 ON t2.SCNTRHID = t1.SCNTRHID WHERE t1.ACC_CODE='$account_code' AND t1.VRDATE BETWEEN '$startDate' AND '$vr_date' AND t2.SORDERHID='0' AND t2.SORDERBID='0' GROUP BY t2.SCNTRHID");
			}else if($trans_code == 'S5'){
				//DB::enableQueryLog();
				$saleQuodata =DB::select("SELECT t1.*,t2.* FROM SCHALLAN_HEAD t1 LEFT JOIN SCHALLAN_BODY t2 ON t2.SCHALLANHID = t1.SCHALLANHID WHERE t1.ACC_CODE='$account_code' AND t2.SBILLHID='0' AND t2.SBILLBID='0' GROUP BY t2.SCHALLANHID");

				$saleOrderdata =DB::select("SELECT t1.*,t2.* FROM SORDER_HEAD t1 LEFT JOIN SORDER_BODY t2 ON t2.SORDERHID = t1.SORDERHID WHERE t1.ACC_CODE='$account_code' AND t2.SCHALLANHID='0' AND t2.SCHALLANBID='0' GROUP BY t2.SORDERHID");

			/* get closing amt*/

					$strwhere='';
					if(isset($account_code)  && trim($account_code)!="")
	                {
	                 		$strwhere .= "AND ACC_CODE='$account_code'";
	                }

	                $from_date1 = $startDate;
	                $to_date1 = $vr_date;

	                $bgdate     = $request->session()->get('yrbgdate');
	                $yrbgdate = date("Y-m-d", strtotime($bgdate));

					$dataOpngAmt= DB::select("SELECT t.VRDATE,t.VRNO,format(t.drAmt,2,'en_IN') as DrAmt, format(t.cramt,2,'en_IN') as CrAmt, if(t.drAmt>0,format(@running_total:=@running_total + t.drAmt,2,'en_IN'),format(@running_total:=@running_total - t.cramt,2,'en_IN')) AS balence,if(t.dramt>t.cramt,'Dr','Cr') as BalType, t.particular as particular,t.instrument_type as instrument_type,t.instrument_no as instrument_no,t.fy_code as fy_code,t.series_code as series_code,t.REF_CODE,t.REF_NAME,t.acc_code as acc_code FROM 
					(
					SELECT '$from_date1' AS vrdate,'Op-Bal' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as fy_code,'' as series_code, if(if(b.dramt>0,b.dramt,0) - if(b.cramt>0,b.cramt,0) >0,b.dramt- if(b.cramt>0,b.cramt,0),0) as dramt, if(if(b.cramt>0,b.cramt,0) - if(b.dramt>0,b.dramt,0) >0,b.cramt- if(b.dramt>0,b.dramt,0),0) as CrAmt,'' as REF_CODE,'' as REF_NAME FROM    
					(
					SELECT '$from_date1' AS vrdate,'Op-Bal' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as fy_code,'' as series_code, sum(a.dramt) as drAmt, sum(a.cramt) as  CrAmt,'' as REF_CODE,'' as REF_NAME FROM 
					((    
					#Bring year opening balance
					SELECT '$from_date1' AS vrdate,'Opening' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as fy_code,'' as series_code, yropdr as dramt,yropcr as CrAmt,'' as REF_CODE,'' as REF_NAME FROM MASTER_ACCBAL WHERE  FY_CODE='$fisYear' AND acc_code='$account_code')
					UNION
					#Bring transactions during year opening and before from date
					SELECT '$from_date1' as vrdate, 'Before Date'  as vrno,'' as BalType,particular as particular,'' as instrument_type,'' as instrument_no,acc_code as acc_code,fy_code as fy_code,series_code as series_code,sum(dramt) as drAmt, sum(cramt) as cramt,'' as REF_CODE,'' as REF_NAME FROM ACC_TRAN WHERE 1=1 $strwhere AND vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY) ) a) b
					UNION    
					SELECT date(VRDATE) as vrdate,VRNO as vrno,'' as BalType,particular as particular,'' as instrument_type,'' as instrument_no,acc_code as acc_code,fy_code as fy_code,series_code as series_code, dramt as drAmt,cramt as cramt,REF_CODE as REF_CODE,REF_NAME as REF_NAME FROM ACC_TRAN where 1=1 $strwhere AND VRDATE BETWEEN '$from_date1' AND '$to_date1'  ORDER BY vrdate
					)t JOIN (SELECT @running_total:=0) r");

			/* get closing amt*/

				//dd(DB::getQueryLog());
			}else if($trans_code == 'S4'){
				//DB::enableQueryLog();
				$saleQuodata =DB::select("SELECT t1.*,t2.* FROM SORDER_HEAD t1 LEFT JOIN SORDER_BODY t2 ON t2.SORDERHID = t1.SORDERHID WHERE t1.ACC_CODE='$account_code' AND t2.SCHALLANHID='0' AND t2.SCHALLANBID='0' GROUP BY t2.SORDERHID");
				//dd(DB::getQueryLog());
				
			}else{
				$saleQuodata ='';
			}
		    
            if($account_code){

            	/* query befor*/	
            		/*$getAccAddre = DB::table('MASTER_ACC')
				->select('MASTER_ACC.*', 'MASTER_ACCADD.*')
           		->leftjoin('MASTER_ACCADD', 'MASTER_ACCADD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->where('MASTER_ACC.ACC_CODE',$account_code)
           		->get();*/
            	/* query befor*/	

            	/*query after*/

	            $getAccAddre = DB::select("SELECT a1.*,a2.ACC_CODE AS accCode,a2.ACC_NAME AS accName,a2.ATYPE_CODE AS ATYPE_CODE,a2.CREADIT_LIMIT AS CREADIT_LIMIT,a2.GP_DAYS AS GP_DAYS FROM MASTER_ACCADD a1 LEFT JOIN MASTER_ACC a2 ON a2.ACC_CODE=a1.ACC_CODE ORDER BY a1.ACC_CODE='$account_code' DESC");

           		/*query after*/

           		$fetch_glCode = DB::table('MASTER_GLKEY')
				->select('MASTER_GLKEY.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')
           		->leftjoin('MASTER_GL', 'MASTER_GLKEY.GL_CODE', '=', 'MASTER_GL.GL_CODE')
            	->where('MASTER_GLKEY.ATYPE_CODE',$getAccAddre[0]->ATYPE_CODE)
            	->get()->first();

				$creditLimit = $getAccAddre[0]->CREADIT_LIMIT;

				$item_list = DB::table('MASTER_ITEM')->get();

        	}else{
        		$getAccAddre ='';
        	}

    		if ($saleQuodata || $getAccAddre) {

				$response_array['response']            = 'success';
				$response_array['creditLimit']         = $creditLimit;
				$response_array['sale_quotation_data'] = $saleQuodata;
				$response_array['sale_order_data']     = $saleOrderdata;
				$response_array['acc_GlData']          = $fetch_glCode;
				$response_array['data_opngAmt']        = $dataOpngAmt;
				$response_array['dataAccAddr']         = $getAccAddre;
				$response_array['enq_data']            = $enquiry_no_list;
				$response_array['itemList']            = $item_list;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['dataTax'] = '';
                $response_array['sale_quotation_data'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['dataTax'] = '';
                $response_array['sale_quotation_data'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function getTaxCodeByState(Request $request){

    	$response_array = array();

		if ($request->ajax()) {

			$account_code    = $request->input('account_code');
			$shipAddr        = $request->input('addId');
			$plstateCode     = $request->input('plstateCode');
		
    		if($account_code && $shipAddr){

	    		$getStateCode = DB::table('MASTER_ACCADD')->where('CPCODE',$shipAddr)->get()->first();

	       		$stateOfAcc = $getStateCode->STATE_CODE;

	       		if($plstateCode == $stateOfAcc){
	       			$gettaxCode = DB::table('MASTER_TAX')->where('TAX_TYPE','SCGST')->get();
	       		}else if($plstateCode != $stateOfAcc){
	       			$gettaxCode = DB::table('MASTER_TAX')->where('TAX_TYPE','IGST')->get();
	       		}else if($countryC != $stateconty->COUNTRY){
	       			$gettaxCode = DB::table('MASTER_TAX')->where('TAX_TYPE','EXPORT')->get();	
	       		}else{
	       			$gettaxCode='';
	       		}

	    	}else{
	    		$getStateCode='';
	       		$gettaxCode='';
	    	}

	    	if ($gettaxCode) {

				$response_array['response']            = 'success';
				$response_array['get_taxCode']         = $gettaxCode;
				$response_array['getStateCode']        = $getStateCode;

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['dataTax'] = '';
                $response_array['sale_quotation_data'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

		}else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['dataTax'] = '';
                $response_array['sale_quotation_data'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

		

    }

	public function checkStateN_GetPrevTransData_old(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$trans_code      = $request->input('trans_code');
			$account_code    = $request->input('account_code');
			$transDate       = $request->input('transDate');
			$stateC          = $request->input('stateCode');
			$shipAddr        = $request->input('addId');
			$plstateCode     = $request->input('plstateCode');
			
			$vr_date         = date("Y-m-d", strtotime($transDate));
			$fisYear         =  $request->session()->get('macc_year');
			$expldeYr        = explode('-', $fisYear);
			$startDate       = $expldeYr[0].'-04-01';
			
			$comp_nameval    = $request->session()->get('company_name');
			$explode         = explode('-', $comp_nameval);
			$getcom_code     = $explode[0];
			
			$saleOrderdata   = '';
			$dataOpngAmt     = '';
			$enquiry_no_list = '';

			//DB::enableQueryLog();
				
            	//dd(DB::getQueryLog());

			if($trans_code == 'S1'){

				$saleQuodata = DB::SELECT("SELECT t1.*,t2.* FROM SQTN_HEAD t1 LEFT JOIN SQTN_BODY t2 ON t2.SQTNHID = t1.SQTNHID WHERE t1.ACC_CODE='$account_code' AND t1.VRDATE BETWEEN '$startDate' AND '$vr_date' AND t2.SCNTRHID='0' AND t2.SCNTRBID='0' GROUP BY t2.SQTNHID");

				//DB::enableQueryLog();
            	$enquiry_no_list = DB::select("SELECT SENQ_HEAD.VRNO,SENQ_HEAD.SERIES_CODE,SENQ_HEAD.FY_CODE FROM SENQ_HEAD WHERE SENQ_HEAD.ACC_CODE='$account_code' AND SENQ_HEAD.COMP_CODE='$getcom_code' AND SENQ_HEAD.FY_CODE='$fisYear' AND (SENQ_HEAD.VRDATE BETWEEN '$startDate' AND '$vr_date') UNION SELECT CRM_ENQ_HEAD.VRNO,CRM_ENQ_HEAD.SERIES_CODE,'' as FY_CODE FROM CRM_ENQ_HEAD WHERE CRM_ENQ_HEAD.ACC_CODE='$account_code'");
            	//dd(DB::getQueryLog());

			}else if($trans_code == 'S2'){

				$saleQuodata = DB::SELECT("SELECT t1.*,t2.* FROM SQTN_HEAD t1 LEFT JOIN SQTN_BODY t2 ON t2.SQTNHID = t1.SQTNHID WHERE t1.ACC_CODE='$account_code' AND t1.VRDATE BETWEEN '$startDate' AND '$vr_date' AND t2.SCNTRHID='0' AND t2.SCNTRBID='0' GROUP BY t2.SQTNHID");


			}else if($trans_code == 'S3'){

				$saleQuodata = DB::SELECT("SELECT t1.*,t2.* FROM SCNTR_HEAD t1 LEFT JOIN SCNTR_BODY t2 ON t2.SCNTRHID = t1.SCNTRHID WHERE t1.ACC_CODE='$account_code' AND t1.VRDATE BETWEEN '$startDate' AND '$vr_date' AND t2.SORDERHID='0' AND t2.SORDERBID='0' GROUP BY t2.SCNTRHID");
			}else if($trans_code == 'S5'){
				//DB::enableQueryLog();
				$saleQuodata =DB::select("SELECT t1.*,t2.* FROM SCHALLAN_HEAD t1 LEFT JOIN SCHALLAN_BODY t2 ON t2.SCHALLANHID = t1.SCHALLANHID WHERE t1.ACC_CODE='$account_code' AND t2.SBILLHID='0' AND t2.SBILLBID='0' GROUP BY t2.SCHALLANHID");

				$saleOrderdata =DB::select("SELECT t1.*,t2.* FROM SORDER_HEAD t1 LEFT JOIN SORDER_BODY t2 ON t2.SORDERHID = t1.SORDERHID WHERE t1.ACC_CODE='$account_code' AND t2.SCHALLANHID='0' AND t2.SCHALLANBID='0' GROUP BY t2.SORDERHID");

			/* get closing amt*/

					$strwhere='';
					if(isset($account_code)  && trim($account_code)!="")
	                {
	                 		$strwhere .= "AND ACC_CODE='$account_code'";
	                }

	                $from_date1 = $startDate;
	                $to_date1 = $vr_date;

	                $bgdate     = $request->session()->get('yrbgdate');
	                $yrbgdate = date("Y-m-d", strtotime($bgdate));

					$dataOpngAmt= DB::select("SELECT t.VRDATE,t.VRNO,format(t.drAmt,2,'en_IN') as DrAmt, format(t.cramt,2,'en_IN') as CrAmt, if(t.drAmt>0,format(@running_total:=@running_total + t.drAmt,2,'en_IN'),format(@running_total:=@running_total - t.cramt,2,'en_IN')) AS balence,if(t.dramt>t.cramt,'Dr','Cr') as BalType, t.particular as particular,t.instrument_type as instrument_type,t.instrument_no as instrument_no,t.fy_code as fy_code,t.series_code as series_code,t.REF_CODE,t.REF_NAME,t.acc_code as acc_code FROM 
					(
					SELECT '$from_date1' AS vrdate,'Op-Bal' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as fy_code,'' as series_code, if(if(b.dramt>0,b.dramt,0) - if(b.cramt>0,b.cramt,0) >0,b.dramt- if(b.cramt>0,b.cramt,0),0) as dramt, if(if(b.cramt>0,b.cramt,0) - if(b.dramt>0,b.dramt,0) >0,b.cramt- if(b.dramt>0,b.dramt,0),0) as CrAmt,'' as REF_CODE,'' as REF_NAME FROM    
					(
					SELECT '$from_date1' AS vrdate,'Op-Bal' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as fy_code,'' as series_code, sum(a.dramt) as drAmt, sum(a.cramt) as  CrAmt,'' as REF_CODE,'' as REF_NAME FROM 
					((    
					#Bring year opening balance
					SELECT '$from_date1' AS vrdate,'Opening' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as fy_code,'' as series_code, yropdr as dramt,yropcr as CrAmt,'' as REF_CODE,'' as REF_NAME FROM MASTER_ACCBAL WHERE  FY_CODE='$fisYear' AND acc_code='$account_code')
					UNION
					#Bring transactions during year opening and before from date
					SELECT '$from_date1' as vrdate, 'Before Date'  as vrno,'' as BalType,particular as particular,'' as instrument_type,'' as instrument_no,acc_code as acc_code,fy_code as fy_code,series_code as series_code,sum(dramt) as drAmt, sum(cramt) as cramt,'' as REF_CODE,'' as REF_NAME FROM ACC_TRAN WHERE 1=1 $strwhere AND vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY) ) a) b
					UNION    
					SELECT date(VRDATE) as vrdate,VRNO as vrno,'' as BalType,particular as particular,'' as instrument_type,'' as instrument_no,acc_code as acc_code,fy_code as fy_code,series_code as series_code, dramt as drAmt,cramt as cramt,REF_CODE as REF_CODE,REF_NAME as REF_NAME FROM ACC_TRAN where 1=1 $strwhere AND VRDATE BETWEEN '$from_date1' AND '$to_date1'  ORDER BY vrdate
					)t JOIN (SELECT @running_total:=0) r");

			/* get closing amt*/

				//dd(DB::getQueryLog());
			}else if($trans_code == 'S4'){
				//DB::enableQueryLog();
				$saleQuodata =DB::select("SELECT t1.*,t2.* FROM SORDER_HEAD t1 LEFT JOIN SORDER_BODY t2 ON t2.SORDERHID = t1.SORDERHID WHERE t1.ACC_CODE='$account_code' AND t2.SCHALLANHID='0' AND t2.SCHALLANBID='0' GROUP BY t2.SORDERHID");
				//dd(DB::getQueryLog());
				
			}else{
				$saleQuodata ='';
			}
		    
			$gettaxCode='';
            if($account_code){

	            $getAccAddre = DB::table('MASTER_ACC')
				->select('MASTER_ACC.*', 'MASTER_ACCADD.*')
           		->leftjoin('MASTER_ACCADD', 'MASTER_ACCADD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->where('MASTER_ACC.ACC_CODE',$account_code)
           		->get();

           		$fetch_glCode = DB::table('MASTER_GLKEY')
				->select('MASTER_GLKEY.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')
           		->leftjoin('MASTER_GL', 'MASTER_GLKEY.GL_CODE', '=', 'MASTER_GL.GL_CODE')
            	->where('MASTER_GLKEY.ATYPE_CODE',$getAccAddre[0]->ATYPE_CODE)
            	->get()->first();

				$creditLimit = $getAccAddre[0]->CREADIT_LIMIT;

        	}else{
        		$getAccAddre ='';
        	}

        	if($account_code && $shipAddr){

        		$getStateCode = DB::table('MASTER_ACCADD')->where('ACC_CODE',$account_code)->where('SRNO',$shipAddr)->get()->first();

           		$stateOfAcc = $getStateCode->STATE_CODE;

           		if($plstateCode == $stateOfAcc){
           			$gettaxCode = DB::table('MASTER_TAX')->where('TAX_TYPE','SCGST')->get();
           		}else if($plstateCode != $stateOfAcc){
           			$gettaxCode = DB::table('MASTER_TAX')->where('TAX_TYPE','IGST')->get();
           		}else if($countryC != $stateconty->COUNTRY){
           			$gettaxCode = DB::table('MASTER_TAX')->where('TAX_TYPE','EXPORT')->get();	
           		}else{
           			$gettaxCode='';
           		}

        	}else{
        		$getStateCode='';
           		$gettaxCode='';
        	}

    		if ($gettaxCode || $saleQuodata || $getAccAddre) {

				$response_array['response']            = 'success';
				$response_array['get_taxCode']         = $gettaxCode;
				$response_array['creditLimit']         = $creditLimit;
				$response_array['sale_quotation_data'] = $saleQuodata;
				$response_array['sale_order_data']     = $saleOrderdata;
				$response_array['acc_GlData']          = $fetch_glCode;
				$response_array['data_opngAmt']        = $dataOpngAmt;
				$response_array['dataAccAddr']         = $getAccAddre;
				$response_array['getStateCode']        = $getStateCode;
				$response_array['enq_data']            = $enquiry_no_list;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['dataTax'] = '';
                $response_array['sale_quotation_data'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['dataTax'] = '';
                $response_array['sale_quotation_data'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function GetItemBySalesTrans(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$account_code = $request->input('account_code');
			$trans_code   = $request->input('trans_code');
			$sale_QuoNo   = $request->input('sale_QuoNo');
			$sale_ContNo  = $request->input('sale_ContNo');
			$sale_challan = $request->input('sale_challan');
			$itmList_po   ='';

			if($trans_code=='S2'){

				$itmList =  DB::table('SQTN_HEAD')->select('SQTN_HEAD.*', 'MASTER_ACC.*','SQTN_BODY.*','SQTN_BODY.SQTNBID as bodyid')
           		->leftjoin('MASTER_ACC', 'SQTN_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->leftjoin('SQTN_BODY', 'SQTN_HEAD.SQTNHID', '=', 'SQTN_BODY.SQTNHID')
            	->where([['SQTN_HEAD.VRNO','=',$sale_QuoNo],['SQTN_HEAD.ACC_CODE','=',$account_code]])
            	->get();

			}else if($trans_code=='S3'){

				$itmList =  DB::table('SCNTR_HEAD')->select('SCNTR_HEAD.*', 'MASTER_ACC.*','SCNTR_BODY.*','SCNTR_BODY.SCNTRBID as bodyid')
           		->leftjoin('MASTER_ACC', 'SCNTR_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->leftjoin('SCNTR_BODY', 'SCNTR_HEAD.SCNTRHID', '=', 'SCNTR_BODY.SCNTRHID')
            	->where([['SCNTR_HEAD.VRNO','=',$sale_ContNo],['SCNTR_HEAD.ACC_CODE','=',$account_code]])
            	->get();
			}else if($trans_code=='S4'){

				$itmList =  DB::table('SORDER_HEAD')->select('SORDER_HEAD.*', 'MASTER_ACC.*','SORDER_BODY.*','SORDER_BODY.SORDERBID as bodyid')
           		->leftjoin('MASTER_ACC', 'SORDER_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->leftjoin('SORDER_BODY', 'SORDER_HEAD.SORDERHID', '=', 'SORDER_BODY.SORDERHID')
            	->where([['SORDER_HEAD.VRNO','=',$sale_ContNo],['SORDER_HEAD.ACC_CODE','=',$account_code]])
            	->get();
			}else if($trans_code=='S5'){

				if($sale_ContNo){
					//DB::enableQueryLog();
					$itmList =  DB::table('SORDER_HEAD')->select('SORDER_HEAD.*', 'MASTER_ACC.*','SORDER_BODY.*','SORDER_BODY.SORDERBID as bodyid')
	           		->leftjoin('MASTER_ACC', 'SORDER_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
	           		->leftjoin('SORDER_BODY', 'SORDER_HEAD.SORDERHID', '=', 'SORDER_BODY.SORDERHID')
	            	->where([['SORDER_HEAD.VRNO','=',$sale_ContNo],['SORDER_HEAD.ACC_CODE','=',$account_code]])
	            	->groupBy('SORDER_BODY.SORDERHID')
	            	->get();
            	//dd(DB::getQueryLog());
				}else if($sale_challan){
					$itmList =  DB::table('SCHALLAN_HEAD')->select('SCHALLAN_HEAD.*', 'MASTER_ACC.*','SCHALLAN_BODY.*','SCHALLAN_BODY.SCHALLANBID as bodyid')
	           		->leftjoin('MASTER_ACC', 'SCHALLAN_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
	           		->leftjoin('SCHALLAN_BODY', 'SCHALLAN_HEAD.SCHALLANHID', '=', 'SCHALLAN_BODY.SCHALLANHID')
	            	->where([['SCHALLAN_HEAD.VRNO','=',$sale_challan],['SCHALLAN_HEAD.ACC_CODE','=',$account_code]])
	            	->get();

				}else{
					$itmList = '';
				}

				
            	
			}else{
				$itmList = '';
			}
    		if ($itmList) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itmList;
	            $response_array['data_PGI'] = $itmList_po;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data_PGI'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data_PGI'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function TaxStateByItemSales(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$taxCode = $request->input('taxCode');
	    	
            $getitem =	DB::SELECT("SELECT t1.*,t2.* FROM MASTER_HSNRATE t1  LEFT JOIN MASTER_ITEM t2 ON t2.HSN_CODE = t1.HSN_CODE WHERE t1.TAX_CODE='$taxCode'");
          
    		if ($getitem) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $getitem;

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

    public function AfieldCalculationForSales(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$trans_code    = $request->input('trans_code');
			$tax_code      = $request->input('tax_code');
			$ItemCode      = $request->input('ItemCode');
			$saleQtnHeadId = $request->input('saleQtnHeadId');
			$saleQtnBodyId = $request->input('saleQtnBodyId');
			$slContrHeadId = $request->input('slContrHeadId');
			$slContrBodyId = $request->input('slContrBodyId');
			$slordrHeadId  = $request->input('slordrHeadId');
			$slordrBodyId  = $request->input('slordrBodyId');
			$soHeadId      = $request->input('soHeadId');
			$soBodyId      = $request->input('soBodyId');
			$poiHeadId     = $request->input('poiHeadId');
			$poiBodyId     = $request->input('poiBodyId');
			$CompanyCode   = $request->session()->get('company_name');
			$macc_year     = $request->session()->get('macc_year');
			$userid        = $request->session()->get('userid');

	    	if($ItemCode && $saleQtnHeadId && $saleQtnBodyId){
	    		
	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.*,t3.SQTNTID as taxhid FROM SQTN_TAX t3 LEFT JOIN SQTN_BODY t2 ON t2.SQTNBID = t3.SQTNBID LEFT JOIN SQTN_HEAD t1 ON t1.SQTNHID = t3.SQTNHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.SQTNHID='$saleQtnHeadId' AND t3.SQTNBID='$saleQtnBodyId'");

	    	}else if($ItemCode && $slContrHeadId && $slContrBodyId){

	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.*,t3.SCNTRTID as taxhid FROM SCNTR_TAX t3 LEFT JOIN SCNTR_BODY t2 ON t2.SCNTRBID = t3.SCNTRBID LEFT JOIN SCNTR_HEAD t1 ON t1.SCNTRHID = t3.SCNTRHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.SCNTRHID='$slContrHeadId' AND t3.SCNTRBID='$slContrBodyId'");

	    	}else if($ItemCode && $soHeadId && $soBodyId){
	    		
	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM SORDER_TAX t3 LEFT JOIN SORDER_BODY t2 ON t2.SORDERBID = t3.SORDERBID LEFT JOIN SORDER_HEAD t1 ON t1.SORDERHID = t3.SORDERHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.SORDERHID='$soHeadId' AND t3.SORDERBID='$soBodyId'");
	    		
	    	}else if($ItemCode && $slordrHeadId && $slordrBodyId){

	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM SORDER_TAX t3 LEFT JOIN SORDER_BODY t2 ON t2.SORDERBID = t3.SORDERBID LEFT JOIN SORDER_HEAD t1 ON t1.SORDERHID = t3.SORDERHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.SORDERHID='$slordrHeadId' AND t3.SORDERBID='$slordrBodyId'");

	    	}else if($ItemCode && $poiHeadId && $poiBodyId){

	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM SCHALLAN_TAX t3 LEFT JOIN SCHALLAN_BODY t2 ON t2.SCHALLANBID = t3.SCHALLANBID LEFT JOIN SCHALLAN_HEAD t1 ON t1.SCHALLANHID = t3.SCHALLANHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.SCHALLANHID='$poiHeadId' AND t3.SCHALLANBID='$poiBodyId'");

	    	}else{

	    		$transcode_list = DB::table('MASTER_TAXRATE')
	            ->join('MASTER_TAXIND', 'MASTER_TAXRATE.TAXIND_CODE', '=', 'MASTER_TAXIND.TAXIND_CODE')
	            ->select('MASTER_TAXRATE.*', 'MASTER_TAXIND.TAXIND_NAME','MASTER_TAXIND.TAXIND_BLOCK')
	            ->where([['MASTER_TAXRATE.TAX_CODE','=',$tax_code]])
	            ->get();
	    	}
            

             $ratevalue = DB::table('MASTER_RATE_VALUE')->get();

            //dd(DB::getQueryLog());
	    	$count = count($transcode_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $transcode_list;
	            $response_array['data_rate'] = $ratevalue;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '';
                $response_array['data_rate'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data_rate'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function GetQtyParaForSales(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$itemCode  = $request->input('ItemCode');
			$saleQHead = $request->input('saleQuoHeadId');
			$saleQBody = $request->input('saleQuoBodyId');
			$scheadid  = $request->input('sc_headid');
			$scbodyid  = $request->input('sc_bodyid');
			$soHeadid  = $request->input('so_HeadId');
			$soBodyid  = $request->input('so_BodyId');
			$poi_HeadId  = $request->input('poi_HeadId');
			$poi_BodyId  = $request->input('poi_BodyId');

			if($itemCode && $saleQHead && $saleQBody){

				$fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM SQTN_QUA t3 LEFT JOIN SQTN_BODY t2 ON t2.SQTNBID = t3.SQTNBID LEFT JOIN SQTN_HEAD t1 ON t1.SQTNHID = t3.SQTNHID WHERE t2.ITEM_CODE='$itemCode' AND t3.SQTNHID='$saleQHead' AND t3.SQTNBID='$saleQBody'");

				if($fetch_qua_reocrd){
					$fetch_reocrd = $fetch_qua_reocrd;
				}else{
					$itemcode_get = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();
   					$fetch_reocrd = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode_get->ICATG_CODE)->get()->toArray();
				}


			}else if($itemCode && $scheadid && $scbodyid){

				$fetch_qua_contract = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM SCNTR_QUA t3 LEFT JOIN SCNTR_BODY t2 ON t2.SCNTRBID = t3.SCNTRBID LEFT JOIN SCNTR_HEAD t1 ON t1.SCNTRHID = t3.SCNTRHID WHERE t2.ITEM_CODE='$itemCode' AND t3.SCNTRHID='$scheadid' AND t3.SCNTRBID='$scbodyid'");

				if($fetch_qua_contract){
					$fetch_reocrd = $fetch_qua_contract;
				}else{
					$itemcode_get = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();
   					$fetch_reocrd = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode_get->ICATG_CODE)->get()->toArray();
				}

			}else if($soHeadid && $soBodyid && $itemCode){

				$fetch_qua_order = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM SORDER_QUA t3 LEFT JOIN SORDER_BODY t2 ON t2.SORDERBID = t3.SORDERBID LEFT JOIN SORDER_HEAD t1 ON t1.SORDERHID = t3.SORDERHID WHERE t2.ITEM_CODE='$itemCode' AND t3.SORDERHID='$soHeadid' AND t3.SORDERBID='$soBodyid'");

				if($fetch_qua_order){
					$fetch_reocrd = $fetch_qua_order;
				}else{
					$itemcode_get = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();
   					$fetch_reocrd = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode_get->ICATG_CODE)->get()->toArray();
				}

			}else if($poi_HeadId && $poi_BodyId && $itemCode){

				$fetch_qua_order = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM SCHALLAN_QUA t3 LEFT JOIN SCHALLAN_BODY t2 ON t2.SCHALLANBID = t3.SCHALLANBID LEFT JOIN SCHALLAN_HEAD t1 ON t1.SCHALLANHID = t3.SCHALLANHID WHERE t2.ITEM_CODE='$itemCode' AND t3.SCHALLANHID='$poi_HeadId' AND t3.SCHALLANBID='$poi_BodyId'");

				if($fetch_qua_order){
					$fetch_reocrd = $fetch_qua_order;
				}else{
					$itemcode_get = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();
   					$fetch_reocrd = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode_get->ICATG_CODE)->get()->toArray();
				}

			}else{

				$itemcode_get = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();
   				$fetch_reocrd = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode_get->ICATG_CODE)->get()->toArray();

			}

            if ($fetch_reocrd!='') {

				$response_array['response']  = 'success';
				$response_array['data']      = $fetch_reocrd;
				$response_array['item_code'] = $itemCode;
				//$response_array['levelAmt']    = $levelAmt;

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

    public function GetItemByPrevSalesVrno(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$account_code   = $request->input('account_code');
			$sale_ContNo    = $request->input('sale_ContNo');
			$sale_challanNo = $request->input('sale_challanNo');
			$sale_QuoNo     = $request->input('sale_QuoNo');
			$trans_code     = $request->input('trans_code');

			if($trans_code == 'S2'){

				$itmList =  DB::table('SQTN_HEAD')->select('SQTN_HEAD.*', 'MASTER_ACC.*','SQTN_BODY.*','SQTN_BODY.SQTNBID as bodyid')
           		->leftjoin('MASTER_ACC', 'SQTN_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->leftjoin('SQTN_BODY', 'SQTN_HEAD.SQTNHID', '=', 'SQTN_BODY.SQTNHID')
            	->where([['SQTN_HEAD.VRNO','=',$sale_QuoNo],['SQTN_HEAD.ACC_CODE','=',$account_code]])
            	->get();
			}else if($trans_code == 'S3'){

				$itmList =  DB::table('SCNTR_HEAD')->select('SCNTR_HEAD.*', 'MASTER_ACC.*','SCNTR_BODY.*','SCNTR_BODY.SCNTRBID as bodyid')
           		->leftjoin('MASTER_ACC', 'SCNTR_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->leftjoin('SCNTR_BODY', 'SCNTR_HEAD.SCNTRHID', '=', 'SCNTR_BODY.SCNTRHID')
            	->where([['SCNTR_HEAD.VRNO','=',$sale_ContNo],['SCNTR_HEAD.ACC_CODE','=',$account_code]])
            	->get();
			}else if($trans_code == 'S4'){

				$itmList =  DB::table('SORDER_HEAD')->select('SORDER_HEAD.*', 'MASTER_ACC.*','SORDER_BODY.*','SORDER_BODY.SORDERBID as bodyid')
           		->leftjoin('MASTER_ACC', 'SORDER_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->leftjoin('SORDER_BODY', 'SORDER_HEAD.SORDERHID', '=', 'SORDER_BODY.SORDERHID')
            	->where([['SORDER_HEAD.VRNO','=',$sale_ContNo],['SORDER_HEAD.ACC_CODE','=',$account_code]])
            	->get();
			}else if($trans_code == 'S5'){

				if($sale_ContNo){

					$itmList =  DB::table('SORDER_HEAD')->select('SORDER_HEAD.*', 'MASTER_ACC.*','SORDER_BODY.*','SORDER_BODY.SORDERBID as bodyid')
	           		->leftjoin('MASTER_ACC', 'SORDER_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
	           		->leftjoin('SORDER_BODY', 'SORDER_HEAD.SORDERHID', '=', 'SORDER_BODY.SORDERHID')
	            	->where([['SORDER_HEAD.VRNO','=',$sale_ContNo],['SORDER_HEAD.ACC_CODE','=',$account_code]])
	            	->get();

				}else if($sale_challanNo){

					$itmList =  DB::table('SCHALLAN_HEAD')->select('SCHALLAN_HEAD.*', 'MASTER_ACC.*','SCHALLAN_BODY.*','SCHALLAN_BODY.SCHALLANBID as bodyid')
	           		->leftjoin('MASTER_ACC', 'SCHALLAN_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
	           		->leftjoin('SCHALLAN_BODY', 'SCHALLAN_HEAD.SCHALLANHID', '=', 'SCHALLAN_BODY.SCHALLANHID')
	            	->where([['SCHALLAN_HEAD.VRNO','=',$sale_challanNo],['SCHALLAN_HEAD.ACC_CODE','=',$account_code]])
	            	->get();

				}
				
			}

    		if ($itmList) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itmList;

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

    public function GetItemByMulTaxCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$itemCode    = $request->input('ItemCode');
			$accCode     = $request->input('accCode');
			$taxCode     = $request->input('taxCode');
			$taxType     = $request->input('taxType');
			$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			$fisYear     =  $request->session()->get('macc_year');
			$plantCode   = $request->input('plantCode');
			$enqno       = $request->input('enqno');
			$seriesEnq   = $request->input('seriesEnq');
			
	    	$item_um_aum_list = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemCode)->get();

	    	$fetch_hsn_code = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();
	    	//DB::enableQueryLog();
	    	$itmetype_gl = DB::table('MASTER_ITEMTYPE')
					->select('MASTER_ITEMTYPE.*', 'MASTER_GL.*')
	           		->leftjoin('MASTER_GL', 'MASTER_ITEMTYPE.POST_CODE', '=', 'MASTER_GL.GL_CODE')
	            	->where('MASTER_ITEMTYPE.ITEMTYPE_CODE',$fetch_hsn_code->ITEMTYPE_CODE)
	            	->get();
	        //dd(DB::getQueryLog());    	
	    	$aum_list = DB::table('MASTER_ITEMUM')
					->select('MASTER_ITEMUM.*', 'MASTER_UM.*')
	           		->leftjoin('MASTER_UM', 'MASTER_ITEMUM.AUM_CODE', '=', 'MASTER_UM.UM_CODE')
	            	->where('MASTER_ITEMUM.ITEM_CODE',$itemCode)
	            	->where('MASTER_ITEMUM.UM_CODE',$fetch_hsn_code->UM)
	            	->get();

	        $isquaAply = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$fetch_hsn_code->ICATG_CODE)->get()->toArray();
	        
	        if($taxCode == ''){
	    		
	    		$fetch_tax_code = DB::table('MASTER_HSNRATE')
					->select('MASTER_HSNRATE.*', 'MASTER_TAX.*')
	           		->leftjoin('MASTER_TAX', 'MASTER_HSNRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
	            	->where('MASTER_TAX.TAX_TYPE',$taxType)
	            	->where('MASTER_HSNRATE.HSN_CODE',$fetch_hsn_code->HSN_CODE)
	            	->get();
	    	}else{
	    		$fetch_tax_code = DB::table('MASTER_HSNRATE')
					->select('MASTER_HSNRATE.*', 'MASTER_TAX.*')
	           		->leftjoin('MASTER_TAX', 'MASTER_HSNRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
	            	->where('MASTER_TAX.TAX_TYPE',$taxType)
	            	->where('MASTER_HSNRATE.HSN_CODE',$fetch_hsn_code->HSN_CODE)
	            	->get();
	    	}

	    	//$getstdRateByItm = DB::table('MASTER_ITEMBAL')->where('ITEM_CODE',$itemCode)->get()->toArray();
	    	//DB::enableQueryLog();
	    	$getstdRateByItm = DB::table('MASTER_ITEMBAL')->where('FY_CODE',$fisYear)->where('PLANT_CODE',$plantCode)->where('COMP_CODE',$getcompcode)->where('ITEM_CODE',$itemCode)->get()->toArray();
	    	//dd(DB::getQueryLog());

	    	if($enqno){
	    			
			    /*$qtyFrmEnq = DB::select("SELECT t1.*,t2.* FROM SENQ_VENDOR t2 LEFT JOIN SENQ_BODY t1 ON t1.SENQHID = t2.SENQHID AND t1.SENQBID=t2.SENQBID WHERE t1.VRNO='$enqno' AND t1.SERIES_CODE='$seriesEnq' AND t2.ACC_CODE='$accCode' AND t1.ITEM_CODE='$itemCode' AND t1.COMP_CODE='$getcompcode' AND t1.FY_CODE='$fisYear'");*/
			    $qtyFrmEnq = DB::select("SELECT t1.SENQHID as headID,t1.SENQBID as bodyID,t1.ITEM_CODE,t1.ITEM_NAME,t1.PARTICULAR,t1.QTYRECD,t1.UM,t1.AQTYRECD,t1.AUM FROM SENQ_HEAD t2 LEFT JOIN SENQ_BODY t1 ON t1.SENQHID = t2.SENQHID WHERE t2.VRNO='$enqno' AND t2.SERIES_CODE='$seriesEnq' AND t2.ACC_CODE='$accCode' AND t1.ITEM_CODE='$itemCode' AND t1.COMP_CODE='$getcompcode' AND t1.FY_CODE='$fisYear' UNION SELECT t1.CRMENQHID as headID,t1.CRMENQBID as bodyID,t1.ITEM_CODE,t1.PARTICULAR,t1.ITEM_NAME,t1.QTYRECD,t1.UM,t1.AQTYRECD,t1.AUM FROM CRM_ENQ_HEAD t2 LEFT JOIN CRM_ENQ_BODY t1 ON t1.CRMENQHID = t2.CRMENQHID WHERE t2.VRNO='$enqno' AND t2.SERIES_CODE='$seriesEnq' AND t2.ACC_CODE='$accCode' AND t1.ITEM_CODE='$itemCode'");

			    
	    	}else{
	    		
	    		$qtyFrmEnq = '';
			    	
	    	}
	    	
    		if ($item_um_aum_list && $aum_list) {
				
				$response_array['response']    = 'success';
				$response_array['data']        = $item_um_aum_list;
				$response_array['aumList']     = $aum_list;
				$response_array['data_hsn']    = $fetch_hsn_code;
				$response_array['data_quaPar'] = $isquaAply;
				$response_array['data_tax']    = $fetch_tax_code;
				$response_array['itypeGl']     = $itmetype_gl;
				$response_array['stdRate']     = $getstdRateByItm;
				$response_array['data_enq']    = $qtyFrmEnq;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

					$response_array['response']    = 'error';
					$response_array['data']        = '' ;
					$response_array['data_hsn']    = '';
					$response_array['data_enq']    = '';
					$response_array['data_quaPar'] = '';
					$response_array['aumList']     = '';
					$response_array['itypeGl']     = '';
					$response_array['stdRate']     = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

					$response_array['response']    = 'error';
					$response_array['data']        = '' ;
					$response_array['data_enq']    = '';
					$response_array['data_hsn']    = '';
					$response_array['data_quaPar'] = '';
					$response_array['aumList']     = '';
					$response_array['itypeGl']     = '';
					$response_array['stdRate']     = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function getVrnoSeriesBytransSale_old(Request $request){

		$response_array = array();

		$transCode   = $request->input('transCode');
		$seriesCode   = $request->input('seriesCode');
		$CompanyCode = $request->session()->get('company_name');
		$spliCode    = explode('-', $CompanyCode);
		$comp_code   = $spliCode[0];
		$macc_year   = $request->session()->get('macc_year');

		if ($request->ajax()) {


			$series_list = DB::table('MASTER_CONFIG')->where([['SERIES_CODE','=',$seriesCode]])->get();

			$fetch_vrno_reocrd = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transCode)->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$comp_code)->get()->first();

			if($transCode == 'S1'){
				$tableName = 'SQTN_HEAD';
			}else if($transCode == 'S2'){
				$tableName = 'SCNTR_HEAD';
			}else if($transCode == 'S3'){
				$tableName = 'SORDER_HEAD';
			}else if($transCode == 'S5'){
				$tableName = 'SBILL_HEAD';
			}else if($transCode == 'S4'){
				$tableName = 'SCHALLAN_HEAD';
			}

			$check_vrno_found = DB::table($tableName)->where('TRAN_CODE',$transCode)->where('SERIES_CODE',$seriesCode)->get()->toArray();

    		if ($fetch_vrno_reocrd || $check_vrno_found || $series_list) {

				$response_array['response']   = 'success';
				$response_array['vrno_series'] = $fetch_vrno_reocrd;
				$response_array['vrnodata']    = $check_vrno_found;
				$response_array['data'] = $series_list ;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['datavrno'] = '' ;
                $response_array['seriesList'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['datavrno'] = '' ;
                $response_array['seriesList'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

/*------- sale  ajax function  ------- */


/* --------- simulation data -------- */


    function simulationForSaleBill(Request $request){

    	if ($request->ajax()) {

			$data_Count   = 9;
			
			$chkcitm  = $request->checkitm;
			$accCode  = $request->accCode;
			$seriesGl = $request->seriesGl;
			$netAmnt  = $request->netAmnt;
			$userId   = $request->session()->get('userid');	
			$getcountitm = count($chkcitm);

				$saveData ='';

				DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','S')->delete();

				for ($i=0; $i < $getcountitm ; $i++) {

					$getcheckdata = $chkcitm[$i];

					$explodedata = explode('/', $getcheckdata);

					$headid = $explodedata[0];
					$bodyid = $explodedata[1];
					$itmcode= $explodedata[2];
					//DB::enableQueryLog();
					$taxData = DB::select("SELECT t1.*,t2.*,t3.* FROM SCHALLAN_TAX t3 LEFT JOIN SCHALLAN_BODY t2 ON t2.SCHALLANBID = t3.SCHALLANBID LEFT JOIN SCHALLAN_HEAD t1 ON t1.SCHALLANHID = t3.SCHALLANHID WHERE t2.ITEM_CODE='$itmcode' AND t3.SCHALLANHID='$headid' AND t3.SCHALLANBID='$bodyid'");
					//dd(DB::getQueryLog());

					$taxcount = count($taxData);

					for($k=0;$k<$taxcount;$k++){

						$rateindex   = $taxData[$k]->RATE_INDEX;
						$taxamt      = $taxData[$k]->TAX_AMT;
						$tax_gl_code = $taxData[$k]->TAXGL_CODE;
						$uniqCheck   = $taxData[$k]->TAXIND_CODE;
						
						$checkExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','S')->get()->toArray();

						$indData = DB::table('SIMULATION_TEMP')->where('IND_CODE',$uniqCheck)->where('CREATED_BY',$userId)->where('TCFLAG','S')->get()->toArray();

						if($taxamt != 0.00){
							if($rateindex == 'Z'){

							}else{
							if(empty($checkExist)){
							
								$idary = array(
									'IND_CODE'    => $uniqCheck,
									'DR_AMT'      => '',
									'CR_AMT'      =>$taxamt,
									'IND_GL_CODE' => $seriesGl,
									'TCFLAG'      => 'S',
									'CODE_NAME'   => 'Series Gl',
									'CREATED_BY'  => $userId,
								
								);
								DB::table('SIMULATION_TEMP')->insert($idary);

							}else if($tax_gl_code == ''){

								$bscVal = DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$userId)->where('TCFLAG','S')->get()->toArray();
								$updateId = $bscVal[0]->CREATED_BY;
								$basicAmt = $bscVal[0]->CR_AMT + $taxamt;
							
								$idary_bsic = array(
									'DR_AMT' 	  =>'',
									'CR_AMT'	  =>$basicAmt,
								);

								 DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('TCFLAG','S')->where('CREATED_BY',$updateId)->update($idary_bsic);

							}else if(empty($indData)){

								
								$idary   = array(
									'IND_CODE'    => $uniqCheck,
									'DR_AMT'      => '',
									'CR_AMT'      =>$taxData[$k]->TAX_AMT,
									'IND_GL_CODE' => $tax_gl_code,
									'CODE_NAME'   => 'Tax Gl',
									'TCFLAG'      => 'S',
									'CREATED_BY'  => $userId,
									
								);

							DB::table('SIMULATION_TEMP')->insert($idary);
							}else{
								$indData1 = DB::table('SIMULATION_TEMP')->where('IND_CODE',$uniqCheck)->where('TCFLAG','S')->where('CREATED_BY',$userId)->get()->first();

								$newTaxAmt = $indData1->CR_AMT + $taxamt;

								$idary1 = array(
									'DR_AMT' => '',
									'CR_AMT' =>$newTaxAmt,
								);

								$updatevr = DB::table('SIMULATION_TEMP')->where('IND_CODE',$uniqCheck)->where('TCFLAG','S')->where('CREATED_BY',$userId)->update($idary1);
							}

							}
						}

					} /* /. for */

				} /* main for (item)*/


				$accData = array(

					'IND_CODE'     =>'',
					'DR_AMT'       =>$netAmnt,
					'CR_AMT'       =>'',
					'IND_ACC_CODE' =>$accCode,
					'TCFLAG'       =>'S',
					'CODE_NAME'    => 'Acc Code',
					'CREATED_BY'   =>$userId,
				);

				DB::table('SIMULATION_TEMP')->insert($accData);


			$response_array = array();
			//$taxData = DB::table('simulatn_temp')->where('created_by', $userId)->get();
			$taxData = DB::select("SELECT t1.*,t2.GL_NAME as glName,t3.ACC_NAME AS accName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE LEFT JOIN MASTER_ACC t3 ON t3.ACC_CODE =t1.IND_ACC_CODE WHERE t1.CREATED_BY='$userId' AND t1.TCFLAG='S'");


    		if ($taxData) {

    			$response_array['response'] = 'success';
	            $response_array['data_sim'] = $taxData;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data_sim'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

		} /* /. ajax*/

    } /* ./ function close*/



/* --------- simulation data -------- */


/* ------------ post good issues -------------- */

	public function GetStockOpnQty(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$CompanyCode = $request->session()->get('company_name');
			$spliCode    = explode('-', $CompanyCode);
			$comp_code   = $spliCode[0];
			$macc_year   = $request->session()->get('macc_year');
			$plant_code   = $request->input('plant_code');
			$item_code   = $request->input('getitemCd');
 
			$stockQty = DB::table('MASTER_ITEMBAL')->where('FY_CODE',$macc_year)->where('PLANT_CODE',$plant_code)->where('COMP_CODE',$comp_code)->where('ITEM_CODE',$item_code)->get()->first();

    		if ($stockQty) {

    			$response_array['response'] = 'success';
	            $response_array['data_stockqty'] = $stockQty;

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data_stockqty'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data_stockqty'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

/* ------------ post good issues -------------- */


/* ------------- SIMULATION FOR SALE CHALLAN (POST GOODS ISSUE) ------------ */
	
	public function simulationForSaleChallan(Request $request){

		$seriesGl     = $request->seriesGl;
		$totalRate    = $request->totalRate;
		$itmePostCode = $request->itmePostCode;
		$itmstdRate   = $request->itmstdRate;
		$itemCode     = $request->itemCode;
		$userId       = $request->session()->get('userid');
		$itemCount    = count($itemCode);

		DB::table('SIMULATION_TEMP')->where('TCFLAG','SC')->where('CREATED_BY',$userId)->delete();

		$seriesGlD = array(
			'IND_GL_CODE' => $seriesGl,
			'DR_AMT'      => $totalRate,
			'CR_AMT'      => '',
			'TCFLAG'      => 'SC',
			'CODE_NAME'   => 'Series Gl',
			'CREATED_BY'  => $userId,
                
        );

        DB::table('SIMULATION_TEMP')->insert($seriesGlD);

		for($i=0;$i<$itemCount;$i++){

			$checkempty = DB::table('SIMULATION_TEMP')->where('TCFLAG','SC')->where('IND_GL_CODE',$itmePostCode[$i])->where('CREATED_BY',$userId)->get()->toArray();

			if(empty($checkempty)){
				$idary = array(
					'IND_GL_CODE' => $itmePostCode[$i],
					'DR_AMT'      => '',
					'CR_AMT'      => $itmstdRate[$i],
					'TCFLAG'      => 'SC',
					'CODE_NAME'   => 'Item Type Gl',
					'CREATED_BY'  => $userId,
                        
                );

                DB::table('SIMULATION_TEMP')->insert($idary);
			}else{
				$checkExist = DB::table('SIMULATION_TEMP')->where('TCFLAG','SC')->where('IND_GL_CODE',$itmePostCode[$i])->where('CREATED_BY',$userId)->get()->toArray();
				 $updateId = $checkExist[0]->CREATED_BY;
				$NewItmAmt = $checkExist[0]->CR_AMT + $itmstdRate[$i];

				$newAmt = array(
					'CR_AMT'      => $NewItmAmt,
					'TCFLAG'      => 'SC',
					'CREATED_BY'  => $userId,
                );

                DB::table('SIMULATION_TEMP')->where('TCFLAG','SC')->where('IND_GL_CODE',$itmePostCode[$i])->where('CREATED_BY',$updateId)->update($newAmt);
			}
		} /* /. for loop */

		$response_array = array();
  		$simData = DB::select("SELECT t1.*,t2.GL_NAME as glName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE WHERE t1.TCFLAG='SC' AND t1.CREATED_BY='$userId'");

  		if ($simData) {

          	$response_array['response'] = 'success';
            $response_array['data_sim'] = $simData;
            echo $data = json_encode($response_array);
              //print_r($data);
      	}else{

			$response_array['response'] = 'error';
			$response_array['data_sim'] = '' ;
			$data = json_encode($response_array);
			print_r($data);
        
     	}

	}

/* ------------- SIMULATION FOR SALE CHALLAN (POST GOODS ISSUE) ------------ */

/* ----------------- start pdf generate for sale when click save & Download ---------------- */
public function GeneratePdfForSale($userId,$getcom_code,$headId,$headtable,$bodytable,$taxtable,$columnheadid,$pdfName,$vrPName,$tCode){

		$response_array = array();

		DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','RT')->orWhere('TCFLAG','R_IT')->delete();
		//DB::enableQueryLog();
		$dataheadB = DB::SELECT("SELECT t1.*,MASTER_ACC.ACC_NAME,MASTER_ACC.ACC_CODE,'$headtable' as tablNme,t2.*,t3.SERIES_CODE,t3.SERIES_NAME,t4.GST_NO,t4.CITY as plant_city FROM $headtable t1 LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = t1.ACC_CODE LEFT JOIN $bodytable t2 ON t2.$columnheadid = t1.$columnheadid LEFT JOIN MASTER_CONFIG t3 ON t3.SERIES_CODE=t1.SERIES_CODE AND t3.TRAN_CODE=t1.TRAN_CODE LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$columnheadid='$headId'");

		/*SELECT t1.*,MASTER_ACC.ACC_NAME,MASTER_ACC.ACC_CODE,'SQTN_HEAD' as tablNme,t2.*,t3.SERIES_CODE,t3.SERIES_NAME,t4.GST_NO,t4.CITY as plant_city FROM SQTN_HEAD t1 
		LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = t1.ACC_CODE 
		LEFT JOIN SQTN_BODY t2 ON t2.SQTNHID = t1.SQTNHID 
		LEFT JOIN MASTER_CONFIG t3 ON t3.SERIES_CODE=t1.SERIES_CODE AND t3.TRAN_CODE=t1.TRAN_CODE 
		LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.SQTNHID='2'*/

		//dd(DB::getQueryLog());
		$bodyCount  = count($dataheadB);
		$seriesCode = $dataheadB[0]->SERIES_CODE;
		$accCode    = $dataheadB[0]->ACC_CODE;
		$consiner   = $dataheadB[0]->CPCODE;
		$compCode   = $dataheadB[0]->COMP_CODE;

		$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

		$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACCADD.CPCODE = '$consiner'");

		$compDetail = DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$compCode'");

		$dataTax = DB::SELECT("SELECT t1.*,t2.$columnheadid FROM $taxtable t1 LEFT JOIN $headtable t2 ON t2.$columnheadid = t1.$columnheadid WHERE t2.$columnheadid='$headId' AND t1.TAX_AMT<>'0.00'");

		$taxCount = count($dataTax);	

		$sgst=array(); $cgst =array();$igst =array();
		$sgstrate=array(); $cgstrate =array();$igstrate =array();

		foreach ($dataTax as $row) {

			if($row->TAXIND_CODE=='SG1'){

              $sgst[] = $row->TAX_AMT;
              $sgstrate[] = $row->TAX_RATE;
            }else{
              $sgst[] =0.00;
              $sgstrate[] =0.00;
            }

            if($row->TAXIND_CODE=='CG1'){

              $cgst[] = $row->TAX_AMT;
              $cgstrate[] = $row->TAX_RATE;
            }else{
            	$cgst[] =0.00;
                $cgstrate[] =0.00;
            
            }

            if($row->TAXIND_CODE=='IGST'){
              $igst[] = $row->TAX_AMT;
              $igstrate[] = $row->TAX_RATE;
            }else{
              $igst[] =0.00;
              $igstrate[] =0.00;
            } 

		}

		$igst_Amt  = explode('][', trim(str_replace('[0]', '', '['.implode('][', $igst).']'), '[]'));  
		$cgst_Amt  = explode('][', trim(str_replace('[0]', '', '['.implode('][', $cgst).']'), '[]'));
		$sgst_Amt  = explode('][', trim(str_replace('[0]', '', '['.implode('][', $sgst).']'), '[]'));
		$sgst_rate = explode('][', trim(str_replace('[0]', '', '['.implode('][', $sgstrate).']'), '[]'));  
		$cgst_rate = explode('][', trim(str_replace('[0]', '', '['.implode('][', $cgstrate).']'), '[]'));  
		$igst_rate = explode('][', trim(str_replace('[0]', '', '['.implode('][', $igstrate).']'), '[]'));

		for($q=0;$q<$bodyCount;$q++){

			$hsnCd   = $dataheadB[$q]->HSN_CODE;

				if(empty($igst_Amt[$q])){
					$igstAmt =0.00;
				}else{
					$igstAmt=$igst_Amt[$q];
				}

				if(empty($igst_rate[$q])){
					$igstTrate =0.00;
				}else{
					$igstTrate=$igst_rate[$q];
				}

				if(empty($cgst_Amt[$q])){
					$cgstNAmt =0.00;
				}else{
					$cgstNAmt=$cgst_Amt[$q];
				}

				if(empty($cgst_rate[$q])){
					$cgstNrate =0.00;
				}else{
					$cgstNrate=$cgst_rate[$q];
				}

				if(empty($sgst_Amt[$q])){
					$sgstNAmt =0.00;
				}else{
					$sgstNAmt=$sgst_Amt[$q];
				}	

				if(empty($sgst_rate[$q])){
					$sgstNrate =0.00;
				}else{
					$sgstNrate=$sgst_rate[$q];
				}

				$checkExistItm = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','R_IT')->get()->toArray();

				if(empty($checkExistItm)){
					$firstItm = array(
						'IND_CODE'   => $dataheadB[$q]->HSN_CODE,
						'cgstrate'   => $cgstNrate,
						'cgstamt'    => $cgstNAmt,
						'igstrate'   => $igstTrate,
						'igstamt'    => $igstAmt,
						'sgstrate'   => $sgstNrate,
						'sgstamt'    => $sgstNAmt,
						'TCFLAG'     => 'R_IT',
						'CREATED_BY' => $userId,
					);

					DB::table('SIMULATION_TEMP')->insert($firstItm);
				}else{

					$previourAmtGet = DB::select("SELECT * from `SIMULATION_TEMP` WHERE `IND_CODE` = '$hsnCd' AND (igstrate = '$igstTrate' OR (sgstrate='$sgstNrate' AND cgstrate='$cgstNrate')) AND `TCFLAG` = 'R_IT' AND CREATED_BY='$userId'");

					if(empty($previourAmtGet)){
						$firstItm = array(
							'IND_CODE'   => $dataheadB[$q]->HSN_CODE,
							'cgstrate'   => $cgstNrate,
							'cgstamt'    => $cgstNAmt,
							'igstrate'   => $igstTrate,
							'igstamt'    => $igstAmt,
							'sgstrate'   => $sgstNrate,
							'sgstamt'    => $sgstNAmt,
							'TCFLAG'     => 'R_IT',
							'CREATED_BY' => $userId,
						);

						DB::table('SIMULATION_TEMP')->insert($firstItm);
					}else{

						$NewAmtGet = DB::select("SELECT * from `SIMULATION_TEMP` WHERE `IND_CODE` = '$hsnCd' AND (igstrate = '$igstTrate' OR (sgstrate='$sgstNrate' AND cgstrate='$cgstNrate')) AND `TCFLAG` = 'R_IT' AND CREATED_BY='$userId'");

						$newSgstAmt  = $NewAmtGet[0]->sgstamt + $sgstNAmt;
						$newCgstAmt  = $NewAmtGet[0]->cgstamt + $cgstNAmt;
						$newIgstAmt  = $NewAmtGet[0]->igstamt + $igstAmt;

						$updateItm = array(
						
							'cgstamt'    =>$newCgstAmt,
							'igstamt'    =>$newIgstAmt,
							'sgstamt'    =>$newSgstAmt,
						);
						DB::table('SIMULATION_TEMP')->where('IND_CODE',$hsnCd)->where('igstrate',$igstTrate)->where('TCFLAG','R_IT')->where('CREATED_BY',$userId)->update($updateItm);
						DB::table('SIMULATION_TEMP')->where('IND_CODE',$hsnCd)->where('sgstrate',$sgstNrate)->where('TCFLAG','R_IT')->where('CREATED_BY',$userId)->update($updateItm);
						
					}

				}

		} /* bodycount for loop*/

		for($r=0;$r<$taxCount;$r++){
			$taxIndCd   = $dataTax[$r]->TAXIND_CODE;
			$taxIndName = $dataTax[$r]->TAXIND_NAME;
			$taxAmount  = $dataTax[$r]->TAX_AMT;
			$rateInde   = $dataTax[$r]->RATE_INDEX;

			$checkExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','RT')->get()->toArray();

			$indData = DB::table('SIMULATION_TEMP')->where('IND_CODE',$taxIndCd)->where('CREATED_BY',$userId)->where('TCFLAG','RT')->get()->toArray();

			if(($rateInde != 'Z' && $rateInde!='-') || ($rateInde == 'Z' && $taxIndCd=='GT01')) {

				if(empty($checkExist)){
					$firstAM = array(
							'IND_CODE'    => $taxIndCd,
							'IND_NAME'    => $taxIndName,
							'CR_AMT'      => $taxAmount,
							'TCFLAG'      => 'RT',
							'CREATED_BY'  => $userId,
						
						);
					DB::table('SIMULATION_TEMP')->insert($firstAM);
				}else if(empty($indData)){

					$existAmt = array(
							'IND_CODE'    => $taxIndCd,
							'IND_NAME'    => $taxIndName,
							'CR_AMT'      => $taxAmount,
							'TCFLAG'      => 'RT',
							'CREATED_BY'  => $userId,
						
						);
					DB::table('SIMULATION_TEMP')->insert($existAmt);

				}else{

					$indData1 = DB::table('SIMULATION_TEMP')->where('IND_CODE',$taxIndCd)->where('TCFLAG','RT')->where('CREATED_BY',$userId)->get()->first();

					$newTaxAmt = $indData1->CR_AMT + $taxAmount;

					$newAMt = array(
						'CR_AMT'      => $newTaxAmt,
					);

					$updatevr = DB::table('SIMULATION_TEMP')->where('IND_CODE',$taxIndCd)->where('TCFLAG','RT')->where('CREATED_BY',$userId)->update($newAMt);
				}
			}
		} /* /.for loop*/


		$taxDetail = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','RT')->orwhere('TCFLAG','R_IT')->get()->toArray();

		$taxDCnt = count($taxDetail);
		$grandAmt;
		for($f=0;$f<$taxDCnt;$f++){
			
			if($taxDetail[$f]->IND_CODE == 'GT01'){
				$grandAmt = $taxDetail[$f]->CR_AMT;
			}
		}

		$dataConfig = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$tCode)->where('SERIES_CODE',$seriesCode)->get()->toArray();

		$this->ConvertAmountIntoWord($grandAmt,$tCode,$seriesCode,$dataheadB,$dataTax,$taxDetail,$pdfName,$dataConfig,$dataAccDetail,$consinerDetail,$compDetail,$vrPName);

	}

	function ConvertAmountIntoWord($grandAmt,$tCode,$seriesCode,$dataheadB,$dataTax,$taxDetail,$pdfName,$dataConfig,$dataAccDetail,$consinerDetail,$compDetail,$vrPName){

		$response_array = array();

		$num = str_replace(array(',', ' '), '' , trim($grandAmt));

	    //print_r($num);exit;
	    if(! $num) {
	        return false;
	    }
	    $num = (int) $num;
	    $words = array();
	    $list1 = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven',
	        'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
	    );
	    $list2 = array('', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety', 'Hundred');
	    $list3 = array('', 'Thousand', 'Million', 'Billion', 'Trillion', 'Quadrillion', 'Quintillion', 'Sextillion', 'Septillion',
	        'Octillion', 'Nonillion', 'Decillion', 'Nndecillion', 'Duodecillion', 'Tredecillion', 'Quattuordecillion',
	        'Quindecillion', 'Sexdecillion', 'Septendecillion', 'Octodecillion', 'Novemdecillion', 'Vigintillion'
	    );
	    $num_length = strlen($num);
	    $levels = (int) (($num_length + 2) / 3);
	    $max_length = $levels * 3;
	    $num = substr('00' . $num, -$max_length);
	    $num_levels = str_split($num, 3);
	    for ($i = 0; $i < count($num_levels); $i++) {
	        $levels--;
	        $hundreds = (int) ($num_levels[$i] / 100);
	        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
	        $tens = (int) ($num_levels[$i] % 100);
	        $singles = '';
	        if ( $tens < 20 ) {
	            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
	        } else {
	            $tens = (int)($tens / 10);
	            $tens = ' ' . $list2[$tens] . ' ';
	            $singles = (int) ($num_levels[$i] % 10);
	            $singles = ' ' . $list1[$singles] . ' ';
	        }
	        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
	    } //end for loop
	    $commas = count($words);
	    if ($commas > 1) {
	        $commas = $commas - 1;
	    }
	    //return implode(' ', $words);

	    $numwords= implode(' ', $words);

		header('Content-Type: application/pdf');

		$pdf = PDF::loadView('admin.finance.transaction.sales.sale_data_pdf',compact('dataheadB','dataTax','taxDetail','pdfName','dataConfig','dataAccDetail','consinerDetail','compDetail','vrPName','numwords'));

		$path = public_path('dist/downloadpdf'); 
        $fileName =  time().'.'. 'pdf' ; 
        $pdf->save($path . '/' . $fileName);
		$PublicPath                   = url('public/dist/downloadpdf/');  
		$downloadPdf                  = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url']        = $downloadPdf;
		$response_array['data']       = $dataheadB;
		echo $data = json_encode($response_array);
	
	}
/* ----------------- start pdf generate for sale when click save & Download ---------------- */

	public function GeneratePdfForSaleEnq($getcom_code,$headId,$headtable,$bodytable,$columnheadid){

	//print_r($tax_ind_code);exit;

		$response_array = array();

		$data030 = DB::SELECT("SELECT t1.*,t2.*,'$headtable' as tableName FROM $headtable t1 LEFT JOIN $bodytable t2 ON t2.$columnheadid = t1.$columnheadid  WHERE t2.$columnheadid='$headId'");

		
		$title='Sale Enquiry Report';

        header('Content-Type: application/pdf');
     
        $pdf = PDF::loadView('admin.finance.transaction.sales.sale_data_enq_pdf',compact('data030','title'));
                      
        $path = public_path('dist/downloadpdf'); 
        $fileName =  time().'.'. 'pdf' ; 
        $pdf->save($path . '/' . $fileName);
        $PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['data'] = $data030;



		$filename = 'download.pdf';

    	$mpdf  = new \Mpdf\Mpdf();
    	$html  = view('admin.finance.transaction.sales.sale_data_enq_pdf',compact('data030','title'));
    	$html  = $html->render();
    	//$mpdf->SetHeader('chapter 1');
    	
    	$stylesheet = file_get_contents(url('public/dist/css/mpdf.css'));
    	$mpdf->WriteHTML($stylesheet, 1);

    	//$mpdf->SetFooter('Footer');
    	
    	$mpdf->WriteHTML($html);

    	$pdf = $mpdf->Output('', 'S');
    	$developmentMode = true;
        $mailer = new PHPMailer($developmentMode);
    	$accEmailId='sangitkachahe13@gmail.com';
        $mailer->SMTPDebug = 0;

        $mailer->Mailer = 'smtp';

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
        $mailer->Username = 'sangit.kachahe@aceworth.in';
        $mailer->Password = 'sangit@13';
        $mailer->CharSet = 'iso-8859-1'; 
        $mailer->Port = 587;
        $mailer->SMTPSecure = 'tls'; 
        $mailer->WordWrap = TRUE;

        $mailer->setFrom('sangit.kachahe@aceworth.in', 'Aceworth Pvt ltd');
        $mailer->addAddress($accEmailId, 'Aceworth Pvt ltd');
        $mailer->addReplyTo('sangit.kachahe@aceworth.in', 'Aceworth Pvt ltd');

        $mailer->isHTML(true);
        $mailer->Subject = 'Invoice';
        $mailer->addStringAttachment($pdf,'customer.pdf');

        $message = 'SALE VOUCHER';
 
      

        $mailer->Body = $message;

        $mailSend = $mailer->send();
        $mailer->ClearAllRecipients();

		
		/*$data = json_encode($response_array);
		print_r($data);*/
    	echo $data = json_encode($response_array);
	}

/* --------------------- end pdf generate for grn ------------------- */

/* ------------ download pdf for sale view -------------------*/

	public function pdfDownloadForViewSales(Request $request){

		$response_array = array();

		$uniqNo  = $request->input('uniqNo');
		$head_Id = $request->input('headId');
		$vrNo    = $request->input('vrno');
		$tCode   = $request->input('tCode');
		$userId  = $request->session()->get('userid');	

		if($tCode == 'S1'){
			$headTble ='SQTN_HEAD';
			$bodyTble ='SQTN_BODY';
			$taxTble  ='SQTN_TAX';
			$headID   ='SQTNHID';
			$pdfName  = 'SALES QUOTATION';
			$vrPName   ='QTN NO';
			$seirsHeadLine='SERIES';
		}else if($tCode == 'S2'){
			$headTble ='SCNTR_HEAD';
			$bodyTble ='SCNTR_BODY';
			$taxTble  ='SCNTR_TAX';
			$headID   ='SCNTRHID';
			$pdfName = 'SALES CONTRACT';
			$vrPName   ='CNTR NO';
			$seirsHeadLine='SERIES';
		}else if($tCode == 'S3'){
			$headTble ='SORDER_HEAD';
			$bodyTble ='SORDER_BODY';
			$taxTble  ='SORDER_TAX';
			$headID   ='SORDERHID';
			$pdfName = 'SALES ORDER';
			$vrPName   ='ORDER NO';
			$seirsHeadLine='SERIES';
		}else if($tCode == 'S4'){
			$headTble ='SCHALLAN_HEAD';
			$bodyTble ='SCHALLAN_BODY';
			$taxTble  ='SCHALLAN_TAX';
			$headID   ='SCHALLANHID';
			$pdfName = 'SALES CHALLAN';
			$vrPName   ='CHALLAN NO';
			$seirsHeadLine='SERIES';
		}else if($tCode == 'S5'){
			$headTble ='SBILL_HEAD';
			$bodyTble ='SBILL_BODY';
			$taxTble  ='SBILL_TAX';
			$headID   ='SBILLHID';
			$pdfName = 'TAX INVOICE';
			$vrPName   ='BILL NO';
			$seirsHeadLine='DOCTYPE';
		}
		
		if ($request->ajax()) {
			//DB::enableQueryLog();
			DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','RT')->orWhere('TCFLAG','R_IT')->delete();
			//dd(DB::getQueryLog());
			//$dataheadB = DB::SELECT("SELECT t1.*,'$headTble' as tablNme,t2.* FROM $headTble t1 LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID WHERE t2.$headID='$head_Id'");
			//DB::enableQueryLog();
			$dataheadB = DB::SELECT("SELECT t1.*,MASTER_ACC.ACC_NAME,MASTER_ACC.ACC_CODE,'$headTble' as tablNme,t2.*,t3.SERIES_CODE,t3.SERIES_NAME,t4.GST_NO,t4.CITY as plant_city FROM $headTble t1 LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = t1.ACC_CODE LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID LEFT JOIN MASTER_CONFIG t3 ON t3.SERIES_CODE=t1.SERIES_CODE AND t3.TRAN_CODE=t1.TRAN_CODE LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$headID='$head_Id'");
			//dd(DB::getQueryLog());
			$bodyCount  = count($dataheadB);
			$seriesCode = $dataheadB[0]->SERIES_CODE;
			$accCode    = $dataheadB[0]->ACC_CODE;
			$consiner   = $dataheadB[0]->CPCODE;
			$compCode   = $dataheadB[0]->COMP_CODE;
			/*DB::enableQueryLog();

			$getAccAddre = DB::table('MASTER_ACC')
				->select('MASTER_ACC.*', 'MASTER_ACCADD.*')
           		->leftjoin('MASTER_ACCADD', 'MASTER_ACCADD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->where('MASTER_ACC.ACC_CODE',$accCode)
           		->get();*/

			$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

			/*$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACCADD.ACC_CODE = '$accCode' AND MASTER_ACCADD.ADD1 = '$consiner'");*/
			$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACCADD.CPCODE = '$consiner'");

			$compDetail = DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$compCode'");
			
			//dd(DB::getQueryLog());
			//print_r($dataConfig);
			//dd(DB::getQueryLog());
			$dataTax = DB::SELECT("SELECT t1.*,t2.$headID FROM $taxTble t1 LEFT JOIN $headTble t2 ON t2.$headID = t1.$headID WHERE t2.$headID='$head_Id'  AND t1.TAX_AMT<>'0.00' ");
			$taxCount = count($dataTax);

			$sgst=array(); $cgst =array();$igst =array();
			$sgstrate=array(); $cgstrate =array();$igstrate =array();

			foreach ($dataTax as $row) {

				if($row->TAXIND_CODE=='SG1'){

	              $sgst[] = $row->TAX_AMT;
	              $sgstrate[] = $row->TAX_RATE;
	            }else{
	              $sgst[] =0.00;
	              $sgstrate[] =0.00;
	            }

	            if($row->TAXIND_CODE=='CG1'){

	              $cgst[] = $row->TAX_AMT;
	              $cgstrate[] = $row->TAX_RATE;
	            }else{
	            	$cgst[] =0.00;
	                $cgstrate[] =0.00;
	            
	            }

	            if($row->TAXIND_CODE=='IGST'){
	              $igst[] = $row->TAX_AMT;
	              $igstrate[] = $row->TAX_RATE;
	            }else{
	              $igst[] =0.00;
	              $igstrate[] =0.00;
	            } 

			}
			$igst_Amt = explode('][', trim(str_replace('[0]', '', '['.implode('][', $igst).']'), '[]'));  
			$cgst_Amt = explode('][', trim(str_replace('[0]', '', '['.implode('][', $cgst).']'), '[]'));
			$sgst_Amt = explode('][', trim(str_replace('[0]', '', '['.implode('][', $sgst).']'), '[]'));
			$sgst_rate = explode('][', trim(str_replace('[0]', '', '['.implode('][', $sgstrate).']'), '[]'));  
			$cgst_rate = explode('][', trim(str_replace('[0]', '', '['.implode('][', $cgstrate).']'), '[]'));  
			$igst_rate = explode('][', trim(str_replace('[0]', '', '['.implode('][', $igstrate).']'), '[]'));  

			for($q=0;$q<$bodyCount;$q++){

				$hsnCd   = $dataheadB[$q]->HSN_CODE;

				if(empty($igst_Amt[$q])){
					$igstAmt =0.00;
				}else{
					$igstAmt=$igst_Amt[$q];
				}

				if(empty($igst_rate[$q])){
					$igstTrate =0.00;
				}else{
					$igstTrate=$igst_rate[$q];
				}

				if(empty($cgst_Amt[$q])){
					$cgstNAmt =0.00;
				}else{
					$cgstNAmt=$cgst_Amt[$q];
				}

				if(empty($cgst_rate[$q])){
					$cgstNrate =0.00;
				}else{
					$cgstNrate=$cgst_rate[$q];
				}

				if(empty($sgst_Amt[$q])){
					$sgstNAmt =0.00;
				}else{
					$sgstNAmt=$sgst_Amt[$q];
				}	

				if(empty($sgst_rate[$q])){
					$sgstNrate =0.00;
				}else{
					$sgstNrate=$sgst_rate[$q];
				}
	

				$checkExistItm = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','R_IT')->get()->toArray();

				if(empty($checkExistItm)){
					$firstItm = array(
						'IND_CODE'   =>$dataheadB[$q]->HSN_CODE,
						'cgstrate'   =>$cgstNrate,
						'cgstamt'    =>$cgstNAmt,
						'igstrate'   =>$igstTrate,
						'igstamt'    =>$igstAmt,
						'sgstrate'   =>$sgstNrate,
						'sgstamt'    =>$sgstNAmt,
						'TCFLAG'     =>'R_IT',
						'CREATED_BY' => $userId,
					);

					DB::table('SIMULATION_TEMP')->insert($firstItm);
				}else{

					$previourAmtGet = DB::select("SELECT * from `SIMULATION_TEMP` WHERE `IND_CODE` = '$hsnCd' AND (igstrate = '$igstTrate' OR (sgstrate='$sgstNrate' AND cgstrate='$cgstNrate')) AND `TCFLAG` = 'R_IT' AND CREATED_BY='$userId'");


					if(empty($previourAmtGet)){
						$firstItm = array(
							'IND_CODE'   =>$dataheadB[$q]->HSN_CODE,
							'cgstrate'   =>$cgstNrate,
							'cgstamt'    =>$cgstNAmt,
							'igstrate'   =>$igstTrate,
							'igstamt'    =>$igstAmt,
							'sgstrate'   =>$sgstNrate,
							'sgstamt'    =>$sgstNAmt,
							'TCFLAG'     =>'R_IT',
							'CREATED_BY' => $userId,
						);

						DB::table('SIMULATION_TEMP')->insert($firstItm);
					}else{

						$NewAmtGet = DB::select("SELECT * from `SIMULATION_TEMP` WHERE `IND_CODE` = '$hsnCd' AND (igstrate = '$igstTrate' OR (sgstrate='$sgstNrate' AND cgstrate='$cgstNrate')) AND `TCFLAG` = 'R_IT' AND CREATED_BY='$userId'");

						$newSgstAmt  = $NewAmtGet[0]->sgstamt + $sgstNAmt;
						$newCgstAmt  = $NewAmtGet[0]->cgstamt + $cgstNAmt;
						$newIgstAmt  = $NewAmtGet[0]->igstamt + $igstAmt;

						$updateItm = array(
						
							'cgstamt'    =>$newCgstAmt,
							'igstamt'    =>$newIgstAmt,
							'sgstamt'    =>$newSgstAmt,
						);
						DB::table('SIMULATION_TEMP')->where('IND_CODE',$hsnCd)->where('igstrate',$igstTrate)->where('TCFLAG','R_IT')->where('CREATED_BY',$userId)->update($updateItm);
						DB::table('SIMULATION_TEMP')->where('IND_CODE',$hsnCd)->where('sgstrate',$sgstNrate)->where('TCFLAG','R_IT')->where('CREATED_BY',$userId)->update($updateItm);
						
					}

				}
			}

			for($r=0;$r<$taxCount;$r++){
				$taxIndCd   = $dataTax[$r]->TAXIND_CODE;
				$taxIndName = $dataTax[$r]->TAXIND_NAME;
				$taxAmount  = $dataTax[$r]->TAX_AMT;
				$rateInde   = $dataTax[$r]->RATE_INDEX;

				$checkExist = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','RT')->get()->toArray();

				$indData = DB::table('SIMULATION_TEMP')->where('IND_CODE',$taxIndCd)->where('CREATED_BY',$userId)->where('TCFLAG','RT')->get()->toArray();

				if(($rateInde != 'Z' && $rateInde!='-') || ($rateInde == 'Z' && $taxIndCd=='GT01')) {

					if(empty($checkExist)){
						$firstAM = array(
								'IND_CODE'    => $taxIndCd,
								'IND_NAME'    => $taxIndName,
								'CR_AMT'      => $taxAmount,
								'TCFLAG'      => 'RT',
								'CREATED_BY'  => $userId,
							
							);
						DB::table('SIMULATION_TEMP')->insert($firstAM);
					}else if(empty($indData)){

						$existAmt = array(
								'IND_CODE'    => $taxIndCd,
								'IND_NAME'    => $taxIndName,
								'CR_AMT'      => $taxAmount,
								'TCFLAG'      => 'RT',
								'CREATED_BY'  => $userId,
							
							);
						DB::table('SIMULATION_TEMP')->insert($existAmt);

					}else{

						$indData1 = DB::table('SIMULATION_TEMP')->where('IND_CODE',$taxIndCd)->where('TCFLAG','RT')->where('CREATED_BY',$userId)->get()->first();

						$newTaxAmt = $indData1->CR_AMT + $taxAmount;

						$newAMt = array(
							'CR_AMT'      => $newTaxAmt,
						);

						$updatevr = DB::table('SIMULATION_TEMP')->where('IND_CODE',$taxIndCd)->where('TCFLAG','RT')->where('CREATED_BY',$userId)->update($newAMt);
					}
				}
			} /* /.for loop*/		

			$taxDetail = DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','RT')->orwhere('TCFLAG','R_IT')->get()->toArray();

			$taxDCnt = count($taxDetail);
			$grandAmt;
			for($f=0;$f<$taxDCnt;$f++){
				
				if($taxDetail[$f]->IND_CODE == 'GT01'){
					$grandAmt = $taxDetail[$f]->CR_AMT;
				}
			}

			$dataConfig = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$tCode)->where('SERIES_CODE',$seriesCode)->get()->toArray();

			$this->ConvertAmountIntoWordForView($grandAmt,$tCode,$seriesCode,$dataheadB,$dataTax,$taxDetail,$pdfName,$dataConfig,$dataAccDetail,$consinerDetail,$compDetail,$vrPName,$seirsHeadLine);
                      
		}else{
			$response_array['response'] = 'error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);
		}

		

	}

	public function ConvertAmountIntoWordForView($grandAmt,$tCode,$seriesCode,$dataheadB,$dataTax,$taxDetail,$pdfName,$dataConfig,$dataAccDetail,$consinerDetail,$compDetail,$vrPName,$seirsHeadLine){

		$response_array = array();

		$num = str_replace(array(',', ' '), '' , trim($grandAmt));

	    //print_r($num);exit;
	    if(! $num) {
	        return false;
	    }
	    $num = (int) $num;
	    $words = array();
	    $list1 = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven',
	        'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
	    );
	    $list2 = array('', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety', 'Hundred');
	    $list3 = array('', 'Thousand', 'Million', 'Billion', 'Trillion', 'Quadrillion', 'Quintillion', 'Sextillion', 'Septillion',
	        'Octillion', 'Nonillion', 'Decillion', 'Nndecillion', 'Duodecillion', 'Tredecillion', 'Quattuordecillion',
	        'Quindecillion', 'Sexdecillion', 'Septendecillion', 'Octodecillion', 'Novemdecillion', 'Vigintillion'
	    );
	    $num_length = strlen($num);
	    $levels = (int) (($num_length + 2) / 3);
	    $max_length = $levels * 3;
	    $num = substr('00' . $num, -$max_length);
	    $num_levels = str_split($num, 3);
	    for ($i = 0; $i < count($num_levels); $i++) {
	        $levels--;
	        $hundreds = (int) ($num_levels[$i] / 100);
	        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
	        $tens = (int) ($num_levels[$i] % 100);
	        $singles = '';
	        if ( $tens < 20 ) {
	            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
	        } else {
	            $tens = (int)($tens / 10);
	            $tens = ' ' . $list2[$tens] . ' ';
	            $singles = (int) ($num_levels[$i] % 10);
	            $singles = ' ' . $list1[$singles] . ' ';
	        }
	        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
	    } //end for loop
	    $commas = count($words);
	    if ($commas > 1) {
	        $commas = $commas - 1;
	    }
	    //return implode(' ', $words);

	    $numwords= implode(' ', $words);

	    header('Content-Type: application/pdf');
     
    	$pdf = PDF::loadView('admin.finance.transaction.sales.sales_voucher_data_report',compact('dataheadB','dataTax','taxDetail','pdfName','dataConfig','dataAccDetail','consinerDetail','compDetail','vrPName','seirsHeadLine','numwords'));

    	$path = public_path('dist/downloadpdf'); 
    	$fileName =  time().'.'. 'pdf' ; 
    	$pdf->save($path . '/' . $fileName);
    	$PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['data'] = $dataheadB;
        echo $data = json_encode($response_array);

	}

/* ------------ download pdf for purchase view -------------------*/

/* --------- create entry in USER_LOG when user submit any form ------*/
	
	function userLogInsert($loginuserId,$transCode,$seriesCode,$vrno,$perticular,$acc_code){
		
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
				'TRAN_CODE'   =>$transCode,
				'SERIES_CODE' =>$seriesCode,
				'ACC_CODE'    =>$acc_code,
				'VRNO'        =>$vrno,
				'PERTICULAR'  =>$discptn,
				'CREATED_BY'  =>$loginuserId
			);
			DB::table('USER_LOG')->insert($userLog);
		
	}

/* --------- create entry in USER_LOG when user submit any form ------*/


}
