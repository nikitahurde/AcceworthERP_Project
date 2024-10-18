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


class CommonFunction extends Controller{

	public function __construct(){

	}

/* --------- START : GET VRNO BY SERIES IN TRANSACTION ------------*/

	public function GetVrnoBySeries(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
		$transcode   = $request->input('transcode');
		$seriesCode  = $request->input('seriesCode');
		$fycode      =  $request->session()->get('macc_year');
		$compName    = $request->session()->get('company_name');
		$compcode    = explode('-', $compName);
		$getcompcode =	$compcode[0];
		$seriesGlCode='';

		$glList = DB::select("SELECT * FROM MASTER_CONFIG WHERE TRAN_CODE='$transcode' AND SERIES_CODE='$seriesCode' AND COMP_CODE='$getcompcode'");
		//DB::enableQueryLog();
		$series_list = DB::table('MASTER_CONFIG')
				->select('MASTER_CONFIG.*', 'MASTER_GL.*')
				->leftjoin('MASTER_GL', 'MASTER_CONFIG.POST_CODE', '=', 'MASTER_GL.GL_CODE')
				->where('MASTER_CONFIG.TRAN_CODE',$transcode)
				->where('MASTER_CONFIG.SERIES_CODE',$seriesCode)
				->where('MASTER_CONFIG.COMP_CODE',$getcompcode)
				->get();

		//dd(DB::getQueryLog());

			$seriesGlCode = $series_list[0]->GL_CODE;

		$chqueNo_list = DB::table('MASTER_CHEQUEBOOK_HEAD')
				->select('MASTER_CHEQUEBOOK_HEAD.*', 'MASTER_CHEQUEBOOK_BODY.*')
				->leftjoin('MASTER_CHEQUEBOOK_BODY', 'MASTER_CHEQUEBOOK_BODY.CHQBHID', '=', 'MASTER_CHEQUEBOOK_HEAD.CHQBHID')
				->where('MASTER_CHEQUEBOOK_HEAD.SERIES_CODE',$seriesCode)
				->where('MASTER_CHEQUEBOOK_HEAD.GL_CODE',$seriesGlCode)
				->where('MASTER_CHEQUEBOOK_BODY.AMOUNT','0.00')
				->whereNull('MASTER_CHEQUEBOOK_BODY.GL_CODE')
				->where('MASTER_CHEQUEBOOK_BODY.PRINT_FLAG','0')
				->get();
			
            
            	$fetch_vrno_reocrd = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fycode)->get()->first();

            	$leafNoRecord = DB::table('MASTER_CHQLEAF_CONFIG')->where('SERIES_CODE',$seriesCode)->groupBy('CHQLEAF_NO')->get();

            	

		if($transcode == 'T0'){
			$tableName = 'DORDER_HEAD';
		}else if($transcode == 'P0'){
			$tableName = 'PENQ_HEAD';
		}else if($transcode == 'P1'){
			$tableName = 'PQTN_HEAD';
		}else if($transcode == 'P2'){
			$tableName = 'PCNTR_HEAD';
		}else if($transcode == 'P3'){
			$tableName = 'PORDER_HEAD';
		}else if($transcode == 'W1'){
			$tableName = 'PORDER_HEAD';
		}else if($transcode == 'P4'){
			$tableName = 'GRN_HEAD';
		}else if($transcode == 'P5'){
			$tableName = 'PBILL_HEAD';
		}else if($transcode == 'S8'){
			$tableName = 'SREQ_HEAD';
		}else if($transcode == 'S9'){
			$tableName = 'SREQ_HEAD';
		}else if($transcode == 'R3'){
			$tableName = 'SRET_HEAD';
		}else if($transcode == 'M1'){
			$tableName = 'BOM_HEAD';
		}else if($transcode == 'M3'){
			$tableName = 'BOM_HEAD';
		}else if($transcode == 'M2'){
			$tableName = 'PRODUCTION_HEAD';
		}else if($transcode == 'G2'){
			$tableName = 'CS_GATE_ENTRY';
	   	}else if($transcode == 'G0'){
			$tableName = 'GP_HEAD';
		}else if($transcode == 'S0'){
			$tableName = 'SENQ_HEAD';
		}else if($transcode == 'M6'){
			$tableName = 'JOBCARD_HEAD';
		}else if($transcode == 'S1'){
			$tableName = 'SQTN_HEAD';
		}else if($transcode == 'S2'){
			$tableName = 'SCNTR_HEAD';
		}else if($transcode == 'S3'){
			$tableName = 'SORDER_HEAD';
		}else if($transcode == 'S5'){
			$tableName = 'SBILL_HEAD';
		}else if($transcode == 'S4'){
			$tableName = 'SCHALLAN_HEAD';
		}else if($transcode == 'A1'){
			$tableName = 'CB_TRAN';
		}else if($transcode == 'A0'){
			$tableName = 'CB_TRAN';
		}else if($transcode == 'E3'){
			$tableName = 'MASTER_LEAVETRAN';
		}else if($transcode == 'PT'){
			$tableName = 'EMP_PAYTRAN_HEAD';
		}else if($transcode == 'A8'){
			$tableName = 'EMPPAYMENT_ADVICE_TRAN';
		}else if($transcode == 'PA'){
			$tableName = 'EMP_SCORECARD';
		}else if($transcode == 'A9'){
			$tableName = 'PAYMENT_ADVICE_TRAN';
		}else if($transcode == 'T1'){
			$tableName = 'FSO_HEAD';
		}else if($transcode == 'A2'){
			$tableName = 'JV_TRAN';
		}else if($transcode == 'T2'){
			$tableName = 'FPO_HEAD';
		}else if($transcode == 'T3'){
			$tableName = 'TRIP_HEAD';
		}else if($transcode == 'T4'){
			$tableName = 'VEHICLE_GATE_INWARD';
		}else if($transcode == 'T5'){
			$tableName = 'FLEET_TRAN';
		}else if($transcode == 'T7'){
			$tableName = 'LR_HEAD';
		}else if($transcode == 'T8'){
			$tableName = 'LR_ACK_HEAD';
	   	}else if($transcode == 'C1'){
			$tableName = 'CS_GATE_ENTRY';
	   	}else if($transcode == 'C2'){
			$tableName = 'CSVEHICLE_INWARD_HEAD';
	   	}else if($transcode == 'C3'){
			$tableName = 'BILTY_HEAD';
	   	}else if($transcode == 'C4'){
			$tableName = 'CS_OUTWARD_HEAD';
	   	}else if($transcode == 'G4'){
			$tableName = 'CFOUTWARD_TRAN';
	   	}else if($transcode == 'G3'){
			$tableName = 'CFINWARD_TRAN';
	   	}else if($transcode == 'F1'){
			$tableName = 'LOAN_TRAN';
	   	}else if($transcode == 'A6'){
			$tableName = 'PDC_CHQ_TRAN_HEAD';
	   	}else{
	   		$tableName = '';	
	    	}

	    	if($tableName){
	    		$check_vrno_found = DB::table($tableName)->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fycode)->get()->toArray();
	    	}else{
	    		$check_vrno_found ='';
	    	}
            

            if ($fetch_vrno_reocrd || $check_vrno_found || $series_list || $chqueNo_list || $leafNoRecord || $glList) {

		$response_array['response']    = 'success';
		$response_array['vrno_series'] = $fetch_vrno_reocrd;
		$response_array['vrnodata']    = $check_vrno_found;
		$response_array['data']        = $series_list;
		$response_array['chqNoList']   = $chqueNo_list;
		$response_array['leafNoList']  = $leafNoRecord;
		$response_array['glList']      = $glList;
                $data = json_encode($response_array);
                print_r($data);

            }else{

		$response_array['response']    = 'error';
		$response_array['vrno_series'] = '' ;
		$response_array['vrnodata']    = '' ;
		$response_array['data']        = '' ;
		$response_array['chqNoList']   = '' ;
		$response_array['leafNoList']   = '' ;
		$response_array['glList']   = '' ;
                $data = json_encode($response_array);
                print_r($data);
                
            }

        }else{

               $response_array['response']    = 'error';
		$response_array['vrno_series'] = '' ;
		$response_array['vrnodata']    = '' ;
		$response_array['data']        = '' ;
		$response_array['chqNoList']   = '' ;
		$response_array['leafNoList']   = '' ;
                $data = json_encode($response_array);
                print_r($data);
        }


    }

