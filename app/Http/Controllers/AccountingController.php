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

class AccountingController extends Controller{

	public function __construct(){
	
	}

/* ____________________________*/
	
	// POSTING INFORMATION FUNCTION

/* ____________________________*/

/* --------- START : INSERT IN GL TRANSACTION -------- */

	public function GlTEntry($compCode,$fyCode,$tranCode,$seriesCode,$vrno,$slno,$vrDate,$pfctCode,$glCode,$glName,$refCode,$refName,$costCode,$costName,$srCode,$srName,$drAmt,$crAmt,$perticular,$loginUser){

		$getdata = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('GL_CODE', $glCode)->get()->first();

		if($getdata){

			$RDRAMT = $getdata->RDRAMT;
		    $RCRAMT = $getdata->RCRAMT;
		    $YROPDR = $getdata->YROPDR;
		    $YROPCR = $getdata->YROPCR;

		    $debitAmt =  floatval($drAmt) + floatval($RDRAMT);

		    $creditAmt =  floatval($crAmt) + floatval($RCRAMT);

		    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);
				  
            $dataarqty = array(
            	
				'RDRAMT'  => $debitAmt,
				'RCRAMT'  => $creditAmt,
				'RBAL'    => $RBAL,
		
            );

         	$updateData12 = DB::table('MASTER_GLBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('GL_CODE', $glCode)->update($dataarqty);

		}else{

			$rbalGl = floatval($drAmt) - floatval($crAmt);

			$dataItmBal = array(
				'COMP_CODE' => $compCode,
				'FY_CODE'   => $fyCode,
				'PFCT_CODE' => $pfctCode,
				'GL_CODE'   => $glCode,
				'RDRAMT'    => $drAmt,
				'RCRAMT'    => $crAmt,
				'RBAL'      => $rbalGl,
			);

			DB::table('MASTER_GLBAL')->insert($dataItmBal);
		}

		$gledgH = DB::select("SELECT MAX(GLTRANID) as GLTRANID FROM GL_TRAN");
		$gledgID = json_decode(json_encode($gledgH), true); 
		if(empty($gledgID[0]['GLTRANID'])){
			$gledg_Id = 1;
		}else{
			$gledg_Id = $gledgID[0]['GLTRANID']+1;
		}

		$dataGl = array(
			'GLTRANID'    =>$gledg_Id,
			'COMP_CODE'   =>$compCode,
			'FY_CODE'     =>$fyCode,
			'TRAN_CODE'   =>$tranCode,
			'SERIES_CODE' =>$seriesCode,
			'VRNO'        =>$vrno,
			'SLNO'        =>$slno,
			'VRDATE'      =>$vrDate,
			'PFCT_CODE'   =>$pfctCode,
			'GL_CODE'     =>$glCode,
			'GL_NAME'     =>$glName,
			'REF_CODE'    =>$refCode,
			'REF_NAME'    =>$refName,
			'COST_CODE'   =>$costCode,
			'COST_NAME'   =>$costName,
			'SR_NO'       =>$srCode,
			'SR_NAME'     =>$srName,
			'DRAMT'       =>$drAmt,
			'CRAMT'       =>$crAmt,
			'PARTICULAR'  =>$perticular,
			'CREATED_BY'  =>$loginUser,
		);

		DB::table('GL_TRAN')->insert($dataGl);
	}

/* --------- END : INSERT IN GL TRANSACTION -------- */

/* --------- START : INSERT IN ACC TRANSACTION -------- */
	
