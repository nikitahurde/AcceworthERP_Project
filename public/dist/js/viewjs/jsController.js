class jsController{

	checkBlankFieldValidation(){

		var series_code       = $('#series_code').val();
		var series_codeSale   = $('#series_code_sale').val();
		var Plant_code        = $('#Plant_code').val();
		var Plant_code_sale   = $('#Plant_code_sale').val();
		var account_code      = $('#account_code').val();
		var account_code_sale = $('#account_code_sale').val();
		var vr_date           = $('#vr_date').val();
		var due_days          = $('#due_days').val();
		var shipTAddr         = $('#shipTAddr').val();
		var costCentCd        = $('#costCent_code').val();
		var transCode         = $('#transcode').val();

	    if(vr_date){
	        $('#series_code').css('border-color','#d2d6de');
	        $('#series_code').css('border-color','#ff0000').focus();
	        $('#series_code_sale').css('border-color','#d2d6de');
	        $('#series_code_sale').css('border-color','#ff0000').focus();
	        $('#err_datemsg').html('');
	      if(series_code || series_codeSale){
	          $('#series_code').prop('readonly',false);
	          $('#series_code').css('border-color','#d2d6de');
	          $('#series_code_sale').prop('readonly',false);
	          $('#series_code_sale').css('border-color','#d2d6de');
	          $('#series_code_errr').html('');
	        if(Plant_code || Plant_code_sale){
	          $('#Plant_code').prop('readonly',false);
	          $('#Plant_code').css('border-color','#d2d6de');
	          $('#Plant_code_sale').prop('readonly',false);
	          $('#Plant_code_sale').css('border-color','#d2d6de');
	          $('#plant_err').html('');
	            if(account_code || account_code_sale){
	              $('#account_code').css('border-color','#d2d6de');
	              $('#account_code').prop('readonly',false);
	              $('#account_code_sale').css('border-color','#d2d6de');
	              $('#account_code_sale').prop('readonly',false);
	              $('#due_days').prop('readonly',false);
	              $('#due_days').css('border-color','#ff0000').focus();
	              $('#acccode_err').html('');
	              if(transCode == 'T0'){
	              		if(due_days){
	              				$('#dueDays_err').html('');
		              	 		$('#due_days').css('border-color','#d2d6de');
			              	}else{
			              		$('#dueDays_err').html('The Due Days field is required.');
			              	 	$('#due_days').css('border-color','#ff0000').focus();
			              	    $('#costCent_code,#series_code,#series_code_sale,#Plant_code,#Plant_code_sale,#tax_code,#tax_code_get').css('border-color','#d2d6de');
			              	}
	              	}else{

	              		if(shipTAddr){
						$('#shipTAddr').css('border-color','#d2d6de');
						$('#shipTAddr').prop('readonly',false);
						$('#err_shiptAdrMsg').html('');

						if(costCentCd){
							$('#Costcentr_err').html('');
							$('#costCent_code').prop('readonly',false);
							$('#due_days').prop('readonly',false);
							$('#due_days').css('border-color','#ff0000').focus();
							$('#costCent_code').css('border-color','#d2d6de');
							if(due_days){
								$('#dueDays_err').html('');
		              	 		$('#due_days').css('border-color','#d2d6de');
			              	}else{
			              		$('#dueDays_err').html('The Due Days field is required.');
			              	 	$('#due_days').css('border-color','#ff0000').focus();
			              	    $('#costCent_code,#series_code,#series_code_sale,#Plant_code,#Plant_code_sale,#tax_code,#tax_code_get').css('border-color','#d2d6de');
			              	}

						}else{
							$('#Costcentr_err').html('The Cost Center field is required.');
							$('#costCent_code').prop('readonly',false);
		              		$('#costCent_code').css('border-color','#ff0000').focus();

						}

		              	
	              	}else{
	              		$('#err_shiptAdrMsg').html('The Consignee/Delivery To field is required.');
		              	$('#shipTAddr').prop('readonly',false);
		              	$('#shipTAddr').css('border-color','#ff0000').focus();
		              	$('#series_code,#series_code_sale,#Plant_code_sale,#Plant_code,#due_days').css('border-color','#d2d6de');
	              	}

	              		
	              	}
	              
	            }else{
	              $('#acccode_err').html('The Account code field is required.');
	              $('#account_code').prop('readonly',false);
	              $('#account_code_sale').prop('readonly',false);
	              $('#series_code,#series_code_sale,#Plant_code_sale,#Plant_code,#due_days').css('border-color','#d2d6de');
	              $('#account_code').css('border-color','#ff0000').focus();
	              $('#account_code_sale').css('border-color','#ff0000').focus();
	            }
	        }else{
	          $('#plant_err').html('The Plant code field is required.');
	          $('#Plant_code').prop('readonly',false);
	          $('#Plant_code').css('border-color','#ff0000').focus();
	          $('#Plant_code_sale').prop('readonly',false);
	          $('#Plant_code_sale').css('border-color','#ff0000').focus();
	          $('#series_code,#series_code_sale,#account_code,#account_code_sale,#due_days').css('border-color','#d2d6de');
	        }

	      }else{
	      	$('#series_code_errr').html('The Series code field is required.');
	        $('#series_code').prop('readonly',false);
	        $('#series_code').css('border-color','#ff0000').focus();
	        $('#series_code_sale').prop('readonly',false);
	        $('#series_code_sale').css('border-color','#ff0000').focus();
	        $('#Plant_code,#Plant_code_sale,#account_code,#account_code_sale,#due_days').css('border-color','#d2d6de');
	      }
	    }else{
	      $('#err_datemsg').html('The Date field is required.');
	      $('#vr_date').css('border-color','#ff0000').focus();
	      $('#series_code,#series_code_sale,#Plant_code,#Plant_code_sale,#account_code,#account_code_sale,#due_days').css('border-color','#d2d6de');
	    }

	}


	checkBlankFieldValid(){

		var series_code       = $('#series_code').val();
		var series_codeSale   = $('#series_code_sale').val();
		var Plant_code        = $('#Plant_code').val();
		var Plant_codesale    = $('#Plant_code_sale').val();
		var account_code      = $('#account_code').val();
		var account_code_sale = $('#account_code_sale').val();
		var vr_date           = $('#vr_date').val();
		var tax_code          = $('#tax_code').val();
		var due_days          = $('#due_days').val();
		var shipTAddr         = $('#shipTAddr').val();
		var costCentCd        = $('#costCent_code').val();
		var transCode         = $('#transcode').val();

	    if(vr_date){
	        
	        $('#err_datemsg').html('');
	     	if(series_code || series_codeSale){
	          $('#series_code').prop('readonly',false);
	          $('#series_code').css('border-color','#d2d6de');
	          $('#series_code_sale').prop('readonly',false);
	          $('#series_code_sale').css('border-color','#d2d6de');
	        	if(Plant_code || Plant_codesale){
		          $('#Plant_code').prop('readonly',false);
		          $('#Plant_code').css('border-color','#d2d6de');
		          $('#Plant_code_sale').prop('readonly',false);
		          $('#Plant_code_sale').css('border-color','#d2d6de');
	            	if(account_code || account_code_sale){
	            		$('#acccode_err').html('');
		              $('#account_code').css('border-color','#d2d6de');
		              $('#account_code').prop('readonly',false);
		              $('#account_code_sale').css('border-color','#d2d6de');
		              $('#account_code_sale').prop('readonly',false);
		              $('#tax_code').prop('readonly',false);
		              $('#tax_code_get').prop('readonly',false);

	              		if(transCode == 'T0'){
		              		if(due_days){
			              	 		$('#due_days').css('border-color','#d2d6de');
				              	}else{
				              	 	$('#due_days').css('border-color','#ff0000').focus();
				              	    $('#costCent_code,#series_code,#series_code_sale,#Plant_code,#Plant_code_sale,#tax_code,#tax_code_get').css('border-color','#d2d6de');
				              	}
	              		}else{

	              			if(shipTAddr){
	              				$('#err_shiptAdrMsg').html('');
								$('#shipTAddr').css('border-color','#d2d6de');
								$('#shipTAddr').prop('readonly',false);

								if(costCentCd){
									$('#Costcentr_err').html('');
									$('#costCent_code').prop('readonly',false);
									$('#due_days').prop('readonly',false);
									$('#due_days').css('border-color','#ff0000').focus();
									$('#costCent_code').css('border-color','#d2d6de');
									if(transCode != 'P5'){
										if(due_days){
											$('#dueDays_err').html('');
					              	 		$('#due_days').css('border-color','#d2d6de');
						              	}else{
						              		$('#dueDays_err').html('The Due Days field is required.');
						              	 	$('#due_days').css('border-color','#ff0000').focus();
						              	    $('#costCent_code,#series_code,#series_code_sale,#Plant_code,#Plant_code_sale,#tax_code,#tax_code_get').css('border-color','#d2d6de');
						              	}
									}

								}else{
									$('#costCent_code').prop('readonly',false);
				              		$('#costCent_code').css('border-color','#ff0000').focus();
				              		$('#Costcentr_err').html('The Cost Center field is required.');
								}
		              	
			              	}else{
			              		$('#err_shiptAdrMsg').html('The Consignee/Delivery To field is required');
				              	$('#shipTAddr').prop('readonly',false);
				              	$('#shipTAddr').css('border-color','#ff0000').focus();
				              	$('#series_code,#series_code_sale,#Plant_code_sale,#Plant_code,#due_days').css('border-color','#d2d6de');
		              		}

	              		}
		            
		            }else{
		              $('#acccode_err').html('The Account code field is required.');
		              $('#account_code').prop('readonly',false);
		              $('#account_code').css('border-color','#ff0000').focus();
		              $('#account_code_sale').prop('readonly',false);
		              $('#account_code_sale').css('border-color','#ff0000').focus();
		              $('#series_code,#series_code_sale,#Plant_code,#Plant_code_sale,#due_days,#tax_code,#tax_code_get').css('border-color','#d2d6de');
		            }
		        }else{
		          $('#Plant_code').prop('readonly',false);
		          $('#Plant_code').css('border-color','#ff0000').focus();
		          $('#Plant_code_sale').prop('readonly',false);
		          $('#Plant_code_sale').css('border-color','#ff0000').focus();
		          $('#series_code,#series_code_sale,#account_code,#account_code_sale,#due_days,#tax_code,#tax_code_get').css('border-color','#d2d6de');
		        }

			}else{
				$('#series_code').prop('readonly',false);
				$('#series_code').css('border-color','#ff0000').focus();
				$('#series_code_sale').prop('readonly',false);
				$('#series_code_sale').css('border-color','#ff0000').focus();
				$('#Plant_code,#Plant_code_sale,#account_code,#account_code_sale,#due_days').css('border-color','#d2d6de');
			}
	    }else{
	      $('#err_datemsg').html('The Date field is required.');
	      $('#vr_date').css('border-color','#ff0000').focus();
	      $('#series_code,#series_code_sale,#Plant_code,#Plant_codesale,#account_code,#account_code_sale,#due_days').css('border-color','#d2d6de');
	    }

	    this.checkHeadAllForPurchase();

	}


	checkBlankFieldValid_Sale(){

		var series_code       = $('#series_code').val();
		var series_codeSale   = $('#series_code_sale').val();
		var Plant_code        = $('#Plant_code').val();
		var Plant_codesale    = $('#Plant_code_sale').val();
		var account_code      = $('#account_code').val();
		var account_code_sale = $('#account_code_sale').val();
		var vr_date           = $('#vr_date').val();
		var tax_code          = $('#tax_code').val();
		var due_days          = $('#due_days').val();
		var shipTAddr         = $('#shipTAddrs').val();
		var costCentCd        = $('#costCent_code_sale').val();
		var saleRepCd         = $('#sale_rep_code').val();

	    if(vr_date){
	        $('#series_code').css('border-color','#d2d6de');
	        $('#series_code').css('border-color','#ff0000').focus();
	        $('#series_code_sale').css('border-color','#d2d6de');
	        $('#series_code_sale').css('border-color','#ff0000').focus();
	        $('#err_datemsg').html('');
	      if(series_codeSale){
	          $('#series_code').prop('readonly',false);
	          $('#series_code').css('border-color','#d2d6de');
	          $('#series_code_sale').prop('readonly',false);
	          $('#series_code_sale').css('border-color','#d2d6de');
	          $('#series_code_errr').html('');
	        if(Plant_codesale){
	          $('#Plant_code').prop('readonly',false);
	          $('#Plant_code').css('border-color','#d2d6de');
	          $('#Plant_code_sale').prop('readonly',false);
	          $('#Plant_code_sale').css('border-color','#d2d6de');
	          $('#plant_err').html('');
	            if(account_code_sale){
	              $('#acccode_err').html('');
	              $('#account_code').css('border-color','#d2d6de');
	              $('#account_code').prop('readonly',false);
	              $('#account_code_sale').css('border-color','#d2d6de');
	              $('#account_code_sale').prop('readonly',false);
	              $('#tax_code').prop('readonly',false);
	              $('#tax_code_get').prop('readonly',false);
	              //$('#due_days').prop('readonly',false);
	              	/*if(tax_code){
	              		$('#tax_code').css('border-color','#d2d6de');
	                    
	              		$('#due_days').prop('readonly',false);
	              		$('#due_days').css('border-color','#ff0000').focus();
	              	}else{
	              		$('#tax_code').css('border-color','#ff0000').focus();
	              		$('#series_code,#Plant_code,#due_days').css('border-color','#d2d6de');
	              	}*/

	              	if(shipTAddr){
						$('#shipTAddrs').css('border-color','#d2d6de');
						$('#shipTAddrs').prop('readonly',false);
						$('#err_shiptAdrMsg').html('');
						if(saleRepCd){
							$('#saleR_err').html('');
							$('#sale_rep_code').css('border-color','#d2d6de');
							$('#sale_rep_code').prop('readonly',false);
							if(costCentCd){
								$('#Costcentr_err').html('');
								$('#costCent_code_sale').prop('readonly',false);
								$('#due_days').prop('readonly',false);
								$('#due_days').css('border-color','#ff0000').focus();
								$('#costCent_code_sale').css('border-color','#d2d6de');
								if(due_days){
									$('#dueDays_err').html('');
			              	 		$('#due_days').css('border-color','#d2d6de');
				              	}else{
				              		$('#dueDays_err').html('The Due Days field is required.');
				              	 	$('#due_days').css('border-color','#ff0000').focus();
				              	    $('#costCent_code_sale,#series_code,#series_code_sale,#Plant_code,#Plant_code_sale,#tax_code,#tax_code_get').css('border-color','#d2d6de');
				              	}

							}else{
								$('#costCent_code_sale').prop('readonly',false);
			              		$('#costCent_code_sale').css('border-color','#ff0000').focus();
			              		$('#Costcentr_err').html('The Cost Center field is required.');
							}
						}else{
							$('#saleR_err').html('The Sale Rep. field is required.');
							$('#sale_rep_code').prop('readonly',false);
		              		$('#sale_rep_code').css('border-color','#ff0000').focus();
						}
						
						

		              	
	              	}else{
	              		$('#err_shiptAdrMsg').html('The Consignee/Delivery To field is required');
		              	$('#shipTAddrs').prop('readonly',false);
		              	$('#shipTAddrs').css('border-color','#ff0000').focus();
		              	$('#series_code,#series_code_sale,#Plant_code_sale,#Plant_code,#due_days').css('border-color','#d2d6de');
	              	}

	            }else{
	              $('#acccode_err').html('The Account code field is required.');
	              $('#account_code').prop('readonly',false);
	              $('#account_code').css('border-color','#ff0000').focus();
	              $('#account_code_sale').prop('readonly',false);
	              $('#account_code_sale').css('border-color','#ff0000').focus();
	              $('#series_code,#series_code_sale,#Plant_code,#Plant_code_sale,#due_days,#tax_code,#tax_code_get').css('border-color','#d2d6de');
	            }
	        }else{
	          $('#plant_err').html('The Plant code field is required.');
	          $('#Plant_code').prop('readonly',false);
	          $('#Plant_code').css('border-color','#ff0000').focus();
	          $('#Plant_code_sale').prop('readonly',false);
	          $('#Plant_code_sale').css('border-color','#ff0000').focus();
	          $('#series_code,#series_code_sale,#account_code,#account_code_sale,#due_days,#tax_code,#tax_code_get').css('border-color','#d2d6de');
	        }

	      }else{
	      	$('#series_code_errr').html('The Series code field is required.');
	        $('#series_code').prop('readonly',false);
	        $('#series_code').css('border-color','#ff0000').focus();
	        $('#series_code_sale').prop('readonly',false);
	        $('#series_code_sale').css('border-color','#ff0000').focus();
	        $('#Plant_code,#Plant_code_sale,#account_code,#account_code_sale,#due_days').css('border-color','#d2d6de');
	      }
	    }else{
	      $('#err_datemsg').html('The Date field is required.');
	      $('#vr_date').css('border-color','#ff0000').focus();
	      $('#series_code,#series_code_sale,#Plant_code,#Plant_codesale,#account_code,#account_code_sale,#due_days').css('border-color','#d2d6de');
	    }

	    this.checkHeadAllFieldIsFill();

	}

	checkHeadAllFieldIsFill(){
		var vrDate         = $('#vr_date').val();
		var seriesCode     = $('#series_code_sale').val();
		var plantCode      = $('#Plant_code_sale').val();
		var shipToAdd      = $('#shipTAddrs').val();
		var saleRepCode    = $('#sale_rep_code').val();
		var costCenterCode = $('#costCent_code_sale').val();
		var dueDays        = $('#due_days').val();

		if(vrDate && seriesCode && plantCode && shipToAdd && saleRepCode && costCenterCode && dueDays){
			$('#ItemCodeId1').prop('readonly',false);
			console.log('if');
		}else{
			$('#ItemCodeId1').prop('readonly',true);
			console.log('else');
		}
	}

	checkHeadAllForPurchase(){
		var seriesCode = $('#series_code').val();
		var vrDate     = $('#vr_date').val();
		var plantCode  = $('#Plant_code').val();
		var accCode    = $('#account_code').val();
		var dueDays    = $('#due_days').val();
		var transcode    = $('#transcode').val();
		
		if(transcode == 'P5'){
			if(vrDate && seriesCode && plantCode && accCode){
				$('#ItemCodeId1').prop('readonly',false);
			}else{
				$('#ItemCodeId1').prop('readonly',true);
			}
		}else{
			if(vrDate && seriesCode && plantCode && accCode && dueDays){
				$('#ItemCodeId1').prop('readonly',false);
			}else{
				$('#ItemCodeId1').prop('readonly',true);
				
			}
		}
	}


}