/* --------- END : GET VRNO BY SERIES IN TRANSACTION ------------*/

/* --------- START : NEW FUN FOR GET VRNO BY SERIES IN TRAN ---------- */
	
	public function GetlastnoBySeriesNew(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$transcode   = $request->input('transcode');
			$seriesCode  = $request->input('seriesCode');
			$fycode      =  $request->session()->get('macc_year');
			$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			$seriesGlCode='';

			$glList = DB::select("SELECT * FROM MASTER_CONFIG WHERE TRAN_CODE='$transcode' AND SERIES_CODE='$seriesCode' AND COMP_CODE='$getcompcode'");
			//DB::enableQueryLog();
			$series_list = DB::table('MASTER_CONFIG')
				->select('MASTER_CONFIG.*', 'MASTER_GL.*')
				->leftjoin('MASTER_GL', 'MASTER_CONFIG.POST_CODE', '=', 'MASTER_GL.GL_CODE')
				->where('MASTER_CONFIG.TRAN_CODE',$transcode)
				->where('MASTER_CONFIG.SERIES_CODE',$seriesCode)
				->where('MASTER_CONFIG.COMP_CODE',$getcompcode)
				->get();

			//dd(DB::getQueryLog());

				//print_r($series_list);exit;

			$seriesGlCode = $series_list[0]->GL_CODE;

			$chqueNo_list = DB::table('MASTER_CHEQUEBOOK_HEAD')
				->select('MASTER_CHEQUEBOOK_HEAD.*', 'MASTER_CHEQUEBOOK_BODY.*')
				->leftjoin('MASTER_CHEQUEBOOK_BODY', 'MASTER_CHEQUEBOOK_BODY.CHQBHID', '=', 'MASTER_CHEQUEBOOK_HEAD.CHQBHID')
				->where('MASTER_CHEQUEBOOK_HEAD.SERIES_CODE',$seriesCode)
				->where('MASTER_CHEQUEBOOK_HEAD.GL_CODE',$seriesGlCode)
				->where('MASTER_CHEQUEBOOK_BODY.AMOUNT','0.00')
				->whereNull('MASTER_CHEQUEBOOK_BODY.GL_CODE')
				->where('MASTER_CHEQUEBOOK_BODY.PRINT_FLAG','0')
				->get();
			
            
            $fetch_vrno_reocrd = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fycode)->get()->first();

            $leafNoRecord = DB::table('MASTER_CHQLEAF_CONFIG')->where('SERIES_CODE',$seriesCode)->groupBy('CHQLEAF_NO')->get();
            //DB::enableQueryLog();
            $getBankcodeOfseriesGl = DB::select("SELECT * FROM MASTER_HOUSEBANK WHERE GL_CODE='$seriesGlCode'");
            //dd(DB::getQueryLog());

            if ($fetch_vrno_reocrd || $series_list || $chqueNo_list || $leafNoRecord || $glList || $getBankcodeOfseriesGl) {

				$response_array['response']      = 'success';
				$response_array['vrno_series']   = $fetch_vrno_reocrd;
				$response_array['data']          = $series_list;
				$response_array['chqNoList']     = $chqueNo_list;
				$response_array['leafNoList']    = $leafNoRecord;
				$response_array['glList']        = $glList;
				$response_array['bank_seriesGl'] = $getBankcodeOfseriesGl;
                $data = json_encode($response_array);
                print_r($data);

            }else{

				$response_array['response']      = 'error';
				$response_array['vrno_series']   = '' ;
				$response_array['data']          = '' ;
				$response_array['chqNoList']     = '' ;
				$response_array['leafNoList']    = '' ;
				$response_array['glList']        = '' ;
				$response_array['bank_seriesGl'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
                
            }

        }else{

				$response_array['response']      = 'error';
				$response_array['vrno_series']   = '' ;
				$response_array['data']          = '' ;
				$response_array['chqNoList']     = '' ;
				$response_array['leafNoList']    = '' ;
				$response_array['glList']        = '' ;
				$response_array['bank_seriesGl'] = '' ;
                $data = json_encode($response_array);
                print_r($data);
        }


    }

/* --------- END : NEW FUN FOR GET VRNO BY SERIES IN TRAN ---------- */

/* ---------- START : GET VRNO IN SISTER CONCERN ------- */
	
	public function GetlastnoBySeriesInSS(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$transcode   = $request->input('transcode');
			$seriesCode  = $request->input('seriesCode');
			$fycode      =  $request->session()->get('macc_year');
			$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$request->input('accCompCd');
			$seriesGlCode='';
			//DB::enableQueryLog();
			$series_list = DB::table('MASTER_CONFIG')
				->select('MASTER_CONFIG.*', 'MASTER_GL.*')
				->leftjoin('MASTER_GL', 'MASTER_CONFIG.POST_CODE', '=', 'MASTER_GL.GL_CODE')
				->where('MASTER_CONFIG.TRAN_CODE',$transcode)
				->where('MASTER_CONFIG.SERIES_CODE',$seriesCode)
				->where('MASTER_CONFIG.COMP_CODE',$getcompcode)
				->get();
            //dd(DB::getQueryLog());
            $fetch_vrno_reocrd = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriesCode)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fycode)->get()->first();
            
            if ($fetch_vrno_reocrd || $series_list) {

				$response_array['response']    = 'success';
				$response_array['vrno_series'] = $fetch_vrno_reocrd;
				$response_array['data']        = $series_list;
                $data = json_encode($response_array);
                print_r($data);

            }else{

				$response_array['response']    = 'error';
				$response_array['vrno_series'] = '' ;
				$response_array['data']        = '' ;
                $data = json_encode($response_array);
                print_r($data);
                
            }

        }else{

                $response_array['response']    = 'error';
				$response_array['vrno_series'] = '' ;
				$response_array['data']        = '' ;
                $data = json_encode($response_array);
                print_r($data);
        }


    }

/* ---------- END : GET VRNO IN SISTER CONCERN ------- */

