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


class Stock_InventoryController extends Controller{

	public function ProcessItemAge(Request $request){

		$companyDetailss = $request->session()->get('company_name');
		$splitDataa = explode('-',$companyDetailss);
		$compCodee = $splitDataa[0];

		$userDataa['plantList']=DB::table('MASTER_PLANT')->where('COMP_CODE',$compCodee)->get();

		return view('admin.finance.report.stock.process_item_age',$userDataa);

	}

	public function ProcessItemSave(Request $request){

		$request->validate([
			'asonDate'       => 'required',
			'Rng1'           => 'required',
            'Rng2'           => 'required',
			'Rng3'           => 'required',
			'Rng4'           => 'required',
			'Rng5'           => 'required',

		]);

		$companyDetails = $request->session()->get('company_name');
		$splitData      = explode('-',$companyDetails);
		$mCompCode       = $splitData[0];
		$mCompName      = $splitData[1];

		$userData['plantList']=DB::table('MASTER_PLANT')->where('COMP_CODE',$mCompCode)->get();

		DB::beginTransaction();

		try {
			$tablDataId  = $request->input('tablDataId');
			$plantCode     = $request->input('plantCode');
			$plantName     = $request->input('plantName');
			$range_one   = $request->input('Rng1');
			$range_two   = $request->input('Rng2');
			$range_three = $request->input('Rng3');
			$range_four  = $request->input('Rng4');
			$range_five  = $request->input('Rng5');
			$createdBy = $request->session()->get('userid');
			$macc_year = $request->session()->get('macc_year');
			$asondt    = $request->input('asonDate');
			$asonDate  =  date("Y-m-d", strtotime($asondt));
			$yrBegDt   = session()->get('yrbgdate');
			$YrBegDate = date("Y-m-d", strtotime($yrBegDt));
			$toDayDate = $asonDate;

			if($tablDataId !=''){

				$updatedata = array(
					"ASON_DATE"  => $asonDate,
					"RANGE01"    => $request->input('Rng1'),
					"RANGE02"    => $request->input('Rng2'),
					"RANGE03"    => $request->input('Rng3'),
					"RANGE04"    => $request->input('Rng4'),
					"RANGE05"    => $request->input('Rng5'),
				);

				DB::table('ITEM_AGE_PARA')->where('ITEMAGEPARAID',$tablDataId)->update($updatedata);

			}else{

				$data = array(
					"COMP_CODE"  => $mCompCode,
					"COMP_NAME"  => $mCompName,
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

				DB::table('ITEM_AGE_PARA')->insert($data);

			}

			$request =$request;

			//$this->ItemAgeAnalysisReport($request,$plantCd,$plantNm,$asonDate,$range_one,$range_two,$range_three,$range_four,$range_five);

			/* --------- ITEM AGE ANALYSIS (PREAPRE ITEM AGE TRAN DATA)--------- */

			if($plantCode){

				DB::table("ITEM_AGE_TRAN")->where('COMP_CODE',$mCompCode)->where('PLANT_CODE',$plantCode)->delete();
			}else{
				DB::table("ITEM_AGE_TRAN")->where('COMP_CODE',$mCompCode)->delete();
			}

			$strWhere='';

			if($plantCode !=''){
				$strWhere .= "AND PLANT_CODE='$plantCode'";
			}

			$itemBalData = DB::select("SELECT T.ITEM_CODE, T.OPQTY + T.QTYRECD - T.QTYISSUED AS CLQTY FROM 
				(
				     SELECT ITEM_CODE, SUM(A.OPQTY) AS OPQTY, SUM(A.QTYRECD) AS QTYRECD, SUM(A.QTYISSUED) AS  QTYISSUED FROM 
				     (    
				         #Bring year opening balance
				          SELECT ITEM_CODE, YROPQTY AS OPQTY, 0 AS QTYRECD, 0 AS QTYISSUED FROM MASTER_ITEMBAL WHERE COMP_CODE='$mCompCode' $strWhere AND FY_CODE='$macc_year' 
				           UNION ALL
				          #Bring transactions during year
				          SELECT ITEM_CODE, QTYRECD-QTYISSUED AS OPQTY, 0 AS QTYRECD, 0 AS QTYISSUED FROM ITEM_LEDGER WHERE 1=1 AND VRDATE BETWEEN '$YrBegDate' AND '$toDayDate' AND COMP_CODE='$mCompCode' $strWhere
				     ) A GROUP BY A.ITEM_CODE ORDER BY A.ITEM_CODE
				) T WHERE T.OPQTY + T.QTYRECD - T.QTYISSUED > 0 ORDER BY T.ITEM_CODE");
		
			for($j=0;$j<count($itemBalData);$j++){

				$itemCode = $itemBalData[$j]->ITEM_CODE;
				$mStock   = $itemBalData[$j]->CLQTY;
				//DB::enableQueryLog();
				$itemLegd  = DB::select("SELECT ITEM_CODE,CONCAT(SERIES_CODE,'/',FY_CODE,'/',VRNO) AS VRNO,VRDATE,QTYRECD,PARTICULAR FROM ITEM_LEDGER WHERE COMP_CODE='$mCompCode' AND IF('$plantCode'!='',PLANT_CODE='$plantCode',1=1) AND ITEM_CODE='$itemCode' AND VRDATE BETWEEN '$YrBegDate' AND '$toDayDate' AND QTYRECD>0 ORDER BY VRDATE DESC");
				//dd(DB::getQueryLog());
				for($i=0;$i<count($itemLegd);$i++){

					$now = strtotime($toDayDate); // or your date as well
					$your_date = strtotime($itemLegd[$i]->VRDATE);
					$datediff = $now - $your_date;

					$mDays = round($datediff / (60 * 60 * 24));

					$slno = $i + 1;

					$recdQty = $itemLegd[$i]->QTYRECD;

					if($mStock >= $recdQty){

						
						$data = array(

							'QTYRECD'    =>$recdQty,
							'CL_QTY'     =>$mStock,
							'PBILL_DATE' =>$itemLegd[$i]->VRDATE,
							'PBILL_NO'   =>$itemLegd[$i]->VRNO,
							'COMP_CODE'  =>$mCompCode,
							'COMP_NAME'  =>$mCompName,
							'PLANT_CODE' =>$plantCode,
							'PLANT_NAME' =>$plantName,
							'ITEM_CODE'  =>$itemCode,
							'PARTICULAR' =>$itemLegd[$i]->PARTICULAR,
							'BATCH_NO'   =>$slno,
							'TO_DATE'    =>$toDayDate,
							'RANGE_01'   =>($mDays<=$range_one) ? ($recdQty) : (0), 
							'RANGE_02'   =>($mDays > $range_one  && $mDays<=$range_two) ? ($recdQty) : (0), 
							'RANGE_03'   =>($mDays > $range_two  && $mDays<=$range_three) ? ($recdQty) : (0), 
							'RANGE_04'   =>($mDays > $range_three  && $mDays<=$range_four) ? ($recdQty) : (0),
							'RANGE_05'   =>($mDays > $range_four) ? ($recdQty) : (0), 
						);
						//echo "<PRE>";
						//print_r($data);

						
						DB::table('ITEM_AGE_TRAN')->insert($data);

						$mStock = $mStock - $recdQty;

						if($mStock <= 0){
							break;
						}

					}else{
						$data = array(
							'CL_QTY'     =>$mStock,
							'QTYRECD'    =>$mStock,
							'PBILL_DATE' =>$itemLegd[$i]->VRDATE,
							'PBILL_NO'   =>$itemLegd[$i]->VRNO,
							'COMP_CODE'  =>$mCompCode,
							'COMP_NAME'  =>$mCompName,
							'PLANT_CODE' =>$plantCode,
							'PLANT_NAME' =>$plantName,
							'ITEM_CODE'  =>$itemCode,
							'PARTICULAR' =>$itemLegd[$i]->PARTICULAR,
							'BATCH_NO'   =>$slno,
							'TO_DATE'    =>$toDayDate,
							'RANGE_01'   =>($mDays<=$range_one) ? ($mStock) : (0), 
							'RANGE_02'   =>($mDays >$range_one  && $mDays<=$range_two) ? ($mStock) : (0),
							'RANGE_03'   =>($mDays >$range_two  && $mDays<=$range_three) ? ($mStock) : (0),
							'RANGE_04'   =>($mDays >$range_three  && $mDays<=$range_four) ? ($mStock) : (0), 
							'RANGE_05'   =>($mDays > $range_four) ? ($mStock) : (0),
						);

						DB::table('ITEM_AGE_TRAN')->insert($data);

						$mStock = $mStock - $mStock;

						break;
					}

				}
				print_r('exit loop');
			
				if($mStock > 0){

					$slno = $slno + 1;

					$now       = strtotime($toDayDate); // or your date as well
					$your_date = strtotime($YrBegDate);
					$datediff  = $now - $your_date;
					$mDays     = round($datediff / (60 * 60 * 24));

					$data = array(
						'CL_QTY'     =>$mStock,
						'QTYRECD'    =>$mStock,
						'PBILL_DATE' =>$YrBegDate,
						'PBILL_NO'   =>'Opening Stock',
						'COMP_CODE'  =>$mCompCode,
						'COMP_NAME'  =>$mCompName,
						'PLANT_CODE' =>$plantCode,
						'PLANT_NAME' =>$plantName,
						'ITEM_CODE'  =>$itemCode,
						'PARTICULAR' =>'',
						'BATCH_NO'   =>$slno,
						'TO_DATE'    =>$toDayDate,
						'RANGE_01'   =>($mDays<=$range_one) ? ($mStock) : (0), 
						'RANGE_02'   =>($mDays >=31  && $mDays<=$range_two) ? ($mStock) : (0), 
						'RANGE_03'   =>($mDays >=61  && $mDays<=$range_three) ? ($mStock) : (0), 
						'RANGE_04'   =>($mDays >=91  && $mDays<=$range_four) ? ($mStock) : (0),
						'RANGE_05'   =>($mDays > $range_five) ? ($mStock) : (0),
					);

					DB::table('ITEM_AGE_TRAN')->insert($data);
				}

				//DB::commit();
			}/* /. item balance*/

			/* --------- ITEM AGE ANALYSIS (PREAPRE ITEM AGE TRAN DATA)--------- */

			DB::commit();

			$request->session()->flash('alert-success', 'Item Type Was Successfully Added...!');
			return redirect('/report/stock-inventory/process-item-age');

		} catch (\Exception $e) {
		    DB::rollBack();
		    //throw $e;
		    $request->session()->flash('alert-error', 'Item Type Can Not Added...!');
			return redirect('/report/stock-inventory/process-item-age');
		}

	}

	/* --------- REPORT ITEM AGE ANALISYS --------- */
	
	public function ItemAgeAnalysisReport($request,$plant_code,$plant_name,$asOnDate,$range_one,$range_two,$range_three,$range_four,$range_five){

		$yrBegDt  	= session()->get('yrbgdate');
		$macc_year  = $request->session()->get('macc_year');
		$compDetail = $request->session()->get('company_name');
		$splitData  = explode('-', $compDetail);
		$mCompCode  = $splitData[0];
		$mCompName  = $splitData[1];
		$plantCode  = $plant_code;
		$plantName  = $plant_name;		
		$YrBegDate  = date("Y-m-d", strtotime($yrBegDt));
		$toDayDate  = $asOnDate;

		if($plantCode){

			DB::table("ITEM_AGE_TRAN")->where('COMP_CODE',$mCompCode)->where('PLANT_CODE',$plantCode)->delete();
		}else{
			DB::table("ITEM_AGE_TRAN")->where('COMP_CODE',$mCompCode)->delete();
		}

		$strWhere='';

		if($plantCode !=''){
			$strWhere .= "AND PLANT_CODE='$plantCode'";
		}

		//$itemBalData = DB::select("SELECT ITEM_CODE,YROPQTY+YRQTRECD-YRQTYISSUED AS CLQTY FROM MASTER_ITEMBAL WHERE YROPQTY+YRQTRECD-YRQTYISSUED >0");
		
		$itemBalData = DB::select("SELECT T.ITEM_CODE, T.OPQTY + T.QTYRECD - T.QTYISSUED AS CLQTY FROM 
				(
				     SELECT ITEM_CODE, SUM(A.OPQTY) AS OPQTY, SUM(A.QTYRECD) AS QTYRECD, SUM(A.QTYISSUED) AS  QTYISSUED FROM 
				     (    
				         #Bring year opening balance
				          SELECT ITEM_CODE, YROPQTY AS OPQTY, 0 AS QTYRECD, 0 AS QTYISSUED FROM MASTER_ITEMBAL WHERE COMP_CODE='$mCompCode' $strWhere AND FY_CODE='$macc_year' 
				           UNION ALL
				          #Bring transactions during year
				          SELECT ITEM_CODE, QTYRECD-QTYISSUED AS OPQTY, 0 AS QTYRECD, 0 AS QTYISSUED FROM ITEM_LEDGER WHERE 1=1 AND VRDATE BETWEEN '$YrBegDate' AND '$toDayDate' AND COMP_CODE='$mCompCode' $strWhere
				     ) A GROUP BY A.ITEM_CODE ORDER BY A.ITEM_CODE
				) T WHERE T.OPQTY + T.QTYRECD - T.QTYISSUED > 0 ORDER BY T.ITEM_CODE");
		
		for($j=0;$j<count($itemBalData);$j++){

			$itemCode = $itemBalData[$j]->ITEM_CODE;
			$mStock   = $itemBalData[$j]->CLQTY;
			//DB::enableQueryLog();
			$itemLegd  = DB::select("SELECT ITEM_CODE,CONCAT(SERIES_CODE,'/',FY_CODE,'/',VRNO) AS VRNO,VRDATE,QTYRECD,PARTICULAR FROM ITEM_LEDGER WHERE COMP_CODE='$mCompCode' AND IF('$plantCode'!='',PLANT_CODE='$plantCode',1=1) AND ITEM_CODE='$itemCode' AND VRDATE BETWEEN '$YrBegDate' AND '$toDayDate' AND QTYRECD>0 ORDER BY VRDATE DESC");
			//dd(DB::getQueryLog());
			for($i=0;$i<count($itemLegd);$i++){

				$now = strtotime($toDayDate); // or your date as well
				$your_date = strtotime($itemLegd[$i]->VRDATE);
				$datediff = $now - $your_date;

				$mDays = round($datediff / (60 * 60 * 24));

				$slno = $i + 1;

				$recdQty = $itemLegd[$i]->QTYRECD;

				if($mStock >= $recdQty){

					
					$data = array(

						'QTYRECD'    =>$recdQty,
						'CL_QTY'     =>$mStock,
						'PBILL_DATE' =>$itemLegd[$i]->VRDATE,
						'PBILL_NO'   =>$itemLegd[$i]->VRNO,
						'COMP_CODE'  =>$mCompCode,
						'COMP_NAME'  =>$mCompName,
						'PLANT_CODE' =>$plantCode,
						'PLANT_NAME' =>$plantName,
						'ITEM_CODE'  =>$itemCode,
						'PARTICULAR' =>$itemLegd[$i]->PARTICULAR,
						'BATCH_NO'   =>$slno,
						'TO_DATE'    =>$toDayDate,
						'RANGE_01'   =>($mDays<=$range_one) ? ($recdQty) : (0), 
						'RANGE_02'   =>($mDays > $range_one  && $mDays<=$range_two) ? ($recdQty) : (0), 
						'RANGE_03'   =>($mDays > $range_two  && $mDays<=$range_three) ? ($recdQty) : (0), 
						'RANGE_04'   =>($mDays > $range_three  && $mDays<=$range_four) ? ($recdQty) : (0),
						'RANGE_05'   =>($mDays > $range_four) ? ($recdQty) : (0), 
					);
					//echo "<PRE>";
					//print_r($data);

					
					DB::table('ITEM_AGE_TRAN')->insert($data);

					$mStock = $mStock - $recdQty;

					if($mStock <= 0){
						exit();
					}
				}else{
					$data = array(
						'CL_QTY'     =>$mStock,
						'QTYRECD'    =>$mStock,
						'PBILL_DATE' =>$itemLegd[$i]->VRDATE,
						'PBILL_NO'   =>$itemLegd[$i]->VRNO,
						'COMP_CODE'  =>$mCompCode,
						'COMP_NAME'  =>$mCompName,
						'PLANT_CODE' =>$plantCode,
						'PLANT_NAME' =>$plantName,
						'ITEM_CODE'  =>$itemCode,
						'PARTICULAR' =>$itemLegd[$i]->PARTICULAR,
						'BATCH_NO'   =>$slno,
						'TO_DATE'    =>$toDayDate,
						'RANGE_01'   =>($mDays<=$range_one) ? ($mStock) : (0), 
						'RANGE_02'   =>($mDays >$range_one  && $mDays<=$range_two) ? ($mStock) : (0),
						'RANGE_03'   =>($mDays >$range_two  && $mDays<=$range_three) ? ($mStock) : (0),
						'RANGE_04'   =>($mDays >$range_three  && $mDays<=$range_four) ? ($mStock) : (0), 
						'RANGE_05'   =>($mDays > $range_four) ? ($mStock) : (0),
					);

					DB::table('ITEM_AGE_TRAN')->insert($data);

					$mStock = $mStock - $mStock;

					exit();
				}



			}


			if($mStock > 0){

				$slno = $slno + 1;

				$now       = strtotime($toDayDate); // or your date as well
				$your_date = strtotime($YrBegDate);
				$datediff  = $now - $your_date;
				$mDays     = round($datediff / (60 * 60 * 24));

				$data = array(
					'CL_QTY'     =>$mStock,
					'QTYRECD'    =>$mStock,
					'PBILL_DATE' =>$YrBegDate,
					'PBILL_NO'   =>'Opening Stock',
					'COMP_CODE'  =>$mCompCode,
					'COMP_NAME'  =>$mCompName,
					'PLANT_CODE' =>$plantCode,
					'PLANT_NAME' =>$plantName,
					'ITEM_CODE'  =>$itemCode,
					'PARTICULAR' =>'',
					'BATCH_NO'   =>$slno,
					'TO_DATE'    =>$toDayDate,
					'RANGE_01'   =>($mDays<=$range_one) ? ($mStock) : (0), 
					'RANGE_02'   =>($mDays >=31  && $mDays<=$range_two) ? ($mStock) : (0), 
					'RANGE_03'   =>($mDays >=61  && $mDays<=$range_three) ? ($mStock) : (0), 
					'RANGE_04'   =>($mDays >=91  && $mDays<=$range_four) ? ($mStock) : (0),
					'RANGE_05'   =>($mDays > $range_five) ? ($mStock) : (0),
				);

				DB::table('ITEM_AGE_TRAN')->insert($data);
			}

			//DB::commit();
		}/* /. item balance*/
		

	}/* /. main function*/

/* --------- REPORT ITEM AGE ANALISYS --------- */

/*---------- REPORT STOCK AGE ANALISYS REPORT --------- */
	
	public function stockAgeAnalysis(Request $request){

		$title        = 'Stock Age Analysis';

		$comp_nameval = $request->session()->get('company_name');
		
		$fisYear      =  $request->session()->get('macc_year');
		$splitYR      = explode('-', $fisYear);
		$startYEar    = $splitYR[0].'-04-01';

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];
    	
		//DB::enableQueryLog();

		$data['itemTypeList'] = DB::table('MASTER_ITEMTYPE')->get();
		$data['plant_list'] = DB::table('ITEM_AGE_PARA')->where('COMP_CODE',$getcom_code)->get();

		//$data['age_analysis'] = DB::select("SELECT SERIES_CODE,FY_CODE,ITEM_CODE,ITEM_NAME, VRNO, VRDATE, QTYRECD, DATEDIFF(CURDATE(), VRDATE) AS DAYS,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, QTYRECD, 0) AS ZEROTOTHRTEE,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, QTYRECD, 0) AS THARTIONETOSIXTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, QTYRECD, 0) AS SIXTYONETONINTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, QTYRECD, 0) AS NINTYONETOONEEAIGHTY,IF(DATEDIFF(CURDATE(), VRDATE) > 180, QTYRECD, 0) AS ONEEAIGHTYTOABOVE FROM ITEM_LEDGER WHERE QTYRECD>0 GROUP BY ITEM_CODE ORDER BY DAYS DESC");

		$data['age_analysis'] = DB::select("SELECT *,(SELECT ITEM_NAME FROM MASTER_ITEM WHERE ITEM_CODE=ITEM_AGE_TRAN.ITEM_CODE) AS ITEM_NAME FROM ITEM_AGE_TRAN");

	   //dd(DB::getQueryLog());

		return view('admin.finance.report.stock.stock-age-analysis',$data+compact('title'));


  	}

  	public function getItemAgeParameter(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$CompanyCode = $request->session()->get('company_name');
			$compcode    = explode('-', $CompanyCode);
			$getcompcode = $compcode[0];
			$macc_year   = $request->session()->get('macc_year');

			$plant_Cd    = $request->input('plantCd');

			if($plant_Cd == ''){
				$ageAnalysisHead = DB::select("SELECT * FROM ITEM_AGE_PARA WHERE COMP_CODE='$getcompcode' AND PLANT_CODE IS NULL ");
			}else{
				$ageAnalysisHead = DB::select("SELECT * FROM ITEM_AGE_PARA WHERE COMP_CODE='$getcompcode' AND PLANT_CODE='$plant_Cd' ");
			}

			if($ageAnalysisHead !='') {

				$response_array['response']         = 'success';
				$response_array['data_agaAnalysis'] = $ageAnalysisHead;
				echo $data = json_encode($response_array);

			}else{

				$response_array['response']         = 'error';
				$response_array['data_agaAnalysis'] = '' ;
				$data = json_encode($response_array);
				print_r($data);
		
			}

		}else{

				$response_array['response']         = 'error';
				$response_array['data_agaAnalysis'] = '' ;
				$data = json_encode($response_array);
				print_r($data);
		}

	}

  	public function getItemTypeWiseAgeAnalysisData(Request $request){

		$compName = $request->session()->get('company_name');

	       if ($request->itemType!='') {

				$itemType    = $request->itemType;
				$plantcode    = $request->plantcode;

				$userid      = $request->session()->get('userid');

				$userType    = $request->session()->get('usertype');

				$compName    = $request->session()->get('company_name');

				$compcode    = explode('-', $compName);

				$getcompcode =	$compcode[0];

				$fisYear     =  $request->session()->get('macc_year');

				$strWhere = '';

				if($plantcode !=''){
					$strWhere .= "AND t.PLANT_CODE='$plantcode'";
				}

				if($itemType !=''){
					$strWhere .= "AND m.ITEMTYPE_CODE='$itemType'";
				}

		        //$data1 = DB::select("SELECT L.SERIES_CODE,L.FY_CODE,L.ITEM_CODE,L.ITEM_NAME, L.VRNO, L.VRDATE, L.QTYRECD,DATEDIFF(CURDATE(), L.VRDATE) AS DAYS,IF(DATEDIFF(CURDATE(), L.VRDATE) BETWEEN 0 AND 30, L.QTYRECD, 0) AS ZEROTOTHRTEE,IF(DATEDIFF(CURDATE(), L.VRDATE) BETWEEN 31 AND 60, L.QTYRECD, 0) AS THARTIONETOSIXTY,IF(DATEDIFF(CURDATE(), L.VRDATE) BETWEEN 61 AND 90, L.QTYRECD, 0) AS SIXTYONETONINTY,IF(DATEDIFF(CURDATE(), L.VRDATE) BETWEEN 91 AND 180, L.QTYRECD, 0) AS NINTYONETOONEEAIGHTY,IF(DATEDIFF(CURDATE(), L.VRDATE) > 180, L.QTYRECD, 0) AS ONEEAIGHTYTOABOVE FROM ITEM_LEDGER L INNER JOIN MASTER_ITEM I ON L.ITEM_CODE = I.ITEM_CODE INNER JOIN MASTER_ITEMTYPE T ON I.ITEMTYPE_CODE = T.ITEMTYPE_CODE WHERE T.ITEMTYPE_CODE='$itemType' AND L.QTYRECD>0 GROUP BY L.ITEM_CODE ORDER BY DAYS DESC");
		        //DB::enableQueryLog();
		        $data = DB::select("SELECT t.*, m.ITEM_NAME FROM ITEM_AGE_TRAN t,MASTER_ITEM m WHERE t.ITEM_CODE=m.ITEM_CODE $strWhere");
		       	//dd(DB::getQueryLog());
		    	return DataTables()->of($data)->addIndexColumn()->make(true);

	    	}else{

	    		//$data = DB::select("SELECT SERIES_CODE,FY_CODE,ITEM_CODE,ITEM_NAME, VRNO, VRDATE, QTYRECD, DATEDIFF(CURDATE(), VRDATE) AS DAYS,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, QTYRECD, 0) AS ZEROTOTHRTEE,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, QTYRECD, 0) AS THARTIONETOSIXTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, QTYRECD, 0) AS SIXTYONETONINTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, QTYRECD, 0) AS NINTYONETOONEEAIGHTY,IF(DATEDIFF(CURDATE(), VRDATE) > 180, QTYRECD, 0) AS ONEEAIGHTYTOABOVE FROM ITEM_LEDGER WHERE QTYRECD>0 GROUP BY ITEM_CODE ORDER BY DAYS DESC");

	    		$data =array();

	    		return DataTables()->of($data)->addIndexColumn()->make(true);

	    	}
	  

	    if(isset($compName)){
	       return redirect('/Dashboard/Age-Analysis');
	    }else{
			return redirect('/useractivity');
		}

	}

	public function StockAgeBarGraph(Request $request){

		$itemCode  = $request->input('item_code');

		$response_array = array();

		if ($itemCode!='') {

			//$getData = DB::select("SELECT SERIES_CODE,FY_CODE,ITEM_CODE,ITEM_NAME, VRNO, VRDATE, QTYRECD, DATEDIFF(CURDATE(), VRDATE) AS DAYS,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 0 AND 30, QTYRECD, 0) AS ZEROTOTHRTEE,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 31 AND 60, QTYRECD, 0) AS THARTIONETOSIXTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 61 AND 90, QTYRECD, 0) AS SIXTYONETONINTY,IF(DATEDIFF(CURDATE(), VRDATE) BETWEEN 91 AND 180, QTYRECD, 0) AS NINTYONETOONEEAIGHTY,IF(DATEDIFF(CURDATE(), VRDATE) > 180, QTYRECD, 0) AS ONEEAIGHTYTOABOVE FROM ITEM_LEDGER WHERE ITEM_CODE='$itemCode' AND QTYRECD>0 GROUP BY ITEM_CODE ORDER BY DAYS DESC");

			$getData = DB::select("SELECT *,(SELECT ITEM_NAME FROM MASTER_ITEM WHERE ITEM_CODE=ITEM_AGE_TRAN.ITEM_CODE) AS ITEM_NAME FROM ITEM_AGE_TRAN WHERE ITEM_CODE='$itemCode'");

			if ($getData){ 

				$response_array['response']		= 'Success';
				$response_array['age_analysis'] = $getData;
				$data = json_encode($response_array);  
				print_r($data);

			}else{

				$response_array['response'] = 'Error';
				$response_array['age_analysis'] = array();
				$data = json_encode($response_array);  
				print_r($data);

			}
			

		}else{
			$data10 = array();
			$response_array['response'] = 'Error';
			$data = json_encode($response_array);  
			print_r($data);

		}

		

	}

/*---------- REPORT STOCK AGE ANALISYS REPORT --------- */


/* ---------- START : AJAX FUNCTION ---------- */
	
	public function GetItemAgeParaOfComp(Request $request){

    	if ($request->ajax()) {

			$plantCode   = $request->plantCd;
			$CompanyCode = $request->session()->get('company_name');
			$compcode    = explode('-', $CompanyCode);
			$getcompcode = $compcode[0];
			$macc_year   = $request->session()->get('macc_year');

			if($plantCode){
				$itemAgePara = DB::table('ITEM_AGE_PARA')->where('COMP_CODE',$getcompcode)->where('PLANT_CODE',$plantCode)->get()->toArray();
			}else{
				$itemAgePara = DB::table('ITEM_AGE_PARA')->where('COMP_CODE',$getcompcode)->whereNull('PLANT_CODE')->get()->toArray();
			}

            if ($itemAgePara) {

				$response_array['response']         = 'success';
				$response_array['data_itemAgePara'] = $itemAgePara;
            	$data = json_encode($response_array);
            	print_r($data);

			}else{

				$response_array['response']         = 'error';
				$response_array['data_itemAgePara'] = '';
				$data = json_encode($response_array);
				print_r($data);
                
        	}

		}else{

			$response_array['response']         = 'error';
			$response_array['data_itemAgePara'] = '';
			$data = json_encode($response_array);
			print_r($data);
		}
    	
    }

/* ---------- END : AJAX FUNCTION ---------- */

}

?>