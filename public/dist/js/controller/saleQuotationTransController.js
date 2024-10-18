class SaleQuotationTran{

	constructor(name, year) {
   		
	}

	reverseQuoIfYes(salequoUrl){

		var revQuo = $('#revQuoNum').val();

		if(revQuo == 'Yes'){

			$('#squotnNum').prop('readonly',false);

			$.ajaxSetup({

		        headers: {

		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

		        }

	      	});

	      	$.ajax({

	            type: 'POST',

	            url: salequoUrl,

	            data: {revQuo:revQuo}, 

	            success: function (data) {

	              var data1 = JSON.parse(data);

	             

	              if(data1.data==''){
	                   $('#quoNumNotF').html('Quotation No Not Found');
	                   $('#squotnNum').prop('disabled',true);
	              }else{  
	              	$('#quoNumNotF').html('');
	              	 $('#squotnNum').prop('disabled',false);

	                    $.each(data1.data, function(k, getData){

	                    	var yearf = getData.FY_CODE;

                    		var startyear = yearf.split('-');

	                        $("#QuoNoList").append($('<option>',{

	                          value:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,
	                          'data-xyz':startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,
	                          text:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO


	                        }));

                      	});
	              }
	           //  console.log(data1.data);
	            }

	        });

      	}else{
      		$('#squotnNum').prop('readonly',true);
      	}

	}


	getItmBySaleQuoNo(quonourl){

		var quo_Num = $('#squotnNum').val();
		var splitval = quo_Num.split(' ');
		var quoNo = splitval[2];

		$.ajaxSetup({

		        headers: {

		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

		        }

	    });

	    $.ajax({

	            type: 'POST',

	            url: quonourl,

	            data: {quoNo:quoNo}, 

	            beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              	},

	            success: function (data) {

	              var data1 = JSON.parse(data);

	              	if(data1.data==''){
	                   
	              	}else{  

	              		$('#addmorhidn,#CalcTax,#quality_parametr').prop('disabled',false);
	              		
	                    $('#getItmexistCount').val(data1.data.length);
	                    var basicAmt = 0;
	                    for(var x=0;x<data1.data.length;x++){

	                    	var trrow=x+1;

	                    	$('#qty'+trrow).prop('readonly',false);
	                    	$('#CalcTax'+trrow).prop('disabled',false);
	                    	$('#qua_paramter'+trrow).prop('disabled',false);
	                    	$('#viewItemDetail'+trrow).removeClass('showdetail');
	                    	$('#itemNameTooltip'+trrow).removeClass('tooltiphide');

	                    	 basicAmt += parseFloat(data1.data[x].BASICAMT);

	                    	$('#basicTotal').val(basicAmt.toFixed(2));

	                    	if(x == 0){

	                    		if(data1.data[x].PARTICULAR == null){
	                    			var remarkDT = '';
	                    		}else{
	                    			var remarkDT = data1.data[x].PARTICULAR
	                    		}

	                    		$('#itemNameTooltip'+trrow).html(data1.data[x].ITEM_NAME);
	                    		$('#ItemCodeId'+trrow).val(data1.data[x].ITEM_CODE);
	                    		$('#Item_Name_id'+trrow).val(data1.data[x].ITEM_NAME);
	                    		$('#remark_data'+trrow).val(remarkDT);
	                    		$('#qty'+trrow).val(data1.data[x].QTYISSUED);
	                    		$('#existQty'+trrow).val(data1.data[x].QTYISSUED);
	                    		$('#UnitM'+trrow).val(data1.data[x].UM);
	                    		$('#Cfactor'+trrow).val(data1.data[x].AUM_FACTOR);
	                    		$('#A_qty'+trrow).val(data1.data[x].AQTYISSUED);
	                    		$('#existaddQty'+trrow).val(data1.data[x].AQTYISSUED);
	                    		$('#AddUnitM'+trrow).val(data1.data[x].AUM);
	                    		$('#rate'+trrow).val(data1.data[x].RATE);
	                    		$('#existrate'+trrow).val(data1.data[x].RATE);
	                    		$('#basic'+trrow).val(data1.data[x].BASICAMT);
	                    		$('#existbasic'+trrow).val(data1.data[x].BASICAMT);
	                    		$('#saleQuoHeadId'+trrow).val(data1.data[x].SQTNHID);
	                    		$('#saleQuoBodyId'+trrow).val(data1.data[x].SQTNBID);
	                    		$('#hsn_code'+trrow).val(data1.data[x].HSN_CODE);
	                    		$('#showHsnCd'+trrow).html('HSN No : '+data1.data[x].HSN_CODE);
	                    		$('#taxByItem'+trrow).val(data1.data[x].TAX_CODE);
	                    		$('#taxratebytax'+trrow).val(data1.data[x].TAX_CODE);

	                    	}else if(x >0){

	                    		if(data1.data[x].PARTICULAR == null){
	                    			var remarkD = '';
	                    		}else{
	                    			var remarkD = data1.data[x].PARTICULAR
	                    		}

	                    		var rowData = "<tr>";
	                    		 rowData +="<td class='tdthtablebordr'><input type='checkbox' class='case'  /></td>";
	                    		 rowData +="<td class='tdthtablebordr'><span id='snum' style='width: 10px;'>"+trrow+".</span></td>";
	                    		 rowData +="<td class='tdthtablebordr'><div class='input-group'><input type='text' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+trrow+"' value="+data1.data[x].ITEM_CODE+" name='item_code[]' oninput='this.value = this.value.toUpperCase()' readonly /></div><button type='button' class='btn btn-primary btn-xs viewbtnitem' id='viewItemDetail"+trrow+"' data-toggle='modal' data-target='#view_detail"+trrow+"' onclick='showItemDetail("+trrow+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button><div class='divhsn' id='showHsnCd"+trrow+"'>HSN No : "+data1.data[x].HSN_CODE+"</div><input type='hidden' id='saleQuoHeadId"+trrow+"' value="+data1.data[x].SQTNHID+" name='saleQuoHead[]'><input type='hidden' id='saleQuoBodyId"+trrow+"' value="+data1.data[x].SQTNBID+" name='saleQuoBody[]'><input type='hidden' id='hsn_code"+trrow+"' value="+data1.data[x].HSN_CODE+" name='hsn_code[]'><input type='hidden' id='taxByItem"+trrow+"' value="+data1.data[x].TAX_CODE+" name='tax_byitem[]'><input type='hidden' id='taxratebytax"+trrow+"' value="+data1.data[x].TAX_CODE+"><div class='modal fade' id='view_detail"+trrow+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div> <div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item name</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div> <div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div> <div class='box-row'><div class='box10 itmdetlheading1'><small id='itemCodeshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'><small id='hsncodeshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'> <small id='taxcodeshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'><small id='itemDetailshow"+trrow+"'> </small> </div><div class='box10 itmdetlheading'> <small id='itemtypeshow"+trrow+"'> </small> </div><div class='box10 itmdetlheading'><small id='itemgroupshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'><small id='itemclassshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'><small id='itemcategoryshow"+trrow+"'> </small></div></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div></div></div></div></td>";
	                    		 rowData +="<td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+trrow+"' name='item_name[]' value='"+data1.data[x].ITEM_NAME+"' readonly><small class='tooltiptextitem' id='itemNameTooltip"+trrow+"'>"+data1.data[x].ITEM_NAME+"</small><textarea id='remark_data"+trrow+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description' readonly>"+remarkD+"</textarea></td>";
	                    		 rowData +="<td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='qty"+trrow+"' name='qty[]'style='width: 80px' oninput='CalAQty("+trrow+")' value="+data1.data[x].QTYISSUED+"><input type='text' name='unit_M[]' id='UnitM"+trrow+"' class='inputboxclr SetInCenter AddM' readonly value="+data1.data[x].UM+"><input type='hidden' id='Cfactor"+trrow+"' value="+data1.data[x].aum_factor+"><input type='hidden' id='existQty"+trrow+"' name='existQty[]' value="+data1.data[x].QTYISSUED+"></div></td>";
	                    		 rowData +="<td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+trrow+"' value="+data1.data[x].AQTYISSUED+" name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+trrow+"' value="+data1.data[x].AUM+" class='inputboxclr SetInCenter AddM' readonly><input type='hidden' id='existaddQty"+trrow+"' name='existaddQty[]' value="+data1.data[x].AQTYISSUED+"></div></td>";
	                    		 rowData +="<td class='tdthtablebordr'><input type='text' class='debitcreditbox inputboxclr cr_amount SetInCenter' oninput='calculateBasicAmt("+trrow+")' id='rate"+trrow+"' value="+data1.data[x].RATE+" name='rate[]'  style='width: 80px' readonly/><input type='hidden' value="+data1.data[x].RATE+" name='existrate[]' id='existrate"+trrow+"'></td>";
	                    		 rowData +="<td class='tdthtablebordr'><input type='text' name='basic_amt[]' value="+data1.data[x].BASICAMT+" id='basic"+trrow+"' class='form-control basicamt debitcreditbox' style='width: 110px;margin-top: 14%;height: 22px;' readonly><input type='hidden' value="+data1.data[x].BASICAMT+" name='existbasic[]' id='existbasic"+trrow+"'></td>";
	                    		 rowData +="<td><input type='hidden' id='data_count"+trrow+"' class='dataCountCl' value='0' name='data_Count[]'><input type='hidden' class='setGrandAmnt' id='get_grand_num"+trrow+"' name='crAmtPerItem[]'><div style='margin-top: 23%;'><small id='taxnotfound"+trrow+"' class='label label-danger'></small></div><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='CalcTax"+trrow+"' data-toggle='modal' data-target='#tds_rate_model"+trrow+"' onclick='CalculateTax("+trrow+"); getGrandTotal("+trrow+");'>Calc Tax </button><div id='aplytaxOrNot"+trrow+"' class='aplynotStatus'></div><div id='appliedbtn"+trrow+"'></div><div id='cancelbtn"+trrow+"'></div><div class='modal fade' id='tds_rate_model"+trrow+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-5'><div class='form-group'><lable class='settaxcodemodel col-md-4' style='padding: 0px;'>Tax Code - </lable><input type='text' class='settaxcodemodel col-md-7' id='tax_code"+trrow+"' style='border: none; padding: 0px;' readonly></div></div><div class='col-md-6'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Tax / Charges / etc Calculation</h5></div><div class='col-md-1'></div></div></div><div class='modal-body table-responsive'><div class='modalspinner hideloaderOnModl'></div><div class='boxer' id='tax_rate_"+trrow+"'></div></div><div class='modal-footer'> <center> <span  id='footer_ok_btn"+trrow+"'></span><span  id='footer_tax_btn"+trrow+"' style='width: 56px;'></span> </center></div></div></div></div></td>";
	                    		 rowData +="<td><div style='margin-top: 12%;'><small id='qpnotfound"+trrow+"' class='label label-danger'></small></div><input type='hidden' id='quaP_count"+trrow+"' value='0' name='quaP_count[]' class='quaPcountrow' style='z-index: 0;'><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='qua_paramter"+trrow+"' data-toggle='modal' data-target='#quality_parametr"+trrow+"' onclick='qty_parameter("+trrow+")' style='padding-bottom: 0px;padding-top: 0px;'>Quality Parametr </button><div id='cancelQpbtn"+trrow+"'></div><div id='appliedQpbtn"+trrow+"'></div> <div id='qpApplyOrNot"+trrow+"' class='aplynotStatus'>0</div><small id='qPnotfountbtn"+trrow+"' class='label label-danger'></small><div class='modal fade' id='quality_parametr"+trrow+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Qaulity Parameter</h5> </div></div></div><div class='modal-body table-responsive'><div class='boxer' id='qua_par_"+trrow+"'></div></div><div class='modal-footer'><center><small style='text-align: center;' id='footerqp_ok_btn"+trrow+"'></small> <small style='text-align: center;' id='footerqp_quality_btn"+trrow+"'></small></center> </div></div> </div></div></td>";
	                    		 rowData +="</tr>";

	                    		$('#tbledata #firstRowtr').after(rowData);
	                    	
	                    	}
	                    } /* /. for loop */
	              	} /* /. else */
	            }, /* /. success */

	            complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              	},
	    }); /* /. ajax */

	} /* function */


	


}