/* ----------------- START : GET PFCT BY PLANT -------------------- */

	public function pfct_by_plant(Request $request){

		$response_array = array();

		if ($request->ajax()) {

		$Plant_code  = $request->input('Plant_code');
		$compName    = $request->session()->get('company_name');
		$compcode    = explode('-', $compName);
		$getcompcode =	$compcode[0];
		$pfct_list   ='';
		$fromplace   ='';

	   	/*$pfct_list = DB::table('MASTER_PLANT')
			->select('MASTER_PLANT.*', 'MASTER_PFCT.*','MASTER_PLANT.CITY_NAME AS CITYNAME')
           		->leftjoin('MASTER_PFCT', 'MASTER_PLANT.PFCT_CODE', '=', 'MASTER_PFCT.PFCT_CODE')
            		->where([['MASTER_PLANT.PLANT_CODE','=',$Plant_code]])
            		->get();*/
            	//DB::enableQueryLog();	
            	 $pfct_list = DB::select("SELECT A.*,B.PFCT_NAME,A.CITY_NAME AS CITYNAME FROM MASTER_PLANT A,MASTER_PFCT B WHERE A.PFCT_CODE=B.PFCT_CODE AND A.COMP_CODE=B.COMP_CODE AND A.PLANT_CODE='$Plant_code' AND A.COMP_CODE='$getcompcode'");
            	//dd(DB::getQueryLog());
            	//DB::enableQueryLog();

            	$plantName =  DB::table('MASTER_PLANT')->where('COMP_CODE',$getcompcode)->where('PLANT_CODE',$Plant_code)->get()->first();
            	//dd(DB::getQueryLog());

            	if($plantName){
            		$plantCityName = json_decode(json_encode($plantName),true);
            		$fromplace =  $plantCityName['CITY_NAME'];
            	}else{
            		$fromplace ='';
            	}	


            	$from_place =  DB::table('MASTER_FREIGHT_ROUTE')->where('FROM_PLACE',$fromplace)->get()->first();

    		if($pfct_list || $fromplace) {

    	            $response_array['response'] = 'success';
	            $response_array['data'] = $pfct_list;
	            $response_array['data_trip'] = $from_place;
	            $response_array['data_plant'] = $fromplace;

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

/* ----------------- END : GET PFCT BY PLANT -------------------- */

/* ----------------- START : GET PLANT BY COMPANY -------------------- */

	public function GetPlantByComp(Request $request){

		$response_array = array();

		if ($request->ajax()) {

		    	$comp_code = $request->input('comp_code');

	   		$plant_list = DB::table('MASTER_PLANT')->where('COMP_CODE',$comp_code)->get();
	   		$pfct_list = DB::table('MASTER_PFCT')->where('COMP_CODE',$comp_code)->get();

	    		if ($plant_list || $pfct_list) {

				$response_array['response'] = 'success';
				$response_array['data']     = $plant_list;
				$response_array['pfctdata'] = $pfct_list;

		           	echo $data = json_encode($response_array);

			}else{

				$response_array['response'] = 'error';
				$response_array['data']     = '' ;
				$response_array['pfctdata'] = '' ;
	                	$data = json_encode($response_array);

	       			 print_r($data);
					
			}

	    	}else{

			$response_array['response'] = 'error';
			$response_array['data'] = '' ;
			$response_array['pfctdata'] = '' ;

	                $data = json_encode($response_array);

	                print_r($data);
	    	}

    	}

/* ----------------- END : GET PLANT BY COMPANY-------------------- */

/* ---------- START :GET TDS RATE BY ACC AND TDS CODE ------------- */
	
	public function TdsRateCalculate(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$tdsCode = $request->input('tdsCode');
	    	$acCode = $request->input('acCode');
	    	//DB::enableQueryLog();
	    	$cal_tds_rate1 = DB::table('MASTER_TDS_RATE')->where('TDS_CODE',$tdsCode)->where('ACC_CODE',$acCode)->get()->toArray();
	    	//dd(DB::getQueryLog());
	    	$tds_code_name = DB::table('MASTER_TDS')->where('TDS_CODE', $tdsCode)->get()->toArray();;

	    	if($cal_tds_rate1){
	    			$cal_tds_rate = $cal_tds_rate1;
	    	}else{
	    			$cal_tds_rate =  DB::table('MASTER_TDS_RATE')->where('TDS_CODE',$tdsCode)->whereNull('ACC_CODE')->get()->toArray();
	    	}

    		if ($cal_tds_rate && $tds_code_name) {
    			//echo "<PRE>";
	    	//print_r($fetch_tds_rate);
	    	//echo "</PRE>";
    			$response_array['response'] = 'success';
	            $response_array['data'] = $cal_tds_rate;
	            $response_array['tds_name'] = $tds_code_name;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;
                $response_array['tds_name'] = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '';
                $response_array['tds_name'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

 	}

/* ---------- END :GET TDS RATE BY ACC AND TDS CODE ------------- */


public function GetVrnoBySeriesCRM(Request $request){

    	$response_array = array();

        if ($request->ajax()) {
			
			$transcode   = $request->input('transcode');
			$seriesCode  = $request->input('seriesCode');
			$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			$fisYear     =  $request->session()->get('macc_year');

			$series_list = DB::table('MASTER_CONFIG')
				->select('MASTER_CONFIG.*', 'MASTER_GL.*')
           		->leftjoin('MASTER_GL', 'MASTER_CONFIG.POST_CODE', '=', 'MASTER_GL.GL_CODE')
            	->where('MASTER_CONFIG.SERIES_CODE',$seriesCode)
            	->get();
            
            $fetch_vrno_reocrd = DB::table('MASTER_VRSEQ')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriesCode)->get()->first();

            if($transcode == 'T0'){
            	$tableName = 'PINDENT_HEAD';
            }else if($transcode == 'P0'){
            	$tableName = 'PENQ_HEAD';
            }else if($transcode == 'P1'){
            	$tableName = 'PQTN_HEAD';
            }else if($transcode == 'P2'){
            	$tableName = 'PCNTR_HEAD';
            }else if($transcode == 'P3'){
            	$tableName = 'PORDER_HEAD';
            }else if($transcode == 'W1'){
            	$tableName = 'PORDER_HEAD';
            }else if($transcode == 'P4'){
            	$tableName = 'GRN_HEAD';
            }else if($transcode == 'P5'){
            	$tableName = 'PBILL_HEAD';
            }else if($transcode == 'S8'){
            	$tableName = 'SREQ_HEAD';
            }else if($transcode == 'S9'){
            	$tableName = 'SREQ_HEAD';
            }else if($transcode == 'R3'){
            	$tableName = 'SRET_HEAD';
            }else if($transcode == 'M1'){
            	$tableName = 'BOM_HEAD';
            }else if($transcode == 'M3'){
            	$tableName = 'BOM_HEAD';
            }else if($transcode == 'M2'){
            	$tableName = 'PRODUCTION_HEAD';
            }else if($transcode == 'G2'){
            	$tableName = 'GRNGATE_HEAD';
            }else if($transcode == 'G0'){
            	$tableName = 'GP_HEAD';
            }else if($transcode == 'S0'){
            	$tableName = 'SENQ_HEAD';
            }

            $check_vrno_found = DB::table($tableName)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('TRAN_CODE',$transcode)->where('SERIES_CODE',$seriesCode)->get()->toArray();

            if ($fetch_vrno_reocrd || $check_vrno_found || $series_list) {

				$response_array['response']    = 'success';
				$response_array['vrno_series'] = $fetch_vrno_reocrd;
				$response_array['vrnodata']    = $check_vrno_found;
				$response_array['data'] = $series_list ;
                $data = json_encode($response_array);
                print_r($data);

            }else{

				$response_array['response'] = 'error';
				$response_array['vrno_series']     = '' ;
				$response_array['vrnodata']     = '' ;
				$response_array['data']     = '' ;

                $data = json_encode($response_array);
                print_r($data);
                
            }

        }else{

                $response_array['response'] = 'error';
                $response_array['vrno_series'] = '';
                $response_array['vrnodata'] = '';
                $response_array['data'] = '';
            //    $response_array['vrnodata'] = '';
                $data = json_encode($response_array);
                print_r($data);
        }


    }

/* -------- get pfct data by plant -------- */




/* --------- get itm data ------- */


	public function Get_Item_UM_AUM(Request $request){

		$response_array = array();

		if ($request->ajax()) {


			$itemCode    = $request->input('ItemCode');
			$accCode     = $request->input('accCode');
			$taxCode     = $request->input('taxCode');
			$plantCode   = $request->input('plantCode');
			$qcount      = $request->input('q');
			$taxType     = $request->input('taxType');
			$compName    = $request->session()->get('company_name');
			$compcode    = explode('-', $compName);
			$getcompcode =	$compcode[0];
			$fisYear     =  $request->session()->get('macc_year');



	    	$item_um_aum_list = DB::select("SELECT A.UM_CODE,A.AUM_CODE,A.AUM_FACTOR,B.HSN_CODE,C.HSN_NAME FROM MASTER_ITEMUM A,MASTER_ITEM B,MASTER_HSN C WHERE A.ITEM_CODE=B.ITEM_CODE AND B.HSN_CODE=C.HSN_CODE AND A.ITEM_CODE='$itemCode'");

	    	$fetch_hsn_code = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();

	    	//print_r($item_um_aum_list);exit;

	    	//print_r($itemCode);exit;

	    	$itmetype_gl = DB::table('MASTER_ITEMTYPE')
					->select('MASTER_ITEMTYPE.*', 'MASTER_GL.*')
	           		->leftjoin('MASTER_GL', 'MASTER_ITEMTYPE.POST_CODE', '=', 'MASTER_GL.GL_CODE')
	            	->where('MASTER_ITEMTYPE.ITEMTYPE_CODE',$fetch_hsn_code->ITEMTYPE_CODE)
	            	->get();
	       // dd(DB::getQueryLog());
	    	/*$fetch_tax_code = DB::table('MASTER_HSNRATE')->where('HSN_CODE',$fetch_hsn_code->HSN_CODE)->where('TAX_CODE',$taxCode)->get();*/

	    	if($taxCode == ''){
	    		//DB::enableQueryLog();
	    		$fetch_tax_code = DB::table('MASTER_HSNRATE')
					->select('MASTER_HSNRATE.*', 'MASTER_TAX.*')
	           		->leftjoin('MASTER_TAX', 'MASTER_HSNRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
	            	->where('MASTER_TAX.TAX_TYPE',$taxType)
	            	->where('MASTER_HSNRATE.HSN_CODE',$fetch_hsn_code->HSN_CODE)
	            	->get();
	          // dd(DB::getQueryLog());	
	    	}else{
	    		$fetch_tax_code = DB::table('MASTER_HSNRATE')->where('HSN_CODE',$fetch_hsn_code->HSN_CODE)->where('TAX_CODE',$taxCode)->get();
	    	}

	    	
			$aum_list = DB::table('MASTER_ITEMUM')
				->select('MASTER_ITEMUM.*', 'MASTER_UM.*')
           		->leftjoin('MASTER_UM', 'MASTER_ITEMUM.AUM_CODE', '=', 'MASTER_UM.UM_CODE')
            	->where('MASTER_ITEMUM.ITEM_CODE',$itemCode)
            	->where('MASTER_ITEMUM.UM_CODE',$fetch_hsn_code->UM)
            	->get();

	    	$quaPamter_get = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$fetch_hsn_code->ICATG_CODE)->get()->toArray();

	    	if($quaPamter_get){
	    		$qua_parameter_data  = $quaPamter_get;
	    	}else{
	    		$qua_parameter_data  = '';
	    	}

	    	$getstdRateByItm = DB::table('MASTER_ITEMBAL')->where('FY_CODE',$fisYear)->where('COMP_CODE',$getcompcode)->where('ITEM_CODE',$itemCode)->get()->toArray();

	    	$item_bal_data = DB::table('MASTER_ITEMBAL')->where('FY_CODE',$fisYear)->where('COMP_CODE',$getcompcode)->where('ITEM_CODE',$itemCode)->get()->first();

	    	if($item_bal_data){

				$yropqty     = $item_bal_data->YROPQTY;
				$yrQtyRecd   = $item_bal_data->YRQTRECD;
				$yrQtyIssued = $item_bal_data->YRQTYISSUED;
				$yrQtyBlock  = $item_bal_data->YRQTYBLOCK;
				$bacth_no    = $item_bal_data->BATCH_NO;
				$MAVGRATE    = $item_bal_data->MAVGRATE;
				$totalstock  = floatval($yropqty) + floatval($yrQtyRecd) - floatval($yrQtyIssued) - floatval($yrQtyBlock);
	    
	   		 }else{

				$totalstock  = '0';
				$bacth_no    =  '';
				$yropqty     = '0';
				$yrQtyRecd   = '0';
				$yrQtyIssued = '0';
				$yrQtyBlock  = '0';
				$MAVGRATE    = '0';
	  		 }

	    	/*if($fetch_hsn_code->hsn_code && $taxCode){

	    		$fetch_tax_code = DB::table('master_hsn_rate')->where('hsn_code',$fetch_hsn_code->hsn_code)->where('tax_code',$taxCode)->get();

	    	}else if($fetch_hsn_code->hsn_code && $taxCode==''){

	    		$fetch_tax_code = DB::table('master_hsn_rate')->where('hsn_code',$fetch_hsn_code->hsn_code)->get();
	    	}*/

	    	$get_taxAgainst_item = DB::select("SELECT A.TAX_CODE,B.TAX_NAME FROM `MASTER_HSNRATE` A, MASTER_TAX B WHERE A.TAX_CODE=B.TAX_CODE AND A.HSN_CODE='$fetch_hsn_code->HSN_CODE'");

    		if ($item_um_aum_list || $aum_list || $fetch_hsn_code || $qua_parameter_data || $get_taxAgainst_item) {

				$response_array['response']   = 'success';
				$response_array['data']       = $item_um_aum_list;
				$response_array['data_hsn']   = $fetch_hsn_code;
				$response_array['qcount']     = $qcount;
				$response_array['qua_pamter'] = $qua_parameter_data;
				$response_array['aumList']    = $aum_list;
				$response_array['totalstock'] = $totalstock;
				$response_array['data_tax']   = $fetch_tax_code;
				$response_array['item_code']  = $itemCode;
				$response_array['itypeGl']    = $itmetype_gl;
				$response_array['stdRate']    = $getstdRateByItm;
				$response_array['tax_list_item']    = $get_taxAgainst_item;

	           echo $data = json_encode($response_array);

	            //print_r($data);

			}else{

				$response_array['response']   = 'error';
				$response_array['data']       = '' ;
				$response_array['qua_pamter'] ='';
				$response_array['aumList']    ='';
				$response_array['data_tax']   ='';
				$response_array['itypeGl']    = '';
				$response_array['stdRate']    = '';
				$response_array['tax_list_item']    = '';

                $data = json_encode($response_array);

                print_r($data);
				
			}


	    }else{

				$response_array['response']   = 'error';
				$response_array['data']       = '' ;
				$response_array['qua_pamter'] ='';
				$response_array['aumList']    ='';
				$response_array['data_tax']   ='';
				$response_array['itypeGl']    = '';
				$response_array['stdRate']    = '';
				$response_array['tax_list_item']    = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


/* --------- get itm data ------- */

/* -------- get account details ------ */

	public function get_acccodeData(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$account_code = $request->input('accCode');

	    	//DB::enableQueryLog();

	   		$acc_data = DB::table('MASTER_ACC')
				->select('MASTER_ACC.*', 'MASTER_ACCADD.*')
           		->leftjoin('MASTER_ACCADD', 'MASTER_ACCADD.ACC_CODE', '=', 'MASTER_ACC.ACC_CODE')
           		->where('MASTER_ACC.ACC_CODE',$account_code)
           		->get()->first();

	    	//print_r($series_data);exit;
            //	dd(DB::getQueryLog());
           
    		if ($acc_data) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $acc_data;

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


     public function get_postCodeByAccJbSaleBill(Request $request){

		$response_array = array();

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		if ($request->ajax()) {

		//$vehicle_Type   = $request->input('vehicle_Type');
		$account_code   = $request->input('acc_code');
		
		$acc_data       ='';
		$fetch_tds_rate ='';
		$trip_data      ='';
		$fetch_glCode   ='';

		$acc_data = DB::table('MASTER_ACC')->where('ACC_CODE',$account_code)->get()->first();
			

		$fetch_glCode = DB::table('MASTER_GLKEY')->select('MASTER_GLKEY.*')->leftjoin('MASTER_GL', 'MASTER_GLKEY.GL_CODE', '=', 'MASTER_GL.GL_CODE')->where('MASTER_GLKEY.ATYPE_CODE',$acc_data->ATYPE_CODE)->get();

		//$sale_order = DB::table('SORDER_HEAD')->where('ACC_CODE',$account_code)->get()->toArray();
//DB::enableQueryLog();
       // DB::enableQueryLog();
		$sale_order = DB::select("SELECT T.ACC_CODE,T.ACC_NAME,T.JWITEM_CODE,T.JWITEM_NAME,H.VRNO,H.FY_CODE AS FYCODE,H.SERIES_CODE AS SERIESCODE FROM CFOUTWARD_TRAN T,SORDER_HEAD H, SORDER_BODY B WHERE B.SORDERHID=H.SORDERHID AND H.ACC_CODE=T.ACC_CODE AND B.ITEM_CODE=T.JWITEM_CODE  AND T.ACC_CODE='$account_code' AND H.COMP_CODE ='$getcom_code' GROUP BY H.VRNO");
		//dd(DB::getQueryLog());

           
    	if($acc_data || $fetch_glCode || $sale_order) {

			$response_array['response']          = 'success';
			$response_array['data']              = $acc_data;
			$response_array['multiple_data']     = $fetch_glCode;
			$response_array['data_sale']          = $sale_order;
		

	           	echo $data = json_encode($response_array);

	            //print_r($data);

		}else{

			$response_array['response']          = 'error';
			$response_array['data']              = '' ;
			$response_array['multiple_data']     = '';
			$data                            = json_encode($response_array);

	                print_r($data);
				
		}


	    }else{

    		$response_array['response']          = 'error';
		$response_array['data']              = '' ;
		$response_array['trip_data']         = '';
		$response_array['multiple_data']     = '';
		$response_array['data_tds']          = '';
		$response_array['data_vehicle_list'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


    public function get_postCodeByAccJbPurBill(Request $request){

		$response_array = array();

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		if ($request->ajax()) {

		//$vehicle_Type   = $request->input('vehicle_Type');
		$account_code   = $request->input('acc_code');
		
		$acc_data       ='';
		$fetch_tds_rate ='';
		$trip_data      ='';
		$fetch_glCode   ='';

		$acc_data = DB::table('MASTER_ACC')->where('ACC_CODE',$account_code)->get()->first();
			

		$fetch_glCode = DB::table('MASTER_GLKEY')->select('MASTER_GLKEY.*')->leftjoin('MASTER_GL', 'MASTER_GLKEY.GL_CODE', '=', 'MASTER_GL.GL_CODE')->where('MASTER_GLKEY.ATYPE_CODE',$acc_data->ATYPE_CODE)->get();

		//$sale_order = DB::table('SORDER_HEAD')->where('ACC_CODE',$account_code)->get()->toArray();

		$sale_order = DB::select("SELECT T.ACC_CODE,T.ACC_NAME,T.JWITEM_CODE,T.JWITEM_NAME,H.VRNO,H.FY_CODE AS FYCODE,H.SERIES_CODE AS SERIESCODE FROM CFOUTWARD_TRAN T,PORDER_HEAD H, PORDER_BODY B WHERE B.PORDERHID=H.PORDERHID AND H.ACC_CODE=T.ACC_CODE AND B.ITEM_CODE=T.JWITEM_CODE  AND T.ACC_CODE='$account_code' AND H.COMP_CODE ='$getcom_code' GROUP BY H.VRNO");
		

           
    	if($acc_data || $fetch_glCode || $sale_order) {

			$response_array['response']          = 'success';
			$response_array['data']              = $acc_data;
			$response_array['multiple_data']     = $fetch_glCode;
			$response_array['data_sale']          = $sale_order;
		

	           	echo $data = json_encode($response_array);

	            //print_r($data);

		}else{

			$response_array['response']          = 'error';
			$response_array['data']              = '' ;
			$response_array['multiple_data']     = '';
			$data                            = json_encode($response_array);

	                print_r($data);
				
		}


	    }else{

    		$response_array['response']          = 'error';
		$response_array['data']              = '' ;
		$response_array['trip_data']         = '';
		$response_array['multiple_data']     = '';
		$response_array['data_tds']          = '';
		$response_array['data_vehicle_list'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

    public function get_postCodeByAcc(Request $request){

		$response_array = array();

		if ($request->ajax()) {

		$vehicle_Type   = $request->input('vehicle_Type');
		$account_code   = $request->input('acc_code');
		$vehicle_list   ='';
		$acc_data       ='';
		$fetch_tds_rate ='';
		$trip_data      ='';
		$fetch_glCode   ='';

	    	if($vehicle_Type == 'SELF'){

	    		$vehicle_list = DB::table('TRIP_HEAD')->WHERE('LR_ACK_STATUS','1')->WHERE('PBILL_STATUS','0')->WHERE('OWNER','SELF')->get();

	    	}else if($vehicle_Type =='MARKET'){
	    		$vehicle_list = DB::table('TRIP_HEAD')->WHERE('LR_ACK_STATUS','1')->WHERE('PBILL_STATUS','0')->WHERE('OWNER','MARKET')->get();
	    	}else{
	    		$vehicle_list = '';
	    	}

	    	if($account_code && $vehicle_Type=='MARKET'){

	    		$acc_data = DB::table('MASTER_ACC')->where('ACC_CODE',$account_code)->get()->first();

		    	$fetch_tds_rate = DB::table('MASTER_TDS_RATE')->where('TDS_CODE',$acc_data->TDS_CODE)->get()->toArray();

		    	$trip_data = DB::table('TRIP_HEAD')->where('TRANSPORT_CODE',$account_code)->get()->first();


		    	$fetch_glCode = DB::table('MASTER_GLKEY')->select('MASTER_GLKEY.*')->leftjoin('MASTER_GL', 'MASTER_GLKEY.GL_CODE', '=', 'MASTER_GL.GL_CODE')->where('MASTER_GLKEY.ATYPE_CODE',$acc_data->ATYPE_CODE)->get();

	    	}else if($account_code && $vehicle_Type=='SELF'){
	    		$acc_data = DB::table('MASTER_ACC')->where('ACC_CODE',$account_code)->get()->first();;
			$fetch_tds_rate ='';
			$trip_data ='';
			$fetch_glCode = DB::table('MASTER_GLKEY')->select('MASTER_GLKEY.*')->leftjoin('MASTER_GL', 'MASTER_GLKEY.GL_CODE', '=', 'MASTER_GL.GL_CODE')->where('MASTER_GLKEY.ATYPE_CODE',$acc_data->ATYPE_CODE)->get();
	    	}
	    	

           
    		if ($acc_data || $fetch_glCode || $fetch_tds_rate || $vehicle_list) {

			$response_array['response']          = 'success';
			$response_array['data']              = $acc_data;
			$response_array['trip_data']         = $trip_data;
			$response_array['multiple_data']     = $fetch_glCode;
			$response_array['data_tds']          = $fetch_tds_rate;
			$response_array['data_vehicle_list'] = $vehicle_list;

	           	echo $data = json_encode($response_array);

	            //print_r($data);

		}else{

			$response_array['response']          = 'error';
			$response_array['data']              = '' ;
			$response_array['trip_data']         = '';
			$response_array['multiple_data']     = '';
			$response_array['data_tds']          = '';
			$response_array['data_vehicle_list'] = '';
			$data                            = json_encode($response_array);

	                print_r($data);
				
		}


	    }else{

    		$response_array['response']          = 'error';
		$response_array['data']              = '' ;
		$response_array['trip_data']         = '';
		$response_array['multiple_data']     = '';
		$response_array['data_tds']          = '';
		$response_array['data_vehicle_list'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }


     public function get_postCodeByAccVehicle(Request $request){

		$response_array = array();

		if ($request->ajax()) {

		$vehicle_no   = $request->input('vehicle_no');
		$vehicle_Type = $request->input('vehicle_Type');

	    	if($vehicle_no && $vehicle_Type == 'MARKET'){

	    		$acc_list = DB::table('TRIP_HEAD')->WHERE('VEHICLE_NO',$vehicle_no)->WHERE('LR_ACK_STATUS','1')->WHERE('PBILL_STATUS','0')->WHERE('OWNER','MARKET')->get()->first();

	    		$account_code = $acc_list->TRANSPORT_CODE;

	    		$acc_data = DB::table('MASTER_ACC')->where('ACC_CODE',$account_code)->get()->first();

		    	$fetch_tds_rate = DB::table('MASTER_TDS_RATE')->where('TDS_CODE',$acc_data->TDS_CODE)->get()->toArray();

		    	$trip_data = DB::table('TRIP_HEAD')->where('TRANSPORT_CODE',$account_code)->get()->first();


		    	$fetch_glCode = DB::table('MASTER_GLKEY')->select('MASTER_GLKEY.*')->leftjoin('MASTER_GL', 'MASTER_GLKEY.GL_CODE', '=', 'MASTER_GL.GL_CODE')->where('MASTER_GLKEY.ATYPE_CODE',$acc_data->ATYPE_CODE)->get();

		    	$vehicle_data='';
	    		/*$vehicle_data='';
	    		$acc_data='';
	    		$fetch_glCode='';
	    		$fetch_tds_rate=''*/;

	    		//$vehicle_data = DB::table('TRIP_HEAD')->where('VEHICLE_NO',$vehicle_no)->get()->first();

		    	//$acc_data = DB::table('MASTER_ACC')->where('ACC_CODE',$vehicle_data->TRANSPORT_CODE)->get()->first();


		    	//$fetch_glCode = DB::table('MASTER_GLKEY')->select('MASTER_GLKEY.*')->leftjoin('MASTER_GL', 'MASTER_GLKEY.GL_CODE', '=', 'MASTER_GL.GL_CODE')->where('MASTER_GLKEY.ATYPE_CODE',$acc_data->ATYPE_CODE)->get();

		    	//$fetch_tds_rate = DB::table('MASTER_TDS_RATE')->where('TDS_CODE',$acc_data->TDS_CODE)->get()->toArray();

	    	}else if($vehicle_no && $vehicle_Type == 'SELF'){

	    		$acc_list = DB::table('MASTER_ACC')->where('ATYPE_CODE','E')->get();

	    		$vehicle_data='';
	    		$acc_data='';
	    		$fetch_glCode='';
	    		$fetch_tds_rate='';

	    	}

           
    	if ($acc_data || $fetch_glCode || $fetch_tds_rate || $acc_list) {

			$response_array['response']      = 'success';
			$response_array['data']          = $acc_data;
			$response_array['multiple_data'] = $fetch_glCode;
			$response_array['acc_code']      = $vehicle_data;
			$response_array['data_tds']      = $fetch_tds_rate;
			$response_array['data_acc_list'] = $acc_list;
			$response_array['trip_data']     = $trip_data;

	           	echo $data = json_encode($response_array);

		}else{

			$response_array['response']      = 'error';
			$response_array['data']          = '';
			$response_array['multiple_data'] = '';
			$response_array['acc_code']      = '';
			$response_array['data_tds']      = '';
			$response_array['data_acc_list'] = '';
			$response_array['trip_data']     = '';
                	$data = json_encode($response_array);
                	print_r($data);
				
		}


	    }else{

			$response_array['response'] = 'error';
			$response_array['data'] = '' ;
			$response_array['multiple_data'] = '' ;
			$response_array['acc_code'] = '' ;
			$response_array['data_tds'] = '' ;
			$response_array['data_acc_list'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }

    }

/* -------- get account details ------ */

/* --------- tax rate data -------*/
	
	public function CheckTaxInTaxRate(Request $request){

		$response_array = array();

	    $taxCode = $request->input('taxCode');

		if ($request->ajax()) {

	    	$tax_code_list = DB::table('MASTER_TAXRATE')->where('TAX_CODE', $taxCode)->get();
	    	
    		if ($tax_code_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $tax_code_list ;

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

/* --------- tax rate data -------*/

/* ------- um data -------*/

	public function GetCfactorWhenChangeAum(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$itemCode = $request->input('ItemCode');
	    	$unitM = $request->input('unitM');
	    	$adunitM = $request->input('adunitM');

	    
	    	$cfactorData = DB::table('MASTER_ITEMUM')->where('ITEM_CODE', $itemCode)->where('UM_CODE',$unitM)->where('AUM_CODE',$adunitM)->get();

    		if ($cfactorData) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $cfactorData;

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

/* ------- um data -------*/


/*check hsn code for get tax code*/
public function check_hsn_for_tax(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$hsncode = $request->input('hsncode');
	    	$taxcode = $request->input('taxcode');

	    	if($hsncode && $taxcode){
	    		$fetch_tax_code = DB::table('MASTER_HSNRATE')
	    		->select('MASTER_HSNRATE.*', 'MASTER_TAX.*')
	    		->leftjoin('MASTER_TAX', 'MASTER_HSNRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
	    		->where('MASTER_HSNRATE.HSN_CODE',$hsncode)->where('MASTER_HSNRATE.TAX_CODE',$taxcode)
	    		->get();
	    	}else if($hsncode && $taxcode==''){
	    		$fetch_tax_code = DB::table('MASTER_HSNRATE')
	    		->select('MASTER_HSNRATE.*', 'MASTER_TAX.*')
	    		->leftjoin('MASTER_TAX', 'MASTER_HSNRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
	    		->where('MASTER_HSNRATE.HSN_CODE',$hsncode)->get();

	    	}

	    	

    		if ($fetch_tax_code) {

    			$response_array['response'] = 'success';
	            $response_array['data_tax'] = $fetch_tax_code;

	           echo $data = json_encode($response_array);
	            //print_r($data);
			}else{

				$response_array['response'] = 'error';
                $response_array['data_tax'] = '';

                $data = json_encode($response_array);
                print_r($data);
				
			}


	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data_tax'] = '';

                $data = json_encode($response_array);

                print_r($data);
	    }

    }
/*check hsn code for get tax code*/


/* ----- get tolerance data ------ */
	
	public function get_Tolrance_data(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$ItemCode = $request->input('ItemCode');

	    	//print_r($accCode);exit;

	    	//DB::enableQueryLog();
	   		$tolrance_data = DB::table('MASTER_ITEM')->where('ITEM_CODE',$ItemCode)->get()->first();
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

/* ----- get tolerance data ------ */


public function GetQualityParameter(Request $request){

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
        			$itemcode_get = DB::table('PINDENT_QUA')->where('PINDHID',$p_headid)->where('PINDBID',$p_bodyid)->get();
        		}

        	}else{
        		$itemcode_getdata = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemcode)->get()->first();

       			$itemcode_get = DB::table('MASTER_ICATG_QUA')->where('ICATG_CODE',$itemcode_getdata->ICATG_CODE)->get()->toArray();
        	}
       
        
           
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



    public function Get_Item_Data_Details(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$itemCode = $request->input('ItemCode');
	  
	    	
	        $item_list = DB::table('MASTER_ITEM')->where('ITEM_CODE',$itemCode)->get()->first();
	    	
	    	

    		if ($item_list) {

				$response_array['response']   = 'success';
				$response_array['data']       = $item_list;
			

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

 /* ------- GET DETAILS AGAINST CITY ------------- */  

    public function addressAgainstCity(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$city_code = $request->input('city');

          // DB::enableQueryLog();

	    	$city_list = DB::select("SELECT * FROM MASTER_CITY C, MASTER_DISTRICT D,MASTER_STATE S WHERE C.DIST_CODE=D.DISTRICT_CODE AND D.STATE_CODE=S.STATE_CODE AND C.CITY_CODE='$city_code'");
	    	// dd(DB::getQueryLog());	
	    	$count = count($city_list);

    		if ($count >=1) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $city_list ;

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

/* ------- GET DETAILS AGAINST CITY ------------- */

/* ---------- calculation tax -------------- */

	public function AfieldCalForTax(Request $request){

		$response_array = array();

		if ($request->ajax()) {

			$tax_code      = $request->input('tax_code');
			$CompanyCode   = $request->session()->get('company_name');
			$macc_year     = $request->session()->get('macc_year');
			$userid        = $request->session()->get('userid');


	    	$transcode_list = DB::table('MASTER_TAXRATE')
	            ->join('MASTER_TAXIND', 'MASTER_TAXRATE.TAXIND_CODE', '=', 'MASTER_TAXIND.TAXIND_CODE')
	            ->select('MASTER_TAXRATE.*', 'MASTER_TAXIND.TAXIND_NAME','MASTER_TAXIND.TAXIND_BLOCK')
	            ->where([['MASTER_TAXRATE.TAX_CODE','=',$tax_code]])
	            ->get();
	    	
             $ratevalue = DB::table('MASTER_RATE_VALUE')->get();

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

/* ---------- calculation tax -------------- */

/* -------- Delete Trip Transaction Data ----------- */
	
	public function DeleteTripData(Request $request){

		$fieldOne     = $request->input('fieldOne');
		$plan_status_wo_item     = $request->input('fieldFour');

		//print_r($plan_status);exit;

		$comp_nameval = $request->session()->get('company_name');
		$explode      = explode('-', $comp_nameval);
		$getcom_code  = $explode[0];

		//print_r($fieldOne);exit;

		DB::beginTransaction();

		try {

        	if ($fieldOne!='') {

				$tripBody = DB::table('TRIP_BODY')->where('TRIPHID',$fieldOne)->where('COMP_CODE',$getcom_code)->get();

				//print_r($tripBody);exit;

				if($plan_status_wo_item=='0'){



				foreach($tripBody as $row){

					if(($row->DO_NO == '') || (empty($row->DO_NO)) || $row->DO_NO=='null' || $row->DO_NO=='NULL' || $row->DO_NO==null){

						// do nothing
						//print_r('do nothing');

					}else{

						$bodyData = DB::table('TRIP_BODY')->where('COMP_CODE',$getcom_code)->where('TRIPHID',$fieldOne)->where('DO_NO',$row->DO_NO)->where('ITEM_CODE',$row->ITEM_CODE)->where('CP_CODE',$row->CP_CODE)->where('SLNO',$row->SLNO)->get()->first();

						//print_r($bodyData);exit;

						$tripQty = $bodyData->QTY;
						
						//DB::enableQueryLog();
						$orderBodyData = DB::table('DORDER_BODY')->where('COMP_CODE',$getcom_code)->where('DORDERHID',$bodyData->DOHEADID)->where('DORDERBID',$bodyData->DOBODYID)->where('DORDER_NO',$bodyData->DO_NO)->where('ITEM_CODE',$bodyData->ITEM_CODE)->where('SLNO',$bodyData->SLNO)->get()->first();
					//	dd(DB::getQueryLog());

						if($orderBodyData){

						$doDisatchQty = $orderBodyData->DISPATCH_PLAN_QTY;

								//print_r($doDisatchQty);
							//	exit();

						$newQty = $doDisatchQty - $tripQty;

						$qtyAry = array(
							'DISPATCH_PLAN_QTY' => $newQty
						);

						DB::table('DORDER_BODY')->where('COMP_CODE',$getcom_code)->where('DORDERHID',$bodyData->DOHEADID)->where('DORDERBID',$bodyData->DOBODYID)->where('DORDER_NO',$bodyData->DO_NO)->where('ITEM_CODE',$bodyData->ITEM_CODE)->where('CP_CODE',$bodyData->CP_CODE)->where('SLNO',$bodyData->SLNO)->update($qtyAry);

						}
						

					}

					
				} /* foreach*/
			}

				//exit;

				DB::table('TRIP_HEAD')->where('COMP_CODE',$getcom_code)->where('TRIPHID',$fieldOne)->where('LR_STATUS','0')->where('TRIP_PMT_STATUS','0')->where('TRIP_EXP_STATUS','0')->delete();

				DB::table('TRIP_BODY')->where('TRIPHID',$fieldOne)->where('COMP_CODE',$getcom_code)->delete();

			}/* /.if codn*/

			DB::commit();

			$request->session()->flash('alert-success', 'Trip Data Was Deleted Successfully...!');
				return redirect('/view-vehicle-planing-mast');

		} catch (\Exception $e) {
		    DB::rollBack();
		    throw $e;
		    $request->session()->flash('alert-error', 'Trip Data Can Not Deleted...!');
				return redirect('/view-vehicle-planing-mast');
		}
		
	}

/* -------- Delete Trip Transaction Data ----------- */

/*------ Delete Transaction Data -------------*/

public function  deleteTransactionData(Request $request){

	$response_array = array();

        if ($request->ajax()) {

		$fisYear      =  $request->session()->get('macc_year');
		$compName    = $request->session()->get('company_name');
		$compcode    = explode('-', $compName);
		$comp_Code =	$compcode[0];

		$headId       = $request->input('headId');
		$bodyId       = $request->input('bodyId');
		$del_remark   = $request->input('del_remark');
		$firstTable   = $request->input('firstTable');
		$secondTable  = $request->input('secondTable');
		$thirdTable   = $request->input('thirdTable');
		$forthTable   = $request->input('forthTable');
		$colNameOne   = $request->input('colNameOne');
		$colNameTwo   = $request->input('colNameTwo');
		$colNameThree = $request->input('colNameThree');
		$colNameFour  = $request->input('colNameFour');
		$colNameFive  = $request->input('colNameFive');
		$colNameSix   = $request->input('colNameSix');

		if ($headId!='' && $bodyId!='') {

		//DB::enableQueryLog();

                   $FIRSTTBL = DB::table($firstTable)->where($colNameOne, $headId)->where('COMP_CODE', $comp_Code)->where('FY_CODE', $fisYear)->get()->toArray();

                   $FIRSTTBLDATA = json_decode(json_encode($FIRSTTBL),true);

		//dd(DB::getQueryLog());

                   if ($FIRSTTBLDATA) {

                   	$GETMSG = array();
                   	foreach ($FIRSTTBLDATA as $row) {

                   		$DORDERNO = $row[$colNameThree];
                   		//DB::enableQueryLog();
                   		$SECONDTBL = DB::table($secondTable)->where($colNameFive, $DORDERNO)->get()->toArray();
                   		//dd(DB::getQueryLog());
                   		$SECONDTBLDATA = json_decode(json_encode($SECONDTBL),true);

                   		if ($SECONDTBLDATA) {

                   			array_push($GETMSG,"true");
                   			
                   		}else{

                   		   //DB::enableQueryLog();
                   		   $THIRDTBL = DB::table($thirdTable)->where($colNameSix, $DORDERNO)->get()->toArray();
                   		   //dd(DB::getQueryLog());
                   		   $THIRDTBLDATA = json_decode(json_encode($THIRDTBL),true);

                   		   if ($THIRDTBLDATA) {

                   			array_push($GETMSG,"true");
                   			
	                   	    }else{

	                   	    	array_push($GETMSG,"false");

	                   	    }
                   		 
                   		}
	                
                   	}/* /. foreach loop */

                   	if (in_array("true", $GETMSG)){

			    $response_array['response'] = 'error';
		            $data = json_encode($response_array);

		            print_r($data);

			}else{

		           $FIRSTTBLHEADDEL = DB::table($firstTable)->where($colNameOne, $headId)->where('COMP_CODE', $comp_Code)->where('FY_CODE', $fisYear)->delete(); 

		           $FIRSTTBLBODYDEL = DB::table($forthTable)->where($colNameOne, $headId)->where('COMP_CODE', $comp_Code)->where('FY_CODE', $fisYear)->delete();

		           if ($FIRSTTBLHEADDEL && $FIRSTTBLBODYDEL) {

		           	    $response_array['response'] = 'success';
			            $data = json_encode($response_array);

			            print_r($data);
		           	
		           }else{

		           	$response_array['response'] = 'error';
		                $data = json_encode($response_array);

		                print_r($data);

		           }

			    
			} /* /. CHECK IN ARRAY "TRUE" */

                   	
                   }else{


                   	$response_array['response'] = 'error';
	                $data = json_encode($response_array);

	                print_r($data);
                   	
                     
                   } /* /. FIRSTTABLE QUERY DATA CHECK */

	        }else{

	        	$response_array['response'] = 'error';
	                $data = json_encode($response_array);

	                print_r($data);

	        } /* /. CHECK HEAD ID AND BODY ID */

	
	} /* /. AJAX IF */

}



public function deleteMsg(Request $request,$saveData,$pageUrl,$pageMsg){

        $newUrl = str_replace('~', '/', $pageUrl);
        $newPageMsg = str_replace('~', ' ', $pageMsg);

        if ($saveData == 'false') {
            
            $request->session()->flash('alert-error', $newPageMsg.'...!');
            return redirect($newUrl);

        }else{

            $request->session()->flash('alert-success', $newPageMsg.'...!');
            return redirect($newUrl);

        }
}

/*------ Delete Transaction Data -------------*/


// GENERATE DYANAMIC CODE

public function GenerateCode(Request $request){

	$likename      = $request->likename;
	$tbl_name      = $request->tbl_name;
	$col_code      = $request->col_code;

	$db_Name    = $request->session()->get('dbName');
   
	$find_length = DB::select("SELECT CHARACTER_MAXIMUM_LENGTH  AS COL_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$db_Name' AND TABLE_NAME = '$tbl_name' AND COLUMN_NAME = '$col_code'");

	$col_len = json_decode(json_encode($find_length),true);
	$strpad_length = $col_len[0]['COL_NAME'];
	
    $response_array = array();

	  if ($request->ajax()) {

	  	$searchname = '';

	  	if($likename!= ''){

	  		if($likename >= $strpad_length){
	  			$searchname = substr($likename, 0, 3);
	  		}else{
	  			$searchname = $likename;
	  		}

	  		$data = DB::select("SELECT MAX(CAST(REGEXP_REPLACE($col_code,'[^0-9]','') AS INT)) AS MCODE FROM $tbl_name WHERE $col_code LIKE '$searchname%'");
			
			if ($data) {
                
                $gen = $data[0]->MCODE + 1;
                
                $name_code_len = strlen($searchname);
               
                $str_length = $strpad_length - $name_code_len;
                
                $new_code = str_pad($gen,$str_length,'0',STR_PAD_LEFT);	
                
                $gen_code = $searchname.''.$new_code;

                $response_array['response'] = 'success';
	            $response_array['data'] = $gen_code ;

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



	}

// END GENERATE DYANAMIC CODE

	/* ----- START : SHOW BODY DETAILS ON CLICK IN VIEW PAGE ----- */

	public function ShowDetailsOnclickOfRowInViewPage(Request $request){

		$companyFull    = $request->session()->get('company_name');
		$splitComp      = explode('-', $companyFull);
		$comp_code      = $splitComp[0];
		$fisYear        = $request->session()->get('macc_year');
		$response_array = array();
		$fieldName      = $request->input('fieldName');
		$pageIndentity  = $request->input('pageIndentity');

		if ($request->ajax()) {

			if($pageIndentity == 'INWARD' && $fieldName){

				$splitData = explode('~', $fieldName);
				$vrNo      = $splitData[0];
				$seriesCD  = $splitData[1];
				$wagonNo   = $splitData[2];
				$vehicleNo = $splitData[3];

				$getbodyDetails = DB::select("SELECT * FROM CFINWARD_TRAN WHERE COMP_CODE='$comp_code' AND FY_CODE='$fisYear' AND VRNO='$vrNo' AND SERIES_CODE='$seriesCD' AND WAGON_NO='$wagonNo' AND VEHICLE_NO='$vehicleNo' ");

			}else if($pageIndentity == 'TRIP_PLANNING' && $fieldName){

				$splitDataTP    = explode('~', $fieldName);
				$vrNoTP         = $splitDataTP[0];
				$headIdTP       = $splitDataTP[1];

				$getbodyDetails = DB::select("SELECT * FROM TRIP_BODY WHERE COMP_CODE='$comp_code' AND VRNO='$vrNoTP' AND TRIPHID='$headIdTP'");
			}else if($pageIndentity == 'JOB_WORK_PUR_BILL' && $fieldName){

				//$splitDataTP    = $fieldName;
				//$vrNoTP         = $splitDataTP[0];
				$headIdTP       = $fieldName;

				$getbodyDetails = DB::select("SELECT * FROM PBILL_BODY WHERE COMP_CODE='$comp_code' AND PBILLHID='$headIdTP'");
			}
			else if($pageIndentity == 'JOB_WORK_SALE_BILL' && $fieldName){

				$headIdTP       = $fieldName;

				$getbodyDetails = DB::select("SELECT * FROM SBILL_BODY WHERE COMP_CODE='$comp_code' AND SBILLHID='$headIdTP'");
			}else if($pageIndentity == 'SUPPL_TRIP' && $fieldName){
				
                  $headIdTP       = $fieldName;

				
				$getbodyDetails = DB::select("SELECT t2.ACC_CODE,t2.ACC_NAME,t2.CP_CODE,t2.CP_NAME,t1.VRDATE,t1.FY_CODE,t1.SERIES_CODE,t1.VRNO,t1.OWNER,t1.FROM_PLACE,t1.TO_PLACE,t1.VEHICLE_NO,t1.SLR_FLAG,t1.SLR_STATUS FROM TRIP_HEAD t1,TRIP_BODY t2 WHERE t2.TRIPHID=t1.TRIPHID AND (t1.SLR_FLAG='0' AND t1.SLR_STATUS='1') AND t2.TRIPHID='$headIdTP' GROUP BY t2.TRIPHID ORDER BY t1.TRIPHID DESC");
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

/* ----- END : SHOW BODY DETAILS ON CLICK IN VIEW PAGE ----- */

/* ---------- START : GET ACCOUNT LIST AGAINST ACCOUNT TYPE -------- */
	
	public function GetAccListAgainstAccType(Request $request){

		$companyFull    = $request->session()->get('company_name');
		$splitComp      = explode('-', $companyFull);
		$comp_code      = $splitComp[0];
		$fisYear        = $request->session()->get('macc_year');
		$response_array = array();
		$acct_type      = $request->input('acct_type');

		if ($request->ajax()) {

			$accList = DB::table('MASTER_ACC')->where('ATYPE_CODE',$acct_type)->get();

			if($accList){

				$response_array['response']     = 'success';
				$response_array['data_accList'] = $accList;
	            $data = json_encode($response_array);
	            print_r($data);

			}else{

				$response_array['response']     = 'error';
				$response_array['data_accList'] = '';
				$data = json_encode($response_array);
	             print_r($data);
			}

		}else{
				$response_array['response']     = 'error';
				$response_array['data_accList'] = '';
				$data = json_encode($response_array);
	            print_r($data);
		}

	}

/* ---------- END : GET ACCOUNT LIST AGAINST ACCOUNT TYPE -------- */

/* ---------- SAVE C AND F DELETED DATA IN LOGISTIC DELETE LOG TABLE ------------  */
	
	/*public function DeleteTranCandFLog($formName,$tranTblI){



	}*/

/* ---------- SAVE C AND F DELETED DATA IN LOGISTIC DELETE LOG TABLE ------------  */
	

}


