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
		$SERCODE    = $EXPSERIES[0];
		$SERNAME    = $EXPSERIES[1];

		$EXPPLANT   = explode("[", $PLANTCODE);
		$PLTCODE    = $EXPPLANT[0];
		$PLTNAME    = $EXPPLANT[1];



		$SR_CODE    = 'CAM1';
		$SR_NAME    = 'DESHMUKH';


                $CompanyCode = $request->session()->get('company_name');
                $mfiscalYear = $request->session()->get('fiscal_year');
		$ccode       = explode('-', $CompanyCode);
		$compCode    = $ccode[0];
		$fyCode      = $request->session()->get('macc_year');
		$userId      = $request->session()->get('userid');

		$vrDate   = date("Y-m-d", strtotime($VRDATE));
		$fromDate = date("Y-m-d", strtotime($FROMDATE));
		$toDate   = date("Y-m-d", strtotime($TODATE));




	/* ------ GET - ACCOUT SAP CODE -----*/
		
		$ACCSAPCODE = DB::table('MASTER_ACC')->where('ACC_CODE',$ACCCODE)->get()->first();

		$ACCSAPCODEDATA = json_decode(json_encode($ACCSAPCODE),true);

		
		$M_SAP_CODE = $ACCSAPCODEDATA['SAP_CODE'];

		/*echo '<pre>';
		print_r($ACCSAPCODEDATA);
		exit();
*/


	/* ------ GET - ACCOUT SAP CODE -----*/


	/* ------------ /. START :CREATE OR GET FROM DB VRNO ---------------- */


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

        /* ------------ /. END :CREATE OR GET FROM DB VRNO ---------------- */

        	$SAMEDELIVERYNOARR   = array();
        	$SINGLEDELIVERYNOARR = array();
        	for ($j = 0; $j < $rowCount; $j++) {

        		$expArr = explode("/", $checkitm[$j]);

        		$delNo = $expArr[16];

        		$findInArr = array_search($delNo,$expArr);

        		if($findInArr){

        			//print_r($expArr[$j]);

        			$BASIC_AMT1 = 100;

        			$ZONE = 'W';

		    		$MVRNO = trim($SERCODE).'-'.$mfiscalYear.'-'.$newVr.'.txt';

		    		$M_REF_NO = '4700095795';

				$ADDCONTENTINTEXT = $expArr[34].'	'.$expArr[40].'	'.$M_SAP_CODE.'	'.$expArr[14].'	'.$M_REF_NO.'	'.$expArr[21].'	'.$ZONE.'	'.$BASIC_AMT1;

				$SAMEDELIVERYNOARR[] = $ADDCONTENTINTEXT;

				$MVRNOARR = trim($SERCODE).'-'.$mfiscalYear.'-'.$newVr.'.txt';
		    		//Storage::disk('local')->put($MVRNO, $ADDCONTENTINTEXT);


        			
        		}else{

        			$BASIC_AMT1 = 100;

		    		$MVRNO = trim($SERCODE).'-'.$mfiscalYear.'-'.$newVr.'.txt';

		    		$M_REF_NO = '4700095795';

		    		$ZONE = 'W';

				$ADDCONTENTINTEXT1 = $expArr[34].'	'.$expArr[40].'	'.$M_SAP_CODE.'	'.$expArr[14].'	'.$M_REF_NO.'	'.$expArr[21].'	'.$ZONE.'	'.$BASIC_AMT1;

				$SINGLEDELIVERYNOARR[] = $ADDCONTENTINTEXT1;

				$MVRNOARR = trim($SERCODE).'-'.$mfiscalYear.'-'.$newVr.'.txt';
		    		//Storage::disk('local')->put($MVRNO, $ADDCONTENTINTEXT);
        		}

        	}

        	echo '<pre>';
        	print_r($SAMEDELIVERYNOARR);
        	echo '<br>';
        	print_r($SINGLEDELIVERYNOARR);

		exit();
			
			if ($saveHeadData || $saveDataB) {

				$response_array['response']      = 'success';
				$response_array['file_path']      = $downloadPdf;
	                	$data = json_encode($response_array);
	                	print_r($data);

	            	}else{

				$response_array['response']  = 'error';
				$response_array['file_path']  = '';
				$data = json_encode($response_array);
				print_r($data);
	                
	            	}


	    }else{

		$response_array['response']  = 'error';
		$data = json_encode($response_array);
		print_r($data);
	                

	    } /* ./ ---- all data check if condition top -----*/

	}else{

		$response_array['response']  = 'error';
		$data = json_encode($response_array);
		print_r($data);
                
           
	}/* ./ AJAX if condition on top.... */


    }