	public function AccountTEntry($compCode,$fyCode,$tranCode,$seriesCode,$vrNo,$slno,$vrDate,$pfctCode,$accCode,$accName,$refCode,$refName,$costCode,$costName,$srCode,$srName,$drAmt,$crAmt,$percular,$loginUser){

		$getdata = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('ACC_CODE', $accCode)->get()->first();

			if($getdata){

				$RDRAMT = $getdata->RDRAMT;
			    $RCRAMT = $getdata->RCRAMT;
			    $YROPDR = $getdata->YROPDR;
			    $YROPCR = $getdata->YROPCR;

			    $debitAmt =  floatval($drAmt) + floatval($RDRAMT);

			    $creditAmt =  floatval($crAmt) + floatval($RCRAMT);

			    $RBAL  = floatval($YROPDR - $YROPCR) + floatval($debitAmt - $creditAmt);

	            $dataarqty = array(
	            	
					'RDRAMT'  => $debitAmt,
					'RCRAMT'  => $creditAmt,
					'RBAL'    => $RBAL,
			
	            );

             	$updateData12 = DB::table('MASTER_ACCBAL')->where('COMP_CODE',$compCode)->where('FY_CODE',$fyCode)->where('ACC_CODE', $accCode)->update($dataarqty);

			}else{

				$rBal = floatval($drAmt) - floatval($crAmt);

				$dataItmBal = array(
					'COMP_CODE' => $compCode,
					'FY_CODE'   => $fyCode,
					'PFCT_CODE' => $pfctCode,
					'ACC_CODE'  => $accCode,
					'RDRAMT'    => $drAmt,
					'RCRAMT'    => $crAmt,
					'RBAL'      => $rBal
				);

				DB::table('MASTER_ACCBAL')->insert($dataItmBal);
			}

			$AcledgerH = DB::select("SELECT MAX(ACCTRANID) as ACCTRANID FROM ACC_TRAN");
			$AledgID = json_decode(json_encode($AcledgerH), true); 
			if(empty($AledgID[0]['ACCTRANID'])){
				$Aledg_Id = 1;
			}else{
				$Aledg_Id = $AledgID[0]['ACCTRANID']+1;
			}

			$dataAcc = array(
				'ACCTRANID'   =>$Aledg_Id,
				'COMP_CODE'   =>$compCode,
				'FY_CODE'     =>$fyCode,
				'TRAN_CODE'   =>$tranCode,
				'SERIES_CODE' =>$seriesCode,
				'VRNO'        =>$vrNo,
				'SLNO'        =>$slno,
				'VRDATE'      =>$vrDate,
				'PFCT_CODE'   =>$pfctCode,
				'ACC_CODE'    =>$accCode,
				'ACC_NAME'    =>$accName,
				'REF_CODE'    =>$refCode,
				'REF_NAME'    =>$refName,
				'COST_CODE'   =>$costCode,
				'COST_NAME'   =>$costName,
				'SR_NO'       =>$srCode,
				'SR_NAME'     =>$srName,
				'DRAMT'       =>$drAmt,
				'CRAMT'       =>$crAmt,
				'PARTICULAR'  =>$percular,
				'CREATED_BY'  =>$loginUser,
			);

			DB::table('ACC_TRAN')->insert($dataAcc);

	}

/* --------- END : INSERT IN ACC TRANSACTION -------- */

/* --------- START : INSERT IN STOCK LEDGER ---------- */
	
	public function InsertStockInStockLedger($com_code,$rake_no,$rake_date,$palce_date,$fy_code,$pfct_code,$pfct_name,$plant_code,$plant_name,$tran_code,$series_code,$vrno,$slno,$acc_code,$acc_name,$vrdate,$order_no,$order_date,$cp_code,$cp_name,$cp_add,$sp_code,$sp_name,$sp_add,$route_code,$route_name,$from_place,$to_place,$batch_no,$dorder_qty,$lot_no,$alias_code,$alias_name,$item_code,$item_name,$length,$width,$height,$odc,$remark,$qty,$um,$aqty,$aum,$cfactor,$invoice_no,$invoice_date,$wagon_no,$obd_no,$eway_bill_no,$eway_bill_dt,$cam_no,$vehicle_no,$trpt_code,$trpt_name,$lr_no,$lr_date,$qtyrecd,$aqtyrecd,$qtyissued,$aqtyissued,$net_qty,$loginUser){

		$item_led = array(	
			'COMP_CODE'    =>$com_code,
			'RAKE_NO'      =>$rake_no,
			'RAKE_DATE'    =>$rake_date,
			'PLACE_DATE'   =>$palce_date,
			'FY_CODE'      =>$fy_code,
			'PFCT_CODE'    =>$pfct_code,
			'PFCT_NAME'    =>$pfct_name,
			'PLANT_CODE'   =>$plant_code,
			'PLANT_NAME'   =>$plant_name,
			'TRAN_CODE'    =>$tran_code,
			'SERIES_CODE'  =>$series_code,
			'VRNO'         =>$vrno,
			'SLNO'         =>$slno,
			'ACC_CODE'     =>$acc_code,
			'ACC_NAME'     =>$acc_name,
			'VRDATE'       =>$vrdate,
			'ORDER_NO'     =>$order_no,
			'ORDER_DATE'   =>$order_date,
			'CP_CODE'      =>$cp_code,
			'CP_NAME'      =>$cp_name,
			'CP_ADD'       =>$cp_add,
			'SP_CODE'      =>$sp_code,
			'SP_NAME'      =>$sp_name,
			'SP_ADD'       =>$sp_add,
			'ROUTE_CODE'   =>$route_code,
			'ROUTE_NAME'   =>$route_name,
			'FROM_PLACE'   =>$from_place,
			'TO_PLACE'     =>$to_place,
			'BATCH_NO'     =>$batch_no,
			'DORDER_QTY'   =>$dorder_qty,
			'LOT_NO'       =>$lot_no,
			'ALIAS_CODE'   =>$alias_code,
			'ALIAS_NAME'   =>$alias_name,
			'ITEM_CODE'    =>$item_code,
			'ITEM_NAME'    =>$item_name,
			'LENGTH'       =>$length,
			'WIDTH'        =>$width,
			'HEIGHT'       =>$height,
			'ODC'          =>$odc,
			'REMARK'       =>$remark,
			'QTY'          =>$qty,
			'UM'           =>$um,
			'AQTY'         =>$aqty,
			'AUM'          =>$aum,
			'CFACTOR'      =>$cfactor,
			'INVOICE_NO'   =>$invoice_no,
			'INVOICE_DATE' =>$invoice_date,
			'WAGON_NO'     =>$wagon_no,
			'OBD_NO'       =>$obd_no,
			'EWAY_BILL_NO' =>$eway_bill_no,
			'EWAY_BILL_DT' =>$eway_bill_dt,
			'CAM_NO'       =>$cam_no,
			'VEHICLE_NO'   =>$vehicle_no,
			'TRPT_CODE'    =>$trpt_code,
			'TRPT_NAME'    =>$trpt_name,
			'LR_NO'        =>$lr_no,
			'LR_DATE'      =>$lr_date,
			'QTYRECD'      =>$qtyrecd,
			'AQTYRECD'     =>$aqty,
			'QTYISSUED'    =>$qtyissued,
			'AQTYISSUED'   =>$aqtyissued,
			'NET_WEIGHT'   =>$net_qty,
			'CREATED_BY'   =>$loginUser
    	);

    	DB::table('CFSTOCK_LEDGER')->insert($item_led);

	}



