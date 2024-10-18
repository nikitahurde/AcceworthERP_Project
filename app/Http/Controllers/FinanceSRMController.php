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


class FinanceSRMController extends Controller
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

	public function CRMEnquiryTrans(Request $request){

		$title      ='Add Sales Enquiry';

		/*$CompanyCode   = $request->session()->get('company_name');
		$compcode = explode('-', $CompanyCode);
		$getcompcode=	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');
*/
		$userdata['series_list'] = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'S0'])->get();

		$userdata['item_list'] = DB::table('MASTER_ITEM')->get();

		$acc_list      =  DB::table('MASTER_ACC')->get();
		$tax_code_list =  DB::table('MASTER_TAX')->get();
		//DB::enableQueryLog();
		
		

		$vr_No_list = DB::table('MASTER_VRSEQ')->where(['TRAN_CODE'=>'S0'])->get();

		//print_r($vr_No_list);exit;

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

		//print_r($userdata);exit;

		return view('admin.finance.transaction.crm.crm_enquery_trans',$userdata+compact('title','acc_list','tax_code_list'));
		
	}

	public function SaveCrmEnquiry(Request $request){


			$createdBy     = $request->session()->get('userid');
			$trans_code    = $request->input('trans_code');
			$series_code   = $request->input('series_code');
			$acc_code      = $request->input('accountCode');
			$vr_no         = $request->input('vr_no');
			$trans_date    = $request->input('trans_date');
			$tr_vr_date    = date("Y-m-d", strtotime($trans_date));
			$getduedate    = $request->input('getdue_date');
			$dueDate       = date("Y-m-d", strtotime($getduedate));
			$accountCode   = $request->input('accountCode');
			$item_code     = $request->input('item_code');
			$countItemCode = count($item_code);
			$item_name     = $request->input('item_name');
			$remark        = $request->input('remark');
			$qty           = $request->input('qty');
			$unit_M        = $request->input('unit_M');
			$Aqty          = $request->input('Aqty');
			$add_unit_M    = $request->input('add_unit_M');
			$rate          = $request->input('rate');
			$basic_amt     = $request->input('basic_amt');
			$hsn_code      = $request->input('hsn_code');
			$enqacc_code   = $request->input('enqacc_code');
			$enqacc_name   = $request->input('enqacc_name');
			$city_name     = $request->input('city_name');
			$contact_no    = $request->input('contact_no');
			$quaP_count    = $request->input('quaP_count');
			$allquaPcount  = $request->input('allquaPcount');
			$partyrefNo    = $request->input('party_ref_no');
			$partyrefDate  = $request->input('party_ref_date');
			$party_ref_Date = date("Y-m-d", strtotime($partyrefDate));
			$consineCode   = $request->input('consine_code');

			$donwloadStatus   = $request->input('donwloadStatus');

			$PEnqH = DB::select("SELECT MAX(CRMENQHID ) as CRMENQHID  FROM CRM_ENQ_HEAD");
			$head_ID = json_decode(json_encode($PEnqH), true); 
		
			if(empty($head_ID[0]['CRMENQHID '])){
				$headId = 1;
			}else{
				$headId = $head_ID[0]['CRMENQHID ']+1;
			}

			if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}

			$vrno_Exist = DB::table('CRM_ENQ_HEAD')->where('SERIES_CODE',$series_code)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

			$data = array(

				'CRMENQHID'   =>$headId,
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'ACC_CODE'    =>$acc_code,
				'VRNO'        =>$NewVrno,
				'SLNO'        =>1,
				'VRDATE'      =>$tr_vr_date,
				'CPCODE'      =>$consineCode,
				'DUEDATE'     =>$dueDate,
				'CREATED_BY'  =>$createdBy,

			);
		
			$saveDataH = DB::table('CRM_ENQ_HEAD')->insert($data);

			$datalistrray = array();

			for ($i=0; $i < $countItemCode; $i++) { 

				$PEnqB = DB::select("SELECT MAX(CRMENQBID) as CRMENQBID FROM CRM_ENQ_BODY");
				$body_ID = json_decode(json_encode($PEnqB), true); 
		
				if(empty($body_ID[0]['CRMENQBID'])){
					$bodyId = 1;
				}else{
					$bodyId = $body_ID[0]['CRMENQBID']+1;
				}

		
				$slno  =$i+1;
				$data_body = array(
				
					'CRMENQHID'   =>$headId,
					'CRMENQBID'   =>$bodyId,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'VRNO'        =>$NewVrno,
					'SLNO'        =>$slno,
					'VRDATE'      =>$tr_vr_date,
					'ITEM_CODE'   =>$item_code[$i],
					'ITEM_NAME'   =>$item_name[$i],
					'PARTICULAR'  =>$remark[$i],
					'QTYRECD'     =>$qty[$i],
					'UM'          =>$unit_M[$i],
					'AQTYRECD'    =>$Aqty[$i],
					'AUM'         =>$add_unit_M[$i],
					'CREATED_BY'  =>$createdBy,
				);
				$saveDataB = DB::table('CRM_ENQ_BODY')->insert($data_body);

				

				 /* /. vendor */

		    }/*-- for loop close --*/


		   /* /. quality parameter */

		    $checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->get()->toArray();

		    if(empty($checkvrnoExist)){

				$datavrnIn =array(
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->update($datavrn);
			}

			$headtable    = 'CRM_ENQ_HEAD';
			$bodytable    = 'CRM_ENQ_BODY';
			$columnheadid = 'CRMENQHID';

			if ($saveDataH && $saveDataB) {


				if($donwloadStatus == 1){

				return $this->GeneratePdfForSaleEnq($compCode,$headId,$headtable,$bodytable,$columnheadid);

			}else{

				/*$filename = 'download.pdf';

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
		        $mailer->ClearAllRecipients();*/

				$response_array['response'] = 'success';

            	$data = json_encode($response_array);

          		  print_r($data);
			}



			}else{

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

    public function ViewSrmEnquiryTransaction (Request $request){

     	$compName = $request->session()->get('company_name');

        if($request->ajax()) {
    
            $title ='View Enquiry';
    
            $userid    = $request->session()->get('userid');
            $acc_code    = $request->session()->get('acc_code');

            //print_r($acc_code);exit;
    
            $userType = $request->session()->get('usertype');
    
           /* $compName = $request->session()->get('company_name');

            $compcode    = explode('-', $compName);

			$getcompcode =	$compcode[0];
    
            $fisYear =  $request->session()->get('macc_year');*/
    
           if($userType=='superAdmin' || $userType=='user' || $userType=='SRM'){
    
               /*$data = DB::table('enquiry_head')->orderBy('id','DESC');*/

               /*$data = DB::table('SENQ_HEAD')
				->select('SENQ_HEAD.*', 'MASTER_CONFIG.SERIES_NAME AS series_name')
           		->leftjoin('MASTER_CONFIG', 'MASTER_CONFIG.SERIES_CODE', '=', 'SENQ_HEAD.SERIES_CODE')
           		->orderBy('SENQ_HEAD.SENQHID','DESC');*/
           //	DB::enableQueryLog();

			   /*$data =  DB::select("SELECT t1.VRNO,t1.TRAN_CODE,t1.VRDATE,t1.SERIES_CODE,t1.PENQHID,t1.QTNCOMP_STATUS,t2.SERIES_NAME FROM PENQ_HEAD t1 LEFT JOIN MASTER_CONFIG t2 ON t2.SERIES_CODE = t1.SERIES_CODE");*/

			   $data=DB::select("SELECT PENQ_HEAD.*,MASTER_CONFIG.SERIES_NAME,MASTER_PLANT.PLANT_NAME,MASTER_PFCT.PFCT_NAME,PENQ_VENDOR.PENQHID as enqHid,PENQ_VENDOR.PQTNHID,PENQ_VENDOR.PQTNBID,group_concat(concat(PENQ_VENDOR.PQTNHID))AS PQuoSTATUSHD,group_concat(concat(PENQ_VENDOR.PQTNBID))AS PQuoSTATUSBD FROM PENQ_HEAD LEFT JOIN PENQ_VENDOR ON PENQ_VENDOR.PENQHID = PENQ_HEAD.PENQHID LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE=PENQ_HEAD.SERIES_CODE LEFT JOIN MASTER_PLANT ON MASTER_PLANT.PLANT_CODE=PENQ_HEAD.PLANT_CODE LEFT JOIN MASTER_PFCT ON MASTER_PFCT.PFCT_CODE=MASTER_PFCT.PFCT_CODE WHERE PENQ_VENDOR.ACC_CODE='$acc_code' GROUP BY PENQ_HEAD.PENQHID");

			// dd(DB::getQueryLog());
            }
            else{
    
                $data='';
                
            }
                return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();
        }

        return view('admin.finance.transaction.srm.view_srm_enquiry_transaction');

        
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

		if ($saveData) {

			$request->session()->flash('alert-success', 'Enquiry Was Successfully Added...!');
			return redirect('/Transaction/Sales/View-Sales-Enquery-Trans');

		} else {

			$request->session()->flash('alert-error', 'Enquiry Can Not Added...!');
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

		$userdata['enq_list'] = DB::table('SENQ_BODY')->get();

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
	    		$itemListData = DB::select("SELECT t1.*,t2.* FROM SENQ_VENDOR t2 LEFT JOIN SENQ_BODY t1 ON t1.SENQHID = t2.SENQHID AND t1.SENQBID=t2.SENQBID WHERE t1.VRNO='$enquiryno' AND t2.ACC_CODE='$accnum' AND t2.VRNO='$enquiryno' AND t1.SERIES_CODE='$seriesEnq' AND t1.COMP_CODE='$getcom_code' AND t1.FY_CODE='$fisYear' AND t2.SQTN_FLAG='0'");
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
				$itemListData = DB::select("SELECT t1.*,t2.* FROM SENQ_VENDOR t2 LEFT JOIN SENQ_BODY t1 ON t1.SENQHID = t2.SENQHID AND t1.SENQBID=t2.SENQBID WHERE t1.VRNO='$enquiryno' AND t2.ACC_CODE='$accnum' AND t2.VRNO='$enquiryno' AND t1.SERIES_CODE='$seriesEnq' AND t1.COMP_CODE='$getcom_code' AND t1.FY_CODE='$fisYear' AND t2.SQTN_FLAG='0'");
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


    



	public function SaleQuoSaveMsg(Request $request,$saveData){
	 //	print_r($savedata);exit;
		if ($saveData) {

			$request->session()->flash('alert-success', 'Sale Quotation Was Successfully Added...!');
			return redirect('/Transaction/Sales/View-Sales-Quotation-Trans');

		} else {

			$request->session()->flash('alert-error', 'Sale Quotation Can Not Added...!');
			return redirect('/Transaction/Sales/View-Sales-Quotation-Trans');

		}
	}


	public function ViewSrmQuotation(Request $request){

		

	     if($request->ajax()) {

	        $title ='View Sale Quatation';

	        $userid    = $request->session()->get('userid');

	        $acc_code    = $request->session()->get('acc_code');

	        $userType = $request->session()->get('usertype');

           		
           	if($userType=='superAdmin' || $userType=='user' || $userType=='SRM'){

              
	         	$data = DB::select("SELECT PQTN_HEAD.*,MASTER_CONFIG.SERIES_NAME,MASTER_PLANT.PLANT_NAME,PQTN_BODY.PQTNHID as pquoHid,PQTN_BODY.PQCS_FLAG,group_concat(concat(PQTN_BODY.PQCS_FLAG))AS PQcSTATUSHD FROM PQTN_HEAD LEFT JOIN PQTN_BODY ON PQTN_BODY.PQTNHID = PQTN_HEAD.PQTNHID LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE=PQTN_HEAD.SERIES_CODE LEFT JOIN MASTER_PLANT ON MASTER_PLANT.PLANT_CODE=PQTN_HEAD.PLANT_CODE WHERE PQTN_HEAD.ACC_CODE='$acc_code' GROUP BY PQTN_HEAD.PQTNHID");
 				

	        }
	        else{

	            $data='';
	            
	        }
	        //return DataTables()->of($data)->addIndexColumn()->make(true);
	    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }

	    

	       return view('admin.finance.transaction.srm.view_srm_quotation');
	    
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



    public function CRMOrderTrans(Request $request)
    {

		$title       ='CRM Order Transaction';
		
		$tableData = MyConstruct();

		$userdata['acc_list']     = $tableData['master_party'];
		$userdata['taxcode_list'] = $tableData['master_tax'];
		$userdata['plant_list']   = $tableData['master_plant'];
		$userdata['item_list']    = $tableData['master_item'];
		$userdata['ratval_list']  = $tableData['master_rateValue'];
		$userdata['sale_rep_list'] = $tableData['sale_rep_code'];
		$userdata['cost_list']     = $tableData['master_cost'];
		$transCode   = 'S3';

		//$getCommonData = MyCommonFun($transCode);

		$userdata['series_list'] = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$transCode)->get();

		 

		/*foreach ($getCommonData['getdate'] as $fydata) {

			$userdata['fromDate'] =  $fydata->FY_FROM_DATE;
			$userdata['toDate']   =  $fydata->FY_TO_DATE;
			
		}	*/

		$ordrVrno = DB::table('SORDER_HEAD')->get();

		   	$vrseqnum = '';
			foreach ($ordrVrno as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;


		$vr_No_list = DB::table('MASTER_VRSEQ')->where(['TRAN_CODE'=>$transCode])->get();

		//print_r($vr_No_list);exit;

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

		    return view('admin.finance.transaction.crm.crm_order_trans',$userdata+compact('title'));
	
    }

    public function getVrnoSeriesBytransCrm(Request $request){

		$response_array = array();

		$transCode   = $request->input('transCode');
		$seriesCode   = $request->input('seriesCode');
		

		if ($request->ajax()) {


			$series_list = DB::table('MASTER_CONFIG')->where([['SERIES_CODE','=',$seriesCode]])->get();

			$fetch_vrno_reocrd = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transCode)->where('SERIES_CODE',$seriesCode)->get()->first();

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


    public function ViewSrmOrderTransaction(Request $request){

 		$compName = $request->session()->get('company_name');

     	if($request->ajax()) {

	        $title ='View Master Account';

	        $userid    = $request->session()->get('userid');

	        $acc_code    = $request->session()->get('acc_code');

	        $userType = $request->session()->get('usertype');



           	if($userType=='superAdmin' || $userType=='user' || $userType=='SRM'){

	          $data =DB::select("SELECT PORDER_HEAD.*,PORDER_BODY.PORDERHID as podrHid,PORDER_BODY.PORDERBID,PORDER_BODY.GRNHID,PORDER_BODY.GRNBID,MASTER_CONFIG.SERIES_NAME,MASTER_PLANT.PLANT_NAME,MASTER_ACC.ACC_NAME,group_concat(concat(PORDER_BODY.GRNHID))AS PORDRTATUSHD,group_concat(concat(PORDER_BODY.GRNBID))AS  PORDRTATUSBD FROM PORDER_HEAD LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE=PORDER_HEAD.SERIES_CODE LEFT JOIN MASTER_PLANT ON MASTER_PLANT.PLANT_CODE=PORDER_HEAD.PLANT_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE=PORDER_HEAD.ACC_CODE LEFT JOIN PORDER_BODY ON PORDER_BODY.PORDERHID = PORDER_HEAD.PORDERHID WHERE PORDER_HEAD.ACC_CODE ='$acc_code'  GROUP BY PORDER_HEAD.PORDERHID");
	        }
	        else{

	            $data='';
	            
	        }

    		return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();


    	}

    	
       		return view('admin.finance.transaction.srm.view_srm_order_trans');
    	
        
	}



	public function SrmGrnReport(Request $request){


        $title = "Srm Grn Report";

       
        $usertype      = $request->session()->get('user_type');
        $userid        = $request->session()->get('userid');

        
        $item_um_aum_list = DB::table('MASTER_FY')->get();

        $userdata['contract_list'] = DB::select("SELECT SCHALLAN_HEAD.VRDATE,SCHALLAN_HEAD.PREFNO,SCHALLAN_HEAD.PREFDATE,SCHALLAN_BODY.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID  GROUP BY SCHALLAN_BODY.SCHALLANHID");

            //print_r($userdata['contract_list']);exit;

        foreach ($item_um_aum_list as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }

        $bank_list       = DB::table('MASTER_CONFIG')->where('TRAN_CODE', '=','A0')->orWhere('TRAN_CODE', '=','A1')->get();

       
       // $transpoter_list = DB::table('MASTER_ACC')->get();
        $item_list       = DB::table('MASTER_ITEM')->get();

        $acc_list        = DB::table('MASTER_ACC')->get();

                    $yearbeg = date("Y"); 
					$yearendd = $yearbeg + 1; 

					$yearstart = '01-04'.'-'.$yearbeg;

       				$yearend = '31-03'.'-'.$yearendd;

       
            return view('admin.finance.transaction.srm.srm_grn_report',$userdata+compact('title','bank_list','item_list','acc_list','yearstart','yearend'));
        



    }



    public function getDataFromQueryFormSrmGrn(Request $request){

            if (!empty($request->seriesCodeOperator || $request->seriesCodeValue || $request->plantCodeOperator || $request->plantCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->accCodeOperator || $request->accCode || $request->costCetOperator || $request->costCetCode || $request->QtyOperator || $request->QtyValue || $request->from_date || $request->to_date || $request->item_code || $request->vr_num || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');

                $company_name = $request->session()->get('company_name');
                $getcomcode   = explode('-', $company_name);
                $comp_code    = $getcomcode[0];
                $macc_year    = $request->session()->get('macc_year');
                $loginUser    = $request->session()->get('userid');
                $vrseqNum     = $request->vr_num;
                $series_code  = $request->seriesCodeValue;
                $accountCode  = $request->accCode;
                $acc_code   = $request->session()->get('acc_code');
                $strWhere = '';

              
                if(isset($request->plantCodeOperator)  && trim($request->plantCodeValue)!=""){
                   
                    $strWhere .= " AND  GRN_BODY.PLANT_CODE ".$request->plantCodeOperator." '".$request->plantCodeValue."'";
                } 


                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeValue)!=""){
                    
                    $strWhere .= " AND  GRN_HEAD.SERIES_CODE ".$request->seriesCodeOperator." '".$request->seriesCodeValue."'";
                }

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterValue)!=""){
                    
                    $strWhere .= " AND  GRN_HEAD.PFCT_CODE ".$request->profitCenterOperator." '".$request->profitCenterValue."'";
                }

                if(isset($request->costCetOperator)  && trim($request->costCetCode)!=""){
                    
                    $strWhere .= " AND  GRN_HEAD.COST_CENTER ".$request->costCetOperator." '".$request->costCetCode."'";
                }

                if(isset($request->accCodeOperator) && trim($request->accCode)!=""){
                  
                    $strWhere .= " AND  GRN_HEAD.ACC_CODE ".$request->accCodeOperator." '".$request->accCode."'";

                }

                if(isset($request->item_code)  && trim($request->item_code)!=""){
                    $strWhere .= " AND  GRN_BODY.ITEM_CODE = '".$request->item_code."'";
                }

                if(isset($request->QtyOperator)  && trim($request->QtyValue)!=""){
                    $strWhere .= " AND  GRN_BODY.QTYRECED ".$request->QtyOperator." '".$request->QtyValue."'";
                }

                if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  GRN_BODY.VRDATE BETWEEN '".$FromDt."' and  '".$ToDt."'";
                }


                if(isset($comp_code) && isset($macc_year)){
                  
                    $strWhere .= " AND  GRN_HEAD.COMP_CODE = '".$comp_code."' AND GRN_HEAD.FY_CODE = '".$macc_year."'";

                }

                

                //DB::enableQueryLog();
                
                    $data = DB::select("SELECT GRN_HEAD.VRDATE,GRN_HEAD.VRNO,GRN_HEAD.TRAN_CODE,GRN_HEAD.SERIES_CODE,GRN_HEAD.PLANT_CODE,GRN_HEAD.PFCT_CODE,GRN_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME,GRN_BODY.ITEM_CODE,GRN_BODY.ITEM_NAME,GRN_BODY.QTYRECED,GRN_BODY.UM_CODE,GRN_BODY.AQTYRECD,GRN_BODY.AUM_CODE,if(GRN_BODY.PBILLHID != '0' && GRN_BODY.PBILLBID != '0','Complete',' '),GRN_BODY.TAX_CODE,GRN_TAX_VIEW.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN GRN_TAX_VIEW ON GRN_TAX_VIEW.GRNBID = GRN_BODY.GRNBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere AND GRN_BODY.PBILLHID != 0 AND GRN_BODY.PBILLBID != 0 AND GRN_HEAD.ACC_CODE='$acc_code'");

               //	dd(DB::getQueryLog());

                //dd(DB::getQueryLog());
                 // $data = DB::select("SELECT GRN_HEAD.VRDATE,GRN_HEAD.SERIES_CODE AS SERIES_CODE,GRN_HEAD.PREFNO,GRN_HEAD.PREFDATE,GRN_HEAD.ACC_CODE AS ACC_CODE,GRN_HEAD.PFCT_CODE AS PFCT_CODE,GRN_BODY.*,MASTER_ACC.* FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = GRN_HEAD.ACC_CODE WHERE 1=1 $strWhere");

                //dd(DB::getQueryLog());

                $discriptn_page = "Search GRN report by user";
              //  $this->userLogInsert($loginUser,$GrnVrno,$series_code,$discriptn_page,$accountCode);

                return DataTables()->of($data)->addIndexColumn()->make(true);
                       
               

            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
                
               

            }


    }


    public function getDataFromQueryFormSrmGrn1(Request $request){


        if($request->ajax()) {

           if (!empty($request->plantCodeOperator || $request->plantCodeValue || $request->seriesCodeOperator || $request->seriesCodeValue || $request->profitCenterOperator || $request->profitCenterValue || $request->QtyOperator || $request->QtyValue || $request->accCodeOperator || $request->accCode  || $request->bank_code  || $request->vr_num || $request->item_code || $request->from_date || $request->to_date || $request->ReportTypes)) {

                date_default_timezone_set('Asia/Kolkata');
                
                $strWhere = '';

                $loginUser   = $request->session()->get('userid');
                $acc_code   = $request->session()->get('acc_code');
                $vrseqNum    =  $request->vr_num;
                $accountCode =  $request->accCode;
                $seriesCode  = $request->seriesCodeValue;
                if(isset($request->seriesCodeOperator)  && trim($request->seriesCodeOperator)!=""){
                   
                    $strWhere .= " AND  SCHALLAN_BODY.SERIES_CODE $request->seriesCodeOperator '$request->seriesCodeValue'";


                } 

                if(isset($request->plantCodeOperator)  && trim($request->plantCodeOperator)!=""){
                   
                    $strWhere .= " AND  SCHALLAN_HEAD.PLANT_CODE $request->plantCodeOperator '$request->plantCodeValue'";

                    
                } 

                if(isset($request->profitCenterOperator)  && trim($request->profitCenterOperator)!=""){
                    
                    $strWhere .= " AND  SCHALLAN_BODY.PFCT_CODE $request->profitCenterOperator '$request->profitCenterValue'";
                }

                if(isset($request->QtyOperator)  && trim($request->QtyOperator)!=""){
                    
                    $strWhere .= " AND  SCHALLAN_BODY.QTYRECD $request->QtyOperator '$request->QtyValue'";
                }

                if(isset($request->accCodeOperator)  && trim($request->accCodeOperator)!=""){
                    $strWhere .= " AND  SCHALLAN_HEAD.ACC_CODE $request->accCodeOperator '$request->accCode'";
                }

               
                if(isset($request->item_code) && trim($request->item_code)!=""){
                  
                    $strWhere .= " AND  SCHALLAN_BODY.ITEM_CODE = '$request->item_code'";

                }

                if(isset($request->vr_num) && trim($request->vr_num)!=""){
                    
                    $strWhere .= " AND  SCHALLAN_BODY.VRNO = '$request->vr_num'";
                }

              	if(isset($request->to_date) && trim($request->to_date)!="" && isset($request->from_date)){

                    $ToDt = date("Y-m-d", strtotime($request->to_date));

                    $FromDt = date("Y-m-d", strtotime($request->from_date));

                    $strWhere .= " AND  SCHALLAN_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
                }

                  
                 if(isset($request->comp_code) && isset($request->macc_year)){
                  
                  $strWhere .= " AND  SCHALLAN_HEAD.COMP_CODE = '".$this->comp_code."' AND SCHALLAN_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }

              /*   $data = DB::select("SELECT SCHALLAN_HEAD.PLANT_CODE AS plantCode,SCHALLAN_HEAD.VRDATE,SCHALLAN_HEAD.SERIES_CODE  AS seriesCode,SCHALLAN_HEAD.PREFNO,SCHALLAN_HEAD.PREFDATE,SCHALLAN_HEAD.ACC_CODE AS accCode,SCHALLAN_HEAD.PFCT_CODE AS pfctCode,SCHALLAN_BODY.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID WHERE 1=1 $strWhere");*/
               // DB::enableQueryLog();


                $data = DB::select("SELECT SCHALLAN_HEAD.PLANT_CODE AS plantCode,SCHALLAN_HEAD.VRDATE,SCHALLAN_HEAD.SERIES_CODE  AS seriesCode,SCHALLAN_HEAD.PREFNO,SCHALLAN_HEAD.PREFDATE,SCHALLAN_HEAD.ACC_CODE AS accCode,SCHALLAN_HEAD.PFCT_CODE AS pfctCode,SCHALLAN_BODY.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID WHERE 1=1 $strWhere AND SCHALLAN_BODY.SBILLHID = '0' AND SCHALLAN_BODY.SBILLBID = '0' AND ACC_CODE='$acc_code'");

               // dd(DB::getQueryLog());


                 
                //dd(DB::getQueryLog());
                $discriptn_page = "Search sale pgi/chllan report by user";
             //   $this->userLogInsert($loginUser,$vrseqNum,$seriesCode,$discriptn_page,$accountCode); 
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


public function ReportLedger(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->acct_code || $request->pfct_code || $request->glC_code || $request->vr_num)) {

					$acct_code = $request->acct_code;
					$pfct_code = $request->pfct_code;
					$glC_code  = $request->glC_code;
					$vr_num    = $request->vr_num;
					$from_date = $request->from_date;
					

					$yearbeg = date("Y"); 
					$yearendd = $yearbeg + 1; 

					//print_r($yearendd);exit;

					$yearstart = '01-04'.'-'.$yearbeg;

       				$yearend = '31-03'.'-'.$yearendd;

       				$backYear =  $yearstart.'-'.$yearend;

       				$bgdate     = $yearstart;

       				$yrbgdate = date("Y-m-d", strtotime($bgdate));
					

					//print_r($year + 1);exit;
               
               /* $company_name     = $request->session()->get('company_name');
                $bgdate     = $request->session()->get('yrbgdate');
                $yrbgdate = date("Y-m-d", strtotime($bgdate));
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];
                $macc_year = $request->session()->get('macc_year');
                $ExYEar    = explode('-', $macc_year);
                $yearstart =  $ExYEar[0]-1;
                $yearend   =  $ExYEar[1]-1;
                $backYear =  $yearstart.'-'.$yearend*/;
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));
                $to_date1   = date("Y-m-d", strtotime($request->to_date));

              //  DB::table('acc_ledger_temp')->truncate();

                $strwhere='';
                /*if(isset($from_date1)  && trim($from_date1)!="")
                {
                    	$strwhere .="AND VRDATE BETWEEN '$from_date1' AND '$to_date1'";
                }*/

                if(isset($acct_code)  && trim($acct_code)!="")
                {
                 		$strwhere .= "AND ACC_CODE='$acct_code'";
                 		$strwhere1= "ACC_CODE";
                }


             	if(isset($pfct_code)  && trim($pfct_code)!="")
             	{
             		$strwhere .= "AND PFCT_CODE='$pfct_code'";
             	}

             	if(isset($glC_code)  && trim($glC_code)!="")
             	{
             		$strwhere .= "AND GL_CODE='$glC_code'";
             		$strwhere1= "GL_CODE";
             	}

             	if(isset($vr_num)  && trim($vr_num)!="")
             	{
             		$strwhere .= "AND VRNO ='$vr_num'";
             	}
             	


             
          /*	if($acct_code){
             		$post_code='t.acc_code as acc_code';
             	}else{
             		$post_code='t.gl_code as gl_code,t.acc_code as acc_code';
             	}*/
             

		//dd(DB::getQueryLog());

          	//DB::enableQueryLog();   	

             if($acct_code){

               $data = DB::select("SELECT t.VRDATE,t.VRNO,format(t.drAmt,2,'en_IN') as DrAmt, format(t.cramt,2,'en_IN') as CrAmt, if(t.drAmt>0,format(@running_total:=@running_total + t.drAmt,2,'en_IN'),format(@running_total:=@running_total - t.cramt,2,'en_IN')) AS balence,if(t.dramt>t.cramt,'Dr','Cr') as BalType, t.particular as particular,t.instrument_type as instrument_type,t.instrument_no as instrument_no,t.fy_code as fy_code,t.series_code as series_code,t.TRAN_CODE as TRAN_CODE, t.REF_CODE,t.REF_NAME,t.acc_code as acc_code FROM 
				(
				SELECT '$from_date1' AS vrdate,'Op-Bal' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as fy_code,'' as series_code,''as TRAN_CODE, if(if(b.dramt>0,b.dramt,0) - if(b.cramt>0,b.cramt,0) >0,b.dramt- if(b.cramt>0,b.cramt,0),0) as dramt, if(if(b.cramt>0,b.cramt,0) - if(b.dramt>0,b.dramt,0) >0,b.cramt- if(b.dramt>0,b.dramt,0),0) as CrAmt,'' as REF_CODE,'' as REF_NAME FROM    
				(
				SELECT '$from_date1' AS vrdate,'Op-Bal' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as fy_code,'' as series_code,''as TRAN_CODE, sum(a.dramt) as drAmt, sum(a.cramt) as  CrAmt,'' as REF_CODE,'' as REF_NAME FROM 
				((    
#Bring year opening balance
			SELECT '$from_date1' AS vrdate,'Opening' as vrno,'' as BalType,'' as particular,'' as instrument_type,'' as instrument_no,'' as acc_code,'' as fy_code,'' as series_code,''as TRAN_CODE, yropdr as dramt,yropcr as CrAmt,'' as REF_CODE,'' as REF_NAME FROM MASTER_ACCBAL WHERE  acc_code='$acct_code')
			UNION
#Bring transactions during year opening and before from date
			SELECT '$from_date1' as vrdate, 'Before Date'  as vrno,'' as BalType,particular as particular,'' as instrument_type,'' as instrument_no,acc_code as acc_code,fy_code as fy_code,series_code as series_code,TRAN_CODE as TRAN_CODE,sum(dramt) as drAmt, sum(cramt) as cramt,'' as REF_CODE,'' as REF_NAME FROM ACC_TRAN WHERE 1=1 $strwhere AND vrdate BETWEEN '$yrbgdate' AND DATE_SUB('$from_date1',INTERVAL 1 DAY) ) a) b
			UNION    
			SELECT date(VRDATE) as vrdate,VRNO as vrno,'' as BalType,particular as particular,'' as instrument_type,'' as instrument_no,acc_code as acc_code,fy_code as fy_code,series_code as series_code,TRAN_CODE as TRAN_CODE, dramt as drAmt,cramt as cramt,REF_CODE as REF_CODE,REF_NAME as REF_NAME FROM ACC_TRAN where 1=1 $strwhere AND VRDATE BETWEEN '$from_date1' AND '$to_date1'  ORDER BY vrdate
			)t JOIN (SELECT @running_total:=0) r");

            //   dd(DB::getQueryLog());

           }

           	$serieCD='';
           	$discriptn_page = "Search account ledger report by user";
		//	$this->userLogInsert($userid,$serieCD,$vr_num,$acct_code,$discriptn_page,$glC_code);

               return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

            

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

      /*  $company_name     = $request->session()->get('company_name');
         $macc_year         = $request->session()->get('macc_year');
         $ExYEar    = explode('-', $macc_year);
         $yearstart =  $ExYEar[0]-1;
         $yearend   =  $ExYEar[1]-1;
         $backYear =  $yearstart.'-'.$yearend;*/
        $usertype     = $request->session()->get('user_type');
        $userid    = $request->session()->get('userid');
        $acc_code    = $request->session()->get('acc_code');

      /*  $getcomcode    = explode('-', $company_name);
        $CCFromSession = $getcomcode[0];*/

        $getdate = DB::table('MASTER_FY')->get();

            foreach ($getdate as $key) {
                $userdata['fromDate'] =  $key->FY_FROM_DATE;
                $userdata['toDate']   =  $key->FY_TO_DATE;
            }


            
		$title = 'Acc Ledger Report';
		

        $acc_led_list = DB::table('GL_TRAN')->get();

                    $yearbeg = date("Y"); 
					$yearendd = $yearbeg + 1; 

					//print_r($yearendd);exit;

					$yearstart = '01-04'.'-'.$yearbeg;

       				$yearend = '31-03'.'-'.$yearendd;

       				$backYear =  $yearstart.'-'.$yearend;

       				$bgdate     = $yearstart;

       				$yrbgdate = date("Y-m-d", strtotime($bgdate));
        
        return view('admin.finance.transaction.crm.crm_ledger_report',$userdata+compact('title','acc_code','yearstart','yearend'));
        
    }


     public function SummaryReportAccLedger(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->acct_code || $request->pfct_code || $request->glC_code || $request->vr_num)) {

					$acct_code = $request->acct_code;
					$pfct_code = $request->pfct_code;
					$glC_code  = $request->glC_code;
					$vr_num    = $request->vr_num;
					$from_date = $request->from_date;
					
                
               /* $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];


                $macc_year = $request->session()->get('macc_year');
                $ExYEar    = explode('-', $macc_year);*/
                	$yearbeg = date("Y"); 
					$yearendd = $yearbeg + 1;
                
                    $yearstart = '01-04'.'-'.$yearbeg;

       				$yearend = '31-03'.'-'.$yearendd;

       				$backYear =  $yearstart.'-'.$yearend;

       				$bgdate     = $yearstart;

       				$yrbgdate = date("Y-m-d", strtotime($bgdate));
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));
                $to_date1   = date("Y-m-d", strtotime($request->to_date));

              //  DB::table('acc_ledger_temp')->truncate();

                $strwhere='';
                /*if(isset($from_date1)  && trim($from_date1)!="")
                {
                    	$strwhere .="AND VRDATE BETWEEN '$from_date1' AND '$to_date1'";
                }*/

                if(isset($acct_code)  && trim($acct_code)!="")
                {
                 		$strwhere .= "AND ACC_CODE='$acct_code'";
                 		$strwhere1= "ACC_CODE";
                }


             	if(isset($pfct_code)  && trim($pfct_code)!="")
             	{
             		$strwhere .= "AND PFCT_CODE='$pfct_code'";
             	}

             	if(isset($glC_code)  && trim($glC_code)!="")
             	{
             		$strwhere .= "AND GL_CODE='$glC_code'";
             		$strwhere1= "GL_CODE";
             	}

             	if(isset($vr_num)  && trim($vr_num)!="")
             	{
             		$strwhere .= "AND VRNO ='$vr_num'";
             	}
             	

             if($acct_code){

             //DB::enableQueryLog();

               $data = DB::select("SELECT t.YYYYMM, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, format(@running_total:=@running_total + t.yropdr - t.yropcr + t.yrdramt - t.yrcramt ,2,'en_IN') AS balence
               	FROM
				(
				SELECT ' Yr. Op.' AS YYYYMM, if(yropdr is NULL,0,yropdr) as yropdr, if(yropcr is NULL,0,yropcr) as yropcr, 0 as yrdramt, 0 as yrcramt FROM MASTER_ACCBAL WHERE  ACC_CODE='$acct_code'
				UNION
				SELECT a.YYYYMM AS YYYYMM, SUM(a.YROPDR) AS YEOPDR, SUM(a.YROPCR) AS YROPCR, SUM(a.YRDRAMT) AS YRDRAMT, SUM(a.YRCRAMT) AS YRCRAMT FROM
				(
				SELECT CONCAT(YEAR(VRDATE),'-',MONTH(VRDATE)) as YYYYMM, '' as yropdr, '' as yropcr, if(dramt is NULL,0,dramt) as yrdramt, if(cramt is NULL,0,cramt) as yrcramt FROM ACC_TRAN WHERE 1=1 $strwhere AND vrdate BETWEEN '$from_date1' AND '$to_date1'
				) a) t JOIN (SELECT @running_total:=0) r ORDER BY yyyymm");

             //print_r($data);exit;

               // dd(DB::getQueryLog());

           }

                   
               return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

            

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

       /* $company_name     = $request->session()->get('company_name');
         $macc_year         = $request->session()->get('macc_year');
         $ExYEar    = explode('-', $macc_year);
         $yearstart =  $ExYEar[0]-1;
         $yearend   =  $ExYEar[1]-1;
         $backYear =  $yearstart.'-'.$yearend;*/
                  $yearstart = '01-04'.'-'.$yearbeg;

       				$yearend = '31-03'.'-'.$yearendd;

       				$backYear =  $yearstart.'-'.$yearend;

       				$bgdate     = $yearstart;

       				$yrbgdate = date("Y-m-d", strtotime($bgdate));
        $usertype     = $request->session()->get('user_type');
        $userid    = $request->session()->get('userid');


        $getdate = DB::table('MASTER_FY')->get();

            foreach ($getdate as $key) {
                $userdata['fromDate'] =  $key->FY_FROM_DATE;
                $userdata['toDate']   =  $key->FY_TO_DATE;
            }


            
		$title = 'Acc Ledger Report';
		
		
        
        return view('admin.finance.transaction.crm.crm_ledger_report',$userdata+compact('title'));
        
    }


    public function TransReportAccLedgerCrm(Request $request){

        if ($request->ajax()) {

            if (!empty($request->from_date || $request->acct_code || $request->pfct_code || $request->glC_code || $request->vr_num)) {

					$acct_code = $request->acct_code;
					$pfct_code = $request->pfct_code;
					$glC_code  = $request->glC_code;
					$vr_num    = $request->vr_num;
					$from_date = $request->from_date;
					
                
               /* $company_name     = $request->session()->get('company_name');
                $explodeCnm = explode('-', $company_name);
                $compCode = $explodeCnm[0];
                $macc_year = $request->session()->get('macc_year');
                $ExYEar    = explode('-', $macc_year);
                $yearstart =  $ExYEar[0]-1;
                $yearend   =  $ExYEar[1]-1;
                $backYear =  $yearstart.'-'.$yearend;*/

                    $yearbeg = date("Y"); 

					$yearendd = $yearbeg + 1;
                
                    $yearstart = '01-04'.'-'.$yearbeg;

       				$yearend = '31-03'.'-'.$yearendd;

       				$backYear =  $yearstart.'-'.$yearend;

       				$bgdate     = $yearstart;

       				$yrbgdate = date("Y-m-d", strtotime($bgdate));
                
                $usertype     = $request->session()->get('user_type');
                $userid    = $request->session()->get('userid');
                
                $from_date1 = date("Y-m-d", strtotime($request->from_date));
                $to_date1   = date("Y-m-d", strtotime($request->to_date));

              //  DB::table('acc_ledger_temp')->truncate();

                $strwhere='';
                /*if(isset($from_date1)  && trim($from_date1)!="")
                {
                    	$strwhere .="AND VRDATE BETWEEN '$from_date1' AND '$to_date1'";
                }*/

                if(isset($acct_code)  && trim($acct_code)!="")
                {
                 		$strwhere .= "AND ACC_CODE='$acct_code'";
                 		$strwhere1= "ACC_CODE";
                }


             	if(isset($pfct_code)  && trim($pfct_code)!="")
             	{
             		$strwhere .= "AND PFCT_CODE='$pfct_code'";
             	}

             	if(isset($glC_code)  && trim($glC_code)!="")
             	{
             		$strwhere .= "AND GL_CODE='$glC_code'";
             		$strwhere1= "GL_CODE";
             	}

             	if(isset($vr_num)  && trim($vr_num)!="")
             	{
             		$strwhere .= "AND VRNO ='$vr_num'";
             	}
             	

             if($acct_code){

               $data = DB::select("SELECT t.SERIES, t.particular, t.yropdr, t.yropcr, t.yrdramt, t.yrcramt, 
				format(@running_total:=@running_total + t.yropdr - t.yropcr + t.yrdramt - t.yrcramt ,2,'en_IN') AS balence
				FROM
				(
				SELECT ' Yr. Op.' AS SERIES, 'Opening Balance' as particular, if(yropdr is NULL,0,yropdr) as yropdr, if(yropcr is NULL,0,yropcr) as yropcr, 0 as yrdramt, 0 as yrcramt FROM MASTER_ACCBAL WHERE  ACC_CODE='$acct_code'
				UNION
				SELECT c.SERIES AS SERIES, c.particular as particular, SUM(c.YROPDR) AS YEOPDR, SUM(c.YROPCR) AS YROPCR, SUM(c.YRDRAMT) AS YRDRAMT, SUM(c.YRCRAMT) AS YRCRAMT FROM
				(
				SELECT CONCAT(a.TRAN_CODE,'-',a.SERIES_CODE) as series, b.SERIES_NAME as particular, 0 as yropdr, 0 as yropcr, if(a.dramt is NULL,0,a.dramt) as yrdramt, if(a.cramt is NULL,0,a.cramt) as yrcramt FROM ACC_TRAN a, MASTER_CONFIG b WHERE a.vrdate BETWEEN '$from_date1' AND '$to_date1' AND a.ACC_CODE='$acct_code' AND a.TRAN_CODE=b.TRAN_CODE AND a.SERIES_CODE=b.SERIES_CODE
				) c group by c.SERIES
				) t JOIN (SELECT @running_total:=0) r order by t.series");

           }
                   
               return DataTables()->of($data)->addIndexColumn()->make(true);
                                
            }else{

            

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

                 	$yearbeg = date("Y"); 
                    
					$yearendd = $yearbeg + 1;
                
                    $yearstart = '01-04'.'-'.$yearbeg;

       				$yearend = '31-03'.'-'.$yearendd;

       				$backYear =  $yearstart.'-'.$yearend;

       				$bgdate     = $yearstart;

       				$yrbgdate = date("Y-m-d", strtotime($bgdate));

        $usertype     = $request->session()->get('user_type');
        $userid    = $request->session()->get('userid');

       

        $getdate = DB::table('MASTER_FY')->get();

            foreach ($getdate as $key) {
                $userdata['fromDate'] =  $key->FY_FROM_DATE;
                $userdata['toDate']   =  $key->FY_TO_DATE;
            }


            
		$title = 'Acc Ledger Report';
		
		
        
        return view('admin.finance.transaction.crm.crm_ledger_report',$userdata+compact('title'));
        
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

    function getUserlisEnquiry(Request $request){

    	if ($request->ajax()) {

    		$userid    = $request->session()->get('userid');

    		$vrno = $request->input('vrNo');

    		$enqno =   explode(' ', $vrno);

    		//print_r($vrno);exit;

	    	/*$user_list = DB::table("MASTER_USER")->where('USER_CODE','!=',$userid)->where('USER_TYPE','CRM Employee')->where('USER_TYPE','SRM Employee')->where('USER_TYPE','Employee')->get();*/

	    	$user_list = DB::select("SELECT MASTER_USER.* FROM MASTER_USER WHERE USER_CODE !='$userid' AND USER_TYPE='CRM Employee' OR USER_TYPE='SRM Employee' OR USER_TYPE='Employee'");

	    	$enquiery_log = DB::table("ENQUIERY_LOG")->where('ENQNO',$enqno[1])->get()->toArray();



	    //	print_r($enquiery_log);exit;
	    	
    		if ($user_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $user_list;
	            $response_array['enq_data'] = $enquiery_log;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '';
                $response_array['enq_data'] ='';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }

    }


    public function EnquirylogUser(Request $request){
		$userid     = $request->session()->get('userid');
		$vrDate     = $request->input('vr_date');
		$enq_no     = $request->input('enq_no');

		$enqno =   explode(' ', $enq_no);

		$tr_vr_date = date("Y-m-d", strtotime($vrDate));
		

				$data = array(
				"VRDATE"        => $tr_vr_date,
				"FROM_USERCODE" => $request->input('from_user_Code'),
				"TO_USERCODE"   => $request->input('to_user_Code'),
				"ENQNO"         => $enqno[1],
				"REMARK"        => $request->input('description'),
				"CREATED_BY"    => $userid,
			);

			$saveData = DB::table('ENQUIERY_LOG')->insert($data);

			if ($saveData) {

				$response_array['response'] = 'success';
	            $data = json_encode($response_array);
	            print_r($data);

			} else {

				$response_array['response'] = 'error';
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




	public function SaleorderChieldRTowData(Request $request){

		$response_array = array();

	    $vrno = $request->input('vrno');
	    $tblid = $request->input('tblid');

	   /// print_r($gl_code_help);exit();

		if ($request->ajax()) {

	    	$sale_ordr_chield = DB::table("SORDER_BODY")->where('SORDERHID',$tblid)->where('VRNO',$vrno)->get();

	    	//print_r($Seach_depot_Code_by_help);exit;
	    	
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

   


/*---- sale order transaction ----*/

/*---- sale bill transaction ----*/




/*---- sale bill transaction ----*/

/* ------- start post good challan -------- */

	


    public function PostGoodIssueSaveMsg(Request $request,$saveData){
	 //	print_r($savedata);exit;
		if ($saveData) {

			$request->session()->flash('alert-success', 'Post Good Issue Was Successfully Added...!');
			return redirect('/Transaction/Sales/View-Post-Good-Issue-Trans');

		} else {

			$request->session()->flash('alert-error', 'Post Good Issue Can Not Added...!');
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
    
            $fisYear =  $request->session()->get('macc_year');
    
    
            if($userType=='admin' || $userType=='Admin'){

           // DB::enableQueryLog();
    
           // $data = DB::table('SCHALLAN_HEAD')->where('FY_CODE', $fisYear)->orderBy('SCHALLANHID','DESC');

            $data =DB::select("SELECT SCHALLAN_HEAD.*,SCHALLAN_BODY.SCHALLANHID as salehid,SCHALLAN_BODY.SCHALLANBID,SCHALLAN_BODY.SBILLHID,SCHALLAN_BODY.SBILLBID,MASTER_CONFIG.SERIES_NAME,MASTER_PLANT.PLANT_NAME,MASTER_ACC.ACC_NAME,group_concat(concat(SCHALLAN_BODY.SBILLHID))AS SBILTATUSHD,group_concat(concat(SCHALLAN_BODY.SBILLBID))AS SBILSTATUSBD FROM SCHALLAN_HEAD LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE=SCHALLAN_HEAD.SERIES_CODE LEFT JOIN MASTER_PLANT ON MASTER_PLANT.PLANT_CODE=SCHALLAN_HEAD.PLANT_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE=SCHALLAN_HEAD.ACC_CODE LEFT JOIN SCHALLAN_BODY ON SCHALLAN_BODY.SCHALLANHID = SCHALLAN_HEAD.SCHALLANHID WHERE SCHALLAN_HEAD.FY_CODE='$fisYear' GROUP BY SCHALLAN_HEAD.SCHALLANHID");

           // dd(DB::getQueryLog());
    
            }else if($userType=='superAdmin' || $userType=='user'){
    
               // $data = DB::table('SCHALLAN_HEAD')->where('FY_CODE', $fisYear)->orderBy('SCHALLANHID','DESC');

            	$data =DB::select("SELECT SCHALLAN_HEAD.*,SCHALLAN_BODY.SCHALLANHID as salehid,SCHALLAN_BODY.SCHALLANBID,SCHALLAN_BODY.SBILLHID,SCHALLAN_BODY.SBILLBID,MASTER_CONFIG.SERIES_NAME,MASTER_PLANT.PLANT_NAME,MASTER_ACC.ACC_NAME,group_concat(concat(SCHALLAN_BODY.SBILLHID))AS SBILTATUSHD,group_concat(concat(SCHALLAN_BODY.SBILLBID))AS SBILSTATUSBD FROM SCHALLAN_HEAD LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE=SCHALLAN_HEAD.SERIES_CODE LEFT JOIN MASTER_PLANT ON MASTER_PLANT.PLANT_CODE=SCHALLAN_HEAD.PLANT_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE=SCHALLAN_HEAD.ACC_CODE LEFT JOIN SCHALLAN_BODY ON SCHALLAN_BODY.SCHALLANHID = SCHALLAN_HEAD.SCHALLANHID WHERE SCHALLAN_HEAD.FY_CODE='$fisYear' GROUP BY SCHALLAN_HEAD.SCHALLANHID");
    
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

			$trans_code   = $request->input('trans_code');
			$account_code = $request->input('account_code');
			$transDate    = $request->input('transDate');
			$stateC       = $request->input('stateCode');
			$shipAddr     = $request->input('shipAddr');
			$plstateCode  = $request->input('plstateCode');
			
			$vr_date      = date("Y-m-d", strtotime($transDate));
			$fisYear      =  $request->session()->get('macc_year');
			$expldeYr     = explode('-', $fisYear);
			$startDate    = $expldeYr[0].'-04-01';

			$comp_nameval     = $request->session()->get('company_name');
		    $explode          = explode('-', $comp_nameval);
		    $getcom_code      = $explode[0];

			$saleOrderdata='';
			$dataOpngAmt='';
			$enquiry_no_list='';

			//DB::enableQueryLog();
				
            	//dd(DB::getQueryLog());

			if($trans_code == 'S1'){

				$saleQuodata = DB::SELECT("SELECT t1.*,t2.* FROM SQTN_HEAD t1 LEFT JOIN SQTN_BODY t2 ON t2.SQTNHID = t1.SQTNHID WHERE t1.ACC_CODE='$account_code' AND t1.VRDATE BETWEEN '$startDate' AND '$vr_date' AND t2.SCNTRHID='0' AND t2.SCNTRBID='0' GROUP BY t2.SQTNHID");

				$enquiry_no_list = DB::table('SENQ_VENDOR')
				->where([['ACC_CODE','=',$account_code],['SQTN_FLAG','=','0']])
				->where('COMP_CODE',$getcom_code)
				->where('FY_CODE',$fisYear)
				->whereBetween('VRDATE',[$startDate, $vr_date])
				->groupBy('VRNO')
            	->get();


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

        		$getStateCode = DB::table('MASTER_ACCADD')->where('ACC_CODE',$account_code)->where('ADD1',$shipAddr)->get()->first();

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
	    			
			    $qtyFrmEnq = DB::select("SELECT t1.*,t2.* FROM SENQ_VENDOR t2 LEFT JOIN SENQ_BODY t1 ON t1.SENQHID = t2.SENQHID AND t1.SENQBID=t2.SENQBID WHERE t1.VRNO='$enqno' AND t1.SERIES_CODE='$seriesEnq' AND t2.ACC_CODE='$accCode' AND t1.ITEM_CODE='$itemCode' AND t1.COMP_CODE='$getcompcode' AND t1.FY_CODE='$fisYear'");
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

    public function getVrnoSeriesBytransSale(Request $request){

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

	//print_r($tax_ind_code);exit;

		$response_array = array();

		DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','RT')->orWhere('TCFLAG','R_IT')->delete();

		$dataheadB = DB::SELECT("SELECT t1.*,MASTER_ACC.ACC_NAME,MASTER_ACC.ACC_CODE,'$headtable' as tablNme,t2.*,t3.SERIES_CODE,t3.SERIES_NAME,t4.GST_NO,t4.CITY as plant_city FROM $headtable t1 LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = t1.ACC_CODE LEFT JOIN $bodytable t2 ON t2.$columnheadid = t1.$columnheadid LEFT JOIN MASTER_CONFIG t3 ON t3.SERIES_CODE=t1.SERIES_CODE AND t3.TRAN_CODE=t1.TRAN_CODE LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$columnheadid='$headId'");
		$bodyCount  = count($dataheadB);
		$seriesCode = $dataheadB[0]->SERIES_CODE;
		$accCode    = $dataheadB[0]->ACC_CODE;
		$consiner   = $dataheadB[0]->CPCODE;
		$compCode   = $dataheadB[0]->COMP_CODE;

		$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

		$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACCADD.ACC_CODE = '$accCode' AND MASTER_ACCADD.ADD1 = '$consiner'");

		$compDetail = DB::SELECT("SELECT * FROM MASTER_COMP WHERE COMP_CODE = '$compCode'");

		$dataTax = DB::SELECT("SELECT t1.*,t2.$columnheadid FROM $taxtable t1 LEFT JOIN $headtable t2 ON t2.$columnheadid = t1.$columnheadid WHERE t2.$columnheadid='$headId'");
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

		$dataConfig = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$tCode)->where('SERIES_CODE',$seriesCode)->get()->toArray();

		$title='PDF REPORT';


		//$data030 = DB::SELECT("SELECT t1.*,t2.*,'$headtable' as tableName FROM $headtable t1 LEFT JOIN $bodytable t2 ON t2.$columnheadid = t1.$columnheadid  WHERE t2.$columnheadid='$headId'");

		//$data040 = DB::SELECT("SELECT t1.*,t2.* FROM $taxtable t1 LEFT JOIN $headtable t2 ON t2.$columnheadid = t1.$columnheadid WHERE t2.$columnheadid='$headId'");

		//$compName = DB::table('MASTER_COMP')->where('COMP_CODE',$getcom_code)->get()->first();

		//print_r($compName);exit;

		$title='PDF Report';

        header('Content-Type: application/pdf');
     
        $pdf = PDF::loadView('admin.finance.transaction.sales.sale_data_pdf',compact('dataheadB','dataTax','title','taxDetail','pdfName','dataConfig','dataAccDetail','consinerDetail','compDetail','vrPName'));
                      
        $path = public_path('dist/downloadpdf'); 
        $fileName =  time().'.'. 'pdf' ; 
        $pdf->save($path . '/' . $fileName);
        $PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['data'] = $dataheadB;
		//echo $data = json_encode($response_array);
	  
		return $response_array;

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

		return $response_array;

	}

	public function GeneratePdfForSaleBill($headId){

		$response_array = array();

		$data030 = DB::SELECT("SELECT t1.*,t2.* FROM SBILL_HEAD t1 LEFT JOIN SBILL_BODY t2 ON t2.SBILLHID = t1.SBILLHID  WHERE t2.SBILLHID='$headId'");

		/*$data040 = DB::SELECT("SELECT t1.*,t2.* FROM SCHALLAN_HEAD t1 LEFT JOIN SCHALLAN_TAX t2 ON t2.SCHALLANHID = t1.SCHALLANHID WHERE t2.SCHALLANHID='$headId'");*/

		$title='PDF Report';

        header('Content-Type: application/pdf');
     
        $pdf = PDF::loadView('admin.finance.transaction.sales.salebill_data_pdf',compact('data030','title'));
                      
        $path = public_path('dist/downloadpdf'); 
        $fileName =  time().'.'. 'pdf' ; 
        $pdf->save($path . '/' . $fileName);
        $PublicPath = url('public/dist/downloadpdf/');  
		$downloadPdf = $PublicPath.'/'.$fileName;
		$response_array['response'] = 'success';
		$response_array['url'] = $downloadPdf;
		$response_array['data'] = $data030;

		
		/*$data = json_encode($response_array);
		print_r($data);*/

		return $response_array;

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

			$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACCADD.ACC_CODE = '$accCode' AND MASTER_ACCADD.ADD1 = '$consiner'");

			$compDetail = DB::SELECT("SELECT * FROM MASTER_COMP WHERE COMP_CODE = '$compCode'");
			
			//dd(DB::getQueryLog());
			//print_r($dataConfig);
			//dd(DB::getQueryLog());
			$dataTax = DB::SELECT("SELECT t1.*,t2.$headID FROM $taxTble t1 LEFT JOIN $headTble t2 ON t2.$headID = t1.$headID WHERE t2.$headID='$head_Id'");
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

			$dataConfig = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$tCode)->where('SERIES_CODE',$seriesCode)->get()->toArray();

			$title='PDF REPORT';

			

        	header('Content-Type: application/pdf');
     
        	$pdf = PDF::loadView('admin.finance.transaction.sales.sales_voucher_data_report',compact('dataheadB','dataTax','title','taxDetail','pdfName','dataConfig','dataAccDetail','consinerDetail','compDetail','vrPName','seirsHeadLine'));

        	/*$Pageno =$mpdf->getPageCount();

        	print_r($Pageno);exit;*/
                      
        	$path = public_path('dist/downloadpdf'); 
        	$fileName =  time().'.'. 'pdf' ; 
        	$pdf->save($path . '/' . $fileName);
        	$PublicPath = url('public/dist/downloadpdf/');  
			$downloadPdf = $PublicPath.'/'.$fileName;
			$response_array['response'] = 'success';
			$response_array['url'] = $downloadPdf;
			$response_array['data'] = $dataheadB;
	        echo $data = json_encode($response_array);
		}else{
			$response_array['response'] = 'error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);
		}

		

	}

/* ------------ download pdf for purchase view -------------------*/


}
