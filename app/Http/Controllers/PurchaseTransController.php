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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use Illuminate\Filesystem\Filesystem;
use App\Http\Controllers\AccountingController;
use DateTime;

class PurchaseTransController extends Controller{

	public function __construct(){
		$this->master_party     = DB::table('MASTER_ACC')->get()->toArray();
		//$this->master_plant     = DB::table('MASTER_PLANT')->get()->toArray();
		$this->master_dept      = DB::table('MASTER_DEPT')->get()->toArray();
		$this->master_config    = DB::table('MASTER_CONFIG')->get()->toArray();
		$this->master_item      = DB::table('MASTER_ITEM')->get();
		$this->master_rateValue = DB::table('MASTER_RATE_VALUE')->get();
		$this->master_comp      = DB::table('MASTER_COMP')->get();
		$this->master_pfct      = DB::table('MASTER_PFCT')->get();
		$this->master_bank      = DB::table('MASTER_BANK')->get();
		$this->master_tax       = DB::table('MASTER_TAX')->get();
		$this->master_cost      = DB::table('MASTER_COST')->get();

		$this->master_taxRate   = DB::table('MASTER_TAX')
				->select('MASTER_TAX.*', 'MASTER_TAXRATE.*')
           		->leftjoin('MASTER_TAXRATE', 'MASTER_TAXRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
           		->groupBy('MASTER_TAXRATE.TAX_CODE')
           		->get();
	}


/* ------------ common function --------- */

	public function CommonFunction($macc_year,$Comp_Code,$Tran_Code){

        $queryData['series_list']   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$Comp_Code)->where('TRAN_CODE',$Tran_Code)->get();

        $queryData['fy_list']  = DB::table('MASTER_FY')->where(['COMP_CODE'=>$Comp_Code,'FY_CODE'=>$macc_year])->get();

        $queryData['vr_No_list'] = DB::table('MASTER_VRSEQ')->where(['TRAN_CODE'=>$Tran_Code,'COMP_CODE'=>$Comp_Code])->get();

        $queryData['plant_list'] = DB::table('MASTER_PLANT')->where(['COMP_CODE'=>$Comp_Code])->get()->toArray();

        $queryData['item_list'] = DB::table('MASTER_ITEM')->where('COMP_CODE',$Comp_Code)->orWhere('COMP_CODE',NULL)->orWhere('COMP_CODE','')->get()->toArray();

        return $queryData;

    }

    public function CommonQualityParameter($request,$itemCode,$HeadId,$BodyId,$headTBL,$bodyTBL,$quopTBL){

    	$response_array = array();

    	if ($request->ajax()) {
			
            $fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM $quopTBL t3 LEFT JOIN $bodyTBL t2 ON t2.$BodyId = t3.$BodyId LEFT JOIN $headTBL t1 ON t1.$HeadId = t3.$HeadId WHERE t2.$itemCode='$itemCode' AND t3.$HeadId='$poHeadId' AND t3.$BodyId='$poBodyId'");

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

    public function QualityParameter($headId,$bodyId,$quaPId,$pInHeadId,$pInBodyId,$pInQuaId,$getcompcode,$fisYear,$pfct_code,$trans_code,$series_code,$vr_no,$slNo,$tr_vr_date,$item_code_que,$item_category,$iqua_char,$IQUA_DESC,$IQUA_UM,$char_fromvalue,$char_tovalue,$VENDQCVAL,$ACTUALQCVAL,$TPQCVAL,$createdBy,$PINDENT_QUA_TBL){

		$data_Qp = array(

			$pInHeadId       =>$headId,
			$pInBodyId       =>$bodyId,
			$pInQuaId        =>$quaPId,
			'COMP_CODE'      =>$getcompcode,
			'FY_CODE'        =>$fisYear,
			'PFCT_CODE'      =>$pfct_code,
			'TRAN_CODE'      =>$trans_code,
			'SERIES_CODE'    =>$series_code,
			'VRNO'           =>$vr_no,
			'SLNO'           =>$slNo,
			'VRDATE'         =>$tr_vr_date,
			'ITEM_CODE'      =>$item_code_que,
			'ICATG_CODE'     =>$item_category,
			'IQUA_CHAR'      =>$iqua_char,
			'IQUA_DESC'      =>$IQUA_DESC,
			'IQUA_UM'        =>$IQUA_UM,
			'CHAR_FROMVALUE' =>$char_fromvalue,
			'CHAR_TOVALUE'   =>$char_tovalue,
			'VENDQCVAL'      =>$VENDQCVAL,
			'ACTUALQCVAL'    =>$ACTUALQCVAL,
			'TPQCVAL'        =>$TPQCVAL,
			'CREATED_BY'     =>$createdBy,
		);

		$saveDataQ = DB::table($PINDENT_QUA_TBL)->insert($data_Qp);

		return $saveDataQ;

	}

/* ------------ common function --------- */

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

/* ----------- START : PURCHASE INDENT TRANSACTION ------------ */

	public function PurchaseIndent(Request $request){

		$title       =	'Add Purchase Indent';
		$dept_list   =  $this->master_dept;
		//$item_list   =  $this->master_item;
		
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$userdata['series_list'] = DB::table('MASTER_CONFIG')->where('TRAN_CODE','T0')->where('COMP_CODE',$getcompcode)->get();
		
		$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','T0')->get();

   		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;

   		$functionData = $this->CommonFunction($macc_year,$getcompcode,'T0');
   		$plant_list = $functionData['plant_list'];
   		$item_list  = $functionData['item_list'];

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		foreach ($getdate as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		if(isset($CompanyCode)){

		    return view('admin.finance.transaction.purchase.purchase_indent',$userdata+compact('title','plant_list','dept_list','item_list'));

		}else{
			return redirect('/useractivity');
		}
	}

	public function SavePuchaseIndent(Request $request){
		
		$createdBy      = $request->session()->get('userid');
		$compName       = $request->session()->get('company_name');
		$compcode       = explode('-', $compName);
		$getcompcode    =	$compcode[0];
		$fisYear        = $request->session()->get('macc_year');
		$comp_nameval   = $request->input('comp_name');
		$fy_year        = $request->input('fy_year');
		$pfct_code      = $request->input('pfct_code');
		$trans_code     = $request->input('trans_code');
		$series_code    = $request->input('series_code');
		$vr_no          = $request->input('vr_no');
		$trans_date     = $request->input('trans_date');
		$tr_vr_date     = date("Y-m-d", strtotime($trans_date));
		$getduedate     = $request->input('getdue_date');
		$dueDate        = date("Y-m-d", strtotime($getduedate));
		$departCode     = $request->input('departCode');
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
		$head_tax_ind   = $request->input('head_tax_ind');
		$item_category  = $request->input('item_category');
		$iqua_char      = $request->input('iqua_char');
		$iqua_desc      = $request->input('iqua_desc');
		$char_fromvalue = $request->input('char_fromvalue');
		$char_tovalue   = $request->input('char_tovalue');
		$quaP_count     = $request->input('quaP_count');
		$allquaPcount   = $request->input('allquaPcount');
		$item_code_que  = $request->input('item_code_que');
		
		$partyrefDte    = $request->input('party_ref_date');
		$partyref_date  = date("Y-m-d", strtotime($partyrefDte));

		$PIndentH = DB::select("SELECT MAX(PINDHID) as PINDHID FROM PINDENT_HEAD");
		$headID = json_decode(json_encode($PIndentH), true); 
	
		if(empty($headID[0]['PINDHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['PINDHID']+1;
		}


		if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('PINDENT_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrNum +1;
		}else{
			$NewVrno = $vrNum;
		}

		if($request->input('emplyeeName')){
			$empName = $request->input('emplyeeName');
		}else{
			$empName = '';
		}

		DB::beginTransaction();

		try {

			$data = array(

				'PINDHID'      =>$head_Id,
				'COMP_CODE'    =>$getcompcode,
				'FY_CODE'      =>$fisYear,
				'PFCT_CODE'    =>$pfct_code,
				'PFCT_NAME'    =>$request->input('pfct_name'),
				'TRAN_CODE'    =>$trans_code,
				'SERIES_CODE'  =>$series_code,
				'SERIES_NAME'  =>$request->input('series_name'),
				'VRNO'         =>$NewVrno,
				'SLNO'         =>1,
				'VRDATE'       =>$tr_vr_date,
				'PLANT_CODE'   =>$plant_code,
				'PLANT_NAME'   =>$request->input('plant_name'),
				'DEPT_CODE'    =>$departCode,
				'DEPT_NAME'    =>$request->input('departName'),
				'EMP_CODE'     =>$request->input('emplyeeCode'),
				'EMP_NAME'     =>$empName,
				'PARTYREFNO'   =>$request->input('party_ref_no'),
				'PARTYREFDATE' =>$partyref_date,
				'DUEDATE'      =>$dueDate,
				'RFHEAD1'      =>$request->input('rfhead1'),
				'RFHEAD2'      =>$request->input('rfhead2'),
				'RFHEAD3'      =>$request->input('rfhead3'),
				'RFHEAD4'      =>$request->input('rfhead4'),
				'RFHEAD5'      =>$request->input('rfhead5'),
				'CREATED_BY'   =>$createdBy,

			);

			$saveDataH = DB::table('PINDENT_HEAD')->insert($data);

			$BodyIdGet = array();
			for ($i=0; $i < $countItemCode ; $i++) { 

				$PIndentB = DB::select("SELECT MAX(PINDBID) as PINDBID FROM PINDENT_BODY");
				$bodyID = json_decode(json_encode($PIndentB), true); 
			
				if(empty($bodyID[0]['PINDBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['PINDBID']+1;
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
					
					'PINDHID'     =>$head_Id,
					'PINDBID'     =>$body_Id,
					'COMP_CODE'   =>$getcompcode,
					'FY_CODE'     =>$fisYear,
					'PFCT_CODE'   =>$pfct_code,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'VRNO'        =>$NewVrno,
					'SLNO'        =>$i+1,
					'VRDATE'      =>$tr_vr_date,
					'DEPT_CODE'   =>$departCode,
					'ITEM_CODE'   =>$item_code[$i],
					'ITEM_NAME'   =>$item_name[$i],
					'REMARK'      =>$remark[$i],
					'QTYRECVD'    =>$qty[$i],
					'UM'          =>$unit_M[$i],
					'AQTYRECD'    =>$Aqty[$i],
					'AUM'         =>$add_unit_M[$i],
					'FLAG'        =>$FLAG,
					'CREATED_BY'  =>$createdBy,
				);

				$saveDataB = DB::table('PINDENT_BODY')->insert($data_body);

				if($quaP_count[$i] == 0){
				}else{
					for ($q=0; $q < $quaP_count[$i]; $q++) { 

					$a = array_fill(1, $quaP_count[$i], $body_Id);
					$str = implode(',',$a); 
					$last_id = explode(',',$str);

					$BodyIdGet[]= $last_id[0];

				    }
				}


			} /*-- for loop close --*/

			for ($j=0; $j <$allquaPcount; $j++) {

				$PIndentQ = DB::select("SELECT MAX(PINDQID) as PINDQID FROM PINDENT_QUA");
				$QuaID = json_decode(json_encode($PIndentQ), true);		
				if(empty($QuaID[0]['PINDQID'])){
					$quaP_Id = 1;
				}else{
					$quaP_Id = $QuaID[0]['PINDQID']+1;
				}

				$slNo = $j+1; 

				$data_Qp = array(

					'PINDHID'        =>$head_Id,
					'PINDBID'        =>$BodyIdGet[$j],
					'PINDQID'        =>$quaP_Id,
					'COMP_CODE'      =>$getcompcode,
					'FY_CODE'        =>$fisYear,
					'PFCT_CODE'      =>$pfct_code,
					'TRAN_CODE'      =>$trans_code,
					'SERIES_CODE'    =>$series_code,
					'VRNO'           =>$NewVrno,
					'SLNO'           =>$slNo,
					'VRDATE'         =>$tr_vr_date,
					'ITEM_CODE'      =>$item_code_que[$j],
					'ICATG_CODE'     =>$item_category[$j],
					'IQUA_CHAR'      =>$iqua_char[$j],
					'IQUA_UM'        =>'',
					'CHAR_FROMVALUE' =>$char_fromvalue[$j],
					'CHAR_TOVALUE'   =>$char_tovalue[$j],
					'CREATED_BY'     =>$createdBy,
				);

				$saveDataQ = DB::table('PINDENT_QUA')->insert($data_Qp);
				
			}
			$bodyTblNm = 'PINDENT_BODY';
			$apvTblNm  = 'PINDENT_APPROVE';
			$bodyCol   = 'PINDBID';
			$apvCol    = 'PINDAID';
			$headCol   = 'PINDHID';

			$this->approve_Trans($bodyTblNm,$bodyCol,$trans_code,$series_code,$apvTblNm,$getcompcode,$fisYear,$pfct_code,$trans_code,$series_code,$NewVrno,$tr_vr_date,$createdBy,$head_Id,$apvCol,$headCol);
			//DB::enableQueryLog();
			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get()->toArray();
			//dd(DB::getQueryLog());
			//print_r($checkvrnoExist);exit;

			if(empty($checkvrnoExist)){

				$datavrnIn =array(
					'COMP_CODE'   =>$getcompcode,
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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			$discriptn_page = "Purchase indent trans insert done by user";
			$acc_code = '';
			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);

			DB::commit();
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

    } /* /. main function */

    public function purchase_indent_msg(Request $request,$saveData){

		if ($saveData == 'false'){

				$request->session()->flash('alert-error', 'Data Can Not Be Save...!');
				return redirect('/Transaction/Purchase/View-Purchase-Indent-Trans');

		} else {

				$request->session()->flash('alert-success', 'Data Was Successfully Save...!');
				return redirect('/Transaction/Purchase/View-Purchase-Indent-Trans');

		}
	}

	public function ViewPurchaseIndent(Request $request){
		$compName = $request->session()->get('company_name');
	    if($request->ajax()) {

	        $title ='View Purchase Indent';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $compName = $request->session()->get('company_name');
	        $explodComp = explode('-', $compName);
	        $compCd = $explodComp[0];
	        $fisYear =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

           		/*$data = DB::table('PINDENT_HEAD')
				->select('PINDENT_HEAD.*','MASTER_CONFIG.SERIES_NAME','MASTER_PLANT.PLANT_NAME','MASTER_DEPT.DEPT_NAME')
           		->leftjoin('MASTER_CONFIG', 'MASTER_CONFIG.SERIES_CODE', '=', 'PINDENT_HEAD.SERIES_CODE')
           		->leftjoin('MASTER_PLANT', 'MASTER_PLANT.PLANT_CODE', '=', 'PINDENT_HEAD.PLANT_CODE')
           		->leftjoin('MASTER_DEPT', 'MASTER_DEPT.DEPT_CODE', '=', 'PINDENT_HEAD.DEPT_CODE')
           		->where('PINDENT_HEAD.FY_CODE',$fisYear)
           		->orderBy('PINDENT_HEAD.PINDHID','DESC');*/
           		//DB::enableQueryLog();
           		$data =DB::select("SELECT PINDENT_HEAD.*,PINDENT_BODY.PINDHID as indHid,PINDENT_BODY.PINDBID,PINDENT_BODY.PENQHID,PINDENT_BODY.PENQBID,group_concat(concat(PINDENT_BODY.PENQHID))AS PenqSTATUSHD,group_concat(concat(PINDENT_BODY.PENQBID))AS PenqSTATUSBD FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_BODY.PINDHID = PINDENT_HEAD.PINDHID WHERE PINDENT_HEAD.FY_CODE='$fisYear' AND PINDENT_HEAD.COMP_CODE='$compCd' GROUP BY PINDENT_HEAD.PINDHID");

	        }else if($userType=='superAdmin' || $userType=='user'){

	           $data =DB::select("SELECT PINDENT_HEAD.*,PINDENT_BODY.PINDHID as indHid,PINDENT_BODY.PINDBID,PINDENT_BODY.PENQHID,PINDENT_BODY.PENQBID,group_concat(concat(PINDENT_BODY.PENQHID))AS PenqSTATUSHD,group_concat(concat(PINDENT_BODY.PENQBID))AS PenqSTATUSBD FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_BODY.PINDHID = PINDENT_HEAD.PINDHID WHERE PINDENT_HEAD.FY_CODE='$fisYear' AND PINDENT_HEAD.COMP_CODE='$compCd' GROUP BY PINDENT_HEAD.PINDHID");

	        }
	        else{

	            $data='';
	            
	        }

	    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();
    
    	}

	    if(isset($compName)){

	       return view('admin.finance.transaction.purchase.view_purchase_indent');
	    }else{
			return redirect('/useractivity');
		}
        
	}

	public function PurchaseIndentChieldRTowData(Request $request){

		$response_array = array();

	    $vrno = $request->input('vrno');
	    $tblid = $request->input('tblid');

		if ($request->ajax()) {

	    	$purchase_indent_chield = DB::table("PINDENT_BODY")->where('PINDHID',$tblid)->where('VRNO',$vrno)->get();

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

    public function DeletePurchaseIndent(Request $request){

		$head_id   = $request->input('headID');
		$bodyID    = $request->input('bodyID');
		$row_count = $request->input('rowCount');
        //print_r($row_count);exit;
        if ($head_id!='') {

    		$DeleteHead = DB::table('PINDENT_HEAD')->where('PINDHID',$head_id)->delete();
			$DeleteBody = DB::table('PINDENT_BODY')->where('PINDHID',$head_id)->delete();
		
			if (($DeleteHead && $DeleteBody)) {

				$request->session()->flash('alert-success', 'Purchase Indent Data Was Deleted Successfully...!');
				return redirect('/Transaction/Purchase/View-Purchase-Indent-Trans');

			} else {

				$request->session()->flash('alert-error', 'Purchase Indent Data Can Not Deleted...!');
				return redirect('/Transaction/Purchase/View-Purchase-Indent-Trans');

			}
		
		}else{

			$request->session()->flash('alert-error', 'Purchase Indent Data Not Found...!');
			return redirect('/Transaction/Purchase/View-Purchase-Indent-Trans');

		}
	}

	public function EditIndentPurchase(Request $request,$headid,$bodyid,$vrno){

    	$id =base64_decode($headid);
    	$body_id =base64_decode($bodyid);
    	$vrno  =base64_decode($vrno);
    	
    	if($id!=''){
    	   	//DB::enableQueryLog();
			$userdata['getPurchaseIndent'] = DB::select("SELECT t1.*,t2.*,t3.SERIES_NAME,t4.PLANT_NAME,t5.PFCT_NAME,t6.DEPT_NAME FROM PINDENT_BODY t2 LEFT JOIN PINDENT_HEAD t1 ON t1.PINDHID = t2.PINDHID AND t1.VRNO = t2.VRNO LEFT JOIN MASTER_CONFIG t3 ON t3.SERIES_CODE=t1.SERIES_CODE LEFT JOIN MASTER_PLANT t4 ON t4.PLANT_CODE=t1.PLANT_CODE LEFT JOIN MASTER_PFCT t5 ON t5.PFCT_CODE=t1.PFCT_CODE LEFT JOIN MASTER_DEPT t6 ON t6.DEPT_CODE=t1.DEPT_CODE WHERE t1.PINDHID='$id' AND t1.VRNO='$vrno'");
			
			//dd(DB::getQueryLog());
			
			$title       ='Edit Purchase Indent';
			
			$CompanyCode = $request->session()->get('company_name');
			$compcode    = explode('-', $CompanyCode);
			$getcompcode =	$compcode[0];
			$macc_year   = $request->session()->get('macc_year');
			$userdata['rate_list'] = DB::table('MASTER_RATE_VALUE')->get();
			$item_list   =  $this->master_item;
			$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

			foreach ($getdate as $key) {
				$userdata['fromDate'] =  $key->FY_FROM_DATE;
				$userdata['toDate']   =  $key->FY_TO_DATE;
			}

			$userdata['series_list'] = DB::table('MASTER_CONFIG')->where('TRAN_CODE','T0')->get();

			$userdata['help_item_list'] = DB::table('MASTER_ITEM')->get();


			return view('admin.finance.transaction.purchase.edit_purchase_indnet_form', $userdata+compact('title','item_list'));
		}else{
			$request->session()->flash('alert-error', 'Not Found...!');
			return redirect('/Transaction/Purchase/View-Purchase-Indent-Trans');
		}

    }

     public function UpdatePuchaseIndent(Request $request){

		$createdBy        = $request->session()->get('userid');
		$compName         = $request->session()->get('company_name');
		$fisYear          =  $request->session()->get('macc_year');
		$comp_nameval     = $request->input('comp_name');
		$head_id          = $request->input('head_id');
		$qty_id           = $request->input('qty_id');
		$vr_no            = $request->input('vr_no');
		$trans_date       = $request->input('trans_date');
		$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
		$pfct_code        = $request->input('pfct_code');
		$trans_code       = $request->input('trans_code');
		$series_code      = $request->input('series_code');
		$departCode       = $request->input('departCode');
		$plant_code       = $request->input('plant_code');
		$item_code        = $request->input('item_code');
		$countItemCode    = count($item_code);
		$item_name        = $request->input('item_name');
		$remark           = $request->input('remark');
		$qty              = $request->input('qty');
		$unit_M           = $request->input('unit_M');
		$Aqty             = $request->input('Aqty');
		$add_unit_M       = $request->input('add_unit_M');
		$rate             = $request->input('rate');
		$basic_amt        = $request->input('basic_amt');
		$head_tax_ind     = $request->input('head_tax_ind');
		$item_category    = $request->input('item_category');
		$iqua_char        = $request->input('iqua_char');
		$iqua_desc        = $request->input('iqua_desc');
		$char_fromvalue   = $request->input('char_fromvalue');
		$char_tovalue     = $request->input('char_tovalue');
		$quaP_count       = $request->input('quaP_count');
		$alreadyApQp      = $request->input('alreadyApQp');
		$allquaPcount     = $request->input('allquaPcount');
		$quality_itemcode = $request->input('item_code_que');
		$duedate          = $request->input('due_date');
		$due_date         = date("Y-m-d", strtotime($duedate));

		$headIdA = array();
		$bodyIdA = array();

		for ($i=0; $i < $countItemCode ; $i++) { 

			$body_id = $request->input('body_id');

			if($body_id[$i]){

				$getbidyid = $body_id[$i];
			}

			$data_body = array(
			
				'ITEM_CODE'      =>$item_code[$i],
				'ITEM_NAME'      =>$item_name[$i],
				'REMARK'         =>$remark[$i],
				'QTYRECVD'       =>$qty[$i],
				'UM'             =>$unit_M[$i],
				'AQTYRECD'       =>$Aqty[$i],
				'AUM'            =>$add_unit_M[$i],
				'APPROVE_REMARK' =>'',
				'FLAG'           =>0,
				'LAST_UPDATE_BY' =>$createdBy,
			);

			$saveDataB = DB::table('PINDENT_BODY')->where('PINDBID',$body_id[$i])->where('PINDHID',$head_id[$i])->update($data_body);

			if($quaP_count[$i] == 0){

			}else{
				for ($q=0; $q < $quaP_count[$i]; $q++) { 

				$a = array_fill(1, $quaP_count[$i], $body_id[$i]);
				$str = implode(',',$a); 
				$last_id = explode(',',$str);
				$bodyIdA[]= $last_id[0];

				$ahead = array_fill(1, $quaP_count[$i], $head_id[$i]);
				$str_head = implode(',',$ahead); 
				$last_head = explode(',',$str_head);
				$headIdA[]= $last_head[0];

			    }
			}

			$DeleteData = DB::table('PINDENT_QUA')->where('PINDHID',$head_id[$i])->where('PINDBID',$body_id[$i])->delete();

		} /*-- for loop close --*/

		for ($w=0; $w <$allquaPcount ; $w++) {

			$PIndentQ = DB::select("SELECT MAX(PINDQID) as PINDQID FROM PINDENT_QUA");
			$QuaID = json_decode(json_encode($PIndentQ), true);		
			if(empty($QuaID[0]['PINDQID'])){
				$quaP_Id = 1;
			}else{
				$quaP_Id = $QuaID[0]['PINDQID']+1;
			} 

			$data_Qp = array(
				
				'PINDHID'        =>$headIdA[$w],
				'PINDBID'        =>$bodyIdA[$w],
				'PINDQID'        =>$quaP_Id,
				'COMP_CODE'      =>$compName,
				'FY_CODE'        =>$fisYear,
				'PFCT_CODE'      =>$pfct_code,
				'TRAN_CODE'      =>$trans_code,
				'SERIES_CODE'    =>$series_code,
				'VRNO'           =>$vr_no,
				'VRDATE'         =>$tr_vr_date,
				
				'ITEM_CODE'      =>$quality_itemcode[$w],
				'ICATG_CODE'     =>$item_category[$w],
				'IQUA_CHAR'      =>$iqua_char[$w],
				'IQUA_UM'        =>'',
				'CHAR_FROMVALUE' =>$char_fromvalue[$w],
				'CHAR_TOVALUE'   =>$char_tovalue[$w],

			);

			$saveDataQ = DB::table('PINDENT_QUA')->insert($data_Qp);

		}

		if ($saveDataB) {

    			$response_array['response'] = 'success';
	            $data = json_encode($response_array);

	            print_r($data);

		}else{

				$response_array['response'] = 'error';

                $data = json_encode($response_array);

                print_r($data);
				
		}

    } /* ./ main edit function*/

    public function purchase_update_indent_msg(Request $request,$saveData){
	 
		if ($saveData){

				$request->session()->flash('alert-success', 'Purchase Indent Was Successfully Update...!');
				return redirect('/Transaction/Purchase/View-Purchase-Indent-Trans');

		} else {

				$request->session()->flash('alert-error', 'Purchase Can Not Update...!');
				return redirect('/Transaction/Purchase/View-Purchase-Indent-Trans');

		}
	}

/* -----------------  END : PURCHASE INDENT TRANSACTION --------------- */

/* -----------------  START : PURCHASE ENQUIRY TRANSACTION --------------- */

	public function PurchaseEnquiryTrans(Request $request){

		$title       = 'Add Purchase Enquiry';
		
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$userdata['series_list'] = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'P0'])->get();

		$acc_list      =  $this->master_party;
		$tax_code_list =  $this->master_tax;
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

		$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','P0')->get();

   		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;

		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.purchase.enquery_trans',$userdata+compact('title','acc_list','tax_code_list'));

	    }else{

			return redirect('/useractivity');
		}
	}

	public function SavePurchaseEnquiry(Request $request){

			$createdBy     = $request->session()->get('userid');
			$compName      = $request->session()->get('company_name');
			$spliN = explode('-', $compName);
			$compCode = $spliN[0];
			$fisYear       =  $request->session()->get('macc_year');
			$donwloadStatus      = $request->input('donwloadStatus');
			$comp_nameval  = $request->input('comp_name');
			$fy_year       = $request->input('fy_year');
			$pfct_code     = $request->input('pfct_code');
			$trans_code    = $request->input('trans_code');
			$series_code   = $request->input('series_code');
			$vr_no         = $request->input('vr_no');
			$trans_date    = $request->input('trans_date');
			$tr_vr_date    = date("Y-m-d", strtotime($trans_date));
			$getduedate    = $request->input('getdue_date');
			$dueDate       = date("Y-m-d", strtotime($getduedate));
			$accountCode   = $request->input('accountCode');
			$plant_code    = $request->input('plant_code');
			$indent_no     = $request->input('indent_no');
			$countindentno =count($indent_no);
			$indent_dat    = $request->input('indent_date');
			$indtcode      = $request->input('indtcode');
			$indseriescode = $request->input('indseriescode');
			$inslno        = $request->input('inslno');
			$indvrno       = $request->input('indvrno');
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
			$item_code_que = $request->input('item_code_que');
			$item_category = $request->input('item_category');
			$iqua_char     = $request->input('iqua_char');
			$iqua_desc     = $request->input('iqua_desc');
			$char_fromvalue= $request->input('char_fromvalue');
			$char_tovalue  = $request->input('char_tovalue');
			$partyrefNo    = $request->input('party_ref_no');
			$partyrefDate  = $request->input('party_ref_date');
			$indentHeadId  = $request->input('indentHeadId');
			$indentBodyId  = $request->input('indentBodyId');
			$party_ref_Date = date("Y-m-d", strtotime($partyrefDate));
			$consineCode   = $request->input('consine_code');
			$rfhead1   = $request->input('rfhead1');
			$rfhead2   = $request->input('rfhead2');
			$rfhead3   = $request->input('rfhead3');
			$rfhead4   = $request->input('rfhead4');
			$rfhead5   = $request->input('rfhead5');

			$PEnqH = DB::select("SELECT MAX(PENQHID) as PENQHID FROM PENQ_HEAD");
			$head_ID = json_decode(json_encode($PEnqH), true); 
		
			if(empty($head_ID[0]['PENQHID'])){
				$headId = 1;
			}else{
				$headId = $head_ID[0]['PENQHID']+1;
			}

			if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}

			$vrno_Exist = DB::table('PENQ_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

			DB::beginTransaction();

			try {

				$data = array(

					'PENQHID'      =>$headId,
					'COMP_CODE'    =>$compCode,
					'FY_CODE'      =>$fisYear,
					'PFCT_CODE'    =>$pfct_code,
					'PFCT_NAME'    =>$request->input('pfct_name'),
					'TRAN_CODE'    =>$trans_code,
					'SERIES_CODE'  =>$series_code,
					'SERIES_NAME'  =>$request->input('series_name'),
					'VRNO'         =>$NewVrno,
					'SLNO'         =>1,
					'VRDATE'       =>$tr_vr_date,
					'PLANT_CODE'   =>$plant_code,
					'PLANT_NAME'   =>$request->input('plant_name'),
					'CPCODE'       =>$consineCode,
					'PARTYREFNO'   =>$partyrefNo,
					'PARTYREFDATE' =>$party_ref_Date,
					'DUEDATE'      =>$dueDate,
					'RFHEAD1'      =>$rfhead1,
					'RFHEAD2'      =>$rfhead2,
					'RFHEAD3'      =>$rfhead3,
					'RFHEAD4'      =>$rfhead4,
					'rfhead5'      =>$rfhead5,
					'CREATED_BY'   =>$createdBy,

				);
		
				$saveDataH = DB::table('PENQ_HEAD')->insert($data);

				$discriptn_page = "Purchase enquiry trans insert done by user";
				$acc_code = '';
				$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$acc_code);

				$datalistrray = array();

				for ($i=0; $i < $countindentno; $i++) { 

					$PEnqB = DB::select("SELECT MAX(PENQBID) as PENQBID FROM PENQ_BODY");
					$body_ID = json_decode(json_encode($PEnqB), true); 
			
					if(empty($body_ID[0]['PENQBID'])){
						$bodyId = 1;
					}else{
						$bodyId = $body_ID[0]['PENQBID']+1;
					}

					$getindentNo = explode(' ', $indent_no[$i]);
				
					$ind_vr_date   = date("Y-m-d", strtotime($indent_dat[$i]));
		
					$slno  =$i+1;
					$data_body = array(
				
						'PENQHID'     =>$headId,
						'PENQBID'     =>$bodyId,
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
						'PINDHID'     =>$indentHeadId[$i],
						'PINDBID'     =>$indentBodyId[$i],
						'CREATED_BY'  =>$createdBy,
					);
					$saveDataB = DB::table('PENQ_BODY')->insert($data_body);

					$data_indent_body = array(
					
						'PENQHID' =>$headId,
						'PENQBID' =>$bodyId,
					);

					$UpdateData = DB::table('PINDENT_BODY')->where('PINDHID',$indentHeadId[$i])->where('PINDBID',$indentBodyId[$i])->update($data_indent_body);

					if($quaP_count[$i] == 0){
					}else{
						for ($q=0; $q < $quaP_count[$i]; $q++) { 

						$a = array_fill(1, $quaP_count[$i], $bodyId);
						$str = implode(',',$a); 
						$last_id = explode(',',$str);

						$datalistrray[]= $last_id[0];

					    }
					}

					$enqAccCount =$countItemCode = count($enqacc_code);

					for($e=0;$e<$enqAccCount;$e++){

						$PEnqVe = DB::select("SELECT MAX(PENQVID) as PENQVID FROM PENQ_VENDOR");
						$vend_ID = json_decode(json_encode($PEnqVe), true); 
				
						if(empty($vend_ID[0]['PENQVID'])){
							$vendid = 1;
						}else{
							$vendid = $vend_ID[0]['PENQVID']+1;
						}

						$data_vendor = array(

							'PENQHID'     =>$headId,
							'PENQBID'     =>$bodyId,
							'PENQVID'     =>$vendid,
							'COMP_CODE'   =>$compCode,
							'FY_CODE'     =>$fisYear,
							'PFCT_CODE'   =>$pfct_code,
							'TRAN_CODE'   =>$trans_code,
							'SERIES_CODE' =>$series_code,
							'VRNO'        =>$NewVrno,
							'VRDATE'      =>$tr_vr_date,
							'PLANT_CODE'  =>$plant_code,
							'ACC_CODE'    =>$enqacc_code[$e],
							'ACC_NAME'    =>$enqacc_name[$e],
							'created_by'  =>$createdBy,

						);
				
						$saveDataV = DB::table('PENQ_VENDOR')->insert($data_vendor);
					} /* /. vendor */

		   		}/*-- for loop close --*/


		    	for ($j=0; $j < $allquaPcount; $j++) { 

		    		$PEnqQ = DB::select("SELECT MAX(PENQQID) as PENQQID FROM PENQ_QUA");
					$QuaID = json_decode(json_encode($PEnqQ), true);		
					if(empty($QuaID[0]['PENQQID'])){
						$quaPId = 1;
					}else{
						$quaPId = $QuaID[0]['PENQQID']+1;
					}

					$slNo = $j+1; 


					$data_Qp = array(

						'PENQHID'        =>$headId,
						'PENQBID'        =>$datalistrray[$j],
						'PENQQID'        =>$quaPId,
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
					$saveDataQ = DB::table('PENQ_QUA')->insert($data_Qp);

		    	} /* /. quality parameter */

		    	$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->get()->toArray();

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
					DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->update($datavrn);
				}

				DB::commit();
				if($donwloadStatus ==1 ){
					return $this->GeneratePdfForPEnq($headId,$enqacc_code);
					
				}
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
		
    }

    public function ViewEnquiryTransaction(Request $request){

     	$compName = $request->session()->get('company_name');

        if($request->ajax()) {
    
            $title ='View Enquiry';
    
            $userid    = $request->session()->get('userid');
    
            $userType = $request->session()->get('usertype');
    
            $compName = $request->session()->get('company_name');
    		
    		$explode          = explode('-', $compName);
    		$getcom_code      = $explode[0];
            $fisYear =  $request->session()->get('macc_year');
    
            if($userType=='admin' || $userType=='Admin'){

           /*$data = DB::table('PENQ_HEAD')
				->select('PENQ_HEAD.*', 'MASTER_PFCT.PFCT_NAME as pfct_name','MASTER_CONFIG.SERIES_NAME AS series_name','MASTER_PLANT.PLANT_NAME AS plant_name')
           		->leftjoin('MASTER_PFCT', 'MASTER_PFCT.PFCT_CODE', '=', 'PENQ_HEAD.PFCT_CODE')
           		->leftjoin('MASTER_CONFIG', 'MASTER_CONFIG.SERIES_CODE', '=', 'PENQ_HEAD.SERIES_CODE')
           		->leftjoin('MASTER_PLANT', 'MASTER_PLANT.PLANT_CODE', '=', 'PENQ_HEAD.PLANT_CODE')
           		->where('PENQ_HEAD.FY_CODE',$fisYear)
           		->where('PENQ_HEAD.COMP_CODE',$getcom_code)
           		->orderBy('PENQ_HEAD.PENQHID','DESC');*/
           		//DB::enableQueryLog();
           	$data=DB::select("SELECT PENQ_HEAD.*,PENQ_VENDOR.PENQHID as enqHid,PENQ_VENDOR.PQTNHID,PENQ_VENDOR.PQTNBID,group_concat(concat(PENQ_VENDOR.PQTNHID))AS PQuoSTATUSHD,group_concat(concat(PENQ_VENDOR.PQTNBID))AS PQuoSTATUSBD FROM PENQ_HEAD LEFT JOIN PENQ_VENDOR ON PENQ_VENDOR.PENQHID = PENQ_HEAD.PENQHID WHERE PENQ_HEAD.COMP_CODE='$getcom_code' AND PENQ_HEAD.FY_CODE='$fisYear' GROUP BY PENQ_HEAD.PENQHID");
           //	dd(DB::getQueryLog());
            }else if($userType=='superAdmin' || $userType=='user'){
    
               /*$data = DB::table('enquiry_head')->orderBy('id','DESC');*/

              	$data=DB::select("SELECT PENQ_HEAD.*,PENQ_VENDOR.PENQHID as enqHid,PENQ_VENDOR.PQTNHID,PENQ_VENDOR.PQTNBID,group_concat(concat(PENQ_VENDOR.PQTNHID))AS PQuoSTATUSHD,group_concat(concat(PENQ_VENDOR.PQTNBID))AS PQuoSTATUSBD FROM PENQ_HEAD LEFT JOIN PENQ_VENDOR ON PENQ_VENDOR.PENQHID = PENQ_HEAD.PENQHID WHERE PENQ_HEAD.COMP_CODE='$getcom_code' AND PENQ_HEAD.FY_CODE='$fisYear' GROUP BY PENQ_HEAD.PENQHID");

            }
            else{
    
                $data='';
                
            }

        	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();
        }

        if(isset($compName)){

       		return view('admin.finance.transaction.purchase.view_enquiry_transaction');
        }else{
			return redirect('/useractivity');
		}
        
    }

    public function ViewEnquiryChildRow(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$enquidata = DB::table('PENQ_BODY')->where('VRNO',$vrno)->where('PENQHID',$headid)->get();

	    	$account = DB::table('PENQ_VENDOR')->where('VRNO',$vrno)->where('PENQHID',$headid)->groupBy('PENQ_VENDOR.ACC_CODE')->get();

	    	

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

    public function purchase_enquiry_msg(Request $request,$saveData){

		if ($saveData == 'false'){

			
			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/Transaction/Purchase/View-Purchase-Enquiry-Trans');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Save...!');
			return redirect('/Transaction/Purchase/View-Purchase-Enquiry-Trans');

		}
	}

	public function EditEnquiryPurchase(Request $request,$headid,$bodyid,$vrno){

    	$id =base64_decode($headid);
    	$body_id =base64_decode($bodyid);
    	$vrno  =base64_decode($vrno);

    	if($id!=''){
    	   //	DB::enableQueryLog();
			$userdata['getPurchasenquiry'] = DB::select("SELECT t1.*,t2.*,t2.id as bodyid FROM enquiry_body t2 LEFT JOIN enquiry_head t1 ON t1.id = t2.enquiry_head_id AND t1.vr_no = t2.vr_no WHERE t1.id='$id' AND t1.vr_no='$vrno'");

			$userdata['getPurenqvendor'] = DB::select("SELECT t1.*,t2.* FROM enquiry_vendor t2 LEFT JOIN enquiry_head t1 ON t1.id = t2.enquiry_head_id AND t1.vr_no = t2.vr_no WHERE t1.id='$id' AND t1.vr_no='$vrno'");
			//dd(DB::getQueryLog());
			
			$title       ='Edit Purchase Enquiry';
			
			$CompanyCode = $request->session()->get('company_name');
			$compcode    = explode('-', $CompanyCode);
			$getcompcode =	$compcode[0];
			$macc_year   = $request->session()->get('macc_year');


			$userdata['tax_code_list'] = DB::table('master_tax_rate')->groupBy('tax_code')->get();

			$userdata['getacc'] = DB::table('master_party')->get();

			$userdata['rate_list'] = DB::table('rate_value')->get();

			$getdate = DB::table('master_fy')->where(['comp_code'=>$getcompcode,'fy_code'=>$macc_year])->get();

			foreach ($getdate as $key) {
				$userdata['fromDate'] =  $key->fy_from_date;
				$userdata['toDate']   =  $key->fy_to_date;
			}

			$userdata['series_list'] = DB::table('master_config')->where('tran_code','P0')->get();

			$userdata['help_item_list'] = DB::table('master_item_finance')->get();


			return view('admin.finance.transaction.edit_purchase_enquiry', $userdata+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'HSN Id Not Found...!');
			return redirect('/finance/view-hsn-rate-master');
		}

    }

    public function DeletePurchaseEnqury(Request $request){

        $head_id = $request->input('headID');
        $bodyID = $request->input('bodyID');
        //print_r($row_count);exit;
        if ($head_id!='') {

			$DeleteHead = DB::table('PENQ_HEAD')->where('PENQHID',$head_id)->delete();
			$DeleteBody = DB::table('PENQ_BODY')->where('PENQHID',$head_id)->delete();
			$DeleteQuo  = DB::table('PENQ_QUA')->where('PENQHID',$head_id)->delete();
			$DeleteVen  = DB::table('PENQ_VENDOR')->where('PENQHID',$head_id)->delete();

			$data_indent_body = array(
			
				'PENQHID' =>0,
				'PENQBID' =>0,
			);

			DB::table('PINDENT_BODY')->where('PENQHID',$head_id)->update($data_indent_body);
			//$DeleteTax  = DB::table('PINDENT_QUA')->where('PINDHID',$head_id)->delete();

			if (($DeleteHead && $DeleteBody && $DeleteVen)) {

				$request->session()->flash('alert-success', 'Purchase Enquiry Data Was Deleted Successfully...!');
				return redirect('/Transaction/Purchase/View-Purchase-Enquiry-Trans');

			} else {

				$request->session()->flash('alert-error', 'Purchase Enquiry Data Can Not Deleted...!');
				return redirect('/Transaction/Purchase/View-Purchase-Enquiry-Trans');

			}
		
		}else{

			$request->session()->flash('alert-error', 'Purchase Enquiry Data Not Found...!');
			return redirect('/Transaction/Purchase/View-Purchase-Enquiry-Trans');

		}
	}

/* -----------------  END : PURCHASE ENQUIRY TRANSACTION --------------- */

/* -----------------  START : PURCHASE QUOTATION TRANSACTION --------------- */

	public function PurchaseQuotation(Request $request){

		$title       ='Add Purchase Quotation';
		
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$comp_list     = $this->master_comp; 
		$acc_list      = $this->master_party;
		$tax_code_list = $this->master_tax;
		//$plant_list    = $this->master_plant;
		//$item_list     = $this->master_item;
		$rate_list     = $this->master_rateValue;
		$cost_list     = $this->master_cost;

		$userdata['series_list'] = DB::table('MASTER_CONFIG')->where('TRAN_CODE','P1')->where('COMP_CODE',$getcompcode)->get();

		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		foreach ($getdate as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$functionData = $this->CommonFunction($macc_year,$getcompcode,'P1');
   		$plant_list = $functionData['plant_list'];
   		$item_list  = $functionData['item_list'];

		$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','P1')->get();

   		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;
			
		if(isset($CompanyCode)){

			return view('admin.finance.transaction.purchase.purchase_quotation',$userdata+compact('title','comp_list','acc_list','tax_code_list','plant_list','item_list','rate_list','cost_list'));

		}else{

			return redirect('/useractivity');
		}
	}

	public function SavePuchaseQuotation(Request $request){

		$createdBy           = $request->session()->get('userid');
		$compName            = $request->session()->get('company_name');
		$splitComp           = explode('-', $compName);
		$compCode            = $splitComp[0];
		$fisYear             =  $request->session()->get('macc_year');
		$donwloadStatus      = $request->input('donwloadStatus');
		$comp_nameval        = $request->input('comp_name');
		$fy_year             = $request->input('fy_year');
		$pfct_code           = $request->input('pfct_code');
		$trans_code          = $request->input('trans_code');
		$series_code         = $request->input('series_code');
		$vr_no               = $request->input('vr_no');
		$trans_date          = $request->input('trans_date');
		$tr_vr_date          = date("Y-m-d", strtotime($trans_date));
		$enquiry_date        = $request->input('enquiry_date');
		$enquiry_tran_code   = $request->input('enquiry_tran_code');
		$enquiry_series_code = $request->input('enquiry_series_code');
		$enquiry_vr_no       = $request->input('enquiry_vr_no');
		$enquiry_sl_no       = $request->input('enquiry_sl_no');
		$enquiry_bodyid      = $request->input('enquiry_bodyid');
		$enquiry_headid      = $request->input('enquiry_headid');
		$accountCode         = $request->input('accountCode');
		$plant_code          = $request->input('plant_code');
		$tax_code            = $request->input('tax_code');
		$tax_byitem          = $request->input('tax_byitem');
		$item_code           = $request->input('item_code');
		//print_r($item_code);exit;
		$countItemCode       = count($item_code);
		//print_r($countItemCode);exit();
		$item_name           = $request->input('item_name');
		$remark              = $request->input('remark');
		$qty                 = $request->input('qty');
		$unit_M              = $request->input('unit_M');
		$Aqty                = $request->input('Aqty');
		$add_unit_M          = $request->input('add_unit_M');
		$rate                = $request->input('rate');
		$basic_amt           = $request->input('basic_amt');
		$hsn_code            = $request->input('hsn_code');
		$getdatacount        = $request->input('getdatacount');
		$grandAmt_cr         = $request->input('TotalGrandAmt');
		//print_r($count_rate_ind);exit();
		$head_tax_ind        = $request->input('head_tax_ind');
		$tax_ind_code        = $request->input('taxIndCode');
		$af_rate             = $request->input('af_rate');
		$amount              = $request->input('amount');
		$data_Count          = $request->input('data_Count');
		//print_r($data_Count);
		$rate_ind            = $request->input('rate_ind');
		$crAmtPerItem        = $request->input('crAmtPerItem');
		$logicget            = $request->input('logicget');
		$staticget           = $request->input('staticget');
		$tax_gl_code         = $request->input('taxGlCode');
		
		$quaP_count          = $request->input('quaP_count');
		$allquaPcount        = $request->input('allquaPcount');
		$item_code_que       = $request->input('item_code_que');
		$item_category       = $request->input('item_category');
		$iqua_char           = $request->input('iqua_char');
		$iqua_desc           = $request->input('iqua_desc');
		$char_fromvalue      = $request->input('char_fromvalue');
		$char_tovalue        = $request->input('char_tovalue');
		$partyrfD            = $request->input('party_ref_date');
		$party_ref_date      = date("Y-m-d", strtotime($partyrfD));
		$enqqiryNo           = $request->input('getEnquiryNo');
		$getdueDate          = $request->input('getDue_Date');
		$dueDays             = $request->input('getDue_days');
		$dueDate             = date("Y-m-d", strtotime($getdueDate));

		$PQtnH    = DB::select("SELECT MAX(PQTNHID) as PQTNHID FROM PQTN_HEAD");
		$headID   = json_decode(json_encode($PQtnH), true); 
		
		$headTble = 'PQTN_HEAD';
		$bodyTble = 'PQTN_BODY';
		$taxTble  = 'PQTN_TAX';
		$headId   = 'PQTNHID';
		$pdfName  = 'PURCHASE QUOTATION';
		$vrPName  = 'PQTN NO';
	
		if(empty($headID[0]['PQTNHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['PQTNHID']+1;
		}

		if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('PQTN_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

		DB::beginTransaction();

		try {

			$data = array(

				'PQTNHID'      =>$head_Id,
				'COMP_CODE'    =>$compCode,
				'FY_CODE'      =>$fisYear,
				'PFCT_CODE'    =>$pfct_code,
				'PFCT_NAME'    =>$request->input('pfct_name'),
				'TRAN_CODE'    =>$trans_code,
				'SERIES_CODE'  =>$series_code,
				'SERIES_NAME'  =>$request->input('series_name'),
				'VRNO'         =>$NewVrno,
				'SLNO'         =>1,
				'VRDATE'       =>$tr_vr_date,
				'PLANT_CODE'   =>$plant_code,
				'PLANT_NAME'   =>$request->input('plant_name'),
				'DUEDAYS'      =>$dueDays,
				'DUEDATE'      =>$dueDate,
				'ACC_CODE'     =>$accountCode,
				'ACC_NAME'     =>$request->input('account_name'),
				'CPCODE'       =>$request->input('cp_codeGet'),
				'COST_CENTER'  =>$request->input('Cost_Center'),
				'COST_NAME'    =>$request->input('CostName'),
				'TAX_CODE'     =>$tax_code,
				'PREFNO'       =>$request->input('party_ref_no'),
				'PREFDATE'     =>$party_ref_date,
				'RFHEAD1'      =>$request->input('rfhead1'),
				'RFHEAD2'      =>$request->input('rfhead2'),
				'RFHEAD3'      =>$request->input('rfhead3'),
				'RFHEAD4'      =>$request->input('rfhead4'),
				'RFHEAD5'      =>$request->input('rfhead5'),
				'PMT_TERMS'    =>$request->input('payment_terms'),
				'ADV_RATE_I'   =>$request->input('adv_rate_i'),
				'ADV_RATE'     =>$request->input('adv_rate'),
				'ADV_AMT'      =>$request->input('adv_amt'),
				'CRAMT'        =>$grandAmt_cr,
				'FLAG'         =>'0',
				//'enquiry_no' =>$enqqiryNo,
				'CREATED_BY'   =>$createdBy,

			);
		
			$saveDataH = DB::table('PQTN_HEAD')->insert($data);

			$discriptn_page = "Purchase quotation trans insert done by user";

			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$accountCode);

			$bodyId_Get   = array();
			$bodyId_Getqp = array();

			for ($i=0; $i < $countItemCode ; $i++) { 

				$PQtnB = DB::select("SELECT MAX(PQTNBID) as PQTNBID FROM PQTN_BODY");
				$bodyID = json_decode(json_encode($PQtnB), true); 
			
				if(empty($bodyID[0]['PQTNBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['PQTNBID']+1;
				}

				if($enquiry_headid[$i]){
					$enq_heads = $enquiry_headid[$i];
				}else{
					$enq_heads ='';
				}

				if($enquiry_bodyid[$i]){
					$enq_bodys = $enquiry_bodyid[$i];
				}else{
					$enq_bodys ='';
				}

				if($enquiry_vr_no[$i]){
					$enq_vrno = $enquiry_vr_no[$i];
				}else{
					$enq_vrno ='';
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
				
					'PQTNHID'     =>$head_Id,
					'PQTNBID'     =>$body_Id,
					'COMP_CODE'   =>$compCode,
					'FY_CODE'     =>$fisYear,
					'PFCT_CODE'   =>$pfct_code,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'VRNO'        =>$NewVrno,
					'SLNO'        =>$i+1,
					'VRDATE'      =>$tr_vr_date,
					'PLANT_CODE'  =>$plant_code,
					'PENQHID'     =>$enq_heads,
					'PENQBID'     =>$enq_bodys,
					'PENQ_VRNO'   =>$enq_vrno,
					'ITEM_CODE'   =>$item_code[$i],
					'ITEM_NAME'   =>$item_name[$i],
					'PARTICULAR'  =>$remark[$i],
					'HSN_CODE'    =>$hsn_code[$i],
					'QTYRECD'     =>$qty[$i],
					'UM'          =>$unit_M[$i],
					'AQTYRECD'    =>$Aqty[$i],
					'AUM'         =>$add_unit_M[$i],
					'RATE'        =>$rate[$i],
					'BASICAMT'    =>$basic_amt[$i],
					'TAX_CODE'    =>$tax_byitem[$i],
					'CRAMT'       =>$crAmtPerItem[$i],
					'FLAG'        =>$FLAG,
					'CREATED_BY'  =>$createdBy,
					//'qty_issued'  =>0,
				);

				$saveDataB = DB::table('PQTN_BODY')->insert($data_body);

				if($enquiry_headid[$i] && $enquiry_bodyid[$i] ){

					$data_quatation_body = array(
					
						'PQTNHID'   =>$head_Id,
						'PQTNBID'   =>$body_Id,
						'PQTN_FLAG' =>'1',
					);

					$UpdateInenqry = DB::table('PENQ_VENDOR')->where('ACC_CODE',$accountCode)->where('PENQHID',$enquiry_headid[$i])->where('PENQBID',$enquiry_bodyid[$i])->update($data_quatation_body);

					$enquryData = DB::table('PENQ_VENDOR')->where(
					[
						['PENQBID','=',$enquiry_bodyid[$i]],
						['PQTN_FLAG','=','0']
					])->get();

					$qunryCount =count($enquryData);

					if($qunryCount < 1){

						$data_quatation_body1 = array(
					
							'PQTNHID' =>$head_Id,
							'PQTNBID' =>$body_Id,
						);
			
						$UpdateData = DB::table('PENQ_BODY')->where('PENQHID',$enquiry_headid[$i])->where('PENQBID',$enquiry_bodyid[$i])->update($data_quatation_body1);
					}

				}

				if($data_Count[$i] == 0){

				}else{

					for ($q=0; $q < $data_Count[$i]; $q++) { 

						$a = array_fill(1, $data_Count[$i], $body_Id);
						$str = implode(',',$a); 
						$last_id = explode(',',$str);

						$bodyId_Get[]= $last_id[0];

					}

				}

				if($quaP_count[$i] == 0){

				}else{

					for ($u=0; $u < $quaP_count[$i]; $u++) { 

						$qp = array_fill(1, $quaP_count[$i], $body_Id);
						$strqp = implode(',',$qp); 
						$last_idqp = explode(',',$strqp);

						$bodyId_Getqp[]= $last_idqp[0];

					}

				}

			} /*-- for loop close --*/

			for ($j=0; $j < $getdatacount; $j++) { 

				$PQtnT = DB::select("SELECT MAX(PQTNTID) as PQTNTID FROM PQTN_TAX");
				$taxID = json_decode(json_encode($PQtnT), true); 
			
				if(empty($taxID[0]['PQTNTID'])){
					$tax_Id = 1;
				}else{
					$tax_Id = $taxID[0]['PQTNTID']+1;
				}

				if($amount[$j] == null ||$amount[$j]==''){
					$amountTax = 0.00;
				}else{
					$amountTax = $amount[$j];
				}

				$data_tax = array(
					'PQTNHID'     => $head_Id,
					'PQTNBID'     => $bodyId_Get[$j],
					'PQTNTID'     => $tax_Id,
					'TAXIND_CODE' => $tax_ind_code[$j],
					'TAXIND_NAME' => $head_tax_ind[$j],
					'RATE_INDEX'  => $rate_ind[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $amountTax,
					'TAX_LOGIC'   => $logicget[$j],
					'TAX_GL_CODE' => $tax_gl_code[$j],
					'STATIC_IND'  => $staticget[$j],
					'CREATED_BY'  => $createdBy,
				);
				
				$saveDataT = DB::table('PQTN_TAX')->insert($data_tax);
		
			} /*-- for loop close --*/

			for ($p=0; $p < $allquaPcount; $p++) { 

				$PQtnQu = DB::select("SELECT MAX(PQTNQID) as PQTNQID FROM PQTN_QUA");
				$quoID = json_decode(json_encode($PQtnQu), true); 
			
				if(empty($quoID[0]['PQTNQID'])){
					$quo_Id = 1;
				}else{
					$quo_Id = $quoID[0]['PQTNQID']+1;
				}

				$data_quaP = array(
					'PQTNHID'        => $head_Id,
					'PQTNBID'        => $bodyId_Getqp[$p],
					'PQTNQID'        => $quo_Id,
					'COMP_CODE'      => $compCode,
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
					'IQUA_DESC'      => '',
					'IQUA_UM'        => '',
					'CHAR_FROMVALUE' => $char_fromvalue[$p],
					'CHAR_FROMVALUE' => $char_tovalue[$p],
					'CREATED_BY'     => $createdBy,
				);
			
				$saveDataQ = DB::table('PQTN_QUA')->insert($data_quaP);
		
			} /*-- for loop close --*/

			$bodyTblNm = 'PQTN_BODY';
			$apvTblNm  = 'PQTN_APPROVE';
			$bodyCol   = 'PQTNBID';
			$apvCol    = 'PQTNAID';
			$headCol   = 'PQTNHID';

			$this->approve_Trans($bodyTblNm,$bodyCol,$trans_code,$series_code,$apvTblNm,$compCode,$fisYear,$pfct_code,$trans_code,$series_code,$NewVrno,$tr_vr_date,$createdBy,$head_Id,$apvCol,$headCol);

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->get()->toArray();

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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();
			if($donwloadStatus ==1 ){
				return $this->GeneratePdfForPurchase($trans_code,$headTble,$bodyTble,$headId,$head_Id,$taxTble,$createdBy,$pdfName,$vrPName);
			}
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

	}

	public function purchase_quotatn_save_msg(Request $request,$saveData){
	 //	print_r($savedata);exit;
		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Saved ...!');
			return redirect('/Transaction/Purchase/View-Purchase-Quatation-Trans');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Saved...!');
			return redirect('/Transaction/Purchase/View-Purchase-Quatation-Trans');

		}
	}

	public function ViewPurchaseQuotation(Request $request){

		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

	        $title ='View Purchase Quotation';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $CompanyCode   = $request->session()->get('company_name');
			$compcode = explode('-', $CompanyCode);
			$getcompcode=	$compcode[0];
		    $fisYear =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	        
	         /*$data = DB::table('purchase_quotation_head')
				->select('purchase_quotation_head.*')
           		->orderBy('purchase_quotation_head.id','DESC');*/

           		$data = DB::select("SELECT PQTN_HEAD.*,PQTN_BODY.PQTNHID as pquoHid,PQTN_BODY.PQCS_FLAG,group_concat(concat(PQTN_BODY.PQCS_FLAG))AS PQcSTATUSHD FROM PQTN_HEAD LEFT JOIN PQTN_BODY ON PQTN_BODY.PQTNHID = PQTN_HEAD.PQTNHID WHERE PQTN_HEAD.COMP_CODE='$getcompcode' AND PQTN_HEAD.FY_CODE='$fisYear' GROUP BY PQTN_HEAD.PQTNHID");

            	

	        }else if($userType=='superAdmin' || $userType=='user'){

	           	$data = DB::select("SELECT PQTN_HEAD.*,PQTN_BODY.PQTNHID as pquoHid,PQTN_BODY.PQCS_FLAG,group_concat(concat(PQTN_BODY.PQCS_FLAG))AS PQcSTATUSHD FROM PQTN_HEAD LEFT JOIN PQTN_BODY ON PQTN_BODY.PQTNHID = PQTN_HEAD.PQTNHID WHERE PQTN_HEAD.COMP_CODE='$getcompcode' AND PQTN_HEAD.FY_CODE='$fisYear' GROUP BY PQTN_HEAD.PQTNHID");
	        }
	        else{

	            $data='';
	            
	        }

	    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

	    }

	    if(isset($compName)){

	       return view('admin.finance.transaction.purchase.view_purchase_quotation');
	    }else{
			return redirect('/useractivity');
		}
        
	}

	public function PurchasequotationChieldRTowData(Request $request){

		$response_array = array();

	    $vrno = $request->input('vrno');
	    $tblid = $request->input('tblid');

	   /// print_r($gl_code_help);exit();

		if ($request->ajax()) {

	    	/*$purchase_indent_chield = DB::select("SELECT t1.*,t2.PQTNHID,t2.PQTNBID,t2.PCNTRHID,t2.PCNTRBID FROM `PQTN_BODY` t1 LEFT JOIN PQCS_BODY t2 ON t2.PQTNHID=t1.PQTNHID AND t2.PQTNBID=t1.PQTNBID WHERE t1.PQTNHID='$tblid' AND t1.VRNO='$vrno'");*/

	    	$purchase_indent_chield = DB::select("SELECT t1.* FROM `PQTN_BODY` t1  WHERE t1.PQTNHID='$tblid' AND t1.VRNO='$vrno'");

	    	//print_r($Seach_depot_Code_by_help);exit;
	    	
    		if ($purchase_indent_chield) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $purchase_indent_chield;

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

    public function DeletePurchaseQuotation(Request $request){

        $head_id = $request->input('headID');
        //print_r($row_count);exit;
        if ($head_id!='') {

			$DeleteHead = DB::table('PQTN_HEAD')->where('PQTNHID',$head_id)->delete();
			$DeleteBody = DB::table('PQTN_BODY')->where('PQTNHID',$head_id)->delete();
			$DeleteQuo  = DB::table('PQTN_QUA')->where('PQTNHID',$head_id)->delete();
			$DeleteTax  = DB::table('PQTN_TAX')->where('PQTNHID',$head_id)->delete();
			$DeleteApp  = DB::table('PQTN_APPROVE')->where('PQTNHID',$head_id)->delete();

			$data_enquiry_vendor = array(
			
				'PQTNHID'   =>null,
				'PQTNBID'   =>null,
				'PQTN_FLAG' =>'0',
			);

			DB::table('PENQ_VENDOR')->where('PQTNHID',$head_id)->update($data_enquiry_vendor);
			//$DeleteTax  = DB::table('PINDENT_QUA')->where('PINDHID',$head_id)->delete();

			if (($DeleteHead && $DeleteBody && $DeleteTax)) {

				$request->session()->flash('alert-success', 'Purchase Quotation Data Was Deleted Successfully...!');
				return redirect('/Transaction/Purchase/View-Purchase-Quatation-Trans');

			} else {

				$request->session()->flash('alert-error', 'Purchase Quotation Data Can Not Deleted...!');
				return redirect('/Transaction/Purchase/View-Purchase-Quatation-Trans');

			}
		
		}else{

			$request->session()->flash('alert-error', 'Purchase Quotation Data Not Found...!');
			return redirect('/Transaction/Purchase/View-Purchase-Quatation-Trans');

		}
	}

	public function EditQuatationPurchase(Request $request,$headid,$bodyid,$vrno){

		$title = 'Edit Purchase Quotation';

    	$id =base64_decode($headid);
    	$body_id =base64_decode($bodyid);
    	$vrno  =base64_decode($vrno);
    	

    	//print_r($id);exit;


    	if($id!=''){
    	   
			$userdata['getPurchaseQuotation'] = DB::select("SELECT t1.*,t2.*,t2.id as bodyid,t1.enquiry_no as enqNum FROM purchase_quotation_body t2 LEFT JOIN purchase_quotation_head t1 ON t1.id = t2.purchase_quotation_head_id AND t1.vr_no = t2.vrno WHERE t1.id='$id' AND t1.vr_no='$vrno'");
			
			$CompanyCode = $request->session()->get('company_name');
			$compcode    = explode('-', $CompanyCode);
			$getcompcode =	$compcode[0];
			$macc_year   = $request->session()->get('macc_year');


			$userdata['tax_code_list'] = DB::table('master_tax_rate')->groupBy('tax_code')->get();

			$userdata['rate_list'] = DB::table('rate_value')->get();

			$getdate = DB::table('master_fy')->where(['comp_code'=>$getcompcode,'fy_code'=>$macc_year])->get();

			foreach ($getdate as $key) {
				$userdata['fromDate'] =  $key->fy_from_date;
				$userdata['toDate']   =  $key->fy_to_date;
			}

			$userdata['series_list'] = DB::table('master_config')->where('tran_code','P1')->get();


		
			//DB::enableQueryLog();
			$userdata['dept_list']       = DB::table('dept_master')->get();
			$userdata['plant_list']       = DB::table('master_plant')->get();
			$userdata['pfct_list']       = DB::table('master_pfct')->get();
			//dd(DB::getQueryLog());
			$userdata['bank_list']       = DB::table('master_bank')->get();
			$userdata['cost_list']       = DB::table('master_cost')->get();

			$userdata['getplant'] = DB::table('master_plant')->get();

			$userdata['help_item_list'] = DB::table('master_item_finance')->get();

			return view('admin.finance.transaction.edit_purchase_quotation',$userdata);
		}else{
			$request->session()->flash('alert-error', 'HSN Id Not Found...!');
			return redirect('/finance/view-hsn-rate-master');
		}

	}

	public function UpdatePuchaseQuotation(Request $request){

		$createdBy           = $request->session()->get('userid');
		$compName            = $request->session()->get('company_name');

		$fisYear             =  $request->session()->get('macc_year');

		$head_id             = $request->input('head_id');

		$body_id             = $request->input('body_id');

		$tax_id              = $request->input('tax_id');
	//print_r($tax_id);exit;
		$comp_nameval        = $request->input('comp_name');
		$fy_year             = $request->input('fy_year');
		$pfct_code           = $request->input('pfct_code');
		$trans_code          = $request->input('trans_code');
		$series_code         = $request->input('series_code');
		$vr_no               = $request->input('vr_no');
		$trans_date          = $request->input('trans_date');
		$tr_vr_date          = date("Y-m-d", strtotime($trans_date));
		$enquiry_no          = $request->input('enquiry_no');
		$enquiry_date        = $request->input('enquiry_date');
		$enquiry_tran_code   = $request->input('enquiry_tran_code');
		$enquiry_series_code = $request->input('enquiry_series_code');
		$enquiry_vr_no       = $request->input('enquiry_vr_no');
		$enquiry_sl_no       = $request->input('enquiry_sl_no');
		$accountCode         = $request->input('accountCode');
		$plant_code          = $request->input('plant_code');
		$tax_code            = $request->input('tax_code');
		$tax_byitem          = $request->input('tax_byitem');
		$item_code           = $request->input('item_code');
		//print_r($item_code);exit;
		$countItemCode       = count($item_code);
		//print_r($countItemCode);exit();
		$item_name           = $request->input('item_name');
		$remark              = $request->input('remark');
		$qty                 = $request->input('qty');
		$unit_M              = $request->input('unit_M');
		$Aqty                = $request->input('Aqty');
		$add_unit_M          = $request->input('add_unit_M');
		$rate                = $request->input('rate');
		$basic_amt           = $request->input('basic_amt');
		$hsn_code            = $request->input('hsn_code');
		$getdatacount        = $request->input('getdatacount');
		//print_r($getdatacount);exit();
		$head_tax_ind        = $request->input('head_tax_ind');
		$af_rate             = $request->input('af_rate');
		$amount              = $request->input('amount');
		$data_Count          = $request->input('data_Count');
		//print_r($data_Count);
		$rate_ind            = $request->input('rate_ind');

		$logicget            = $request->input('logicget');

	    $staticget           = $request->input('staticget');
	    $body_taxcode        = $request->input('body_taxcode');

		$bodycount = count($body_id);


		$tax_data = array();

		/*for($k=0; $k< $bodycount; $k++){ 

			$tax_data[] = DB::table('purchase_quotation_tax')->where('purchase_quotation_head_id',$head_id)->where('purchase_quotation_body_id',$body_id[$k])->get()->toArray();

			
		}
			print_r($tax_data[0]);
		exit;*/
		
			$data = array(

				'comp_name'     =>$compName,
				'fiscal_year'   =>$fisYear,
				'company_code'  =>$comp_nameval,
				'fy_code'       =>$fy_year,
				'pfct_code'     =>$pfct_code,
				'tran_code'     =>$trans_code,
				'series_code'   =>$series_code,
				'vr_no'         =>$vr_no,
				'vr_date'       =>$tr_vr_date,
				'acc_code'      =>$accountCode,
				'plant_code'    =>$plant_code,
				'tax_code'      =>$tax_code,
				'partyref_no'   =>$request->input('party_ref_no'),
				'partyref_date' =>$request->input('party_ref_date'),
				'consine_code'  =>$request->input('consine_code'),
				'rfhead1'       =>$request->input('rfhead1'),
				'rfhead2'       =>$request->input('rfhead2'),
				'rfhead3'       =>$request->input('rfhead3'),
				'rfhead4'       =>$request->input('rfhead4'),
				'rfhead5'       =>$request->input('rfhead5'),
				'payment_terms' =>$request->input('payment_terms'),
				'cr_amt'        =>$request->input('cr_amt'),
				'print_flag'    =>'',
				'approved'      =>'',
				'due_date'      =>'',
				'adv_rate_i'    =>$request->input('adv_rate_i'),
				'adv_rate'      =>$request->input('adv_rate'),
				'adv_amt'       =>$request->input('adv_amt'),
				'flag'          =>'0',
				'created_by'    =>$createdBy,

			);
		
		/*$saveData = DB::table('purchase_quotation_head')->where('id',$head_id)->update($data);*/

		//$lastid= DB::getPdo()->lastInsertId();

		$datalistrray = array();

		for ($i=0; $i < $countItemCode ; $i++) { 


			$body_id = $request->input('body_id');
			if($body_id[$i]){
				$getbodyid = $body_id[$i];
			}

			$data_body = array(
			
				'purchase_quotation_head_id' =>$head_id,
				'comp_name'                  =>$compName,
				'fiscal_year'                =>$fisYear,
				'company_code'               =>$comp_nameval,
				'fy_code'                    =>$fy_year,
				'tran_code'                  =>$trans_code,
				'vrno'                       =>$vr_no,
				'slno'                       =>$i+1,
				'enquiry_no'                 =>$enquiry_no[$i],
				'enquiry_date'               =>$enquiry_date[$i],
				'enquiry_trans_code'         =>$enquiry_tran_code[$i],
				'enquiry_series_code'        =>$enquiry_series_code[$i],
				'enquiry_vr_no'              =>$enquiry_vr_no[$i],
				'vr_date'                    =>$tr_vr_date,
				'item_code'                  =>$item_code[$i],
				'item_name'                  =>$item_name[$i],
				'um_code'                    =>$unit_M[$i],
				'aum_code'                   =>$add_unit_M[$i],
				'remark'                     =>$remark[$i],
				'quantity'                   =>$qty[$i],
				'Aquantity'                  =>$Aqty[$i],
				'qty_issued'                 =>0,
				'rate'                       =>$rate[$i],
				'tax_code'                   =>$body_taxcode[$i],
				'hsn_code'                   =>$hsn_code[$i],
				'basic_amt'                  =>$basic_amt[$i],
				'approve_remark'             =>'',
				'flag'                       =>'0',
				'created_by'                 =>$createdBy,
			);

			$saveData = DB::table('purchase_quotation_body')->where('id',$body_id[$i])->update($data_body);

			$UpdateData='';

			$data_quatation_body = array(
			
				'quatation_tcode'       =>$trans_code,
				'quatation_series_code' =>$series_code,
				'quatation_vrno'        =>$vr_no,
				'quatation_date'        =>$tr_vr_date,
			);

			//DB::enableQueryLog();

			$UpdateData = DB::table('enquiry_body')->where('vr_no',$enquiry_no[$i])->where('slno',$enquiry_sl_no[$i])->update($data_quatation_body);


			//$lastid1= DB::getPdo()->lastInsertId();

			if($data_Count[$i] == 0){

			}else{

				for ($q=0; $q < $data_Count[$i]; $q++) { 

					$a = array_fill(1, $data_Count[$i], $getbodyid);
					$str = implode(',',$a); 
					$last_id = explode(',',$str);

					$datalistrray[]= $last_id[0];

				}

			}
		
			

		} /*-- for loop close --*/

		//print_r($datalistrray);exit;

		$getbody = DB::table('purchase_quotation_body')->find(DB::table('purchase_quotation_body')->max('id'));

		$getvrnoCount  = DB::table('purchase_quotation_body')->where('vrno',$getbody->vrno)->get()->toArray();

			$sl_no=array();

			foreach ($getvrnoCount as $key){
				
				$sl_no[]= $key->slno;
			}

			$vrnocount = count($getvrnoCount);


				
		if($saveData){
			for ($j=0; $j < $getdatacount; $j++) {


			

				$data_tax = array(
					'purchase_quotation_head_id' => $head_id,
					'purchase_quotation_body_id' => $datalistrray[$j],
					'rate_index'                 => $rate_ind[$j],
					'tax_ind_name'               => $head_tax_ind[$j],
					'tax_rate'                   => $af_rate[$j],
					'tax_amt'                    => $amount[$j],
					'tax_logic'                  => $logicget[$j],
					'static'                     => $staticget[$j],
					'created_by'                 => $createdBy,
				);
				
				
				$saveData1 = DB::table('purchase_quotation_tax')->where('purchase_quotation_body_id',$datalistrray[$j])->where('id',$tax_id[$j])->update($data_tax);
			
			} /*-- for loop close --*/
			
		} /*-- if close --*/

		$getapprove =	DB::SELECT("SELECT t1.*,t2.* FROM config_approve t1  LEFT JOIN user_approve_ind t2 ON t2.approve_user = t1.approve_ind WHERE t1.tran_code='$trans_code'");

		if($getapprove){

			$configapprove=array();
			$approveind=array();
			$userid=array();

			foreach ($getapprove as $key) {
				# code...
				$configapprove[] =$key->tran_code;
				$approveind[] =$key->approve_ind;
				$userid[] =$key->userid;
				$level_no[] =$key->lavel_name;

			}


			$DeleteData = DB::table('purchase_quatation_approve')->where('series_code',$series_code)->where('tran_code',$trans_code)->where('vr_no',$vr_no)->delete();


			$count = count($configapprove);

			for ($i=0; $i < $count; $i++) { 

				for ($j=0; $j < $vrnocount; $j++) { 
			
					if($level_no[$i]==1){

						$approve_status=3;

						$data_approve = array(
						'comp_name'      =>$compName,
						'fiscal_year'    =>$fisYear,
						'company_code'   =>$comp_nameval,
						'fy_code'        =>$fy_year,
						'pfct_code'      =>$pfct_code,
						'tran_code'      =>$trans_code,
						'series_code'    =>$series_code,
						'slno'           =>$sl_no[$j],
						'vr_no'          =>$vr_no,
						'vr_date'        =>$tr_vr_date,
						'acc_code'       =>$accountCode,
						'plant_code'     =>$plant_code,
						'approved_ind'   =>$approveind[$i],
						'approve_user'   =>$userid[$i],
						'level_no'       =>$level_no[$i],
						'approve_status' =>$approve_status,
						'approve_date'   =>date('Y-m-d'),
						'approve_remark' =>'',
						'flag'           =>'0',
						'lastuser'       =>'0',
						'created_by'     => $createdBy,
					);

					}else{ 
						
						$countmain=$count-1;
							
						if($countmain==$i){

							$lastusr='3';
						}else{
							$lastusr='0';
						}

						$data_approve = array(
								'comp_name'      =>$compName,
								'fiscal_year'    =>$fisYear,
								'company_code'   =>$comp_nameval,
								'fy_code'        =>$fy_year,
								'pfct_code'      =>$pfct_code,
								'tran_code'      =>$trans_code,
								'series_code'    =>$series_code,
								'slno'           =>$sl_no[$j],
								'vr_no'          =>$vr_no,
								'vr_date'        =>$tr_vr_date,
								'acc_code'       =>$accountCode,
								'plant_code'     =>$plant_code,
								'approved_ind'   =>$approveind[$i],
								'approve_user'   =>$userid[$i],
								'level_no'       =>$level_no[$i],
								'approve_status' =>0,
								'approve_date'   =>date('Y-m-d'),
								'approve_remark' =>'',
								'flag'           =>'',
								'lastuser'       =>$lastusr,
								'created_by'     => $createdBy,
							);
					}

					$saveData2 = DB::table('purchase_quatation_approve')->insert($data_approve);

				}
			}

			if ($saveData2) {

	    			$response_array['response'] = 'success';
		            $response_array['lastid'] = $head_id;
		           // $response_array['lastheadid'] = $lastid;

		            $data = json_encode($response_array);

		            print_r($data);

			}else{

					$response_array['response'] = 'error';
	                $response_array['data'] = '' ;

	                $data = json_encode($response_array);

	                print_r($data);
					
			}
			
		}

	}

/* -----------------  END : PURCHASE QUOTATION TRANSACTION --------------- */

/* -----------------  START : PURCHASE QUOTATION COMPARISION TRANSACTION --------------- */

	public function PurchaseQuoComparism(Request $request){

		$title      ='Add Purchase Quo. Comparism';

		$CompanyCode   = $request->session()->get('company_name');
		$compcode = explode('-', $CompanyCode);
		$getcompcode=	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');
		//DB::enableQueryLog();
		$userdata['enquiry_no'] = DB::table('PENQ_HEAD')->where('QTNCOMP_STATUS','0')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->get();
		//dd(DB::getQueryLog());
		$userdata['quotatn_data'] = DB::table('PQTN_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->get();


		/*if(empty($headID[0]['PINDHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['PINDHID']+1;
		}*/
		
		//DB::enableQueryLog();
		$PQcsH = DB::select("SELECT MAX(ID) as PQCSID FROM PQCS_HEAD");
		//dd(DB::getQueryLog());
		$headID = json_decode(json_encode($PQcsH), true);


		if(empty($headID[0]['PQCSID'])){
			$userdata['qc_no_get'] = 'QC1';
			$userdata['qc_id'] = '1';
		}else{
			$number = $headID[0]['PQCSID'] + 1;
			$userdata['qc_no_get'] = 'QC'.$number;
			$userdata['qc_id'] = $number;
		}
			

		if(isset($CompanyCode)){

		    	return view('admin.finance.transaction.purchase.purchase_quo_comparism',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}
	}

	public function SavePurchaseQtnComparism(Request $request){

		$compName         = $request->session()->get('company_name');
		$compcode         = explode('-', $compName);
		$getcompcode      =	$compcode[0];
		$fisYear          =  $request->session()->get('macc_year');
		$requstFQtn       = $request->input('requstFQtn');
		$donwloadStatus   = $request->input('donwloadStatus');
		$plant_Code       = $request->input('plantCode');
		$pfct_Code        = $request->input('pfctCode');
		$tran_Code        = $request->input('tranCode');
		$seires_Code      = $request->input('seiresCode');
		$pq_vrno          = $request->input('pq_vrno');
		$pqsl_no          = $request->input('pqsl_no');
		$qcno             = $request->input('qc_no');
		$qcsHId           = $request->input('qcsHId');
		$item_Code        = $request->input('itemCode');
		$item_Name        = $request->input('itemName');
		$um_Code          = $request->input('umCode');
		$aum_Code         = $request->input('aumCode');
		$tax_Code         = $request->input('taxCode');
		$hsn_Code         = $request->input('hsnCode');
		$itemdetail       = $request->input('itemdetail');
		$pur_qutn_head_id = $request->input('pur_qutn_head_id');
		$pur_qtn_body_id  = $request->input('pur_qtn_body_id');
		$quantity         = $request->input('quantity');
		$Aquantity        = $request->input('Aquantity');
		$acc_code         = $request->input('acc_code');
		$acc_name         = $request->input('acc_name');
		$qtn_no           = $request->input('qtn_no');
		$rate             = $request->input('rate');
		$basic_amt        = $request->input('basic_amt');
		$cr_amt           = $request->input('cr_amt');
		$level            = $request->input('level');
		$transDateFm      = $request->input('vrDate');
		$today_date       = date("Y-m-d");
			//$transDateFm      = date("Y-m-d", strtotime($transDate));
		$userid    = $request->session()->get('userid');

		DB::beginTransaction();

		try {

			$datahead = array(
				'ID'         => $qcsHId,
				'PQCSHID'    => $qcno,
				'RFQNO'      => $requstFQtn,
				'COMP_CODE'  => $getcompcode,
				'FY_CODE'    => $fisYear,
				'PLANT_CODE' => $plant_Code,
				'PFCT_CODE'  => $pfct_Code,
				'VRDATE'     => $today_date,
				'CREATED_BY' => $userid
			);

			$saveDataH = DB::table('PQCS_HEAD')->insert($datahead);
			
			$itemCount = count($item_Code);

			for ($i=0; $i <$itemCount ; $i++) { 

				$PQcsB = DB::select("SELECT MAX(PQCSBID) as PQCSBID FROM PQCS_BODY");
				$bodyID = json_decode(json_encode($PQcsB), true); 
			
				if(empty($bodyID[0]['PQCSBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['PQCSBID']+1;
				}

				$databody = array(

					'PQCSHID'     => $qcno,
					'PQCSBID'     => $body_Id,
					'PQCSNO'      => $qcno,
					'COMP_CODE'   => $getcompcode,
					'FY_CODE'     => $fisYear,
					'PFCT_CODE'   => $pfct_Code,
					'TRAN_CODE'   => $tran_Code,
					'SERIES_CODE' => $seires_Code,
					'VRNO'        => $pq_vrno[$i],
					'SLNO'        => $pqsl_no[$i],
					'VRDATE'      => $transDateFm[$i],
					'PLANT_CODE'  => $plant_Code,
					'PQTNHID'     => $pur_qutn_head_id[$i],
					'PQTNBID'     => $pur_qtn_body_id[$i],
					'ACC_CODE'    => $acc_code[$i],
					'ACC_NAME'    => $acc_name[$i],
					'ITEM_CODE'   => $item_Code[$i],
					'ITEM_NAME'   => $item_Name[$i],
					'PARTICULAR'  => $itemdetail[$i],
					'HSN_CODE'    => $hsn_Code[$i],
					'QTYRECD'     => $quantity[$i],
					'UM'          => $um_Code[$i],
					'AQTYRECD'    => $Aquantity[$i],
					'AUM'         => $aum_Code[$i],
					'RATE'        => $rate[$i],
					'BASICAMT'    => $basic_amt[$i],
					'TAX_CODE'    => $tax_Code[$i],
					'CRAMT'       => $cr_amt[$i],
					'LEVEL'       => $level[$i],
					'PQTN_VRNO'   => $qtn_no[$i],
					'CREATED_BY'  => $userid

				);

				$saveDataB = DB::table('PQCS_BODY')->insert($databody);

				$qtn_comp_no =array(
					'PQCS_FLAG' =>$qcno,
				);

		    	DB::table('PQTN_BODY')->where('PQTNHID',$pur_qutn_head_id[$i])->where('PQTNBID',$pur_qtn_body_id[$i])->update($qtn_comp_no);

			}

			$qtn_comp_done =array(
				'QTNCOMP_STATUS' =>1,
			);

			$UpdateData = DB::table('PENQ_HEAD')->where('VRNO',$requstFQtn)->update($qtn_comp_done);

			DB::commit();

				if($donwloadStatus == 1){
					return $this->generatePdfForQuoComp($qcno);
				}
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
			
		
    }

    public function purQuoComparismSaveMsg(Request $request,$saveData){

		if ($saveData == 'false'){

			$request->session()->flash('alert-error', 'Data Can Not Added ...!');
			return redirect('/Transaction/Purchase/View-Purchase-Quatation-Trans');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/Transaction/Purchase/View-Purchase-Quatation-Trans');

		}
	}

	public function PurchaseQuoComparisionView(Request $request){

		$compName = $request->session()->get('company_name');

    	if($request->ajax()) {

	        $title ='View Quotation Comparision';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $comp_nameval = $request->session()->get('company_name');
	        $explode          = explode('-', $comp_nameval);
	   	 	$getcom_code      = $explode[0];

	        $fisYear =  $request->session()->get('macc_year');

	        //DB::enableQueryLog();
            $data =DB::select("SELECT PQCS_HEAD.*,PQCS_BODY.PQCSHID as PQCSHIDS,PQCS_BODY.VRNO,PQCS_BODY.PQCSBID,PQCS_BODY.PQTNHID,PQCS_BODY.PQTNBID FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID WHERE PQCS_HEAD.COMP_CODE='$getcom_code' AND PQCS_HEAD.FY_CODE='$fisYear'");
	        //dd(DB::getQueryLog());  

	   		return DataTables()->of($data)->addIndexColumn()->make(true);

	    }

	    if(isset($compName)){

	       return view('admin.finance.transaction.purchase.view_quotation_comparision');
	    }else{
			return redirect('/useractivity');
		}

	}

	public function PurchaseQuoComparisionChildData(Request $request){

		$response_array = array();

	    $vrno = $request->input('vrno');
	    $tblid = $request->input('tblid');

	   /// print_r($gl_code_help);exit();

		if ($request->ajax()) {

	    	$purchase_comparision_chield = DB::table("PQCS_BODY")->where('PQCSHID',$tblid)->where('VRNO',$vrno)->get();

	    	
    		if ($purchase_comparision_chield) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $purchase_comparision_chield ;

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

/* -----------------  END : PURCHASE QUOTATION COMPARISION TRANSACTION --------------- */




/* -----------------  START : PURCHASE CONTRACT TRANSACTION --------------- */
	
	public function PurchaseContract(Request $request){

		$title       ='Add Purchase Contract Transaction';
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$userdata['getacc']         = $this->master_party;
		$userdata['tax_code_list']  = $this->master_tax;
		//$userdata['plant_list']     = $this->master_plant;
		//$userdata['help_item_list'] = $this->master_item;
		$userdata['rate_list']      = $this->master_rateValue;
		$userdata['cost_list']      = $this->master_cost;
		$userdata['qtn_comp_list']  = DB::table('PQCS_HEAD')->get();
		$TranCode = 'P2';

		$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','P2')->get();
   		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;

		$functionData = $this->CommonFunction($macc_year,$getcompcode,$TranCode);

		foreach ($functionData['fy_list'] as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$series_list                = $functionData['series_list'];
		$userdata['plant_list']     = $functionData['plant_list'];
		$userdata['help_item_list'] = $functionData['item_list'];
	
		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.purchase.contract_trans',$userdata+compact('title','series_list'));

	    }else{

			return redirect('/useractivity');
		}
	}

	public function SaveContractPurchase(Request $request){

		//print_r($request->input('tolerence_index'));exit;
		$donwloadStatus   = $request->input('donwloadStatus');
		$createdBy = $request->session()->get('userid');
		$compName  = $request->session()->get('company_name');
		$fisYear   =  $request->session()->get('macc_year');
		$splitComp = explode('-', $compName);
		$compCode  = $splitComp[0];
		$comp_nameval   = $request->input('comp_name');
		$fy_year        = $request->input('fy_year');
		$pfct_code      = $request->input('pfct_code');
		$trans_code     = $request->input('trans_code');
		$series_code    = $request->input('series_code');
		$vr_no          = $request->input('vr_no');
		
		$trans_date     = $request->input('trans_date');
		$tr_vr_date     = date("Y-m-d", strtotime($trans_date));
		
		$duadate_date   = $request->input('getdue_date');
		$dua_date       = date("Y-m-d", strtotime($duadate_date));
		$dueDays        = $request->input('getDue_days');
		
		$party_ref_date = $request->input('party_ref_date');
		$partyRefDate   = date("Y-m-d", strtotime($party_ref_date));
		
		$accountCode    = $request->input('accountCode');
		$plant_code     = $request->input('plant_code');
		
		//print_r($plant_code);exit;
		$tax_code       = $request->input('tax_code');
		$tax_byitem     = $request->input('tax_byitem');
		
		$item_code      = $request->input('item_code');
		$item_codeQc    = $request->input('item_codeQc');
		$item_codeAll   = $request->input('item_codeAll');
		
		
		$countItemCode  = count($item_code);
		//print_r($countItemCode);exit();
		$item_name      = $request->input('item_name');
		$levelItm       = $request->input('levelI');
		$remark         = $request->input('remark');
		$qty            = $request->input('qty');
		$unit_M         = $request->input('unit_M');
		$Aqty           = $request->input('Aqty');
		$add_unit_M     = $request->input('add_unit_M');
		$rate           = $request->input('rate');
		$basic_amt      = $request->input('basic_amt');
		$crAmtPerItm    = $request->input('crAmtPerItm');
		$grandAmt_cr    = $request->input('TotalGrandAmt');
		
		$hsn_code       = $request->input('hsn_code');
		
		$getdatacount   = $request->input('getdatacount');
		
		
		//print_r($count_rate_ind);exit();
		$head_tax_ind   = $request->input('head_tax_ind');
		$tax_ind_code   = $request->input('taxIndCode');
		$af_rate        = $request->input('af_rate');
		$amount         = $request->input('amount');
		
		$data_Count     = $request->input('data_Count');
		//print_r($data_Count);
		$rate_ind       = $request->input('rate_ind');
		$logicget       = $request->input('logicget');
		$staticget      = $request->input('staticget');
		$tax_gl_code    = $request->input('taxGlCode');
		
		$tol_index      = $request->input('tolerence_index');
		$tol_rate       = $request->input('tolerence_rate');
		$tol_value      = $request->input('tolerence_value');
		$quoComp_no     = $request->input('quoComp_no');
		
		$pqHeadId       = $request->input('pur_QtnHeadId');
		$pqBodyid       = $request->input('pur_qtnbodyid');
		$qtnvr          = $request->input('qtnNos');
		$qcnum          = $request->input('qtn_compNo');
		
		
		$quaP_count     = $request->input('quaP_count');
		$allquaPcount   = $request->input('allquaPcount');
		$item_code_que  = $request->input('item_code_que');
		$item_category  = $request->input('item_category');
		$iqua_char      = $request->input('iqua_char');
		$iqua_desc      = $request->input('iqua_desc');
		$char_fromvalue = $request->input('char_fromvalue');
		$char_tovalue   = $request->input('char_tovalue');
		$quotationcomNo = $request->input('quotation_no');

		$headTble = 'PCNTR_HEAD';
		$bodyTble = 'PCNTR_BODY';
		$taxTble  = 'PCNTR_TAX';
		$headId   = 'PCNTRHID';
		$pdfName  = 'PURCHASE CONTRACT';
		$vrPName   ='PCNTR NO';
		

		$PcntrH = DB::select("SELECT MAX(PCNTRHID) as PCNTRHID FROM PCNTR_HEAD");
		$headID = json_decode(json_encode($PcntrH), true); 
	
		if(empty($headID[0]['PCNTRHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['PCNTRHID']+1;
		}

		if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('PCNTR_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

		DB::beginTransaction();

		try {

			$data = array(

				'PCNTRHID'           =>$head_Id,
				'COMP_CODE'          =>$compCode,
				'FY_CODE'            =>$fisYear,
				'PFCT_CODE'          =>$pfct_code,
				'PFCT_NAME'          =>$request->input('pfct_name'),
				'TRAN_CODE'          =>$trans_code,
				'SERIES_CODE'        =>$series_code,
				'SERIES_NAME'        =>$request->input('series_name'),
				'VRNO'               =>$NewVrno,
				'VRDATE'             =>$tr_vr_date,
				'PLANT_CODE'         =>$plant_code,
				'PLANT_NAME'         =>$request->input('plant_name'),
				'DUEDAYS'            =>$dueDays,
				'DUEDATE'            =>$dua_date,
				'ACC_CODE'           =>$accountCode,
				'ACC_NAME'           =>$request->input('account_name'),
				'CPCODE'             =>$request->input('cp_codeGet'),
				'COST_CENTER'        =>$request->input('Cost_Center'),
				'COST_NAME'          =>$request->input('CostName'),
				'TAX_CODE'           =>$tax_code,
				'PREFNO'             =>$request->input('party_ref_no'),
				'PREFDATE'           =>$partyRefDate,
				'RFHEAD1'            =>$request->input('rfhead1'),
				'RFHEAD2'            =>$request->input('rfhead2'),
				'RFHEAD3'            =>$request->input('rfhead3'),
				'RFHEAD4'            =>$request->input('rfhead4'),
				'RFHEAD5'            =>$request->input('rfhead5'),
				'PMT_TERMS'          =>$request->input('payment_terms'),
				'ADV_RATE_I'         =>$request->input('adv_rate_i'),
				'ADV_RATE'           =>$request->input('adv_rate'),
				'ADV_AMT'            =>$request->input('adv_amt'),
				'CRAMT'              =>$grandAmt_cr,
				'PQCSHID'            =>$quoComp_no,
				/*'quotationComp_no' =>$quotationcomNo,*/
				'CREATED_BY'         =>$createdBy,

			);
			$saveDataH = DB::table('PCNTR_HEAD')->insert($data);

			$discriptn_page = "Purchase contract trans insert done by user";

			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$accountCode);
		
			$bodyIdTax = array();
			$bodyIdQP  = array();

			for ($i=0; $i < $countItemCode ; $i++) { 

				$PcntrB = DB::select("SELECT MAX(PCNTRBID) as PCNTRBID FROM PCNTR_BODY");
				$bodyID = json_decode(json_encode($PcntrB), true); 
			
				if(empty($bodyID[0]['PCNTRBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['PCNTRBID']+1;
				}

				if($item_codeQc[$i]){
					$itemcde = $item_codeQc[$i];
				}else if($item_codeAll[$i]){
					$itemcde = $item_codeAll[$i];
				}else{}
			
				$configapp = DB::table('MASTER_CONFIG_APPROVE')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->get()->toArray();

				if($configapp){
				//	print_r('hi');exit;
					$FLAG = 0;
				}else{
					//print_r('hello');exit;
					$FLAG = 3;
				}

				$data_body = array(
			
					'PCNTRHID'    =>$head_Id,
					'PCNTRBID'    =>$body_Id,
					'COMP_CODE'   =>$compCode,
					'FY_CODE'     =>$fisYear,
					'PFCT_CODE'   =>$pfct_code,
					'tran_code'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'VRNO'        =>$NewVrno,
					'SLNO'        =>$i+1,
					'VRDATE'      =>$tr_vr_date,
					'PLANT_CODE'  =>$plant_code,
					'PQTNHID'     =>$pqHeadId[$i],
					'PQTNBID'     =>$pqBodyid[$i],
					'PQCSHID'     =>$quoComp_no,
					'ITEM_CODE'   =>$itemcde,
					'ITEM_NAME'   =>$item_name[$i],
					'PARTICULAR'  =>$remark[$i],
					'HSN_CODE'    =>$hsn_code[$i],
					'QTYRECD'     =>$qty[$i],
					'UM'          =>$unit_M[$i],
					'AQTYRECD'    =>$Aqty[$i],
					'AUM'         =>$add_unit_M[$i],
					'RATE'        =>$rate[$i],
					'BASICAMT'    =>$basic_amt[$i],
					'TAX_CODE'    =>$tax_byitem[$i],
					'CRAMT'       =>$crAmtPerItm[$i],
					'TOL_INDEX'   =>$tol_index[$i],
					'TOL_RATE'    =>$tol_rate[$i],
					'FLAG'        =>$FLAG,
					'CREATED_BY'  =>$createdBy,
					/*'level_i'   =>$levelItm[$i],
					'tol_value'   =>$tol_value[$i],*/
				);

				//print_r($data_body);

				$saveDataB = DB::table('PCNTR_BODY')->insert($data_body);

				if($qcnum[$i] && $pqHeadId[$i] && $pqBodyid[$i]){

					$getQtyIsue = DB::table('PQCS_BODY')->where(['PQCSHID'=>$qcnum[$i],'PQTNHID'=>$pqHeadId[$i],'PQTNBID'=>$pqBodyid[$i]])->get()->first();
					
					$getqtyIsued = $getQtyIsue->QTYISSUED;

					$data_qtyIsd = array(
						'QTYISSUED' =>$getqtyIsued+$qty[$i],
					);

					$updatevr = DB::table('PQCS_BODY')->where(['PQCSHID'=>$qcnum[$i],'PQTNHID'=>$pqHeadId[$i],'PQTNBID'=>$pqBodyid[$i]])->update($data_qtyIsd);

					$getQtyIsEqual = DB::table('PQCS_BODY')->where(['PQCSHID'=>$qcnum[$i],'PQTNHID'=>$pqHeadId[$i],'PQTNBID'=>$pqBodyid[$i]])->get()->first();

					if($getQtyIsEqual->QTYRECD == $getQtyIsEqual->QTYISSUED){

						$data_contract_body = array(
				
							'PCNTRHID'   =>$head_Id,
							'PCNTRBID' =>$body_Id,
						);

				 		DB::table('PQCS_BODY')->where(['PQCSHID'=>$qcnum[$i],'PQTNHID'=>$pqHeadId[$i],'PQTNBID'=>$pqBodyid[$i]])->update($data_contract_body);
					}
				
				}

				if($data_Count[$i] == 0){

				}else{

					for ($q=0; $q < $data_Count[$i]; $q++) { 

						$a = array_fill(1, $data_Count[$i], $body_Id);
						$str = implode(',',$a); 
						$last_id = explode(',',$str);

						$bodyIdTax[]= $last_id[0];
				  	}
				}

				if($quaP_count[$i] == 0){

				}else{

					for ($u=0; $u < $quaP_count[$i]; $u++) { 

						$qp = array_fill(1, $quaP_count[$i], $body_Id);
						$strqp = implode(',',$qp); 
						$last_idqp = explode(',',$strqp);

						$bodyIdQP[]= $last_idqp[0];

					}

				}

			} /*-- for loop close --*/

			for ($j=0; $j < $getdatacount; $j++) { 

				$PcntrT = DB::select("SELECT MAX(PCNTRTID) as PCNTRTID FROM PCNTR_TAX");
				$taxID = json_decode(json_encode($PcntrT), true); 
			
				if(empty($taxID[0]['PCNTRTID'])){
					$tax_Id = 1;
				}else{
					$tax_Id = $taxID[0]['PCNTRTID']+1;
				}

				if($amount[$j] == null ||$amount[$j]==''){
					$amountTax = 0.00;
				}else{
					$amountTax = $amount[$j];
				}

				$data_tax = array(
					'PCNTRHID'    => $head_Id,
					'PCNTRBID'    => $bodyIdTax[$j],
					'PCNTRTID'    => $tax_Id,
					'TAXIND_CODE' => $tax_ind_code[$j],
					'TAXIND_NAME' => $head_tax_ind[$j],
					'RATE_INDEX'  => $rate_ind[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $amountTax,
					'TAX_LOGIC'   => $logicget[$j],
					'TAXGL_CODE'  => $tax_gl_code[$j],
					'STATIC_IND'  => $staticget[$j],
					'CREATED_BY'  => $createdBy,
				);
				
				$saveDataT = DB::table('PCNTR_TAX')->insert($data_tax);
		
			} /*-- for loop close --*/


			for ($p=0; $p < $allquaPcount; $p++) { 

				$PcntrQu = DB::select("SELECT MAX(PCNTRQID) as PCNTRQID FROM PCNTR_QUA");
				$quoID = json_decode(json_encode($PcntrQu), true); 
			
				if(empty($quoID[0]['PCNTRQID'])){
					$quo_Id = 1;
				}else{
					$quo_Id = $quoID[0]['PCNTRQID']+1;
				}

				$srNoQ = $p+1;

				$data_quaP = array(
					'PCNTRHID'       => $head_Id,
					'PCNTRBID'       => $bodyIdQP[$p],
					'PCNTRQID'       => $quo_Id,
					'COMP_CODE'      => $compCode,
					'FY_CODE'        => $fisYear,
					'PFCT_CODE'      => $pfct_code,
					'TRAN_CODE'      => $trans_code,
					'SERIES_CODE'    => $series_code,
					'VRNO'           => $NewVrno,
					'SLNO'           => $srNoQ,
					'VRDATE'         => $tr_vr_date,
					'PLANT_CODE'     => $plant_code,
					'ITEM_CODE'      => $item_code_que[$p],
					'ICATG_CODE'     => $item_category[$p],
					'IQUA_CHAR'      => $iqua_char[$p],
					'IQUA_DESC'      => '',
					'IQUA_UM'        => '',
					'CHAR_FROMVALUE' => $char_fromvalue[$p],
					'CHAR_TOVALUE'   => $char_tovalue[$p],
					'CREATED_BY'     => $createdBy,
				);
				
			 	DB::table('PCNTR_QUA')->insert($data_quaP);
		
			} /*-- for loop close --*/

			$bodyTblNm = 'PCNTR_BODY';
			$apvTblNm  = 'PCNTR_APPROVE';
			$bodyCol   = 'PCNTRBID';
			$apvCol    = 'PCNTRAID';
			$headCol   = 'PCNTRHID';

			$this->approve_Trans($bodyTblNm,$bodyCol,$trans_code,$series_code,$apvTblNm,$compCode,$fisYear,$pfct_code,$trans_code,$series_code,$NewVrno,$tr_vr_date,$createdBy,$head_Id,$apvCol,$headCol);

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->get()->toArray();

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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();

			if($donwloadStatus ==1 ){
				return $this->GeneratePdfForPurchase($trans_code,$headTble,$bodyTble,$headId,$head_Id,$taxTble,$createdBy,$pdfName,$vrPName);
			}

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
			
	} /*-- /. main function close --  */

	public function purchase_contract_save_msg(Request $request,$saveData){
	 //	print_r($savedata);exit;
		if ($saveData) {

			$request->session()->flash('alert-success', 'Purchase Contract Was Successfully Added...!');
			return redirect('/Transaction/Purchase/View-Contract-Trans');

		} else {

			$request->session()->flash('alert-error', 'Purchase Contract Can Not Added...!');
			return redirect('/Transaction/Purchase/View-Contract-Trans');

		}
	}

	public function ViewPurchaseContract(Request $request){

		$compName = $request->session()->get('company_name');

    	if($request->ajax()) {

	        $title ='View Contract';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $comp_nameval = $request->session()->get('company_name');
	        $explode          = explode('-', $comp_nameval);
	   	 	$getcom_code      = $explode[0];

	        $fisYear =  $request->session()->get('macc_year');


        	if($userType=='admin' || $userType=='Admin'){

        
	         	/*$data = DB::table('contract_head')->orderBy('id','DESC');*/
	        	// DB::enableQueryLog();
	         	/*$data = DB::table('PCNTR_HEAD')
					->select('PCNTR_HEAD.*', 'MASTER_CONFIG.SERIES_NAME','MASTER_PLANT.PLANT_NAME','MASTER_ACC.ACC_NAME','PCNTR_BODY.PCNTRHID AS pctrnHid','PCNTR_BODY.PORDERHID','PCNTR_BODY.PORDERBID')
	           		->leftjoin('MASTER_CONFIG', 'MASTER_CONFIG.SERIES_CODE', '=', 'PCNTR_HEAD.SERIES_CODE')
	           		->leftjoin('MASTER_PLANT', 'MASTER_PLANT.PLANT_CODE', '=', 'PCNTR_HEAD.PLANT_CODE')
	           		->leftjoin('MASTER_ACC', 'MASTER_ACC.ACC_CODE', '=', 'PCNTR_HEAD.ACC_CODE')
	           		->leftjoin('PCNTR_BODY', 'PCNTR_BODY.PCNTRHID', '=', 'PCNTR_HEAD.PCNTRHID')
	           		->where('PCNTR_HEAD.FY_CODE',$fisYear)
	           		->groupBy('PCNTR_HEAD.VRNO')
	           		->orderBy('PCNTR_HEAD.PCNTRHID','DESC');*/
	         	//dd(DB::getQueryLog());  		

           		$data =DB::select("SELECT PCNTR_HEAD.*,PCNTR_BODY.PCNTRHID as prchid,PCNTR_BODY.PCNTRBID,PCNTR_BODY.PORDERHID,PCNTR_BODY.PORDERBID,group_concat(concat(PCNTR_BODY.PORDERHID))AS PCONSTATUSHD,group_concat(concat(PCNTR_BODY.PORDERBID))AS PCONTSTATUSBD,group_concat(concat(PCNTR_BODY.QTYISSUED))AS nextTranQty FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_BODY.PCNTRHID = PCNTR_HEAD.PCNTRHID WHERE PCNTR_HEAD.COMP_CODE='$getcom_code' AND PCNTR_HEAD.FY_CODE='$fisYear' GROUP BY PCNTR_HEAD.PCNTRHID");

        	}else if($userType=='superAdmin' || $userType=='user'){

        		 /*$data = DB::table('PCNTR_HEAD')
				->select('PCNTR_HEAD.*', 'MASTER_CONFIG.SERIES_NAME','MASTER_PLANT.PLANT_NAME','MASTER_ACC.ACC_NAME','PCNTR_BODY.PCNTRHID AS pctrnHid','PCNTR_BODY.PORDERHID','PCNTR_BODY.PORDERBID')
           		->leftjoin('MASTER_CONFIG', 'MASTER_CONFIG.SERIES_CODE', '=', 'PCNTR_HEAD.SERIES_CODE')
           		->leftjoin('MASTER_PLANT', 'MASTER_PLANT.PLANT_CODE', '=', 'PCNTR_HEAD.PLANT_CODE')
           		->leftjoin('MASTER_ACC', 'MASTER_ACC.ACC_CODE', '=', 'PCNTR_HEAD.ACC_CODE')
           		->leftjoin('PCNTR_BODY', 'PCNTR_BODY.PCNTRHID', '=', 'PCNTR_HEAD.PCNTRHID')
           		->where('PCNTR_HEAD.FY_CODE',$fisYear)
           		->groupBy('PCNTR_HEAD.VRNO')
           		->orderBy('PCNTR_HEAD.PCNTRHID','DESC');*/

           		$data =DB::select("SELECT PCNTR_HEAD.*,PCNTR_BODY.PCNTRHID as prchid,PCNTR_BODY.PCNTRBID,PCNTR_BODY.PORDERHID,PCNTR_BODY.PORDERBID,group_concat(concat(PCNTR_BODY.PORDERHID))AS PCONSTATUSHD,group_concat(concat(PCNTR_BODY.PORDERBID))AS PCONTSTATUSBD,group_concat(concat(PCNTR_BODY.QTYISSUED))AS nextTranQty FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_BODY.PCNTRHID = PCNTR_HEAD.PCNTRHID WHERE PCNTR_HEAD.COMP_CODE='$getcom_code' AND PCNTR_HEAD.FY_CODE='$fisYear' GROUP BY PCNTR_HEAD.PCNTRHID");
	        }
	        else{

	            $data='';
	            
        	}

	   		return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	        })->toJson();

	    }

	    if(isset($compName)){

	       return view('admin.finance.transaction.purchase.view_contract_trans');
	    }else{
			return redirect('/useractivity');
		}
        
	}

	public function PurchaseContractChieldRTowData(Request $request){

		$response_array = array();

	    $vrno = $request->input('vrno');
	    $tblid = $request->input('tblid');

	   /// print_r($gl_code_help);exit();

		if ($request->ajax()) {

	    	$purchase_contract_chield = DB::table("PCNTR_BODY")->where('PCNTRHID',$tblid)->where('VRNO',$vrno)->get();

	    	//print_r($Seach_depot_Code_by_help);exit;
	    	
    		if ($purchase_contract_chield) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $purchase_contract_chield ;

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

    public function DeletePurchaseContract(Request $request){

        $head_id = $request->input('headID');
        //print_r($row_count);exit;
        if ($head_id!='') {

			$DeleteHead = DB::table('PCNTR_HEAD')->where('PCNTRHID',$head_id)->delete();
			$DeleteBody = DB::table('PCNTR_BODY')->where('PCNTRHID',$head_id)->delete();
			$DeleteQuo  = DB::table('PCNTR_QUA')->where('PCNTRHID',$head_id)->delete();
			$DeleteTax  = DB::table('PCNTR_TAX')->where('PCNTRHID',$head_id)->delete();
			$DeleteApp  = DB::table('PCNTR_APPROVE')->where('PCNTRHID',$head_id)->delete();

			if (($DeleteHead && $DeleteBody && $DeleteTax)) {

				$request->session()->flash('alert-success', 'Purchase Contract Data Was Deleted Successfully...!');
				return redirect('/Transaction/Purchase/View-Contract-Trans');

			} else {

				$request->session()->flash('alert-error', 'Purchase Contract Data Can Not Deleted...!');
				return redirect('/Transaction/Purchase/View-Contract-Trans');

			}
		
		}else{

			$request->session()->flash('alert-error', 'Purchase Contract Data Not Found...!');
			return redirect('/Transaction/Purchase/View-Contract-Trans');

		}
	}

	public function EditContractTrans(Request $request,$headid,$bodyid,$vrno){

		$title ='Edit Purchase Contract';

		$id      =base64_decode($headid);
		$body_id =base64_decode($bodyid);
		$vr_No   =base64_decode($vrno);

		if($id){

			$userdata['getPQuo'] = DB::select("SELECT t1.*,t2.*,t2.PCNTRBID as bodyid,t3.SERIES_NAME,t4.ACC_NAME,t5.COST_NAME FROM PCNTR_BODY t2 LEFT JOIN PCNTR_HEAD t1 ON t1.PCNTRHID = t2.PCNTRHID AND t1.VRNO = t2.VRNO LEFT JOIN MASTER_CONFIG t3 ON t3.SERIES_CODE=t1.SERIES_CODE LEFT JOIN MASTER_ACC t4 ON t4.ACC_CODE=t1.ACC_CODE LEFT JOIN MASTER_COST t5 ON t5.COST_CODE=t1.COST_CENTER WHERE t1.PCNTRHID='$id' AND t1.VRNO='$vr_No' ");

			
			$plantCode = $userdata['getPQuo'][0]->PLANT_CODE;
			$acc_code  = $userdata['getPQuo'][0]->ACC_CODE;
			$shipAddr  = $userdata['getPQuo'][0]->CPCODE;
			//DB::enableQueryLog();
			$userdata['pfct_data'] = DB::table('MASTER_PLANT')
				->select('MASTER_PLANT.PLANT_CODE','MASTER_PLANT.PLANT_NAME','MASTER_PLANT.STATE', 'MASTER_PFCT.*')
           		->leftjoin('MASTER_PFCT', 'MASTER_PLANT.PFCT_CODE', '=', 'MASTER_PFCT.PFCT_CODE')
            	->where([['MASTER_PLANT.PLANT_CODE','=',$plantCode]])
            	->get();
            //dd(DB::getQueryLog());	
            $getStateCode = DB::table('MASTER_ACCADD')->where('ACC_CODE',$acc_code)->where('ADD1',$shipAddr)->get()->first();

            $stateOfAcc = $getStateCode->STATE_CODE;

			$CompanyCode = $request->session()->get('company_name');
			$compcode    = explode('-', $CompanyCode);
			$getcompcode =	$compcode[0];
			$macc_year   = $request->session()->get('macc_year');

			$tableData = MyConstruct();
			$userdata['item_list']    = $tableData['master_item'];
			$userdata['ratval_list']  = $tableData['master_rateValue'];
			$transCode   = 'P2';

			$getCommonData = MyCommonFun($transCode,$getcompcode,$macc_year);
			$userdata['series_list'] = $getCommonData['getseries'];

			foreach ($getCommonData['getdate'] as $fydata) {

				$userdata['fromDate'] =  $fydata->FY_FROM_DATE;
				$userdata['toDate']   =  $fydata->FY_TO_DATE;
			
			}

	    	return view('admin.finance.transaction.purchase.edit_contract_purchase',$userdata+compact('title','stateOfAcc'));

	    }else{

			return redirect('/useractivity');
		}
	}

	public function UpdateContractTrans(Request $request){


	$createdBy     = $request->session()->get('userid');
	$compName      = $request->session()->get('company_name');
	$fisYear       =  $request->session()->get('macc_year');

	$head_id       =  $request->input('headid');
	$body_id       =  $request->input('body_id');

	$tax_id        = $request->input('tax_id');
	$vnum          =   $request->input('vnum');
	$bodytax_code  =   $request->input('bodytax_code');

	//print_r($body_id);exit;
	
	$comp_nameval  = $request->input('comp_name');
	$fy_year       = $request->input('fy_year');
	$pfct_code     = $request->input('pfct_code');
	$trans_code    = $request->input('trans_code');
	$series_code   = $request->input('series_code');
	$vr_no         = $request->input('vr_no');

	//print_r($vr_no);exit;
	
	$trans_date    = $request->input('trans_date');
	$tr_vr_date    = date("Y-m-d", strtotime($trans_date));
	
	$accountCode   = $request->input('accountCode');
	$plant_code    = $request->input('plant_code');
	$tax_code      = $request->input('tax_code');
	$tax_byitem    = $request->input('tax_byitem');
	
	$item_code     = $request->input('item_code');
	//print_r($item_code);exit;
	$countItemCode = count($item_code);
	//print_r($countItemCode);exit();
	$item_name     = $request->input('item_name');
	$remark        = $request->input('remark');
	$qty           = $request->input('qty');
	$unit_M        = $request->input('unit_M');
	$Aqty          = $request->input('Aqty');
	$add_unit_M    = $request->input('add_unit_M');
	$rate          = $request->input('rate');
	$basic_amt     = $request->input('basic_amt');
	$crAmtPerItm   = $request->input('crAmtPerItm');
	
	$hsn_code      = $request->input('hsn_code');
	
	$getdatacount  = $request->input('getdatacount');
	
	
	//print_r($count_rate_ind);exit();
	$head_tax_ind  = $request->input('head_tax_ind');
	$af_rate       = $request->input('af_rate');
	$amount        = $request->input('amount');
	
	$data_Count    = $request->input('data_Count');
	//print_r($data_Count);
	$rate_ind      = $request->input('rate_ind');
	$logicget      = $request->input('logicget');
	$staticget     = $request->input('staticget');
	//$count_rate_ind = count($rate_ind);

		//print_r($getapprove);exit;

	$data = array(

			'comp_name'     =>$compName,
			'fiscal_year'   =>$fisYear,
			'company_code'  =>$comp_nameval,
			'fy_code'       =>$fy_year,
			'pfct_code'     =>$pfct_code,
			'tran_code'     =>$trans_code,
			'series_code'   =>$series_code,
			'vr_no'         =>$vr_no,
			'vr_date'       =>$tr_vr_date,
			'acc_code'      =>$accountCode,
			'plant_code'    =>$plant_code,
			'tax_code'      =>$tax_code,
			'partyref_no'   =>$request->input('party_ref_no'),
			'partyref_date' =>$request->input('party_ref_date'),
			'consine_code'  =>$request->input('consine_code'),
			'rfhead1'       =>$request->input('rfhead1'),
			'rfhead2'       =>$request->input('rfhead2'),
			'rfhead3'       =>$request->input('rfhead3'),
			'rfhead4'       =>$request->input('rfhead4'),
			'rfhead5'       =>$request->input('rfhead5'),
			'payment_terms' =>$request->input('payment_terms'),
			'cr_amt'        =>$request->input('cr_amt'),
			'print_flag'    =>'',
			'approved'      =>'',
			'due_date'      =>'',
			'adv_rate_i'    =>$request->input('adv_rate_i'),
			'adv_rate'      =>$request->input('adv_rate'),
			'adv_amt'       =>$request->input('adv_amt'),
			'created_by'    =>$createdBy,

		);
	//print_r($data);
	/*$saveData = DB::table('contract_head')->insert($data);
	$lastid= DB::getPdo()->lastInsertId();*/


		$datalistrray = array();

		for ($i=0; $i < $countItemCode ; $i++) { 


			$body_id = $request->input('body_id');

			if($body_id[$i]){
				$getbodyid = $body_id[$i];
			}

			$data_body = array(
			
				'contract_head_id' =>$head_id,
				'comp_name'        =>$compName,
				'fiscal_year'      =>$fisYear,
				'company_code'     =>$comp_nameval,
				'fy_code'          =>$fy_year,
				'tran_code'        =>$trans_code,
				'vrno'             =>$vnum[$i],
				'slno'             =>$i+1,
				'vr_date'          =>$tr_vr_date,
				'item_code'        =>$item_code[$i],
				'item_name'        =>$item_name[$i],
				'um_code'          =>$unit_M[$i],
				'aum_code'         =>$add_unit_M[$i],
				'remark'           =>$remark[$i],
				'quantity'         =>$qty[$i],
				'Aquantity'        =>$Aqty[$i],
				'rate'             =>$rate[$i],
				'tax_code'         =>$bodytax_code[$i],
				'hsn_code'         =>$hsn_code[$i],
				'basic_amt'        =>$basic_amt[$i],
				'approve_remark'   =>'',
				'flag'             =>0,
				'cr_amount'        =>$crAmtPerItm[$i],
				'created_by'       =>$createdBy,
			);

			/*$saveData = DB::table('contract_body')->insert($data_body);*/

		$saveData = DB::table('contract_body')->where('id',$body_id[$i])->update($data_body);
			//$lastid1= DB::getPdo()->lastInsertId();

			if($data_Count[$i] == 0){

			}else{

				for ($q=0; $q < $data_Count[$i]; $q++) { 

					$a = array_fill(1, $data_Count[$i], $getbodyid);
					$str = implode(',',$a); 
					$last_id = explode(',',$str);

					$datalistrray[]= $last_id[0];
			  	}
			}

			

		} /*-- for loop close --*/


		$getbody = DB::table('contract_body')->find(DB::table('contract_body')->max('id'));

		$getvrnoCount  = DB::table('contract_body')->where('vrno',$getbody->vrno)->get()->toArray();

			$sl_no=array();

			foreach ($getvrnoCount as $key){
				
				$sl_no[]= $key->slno;
			}

			$vrnocount = count($getvrnoCount);
			

		if($saveData){
			for ($j=0; $j < $getdatacount; $j++) { 

				$data_tax = array(
					'contract_head_id' => $head_id,
					'contract_body_id' => $datalistrray[$j],
					'tax_ind_name'     => $head_tax_ind[$j],
					'rate_index'       => $rate_ind[$j],
					'tax_rate'         => $af_rate[$j],
					'tax_amt'          => $amount[$j],
					'tax_logic'        => $logicget[$j],
					'static'           => $staticget[$j],
					'created_by'       => $createdBy,
				);
				
			/*	$saveData1 = DB::table('contract_tax')->insert($data_tax);*/

				$saveData1 = DB::table('contract_tax')->where('contract_body_id',$datalistrray[$j])->where('id',$tax_id[$j])->update($data_tax);
			
			} /*-- for loop close --*/
		} /*-- if close --*/

		$getapprove =	DB::SELECT("SELECT t1.*,t2.* FROM config_approve t1  LEFT JOIN user_approve_ind t2 ON t2.approve_user = t1.approve_ind WHERE t1.tran_code='$trans_code'");

		//print_r($getapprove);
//
		if($getapprove){

			$configapprove=array();
			$approveind=array();
			$userid=array();

			foreach ($getapprove as $key) {
				# code...
				$configapprove[] =$key->tran_code;
				$approveind[] =$key->approve_ind;
				$userid[] =$key->userid;
				$level_no[] =$key->lavel_name;

			}


			$DeleteData = DB::table('contract_approve')->where('series_code',$series_code)->where('tran_code',$trans_code)->where('vr_no',$vr_no)->delete();

			$count = count($configapprove);

			for ($i=0; $i < $count; $i++) { 

				for ($j=0; $j < $vrnocount; $j++) { 
			
					if($level_no[$i]==1){

						$approve_status=3;

						$data_approve = array(
						'comp_name'      =>$compName,
						'fiscal_year'    =>$fisYear,
						'company_code'   =>$comp_nameval,
						'fy_code'        =>$fy_year,
						'pfct_code'      =>$pfct_code,
						'tran_code'      =>$trans_code,
						'series_code'    =>$series_code,
						'slno'           =>$sl_no[$j],
						'vr_no'          =>$vr_no,
						'vr_date'        =>$tr_vr_date,
						'acc_code'       =>$accountCode,
						'plant_code'     =>$plant_code,
						'approved_ind'   =>$approveind[$i],
						'approve_user'   =>$userid[$i],
						'level_no'       =>$level_no[$i],
						'approve_status' =>$approve_status,
						'approve_date'   =>date('Y-m-d'),
						'approve_remark' =>'',
						'flag'           =>'0',
						'lastuser'       =>'0',
						'created_by'     => $createdBy,
					);

					}else{ 
						
						$countmain=$count-1;
							
						if($countmain==$i){

							$lastusr='3';
						}else{
							$lastusr='0';
						}

						$data_approve = array(
								'comp_name'      =>$compName,
								'fiscal_year'    =>$fisYear,
								'company_code'   =>$comp_nameval,
								'fy_code'        =>$fy_year,
								'pfct_code'      =>$pfct_code,
								'tran_code'      =>$trans_code,
								'series_code'    =>$series_code,
								'slno'           =>$sl_no[$j],
								'vr_no'          =>$vr_no,
								'vr_date'        =>$tr_vr_date,
								'acc_code'       =>$accountCode,
								'plant_code'     =>$plant_code,
								'approved_ind'   =>$approveind[$i],
								'approve_user'   =>$userid[$i],
								'level_no'       =>$level_no[$i],
								'approve_status' =>0,
								'approve_date'   =>date('Y-m-d'),
								'approve_remark' =>'',
								'flag'           =>'',
								'lastuser'       =>$lastusr,
								'created_by'     => $createdBy,
							);
					}

					$saveData2 = DB::table('contract_approve')->insert($data_approve);

				}
			}

			if ($saveData2) {

	    			$response_array['response'] = 'success';
		            $response_array['lastid'] = $head_id;
		           // $response_array['lastheadid'] = $lastid;

		            $data = json_encode($response_array);

		            print_r($data);

			}else{

					$response_array['response'] = 'error';
	                $response_array['data'] = '' ;

	                $data = json_encode($response_array);

	                print_r($data);
					
			}
			
		}
	} /*-- function close --  */

/* -----------------  END : PURCHASE CONTRACT TRANSACTION --------------- */

/* -----------------  START : PURCHASE ORDER TRANSACTION --------------- */
	
	public function PurchaseOrder(Request $request){

		$title       ='Add Purchase Order';
		
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');
		
		$userdata['getacc']            = $this->master_party;
		$userdata['tax_code_list']     = $this->master_tax;
		//$userdata['getplant']          = $this->master_plant;
		//$userdata['help_item_list']    = $this->master_item;
		$userdata['rate_list']         = $this->master_rateValue;
		$userdata['cost_list']         = $this->master_cost;
		$userdata['contract_no_list']  = DB::table('PCNTR_HEAD')->get();
		$userdata['quotation_no_list'] = DB::table('PQCS_HEAD')->get();

		$TranCode = 'P3';

		$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','P3')->get();
   		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;

		$functionData = $this->CommonFunction($macc_year,$getcompcode,$TranCode);

		$series_list                = $functionData['series_list'];
		$userdata['getplant']     = $functionData['plant_list'];
		$userdata['help_item_list'] = $functionData['item_list'];

		foreach ($functionData['fy_list'] as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		if(isset($CompanyCode)){

		    return view('admin.finance.transaction.purchase.purchase_order_trans',$userdata+compact('title','series_list'));

		}else{

			return redirect('/useractivity');
		}

	}

	public function SavePurchaseOrder(Request $request){


		$createdBy = $request->session()->get('userid');
		$compName  = $request->session()->get('company_name');
		
		$splitComp = explode('-', $compName);
		$compCode  = $splitComp[0];
		$fisYear   =  $request->session()->get('macc_year');
		$donwloadStatus   = $request->input('donwloadStatus');
		$comp_nameval = $request->input('comp_name');
		$fy_year      = $request->input('fy_year');
		$pfct_code    = $request->input('pfct_code');
		$trans_code   = $request->input('trans_code');
		$series_code  = $request->input('series_code');
		
		$vr_no       = $request->input('vr_no');
		
		$trans_date  = $request->input('trans_date');
		$tr_vr_date  = date("Y-m-d", strtotime($trans_date));

		$pref_date  = $request->input('party_ref_date');
		$partyref_date  = date("Y-m-d", strtotime($pref_date));
		
		$duedate     = $request->input('gatedue_date');
		$getduedate  = date("Y-m-d", strtotime($duedate));
		$dueDays        = $request->input('getDue_days');
		
		$accountCode = $request->input('accountCode');
		$plant_code  = $request->input('plant_code');
		$tax_code    = $request->input('tax_code');
		$tax_byitem  = $request->input('tax_byitem');
		
		$amtByItem   = $request->input('amtByItem');
		$item_code   = $request->input('item_code');
		//print_r($item_code);exit;
		$countItemCode = count($item_code);
		//print_r($countItemCode);exit();
		$item_name     = $request->input('item_name');
		$itemQcContra  = $request->input('itemQcContra');
		$item_codech   = $request->input('item_codech');
		$remark        = $request->input('remark');
		$qty           = $request->input('qty');
		$unit_M        = $request->input('unit_M');
		$Aqty          = $request->input('Aqty');
		$add_unit_M    = $request->input('add_unit_M');
		$rate          = $request->input('rate');
		$basic_amt     = $request->input('basic_amt');
		
		$hsn_code      = $request->input('hsn_code');
		
		$getdatacount  = $request->input('getdatacount');
		$grandAmt_cr   = $request->input('TotalGrandAmt');
		
		$head_tax_ind     = $request->input('head_tax_ind');
		$tax_ind_code     = $request->input('taxIndCode');
		$af_rate          = $request->input('af_rate');
		$amount           = $request->input('amount');
		
		$data_Count       = $request->input('data_Count');
		
		$rate_ind         = $request->input('rate_ind');
		
		$logicget         = $request->input('logicget');
		$staticget        = $request->input('staticget');
		$tax_gl_code      = $request->input('taxGlCode');
		$tolerence_index  = $request->input('tolerence_index');
		$tolerence_rate   = $request->input('tolerence_rate');
		
		$cQheadId         = $request->input('contqcsheadId');
		$cQbodyid         = $request->input('contqcsbodyid');
		$cQvrno           = $request->input('conquovrno');
		$pQheadId         = $request->input('purqtoheadId');
		$pQbodyid         = $request->input('purqtobodyid');
		$contslno         = $request->input('contslnum');
		$quocompareno     = $request->input('quocompareno');
		$contraseries     = $request->input('contraseries');
		$contratrans      = $request->input('contratrans');

		$conHeadID   = $request->input('contheadId');
		$conBodyID   = $request->input('contbodyid');
		$quoHeadID   = $request->input('quoHeadId');
		$quoBodyID   = $request->input('quoBodyId');
		$qCompHeadID = $request->input('QCHeadId');
		$qCompBodyID = $request->input('QCBodyId');

		
		$getlevel         = $request->input('levelI');

		$POrderH = DB::select("SELECT MAX(PORDERHID) as PORDERHID FROM PORDER_HEAD");
		$headID = json_decode(json_encode($POrderH), true); 
	
		if(empty($headID[0]['PORDERHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['PORDERHID']+1;
		}

		if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('PORDER_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

		$headTble = 'PORDER_HEAD';
		$bodyTble = 'PORDER_BODY';
		$taxTble  = 'PORDER_TAX';
		$headId   = 'PORDERHID';
		$pdfName  = 'PURCHASE ORDER';
		$vrPName   ='PORDER NO';

		DB::beginTransaction();

		try {

			$data = array(

				'PORDERHID'        =>$head_Id,
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
				'DUEDAYS'          =>$dueDays,
				'DUEDATE'          =>$getduedate,
				'ACC_CODE'         =>$accountCode,
				'ACC_NAME'         =>$request->input('account_name'),
				'CPCODE'           =>$request->input('cp_codeGet'),
				'COST_CENTER'      =>$request->input('Cost_Center'),
				'COST_CENTER_NAME' =>$request->input('CostName'),
				'TAX_CODE'         =>$tax_code,
				'PREFNO'           =>$request->input('party_ref_no'),
				'PREFDATE'         =>$partyref_date,
				'RFHEAD1'          =>$request->input('rfhead1'),
				'RFHEAD2'          =>$request->input('rfhead2'),
				'RFHEAD3'          =>$request->input('rfhead3'),
				'RFHEAD4'          =>$request->input('rfhead4'),
				'RFHEAD5'          =>$request->input('rfhead5'),
				'PMT_TERMS'        =>$request->input('payment_terms'),
				'ADV_RATE_I'       =>$request->input('adv_rate_i'),
				'ADV_RATE'         =>$request->input('adv_rate'),
				'ADV_AMT'          =>$request->input('adv_amt'),
				'CRAMT'            =>$grandAmt_cr,
				'created_by'       =>$createdBy,

			);
			$saveDataH = DB::table('PORDER_HEAD')->insert($data);
			$last_headid = DB::getPdo()->lastInsertId();
		
			$data_bodyId = array();
			$last_bodyid =array();

			$discriptn_page = "Purchase order trans insert done by user";

			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$accountCode);

			for ($i=0; $i < $countItemCode ; $i++) { 

				$POrderB = DB::select("SELECT MAX(PORDERBID) as PORDERBID FROM PORDER_BODY");
				$bodyID = json_decode(json_encode($POrderB), true); 
			
				if(empty($bodyID[0]['PORDERBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['PORDERBID']+1;
				}

				if($itemQcContra[$i]){
					$itmcd = $itemQcContra[$i];
				}else if($item_codech[$i]){
					$itmcd =$item_codech[$i];
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
				
					'PORDERHID'    =>$head_Id,
					'PORDERBID'    =>$body_Id,
					'COMP_CODE'    =>$compCode,
					'FY_CODE'      =>$fisYear,
					'PFCT_CODE'    =>$pfct_code,
					'TRAN_CODE'    =>$trans_code,
					'SERIES_CODE'  =>$series_code,
					'VRNO'         =>$NewVrno,
					'SLNO'         =>$i+1,
					'VRDATE'       =>$tr_vr_date,
					'PLANT_CODE'   =>$plant_code,
					'PCNTRNHID'    =>$conHeadID[$i],
					'PCNTRNBID'    =>$conBodyID[$i],
					'PQTNBID'      =>$quoHeadID[$i],
					'PQTNHID'      =>$quoBodyID[$i],
					'PQCSHID'      =>$qCompHeadID[$i],
					'PQCSBID'      =>$qCompBodyID[$i],
					'ITEM_CODE'    =>$itmcd,
					'ITEM_NAME'    =>$item_name[$i],
					'PARTICULAR'   =>$remark[$i],
					'HSN_CODE'     =>$hsn_code[$i],
					'UM'           =>$unit_M[$i],
					'AUM'          =>$add_unit_M[$i],
					'RATE'         =>$rate[$i],
					'BASICAMT'     =>$basic_amt[$i],
					'TAX_CODE'     =>$tax_byitem[$i],
					'CRAMT'        =>$amtByItem[$i],
					'TOL_INDEX'    =>$tolerence_index[$i],
					'TOL_RATE'     =>$tolerence_rate[$i],
					'QTYRECD'      =>$qty[$i],
					'AQTYRECD'     =>$Aqty[$i],
					'GATEPU_QTY'   =>$qty[$i],
					'GATEPU_AQTY'  =>$Aqty[$i],
					//'level_i'    =>$getlevel[$i],
					//'qty_issued' =>0,
					'FLAG'         =>$FLAG,
					'CREATED_BY'   =>$createdBy,
				);

				$saveDataB = DB::table('PORDER_BODY')->insert($data_body);
				$last_bodyid[] = DB::getPdo()->lastInsertId();

				if($qCompHeadID[$i] && $qCompBodyID[$i] && $quoHeadID[$i] && $quoBodyID[$i]){

					$getQtyIsue = DB::table('PQCS_BODY')->where(['PQCSHID'=>$qCompHeadID[$i],'PQCSBID'=>$qCompBodyID[$i],'PQTNHID'=>$quoHeadID[$i],'PQTNBID'=>$quoBodyID[$i],'ITEM_CODE'=>$item_code[$i]])->get()->first();
				
					$getqtyIsued = $getQtyIsue->QTYISSUED;

					$data_qtyIsd = array(
						'QTYISSUED' =>$getqtyIsued+$qty[$i],
					);
				
					$getQtyIsue = DB::table('PQCS_BODY')->where(['PQCSHID'=>$qCompHeadID[$i],'PQCSBID'=>$qCompBodyID[$i],'PQTNHID'=>$quoHeadID[$i],'PQTNBID'=>$quoBodyID[$i],'ITEM_CODE'=>$item_code[$i]])->update($data_qtyIsd);

					$getQtyisEq = DB::table('PQCS_BODY')->where(['PQCSHID'=>$qCompHeadID[$i],'PQCSBID'=>$qCompBodyID[$i],'PQTNHID'=>$quoHeadID[$i],'PQTNBID'=>$quoBodyID[$i],'ITEM_CODE'=>$item_code[$i]])->get()->first();

					if($getQtyisEq->QTYRECD == $getQtyisEq->QTYISSUED){

						$data_purorder = array(

							'PORDERHID' =>$head_Id,
							'PORDERBID' =>$body_Id,
						);
					 DB::table('PQCS_BODY')->where(['PQCSHID'=>$qCompHeadID[$i],'PQCSBID'=>$qCompBodyID[$i],'PQTNHID'=>$quoHeadID[$i],'PQTNBID'=>$quoBodyID[$i],'ITEM_CODE'=>$item_code[$i]])->update($data_purorder);
					}

				}else if($conHeadID[$i] && $conBodyID[$i] && $item_code[$i]){

					$getcQtyIsue = DB::table('PCNTR_BODY')->where(['PCNTRHID'=>$conHeadID[$i],'PCNTRBID'=>$conBodyID[$i],'ITEM_CODE'=>$item_code[$i]])->get()->first();

					$getcqtyIsued = $getcQtyIsue->QTYISSUED;

					$dataqtyIsd = array(
						'QTYISSUED' =>$getcqtyIsued+$qty[$i],
					);

					$getQtyIsue =  DB::table('PCNTR_BODY')->where(['PCNTRHID'=>$conHeadID[$i],'PCNTRBID'=>$conBodyID[$i],'ITEM_CODE'=>$item_code[$i]])->update($dataqtyIsd);

					$getQtyIsEqual =  DB::table('PCNTR_BODY')->where(['PCNTRHID'=>$conHeadID[$i],'PCNTRBID'=>$conBodyID[$i],'ITEM_CODE'=>$item_code[$i]])->get()->first();

					if($getQtyIsEqual->QTYRECD == $getQtyIsEqual->QTYISSUED){


						$data_contract_body = array(
					
							'PORDERHID' =>$head_Id,
							'PORDERBID' =>$body_Id,
						);
					
						DB::table('PCNTR_BODY')->where(['PCNTRHID'=>$conHeadID[$i],'PCNTRBID'=>$conBodyID[$i],'ITEM_CODE'=>$item_code[$i]])->update($data_contract_body);

						$getCNT_Data = DB::table('PCNTR_BODY')->where(['PCNTRHID'=>$conHeadID[$i],'PORDERHID'=>0,'PORDERBID'=>0])->get();

						$GetDataCount = count($getCNT_Data);

						if($GetDataCount == 0){
							$ordFlag = 1;
							$dataContractBody = array(
					
								'ORDER_FLAG' =>$ordFlag
							);
							DB::table('PCNTR_HEAD')->where(['PCNTRHID'=>$conHeadID[$i]])->update($dataContractBody);
						}
					}

				}

				for ($q=0; $q < $data_Count[$i]; $q++) { 

					$a = array_fill(1, $data_Count[$i], $body_Id);
					$str = implode(',',$a); 
					$last_id = explode(',',$str);

					$data_bodyId[]= $last_id[0];

				}

			} /*-- for loop close --*/

			for ($j=0; $j < $getdatacount; $j++) { 

				$POrderT = DB::select("SELECT MAX(PORDERTID) as PORDERTID FROM PORDER_TAX");
				$taxID = json_decode(json_encode($POrderT), true); 
			
				if(empty($taxID[0]['PORDERTID'])){
					$tax_Id = 1;
				}else{
					$tax_Id = $taxID[0]['PORDERTID']+1;
				}

				if($amount[$j] == null ||$amount[$j]==''){
					$amountTax = 0.00;
				}else{
					$amountTax = $amount[$j];
				}

				$data_tax = array(
					'PORDERHID'   => $head_Id,
					'PORDERBID'   => $data_bodyId[$j],
					'PORDERTID'   => $tax_Id,
					'TAXIND_CODE' => $tax_ind_code[$j],
					'TAXIND_NAME' => $head_tax_ind[$j],
					'RATE_INDEX'  => $rate_ind[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $amountTax,
					'TAX_LOGIC'   => $logicget[$j],
					'TAXGL_CODE'  => $tax_gl_code[$j],
					'STATIC_IND'  => $staticget[$j],
					'CREATED_BY'  => $createdBy,
				);
				
				$saveDataT = DB::table('PORDER_TAX')->insert($data_tax);
		
			} /*-- for loop close --*/

			$bodyTblNm = 'PORDER_BODY';
			$apvTblNm  = 'PORDER_APPROVE';
			$bodyCol   = 'PORDERBID';
			$apvCol    = 'PORDERAID';
			$headCol   = 'PORDERHID';

			$this->approve_Trans($bodyTblNm,$bodyCol,$trans_code,$series_code,$apvTblNm,$compCode,$fisYear,$pfct_code,$trans_code,$series_code,$NewVrno,$tr_vr_date,$createdBy,$head_Id,$apvCol,$headCol);

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->get()->toArray();

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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			DB::commit();

			if($donwloadStatus ==1 ){
				return $this->GeneratePdfForPurchase($trans_code,$headTble,$bodyTble,$headId,$head_Id,$taxTble,$createdBy,$pdfName,$vrPName);
			}

			$response_array['response'] = 'success';
	        $data = json_encode($response_array);
	        print_r($data);

	    } catch (\Exception $e) {
		    DB::rollBack();
		   // throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}

	}

	public function purchase_order_msg(Request $request,$saveData){

		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Be Save...!');
			return redirect('/Transaction/Purchase/View-Purchase-Order-Trans');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Save...!');
			return redirect('/Transaction/Purchase/View-Purchase-Order-Trans');

		}
	}

	public function ViewPurchaseOrder(Request $request){

		$compName = $request->session()->get('company_name');

		    if($request->ajax()) {

		        $title ='View Purchase Order';

		        $userid    = $request->session()->get('userid');

		        $userType = $request->session()->get('usertype');

		        $comp_nameval     = $request->session()->get('company_name');
			    $explode          = explode('-', $comp_nameval);
			    $getcom_code      = $explode[0];

		        $fisYear =  $request->session()->get('macc_year');


		        if($userType=='admin' || $userType=='Admin'){

		        
		         /*$data = DB::table('purchase_order_head')->orderBy('id','DESC');*/
		         // DB::enableQueryLog();
		        /* $data = DB::table('PORDER_HEAD')
						->select('PORDER_HEAD.*', 'MASTER_CONFIG.SERIES_NAME','MASTER_PLANT.PLANT_NAME','MASTER_ACC.ACC_NAME','PORDER_BODY.PORDERHID as poheaid','PORDER_BODY.GRNHID','PORDER_BODY.GRNBID')
		           		->leftjoin('MASTER_CONFIG','MASTER_CONFIG.SERIES_CODE','=', 'PORDER_HEAD.SERIES_CODE')
		           		->leftjoin('MASTER_PLANT', 'MASTER_PLANT.PLANT_CODE', '=', 'PORDER_HEAD.PLANT_CODE')
		           		->leftjoin('MASTER_ACC', 'MASTER_ACC.ACC_CODE', '=', 'PORDER_HEAD.ACC_CODE')
		           		->leftjoin('PORDER_BODY', 'PORDER_BODY.PORDERHID', '=', 'PORDER_HEAD.PORDERHID')
		           		->where('PORDER_HEAD.FY_CODE',$fisYear)
		           		->groupBy('PORDER_BODY.PORDERHID')
		           		->orderBy('PORDER_HEAD.PORDERHID','DESC');*/
		           		//dd(DB::getQueryLog()); 
		           // print_r($data);

		        $data =DB::select("SELECT PORDER_HEAD.*,PORDER_BODY.PORDERHID as podrHid,PORDER_BODY.PORDERBID,PORDER_BODY.GRNHID,PORDER_BODY.GRNBID,group_concat(concat(PORDER_BODY.GRNHID))AS PORDRTATUSHD,group_concat(concat(PORDER_BODY.GRNBID))AS PORDRTATUSBD,group_concat(concat(PORDER_BODY.QTYISSUED))AS nextTranQty FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_BODY.PORDERHID = PORDER_HEAD.PORDERHID WHERE PORDER_HEAD.COMP_CODE='$getcom_code' AND PORDER_HEAD.FY_CODE='$fisYear' GROUP BY PORDER_HEAD.PORDERHID");

		        

		        }else if($userType=='superAdmin' || $userType=='user'){

		            
		        $data =DB::select("SELECT PORDER_HEAD.*,PORDER_BODY.PORDERHID as podrHid,PORDER_BODY.PORDERBID,PORDER_BODY.GRNHID,PORDER_BODY.GRNBID,group_concat(concat(PORDER_BODY.GRNHID))AS PORDRTATUSHD,group_concat(concat(PORDER_BODY.GRNBID))AS PORDRTATUSBD,group_concat(concat(PORDER_BODY.QTYISSUED))AS nextTranQty FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_BODY.PORDERHID = PORDER_HEAD.PORDERHID WHERE PORDER_HEAD.COMP_CODE='$getcom_code' AND PORDER_HEAD.FY_CODE='$fisYear' GROUP BY PORDER_HEAD.PORDERHID");
		        }
		        else{

		            $data='';
		            
		        }

		    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

		    }

		    if(isset($compName)){

		       return view('admin.finance.transaction.purchase.view_purchase_order_trans');
		    }else{
				return redirect('/useractivity');
			}
		        
	}

	public function ViewPurchaseOrderTransChildRow(Request $request){

		$response_array = array();

			$vrno    = $request->input('vrno');
			$headid  =  $request->input('tblid');

		if ($request->ajax()) {

	    
	    	 $ptdata = DB::table('PORDER_BODY')->where('VRNO',$vrno)->where('PORDERHID',$headid)->get()->toArray();

	  //print_r($ptdata);exit;

    		if($ptdata){

    			$response_array['response'] = 'success';
	            $response_array['data'] = $ptdata;

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

    public function DeletePurchaseOrder(Request $request){

        $head_id = $request->input('headID');
        //print_r($row_count);exit;
        if ($head_id!='') {

			$DeleteHead = DB::table('PORDER_HEAD')->where('PORDERHID',$head_id)->delete();
			$DeleteBody = DB::table('PORDER_BODY')->where('PORDERHID',$head_id)->delete();
			$DeleteQuo  = DB::table('PORDER_QUA')->where('PORDERHID',$head_id)->delete();
			$DeleteTax  = DB::table('PORDER_TAX')->where('PORDERHID',$head_id)->delete();
			$DeleteApp  = DB::table('PORDER_APPROVE')->where('PORDERHID',$head_id)->delete();

			if (($DeleteHead && $DeleteBody && $DeleteTax)) {

				$request->session()->flash('alert-success', 'Purchase Order Data Was Deleted Successfully...!');
				return redirect('/Transaction/Purchase/View-Purchase-Order-Trans');

			} else {

				$request->session()->flash('alert-error', 'Purchase Order Data Can Not Deleted...!');
				return redirect('/Transaction/Purchase/View-Purchase-Order-Trans');

			}
		
		}else{

			$request->session()->flash('alert-error', 'Purchase Order Data Not Found...!');
			return redirect('/Transaction/Purchase/View-Purchase-Order-Trans');

		}
	}

	public function EditOrderPurchase(Request $request,$id){

		$title      ='Add Purchase Order';


		$id =base64_decode($id);

		

		if($id){

		    $query = DB::table('purchase_order_head');
			$query->where('id', $id);
			$userdata['purchase_order_head'] = $query->get()->first();

		//print_r($userdata['purchase_order_head']);exit;

			$head_id     =$userdata['purchase_order_head']->id;
			$series_code =$userdata['purchase_order_head']->series_code;

			//print_r($series_code);exit;

			$plant_code  =$userdata['purchase_order_head']->plant_code;
			$pfct_code   =$userdata['purchase_order_head']->pfct_code;
			$acc_code   =$userdata['purchase_order_head']->acc_code;

			$userdata['purhase_order_body'] = DB::table('purchase_order_body')->where('purchase_order_head_id',$head_id)->where('flag','2')->get()->toArray();


			$userdata['purhase_order_tax'] = DB::table('purchase_order_tax')
				->select('purchase_order_tax.*',)
           		->leftjoin('purchase_order_head', 'purchase_order_head.id', '=', 'purchase_order_tax.purchase_order_head_id')
           		->leftjoin('purchase_order_body', 'purchase_order_body.id', '=', 'purchase_order_tax.purchase_order_body_id')
           		->where('purchase_order_tax.purchase_order_head_id',$id)
           		->get();

           		$basic =array();
           		$gtotal =array();
           		$sum = 0;

           		foreach($userdata['purhase_order_tax'] as $row){

           			if($row->tax_ind_name=='Basic'){
	
           			$basic[] = $row->tax_amt;
           			
           			}

           			if($row->tax_ind_name=='GrandTotal'){
	
           			 $gtotal[] = $row->tax_amt;
           			
           			}		

           		}
		$total     = array_sum($basic);
		//$btotal     = array_sum($basic);
		$grndtotal = array_sum($gtotal);
		$othertotal = floatval($grndtotal) - floatval($total);

			/*echo '<pre>';
			print_r($userdata['purhase_order_body']);exit;*/


		$userdata['series_name'] = DB::table('master_config')->where('series_code',$series_code)->get()->first();
		
		//print_r($userdata['series_name']);exit;

		$userdata['plant_name'] = DB::table('master_plant')->where('plant_code',$plant_code)->get()->first();

		$userdata['pfct_name'] = DB::table('master_pfct')->where('pfct_code',$pfct_code)->get()->first();

		//print_r($userdata['pfct_name']);exit;

		$userdata['acc_name'] = DB::table('master_party')->where('acc_code',$acc_code)->get()->first();
			//print_r($userdata['purhase_order_body']);exit;

		$CompanyCode   = $request->session()->get('company_name');
		$compcode = explode('-', $CompanyCode);
		$getcompcode=	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$userdata['comp_list']       = DB::table('master_comp')->get();

		$userdata['getacc'] = DB::table('master_party')->get();
		//DB::enableQueryLog();
		$userdata['series_list'] = DB::table('master_config')->where(['tran_code'=>'P3'])->get();
		//dd(DB::getQueryLog());

		$userdata['tax_code_list'] = DB::table('master_tax_rate')->groupBy('tax_code')->get();

		//DB::enableQueryLog();
		$userdata['pfct_list']       = DB::table('master_pfct')->get();
		$userdata['getplant'] = DB::table('master_plant')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']       = DB::table('master_bank')->get();
		$userdata['cost_list']       = DB::table('master_cost')->get();

		$userdata['help_item_list'] = DB::table('master_item_finance')->get();

		$userdata['rate_list'] = DB::table('rate_value')->get();

		$getdate = DB::table('master_fy')->where(['comp_code'=>$getcompcode,'fy_code'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->fy_from_date;
					$userdata['toDate']   =  $key->fy_to_date;
					}


		$purchase = DB::table('purchase_order_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();

		   	$vrseqnum = '';
			foreach ($purchase as $key) {
				$vrseqnum =  $key->vr_no;
			}
			$userdata['vrNumber'] =$vrseqnum;
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `master_vrseq` WHERE comp_name='$CompanyCode' AND fiscal_year='$macc_year' AND tran_code='P3'");
		//dd(DB::getQueryLog());
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

    		return view('admin.finance.transaction.edit_purchase_order_trans',$userdata+compact('title','total','grndtotal','othertotal'));

	    }else{

			return redirect('/useractivity');
		}
	}

	public function UpdatePuchaseOrder(Request $request){


		$createdBy    = $request->session()->get('userid');
		$compName     = $request->session()->get('company_name');
		$fisYear      =  $request->session()->get('macc_year');
		
		$headid = $request->input('orderheadid');

		$bodyid = $request->input('bodyid');
		$taxid  = $request->input('taxid');

		$comp_nameval = $request->input('comp_name');
		$fy_year      = $request->input('fy_year');
		$pfct_code    = $request->input('pfct_code');
		$trans_code   = $request->input('trans_code');
		$series_code  = $request->input('series_code');
		$vr_no        = $request->input('vr_no');
		$vnum        = $request->input('vnum');
		
		$trans_date   = $request->input('trans_date');
		$tr_vr_date   = date("Y-m-d", strtotime($trans_date));
		
		$accountCode  = $request->input('accountCode');
		$plant_code   = $request->input('plant_code');
		$tax_code     = $request->input('tax_code');
		$taxcode     = $request->input('taxcode');
		$tax_byitem   = $request->input('tax_byitem');
		
		$amtByItem     = $request->input('amtByItem');
		$item_code     = $request->input('item_code');
		//print_r($item_code);exit;
		$countItemCode = count($item_code);
		//print_r($countItemCode);exit();
		$item_name     = $request->input('item_name');
		$remark        = $request->input('remark');
		$qty           = $request->input('qty');
		$unit_M        = $request->input('unit_M');
		$Aqty          = $request->input('Aqty');
		$add_unit_M    = $request->input('add_unit_M');
		$rate          = $request->input('rate');
		$basic_amt     = $request->input('basic_amt');
		$hsn_code      = $request->input('hsn_code');
		$getdatacount  = $request->input('getdatacount');
		//print_r($count_rate_ind);exit();
		$head_tax_ind   = $request->input('head_tax_ind');
		$af_rate        = $request->input('af_rate');
		$amount         = $request->input('amount');

		$data_Count       = $request->input('data_Count');
		//print_r($data_Count);
		$rate_ind       = $request->input('rate_ind');
		$count_rate_ind = count($rate_ind);

		$logicget            = $request->input('logicget');
		$staticget           = $request->input('staticget');
			
			///print_r($getapprove);exit;

		$data = array(

				'comp_name'     =>$compName,
				'fiscal_year'   =>$fisYear,
				'company_code'  =>$comp_nameval,
				'fy_code'       =>$fy_year,
				'pfct_code'     =>$pfct_code,
				'tran_code'     =>$trans_code,
				'series_code'   =>$series_code,
				'vr_no'         =>$vr_no,
				'vr_date'       =>$tr_vr_date,
				'acc_code'      =>$accountCode,
				'plant_code'    =>$plant_code,
				'tax_code'      =>$tax_code,
				'partyref_no'   =>$request->input('party_ref_no'),
				'partyref_date' =>$request->input('party_ref_date'),
				'consine_code'  =>$request->input('consine_code'),
				'rfhead1'       =>$request->input('rfhead1'),
				'rfhead2'       =>$request->input('rfhead2'),
				'rfhead3'       =>$request->input('rfhead3'),
				'rfhead4'       =>$request->input('rfhead4'),
				'rfhead5'       =>$request->input('rfhead5'),
				'payment_terms' =>$request->input('payment_terms'),
				'cr_amt'        =>$request->input('cr_amt'),
				'print_flag'    =>'',
				'approved'      =>'',
				'due_date'      =>'',
				'adv_rate_i'    =>$request->input('adv_rate_i'),
				'adv_rate'      =>$request->input('adv_rate'),
				'adv_amt'       =>$request->input('adv_amt'),
				'flag'          =>'0',
				'created_by'    =>$createdBy,

			);
			//print_r($data);
			/*$saveData = DB::table('purchase_order_head')->insert($data);
			$lastid= DB::getPdo()->lastInsertId();*/

			$datalistrray = array();
			$lastid2 =array();

			for ($i=0; $i < $countItemCode ; $i++) { 

				$bodyid = $request->input('bodyid');
				if($bodyid[$i]){
					$getbidyid = $bodyid[$i];
				}

				$data_body = array(
				
					'purchase_order_head_id' =>$headid,
					'comp_name'           =>$compName,
				    'fiscal_year'         =>$fisYear,
				    'company_code'        =>$comp_nameval,
				    'fy_code'             =>$fy_year,
					'tran_code'           =>$trans_code,
					'vrno'                =>$vnum[$i],
					'slno'                =>$i+1,
					'vr_date'             =>$tr_vr_date,
					'item_code'           =>$item_code[$i],
					'item_name'           =>$item_name[$i],
					'um_code'             =>$unit_M[$i],
					'aum_code'            =>$add_unit_M[$i],
					'remark'              =>$remark[$i],
					'quantity'            =>$qty[$i],
					'Aquantity'           =>$Aqty[$i],
					'qty_issued'          =>0,

					'cr_amount'           =>$amtByItem[$i],
					'rate'                =>$rate[$i],
					'tax_code'            =>$taxcode[$i],
					'hsn_code'            =>$hsn_code[$i],
					'basic_amt'           =>$basic_amt[$i],
					'flag'                =>'0',
					'created_by'          =>$createdBy,
				);

				$saveData = DB::table('purchase_order_body')->where('id',$bodyid[$i])->update($data_body);


				$lastid1 = DB::getPdo()->lastInsertId();
				$lastid2[]= DB::getPdo()->lastInsertId();

			
				for ($q=0; $q < $data_Count[$i]; $q++) { 

					$a = array_fill(1, $data_Count[$i], $getbidyid);
					$str = implode(',',$a); 
					$last_id = explode(',',$str);

					$datalistrray[]= $last_id[0];

				

				}

			} /*-- for loop close --*/
			$getbody = DB::table('purchase_order_body')->find(DB::table('purchase_order_body')->max('id'));

			$getvrnoCount  = DB::table('purchase_order_body')->where('vrno',$getbody->vrno)->get()->toArray();

			//print_r($getvrnoCount);

			$sl_no=array();

			foreach ($getvrnoCount as $key){
				
				$sl_no[]= $key->slno;
			}


				//print_r($sl_no);exit;

			$vrnocount = count($getvrnoCount);
				//print_r($vrnocount);exit;

			if($saveData){
				for ($j=0; $j < $getdatacount; $j++) { 

					$data_tax = array(
						'purchase_order_head_id' => $headid,
						'purchase_order_body_id' => $datalistrray[$j],
						'rate_index'               => $rate_ind[$j],
						'tax_ind_name'                => $head_tax_ind[$j],
						'tax_rate'               => $af_rate[$j],
						'tax_amt'                => $amount[$j],
						'tax_logic'                  => $logicget[$j],
						'static'                     => $staticget[$j],
						'created_by'             => $createdBy,
					);
					
					/*$saveData1 = DB::table('purchase_order_tax')->insert($data_tax);*/

					$saveData1 = DB::table('purchase_order_tax')->where('purchase_order_body_id',$datalistrray[$j])->where('id',$taxid[$j])->update($data_tax);
				
				} /*-- for loop close --*/
			} /*-- if close --*/

			/*$getapprove = DB::table('config_approve')->where(['tran_code'=>$trans_code,'series_code'=>$series_code])->get();*/

			$getapprove =	DB::SELECT("SELECT t1.*,t2.* FROM config_approve t1  LEFT JOIN user_approve_ind t2 ON t2.approve_user = t1.approve_ind WHERE t1.tran_code='$trans_code'");

			if($getapprove){

				$configapprove=array();
				$approveind=array();
				$userid=array();

				foreach ($getapprove as $key) {
					# code...
					$configapprove[] =$key->tran_code;
					$approveind[]    =$key->approve_ind;
					$userid[]        =$key->userid;
					$level_no[]      =$key->lavel_name;


					
				}


				/*$alradyApproved =	DB::SELECT("SELECT pa1.* FROM purchase_order_approve pa1 WHERE pa1.approve_user='$userid[$i]'");

				print_r($alradyApproved);*/

				$DeleteData = DB::table('purchase_order_approve')->where('series_code',$series_code)->where('tran_code',$trans_code)->where('vr_no',$vr_no)->delete();


				$count = count($configapprove);		

				for ($i=0; $i < $count; $i++) { 


					for ($j=0; $j < $vrnocount; $j++) { 
		

						if($level_no[$i]==1){

							$approve_status=3;

							$data_approve = array(
							'comp_name'      =>$compName,
							'fiscal_year'    =>$fisYear,
							'company_code'   =>$comp_nameval,
							'fy_code'        =>$fy_year,
							'pfct_code'      =>$pfct_code,
							'tran_code'      =>$trans_code,
							'series_code'    =>$series_code,
							'slno'           =>$sl_no[$j],
							'vr_no'          =>$vr_no,
							'vr_date'        =>$tr_vr_date,
							'acc_code'       =>$accountCode,
							'plant_code'     =>$plant_code,
							'tax_code'       =>$tax_code,
							'approved_ind'   =>$approveind[$i],
							'approve_user'   =>$userid[$i],
							'level_no'       =>$level_no[$i],
							'approve_status' =>$approve_status,
							'approve_date'   =>date('Y-m-d'),
							'approve_remark' =>'',
							'flag'           =>'0',
							'lastuser'       =>'0',
							'created_by'     => $createdBy,
						);

						}
						else{ 
							
						$countmain=$count-1;
							
						if($countmain==$i){

							$lastusr='3';
						}else{
							$lastusr='0';
						}

						$data_approve = array(
								'comp_name'      =>$compName,
								'fiscal_year'    =>$fisYear,
								'company_code'   =>$comp_nameval,
								'fy_code'        =>$fy_year,
								'pfct_code'      =>$pfct_code,
								'tran_code'      =>$trans_code,
								'series_code'    =>$series_code,
								'slno'           =>$sl_no[$j],
								'vr_no'          =>$vr_no,
								'vr_date'        =>$tr_vr_date,
								'acc_code'       =>$accountCode,
								'plant_code'     =>$plant_code,
								'tax_code'       =>$tax_code,
								'approved_ind'   =>$approveind[$i],
								'approve_user'   =>$userid[$i],
								'level_no'       =>$level_no[$i],
								'approve_status' =>0,
								'approve_date'   =>date('Y-m-d'),
								'approve_remark' =>'',
								'flag'           =>'',
								'lastuser'       =>$lastusr,
								'created_by'     => $createdBy,
							);
						}

						$saveData2 = DB::table('purchase_order_approve')->insert($data_approve);

					}

				}

				if($saveData2) {

		    			$response_array['response'] = 'success';
			            $response_array['lastid'] = $bodyid;
			            $response_array['lastheadid'] = $headid;

			            $data = json_encode($response_array);

			            print_r($data);

				}else{

					$response_array['response'] = 'error';
	                $response_array['data'] = '' ;

	                $data = json_encode($response_array);

	                print_r($data);
					
				}
			
			}
				
	}

/* -----------------  END : PURCHASE ORDER TRANSACTION --------------- */


/* -----------------  START : JOB WORK ORDER TRANSACTION --------------- */
	
	public function JobWorkOrder(Request $request){

		$title       ='Add Job Work Order';
		
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');
		
		$userdata['getacc']         = $this->master_party;
		$userdata['tax_code_list']  = $this->master_tax;
		$userdata['help_item_list'] = $this->master_item;
		$userdata['rate_list']      = $this->master_rateValue;
		$userdata['cost_list']      = $this->master_cost;

		$TranCode = 'W1';

		$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','W1')->get();
   		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;


		$functionData = $this->CommonFunction($macc_year,$getcompcode,$TranCode);

		$series_list = $functionData['series_list'];
		$userdata['getplant'] = $functionData['plant_list'];

		foreach ($functionData['fy_list'] as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		if(isset($CompanyCode)){
	    	return view('admin.finance.transaction.purchase.job_work_order',$userdata+compact('title','series_list'));
	    }else{
			return redirect('/useractivity');
		}

	}

	public function SaveJobWorkOrder(Request $request){


		$createdBy       = $request->session()->get('userid');
		$compName        = $request->session()->get('company_name');
		$splitComp       = explode('-', $compName);
		$compCode        = $splitComp[0];
		$fisYear         =  $request->session()->get('macc_year');
		$trans_date      = $request->input('trans_date');
		$tr_vr_date      = date("Y-m-d", strtotime($trans_date));
		$trans_code      = $request->input('trans_code');
		$series_code     = $request->input('series_code');
		$vr_no           = $request->input('vr_no');
		$plant_code      = $request->input('plant_code');
		$pfct_code       = $request->input('pfct_code');
		$accountCode     = $request->input('accountCode');
		$tax_code        = $request->input('tax_code');
		$dueDays         = $request->input('getDue_days');
		$duedate         = $request->input('gatedue_date');
		$getduedate      = date("Y-m-d", strtotime($duedate));
		$partyrefdate    = $request->input('party_ref_date');
		$getpartyrefdate = date("Y-m-d", strtotime($partyrefdate));
		$item_codech     = $request->input('item_codech');
		$item_code       = $request->input('item_code');
		$item_name       = $request->input('item_name');
		$tax_byitem      = $request->input('tax_byitem');
		$hsn_code        = $request->input('hsn_code');
		$remark          = $request->input('remark');
		$qty             = $request->input('qty');
		$unit_M          = $request->input('unit_M');
		$Aqty            = $request->input('Aqty');
		$add_unit_M      = $request->input('add_unit_M');
		$rate            = $request->input('rate');
		$basic_amt       = $request->input('basic_amt');
		$amtByItem       = $request->input('amtByItem');
		$getdatacount    = $request->input('getdatacount');
		$grandAmt_cr     = $request->input('TotalGrandAmt');
		$data_Count      = $request->input('data_Count');
		$head_tax_ind    = $request->input('head_tax_ind');
		$tax_ind_code    = $request->input('taxIndCode');
		$af_rate         = $request->input('af_rate');
		$amount          = $request->input('amount');
		$rate_ind        = $request->input('rate_ind');
		$logicget        = $request->input('logicget');
		$staticget       = $request->input('staticget');
		$tax_gl_code     = $request->input('taxGlCode');
		$tolerence_index = $request->input('tolerence_index');
		$tolerence_rate  = $request->input('tolerence_rate');
		$donwloadStatus  = $request->input('donwloadStatus');
		$item_codeIsu    = $request->input('item_codeIsu');
		$item_name_isu   = $request->input('item_name_isu');
		$qty_isu         = $request->input('qty_isu');
		$unit_IsueM      = $request->input('unit_IsueM');
		$A_qtyIsu        = $request->input('A_qtyIsu');
		$add_unit_MIsu   = $request->input('add_unit_MIsu');
		$itmIsuueCount   = count($item_codeIsu);
		//print_r($item_code);exit;
		$countItemCode   = count($item_code);
	    //print_r($countItemCode);exit();
    
    	$POrderH = DB::select("SELECT MAX(PORDERHID) as PORDERHID FROM PORDER_HEAD");
    	$headID = json_decode(json_encode($POrderH), true); 
  
	    if(empty($headID[0]['PORDERHID'])){
	      $head_Id = 1;
	    }else{
	      $head_Id = $headID[0]['PORDERHID']+1;
	    }

	    if($vr_no == ''){
	      $vrNum = 1;
	    }else{
	      $vrNum = $vr_no;
	    }

	    $vrno_Exist = DB::table('PORDER_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

		if($vrno_Exist){
			$NewVrno = $vrNum +1;
		}else{
			$NewVrno = $vrNum;
		}

		$headTble = 'PORDER_HEAD';
		$bodyTble = 'PORDER_BODY';
		$taxTble  = 'PORDER_TAX';
		$headId   = 'PORDERHID';
		$pdfName  = 'JOB WORK ORDER';
		$vrPName  ='JWO NO';

		DB::beginTransaction();

		try {

		    $data = array(

				'PORDERHID'        =>$head_Id,
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
				'DUEDAYS'          =>$dueDays,
				'DUEDATE'          =>$getduedate,
				'ACC_CODE'         =>$accountCode,
				'ACC_NAME'         =>$request->input('account_name'),
				'CPCODE'           =>$request->input('cp_codeGet'),
				'COST_CENTER'      =>$request->input('Cost_Center'),
				'COST_CENTER_NAME' =>$request->input('CostName'),
				'TAX_CODE'         =>$tax_code,
				'PREFNO'           =>$request->input('party_ref_no'),
				'PREFDATE'         =>$getpartyrefdate,
				'RFHEAD1'          =>$request->input('rfhead1'),
				'RFHEAD2'          =>$request->input('rfhead2'),
				'RFHEAD3'          =>$request->input('rfhead3'),
				'RFHEAD4'          =>$request->input('rfhead4'),
				'RFHEAD5'          =>$request->input('rfhead5'),
				'PMT_TERMS'        =>$request->input('payment_terms'),
				'ADV_RATE_I'       =>$request->input('adv_rate_i'),
				'ADV_RATE'         =>$request->input('adv_rate'),
				'ADV_AMT'          =>$request->input('adv_amt'),
				'CRAMT'            =>$grandAmt_cr,
				'created_by'       =>$createdBy,

		    );
		    //print_r($data);
		    $saveDataH = DB::table('PORDER_HEAD')->insert($data);
		    $last_headid = DB::getPdo()->lastInsertId();
	    
		    $data_bodyId = array();
		    $last_bodyid =array();

		    $discriptn_page = "Purchase job work trans insert done by user";

			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$accountCode);

	    	for ($i=0; $i < $countItemCode ; $i++) { 

				$POrderB = DB::select("SELECT MAX(PORDERBID) as PORDERBID FROM PORDER_BODY");
				$bodyID = json_decode(json_encode($POrderB), true); 

				if(empty($bodyID[0]['PORDERBID'])){
				$body_Id = 1;
				}else{
				$body_Id = $bodyID[0]['PORDERBID']+1;
				}


	      		$data_body = array(
	      
			        'PORDERHID'    =>$head_Id,
			        'PORDERBID'    =>$body_Id,
			        'COMP_CODE'    =>$compCode,
			        'FY_CODE'      =>$fisYear,
			        'PFCT_CODE'    =>$pfct_code,
			        'TRAN_CODE'    =>$trans_code,
			        'SERIES_CODE'  =>$series_code,
			        'VRNO'         =>$NewVrno,
			        'SLNO'         =>$i+1,
			        'VRDATE'       =>$tr_vr_date,
			        'PLANT_CODE'   =>$plant_code,
			        'ITEM_CODE'    =>$item_codech[$i],
			        'ITEM_NAME'    =>$item_name[$i],
			        'PARTICULAR'   =>$remark[$i],
			        'HSN_CODE'     =>$hsn_code[$i],
			        'UM'           =>$unit_M[$i],
			        'AUM'          =>$add_unit_M[$i],
			        'RATE'         =>$rate[$i],
			        'BASICAMT'     =>$basic_amt[$i],
			        'TAX_CODE'     =>$tax_byitem[$i],
			        'CRAMT'        =>$amtByItem[$i],
			        'TOL_INDEX'    =>$tolerence_index[$i],
			        'TOL_RATE'     =>$tolerence_rate[$i],
			        'QTYRECD'      =>$qty[$i],
			        'AQTYRECD'     =>$Aqty[$i],
			        'GATEPU_QTY'   =>$qty[$i],
			        'GATEPU_AQTY'  =>$Aqty[$i],
			        //'level_i'    =>$getlevel[$i],
			        //'qty_issued' =>0,
			       // 'FLAG'         =>$FLAG,
			        'CREATED_BY'   =>$createdBy,
	      		);

				$saveDataB = DB::table('PORDER_BODY')->insert($data_body);
				$last_bodyid[] = DB::getPdo()->lastInsertId();

		      	for ($q=0; $q < $data_Count[$i]; $q++) { 

			        $a = array_fill(1, $data_Count[$i], $body_Id);
			        $str = implode(',',$a); 
			        $last_id = explode(',',$str);

			        $data_bodyId[]= $last_id[0];

		      	}

	    	} /*-- for loop close --*/

	    	for($h=0;$h<$itmIsuueCount;$h++){

	    		$POJWT = DB::select("SELECT MAX(POJWOI) as POJWOI FROM JOB_WORK_ORDER_ISSUE");
				$jobID = json_decode(json_encode($POJWT), true); 
	    
				if(empty($jobID[0]['POJWOI'])){
					$job_ID = 1;
				}else{
					$job_ID = $jobID[0]['POJWOI']+1;
				}

				if($qty_isu[$h] == null ||$qty_isu[$h]==''){
					$qtyISu = 0.00;
				}else{
					$qtyISu = $qty_isu[$h];
				}

				if($A_qtyIsu[$h] == null ||$A_qtyIsu[$h]==''){
					$AqtyISu = 0.00;
				}else{
					$AqtyISu = $A_qtyIsu[$h];
				}

	    		$data_JWO = array(
					'PORDERHID'  => $head_Id,
					'POJWOI'     => $job_ID,
					'ITEM_CODE'  => $item_codeIsu[$h],
					'ITEM_NAME'  => $item_name_isu[$h],
					'QTYISSUED'  => $qtyISu,
					'UM'         => $unit_IsueM[$h],
					'AQTYISSUED' => $AqtyISu,
					'AUM'        => $add_unit_MIsu[$h],
				);
				DB::table('JOB_WORK_ORDER_ISSUE')->insert($data_JWO);
	    	}

	    	for ($j=0; $j < $getdatacount; $j++) { 

				$POrderT = DB::select("SELECT MAX(PORDERTID) as PORDERTID FROM PORDER_TAX");
				$taxID = json_decode(json_encode($POrderT), true); 
	    
				if(empty($taxID[0]['PORDERTID'])){
				$tax_Id = 1;
				}else{
				$tax_Id = $taxID[0]['PORDERTID']+1;
				}

				if($amount[$j] == null ||$amount[$j]==''){
					$amountTax = 0.00;
				}else{
					$amountTax = $amount[$j];
				}

				$data_tax = array(
				'PORDERHID'   => $head_Id,
				'PORDERBID'   => $data_bodyId[$j],
				'PORDERTID'   => $tax_Id,
				'TAXIND_CODE' => $tax_ind_code[$j],
				'TAXIND_NAME' => $head_tax_ind[$j],
				'RATE_INDEX'  => $rate_ind[$j],
				'TAX_RATE'    => $af_rate[$j],
				'TAX_AMT'     => $amountTax,
				'TAX_LOGIC'   => $logicget[$j],
				'TAXGL_CODE'  => $tax_gl_code[$j],
				'STATIC_IND'  => $staticget[$j],
				'CREATED_BY'  => $createdBy,
				);
	      
	      		$saveDataT = DB::table('PORDER_TAX')->insert($data_tax);
	    
	   		} /*-- for loop close --*/
   
    		$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->get()->toArray();

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
		      	DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$compCode)->where('FY_CODE',$fisYear)->update($datavrn);
		    }

		   	

			DB::commit();
			$response_array['response'] = 'success';
			if($donwloadStatus ==1 ){
	           return $this->GeneratePdfForPurchase($trans_code,$headTble,$bodyTble,$headId,$head_Id,$taxTble,$createdBy,$pdfName,$vrPName);
	        }
		    	$data = json_encode($response_array);
		    	print_r($data);

		} catch (\Exception $e) {
		    DB::rollBack();
		   // throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}

    
  	}

  	public function jobWorkOrderSave_msg(Request $request,$saveData){

		if ($saveData == 'false') {

			$request->session()->flash('alert-error', 'Data Can Not Be Save...!');
			return redirect('/Transaction/Purchase/View-Job-Work-Order-Trans');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Save...!');
			return redirect('/Transaction/Purchase/View-Job-Work-Order-Trans');

		}
	}

	public function ViewJobWorkOrder(Request $request){

		$compName = $request->session()->get('company_name');

		    if($request->ajax()) {

		        $title ='View Job Work Order';

		        $userid    = $request->session()->get('userid');

		        $userType = $request->session()->get('usertype');

		        $comp_nameval     = $request->session()->get('company_name');
			    $explode          = explode('-', $comp_nameval);
			    $getcom_code      = $explode[0];

		        $fisYear =  $request->session()->get('macc_year');


		        if($userType=='admin' || $userType=='Admin'){

		        $data =DB::select("SELECT PORDER_HEAD.*,PORDER_BODY.PORDERHID as podrHid,PORDER_BODY.PORDERBID,PORDER_BODY.GRNHID,PORDER_BODY.GRNBID,group_concat(concat(PORDER_BODY.GRNHID))AS PORDRTATUSHD,group_concat(concat(PORDER_BODY.GRNBID))AS  PORDRTATUSBD FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_BODY.PORDERHID = PORDER_HEAD.PORDERHID WHERE PORDER_HEAD.COMP_CODE='$getcom_code' AND PORDER_HEAD.FY_CODE='$fisYear' AND PORDER_HEAD.TRAN_CODE='W1' GROUP BY PORDER_HEAD.PORDERHID");

		        }else if($userType=='superAdmin' || $userType=='user'){

		            
		        $data =DB::select("SELECT PORDER_HEAD.*,PORDER_BODY.PORDERHID as podrHid,PORDER_BODY.PORDERBID,PORDER_BODY.GRNHID,PORDER_BODY.GRNBID,group_concat(concat(PORDER_BODY.GRNHID))AS PORDRTATUSHD,group_concat(concat(PORDER_BODY.GRNBID))AS  PORDRTATUSBD FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_BODY.PORDERHID = PORDER_HEAD.PORDERHID WHERE PORDER_HEAD.COMP_CODE='$getcom_code' AND PORDER_HEAD.FY_CODE='$fisYear' AND PORDER_HEAD.TRAN_CODE='W1' GROUP BY PORDER_HEAD.PORDERHID");
		        }
		        else{

		            $data='';
		            
		        }

		    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();

		    }

		    if(isset($compName)){

		       return view('admin.finance.transaction.purchase.view_job_work_order');
		    }else{
				return redirect('/useractivity');
			}
		        
	}

	public function EditJobWorkOrder(Request $request,$headid){

        $title       ='Edit Job Work Order';

        if($headid !=''){

            $headIddCode =base64_decode($headid);
            //print_r($headIddCode);exit;

            $CompanyCode = $request->session()->get('company_name');
            $compcode    = explode('-', $CompanyCode);
            $getcompcode =  $compcode[0];
            $macc_year   = $request->session()->get('macc_year');
            
            $userdata['help_item_list'] = $this->master_item;
            $userdata['rate_list']      = $this->master_rateValue;

            $TranCode = 'W1';

            $functionData = $this->CommonFunction($macc_year,$getcompcode,$TranCode);
            $series_list = $functionData['series_list'];

            $userdata['getJobWorkOrderSaveData'] = DB::select("SELECT p1.*,p2.*,p3.ADD1,p3.STATE_CODE,p4.STATE_CODE as PLANT_STATE_CODE FROM PORDER_HEAD p1,PORDER_BODY p2,MASTER_ACCADD p3,MASTER_PLANT p4 WHERE p1.PORDERHID=p2.PORDERHID AND p1.COMP_CODE='$getcompcode' AND p1.FY_CODE='$macc_year' AND p3.ACC_CODE=p1.ACC_CODE AND p3.CPCODE=p1.CPCODE AND p4.PLANT_CODE=p1.PLANT_CODE AND p4.COMP_CODE=p1.COMP_CODE AND p1.TRAN_CODE='$TranCode' AND p1.PORDERHID='$headIddCode'");

            return view('admin.finance.transaction.purchase.edit_job_work_order',$userdata+compact('title','series_list'));

        }else{

            $request->session()->flash('alert-error', 'Not Found...!');
            return redirect('/Transaction/Purchase/View-Job-Work-Order-Trans');
        }
    }

/* -----------------  END : JOB WORK ORDER TRANSACTION --------------- */

/* -----------------  START : GOOD RECIEPT NOTE TRANSACTION --------------- */

	public function GoodRNote(Request $request){

		$title      ='Add GRN Transaction';
		
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');
		
		$acc_list              = $this->master_party;
		$tax_code_list         = $this->master_taxRate;
		$rate_list             = $this->master_rateValue;
		$userdata['cost_list'] = $this->master_cost;
		$TranCode = 'P4';

		$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','P4')->get();
   		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;

		$functionData = $this->CommonFunction($macc_year,$getcompcode,$TranCode);

		$plant_list = $functionData['plant_list'];
		$item_list = $functionData['item_list'];

		foreach ($functionData['fy_list'] as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}
		$series_list = $functionData['series_list'];

		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.purchase.good_recipt_note',$userdata+compact('title','item_list','rate_list','series_list','plant_list','acc_list','tax_code_list'));

	    }else{

			return redirect('/useractivity');
		}
	}

	public function SaveGoodRNote(Request $request){

		//$dwnloadflag = $request->downloadFlg;
	
		$createdBy        = $request->session()->get('userid');
		$compName         = $request->session()->get('company_name');
		$fisYear          =  $request->session()->get('macc_year');
		
		$comp_nameval     = $request->session()->get('company_name');
		$explode          = explode('-', $comp_nameval);
		$getcom_code      = $explode[0];
		
		$trans_date       = $request->input('trans_date');
		$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
		
		$donwloadStatus   = $request->input('donwloadStatus');
		$trans_code       = $request->input('trans_code');
		$series_code      = $request->input('series_code');
		$gl_Code          = $request->input('Gl_Code');
		$vr_no            = $request->input('vr_no');
		$plant_code       = $request->input('plant_code');
		$pfct_code        = $request->input('pfct_code');
		$accountCode      = $request->input('accountCode');
		$accountName      = $request->input('accountName');
		$accType          = $request->input('AccTypes');
		$accClass         = $request->input('AccClasss');
		$tax_code         = $request->input('tax_code');
		$dueDateget       = $request->input('dueDateget');
		$dueDate          = date("Y-m-d", strtotime($dueDateget));
		$partyRefNo       = $request->input('party_ref_no');
		$partyRefDate     = $request->input('party_ref_date');
		$getpartyRefDate  = date("Y-m-d", strtotime($partyRefDate));
		$consineCode      = $request->input('consine_code');
		$rFHeadO          = $request->input('rfhead1');
		$rFHeadT          = $request->input('rfhead2');
		$rFHeadTh         = $request->input('rfhead3');
		$rFHeadF          = $request->input('rfhead4');
		$rFHeadFi         = $request->input('rfhead5');
		$fy_year          = $request->input('fy_year');
		
		$itembyPo         = $request->input('itemPo');
		$item_code        = $request->input('item_code');
		$item_count       = $request->input('itemcodeC');
		$countItemCode    = count($item_count);
		$item_name        = $request->input('item_name');
		$remark           = $request->input('remark');
		$batchNo          = $request->input('batchNo');
		$qty              = $request->input('qty');
		$unit_M           = $request->input('unit_M');
		$Aqty             = $request->input('Aqty');
		$add_unit_M       = $request->input('add_unit_M');
		$rate             = $request->input('rate');
		$basic_amt        = $request->input('basic_amt');
		
		$hsn_code         = $request->input('hsn_code');
		$tax_byitem       = $request->input('tax_byitem');
		$grandAmt_cr      = $request->input('TotalGrandAmt');
		
		$itembyQtyOrder   = $request->input('itembyQtyOrder');
		$itembyQtysuply   = $request->input('itembyQtysuply');
		
		$getdatacount     = $request->input('getdatacount');
		//print_r($count_rate_ind);exit();
		$head_tax_ind     = $request->input('head_tax_ind');
		$tax_ind_code     = $request->input('taxIndCode');
		$af_rate          = $request->input('af_rate');
		$amount           = $request->input('amount');
		$logicget         = $request->input('logicget');
		$staticget        = $request->input('staticget');
		$dr_grandAmt      = $request->input('dr_grandAmt');
		
		$data_Count       = $request->input('data_Count');
		
		$poseries         = $request->input('po_series');
		$potranscode      = $request->input('po_trans');
		$povrno           = $request->input('po_vrno');
		$poslno           = $request->input('po_slno');
		$poheadid         = $request->input('po_head');
		$pobodyid         = $request->input('po_body');
		
		$tolerence_index  = $request->input('tolerence_index');
		$tolerence_rate   = $request->input('tolerence_rate');
		//print_r($data_Count);
		$rate_ind         = $request->input('rate_ind');
		//$count_rate_ind = count($rate_ind);
		
		$quaP_count       = $request->input('quaP_count');
		$allquaPcount     = $request->input('allquaPcount');
		$item_code_que    = $request->input('item_code_que');
		$item_category    = $request->input('item_category');
		$iqua_char        = $request->input('iqua_char');
		$iqua_desc        = $request->input('iqua_desc');
		$char_fromvalue   = $request->input('char_fromvalue');
		$char_tovalue     = $request->input('char_tovalue');
		$venQcVal         = $request->input('venQcVal');
		$actualQcVal      = $request->input('actualQcVal');
		$thirdPartyQcVal  = $request->input('thirdPartyQcVal');
		$vendorQcName     = $request->input('vendorQcName');
		$purOrderNo       = $request->input('purOrderNo');
		$tax_gl_code      = $request->input('taxGlCode');
		$crAmtItm         = $request->input('crAmtItm');
		$seriesStockFlag  = $request->input('seriesStockFlag');
		$seriesGlC        = $request->input('seriesGl');
		$itemglCode       = $request->input('itemglCode');
		$itemwiseglCode   = $request->input('itmwiseGlCode');

		
		DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','G')->delete();

		$PGrnH = DB::select("SELECT MAX(GRNHID) as GRNHID FROM GRN_HEAD");
		$headID = json_decode(json_encode($PGrnH), true); 
	
		if(empty($headID[0]['GRNHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['GRNHID']+1;
		}

		if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('GRN_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

		$headTble = 'GRN_HEAD';
		$bodyTble = 'GRN_BODY';
		$taxTble  = 'GRN_TAX';
		$headId   = 'GRNHID';
		$pdfName  = 'PURCHASE GRN';
		$vrPName  ='PGRN NO';

		DB::beginTransaction();

		try {

    		$data = array(

				'GRNHID'           =>$head_Id,
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
				'ACC_CODE'         =>$accountCode,
				'ACC_NAME'         =>$request->input('account_name'),
				'CPCODE'           =>$request->input('cp_codeGet'),
				'COST_CENTER'      =>$request->input('Cost_Center'),
				'COST_CENTER_NAME' =>$request->input('CostName'),
				'VENQCNAME'        =>$vendorQcName,
				'DUEDATE'          =>$dueDate,
				'TAX_CODE'         =>$tax_code,
				'CRAMT'            =>$grandAmt_cr,
				'PREFNO'           =>$partyRefNo,
				'PREFDATE'         =>$getpartyRefDate,
				'RFHEAD1'          =>$rFHeadO,
				'RFHEAD2'          =>$rFHeadT,
				'RFHEAD3'          =>$rFHeadTh,
				'RFHEAD4'          =>$rFHeadF,
				'RFHEAD5'          =>$rFHeadFi,
				'CREATED_BY'       =>$createdBy,
				//'pur_order_no'   =>$purOrderNo,

			);
	    	$saveDataH = DB::table('GRN_HEAD')->insert($data);
			$data_taxBody = array();
			$data_qpBody  = array();

			$discriptn_page = "Purchase GRN trans insert done by user";

			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$accountCode);

			for ($i=0; $i < $countItemCode ; $i++) { 

				$PGrnB = DB::select("SELECT MAX(GRNBID) as GRNBID FROM GRN_BODY");
				$bodyID = json_decode(json_encode($PGrnB), true); 
			
				if(empty($bodyID[0]['GRNBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['GRNBID']+1;
				}

				if($itembyPo[$i]){
					$itmcd = $itembyPo[$i];
				}else if($item_code[$i]){
					$itmcd =$item_code[$i];
				}

				if($batchNo[$i]){
				 	$getbatchNo = $batchNo[$i];
				}else{
					$getbatchNo =000;
				}

				$data_body = array(
			
					'GRNHID'      =>$head_Id,
					'GRNBID'      =>$body_Id,
					'COMP_CODE'   =>$getcom_code,
					'FY_CODE'     =>$fisYear,
					'PFCT_CODE'   =>$pfct_code,
					'TRAN_CODE'   =>$trans_code,
					'SERIES_CODE' =>$series_code,
					'VRNO'        =>$NewVrno,
					'SLNO'        =>$i+1,
					'VRDATE'      =>$tr_vr_date,
					'PLANT_CODE'  =>$plant_code,
					'ACC_CODE'    =>$accountCode,
					'PORDERHID'   =>$poheadid[$i],
					'PORDERBID'   =>$pobodyid[$i],
					'ITEM_CODE'   =>$itmcd,
					'ITEM_NAME'   =>$item_name[$i],
					'UM_CODE'     =>$unit_M[$i],
					'AUM_CODE'    =>$add_unit_M[$i],
					'REMARK'      =>$remark[$i],
					'BATCHNO'     =>$getbatchNo,
					'QTYRECED'    =>$qty[$i],
					'AQTYRECD'    =>$Aqty[$i],
					'RATE'        =>$rate[$i],
					'BASICAMT'    =>$basic_amt[$i],
					'CRAMT'       =>$dr_grandAmt[$i],
					'TAX_CODE'    =>$tax_byitem[$i],
					'HSN_CODE'    =>$hsn_code[$i],
					'CREATED_BY'  =>$createdBy,
				);

				$saveDataB = DB::table('GRN_BODY')->insert($data_body);

				if($poheadid[$i] && $pobodyid[$i] && $itmcd){

					$getQtyIsue = DB::table('PORDER_BODY')->where(['PORDERHID'=>$poheadid[$i],'PORDERBID'=>$pobodyid[$i],'ITEM_CODE'=>$itmcd])->get()->first();

					$getqtyIsued = $getQtyIsue->QTYISSUED;

					$data_qtyIsd = array(
						'QTYISSUED' =>$getqtyIsued+$qty[$i],
					);

					$getQtyIsue =  DB::table('PORDER_BODY')->where(['PORDERHID'=>$poheadid[$i],'PORDERBID'=>$pobodyid[$i],'ITEM_CODE'=>$itmcd])->update($data_qtyIsd);

					$getQtyisEq = DB::table('PORDER_BODY')->where(['PORDERHID'=>$poheadid[$i],'PORDERBID'=>$pobodyid[$i],'ITEM_CODE'=>$itmcd])->get()->first();

					if($getQtyisEq->QTYRECD == $getQtyisEq->QTYISSUED){

						$data_grn= array(
				
							'GRNHID'      =>$head_Id,
							'GRNBID'      =>$body_Id,
						);
						DB::table('PORDER_BODY')->where(['PORDERHID'=>$poheadid[$i],'PORDERBID'=>$pobodyid[$i],'ITEM_CODE'=>$itmcd])->update($data_grn);
					}

				}

				//if($seriesStockFlag == 1){

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
					'QTYRECD'        =>$qty[$i],
					'DRAMT'          =>0.00,
					'CRAMT'          =>$crAmtItm[$i],
					'RATE'           =>$rate[$i],
					'BASIC'          =>$basic_amt[$i],
					'AQTYRECD'       =>$Aqty[$i],
					'CREATED_BY'     =>$createdBy,
		    		);

				$saveIemLdg = DB::table('ITEM_LEDGER')->insert($item_led);

				$getdata = DB::table('MASTER_ITEMBAL')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('PLANT_CODE',$plant_code)->where('ITEM_CODE', $itmcd)->get()->first();
				$TotalBasicAmt = $crAmtItm[$i];
				if($getdata){

					$opVal        = $getdata->YROPVAL;
					$recvVal      = $getdata->YRRECDVAL;
					$issuVal      = $getdata->YRISSUEDVAL;
					$opnQty       = $getdata->YROPQTY;
					$recQty       = $getdata->YRQTRECD;
					$issueQty     = $getdata->YRQTYISSUED;
					
					$newYrQtyRecd = $recQty + $qty[$i];
					
					$NewRecdVal   = $recvVal + $TotalBasicAmt;
					
					$opningVal    = $opVal; 	
					#+ $recvVal + $TotalBasicAmt;
					
					$closingVal   = $opVal + $NewRecdVal - $issuVal; 				
					#$recvVal - $issuVal;
					
					$closingQty   = $opnQty + $newYrQtyRecd - $issueQty;
					
					$movAvgRate   = $closingVal / $closingQty;

		            $dataarqty = array(
						'YRQTRECD'  => $newYrQtyRecd,
						'MAVGRATE'  => $movAvgRate,
						'YROPVAL'   => $opningVal,
						'CLQTY'     => $closingQty,
						'CLVAL'     => $closingVal,
						'YRRECDVAL' => $NewRecdVal,
						'BATCH_NO'  => $getbatchNo,
		            );

            		$updateData12 = DB::table('MASTER_ITEMBAL')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('PLANT_CODE',$plant_code)->where('ITEM_CODE', $itmcd)->update($dataarqty);

				}else{

					$mvgRateF = $TotalBasicAmt / $qty[$i];

					$dataItmBal = array(
						'COMP_CODE'  => $getcom_code,
						'FY_CODE'    => $fisYear,
						'PLANT_CODE' => $plant_code,
						'PFCT_CODE'  => $pfct_code,
						'ITEM_CODE'  => $itmcd,
						'MAVGRATE'   => $mvgRateF,
						'YRQTRECD'   => $qty[$i],
						'YRRECDVAL'  => $TotalBasicAmt,
						'BATCH_NO'   => $getbatchNo,
					);

					DB::table('MASTER_ITEMBAL')->insert($dataItmBal);
				}

				//} /* /. stock flag if 1 then insert / update*/

				if($data_Count[$i] == 0){

				}else{

					for ($q=0; $q < $data_Count[$i]; $q++) { 

						$a = array_fill(1, $data_Count[$i], $body_Id);
						$str = implode(',',$a); 
						$last_id = explode(',',$str);

						$data_taxBody[]= $last_id[0];

					}

				}

				if($quaP_count[$i] == 0){

				}else{

					for ($u=0; $u < $quaP_count[$i]; $u++) { 

						$qp = array_fill(1, $quaP_count[$i], $body_Id);
						$strqp = implode(',',$qp); 
						$last_idqp = explode(',',$strqp);

						$data_qpBody[]= $last_idqp[0];

					}

				}
			
			} /*-- for loop close --*/

			$grnInvVar='';

			for ($j=0; $j < $getdatacount; $j++) {

				$st = $j+1;

				$PGrnT = DB::select("SELECT MAX(GRNTID) as GRNTID FROM GRN_TAX");
				$taxID = json_decode(json_encode($PGrnT), true); 
			
				if(empty($taxID[0]['GRNTID'])){
					$tax_Id = 1;
				}else{
					$tax_Id = $taxID[0]['GRNTID']+1;
				} 

				if($amount[$j] == null ||$amount[$j]==''){
					$amount_tax = 0.00;
				}else{
					$amount_tax = $amount[$j];
				}

				$data_tax = array(
					'GRNHID'      => $head_Id,
					'GRNBID'      => $data_taxBody[$j],
					'GRNTID'      => $tax_Id,
					'COMP_CODE'   => $getcom_code,
					'FY_CODE'     => $fisYear,
					'PFCT_CODE'   => $pfct_code,
					'TRAN_CODE'   => $trans_code,
					'SERIES_CODE' => $series_code,
					'VRNO'        => $NewVrno,
					'SLNO'        => $i+1,
					'TSLNO'       => $st,
					'TAXIND_CODE' => $tax_ind_code[$j],
					'TAXIND_NAME' => $head_tax_ind[$j],
					'RATE_INDEX'  => $rate_ind[$j],
					'TAX_LOGIC'   => $logicget[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $amount_tax,
					'TAX_GL_CODE' => $tax_gl_code[$j],
					'STATIC_IND'  => $staticget[$j],
					'CREATED_BY'  => $createdBy,
				);
			
				$saveDataT = DB::table('GRN_TAX')->insert($data_tax);

				$grnInvVar = $this->grnInventory($createdBy,$seriesGlC,$tax_ind_code[$j],$amount_tax,$tax_gl_code[$j],$rate_ind[$j],$data_Count,$dr_grandAmt,$itemwiseglCode[$j],$grandAmt_cr,$j,'G');
		
			} /*-- for loop close --*/

			for ($e=0; $e < $countItemCode ; $e++) {

				$getglAl = DB::table('INDICATOR_TEMP')->where('IND_CODE','SG')->where('IND_GL_CODE',$seriesGlC)->where('TCFLAG','G')->where('CREATED_BY',$createdBy)->get()->first();

				if($getglAl){
	          		$addAmt = $getglAl->CR_AMT + $dr_grandAmt[$e];

	          		$itmDUp   = array(
	          			'CR_AMT'      => $addAmt,
	              	);

	              $updatevr = DB::table('INDICATOR_TEMP')->where('IND_CODE','SG')->where('IND_GL_CODE',$seriesGlC)->where('TCFLAG','G')->where('CREATED_BY',$createdBy)->update($itmDUp);
	        	}else{
	        		$itmD   = array(
			            'IND_CODE'    => 'SG',
			            'DR_AMT'      => '',
			            'CR_AMT'      => $dr_grandAmt[$e],
			            'IND_GL_CODE' => $seriesGlC,
			            'TCFLAG'      => 'G',
			            'CREATED_BY'  => $createdBy,
			                  
		            );

		            DB::table('INDICATOR_TEMP')->insert($itmD);
	        	}

			}

			//DB::enableQueryLog();	
			 $grnDataGet = DB::table('INDICATOR_TEMP')
					->select('INDICATOR_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')
	           		->leftjoin('MASTER_GL', 'INDICATOR_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
	            	->where('INDICATOR_TEMP.TCFLAG','G')
	            	->where('INDICATOR_TEMP.CREATED_BY',$createdBy)
	            	->get()->toArray();
	        // dd(DB::getQueryLog());    	

			$grnDataCount = count($grnDataGet);

			for($h=0;$h<$grnDataCount;$h++){
				$glledgT = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
				$glledgID = json_decode(json_encode($glledgT), true); 
						
				if(empty($glledgID[0]['GLTRANID'])){
					$gl_ledg_Id = 1;
				}else{
					$gl_ledg_Id = $glledgID[0]['GLTRANID']+1;
				}
				$srno = $h+1;
				$ledgData = array(
					'GLTRANID'    => $gl_ledg_Id,
					'COMP_CODE'   => $getcom_code,
					'FY_CODE'     => $fisYear,
					'TRAN_CODE'   => $trans_code,
					'SERIES_CODE' => $series_code,
					'VRNO'        => $NewVrno,
					'SLNO'        => $srno,
					'VRDATE'      => $tr_vr_date,
					'GL_CODE'     => $grnDataGet[$h]->IND_GL_CODE,
					'GL_NAME'     => $grnDataGet[$h]->GL_NAME,
					'DRAMT'       => $grnDataGet[$h]->DR_AMT,
					'CRAMT'       => $grnDataGet[$h]->CR_AMT,
					'CREATED_BY'  => $grnDataGet[$h]->CREATED_BY,
				);

				DB::table('GL_TRAN')->insert($ledgData);
			}

			for ($p=0; $p < $allquaPcount; $p++) { 

				$PGrnQ = DB::select("SELECT MAX(GRNQID) as GRNQID FROM GRN_QUA");
				$QuoID = json_decode(json_encode($PGrnQ), true); 
			
				if(empty($QuoID[0]['GRNQID'])){
					$quo_Id = 1;
				}else{
					$quo_Id = $QuoID[0]['GRNQID']+1;
				} 

				$data_quaP = array(
					'GRNHID'         => $head_Id,
					'GRNBID'         => $data_qpBody[$p],
					'GRNQID'         => $quo_Id,
					'COMP_CODE'      => $getcom_code,
					'FY_CODE'        => $fisYear,
					'PFCT_CODE'      => $pfct_code,
					'TRAN_CODE'      => $trans_code,
					'SERIES_CODE'    => $series_code,
					'VRNO'           => $NewVrno,
					'SLNO'           => $p+1,
					'ITEM_CODE'      => $item_code_que[$p],
					'ICATG_CODE'     => $item_category[$p],
					'IQUA_CHAR'      => $iqua_char[$p],
					'IQUA_UM'        => '',
					'CHAR_FROMVALUE' => $char_fromvalue[$p],
					'CHAR_TOVALUE'   => $char_tovalue[$p],
					'VENDQCVAL'      => $venQcVal[$p],
					'ACTUALQCVAL'    => $actualQcVal[$p],
					'TPQCVAL'        => $thirdPartyQcVal[$p],
					'CREATED_BY'     => $createdBy,
				);
			
				$saveDataQ = DB::table('GRN_QUA')->insert($data_quaP);
		
			} /*-- for loop close --*/

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->get()->toArray();

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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->update($datavrn);
			}

			

			DB::commit();
			$response_array['response'] = 'success';

			if($donwloadStatus == 1){
				return $this->GeneratePdfForPurchase($trans_code,$headTble,$bodyTble,$headId,$head_Id,$taxTble,$createdBy,$pdfName,$vrPName);

			}
		        $data = json_encode($response_array);
		        print_r($data);
		} catch (\Exception $e) {
		    DB::rollBack();
		   throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}

    } /*-- function close --*/


    public function purchase_GRN_msg(Request $request,$saveData){

		if ($saveData == 'false'){

				$request->session()->flash('alert-error', 'Data Can Not Be Save...!');
				return redirect('/Transaction/Purchase/view-Good-Reciept-Note-Trans');

		} else {

				$request->session()->flash('alert-success', 'Data Was Successfully Save...!');
				return redirect('/Transaction/Purchase/view-Good-Reciept-Note-Trans');

		}
	}

	public function grnInventory($userId,$seriesGl,$taxIndCode,$amount,$taxGlCode,$rateIndex,$rowTaxCount,$rowgrandAmr,$itemGl,$totalGrAmt,$countJ,$tcFlag){


    	$indData = DB::table('INDICATOR_TEMP')->where('IND_CODE',$taxIndCode)->where('TCFLAG',$tcFlag)->where('CREATED_BY',$userId)->get()->toArray();

    	//$checkExist = DB::table('INDICATOR_TEMP')->where('TCFLAG','G')->where('CREATED_BY',$userId)->get()->toArray();

    	if($amount != 0.00 || $amount !=''){
    	 		if($rateIndex == 'Z'){

    	 		}else{

    	 			if($taxGlCode != ''){

    	 				if(empty($indData)){

    	 					$idary   = array(
				                  'IND_CODE'    => $taxIndCode,
				                  'DR_AMT'      => $amount,
				                  'CR_AMT'      =>'',
				                  'IND_GL_CODE' => $taxGlCode,
				                  'TCFLAG'      => $tcFlag,
				                  'CREATED_BY'  => $userId,
			                    
			                );

                        	DB::table('INDICATOR_TEMP')->insert($idary);

    	 				}else{

    	 					$indData1 = DB::table('INDICATOR_TEMP')->where('TCFLAG',$tcFlag)->where('IND_CODE',$taxIndCode)->where('CREATED_BY',$userId)->get()->first();

                        	$newTaxAmt = $indData1->DR_AMT + $amount;

                            $idary1 = array(
                              'DR_AMT' => $newTaxAmt,
                              'CR_AMT' =>'',
                            );

                        	$updatevr = DB::table('INDICATOR_TEMP')->where('TCFLAG',$tcFlag)->where('IND_CODE',$taxIndCode)->where('CREATED_BY',$userId)->update($idary1);

    	 				}

    	 			}else{

    	 				$NoGlD = DB::table('INDICATOR_TEMP')->where('TCFLAG',$tcFlag)->where('IND_GL_CODE',$itemGl)->where('CREATED_BY',$userId)->get()->first();

    	 				if($NoGlD){

    	 					$updateId = $NoGlD->CREATED_BY;
	    					$basicAmt = $NoGlD->DR_AMT + $amount;

	    					 $idary_bsic = array(
                              'DR_AMT'    => $basicAmt,
                            );

	    					DB::table('INDICATOR_TEMP')->where('TCFLAG',$tcFlag)->where('IND_GL_CODE',$itemGl)->where('CREATED_BY',$updateId)->update($idary_bsic);

    	 				}else{

    	 					$noGlIn = array(
								'IND_CODE'    => $taxIndCode,
								'DR_AMT'      => $amount,
								'CR_AMT'      => '',
								'IND_GL_CODE' => $itemGl,
								'TCFLAG'      => $tcFlag,
								'CREATED_BY'  => $userId,
			                        
			                );

                    		DB::table('INDICATOR_TEMP')->insert($noGlIn);

    	 				}

    	 			}

		            return true;
    	 		}

    	}
 
    } /* ./ main function*/


    public function ViewGoodRNote(Request $request){

     $compName = $request->session()->get('company_name');

        if($request->ajax()) {
    
            $title ='View Good Reciept Note';
    
            $userid    = $request->session()->get('userid');
    
            $userType = $request->session()->get('usertype');
    
            $comp_nameval     = $request->session()->get('company_name');
		    $explode          = explode('-', $comp_nameval);
		    $getcom_code      = $explode[0];
		    
            $fisYear =  $request->session()->get('macc_year');
    
    
            if($userType=='admin' || $userType=='Admin'){

           //DB::enableQueryLog();
   

		     /*$data = DB::table('GRN_HEAD')
				->select('GRN_HEAD.*', 'MASTER_CONFIG.SERIES_NAME','MASTER_PLANT.PLANT_NAME','MASTER_ACC.ACC_NAME','GRN_BODY.GRNHID AS grn_Hid','GRN_BODY.PBILLHID','GRN_BODY.GRNBID','GRN_BODY.PBILLBID')
           		->leftjoin('MASTER_CONFIG', 'MASTER_CONFIG.SERIES_CODE', '=', 'GRN_HEAD.SERIES_CODE')
           		->leftjoin('MASTER_PLANT', 'MASTER_PLANT.PLANT_CODE', '=', 'GRN_HEAD.PLANT_CODE')
           		->leftjoin('MASTER_ACC', 'MASTER_ACC.ACC_CODE', '=', 'GRN_HEAD.ACC_CODE')
           		->leftjoin('GRN_BODY', 'GRN_BODY.GRNHID', '=', 'GRN_HEAD.GRNHID')
           		->where('GRN_HEAD.FY_CODE',$fisYear)
           		->groupBy('GRN_HEAD.VRNO','GRN_HEAD.SERIES_CODE')
           		->orderBy('GRN_HEAD.GRNHID','DESC');*/

           	$data =DB::select("SELECT GRN_HEAD.*,GRN_BODY.GRNHID as grnHid,GRN_BODY.GRNBID,GRN_BODY.PBILLHID,GRN_BODY.PBILLBID,group_concat(concat(GRN_BODY.PBILLHID))AS PbilTATUSHD,group_concat(concat(GRN_BODY.PBILLBID))AS PbilTATUSBD FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_BODY.GRNHID = GRN_HEAD.GRNHID WHERE GRN_HEAD.COMP_CODE='$getcom_code' AND GRN_HEAD.FY_CODE='$fisYear' GROUP BY GRN_HEAD.GRNHID");


            //dd(DB::getQueryLog());
    
            }else if($userType=='superAdmin' || $userType=='user'){
    
                	$data =DB::select("SELECT GRN_HEAD.*,GRN_BODY.GRNHID as grnHid,GRN_BODY.GRNBID,GRN_BODY.PBILLHID,GRN_BODY.PBILLBID,group_concat(concat(GRN_BODY.PBILLHID))AS PbilTATUSHD,group_concat(concat(GRN_BODY.PBILLBID))AS PbilTATUSBD FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_BODY.GRNHID = GRN_HEAD.GRNHID WHERE GRN_HEAD.COMP_CODE='$getcom_code' AND GRN_HEAD.FY_CODE='$fisYear' GROUP BY GRN_HEAD.GRNHID");

    
            }
            else{
    
                $data='';
                
            }
    
        return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();
    
    
        }

        if(isset($compName)){

      	 	return view('admin.finance.transaction.purchase.view_good_reciept_note_trans');
        }else{
			return redirect('/useractivity');
		}
        
    }

    public function ViewGoodRecieptNoteChildRow(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$vrno   = $request->input('vrno');
		   $headid = $request->input('tblid');

	    
	    	 $grndata = DB::table('GRN_BODY')->where('VRNO',$vrno)->where('GRNHID',$headid)->get();

	   // print_r($indentData);exit;

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

    public function DeletePurchaseGRN(Request $request){

        $head_id = $request->input('headID');
        //print_r($row_count);exit;
        if ($head_id!='') {

			$DeleteHead = DB::table('GRN_HEAD')->where('GRNHID',$head_id)->delete();
			$DeleteBody = DB::table('GRN_BODY')->where('GRNHID',$head_id)->delete();
			$DeleteQuo  = DB::table('GRN_QUA')->where('GRNHID',$head_id)->delete();
			$DeleteTax  = DB::table('GRN_TAX')->where('GRNHID',$head_id)->delete();

			if (($DeleteHead && $DeleteBody && $DeleteTax)) {

				$request->session()->flash('alert-success', 'Goods Reciept Note Data Was Deleted Successfully...!');
				return redirect('/Transaction/Purchase/view-Good-Reciept-Note-Trans');

			} else {

				$request->session()->flash('alert-error', 'Goods Reciept Note Data Can Not Deleted...!');
				return redirect('/Transaction/Purchase/view-Good-Reciept-Note-Trans');

			}
		
		}else{

			$request->session()->flash('alert-error', 'Goods Reciept Note Data Not Found...!');
			return redirect('/Transaction/Purchase/view-Good-Reciept-Note-Trans');

		}
	}

	public function EditGoodRNoteTransaction(Request $request,$headid,$bodyid,$vrno){

    	$id =base64_decode($headid);
    	$body_id =base64_decode($bodyid);
    	$vrno  =base64_decode($vrno);

    	if($id!=''){

    		$userdata['getPurchasegrn'] = DB::select("SELECT t1.*,t2.*,t2.id as bodyid FROM grn_body t2 LEFT JOIN grn_head t1 ON t1.id = t2.grn_head_id AND t1.vr_no = t2.vrno WHERE t1.id='$id' AND t1.vr_no='$vrno'");

			$title      ='Edit GRN';
			
			$CompanyCode             = $request->session()->get('company_name');
			$compcode                = explode('-', $CompanyCode);
			$getcompcode             =	$compcode[0];
			$macc_year               = $request->session()->get('macc_year');
			
			$userdata['getacc']      = DB::table('master_party')->get();
			//DB::enableQueryLog();
			$userdata['series_list'] = DB::table('master_config')->where(['tran_code'=>'P4'])->get();
			//dd(DB::getQueryLog());

			$userdata['tax_code_list'] = DB::table('master_tax')
						->select('master_tax.*', 'master_tax_rate.*')
		           		->leftjoin('master_tax_rate', 'master_tax_rate.tax_code', '=', 'master_tax.tax_code')
		           		->groupBy('master_tax_rate.tax_code')
		           		->get();
			
			$userdata['rate_list']      = DB::table('rate_value')->get();

			$userdata['plant_list']      = DB::table('master_plant')->get();
			$userdata['help_item_list']      = DB::table('master_item_finance')->get();
			
			$getdate                    = DB::table('master_fy')->where(['comp_code'=>$getcompcode,'fy_code'=>$macc_year])->get();

			//print_r($getdate);exit;

			foreach ($getdate as $key) {
						$userdata['fromDate'] =  $key->fy_from_date;
						$userdata['toDate']   =  $key->fy_to_date;
						}


			$cashtrans = DB::table('grn_head')->where('comp_name',$getcompcode)->where('fiscal_year',$macc_year)->get();

			   	$vrseqnum = '';
				foreach ($cashtrans as $key) {
					$vrseqnum =  $key->vr_no;
				}
				$userdata['vrNumber'] =$vrseqnum;
				//DB::enableQueryLog();
			$vr_No_list= DB::select("SELECT * FROM `master_vrseq` WHERE comp_name='$CompanyCode' AND fiscal_year='$macc_year' AND tran_code='P4'");
			//dd(DB::getQueryLog());
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

			return view('admin.finance.transaction.edit_good_recipt_note_trans',$userdata+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'HSN Id Not Found...!');
			return redirect('/finance/view-hsn-rate-master');
		}
	}

	public function UpdateGoodRNoteTrans(Request $request){


		$createdBy      = $request->session()->get('userid');
		$compName       = $request->session()->get('company_name');
		$fisYear        =  $request->session()->get('macc_year');
		
		$headid         = $request->input('grn_headid');
		
		$bodyid         = $request->input('grn_bodyid');
		$taxid          = $request->input('taxid');
		
		$comp_nameval   = $request->input('comp_name');
		$fy_year        = $request->input('fy_year');
		$pfct_code      = $request->input('pfct_code');
		$trans_code     = $request->input('trans_code');
		$series_code    = $request->input('series_code');
		$vr_no          = $request->input('vr_no');
		$vnum           = $request->input('vnum');
		
		$trans_date     = $request->input('trans_date');
		$tr_vr_date     = date("Y-m-d", strtotime($trans_date));
		
		$accountCode    = $request->input('accountCode');
		$plant_code     = $request->input('plant_code');
		$tax_code       = $request->input('tax_code');
		$taxcode        = $request->input('taxcode');
		$tax_byitem     = $request->input('tax_byitem');
		
		$amtByItem      = $request->input('amtByItem');
		$item_code      = $request->input('itemcodeC');
		//print_r($item_code);exit;
		$countItemCode  = count($item_code);
		//print_r($countItemCode);exit();
		$item_name      = $request->input('item_name');
		$remark         = $request->input('remark');
		$qty            = $request->input('qty');
		$unit_M         = $request->input('unit_M');
		$Aqty           = $request->input('Aqty');
		$add_unit_M     = $request->input('add_unit_M');
		$rate           = $request->input('rate');
		$basic_amt      = $request->input('basic_amt');
		$hsn_code       = $request->input('hsn_code');
		$getdatacount   = $request->input('getdatacount');
		//print_r($count_rate_ind);exit();
		$head_tax_ind   = $request->input('head_tax_ind');
		$af_rate        = $request->input('af_rate');
		$amount         = $request->input('amount');
		
		$data_Count     = $request->input('data_Count');
		//print_r($data_Count);
		$rate_ind       = $request->input('rate_ind');
		$count_rate_ind = count($rate_ind);
		
		$logicget       = $request->input('logicget');
		$staticget      = $request->input('staticget');
			
			///print_r($getapprove);exit;

		$data = array(

			'cr_amt'        =>$request->input('cr_amt'),
			
		);
			//print_r($data);
			/*$saveData = DB::table('purchase_order_head')->insert($data);
			$lastid= DB::getPdo()->lastInsertId();*/

		$datalistrray = array();
		$lastid2 =array();

		for ($i=0; $i < $countItemCode ; $i++) { 

			if($bodyid[$i]){
				$getbidyid = $bodyid[$i];
			}

			$data_body = array(
			
				'item_code'              =>$item_code[$i],
				'item_name'              =>$item_name[$i],
				'um_code'                =>$unit_M[$i],
				'aum_code'               =>$add_unit_M[$i],
				'remark'                 =>$remark[$i],
				'quantity'               =>$qty[$i],
				'Aquantity'              =>$Aqty[$i],
				'qty_issued'             =>0,
				'cr_amount'              =>$amtByItem[$i],
				'rate'                   =>$rate[$i],
				'tax_code'               =>$taxcode[$i],
				'hsn_code'               =>$hsn_code[$i],
				'basic_amt'              =>$basic_amt[$i],
				'flag'                   =>'0',
				'created_by'             =>$createdBy,
			);

			$saveData = DB::table('grn_body')->where('id',$bodyid[$i])->where('grn_head_id',$headid)->update($data_body);


			$lastid1 = DB::getPdo()->lastInsertId();
			$lastid2[]= DB::getPdo()->lastInsertId();

		
			for ($q=0; $q < $data_Count[$i]; $q++) { 

				$a = array_fill(1, $data_Count[$i], $getbidyid);
				$str = implode(',',$a); 
				$last_id = explode(',',$str);

				$datalistrray[]= $last_id[0];

			}

			$DeleteData = DB::table('grn_tax')->where('grn_head_id',$headid)->where('grn_body_id',$bodyid[$i])->delete();

		} /*-- for loop close --*/


		if($saveData){
			for ($j=0; $j < $getdatacount; $j++) { 

				$data_tax = array(
					'purchase_order_head_id' => $headid,
					'purchase_order_body_id' => $datalistrray[$j],
					'rate_index'             => $rate_ind[$j],
					'tax_ind_name'           => $head_tax_ind[$j],
					'tax_rate'               => $af_rate[$j],
					'tax_amt'                => $amount[$j],
					'tax_logic'              => $logicget[$j],
					'static'                 => $staticget[$j],
					'created_by'             => $createdBy,
				);
				
				/*$saveData1 = DB::table('purchase_order_tax')->insert($data_tax);*/

				$saveData1 = DB::table('grn_tax')->insert($data_tax);
			
			} /*-- for loop close --*/
		} /*-- if close --*/

		if($saveData2) {

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

/* -----------------  END : GOOD RECIEPT NOTE TRANSACTION --------------- */

/* -----------------  START : PURCHASE BILL TRANSACTION --------------- */
	
	public function PurchaseTransaction(Request $request,$acc_code='',$vr_no='',$seriesCd='',$startYr=''){

		$title      ='Add Purchase Bill Transaction';

		$Acc_Code = base64_decode($acc_code);
		$vrno     = base64_decode($vr_no);
		$seriesCd = base64_decode($seriesCd);
		$startYr  = base64_decode($startYr);

		if($Acc_Code){
			$userdata['getacc'] = DB::table('MASTER_ACC')->where('ACC_CODE',$Acc_Code)->get();
		}else{

		    $userdata['getacc'] = DB::table('MASTER_ACC')->get();
		}

		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =	$compcode[0];

		$macc_year   = $request->session()->get('macc_year');

		$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','P5')->get();
   		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;

		//DB::enableQueryLog();
		$userdata['series_list'] = DB::table('MASTER_CONFIG')->where('TRAN_CODE','P5')->where('COMP_CODE',$getcompcode)->get();

		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();
		
		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		foreach ($getdate as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		/* ---- get data of auto generated note ---- */

		$glOfAutoNote = DB::table('MASTER_CONFIG')->where('TRAN_CODE','M')->where('COMP_CODE',$getcompcode)->get();

		if(!empty($glOfAutoNote[0]->POST_CODE)){
			$userdata['glof_autoNot']       = $glOfAutoNote[0]->POST_CODE;
			$userdata['seriesTcode_auto_N'] = $glOfAutoNote[0]->SERIES_CODE;
			$userdata['trans_head_auto_N'] = $glOfAutoNote[0]->TRAN_CODE;
		}else{
			$userdata['glof_autoNot'] ='';
			$userdata['trans_head_auto_N'] ='';
			$userdata['seriesTcode_auto_N'] ='';
		}

		$vrNo_AutoNote= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE='$getcompcode' AND FY_CODE='$macc_year' AND TRAN_CODE='M'");

		if(!empty($vrNo_AutoNote)){
			foreach ($vrNo_AutoNote as $row) {
				$userdata['last_num_auto_N']    = $row->LAST_NO;
				$userdata['to_num_auto_N']      = $row->TO_NO;
			}
		}else{
			$userdata['last_num_auto_N']    ='1';
			$userdata['to_num_auto_N']      ='9999';
		}

		/* ---- get data of auto generated note ---- */

		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.purchase.purchase_trans',$userdata+compact('title','Acc_Code','vrno','seriesCd','startYr'));

	    }else{

			return redirect('/useractivity');
		}
	}

	public function GetDataFrmGrnForPurBill(Request $request){


    	if ($request->ajax()) {

			if (!empty($request->account_code || $request->grnrvrno)) {
		    	
				$account_code = $request->account_code;
				$grnrvrno     = $request->grnrvrno;

				$strWhere='';

				if(isset($account_code)  && trim($account_code)!="")
                {
                 	$strWhere .= "AND GRN_HEAD.ACC_CODE='$account_code'";
                }

                 if(isset($grnrvrno)  && trim($grnrvrno)!="")
                {
                    $strWhere .= "AND GRN_HEAD.VRNO='$grnrvrno'";
                }

                $data = DB::select("SELECT GRN_HEAD.*, GRN_BODY.*, GRN_BODY.GRNBID as grnbodyid FROM GRN_HEAD LEFT JOIN GRN_BODY ON GRN_HEAD.GRNHID = GRN_BODY.GRNHID WHERE 1=1 $strWhere AND GRN_BODY.PBILLHID='0' AND GRN_BODY.PBILLBID='0'");

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

    public function SavePurchaseTransJustNew(Request $request){

		$CompanyCode  = $request->session()->get('company_name');
		$compcode_get = explode('-', $CompanyCode);
		$compcode     = $compcode_get[0];
		$MaccYear     = $request->session()->get('macc_year');
		$userId       = $request->session()->get('userid');

			if ($request->ajax()) {

				$data_Count   = 9;
				
				$chkcitm           = $request->checkitm;
				$accCode           = $request->accCode;
				$accountName       = $request->accountName;
				$grnrvrno          = $request->grnrvrno;
				$transcode         = $request->transcode;
				$trans_date        = $request->trans_date;
				$vrseqnum          = $request->vrseqnum;
				$basicTotAmt       = $request->basicTotalAmt;
				$partyBilAmt       = $request->partyBilAmt;
				$seriesGl          = $request->seriesGl;
				$seriesGlName      = $request->seriesGlName;
				$partyBilNo        = $request->partyBilNo;
				$partyBilDate      = $request->partyBilDate;
				$diffcrdr          = $request->diffcrdr;
				$totalBasic        = $request->totalBasic;
				$pofitcCode        = $request->pofitcCode;
				$seriesCode        = $request->seriesCode;
				$plantCode         = $request->plantCode;
				$tax_indictorName  = $request->tax_indictorName;
				$rate_indictorName = $request->rate_indictorName;
				$afrate_Name       = $request->afrate_Name;
				$taxAmount         = $request->taxAmount;
				$taxglName         = $request->taxglName;
				$netAmount         = $request->netAmount;
				$taxaplyYorN       = $request->taxaplyYorN;
				$notyesORno        = $request->notyesORno;
				$createNote        = $request->createNote;
				$note_vrno         = $request->note_vrno;
				$note_transHead    = $request->note_transHead;
				$taxcode_crdr      = $request->taxcode_crdr;
				$glof_autoNot      = $request->glof_autoNot;
				$seriesAutoNote    = $request->seriesAutoNote;
				$seriesByTc        = $request->seriesByTc;
				$accountGl         = $request->accountGl;
				$accGlName         = $request->accGlName;
				$seriesName        = $request->seriesText;

				$PBillH = DB::select("SELECT MAX(PBILLHID) as PBILLHID FROM PBILL_HEAD");
				$headID = json_decode(json_encode($PBillH), true); 
			
				if(empty($headID[0]['PBILLHID'])){
					$head_Id = 1;
				}else{
					$head_Id = $headID[0]['PBILLHID']+1;
				}
				
				$getdate      = date("Y-m-d", strtotime($trans_date));
				$getPartyBilD = date("Y-m-d", strtotime($partyBilDate));
				$getcountitm  = count($chkcitm);

				$saveData ='';

				if($vrseqnum == ''){
					$vrNum = 1;
				}else{
					$vrNum = $vrseqnum;
				}

				$vrno_Exist = DB::table('PINDENT_HEAD')->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->where('VRNO',$vrNum)->get()->toArray();

				if($vrno_Exist){
					$NewVrno = $vrNum +1;
				}else{
					$NewVrno = $vrNum;
				}
			DB::beginTransaction();

			try {

				$datahead  = array(
							'PBILLHID'      => $head_Id,
							'COMP_CODE'     => $compcode,
							'FY_CODE'       => $MaccYear,
							'PFCT_CODE'     =>$pofitcCode,
							'TRAN_CODE'     => $transcode,
							'SERIES_CODE'   => $seriesByTc,
							'SERIES_NAME'   => $seriesName,
							'VRNO'          => $NewVrno,
							'VRDATE'        => $getdate,
							'PLANT_CODE'    =>$plantCode,
							'ACC_CODE'      => $accCode,
							'ACC_NAME'      => $accountName,
							'PARTYBILLNO'   => $partyBilNo,
							'PARTYBILLDATE' => $getPartyBilD,
							'PBILLAMT'      => $partyBilAmt,
							'CREATED_BY'    => $userId,
							/*'gl_code'      => $accountGl,
							'grn_no'         => $grnrvrno,
							'partybill_no'   => $partyBilNo,
							'partybill_date' => $getPartyBilD,*/
							);

				DB::table('PBILL_HEAD')->insert($datahead);
				//$headlastid= DB::getPdo()->lastInsertId();

				$discriptn_page = "Purchase bill trans insert done by user";

				$this->userLogInsert($userId,$transcode,$seriesByTc,$vrseqnum,$discriptn_page,$accCode);

					
				DB::table('INDICATOR_TEMP')->where('CREATED_BY',$userId)->delete();

				for ($i=0; $i < $getcountitm ; $i++) {

					$PBillB = DB::select("SELECT MAX(PBILLBID) as PBILLBID FROM PBILL_BODY");
					$bodyID = json_decode(json_encode($PBillB), true); 
				
					if(empty($bodyID[0]['PBILLBID'])){
						$body_Id = 1;
					}else{
						$body_Id = $bodyID[0]['PBILLBID']+1;
					}


					$configapp = DB::table('MASTER_CONFIG_APPROVE')->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriesByTc)->get()->toArray();

			
						if($configapp){
						//	print_r('hi');exit;
							$FLAG = 0;
						}else{
							//print_r('hello');exit;
							$FLAG = 3;
						}

					$getcheckdata = $chkcitm[$i];

					$explodedata = explode('/', $getcheckdata);

					$headid = $explodedata[0];
					$bodyid = $explodedata[1];
					$itmcode = $explodedata[2];

					//$data = DB::table('GRN_HEAD')->where('GRNHID',$headid)->get()->first();

					$data = DB::table('GRN_BODY')->where('GRNHID',$headid)->where('GRNBID',$bodyid)->where('ITEM_CODE',$itmcode)->get();
					
					$baseamt = array();

					foreach ($data as $row) {
						
						$grnhid    =  $row->GRNHID;
						$grnbid    =  $row->GRNBID;
						$grntCod   =  $row->TRAN_CODE;
						$grnvrno   =  $row->VRNO;
						$grnslno   =  $row->SLNO;
						$itmCode   =  $row->ITEM_CODE;
						$itemname  =  $row->ITEM_NAME;
						$umcode    =  $row->UM_CODE;
						$aumcod    =  $row->AUM_CODE;
						$remark    =  $row->REMARK;
						$quantity  =  $row->QTYRECED;
						$Aquantity =  $row->AQTYRECD;
						$rate      =  $row->RATE;
						$basic_amt =  $row->BASICAMT;
						$taxcode   =  $row->TAX_CODE;
						$hsncode   =  $row->HSN_CODE;
						$drAmt     =  $row->CRAMT;
						$baseamt[] =  $row->BASICAMT;
							
						$dataArray  = array(

							'PBILLHID'      => $head_Id,
							'PBILLBID'      => $body_Id,
							'COMP_CODE'     => $compcode,
							'FY_CODE'       => $MaccYear,
							'TRAN_CODE'     => $transcode,
							'VRNO'          => $NewVrno,
							'VRDATE'        => $getdate,
							'ITEM_CODE'     => $itmCode,
							'ITEM_NAME'     => $itemname,
							'PARTICULAR'    => $remark,
							'HSN_CODE'      => $hsncode,
							'QTYRECD'       => $quantity,
							'UM'            => $umcode,
							'AQTYRECD'      => $Aquantity,
							'AUM'           => $aumcod,
							'RATE'          => $rate,
							'BASICAMT'      => $basic_amt,
							'TAX_CODE'      => $taxcode,
							'CRAMT'         => $drAmt,
							'CREATED_BY'    => $userId,
							/*'grn_transCode' => $grntCod,
							'grn_vrno'      => $grnvrno,
							'grn_slno'      => $grnslno,*/

						);

						$saveData = DB::table('PBILL_BODY')->insert($dataArray);
						$bodyLid = DB::getPdo()->lastInsertId();

						$data_bil= array(
			
							'PBILLHID' =>$head_Id,
							'PBILLBID' =>$body_Id,
						);
				 		DB::table('GRN_BODY')->where(['GRNHID'=>$grnhid,'GRNBID'=>$grnbid,'ITEM_CODE'=>$itmCode])->update($data_bil);

					}

					$quapData = DB::select("SELECT t1.*,t2.*,t3.*,t4.GL_CODE,t4.GL_NAME FROM GRN_TAX t3 LEFT JOIN GRN_BODY t2 ON t2.GRNBID = t3.GRNBID LEFT JOIN GRN_HEAD t1 ON t1.GRNHID = t3.GRNHID LEFT JOIN MASTER_GL t4 ON t4.GL_CODE=t3.TAX_GL_CODE WHERE t2.ITEM_CODE='$itmCode' AND t3.GRNHID='$headid' AND t3.GRNBID='$bodyid'");

					$taxcount = count($quapData);

					$indAry = array();
					for($k=0;$k<$taxcount;$k++){

						$PBillT = DB::select("SELECT MAX(PBILLTID) as PBILLTID FROM PBILL_TAX");
						$taxID = json_decode(json_encode($PBillT), true); 
					
						if(empty($taxID[0]['PBILLTID'])){
							$tax_Id = 1;
						}else{
							$tax_Id = $taxID[0]['PBILLTID']+1;
						}


						$taxind_name = $quapData[$k]->TAXIND_NAME;
						$rateindex   = $quapData[$k]->RATE_INDEX;
						$taxrate     = $quapData[$k]->TAX_RATE;
						$taxamt      = $quapData[$k]->TAX_AMT;
						$taxlogic    = $quapData[$k]->TAX_LOGIC;
						$static      = $quapData[$k]->STATIC_IND;
						$tax_gl_code = $quapData[$k]->TAX_GL_CODE;
						$pfctCode    = $quapData[$k]->PFCT_CODE;
						$seriesCode  = $quapData[$k]->SERIES_CODE;
						$gl_name     = $quapData[$k]->GL_NAME;
						$uniqCheck   = $quapData[$k]->TAXIND_CODE;

						$dataQp = array(
							'PBILLHID'    => $head_Id,
							'PBILLBID'    => $body_Id,
							'PBILLTID'    => $tax_Id,
							'TAXIND_CODE' => $uniqCheck,
							'TAXIND_NAME' => $taxind_name,
							'RATE_INDEX'  => $rateindex,
							'TAX_RATE'    => $taxrate,
							'TAX_AMT'     => $taxamt,
							'TAX_LOGIC'   => $taxlogic,
							'TAXGL_CODE'  => $tax_gl_code,
							'STATIC_IND'  => $static 
						);

						DB::table('PBILL_TAX')->insert($dataQp);

					} /* /. for */
					
				} /* main for (item)*/

				if($diffcrdr !=0.00){
					if($createNote == 'Creadit Note'){

						$idary = array(
							'IND_CODE'    => '',
							'DR_AMT'      => $netAmount,
							'IND_GL_CODE' => $seriesGl,
							'IND_GL_NAME' => $seriesGlName,
							'REF_ACCCODE' => $accCode,
							'REF_ACCNAME' => $accountName,
							'GLACC_Chk'   => '',
							'CREATED_BY'  => $userId,
						
						);
						DB::table('INDICATOR_TEMP')->insert($idary);

					}else if($createNote == 'Debit Note'){

						$idaryd = array(
							'IND_CODE'    => '',
							'DR_AMT'      => $netAmount,
							'IND_GL_CODE' => $seriesGl,
							'IND_GL_NAME' => $seriesGlName,
							'REF_ACCCODE' => $accCode,
							'REF_ACCNAME' => $accountName,
							'GLACC_Chk'   => '',
							'CREATED_BY'  => $userId,
						
						);
						DB::table('INDICATOR_TEMP')->insert($idaryd);

					}
				}else{
					$idarya = array(
						'IND_CODE'    => '',
						'DR_AMT'      => $partyBilAmt,
						'IND_GL_CODE' => $seriesGl,
						'IND_GL_NAME' => $seriesGlName,
						'REF_ACCCODE' => $accCode,
						'REF_ACCNAME' => $accountName,
						'GLACC_Chk'   => '',
						'CREATED_BY'  => $userId,
					
					);
					DB::table('INDICATOR_TEMP')->insert($idarya);
				}

				$crData1   = array(
							'CR_AMT'       => $partyBilAmt,
							'IND_ACC_CODE' => $accCode,
							'IND_ACC_NAME' => $accountName,
							'IND_GL_CODE'  => $accountGl,
							'IND_GL_NAME'  => $accGlName,
							'REF_ACCCODE'  => $accCode,
							'REF_ACCNAME'  => $accountName,
							'GLACC_Chk'   => 'ACC',
							'CREATED_BY'   => $userId,
						);

				DB::table('INDICATOR_TEMP')->insert($crData1);

				if($taxaplyYorN == 'YES'){
					if($createNote == 'Debit Note'){
						$drNote   = array(
							'DR_AMT'       => $diffcrdr,
							'IND_ACC_CODE' => $accCode,
							'IND_GL_CODE'  => $accountGl,
							'IND_GL_NAME'  => $accGlName,
							'GLACC_Chk'   => '',
							'REF_ACCCODE'  => $accCode,
							'REF_ACCNAME'  => $accountName,
							'CREATED_BY'   => $userId,
						);
						DB::table('INDICATOR_TEMP')->insert($drNote);

						$PDrH = DB::select("SELECT MAX(DRNOTEHID) as DRNOTEHID FROM DRNOTE_HEAD");
						$headDID = json_decode(json_encode($PDrH), true); 
					
						if(empty($headDID[0]['DRNOTEHID'])){
							$headPd_Id = 1;
						}else{
							$headPd_Id = $headDID[0]['DRNOTEHID']+1;
						}

						$dataheadNote = array(
							'DRNOTEHID'   =>$headPd_Id,
							'COMP_CODE'   =>$compcode,
							'FY_CODE'     =>$MaccYear,
							'TRAN_CODE'   =>$note_transHead,
							'SERIES_CODE' =>$seriesAutoNote,
							'VRNO'        =>$note_vrno,
							'VRDATE'      =>$getdate,
							'ACC_CODE'    =>$accCode,
							'TAX_CODE'    =>$taxcode_crdr,
							'DRAMT'       =>$diffcrdr,
							'CREATED_BY'  =>$userId,
							//'diff_amt'    =>$diffcrdr,
						);
						DB::table('DRNOTE_HEAD')->insert($dataheadNote);

					}
				}

				$indCount = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$userId)->get()->toArray();

				foreach ($indCount as $key) {

					$glledgH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
						$hglLedgID = json_decode(json_encode($glledgH), true); 
					
						if(empty($hglLedgID[0]['GLTRANID'])){
							$h_gl_ledg_Id = 1;
						}else{
							$h_gl_ledg_Id = $hglLedgID[0]['GLTRANID']+1;
						}

						$dataGLlegd = array(
							'GLTRANID'    =>$h_gl_ledg_Id,
							'COMP_CODE'   =>$compcode,
							'FY_CODE'     =>$MaccYear,
							'TRAN_CODE'   =>$transcode,
							'SERIES_CODE' =>$seriesByTc,
							'VRNO'        =>$NewVrno,
							'VRDATE'      =>$getdate,
							'PFCT_CODE'   =>$pofitcCode,
							'GL_CODE'     =>$key->IND_GL_CODE,
							'GL_NAME'     =>$key->IND_GL_NAME,
							'REF_CODE'    =>$key->REF_ACCCODE,
							'REF_NAME'    =>$key->REF_ACCNAME,
							'DRAMT'       =>$key->DR_AMT,
							'CRAMT'       =>$key->CR_AMT,
							'PARTICULAR'  =>'Billno -'.$partyBilNo.', Billdate -'.$getPartyBilD.', BillAmt -'.$partyBilAmt,
							'CREATED_BY'  =>$userId

						);
						DB::table('GL_TRAN')->insert($dataGLlegd);

					if($key->GLACC_Chk =='ACC'){

						$AledgH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
						$hALedgID = json_decode(json_encode($AledgH), true); 
					
						if(empty($hALedgID[0]['ACCTRANID'])){
							$h_acc_ledg_Id = 1;
						}else{
							$h_acc_ledg_Id = $hALedgID[0]['ACCTRANID']+1;
						}

						

						$datacclegd = array(
							'ACCTRANID' =>$h_acc_ledg_Id,
							'COMP_CODE'    =>$compcode,
							'FY_CODE'      =>$MaccYear,
							'TRAN_CODE'    =>$transcode,
							'SERIES_CODE'  =>$seriesByTc,
							'VRNO'         =>$NewVrno,
							'VRDATE'       =>$getdate,
							'PFCT_CODE'    =>$pofitcCode,
							'ACC_CODE'     =>$key->IND_ACC_CODE,
							'ACC_NAME'     =>$key->IND_ACC_NAME,
							'REF_CODE'     =>$accountGl,
							'REF_NAME'     =>$accGlName,
							'DRAMT'        =>$key->DR_AMT,
							'CRAMT'        =>$key->CR_AMT,
							'PARTICULAR'   =>'Billno -'.$partyBilNo.', Billdate -'.$getPartyBilD.', BillAmt -'.$partyBilAmt,
							'CREATED_BY'   =>$userId

						);
						DB::table('ACC_TRAN')->insert($datacclegd);

					}

			    } /* /. each loop*/

				if($taxaplyYorN == 'YES' && $notyesORno=='YES'){

				if($createNote == 'Creadit Note'){
					$indc_Count = count($tax_indictorName);
					$taxTotalGet =0;
					$noGl = 0;$totnoGl=0;$basicName;$totalGetAmt=0;
					$getPlusAmt=0;

					$crNoteHead = DB::select("SELECT MAX(CRNOTEHID) as CRNOTEHID FROM CRNOTE_HEAD");
					$crHID = json_decode(json_encode($crNoteHead), true); 

					if(empty($crHID[0]['CRNOTEHID'])){
						$crH_Id = 1;
					}else{
						$crH_Id = $crHID[0]['CRNOTEHID']+1;
					}

					$crheadNote = array(
						'CRNOTEHID'   =>$crH_Id,
						'COMP_CODE'   =>$compcode,
						'FY_CODE'     =>$MaccYear,
						'TRAN_CODE'   =>$note_transHead,
						'SERIES_CODE' =>$seriesAutoNote,
						'VRNO'        =>$note_vrno,
						'VRDATE'      =>$getdate,
						'ACC_CODE'    =>$accCode,
						'TAX_CODE'    =>$taxcode_crdr,
						'CREATED_BY'  =>$userId
						//'diff_amt'    =>$diffcrdr,

					);

					DB::table('CRNOTE_HEAD')->insert($crheadNote);

					$totnoGl =0;$basicName;

					for($r=0;$r<$indc_Count;$r++){

						$PCrtaxH = DB::select("SELECT MAX(CRNOTETID) as CRNOTETID FROM CRNOTE_TAX");
						$taxcrID = json_decode(json_encode($PCrtaxH), true); 
					
						if(empty($taxcrID[0]['CRNOTETID'])){
							$crtax_Id = 1;
						}else{
							$crtax_Id = $taxcrID[0]['CRNOTETID']+1;
						}

						$basicAmt = $taxAmount[0];
						$basicName = $tax_indictorName[0];

						if($tax_indictorName[$r] == 'Basic'){

						}else{
							if($rate_indictorName[$r] == 'Z'){

							}else{

								if($taxglName[$r] != 'null'){

									if($taxAmount[$r] !=''){
								
										$datacrNote = array(
										'CRNOTEHID'   =>$crH_Id,
										'CRNOTETID'   =>$crtax_Id,
										'TAXIND_NAME' =>$tax_indictorName[$r],
										'RATE_INDEX'  =>$rate_indictorName[$r],
										'TAX_RATE'    =>$afrate_Name[$r],
										'TAX_AMT'     =>$taxAmount[$r],
										'TAXGL_CODE'  =>$taxglName[$r],
										'CREATED_BY'  =>$userId

										);

										DB::table('CRNOTE_TAX')->insert($datacrNote);

									}else{
										$getPlusAmt=0;
									}
									
								}else{	

									$noGl += $taxAmount[$r];
									$totnoGl= $noGl + $basicAmt;

								}

							}
						}

					} /* /. for loop*/

					$cata_crNote = array(
						'CRNOTEHID'   =>$crH_Id,
						'CRNOTETID'   =>$crtax_Id,
						'TAXIND_NAME' =>$basicName,
						'RATE_INDEX'  =>'-',
						'TAX_RATE'    =>'---',
						'TAX_AMT'     =>$totnoGl,
						'TAXGL_CODE'  =>$seriesGl,
						'CREATED_BY'  =>$userId

					);

					DB::table('CRNOTE_TAX')->insert($cata_crNote);
					//DB::enableQueryLog();
					$madeNote = DB::select("SELECT t1.*,t3.*,t4.GL_CODE,t4.GL_NAME FROM CRNOTE_TAX t3 LEFT JOIN CRNOTE_HEAD t1 ON t1.CRNOTEHID = t3.CRNOTEHID LEFT JOIN MASTER_GL t4 ON t4.GL_CODE=t3.TAXGL_CODE WHERE t1.TRAN_CODE='$note_transHead' AND t1.CREATED_BY='$userId' AND t1.VRNO='$note_vrno'");
					//dd(DB::getQueryLog());
					$noteCount = count($madeNote);

					for($s=0;$s<$noteCount;$s++){

						$gledg_H = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
						$gLedg_ID = json_decode(json_encode($gledg_H), true); 
					
						if(empty($gLedg_ID[0]['GLTRANID'])){
							$gheadledg_Id = 1;
						}else{
							$gheadledg_Id = $gLedg_ID[0]['GLTRANID']+1;
						}

						$notedata = array(
							'GLTRANID'    =>$gheadledg_Id,
							'COMP_CODE'   =>$compcode,
							'FY_CODE'     =>$MaccYear,
							'VRDATE'      =>$getdate,
							'TRAN_CODE'   =>$madeNote[$s]->TRAN_CODE,
							'SERIES_CODE' =>$madeNote[$s]->SERIES_CODE,
							'VRNO'        =>$madeNote[$s]->VRNO,
							'GL_CODE'     =>$madeNote[$s]->TAXGL_CODE,
							'GL_NAME'     =>$madeNote[$s]->GL_NAME,
							'REF_CODE'    =>$accCode,
							'REF_NAME'    =>$accountName,
							'CRAMT'       =>$madeNote[$s]->TAX_AMT,
							'CREATED_BY'  =>$userId

						);

						DB::table('GL_TRAN')->insert($notedata);
					}

				} /* /. creadit note if*/
					
				} /* /. tax n note yes*/


				$bodyTblNm = 'PBILL_BODY';
				$apvTblNm  = 'PBILL_APPROVE';
				$bodyCol   = 'PBILLBID';
				$apvCol    = 'PBILLAID';
				$headCol   = 'PBILLHID';
				$pfct_code ='';
				
				$this->approve_Trans($bodyTblNm,$bodyCol,$transcode,$seriesByTc,$apvTblNm,$compcode,$MaccYear,$pfct_code,$transcode,$seriesByTc,$vrseqnum,$getdate,$userId,$head_Id,$apvCol,$headCol);


				/*$datavr =array(
					'LAST_NO'=>$vrseqnum
				);
				$updatevr = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->where('COMP_CODE',$compcode)->update($datavr);*/

				$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriesByTc)->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->get()->toArray();

				if(empty($checkvrnoExist)){

					$datavrnIn =array(
						'COMP_CODE'   =>$compcode,
						'FY_CODE'     =>$MaccYear,
						'TRAN_CODE'   =>$transcode,
						'SERIES_CODE' =>$seriesByTc,
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
					DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriesByTc)->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->update($datavrn);
				}

				$datavrAuto =array(
					'LAST_NO'=>$note_vrno
				);
				$updatevr = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$note_transHead)->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->update($datavrAuto);
			DB::commit();
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

	
		} /* /. ajax*/
				
    } /*-- function close --*/

    public function SavePurchaseTrans(Request $request){

		$CompanyCode  = $request->session()->get('company_name');
		$compcode_get = explode('-', $CompanyCode);
		$compcode     = $compcode_get[0];
		$MaccYear     = $request->session()->get('macc_year');
		$userId       = $request->session()->get('userid');

			if ($request->ajax()) {

				$data_Count   = 9;
				
				$chkcitm           = $request->checkitm;
				$accCode           = $request->accCode;
				$accountName       = $request->accountName;
				$grnrvrno          = $request->grnrvrno;
				$transcode         = $request->transcode;
				$trans_date        = $request->trans_date;
				$vrseqnum          = $request->vrseqnum;
				$basicTotAmt       = $request->basicTotalAmt;
				$partyBilAmt       = $request->partyBilAmt;
				$seriesGl          = $request->seriesGl;
				$seriesGlName      = $request->seriesGlName;
				$partyBilNo        = $request->partyBilNo;
				$partyBilDate      = $request->partyBilDate;
				$diffcrdr          = $request->diffcrdr;
				$totalBasic        = $request->totalBasic;
				$pofitcCode        = $request->pofitcCode;
				$seriesCode        = $request->seriesCode;
				$plantCode         = $request->plantCode;
				$tax_indictorName  = $request->tax_indictorName;
				$rate_indictorName = $request->rate_indictorName;
				$afrate_Name       = $request->afrate_Name;
				$taxAmount         = $request->taxAmount;
				$taxglName         = $request->taxglName;
				$netAmount         = $request->netAmount;
				$taxaplyYorN       = $request->taxaplyYorN;
				$notyesORno        = $request->notyesORno;
				$createNote        = $request->createNote;
				$note_vrno         = $request->note_vrno;
				$note_transHead    = $request->note_transHead;
				$taxcode_crdr      = $request->taxcode_crdr;
				$glof_autoNot      = $request->glof_autoNot;
				$seriesAutoNote    = $request->seriesAutoNote;
				$seriesByTc        = $request->seriesByTc;
				$accountGl         = $request->accountGl;
				$accGlName         = $request->accGlName;
				$seriesName        = $request->seriesText;
				$profitCName       = $request->profitCName;
				$plantName         = $request->plantName;
				$cpCode            = $request->cpCode;
				$costCenterCd      = $request->costCenterCd;
				$costCenterName    = $request->costCenterName;
				$donwloadStatus    = $request->donwloadStatus;

				$PBillH = DB::select("SELECT MAX(PBILLHID) as PBILLHID FROM PBILL_HEAD");
				$headID = json_decode(json_encode($PBillH), true); 
			
				if(empty($headID[0]['PBILLHID'])){
					$head_Id = 1;
				}else{
					$head_Id = $headID[0]['PBILLHID']+1;
				}
				
				$getdate      = date("Y-m-d", strtotime($trans_date));
				$getPartyBilD = date("Y-m-d", strtotime($partyBilDate));
				$getcountitm  = count($chkcitm);

				$saveData ='';

				if($vrseqnum == ''){
					$vrNum = 1;
				}else{
					$vrNum = $vrseqnum;
				}

				$vrno_Exist = DB::table('PINDENT_HEAD')->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->where('VRNO',$vrNum)->get()->toArray();

				if($vrno_Exist){
					$NewVrno = $vrNum +1;
				}else{
					$NewVrno = $vrNum;
				}

				$headTble = 'PBILL_HEAD';
				$bodyTble = 'PBILL_BODY';
				$taxTble  = 'PBILL_TAX';
				$headId   = 'PBILLHID';
				$pdfName  = 'PURCHASE BILL';
				$vrPName  ='PBILL NO';
			DB::beginTransaction();

			try {

				$datahead  = array(
						'PBILLHID'         => $head_Id,
						'COMP_CODE'        => $compcode,
						'FY_CODE'          => $MaccYear,
						'PFCT_CODE'        =>$pofitcCode,
						'PFCT_NAME'        =>$profitCName,
						'TRAN_CODE'        => $transcode,
						'SERIES_CODE'      => $seriesByTc,
						'SERIES_NAME'      => $seriesName,
						'VRNO'             => $NewVrno,
						'VRDATE'           => $getdate,
						'PLANT_CODE'       =>$plantCode,
						'PLANT_NAME'       =>$plantName,
						'ACC_CODE'         => $accCode,
						'ACC_NAME'         => $accountName,
						'CPCODE'           => $cpCode,
						'COST_CENTER'      => $costCenterCd,
						'COST_CENTER_NAME' => $costCenterName,
						'PARTYBILLNO'      => $partyBilNo,
						'PARTYBILLDATE'    => $getPartyBilD,
						'PBILLAMT'         => $partyBilAmt,
						'CREATED_BY'       => $userId,
						/*'gl_code'        => $accountGl,
						'grn_no'           => $grnrvrno,
						'partybill_no'     => $partyBilNo,
						'partybill_date'   => $getPartyBilD,*/
					);

				DB::table('PBILL_HEAD')->insert($datahead);
				//$headlastid= DB::getPdo()->lastInsertId();

				$discriptn_page = "Purchase bill trans insert done by user";

				$this->userLogInsert($userId,$transcode,$seriesByTc,$vrseqnum,$discriptn_page,$accCode);

					
				DB::table('INDICATOR_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','PB')->delete();

				for ($i=0; $i < $getcountitm ; $i++) {

					$PBillB = DB::select("SELECT MAX(PBILLBID) as PBILLBID FROM PBILL_BODY");
					$bodyID = json_decode(json_encode($PBillB), true); 
				
					if(empty($bodyID[0]['PBILLBID'])){
						$body_Id = 1;
					}else{
						$body_Id = $bodyID[0]['PBILLBID']+1;
					}


					$configapp = DB::table('MASTER_CONFIG_APPROVE')->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriesByTc)->get()->toArray();
		
					if($configapp){
					//	print_r('hi');exit;
						$FLAG = 0;
					}else{
						//print_r('hello');exit;
						$FLAG = 3;
					}

					$getcheckdata = $chkcitm[$i];

					$explodedata = explode('/', $getcheckdata);

					$headid = $explodedata[0];
					$bodyid = $explodedata[1];
					$itmcode = $explodedata[2];

					//$data = DB::table('GRN_HEAD')->where('GRNHID',$headid)->get()->first();

					$data = DB::table('GRN_BODY')->where('GRNHID',$headid)->where('GRNBID',$bodyid)->where('ITEM_CODE',$itmcode)->get();
					
					$baseamt = array();

					foreach ($data as $row) {
						
						$grnhid    =  $row->GRNHID;
						$grnbid    =  $row->GRNBID;
						$grntCod   =  $row->TRAN_CODE;
						$grnvrno   =  $row->VRNO;
						$grnslno   =  $row->SLNO;
						$itmCode   =  $row->ITEM_CODE;
						$itemname  =  $row->ITEM_NAME;
						$umcode    =  $row->UM_CODE;
						$aumcod    =  $row->AUM_CODE;
						$remark    =  $row->REMARK;
						$quantity  =  $row->QTYRECED;
						$Aquantity =  $row->AQTYRECD;
						$rate      =  $row->RATE;
						$basic_amt =  $row->BASICAMT;
						$taxcode   =  $row->TAX_CODE;
						$hsncode   =  $row->HSN_CODE;
						$drAmt     =  $row->CRAMT;
						$baseamt[] =  $row->BASICAMT;
							
						$dataArray  = array(

							'PBILLHID'      => $head_Id,
							'PBILLBID'      => $body_Id,
							'COMP_CODE'     => $compcode,
							'FY_CODE'       => $MaccYear,
							'TRAN_CODE'     => $transcode,
							'VRNO'          => $NewVrno,
							'VRDATE'        => $getdate,
							'ITEM_CODE'     => $itmCode,
							'ITEM_NAME'     => $itemname,
							'PARTICULAR'    => $remark,
							'HSN_CODE'      => $hsncode,
							'QTYRECD'       => $quantity,
							'UM'            => $umcode,
							'AQTYRECD'      => $Aquantity,
							'AUM'           => $aumcod,
							'RATE'          => $rate,
							'BASICAMT'      => $basic_amt,
							'TAX_CODE'      => $taxcode,
							'CRAMT'         => $drAmt,
							'CREATED_BY'    => $userId,
							/*'grn_transCode' => $grntCod,
							'grn_vrno'      => $grnvrno,
							'grn_slno'      => $grnslno,*/

						);

						$saveData = DB::table('PBILL_BODY')->insert($dataArray);
						$bodyLid = DB::getPdo()->lastInsertId();

						$data_bil= array(
			
							'PBILLHID' =>$head_Id,
							'PBILLBID' =>$body_Id,
						);
				 		DB::table('GRN_BODY')->where(['GRNHID'=>$grnhid,'GRNBID'=>$grnbid,'ITEM_CODE'=>$itmCode])->update($data_bil);

					}

					$quapData = DB::select("SELECT t1.*,t2.*,t3.*,t4.GL_CODE,t4.GL_NAME FROM GRN_TAX t3 LEFT JOIN GRN_BODY t2 ON t2.GRNBID = t3.GRNBID LEFT JOIN GRN_HEAD t1 ON t1.GRNHID = t3.GRNHID LEFT JOIN MASTER_GL t4 ON t4.GL_CODE=t3.TAX_GL_CODE WHERE t2.ITEM_CODE='$itmCode' AND t3.GRNHID='$headid' AND t3.GRNBID='$bodyid'");

					$taxcount = count($quapData);

					$indAry = array();
					for($k=0;$k<$taxcount;$k++){

						$PBillT = DB::select("SELECT MAX(PBILLTID) as PBILLTID FROM PBILL_TAX");
						$taxID = json_decode(json_encode($PBillT), true); 
					
						if(empty($taxID[0]['PBILLTID'])){
							$tax_Id = 1;
						}else{
							$tax_Id = $taxID[0]['PBILLTID']+1;
						}


						$taxind_name = $quapData[$k]->TAXIND_NAME;
						$rateindex   = $quapData[$k]->RATE_INDEX;
						$taxrate     = $quapData[$k]->TAX_RATE;
						$taxamt      = $quapData[$k]->TAX_AMT;
						$taxlogic    = $quapData[$k]->TAX_LOGIC;
						$static      = $quapData[$k]->STATIC_IND;
						$tax_gl_code = $quapData[$k]->TAX_GL_CODE;
						$pfctCode    = $quapData[$k]->PFCT_CODE;
						$seriesCode  = $quapData[$k]->SERIES_CODE;
						$gl_name     = $quapData[$k]->GL_NAME;
						$uniqCheck   = $quapData[$k]->TAXIND_CODE;

						$dataQp = array(
							'PBILLHID'    => $head_Id,
							'PBILLBID'    => $body_Id,
							'PBILLTID'    => $tax_Id,
							'TAXIND_CODE' => $uniqCheck,
							'TAXIND_NAME' => $taxind_name,
							'RATE_INDEX'  => $rateindex,
							'TAX_RATE'    => $taxrate,
							'TAX_AMT'     => $taxamt,
							'TAX_LOGIC'   => $taxlogic,
							'TAXGL_CODE'  => $tax_gl_code,
							'STATIC_IND'  => $static 
						);

						DB::table('PBILL_TAX')->insert($dataQp);

					} /* /. for */
					
				} /* main for (item)*/

				if($diffcrdr !=0.00){

					if($createNote == 'Debit Note'){
						$this->CreateDeditNote($netAmount,$seriesGl,$seriesGlName,$accCode,$accountName,$partyBilAmt,$accountGl,$accGlName,$diffcrdr,$compcode,$MaccYear,$transcode,$seriesByTc,$NewVrno,$getdate,$pofitcCode,$partyBilNo,$getPartyBilD,$taxaplyYorN,$createNote,$note_transHead,$seriesAutoNote,$note_vrno,$taxcode_crdr,$userId);
					}else if($createNote == 'Creadit Note'){
						$this->CreateCreditNote($netAmount,$seriesGl,$seriesGlName,$accCode,$accountName,$partyBilAmt,$accountGl,$accGlName,$taxaplyYorN,$notyesORno,$createNote,$tax_indictorName,$taxAmount,$rate_indictorName,$taxglName,$afrate_Name,$note_transHead,$note_vrno,$compcode,$MaccYear,$transcode,$seriesByTc,$NewVrno,$pofitcCode,$partyBilNo,$getPartyBilD,$getdate,$seriesAutoNote,$taxcode_crdr,$userId);
					}
				}else{
					$this->NodiffNoCrDrNote($partyBilAmt,$seriesGl,$seriesGlName,$accCode,$accountName,$accountGl,$accGlName,$compcode,$MaccYear,$transcode,$seriesByTc,$NewVrno,$getdate,$pofitcCode,$partyBilNo,$getPartyBilD,$userId);
				}

				$bodyTblNm = 'PBILL_BODY';
				$apvTblNm  = 'PBILL_APPROVE';
				$bodyCol   = 'PBILLBID';
				$apvCol    = 'PBILLAID';
				$headCol   = 'PBILLHID';
				$pfct_code ='';
				
				$this->approve_Trans($bodyTblNm,$bodyCol,$transcode,$seriesByTc,$apvTblNm,$compcode,$MaccYear,$pfct_code,$transcode,$seriesByTc,$NewVrno,$getdate,$userId,$head_Id,$apvCol,$headCol);


				/*$datavr =array(
					'LAST_NO'=>$vrseqnum
				);
				$updatevr = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->where('COMP_CODE',$compcode)->update($datavr);*/

				$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriesByTc)->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->get()->toArray();

				if(empty($checkvrnoExist)){

					$datavrnIn =array(
						'COMP_CODE'   =>$compcode,
						'FY_CODE'     =>$MaccYear,
						'TRAN_CODE'   =>$transcode,
						'SERIES_CODE' =>$seriesByTc,
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
					DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriesByTc)->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->update($datavrn);
				}

				$datavrAuto =array(
					'LAST_NO'=>$note_vrno
				);
				$updatevr = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$note_transHead)->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->update($datavrAuto);
			DB::commit();
			$response_array['response'] = 'success';

			if($donwloadStatus == 1){
				return $this->GeneratePdfForPurchase($transcode,$headTble,$bodyTble,$headId,$head_Id,$taxTble,$userId,$pdfName,$vrPName);

			}
		    $data = json_encode($response_array);
		    print_r($data);

		} catch (\Exception $e) {
		    DB::rollBack();
		    //throw $e;
		    $response_array['response'] = 'error';
	            $data = json_encode($response_array);
	            print_r($data);
		}

	
	} /* /. ajax*/
				
    } /*-- function close --*/

    public function NodiffNoCrDrNote($partyBilAmt,$seriesGl,$seriesGlName,$accCode,$accountName,$accountGl,$accGlName,$compcode,$MaccYear,$transcode,$seriesByTc,$NewVrno,$getdate,$pofitcCode,$partyBilNo,$getPartyBilD,$userId){

		$data1 = array(
				'IND_CODE'    => '',
				'DR_AMT'      => $partyBilAmt,
				'IND_GL_CODE' => $seriesGl,
				'IND_GL_NAME' => $seriesGlName,
				'REF_ACCCODE' => $accCode,
				'REF_ACCNAME' => $accountName,
				'TCFLAG'      => 'PB',
				'GLACC_Chk'   => '',
				'CREATED_BY'  => $userId,
			
			);
		DB::table('INDICATOR_TEMP')->insert($data1);

		$data2   = array(
				'CR_AMT'       => $partyBilAmt,
				'IND_ACC_CODE' => $accCode,
				'IND_ACC_NAME' => $accountName,
				'IND_GL_CODE'  => $accountGl,
				'IND_GL_NAME'  => $accGlName,
				'REF_ACCCODE'  => $accCode,
				'REF_ACCNAME'  => $accountName,
				'TCFLAG'       => 'PB',
				'GLACC_Chk'    => 'ACC',
				'CREATED_BY'   => $userId,
			);

		DB::table('INDICATOR_TEMP')->insert($data2);

		/* -------- insert in acc /gl tran -------- */

		$indCount = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','PB')->get()->toArray();

		foreach ($indCount as $key) {

			$glledgH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
				$hglLedgID = json_decode(json_encode($glledgH), true); 
			
			if(empty($hglLedgID[0]['GLTRANID'])){
				$h_gl_ledg_Id = 1;
			}else{
				$h_gl_ledg_Id = $hglLedgID[0]['GLTRANID']+1;
			}

			$dataGLlegd = array(
					'GLTRANID'    =>$h_gl_ledg_Id,
					'COMP_CODE'   =>$compcode,
					'FY_CODE'     =>$MaccYear,
					'TRAN_CODE'   =>$transcode,
					'SERIES_CODE' =>$seriesByTc,
					'VRNO'        =>$NewVrno,
					'VRDATE'      =>$getdate,
					'PFCT_CODE'   =>$pofitcCode,
					'GL_CODE'     =>$key->IND_GL_CODE,
					'GL_NAME'     =>$key->IND_GL_NAME,
					'REF_CODE'    =>$key->REF_ACCCODE,
					'REF_NAME'    =>$key->REF_ACCNAME,
					'DRAMT'       =>$key->DR_AMT,
					'CRAMT'       =>$key->CR_AMT,
					'PARTICULAR'  =>'Billno -'.$partyBilNo.', Billdate -'.$getPartyBilD.', BillAmt -'.$partyBilAmt,
					'CREATED_BY'  =>$userId
				);
			DB::table('GL_TRAN')->insert($dataGLlegd);

			if($key->GLACC_Chk =='ACC'){

				$AledgH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
				$hALedgID = json_decode(json_encode($AledgH), true); 
			
				if(empty($hALedgID[0]['ACCTRANID'])){
					$h_acc_ledg_Id = 1;
				}else{
					$h_acc_ledg_Id = $hALedgID[0]['ACCTRANID']+1;
				}

				$datacclegd = array(
					'ACCTRANID'    =>$h_acc_ledg_Id,
					'COMP_CODE'    =>$compcode,
					'FY_CODE'      =>$MaccYear,
					'TRAN_CODE'    =>$transcode,
					'SERIES_CODE'  =>$seriesByTc,
					'VRNO'         =>$NewVrno,
					'VRDATE'       =>$getdate,
					'PFCT_CODE'    =>$pofitcCode,
					'ACC_CODE'     =>$key->IND_ACC_CODE,
					'ACC_NAME'     =>$key->IND_ACC_NAME,
					'REF_CODE'     =>$accountGl,
					'REF_NAME'     =>$accGlName,
					'DRAMT'        =>$key->DR_AMT,
					'CRAMT'        =>$key->CR_AMT,
					'PARTICULAR'   =>'Billno -'.$partyBilNo.', Billdate -'.$getPartyBilD.', BillAmt -'.$partyBilAmt,
					'CREATED_BY'   =>$userId

				);
				DB::table('ACC_TRAN')->insert($datacclegd);


				$getdata = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->where('ACC_CODE', $key->IND_ACC_CODE)->get()->first();

			       $dramnt = $key->DR_AMT;
			       $cramnt = $key->CR_AMT;
				
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

                   $updateData12 = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->where('ACC_CODE', $key->IND_ACC_CODE)->update($dataarqty);

				}else{

					$dataItmBal = array(
						'COMP_CODE' => $compcode,
						'FY_CODE'   => $MaccYear,
						'PFCT_CODE' => $pofitcCode,
						'ACC_CODE'  => $key->IND_ACC_CODE,
						'RDRAMT'    => $dramnt,
						'RCRAMT'    => $cramnt,
					);

					DB::table('MASTER_ACCBAL')->insert($dataItmBal);
				}

			}
		}

		/* -------- insert in acc /gl tran -------- */
	}

	public function CreateCreditNote($netAmount,$seriesGl,$seriesGlName,$accCode,$accountName,$partyBilAmt,$accountGl,$accGlName,$taxaplyYorN,$notyesORno,$createNote,$tax_indictorName,$taxAmount,$rate_indictorName,$taxglName,$afrate_Name,$note_transHead,$note_vrno,$compcode,$MaccYear,$transcode,$seriesByTc,$NewVrno,$pofitcCode,$partyBilNo,$getPartyBilD,$getdate,$seriesAutoNote,$taxcode_crdr,$userId){

		$data1 = array(
					'IND_CODE'    => '',
					'DR_AMT'      => $netAmount,
					'IND_GL_CODE' => $seriesGl,
					'IND_GL_NAME' => $seriesGlName,
					'REF_ACCCODE' => $accCode,
					'REF_ACCNAME' => $accountName,
					'SERIES_CODE' => $seriesByTc,
					'TRANS_CODE'  => $transcode,
					'VRNO'        => $NewVrno,
					'TCFLAG'      => 'PB',
					'GLACC_Chk'   => '',
					'CREATED_BY'  => $userId,

				);
		DB::table('INDICATOR_TEMP')->insert($data1);

		$data2   = array(
						'CR_AMT'       => $partyBilAmt,
						'IND_ACC_CODE' => $accCode,
						'IND_ACC_NAME' => $accountName,
						'IND_GL_CODE'  => $accountGl,
						'IND_GL_NAME'  => $accGlName,
						'REF_ACCCODE'  => $accCode,
						'REF_ACCNAME'  => $accountName,
						'SERIES_CODE'  => $seriesByTc,
						'TRANS_CODE'   => $transcode,
						'VRNO'         => $NewVrno,
						'TCFLAG'       => 'PB',
						'GLACC_Chk'    => 'ACC',
						'CREATED_BY'   => $userId,

					);
		DB::table('INDICATOR_TEMP')->insert($data2);

		if($taxaplyYorN == 'YES' && $notyesORno=='YES'){
			if($createNote == 'Creadit Note'){

				$indc_Count = count($tax_indictorName);
				$taxTotalGet =0;
				$noGl = 0;$totnoGl=0;$basicName;$totalGetAmt=0;
				$getPlusAmt=0;

				$totnoGl =0;$basicName;

				for($r=0;$r<$indc_Count;$r++){

					$basicAmt = $taxAmount[0];
					$basicName = $tax_indictorName[0];

					if($tax_indictorName[$r] == 'Basic'){

					}else{
						if($rate_indictorName[$r] == 'Z'){

						}else{
							if($taxglName[$r] != 'null'){

								if($taxAmount[$r] !=''){
							
									$datacrNote = array(
									'IND_CODE'    =>$tax_indictorName[$r],
									'RATE_INDEX'  =>$rate_indictorName[$r],
									'TAX_RATE'    =>$afrate_Name[$r],
									'CR_AMT'      =>$taxAmount[$r],
									'IND_GL_CODE' =>$taxglName[$r],
									'SERIES_CODE' =>$seriesAutoNote,
									'TRANS_CODE'  =>$note_transHead,
									'REF_ACCCODE' => $accCode,
									'REF_ACCNAME' => $accountName,
									'VRNO'        =>$note_vrno,
									'TCFLAG'      =>'PB',
									'CREATED_BY'  =>$userId
									
									);

									DB::table('INDICATOR_TEMP')->insert($datacrNote);

								}else{
									$getPlusAmt=0;
								}
									
							}else{	

								$noGl += $taxAmount[$r];
								$totnoGl= $noGl + $basicAmt;

							}
						} /* /. if rate indicator is Z or other*/
					} /* /. if indicator is basic or other*/

				} /* /. totl tax row count */

				$cata_crNote = array(
								'IND_CODE'    =>$basicName,
								'RATE_INDEX'  =>'-',
								'TAX_RATE'    =>'---',
								'CR_AMT'      =>$totnoGl,
								'IND_GL_CODE' =>$seriesGl,
								'SERIES_CODE' =>$seriesAutoNote,
								'TRANS_CODE'  =>$note_transHead,
								'REF_ACCCODE' =>$accCode,
								'REF_ACCNAME' =>$accountName,
								'VRNO'        =>$note_vrno,
								'TCFLAG'      =>'PB',
								'CREATED_BY'  =>$userId
								
							);

				DB::table('INDICATOR_TEMP')->insert($cata_crNote);

				/* ----- insert data in credit head tax  ------*/

					$crNoteHead = DB::select("SELECT MAX(CRNOTEHID) as CRNOTEHID FROM CRNOTE_HEAD");
					$crHID = json_decode(json_encode($crNoteHead), true); 

					if(empty($crHID[0]['CRNOTEHID'])){
						$crH_Id = 1;
					}else{
						$crH_Id = $crHID[0]['CRNOTEHID']+1;
					}

					$crheadNote = array(
						'CRNOTEHID'   =>$crH_Id,
						'COMP_CODE'   =>$compcode,
						'FY_CODE'     =>$MaccYear,
						'TRAN_CODE'   =>$note_transHead,
						'SERIES_CODE' =>$seriesAutoNote,
						'VRNO'        =>$note_vrno,
						'VRDATE'      =>$getdate,
						'ACC_CODE'    =>$accCode,
						'TAX_CODE'    =>$taxcode_crdr,
						'CREATED_BY'  =>$userId
						//'diff_amt'    =>$diffcrdr,

					);

					DB::table('CRNOTE_HEAD')->insert($crheadNote);

					$crTaxData = DB::select("SELECT t1.*,t2.GL_CODE,t2.GL_NAME FROM INDICATOR_TEMP t1 
					LEFT JOIN MASTER_GL t2 ON t2.GL_CODE=t1.IND_GL_CODE WHERE t1.CREATED_BY='$userId' AND t1.TCFLAG='PB'");

					foreach($crTaxData as $taxD){

						$PCrtaxH = DB::select("SELECT MAX(CRNOTETID) as CRNOTETID FROM CRNOTE_TAX");
						$taxcrID = json_decode(json_encode($PCrtaxH), true); 
					
						if(empty($taxcrID[0]['CRNOTETID'])){
							$crtax_Id = 1;
						}else{
							$crtax_Id = $taxcrID[0]['CRNOTETID']+1;
						}

						if($taxD->TRANS_CODE == 'M'){
							$cata_crNote = array(
								'CRNOTEHID'   =>$crH_Id,
								'CRNOTETID'   =>$crtax_Id,
								'TAXIND_NAME' =>$taxD->IND_CODE,
								'RATE_INDEX'  =>$taxD->RATE_INDEX,
								'TAX_RATE'    =>$taxD->TAX_RATE,
								'TAX_AMT'     =>$taxD->CR_AMT,
								'TAXGL_CODE'  =>$taxD->IND_GL_CODE,
								'CREATED_BY'  =>$userId

							);

							DB::table('CRNOTE_TAX')->insert($cata_crNote);
						}
					}
				/* ----- insert data in credit head tax  ------*/

			} /* /. check is it credit note*/
		} /*  /. check if tax apply or not */

		/* ---------- insert in acc/ gl tran ----------*/

					$debitData = DB::select("SELECT t1.*,t2.GL_CODE,t2.GL_NAME FROM INDICATOR_TEMP t1 
					LEFT JOIN MASTER_GL t2 ON t2.GL_CODE=t1.IND_GL_CODE WHERE t1.CREATED_BY='$userId' AND t1.TCFLAG='PB'");
					//$noteCount = count($debitData);

					foreach ($debitData as $key) {

						$gledg_H = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
						$gLedg_ID = json_decode(json_encode($gledg_H), true); 
					
						if(empty($gLedg_ID[0]['GLTRANID'])){
							$gheadledg_Id = 1;
						}else{
							$gheadledg_Id = $gLedg_ID[0]['GLTRANID']+1;
						}

						$notedata = array(
							'GLTRANID'    =>$gheadledg_Id,
							'COMP_CODE'   =>$compcode,
							'FY_CODE'     =>$MaccYear,
							'VRDATE'      =>$getdate,
							'TRAN_CODE'   =>$key->TRANS_CODE,
							'SERIES_CODE' =>$key->SERIES_CODE,
							'VRNO'        =>$key->VRNO,
							'GL_CODE'     =>$key->IND_GL_CODE,
							'GL_NAME'     =>$key->GL_NAME,
							'REF_CODE'    =>$key->REF_ACCCODE,
							'REF_NAME'    =>$key->REF_ACCNAME,
							'DRAMT'       =>$key->DR_AMT,
							'CRAMT'       =>$key->CR_AMT,
							'PARTICULAR'  =>'Billno -'.$partyBilNo.', Billdate -'.$getPartyBilD.', BillAmt -'.$partyBilAmt,
							'CREATED_BY'  =>$userId

						);

						DB::table('GL_TRAN')->insert($notedata);
					

						if($key->GLACC_Chk =='ACC'){

							$AledgH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
							$hALedgID = json_decode(json_encode($AledgH), true); 
						
							if(empty($hALedgID[0]['ACCTRANID'])){
								$h_acc_ledg_Id = 1;
							}else{
								$h_acc_ledg_Id = $hALedgID[0]['ACCTRANID']+1;
							}

							$datacclegd = array(
								'ACCTRANID'    =>$h_acc_ledg_Id,
								'COMP_CODE'    =>$compcode,
								'FY_CODE'      =>$MaccYear,
								'TRAN_CODE'    =>$key->TRANS_CODE,
								'SERIES_CODE'  =>$key->SERIES_CODE,
								'VRNO'         =>$key->VRNO,
								'VRDATE'       =>$getdate,
								'ACC_CODE'     =>$key->IND_ACC_CODE,
								'ACC_NAME'     =>$key->IND_ACC_NAME,
								'REF_CODE'     =>$accountGl,
								'REF_NAME'     =>$accGlName,
								'DRAMT'        =>$key->DR_AMT,
								'CRAMT'        =>$key->CR_AMT,
								'PARTICULAR'   =>'Billno -'.$partyBilNo.', Billdate -'.$getPartyBilD.', BillAmt -'.$partyBilAmt,
								'CREATED_BY'   =>$userId

							);
							DB::table('ACC_TRAN')->insert($datacclegd);


							$getdata = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->where('ACC_CODE', $key->IND_ACC_CODE)->get()->first();

					       $dramnt = $key->DR_AMT;
					       $cramnt = $key->CR_AMT;
						
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

		                   $updateData12 = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->where('ACC_CODE', $key->IND_ACC_CODE)->update($dataarqty);

						}else{

							$dataItmBal = array(
								'COMP_CODE' => $compcode,
								'FY_CODE'   => $MaccYear,
								'PFCT_CODE' => $pofitcCode,
								'ACC_CODE'  => $key->IND_ACC_CODE,
								'RDRAMT'    => $dramnt,
								'RCRAMT'    => $cramnt,
							);

							DB::table('MASTER_ACCBAL')->insert($dataItmBal);
						}

					}
		}

				/* ----- insert in acc/gl tran -------- */

	} /* /. main function */

	public function CreateDeditNote($netAmount,$seriesGl,$seriesGlName,$accCode,$accountName,$partyBilAmt,$accountGl,$accGlName,$diffcrdr,$compcode,$MaccYear,$transcode,$seriesByTc,$NewVrno,$getdate,$pofitcCode,$partyBilNo,$getPartyBilD,$taxaplyYorN,$createNote,$note_transHead,$seriesAutoNote,$note_vrno,$taxcode_crdr,$userId){

		/* ------- temporary store data --------- */

			$data1 = array(
					'IND_CODE'    => '',
					'DR_AMT'      => $netAmount,
					'IND_GL_CODE' => $seriesGl,
					'IND_GL_NAME' => $seriesGlName,
					'REF_ACCCODE' => $accCode,
					'REF_ACCNAME' => $accountName,
					'GLACC_Chk'   => '',
					'TCFLAG'      => 'PB',
					'CREATED_BY'  => $userId,
						
				);
			DB::table('INDICATOR_TEMP')->insert($data1);

			$data2   = array(
						'CR_AMT'       => $partyBilAmt,
						'IND_ACC_CODE' => $accCode,
						'IND_ACC_NAME' => $accountName,
						'IND_GL_CODE'  => $accountGl,
						'IND_GL_NAME'  => $accGlName,
						'REF_ACCCODE'  => $accCode,
						'REF_ACCNAME'  => $accountName,
						'GLACC_Chk'    => 'ACC',
						'TCFLAG'       => 'PB',
						'CREATED_BY'   => $userId,
					);
			DB::table('INDICATOR_TEMP')->insert($data2);

			if($taxaplyYorN == 'YES'){
				if($createNote == 'Debit Note'){
					$data3   = array(
								'DR_AMT'       => $diffcrdr,
								'IND_ACC_CODE' => $accCode,
								'IND_GL_CODE'  => $accountGl,
								'IND_GL_NAME'  => $accGlName,
								'GLACC_Chk'   => '',
								'REF_ACCCODE'  => $accCode,
								'REF_ACCNAME'  => $accountName,
								'TCFLAG'       => 'PB',
								'CREATED_BY'   => $userId,
					);
					DB::table('INDICATOR_TEMP')->insert($data3);


					$PDrH = DB::select("SELECT MAX(DRNOTEHID) as DRNOTEHID FROM DRNOTE_HEAD");
						$headDID = json_decode(json_encode($PDrH), true); 
					
					if(empty($headDID[0]['DRNOTEHID'])){
						$headPd_Id = 1;
					}else{
						$headPd_Id = $headDID[0]['DRNOTEHID']+1;
					}

					$dataheadNote = array(
							'DRNOTEHID'   =>$headPd_Id,
							'COMP_CODE'   =>$compcode,
							'FY_CODE'     =>$MaccYear,
							'TRAN_CODE'   =>$note_transHead,
							'SERIES_CODE' =>$seriesAutoNote,
							'VRNO'        =>$note_vrno,
							'VRDATE'      =>$getdate,
							'ACC_CODE'    =>$accCode,
							'TAX_CODE'    =>$taxcode_crdr,
							'DRAMT'       =>$diffcrdr,
							'CREATED_BY'  =>$userId,
							//'diff_amt'    =>$diffcrdr,
						);
					DB::table('DRNOTE_HEAD')->insert($dataheadNote);

				}
			}

		/* ------- temporary store data --------- */

		/* ----- insert account / Gl entry --------- */

			$debitData = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','PB')->get()->toArray();

			foreach ($debitData as $key) {

				/* ----- insert in gl tran -------- */

					$glledgH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
					$hglLedgID = json_decode(json_encode($glledgH), true); 
							
					if(empty($hglLedgID[0]['GLTRANID'])){
						$h_gl_ledg_Id = 1;
					}else{
						$h_gl_ledg_Id = $hglLedgID[0]['GLTRANID']+1;
					}

					$dataGLlegd = array(
						'GLTRANID'    =>$h_gl_ledg_Id,
						'COMP_CODE'   =>$compcode,
						'FY_CODE'     =>$MaccYear,
						'TRAN_CODE'   =>$transcode,
						'SERIES_CODE' =>$seriesByTc,
						'VRNO'        =>$NewVrno,
						'VRDATE'      =>$getdate,
						'PFCT_CODE'   =>$pofitcCode,
						'GL_CODE'     =>$key->IND_GL_CODE,
						'GL_NAME'     =>$key->IND_GL_NAME,
						'REF_CODE'    =>$key->REF_ACCCODE,
						'REF_NAME'    =>$key->REF_ACCNAME,
						'DRAMT'       =>$key->DR_AMT,
						'CRAMT'       =>$key->CR_AMT,
						'PARTICULAR'  =>'Billno -'.$partyBilNo.', Billdate -'.$getPartyBilD.', BillAmt -'.$partyBilAmt,
						'CREATED_BY'  =>$userId

					);
					DB::table('GL_TRAN')->insert($dataGLlegd);

				/* ----- insert in gl tran -------- */

				/* ----- insert in acc tran -------- */

				if($key->GLACC_Chk =='ACC'){

					$AledgH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
					$hALedgID = json_decode(json_encode($AledgH), true); 
				
					if(empty($hALedgID[0]['ACCTRANID'])){
						$h_acc_ledg_Id = 1;
					}else{
						$h_acc_ledg_Id = $hALedgID[0]['ACCTRANID']+1;
					}

					$datacclegd = array(
						'ACCTRANID'    =>$h_acc_ledg_Id,
						'COMP_CODE'    =>$compcode,
						'FY_CODE'      =>$MaccYear,
						'TRAN_CODE'    =>$transcode,
						'SERIES_CODE'  =>$seriesByTc,
						'VRNO'         =>$NewVrno,
						'VRDATE'       =>$getdate,
						'PFCT_CODE'    =>$pofitcCode,
						'ACC_CODE'     =>$key->IND_ACC_CODE,
						'ACC_NAME'     =>$key->IND_ACC_NAME,
						'REF_CODE'     =>$accountGl,
						'REF_NAME'     =>$accGlName,
						'DRAMT'        =>$key->DR_AMT,
						'CRAMT'        =>$key->CR_AMT,
						'PARTICULAR'   =>'Billno -'.$partyBilNo.', Billdate -'.$getPartyBilD.', BillAmt -'.$partyBilAmt,
						'CREATED_BY'   =>$userId

					);
					DB::table('ACC_TRAN')->insert($datacclegd);


				$getdata = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->where('ACC_CODE', $key->IND_ACC_CODE)->get()->first();

			       $dramnt = $key->DR_AMT;
			       $cramnt = $key->CR_AMT;
				
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

                   $updateData12 = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compcode)->where('FY_CODE',$MaccYear)->where('ACC_CODE', $key->IND_ACC_CODE)->update($dataarqty);

				}else{

					$dataItmBal = array(
						'COMP_CODE' => $compcode,
						'FY_CODE'   => $MaccYear,
						'PFCT_CODE' => $pofitcCode,
						'ACC_CODE'  => $key->IND_ACC_CODE,
						'RDRAMT'    => $dramnt,
						'RCRAMT'    => $cramnt,
					);

					DB::table('MASTER_ACCBAL')->insert($dataItmBal);
				}




				}

				/* ----- insert in acc tran -------- */

			}

			/* ----- insert account / Gl entry --------- */

	} /* /. main function */

    public function purchase_bill_msg(Request $request,$saveData){

		if ($saveData == 'false'){

				$request->session()->flash('alert-error', 'Data Can Not Be Save...!');
				return redirect('/Transaction/Purchase/View-Purchase-Bill-Trans');

		} else {

				$request->session()->flash('alert-success', 'Data Was Successfully Save...!');
				return redirect('/Transaction/Purchase/View-Purchase-Bill-Trans');

		}
	}

	function simulationForPurBill(Request $request){

    	if ($request->ajax()) {

				$data_Count   = 9;
				
				$chkcitm           = $request->checkitm;
				$accCode           = $request->accCode;
				$seriesGl          = $request->seriesGl;
				$taxaplyYorN       = $request->taxaplyYorN;
				$tax_indictorName  = $request->tax_indictorName;
				$rate_indictorName = $request->rate_indictorName;
				$afrate_Name       = $request->afrate_Name;
				$taxAmount         = $request->taxAmount;
				$taxglName         = $request->taxglName;
				$createNote        = $request->createNote;
				$partyBilAmt       = $request->partyBilAmt;
				$netAmt            = $request->netAmt;
				$diffCrDr          = $request->diffCrDr;
				$noteName          = $request->noteName;
				$userId            = $request->session()->get('userid');	
				//print_r($tax_indictorName);exit;
				$getcountitm = count($chkcitm);

				$saveData ='';

					
				DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','PBTN')->delete();

			if($diffCrDr != '0.00'){

				if($createNote == 'Creadit Note'){
					$idary1s = array(
						'IND_CODE'    => '',
						'DR_AMT'      => $netAmt,
						'CR_AMT'	  =>'',
						'IND_GL_CODE' => $seriesGl,
						'TCFLAG'      => 'PBTN',
						'CREATED_BY'  => $userId,
					
					);
					DB::table('SIMULATION_TEMP')->insert($idary1s);
				
				}else if($createNote == 'Debit Note'){
					$idary11 = array(
						'IND_CODE'    => '',
						'DR_AMT'      => $netAmt,
						'CR_AMT'	  =>'',
						'IND_GL_CODE' => $seriesGl,
						'TCFLAG'      => 'PBTN',
						'CREATED_BY'  => $userId,
					
					);
					DB::table('SIMULATION_TEMP')->insert($idary11);
				}
			}else{

				$idary1 = array(
					'IND_CODE'    => '',
					'DR_AMT'      => $partyBilAmt,
					'CR_AMT'	  =>'',
					'IND_GL_CODE' => $seriesGl,
					'TCFLAG'      => 'PBTN',
					'CREATED_BY'  => $userId,
				
				);
				DB::table('SIMULATION_TEMP')->insert($idary1);
			}

				$idary = array(
						'IND_CODE'     => '',
						'DR_AMT'       => '',
						'CR_AMT'       => $partyBilAmt,
						'IND_ACC_CODE' => $accCode,
						'TCFLAG'      => 'PBTN',
						'CREATED_BY'   => $userId,
			
					);

				DB::table('SIMULATION_TEMP')->insert($idary);

				if($taxaplyYorN == 'YES'){

					if($createNote == 'Debit Note'){

						$ledgD = array(
							'IND_CODE'     => '',
							'DR_AMT'       => $diffCrDr,
							'CR_AMT'       => '',
							'IND_ACC_CODE' => $accCode,
							'TCFLAG'      => 'PBTN',
							'CREATED_BY'   => $userId,
				
						);

						DB::table('SIMULATION_TEMP')->insert($ledgD);

					}else if($createNote == 'Creadit Note'){

						$indCount = count($tax_indictorName);
						$totnoGl =0;$basicName;$noGl = 0;

					for($r=0;$r<$indCount;$r++){

						if($createNote == 'Creadit Note'){
							$crAmt =$taxAmount[$r];
							$drAmt ='';
						}else{}

						$basicAmt = $taxAmount[0];
						$basicName = $tax_indictorName[0];
							
						if($tax_indictorName[$r] == 'Basic'){
							
						}else{
							if($rate_indictorName[$r] == 'Z'){

							}else{

								if($taxglName[$r] != 'null'){

									if($taxAmount[$r] !=''){

										//$getPlusAmt += $taxAmount[$r];
								
										$datacrdrNote = array(
										'IND_CODE' =>$tax_indictorName[$r],
										'DR_AMT'      =>$drAmt,
										'CR_AMT'      =>$crAmt,
										'IND_GL_CODE'  =>$taxglName[$r],
										'TCFLAG'      => 'PBTN',
										'CREATED_BY'   =>$userId

										);

										DB::table('SIMULATION_TEMP')->insert($datacrdrNote);

									}else{
										$getPlusAmt=0;
									}
									
								}else{	

									$noGl += $taxAmount[$r];
									$totnoGl= $noGl + $basicAmt;

								}

							}
						}

						
					} /*for loop*/

					if($createNote == 'Creadit Note'){
						$crAmtb = $totnoGl;
						$drAmtb = '';

						$datacrdrNote1 = array(
						'IND_CODE'    =>$basicName,
						'DR_AMT'      =>$drAmtb,
						'CR_AMT'      =>$crAmtb,
						'IND_GL_CODE' =>$seriesGl,
						'TCFLAG'      => 'PBTN',
						'CREATED_BY'  =>$userId

						);

						DB::table('SIMULATION_TEMP')->insert($datacrdrNote1);
					}else{}

					


					}

				}



			$response_array = array();
			//$taxData = DB::table('simulatn_temp')->where('created_by', $userId)->get();
			$taxData = DB::select("SELECT t1.*,t2.GL_NAME as glName,t3.ACC_NAME AS accName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE LEFT JOIN MASTER_ACC t3 ON t3.ACC_CODE = t1.IND_ACC_CODE WHERE t1.TCFLAG='PBTN' AND t1.CREATED_BY='$userId'");

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

    public function ViewPurchaseTransaction(Request $request){

     	$compName = $request->session()->get('company_name');

        if($request->ajax()) {
    
            $title ='View Purchase';
    
            $userid    = $request->session()->get('userid');
    
            $userType = $request->session()->get('usertype');
    
            $comp_nameval     = $request->session()->get('company_name');
		    $explode          = explode('-', $comp_nameval);
		    $getcom_code      = $explode[0];
    
            $fisYear =  $request->session()->get('macc_year');
    
    
            if($userType=='admin' || $userType=='Admin'){
    
            	$data = DB::table('PBILL_HEAD')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->orderBy('PBILLHID','DESC');
    
            }else if($userType=='superAdmin' || $userType=='user'){
    
               $data = DB::table('PBILL_HEAD')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->orderBy('PBILLHID','DESC');
    
            }
            else{
    
                $data='';
                
            }
    
        	return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();
    
    
        }

        if(isset($compName)){

       		return view('admin.finance.transaction.purchase.view_purchase_trans');
        }else{
			return redirect('/useractivity');
		}
        
    }

    public function ViewPurchaseTransChildRow(Request $request){

		$response_array = array();

		$vrno   = $request->input('vrno');
	    $headid = $request->input('tblid');
		//print_r($headid);exit;

		if ($request->ajax()) {


	    	
	    
	    	 $ptdata = DB::table('PBILL_BODY')->where('VRNO',$vrno)->where('PBILLHID',$headid)->get();

	  // print_r($indentData);exit;

    		if ($ptdata) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $ptdata;

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

/* -----------------  END : PURCHASE BILL TRANSACTION --------------- */

/* -----------------  START : DIRECT PURCHASE BILL TRANSACTION --------------- */
	
	public function DirectPurchaseBill(Request $request){

		$title       ='Add Direct Purchase Bill';
		
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');
		
		$userdata['getacc']        = $this->master_party;
		$userdata['tax_code_list'] = $this->master_tax;
		$userdata['rate_list']     = $this->master_rateValue;
		$userdata['cost_list']     = $this->master_cost;

		$TranCode = 'P5';

		$functionData = $this->CommonFunction($macc_year,$getcompcode,$TranCode);

		foreach ($functionData['fy_list'] as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$series_list = $functionData['series_list'];
		$userdata['getplant']     = $functionData['plant_list'];
		$userdata['item_list'] = $functionData['item_list'];


		$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','P5')->get();
   		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;
			
		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.purchase.direct_purchase_trans',$userdata+compact('title','series_list'));

	    }else{

			return redirect('/useractivity');
		}

	}

	public function SaveDirectPurchaseBil(Request $request){

		$createdBy        = $request->session()->get('userid');
		$compName         = $request->session()->get('company_name');
		$fisYear          =  $request->session()->get('macc_year');
		
		$comp_nameval     = $request->session()->get('company_name');
		$explode          = explode('-', $comp_nameval);
		$getcom_code      = $explode[0];
		
		$trans_date       = $request->input('trans_date');
		$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
		$donwloadStatus   = $request->input('donwloadStatus');
		$trans_code       = $request->input('trans_code');
		$series_code      = $request->input('series_code');
		$vr_no            = $request->input('vr_no');
		$plant_code       = $request->input('plant_code');
		$pfct_code        = $request->input('pfct_code');
		$accountCode      = $request->input('accountCode');
		$accountName      = $request->input('account_name');
		$tax_code         = $request->input('tax_code');
		$partyRefNo       = $request->input('party_ref_no');
		$partyRefDate     = $request->input('party_ref_date');
		$getpartyRefDate  = date("Y-m-d", strtotime($partyRefDate));
		$rFHeadO          = $request->input('rfhead1');
		$rFHeadT          = $request->input('rfhead2');
		$rFHeadTh         = $request->input('rfhead3');
		$rFHeadF          = $request->input('rfhead4');
		$rFHeadFi         = $request->input('rfhead5');
		
		$itembyPo         = $request->input('itemPo');
		$item_code        = $request->input('item_code');
		$item_count       = $request->input('itemcodeC');
		$countItemCode    = count($item_code);
		$item_name        = $request->input('item_name');
		$remark           = $request->input('remark');
		$batchNo          = $request->input('batchNo');
		$qty              = $request->input('qty');
		$unit_M           = $request->input('unit_M');
		$Aqty             = $request->input('Aqty');
		$add_unit_M       = $request->input('add_unit_M');
		$rate             = $request->input('rate');
		$basic_amt        = $request->input('basic_amt');
		
		$hsn_code         = $request->input('hsn_code');
		$tax_byitem       = $request->input('tax_byitem');
		$grandAmt_cr      = $request->input('TotalGrandAmt');
		
		$itembyQtyOrder   = $request->input('itembyQtyOrder');
		$itembyQtysuply   = $request->input('itembyQtysuply');
		
		$getdatacount     = $request->input('getdatacount');
		//print_r($count_rate_ind);exit();
		$head_tax_ind     = $request->input('head_tax_ind');
		$tax_ind_code     = $request->input('taxIndCode');
		$af_rate          = $request->input('af_rate');
		$amount           = $request->input('amount');
		$logicget         = $request->input('logicget');
		$staticget        = $request->input('staticget');
		$dr_grandAmt      = $request->input('dr_grandAmt');
		$amtByItem        = $request->input('amtByItem');
		
		$data_Count       = $request->input('data_Count');
		
		$tolerence_index  = $request->input('tolerence_index');
		$tolerence_rate   = $request->input('tolerence_rate');
		//print_r($data_Count);
		$rate_ind         = $request->input('rate_ind');
		
		$quaP_count       = $request->input('quaP_count');
		$allquaPcount     = $request->input('allquaPcount');
		$item_code_que    = $request->input('item_code_que');
		$item_category    = $request->input('item_category');
		$iqua_char        = $request->input('iqua_char');
		$iqua_desc        = $request->input('iqua_desc');
		$char_fromvalue   = $request->input('char_fromvalue');
		$char_tovalue     = $request->input('char_tovalue');
		$venQcVal         = $request->input('venQcVal');
		$actualQcVal      = $request->input('actualQcVal');
		$thirdPartyQcVal  = $request->input('thirdPartyQcVal');
		$vendorQcName     = $request->input('vendorQcName');
		$purOrderNo       = $request->input('purOrderNo');
		$tax_gl_code      = $request->input('taxGlCode');
		$crAmtItm         = $request->input('crAmtItm');
		$seriesStockFlag  = $request->input('seriesStockFlag');
		$seriesGlC        = $request->input('seriesGl');
		$itemglCode       = $request->input('itemglCode');
		$orderthead_Id    = $request->input('orderthead_Id');
		$orderbody_id     = $request->input('orderbody_id');
		$grnHead_Id       = $request->input('grnHead_Id');
		$grnBody_Id       = $request->input('grnBody_Id');
		$itemwiseglCode   = $request->input('itmwiseGlCode');
		$accountGl        = $request->input('accountGl');

		//print_r($orderthead_Id);

		DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','DPBT')->delete();

		$PbilnH = DB::select("SELECT MAX(PBILLHID) as PBILLHID FROM PBILL_HEAD");
		$headID = json_decode(json_encode($PbilnH), true); 
	
		if(empty($headID[0]['PBILLHID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['PBILLHID']+1;
		}

		if($vr_no == ''){
			$vrNum = 1;
		}else{
			$vrNum = $vr_no;
		}

		$vrno_Exist = DB::table('PBILL_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

		DB::beginTransaction();

			$headTble = 'PBILL_HEAD';
			$bodyTble = 'PBILL_BODY';
			$taxTble  = 'PBILL_TAX';
			$headId   = 'PBILLHID';
			$pdfName  = 'PURCHASE BILL';
			$vrPName  = 'PBILL NO';

			try {
    			$data = array(

				'PBILLHID'       =>$head_Id,
				'COMP_CODE'      =>$getcom_code,
				'FY_CODE'        =>$fisYear,
				'PFCT_CODE'      =>$pfct_code,
				'PFCT_NAME'      =>$request->input('pfct_name'),
				'TRAN_CODE'      =>$trans_code,
				'SERIES_CODE'    =>$series_code,
				'SERIES_NAME'    =>$request->input('series_name'),
				'VRNO'           =>$NewVrno,
				'VRDATE'         =>$tr_vr_date,
				'PLANT_CODE'     =>$plant_code,
				'PLANT_NAME'     =>$request->input('plant_name'),
				'ACC_CODE'       =>$accountCode,
				'ACC_NAME'       =>$request->input('account_name'),
				'CPCODE'         =>$request->input('consignor_name'),
				'COST_CENTER'    =>$request->input('Cost_Center'),
				'COST_CENTER_NAME'=>$request->input('CostName'),
				'TAX_CODE'       =>$tax_code,
				'CRAMT'          =>$grandAmt_cr,
				'PREFNO'         =>$request->input('party_ref_no'),
				'PREFDATE'       =>$getpartyRefDate,
				'RFHEAD1'        =>$rFHeadO,
				'RFHEAD2'        =>$rFHeadT,
				'RFHEAD3'        =>$rFHeadTh,
				'RFHEAD4'        =>$rFHeadF,
				'RFHEAD5'        =>$rFHeadFi,
				'CREATED_BY'     =>$createdBy,
				//'pur_order_no' =>$purOrderNo,

			);
	    		$saveDataH = DB::table('PBILL_HEAD')->insert($data);
			$data_taxBody = array();
			$data_qpBody  = array();

			/*$discriptn_page = "Direct purchase bill trans insert done by user";

			$this->userLogInsert($createdBy,$trans_code,$series_code,$NewVrno,$discriptn_page,$accountCode);*/

			for ($i=0; $i < $countItemCode ; $i++) { 

				$PGrnB = DB::select("SELECT MAX(PBILLBID) as PBILLBID FROM PBILL_BODY");
				$bodyID = json_decode(json_encode($PGrnB), true); 
			
				if(empty($bodyID[0]['PBILLBID'])){
					$body_Id = 1;
				}else{
					$body_Id = $bodyID[0]['PBILLBID']+1;
				}
			
				$data_body = array(
				
					'PBILLHID'    =>$head_Id,
					'PBILLBID'    =>$body_Id,
					'COMP_CODE'   =>$getcom_code,
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
					'UM'          =>$unit_M[$i],
					'AUM'         =>$add_unit_M[$i],
					'PARTICULAR'  =>$remark[$i],
					'QTYRECD'     =>$qty[$i],
					'AQTYRECD'    =>$Aqty[$i],
					'RATE'        =>$rate[$i],
					'BASICAMT'    =>$basic_amt[$i],
					//'CRAMT'       =>$amtByItem[$i],
					'TAX_CODE'    =>$tax_byitem[$i],
					'HSN_CODE'    =>$hsn_code[$i],
					'CREATED_BY'  =>$createdBy,
				);

				$saveDataB = DB::table('PBILL_BODY')->insert($data_body);

				if($data_Count[$i] == 0){

				}else{

					for ($q=0; $q < $data_Count[$i]; $q++) { 

						$a = array_fill(1, $data_Count[$i], $body_Id);
						$str = implode(',',$a); 
						$last_id = explode(',',$str);

						$data_taxBody[]= $last_id[0];

					}

				}

				if($quaP_count[$i] == 0){

				}else{

					for ($u=0; $u < $quaP_count[$i]; $u++) { 

						$qp = array_fill(1, $quaP_count[$i], $body_Id);
						$strqp = implode(',',$qp); 
						$last_idqp = explode(',',$strqp);

						$data_qpBody[]= $last_idqp[0];

					}

				}
				
			} /*-- for loop close --*/

			$grnInvVar='';

			for ($j=0; $j < $getdatacount; $j++) {

				$st = $j+1;

				$PGrnT = DB::select("SELECT MAX(PBILLTID) as PBILLTID FROM PBILL_TAX");
				$taxID = json_decode(json_encode($PGrnT), true); 
			
				if(empty($taxID[0]['PBILLTID'])){
					$tax_Id = 1;
				}else{
					$tax_Id = $taxID[0]['PBILLTID']+1;
				} 

				
				$data_tax = array(
					'PBILLHID'    => $head_Id,
					'PBILLBID'    => $data_taxBody[$j],
					'PBILLTID'    => $tax_Id,
					'TAXIND_CODE' => $tax_ind_code[$j],
					'TAXIND_NAME' => $head_tax_ind[$j],
					'RATE_INDEX'  => $rate_ind[$j],
					'TAX_LOGIC'   => $logicget[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $amount[$j],
					'TAXGL_CODE'  => $tax_gl_code[$j],
					'STATIC_IND'  => $staticget[$j],
					'CREATED_BY'  => $createdBy,
				);
				
				$saveDataT = DB::table('PBILL_TAX')->insert($data_tax);

				/* ---- START  : ACCOUNT / GL ENTRY --------- */

					$checkExist = DB::table('INDICATOR_TEMP')->where('CREATED_BY',$createdBy)->where('TCFLAG','DPBT')->get()->toArray();

					$indData = DB::table('INDICATOR_TEMP')->where('IND_GL_CODE',$tax_gl_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','DPBT')->get()->toArray();

					if($amount[$j] != 0.00){
						if($rate_ind[$j] == 'Z'){}else{
							if(empty($checkExist)){

								$idary = array(
									'IND_CODE'    => $tax_ind_code[$j],
									'DR_AMT'      => $amount[$j],
									'IND_GL_CODE' => $itemwiseglCode[0],
									'REF_ACCCODE' => $accountCode,
									'REF_ACCNAME' => $accountName,
									'CREATED_BY'  => $createdBy,
									'TCFLAG'      => 'DPBT',
								);
								DB::table('INDICATOR_TEMP')->insert($idary);

							}else  if($tax_gl_code[$j] == ''){

								$bscVal = DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$createdBy)->where('TCFLAG','DPBT')->get()->toArray();
								$updateId = $bscVal[0]->CREATED_BY;
								$basicAmt = $bscVal[0]->DR_AMT + $amount[$j];
							
								$idary_bsic = array(
									'DR_AMT' 	  => $basicAmt,
								);

								DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$updateId)->where('TCFLAG','DPBT')->update($idary_bsic);

							}else if(empty($indData)){

									$idary   = array(
										'IND_CODE'    => $tax_ind_code[$j],
										'DR_AMT'      => $amount[$j],
										'IND_GL_CODE' => $tax_gl_code[$j],
										'REF_ACCCODE' => $accountCode,
										'REF_ACCNAME' => $accountName,
										'CREATED_BY'  => $createdBy,
										'TCFLAG'      => 'DPBT',
										
									);
									DB::table('INDICATOR_TEMP')->insert($idary);
							}else{

									$indData1 = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','DPBT')->get()->first();

									$newTaxAmt = $indData1->DR_AMT + $amount[$j];

									$idary1 = array(
										'DR_AMT' 	  => $newTaxAmt,
									);

									$updatevr = DB::table('INDICATOR_TEMP')->where('IND_CODE',$tax_ind_code[$j])->where('CREATED_BY',$createdBy)->where('TCFLAG','DPBT')->update($idary1);

							}
						}/* /. RATE INDEX CHECK*/

					}/* /. CHECK AMOUNT IS BLANK*/

				/* ---- END  : ACCOUNT / GL ENTRY --------- */
			
			} /*-- for loop close --*/
			
			$accData =  array(
						'IND_CODE'     => '',
						'CR_AMT'       => $grandAmt_cr,
						'IND_GL_CODE'  => $accountGl,
						'IND_ACC_CODE' => $accountCode,
						'IND_ACC_NAME' => $accountName,
						'REF_ACCCODE'  => $accountCode,
						'REF_ACCNAME'  => $accountName,
						'GLACC_Chk'    => 'ACC',
						'TCFLAG'       => 'DPBT',
						'CREATED_BY'   => $createdBy,
			);
			DB::table('INDICATOR_TEMP')->insert($accData);

			/* -------- INSERT ENTRY IN ACC/GL ------- */

				$ledgCount = DB::table('INDICATOR_TEMP')
						->select('INDICATOR_TEMP.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')
		           		->leftjoin('MASTER_GL', 'INDICATOR_TEMP.IND_GL_CODE', '=', 'MASTER_GL.GL_CODE')
		            	->where('INDICATOR_TEMP.TCFLAG','DPBT')
		            	->where('INDICATOR_TEMP.CREATED_BY',$createdBy)
		            	->get()->toArray();

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
								'REF_CODE'     =>$accountGl,
								'REF_NAME'     =>'',
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

					} /* /.ACC*/

		    }

			/* -------- INSERT ENTRY IN ACC/GL ------- */

			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('FY_CODE',$fisYear)->where('COMP_CODE',$getcom_code)->get()->toArray();

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
				DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->update($datavrn);
			}
			
			DB::commit();
			$response_array['response'] = 'success';


			if($donwloadStatus == 1){
				return $this->GeneratePdfForPurchase($trans_code,$headTble,$bodyTble,$headId,$head_Id,$taxTble,$createdBy,$pdfName,$vrPName);

			}
		        $data = json_encode($response_array);
		        print_r($data);
		} catch (\Exception $e) {
		    DB::rollBack();
		    //throw $e;
		    $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
		}

    } /*-- function close --*/

/* -----------------  END : DIRECT PURCHASE BILL TRANSACTION --------------- */

		/* -------- simulation for direct purchase bill ----------- */
  
  	function simulationForDirectPB(Request $request){

      $itmeCode       = $request->itmeCode;
      $itemCount      = count($itmeCode);
      $taxIndCode     = $request->taxIndCode;
      $taxRowC_byItem = $request->taxRowC_byItem;
      $taxAmount      = $request->taxAmount;
      $rateIndex      = $request->rateIndex;
      $taxGl          = $request->taxGl;
      $seriesGl       = $request->seriesGl;
      $totalTaxRC     = $request->totalTaxRC;
      $glByItem       = $request->glByItem;
      $grAmtByItm     = $request->grAmtByItm;
      $itmWiseGl      = $request->itmWiseGl;
      $netAmount      = $request->netAmount;
      $acc_glcd       = $request->acc_glcd;
      $userId         = $request->session()->get('userid'); 

      DB::table('SIMULATION_TEMP')->where('TCFLAG','DPBT')->where('CREATED_BY',$userId)->delete();

        for ($j=0; $j <$totalTaxRC; $j++) { 

          $FirstDataExist = DB::table('SIMULATION_TEMP')->where('TCFLAG','DPBT')->where('CREATED_BY',$userId)->get()->toArray();

          $existGlData = DB::table('SIMULATION_TEMP')->where('IND_GL_CODE',$taxGl[$j])->where('CREATED_BY',$userId)->where('TCFLAG','DPBT')->get()->toArray();

          $idName = 'SERIES'.$j;
          if($taxAmount[$j] != '' && $taxAmount[$j] !=0.00){

          	if($rateIndex[$j] == 'Z'){

            }else{

            	if(empty($FirstDataExist)){
							
								$idary = array(
									'IND_CODE'    => $taxIndCode[$j],
									'IND_NAME'    => $idName,
									'DR_AMT'      => $taxAmount[$j],
									'CR_AMT'      => '',
									'IND_GL_CODE' => $taxGl[$j],
									'TCFLAG'      => 'DPBT',
									'CODE_NAME'   => 'Series Gl',
									'CREATED_BY'  => $userId,
								
								);
								DB::table('SIMULATION_TEMP')->insert($idary);

							}else if($taxGl[$j] == ''){

								$bscVal = DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$userId)->where('TCFLAG','DPBT')->get()->toArray();

									$updateId = $bscVal[0]->CREATED_BY;
									$basicAmt = $bscVal[0]->DR_AMT + $taxAmount[$j];
								
									$idary_bsic = array(
										'CR_AMT' 	  =>'',
										'DR_AMT'	  =>$basicAmt,
									);

								 DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('TCFLAG','DPBT')->where('CREATED_BY',$updateId)->update($idary_bsic);

							}else if(empty($existGlData)){

								$idary   = array(
									'IND_CODE'    => $taxIndCode[$j],
									'DR_AMT'      => $taxAmount[$j],
									'CR_AMT'      => '',
									'IND_GL_CODE' => $taxGl[$j],
									'CODE_NAME'   => 'Tax Gl',
									'TCFLAG'      => 'DPBT',
									'CREATED_BY'  => $userId,
									
								);

								DB::table('SIMULATION_TEMP')->insert($idary);

							}else{
								$indData1 = DB::table('SIMULATION_TEMP')->where('IND_GL_CODE',$taxGl[$j])->where('TCFLAG','DPBT')->where('CREATED_BY',$userId)->get()->first();

								$newTaxAmt = $indData1->DR_AMT + $taxAmount[$j];

								$idary1 = array(
									'DR_AMT' =>$newTaxAmt,
									'CR_AMT' => '',
								);

								$updatevr = DB::table('SIMULATION_TEMP')->where('IND_GL_CODE',$taxGl[$j])->where('TCFLAG','DPBT')->where('CREATED_BY',$userId)->update($idary1);
							}

            }/* /. CHECK RATE INDEX IS Z*/

          }/* /. CHECK TAX AMOUNT IS BLANK*/

        } /* /. TAX FOR LOOP*/

        $accData = array(

					'IND_CODE'     =>'',
					'CR_AMT'       =>$netAmount,
					'DR_AMT'       =>'',
					'IND_GL_CODE'  =>$acc_glcd,
					'TCFLAG'       =>'DPBT',
					'CODE_NAME'    => 'Acc Gl',
					'CREATED_BY'   =>$userId,
				);

				DB::table('SIMULATION_TEMP')->insert($accData);

      $response_array = array();
          $taxData = DB::select("SELECT t1.*,t2.GL_NAME as glName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE WHERE t1.TCFLAG='DPBT' AND t1.CREATED_BY='$userId'");

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

  	}

/* -------- simulation for direct purchase bill ----------- */

	public function Get_Pur_Bill_Item_UM_AUM(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			$itemCode = $request->input('ItemCode');
			$accCode  = $request->input('accCode');
			$taxCode  = $request->input('taxCode');
			$qcount   = $request->input('q');

	    	$item_um_aum_list = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemCode)->get();

	    	$fetch_hsn_code = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();

		$fetch_pur_bill_item = DB::table('PBILL_BODY')->where('ITEM_CODE',$itemCode)->where('TAX_CODE',$taxCode)->get()->first();


	    	//print_r($fetch_pur_bill_item);
	    	//DB::enableQueryLog();
	    	//$aum_list = DB::table('master_itemum_finance')->where('item_code', $itemCode)->where('um_code',$fetch_hsn_code->um)->get();
			//dd(DB::getQueryLog());
			
	    	//DB::enableQueryLog();
			$aum_list = DB::table('MASTER_ITEMUM')
				->select('MASTER_ITEMUM.*', 'MASTER_UM.*')
           		->leftjoin('MASTER_UM', 'MASTER_ITEMUM.UM_CODE', '=', 'MASTER_UM.UM_CODE')
            	->where('MASTER_ITEMUM.ITEM_CODE',$itemCode)
            	->where('MASTER_ITEMUM.UM_CODE',$fetch_hsn_code->UM)
            	->get();
            //dd(DB::getQueryLog());

	    	$quaPamter_get = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$fetch_hsn_code->ICATG_CODE)->get()->toArray();

	    	if($quaPamter_get){
	    		$qua_parameter_data  = $quaPamter_get;
	    	}else{
	    		$qua_parameter_data  = '';
	    	}

	    	if($fetch_hsn_code->HSN_CODE && $taxCode){

	    		$fetch_tax_code = DB::table('MASTER_HSNRATE')->where('HSN_CODE',$fetch_hsn_code->HSN_CODE)->where('TAX_CODE',$taxCode)->get();

	    	}else if($fetch_hsn_code->HSN_CODE && $taxCode==''){

	    		$fetch_tax_code = DB::table('MASTER_HSNRATE')->where('HSN_CODE',$fetch_hsn_code->HSN_CODE)->get();
	    	}

    		if ($item_um_aum_list && $aum_list && $fetch_hsn_code || $qua_parameter_data) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_um_aum_list;
	            $response_array['data_hsn'] = $fetch_hsn_code;
	            $response_array['data_pur_bill'] =$fetch_pur_bill_item;
	            $response_array['qcount'] = $qcount;
	            $response_array['qua_pamter'] = $qua_parameter_data;
	            $response_array['aumList'] = $aum_list;
	            $response_array['data_tax'] = $fetch_tax_code;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['qua_pamter'] ='';
                $response_array['aumList'] ='';
                $response_array['data_tax'] ='';

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['qua_pamter'] ='';
                $response_array['aumList'] ='';
                $response_array['data_tax'] ='';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function PurchaseTransInvoce(Request $request,$saveData,$headid,$bodyid){

     	$id =base64_decode($headid);
	    $bodyid =base64_decode($bodyid);

	  	$purchase_bill_data['company'] = DB::table('master_comp')->get()->first();
 		$comp_name = $request->session()->get('company_name');

 		$comp_code = explode('-', $comp_name);


 		$companys = DB::table('master_comp')->get()->first();

	 	//print_r($comp_code[0]);exit;
	 	//$accCode ='CAB03';

	 	$purchase_bill_data['comp_details'] = DB::table('master_comp')
				->select('master_comp.*', 'master_plant.*')
           		->leftjoin('master_plant', 'master_plant.company_code', '=', 'master_comp.comp_code')
           		->where('master_comp.comp_code',$comp_code[0])
           		->get();

  

 		$purchase_bill_data['purchase_bill'] = DB::table('purchase_head')
				->select('purchase_head.*', 'master_party.*','purchase_head.id as headid')
           		->leftjoin('master_party', 'master_party.acc_code', '=', 'purchase_head.acc_code')
           		->where('purchase_head.id',$id)
           		->get();



   		$purchase_bill_data['purchase_bill_body'] = DB::table('purchase_body')->where('purchase_body.purchase_head_id',$id)->get()->toArray();

    	$sum =0;
    	foreach($purchase_bill_data['purchase_bill_body'] as $key) {
    		$sum += $key->basic_amt;
    	}

    	//return convert_number_to_words($sum);

    	return $this->convert_number_to_words($sum,$purchase_bill_data);
    	
     }

    function convert_number_to_words($num,$purchase_bill_data){

		$response_array = array();

 		//$num   = $request->input('amt');
 	

    	$num = str_replace(array(',', ' '), '' , trim($num));

	    //print_r($num);exit;
	    if(! $num) {
	        return false;
	    }
	    $num = (int) $num;
    	$words = array();
	    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
	        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
	    );
	    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
	    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
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
	    return view('admin.finance.transaction.purchasebillpdf',$purchase_bill_data+compact('numwords'));

	}

	public function acc_code_for_contra(Request $request){

		$response_array = array();

	    $accountcode = $request->input('accountcode');

		if ($request->ajax()) {

	    	//DB::enableQueryLog();
		$acc_code_list = DB::table('contra_view')->where([['gl_code','=',$accountcode]])
            	->get();
    	 //dd(DB::getQueryLog());

	    	
    		if ($acc_code_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $acc_code_list ;

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

    public function getSeriesData(Request $request){

		$response_array = array();

	    $seriesCode = $request->input('seriesCode');

		if ($request->ajax()) {

	    	//DB::enableQueryLog();
		$series_list = DB::table('master_config')->where([['series_code','=',$seriesCode]])->get();
    	 //dd(DB::getQueryLog());

	    	
    		if ($series_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $series_list ;

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

    public function GetGrnDetailsByGRnVrno(Request $request){

		$response_array = array();

	    $grn_vrno = $request->input('grnVrno');
	    $splitGrn = explode(' ', $grn_vrno);
	    //print_r($splitGrn);
	    $grnVrno = $splitGrn[2];

		if ($request->ajax()) {

	    	//DB::enableQueryLog();
		$grnno_list = DB::table('GRN_HEAD')->where([['VRNO','=',$grnVrno]])
            	->get();
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

    public function ItmByAccountCodePurchas(Request $request){

		$response_array = array();

	    $accCode = $request->input('accCode');

		if ($request->ajax()) {

	    	//DB::enableQueryLog();
		$item_code_list = DB::table('purchase_order_head')
				->select('purchase_order_head.*', 'purchase_order_body.*','master_item_finance.*')
           		->leftjoin('purchase_order_body', 'purchase_order_head.id', '=', 'purchase_order_body.purchase_order_head_id')
           		->leftjoin('master_item_finance', 'purchase_order_body.item_code', '=', 'master_item_finance.item_code')
            	->where([['purchase_order_head.acc_code','=',$accCode]])
            	->get();
    	// dd(DB::getQueryLog());

	    	
    		if ($item_code_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_code_list ;

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

    public function ItmByAccountCodePurchas_withoutdt(Request $request){

        if ($request->ajax()) {

            if (!empty($request->accCode )) {

                $accCode  = $request->accCode;
                
                $strWhere='';
                

                if(isset($accCode)  && trim($accCode)!="")
                {
                 $strWhere .= "AND purchase_order_head.acc_code='$accCode'";
                }
               
                //DB::enableQueryLog();
                $data0 = DB::select("SELECT `purchase_order_head`.*, `purchase_order_body`.*, `master_item_finance`.* FROM `purchase_order_head` left join `purchase_order_body` on `purchase_order_head`.`id` = `purchase_order_body`.`purchase_order_head_id` left join `master_item_finance` on `purchase_order_body`.`item_code` = `master_item_finance`.`item_code`where 1=1 $strWhere ");
                //dd(DB::getQueryLog());

                $data01 = json_decode(json_encode($data0), true); 

               return DataTables()->of($data01)->addIndexColumn()->make(true);
                                
            }else{

                $data = array();

                return DataTables()->of($data)->addIndexColumn()->make(true);
            }

        }

    }


    public function GetQtyByitemPurchase(Request $request){

		$response_array = array();

	    $itemGet = $request->input('itemGet');
	    //print_r($itemGet);exit();
	    
		if ($request->ajax()) {

	    	//DB::enableQueryLog();
		// /$item_code_list = DB::select("SELECT *,(SELECT quantity as qty FROM sales_body WHERE sales_body.sales_order_head_id =sales_head.id AND item_code='$itemGet') FROM `sales_head`");

		$item_code_list = DB::select("SELECT *,(SELECT id FROM `purchase_head` WHERE purchase_head.id=purchase_body.purchase_head_id) FROM `purchase_body` WHERE item_code='$itemGet'");

		/*$data = DB::table('sales_body')
				->select('sales_body.*', 'sales_head.id')
           		->leftjoin('sales_body', 'sales_head.id', '=', 'sales_body.sales_order_head_id')
            	->where([['sales_body.item_code','=',$itemGet]])
            	->get();*/
    	 //dd(DB::getQueryLog());

	    	
    		if ($item_code_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_code_list ;

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

/* ------------ START : MULTIPLE PURCHASE BILL ------------ */

	public function MultiplePurchaseTransaction(Request $request){

		$title      ='Add Multiple Purchase Transaction';

		$CompanyCode   = $request->session()->get('company_name');
		$compcode = explode('-', $CompanyCode);
		$getcompcode=	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$userdata['getacc'] = DB::table('master_party')->get();
		//DB::enableQueryLog();
		$userdata['series_list'] = DB::table('master_config')->where(['tran_code'=>'P5'])->get();

		$userdata['rate_list']      = DB::table('rate_value')->get();
		//dd(DB::getQueryLog());

		$getdate = DB::table('master_fy')->where(['comp_code'=>$getcompcode,'fy_code'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->fy_from_date;
					$userdata['toDate']   =  $key->fy_to_date;
					}


		$cashtrans = DB::table('purchase_head')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->get();

		   	$vrseqnum = '';
			foreach ($cashtrans as $key) {
				$vrseqnum =  $key->vr_no;
			}
			$userdata['vrNumber'] =$vrseqnum;
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `master_vrseq` WHERE comp_name='$CompanyCode' AND fiscal_year='$macc_year' AND tran_code='P5'");
		//dd(DB::getQueryLog());
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

		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.multiple_purchase_trans',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}
	}


	public function GetPurOrdrNoByAccInMulPurBill(Request $request){

		$response_array = array();

	    $accountcode = $request->input('accCode');

		if ($request->ajax()) {

	    	//DB::enableQueryLog();
		$grnno_list = DB::table('purchase_order_head')->where([['acc_code','=',$accountcode]])
            	->get();
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

    public function GetDataFrmPurOrdrForMultPurBill(Request $request){


    	if ($request->ajax()) {

    		if (!empty($request->account_code || $request->purOrderNo)) {
		    	
				$account_code = $request->account_code;
				$purOrderNo   = $request->purOrderNo;

				$strWhere='';

				if(isset($account_code)  && trim($account_code)!="")
                {
                 	$strWhere .= "AND purchase_order_head.acc_code='$account_code'";
                }

                 if(isset($purOrderNo)  && trim($purOrderNo)!="")
                {
                    $strWhere .= "AND purchase_order_head.vr_no='$purOrderNo'";
                }


               // DB::enableQueryLog();
                $data = DB::select("SELECT purchase_order_head.*, purchase_order_body.*, purchase_order_body.id as purordrbodyid FROM purchase_order_head LEFT JOIN purchase_order_body ON purchase_order_head.id = purchase_order_body.purchase_order_head_id WHERE 1=1 $strWhere");
               // dd(DB::getQueryLog());
				//DB::enableQueryLog();
				/*$data =  DB::table('purchase_order_head')->select('purchase_order_head.*','purchase_order_body.*','purchase_order_body.id as purordrbodyid')
           		->leftjoin('purchase_order_body', 'purchase_order_head.id', '=', 'purchase_order_body.purchase_order_head_id')
            	->where([['purchase_order_head.vr_no','=',$purOrderNo],['purchase_order_head.acc_code','=',$account_code]])
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

    public function SaveMultiPurchaseTrans(Request $request){

    	$CompanyCode = $request->session()->get('company_name');
		$MaccYear    = $request->session()->get('macc_year');
		$userId      = $request->session()->get('userid');

			if ($request->ajax()) {

				$chkcitm     = $request->checkitm;
				$accCode     = $request->accCode;
				$prordrVrno  = $request->prOrdrvrno;
				$accountName = $request->accountName;
				$transCode   = $request->transCode;
				$vrseq       = $request->vrseq;
				$transDate   = $request->transDate;
				$getdate     = date("Y-m-d", strtotime($transDate));

				$getcountitm = count($chkcitm);

				$saveData ='';

				$dataArray  = array(

					'tran_code' => $transCode,
					'vr_no'     => $vrseq,
					'vr_date'   => $getdate,
					'acc_code'  => $accCode,

				);

				DB::table('multi_purchase_head')->insert($dataArray);

				for ($i=0; $i < $getcountitm ; $i++) {

					$getcheckdata = $chkcitm[$i];

					$explodedata = explode('/', $getcheckdata);

					$headid = $explodedata[0];
					$bodyid = $explodedata[1];
					$itmcode = $explodedata[2];


					$data = DB::table('purchase_order_body')->where('purchase_order_head_id',$headid)->where('id',$bodyid)->where('item_code',$itmcode)->get();

					foreach ($data as $row) {
						
							$itmCode    =  $row->item_code;
							$quantity   =  $row->quantity;
							$Aquantity  =  $row->Aquantity;
							$rate       =  $row->rate;
							$basic_amt  =  $row->basic_amt;
							
							$dataArray  = array(

								'item_code' => $itmCode,
								'quantity'  => $quantity,
								'Aquantity' => $Aquantity,
								'rate'      => $rate,
								'basic_amt' => $basic_amt,

							);

						$saveData = DB::table('multi_purchase_body')->insert($dataArray);
					}

					$quapData = DB::select("SELECT t1.*,t2.*,t3.* FROM purchase_order_tax t3 LEFT JOIN purchase_order_body t2 ON t2.id = t3.purchase_order_body_id LEFT JOIN purchase_order_head t1 ON t1.id = t3.purchase_order_head_id WHERE t2.item_code='$itmCode' AND t3.purchase_order_head_id='$headid' AND t3.purchase_order_body_id='$bodyid'");
					foreach ($quapData as $rowqp) {
						$taxind_name = $rowqp->tax_ind_name;
						$rateindex   = $rowqp->rate_index;
						$taxrate     = $rowqp->tax_rate;
						$taxamt      = $rowqp->tax_amt;
						$taxlogic    = $rowqp->tax_logic;
						$static      = $rowqp->static;

						$dataQp = array(
							'tax_ind_name' => $taxind_name,
							'rate_index'   => $rateindex,
							'tax_rate'     => $taxrate,
							'tax_amt'      => $taxamt,
							'tax_logic'    => $taxlogic,
							'static'       => $static 
						);

						DB::table('multi_purchase_tax')->insert($dataQp);
					}
				}

				$data1 = array();

		  			if ($saveData) {

		  				$data1['message'] = 'Success';
		  				$getalldata = json_encode($data1);  
		  				print_r($getalldata);

					} else {

						$data1['message'] = 'Error';
		  				$getalldata = json_encode($data1);  
		  				print_r($getalldata);

					}


			}
				
    } /*-- function close --*/

    public function AfieldCalCForMulPurBill(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tax_code     = $request->input('tax_code');
			$ItemCode     = $request->input('itemCode');
			$poHeadId = $request->input('poHeadId');
			$poBodyId = $request->input('poBodyId');
			$CompanyCode  = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$userid       = $request->session()->get('userid');
			//DB::enableQueryLog();
	    	if($ItemCode && $poHeadId && $poBodyId){

	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM purchase_order_tax t3 LEFT JOIN purchase_order_body t2 ON t2.id = t3.purchase_order_body_id LEFT JOIN purchase_order_head t1 ON t1.id = t3.purchase_order_head_id WHERE t1.tax_code='$tax_code' AND t2.item_code='$ItemCode' AND t3.purchase_order_head_id='$poHeadId' AND t3.purchase_order_body_id='$poBodyId'");

	    	}else{

	    		$transcode_list = '';
	    	}
            

             $ratevalue = DB::table('rate_value')->get();

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

/* ------------ END : MULTIPLE PURCHASE BILL ------------ */

    public function GetQualityParameterUpdate(Request $request){

        $response_array = array();

        $itemcode = $request->input('item_code');
        //print_r($itemcode);exit();
        
        if ($request->ajax()) {
       
        $itemcode_get1 = DB::table('master_item_finance')->where('item_code',$itemcode)->get()->first();
        //print_r($itemcode_get);exit;

       	$itemcode_get = DB::table('purchase_indent_qua')->where('item_code',$itemcode)->get()->toArray();
       //	print_r($itemcode_get);exit;
           
            if ($itemcode_get) {

                $response_array['response'] = 'success';
                $response_array['data'] = $itemcode_get ;
                $response_array['item_code'] = $itemcode ;


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

    public function GetPurchaseIndentForApp(Request $request){

    	$response_array = array();

        if ($request->ajax()) {

			$tran_code   = $request->input('tran_code');
			$series_code = $request->input('series_code');
			$slno        = $request->input('slno');
			$vr_no       = $request->input('vr_no');
			$approve_ind = $request->input('approve_ind');
          //  print_r($series_code);exit;
        
            $fetch_reocrd = DB::SELECT("SELECT p1.* FROM PINDENT_BODY p1  WHERE p1.TRAN_CODE='$tran_code' AND p1.VRNO='$vr_no' AND p1.SLNO='$slno' GROUP BY p1.SLNO");

        	//print_r($fetch_reocrd);exit;

            /*$fetch_reocrd = DB::SELECT("SELECT p1.*,p2.* FROM purchase_order_head p1  LEFT JOIN purchase_order_body p2 ON p2.purchase_order_head_id = p1.id WHERE p1.tran_code='$tran_code' AND p1.series_code='$series_code' AND p1.vr_no='$vr_no'");*/

          // print_r($fetch_reocrd);exit;
            //dd(DB::getQueryLog());
        
            if ($fetch_reocrd!='') {

               

                $response_array['response'] = 'success';
                $response_array['data'] = $fetch_reocrd ;
                $response_array['approve_ind'] = $approve_ind ;

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


    function RejectPurchaseIndent(Request $request){

    	$userid    = $request->session()->get('userid');


    	//print_r($userid);exit;

			$approval_remark = $request->input('approve_remark_indent');
			$vr_no           = $request->input('vr_no');
			$tran_code       = $request->input('tran_code');
			$sl_no           = $request->input('sl_no');
			$approve_ind     = $request->input('approve_ind');


			//print_r($approve_ind);exit;

			$data1=array(
    			'APPROVE_REMARK'=>$approval_remark,
    			'FLAG'=>'2',

    		);

	    	$Updatedata = DB::table('PINDENT_BODY')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);


	    	$data12=array(
	    			'REJECTED_STATUS'=>1,
	    			'APPROVE_STATUS'=>2,

	    		);

	    	$Updatedata12 = DB::table('PINDENT_APPROVE')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data12);

	    		

	    	$DeleteData = DB::table('PINDENT_APPROVE')->where('APPROVE_IND',$approve_ind)->where('VRNO',$vr_no)->where('APPROVE_USER',$userid)->where('SLNO',$sl_no)->delete();

			
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


	public function StatusPurchaseIndent(Request $request){

		$userId         = $request->session()->get('userid');
		$tran_code      = $request->input('tran_code');
		$series_code    = $request->input('series_code');
		$vr_no          = $request->input('vr_no');
		$sl_no          = $request->input('sl_no');
		$approve_remark = $request->input('approve_remark_indent');
		



        if ($userId!='') {

        		 //DB::enableQueryLog();
        	$getlevleno = DB::table('PINDENT_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->get()->first();

        	//dd(DB::getQueryLog());

        	 $levno = $getlevleno->LEVEL_NO;
        	// print_r($getlevleno);exit;

        	 $levelNo =  $levno + 1;

        	 $data1=array(
    			'APPROVE_STATUS'=>'3'
    		);

        	// DB::enableQueryLog();

			$UpdateLevel = DB::table('PINDENT_APPROVE')->where('LEVEL_NO', $levelNo)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);

			//dd(DB::getQueryLog());

    		$data=array(
    			'APPROVE_STATUS'=>'1',
    			'APPROVE_REMARK'=>$approve_remark,
    			'FLAG'=>'1',

    		);


			$Updatedata = DB::table('PINDENT_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data);


			$selectdata = DB::table('PINDENT_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->where('LASTUSER','3')->where('APPROVE_STATUS','1')->get()->first();


			if ($selectdata) {

				$data1=array(
	    			'APPROVE_REMARK'=>$approve_remark,
	    			'FLAG'=>'1',

	    		);

	    		$Updatedata1 = DB::table('PINDENT_BODY')->where('TRAN_CODE',$selectdata->TRAN_CODE)->where('VRNO',$selectdata->VRNO)->where('SLNO',$selectdata->SLNO)->update($data1);

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

	public function taxStateByItem(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$taxCode = $request->input('taxCode');
	    	$enquiryNo = $request->input('enquiryNo');
	    	$Quotn_compare_no = $request->input('Quotn_compare_no');
	    	$account_code = $request->input('account_code');
	    	//DB::enableQueryLog();
            	if($enquiryNo){
            		/*$getitem = DB::select("SELECT t1.*,t2.* FROM PENQ_VENDOR t2 LEFT JOIN PENQ_BODY t1 ON t1.PENQHID = t2.PENQHID AND t1.PENQBID=t2.PENQBID WHERE t1.VRNO='$enquiryNo' AND t2.ACC_CODE='$account_code' AND t2.VRNO='$enquiryNo' AND t1.quatation_tcode IS NULL AND t1.quatation_series_code IS NULL AND t1.quatation_vrno IS NULL AND t1.quatation_date IS NULL AND t2.quo_no IS NULL AND t2.quo_slno IS NULL AND quo_flag='0'");*/

            		$getitem = DB::select("SELECT t1.*,t2.* FROM PENQ_VENDOR t2 LEFT JOIN PENQ_BODY t1 ON t1.PENQHID = t2.PENQHID AND t1.PENQBID=t2.PENQBID WHERE t1.VRNO='$enquiryNo' AND t2.ACC_CODE='$account_code' AND t2.VRNO='$enquiryNo' AND PQTN_FLAG='0'");
            	}else if($Quotn_compare_no){

            		$getitem = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PQCS_BODY t1 LEFT JOIN MASTER_ACC t2 ON t2.ACC_CODE = t1.ACC_CODE LEFT JOIN PQCS_HEAD t3 ON t3.PQCSHID = t1.PQCSHID WHERE t3.PQCSHID='$Quotn_compare_no' AND t1.ACC_CODE ='$account_code' AND t1.PCNTRHID='0' AND t1.PCNTRBID='0'  GROUP BY t1.ACC_CODE ");
            	}else{
            		//DB::enableQueryLog();
            		$getitem =	DB::SELECT("SELECT t1.*,t2.* FROM MASTER_HSNRATE t1  LEFT JOIN MASTER_ITEM t2 ON t2.HSN_CODE = t1.HSN_CODE WHERE t1.TAX_CODE='$taxCode'");
            		//dd(DB::getQueryLog());
            	}
            	
        	//dd(DB::getQueryLog());

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

    public function GetItmBYConditnInAddMore(Request $request){

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

				/*$itemListData = DB::select("SELECT t1.*,t2.* FROM PENQ_VENDOR t2 LEFT JOIN PENQ_BODY t1 ON t1.PENQHID = t2.PENQHID AND t1.PENQBID=t2.PENQBID WHERE t1.VRNO='$enquiryno' AND t2.ACC_CODE='$accnum' AND t2.VRNO='$enquiryno' AND t1.quatation_tcode IS NULL AND t1.quatation_series_code IS NULL AND t1.quatation_vrno IS NULL AND t1.quatation_date IS NULL AND t2.quo_no IS NULL AND t2.quo_slno IS NULL AND quo_flag='0'");*/

				$itemListData = DB::select("SELECT t1.*,t2.* FROM PENQ_VENDOR t2 LEFT JOIN PENQ_BODY t1 ON t1.PENQHID = t2.PENQHID AND t1.PENQBID=t2.PENQBID WHERE t1.VRNO='$enquiryno' AND t2.ACC_CODE='$accnum' AND t2.VRNO='$enquiryno' AND t1.SERIES_CODE='$seriesEnq' AND t2.COMP_CODE='$getcom_code' AND t2.FY_CODE='$fisYear' AND PQTN_FLAG='0'");

			}else if($accnum && $tax_code){

				$itemListData =	DB::SELECT("SELECT t1.*,t2.* FROM MASTER_HSNRATE t1  LEFT JOIN MASTER_ITEM t2 ON t2.HSN_CODE = t1.HSN_CODE WHERE t1.TAX_CODE='$tax_code'");

			}else if($accnum && $tax_code==''){

				$itemListData= DB::table('MASTER_ITEM')->get();

				/*$stateconty = DB::table('MASTER_ACC')
				->select('MASTER_ACC.*', 'MASTER_ACCADD.*')
           		->leftjoin('MASTER_ACCADD', 'MASTER_ACCADD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->where('MASTER_ACC.ACC_CODE',$accnum)
           		->get()->first();

	        	$stateOfAcc = $stateconty->STATE_CODE;

	        	if($stateC == $stateconty->STATE_CODE){
	        		//DB::enableQueryLog();
	        		
	        		$itemListData= DB::table('MASTER_ITEM')->where('TAX_TYPE','SCGST')->get();
	        		//dd(DB::getQueryLog());
	        	}else if($stateC != $stateconty->STATE_CODE){
	        		
	        		$itemListData= DB::table('MASTER_ITEM')->where('TAX_TYPE','IGST')->get();
	        	}else if($countryC != $stateconty->COUNTRY){
	        		
	        		$itemListData= DB::table('MASTER_ITEM')->where('TAX_TYPE','EXPORT')->get();
	        	}else{
	        		$itemListData='';
	        	}*/

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

    public function GetItmBYConditnInAddMoreGRN(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$acccode          = $request->input('account_code');
			$tax_code         = $request->input('tax_code');
			$stateC           = $request->input('stateCode');

			$accDetails = DB::table('master_party')->where('acc_code',$acccode)->get()->first();

			if($acccode && $tax_code){

				$itemListData =	DB::SELECT("SELECT t1.*,t2.* FROM master_hsn_rate t1  LEFT JOIN master_item_finance t2 ON t2.hsn_code = t1.hsn_code WHERE t1.tax_code='$tax_code'");

			}else if($acccode && $tax_code==''){

				$stateconty = DB::table("master_party")->where('acc_code',$acccode)->get()->first();

	        	if($stateC == $stateconty->state){
	        		//DB::enableQueryLog();
	        		
	        		$itemListData= DB::table('master_item_finance')->where('tax_type','SCGST')->get();
	        		//dd(DB::getQueryLog());
	        	}else if($stateC != $stateconty->state){
	        		
	        		$itemListData= DB::table('master_item_finance')->where('tax_type','IGST')->get();
	        	}else if($countryC != $stateconty->country){
	        		
	        		$itemListData= DB::table('master_item_finance')->where('tax_type','EXPORT')->get();
	        	}else{
	        		$itemListData='';
	        	}

			}

    		if ($itemListData || $accDetails) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemListData;
	            $response_array['accData'] = $accDetails;

	           echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['accData'] = '';
                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['accData'] = '';
                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function GetAccountByEnquiry(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$enquiryno = $request->input('enquiryno');

	    	/*$enquiryData = DB::select("SELECT * FROM `enquiry_body` WHERE vr_no='$enquiryno' AND quatation_tcode IS NULL AND quatation_series_code IS NULL");*/

	    	$accData = DB::select("SELECT t1.*,t2.* FROM enquiry_vendor t2 LEFT JOIN enquiry_head t1 ON t1.id = t2.enquiry_head_id WHERE t1.vr_no='$enquiryno' AND quo_no IS NULL AND quo_slno IS NULL AND quo_flag='0' GROUP BY t2.account_code ");

    		if ($accData) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $accData;

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

    public function AfieldCalculationGetquation(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tax_code     = $request->input('tax_code');
			$ItemCode     = $request->input('ItemCode');
			$purQtnHeadId = $request->input('headId');
			$PurQtnBodyId = $request->input('bodyId');
			$headConId    = $request->input('headConId');
			$bodyConId    = $request->input('bodyConId');
			$CompanyCode  = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$userid       = $request->session()->get('userid');
			//DB::enableQueryLog();
	    	if($ItemCode && $purQtnHeadId && $PurQtnBodyId){

	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM purchase_quotation_tax t3 LEFT JOIN purchase_quotation_body t2 ON t2.id = t3.purchase_quotation_body_id LEFT JOIN purchase_quotation_head t1 ON t1.id = t3.purchase_quotation_head_id WHERE t1.tax_code='$tax_code' AND t2.item_code='$ItemCode' AND t3.purchase_quotation_head_id='$purQtnHeadId' AND t3.purchase_quotation_body_id='$PurQtnBodyId'");
	    		//print_r($transcode_list);exit;

	    		//dd(DB::getQueryLog());

	    	}else{

	    		$transcode_list = DB::table('master_tax_rate')
            ->join('master_tax_indicator', 'master_tax_rate.tax_ind_code', '=', 'master_tax_indicator.tax_ind_code')
            ->select('master_tax_rate.*', 'master_tax_indicator.tax_ind_name','master_tax_indicator.tax_ind_block')
            ->where([['master_tax_rate.tax_code','=',$tax_code]])
            ->orderBy('id','ASC')
            ->get();
	    	}
            

             $ratevalue = DB::table('rate_value')->get();

           
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

    public function GetPurchaseQuatationForApp(Request $request){

    	$response_array = array();

        if ($request->ajax()) {

			$tran_code   = $request->input('tran_code');
			$series_code = $request->input('series_code');
			$slno        = $request->input('slno');
			$vr_no       = $request->input('vr_no');
			$approve_ind = $request->input('approve_ind');
          //  print_r($series_code);exit;
        
            $fetch_reocrd = DB::SELECT("SELECT p1.* FROM PQTN_BODY p1  WHERE p1.TRAN_CODE='$tran_code' AND p1.VRNO='$vr_no' AND p1.SLNO='$slno'");

        	//print_r($fetch_reocrd);exit;

            /*$fetch_reocrd = DB::SELECT("SELECT p1.*,p2.* FROM purchase_order_head p1  LEFT JOIN purchase_order_body p2 ON p2.purchase_order_head_id = p1.id WHERE p1.tran_code='$tran_code' AND p1.series_code='$series_code' AND p1.vr_no='$vr_no'");*/

          // print_r($fetch_reocrd);exit;
            //dd(DB::getQueryLog());
        
            if ($fetch_reocrd!='') {

               

                $response_array['response'] = 'success';
                $response_array['data'] = $fetch_reocrd ;
                $response_array['approve_ind'] = $approve_ind ;

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

    public function StatusPurchaseQuatation(Request $request){

		$userId         = $request->session()->get('userid');
		$tran_code      = $request->input('tran_code');
		$series_code    = $request->input('series_code');
		$vr_no          = $request->input('vr_no');
		$sl_no          = $request->input('sl_no');
		$approve_remark = $request->input('approve_remark_quatation');
		



        if ($userId!='') {

        		 //DB::enableQueryLog();
        $getlevleno = DB::table('PQTN_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->get()->first();

        	//dd(DB::getQueryLog());

        	 $levno = $getlevleno->LEVEL_NO;
        	// print_r($getlevleno);exit;

        	 $levelNo =  $levno + 1;

        	 $data1=array(
    			'APPROVE_STATUS'=>'3'
    		);

        	// DB::enableQueryLog();

			$UpdateLevel = DB::table('PQTN_APPROVE')->where('LEVEL_NO', $levelNo)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);

			//dd(DB::getQueryLog());

    		$data=array(
    			'APPROVE_STATUS'=>'1',
    			'APPROVE_REMARK'=>$approve_remark,
    			'FLAG'=>'1',

    		);


			$Updatedata = DB::table('PQTN_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data);


			$selectdata = DB::table('PQTN_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->where('LASTUSER','3')->where('APPROVE_STATUS','1')->get()->first();


			if ($selectdata) {

				$data1=array(
	    			'APPROVE_REMARK'=>$approve_remark,
	    			'FLAG'=>'1',

	    		);

	    		$Updatedata1 = DB::table('PQTN_BODY')->where('TRAN_CODE',$selectdata->TRAN_CODE)->where('VRNO',$selectdata->VRNO)->where('SLNO',$selectdata->SLNO)->update($data1);

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

	function RejectPurchaseQuatation(Request $request){

    	$userid    = $request->session()->get('userid');


    	//print_r($userid);exit;

			$approval_remark = $request->input('approve_remark_quatation');
			$vr_no           = $request->input('vr_no');
			$tran_code       = $request->input('tran_code');
			$sl_no           = $request->input('sl_no');
			$approve_ind     = $request->input('approve_ind');


//print_r($approve_ind);exit;

				$data1=array(
	    			'APPROVE_REMARK'=>$approval_remark,
	    			'FLAG'=>'2',

	    		);

	    	$Updatedata = DB::table('PQTN_BODY')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);


	    	$data12=array(
	    			'REJECTED_STATUS'=>1,
	    			'APPROVE_STATUS'=>2,

	    		);

	    	$Updatedata12 = DB::table('PQTN_APPROVE')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data12);

	    		

	    	$DeleteData = DB::table('PQTN_APPROVE')->where('APPROVE_IND',$approve_ind)->where('VRNO',$vr_no)->where('APPROVE_USER',$userid)->where('SLNO',$sl_no)->delete();



			
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

	public function gettdsrateForPayAdvic(Request $request){

        $response_array = array();

        if ($request->ajax()) {

            $accCode = $request->input('accountcode');
        
            //DB::enableQueryLog();
            $fetch_reocrd = DB::table('master_party')->where('acc_code',$accCode)->get();
            //dd(DB::getQueryLog());
        
            if ($fetch_reocrd!='') {

                //echo "<PRE>";
            //print_r($fetch_tds_rate);
            //echo "</PRE>";

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

    public function AfieldCalculationGetContract(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tax_code     = $request->input('tax_code');
			$ItemCode     = $request->input('ItemCode');
			$purQtnHeadId = $request->input('headId');
			$PurQtnBodyId = $request->input('bodyId');
			$headConId    = $request->input('headConId');
			$bodyConId    = $request->input('bodyConId');
			$CompanyCode  = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$userid       = $request->session()->get('userid');
			//DB::enableQueryLog();
	    	if($ItemCode && $purQtnHeadId && $PurQtnBodyId){

	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM contract_tax t3 LEFT JOIN contract_body t2 ON t2.id = t3.contract_body_id LEFT JOIN contract_head t1 ON t1.id = t3.contract_head_id WHERE t1.tax_code='$tax_code' AND t2.item_code='$ItemCode' AND t3.contract_head_id='$purQtnHeadId' AND t3.contract_body_id='$PurQtnBodyId'");
	    		//print_r($transcode_list);exit;

	    		//dd(DB::getQueryLog());

	    	}else{

	    		$transcode_list = DB::table('master_tax_rate')
            ->join('master_tax_indicator', 'master_tax_rate.tax_ind_code', '=', 'master_tax_indicator.tax_ind_code')
            ->select('master_tax_rate.*', 'master_tax_indicator.tax_ind_name','master_tax_indicator.tax_ind_block')
            ->where([['master_tax_rate.tax_code','=',$tax_code]])
            ->orderBy('id','ASC')
            ->get();
	    	}
            

             $ratevalue = DB::table('rate_value')->get();

           
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

    public function GetPurchaseContractForApp(Request $request){

    	$response_array = array();

        if ($request->ajax()) {

			$tran_code   = $request->input('tran_code');
			$series_code = $request->input('series_code');
			$slno        = $request->input('slno');
			$vr_no       = $request->input('vr_no');
			$approve_ind = $request->input('approve_ind');
          //  print_r($series_code);exit;
        
            $fetch_reocrd = DB::SELECT("SELECT p1.* FROM PCNTR_BODY p1  WHERE p1.TRAN_CODE='$tran_code' AND p1.VRNO ='$vr_no' AND p1.SLNO ='$slno'");

        	//print_r($fetch_reocrd);exit;

            /*$fetch_reocrd = DB::SELECT("SELECT p1.*,p2.* FROM purchase_order_head p1  LEFT JOIN purchase_order_body p2 ON p2.purchase_order_head_id = p1.id WHERE p1.tran_code='$tran_code' AND p1.series_code='$series_code' AND p1.vr_no='$vr_no'");*/

          // print_r($fetch_reocrd);exit;
            //dd(DB::getQueryLog());
        
            if ($fetch_reocrd!='') {

               

                $response_array['response'] = 'success';
                $response_array['data'] = $fetch_reocrd ;
                $response_array['approve_ind'] = $approve_ind ;

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

    public function StatusPurchaseContract(Request $request){

		$userId         = $request->session()->get('userid');
		$tran_code      = $request->input('tran_code');
		$series_code    = $request->input('series_code');
		$vr_no          = $request->input('vr_no');
		$sl_no          = $request->input('sl_no');
		$approve_remark = $request->input('approve_remark_contract');
		



        if ($userId!='') {

        		 //DB::enableQueryLog();
        $getlevleno = DB::table('PCNTR_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->get()->first();

        	//dd(DB::getQueryLog());

        	 $levno = $getlevleno->LEVEL_NO;
        	// print_r($getlevleno);exit;

        	 $levelNo =  $levno + 1;

        	 $data1=array(
    			'APPROVE_STATUS'=>'3'
    		);

        	// DB::enableQueryLog();

			$UpdateLevel = DB::table('PCNTR_APPROVE')->where('LEVEL_NO', $levelNo)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);

			//dd(DB::getQueryLog());

    		$data=array(
    			'APPROVE_STATUS'=>'1',
    			'APPROVE_REMARK'=>$approve_remark,
    			'FLAG'=>'1',

    		);


			$Updatedata = DB::table('PCNTR_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data);


			$selectdata = DB::table('PCNTR_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->where('LASTUSER','3')->where('APPROVE_STATUS','1')->get()->first();


			if ($selectdata) {

				$data1=array(
	    			'APPROVE_REMARK'=>$approve_remark,
	    			'FLAG'=>'1',

	    		);

	    		$Updatedata1 = DB::table('PCNTR_BODY')->where('TRAN_CODE',$selectdata->TRAN_CODE)->where('VRNO',$selectdata->VRNO)->where('SLNO',$selectdata->SLNO)->update($data1);

			}else{

				$Updatedata1 = TRUE;

			}

			

			

			if($Updatedata && $Updatedata1){

				$request->session()->flash('alert-success', 'Contract Approved Successfully...!');
				return redirect('finance/user-approval-list/'.base64_encode($userId));

			} else {

				$request->session()->flash('alert-error', 'Contract Can Not Approved...!');
				return redirect('finance/user-approval-list/'.base64_encode($userId));

			}

		}else{

		$request->session()->flash('alert-error', 'HSN Rate Data Not Found...!');
		return redirect('finance/user-approval-list/'.base64_encode($userId));

		}

	}

	function RejectPurchaseContract(Request $request){

    	$userid    = $request->session()->get('userid');


    	//print_r($userid);exit;

			$approval_remark = $request->input('approve_remark_contract');
			$vr_no           = $request->input('vr_no');
			$tran_code       = $request->input('tran_code');
			$sl_no           = $request->input('sl_no');
			$approve_ind     = $request->input('approve_ind');


//print_r($approve_ind);exit;

				$data1=array(
	    			'APPROVE_REMARK'=>$approval_remark,
	    			'FLAG'=>'2',

	    		);

	    	$Updatedata = DB::table('PCNTR_BODY')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);


	    	$data12=array(
	    			'REJECTED_STATUS'=>1,
	    			'APPROVE_STATUS'=>2,

	    		);

	    	$Updatedata12 = DB::table('PCNTR_APPROVE')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data12);

	    		

	    	$DeleteData = DB::table('PCNTR_APPROVE')->where('	APPROVE_IND',$approve_ind)->where('VRNO',$vr_no)->where('APPROVE_USER',$userid)->where('SLNO',$sl_no)->delete();



			
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

	public function GetItmBYConditnInAddMorePurOrder(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$account_code = $request->input('account_code');
			$contractNo   = $request->input('contractNo');
			$quotationNo  = $request->input('quotationNo');
			$tax_code     = $request->input('tax_code');
			$stateC       = $request->input('stateCode');


	    if($contractNo){
	    	// DB::enableQueryLog();
            $accDataList =  DB::table('contract_head')->select('contract_head.*', 'master_party.*')
           		->leftjoin('master_party', 'contract_head.acc_code', '=', 'master_party.acc_code')
            	->where([['contract_head.vr_no','=',$contractNo]])
            	->get();
            //dd(DB::getQueryLog());

	    }else if($quotationNo){

	    	$accDataList =  DB::table('QCS_body')->select('QCS_body.*', 'master_party.*')
           		->leftjoin('master_party', 'QCS_body.party', '=', 'master_party.acc_code')
            	->where([['QCS_body.qc_no','=',$quotationNo]])
            	->get();

        }else{

            $accDataList =  DB::table('master_party')->get();
        }

	    if($account_code && $contractNo){
	    	//DB::enableQueryLog();
	    	$qtncontr_list = DB::table('contract_head')
				->select('contract_head.*', 'contract_body.*')
           		->leftjoin('contract_body', 'contract_head.id', '=', 'contract_body.contract_head_id')
            	->where([['contract_head.acc_code','=',$account_code],['contract_head.vr_no','=',$contractNo]])
            	->get();
          //  dd(DB::getQueryLog());
	    }else if($account_code && $quotationNo){
	    	//DB::enableQueryLog();
	    	
           	/*$qtncontr_list = DB::table('QCS_body')
				->select('QCS_body.*', 'master_item_finance.*')
           		->leftjoin('master_item_finance', 'master_item_finance.item_code', '=', 'QCS_body.item')
            	->where([['QCS_body.party','=',$account_code],['QCS_body.qc_no','=',$quotationNo]])
            	->get();*/

            	$qtncontr_list = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM master_item_finance t1 LEFT JOIN QCS_body t2 ON t2.item = t1.item_code LEFT JOIN QCS_Head t3 ON t3.id = t2.qcs_head_id WHERE t2.party='$account_code' AND t3.qc_no='$quotationNo'");
           // dd(DB::getQueryLog());	
	    }else if($account_code && $tax_code){
	    	$qtncontr_list = DB::SELECT("SELECT t1.*,t2.* FROM master_hsn_rate t1  LEFT JOIN master_item_finance t2 ON t2.hsn_code = t1.hsn_code WHERE t1.tax_code='$tax_code'");

	    }else if($account_code && $tax_code==''){
	    	$stateconty = DB::table("master_party")->where('acc_code',$account_code)->get()->first();

            if($stateC == $stateconty->state){
              //DB::enableQueryLog();
              
              $qtncontr_list= DB::table('master_item_finance')->where('tax_type','SCGST')->get();
              //dd(DB::getQueryLog());
            }else if($stateC != $stateconty->state){
              
              $qtncontr_list= DB::table('master_item_finance')->where('tax_type','IGST')->get();
            }else if($countryC != $stateconty->country){
              
              $qtncontr_list= DB::table('master_item_finance')->where('tax_type','EXPORT')->get();
            }else{
              $qtncontr_list='';
            }

	    }else{}
	    	

    		if ($qtncontr_list && $accDataList) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $qtncontr_list;
	            $response_array['acc_list'] = $accDataList;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['acc_list'] ='';

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['acc_list'] ='';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function AfieldCalculationGetOrder(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tax_code     = $request->input('tax_code');
			$ItemCode     = $request->input('ItemCode');
			$purQtnHeadId = $request->input('purQtnHeadId');
			$PurQtnBodyId = $request->input('PurQtnBodyId');
			$headConId    = $request->input('headConId');
			$bodyConId    = $request->input('bodyConId');
			$CompanyCode  = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$userid       = $request->session()->get('userid');
			//DB::enableQueryLog();
	    	if($ItemCode && $purQtnHeadId && $PurQtnBodyId){

	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM purchase_order_tax t3 LEFT JOIN purchase_order_body t2 ON t2.id = t3.purchase_order_body_id LEFT JOIN purchase_order_head t1 ON t1.id = t3.purchase_order_head_id WHERE t1.tax_code='$tax_code' AND t2.item_code='$ItemCode' AND t3.purchase_order_head_id='$purQtnHeadId' AND t3.purchase_order_body_id='$PurQtnBodyId'");
	    		//print_r($transcode_list);exit;

	    		//dd(DB::getQueryLog());

	    	}else{

	    		$transcode_list = DB::table('master_tax_rate')
            ->join('master_tax_indicator', 'master_tax_rate.tax_ind_code', '=', 'master_tax_indicator.tax_ind_code')
            ->select('master_tax_rate.*', 'master_tax_indicator.tax_ind_name','master_tax_indicator.tax_ind_block')
            ->where([['master_tax_rate.tax_code','=',$tax_code]])
            ->orderBy('id','ASC')
            ->get();
	    	}
            

             $ratevalue = DB::table('rate_value')->get();

           
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

    public function PurchaseOrderApproval(Request $request){

     $compName = $request->session()->get('company_name');

     $userId = $request->session()->get('userid');

        if($request->ajax()) {
    
            $title ='View Purchase';
    
            $userid    = $request->session()->get('userid');
    
            $userType = $request->session()->get('usertype');
    
            $compName = $request->session()->get('company_name');
    
            $fisYear =  $request->session()->get('macc_year');
    
    
            if($userType=='admin' || $userType=='Admin'){
    
             $data = DB::SELECT("SELECT t1.*,t2.APPROVE_USER as app_user FROM PORDER_APPROVE t1  LEFT JOIN USER_APPROVE_IND t2 ON t2.APPROVE_USER = t1.APPROVE_IND WHERE t2.USER_CODE='$userid'");
    
            }else if($userType=='superAdmin' || $userType=='user'){
    
                 $data = DB::SELECT("SELECT t1.*,t2.APPROVE_USER as app_user FROM PORDER_APPROVE t1  LEFT JOIN USER_APPROVE_IND t2 ON t2.APPROVE_USER = t1.APPROVE_IND WHERE t2.USER_CODE='$userid'");
    				
            }
            else{
    
                $data='';
                
            }



    
        /*return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
                    
                })->toJson();*/

                return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
					

					if($data->APPROVE_STATUS==''){
					$btn = '<button type="button" data-toggle="modal" data-target="#journalDelete" class="btn btn-danger btn-xs" onclick="return changeStatus('.$data->APPROVE_USER.')">Not Approved</button>';
					}else{
					$btn = '<button type="button" data-toggle="modal" data-target="#journalDelete" class="btn btn-success btn-xs">Approved</button>';
				}

	     			return $btn;
				})->make(true);
    
    
        }

        if(isset($compName)){

	       return view('admin.finance.transaction.view_approve_user_ind');
	        }else{
			return redirect('/useractivity');
		}
	        
    }

    public function GetPurchaseOrdForApp(Request $request){

    	$response_array = array();

        if ($request->ajax()) {

			$tran_code   = $request->input('tran_code');
			$series_code = $request->input('series_code');
			$slno        = $request->input('slno');
			$vr_no       = $request->input('vr_no');
            //print_r($slno);exit;
        
            $fetch_reocrd = DB::SELECT("SELECT p1.* FROM PORDER_BODY p1  WHERE p1.TRAN_CODE='$tran_code' AND p1.VRNO='$vr_no' AND p1.SLNO='$slno'");

        

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

    public function purchase_reject_msg(Request $request,$saveData){

		 //	print_r($savedata);exit;

		$userid    = $request->session()->get('userid');

		if ($saveData){

				$request->session()->flash('alert-success', 'Purchase Order Entry Rejected...!');
				return redirect('/finance/user-approval-list/'.base64_encode($userid));

			} else {

				$request->session()->flash('alert-error', 'Purchase Order Entery Can Not Rejected...!');
				return redirect('/finance/user-approval-list/'.base64_encode($userid));

			}
	}


	function RejectPurchaseOrder(Request $request){

    	$userid    = $request->session()->get('userid');
    	
			$approval_remark = $request->input('approve_remark');
			$vr_no           = $request->input('vr_no');
			$tran_code       = $request->input('tran_code');
			$sl_no           = $request->input('sl_no');



				$data1=array(
	    			'APPROVE_REMARK'=>$approval_remark,
	    			'FLAG'=>'2',

	    		);

	    		$Updatedata = DB::table('PORDER_BODY')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);

	    		$data12=array(
	    			'REJECTED_STATUS'=>1,
	    			'APPROVE_STATUS'=>2,

	    		);

	    	$Updatedata12 = DB::table('PORDER_APPROVE')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data12);

	    		

	    	 $DeleteData = DB::table('PORDER_APPROVE')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('APPROVE_USER',$userid)->where('SLNO',$sl_no)->delete();


			
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

	public function GetPurchaseBillForApp(Request $request){

    	$response_array = array();

        if ($request->ajax()) {

			$tran_code   = $request->input('tran_code');
			$series_code = $request->input('series_code');
			$slno        = $request->input('slno');
			$vr_no       = $request->input('vr_no');
            //print_r($slno);exit;
        
            $fetch_reocrd = DB::SELECT("SELECT p1.* FROM PBILL_BODY p1  WHERE p1.TRAN_CODE='$tran_code' AND p1.VRNO='$vr_no' AND p1.SLNO='$slno'");

        

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


    function RejectPurchaseBill(Request $request){

			$userid    = $request->session()->get('userid');
			
			$approval_remark = $request->input('approve_remark');
			$vr_no           = $request->input('vr_no');
			$tran_code       = $request->input('tran_code');
			$sl_no           = $request->input('sl_no');



				$data1=array(
	    			'APPROVE_REMARK'=>$approval_remark,
	    			'FLAG'=>'2',

	    		);

	    		$Updatedata = DB::table('PBILL_BODY')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);

	    		$data12=array(
	    			'REJECTED_STATUS'=>1,
	    			'APPROVE_STATUS'=>2,

	    		);

	    	$Updatedata12 = DB::table('PBILL_APPROVE')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data12);

	    		

	    	 $DeleteData = DB::table('PBILL_APPROVE')->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('APPROVE_USER',$userid)->where('SLNO',$sl_no)->delete();


			
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

	public function PurchaseOrderInvoce(Request $request,$saveData,$orderid,$headid){


		$id =base64_decode($headid);
		$bodyid =base64_decode($orderid);

		$explode = explode(',', $bodyid);

		DB::table('purchase_order_temp')->truncate();

		$userid    = $request->session()->get('userid');

		$compName = $request->session()->get('company_name');


		$compnyName =explode('-', $compName);
		$fisYear =  $request->session()->get('macc_year');

	   $purchase_order['company'] = DB::table('master_comp')->where('comp_code',$compnyName[0])->get()->first();

 	 	// print_r($expode[0]);exit;

		$purchase_order['userdata'] = DB::table('master_user')->where('id',$userid)->get()->first();


		$purchase_order['getheaddata'] = DB::table('purchase_order_head')->where('id',$id)->get()->first();

		$purchase_order['getbodydata1'] = DB::table('purchase_order_body')->where('purchase_order_head_id',$id)->get();

		$purchase_order['acc_name'] = DB::table('master_party')->where('acc_code',$purchase_order['getheaddata']->acc_code)->get()->first();


	    $bodycount = count($explode);
		
		$purchase_order1=array();
		$purchase_order2=array();
		$purchase_order3=array();
		for ($i=0; $i <$bodycount; $i++) { 

	  		// DB::enableQueryLog();

			$purchase_order1[] =  DB::table('purchase_order_body')
					->select('purchase_order_body.*', 'purchase_order_tax.tax_ind_name','purchase_order_tax.tax_rate','purchase_order_tax.tax_amt','purchase_order_head.acc_code')
	           		->leftjoin('purchase_order_tax', 'purchase_order_tax.purchase_order_body_id', '=', 'purchase_order_body.id')
	           		->leftjoin('purchase_order_head', 'purchase_order_head.id', '=', 'purchase_order_body.purchase_order_head_id')
	           		->where('purchase_order_tax.tax_ind_name','=','CGST')
	           		->where('purchase_order_body.id',$explode[$i])
	            	->get()->toArray();

	     	//  dd(DB::getQueryLog());
	    	$purchase_order2[] =  DB::table('purchase_order_body')
					->select('purchase_order_body.*', 'purchase_order_tax.tax_ind_name','purchase_order_tax.tax_rate','purchase_order_tax.tax_amt','purchase_order_head.acc_code')
	           		->leftjoin('purchase_order_tax', 'purchase_order_tax.purchase_order_body_id', '=', 'purchase_order_body.id')
	           		->leftjoin('purchase_order_head', 'purchase_order_head.id', '=', 'purchase_order_body.purchase_order_head_id')
	           		->where('purchase_order_tax.tax_ind_name','=','SGST')
	           		->where('purchase_order_body.id',$explode[$i])
	            	->get()->toArray();


	    	$purchase_order3[] =  DB::table('purchase_order_body')
			->select('purchase_order_body.*', 'purchase_order_tax.tax_ind_name','purchase_order_tax.tax_rate','purchase_order_tax.tax_amt','purchase_order_head.acc_code')
	   		->leftjoin('purchase_order_tax', 'purchase_order_tax.purchase_order_body_id', '=', 'purchase_order_body.id')
	   		->leftjoin('purchase_order_head', 'purchase_order_head.id', '=', 'purchase_order_body.purchase_order_head_id')
	   		->where('purchase_order_tax.tax_ind_name','=','GrandTotal')
	   		->where('purchase_order_body.id',$explode[$i])
	    	->get()->toArray();
			
		}

	   $purchase_order['CGST_DATA']       =$purchase_order1;
	   $purchase_order['SGST_DATA']       =$purchase_order2;
	   $purchase_order['GRANDTOTAL_DATA'] =$purchase_order3;

      
		$getdata = count($purchase_order['GRANDTOTAL_DATA']);
		$getSdata = count($purchase_order['SGST_DATA']);
		$getCdata = count($purchase_order['CGST_DATA']);

		$getData01=array();
		for($j=0; $j < $getdata; $j++) { 

			$getTax['CGST'] = $purchase_order['CGST_DATA'][$j][0]->tax_ind_name;
			$getTax['CGST_AMT'] = $purchase_order['CGST_DATA'][$j][0]->tax_amt;
			$getTax['CGST_RATE'] = $purchase_order['CGST_DATA'][$j][0]->tax_rate;

			$getTax['SGST'] = $purchase_order['SGST_DATA'][$j][0]->tax_ind_name;
			$getTax['SGST_AMT'] = $purchase_order['SGST_DATA'][$j][0]->tax_amt;
			$getTax['SGST_RATE'] = $purchase_order['SGST_DATA'][$j][0]->tax_rate;

			$getTax['GRANDTOTAL'] = $purchase_order['GRANDTOTAL_DATA'][$j][0]->tax_ind_name;
			$getTax['GRANDTOTAL_AMT'] = $purchase_order['GRANDTOTAL_DATA'][$j][0]->tax_amt;
			$getTax['tran_code'] = $purchase_order['CGST_DATA'][$j][0]->tran_code;
			$getTax['vrno'] = $purchase_order['CGST_DATA'][$j][0]->vrno;
			$getTax['slno'] = $purchase_order['CGST_DATA'][$j][0]->slno;
			$getTax['vr_date'] = $purchase_order['CGST_DATA'][$j][0]->vr_date;
			$getTax['item_code'] = $purchase_order['CGST_DATA'][$j][0]->item_code;
			$getTax['item_name'] = $purchase_order['CGST_DATA'][$j][0]->item_name;
			$getTax['um_code'] = $purchase_order['CGST_DATA'][$j][0]->um_code;
			$getTax['aum_code'] = $purchase_order['CGST_DATA'][$j][0]->aum_code;
			$getTax['remark'] = $purchase_order['CGST_DATA'][$j][0]->remark;
			$getTax['quantity'] = $purchase_order['CGST_DATA'][$j][0]->quantity;
			$getTax['Aquantity'] = $purchase_order['CGST_DATA'][$j][0]->Aquantity;
			$getTax['qty_issued'] = $purchase_order['CGST_DATA'][$j][0]->qty_issued;
			$getTax['rate'] = $purchase_order['CGST_DATA'][$j][0]->qty_issued;
			$getTax['tax_code'] = $purchase_order['CGST_DATA'][$j][0]->tax_code;
			$getTax['hsn_code'] = $purchase_order['CGST_DATA'][$j][0]->hsn_code;
			$getTax['basic_amt'] = $purchase_order['CGST_DATA'][$j][0]->basic_amt;
			$getTax['basic_amt'] = $purchase_order['CGST_DATA'][$j][0]->basic_amt;
			$getTax['basic_amt'] = $purchase_order['CGST_DATA'][$j][0]->basic_amt;
			$getTax['acc_code'] = $purchase_order['CGST_DATA'][$j][0]->acc_code;

			array_push($getData01, $getTax);
		
		}


		foreach ($getData01 as $row){
			
			$data_body = array(
					
					'comp_name'           =>$compName,
				    'fiscal_year'         =>$fisYear,
					'tran_code'           =>$row['tran_code'],
					'vrno'                =>$row['vrno'],
					'slno'                =>$row['slno'],
					'vr_date'             =>$row['vr_date'],
					'item_code'           =>$row['item_code'],
					'item_name'           =>$row['item_name'],
					'acc_code'            =>$row['acc_code'],
					'um_code'             =>$row['um_code'],
					'aum_code'            =>$row['aum_code'],
					'remark'              =>$row['remark'],
					'quantity'            =>$row['quantity'],
					'Aquantity'           =>$row['Aquantity'],
					'qty_issued'          =>$row['qty_issued'],
					'rate'                =>$row['rate'],
					'tax_code'            =>$row['tax_code'],
					'hsn_code'            =>$row['hsn_code'],
					'basic_amt'           =>$row['basic_amt'],
					'cgst'                =>$row['CGST_AMT'],
					'sgst'                =>$row['SGST_AMT'],
					'cgst_rate'           =>$row['CGST_RATE'],
					'sgst_rate'           =>$row['SGST_RATE'],
					'igst'                =>'',
					'grand_total'         =>$row['GRANDTOTAL_AMT'],
					'flag'                =>'0',
					
			);

			$saveData = DB::table('purchase_order_temp')->insert($data_body);

		}

	
     	$purchase_order['getbodydata'] = DB::table('purchase_order_temp')->get();

     	$company = $purchase_order['company'];

     	$tempdata= DB::table('purchase_order_temp')->get();


    	$filename = 'download.pdf';

    	$mpdf  = new \Mpdf\Mpdf();
    	$html  = view('admin.finance.transaction.pdfpage')->with($purchase_order);
    	$html  = $html->render();
    	//$mpdf->SetHeader('chapter 1');
    	
    	$stylesheet = file_get_contents(url('public/dist/css/mpdf.css'));
    	$mpdf->WriteHTML($stylesheet, 1);

    	//$mpdf->SetFooter('Footer');
    	
    	$mpdf->WriteHTML($html);

    	//$pdf = $mpdf->Output('','I');
    	$pdf = $mpdf->Output('', 'S');
    	//	print_r($mpdf->Output($filename,'I'));exit;

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

        $message = '<div class="content-wrapper"><section class="content"><div class="row"><div class="col-xs-12"><div class="box box-primary Custom-Box"><div class="box-header with-border" style="text-align: center;"></div><div class="box-body"><div id="invoiceholder" style="border: 1px solid #867d7d"><div id="invoice" class="effect2" style="padding:40px;"><div class="row"><center><span style="font-weight: bold;font-size: 20px;">Purchase Order </span><p>'.$company->pin_code.'</p></center></div><div></div><div id="invoice-mid"><div style="font-size: 10px;"><p >'. $company->add1.'</p><p>'.$company->add2.'</p><p>'.$company->city.' - '.$company->pin_code.'</p></div><br><div><span><b>Subject : Order For Verious Points </b></span></div><br><div style="font-size: 10px;"><p>Dear Sir ,</p><p>Thank you for your quation and price list. We glad to place our first order with you for the following items</p></div></div><div id="invoice-bot"><div id="table" style="overflow-x: scroll;"><table class="table-main table table-bordered" style="border:1px solid #000;border-collapse:collapse;"><thead><tr class="tabletitle" style="border:1px solid #000;"><th style="border:1px solid #000;">Item Code</th><th style="border:1px solid #000;">Item Name</th><th style="border:1px solid #000;">Quantity</th><th style="border:1px solid #000;">UM</th><th style="border:1px solid #000;">A Quantity</th><th style="border:1px solid #000;">AUM</th><th style="border:1px solid #000;">Basic Amount</th></tr></thead>';
        		$sum=0;
       		foreach($tempdata as $key){
       			//print_r($key->item_code);

       			$sum += $key->basic_amt;

        	$message .= '<tr class="list-item" style="border:1px solid #000;"><td data-label="Type" class="tableitem" style="border:1px solid #000;">'.$key->item_code.'</td><td data-label="Description" class="tableitem">'.$key->item_name.'</td><td data-label="Quantity" class="tableitem" style="border:1px solid #000;">'.$key->quantity .'</td><td data-label="Quantity" class="tableitem" style="border:1px solid #000;">'.$key->um_code .'</td><td data-label="Unit Price" class="tableitem" style="border:1px solid #000;">'. $key->Aquantity .'</td><td data-label="Taxable Amount" class="tableitem" style="border:1px solid #000;">'. $key->aum_code.'</td><td data-label="%" class="tableitem" >'.$key->basic_amt.'</td></tr>';
   			 }

   			 $message .='<tr class="list-item total-row" style="border:1px solid #000;"><th colspan="6" class="tableitem"> Total</th><td data-label="Grand Total" class="tableitem" style="text-align: right;}">'.$sum.'</td></table></div><div style="font-size: 10px;"><p>The above goods are require immidiatly as our stock is about  to exhust very soon. we request you to send the good thorugh your "Motor" van as the garage inward is supposed to be borme you.</p><p>We shall arrange payemnt within ten days to comply with 5/10 net 30 terms .please send all commercial and financial document along with goods .we reserve right to the reject the goods if recevied late  </p></div><div style="font-size: 12px;"><p>Yours Fithfully</p><p>X.Y.X.Z</p><P>Purchase Manager</P></div></div><footer></footer></div></div></div></div></div></div></section></div>';
 
	        $mailer->Body = $message;

	        $mailSend = $mailer->send();
	        $mailer->ClearAllRecipients();

	        if($mailSend) {
	            return view('admin.finance.transaction.view_purchase_order_trans');
	        }else{
	           return redirect('/useractivity');
	        }

	}

	public function StatusPurchase(Request $request){

		$userId         = $request->session()->get('userid');
		$tran_code      = $request->input('tran_code');
		$series_code    = $request->input('series_code');
		$vr_no          = $request->input('vr_no');
		$sl_no          = $request->input('sl_no');
		$approve_remark = $request->input('approve_remark');
		



        if ($userId!='') {

        		 //DB::enableQueryLog();
        	$getlevleno = DB::table('PORDER_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->get()->first();

        	//dd(DB::getQueryLog());

        	 $levno = $getlevleno->LEVEL_NO;
        	// print_r($getlevleno);exit;

        	 $levelNo =  $levno + 1;

        	 $data1=array(
    			'APPROVE_STATUS'=>'3'
    		);

        	// DB::enableQueryLog();

			$UpdateLevel = DB::table('PORDER_APPROVE')->where('LEVEL_NO', $levelNo)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);

			//dd(DB::getQueryLog());

    		$data=array(
    			'APPROVE_STATUS'=>'1',
    			'APPROVE_REMARK'=>$approve_remark,
    			'FLAG'=>'1',

    		);


			$Updatedata = DB::table('PORDER_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data);


			$selectdata = DB::table('PORDER_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->where('LASTUSER','3')->where('APPROVE_STATUS','1')->get()->first();


			if ($selectdata) {

				$data1=array(
	    			'APPROVE_REMARK'=>$approve_remark,
	    			'FLAG'=>'1',

	    		);

	    		$Updatedata1 = DB::table('PORDER_BODY')->where('TRAN_CODE',$selectdata->TRAN_CODE)->where('VRNO',$selectdata->VRNO)->where('SLNO',$selectdata->SLNO)->update($data1);

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

	public function StatusPurchaseBill(Request $request){

		$userId         = $request->session()->get('userid');
		$tran_code      = $request->input('tran_code');
		$series_code    = $request->input('series_code');
		$vr_no          = $request->input('vr_no');
		$sl_no          = $request->input('sl_no');
		$approve_remark = $request->input('approve_remark');
		



        if ($userId!='') {

        		 //DB::enableQueryLog();
        	$getlevleno = DB::table('PBILL_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->get()->first();

        	//dd(DB::getQueryLog());

        	 $levno = $getlevleno->LEVEL_NO;
        	// print_r($getlevleno);exit;

        	 $levelNo =  $levno + 1;

        	 $data1=array(
    			'APPROVE_STATUS'=>'3'
    		);

        	// DB::enableQueryLog();

			$UpdateLevel = DB::table('PBILL_APPROVE')->where('LEVEL_NO', $levelNo)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data1);

			//dd(DB::getQueryLog());

    		$data=array(
    			'APPROVE_STATUS'=>'1',
    			'APPROVE_REMARK'=>$approve_remark,
    			'FLAG'=>'1',

    		);


			$Updatedata = DB::table('PBILL_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->update($data);


			$selectdata = DB::table('PBILL_APPROVE')->where('APPROVE_USER', $userId)->where('TRAN_CODE',$tran_code)->where('VRNO',$vr_no)->where('SLNO',$sl_no)->where('LASTUSER','3')->where('APPROVE_STATUS','1')->get()->first();


			if ($selectdata) {

				$data1=array(
	    			'APPROVE_REMARK'=>$approve_remark,
	    			'FLAG'=>'1',

	    		);

	    		$Updatedata1 = DB::table('PBILL_BODY')->where('TRAN_CODE',$selectdata->TRAN_CODE)->where('VRNO',$selectdata->VRNO)->where('SLNO',$selectdata->SLNO)->update($data1);

			}else{

				$Updatedata1 = TRUE;

			}

			

			

			if($Updatedata && $Updatedata1){

				$request->session()->flash('alert-success', 'Purchase Bill Approved Successfully...!');
				return redirect('finance/user-approval-list/'.base64_encode($userId));

			} else {

				$request->session()->flash('alert-error', 'Purchase Bill Can Not Approved...!');
				return redirect('finance/user-approval-list/'.base64_encode($userId));

			}

		}else{

		$request->session()->flash('alert-error', 'HSN Rate Data Not Found...!');
		return redirect('/finance/view-hsn-rate-master');

		}

	}

	public function UserApprovalList(Request $request,$userid){

	$compName = $request->session()->get('company_name');

	$userId   = $request->session()->get('userid');

       	$uid =base64_decode($userid);

	$title ='View Purchase';

	$userid    = $request->session()->get('userid');

	$userType = $request->session()->get('usertype');

	$compName    = $request->session()->get('company_name');

	$getcompcode = explode('-', $compName);
	$comp_code   =	$getcompcode[0];

        $fisYear =  $request->session()->get('macc_year');

        $chkApp_user = DB::table('USER_APPROVE_IND')->where('USER_CODE', $uid)->get()->first();

        if($chkApp_user){

	        $fetch_reocrd = DB::table('PORDER_APPROVE')->where('APPROVE_USER',$uid)->get()->first();

	        $getapprove =	DB::SELECT("SELECT p1.* FROM PORDER_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0'");

	        $approvalcount = count($getapprove);

	        $getorderreject =	DB::SELECT("SELECT p1.* FROM PORDER_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='2' OR p1.APPROVE_STATUS='3') AND p1.REJECTED_STATUS='1'");

	        if($getorderreject){

	        	$orderrejctcount = count($getorderreject);
	   		 }else{
	    		$orderrejctcount='';
	   		 }

	   		$getorderapprove =	DB::SELECT("SELECT p1.* FROM PORDER_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND p1.APPROVE_STATUS='1' AND p1.REJECTED_STATUS='0'");

	        if($getorderapprove){

	        	$orderapprovecount = count($getorderapprove);
	   		 }else{
	    		$orderapprovecount='';
	   		 }

			$userStatus = 3;

			$fetch_reocrd1 = DB::table('PORDER_APPROVE')->where('APPROVE_USER',$uid)->where('APPROVE_STATUS',$userStatus)->get()->first();

			if ($fetch_reocrd1){

				$getLevel  = $fetch_reocrd->LEVEL_NO;
				
				$getLevel1 = $fetch_reocrd1->LEVEL_NO;
				
				$getUsr    = $fetch_reocrd->APPROVE_USER;
				
				$getUsr1   = $fetch_reocrd1->APPROVE_USER;

				if ($getLevel == $getLevel1 && $getUsr == $getUsr1){

					$userData['statusVis'] = 'TRUE'; 

					
				}else{

					$userData['statusVis'] = 'FALSE';
				}

			}else{

				$userData['statusVis'] = 'FALSE';
			}


	    
	        $userData['user_approve_data'] = DB::SELECT("SELECT t1.*,t2.APPROVE_USER as app_user FROM PORDER_APPROVE t1  LEFT JOIN USER_APPROVE_IND t2 ON t2.APPROVE_USER = t1.APPROVE_IND WHERE t2.USER_CODE='$userid'");

	            /*PURCHASE BILL*/


	        $fetch_reocrd_bill = DB::table('PBILL_APPROVE')->where('APPROVE_USER',$uid)->get()->first();

	        $getapprovebill =	DB::SELECT("SELECT p1.* FROM PBILL_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0'");

	        $pendingbillcount = count($getapprovebill);

	        $getbillreject =	DB::SELECT("SELECT p1.* FROM PBILL_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='2' OR p1.APPROVE_STATUS='3') AND p1.REJECTED_STATUS='1'");

	        if($getbillreject){

	        	$billrejctcount = count($getbillreject);
	   		 }else{
	    		$billrejctcount='';
	   		 }

	   		$getbillapprove =	DB::SELECT("SELECT p1.* FROM PBILL_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND p1.APPROVE_STATUS='1' AND p1.REJECTED_STATUS='0'");

	        if($getbillapprove){

	        $billapprovecount = count($getbillapprove);
	   		 }else{
	    	$billapprovecount='';
	   		 }

			$userStatusBill = 3;

			$fetch_reocrd_bill1 = DB::table('PBILL_APPROVE')->where('APPROVE_USER',$uid)->where('APPROVE_STATUS',$userStatusBill)->get()->first();

			if ($fetch_reocrd_bill1){

				$getLevelbill  = $fetch_reocrd_bill->LEVEL_NO;
				
				$getLevelbill1 = $fetch_reocrd_bill1->LEVEL_NO;
				
				$getUsrbill    = $fetch_reocrd_bill->APPROVE_USER;
				
				$getUsrbill1   = $fetch_reocrd_bill1->APPROVE_USER;

				if ($getLevelbill == $getLevelbill1 && $getUsrbill == $getUsrbill1){

					$userData['statusVis6'] = 'TRUE'; 

					
				}else{

					$userData['statusVis6'] = 'FALSE';
				}

			}else{

				$userData['statusVis6'] = 'FALSE';
			}

	        $userData['user_approve_bill'] = DB::SELECT("SELECT t1.*,t2.APPROVE_USER as app_user FROM PBILL_APPROVE t1  LEFT JOIN USER_APPROVE_IND t2 ON t2.APPROVE_USER = t1.APPROVE_IND WHERE t2.USER_CODE='$userid'");


	        /*PURCHASE BILL*/

	       /* INDENT RECORD */

			$indent_record = DB::table('PINDENT_APPROVE')->where('APPROVE_USER',$uid)->get()->first();

			$getindent =	DB::SELECT("SELECT p1.* FROM PINDENT_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0'");

			$indnetcount = count($getindent);

			$getindentreject =	DB::SELECT("SELECT p1.* FROM PINDENT_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='2' OR p1.APPROVE_STATUS='3') AND p1.REJECTED_STATUS='1'");

	        if($getindentreject){

	            $indnetrejctcount = count($getindentreject);
	        }else{
	        	$indnetrejctcount='';
	        }

	         $getindentapprove =	DB::SELECT("SELECT p1.* FROM PINDENT_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND p1.APPROVE_STATUS='1' AND p1.REJECTED_STATUS='0'");

	        if($getindentapprove){

	            $indnetapprovecount = count($getindentapprove);
	        }else{
	        	$indnetapprovecount='';
	        }

			$userStatus = 3;

			$indent_reocrd1 = DB::table('PINDENT_APPROVE')->where('APPROVE_USER',$uid)->where('APPROVE_STATUS',$userStatus)->get()->first();

			//print_r($indent_reocrd1);exit;	

			if ($indent_reocrd1) {

				$indentLevel = $indent_record->LEVEL_NO;

				$indentLevel1 = $indent_reocrd1->LEVEL_NO;

				$indentUsr = $indent_record->APPROVE_USER;

				$indentUsr1 = $indent_reocrd1->APPROVE_USER;
				/*echo '<pre>';
				print_r($indentLevel);
				print_r($indentLevel2);
				print_r($indentUsr);
				print_r($indentUsr1);
				echo '</pre>';exit;*/

				if ($indentLevel == $indentLevel1 && $indentUsr == $indentUsr1){

					$userData['statusVis1'] = 'TRUE'; 
			//print_r('hi');exit;

					
				}else{

					$userData['statusVis1'] = 'FALSE';

					
				}

			}else{

				$userData['statusVis1'] = 'FALSE';
			}
	             
	        $userData['user_approve_indent'] = DB::SELECT("SELECT p1.*,p2.APPROVE_USER as app_user FROM PINDENT_APPROVE p1  LEFT JOIN USER_APPROVE_IND p2 ON p2.APPROVE_USER = p1.APPROVE_IND WHERE p2.USER_CODE='$userid' GROUP BY p1.SLNO");

	    
	        /*PURCHASE QUATATION*/

			$quatation_record = DB::table('PQTN_APPROVE')->where('APPROVE_USER',$uid)->get()->first();

			$getquatation =	DB::SELECT("SELECT p1.* FROM PQTN_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0'");

			$quatationcount = count($getquatation);

			$getqutationreject =	DB::SELECT("SELECT p1.* FROM PQTN_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='2' OR p1.APPROVE_STATUS='3') AND p1.REJECTED_STATUS='1'");

	        if($getqutationreject){

	            $qutationrejctcount = count($getqutationreject);
	        }else{
	        	$qutationrejctcount='';
	        }

	        	$getqutationapprove =	DB::SELECT("SELECT p1.* FROM PQTN_APPROVE p1 WHERE p1.APPROVE_USER	='$userid' AND p1.APPROVE_STATUS='1' AND p1.REJECTED_STATUS	='0'");

	        if($getqutationapprove){

	            $qutationapprovecount = count($getqutationapprove);
	        }else{
	        	$qutationapprovecount='';
	        }
	            
			$userStatus = 3;

			$quatation_reocrd1 = DB::table('PQTN_APPROVE')->where('APPROVE_USER',$uid)->where('APPROVE_STATUS',$userStatus)->get()->first();

			if($quatation_reocrd1) {

				$quatationLevel1 = $quatation_record->LEVEL_NO;

				$quatationLevel2 = $quatation_reocrd1->LEVEL_NO;

				$quatationUsr = $quatation_record->APPROVE_USER;

				$quatationUsr1 = $quatation_reocrd1->APPROVE_USER;
				/*echo '<pre>';
				print_r($indentLevel);
				print_r($indentLevel2);
				print_r($indentUsr);
				print_r($indentUsr1);
				echo '</pre>';exit;*/

				if($quatationLevel1 == $quatationLevel2 && $quatationUsr == $quatationUsr1){

					$userData['statusVis2'] = 'TRUE'; 
			//print_r('hi');exit;

					
				}else{

					$userData['statusVis2'] = 'FALSE';

					
				}

			}else{

				$userData['statusVis2'] = 'FALSE';
			}

				
	        $userData['user_approve_qutation'] = DB::SELECT("SELECT p1.*,p2.APPROVE_USER as app_user FROM PQTN_APPROVE p1  LEFT JOIN USER_APPROVE_IND p2 ON p2.APPROVE_USER = p1.APPROVE_IND WHERE p2.USER_CODE='$userid'");


	        /*PURCHASE CONTRACT*/

	        $contract_record = DB::table('PCNTR_APPROVE')->where('APPROVE_USER',$uid)->get()->first();

	        $getcontract =	DB::SELECT("SELECT p1.* FROM PCNTR_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0'");

	        $contractcount = count($getcontract);

	        $getcontractreject =	DB::SELECT("SELECT p1.* FROM PCNTR_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='2' OR p1.APPROVE_STATUS='3') AND p1.REJECTED_STATUS='1'");

	        if($getcontractreject){

	            $contractrejctcount = count($getcontractreject);
	        }else{
	        	$contractrejctcount='';
	        }


	         $getcontractapprove =	DB::SELECT("SELECT p1.* FROM PCNTR_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND p1.APPROVE_STATUS='1' AND p1.REJECTED_STATUS='0'");

	        if($getcontractapprove){

	            $contractapprovecount = count($getcontractapprove);
	        }else{
	        	$contractapprovecount='';
	        }

	            

			$userStatus = 3;

			$contrct_reocrd1 = DB::table('PCNTR_APPROVE')->where('APPROVE_USER',$uid)->where('APPROVE_STATUS',$userStatus)->get()->first();

			//print_r($indent_reocrd1);exit;	

			if ($contrct_reocrd1) {

				$contractLevel  = $contract_record->LEVEL_NO;
				
				$contractLevel1 = $contrct_reocrd1->LEVEL_NO;
				
				$contractUsr    = $contract_record->APPROVE_USER;
				
				$contractUsr1   = $contrct_reocrd1->APPROVE_USER;
				/*echo '<pre>';
				print_r($indentLevel);
				print_r($indentLevel2);
				print_r($indentUsr);
				print_r($indentUsr1);
				echo '</pre>';exit;*/

				if ($contractLevel == $contractLevel1 && $contractUsr == $contractUsr1){

					$userData['statusVis3'] = 'TRUE'; 
			//print_r('hi');exit;

					
				}else{

					$userData['statusVis3'] = 'FALSE';

					
				}

			}else{

				$userData['statusVis3'] = 'FALSE';
			}


	             
	        $userData['user_approve_contract'] = DB::SELECT("SELECT p1.*,p2.APPROVE_USER as app_user FROM PCNTR_APPROVE p1  LEFT JOIN USER_APPROVE_IND p2 ON p2.APPROVE_USER = p1.APPROVE_IND WHERE p2.USER_CODE='$userid'");


	      /*STORE REQUSITION*/

	        $requistion_record = DB::table('SREQ_APPROVE')->where('APPROVE_USER',$uid)->get()->first();

	        $getrequistion =	DB::SELECT("SELECT p1.* FROM SREQ_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0'");

	        $requistioncount = count($getrequistion);

	        $getrequistionreject =	DB::SELECT("SELECT p1.* FROM SREQ_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='2' OR p1.APPROVE_STATUS='3') AND p1.REJECTED_STATUS='1'");

	        if($getrequistionreject){

	            $requistionrejctcount = count($getrequistionreject);
	        }else{
	        	$requistionrejctcount='';
	        }


	         $getrequistionapprove =	DB::SELECT("SELECT p1.* FROM SREQ_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND p1.APPROVE_STATUS='1' AND p1.REJECTED_STATUS='0'");

	        if($getrequistionapprove){

	            $requistionapprovecount = count($getrequistionapprove);
	        }else{
	        	$requistionapprovecount='';
	        }

	            

			$userStatus = 3;

			$requistion_reocrd1 = DB::table('SREQ_APPROVE')->where('APPROVE_USER',$uid)->where('APPROVE_STATUS',$userStatus)->get()->first();

			//print_r($requistion_record);exit;	

			if ($requistion_reocrd1) {

				$requistionLevel  = $requistion_record->LEVEL_NO;
				
				$requistionLevel1 = $requistion_reocrd1->LEVEL_NO;
				
				$requistionUsr    = $requistion_record->APPROVE_USER;
				
				$requistionUsr1   = $requistion_reocrd1->APPROVE_USER;
				/*echo '<pre>';
				print_r($indentLevel);
				print_r($indentLevel2);
				print_r($indentUsr);
				print_r($indentUsr1);
				echo '</pre>';exit;*/

				if ($requistionLevel == $requistionLevel1 && $requistionUsr == $requistionUsr1){

					$userData['statusVis4'] = 'TRUE'; 
			//print_r('hi');exit;

					
				}else{

					$userData['statusVis4'] = 'FALSE';

					
				}

			}else{

				$userData['statusVis4'] = 'FALSE';
			}

			//print_r($userData['statusVis1']);exit;

	         
	        $userData['user_approve_requistion'] = DB::SELECT("SELECT p1.*,p2.APPROVE_USER as app_user FROM SREQ_APPROVE p1  LEFT JOIN USER_APPROVE_IND p2 ON p2.APPROVE_USER = p1.APPROVE_IND WHERE p2.USER_CODE='$userid'");

	        /* END :: STORE REQUISTION*/


	        /* SALE ORDER APPROVE */

	        $saleorder_reocrd = DB::table('SORDER_APPROVE')->where('APPROVE_USER',$uid)->get()->first();

	        $getsaleorder =	DB::SELECT("SELECT p1.* FROM SORDER_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0'");

	        $saleordercount = count($getsaleorder);

	        $getsaleorderreject =	DB::SELECT("SELECT p1.* FROM SORDER_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='2' OR p1.APPROVE_STATUS='3') AND p1.REJECTED_STATUS='1'");

	        if($getsaleorderreject){

	            $saleorderrejectcount = count($getsaleorderreject);
	        }else{
	        	$saleorderrejectcount='';
	        }


	         $getsaleorderapprove =	DB::SELECT("SELECT p1.* FROM SORDER_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND p1.APPROVE_STATUS='1' AND p1.REJECTED_STATUS='0'");

	        if($getsaleorderapprove){

	            $saleorderapprovecount = count($getsaleorderapprove);
	        }else{
	        	$saleorderapprovecount='';
	        }

	            

			$userStatus = 3;

			$saleorder_reocrd1 = DB::table('SORDER_APPROVE')->where('APPROVE_USER',$uid)->where('APPROVE_STATUS',$userStatus)->get()->first();

			//print_r($indent_reocrd1);exit;	

			if ($saleorder_reocrd1) {

				$saleorderLevel  = $saleorder_reocrd->LEVEL_NO;
				
				$saleorderLevel1 = $saleorder_reocrd1->LEVEL_NO;
				
				$saleorderUsr    = $saleorder_reocrd->APPROVE_USER;
				
				$saleorderUsr1   = $saleorder_reocrd1->APPROVE_USER;
				/*echo '<pre>';
				print_r($indentLevel);
				print_r($indentLevel2);
				print_r($indentUsr);
				print_r($indentUsr1);
				echo '</pre>';exit;*/

				if ($saleorderLevel == $saleorderLevel1 && $saleorderUsr == $saleorderUsr1){

					$userData['statusVis5'] = 'TRUE'; 
			//print_r('hi');exit;

					
				}else{

					$userData['statusVis5'] = 'FALSE';

					
				}

			}else{

				$userData['statusVis5'] = 'FALSE';
			}

			//print_r($userData['statusVis1']);exit;

	         
	        $userData['user_approve_saleorder'] = DB::SELECT("SELECT p1.*,p2.APPROVE_USER as app_user FROM SORDER_APPROVE p1  LEFT JOIN USER_APPROVE_IND p2 ON p2.APPROVE_USER = p1.APPROVE_IND WHERE p2.USER_CODE='$userid'");

	        /* END :: store requistion*/
	        /* sale order approve */

	         /* Start Task Approve */

	         $task_reocrd = DB::table('EMP_SCOREAPPROVE')->where('APPROVE_USER',$uid)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->first();

	         // count pending task

	         $checkData = DB::table('EMP_SCORECARD')->where('EMP_CODE',$uid)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get();

	         $scoreApp =  DB::table('EMP_SCOREAPPROVE')->where('APPROVE_USER',$uid)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get();

	         $countData = count($checkData);
	         $countscoreApp = count($scoreApp);

	         if($countData > 0 ){

	      
	           $getTask = DB::SELECT("SELECT p2.*,p1.* FROM EMP_SCORECARD p1 LEFT JOIN EMP_SCORETASK p2 ON p2.SCORECARDID = p1.SCORECARDID WHERE p1.EMP_CODE='$userid'  AND p1.FLAG='0' AND p1.COMP_CODE = '$comp_code' AND  p1.FY_CODE= '$fisYear'");
	          
	         }else{
	           
	            $getTask =	DB::SELECT("SELECT p1.* FROM EMP_SCOREAPPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0' AND p1.COMP_CODE = '$comp_code' AND  p1.FY_CODE= '$fisYear'");
	         	
	         }
	         

	        

	        $taskcount = count($getTask);


	        // count reject task

	        $getTaskReject = DB::SELECT("SELECT p1.* FROM EMP_SCOREAPPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='2' OR p1.APPROVE_STATUS='3') AND p1.REJECTED_STATUS='1' AND p1.COMP_CODE = '$comp_code' AND  p1.FY_CODE= '$fisYear'");

	        if($getTaskReject){

	            $taskRejectCount = count($getTaskReject);
	        }else{
	            $taskRejectCount='';
	        }

	        // count approve task

	        $getTaskApprove =	DB::SELECT("SELECT p1.* FROM EMP_SCOREAPPROVE p1 WHERE p1.APPROVE_USER='$userid' AND p1.APPROVE_STATUS='1' AND p1.REJECTED_STATUS='0' AND p1.COMP_CODE = '$comp_code' AND  p1.FY_CODE= '$fisYear'");

	        if($getTaskApprove){

	            $taskApprovecount = count($getTaskApprove);
	        }else{
	            $taskApprovecount='';
	        }

	        $userStatus = 3;
	       
		$task_reocrd1 = DB::table('EMP_SCOREAPPROVE')->where('APPROVE_USER',$uid)->where('APPROVE_STATUS',$userStatus)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->first();

		if ($task_reocrd1) {

			$requistionLevel  = $task_reocrd->LEVEL_NO;
			
			$requistionLevel1 = $task_reocrd1->LEVEL_NO;
			
			$requistionUsr    = $task_reocrd->APPROVE_USER;
			
			$requistionUsr1   = $task_reocrd1->APPROVE_USER;
		        
		        if ($requistionLevel == $requistionLevel1 && $requistionUsr == $requistionUsr1){

					$userData['statusVis4'] = 'TRUE'; 
			}else{

					$userData['statusVis4'] = 'FALSE';

					
			}

		}else{

				$userData['statusVis4'] = 'FALSE';
		}

		$userData['task_approve_requistion'] =DB::SELECT("SELECT p1.*,p3.FUNCTION as userFun,p3.TASK as userTask,p3.WEIGHTAGE as weightage,p3.FUNCTION_SCORE as funScore,p3.SCORECARDID as ScoreCardId,p3.SELF_SCORE as selfscore,p3.FUNCTION_SCORE as fun_score,p3.SLNO as taskSrno,p2.APPROVE_USER as app_user,p4.EMP_CODE as emp_code,p4.EMP_NAME as emp_name FROM EMP_SCOREAPPROVE p1  LEFT JOIN USER_APPROVE_IND p2 ON p2.APPROVE_USER = p1.APPROVE_IND 
			LEFT JOIN EMP_SCORETASK p3 ON p3.SCORECARDID = p1.SCORECARDID  AND  p3.SLNO = p1.SLNO LEFT JOIN EMP_SCORECARD p4 ON p4.SCORECARDID = p1.SCORECARDID WHERE (p2.USER_CODE='$userid' AND p1.COMP_CODE ='$comp_code' AND p1.FY_CODE = '$fisYear') ");

		
	        /* End Task Approve */

	        // START EMP PAYMENT ADVICE

                $payAdvice_reocrd = DB::table('EMPADVICE_TRAN_APPROVE')->where('APPROVE_USER',$uid)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->first();

	         // count pending task

	        $checkData = DB::table('EMPPAYMENT_ADVICE_TRAN')->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get();

	        $empPaymentApp =  DB::table('EMPADVICE_TRAN_APPROVE')->where('APPROVE_USER',$uid)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get();

	        $countData = count($checkData);
	        $countscoreApp = count($empPaymentApp);
	         
                $getPAdvice = DB::SELECT("SELECT p1.* FROM EMPADVICE_TRAN_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='0' OR p1.APPROVE_STATUS='3') AND p1.FLAG='0' AND p1.COMP_CODE = '$comp_code' AND  p1.FY_CODE= '$fisYear'");
	         	
	        $countPAdvice = count($getPAdvice);

	        // payment advice reject

	        $getPAdviceReject = DB::SELECT("SELECT p1.* FROM EMPADVICE_TRAN_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND (p1.APPROVE_STATUS='2' OR p1.APPROVE_STATUS='3') AND p1.REJECTED_STATUS='1' AND p1.COMP_CODE = '$comp_code' AND  p1.FY_CODE= '$fisYear'");

	        if($getPAdviceReject){

	            $adviceRejectCount = count($getPAdviceReject);
	        }else{
	            $adviceRejectCount='';
	        }

	        $pAdviceApprove = DB::SELECT("SELECT p1.* FROM EMPADVICE_TRAN_APPROVE p1 WHERE p1.APPROVE_USER='$userid' AND p1.APPROVE_STATUS='1' AND p1.REJECTED_STATUS='0' AND p1.COMP_CODE = '$comp_code' AND  p1.FY_CODE= '$fisYear'");

	        if($pAdviceApprove){

	            $pApprovecount = count($pAdviceApprove);
	        }else{
	            $pApprovecount='';
	        }

	        $userStatus = 3;
	       
		$payAdvice_reocrd1 = DB::table('EMPADVICE_TRAN_APPROVE')->where('APPROVE_USER',$uid)->where('APPROVE_STATUS',$userStatus)->where('COMP_CODE',$comp_code)->where('FY_CODE',$fisYear)->get()->first();

		if ($payAdvice_reocrd1) {

			$requistionLevel  = $payAdvice_reocrd->LEVEL_NO;
			
			$requistionLevel1 = $payAdvice_reocrd1->LEVEL_NO;
			
			$requistionUsr    = $payAdvice_reocrd->APPROVE_USER;
			
			$requistionUsr1   = $payAdvice_reocrd1->APPROVE_USER;
		        
		        if ($requistionLevel == $requistionLevel1 && $requistionUsr == $requistionUsr1){

					$userData['statusVis4'] = 'TRUE'; 
			}else{

					$userData['statusVis4'] = 'FALSE';

					
			}

		}else{

				$userData['statusVis4'] = 'FALSE';
		}

		$userData['payment_approve_requistion'] =DB::SELECT("SELECT p1.*,p3.* FROM EMPADVICE_TRAN_APPROVE p1  LEFT JOIN USER_APPROVE_IND p2 ON p2.APPROVE_USER = p1.APPROVE_IND 
			LEFT JOIN EMPPAYMENT_ADVICE_TRAN p3 ON p3.ID = p1.ADVICEHEADID  AND  p3.SLNO = p1.SLNO  WHERE (p2.USER_CODE='$userid' AND p1.COMP_CODE ='$comp_code' AND p1.FY_CODE = '$fisYear') ");

	        // END EMP PAYMENT ADVICE


	        if(isset($compName)){
	        	return view('admin.finance.transaction.user_approval_list',$userData+compact('approvalcount','orderrejctcount','orderapprovecount','pendingbillcount','billrejctcount','billapprovecount','indnetcount','indnetrejctcount','indnetapprovecount','quatationcount','qutationrejctcount','qutationapprovecount','requistioncount','requistionrejctcount','requistionapprovecount','contractapprovecount','contractcount','contractrejctcount','saleordercount','saleorderrejectcount','saleorderapprovecount','taskcount','taskRejectCount','taskApprovecount','countPAdvice','adviceRejectCount','pApprovecount'));
	       /*return view('admin.finance.transaction.view_approve_user_ind');*/
	        }else{
				return redirect('/useractivity');
			}
        }else{

             $emptasklist = DB::select("SELECT p2.*,p1.EMP_CODE as ECODE FROM EMP_SCORECARD p1 LEFT JOIN EMP_SCORETASK p2 ON p2.SCORECARDID = p1.SCORECARDID WHERE(p1.EMP_CODE = '$uid' AND p1.COMP_CODE ='$comp_code' AND p1.FY_CODE ='$fisYear') ");
             
        	return view('admin.finance.transaction.hrm.single_user_tasklist',compact('emptasklist'));
        }

	}

/* ---------- START : CREADIT NOTE -----------*/
	
	public function CreditNoteTransaction(Request $request){

		$title      ='Add Credit Note';

		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'P7'])->get();
		//dd(DB::getQueryLog());

		$userdata['tax_code_list'] = DB::table('MASTER_TAX')
					->select('MASTER_TAX.*', 'MASTER_TAXRATE.*')
	           		->leftjoin('MASTER_TAXRATE', 'MASTER_TAXRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
	           		->groupBy('MASTER_TAXRATE.TAX_CODE')
	           		->get();
		
		//DB::enableQueryLog();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		$userdata['getplant']       = DB::table('MASTER_PLANT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']      = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

		$userdata['bill_no']        = DB::table('PBILL_HEAD')->get();
		
		$getdate                    = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;
		$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		$purchase = DB::table('CRNOTE_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->get();

		   	$vrseqnum = '';
			foreach ($purchase as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;

			$tranHeadL = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE','P7')->get();

   		      $userdata['trans_head'] =$tranHeadL[0]->TRAN_CODE;
			
			//print_r(expression)
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE ='$getcompcode'  AND TRAN_CODE='P7'");
		//	print_r($vr_No_list);exit;
		//dd(DB::getQueryLog());
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userdata['last_num']   = $key->LAST_NO;
					$userdata['to_num']     = $key->TO_NO;
					//$userdata['trans_head'] = $key->TRAN_CODE;
				}

			}else{

					$userdata['last_num']  ='';
					$userdata['to_num']  ='';
					//$userdata['trans_head']  ='';

			}

		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.purchase.credit_note_trans',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}
	}

	public function GetItemByBillNo(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$bill_no = $request->input('bill_no');
	    	/*$contractNo  = $request->input('contractNo');
	    	$quotationNo = $request->input('quotationNo');*/


	    if($bill_no){

	    	 $billNodata =  DB::table('PBILL_HEAD')->where('PARTYBILLNO',$bill_no)->get()->first();

	    	 //print_r($billNodata);exit;
	    	// DB::enableQueryLog();
            $itemDataList =  DB::table('PBILL_BODY')->select('PBILL_BODY.*', 'PBILL_HEAD.PARTYBILLNO','PBILL_HEAD.VRNO')
           		->leftjoin('PBILL_HEAD', 'PBILL_HEAD.VRNO', '=', 'PBILL_BODY.VRNO')
            	->where([['PBILL_HEAD.PARTYBILLNO','=',$bill_no]])
            	->groupBy('PBILL_BODY.TAX_CODE')
            	->get();
            //dd(DB::getQueryLog());

           // print_r($accDataList);exit;

	    }

	    
	    	

    		if($itemDataList){

    			$response_array['response'] = 'success';
	            $response_array['bill_data'] = $billNodata;
	            $response_array['data'] = $itemDataList;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data'] ='';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function GetItemByBillNoTaxCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$bill_no = $request->input('bill_no');
	    	$tax_code = $request->input('tax_code');
	    	/*$contractNo  = $request->input('contractNo');
	    	$quotationNo = $request->input('quotationNo');*/


	    if($bill_no){

	    	 $billNodata =  DB::table('PBILL_HEAD')->where([['PARTYBILLNO','=',$bill_no]])->get()->first();
	    	// DB::enableQueryLog();
            $itemDataList =  DB::table('PBILL_BODY')->select('PBILL_BODY.*', 'PBILL_HEAD.PARTYBILLNO','PBILL_HEAD.VRNO')
           		->leftjoin('PBILL_HEAD', 'PBILL_HEAD.VRNO', '=', 'PBILL_BODY.VRNO')
            	->where([['PBILL_HEAD.PARTYBILLNO','=',$bill_no],['PBILL_BODY.TAX_CODE','=',$tax_code]])
            	->groupBy('PBILL_BODY.ITEM_CODE')
            	->get();
           // dd(DB::getQueryLog());

          //  print_r($itemDataList);exit;

	    }

	    
	    	

    		if($itemDataList && $billNodata){

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemDataList;
	            $response_array['bill_data'] = $billNodata;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data'] ='';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function CreditNoteWoItemTransaction(Request $request){

		$title      ='Add Credit Note';

		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'P7'])->get();
		//dd(DB::getQueryLog());

		$userdata['tax_code_list'] = DB::table('MASTER_TAX')
					->select('MASTER_TAX.*', 'MASTER_TAXRATE.*')
	           		->leftjoin('MASTER_TAXRATE', 'MASTER_TAXRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
	           		->groupBy('MASTER_TAXRATE.TAX_CODE')
	           		->get();
		
		//DB::enableQueryLog();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		$userdata['getplant']       = DB::table('MASTER_PLANT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']      = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->get();
		$userdata['contract_no_list'] = DB::table('PCNTR_HEAD')->get();
		$userdata['quotation_no_list'] = DB::table('PQCS_HEAD')->get();
		
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

		$userdata['bill_no']      = DB::table('PBILL_HEAD')->get();
		
		$getdate                    = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		$userdata['transcData']  = DB::select("SELECT * FROM `MASTER_TRANSACTION` WHERE TRAN_CODE='P7'");

		$purchase = DB::table('CRNOTE_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->get();

		   	$vrseqnum = '';
			foreach ($purchase as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE='$getcompcode' AND TRAN_CODE='P7'");
		//dd(DB::getQueryLog());
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userdata['last_num']  = $key->LAST_NO;
					$userdata['to_num']  = $key->TO_NO;
					$userdata['trans_head']  = $key->TRAN_CODE;
				}

			}else{

					$userdata['last_num']  ='';
					$userdata['to_num']  ='';
					$userdata['trans_head']  ='';

			}

			

		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.purchase.credit_note_woitem_trans',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}
	}

	public function DebitNoteWoItemTransaction(Request $request){

		$title      ='Add Credit Note';

						$CompanyCode                = $request->session()->get('company_name');
						$compcode                   = explode('-', $CompanyCode);
						$getcompcode                =	$compcode[0];
						$macc_year                  = $request->session()->get('macc_year');
						
						$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
						
						$userdata['getacc']         = DB::table('MASTER_ACC')->get();
						//DB::enableQueryLog();
						$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'P6 '])->get();
						//dd(DB::getQueryLog());
						
						$userdata['tax_code_list'] = DB::table('MASTER_TAX')
						->select('MASTER_TAX.*', 'MASTER_TAXRATE.*')
						->leftjoin('MASTER_TAXRATE', 'MASTER_TAXRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
						->groupBy('MASTER_TAXRATE.TAX_CODE')
						->get();
						
						//DB::enableQueryLog();
						$userdata['pfct_list']         = DB::table('MASTER_PFCT')->get();
						$userdata['getplant']          = DB::table('MASTER_PLANT')->get();
						//dd(DB::getQueryLog());
						$userdata['bank_list']         = DB::table('MASTER_BANK')->get();
						$userdata['cost_list']         = DB::table('MASTER_COST')->get();
						
						$userdata['help_item_list']    = DB::table('MASTER_ITEM')->get();
						$userdata['contract_no_list']  = DB::table('PCNTR_HEAD')->get();
						$userdata['quotation_no_list'] = DB::table('PQCS_HEAD')->get();
						
						$userdata['rate_list']         = DB::table('MASTER_RATE_VALUE')->get();
						
						$userdata['bill_no']           = DB::table('PBILL_HEAD')->get();
						
						$getdate                       = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		$userdata['transcData']  = DB::select("SELECT * FROM `MASTER_TRANSACTION` WHERE TRAN_CODE='P6'");


		$purchase = DB::table('DRNOTE_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->get();

		   	$vrseqnum = '';
			foreach ($purchase as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE='$getcompcode' AND TRAN_CODE='P6'");
		//dd(DB::getQueryLog());
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userdata['last_num']  = $key->LAST_NO;
					$userdata['to_num']  = $key->TO_NO;
					$userdata['trans_head']  = $key->TRAN_CODE;
				}

			}else{

					$userdata['last_num']  ='';
					$userdata['to_num']  ='';
					$userdata['trans_head']  ='';

			}


		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.purchase.debit_note_woitem_trans',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}
	}

	public function GetItemByBillNoData(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$bill_no = $request->input('bill_no');
	    	/*$contractNo  = $request->input('contractNo');
	    	$quotationNo = $request->input('quotationNo');*/


	    if($bill_no){
	    	// DB::enableQueryLog();
            $billNodata =  DB::table('PBILL_HEAD')->where([['PARTYBILLNO','=',$bill_no]])->get()->first();

            $itemDataList =  DB::table('PBILL_BODY')->select('PBILL_BODY.*', 'PBILL_HEAD.PARTYBILLNO','PBILL_HEAD.VRNO')
           		->leftjoin('PBILL_HEAD', 'PBILL_HEAD.VRNO', '=', 'PBILL_BODY.VRNO')
            	->where([['PBILL_HEAD.PARTYBILLNO','=',$bill_no]])
            	->groupBy('PBILL_BODY.TAX_CODE')
            	->get();
            //dd(DB::getQueryLog());

           // print_r($accDataList);exit;

	    }

	    
	    	

    		if ($billNodata && $itemDataList) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemDataList;
	            $response_array['bill_data'] = $billNodata;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data'] ='';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function AfieldCalculationCreditNote(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tax_code     = $request->input('tax_code');
			$ItemCode     = $request->input('itemCode');

			$CompanyCode  = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$userid       = $request->session()->get('userid');

			//print_r($ItemCode);exit;
			//DB::enableQueryLog();
	    	if($tax_code){
	    		//DB::enableQueryLog();
						$transcode_list = DB::table('MASTER_TAXRATE')
						->join('MASTER_TAXIND', 'MASTER_TAXRATE.TAXIND_CODE', '=', 'MASTER_TAXIND.TAXIND_CODE')
						->select('MASTER_TAXRATE.*', 'MASTER_TAXIND.TAXIND_NAME','MASTER_TAXIND.TAXIND_BLOCK','MASTER_TAXIND.TAXIND_CODE as taxindcode')
						->where([['MASTER_TAXRATE.TAX_CODE','=',$tax_code]])
						->orderBy('TAX_CODE','ASC')
						->get();
	    	}
            

             $ratevalue = DB::table('MASTER_RATE_VALUE')->get();

            //dd(DB::getQueryLog());
	    	$count = count($transcode_list);

	    	//print_r($count);exit;

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

    public function AfieldCalculationCreditNoteWoItem(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tax_code     = $request->input('tax_code');
			//$ItemCode     = $request->input('itemCode');

			$CompanyCode  = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$userid       = $request->session()->get('userid');

			//print_r($ItemCode);exit;
			//DB::enableQueryLog();
	    	if($tax_code){
	    		//DB::enableQueryLog();
	    		
	    		$transcode_list = DB::table('MASTER_TAXRATE')
			            ->join('MASTER_TAXIND', 'MASTER_TAXRATE.TAXIND_CODE', '=', 'MASTER_TAXIND.TAXIND_CODE')
			            ->select('MASTER_TAXRATE.*', 'MASTER_TAXIND.TAXIND_NAME','MASTER_TAXIND.TAXIND_BLOCK')
			            ->where([['MASTER_TAXRATE.TAX_CODE','=',$tax_code]])
			            ->orderBy('TAX_CODE','ASC')
			            ->get();
	    	}
            

             $ratevalue = DB::table('MASTER_RATE_VALUE')->get();

            //dd(DB::getQueryLog());
	    	$count = count($transcode_list);

	    	//print_r($transcode_list);exit;

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

    public function SaveCreditNote(Request $request){

   	//print_r($request->post());exit;

	$createdBy        = $request->session()->get('userid');
	$compName         = $request->session()->get('company_name');
	$fisYear          =  $request->session()->get('macc_year');
	$comp_nameval     = $request->session()->get('company_name');
	$explode          = explode('-', $comp_nameval);
	$getcom_code      = $explode[0];
	$fy_year          = $request->input('fy_year');
	$pfct_code        = $request->input('pfct_code');
	$trans_code       = $request->input('trans_code');
	$series_code      = $request->input('series_code');
	$series_name      = $request->input('series_name');
	//print_r($series_code);exit;
	$vr_no            = $request->input('vr_no');
	
	$trans_date       = $request->input('trans_date');
	$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
	
	$duedate          = $request->input('gatedue_date');
	$getduedate       = date("Y-m-d", strtotime($duedate));
	
	$accountCode      = $request->input('accountCode');
	$accountName      = $request->input('accountName');
	$plant_code       = $request->input('plant_code');
	$plant_name       = $request->input('plant_name');
	$tax_code         = $request->input('tax_code');
	$tax_byitem       = $request->input('tax_byitem');
	
	$amtByItem        = $request->input('amtByItem');
	$item_code        = $request->input('item_code');
	//print_r($item_code);exit;
	$countItemCode    = count($item_code);
	//print_r($countItemCode);exit();
	$item_name        = $request->input('item_name');
	$itemQcContra     = $request->input('itemQcContra');
	$item_codech      = $request->input('item_codech');
	$remark           = $request->input('remark');
	$qty              = $request->input('qty');
	$unit_M           = $request->input('unit_M');
	$Aqty             = $request->input('Aqty');
	$add_unit_M       = $request->input('add_unit_M');
	$rate             = $request->input('rate');
	$basic_amt        = $request->input('basic_amt');
    $hsn_code         = $request->input('hsn_code');	
	$getdatacount     = $request->input('getdatacount');
	$grandAmt_cr      = $request->input('TotalGrandAmt');
	$diff_amt         = $request->input('diff_amt');
	//print_r($count_rate_ind);exit();
	$head_tax_ind     = $request->input('head_tax_ind');
	$tax_ind_code     = $request->input('taxIndID');
	$af_rate          = $request->input('af_rate');
	$amount           = $request->input('amount');
	$data_Count       = $request->input('data_Count');
	//print_r($data_Count);
	$rate_ind         = $request->input('rate_ind');
	//$count_rate_ind = count($rate_ind);
	$logicget         = $request->input('logicget');
	$staticget        = $request->input('staticget');
	$tax_gl_code        = $request->input('taxGlCode');

	
	$PEnqH = DB::select("SELECT MAX(CRNOTEHID) as CRNOTEHID FROM CRNOTE_HEAD");
			$head_ID = json_decode(json_encode($PEnqH), true); 
		
			if(empty($head_ID[0]['CRNOTEHID'])){
				$headId = 1;
			}else{
				$headId = $head_ID[0]['CRNOTEHID']+1;
			}		

		//print_r($cQheadId);exit;

			if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('CRNOTE_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}

	$data = array(

			'CRNOTEHID'   =>$headId,
			'COMP_CODE'   =>$getcom_code,
			'FY_CODE'     =>$fisYear,
			'PFCT_CODE'   =>$pfct_code,
			'TRAN_CODE'   =>$trans_code,
			'SERIES_CODE' =>$series_code,
			'SERIES_NAME' =>$series_name,
			'VRNO'        =>$NewVrno,
			'VRDATE'      =>$tr_vr_date,
			'ACC_CODE'    =>$accountCode,
			'ACC_NAME'    =>$accountName,
			'PLANT_CODE'  =>$plant_code,
			'PLANT_NAME'  =>$plant_name,
			'TAX_CODE'    =>$tax_code,
			'CRAMT'       =>$grandAmt_cr,
			'DIFF_AMT'    =>$diff_amt,
			'FLAG'        =>'1',
			'created_by'  =>$createdBy,

		);
	//print_r($data);
	$saveData = DB::table('CRNOTE_HEAD')->insert($data);
	$lastid= DB::getPdo()->lastInsertId();

	$discriptn_page = "Credit note with item trans insert done by user";

	$this->userLogInsert($createdBy,$trans_code,$series_code,$vr_no,$discriptn_page,$accountCode);

		$datalistrray = array();
		$lastid2 =array();

		for ($i=0; $i < $countItemCode ; $i++) { 


			$PEnqB = DB::select("SELECT MAX(CRNOTEBID) as CRNOTEBID FROM CRNOTE_BODY");
				$body_ID = json_decode(json_encode($PEnqB), true); 
		
				if(empty($body_ID[0]['CRNOTEBID'])){
					$bodyId = 1;
				}else{
					$bodyId = $body_ID[0]['CRNOTEBID']+1;
				}

			$data_body = array(
			
				'CRNOTEHID'  =>$headId,
				'CRNOTEBID'  =>$bodyId,
				'COMP_CODE'  =>$getcom_code,
				'FY_CODE'    =>$fisYear,
				'TRAN_CODE'  =>$trans_code,
				'VRNO'       =>$NewVrno,
				'SLNO'       =>$i+1,
				'VRDATE'     =>$tr_vr_date,
				'ITEM_CODE'  =>$item_codech[$i],
				'ITEM_NAME'  =>$item_name[$i],
				'UM'         =>$unit_M[$i],
				'UM'         =>$add_unit_M[$i],
				'PARTICULAR' =>$remark[$i],
				'QTYRECD'    =>$qty[$i],
				'AQTYRECD'   =>$Aqty[$i],
				'RATE'       =>$rate[$i],
				'TAX_CODE'   =>$tax_byitem[$i],
				'HSN_CODE'   =>$hsn_code[$i],
				'BASICAMT'   =>$basic_amt[$i],
				'CRAMT'      =>$amtByItem[$i],
				'FLAG'       =>'0',
				'CREATED_BY' =>$createdBy,
			);

			$saveData = DB::table('CRNOTE_BODY')->insert($data_body);


			for ($q=0; $q < $data_Count[$i]; $q++) { 

				$a = array_fill(1, $data_Count[$i], $bodyId);
				$str = implode(',',$a); 
				$last_id = explode(',',$str);

				$datalistrray[]= $last_id[0];

			

			}


			$AcledgerH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
			$AledgID = json_decode(json_encode($AcledgerH), true); 
			if(empty($AledgID[0]['ACCTRANID'])){
				$Aledg_Id = 1;
			}else{
				$Aledg_Id = $AledgID[0]['ACCTRANID']+1;
			}

			$data_led = array(	
						'ACCTRANID'  =>$Aledg_Id,
						'COMP_CODE'  =>$getcom_code,
						'FY_CODE'    =>$fisYear,
						'TRAN_CODE'  =>$trans_code,
						'VRNO'       =>$NewVrno,
						'SLNO'       =>$i+1,
						'VRDATE'     =>$tr_vr_date,
						'PFCT_CODE'  =>$pfct_code,
						'ACC_CODE'   =>$accountCode,
						'ACC_NAME'   =>$accountName,
						'DRAMT'      =>'',
						'CRAMT'      =>$amtByItem[$i],
						'PARTICULAR' =>$remark[$i],
						'CREATED_BY' =>$createdBy,
						
			    	);
			$saveDataLEGD = DB::table('ACC_TRAN')->insert($data_led);


			$getdata = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('PFCT_CODE',$pfct_code)->where('ACC_CODE', $accountCode)->get()->first();

				
				if($getdata){

		            $RDRAMT = $getdata->RDRAMT;
				    $RCRAMT = $getdata->RCRAMT;
				    $YROPDR = $getdata->YROPDR;
				    $YROPCR = $getdata->YROPCR;

				    $debitAmt = $RDRAMT;

				    $creditAmt =  $amtByItem[$i] + $RCRAMT;

				    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);

				  //  print_r($RBAL);exit;

		            $dataarqty = array(
		            	
						'RDRAMT'  => $debitAmt,
						'RCRAMT'  => $creditAmt,
						'RBAL'    => $RBAL,
				
		            );

             $updateData12 = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('PFCT_CODE',$pfct_code)->where('ACC_CODE', $accountCode)->update($dataarqty);

				}else{

					$dataItmBal = array(
						'COMP_CODE' => $getcom_code,
						'FY_CODE'   => $fisYear,
						'PFCT_CODE' => $pfct_code,
						'ACC_CODE'  => $accountCode,
						'RDRAMT'    => '0.000',
						'RCRAMT'    => $amtByItem[$i],
					);

					DB::table('MASTER_ACCBAL')->insert($dataItmBal);
				}



		} /*-- for loop close --*/
			

		if($saveData){
			for ($j=0; $j < $getdatacount; $j++) { 

				$CRnoT = DB::select("SELECT MAX(CRNOTETID) as CRNOTETID FROM CRNOTE_TAX");
					$TaxID = json_decode(json_encode($CRnoT), true);		
					if(empty($TaxID[0]['CRNOTETID'])){
						$taxId = 1;
					}else{
						$taxId = $TaxID[0]['CRNOTETID']+1;
					}


				$data_tax = array(
					'CRNOTEHID'   => $headId,
					'CRNOTEBID'   => $datalistrray[$j],
					'CRNOTETID'   => $taxId,
					'RATE_INDEX'  => $rate_ind[$j],
					'TAXIND_NAME' => $head_tax_ind[$j],
					'TAXIND_CODE' => $tax_ind_code[$j],
					'TAX_LOGIC'   => $logicget[$j],
					'STATIC_IND'  => $staticget[$j],
					'TAXGL_CODE'  => $tax_gl_code[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $amount[$j],
					'CREATED_BY'  => $createdBy,
				);
				
				$saveData2 = DB::table('CRNOTE_TAX')->insert($data_tax);



			
			} /*-- for loop close --*/
		} /*-- if close --*/

			/*$getapprove = DB::table('config_approve')->where(['tran_code'=>$trans_code,'series_code'=>$series_code])->get();*/
		$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->get()->toArray();
			//dd(DB::getQueryLog());
			//print_r($checkvrnoExist);exit;

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

		

		if ($saveData2) {

    			$response_array['response'] = 'success';
	            $response_array['lastid'] = $headId;
	            $response_array['lastheadid'] = $bodyId;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}	
	}

	public function ViewCreditNote(Request $request){

	$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

	        $title ='View Credit Note';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $compName = $request->session()->get('company_name');

	        $fisYear =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	        
	         $data = DB::table('CRNOTE_HEAD')->orderBy('CRNOTEHID','DESC');
	     
	           // print_r($data);

	        }else if($userType=='superAdmin' || $userType=='user'){

	           $data = DB::table('CRNOTE_HEAD')->orderBy('CRNOTEHID','DESC');

	        }
	        else{

	            $data='';
	            
	        }

	    return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();


	    }

	    if(isset($compName)){

	       return view('admin.finance.transaction.purchase.view_credit_note_trans');
	    }else{
			return redirect('/useractivity');
		}
	        
	}

	public function ViewCreditNoteTransChildRow(Request $request){

		$response_array = array();

			$vrno    = $request->input('vrno');
			$headid  =  $request->input('tblid');

		if ($request->ajax()) {

	    
	    	 $ptdata = DB::table('CRNOTE_BODY')->where('VRNO',$vrno)->where('CRNOTEHID',$headid)->get()->toArray();

	  //print_r($ptdata);exit;

    		if($ptdata){

    			$response_array['response'] = 'success';
	            $response_array['data'] = $ptdata;

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

    public function ViewCreditWoItemNote(Request $request){

	$compName = $request->session()->get('company_name');

	     $userdata['rate_list']   = DB::table('MASTER_RATE_VALUE')->get();

	     if($request->ajax()) {

	        $title ='View Credit Note';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $compName = $request->session()->get('company_name');

	        $fisYear =  $request->session()->get('macc_year');



	        if($userType=='admin' || $userType=='Admin'){

	         $data = DB::table('CRNOTE_HEAD')->orderBy('CRNOTEHID','DESC');

	           // print_r($data);

	        }else if($userType=='superAdmin' || $userType=='user'){

	           $data = DB::table('CRNOTE_HEAD')->orderBy('CRNOTEHID','DESC');

	        }
	        else{

	            $data='';
	            
	        }

	    return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();


	    }

	    if(isset($compName)){

	       return view('admin.finance.transaction.purchase.view_credit_note_woitem_trans',$userdata);
	    }else{
			return redirect('/useractivity');
		}
	        
	}

	public function DebitNoteTransaction(Request $request){

		$title      ='Add Debit Note';

		$CompanyCode                = $request->session()->get('company_name');
		$compcode                   = explode('-', $CompanyCode);
		$getcompcode                =	$compcode[0];
		$macc_year                  = $request->session()->get('macc_year');
		
		$userdata['comp_list']      = DB::table('MASTER_COMP')->get();
		
		$userdata['getacc']         = DB::table('MASTER_ACC')->get();
		//DB::enableQueryLog();
		$userdata['series_list']    = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'P6'])->get();
		//dd(DB::getQueryLog());

		$userdata['tax_code_list'] = DB::table('MASTER_TAX')
					->select('MASTER_TAX.*', 'MASTER_TAXRATE.*')
	           		->leftjoin('MASTER_TAXRATE', 'MASTER_TAXRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
	           		->groupBy('MASTER_TAXRATE.TAX_CODE')
	           		->get();
		
		//DB::enableQueryLog();
		$userdata['pfct_list']      = DB::table('MASTER_PFCT')->get();
		$userdata['getplant']       = DB::table('MASTER_PLANT')->get();
		//dd(DB::getQueryLog());
		$userdata['bank_list']      = DB::table('MASTER_BANK')->get();
		$userdata['cost_list']      = DB::table('MASTER_COST')->get();
		
		$userdata['help_item_list'] = DB::table('MASTER_ITEM')->get();
		
		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

		$userdata['bill_no']      = DB::table('PBILL_HEAD')->get();
		
		$getdate                    = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		//print_r($getdate);exit;

		foreach ($getdate as $key) {
					$userdata['fromDate'] =  $key->FY_FROM_DATE;
					$userdata['toDate']   =  $key->FY_TO_DATE;
					}

		$userdata['transcData']  = DB::select("SELECT * FROM `MASTER_TRANSACTION` WHERE TRAN_CODE='P6'");


		$purchase = DB::table('DRNOTE_HEAD')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$macc_year)->get();

		   	$vrseqnum = '';
			foreach ($purchase as $key) {
				$vrseqnum =  $key->VRNO;
			}
			$userdata['vrNumber'] =$vrseqnum;
			//DB::enableQueryLog();
		$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE='$getcompcode' AND TRAN_CODE='P6'");
		//dd(DB::getQueryLog());
			if(!empty($vr_No_list)){

				foreach ($vr_No_list as $key) {
					$userdata['last_num']  = $key->LAST_NO;
					$userdata['to_num']  = $key->TO_NO;
					$userdata['trans_head']  = $key->TRAN_CODE;
				}

			}else{

					$userdata['last_num']  ='';
					$userdata['to_num']  ='';
					$userdata['trans_head']  ='';

			}


		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.purchase.debit_note_trans',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}
	}
/* ---------- END : CREADIT NOTE -----------*/

	public function SaveDebitNote(Request $request){

	   	//print_r($request->post());exit;

		$createdBy        = $request->session()->get('userid');
		$compName         = $request->session()->get('company_name');
		$fisYear          = $request->session()->get('macc_year');
		$comp_nameval     = $request->session()->get('company_name');
		$explode          = explode('-', $comp_nameval);
		$getcom_code      = $explode[0];
		$fy_year          = $request->input('fy_year');
		$pfct_code        = $request->input('pfct_code');
		$trans_code       = $request->input('trans_code');
		$series_code      = $request->input('series_code');
		$series_name      = $request->input('series_name');
		//print_r($series_code);exit;
		$vr_no            = $request->input('vr_no');
		
		$trans_date       = $request->input('trans_date');
		$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
		
		$duedate          = $request->input('gatedue_date');
		$getduedate       = date("Y-m-d", strtotime($duedate));
		
		$accountCode      = $request->input('accountCode');
		$accountName      = $request->input('accountName');
		$plant_code       = $request->input('plant_code');
		$plant_name       = $request->input('plant_name');
		$tax_code         = $request->input('tax_code');
		$tax_byitem       = $request->input('tax_byitem');
		
		$amtByItem        = $request->input('amtByItem');
		$item_code        = $request->input('item_code');
		//print_r($item_code);exit;
		$countItemCode    = count($item_code);
		//print_r($countItemCode);exit();
		$item_name        = $request->input('item_name');
		$itemQcContra     = $request->input('itemQcContra');
		$item_codech      = $request->input('item_codech');
		$remark           = $request->input('remark');
		$qty              = $request->input('qty');
		$unit_M           = $request->input('unit_M');
		$Aqty             = $request->input('Aqty');
		$add_unit_M       = $request->input('add_unit_M');
		$rate             = $request->input('rate');
		$basic_amt        = $request->input('basic_amt');
	    $hsn_code         = $request->input('hsn_code');	
		$getdatacount     = $request->input('getdatacount');
		$grandAmt_cr      = $request->input('TotalGrandAmt');
		$diff_amt         = $request->input('diff_amt');
		//print_r($count_rate_ind);exit();
		$head_tax_ind     = $request->input('head_tax_ind');
		$tax_ind_code     = $request->input('taxIndID');
		$af_rate          = $request->input('af_rate');
		$amount           = $request->input('amount');
		$data_Count       = $request->input('data_Count');
		//print_r($data_Count);
		$rate_ind         = $request->input('rate_ind');
		//$count_rate_ind = count($rate_ind);
		$logicget         = $request->input('logicget');
		$staticget        = $request->input('staticget');
		$tax_gl_code      = $request->input('taxGlCode');

		
				

		$PEnqH = DB::select("SELECT MAX(DRNOTEHID) as DRNOTEHID FROM DRNOTE_HEAD");
			$head_ID = json_decode(json_encode($PEnqH), true); 
			
			if(empty($head_ID[0]['DRNOTEHID'])){
					$headId = 1;
			}else{
					$headId = $head_ID[0]['DRNOTEHID']+1;
			}	


			if($vr_no == ''){
				$vrNum = 1;
			}else{
				$vrNum = $vr_no;
			}


			$vrno_Exist = DB::table('DRNOTE_HEAD')->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->where('VRNO',$vrNum)->get()->toArray();

			if($vrno_Exist){
				$NewVrno = $vrNum +1;
			}else{
				$NewVrno = $vrNum;
			}	


		$data = array(

				'DRNOTEHID'   =>$headId,
				'COMP_CODE'   =>$getcom_code,
				'FY_CODE'     =>$fisYear,
				'PFCT_CODE'   =>$pfct_code,
				'TRAN_CODE'   =>$trans_code,
				'SERIES_CODE' =>$series_code,
				'SERIES_NAME' =>$series_name,
				'VRNO'        =>$NewVrno,
				'VRDATE'      =>$tr_vr_date,
				'ACC_CODE'    =>$accountCode,
				'ACC_NAME'    =>$accountName,
				'PLANT_CODE'  =>$plant_code,
				'PLANT_NAME'  =>$plant_name,
				'TAX_CODE'    =>$tax_code,
				'DRAMT'       =>$grandAmt_cr,
				'DIFF_AMT'    =>$diff_amt,
				'FLAG'        =>'1',
				'CREATED_BY'  =>$createdBy,

			);
		//print_r($data);
		$saveData = DB::table('DRNOTE_HEAD')->insert($data);
		$lastid= DB::getPdo()->lastInsertId();

			$datalistrray = array();
			$lastid2 =array();

		$discriptn_page = "debit note with item trans insert done by user";

		$this->userLogInsert($createdBy,$trans_code,$series_code,$vr_no,$discriptn_page,$accountCode);

			for ($i=0; $i < $countItemCode ; $i++) { 

				$PEnqB = DB::select("SELECT MAX(DRNOTEBID) as DRNOTEBID FROM DRNOTE_BODY");
					$body_ID = json_decode(json_encode($PEnqB), true); 
			
					if(empty($body_ID[0]['DRNOTEBID'])){
						$bodyId = 1;
					}else{
						$bodyId = $body_ID[0]['DRNOTEBID']+1;
					}

				$data_body = array(
				
					'DRNOTEHID'  =>$headId,
					'DRNOTEBID'  =>$bodyId,
					'COMP_CODE'  =>$getcom_code,
					'FY_CODE'    =>$fisYear,
					'TRAN_CODE'  =>$trans_code,
					'VRNO'       =>$NewVrno,
					'SLNO'       =>$i+1,
					'VRDATE'     =>$tr_vr_date,
					'ITEM_CODE'  =>$item_codech[$i],
					'ITEM_NAME'  =>$item_name[$i],
					'UM'         =>$unit_M[$i],
					'AUM'        =>$add_unit_M[$i],
					'PARTICULAR' =>$remark[$i],
					'QTYISSUED'  =>$qty[$i],
					'AQTYISSUED' =>$Aqty[$i],
					'RATE'       =>$rate[$i],
					'TAX_CODE'   =>$tax_byitem[$i],
					'HSN_CODE'   =>$hsn_code[$i],
					'BASICAMT'   =>$basic_amt[$i],
					'DRAMT'      =>$amtByItem[$i],
					'FLAG'       =>'0',
					'CREATED_BY' =>$createdBy,
				);

				

				$saveData = DB::table('DRNOTE_BODY')->insert($data_body);


				$lastid1 = DB::getPdo()->lastInsertId();
				$lastid2[]= DB::getPdo()->lastInsertId();

				for ($q=0; $q < $data_Count[$i]; $q++) { 

					$a = array_fill(1, $data_Count[$i], $bodyId);
					$str = implode(',',$a); 
					$last_id = explode(',',$str);

					$datalistrray[]= $last_id[0];

				

				}

			$AcledgerH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
			$AledgID = json_decode(json_encode($AcledgerH), true); 
			if(empty($AledgID[0]['ACCTRANID'])){
				$Aledg_Id = 1;
			}else{
				$Aledg_Id = $AledgID[0]['ACCTRANID']+1;
			}

			$data_led = array(	
						'ACCTRANID'  =>$Aledg_Id,
						'COMP_CODE'  =>$getcom_code,
						'FY_CODE'    =>$fisYear,
						'TRAN_CODE'  =>$trans_code,
						'VRNO'       =>$NewVrno,
						'SLNO'       =>$i+1,
						'VRDATE'     =>$tr_vr_date,
						'PFCT_CODE'  =>$pfct_code,
						'ACC_CODE'   =>$accountCode,
						'ACC_NAME'   =>$accountName,
						'DRAMT'      =>$amtByItem[$i],
						'CRAMT'      =>'',
						'PARTICULAR' =>$remark[$i],
						'CREATED_BY' =>$createdBy,
						
			    	);
			$saveDataLEGD = DB::table('ACC_TRAN')->insert($data_led);


			$getdata = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('PFCT_CODE',$pfct_code)->where('ACC_CODE', $accountCode)->get()->first();

				
				if($getdata){

		            $RDRAMT = $getdata->RDRAMT;
				    $RCRAMT = $getdata->RCRAMT;
				    $YROPDR = $getdata->YROPDR;
				    $YROPCR = $getdata->YROPCR;

				    $debitAmt = $amtByItem[$i] + $RDRAMT;

				    $creditAmt =  $RCRAMT;

				    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);

				  //  print_r($RBAL);exit;

		            $dataarqty = array(
		            	
						'RDRAMT'  => $debitAmt,
						'RCRAMT'  => $creditAmt,
						'RBAL'    => $RBAL,
				
		            );

             $updateData12 = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$getcom_code)->where('FY_CODE',$fisYear)->where('PFCT_CODE',$pfct_code)->where('ACC_CODE', $accountCode)->update($dataarqty);

				}else{

					$dataItmBal = array(
						'COMP_CODE' => $getcom_code,
						'FY_CODE'   => $fisYear,
						'PFCT_CODE' => $pfct_code,
						'ACC_CODE'  => $accountCode,
						'RDRAMT'    => '0.000',
						'RCRAMT'    => $amtByItem[$i],
					);

					DB::table('MASTER_ACCBAL')->insert($dataItmBal);
				}



			} /*-- for loop close --*/
				


			if($saveData){
				for ($j=0; $j < $getdatacount; $j++) { 


					$CRnoT = DB::select("SELECT MAX(DRNOTETID) as DRNOTETID FROM DRNOTE_TAX");
						$TaxID = json_decode(json_encode($CRnoT), true);		
						if(empty($TaxID[0]['DRNOTETID'])){
							$taxId = 1;
						}else{
							$taxId = $TaxID[0]['DRNOTETID']+1;
						}


					$data_tax = array(
						'DRNOTEHID'   => $headId,
						'DRNOTEBID'   => $datalistrray[$j],
						'DRNOTETID'   => $taxId,
						'RATE_INDEX'  => $rate_ind[$j],
						'TAXIND_NAME' => $head_tax_ind[$j],
						'TAXIND_CODE' => $tax_ind_code[$j],
						'TAX_LOGIC'   => $logicget[$j],
						'STATIC_IND'  => $staticget[$j],
						'TAXGL_CODE'  => $tax_gl_code[$j],
						'TAX_RATE'    => $af_rate[$j],
						'TAX_AMT'     => $amount[$j],
						'CREATED_BY'  => $createdBy,
					);

					
					
					$saveData2 = DB::table('DRNOTE_TAX')->insert($data_tax);
				
				} /*-- for loop close --*/
			} /*-- if close --*/

				/*$getapprove = DB::table('config_approve')->where(['tran_code'=>$trans_code,'series_code'=>$series_code])->get();*/
			$checkvrnoExist = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->where('COMP_CODE',$getcom_code)->get()->toArray();
			//dd(DB::getQueryLog());
			//print_r($checkvrnoExist);exit;

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


			

			if ($saveData2) {

	    			$response_array['response'] = 'success';
		            $response_array['lastid'] = $bodyId;
		            $response_array['lastheadid'] = $headId;

		            $data = json_encode($response_array);

		            print_r($data);

				}else{

					$response_array['response'] = 'error';
	                $response_array['data'] = '' ;

	                $data = json_encode($response_array);

	                print_r($data);
					
				}
					
	}

	public function ViewDebitNote(Request $request){

		$compName = $request->session()->get('company_name');

	     if($request->ajax()) {

	        $title ='View Debit Note';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $compName = $request->session()->get('company_name');

	        $fisYear =  $request->session()->get('macc_year');


	        if($userType=='admin' || $userType=='Admin'){

	        
	         $data = DB::table('DRNOTE_HEAD')->where('DRNOTE_HEAD.FLAG','=','1')->orderBy('DRNOTEHID','DESC');
	     
	           // print_r($data);

	        }else if($userType=='superAdmin' || $userType=='user'){

	          $data = DB::table('DRNOTE_HEAD')->where('DRNOTE_HEAD.FLAG','=','1')->orderBy('DRNOTEHID','DESC');
	        }
	        else{

	            $data='';
	            
	        }

	    return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();


	    }

	    if(isset($compName)){

	       return view('admin.finance.transaction.purchase.view_debit_note_trans');
	    }else{
			return redirect('/useractivity');
		}
	        
	}

	public function ViewDebitNoteTransChildRow(Request $request){

		$response_array = array();

			$vrno    = $request->input('vrno');
			$headid  =  $request->input('tblid');

		if ($request->ajax()) {

	    
	    	 $ptdata = DB::table('DRNOTE_BODY')->where('VRNO',$vrno)->where('DRNOTEHID',$headid)->get()->toArray();

	  //print_r($ptdata);exit;

    		if($ptdata){

    			$response_array['response'] = 'success';
	            $response_array['data'] = $ptdata;

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

    public function SaveCreditNoteWoItem(Request $request){

 //	print_r($request->post());exit;

	$createdBy        = $request->session()->get('userid');
	$compName         = $request->session()->get('company_name');
	$fisYear          =  $request->session()->get('macc_year');
	$comp_nameval     = $request->session()->get('company_name');
	$explode          = explode('-', $comp_nameval);
	$getcom_code      = $explode[0];
	$fy_year          = $request->input('fy_year');
	$pfct_code        = $request->input('pfct');
	$trans_code       = $request->input('tran');
	$series_code      = $request->input('series_code');
	//print_r($series_code);exit;
	$vr_no            = $request->input('vro');
	
	$trans_date       = $request->input('vr');
	$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
	
	$duedate          = $request->input('gatedue_date');
	$getduedate       = date("Y-m-d", strtotime($duedate));
	
	$accountCode      = $request->input('AccCode');
	$plant_code       = $request->input('plantcode');
	$tax_code         = $request->input('taxcode');
	$tax_byitem       = $request->input('tax_byitem');
	
	$getdatacount     = $request->input('getdatacount');
	$grandAmt_cr      = $request->input('TotalGrandAmt');
	$diff_amt         = $request->input('diff_amt');
	//print_r($count_rate_ind);exit();
	$head_tax_ind     = $request->input('head_tax_ind');
	$tax_ind_code     = $request->input('taxIndID');
	$af_rate          = $request->input('af_rate');
	$amount           = $request->input('amount');
	$data_Count       = $request->input('data_Count');
	//print_r($data_Count);
	$rate_ind         = $request->input('rate_ind');
	//$count_rate_ind = count($rate_ind);
	$logicget         = $request->input('logicget');
	$staticget        = $request->input('staticget');
	$tax_gl_code      = $request->input('taxGlCode');

	
			

		//print_r($cQheadId);exit;

	$PEnqH = DB::select("SELECT MAX(CRNOTEHID) as CRNOTEHID FROM CRNOTE_HEAD");
			$head_ID = json_decode(json_encode($PEnqH), true); 
		
			if(empty($head_ID[0]['CRNOTEHID'])){
				$headId = 1;
			}else{
				$headId = $head_ID[0]['CRNOTEHID']+1;
			}	

	$data = array(

			'CRNOTEHID'   =>$headId,
			'COMP_CODE'   =>$getcom_code,
			'FY_CODE'     =>$fisYear,
			'PFCT_CODE'   =>$pfct_code,
			'TRAN_CODE'   =>$trans_code,
			'SERIES_CODE' =>$series_code,
			'VRNO'        =>$vr_no,
			'VRDATE'      =>$tr_vr_date,
			'ACC_CODE'    =>$accountCode,
			'PLANT_CODE'  =>$plant_code,
			'TAX_CODE'    =>$tax_code,
			'CRAMT'       =>$grandAmt_cr,
			'DIFF_AMT'    =>$diff_amt,
			'FLAG'        =>'2',
			'CREATED_BY'  =>$createdBy,

		);
	//print_r($data);
	$saveData = DB::table('CRNOTE_HEAD')->insert($data);


	$discriptn_page = "credit note without item trans insert done by user";

	$this->userLogInsert($createdBy,$trans_code,$series_code,$vr_no,$discriptn_page,$accountCode);


		if($saveData){
			for ($j=0; $j < $getdatacount; $j++) { 

				$CRnoT = DB::select("SELECT MAX(CRNOTETID) as CRNOTETID FROM CRNOTE_TAX");
					$TaxID = json_decode(json_encode($CRnoT), true);		
					if(empty($TaxID[0]['CRNOTETID'])){
						$taxId = 1;
					}else{
						$taxId = $TaxID[0]['CRNOTETID']+1;
					}

				$data_tax = array(
					'CRNOTEHID'   => $headId,
					'CRNOTEBID'   => '',
					'CRNOTETID'   => $taxId,
					'RATE_INDEX'  => $rate_ind[$j],
					'TAXIND_NAME' => $head_tax_ind[$j],
					'TAXIND_CODE' => $tax_ind_code[$j],
					'TAX_LOGIC'   => $logicget[$j],
					'STATIC_IND'  => $staticget[$j],
					'TAXGL_CODE'  => $tax_gl_code[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $amount[$j],
					'CREATED_BY'  => $createdBy,
				);
				
				$saveData2 = DB::table('CRNOTE_TAX')->insert($data_tax);
			
			} /*-- for loop close --*/
		} /*-- if close --*/

			/*$getapprove = DB::table('config_approve')->where(['tran_code'=>$trans_code,'series_code'=>$series_code])->get();*/
		$datavr =array(
			'LAST_NO'=>$vr_no
		);
		$updatevr = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->update($datavr);

		

		if ($saveData2) {

    			$response_array['response'] = 'success';
	            $response_array['lastheadid'] = $headId;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}
			
			
	}

	public function SaveDebitNoteWoItem(Request $request){

	 //	print_r($request->post());exit;

		$createdBy        = $request->session()->get('userid');
		$compName         = $request->session()->get('company_name');
		$fisYear          =  $request->session()->get('macc_year');
		$comp_nameval     = $request->session()->get('company_name');
		$explode          = explode('-', $comp_nameval);
		$getcom_code      = $explode[0];
		$fy_year          = $request->input('fy_year');
		$pfct_code        = $request->input('pfct');
		$trans_code       = $request->input('tran');
		$series_code      = $request->input('series_code');
		//print_r($series_code);exit;
		$vr_no            = $request->input('vro');
		
		$trans_date       = $request->input('vr');
		$tr_vr_date       = date("Y-m-d", strtotime($trans_date));
		
		$duedate          = $request->input('gatedue_date');
		$getduedate       = date("Y-m-d", strtotime($duedate));
		
		$accountCode      = $request->input('AccCode');
		$plant_code       = $request->input('plantcode');
		$tax_code         = $request->input('taxcode');
		$tax_byitem       = $request->input('tax_byitem');
		
		$getdatacount     = $request->input('getdatacount');
		$grandAmt_cr      = $request->input('TotalGrandAmt');
		$diff_amt         = $request->input('diff_amt');
		//print_r($count_rate_ind);exit();
		$head_tax_ind     = $request->input('head_tax_ind');
		$tax_ind_code     = $request->input('taxIndID');
		$af_rate          = $request->input('af_rate');
		$amount           = $request->input('amount');
		$data_Count       = $request->input('data_Count');
		//print_r($data_Count);
		$rate_ind         = $request->input('rate_ind');
		//$count_rate_ind = count($rate_ind);
		$logicget         = $request->input('logicget');
		$staticget        = $request->input('staticget');
		$tax_gl_code        = $request->input('taxGlCode');

	
		$PEnqH = DB::select("SELECT MAX(DRNOTEHID) as DRNOTEHID FROM DRNOTE_HEAD");
			$head_ID = json_decode(json_encode($PEnqH), true); 
		
			if(empty($head_ID[0]['DRNOTEHID'])){
				$headId = 1;
			}else{
				$headId = $head_ID[0]['DRNOTEHID']+1;
			}

		$data = array(

		    'DRNOTEHID'   =>$headId,
			'COMP_CODE'   =>$getcom_code,
			'FY_CODE'     =>$fisYear,
			'PFCT_CODE'   =>$pfct_code,
			'TRAN_CODE'   =>$trans_code,
			'SERIES_CODE' =>$series_code,
			'VRNO'        =>$vr_no,
			'VRDATE'      =>$tr_vr_date,
			'ACC_CODE'    =>$accountCode,
			'PLANT_CODE'  =>$plant_code,
			'TAX_CODE'    =>$tax_code,
			'DRAMT'       =>$grandAmt_cr,
			'DIFF_AMT'    =>$diff_amt,
			'FLAG'        =>'2',
			'CREATED_BY'  =>$createdBy,

		);
		//print_r($data);
		$saveData = DB::table('DRNOTE_HEAD')->insert($data);
		$lastid= DB::getPdo()->lastInsertId();

		$discriptn_page = "debit note without item trans insert done by user";

		$this->userLogInsert($createdBy,$trans_code,$series_code,$vr_no,$discriptn_page,$accountCode);

		if($saveData){
			for ($j=0; $j < $getdatacount; $j++) { 

			$DnotT = DB::select("SELECT MAX(DRNOTETID) as DRNOTETID FROM DRNOTE_TAX");
			$tax_ID = json_decode(json_encode($DnotT), true); 
		
			if(empty($tax_ID[0]['DRNOTETID'])){
				$taxId = 1;
			}else{
				$taxId = $tax_ID[0]['DRNOTETID']+1;
			}

				$data_tax = array(
					'DRNOTEHID'   => $headId,
					'DRNOTEBID'   => '',
					'DRNOTETID'   => $taxId,
					'RATE_INDEX'  => $rate_ind[$j],
					'TAXIND_NAME' => $head_tax_ind[$j],
					'TAXIND_CODE' => $tax_ind_code[$j],
					'TAX_LOGIC'   => $logicget[$j],
					'STATIC_IND'  => $staticget[$j],
					'TAXGL_CODE'  => $tax_gl_code[$j],
					'TAX_RATE'    => $af_rate[$j],
					'TAX_AMT'     => $amount[$j],
					'CREATED_BY'  => $createdBy,
				);
				
				$saveData2 = DB::table('DRNOTE_TAX')->insert($data_tax);
			
			} /*-- for loop close --*/
		} /*-- if close --*/

			/*$getapprove = DB::table('config_approve')->where(['tran_code'=>$trans_code,'series_code'=>$series_code])->get();*/
		$datavr =array(
			'LAST_NO'=>$vr_no
		);
		$updatevr = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$trans_code)->update($datavr);

		

		if ($saveData2) {

				$response_array['response']   = 'success';
				$response_array['lastheadid'] = $headId;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}
				
	}

	public function ViewDebitWoItemNote(Request $request){

		$compName = $request->session()->get('company_name');

		$userdata['rate_list']      = DB::table('MASTER_RATE_VALUE')->get();

	     if($request->ajax()) {

	        $title ='View Debit Note';

	        $userid    = $request->session()->get('userid');

	        $userType = $request->session()->get('usertype');

	        $compName = $request->session()->get('company_name');

	        $fisYear =  $request->session()->get('macc_year');



	        if($userType=='admin' || $userType=='Admin'){

	        
	        $data = DB::table('DRNOTE_HEAD')->where('FLAG','=','2')->orderBy('DRNOTEHID','DESC');

	           // print_r($data);

	        }else if($userType=='superAdmin' || $userType=='user'){

	          $data = DB::table('DRNOTE_HEAD')->where('FLAG','=','2')->orderBy('DRNOTEHID','DESC');

	        }
	        else{

	            $data='';
	            
	        }

	    return DataTables::queryBuilder($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();


	    }

	    if(isset($compName)){

	       return view('admin.finance.transaction.purchase.view_debit_note_woitem_trans',$userdata);
	    }else{
			return redirect('/useractivity');
		}
	        
	}

	public function GetBillNoByAcc(Request $request){

		$response_array = array();



		if ($request->ajax()) {

	        $acccode = $request->input('account_code');
	        
	       // DB::enableQueryLog();
	    	/*$Billno = DB::table('PBILL_HEAD')->where([['cr_dr_vrno', '=', null],['cr_dr_slno', '=',null],['ACC_CODE', '=',$acccode]])->get();*/

	    	$Billno = DB::table('PBILL_HEAD')->where([['ACC_CODE', '=',$acccode]])->get();

	    	//dd(DB::getQueryLog());

	    	
	    			
	    	//DB::enableQueryLog();

	    	//print_r($Billno);exit;
	    	

	    	//dd(DB::getQueryLog());
    		if ($Billno) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $Billno;

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

    }

    public function GetTaxDetailByTaxCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$taxCode = $request->input('taxCode');

	    	$taxData = DB::table('master_tax')->where('tax_code', $taxCode)->get()->first();

    		if ($taxData) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $taxData;

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

    public function GetQtyParamFrmpurordrByItm(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$itemCode    = $request->input('itemCode');
			$poheadid    = $request->input('poheadid');
			$pobodyid    = $request->input('pobodyid');
            
            $fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM purchase_order_qua t3 LEFT JOIN purchase_order_body t2 ON t2.id = t3.purchase_order_body_id LEFT JOIN purchase_order_head t1 ON t1.id = t3.purchase_order_head_id WHERE t2.item_code='$itemCode' AND t3.purchase_order_head_id='$poheadid' AND t3.purchase_order_body_id='$pobodyid'");

           

            if ($fetch_qua_reocrd!='') {

				$response_array['response']    = 'success';
				$response_array['data']        = $fetch_qua_reocrd;
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

    public function GetVenderDataFrEnqyiry(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$vrNo    = $request->input('vrNo');
			$headid  = $request->input('headid');
			$bodyid  = $request->input('bodyid');
           // DB::enableQueryLog();
            $fetch_reocrd = DB::table('PENQ_VENDOR')->where('VRNO',$vrNo)->where('PENQHID',$headid)->where('PENQBID',$bodyid)->groupBy('PENQ_VENDOR.ACC_CODE')->get();
          //  dd(DB::getQueryLog());
            

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

/* ---- purchase indent ajax ----*/

	public function GetQPIndent(Request $request){

        $response_array = array();

        $itemcode = $request->input('ItemCode');
        $p_headid = $request->input('headIdP');
        $p_bodyid = $request->input('bodyIdP');
        $hideItem = $request->input('hideItem');
        
        if ($request->ajax()) {

        	if($p_headid && $p_bodyid && $hideItem){

        		$itemcode_get_data = DB::table('PINDENT_QUA')->where('PINDHID',$p_headid)->where('PINDBID',$p_bodyid)->where('ITEM_CODE',$hideItem)->get()->toArray();

        		if(empty($itemcode_get_data)){

        			$itemcode_get = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemcode)->get()->first();

       				$itemcode_get = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode_get->ICATG_CODE)->get()->toArray();
        		}else{
        			$itemcode_get = DB::table('PINDENT_QUA')->where('PINDHID',$p_headid)->where('PINDBID',$p_bodyid)->where('ITEM_CODE',$hideItem)->get();
        		}

        	}else{
        		$itemcode_get = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemcode)->get()->first();

       			$itemcode_get = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode_get->ICATG_CODE)->get()->toArray();
        	}
       
        
           
            if ($itemcode_get) {

                $response_array['response'] = 'success';
                $response_array['data'] = $itemcode_get;
                $response_array['item_code'] = $itemcode;


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

    public function GetQPForPurchaseIndentEdit(Request $request){

        $response_array = array();

		$head_id = $request->input('pHeadId');
		$Body_id = $request->input('pBodyId');
		$srQ = $request->input('q');

        if ($request->ajax()) {
       
        $qp_data = DB::table('purchase_indent_qua')->where('purchase_indent_head_id',$head_id)->where('purchase_indent_body_id',$Body_id)->get();
        //print_r($itemcode_get);exit;

       	//$itemcode_get = DB::table('master_itemcat_qua')->where('item_category',$itemcode_get->item_category)->get()->toArray();
       //	print_r($itemcode_get);exit;
           
            if ($qp_data) {

                $response_array['response'] = 'success';
                $response_array['dataQp'] = $qp_data;
                $response_array['sr_q'] = $srQ;

                $data = json_encode($response_array);

                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['dataQp'] = '' ;
                $response_array['sr_q'] = '' ;

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

/* ---- purchase indent ajax ----*/


/* ---- purchase enquiry ajax ----*/

	public function GetItemEnquiryData(Request $request){

		$response_array = array();

		if ($request->ajax()) {
			$compName = $request->session()->get('company_name');
			$expdCm   = explode('-', $compName);
			$compCd = $expdCm[0];
			$fisYear  =  $request->session()->get('macc_year');
			$itemcode = $request->input('itemcode');
			$indentno = $request->input('indentno');
	    	
	    	$itemData = DB::table('PINDENT_BODY')->where('ITEM_CODE',$itemcode)->where('VRNO',$indentno)->where('COMP_CODE',$compCd)->where('FY_CODE',$fisYear)->get()->first();

	    	$itemfactor = DB::table('MASTER_ITEMUM')->where('ITEM_CODE',$itemcode)->get()->first();

	    	$fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PINDENT_QUA t3 LEFT JOIN PINDENT_BODY t2 ON t2.PINDBID = t3.PINDBID LEFT JOIN PINDENT_HEAD t1 ON t1.PINDHID = t3.PINDHID WHERE t2.ITEM_CODE='$itemData->ITEM_CODE' AND t3.PINDHID='$itemData->PINDHID' AND t3.PINDBID='$itemData->PINDBID'");

	    	if($fetch_qua_reocrd){
            	$fetch_reocrd = $fetch_qua_reocrd;
            }else{
            	$itemcode_get = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemcode)->get()->first();
       
   				$fetch_reocrd = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode_get->ICATG_CODE)->get()->toArray();
            }
	    	
    		if ($itemData && $itemfactor) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $itemData;
	            $response_array['datafactor'] = $itemfactor;
	            $response_array['qp_data'] = $fetch_reocrd;

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

    public function GetIndentData(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$compName = $request->session()->get('company_name');
			$compNm = explode('-', $compName);
			$compcd =$compNm[0];
            $fisYear =  $request->session()->get('macc_year');
	    	$IndentNo = $request->input('IndentNo');

	    	/*$indentData = DB::table('purchase_indent_body')->where('vrno',$IndentNo)->andWhere('enq_tcode','')->get()->toArray();*/

	    	$indentData = DB::select("SELECT * FROM `PINDENT_BODY` WHERE VRNO='$IndentNo' AND PENQHID='0' AND PENQBID='0' AND COMP_CODE='$compcd' AND FY_CODE='$fisYear' AND FLAG IN ('1','3')");

		// print_r($indentData);exit;

    		if ($indentData) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $indentData;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

               // print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function pfct_by_plantcode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$Plant_code = $request->input('Plant_code');
			$compName   = $request->session()->get('company_name');
			$expCm = explode('-', $compName);
			$compCd = $expCm[0];
			$fisYear    =  $request->session()->get('macc_year');
           // DB::enableQueryLog();
           	$indendNum = DB::select("SELECT t1.*,t2.* FROM PINDENT_HEAD t1 LEFT JOIN PINDENT_BODY t2 ON t2.PINDHID = t1.PINDHID WHERE t1.PLANT_CODE='$Plant_code' AND t2.FLAG IN ('1','3') AND t2.PENQHID='0' AND t2.PENQBID='0' AND t2.COMP_CODE='$compCd' AND t2.FY_CODE='$fisYear' GROUP BY t1.VRNO");
          // 	print_r($indendNum);exit;
		//	dd(DB::getQueryLog());
    		if ($indendNum) {

    			$response_array['response'] = 'success';
	            $response_array['indend'] = $indendNum ;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['indend'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['indend'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function GetQtyParametrFrmIndendByItm(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$itemCode  = $request->input('ItemCode');
			$indHeadId = $request->input('indHeadId');
			$indBodyId = $request->input('indBodyId');
           
            $fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PINDENT_QUA t3 LEFT JOIN PINDENT_BODY t2 ON t2.PINDBID = t3.PINDBID LEFT JOIN PINDENT_HEAD t1 ON t1.PINDHID = t3.PINDHID WHERE t2.ITEM_CODE='$itemCode' AND t3.PINDHID='$indHeadId' AND t3.PINDBID='$indBodyId'");

            if($fetch_qua_reocrd){
            	$fetch_reocrd = $fetch_qua_reocrd;
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

    public function GetDataByAccCode(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$AccCode = $request->input('AccCode');
	    
	    	//$accgetdata = DB::table('MASTER_ACC')->where('ACC_CODE',$AccCode)->get()->first();
	    	//DB::enableQueryLog();
	    	 $accgetdata = DB::table('MASTER_ACC')
				->select('MASTER_ACC.*', 'MASTER_ACCADD.*')
           		->leftjoin('MASTER_ACCADD', 'MASTER_ACCADD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->where('MASTER_ACC.ACC_CODE',$AccCode)
           		->get();
           	//dd(DB::getQueryLog());
    		if ($accgetdata) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $accgetdata;

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

/* ---- purchase enquiry ajax ----*/

/* ---- purchase quotation ajax ----*/

	

    public function Get_Item_by_enquiry_UM_AUM(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			$itemCode  = $request->input('ItemCode');
			$enqno     = $request->input('enqno');
			$accCode   = $request->input('accCode');
			$taxCode   = $request->input('taxCode');
			$taxType   = $request->input('taxType');
			$seriesEnq = $request->input('seriesEnq');

			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];
			$fisYear      =  $request->session()->get('macc_year');

	    	$item_um_aum_list = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemCode)->get();

	    	$fetch_hsn_code = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();
	    	if($taxCode == ''){
	    		/*$fetch_tax_code = DB::table('MASTER_HSNRATE')->where('HSN_CODE',$fetch_hsn_code->HSN_CODE)->where('TAX_TYPE',$taxType)->get();*/
	    		//DB::enableQueryLog();
	    		$fetch_tax_code = DB::table('MASTER_HSNRATE')
					->select('MASTER_HSNRATE.*', 'MASTER_TAX.*')
	           		->leftjoin('MASTER_TAX', 'MASTER_HSNRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
	            	->where('MASTER_TAX.TAX_TYPE',$taxType)
	            	->where('MASTER_HSNRATE.HSN_CODE',$fetch_hsn_code->HSN_CODE)
	            	->get();
	    	}else{
	    		/*$fetch_tax_code = DB::table('MASTER_HSNRATE')
					->select('MASTER_HSNRATE.*', 'MASTER_TAX.*')
	           		->leftjoin('MASTER_TAX', 'MASTER_HSNRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
	            	->where('MASTER_TAX.TAX_TYPE',$taxType)
	            	->where('MASTER_HSNRATE.HSN_CODE',$fetch_hsn_code->HSN_CODE)
	            	->get();*/
	           // DB::enableQueryLog();
	            $fetch__code = DB::table('MASTER_HSNRATE')->where('HSN_CODE',$fetch_hsn_code->HSN_CODE)->where('TAX_CODE',$taxCode)->get()->toArray();
	            //dd(DB::getQueryLog());

	            if(empty($fetch__code)){
	            	$fetch_tax_code='';
	            }else{
	            	$fetch_tax_code =$fetch__code;
	            }

	    	}
	    	


	    	$aum_list = DB::table('MASTER_ITEMUM')
					->select('MASTER_ITEMUM.*', 'MASTER_UM.*')
	           		->leftjoin('MASTER_UM', 'MASTER_ITEMUM.AUM_CODE', '=', 'MASTER_UM.UM_CODE')
	            	->where('MASTER_ITEMUM.ITEM_CODE',$itemCode)
	            	->where('MASTER_ITEMUM.UM_CODE',$fetch_hsn_code->UM)
	            	->get();

	        

	        $isquaAply = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$fetch_hsn_code->ICATG_CODE)->get()->toArray();

	       /* if($fetch_hsn_code->hsn_code && $taxCode){
			    		$fetch_tax_code = DB::table('master_hsn_rate')->where('hsn_code',$fetch_hsn_code->hsn_code)->where('tax_code',$taxCode)->get();
			    	}else if($fetch_hsn_code->hsn_code && $taxCode==''){
			    		$fetch_tax_code = DB::table('master_hsn_rate')->where('hsn_code',$fetch_hsn_code->hsn_code)->get();
			    	}*/

	    	if($enqno){
	    			
			    $qtyFrmEnq = DB::select("SELECT t1.*,t2.* FROM PENQ_VENDOR t2 LEFT JOIN PENQ_BODY t1 ON t1.PENQHID = t2.PENQHID AND t1.PENQBID=t2.PENQBID WHERE t1.VRNO='$enqno' AND t1.SERIES_CODE='$seriesEnq' AND t2.ACC_CODE='$accCode' AND t1.ITEM_CODE='$itemCode' AND t1.COMP_CODE='$getcom_code' AND t1.FY_CODE='$fisYear'");
	    	}else{
	    		
	    		$qtyFrmEnq = '';
			    	
	    	}
	    	
    		if ($item_um_aum_list && $fetch_hsn_code && $aum_list|| $isquaAply || $qtyFrmEnq) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_um_aum_list;
	            $response_array['data_hsn'] = $fetch_hsn_code;
	            $response_array['data_enq'] = $qtyFrmEnq;
	            $response_array['data_quaPar'] = $isquaAply;
	            $response_array['aumList'] = $aum_list;
	            $response_array['data_tax'] = $fetch_tax_code;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data_hsn'] = '';
                $response_array['data_enq'] = '';
                 $response_array['data_quaPar'] = '';
                 $response_array['aumList'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data_enq'] = '';
                $response_array['data_hsn'] = '';
                 $response_array['data_quaPar'] = '';
                 $response_array['aumList'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function GetitemByEnquirynum(Request $request){

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

	    		$itemListData = DB::select("SELECT t1.*,t2.* FROM PENQ_VENDOR t2 LEFT JOIN PENQ_BODY t1 ON t1.PENQHID = t2.PENQHID AND t1.PENQBID=t2.PENQBID WHERE t1.VRNO='$enquiryno' AND t2.ACC_CODE='$accnum' AND t2.VRNO='$enquiryno' AND t1.SERIES_CODE='$seriesEnq' AND t1.COMP_CODE='$getcom_code' AND t1.FY_CODE='$fisYear' AND t2.PQTN_FLAG='0'");
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
    public function AfieldCalculationPerQuo(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tax_code     = $request->input('tax_code');
			$ItemCode     = $request->input('ItemCode');
			$purQtnHeadId = $request->input('purQtnHeadId');
			$PurQtnBodyId = $request->input('PurQtnBodyId');
			$CompanyCode  = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$userid       = $request->session()->get('userid');
			//DB::enableQueryLog();
	    	if($ItemCode && $purQtnHeadId && $PurQtnBodyId){
	    		//DB::enableQueryLog();
	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM PQTN_TAX t3 LEFT JOIN PQTN_BODY t2 ON t2.PQTNBID = t3.PQTNBID LEFT JOIN PQTN_HEAD t1 ON t1.PQTNHID = t3.PQTNHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.PQTNHID='$purQtnHeadId' AND t3.PQTNBID='$PurQtnBodyId'");
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

/* ---- purchase quotation ajax ----*/

/* ---- purchase contract ajax ----*/

	public function GetQcNumByAcc(Request $request){

		$response_array = array();

		if($request->ajax()) {

			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];

			$acc_code    = $request->input('acc_code');
			$transDate   = $request->input('vrDate');
			$todate      = date("Y-m-d", strtotime($transDate));
			
			$fisYear     =  $request->session()->get('macc_year');
			$expldeYr    = explode('-', $fisYear);
			$frmDate     = $expldeYr[0].'-04-01';
			
			$stateC      = $request->input('stateCode');
			
			$stateCsessn =  $request->session()->get('state');
			$countryC    =  $request->session()->get('country');

			$itmlist='';

        	$getQcNum = DB::SELECT("SELECT t1.*,t2.*,t3.flag FROM PQCS_BODY t1 LEFT JOIN PQCS_HEAD t2 ON t2.PQCSHID = t1.PQCSHID LEFT JOIN PQTN_BODY t3 ON t3.PQTNBID = t1.PQTNBID WHERE t1.ACC_CODE='$acc_code' AND ( t1.VRDATE BETWEEN '$frmDate' AND '$todate') AND t1.PCNTRHID='0' AND t1.PCNTRBID='0' AND t1.COMP_CODE='$getcom_code' AND t1.FY_CODE='$fisYear' AND t3.FLAG IN ('1','3') GROUP BY t2.PQCSHID");

        	//print_r($getQcNum);exit;

        	if($acc_code){
        		//DB::enableQueryLog();
            	$getAccAddre =  $getAccAddre = DB::select("SELECT a1.*,a2.ACC_CODE AS accCode,a2.ACC_NAME AS accName,a2.ATYPE_CODE AS ATYPE_CODE,a2.CREADIT_LIMIT AS CREADIT_LIMIT FROM MASTER_ACCADD a1 LEFT JOIN MASTER_ACC a2 ON a2.ACC_CODE=a1.ACC_CODE ORDER BY a1.ACC_CODE='$acc_code' DESC");
           		//dd(DB::getQueryLog());
           	}else{
           		$getAccAddre='';
           	}

           	

	        
        	
            if($getQcNum || $getAccAddre) {

				$response_array['response']  = 'success';
				$response_array['data']      = $getQcNum;
				$response_array['shpTo_Add'] = $getAccAddre;
               // $response_array['data_1'] = $pay_Advice_trans;

                $data = json_encode($response_array);

                print_r($data);

            }else{

				$response_array['response']  = 'error';
				$response_array['data']      = '' ;
				$response_array['shpTo_Add'] = '';
               // $response_array['data_1'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
                
            }

        }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['tax_data'] = '';
                 $response_array['statebyAcc'] = '';
                //$response_array['data_1'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
        }

	}
	
	public function GetAccByQcNoForContract(Request $request){

		$response_array = array();

		if($request->ajax()) {
		  $Quotn_compare_no = $request->input('Quotn_compare_no');
		  $account_code = $request->input('account_code');

		  $comp_nameval = $request->session()->get('company_name');
		  $explode      = explode('-', $comp_nameval);
		  $getcom_code  = $explode[0];

		  $fisYear      =  $request->session()->get('macc_year');
		  //DB::enableQueryLog();
        	$acc_code_get = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PQCS_BODY t1 LEFT JOIN MASTER_ACC t2 ON t2.ACC_CODE = t1.ACC_CODE LEFT JOIN PQCS_HEAD t3 ON t3.PQCSHID = t1.PQCSHID WHERE t3.PQCSHID='$Quotn_compare_no' AND t1.ACC_CODE ='$account_code' AND t1.COMP_CODE='$getcom_code' AND t1.FY_CODE='$fisYear' AND t1.PCNTRHID='0' AND t1.PCNTRBID='0' GROUP BY t1.ACC_CODE ");
        	//dd(DB::getQueryLog());
        	
        	///print_r($acc_code_get);

            if($acc_code_get) {

                $response_array['response'] = 'success';
                $response_array['data'] = $acc_code_get;
               // $response_array['data_1'] = $pay_Advice_trans;

                $data = json_encode($response_array);

                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '' ;
               // $response_array['data_1'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
                
            }

        }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data_1'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
        }

	}

	public function GetItemByAccCodeInContract(Request $request){

        $response_array = array();

		$acccode          = $request->input('account_code');
		$Quotn_compare_no = $request->input('Quotn_compare_no');
		$comp_nameval     = $request->session()->get('company_name');
		$explode          = explode('-', $comp_nameval);
		$getcom_code      = $explode[0];
		$fisYear          =  $request->session()->get('macc_year');

       /*$acc_codeQuery = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM master_item_finance t1 LEFT JOIN QCS_body t2 ON t2.item = t1.item_code LEFT JOIN QCS_Head t3 ON t3.id = t2.qcs_head_id WHERE t2.party='$acccode' AND t3.qc_no='$Quotn_compare_no'");*/
      // DB::enableQueryLog();
       $acc_codeQuery = DB::SELECT("SELECT t1.ITEM_CODE as ITEM_CODE,t1.ITEM_NAME as ITEM_NAME,t2.*,t3.* FROM MASTER_ITEM t1 LEFT JOIN PQCS_BODY t2 ON t2.ITEM_CODE = t1.ITEM_CODE LEFT JOIN PQCS_HEAD t3 ON t3.PQCSHID = t2.PQCSHID WHERE t2.ACC_CODE='$acccode' AND t2.COMP_CODE='$getcom_code' AND t2.FY_CODE='$fisYear' AND t3.PQCSHID='$Quotn_compare_no'");
     //  dd(DB::getQueryLog());
       $accDetails = DB::table('MASTER_ACC')->where('ACC_CODE',$acccode)->get()->first();

        //print_r($acc_codeQuery);exit;
		/*
       $acc_codeQuery = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM purchase_quotation_body t1 LEFT JOIN QCS_body t2 ON t2.item = t1.item_code LEFT JOIN QCS_Head t3 ON t3.id = t2.qcs_head_id WHERE t2.party='$acccode' AND t3.qc_no='$Quotn_compare_no' AND t1.flag='1'");*/
        
        if($request->ajax()) {

        	

        	if($acc_codeQuery){
        		$item_code_get = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM MASTER_ITEM t1 LEFT JOIN PQCS_BODY t2 ON t2.ITEM_CODE = t1.ITEM_CODE LEFT JOIN PQCS_HEAD t3 ON t3.PQCSHID = t2.PQCSHID WHERE t2.ACC_CODE='$acccode' AND t2.COMP_CODE='$getcom_code' AND t2.FY_CODE='$fisYear' AND t3.PQCSHID='$Quotn_compare_no'");

        		//print_r('ho');exit;
        	}else{
        		$item_code_get = DB::SELECT("SELECT * FROM MASTER_ITEM");
        		//print_r('hello');exit;
        	}

            if($item_code_get && $accDetails) {

                $response_array['response'] = 'success';
                $response_array['data'] = $item_code_get;
                $response_array['accData'] = $accDetails;
               // $response_array['data_1'] = $pay_Advice_trans;

                $data = json_encode($response_array);

                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['accData'] ='';
               // $response_array['data_1'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
                
            }

        }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['accData'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
        }

    }

    public function GetQtnFrmQuoCompare(Request $request){

        $response_array = array();

        $account_code = $request->input('account_code');
        $Quotn_compare_no = $request->input('Quotn_compare_no');
        $ItemCode = $request->input('ItemCode');
        //print_r($itemGet);exit();
        
        if ($request->ajax()) {

        	/*$getdata = DB::SELECT("SELECT t2.*,t3.* FROM QCS_body t2 LEFT JOIN QCS_Head t3 ON t3.id = t2.qcs_head_id WHERE t2.party='$account_code' AND t3.qc_no='$Quotn_compare_no' AND t2.item='$ItemCode'");*/

        	/*$getdata = DB::SELECT("SELECT t2.*,t3.*,t4.* FROM QCS_body t2 LEFT JOIN QCS_Head t3 ON t3.id = t2.qcs_head_id LEFT JOIN purchase_quotation_tax t4 ON t4.purchase_quotation_head_id=t2.pur_qtn_head_id AND t4.purchase_quotation_body_id=t2.pur_qtn_body_id WHERE t2.party='$account_code' AND t3.qc_no='$Quotn_compare_no' AND t2.item='$ItemCode'");*/

        	$getdata = DB::SELECT("SELECT t2.*,t3.*,t4.*,t5.* FROM PQCS_BODY t2 LEFT JOIN PQCS_HEAD t3 ON t3.PQCSHID = t2.PQCSHID LEFT JOIN PQTN_TAX t4 ON t4.PQTNHID=t2.PQTNHID AND t4.PQTNBID=t2.PQTNBID LEFT JOIN PQTN_HEAD t5 ON t5.PQTNHID = t2.PQTNHID WHERE t2.ACC_CODE='$account_code' AND t3.PQCSHID='$Quotn_compare_no' AND t2.ITEM_CODE='$ItemCode'");

            if ($getdata) {

                $response_array['response'] = 'success';
                $response_array['data'] = $getdata;
               // $response_array['data_1'] = $pay_Advice_trans;

                $data = json_encode($response_array);

                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '' ;
               // $response_array['data_1'] = '' ;

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

    public function purHeadIdOnPayTermContra(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			$purheadId  = $request->input('purheadId');
			$contractNo = $request->input('contractNo');
			$quotationNo = $request->input('quotationNo');
			$transcode  = $request->input('transcode');

	    	if($transcode == 'P2'){

	    		$purheadIdList = DB::select("SELECT a.PMT_TERMS,a.ADV_RATE_I,a.ADV_RATE,a.ADV_AMT,a.PQTNHID,b.PQCS_FLAG FROM `PQTN_BODY` b,PQTN_HEAD a WHERE a.PQTNHID=b.PQTNHID AND b.PQCS_FLAG='$purheadId' GROUP BY a.PQTNHID");
	    	}else if($transcode == 'P3'){
	    		if($quotationNo){
	    			$purheadIdList = DB::select("SELECT a.PMT_TERMS,a.ADV_RATE_I,a.ADV_RATE,a.ADV_AMT,a.PQTNHID,b.PQCS_FLAG FROM `PQTN_BODY` b,PQTN_HEAD a WHERE a.PQTNHID=b.PQTNHID AND b.PQCS_FLAG='$quotationNo' GROUP BY a.PQTNHID");
	    		}else{	
	    			//DB::enableQueryLog();
	    			$purheadIdList = DB::select("SELECT * FROM PCNTR_HEAD WHERE VRNO='$contractNo'");
					//dd(DB::getQueryLog());
	    		}
	    		
	    	}
           
    		if ($purheadIdList) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $purheadIdList;

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

    public function GetQtyParametrFrmPurchaseQuoByItm(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$itemCode    = $request->input('itemCode');
			$pquoHeadId    = $request->input('pquoHeadId');
			$pquobodyId    = $request->input('pquobodyId');
            
            $fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PQTN_TAX t3 LEFT JOIN PQTN_BODY t2 ON t2.PQTNBID = t3.PQTNBID LEFT JOIN PQTN_HEAD t1 ON t1.PQTNHID = t3.PQTNHID WHERE t2.ITEM_CODE='$itemCode' AND t3.PQTNHID='$pquoHeadId' AND t3.PQTNBID='$pquobodyId'");

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

/* ---- purchase contract ajax ----*/

/* ---- purchase order ajax ----*/

	public function getVrnoSeriesBytrans(Request $request){

		$response_array = array();

		$transCode   = $request->input('transCode');
		$CompanyCode = $request->session()->get('company_name');
		$spliCode    = explode('-', $CompanyCode);
		$comp_code   = $spliCode[0];
		$macc_year   = $request->session()->get('macc_year');

		if ($request->ajax()) {

	    	$vr_No_list= DB::select("SELECT * FROM `MASTER_VRSEQ` WHERE COMP_CODE='$comp_code' AND TRAN_CODE='$transCode'");

	    	$purchasevrno = DB::table('PORDER_HEAD')->where('COMP_CODE',$comp_code)->where('TRAN_CODE',$transCode)->get();

	    	$seriesList = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$transCode)->get();
	    	
    		if ($vr_No_list || $purchasevrno || $seriesList) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $vr_No_list;
	            $response_array['datavrno'] = $purchasevrno;
	            $response_array['seriesList'] = $seriesList;

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

    public function GetContraQuoByAcc(Request $request){

		$response_array = array();

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		$fisYear      =  $request->session()->get('macc_year');

	    $acccode = $request->input('account_code');

	    $transDate = $request->input('transDate');
	    $stateC = $request->input('stateCode');

	    $toDate  = date("Y-m-d", strtotime($transDate));
	    $fisYear  =  $request->session()->get('macc_year');
	    $expldeYr = explode('-', $fisYear);
	    $frmDate = $expldeYr[0].'-04-01';
	    

		if ($request->ajax()) {
			//DB::enableQueryLog();
	    	$qcVrno = DB::table('PQCS_BODY')
	    	        ->select('PQCS_BODY.*', 'PQTN_BODY.FLAG')
	    			->leftjoin('PQTN_BODY', 'PQTN_BODY.PQTNBID', '=', 'PQCS_BODY.PQTNBID')
	    			->where('PQTN_BODY.FLAG','1')
            	    ->orwhere('PQTN_BODY.FLAG','3')
            	    ->where('PQCS_BODY.COMP_CODE',$getcom_code)
            	    ->where('PQCS_BODY.FY_CODE',$fisYear)
	    			->where('PQCS_BODY.ACC_CODE', $acccode)
	    			->whereBetween('PQCS_BODY.VRDATE',[$frmDate, $toDate])
	    			->where('PQCS_BODY.PCNTRHID','0')
	            	->where('PQCS_BODY.PCNTRBID','0')
	    			->groupBy('PQCS_BODY.PQCSHID')
	    			->get();
	    		//dd(DB::getQueryLog());
	    	//DB::enableQueryLog();
	    	$contraVrno = DB::select("SELECT `PCNTR_HEAD`.*, `PCNTR_BODY`.* from `PCNTR_HEAD` LEFT JOIN `PCNTR_BODY` on `PCNTR_HEAD`.`PCNTRHID` = `PCNTR_BODY`.`PCNTRHID` WHERE `PCNTR_HEAD`.`ACC_CODE` = '$acccode' AND (`PCNTR_HEAD`.`VRDATE` BETWEEN '$frmDate' AND '$toDate') AND (`PCNTR_BODY`.`FLAG` = '1' or `PCNTR_BODY`.`FLAG` = '3') AND `PCNTR_BODY`.`PORDERHID` = '0' AND PCNTR_BODY.COMP_CODE='$getcom_code' AND PCNTR_BODY.FY_CODE='$fisYear'  AND `PCNTR_BODY`.`PORDERBID` = '0' GROUP BY PCNTR_BODY.VRNO");
	
            $getAccAddre =  DB::select("SELECT a1.*,a2.ACC_CODE AS accCode,a2.ACC_NAME AS accName,a2.ATYPE_CODE AS ATYPE_CODE,a2.CREADIT_LIMIT AS CREADIT_LIMIT FROM MASTER_ACCADD a1 LEFT JOIN MASTER_ACC a2 ON a2.ACC_CODE=a1.ACC_CODE ORDER BY a1.ACC_CODE='$acccode' DESC");
           		
            
	          
	    	//dd(DB::getQueryLog());
    		if ($qcVrno && $contraVrno || $getAccAddre) {

				$response_array['response']    = 'success';
				$response_array['qcdata']      = $qcVrno;
				$response_array['contradata']  = $contraVrno;
				$response_array['acc_adddata'] = $getAccAddre;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['qcdata'] = '' ;
                $response_array['contradata'] = '' ;
                $response_array['tax_data'] ='';
                $response_array['statebyAcc'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['qcdata'] = '' ;
                $response_array['contradata'] = '' ;
                $response_array['tax_data'] ='';
                $response_array['statebyAcc'] = '';


                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function GetItemByQtnNContra(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$account_code = $request->input('account_code');
			$contractNo   = $request->input('contractNo');
			$quotationNo  = $request->input('quotationNo');
			$seriesByTrn  = $request->input('seriesByTrn');

			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];

			$fisYear      =  $request->session()->get('macc_year');

	    if($contractNo){
	    	// DB::enableQueryLog();
            $accDataList =  DB::table('PCNTR_HEAD')->select('PCNTR_HEAD.*', 'MASTER_ACC.*')
           		->leftjoin('MASTER_ACC', 'PCNTR_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
            	->where('PCNTR_HEAD.VRNO','=',$contractNo)
            	->where('PCNTR_HEAD.SERIES_CODE','=',$seriesByTrn)
            	->where('PCNTR_HEAD.COMP_CODE','=',$getcom_code)
            	->where('PCNTR_HEAD.FY_CODE','=',$fisYear)
            	->get();
            //dd(DB::getQueryLog());

	    }else if($quotationNo){

	    	$accDataList =  DB::table('PQCS_BODY')->select('PQCS_BODY.*', 'MASTER_ACC.*')
           		->leftjoin('MASTER_ACC', 'PQCS_BODY.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
            	->where('PQCS_BODY.COMP_CODE','=',$getcom_code)
            	->where('PQCS_BODY.FY_CODE','=',$fisYear)
            	->get();

        }else{

            $accDataList =  DB::table('MASTER_ACC')->get();
        }

	    if($account_code && $contractNo){
	    	//DB::enableQueryLog();
	    	$qtncontr_list = DB::table('PCNTR_HEAD')
				->select('PCNTR_HEAD.*', 'PCNTR_BODY.*','PCNTR_BODY.VRNO AS PCVRNO')
           		->leftjoin('PCNTR_BODY', 'PCNTR_HEAD.PCNTRHID', '=', 'PCNTR_BODY.PCNTRHID')
            	->where([['PCNTR_HEAD.ACC_CODE','=',$account_code],['PCNTR_HEAD.VRNO','=',$contractNo],['PCNTR_HEAD.COMP_CODE','=',$getcom_code],['PCNTR_HEAD.FY_CODE','=',$fisYear]])
            	->get();
            //dd(DB::getQueryLog());
	    }else if($account_code && $quotationNo){
	    	//DB::enableQueryLog();
	    	
           	/*$qtncontr_list = DB::table('QCS_body')
				->select('QCS_body.*', 'master_item_finance.*')
           		->leftjoin('master_item_finance', 'master_item_finance.item_code', '=', 'QCS_body.item')
            	->where([['QCS_body.party','=',$account_code],['QCS_body.qc_no','=',$quotationNo]])
            	->get();*/

            	$qtncontr_list = DB::SELECT("SELECT t1.*,t2.*,t2.PQCSHID as QUOCOMPNO,t2.PQCSBID as PURQCSBID,t2.PQTNHID as PURQNHID,t2.PQTNBID as PURQNBID, t3.* FROM MASTER_ITEM t1 LEFT JOIN PQCS_BODY t2 ON t2.ITEM_CODE = t1.ITEM_CODE LEFT JOIN PQCS_HEAD t3 ON t3.PQCSHID = t2.PQCSHID WHERE t2.ACC_CODE='$account_code' AND t3.PQCSHID='$quotationNo' AND t2.COMP_CODE='$getcom_code' AND t2.FY_CODE='$fisYear' ");
           // dd(DB::getQueryLog());	
	    }else{
	    	$qtncontr_list = DB::table('MASTER_ITEM')->get();

	    }
	    	

    		if ($qtncontr_list && $accDataList) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $qtncontr_list;
	            $response_array['acc_list'] = $accDataList;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['acc_list'] ='';

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['acc_list'] ='';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function AfieldCalculationGetFrmQuoCon(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tax_code     = $request->input('tax_code');
			$ItemCode     = $request->input('ItemCode');
			$purQtnHeadId = $request->input('purQtnHeadId');
			$PurQtnBodyId = $request->input('PurQtnBodyId');
			$headConId    = $request->input('headConId');
			$bodyConId    = $request->input('bodyConId');
			$CompanyCode  = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$userid       = $request->session()->get('userid');
			//DB::enableQueryLog();
	    	if($ItemCode && $purQtnHeadId && $PurQtnBodyId){

	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM PQTN_TAX t3 LEFT JOIN PQTN_BODY t2 ON t2.PQTNBID = t3.PQTNBID LEFT JOIN PQTN_HEAD t1 ON t1.PQTNHID = t3.PQTNHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.PQTNHID='$purQtnHeadId' AND t3.PQTNBID='$PurQtnBodyId'");

	    	}else if($ItemCode && $headConId && $bodyConId){

	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM PCNTR_TAX t3 LEFT JOIN PCNTR_BODY t2 ON t2.PCNTRBID = t3.PCNTRBID LEFT JOIN PCNTR_HEAD t1 ON t1.PCNTRHID = t3.PCNTRHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.PCNTRHID='$headConId' AND t3.PCNTRBID='$bodyConId'");

	    	}else{

	    		$transcode_list = DB::table('MASTER_TAXRATE')
            ->join('MASTER_TAXIND', 'MASTER_TAXRATE.TAXIND_CODE', '=', 'MASTER_TAXIND.TAXIND_CODE')
            ->select('MASTER_TAXRATE.*', 'MASTER_TAXIND.TAXIND_NAME','MASTER_TAXIND.TAXIND_BLOCK')
            ->where([['MASTER_TAXRATE.TAX_CODE','=',$tax_code]])
            ->orderBy('MASTER_TAXRATE.TAX_CODE','ASC')
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

    public function GetQtnFrmQuocontraItm(Request $request){

        $response_array = array();

		$account_code = $request->input('account_code');
		$contractNo   = $request->input('contractNo');
		$quotationNo  = $request->input('quotationNo');
		$ItemCode     = $request->input('ItemCode');
        //print_r($itemGet);exit();
        
        if ($request->ajax()) {

        	if($contractNo && $ItemCode){

        		$qtydata_list = DB::select("SELECT t2.*,t3.*,t4.* FROM PCNTR_TAX t2 
            	LEFT JOIN PCNTR_HEAD t3 ON t3.PCNTRBID = t2.PCNTRBID 
            	LEFT JOIN PCNTR_BODY t4 ON t4.PCNTRBID=t2.PCNTRBID
            	WHERE t3.ACC_CODE='$account_code' AND t3.VRNO='$contractNo' AND t4.ITEM_CODE='$ItemCode'");

        	}else if($quotationNo && $ItemCode){
        		
            	$qtydata_list = DB::select("SELECT t2.*,t3.*,t4.*,t5.* FROM PQCS_BODY t2 
            	LEFT JOIN PQCS_HEAD t3 ON t3.PQCSHID = t2.PQCSHID 
            	LEFT JOIN PQTN_TAX t4 ON t4.PQTNHID=t2.PQTNHID AND t4.PQTNBID=t2.PQTNBID 
            	LEFT JOIN PQTN_HEAD t5 ON t5.PQTNHID = t2.PQTNHID 
            	WHERE t2.ACC_CODE='$account_code' AND t3.PQCSHID='$quotationNo' AND t2.ITEM_CODE='$ItemCode'");
            	
        	}else{
        		$qtydata_list ='';
        	}

        	

            if ($qtydata_list) {

                $response_array['response'] = 'success';
                $response_array['data'] = $qtydata_list;
               // $response_array['data_1'] = $pay_Advice_trans;

                $data = json_encode($response_array);

                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '' ;
               // $response_array['data_1'] = '' ;

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

    public function GetQtyParametrFrmQuoContraByItm(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$itemCode    = $request->input('itemCode');
			$conHeadId    = $request->input('conHeadId');
			$conBodyId    = $request->input('conBodyId');

			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];
			
			$fisYear      =  $request->session()->get('macc_year');
            
            $fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PCNTR_QUA t3 LEFT JOIN PCNTR_BODY t2 ON t2.PCNTRBID = t3.PCNTRBID LEFT JOIN PCNTR_HEAD t1 ON t1.PCNTRHID = t3.PCNTRHID WHERE t2.ITEM_CODE='$itemCode' AND t2.COMP_CODE='$getcom_code' AND t2.FY_CODE='$fisYear' AND t3.PCNTRHID='$conHeadId' AND t3.PCNTRBID='$conBodyId'");

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

/* ---- purchase order ajax ----*/

/* ------- grn ajx ------ */

	public function GetItemByPurOrder(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$account_code = $request->input('account_code');
			$povrno       = $request->input('povrno');
			$series_code  = $request->input('series_code');

			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];

			$fisYear      =  $request->session()->get('macc_year');

	    	//DB::enableQueryLog();
	    	$itmList =  DB::table('PORDER_HEAD')->select('PORDER_HEAD.*', 'MASTER_ACC.*','PORDER_BODY.*')
           		->leftjoin('MASTER_ACC', 'PORDER_HEAD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->leftjoin('PORDER_BODY', 'PORDER_HEAD.PORDERHID', '=', 'PORDER_BODY.PORDERHID')
            	->where([['PORDER_HEAD.VRNO','=',$povrno],['PORDER_HEAD.ACC_CODE','=',$account_code],['PORDER_HEAD.SERIES_CODE','=',$series_code],['PORDER_HEAD.COMP_CODE','=',$getcom_code],['PORDER_HEAD.FY_CODE','=',$fisYear]])
            	->get();
           // dd(DB::getQueryLog());

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

    public function GetPurchaseOrderVrnoByAcc(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$accCode   = $request->input('acc_code');
	    	$transDate = $request->input('transDate');

	    	$vr_date  = date("Y-m-d", strtotime($transDate));
	    	$fisYear  =  $request->session()->get('macc_year');
	    	$expldeYr = explode('-', $fisYear);
	    	$stratDate = $expldeYr[0].'-04-01';
	    	$stateC      = $request->input('stateCode');
	    	 $itmlist = '';

			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];

			$fisYear     =  $request->session()->get('macc_year');

	    	//DB::enableQueryLog();
            $podata = DB::SELECT("SELECT t1.*,t2.* FROM PORDER_HEAD t1 LEFT JOIN PORDER_BODY t2 ON t2.PORDERHID = t1.PORDERHID WHERE t1.ACC_CODE='$accCode' AND (t2.FLAG='1' OR t2.FLAG='3') AND t1.VRDATE BETWEEN '$stratDate' AND '$vr_date' AND t2.GRNHID='0' AND t2.GRNBID='0' AND t2.COMP_CODE='$getcom_code' AND t2.FY_CODE='$fisYear' GROUP BY t2.PORDERHID");
			//dd(DB::getQueryLog());


            	$getAccAddre = DB::select("SELECT a1.*,a2.ACC_CODE AS accCode,a2.ACC_NAME AS accName,a2.ATYPE_CODE AS ATYPE_CODE,a2.CREADIT_LIMIT AS CREADIT_LIMIT FROM MASTER_ACCADD a1 LEFT JOIN MASTER_ACC a2 ON a2.ACC_CODE=a1.ACC_CODE ORDER BY a1.ACC_CODE='$accCode' DESC");
            

              	$get_accGl = DB::table('MASTER_ACC')->where('ACC_CODE',$accCode)->get();

    		if ($podata || $getAccAddre || $get_accGl) {

				$response_array['response']     = 'success';
				$response_array['data']         = $podata;
				$response_array['data_acc_add'] = $getAccAddre;
				$response_array['data_accGl'] = $get_accGl;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response']     = 'error';
				$response_array['data']         = '' ;
				$response_array['data_acc_add'] = '';
				$response_array['data_accGl'] = '';
                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['data_acc_add'] = '';
                $response_array['data_accGl'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function AfieldCalculationForPurOrder(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tax_code     = $request->input('tax_code');
			$ItemCode     = $request->input('itemCode');
			$poHeadId = $request->input('poHeadId');
			$PoBodyId = $request->input('PoBodyId');
			$CompanyCode  = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$userid       = $request->session()->get('userid');
			//DB::enableQueryLog();
	    	if($ItemCode && $poHeadId && $PoBodyId){
	    		//DB::enableQueryLog();
	    		$transcodelist = DB::select("SELECT t1.*,t2.*,t3.* FROM PORDER_TAX t3 LEFT JOIN PORDER_BODY t2 ON t2.PORDERBID = t3.PORDERBID LEFT JOIN PORDER_HEAD t1 ON t1.PORDERHID = t3.PORDERHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.PORDERHID='$poHeadId' AND t3.PORDERBID='$PoBodyId'");
	    		//dd(DB::getQueryLog());
	    		if($transcodelist){
	    			$transcode_list = $transcodelist;
	    		}else{

	    			$transcode_list = DB::table('MASTER_TAXRATE')
			            ->join('MASTER_TAXIND', 'MASTER_TAXRATE.TAXIND_CODE', '=', 'MASTER_TAXIND.TAXIND_CODE')
			            ->select('MASTER_TAXRATE.*', 'MASTER_TAXIND.TAXIND_NAME','MASTER_TAXIND.TAXIND_BLOCK')
			            ->where([['MASTER_TAXRATE.TAX_CODE','=',$tax_code]])
			            ->get();

	    		}



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

    public function QualityParameterGRN(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$itemCode    = $request->input('itemCode');
			$poHeadId    = $request->input('poHeadId');
			$poBodyId    = $request->input('poBodyId');
            
            $fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PORDER_QUA t3 LEFT JOIN PORDER_BODY t2 ON t2.PORDERBID = t3.PORDERBID LEFT JOIN PORDER_HEAD t1 ON t1.PORDERHID = t3.PORDERHID WHERE t2.ITEM_CODE='$itemCode' AND t3.PORDERHID='$poHeadId' AND t3.PORDERBID='$poBodyId'");

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

/* ------- grn ajx ------ */

/* -------- quotation comparism ajx ------- */

	public function GetDataByItmInQuoCompare(Request $request){

        $response_array = array();

        if ($request->ajax()) {
            
           // $quotatn_no    = $request->input('quotatn_no');
            //$quotatn_sl_no = $request->input('quotatn_sl_no');
            $enquiryNo       = $request->input('enquiry_no');
			$splitNo         = explode(' ',$enquiryNo);
			$enquiry_no     = $splitNo[2];
            //print_r($slno);exit;
            $userid        = $request->session()->get('userid');
        
            $fetch_reocrd = DB::SELECT("SELECT p1.*,p2.*,p3.ACC_CODE AS ACC_CODE,p3.ACC_NAME AS ACC_NAME FROM PQTN_HEAD p1 LEFT JOIN PQTN_BODY p2 ON p2.PQTNHID = p1.PQTNHID LEFT JOIN MASTER_ACC p3 ON p3.ACC_CODE = p1.ACC_CODE WHERE p2.PENQ_VRNO='$enquiry_no' AND (p2.FLAG='1' OR  p2.FLAG='3') AND p2.CRAMT !='0.00' AND p1.CREATED_BY='$userid' ORDER BY p2.ITEM_CODE ASC , p2.BASICAMT ASC");

            if ($fetch_reocrd!='') {

                $response_array['response']    = 'success';
                $response_array['data']        = $fetch_reocrd;

                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response']    = 'error';
                $response_array['data']        = '' ;
                $data = json_encode($response_array);
                print_r($data);
                
            }

        }else{

                $response_array['response']  = 'error';
                $response_array['data']      = '';
                $data = json_encode($response_array);
                print_r($data);
        }


    }


/* -------- quotation comparism ajx ------*/

/* ------- purchase bill ajax ------ */
	
	public function GetGlBySeriesInPurchase(Request $request){

		$response_array = array();

		$seriesCode   = $request->input('seriesCode');
		$transcode   = $request->input('transcode');
	   
		if ($request->ajax()) {

	    	 $ptdata = DB::table('MASTER_CONFIG')->where('SERIES_CODE',$seriesCode)->where('TRAN_CODE',$transcode)->get();

    		if ($ptdata) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $ptdata;

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


    public function GetGrnNoByAccInPurBill(Request $request){

		$response_array = array();

	    $accountcode = $request->input('accCode');

		if ($request->ajax()) {

	    	//DB::enableQueryLog();
			$grnno_list = DB::table('GRN_HEAD')->where([['ACC_CODE','=',$accountcode]])->get();
	    	 //dd(DB::getQueryLog());
	            
	        $fetch_acctype = DB::table('MASTER_ACC')->where('ACC_CODE',$accountcode)->get()->first();

	        //$fetch_glCode = DB::table('MASTER_GLKEY')->where('ATYPE_CODE',$fetch_acctype->ATYPE_CODE)->get()->first();
	        //DB::enableQueryLog();
	        $fetch_glCode = DB::table('MASTER_GLKEY')
				->select('MASTER_GLKEY.*', 'MASTER_GL.GL_CODE','MASTER_GL.GL_NAME')
           		->leftjoin('MASTER_GL', 'MASTER_GLKEY.GL_CODE', '=', 'MASTER_GL.GL_CODE')
            	->where('MASTER_GLKEY.ATYPE_CODE',$fetch_acctype->ATYPE_CODE)
            	->get()->first();
            //dd(DB::getQueryLog());


	    	
    		if ($grnno_list || $fetch_glCode) {

				$response_array['response'] = 'success';
				$response_array['data']     = $grnno_list;
				$response_array['glFetch']  = $fetch_glCode;

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

    public function GetGlCodeOfAcc(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$accCode    = $request->input('accCode');
            
            $fetch_acctype = DB::table('MASTER_ACC')->where('ACC_CODE',$accCode)->get()->first();

            $fetch_glCode = DB::table('MASTER_GLKEY')->where('ATYPE_CODE',$fetch_acctype->ATYPE_CODE)->get()->first();


            if ($fetch_glCode!='') {

				$response_array['response']    = 'success';
				$response_array['data']        = $fetch_glCode;
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

    public function AfieldCalculationForPurpurchaseBill(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tax_code     = $request->input('tax_code');
			$srno     = $request->input('w');
			$ItemCode     = $request->input('itemCode');
			$grnHeadId = $request->input('grnHeadId');
			$grnBodyId = $request->input('grnBodyId');
			$CompanyCode  = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$userid       = $request->session()->get('userid');
			//DB::enableQueryLog();
	    	if($ItemCode && $grnHeadId && $grnBodyId){
	    		//DB::enableQueryLog();
	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM GRN_TAX t3 LEFT JOIN GRN_BODY t2 ON t2.GRNBID = t3.GRNBID LEFT JOIN GRN_HEAD t1 ON t1.GRNHID = t3.GRNHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.GRNHID='$grnHeadId' AND t3.GRNBID='$grnBodyId'");
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
	            	$response_array['srno'] = $srno;

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

    public function GetQtyParametrFrmGrnByItm(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$itemCode    = $request->input('itemCode');
			$grn_HeadId    = $request->input('grn_HeadId');
			$grn_BodyId    = $request->input('grn_BodyId');
            
            $fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM GRN_QUA t3 LEFT JOIN GRN_BODY t2 ON t2.GRNBID = t3.GRNBID LEFT JOIN GRN_HEAD t1 ON t1.GRNHID = t3.GRNHID WHERE t2.ITEM_CODE='$itemCode' AND t3.GRNHID='$grn_HeadId' AND t3.GRNBID='$grn_BodyId'");

           

            if ($fetch_qua_reocrd!='') {

				$response_array['response']    = 'success';
				$response_array['data']        = $fetch_qua_reocrd;
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

/* ------- purchase bill ajax ------ */

/* ----- ajax function code -------*/



public function checkItemC_AccC(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	 $itmCode = $request->input('itmCode');
	    	 $itembyac = $request->input('itembyac');
	    	 $enquiry_no = $request->input('enquiry_no');
	    	 $it = $request->input('h');
	    	 $itemCount = $request->input('itemCount');

	    	  $fetch_reocrd = DB::SELECT("SELECT p1.*,p2.*,p3.acc_code AS acc_code,p3.acc_name AS accname FROM purchase_quotation_head p1 LEFT JOIN purchase_quotation_body p2 ON p2.purchase_quotation_head_id = p1.id LEFT JOIN master_party p3 ON p3.acc_code = p1.acc_code WHERE p2.enquiry_no='$enquiry_no' AND p2.item_code='$itmCode' AND p1.acc_code='$itembyac' ORDER BY p1.id ASC");

	    	  $getCount = $itemCount +1;
	    	  $getMinus = $getCount-$it;

	    	// print_r($gl_data);exit();

    		if ($fetch_reocrd) {

    			$response_array['response'] = 'success';
	            $response_array['dataget'] = $fetch_reocrd;
	            $response_array['srno'] = $it;
	            $response_array['itemCount'] = $itemCount;
	            $response_array['getMinus'] = $getMinus;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['dataget'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['dataget'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function GetDataByQuoationNo(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$quotatn_no    = $request->input('quotatn_no');
            //print_r($slno);exit;
        
            $fetch_reocrd = DB::SELECT("SELECT * FROM purchase_quotation_body WHERE vrno='$quotatn_no' ");


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


/* -----common function for purchase ------ */
	
	public function QualityParameterPurchase(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$itemCode   = $request->input('itemCode');
			$pInHeadId  = $request->input('pInHeadId');
			$pInBodyId  = $request->input('pInBodyId');
			$enqHeadId  = $request->input('enqHeadId');
			$enqBodyId  = $request->input('enqBodyId');
			$poHeadId   = $request->input('poHeadId');
			$poBodyId   = $request->input('poBodyId');
			$pquoHeadId = $request->input('pquoHeadId');
			$pquobodyId = $request->input('pquobodyId');
			$conHeadId  = $request->input('conHeadId');
			$conBodyId  = $request->input('conBodyId');
			$formName   = $request->input('formName');
			$srQ        = $request->input('q');

			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];
			
			$fisYear      =  $request->session()->get('macc_year');

			$fetch_qua_reocrd='';
			//$fetch_reocrd='';

			if($pInHeadId && $pInBodyId){

				$fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PINDENT_QUA t3 LEFT JOIN PINDENT_BODY t2 ON t2.PINDBID = t3.PINDBID LEFT JOIN PINDENT_HEAD t1 ON t1.PINDHID = t3.PINDHID WHERE t2.ITEM_CODE='$itemCode' AND t3.COMP_CODE='$getcom_code' AND t3.FY_CODE='$fisYear' AND t3.PINDHID='$pInHeadId' AND t3.PINDBID='$pInBodyId'");

			}else if($enqHeadId && $enqBodyId){
				$fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PENQ_QUA t3 LEFT JOIN PENQ_BODY t2 ON t2.PENQBID = t3.PENQBID LEFT JOIN PENQ_HEAD t1 ON t1.PENQHID = t3.PENQHID WHERE t2.ITEM_CODE='$itemCode' AND t3.COMP_CODE='$getcom_code' AND t3.FY_CODE='$fisYear' AND t3.PENQHID='$enqHeadId' AND t3.PENQBID='$enqBodyId'");
			}else if($pquoHeadId && $pquobodyId){

				$fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PQTN_QUA t3 LEFT JOIN PQTN_BODY t2 ON t2.PQTNBID = t3.PQTNBID LEFT JOIN PQTN_HEAD t1 ON t1.PQTNHID = t3.PQTNHID WHERE t2.ITEM_CODE='$itemCode' AND t3.COMP_CODE='$getcom_code' AND t3.FY_CODE='$fisYear' AND t3.PQTNHID='$pquoHeadId' AND t3.PQTNBID='$pquobodyId'");
				
			}else if($formName == 'GRN'){

				$fetch_qua_reocrd = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PORDER_QUA t3 LEFT JOIN PORDER_BODY t2 ON t2.PORDERBID = t3.PORDERBID LEFT JOIN PORDER_HEAD t1 ON t1.PORDERHID = t3.PORDERHID WHERE t2.ITEM_CODE='$itemCode' AND t3.COMP_CODE='$getcom_code' AND t3.FY_CODE='$fisYear' AND t3.PORDERHID='$poHeadId' AND t3.PORDERBID='$poBodyId'");
			}else{
				$fetch_qua_reocrd ='';
			}

			//print_r($fetch_qua_reocrd);

            if(empty($fetch_qua_reocrd)){

            	$itemcode_get = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();

            	$fetch_reocrd = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode_get->ICATG_CODE)->get()->toArray();
            	
            }else{
            	$fetch_reocrd = $fetch_qua_reocrd;

            }


            if ($fetch_reocrd!='') {

				$response_array['response']  = 'success';
				$response_array['data']      = $fetch_reocrd;
				$response_array['item_code'] = $itemCode;
				$response_array['sr_q']      = $srQ;
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

/* -------- get data on account code ------ */

	public function GetDataByAccPurchase(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$transcode    = $request->input('transcode');
			$account_code = $request->input('account_code');
			$transDate    = $request->input('transDate');
			$shipAddr     = $request->input('addId');
			$plstateCode  = $request->input('plstateCode');
			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];

			$toDate   = date("Y-m-d", strtotime($transDate));
			$fisYear  =  $request->session()->get('macc_year');
			$expldeYr = explode('-', $fisYear);
			$frmDate  = $expldeYr[0].'-04-01';

			if($transcode == 'P1'){

				$enquiry_no_list = DB::table('PENQ_VENDOR')
				->where([['ACC_CODE','=',$account_code],['PQTN_FLAG','=','0']])
				->where('COMP_CODE',$getcom_code)
				->where('FY_CODE',$fisYear)
				->whereBetween('VRDATE',[$frmDate, $toDate])
				->groupBy('VRNO')
            			->get();
			}else{
				$enquiry_no_list='';
			}

			if($account_code){

	           		 $getAccAddre = DB::select("SELECT a1.*,a2.ACC_CODE AS accCode,a2.ACC_NAME AS accName,a2.ATYPE_CODE AS ATYPE_CODE,a2.CREADIT_LIMIT AS CREADIT_LIMIT FROM MASTER_ACCADD a1 LEFT JOIN MASTER_ACC a2 ON a2.ACC_CODE=a1.ACC_CODE ORDER BY a1.ACC_CODE='$account_code' DESC");
	           	}else{
	           		$getAccAddre='';
	           	}

           		if($account_code && $shipAddr){
	           		$getStateCode = DB::table('MASTER_ACCADD')->where('CPCODE',$shipAddr)->get()->first();

	           		$stateOfAcc = $getStateCode->STATE_CODE;

	           		//print_r($stateOfAcc);

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

    			if ($enquiry_no_list || $getAccAddre) {

				$response_array['response']     = 'success';
				$response_array['data']         = $enquiry_no_list;
				$response_array['dataAccAddr']  = $getAccAddre;
				$response_array['getStateCode'] = $getStateCode;
				$response_array['get_taxCode']   = $gettaxCode;

	           		echo $data = json_encode($response_array);

	            		//print_r($data);

			}else{

				$response_array['response']    = 'error';
				$response_array['data']        = '' ;
				$response_array['dataAccAddr'] = '';

                		$data = json_encode($response_array);

                		print_r($data);
				
			}

	    	}else{

	    		$response_array['response'] = 'error';
	                $response_array['data'] = '' ;
	                $response_array['dataTax'] = '';

	                $data = json_encode($response_array);

	                print_r($data);
	    	}

    }

/* -------- get data on account code ------ */

/* -------- get data on tax code ------*/

	public function GetItemByTaxState(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$taxCode          = $request->input('taxCode');
			$enquiryNo        = $request->input('enquiryNo');
			$Quotn_compare_no = $request->input('Quotn_compare_no');
			$contractNo       = $request->input('contractNo');
			$account_code     = $request->input('account_code');
			$poVrno           = $request->input('poVrno');
			$seiresbytrans    = $request->input('seiresbytrans');

			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];

			$fisYear      =  $request->session()->get('macc_year');
	    	//DB::enableQueryLog();
            	if($enquiryNo){

            		$getitem = DB::select("SELECT t1.*,t2.* FROM PENQ_VENDOR t2 LEFT JOIN PENQ_BODY t1 ON t1.PENQHID = t2.PENQHID AND t1.PENQBID=t2.PENQBID WHERE t1.VRNO='$enquiryNo' AND t2.ACC_CODE='$account_code' AND t1.SERIES_CODE='$seiresbytrans' AND t1.COMP_CODE='$getcom_code' AND t1.FY_CODE='$fisYear' AND t2.VRNO='$enquiryNo' AND PQTN_FLAG='0'");
            	}else if($Quotn_compare_no){

            		$getitem = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PQCS_BODY t1 LEFT JOIN MASTER_ACC t2 ON t2.ACC_CODE = t1.ACC_CODE LEFT JOIN PQCS_HEAD t3 ON t3.PQCSHID = t1.PQCSHID WHERE t3.PQCSHID='$Quotn_compare_no' AND t1.ACC_CODE ='$account_code' AND t1.COMP_CODE='$getcom_code' AND t1.FY_CODE='$fisYear' AND t1.PCNTRHID='0' AND t1.PCNTRBID='0'  GROUP BY t1.ACC_CODE ");
            	}else if($contractNo){
            		$getitem = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PCNTR_HEAD t1 LEFT JOIN MASTER_ACC t2 ON t2.ACC_CODE = t1.ACC_CODE LEFT JOIN PCNTR_BODY t3 ON t3.PCNTRHID = t1.PCNTRHID WHERE t1.VRNO='$contractNo' AND t1.ACC_CODE ='$account_code' AND t1.COMP_CODE='$getcom_code' AND t1.FY_CODE='$fisYear' AND t3.PORDERHID='0' AND t3.PORDERBID='0' GROUP BY t1.ACC_CODE ");
            	}else if($poVrno){
            		$getitem = DB::SELECT("SELECT t1.*,t2.*,t3.* FROM PORDER_HEAD t1 LEFT JOIN MASTER_ACC t2 ON t2.ACC_CODE = t1.ACC_CODE LEFT JOIN PORDER_BODY t3 ON t3.PORDERHID = t1.PORDERHID WHERE t1.VRNO='$poVrno' AND t1.ACC_CODE ='$account_code' AND t1.COMP_CODE='$getcom_code' AND t1.FY_CODE='$fisYear' AND t3.GRNHID='0' AND t3.GRNBID='0' GROUP BY t1.ACC_CODE ");
            	}else{
            		//DB::enableQueryLog();
            		$getitem =	DB::SELECT("SELECT t1.*,t2.* FROM MASTER_HSNRATE t1  LEFT JOIN MASTER_ITEM t2 ON t2.HSN_CODE = t1.HSN_CODE WHERE t1.TAX_CODE='$taxCode'");
            		//dd(DB::getQueryLog());
            	}
            	
    		if ($getitem) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $getitem;

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


/* -------- get data on tax code ------*/

/* ------ A field calculation ------- */

	public function AfieldCalculationForPerchase(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tax_code     = $request->input('tax_code');
			$ItemCode     = $request->input('ItemCode');
			$purQtnHeadId = $request->input('purQtnHeadId');
			$PurQtnBodyId = $request->input('PurQtnBodyId');
			$headConId    = $request->input('headConId');
			$bodyConId    = $request->input('bodyConId');
			$poHeadId     = $request->input('poHeadId');
			$PoBodyId     = $request->input('PoBodyId');
			$grnHeadId    = $request->input('grnHeadId');
			$grnBodyId    = $request->input('grnBodyId');
			$CompanyCode  = $request->session()->get('company_name');
			$macc_year    = $request->session()->get('macc_year');
			$userid       = $request->session()->get('userid');
			//print_r('head id'.$purQtnHeadId.' body id '.$PurQtnBodyId);
			//DB::enableQueryLog();
	    	if($ItemCode && $purQtnHeadId && $PurQtnBodyId){
	    		//DB::enableQueryLog();
	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM PQTN_TAX t3 LEFT JOIN PQTN_BODY t2 ON t2.PQTNBID = t3.PQTNBID LEFT JOIN PQTN_HEAD t1 ON t1.PQTNHID = t3.PQTNHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.PQTNHID='$purQtnHeadId' AND t3.PQTNBID='$PurQtnBodyId'");
	    		//dd(DB::getQueryLog());

	    	}else if($ItemCode && $headConId && $bodyConId){

	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM PCNTR_TAX t3 LEFT JOIN PCNTR_BODY t2 ON t2.PCNTRBID = t3.PCNTRBID LEFT JOIN PCNTR_HEAD t1 ON t1.PCNTRHID = t3.PCNTRHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.PCNTRHID='$headConId' AND t3.PCNTRBID='$bodyConId'");

	    	}else if($ItemCode && $poHeadId && $PoBodyId){
	    		//DB::enableQueryLog();
	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM PORDER_TAX t3 LEFT JOIN PORDER_BODY t2 ON t2.PORDERBID = t3.PORDERBID LEFT JOIN PORDER_HEAD t1 ON t1.PORDERHID = t3.PORDERHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.PORDERHID='$poHeadId' AND t3.PORDERBID='$PoBodyId'");
	    	}else if($ItemCode && $grnHeadId && $grnBodyId){
	    		//DB::enableQueryLog();
	    		$transcode_list = DB::select("SELECT t1.*,t2.*,t3.* FROM GRN_TAX t3 LEFT JOIN GRN_BODY t2 ON t2.GRNBID = t3.GRNBID LEFT JOIN GRN_HEAD t1 ON t1.GRNHID = t3.GRNHID WHERE t2.TAX_CODE='$tax_code' AND t2.ITEM_CODE='$ItemCode' AND t3.GRNHID='$grnHeadId' AND t3.GRNBID='$grnBodyId'");
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


/* ------ A field calculation ------- */


/* -------- check data in body for edit page ---------- */

	public function getDataFromBodyPurhase(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$headID    = $request->input('headID');
			$transCODE = $request->input('transCODE');
            
            $bodyD = DB::table('PINDENT_BODY')->where('PINDHID',$headID)->where('TRAN_CODE',$transCODE)->get();

    		if ($bodyD) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $bodyD;

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

/* -------- check data in body for edit page ---------- */

/* -----common function for purchase ------ */


/* ----------- simulation for grn -------------- */
	
	function simulationForGRN(Request $request){

			$itmeCode       = $request->itmeCode;
			$itemCount      = count($itmeCode);
			$taxIndCode     = $request->taxIndCode;
			$taxRowC_byItem = $request->taxRowC_byItem;
			$taxAmount      = $request->taxAmount;
			$rateIndex      = $request->rateIndex;
			$taxGl          = $request->taxGl;
			$seriesGl       = $request->seriesGl;
			$totalTaxRC     = $request->totalTaxRC;
			$glByItem       = $request->glByItem;
			$grAmtByItm     = $request->grAmtByItm;
			$itmWiseGl      = $request->itmWiseGl;
			$userId         = $request->session()->get('userid'); 

			DB::table('SIMULATION_TEMP')->where('TCFLAG','G')->where('CREATED_BY',$userId)->delete();

			for($i =0;$i<$itemCount;$i++){

				$checkExists_Gl = DB::table('SIMULATION_TEMP')->where('TCFLAG','G')->where('IND_CODE','SG')->where('IND_GL_CODE',$seriesGl)->where('CREATED_BY',$userId)->get()->first();
				if($checkExists_Gl){

					$addAmt = $checkExists_Gl->CR_AMT + $grAmtByItm[$i];

					$itmDUp   = array(
	          			'CR_AMT'      => $addAmt,
	              	);

	              	DB::table('SIMULATION_TEMP')->where('IND_CODE','SG')->where('IND_GL_CODE',$seriesGl)->where('TCFLAG','G')->where('CREATED_BY',$userId)->update($itmDUp);
				}else{

					$itmD   = array(
			            'IND_CODE'    => 'SG',
			            'CR_AMT'      => $grAmtByItm[$i],
			            'DR_AMT'      =>'',
			            'IND_GL_CODE' => $seriesGl,
			            'TCFLAG'      => 'G',
			            'CODE_NAME'   => 'Series Gl',
			            'CREATED_BY'  => $userId,
			                  
		            );

		            DB::table('SIMULATION_TEMP')->insert($itmD);
		        }
		    }

		    for ($j=0; $j <$totalTaxRC; $j++) { 

		    	$indData = DB::table('SIMULATION_TEMP')->where('TCFLAG','G')->where('IND_CODE',$taxIndCode[$j])->where('CREATED_BY',$userId)->get()->toArray();
		    	
		    	if($taxAmount[$j] != '' && $taxAmount[$j] !=0.00){

		    		if($rateIndex[$j] == 'Z'){

		    		}else{
		    			if($taxGl[$j] != ''){
			    			if(empty($indData)){
			    				$idary   = array(
					                  'IND_CODE'    => $taxIndCode[$j],
					                  'DR_AMT'      => $taxAmount[$j],
					                  'CR_AMT'      =>'',
					                  'IND_GL_CODE' => $taxGl[$j],
					                  'CODE_NAME'   => 'Tax Gl',
					                  'TCFLAG'      => 'G',
					                  'CREATED_BY'  => $userId,
				                    
				                );

	                        	DB::table('SIMULATION_TEMP')->insert($idary);
			    			}else{

			    				$indData1 = DB::table('SIMULATION_TEMP')->where('TCFLAG','G')->where('IND_CODE',$taxIndCode[$j])->where('CREATED_BY',$userId)->get()->first();

	                        	$newTaxAmt = $indData1->DR_AMT + $taxAmount[$j];

	                            $idary1 = array(
	                              'DR_AMT' => $newTaxAmt,
	                              'CR_AMT' =>'',
	                            );

	                        	$updatevr = DB::table('SIMULATION_TEMP')->where('TCFLAG','G')->where('IND_CODE',$taxIndCode[$j])->where('CREATED_BY',$userId)->update($idary1);
			    			}
		    			}else{

		    				$NoGlD = DB::table('SIMULATION_TEMP')->where('TCFLAG','G')->where('IND_GL_CODE',$itmWiseGl[$j])->where('CREATED_BY',$userId)->get()->first();
		    				if($NoGlD){

		    					$updateId = $NoGlD->CREATED_BY;
		    					$basicAmt = $NoGlD->DR_AMT + $taxAmount[$j];

		    					 $idary_bsic = array(
	                              'DR_AMT'    => $basicAmt,
	                            );

		    					DB::table('SIMULATION_TEMP')->where('TCFLAG','G')->where('IND_GL_CODE',$itmWiseGl[$j])->where('CREATED_BY',$updateId)->update($idary_bsic);

		    				}else{
		    					$noGlIn = array(
									'IND_CODE'    => $taxIndCode[$j],
									'DR_AMT'      => $taxAmount[$j],
									'CR_AMT'      => '',
									'IND_GL_CODE' => $itmWiseGl[$j],
									'CODE_NAME'   => 'Item Type Gl',
									'TCFLAG'      => 'G',
									'CREATED_BY'  => $userId,
				                        
				                );

                        		DB::table('SIMULATION_TEMP')->insert($noGlIn);
		    				}

		    			} /* /. GL BLANK OR NOT*/


		    		} /* /. CHECK RATE INDEX*/

		    	} /* /. AMOUNT NOT BLANK*/

		    } /* /. TAX FOR LOOP*/

			$response_array = array();
      		$taxData = DB::select("SELECT t1.*,t2.GL_NAME as glName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE WHERE t1.TCFLAG='G' AND t1.CREATED_BY='$userId'");

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

	}

/* ----------- simulation for grn -------------- */

/* ------------ direct purchase  bill --------------- */
	
	public function GetordrGrnByAcc(Request $request){

		$response_array = array();

	    $acccode = $request->input('account_code');

	    $transDate = $request->input('transDate');
	    $stateC = $request->input('stateCode');

	    $toDate  = date("Y-m-d", strtotime($transDate));
	    $fisYear  =  $request->session()->get('macc_year');
	    $expldeYr = explode('-', $fisYear);
	    $frmDate = $expldeYr[0].'-04-01';
	    

		if ($request->ajax()) {

	    	//DB::enableQueryLog();
	    	$poVrno = DB::table('PORDER_HEAD')
				->select('PORDER_HEAD.*', 'PORDER_BODY.*')
           		->leftjoin('PORDER_BODY', 'PORDER_HEAD.PORDERHID', '=', 'PORDER_BODY.PORDERHID')
            	->where([['PORDER_HEAD.ACC_CODE','=',$acccode]])
            	->where('PORDER_BODY.FLAG','1')
            	->orwhere('PORDER_BODY.FLAG','3')
            	->whereBetween('PORDER_HEAD.VRDATE',[$frmDate, $toDate])
            	->where('PORDER_BODY.GRNHID','0')
            	->where('PORDER_BODY.GRNBID','0')
            	->groupBy('PORDER_BODY.VRNO')
            	->get();
            //dd(DB::getQueryLog());
            $grnVrno = DB::table('GRN_HEAD')
				->select('GRN_HEAD.*', 'GRN_BODY.*')
           		->leftjoin('GRN_BODY', 'GRN_HEAD.GRNHID', '=', 'GRN_BODY.GRNHID')
            	->where([['GRN_HEAD.ACC_CODE','=',$acccode]])
            	->whereBetween('GRN_HEAD.VRDATE',[$frmDate, $toDate])
            	->where('GRN_BODY.PBILLHID','0')
            	->where('GRN_BODY.PBILLBID','0')
            	->groupBy('GRN_BODY.VRNO')
            	->get();

            //dd(DB::getQueryLog());	
            $getAccAdd = DB::select("SELECT a1.*,a2.ACC_CODE AS accCode,a2.ACC_NAME AS accName,a2.ATYPE_CODE AS ATYPE_CODE,a2.CREADIT_LIMIT AS CREADIT_LIMIT FROM MASTER_ACCADD a1 LEFT JOIN MASTER_ACC a2 ON a2.ACC_CODE=a1.ACC_CODE ORDER BY a1.ACC_CODE='$acccode' DESC");
	          

	    	//dd(DB::getQueryLog());
    		if ($poVrno && $grnVrno || $getAccAdd) {

				$response_array['response']   = 'success';
				$response_array['povrdata']   = $poVrno;
				$response_array['grnvrdata']  = $grnVrno;
				$response_array['acc_add_data']   = $getAccAdd;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['qcdata'] = '' ;
                $response_array['contradata'] = '' ;
                $response_array['tax_data'] ='';
                $response_array['statebyAcc'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['qcdata'] = '' ;
                $response_array['contradata'] = '' ;
                $response_array['tax_data'] ='';
                $response_array['statebyAcc'] = '';


                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function GetItemByOrdrNGrn(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$account_code = $request->input('account_code');
			$order_no     = $request->input('orderTNo');
			$grn_no       = $request->input('grnTNo');

		    if($account_code && $order_no){
		    	//DB::enableQueryLog();
		    	$ORDGRN_list = DB::table('PORDER_HEAD')
					->select('PORDER_HEAD.*', 'PORDER_BODY.*','PORDER_BODY.VRNO AS POVRNO')
	           		->leftjoin('PORDER_BODY', 'PORDER_HEAD.PORDERHID', '=', 'PORDER_BODY.PORDERHID')
	            	->where([['PORDER_HEAD.ACC_CODE','=',$account_code],['PORDER_HEAD.VRNO','=',$order_no]])
	            	->get();
	            //dd(DB::getQueryLog());
		    }else if($account_code && $grn_no){
		    	//DB::enableQueryLog();

	            	$ORDGRN_list = DB::table('GRN_HEAD')
					->select('GRN_HEAD.*', 'GRN_BODY.*','GRN_BODY.VRNO AS GRNVRNO')
	           		->leftjoin('GRN_BODY', 'GRN_HEAD.GRNHID', '=', 'GRN_BODY.GRNHID')
	            	->where([['GRN_HEAD.ACC_CODE','=',$account_code],['GRN_HEAD.VRNO','=',$grn_no]])
	            	->get();
	           // dd(DB::getQueryLog());	
		    }else{
		    	    $ORDGRN_list = DB::table('MASTER_ITEM')->get();

		    }
	    	

    		if ($ORDGRN_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $ORDGRN_list;

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

/* ------------ direct purchase  bill --------------- */



/* --------------------- start pdf generate for grn ------------------- */

	public function GeneratePdfForPurchase($tCode,$headTble,$bodyTble,$headID,$head_Id,$taxTble,$userId,$pdfName,$vrPName){

		$response_array = array();

		DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','RT')->orWhere('TCFLAG','R_IT')->delete();
		
		$dataheadB = DB::SELECT("SELECT t1.*,MASTER_ACC.ACC_NAME,MASTER_ACC.ACC_CODE,'$headTble' as tablNme,t2.*,t3.SERIES_CODE,t3.SERIES_NAME,t4.GST_NO,t4.CITY_NAME as plant_city FROM $headTble t1 LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = t1.ACC_CODE LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID LEFT JOIN MASTER_CONFIG t3 ON t3.SERIES_CODE=t1.SERIES_CODE AND t3.COMP_CODE=t1.COMP_CODE AND t3.TRAN_CODE=t1.TRAN_CODE LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$headID='$head_Id'");


		$bodyCount  = count($dataheadB);
		$seriesCode = $dataheadB[0]->SERIES_CODE;
		$accCode    = $dataheadB[0]->ACC_CODE;
		$consiner   = $dataheadB[0]->CPCODE;
		$compCode   = $dataheadB[0]->COMP_CODE;

		$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME,MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");

		$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.CPCODE = '$consiner'");

		$compDetail = DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$compCode'");

		$dataTax = DB::SELECT("SELECT t1.*,t2.$headID FROM $taxTble t1 LEFT JOIN $headTble t2 ON t2.$headID = t1.$headID WHERE t2.$headID='$head_Id' AND t1.TAX_AMT<>'0.00'");
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

		} /* body count loop*/

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
			
		$this->ConvertNoIntoWord($grandAmt,$tCode,$seriesCode,$dataheadB,$dataTax,$taxDetail,$pdfName,$dataConfig,$dataAccDetail,$consinerDetail,$compDetail,$vrPName);
		

	}

/* --------------------- End pdf generate for grn --------------------- */

/* ------------ download pdf for purchase view -------------------*/

	public function pdfDownloadForView(Request $request){

		$response_array = array();

		$uniqNo  = $request->input('uniqNo');
		$head_Id = $request->input('headId');
		$vrNo    = $request->input('vrno');
		$tCode   = $request->input('tCode');
		$userId  = $request->session()->get('userid');	

		if($tCode == 'T0'){
			$headTble ='PINDENT_HEAD';
			$bodyTble ='PINDENT_BODY';
			$headID   ='PINDHID';
			$pdfName  = 'PURCHASE INDENT';
			$vrPName   ='PINDENT NO';
		}else if($tCode == 'P1'){
			$headTble ='PQTN_HEAD';
			$bodyTble ='PQTN_BODY';
			$taxTble  ='PQTN_TAX';
			$headID   ='PQTNHID';
			$pdfName  = 'PURCHASE QUOTATION';
			$vrPName   ='PQTN NO';
		}else if($tCode == 'P2'){
			$headTble ='PCNTR_HEAD';
			$bodyTble ='PCNTR_BODY';
			$taxTble  ='PCNTR_TAX';
			$headID   ='PCNTRHID';
			$pdfName  = 'PURCHASE CONTRACT';
			$vrPName   ='PCNTR NO';
		}else if($tCode == 'P3'){
			$headTble ='PORDER_HEAD';
			$bodyTble ='PORDER_BODY';
			$taxTble  ='PORDER_TAX';
			$headID   ='PORDERHID';
			$pdfName  = 'PURCHASE ORDER';
			$vrPName   ='PORDER NO';
		}else if($tCode == 'P4'){
			$headTble ='GRN_HEAD';
			$bodyTble ='GRN_BODY';
			$taxTble  ='GRN_TAX';
			$headID   ='GRNHID';
			$pdfName  = 'PURCHASE GRN';
			$vrPName   ='PGRN NO';
		}else if($tCode == 'P5'){
			$headTble ='PBILL_HEAD';
			$bodyTble ='PBILL_BODY';
			$taxTble  ='PBILL_TAX';
			$headID   ='PBILLHID';
			$pdfName  = 'PURCHASE BILL';
			$vrPName   ='PBILL NO';
		}else if($tCode == 'W1'){
			$headTble ='PORDER_HEAD';
			$bodyTble ='PORDER_BODY';
			$taxTble  ='PORDER_TAX';
			$headID   ='PORDERHID';
			$pdfName  = 'JOB WORK ORDER';
			$vrPName   ='JWO NO';
		}
		
		if ($request->ajax()) {
			
			//$dataheadB = DB::SELECT("SELECT t1.*,'$headTble' as tablNme,t2.* FROM $headTble t1 LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID WHERE t2.$headID='$head_Id'");
			DB::table('SIMULATION_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','RT')->orWhere('TCFLAG','R_IT')->delete();
			//DB::enableQueryLog();
			$dataheadB = DB::SELECT("SELECT t1.*,MASTER_ACC.ACC_NAME,MASTER_ACC.ACC_CODE,'$headTble' as tablNme,t2.*,t3.SERIES_CODE,t3.SERIES_NAME,t4.GST_NO,t4.CITY_NAME as plant_city FROM $headTble t1 LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = t1.ACC_CODE LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID LEFT JOIN MASTER_CONFIG t3 ON t3.SERIES_CODE=t1.SERIES_CODE AND t3.TRAN_CODE=t1.TRAN_CODE AND t3.COMP_CODE=t1.COMP_CODE LEFT JOIN MASTER_PLANT t4 ON t4.COMP_CODE=t1.COMP_CODE AND t4.PLANT_CODE=t1.PLANT_CODE WHERE t2.$headID='$head_Id'");
			//dd(DB::getQueryLog());

			//echo "<PRE>";print_r($dataheadB);exit;
			$bodyCount  = count($dataheadB);
			$seriesCode = $dataheadB[0]->SERIES_CODE;
			$accCode    = $dataheadB[0]->ACC_CODE;
			$consiner   = $dataheadB[0]->CPCODE;
			$compCode   = $dataheadB[0]->COMP_CODE;
			//print_r($consiner);exit;
			$dataAccDetail = DB::SELECT("SELECT MASTER_ACC.*,MASTER_ACC.ACC_CODE ACCCODE,MASTER_ACC.ACC_NAME ACCNAME, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE MASTER_ACC.ACC_CODE = '$accCode'");
			//DB::enableQueryLog();
			$consinerDetail = DB::SELECT("SELECT MASTER_ACC.*, MASTER_ACCADD.* FROM MASTER_ACC LEFT JOIN MASTER_ACCADD ON MASTER_ACCADD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE  MASTER_ACCADD.CPCODE = '$consiner'");
			//dd(DB::getQueryLog());
			$compDetail = DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$compCode'");

			//DB::enableQueryLog();
			//$dataheadB = DB::SELECT("SELECT t1.*,'$headTble' as tablNme,t2.* FROM $headTble t1 LEFT JOIN $bodyTble t2 ON t2.$headID = t1.$headID WHERE t2.$headID='$head_Id'");
			//dd(DB::getQueryLog());
			//$dataTax = DB::SELECT("SELECT t1.*,t2.* FROM $taxTble t1 LEFT JOIN $headTble t2 ON t2.$headID = t1.$headID WHERE t2.$headID='$head_Id'");

			$dataTax = DB::SELECT("SELECT t1.*,t2.$headID FROM $taxTble t1 LEFT JOIN $headTble t2 ON t2.$headID = t1.$headID WHERE t2.$headID='$head_Id' AND t1.TAX_AMT<>'0.00'");
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

			//print_r($grandAmt);

			$dataConfig = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$tCode)->where('SERIES_CODE',$seriesCode)->get()->toArray();
			
			$this->ConvertNoIntoWord($grandAmt,$tCode,$seriesCode,$dataheadB,$dataTax,$taxDetail,$pdfName,$dataConfig,$dataAccDetail,$consinerDetail,$compDetail,$vrPName);

		}else{
			$response_array['response'] = 'error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);
		}

		

	}



function ConvertNoIntoWord($grandAmt,$tCode,$seriesCode,$dataheadB,$dataTax,$taxDetail,$pdfName,$dataConfig,$dataAccDetail,$consinerDetail,$compDetail,$vrPName)
{

	$response_array = array();

 	//$num   = $request->input('amt');
 	

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

	$pdf = PDF::loadView('admin.finance.transaction.purchase.purchase_data_report',compact('dataheadB','dataTax','taxDetail','pdfName','dataConfig','dataAccDetail','consinerDetail','compDetail','vrPName','numwords'));
              
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

public function GeneratePdfForPEnq($headId,$accCode){

		$accCount = count($accCode);
		//print_r($accCode);
		$response_array = array();
		//DB::enableQueryLog();
		
		
		
			$dataheadB = DB::SELECT("SELECT t1.*,t2.* FROM PENQ_HEAD t1 LEFT JOIN PENQ_BODY t2 ON t2.PENQHID = t1.PENQHID WHERE t2.PENQHID='$headId'");
			$compCode    = $dataheadB[0]->COMP_CODE;
			$trans_code  = $dataheadB[0]->TRAN_CODE;
			$series_code = $dataheadB[0]->SERIES_CODE;

			$compDetail = DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$compCode'");

			$dataConfig = DB::table('MASTER_CONFIG')->where('TRAN_CODE',$trans_code)->where('SERIES_CODE',$series_code)->get()->toArray();
			$title='PDF Report';
	        $pdfName='Purchase Enquiry';
	        $vrPName='PENQ';

	        $VendorList = DB::table('PENQ_VENDOR')->where('PENQHID',$headId)->get()->toArray();

	        header('Content-Type: application/pdf');
	        $urlAry = array();
	     	for ($i=0; $i <$accCount ; $i++) { 

	     		$vendorData = $VendorList[$i];

	        	$pdf = PDF::loadView('admin.finance.transaction.purchase.purchase_enquery_pdf',compact('dataheadB','compDetail','pdfName','vrPName','dataConfig','vendorData'));
	        	$path = public_path('dist/downloadpdf'); 
		        $fileName =  time().$i.'.'. 'pdf' ; 
		        $pdf->save($path . '/' . $fileName);

		        $PublicPath = url('public/dist/downloadpdf/');  
				$downloadPdf = $PublicPath.'/'.$fileName;
				//print_r($downloadPdf);
				array_push($urlAry, $downloadPdf);
				// print_r($response_array);
	         }    
	        $response_array['response'] = 'success';
	        $response_array['url'] = $urlAry;
			$response_array['data'] = $dataheadB;         
	        $data = json_encode($response_array);
	        return $data;
	       
	} 

/* ------*/


/* ---------- generate pdf for purchase comparision ------------------*/

	public function generatePdfForQuoComp($qcNo){
		$response_array = array();

		$dataheadB = DB::SELECT("SELECT t1.*,t2.* FROM PQCS_HEAD t1 LEFT JOIN PQCS_BODY t2 ON t2.PQCSHID = t1.PQCSHID WHERE t2.PQCSHID='$qcNo'");
		$compCode    = $dataheadB[0]->COMP_CODE;

		$compDetail = DB::SELECT("SELECT a.*,b.STATE_NAME FROM MASTER_COMP a LEFT JOIN MASTER_STATE b ON b.STATE_CODE =a.STATE WHERE COMP_CODE = '$compCode'");

		$title='PDF Report';
        $pdfName='Purchase Quotation Comparision';
        $vrPName='PQC';

        header('Content-Type: application/pdf');
	        
	    $pdf = PDF::loadView('admin.finance.transaction.purchase.purchase_qc_report',compact('dataheadB','pdfName','compDetail','vrPName'));

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

/* ---------- generate pdf for purchase comparision ------------------*/ 

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



/* ------- START : C AND F CONTROLLER FUNCTION  */


public function createDeliveryOrder(Request $request){


	$title       =	'Create Delivery Order';
	
	$CompanyCode = $request->session()->get('company_name');
	$compcode    = explode('-', $CompanyCode);
	$getcompcode = $compcode[0];
	$macc_year   = $request->session()->get('macc_year');

	$rake_list = DB::table('RAKE_TRAN')->groupBy('RAKE_NO')->get()->toArray();

	if(isset($CompanyCode)){

	    return view('admin.finance.transaction.candf.create_do',compact('title','rake_list'));

	}else{
		return redirect('/useractivity');
	}

}


public function getRakeData(Request $request){

	if ($request->ajax()) {

        if (!empty($request->rakeNo)) {

	        $rakeNo  = $request->rakeNo;
	        $orderNo = $request->orderNo;

            $strWhere = '';

	    	if(isset($rakeNo)  && trim($rakeNo)!=""){

			    $strWhere .="AND RAKE_NO = '$rakeNo'";

			}

			if(isset($orderNo)  && trim($orderNo)!=""){

			    $strWhere .="AND ORDER_NO = '$orderNo'";

			}
             
            //DB::enableQueryLog();

            $data0 = DB::SELECT("SELECT COMP_CODE,RAKE_NO,RAKE_DATE,PLANT_CODE,PLANT_NAME,ORDER_NO,CP_CODE,CP_NAME,
            	SP_CODE,SP_NAME,TO_PLACE,SUM(QTY) AS TOTQTY,UM,SUM(AQTY) AS AQTY,AUM   FROM `RAKE_TRAN` WHERE 1=1  $strWhere AND DORDERBID='0' AND DORDER_FLAG='0' GROUP BY ORDER_NO,CP_CODE,SP_CODE,TO_PLACE");

            //dd(DB::getQueryLog());

            $data01 = json_decode(json_encode($data0), true); 

            return DataTables()->of($data01)->addIndexColumn()->make(true);
                                
        }else if(!empty($request->getDefalutData)){

        	$data01 = array(); 

           return DataTables()->of($data01)->addIndexColumn()->make(true);


        }else{

            $data = array();

            return DataTables()->of($data)->addIndexColumn()->make(true);
        }

    }


}


public function  getTrptData(Request $request){


	if ($request->ajax()) {

            if (!empty($request->trptVal)) {

                $trptVal  = $request->trptVal;
                $getCpCodeName  = $request->getCpCdNm;

                $exp = explode('-',$getCpCodeName);

                $getCpCode = $exp[0];
                $getCpName = $exp[1];

                $CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$macc_year   = $request->session()->get('macc_year');

                if ($trptVal == 'MARKET') {

                     $market = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get()->toArray();
                	
                }else if($trptVal == 'SISTER-CONCERN'){

                     $market = DB::table('MASTER_COMP')->where([['COMP_CODE','!=',$getcompcode],['ACC_CODE','!=','']])->orderBy('ACC_CODE')->get()->toArray();

                }else if($trptVal == 'EX-YARD') {

                     $market = DB::table('MASTER_ACC')->where('ATYPE_CODE','N')->get()->toArray();

                     $getCpCodeNmArr = array(array("ACC_CODE"=>$getCpCode, "ACC_NAME"=>$getCpName));

                     $market = $getCpCodeNmArr;
                	
                }else{

                     $market = '';
                    

                }

                $getDataCount = count($market);
             
       		if ($market!='') {

			$response_array['response']    = 'success';
			$response_array['market_list'] = $market;
			$response_array['count_data'] = $getDataCount;
                	$data = json_encode($response_array);
                	print_r($data);

            	}else{

			$response_array['response']    = 'error';
			$response_array['market_list'] = '';
			$response_array['count_data'] = '';
			$data = json_encode($response_array);
			print_r($data);
                
            	}
                                
            }else{

                $response_array['response']    = 'error';
		$response_array['market_list'] = '';
		$response_array['count_data'] = '';
		$data = json_encode($response_array);
		print_r($data);
            }

        }
	
}


public function  checkUniqueRake(Request $request){

	$rakeNo  = $request->input('rakeNo');

	$checkUnique = DB::table('RAKE_TRAN_SUMMARY')->where('RAKE_NO',$rakeNo)->where('DORDERBID','0')->where('DORDER_FLAG','0')->get()->toArray();

	if ($checkUnique) {

	    $response_array['response'] = 'success';
        $response_array['dataget'] = $checkUnique;

        $data = json_encode($response_array);

        print_r($data);

	}else{
   
	    $response_array['response'] = 'error';
        $response_array['dataget'] = '' ;

        $data = json_encode($response_array);

         print_r($data);
			
	}


}

public function saveCreateDeliveryOrder(Request $request){

	DB::beginTransaction();

	$rakeNoOne   = $request->input('singleRakeNo');

	$checkUnique = DB::table('RAKE_TRAN_SUMMARY')->where('RAKE_NO',$rakeNoOne)->where('DORDERBID','0')->where('DORDER_FLAG','0')->get()->toArray();

	$checkUniqueCount = count($checkUnique);

	if ($checkUniqueCount > 0) {

	    $response_array['response'] = '*Rake No Must Be Unique.';
	    $data = json_encode($response_array);
	    print_r($data);

	    $request->session()->flash('alert-rake', '*Rake Already Uploaded...!');
	    return redirect('/transaction/c-and-f/create-delivery-order');
		
	}else{

		try {

			$createdBy      = $request->session()->get('userid');
			$compName       = $request->session()->get('company_name');
			$compcode       = explode('-', $compName);
			$getcompcode    = $compcode[0];
			$getcompname    = $compcode[1];
			$fisYear        = $request->session()->get('macc_year');

			$compCode = $request->input('compCode');
			$rakeNo   = $request->input('rakeNo');

			$rakeDt   = $request->input('rakeDt');
			$plantCd  = $request->input('plantCd');
			$plantNm  = $request->input('plantNm');
			$cpCode   = $request->input('cpCode');
			$cpName   = $request->input('cpName');
			$spCode   = $request->input('spCode');
			$spName   = $request->input('spName');
			$toPlace  = $request->input('toPlace');
			$orderNo  = $request->input('orderNo');
			$getQty   = $request->input('getQty');
			$getUm    = $request->input('getUm');
			$selfType = $request->input('selfType');
			$trptName = $request->input('trptName');
					
			$trptCode = $request->input('trptTypeCode');

			$getOrderCount = count($toPlace);


		/*  ---------- MAIN LOOP OF SUMMARY TABLE -------- */

			$RAKETRANSUMMID = array();
			for ($i=0; $i < $getOrderCount; $i++) {

				if($trptName[$i] == 'SELF') {

				   $trptNewCd = $compName;
				   
				   $exp = explode('-',$trptNewCd);
				   $compCd = $exp[0];
				   $compNm = $exp[1];

				   $GETTRPTCODESELFDATA = DB::table('MASTER_COMP')->where('COMP_CODE',trim($compCd))->where('COMP_NAME',trim($compNm))->get()->first();

				   $GETTRPTCODESELF = json_decode(json_encode($GETTRPTCODESELFDATA),true);

				   $TrptCd = $GETTRPTCODESELF['ACC_CODE'];
				   $TrptNm = $GETTRPTCODESELF['ACC_NAME'];

					
				}else{
				   $exp = explode('-',$trptCode[$i]);
				   $TrptCd = $exp[0];
				   $TrptNm = $exp[1];

				}


				$FLAG = 0;

				$data = array(

					'COMP_CODE'  => $compCode[$i],
					'RAKE_NO'    => $rakeNo[$i],
					'RAKE_DATE'  => $rakeDt[$i],
					'PLANT_CODE' => $plantCd[$i],
					'PLANT_NAME' => $plantNm[$i],
					'CP_CODE'    => $cpCode[$i],
					'CP_NAME'    => $cpName[$i],
					'SP_CODE'    => $spCode[$i],
					'SP_NAME'    => $spName[$i],
					'TO_PLACE'   => $toPlace[$i],
					'ORDER_NO'   => $orderNo[$i],
					'QTY'        => $getQty[$i],
					'UM'         => $getUm[$i],
					'TRPT_TYPE'  => $trptName[$i],
					'TRPT_CODE'  => $TrptCd,
					'TRPT_NAME'  => $TrptNm,
					'FLAG'       => $FLAG,
					'CREATED_BY' => $createdBy
					

				);

				$saveDataH = DB::table('RAKE_TRAN_SUMMARY')->insert($data);

				$lastInsertIds = DB::getPdo()->lastInsertId();
				$RAKETRANSUMMID[] = $lastInsertIds;

				$getRkNo  = $rakeNo[$i];
				$getOrdNo = $orderNo[$i];
				$getcpCd  = $cpCode[$i];
				$getspCd  = $spCode[$i];

			/* ---------- CHECK SISTER-CONCERN COMPANY ---------- */

				if ($trptName[$i] == 'SISTER-CONCERN') {

				     	$getSisConComp1 = DB::table('MASTER_COMP')->where('ACC_CODE',trim($TrptCd))->where('ACC_NAME',trim($TrptNm))->get()->first();

				     	$getSisConComp = json_decode(json_encode($getSisConComp1),true);

				     	if ($getSisConComp) {

				     	    $getCompCd = $getSisConComp['COMP_CODE'];
				     	    $getCompNm = $getSisConComp['COMP_NAME'];
				     		
				     	}else{

				     	    $getCompCd = $getcompcode;
				     	    $getCompNm = $getcompname;

				     	}
				    
				     	
			     	}else{
			     		$getCompCd = $getcompcode;
			     		$getCompNm = $getcompname;

			     	}

			/* ---------- /. CHECK SISTER-CONCERN COMPANY ---------- */

			$tCode = 'T0';
			$sCode = 'D1';
			$sName = 'DO JSW';

			/* ---------- VRNO GENERATION --------------- */


			    if ($i == 0) {


					$lastVrno1 = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$sCode)->where('COMP_CODE',$getCompCd)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$tCode)->get()->first();

					$lastVrno = json_decode(json_encode($lastVrno1),true);
					/*$getLastCot = count($lastVrno);*/

					if ($lastVrno) {

					   $newVr = $lastVrno['LAST_NO'] + 1;

					   $datavrn =array(
						   'LAST_NO' => $newVr
						);

					   DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tCode)->where('SERIES_CODE',$sCode)->where('COMP_CODE',$getCompCd)->where('FY_CODE',$fisYear)->update($datavrn);

					}else{

						$datavrnIn =array(
							'COMP_CODE'   =>$getCompCd,
							'FY_CODE'     =>$fisYear,
							'TRAN_CODE'   =>$tCode,
							'SERIES_CODE' =>$sCode,
							'FROM_NO'     =>1,
							'TO_NO'       =>99999,
							'LAST_NO'     =>1,
							'CREATED_BY'  =>$createdBy,
						);

						DB::table('MASTER_VRSEQ')->insert($datavrnIn);

						$newVr = 1;

						

					}

			    }else{

			     	//DB::enableQueryLog();

					$NEWVRNO1 = DB::select("SELECT MAX(VRNO) AS NVRNO FROM `DORDER_HEAD` WHERE COMP_CODE = '$getCompCd' AND FY_CODE = '$fisYear' AND TRAN_CODE = '$tCode' AND SERIES_CODE = '$sCode'");

					//dd(DB::getQueryLog());

					$NEWVRNO = json_decode(json_encode($NEWVRNO1),true);

					if (isset($NEWVRNO[0]['NVRNO'])) {

					    $newVr1 = $NEWVRNO[0]['NVRNO'];

					    $newVr = $newVr1 + 1;

					     $datavrn =array(
						   'LAST_NO' => $newVr
						);

					   DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$tCode)->where('SERIES_CODE',$sCode)->where('COMP_CODE',$getCompCd)->where('FY_CODE',$fisYear)->update($datavrn);
						
					}else{

						$newVr = 1;

					}

			    }

            /* ------------ /. VRNO GENERATION ---------------- */

        if (isset($getcpCd) && isset($getspCd) && isset($getOrdNo) && isset($toPlace)) {
                		
                	

			$getRkTrnData = DB::table('RAKE_TRAN')->where([['RAKE_NO','=',$getRkNo],['CP_CODE','=',$getcpCd],['SP_CODE','=',$getspCd],['ORDER_NO','=',$getOrdNo]])->get()->toArray();

			$srNo = 1;
			$headId;
			$GETHID;
			$DORDNO = array();
			$RAKENO = array();
			foreach ($getRkTrnData as $row) {

				$tCode = 'T0';
				$sCode = 'D1';
				$sName = 'DO JSW';



               		/* ---------- FIND ROUTE CODE  --------------- */

				$getRout1 = DB::table('MASTER_FREIGHT_ROUTE')->where('FROM_PLACE',$row->FROM_PLACE)->where('TO_PLACE',$row->TO_PLACE)->get()->first();

				$getRout = json_decode(json_encode($getRout1),true);

				if (!empty($getRout)) {

					$rCode = $getRout['ROUTE_CODE'];
					$rName = $getRout['ROUTE_NAME'];
					
				}else{
					$rCode = '';
					$rName = '';
				}

			/* ---------- /. FIND ROUTE CODE  --------------- */


			/* ---------- FIND ODC  --------------- */


				$getItem1 = DB::table('MASTER_ITEM')->where('ITEM_CODE',$row->ITEM_CODE)->where('ITEM_NAME',$row->ITEM_NAME)->get()->first();

				$getItem = json_decode(json_encode($getItem1),true);

				if(isset($getItem['LENGTH'])){

				    $L = $getItem['LENGTH'];

				}else{

				    $L = '0';
				}

				if(isset($getItem['WIDTH'])){

				    $W = $getItem['WIDTH'];

				}else{

				    $W = '0';
				}

				if(isset($getItem['HEIGHT'])){

				    $H = $getItem['HEIGHT'];

				}else{

				    $H = '0';
				}


				if ($row->LENGTH > $L && $row->WIDTH > $W  && $row->HEIGHT > $H){

					$ODCFLAG = 'TWO SIDE ODC';
						
				}else if($row->WIDTH > $W  && $row->HEIGHT > $H || $row->LENGTH > $L && $row->WIDTH > $W || $row->LENGTH > $L && $row->HEIGHT > $H){

					$ODCFLAG = 'TWO SIDE ODC';

				}else if($row->LENGTH > $L || $row->WIDTH > $W  || $row->HEIGHT > $H){

					$ODCFLAG = 'ONE SIDE ODC';

				}else{

					$ODCFLAG = 'NO';

				}

			/* ---------- /. FIND ODC  --------------- */



					date_default_timezone_set('Asia/Kolkata');
					$currDt = date('Y-m-d');

					if ($srNo == 1) {

						$data1 = array(

							'COMP_CODE'   => $getCompCd,
							'COMP_NAME'   => $getCompNm,
							'FY_CODE'     => $fisYear,
							'PFCT_CODE'   => $row->PFCT_CODE,
							'PFCT_NAME'   => $row->PFCT_NAME,
							'TRAN_CODE'   => $tCode,
							'SERIES_CODE' => $sCode,
							'SERIES_NAME' => $sName,
							'ACC_CODE'    => $row->ACC_CODE,
							'ACC_NAME'    => $row->ACC_NAME,
							'VRNO'        => $newVr,
							'VRDATE'      => $currDt,
							'SLNO'        => $srNo,
							'PLANT_CODE'  => $row->PLANT_CODE,
							'PLANT_NAME'  => $row->PLANT_NAME,
							'ROUTE_CODE'  => $rCode,
							'ROUTE_NAME'  => $rName,
							'SISCONCERN_COMP_CODE' => $getcompcode,
							'SISCONCERN_COMP_NAME' => $getcompname,
							'CREATED_BY'  => $createdBy

							);

							$DORDERHD = DB::table('DORDER_HEAD')->insert($data1);

						$GETHID1 = DB::select("SELECT MAX(DORDERHID) AS NDORDERHID from `DORDER_HEAD`");

						$GETHID = json_decode(json_encode($GETHID1),true);

						$DORDERFLAG =1;

						$data01 = array(

							'DORDERBID'    => $GETHID[0]['NDORDERHID'],
							'DORDER_FLAG'  => $DORDERFLAG,

						);

						DB::table('RAKE_TRAN_SUMMARY')->where('RAKESUMID',$lastInsertIds)->where('RAKE_NO',$row->RAKE_NO)->where('COMP_CODE',$getcompcode)->update($data01);


						
					}

					$DORDNO[] = $row->ORDER_NO;
					$RAKENO[] = $row->RAKE_NO;

					$data2 = array(

					'DORDERHID'    => $GETHID[0]['NDORDERHID'],
					'COMP_CODE'    => $getCompCd,
					'COMP_NAME'    => $getCompNm,
					'FY_CODE'      => $fisYear,
					'PFCT_CODE'    => $row->PFCT_CODE,
					'PFCT_NAME'    => $row->PFCT_NAME,
					'PLANT_CODE'   => $row->PLANT_CODE,
					'PLANT_NAME'   => $row->PLANT_NAME,
					'TRAN_CODE'    => $tCode,
					'SERIES_CODE'  => $sCode,
					'VRNO'         => $newVr,
					'VRDATE'       => $currDt,
					'SLNO'         => $srNo,
					'ACC_CODE'     => $row->ACC_CODE,
					'ACC_NAME'     => $row->ACC_NAME,
					'DORDER_NO'    => $row->ORDER_NO,
					'DORDER_DATE'  => $row->RAKE_DATE,
					'CP_CODE'      => $row->CP_CODE,
					'CP_NAME'      => $row->CP_NAME,
					'SP_CODE'      => $row->SP_CODE,
					'SP_NAME'      => $row->SP_NAME,
					'TRPT_TYPE'    => $trptName[$i],
					'TRPT_CODE'    => $TrptCd,
					'TRPT_NAME'    => $TrptNm,
					'ROUTE_CODE'   => $rCode,
					'ROUTE_NAME'   => $rName,
					'FROM_PLACE'   => $row->FROM_PLACE,
					'TO_PLACE'     => $row->TO_PLACE,
					'BATCH_NO'     => $row->BATCH_NO,
					'ITEM_CODE'    => $row->ITEM_CODE,
					'ITEM_NAME'    => $row->ITEM_NAME,
					'REMARK'       => $row->REMARK,
					'LENGTH'       => $row->LENGTH,
					'WIDTH'        => $row->WIDTH,
					'HEIGHT'       => $row->HEIGHT,
					'ODC'          => $ODCFLAG,
					'QTY'          => $row->QTY,
					'UM'           => $row->UM,
					'AQTY'         => $row->AQTY,
					'AUM'          => $row->AUM,
					'DO_INVC_NO'   => $row->INVOICE_NO,
					'DO_INVC_DT'   => $row->INVOICE_DATE,
					'RAKE_NO'      => $row->RAKE_NO,
					'RAKE_DATE'    => $row->RAKE_DATE,
					'DO_WAGON_NO'  => $row->WAGON_NO,
					'DO_DELIVERY_NO'  => $row->DELIVERY_NO,
					'EWAY_BILL_NO' => $row->EWAY_BILL_NO,
					'EWAY_BILL_DT' => $row->EWAY_BILL_DT,
					'SISCONCERN_COMP_CODE' => $getcompcode,
					'SISCONCERN_COMP_NAME' => $getcompname,
					'CREATED_BY'   => $createdBy

					);

					$DORDERBD = DB::table('DORDER_BODY')->insert($data2);

					$DORDBID = DB::getPdo()->lastInsertId();
					$DORDBIDARRY[] = $DORDBID;

					$ORDERFLAG = 1;

					$data0 = array(

						'DORDERBID'    => $DORDBID,
						'DORDER_FLAG'  => $ORDERFLAG,

					);

					DB::table('RAKE_TRAN')->where('RAKEID',$row->RAKEID)->where('RAKE_NO',$row->RAKE_NO)->where('COMP_CODE',$getcompcode)->update($data0);

					
				
				$srNo++;

			} /* foreach loop end */

			

	    }else{

		   	$request->session()->flash('alert-error', 'Sold to party or Ship to party or To Place Not Found...!');
			return redirect('/transaction/c-and-f/create-delivery-order');

	    } /* /. Check CP-CODE / SP-CODE */


	} /* for loop end */

		/*$RAKETRANSUMMID*/

		//print_r($RAKETRANSUMMID);exit;


		
			DB::commit();

			$request->session()->flash('alert-success', 'Delivery-Order (D.O.) Was Successfully Created...!');
			return redirect('/transaction/c-and-f/create-delivery-order');
		

		} catch (\Exception $e) {
		    DB::rollBack();
		    //throw $e;
		    $request->session()->flash('alert-error', 'Delivery-Order (D.O.) Can Not Be Created...!');
		    return redirect('/transaction/c-and-f/create-delivery-order');
		}

	}

	

}


	public function viewCreateDeliveryOrder(Request $request){

		$title       =	'View Delivery Order - Rake';
		
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		
		$getdata = DB::table('RAKE_TRAN_SUMMARY')->where(['COMP_CODE'=>$getcompcode])->get();


		if(isset($CompanyCode)){

		    return view('admin.finance.transaction.candf.view_create_do',compact('title'));

		}else{
			return redirect('/useractivity');
		}


	}

	public function getDeliveryOrderRake(Request $request){


		$compName = $request->session()->get('company_name');
		$title       =	'View Delivery Order - Rake';

		if($request->ajax()) {

		    	$CompanyCode = $request->session()->get('company_name');
			$compcode    = explode('-', $CompanyCode);
			$getcompcode = $compcode[0];
			$macc_year   = $request->session()->get('macc_year');

			$data1 = DB::table('RAKE_TRAN_SUMMARY')->where('COMP_CODE', $getcompcode)->orderBy('RAKE_NO','DESC')->get()->toArray();

			$data = json_decode(json_encode($data1),true);

		    	return DataTables()->of($data)->addIndexColumn()->make(true);

		}else{
			$data = array();
			return DataTables()->of($data)->addIndexColumn()->make(true);

		}

		if(isset($compName)){

		    	return view('admin.finance.transaction.candf.view_create_do',compact('title'));

		}else{

			return redirect('/useractivity');
		
		}
		
	}


	public function  getRakeDataFromOrderNo(Request $request){

		if ($request->ajax()) {

			$rakeNo  = $request->rakeNo;
	             
	                $CompanyCode = $request->session()->get('company_name');
			$compcode    = explode('-', $CompanyCode);
			$getcompcode = $compcode[0];
			$macc_year   = $request->session()->get('macc_year');

	                $RAKEDATA = DB::table('RAKE_TRAN')->where('RAKE_NO',$rakeNo)->groupBy('ORDER_NO')->get()->toArray();

	                $RAKEDATACOUNT = count($RAKEDATA);

	                if ($RAKEDATACOUNT>0) {

				$response_array['response'] = 'success';
				$response_array['get_data'] = $RAKEDATA;
	                	$data = json_encode($response_array);
	                	print_r($data);

	            	}else{

				$response_array['response']  = 'error';
				$response_array['get_data']  = '';
				$data = json_encode($response_array);
				print_r($data);
	                
	            	}


		}else{

			$response_array['response'] = 'error';
			$response_array['get_data'] = '';
			$data = json_encode($response_array);
			print_r($data);


		}

		
	}

/* ------- END: C AND F CONTROLLER FUNCTION ----------  */



/* ------- START : Logistics Sale Bill Posting ----------  */

 public function SaleBill(Request $request){

	$title       =	'Logistics - Sale Bill Provisional';
	$compCodeName = $request->session()->get('company_name');
	$compcode    = explode('-', $compCodeName);
	$getcompcode = $compcode[0];
	$macc_year   = $request->session()->get('macc_year');
	$transCode   = 'S5';

	$tableData = MyConstruct();

	$userdata['acc_list']     = $tableData['master_party'];

	$getCommonData = MyCommonFun($transCode,$compcode,$macc_year);

	$userdata['series_list'] = $getCommonData['getseries'];

	$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$transCode)->get();

	$userdata['trans_head'] =$transCode[0]->TRAN_CODE;

	$getdate = DB::table('MASTER_FY')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

        foreach ($getdate as $key) {
            $userdata['fromDate'] =  $key->FY_FROM_DATE;
            $userdata['toDate']   =  $key->FY_TO_DATE;
        }
		
	$accCatglist  = DB::table('MASTER_ACATG')->get();

	$tripBodylist  = DB::table('TRIP_BODY')->get()->toArray();
	
	$tripHeadVehiclelist  = DB::table('TRIP_HEAD')->groupBy('VEHICLE_NO')->get()->toArray();

	$plantlist  = DB::table('MASTER_PLANT')->where('COMP_CODE',$getcompcode)->get()->toArray();

	$itemList  = DB::table('MASTER_ITEM')->where('ITEMTYPE_CODE','SR')->get()->toArray();

	$tripBodylist1  = DB::select("SELECT TRIP_HEAD.TRIPHID AS TRPHID,TRIP_HEAD.COMP_CODE AS COMPCODE,TRIP_HEAD.FY_CODE AS FYCODE,TRIP_HEAD.PFCT_CODE AS PFCTCODE,TRIP_HEAD.PFCT_NAME AS PFCTNAME,TRIP_HEAD.TRAN_CODE AS TRANCODE,TRIP_HEAD.SERIES_CODE AS SERIESCODE,TRIP_HEAD.SERIES_NAME AS SERIESNAME,TRIP_HEAD.ACC_CODE AS ACCCODE,TRIP_HEAD.ACC_NAME AS ACCNAME,TRIP_HEAD.ACC_ADD AS ACCADD,TRIP_HEAD.DELORDER_NO AS DELORDERNO,TRIP_HEAD.VRNO AS HVRNO,TRIP_HEAD.SLNO AS HSLNO,TRIP_HEAD.TRIP_NO AS TRIPNO,TRIP_HEAD.VRDATE AS HVRDATE,TRIP_HEAD.PLANT_CODE AS PLANTCODE,TRIP_HEAD.PLANT_NAME AS PLANTNAME,TRIP_HEAD.FSO_NO AS FSONO,TRIP_HEAD.FSO_RATE AS FSORATE,TRIP_HEAD.FSO_QTY AS FSOQTY,TRIP_HEAD.ROUTE_CODE AS ROUTECODE,TRIP_HEAD.ROUTE_NAME AS ROUTENAME,TRIP_HEAD.TRIP_DAY AS TRIPDAY,TRIP_HEAD.OFF_DAY AS OFFDAY,TRIP_HEAD.FROM_PLACE AS FROMPLACE,TRIP_HEAD.TO_PLACE AS TOPLACE,TRIP_HEAD.VEHICLE_NO AS VEHICLENO,TRIP_HEAD.OLD_VEHICLE_NO AS OLDVEHICLENO,TRIP_HEAD.OWNER AS HOWNER,TRIP_HEAD.TRANSPORT_CODE AS TRANSPORTCODE,TRIP_HEAD.TRANSPORT_NAME AS TRANSPORTNAME,TRIP_HEAD.FPO_NO AS FPONO,TRIP_HEAD.FPO_RATE AS FPORATE,TRIP_HEAD.MFPO_RATE AS MFPORATE,TRIP_HEAD.AMOUNT AS HAMOUNT,TRIP_HEAD.FREIGHT_QTY AS FREIGHTQTY,TRIP_HEAD.RATE_BASIS AS RATEBASIS,TRIP_HEAD.PAYMENT_MODE AS PAYMENTMODE,TRIP_HEAD.ADV_TYPE AS ADVTYPE,TRIP_HEAD.ADV_RATE AS ADVRATE,TRIP_HEAD.ADV_AMT AS ADVAMT,TRIP_HEAD.DELIVERY_NO AS DELIVERYNO,TRIP_HEAD.GROSS_WEIGHT AS GROSSWEIGHT,TRIP_HEAD.NET_WEIGHT AS NETWEIGHT,TRIP_HEAD.GATE_INWARD AS GATEINWARD,TRIP_HEAD.DRIVER_NAME AS DRIVERNAME,TRIP_HEAD.DRIVER_MOBILE AS DRIVERMOBILE,TRIP_HEAD.LICENCE_NO AS LICENCENO,TRIP_HEAD.DRIVER_ADD AS DRIVERADD,TRIP_HEAD.REMARK AS HREMARK,TRIP_HEAD.EBILL_NO AS EBILLNO,TRIP_HEAD.EWAYB_VALIDDT AS EWAYBVALIDDT,TRIP_HEAD.LR_DATE AS LRDATE,TRIP_HEAD.REPORT_DATE AS REPORTDATE,TRIP_HEAD.ACK_DATE AS ACKDATE,TRIP_HEAD.ARRIVAL_DATE AS ARRIVALDATE,TRIP_HEAD.DELIVERY_DATE AS DELIVERYDATE,TRIP_HEAD.DELIVERY_DAY AS DELIVERYDAY,TRIP_HEAD.DELIVERY_BY AS DELIVERYBY,TRIP_HEAD.DELIVERY_RECD_BY AS DELIVERY_RECDBY,TRIP_HEAD.PARTY_SIGN AS PARTYSIGN,TRIP_HEAD.PARTY_STAMP AS PARTYSTAMP,TRIP_HEAD.EXP_PAID_PARTY AS EXPPAIDPARTY,TRIP_HEAD.DEDUCT_CLAIM_PARTY AS DEDUCTCLAIMPARTY,TRIP_HEAD.VEHICLE_RETURN AS VEHICLERETURN,TRIP_HEAD.VEHICLE_RETURN_DATE AS VEHICLERETURNDATE,TRIP_HEAD.WARAI_RECIEPT AS WARAIRECIEPT,TRIP_HEAD.WARAI_RECIEPT_DATE AS WARAIRECIEPTDATE,TRIP_HEAD.TRIP_FREIGHT_AMT AS TRIPFREIGHTAMT,TRIP_HEAD.LESS_ADVANCE AS LESSADVANCE,TRIP_HEAD.ADD_LESS_CHRG AS ADDLESSCHRG,TRIP_HEAD.NET_AMOUNT AS NETAMOUNT,TRIP_HEAD.RECEIVED_QTY AS RECEIVEDQTY,TRIP_HEAD.TRIP_TYPE AS TRIPTYPE,TRIP_HEAD.DIESEL_RATE AS DIESELRATE,TRIP_HEAD.MODEL AS HMODEL,TRIP_HEAD.LOAD_CPCT AS LOADCPCT,TRIP_HEAD.LOAD_AVG AS LOADAVG,TRIP_HEAD.UL_CPCT AS ULCPCT,TRIP_HEAD.UL_AVG AS ULAVG,TRIP_HEAD.EMPTY_AVG AS EMPTYAVG,TRIP_HEAD.DELIVERY_POINT AS DELIVERYPOINT,TRIP_HEAD.TRIP_ACHIVE_DAY AS TRIPACHIVEDAY,TRIP_HEAD.GATE_STATUS AS GATESTATUS,TRIP_HEAD.PLAN_STATUS AS PLANSTATUS,TRIP_HEAD.LR_STATUS AS LRSTATUS,TRIP_HEAD.TRIP_EXP_STATUS AS TRIPEXPSTATUS,TRIP_HEAD.LR_ACK_STATUS AS LRACKSTATUS,TRIP_HEAD.EPOD_STATUS AS EPODSTATUS,TRIP_HEAD.BILL_STATUS AS BILLSTATUS,TRIP_HEAD.CFINWARD_STATUS AS CFINWARDSTATUS,TRIP_HEAD.VEHICLE_OUT_DT_TIME AS VEHICLEOUTDTTIME,TRIP_HEAD.DRIVER_LS_EX_DT AS DRIVERLSEXDT,TRIP_HEAD.DRIVER_DOB AS DRIVERDOB,TRIP_HEAD.BASIC_AMT AS BASICAMT,TRIP_HEAD.GATE_OUT_STATUS AS GATEOUTSTATUS,TRIP_HEAD.TRIP_WO_ITEM AS TRIPWOITEM,TRIP_HEAD.GATE_IN_STATUS AS GATEINSTATUS,TRIP_HEAD.OUTWARD_LR_STATUS AS OUTWARDLRSTATUS,TRIP_HEAD.FLAG AS HFLAG,TRIP_HEAD.CREATED_BY AS CREATEDBY,TRIP_BODY.* FROM TRIP_HEAD , TRIP_BODY WHERE TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID AND TRIP_HEAD.LR_ACK_STATUS = 1 AND TRIP_HEAD.COMP_CODE = '$getcompcode' AND TRIP_BODY.DELIVERY_NO NOT IN (SELECT BD.DELIVERY_NO FROM TRIP_BODY BD, TRIP_HEAD HD WHERE HD.TRIPHID = BD.TRIPHID AND HD.LR_ACK_STATUS = 0 AND BD.DELIVERY_NO!='NULL')");

           	$tripBodylist = json_decode(json_encode($tripBodylist1),true);

	
 	if(isset($compCodeName)){

	    return view('admin.finance.transaction.logistic.sale_bill',$userdata+compact('title','accCatglist','tripBodylist','plantlist','tripHeadVehiclelist','transCode','itemList'));

	}else{

	    return redirect('/useractivity');
	
	}

 	
 }

   public function getAccCodeFromTranCode(Request $request){


   	if ($request->ajax()) {

		$tranCode  = $request->tranCode;
		$plantCat  = $request->plantCat;
             
        $CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$macc_year   = $request->session()->get('macc_year');

                $MASTERACC = DB::table('MASTER_ACC')->where('ACATG_CODE',$plantCat)->groupBy('ACC_CODE')->get()->toArray();

                $MASTERACCDATA = count($MASTERACC);

                if ($MASTERACCDATA>0) {

					$response_array['response'] = 'success';
					$response_array['get_data'] = $MASTERACC;
                	$data = json_encode($response_array);
                	print_r($data);

            	}else{

					$response_array['response']  = 'error';
					$response_array['get_data']  = '';
					$data = json_encode($response_array);
					print_r($data);
                
            	}


	}else{

		$response_array['response'] = 'error';
		$response_array['get_data'] = '';
		$data = json_encode($response_array);
		print_r($data);


	}

	 	
   }


    public function getDataFromLrOnSaleBill(Request $request){

    	if ($request->ajax()) {


    	    if (!empty($request->vrDateId || $request->series_code || $request->plant_code || $request->tranType || $request->accountCode || $request->AccountText || $request->from_date || $request->to_date || $request->deliveryNo || $request->wagonNo || $request->lrNo || $request->vehicleNo )) {

				$vrDateId    = $request->vrDateId;
				$series_code = $request->series_code;
				$plantCode  = $request->plant_code;

				$exp_plant = explode("[",$plantCode);
				$newPlantCode = explode("]",$exp_plant[0]);
				$plant_code = $newPlantCode[0];

				$tranType    = $request->tranType;
				$accountCode = $request->accountCode;
				$AccountText = $request->AccountText;
				$from_date   = $request->from_date;
				$to_date     = $request->to_date;
				$deliveryNo  = $request->deliveryNo;
				$wagonNo     = $request->wagonNo;
				$lrNo        = $request->lrNo;
				$vehicleNo   = $request->vehicleNo;
				$plantCatg   = $request->plantCatg;
		                
		        $CompanyCode = $request->session()->get('company_name');
				$compcode    = explode('-', $CompanyCode);
				$getcompcode = $compcode[0];
				$macc_year   = $request->session()->get('macc_year');

				$vrDate   = date("Y-m-d", strtotime($vrDateId));
				$fromDate = date("Y-m-d", strtotime($from_date));
				$toDate   = date("Y-m-d", strtotime($to_date));


				        
                 $strWhere = '';
                $strWhere1 = '';

                if(isset($fromDate)  && trim($fromDate)!=""){

		      	    $strWhere.=" AND TRIP_HEAD.VRDATE BETWEEN '$fromDate' AND  '$toDate'";
		      	   
		      	}
        	
        		if(isset($accountCode)  && trim($accountCode)!=""){

                    $strWhere .= " AND TRIP_HEAD.ACC_CODE = '$accountCode'";
                    $strWhere1 .= " AND H.ACC_CODE = '$accountCode'";

                }
      
	      		if(isset($deliveryNo)  && trim($deliveryNo)!=""){

                    $strWhere .= " AND TRIP_BODY.DELIVERY_NO = '$deliveryNo'";
                    $strWhere1 .= " AND D.DELIVERY_NO = '$deliveryNo'";

                }

             	if(isset($wagonNo)  && trim($wagonNo)!=""){

             	     $strWhere .= " AND TRIP_BODY.WAGON_NO = '$wagonNo'";
             	     $strWhere1 .= " AND D.WAGON_NO = '$wagonNo'";

             	}

             	if(isset($lrNo)  && trim($lrNo)!=""){

             	     $strWhere .= " AND TRIP_BODY.LR_NO = '$lrNo'";
             	     $strWhere1 .= " AND D.LR_NO = '$lrNo'";

             	}

             	if(isset($vehicleNo)  && trim($vehicleNo)!=""){

             	     $strWhere .= " AND TRIP_HEAD.VEHICLE_NO = '$vehicleNo'";
             	     $strWhere1 .= " AND H.VEHICLE_NO = '$vehicleNo'";

             	}

             	if(isset($getcompcode)  && trim($getcompcode)!=""){

             	     $strWhere .= " AND TRIP_HEAD.COMP_CODE = '$getcompcode'";
             	     $strWhere1 .= " AND H.COMP_CODE = '$getcompcode'";

             	}

             	if(isset($plant_code)  && trim($plant_code)!=""){

                    $strWhere .= " AND TRIP_HEAD.PLANT_CODE = '$plant_code'";
                    $strWhere1 .= " AND H.PLANT_CODE = '$plant_code'";

                }


                if(isset($tranType)  && trim($tranType)!=""){

                    $strWhere .= " AND TRIP_BODY.ACATG_CODE = '$tranType'";
                    $strWhere1 .= " AND D.ACATG_CODE = '$tranType'";

                }

                /*$TRIP_SALE_RATEUPDATE = DB::update("UPDATE TRIP_HEAD T SET T.FSO_RATE = (SELECT F.RATE FROM FSO_BODY F WHERE F.COMP_CODE = T.COMP_CODE AND F.ACC_CODE = T.ACC_CODE AND F.PLANT_CODE = T.PLANT_CODE AND F.FROM_PLACE = T.FROM_PLACE AND F.TO_PLACE = T.TO_PLACE AND F.VEHICLE_TYPE = T.VEHICLE_TYPE AND T.VRDATE BETWEEN F.VALID_FROM_DATE AND F.VALID_TO_DATE)");*/


               

			//DB::enableQueryLog();

	                if (isset($plantCatg) && $plantCatg =='EX-SID') {

	                	DB::update("UPDATE TRIP_BODY D, TRIP_HEAD H SET H.FLAG = '0' WHERE D.TRIPHID = H.TRIPHID AND H.LR_ACK_STATUS = 1");

	                	$DODATA1 = DB::select("SELECT D.TRIPHID,D.SLNO,D.INVC_NO,H.LR_ACK_STATUS FROM TRIP_BODY D, TRIP_HEAD H WHERE D.TRIPHID = H.TRIPHID AND H.LR_ACK_STATUS = 1 AND D.PROVBILL_STATUS=0 AND H.TSALEBILL_STATUS=0  $strWhere1");

							$DODATA = json_decode(json_encode($DODATA1),true);

							$countData = count($DODATA);

						
							for ($i = 0; $i < $countData;$i++) {

								$invNo = $DODATA[$i]['INVC_NO'];

								$MTRIPHID = $DODATA[$i]['TRIPHID'];

								$DODATA0 = DB::select("SELECT D.TRIPHID,D.SLNO,D.INVC_NO,H.LR_ACK_STATUS FROM TRIP_BODY D, TRIP_HEAD H WHERE D.TRIPHID = H.TRIPHID AND D.INVC_NO = '$invNo' AND H.LR_ACK_STATUS = 0");

								$GETVRNO = json_decode(json_encode($DODATA0),true);

								$COUNTVRNO = count($GETVRNO);

								if ($COUNTVRNO > 0) {

									$DODATAUPDATE = DB::update("UPDATE TRIP_BODY D, TRIP_HEAD H SET H.FLAG = '1' WHERE H.TRIPHID = D.TRIPHID AND D.TRIPHID = '$MTRIPHID' AND H.LR_ACK_STATUS = 1");

									//print_r($DODATAUPDATE);

									if ($DODATAUPDATE > 0) {

										$MUPDATEREC = 0;
										$MRECORD = 0;
										do {
											$MUPDATEREC = $MRECORD;
											$UPDATEFLAGDATA1 = DB::select("SELECT D.TRIPHID,D.SLNO,D.INVC_NO,H.LR_ACK_STATUS FROM TRIP_BODY D, TRIP_HEAD H WHERE D.TRIPHID = H.TRIPHID AND H.FLAG = 1");

											$UPDATEFLAGDATA = json_decode(json_encode($UPDATEFLAGDATA1),true);

											$COUNTUPDATEDATA = count($UPDATEFLAGDATA);
											$MRECORD = $COUNTUPDATEDATA;

											for ($p = 0; $p < $COUNTUPDATEDATA;$p++) {

												$invNo = $UPDATEFLAGDATA[$p]['INVC_NO'];

												$MTRIPHID = $UPDATEFLAGDATA[$p]['TRIPHID'];

												$DODATAUPDATE = DB::update("UPDATE TRIP_BODY D, TRIP_HEAD H SET H.FLAG = '1' WHERE H.TRIPHID = D.TRIPHID AND D.INVC_NO = '$invNo'  AND H.LR_ACK_STATUS = 1");
												
											}

										} while ($MRECORD != $MUPDATEREC);

										
									}else{


									}
									
									
								}else{



								}

							}
	                	
	                	
	                	$data1 = DB::select("SELECT ROW_NUMBER() OVER(PARTITION BY TRIP_BODY.DELIVERY_NO) AS SRNO,TRIP_HEAD.TRIPHID AS HTRPHID,TRIP_HEAD.COMP_CODE AS COMPCODE,TRIP_HEAD.FY_CODE AS FYCODE,TRIP_HEAD.PFCT_CODE AS PFCTCODE,TRIP_HEAD.PFCT_NAME AS PFCTNAME,TRIP_HEAD.DELIVERY_DATE AS DELIVERYDATE,TRIP_HEAD.VEHICLE_TYPE AS VEHICLETYPE,TRIP_HEAD.TRAN_CODE AS TRANCODE,TRIP_HEAD.SERIES_CODE AS SERIESCODE,TRIP_HEAD.SERIES_NAME AS SERIESNAME,TRIP_HEAD.ACC_CODE AS ACCCODE,TRIP_HEAD.ACC_NAME AS ACCNAME,TRIP_HEAD.ACC_ADD AS ACCADD,TRIP_HEAD.DELORDER_NO AS DELORDERNO,TRIP_HEAD.VRNO AS HVRNO,TRIP_HEAD.SLNO AS HSLNO,TRIP_HEAD.TRIP_NO AS TRIPNO,TRIP_HEAD.VRDATE AS HVRDATE,TRIP_HEAD.PLANT_CODE AS PLANTCODE,TRIP_HEAD.PLANT_NAME AS PLANTNAME,TRIP_HEAD.FSO_NO AS FSONO,TRIP_HEAD.FSO_RATE AS FSORATE,TRIP_HEAD.FSO_QTY AS FSOQTY,TRIP_HEAD.ROUTE_CODE AS ROUTECODE,TRIP_HEAD.ROUTE_NAME AS ROUTENAME,TRIP_HEAD.TRIP_DAY AS TRIPDAY,TRIP_HEAD.OFF_DAY AS OFFDAY,TRIP_HEAD.FROM_PLACE AS FROMPLACE,TRIP_HEAD.TO_PLACE AS TOPLACE,TRIP_HEAD.VEHICLE_NO AS VEHICLENO,TRIP_HEAD.OLD_VEHICLE_NO AS OLDVEHICLENO,TRIP_HEAD.OWNER AS HOWNER,TRIP_HEAD.TRANSPORT_CODE AS TRANSPORTCODE,TRIP_HEAD.TRANSPORT_NAME AS TRANSPORTNAME,TRIP_HEAD.FPO_NO AS FPONO,TRIP_HEAD.FPO_RATE AS FPORATE,TRIP_HEAD.FSOHID AS FSOHID,TRIP_HEAD.FSOBID AS FSOBID,TRIP_HEAD.MFPO_RATE AS MFPORATE,TRIP_HEAD.AMOUNT AS HAMOUNT,TRIP_HEAD.FREIGHT_QTY AS FREIGHTQTY,TRIP_HEAD.RATE_BASIS AS RATEBASIS,TRIP_HEAD.PAYMENT_MODE AS PAYMENTMODE,TRIP_HEAD.ADV_TYPE AS ADVTYPE,TRIP_HEAD.ADV_RATE AS ADVRATE,TRIP_HEAD.ADV_AMT AS ADVAMT,TRIP_HEAD.DELIVERY_NO AS DELIVERYNO,TRIP_HEAD.GROSS_WEIGHT AS GROSSWEIGHT,TRIP_HEAD.NET_WEIGHT AS NETWEIGHT,TRIP_HEAD.GATE_INWARD AS GATEINWARD,TRIP_HEAD.DRIVER_NAME AS DRIVERNAME,TRIP_HEAD.DRIVER_MOBILE AS DRIVERMOBILE,TRIP_HEAD.LICENCE_NO AS LICENCENO,TRIP_HEAD.DRIVER_ADD AS DRIVERADD,TRIP_HEAD.REMARK AS HREMARK,TRIP_HEAD.EBILL_NO AS EBILLNO,TRIP_HEAD.EWAYB_VALIDDT AS EWAYBVALIDDT,TRIP_BODY.LR_DATE AS LRDATE,TRIP_HEAD.REPORT_DATE AS REPORTDATE,TRIP_HEAD.ACK_DATE AS ACKDATE,TRIP_HEAD.ARRIVAL_DATE AS ARRIVALDATE,TRIP_HEAD.DELIVERY_DATE AS DELIVERYDATE,TRIP_HEAD.DELIVERY_DAY AS DELIVERYDAY,TRIP_HEAD.DELIVERY_BY AS DELIVERYBY,TRIP_HEAD.DELIVERY_RECD_BY AS DELIVERY_RECDBY,TRIP_HEAD.PARTY_SIGN AS PARTYSIGN,TRIP_HEAD.PARTY_STAMP AS PARTYSTAMP,TRIP_HEAD.EXP_PAID_PARTY AS EXPPAIDPARTY,TRIP_HEAD.DEDUCT_CLAIM_PARTY AS DEDUCTCLAIMPARTY,TRIP_HEAD.VEHICLE_RETURN AS VEHICLERETURN,TRIP_HEAD.VEHICLE_RETURN_DATE AS VEHICLERETURNDATE,TRIP_HEAD.WARAI_RECIEPT AS WARAIRECIEPT,TRIP_HEAD.WARAI_RECIEPT_DATE AS WARAIRECIEPTDATE,TRIP_HEAD.TRIP_FREIGHT_AMT AS TRIPFREIGHTAMT,TRIP_HEAD.LESS_ADVANCE AS LESSADVANCE,TRIP_HEAD.ADD_LESS_CHRG AS ADDLESSCHRG,TRIP_HEAD.NET_AMOUNT AS NETAMOUNT,TRIP_HEAD.RECEIVED_QTY AS RECEIVEDQTY,TRIP_HEAD.TRIP_TYPE AS TRIPTYPE,TRIP_HEAD.DIESEL_RATE AS DIESELRATE,TRIP_HEAD.MODEL AS HMODEL,TRIP_HEAD.LOAD_CPCT AS LOADCPCT,TRIP_HEAD.LOAD_AVG AS LOADAVG,TRIP_HEAD.UL_CPCT AS ULCPCT,TRIP_HEAD.UL_AVG AS ULAVG,TRIP_HEAD.EMPTY_AVG AS EMPTYAVG,TRIP_HEAD.DELIVERY_POINT AS DELIVERYPOINT,TRIP_HEAD.TRIP_ACHIVE_DAY AS TRIPACHIVEDAY,TRIP_HEAD.GATE_STATUS AS GATESTATUS,TRIP_HEAD.PLAN_STATUS AS PLANSTATUS,TRIP_HEAD.LR_STATUS AS LRSTATUS,TRIP_HEAD.TRIP_EXP_STATUS AS TRIPEXPSTATUS,TRIP_HEAD.LR_ACK_STATUS AS LRACKSTATUS,TRIP_HEAD.EPOD_STATUS AS EPODSTATUS,TRIP_HEAD.BILL_STATUS AS BILLSTATUS,TRIP_HEAD.CFINWARD_STATUS AS CFINWARDSTATUS,TRIP_HEAD.VEHICLE_OUT_DT_TIME AS VEHICLEOUTDTTIME,TRIP_HEAD.DRIVER_LS_EX_DT AS DRIVERLSEXDT,TRIP_HEAD.DRIVER_DOB AS DRIVERDOB,TRIP_HEAD.BASIC_AMT AS BASICAMT,TRIP_HEAD.GATE_OUT_STATUS AS GATEOUTSTATUS,TRIP_HEAD.TRIP_WO_ITEM AS TRIPWOITEM,TRIP_HEAD.GATE_IN_STATUS AS GATEINSTATUS,TRIP_HEAD.OUTWARD_LR_STATUS AS OUTWARDLRSTATUS,TRIP_HEAD.FLAG AS HFLAG,TRIP_HEAD.CREATED_BY AS CREATEDBY,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIP_HEAD.LR_ACK_STATUS = 1 AND TRIP_HEAD.FLAG = 0 $strWhere AND TRIP_BODY.PSBILLBID=0 AND TRIP_BODY.PROVBILL_STATUS=0 AND TRIP_BODY.FSO_RATE=0 AND TRIP_BODY.DELIVERY_NO NOT IN (SELECT BD.DELIVERY_NO FROM TRIP_BODY BD, TRIP_HEAD HD WHERE HD.TRIPHID = BD.TRIPHID AND HD.LR_ACK_STATUS = 0 AND BD.DELIVERY_NO!='NULL')");

	                		
	                		foreach ($data1 as $key) {

	                			$velType = $key->VEHICLETYPE;
	                			$lrDate  = $key->LRDATE;
	                			$toPlace = $key->TOPLACE;
	                			$fsoRate = $key->FSORATE;
	                			$TRHID   = $key->HTRPHID;
	                			$plantCode   = $key->PLANTCODE;

	                			$fsoData = DB::select("SELECT FSO_HEAD.REF_NO,FSO_BODY.* FROM FSO_BODY LEFT JOIN FSO_HEAD ON FSO_HEAD.FSOHID = FSO_BODY.FSOHID WHERE FSO_BODY.COMP_CODE='$getcompcode' AND FSO_BODY.ACC_CODE='$accountCode' AND FSO_BODY.VEHICLE_TYPE='$velType' AND '$lrDate' BETWEEN FSO_BODY.VALID_FROM_DATE AND FSO_BODY.VALID_TO_DATE AND FSO_BODY.PLANT_CODE='$plantCode' AND FSO_BODY.TO_PLACE = '$toPlace'");

        						$fso_data = json_decode(json_encode($fsoData),true);

        						$updatedDate = date('Y-m-d');

        						if (isset($fso_data[0]['RATE'])) {

        							$data01 = array(
										"FSO_RATE"         =>  $fso_data[0]['RATE'],
										"FSO_REF_NO"       =>  $fso_data[0]['REF_NO'],
										"FSOHID"           =>  $fso_data[0]['FSOHID'],
										"FSOBID"           =>  $fso_data[0]['FSOBID'],
										"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
										"LAST_UPDATE_DATE" =>  $updatedDate
							    	);

									DB::table('TRIP_HEAD')->where('TRIPHID', $TRHID)->update($data01);

        						}else{

        							$data01 = array(
										"FSO_RATE"         =>  0,
										"FSO_REF_NO"       =>  0000,
										"FSOHID"           =>  0,
										"FSOBID"           =>  0,
										"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
										"LAST_UPDATE_DATE" =>  $updatedDate
							    	);

									DB::table('TRIP_HEAD')->where('TRIPHID', $TRHID)->update($data01);


        						}
	                			
	                		}


        					$data = DB::select("SELECT ROW_NUMBER() OVER(PARTITION BY TRIP_BODY.DELIVERY_NO) AS SRNO,TRIP_HEAD.TRIPHID AS HTRPHID,TRIP_HEAD.COMP_CODE AS COMPCODE,TRIP_HEAD.FY_CODE AS FYCODE,TRIP_HEAD.PFCT_CODE AS PFCTCODE,TRIP_HEAD.PFCT_NAME AS PFCTNAME,TRIP_HEAD.DELIVERY_DATE AS DELIVERYDATE,TRIP_HEAD.VEHICLE_TYPE AS VEHICLETYPE,TRIP_HEAD.TRAN_CODE AS TRANCODE,TRIP_HEAD.SERIES_CODE AS SERIESCODE,TRIP_HEAD.SERIES_NAME AS SERIESNAME,TRIP_HEAD.ACC_CODE AS ACCCODE,TRIP_HEAD.ACC_NAME AS ACCNAME,TRIP_HEAD.ACC_ADD AS ACCADD,TRIP_HEAD.DELORDER_NO AS DELORDERNO,TRIP_HEAD.VRNO AS HVRNO,TRIP_HEAD.SLNO AS HSLNO,TRIP_HEAD.TRIP_NO AS TRIPNO,TRIP_HEAD.VRDATE AS HVRDATE,TRIP_HEAD.PLANT_CODE AS PLANTCODE,TRIP_HEAD.PLANT_NAME AS PLANTNAME,TRIP_HEAD.FSO_NO AS FSONO,TRIP_HEAD.FSO_RATE AS FSORATE,TRIP_HEAD.FSO_REF_NO AS FSOREFNO,TRIP_HEAD.FSO_QTY AS FSOQTY,TRIP_HEAD.ROUTE_CODE AS ROUTECODE,TRIP_HEAD.ROUTE_NAME AS ROUTENAME,TRIP_HEAD.TRIP_DAY AS TRIPDAY,TRIP_HEAD.OFF_DAY AS OFFDAY,TRIP_HEAD.FROM_PLACE AS FROMPLACE,TRIP_HEAD.TO_PLACE AS TOPLACE,TRIP_HEAD.VEHICLE_NO AS VEHICLENO,TRIP_HEAD.OLD_VEHICLE_NO AS OLDVEHICLENO,TRIP_HEAD.OWNER AS HOWNER,TRIP_HEAD.TRANSPORT_CODE AS TRANSPORTCODE,TRIP_HEAD.TRANSPORT_NAME AS TRANSPORTNAME,TRIP_HEAD.FPO_NO AS FPONO,TRIP_HEAD.FPO_RATE AS FPORATE,TRIP_HEAD.FSOHID AS FSOHID,TRIP_HEAD.FSOBID AS FSOBID,TRIP_HEAD.MFPO_RATE AS MFPORATE,TRIP_HEAD.AMOUNT AS HAMOUNT,TRIP_HEAD.FREIGHT_QTY AS FREIGHTQTY,TRIP_HEAD.RATE_BASIS AS RATEBASIS,TRIP_HEAD.PAYMENT_MODE AS PAYMENTMODE,TRIP_HEAD.ADV_TYPE AS ADVTYPE,TRIP_HEAD.ADV_RATE AS ADVRATE,TRIP_HEAD.ADV_AMT AS ADVAMT,TRIP_HEAD.DELIVERY_NO AS DELIVERYNO,TRIP_HEAD.GROSS_WEIGHT AS GROSSWEIGHT,TRIP_HEAD.NET_WEIGHT AS NETWEIGHT,TRIP_HEAD.GATE_INWARD AS GATEINWARD,TRIP_HEAD.DRIVER_NAME AS DRIVERNAME,TRIP_HEAD.DRIVER_MOBILE AS DRIVERMOBILE,TRIP_HEAD.LICENCE_NO AS LICENCENO,TRIP_HEAD.DRIVER_ADD AS DRIVERADD,TRIP_HEAD.REMARK AS HREMARK,TRIP_HEAD.EBILL_NO AS EBILLNO,TRIP_HEAD.EWAYB_VALIDDT AS EWAYBVALIDDT,TRIP_HEAD.LR_DATE AS LRDATE,TRIP_HEAD.REPORT_DATE AS REPORTDATE,TRIP_HEAD.ACK_DATE AS ACKDATE,TRIP_HEAD.ARRIVAL_DATE AS ARRIVALDATE,TRIP_HEAD.DELIVERY_DATE AS DELIVERYDATE,TRIP_HEAD.DELIVERY_DAY AS DELIVERYDAY,TRIP_HEAD.DELIVERY_BY AS DELIVERYBY,TRIP_HEAD.DELIVERY_RECD_BY AS DELIVERY_RECDBY,TRIP_HEAD.PARTY_SIGN AS PARTYSIGN,TRIP_HEAD.PARTY_STAMP AS PARTYSTAMP,TRIP_HEAD.EXP_PAID_PARTY AS EXPPAIDPARTY,TRIP_HEAD.DEDUCT_CLAIM_PARTY AS DEDUCTCLAIMPARTY,TRIP_HEAD.VEHICLE_RETURN AS VEHICLERETURN,TRIP_HEAD.VEHICLE_RETURN_DATE AS VEHICLERETURNDATE,TRIP_HEAD.WARAI_RECIEPT AS WARAIRECIEPT,TRIP_HEAD.WARAI_RECIEPT_DATE AS WARAIRECIEPTDATE,TRIP_HEAD.TRIP_FREIGHT_AMT AS TRIPFREIGHTAMT,TRIP_HEAD.LESS_ADVANCE AS LESSADVANCE,TRIP_HEAD.ADD_LESS_CHRG AS ADDLESSCHRG,TRIP_HEAD.NET_AMOUNT AS NETAMOUNT,TRIP_HEAD.RECEIVED_QTY AS RECEIVEDQTY,TRIP_HEAD.TRIP_TYPE AS TRIPTYPE,TRIP_HEAD.DIESEL_RATE AS DIESELRATE,TRIP_HEAD.MODEL AS HMODEL,TRIP_HEAD.LOAD_CPCT AS LOADCPCT,TRIP_HEAD.LOAD_AVG AS LOADAVG,TRIP_HEAD.UL_CPCT AS ULCPCT,TRIP_HEAD.UL_AVG AS ULAVG,TRIP_HEAD.EMPTY_AVG AS EMPTYAVG,TRIP_HEAD.DELIVERY_POINT AS DELIVERYPOINT,TRIP_HEAD.TRIP_ACHIVE_DAY AS TRIPACHIVEDAY,TRIP_HEAD.GATE_STATUS AS GATESTATUS,TRIP_HEAD.PLAN_STATUS AS PLANSTATUS,TRIP_HEAD.LR_STATUS AS LRSTATUS,TRIP_HEAD.TRIP_EXP_STATUS AS TRIPEXPSTATUS,TRIP_HEAD.LR_ACK_STATUS AS LRACKSTATUS,TRIP_HEAD.EPOD_STATUS AS EPODSTATUS,TRIP_HEAD.BILL_STATUS AS BILLSTATUS,TRIP_HEAD.CFINWARD_STATUS AS CFINWARDSTATUS,TRIP_HEAD.VEHICLE_OUT_DT_TIME AS VEHICLEOUTDTTIME,TRIP_HEAD.DRIVER_LS_EX_DT AS DRIVERLSEXDT,TRIP_HEAD.DRIVER_DOB AS DRIVERDOB,TRIP_HEAD.BASIC_AMT AS BASICAMT,TRIP_HEAD.GATE_OUT_STATUS AS GATEOUTSTATUS,TRIP_HEAD.TRIP_WO_ITEM AS TRIPWOITEM,TRIP_HEAD.GATE_IN_STATUS AS GATEINSTATUS,TRIP_HEAD.OUTWARD_LR_STATUS AS OUTWARDLRSTATUS,TRIP_HEAD.FLAG AS HFLAG,TRIP_HEAD.CREATED_BY AS CREATEDBY,TRIP_BODY.* FROM TRIP_HEAD LEFT JOIN TRIP_BODY ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE TRIP_HEAD.LR_ACK_STATUS = 1 AND TRIP_HEAD.FLAG = 0 $strWhere AND TRIP_BODY.PSBILLBID=0 AND TRIP_BODY.PROVBILL_STATUS=0 AND TRIP_BODY.DELIVERY_NO NOT IN (SELECT BD.DELIVERY_NO FROM TRIP_BODY BD, TRIP_HEAD HD WHERE HD.TRIPHID = BD.TRIPHID AND HD.LR_ACK_STATUS = 0 AND BD.DELIVERY_NO!='NULL')");
	                	
	                }else{ /* Yard Billing In Else */
	              	

	               		$data1 = DB::select("SELECT ROW_NUMBER() OVER(PARTITION BY TRIP_BODY.DELIVERY_NO) AS SRNO,TRIP_HEAD.TRIPHID AS HTRPHID,TRIP_HEAD.COMP_CODE AS COMPCODE,TRIP_HEAD.FY_CODE AS FYCODE,TRIP_HEAD.PFCT_CODE AS PFCTCODE,TRIP_HEAD.PFCT_NAME AS PFCTNAME,TRIP_HEAD.DELIVERY_DATE AS DELIVERYDATE,TRIP_HEAD.VEHICLE_TYPE AS VEHICLETYPE,TRIP_HEAD.TRAN_CODE AS TRANCODE,TRIP_HEAD.SERIES_CODE AS SERIESCODE,TRIP_HEAD.SERIES_NAME AS SERIESNAME,TRIP_HEAD.ACC_CODE AS ACCCODE,TRIP_HEAD.ACC_NAME AS ACCNAME,TRIP_HEAD.ACC_ADD AS ACCADD,TRIP_HEAD.DELORDER_NO AS DELORDERNO,TRIP_HEAD.VRNO AS HVRNO,TRIP_HEAD.SLNO AS HSLNO,TRIP_HEAD.TRIP_NO AS TRIPNO,TRIP_HEAD.VRDATE AS HVRDATE,TRIP_HEAD.PLANT_CODE AS PLANTCODE,TRIP_HEAD.PLANT_NAME AS PLANTNAME,TRIP_HEAD.FSO_NO AS FSONO,TRIP_HEAD.FSO_RATE AS FSORATE,TRIP_HEAD.FSO_QTY AS FSOQTY,TRIP_HEAD.ROUTE_CODE AS ROUTECODE,TRIP_HEAD.ROUTE_NAME AS ROUTENAME,TRIP_HEAD.TRIP_DAY AS TRIPDAY,TRIP_HEAD.OFF_DAY AS OFFDAY,TRIP_HEAD.FROM_PLACE AS FROMPLACE,TRIP_HEAD.TO_PLACE AS TOPLACE,TRIP_HEAD.VEHICLE_NO AS VEHICLENO,TRIP_HEAD.OLD_VEHICLE_NO AS OLDVEHICLENO,TRIP_HEAD.OWNER AS HOWNER,TRIP_HEAD.TRANSPORT_CODE AS TRANSPORTCODE,TRIP_HEAD.TRANSPORT_NAME AS TRANSPORTNAME,TRIP_HEAD.FPO_NO AS FPONO,TRIP_HEAD.FPO_RATE AS FPORATE,TRIP_HEAD.FSOHID AS FSOHID,TRIP_HEAD.FSOBID AS FSOBID,TRIP_HEAD.MFPO_RATE AS MFPORATE,TRIP_HEAD.AMOUNT AS HAMOUNT,TRIP_HEAD.FREIGHT_QTY AS FREIGHTQTY,TRIP_HEAD.RATE_BASIS AS RATEBASIS,TRIP_HEAD.PAYMENT_MODE AS PAYMENTMODE,TRIP_HEAD.ADV_TYPE AS ADVTYPE,TRIP_HEAD.ADV_RATE AS ADVRATE,TRIP_HEAD.ADV_AMT AS ADVAMT,TRIP_HEAD.DELIVERY_NO AS DELIVERYNO,TRIP_HEAD.GROSS_WEIGHT AS GROSSWEIGHT,TRIP_HEAD.NET_WEIGHT AS NETWEIGHT,TRIP_HEAD.GATE_INWARD AS GATEINWARD,TRIP_HEAD.DRIVER_NAME AS DRIVERNAME,TRIP_HEAD.DRIVER_MOBILE AS DRIVERMOBILE,TRIP_HEAD.LICENCE_NO AS LICENCENO,TRIP_HEAD.DRIVER_ADD AS DRIVERADD,TRIP_HEAD.REMARK AS HREMARK,TRIP_HEAD.EBILL_NO AS EBILLNO,TRIP_HEAD.EWAYB_VALIDDT AS EWAYBVALIDDT,TRIP_BODY.LR_DATE AS LRDATE,TRIP_HEAD.REPORT_DATE AS REPORTDATE,TRIP_HEAD.ACK_DATE AS ACKDATE,TRIP_HEAD.ARRIVAL_DATE AS ARRIVALDATE,TRIP_HEAD.DELIVERY_DATE AS DELIVERYDATE,TRIP_HEAD.DELIVERY_DAY AS DELIVERYDAY,TRIP_HEAD.DELIVERY_BY AS DELIVERYBY,TRIP_HEAD.DELIVERY_RECD_BY AS DELIVERY_RECDBY,TRIP_HEAD.PARTY_SIGN AS PARTYSIGN,TRIP_HEAD.PARTY_STAMP AS PARTYSTAMP,TRIP_HEAD.EXP_PAID_PARTY AS EXPPAIDPARTY,TRIP_HEAD.DEDUCT_CLAIM_PARTY AS DEDUCTCLAIMPARTY,TRIP_HEAD.VEHICLE_RETURN AS VEHICLERETURN,TRIP_HEAD.VEHICLE_RETURN_DATE AS VEHICLERETURNDATE,TRIP_HEAD.WARAI_RECIEPT AS WARAIRECIEPT,TRIP_HEAD.WARAI_RECIEPT_DATE AS WARAIRECIEPTDATE,TRIP_HEAD.TRIP_FREIGHT_AMT AS TRIPFREIGHTAMT,TRIP_HEAD.LESS_ADVANCE AS LESSADVANCE,TRIP_HEAD.ADD_LESS_CHRG AS ADDLESSCHRG,TRIP_HEAD.NET_AMOUNT AS NETAMOUNT,TRIP_HEAD.RECEIVED_QTY AS RECEIVEDQTY,TRIP_HEAD.TRIP_TYPE AS TRIPTYPE,TRIP_HEAD.DIESEL_RATE AS DIESELRATE,TRIP_HEAD.MODEL AS HMODEL,TRIP_HEAD.LOAD_CPCT AS LOADCPCT,TRIP_HEAD.LOAD_AVG AS LOADAVG,TRIP_HEAD.UL_CPCT AS ULCPCT,TRIP_HEAD.UL_AVG AS ULAVG,TRIP_HEAD.EMPTY_AVG AS EMPTYAVG,TRIP_HEAD.DELIVERY_POINT AS DELIVERYPOINT,TRIP_HEAD.TRIP_ACHIVE_DAY AS TRIPACHIVEDAY,TRIP_HEAD.GATE_STATUS AS GATESTATUS,TRIP_HEAD.PLAN_STATUS AS PLANSTATUS,TRIP_HEAD.LR_STATUS AS LRSTATUS,TRIP_HEAD.TRIP_EXP_STATUS AS TRIPEXPSTATUS,TRIP_HEAD.LR_ACK_STATUS AS LRACKSTATUS,TRIP_HEAD.EPOD_STATUS AS EPODSTATUS,TRIP_HEAD.BILL_STATUS AS BILLSTATUS,TRIP_HEAD.CFINWARD_STATUS AS CFINWARDSTATUS,TRIP_HEAD.VEHICLE_OUT_DT_TIME AS VEHICLEOUTDTTIME,TRIP_HEAD.DRIVER_LS_EX_DT AS DRIVERLSEXDT,TRIP_HEAD.DRIVER_DOB AS DRIVERDOB,TRIP_HEAD.BASIC_AMT AS BASICAMT,TRIP_HEAD.GATE_OUT_STATUS AS GATEOUTSTATUS,TRIP_HEAD.TRIP_WO_ITEM AS TRIPWOITEM,TRIP_HEAD.GATE_IN_STATUS AS GATEINSTATUS,TRIP_HEAD.OUTWARD_LR_STATUS AS OUTWARDLRSTATUS,TRIP_HEAD.FLAG AS HFLAG,TRIP_HEAD.CREATED_BY AS CREATEDBY,TRIP_BODY.* FROM TRIP_HEAD , TRIP_BODY WHERE TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID AND TRIP_HEAD.LR_ACK_STATUS = 1 $strWhere AND TRIP_BODY.PSBILLBID=0 AND TRIP_BODY.PROVBILL_STATUS=0 AND TRIP_BODY.DELIVERY_NO NOT IN (SELECT BD.DELIVERY_NO FROM TRIP_BODY BD, TRIP_HEAD HD WHERE HD.TRIPHID = BD.TRIPHID AND HD.LR_ACK_STATUS = 0 AND BD.DELIVERY_NO!='NULL')");

	               			foreach ($data1 as $key) {

	                			$velType = $key->VEHICLETYPE;
	                			$lrDate  = $key->LRDATE;
	                			$toPlace = $key->TOPLACE;
	                			$fsoRate = $key->FSORATE;
	                			$TRHID   = $key->HTRPHID;
	                			$plantCode   = $key->PLANTCODE;

	                			$fsoData = DB::select("SELECT FSO_HEAD.REF_NO,FSO_BODY.* FROM FSO_BODY LEFT JOIN FSO_HEAD ON FSO_HEAD.FSOHID = FSO_BODY.FSOHID WHERE FSO_BODY.COMP_CODE='$getcompcode' AND FSO_BODY.ACC_CODE='$accountCode' AND FSO_BODY.VEHICLE_TYPE='$velType' AND '$lrDate' BETWEEN FSO_BODY.VALID_FROM_DATE AND FSO_BODY.VALID_TO_DATE AND FSO_BODY.PLANT_CODE='$plantCode' AND FSO_BODY.TO_PLACE = '$toPlace'");

        						$fso_data = json_decode(json_encode($fsoData),true);

        						$updatedDate = date('Y-m-d');

        						if (isset($fso_data[0]['RATE'])) {

        							$data01 = array(
										"FSO_RATE"         =>  $fso_data[0]['RATE'],
										"FSO_REF_NO"       =>  $fso_data[0]['REF_NO'],
										"FSOHID"           =>  $fso_data[0]['FSOHID'],
										"FSOBID"           =>  $fso_data[0]['FSOBID'],
										"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
										"LAST_UPDATE_DATE" =>  $updatedDate
							    	);

									DB::table('TRIP_HEAD')->where('TRIPHID', $TRHID)->update($data01);

        						}else{

        							$data01 = array(
										"FSO_RATE"         =>  0,
										"FSO_REF_NO"       =>  0000,
										"FSOHID"           =>  0,
										"FSOBID"           =>  0,
										"LAST_UPDATE_BY"   =>  $request->session()->get('userid'),
										"LAST_UPDATE_DATE" =>  $updatedDate
							    	);

									DB::table('TRIP_HEAD')->where('TRIPHID', $TRHID)->update($data01);


        						}
	                			
	                		}


	                		$data = DB::select("SELECT ROW_NUMBER() OVER(PARTITION BY TRIP_BODY.DELIVERY_NO) AS SRNO,TRIP_HEAD.TRIPHID AS HTRPHID,TRIP_HEAD.COMP_CODE AS COMPCODE,TRIP_HEAD.FY_CODE AS FYCODE,TRIP_HEAD.PFCT_CODE AS PFCTCODE,TRIP_HEAD.PFCT_NAME AS PFCTNAME,TRIP_HEAD.DELIVERY_DATE AS DELIVERYDATE,TRIP_HEAD.VEHICLE_TYPE AS VEHICLETYPE,TRIP_HEAD.TRAN_CODE AS TRANCODE,TRIP_HEAD.SERIES_CODE AS SERIESCODE,TRIP_HEAD.SERIES_NAME AS SERIESNAME,TRIP_HEAD.ACC_CODE AS ACCCODE,TRIP_HEAD.ACC_NAME AS ACCNAME,TRIP_HEAD.ACC_ADD AS ACCADD,TRIP_HEAD.DELORDER_NO AS DELORDERNO,TRIP_HEAD.VRNO AS HVRNO,TRIP_HEAD.SLNO AS HSLNO,TRIP_HEAD.TRIP_NO AS TRIPNO,TRIP_HEAD.VRDATE AS HVRDATE,TRIP_HEAD.PLANT_CODE AS PLANTCODE,TRIP_HEAD.PLANT_NAME AS PLANTNAME,TRIP_HEAD.FSO_NO AS FSONO,TRIP_HEAD.FSO_RATE AS FSORATE,TRIP_HEAD.FSO_REF_NO AS FSO_REF_NO,TRIP_HEAD.FSO_QTY AS FSOQTY,TRIP_HEAD.ROUTE_CODE AS ROUTECODE,TRIP_HEAD.ROUTE_NAME AS ROUTENAME,TRIP_HEAD.TRIP_DAY AS TRIPDAY,TRIP_HEAD.OFF_DAY AS OFFDAY,TRIP_HEAD.FROM_PLACE AS FROMPLACE,TRIP_HEAD.TO_PLACE AS TOPLACE,TRIP_HEAD.VEHICLE_NO AS VEHICLENO,TRIP_HEAD.OLD_VEHICLE_NO AS OLDVEHICLENO,TRIP_HEAD.OWNER AS HOWNER,TRIP_HEAD.TRANSPORT_CODE AS TRANSPORTCODE,TRIP_HEAD.TRANSPORT_NAME AS TRANSPORTNAME,TRIP_HEAD.FPO_NO AS FPONO,TRIP_HEAD.FPO_RATE AS FPORATE,TRIP_HEAD.FSOHID AS FSOHID,TRIP_HEAD.FSOBID AS FSOBID,TRIP_HEAD.MFPO_RATE AS MFPORATE,TRIP_HEAD.AMOUNT AS HAMOUNT,TRIP_HEAD.FREIGHT_QTY AS FREIGHTQTY,TRIP_HEAD.RATE_BASIS AS RATEBASIS,TRIP_HEAD.PAYMENT_MODE AS PAYMENTMODE,TRIP_HEAD.ADV_TYPE AS ADVTYPE,TRIP_HEAD.ADV_RATE AS ADVRATE,TRIP_HEAD.ADV_AMT AS ADVAMT,TRIP_HEAD.DELIVERY_NO AS DELIVERYNO,TRIP_HEAD.GROSS_WEIGHT AS GROSSWEIGHT,TRIP_HEAD.NET_WEIGHT AS NETWEIGHT,TRIP_HEAD.GATE_INWARD AS GATEINWARD,TRIP_HEAD.DRIVER_NAME AS DRIVERNAME,TRIP_HEAD.DRIVER_MOBILE AS DRIVERMOBILE,TRIP_HEAD.LICENCE_NO AS LICENCENO,TRIP_HEAD.DRIVER_ADD AS DRIVERADD,TRIP_HEAD.REMARK AS HREMARK,TRIP_HEAD.EBILL_NO AS EBILLNO,TRIP_HEAD.EWAYB_VALIDDT AS EWAYBVALIDDT,TRIP_HEAD.LR_DATE AS LRDATE,TRIP_HEAD.REPORT_DATE AS REPORTDATE,TRIP_HEAD.ACK_DATE AS ACKDATE,TRIP_HEAD.ARRIVAL_DATE AS ARRIVALDATE,TRIP_HEAD.DELIVERY_DATE AS DELIVERYDATE,TRIP_HEAD.DELIVERY_DAY AS DELIVERYDAY,TRIP_HEAD.DELIVERY_BY AS DELIVERYBY,TRIP_HEAD.DELIVERY_RECD_BY AS DELIVERY_RECDBY,TRIP_HEAD.PARTY_SIGN AS PARTYSIGN,TRIP_HEAD.PARTY_STAMP AS PARTYSTAMP,TRIP_HEAD.EXP_PAID_PARTY AS EXPPAIDPARTY,TRIP_HEAD.DEDUCT_CLAIM_PARTY AS DEDUCTCLAIMPARTY,TRIP_HEAD.VEHICLE_RETURN AS VEHICLERETURN,TRIP_HEAD.VEHICLE_RETURN_DATE AS VEHICLERETURNDATE,TRIP_HEAD.WARAI_RECIEPT AS WARAIRECIEPT,TRIP_HEAD.WARAI_RECIEPT_DATE AS WARAIRECIEPTDATE,TRIP_HEAD.TRIP_FREIGHT_AMT AS TRIPFREIGHTAMT,TRIP_HEAD.LESS_ADVANCE AS LESSADVANCE,TRIP_HEAD.ADD_LESS_CHRG AS ADDLESSCHRG,TRIP_HEAD.NET_AMOUNT AS NETAMOUNT,TRIP_HEAD.RECEIVED_QTY AS RECEIVEDQTY,TRIP_HEAD.TRIP_TYPE AS TRIPTYPE,TRIP_HEAD.DIESEL_RATE AS DIESELRATE,TRIP_HEAD.MODEL AS HMODEL,TRIP_HEAD.LOAD_CPCT AS LOADCPCT,TRIP_HEAD.LOAD_AVG AS LOADAVG,TRIP_HEAD.UL_CPCT AS ULCPCT,TRIP_HEAD.UL_AVG AS ULAVG,TRIP_HEAD.EMPTY_AVG AS EMPTYAVG,TRIP_HEAD.DELIVERY_POINT AS DELIVERYPOINT,TRIP_HEAD.TRIP_ACHIVE_DAY AS TRIPACHIVEDAY,TRIP_HEAD.GATE_STATUS AS GATESTATUS,TRIP_HEAD.PLAN_STATUS AS PLANSTATUS,TRIP_HEAD.LR_STATUS AS LRSTATUS,TRIP_HEAD.TRIP_EXP_STATUS AS TRIPEXPSTATUS,TRIP_HEAD.LR_ACK_STATUS AS LRACKSTATUS,TRIP_HEAD.EPOD_STATUS AS EPODSTATUS,TRIP_HEAD.BILL_STATUS AS BILLSTATUS,TRIP_HEAD.CFINWARD_STATUS AS CFINWARDSTATUS,TRIP_HEAD.VEHICLE_OUT_DT_TIME AS VEHICLEOUTDTTIME,TRIP_HEAD.DRIVER_LS_EX_DT AS DRIVERLSEXDT,TRIP_HEAD.DRIVER_DOB AS DRIVERDOB,TRIP_HEAD.BASIC_AMT AS BASICAMT,TRIP_HEAD.GATE_OUT_STATUS AS GATEOUTSTATUS,TRIP_HEAD.TRIP_WO_ITEM AS TRIPWOITEM,TRIP_HEAD.GATE_IN_STATUS AS GATEINSTATUS,TRIP_HEAD.OUTWARD_LR_STATUS AS OUTWARDLRSTATUS,TRIP_HEAD.FLAG AS HFLAG,TRIP_HEAD.CREATED_BY AS CREATEDBY,TRIP_BODY.* FROM TRIP_HEAD , TRIP_BODY WHERE TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID AND TRIP_HEAD.LR_ACK_STATUS = 1 $strWhere AND TRIP_BODY.PSBILLBID=0 AND TRIP_BODY.PROVBILL_STATUS=0 AND TRIP_BODY.DELIVERY_NO NOT IN (SELECT BD.DELIVERY_NO FROM TRIP_BODY BD, TRIP_HEAD HD WHERE HD.TRIPHID = BD.TRIPHID AND HD.LR_ACK_STATUS = 0 AND BD.DELIVERY_NO!='NULL')");

	            	} /* EX-SID OR YARD IF CLOSE */

            
            //dd(DB::getQueryLog());

			return DataTables()->of($data)->addIndexColumn()->make(true);

					
	    }else{

			$data = array();
			return DataTables()->of($data)->addIndexColumn()->make(true);

	    }/* ./ Data Check Condition If Close */



    	}else{

		    $data = array();
		    return DataTables()->of($data)->addIndexColumn()->make(true);

    	}/* ./ ajax if close */


    }


     public function TaxCodeOnSaleBill(Request $request){


    	if ($request->ajax()) {

    	    if (!empty($request->plantCode || $request->seriesCode || $request->itemCode || $request->scode || $request->sname || $request->accCode)) {

    	    	$plantCodeName = $request->plantCode;

    	    	$itemCode      = $request->itemCode;

    	    	$accCode      = $request->accCode;

    	    	$exp = explode("[",$plantCodeName);


    	/* ------ START : CHECK PLANT STATE AND ACC STATE ------- */

    	    	$mplant_code = $exp[0];

    	    	$MASTERPLANT = DB::table('MASTER_PLANT')->where('PLANT_CODE',$mplant_code)->get()->toArray();

    	    	$MASTERPLANTDATA = json_decode(json_encode($MASTERPLANT),true);

    	    	$PLANTSTATE = $MASTERPLANTDATA[0]['STATE_CODE'];


    	    	if ($request->scode == $PLANTSTATE) {
                     $TAXTYPE = 'SCGST';
                }else{
                     $TAXTYPE = 'IGST';
                }

        /* ------ END : CHECK PLANT STATE AND ACC STATE ------- */



        /* ------- START : GET - ITEM HSN CODE --------- */

                $MASTERITEM = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->where('ITEMTYPE_CODE','SR')->get()->toArray();

                $MASTERITEMDATA = json_decode(json_encode($MASTERITEM),true);

                if ($MASTERITEMDATA) {

                	$HSNCODEDATA = $MASTERITEMDATA[0]['HSN_CODE'];
                	
                }else{

                	$HSNCODEDATA = '';

                }

        /* ------- END : GET - ITEM HSN CODE --------- */



        /* --------- START : GET - ITEM HSN TAX ON HSN-RATE ------- */

            /* --- START : GET-TAX ON TAX TYPE --- */

                $MASTERTAX = DB::table('MASTER_TAX')->where('TAX_TYPE',$TAXTYPE)->get()->toArray();

                $MASTERTAXDATA = json_decode(json_encode($MASTERTAX),true);

            /* --- END : GET-TAX ON TAX TYPE --- */


                $MASTERTAXARR = array();
                $MASTERTAXNAME = array();
                foreach ($MASTERTAXDATA as $row) {

                	$GETTAXCODE = $row['TAX_CODE'];

                	$MASTERHSNTAX = DB::table('MASTER_HSNRATE')->where('HSN_CODE',$HSNCODEDATA)->where('TAX_CODE',$GETTAXCODE)->get()->toArray();

                	$MASTERHSNTAXDATA = json_decode(json_encode($MASTERHSNTAX),true);

                	if ($MASTERHSNTAXDATA) {

                		foreach($MASTERHSNTAXDATA as $key){

                			$MASTERTAX1 = DB::table('MASTER_TAX')->where('TAX_CODE',$key['TAX_CODE'])->get()->toArray();

                			$MASTERTAXDATA1 = json_decode(json_encode($MASTERTAX1),true);

                			$MASTERTAXARR[] = $MASTERTAXDATA1[0]['TAX_CODE'];
                			$MASTERTAXNAME[] = $MASTERTAXDATA1[0]['TAX_NAME'];

                		}

                		$ITEMHSNTAX_MSG = 'FOUND';
                		
                	}else{
                		
                		$ITEMHSNTAX_MSG = 'NOT-FOUND';

                	}
                	
                }

                $MASTAXCOUNT = count($MASTERTAXARR);

                if ($MASTAXCOUNT>0 || !empty($MASTERTAXARR)) {
                	
                    $NEWTAXCODELIST = $MASTERTAXARR;
                    $NEWTAXCODENAME = $MASTERTAXNAME;

                }else{

                    $NEWTAXCODELIST = 'null';
                    $NEWTAXCODENAME = 'null';

                }

        /* --------- END : GET - ITEM HSN TAX ON HSN-RATE ------- */


        /* ------ START : GET - ACCOUNT TAX CODE ----- */

                $MASTERACC = DB::table('MASTER_ACC')->where('ACC_CODE',$accCode)->get()->toArray();

                $MASTERACCDATA = json_decode(json_encode($MASTERACC),true);


                $MASTERTAX = DB::table('MASTER_TAX')->where('TAX_CODE',$MASTERACCDATA[0]['TAX_CODE'])->get()->toArray();

                $MASTERTAXDATA = json_decode(json_encode($MASTERTAX),true);


                if (isset($MASTERACCDATA[0]['TAX_CODE'])) {

                	$MASTERACCTAXCODE = $MASTERTAXDATA[0]['TAX_CODE'];
                	$MASTERACCTAXNAME = $MASTERTAXDATA[0]['TAX_NAME'];
                	
                }else{

                	$MASTERACCTAXCODE = 'null';
                	$MASTERACCTAXNAME = 'null';

                }

        /* ------ END : GET - ACCOUNT TAX CODE ----- */



                if ($MASTERACCTAXCODE!='null' || $NEWTAXCODELIST!='null') {

					$response_array['response']       = 'success';
					$response_array['get_tax_list']   = $NEWTAXCODELIST;
					$response_array['get_tax_name']   = $NEWTAXCODENAME;
					$response_array['acc_tax']        = $MASTERACCTAXCODE;
					$response_array['acc_tax_name']   = $MASTERACCTAXNAME;
					$response_array['tax_message']    = 'tax-found';
					$response_array['validation_msg'] = '';
                	$data = json_encode($response_array);
                	print_r($data);

            	}else{

					$response_array['response']       = 'error';
					$response_array['get_tax_list']   = '';
					$response_array['acc_tax']        = '';
					$response_array['tax_message']    = 'tax-not-found';
					$response_array['validation_msg'] = 'Tax-Code Not Found...!';
					$data = json_encode($response_array);
					print_r($data);
                
            	}


    	    }else{

				$response_array['response']       = 'error';
				$response_array['get_tax_list']   = '';
				$response_array['acc_tax']        = '';
				$response_array['tax_message']    = 'data-not-found';
				$response_array['validation_msg'] = 'Data Not Found...!';
				$data = json_encode($response_array);
				print_r($data);


    	    }


    	 }else{


			$response_array['response']       = 'error';
			$response_array['get_tax_list']   = '';
			$response_array['acc_tax']        = '';
			$response_array['tax_message']    = 'ajax-data-not-found';
			$response_array['validation_msg'] = 'AJAX Not Run. Please Check...!';
			$data = json_encode($response_array);
			print_r($data);


    	 }



    }

    public function checkTaxCodeOnAccAndPlantState(Request $request){

    	if ($request->ajax()) {

    		if (!empty($request->accState || $request->plant_code || $request->taxCode)) {

			$accState   = $request->accState;
			$plantCode  = $request->plant_code;
			$taxCode    = $request->taxCode;

			$expState = explode("~",$accState);
	             
	        $CompanyCode = $request->session()->get('company_name');
			$compcode    = explode('-', $CompanyCode);
			$getcompcode = $compcode[0];
			$macc_year   = $request->session()->get('macc_year');


		    	/* ------ START : CHECK PLANT STATE AND ACC STATE ------- */

		    			$exp = explode("[",$plantCode);

		    			$newExp = explode("]",$exp[0]);

		    	    	$mplant_code = $newExp[0];


		    	    	$MASTERPLANT = DB::table('MASTER_PLANT')->where('PLANT_CODE',$mplant_code)->get()->toArray();

		    	    	$MASTERPLANTDATA = json_decode(json_encode($MASTERPLANT),true);

		    	    	$PLANTSTATE = $MASTERPLANTDATA[0]['STATE_CODE'];
		    	   

		    	    	if (strtoupper($expState[0]) == strtoupper($PLANTSTATE)) {
		                     $TAXTYPE = 'SCGST';
		                }else{
		                     $TAXTYPE = 'IGST';
		                }

		        /* ------ END : CHECK PLANT STATE AND ACC STATE ------- */

		        /* ------ START : GET - TAX CODE MASTER TAX ------- */

		            
		                $MASTERTAX = DB::table('MASTER_TAX')->where('TAX_TYPE',$TAXTYPE)->get()->toArray();

		                $MASTERTAXDATA = json_decode(json_encode($MASTERTAX),true);

		                $TAXDATAARR = array();

		                foreach($MASTERTAXDATA as $row1){

		                	$TAXDATAARR[] = $row1['TAX_CODE'];

		                }

		             

		               $FINDTAXCODEINARR = array_search($taxCode,$TAXDATAARR);

		                //print_r($FINDTAXCODEINARR);
		    	    	//echo '<br>';
		    	    	//print_r($taxCode);
		    	    	//exit();
		              
		                
		        /* --------- END : GET - TAX CODE MASTER TAX ------- */


	                if ($FINDTAXCODEINARR) {

						$response_array['response'] = 'success';
						$response_array['get_data'] = $MASTERTAXDATA;
						$response_array['get_arr']  = 'FOUND';
						$response_array['search_arr']  = $FINDTAXCODEINARR;
	                	$data = json_encode($response_array);
	                	print_r($data);

	            	}else{

						$response_array['response']  = 'error';
						$response_array['get_data']  = '';
						$response_array['get_arr']   = 'NOT-FOUND';
						$response_array['search_arr']  = '';
						$data = json_encode($response_array);
						print_r($data);
	                
	            	}

	        }else{

				$response_array['response'] = 'error';
				$response_array['get_data'] = '';
				$response_array['get_arr']  = '';
				$response_array['get_arr']   = 'DATA-NOT-FOUND';
				$response_array['search_arr']  = '';
				$data = json_encode($response_array);
				print_r($data);


		}


	}else{

		$response_array['response'] = 'error';
		$response_array['get_data'] = '';
		$response_array['search_arr']  = '';
		$response_array['get_arr']   = 'AJAX-NOT-FOUND';
		$data = json_encode($response_array);
		print_r($data);


	}



    }

    public function getPlantCategoryFromPlantCode(Request $request){

    	if ($request->ajax()) {

		$plantCode  = $request->plantCode;
             
                $CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$macc_year   = $request->session()->get('macc_year');

                $MASTERPLANT = DB::table('MASTER_PLANT')->where('PLANT_CODE',$plantCode)->where('COMP_CODE',$getcompcode)->get()->toArray();

                $MASTERPLANTDATA = count($MASTERPLANT);

                if ($MASTERPLANTDATA>0) {

			$response_array['response'] = 'success';
			$response_array['get_data'] = $MASTERPLANT;
                	$data = json_encode($response_array);
                	print_r($data);

            	}else{

			$response_array['response']  = 'error';
			$response_array['get_data']  = '';
			$data = json_encode($response_array);
			print_r($data);
                
            	}


	}else{

		$response_array['response'] = 'error';
		$response_array['get_data'] = '';
		$data = json_encode($response_array);
		print_r($data);


	}
    	
    }


    public function getOtherDetailsFromAccCode(Request $request){

    	if ($request->ajax()) {

		$accCode    = $request->accCode;
		$plantCode  = $request->plantCode;
		$seriesCode = $request->seriesCode;
		$itemCode   = $request->itemCode;

		$exp = explode("[",$plantCode);

		$plant_code = $exp[0];

        $CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode = $compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$strWhere = '';
		$accWhere = '';
		$plantWhere = '';

		if(isset($accCode)  && trim($accCode)!=""){

                    $strWhere .= " AND TRIP_HEAD.ACC_CODE = '$accCode'";
                    $accWhere .= " AND ACC_CODE = '$accCode'";

                }

                if(isset($plant_code)  && trim($plant_code)!=""){

                    $strWhere .= " AND TRIP_HEAD.PLANT_CODE = '$plant_code'";
                    $plantWhere .= " AND PLANT_CODE = '$plant_code'";

                }

		//DB::enableQueryLog();

               $MASTERPLANT = DB::select("SELECT TRIP_HEAD.TRIPHID AS TRPHID,TRIP_HEAD.COMP_CODE AS COMPCODE,TRIP_HEAD.PFCT_CODE AS PFCTCODE,TRIP_HEAD.PFCT_NAME AS PFCTNAME,TRIP_HEAD.SERIES_CODE AS SERIESCODE,TRIP_HEAD.SERIES_NAME AS SERIESNAME,TRIP_HEAD.ACC_CODE AS ACCCODE,TRIP_HEAD.ACC_NAME AS ACCNAME,TRIP_HEAD.ACC_ADD AS ACCADD,TRIP_HEAD.DELORDER_NO AS DELORDERNO,TRIP_HEAD.VRNO AS HVRNO,TRIP_HEAD.SLNO AS HSLNO,TRIP_HEAD.TRIP_NO AS TRIPNO,TRIP_HEAD.VRDATE AS HVRDATE,TRIP_HEAD.PLANT_CODE AS PLANTCODE,TRIP_HEAD.PLANT_NAME AS PLANTNAME,TRIP_HEAD.FSO_NO AS FSONO,TRIP_HEAD.FSO_RATE AS FSORATE,TRIP_HEAD.FSO_QTY AS FSOQTY,TRIP_HEAD.ROUTE_CODE AS ROUTECODE,TRIP_HEAD.ROUTE_NAME AS ROUTENAME,TRIP_HEAD.TRIP_DAY AS TRIPDAY,TRIP_HEAD.OFF_DAY AS OFFDAY,TRIP_HEAD.FROM_PLACE AS FROMPLACE,TRIP_HEAD.TO_PLACE AS TOPLACE,TRIP_HEAD.VEHICLE_NO AS VEHICLENO,TRIP_HEAD.OLD_VEHICLE_NO AS OLDVEHICLENO,TRIP_HEAD.OWNER AS HOWNER,TRIP_HEAD.TRANSPORT_CODE AS TRANSPORTCODE,TRIP_HEAD.TRANSPORT_NAME AS TRANSPORTNAME,TRIP_HEAD.FPO_NO AS FPONO,TRIP_HEAD.FPO_RATE AS FPORATE,TRIP_HEAD.FSOHID AS FSOHID,TRIP_HEAD.FSOBID AS FSOBID,TRIP_HEAD.MFPO_RATE AS MFPORATE,TRIP_HEAD.AMOUNT AS HAMOUNT,TRIP_HEAD.FREIGHT_QTY AS FREIGHTQTY,TRIP_HEAD.RATE_BASIS AS RATEBASIS,TRIP_HEAD.PAYMENT_MODE AS PAYMENTMODE,TRIP_HEAD.ADV_TYPE AS ADVTYPE,TRIP_HEAD.ADV_RATE AS ADVRATE,TRIP_HEAD.ADV_AMT AS ADVAMT,TRIP_HEAD.DELIVERY_NO AS DELIVERYNO,TRIP_HEAD.GROSS_WEIGHT AS GROSSWEIGHT,TRIP_HEAD.NET_WEIGHT AS NETWEIGHT,TRIP_HEAD.GATE_INWARD AS GATEINWARD,TRIP_HEAD.DRIVER_NAME AS DRIVERNAME,TRIP_HEAD.DRIVER_MOBILE AS DRIVERMOBILE,TRIP_HEAD.LICENCE_NO AS LICENCENO,TRIP_HEAD.DRIVER_ADD AS DRIVERADD,TRIP_HEAD.REMARK AS HREMARK,TRIP_HEAD.EBILL_NO AS EBILLNO,TRIP_HEAD.EWAYB_VALIDDT AS EWAYBVALIDDT,TRIP_HEAD.LR_DATE AS LRDATE,TRIP_HEAD.REPORT_DATE AS REPORTDATE,TRIP_HEAD.ACK_DATE AS ACKDATE,TRIP_HEAD.ARRIVAL_DATE AS ARRIVALDATE,TRIP_HEAD.DELIVERY_DATE AS DELIVERYDATE,TRIP_HEAD.DELIVERY_DAY AS DELIVERYDAY,TRIP_HEAD.DELIVERY_BY AS DELIVERYBY,TRIP_HEAD.DELIVERY_RECD_BY AS DELIVERY_RECDBY,TRIP_HEAD.PARTY_SIGN AS PARTYSIGN,TRIP_HEAD.PARTY_STAMP AS PARTYSTAMP,TRIP_HEAD.EXP_PAID_PARTY AS EXPPAIDPARTY,TRIP_HEAD.DEDUCT_CLAIM_PARTY AS DEDUCTCLAIMPARTY,TRIP_HEAD.VEHICLE_RETURN AS VEHICLERETURN,TRIP_HEAD.VEHICLE_RETURN_DATE AS VEHICLERETURNDATE,TRIP_HEAD.WARAI_RECIEPT AS WARAIRECIEPT,TRIP_HEAD.WARAI_RECIEPT_DATE AS WARAIRECIEPTDATE,TRIP_HEAD.TRIP_FREIGHT_AMT AS TRIPFREIGHTAMT,TRIP_HEAD.LESS_ADVANCE AS LESSADVANCE,TRIP_HEAD.ADD_LESS_CHRG AS ADDLESSCHRG,TRIP_HEAD.NET_AMOUNT AS NETAMOUNT,TRIP_HEAD.RECEIVED_QTY AS RECEIVEDQTY,TRIP_HEAD.TRIP_TYPE AS TRIPTYPE,TRIP_HEAD.DIESEL_RATE AS DIESELRATE,TRIP_HEAD.MODEL AS HMODEL,TRIP_HEAD.LOAD_CPCT AS LOADCPCT,TRIP_HEAD.LOAD_AVG AS LOADAVG,TRIP_HEAD.UL_CPCT AS ULCPCT,TRIP_HEAD.UL_AVG AS ULAVG,TRIP_HEAD.EMPTY_AVG AS EMPTYAVG,TRIP_HEAD.DELIVERY_POINT AS DELIVERYPOINT,TRIP_HEAD.TRIP_ACHIVE_DAY AS TRIPACHIVEDAY,TRIP_HEAD.GATE_STATUS AS GATESTATUS,TRIP_HEAD.PLAN_STATUS AS PLANSTATUS,TRIP_HEAD.LR_STATUS AS LRSTATUS,TRIP_HEAD.TRIP_EXP_STATUS AS TRIPEXPSTATUS,TRIP_HEAD.LR_ACK_STATUS AS LRACKSTATUS,TRIP_HEAD.EPOD_STATUS AS EPODSTATUS,TRIP_HEAD.BILL_STATUS AS BILLSTATUS,TRIP_HEAD.CFINWARD_STATUS AS CFINWARDSTATUS,TRIP_HEAD.VEHICLE_OUT_DT_TIME AS VEHICLEOUTDTTIME,TRIP_HEAD.DRIVER_LS_EX_DT AS DRIVERLSEXDT,TRIP_HEAD.DRIVER_DOB AS DRIVERDOB,TRIP_HEAD.BASIC_AMT AS BASICAMT,TRIP_HEAD.GATE_OUT_STATUS AS GATEOUTSTATUS,TRIP_HEAD.TRIP_WO_ITEM AS TRIPWOITEM,TRIP_HEAD.GATE_IN_STATUS AS GATEINSTATUS,TRIP_HEAD.OUTWARD_LR_STATUS AS OUTWARDLRSTATUS,TRIP_HEAD.FLAG AS HFLAG,TRIP_HEAD.CREATED_BY AS CREATEDBY,TRIP_BODY.* FROM TRIP_HEAD , TRIP_BODY WHERE TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID AND TRIP_BODY.PSBILLBID=0 AND TRIP_HEAD.LR_ACK_STATUS = 1 $strWhere AND TRIP_BODY.DELIVERY_NO NOT IN (SELECT BD.DELIVERY_NO FROM TRIP_BODY BD, TRIP_HEAD HD WHERE HD.TRIPHID = BD.TRIPHID AND HD.LR_ACK_STATUS = 0 AND BD.DELIVERY_NO!='NULL')");
               //dd(DB::getQueryLog());

                $MASTERPLANTDATA = count($MASTERPLANT);

                $MASTERACC =  DB::select("SELECT * FROM MASTER_ACC WHERE 1=1 $accWhere");

                $MASTERACCDATA = json_decode(json_encode($MASTERACC),true);

                $MASTERACCADDR =  DB::select("SELECT * FROM MASTER_ACCADD WHERE 1=1 $accWhere");

                $MASTERACCADDRDATA = json_decode(json_encode($MASTERACCADDR),true);


         
                if ($MASTERPLANTDATA>0 || $MASTERACCADDR || $MASTERACCDATA) {

						$response_array['response']        = 'success';
						$response_array['get_data']        = $MASTERPLANT;
						$response_array['acc_addr_list']   = $MASTERACCADDR;
						$response_array['acc_detail_list'] = $MASTERACCDATA;
                	$data = json_encode($response_array);
                	print_r($data);

            	}else{

						$response_array['response']        = 'error';
						$response_array['get_data']        = '';
						$response_array['acc_addr_list']   = '';
						$response_array['acc_detail_list'] = '';
						$data = json_encode($response_array);
						print_r($data);
                
            	}


			}else{

				$response_array['response'] = 'error';
				$response_array['get_data'] = '';
				$response_array['acc_addr_list'] = '';
				$response_array['acc_detail_list'] = '';
				$data = json_encode($response_array);
				print_r($data);


			}

    }


    public function SaveSaleBill(Request $request){

    	if ($request->ajax()) {

    	    if (!empty($request->checkitm || $request->VRDATE || $request->TCODE || $request->SERIESCODE || $request->PLANTCODE || $request->PLANTCATG || $request->TRANTYPE || $request->ACCCODE || $request->ACCNAME || $request->FROMDATE || $request->TODATE || $request->DELIVERYNO || $request->WAGONNO || $request->LRNO || $request->VEHICLENO || $request->rowCount)) {

				$checkitm   = $request->checkitm;
				$VRDATE     = $request->VRDATE;
				$TCODE      = $request->TCODE;
				$SERIESCODE = $request->SERIESCODE;
				$PLANTCODE  = $request->PLANTCODE;
				$PLANTCATG  = $request->PLANTCATG;
				$TRANTYPE   = $request->TRANTYPE;
				$ACCCODE    = $request->ACCCODE;
				$ACCNAME    = $request->ACCNAME;
				$FROMDATE   = $request->FROMDATE;
				$TODATE     = $request->TODATE;
				$DELIVERYNO = $request->DELIVERYNO;
				$WAGONNO    = $request->WAGONNO;
				$LRNO       = $request->LRNO;
				$VEHICLENO  = $request->VEHICLENO;
				$ITEMCODE   = $request->ITEMCODE;
				$ITEMNAME   = $request->ITEMNAME;
				$TAXCODE    = $request->TAXCODE;
				$SAMEDELIVERYSTATUS    = $request->checkattr;
				$rowCount   = $request->rowCount;

				$EXPSERIES  = explode("[", $SERIESCODE);
				$MEXPSERIES  = explode("]", $EXPSERIES[1]);
				$SERCODE    = $EXPSERIES[0];
				$SERNAME    = $MEXPSERIES[0];

				$EXPPLANT   = explode("[", $PLANTCODE);
				$MEXPPLANTNM = explode("]", $EXPPLANT[1]);
				$PLTCODE    = $EXPPLANT[0];
				$PLTNAME    = $MEXPPLANTNM[0];



				$SR_CODE    = 'CAM1';
				$SR_NAME    = 'DESHMUKH';

				$base_url   = $request->session()->get('base_url');

		        $CompanyCode = $request->session()->get('company_name');
		        $mfiscalYear = $request->session()->get('fiscal_year');
				$ccode       = explode('-', $CompanyCode);
				$compCode    = $ccode[0];
				$fyCode      = $request->session()->get('macc_year');
				$userId      = $request->session()->get('userid');
				//$startYear   = $request->session()->get('fiscal_year');

				$vrDate   = date("Y-m-d", strtotime($VRDATE));
				$fromDate = date("Y-m-d", strtotime($FROMDATE));
				$toDate   = date("Y-m-d", strtotime($TODATE));

			
			/* ------ GET - ACCOUT SAP CODE -----*/
				
				$ACCSAPCODE = DB::table('MASTER_ACC')->where('ACC_CODE',$ACCCODE)->get()->first();

				$ACCSAPCODEDATA = json_decode(json_encode($ACCSAPCODE),true);

				if($ACCSAPCODEDATA){

					$M_SAP_CODE = $ACCSAPCODEDATA['SAP_CODE'];
				}else{

					$M_SAP_CODE = 'NOT-FOUND';
				}


			/* ----- GET - ACCOUT SAP CODE -----*/

	    DB::beginTransaction();

	    try {


        	$FLAG = 0;
        	$MHID = array();
        	$MYHID = array();
        	$BID;
        	$MDELIVERYNO='';
        	$MNEWVRNO = '';
        	$MQTYARR = array();
	    	$MRATEARR = array();
	    	$MVRNOARR = array();
	    	$newVr = 0;
	    	$mRowCount = count($checkitm);

			for ($i = 0; $i < $mRowCount; $i++) {

				/*echo "<pre>";
				print_r($i);*/

				$exp = explode("~", $checkitm[$i]);

		/* ----- /. START : VRNO CREATE OR GET FROM DB -------- */

				if ($i==0) {


					$lastVrno1 = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$SERCODE)->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('TRAN_CODE',$TCODE)->get()->first();

					$lastVrno = json_decode(json_encode($lastVrno1),true);
				
					if ($lastVrno) {

					   $newVr = $lastVrno['LAST_NO'] + 1;

					   $datavrn =array(
						   'LAST_NO' => $newVr
						);

					   DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$SERCODE)->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('TRAN_CODE',$TCODE)->update($datavrn);

					}else{

						$datavrnIn =array(
							'COMP_CODE'   => $compCode,
							'FY_CODE'     => $fyCode,
							'TRAN_CODE'   => $TCODE,
							'SERIES_CODE' => $SERCODE,
							'FROM_NO'     => 1,
							'TO_NO'       => 99999,
							'LAST_NO'     => 1,
							'CREATED_BY'  => $userId,
						);

						DB::table('MASTER_VRSEQ')->insert($datavrnIn);

						$newVr = 1;


					}

					$MNEWVRNO= $newVr;

				}else{

					/* DO NOTHING SAME VRNO FOR SAME DELIVERY NO */

				}

			

        	/* ------ /. END : VRNO CREATE OR GET FROM DB ------ */

		  	if($PLANTCATG == 'EX-SID'){


		     if ($i==0) {

		     	$MVRNOARR[] = $newVr;
		   	
			   	$data = array(

					'COMP_CODE'   => $compCode,
					'FY_CODE'     => $fyCode,
					'PFCT_CODE'   => $exp[3],
					'PFCT_NAME'   => $exp[4],
					'TRAN_CODE'   => $TCODE,
					'SERIES_CODE' => $SERCODE,
					'SERIES_NAME' => $SERNAME,
					'VRNO'        => $newVr,
					'VRDATE'      => $vrDate,
					'PLANT_CODE'  => $PLTCODE,
					'PLANT_NAME'  => $PLTNAME,
					'ACC_CODE'    => $ACCCODE,
					'ACC_NAME'    => $ACCNAME,
					'SR_CODE'     => $SR_CODE,
					'SR_NAME'     => $SR_NAME,
					'ITEM_CODE'   => $ITEMCODE,
					'ITEM_NAME'   => $ITEMNAME,
					'FSOHID'      => $exp[38],
					'FSOBID'      => $exp[39],
					'TRAN_TYPE'   => $TRANTYPE,
					'TAX_CODE'    => $TAXCODE,
					'TRPT_CODE'   => $exp[11],
					'TRPT_NAME'   => $exp[12],
					'VEHICAL_NO'  => $exp[5],
					'VEHICLE_TYPE'=> $exp[42],
					'BILL_TYPE'   => $TRANTYPE,
					'FLAG'        => $FLAG,
					'CREATED_BY'  => $userId

				);

	    		$saveHeadData = DB::table('SBILL_HEAD_PROV')->insert($data);

	    		$HID = DB::getPdo()->lastInsertId();
	    		$MHID[] = DB::getPdo()->lastInsertId();

	    		if ($exp[28]=='null' || $exp[28]==null || $exp[28]=='NULL' || $exp[28]=='0.00') {

	    			$MRATE = 0.00;
	    			
	    		}else{

	    			$MRATE = $exp[28];

	    		}

	    		if ($exp[20]=='null' || $exp[20]==null || $exp[20]=='NULL' || $exp[20]=='0.00') {

	    			$MQTY = 0.00;
	    			
	    		}else{

	    			$MQTY = $exp[20];

	    		}

	    		$MQTYARR[] = $MQTY;
	    		$MRATEARR[] = $MRATE;

	    		$BASIC_AMT = floatval($MRATE) * floatval($MQTY);
	    		

	    		$dataBody = array(
						
					'PSBILLHID'     => $HID,
					'SLNO'          => $i+1,
					'VRDATE'      	=> $vrDate,
					'CP_CODE'       => $exp[29],
					'CP_NAME'       => $exp[30],
					'SP_CODE'       => $exp[31],
					'SP_NAME'       => $exp[32],
					'QTYISSUED'     => $exp[20],
					'UM'            => $exp[26],
					'AQTYISSUED'    => $exp[33],
					'AUM'           => $exp[27],
					'RATE'          => $exp[28],
					'BASICAMT'      => $BASIC_AMT,
					'ACK_QTY'       => $exp[21],
					'ACK_DATE'      => $exp[44],
					'EBILL_NO'      => $exp[6],
					'EWAYB_VALIDDT' => $exp[7],
					'BILL_TYPE'     => $TRANTYPE,
					'DELIVERY_NO'   => $exp[16],
					'LR_NO'         => $exp[13],
					'LR_DATE'       => $exp[14],
					'INVC_NO'       => $exp[34],
					'INVC_DATE'     => $exp[35],
					'WAGON_NO'      => $exp[18],
					'WAGON_DATE'    => $exp[19],
					'DORDER_NO'     => $exp[17],
					'GROSS_WEIGHT'  => $exp[23],
					'NET_WEIGHT'    => $exp[22],
					'TRIPHID'       => $exp[1],
					'TRIPBID'       => $exp[2],
					'ALIAS_ITEM_CODE' => $exp[36],
					'ALIAS_ITEM_NAME' => $exp[37],
					'ITEM_SLNO' 	=> $exp[40],
					'FSO_REF_NO' 	=> $exp[41],
					'VEHICLE_NO'  	=> $exp[5],
					'VEHICLE_TYPE'	=> $exp[42],
					'DELIVERY_DATE'	=> $exp[43],
					'FROM_PLACE'	=> $exp[46],
					'TO_PLACE'		=> $exp[45],
					'TRIP_DAYS'		=> $exp[47],
					'SHORTAGE_QTY'  => $exp[48],
					'FLAG'          => $FLAG,
					'CREATED_BY'    => $userId

			    );

		   		$saveDataB = DB::table('SBILL_BODY_PROV')->insert($dataBody);


    		}else{

    		     	$GETMAXID = DB::select("SELECT MAX(PSBILLHID) AS SHID FROM SBILL_HEAD_PROV");

    		     	$DATAGETMAXID = json_decode(json_encode($GETMAXID),true);

    		     	$GETID = $DATAGETMAXID[0]['SHID'];

    		    	$DATAFOUND = DB::table('SBILL_BODY_PROV')->where('DELIVERY_NO',$exp[16])->where('PSBILLHID',$GETID)->get();

			   		$DATAFOUNDPROV = json_decode(json_encode($DATAFOUND),true);

			   	

		   	   if ($exp[28]=='null' || $exp[28]==null || $exp[28]=='NULL' || $exp[28]=='0.00') {

		    			$MRATE = 0.00;
		    			
		    		}else{

		    			$MRATE = $exp[28];

		    		}

		    		if ($exp[20]=='null' || $exp[20]==null || $exp[20]=='NULL' || $exp[20]=='0.00') {

		    			$MQTY = 0.00;
		    			
		    		}else{

		    			$MQTY = $exp[20];

		    		}

		    		$MQTYARR[] = $MQTY;
		    		$MRATEARR[] = $MRATE;

		    		$BASIC_AMT = floatval($MRATE) * floatval($MQTY);

		   	    	//$HID1 = $DATAFOUNDPROV[0]['PSBILLHID'];

	    		    $dataBody = array(
						
						'PSBILLHID'     => $GETID,
						'SLNO'          => $i+1,
						'VRDATE'      	=> $vrDate,
						'CP_CODE'       => $exp[29],
						'CP_NAME'       => $exp[30],
						'SP_CODE'       => $exp[31],
						'SP_NAME'       => $exp[32],
						'QTYISSUED'     => $exp[20],
						'UM'            => $exp[26],
						'AQTYISSUED'    => $exp[33],
						'AUM'           => $exp[27],
						'RATE'          => $exp[28],
						'BASICAMT'      => $BASIC_AMT,
						'ACK_QTY'       => $exp[21],
						'ACK_DATE'      => $exp[44],
						'EBILL_NO'      => $exp[6],
						'EWAYB_VALIDDT' => $exp[7],
						'BILL_TYPE'     => $TRANTYPE,
						'DELIVERY_NO'   => $exp[16],
						'LR_NO'         => $exp[13],
						'LR_DATE'       => $exp[14],
						'INVC_NO'       => $exp[34],
						'INVC_DATE'     => $exp[35],
						'WAGON_NO'      => $exp[18],
						'WAGON_DATE'    => $exp[19],
						'DORDER_NO'     => $exp[17],
						'GROSS_WEIGHT'  => $exp[23],
						'NET_WEIGHT'    => $exp[22],
						'TRIPHID'       => $exp[1],
						'TRIPBID'       => $exp[2],
						'ALIAS_ITEM_CODE' => $exp[36],
						'ALIAS_ITEM_NAME' => $exp[37],
						'ITEM_SLNO' 	=> $exp[40],
						'FSO_REF_NO' 	=> $exp[41],
						'VEHICLE_NO'  	=> $exp[5],
						'VEHICLE_TYPE'	=> $exp[42],
						'DELIVERY_DATE'	=> $exp[43],
						'FROM_PLACE'	=> $exp[45],
						'TO_PLACE'		=> $exp[46],
						'TRIP_DAYS'		=> $exp[47],
						'SHORTAGE_QTY'  => $exp[48],
						'FLAG'          => $FLAG,
						'CREATED_BY'    => $userId

			    	);

		   		$saveDataB = DB::table('SBILL_BODY_PROV')->insert($dataBody);
		   		$BID = DB::getPdo()->lastInsertId();
		   		
		   	


    		 } /* ./ IF I==0 POSTION */


    	/* ~~~~~~~~~ ./ Ex-Siding IF Close ~~~~~~~~~~~~~~ */

    		}else if($PLANTCATG=='YARD'){ 

    	/* ...... ./ Yard else Start ................. */

    			if ($i==0) {
    				

    				$MVRNOARR[] = $newVr;

	    		   	$data = array(

						'COMP_CODE'   => $compCode,
						'FY_CODE'     => $fyCode,
						'PFCT_CODE'   => $exp[3],
						'PFCT_NAME'   => $exp[4],
						'TRAN_CODE'   => $TCODE,
						'SERIES_CODE' => $SERCODE,
						'SERIES_NAME' => $SERNAME,
						'VRNO'        => $newVr,
						'VRDATE'      => $vrDate,
						'PLANT_CODE'  => $PLTCODE,
						'PLANT_NAME'  => $PLTNAME,
						'ACC_CODE'    => $ACCCODE,
						'ACC_NAME'    => $ACCNAME,
						'SR_CODE'     => $SR_CODE,
						'SR_NAME'     => $SR_NAME,
						'ITEM_CODE'   => $ITEMCODE,
						'ITEM_NAME'   => $ITEMNAME,
						'FSOHID'      => $exp[38],
						'FSOBID'      => $exp[39],
						'TRAN_TYPE'   => $TRANTYPE,
						'TAX_CODE'    => $TAXCODE,
						'TRPT_CODE'   => $exp[11],
						'TRPT_NAME'   => $exp[12],
						'VEHICAL_NO'  => $exp[5],
						'VEHICLE_TYPE'=> $exp[42],
						'BILL_TYPE'   => $TRANTYPE,
						'FLAG'        => $FLAG,
						'CREATED_BY'  => $userId

					);

		    		$saveHeadData = DB::table('SBILL_HEAD_PROV')->insert($data);

		    		$HID = DB::getPdo()->lastInsertId();

		    		$GETMAXID = DB::select("SELECT MAX(PSBILLHID) AS SHID FROM SBILL_HEAD_PROV");

    		     	$DATAGETMAXID = json_decode(json_encode($GETMAXID),true);

    		     	$MYHID[] = $HID;

    		     	$GETID = $DATAGETMAXID[0]['SHID'];

		    		if ($exp[28]=='null' || $exp[28]==null || $exp[28]=='NULL' || $exp[28]=='0.00') {

		    			$MRATE = 0.00;
		    			
		    		}else{

		    			$MRATE = $exp[28];

		    		}

		    		if ($exp[20]=='null' || $exp[20]==null || $exp[20]=='NULL' || $exp[20]=='0.00') {

		    			$MQTY = 0.00;
		    			
		    		}else{

		    			$MQTY = $exp[20];

		    		}

		    		$MQTYARR[] = $MQTY;
		    		$MRATEARR[] = $MRATE;

		    		$BASIC_AMT1 = floatval($MRATE) * floatval($MQTY);

		    		if ($BASIC_AMT1=='' || empty($BASIC_AMT1)) {

		    			$BASIC_AMT = '00.00';
		    			
		    		}else{

						$BASIC_AMT = $BASIC_AMT1;

		    		}

		    		$dataBody = array(
							
						'PSBILLHID'     => $GETID,
						'SLNO'          => $i+1,
						'VRDATE'      	 => $vrDate,
						'CP_CODE'       => $exp[29],
						'CP_NAME'       => $exp[30],
						'SP_CODE'       => $exp[31],
						'SP_NAME'       => $exp[32],
						'QTYISSUED'     => $exp[20],
						'UM'            => $exp[26],
						'AQTYISSUED'    => $exp[33],
						'AUM'           => $exp[27],
						'RATE'          => $exp[28],
						'BASICAMT'      => $BASIC_AMT,
						'ACK_QTY'       => $exp[21],
						'ACK_DATE'      => $exp[44],
						'EBILL_NO'      => $exp[6],
						'EWAYB_VALIDDT' => $exp[7],
						'BILL_TYPE'     => $TRANTYPE,
						'DELIVERY_NO'   => $exp[16],
						'LR_NO'         => $exp[13],
						'LR_DATE'       => $exp[14],
						'INVC_NO'       => $exp[34],
						'INVC_DATE'     => $exp[35],
						'WAGON_NO'      => $exp[18],
						'WAGON_DATE'    => $exp[19],
						'DORDER_NO'     => $exp[17],
						'GROSS_WEIGHT'  => $exp[23],
						'NET_WEIGHT'    => $exp[22],
						'TRIPHID'       => $exp[1],
						'TRIPBID'       => $exp[2],
						'ALIAS_ITEM_CODE' => $exp[36],
						'ALIAS_ITEM_NAME' => $exp[37],
						'ITEM_SLNO' 	=> $exp[40],
						'FSO_REF_NO' 	=> $exp[41],
						'VEHICLE_NO'  	=> $exp[5],
						'VEHICLE_TYPE'	=> $exp[42],
						'DELIVERY_DATE'	=> $exp[43],
						'FROM_PLACE'	=> $exp[45],
						'TO_PLACE'		=> $exp[46],
						'TRIP_DAYS'		=> $exp[47],
						'SHORTAGE_QTY'  => $exp[48],
						'FLAG'          => $FLAG,
						'CREATED_BY'    => $userId

				    );

			   		$saveDataB = DB::table('SBILL_BODY_PROV')->insert($dataBody);



    			}else{

    				$GETMAXID = DB::select("SELECT MAX(PSBILLHID) AS SHID FROM SBILL_HEAD_PROV");

    		     	$DATAGETMAXID = json_decode(json_encode($GETMAXID),true);

    		     	$GETID1 = $DATAGETMAXID[0]['SHID'];


    				if ($exp[28]=='null' || $exp[28]==null || $exp[28]=='NULL' || $exp[28]=='0.00') {

		    			$MRATE = 0.00;
		    			
		    		}else{

		    			$MRATE = $exp[28];

		    		}

		    		if ($exp[20]=='null' || $exp[20]==null || $exp[20]=='NULL' || $exp[20]=='0.00') {

		    			$MQTY = 0.00;
		    			
		    		}else{

		    			$MQTY = $exp[20];

		    		}

		    		$MQTYARR[] = $MQTY;
		    		$MRATEARR[] = $MRATE;

		    		$BASIC_AMT1 = floatval($MRATE) * floatval($MQTY);

		    		if ($BASIC_AMT1=='' || empty($BASIC_AMT1)) {

		    			$BASIC_AMT = '00.00';
		    			
		    		}else{

						$BASIC_AMT = $BASIC_AMT1;

		    		}

		    		$dataBody = array(
							
						'PSBILLHID'     => $GETID1,
						'SLNO'          => $i+1,
						'VRDATE'      	=> $vrDate,
						'CP_CODE'       => $exp[29],
						'CP_NAME'       => $exp[30],
						'SP_CODE'       => $exp[31],
						'SP_NAME'       => $exp[32],
						'QTYISSUED'     => $exp[20],
						'UM'            => $exp[26],
						'AQTYISSUED'    => $exp[33],
						'AUM'           => $exp[27],
						'RATE'          => $exp[28],
						'BASICAMT'      => $BASIC_AMT,
						'ACK_QTY'       => $exp[21],
						'ACK_DATE'      => $exp[44],
						'EBILL_NO'      => $exp[6],
						'EWAYB_VALIDDT' => $exp[7],
						'BILL_TYPE'     => $TRANTYPE,
						'DELIVERY_NO'   => $exp[16],
						'LR_NO'         => $exp[13],
						'LR_DATE'       => $exp[14],
						'INVC_NO'       => $exp[34],
						'INVC_DATE'     => $exp[35],
						'WAGON_NO'      => $exp[18],
						'WAGON_DATE'    => $exp[19],
						'DORDER_NO'     => $exp[17],
						'GROSS_WEIGHT'  => $exp[23],
						'NET_WEIGHT'    => $exp[22],
						'TRIPHID'       => $exp[1],
						'TRIPBID'       => $exp[2],
						'ALIAS_ITEM_CODE' => $exp[36],
						'ALIAS_ITEM_NAME' => $exp[37],
						'ITEM_SLNO' 	=> $exp[40],
						'FSO_REF_NO' 	=> $exp[41],
						'VEHICLE_NO'  	=> $exp[5],
						'VEHICLE_TYPE'	=> $exp[42],
						'DELIVERY_DATE'	=> $exp[43],
						'FROM_PLACE'	=> $exp[45],
						'TO_PLACE'		=> $exp[46],
						'TRIP_DAYS'		=> $exp[47],
						'SHORTAGE_QTY'  => $exp[48],
						'FLAG'          => $FLAG,
						'CREATED_BY'    => $userId

				    );

			   		$saveDataB = DB::table('SBILL_BODY_PROV')->insert($dataBody);


    			}

	    		  	

    		}else{

    			/* --------- DO NOTHING ------ */

    		} /* ./ plant category check if close */

    		  
			
		} /* ./ for loop close */

		//exit();




    /* -------START : TEXT FILE DOWNLOAD --------------- */


		$MSHIDCOUNT = count($MHID);
		$MYHIDCOUNT = count($MYHID);
		$MHIDCOUNT = '';
		if ($MSHIDCOUNT>0) {

    		$MHIDCOUNT = $MSHIDCOUNT;

    	}else{

    		$MHIDCOUNT = $MYHIDCOUNT;

    	}

		
		$FILENAMEARR = array();
		$SHOWBILLNO ='';
		for ($j = 0; $j < $MHIDCOUNT; $j++) {

		     $SRNO = $j + 1;
		   
		    if($PLANTCATG == 'EX-SID'){
		     	

		     	$GETBODYDATA = DB::select("SELECT PSBILLBID,LR_DATE,VRDATE,ACK_DATE,DELIVERY_NO,INVC_NO,ITEM_SLNO,
		     		VEHICLE_TYPE,VEHICLE_NO,QTYISSUED,LR_NO,SUM(QTYISSUED) AS QTYISSUED,FSO_REF_NO,SUM(BASICAMT) AS BASICAMT FROM SBILL_BODY_PROV WHERE PSBILLHID = '$MHID[$j]' GROUP BY INVC_NO,ITEM_SLNO");

		    }else{


		    	//DB::enableQueryLog();
			   $GETBODYDATA = DB::select("SELECT H.FY_CODE,H.SERIES_CODE,H.VRNO, B.PSBILLBID,B.LR_DATE,B.VRDATE,B.ACK_DATE,B.DELIVERY_NO,B.DELIVERY_DATE,B.INVC_NO,B.ITEM_SLNO,B.VEHICLE_TYPE,B.VEHICLE_NO,B.QTYISSUED,B.LR_NO,SUM(B.ACK_QTY) AS ACK_QTY,SUM(B.QTYISSUED) AS QTYISSUED,B.FSO_REF_NO,SUM(B.BASICAMT) AS BASICAMT FROM SBILL_HEAD_PROV H LEFT JOIN SBILL_BODY_PROV B ON H.PSBILLHID = B.PSBILLHID WHERE B.PSBILLHID = '$MYHID[$j]' GROUP BY B.DELIVERY_NO");
			   //dd(DB::getQueryLog());

		     	//$GETBODYDATA = DB::table('SBILL_BODY_PROV')->where('PSBILLHID',$MHID[$j])->get();

		    }

		     $GETSBILLBODYDATA = json_decode(json_encode($GETBODYDATA),true);

		     $ZONE = 'W';
		     $MINGUARANTEEQTY = 0;
		     $TARPAULIN = 'Y';

		     $GETSBILLDATACOUNT = count($GETSBILLBODYDATA);

		     if ($PLANTCATG == 'EX-SID') {

		    /* ~~~~~~~~~~~~~~~ START : EX-SID DATA ~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		     	$ADDCONTENTINTEXT = array();
		     	foreach ($GETSBILLBODYDATA as $row) {

		     		$GETBID = $row['PSBILLBID'];
		     		$GETDELIVERYNO = $row['DELIVERY_NO'];

		     		$MLRDATE    = date("d.m.Y", strtotime($row['LR_DATE']));
		     		$MVRDATE    = date("d.m.Y", strtotime($row['VRDATE']));
		     		$MACKDATE    = date("d.m.Y", strtotime($row['ACK_DATE']));

			     	if ($TRANTYPE == 'DIRECT') {

			     		$ADDCONTENTINTEXT1 = $row['INVC_NO'].'	'.$row['ITEM_SLNO'].'	'.'00000'.$M_SAP_CODE.'	'.$MLRDATE.'	'.$row['VEHICLE_TYPE'].'	'.$row['VEHICLE_NO'].'	'.$row['QTYISSUED'].'	'.$row['LR_NO'].'	'.$MLRDATE.'	'.$MACKDATE.'	'.$row['QTYISSUED'].'	'.$row['FSO_REF_NO'].'	'.$ZONE.'	'.$MINGUARANTEEQTY.'	'.$TARPAULIN.'	'.$row['BASICAMT']."\n";
			     		
			     	}else{

			     		$ADDCONTENTINTEXT1 = $row['INVC_NO'].'	'.$row['ITEM_SLNO'].'	'.'00000'.$M_SAP_CODE.'	'.$MLRDATE.'	'.$row['FSO_REF_NO'].'	'.$row['QTYISSUED'].'	'.$ZONE.'	'.$row['BASICAMT']."\n";
			     	}


			     	array_push($ADDCONTENTINTEXT,$ADDCONTENTINTEXT1);
			     	
				}

			/* ~~~~~~~~~~~~~~~ END : EX-SID DATA ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
		     	
		     }else{

		/* ~~~~~~~~~~~~~~~ START : YARD DATA ~~~~~~~~~~~~~~~~~~~~~~~~~~ */


				$ADDCONTENTINTEXT = array();
		     	foreach ($GETSBILLBODYDATA as $row) {

		     		$GETBID = $row['PSBILLBID'];
			     	$GETDELIVERYNO = $row['DELIVERY_NO'];

			     	$MVRDATE1    = date("d.m.Y", strtotime($row['VRDATE']));
			     	$MDELIDATE    = date("d.m.Y", strtotime($row['DELIVERY_DATE']));


			     	if ($TRANTYPE == 'DIRECT') {

			     		$MLRDATE1    = date("d.m.Y", strtotime($row['LR_DATE']));
			     		$MVRDATE    = date("d.m.Y", strtotime($row['VRDATE']));

			     		$FYCD = $row['FY_CODE'];
			     		$EXP = explode('-',$FYCD);
			     		$FYEAR = $EXP[0];

			     		$TEMPBILLNO = $FYEAR.'/'.trim($row['SERIES_CODE']).'/'.$row['VRNO'];

			     		$GETBONUS = '0.00';
			     		$SECTIONCODE = 'ZKOL';
			     		$DELQTY = '0';
			     		$CONDITIONOFGOODS = 'G';

			     		$ADDCONTENTINTEXT0 = '00000'.$M_SAP_CODE.'	'.$row['DELIVERY_NO'].'     '.$TEMPBILLNO.'	'.$GETBONUS.'	'.$GETBONUS.'	'.$row['BASICAMT'].'	'.$MVRDATE.'	'.$SECTIONCODE.'	'.$DELQTY.'	'.$row['QTYISSUED'].'	'.$MDELIDATE.'	'.$TARPAULIN.'	'.$CONDITIONOFGOODS."\n";
			     		
			     	}else{

			     		$PONO = '0.00';
			     		$GETBONUS = '0.00';
			     		$TEMPBILLNO1 = $FYEAR.'/'.trim($row['SERIES_CODE']).'/'.$row['VRNO'];
			     		$MVRDATE1    = date("d.m.Y", strtotime($row['VRDATE']));
			     		$SECTIONCODE1 = 'ZKOL';
		     		   $MLRDATE1    = date("d.m.Y", strtotime($row['LR_DATE']));

		     	      $ADDCONTENTINTEXT0 = '00000'.$M_SAP_CODE.'	'.$row['DELIVERY_NO'].'	'.$TEMPBILLNO1.'	'.$GETBONUS.'	'.$GETBONUS.'	'.$row['BASICAMT'].'	'.$MVRDATE1.'	'.$SECTIONCODE1.'	'.$PONO."\n";

			     	}

			     	array_push($ADDCONTENTINTEXT,$ADDCONTENTINTEXT0);


		     	}

		     	
		/* ~~~~~~~~~~~~~~~ END : YARD DATA ~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		     }

		    
    		     $MVRNO = trim($SERCODE).'/'.$mfiscalYear.'/'.$MVRNOARR[$j].'.txt';
    		     $SHOWBILLNO = $mfiscalYear.'/'.trim($SERCODE).'/'.$MVRNOARR[$j];

    		     $FILENAMEARR[] = $MVRNO;

    		     Storage::disk('local')->put($MVRNO, $ADDCONTENTINTEXT);
    		     //Storage::disk('local_drive')->put($MVRNO, $ADDCONTENTINTEXT);

    		     $path = 'storage/app/my-file/';

    		     $getFile = $base_url.$path.$MVRNO;

    		     $getFileFrPorjct = 'E:'.$MVRNO;

    			  
        		//Storage::copy($getFile, $getFileFrPorjct);


    		      DB::select("UPDATE TRIP_BODY B SET B.PSBILLBID = '$GETBID',B.PROVBILL_STATUS = '1' WHERE B.DELIVERY_NO = '$GETDELIVERYNO' AND B.TRIPHID = (SELECT H.TRIPHID FROM TRIP_HEAD H WHERE H.TRIPHID=B.TRIPHID AND H.LR_ACK_STATUS = 1);");

			
		} /* ./ HID FOR LOOP CLOSE */


    /* ------- END : TEXT FILE DOWNLOAD --------------- */

              

	     	   /* ------ START : FILE STORAGE PATH ON SERVER ------- */

					$MVRNO1 = 'file.txt';
					$path = 'storage/app/my-file'; 
					$fileName    =  $MVRNO1;
					$downloadPdf = $path.'/'.$fileName;

				/* ------ END : FILE STORAGE PATH ON SERVER ------- */
					

						DB::commit();

						$response_array['response']       = 'success';
						$response_array['file_path']      = $path;
						$response_array['file_name']      = $FILENAMEARR;
						$response_array['temp_bill_no']   = $SHOWBILLNO;
		          	$data = json_encode($response_array);
		          	print_r($data);

			            	

			   }catch (\Exception $e) {

			   		DB::rollBack();
				    	throw $e;
						$response_array['response']   = 'error';
						$response_array['file_path']  = '';
						$response_array['temp_bill_no']   = '';
						$data = json_encode($response_array);
						print_r($data);
			                
			            	
			   }



	    }else{

			$response_array['response']  = 'error';
			$response_array['file_path']  = '';
			$response_array['temp_bill_no']   = '';
			$data = json_encode($response_array);
			print_r($data);
	                

	    } /* ./ ---- all data check if condition top -----*/

	}else{

		$response_array['response']  = 'error';
		$response_array['file_path']  = '';
		$response_array['temp_bill_no']   = '';
		$data = json_encode($response_array);
		print_r($data);
                
           
	}/* ./ AJAX if condition on top.... */


    } /* /. --------- Save Bill Function Close ------*/


    public function DirectSaleBillLogisticsSaveMsgTemp(Request $request,$saveData){
	 
		if ($saveData == 'false') {
			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/logistic/sale-bill-provisional');

		} else {
			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/logistic/sale-bill-provisional');
		}

   	}


   public function SaleBillFinalLogistics(Request $request){


   	$title       =	'Logistics - Sale Bill Final';
	$compCodeName = $request->session()->get('company_name');
	$compcode    = explode('-', $compCodeName);
	$getcompcode = $compcode[0];
	$macc_year   = $request->session()->get('macc_year');
	$transCode   = 'S5';

	$tableData = MyConstruct();

	$userdata['acc_list']     = $tableData['master_party'];

	$rate_list   = $this->master_rateValue;

	$getCommonData = MyCommonFun($transCode,$compcode,$macc_year);

	$userdata['series_list'] = $getCommonData['getseries'];

	$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$transCode)->get();

	$userdata['trans_head'] =$transCode[0]->TRAN_CODE;

	$userdata['ratval_list'] = DB::table('MASTER_RATE_VALUE')->get()->toArray();

	$accCatglist  = DB::table('MASTER_ACATG')->get();

	$tripBodylist  = DB::table('TRIP_BODY')->get()->toArray();
	
	$plantlist  = DB::table('MASTER_PLANT')->where('COMP_CODE',$getcompcode)->get()->toArray();

	$taxList  = DB::table('MASTER_TAX')->get()->toArray();

 	if(isset($compCodeName)){

	    return view('admin.finance.transaction.logistic.sale_bill_final',$userdata+compact('title','plantlist','accCatglist','rate_list','taxList'));

	}else{

	    return redirect('/useractivity');
	
	}


   }

   public function getDataFromSbillProvOnSaleBillFinal(Request $request){

    	if ($request->ajax()) {


    	    if (!empty($request->vrDateId || $request->series_code || $request->plant_code || $request->tranType || $request->accountCode || $request->mCurrentStatus)) {

				$vrDateId       = $request->vrDateId;
				$series_code    = $request->series_code;
				$plantCode      = $request->plant_code;
				$mCurrentStatus = $request->mCurrentStatus;
				
				$exp_plant      = explode("[",$plantCode);
				$newPlantCode   = explode("]",$exp_plant[0]);
				$plant_code     = trim($newPlantCode[0]);
				
				$tranType       = $request->tranType;
				$accountCode    = $request->accountCode;
				
				$CompanyCode    = $request->session()->get('company_name');
				$compcode       = explode('-', $CompanyCode);
				$getcompcode    = $compcode[0];
				$macc_year      = $request->session()->get('macc_year');

		
                $strWhere = '';

               
        		if(isset($accountCode)  && trim($accountCode)!=""){

                    $strWhere .= " AND HP.ACC_CODE = '$accountCode'";

                }
      
             	if(isset($getcompcode)  && trim($getcompcode)!=""){

             	     $strWhere .= " AND HP.COMP_CODE = '$getcompcode'";

             	}

             	if(isset($plant_code)  && trim($plant_code)!=""){

             	    $mplant_code = trim($plant_code);

                    $strWhere .= " AND HP.PLANT_CODE = '$mplant_code'";

                }


                if(isset($tranType)  && trim($tranType)!=""){

                    $strWhere .= " AND HP.TRAN_TYPE = '$tranType'";

                }

                $strWhere1 = '1=1 ';
                if(isset($mCurrentStatus)  && trim($mCurrentStatus)!=""){

                    $strWhere .= " AND BP.CURRENT_STATUS = '$mCurrentStatus'";

                    $strWhere1 .= " AND BP.CURRENT_STATUS != '$mCurrentStatus'";

                }

				//DB::enableQueryLog();

               $data = DB::select("SELECT HP.*,BP.* FROM SBILL_HEAD_PROV HP,SBILL_BODY_PROV BP WHERE HP.PSBILLHID = BP.PSBILLHID  $strWhere AND (BP.SBILLHID IS NULL OR BP.SBILLHID='0') AND HP.PSBILLHID NOT IN (SELECT PSBILLHID FROM SBILL_BODY_PROV WHERE $strWhere1) ORDER BY HP.VRDATE,HP.VRNO");

                //dd(DB::getQueryLog());

				return DataTables()->of($data)->addIndexColumn()->make(true);

					
	    }else{

			$data = array();
			return DataTables()->of($data)->addIndexColumn()->make(true);

	    }/* ./ Data Check Condition If Close */



    	}else{

		     $data = array();
		     return DataTables()->of($data)->addIndexColumn()->make(true);

    	}/* ./ ajax if close */


    }



    public function saveFinalSaleBill(Request $request){

    	
    	if ($request->ajax()) {


    		if (!empty($request->hidSeriesCode || $request->hidPlantCode || $request->hidPlantCatg || $request->hidTranType || $request->hidTcode || $request->hidAccCode)) {

				/* --- START : GET HEAD DATA --- */

				$TOTCHEKBXCOUNT = $request->hidCheckBoxCount;

				$VRDATE       = $request->hidVrDate;
				$TCODE        = $request->hidTcode;
				$SERIESCODE   = $request->hidSeriesCode;
				$PLANTCODE    = $request->hidPlantCode;
				$PLANTCAT     = $request->hidPlantCatg;
				$TRANTYPE     = $request->hidTranType;
				$ACCCODE      = $request->hidAccCode;
				$ACCNAME      = $request->hidAccNm;
				$ACCGLCD      = $request->hidAccGl;
				$ACCGLNM      = $request->hidAccGlNm;
				$SERIESGLCD   = $request->hidSeriesGlCd;
				$SERIESGLNM   = $request->hidSeriesGlNm;
				$GRANDTOTAL   = $request->TotalGrandAmt;
				$PDFGENSTATUS = $request->pdfYesNoStatus;
				$ACC_ADDRESS  = $request->acc_address;
				$ACC_CITY 	  = $request->acc_city;
				$ACC_PAN 	  = $request->acc_pan;
				$ACC_GSTIN 	  = $request->acc_gstin;
				$GRANDTOTWORD = $request->grandTotWord;
				$ROWOFTBL	  = $request->rowIdTbl;
				$ISCHEKYESNO  = $request->isChekYesNo;
				$BILLFORMAT   = $request->acc_billFormat;

				$EXP = explode('(', $ACC_CITY);

				$getExp = $EXP[1];

				$newExp = explode(')',$getExp);

				$ACCSTATE = $newExp[0];

				$NEWVRDT    = date("Y-m-d", strtotime($VRDATE));

				/* --- END : GET HEAD DATA --- */


				/* --- EXPLODE DATA ----- */

	    		$EXPSERIES  = explode("[", $SERIESCODE);
				$MEXPSERIES  = explode("]", $EXPSERIES[1]);
				$SERCODE    = trim($EXPSERIES[0]);
				$SERNAME    = $MEXPSERIES[0];

				$EXPPLANT   = explode("[", $PLANTCODE);
				$MEXPPLANTNM = explode("]", $EXPPLANT[1]);
				$PLTCODE    = $EXPPLANT[0];
				$PLTNAME    = $MEXPPLANTNM[0];

				/* --- ./ EXPLODE DATA ----- */

				
				/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

				$base_url   = $request->session()->get('base_url');
		        $CompanyCode = $request->session()->get('company_name');
		        $mfiscalYear = $request->session()->get('fiscal_year');
				$ccode       = explode('-', $CompanyCode);
				$compCode    = $ccode[0];
				$fyCode      = $request->session()->get('macc_year');
				$userId      = $request->session()->get('userid');

				/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */



				/* ------ GET BODY DATA IN ARRAY ------ */

				//$MGETKEY = array_keys(array_filter($request->getTaxCode));
				

				//$MTAXCODE    	 = array_values(array_filter($request->getTaxCode));

				$CHECKBOXDATA 	 = $request->checkBoxId;
				

				/* ------- ./ GET BODY DATA IN ARRAY ------ */

			DB::beginTransaction();

		    try {

				/* ------ CHECK TEMPORARY DATA IN TABLE -------- */

					DB::table('INDICATOR_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','SBFT')->delete();

				/* ------ CHECK TEMPORARY DATA IN TABLE -------- */



				/* ~~~~~~~~~~ FOR LOOP FIRST ~~~~~~~~~ */

				$HSRNO = 1;
				$MNEWVRNO = '';
		    	$GETHEDID;
		    	$LASTID;
		    	$MBASICAMT = array();
		    	$EXPCHECKBOXDATA1=array();
		    	$HIDBID = array();
		    	$ARRSBILLBID = array();
		    	$GETID = '';
		    	$grandAmtGet = 0;
		    	$BODYIDGET = array();
		    	$MVRNO = '';
				for ($i = 0; $i < $TOTCHEKBXCOUNT; $i++) {

					$GETTBLROW = $ROWOFTBL[$i];


					//$GETKEY = $MGETKEY[$i];

					//$GETNEWKEY = $GETKEY + 1;

					$EXPCHECKBOXDATA = explode("~",$CHECKBOXDATA[$i]);

					$MFLAG = 1;

					$PSBHID      = $EXPCHECKBOXDATA[0];
					$PSBBID      = $EXPCHECKBOXDATA[1];
					$TAXCODE     = $request->taxCode;
					
					$HIDBID[]    = $PSBHID.'~'.$PSBBID;
					
					$TRN_NO      = $EXPCHECKBOXDATA[27];
					
					$TBLROWCOUNT = $EXPCHECKBOXDATA[28];
					
					$TAXAMT      = 'rowtaxAmount_'.$TBLROWCOUNT;
					
					$TAXAMTDT    = $request->input($TAXAMT);
					
					$MITEMCODE   = $EXPCHECKBOXDATA[20];
					$MITEM_NAME  = $EXPCHECKBOXDATA[21];

					
					$ITEMHSN = DB::table('MASTER_ITEM')->WHERE('ITEM_CODE',$MITEMCODE)->WHERE('ITEM_NAME',$MITEM_NAME)->get();

					$MITEMHSN = json_decode(json_encode($ITEMHSN),true);


				/* ----- /. START : VRNO CREATE OR GET FROM DB -------- */

					if ($MNEWVRNO!=$EXPCHECKBOXDATA[16]) {

						$MNEWVRNO= $EXPCHECKBOXDATA[16];

						$lastVrno1 = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$SERCODE)->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('TRAN_CODE',$TCODE)->get()->first();

						$lastVrno = json_decode(json_encode($lastVrno1),true);
					
						if ($lastVrno) {

						   $newVr = $lastVrno['LAST_NO'] + 1;

						   $datavrn =array(
							   'LAST_NO' => $newVr
							);

						   DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$SERCODE)->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('TRAN_CODE',$TCODE)->update($datavrn);

						}else{

							$datavrnIn =array(
								'COMP_CODE'   => $compCode,
								'FY_CODE'     => $fyCode,
								'TRAN_CODE'   => $TCODE,
								'SERIES_CODE' => $SERCODE,
								'FROM_NO'     => 1,
								'TO_NO'       => 99999,
								'LAST_NO'     => 1,
								'CREATED_BY'  => $userId,
							);

							DB::table('MASTER_VRSEQ')->insert($datavrnIn);

							$newVr = 1;


						}

					}else{

						/* DO NOTHING SAME VRNO FOR SAME DELIVERY NO */

					}


        		/* ------ /. END : VRNO CREATE OR GET FROM DB ------ */

        		

				/* ~~~~~~ HEAD AND BODY DATA SAVE ~~~~~~~~~~ */

					if ($i==0) {

						$pdfBillNo = $mfiscalYear.'/'.$SERCODE.'/'.$newVr;

						$MVRNO = $newVr;

						$GETMAXID = DB::select("SELECT MAX(SBILLHID) AS SBHID FROM SBILL_HEAD");

		     			$DATAGETMAXID = json_decode(json_encode($GETMAXID),true);


		     			$MDATAGETMAXID = count($DATAGETMAXID);

		     			if ($MDATAGETMAXID > 0) {
		     				
		     				$GETID = $DATAGETMAXID[0]['SBHID'] + 1;

		     			}else{

		     				$GETID = 1;

		     			}


						$MHEADDATA = array(

							'SBILLHID'		=> $GETID,
							'COMP_CODE'		=> $compCode,
							'FY_CODE'     	=> $fyCode,
							'PFCT_CODE'   	=> $EXPCHECKBOXDATA[14],
							'PFCT_NAME'    	=> $EXPCHECKBOXDATA[15],
							'TRAN_CODE'    	=> $TCODE,
							'SERIES_CODE'   => $SERCODE,
							'SERIES_NAME'   => $SERNAME,
							'VRNO'    		=> $newVr,
							'SLNO'    		=> $HSRNO,
							'VRDATE'    	=> $NEWVRDT,
							'PLANT_CODE'    => $PLTCODE,
							'PLANT_NAME'    => $PLTNAME,
							'ACC_CODE'    	=> $ACCCODE,
							'ACC_NAME'    	=> $ACCNAME,
							'TRAN_TYPE'    	=> $TRANTYPE,
							'PSBILLHID'    	=> $PSBHID,
							'TAX_CODE'    	=> $TAXCODE,
							'FLAG'    		=> $MFLAG,
							'CREATED_BY' 	=> $userId

						);

						DB::table('SBILL_HEAD')->insert($MHEADDATA);



							$LASTID = $GETID;
							$GETHEDID = $GETID;

							$GETMAXIDBD = DB::select("SELECT MAX(SBILLBID) AS SBBID FROM SBILL_BODY");

			     			$DATAGETMAXIDBD = json_decode(json_encode($GETMAXIDBD),true);

			     			$MDATAGETMAXIDBD = count($DATAGETMAXIDBD);

			     			if ($MDATAGETMAXIDBD > 0) {
			     				
			     				$GETBID = $DATAGETMAXIDBD[0]['SBBID'] + 1;

			     			}else{

			     				$GETBID = 1;

			     			}

			     			$LASTID = $GETBID;
			     			$ARRSBILLBID[] = $GETID;

			     			$BODYIDGET[] = $GETBID;

							$MBODYDATA = array(

								'SBILLHID'       => $GETID,
								'SBILLBID'       => $GETBID,
								'COMP_CODE'      => $compCode,
								'FY_CODE'        => $fyCode,
								'PFCT_CODE'      => $EXPCHECKBOXDATA[14],
								'TRAN_CODE'      => $TCODE,
								'SERIES_CODE'    => $SERCODE,
								'VRNO'           => $newVr,
								'SLNO'           => $HSRNO,
								'VRDATE'         => $NEWVRDT,
								'PLANT_CODE'     => $PLTCODE,
								'ITEM_CODE'      => $EXPCHECKBOXDATA[20],
								'ITEM_NAME'      => $EXPCHECKBOXDATA[21],
								'HSN_CODE'       => $MITEMHSN[0]['HSN_CODE'],
								'QTYISSUED'      => $EXPCHECKBOXDATA[9],
								'UM'             => $EXPCHECKBOXDATA[17],
								'AQTYISSUED'     => $EXPCHECKBOXDATA[19],
								'AUM'            => $EXPCHECKBOXDATA[18],
								'RATE'           => $EXPCHECKBOXDATA[12],
								'BASICAMT'       => $EXPCHECKBOXDATA[13],
								'TAX_CODE'       => $TAXCODE,
								'INVC_NO'        => $EXPCHECKBOXDATA[22],
								'EWAY_BILLNO'    => $EXPCHECKBOXDATA[24],
								'EWAY_BILLDT'    => $EXPCHECKBOXDATA[25],
								'ITEM_SLNO'      => $EXPCHECKBOXDATA[26],
								'TRANSACTION_NO' => $EXPCHECKBOXDATA[27],
								'ACK_QTY'        => $EXPCHECKBOXDATA[10],
								'DELIVERY_NO'    => $EXPCHECKBOXDATA[3],
								'BILL_TYPE'      => 'SBFT',
								'DRAMT'          => $GRANDTOTAL,
								'FLAG'           => $MFLAG,
								'CREATED_BY'     => $userId

							);



							DB::table('SBILL_BODY')->insert($MBODYDATA);

							$SBBID = DB::getPdo()->lastInsertId();

							$MBASICAMT[] = $EXPCHECKBOXDATA[13];

						
					}else{


						$GETMAXIDBD     = DB::select("SELECT MAX(SBILLBID) AS SBBID FROM SBILL_BODY");
						
						$DATAGETMAXIDBD = json_decode(json_encode($GETMAXIDBD),true);
						
						$GETBDID        = $DATAGETMAXIDBD[0]['SBBID'] + 1;
						
						$LASTID         = $GETBDID;
						
						$ARRSBILLBID[]  = $GETHEDID;
						
						$BODYIDGET[]    = $GETBDID;

						$MBODYDATA1 = array(

							'SBILLHID'       => $GETHEDID,
							'SBILLBID'       => $GETBDID,
							'COMP_CODE'      => $compCode,
							'FY_CODE'        => $fyCode,
							'PFCT_CODE'      => $EXPCHECKBOXDATA[14],
							'TRAN_CODE'      => $TCODE,
							'SERIES_CODE'    => $SERCODE,
							'VRNO'           => $MVRNO,
							'SLNO'           => $HSRNO,
							'VRDATE'         => $NEWVRDT,
							'PLANT_CODE'     => $PLTCODE,
							'ITEM_CODE'      => $EXPCHECKBOXDATA[20],
							'ITEM_NAME'      => $EXPCHECKBOXDATA[21],
							'HSN_CODE'       => $MITEMHSN[0]['HSN_CODE'],
							'QTYISSUED'      => $EXPCHECKBOXDATA[9],
							'UM'             => $EXPCHECKBOXDATA[17],
							'AQTYISSUED'     => $EXPCHECKBOXDATA[19],
							'AUM'            => $EXPCHECKBOXDATA[18],
							'RATE'           => $EXPCHECKBOXDATA[12],
							'BASICAMT'       => $EXPCHECKBOXDATA[13],
							'TAX_CODE'       => $TAXCODE,
							'INVC_NO'        => $EXPCHECKBOXDATA[22],
							'EWAY_BILLNO'    => $EXPCHECKBOXDATA[24],
							'EWAY_BILLDT'    => $EXPCHECKBOXDATA[25],
							'ITEM_SLNO'      => $EXPCHECKBOXDATA[26],
							'TRANSACTION_NO' => $EXPCHECKBOXDATA[27],
							'ACK_QTY'        => $EXPCHECKBOXDATA[10],
							'DELIVERY_NO'    => $EXPCHECKBOXDATA[3],
							'BILL_TYPE'      => 'SBFT',
							'DRAMT'          => $GRANDTOTAL,
							'FLAG'           => $MFLAG,
							'CREATED_BY'     => $userId

						);

						DB::table('SBILL_BODY')->insert($MBODYDATA1);

						$SBBID = DB::getPdo()->lastInsertId();


						$MBASICAMT[] = $EXPCHECKBOXDATA[13];

					} 

				/* ~~~~~ HEAD AND BODY DATA SAVE IF CLOSE ~~~~~~ */


					
				/* ~~~~~ TAX DATA SAVE ~~~~~~ */


					$TAXRATEDATA = DB::select("SELECT * FROM `MASTER_TAXRATE` WHERE TAX_CODE = '$TAXCODE'");

					$MTAXRATE = json_decode(json_encode($TAXRATEDATA),true);

					
					$MTAXRATECOUNT = count($MTAXRATE);

					$srNo = 1;
					for ($j = 0; $j < $MTAXRATECOUNT; $j++) {
						
						$FLAG = 1;

						$GETMAXIDTD = DB::select("SELECT MAX(SBILLTID) AS SBTID FROM SBILL_TAX");

		     			$DATAGETMAXIDTD = json_decode(json_encode($GETMAXIDTD),true);

		     			$MDATAGETMAXIDTD = count($DATAGETMAXIDTD);

		     			if ($MDATAGETMAXIDTD > 0) {
		     				
		     				$GETTID = $DATAGETMAXIDTD[0]['SBTID'] + 1;

		     			}else{

		     				$GETTID = 1;

		     			}

						$MDATA = array(

							'SBILLHID'   	=> $GETID,
							'SBILLBID'   	=> $LASTID,
							'SBILLTID'   	=> $GETTID,
							'TAXIND_CODE'   => $MTAXRATE[$j]['TAXIND_CODE'],
							'TAXIND_NAME'   => $MTAXRATE[$j]['TAXIND_NAME'],
							'RATE_INDEX'   	=> $MTAXRATE[$j]['RATE_INDEX'],
							'TAX_RATE'    	=> $MTAXRATE[$j]['TAX_RATE'],
							'TAX_AMT'    	=> $TAXAMTDT[$j],
							'TAX_LOGIC'    	=> $MTAXRATE[$j]['TAX_LOGIC'],
							'TAXGL_CODE'    => $MTAXRATE[$j]['TAX_GL_CODE'],
							'TAXGL_NAME'    => $MTAXRATE[$j]['TAX_GL_NAME'],
							'STATIC_IND'    => $MTAXRATE[$j]['STATIC_IND'],
							'FLAG'    		=> $FLAG,
							'CREATED_BY' 	=> $userId

						);


						DB::table('SBILL_TAX')->insert($MDATA);


						$srNo++;
						
					} /* ./ $j for loop close */


				/* ~~~~~ ./ TAX DATA SAVE CLOSE ~~~~~~ */

				$HSRNO++;

				} /* ./ FOR-LOOP CHECK-BOX CHECKED COUNT FIRST (TOP) CLOSE ~~~~~~~*/

				

				/* _________ START : GET DATA FROM SALE BILL TAX _____________ */

					$GETTAXDATA = DB::select("SELECT * FROM `SBILL_TAX` WHERE SBILLHID = '$GETID'");

					$taxAmtTot = 0;
					foreach($GETTAXDATA as $rowT){

						if($rowT->TAXIND_CODE == 'GT01'){
							$taxAmtTot += $rowT->TAX_AMT;
						}

						if($rowT->TAX_AMT != '' && $rowT->TAX_AMT !=0.00){

							if($rowT->RATE_INDEX != 'Z'){
							
								$CHKFIRSTDATAEXIST = DB::table('INDICATOR_TEMP')->where('TCFLAG','SBFT')->where('CREATED_BY',$userId)->get()->toArray();

								$existGlData = DB::table('INDICATOR_TEMP')->where('IND_GL_CODE',$rowT->TAXGL_CODE)->where('CREATED_BY',$userId)->where('TCFLAG','SBFT')->get()->toArray();

								if(empty($CHKFIRSTDATAEXIST)){

									$idary = array(
										'IND_CODE'    => $rowT->TAXIND_CODE,
										'CR_AMT'      => $rowT->TAX_AMT,
										'DR_AMT'      => 0.00,
										'IND_GL_CODE' => $SERIESGLCD,
										'IND_GL_NAME' => $SERIESGLNM,
										'TCFLAG'      => 'SBFT',
										'CREATED_BY'  => $userId,
									
									);
									DB::table('INDICATOR_TEMP')->insert($idary);

								}else if(($rowT->TAXGL_CODE == '') || ($rowT->TAXGL_CODE == NULL)){

		                            $bscVal = DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$userId)->where('TCFLAG','SBFT')->get()->toArray();

		                            $updateId = $bscVal[0]->CREATED_BY;
		                            $basicAmt = $bscVal[0]->CR_AMT + $rowT->TAX_AMT;
		                        
		                            $idary_bsic = array(
		                                'CR_AMT'      =>$basicAmt,
		                                'DR_AMT'      =>0.00,
		                            );

		                            DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('TCFLAG','SBFT')->where('CREATED_BY',$updateId)->update($idary_bsic);

		                        }else if(empty($existGlData)){

		                            $idary   = array(
		                                'IND_CODE'    => $rowT->TAXIND_CODE,
		                                'DR_AMT'      => 0.00,
		                                'CR_AMT'      => $rowT->TAX_AMT,
		                                'IND_GL_CODE' => $rowT->TAXGL_CODE,
		                                'IND_GL_NAME' => $rowT->TAXGL_NAME,
		                                'TCFLAG'      => 'SBFT',
		                                'CREATED_BY'  => $userId,
		                                
		                            );

		                            DB::table('INDICATOR_TEMP')->insert($idary);

		                        }else{

		                            $indData1 = DB::table('INDICATOR_TEMP')->where('IND_GL_CODE',$rowT->TAXGL_CODE)->where('TCFLAG','SBFT')->where('CREATED_BY',$userId)->get()->first();

		                            $newTaxAmt = $indData1->CR_AMT + $rowT->TAX_AMT;

		                            $idary1 = array(
		                                'CR_AMT' =>$newTaxAmt,
		                                'DR_AMT' => '0.00',
		                            );

		                            DB::table('INDICATOR_TEMP')->where('IND_GL_CODE',$rowT->TAXGL_CODE)->where('TCFLAG','SBFT')->where('CREATED_BY',$userId)->update($idary1);
		                        }

							}/* /. CHECK TAX IND IS Z*/
						} /* /.CHECK TAX AMOUNT IS ZERO OR BLANK*/

					} /* /.FOREACH LOOP*/


				/* START : TEMP-ACC ENTRY */

					$idary   = array(
                        'GLACC_Chk'   => 'ACC',
                        'DR_AMT'      => $taxAmtTot,
                        'CR_AMT'      => 0.00,
                        'IND_GL_CODE' => $ACCGLCD,
                        'IND_GL_NAME' => $ACCGLNM,
                        'TCFLAG'      => 'SBFT',
                        'CREATED_BY'  => $userId,
                        
                    );

                    DB::table('INDICATOR_TEMP')->insert($idary);

                /* END : TEMP-ACC ENTRY */

				/* _________ END : GET DATA FROM SALE BILL TAX _____________ */


		/* ~~~~~~~~~~~~~~ START : LEDGER ENTRY EFFECT ~~~~~~~~~~~~~~~~~~~~~ */


				$GETTEMPDATA = DB::table('INDICATOR_TEMP')->where('TCFLAG','SBFT')->where('CREATED_BY',$userId)->get()->toArray();

                $SRNO = 1;

                foreach ($GETTEMPDATA as $ROW) {     

					$pfctcode       = '';
					$transport_code = '';
					$transport_name = '';
					$blankVal       = '';
					$GLCODE         = $ROW->IND_GL_CODE;
					$GLNAME         = $ROW->IND_GL_NAME;
					$DRAMT          = $ROW->DR_AMT;
					$CRAMT          = $ROW->CR_AMT;
					$slno           = $SRNO;
					$EXP            = explode('[',$SERIESCODE);
					$NEWSERICECD    = $EXP[0];
					$FYCD 			=  $mfiscalYear;

					$FINALBILLNO 	= $FYCD.'/'.$NEWSERICECD.'/'.$newVr;

					$perticulerText = 'Final Sale Bill - Bill No - '.$FINALBILLNO.', Bill Date - '.$NEWVRDT.',  Transaction - '.$TCODE.', Screies - '.$NEWSERICECD.',  Plant - '.$PLANTCODE.',  Plant Category - '.$PLANTCAT.', Transaction Type - '.$TRANTYPE.'.';

            	  	$resultgl = (new AccountingController)->GlTEntry($compCode,$fyCode,$TCODE,$NEWSERICECD,$newVr,$slno,$NEWVRDT,$pfctcode,$GLCODE,$GLNAME,$ACCCODE,$ACCNAME,$blankVal,$blankVal,$blankVal,$blankVal,$DRAMT,$CRAMT,$perticulerText,$userId);


           	 		if($ROW->GLACC_Chk == 'ACC'){

           	 			$result = (new AccountingController)->AccountTEntry($compCode,$fyCode,$TCODE,$NEWSERICECD,$newVr,$slno,$NEWVRDT,$pfctcode,$ACCCODE,$ACCNAME,$GLCODE,$GLNAME,$blankVal,$blankVal,$blankVal,$blankVal,$DRAMT,$CRAMT,$perticulerText,$userId);
           	 		}


	           	 $SRNO++;
                	
                }


		/* ~~~~~~~~~~~~~~ END : LEDGER ENTRY EFFECT ~~~~~~~~~~~~~~~~~~~~~ */




		/* ~~~~~~ START : DOWNLOAD TEXT FILE ~~~~~~~ */

		

	/* ~~~~~~~ NOTE : PLEASE CHECK FIRST SBILL_TAX_VIEW TABLE VIEW IS CREATED OR NOT ~~~~~~~~~~~ */

				$GETSBILLBODY  = DB::select("SELECT t1.ACC_CODE,t1.ACC_NAME,t1.ACC_CODE,t1.FY_CODE,t1.SERIES_CODE,t1.VRNO,t1.VRDATE,t2.DELIVERY_NO,t2.DELIVERY_DATE,t2.INVC_NO,t2.ITEM_SLNO,t2.TRANSACTION_NO,SUM(t2.QTYISSUED) AS QTYISSUED,SUM(t2.BASICAMT) AS BASICAMT,SUM(t3.CGST) AS CGST,SUM(t3.SGST) AS SGST,SUM(t3.IGST) AS IGST FROM SBILL_HEAD t1 INNER JOIN SBILL_BODY t2 on t1.SBILLHID=t2.SBILLHID INNER JOIN SBILL_TAX_VIEW t3 ON t3.SBILLBID=t2.SBILLBID WHERE t2.SBILLHID='$GETID' GROUP BY t2.INVC_NO,t2.ITEM_SLNO");

				$MGETSBILLBODY = json_decode(json_encode($GETSBILLBODY),true);

				$MBODYCOUNT    = count($MGETSBILLBODY);

				$ADDCONTENTINTEXT = array();

				foreach ($MGETSBILLBODY as $ROW) {

					$PANELTY  = 0.00;
					$ACCCD    = $ROW['ACC_CODE'];
					$FYCD     = $ROW['FY_CODE'];
					$EXP 	  = explode('-',$FYCD);
					$FIRSTYR  = $EXP[0];
					$SERIESCD = trim($ROW['SERIES_CODE']);
					$VRNO     = $ROW['VRNO'];
					$VRDTATE  = $ROW['VRDATE'];

					$MVRNO    = $FIRSTYR.'/'.$SERIESCD.'/'.$VRNO;

					$ACCCDDATA  = DB::select("SELECT * FROM MASTER_ACC A WHERE A.ACC_CODE='$ACCCD'");

					$MGETACCCDDATA = json_decode(json_encode($ACCCDDATA),true);

					$SAPCODE = $MGETACCCDDATA[0]['SAP_CODE'];

					$MVRDTATE    = date("d.m.Y", strtotime($VRDTATE));

					$ADDCONTENTINTEXT1 = '00000'.$SAPCODE.'	'.$ROW['DELIVERY_NO'].'	'.$ROW['TRANSACTION_NO'].'	'.$MVRNO.'	'.$MVRDTATE.'	'.$PANELTY.'	'.$PANELTY.'	'.$ROW['QTYISSUED'].'	'.$ROW['BASICAMT'].'	'.$ROW['CGST'].'	'.$ROW['SGST'].'	'.$ROW['IGST']."\n";

					array_push($ADDCONTENTINTEXT,$ADDCONTENTINTEXT1);
					
				}


				$EXP            = explode('[',$SERIESCODE);
			    $NEWSERICECD1   = $EXP[0];
			    $GETSBILLHEAD  = DB::select("SELECT * FROM `SBILL_HEAD` WHERE SBILLHID = '$GETID'");

				$MGETSBILLHEAD = json_decode(json_encode($GETSBILLHEAD),true);

				$MVRNO = 'final-bill-'.trim($NEWSERICECD1).'-'.$fyCode.'-'.$MGETSBILLHEAD[0]['VRNO'].'.txt';

				Storage::disk('local')->put($MVRNO, $ADDCONTENTINTEXT);

				$HIDBIDCOUNT = count($HIDBID);

				for ($p = 0; $p < $HIDBIDCOUNT;$p++) {

					$EXP = explode("~",$HIDBID[$p]);

					$SBHID = $ARRSBILLBID[$p];
					$SBBID = $BODYIDGET[$p];

				 	DB::select("UPDATE SBILL_BODY_PROV B SET B.SBILLHID = '$SBHID',B.SBILLBID='$SBBID' WHERE B.PSBILLHID  = '$EXP[0]' AND B.PSBILLBID  = '$EXP[1]'");
					
				}


				$MVRNO1 = 'file.txt';
				$path = 'storage/app/my-file'; 
				$fileName    =  $MVRNO1;
				$downloadPdf = $path.'/'.$fileName;

				$fisYear =  $request->session()->get('macc_year');


		/* ~~~~~~ END : DOWNLOAD TEXT FILE ~~~~~~~ */

				DB::commit();

				
				/* ---------- DOWNLOAD PDF ---------- */
					$filePdf = '';
					if(($PDFGENSTATUS == 1) || ($PDFGENSTATUS == 2)){
						$filePdf =  $this->GeneratePdfForFinalSaleBill($compCode,$fyCode,$SERCODE,$newVr,$TCODE,$HIDBID,$ACC_ADDRESS,$ACC_CITY,$ACC_PAN,$ACC_GSTIN,$ACCSTATE,$fisYear,$GETHEDID,$GRANDTOTWORD,$pdfBillNo,$BODYIDGET,$VRDATE,$BILLFORMAT);
					}else{

						$filePdf = '';
					}

				/* ---------- DOWNLOAD PDF ---------- */

				$path1       = public_path('dist/downloadpdf'); 
				$fileName    =  time().'_Final_sale_bill.'. 'pdf' ;
				$filePdf->save($path1 . '/' . $fileName);
				$PublicPath  = url('public/dist/downloadpdf/');  
				$downloadPdf = $PublicPath.'/'.$fileName;
				$response_array['response']       = 'success';
				$response_array['url'] = $downloadPdf;
				$response_array['bill_no'] = $pdfBillNo;
				$response_array['file_path']      = $path;
				$response_array['file_name']      = $MVRNO;

			    $data = json_encode($response_array);
			    print_r($data);

			}catch (\Exception $e) {

				DB::rollBack();
	    		throw $e;
	    		$response_array['url'] = '';
	    		$response_array['bill_no'] = '';
				$response_array['response']   = 'error';
				$response_array['file_path']  = '';
				$response_array['file_name']      = '';
				$data = json_encode($response_array);
				print_r($data);
		                
		            	
		   }


		}else{


			$response_array['response']       = 'error';
			$response_array['url'] = '';
			$response_array['file_path']      = '';
			$response_array['file_name']      = '';
		    $data = json_encode($response_array);
		    print_r($data);



		}/* ./ Second Top Check All Condition If Close  */
			

	    
	}else{


		$response_array['response']   = 'error';
		$response_array['file_path']  = '';
		$response_array['file_name']      = '';
		$data = json_encode($response_array);
		print_r($data);


	} /* ./ Ajax If Top Close */

}

	public function GeneratePdfForFinalSaleBill($compCd,$fyCd,$seriesCd,$vrNo,$tCode,$tblHeadBodyID,$add_address,$accCity,$acc_pan,$acc_gstin,$accstate,$fisYear,$sbillHid,$grandTotWords,$pdfBillNo,$bodyIdGet,$vrDate,$billFormat){
		
		$response_array = array();

		$compDetail = DB::select("SELECT * FROM MASTER_COMP WHERE COMP_CODE='$compCd'");
		
		$getAccCity = $accCity;

		$exp       = explode($getAccCity,'('); 


		$provsaleBillData = array();
		$saleBillTaxData = array();
		$MBILLDATA = array();
		$sbILL = array();
		for($q=0;$q<count($tblHeadBodyID);$q++){

			$splitData   = explode('~', $tblHeadBodyID[$q]);
			$pbillHeadID = $splitData[0];
			$billBodyId  = $splitData[1];

			$data_headB = DB::select("SELECT A.ACC_NAME,A.ITEM_CODE,A.ITEM_NAME,A.FY_CODE,A.SERIES_CODE,A.VRNO,B.* FROM SBILL_HEAD_PROV A LEFT JOIN SBILL_BODY_PROV B ON A.PSBILLHID=B.PSBILLHID WHERE B.PSBILLHID='$pbillHeadID' AND B.PSBILLBID='$billBodyId'");

			$provData = json_decode( json_encode($data_headB), true);
			$provsaleBillData[] = $provData[0];

			$dataHead = DB::select("SELECT * FROM SBILL_HEAD_PROV WHERE PSBILLHID='$pbillHeadID'");

			$headData = json_decode( json_encode($dataHead), true);

			$HEADITEMCD = $headData[0]['ITEM_CODE'];
			$HEADITEMNM = $headData[0]['ITEM_NAME'];

			$ITEMDATE = DB::select("SELECT * FROM MASTER_ITEM WHERE ITEM_CODE ='$HEADITEMCD' AND ITEM_NAME='$HEADITEMNM'");

			$ITEMHSN = json_decode( json_encode($ITEMDATE), true);

			$sbillTaxData = DB::select("SELECT * FROM SBILL_TAX_VIEW WHERE SBILLHID='$sbillHid'");

			$getSbillTaxData = json_decode( json_encode($sbillTaxData), true);

			$saleBillTaxData[] = $getSbillTaxData[0];

			$BILLDATA = DB::select("SELECT A.ACC_NAME,A.ACC_CODE,A.ITEM_CODE,A.ITEM_NAME,A.FY_CODE,A.SERIES_CODE,A.VRNO,T.SGST AS TSGST,T.CGST AS TCGST,T.IGST AS TIGST,T.SUB_TOTAL AS TSUBTOT,T.Basic AS TBASIC,T.GRAND_TOTAL AS TGRANDTOT,T.ROUND_OFF AS ROUNDOFF,B.*,H.CP_CODE, H.CP_NAME,H.SP_CODE,H.SP_NAME,H.TO_PLACE,H.FROM_PLACE,H.ACC_CODE AS ACCCD,H.LR_NO,H.LR_DATE,H.WAGON_NO FROM SBILL_HEAD_PROV A, SBILL_BODY_PROV B,SBILL_TAX_VIEW T,TRIP_BODY H WHERE A.PSBILLHID=B.PSBILLHID AND B.SBILLHID = T.SBILLHID AND B.SBILLBID = T.SBILLBID AND B.TRIPHID = H.TRIPHID AND B.PSBILLHID='$pbillHeadID' AND B.PSBILLBID='$billBodyId' GROUP BY B.PSBILLBID");

			$MBILLDATA1 = json_decode( json_encode($BILLDATA), true);

			$MBILLDATA[] = $MBILLDATA1[0];

			$sbillTax = DB::select("SELECT * FROM SBILL_TAX_VIEW WHERE SBILLHID='$sbillHid' AND SBILLBID='$bodyIdGet[$q]'");

			$getSbillTax = json_decode( json_encode($sbillTax), true);

			$sbILL[] = $getSbillTax[0];
		

		}

		$SGSTGET = 0;
		$CGSTGET = 0;
		$IGSTGET = 0;
		$SUBTOT  = 0;
		$GRANDTOT  = 0;
		$ROUNDOFF  = 0;
		foreach ($sbILL as $rows) {

			$SGSTGET += $rows['SGST'];
			$CGSTGET += $rows['CGST'];
			$IGSTGET += $rows['IGST'];
			$ROUNDOFF += $rows['ROUND_OFF'];
			$SUBTOT += $rows['SUB_TOTAL'];
			$GRANDTOT += $rows['GRAND_TOTAL'];
			
		}

		$checkNum = $this->nagitive_check($ROUNDOFF);

		if ($checkNum=='It is negative') {

			$MGETGRANDTOT = $GRANDTOT + (- $ROUNDOFF);
			
		}else{

			$MGETGRANDTOT = $GRANDTOT - ($ROUNDOFF);

		}

		$grandTotWord = (new AccountingController)->amountInWords($MGETGRANDTOT);

		$SPCODE = $MBILLDATA[0]['SP_CODE'];
		$SPNAME = $MBILLDATA[0]['SP_NAME'];
		$TOPLACE = $MBILLDATA[0]['TO_PLACE'];

		$SPDETAILS = DB::select("SELECT * FROM MASTER_ACC WHERE ACC_CODE='$SPCODE'");

		$GETSPDETAILS = json_decode( json_encode($SPDETAILS), true);

		$SPADDRDETAILS = DB::select("SELECT * FROM MASTER_ACCADD WHERE ACC_CODE='$SPCODE' AND CITY_NAME = '$TOPLACE'");

		$GETSPADDRDETAILS = json_decode( json_encode($SPADDRDETAILS), true);

		$CPCODE = $MBILLDATA[0]['CP_CODE'];
		$CPNAME = $MBILLDATA[0]['CP_NAME'];

		$CPDETAILS = DB::select("SELECT * FROM MASTER_ACC WHERE ACC_CODE='$CPCODE'");

		$GETCPDETAILS = json_decode( json_encode($CPDETAILS), true);

		$CPADDRDETAILS = DB::select("SELECT * FROM MASTER_ACCADD WHERE ACC_CODE='$CPCODE' AND CITY_NAME = '$TOPLACE'");

		$GETCPADDRDETAILS = json_decode( json_encode($CPADDRDETAILS), true);
		
	
		$title='FINAL SALE BILL REPORT';

		header('Content-Type: application/pdf');

		$pdf = PDF::loadView('admin.finance.transaction.logistic.finalSaleBillPDF',compact('provsaleBillData','title','compDetail','add_address','headData','ITEMHSN','getAccCity','acc_pan','acc_gstin','accstate','fisYear','saleBillTaxData','grandTotWord','MBILLDATA','pdfBillNo','SGSTGET','CGSTGET','IGSTGET','MGETGRANDTOT','vrDate','billFormat','GETSPDETAILS','GETCPDETAILS'),[],['format' => 'A4-L','orientation' => 'L']);

		return $pdf;

		
	}


	public function nagitive_check($value){

		if (isset($value)){
		    if (substr(strval($value), 0, 1) == "-"){
		    	return 'It is negative';
			} else {
			    return 'It is not negative';
			}
		}
	}

    public function FinalSaleBillLogisticsSaveMsgTemp(Request $request,$saveData){
	 
		if ($saveData == 'false') {
			$request->session()->flash('alert-error', 'Data Can Not Added...!');
			return redirect('/logistic/sale-bill-final');

		} else {
			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/logistic/sale-bill-final');
		}

   	}

/* ------- END : Logistics Sale Bill Posting ----------  */

/* ------- START : SIMULATION FOR SALE BILL FINAL ------------ */

	public function SimulationForFinalSaleBill(Request $request){

		if ($request->ajax()) {

			$allTaxRwCnt      = $request->allTaxRwCnt;
			$accGlCd          = $request->accGlCd;
			$seriesGlCd       = $request->seriesGlCd;
			$tax_indictorCode = $request->tax_indictorCode;
			$tax_rate_ind     = $request->tax_rate_ind;
			$tax_GlCode       = $request->tax_GlCode;
			$tax_amount       = $request->tax_amount;
			$grandTotalAmt    = $request->grandTotalAmt;
			$loginUser        = $request->session()->get('userid');

			

			DB::table('SIMULATION_TEMP')->where('CREATED_BY',$loginUser)->where('TCFLAG','SBFL')->delete();

			for($i=0;$i<$allTaxRwCnt;$i++){

				$chkFirstDataExist = DB::table('SIMULATION_TEMP')->where('TCFLAG','SBFL')->where('CREATED_BY',$loginUser)->get()->toArray();

				$existGlData = DB::table('SIMULATION_TEMP')->where('IND_GL_CODE',$tax_GlCode[$i])->where('CREATED_BY',$loginUser)->where('TCFLAG','SBFL')->get()->toArray();

				if($tax_amount[$i] != '' && $tax_amount[$i] !=0.00){
					
					if($tax_rate_ind[$i] != 'Z'){

						if(empty($chkFirstDataExist)){
							
							$idary = array(
								'IND_CODE'    => $tax_indictorCode[$i],
								'DR_AMT'      => '',
								'CR_AMT'      => $tax_amount[$i],
								'IND_GL_CODE' => $seriesGlCd,
								'TCFLAG'      => 'SBFL',
								'CODE_NAME'   => 'Series Gl',
								'CREATED_BY'  => $loginUser,
							
							);
							DB::table('SIMULATION_TEMP')->insert($idary);

						}else if(($tax_GlCode[$i] == '') || ($tax_GlCode[$i] == NULL)){

							$bscVal = DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$loginUser)->where('TCFLAG','SBFL')->get()->toArray();
							$updateId = $bscVal[0]->CREATED_BY;
							$basicAmt = $bscVal[0]->CR_AMT + $tax_amount[$i];
						
							$idary_bsic = array(
								'DR_AMT' 	  =>'',
								'CR_AMT'	  =>$basicAmt,
							);

							 DB::table('SIMULATION_TEMP')->where('IND_CODE','B01')->where('TCFLAG','SBFL')->where('CREATED_BY',$updateId)->update($idary_bsic);

						}else if(empty($existGlData)){

	                        $idary   = array(
	                            'IND_CODE'    => $tax_indictorCode[$i],
	                            'DR_AMT'      => 0.00,
	                            'CR_AMT'      => $tax_amount[$i],
	                            'IND_GL_CODE' => $tax_GlCode[$i],
	                            'TCFLAG'      => 'SBFL',
	                            'CREATED_BY'  => $loginUser,
	                            
	                        );

	                        DB::table('SIMULATION_TEMP')->insert($idary);

	                    }else{

	                        $indData1 = DB::table('SIMULATION_TEMP')->where('IND_GL_CODE',$tax_GlCode[$i])->where('TCFLAG','SBFL')->where('CREATED_BY',$loginUser)->get()->first();

	                        $newTaxAmt = $indData1->CR_AMT + $tax_amount[$i];

	                        $idary1 = array(
	                            'CR_AMT' =>$newTaxAmt,
	                            'DR_AMT' => '0.00',
	                        );

	                        DB::table('SIMULATION_TEMP')->where('IND_GL_CODE',$tax_GlCode[$i])->where('TCFLAG','SBFL')->where('CREATED_BY',$loginUser)->update($idary1);
	                    }

					}/* /. CHECK RATE IND IS Z*/

				}/* /. TAX AMOUNT IS BLANK CHECK*/

			}/* /. FOR LOOP*/

			$accData = array(

				'IND_CODE'     =>'',
				'DR_AMT'       =>$grandTotalAmt,
				'CR_AMT'       =>'',
				'IND_GL_CODE'  =>$accGlCd,
				'TCFLAG'       =>'SBFL',
				'CREATED_BY'   =>$loginUser,
			);

			DB::table('SIMULATION_TEMP')->insert($accData);

			$response_array = array();
			//$taxData = DB::table('simulatn_temp')->where('created_by', $userId)->get();
			$taxData = DB::select("SELECT t1.*,t2.GL_NAME as glName,t3.ACC_NAME AS accName FROM SIMULATION_TEMP t1 LEFT JOIN MASTER_GL t2 ON t2.GL_CODE = t1.IND_GL_CODE LEFT JOIN MASTER_ACC t3 ON t3.ACC_CODE =t1.IND_ACC_CODE WHERE t1.CREATED_BY='$loginUser' AND t1.TCFLAG='SBFL'");

    		if ($taxData) {

    			$response_array['response'] = 'success';
	            $response_array['data_sim'] = $taxData;
	            echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
                $response_array['data_sim'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
				
			}

		} /* /. ajax*/

	}

/* ------- END : SIMULATION FOR SALE BILL FINAL ------------ */


	public function ProvisionalSaleBillView(Request $request){

		$compName = $request->session()->get('company_name');

		    if($request->ajax()) {

				$title        = 'View Provisional Bill';
				
				$userid       = $request->session()->get('userid');
				
				$userType     = $request->session()->get('usertype');
				
				$comp_nameval = $request->session()->get('company_name');
				$explode      = explode('-', $comp_nameval);
				$getcom_code  = $explode[0];
				
				$fisYear      =  $request->session()->get('macc_year');


		        $data =DB::select("SELECT SBILL_HEAD_PROV.*,SBILL_BODY_PROV.* FROM SBILL_HEAD_PROV LEFT JOIN SBILL_BODY_PROV ON SBILL_BODY_PROV.PSBILLHID = SBILL_HEAD_PROV.PSBILLHID WHERE SBILL_HEAD_PROV.COMP_CODE='$getcom_code' AND SBILL_HEAD_PROV.FY_CODE='$fisYear' GROUP BY SBILL_HEAD_PROV.PSBILLHID ORDER BY SBILL_HEAD_PROV.VRNO DESC, SBILL_HEAD_PROV.VRDATE DESC");

		       

		    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
	                
	            })->toJson();

		    }

		    if(isset($compName)){

		       return view('admin.finance.transaction.logistic.view_provisional_bill');

		    }else{

				return redirect('/useractivity');

			}
		        
	}

	public function ProvisionalSaleBillViewChildRow(Request $request){

		$response_array = array();

			$vrno    = $request->input('vrno');
			$headid  =  $request->input('tblid');

		if ($request->ajax()) {

	    
	    	 $ptdata = DB::table('SBILL_BODY_PROV')->where('PSBILLHID',$headid)->get()->toArray();

	  		//print_r($ptdata);exit;

    		if($ptdata){

    			$response_array['response'] = 'success';
	            $response_array['data'] = $ptdata;

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


    public function AddBillingSchedule(Request $request){

    	$title       = 'Add Billing Schedule';
		
		$CompanyCode = $request->session()->get('company_name');
		$compcode    = explode('-', $CompanyCode);
		$getcompcode =	$compcode[0];
		$macc_year   = $request->session()->get('macc_year');

		$userdata['series_list'] = DB::table('MASTER_CONFIG')->where(['TRAN_CODE'=>'P0'])->get();

		
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

		$userdata['Order_list'] = DB::table('SORDER_HEAD')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->get();

		$userdata['Order_Acc_list'] = DB::table('SORDER_HEAD')->where(['COMP_CODE'=>$getcompcode,'FY_CODE'=>$macc_year])->groupBy('ACC_CODE')->get();

		if(isset($CompanyCode)){

	    	return view('admin.finance.transaction.property_rental_utility.add_billing_schedule',$userdata+compact('title'));

	    }else{

			return redirect('/useractivity');
		}

    }


    public function getSaleOrderforRent(Request $request){


    	$response_array = array();

    	if ($request->ajax()) {

    		/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

				$BASE_URL    = $request->session()->get('base_url');
				$COMPCODE    = $request->session()->get('company_name');
				$FIRSTFYCODE = $request->session()->get('fiscal_year');
				$COMPCD      = explode('-', $COMPCODE);
				$MCOMPCODE   = $COMPCD[0];
				$FYCODE      = $request->session()->get('macc_year');
				$USERID      = $request->session()->get('userid');

			/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */

    		if (!empty($request->account_code)) {

    			$ACC_CODE = $request->account_code;
			
	            $ACCCODEDATA = DB::SELECT("SELECT * FROM `SORDER_HEAD` WHERE ACC_CODE='$ACC_CODE' AND COMP_CODE='$MCOMPCODE' AND BILL_SCH_STATUS='0'");

	            $MACCCODEDATA = json_decode(json_encode($ACCCODEDATA),true);

	            $MASTERACCADD = DB::SELECT("SELECT * FROM `MASTER_ACCADD` WHERE ACC_CODE='$ACC_CODE'");

	            $MMASTERACCADD = json_decode(json_encode($MASTERACCADD),true);

	            $SALEORDERDATA = DB::SELECT("SELECT t1.*,t2.* FROM `SORDER_HEAD` t1 INNER JOIN `SORDER_BODY` t2 ON t1.SORDERHID=t2.SORDERHID WHERE t1.ACC_CODE='$ACC_CODE' AND t1.COMP_CODE='$MCOMPCODE'");

	            $MSALEORDERDATA = json_decode(json_encode($SALEORDERDATA),true);

	            if ($MACCCODEDATA && $MMASTERACCADD && $MSALEORDERDATA) {

					$response_array['response']  = 'success';
					$response_array['data']      = $MACCCODEDATA;
					$response_array['acc_addr_data']  = $MMASTERACCADD;
					$response_array['sale_order_data']  = $MSALEORDERDATA;
				
	                $data = json_encode($response_array);
	                print_r($data);

	            }else{

					$response_array['response'] = 'error';
					$response_array['data']     = '';
					$response_array['acc_addr_data'] = '';
					$response_array['sale_order_data']  = '';
	                $data = json_encode($response_array);
	                print_r($data);
	                
	            }

	        }else{


	        	$response_array['response'] = 'error';
				$response_array['data']     = '';
				$response_array['acc_addr_data'] = '';
				$response_array['sale_order_data']  = '';
                $data = json_encode($response_array);
                print_r($data);


	        }

        }else{

                $response_array['response'] = 'error';
                $response_array['data'] = '';
                $response_array['acc_addr_data'] = '';
                $response_array['sale_order_data']  = '';
                $data = json_encode($response_array);
                print_r($data);
        }

    }


    public function getSaleOrderDataForBillingSchedule(Request $request){


    	$response_array = array();

    	if ($request->ajax()) {

    		if (!empty($request->accountCode || $request->orderNo || $request->beginningDate || $request->tenuarInMh)) {

    		$CompanyCode = $request->session()->get('company_name');
			$compcode    = explode('-', $CompanyCode);
			$getcompcode =	$compcode[0];
			$macc_year   = $request->session()->get('macc_year');

			$ACC_CODE   = $request->accountCode;
			$ORDERNO    = $request->orderNo;

			$BEGDATE    = $request->beginningDate;
			$TENUARMH   = $request->tenureInMh;

			$MORDERNO   = explode(" ",$ORDERNO);

			$SERIESCODE = $MORDERNO[1];
			$VRNO       = $MORDERNO[2];
			
			$dt    = new DateTime($BEGDATE);

			$cheDt = new DateTime($BEGDATE);

			$cheDt->modify('last day of this month');

			$MONTHENDDATE = 0;
			
			if ($dt == $cheDt) {
				
				$MONTHENDDATE = 1;
			}

			$ALLMONTHARR = array();

			for ($i = 0; $i < $TENUARMH;$i++) {

				if($i == 0){

					if ($MONTHENDDATE == 1) {
						
						$day = $dt->format('j');
						$dt->modify('first day of this month');
						$dt->modify('last day of this month');
					
					}else{

						$day = $dt->format('j');
						$dt->modify('first day of this month');
						$dt->modify('+' . (min($day, $dt->format('t')) - 1) . ' days');

					}

				}else{

					if ($MONTHENDDATE == 1) {

						$day = $dt->format('j');
						$dt->modify('first day of +1 month');
						$dt->modify('last day of this month');
						
					}else{

						$day = $dt->format('j');
						$dt->modify('first day of +1 month');
						$dt->modify('+' . (min($day, $dt->format('t')) - 1) . ' days');

					}

				}
				

				$NEWDATE = $dt->format('Y-m-d');
				$ALLMONTHARR[] = $NEWDATE;
				$dt = new DateTime($NEWDATE);
			}

            $SALEORDERDATA =DB::select("SELECT t1.*,t2.* FROM SORDER_HEAD t1 LEFT JOIN SORDER_BODY t2 ON t1.SORDERHID = t2.SORDERHID WHERE t1.ACC_CODE='$ACC_CODE' AND t1.VRNO='$VRNO' AND t1.SERIES_CODE='$SERIESCODE' AND t1.COMP_CODE='$getcompcode'");

            $MSALEORDERDATA = json_decode(json_encode($SALEORDERDATA),true);

            if ($MSALEORDERDATA) {

				$response_array['response']  		= 'success';
				$response_array['sale_order_list']  = $MSALEORDERDATA;
				$response_array['next_date_list']   = $ALLMONTHARR;
			
                $data = json_encode($response_array);
                print_r($data);

            }else{

				$response_array['response']        = 'error';
				$response_array['sale_order_list'] = '';
				$response_array['next_date_list']  = '';
                $data = json_encode($response_array);
                print_r($data);
                
            }

        }else{


			$response_array['response']        = 'error';
			$response_array['sale_order_list'] = '';
			$response_array['next_date_list']  = '';
            $data = json_encode($response_array);
            print_r($data);


        }

    }else{

			$response_array['response']        = 'error';
			$response_array['sale_order_list'] = '';
			$response_array['next_date_list']  = '';
            $data = json_encode($response_array);
            print_r($data);
    }



  }


  public function SaveBillingSchedule(Request $request){

  	if ($request->ajax()) {

		if (!empty($request->hidAccCode || $request->hidAccNm || $request->hidSaleOrdNo || $request->hidBegDt || $request->hidTenure || $request->hidIncInd || $request->hidIncRate)) {

			/* --- START : GET HEAD DATA --- */

				$ACCCODE      = $request->hidAccCode;
				$ACCNAME      = $request->hidAccNm;
				$SALEORDNO    = $request->hidSaleOrdNo;
				$BEGINNINGDT  = $request->hidBegDt;
				$TENUREINMT   = $request->hidTenure;
				$INCINDICATOR = $request->hidIncInd;
				$INCRATE      = $request->hidIncRate;

				$SCHDATE      = $request->scheduleDt;
				$SCHAMT       = $request->scheduleAmt;
				$PARTICULAR   = $request->particular;
				$SORDERHID   = $request->orderhid;
				
				$MBEGINNINGDT = date("Y-m-d", strtotime($BEGINNINGDT));

			/* --- END : GET HEAD DATA --- */


			/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

				$BASE_URL    = $request->session()->get('base_url');
				$COMPCODE    = $request->session()->get('company_name');
				$FIRSTFYCODE = $request->session()->get('fiscal_year');
				$COMPCD      = explode('-', $COMPCODE);
				$MCOMPCODE   = $COMPCD[0];
				$FYCODE      = $request->session()->get('macc_year');
				$USERID      = $request->session()->get('userid');

			/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */

			

			DB::beginTransaction();

			try {


				for ($i = 0; $i < $TENUREINMT;$i++) {

					$FLAG = 1;

					$data = array(
						'COMP_CODE'      => $MCOMPCODE,
						'FY_CODE'        => $FYCODE,
						'ACC_CODE'       => $ACCCODE,
						'ACC_NAME'       => $ACCNAME,
						'SALE_ORDNO'     => $SALEORDNO,
						'BEGINNING_DATE' => $MBEGINNINGDT,
						'TENURE_INMONTH' => $TENUREINMT,
						'INC_INDICATOR'  => $INCINDICATOR,
						'INC_RATE'       => $INCRATE,
						'SCHEDULE_DATE'  => $SCHDATE[$i],
						'SCHEDULE_AMT'   => $SCHAMT[$i],
						'PARTICULAR'     => $PARTICULAR[$i],
						'SORDERHID'      => $SORDERHID,
						'FLAG'           => $FLAG,
						'CREATED_BY'     => $USERID
					);

					DB::table('RPBILLING_SCHEDULE')->insert($data);
					
				} /* for loop close */

					
					$data1 = array(

						'BILL_SCH_STATUS' => '1',

					);

					$updateData = DB::table('SORDER_HEAD')->where('SORDERHID',$SORDERHID)->update($data1);

				DB::commit();
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


		}else{

			$response_array['response']        = 'error';
            $data = json_encode($response_array);
            print_r($data);

		} /* ./ Condition Check Second Top If Close */


	}else{

		$response_array['response']        = 'error';
        $data = json_encode($response_array);
        print_r($data);

	} /* ./ Ajax Condition Check Top If Close */


  }

  

  public function MsgBillingSchedule(Request $request,$saveData){

  	if ($saveData == 'false') {
		$request->session()->flash('alert-error', 'Data Can Not Added...!');
		return redirect('/transaction/property-rental-utility/add-billing-schedule');

	} else {
		$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
		return redirect('/transaction/property-rental-utility/add-billing-schedule');
	}

  }


  public function ViewBillingSchedule(Request $request){

  		$compName = $request->session()->get('company_name');

	    if($request->ajax()) {

	        $title = 'View Rental Billing Schedule';

	       /* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

				$BASE_URL    = $request->session()->get('base_url');
				$COMPCODE    = $request->session()->get('company_name');
				$FIRSTFYCODE = $request->session()->get('fiscal_year');
				$COMPCD      = explode('-', $COMPCODE);
				$MCOMPCODE   = $COMPCD[0];
				$FYCODE      = $request->session()->get('macc_year');
				$USERID      = $request->session()->get('userid');

			/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */


	        $data =DB::select("SELECT * FROM RPBILLING_SCHEDULE  WHERE COMP_CODE='$MCOMPCODE' AND FY_CODE='$FYCODE' GROUP BY ACC_CODE");

	       

	    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
                
            })->toJson();

	    }

	    if(isset($compName)){

	       return view('admin.finance.transaction.property_rental_utility.view_billing_schedule');

	    }else{

			return redirect('/useractivity');

		}

  }


  public function ViewBillingScheduleBody(Request $request){

		if ($request->ajax()) {

			$pageIndentity  = $request->pageIndentity;
			$fieldName 		= $request->fieldName;

			/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

				$BASE_URL    = $request->session()->get('base_url');
				$COMPCODE    = $request->session()->get('company_name');
				$FIRSTFYCODE = $request->session()->get('fiscal_year');
				$COMPCD      = explode('-', $COMPCODE);
				$MCOMPCODE   = $COMPCD[0];
				$FYCODE      = $request->session()->get('macc_year');
				$USERID      = $request->session()->get('userid');

			/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */

			if($pageIndentity == 'BILLING-SCHEDULE' && $fieldName){

				$splitData = explode('~', $fieldName);
				$HID       = $splitData[0];
				$ACCCODE   = $splitData[1];
				$SALEORDNO = $splitData[2];
				

				$getbodyDetails = DB::select("SELECT * FROM RPBILLING_SCHEDULE WHERE COMP_CODE='$MCOMPCODE' AND FY_CODE='$FYCODE' AND ACC_CODE='$ACCCODE' AND SALE_ORDNO='$SALEORDNO'");

			}else{

				$getbodyDetails = array();
				
			}

			if($getbodyDetails){

				$response_array['response']     = 'success';
				$response_array['dataDetails']  = $getbodyDetails;
	            $data = json_encode($response_array);
	            print_r($data);

			}else{

				$response_array['response']     = 'error';
				$response_array['dataDetails']  = '';
				$data = json_encode($response_array);
	             print_r($data);
			}

		}else{
			$response_array['response']     = 'error';
			$response_array['dataDetails']  = '';
			$data = json_encode($response_array);
            print_r($data);
		}

	}

	

	public function RentBillPosting(Request $request){

		$title       =	'Rent Bill Posting';
		
		/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

			$BASE_URL    = $request->session()->get('base_url');
			$COMPCODE    = $request->session()->get('company_name');
			$FIRSTFYCODE = $request->session()->get('fiscal_year');
			$COMPCD      = explode('-', $COMPCODE);
			$MCOMPCODE   = $COMPCD[0];
			$FYCODE      = $request->session()->get('macc_year');
			$USERID      = $request->session()->get('userid');

		/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */

		$transCodes   = 'S5';

		$tableData = MyConstruct();

		$userdata['acc_list']     = $tableData['master_party'];

		$rate_list   = $this->master_rateValue;

		$getCommonData = MyCommonFun($transCodes,$MCOMPCODE,$FYCODE);

		$userdata['series_list'] = $getCommonData['getseries'];

		$transCode = DB::table('MASTER_TRANSACTION')->WHERE('TRAN_CODE',$transCodes)->get();

		$userdata['trans_head'] =$transCode[0]->TRAN_CODE;

		$accCatglist  = DB::table('MASTER_ACATG')->get();

		$tripBodylist  = DB::table('TRIP_BODY')->get()->toArray();
		
		$pfctlist  = DB::table('MASTER_PFCT')->where('COMP_CODE',$MCOMPCODE)->get()->toArray();

		$functionData = $this->CommonFunction($FYCODE,$MCOMPCODE,$transCodes);

		foreach ($functionData['fy_list'] as $key) {
			$userdata['fromDate'] =  $key->FY_FROM_DATE;
			$userdata['toDate']   =  $key->FY_TO_DATE;
		}

		$userdata['schbill_acc_list'] = DB::select("SELECT * FROM RPBILLING_SCHEDULE  WHERE COMP_CODE='$MCOMPCODE' AND FY_CODE='$FYCODE' GROUP BY ACC_CODE");

		if(isset($COMPCODE)){
		
		    return view('admin.finance.transaction.property_rental_utility.rent_bill_posting',$userdata+compact('title','pfctlist','accCatglist','rate_list'));

		}else{
			return redirect('/useractivity');
		}


	}


	public function getPfctState(Request $request){


		if ($request->ajax()) {

			$PFCTCODE = $request->pfctCode;

			/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

				$BASE_URL    = $request->session()->get('base_url');
				$COMPCODE    = $request->session()->get('company_name');
				$FIRSTFYCODE = $request->session()->get('fiscal_year');
				$COMPCD      = explode('-', $COMPCODE);
				$MCOMPCODE   = $COMPCD[0];
				$FYCODE      = $request->session()->get('macc_year');
				$USERID      = $request->session()->get('userid');

			/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */

			if (!empty($PFCTCODE)) {
				
				$pfctlist  = DB::table('MASTER_PFCT')->where('COMP_CODE',$MCOMPCODE)->where('PFCT_CODE',$PFCTCODE)->get()->toArray();

				$response_array['response']     = 'success';
				$response_array['pfct_list']    = $pfctlist;
	            $data = json_encode($response_array);
	            print_r($data);

			}else{

				$response_array['response']     = 'error';
				$response_array['pfct_list']    = '';
				$data = json_encode($response_array);
	             print_r($data);
			}


		}else{


			$response_array['response']     = 'error';
			$response_array['pfct_list']    = '';
			$data = json_encode($response_array);
            print_r($data);


		} /* ./ Ajax If Close */


	}	


	public function RentBillPostingTaxCode(Request $request){


    	if ($request->ajax()) {

    	    if (!empty($request->pfctCode || $request->seriesCode || $request->scode || $request->sname || $request->accCode)) {

    	    	$pfctCode = $request->pfctCode;

    	    	$itemCode      = '';

    	    	$accCode       = $request->accCode;


    	/* ------ START : CHECK PLANT STATE AND ACC STATE ------- */

    	    	
    	    	$MASTERPFCT = DB::table('MASTER_PFCT')->where('PFCT_CODE',$pfctCode)->get()->toArray();

    	    	$MASTERPFCTDATA = json_decode(json_encode($MASTERPFCT),true);

    	    	$PFCTSTATE = $MASTERPFCTDATA[0]['STATE_CODE'];


    	    	if ($request->scode == $PFCTSTATE) {
                     $TAXTYPE = 'SCGST';
                }else{
                     $TAXTYPE = 'IGST';
                }

        /* ------ END : CHECK PLANT STATE AND ACC STATE ------- */



        /* ------- START : GET - ITEM HSN CODE --------- */

                $MASTERITEM = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->where('ITEMTYPE_CODE','SR')->get()->toArray();

                $MASTERITEMDATA = json_decode(json_encode($MASTERITEM),true);

                if ($MASTERITEMDATA) {

                	$HSNCODEDATA = $MASTERITEMDATA[0]['HSN_CODE'];
                	
                }else{

                	$HSNCODEDATA = '';

                }

        /* ------- END : GET - ITEM HSN CODE --------- */



        /* --------- START : GET - ITEM HSN TAX ON HSN-RATE ------- */

            /* --- START : GET-TAX ON TAX TYPE --- */

                $MASTERTAX = DB::table('MASTER_TAX')->where('TAX_TYPE',$TAXTYPE)->get()->toArray();

                $MASTERTAXDATA = json_decode(json_encode($MASTERTAX),true);

            /* --- END : GET-TAX ON TAX TYPE --- */


                $MASTERTAXARR = array();
                foreach ($MASTERTAXDATA as $row) {

                	$GETTAXCODE = $row['TAX_CODE'];

                	$MASTERHSNTAX = DB::table('MASTER_HSNRATE')->where('HSN_CODE',$HSNCODEDATA)->where('TAX_CODE',$GETTAXCODE)->get()->toArray();

                	$MASTERHSNTAXDATA = json_decode(json_encode($MASTERHSNTAX),true);

                	if ($MASTERHSNTAXDATA) {

                		foreach($MASTERHSNTAXDATA as $key){

                			$MASTERTAXARR[] = $key['TAX_CODE'];

                		}

                		$ITEMHSNTAX_MSG = 'FOUND';
                		
                	}else{
                		
                		$ITEMHSNTAX_MSG = 'NOT-FOUND';

                	}
                	
                }

                $MASTAXCOUNT = count($MASTERTAXARR);

                if ($MASTAXCOUNT>0 || !empty($MASTERTAXARR)) {
                	
                    $NEWTAXCODELIST = $MASTERTAXARR;

                }else{

                    $NEWTAXCODELIST = 'null';

                }

        /* --------- END : GET - ITEM HSN TAX ON HSN-RATE ------- */


        /* ------ START : GET - ACCOUNT TAX CODE ----- */

                $MASTERACC = DB::table('MASTER_ACC')->where('ACC_CODE',$accCode)->get()->toArray();

                $MASTERACCDATA = json_decode(json_encode($MASTERACC),true);


                if (isset($MASTERACCDATA[0]['TAX_CODE'])) {

                	$MASTERACCTAXCODE = $MASTERACCDATA[0]['TAX_CODE'];
                	
                }else{

                	$MASTERACCTAXCODE = 'null';

                }

        /* ------ END : GET - ACCOUNT TAX CODE ----- */



                if ($MASTERACCTAXCODE!='null' || $NEWTAXCODELIST!='null') {

					$response_array['response']       = 'success';
					$response_array['get_tax_list']   = $NEWTAXCODELIST;
					$response_array['acc_tax']        = $MASTERACCTAXCODE;
					$response_array['tax_message']    = 'tax-found';
					$response_array['validation_msg'] = '';
					$data                             = json_encode($response_array);
					print_r($data);

            	}else{

					$response_array['response']       = 'error';
					$response_array['get_tax_list']   = '';
					$response_array['acc_tax']        = '';
					$response_array['tax_message']    = 'tax-not-found';
					$response_array['validation_msg'] = 'Tax-Code Not Found...!';
					$data                             = json_encode($response_array);
					print_r($data);
                
            	}


    	    }else{

				$response_array['response']       = 'error';
				$response_array['get_tax_list']   = '';
				$response_array['acc_tax']        = '';
				$response_array['tax_message']    = 'data-not-found';
				$response_array['validation_msg'] = 'Data Not Found...!';
				$data                             = json_encode($response_array);
				print_r($data);


    	    }


    	 }else{


    	 	$response_array['response']  = 'error';
			$response_array['get_tax_list']  = '';
			$response_array['acc_tax']  = '';
			$response_array['tax_message'] = 'ajax-data-not-found';
			$response_array['validation_msg'] = 'AJAX Not Run. Please Check...!';
			$data = json_encode($response_array);
			print_r($data);


    	 }


	}


	public function getItemCdFromOrderNo(Request $request){


    	$response_array = array();

    	if ($request->ajax()) {

    		/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

				$BASE_URL    = $request->session()->get('base_url');
				$COMPCODE    = $request->session()->get('company_name');
				$FIRSTFYCODE = $request->session()->get('fiscal_year');
				$COMPCD      = explode('-', $COMPCODE);
				$MCOMPCODE   = $COMPCD[0];
				$FYCODE      = $request->session()->get('macc_year');
				$USERID      = $request->session()->get('userid');

			/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */

    		if (!empty($request->accCode || $request->orderNo)) {

    			$ACC_CODE = $request->accCode;
    			$SORDNO   = $request->orderNo;

    			$EXP = explode(" ",$SORDNO);

    			$MSERIESCODE = $EXP[1];
    			$MVRNO = $EXP[2];

	            $SALEORDERDATA = DB::SELECT("SELECT t1.*,t2.* FROM `SORDER_HEAD` t1 INNER JOIN `SORDER_BODY` t2 ON t1.SORDERHID=t2.SORDERHID WHERE t1.ACC_CODE='$ACC_CODE' AND t1.VRNO='$MVRNO' AND t1.SERIES_CODE='$MSERIESCODE' AND t1.COMP_CODE='$MCOMPCODE'");

	            $MSALEORDERDATA = json_decode(json_encode($SALEORDERDATA),true);

	            if ($MSALEORDERDATA) {

					$response_array['response']  = 'success';
					$response_array['sale_order_data']  = $MSALEORDERDATA;
				
	                $data = json_encode($response_array);
	                print_r($data);

	            }else{

					$response_array['response'] = 'error';
					$response_array['sale_order_data']  = '';
	                $data = json_encode($response_array);
	                print_r($data);
	                
	            }

	        }else{


	        	$response_array['response'] = 'error';
				$response_array['sale_order_data']  = '';
                $data = json_encode($response_array);
                print_r($data);


	        }

        }else{

                $response_array['response'] = 'error';
                $response_array['sale_order_data']  = '';
                $data = json_encode($response_array);
                print_r($data);
        }

    }

    public function getDataOnRentBillPosting(Request $request){


    	$response_array = array();

    	if ($request->ajax()) {

    		/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

				$BASE_URL    = $request->session()->get('base_url');
				$COMPCODE    = $request->session()->get('company_name');
				$FIRSTFYCODE = $request->session()->get('fiscal_year');
				$COMPCD      = explode('-', $COMPCODE);
				$MCOMPCODE   = $COMPCD[0];
				$FYCODE      = $request->session()->get('macc_year');
				$USERID      = $request->session()->get('userid');

			/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */

    		if (!empty($request->vrDateId || $request->transcode || $request->series_code || $request->pfctCodeId || $request->accountCode || $request->taxCode || $request->orderNo || $request->itemCdNm)) {

				$VRDT       = $request->vrDateId;
				$TCODE      = $request->transcode;
				$SERIESCODE = $request->series_code;
				$PFCTCD     = $request->pfctCodeId;
				$ACCCODE    = $request->accountCode;
				$TAXCODE    = $request->taxCode;
				$ORDERNO    = $request->orderNo;
				$ITEMCD     = $request->itemCdNm;

				date_default_timezone_set('Asia/Kolkata');

				$MVRDT      = date("Y-m-d", strtotime($VRDT));

				$first_date_find = strtotime(date("Y-m-d", strtotime($VRDT)) . ", first day of this month");
				$first_date = date("Y-m-d",$first_date_find);
				
				$last_date_find = strtotime(date("Y-m-d", strtotime($VRDT)) . ", last day of this month");
				$last_date = date("Y-m-d",$last_date_find);

				$EXP         = explode(" ",$ORDERNO);
				$MSERIESCODE = $EXP[1];
				$MVRNO       = $EXP[2];

				//DB::enableQueryLog();

	            $BILLINGSCHEDULE = DB::SELECT("SELECT * FROM `RPBILLING_SCHEDULE` WHERE ACC_CODE='$ACCCODE' AND SALE_ORDNO='$ORDERNO' AND  COMP_CODE='$MCOMPCODE' AND SCHEDULE_DATE BETWEEN '$first_date' AND '$last_date' AND SBILLHID='0'");

	            //dd(DB::getQueryLog());

	            $MBILLINGSCHEDULE = json_decode(json_encode($BILLINGSCHEDULE),true);


	            if ($MBILLINGSCHEDULE) {

					return DataTables()->of($BILLINGSCHEDULE)->addIndexColumn()->make(true);

	            }else{
	            	$MBILLINGSCHEDULE1 = array();
					return DataTables()->of($MBILLINGSCHEDULE1)->addIndexColumn()->make(true);
	                
	            }

	        }else{


	        	$MBILLINGSCHEDULE1 = array();
					return DataTables()->of($MBILLINGSCHEDULE1)->addIndexColumn()->make(true);


	        }

        }else{

               $MBILLINGSCHEDULE1 = array();
			return DataTables()->of($MBILLINGSCHEDULE1)->addIndexColumn()->make(true);
        }

    }

    public function SaveRentBillPosting(Request $request){

    	if ($request->ajax()) {


    		if (!empty($request->getTaxCode || $request->hidSeriesCode || $request->hidPfctCode || $request->hidOrderNo || $request->hidItemCdNm || $request->hidTcode || $request->hidAccCode)) {

    			/* --- START : GET HEAD DATA --- */

    			$TOTCHEKBXCOUNT = $request->hidCheckBoxCount;

    			$VRDATE     = $request->hidVrDate;
    			$TCODE      = $request->hidTcode;
    			$SERIESCODE = $request->hidSeriesCode;
    			$PFCTCODE   = $request->hidPfctCode;
    			$PFCTNAME   = $request->hidPfctName;
    			$SORDERNO   = $request->hidOrderNo;
    			$ITEMCDNM   = $request->hidItemCdNm;
    			$ACCCODE    = $request->hidAccCode;
    			$ACCNAME    = $request->hidAccNm;
    			$ACCGLCD    = $request->hidAccGl;
    			$ACCGLNM    = $request->hidAccGlNm;
    			$SERIESGLCD = $request->hidSeriesGlCd;
    			$SERIESGLNM = $request->hidSeriesGlNm;
    			$GRANDTOTAL = $request->TotalGrandAmt;
    			$BASICTOTAL = $request->TotalBasciAmt;

    			$NEWVRDT    = date("Y-m-d", strtotime($VRDATE));

    			/* --- END : GET HEAD DATA --- */


    			/* --- EXPLODE DATA ----- */

    			$EXPSERIES  = explode("[", $SERIESCODE);
    			$MEXPSERIES = explode("]", $EXPSERIES[1]);
    			$SERCODE    = $EXPSERIES[0];
    			$SERNAME    = $MEXPSERIES[0];

    			$EXPITEM     = explode("(", $ITEMCDNM);
    			$MEXPITEMNM  = explode(")", $EXPITEM[1]);
    			$ITEMCODE    = $EXPITEM[0];
    			$ITEMNAME    = $MEXPITEMNM[0];

    			/* --- ./ EXPLODE DATA ----- */


    			/* ~~~~~~~ GET SESSION DATA ~~~~~~~~ */

    			$base_url   = $request->session()->get('base_url');
    			$CompanyCode = $request->session()->get('company_name');
    			$mfiscalYear = $request->session()->get('fiscal_year');
    			$ccode       = explode('-', $CompanyCode);
    			$compCode    = $ccode[0];
    			$fyCode      = $request->session()->get('macc_year');
    			$userId      = $request->session()->get('userid');

    			/* ~~~~~~~ ./ GET SESSION DATA ~~~~~~~~ */



    			/* ------ GET BODY DATA IN ARRAY ------ */

    			$MGETKEY 	   = array_keys(array_filter($request->getTaxCode));


    			$MTAXCODE      = array_values(array_filter($request->getTaxCode));

    			$CHECKBOXDATA  = $request->checkBoxId;


    			/* ------- ./ GET BODY DATA IN ARRAY ------ */

    			DB::beginTransaction();

    			try {

    				/* ------ CHECK TEMPORARY DATA IN TABLE -------- */

    				DB::table('INDICATOR_TEMP')->where('CREATED_BY',$userId)->where('TCFLAG','SBFT')->delete();

    				/* ------ CHECK TEMPORARY DATA IN TABLE -------- */



    				/* ~~~~~~~~~~ FOR LOOP FIRST ~~~~~~~~~ */

    				$HSRNO = 1;
    				$MNEWVRNO = '';
    				$GETHEDID;
    				$LASTID;
    				$MBASICAMT = array();
    				$EXPCHECKBOXDATA1=array();
    				$HIDBID = array();
    				$SCHEDULEDATE = array();
    				for ($i = 0; $i < $TOTCHEKBXCOUNT; $i++) {


    					$GETKEY = $MGETKEY[$i];

    					$GETNEWKEY = $GETKEY + 1;

    					$EXPCHECKBOXDATA = explode("~",$CHECKBOXDATA[$i]);

    					$MFLAG = 1;

						$BILLSCHID    = $EXPCHECKBOXDATA[0];
						$SCHEDULEDATE[] = $EXPCHECKBOXDATA[7];
						$MACCCODE     = $EXPCHECKBOXDATA[1];
						$TAXCODE      = $MTAXCODE[$i];

						$HIDBID[]     = $BILLSCHID;

						$TRN_NO       = $EXPCHECKBOXDATA[1];

						$GETTAXAMT    = $TAXCODE.'_'.$GETNEWKEY;

						$TAXAMTDATA   = $request->input($GETTAXAMT);

						$MITEMCODE    = trim($ITEMCODE);
						$MITEM_NAME   = trim($ITEMNAME);


    					$ITEMHSN = DB::table('MASTER_ITEM')->WHERE('ITEM_CODE',$MITEMCODE)->WHERE('ITEM_NAME',$MITEM_NAME)->get();

    					$MITEMHSN = json_decode(json_encode($ITEMHSN),true);

    					/* ----- /. START : VRNO CREATE OR GET FROM DB -------- */

    					if ($MNEWVRNO!=$SORDERNO) {

    						$MNEWVRNO= $SORDERNO;

    						$lastVrno1 = DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$SERCODE)->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('TRAN_CODE',$TCODE)->get()->first();

    						$lastVrno = json_decode(json_encode($lastVrno1),true);

    						if ($lastVrno) {

    							$newVr = $lastVrno['LAST_NO'] + 1;

    							$datavrn =array(
    								'LAST_NO' => $newVr
    							);

    							DB::table('MASTER_VRSEQ')->where('SERIES_CODE',$SERCODE)->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('TRAN_CODE',$TCODE)->update($datavrn);

    						}else{

    							$datavrnIn =array(
    								'COMP_CODE'   => $compCode,
    								'FY_CODE'     => $fyCode,
    								'TRAN_CODE'   => $TCODE,
    								'SERIES_CODE' => $SERCODE,
    								'FROM_NO'     => 1,
    								'TO_NO'       => 99999,
    								'LAST_NO'     => 1,
    								'CREATED_BY'  => $userId,
    							);

    							DB::table('MASTER_VRSEQ')->insert($datavrnIn);

    							$newVr = 1;


    						}

    					}else{

    						/* DO NOTHING SAME VRNO FOR SAME DELIVERY NO */

    					}


    					/* ------ /. END : VRNO CREATE OR GET FROM DB ------ */



    					/* ~~~~~~ HEAD AND BODY DATA SAVE ~~~~~~~~~~ */

    					if ($i==0) {

    						$GETMAXID = DB::select("SELECT MAX(SBILLHID) AS SBHID FROM SBILL_HEAD");

    						$DATAGETMAXID = json_decode(json_encode($GETMAXID),true);


    						$MDATAGETMAXID = count($DATAGETMAXID);

    						if ($MDATAGETMAXID > 0) {

    							$GETID = $DATAGETMAXID[0]['SBHID'] + 1;

    						}else{

    							$GETID = 1;

    						}


    						$MHEADDATA = array(

    							'SBILLHID'		=> $GETID,
    							'COMP_CODE'		=> $compCode,
    							'FY_CODE'     	=> $fyCode,
    							'PFCT_CODE'   	=> $PFCTCODE,
    							'PFCT_NAME'    	=> $PFCTNAME,
    							'TRAN_CODE'    	=> $TCODE,
    							'SERIES_CODE'   => $SERCODE,
    							'SERIES_NAME'   => $SERNAME,
    							'VRNO'    		=> $newVr,
    							'SLNO'    		=> $HSRNO,
    							'VRDATE'    	=> $NEWVRDT,
    							'ACC_CODE'    	=> $ACCCODE,
    							'ACC_NAME'    	=> $ACCNAME,
    							'BILLSCHID'    	=> $BILLSCHID,
    							'TAX_CODE'    	=> $TAXCODE,
    							'DRAMT'    	    => $GRANDTOTAL,
    							'FLAG'    		=> $MFLAG,
    							'CREATED_BY' 	=> $userId

    						);

    						DB::table('SBILL_HEAD')->insert($MHEADDATA);

    						$LASTID = DB::getPdo()->lastInsertId();
    						$GETHEDID = $GETID;

    						$GETMAXIDBD = DB::select("SELECT MAX(SBILLBID) AS SBBID FROM SBILL_BODY");

    						$DATAGETMAXIDBD = json_decode(json_encode($GETMAXIDBD),true);

    						$MDATAGETMAXIDBD = count($DATAGETMAXIDBD);

    						if ($MDATAGETMAXIDBD > 0) {

    							$GETBID = $DATAGETMAXIDBD[0]['SBBID'] + 1;

    						}else{

    							$GETBID = 1;

    						}

    						$LASTID = $GETBID;

    						$MBODYDATA = array(

    							'SBILLHID'		=> $GETID,
    							'SBILLBID'		=> $GETBID,
    							'COMP_CODE'		=> $compCode,
    							'FY_CODE'     	=> $fyCode,
    							'PFCT_CODE'   	=> $PFCTCODE,
    							'TRAN_CODE'    	=> $TCODE,
    							'SERIES_CODE'   => $SERCODE,
    							'VRNO'    		=> $newVr,
    							'SLNO'    		=> $HSRNO,
    							'VRDATE'    	=> $NEWVRDT,
    							'ITEM_CODE'     => $MITEMCODE,
    							'ITEM_NAME'     => $MITEM_NAME,
    							'HSN_CODE'      => $MITEMHSN[0]['HSN_CODE'],
    							'QTYISSUED'    	=> $EXPCHECKBOXDATA[8],
    							'RATE'    		=> $EXPCHECKBOXDATA[6],
    							'BASICAMT'    	=> $BASICTOTAL,
    							'TAX_CODE'    	=> $TAXCODE,
    							'DRAMT'    		=> $GRANDTOTAL,
    							'FLAG'    		=> $MFLAG,
    							'CREATED_BY' 	=> $userId

    						);



    						DB::table('SBILL_BODY')->insert($MBODYDATA);

    						$SBBID = DB::getPdo()->lastInsertId();

    						$MBASICAMT[] = $BASICTOTAL;


    					}else{


    						$GETMAXIDBD = DB::select("SELECT MAX(SBILLBID) AS SBBID FROM SBILL_BODY");

    						$DATAGETMAXIDBD = json_decode(json_encode($GETMAXIDBD),true);

    						$GETBDID = $DATAGETMAXIDBD[0]['SBBID'] + 1;

    						$LASTID = $GETBDID;

    						$MBODYDATA1 = array(

    							'SBILLHID'		=> $GETHEDID,
    							'SBILLBID'		=> $GETBDID,
    							'COMP_CODE'		=> $compCode,
    							'FY_CODE'     	=> $fyCode,
    							'PFCT_CODE'   	=> $PFCTCODE,
    							'TRAN_CODE'    	=> $TCODE,
    							'SERIES_CODE'   => $SERCODE,
    							'VRNO'    		=> $newVr,
    							'SLNO'    		=> $HSRNO,
    							'VRDATE'    	=> $NEWVRDT,
    							'ITEM_CODE'     => $MITEMCODE,
    							'ITEM_NAME'     => $MITEM_NAME,
    							'HSN_CODE'      => $MITEMHSN[0]['HSN_CODE'],
    							'QTYISSUED'    	=> $SCHEDULE_AMT[8],
    							'RATE'    		=> $EXPCHECKBOXDATA[6],
    							'BASICAMT'    	=> $BASICTOTAL,
    							'TAX_CODE'    	=> $TAXCODE,
    							'DRAMT'    		=> $GRANDTOTAL,
    							'FLAG'    		=> $MFLAG,
    							'CREATED_BY' 	=> $userId

    						);

    						DB::table('SBILL_BODY')->insert($MBODYDATA1);

    						$SBBID = DB::getPdo()->lastInsertId();

    						$MBASICAMT[] = $EXPCHECKBOXDATA[13];

    					} 

    					/* ~~~~~ HEAD AND BODY DATA SAVE IF CLOSE ~~~~~~ */



    					/* ~~~~~ TAX DATA SAVE ~~~~~~ */


    					$TAXRATEDATA = DB::select("SELECT * FROM `MASTER_TAXRATE` WHERE TAX_CODE = '$TAXCODE'");

    					$MTAXRATE = json_decode(json_encode($TAXRATEDATA),true);


    					$MTAXRATECOUNT = count($MTAXRATE);

    					$srNo = 1;
    					for ($j = 0; $j < $MTAXRATECOUNT; $j++) {

    						$FLAG = 1;

    						$GETMAXIDTD = DB::select("SELECT MAX(SBILLTID) AS SBTID FROM SBILL_TAX");

    						$DATAGETMAXIDTD = json_decode(json_encode($GETMAXIDTD),true);

    						$MDATAGETMAXIDTD = count($DATAGETMAXIDTD);

    						if ($MDATAGETMAXIDTD > 0) {

    							$GETTID = $DATAGETMAXIDTD[0]['SBTID'] + 1;

    						}else{

    							$GETTID = 1;

    						}



    						$MDATA = array(

    							'SBILLHID'   	=> $GETID,
    							'SBILLBID'   	=> $LASTID,
    							'SBILLTID'   	=> $GETTID,
    							'TAXIND_CODE'   => $MTAXRATE[$j]['TAXIND_CODE'],
    							'TAXIND_NAME'   => $MTAXRATE[$j]['TAXIND_NAME'],
    							'RATE_INDEX'   	=> $MTAXRATE[$j]['RATE_INDEX'],
    							'TAX_RATE'    	=> $MTAXRATE[$j]['TAX_RATE'],
    							'TAX_AMT'    	=> $TAXAMTDATA[$j],
    							'TAX_LOGIC'    	=> $MTAXRATE[$j]['TAX_LOGIC'],
    							'TAXGL_CODE'    => $MTAXRATE[$j]['TAX_GL_CODE'],
    							'TAXGL_NAME'    => $MTAXRATE[$j]['TAX_GL_NAME'],
    							'STATIC_IND'    => $MTAXRATE[$j]['STATIC_IND'],
    							'FLAG'    		=> $FLAG,
    							'CREATED_BY' 	=> $userId

    						);


    						DB::table('SBILL_TAX')->insert($MDATA);


    						$srNo++;

    					} /* ./ $j for loop close */


    					/* ~~~~~ ./ TAX DATA SAVE CLOSE ~~~~~~ */

    					$HSRNO++;

    				} /* ./ FOR-LOOP CHECK-BOX CHECKED COUNT FIRST (TOP) CLOSE ~~~~~~~*/



    				/* _________ START : GET DATA FROM SALE BILL TAX _____________ */

    				$GETTAXDATA = DB::select("SELECT * FROM `SBILL_TAX` WHERE SBILLHID = '$GETID'");

    				$taxAmtTot = 0;
    				foreach($GETTAXDATA as $rowT){

    					if($rowT->TAXIND_CODE == 'GT01'){
    						$taxAmtTot += $rowT->TAX_AMT;
    					}

    					if($rowT->TAX_AMT != '' && $rowT->TAX_AMT !=0.00){

    						if($rowT->RATE_INDEX != 'Z'){

    							$CHKFIRSTDATAEXIST = DB::table('INDICATOR_TEMP')->where('TCFLAG','RBPT')->where('CREATED_BY',$userId)->get()->toArray();

    							$existGlData = DB::table('INDICATOR_TEMP')->where('IND_GL_CODE',$rowT->TAXGL_CODE)->where('CREATED_BY',$userId)->where('TCFLAG','RBPT')->get()->toArray();

    							if(empty($CHKFIRSTDATAEXIST)){

    								$idary = array(
    									'IND_CODE'    => $rowT->TAXIND_CODE,
    									'CR_AMT'      => $rowT->TAX_AMT,
    									'DR_AMT'      => 0.00,
    									'IND_GL_CODE' => $SERIESGLCD,
    									'IND_GL_NAME' => $SERIESGLNM,
    									'TCFLAG'      => 'RBPT',
    									'CREATED_BY'  => $userId,

    								);
    								DB::table('INDICATOR_TEMP')->insert($idary);

    							}else if(($rowT->TAXGL_CODE == '') || ($rowT->TAXGL_CODE == NULL)){

    								$bscVal = DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('CREATED_BY',$userId)->where('TCFLAG','RBPT')->get()->toArray();

    								$updateId = $bscVal[0]->CREATED_BY;
    								$basicAmt = $bscVal[0]->CR_AMT + $rowT->TAX_AMT;

    								$idary_bsic = array(
    									'CR_AMT'      =>$basicAmt,
    									'DR_AMT'      =>0.00,
    								);

    								DB::table('INDICATOR_TEMP')->where('IND_CODE','B01')->where('TCFLAG','RBPT')->where('CREATED_BY',$updateId)->update($idary_bsic);

    							}else if(empty($existGlData)){

    								$idary   = array(
    									'IND_CODE'    => $rowT->TAXIND_CODE,
    									'DR_AMT'      => 0.00,
    									'CR_AMT'      => $rowT->TAX_AMT,
    									'IND_GL_CODE' => $rowT->TAXGL_CODE,
    									'IND_GL_NAME' => $rowT->TAXGL_NAME,
    									'TCFLAG'      => 'RBPT',
    									'CREATED_BY'  => $userId,

    								);

    								DB::table('INDICATOR_TEMP')->insert($idary);

    							}else{

    								$indData1 = DB::table('INDICATOR_TEMP')->where('IND_GL_CODE',$rowT->TAXGL_CODE)->where('TCFLAG','RBPT')->where('CREATED_BY',$userId)->get()->first();

    								$newTaxAmt = $indData1->CR_AMT + $rowT->TAX_AMT;

    								$idary1 = array(
    									'CR_AMT' =>$newTaxAmt,
    									'DR_AMT' => '0.00',
    								);

    								DB::table('INDICATOR_TEMP')->where('IND_GL_CODE',$rowT->TAXGL_CODE)->where('TCFLAG','RBPT')->where('CREATED_BY',$userId)->update($idary1);
    							}

    						}/* /. CHECK TAX IND IS Z*/
    					} /* /.CHECK TAX AMOUNT IS ZERO OR BLANK*/

    				} /* /.FOREACH LOOP*/


    				/* START : TEMP-ACC ENTRY */

    				$idary   = array(
    					'GLACC_Chk'   => 'ACC',
    					'DR_AMT'      => $taxAmtTot,
    					'CR_AMT'      => 0.00,
    					'IND_GL_CODE' => $ACCGLCD,
    					'IND_GL_NAME' => $ACCGLNM,
    					'TCFLAG'      => 'RBPT',
    					'CREATED_BY'  => $userId,

    				);

    				DB::table('INDICATOR_TEMP')->insert($idary);

    				/* END : TEMP-ACC ENTRY */

    				/* _________ END : GET DATA FROM SALE BILL TAX _____________ */


    				/* ~~~~~~~~~~~~~~ START : LEDGER ENTRY EFFECT ~~~~~~~~~~~~~~~~~~~~~ */


    				$GETTEMPDATA = DB::table('INDICATOR_TEMP')->where('TCFLAG','RBPT')->where('CREATED_BY',$userId)->get()->toArray();

    				$SRNO = 1;

    				foreach ($GETTEMPDATA as $ROW) {     

    					$pfctcode       = '';
    					$transport_code = '';
    					$transport_name = '';
    					$blankVal       = '';
    					$GLCODE         = $ROW->IND_GL_CODE;
    					$GLNAME         = $ROW->IND_GL_NAME;
    					$DRAMT          = $ROW->DR_AMT;
    					$CRAMT          = $ROW->CR_AMT;
    					$slno           = $SRNO;
    					$EXP            = explode('[',$SERIESCODE);
    					$NEWSERICECD    = $EXP[0];
    					$FYCD 			=  $fyCode;

    					$FINALBILLNO 	= $NEWSERICECD.'/'.$FYCD.'/'.$newVr;

    					$perticulerText = 'Rent Bill For This '.$FINALBILLNO.' Rent Bill No and '.$NEWVRDT.'  Rent Date and '.$TCODE.' Transaction and '.$NEWSERICECD.' Screies and '.$PFCTCODE.' PFCT Code and '.$PFCTNAME.' PFCT Name and '.$SORDERNO.' Sale Order No.';

    					$resultgl = (new AccountingController)->GlTEntry($compCode,$fyCode,$TCODE,$NEWSERICECD,$newVr,$slno,$NEWVRDT,$PFCTCODE,$GLCODE,$GLNAME,$ACCCODE,$ACCNAME,$blankVal,$blankVal,$blankVal,$blankVal,$DRAMT,$CRAMT,$perticulerText,$userId);


    					if($ROW->GLACC_Chk == 'ACC'){

    						$result = (new AccountingController)->AccountTEntry($compCode,$fyCode,$TCODE,$NEWSERICECD,$newVr,$slno,$NEWVRDT,$PFCTCODE,$ACCCODE,$ACCNAME,$GLCODE,$GLNAME,$blankVal,$blankVal,$blankVal,$blankVal,$DRAMT,$CRAMT,$perticulerText,$userId);
    					}


    					$SRNO++;

    				}


    				/* ~~~~~~~~~~~~~~ END : LEDGER ENTRY EFFECT ~~~~~~~~~~~~~~~~~~~~~ */



    			/* ~~~~~~~~~~ START : UPDATE RPBILLING_SCHEDULE TBL ~~~~~~~~~~ */

    			$HIDCOUNT = count($HIDBID);

    			for ($p = 0; $p < $HIDCOUNT;$p++) {

    				$DATA01 = array(
						'SBILLHID' => $GETHEDID
					);
    			

    				DB::table('RPBILLING_SCHEDULE')->where('BILLSCHID',$HIDBID[$p])->where('ACC_CODE',$ACCCODE)->where('SALE_ORDNO',$SORDERNO)->where('SCHEDULE_DATE',$SCHEDULEDATE[$p])->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->update($DATA01);
    				
    			}

    				


    			/* ~~~~~~~~~~ END : UPDATE RPBILLING_SCHEDULE TBL ~~~~~~~~~~ */




				DB::commit();


				$response_array['response']       = 'success';
				$data = json_encode($response_array);
				print_r($data);


			}catch (\Exception $e) {

				DB::rollBack();
				//throw $e;
				$response_array['response']   = 'error';
				$data = json_encode($response_array);
				print_r($data);


			}


		}else{


			$response_array['response']       = 'error';
			$data = json_encode($response_array);
			print_r($data);



		}/* ./ Second Top Check All Condition If Close  */



		}else{


			$response_array['response']   = 'error';
			$data = json_encode($response_array);
			print_r($data);


		} /* ./ Ajax If Top Close */


    }


    public function SaveRentBillPostingMsg(Request $request,$saveData){

    	if ($saveData == 'false'){

			$request->session()->flash('alert-error', 'Data Can Not Added ...!');
			return redirect('/transaction/property-rental-utility/rent-bill-posting');

		} else {

			$request->session()->flash('alert-success', 'Data Was Successfully Added...!');
			return redirect('/transaction/property-rental-utility/rent-bill-posting');

		}

    }

    public function tempSaleBillChildView(Request $request){

    	$response_array = array();

		if ($request->ajax()) {

	    	$vrno   = $request->input('vrno');
		   	$headid = $request->input('tblid');

	    	$tempBillData = DB::table('SBILL_BODY_PROV')->where('PSBILLHID',$headid)->get();

    		if ($tempBillData) {

    			$response_array['response'] = 'success';
    			$response_array['message'] = 'success';
	            $response_array['data'] = $tempBillData;
	           
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

    		$response_array['response'] = 'error';
    		$response_array['message'] = 'error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);

	    }

    }


    public function eProcStatusCheck(Request $request){

    	$response_array = array();

		if ($request->ajax()) {

		   	$headid = $request->input('headId');

	    	$tempBillData = DB::table('SBILL_BODY_PROV')->where('PSBILLHID',$headid)->get();

    		if ($tempBillData) {

    			$response_array['response'] = 'success';
    			$response_array['message'] = 'success';
	            $response_array['data'] = $tempBillData;
	           
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

    		$response_array['response'] = 'error';
    		$response_array['message'] = 'error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);

	    }


    }


    public function deleteSaleBillProvisional(Request $request){

		$headid = $request->input('headID');

    	if ($headid) {

    		$tempBillBodyData = DB::table('SBILL_BODY_PROV')->where('PSBILLHID',$headid)->get();

    		$getCount = count($tempBillBodyData);

    		$srNo = 1;
    		$arr = array();
    		foreach ($tempBillBodyData as $row) {

    			$TRIPBID = $row->TRIPBID;

    			DB::select("UPDATE TRIP_BODY B SET B.PSBILLBID = 0,B.PROVBILL_STATUS = 0 WHERE B.TRIPBID = '$TRIPBID'");

    			if ($getCount==$srNo) {
    				array_push($arr,"true");
    			}

    			$srNo++;
    		}

    		$arrCount = count($arr);
    		
    		if ($arrCount>0) {

    			$tempBillBodyDelete = DB::table('SBILL_BODY_PROV')->where('PSBILLHID',$headid)->delete();
	    		$tempBillHeadDelete = DB::table('SBILL_HEAD_PROV')->where('PSBILLHID',$headid)->delete();

	    		if ($tempBillBodyDelete && $tempBillHeadDelete) {

	    			$request->session()->flash('alert-success', 'Provisional Sale Bill Data Was Deleted Successfully...!');
					return redirect('/logistic/view-sale-bill-provisional');

				} else {

					$request->session()->flash('alert-error', 'Provisional Sale Bill Data Can Not Be Deleted...!');
					return redirect('/logistic/view-sale-bill-provisional');

				}
    		}

	    }else{

    		$request->session()->flash('alert-error', 'Provisional Sale Bill Data Can Not Be Deleted...!');
			return redirect('/logistic/view-sale-bill-provisional');

	    }


    }

    public function ViewSaleBillFinalLogistics(Request $request){

    	$compName = $request->session()->get('company_name');

	    if($request->ajax()) {

			$title        = 'View Sale Bill Final';
			
			$userid       = $request->session()->get('userid');
			
			$userType     = $request->session()->get('usertype');
			
			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];
			
			$fisYear      =  $request->session()->get('macc_year');

	        $data =DB::select("SELECT SBILL_HEAD_PROV.*,SBILL_BODY_PROV.*,SBILL_HEAD.VRNO AS SVRNO,SBILL_HEAD.FY_CODE AS SFYCODE,SBILL_HEAD.SERIES_CODE AS SERIESCD,SBILL_HEAD.TRAN_TYPE AS TRANTYPE,SBILL_HEAD.TAX_CODE,SBILL_HEAD.ACC_CODE AS ACCCODE,SBILL_HEAD.ACC_NAME AS ACCNAME,SBILL_HEAD.VRDATE AS SVRDATE,SBILL_HEAD.TRAN_CODE AS T_CODE FROM SBILL_HEAD_PROV,SBILL_BODY_PROV,SBILL_HEAD WHERE SBILL_BODY_PROV.PSBILLHID = SBILL_HEAD_PROV.PSBILLHID AND SBILL_HEAD.SBILLHID = SBILL_BODY_PROV.SBILLHID AND SBILL_HEAD_PROV.TRAN_TYPE = SBILL_HEAD.TRAN_TYPE AND SBILL_HEAD_PROV.COMP_CODE='$getcom_code' AND SBILL_HEAD_PROV.FY_CODE='$fisYear' AND (SBILL_BODY_PROV.SBILLHID!=0 OR SBILL_BODY_PROV.SBILLHID IS NOT NULL) GROUP BY SBILL_HEAD.SBILLHID ORDER BY SBILL_HEAD_PROV.VRNO ASC,SBILL_HEAD_PROV.VRDATE DESC");

	    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
                
            })->toJson();

	    }

	    if(isset($compName)){

	       return view('admin.finance.transaction.logistic.view_sale_bill_final');

	    }else{

			return redirect('/useractivity');

		}


    }

    public function tempSaleBillFinalChildView(Request $request){

    	$response_array = array();

		if ($request->ajax()) {

			$svrno    = $request->input('svrno');
			$vrno     = $request->input('vrno');
			$headid   = $request->input('tblid');
			$sbillhid = $request->input('sbillhid');

		   	$userid       = $request->session()->get('userid');
			$userType     = $request->session()->get('usertype');
			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];
			$fisYear      =  $request->session()->get('macc_year');

	    	$tempBillData1 = DB::table('SBILL_BODY')->where('SBILLHID',$sbillhid)->where('VRNO',$svrno)->get();

	    	$tempBillData =DB::select("SELECT SBILL_HEAD_PROV.*,SBILL_BODY_PROV.*,SBILL_TAX_VIEW.CGST AS TCGST,SBILL_TAX_VIEW.SGST AS TSGST,SBILL_TAX_VIEW.IGST AS TIGST,SBILL_TAX_VIEW.GRAND_TOTAL AS TGRANDTOT,ROUND_OFF AS ROUNDOFF FROM SBILL_HEAD_PROV,SBILL_BODY_PROV,SBILL_TAX_VIEW WHERE SBILL_BODY_PROV.PSBILLHID = SBILL_HEAD_PROV.PSBILLHID AND  SBILL_BODY_PROV.SBILLHID = SBILL_TAX_VIEW.SBILLHID AND SBILL_BODY_PROV.SBILLBID = SBILL_TAX_VIEW.SBILLBID  AND SBILL_HEAD_PROV.COMP_CODE='$getcom_code' AND SBILL_HEAD_PROV.FY_CODE='$fisYear' AND SBILL_BODY_PROV.SBILLHID='$sbillhid'");

    		if ($tempBillData) {

    			$response_array['response'] = 'success';
    			$response_array['message'] = 'success';
	            $response_array['data'] = $tempBillData;
	           
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

    		$response_array['response'] = 'error';
    		$response_array['message'] = 'error';
            $response_array['data'] = '' ;
            $data = json_encode($response_array);

            print_r($data);

	    }

    }


	public function DeleteSaleBillFinalLogistics(Request $request){

		
		DB::beginTransaction();

		try {

			$PSBILLHID = $request->provHId;
			$SBILLHID  = $request->sbillHId;
			$REMARK    = $request->delRemark;
			
			$sbillHeadDat = DB::table('SBILL_HEAD')->where('SBILLHID',$SBILLHID)->get();
			
			$sCompCode   = $sbillHeadDat[0]->COMP_CODE;
			$sFyCode     = $sbillHeadDat[0]->FY_CODE;
			$sTranCode   = $sbillHeadDat[0]->TRAN_CODE;
			$sseriesCode = $sbillHeadDat[0]->SERIES_CODE;
			$sVrNo       = $sbillHeadDat[0]->VRNO;


			/* ------ START : REVERSE DATA FROM GL BALENCE WHEN DELETE -------- */

				$glTRanData = DB::table('GL_TRAN')->where('COMP_CODE', $sCompCode)->where('FY_CODE', $sFyCode)->where('TRAN_CODE', $sTranCode)->where('SERIES_CODE', $sseriesCode)->where('VRNO', $sVrNo)->get();
				
				for ($i = 0; $i <count($glTRanData); $i++) {
					
					$glCode = $glTRanData[$i]->GL_CODE;
					$drAmtED = $glTRanData[$i]->DRAMT;
					$crAmtED = $glTRanData[$i]->CRAMT;

					$getglBal = DB::table('MASTER_GLBAL')->where('COMP_CODE',$sCompCode)->where('FY_CODE',$sFyCode)->where('GL_CODE', $glCode)->get()->first();

					$RDRAMT    = $getglBal->RDRAMT;
					$RCRAMT    = $getglBal->RCRAMT;
					$YROPDR    = $getglBal->YROPDR;
					$YROPCR    = $getglBal->YROPCR;

					$debitAmt  =   $RDRAMT - $drAmtED;

					$creditAmt =  $RCRAMT - $crAmtED;

					$RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);

					$dataGlED = array(
					
						'RDRAMT'  => $debitAmt,
						'RCRAMT'  => $creditAmt,
						'RBAL'    => $RBAL,
				
					);

					DB::table('MASTER_GLBAL')->where('COMP_CODE',$sCompCode)->where('FY_CODE',$sFyCode)->where('GL_CODE', $glCode)->update($dataGlED);
				}

			/* ------ END : REVERSE DATA FROM GL BALENCE WHEN DELETE -------- */

			/* ------ START : REVERSE DATA FROM ACC BALENCE WHEN DELETE -------- */

				$accTranData = DB::table('ACC_TRAN')->where('COMP_CODE', $sCompCode)->where('FY_CODE', $sFyCode)->where('TRAN_CODE', $sTranCode)->where('SERIES_CODE', $sseriesCode)->where('VRNO', $sVrNo)->get();

				if($accTranData){

					for($j=0;$j<count($accTranData);$j++){

						$a_accCode = $accTranData[$j]->ACC_CODE;
						$a_drAmt   =$accTranData[$j]->DRAMT;
						$a_crAmt   = $accTranData[$j]->CRAMT;

						$getaccBal = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$sCompCode)->where('FY_CODE',$sFyCode)->where('ACC_CODE', $a_accCode)->get()->first();

						if($getaccBal !=''){
			
							$RDRAMT_ED    = $getaccBal->RDRAMT;
							$RCRAMT_ED    = $getaccBal->RCRAMT;
							$YROPDR_ED    = $getaccBal->YROPDR;
							$YROPCR_ED    = $getaccBal->YROPCR;
							$debitAmt_ED  =  $RDRAMT_ED - $a_drAmt;
							$creditAmt_ED =  $RCRAMT_ED - $a_crAmt;

							$RBAL_ED  = floatval($YROPDR_ED - $YROPCR_ED) + floatval($debitAmt_ED - $creditAmt_ED);

							$dataAccED = array(
								'RDRAMT'  => $debitAmt_ED,
								'RCRAMT'  => $creditAmt_ED,
								'RBAL'    => $RBAL_ED,
							);

							DB::table('MASTER_ACCBAL')->where('COMP_CODE',$sCompCode)->where('FY_CODE',$sFyCode)->where('ACC_CODE', $a_accCode)->update($dataAccED);
						}
					}

				}/* ./ check in acc tran*/
				

			/* ------ END : REVERSE DATA FROM ACC BALENCE WHEN DELETE -------- */

			DB::table('ACC_TRAN')->where('COMP_CODE', $sCompCode)->where('FY_CODE', $sFyCode)->where('TRAN_CODE', $sTranCode)->where('SERIES_CODE', $sseriesCode)->where('VRNO', $sVrNo)->delete();
			DB::table('GL_TRAN')->where('COMP_CODE', $sCompCode)->where('FY_CODE', $sFyCode)->where('TRAN_CODE', $sTranCode)->where('SERIES_CODE', $sseriesCode)->where('VRNO', $sVrNo)->delete();

			DB::table('SBILL_HEAD')->where('SBILLHID', $SBILLHID)->delete();
			DB::table('SBILL_BODY')->where('SBILLHID', $SBILLHID)->delete();
			DB::table('SBILL_TAX')->where('SBILLHID', $SBILLHID)->delete();

			$SALEBILLUPDATE =array(
				'SBILLHID'         =>'0'
			);

			DB::table('SBILL_BODY_PROV')->where('SBILLHID',$SBILLHID)->update($SALEBILLUPDATE);

				DB::commit();


				$response_array['response']       = 'success';
				$data = json_encode($response_array);
				print_r($data);


			}catch (\Exception $e) {

				DB::rollBack();
				//throw $e;
				$response_array['response']   = 'error';
				$data = json_encode($response_array);
				print_r($data);


			}

	}


	public function MsgSaleBillFinalLogistics(Request $request,$deleteStatus){

		if ($deleteStatus=='true') {

			$request->session()->flash('alert-success', 'Final Sale Bill Data Was Deleted Successfully...!');
			return redirect('/logistic/view-sale-bill-final');

		} else {

			$request->session()->flash('alert-error', 'Final Sale Bill Data Can Not Be Deleted...!');
			return redirect('/logistic/view-sale-bill-final');

		}


	}


	public function SaleBillFinalLogisticsOffLinePdf(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$PSBILLHID    = $request->input('PSBILLHID');/*----*/
			$SBILLHID     = $request->input('SBILLHID');/*----*/
			$DTRowIndex   = $request->input('DTRowIndex');/*----*/
			$SVRNO        = $request->input('SVRNO');/*----*/
			$T_CODE       = $request->input('T_CODE');/*----*/
			$SVRDATE      = $request->input('SVRDATE');/*----*/
			$amtToWord    = '';/*----*/
			
			$userid       = $request->session()->get('userid');
			$userType     = $request->session()->get('usertype');
			$comp_nameval = $request->session()->get('company_name');
			$explode      = explode('-', $comp_nameval);
			$getcom_code  = $explode[0];
			$fisYear      =  $request->session()->get('macc_year');
			$expYr        = explode('-', $fisYear);
			$firstYear    = $explode[0]; 

			$response_array = array();

			$compDetail = DB::select("SELECT * FROM MASTER_COMP WHERE COMP_CODE='$getcom_code'");
			
			$psBillData = DB::select("SELECT A.ACC_NAME,A.ACC_CODE AS ACCCODE,A.SERIES_CODE,A.ITEM_CODE,A.ITEM_NAME,A.FY_CODE,A.SERIES_CODE,A.VRNO,B.* FROM SBILL_HEAD_PROV A LEFT JOIN SBILL_BODY_PROV B ON A.PSBILLHID=B.PSBILLHID WHERE B.SBILLHID='$SBILLHID'");

			$provDt = json_decode( json_encode($psBillData), true);

			$ACCCD = $provDt[0]['ACCCODE']; /*----*/
			$SERCODE = $provDt[0]['SERIES_CODE']; /*----*/


			$AccDetail = DB::select("SELECT * FROM MASTER_ACC WHERE ACC_CODE='$ACCCD'");

			$getAccDetail = json_decode( json_encode($AccDetail), true);

			$ACC_PAN = $getAccDetail[0]['PAN_NO']; /*----*/
			$BILLFORMAT = $getAccDetail[0]['BILL_FORMAT']; /*----*/
			
			
			$AccAddDetail = DB::select("SELECT * FROM MASTER_ACCADD WHERE ACC_CODE='$ACCCD'"); /*----*/

			$getAccAddDetail = json_decode( json_encode($AccAddDetail), true); /*----*/

			$ACC_ADDRESS = $getAccAddDetail[0]['ADD1'].''.$getAccAddDetail[0]['CITY_NAME'].','.$getAccAddDetail[0]['PIN_CODE']; /*----*/

			$ACC_CITY = $getAccAddDetail[0]['CITY_NAME'];  /*----*/
			$ACC_GSTIN = $getAccAddDetail[0]['GST_NUM']; /*----*/
			$ACCSTATE = $getAccAddDetail[0]['STATE_NAME']; /*----*/

			
			
			$HIDBID = array();
			$BODYIDGET = array();
			$pdfBillNo = '';
			$vrDate = '';
			for($q=0;$q<count($provDt);$q++){

				$PSBID = $provDt[$q]['PSBILLBID']; /*----*/
				$PSHID = $provDt[$q]['PSBILLHID']; /*----*/

				$BODYIDGET[]    = $provDt[$q]['SBILLBID']; /*----*/

				$HIDBID[] = $PSHID.'~'.$PSBID; /*----*/


				$dataHead = DB::select("SELECT * FROM SBILL_HEAD WHERE SBILLHID='$SBILLHID'");

				$headData = json_decode( json_encode($dataHead), true);
				
				$MVRNO      = $headData[0]['VRNO'];
				$MFYCODE    = $headData[0]['FY_CODE'];
				$SERIESCD   = $headData[0]['SERIES_CODE'];
				$VRDT       = $headData[0]['VRDATE'];

				$vrDate     = date("d-m-Y", strtotime($VRDT)); 

				$EXP = explode('-',$MFYCODE);

				$FIRSTYR = $EXP[0];

				$pdfBillNo = $FIRSTYR.'/'.$SERIESCD.'/'.$MVRNO; /* ----- */


			}

			$GRANDTOTWORD = '';

			$filePdf =  $this->GeneratePdfForFinalSaleBill($getcom_code,$firstYear,$SERCODE,$SVRNO,$T_CODE,$HIDBID,$ACC_ADDRESS,$ACC_CITY,$ACC_PAN,$ACC_GSTIN,$ACCSTATE,$fisYear,$SBILLHID,$amtToWord,$pdfBillNo,$BODYIDGET,$SVRDATE,$BILLFORMAT);


			
    		if ($filePdf) {

				$path1                       = public_path('dist/downloadpdf'); 
				$fileName                    =  time().'_Final_sale_bill.'. 'pdf' ;
				$filePdf->save($path1 . '/' . $fileName);
				$PublicPath                  = url('public/dist/downloadpdf/');  
				$downloadPdf                 = $PublicPath.'/'.$fileName;
				$response_array['response']  = 'success';
				$response_array['url']       = $downloadPdf;
				$response_array['bill_no']   = $pdfBillNo;
				

			    $data = json_encode($response_array);
			    print_r($data);

			}else{

				$response_array['response']  = 'error';
				$response_array['url']       = '';
				$response_array['bill_no']   = '';
				

			    $data = json_encode($response_array);
			    print_r($data);
				
			}

	    }else{

    		$response_array['response']  = 'error';
			$response_array['url']       = '';
			$response_array['bill_no']   = '';
			

		    $data = json_encode($response_array);
		    print_r($data);

	    }

	}

}

?>