	public function UpdateStockInStockLedger($com_code,$rake_no,$rake_date,$palce_date,$fy_code,$pfct_code,$pfct_name,$plant_code,$plant_name,$tran_code,$series_code,$vrno,$slno,$acc_code,$acc_name,$vrdate,$order_no,$order_date,$cp_code,$cp_name,$cp_add,$sp_code,$sp_name,$sp_add,$route_code,$route_name,$from_place,$to_place,$batch_no,$dorder_qty,$lot_no,$alias_code,$alias_name,$item_code,$item_name,$length,$width,$height,$odc,$remark,$qty,$um,$aqty,$aum,$cfactor,$invoice_no,$invoice_date,$wagon_no,$obd_no,$eway_bill_no,$eway_bill_dt,$cam_no,$vehicle_no,$trpt_code,$trpt_name,$lr_no,$lr_date,$qtyrecd,$aqtyrecd,$qtyissued,$aqtyissued,$net_qty,$loginUser){

		$item_led = array(	
			'COMP_CODE'    =>$com_code,
			'RAKE_NO'      =>$rake_no,
			'RAKE_DATE'    =>$rake_date,
			'PLACE_DATE'   =>$palce_date,
			'FY_CODE'      =>$fy_code,
			'PFCT_CODE'    =>$pfct_code,
			'PFCT_NAME'    =>$pfct_name,
			'PLANT_CODE'   =>$plant_code,
			'PLANT_NAME'   =>$plant_name,
			'TRAN_CODE'    =>$tran_code,
			'SERIES_CODE'  =>$series_code,
			'VRNO'         =>$vrno,
			'SLNO'         =>$slno,
			'ACC_CODE'     =>$acc_code,
			'ACC_NAME'     =>$acc_name,
			'VRDATE'       =>$vrdate,
			'ORDER_NO'     =>$order_no,
			'ORDER_DATE'   =>$order_date,
			'CP_CODE'      =>$cp_code,
			'CP_NAME'      =>$cp_name,
			'CP_ADD'       =>$cp_add,
			'SP_CODE'      =>$sp_code,
			'SP_NAME'      =>$sp_name,
			'SP_ADD'       =>$sp_add,
			'ROUTE_CODE'   =>$route_code,
			'ROUTE_NAME'   =>$route_name,
			'FROM_PLACE'   =>$from_place,
			'TO_PLACE'     =>$to_place,
			'BATCH_NO'     =>$batch_no,
			'DORDER_QTY'   =>$dorder_qty,
			'LOT_NO'       =>$lot_no,
			'ALIAS_CODE'   =>$alias_code,
			'ALIAS_NAME'   =>$alias_name,
			'ITEM_CODE'    =>$item_code,
			'ITEM_NAME'    =>$item_name,
			'LENGTH'       =>$length,
			'WIDTH'        =>$width,
			'HEIGHT'       =>$height,
			'ODC'          =>$odc,
			'REMARK'       =>$remark,
			'QTY'          =>$qty,
			'UM'           =>$um,
			'AQTY'         =>$aqty,
			'AUM'          =>$aum,
			'CFACTOR'      =>$cfactor,
			'INVOICE_NO'   =>$invoice_no,
			'INVOICE_DATE' =>$invoice_date,
			'WAGON_NO'     =>$wagon_no,
			'OBD_NO'       =>$obd_no,
			'EWAY_BILL_NO' =>$eway_bill_no,
			'EWAY_BILL_DT' =>$eway_bill_dt,
			'CAM_NO'       =>$cam_no,
			'VEHICLE_NO'   =>$vehicle_no,
			'TRPT_CODE'    =>$trpt_code,
			'TRPT_NAME'    =>$trpt_name,
			'LR_NO'        =>$lr_no,
			'LR_DATE'      =>$lr_date,
			'QTYRECD'      =>$qtyrecd,
			'AQTYRECD'     =>$aqty,
			'QTYISSUED'    =>$qtyissued,
			'AQTYISSUED'   =>$aqtyissued,
			'NET_WEIGHT'   =>$net_qty,
			'LAST_UPDATE_BY'   =>$loginUser
    	);

    	DB::table('CFSTOCK_LEDGER')->where('COMP_CODE',$com_code)->where('FY_CODE',$fy_code)->where('TRAN_CODE',$tran_code)->where('SERIES_CODE',$series_code)->where('VRNO',$vrno)->where('SLNO',$slno)->update($item_led);

	}
	
/* --------- END : INSERT IN STOCK LEDGER ---------- */

/* ____________________________*/
	
	// POSTING INFORMATION FUNCTION

/* ____________________________*/

/* ------------ START : INSERT IN JV TRANSACTION ------------ */
	
	public function InsertInJournalTran($compCode,$fisYear,$pfctcode,$pfctname,$transcode,$seriescode,$seriesName,$NewVrno,$srno,$vr_date,$acc_code,$acc_name,$gl_code,$gl_Name,$particular,$dr_amount,$cr_amount,$srCode,$srName,$cost_code,$cost_name,$loginUser){

		$JVtranH = DB::select("SELECT MAX(JVID) as JVID FROM JV_TRAN");
		$headID = json_decode(json_encode($JVtranH), true); 
		if(empty($headID[0]['JVID'])){
			$head_Id = 1;
		}else{
			$head_Id = $headID[0]['JVID']+1;
		}

		$data = array(

				'JVID'        =>$head_Id,
				'COMP_CODE'   =>$compCode,
				'FY_CODE'     =>$fisYear,
				'PFCT_CODE'   =>$pfctcode,
				'PFCT_NAME'   =>$pfctname,
				'TRAN_CODE'   =>$transcode,
				'SERIES_CODE' =>$seriescode,
				'SERIES_NAME' =>$seriesName,
				'VRNO'        =>$NewVrno,
				'SLNO'        =>$srno,
				'VRDATE'      =>$vr_date,
				'ACC_CODE'    =>$acc_code,
				'ACC_NAME'    =>$acc_name,
				'GL_CODE'     =>$gl_code,
				'GL_NAME'     =>$gl_Name,
				'PARTICULAR'  =>$particular,
				'DRAMT'       =>$dr_amount,
				'CRAMT'       =>$cr_amount,
				'SR_CODE'     =>$srCode,
				'SR_NAME'     =>$srName,
				'COST_CODE'   =>$cost_code,
				'COST_NAME'   =>$cost_name,
				'CREATED_BY'  =>$loginUser,
			);
		
		DB::table('JV_TRAN')->insert($data);

	}

/* ------------ START : INSERT IN JV TRANSACTION ------------ */

/* -------------- START : AMOUNT IN WORD FUNCTION ------------- */

	public function amountInWords ($num) {

		$fAMT=$num;$WAMT=0;$FWORDS='';

    	//FWORDS Four Crores Fifty Lakhs Twenty Five Thousand Five Hundred One 

	    if($fAMT==0){
	      $FWORDS='Nil ';
	    }else{

	        $WAMT = intval($fAMT/10000000);
	        $FWORDS=$FWORDS.($WAMT>0 ? $this->AWFWORD($WAMT).($FWORDS==' One '?'Crore ':'Crores '):'');

	        $fAMT = $fAMT - $WAMT * 10000000;
	        $WAMT = intval($fAMT/100000);
	        $FWORDS=$FWORDS.($WAMT>0 ? $this->AWFWORD($WAMT).($FWORDS==' One '?'Lakh ':"Lakhs "):'');

	        $fAMT = $fAMT - $WAMT * 100000;
	        $WAMT = intval($fAMT/1000);
	        $FWORDS=$FWORDS.($WAMT>0 ? $this->AWFWORD($WAMT)."Thousand ":'');

	        $fAMT = $fAMT - $WAMT * 1000;
	        $WAMT = intval($fAMT/100);
	        $FWORDS=$FWORDS.($WAMT>0 ? $this->AWFWORD($WAMT)."Hundred ":'');

	        $fAMT = $fAMT - $WAMT*100;
	        $WAMT = intval($fAMT);
	        $FWORDS=$FWORDS.($WAMT>0 ? $this->AWFWORD($WAMT):'');

	        $fAMT = $fAMT - $WAMT*1;
	        $fAMT = $fAMT;
	        $WAMT = intval(($fAMT-intval($fAMT))*100);
	        $FWORDS=$FWORDS.($WAMT>0 ? "And Paise ".$this->AWFWORD($WAMT):'');

	    }

	    $FWORDS = $FWORDS . "Only.";
	  
	    return $FWORDS;

	}

	public function AWFWORD($WAMT){

    	$WAMT;$FDIGIT=0;$SDIGIT=0;$RWORDS='';

    	$FDIGIT = intval($WAMT/10);

    	$SDIGIT = $WAMT - $FDIGIT * 10;

      	if($FDIGIT > 1){

	        if($FDIGIT == 2){
	          $RWORDS = "Twenty ";
	        }else if($FDIGIT == 3){
	          $RWORDS ="Thirty ";
	        }else if($FDIGIT == 4){
	          $RWORDS ="Forty ";
	        }else if($FDIGIT == 5){
	          $RWORDS ="Fifty ";
	        }else if($FDIGIT == 6){
	          $RWORDS ="Sixty ";
	        }else if($FDIGIT == 7){
	          $RWORDS ="Seventy ";
	        }else if($FDIGIT == 8){
	          $RWORDS ="Eighty ";
	        }else if($FDIGIT == 9){
	          $RWORDS ="Ninety ";
	        }

      	}

      	if(($FDIGIT > 1 && $SDIGIT > 0) || ($FDIGIT == 0 && ($SDIGIT > 0 && $SDIGIT <= 9))){

        	if($SDIGIT ==1){
          		$RWORDS = $RWORDS."One ";
    		}else if($SDIGIT ==2){

          		$RWORDS = $RWORDS."Two ";

        	}else if($SDIGIT ==3){

          		$RWORDS = $RWORDS."Three ";

        	}else if($SDIGIT ==4){

          		$RWORDS = $RWORDS."Four ";

    		}else if($SDIGIT ==5){

          		$RWORDS = $RWORDS."Five ";

        	}else if($SDIGIT ==6){

	          	$RWORDS = $RWORDS."Six ";

	        }else if($SDIGIT ==7){

	          	$RWORDS = $RWORDS."Seven ";

	        }else if($SDIGIT ==8){

	          	$RWORDS = $RWORDS."Eight ";

	        }else if($SDIGIT ==9){

	          	$RWORDS = $RWORDS."Nine ";

	        }

      	}

      	if($FDIGIT == 1 && $SDIGIT ==0){
        	$RWORDS = $RWORDS."Ten ";
      	}

      	if($FDIGIT == 1 && (($SDIGIT > 0 && $SDIGIT < 9) || ($SDIGIT == 9))){

	        if($SDIGIT == 1){
	          	$RWORDS = $RWORDS."Eleven ";
	        }else if($SDIGIT == 2){
	          	$RWORDS = $RWORDS."Twelve ";
	        }else if($SDIGIT == 3){
	          	$RWORDS = $RWORDS."Thirteen ";
	        }else if($SDIGIT == 4){
	          	$RWORDS = $RWORDS."Fourteen ";
	        }else if($SDIGIT == 5){
	          	$RWORDS = $RWORDS."Fifteen ";
	        }else if($SDIGIT == 6){
	          	$RWORDS = $RWORDS."Sixteen ";
	        }else if($SDIGIT == 7){
	          	$RWORDS = $RWORDS."Seventeen ";
	        }else if($SDIGIT == 8){
	          	$RWORDS = $RWORDS."Eighteen ";
	        }else if($SDIGIT == 9){
	          	$RWORDS = $RWORDS."Nineteen ";
	        }
      	}

    	return $RWORDS;

  	}

/* ----------- END : AMOUNT IN WORD FUNCTION ---------- */

}